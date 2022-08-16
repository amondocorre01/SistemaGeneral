<script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
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
  $frameSize=2;
?>
<script type="text/javascript">
  window.print();
  window.onafterprint = window.close;
</script>
<?php
        if(!isset($_SESSION['datos-factura'])){
          echo 'Error!!!';
          exit();
        } 
        $datos_factura = $_SESSION['datos-factura'];
        $res = json_decode($datos_factura);
        $this->session->unset_userdata('datos-factura');
        $nombre_impresora = $res->nombre_impresora;
        $datos_factura = $res->datos_factura;
        $id_producto = $datos_factura->id_producto;
        $direccion = $datos_factura->direccion;
        $telefono = $datos_factura->telefono;
        $numero_factura = $datos_factura->numero_factura;
        $numero_pedido = $datos_factura->numero_pedido;
        $nit_empresa = trim($datos_factura->nit_empresa);
        $numero_autorizacion = $datos_factura->numero_autorizacion;
        $fecha = $datos_factura->fecha;
        $nombre_usuario = $datos_factura->nombre_usuario;
        $nombre_usuario = getIniciales($nombre_usuario);
        $nombre_cliente =$datos_factura->nombre_cliente;
        $facturar_cliente_a =$datos_factura->facturar_cliente_a;
        $nit_cliente = $datos_factura->nit_cliente;
        $importe_total = $datos_factura->importe_total;
        $importe_total = number_format($importe_total,2);
        $literal = $datos_factura->literal;
        $codigo_control = $datos_factura->codigo_control;
        $fecha_limite_emision = $datos_factura->fecha_limite_emision;
        $fecha_limit_array = explode("-", $fecha_limite_emision);
        $ges=$fecha_limit_array[0];
        $mes=$fecha_limit_array[1];
        $dia=$fecha_limit_array[2];
        $fecha_limit= $dia.'/'.$mes.'/'.$ges;

        $monto_recibido = $datos_factura->monto_recibido;
        $monto_cambio = $datos_factura->monto_cambio;
        $llamar_por = $datos_factura->llamar_por;

        $listProductos = $res->detalle_productos;
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
<b><span class="font11"> SEÑOR(ES): <?=$facturar_cliente_a?><span></b><br>
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
<center>
<table width =100%>
   <tr>
    <th>CAN</th>
    <th>CONCEPTO</th>
    <th>P.UNIT</th>
    <th>SUBTOT</th>
   </tr>
   
    <?php foreach ($listProductos as $key => $value): ?>
    <tr>
    <td align="center"><?=$value->cantidad?></td>
    <td><?=$value->nombre?></td>
    <td align="center"><?=number_format($value->precio,2)?></td>
    <td align="center"><?=number_format($value->subtotal,2)?></td>
   </tr>
   <?php endforeach; ?>
  </table>
   </center>
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
<br> Son: <?=$literal?> con 00/100 Bolivianos<br> 
CODIGO DE CONTROL: <?=$codigo_control?><br>
Fecha Límite de Emisión: <?=$fecha_limit?><br>
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
</center>
<br />
N° PEDIDO: <?=$numero_pedido?>
</body>
</html>
<p style='page-break-before: always'>
</p>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
</head>
<body>
<br>
<p align='center'><strong><Font size = '4'><u>COMANDA DE PRODUCCI&Oacute;N</u></font></strong></p>
<p align='center'> <Font size = '3'> 
  Fecha:  <?=$fecha?><br />
  Sucursal: Cine Center  <br />
  Cajero: <?=$nombre_usuario?> <br />
    Cliente: <?=$nombre_cliente?> <br />
<?php
  if($llamar_por != ''):
    echo 'Llamar por: '.$llamar_por.'<br>';
  endif;
  ?>
</font></p>
<center>
<table width=100%>
   <tr>
    <th>CANT</th>
    <th>PRODUCTO</th>
   </tr>
   
    <?php foreach ($listProductos as $key => $value): ?>
    <tr>
    <td align="center"><?=$value->cantidad?></td>
    <td ><?=$value->nombre?>
    <?php
        $frutas = $value->frutas;
        $cant=count($frutas);
        if($cant>0){
          echo '(';
          for ($i=0; $i < $cant; $i++) {
            if( isset($frutas[$i])){
              $frutaExplode = explode("-", $frutas[$i]);
              $frutaSel = $frutaExplode[1]; 
              echo '+'.$frutaSel;
            }
          }
          echo ')';
        }
        $mensaje = $value->mensaje;
        if($mensaje){
          echo ' -'.$mensaje;
        }
        $paraLlevar = $value->paraLlevar;
        if($paraLlevar){
          echo ' -Para llevar';
        }
      ?>
  </td>
   </tr>
   <?php endforeach; ?>
  </table>
</center>
<br>
N° PEDIDO: <?=$numero_pedido?>
<p style='page-break-before: always'></p>
<?php
function getIniciales($nombre){
  $name = '';
  $explode = explode(' ',$nombre);
  foreach($explode as $x){
      $name .=  $x[0];
  }
  return $name;    
}

?>
<script>
  $(document).ready(function() {
    //generarQR('<?=$contenido?>');
  });
  async function  generarQR(contenido){
      await QRCode.toDataURL(contenido, {width: 110,
    height: 110, errorCorrectionLevel: 'H' }, function (err, url) {
        document.getElementById("qr").src=url;
    });
    window.print();
    }
</script>