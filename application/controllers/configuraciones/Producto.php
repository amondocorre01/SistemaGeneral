<?php
   
   defined('BASEPATH') OR exit('No direct script access allowed');
   
   class Producto extends CI_Controller {
      
      public function productos_segunda_categoria() {
         $primera_categoria_id = $this->input->post('primera_categoria_id');
         $texto_seleccionado = $this->input->post('texto_seleccionado');
         $productos_segunda_categoria = getSegundaCategoria($primera_categoria_id);
         echo '<option value="">Seleccione segunda categoria</option>';
         foreach ($productos_segunda_categoria as $key => $value) {
            if($value->CATEGORIA_2 == ''){
                echo '<option value="'.$value->ID_CATEGORIA_2.'">'.$texto_seleccionado.'</option>';
            }else{
                echo '<option value="'.$value->ID_CATEGORIA_2.'">'.$value->CATEGORIA_2.'</option>';
            }
        }
      }  

      public function productos_madre() {
        $segunda_categoria_id = $this->input->post('segunda_categoria_id');
        $texto_seleccionado = $this->input->post('texto_seleccionado');
        $productos_madre = getProductosMadre($segunda_categoria_id);
        echo '<option value="">Seleccione el producto</option>';
        foreach ($productos_madre as $key => $value) {
            if($value->PRODUCTO_MADRE == ''){
                echo '<option value="'.$value->ID_PRODUCTO_MADRE.'">'.$texto_seleccionado.'</option>';
            }else{
                echo '<option value="'.$value->ID_PRODUCTO_MADRE.'">'.$value->PRODUCTO_MADRE.'</option>';
            }
        }
     }

     public function producto_madre() {
        $id_producto_madre = $this->input->post('id_producto_madre');
        $producto_madre = getProductoMadre($id_producto_madre);
        echo json_encode($producto_madre);
     }

     public function guardar_primera_categoria(){
        $nombre_pc = $this->input->post('nombre_pc');
        $res = null;
        $sql = "insert into VENTAS_CATEGORIA_1(CATEGORIA)values('$nombre_pc');";
        $res = $this->main->executeQuery($sql);
        echo json_encode($res);
     }

     public function guardar_segunda_categoria(){
        $id_categoria_1 = $this->input->post('categoria_1'); 
        $nombre_sc = $this->input->post('nombre_sc');
        $res = null;
        $sql = "insert into VENTAS_CATEGORIA_2(ID_CATEGORIA, CATEGORIA_2)values('$id_categoria_1','$nombre_sc');";
        $res = $this->main->executeQuery($sql);
        echo json_encode($res);
     }
     
   }