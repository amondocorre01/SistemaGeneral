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

        $db = $this->input->post('db');
        $sufijo = $this->input->post('sufijo');

        $DB2 = $this->load->database($db, TRUE);
        $sql = "SELECT ID_SUBCATEGORIA_2, CANTIDAD, ESTADO_CONTEO FROM INVENTARIOS_DECLARACION_".$sufijo." WHERE FECHA_CONTEO ='".date('Y-m-d')."'";
        $registro = $DB2->query($sql)->result();

        $array1 = [];

        foreach ($registro as $value) {
            $array1[$value->ID_SUBCATEGORIA_2] = $value->CANTIDAD;
        }

        $array2 = $this->input->post();

        foreach ($array2 as $key => $value) {

            if($key != 'db' AND $key != 'sufijo') {
            
                if($value != $array1[$key]) {

                $sql2 = "EXECUTE ".$sufijo."_SET_ITEM_DECLARACION ".$value.",'".date('Y-m-d')."','".date('H:i:s')."',".$this->session->id_usuario.",".$key;   
                
                $DB2->query($sql2)->result();

                $response['status'] = true;
                }
            }
        }

        echo json_encode($response);
    } 


    public function enviar_declaracion() {

        $response['status'] = false;

        $db = $this->input->post('db');
        $sufijo = $this->input->post('sufijo');

        $DB2 = $this->load->database($db, TRUE);

        $sql = "UPDATE INVENTARIOS_DECLARACION_".$sufijo." SET ESTADO_CONTEO = 10 WHERE FECHA_CONTEO ='".date('Y-m-d')."'";
        $DB2->query($sql);

        $sql2 = "UPDATE CABECERA_PEDIDO_".$sufijo." SET ESTADO = 10 WHERE FECHA ='".date('Y-m-d')."'";
        $DB2->query($sql2);

        $response['status'] = true;

        echo json_encode($response);
    }

    public function minimo_stock() {

        $id = $this->input->post('lista');

        $minimos = $this->main->getListSelect('INVENTARIOS_STOCKS_MINIMOS_SUCURSALES', 'ID_SUB_CATEGORIA_2, STOCK', NULL, ['ID_LISTA_STOCK'=>$id]);
  
        
        echo json_encode(['minimos'=>$minimos]);
    }


    public function guardar_solicitud() {

        $response['status'] = false;
        $db = $this->input->post('db');
        $sufijo = $this->input->post('sufijo');

        $DB2 = $this->load->database($db, TRUE);
        $sql = "SELECT ID_SUBCATEGORIA_2, CANTIDAD_SOLICITADA, ESTADO_SOLICITUD FROM INVENTARIOS_DECLARACION_".$sufijo." WHERE FECHA_CONTEO ='".date('Y-m-d')."'";
        $registro = $DB2->query($sql)->result();

        $array1 = [];

        foreach ($registro as $value) {
            $array1[$value->ID_SUBCATEGORIA_2] = $value->CANTIDAD_SOLICITADA;
        }

        $array2 = $this->input->post();

        foreach ($array2 as $key => $value) {
            
            if($key != 'db' AND $key != 'sufijo') {

                if($value != $array1[$key]) {

                    $sql2 = "EXECUTE AE_SET_ITEM_SOLICITUD ".$value.",'".$this->session->fecha_conteo."','".date('Y-m-d')."','".date('H:i:s')."',".$this->session->id_usuario.",".$key;   
                    
                    $DB2->query($sql2)->result();
     
                    $response['status'] = true;
                 }

            }

            
        }

        echo json_encode($response);
    } 


    public function enviar_solicitud() {

        $response['status'] = false;

        $db = $this->input->post('db');
        $sufijo = $this->input->post('sufijo');
        $fecha = $this->input->post('fecha');

        $DB2 = $this->load->database($db, TRUE);

        $sql = "UPDATE INVENTARIOS_DECLARACION_".$sufijo." SET ESTADO_CONTEO = 11 WHERE FECHA_CONTEO ='".$fecha."'";
        $DB2->query($sql);

        $sql2 = "UPDATE CABECERA_PEDIDO_".$sufijo." SET ESTADO = 11 WHERE FECHA ='".date('Y-m-d')."'";
        $DB2->query($sql2);

        
            $response['status'] = true;

        echo json_encode($response);
    }


    public function guardar_preparacion() {

        $response['status'] = false;
        $db = $this->input->post('db');
        $sufijo = $this->input->post('sufijo');
        $fecha = $this->input->post('fecha');

        $DB2 = $this->load->database($db, TRUE);
        $sql = "SELECT ID_SUBCATEGORIA_2, CANTIDAD_SOLICITADA, ESTADO_SOLICITUD, CANTIDAD_ENVIADA, OBSERVACION, TURNO FROM INVENTARIOS_DECLARACION_".$sufijo." WHERE FECHA_CONTEO ='".$fecha."'";
        $registro = $DB2->query($sql)->result();


        $array1 = []; $observacion = []; $envio = [];

        foreach ($registro as $value) {
            $array1[$value->ID_SUBCATEGORIA_2] = ($value->CANTIDAD_ENVIADA)?$value->CANTIDAD_ENVIADA:'0';
            $observacion[$value->ID_SUBCATEGORIA_2] = ($value->OBSERVACION)?$value->OBSERVACION:'NINGUNA';
            $envio[$value->ID_SUBCATEGORIA_2] = $value->TURNO;

        }

        $array2 = $this->input->post();
        $cont = 0;

        foreach ($array2 as $key => $value2) {

            
            
            if($key != 'db' AND $key != 'sufijo' AND $key != 'fecha') {

                if($value2['id'] != $array1[$key] OR $value2['observacion'] != $observacion[$key] OR $value2['turno'] != $envio[$key]) { 

                    $value2['observacion'] = ($value2['observacion']) ? $value2['observacion'] : 'NINGUNA';

                    if($value2['id'] > 0) {

                        $sql2 = "EXECUTE ".$sufijo."_SET_ITEM_PREPARACION ".$value2['id'].",'".$fecha."','".$value2['observacion']."',".$key.",'".$value2['turno']."'";   
                    
                        $DB2->query($sql2)->result();

                    }

                    $response['status'] = true;
                }
                
            }

            
        }

        echo json_encode($response);
    } 


    public function enviar_preparacion() {

        $response['status'] = false;

        $db = $this->input->post('db');
        $sufijo = $this->input->post('sufijo');

        $DB2 = $this->load->database($db, TRUE);

        $sql_date = "select CONVERT (date, GETDATE()) AS DIA";   // QUITAR UN DIA
	    $fecha = $DB2->query($sql_date)->result();
        

        $sql = "UPDATE INVENTARIOS_DECLARACION_".$sufijo." SET ESTADO_CONTEO = 12 WHERE FECHA_CONTEO ='".$fecha[0]->DIA."'";

        $registro = $DB2->query($sql);

        
            $response['status'] = true;

        echo json_encode($response);
    }



}


/* End of file Pedido.php */
