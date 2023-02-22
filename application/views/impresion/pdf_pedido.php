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
ob_start();
echo '<script>
var getlocal = localStorage.getItem("data_pedido");
console.log(getlocal);
</script>';
ob_clean();
$html= "<center><b>CAPRESSO S.R.L";
$html= $html.'<br>';
$html= $html.'<br>';
$html= $html."ARQUEO DE CAJA POR TURNO";
$html= $html.'</b><br>';
$html= $html."--------------------------------------";
$html= $html.'<br></center>';
$html= $html.'<table border="1" class="table table-bordered table-striped tablaDetalleTurno">
                    <tr>
                        <td align="left"><b>Usuario</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left"><b>Fecha/Hora Ingreso: </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left"><b>Fecha/Hora Salida: </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left"><b>Rango de facturas: </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left"><b>Cantidad de Recibos: </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left"><b>Monto inicial de turno: </b></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <td align="left"><b>Total Ingresos: </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left"><b>Total Egresos: </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left"><b>Total ventas en efectivo: </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left"><b>Total ventas en QR: </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left"><b>Total ventas Tarj. Deb/Cred: </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left"><b>Total ventas Transferencia: </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left"><b>Total cupones Pedidos Ya: </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left"><b>Saldo teorico: </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left"><b>Dinero entregado: </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left"><b>Descuadre: </b></td>
                        <td></td>
                    </tr>
                </table>';

//$contenido = $this->load->view($html, '', TRUE);
$pdf->writeHTML($html, true, true, true, true, 'C');
$pdf->Output('detalle_turno.pdf', 'I');


?>