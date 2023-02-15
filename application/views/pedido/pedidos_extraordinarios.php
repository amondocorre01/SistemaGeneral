<?php
$protocolo = protocoloWeb();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$current_url = $protocolo.$host.$url;

$id_usuario = $this->session->id_usuario;
$sucursales = getSucursalesUsuario($id_usuario);
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
    $id_menu = intval($this->input->get('vc'));
    $id_usuario = $this->session->id_usuario;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Pedidos Extraordinarios </h3>
        </div>
        
        <div class="card-body">
        
        
        </div>
        </div>
    </div>
</div>

<div class="card">
  <div class="card-body">
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
                <label for="">Seleccione Fecha de entrega</label>
                <input class="form-control" type="date" id="fecha_pedido" name="fecha_pedido" min="<?=date('Y-m-d')?>" >
            </div>
            <!--<div class="col-md-3">
            <input  name="vc" type="hidden" id="fecha" value="<?=$this->input->get('vc')?>">
                <input class="btn btn-primary btn-form-search" type="submit" value="Buscar" name="buscar" >
            </div>-->
        </div>

    <div class="row">
      <div class="col-md-9">
        <div class="form-group">
        <label>Detalle del producto extraordinario</label>
              <textarea class="form-control input-sm " rows="5" id="detalleProducto" name="detalle" placeholder="Ingrese el detalle."><?php echo strip_tags('');?></textarea>
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

