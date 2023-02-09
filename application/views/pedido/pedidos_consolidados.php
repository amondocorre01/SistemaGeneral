<br>
<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.min.css')?>">
<link rel="stylesheet" href="<?=base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')?>">
<?php
    
    $fecha_inicial = $this->input->get('fecha_inicial');
    $fecha_final = $this->input->get('fecha_final');
    $id_usuario_seleccionado = $this->input->get('usuario');
    if(!$fecha_inicial){
        $fecha_inicial = date('Y-m-d');
        $fecha_final = date('Y-m-d');
    }
    if($id_usuario_seleccionado){
        $sql = "select * from CIERRE_APERTURA_TURNO where ID_USUARIO='$id_usuario_seleccionado' and FECHA BETWEEN '$fecha_inicial' and '$fecha_final';";
    }else{
        $sql = "select * from CIERRE_APERTURA_TURNO where FECHA BETWEEN '$fecha_inicial' and '$fecha_final';";
    }
 

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
                <input class="form-control" type="date" name="fecha_inicial" value="<?=$fecha_inicial?>" >
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

function buscarCantidadSubcategoria2($pedidoSucursal, $subcategoria){
  $encontrado = false;
  $i=0;
  $cant = 0;
  while ($i < count($pedidoSucursal) && $encontrado ==false) {
    $sub = $pedidoSucursal[$i]->ID_SUBCATEGORIA_2;
    if($sub == $subcategoria){
      $cant = $pedidoSucursal[$i]->CANTIDAD;
      $encontrado = true;
    }
    $i++;
  }
  return $cant;
}

$listas_pedidos_sucursal = array();
foreach ($sucursales as $key => $sucursal) {
  $codigo_bd = $sucursal->CODIGO;
  $sufijo_bd = $sucursal->SUFIJO; 
  $pedidoSucursal = getPedidoSucursal($codigo_bd, $sufijo_bd);
  $listas_pedidos_sucursal[$codigo_bd] = $pedidoSucursal;
}
//print_r($listas_pedidos_sucursal['aeste']);
//exit();
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
                            echo '<tr>
                            <td>'.$producto->CATEGORIA.'</td>
                            <td>'.$producto->SUB_CATEGORIA_1.'</td>
                            <td>'.$producto->SUB_CATEGORIA_2.'</td>
                            <td></td>
                            '.$col.'
                            <td>'.$sum.'</td>
                            </tr>';
                            
                        }
                    ?>
                  </tfoot>
                </table>
                <!--<table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Acciones</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Hora de apertura</th>
                    <th>Hora de cierre</th>
                    <th>Monto de apertura</th>
                    <th>Monto de cierre</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                        /*foreach ($respuesta as $key => $value) {
                            $name_usuario = searchUsuario($usuarios, $value->ID_USUARIO);
                            echo '<tr>
                            <td><a class="btn btn-primary btn-info btn-xs" usuario="'.$name_usuario.'" turno="'.$value->ID_CIERRE_APERTURA_TURNO.'" data-toggle="modal" data-target="#modalVerDetalleTurno" onclick="abrirDetalleTurno(this)" title="Ver Detalle"><i class="las la-eye"></i></a></td>
                            <td>'.$name_usuario.'</td>
                            <td>'.$value->FECHA.'</td>
                            <td>'.$value->HORA_APERTURA.'</td>
                            <td>'.$value->HORA_CIERRE.'</td>
                            <td>'.$value->MONTO_APERTURA.'</td>
                            <td>'.$value->MONTO_CIERRE.'</td>
                            </tr>';
                            
                        }*/
                    ?>
                  </tfoot>
                </table>-->
              </div>
              <!-- /.card-body -->
            </div>

<div class="modal fade" id="modalVerDetalleTurno">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detalle de Turno</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="box-body detalleTurno">
                </div>
            </div>
            
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              <!--<button type="button" class="btn btn-primary"  onclick="imprimirDetalleTurno()">Imprimir</button>-->
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<form id="form_print" method="post" action="<?=site_url('imprimir-cierre-turno')?>" target="_blank">
<input type="hidden" id="data_print" name="data_print" />
</form>
<script>

</script>

