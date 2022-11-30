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


$pageLayout = array(80, 120 + count($factura->detalle_productos)*10); //  or array($height, $width) 


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
$texto_sucursal='';
$codigo_sucursal = $factura->datos_factura->codigo_sucursal;
if($codigo_sucursal == '0'){
    $texto_sucursal = 'Casa Matriz';
}else{ 
    $texto_sucursal = 'Sucursal No. '.$codigo_sucursal;
}
$time = strtotime($factura->datos_factura->datetime);
$new_time= date('d/m/Y H:i A',$time);
$html='<center><b>RECIBO</b></center><br><br>
        <center><b>'.$factura->datos_factura->descripcion_sucursal.'</b></center><br>
        <center>'.$factura->datos_factura->name_page_sucursal.'</center><br>
        <center>'.$factura->datos_factura->razon_social_emisor.'</center><br>
        <center>'.$texto_sucursal.'</center><br>
        <center>No. Punto de Venta '.$factura->datos_factura->punto_venta.'</center><br>
        <center>'.$factura->datos_factura->direccion_emisor.'</center><br>
        <center>'.$factura->datos_factura->telefono_emisor.'</center><br>
        <center>'.$factura->datos_factura->municipio_emisor.'</center><br>
        <center>--------------------------------------------------------------------</center><br>
        <center><b>NIT</b></center><br>
        <center>'.$factura->datos_factura->nit_emisor.'</center><br>
        <center><b>PEDIDO N°</b></center><br>
        <center>'.$factura->datos_factura->numero_pedido.'</center><br>
        <center>--------------------------------------------------------------------</center><br>
        <table>
            <tr><td>NOMBRE/RAZÓN SOCIAL:</td><td>'.$factura->datos_factura->facturar_cliente_a.'</td></tr>
            <tr><td>NIT/CI/CEX:</td><td>'.$factura->datos_factura->nit_cliente.'</td></tr>
            <tr><td>COD. CLIENTE:</td><td>'.$factura->datos_factura->id_cliente.'</td></tr>
            <tr><td>FECHA DE EMISIÓN:</td><td>'.$new_time.'</td></tr>
        </table>
        <center>--------------------------------------------------------------------</center><br>
        <center><b>DETALLE</b></center><br>
        ';
//$contenido = $this->load->view($html, '', TRUE);
$pdf->writeHTML($html, true, true, true, true, 'C');

mb_internal_encoding("UTF-8");
$pdf->SetFont('dejavusans', '', 7.2, '', true);
$contenido = $this->load->view('client/pdf2', '', TRUE);
$pdf->writeHTML($contenido, true, true, true, true, 'L');

$subtotal = number_format($this->session->resumen['subtotal'], 2);
$descuento = number_format($this->session->resumen['descuento'], 2);
$total = number_format($this->session->resumen['total'], 2);
$monto_gift_card = number_format($this->session->resumen['monto_gift_card'], 2);
$monto_pagar = number_format($this->session->resumen['monto_pagar'], 2);
$literal='Son: '.ucfirst(($factura->datos_factura->literal)).' '.$factura->datos_factura->fraccion.'/100 Bolivianos';
$html = '<center>--------------------------------------------------------------------</center><br>
        <table>
        <tr><td>SUBTOTAL Bs</td><td>'.$subtotal.'</td></tr>
        <tr><td>DESCUENTO Bs</td><td>'.$descuento.'</td></tr>
        <tr><td>TOTAL Bs</td><td>'.$total.'</td></tr>
        <tr><td>MONTO GIFT CARD Bs</td><td>'.$monto_gift_card.'</td></tr>
        <tr><td><b>MONTO A PAGAR Bs</b></td><td><b>'.$monto_pagar.'</b></td></tr>
        </table><br><br>'.$literal.'
        ';
$pdf->writeHTML($html, true, true, true, true, 'C');

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$nro_factura = $factura->datos_factura->numero_factura;
//$pdf->Output(NAME_DIR.'assets/facturas/pdf_rollo/factura.pdf', 'F');
$ver_pdf_rollo = $factura->datos_factura->ver_pdf_rollo;
if($ver_pdf_rollo == '1'){
    $pdf->Output(($factura->datos_factura->numero_factura).'.pdf', 'I');
}

?>