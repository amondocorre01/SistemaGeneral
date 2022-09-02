<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Login/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'login/index';

$route['cliente-capresso'] = 'cliente/register';
$route['actualizar-cliente-capresso'] = 'cliente/update';



$route['existe-dni'] = 'cliente/existe';
$route['categoria-1'] = 'api/venta/index';
$route['categoria-2'] = 'api/venta/categoria_2';
$route['categoria-3'] = 'api/venta/categoria_3';
$route['busqueda-cliente'] = 'api/venta/busqueda_cliente';
$route['guardar-pedido'] = 'api/venta/guardar_pedido';
$route['generico'] = 'generico/inicio';
$route['resumen'] = 'api/venta/resumen';
$route['producto-adicional'] = 'api/venta/adicional';

/* DETALLE INGRESOS E EGRESOS */
$route['detalle-IE'] = 'api/movimiento/index';
$route['registrar-movimiento'] = 'api/movimiento/guardar_movimiento';


/* ACTUALIZAR O REGISTRAR CLIENTE */
$route['actualizar-cliente'] = 'api/cliente/update';
$route['registrar-cliente'] = 'api/cliente/register';

/**APERTURA DE CAJA */
$route['apertura-caja'] = 'api/aperturacaja/register';
$route['apertura-caja-pendiente'] = 'api/aperturacaja/pendiente';

/**CIERRE DE CAJA */
$route['cierre-caja'] = 'api/cierrecaja/register';


/** GET CLIENTE */
$route['get-cliente'] = 'api/cliente/get';
$route['mis-clientes'] = 'api/cliente/search';



/** IMPRESION O ANULACION */
$route['anular-factura'] = 'api/impresion/anular';
$route['copia-factura'] = 'api/impresion/copia';
$route['original-factura'] = 'api/impresion/copia';
$route['imprimir-factura/(:any)'] = 'api/impresion/factura/$1';
$route['imprimir-recibo/(:any)'] = 'api/impresion/recibo/$1';
$route['imprimir-ingreso'] = 'api/impresion/ingreso';
$route['imprimir-egreso'] = 'api/impresion/egreso';
$route['imprimir-abrir-caja'] = 'api/impresion/abrirCaja';
$route['imprimir-cierre-caja'] = 'api/impresion/cierreCaja';
$route['reimprimir-factura'] = 'api/impresion/reimprimirFactura';
$route['imprimir-copia-factura'] = 'api/impresion/imprimirCopiaFactura';
$route['abrir-gaveta'] = 'api/impresion/gaveta';


/**  USUARIOS */
$route['nuevo-usuario'] = 'usuario/save';


/** API USUARIOS */
$route['get-usuarios'] = 'api/usuarios';
$route['get-usuario'] = 'api/usuarios/acceso';
$route['dar-baja'] = 'api/usuarios/baja';
$route['dar-alta'] = 'api/usuarios/alta';
$route['set-ubicacion'] = 'api/usuarios/ubicacion';
$route['get-empleado'] = 'api/usuarios/empleado';
$route['get-menu'] = 'api/usuarios/menu';
$route['actualizar-permisos-usuarios'] = 'api/usuarios/permisos';
$route['get-permiso-boton'] = 'api/usuarios/boton';
$route['aprobar-cambios-botones'] = 'api/usuarios/botones';
$route['check-user'] = 'api/usuarios/check';
$route['check-dni'] = 'api/usuarios/dni';



/** API PERFILES */
$route['get-perfiles'] = 'api/perfiles/index';
$route['set-perfil'] = 'api/perfiles/aprobar';
$route['nuevo-perfil'] = 'api/perfiles/create';
$route['get-perfil'] = 'api/perfiles/menu';
$route['actualizar-permisos-perfil'] = 'api/perfiles/save';




/**  FACTURACION */

    /** LLAVE */
    $route['get-llaves'] = 'facturacion/llave/index';
    $route['get-key'] = 'facturacion/llave/get';
    $route['nueva-llave'] = 'facturacion/llave/create';
    $route['activar-key'] = 'facturacion/llave/activate';
    $route['inactivar-key'] = 'facturacion/llave/desactivate';

    /** CUIS */
    $route['nuevo-cuis'] = 'facturacion/cuis/create';
    $route['get-cuis'] = 'facturacion/cuis/index';


    

















