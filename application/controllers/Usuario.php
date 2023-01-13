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
					$response['status'] = false;

					$this->db->where('se.CI', trim($this->input->post('dni').$this->input->post('expedido')));
						$this->db->join('VENTAS_USUARIOS vu', 'vu.ID_EMPLEADO = se.ID_EMPLEADO', 'left');						
						$usuario = $this->main->getField('SIREPE_EMPLEADO se', 'se.ID_EMPLEADO');

					if(!$usuario) {

					              $this->db->where('CI', trim($this->input->post('dni').$this->input->post('expedido')));
						$id = $this->main->getField('SIREPE_EMPLEADO', 'ID_EMPLEADO');

						if(!$id) {

						$registro['NOMBRE'] = $this->input->post('nombre');
						$registro['AP_PATERNO'] = $this->input->post('appat');
						$registro['AP_MATERNO'] = $this->input->post('apmat');
						$registro['CI'] = $this->input->post('dni');
						$registro['FECHA_NACIMIENTO'] = $this->input->post('nacimiento');
						$registro['EMAIL'] = $this->input->post('email');
						$registro['TELEFONO'] = $this->input->post('telefono');
						$registro['CELULAR'] = $this->input->post('celular');
						$registro['ID_CARGO'] = $this->input->post('cargo');
						$registro['FECHA_INGRESO'] = $this->input->post('ingreso');
						$registro['DIRECCION'] = $this->input->post('domicilio');
						$registro['SEXO'] = $this->input->post('genero');
						$registro['SUELDO'] = $this->input->post('sueldo');
						$registro['ID_AFP'] = $this->input->post('afp');
						$registro['CUENTA_BANCARIA'] = $this->input->post('cuenta');
						$registro['INICIALES'] = substr($this->input->post('nombre'),0,1).substr($this->input->post('appat'),0,1).substr($this->input->post('apmat'),0,1);
						$registro['NOMBRE_COMPLETO'] = $this->input->post('nombre').' '.$this->input->post('appat').' '.$this->input->post('apmat');
						$registro['ID_CREADOR'] = $this->session->id_usuario;
						$registro['FECHA_CREADO'] = date('Y-m-d H:i:s');
						$registro['EDITABLE'] = 1;
						$registro['ID_STATUS'] = 1;

							$this->db->insert('SIREPE_EMPLEADO', $registro);
							$id = $this->db->insert_id();
						}
						
						if($id) {
							$new_usuario['USUARIO'] = $this->input->post('usuario');
							$new_usuario['CONTRASEÑA'] = strToHex('Capresso');
							$new_usuario['ID_EMPLEADO'] = $id;
							$new_usuario['TIPO_USUARIO'] = $this->input->post('perfil');
							$new_usuario['ELIMINADO'] = 0;
							$new_usuario['PRIMER_INGRESO'] = 0;
							$new_usuario['VALIDADO'] = 0;
							$new_usuario['VENTA'] = 0;
							$new_usuario['DECLARACION_INVENTARIO'] = 0;
							$new_usuario['SOLICITUD_PRODUCTOS'] = 0;
							$new_usuario['REIMPRESION_FACTURAS'] = 0;
							$new_usuario['PERMISOS_USUARIOS'] = 0;
							$new_usuario['RESET_CONTRASEÑA'] = 0;

														
							$this->db->insert('VENTAS_USUARIOS', $new_usuario);
							$id_usuario = $this->db->insert_id();	
							
							if($id_usuario) {

								$permiso['ID_UBICACION'] = $this->input->post('sucursal');
								$permiso['ID_USUARIO'] = $id_usuario;
								$permiso['ESTADO']	= 1;
								$permiso['ID_USUARIO_MODIF'] = $this->session->id_usuario;

								$this->db->insert('VENTAS_PERMISO_SUCURSAL', $permiso);

							}
											$this->db->where('PERFIL', $this->input->post('perfil'));
							$id_perfil = $this->main->getField('VENTAS_PERFIL', 'ID_VENTAS_PERFIL');

									  $this->db->where('ID_VENTAS_PERFIL', $id_perfil);
									  $this->db->where('ESTADO', 1);
							$acceso = $this->main->getListSelect('VENTAS_PERMISO_PERFIL', 'ID_VENTAS_ACCESO');

							
							


							if($acceso) {

								$autorizado = [];
								foreach ($acceso as $a) {
									$temp = [];
									$temp['ID_USUARIO'] = $id_usuario;
									$temp['ID_VENTAS_ACCESO'] = $a->ID_VENTAS_ACCESO;
									$temp['ESTADO'] = 1;

									array_push($autorizado, $temp);
								}

								$this->db->insert_batch('VENTAS_USUARIOS_ACCESO', $autorizado);
							}

							if($this->db->affected_rows()) {
								$response['status'] = true;
							}

							$this->db->where('ACCESO_BOTON', 1);
							$acceso_boton = $this->main->getListSelect('VENTAS_ACCESO', 'ID_VENTAS_ACCESO');


							$this->db->where('MODULE', 'ADMIN');
							$boton = $this->main->getListSelect('VENTAS_BOTON', 'ID_VENTAS_BOTON');

							$array = [];


							foreach($acceso_boton as $a) {

								foreach($boton as $b) {
									$t['ID_USUARIO'] = $id_usuario;
									$t['ID_VENTAS_BOTON'] = $b->ID_VENTAS_BOTON;
									$t['ESTADO'] = 0;
									$t['ID_VENTAS_ACCESO'] = $a->ID_VENTAS_ACCESO;

									array_push($array, $t);

									
								}
							}

							$this->db->insert_batch('VENTAS_ACCESO_BOTON', $array);

						} 
						
					  }
						echo json_encode($response);
					}


					public function update() {
						$empleado = $this->input->post('empleado');
						$nombre = $this->input->post('nombre');
						$paterno = $this->input->post('appat');
						$materno = $this->input->post('apmat');
						$nacimiento = $this->input->post('nacimiento');
						$email = $this->input->post('email');
						$telefono = $this->input->post('telefono');
						$celular = $this->input->post('celular');
						$cargo = $this->input->post('cargo');
						$ingreso = $this->input->post('ingreso');
						$direccion = $this->input->post('domicilio');
						$genero = $this->input->post('genero');
						$sueldo = $this->input->post('sueldo');
						$afp = $this->input->post('afp');
						$cuenta = $this->input->post('cuenta');
						$inicial = substr($this->input->post('nombre'),0,1).substr($this->input->post('appat'),0,1).substr($this->input->post('apmat'),0,1);
						$modificador = $this->session->id_usuario;

						$sql = "EXECUTE UP_EMPLEADO ".$empleado.",'".$nombre."','".$paterno."','".$materno."','".$nacimiento."','".$email."',".$telefono.",".$celular.",".$cargo.",'".$ingreso."','".$direccion."','".$genero."',".$sueldo.",".$afp.",'".$cuenta."','".$inicial."',".$modificador;

						$res = $this->db->query($sql)->result();

						$response['status'] = true;

						echo json_encode($response);

					}



}

				
		/* End of file Usuario.php */
		