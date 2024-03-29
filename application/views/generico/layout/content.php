
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">			
		<div class="container-fluid">
			<div class="contenedor-responsivo">
				<?php if ($this->session->flashdata('msg-success')): ?>
					<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
						<?=$this->session->flashdata('msg-success') ?>
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
										case 'REPORTE_01_PANDO':
											echo $this->load->view('excel/reporte_01_pando', null, TRUE);
											break;
										case 'REPORTE_02_PANDO':
											echo $this->load->view('excel/reporte_02_pando', null, TRUE);
											break;
										case 'REPORTE_03_PANDO':
											echo $this->load->view('excel/reporte_03_pando', null, TRUE);
											break;
										case 'REPORTE_04_PANDO':
											echo $this->load->view('excel/reporte_04_pando', null, TRUE);
											break;
										case 'REPORTE_05_PANDO':
											echo $this->load->view('excel/reporte_05_pando', null, TRUE);
											break;
										case 'REPORTE_06_PANDO':
											echo $this->load->view('excel/reporte_06_pando', null, TRUE);
											break;
										case 'REPORTE_07_PANDO':
											echo $this->load->view('excel/reporte_07_pando', null, TRUE);
											break;
										case 'REPORTE_08_PANDO':
											echo $this->load->view('excel/reporte_08_pando', null, TRUE);
											break;
										case 'REPORTE_09_PANDO':
											echo $this->load->view('excel/reporte_09_pando', null, TRUE);
											break;
										case 'REPORTE_10_PANDO':
											echo $this->load->view('excel/reporte_10_pando', null, TRUE);
											break;
										case 'REPORTE_11_PANDO':
											echo $this->load->view('excel/reporte_11_pando', null, TRUE);
											break;
										case 'REPORTE_12_PANDO':
											echo $this->load->view('excel/reporte_12_pando', null, TRUE);
											break;
										case 'REPORTE_13_PANDO':
											echo $this->load->view('excel/reporte_13_pando', null, TRUE);
											break;
										case 'REPORTE_14_PANDO':
											echo $this->load->view('excel/reporte_14_pando', null, TRUE);
											break;
										case 'REPORTE_15_PANDO':
											echo $this->load->view('excel/reporte_15_pando', null, TRUE);
											break;
										case 'REPORTE_16_PANDO':
											echo $this->load->view('excel/reporte_16_pando', null, TRUE);
											break;
										case 'REPORTE_17_PANDO':
											echo $this->load->view('excel/reporte_17_pando', null, TRUE);
											break;
										case 'REPORTE_18_PANDO':
											echo $this->load->view('excel/reporte_18_pando', null, TRUE);
											break;
										case 'REPORTE_01_SALAMANCA':
											echo $this->load->view('excel/reporte_01_salamanca', null, TRUE);
											break;
										case 'REPORTE_02_SALAMANCA':
											echo $this->load->view('excel/reporte_02_salamanca', null, TRUE);
											break;
										case 'REPORTE_03_SALAMANCA':
											echo $this->load->view('excel/reporte_03_salamanca', null, TRUE);
											break;
										case 'REPORTE_04_SALAMANCA':
											echo $this->load->view('excel/reporte_04_salamanca', null, TRUE);
											break;
										case 'REPORTE_05_SALAMANCA':
											echo $this->load->view('excel/reporte_05_salamanca', null, TRUE);
											break;
										case 'REPORTE_06_SALAMANCA':
											echo $this->load->view('excel/reporte_06_salamanca', null, TRUE);
											break;
										case 'REPORTE_07_SALAMANCA':
											echo $this->load->view('excel/reporte_07_salamanca', null, TRUE);
											break;
										case 'REPORTE_08_SALAMANCA':
											echo $this->load->view('excel/reporte_08_salamanca', null, TRUE);
											break;
										case 'REPORTE_09_SALAMANCA':
											echo $this->load->view('excel/reporte_09_salamanca', null, TRUE);
											break;
										case 'REPORTE_10_SALAMANCA':
											echo $this->load->view('excel/reporte_10_salamanca', null, TRUE);
											break;
										case 'REPORTE_11_SALAMANCA':
											echo $this->load->view('excel/reporte_11_salamanca', null, TRUE);
											break;
										case 'REPORTE_12_SALAMANCA':
											echo $this->load->view('excel/reporte_12_salamanca', null, TRUE);
											break;
										case 'REPORTE_13_SALAMANCA':
											echo $this->load->view('excel/reporte_13_salamanca', null, TRUE);
											break;
										case 'REPORTE_14_SALAMANCA':
											echo $this->load->view('excel/reporte_14_salamanca', null, TRUE);
											break;
										case 'REPORTE_15_SALAMANCA':
											echo $this->load->view('excel/reporte_15_salamanca', null, TRUE);
											break;
										case 'REPORTE_16_SALAMANCA':
											echo $this->load->view('excel/reporte_16_salamanca', null, TRUE);
											break;
										case 'REPORTE_17_SALAMANCA':
											echo $this->load->view('excel/reporte_17_salamanca', null, TRUE);
											break;
										case 'REPORTE_18_SALAMANCA':
											echo $this->load->view('excel/reporte_18_salamanca', null, TRUE);
											break;
										case 'REPORTE_01_JORDAN':
											echo $this->load->view('excel/reporte_01_JORDAN', null, TRUE);
											break;
										case 'REPORTE_02_JORDAN':
											echo $this->load->view('excel/reporte_02_JORDAN', null, TRUE);
											break;
										case 'REPORTE_03_JORDAN':
											echo $this->load->view('excel/reporte_03_jordan', null, TRUE);
											break;
										case 'REPORTE_04_JORDAN':
											echo $this->load->view('excel/reporte_04_jordan', null, TRUE);
											break;
										case 'REPORTE_05_JORDAN':
											echo $this->load->view('excel/reporte_05_jordan', null, TRUE);
											break;
										case 'REPORTE_06_JORDAN':
											echo $this->load->view('excel/reporte_06_jordan', null, TRUE);
											break;
										case 'REPORTE_07_JORDAN':
											echo $this->load->view('excel/reporte_07_jordan', null, TRUE);
											break;
										case 'REPORTE_08_JORDAN':
											echo $this->load->view('excel/reporte_08_jordan', null, TRUE);
											break;
										case 'REPORTE_09_JORDAN':
											echo $this->load->view('excel/reporte_09_jordan', null, TRUE);
											break;
										case 'REPORTE_10_JORDAN':
											echo $this->load->view('excel/reporte_10_jordan', null, TRUE);
											break;
										case 'REPORTE_11_JORDAN':
											echo $this->load->view('excel/reporte_11_jordan', null, TRUE);
											break;
										case 'REPORTE_12_JORDAN':
											echo $this->load->view('excel/reporte_12_jordan', null, TRUE);
											break;
										case 'REPORTE_13_JORDAN':
											echo $this->load->view('excel/reporte_13_jordan', null, TRUE);
											break;
										case 'REPORTE_14_JORDAN':
											echo $this->load->view('excel/reporte_14_jordan', null, TRUE);
											break;
										case 'REPORTE_15_JORDAN':
											echo $this->load->view('excel/reporte_15_jordan', null, TRUE);
											break;
										case 'REPORTE_16_JORDAN':
											echo $this->load->view('excel/reporte_16_jordan', null, TRUE);
											break;
										case 'REPORTE_17_JORDAN':
											echo $this->load->view('excel/reporte_17_jordan', null, TRUE);
											break;
										case 'REPORTE_18_JORDAN':
											echo $this->load->view('excel/reporte_18_jordan', null, TRUE);
											break;
										case 'REPORTE_01_LINCOLN':
											echo $this->load->view('excel/reporte_01_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_02_LINCOLN':
											echo $this->load->view('excel/reporte_02_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_03_LINCOLN':
											echo $this->load->view('excel/reporte_03_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_04_LINCOLN':
											echo $this->load->view('excel/reporte_04_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_05_LINCOLN':
											echo $this->load->view('excel/reporte_05_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_06_LINCOLN':
											echo $this->load->view('excel/reporte_06_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_07_LINCOLN':
											echo $this->load->view('excel/reporte_07_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_08_LINCOLN':
											echo $this->load->view('excel/reporte_08_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_09_LINCOLN':
											echo $this->load->view('excel/reporte_09_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_10_LINCOLN':
											echo $this->load->view('excel/reporte_10_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_11_LINCOLN':
											echo $this->load->view('excel/reporte_11_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_12_LINCOLN':
											echo $this->load->view('excel/reporte_12_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_13_LINCOLN':
											echo $this->load->view('excel/reporte_13_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_14_LINCOLN':
											echo $this->load->view('excel/reporte_14_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_15_LINCOLN':
											echo $this->load->view('excel/reporte_15_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_16_LINCOLN':
											echo $this->load->view('excel/reporte_16_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_17_LINCOLN':
											echo $this->load->view('excel/reporte_17_LINCOLN', null, TRUE);
											break;
										case 'REPORTE_18_LINCOLN':
											echo $this->load->view('excel/reporte_18_LINCOLN', null, TRUE);
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
										case 'VENTAS_PANDO':
											$data['sucursal'] = 'pando';
											echo $this->load->view('generico/ventas/reimpresion_sucursal', $data, TRUE);
										break;
										case 'VENTAS_SALAMANCA':
											$data['sucursal'] = 'salamanca';
											echo $this->load->view('generico/ventas/reimpresion_sucursal', $data, TRUE);
										break;
										case 'VENTAS_AMERICA_E':
											$data['sucursal'] = 'aeste';
											echo $this->load->view('generico/ventas/reimpresion_sucursal', $data, TRUE);
										break;
										case 'VENTAS_HUPERMALL':
											$data['sucursal'] = 'hupermall';
											echo $this->load->view('generico/ventas/reimpresion_sucursal', $data, TRUE);
										break;
										case 'VENTAS_LINCOLN':
											$data['sucursal'] = 'lincoln';
											echo $this->load->view('generico/ventas/reimpresion_sucursal', $data, TRUE);
										break;
										case 'VENTAS_JORDAN':
											$data['sucursal'] = 'jordan';
											echo $this->load->view('generico/ventas/reimpresion_sucursal', $data, TRUE);
										break;
										case 'VENTAS_AMERICA_OE':
											$data['sucursal'] = 'aoeste';
											echo $this->load->view('generico/ventas/reimpresion_sucursal', $data, TRUE);
										break;
										case 'VENTAS_CENTER':
											$data['sucursal'] = 'center';
											echo $this->load->view('generico/ventas/reimpresion_sucursal', $data, TRUE);
										break;
										case 'REP-CT-PANDO':
											$data['sucursal'] = 'pando';
											echo $this->load->view('generico/ventas/reporte_cierre_turno', $data, TRUE);
										break;
										
										case 'REP-CT-SALAMANCA':
											$data['sucursal'] = 'salamanca';
											echo $this->load->view('generico/ventas/reporte_cierre_turno', $data, TRUE);
										break;
										case 'REP-CT-AMERICA_E':
											$data['sucursal'] = 'aeste';
											echo $this->load->view('generico/ventas/reporte_cierre_turno', $data, TRUE);
										break;
										case 'REP-CT-HUPERMALL':
											$data['sucursal'] = 'hupermall';
											echo $this->load->view('generico/ventas/reporte_cierre_turno', $data, TRUE);
										break;
										case 'REP-CT-LINCOLN':
											$data['sucursal'] = 'lincoln';
											echo $this->load->view('generico/ventas/reporte_cierre_turno', $data, TRUE);
										break;
										case 'REP-CT-JORDAN':
											$data['sucursal'] = 'jordan';
											echo $this->load->view('generico/ventas/reporte_cierre_turno', $data, TRUE);
										break;
										case 'REP-CT-AMERICA_OE':
											$data['sucursal'] = 'aoeste';
											echo $this->load->view('generico/ventas/reporte_cierre_turno', $data, TRUE);
										break;
										case 'REP-CT-CENTER':
											$data['sucursal'] = 'center';
											echo $this->load->view('generico/ventas/reporte_cierre_turno', $data, TRUE);
										break;

										case 'config-sucursales':
																		$this->db->where('ESTADO', 1);
											$data['sucursales'] = $this->main->getListSelect('ID_UBICACION', 'ID_UBICACION, CODIGO, DESCRIPCION, MENSAJE_FACTURA, MENSAJE_RECIBO,MENSAJE_COMANDA, IMPRESORA', ['ID_UBICACION'=>'ASC']);
											echo $this->load->view('configuraciones/sucursal', $data, TRUE);
										break;
										case 'CONF-PRODUCTS':
											$datos['primeraCategoria'] = getPrimeraCategoria();
											$datos['tamProductos'] = getTamProductos();
											$datos['listasPrecios'] = getNombresListasPrecios();
											$datos['unidadesMedida'] = getUnidadesMedida();
											//$datos['segundaCategoria'] = getSegundaCategoria();
											//$datos['productoMadre'] = getProductoMadre();
											$this->load->view('configuraciones/productos/productos', $datos, FALSE);
										break;
										case 'pedidos-consolidados':
											$datos = '';
											echo $this->load->view('pedido/pedidos_consolidados', $datos, TRUE);
										break;
										case 'pedidos-extraordinarios':
											$datos['primeraCategoria'] = getPrimeraCategoriaInventarios();
											echo $this->load->view('pedido/pedidos_extraordinarios', $datos, TRUE);
										break;
										case 'lista-pedidos-extraordinarios':
											$datos['primeraCategoria'] = getPrimeraCategoriaInventarios();
											echo $this->load->view('pedido/lista_pedidos_extraordinarios', $datos, TRUE);
										break;
case 'acceso-usuarios-sistema-general':
	
	$this->db->join('SIREPE_EMPLEADO se', 'se.ID_EMPLEADO = vu.ID_EMPLEADO', 'left');
	$this->db->where('se.ID_STATUS', 1);
	$datos['usuarios'] = $this->main->getListSelect('VENTAS_USUARIOS vu', 'vu.ID_USUARIO, se.NOMBRE_COMPLETO', ['se.NOMBRE_COMPLETO' => 'ASC']);
	$this->load->view('usuario/acceso', $datos, FALSE);
break;

case 'acceso-usuarios-sistema-ventas':
	
	$this->db->join('SIREPE_EMPLEADO se', 'se.ID_EMPLEADO = vu.ID_EMPLEADO', 'left');
	$this->db->where('se.ID_STATUS', 1);
	$datos['usuarios'] = $this->main->getListSelect('VENTAS_USUARIOS vu', 'vu.ID_USUARIO, se.NOMBRE_COMPLETO', ['se.NOMBRE_COMPLETO' => 'ASC']);
	

	$this->load->view('usuario/acceso_ventas', $datos, FALSE);
break;

case 'accesibilidad':

	/***  HORA ACTUAL  ***/


	$this->db->join('ID_UBICACION u', 'u.ID_UBICACION = vps.ID_UBICACION', 'left');
	$this->db->where('ID_USUARIO', $this->session->id_usuario);
	$datos['sucursales'] =  $this->main->getListSelect('VENTAS_PERMISO_SUCURSAL vps', 'u.ID_UBICACION, u.DESCRIPCION', ['u.DESCRIPCION'=>'ASC'], ['vps.ESTADO'=>1, 'u.ESTADO'=>1 ]);

	$campos = "ID_CARGO AS ID, CONCAT_WS('-', AREA, NOMBRE_CARGO) AS TEXT";
	$datos['cargos'] = $this->main->getListSelect('SIREPE_CARGOS', $campos, ['TEXT'=>'ASC']);
											
	$campos_afp = "ID_AFP,	NOMBRE_AFP";
	$datos['afp'] = $this->main->getListSelect('SIREPE_AFP', $campos_afp, ['ID_AFP'=>'ASC']);
										
	$campos_menu = "ID_VENTAS_ACCESO AS tt_key, NIVEL_SUPERIOR AS tt_parent, NOMBRE AS name";

	$this->db->where('ESTADO', 1);
	$menu = $this->main->getListSelect('VENTAS_ACCESO', $campos_menu, ['tt_parent'=>'ASC']);
										
	$datos['menuMain']  = json_encode($menu);

	$datos['perfiles'] = $this->main->getListSelect('VENTAS_PERFIL', 'ID_VENTAS_PERFIL AS ID, PERFIL AS TEXT', ['PERFIL'=>'ASC']);
											
	$this->load->view('usuario/darbaja', $datos, FALSE);

break;

case 'delete-usuario':
	$this->load->view('usuario/delete', NULL, FALSE);
break;



/********** MODULO PEDIDOS ***************/

		/*** SUCURSAL PRUEBA  ***/
case 'perfilPed-prueba':
	$sucursal = 21; $data = perfilPed($sucursal);
	echo $this->load->view('generico/apertura/perfil_pedido', $data, TRUE);
break;

case 'recepcion-prueba':
	$turno = ($this->input->post('turno')) ? $this->input->post('turno') : 'NO PERECEDERO';
	
	$array = array('keyturno' => $turno);
	$this->session->set_userdata($array);
	
	$db = 'ventas'; $sufijo = 'AE'; $sucursal = 21; $data = recepcion($db, $sufijo, $turno, $sucursal);
	echo $this->load->view('generico/apertura/recepcion', $data, TRUE);
break;

case 'solicitud-prueba':
	$db = 'ventas'; $sufijo = 'AE'; $sucursal = 21; $data = solicitud($db, $sufijo, $sucursal);
	echo $this->load->view('generico/apertura/solicitud', $data, TRUE);
break;

case 'existencia-prueba':
	$db = 'ventas'; $sufijo = 'AE'; $data = existencia($db, $sufijo);
	echo $this->load->view('generico/apertura/existencia', $data, TRUE);
break;

case 'entrega-prueba':

	$turno = ($this->input->post('turno')) ? $this->input->post('turno') : 'NO PERECEDERO';
	
	$array = array('keyturno' => $turno);
	$this->session->set_userdata($array);

	$db = 'ventas'; $sufijo = 'AE'; $ubicacion = 21; $data = entrega($db, $sufijo, $ubicacion, $turno);
	echo $this->load->view('generico/apertura/transporte', $data, TRUE);
break;

case 'apv-prueba':
	$db = 'ventas'; $sufijo = 'AE'; $data = preparacion($db, $sufijo);
	echo $this->load->view('generico/apertura/apv', $data, TRUE);
break;

		/*** SUCURSAL AMERICA ESTE  ***/
case 'perfilPed-AE':
	$sucursal = 13; $data = perfilPed($sucursal);
	echo $this->load->view('generico/apertura/perfil_pedido', $data, TRUE);
break;

case 'recepcion-AE':
	$db = 'aeste'; $sufijo = 'AE'; $sucursal = 13; $data = recepcion($db, $sufijo);
	echo $this->load->view('generico/apertura/recepcion', $data, TRUE);
break;

case 'solicitud-AE':
	$db = 'aeste'; $sufijo = 'AE'; $sucursal = 13; $data = solicitud($db, $sufijo, $sucursal);
	echo $this->load->view('generico/apertura/solicitud', $data, TRUE);
break;

case 'existencia-AE':
	$db = 'aeste'; $sufijo = 'AE'; $data = existencia($db, $sufijo);
	echo $this->load->view('generico/apertura/existencia', $data, TRUE);
break;

case 'entrega-AE':
	$db = 'aeste'; $sufijo = 'AE'; $ubicacion = 13; $data = entrega($db, $sufijo, $ubicacion);
	echo $this->load->view('generico/apertura/transporte', $data, TRUE);
break;

case 'apv-AE':
	$db = 'aeste'; $sufijo = 'AE'; $data = preparacion($db, $sufijo);
	echo $this->load->view('generico/apertura/apv', $data, TRUE);
break;
			/*** SUCURSAL AMERICA OESTE  ***/

case 'perfilPed-AO':
	$sucursal = 5; $data = perfilPed($sucursal);
	echo $this->load->view('generico/apertura/perfil_pedido', $data, TRUE);
break;

case 'recepcion-AO':
	$db = 'aoeste'; $sufijo = 'AO'; $sucursal = 5; $data = recepcion($db, $sufijo);
	echo $this->load->view('generico/apertura/recepcion', $data, TRUE);
break;

case 'solicitud-AO':
	$db = 'aoeste'; $sufijo = 'AO'; $sucursal = 5; $data = solicitud($db, $sufijo, $sucursal);
	echo $this->load->view('generico/apertura/solicitud', $data, TRUE);
break;

case 'existencia-AO':
	$db = 'aoeste'; $sufijo = 'AO'; $data = existencia($db, $sufijo);
	echo $this->load->view('generico/apertura/existencia', $data, TRUE);
break;

case 'entrega-AO':
	$db = 'aoeste'; $sufijo = 'AO'; $ubicacion = 5; $data = entrega($db, $sufijo, $ubicacion);
	echo $this->load->view('generico/apertura/transporte', $data, TRUE);
break;

case 'apv-AO':
	$db = 'aoeste'; $sufijo = 'AO'; $data = preparacion($db, $sufijo);
	echo $this->load->view('generico/apertura/apv', $data, TRUE);
break;

/*** SUCURSAL AMERICA LINCOLN  ***/

case 'perfilPed-AO':
	$sucursal = 11; $data = perfilPed($sucursal);
	echo $this->load->view('generico/apertura/perfil_pedido', $data, TRUE);
break;

case 'recepcion-AO':
	$db = 'lincoln'; $sufijo = 'AO'; $sucursal = 11; $data = recepcion($db, $sufijo);
	echo $this->load->view('generico/apertura/recepcion', $data, TRUE);
break;

case 'solicitud-AO':
	$db = 'lincoln'; $sufijo = 'AO'; $sucursal = 11; $data = solicitud($db, $sufijo, $sucursal);
	echo $this->load->view('generico/apertura/solicitud', $data, TRUE);
break;

case 'existencia-AO':
	$db = 'lincoln'; $sufijo = 'AO'; $data = existencia($db, $sufijo);
	echo $this->load->view('generico/apertura/existencia', $data, TRUE);
break;

case 'entrega-AO':
	$db = 'lincoln'; $sufijo = 'AO'; $ubicacion = 11; $data = entrega($db, $sufijo, $ubicacion);
	echo $this->load->view('generico/apertura/transporte', $data, TRUE);
break;

case 'apv-AO':
	$db = 'lincoln'; $sufijo = 'AO'; $data = preparacion($db, $sufijo);
	echo $this->load->view('generico/apertura/apv', $data, TRUE);
break;

/*** SUCURSAL AMERICA JORDAN  ***/

case 'perfilPed-SJ':
	$sucursal = 12; $data = perfilPed($sucursal);
	echo $this->load->view('generico/apertura/perfil_pedido', $data, TRUE);
break;

case 'recepcion-SJ':
	$db = 'jordan'; $sufijo = 'SJ'; $sucursal = 12; $data = recepcion($db, $sufijo);
	echo $this->load->view('generico/apertura/recepcion', $data, TRUE);
break;

case 'solicitud-SJ':
	$db = 'jordan'; $sufijo = 'SJ'; $sucursal = 12; $data = solicitud($db, $sufijo, $sucursal);
	echo $this->load->view('generico/apertura/solicitud', $data, TRUE);
break;

case 'existencia-SJ':
	$db = 'jordan'; $sufijo = 'SJ'; $data = existencia($db, $sufijo);
	echo $this->load->view('generico/apertura/existencia', $data, TRUE);
break;

case 'entrega-SJ':
	$db = 'jordan'; $sufijo = 'SJ'; $ubicacion = 12; $data = entrega($db, $sufijo, $ubicacion);
	echo $this->load->view('generico/apertura/transporte', $data, TRUE);
break;

case 'apv-SJ':
	$db = 'jordan'; $sufijo = 'SJ'; $data = preparacion($db, $sufijo);
	echo $this->load->view('generico/apertura/apv', $data, TRUE);
break;

/*** SUCURSAL SALAMANCA  ***/

case 'perfilPed-SS':
	$sucursal = 4; $data = perfilPed($sucursal);
	echo $this->load->view('generico/apertura/perfil_pedido', $data, TRUE);
break;

case 'recepcion-SS':
	$db = 'salamanca'; $sufijo = 'SS'; $sucursal = 4; $data = recepcion($db, $sufijo);
	echo $this->load->view('generico/apertura/recepcion', $data, TRUE);
break;

case 'solicitud-SS':
	$db = 'salamanca'; $sufijo = 'SS'; $sucursal = 4; $data = solicitud($db, $sufijo, $sucursal);
	echo $this->load->view('generico/apertura/solicitud', $data, TRUE);
break;

case 'existencia-SS':
	$db = 'salamanca'; $sufijo = 'SS'; $data = existencia($db, $sufijo);
	echo $this->load->view('generico/apertura/existencia', $data, TRUE);
break;

case 'entrega-SS':
	$db = 'salamanca'; $sufijo = 'SS'; $ubicacion = 4; $data = entrega($db, $sufijo, $ubicacion);
	echo $this->load->view('generico/apertura/transporte', $data, TRUE);
break;

case 'apv-SS':
	$db = 'salamanca'; $sufijo = 'SS'; $data = preparacion($db, $sufijo);
	echo $this->load->view('generico/apertura/apv', $data, TRUE);
break;

/*** SUCURSAL MEGA CENTER  ***/

case 'perfilPed-CC':
	$sucursal = 18; $data = perfilPed($sucursal);
	echo $this->load->view('generico/apertura/perfil_pedido', $data, TRUE);
break;

case 'recepcion-CC':
	$db = 'center'; $sufijo = 'CC'; $sucursal = 18; $data = recepcion($db, $sufijo);
	echo $this->load->view('generico/apertura/recepcion', $data, TRUE);
break;

case 'solicitud-CC':
	$db = 'center'; $sufijo = 'CC'; $sucursal = 18; $data = solicitud($db, $sufijo, $sucursal);
	echo $this->load->view('generico/apertura/solicitud', $data, TRUE);
break;

case 'existencia-CC':
	$db = 'center'; $sufijo = 'CC'; $data = existencia($db, $sufijo);
	echo $this->load->view('generico/apertura/existencia', $data, TRUE);
break;

case 'entrega-CC':
	$db = 'center'; $sufijo = 'CC'; $ubicacion = 18; $data = entrega($db, $sufijo, $ubicacion);
	echo $this->load->view('generico/apertura/transporte', $data, TRUE);
break;

case 'apv-CC':
	$db = 'center'; $sufijo = 'CC'; $data = preparacion($db, $sufijo);
	echo $this->load->view('generico/apertura/apv', $data, TRUE);
break;

case 'despacho':
	$data = despacho();
	echo $this->load->view('generico/apertura/despacho', $data, TRUE);
break;

/*** SUCURSAL PANDO  ***/

case 'perfilPed-SP':
	$sucursal = 2; $data = perfilPed($sucursal);
	echo $this->load->view('generico/apertura/perfil_pedido', $data, TRUE);
break;

case 'recepcion-SP':
	$db = 'pando'; $sufijo = 'SP'; $sucursal = 2; $data = recepcion($db, $sufijo);
	echo $this->load->view('generico/apertura/recepcion', $data, TRUE);
break;

case 'solicitud-SP':
	$db = 'pando'; $sufijo = 'SP'; $sucursal = 2; $data = solicitud($db, $sufijo, $sucursal);
	echo $this->load->view('generico/apertura/solicitud', $data, TRUE);
break;

case 'existencia-SP':
	$db = 'pando'; $sufijo = 'SP'; $data = existencia($db, $sufijo);
	echo $this->load->view('generico/apertura/existencia', $data, TRUE);
break;

case 'entrega-SP':
	$db = 'pando'; $sufijo = 'SP'; $ubicacion = 2; $data = entrega($db, $sufijo, $ubicacion);
	echo $this->load->view('generico/apertura/transporte', $data, TRUE);
break;

case 'apv-SP':
	$db = 'pando'; $sufijo = 'SP'; $data = preparacion($db, $sufijo);
	echo $this->load->view('generico/apertura/apv', $data, TRUE);
break;

/*** SUCURSAL HUPERMALL  ***/

case 'perfilPed-SH':
	$sucursal = 6; $data = perfilPed($sucursal);
	echo $this->load->view('generico/apertura/perfil_pedido', $data, TRUE);
break;

case 'recepcion-SH':
	$db = 'hupermall'; $sufijo = 'SH'; $sucursal = 6; $data = recepcion($db, $sufijo);
	echo $this->load->view('generico/apertura/recepcion', $data, TRUE);
break;

case 'solicitud-SH':
	$db = 'hupermall'; $sufijo = 'SH'; $sucursal = 6; $data = solicitud($db, $sufijo, $sucursal);
	echo $this->load->view('generico/apertura/solicitud', $data, TRUE);
break;

case 'existencia-SH':
	$db = 'hupermall'; $sufijo = 'SH'; $data = existencia($db, $sufijo);
	echo $this->load->view('generico/apertura/existencia', $data, TRUE);
break;

case 'entrega-SH':
	$db = 'hupermall'; $sufijo = 'SH'; $ubicacion = 6; $data = entrega($db, $sufijo, $ubicacion);
	echo $this->load->view('generico/apertura/transporte', $data, TRUE);
break;

case 'apv-SH':
	$db = 'hupermall'; $sufijo = 'SH'; $data = preparacion($db, $sufijo);
	echo $this->load->view('generico/apertura/apv', $data, TRUE);
break;

case 'despacho':
	$data = despacho();
	echo $this->load->view('generico/apertura/despacho', $data, TRUE);
break;


case 'cronograma':

	$sql = "SELECT ID_UBICACION, DESCRIPCION FROM ID_UBICACION WHERE ESTADO = ? AND SUCURSAL = ?";
	$data['sucursales'] = $this->db->query($sql, [1,1])->result();

	$sql1 = "SELECT * FROM INVENTARIOS_TURNO ORDER BY ID_TURNO ASC";
	$data['turnos'] = $this->db->query($sql1)->result();


	echo $this->load->view('generico/apertura/cronograma', $data, TRUE);

break;


/********** FIN MODULO PEDIDO  ***********/

/****************** INICIO MODULO RECETA *******************/


case 'receta':

	$data['primeraCategoria'] = getPrimeraCategoria();

	echo $this->load->view('generico/receta/registro', $data, TRUE);
break;

case 'receta-combo':

	$data['primeraCategoria'] = getPrimeraCategoria();
	$data['combo'] = getMenuCombo(); 
	$data['cat1'] = getCategorias();
	$data['orden'] = getOrden();
	$data['madre'] = getMadre();

	echo $this->load->view('generico/receta/combo', $data, TRUE);
break;
/****************** FIN MODULO RECETA **********************/




case 'cambiar-pasword':
	$data = null;
	echo $this->load->view('generico/apertura/password', $data, TRUE);
break;

										case 'reimpresion-cine-center':
											$datos['db'] = 'aeste'; 
											$datos['sucursal'] = 'Pruebas';
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
		$datos['usuarios'] = $this->main->getListSelect('SIREPE_EMPLEADO se', 'vu.ID_USUARIO, NOMBRE_COMPLETO', ['NOMBRE_COMPLETO'=>'ASC']);
		
		
		$this->db->where('va.ESTADO', 1);
		$this->db->where('va.TIPO', 'acceso');
		$this->db->where('va.ACCESO_BOTON', 1);

		$datos['menus'] = $this->main->getListSelect('VENTAS_ACCESO va', 'va.ID_VENTAS_ACCESO, NOMBRE', ['NOMBRE'=>'ASC']);

		echo $this->load->view('usuario/boton', $datos, TRUE);
	break;

	case 'sucursal-formas-pago':

		$datos['sucursales'] = $this->main->getListSelect('ID_UBICACION', 'ID_UBICACION AS ID, DESCRIPCION AS TEXT', ['ID_UBICACION' => 'ASC'], ['ESTADO' => 1]);

		echo $this->load->view('configuraciones/sucursal/formas', $datos, TRUE);
	break;

	case 'permisos-boton-sucursal':
		
		$datos['sucursales'] = $this->main->getListSelect('ID_UBICACION', 'ID_UBICACION AS ID, DESCRIPCION AS TEXT', ['ID_UBICACION' => 'ASC'], ['ESTADO' => 1]);

		echo $this->load->view('configuraciones/sucursal/boton', $datos, TRUE);

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
											$sucursales = $this->main->getListSelect('ID_UBICACION', 'CODIGO_SUCURSAL AS id, DESCRIPCION AS text', ['CODIGO_SUCURSAL'=>'ASC']);
											$datos['sucursales'] = $this->main->dropdown($sucursales, '');
											echo $this->load->view('facturacion/cuis', $datos, TRUE);
										break;

										case 'evento-significativo':

											
											$sql = "EXEC GET_EVENTOS_SIGNIFICATIVOS";
											$DB2 = $this->load->database('default', TRUE);
											$data['eventos'] = $DB2->query($sql)->result();
		   
											
											echo $this->load->view('facturacion/eventos', $data, TRUE);
										break;

	case 'acceso-perfiles':

		$data['perfiles'] = $this->main->getListSelect('VENTAS_PERFIL', 'ID_VENTAS_PERFIL AS id, PERFIL AS text', ['ID_VENTAS_PERFIL'=>'ASC']);

		echo $this->load->view('perfiles/acceso', $data, TRUE);
	break;

	case 'acceso-perfiles-ventas':

		$data['perfiles'] = $this->main->getListSelect('VENTAS_PERFIL', 'ID_VENTAS_PERFIL AS id, PERFIL AS text', ['ID_VENTAS_PERFIL'=>'ASC']);

		echo $this->load->view('perfiles/acceso_ventas', $data, TRUE);
	break;

										case 'reset-pasword':
											
											$campos = "vu.ID_USUARIO AS id, CONCAT_WS(' ', se.NOMBRE, se.AP_PATERNO, se.AP_MATERNO) AS text";
											$this->db->where('vu.ELIMINADO', 0);
											$this->db->join('SIREPE_EMPLEADO se', 'se.ID_EMPLEADO = vu.ID_EMPLEADO', 'left');
											$datos['usuarios'] = $this->main->getListSelect('VENTAS_USUARIOS vu', $campos, ['text'=>'ASC']);
									
											echo $this->load->view('generico/apertura/reset', $datos, TRUE);
										break;

										case 'producto':

											$data['categoria'] = $this->main->getListSelect('VENTAS_CATEGORIA_1', 'ID_CATEGORIA, CATEGORIA');
											
															  $this->db->where('ID_VENTAS_F02_CATALOGOS', 18);
											$data['medidas'] = $this->main->getListSelect('VENTAS_F02_SINCRONIZACION', 'CODIGO AS id, DESCRIPCION AS text');
											
											$data['tamanios'] = $this->main->getListSelect('VENTAS_TAMAÑO', 'ID_TAMAÑO AS id, TAMAÑO AS text');

											$data['listas'] = $this->main->getListSelect('VENTAS_NOMBRE_LISTA_PRECIOS', 'ID_NOMBRE_LISTA_PRECIOS AS id, NOMBRE_LISTA_PRECIOS AS text');
											
										 echo $this->load->view('facturacion/categoria', $data, TRUE);
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
