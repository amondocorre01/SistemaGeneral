<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cuis extends CI_Controller {
    
        public function index()
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
            ,ID_VENTAS_F00_LLAVE";

                      $this->db->join('ID_UBICACION u', 'u.CODIGO_SUCURSAL = c.CODIGO_SUCURSAL', 'left');
            $llaves = $this->main->getListSelect('VENTAS_F01_CUIS c', $campos);

            echo json_encode(['data'=>$llaves]);
        }

        public function activate() {

          $id = $this->input->post('id');

          $response['message'] = '';
          $response['status'] = false;
          $response['icon'] = 'error';


          $cant = $this->main->getSelect('VENTAS_F01_CUIS', 'ID_VENTAS_F01_CUIS', ['ESTADO'=>1, ]);

          if($cant) {
              $response['message'] = 'Solo una llave puede estar activa, primero desactive las otras llaves';
          }
          else {
              $this->main->update('VENTAS_F01_CUIS', ['ESTADO'=>1], ['ID_VENTAS_F01_CUIS'=>$id]);

              if($this->db->affected_rows()) {
                  $response['status'] = true;
                  $response['message'] = 'Se ha activado el codigo CUIS';
                  $response['icon'] = 'success';
              }
          }

          echo json_encode($response);
      }


      public function desactivate() {

          $id = $this->input->post('id');

          $response['message'] = '';
          $response['status'] = false;
          $response['icon'] = 'error';


          $this->main->update('VENTAS_F01_CUIS', ['ESTADO'=>0], ['ID_VENTAS_F01_CUIS'=>$id]);

          if($this->db->affected_rows()) {
              $response['status'] = true;
              $response['message'] = 'Se ha desactivado el codigo CUIS';
              $response['icon'] = 'success';
          }
      

          echo json_encode($response);
      }

        public function create(){
            $codigoAmbiente = $this->input->post('ambiente'); 
            $codigoPuntoVenta = $this->input->post('venta'); 
            $codigoSistema = $this->input->post('sistema');
            $nit = $this->input->post('nit'); 
            $codigoSucursal = $this->input->post('sucursal'); 
            $codigoModalidad = $this->input->post('modalidad');
            $url_wsdl = URL_CODIGOS;
            //$apikey = 'TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJSb25hbGRtZW4wMTgiLCJjb2RpZ29TaXN0ZW1hIjoiNzIyOEM2NDk2Qzc3QzA5RUU3MDBCNkYiLCJuaXQiOiJINHNJQUFBQUFBQUFBRE14dGpReHREQXpNTFFBQUxxbGd4SUtBQUFBIiwiaWQiOjMwMTQ1OTYsImV4cCI6MTY5MjE0NDAwMCwiaWF0IjoxNjYwNjc4NzU0LCJuaXREZWxlZ2FkbyI6NDM5NDE4NjAxOCwic3Vic2lzdGVtYSI6IlNGRSJ9.vHJD3ipob2kLbhpAs51a25TRKnAUaC_q-bzCtQC42iLQpTrHMS-TgJwN_pQePO1022TdUL4fn55IbkxuEIEHtA';
            $resApikey = $this->getApiKey();
            if(count($resApikey)>0){
              $idApikey = $resApikey[0]->ID_VENTAS_LLAVE;
              $valApikey = $resApikey[0]->APIKEY;
              $valTokenApi = $resApikey[0]->TOKEN_API;
              $apikey = $valApikey.' '.$valTokenApi;
            }else{
              echo 'error';
              exit();
            }
            //$codigoAmbiente = '2';
            //$codigoSistema = '7228C6496C77C09EE700B6F';
            //$nit = '4394186018';
            //$codigoModalidad ='1';
            //$codigoSucursal ='0';
            //$codigoPuntoVenta = '1';   // debe contener el valor 0 y 1 para las pruebas

            $cuis = $this->getCuis($url_wsdl, $apikey, $codigoAmbiente, $codigoPuntoVenta, $codigoSistema, $nit, $codigoSucursal, $codigoModalidad);
            //echo $cuis;
            $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $cuis);
            $xml = simplexml_load_string($xml);
            $json = json_encode($xml);
            $responseArray = json_decode($json,true);
            //print_r($responseArray);
            $res_respuestaCuis = $this->showArrayKeySearch($responseArray, 'RespuestaCuis');
            $tam_array = count($res_respuestaCuis);
            $save = false;
            if( $tam_array > 0){
              if( $tam_array > 1){
                  $codigo_cuis = $this->findKey($res_respuestaCuis,'codigo');
                  $fecha_vigencia = $this->findKey($res_respuestaCuis,'fechaVigencia');
                  $transaccion = $this->findKey($res_respuestaCuis,'transaccion');
                  if($transaccion =='true'){
                    $transaccion = 1;
                  }else{
                    $transaccion = 0;
                  }
                  if($codigo_cuis){
                    $save = true;
                  }
              }
            }
            $res_mensajesList = $this->showArrayKeySearch($responseArray, 'mensajesList');
            $tam_array = count($res_mensajesList);
            if( $tam_array > 0){
              $codigoMensaje = $this->findKey($res_mensajesList,'codigo');
              $descripcionMensaje = $this->findKey($res_mensajesList,'descripcion');
            }

            if($save){
              $res = $this->saveCuis($codigoAmbiente, $codigoSistema, $nit, $codigoModalidad, $codigoSucursal, $codigoPuntoVenta, $codigo_cuis, $fecha_vigencia, $codigoMensaje, $descripcionMensaje, $transaccion, $idApikey);
              if($res){
                echo 'Se guardo correctamente';
                //sincronizar catalogos para todas las sucursales
                $codigoAmbiente='2';
                $codigoSistema='7228C6496C77C09EE700B6F';
                $nit='4394186018';
                $cuis='10041EAB';
                $codigoSucursal='0';
                $codigoPuntoVenta='1';

                $this->sincronizarCatalogos($apikey, $codigoSucursal);

              }else{
                echo 'Ocurrio un error';
              }
            }

            

        }

        function getAllCuis($codigoSucursal){
          
          $sql = "EXEC VENTAS_GET_F01_CUIS '$codigoSucursal';";
          $respuesta = $this->main->getQuery($sql);
          return $respuesta;
        }

        function sincronizarCatalogos($apikey, $codigo_sucursal){
          $cuis= $this->getAllCuis($codigo_sucursal);
          if(count($cuis)>0){
            $id_cuis = $cuis[0]->ID_VENTAS_F01_CUIS;
            $codigoAmbiente = $cuis[0]->CODIGO_AMBIENTE;
            $codigoSistema = $cuis[0]->CODIGO_SISTEMA;
            $nit = $cuis[0]->NIT;
            $val_cuis = $cuis[0]->CODIGO_CUIS;
            $codigo_punto_venta = $cuis[0]->CODIGO_PUNTO_VENTA;
          }

          $wsdlURL= URL_SINCRONIZACION;
          // -1 Códigos de Actividades
          $venta_catalogo = $this->getCatalogo('LISTADO DE ACTIVIDADES');
          //$metodo = 'sincronizarActividades';
          if(count($venta_catalogo)>0){
            $id_ventas_catalogo = $venta_catalogo[0]->ID_VENTAS_F02_CATALOGO;
            $nombre_funcion = $venta_catalogo[0]->NOMBRE_FUNCION;
          }else{
            echo 'error';
            exit();
          }
          
          $actividades = $this->solicitudSincronizacion($wsdlURL, $apikey, $nombre_funcion, $codigoAmbiente, $codigoSistema, $nit, $val_cuis, $codigo_sucursal, $codigo_punto_venta);
          $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $actividades);
          $xml = simplexml_load_string($xml);
          $json = json_encode($xml);
          $responseArray = json_decode($json,true);
          $res_respuesta = $this->showArrayKeySearch($responseArray, 'RespuestaListaActividades');
          $tam_array = count($res_respuesta);
          $save = false;
          if( $tam_array > 0){
                $transaccion = $this->findKey($res_respuesta,'transaccion');
                if($transaccion =='true'){
                  $transaccion = 1;
                }else{
                  $transaccion = 0;
                }
          }
          $res_respuesta = $this->showArrayKeySearch($responseArray, 'listaActividades');
          $tam_array = count($res_respuesta);
          $save = false;
          if( $tam_array > 0){
            if( $tam_array > 1){
                $codigoCaeb = $this->findKey($res_respuesta,'codigoCaeb');
                $descripcion = $this->findKey($res_respuesta,'descripcion');
                $tipoActividad = $this->findKey($res_respuesta,'tipoActividad');
                $save=true;
            }
          }
          if($save){
              $this->saveActividades($id_cuis, $id_ventas_catalogo, $transaccion, $codigoCaeb, $descripcion, $tipoActividad);
          }
          // -3 Códigos de Actividades Documento Sector
          $venta_catalogo = $this->getCatalogo('LISTADO TOTAL DE ACTIVIDADES DOCUMENTO SECTOR');
          if(count($venta_catalogo)>0){
            $id_ventas_catalogo = $venta_catalogo[0]->ID_VENTAS_F02_CATALOGO;
            $nombre_funcion = $venta_catalogo[0]->NOMBRE_FUNCION;
          }else{
            echo 'error';
            exit();
          }
          
          $solicitudSincronizacion = $this->solicitudSincronizacion($wsdlURL, $apikey, $nombre_funcion, $codigoAmbiente, $codigoSistema, $nit, $val_cuis, $codigo_sucursal, $codigo_punto_venta);
          
          $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $solicitudSincronizacion);
          $xml = simplexml_load_string($xml);
          $json = json_encode($xml);
          $responseArray = json_decode($json,true);
          $res_respuesta = $this->showArrayKeySearch($responseArray, 'RespuestaListaActividadesDocumentoSector');
          //print_r($responseArray);
          $tam_array = count($res_respuesta);
          $save = false;
          if( $tam_array > 0){
                $transaccion = $this->findKey($res_respuesta,'transaccion');
                if($transaccion =='true'){
                  $transaccion = 1;
                }else{
                  $transaccion = 0;
                }
          }
          $res_respuesta = $this->findKey($responseArray,'listaActividadesDocumentoSector');
          $tam_array = count($res_respuesta);
          if( $tam_array > 0){
            foreach ($res_respuesta as $key => $value) {
              $codigoActividad = $this->findKey($value,'codigoActividad');
              $codigoDocumentoSector = $this->findKey($value,'codigoDocumentoSector');
              $tipoDocumentoSector = $this->findKey($value,'tipoDocumentoSector');
              $this->saveActividadesDocumentoSector($id_cuis, $id_ventas_catalogo, $transaccion, $codigoActividad, $codigoDocumentoSector, $tipoDocumentoSector);
            }
          }

        }

        function saveActividades($id_cuis, $id_ventas_catalogo, $transaccion, $codigoCaeb, $descripcion, $tipoActividad){
          $res = null;
          $sql = "EXEC VENTAS_SET_F02_SINCRONIZACION '$id_cuis', '$id_ventas_catalogo', '$codigoCaeb', '$transaccion', '$descripcion', '$tipoActividad', '','';";
          $res = $this->main->getQuery2($sql);
          return $res;
        }

        function saveActividadesDocumentoSector($id_cuis, $id_ventas_catalogo, $transaccion, $codigoActividad, $codigoDocumentoSector, $tipoDocumentoSector){
          $res = null;
          $sql = "EXEC VENTAS_SET_F02_SINCRONIZACION '$id_cuis', '$id_ventas_catalogo', '$codigoActividad', '$transaccion', '', '', '$tipoDocumentoSector','$codigoDocumentoSector';";
          $res = $this->main->getQuery2($sql);
          return $res;
        }

        function getCatalogo($name){
          $res = null;
          $sql="EXEC VENTAS_GET_F02_CATALOGO '$name';";
          $res = $this->main->getQuery($sql);
          return $res;
        }

        function getApiKey(){
          $res = null;
          $date = date('Y-m-d');
          $sql="select * from VENTAS_F00_LLAVE where ESTADO =1 and '$date' <= FECHA_VENCIMIENTO;";
          $res = $this->main->getQuery($sql);
          return $res;
        }

        function saveCuis($codigo_ambiente, $codigo_sistema, $nit, $codigo_modalidad, $codigo_sucursal, $codigo_punto_venta, $codigo_cuis, $fecha_vigencia, $codigo, $descripcion, $transaccion, $id_llave){
            $res = null;
            $sql = "EXEC VENTAS_SET_F01_CUIS '$codigo_ambiente', '$codigo_sistema', '$nit', '$codigo_modalidad', '$codigo_sucursal', '$codigo_punto_venta', '$codigo_cuis','$fecha_vigencia','$codigo','$descripcion','$transaccion','$id_llave' ;";
            $res = $this->main->getQuery2($sql);
            return $res;
        }

        function showArray($array){
            foreach ($array as $key => $item) {
              if (is_array($item)) {
                  return $this->showArray($item);
              }else{
                echo '<br>'.$key.':'.$item.'<br>';
              }
            }
          }
          
          function showArrayKeySearch($array,$keySearch){
            $res = array();
            foreach ($array as $key => $item) {
              if (is_array($item)) {
                if ($key === $keySearch) {
                  return $this->showArrayItem($item);
                }else{
                  return $this->showArrayKeySearch($item,$keySearch);
                }
              }
            }
            return $res;
          }
          
          function showArrayItem($array){
            $res= array();
            foreach ($array as $key => $item) {
              if (!is_array($item)) {
                //echo '<br>'.$key.':'.$item;
                $res[$key]=$item;
              }
            }
            return $res;
          }
          
          function findKey($array, $keySearch){
              foreach ($array as $key => $item) {
                  if ($key === $keySearch) {
                      return $item;
                  }else{
                      if (is_array($item)) {
                          return $this->findKey($item, $keySearch);
                      }
                  }
              }
              return false;
          }
          
          function getCuis($wsdlURL, $apikey, $codigoAmbiente, $codigoPuntoVenta, $codigoSistema, $nit, $codigoSucursal, $codigoModalidad){
            $dataXML = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:siat="https://siat.impuestos.gob.bo/">
            <soapenv:Header/>
            <soapenv:Body>
            <siat:cuis>
            <SolicitudCuis>
            <codigoAmbiente>'.$codigoAmbiente.'</codigoAmbiente>
              <codigoPuntoVenta>'.$codigoPuntoVenta.'</codigoPuntoVenta>
              <codigoSistema>'.$codigoSistema.'</codigoSistema>	
              <nit>'.$nit.'</nit>
              <codigoSucursal>'.$codigoSucursal.'</codigoSucursal>	
              <codigoModalidad>'.$codigoModalidad.'</codigoModalidad>
              </SolicitudCuis>
            </siat:cuis>
            </soapenv:Body>
            </soapenv:Envelope>';
            
            $curl = curl_init();
            curl_setopt_array($curl, [
              CURLOPT_URL => $wsdlURL,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $dataXML,
              CURLOPT_HTTPHEADER => [
                "Authorization: Bearer ",
                "Content-Type: application/xml",
                "apikey: ".$apikey
              ],
            ]);
          
            $response = curl_exec($curl);
            $err = curl_error($curl);
          
            curl_close($curl);
          
            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              return $response;
            }
          }

          function solicitudSincronizacion($wsdlURL, $apikey, $metodo, $codigoAmbiente, $codigoSistema, $nit, $cuis, $codigoSucursal, $codigoPuntoVenta){
            $curl = curl_init();
            curl_setopt_array($curl, [
              CURLOPT_URL => $wsdlURL,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:siat="https://siat.impuestos.gob.bo/">
              <soapenv:Header/>
              <soapenv:Body>
                <siat:'.$metodo.'>
                  <SolicitudSincronizacion>
                    <codigoAmbiente>'.$codigoAmbiente.'</codigoAmbiente>
                    <codigoSistema>'.$codigoSistema.'</codigoSistema>
                    <nit>'.$nit.'</nit>
                    <cuis>'.$cuis.'</cuis>
                    <codigoSucursal>'.$codigoSucursal.'</codigoSucursal>
                    <codigoPuntoVenta>'.$codigoPuntoVenta.'</codigoPuntoVenta>
                  </SolicitudSincronizacion>
              </siat:'.$metodo.'>
              </soapenv:Body>
              </soapenv:Envelope>',
              CURLOPT_HTTPHEADER => [
                "Authorization: Basic Og==",
                "Content-Type: application/xml",
                "apikey: ".$apikey
              ],
            ]);
          
            $response = curl_exec($curl);
            $err = curl_error($curl);
          
            curl_close($curl);
          
            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              //echo $response;
              return $response;
            }
          }
    
    }
    
    /* End of file Cuis.php */
    