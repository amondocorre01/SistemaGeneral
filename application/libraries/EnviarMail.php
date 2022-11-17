<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'mail/phpmailer/src/PHPMailer.php';
require_once 'mail/phpmailer/src/SMTP.php';
require_once 'mail/phpmailer/src/Exception.php';

/*

$nroFactura=123;
$nombreEmpresa='CAPRESSO SRL';
$celular='591 75900000';
$correo='soporte@capressocafe.com';
$direccion='Av. Salamanca Nro. 123456';
$ciudad='Cochabamba - Bolivia';
$paginaWeb='www.capressocafe.com';
$correoCliente='amondocorre@gmail.com';
$correoEmpresa='facturacion.capresso@outlook.com';
$rutaXml='factura/20.xml';
$rutaPdf='factura/20.pdf';

echo enviarCorreo($nroFactura,$nombreEmpresa,$celular,$correo,$direccion,$ciudad,$paginaWeb,$correoCliente,$correoEmpresa,$rutaXml,$rutaPdf);
*/

class EnviarMail 
{

    function __construct() {
        
    }

    function enviarCorreo($nroFactura,$nombreEmpresa,$celular,$correo,$direccion,$ciudad,$paginaWeb,$correoCliente,$correoEmpresa,$rutaXml,$rutaPdf){
        $mail = new PHPMailer(true);
        try {
            $email_emisor = 'facturacion.capresso@outlook.com';
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'facturacion.capresso@outlook.com';
            $mail->Password = 'CapInternet123!';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom(($email_emisor), $nombreEmpresa);
            $mail->addAddress($correoCliente, $nombreEmpresa);

            chmod($rutaXml,  0666);
            chmod($rutaPdf,  0666);
            $mail->addAttachment($rutaXml, 'Factura_'.$nroFactura.'.xml');
            $mail->addAttachment($rutaPdf, 'Factura_'.$nroFactura.'.pdf');
            
            $mail->isHTML(true);
            $mail->Subject = 'Emision de Documento Fiscal';
            $html=' <h1 style="color: #AD2205;">Numero de Factura: '.$nroFactura.'</h1>
                    <p>Estimado(a) usuario(a),'.$nombreEmpresa.' procedi&oacute; a generar la Factura correspondiente, descritos en la Factura Nro. <strong>'.$nroFactura.'</strong></p>
                    <p>Adjunto encontrara los archivos la factura en formato pdf y la factura firmada digitalmente en formato xml.</p>
                    <p><strong>No responda a este mensaje.</strong>&nbsp;En caso de que se le presente alguna duda o inquietud puede contactarnos a los tel&eacute;fonos y correo electr&oacute;nico mencionados en el pie de este mensaje.</p>
                    <p>&nbsp;</p>
                    <p><strong>Telf:</strong>'.$celular.'<br /><strong>Correo Electr&oacute;nico:</strong>&nbsp;<a href="mailto:'.$correo.'" target="_blank" rel="noopener">'.$correo.'</a><br /><strong>Direcci&oacute;n:</strong>'.$direccion.'<br /><strong>Sitio Web:</strong>&nbsp;<a href="https://'.$paginaWeb.'" target="_blank" rel="noopener" data-saferedirecturl="'.$paginaWeb.'">https://'.$paginaWeb.'</a></p>';
            $mail->Body = $html;
            $mail->send();
            
            return true;
            
        } catch (Exception $e) {
            echo 'Mensaje ' . $mail->ErrorInfo;
            return false;
            
        }
     
    }

