<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Impresion extends CI_Controller {

        
        public function __construct()
        {
            parent::__construct();
            $this->load->library('QRlib/index'); 
        }
        
    
        public function anular()
        {
            $db = $this->input->post('db');
            $suf_suc = $this->input->post('suf_suc');
            $id_menu = $this->input->post('id_menu');



            $DB2 = $this->load->database($db, TRUE);

            $id = $this->input->post('id');

            $DB2->where('ID_VENTA_DOCUMENTO', $id);
            $DB2->update('VENTA_DOCUMENTO'.$suf_suc , ['ANULADO'=>1]);

            $this->session->set_flashdata('anulado', 'SI');
            

            redirect(site_url('generico/inicio?vc='.$id_menu),'refresh');
        
        }

        public function copia()
        {
            $id = $this->input->post('id');
            $pre_suc = $this->input->post('pre_suc');

            $result = $this->main->get($pre_suc.'VENTAS', ['ID_VENTA_DOCUMENTO'=>$id]);

            $literal = convertir($result->TOTAL_A_PAGAR);
    
            $result->literal = $literal; 

            $res=json_encode($result);
            $this->session->set_userdata('data-imprimir', $res);
            echo $res;
        }

        public function original()
        {
            $id = $this->input->post('id');
            $result = $this->main->get(PRE_SUC.'VENTAS', ['ID_VENTA_DOCUMENTO'=>$id]);


            $literal = convertir($result->TOTAL_A_PAGAR);
    
            $result->literal = $literal; 
            $res=json_encode($result);
            $this->session->set_userdata('data-imprimir', $res);
            echo $res;
        }

        public function factura($valor){
            $data['valor'] = $valor;
            $this->load->view('impresion/imprimir_factura', $data, FALSE);
        }

        public function recibo($valor){
            $data['valor'] = $valor;
            $this->load->view('impresion/imprimir_recibo', $data, FALSE);
        }

        public function gaveta(){
            $this->load->view('impresion/abrir_gaveta', null, FALSE);
        }

        public function ingreso(){
            $this->load->view('impresion/imprimir_ingreso', null, FALSE);
        }

        public function egreso(){
            $this->load->view('impresion/imprimir_egreso', null, FALSE);
        }

        public function abrirCaja(){
            $this->load->view('impresion/imprimir_abrir_caja', null, FALSE);
        }

        public function cierreCaja(){
            $this->load->view('impresion/imprimir_cierre_caja', null, FALSE);
        }
        
        public function reimprimirFactura(){
            $this->load->view('impresion/reimprimir_factura', null, FALSE);
        }
        
        public function imprimirCopiaFactura(){
            $this->load->view('impresion/imprimir_copia_factura', null, FALSE);
        }
        
    
    }
    
    /* End of file Impresion.php */
    
