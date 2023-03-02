<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('existencia')) {
	function existencia($db, $sufijo){

		$CI =& get_instance();

		$data['existencia'] =  $CI->main->getListSelect('EXISTENCIA', '*', ['ORDEN'=>'ASC']);
	
		$DB2 = $CI->load->database($db, TRUE);
	
		$sql = "SELECT ID_SUBCATEGORIA_2, CANTIDAD, ESTADO_CONTEO FROM INVENTARIOS_DECLARACION_".$sufijo." WHERE FECHA_CONTEO ='".date('Y-m-d')."'";
	
		$registro = $DB2->query($sql)->result();

		$sql2 = "SELECT ESTADO, FECHA FROM CABECERA_PEDIDO_".$sufijo." WHERE FECHA ='".date('Y-m-d')."'";
		$cabecera = $DB2->query($sql2)->result();

		$array = [];  $estado = [];

		foreach ($registro as $value) {
			$array[$value->ID_SUBCATEGORIA_2] = $value->CANTIDAD;
		}

	 	$data['registro'] = $array;
	 	$data['db'] = $db;
	 	$data['sufijo'] = $sufijo;
	 	$data['cabecera'] = $cabecera;

		return $data;

	}
}


if(!function_exists('solicitud')) {

	function solicitud($db, $sufijo, $sucursal) {

		$CI =& get_instance();

		$data['lista'] = $CI->main->getListSelect('INVENTARIOS_LISTA_STOCKS_SUCURSALES', 'ID_LISTA_STOCK AS ID, NOMBRE_LISTA AS TEXT', ['NOMBRE_LISTA'=>'ASC'], ['ID_SUCURSAL'=>$sucursal]);

		$DB2 = $CI->load->database($db, TRUE);

		$sql_first = 'SELECT DATEADD(HH, -4, CONVERT(time, GETDATE())) AS HORA';
		$actual = $DB2->query($sql_first)->result();

		$hora1 = strtotime( "06:00:00" );
		$hora2 = strtotime( $actual[0]->HORA );

		if( $hora1 > $hora2 ) {
			$sql_date = 'select CONVERT (date, GETDATE()-1) AS DIA';
			
		} else {
			$sql_date = 'select CONVERT (date, GETDATE()) AS DIA';
		} 

		$fecha = $DB2->query($sql_date)->result();
		$data['existencia'] =  $CI->main->getListSelect('EXISTENCIA', '*', ['ORDEN'=>'ASC']);

		$sql = "SELECT ID_SUBCATEGORIA_2, CANTIDAD, CANTIDAD_SOLICITADA, PRECARGADO, ESTADO_CONTEO, ADECUACION, MINIMO FROM INVENTARIOS_DECLARACION_".$sufijo." WHERE FECHA_CONTEO ='".$fecha[0]->DIA."'";
		$registro = $DB2->query($sql)->result();

		$sql2 = "SELECT ESTADO, FECHA, PERFIL FROM CABECERA_PEDIDO_".$sufijo." WHERE FECHA ='".$fecha[0]->DIA."'";
		$cabecera = $DB2->query($sql2)->result();

		$CI->session->set_userdata(array('fecha_conteo' => $fecha[0]->DIA));


		$array = [];  $estado = []; $adecuacion = []; $solicitud = []; $precargado=[]; $minimo=[];

		foreach ($registro as $value) {
			$array[$value->ID_SUBCATEGORIA_2] = $value->CANTIDAD;
			$estado[$value->ID_SUBCATEGORIA_2] = $value->ESTADO_CONTEO;
			$adecuacion[$value->ID_SUBCATEGORIA_2] = $value->ADECUACION;
			$solicitud[$value->ID_SUBCATEGORIA_2] = $value->CANTIDAD_SOLICITADA;
			$precargado[$value->ID_SUBCATEGORIA_2] = $value->PRECARGADO;
			$minimo[$value->ID_SUBCATEGORIA_2] = $value->MINIMO;
		}

		$data['registro'] = $array;
		$data['estado'] = $estado;
		$data['adecuacion'] = $adecuacion;
		$data['solicitud'] = $solicitud;
		$data['db'] = $db;
		$data['sufijo'] = $sufijo;
		$data['cabecera'] = $cabecera;
		$data['precargado'] = $precargado;
		$data['minimo'] = $minimo;

		return $data;
	}
}

