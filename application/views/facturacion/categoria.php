<br>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title"><i class="las la-key"></i>Productos</h3>
            </div>
            <div class="card-body table-responsive">

            <button class="btn btn-xs edit palette-Green-600 bg" data-toggle="modal" data-target="#nuevo">
                <i class="las la-key la-1x"></i> Nuevo Producto
            </button>
            <br> <br>

                <table id="table" class="table table-striped table-hover dt-responsive display table-bordered dataTable dtr-inline">

                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="nombre3" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nombre3">Nuevo Producto</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?=form_label("Categoria Principal", 'categoria');?>
                    <select id="categoria" class="select2">
                        <?php foreach ($categoria as $value) : ?>
                            <option value="<?=$value->ID_CATEGORIA?>"><?=$value->CATEGORIA?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <?=form_label("Sub-categoria", 'sub-categoria');?>
                    <select name="sub-categoria" id="sub-categoria" class="select2">
                        <option value="">---- Seleccione una categoria Principal Primero----</option>
                    </select>
                </div>
            </div>

            <div class="col-md-7">
                <div class="form-group">
                    <?=form_label("Nombre del Producto", 'producto');?>
                    <?=form_input('producto', null, ['class'=>'form-control', 'id'=>'producto', 'required'=>'required']);?>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <?=form_label("Orden", 'orden');?>
                    <?=form_input('orden', null, ['class'=>'form-control', 'id'=>'orden', 'required'=>'required']);?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <?=form_label("Cod. Act. Economica", 'codact');?>
                    <?=form_input('codact', null, ['class'=>'form-control', 'placeholder'=>'620100' ,'id'=>'codact', 'required'=>'required']);?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <?=form_label("Cod. Producto SIN", 'codsin');?>
                    <?=form_input('codsin', null, ['class'=>'form-control', 'placeholder'=>'65200' ,'id'=>'codsin', 'required'=>'required']);?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <?=form_label("Unidad de Medida", 'medida');?>
                    <select id="medida" class="select2">
                        <?php foreach ($medidas as $medida) : ?>
                            <option value="<?=$medida->id?>"><?=$medida->text?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <?=form_label("Tamaño", 'tamanio');?>
                    <select id="tamanio" class="select2">
                        <?php foreach ($tamanios as $tamanio) : ?>
                            <option value="<?=$tamanio->id?>"><?=$tamanio->text?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <?=form_label("Orden de Tamaño", 'orden2');?>
                    <?=form_input('orden2', null, ['class'=>'form-control', 'id'=>'orden2', 'required'=>'required']);?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <?=form_label("Estado", 'estado');?>
                    <?=form_dropdown('estado', ['1'=>'Habilitado', '0'=>'Deshabilitado'] ,null, ['class'=>'form-control', 'id'=>'estado', 'required'=>'required']);?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <?=form_label("Lista", 'lista');?>
                    <select id="lista" class="form-control">
                        <?php foreach ($listas as $lista) : ?>
                            <option value="<?=$lista->id?>"><?=$lista->text?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <?=form_label("Precio", 'precio');?>
                    <?=form_input('precio', null, ['class'=>'form-control', 'placeholder'=>'18' ,'id'=>'precio', 'required'=>'required']);?>
                </div>
            </div>
      </div>

    <div class="row">
        <div class="large-12 columns">
            <div class="custom-file-container" data-upload-id="myFirstImage">
                <label class="custom-file-container__custom-file">
                    <input type="file" name="imagen" onchange="imageUploaded()" class="custom-file-container__custom-file__custom-file-input" id="customImage" accept="image/*" aria-label="Elegir un archivo">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                </label>
                <div class="custom-file-container__image-preview"></div>
                <a href="javascript:void(0)" class="button small expanded registro custom-file-container__image-clear bg palette-Red-700"><i class="las la-trash"></i><?=lang('quitar.foto')?></a>
            </div>
        </div>
    </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="guardarProducto()" class="btn btn-danger" id="registrar">Registrar</button>
      </div>
    </div>
  </div>
