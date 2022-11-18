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
		$acceso = true;

		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('password', 'Password Confirmation', 'required');

		if ($this->form_validation->run() == TRUE) {
			$usuario = set_value('usuario');
			$password = set_value('password');
			$password = strToHex(trim($password));

			$sql="select * FROM VENTAS_USUARIOS vu, SIREPE_EMPLEADO se  WHERE se.ID_EMPLEADO = vu.ID_EMPLEADO AND se.ID_STATUS = 1  AND USUARIO = '$usuario' COLLATE SQL_Latin1_General_CP1_CS_AS AND CONTRASEÑA='$password';";
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
								
			}else{
				$acceso = false;
			}
			
			if(!$acceso){
				$this->session->set_flashdata('msg', 'Usuario no encontrado, verifique usuario y contraseña');
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
				  $tokenApi = getTokenApi();
				  $this->session->set_userdata('token_api', $tokenApi);
					$this->session->set_userdata($data);
				
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
		$this->session->sess_destroy();
		redirect('login/index');
	}
}