if(!function_exists('preparacion')) {
	function preparacion($db, $sufijo) {

		$CI =& get_instance();

		$data['existencia'] =  $CI->main->getListSelect('EXISTENCIA', '*', ['ORDEN'=>'ASC']);
	$DB2 = $CI->load->database($db, TRUE);

	$sql_turno = "SELECT TURNO FROM INVENTARIOS_TURNO";
	$turnos = $CI->db->query($sql_turno)->result();


	$sql_first = 'SELECT DATEADD(HH, -4, CONVERT(time, GETDATE())) AS HORA';
	$actual = $DB2->query($sql_first)->result();

	
	$sql_date = "SELECT FECHA FROM CABECERA_PEDIDO_".$sufijo." WHERE FECHA_SOLICITUD = (SELECT MAX(FECHA_SOLICITUD) FROM CABECERA_PEDIDO_".$sufijo.") ";   // QUITAR UN DIA
	$fecha = $DB2->query($sql_date)->result();

	$sql = "SELECT ID_SUBCATEGORIA_2, CANTIDAD_SOLICITADA, ESTADO_CONTEO, OBSERVACION, CANTIDAD_ENVIADA, TURNO FROM INVENTARIOS_DECLARACION_".$sufijo." WHERE FECHA_CONTEO ='".$fecha[0]->FECHA."'";
	$registro = $DB2->query($sql)->result();

	$sql2 = "SELECT ESTADO, FECHA FROM CABECERA_PEDIDO_".$sufijo." WHERE FECHA ='".$fecha[0]->FECHA."'";
	$cabecera = $DB2->query($sql2)->result();


	$array = [];  $estado = []; $observacion = []; $solicitada = []; $envio = [];

	foreach ($registro as $value) {
		$array[$value->ID_SUBCATEGORIA_2] = $value->CANTIDAD_SOLICITADA;
		$estado[$value->ID_SUBCATEGORIA_2] = $value->ESTADO_CONTEO;
		$observacion[$value->ID_SUBCATEGORIA_2] = $value->OBSERVACION;
		$solicitada[$value->ID_SUBCATEGORIA_2] = $value->CANTIDAD_ENVIADA;
		$envio[$value->ID_SUBCATEGORIA_2] = $value->TURNO;
	}

	
	 $data['registro'] = $array;
	 $data['estado'] = $estado;
	 $data['db'] = $db;
	 $data['sufijo'] = $sufijo;
	 $data['cabecera'] = $cabecera;
	 $data['observacion'] = $observacion;
	 $data['solicitada'] = $solicitada;
	 $data['fecha'] = $fecha[0]->FECHA;
	 $data['turnos'] = $turnos;
	 $data['envio'] = $envio;

	 return $data;

	}
}

if( ! function_exists('despacho')) {
	function despacho() {

		$CI =& get_instance();

		$sql = "SELECT * FROM INVENTARIOS_TURNO"; 
		$turno = $CI->db->query($sql)->result();

		$data['turno'] = $turno;

		return $data;

	}
}

if(!function_exists('guardarProducto') ) {
	function guardarProducto($id, $sum) {

		$CI =& get_instance();

		$sql = "SELECT * FROM DESPACHO WHERE ID_SUB_CATEGORIA_2 = ? AND FECHA = ?";
		$existe = $CI->db->query($sql, array($id, date('Y-m-d')))->result();

		if(!$existe) {

			$sql2 = "EXECUTE SET_DESPACHO ?, ?, ?, ?"; 
			$CI->db->query($sql2, array($id, $sum, date('Y-m-d'), date('H:i:s')));

		}

		return $existe;
	}
}