<div class="modal fade" id="modalAgregarPrimeraCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Categoria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputPassword1">Primera categoria</label>
              <input type="text" class="form-control" name="primeraCategoria" id="primeraCategoriaMPC" placeholder="Ingrese la categoria">
            </div>
          </div>
      </div>
      
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btnSavePrimeraCategoria"  onclick="guardarPrimeraCategoria()">Guardar</button>
        <button type="button" class="btn btn-primary btnUpdatePrimeraCategoria"  onclick="guardarModificacionPrimeraCategoria()">Modificar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAgregarSegundaCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar 2da categoria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="box-body">
          <div class="form-group">
              <label>Primera categoria</label>
              <input type="text" class="form-control" name="primeraCategoria" id="priCategoria" readonly placeholder="Ingrese la categoria">
            </div>
            <div class="form-group">
              <label>Segunda categoria</label>
              <input type="text" class="form-control" name="segundaCategoria" id="segundaCategoriaMSC" placeholder="Ingrese la categoria">
            </div>
          </div>
      </div>
      
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btnUpdatePrimeraCategoria"  onclick="guardarSegundaCategoria()">Guardar</button>
        <button type="button" class="btn btn-primary btnUpdateSegundaCategoria"  onclick="guardarModificacionSegundaCategoria()">Modificar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAgregarCostos">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar frutas y precios</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="box-body">
          
          <input type="hidden" id="idTamProducto" class="form-control" placeholder="">
          <div class="form-group row">
                <label class="col-sm-6 col-form-label">Tamaño seleccionado:</label>
                <div class="col-sm-6">
                <input type="text" readonly id="textTamProducto" class="form-control" placeholder="">
                <input type="hidden" id="idProductoUnico" value="0" class="form-control" placeholder="">
                </div>
              </div>
          <div class="form-group row">
            <label class="col-sm-6 col-form-label">¿Incluirá frutas?</label>
            <div class="form-group col-sm-2">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="radio" name="tieneFrutas" id="frutasSi" value="1">
                <label for="frutasSi" class="custom-control-label">SI</label>
              </div>
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="radio" name="tieneFrutas" id="frutasNo" value="0" checked>
                <label for="frutasNo" class="custom-control-label">NO</label>
              </div>
            </div>
            <div class="form-group col-sm-4 cantidadFrutasModal">
              <select name="cantidadFrutasModal" id="cantidadFrutasModal" class="form-control select2" style="width: 100%;">
                <option value="" selected="selected">Cantidad</option>
                <option value="1" >1</option>
                <option value="2" >2</option>
                <option value="3" >3</option>
                <option value="4" >4</option>
              </select>
              <input type="hidden" id="cantidadFrutasModalOriginal" value="0" class="form-control">
            </div>
          </div>
            <?php
              foreach ($listasPrecios as $key => $value) {
                echo '
                <div class="form-group row">
                    <label class="col-sm-6 col-form-label">Costo '.$value->NOMBRE_LISTA_PRECIOS.'</label>
                    <div class="col-sm-6">
                      <input type="number" iden="'.$value->ID_NOMBRE_LISTA_PRECIOS.'" name="modalCostos" value="0" class="form-control modalCostos" placeholder="">
                    </div>
                  </div>
                ';
              }
            ?>
            
          </div>
      </div>
      
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardarProductoMadre" >Agregar</button>
        <button type="button" class="btn btn-primary" id="guardarEditarProductoMadre" >Modificar</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    $('.btnSavePrimeraCategoria').hide();
    $('.btnUpdatePrimeraCategoria').hide();
    $('.btnSaveSegundaCategoria').hide();
    $('.btnUpdateSegundaCategoria').hide();
    $('#saveProduct').hide();
    $('#saveEditProduct').hide();
    $('#agregarEditarProducto').hide();
    $('#productoCategoria2').prop( "disabled", true );
    $('#productoMadre').prop( "disabled", true );
    $('.btnAgregarPC').show();
    $('.btnEditarPC').hide();
    $('.btnEliminarPC').hide();

    $('.btnAgregarSC').hide();
    $('.btnEditarSC').hide();
    $('.btnEliminarSC').hide();

    $('.btnAgregarPM').hide();
    $('.btnEditarPM').hide();
    $('.btnEliminarPM').hide();

    $('.inputPrecioTransporte').hide();

    $('.btnAgregarPC').on('click',function(){
      $('.btnSavePrimeraCategoria').show();
      $('.btnUpdatePrimeraCategoria').hide();
      $('#primeraCategoriaMPC').val('');
    });

    $('.btnEditarPC').on('click',function(){
      $('.btnSavePrimeraCategoria').hide();
      $('.btnUpdatePrimeraCategoria').show();
      $('#primeraCategoriaMPC').val('');
      var primera_categoria = $('#productoCategoria1').val();
      var texto_seleccionado = $('#productoCategoria1 option:selected').html();
      $('#primeraCategoriaMPC').val(texto_seleccionado);
    });

    $('.btnAgregarSC').on('click',function(){
      $('.btnSaveSegundaCategoria').show();
      $('.btnUpdateSegundaCategoria').hide();
      $('#segundaCategoriaMSC').val('');
      var texto_seleccionado = $('#productoCategoria1 option:selected').html();
      $('#priCategoria').val(texto_seleccionado);
    });

    $('.btnEditarSC').on('click',function(){
      $('.btnSaveSegundaCategoria').hide();
      $('.btnUpdateSegundaCategoria').show();
      $('#segundaCategoriaMSC').val('');
      var texto_seleccionado = $('#productoCategoria1 option:selected').html();
      $('#priCategoria').val(texto_seleccionado);
      var texto_seleccionado = $('#productoCategoria2 option:selected').html();
      $('#segundaCategoriaMSC').val(texto_seleccionado);
    });

    $('.btnEliminarPC').on('click',function(){
      swal.fire({
        title: "¿Estás seguro?",
        text: "Se eliminará la categoria seleccionada.",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Continuar"
      }).then((result) => {
          if (result.isConfirmed) {
            var id_categoria = $('#productoCategoria1').val();
            $('.loading').show();
            var datos = new FormData();
            datos.append("id_categoria",id_categoria);
            $.ajax({
                method:'POST',
                url:'<?=site_url("eliminar-primera-categoria")?>',
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success:function(respuesta){
                  if(respuesta == 'ok'){
                    $('.loading').hide();
                    Swal.fire({
                      icon: 'success',
                      title: 'Se ha eliminado correctamente.',
                      timer: 3500
                    });
                    window.location.href = "<?=$current_url?>";
                  }
                }
            });
          }
        });
    });

    $('.btnEliminarSC').on('click',function(){
      swal.fire({
        title: "¿Estás seguro?",
        text: "Se eliminará la sub-categoria seleccionada.",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Continuar"
      }).then((result) => {
          if (result.isConfirmed) {
            var id_categoria = $('#productoCategoria2').val();
            $('.loading').show();
            var datos = new FormData();
            datos.append("id_categoria",id_categoria);
            $.ajax({
                method:'POST',
                url:'<?=site_url("eliminar-segunda-categoria")?>',
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success:function(respuesta){
                  if(respuesta == 'ok'){
                    $('.loading').hide();
                    Swal.fire({
                      icon: 'success',
                      title: 'Se ha eliminado correctamente.',
                      timer: 3500
                    });
                    window.location.href = "<?=$current_url?>";
                  }
                }
            });
          }
        });
    });
    function guardarPedidoExtraordinario() {
      var codigo_sucursal = $('#codigo_sucursal').val();
      var productoCategoria1 = $('#productoCategoria1').val();
      var productoCategoria2 = $('#productoCategoria2').val();
      var productoMadre = $('#productoMadre').val();
      var detalleProducto = $('#detalleProducto').val();
      var fecha_pedido = $('#fecha_pedido').val();
      var modificaraProducto = $('input[type=radio][name=modificaraProducto]:checked').val();
      $('.loading').show();
      var datos = new FormData();
      datos.append("codigo_sucursal",codigo_sucursal);
      datos.append("categoria_1",productoCategoria1);
      datos.append("categoria_2",productoCategoria2);
      datos.append("producto_madre",productoMadre);
      datos.append("detalle_producto",detalleProducto);
      datos.append("modificara_producto",modificaraProducto);
      datos.append("fecha_pedido",fecha_pedido);
      $.ajax({
          method:'POST',
          url:'<?=site_url("guardar-pedido-extraordinario")?>',
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success:function(respuesta){
            if(respuesta == 'ok'){
              $('.loading').hide();
              Swal.fire({
                icon: 'success',
                title: 'Se ha guardado correctamente.',
                timer: 3500
              });
              window.location.href = "<?=$current_url?>";
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
                url:'<?=site_url("productos-segunda-categoria")?>',
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
                url:'<?=site_url("productos-madre")?>',
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
        fecha_pedido:{
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
        fecha_pedido:{
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

});

function imprimirDetalleTurno(){
  var url= "<?=site_url('imprimir-detalle-turno')?>";
  window.open(url,'_blank');
}

</script>

