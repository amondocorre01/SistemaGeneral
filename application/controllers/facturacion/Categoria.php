<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Categoria extends CI_Controller {
    
        public function index()
        {
            $campos = "ROW_NUMBER() OVER(ORDER BY m.PRODUCTO_MADRE DESC) AS row
            ,PRODUCTO_MADRE
            ,CATEGORIA_2
            ,CATEGORIA
            ,PRECIO
            ,NOMBRE_LISTA_PRECIOS
            ";

                      $this->db->join('VENTAS_PRODUCTO_UNICO u', 'u.ID_PRODUCTO_MADRE = m.ID_PRODUCTO_MADRE', 'left');
                      $this->db->join('VENTAS_CATEGORIA_2 c2', 'c2.ID_CATEGORIA_2 = m.ID_CATEGORIA_2', 'left');
                      $this->db->join('VENTAS_CATEGORIA_1 c1', 'c1.ID_CATEGORIA = c2.ID_CATEGORIA', 'left');
                      $this->db->join('VENTAS_PRECIO_PRODUCTO_UNICO p', 'p.ID_PRODUCTO_UNICO = u.ID_PRODUCTO_UNICO', 'left');
                      $this->db->join('VENTAS_NOMBRE_LISTA_PRECIOS n', 'n.ID_NOMBRE_LISTA_PRECIOS = p.ID_NOMBRE_LISTA_PRECIOS', 'left');

            $llaves = $this->main->getListSelect('VENTAS_PRODUCTO_MADRE m', $campos);

            echo json_encode(['data'=>$llaves]);
        }

        public function subcategoria() {

            $id = $this->input->post('id');


            $campos = "ID_CATEGORIA_2 AS id, CATEGORIA_2 AS text";

                            $this->db->where('ID_CATEGORIA', $id);
            $subcategorias = $this->main->getListSelect('VENTAS_CATEGORIA_2', $campos);

           echo json_encode(['results'=>$subcategorias]);
        }


        public function register() {

            $subcategoria = $this->input->post('subcategoria');
            $producto = $this->input->post('producto');
            $orden = $this->input->post('orden');
            $codact = $this->input->post('codact');
            $codsin = $this->input->post('codsin');
            $medida = $this->input->post('medida');
            $tamanio = $this->input->post('tamanio');
            $orden2 = $this->input->post('orden2');
            $estado = $this->input->post('estado');
            $lista = $this->input->post('lista');
            $precio = $this->input->post('precio');
            $imagen = $this->input->post('imagen');

            $sql = "EXEC SET_PRODUCTO_NUEVO '".$producto."',".$subcategoria.", null, detalle, 0,".$orden.",".$codact.",".$codsin.",".$medida.",".$tamanio.",".$orden2.",0,".$lista.",".$precio.",".$estado.",0.5, 0.2" ;
		    $res = $this->main->getQuery($sql);
            return $res;

        }
    }
?>