if(!function_exists('recepcion')){

	function recepcion($db, $sufijo) {
		$CI =& get_instance();

		$data['existencia'] =  $CI->main->getListSelect('EXISTENCIA', '*', ['ORDEN'=>'ASC']);
	
		$DB2 = $CI->load->database($db, TRUE);

		$sql5 = "SELECT CAST((SELECT MAX(FECHA_PREPARACION) FROM CABECERA_PEDIDO_".$sufijo.") AS Date) AS DIA;";
		$fecha = $DB2->query($sql5)->result();

	
		$sql = "SELECT ID_INVENTARIOS_DECLARACION, NOMBRE_PRODUCTO, CANTIDAD_ENVIADA, CANTIDAD_ACEPTADA, ID_SUBCATEGORIA_2 FROM INVENTARIOS_DECLARACION_".$sufijo." WHERE FECHA_CONTEO ='".$fecha[0]->DIA."'";
	
		$registro = $DB2->query($sql)->result();


		$sql2 = "SELECT ESTADO, FECHA FROM CABECERA_PEDIDO_".$sufijo." WHERE FECHA ='".$fecha[0]->DIA."'";
		$cabecera = $DB2->query($sql2)->result();


		$array = [];  $estado = []; $aceptada = [];

		foreach ($registro as $value) {
			$array[$value->ID_SUBCATEGORIA_2] = $value->CANTIDAD_ENVIADA;
			$aceptada[$value->ID_SUBCATEGORIA_2] = $value->CANTIDAD_ACEPTADA;
		}

	 	$data['registro'] = $array;
	 	$data['aceptada'] = $aceptada;
	 	$data['db'] = $db;
	 	$data['sufijo'] = $sufijo;
	 	$data['cabecera'] = $cabecera;

		return $data;
	}
}

if(!function_exists('entrega')){

	function entrega($db, $sufijo, $ubicacion) {
		$CI =& get_instance();

		$data['existencia'] =  $CI->main->getListSelect('EXISTENCIA', '*', ['ORDEN'=>'ASC']);
	
		$DB2 = $CI->load->database($db, TRUE);

		$sql5 = "SELECT CAST((SELECT MAX(FECHA_RECEPCION) FROM CABECERA_PEDIDO_".$sufijo.") AS Date) AS DIA;";
		$fecha = $DB2->query($sql5)->result();

	
		$sql = "SELECT ID_INVENTARIOS_DECLARACION, NOMBRE_PRODUCTO, CANTIDAD_ENVIADA, CANTIDAD_ACEPTADA, CANTIDAD_ENTREGADA, CANTIDAD_DEVUELTA, ID_SUBCATEGORIA_2 FROM INVENTARIOS_DECLARACION_".$sufijo." WHERE FECHA_CONTEO ='".$fecha[0]->DIA."'";
	
		$registro = $DB2->query($sql)->result();


		$sql2 = "SELECT ESTADO, FECHA FROM CABECERA_PEDIDO_".$sufijo." WHERE FECHA ='".$fecha[0]->DIA."'";
		$cabecera = $DB2->query($sql2)->result();


		$array = [];  $entregada = []; $devuelta = []; $aceptada=[];

		foreach ($registro as $value) {
			$array[$value->ID_SUBCATEGORIA_2] = $value->CANTIDAD_ENVIADA;
			$aceptada[$value->ID_SUBCATEGORIA_2] = $value->CANTIDAD_ACEPTADA;
			$entregada[$value->ID_SUBCATEGORIA_2] = $value->CANTIDAD_ENTREGADA;
			$devuelta[$value->ID_SUBCATEGORIA_2] = $value->CANTIDAD_DEVUELTA;
		}

	 	$data['registro'] = $array;
		$data['aceptada'] = $aceptada;
		$data['entregada'] = $entregada;
		$data['devuelta'] = $devuelta;
	 	$data['db'] = $db;
	 	$data['sufijo'] = $sufijo;
	 	$data['cabecera'] = $cabecera; 
		$data['ubicacion'] = $ubicacion;

		return $data;

	}

}



if(!function_exists('getPedidoSucursal')) {
	function getPedidoSucursal($bd, $sufijo_sucursal, $fecha, $tipo_reporte){
		$CI =& get_instance();
		$DB2 = $CI->load->database($bd, TRUE);
		if($tipo_reporte =='ALL'){
			$sql = "select * from INVENTARIOS_DECLARACION".$sufijo_sucursal." ida where FECHA_CONTEO ='$fecha';";
		}else{
			$sql = "select * from INVENTARIOS_DECLARACION".$sufijo_sucursal." ida where FECHA_CONTEO ='$fecha' and TURNO='$tipo_reporte';";
		}
		
		$respuesta = $DB2->query($sql);
		$respuesta = $respuesta->result();
		return $respuesta;
	}
}


