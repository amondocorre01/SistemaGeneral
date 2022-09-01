<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cuis extends CI_Controller {
    
        public function index()
        {
            $campos = "ROW_NUMBER() OVER(ORDER BY ESTADO DESC) AS row, CODIGO_AMBIENTE
            ,CODIGO_SISTEMA
            ,NIT
            ,CODIGO_MODALIDAD
            ,CODIGO_SUCURSAL
            ,CODIGO_PUNTO_VENTA
            ,CODIGO_CUIS
            ,FECHA_VIGENCIA
            ,CODIGO
            ,DESCRIPCION
            ,TRANSACCION
            ,ESTADO
            ,ID_VENTAS_F00_LLAVE";
            $llaves = $this->main->getListSelect('VENTAS_F01_CUIS', $campos);

            echo json_encode(['data'=>$llaves]);
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
    