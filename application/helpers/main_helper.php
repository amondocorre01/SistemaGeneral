<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('base')){
	function base()
	{	
		
	  $CI =& get_instance();

	  $campos = "ID_CATEGORIA, CATEGORIA, COLOR, ORDENADO, CAT2"; 
      $categorias = $CI->main->getListSelect('CATEGORIAS', $campos, ['ORDENADO'=>'ASC']);


      $CI->session->set_userdata('categorias', $categorias);

	
      $categoria_2 = $CI->main->getListSelect('CATEGORIA_2', '*');

      $CI->session->set_userdata('categoria_2', $categoria_2);
	          
	}
}

if (!function_exists('basico')) {

	function basico($numero) {
		$valor = ['uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho','diecinueve','veinte','veintiuno','veintidos','veintitres', 'veinticuatro','veinticinco',
		'veintiséis','veintisiete','veintiocho','veintinueve'];
		return $valor[$numero - 1];
	  }

}

if (!function_exists('decenas')) {
	function decenas($n) {
		$decenas = [30=>'treinta',40=>'cuarenta',50=>'cincuenta',60=>'sesenta',
		70=>'setenta',80=>'ochenta',90=>'noventa'];
		if( $n <= 29) return basico($n);
		$x = $n % 10;
		if ( $x == 0 ) {
		return $decenas[$n];
		} else return $decenas[$n - $x].' y '. basico($x);
	  }
}


if(!function_exists('centenas')) {

	function centenas($n) {
		$cientos = [100 =>'cien',200 =>'doscientos',300=>'trecientos',
		400=>'cuatrocientos', 500=>'quinientos',600=>'seiscientos',
		700=>'setecientos',800=>'ochocientos', 900 =>'novecientos'];
		if( $n >= 100) {
		if ( $n % 100 == 0 ) {
			return $cientos[$n];
		} else {
		$u = (int) substr($n,0,1);
		$d = (int) substr($n,1,2);
		return (($u == 1)?'ciento':$cientos[$u*100]).' '.decenas($d);
		}
		} else return decenas($n);
	}
}

if(!function_exists('miles')) {

	function miles($n) {
		if($n > 999) {
		if( $n == 1000) {return 'mil';}
		else {
		$l = strlen($n);
		$c = (int)substr($n,0,$l-3);
		$x = (int)substr($n,-3);
		if($c == 1) {$cadena = 'mil '.centenas($x);}
		else if($x != 0) {$cadena = centenas($c).' mil '.centenas($x);}
		else $cadena = centenas($c). ' mil';
		return $cadena;
		}
		} else return centenas($n);
	}
}

if(!function_exists('millones')) {

	function millones($n) {
		if($n == 1000000) {return 'un millón';}
		else {
		$l = strlen($n);
		$c = (int)substr($n,0,$l-6);
		$x = (int)substr($n,-6);
		if($c == 1) {
		$cadena = ' millón ';
		} else {
		$cadena = ' millones ';
		}
		return miles($c).$cadena.(($x > 0)?miles($x):'');
		}
	}
}

if(!function_exists('convertir')) {

	function convertir($n) {
		switch (true) {
		case ( $n >= 1 && $n <= 29) : return basico($n); break;
		case ( $n >= 30 && $n < 100) : return decenas($n); break;
		case ( $n >= 100 && $n < 1000) : return centenas($n); break;
		case ($n >= 1000 && $n <= 999999): return miles($n); break;
		case ($n >= 1000000): return millones($n);
		}
	  }

}

if(!function_exists('botones')) {
	function botones($id_menu, $id_usuario) {

		$CI =& get_instance();

		$sql = "SELECT ID_VENTAS_ACCESO, 
	    (
		    SELECT vb.REFERENCIA_BOTON, vb.ESTADO 
		    FROM VENTAS_BOTON vb, VENTAS_ACCESO_BOTON vab 
		    WHERE vb.ID_VENTAS_ACCESO = va.ID_VENTAS_ACCESO AND 
			  vb.ID_VENTAS_BOTON = vab.ID_VENTAS_BOTON AND 
			  vab.ID_USUARIO = ? FOR JSON AUTO) AS BOTONES
            FROM VENTAS_ACCESO va WHERE ID_VENTAS_ACCESO = ?;";
   		$data = $CI->db->query($sql, array($id_usuario, $id_menu));

		return $data->result();
	}
}


if(!function_exists('strToHex')) {
	function strToHex($string){
		$hex = '';
		for ($i=0; $i<strlen($string); $i++){
			$ord = ord($string[$i]);
			$hexCode = dechex($ord);
			$hex .= substr('0'.$hexCode, -2);
		}
		return strToUpper($hex);
	}
}
if(!function_exists('getSucursal')) {
	function getSucursal($codigo){
		$CI =& get_instance();
		$res = null;
		$sql="select * FROM ID_UBICACION WHERE CODIGO = '$codigo';";
		$res = $CI->main->getQuery($sql);
		$res = $res[0];
		return $res;
	}
}

