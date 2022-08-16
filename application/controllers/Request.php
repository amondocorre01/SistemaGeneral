<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    use sistemaWeb2\libraries\RestController;
    require (APPPATH . 'libraries/RestController.php');
    require (APPPATH . 'libraries/Format.php');
   
    class Request extends RestController {
    
        
        public function xml_get() {

        $nitEmisor = '1003579028';
        $razonSocialEmisor = 'Carlos Loza';
        $municipio = 'La Paz';
        $telefono = '78595684';
        $numeroFactura = '1';
        $cuf = '44AAEC00DBD34C53C3E2CCE1A3FA7AF1E2A08606A667A75AC82F24C74';
        $cufd = 'BQUE+QytqQUDBKVUFOSVRPQkxVRFZNVFVJBMDAwMDAwM';
        $codigoSucursal = '0';
        $direccion = "AV. JORGE LOPEZ #123";
        $codigoPuntoVenta =  'xsi:nil="true"';
        $fechaEmision = '2021-10-06T16:03:48.675';
        $nombreRazonSocial = 'Mi razon social';
        $codigoTipoDocumentoIdentidad = '1';
        $numeroDocumento = '5115889';
        $complemento = 'xsi:nil="true"';
        $codigoCliente = '51158891';
        $codigoMetodoPago = '1';
        $numeroTarjeta = 'xsi:nil="true"';
        $montoTotal = '99';
        $montoTotalSujetoIva = '99';
        $codigoMoneda = '1';
        $tipoCambio = '1';
        $montoTotalMoneda = '99';
        $montoGiftCard  = 'xsi:nil="true"';
        $descuentoAdicional = '1';
        $codigoExcepcion = 'xsi:nil="true"';
        $cafc = 'xsi:nil="true"';
        $leyenda = 'Ley N° 453: Tienes derecho a recibir información sobre las características y contenidos de los
            servicios que utilices.';
        $usuario = 'pperez';
        $codigoDocumentoSector = '1'; 
        }
    }