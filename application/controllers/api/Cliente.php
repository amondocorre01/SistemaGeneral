<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cliente extends CI_Controller {
    
        public function update()
        {
            $id = $this->input->post('id');

            if($id != 1){

                $update['NIT'] = $this->input->post('nit');
                $update['NOMBRE_FACTURACION'] = $this->input->post('facturar_a');
                $update['EMAIL'] = $this->input->post('email');

                $response['status'] = false;

                $this->main->update('VENTAS_CLIENTES', $update, ['ID_CLIENTE'=>$id]);

                if($this->db->affected_rows()) {
                    $response['status'] = true;
                }

                echo json_encode($response);
            }
        }

        public function register()
        {
            $register['NIT'] = $this->input->post('nit');
            $register['NOMBRE_FACTURACION'] = $this->input->post('nombre');

            

            $existe = $this->main->get('VENTAS_CLIENTES', ['NIT'=>$this->input->post('nit')]);
            
            if($existe) {
                $response['status'] = false;
            }

            else {
                $this->main->insert('VENTAS_CLIENTES', $register);

                if($this->db->affected_rows()) {
                    $response['status'] = true;
                }
            }

            echo json_encode($response);
        }

        public function get(){
            $id = $this->input->post('id');

            $campos = "ID_CLIENTE, NOMBRE_COMPLETO,	CI, COMPLEMENTO, NIT, CELULAR, TELEFONO_FIJO, NOMBRE_FACTURACION, EMAIL, CODIGO_CAPRESSO_CLUB, LATITUD, LONGITUD, EXT, DIRECCION";

            $clientes = $this->main->getSelect('VENTAS_CLIENTES', $campos, ['ID_CLIENTE'=>$id]);

            echo json_encode($clientes);
        }

        public function search(){

         $fields = "ID_CLIENTE AS id, CONCAT_WS(' - ', NIT, NOMBRE_FACTURACION) as text";
          $q = $this->input->get('q');
          
                      $this->db->like('NOMBRE_COMPLETO', $q);
                      $this->db->or_like('CI', $q);
                      $this->db->or_like('NIT', $q);
                      $this->db->or_like('CELULAR', $q);
                      $this->db->or_like('TELEFONO_FIJO', $q);
                      $this->db->or_like('NOMBRE_FACTURACION', $q);
                      $this->db->or_like('EMAIL', $q);
                      $this->db->or_like('CODIGO_CAPRESSO_CLUB', $q);
          $clientes = $this->main->getListSelect('VENTAS_CLIENTES', $fields, ['text'=>'ASC']);

          echo json_encode(['results'=>$clientes]);

        }


        public function listClientes(){

            $fields = "ID_CLIENTE AS id, CONCAT_WS(' - ', NIT, NOMBRE_FACTURACION) as text";
            $clientes = $this->main->getListSelect('VENTAS_CLIENTES', $fields, ['text'=>'ASC']);

            echo json_encode(['results'=>$clientes]);
        }
    
    }
    
    /* End of file Cliente.php */
    