if(!function_exists('getTokenApi')) {
	function getTokenApi(){
		$CI =& get_instance();
		$sql = "select * from VENTAS_F00_LLAVE vfl WHERE ESTADO = 1; ";
		$respuesta = $CI->main->getQuery($sql);
		return 'TokenApi '.$respuesta[0]->TOKEN_API;
	}
  }
  if(!function_exists('getUsuarios')) {
	function getUsuarios(){
		$CI =& get_instance();
		$res = null;
		$sql="select ID_USUARIO , USUARIO ,TIPO_USUARIO ,CI,NOMBRE,AP_PATERNO,AP_MATERNO,CELULAR FROM VENTAS_USUARIOS vu, SIREPE_EMPLEADO se  WHERE se.ID_EMPLEADO = vu.ID_EMPLEADO ";
		$res = $CI->main->getQuery($sql);
		return $res;
	}
}

if(!function_exists('getUsuariosSucursal')) {
	function getUsuariosSucursal($id_ubicacion){
		$CI =& get_instance();
		$res = null;
		$sql = "select ID_USUARIO , USUARIO ,TIPO_USUARIO ,CI,NOMBRE,AP_PATERNO,AP_MATERNO,CELULAR FROM VENTAS_USUARIOS vu, SIREPE_EMPLEADO se  WHERE se.ID_EMPLEADO = vu.ID_EMPLEADO and vu.TIPO_USUARIO = 'cajero' and vu.ID_USUARIO in (select distinct(ID_USUARIO) from VENTAS_PERMISO_SUCURSAL where ID_UBICACION='$id_ubicacion')";
		$res = $CI->main->getQuery($sql);
		return $res;
	}
}

if(!function_exists('getUsuariosSucursalUsuario')) {
	function getUsuariosSucursalUsuario($id_usuario, $id_ubicacion){
		$CI =& get_instance();
		$res = null;
		$sql = "select ID_USUARIO , USUARIO ,TIPO_USUARIO ,CI,NOMBRE,AP_PATERNO,AP_MATERNO,CELULAR FROM VENTAS_USUARIOS vu, SIREPE_EMPLEADO se  WHERE se.ID_EMPLEADO = vu.ID_EMPLEADO and vu.TIPO_USUARIO = 'cajero' and vu.ID_USUARIO='$id_usuario' and vu.ID_USUARIO in (select distinct(ID_USUARIO) from VENTAS_PERMISO_SUCURSAL where ID_UBICACION='$id_ubicacion')";
		$res = $CI->main->getQuery($sql);
		return $res;
	}
}


if(!function_exists('searchUsuario')) {
	function searchUsuario($array,$id){
		$res='';
		foreach ($array as $key => $value) {
			if($id == ($value->ID_USUARIO) ){
				$res = $value->NOMBRE.' '.$value->AP_PATERNO.' '.$value->AP_MATERNO;
				return $res;
			}
		}
		return $res;
	}
}
if(!function_exists('rangoFacturas')) {
function rangoFacturas($bd, $sufijo, $id_turno){
	$res='';
	$sql = "select ISNULL(MIN(NUMERO_FACTURADO),0) as MINIMO, ISNULL(MAX(NUMERO_FACTURADO),0) as MAXIMO FROM VENTA_DOCUMENTO".$sufijo."  WHERE ID_TURNO = '$id_turno' AND FACTURADO = 1 ;";
	$CI =& get_instance();
	$DB2 = $CI->load->database($bd, TRUE);
	$respuesta = $DB2->query($sql);
	$respuesta = $respuesta->result();
	if(count($respuesta)==1){
		$min = $respuesta[0]->MINIMO;
		$max = $respuesta[0]->MAXIMO;
		$res= $min.'-'.$max;
	}
	return $res;
}
}

if(!function_exists('getIngresos')) {
function getIngresos($bd, $prefijo, $sufijo_sucursal, $id_turno){
	$res=0;
	//$sql = "EXEC ".$prefijo."SUMA_INGRESOS '$id';";
	$sql = "select ((select CASE WHEN (SUM(MONTO)) IS NULL THEN 0 ELSE (SUM(MONTO)) END AS TOTAL_A from MOVIMIENTOS_CAJA".$sufijo_sucursal." where ID_CIERRE_APERTURA_TURNO = '$id_turno' and ingreso = '1' and ID_VENTA_DOCUMENTO = '0' and ID_TIPO_PAGO = '1')+(select CASE WHEN (SUM(MONTO)) IS NULL THEN 0 ELSE (SUM(MONTO)) END AS TOTAL_B from MOVIMIENTOS_CAJA".$sufijo_sucursal." mcs , VENTA_DOCUMENTO".$sufijo_sucursal." vds where mcs.ID_VENTA_DOCUMENTO = vds.ID_VENTA_DOCUMENTO and vds.ANULADO = '0' and ID_CIERRE_APERTURA_TURNO = '$id_turno' and ingreso = '1' and ID_TIPO_PAGO = '1')) as TOTAL;";
	$CI =& get_instance();
	$DB2 = $CI->load->database($bd, TRUE);
	$respuesta = $DB2->query($sql);
	$respuesta = $respuesta->result();
	if(count($respuesta)==1){
		$res = $respuesta[0]->TOTAL;
		if($res ==null){
			$res=0;
		}
	}
	return $res;
}
}

