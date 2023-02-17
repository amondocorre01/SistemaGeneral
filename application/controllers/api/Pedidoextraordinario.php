<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidoextraordinario extends CI_Controller {

    public function guardar_pedido_extraordinario()
    {   
        
        $codigo_sucursal = $this->input->post('codigo_sucursal');
        $sucursal = getSucursal($codigo_sucursal);
        $sufijo_sucursal = $sucursal->SUFIJO;
        $prefijo_sucursal = $sucursal->PREFIJO;
        $descripcion_sucursal = $sucursal->SUCURSAL_BI;
        /* $codigo_sucursal='ventas';
        $sufijo_sucursal='_AE'; */

        $categoria_1 = $this->input->post('categoria_1');
        $categoria_2 = $this->input->post('categoria_2');
        $producto_madre = $this->input->post('producto_madre');
        $detalle_producto = $this->input->post('detalle_producto');
        $modificara_producto = $this->input->post('modificara_producto');
        $fecha_entrega = $this->input->post('fecha_entrega');
        $id_usuario = $this->session->id_usuario;
        $fecha_registro = date('Y-m-d H:i:s');
        $pedido = guardarPedidoExtraordinario($codigo_sucursal, $prefijo_sucursal, $sufijo_sucursal, $categoria_1, $categoria_2, $producto_madre, $modificara_producto, $detalle_producto, $id_usuario, $fecha_registro, $fecha_entrega);
        if($pedido){
            $modificado = $modificara_producto == 1 ?'SI':'NO';
            $fecha_entrega = date("d/m/Y", strtotime(($fecha_entrega)));
                        
            $respuesta = new stdClass();
            $respuesta->iden = $pedido;
            $respuesta->codigo_sucursal = $codigo_sucursal;
            $respuesta->descripcion_sucursal = $descripcion_sucursal;
            $respuesta->sufijo_sucursal = $sufijo_sucursal;
            $respuesta->prefijo_sucursal = $prefijo_sucursal;
            $respuesta->modificado = $modificado;
            $respuesta->fecha_entrega = $fecha_entrega;
            $respuesta->estado = true;
            echo json_encode($respuesta);
            exit();
        }else{
            $respuesta = new stdClass();
            $respuesta->codigo_sucursal = $codigo_sucursal;
            $respuesta->fecha_entrega = $fecha_entrega;
            $respuesta->estado = false;
            echo json_encode($respuesta);
            exit();
        }
    }

    public function primera_subcategoria() {
        $primera_categoria_id = $this->input->post('primera_categoria_id');
        $texto_seleccionado = $this->input->post('texto_seleccionado');
        $productos_segunda_categoria = getPrimeraSubcategoriaInventarios($primera_categoria_id);
        echo '<option value="">Seleccione segunda categoria</option>';
        foreach ($productos_segunda_categoria as $key => $value) {
           if($value->ID_CATEGORIA == ''){
               echo '<option value="'.$value->ID_SUB_CATEGORIA_1.'">'.$texto_seleccionado.'</option>';
           }else{
               echo '<option value="'.$value->ID_SUB_CATEGORIA_1.'">'.$value->SUB_CATEGORIA_1.'</option>';
           }
       }
     }

     public function segunda_subcategoria() {
        $primera_categoria_id = $this->input->post('segunda_categoria_id');
        $texto_seleccionado = $this->input->post('texto_seleccionado');
        $productos_segunda_categoria = getSegundaSubcategoriaInventarios($primera_categoria_id);
        echo '<option value="">Seleccione segunda categoria</option>';
        foreach ($productos_segunda_categoria as $key => $value) {
           if($value->ID_SUB_CATEGORIA_1 == ''){
               echo '<option value="'.$value->ID_SUB_CATEGORIA_2.'">'.$texto_seleccionado.'</option>';
           }else{
               echo '<option value="'.$value->ID_SUB_CATEGORIA_2.'">'.$value->SUB_CATEGORIA_2.'</option>';
           }
       }
     }

     public function eliminar_pedido_extraordinario(){
        $id_pedido_extraordinario = $this->input->post('iden');
        $codigo_sucursal = $this->input->post('codigo_sucursal');
        $sufijo_sucursal = $this->input->post('sufijo_sucursal');
        if(eliminar_pedido_extraordinario($codigo_sucursal, $sufijo_sucursal, $id_pedido_extraordinario)){
            $respuesta = new stdClass();
            $respuesta->sucursal = $codigo_sucursal;
            $respuesta->estado = true;
            echo json_encode($respuesta);
            exit();
        }else{
            $respuesta = new stdClass();
            $respuesta->sucursal = $codigo_sucursal;
            $respuesta->estado = false;
            echo json_encode($respuesta);
            exit();
        }
     }

     public function aprobar_pedido_extraordinario(){
        $id_pedido_extraordinario = $this->input->post('iden');
        $codigo_sucursal = $this->input->post('codigo_sucursal');
        $sufijo_sucursal = $this->input->post('sufijo_sucursal');
        if(aprobar_pedido_extraordinario($codigo_sucursal, $sufijo_sucursal, $id_pedido_extraordinario)){
            $respuesta = new stdClass();
            $respuesta->sucursal = $codigo_sucursal;
            $respuesta->estado = true;
            echo json_encode($respuesta);
            exit();
        }else{
            $respuesta = new stdClass();
            $respuesta->sucursal = $codigo_sucursal;
            $respuesta->estado = false;
            echo json_encode($respuesta);
            exit();
        }
     }


}


/* End of file Pedido.php */
