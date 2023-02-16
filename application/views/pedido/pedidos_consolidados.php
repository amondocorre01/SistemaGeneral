<br>
<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.min.css')?>">
<link rel="stylesheet" href="<?=base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')?>">
<?php
    $this->session->set_userdata('datatable', 'true');
    
    $fecha_reporte = $this->input->get('fecha_reporte');
    $id_usuario_seleccionado = $this->input->get('usuario');
    if(!$fecha_reporte){
        $fecha_reporte = date('Y-m-d');
    }
    $fecha_r = date("d/m/Y", strtotime($fecha_reporte));
    $this->session->set_userdata('title', 'Pedidos Consolidados '.$fecha_r);

    $id_menu = intval($this->input->get('vc'));
    $id_usuario = $this->session->id_usuario;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Tabla consolidada de pedidos </h3>
        </div>
        
        <div class="card-body">
        <form action="<?=current_url()?>" method="GET" id="form_fecha">
        <div class="row">
        
            <div class="col-offset-1 col-md-3">
                <label for="">Seleccione Fecha</label>
                <input class="form-control" type="date" name="fecha_reporte" value="<?=$fecha_reporte?>" >
            </div>

            <div class="col-md-3">
            <input  name="vc" type="hidden" id="fecha" value="<?=$this->input->get('vc')?>">
                <input class="btn btn-primary btn-form-search" type="submit" value="Buscar" name="buscar" >
            </div>
        </div>
        </form>
        </div>
        </div>
    </div>
</div>
<?php
function searchSubcategoria(){
  
}
$sucursales = getSucursales();
$productosSub2 = getInventariosSubcategoria2();

$listas_pedidos_sucursal = array();
foreach ($sucursales as $key => $sucursal) {
  $codigo_bd = $sucursal->CODIGO;
  $sufijo_bd = $sucursal->SUFIJO; 
  $pedidoSucursal = getPedidoSucursal($codigo_bd, $sufijo_bd, $fecha_reporte);
  $listas_pedidos_sucursal[$codigo_bd] = $pedidoSucursal;
}
?>
<div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Categoria</th>
                    <th>Subcategoria</th>
                    <th>Producto</th>
                    <th>Tipo de producto</th>
                    <?php
                    foreach ($sucursales as $key => $sucursal) {
                        echo '<th>'.$sucursal->SUCURSAL_BI.'</th>';
                    }
                    ?>
                    <th>Total</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        foreach ($productosSub2 as $key => $producto) {
                            $col='';
                            $sum=0;
                            $id_subcategoria_2 = $producto->ID_SUB_CATEGORIA_2;
                            foreach ($sucursales as $key => $sucursal) {
                              $codigo_bd = $sucursal->CODIGO; 
                              $lista = $listas_pedidos_sucursal[$codigo_bd];                              
                              $total_suc= buscarCantidadSubcategoria2($lista,$id_subcategoria_2);
                              $col = $col.'<td>'.$total_suc.'</td>';
                              $sum = $sum+$total_suc;
                            }
                            $columna = '<tr>
                            <td>'.$producto->CATEGORIA.'</td>
                            <td>'.$producto->SUB_CATEGORIA_1.'</td>
                            <td>'.$producto->SUB_CATEGORIA_2.'</td>
                            <td></td>
                            '.$col.'
                            <td>'.$sum.'</td>
                            </tr>';
                            if($sum != 0){
                              echo $columna;
                            }
                        }
                    ?>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
<form id="form_print" method="post" action="<?=site_url('imprimir-cierre-turno')?>" target="_blank">
<input type="hidden" id="data_print" name="data_print" />
</form>

