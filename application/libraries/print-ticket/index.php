<?php

require __DIR__ . '/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Escpos\EscposImage;
use Escpos\PrintConnectors\WindowsPrintConnector;
use Escpos\Printer;

/*
Este ejemplo imprime un hola mundo en una impresora de tickets
en Windows.
La impresora debe estar instalada como genérica y debe estar
compartida
 */

/*
Conectamos con la impresora
 */

/*
Aquí, en lugar de "POS-58" (que es el nombre de mi impresora)
escribe el nombre de la tuya. Recuerda que debes compartirla
desde el panel de control
 */

$nombre_impresora = "EPSON TM-T20III Receipt";

$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->setJustification(Printer::JUSTIFY_CENTER);

$logo = EscposImage::load("logo.png", false);
$printer->bitImage($logo);

/*
Imprimimos un mensaje. Podemos usar
el salto de línea o llamar muchas
veces a $printer->text()
 */

$printer->setTextSize(2, 2);
$printer->text("FACTURA");

$printer->setTextSize(2, 1);
$printer->feed();
$printer->text("Welcome to Capresso");

/*
Hacemos que el papel salga. Es como
dejar muchos saltos de línea sin escribir nada
 */
$printer->feed(15);

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
$printer->pulse();

/*
Para imprimir realmente, tenemos que "cerrar"
la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
 */
$printer->close();
?>

<script> 
setTimeout(function(){
            window.close();
        },500); 
</script>
