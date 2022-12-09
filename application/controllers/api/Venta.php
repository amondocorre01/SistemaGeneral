<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Venta extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->library('demo');
        }
    
        public function index()
        {
           
           $data['cat1'] = $this->session->userdata('categorias');
           $this->load->view('generico/ventas/categoria1', $data, FALSE);
        }
    
        public function categoria_3() {
            
            if(isset($_POST['id'])){
                $id = $_POST['id'];

                $todos = $this->session->categoria_2;

                $filtrado = [];

                foreach( $todos as $cat2) {

                    if($cat2->ID_CATEGORIA_2 == $id)
                        array_push($filtrado, $cat2);
                }

                $data['search'] = false;
                $data['cat3']=(object)$filtrado;
                
            } else if(isset($_POST['search'])){
                
                $search = $_POST['search'];

                $sql = "SELECT * FROM CATEGORIA_3 c3 WHERE c3.PRODUCTO_MADRE  LIKE '%".$search."%'";

                $categorias = $this->main->getQuery($sql);

                $data['search'] = true;
                $data['cat3']=$categorias;
            }
            
            $this->load->view('generico/ventas/categoria3', $data, FALSE);
        }

        public function busqueda_cliente() {
            
            $buscar_por = $this->input->post('buscar_por');
            $clave = $this->input->post('clave');

            $this->db->like($buscar_por, $clave);
            $clientes = $this->main->getListSelect('VENTAS_CLIENTES vc', 'vc.ID_CLIENTE, vc.NOMBRE_COMPLETO');

            echo json_encode($clientes);
        }


        public function resumen() {

            $data = null;
            
            $this->load->view('generico/ventas/resumen', $data, FALSE);
        }


        public function adicional() {
            $id = $this->input->post('id');

            $adicional = $this->main->get('VENTA_ADICIONAL', ['ID_PRODUCTO_UNICO'=>$id]);

            $response['status'] = true;
            $response['result'] = $adicional;

            echo json_encode($response);
        }

        public function guardar_pedido(){
            $id_usuario = $this->session->userdata('id_usuario');
            $tipo_usuario = $this->session->userdata('tipo_usuario');
            $nombre_usuario = $this->session->userdata('nombre');
            $id_turno = $this->session->userdata('id_apertura_turno');
            $hora = date("H:i:s");
            $fecha = date("Y-m-d");
            $nameImpresora = 'EPSON TM-T20III Receipt';

            if(isset($_POST['savePedido'])){
                $id_cliente = $this->input->post('idCliente');
                $nombreCliente = $this->input->post('nombreCliente');
                $facturar_cliente_a = $this->input->post('facturar_cliente_a');
                $nitCliente = $this->input->post('nitCliente');
                $id_lista_precios = $this->input->post('idListaPrecios');
                $sucursalEsFacturado = $this->input->post('sucursalEsFacturado');
                $tamNit=strlen(trim($nitCliente));
                
                if($tamNit > 10 || $sucursalEsFacturado == '0'){
                    $facturado = 0;
                    $numero_factura = null;
                }else{
                    $facturado = 1;
                    $numero_factura = $this->getNumeroFactura();
                }
                $numero_pedido = $this->getNumeroPedido();
                $importeTotal = $this->input->post('importeTotal');
                $formaPago = $this->input->post('formaPago');
                $montoRecibido = $this->input->post('montoRecibido');
                $montoCambio = $this->input->post('montoCambio');
                $llamarPor = $this->input->post('llamarPor');
                
                $importeTotalFloat = floatval($importeTotal);
                $descuento=0;
                $totalAPagar = $importeTotalFloat-$descuento;
                $iva = $totalAPagar * 0.13;
                $cerrado = 1;
                $fecha = date("Y-m-d");
                $hora = date("H:i:s");
                $fecha_hora = date("d/m/Y H:i:s");
                $fecha_format =date("d/m/Y");
                
                $fecha_compra = str_replace("-","",$fecha);
                $monto_compra = number_format($totalAPagar, 0, '.', '');

                $dosificacion = $this->getDosificacion();
                if(count($dosificacion)==1){
                    $id_dosificacion = $dosificacion[0]->ID_DOSIFICACION;
                    $numero_autorizacion = $dosificacion[0]->N_AUTORIZACION;
                    $clave = $dosificacion[0]->LLAVE_DOSIFICACION;
                    $fecha_limite = $dosificacion[0]->FECHA_LIMITE;
                    $direccion_dosificacion = $dosificacion[0]->DIRECCION_SUCURSAL;
                    $telefono_dosificacion = $dosificacion[0]->TELEFONO;
                    $nit_dosificacion = $dosificacion[0]->NIT;
                    if($id_dosificacion == null){
                        echo json_encode('error');
                        exit();
                    }
                }else{
                    echo json_encode('error');
                    exit();
                }
                $codigo_control= $this->demo->codigo($numero_autorizacion, $numero_factura, $nitCliente, $fecha_compra, $monto_compra, $clave);
                $saveVD = $this->guardarVentaDocumento($facturado,$numero_factura, $numero_pedido, $hora, $fecha_compra, $id_cliente, $facturar_cliente_a, $nitCliente, $importeTotalFloat, $descuento, $formaPago, $totalAPagar, $codigo_control, $numero_autorizacion, $iva, $id_usuario, $id_turno,$id_lista_precios, $fecha_limite, $id_dosificacion);
                $ultimoVentaDocumento= $this->getUltimoVentaDocumento();
                $literal = convertir($totalAPagar);
                $objetoFactura = new stdClass();
                $objetoFactura->id_producto = $ultimoVentaDocumento;
                $objetoFactura->direccion = $direccion_dosificacion;
                $objetoFactura->telefono = $telefono_dosificacion;
                $objetoFactura->numero_factura = $numero_factura;
                $objetoFactura->numero_pedido = $numero_pedido;
                $objetoFactura->nit_empresa = trim($nit_dosificacion);
                $objetoFactura->numero_autorizacion = $numero_autorizacion;
                $objetoFactura->fecha_hora = $fecha_hora;
                $objetoFactura->nombre_usuario = $nombre_usuario;
                $objetoFactura->facturar_cliente_a = $facturar_cliente_a;
                $objetoFactura->nombre_cliente = $nombreCliente;
                $objetoFactura->nit_cliente = $nitCliente;
                $objetoFactura->importe_total = $totalAPagar;
                $objetoFactura->literal = $literal;
                $objetoFactura->codigo_control = $codigo_control;
                $objetoFactura->fecha_limite_emision = $fecha_limite;
                $objetoFactura->monto_recibido = $montoRecibido;
                $objetoFactura->monto_cambio = $montoCambio;
                $objetoFactura->llamar_por = trim($llamarPor);
                $objetoFactura->fecha = $fecha_format;

                if($saveVD == 'ok'){
                    $identificadores = $this->input->post('identificadores');
                    $idProductosUnicos = $this->input->post('idProductosUnicos');
                    $productos = $this->input->post('productos');
                    $preciosUnitarios = $this->input->post('preciosUnitarios');
                    $cantidades = $this->input->post('cantidades');
                    $subtotales = $this->input->post('subtotales');
                    $paraLlevars = $this->input->post('paraLlevar');
                    $mensajes = $this->input->post('mensajes');
                    $recibos = $this->input->post('recibos');
                    $frutas = $this->input->post('frutas');

                    $respuesta = '';
                    $listIdentificadores = json_decode(stripslashes($identificadores));
                    $listIdProductoUnicos = json_decode(stripslashes($idProductosUnicos));
                    $listProductos = json_decode(stripslashes($productos));
                    $listPreciosUnitarios = json_decode(stripslashes($preciosUnitarios));
                    $listCantidades = json_decode(stripslashes($cantidades));
                    $listSubtotales = json_decode(stripslashes($subtotales));
                    $listParaLlevar = json_decode(stripslashes($paraLlevars));
                    $listMensajes = json_decode(stripslashes($mensajes));
                    $listRecibos = json_decode(stripslashes($recibos));
                    $listFrutas = json_decode(stripslashes($frutas));
                    
                    $arrayPO = array();
                    $arraySize = sizeof($listProductos);
                    
                    for($key=0; $key < $arraySize; $key++) {
                        $objeto = new stdClass();
                        $objeto->identificador = $listIdentificadores[$key];
                        $objeto->id_producto_unico = $listIdProductoUnicos[$key];
                        $objeto->nombre = $listProductos[$key];
                        $objeto->precio = $listPreciosUnitarios[$key];
                        $objeto->cantidad = $listCantidades[$key];
                        $objeto->subtotal = $listSubtotales[$key];
                        $objeto->paraLlevar = $listParaLlevar[$key];
                        $objeto->mensaje = $listMensajes[$key];
                        $objeto->recibo = $listRecibos[$key];
                        $objeto->frutas = $listFrutas[$key];
                        array_push($arrayPO, $objeto);
                    }
                    for($key=0; $key < $arraySize; $key++) {
                        $identificador = $arrayPO[$key]->identificador;
                        $id_producto_unico = $arrayPO[$key]->id_producto_unico;
                        $nombre = $arrayPO[$key]->nombre;
                        $precio = $arrayPO[$key]->precio;
                        $cantidad = $arrayPO[$key]->cantidad;
                        $subtotal = $arrayPO[$key]->subtotal;
                        $paraLlevar = $arrayPO[$key]->paraLlevar;
                        $mensaje = $arrayPO[$key]->mensaje;
                        $id_recibo = $arrayPO[$key]->recibo;
                        $frutasSel = $arrayPO[$key]->frutas;
                        $saveVDD = $this->guardarVentaDetalle($id_producto_unico, $cantidad, $subtotal, $nombre, $id_recibo, $precio, $mensaje, $paraLlevar);
                        $arrayFrutasTam = sizeof($frutasSel);
                        $id_ultimo_vd = $this->getUltimoIdVentaDetalle();
                        for ($l=0; $l < $arrayFrutasTam; $l++) {
                            if( isset($frutasSel[$l])){
                                $frutaExplode = explode("-", $frutasSel[$l]);
                                $id_fruta_sel = $frutaExplode[0];
                                $this->guardarVentaProcedimiento($id_ultimo_vd, $id_fruta_sel);
                            }
                        }
                    }
                    if($saveVDD == 'ok'){
                        $objetoFacturacion = new stdClass();
                        $objetoFacturacion->nombre_impresora = $nameImpresora;
                        $objetoFacturacion->datos_factura = $objetoFactura;
                        $objetoFacturacion->detalle_productos = $arrayPO;
                        $respuesta_encode = json_encode($objetoFacturacion);   
                        $this->session->set_userdata('datos-factura', $respuesta_encode);
                        echo $respuesta_encode;
                    }
                    return; 
                }
            }
        }

        function guardarVentaDocumento($facturado,$numero_factura,$numero_pedido,$hora, $fecha, $id_cliente, $nombreCliente, $nitCliente, $importeTotal, $descuento, $formaPago, $totalAPagar, $codigo_control, $numero_autorizacion, $iva, $id_usuario, $id_turno, $id_lista_precios, $fecha_limite, $id_dosificacion){
            try
            {
                $conn = $this->OpenConnection();
                $sql = "EXEC ".PRE_SUC."SET_VENTA_DOCUMENTO '$facturado','$numero_factura','$numero_pedido','$hora','$fecha','$id_cliente','$nombreCliente','$nitCliente','$importeTotal','$descuento','$formaPago','$totalAPagar','$codigo_control','$numero_autorizacion','$iva','$id_usuario','$id_turno','$id_lista_precios','$fecha_limite','$id_dosificacion' ;";
                if(sqlsrv_query($conn, $sql)){
                    return 'ok';
                }else{
                    return 'error';
                }
                sqlsrv_close($conn);
            }
            catch(Exception $e)
            {
                return 'error';
                echo("Error!");
            }  
        }

        function guardarVentaDetalle($id_producto_unico, $cantidad, $subtotal, $nombre, $id_recibo, $precio_unitario, $mensaje, $paraLlevar){
            try
            {
                $conn = $this->OpenConnection();
                $sql = " EXEC ".PRE_SUC."SET_VENTA_DETALLE '$id_producto_unico','$cantidad','$subtotal','$nombre','$id_recibo','$precio_unitario','$mensaje','$paraLlevar';";
                if(sqlsrv_query($conn, $sql)){
                    return 'ok';
                }else{
                    return 'error';
                }
                sqlsrv_close($conn);
            }
            catch(Exception $e)
            {
                return 'error';
                echo("Error!");
            }                           
        }

        function guardarVentaProcedimiento($id_venta_detalle, $id_fruta){
            try
            {
                $conn = $this->OpenConnection();
                $sql = "EXEC ".PRE_SUC."SET_VENTA_PROCEDIMIENTO '$id_fruta','$id_venta_detalle';";
                if(sqlsrv_query($conn, $sql)){
                    return 'ok';
                }else{
                    return 'error';
                }
                sqlsrv_close($conn);
            }
            catch(Exception $e)
            {
                return 'error';
                echo("Error!");
            }                           
        }

        function OpenConnection()
        {   
            $serverName = BD_SERV_2;
            $connectionOptions = array("Database"=>BD_NAME_2,
                "Uid"=>BD_USER_2, "PWD"=>BD_PASS_2, "CharacterSet" =>"UTF-8");
            $conn = sqlsrv_connect($serverName, $connectionOptions);
            if($conn == false)
                die(FormatErrors(sqlsrv_errors()));
            return $conn;
        }

        function getNumeroFactura(){
            $res = 1;
            $sql = "EXEC ".PRE_SUC."GET_NRO_FACTURA ;";
            $respuesta = $this->main->getQuery($sql);
            if(count($respuesta)==1){
                $res = $respuesta[0]->numero_factura;
                if($res ==null){
                    $res=1;
                }
            }
            return $res;
        }

        function getNumeroPedido(){
            $res = 1;
            $fecha = date("Y-m-d");
            $sql = "EXEC ".PRE_SUC."GET_NRO_PEDIDO '$fecha' ;";
            $respuesta = $this->main->getQuery($sql);
            if(count($respuesta)==1){
                $res = $respuesta[0]->numero_pedido;
                if($res ==null){
                    $res=1;
                }
            }
            return $res;
        }

        function getUltimoIdVentaDetalle(){
            $res = null;
            $sql = "EXEC ".PRE_SUC."GET_MAX_VENTA_DETALLE";
            $respuesta = $this->main->getQuery($sql);
            if(count($respuesta)==1){
                $res = $respuesta[0]->id_venta_detalle;
            }
            return $res;
        }
        function getUltimoVentaDocumento(){
            $res = null;
            $sql = "EXEC ".PRE_SUC."GET_MAX_VENTA_DOCUMENTO";
            $respuesta = $this->main->getQuery($sql);
            if(count($respuesta)==1){
                $res = $respuesta[0]->id_venta_documento;
            }
            return $res;
        }

        function getDosificacion(){
            $fecha= date('Y-m-d');
            $sql = "EXEC ".PRE_SUC."GET_MAX_DOSIFICACION '$fecha';";
            $respuesta = $this->main->getQuery($sql);
            return $respuesta;
        }


        public function changePassword(){

            $response['actual'] = false;
            $response['iguales'] = false;

            $user =  $this->input->post('usuario');
            $actual = $this->input->post('password-actual');
            $newpass = $this->input->post('password-new');
            $newpassrepeat = $this->input->post('repeat-password-new');

                        $this->db->where('USUARIO', $user);
            $datos = $this->main->getSelect('VENTAS_USUARIOS', 'CONTRASEÑA');


            if($datos->CONTRASEÑA === strToHex($actual)) {

                $response['actual'] = true;
            }

            if(strToHex($newpass) === strToHex($newpassrepeat)) {

                $response['iguales'] = true;
            }


            if ($response['actual'] AND $response['iguales']) {


                $this->db->where('USUARIO', $user);
                $this->main->update('VENTAS_USUARIOS', ['CONTRASEÑA'=>strToHex($newpass)]);
                
                $this->session->sess_destroy();
		        redirect('login/index');
            }

            else {
                
                echo json_encode($response);
            
            }

        }

    
    }
    
?>