<?php
   
   defined('BASEPATH') OR exit('No direct script access allowed');
   
   class Sucursal extends CI_Controller {
   
      
      public function comanda()
      {  
         $categoria = $this->input->post('categoria');
         $valor = $this->input->post('valor');

         $DB2 = $this->load->database('pando', TRUE);
         
         $sql = "DELETE FROM IMPRESION_SP WHERE ID_CATEGORIA= $categoria";
         $DB2->query($sql);

         $sql_2 = "INSERT INTO IMPRESION_SP(ID_CATEGORIA, COMANDA_$valor) VALUES ($categoria, 1)";
         $DB2->query($sql_2);
         
         echo 'OK';
      }

      public function message() {

         $dato['MENSAJE_FACTURA'] = $this->input->post('factura');
         $dato['MENSAJE_COMANDA'] = $this->input->post('comanda');
         $dato['MENSAJE_RECIBO'] = $this->input->post('recibo');
         $id = $this->input->post('id');

         $this->main->update('ID_UBICACION', $dato, ['ID_UBICACION'=>$id]);

         echo json_encode(['status'=>'OK']);

      }

      public function impresora() {

         $dato['IMPRESORA'] = $this->input->post('impresora');
         $id = $this->input->post('id');

         $this->main->update('ID_UBICACION', $dato, ['ID_UBICACION'=>$id]);

         echo json_encode(['status'=>'OK']);

      }
   
   }