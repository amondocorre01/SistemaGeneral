<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Impresion extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->library('enviarMail'); 
        }
        
        public function motivos(){
            $res = null;
            $sql = "select * from VENTAS_F02_SINCRONIZACION vfs where ID_VENTAS_F02_CATALOGOS = 8;";
            $respuesta = $this->main->getQuery($sql);
            echo json_encode($respuesta);
        }

        public function anular(){
            $db = $this->input->post('db');
            $cod_id_sucursal = $this->input->post('cod_id_sucursal');
            $nombre_codigo_sucursal = $this->input->post('nombre_codigo_sucursal');
            $prefijo_sucursal = $this->input->post('prefijo_sucursal');
            $sufijo_sucursal = $this->input->post('sufijo_sucursal');
            $id_menu = $this->input->post('id_menu');
            
            $id = $this->input->post('id_venta_documento');
            $codigoMotivo = $this->input->post('codigo_motivo');
            
            $venta_documento = $this->getFactura($id,$nombre_codigo_sucursal,$prefijo_sucursal,$sufijo_sucursal);
            $cuis_actual = $this->getCuisActualSucursal($cod_id_sucursal);
            $id_cuis = $cuis_actual->ID_VENTAS_F01_CUIS;
            
            $fecha = date('Y-m-d');
            $cufd_actual = $this->getCufdActualSucursal($nombre_codigo_sucursal,$prefijo_sucursal,$sufijo_sucursal,$id_cuis);
            
            $codigoAmbiente = $cuis_actual->CODIGO_AMBIENTE;
            $codigoSistema = $cuis_actual->CODIGO_SISTEMA;
            $codigoSucursal = $cuis_actual->CODIGO_SUCURSAL;
            $codigoModalidad = $cuis_actual->CODIGO_MODALIDAD;
            $cuis = $cuis_actual->CODIGO_CUIS;
            $codigoPuntoVenta = $cuis_actual->CODIGO_PUNTO_VENTA;
            $nit = $cuis_actual->NIT;
            $cuf = $venta_documento->CODIGO_CUF;
            $tipoFacturaDocumento = $venta_documento->TIPO_DOCUMENTO_SECTOR;
            $codigoEmision = 1;//$venta_documento->TIPO_EMISION;
            $codigoDocumentoSector = $venta_documento->CODIGO_DOCUMENTO_SECTOR;
            $cufd = $cufd_actual->CODIGO_CUFD;
            
            $respuesta_soap = $this->anularFacturaSoap($cuf,$codigoAmbiente,$codigoEmision,$codigoSistema,$codigoSucursal,$codigoMotivo,$codigoModalidad,$cuis,$codigoPuntoVenta,$tipoFacturaDocumento,$nit,$codigoDocumentoSector,$cufd);
            //var_dump($respuesta_soap);
            $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $respuesta_soap);
            $xml = simplexml_load_string($xml);
            $json = json_encode($xml);
            $responseArray = json_decode($json,true);
            $res_respuesta = $this->showArrayKeySearch($responseArray, 'RespuestaServicioFacturacion');
            $tam_array = count($res_respuesta);
            $save = false;
            if( $tam_array > 0){
                $codigo_estado = $this->findKey($res_respuesta,'codigoEstado'); 
                $transaccion = $this->findKey($res_respuesta,'transaccion');
                if($transaccion =='true'){
                    if($codigo_estado =='905'){
                        $save=true;
                    }
                $transaccion = 1;
                }else{
                $transaccion = 0;
                }
            }
            if($save){
                $DB2 = $this->load->database($nombre_codigo_sucursal, TRUE);
                $DB2->where('ID_VENTA_DOCUMENTO', $id);
                $DB2->update('VENTA_DOCUMENTO'.$sufijo_sucursal , ['ANULADO'=>1]);
                $this->session->set_flashdata('anulado', 'SI');
                echo json_encode('anulado');
            }else{
                $this->session->set_flashdata('anulado', 'NO');
                echo json_encode('error');
            }
        }

        function getCuisActualSucursal($cod_id_sucursal){
            $res = null;
            $sql = "select * from VENTAS_F01_CUIS where CODIGO_SUCURSAL = '$cod_id_sucursal' and ESTADO = '1';";
            $respuesta = $this->main->getQuery($sql);
            return $respuesta[0];
        }

        function getCufdActualSucursal($nombre_codigo_sucursal,$prefijo_sucursal,$sufijo_sucursal,$id_cuis){
            $res = null;
            $date= date('Y-m-d');
            $sql = "select * from VENTAS_F03_CUFD".$sufijo_sucursal." where ID_VENTAS_F01_CUIS='$id_cuis' and ESTADO = '1' and fecha='$date';";
            $DB2 = $this->load->database($nombre_codigo_sucursal, TRUE);
            $respuesta = $DB2->query($sql);
            $respuesta = $respuesta->result();
            return $respuesta[0];
        }

        function getFactura($id,$codigo_sucursal,$prefijo_sucursal,$sufijo_sucursal){
            $res = null;
            $sql = "select * from VENTA_DOCUMENTO".$sufijo_sucursal." where ID_VENTA_DOCUMENTO = '$id' ;";
            $DB2 = $this->load->database($codigo_sucursal, TRUE);
            $respuesta = $DB2->query($sql);
            $respuesta = $respuesta->result();
            return $respuesta[0];
        }

        public function copia()
        {
            $id = $this->input->post('id');
            $result = $this->main->get(PRE_SUC.'VENTAS', ['ID_VENTA_DOCUMENTO'=>$id]);

            $literal = convertir($result->TOTAL_A_PAGAR);
    
            $result->literal = $literal; 

            $res=json_encode($result);
            $this->session->set_userdata('data-imprimir', $res);
            echo $res;
        }

        public function original()
        {
            $id = $this->input->post('id');
            $result = $this->main->get(PRE_SUC.'VENTAS', ['ID_VENTA_DOCUMENTO'=>$id]);


            $literal = convertir($result->TOTAL_A_PAGAR);
    
            $result->literal = $literal; 
            $res=json_encode($result);
            $this->session->set_userdata('data-imprimir', $res);
            echo $res;
        }

        public function factura($valor){
            $data['valor'] = $valor;
            $this->load->view('impresion/imprimir_factura', $data, FALSE);
        }

        public function recibo($valor){
            $data['valor'] = $valor;
            $this->load->view('impresion/imprimir_recibo', $data, FALSE);
        }

        public function gaveta(){
            $this->load->view('impresion/abrir_gaveta', null, FALSE);
        }

        public function ingreso(){
            $this->load->view('impresion/imprimir_ingreso', null, FALSE);
        }

        public function egreso(){
            $this->load->view('impresion/imprimir_egreso', null, FALSE);
        }

        public function abrirCaja(){
            $this->load->view('impresion/imprimir_abrir_caja', null, FALSE);
        }

        public function cierreCaja(){
            $this->load->view('impresion/imprimir_cierre_caja', null, FALSE);
        }
        
        public function imprimirCopiaFactura(){
            $this->load->view('impresion/imprimir_copia_factura', null, FALSE);
        }
        
        function anularFacturaSoap($cuf,$codigoAmbiente,$codigoEmision,$codigoSistema,$codigoSucursal,$codigoMotivo,$codigoModalidad,$cuis,$codigoPuntoVenta,$tipoFacturaDocumento,$nit,$codigoDocumentoSector,$cufd){
            $wsdlURL = URL_COMPRA_VENTA;
            $token_api= $_SESSION['token_api'];
            $XMLString = '<?xml version="1.0" encoding="UTF-8"?>
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:siat="https://siat.impuestos.gob.bo/">
            <soapenv:Header/>
            <soapenv:Body>
                <siat:anulacionFactura>
                    <SolicitudServicioAnulacionFactura>
                        <codigoAmbiente>'.$codigoAmbiente.'</codigoAmbiente>
                        <codigoEmision>'.$codigoEmision.'</codigoEmision>
                        <codigoSistema>'.$codigoSistema.'</codigoSistema>	
                        <codigoSucursal>'.$codigoSucursal.'</codigoSucursal>  
                        <codigoMotivo>'.$codigoMotivo.'</codigoMotivo>
                        <codigoModalidad>'.$codigoModalidad.'</codigoModalidad>
                        <cuis>'.$cuis.'</cuis>
                        <codigoPuntoVenta>'.$codigoPuntoVenta.'</codigoPuntoVenta>
                        <cuf>'.$cuf.'</cuf>
                        <tipoFacturaDocumento>'.$tipoFacturaDocumento.'</tipoFacturaDocumento>
                        <nit>'.$nit.'</nit>
                        <codigoDocumentoSector>'.$codigoDocumentoSector.'</codigoDocumentoSector>
                        <cufd>'.$cufd.'</cufd>
                        </SolicitudServicioAnulacionFactura>
                </siat:anulacionFactura>
            </soapenv:Body>
            </soapenv:Envelope>';
            $curl = curl_init();
            curl_setopt_array($curl, [
            CURLOPT_URL => URL_COMPRA_VENTA,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $XMLString,
            CURLOPT_HTTPHEADER => [
                "Authorization: Basic Og==",
                "Content-Type: application/xml",
                "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJSb25hbGRtZW4wMTgiLCJjb2RpZ29TaXN0ZW1hIjoiNzIyOEM2NDk2Qzc3QzA5RUU3MDBCNkYiLCJuaXQiOiJINHNJQUFBQUFBQUFBRE14dGpReHREQXpNTFFBQUxxbGd4SUtBQUFBIiwiaWQiOjMwMTQ1OTYsImV4cCI6MTY5MjE0NDAwMCwiaWF0IjoxNjYwNjc4NzU0LCJuaXREZWxlZ2FkbyI6NDM5NDE4NjAxOCwic3Vic2lzdGVtYSI6IlNGRSJ9.vHJD3ipob2kLbhpAs51a25TRKnAUaC_q-bzCtQC42iLQpTrHMS-TgJwN_pQePO1022TdUL4fn55IbkxuEIEHtA"
            ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                return null;
            } else {
                return $response;
            }
        }

        function showArray($array){
            foreach ($array as $key => $item) {
              if (is_array($item)) {
                  return $this->showArray($item);
              }else{
                echo '<br>'.$key.':'.$item.'<br>';
              }
            }
          }
          
          function showArrayKeySearch($array,$keySearch){
            $res = array();
            foreach ($array as $key => $item) {
              if (is_array($item)) {
                if ($key === $keySearch) {
                  return $this->showArrayItem($item);
                }else{
                  return $this->showArrayKeySearch($item,$keySearch);
                }
              }
            }
            return $res;
          }
          
          function showArrayItem($array){
            $res= array();
            foreach ($array as $key => $item) {
              if (!is_array($item)) {
                //echo '<br>'.$key.':'.$item;
                $res[$key]=$item;
              }
            }
            return $res;
          }
          
          function findKey($array, $keySearch){
              foreach ($array as $key => $item) {
                  if ($key === $keySearch) {
                      return $item;
                  }else{
                      if (is_array($item)) {
                          return $this->findKey($item, $keySearch);
                      }
                  }
              }
              return false;
          }

        public function obtenerArchivoObjeto($id_venta){
            $sufijo = $this->session->ubicacion_seleccionada->SUFIJO;
            $codigo_bd = $this->session->ubicacion_seleccionada->CODIGO;
            $res = null;
            $sql = "select * from VENTA_ARCHIVO".$sufijo." where ID_VENTA_DOCUMENTO = '$id_venta';";
            $DB2 = $this->load->database($codigo_bd, TRUE);
            $respuesta = $DB2->query($sql);
            $respuesta = $respuesta->result();
            if(count($respuesta)==1){
                $res = $respuesta[0]->ARCHIVO_OBJETO;
            }
            return $res;        
        }

        public function obtenerObjetoFactura($id_venta){
            $objeto = $this->obtenerArchivoObjeto($id_venta);
            echo json_encode($objeto);
        }

          public function imprimirComanda($id_venta){
            //Obtener el objeto factura desde la base de datos
            $objeto_factura = $this->obtenerArchivoObjeto($id_venta);
            //$objeto_factura = base64_decode($objeto_factura);
            $res = json_decode($objeto_factura);
            $datos_factura = $res->datos_factura;
            $id_producto = $datos_factura->id_producto;
            $razon_social_emisor = $datos_factura->razon_social_emisor;
            $municipio_emisor = $datos_factura->municipio_emisor;
            $descripcion_sucursal = $datos_factura->descripcion_sucursal;
            $nit_emisor = $datos_factura->nit_emisor;
            $punto_venta = $datos_factura->punto_venta;
            $direccion_emisor = $datos_factura->direccion_emisor;
            $telefono_emisor = $datos_factura->telefono_emisor;

            $correo_info = $datos_factura->correo_info;
            $direccion_info = $datos_factura->direccion_info;
            $pagina_web = $datos_factura->pagina_web;

            $numero_factura = $datos_factura->numero_factura;
            $numero_pedido = $datos_factura->numero_pedido;
            $codigoCuf = $datos_factura->codigoCuf;
            $urlSiat = $datos_factura->url_siat;
            $numero_autorizacion ='';
            $dateTime = $datos_factura->datetime;
            $fecha = explode("T", $dateTime);
            $fecha_1 = explode("-", $fecha[0]);
            $ges=$fecha_1[0];
            $mes=$fecha_1[1];
            $dia=$fecha_1[2];
            $fecha_1= $dia.'/'.$mes.'/'.$ges;
            $hora = str_replace('.000','',$fecha[1]);
            $fecha_hora = $fecha_1.' '.$hora;
            $fecha = $datos_factura->fecha;
            $nombre_usuario = $datos_factura->nombre_usuario;
            //$nombre_usuario = $this->getIniciales($nombre_usuario);
            $nombre_cliente =$datos_factura->nombre_cliente;
            $facturar_cliente_a =$datos_factura->facturar_cliente_a;
            $nit_cliente = $datos_factura->nit_cliente;
            $complemento_ci =trim($datos_factura->complemento_ci);
            if($complemento_ci != ''){
                $nit_cliente = $nit_cliente.'-'.$complemento_ci;
            }
            
            $id_cliente = $datos_factura->id_cliente;
            $importe_total = $datos_factura->importe_total;
            $subtotal = $datos_factura->subtotal;
            $descuento = $datos_factura->descuento_adicional;
            $total = $datos_factura->monto_total;
            $monto_gift_card = $datos_factura->monto_gift_card;
            $monto_pagar = $datos_factura->monto_pagar;
            $monto_sujeto_iva = $datos_factura->monto_sujeto_iva;
            $tipo_emision = $datos_factura->tipo_emision;
            $fraccion = $datos_factura->fraccion;
            $importe_total=number_format($importe_total,2,'.','');  
            $codigo_moneda = $datos_factura->codigo_moneda;
            $tipo_cambio = $datos_factura->codigo_tipo_cambio;
            $descripcion_moneda = '';
            if($codigo_moneda != '1'){
                $descripcion_moneda = $datos_factura->descripcion_moneda;
            }
            $literal = $datos_factura->literal;
            $leyenda = $datos_factura->leyenda;
            //$monto_recibido = $datos_factura->monto_recibido;
            //$monto_cambio = $datos_factura->monto_cambio;
            $llamar_por = $datos_factura->llamar_por;
            $ver_pdf_rollo = $datos_factura->ver_pdf_rollo;
            $listProductos = json_encode($res->detalle_productos);
            $res= json_encode($res);
            $leyenda_on_off='';
            $leyenda_online='“Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido en una modalidad de facturación en línea”';
            $leyenda_offline='“Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido fuera de línea, verifique su envío con su proveedor o en la página web www.impuestos.gob.bo”';
            if($tipo_emision == '1'){
                $leyenda_on_off = $leyenda_online;
            }else{
                $leyenda_on_off = $leyenda_offline;
            }
            $data['json']='{"datos_factura":{"ver_pdf_rollo":"'.$ver_pdf_rollo.'","descripcion_sucursal":"'.$descripcion_sucursal.'","razon_social_emisor":"'.$descripcion_sucursal.'","razon_social_emisor":"'.$razon_social_emisor.'","municipio_emisor":"'.$municipio_emisor.'","nit_emisor":"'.$nit_emisor.'","direccion_emisor":"'.$direccion_emisor.'","telefono_emisor":"'.$telefono_emisor.'","punto_venta":'.$punto_venta.',"id_producto":'.$id_producto.',"numero_factura":'.$numero_factura.',"numero_pedido":'.$numero_pedido.',"fecha_hora":"'.$fecha_hora.'","nombre_usuario":"'.$nombre_usuario.'","facturar_cliente_a":"'.$facturar_cliente_a.'","nombre_cliente":"'.$nombre_cliente.'","nit_cliente":"'.$nit_cliente.'","importe_total":'.$importe_total.',"subtotal":'.$subtotal.',"descuento":'.$descuento.',"total":'.$total.',"monto_gift_card":'.$monto_gift_card.',"monto_pagar":'.$monto_pagar.',"monto_sujeto_iva":'.$monto_sujeto_iva.',"descripcion_moneda":"'.$descripcion_moneda.'","tipo_cambio":"'.$tipo_cambio.'","literal":"'.$literal.'","fraccion":"'.$fraccion.'","llamar_por":"'.$llamar_por.'","fecha":"'.$fecha.'","leyenda":"'.$leyenda.'","datetime":"'.$dateTime.'","nit_emisor":"'.$nit_emisor.'","codigoCuf":"'.$codigoCuf.'","id_cliente":"'.$id_cliente.'","url_siat":"'.$urlSiat.'","leyenda_on_off":"'.$leyenda_on_off.'"},"detalle_productos":'.$listProductos.'}';

            $this->load->view('impresion/comanda', $data, FALSE);
        }

        public function reimprimirFacturaCarta($id_venta){
            //Obtener el objeto factura desde la base de datos
            $objeto_factura = $this->obtenerArchivoObjeto($id_venta);
            //$objeto_factura = base64_decode($objeto_factura);
            $res = json_decode($objeto_factura);
            $datos_factura = $res->datos_factura;
            $id_producto = $datos_factura->id_producto;
            $razon_social_emisor = $datos_factura->razon_social_emisor;
            $municipio_emisor = $datos_factura->municipio_emisor;
            $nit_emisor = $datos_factura->nit_emisor;
            $punto_venta = $datos_factura->punto_venta;
            $direccion_emisor = $datos_factura->direccion_emisor;
            $telefono_emisor = $datos_factura->telefono_emisor;
            $codigo_sucursal = $datos_factura->codigo_sucursal;

            $correo_info = $datos_factura->correo_info;
            $direccion_info = $datos_factura->direccion_info;
            $pagina_web = $datos_factura->pagina_web;

            $numero_factura = $datos_factura->numero_factura;
            $numero_pedido = $datos_factura->numero_pedido;
            $codigoCuf = $datos_factura->codigoCuf;
            $urlSiat = $datos_factura->url_siat;
            $numero_autorizacion ='';
            $dateTime = $datos_factura->datetime;
            $fecha = explode("T", $dateTime);
            $fecha_1 = explode("-", $fecha[0]);
            $ges=$fecha_1[0];
            $mes=$fecha_1[1];
            $dia=$fecha_1[2];
            $fecha_1= $dia.'/'.$mes.'/'.$ges;
            $hora = str_replace('.000','',$fecha[1]);
            $fecha_hora = $fecha_1.' '.$hora;
            $fecha = $datos_factura->fecha;
            $nombre_usuario = $datos_factura->nombre_usuario;
            //$nombre_usuario = $this->getIniciales($nombre_usuario);
            $nombre_cliente =$datos_factura->nombre_cliente;
            $facturar_cliente_a =$datos_factura->facturar_cliente_a;
            $nit_cliente = $datos_factura->nit_cliente;
            $complemento_ci =trim($datos_factura->complemento_ci);
            if($complemento_ci != ''){
                $nit_cliente = $nit_cliente.'-'.$complemento_ci;
            }
            
            $id_cliente = $datos_factura->id_cliente;
            $importe_total = $datos_factura->importe_total;
            $subtotal = $datos_factura->subtotal;
            $descuento = $datos_factura->descuento_adicional;
            $total = $datos_factura->monto_total;
            $monto_gift_card = $datos_factura->monto_gift_card;
            $monto_pagar = $datos_factura->monto_pagar;
            $monto_sujeto_iva = $datos_factura->monto_sujeto_iva;
            $tipo_emision = $datos_factura->tipo_emision;
            $fraccion = $datos_factura->fraccion;
            $importe_total=number_format($importe_total,2,'.','');  
            $codigo_moneda = $datos_factura->codigo_moneda;
            $tipo_cambio = $datos_factura->codigo_tipo_cambio;
            $descripcion_moneda = '';
            if($codigo_moneda != '1'){
                $descripcion_moneda = $datos_factura->descripcion_moneda;
            }
            $literal = $datos_factura->literal;
            $leyenda = $datos_factura->leyenda;
            //$monto_recibido = $datos_factura->monto_recibido;
            //$monto_cambio = $datos_factura->monto_cambio;
            $llamar_por = $datos_factura->llamar_por;
            $ver_pdf_carta = $datos_factura->ver_pdf_carta;
            $listProductos = json_encode($res->detalle_productos);
            $res= json_encode($res);
            $leyenda_on_off='';
            $leyenda_online='“Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido en una modalidad de facturación en línea”';
            $leyenda_offline='“Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido fuera de línea, verifique su envío con su proveedor o en la página web www.impuestos.gob.bo”';
            if($tipo_emision == '1'){
                $leyenda_on_off = $leyenda_online;
            }else{
                $leyenda_on_off = $leyenda_offline;
            }
            $data['json'] = '{"datos_factura":{"ver_pdf_carta":"'.$ver_pdf_carta.'","codigo_sucursal":"'.$codigo_sucursal.'","tipo_emision":"'.$tipo_emision.'","razon_social_emisor":"'.$razon_social_emisor.'","municipio_emisor":"'.$municipio_emisor.'","nit_emisor":"'.$nit_emisor.'","direccion_emisor":"'.$direccion_emisor.'","telefono_emisor":"'.$telefono_emisor.'","punto_venta":"'.$punto_venta.'","id_producto":'.$id_producto.',"numero_factura":'.$numero_factura.',"numero_pedido":'.$numero_pedido.',"fecha_hora":"'.$fecha_hora.'","nombre_usuario":"'.$nombre_usuario.'","facturar_cliente_a":"'.$facturar_cliente_a.'","nombre_cliente":"'.$nombre_cliente.'","nit_cliente":"'.$nit_cliente.'","importe_total":'.$importe_total.',"subtotal":'.$subtotal.',"descuento":'.$descuento.',"total":'.$total.',"monto_gift_card":'.$monto_gift_card.',"monto_pagar":'.$monto_pagar.',"monto_sujeto_iva":'.$monto_sujeto_iva.',"descripcion_moneda":"'.$descripcion_moneda.'","tipo_cambio":"'.$tipo_cambio.'","literal":"'.$literal.'","fraccion":"'.$fraccion.'","llamar_por":"'.$llamar_por.'","fecha":"'.$fecha.'","leyenda":"'.$leyenda.'","datetime":"'.$dateTime.'","nit_emisor":"'.$nit_emisor.'","codigoCuf":"'.$codigoCuf.'","id_cliente":"'.$id_cliente.'","url_siat":"'.$urlSiat.'","leyenda_on_off":"'.$leyenda_on_off.'"},"detalle_productos":'.$listProductos.'}';
            //var_dump($data);
            $this->load->view('impresion/factura', $data, FALSE);
            
            //if($tipo_emision == '1'){
                /*
                if(!isset($_SESSION['registroModoOffline'])){
                    if($email_cliente != ''){
                        $this->enviarCorreo($telefono_emisor, $correo_info, $direccion_info, $pagina_web, $numero_factura, $email_cliente);
                    }
                }*/
        }

        public function reimprimirFacturaRollo($id_venta){
            //Obtener el objeto factura desde la base de datos
            $objeto_factura = $this->obtenerArchivoObjeto($id_venta);
            //$objeto_factura = base64_decode($objeto_factura);
            $res = json_decode($objeto_factura);
            $datos_factura = $res->datos_factura;
            $id_producto = $datos_factura->id_producto;
            $razon_social_emisor = $datos_factura->razon_social_emisor;
            $municipio_emisor = $datos_factura->municipio_emisor;
            $nit_emisor = $datos_factura->nit_emisor;
            $punto_venta = $datos_factura->punto_venta;
            $direccion_emisor = $datos_factura->direccion_emisor;
            $telefono_emisor = $datos_factura->telefono_emisor;
            $codigo_sucursal = $datos_factura->codigo_sucursal;

            $correo_info = $datos_factura->correo_info;
            $direccion_info = $datos_factura->direccion_info;
            $pagina_web = $datos_factura->pagina_web;

            $numero_factura = $datos_factura->numero_factura;
            $numero_pedido = $datos_factura->numero_pedido;
            $codigoCuf = $datos_factura->codigoCuf;
            $urlSiat = $datos_factura->url_siat;
            $numero_autorizacion ='';
            $dateTime = $datos_factura->datetime;
            $fecha = explode("T", $dateTime);
            $fecha_1 = explode("-", $fecha[0]);
            $ges=$fecha_1[0];
            $mes=$fecha_1[1];
            $dia=$fecha_1[2];
            $fecha_1= $dia.'/'.$mes.'/'.$ges;
            $hora = str_replace('.000','',$fecha[1]);
            $fecha_hora = $fecha_1.' '.$hora;
            $fecha = $datos_factura->fecha;
            $nombre_usuario = $datos_factura->nombre_usuario;
            //$nombre_usuario = $this->getIniciales($nombre_usuario);
            $nombre_cliente =$datos_factura->nombre_cliente;
            $facturar_cliente_a =$datos_factura->facturar_cliente_a;
            $nit_cliente = $datos_factura->nit_cliente;
            $complemento_ci =trim($datos_factura->complemento_ci);
            if($complemento_ci != ''){
                $nit_cliente = $nit_cliente.'-'.$complemento_ci;
            }
            
            $id_cliente = $datos_factura->id_cliente;
            $importe_total = $datos_factura->importe_total;
            $subtotal = $datos_factura->subtotal;
            $descuento = $datos_factura->descuento_adicional;
            $total = $datos_factura->monto_total;
            $monto_gift_card = $datos_factura->monto_gift_card;
            $monto_pagar = $datos_factura->monto_pagar;
            $monto_sujeto_iva = $datos_factura->monto_sujeto_iva;
            $tipo_emision = $datos_factura->tipo_emision;
            $fraccion = $datos_factura->fraccion;
            $importe_total=number_format($importe_total,2,'.','');  
            $codigo_moneda = $datos_factura->codigo_moneda;
            $tipo_cambio = $datos_factura->codigo_tipo_cambio;
            $descripcion_moneda = '';
            if($codigo_moneda != '1'){
                $descripcion_moneda = $datos_factura->descripcion_moneda;
            }
            $literal = $datos_factura->literal;
            $leyenda = $datos_factura->leyenda;
            //$monto_recibido = $datos_factura->monto_recibido;
            //$monto_cambio = $datos_factura->monto_cambio;
            $llamar_por = $datos_factura->llamar_por;
            $ver_pdf_rollo = $datos_factura->ver_pdf_rollo;
            $listProductos = json_encode($res->detalle_productos);
            $res= json_encode($res);
            $leyenda_on_off='';
            $leyenda_online='“Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido en una modalidad de facturación en línea”';
            $leyenda_offline='“Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido fuera de línea, verifique su envío con su proveedor o en la página web www.impuestos.gob.bo”';
            if($tipo_emision == '1'){
                $leyenda_on_off = $leyenda_online;
            }else{
                $leyenda_on_off = $leyenda_offline;
            }
            $data['json']='{"datos_factura":{"ver_pdf_rollo":"'.$ver_pdf_rollo.'","codigo_sucursal":"'.$codigo_sucursal.'","razon_social_emisor":"'.$razon_social_emisor.'","municipio_emisor":"'.$municipio_emisor.'","nit_emisor":"'.$nit_emisor.'","direccion_emisor":"'.$direccion_emisor.'","telefono_emisor":"'.$telefono_emisor.'","punto_venta":'.$punto_venta.',"id_producto":'.$id_producto.',"numero_factura":'.$numero_factura.',"numero_pedido":'.$numero_pedido.',"fecha_hora":"'.$fecha_hora.'","nombre_usuario":"'.$nombre_usuario.'","facturar_cliente_a":"'.$facturar_cliente_a.'","nombre_cliente":"'.$nombre_cliente.'","nit_cliente":"'.$nit_cliente.'","importe_total":'.$importe_total.',"subtotal":'.$subtotal.',"descuento":'.$descuento.',"total":'.$total.',"monto_gift_card":'.$monto_gift_card.',"monto_pagar":'.$monto_pagar.',"monto_sujeto_iva":'.$monto_sujeto_iva.',"descripcion_moneda":"'.$descripcion_moneda.'","tipo_cambio":"'.$tipo_cambio.'","literal":"'.$literal.'","fraccion":"'.$fraccion.'","llamar_por":"'.$llamar_por.'","fecha":"'.$fecha.'","leyenda":"'.$leyenda.'","datetime":"'.$dateTime.'","nit_emisor":"'.$nit_emisor.'","codigoCuf":"'.$codigoCuf.'","id_cliente":"'.$id_cliente.'","url_siat":"'.$urlSiat.'","leyenda_on_off":"'.$leyenda_on_off.'"},"detalle_productos":'.$listProductos.'}';

            $this->load->view('impresion/termico', $data, FALSE);
        }

        function imprimirFacturaAnuladaCarta($id_venta){
            $objeto_factura = $this->obtenerArchivoObjeto($id_venta);
            $res = json_decode($objeto_factura);
            $datos_factura = $res->datos_factura;
            $id_producto = $datos_factura->id_producto;
            $razon_social_emisor = $datos_factura->razon_social_emisor;
            $municipio_emisor = $datos_factura->municipio_emisor;
            $nit_emisor = $datos_factura->nit_emisor;
            $punto_venta = $datos_factura->punto_venta;
            $direccion_emisor = $datos_factura->direccion_emisor;
            $telefono_emisor = $datos_factura->telefono_emisor;
            $codigo_sucursal = $datos_factura->codigo_sucursal;

            $correo_info = $datos_factura->correo_info;
            $direccion_info = $datos_factura->direccion_info;
            $pagina_web = $datos_factura->pagina_web;

            $numero_factura = $datos_factura->numero_factura;
            $numero_pedido = $datos_factura->numero_pedido;
            $codigoCuf = $datos_factura->codigoCuf;
            $urlSiat = $datos_factura->url_siat;
            $numero_autorizacion ='';
            $dateTime = $datos_factura->datetime;
            $fecha = explode("T", $dateTime);
            $fecha_1 = explode("-", $fecha[0]);
            $ges=$fecha_1[0];
            $mes=$fecha_1[1];
            $dia=$fecha_1[2];
            $fecha_1= $dia.'/'.$mes.'/'.$ges;
            $hora = str_replace('.000','',$fecha[1]);
            $fecha_hora = $fecha_1.' '.$hora;
            $fecha = $datos_factura->fecha;
            $nombre_usuario = $datos_factura->nombre_usuario;
            //$nombre_usuario = $this->getIniciales($nombre_usuario);
            $nombre_cliente =$datos_factura->nombre_cliente;
            $facturar_cliente_a =$datos_factura->facturar_cliente_a;
            $nit_cliente = $datos_factura->nit_cliente;
            $complemento_ci =trim($datos_factura->complemento_ci);
            if($complemento_ci != ''){
                $nit_cliente = $nit_cliente.'-'.$complemento_ci;
            }
            
            $id_cliente = $datos_factura->id_cliente;
            $email_cliente = trim($datos_factura->email_cliente);
            $importe_total = $datos_factura->importe_total;
            $subtotal = $datos_factura->subtotal;
            $descuento = $datos_factura->descuento_adicional;
            $total = $datos_factura->monto_total;
            $monto_gift_card = $datos_factura->monto_gift_card;
            $monto_pagar = $datos_factura->monto_pagar;
            $monto_sujeto_iva = $datos_factura->monto_sujeto_iva;
            $tipo_emision = $datos_factura->tipo_emision;
            $fraccion = $datos_factura->fraccion;
            $importe_total=number_format($importe_total,2,'.','');  
            $codigo_moneda = $datos_factura->codigo_moneda;
            $tipo_cambio = $datos_factura->codigo_tipo_cambio;
            $descripcion_moneda = '';
            if($codigo_moneda != '1'){
                $descripcion_moneda = $datos_factura->descripcion_moneda;
            }
            $literal = $datos_factura->literal;
            $leyenda = $datos_factura->leyenda;
            //$monto_recibido = $datos_factura->monto_recibido;
            //$monto_cambio = $datos_factura->monto_cambio;
            $llamar_por = $datos_factura->llamar_por;
            $ver_pdf_carta = $datos_factura->ver_pdf_carta;
            $listProductos = json_encode($res->detalle_productos);
            $res= json_encode($res);
            $leyenda_on_off='';
            $leyenda_online='“Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido en una modalidad de facturación en línea”';
            $leyenda_offline='“Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido fuera de línea, verifique su envío con su proveedor o en la página web www.impuestos.gob.bo”';
            if($tipo_emision == '1'){
                $leyenda_on_off = $leyenda_online;
            }else{
                $leyenda_on_off = $leyenda_offline;
            }
            $data['json'] = '{"datos_factura":{"ver_pdf_carta":"'.$ver_pdf_carta.'","codigo_sucursal":"'.$codigo_sucursal.'","tipo_emision":"'.$tipo_emision.'","razon_social_emisor":"'.$razon_social_emisor.'","municipio_emisor":"'.$municipio_emisor.'","nit_emisor":"'.$nit_emisor.'","direccion_emisor":"'.$direccion_emisor.'","telefono_emisor":"'.$telefono_emisor.'","punto_venta":"'.$punto_venta.'","id_producto":'.$id_producto.',"numero_factura":'.$numero_factura.',"numero_pedido":'.$numero_pedido.',"fecha_hora":"'.$fecha_hora.'","nombre_usuario":"'.$nombre_usuario.'","facturar_cliente_a":"'.$facturar_cliente_a.'","nombre_cliente":"'.$nombre_cliente.'","nit_cliente":"'.$nit_cliente.'","importe_total":'.$importe_total.',"subtotal":'.$subtotal.',"descuento":'.$descuento.',"total":'.$total.',"monto_gift_card":'.$monto_gift_card.',"monto_pagar":'.$monto_pagar.',"monto_sujeto_iva":'.$monto_sujeto_iva.',"descripcion_moneda":"'.$descripcion_moneda.'","tipo_cambio":"'.$tipo_cambio.'","literal":"'.$literal.'","fraccion":"'.$fraccion.'","llamar_por":"'.$llamar_por.'","fecha":"'.$fecha.'","leyenda":"'.$leyenda.'","datetime":"'.$dateTime.'","nit_emisor":"'.$nit_emisor.'","codigoCuf":"'.$codigoCuf.'","id_cliente":"'.$id_cliente.'","url_siat":"'.$urlSiat.'","leyenda_on_off":"'.$leyenda_on_off.'"},"detalle_productos":'.$listProductos.'}';
            //var_dump($data);
            $this->load->view('impresion/factura_carta_anulada', $data, FALSE);
            
            if($tipo_emision == '1'){
                    $email_cliente='goe.alcon@gmail.com';
                    $this->enviarCorreoAnulado($telefono_emisor, $correo_info, $direccion_info, $pagina_web, $numero_factura, $email_cliente,$codigoCuf);
          }
        }
        function imprimirFacturaAnuladaRollo($id_venta){
        $objeto_factura = $this->obtenerArchivoObjeto($id_venta);
        $res = json_decode($objeto_factura);
        $datos_factura = $res->datos_factura;
        $id_producto = $datos_factura->id_producto;
        $razon_social_emisor = $datos_factura->razon_social_emisor;
        $municipio_emisor = $datos_factura->municipio_emisor;
        $nit_emisor = $datos_factura->nit_emisor;
        $punto_venta = $datos_factura->punto_venta;
        $direccion_emisor = $datos_factura->direccion_emisor;
        $telefono_emisor = $datos_factura->telefono_emisor;
        $codigo_sucursal = $datos_factura->codigo_sucursal;

        $correo_info = $datos_factura->correo_info;
        $direccion_info = $datos_factura->direccion_info;
        $pagina_web = $datos_factura->pagina_web;

        $numero_factura = $datos_factura->numero_factura;
        $numero_pedido = $datos_factura->numero_pedido;
        $codigoCuf = $datos_factura->codigoCuf;
        $urlSiat = $datos_factura->url_siat;
        $numero_autorizacion ='';
        $dateTime = $datos_factura->datetime;
        $fecha = explode("T", $dateTime);
        $fecha_1 = explode("-", $fecha[0]);
        $ges=$fecha_1[0];
        $mes=$fecha_1[1];
        $dia=$fecha_1[2];
        $fecha_1= $dia.'/'.$mes.'/'.$ges;
        $hora = str_replace('.000','',$fecha[1]);
        $fecha_hora = $fecha_1.' '.$hora;
        $fecha = $datos_factura->fecha;
        $nombre_usuario = $datos_factura->nombre_usuario;
        //$nombre_usuario = $this->getIniciales($nombre_usuario);
        $nombre_cliente =$datos_factura->nombre_cliente;
        $facturar_cliente_a =$datos_factura->facturar_cliente_a;
        $nit_cliente = $datos_factura->nit_cliente;
        $complemento_ci =trim($datos_factura->complemento_ci);
        if($complemento_ci != ''){
            $nit_cliente = $nit_cliente.'-'.$complemento_ci;
        }
        
        $id_cliente = $datos_factura->id_cliente;
        $importe_total = $datos_factura->importe_total;
        $subtotal = $datos_factura->subtotal;
        $descuento = $datos_factura->descuento_adicional;
        $total = $datos_factura->monto_total;
        $monto_gift_card = $datos_factura->monto_gift_card;
        $monto_pagar = $datos_factura->monto_pagar;
        $monto_sujeto_iva = $datos_factura->monto_sujeto_iva;
        $tipo_emision = $datos_factura->tipo_emision;
        $fraccion = $datos_factura->fraccion;
        $importe_total=number_format($importe_total,2,'.','');  
        $codigo_moneda = $datos_factura->codigo_moneda;
        $tipo_cambio = $datos_factura->codigo_tipo_cambio;
        $descripcion_moneda = '';
        if($codigo_moneda != '1'){
            $descripcion_moneda = $datos_factura->descripcion_moneda;
        }
        $literal = $datos_factura->literal;
        $leyenda = $datos_factura->leyenda;
        //$monto_recibido = $datos_factura->monto_recibido;
        //$monto_cambio = $datos_factura->monto_cambio;
        $llamar_por = $datos_factura->llamar_por;
        $ver_pdf_rollo = $datos_factura->ver_pdf_rollo;
        $listProductos = json_encode($res->detalle_productos);
        $res= json_encode($res);
        $leyenda_on_off='';
        $leyenda_online='“Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido en una modalidad de facturación en línea”';
        $leyenda_offline='“Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido fuera de línea, verifique su envío con su proveedor o en la página web www.impuestos.gob.bo”';
        if($tipo_emision == '1'){
            $leyenda_on_off = $leyenda_online;
        }else{
            $leyenda_on_off = $leyenda_offline;
        }
        $data['json']='{"datos_factura":{"ver_pdf_rollo":"'.$ver_pdf_rollo.'","codigo_sucursal":"'.$codigo_sucursal.'","razon_social_emisor":"'.$razon_social_emisor.'","municipio_emisor":"'.$municipio_emisor.'","nit_emisor":"'.$nit_emisor.'","direccion_emisor":"'.$direccion_emisor.'","telefono_emisor":"'.$telefono_emisor.'","punto_venta":'.$punto_venta.',"id_producto":'.$id_producto.',"numero_factura":'.$numero_factura.',"numero_pedido":'.$numero_pedido.',"fecha_hora":"'.$fecha_hora.'","nombre_usuario":"'.$nombre_usuario.'","facturar_cliente_a":"'.$facturar_cliente_a.'","nombre_cliente":"'.$nombre_cliente.'","nit_cliente":"'.$nit_cliente.'","importe_total":'.$importe_total.',"subtotal":'.$subtotal.',"descuento":'.$descuento.',"total":'.$total.',"monto_gift_card":'.$monto_gift_card.',"monto_pagar":'.$monto_pagar.',"monto_sujeto_iva":'.$monto_sujeto_iva.',"descripcion_moneda":"'.$descripcion_moneda.'","tipo_cambio":"'.$tipo_cambio.'","literal":"'.$literal.'","fraccion":"'.$fraccion.'","llamar_por":"'.$llamar_por.'","fecha":"'.$fecha.'","leyenda":"'.$leyenda.'","datetime":"'.$dateTime.'","nit_emisor":"'.$nit_emisor.'","codigoCuf":"'.$codigoCuf.'","id_cliente":"'.$id_cliente.'","url_siat":"'.$urlSiat.'","leyenda_on_off":"'.$leyenda_on_off.'"},"detalle_productos":'.$listProductos.'}';
        //var_dump($data);
        $this->load->view('impresion/factura_rollo_anulada', $data, FALSE);
        
        //if($tipo_emision == '1'){
            /*
            if(!isset($_SESSION['registroModoOffline'])){
                $this->enviarCorreoAnulado($telefono_emisor, $correo_info, $direccion_info, $pagina_web, $numero_factura, $email_cliente,$codigoCuf);
            }*/
        }

        function enviarCorreoAnulado($telefono_emisor, $correo_info, $direccion_info, $pagina_web, $nroFactura, $email_cliente, $codigoCuf){
            $nombreEmpresa='CAPRESSO SRL';
            $ciudad='Cochabamba - Bolivia';
            $correoEmpresa='facturacion.capresso@outlook.com';
            $rutaXml=$_SERVER['DOCUMENT_ROOT'].NAME_DIR.'assets/facturas/firmado/'.$nroFactura.'.xml';
            $rutaPdf=$_SERVER['DOCUMENT_ROOT'].NAME_DIR.'assets/facturas/pdf/factura.pdf';
            $ress=$this->enviarmail->enviarCorreoAnulado($nroFactura,$nombreEmpresa,$telefono_emisor,$correo_info,$direccion_info,$ciudad,$pagina_web,$email_cliente,$correoEmpresa,$rutaXml,$rutaPdf,$codigoCuf);
         }

        
    
    }
    