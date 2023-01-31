<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends CI_Controller {

    public function perfil()
    {
        $sucursal = $this->input->post('sucursal');

        $sql = "EXECUTE INVENTARIO ?";
       
        $data['inventario'] = $this->db->query($sql, $sucursal)->result();

        echo $this->load->view('pedido/perfil', $data, TRUE);
    }


    public function minimo() {

        $response['status'] = false;

        $minimo = $this->input->post('minimo');
        $id = $this->input->post('id');

        $this->main->update('INVENTARIOS_STOCKS_MINIMOS_SUCURSALES', ['STOCK'=>$minimo], ['ID_STOCK'=>$id]);
        
        if($this->db->affected_rows()) {
            $response['status'] = true;
        }

        echo json_encode($response);

    }


    public function nuevo() {

        $sucursal = $this->input->post('sucursal');
        $perfil = $this->input->post('perfil');
        $response['status'] = false;

        $this->main->insert('INVENTARIOS_LISTA_STOCKS_SUCURSALES', ['ID_SUCURSAL'=>$sucursal, 'NOMBRE_LISTA'=>$perfil, 'FECHA_CREACION'=>date('Y-m-d'), 'USUARIO_CREADOR'=>$this->session->id_usuario]);
        
        if($this->db->affected_rows()) {
            $response['status'] = true;
        }

        echo json_encode($response);
    }


    public function subcategoria() 
    {
        $categoria = $this->input->post('categoria');

        $subcategorias = $this->main->getListSelect('INVENTARIOS_SUB_CATEGORIA_1', 'ID_SUB_CATEGORIA_1, SUB_CATEGORIA_1, ORDEN', ['ORDEN'=>'ASC'], ['ID_CATEGORIA'=>$categoria, 'ESTADO'=>1] );

        echo json_encode($subcategorias);
    }

}

/* End of file Pedido.php */
