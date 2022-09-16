<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cuis extends CI_Controller {
    
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
    }
?>