if(!function_exists('getEgresos')) {
function getEgresos($bd, $prefijo, $sufijo_sucursal, $id_turno){
	$res=0;
	//$sql = "EXEC ".$prefijo."SUMA_EGRESOS '$id';";
	$sql = "select ((select CASE WHEN (SUM(MONTO)) IS NULL THEN 0 ELSE (SUM(MONTO)) END AS TOTAL_A from MOVIMIENTOS_CAJA".$sufijo_sucursal." where ID_CIERRE_APERTURA_TURNO = '$id_turno' and ingreso = '0' and ID_VENTA_DOCUMENTO = '0' and ID_TIPO_PAGO = '1')+(select CASE WHEN (SUM(MONTO)) IS NULL THEN 0 ELSE (SUM(MONTO)) END AS TOTAL_B from MOVIMIENTOS_CAJA".$sufijo_sucursal." mcs , VENTA_DOCUMENTO".$sufijo_sucursal." vds where mcs.ID_VENTA_DOCUMENTO = vds.ID_VENTA_DOCUMENTO and vds.ANULADO = '0' and ID_CIERRE_APERTURA_TURNO = '$id_turno' and ingreso = '0' and ID_TIPO_PAGO = '1')) as TOTAL;";
	$CI =& get_instance();
	$DB2 = $CI->load->database($bd, TRUE);
	$respuesta = $DB2->query($sql);
	$respuesta = $respuesta->result();
	if(count($respuesta)==1){
		$res = $respuesta[0]->TOTAL;
		if($res ==null){
			$res=0;
		}
	}
	return $res;
}
}


if(!function_exists('cantidadRecibos')) {
function cantidadRecibos($bd, $sufijo, $id_turno){
	$res=0;
	$sql = "select count(*) as CANTIDAD_RECIBOS from VENTA_DOCUMENTO".$sufijo." WHERE ID_TURNO = '$id_turno' and FACTURADO =0;";
	$CI =& get_instance();
	$DB2 = $CI->load->database($bd, TRUE);
	$respuesta = $DB2->query($sql);
	$respuesta = $respuesta->result();
	if(count($respuesta)==1){
		$res = $respuesta[0]->CANTIDAD_RECIBOS;
	}
	return $res;
}
}

if(!function_exists('getTurno')) {
function getTurno($bd, $sufijo_sucursal, $id_turno){
	$res=null;
	$sql = "select * from CIERRE_APERTURA_TURNO".$sufijo_sucursal." where ID_CIERRE_APERTURA_TURNO = '$id_turno' ;";
	$CI =& get_instance();
	$DB2 = $CI->load->database($bd, TRUE);
	$respuesta = $DB2->query($sql);
	$respuesta = $respuesta->result();
	return $respuesta[0];
}
}

if(!function_exists('getTotalTurno')) {
function getTotalTurno($bd, $sufijo_sucursal, $id_turno, $filtro){
	$res=0;
	$sql = "select CASE WHEN (SUM(monto)) IS NULL THEN 0 ELSE (SUM(monto)) END as TOTAL from VENTA_PAGO".$sufijo_sucursal." vps where DESCRIPCION_PAGO ='$filtro' and  vps.ID_VENTA_DOCUMENTO in (select ID_VENTA_DOCUMENTO  from VENTA_DOCUMENTO".$sufijo_sucursal." vds where ANULADO='0' and ID_TURNO = '$id_turno');";
	$CI =& get_instance();
	$DB2 = $CI->load->database($bd, TRUE);
	$respuesta = $DB2->query($sql);
	$respuesta = $respuesta->result();
	if(count($respuesta)==1){
		$res = $respuesta[0]->TOTAL;
	}
	return $res;
}
}
if(!function_exists('getTotalTurnoTransporte')) {
function getTotalTurnoTransporte($bd, $sufijo_sucursal, $id_turno, $filtro){
	$res=0;
	/*$sql = "select CASE WHEN (SUM(VP.MONTO)+SUM(CAST(VD.PRECIO_TRANSPORTE AS float))) IS NULL THEN 0 ELSE (SUM(VP.MONTO)+SUM(CAST(VD.PRECIO_TRANSPORTE AS float))) END AS TOTAL
	from VENTA_PAGO".$sufijo_sucursal." VP, VENTA_DOCUMENTO".$sufijo_sucursal." VD
	WHERE DESCRIPCION_PAGO='$filtro' AND VD.ID_VENTA_DOCUMENTO=VP.ID_VENTA_DOCUMENTO AND VD.ANULADO=0 AND ID_TURNO = '$id_turno';";*/
	$sql = "select ((select CASE WHEN (SUM(CAST(vts.PRECIO_CONTRATO AS float))) IS NULL THEN 0 ELSE (SUM(CAST(vts.PRECIO_CONTRATO AS float))) END AS TOTAL_TRANSPORTE from VENTA_PAGO".$sufijo_sucursal." vps, VENTA_DOCUMENTO".$sufijo_sucursal." vds , VENTA_TRANSPORTE".$sufijo_sucursal." vts where vds.ID_VENTA_DOCUMENTO =vps.ID_VENTA_DOCUMENTO and vds.ID_VENTA_DOCUMENTO =vts.ID_VENTA_DOCUMENTO and vds.ID_TURNO ='$id_turno' and vps.DESCRIPCION_PAGO='$filtro' and vds.ANULADO ='0') +
            (select CASE WHEN (SUM(monto)) IS NULL THEN 0 ELSE (SUM(monto)) END as TOTAL_PAGO from VENTA_PAGO".$sufijo_sucursal." vps where DESCRIPCION_PAGO ='$filtro' and  vps.ID_VENTA_DOCUMENTO in (select ID_VENTA_DOCUMENTO from VENTA_DOCUMENTO".$sufijo_sucursal." vds where ANULADO='0' and ID_TURNO = '$id_turno'))) as TOTAL ";
	$CI =& get_instance();
	$DB2 = $CI->load->database($bd, TRUE);
	$respuesta = $DB2->query($sql);
	$respuesta = $respuesta->result();
	if(count($respuesta)==1){
		$res = $respuesta[0]->TOTAL;
	}
	return $res;
}
}

