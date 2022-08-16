<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once 'codigoControl/CodigoControlV7/CodigoControlV7.php';

class Demo extends CodigoControlV7
{
    public function __construct() {
      
    }

    public function codigo($numero_autorizacion, $numero_factura, $nit_cliente, $fecha_compra, $monto_compra, $clave) {
        
        return CodigoControlV7::generar($numero_autorizacion, $numero_factura, $nit_cliente, $fecha_compra, $monto_compra, $clave); 
    }
}