<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Xml extends CI_Controller {
    
        public function index()
        {
            $this->load->helper('string');
            $name_file = random_string('alnum', 10);

            require_once(APPPATH.'libraries/variables.php');
            
            $xml = new DOMDocument('1.0', 'UTF-8');
            $xml->formatOutput = true;

            $facturaComputarizadaCompraVenta = $xml->createElement("facturaComputarizadaCompraVenta");
            $facturaComputarizadaCompraVenta->setAttribute("xsi:noNamespaceSchemaLocation", "facturaComputarizadaCompraVenta.xsd");
            $facturaComputarizadaCompraVenta->setAttribute("xmlns:xsi","http://www.w3.org/2001/XMLSchema-instance");
            $xml->appendChild($facturaComputarizadaCompraVenta);

            $cabecera = $xml->createElement("cabecera");
            $facturaComputarizadaCompraVenta->appendChild($cabecera);

            $nitEmisor =  $xml->createElement("nitEmisor",  $var_nitEmisor);
            $cabecera->appendChild($nitEmisor);

            $razonSocialEmisor = $xml->createElement("razonSocialEmisor",  $var_razonSocialEmisor);
            $cabecera->appendChild($razonSocialEmisor);

            $municipio = $xml->createElement("municipio",  $var_municipio);
            $cabecera->appendChild($municipio);

            $telefono = $xml->createElement("telefono",  $var_telefono);
            $cabecera->appendChild($telefono);

            $numeroFactura = $xml->createElement("numeroFactura",  $var_numeroFactura);
            $cabecera->appendChild($numeroFactura);

            $cuf = $xml->createElement("cuf",  $var_cuf);
            $cabecera->appendChild($cuf);

            $cufd = $xml->createElement("cufd",  $var_cufd);
            $cabecera->appendChild($cufd);

            $codigoSucursal = $xml->createElement("codigoSucursal",  $var_codigoSucursal);
            $cabecera->appendChild($codigoSucursal);

            $direccion = $xml->createElement("direccion",  $var_direccion);
            $cabecera->appendChild($direccion);

            $codigoPuntoVenta = $xml->createElement("codigoPuntoVenta");
            $codigoPuntoVenta->setAttribute("xsi:nil","true");
            $cabecera->appendChild($codigoPuntoVenta);

            $fechaEmision = $xml->createElement("fechaEmision",  $var_fechaEmision);
            $cabecera->appendChild($fechaEmision);

            $nombreRazonSocial = $xml->createElement("nombreRazonSocial",  $var_nombreRazonSocial);
            $cabecera->appendChild($nombreRazonSocial);

            $codigoTipoDocumentoIdentidad = $xml->createElement("codigoTipoDocumentoIdentidad",  $var_codigoTipoDocumentoIdentidad);
            $cabecera->appendChild($codigoTipoDocumentoIdentidad);

            $numeroDocumento = $xml->createElement("numeroDocumento",  $var_numeroDocumento);
            $cabecera->appendChild($numeroDocumento);

            $complemento = $xml->createElement("complemento");
            $complemento->setAttribute("xsi:nil","true");
            $cabecera->appendChild($complemento);

            $codigoCliente = $xml->createElement("codigoCliente",  $var_codigoCliente);
            $cabecera->appendChild($codigoCliente);

            $codigoMetodoPago = $xml->createElement("codigoMetodoPago",  $var_codigoMetodoPago);
            $cabecera->appendChild($codigoMetodoPago);

            $numeroTarjeta = $xml->createElement("numeroTarjeta");
            $numeroTarjeta->setAttribute("xsi:nil","true");
            $cabecera->appendChild($numeroTarjeta);

            $montoTotal = $xml->createElement("montoTotal",  $var_montoTotal);
            $cabecera->appendChild($montoTotal);

            $montoTotalSujetoIva = $xml->createElement("montoTotalSujetoIva",  $var_montoTotalSujetoIva);
            $cabecera->appendChild($montoTotalSujetoIva);

            $codigoMoneda = $xml->createElement("codigoMoneda",  $var_codigoMoneda);
            $cabecera->appendChild($codigoMoneda);

            $tipoCambio = $xml->createElement("tipoCambio",  $var_tipoCambio);
            $cabecera->appendChild($tipoCambio);

            $montoTotalMoneda = $xml->createElement("montoTotalMoneda",  $var_montoTotalMoneda);
            $cabecera->appendChild($montoTotalMoneda);

            $montoGiftCard = $xml->createElement("montoGiftCard");
            $montoGiftCard->setAttribute("xsi:nil","true");
            $cabecera->appendChild($montoGiftCard);

            $descuentoAdicional = $xml->createElement("descuentoAdicional",  $var_descuentoAdicional);
            $cabecera->appendChild($descuentoAdicional);

            $codigoExcepcion = $xml->createElement("codigoExcepcion");
            $codigoExcepcion->setAttribute("xsi:nil","true");
            $cabecera->appendChild($codigoExcepcion);

            $cafc = $xml->createElement("cafc");
            $cafc->setAttribute("xsi:nil","true");
            $cabecera->appendChild($cafc);

            $leyenda = $xml->createElement("leyenda",  $var_leyenda);
            $cabecera->appendChild($leyenda);

            $usuario = $xml->createElement("usuario",  $var_usuario);
            $cabecera->appendChild($usuario);

            $codigoDocumentoSector = $xml->createElement("codigoDocumentoSector",  $var_codigoDocumentoSector);
            $cabecera->appendChild($codigoDocumentoSector);

            

            foreach ($detalles as $detalle) {

                $var_actividadEconomica = $detalle['actividadEconomica'];
                $var_codigoProductoSin = $detalle['codigoProductoSin'];
                $var_codigoProducto = $detalle['codigoProducto']; 
                $var_descripcion = $detalle['descripcion'];
                $var_cantidad = $detalle['cantidad'];
                $var_unidadMedida = $detalle['unidadMedida'];
                $var_precioUnitario = $detalle['precioUnitario'];
                $var_montoDescuento = $detalle['montoDescuento']; 
                $var_subTotal = $detalle['subTotal']; 
                $var_numeroSerie = $detalle['numeroSerie'];
                $var_numeroImei = $detalle['numeroImei'];

                $det = $xml->createElement("detalle");
                $facturaComputarizadaCompraVenta->appendChild($det);

                $actividadEconomica = $xml->createElement("actividadEconomica",  $var_actividadEconomica);
                $det->appendChild($actividadEconomica);

                $codigoProductoSin = $xml->createElement("codigoProductoSin",  $var_codigoProductoSin);
                $det->appendChild($codigoProductoSin);

                $codigoProducto = $xml->createElement("codigoProducto",  $var_codigoProducto);
                $det->appendChild($codigoProducto);

                $descripcion = $xml->createElement("descripcion",  $var_descripcion);
                $det->appendChild($descripcion);

                $cantidad = $xml->createElement("cantidad",  $var_cantidad);
                $det->appendChild($cantidad);

                $unidadMedida = $xml->createElement("unidadMedida",  $var_unidadMedida);
                $det->appendChild($unidadMedida);

                $precioUnitario = $xml->createElement("precioUnitario",  $var_precioUnitario);
                $det->appendChild($precioUnitario);

                $montoDescuento = $xml->createElement("montoDescuento",  $var_montoDescuento);
                $det->appendChild($montoDescuento);

                $subTotal = $xml->createElement("subTotal",  $var_subTotal);
                $det->appendChild($subTotal);

                $numeroSerie = $xml->createElement("numeroSerie",  $var_numeroSerie);
                $det->appendChild($numeroSerie);

                $numeroImei = $xml->createElement("numeroImei",  $var_numeroImei);
                $det->appendChild($numeroImei);
            }


            $xml->formatOutput = true;
            $strings_xml = $xml->saveXML();

            $xml->save( getcwd().'/assets/dist/uploads/'.$name_file.'.xml');
        }
    
    }
    
    /* End of file Xml.php */
    
?>