if(!function_exists('getTotalCupon')) {
function getTotalCupon($bd, $sufijo_sucursal, $id_turno){
	$res=0;
	$sql = "select CASE WHEN (SUM(monto)) IS NULL THEN 0 ELSE (SUM(monto)) END as TOTAL from VENTA_PAGO".$sufijo_sucursal." vps where DESCRIPCION_PAGO like '%CUPON%' and  vps.ID_VENTA_DOCUMENTO in (select ID_VENTA_DOCUMENTO  from VENTA_DOCUMENTO".$sufijo_sucursal." vds where ANULADO='0' and ID_TURNO = '$id_turno');";
	$CI =& get_instance();
	$DB2 = $CI->load->database($bd, TRUE);
	$respuesta = $DB2->query($sql);
	$respuesta = $respuesta->result();
	if(count($respuesta)==1){
		$res = $respuesta[0]->TOTAL;
	}
	return $res;
}
}

if(!function_exists('getTotalTurnoNoEfectivo')) {
function getTotalTurnoNoEfectivo($bd, $sufijo_sucursal, $id_turno){
	$res=0;
	$sql = "select CASE WHEN (SUM(monto)) IS NULL THEN 0 ELSE (SUM(monto)) END as TOTAL from VENTA_PAGO".$sufijo_sucursal." vps where DESCRIPCION_PAGO !='EFECTIVO' and  vps.ID_VENTA_DOCUMENTO in (select ID_VENTA_DOCUMENTO  from VENTA_DOCUMENTO".$sufijo_sucursal." vds where ANULADO='0' and ID_TURNO = '$id_turno');";
	$CI =& get_instance();
	$DB2 = $CI->load->database($bd, TRUE);
	$respuesta = $DB2->query($sql);
	$respuesta = $respuesta->result();
	if(count($respuesta)==1){
		$res = $respuesta[0]->TOTAL;
	}
	
	return $res;
}
}

if(!function_exists('getUltimoCUFDBD')) {
	function getUltimoCUFDBD($bd, $sufijo_sucursal, $id) {
		$CI =& get_instance();
		$DB2 = $CI->load->database($bd, TRUE);
		$sql = "select * from VENTAS_F03_CUFD".$sufijo_sucursal." where ID_VENTAS_F01_CUIS='$id' and ESTADO = 1 order by ID_VENTAS_F03_CUF desc;";
		$respuesta = $DB2->query($sql);
		$respuesta = $respuesta->result();
		return $respuesta[0];
	}
}

if(!function_exists('getPrimeraCategoria')) {
	function getPrimeraCategoria(){
		$CI =& get_instance();
		$sql = "select * from VENTAS_CATEGORIA_1 where ELIMINADO='0'; ";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta;
	}
}

if(!function_exists('getSegundaCategoria')) {
	function getSegundaCategoria($id){
		$CI =& get_instance();
		$sql = "select * from VENTAS_CATEGORIA_2 where ID_CATEGORIA='$id' AND ELIMINADO = '0'; ";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta;
	}
}
if(!function_exists('getProductosMadre')) {
	function getProductosMadre($id){
		$CI =& get_instance();
		$sql = "select * from VENTAS_PRODUCTO_MADRE where ID_CATEGORIA_2='$id' AND ELIMINADO = '0'; ";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta;
	}
}

if(!function_exists('getTamProductos')) {
	function getTamProductos(){
		$CI =& get_instance();
		$sql = "select * from VENTAS_TAMAÑO; ";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta;
	}
}

if(!function_exists('getNombresListasPrecios')) {
	function getNombresListasPrecios(){
		$CI =& get_instance();
		$sql = "select * from VENTAS_NOMBRE_LISTA_PRECIOS; ";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta;
	}
}

