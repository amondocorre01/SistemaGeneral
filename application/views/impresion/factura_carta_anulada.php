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
        $img_file = 'assets/dist/img/anulado.png';

        // Renderizar la imagen
        $this->Image($img_file, 0, 0, 223, 280, '', '', '', false, 300, '', false, false, 0);

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
        // Page number
        setlocale(LC_ALL, 'es_MX');
        $this->Cell(0, 10, $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
    
}



$factura = json_decode($json);
//$res = json_encode($factura->datos_factura);


//var_dump($factura); die();
$titulo="REPORTE UNICO DE REGULARIZACION DE SITIOS MUNICIPALES EN MERCADOS, CENTROS DE ABASTO Y VIAS PUBLICAS";




// create new PDF document
$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(10);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 15);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
require_once(dirname(__FILE__) . '/lang/eng.php');
$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
$texto_sucursal='';
$codigo_sucursal = $factura->datos_factura->codigo_sucursal;
if($codigo_sucursal == '0'){
    $texto_sucursal = 'Casa Matriz';
}else{ 
    $texto_sucursal = 'Sucursal No. '.$codigo_sucursal;
}
// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage('P', 'LETTER');

$pdf->SetFont('helvetica', 'B', 9);
$pdf->MultiCell(60, 10, "".$factura->datos_factura->razon_social_emisor."\n".$texto_sucursal, 0, 'C', 0, 1, 15, 25, true, 0, false, true, 10, 'T', true);

$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(60, 20, 'No. Punto de Venta '.$factura->datos_factura->punto_venta."\n".$factura->datos_factura->direccion_emisor."\n"."Teléfono: ".$factura->datos_factura->telefono_emisor."\n".$factura->datos_factura->municipio_emisor, 0, 'C', 0, 1, 15, 35, true, 0, false, true, 10, 'T', true);

$pdf->SetFont('helvetica', 'B', 9);
$pdf->MultiCell(40, 20, 'NIT'."\n".'FACTURA N°'."\n".'CÓD. AUTORIZACIÓN', 0, 'L', 0, 1, 130, 25, true, 0, false, true, 25, 'T', true);

$pdf->SetFont('helvetica', '', 9);
$pdf->MultiCell(35, 20,  $factura->datos_factura->nit_emisor."\n".$factura->datos_factura->numero_factura."\n".$factura->datos_factura->codigoCuf, 0, 'L', 0, 1, 170, 25, true, 0, false, true, 25, 'T', true);

$pdf->SetFont('helvetica', 'B', 14);
$pdf->MultiCell(60, 10,  'FACTURA', 0, 'C', 0, 1, 75, 60, true, 0, false, true, 25, 'T', true);

$pdf->SetFont('helvetica', '', 10);
$pdf->MultiCell(60, 10,  '(Con Derecho a Crédito Fiscal)', 0, 'C', 0, 1, 75, 65, true, 0, false, true, 10, 'T', true);


$pdf->SetFont('helvetica', 'B', 9);
$pdf->MultiCell(38, 10,  'Fecha:'."\n".'Nombre/Razón Social:', 0, 'L', 0, 1, 15, 80, true, 0, false, true, 10, 'T', true);


$pdf->SetFont('helvetica', 'B', 9);
$pdf->MultiCell(25, 10,  'NIT/CI/CEX: '."\n".'Cod. Cliente:', 0, 'L', 0, 1, 155, 80, true, 0, false, true, 10, 'T', true);

$time = strtotime($factura->datos_factura->datetime);
$new_time= date('d/m/Y h:i A',$time);


$pdf->SetFont('helvetica', '', 9);
$pdf->MultiCell(80, 10,  $new_time."\n".$factura->datos_factura->facturar_cliente_a, 0, 'L', 0, 1, 55, 80, true, 0, false, true, 10, 'T', true);

$pdf->SetFont('helvetica', '', 9);
$pdf->MultiCell(25, 10, $factura->datos_factura->nit_cliente."\n".$factura->datos_factura->id_cliente, 0, 'L', 0, 1, 180, 80, true, 0, false, true, 10, 'T', true);



mb_internal_encoding("UTF-8");
$pdf->SetFont('dejavusans', '', 7, '', true);
$contenido = $this->load->view('client/pdf', '', TRUE);

$pdf->SetFont('dejavusans', '', 8, '', true);
$pdf->setXY(10, 100);
$pdf->writeHTML($contenido, true, true, true, true, 'L');

// ---------------------------------------------------------
$x =  $pdf->getX();
$y =  $pdf->getY();


$pdf->SetFont('helvetica', 'B', 9);
$pdf->MultiCell(122, 30,  'Son: '.ucfirst(($factura->datos_factura->literal)).' 00/100 Bolivianos', 0, 'L', 0, 1, $x, $pdf->getY(), true, 0, false, true, 10, 'M', true);

$pdf->setXY($x+121.5, $y);
$pdf->SetFont('dejavusans', '', 7, '', true);
$resumen = $this->load->view('client/resumen', '', TRUE);
$pdf->writeHTML($resumen, true, true, true, true, 'L');

$pdf->SetFont('helvetica', '', 7);
$pdf->MultiCell(160, 30,  'ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO ILÍCITO SERÁ SANCIONADO PENALMENTE DE ACUERDO A LEY'."\n\n".$factura->datos_factura->leyenda."\n\n".$factura->datos_factura->leyenda_on_off, 0, 'C', 0, 1, $x, $pdf->getY(), true, 0, false, true, 10, 'M', true);

$pdf->write2DBarcode(($factura->datos_factura->url_siat), 'QRCODE,L', $pdf->getX()+165, $pdf->getY()-23, 30, 30, null, 'N');



// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$nro_factura = $factura->datos_factura->numero_factura;
$pdf->Output(NAME_DIR.'assets/facturas/pdf/factura.pdf', 'F');
$pdf->Output(($factura->datos_factura->numero_factura).'.pdf', 'I');

?>