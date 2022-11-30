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
function getIngresos($bd, $prefijo, $sufijo, $id){
	$res=0;
	$sql = "EXEC ".$prefijo."SUMA_INGRESOS '$id';";
	$CI =& get_instance();
	$DB2 = $CI->load->database($bd, TRUE);
	$respuesta = $DB2->query($sql);
	$respuesta = $respuesta->result();
	if(count($respuesta)==1){
		$res = $respuesta[0]->ingresos;
		if($res ==null){
			$res=0;
		}
	}
	return $res;
}
}

if(!function_exists('getEgresos')) {
function getEgresos($bd, $prefijo, $sufijo, $id){
	$res=0;
	$sql = "EXEC ".$prefijo."SUMA_EGRESOS '$id';";
	$CI =& get_instance();
	$DB2 = $CI->load->database($bd, TRUE);
	$respuesta = $DB2->query($sql);
	$respuesta = $respuesta->result();
	if(count($respuesta)==1){
		$res = $respuesta[0]->egresos;
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


  

  

  

  

  


