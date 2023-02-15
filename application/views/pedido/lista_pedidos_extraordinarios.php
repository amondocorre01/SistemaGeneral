<?php
$protocolo = protocoloWeb();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$current_url = $protocolo.$host.$url;

$id_usuario = $this->session->id_usuario;
$sucursales = getSucursalesUsuario($id_usuario);

$sucursal_seleccionado = $this->input->get('codigo_sucursal');
$fecha_pedido = $this->input->get('fecha_pedido');
if(!$fecha_pedido){
    $fecha_pedido = date('Y-m-d');
}
$pedidos_extraordinarios = [];
$descripcion_sucursal = '';
if($sucursal_seleccionado){
    $datos_sucursal= getSucursal($sucursal_seleccionado);
    $id_ubicacion_sucursal = $datos_sucursal->ID_UBICACION;
    $prefijo_sucursal = $datos_sucursal->PREFIJO;
    $sufijo_sucursal = $datos_sucursal->SUFIJO;
    $descripcion_sucursal = $datos_sucursal->DESCRIPCION;
    $sucursal_seleccionado='ventas';
    $sufijo_sucursal = '_AE';
    $pedidos_extraordinarios = getPedidosExtraordinarios($sucursal_seleccionado, $sufijo_sucursal, $fecha_pedido);
}


?>
<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.min.css')?>">
<link rel="stylesheet" href="<?=base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')?>">
<?php
    $this->session->set_userdata('datatable', 'true');
    $this->session->set_userdata('title', 'Pedidos extraordinarios '.$descripcion_sucursal);
    $id_menu = intval($this->input->get('vc'));
    $id_usuario = $this->session->id_usuario;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Pedidos extraordinarios </h3>
        </div>
        
        <div class="card-body">
        <form action="<?=$current_url?>" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                    <label>Sucursal</label>
                    <select name="codigo_sucursal" id="codigo_sucursal" class="form-control select2" style="width: 100%;">
                        <option value="" selected="selected">Seleccione la sucursal</option>
                        <?php
                            foreach ($sucursales as $key => $sucursal) {
                                $sel = $sucursal_seleccionado ? ($sucursal_seleccionado == $sucursal->CODIGO ?'selected="selected"':''): '';
                                echo '<option '.$sel.' value="'.$sucursal->CODIGO.'">'.$sucursal->SUCURSAL_BI.'</option>';
                            }
                        ?>
                    </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Seleccione Fecha de entrega</label>
                    <input class="form-control" type="date" id="fecha_pedido" name="fecha_pedido" value="<?=$fecha_pedido?>" >
                </div>
                <div class="col-md-3">
                <input  name="vc" type="hidden" id="fecha" value="<?=$this->input->get('vc')?>">
                    <input class="btn btn-primary btn-form-search" type="submit" value="Buscar" name="buscar" >
                </div>
                
            </div>
            </form>
            <br>
            <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="text-center">Categoria</th>
                <th class="text-center">Subcategoria</th>
                <th class="text-center">Producto</th>
                <th class="text-center">Detalle</th>
                <th class="text-center">P.Modificado</th>
                <th class="text-center">Fecha de entrega</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($pedidos_extraordinarios as $key => $pedido) {
                        $categoria_1 = getNombreCategoria1(($pedido->CATEGORIA_1));
                        $categoria_2 = getNombreCategoria2(($pedido->CATEGORIA_2));
                        $producto = getNombreProducto(($pedido->PRODUCTO_MADRE));
                        $modificado = $pedido->MODIFICADO == 1 ?'SI':'NO';
                        $fecha_pedido = date("d/m/Y H:i:s", strtotime(($pedido->FECHA_PEDIDO)));
                        echo '<tr>
                                <td>'.$categoria_1->CATEGORIA.'</td>
                                <td>'.$categoria_2->CATEGORIA_2.'</td>
                                <td>'.$producto->PRODUCTO_MADRE.'</td>
                                <td>'.$pedido->DETALLE.'</td>
                                <td>'.$modificado.'</td>
                                <td>'.$fecha_pedido.'</td>
                              </tr>';
                    }
                ?>
            </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

});
</script>

