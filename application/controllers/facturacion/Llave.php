<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Llave extends CI_Controller {
    
        public function index()
        {
            $campos = "ROW_NUMBER() OVER(ORDER BY ESTADO DESC) AS row, ID_VENTAS_LLAVE, CONCAT(SUBSTRING(CAST(TOKEN_API AS VARCHAR(MAX)), 1, 60), '...') AS TOKEN_API, ESTADO, FECHA_ACTIVACION, FECHA_VENCIMIENTO";
            $llaves = $this->main->getListSelect('VENTAS_F00_LLAVE', $campos);

            echo json_encode(['data'=>$llaves]);
        }

        public function create() {

            $response['status'] = false;
            
            $registro['TOKEN_API'] = $this->input->post('llave');
            $registro['FECHA_ACTIVACION'] = $this->input->post('activacion');
            $registro['FECHA_VENCIMIENTO'] = $this->input->post('vencimiento');
            $registro['APIKEY'] = $this->input->post('apikey');
            $registro['ESTADO'] = 0;

            $this->main->insert('VENTAS_F00_LLAVE', $registro);

            if($this->db->affected_rows()) {
                $response['status'] = true;
            }

        }

        public function get() {
            $id =$this->input->post('id');

            $llave = $this->main->getSelect('VENTAS_F00_LLAVE', 'TOKEN_API', ['ID_VENTAS_LLAVE'=>$id]);
            echo json_encode(['response'=>$llave]);
        }

        public function activate() {

            $id = $this->input->post('id');

            $response['message'] = '';
            $response['status'] = false;
            $response['icon'] = 'error';


            $cant = $this->main->getSelect('VENTAS_F00_LLAVE', 'ID_VENTAS_LLAVE', ['ESTADO'=>1]);

            if($cant) {
                $response['message'] = 'Solo una llave puede estar activa, primero desactive las otras llaves';
            }
            else {
                $this->main->update('VENTAS_F00_LLAVE', ['ESTADO'=>1], ['ID_VENTAS_LLAVE'=>$id]);

                if($this->db->affected_rows()) {
                    $response['status'] = true;
                    $response['message'] = 'Se ha activado la llave';
                    $response['icon'] = 'success';
                }
            }

            echo json_encode($response);
        }


        public function desactivate() {

            $id = $this->input->post('id');

            $response['message'] = '';
            $response['status'] = false;
            $response['icon'] = 'error';


            $this->main->update('VENTAS_F00_LLAVE', ['ESTADO'=>0], ['ID_VENTAS_LLAVE'=>$id]);

            if($this->db->affected_rows()) {
                $response['status'] = true;
                $response['message'] = 'Se ha desactivado la llave';
                $response['icon'] = 'success';
            }
        

            echo json_encode($response);
        }
    
    }
    
    /* End of file Llave.php */
    