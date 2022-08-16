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
            $rangoFacturas = $this->rangoFacturas();
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

        function getIngresos($id){
            $res=0;
            $sql = "EXEC ".PRE_SUC."SUMA_INGRESOS '$id';";
            $respuesta = $this->main->getQuery($sql);
            if(count($respuesta)==1){
                $res = $respuesta[0]->ingresos;
                if($res ==null){
                    $res=0;
                }
            }
            return $res;
        }

        function getEgresos($id){
            $res=0;
            $sql = "EXEC ".PRE_SUC."SUMA_EGRESOS '$id';";
            $respuesta = $this->main->getQuery($sql);
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

        function rangoFacturas(){
            $id_turno = $this->session->userdata('id_apertura_turno');
            $res='';
            $sql = "select ISNULL(MIN(NUMERO_FACTURADO),0) as MINIMO, ISNULL(MAX(NUMERO_FACTURADO),0) as MAXIMO FROM VENTA_DOCUMENTO".SUF_SUC."  WHERE ID_TURNO = '$id_turno' AND FACTURADO = 1 ;";
            $respuesta = $this->main->getQuery($sql);
            if(count($respuesta)==1){
                $min = $respuesta[0]->MINIMO;
                $max = $respuesta[0]->MAXIMO;
                $res= $min.'-'.$max;
            }
            return $res;
        }
        
        function cantidadRecibos(){
            $id_turno = $this->session->userdata('id_apertura_turno');
            $res=0;
            $sql = "select count(*) as CANTIDAD_RECIBOS from VENTA_DOCUMENTO".SUF_SUC." WHERE ID_TURNO = '$id_turno' and FACTURADO =0;";
            $respuesta = $this->main->getQuery($sql);
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

    }
