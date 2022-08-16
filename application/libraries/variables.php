<?php
    date_default_timezone_set('America/La_Paz');

    $var_nitEmisor = "5555555";
    $var_razonSocialEmisor = "Carlos Loza";
    $var_municipio = 'La Paz';
    $var_telefono = '78595684';
    
    $var_numeroFactura= "1";
    $var_cuf = "44AAEC00DBD34C53C3E2CCE1A3FA7AF1E2A08606A667A75AC82F24C74";
    $var_cufd = "BQUE+QytqQUDBKVUFOSVRPQkxVRFZNVFVJBMDAwMDAwM";
    
    $var_codigoSucursal = "0";
    $var_direccion = "AV. JORGE LOPEZ #123";
    
    $var_fechaEmision = gmdate("Y-m-d\TH:i:s\.Z");
  
    $var_nombreRazonSocial = "Mi razon social";
    
    $var_codigoTipoDocumentoIdentidad = "1";
    $var_numeroDocumento = "5115889";
        
    $var_codigoCliente = "51158891";
    $var_codigoMetodoPago = "1";
    
    
    $var_montoTotal="99";
    $var_montoTotalSujetoIva="99";
    $var_codigoMoneda="1";

    
    $var_tipoCambio="1";
    $var_montoTotalMoneda="99";

    
    $var_descuentoAdicional="1";
    
    
    $var_leyenda="Ley N° 453: Tienes derecho a recibir información sobre las características y contenidos de los
        servicios que utilices.";
    $var_usuario="pperez";
    $var_codigoDocumentoSector="1";


    $detalles = [];

    array_push($detalles, ['actividadEconomica'=>'451010', 'codigoProductoSin'=>'49111', 'codigoProducto' => 'JN-131231', 'descripcion'=>'JUGO DE NARANJA EN VASO', 'cantidad'=>'1', 'unidadMedida'=>'1', 'precioUnitario'=>'100', 'montoDescuento'=>'0','subTotal'=>'100', 'numeroSerie'=>'124548', 'numeroImei'=>'545454']);

    array_push($detalles, ['actividadEconomica'=>'451010', 'codigoProductoSin'=>'49100', 'codigoProducto' => 'JN-131225', 'descripcion'=>'JUGO DE MANZANA EN VASO', 'cantidad'=>'2', 'unidadMedida'=>'1', 'precioUnitario'=>'100', 'montoDescuento'=>'0','subTotal'=>'200', 'numeroSerie'=>'124549', 'numeroImei'=>'545450']);
    
?>