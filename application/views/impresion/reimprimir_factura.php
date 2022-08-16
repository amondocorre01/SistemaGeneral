
<?php
    
  //set it to writable location, a place for temp generated PNG files
  $DIR = 'assets/temp/';
  
  //crea la carpeta temp si no existe
  if (!file_exists($DIR))
      mkdir($DIR);
  
  $filename = $DIR.'test2.png';
  $contenido='asjahsja';
  $tamanio=2;
  $level='H';
  $frameSize=3;

 
?>

<script type="text/javascript">
window.print();
window.onafterprint = window.close;
</script>
<?php
        if(!isset($_SESSION['data-imprimir'])){
            echo 'Error!!!';
            exit();
          } 
          $datos_imprimir = $_SESSION['data-imprimir'];
          $res = json_decode($datos_imprimir);
          $this->session->unset_userdata('data-imprimir');  
        
        $direccion = $res->DIRECCION_SUCURSAL;
        $telefono = $res->TELEFONO;
        $numero_factura = $res->NUMERO_FACTURADO;
        $nit_empresa = trim($res->NIT_EMPRESA);
        $numero_autorizacion = $res->NUMERO_AUTORIZACION;
        $numero_pedido = $res->NUMERO_VENTA_DIA;
        $fecha = $res->FECHA;
        $fecha = explode(" ", $fecha);
        $fecha_obtenida = $fecha[0];
        $fecha_limit_array = explode("-", $fecha[0]);
        $ges=$fecha_limit_array[2];
        $mes=$fecha_limit_array[1];
        $dia=$fecha_limit_array[0];
        $fecha= $dia.'/'.$mes.'/'.$ges;

        $nombre_cliente =$res->cliente;
        $nit_cliente = $res->NIT;
        $importe_total = $res->TOTAL_A_PAGAR;
        $importe_total = number_format($importe_total,2);
        $literal =  $res->literal;
        $codigo_control = $res->CODIGO_CONTROL;
        $fecha_limite_emision = $res->FECHA_LIMITE;
        $fecha_limit_array = explode("-", $fecha_limite_emision);
        $ges=$fecha_limit_array[0];
        $mes=$fecha_limit_array[1];
        $dia=$fecha_limit_array[2];
        $fecha_limit= $dia.'/'.$mes.'/'.$ges;
        
        $listProductos = json_decode($res->DETALLE);
    ?>
 
 <!DOCTYPE html>
<html>
<body>
  <br>
<center>
<p>CAPRESSO S.R.L.<br>
Sucursal N° 14<br> <?=$direccion?><br> Telfs: <?=$telefono?><br>Cochabamba - Bolivia</p><p> <STRONG> FACTURA </STRONG>
 <br> ORIGINAL
</p><hr>
<b>NIT: <?=$nit_empresa?></b><br>
<b>FACTURA N°.: <?=$numero_factura?> </b> <br>
AUTORIZACIÓN N°.: <?=$numero_autorizacion?><br>
ACTIVIDAD ECONÓMICA: Bares whiskerias y cafés <br><hr>
</center> 
<span class="font11"> FECHA: <?=$fecha?></span><br> 
<b><span class="font11"> SEÑOR(ES): <?=$nombre_cliente?><span></b><br>
<b> <span class="font11"> NIT: <?=$nit_cliente?></span> </b>
<style>
  body{
    font-size: 12px;
  }
table, td, th {
  border: 1px solid black;
}


table {
  border-collapse: collapse;
  padding-left: 5px;
  padding-right: 5px;
  font-size: 11px;
}
.importeTotal{
  text-align: right;
}
.nota-factura{
  font-size: 11px;
}

</style>
<table width="100%">
   <tr>
    <th>CAN</th>
    <th>CONCEPTO</th>
    <th>P.UNIT</th>
    <th>SUBTOT</th>
   </tr>
   
    <?php foreach ($listProductos as $key => $value): ?>
    <tr>
    <td align="center"><?=$value->CANTIDAD?></td>
    <td><?=$value->PRODUCTO_UNICO?></td>
    <td align="center"><?=number_format($value->PRECIO,2)?></td>
    <td align="center"><?=number_format($value->SUBTOTAL,2)?></td>
   </tr>
   <?php endforeach; ?>
  </table>
  <div class="importeTotal">
  Descuento: 0.00
  <br>
  <b>SUB TOTAL Bs.: <?=$importe_total?></b>
  <br>
  <b>Importe Base para crédito fiscal Bs.: <?=$importe_total?></b>
  <br>
  <!--Pago Anticipado gift Card   agregas-->
  </div>
 

<center>
<br> Son: <?=$literal?> con 00/100 Bolivianos <br /> 
CODIGO DE CONTROL: <?=$codigo_control?><br />
Fecha Límite de Emisión: <?=$fecha_limit?><br />
</center>

<center>
  <?php
      $contenido= $nit_empresa.'|'.$numero_factura.'|'.$numero_autorizacion.'|'.$fecha.'|'.$importe_total.'|'.$importe_total.'|'.$nit_cliente.'|'.$codigo_control.'|0|0|0|0';
      QRcode::png($contenido, $filename, $level,$tamanio,$frameSize);    
      //display generated file
  ?>
  <?=img(['src'=>$filename, 'alt'=>''])?>
</center>
<p class="nota-factura">
ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO ILÍCITO DE ÉSTA SERÁ SANCIONADO DE ACUERDO A LEY <br />
Ley N° 453: El proveedor debe brindar atención sin discriminación, con respeto, calidez y cordialidad a los usuarios y consumidores.
</p>
<center>
  Zona WIFI: capresso café
  <br>
  Clave WIFI: nuevasucursalmegacenter
  <br>
    </center>
    <br>
  N° PEDIDO: <?=$numero_pedido?>
</body>
</html>
<p style='page-break-before: always'>
</p>


 