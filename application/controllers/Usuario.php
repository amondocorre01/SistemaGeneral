<?php
		
		defined('BASEPATH') OR exit('No direct script access allowed');
		
		class Usuario extends CI_Controller {

				
				public function __construct()
				{
					parent::__construct();
					//Do your magic here

					mb_internal_encoding("UTF-8");
				}
				
		
				public function index()
				{
						
				}

				public function save()
				{
				 
					$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[2]|mb_strtoupper');
					$this->form_validation->set_rules('appat', 'Apellido paterno', 'trim|mb_strtoupper');
					$this->form_validation->set_rules('apmat', 'Apellido materno', 'trim|mb_strtoupper');
					$this->form_validation->set_rules('dni', 'N° de Documento', 'trim|required|mb_strtoupper');
					$this->form_validation->set_rules('nacimiento', 'Fecha de nacimiento', 'trim|required');
					$this->form_validation->set_rules('email', 'E-mail', 'trim|mb_strtolower');
					$this->form_validation->set_rules('telefono', 'Telefono', 'trim');
					$this->form_validation->set_rules('celular', 'Celular', 'trim|required');
					$this->form_validation->set_rules('cargos', 'Cargo', 'trim|required');
					$this->form_validation->set_rules('ingreso', 'Ingreso', 'trim|required');
					$this->form_validation->set_rules('domicilio', 'Domicilio', 'trim|required');
					$this->form_validation->set_rules('genero', 'Genero', 'trim|required');
					$this->form_validation->set_rules('sueldo', 'Sueldo', 'trim|required');
					$this->form_validation->set_rules('afp', 'AFP', 'trim|required');
					$this->form_validation->set_rules('cuentaban', 'N° cuenta bancaria', 'trim|required');
					$this->form_validation->set_rules('perfiles', 'Perfil', 'trim|required');
					$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required');


					
					$validation = $this->form_validation->run();

					if($validation) {

						$registro['NOMBRE'] = set_value('nombre');
						$registro['AP_PATERNO'] = set_value('appat');
						$registro['AP_MATERNO'] = set_value('apmat');
						$registro['CI'] = set_value('dni');
						$registro['FECHA_NACIMIENTO'] = set_value('nacimiento');
						$registro['EMAIL'] = set_value('email');
						$registro['TELEFONO'] = set_value('telefono');
						$registro['CELULAR'] = set_value('celular');
						$registro['ID_CARGO'] = set_value('cargos');
						$registro['FECHA_INGRESO'] = set_value('ingreso');
						$registro['DIRECCION'] = set_value('domicilio');
						$registro['SEXO'] = set_value('genero');
						$registro['SUELDO'] = set_value('sueldo');
						$registro['ID_AFP'] = set_value('afp');
						$registro['CUENTA_BANCARIA'] = set_value('cuentaban');
						$registro['INICIALES'] = substr(set_value('nombre'),0,1).substr(set_value('appat'),0,1).substr(set_value('apmat'),0,1);
						$registro['NOMBRE_COMPLETO'] = set_value('nombre').' '.set_value('appat').' '.set_value('apmat');
						$registro['ID_CREADOR'] = $this->session->id_usuario;
						$registro['FECHA_CREADO'] = date('Y-m-d H:i:s');
						$registro['EDITABLE'] = 1;

									$this->db->insert('SIREPE_EMPLEADO', $registro);
						$id = $this->db->insert_id();
						
						if($id) {
							$usuario['USUARIO'] = set_value('usuario');
							$usuario['CONTRASEÑA'] = strToHex(set_value('dni'));
							$usuario['ID_EMPLEADO'] = $id;
							$usuario['ELIMINADO'] = 0;
							$usuario['TIPO_USUARIO'] = 'Cajero';
							$usuario['PRIMER_INGRESO'] = 0;
							$usuario['VALIDADO'] = 0;
							$usuario['VENTA'] = 0;
							$usuario['DECLARACION_INVENTARIO'] = 0;
							$usuario['SOLICITUD_PRODUCTOS'] = 0;
							$usuario['REIMPRESION_FACTURAS'] = 0;
							$usuario['PERMISOS_USUARIOS'] = 0;
							$usuario['RESET_CONTRASEÑA'] = 0;

										  $this->db->insert('VENTAS_USUARIOS', $usuario);
							$id_usuario = $this->db->insert_id();	
							
							if($id_usuario) {

								$ubicaciones = $this->input->post('ubicacion');

								$temp = [];

								foreach ($ubicaciones as $value) {
									$temp2 = [];
									$temp2['ID_UBICACION'] = $value;
									$temp2['ID_USUARIO'] = $id_usuario;
									$temp2['ESTADO'] = 1;
									$temp2['ID_USUARIO_MODIF'] = 1;

									array_push($temp, $temp2);
								}

								$this->db->insert_batch('VENTAS_PERMISO_SUCURSAL', $temp);

										$this->db->where('ID_VENTAS_ACCESO !=', 23);
										$this->db->or_where('NIVEL_SUPERIOR !=', 23);
								$menu = $this->main->getListSelect('VENTAS_ACCESO', 'ID_VENTAS_ACCESO');

								$id_perfil = set_value('perfiles');
								$sql = "EXEC PERFIL_ ".$id_perfil.', '.$id_usuario;
            					$respuesta = $this->main->getQuery($sql);
							}
						}   
					}

					else {
						$this->session->set_flasdata('error', validation_errors());
					}
					
					
					redirect('usuarios');
				 
				}
		
		}
		
		/* End of file Usuario.php */
		