if(!function_exists('getUnidadesMedida')) {
	function getUnidadesMedida(){
		$CI =& get_instance();
		$sql = "select * from VENTAS_F02_SINCRONIZACION where ID_VENTAS_F02_CATALOGOS='18'; ";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta;
	}
}

if(!function_exists('getProductoMadre')) {
	function getProductoMadre($id){
		$CI =& get_instance();
		$sql = "select (select * from VENTAS_PRODUCTO_MADRE vpm where ID_PRODUCTO_MADRE ='$id' FOR JSON AUTO) as resultado";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta[0];
	}
}

if(!function_exists('getProductosUnicos')) {
	function getProductosUnicos($id_producto_madre){
		$CI =& get_instance();
		$sql = "select * FROM VENTAS_PRODUCTO_UNICO where ID_PRODUCTO_MADRE ='$id_producto_madre' and ELIMINADO = '0';";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta;
	}
}

if(!function_exists('getPreciosProductoUnico')) {
	function getPreciosProductoUnico($id_producto_madre, $id_tam){
		$CI =& get_instance();
		$sql="select * FROM VENTAS_PRECIO_PRODUCTO_UNICO where ID_PRODUCTO_UNICO in (SELECT ID_PRODUCTO_UNICO  FROM VENTAS_PRODUCTO_UNICO where ID_PRODUCTO_MADRE ='$id_producto_madre' AND ID_TAMAÑO='$id_tam' AND ELIMINADO = '0');";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta;
	}
}

if(!function_exists('getTotalFrutasxProducto')) {
	function getTotalFrutasxProducto($id_producto_unico){
		$CI =& get_instance();
		$sql="select count(*) as TOTAL FROM VENTAS_PROCEDIMIENTO_VENTA WHERE ID_PRODUCTO_UNICO = '$id_producto_unico';";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta[0]->TOTAL;
	}
}

if(!function_exists('guardarProductoMadre')) {
	function guardarProductoMadre($nombre_producto, $id_categoria_2, $detalle_producto, $actividad_economica, $producto_sin, $unidad_medida, $tieneTransporte, $precioTransporte, $imagen){
		$CI =& get_instance();
		$sql = "insert into VENTAS_PRODUCTO_MADRE (PRODUCTO_MADRE, ID_CATEGORIA_2, DETALLE, CODIGO_ACTIVIDAD_ECONOMICA, CODIGO_PRODUCTO_SIN, CODIGO_UNIDAD_MEDIDA, TRANSPORTE, PRECIO_TRANSPORTE, IMAGEN, ELIMINADO)
		values('$nombre_producto','$id_categoria_2','$detalle_producto','$actividad_economica','$producto_sin','$unidad_medida','$tieneTransporte','$precioTransporte','$imagen','0');
		";
		$respuesta = $CI->db->query($sql);
		return $respuesta;
	}
}

if(!function_exists('getMaxProductoMadre')) {
	function getMaxProductoMadre(){
		$CI =& get_instance();
		$sql = "select max(ID_PRODUCTO_MADRE) AS ID_PRODUCTO_MADRE FROM VENTAS_PRODUCTO_MADRE;";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta[0]->ID_PRODUCTO_MADRE;
	}
}

if(!function_exists('guardarProductoUnico')) {
	function guardarProductoUnico($id_producto_madre, $id_tam){
		$CI =& get_instance();
		$sql = "insert into VENTAS_PRODUCTO_UNICO (ID_PRODUCTO_MADRE, ID_TAMAÑO, ORDENADO, ELIMINADO)values('$id_producto_madre','$id_tam','$id_tam','0');";
		$respuesta = $CI->db->query($sql);
	}
}
if(!function_exists('getMaxProductoUnico')) {
	function getMaxProductoUnico(){
		$CI =& get_instance();
		$sql = "select max(ID_PRODUCTO_UNICO) AS ID_PRODUCTO_UNICO FROM VENTAS_PRODUCTO_UNICO;";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta[0]->ID_PRODUCTO_UNICO;
	}
}