</div>

<script>
    const firstUpload = new FileUploadWithPreview('myFirstImage')
    const firstUploadInfoButton = document.querySelector('.upload-info-button--first')
    firstUploadInfoButton.addEventListener('click', function () {
        console.log('First upload:', firstUpload, firstUpload.cachedFileArray)
    });
</script>


<script>

    function guardarProducto(){
        var subcategoria = $('#sub-categoria').val();
        var producto = $('#producto').val();
        var orden = $('#orden').val();
        var codact = $('#codact').val();
        var codsin = $('#codsin').val();
        var medida = $('#medida').val();
        var tamanio = $('#tamanio').val();
        var orden2 = $('#orden2').val();
        var estado = $('#estado').val();
        var lista = $('#lista').val();
        var precio = $('#precio').val();
        var imagen = imageUploaded();

        $.post("<?=site_url('register-producto')?>", {subcategoria:subcategoria, producto:producto, orden:orden, codact:codact, codsin:codsin, medida:medida, tamanio:tamanio, orden2:orden2, estado:estado, lista:lista, precio:precio, imagen:imagen})

        .done(function (data){



        }); 

    }

    function imageUploaded() {
        var file = document.querySelector(
            'input[type=file]')['files'][0];
    
        var reader = new FileReader();
        console.log("next");
        
        reader.onload = function () {
            base64String = reader.result.replace("data:", "")
                .replace(/^.+,/, "");
    
            imageBase64Stringsep = base64String;
    
            // alert(imageBase64Stringsep);
            console.log(base64String);
        }
        reader.readAsDataURL(file);

        return base64String;
    }

</script>


<script>
$('#categoria').on('change', function(){
    
    var id = $(this).val();

    $.post("<?=site_url('get-subcategorias')?>", {id:id})

    .done(function(data){

        var objeto = JSON.parse(data);

        var contenido = '';

        $('#sub-categoria').empty();
        $.each(objeto.results, function( index, value ) {
            
           contenido += '<option value="'+value.id+'">'+value.text+'</option>'; 
        });

        $('#sub-categoria').append(contenido);
    });
});


    $('.select2').select2({
        placeholder: "Seleccione una opcion"
    });

    
    
    var table = $('#table').DataTable({
        responsive: true,
        ajax: { url: '<?=site_url('get-productos')?>' },
        language:{ search: "Buscar", lengthMenu: "Mostrar _MENU_", previous: "Anterior",
        zeroRecords: "Sin resultados", infoEmpty: "No hay registros disponibles",
        info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        infoFiltered: "(Filtrado de _MAX_ registros totales)",
        oPaginate: {sNext:"Siguiente", sLast: "Último", sPrevious: "Anterior", sFirst:"Primero" },
        },
        columns: [
            { title: 'N°', width:'10%',data: 'row' },
            { title: 'Producto', width:'10%' ,data: 'PRODUCTO_MADRE' },
            { title: 'Sub-categoria', width:'10%' ,data: 'CATEGORIA_2' },
            { title: 'Categoria', width:'10%' ,data: 'CATEGORIA' },
            { title: 'Precio', width:'10%' ,data: 'PRECIO' },
            { title: 'Lista', width:'10%' ,data: 'NOMBRE_LISTA_PRECIOS' },
        ],
    });   

    $('#confirmar').on('click', function(){

        var id =  $('input[name="id_perfil"]').val();
        var nombre =   $('input[name="perfil"]').val();
        var estado = $('select[name="estado"]').val();

        $('#editar').modal('hide');

        if( id > 0 && nombre != '') {

            $.post("<?=site_url('set-perfil')?>", {id:id, nombre:nombre, estado:estado})
            .done(function( data ) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Se han realizado todos los cambios solicitados',
                    timer: 4500
                });

                table.ajax.reload();
            });
        }
    });
</script>