<?php
    $factura = json_decode($json);
    //echo '<pre>';
    //print_r($factura); die();

    ?>

<table  cellpadding="2" cellspacing="1">
   
    <?php $subtotal = 0; $descuento = 0;  ?> 
    <tr>
        <th width="20%">CANT</th>
        <th width="80%">PRODUCTO</th>
    </tr>
    <?php foreach ($factura->detalle_productos as $row) : ?>
        <tr>
            <td width="20%">
                <font size="-1"><?=number_format($row->cantidad, 2)?></font>
            </td>
            <td width="80%">
            <font size="-1"><b><?=$row->nombre?></b></font>
                <?php
                        //FRUTAS Y MAS INFORMACION
                        $frutas = $row->frutas;
                        $cant=count($frutas);
                        $texto_detalle='';
                        if($cant>0){
                          $texto_detalle = '(';
                          for ($i=0; $i < $cant; $i++) {
                            if( isset($frutas[$i])){
                              $frutaExplode = explode("-", $frutas[$i]);
                              $frutaSel = $frutaExplode[1]; 
                              $texto_detalle= $texto_detalle.'+'.$frutaSel;
                            }
                          }
                          $texto_detalle = $texto_detalle.')';
                        }
                        $mensaje = $row->mensaje;
                        if($mensaje){
                          $texto_detalle= $texto_detalle.' -'.$mensaje;
                        }
                        $paraLlevar = $row->paraLlevar;
                        if($paraLlevar){
                          $texto_detalle = $texto_detalle.' -Para llevar';
                        }
                        if($texto_detalle != ''){
                            echo $texto_detalle;
                        }
                ?>
            </td>
        </tr>
    <?php endforeach;?>
</table>



