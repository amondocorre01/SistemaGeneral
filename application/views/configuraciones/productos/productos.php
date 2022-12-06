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
    $id_menu = intval($this->input->get('vc'));
    $id_usuario = $this->session->id_usuario;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Productos </h3>
        </div>
        
        <div class="card-body">
        <form action="<?=current_url()?>" method="GET" id="form_fecha">
        <div class="row">

            <div class="col-md-3">
                
                <div class="form-group">
                  <label>Primera categoria</label>
                  <a class="btnShowProducts btn-info btn-xs btnAgregarPC" title="Agregar 1ra categoria" data-toggle="modal" data-target="#modalAgregarPrimeraCategoria"><i class="fa fa-plus"></i></a>
                  <a class="btnShowProducts btn-warning btn-xs btnEditarPC" title="Editar 1ra categoria" data-toggle="modal" data-target="#procedimiento_1670344808034"><i class="fa fa-pencil"></i></a>
                  <a class="btnShowProducts btn-danger btn-xs btnEliminarPC" title="Eliminar 1ra categoria" data-toggle="modal" data-target="#procedimiento_1670344808034"><i class="fa fa-times"></i></a>
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
                  <label>Segunda categoria</label>
                  <a class="btnShowProducts btn-info btn-xs btnAgregarSC" title="Agregar 2da categoria" data-toggle="modal" data-target="#modalAgregarSegundaCategoria"><i class="fa fa-plus"></i></a>
                  <a class="btnShowProducts btn-warning btn-xs btnEditarSC" title="Editar 2da categoria" data-toggle="modal" data-target="#procedimiento_1670344808034"><i class="fa fa-pencil"></i></a>
                  <a class="btnShowProducts btn-danger btn-xs btnEliminarSC" title="Eliminar 2da categoria" data-toggle="modal" data-target="#procedimiento_1670344808034"><i class="fa fa-times"></i></a>
                  <select name="productoCategoria2" id="productoCategoria2" class="form-control select2" style="width: 100%;">
                    <option value="" selected="selected">Seleccione la segunda categoria</option>
                  </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                  <label>Seleccione el producto</label>
                  <a class="btnShowProducts btn-info btn-xs btnAgregarPM" title="Agregar producto madre" data-toggle="modal" data-target="#modalAgregarProductoMadre"><i class="fa fa-plus"></i></a>
                  <a class="btnShowProducts btn-warning btn-xs btnEditarPM" title="Editar producto madre" data-toggle="modal" data-target="#procedimiento_1670344808034"><i class="fa fa-pencil"></i></a>
                  <a class="btnShowProducts btn-danger btn-xs btnEliminarPM" title="Eliminar producto madre" data-toggle="modal" data-target="#procedimiento_1670344808034"><i class="fa fa-times"></i></a>
                  <select name="productoMadre" id="productoMadre" class="form-control select2" style="width: 100%;">
                    <option value="" selected="selected">Seleccione el producto</option>
                  </select>
                </div>
            </div>
            <!--<div class="col-md-3">
            <input  name="vc" type="hidden" id="fecha" value="<?=$this->input->get('vc')?>">
                <input class="btn btn-primary btn-form-search" type="submit" value="Buscar" name="buscar" >
            </div>-->
        </div>
        </form>
        </div>
        </div>
    </div>
</div>
<!--
<div class="card">
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Usuario</th>
      </tr>
      </thead>
      <tbody>
        <?php
        $respuesta=[];
            foreach ($respuesta as $key => $turno) {
                echo '<tr>
                <td></td>
                </tr>';
            }
        ?>
      </tfoot>
  </div>
</div>-->

<div class="modal fade" id="modalAgregarPrimeraCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar 1ra categoria</h4>
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
        <button type="button" class="btn btn-primary"  onclick="guardarPrimeraCategoria()">Guardar</button>
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
        <button type="button" class="btn btn-primary"  onclick="guardarSegundaCategoria()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAgregarProductoMadre">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar producto madre</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="box-body">
          <div class="form-group">
              <label>Primera categoria</label>
              <input type="text" class="form-control" name="primeraCategoria" id="priCategoriaM3C" readonly placeholder="Ingrese la categoria">
            </div>
            <div class="form-group">
              <label>Segunda categoria</label>
              <input type="text" class="form-control" name="segundaCategoria" id="segCategoriaM3C" readonly placeholder="Ingrese la categoria">
            </div>
          </div>
      </div>
      
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary"  onclick="guardarProductoMadre()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
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

    $('#productoCategoria1').on('change',function(){
        var primera_categoria_id = $(this).val();
        var texto_seleccionado = $('#productoCategoria1 option:selected').html();
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
    });

});

$('.btnAgregarSC').on('click',function(){
  var texto_seleccionado = $('#productoCategoria1 option:selected').html();
  $('#priCategoria').val(texto_seleccionado);
});

$('.btnAgregarPM').on('click',function(){
  var texto_seleccionado = $('#productoCategoria1 option:selected').html();
  $('#priCategoriaM3C').val(texto_seleccionado);
  var texto_seleccionado = $('#productoCategoria2 option:selected').html();
  $('#segCategoriaM3C').val(texto_seleccionado);
});

function guardarPrimeraCategoria(){
  var primera_categoria = $('#primeraCategoriaMPC').val();
  if(primera_categoria){
    console.log(primera_categoria);
    var datos = new FormData();
    datos.append("nombre_pc",primera_categoria);
    $.ajax({
        method:'POST',
        url:'<?=site_url("guardar-primera-categoria")?>',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
          console.log(respuesta);
          if(respuesta == 'ok'){
            Swal.fire({
              icon: 'success',
              title: 'Se ha registrado correctamente.',
              timer: 3500
            });
            window.location.href = "<?=current_url()?>";
          }
        }
    });
  }
  
}

function guardarSegundaCategoria(){
  var primera_categoria = $('#productoCategoria1').val();
  var segunda_categoria = $('#segundaCategoriaMSC').val();
  if(segunda_categoria){
    console.log(segunda_categoria);
    var datos = new FormData();
    datos.append("categoria_1",primera_categoria);
    datos.append("nombre_sc",segunda_categoria);
    $.ajax({
        method:'POST',
        url:'<?=site_url("guardar-segunda-categoria")?>',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
          console.log(respuesta);
          if(respuesta == 'ok'){
            Swal.fire({
              icon: 'success',
              title: 'Se ha registrado correctamente.',
              timer: 3500
            });
            window.location.href = "<?=current_url()?>";
          }
        }
    });
  }
  
}

function imprimirDetalleTurno(){
  var url= "<?=site_url('imprimir-detalle-turno')?>";
  window.open(url,'_blank');
}

</script>

