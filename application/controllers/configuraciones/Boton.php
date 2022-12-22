<?php
   
   defined('BASEPATH') OR exit('No direct script access allowed');
   
   class Boton extends CI_Controller {
   
      
      
      public function estado() {

         $id = $this->input->post('id');
         $dato['ESTADO'] = $this->input->post('estado');
         

         $this->main->update('VENTAS_ACCESO_BOTON', $dato, ['ID_VENTAS_ACCESO_BOTON'=>$id]);

         echo json_encode(['status'=>'OK']);

      }   


      public function todos() {

         $usuario = $this->input->post('usuario');
         $menu = $this->input->post('menu');
         $dato['ESTADO'] = $this->input->post('estado');
         

         $this->main->update('VENTAS_ACCESO_BOTON', $dato, ['ID_USUARIO'=>$usuario, 'ID_VENTAS_ACCESO'=>$menu]);

         echo json_encode(['status'=>'OK']);
      }  
      
      
      public function sucursal() {

         $sucursal = $this->input->post('sucursal');
         
         $campos = "nlp.ID_NOMBRE_LISTA_PRECIOS, NOMBRE_LISTA_PRECIOS AS CANAL, lvs.ID_VENTAS_LISTA_VENTA_SUCURSAL AS ID, TRANSPORTE, ENVIO_PROGRAMADO, DESCUENTO_FACTURADO, DESCUENTO_TRADICIONAL, ESTADO";

         $this->db->join('VENTAS_NOMBRE_LISTA_PRECIOS nlp', 'nlp.ID_NOMBRE_LISTA_PRECIOS = lvs.ID_NOMBRE_LISTA_PRECIOS', 'left');
                           
        $data['configuraciones']  = $this->main->getListSelect('VENTAS_LISTA_VENTA_SUCURSAL lvs', $campos, ['ID_NOMBRE_LISTA_PRECIOS'=>'ASC'],['ID_UBICACION'=>$sucursal]);

        $this->load->view('configuraciones/html/boton', $data, FALSE);
      }


      public function save() {

         $id = $this->input->post('id');
         $columna = $this->input->post('boton');
         $valor = $this->input->post('valor'); 
         
         $this->main->update('VENTAS_LISTA_VENTA_SUCURSAL', [$columna=>$valor], ['ID_VENTAS_LISTA_VENTA_SUCURSAL'=>$id]);

         echo json_encode(['status' => 'OK']);

      }
   }