    function enviarCorreoAnulado($nroFactura,$nombreEmpresa,$celular,$correo,$direccion,$ciudad,$paginaWeb,$correoCliente,$correoEmpresa,$rutaXml,$rutaPdf,$codigoCuf){
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPAuth = true;
            $correoEmpresa = 'facturacion.capresso@outlook.com';
            $mail->Username = 'facturacion.capresso@outlook.com';
            $mail->Password = 'CapInternet123!';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($correoEmpresa, $nombreEmpresa);
            $mail->addAddress($correoCliente, $nombreEmpresa);
            //$mail->addCC('concopia@gmail.com');
            //echo getcwd().$rutaXml;
            /*chmod(getcwd().$rutaXml,  0666);
            chmod(getcwd().$rutaPdf,  0666);*/
            //chmod($rutaXml,  0666);
            chmod($rutaPdf,  0666);
            //$mail->addAttachment($rutaXml, 'Factura_'.$nroFactura.'.xml');
            $mail->addAttachment($rutaPdf, 'Factura_'.$nroFactura.'.pdf');
            
            //echo getcwd().'<br>';
            //echo $mail.'<br>';

            $mail->isHTML(true);
            $mail->Subject = 'Notificacion';
            $html=' <h1 style="color: #AD2205;">Facturacion Notificacion: '.$nroFactura.'</h1>
                    
                    <p>Estimado(a) usuario(a),'.$nombreEmpresa.' procedi&oacute; a anular la Factura correspondiente, con numero de Autorizacion. <strong>'.$codigoCuf.'</strong></p>
                    <p>Adjunto encontrara el archivo de la factura anulada en formato pdf.</p>
                    <p><strong>No responda a este mensaje.</strong>&nbsp;En caso de que se le presente alguna duda o inquietud puede contactarnos a los tel&eacute;fonos y correo electr&oacute;nico mencionados en el pie de este mensaje.</p>
                    <p>&nbsp;</p>
                    <p><strong>Telf:</strong>'.$celular.'<br /><strong>Correo Electr&oacute;nico:</strong>&nbsp;<a href="mailto:'.$correo.'" target="_blank" rel="noopener">'.$correo.'</a><br /><strong>Direcci&oacute;n:</strong>'.$direccion.'  '.$direccion.'<br /><strong>Sitio Web:</strong>&nbsp;<a href="https://'.$paginaWeb.'" target="_blank" rel="noopener" data-saferedirecturl="'.$paginaWeb.'">https://'.$paginaWeb.'</a></p>';
            $mail->Body = $html;
            $mail->send();
            
            return true;
            
        } catch (Exception $e) {
            //echo 'Mensaje ' . $mail->ErrorInfo;
            return false;
            
        }
     
    }

    function enviarCorreoGC($nombreEmpresa,$celular,$correo,$direccion,$ciudad,$paginaWeb,$correoCliente,$correoEmpresa,$monto_gift_card,$rutaGC,$fecha_vencimiento){
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPAuth = true;
            $correoEmpresa = 'facturacion.capresso@outlook.com';
            $mail->Username = 'facturacion.capresso@outlook.com';
            $mail->Password = 'CapInternet123!';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($correoEmpresa, $nombreEmpresa);
            $mail->addAddress($correoCliente, $nombreEmpresa);
            chmod($rutaGC,  0666);
            $mail->addAttachment($rutaGC, 'gift_card.png');

            $mail->isHTML(true);
            $mail->Subject = 'Emision de Gift Card';
            $html=' <h1 style="color: #AD2205;">GIFT CARD</h1>
                    
                    <p>Estimado(a) usuario(a),'.$nombreEmpresa.' procedi&oacute; a generar la Gift Card <strong></strong></p>
                    <p>El monto de la Gift Card es: '.$monto_gift_card.' Bs.-  con fecha de vencimiento: '.$fecha_vencimiento.'</p>
                    <p><strong>No responda a este mensaje.</strong>&nbsp;En caso de que se le presente alguna duda o inquietud puede contactarnos a los tel&eacute;fonos y correo electr&oacute;nico mencionados en el pie de este mensaje.</p>
                    <p>&nbsp;</p>
                    <p><strong>Telf:</strong>'.$celular.'<br /><strong>Correo Electr&oacute;nico:</strong>&nbsp;<a href="mailto:'.$correo.'" target="_blank" rel="noopener">'.$correo.'</a><br /><strong>Direcci&oacute;n:</strong>'.$direccion.'  '.$direccion.'<br /><strong>Sitio Web:</strong>&nbsp;<a href="https://'.$paginaWeb.'" target="_blank" rel="noopener" data-saferedirecturl="'.$paginaWeb.'">https://'.$paginaWeb.'</a></p>';
            $mail->Body = $html;
            $mail->send();
            
            return true;
            
        } catch (Exception $e) {
            //echo 'Mensaje ' . $mail->ErrorInfo;
            return false;
            
        }
     
    }

    function enviarCorreoGCActualizado($nombreEmpresa,$celular,$correo,$direccion,$ciudad,$paginaWeb,$correoCliente,$correoEmpresa,$monto_gift_card,$rutaGC,$fecha_vencimiento){
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPAuth = true;
            $correoEmpresa = 'facturacion.capresso@outlook.com';
            $mail->Username = 'facturacion.capresso@outlook.com';
            $mail->Password = 'CapInternet123!';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($correoEmpresa, $nombreEmpresa);
            $mail->addAddress($correoCliente, $nombreEmpresa);
            chmod($rutaGC,  0666);
            $mail->addAttachment($rutaGC, 'gift_card.png');

            $mail->isHTML(true);
            $mail->Subject = 'Emision de Gift Card';
            $html=' <h1 style="color: #AD2205;">GIFT CARD</h1>
                    
                    <p>Estimado(a) usuario(a),'.$nombreEmpresa.' procedi&oacute; a actualizar la Gift Card correspondiente<strong></strong></p>
                    <p>Su saldo de la Gift Card es: '.$monto_gift_card.' Bs.- con fecha de vencimiento: '.$fecha_vencimiento.'</p>
                    <p><strong>No responda a este mensaje.</strong>&nbsp;En caso de que se le presente alguna duda o inquietud puede contactarnos a los tel&eacute;fonos y correo electr&oacute;nico mencionados en el pie de este mensaje.</p>
                    <p>&nbsp;</p>
                    <p><strong>Telf:</strong>'.$celular.'<br /><strong>Correo Electr&oacute;nico:</strong>&nbsp;<a href="mailto:'.$correo.'" target="_blank" rel="noopener">'.$correo.'</a><br /><strong>Direcci&oacute;n:</strong>'.$direccion.'  '.$direccion.'<br /><strong>Sitio Web:</strong>&nbsp;<a href="https://'.$paginaWeb.'" target="_blank" rel="noopener" data-saferedirecturl="'.$paginaWeb.'">https://'.$paginaWeb.'</a></p>';
            $mail->Body = $html;
            $mail->send();
            
            return true;
            
        } catch (Exception $e) {
            //echo 'Mensaje ' . $mail->ErrorInfo;
            return false;
            
        }
     
    }
}