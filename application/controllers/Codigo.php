<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Codigo extends CI_Controller {

        
        public function __construct()
        {
            parent::__construct();
            $this->load->library('demo');
            $this->load->library('factura');
        }
        
    
        public function index()
        {

            $numero_autorizacion = '197801600000479';
            $numero_factura = '3010';
            $nit_cliente = '1010743025';
            $fecha_compra = '20080419';
            $monto_compra = number_format('89721.62', 0, '.', '');
            $clave = 'CS@@IW58@4X2)CH4q+7_B7GEQ3%5UHs88JH{@ibIzwAmv5%TqCuP6)$mdwiSn-f8';
            $n = 65;   
                echo $this->demo->codigo($numero_autorizacion, $numero_factura, $nit_cliente, $fecha_compra, $monto_compra, $clave);

                echo  convertir($n); 


                $this->factura->imprimirFactura();
        }


        public function qr()
        {
            $this->load->view('qr', null, FALSE);
        }
    
    }
    
    /* End of file Codigo.php */
    


?>