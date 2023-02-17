<?php
$protocolo = protocoloWeb();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$current_url = $protocolo.$host.$url;

$id_usuario = $this->session->id_usuario;
$sucursales = getSucursalesUsuario($id_usuario);

$sucursal_seleccionado = $this->input->get('codigo_sucursal');
$fecha_entrega = $this->input->get('fecha_entrega');
if(!$fecha_entrega){
    $fecha_entrega = date('Y-m-d');
}
$fecha_entrega_inicial = $this->input->get('fecha_entrega_inicial');
if(!$fecha_entrega_inicial){
    $fecha_entrega_inicial = date('Y-m-d');
}
$pedidos_extraordinarios = [];
$descripcion_sucursal = '';
if($sucursal_seleccionado){
    /* $sucursal_seleccionado='ventas';
    $sufijo_sucursal = '_AE'; */
    $datos_sucursal= getSucursal($sucursal_seleccionado);
    $id_ubicacion_sucursal = $datos_sucursal->ID_UBICACION;
    $prefijo_sucursal = $datos_sucursal->PREFIJO;
    $sufijo_sucursal = $datos_sucursal->SUFIJO;
    $descripcion_sucursal = $datos_sucursal->SUCURSAL_BI;
    
    $pedidos_extraordinarios = getPedidosExtraordinarios($sucursal_seleccionado, $sufijo_sucursal, $fecha_entrega_inicial, $fecha_entrega);
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
    $_SESSION['form-validate']='1';
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
                    <select name="codigo_sucursal" class="form-control select2" style="width: 100%;">
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
                    <label for="">Seleccione Fecha inicial</label>
                    <input class="form-control" type="date" name="fecha_entrega_inicial" value="<?=$fecha_entrega_inicial?>" >
                </div>
                <div class="col-md-3">
                    <label for="">Seleccione Fecha final</label>
                    <input class="form-control" type="date" name="fecha_entrega" value="<?=$fecha_entrega?>" >
                </div>
                <div class="col-md-3">
                <input  name="vc" type="hidden" id="fecha" value="<?=$this->input->get('vc')?>">
                    <input class="btn btn-primary btn-form-search" type="submit" value="Buscar" name="buscar" >
                </div>
                
            </div>
            </form>
             <button class="btn btn-primary btn-nuevo-pe float-left btn-xs"><i class="fa-regular fa-plus"></i> Agregar pedido extraordinario</button>

            <br>
            <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="text-center">Sucursal</th>
                <th class="text-center">Categoria</th>
                <th class="text-center">Subcategoria</th>
                <th class="text-center">Producto</th>
                <th class="text-center">Detalle</th>
                <th class="text-center">P.Modificado</th>
                <th class="text-center">Fecha de entrega</th>
                <th class="text-center no-exportar">Acciones</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($pedidos_extraordinarios as $key => $pedido) {
                        $categoria_1 = getNombreCategoria1(($pedido->CATEGORIA_1));
                        $categoria_2 = getNombreCategoria2(($pedido->CATEGORIA_2));
                        $producto = getNombreProducto(($pedido->PRODUCTO_MADRE));
                        $modificado = $pedido->MODIFICADO == 1 ?'SI':'NO';
                        $fecha_entrega = date("d/m/Y", strtotime(($pedido->FECHA_ENTREGA_PEDIDO)));
                        $id_pedido_extraordinario = $pedido->ID_PEDIDO_EXTRAORDINARIO;
                        $aprobado = $pedido->APROBADO;
                        if($aprobado){
                          $btn_class_aprobar='btn-success';
                          $btn_accept_enabled='disabled';
                        }else{
                          $btn_class_aprobar='btn-info';
                          $btn_accept_enabled='';
                        }
                        $btn_delete='<button class="btn btn-primary btn-danger btn-xs" codigo_sucursal="'.$sucursal_seleccionado.'" sufijo_sucursal="'.$sufijo_sucursal.'" iden="'.$id_pedido_extraordinario.'" onclick="onClickEliminarProductoExtraordinario(this)" title="Eliminar pedido extraordinario"><i class="las la-times"></i></button>';
                        $btn_accept='<button '.$btn_accept_enabled.' class="btn '.$btn_class_aprobar.' btn-xs" codigo_sucursal="'.$sucursal_seleccionado.'" sufijo_sucursal="'.$sufijo_sucursal.'" iden="'.$id_pedido_extraordinario.'" onclick="onClickAprobarPE(this)" title="Aprobar pedido extraordinario"><i class="las la-check"></i></button>';
                        echo '<tr>
                                <td>'.$descripcion_sucursal.'</td>
                                <td>'.$categoria_1->CATEGORIA.'</td>
                                <td>'.$categoria_2->SUB_CATEGORIA_1.'</td>
                                <td>'.$producto->SUB_CATEGORIA_2.'</td>
                                <td>'.$pedido->DETALLE.'</td>
                                <td align="center">'.$modificado.'</td>
                                <td align="center">'.$fecha_entrega.'</td>
                                <td align="center">'.$btn_accept.$btn_delete.'</td>
                              </tr>';
                    }
                ?>
            </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAgregarProductoExtraordinario">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Pedido extraordinario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-body">
                <form id="form-product-new-update" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-3">
                              <div class="form-group">
                                <label>Sucursal</label>
                                <select name="codigo_sucursal" id="codigo_sucursal" class="form-control select2" style="width: 100%;">
                                  <option value="" selected="selected">Seleccione la sucursal</option>
                                  <?php
                                      foreach ($sucursales as $key => $sucursal) {
                                          echo '<option value="'.$sucursal->CODIGO.'">'.$sucursal->SUCURSAL_BI.'</option>';
                                      }
                                  ?>
                                </select>
                              </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Categoria</label>
                                <select name="productoCategoria1" id="productoCategoria1" class="form-control select2" style="width: 100%;">
                                <option value="" selected="selected">Seleccione la primera categoria</option>
                                <?php
                                    foreach ($primeraCategoria as $key => $value) {
                                        echo '<option '.$sel.' value="'.$value->ID_CATEGORIA.'">'.$value->CATEGORIA.'</option>';
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Subcategoria</label>
                                <select name="productoCategoria2" id="productoCategoria2" class="form-control select2" style="width: 100%;">
                                <option value="" selected="selected">Seleccione la segunda categoria</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Seleccione el producto</label>
                                <select name="productoMadre" id="productoMadre" class="form-control select2" style="width: 100%;">
                                <option value="" selected="selected">Seleccione el producto</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-offset-1 col-md-3">
                            <div class="form-group form-group-sm">
                                <label for="">Seleccione Fecha de entrega</label>
                                <input class="form-control" type="date" id="fecha_entrega" name="fecha_entrega" min="<?=date('Y-m-d')?>" >
                        
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-9">
                        <div class="form-group">
                            <label>Detalle del pedido extraordinario</label>
                            <textarea class="form-control input-sm " rows="4" id="detalleProducto" name="detalle" placeholder="Ingrese el detalle."><?php echo strip_tags('');?></textarea>
                        </div>
                      </div>  
                      <div class="col-md-3">
                        <div class="row">
                            <label class="col-sm-12 ">¿Se modificará el producto?</label>
                            <div class="form-group col-sm-4">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="radio" name="modificaraProducto" id="transporteNo" value="0" checked>
                                <label for="transporteNo" class="custom-control-label">NO</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="radio" name="modificaraProducto" id="transporteSi" value="1">
                                <label for="transporteSi" class="custom-control-label">SI</label>
                            </div>
                            </div>
                        </div>
                      </div>  
                    </div>
                    <div> 
                      <center>
                        <button type="submit" class="btn btn-primary" id="guardarPedidoExtraordinario" >Guardar</button>
                      </center>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#productoCategoria2').prop( "disabled", true );
    $('#productoMadre').prop( "disabled", true );

    $('.btn-nuevo-pe').on('click',function(){
        $('#modalAgregarProductoExtraordinario').modal("show");
    });
    function guardarPedidoExtraordinario() {
      var texto_sucursal = $('#codigo_sucursal option:selected').html();
      var texto_categoria = $('#productoCategoria1 option:selected').html();
      var texto_subcategoria1 = $('#productoCategoria2 option:selected').html();
      var texto_subcategoria2 = $('#productoMadre option:selected').html();

      var codigo_sucursal = $('#codigo_sucursal').val();
      var productoCategoria1 = $('#productoCategoria1').val();
      var productoCategoria2 = $('#productoCategoria2').val();
      var productoMadre = $('#productoMadre').val();
      var detalleProducto = $('#detalleProducto').val();
      var fecha_entrega = $('#fecha_entrega').val();
      var modificaraProducto = $('input[type=radio][name=modificaraProducto]:checked').val();
      $('.loading').show();
      var datos = new FormData();
      datos.append("codigo_sucursal",codigo_sucursal);
      datos.append("categoria_1",productoCategoria1);
      datos.append("categoria_2",productoCategoria2);
      datos.append("producto_madre",productoMadre);
      datos.append("detalle_producto",detalleProducto);
      datos.append("modificara_producto",modificaraProducto);
      datos.append("fecha_entrega",fecha_entrega);
      $.ajax({
          method:'POST',
          url:'<?=site_url("guardar-pedido-extraordinario")?>',
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success:function(respuesta){
            if(respuesta.estado){
              $('.loading').hide();
              Swal.fire({
                icon: 'success',
                title: 'Se ha guardado correctamente.',
                timer: 1500
              });
              var codigo_sucursal = respuesta.codigo_sucursal;
              var sufijo_sucursal = respuesta.sufijo_sucursal;
              var id_pedido_extraordinario = respuesta.iden;
              var modificado = respuesta.modificado;
              var fecha_entrega = respuesta.fecha_entrega;
              var btn_delete = `<button class="btn btn-danger btn-xs" codigo_sucursal="${codigo_sucursal}" sufijo_sucursal="${sufijo_sucursal}" iden="${id_pedido_extraordinario}" onclick="onClickEliminarProductoExtraordinario(this)" title="Eliminar pedido extraordinario"><i class="las la-times"></i></button>`;
              var btn_change_estado = `<button class="btn btn-info btn-info btn-xs" codigo_sucursal="${codigo_sucursal}" sufijo_sucursal="${sufijo_sucursal}" iden="${id_pedido_extraordinario}" onclick="onClickAprobarPE(this)" title="Aprobar pedido extraordinario"><i class="las la-check"></i></button>`;
              var btn_actions = btn_change_estado + btn_delete;
              $('#modalAgregarProductoExtraordinario').modal("hide");
              var table = $('#example1').DataTable();
              $('#form-product-new-update').trigger("reset");
              $('#codigo_sucursal').select2();
              $('#productoCategoria1').select2();
              $('#productoCategoria2').select2();
              $('#productoCategoria2').prop( "disabled", true );
              $('#productoMadre').select2();
              $('#productoMadre').prop( "disabled", true );

              table.row.add([texto_sucursal,texto_categoria,texto_subcategoria1,texto_subcategoria2,detalleProducto,modificado,fecha_entrega,btn_actions]).draw(false);
              /* var curr_url = "<?=$current_url?>"
              var comp_url = `${curr_url}&codigo_sucursal=${respuesta.sucursal}&fecha_entrega=${respuesta.fecha_entrega}`;
              window.location.href = comp_url; */
            }else{
                $('.loading').hide();
              Swal.fire({
                icon: 'error',
                title: 'Ocurrio un error.',
                timer: 3500
              });
            }
          }
      });
    }

    $('#productoCategoria1').on('change',function(){
        var primera_categoria_id = $(this).val();
        var texto_seleccionado = $('#productoCategoria1 option:selected').html();
        $('#agregarEditarProducto').hide();

        $('.btnEditarSC').hide();
        $('.btnEliminarSC').hide();

        $('.btnAgregarPM').hide();
        $('.btnEditarPM').hide();
        $('.btnEliminarPM').hide();
        if(primera_categoria_id != ''){
          $('.btnEditarPC').show();
          $('.btnEliminarPC').show();
          $('.btnAgregarSC').show();
        }else{
          $('.btnEditarPC').hide();
          $('.btnEliminarPC').hide();

          $('.btnAgregarSC').hide();
          $('.btnEditarSC').hide();
          $('.btnEliminarSC').hide();

          $('.btnAgregarPM').hide();
          $('.btnEditarPM').hide();
          $('.btnEliminarPM').hide();
        }
        $('#productoCategoria2').prop( "disabled", true );
        $('#productoMadre').prop( "disabled", true );
        var datos = new FormData();
        datos.append("primera_categoria_id",primera_categoria_id);
        datos.append("texto_seleccionado",texto_seleccionado);
        $('#productoCategoria2').html('<option value="">Cargando segunda categoria ...</option>'); 
        if(primera_categoria_id){
            $.ajax({
                method:'POST',
                url:'<?=site_url("productos-primera-subcategoria-inventario")?>',
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success:function(html){
                  $('#productoCategoria2').prop( "disabled", false );
                    $('#productoCategoria2').html(html);
                    $('#productoMadre').html('<option value="">Seleccione segunda categoria</option>'); 
                    //$('#iglesia').html('<option value="">Seleccione una zona primero</option>'); 
                }
            }); 
        }else{
            $('#productoCategoria2').html('<option value="">Seleccione primera categoria</option>');
            $('#productoMadre').html('<option value="">Seleccione segunda categoria</option>'); 
            //$('#iglesia').html('<option value="">Seleccione una zona primero</option>'); 
        }
    });
    
    $('#productoCategoria2').on('change',function(){
        var segunda_categoria_id = $(this).val();
        var texto_seleccionado = $('#productoCategoria2 option:selected').html();
        $('#agregarEditarProducto').hide();
        $('.btnEditarPM').hide();
        $('.btnEliminarPM').hide();
        if(segunda_categoria_id != ''){
          $('.btnEditarSC').show();
          $('.btnEliminarSC').show();
          $('.btnAgregarPM').show();
        }else{
          $('.btnEditarSC').hide();
          $('.btnEliminarSC').hide();

          $('.btnAgregarPM').hide();
          $('.btnEditarPM').hide();
          $('.btnEliminarPM').hide();
        }
        $('#productoMadre').prop( "disabled", true );
        var datos = new FormData();
        datos.append("segunda_categoria_id",segunda_categoria_id);
        datos.append("texto_seleccionado",texto_seleccionado);

        $('#productoMadre').html('<option value="">Cargando productos...</option>'); 
        if(segunda_categoria_id){
            $.ajax({
                method:'POST',
                url:'<?=site_url("productos-segunda-subcategoria-inventario")?>',
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success:function(html){
                    $('#productoMadre').prop( "disabled", false );
                    $('#productoMadre').html(html);
                    //$('#iglesia').html('<option value="">Seleccione segunda categoria</option>'); 
                }
            }); 
        }else{
            $('#productoMadre').html('<option value="">Seleccione segunda categoria</option>'); 
            //$('#iglesia').html('<option value="">Seleccione una zona primero</option>'); 
        }
    });
    
    $('#productoMadre').on('change',function(){
        var producto_madre_id = $(this).val();
        if(producto_madre_id != ''){
          $('.btnEditarPM').show();
          $('.btnEliminarPM').show();
        }else{
          $('.btnEditarPM').hide();
          $('.btnEliminarPM').hide();
        }
        $('#agregarEditarProducto').hide();
    });

    $(function () {
      $.validator.setDefaults({
    
      submitHandler: function () {
        //alert( "Form successful submitted!" );
        guardarPedidoExtraordinario();
      }
      });
      $('#form-product-new-update').validate({
      rules: {
        codigo_sucursal: {
          required: true
        },
        productoCategoria1: {
          required: true
        },
        productoCategoria2:{
          required: true
        },
        productoMadre:{
          required: true
        },
        detalle:{
          required: true
        },
        fecha_entrega:{
          required: true
        }
      },
      messages: {
        codigo_sucursal: {
          required: "Seleccione la sucursal",
        },
        productoCategoria1: {
          required: "Seleccione categoria 1",
        },
        productoCategoria2: {
          required: "Seleccione categoria 2",
        },
        productoMadre:{
          required: "Seleccione el producto",
        },
        detalle:{
          required: "Detalle es requerido",
        },
        fecha_entrega:{
          required: "Seleccione fecha de entrega",
        }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
      });
    });

    $('.btn-form-search').on('click',function(){
      $('.loading').show();
    });
});

function onClickEliminarProductoExtraordinario(element){
    swal.fire({
    icon: "error",
    title: "¿Estás seguro?",
    text: "Se eliminará el pedido extraordinario.",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Continuar"
    }).then((result) => {
        if (result.isConfirmed) {
        var iden = $(element).attr('iden');
        var sc = updateEstadoPE(element);
        }
    });
  }
function onClickAprobarPE(element){
  swal.fire({
    title: "¿Estás seguro?",
    text: "Se aprobara el pedido extraordinario.",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Continuar"
    }).then((result) => {
        if (result.isConfirmed) {
        var iden = $(element).attr('iden');
        var sc = updateEstadoAprobadoPE(element);
        }
    });
}

function updateEstadoPE(element){
    var iden = $(element).attr('iden');
    var codigo_sucursal = $(element).attr('codigo_sucursal');
    var sufijo_sucursal = $(element).attr('sufijo_sucursal');
    console.log('Se cambiara',iden);
    var datos = new FormData();
    datos.append("updateEstadoPE",'1');
    datos.append("iden",iden);
    datos.append("codigo_sucursal",codigo_sucursal);
    datos.append("sufijo_sucursal",sufijo_sucursal);
    $('.loading').show();
    $.ajax({
        method:'POST',
        url:'<?=site_url("eliminar-pedido-extraordinario")?>',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            $('.loading').hide();
            if(respuesta.estado){
                Swal.fire({
                    icon: 'success',
                    title: 'Se ha eliminado el pedido exitosamente',
                    timer: 4500
                });
                $(element).parents('tr').remove();
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Ocurrio un error inesperado.',
                    timer: 4500
                });
            }
        }
    });
    
}
function updateEstadoAprobadoPE(element){
    var iden = $(element).attr('iden');
    var codigo_sucursal = $(element).attr('codigo_sucursal');
    var sufijo_sucursal = $(element).attr('sufijo_sucursal');
    console.log('Se cambiara',iden);
    var datos = new FormData();
    datos.append("updateEstadoPE",'1');
    datos.append("iden",iden);
    datos.append("codigo_sucursal",codigo_sucursal);
    datos.append("sufijo_sucursal",sufijo_sucursal);
    $('.loading').show();
    $.ajax({
        method:'POST',
        url:'<?=site_url("aprobar-pedido-extraordinario")?>',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            $('.loading').hide();
            if(respuesta.estado){
                Swal.fire({
                    icon: 'success',
                    title: 'Se ha aprobado el pedido exitosamente',
                    timer: 1000
                });
                $(element).prop('disabled', true);
                $(element).removeClass( "btn-info" );
                $(element).addClass( "btn-success" );
                
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Ocurrio un error inesperado.',
                    timer: 4500
                });
            }
        }
    });
    
}
</script>

