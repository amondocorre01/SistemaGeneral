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
                WHERE vpp.ID_VENTAS_PERMISO_PERFIL = '.$id.' AND 
                vpp.ID_VENTAS_ACCESO = va.ID_VENTAS_ACCESO
            ) AS ACCEDE');

            echo $this->load->view('perfil/body/permisos', $data, TRUE);
            
        }

    }

/* End of file Perfiles.php */
?>