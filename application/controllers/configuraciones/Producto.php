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
        $sql = "insert into VENTAS_CATEGORIA_1(CATEGORIA,ELIMINADO,ORDENADO)values('$nombre_pc','0',(select case when (max(ordenado)+1) is null then 1 else (max(ordenado)+1) end from VENTAS_CATEGORIA_1));";
        $res = $this->main->executeQuery($sql);
        echo json_encode($res);
     }

     public function modificar_primera_categoria(){
      $nombre_pc = $this->input->post('nombre_pc');
      $id_categoria = $this->input->post('id_categoria');
      $res = null;
      $sql = "update VENTAS_CATEGORIA_1 set CATEGORIA = '$nombre_pc' where ID_CATEGORIA = '$id_categoria';";
      $res = $this->main->executeQuery($sql);
      echo json_encode($res);
    }

    public function eliminar_primera_categoria(){
      $id_categoria = $this->input->post('id_categoria');
      $res = null;
      $sql = "update VENTAS_CATEGORIA_1 set ELIMINADO = '1' where ID_CATEGORIA = '$id_categoria';";
      $res = $this->main->executeQuery($sql);
      echo json_encode($res);
    }

    public function eliminar_segunda_categoria(){
      $id_categoria = $this->input->post('id_categoria');
      $res = null;
      $sql = "update VENTAS_CATEGORIA_2 set ELIMINADO = '1' where ID_CATEGORIA_2 = '$id_categoria';";
      $res = $this->main->executeQuery($sql);
      echo json_encode($res);
    }

    public function eliminar_producto_madre(){
      $id_producto = $this->input->post('id_producto');
      $res = null;
      $sql = "update VENTAS_PRODUCTO_MADRE set ELIMINADO = '1' where ID_PRODUCTO_MADRE = '$id_producto';";
      $res = $this->main->executeQuery($sql);
      echo json_encode($res);
    }

     public function guardar_segunda_categoria(){
        $id_categoria_1 = $this->input->post('categoria_1'); 
        $nombre_sc = $this->input->post('nombre_sc');
        $res = null;
        $sql = "insert into VENTAS_CATEGORIA_2(ID_CATEGORIA, CATEGORIA_2, ELIMINADO, ORDENADO)values('$id_categoria_1','$nombre_sc','0',(select case when (max(ORDENADO)+1) is null then 1 else (max(ORDENADO)+1) end from VENTAS_CATEGORIA_2 where ID_CATEGORIA='$id_categoria_1'));";
        $res = $this->main->executeQuery($sql);
        echo json_encode($res);
     }

     public function modificar_segunda_categoria(){
      $nombre = $this->input->post('nombre');
      $id_categoria = $this->input->post('id_categoria_2');
      $res = null;
      $sql = "update VENTAS_CATEGORIA_2 set CATEGORIA_2 = '$nombre' where ID_CATEGORIA_2 = '$id_categoria';";
      $res = $this->main->executeQuery($sql);
      echo json_encode($res);
    }

     public function guardar_nuevo_producto(){
        $datos = $this->input->post('datos'); 
        $res = json_decode($datos);
        $nombre_producto = $res->nombre_producto;
        $id_categoria_2 = $res->categoria_2;
        $detalle_producto = $res->detalle_producto;
        $actividad_economica = $res->actividad_economica;
        $producto_sin = $res->producto_sin;
        $unidad_medida = $res->unidad_medida;
        $tieneTransporte = $res->tieneTransporte;
        $precioTransporte = $res->precioTransporte;
        $imagen = $res->imagen;
        $productos_unicos = $res->productos_unicos;
        if(!$tieneTransporte){
         $precioTransporte = '0';
        }else{
         if($precioTransporte==''){
            $precioTransporte='0';
         }
        }
        $id_producto_madre = (intval( getMaxProductoMadre()) +1);
        $imagen = $id_producto_madre.".png";
        $savePM = guardarProductoMadre($nombre_producto, $id_categoria_2, $detalle_producto, $actividad_economica, $producto_sin, $unidad_medida, $tieneTransporte, $precioTransporte, $imagen);
        foreach ($productos_unicos as $key => $value) {
         $id_tam = $value->id_tam;
         $cantidad_frutas = $value->cantidad_frutas;
         $precios = $value->precios;
         $savePU = guardarProductoUnico($id_producto_madre, $id_tam);
         $id_producto_unico = getMaxProductoUnico();
            foreach ($precios as $key => $value) {
               $id_lp = $value->id_lp;
               $precio = $value->precio;
               $savePPU = guardarPrecioProductoUnico($id_lp, $id_producto_unico, $precio);
            }
         if($cantidad_frutas>0){
            $saveVPV = guardarVentasProcedimientoVenta($id_producto_unico, $cantidad_frutas);
         }
        }
        
        if (is_array($_FILES) && count($_FILES) > 0) {
         if (($_FILES["imagen"]["type"] == "image/png")) {

             if (move_uploaded_file($_FILES["imagen"]["tmp_name"], "./assets/dist/img/productos/".$id_producto_madre.".png")) {
                 //echo "images/".$_FILES['imagen']['name'];
                 //echo 'si guardo la imagen';
             } else {
                 //echo 'No se guardo la imagen';
             }
         }else{
             //echo 'No es imagen';
         }
        }else{
               //echo 'No existe imagen';
         }
        echo json_encode($datos);
     }

     public function guardar_editar_producto(){
        $datos = $this->input->post('datos'); 
        $res = json_decode($datos);
        $id_producto_madre = $res->id_producto_madre;
        $nombre_producto = $res->nombre_producto;
        $id_categoria_2 = $res->categoria_2;
        $detalle_producto = $res->detalle_producto;
        $actividad_economica = $res->actividad_economica;
        $producto_sin = $res->producto_sin;
        $unidad_medida = $res->unidad_medida;
        $tieneTransporte = $res->tieneTransporte;
        $precioTransporte = $res->precioTransporte;
        $imagen = $res->imagen;
        $productos_unicos = $res->productos_unicos;
        $productos_unicos_original = $res->productos_unicos_original;
        $productos_unicos_tabla = $res->productos_unicos_tabla;
        if(!$tieneTransporte){
         $precioTransporte = '0';
        }else{
         if($precioTransporte==''){
            $precioTransporte='0';
         }
        }
        $imagen = $id_producto_madre.".png";
        $savePM = actualizarProductoMadre($id_producto_madre, $nombre_producto, $id_categoria_2, $detalle_producto, $actividad_economica, $producto_sin, $unidad_medida, $tieneTransporte, $precioTransporte, $imagen);
        
        foreach ($productos_unicos as $key => $value) {
         $id_tam = $value->id_tam;
         $cantidad_frutas = intval($value->cantidad_frutas) ;
         $cantidad_frutas_original = intval($value->cantidad_frutas_original);
         $precios = $value->precios;
         $id_producto_unico = $value->id_producto_unico;
         if (in_array($id_producto_unico, $productos_unicos_original)){
            $saveActualizarPPU = actualizarListaPrecioProductoUnico($id_producto_unico, $precios);
            if($cantidad_frutas >= 0){
               if($cantidad_frutas > $cantidad_frutas_original){
                  //agregar frutas
                  for ($i=$cantidad_frutas_original+1; $i <= $cantidad_frutas ; $i++) { 
                     switch ($i) {
                        case '1':
                           guardarVentaProcedimientoVenta($id_producto_unico, 'Primera fruta','1');
                           $id_proc = getMaxVentasProcedimientoVentas();
				               guardarVentasProcedimientoOpciones($id_proc);
                           break;
                        case '2':
                           guardarVentaProcedimientoVenta($id_producto_unico, 'Segunda fruta','2');
                           $id_proc = getMaxVentasProcedimientoVentas();
				               guardarVentasProcedimientoOpciones($id_proc);
                           break;
                        case '3':
                           guardarVentaProcedimientoVenta($id_producto_unico, 'Tercera fruta','3');
                           $id_proc = getMaxVentasProcedimientoVentas();
				               guardarVentasProcedimientoOpciones($id_proc);
                           break;
                        case '4':
                           guardarVentaProcedimientoVenta($id_producto_unico, 'Cuarta fruta','4');
                           $id_proc = getMaxVentasProcedimientoVentas();
				               guardarVentasProcedimientoOpciones($id_proc);
                           break;
                        default:
                           break;
                     }
                  }
               }
               if($cantidad_frutas < $cantidad_frutas_original){
                  //eliminar frutas
                  for ($i=$cantidad_frutas+1; $i <= $cantidad_frutas_original; $i++) { 
                     switch ($i) {
                        case '1':
                           $id_procedimiento_venta = getIdVentaProcedimientoVenta($id_producto_unico, 'Primera fruta');
                           eliminarVentaProcedimientoOpciones($id_procedimiento_venta);
                           eliminarVentaProcedimientoVenta($id_procedimiento_venta);
                           break;
                        case '2':
                           $id_procedimiento_venta = getIdVentaProcedimientoVenta($id_producto_unico, 'Segunda fruta');
                           eliminarVentaProcedimientoOpciones($id_procedimiento_venta);
                           eliminarVentaProcedimientoVenta($id_procedimiento_venta);
                           break;
                        case '3':
                           $id_procedimiento_venta = getIdVentaProcedimientoVenta($id_producto_unico, 'Tercera fruta');
                           eliminarVentaProcedimientoOpciones($id_procedimiento_venta);
                           eliminarVentaProcedimientoVenta($id_procedimiento_venta);
                           break;
                        case '4':
                           $id_procedimiento_venta = getIdVentaProcedimientoVenta($id_producto_unico, 'Cuarta fruta');
                           eliminarVentaProcedimientoOpciones($id_procedimiento_venta);
                           eliminarVentaProcedimientoVenta($id_procedimiento_venta);
                           break;
                        default:
                           break;
                     }
                  }
               }
            }
         }else{
            $savePU = guardarProductoUnico($id_producto_madre, $id_tam);
            $id_producto_unico = getMaxProductoUnico();
               foreach ($precios as $key => $value) {
                  $id_lp = $value->id_lp;
                  $precio = $value->precio;
                  $savePPU = guardarPrecioProductoUnico($id_lp, $id_producto_unico, $precio);
               }
            if($cantidad_frutas>0){
               $saveVPV = guardarVentasProcedimientoVenta($id_producto_unico, $cantidad_frutas);
            }
         }
        }
        //limpieza de no existentes
        foreach ($productos_unicos_original as $key => $value) {
         if (! in_array($value, $productos_unicos_tabla)){
            $savePPU = eliminarProductoUnico($value);
         }
        }

        if (is_array($_FILES) && count($_FILES) > 0) {
         if (($_FILES["imagen"]["type"] == "image/png")) {

             if (move_uploaded_file($_FILES["imagen"]["tmp_name"], "./assets/dist/img/productos/".$id_producto_madre.".png")) {
                 //echo "images/".$_FILES['imagen']['name'];
                 //echo 'si guardo la imagen';
             } else {
                 //echo 'No se guardo la imagen';
             }
         }else{
             //echo 'No es imagen';
         }
        }else{
               //echo 'No existe imagen';
         }
        echo json_encode($datos);
     }


     public function getCategoria2(){

         $id = $this->input->post('id');
         $response = getSegundaCategoria($id);

         echo json_encode($response);
     }

      public function getProductoMadre(){

         $id = $this->input->post('id');

         $sqlProductoMadre = "SELECT productos FROM CATEGORIA_2 WHERE ID_CATEGORIA_2 = ?";
         $response = $this->db->query($sqlProductoMadre, [$id])->result();

         echo $response[0]->productos;
      }

      public function getProductoUnico(){

         $id = $this->input->post('id');

         $sqlProductoUnico = "SELECT  ID_PRODUCTO_UNICO, ORDENADO, TAMAÑO FROM VENTAS_PRODUCTO_UNICO vpu, VENTAS_TAMAÑO vt  WHERE vpu.ID_TAMAÑO = vt.ID_TAMAÑO AND  vpu.ID_PRODUCTO_MADRE = ? order by ORDENADO asc ";
         $response = $this->db->query($sqlProductoUnico, [$id])->result();

         echo json_encode($response);
     }


     public function getTableReceta() {

         $sqlSubCategoria = "SELECT  CONCAT_WS('-',ID_SUB_CATEGORIA_2,CAST(CANTIDAD_ADECUACION_PEDIDOS AS INT)) AS ID, SUB_CATEGORIA_2 FROM INVENTARIOS_SUB_CATEGORIA_2 isc2 WHERE isc2.ESTADO2 = 1 ORDER BY SUB_CATEGORIA_2 ASC";
      
         $data['elementos'] = $this->db->query($sqlSubCategoria)->result();

         $this->load->view('configuraciones/productos/receta', $data, FALSE);
     }


     public function saveReceta() {


      $receta = $this->input->post();

      $response['status'] = false; 


      foreach ($receta as $key => $r) {

         $idUnico = (isset($r['idUnico'])) ? $r['idUnico'] : NULL;
         $id = (isset($r['id'])) ? $r['id'] : NULL;
         $adecua = (isset($r['adecuacion'])) ? $r['adecuacion'] : NULL;
         $fruta = (isset($r['fruta'])) ? $r['fruta'] : 0;
         $llevar = (isset($r['llevar'])) ? $r['llevar'] : 0;
         $mesa = (isset($r['mesa'])) ? $r['mesa'] : 0;
         $manda = (isset($r['manda'])) ? $r['manda'] : 0;
         $perece = (isset($r['perece'])) ? $r['perece'] : 0;

         
         $sqlReceta = "EXECUTE  SET_ITEM_RECETA ?, ?, ?, ?, ?, ?, ?, ?";
         $result = $this->db->query($sqlReceta, [$idUnico, $id, $adecua, $fruta, $llevar, $mesa, $manda, $perece])->result();  
      }


      echo json_encode($response);

     }
     
   }