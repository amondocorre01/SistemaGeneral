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

}

/* End of file Pedido.php */
