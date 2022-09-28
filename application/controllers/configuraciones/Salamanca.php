<?php
   
   defined('BASEPATH') OR exit('No direct script access allowed');
   
   class Salamanca extends CI_Controller {
   
      public function index()
      {
         $DB2 = $this->load->database('salamanca', TRUE);
         
         $sql = 'EXEC SS_GET_DOSIFICACION';
         $res = $DB2->query($sql)->result();
         echo json_encode($res);
      }

      public function nueva()
      {
         $DB2 = $this->load->database('salamanca', TRUE);

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
         
         $sql = "EXEC SS_SET_DOSIFICACION '$correo',$nit,'$razon','$autorizacion','$actividad','$sistema','$dias','$fecha','$leyenda','$llave','$estado','$matriz','$sucursal','$direccion','$telefono','$departamento'";

         $res = $DB2->query($sql);
         
         echo json_encode($res);
      }
   
   }
   
   /* End of file Dosificacion.php */
   