if(!function_exists('getInventariosSubcategoria2')) {
	function getInventariosSubcategoria2(){
		$CI =& get_instance();
		$sql = "select (SELECT (CATEGORIA) from INVENTARIOS_CATEGORIA c where c.ID_CATEGORIA =v1.ID_CATEGORIA ) as CATEGORIA, *, (SELECT d.RECIBIDA FROM DESPACHO d WHERE v2.ID_SUB_CATEGORIA_2 = d.ID_SUB_CATEGORIA_2 AND d.FECHA = '".date('Y-m-d')."') AS RECIBIDA,
		(SELECT d.ESTADO FROM DESPACHO d WHERE v2.ID_SUB_CATEGORIA_2 = d.ID_SUB_CATEGORIA_2 AND d.FECHA = '".date('Y-m-d')."') AS ESTADO  from INVENTARIOS_SUB_CATEGORIA_2 v2, INVENTARIOS_SUB_CATEGORIA_1 v1 where v2.ID_SUB_CATEGORIA_1 =v1.ID_SUB_CATEGORIA_1 and v1.ESTADO=1 and v2.ESTADO_REPOSICION=1 and v1.ID_CATEGORIA is not null;";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta;
	}
}

if(!function_exists('buscarCantidadSubcategoria2')) {
	function buscarCantidadSubcategoria2($pedidoSucursal, $subcategoria){
		$encontrado = false;
		$i=0;
		$cant = 0;
		while ($i < count($pedidoSucursal) && $encontrado ==false) {
		$sub = $pedidoSucursal[$i]->ID_SUBCATEGORIA_2;
		if($sub == $subcategoria){
			$cant = $pedidoSucursal[$i]->CANTIDAD_SOLICITADA;
			$encontrado = true;
		}
		$i++;
		}
		return $cant;
	}
}

