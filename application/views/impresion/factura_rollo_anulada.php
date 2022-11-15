<?php 

class MYPDF extends TCPDF
{
    
    //Page header
    public function Header()
    {
        $bMargin = $this->getBreakMargin();

        // Obtener el modo actual de salto de página automático
        $auto_page_break = $this->AutoPageBreak;

        // Deshabilitar el salto de página automático
        $this->SetAutoPageBreak(false, 0);

        // Defina la ruta a la imagen que desea usar como marca de agua.
        $img_file = 'assets/dist/img/anulado_rollo.png';

        // Renderizar la imagen
        $this->Image($img_file, 0, 30, 80, 180, '', '', '', false, 300, '', false, false, 0);

        // Restaurar el estado de salto de página automático
        $this->SetAutoPageBreak($auto_page_break, $bMargin);

        // Establecer el punto de partida para el contenido de la página
        $this->setPageMark();
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



$factura = json_decode($json);

//var_dump($factura); die();


$pageLayout = array(80, 280 + count($factura->detalle_productos)*10); //  or array($height, $width) 


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
$pdf->MultiCell(0, 10,  'FACTURA'."\n".'CON DERECHO A CRÉDITO FISCAL', 0, 'C', 0, 1, 2, 10, true, 0, false, true, 10, 'T', true);

$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(0, 30, 'CAPRESSO S.R.L.'."\n", 0, 'C', 0, 1, 2, 18, true, 0, false, true, 10, 'T', true);
$pdf->MultiCell(0, 30, 'Casa Matriz'."\n", 0, 'C', 0, 1, 2, 22, true, 0, false, true, 10, 'T', true);
$pdf->MultiCell(0, 30, 'No. Punto de Venta '.$factura->datos_factura->punto_venta."\n", 0, 'C', 0, 1, 2, 26, true, 0, false, true, 10, 'T', true);
$pdf->MultiCell(0, 30, 'CALLE 23 DE SEPTIEMBRE NRO.6 ZONA RUMY MAYU'."\n", 0, 'C', 0, 1, 6, 30, true, 0, false, true, 10, 'T', true);
$pdf->MultiCell(0, 30, 'Tel. 75934443'."\n", 0, 'C', 0, 1, 2, 38, true, 0, false, true, 10, 'T', true);
$pdf->MultiCell(0, 30, 'Cochabamba - Bolivia', 0, 'C', 0, 1, 2, 42, true, 0, false, true, 10, 'T', true);
$pdf->MultiCell(0, 30, '- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -', 0, 'C', 0, 1, 2, 46, true, 0, false, true, 10, 'T', true);
$pdf->SetFont('helvetica', 'B', 8);
$pdf->MultiCell(0, 10,  'NIT'."\n", 0, 'C', 0, 1, 2, 50, true, 0, false, true, 10, 'T', true);
$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(0, 10,  $factura->datos_factura->nit_emisor."\n", 0, 'C', 0, 1, 2, 54, true, 0, false, true, 10, 'T', true);
$pdf->SetFont('helvetica', 'B', 8);
$pdf->MultiCell(0, 10,  'FACTURA N° '."\n", 0, 'C', 0, 1, 2, 58, true, 0, false, true, 10, 'T', true);
$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(0, 10,  $factura->datos_factura->numero_factura."\n", 0, 'C', 0, 1, 2, 62, true, 0, false, true, 10, 'T', true);
$pdf->SetFont('helvetica', 'B', 8);
$pdf->MultiCell(0, 10,  'CÓD. AUTORIZACIÓN '."\n", 0, 'C', 0, 1, 2, 66, true, 0, false, true, 10, 'T', true);
$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(0, 10,  $factura->datos_factura->codigoCuf, 0, 'C', 0, 1, 5, 70, true, 0, false, true, 10, 'T', true);
$pdf->MultiCell(0, 30, '- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -', 0, 'C', 0, 1, 2, 78, true, 0, false, true, 10, 'T', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->MultiCell(38, 10,'NOMBRE/RAZÓN SOCIAL:', 0, 'R', 0, 1, 2, 82, true, 0, false, true, 10, 'T', true);
$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(36, 10,$factura->datos_factura->facturar_cliente_a, 0, 'L', 0, 1, 42, 82, true, 0, false, true, 10, 'T', true);
$pdf->SetFont('helvetica', 'B', 8);
$pdf->MultiCell(38, 20,'NIT/CI/CEX:'."\n"."COD. CLIENTE:"."\n"."FECHA DE EMISIÓN:", 0, 'R', 0, 1, 2, 86, true, 0, false, true, 10, 'T', true);
$time = strtotime($factura->datos_factura->datetime);
$new_time= date('d/m/Y H:i A',$time);

$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(38, 20,$factura->datos_factura->nit_cliente."\n".$factura->datos_factura->id_cliente."\n". $new_time, 0, 'L', 0, 1, 42, 86, true, 0, false, true, 10, 'T', true);
$pdf->MultiCell(0, 30, '- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -', 0, 'C', 0, 1, 2, 96, true, 0, false, true, 10, 'T', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->MultiCell(0, 10,  'DETALLE', 0, 'C', 0, 1, 2, 100, true, 0, false, true, 10, 'T', true);

mb_internal_encoding("UTF-8");
$pdf->SetFont('dejavusans', '', 7.2, '', true);
$contenido = $this->load->view('client/pdf2', '', TRUE);

$pdf->SetFont('dejavusans', '', 7.2, '', true);
$pdf->setXY(5, $pdf->getY()-5);
$pdf->writeHTML($contenido, true, true, true, true, 'L');

// ---------------------------------------------------------

$pdf->Cell(0,5,'---------------------------------------------------------------------------',0,1);


$x =  $pdf->getX();
$y =  $pdf->getY();

$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(38, 20,  'SUBTOTAL Bs'."\n".'DESCUENTO Bs'."\n".'TOTAL Bs'."\n".'MONTO GIFT CARD Bs', 0, 'R', 0, 1, $x+7, $y, true, 0, false, true, 10, 'M', true);

$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(32, 20, number_format($this->session->resumen['subtotal'], 2)."\n".number_format($this->session->resumen['descuento'], 2)."\n".number_format($this->session->resumen['total'], 2)."\n".number_format($this->session->resumen['monto_gift_card'], 2), 0, 'R', 0, 1, $x+36, $y, true, 0, false, true, 10, 'M', true);

$x =  $pdf->getX();
$y =  $pdf->getY();

$pdf->SetFont('helvetica', 'B', 8);
$pdf->MultiCell(38, 20,  'MONTO A PAGAR Bs '."\n", 0, 'R', 0, 1, $x+7, $y, true, 0, false, true, 10, 'T', true);
$descripcion_moneda = $factura->datos_factura->descripcion_moneda;
$increm=4;
$inc_mon=0;
if($descripcion_moneda != ''){
    $tamDes = strlen($descripcion_moneda);
    if($tamDes < 6){
        $pdf->SetFont('helvetica', 'B', 8);
    }else{
        $pdf->SetFont('helvetica', 'B', 6);
    }
    
    $pdf->MultiCell(38, 20,  'MONTO A PAGAR ('.$descripcion_moneda.') '."\n", 0, 'R', 0, 1, $x+7, $y+$increm, true, 0, false, true, 10, 'T', true);
    $inc_mon=$y+$increm;
    $increm=$increm+5.2;
}

$pdf->SetFont('helvetica', 'B', 6);
$pdf->MultiCell(38, 20,  'IMPORTE BASE CRÉDITO FISCAL Bs', 0, 'R', 0, 1, $x+7, $y+$increm, true, 0, false, true, 10, 'T', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->MultiCell(32, 20, number_format($this->session->resumen['monto_pagar'], 2)."\n", 0, 'R', 0, 1, $x+36, $y, true, 0, false, true, 10, 'T', true);
if($descripcion_moneda != ''){
    $montoMoneda = (($this->session->resumen['monto_sujeto_iva'])/($factura->datos_factura->tipo_cambio));
    $pdf->MultiCell(32, 20,round($montoMoneda, 2), 0, 'R', 0, 1, $x+36, $y+4, true, 0, false, true, 10, 'T', true);
}
$pdf->MultiCell(32, 20, number_format($this->session->resumen['monto_sujeto_iva'], 2), 0, 'R', 0, 1, $x+36, $y+$increm, true, 0, false, true, 10, 'T', true);


$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(122, 10,  'Son: '.ucfirst(($factura->datos_factura->literal)).' 00/100 Bolivianos', 0, 'L', 0, 1, $x, $y+12, true, 0, false, true, 10, 'T', true);
$pdf->MultiCell(0, 30, '- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -', 0, 'C', 0, 1, 2, $y+16, true, 0, false, true, 10, 'T', true);

$pdf->SetFont('helvetica', '', 7);
$pdf->MultiCell(0, 20,  'ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO ILÍCITO SERÁ SANCIONADO PENALMENTE DE ACUERDO A LEY', 0, 'C', 0, 1, 4, $y+16, true, 0, false, true, 10, 'M', true);

$pdf->SetFont('helvetica', '', 6.5);
$pdf->MultiCell(0, 10,  $factura->datos_factura->leyenda, 0, 'C', 0, 1, 5, $y+30, true, 0, false, true, 10, 'M', true);

$pdf->SetFont('helvetica', '', 7);
$pdf->MultiCell(0, 15, $factura->datos_factura->leyenda_on_off, 0, 'C', 0, 1, 6, $y+38, true, 0, false, true, 10, 'M', true);

$pdf->write2DBarcode(($factura->datos_factura->url_siat), 'QRCODE,L', $pdf->getX()+20, $pdf->getY()+1, 30, 30, null, 'N');



// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$nro_factura = $factura->datos_factura->numero_factura;
$pdf->Output(NAME_DIR.'assets/facturas/pdf_rollo/'.$nro_factura.'.pdf', 'F');
$pdf->Output(($factura->datos_factura->numero_factura).'.pdf', 'I');

?>