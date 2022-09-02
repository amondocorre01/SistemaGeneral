<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<!-- /.content-header -->
		<!-- Main content -->
		<section class="content">
			<!--<a href="<?php echo base_url('assets/factura/print.php'); ?>" target="display-frame">Imprimir Factura</a>-->
			
			<div class="container-fluid">
			<div class="contenedor-responsivo">
			<?php if ($this->session->flashdata('msg-success')): ?>
										<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
										<?= $this->session->flashdata('msg-success') ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
										</button>
										</div>
								<?php endif ?>
			<?php
				switch ($page) {
					case 'menu_ventas':
						$tipo_usuario = $this->session->userdata('tipo_usuario'); 
						if($tipo_usuario != 'Global'){
							echo $menu_ventas;
						}
						# code...
						break;
					case 'panel':
						if(isset($ventas_ui)){
							echo $this->load->view('generico/ventas/index', null, TRUE);
						}
						# code...
						break;
					case 'link':
						$link='https://app.powerbi.com/reportEmbed?reportId=5acf0584-1019-4f5b-b449-d5670f4b02e1&autoAuth=true&ctid=dbcd64f8-d0d1-45bd-a7c8-efb849258069&config=eyJjbHVzdGVyVXJsIjoiaHR0cHM6Ly93YWJpLXNvdXRoLWNlbnRyYWwtdXMtcmVkaXJlY3QuYW5hbHlzaXMud2luZG93cy5uZXQvIn0%3D';
						if (isset($ventas_acceso)) {
							$i = 0;
							foreach ($ventas_acceso as $item) {
								$nombre = $item->NOMBRE;
								$link = $item->LINK;
							}
							//echo $nombre;
							if($link != null){
								if(strpos($link, "http") !== false) {
									echo '<div class="card">
									<div class="card-body table-responsive p-0" style="height:100%; width:100%">';
									echo '<iframe id="iframe-reportes" class="iframe-responsivo" src="'.$link.'" width="100%" height="600" ></iframe>';
									echo '</div></div>';
								}else{
									switch ($link) {
										case 'REPORTE_01':
											echo $this->load->view('excel/reporte_01', null, TRUE);
											break;
										case 'REPORTE_02':
											echo $this->load->view('excel/reporte_02', null, TRUE);
											break;
										case 'REPORTE_03':
											echo $this->load->view('excel/reporte_03', null, TRUE);
											break;
										case 'REPORTE_04':
											echo $this->load->view('excel/reporte_04', null, TRUE);
											break;
										case 'REPORTE_05':
											echo $this->load->view('excel/reporte_05', null, TRUE);
											break;
										case 'REPORTE_06':
											echo $this->load->view('excel/reporte_06', null, TRUE);
											break;
										case 'REPORTE_07':
											echo $this->load->view('excel/reporte_07', null, TRUE);
											break;
										case 'REPORTE_08':
											echo $this->load->view('excel/reporte_08', null, TRUE);
											break;
										case 'REPORTE_09':
											echo $this->load->view('excel/reporte_09', null, TRUE);
											break;
										case 'REPORTE_10':
											echo $this->load->view('excel/reporte_10', null, TRUE);
											break;
										case 'REPORTE_11':
											echo $this->load->view('excel/reporte_11', null, TRUE);
											break;
										case 'REPORTE_12':
											echo $this->load->view('excel/reporte_12', null, TRUE);
											break;
										case 'REPORTE_13':
											echo $this->load->view('excel/reporte_13', null, TRUE);
											break;
										case 'REPORTE_14':
											echo $this->load->view('excel/reporte_14', null, TRUE);
											break;
										case 'REPORTE_15':
											echo $this->load->view('excel/reporte_15', null, TRUE);
											break;
										case 'REPORTE_16':
											echo $this->load->view('excel/reporte_16', null, TRUE);
											break;
										case 'REPORTE_17':
											echo $this->load->view('excel/reporte_17', null, TRUE);
											break;
										case 'REPORTE_18':
											echo $this->load->view('excel/reporte_18', null, TRUE);
											break;
										case 'REPORTE_001':
											echo $this->load->view('excel/reporte_001', null, TRUE);
											break;
										case 'REPORTE_002':
											echo $this->load->view('excel/reporte_002', null, TRUE);
											break;
										case 'REPORTE_003':
											echo $this->load->view('excel/reporte_003', null, TRUE);
											break;
										case 'REPORTE_004':
											echo $this->load->view('excel/reporte_004', null, TRUE);
											break;
										case 'REPORTE_005':
											echo $this->load->view('excel/reporte_005', null, TRUE);
											break;
										case 'REPORTE_006':
											echo $this->load->view('excel/reporte_006', null, TRUE);
											break;
										case 'REPORTE_007':
											echo $this->load->view('excel/reporte_007', null, TRUE);
											break;
										case 'REPORTE_008':
											echo $this->load->view('excel/reporte_008', null, TRUE);
											break;
										case 'ingresos_egresos':
											echo $this->load->view('generico/apertura/ingreso_egreso', null, TRUE);
										break;
										case 'apertura':
											$acceso = $this->session->userdata('acceso_menu_ventas');
											if($acceso=='accept'){
												redirect('generico/inicio','refresh');
											}else if($acceso=='deny'){
												echo $this->load->view('generico/apertura/index', null, TRUE);
											}else{
												echo $this->load->view('generico/apertura/index', null, TRUE);
											}
										break;
										case 'cierre':
												echo $this->load->view('generico/apertura/cierre_caja', null, TRUE);
										break;

										case 'reimpresion':
												echo $this->load->view('generico/apertura/reimpresion', null, TRUE);
										break;
										
										case 'acceso-usuarios':
											
											$this->db->join('SIREPE_EMPLEADO se', 'se.ID_EMPLEADO = vu.ID_EMPLEADO', 'left');
											$this->db->where('se.ID_STATUS', 1);
											$usuarios = $this->main->getListSelect('VENTAS_USUARIOS vu', 'vu.ID_USUARIO, se.NOMBRE_COMPLETO');
											$datos['usuarios'] = $this->main->dropdown($usuarios, '');

											$this->load->view('usuario/acceso', $datos, FALSE);
										break;

										case 'accesibilidad':
																$this->db->join('ID_UBICACION u', 'u.ID_UBICACION = vps.ID_UBICACION', 'left');
																$this->db->where('ID_USUARIO', $this->session->id_usuario);
											$sucursales =  $this->main->getListSelect('VENTAS_PERMISO_SUCURSAL vps', 'u.ID_UBICACION, u.DESCRIPCION', ['u.DESCRIPCION'=>'ASC'], ['vps.ESTADO'=>1, 'u.ESTADO'=>1 ]);

											$campos = "ID_CARGO AS ID, CONCAT_WS('-', AREA, NOMBRE_CARGO) AS TEXT";

											$cargos = $this->main->getListSelect('SIREPE_CARGOS', $campos, ['TEXT'=>'ASC']);
											$datos['cargos'] = $this->main->dropdown($cargos, '');

											$campos_afp = "ID_AFP,	NOMBRE_AFP";
											$afp = $this->main->getListSelect('SIREPE_AFP', $campos_afp, ['ID_AFP'=>'ASC']);
											$datos['afp'] = $this->main->dropdown($afp, '');

											$datos['sucursales'] = $this->main->dropdown($sucursales, '');

											$campos_menu = "ID_VENTAS_ACCESO AS tt_key, NIVEL_SUPERIOR AS tt_parent, NOMBRE AS name";

											$this->db->where('ESTADO', 1);
											$menu = $this->main->getListSelect('VENTAS_ACCESO', $campos_menu, ['tt_parent'=>'ASC']);
											$datos['menuMain']  = json_encode($menu);

											$perfiles = $this->main->getListSelect('VENTAS_PERFIL', 'ID_VENTAS_PERFIL, PERFIL', ['PERFIL'=>'ASC']);
											$datos['perfiles'] = $this->main->dropdown($perfiles, '-- Seleccione una opcion --');

											$this->load->view('usuario/darbaja', $datos, FALSE);
										break;

										case 'reimpresion-cine-center':
											$datos['db'] = 'cineCenter'; 
											$datos['sucursal'] = 'Cine Center';
										 echo $this->load->view('generico/apertura/reimpresion', $datos, TRUE);
										break;

										case 'permisos':
																			$this->db->join('VENTAS_USUARIOS vu', 'vu.ID_EMPLEADO = SE.ID_EMPLEADO', 'left');
																			$this->db->where('vu.ID_EMPLEADO !=', null);
											$usuarios = $this->main->getListSelect('SIREPE_EMPLEADO se', 'vu.ID_USUARIO, NOMBRE_COMPLETO', ['NOMBRE_COMPLETO'=>'ASC']);

											$datos['usuarios'] = $this->main->dropdown($usuarios, '');
											echo $this->load->view('usuario/permisos', $datos, TRUE);
										break;

										case 'permisos-boton':
											$this->db->join('VENTAS_USUARIOS vu', 'vu.ID_EMPLEADO = SE.ID_EMPLEADO', 'left');
											$this->db->where('vu.ID_EMPLEADO !=', null);
											$usuarios = $this->main->getListSelect('SIREPE_EMPLEADO se', 'vu.ID_USUARIO, NOMBRE_COMPLETO', ['NOMBRE_COMPLETO'=>'ASC']);
											$datos['usuarios'] = $this->main->dropdown($usuarios, '');
											
											$this->db->where('va.ESTADO', 1);
											$this->db->where('va.TIPO', 'acceso');
											$menus = $this->main->getListSelect('VENTAS_ACCESO va', 'va.ID_VENTAS_ACCESO, NOMBRE', ['NOMBRE'=>'ASC']);

											$datos['menus'] = $this->main->dropdown($menus, '');

											echo $this->load->view('usuario/boton', $datos, TRUE);
										break;

										case 'perfiles':
												$datos = null;
												echo $this->load->view('perfiles/index', $datos, TRUE);
										break;

										case 'llave':
											$datos = null;
											echo $this->load->view('facturacion/llave', $datos, TRUE);
										break;

										case 'cuis':
																		$this->db->where('CODIGO_SUCURSAL !=', null);
											$sucursales = $this->main->getListSelect('ID_UBICACION', 'CODIGO_SUCURSAL, DESCRIPCION', ['CODIGO_SUCURSAL'=>'ASC']);
											$datos['sucursales'] = $this->main->dropdown($sucursales, '');
											echo $this->load->view('facturacion/cuis', $datos, TRUE);
										break;

										case 'acceso-perfiles':
											$this->db->where('vp.ESTADO', 1);
											$perfiles = $this->main->getListSelect('VENTAS_PERFIL vp', 'vp.ID_VENTAS_PERFIL, PERFIL');
											$datos['perfiles'] = $this->main->dropdown($perfiles, '');
											echo $this->load->view('perfiles/acceso', $datos, TRUE);
										break;
									}
								}
							}
						}
						break;
						default :
							$tipo_usuario = $this->session->userdata('tipo_usuario'); 
							if($tipo_usuario != 'Global'){
								echo $this->load->view('generico/inicio/index', null, TRUE);
							}
						break;
				}
			 ?>
			<!-- Content Wrapper. Contains page content -->
			
			</div>
			</div><!-- /.container-fluid -->
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<?php
			if(isset($_SESSION['data-imprimir'])){
				$data_imp = $_SESSION['data-imprimir'];
				$res = json_decode($data_imp);
				$tipo_print = $res->tipo_print;
				if(isset($res->tipo_ie)){
					$tipo_ie = $res->tipo_ie; 
				}else{
					$tipo_ie='';
				}
			}
	?>
	<script>
		$(document).ready(function() {
			<?php if(isset($data_imp)):?>
			var tipo_print='<?=$tipo_print?>';
			switch (tipo_print) {
				case 'print-movimiento':
					var tipo_ie='<?=$tipo_ie?>';
					if(tipo_ie== 'I'){
						openPrintIngresos();
					}else if(tipo_ie== 'E'){
						openPrintEgresos();
					}
					break;
				case 'print-apertura-caja':
					openPrintAbrirCaja();
					break;
				default:
					break;
			}
			<?php endif; ?>
			var iframe = document.getElementById("iframe-reportes");
			if(iframe != null){
				iframe.onload = function(){
					var formula = ((screen.height)*75)/100;
					iframe.style.height = formula + 'px';
				}
			}
		});

		function openPrintAbrirCaja(){
			var url= "<?=site_url('imprimir-abrir-caja')?>";
			window.open(url,'_blank');
		}
		function openPrintIngresos(){
			var url= "<?=site_url('imprimir-ingreso')?>";
			window.open(url,'_blank');
		}
		function openPrintEgresos(){
			var url= "<?=site_url('imprimir-egreso')?>";
			window.open(url,'_blank');
		}
	</script>
