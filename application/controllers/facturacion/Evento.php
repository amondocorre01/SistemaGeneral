<?php 
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Evento extends CI_Controller {
    
        public function index()
        {
            $campos = "ROW_NUMBER() OVER(ORDER BY ID_VENTA_EVENTO DESC) AS row, CODIGO, DESCRIPCION,  INICIO_EVENTO, FIN_EVENTO";

            
            $DB2 = $this->load->database('ventas', TRUE);

                        $DB2->select($campos);
          $respuesta =  $DB2->get('VENTA_EVENTOS_F');

            $eventos = $respuesta->result();

            echo json_encode(['data'=>$eventos]);
        }

        public function create() {

            $DB2 = $this->load->database('ventas', TRUE);

                           
                          $DB2->select('ID_VENTAS_F03_CUF');
                          $DB2->where('FECHA', $this->input->post('activacion'));
                          $DB2->limit(1);     
            $respuesta =  $DB2->get('VENTAS_F03_CUFD_F')->result();

            $response['status'] = false;

            $codigo = explode("-", $this->input->post('codigo'));

            
            $registro['ID_VENTAS_F03_CUFD'] = $respuesta->ID_VENTAS_F03_CUF;
            $registro['CODIGO'] = $codigo[1];
            $registro['ID_CUIS'] = $codigo[0];
            $registro['DESCRIPCION'] = $this->input->post('descripcion');
            $registro['INICIO_EVENTO'] = $this->input->post('activacion').'T'.$this->input->post('h_activacion').':00.000';
            $registro['FIN_EVENTO'] = $this->input->post('vencimiento').'T'.$this->input->post('h_vencimiento').':00.000';
            
           

            $DB2->insert('VENTA_EVENTOS_F', $registro);

            if($DB2->affected_rows()) {
                $response['status'] = true;
            }

        }
    
    }
    
    /* End of file Evento.php */
    