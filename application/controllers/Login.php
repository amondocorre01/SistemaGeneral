<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');

	}

    public function index()
	{	
		if(isset($_SESSION['loggin'])){
			if(isset($_SESSION['cerrar-sesion'])){
				$this->load->view('login/login', null, FALSE);
			}else{
				redirect('generico/inicio','refresh');
			}
		}else{
			$this->load->view('login/login', null, FALSE);
		}
	}

    public function inicio()
	{	
		$acceso = false;
		$sucursal= $this->getSucursal(IP_SUCURSAL);
		if(count($sucursal)==1){
			foreach ($sucursal as $row)
			{
				$id_ubicacion = $row->ID_UBICACION;
				$descripcion = $row->DESCRIPCION;
				$tipo = $row->TIPO;
				$correo = $row->CORREO;
				$impresora = $row->IMPRESORA;
				$ip_disponible = $row->IP_DISPONIBLE;
			}
			if($ip_disponible ==1){
				$current_ip = $_SERVER['REMOTE_ADDR'];
				//$current_ip = '177.222.102.26';//comentar esta linea para q compruebe con la ip publica
				if(IP_SUCURSAL == $current_ip){
					$acceso= true;
					$this->session->set_userdata('impresora', $impresora);
				}else{
					$acceso=false;
				}
			}else{
				//echo 'entrar sin comprobar ip';
				$acceso= true;
				$this->session->set_userdata('impresora', $impresora);
			}
		}
		if(!$acceso){
			$this->session->set_flashdata('msg', 'Acceso denegado');
				redirect('login/index', 'refresh');
		}
		
		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('password', 'Password Confirmation', 'required');

		if ($this->form_validation->run() == TRUE) {
			$usuario = set_value('usuario');
			$password = set_value('password');
			$password = $this->strToHex(trim($password));
			$opcionTurno = set_value('abrirTurno');

			$sql="select * FROM VENTAS_USUARIOS vu, SIREPE_EMPLEADO se  WHERE se.ID_EMPLEADO = vu.ID_EMPLEADO and  USUARIO = '$usuario' COLLATE SQL_Latin1_General_CP1_CS_AS AND CONTRASEÑA='$password';";
			$res = $this->main->getQuery($sql);
			if(count($res)>0){
				$id_empleado=null;
				$tipo_usuario=null;
				foreach ($res as $row)
				{
					$id_usuario = $row->ID_USUARIO;
					$usuario = $row->USUARIO;
					$id_empleado = $row->ID_EMPLEADO;
					$tipo_usuario = $row->TIPO_USUARIO;
					$nombre_usuario = $row->NOMBRE;
					$apellido_p_usuario = $row->AP_PATERNO;
					$apellido_m_usuario = $row->AP_MATERNO;
				}
				$acceso = $this->getPermisoSucursal($id_ubicacion,$id_usuario);
				
			}else{
				$acceso = false;
			}
			$dosificacion = $this->getDosificacion();
			if(count($dosificacion)==1){
				$id_dosificacion = $dosificacion[0]->ID_DOSIFICACION;
				$numero_autorizacion = $dosificacion[0]->N_AUTORIZACION;
				$clave = $dosificacion[0]->LLAVE_DOSIFICACION;
				$fecha_limite = $dosificacion[0]->FECHA_LIMITE;
				$direccion_dosificacion = $dosificacion[0]->DIRECCION_SUCURSAL;
				$telefono_dosificacion = $dosificacion[0]->TELEFONO;
				$nit_dosificacion = $dosificacion[0]->NIT;
				$departamentoPais_dosificacion = $dosificacion[0]->DEPARTAMENTO_Y_PAIS;
				$this->session->set_userdata('departamentoPais_dosificacion',$departamentoPais_dosificacion);
				$this->session->set_userdata('direccion_dosificacion',$direccion_dosificacion);
				if($id_dosificacion == null){
					$acceso = false;
				}
			}else{
				$acceso= false;
			}
			if(!$acceso){
				$this->session->set_flashdata('msg', 'Acceso denegado');
					redirect('login/index', 'refresh');
			}

			if(isset($id_empleado)){
				$data = [
					'id_usuario' => $id_usuario,
					'usuario' => $usuario,
					'id_empleado' => $id_empleado,
					'tipo_usuario' => $tipo_usuario,
					'nombre' => $nombre_usuario.' '.$apellido_p_usuario,
					'loggin' => TRUE
				  ];
				  $this->session->set_userdata('id_ubicacion', $id_ubicacion);
				  if($tipo_usuario === 'Global'){
					base();
						//$this->abrirSesion($id_usuario);
						$this->session->set_userdata($data);
				  }else{
					$cantidad_sesiones = $this->cantidadSesiones();
					if($cantidad_sesiones!=0){
						$this->session->set_flashdata('msg', 'Existe una sesion abierta, cierrela para abrir, o consulte con el Administrador');
						redirect('login/index', 'refresh');
						exit();
					}
					$comprobar = $this->verificarEstadoTurno();
					$cant= count($comprobar);
					if($cant>0){
						$res_usuario_turno = $this->verificarUsuarioTurno($id_usuario);
						if(count($res_usuario_turno)>0){
							$id_apertura_turno = $this->getIdAperturaTurno(); 
                    		$this->session->set_userdata('id_apertura_turno', $id_apertura_turno);
							$this->session->set_userdata($data);
							$this->session->set_userdata('acceso_menu_ventas', 'accept');
							base();
							$this->abrirSesion($id_usuario);
							$cant_ca=$this->getCierreAperturaTurno();
							if(count($cant_ca)>0){
								$monto = $cant_ca[0]->MONTO_APERTURA;
								if($monto === null){
									$this->session->set_userdata('acceso_menu_ventas', 'deny' );
									$this->session->set_userdata('notification_ac', 'Atencion: Esta pendiente el registro del monto con el ingreso del turno. Para registrar la informacion ingrese en el menu lateral en la opcion APERTURA DE CAJA.');
									$this->session->set_userdata('monto_apertura_pendiente', '1' );
									$this->session->set_userdata('id_apertura_turno', $id_apertura_turno);
									$this->session->set_userdata('notification_ac_link');
									redirect('generico/inicio','refresh');
								}
							}
							redirect('generico/inicio','refresh');
						}else{
							$this->session->set_flashdata('msg', 'Existe un turno abierto');
							redirect('login/index', 'refresh');
							exit();
						}	
					}else{
						base();
						$this->abrirSesion($id_usuario);
						$this->session->set_userdata($data);
					}
				  }
				  
					redirect('generico/inicio','refresh');
			}else{
				$this->session->set_flashdata('msg', 'Escribir correctamente su usuario o contraseña');
				redirect('login/index', 'refresh');
			}
			
			
		}else{
			$this->session->set_flashdata('msg', 'Escribir correctamente su usuario o contraseña');
			redirect('login/index', 'refresh');
		}
	}

	public function logout()
	{
		$tipo_usuario = $this->session->userdata('tipo_usuario'); 
		if($tipo_usuario != 'Global'){
			$this->eliminarSesion();
		}
		$this->session->sess_destroy();
		redirect('login/index');
	}

	public function loggedin()
	{
		return (bool) $this->session->userdata('loggin');
	}

	function strToHex($string){
		$hex = '';
		for ($i=0; $i<strlen($string); $i++){
			$ord = ord($string[$i]);
			$hexCode = dechex($ord);
			$hex .= substr('0'.$hexCode, -2);
		}
		return strToUpper($hex);
	}

	function getDatosUbicacion(){
		$sql="select * from ID_UBICACION;";
		$res = $this->main->getQuery($sql);
        return $res;
	}

	public function verificarEstadoTurno(){
		$sql = 'EXEC '.PRE_SUC.'VERIFICA_ESTADO_TURNO';
		$res = $this->main->getQuery($sql);
        return $res;
    }

	public function verificarUsuarioTurno($id_usuario){
		$sql = "EXEC ".PRE_SUC."GET_ID_USUARIO_TURNO ".$id_usuario;
		$res = $this->main->getQuery($sql);
        return $res;
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

	function getSucursal($ip){
		$res = null;
		$sql="select * FROM ID_UBICACION WHERE IP_PUBLICA = '$ip';";
		$res = $this->main->getQuery($sql);
		return $res;
	}

	function getPermisoSucursal($id_ubicacion,$id_usuario){
		$respuesta = false;
		$sql="select * FROM VENTAS_PERMISO_SUCURSAL WHERE ID_UBICACION = '$id_ubicacion' and ID_USUARIO = '$id_usuario' and ESTADO = 1;";
		$res = $this->main->getQuery($sql);
		if(count($res)>=1){
			$respuesta = true;
		}
		return $respuesta;
	}

	function getCierreAperturaTurno(){
		$res=null;
		$id_usuario = $this->session->userdata('id_usuario');
		$sql = "EXEC ".PRE_SUC."GET_DATOS_TURNO ;";
		$respuesta = $this->main->getQuery($sql);
		return $respuesta;
	}

	function getDosificacion(){
		$fecha= date('Y-m-d');
		$sql = "EXEC ".PRE_SUC."GET_MAX_DOSIFICACION '$fecha';";
		$respuesta = $this->main->getQuery($sql);
		return $respuesta;
	}

	function abrirSesion($id_usuario){
		$res=false;
		try
            {
                $conn = $this->OpenConnection();
                $sql = "insert INTO SESION_USUARIO".SUF_SUC." (ID_USUARIO,ESTADO) VALUES('$id_usuario','1');";
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

	function cantidadSesiones(){
		$res=0;
		try
            {
                $conn = $this->OpenConnection();
                $sql = "select count(*) as CANTIDAD from SESION_USUARIO".SUF_SUC." ;";
                $result = sqlsrv_query($conn, $sql);
				while( $obj = sqlsrv_fetch_object( $result )) {
					$res = $obj->CANTIDAD.'<br />';
			 	 }
                sqlsrv_close($conn);
            }
            catch(Exception $e)
            {
                echo("Error!");
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

}
