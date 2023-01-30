<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends CI_Controller {

    public function perfil()
    {
        $sucursal = $this->input->post('sucursal');

        $sql = "SELECT ID_LISTA_STOCK, NOMBRE_LISTA FROM INVENTARIOS_LISTA_STOCKS_SUCURSALES WHERE ID_SUCURSAL = ?";
       
        $res = $this->db->query($sql, $sucursal)->result();

        $response = json_

        echo $this->load->view('pedido/perfil', $data, TRUE);
    }

}

/* End of file Pedido.php */
