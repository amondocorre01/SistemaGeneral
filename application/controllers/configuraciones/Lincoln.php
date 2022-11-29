<?php
   
   defined('BASEPATH') OR exit('No direct script access allowed');
   
   class Lincoln extends CI_Controller {
   
      public function index()
      {
         $DB2 = $this->load->database('lincoln', TRUE);
         
         $sql = 'EXEC SH_GET_DOSIFICACION';
         $res = $DB2->query($sql)->result();
         echo json_encode($res);
      }

      public function nueva()
      {
         $DB2 = $this->load->database('lincoln', TRUE);

         $correo = $this->input->post('correo');
         $nit=$this->input->post('nit'); 
         $razon=$this->input->post('razon'); 
         $autorizacion=$this->input->post('autorizacion'); $actividad=$this->input->post('actividad'); 
         $sistema=$this->input->post('sistema'); 
         $dias=$this->input->post('dias'); 
         $fecha=$this->input->post('fecha'); 
         $leyenda=$this->input->post('leyenda'); 
         $llave=$this->input->post('llave'); 
         $estado=$this->input->post('estado'); 
         $matriz=$this->input->post('matriz'); 
         $sucursal=$this->input->post('sucursal'); 
         $direccion=$this->input->post('direccion'); 
         $telefono=$this->input->post('telefono'); $departamento=$this->input->post('departamento');
         
         $sql = "EXEC SH_SET_DOSIFICACION '$correo',$nit,'$razon','$autorizacion','$actividad','$sistema','$dias','$fecha','$leyenda','$llave','$estado','$matriz','$sucursal','$direccion','$telefono','$departamento'";

         $res = $DB2->query($sql);
         
         echo json_encode($res);
      }

      public function activar()
      {  
         $id = $this->input->post('id');
         $estado = $this->input->post('estado');

         $DB2 = $this->load->database('lincoln', TRUE);
         
         $sql = "EXEC SH_UPDATE_DOSIFICACION ".$id.",".$estado;
         $res = $DB2->query($sql);
         
         echo json_encode($res);
      }

      public function comanda()
      {  
         $categoria = $this->input->post('categoria');
         $valor = $this->input->post('valor');

         $DB2 = $this->load->database('lincoln', TRUE);
         
         $sql = "DELETE FROM IMPRESION_SAO WHERE ID_CATEGORIA= $categoria";
         $DB2->query($sql);

         $sql_2 = "INSERT INTO IMPRESION_SAO(ID_CATEGORIA, COMANDA_$valor) VALUES ($categoria, 1)";
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
   }
   
   /* End of file Dosificacion.php */
   