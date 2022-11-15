<?php
    $factura = json_decode($json);
    //echo '<pre>';
    //print_r($factura); die();

    ?>

<table  cellpadding="2" cellspacing="1">
   
    <?php $subtotal = 0; $descuento = 0;  ?> 
    <?php foreach ($factura->detalle_productos as $row) : ?>
        <tr>
            <td width="70%">
                <font size="-1"><b><?=$row->id_producto_unico." - ".$row->nombre?></b><br><?=number_format($row->cantidad, 2)?> X <?=number_format($row->precio, 2)?> - <?=number_format($row->montoDescuento, 2)?></font>
            </td>
            <td width="30%" align="right">
                <font size="-1"><?=number_format($row->subtotal, 2)?></font>
            </td>
        </tr>
       <?php $subtotal += $row->subtotal ?> 

       <?php  
       $resumen = array('subtotal' => $factura->datos_factura->subtotal, 'descuento' => $factura->datos_factura->descuento, 'total' => $factura->datos_factura->total, 'monto_gift_card' => $factura->datos_factura->monto_gift_card, 'monto_pagar' => $factura->datos_factura->monto_pagar, 'monto_sujeto_iva' => $factura->datos_factura->monto_sujeto_iva, 'descripcion_moneda' => $factura->datos_factura->descripcion_moneda,'tipo_cambio' => $factura->datos_factura->tipo_cambio);
       
       $this->session->set_userdata( 'resumen', $resumen);
        ?>
    <?php endforeach;?>
</table>



