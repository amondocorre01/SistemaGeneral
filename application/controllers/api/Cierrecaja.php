<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cierrecaja extends CI_Controller {
        public function __construct()
	    {
            parent::__construct();
            $this->load->library('session');
            $this->load->library('form_validation');
	    }
    
        public function register()
        {   
            $tipo_usuario = $this->session->userdata('tipo_usuario');
            $id_usuario = $this->session->userdata('id_usuario');
            $nombre_usuario = $this->session->userdata('nombre');
            $ruta_anterior = 'http://'.$_POST['ruta'];
            $monto_cierre = $this->input->post('cierre');
            $id_ca = $_SESSION['id_apertura_turno'];
            $monto_total_ingresos = $this->getIngresos($id_ca);
            $monto_total_egresos = $this->getEgresos($id_ca);
            $monto_total_anticipos = 0;  
            $monto_total_ventas_efectivo = $this->getTotalImporteTotalEfectivo();
            $monto_total_ventas_no_efectivo = $this->getTotalImporteTotalNoEfectivo();
            $fecha_cierre = date("Y-m-d");
            $hora_cierre = date("H:i:s");
            $objetoCierreCaja = new stdClass();
            $objetoCierreCaja->usuario = $nombre_usuario;

            $turno=$this->getCierreAperturaTurno();
            $bd='ventas';
            $sufijo = SUF_SUC;
            $rangoFacturas = $this->rangoFacturas($bd, $sufijo, $id_ca);
            $cantidadRecibos = $this->cantidadRecibos();
            $totalVentasTarjetaDC = $this->totalVentasTarjetaDC();

            
            if(count($turno)==1){
                $id_turno = $turno[0]->ID_CIERRE_APERTURA_TURNO;
                $monto_apertura = $turno[0]->MONTO_APERTURA;
                $fecha = $turno[0]->FECHA;
                $hora_apertura = $turno[0]->HORA_APERTURA;
            }

            $objetoCierreCaja->monto_inicial = $monto_apertura;
            $objetoCierreCaja->fecha_apertura = $fecha;
            $objetoCierreCaja->horario_apertura = $hora_apertura;
            $objetoCierreCaja->monto_cierre = $monto_cierre;
            $objetoCierreCaja->total_ingresos = $monto_total_ingresos;
            $objetoCierreCaja->total_egresos = $monto_total_egresos;
            $objetoCierreCaja->fecha_cierre = $fecha_cierre;
            $objetoCierreCaja->hora_cierre = $hora_cierre;
            $objetoCierreCaja->monto_total_ventas_efectivo = $monto_total_ventas_efectivo;
            $objetoCierreCaja->monto_total_ventas_no_efectivo = $monto_total_ventas_no_efectivo;
            $objetoCierreCaja->sucursal = SUCURSAL;
            $objetoCierreCaja->rangoFacturas = $rangoFacturas;
            $objetoCierreCaja->cantidadRecibos = $cantidadRecibos;
            $objetoCierreCaja->totalVentasTarjetaDC = $totalVentasTarjetaDC;

            $res=json_encode($objetoCierreCaja);
            try
            {
                $conn = $this->OpenConnection();
                $sql = "EXEC ".PRE_SUC."CIERRE_APERTURA_TURNO '$id_usuario', '$monto_cierre','$monto_total_ingresos','$monto_total_egresos','$hora_cierre','$fecha_cierre','$monto_total_ventas_efectivo','$monto_total_ventas_no_efectivo';";
                if(sqlsrv_query($conn, $sql)){
                    $this->session->unset_userdata('acceso_menu_ventas');
                    $this->session->unset_userdata('id_apertura_turno');
                    $this->session->set_flashdata('msg-success', 'Se ha guardado la operación realizada.');
		            $lk=base_url();
                    $this->session->set_userdata('data-imprimir', $res);
                    $this->session->set_userdata('cerrar-sesion', '1');
                    $this->eliminarSesion();
                    redirect('login/index','refresh');
                    return;
                }else{
                    $this->session->set_flashdata('msg', 'Ocurrio un error inesperado.');
                    header('Location: '.$ruta_anterior);
                    die();
                }
                sqlsrv_close($conn);
            }
            catch(Exception $e)
            {
                $this->session->set_flashdata('msg', 'Ocurrio un error inesperado.');
                header('Location: '.$ruta_anterior);
                die();
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

        function getIngresos($bd, $prefijo, $sufijo, $id){
            $res=0;
            $sql = "EXEC ".$prefijo."SUMA_INGRESOS '$id';";
            //$respuesta = $this->main->getQuery($sql);
            $DB2 = $this->load->database($bd, TRUE);
            $respuesta = $DB2->query($sql);
            $respuesta = $respuesta->result();
            if(count($respuesta)==1){
                $res = $respuesta[0]->ingresos;
                if($res ==null){
                    $res=0;
                }
            }
            return $res;
        }

        function getEgresos($bd, $prefijo, $sufijo, $id){
            $res=0;
            $sql = "EXEC ".$prefijo."SUMA_EGRESOS '$id';";
            //$respuesta = $this->main->getQuery($sql);
            $DB2 = $this->load->database($bd, TRUE);
            $respuesta = $DB2->query($sql);
            $respuesta = $respuesta->result();
            if(count($respuesta)==1){
                $res = $respuesta[0]->egresos;
                if($res ==null){
                    $res=0;
                }
            }
            return $res;
        }

        function getIdCierreAperturaTurno(){
            $res=null;
            $sql= "EXEC ".PRE_SUC."GET_CIERRE_APERTURA_TURNO ;";
            $respuesta = $this->main->getQuery($sql);
            if(count($respuesta)==1){
                $res = $respuesta[0]->ID_CIERRE_APERTURA_TURNO;
            }
            return $res;
        }

        function getCierreAperturaTurno(){
            $res=null;
            $sql = "EXEC ".PRE_SUC."GET_DATOS_TURNO ;";
            $respuesta = $this->main->getQuery($sql);
            return $respuesta;
        }
        
        function getTotalImporteTotalEfectivo(){
            $res=0;
            $id_usuario = $this->session->userdata('id_usuario');
            $fecha = date("Y-m-d");
            $sql = "EXEC ".PRE_SUC."GET_IMPORTE_TOTAL_EFECTIVO '$fecha','$id_usuario' ;";
            $respuesta = $this->main->getQuery($sql);
            if(count($respuesta)==1){
                $res = intval($respuesta[0]->total);
            }
            return $res;
        }

        function getTotalImporteTotalNoEfectivo(){
            $res=0;
            $id_usuario = $this->session->userdata('id_usuario');
            $fecha = date("Y-m-d");
            $sql = "EXEC ".PRE_SUC."GET_IMPORTE_TOTAL_NO_EFECTIVO '$fecha','$id_usuario' ;";
            $respuesta = $this->main->getQuery($sql);
            if(count($respuesta)==1){
                $res = intval($respuesta[0]->total);
            }
            return $res;
        }

        function rangoFacturas($bd, $sufijo, $id_turno){
            $res='';
            $sql = "select ISNULL(MIN(NUMERO_FACTURADO),0) as MINIMO, ISNULL(MAX(NUMERO_FACTURADO),0) as MAXIMO FROM VENTA_DOCUMENTO".$sufijo."  WHERE ID_TURNO = '$id_turno' AND FACTURADO = 1 ;";
            //$respuesta = $this->main->getQuery($sql);
            $DB2 = $this->load->database($bd, TRUE);
            $respuesta = $DB2->query($sql);
            $respuesta = $respuesta->result();
            if(count($respuesta)==1){
                $min = $respuesta[0]->MINIMO;
                $max = $respuesta[0]->MAXIMO;
                $res= $min.'-'.$max;
            }
            return $res;
        }
        
        function cantidadRecibos($bd, $sufijo, $id_turno){
            $res=0;
            $sql = "select count(*) as CANTIDAD_RECIBOS from VENTA_DOCUMENTO".$sufijo." WHERE ID_TURNO = '$id_turno' and FACTURADO =0;";
            //$respuesta = $this->main->getQuery($sql);
            $DB2 = $this->load->database($bd, TRUE);
            $respuesta = $DB2->query($sql);
            $respuesta = $respuesta->result();
            if(count($respuesta)==1){
                $res = $respuesta[0]->CANTIDAD_RECIBOS;
            }
            return $res;
        }

        function totalVentasTarjetaDC(){
            $id_turno = $this->session->userdata('id_apertura_turno');
            $res=0;
            $sql = "select ISNULL(SUM(IMPORTE_TOTAL),0) as TOTAL_DEBITO_CREDITO from VENTA_DOCUMENTO".SUF_SUC." WHERE ID_TURNO ='$id_turno' AND ID_FORMA_PAGO = '2';";
            $respuesta = $this->main->getQuery($sql);
            if(count($respuesta)==1){
                $res = $respuesta[0]->TOTAL_DEBITO_CREDITO;
            }
            return $res;
        }

        function totalVentasTransferencias(){
            $id_turno = $this->session->userdata('id_apertura_turno');
            $res=0;
            $sql = "select ISNULL(SUM(IMPORTE_TOTAL),0) as TOTAL_TRANSFERENCIAS from VENTA_DOCUMENTO".SUF_SUC." WHERE ID_TURNO ='$id_turno' AND ID_FORMA_PAGO = '3';";
            $respuesta = $this->main->getQuery($sql);
            if(count($respuesta)==1){
                $res = $respuesta[0]->TOTAL_TRANSFERENCIAS;
            }
            return $res;
        }

        function totalVentasQR(){
            $id_turno = $this->session->userdata('id_apertura_turno');
            $res=0;
            $sql = "select ISNULL(SUM(IMPORTE_TOTAL),0) as TOTAL_QR from VENTA_DOCUMENTO".SUF_SUC." WHERE ID_TURNO ='$id_turno' AND ID_FORMA_PAGO = '4';";
            $respuesta = $this->main->getQuery($sql);
            if(count($respuesta)==1){
                $res = $respuesta[0]->TOTAL_QR;
            }
            return $res;
        }
        function eliminarSesion(){
            $res=false;
            try
                {
                    $conn = $this->OpenConnection();
                    $sql = "delete from SESION_USUARIO".SUF_SUC." ;";
                    if(sqlsrv_query($conn, $sql)){
                        $res= true;
                    }
                    sqlsrv_close($conn);
                }
                catch(Exception $e)
                {
                    echo("Error!");
                }
            return $res;
        }

        function ver_detalle_turno(){
            $id_turno = $this->input->post('turno');
            $usuario = $this->input->post('usuario');
            $bd = $this->input->post('bd');
            $sufijo = $this->input->post('sufijo');
            $prefijo = $this->input->post('prefijo');
            $descripcion_sucursal = $this->input->post('descripcion_sucursal');
            $turno = $this->getTurno($bd, $sufijo, $id_turno);
            $rangoFacturas = $this->rangoFacturas($bd, $sufijo, $id_turno);
            $cantidadRecibos = $this->cantidadRecibos($bd, $sufijo, $id_turno);
            $monto_apertura = floatval($turno->MONTO_APERTURA);
            $monto_total_ingresos = floatval($this->getIngresos($bd, $prefijo, $sufijo, $id_turno));
            $monto_total_egresos = floatval($this->getEgresos($bd, $prefijo, $sufijo, $id_turno));

            $fecha_apertura = $turno->FECHA;
            $fecha = explode("-", $fecha_apertura);
            $ges=$fecha[0];
            $mes=$fecha[1];
            $dia=$fecha[2];
            $fecha_apertura= $dia.'/'.$mes.'/'.$ges;
            $horario_apertura = $turno->HORA_APERTURA;
            $monto_cierre = $turno->MONTO_CIERRE;
            $fecha_cierre = $turno->FECHA_CIERRE;
            if($fecha_cierre){
                $fecha = explode("-", $fecha_cierre);
                $ges=$fecha[0];
                $mes=$fecha[1];
                $dia=$fecha[2];
                $fecha_cierre= $dia.'/'.$mes.'/'.$ges;
                $hora_cierre = $turno->HORA_CIERRE;
            }else{
                $fecha_cierre ='';
                $hora_cierre = '';
            }
            $monto_total_ventas_efectivo = floatval($this->getTotalTurno($bd, $sufijo, $id_turno,'EFECTIVO'));
            $monto_total_ventas_no_efectivo = floatval($this->getTotalTurnoNoEfectivo($bd, $sufijo, $id_turno));
            $monto_total_ventas_pago_qr = floatval($this->getTotalTurno($bd, $sufijo, $id_turno,'PAGO ONLINE'));
            $monto_total_ventas_tarjeta = floatval($this->getTotalTurno($bd, $sufijo, $id_turno,'TARJETA'));
            $monto_total_ventas_transferencia_bancaria = floatval($this->getTotalTurno($bd, $sufijo, $id_turno,'TRANSFERENCIA BANCARIA'));
            $monto_total_ventas_cupon_pedidos_ya = floatval($this->getTotalCupon($bd, $sufijo, $id_turno));
            $monto_total_ventas_gift_card = floatval($this->getTotalTurno($bd, $sufijo, $id_turno,'GIFT-CARD'));
            $saldo_teorico = $monto_apertura+$monto_total_ingresos-$monto_total_egresos+$monto_total_ventas_efectivo;
            $monto_cierre = floatval($monto_cierre);
            $descuadre = $monto_cierre - $saldo_teorico;
            
            echo "<center><b>CAPRESSO S.R.L";
            echo '<br>';
            echo $descripcion_sucursal;
            echo '<br>';
            echo "ARQUEO DE CAJA POR TURNO";
            echo '</b><br>';
            
            echo "--------------------------------------";
            echo '<br></center>';
            echo '<table border="1" class="table table-bordered table-striped tablaDetalleTurno">
                    <tr>
                        <td><b>Usuario</b></td>
                        <td>'.$usuario.'</td>
                    </tr>
                    <tr>
                        <td><b>Fecha/Hora Ingreso: </b></td>
                        <td>'.$fecha_apertura."  ".$horario_apertura.'</td>
                    </tr>
                    <tr>
                        <td><b>Fecha/Hora Salida: </b></td>
                        <td>'.$fecha_cierre."  ".$hora_cierre.'</td>
                    </tr>
                    <tr>
                        <td><b>Rango de facturas: </b></td>
                        <td>'.$rangoFacturas.'</td>
                    </tr>
                    <tr>
                        <td><b>Cantidad de Recibos: </b></td>
                        <td>'.$cantidadRecibos.'</td>
                    </tr>
                    <tr>
                        <td><b>Monto inicial de turno: </b></td>
                        <td>'.$monto_apertura.'</td>
                    </tr>
                    
                    <tr>
                        <td><b>Total Ingresos: </b></td>
                        <td>'.$monto_total_ingresos.'</td>
                    </tr>
                    <tr>
                        <td><b>Total Egresos: </b></td>
                        <td>'.$monto_total_egresos.'</td>
                    </tr>
                    <tr>
                        <td><b>Total ventas en efectivo: </b></td>
                        <td>'.$monto_total_ventas_efectivo.'</td>
                    </tr>
                    <tr>
                        <td><b>Total ventas en QR: </b></td>
                        <td>'.$monto_total_ventas_pago_qr.'</td>
                    </tr>
                    <tr>
                        <td><b>Total ventas Tarj. Deb/Cred: </b></td>
                        <td>'.$monto_total_ventas_tarjeta.'</td>
                    </tr>
                    <tr>
                        <td><b>Total ventas Transferencia: </b></td>
                        <td>'.$monto_total_ventas_transferencia_bancaria.'</td>
                    </tr>
                    <tr>
                        <td><b>Total cupones Pedidos Ya: </b></td>
                        <td>'.$monto_total_ventas_cupon_pedidos_ya.'</td>
                    </tr>
                    <tr>
                        <td><b>Saldo teorico: </b></td>
                        <td>'.$saldo_teorico.'</td>
                    </tr>
                    <tr>
                        <td><b>Dinero entregado: </b></td>
                        <td>'.$monto_cierre.'</td>
                    </tr>
                    <tr>
                        <td><b>Descuadre: </b></td>
                        <td>'.$descuadre.'</td>
                    </tr>
                </table>';
        }
        function getTurno($bd, $sufijo_sucursal, $id_turno){
            $res=null;
            $sql = "select * from CIERRE_APERTURA_TURNO".$sufijo_sucursal." where ID_CIERRE_APERTURA_TURNO = '$id_turno' ;";
            $DB2 = $this->load->database($bd, TRUE);
            $respuesta = $DB2->query($sql);
            $respuesta = $respuesta->result();
            return $respuesta[0];
        }

        function getTotalTurno($bd, $sufijo_sucursal, $id_turno, $filtro){
            $res=0;
            $sql = "select CASE WHEN (SUM(monto)) IS NULL THEN 0 ELSE (SUM(monto)) END as TOTAL from VENTA_PAGO".$sufijo_sucursal." vps where DESCRIPCION_PAGO ='$filtro' and  vps.ID_VENTA_DOCUMENTO in (select ID_VENTA_DOCUMENTO  from VENTA_DOCUMENTO".$sufijo_sucursal." vds where ANULADO='0' and ID_TURNO = '$id_turno');";
            $DB2 = $this->load->database($bd, TRUE);
            $respuesta = $DB2->query($sql);
            $respuesta = $respuesta->result();
            if(count($respuesta)==1){
                $res = $respuesta[0]->TOTAL;
            }
            return $res;
        }
        function getTotalCupon($bd, $sufijo_sucursal, $id_turno){
            $res=0;
            $sql = "select CASE WHEN (SUM(monto)) IS NULL THEN 0 ELSE (SUM(monto)) END as TOTAL from VENTA_PAGO".$sufijo_sucursal." vps where DESCRIPCION_PAGO like '%CUPON%' and  vps.ID_VENTA_DOCUMENTO in (select ID_VENTA_DOCUMENTO  from VENTA_DOCUMENTO".$sufijo_sucursal." vds where ANULADO='0' and ID_TURNO = '$id_turno');";
            $DB2 = $this->load->database($bd, TRUE);
            $respuesta = $DB2->query($sql);
            $respuesta = $respuesta->result();
            if(count($respuesta)==1){
                $res = $respuesta[0]->TOTAL;
            }
            return $res;
        }

        function getTotalTurnoNoEfectivo($bd, $sufijo_sucursal, $id_turno){
            $res=0;
            $sql = "select CASE WHEN (SUM(monto)) IS NULL THEN 0 ELSE (SUM(monto)) END as TOTAL from VENTA_PAGO".$sufijo_sucursal." vps where DESCRIPCION_PAGO !='EFECTIVO' and  vps.ID_VENTA_DOCUMENTO in (select ID_VENTA_DOCUMENTO  from VENTA_DOCUMENTO".$sufijo_sucursal." vds where ANULADO='0' and ID_TURNO = '$id_turno');";
            $DB2 = $this->load->database($bd, TRUE);
            $respuesta = $DB2->query($sql);
            $respuesta = $respuesta->result();
            if(count($respuesta)==1){
                $res = $respuesta[0]->TOTAL;
            }
            return $res;
        }


    }
