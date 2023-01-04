<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Formas extends CI_Controller {
    
        public function index()
        {
            $data['canales'] = $this->main->getListSelect('VENTAS_NOMBRE_LISTA_PRECIOS', 'ID_NOMBRE_LISTA_PRECIOS,NOMBRE_LISTA_PRECIOS,	FACTURADO');

            $data['formas'] = $this->main->getListSelect('VENTAS_F02_SINCRONIZACION', 'CODIGO, DESCRIPCION', null, ['ID_VENTAS_F02_CATALOGOS' => 14, 'ESTADO' => 1]);

            $data['sucursal'] = $this->input->post('sucursal');

            $this->load->view('configuraciones/html/formas', $data, FALSE);
            
        }

        public function update()
        {
            $registro['ID_FORMA_PAGO'] = $this->input->post('forma'); 
            $registro['ID_UBICACION']  = $this->input->post('sucursal');
            $registro['ID_LISTA_VENTAS'] = $this->input->post('canal');
            $registro['ID_ESTADO'] = $this->input->post('value');

            $id = $this->main->getField('VENTAS_FORMA_PAGO_ESTADO', 'ID_VENTAS_FORMA_PAGO_ESTADO', ['ID_FORMA_PAGO'=> $this->input->post('forma'), 'ID_LISTA_VENTAS'=> $this->input->post('canal'),	'ID_UBICACION'=> $this->input->post('sucursal')]);

            if($id) {

                $this->main->update('VENTAS_FORMA_PAGO_ESTADO', ['ID_ESTADO'=>$this->input->post('value')], ['ID_VENTAS_FORMA_PAGO_ESTADO'=>$id]);
            }

            else {

                $this->main->insert('VENTAS_FORMA_PAGO_ESTADO', $registro);
            }

            $response['status'] = true;

            echo json_encode($response);
        }
    
    }
    
    /* End of file Formas.php */
    