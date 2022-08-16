<?php

require_once 'print-ticket/autoload.php';

use Escpos\PrintConnectors\WindowsPrintConnector;
use Escpos\Printer;

class Factura extends Printer
{
    public function __construct() {
      $this->nombre_impresora='EPSON TM-T20III Receipt';
    }

    public function imprimirFactura(){
        
        $connector = new WindowsPrintConnector($this->nombre_impresora);
        return 'hola';
        $printer = new Printer($connector);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        
        
        $direccion='';
        $telefono=1234567;
        $tipoFactura="ORIGINAL";
        $nroFactura=123;
        $nitEmpresa=174496020;
        $nroAutorizacion="385401200152848";
        $fecha="27/07/2022 16:01"; 
        $usuario="RMA";
        $nomCliente=" JUAN PEREZ";
        $nitCliente=12345678;
        $importeT=1000;
        $literal="un mil 00/100 Bolivianos";
        /*
        Imprimimos un mensaje. Podemos usar
        el salto de línea o llamar muchas
        veces a $printer->text()
        */
    
        $printer->setTextSize(2, 1);
        $printer->text("CAPRESSO SRL");
    
        $printer->setTextSize(1, 1);
        $printer->feed();
    
        $printer->text("CASA MATRIZ\n");
        $printer->text($direccion."\n");
        $printer->text($telefono."\n");
        $printer->text("Cochabamba - Bolivia\n");
        $printer->text("SFC 1\n");
        $printer -> setFont(Printer::FONT_B);
        $printer->text("FACTURA\n");
    
        $printer->text($tipoFactura."\n");
        $printer->feed(2);
        $printer->text("NIT".$nitEmpresa."\n");
        $printer->text("FACTURA N°:".$nroFactura."\n");
        $printer->text("AUTORIZACION".$nroAutorizacion."\n");
    
        /*
        Hacemos que el papel salga. Es como
        dejar muchos saltos de línea sin escribir nada
        */
        $justification = array(
            Printer::JUSTIFY_LEFT,
            Printer::JUSTIFY_CENTER,
            Printer::JUSTIFY_RIGHT);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        $printer->setJustification();
        $printer->text("________________________________________________\n");
        $printer->text("Bares Whiskerias y cafés\n");
        $printer->text("________________________________________________\n");
        $printer->text("FECHA".$fecha."\t Caj.:".$usuario."\n");
        $printer->text("SEÑOR(ES):".$nomCliente."\n");
        $printer->text("NIT / CI:".$nitCliente."\n");
        $printer->text("________________________________________________\n");
        $printer->text("CANT\tCONCEPTO\tP.UNIT. \t SUBTOT\n");
        $printer->text("________________________________________________\n");
        // COLOCAR LOS PRODUCTOS
        $printer->text("________________________________________________\n");
        $printer->text("IMPORTE TOTAL BS: ". $importeT."\n");
        $printer -> setFont(Printer::FONT_B);
        $printer->text("Son: ". $literal."\n");
    
    
    
    
        $printer->feed(5);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("_______________________");
        $printer->feed();
        $printer->text("NOMBRE USUARIO");
        $printer->feed();
        /*
        Cortamos el papel. Si nuestra impresora
        no tiene soporte para ello, no generará
        ningún error
        */
        $printer->cut();
    
    
    
        /*
        Por medio de la impresora mandamos un pulso.
        Esto es útil cuando la tenemos conectada
        por ejemplo a un cajón
        */
        //$printer->pulse();
    
        /*
        Para imprimir realmente, tenemos que "cerrar"
        la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
        */
        $printer->close();
        echo '<script> 
        setTimeout(function(){
                    window.close();
                },500); 
        </script>';
    }
}