if(!function_exists('guardarPrecioProductoUnico')) {
	function guardarPrecioProductoUnico($id_nombre_lista_precios, $id_producto_unico, $precio){
		$CI =& get_instance();
		$sql = "insert into VENTAS_PRECIO_PRODUCTO_UNICO (ID_NOMBRE_LISTA_PRECIOS, ID_PRODUCTO_UNICO, PRECIO, ESTADO)values('$id_nombre_lista_precios','$id_producto_unico','$precio','1');";
		$respuesta = $CI->db->query($sql);
	}
}
if(!function_exists('guardarVentasProcedimientoVenta')) {
	function guardarVentasProcedimientoVenta($id_producto_unico, $cantidad_frutas){
		$CI =& get_instance();
		
		switch ($cantidad_frutas) {
			case '1':
				$sql = "insert into VENTAS_PROCEDIMIENTO_VENTA (ID_PRODUCTO_UNICO, PREGUNTA, PREGUNTA_COMANDA, ORDENADO, DELIVERY)values('$id_producto_unico','Primera fruta','Primera fruta','1','1');";
				$respuesta = $CI->db->query($sql);
				$id_proc = getMaxVentasProcedimientoVentas();
				guardarVentasProcedimientoOpciones($id_proc);
				break;
			case '2':
				$sql = "insert into VENTAS_PROCEDIMIENTO_VENTA (ID_PRODUCTO_UNICO, PREGUNTA, PREGUNTA_COMANDA, ORDENADO, DELIVERY)values('$id_producto_unico','Primera fruta','Primera fruta','1','1');";
				$respuesta = $CI->db->query($sql);
				$id_proc = getMaxVentasProcedimientoVentas();
				guardarVentasProcedimientoOpciones($id_proc);
				$sql = "insert into VENTAS_PROCEDIMIENTO_VENTA (ID_PRODUCTO_UNICO, PREGUNTA, PREGUNTA_COMANDA, ORDENADO, DELIVERY)values('$id_producto_unico','Segunda fruta','Segunda fruta','2','1');";
				$respuesta = $CI->db->query($sql);
				$id_proc = getMaxVentasProcedimientoVentas();
				guardarVentasProcedimientoOpciones($id_proc);
				break;
			case '3':
				$sql = "insert into VENTAS_PROCEDIMIENTO_VENTA (ID_PRODUCTO_UNICO, PREGUNTA, PREGUNTA_COMANDA, ORDENADO, DELIVERY)values('$id_producto_unico','Primera fruta','Primera fruta','1','1');";
				$respuesta = $CI->db->query($sql);
				$id_proc = getMaxVentasProcedimientoVentas();
				guardarVentasProcedimientoOpciones($id_proc);
				$sql = "insert into VENTAS_PROCEDIMIENTO_VENTA (ID_PRODUCTO_UNICO, PREGUNTA, PREGUNTA_COMANDA, ORDENADO, DELIVERY)values('$id_producto_unico','Segunda fruta','Segunda fruta','2','1');";
				$respuesta = $CI->db->query($sql);
				$id_proc = getMaxVentasProcedimientoVentas();
				guardarVentasProcedimientoOpciones($id_proc);
				$sql = "insert into VENTAS_PROCEDIMIENTO_VENTA (ID_PRODUCTO_UNICO, PREGUNTA, PREGUNTA_COMANDA, ORDENADO, DELIVERY)values('$id_producto_unico','Tercera fruta','Tercera fruta','3','1');";
				$respuesta = $CI->db->query($sql);
				$id_proc = getMaxVentasProcedimientoVentas();
				guardarVentasProcedimientoOpciones($id_proc);
				break;
			case '4':
				$sql = "insert into VENTAS_PROCEDIMIENTO_VENTA (ID_PRODUCTO_UNICO, PREGUNTA, PREGUNTA_COMANDA, ORDENADO, DELIVERY)values('$id_producto_unico','Primera fruta','Primera fruta','1','1');";
				$respuesta = $CI->db->query($sql);
				$id_proc = getMaxVentasProcedimientoVentas();
				guardarVentasProcedimientoOpciones($id_proc);
				$sql = "insert into VENTAS_PROCEDIMIENTO_VENTA (ID_PRODUCTO_UNICO, PREGUNTA, PREGUNTA_COMANDA, ORDENADO, DELIVERY)values('$id_producto_unico','Segunda fruta','Segunda fruta','2','1');";
				$respuesta = $CI->db->query($sql);
				$id_proc = getMaxVentasProcedimientoVentas();
				guardarVentasProcedimientoOpciones($id_proc);
				$sql = "insert into VENTAS_PROCEDIMIENTO_VENTA (ID_PRODUCTO_UNICO, PREGUNTA, PREGUNTA_COMANDA, ORDENADO, DELIVERY)values('$id_producto_unico','Tercera fruta','Tercera fruta','3','1');";
				$respuesta = $CI->db->query($sql);
				$id_proc = getMaxVentasProcedimientoVentas();
				guardarVentasProcedimientoOpciones($id_proc);
				$sql = "insert into VENTAS_PROCEDIMIENTO_VENTA (ID_PRODUCTO_UNICO, PREGUNTA, PREGUNTA_COMANDA, ORDENADO, DELIVERY)values('$id_producto_unico','Cuarta fruta','Cuarta fruta','4','1');";
				$respuesta = $CI->db->query($sql);
				$id_proc = getMaxVentasProcedimientoVentas();
				guardarVentasProcedimientoOpciones($id_proc);
				break;
			
			default:
				# code...
				break;
		}
		
	}
}

if(!function_exists('getMaxVentasProcedimientoVentas')) {
	function getMaxVentasProcedimientoVentas(){
		$CI =& get_instance();
		$sql = "select max(ID_PROCEDIMIENTO_VENTA) AS ID_PROCEDIMIENTO_VENTA FROM VENTAS_PROCEDIMIENTO_VENTA;";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta[0]->ID_PROCEDIMIENTO_VENTA;
	}
}

