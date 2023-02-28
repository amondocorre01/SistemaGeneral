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
    $tipo_reporte = $this->input->get('tipo_reporte');
    $id_usuario_seleccionado = $this->input->get('usuario');
    if(!$fecha_reporte){
        $fecha_reporte = date('Y-m-d');
    }
    if(!$tipo_reporte){
      $tipo_reporte = 'ALL';
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
                <input class="form-control" id="fecha_reporte" type="date" name="fecha_reporte" value="<?=$fecha_reporte?>" >
            </div>

            <div class="col-md-3">
              <div class="form-group">
                  <label>Seleccione</label>
                  <select name="tipo_reporte" class="form-control" style="width: 100%;">
                    <?php foreach ($turno as $value) : ?>
                      <option value="<?=$value->TURNO?>"><?=$value->TURNO?></option>
                    <?php endforeach; ?>
                  </select>
              </div>
            </div>

            <div class="col-md-2">
                <input  name="vc" type="hidden" id="fecha" value="<?=$this->input->get('vc')?>">
                <input class="btn btn-primary btn-form-search" type="submit" value="Buscar" name="buscar" >
            </div>

            <?php if($fecha_reporte == date('Y-m-d')): ?>
            <div class="col-md-2">
              <span form="totales" onclick="guardarTotales()" class="btn btn-primary btn-form-search">Guardar</span>
            </div>
            <?php endif; ?>
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
  $pedidoSucursal = getPedidoSucursal($codigo_bd, $sufijo_bd, $fecha_reporte, $tipo_reporte);
  $listas_pedidos_sucursal[$codigo_bd] = $pedidoSucursal;
}
?>
<div class="card">
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x:auto;">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="9%">Categoria</th>
                    <th width="9%">Subcategoria</th>
                    <th width="9%">Producto</th>
                    <th width="9%">Tipo de producto</th>
                    <?php
                    foreach ($sucursales as $key => $sucursal) {
                        echo '<th width="9%">'.$sucursal->SUCURSAL_BI.'</th>';
                    }
                    ?>
                    <th width="8%">Total</th>
                   <?php if($fecha_reporte == date('Y-m-d')): ?>
                    <th width="8%">Recibida</th>
					          <th width="8%">Cargado</th>
                    <?php endif;?>
                  </tr>
                  </thead>
                  <tbody id="cantidadTotales">
                    <form id="totales">
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
                            $checked = ($producto->ESTADO)?'checked onclick="return false;"':'';
                            $readonly = ($producto->ESTADO)?' readonly ':'';
                            $recibida = ($producto->RECIBIDA>0)? $producto->RECIBIDA : $sum;
                            $columna = '<tr>
                            <td>'.$producto->CATEGORIA.'</td>
                            <td>'.$producto->SUB_CATEGORIA_1.'</td>
                            <td>'.$producto->SUB_CATEGORIA_2.'</td>
                            <td></td>
                            '.$col.'
                            <td>'.$sum.'</td>';
                            if($fecha_reporte == date('Y-m-d')):
                      $columna .=     '<td>
                              <input name="'.$id_subcategoria_2.'[recibida]" type="number"'.$readonly.'value="'.$recibida.'">
                            </td>  
							            <td>
                              <input name="'.$id_subcategoria_2.'[total]" value="1" '.$checked.' type="checkbox">
                              <input name="'.$id_subcategoria_2.'[cantidad]" value="'.$sum.'" type="hidden">
                          </td>';
                            endif;

                       $columna .= '</tr>';
                            if($sum != 0){
                              echo $columna;
                              guardarProducto($id_subcategoria_2, $sum);
                            }
                           
                        }
                    ?>
                    </form>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
<form id="form_print" method="post" action="<?=site_url('imprimir-cierre-turno')?>" target="_blank">
<input type="hidden" id="data_print" name="data_print" />
</form>

<script>
  $('.btn-form-search').on('click',function(){
      $('.loading').show();
    });


  function guardarTotales() {

    var collection = $('#cantidadTotales form').serialize();
      
    $.post("<?=site_url('guardar-totales')?>", collection)
      .done(function( data ) {
        $('.loading').hide();


        dato = JSON.parse(data);
               
          if(dato.status == true) {

            Swal.fire({
                icon: 'success',
                title: "Se ha guardado correctamente",
                timer: 4500
            });

          }

          else 
          {
            Swal.fire({
                icon: 'error',
                title: "No habia nada que actualizar",
                timer: 4500
            });
          }


      });
  }
</script>