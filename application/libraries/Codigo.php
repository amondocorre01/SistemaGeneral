<?php

use Escpos\Printer;

 defined('BASEPATH') or exit('No direct script access allowed');

    
    class Codigo
    {

        public function __construct()
        {
            $this->load->library('factura');   
        }

        function generar($numero_autorizacion, $numero_factura, $nit_cliente, $fecha_compra, $monto_compra, $clave) {

          return CodigoControlV7::generar($numero_autorizacion, $numero_factura, $nit_cliente, $fecha_compra, $monto_compra, $clave); 
        }

        public function hola() {

            return "HOLA $this->numero_autorizacion";
        } 
    }
    
    /* End of file Codigo.php */
    

?>