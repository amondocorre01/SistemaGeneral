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
$factura = json_decode($json);
//$factura = $json;

//$detalle_productos = $factura->json_decode($detalle_productos);

//var_dump($factura); die();


$pageLayout = array(80, 80 + count($factura->detalle_productos)*10); //  or array($height, $width) 

// create new PDF document
$pdf = new MYPDF('P', 'mm', $pageLayout, true, 'UTF-8', false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(5, 20, 5);
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
$pdf->MultiCell(0, 10,  'COMANDA DE PRODUCCIÓN'."\n", 0, 'C', 0, 1, 2, 10, true, 0, false, true, 10, 'T', true);

$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(0, 30, $factura->datos_factura->razon_social_emisor."\n", 0, 'C', 0, 1, 2, 15, true, 0, false, true, 10, 'T', true);
$pdf->MultiCell(0, 30, '- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -', 0, 'C', 0, 1, 2, 17, true, 0, false, true, 10, 'T', true);

$y=$pdf->getY();
$pdf->MultiCell(38, 20,"No. Pedido: "."\n"."Fecha: "."\n"."Sucursal: "."\n"."Cajero: "."\n"."Cliente: "."\n"."Llamar por: ", 0, 'R', 0, 1, 2, $y-25, true, 0, false, true, 10, 'T', true);
$time = strtotime($factura->datos_factura->datetime);
$new_time= date('d/m/Y H:i A',$time);

$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(38, 20,$factura->datos_factura->numero_pedido."\n".$new_time."\n".$factura->datos_factura->descripcion_sucursal."\n ".$factura->datos_factura->nombre_usuario."\n".$factura->datos_factura->nombre_cliente."\n".$factura->datos_factura->llamar_por."\n", 0, 'L', 0, 1, 42, $y-25, true, 0, false, true, 10, 'T', true);
$y=$pdf->getY()+10;
$pdf->MultiCell(0, 30, '- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -', 0, 'C', 0, 1, 2, $y-10, true, 0, false, true, 10, 'T', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->MultiCell(0, 10,  'DETALLE', 0, 'C', 0, 1, 2, $y-5, true, 0, false, true, 10, 'T', true);

mb_internal_encoding("UTF-8");
$pdf->SetFont('dejavusans', '', 7.2, '', true);
$contenido = $this->load->view('client/detalleComanda', '', TRUE);

$pdf->SetFont('dejavusans', '', 7.2, '', true);
$pdf->setXY(5, $pdf->getY()-5);
$pdf->writeHTML($contenido, true, true, true, true, 'L');

// ---------------------------------------------------------

$pdf->Cell(0,5,'---------------------------------------------------------------------------',0,1);

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$nro_factura = $factura->datos_factura->numero_factura;
//$pdf->Output(NAME_DIR.'assets/facturas/pdf_rollo/factura.pdf', 'F');
$ver_pdf_rollo = $factura->datos_factura->ver_pdf_rollo;
if($ver_pdf_rollo == '1'){
    $pdf->Output(($factura->datos_factura->numero_factura).'_comanda.pdf', 'I');
}

?>