if(!function_exists('guardarVentasProcedimientoOpciones')) {
	function guardarVentasProcedimientoOpciones($id_proc){
		$CI =& get_instance();
		$sql = "insert into VENTAS_PROCEDIMIENTO_OPCIONES (ID_PROCEDIMIENTO_VENTA, TEXTO_OPCIONAL, ORDENADO)values('$id_proc','Frutilla','1');";
		$respuesta = $CI->db->query($sql);
		$sql = "insert into VENTAS_PROCEDIMIENTO_OPCIONES (ID_PROCEDIMIENTO_VENTA, TEXTO_OPCIONAL, ORDENADO)values('$id_proc','Durazno','2');";
		$respuesta = $CI->db->query($sql);
		$sql = "insert into VENTAS_PROCEDIMIENTO_OPCIONES (ID_PROCEDIMIENTO_VENTA, TEXTO_OPCIONAL, ORDENADO)values('$id_proc','Maracuyá','3');";
		$respuesta = $CI->db->query($sql);
		$sql = "insert into VENTAS_PROCEDIMIENTO_OPCIONES (ID_PROCEDIMIENTO_VENTA, TEXTO_OPCIONAL, ORDENADO)values('$id_proc','Frambuesa','4');";
		$respuesta = $CI->db->query($sql);
		$sql = "insert into VENTAS_PROCEDIMIENTO_OPCIONES (ID_PROCEDIMIENTO_VENTA, TEXTO_OPCIONAL, ORDENADO)values('$id_proc','Sandía','5');";
		$respuesta = $CI->db->query($sql);
		$sql = "insert into VENTAS_PROCEDIMIENTO_OPCIONES (ID_PROCEDIMIENTO_VENTA, TEXTO_OPCIONAL, ORDENADO)values('$id_proc','Piña','6');";
		$respuesta = $CI->db->query($sql);
		$sql = "insert into VENTAS_PROCEDIMIENTO_OPCIONES (ID_PROCEDIMIENTO_VENTA, TEXTO_OPCIONAL, ORDENADO)values('$id_proc','Limón','7');";
		$respuesta = $CI->db->query($sql);
		$sql = "insert into VENTAS_PROCEDIMIENTO_OPCIONES (ID_PROCEDIMIENTO_VENTA, TEXTO_OPCIONAL, ORDENADO)values('$id_proc','Copoazú','8');";
		$respuesta = $CI->db->query($sql);
		$sql = "insert into VENTAS_PROCEDIMIENTO_OPCIONES (ID_PROCEDIMIENTO_VENTA, TEXTO_OPCIONAL, ORDENADO)values('$id_proc','Mango','9');";
		$respuesta = $CI->db->query($sql);
		$sql = "insert into VENTAS_PROCEDIMIENTO_OPCIONES (ID_PROCEDIMIENTO_VENTA, TEXTO_OPCIONAL, ORDENADO)values('$id_proc','Achachairú','10');";
		$respuesta = $CI->db->query($sql);
	}
}

if(!function_exists('actualizarProductoMadre')) {
	function actualizarProductoMadre($id_producto_madre, $nombre_producto, $id_categoria_2, $detalle_producto, $actividad_economica, $producto_sin, $unidad_medida, $tieneTransporte, $precioTransporte, $imagen){
		/*$text_imagen = '';
		if($imagen != ''){
			$text_imagen = ", IMAGEN = '$imagen'";
		}*/
		$CI =& get_instance();
		//$sql = "update VENTAS_PRODUCTO_MADRE SET PRODUCTO_MADRE = '$nombre_producto', DETALLE = '$detalle_producto', CODIGO_ACTIVIDAD_ECONOMICA = '$actividad_economica', CODIGO_PRODUCTO_SIN = '$producto_sin', CODIGO_UNIDAD_MEDIDA = '$unidad_medida', TRANSPORTE = '$tieneTransporte', PRECIO_TRANSPORTE = '$precioTransporte' ".$text_imagen." where ID_PRODUCTO_MADRE = '$id_producto_madre' AND ID_CATEGORIA_2 = '$id_categoria_2';";
		$sql = "update VENTAS_PRODUCTO_MADRE SET IMAGEN = '$imagen' where ID_PRODUCTO_MADRE = '$id_producto_madre' AND ID_CATEGORIA_2 = '$id_categoria_2';";
		$respuesta = $CI->db->query($sql);
	}
}

if(!function_exists('eliminarProductoUnico')) {
	function eliminarProductoUnico($id_producto_unico){
		$CI =& get_instance();
		$sql = "update VENTAS_PRODUCTO_UNICO SET ELIMINADO = '1' where ID_PRODUCTO_UNICO = '$id_producto_unico';";
		$respuesta = $CI->db->query($sql);
	}
}

