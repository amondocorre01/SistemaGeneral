
<?php
ob_start(); # apertura de bufer
//include( 'begin.php' );

//DATOS DEL SISTEMA

//FIN DATOS_SISTEMA
?>
<h3>Capresso SRL</h3>

<?php
$html_content = ob_get_contents();
ob_end_clean();
$time = time(); 
$date= date("d-m-Y", $time);
$html='
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
      <style>
          body{
              font-family: sans-serif;
              font-size: 13px;
          }
      </style>
      
    <title>CAPRESSO</title>
  </head>
  <body>
     '.$html_content.'
  </body>
</html>
';
//==============================================================
//==============================================================
//==============================================================
//echo getcwd();
$dir = '../../'.__DIR__;
require_once('..\..\libraries\vendor\autoload.php');
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('mpdf.pdf','I');
