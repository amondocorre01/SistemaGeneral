<?php
/*
@params

http://localhost:8080/facturacion/facturacion.php?nroAutorizacion=79040011859&nroFactura=152&nit=102649026&fecha=20070728&monto=135&llave=A3Fs4s$)2cvD(eY667A5C4A2rsdf53kw9654E2B23s24df35F5

http://localhost/facturacion/facturacion.php?nroAutorizacion=7904006306693&nroFactura=876814&nit=1665979&fecha=20080519&monto=35958.6&llave=zZ7Z]xssKqkEf_6K9uH(EcV+%x+u[Cca9T%+_$kiLjT8(zr3T9b5Fx2xG-D+_EBS

http://localhost/facturacion/facturacion.php?nroAutorizacion=385401200174302&nroFactura=2723&nit=12648887014&fecha=20220406&monto=28&llave=dTZUd3p=Ua8@gLR%\i2$EIT3yNHjAG*Qnn3F#w(VIBuR]4fS%[U7%Ebq8$7Xe3*j

http://localhost/facturacion/facturacion.php?nroAutorizacion=385401200247087&nroFactura=2887&nit=10407865017&fecha=20220518&monto=57&llave=QBy_WF=X[j4SZ*Td6UQ{kZ3Ax4EVs@k$M9bqi9rdSrVK)$ZD6*Y@u*9K=t%6H@GP

  @variables

nroAutorizacion: Número de Autorización:  7904006306693
nroFactura:      Número de Factura:       876814
nit:             NIT / CI del Cliente:    1665979
fecha:           Fecha de la Transacción: 20080519
monto:           Monto de la Transacción: 35958.6
llave            Llave de Dosificación:   zZ7Z]xssKqkEf_6K9uH(EcV+%x+u[Cca9T%+_$kiLjT8(zr3T9b5Fx2xG-D+_EBS


@return
Codigo Control: 7B-F3-48-A8
*/
?>
<HTML>
<HEAD>
<TITLE>recibe.php</TITLE>
</HEAD>
<BODY>
<!--
  Numero de Autorizacion: <?php //echo $_GET["nroAutorizacion"]; ?> 
  <br>
  Numero de Factura: <?php //echo $_GET["nroFactura"]; ?>
  <br>
  Nit:<?php //echo $_GET["nit"]; ?>
  <br>
  fecha: <?php //echo $_GET["fecha"]; ?>
  <br>
  monto:<?php //echo $_GET["monto"]; ?>
  <br>
  llave: <?php //echo $_GET["llave"]; ?>
   <br>
  -->
  <!--
  	generar($numautorizacion, $numfactura, $nitcliente, $fecha, $monto, $clave)
  -->
  
  <?php 
  		include("CodigoControlV7/CodigoControlV7.php");
  		//$date = '28-07-2007';
  		$numero_autorizacion = $_GET["nroAutorizacion"];//'197801600000479';
		$numero_factura = $_GET["nroFactura"];//'3010';
		$nit_cliente = $_GET["nit"];//'1010743025';
		$fecha_compra = $_GET["fecha"];//date('Ymd', strtotime($date)); //date_format($date,"Ymd");//'20080419';
		//echo $fecha_compra." ===";
		$monto_compra = number_format($_GET["monto"],0,'.','');//number_format('89721.62', 0, '.', '');
		$clave = $_GET["llave"];//'CS@@IW58@4X2)CH4q+7_B7GEQ3%5UHs88JH{@ibIzwAmv5%TqCuP6)$mdwiSn-f8';
		//echo $fecha_compra.'--> '.$clave.' --> '.$monto_compra;
		echo CodigoControlV7::generar($numero_autorizacion, $numero_factura, $nit_cliente, $fecha_compra, $monto_compra, $clave);
  ?>
</BODY>
</HTML>