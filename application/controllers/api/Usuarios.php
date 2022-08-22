<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Usuarios extends CI_Controller {
    
        public function index()
        {
            $campos = "se.ID_EMPLEADO, ID_STATUS, CONCAT_WS(' ', NOMBRE, AP_PATERNO, AP_MATERNO) AS NOMBRE, CI, CELULAR, AREA, NOMBRE_CARGO, (SELECT DESCRIPCION FROM ID_UBICACION iu, VENTAS_PERMISO_SUCURSAL vps 
            WHERE iu.ID_UBICACION = vps.ID_UBICACION AND vps.ID_USUARIO = vu.ID_USUARIO FOR JSON AUTO ) AS SUCURSALES";
                        $this->db->join('SIREPE_CARGOS sc', 'sc.ID_CARGO = se.ID_CARGO', 'left');
                        $this->db->join('VENTAS_USUARIOS vu', 'vu.ID_EMPLEADO = se.ID_EMPLEADO', 'left');
            $usuarios = $this->main->getListSelect('SIREPE_EMPLEADO se', $campos);

            echo json_encode(['data'=>$usuarios]);
        }


        public function baja() {
            $id = $this->input->post('id');
            $response['status'] = false;

            $update['ID_MODIFICADOR'] = $this->session->id_usuario;
            $update['FECHA_MODIFICADO'] = date('Y-m-d');
            $update['ID_STATUS'] = 4;

            $this->main->update('SIREPE_EMPLEADO', $update, ['ID_EMPLEADO'=>$id]);

            if($this->db->affected_rows()) {
                $response['status'] = true;
            }

            echo json_encode($response);

        }

        public function alta() {
            $id = $this->input->post('id');
            $response['status'] = false;

            $update['ID_MODIFICADOR'] = $this->session->id_usuario;
            $update['FECHA_MODIFICADO'] = date('Y-m-d');
            $update['ID_STATUS'] = 1;

            $this->main->update('SIREPE_EMPLEADO', $update, ['ID_EMPLEADO'=>$id]);

           
            if($this->db->affected_rows()) {
                $response['status'] = true;
            }
           
            echo json_encode($response);
        }
    
    }
    
    /* End of file Usuarios.php */
    