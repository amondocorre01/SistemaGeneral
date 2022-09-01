<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cuis extends CI_Controller {
    
        public function index()
        {
            
        }

        public function create()
        {
            $ambiente = $this->input->post['ambiente']; 
            $venta = $this->input->post['venta']; 
            $sistema = $this->input->post['sistema'];
            $nit = $this->input->post['nit']; 
            $sucursal = $this->input->post['sucursal']; 
            $modalidad = $this->input->post['modalidad'];

            
        }
    
    }
    
    /* End of file Cuis.php */
    