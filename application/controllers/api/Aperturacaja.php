<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Aperturacaja extends CI_Controller {
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
            $monto_apertura = $this->input->post('apertura');
            $id_menu_vc = $this->input->post('id_vc');
            $cerrado = '0';
            $fecha = date("Y-m-d");
            $hora_apertura = date("H:i:s");
            $nameImpresora = 'EPSON TM-T20III Receipt';
            $objetoAperturaCaja = new stdClass();
            $objetoAperturaCaja->impresora = $nameImpresora;
            $objetoAperturaCaja->usuario = $nombre_usuario;
            $objetoAperturaCaja->monto_inicial = $monto_apertura;
            $objetoAperturaCaja->fecha_apertura = $fecha;
            $objetoAperturaCaja->horario_apertura = $hora_apertura;
            $objetoAperturaCaja->sucursal = SUCURSAL;
            $objetoAperturaCaja->tipo_print = 'print-apertura-caja';

            $res=json_encode($objetoAperturaCaja);
            try
            {
                $conn = $this->OpenConnection();
                if(isset($_SESSION['monto_apertura_pendiente'])){
                    $id_apertura_turno = $_SESSION['id_apertura_turno'];
                    $sql = "EXEC ".PRE_SUC."REGISTRO_PENDIENTE_TURNO '$monto_apertura','$id_apertura_turno' ;";
                }else{
                    $sql = "EXEC ".PRE_SUC."REGISTRO_NUEVO_TURNO ".$id_usuario.", ".$monto_apertura.",'".$fecha."','".$hora_apertura."';";
                }
                if(sqlsrv_query($conn, $sql)){
                    $this->session->set_userdata('acceso_menu_ventas', 'accept' );
                    $this->session->unset_userdata('notification_ac');
                    $this->session->unset_userdata('notification_ac_link');
                    if(isset($_SESSION['monto_apertura_pendiente'])){
                        $this->session->unset_userdata('monto_apertura_pendiente');
                    }
                    $id_apertura_turno = $this->getIdAperturaTurno(); 
                    $this->session->set_userdata('id_apertura_turno', $id_apertura_turno);
                    $this->session->set_userdata('data-imprimir', $res);
                    redirect('generico/inicio','refresh');
                }else{
                    $this->session->set_flashdata('msg', 'Ocurrio un error inesperado.');
                    redirect('generico/inicio?vc='.$id_menu_vc,'refresh');
                }
                sqlsrv_close($conn);
            }
            catch(Exception $e)
            {
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

        public function pendiente()
        {
            $id_usuario = $this->session->userdata('id_usuario');
            $tipo_usuario = $this->session->userdata('tipo_usuario');
            $cerrado = '0';
            $fecha = date("Y-m-d");
            $hora_apertura = date("H:i:s");
            try
            {
                $conn = $this->OpenConnection();
                $sql = "EXEC ".PRE_SUC."APERTURA_PENDIENTE_TURNO '$id_usuario','$fecha','$hora_apertura' ;"; 
                if(sqlsrv_query($conn, $sql)){
                    $this->session->set_userdata('acceso_menu_ventas', 'deny' );
                    $this->session->set_userdata('notification_ac', 'Atencion: Esta pendiente el registro del monto con el ingreso del turno. Para registrar la informacion ingrese en el menu lateral en la opcion APERTURA DE CAJA.');
                    $this->session->set_userdata('monto_apertura_pendiente', '1' );
                    $id_apertura_turno = $this->getIdAperturaTurno(); 
                    $this->session->set_userdata('id_apertura_turno', $id_apertura_turno);
                    $url= base_url('index.php/generico/inicio');
                    $this->session->set_userdata('notification_ac_link');
                    redirect('generico/inicio','refresh');
                }else{

                }
                sqlsrv_close($conn);
            }
            catch(Exception $e)
            {
                echo("Error!");
            }
                
        }
        function getIdAperturaTurno(){
            $res = null;
            $sql= "EXEC ".PRE_SUC."GET_CIERRE_APERTURA_TURNO";
            $respuesta = $this->main->getQuery($sql);
            if(count($respuesta)==1){
                $res = $respuesta[0]->ID_CIERRE_APERTURA_TURNO;
            }
            return $res;
        }

        function getCierreAperturaTurno(){
            $res=null;
            $id_usuario = $this->session->userdata('id_usuario');
            $sql = "EXEC ".PRE_SUC."GET_DATOS_TURNO ;";
            $respuesta = $this->main->getQuery($sql);
            return $respuesta;
        }
       
    }