if(!function_exists('actualizarPrecioProductoUnico')) {
	function actualizarListaPrecioProductoUnico($id_producto_unico, $precios){
		foreach ($precios as $key => $value) {
			$id_lp = $value->id_lp;
			$precio = $value->precio;
			$vep = verificarExistenciaPrecioProductoUnico($id_producto_unico,$id_lp);
			if($vep){
				$uvlp = actualizarPrecioProductoUnico($id_lp, $id_producto_unico, $precio);
			}else{
				$cvlp = guardarPrecioProductoUnico($id_lp, $id_producto_unico, $precio);
			}
		}
	}
}

if(!function_exists('verificarExistenciaPrecioProductoUnico')) {
	function verificarExistenciaPrecioProductoUnico($id_producto_unico,$id_lp){
		$res = false;
		$CI =& get_instance();
		$sql = "select * FROM VENTAS_PRECIO_PRODUCTO_UNICO where ID_NOMBRE_LISTA_PRECIOS = '$id_lp' AND ID_PRODUCTO_UNICO = '$id_producto_unico';";
		$respuesta = $CI->main->getQuery($sql);
		$total = count($respuesta);
		if($total > 0){
			return true;
		}
		return $res;
	}
}

if(!function_exists('actualizarPrecioProductoUnico')) {
	function actualizarPrecioProductoUnico($id_lp, $id_producto_unico, $precio){
		$CI =& get_instance();
		$sql = "update VENTAS_PRECIO_PRODUCTO_UNICO SET PRECIO = '$precio' where ID_NOMBRE_LISTA_PRECIOS = '$id_lp' AND ID_PRODUCTO_UNICO = '$id_producto_unico';";
		$respuesta = $CI->db->query($sql);
	}
}

if(!function_exists('guardarVentaProcedimientoVenta')) {
	function guardarVentaProcedimientoVenta($id_producto_unico, $texto_fruta, $orden){
		$CI =& get_instance();
		$sql = "insert into VENTAS_PROCEDIMIENTO_VENTA (ID_PRODUCTO_UNICO, PREGUNTA, PREGUNTA_COMANDA, ORDENADO, DELIVERY)values('$id_producto_unico','$texto_fruta','$texto_fruta','$orden','1');";
		$respuesta = $CI->db->query($sql);
	}
}

if(!function_exists('getIdVentaProcedimientoVenta')) {
	function getIdVentaProcedimientoVenta($id_producto_unico, $texto_fruta){
		$CI =& get_instance();
		$sql = "select ID_PROCEDIMIENTO_VENTA FROM VENTAS_PROCEDIMIENTO_VENTA WHERE ID_PRODUCTO_UNICO = '$id_producto_unico' and PREGUNTA='$texto_fruta';";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta[0]->ID_PROCEDIMIENTO_VENTA;
	}
}

if(!function_exists('eliminarVentaProcedimientoVenta')) {
	function eliminarVentaProcedimientoVenta($id_procedimiento_venta){
		$CI =& get_instance();
		$sql = "delete FROM VENTAS_PROCEDIMIENTO_VENTA WHERE ID_PROCEDIMIENTO_VENTA = '$id_procedimiento_venta';";
		$respuesta = $CI->db->query($sql);
	}
}

if(!function_exists('eliminarVentaProcedimientoOpciones')) {
	function eliminarVentaProcedimientoOpciones($id_procedimiento_venta){
		$CI =& get_instance();
		$sql = "delete FROM VENTAS_PROCEDIMIENTO_OPCIONES WHERE ID_PROCEDIMIENTO_VENTA = '$id_procedimiento_venta';";
		$respuesta = $CI->db->query($sql);
	}
}

if(!function_exists('protocoloWeb')) {
	function protocoloWeb(){
    	$protocol =  "http://";
    	if (isset($_SERVER['HTTPS']) && in_array($_SERVER['HTTPS'], ['on', 1]) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
        	$protocol = 'https://';
    	}
		return $protocol ;
	}
}

if(!function_exists('getSucursales')) {
	function getSucursales(){
    	$CI =& get_instance();
		$sql = "select * from ID_UBICACION where ESTADO=1;";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta;
	}
}

if(!function_exists('getInventariosSubcategoria2')) {
	function getInventariosSubcategoria2(){
		$CI =& get_instance();
		$sql = "select (SELECT (CATEGORIA) from INVENTARIOS_CATEGORIA c where c.ID_CATEGORIA =v1.ID_CATEGORIA ) as CATEGORIA, *  from INVENTARIOS_SUB_CATEGORIA_2 v2, INVENTARIOS_SUB_CATEGORIA_1 v1 where v2.ID_SUB_CATEGORIA_1 =v1.ID_SUB_CATEGORIA_1 ;";
		$respuesta = $CI->main->getQuery($sql);
		return $respuesta;
	}
}
if(!function_exists('getPedidoSucursal')) {
	function getPedidoSucursal($bd, $sufijo_sucursal){
		$CI =& get_instance();
		$DB2 = $CI->load->database($bd, TRUE);
		$sql = "select * from INVENTARIOS_DECLARACION".$sufijo_sucursal." ida where FECHA_CONTEO ='2023-02-07';";
		$respuesta = $DB2->query($sql);
		$respuesta = $respuesta->result();
		return $respuesta;
	}
}


  

  

  

  

  


