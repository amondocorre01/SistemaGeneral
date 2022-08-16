<?php 
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cliente extends CI_Controller {
    
        public function index()
        {
            
        }

        public function register() {
            
            if(!$this->input->post())
            {
                $data['departamentos'] = ['CB'=>'Cochabamba', 'SC'=>'Santa Cruz', 'LP'=>'La Paz', 'OR'=>'Oruro', 'CH'=>'Chuquisaca', 'BN'=>'Beni', 'PT'=>'Potosi', 'TJ'=>'Tarija', 'PA'=>'Pando'];

                $this->load->view('client/register', $data, FALSE);
            }

            else 
            {
                $this->form_validation->set_rules('nombre', 'Nombre Completo', 'trim|required|min_length[2]|max_length[100]');
                $this->form_validation->set_rules('dni', lang('dni'), 'trim|required|min_length[4]|max_length[15]');

                $this->form_validation->set_rules('complemento', 'complemento', 'trim|exact_length[2]');
                $this->form_validation->set_rules('expedido', lang('expedido'), 'trim|required');
                $this->form_validation->set_rules('direccion', 'Direccion', 'trim|max_length[150]');
                $this->form_validation->set_rules('celular', 'Celular', 'trim|exact_length[8]|is_natural');
                $this->form_validation->set_rules('fijo', 'Telefono fijo', 'trim|exact_length[7]|is_natural');

                $this->form_validation->set_rules('nombre_factura', 'Nombre facturacion', 'trim|required|min_length[3]|max_length[80]');
                $this->form_validation->set_rules('email', 'Correo electronico', 'trim|min_length[4]|max_length[80]|valid_email');
                $this->form_validation->set_rules('lat', 'Ubicacion', 'trim|required');
                $this->form_validation->set_rules('lng', 'Ubicacion', 'trim|required');

                $validate = $this->form_validation->run();

                if($validate) {

                   $registro['NOMBRE_COMPLETO'] = set_value('nombre');
                   $registro['CI'] = set_value('dni');
                   $registro['COMPLEMENTO'] = set_value('complemento');
                   $registro['NIT'] = set_value('nit');
                   $registro['EXT'] = set_value('expedido');
                   $registro['DIRECCION'] = set_value('direccion');
                   $registro['CELULAR'] = set_value('celular');
                   $registro['TELEFONO_FIJO'] = set_value('fijo');
                   $registro['NOMBRE_FACTURACION'] = set_value('nombre_factura');
                   $registro['EMAIL'] = set_value('email'); 
                   $registro['LATITUD'] = set_value('lat');
                   $registro['LONGITUD'] = set_value('lng');
                   $registro['CODIGO_CAPRESSO_CLUB'] = set_value('dni').set_value('complemento');
                   $registro['POSICIONAMIENTO_GOOGLE_MAPS'] =  'https://www.google.com.bo/maps?q='.set_value('lat').','.set_value('lng');

                   $this->main->insert('VENTAS_CLIENTES', $registro);

                   $this->session->set_flashdata('success', '1');
                }

                else {
                    $this->session->set_flashdata('error', '1');
                }

                redirect(current_url());
            }
        }

        public function update() {
            
            if(!$this->input->post())
            {
                $data['departamentos'] = ['CB'=>'Cochabamba', 'SC'=>'Santa Cruz', 'LP'=>'La Paz', 'OR'=>'Oruro', 'CH'=>'Chuquisaca', 'BN'=>'Beni', 'PT'=>'Potosi', 'TJ'=>'Tarija', 'PA'=>'Pando'];

                $this->load->view('client/update', $data, FALSE);
            }

            else 
            {
                $this->form_validation->set_rules('nombre', 'Nombre Completo', 'trim|required|min_length[2]|max_length[100]');
                $this->form_validation->set_rules('dni', lang('dni'), 'trim|required|min_length[4]|max_length[15]');

                $this->form_validation->set_rules('complemento', 'complemento', 'trim|exact_length[2]');
                $this->form_validation->set_rules('expedido', lang('expedido'), 'trim|required');
                $this->form_validation->set_rules('direccion', 'Direccion', 'trim|max_length[150]');
                $this->form_validation->set_rules('celular', 'Celular', 'trim|exact_length[8]|is_natural');
                $this->form_validation->set_rules('fijo', 'Telefono fijo', 'trim|exact_length[7]|is_natural');

                $this->form_validation->set_rules('nombre_factura', 'Nombre facturacion', 'trim|required|min_length[3]|max_length[80]');
                $this->form_validation->set_rules('email', 'Correo electronico', 'trim|min_length[4]|max_length[80]|valid_email');
                $this->form_validation->set_rules('lat', 'Ubicacion', 'trim|required');
                $this->form_validation->set_rules('lng', 'Ubicacion', 'trim|required');

                $validate = $this->form_validation->run();

                if($validate) {

                   $update['NOMBRE_COMPLETO'] = set_value('nombre');
                   $update['CI'] = set_value('dni');
                   $update['COMPLEMENTO'] = set_value('complemento');
                   $update['NIT'] = set_value('nit');
                   $update['EXT'] = set_value('expedido');
                   $update['DIRECCION'] = set_value('direccion');
                   $update['CELULAR'] = set_value('celular');
                   $update['TELEFONO_FIJO'] = set_value('fijo');
                   $update['NOMBRE_FACTURACION'] = set_value('nombre_factura');
                   $update['EMAIL'] = set_value('email'); 
                   $update['LATITUD'] = set_value('lat');
                   $update['LONGITUD'] = set_value('lng');
                   $update['CODIGO_CAPRESSO_CLUB'] = set_value('dni').set_value('complemento');
                   $update['POSICIONAMIENTO_GOOGLE_MAPS'] =  'https://www.google.com.bo/maps?q='.set_value('lat').','.set_value('lng');

                   $this->main->update('VENTAS_CLIENTES', $update,  ['ID_CLIENTE'=>set_value('id')]);

                   $this->session->set_flashdata('update', '1');
                   $this->session->set_flashdata('lat', set_value('lat'));
                   $this->session->set_flashdata('lng', set_value('lng'));
                }

                else {
                    $this->session->set_flashdata('error', '1');
                }

                redirect(current_url());
            }
        }


        public function existe() {

            $dni = $this->input->post('id');         

                   $this->db->where('CI', $dni);
            $dni = $this->main->getSelect('VENTAS_CLIENTES', 'CI');

            echo json_encode($dni);
        }
    }
    
    /* End of file Cliente.php */
    
?>