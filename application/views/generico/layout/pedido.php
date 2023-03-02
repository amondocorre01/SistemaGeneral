<?php

case 'perfilPed-prueba':

	$sucursal = 2;

	$id = $this->session->id_usuario;

	$datos['perfiles'] = $this->main->getListSelect('INVENTARIOS_LISTA_STOCKS_SUCURSALES ss', 'ss.ID_LISTA_STOCK AS ID, ss.NOMBRE_LISTA AS TEXT', ['ss.NOMBRE_LISTA'=>'ASC'], ['ss.ID_SUCURSAL'=>$sucursal]);

	$datos['sucursal'] = 2;
	
	echo $this->load->view('generico/apertura/perfil_pedido', $datos, TRUE);
break;

case 'recepcion-prueba':

	$db = 'ventas';
	$sufijo = 'AE';
	$sucursal = 2;

	$data = recepcion($db, $sufijo);

	echo $this->load->view('generico/apertura/recepcion', $data, TRUE);

break;


case 'solicitud-prueba':

	$db = 'ventas';
	$sufijo = 'AE';
	$sucursal = 2;

	$data = solicitud($db, $sufijo, $sucursal);
	

	echo $this->load->view('generico/apertura/solicitud', $data, TRUE);
break;


case 'existencia-prueba':

	$db = 'ventas';
	$sufijo = 'AE';

	$data = existencia($db, $sufijo);

	echo $this->load->view('generico/apertura/existencia', $data, TRUE);
break;


case 'entrega-prueba':
	$db = 'ventas';
	$sufijo = 'AE';
	$ubicacion = 13;

	$data = entrega($db, $sufijo, $ubicacion);

	echo $this->load->view('generico/apertura/transporte', $data, TRUE);
break;

case 'apv-prueba':

	$db = 'ventas';
	$sufijo = 'AE';

	$data = preparacion($db, $sufijo);

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


?>