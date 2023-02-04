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

    public function producto() 
    {
        $subcategoria = $this->input->post('subcategoria');

        $productos = $this->main->getListSelect('INVENTARIOS_SUB_CATEGORIA_2', 'ID_SUB_CATEGORIA_2, SUB_CATEGORIA_2, ORDEN', ['ORDEN'=>'ASC'], ['ID_SUB_CATEGORIA_1'=>$subcategoria, 'ESTADO'=>1] );

        echo json_encode($productos);
    }

    public function producto_perfil()
    {
        $response['status'] = false;
        
        $registro['ID_SUB_CATEGORIA_2'] = $this->input->post('producto');
        $registro['STOCK'] = $this->input->post('cantidad');
        $registro['ID_LISTA_STOCK'] = $this->input->post('lista');

        $this->main->insert('INVENTARIOS_STOCKS_MINIMOS_SUCURSALES', $registro);

        if($this->db->affected_rows()) {
            $response['status'] = true;
        }

        echo json_encode($response);
    }


    public function guardar_declaracion() {

        $response['status'] = false;

        $DB2 = $this->load->database('ventas', TRUE);
        $sql = "SELECT ID_SUBCATEGORIA_2, CANTIDAD, ESTADO_CONTEO FROM INVENTARIOS_DECLARACION_AE WHERE FECHA_CONTEO ='".date('Y-m-d')."'";
        $registro = $DB2->query($sql)->result();

        $array1 = [];

        foreach ($registro as $value) {
            $array1[$value->ID_SUBCATEGORIA_2] = $value->CANTIDAD;
        }

        $array2 = $this->input->post();

        foreach ($array2 as $key => $value) {
            
            if($value != $array1[$key]) {

               $sql2 = "EXECUTE AE_SET_ITEM_DECLARACION ".$value.",'".date('Y-m-d')."','".date('H:i:s')."',".$this->session->id_usuario.",".$key;   
               
               $DB2->query($sql2)->result();

               $response['status'] = true;
            }
        }

        echo json_encode($response);
    } 


    public function enviar_declaracion() {

        $response['status'] = false;


        $DB2 = $this->load->database('ventas', TRUE);

        $sql = "UPDATE INVENTARIOS_DECLARACION_AE SET ESTADO_CONTEO = 1 WHERE FECHA_CONTEO ='".date('Y-m-d')."'";
        $registro = $DB2->query($sql);

        echo json_encode($response);
    }



}


/* End of file Pedido.php */
