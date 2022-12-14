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

     public function lista_precios_producto(){
        $id_producto_madre = $this->input->post('id_producto_madre');
        $lista_productos_unicos = getProductosUnicos($id_producto_madre);
        $arrayPrecios = array();
        foreach ($lista_productos_unicos as $key => $value) {
            $id_tam = $value->ID_TAMAÑO;
            $id_producto_unico = $value->ID_PRODUCTO_UNICO;
            $id_producto_madre = $value->ID_PRODUCTO_MADRE;
            $lista_precios= getPreciosProductoUnico($id_producto_madre, $id_tam);
            $cantidad_frutas= getTotalFrutasxProducto($id_producto_unico);
            $objetoProductoUnico = new stdClass();
            $objetoProductoUnico->id_producto_unico = $id_producto_unico;
            $objetoProductoUnico->id_producto_madre = $id_producto_madre;
            $objetoProductoUnico->id_tam = $id_tam;
            $objetoProductoUnico->cantidad_frutas = $cantidad_frutas;
            $objetoProductoUnico->precios_producto_unico = $lista_precios;
            array_push($arrayPrecios, $objetoProductoUnico);
        }
        echo json_encode($arrayPrecios);
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