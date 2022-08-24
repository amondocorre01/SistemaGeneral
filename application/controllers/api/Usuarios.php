<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Usuarios extends CI_Controller {
    
        public function index()
        {
            $campos = "se.ID_EMPLEADO, ID_STATUS, CONCAT_WS(' ', NOMBRE, AP_PATERNO, AP_MATERNO) AS NOMBRE, CI, CELULAR, AREA, NOMBRE_CARGO, vu.ID_USUARIO, (SELECT DESCRIPCION FROM ID_UBICACION iu, VENTAS_PERMISO_SUCURSAL vps WHERE iu.ID_UBICACION = vps.ID_UBICACION AND vps.ID_USUARIO = vu.ID_USUARIO AND vps.ESTADO = 1 FOR JSON AUTO ) AS SUCURSALES";
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

        public function ubicacion() {
            $user = intval($this->input->post('user'));
            $sucursal = $this->input->post('sucursal');
            $operacion = $this->input->post('operacion');
            $response['message'] = '';

            switch ($operacion) {
                case '1':
                    //Existe usuario en la ubicacion solicitada
                   $row = $this->main->get('VENTAS_PERMISO_SUCURSAL', ['ID_USUARIO'=>$user, 'ID_UBICACION'=>$sucursal]); 
                   if($row) {
                        switch ($row->ESTADO) {
                            case '1':
                                $response['message'] = 'El usuario ya se encuentra asignado';
                            break;

                            case '0':
                                $this->main->update('VENTAS_PERMISO_SUCURSAL', ['ESTADO'=>1],   ['ID_VENTAS_PERMISO_SUCURSAL'=>$row->ID_VENTAS_PERMISO_SUCURSAL]);
                                
                                $response['message'] = 'Se ha asignado el usuario a la ubicacion solicitada';
                            break;
                        }
                    }
                    else {
                        $this->main->insert('VENTAS_PERMISO_SUCURSAL', ['ID_UBICACION'=>$sucursal, 'ID_USUARIO'=>$user, 'ESTADO'=>'1', 'ID_USUARIO_MODIF'=>$this->session->id_usuario]); 

                        $response['message'] = 'Se ha asignado el usuario a la ubicacion solicitada';
                    }

                break;

                case '2':
                   
                    $this->main->update('VENTAS_PERMISO_SUCURSAL', ['ESTADO'=>0], ['ID_UBICACION'=>$sucursal, 'ID_USUARIO'=>$user]);

                    $response['message'] = 'Se ha retirado el usuario de la ubicacion solicitada';
                break;
            }

            echo json_encode($response);
        }
    
    }
    
    /* End of file Usuarios.php */
    