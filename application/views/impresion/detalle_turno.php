<?php 

class MYPDF extends TCPDF
{
    
    //Page header
    public function Header()
    {
        
    }
    
    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('dejavusans', 'I', 8);
    }
    
}


//var_dump($json);
$datos_turno = json_decode($datos);
$usuario = $datos_turno->usuario; 
//$datos_turno->impresora_local;
$fecha_apertura = $datos_turno->fecha_apertura;
$fecha = explode("-", $fecha_apertura);
$ges=$fecha[0];
$mes=$fecha[1];
$dia=$fecha[2];
$fecha_apertura= $dia.'/'.$mes.'/'.$ges;
$horario_apertura = $datos_turno->horario_apertura; 
$monto_apertura = $datos_turno->monto_inicial; 
$monto_total_ingresos = $datos_turno->total_ingresos; 
$monto_total_egresos = $datos_turno->total_egresos; 
$monto_total_ventas_efectivo = $datos_turno->monto_total_ventas_efectivo;
$monto_total_ventas_no_efectivo = $datos_turno->monto_total_ventas_no_efectivo; 
$monto_total_ventas_pago_qr = $datos_turno->monto_total_ventas_pago_qr; 
$monto_total_ventas_tarjeta = $datos_turno->monto_total_ventas_tarjeta; 
$monto_total_ventas_transferencia_bancaria = $datos_turno->monto_total_ventas_transferencia_bancaria;
$monto_total_ventas_cupon_pedidos_ya = $datos_turno->monto_total_ventas_cupon_pedidos_ya; 
$monto_total_ventas_gift_card = $datos_turno->monto_total_ventas_gift_card;
$saldo_teorico= $datos_turno->saldo_teorico;
$monto_cierre = $datos_turno->monto_cierre;
$descuadre = $datos_turno->descuadre;
$fecha_cierre = $datos_turno->fecha_cierre; 
if($fecha_cierre){
  $fecha = explode("-", $fecha_cierre);
  $ges=$fecha[0];
  $mes=$fecha[1];
  $dia=$fecha[2];
  $fecha_cierre= $dia.'/'.$mes.'/'.$ges;
  $hora_cierre = $datos_turno->hora_cierre;
}else{
  $fecha_cierre ='';
  $hora_cierre = '';
}
$descripcion_sucursal = $datos_turno->sucursal;
$rangoFacturas = $datos_turno->rangoFacturas;
$cantidadRecibos = $datos_turno->cantidadRecibos; 


$pageLayout = array(80, 120); //  or array($height, $width) 


// create new PDF document
$pdf = new MYPDF('P', 'mm', $pageLayout, true, 'UTF-8', false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(5, 10, 5);
$pdf->SetHeaderMargin(5);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
require_once(dirname(__FILE__) . '/lang/eng.php');
$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage('P');


$pdf->setCellPaddings(0,0,0,0);

$pdf->SetFont('helvetica', 'B', 8);
mb_internal_encoding("UTF-8");
$pdf->SetFont('dejavusans', '', 7.2, '', true);

$html= "<center><b>CAPRESSO S.R.L";
$html= $html.'<br>'.$descripcion_sucursal;
$html= $html.'<br>';
$html= $html."ARQUEO DE CAJA POR TURNO";
$html= $html.'</b><br>';
$html= $html."--------------------------------------";
$html= $html.'<br></center>';
$html= $html.'<table border="1" class="table table-bordered table-striped tablaDetalleTurno">
                    <tr>
                        <td align="left"><b>Usuario</b></td>
                        <td>'.$usuario.'</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Fecha/Hora Ingreso: </b></td>
                        <td>'.$fecha_apertura."  ".$horario_apertura.'</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Fecha/Hora Salida: </b></td>
                        <td>'.$fecha_cierre."  ".$hora_cierre.'</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Rango de facturas: </b></td>
                        <td>'.$rangoFacturas.'</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Cantidad de Recibos: </b></td>
                        <td>'.$cantidadRecibos.'</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Monto inicial de turno: </b></td>
                        <td>'.$monto_apertura.'</td>
                    </tr>
                    
                    <tr>
                        <td align="left"><b>Total Ingresos: </b></td>
                        <td>'.$monto_total_ingresos.'</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Total Egresos: </b></td>
                        <td>'.$monto_total_egresos.'</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Total ventas en efectivo: </b></td>
                        <td>'.$monto_total_ventas_efectivo.'</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Total ventas en QR: </b></td>
                        <td>'.$monto_total_ventas_pago_qr.'</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Total ventas Tarj. Deb/Cred: </b></td>
                        <td>'.$monto_total_ventas_tarjeta.'</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Total ventas Transferencia: </b></td>
                        <td>'.$monto_total_ventas_transferencia_bancaria.'</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Total cupones Pedidos Ya: </b></td>
                        <td>'.$monto_total_ventas_cupon_pedidos_ya.'</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Saldo teorico: </b></td>
                        <td>'.$saldo_teorico.'</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Dinero entregado: </b></td>
                        <td>'.$monto_cierre.'</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Descuadre: </b></td>
                        <td>'.$descuadre.'</td>
                    </tr>
                </table>';

//$contenido = $this->load->view($html, '', TRUE);
$pdf->writeHTML($html, true, true, true, true, 'C');
$pdf->Output('detalle_turno.pdf', 'I');


?>