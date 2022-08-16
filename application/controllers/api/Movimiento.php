<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Movimiento extends CI_Controller {
    
        public function index()
        {
            $tipo = $this->input->post('tipo');

                          $this->db->where('TIPO', $tipo);
            $movimientos = $this->main->getListSelect('VENTAS_DESCRIPCION_IE vd', 'ID_VENTAS_DESCRIPCION_IE, DESCRIPCION, TIPO, ESTADO_MOTIVO');

            echo json_encode($movimientos);
        }

        public function guardar_movimiento(){
            $id_usuario = $this->session->userdata('id_usuario');
            $nombre_usuario = $this->session->userdata('nombre');
            $ruta_anterior = 'http://'.$_POST['ruta'];

            $ingreso_egreso = $_POST['ingreso_egreso'];
            $tipo_movimiento = $_POST['tipo_movimiento'];
            $descripcionIE= $this->getDescripcionTipoMovimiento($tipo_movimiento);
            $monto = $_POST['monto'];
            $descripcion = ' ';
            $valor_tipo_ingreso= null;
            if($ingreso_egreso =='I'){
                $valor_tipo_ingreso = 1;
                $sms=3;
            }else if($ingreso_egreso == 'E'){
                $valor_tipo_ingreso = 0;
                $sms=4;
            }
            $descripcion='';
            if(isset($_POST['descripcion'])){
                $descripcion = $_POST['descripcion'];
            }
            $fecha = date("Y-m-d");
            $fechaConv = date("d/m/Y");
            $hora = date("H:i:s");
            $tipo_usuario = $this->session->userdata('tipo_usuario');
            $nameImpresora = 'EPSON TM-T20III Receipt';
            $objetoIngresoEgresoCaja = new stdClass();
            $objetoIngresoEgresoCaja->impresora = $nameImpresora;
            $objetoIngresoEgresoCaja->usuario = $nombre_usuario;
            $objetoIngresoEgresoCaja->monto = $monto;
            $objetoIngresoEgresoCaja->descripcion = $descripcion;
            $objetoIngresoEgresoCaja->descripcionIE = $descripcionIE;
            $objetoIngresoEgresoCaja->fecha = $fechaConv;
            $objetoIngresoEgresoCaja->hora = $hora;
            $objetoIngresoEgresoCaja->sucursal = SUCURSAL;
            $objetoIngresoEgresoCaja->tipo_ie = $ingreso_egreso;
            $objetoIngresoEgresoCaja->tipo_print = 'print-movimiento';
            $res=json_encode($objetoIngresoEgresoCaja);
            try
            {
                $conn = $this->OpenConnection();
                $sql = "EXEC ".PRE_SUC."REGISTRO_INGRESO_EGRESO ".$id_usuario.", '".$fecha."', '".$hora."', ".$valor_tipo_ingreso.", ".$monto.", '".$descripcion."', ".$tipo_movimiento;

                if(sqlsrv_query($conn, $sql)){
                    $this->session->set_flashdata('msg-success', 'Se ha guardado la operación realizada.');
                    $this->session->set_userdata('data-imprimir', $res);
                    redirect('generico/inicio','refresh');
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

        function getDescripcionTipoMovimiento($id){
            $res = '';
            $sql= "select * from VENTAS_DESCRIPCION_IE where ID_VENTAS_DESCRIPCION_IE = '$id';";
            $respuesta = $this->main->getQuery($sql);
            if(count($respuesta)==1){
                $res = $respuesta[0]->DESCRIPCION;
            }
            return $res;
        }
    
    }
    
    /* End of file Movimiento.php */
    