if(!function_exists('guardarPedidoExtraordinario')) {
	function guardarPedidoExtraordinario($bd, $prefijo_sucursal, $sufijo_sucursal, $categoria_1, $categoria_2, $producto_madre, $modificado, $detalle, $id_usuario, $fecha_registro, $fecha_entrega_pedido) {
		$CI =& get_instance();
		$DB2 = $CI->load->database($bd, TRUE);
		$sql = "EXEC ".$prefijo_sucursal."SET_PEDIDO_EXTRAORDINARIO '$categoria_1','$categoria_2','$producto_madre','$modificado','$detalle','$id_usuario','$fecha_registro','$fecha_entrega_pedido' ;";
		if(($respuesta = $DB2->query($sql)->result())){
			if(count($respuesta)==1){
				return $respuesta[0]->ID_PEDIDO_EXTRAORDINARIO;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}


if(!function_exists('eliminar_pedido_extraordinario')) {
	function eliminar_pedido_extraordinario($bd, $sufijo_sucursal, $id_pedido_extraordinario){
		$CI =& get_instance();
		$DB2 = $CI->load->database($bd, TRUE);
		$sql = "update PEDIDO_EXTRAORDINARIO".$sufijo_sucursal." SET ESTADO=3 where ID_PEDIDO_EXTRAORDINARIO='$id_pedido_extraordinario';";
		if($DB2->query($sql)){
			return true;
		}else{
			return false;
		}
	}
}

if(!function_exists('cambiar_estado_pe')) {
	function cambiar_estado_pe($bd, $sufijo_sucursal, $id_pedido_extraordinario, $estado){
		$CI =& get_instance();
		$DB2 = $CI->load->database($bd, TRUE);
		$sql = "update PEDIDO_EXTRAORDINARIO".$sufijo_sucursal." SET ESTADO='$estado' where ID_PEDIDO_EXTRAORDINARIO='$id_pedido_extraordinario';";
		if($DB2->query($sql)){
			return true;
		}else{
			return false;
		}
	}
}


if(!function_exists('cambiar_aprobacion_pe_planta')) {
	function cambiar_aprobacion_pe_planta($bd, $sufijo_sucursal, $id_pedido_extraordinario, $estado){
		$CI =& get_instance();
		$DB2 = $CI->load->database($bd, TRUE);
		$sql = "update PEDIDO_EXTRAORDINARIO".$sufijo_sucursal." SET ESTADO_PLANTA='$estado' where ID_PEDIDO_EXTRAORDINARIO='$id_pedido_extraordinario';";
		if($DB2->query($sql)){
			return true;
		}else{
			return false;
		}
	}
}

if(!function_exists('getPedidosExtraordinarios')) {
	function getPedidosExtraordinarios($bd, $sufijo_sucursal, $fecha_inicial, $fecha_entrega_pedido, $filtro_aprobacion) {
		switch ($filtro_aprobacion) {
			case 'all':
				$filtro_ap = '';
				break;
			case 'pendientes':
				$filtro_ap = 'and ESTADO <> 5';
				break;
			case 'aprobados':
				$filtro_ap=' and ESTADO = 5';
				break;
			default:
				$filtro_ap='';
				break;
		}
		$CI =& get_instance();
		$DB2 = $CI->load->database($bd, TRUE);
		$sql = "select * from PEDIDO_EXTRAORDINARIO".$sufijo_sucursal." where ESTADO<>2 ".$filtro_ap." and FECHA_ENTREGA_PEDIDO between '$fecha_inicial' and '$fecha_entrega_pedido' order by FECHA_ENTREGA_PEDIDO desc;";
		$respuesta = $DB2->query($sql);
		return $respuesta->result();
	}
}

if(!function_exists('getPedidosExtraordinariosAdm')) {
	function getPedidosExtraordinariosAdm($bd, $sufijo_sucursal, $fecha_inicial, $fecha_entrega_pedido) {
		$CI =& get_instance();
		$DB2 = $CI->load->database($bd, TRUE);
		$sql = "select * from PEDIDO_EXTRAORDINARIO".$sufijo_sucursal." where ESTADO=1  and  ESTADO_SUPERVISOR=1 and FECHA_ENTREGA_PEDIDO between '$fecha_inicial' and '$fecha_entrega_pedido' order by FECHA_ENTREGA_PEDIDO desc;";
		$respuesta = $DB2->query($sql);
		return $respuesta->result();
	}
}

if(!function_exists('getPermisosBotonesPedidosExtraordinarios')) {
	function getPermisosBotonesPedidosExtraordinarios($id_usuario) {
		$CI =& get_instance();
		$sql = "select * from INVENTARIOS_BOTONES_PE where ID_USUARIO='$id_usuario';";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta[0];
	}
}

if(!function_exists('getNombreCategoria1')) {
	function getNombreCategoria1($id){
		$CI =& get_instance();
		$sql="select * from INVENTARIOS_CATEGORIA where ID_CATEGORIA='$id';";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta[0];
	}
}

if(!function_exists('getNombreCategoria2')) {
	function getNombreCategoria2($id){
		$CI =& get_instance();
		$sql="select * from INVENTARIOS_SUB_CATEGORIA_1 where ID_SUB_CATEGORIA_1='$id';";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta[0];
	}
}

if(!function_exists('getNombreProducto')) {
	function getNombreProducto($id){
		$CI =& get_instance();
		$sql="select * from INVENTARIOS_SUB_CATEGORIA_2 where ID_SUB_CATEGORIA_2='$id';";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta[0];
	}
}

if(!function_exists('perfilPed')) {
	function perfilPed($sucursal) {
		$CI =& get_instance();

		$id = $CI->session->id_usuario;

		$datos['perfiles'] = $CI->main->getListSelect('INVENTARIOS_LISTA_STOCKS_SUCURSALES ss', 'ss.ID_LISTA_STOCK AS ID, ss.NOMBRE_LISTA AS TEXT', ['ss.NOMBRE_LISTA'=>'ASC'], ['ss.ID_SUCURSAL'=>$sucursal]);

		$datos['sucursal'] = $sucursal;

		return $datos;

	}
}