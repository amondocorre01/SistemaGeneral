<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidoextraordinario extends CI_Controller {

    public function guardar_pedido_extraordinario()
    {   
        
        $codigo_sucursal = $this->input->post('codigo_sucursal');
        $sucursal = getSucursal($codigo_sucursal);
        $sufijo_sucursal = $sucursal->SUFIJO;
        $codigo_sucursal='ventas';
        $sufijo_sucursal='_AE';

        $categoria_1 = $this->input->post('categoria_1');
        $categoria_2 = $this->input->post('categoria_2');
        $producto_madre = $this->input->post('producto_madre');
        $detalle_producto = $this->input->post('detalle_producto');
        $modificara_producto = $this->input->post('modificara_producto');
        $fecha_pedido = $this->input->post('fecha_pedido');
        $id_usuario = $this->session->id_usuario;
        $fecha_registro = date('Y-m-d');
        if(guardarPedidoExtraordinario($codigo_sucursal, $sufijo_sucursal, $categoria_1, $categoria_2, $producto_madre, $modificara_producto, $detalle_producto, $id_usuario, $fecha_registro, $fecha_pedido)){
            echo json_encode('ok');
        }else{
            echo json_encode('error');
        }
    }


}


/* End of file Pedido.php */
