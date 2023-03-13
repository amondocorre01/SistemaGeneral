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
$route['detalle-turno'] = 'api/cierrecaja/ver_detalle_turno';


/** GET CLIENTE */
$route['get-cliente'] = 'api/cliente/get';
$route['mis-clientes'] = 'api/cliente/search';



/** IMPRESION O ANULACION */
$route['motivos-anulacion'] = 'api/impresion/motivos';
$route['anular-factura'] = 'api/impresion/anular';
$route['anular-recibo'] = 'api/impresion/anularRecibo';
$route['copia-factura'] = 'api/impresion/copia';
$route['original-factura'] = 'api/impresion/copia';
$route['imprimir-factura/(:any)'] = 'api/impresion/factura/$1';
$route['imprimir-recibo/(:any)'] = 'api/impresion/recibo/$1';
$route['imprimir-ingreso'] = 'api/impresion/ingreso';
$route['imprimir-egreso'] = 'api/impresion/egreso';
$route['imprimir-abrir-caja'] = 'api/impresion/abrirCaja';
$route['imprimir-cierre-caja'] = 'api/impresion/cierreCaja';
$route['reimprimir-factura'] = 'api/impresion/reimprimirFactura';
$route['imprimir-factura'] = 'api/impresion/imprimirFacturaAnulada';
$route['imprimir-copia-factura'] = 'api/impresion/imprimirCopiaFactura';
$route['imprimir-detalle-turno'] = 'api/impresion/imprimirDetalleTurno';
$route['abrir-gaveta'] = 'api/impresion/gaveta';


/**  USUARIOS */
$route['nuevo-usuario'] = 'usuario/save';
$route['update-usuario'] = 'usuario/update';



/** API USUARIOS */
$route['get-usuarios'] = 'api/usuarios';
$route['get-usuarios-baja'] = 'api/usuarios/conBaja';
$route['get-usuario'] = 'api/usuarios/acceso';
$route['get-usuario-venta'] = 'api/usuarios/acceso_ventas';
$route['eliminar-usuario'] = 'api/usuarios/delete';




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

/** PEDIDOS */

