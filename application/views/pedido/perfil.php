<?php foreach ($inventario as $value): ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><?=$value->NOMBRE_LISTA?></a>
        <?=form_button('agregar', '<span style="font-size:1.5rem" class="las la-plus-circle"></span>', ['class'=>'btn btn-danger btn-lg float-right', 'onclick'=>'newProducto('.$value->ID_LISTA_STOCK.')']);?>
    </nav>

    <?php if ($value->productos):?>
    <?php $productos = json_decode($value->productos) ?>

    <?php foreach ($productos as $key): ?>
        <div class="row">
            <div class="col-1">

            </div>
            <div class="col-2">
                <p class="lead" style="font-weight: 500;"><?=$key->SUB_CATEGORIA_1?></p>
            </div>
            <div class="col-3">
                <p class="lead" style="font-weight: 500;"><?=$key->SUB_CATEGORIA_2?></p>
            </div>
            <div class="col-2">
                <label for="">Cantidad sugerida a pedir</label>
                <div class="input-group mb-3">
                <input type="text" class="form-control" id="input_<?=$key->ID_STOCK?>" value="<?=$key->STOCK?>">
                    <div class="input-group-append">
                        <div class="input-group-text palette-Red-600 bg">
                            <span onclick="saveMinimo(<?=$key->ID_STOCK?>)" class="las la-cloud-upload-alt palette-White text" style="font-size: 1.5rem"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>
    <?php endif;?>

<?php endforeach; ?>

<?php $categoria = $this->main->getListSelect('INVENTARIOS_CATEGORIA c', 'c.ID_CATEGORIA AS ID, c.CATEGORIA AS TEXT, c.ORDEN', ['c.ORDEN'=>'ASC'] ,['c.ESTADO'=>1]); ?>


<div class="modal fade" id="newProduct" tabindex="-1" role="dialog" aria-labelledby="nombre2" aria-hidden="true">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nombre2">Agregar nuevo Producto al Perfil</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
        <div class="col-md-12">
            <?=form_label("Categoria", 'categoria');?>
            <select name="" id="categoria" class="form-control" onchange="subcategorias()">
                <option>---- Escoja una opcion ----</option>
                <?php foreach( $categoria AS $val ):?>
                    <option value="<?=$val->ID?>"><?=$val->TEXT?></option>
                <?php endforeach;?>
            </select>
        </div>

        <div class="col-md-12">
            <?=form_label("Sub-Categoria", 'subcategoria');?>
            <select name="" id="categoria" class="form-control">
                
            </select>
        </div>
      </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" onclick="guardarPerfil()" class="btn btn-danger" data-dismiss="modal">Crear</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>





<script>
    function saveMinimo(id) 
    {

        var minimo = $('#input_'+id).val();
                
        $.post("<?=site_url('set-minimo')?>", {id:id, minimo:minimo})
        .done(function( data ) {

            var response = JSON.parse(data);
                        
                if(response.status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Se ha actualizado el monto minimo de un producto',
                    timer: 4500
                });
                }
        });
    }

    function newProducto($id) 
    {
        $('#newProduct').modal('show');
    }

    function subcategorias()
    {
        var categoria = $('#categoria').val();

        if( categoria > 0) {

            $.post("<?=site_url('get-subcategoria')?>", { categoria:categoria})

            .done(function( data ) {

                var response = JSON.parse(data);
                            
                html =  '<option>---- Escoja una opcion ----</option>';

                $.each(response, function (i, v) { 
                    html += '<option value="'+v.+
                });
              

            });

        }
    }
</script>