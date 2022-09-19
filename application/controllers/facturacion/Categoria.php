<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Categoria extends CI_Controller {
    
        public function categoria1()
        {
            $campos = "ROW_NUMBER() OVER(ORDER BY c.ESTADO DESC) AS row
            ,CODIGO_AMBIENTE
            ,CODIGO_SISTEMA
            ,NIT
            ,CODIGO_MODALIDAD
            ,CONCAT_WS('-',u.CODIGO_SUCURSAL,u.DESCRIPCION) AS CODIGO_SUCURSAL
            ,CODIGO_PUNTO_VENTA
            ,CODIGO_CUIS
            ,FECHA_VIGENCIA
            ,CODIGO
            ,c.DESCRIPCION
            ,TRANSACCION
            ,c.ESTADO
            ,ID_VENTAS_F01_CUIS";

                      $this->db->join('ID_UBICACION u', 'u.CODIGO_SUCURSAL = c.CODIGO_SUCURSAL', 'left');
            $llaves = $this->main->getListSelect('VENTAS_F01_CUIS c', $campos);

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

            $sql = "EXEC SET_PRODUCTO_NUEVO '".$producto."',".$subcategoria.", null, detalle, 0,".$orden.",".$codact.",".$codsin.",".$medida.",".$tamanio.",".$orden2.",0,".$lista.",".$precio.",".$estado.",0.5, 0.2" ;
		    $res = $this->main->getQuery($sql);
            return $res;

        }
    }
?>