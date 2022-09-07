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
            $id_menu = $this->input->post('id_menu');



            $DB2 = $this->load->database('ventas', TRUE);

            $id = $this->input->post('id');
            //obtener la factura por id
            $result = $this->main->get(PRE_SUC.'VENTAS', ['ID_VENTA_DOCUMENTO'=>$id]);

            //Anulando de la base de datos
            $DB2->where('ID_VENTA_DOCUMENTO', $id);
            $DB2->update('VENTA_DOCUMENTO'.$suf_suc , ['ANULADO'=>1]);

            $this->session->set_flashdata('anulado', 'SI');
            

            redirect(site_url('generico/inicio?vc='.$id_menu),'refresh');
        
        }

        public function copia()
        {
            $id = $this->input->post('id');
            $pre_suc = $this->input->post('pre_suc');

            $result = $this->main->get($pre_suc.'VENTAS', ['ID_VENTA_DOCUMENTO'=>$id]);

            $literal = convertir($result->TOTAL_A_PAGAR);
    
            $result->literal = $literal; 

            $res=json_encode($result);
            $this->session->set_userdata('data-imprimir', $res);
            echo $res;
        }

        public function original()
        {
            $id = $this->input->post('id');
            $result = $this->main->get(PRE_SUC.'VENTAS', ['ID_VENTA_DOCUMENTO'=>$id]);


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
    
    }
    
    /* End of file Impresion.php */
    
