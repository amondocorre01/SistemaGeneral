<table  border="1"  cellpadding="2" cellspacing="1">
    <tr>
        <td width="68.5%"  align="right">
            <font size="-1"><?="SUBTOTAL Bs"?></font>
        </td>
        <td width="34%" align="right">
            <font size="+0"><?=number_format($this->session->resumen['subtotal'], 2)?></font>
        </td>
    </tr>
    <tr>
        <td width="68.5%"  align="right">
            <font size="-1"><?="DESCUENTO Bs"?></font>
        </td>
        <td width="34%" align="right">
            <font size="+0"><?=number_format($this->session->resumen['descuento'], 2)?></font>
        </td>
    </tr>
    <tr>
        <td width="68.5%"  align="right">
            <font size="-1"><?="TOTAL Bs"?></font>
        </td>
        <td width="34%" align="right">
            <font size="+0"><?=number_format($this->session->resumen['total'], 2)?></font>
        </td>
    </tr>

    <tr>
        <td width="68.5%"  align="right">
            <font size="-1"><?="MONTO GIFT CARD Bs"?></font>
        </td>
        <td width="34%" align="right">
        <font size="+0"><?=number_format($this->session->resumen['monto_gift_card'], 2)?></font>
        </td>
    </tr>

    <tr>
        <td width="68.5%"  align="right">
            <font size="-1"><strong><?="MONTO A PAGAR Bs"?></strong></font>
        </td>
        <td width="34%" align="right">
            <font size="+0"><strong><?=number_format($this->session->resumen['monto_pagar'], 2)?></strong></font>
        </td>
    </tr>
    <?php
    $descripcion_moneda = $this->session->resumen['descripcion_moneda'];
        if($descripcion_moneda != ''){
            $montoMoneda = (($this->session->resumen['monto_sujeto_iva'])/($this->session->resumen['tipo_cambio']));
            $montoMoneda = round($montoMoneda,2);
            echo '<tr>
            <td width="68.5%"  align="right">
                <font size="-1"><strong>MONTO A PAGAR ('.$descripcion_moneda.')</strong></font>
            </td>
            <td width="34%" align="right">
                <font size="+0"><strong>'.$montoMoneda.'</strong></font>
            </td>
        </tr>';
        }
    ?>

    <tr>
        <td width="68.5%"  align="right">
            <font size="-1"><strong><?="IMPORTE BASE CRÉDITO FISCAL Bs"?></strong></font>
        </td>
        <td width="34%" align="right">
            <font size="+0"><strong><?=number_format($this->session->resumen['monto_sujeto_iva'], 2)?></strong></font>
        </td>
    </tr>

   
</table>