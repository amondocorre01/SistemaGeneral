<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Impresion extends CI_Controller {

        
        public function __construct()
        {
            parent::__construct();
            $this->load->library('QRlib/index'); 
        }
        
    
        public function anular()
        {
            $db = $this->input->post('db');
            $suf_suc = $this->input->post('suf_suc');

            echo $suf_suc;
            exit();
            $id_menu = $this->input->post('id_menu');



            $DB2 = $this->load->database('ventas', TRUE);

            $id = $this->input->post('id');
            //obtener la factura por id
            
            $venta_documento = $this->getFactura($id);
            var_dump($venta_documento);
            echo '<br><br>';
            $cuis_actual = $this->getCuisActual(0);
            var_dump($cuis_actual);
            echo '<br><br>';
            $fecha = date('Y-m-d');
            $cufd_actual = $this->getCufdActual(($cuis_actual[0]->ID_VENTAS_F01_CUIS), $fecha);
            $codigoAmbiente = $cuis_actual[0]->CODIGO_AMBIENTE;
            $codigoSistema = $cuis_actual[0]->CODIGO_SISTEMA;
            $codigoSucursal = $cuis_actual[0]->CODIGO_SUCURSAL;
            $codigoModalidad = $cuis_actual[0]->CODIGO_MODALIDAD;
            $cuis = $cuis_actual[0]->CODIGO_CUIS;
            $codigoPuntoVenta = $cuis_actual[0]->CODIGO_PUNTO_VENTA;
            $nit = $cuis_actual[0]->NIT;
            $cuf = $venta_documento[0]->CODIGO_CUF;
            $tipoFacturaDocumento = $venta_documento[0]->TIPO_DOCUMENTO;
            $codigoEmision = $venta_documento[0]->TIPO_EMISION;
            $codigoDocumentoSector = $venta_documento[0]->CODIGO_DOCUMENTO_SECTOR;
            $codigoMotivo = '1';
            $cufd = $cufd_actual[0]->CODIGO_CUFD;
            $respuesta_soap = $this->anularFacturaSoap($cuf,$codigoAmbiente,$codigoEmision,$codigoSistema,$codigoSucursal,$codigoMotivo,$codigoModalidad,$cuis,$codigoPuntoVenta,$tipoFacturaDocumento,$nit,$codigoDocumentoSector,$cufd);
            $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $respuesta_soap);
            $xml = simplexml_load_string($xml);
            $json = json_encode($xml);
            $responseArray = json_decode($json,true);
            $res_respuesta = $this->showArrayKeySearch($responseArray, 'RespuestaServicioFacturacion');
            $tam_array = count($res_respuesta);
            $save = false;
            if( $tam_array > 0){
                $codigo_estado = $this->findKey($res_respuesta,'codigoEstado'); 
                $transaccion = $this->findKey($res_respuesta,'transaccion');
                if($transaccion =='true'){
                    if($codigo_estado =='905'){
                        $save=true;
                    }
                $transaccion = 1;
                }else{
                $transaccion = 0;
                }
            }
            if($save){
                $DB2->where('ID_VENTA_DOCUMENTO', $id);
                $DB2->update('VENTA_DOCUMENTO'.SUF_SUC , ['ANULADO'=>1]);
                $this->session->set_flashdata('anulado', 'SI');
            }else{
                $this->session->set_flashdata('anulado', 'NO');
            }
            redirect(site_url('generico/inicio?vc='.$id_menu),'refresh');
        
        }

        function getCuisActual($codigo_sucursal){
            $res = null;
            $sql = "EXEC VENTAS_GET_F01_CUIS '$codigo_sucursal';";
            $respuesta = $this->main->getQuery($sql);
            return $respuesta;
        }

        function getCufdActual($id_cuis, $fecha){
            $res = null;
            $sql = "EXEC ".PRE_SUC."VENTAS_GET_F03_CUFD '$id_cuis','$fecha';";
            $DB2 = $this->load->database('ventas', TRUE);
            $respuesta = $DB2->query($sql);
            $respuesta = $respuesta->result();
            return $respuesta;
        }

        function getFactura($id){
            $res = null;
            $sql = "EXEC GET_VENTA_DOCUMENTO '$id';";
            $DB2 = $this->load->database('ventas', TRUE);
            $respuesta = $DB2->query($sql);
            $respuesta = $respuesta->result();
            return $respuesta;
        }

        public function copia()
        {
            $id = $this->input->post('id');
            $pre_suc = $this->input->post('pre_suc');

            $result = $this->main->get('FF_VENTAS', ['ID_VENTA_DOCUMENTO'=>$id]);

            $literal = convertir($result->TOTAL_A_PAGAR);
    
            $result->literal = $literal; 

            $res=json_encode($result);
            $this->session->set_userdata('data-imprimir', $res);
            echo $res;
        }

        public function original()
        {
            $id = $this->input->post('id');
            $result = $this->main->get('FF_VENTAS', ['ID_VENTA_DOCUMENTO'=>$id]);


            $literal = convertir($result->TOTAL_A_PAGAR);
    
            $result->literal = $literal; 
            $res=json_encode($result);
            $this->session->set_userdata('data-imprimir', $res);
            echo $res;
        }

        public function factura($valor){
            $data['valor'] = $valor;
            $this->load->view('impresion/imprimir_factura', $data, FALSE);
        }

        public function recibo($valor){
            $data['valor'] = $valor;
            $this->load->view('impresion/imprimir_recibo', $data, FALSE);
        }

        public function gaveta(){
            $this->load->view('impresion/abrir_gaveta', null, FALSE);
        }

        public function ingreso(){
            $this->load->view('impresion/imprimir_ingreso', null, FALSE);
        }

        public function egreso(){
            $this->load->view('impresion/imprimir_egreso', null, FALSE);
        }

        public function abrirCaja(){
            $this->load->view('impresion/imprimir_abrir_caja', null, FALSE);
        }

        public function cierreCaja(){
            $this->load->view('impresion/imprimir_cierre_caja', null, FALSE);
        }
        
        public function reimprimirFactura(){
            $this->load->view('impresion/reimprimir_factura', null, FALSE);
        }
        
        public function imprimirCopiaFactura(){
            $this->load->view('impresion/imprimir_copia_factura', null, FALSE);
        }
        
        function anularFacturaSoap($cuf,$codigoAmbiente,$codigoEmision,$codigoSistema,$codigoSucursal,$codigoMotivo,$codigoModalidad,$cuis,$codigoPuntoVenta,$tipoFacturaDocumento,$nit,$codigoDocumentoSector,$cufd){
            $wsdlURL = URL_COMPRA_VENTA;
            $XMLString = '<?xml version="1.0" encoding="UTF-8"?>
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:siat="https://siat.impuestos.gob.bo/">
            <soapenv:Header/>
            <soapenv:Body>
                <siat:anulacionFactura>
                    <SolicitudServicioAnulacionFactura>
                        <codigoAmbiente>'.$codigoAmbiente.'</codigoAmbiente>
                        <codigoEmision>'.$codigoEmision.'</codigoEmision>
                        <codigoSistema>'.$codigoSistema.'</codigoSistema>	
                        <codigoSucursal>'.$codigoSucursal.'</codigoSucursal>  
                        <codigoMotivo>'.$codigoMotivo.'</codigoMotivo>
                        <codigoModalidad>'.$codigoModalidad.'</codigoModalidad>
                        <cuis>'.$cuis.'</cuis>
                        <codigoPuntoVenta>'.$codigoPuntoVenta.'</codigoPuntoVenta>
                        <cuf>'.$cuf.'</cuf>
                        <tipoFacturaDocumento>'.$tipoFacturaDocumento.'</tipoFacturaDocumento>
                        <nit>'.$nit.'</nit>
                        <codigoDocumentoSector>'.$codigoDocumentoSector.'</codigoDocumentoSector>
                        <cufd>'.$cufd.'</cufd>
                        </SolicitudServicioAnulacionFactura>
                </siat:anulacionFactura>
            </soapenv:Body>
            </soapenv:Envelope>';
            $curl = curl_init();
            curl_setopt_array($curl, [
            CURLOPT_URL => URL_COMPRA_VENTA,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $XMLString,
            CURLOPT_HTTPHEADER => [
                "Authorization: Basic Og==",
                "Content-Type: application/xml",
                "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJSb25hbGRtZW4wMTgiLCJjb2RpZ29TaXN0ZW1hIjoiNzIyOEM2NDk2Qzc3QzA5RUU3MDBCNkYiLCJuaXQiOiJINHNJQUFBQUFBQUFBRE14dGpReHREQXpNTFFBQUxxbGd4SUtBQUFBIiwiaWQiOjMwMTQ1OTYsImV4cCI6MTY5MjE0NDAwMCwiaWF0IjoxNjYwNjc4NzU0LCJuaXREZWxlZ2FkbyI6NDM5NDE4NjAxOCwic3Vic2lzdGVtYSI6IlNGRSJ9.vHJD3ipob2kLbhpAs51a25TRKnAUaC_q-bzCtQC42iLQpTrHMS-TgJwN_pQePO1022TdUL4fn55IbkxuEIEHtA"
            ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                return null;
            } else {
                return $response;
            }
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
    
    }
    
    /* End of file Impresion.php */
    