$route['get-perfil-pedido'] = 'api/pedido/perfil';


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
    $route['ver-cuis'] = 'facturacion/cuis/get';
    $route['activar-cuis'] = 'facturacion/cuis/activate';
    $route['inactivar-cuis'] = 'facturacion/cuis/desactivate';


    /** EVENTOS */
    $route['get-eventos'] = 'facturacion/evento/index';
    $route['nuevo-evento'] = 'facturacion/evento/create';
   
    /** CATEGORIAS */
    $route['get-categoria-1'] = 'facturacion/categoria/categoria1';



    $route['get-subcategorias'] = 'facturacion/categoria/subcategoria';
    $route['register-producto'] = 'facturacion/categoria/register';
    $route['get-productos'] = 'facturacion/categoria/index';


    /** CONFIGURACION */

        $route['get-pando'] = 'configuraciones/pando/index';
        $route['nueva-pando'] = 'configuraciones/pando/nueva';
        $route['act-dos-sp']  = 'configuraciones/pando/activar';
        $route['comanda-pando'] = 'configuraciones/pando/comanda';
        $route['set-message'] = 'configuraciones/sucursal/message';
        $route['set-impresora'] = 'configuraciones/sucursal/impresora';
        $route['set-estado-boton'] = 'configuraciones/boton/estado';
        $route['set-estado-botones'] = 'configuraciones/boton/todos';
        $route['get-acceso-botones'] = 'configuraciones/boton/sucursal';
        $route['set-configuracion-boton'] = 'configuraciones/boton/save';

    /** PRODUCTOS */
    $route['productos-segunda-categoria'] = 'configuraciones/producto/productos_segunda_categoria';
    $route['productos-madre'] = 'configuraciones/producto/productos_madre';
    $route['guardar-primera-categoria'] = 'configuraciones/producto/guardar_primera_categoria';
    $route['modificar-primera-categoria'] = 'configuraciones/producto/modificar_primera_categoria';
    $route['guardar-segunda-categoria'] = 'configuraciones/producto/guardar_segunda_categoria';
    $route['modificar-segunda-categoria'] = 'configuraciones/producto/modificar_segunda_categoria';
    $route['load-producto-madre'] = 'configuraciones/producto/producto_madre';
    $route['obtener-lista-precios'] = 'configuraciones/producto/lista_precios_producto';
    $route['guardar-nuevo-producto'] = 'configuraciones/producto/guardar_nuevo_producto';
    $route['guardar-editar-producto'] = 'configuraciones/producto/guardar_editar_producto';

    $route['eliminar-primera-categoria'] = 'configuraciones/producto/eliminar_primera_categoria';
    $route['eliminar-segunda-categoria'] = 'configuraciones/producto/eliminar_segunda_categoria';
    $route['eliminar-producto-madre'] = 'configuraciones/producto/eliminar_producto_madre';
    
    $route['imprimir-comanda/(:any)'] = 'api/impresion/imprimirComanda/$1';
    $route['reimprimir-factura-carta/(:any)'] = 'api/impresion/reimprimirFacturaCarta/$1';
    $route['reimprimir-factura-rollo/(:any)'] = 'api/impresion/reimprimirFacturaRollo/$1';
    $route['imprimir-factura-anulada-carta/(:any)'] = 'api/impresion/imprimirFacturaAnuladaCarta/$1';
    $route['imprimir-factura-anulada-rollo/(:any)'] = 'api/impresion/imprimirFacturaAnuladaRollo/$1';
    $route['imprimir-cierre-turno'] = 'api/impresion/imprimirCierreTurno';
    $route['obtener-objeto-factura/(:any)'] = 'api/impresion/obtenerObjetoFactura/$1';

    $route['reset-password'] = 'api/usuarios/reset';
    $route['update-permiso'] = 'api/usuarios/permiso';
    $route['change-password'] = 'api/venta/changePassword';
    $route['get-acceso-perfil'] = 'api/perfiles/acceso';
    $route['update-permiso-perfil'] = 'api/perfiles/update';
    $route['change-perfil'] = 'api/perfiles/change';

    $route['get-acceso-formas'] = 'api/formas/index';
    $route['update-forma'] = 'api/formas/update';


    $route['set-minimo'] = 'api/pedido/minimo';
    $route['new-perfil'] = 'api/pedido/nuevo';
    $route['clone-perfil'] = 'api/pedido/clone';

    $route['get-subcategoria'] = 'api/pedido/subcategoria';
    $route['get-producto-categoria'] = 'api/pedido/producto';
    $route['set-producto-perfil'] = 'api/pedido/producto_perfil';
    $route['guardar-declaracion'] = 'api/pedido/guardar_declaracion';
    $route['enviar-declaracion'] = 'api/pedido/enviar_declaracion';
    $route['get-minimo-stock'] = 'api/pedido/minimo_stock';
    $route['guardar-solicitud'] = 'api/pedido/guardar_solicitud';
    $route['enviar-pedido'] = 'api/pedido/enviar_solicitud';
    $route['guardar-preparacion'] = 'api/pedido/guardar_preparacion';
    $route['enviar-preparacion'] = 'api/pedido/enviar_preparacion';
    $route['guardar-recepcion'] = 'api/pedido/guardar_recepcion';
    $route['enviar-recepcion'] = 'api/pedido/enviar_recepcion';
    $route['guardar-entrega'] = 'api/pedido/guardar_entrega';
    $route['enviar-entrega'] = 'api/pedido/enviar_entrega';
    $route['abrir-declaracion'] = 'api/pedido/abrir_declaracion';
    $route['verificar-solicitud'] = 'api/pedido/verificar_solicitud';
    $route['verificar-preparacion'] = 'api/pedido/verificar_preparacion';
    $route['set-limpiar'] = 'api/pedido/set_limpiar';


    $route['guardar-pedido-extraordinario'] = 'api/pedidoextraordinario/guardar_pedido_extraordinario';
    $route['productos-primera-subcategoria-inventario'] = 'api/pedidoextraordinario/primera_subcategoria';
    $route['productos-segunda-subcategoria-inventario'] = 'api/pedidoextraordinario/segunda_subcategoria';
    $route['eliminar-pedido-extraordinario'] = 'api/pedidoextraordinario/eliminar_pedido_extraordinario';
    $route['cambiar-estado-pe'] = 'api/pedidoextraordinario/cambiar_estado_pe';
    $route['aprobacion-pe-planta'] = 'api/pedidoextraordinario/aprobacion_pe_planta';

    $route['generar-pdf-pedido/(:any)'] = 'api/impresion/generarPdfPedido/$1';


    $route['guardar-perfil'] = 'api/pedido/guardarPerfil';
    $route['guardar-totales'] = 'api/pedido/guardarTotales';

    $route['agregar-sucursal-cronograma'] = 'api/pedido/addToCronograma';
    $route['get-cronograma'] = 'api/pedido/getCronograma';
    $route['confirmar-llegada'] = 'api/pedido/confirmarLlegada';


    /****** REPORTES ******/

    $route['inventario-excel/(:any)/(:any)'] = 'report/pedido/inventario/$1/$2';
    $route['solicitud-excel/(:any)/(:any)'] = 'report/pedido/solicitud/$1/$2';
    $route['preparacion-excel/(:any)/(:any)'] = 'report/pedido/preparacion/$1/$2';
    $route['recepcion-excel/(:any)/(:any)'] = 'report/pedido/recepcion/$1/$2';
    $route['entrega-excel/(:any)/(:any)'] = 'report/pedido/entrega/$1/$2';



    /*** RECETA  ***/

    $route['receta-segunda-categoria'] = 'configuraciones/Producto/getCategoria2';
    $route['receta-producto-madre'] = 'configuraciones/Producto/getProductoMadre';
    $route['receta-producto-unico'] = 'configuraciones/Producto/getProductoUnico';
    $route['get-table-receta'] = 'configuraciones/Producto/getTableReceta';
    $route['guardar-receta'] = 'configuraciones/Producto/saveReceta';
    $route['guardar-receta-editada'] = 'configuraciones/Producto/saveRecetaEditada';
    $route['edit-table-receta'] = 'configuraciones/Producto/editReceta';
    $route['receta-borrar-logico'] = 'configuraciones/Producto/borrarLogico';

    $route['guardar-receta-combo'] = 'configuraciones/Producto/saveRecetaCombo';







   


    

















