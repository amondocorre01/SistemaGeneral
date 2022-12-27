<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Perfiles extends CI_Controller {

        public function index()
        {
            $campos = "ROW_NUMBER() OVER(ORDER BY ID_VENTAS_PERFIL ASC) AS row, ID_VENTAS_PERFIL, PERFIL, ESTADO";
            $perfiles = $this->main->getListSelect('VENTAS_PERFIL', $campos);

            echo json_encode(['data'=>$perfiles]);
        }

        public function aprobar() {
            $response['status'] = false;

            $id = $this->input->post('id');
            $nombre = $this->input->post('nombre');
            $estado = $this->input->post('estado');

            $this->main->update('VENTAS_PERFIL', ['PERFIL'=>$nombre, 'ESTADO'=>$estado], ['ID_VENTAS_PERFIL'=>$id]);

            if($this->db->affected_rows()) {
                $response['status'] = true;
            }
           
            echo json_encode($response);
        }

        public function create() {

            $response['status'] = false;

            $registrar['PERFIL'] = $this->input->post('nombre');
            $registrar['ESTADO'] = 1;

            $this->main->insert('VENTAS_PERFIL', $registrar);

            if($this->db->affected_rows()) {
                $response['status'] = true;
            }
           
            echo json_encode($response);

        }

        public function menu() {

            $id = $this->input->post('id');
           
                            $this->db->where('NIVEL_SUPERIOR', 0);
            $data['menu'] = $this->main->getListSelect('VENTAS_ACCESO va', 'ID_VENTAS_ACCESO, NOMBRE, NIVEL_SUPERIOR,NUMERO_ORDEN, ( 
                SELECT ID_VENTAS_ACCESO 
                FROM VENTAS_PERMISO_PERFIL vpp 
                WHERE vpp.ID_VENTAS_PERFIL = '.$id.' AND 
                vpp.ID_VENTAS_ACCESO = va.ID_VENTAS_ACCESO
            ) AS ACCEDE');

            $data['id'] = $id;

            echo $this->load->view('perfiles/body/permisos', $data, TRUE);
        }

        public function save() {
            $perfil = $this->input->post('perfil');
            $menu = $this->input->post('menu');
            $escogidos = $this->input->post('escogidos');

            if($perfil):
                $this->db->where('ID_VENTAS_PERFIL', $perfil);
                $this->db->delete('VENTAS_PERMISO_PERFIL');
            endif;

            $permisos = [];

            foreach ($escogidos as $e) {
                $temp = [];
                $temp['ID_VENTAS_PERFIL'] = $perfil;
                $temp['ID_VENTAS_ACCESO'] = $e;

                array_push($permisos, $temp);
            }

            $this->db->insert_batch('VENTAS_PERMISO_PERFIL', $permisos);

            if($this->db->affected_rows()) {
                $response = true;
            }
            else {
                $response = false;
            }

            if($response):
                $this->session->set_flashdata('success', '1');
            else:
                $this->session->set_flashdata('error', '1');
            endif;
            
            
            redirect('generico/inicio?vc='.$menu,'refresh');
            
        }



        public function acceso() {

            $id = $this->input->post('id');
    
                            $this->db->where('NIVEL_SUPERIOR', 0);
                            $this->db->where('ESTADO', 1);

                            $this->db->order_by('NUMERO_ORDEN', 'ASC');
                            
            $data['menu'] = $this->main->getListSelect('VENTAS_ACCESO va', 'ID_VENTAS_ACCESO, NOMBRE, NIVEL_SUPERIOR,NUMERO_ORDEN, ( 
                SELECT DISTINCT ESTADO 
                FROM VENTAS_PERMISO_PERFIL vpp 
                WHERE vpp.ID_VENTAS_PERFIL = '.$id.' AND 
                vpp.ID_VENTAS_ACCESO = va.ID_VENTAS_ACCESO) AS ACCEDE'); 
            $data['id'] = $id;

            echo $this->load->view('perfiles/body/permisos', $data, TRUE);
        }


        public function update(){

            $id = $this->input->post('id');
            $perfil = $this->input->post('perfil');
            $estado = $this->input->post('estado');


            // Existe?
            
            $accede = $this->main->get('VENTAS_PERMISO_PERFIL', ['ID_VENTAS_ACCESO'=>$id, 'ID_VENTAS_PERFIL'=>$perfil]);

            if(!$accede) {
                $this->main->insert('VENTAS_PERMISO_PERFIL', ['ID_VENTAS_PERFIL'=>$perfil, 'ID_VENTAS_ACCESO'=>$id,	'ESTADO'=>$estado]);
            }

            else {
                $this->main->update('VENTAS_PERMISO_PERFIL', ['ESTADO'=>$estado], ['ID_VENTAS_PERMISO_PERFIL'=>$accede->ID_VENTAS_PERMISO_PERFIL]);
            }

        }

    }

/* End of file Perfiles.php */
?>