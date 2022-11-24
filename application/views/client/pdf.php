<?php
    $factura = json_decode($json);
   
    ?>

<table  border="1"  cellpadding="2" cellspacing="1">
    <tr>
        <th width="10%"  align="center">
            <font size="-2"><strong><?=mb_strtoupper("CÓDIGO PRODUCTO/SERVICIO")?></strong></font>
        </th>
        <th width="10%" align="center">
            <font size="-2"><strong><?=mb_strtoupper("CANTIDAD")?></strong></font>
        </th>
        <th width="15%" align="center">
            <font size="-2"><strong><?=mb_strtoupper("UNIDAD DE MEDIDA")?></strong></font>
        </th>
        <th width="30%" align="center">
            <font size="-2"><strong><?=mb_strtoupper('DESCRIPCIÓN')?></strong></font>
        </th>
        <th width="12%" align="center">
            <font size="-2"><strong><?=mb_strtoupper('PRECIO UNITARIO')?></strong></font>
        </th>
        <th width="12%" align="center">
            <font size="-2"><strong><?=mb_strtoupper('DESCUENTO')?></strong></font>
        </th>
        <th width="12%" align="center">
            <font size="-2"><strong><?=mb_strtoupper('SUBTOTAL')?></strong></font>
        </th>
    </tr>

    <?php $subtotal = 0; $descuento = 0;  ?> 
    <?php foreach ($factura->detalle_productos as $row) : ?>
        <tr>
            <td width="10%" align="left">
                <font size="-1"><?=$row->id_producto_unico?></font>
            </td>
            <td width="10%" align="right">
                <font size="-1"><?=number_format($row->cantidad, 2)?></font>
            </td>
            <td width="15%" align="left">
                <font size="-1"><?=$row->unidadMedida?></font>
            </td>
            <td width="30%" align="left">
                <font size="-1"><?=$row->nombre?></font>
            </td>
            <td width="12%" align="right">
                <font size="-1"><?=number_format($row->precio, 2)?></font>
            </td>
            <td width="12%" align="right">
                <font size="-1"><?=number_format($row->montoDescuento, 2)?></font>
            </td>
            <td width="12%" align="right">
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



