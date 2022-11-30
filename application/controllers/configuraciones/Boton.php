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
   }