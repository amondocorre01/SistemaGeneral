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



  

  

  

  

  


