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
    $resultado = null;
    $nombre_codigo_sucursal = $sucursal;
    $DB2 = $this->load->database($nombre_codigo_sucursal, TRUE);
    $datos_sucursal= getSucursal($nombre_codigo_sucursal);
    $prefix = $datos_sucursal->PREFIJO;
    $sufix = $datos_sucursal->SUFIJO;
    $cod_id_sucursal = $datos_sucursal->CODIGO_SUCURSAL;
    $name_impresora = IMPRESORA_LOCAL;
    $descripcion_sucursal = $datos_sucursal->DESCRIPCION;
    $this->session->set_userdata('ubicacion_seleccionada', $datos_sucursal);
   
    $usuarios = $this->session->userdata('usuarios');
    $usuarios_encode = json_encode($usuarios);
    
    $fecha_inicial = $this->input->get('fecha_inicial');
    $fecha_final = $this->input->get('fecha_final');
    $usuario_seleccionado = $this->input->get('usuario');
    if(!$fecha_inicial){
        $fecha_inicial = date('Y-m-d');
        $fecha_final = date('Y-m-d');
    }
    if($usuario_seleccionado){
        $sql = "select * from CIERRE_APERTURA_TURNO".$sufix." where ID_USUARIO='$usuario_seleccionado' and FECHA BETWEEN '$fecha_inicial' and '$fecha_final';";
    }else{
        $sql = "select * from CIERRE_APERTURA_TURNO".$sufix." where FECHA BETWEEN '$fecha_inicial' and '$fecha_final';";
    }
    
    $respuesta = $DB2->query($sql);
    $respuesta = $respuesta->result();
    //
    
   
    $resultado = json_encode($respuesta);

    $id_menu = intval($this->input->get('vc'));
    $id_usuario = $this->session->id_usuario;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Reporte Cierre de Turno - <?=$descripcion_sucursal?></h3>
        </div>
        
        <div class="card-body">
        <form action="<?=current_url()?>" method="GET" id="form_fecha">
        <div class="row">
        
            <div class="col-offset-1 col-md-3">
                <label for="">Fecha Inicial</label>
                <input class="form-control" type="date" name="fecha_inicial" value="<?=$fecha_inicial?>" >
            </div>
                

            <div class="col-md-3">
                <label for="">Fecha Final</label>
                <input class="form-control" type="date" name="fecha_final" value="<?=$fecha_final?>"  >
            </div>

            <div class="col-md-3">
                <div class="form-group">
                  <label>Seleccione Usuario</label>
                  <select name="usuario" class="form-control select2" style="width: 100%;">
                    <option value="" selected="selected">Seleccione el usuario</option>
                    <?php
                        foreach ($usuarios as $key => $value) {
                            $usuario = $value->NOMBRE.' '.$value->AP_PATERNO.' '.$value->AP_MATERNO;
                            $sel='';
                            if($usuario_seleccionado){
                                if($usuario_seleccionado == $value->ID_USUARIO){
                                    $sel = 'selected="selected"';
                                }
                            }
                            echo '<option '.$sel.' value="'.$value->ID_USUARIO.'">'.$usuario.'</option>';
                        }
                    ?>
                  </select>
                </div>
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

<div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
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
                        foreach ($respuesta as $key => $value) {
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
                            
                        }
                    ?>
                  </tfoot>
                </table>
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

<script>

function abrirDetalleTurno(element){
    $('.detalleTurno').html("<center>Cargando datos...</center>");
    var turno = $(element).attr('turno');
    var usuario = $(element).attr('usuario');
    //console.log('Hello world',turno);
    var datos = new FormData();
    datos.append("loadDetalleTurno",'1');
    datos.append("turno",turno);
    datos.append("usuario",usuario);
    datos.append("bd","<?=$nombre_codigo_sucursal?>");
    datos.append("sufijo","<?=$sufix?>");
    datos.append("prefijo","<?=$prefix?>");
    datos.append("descripcion_sucursal","<?=$descripcion_sucursal?>");
    $.ajax({
        url: "<?=site_url('detalle-turno')?>",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "html",
        success:function(respuesta){
            if(respuesta){
                console.log(respuesta);
                $('.detalleTurno').html(respuesta);
                //$('.detalleTurno').append(respuesta);
            }
        },
        error: function (error){
            console.log(error.responseText);
        }
    });
}

function imprimirDetalleTurno(){
  /*
     var contenido=$('.detalleTurno').html();
     var contenidoOriginal= document.body.innerHTML;
     document.body.innerHTML = contenido;
     window.print();
     document.body.innerHTML = contenidoOriginal;
     window.location.reload();*/
  var url= "<?=site_url('imprimir-detalle-turno')?>";
  window.open(url,'_blank');
}

</script>
