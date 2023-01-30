<?php foreach ($inventario as $value): ?>
    <div class="row palette-Red-200 bg">
      <div class="col-5"><p class="lead" style="font-weight: 500;"><?=$value->NOMBRE_LISTA?></p></div>
    </div>

    <?php $productos = json_decode($value->productos) ?>

    <?php foreach ($productos as $key): ?>
        <div class="row">
            <div class="col-1">

            </div>
            <div class="col-4">
                <p class="lead" style="font-weight: 500;"><?=$key->productos?></p>
            </div>
            <div class="col-2">
                <label for="">Cantidad Mínima</label>
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

<?php endforeach; ?> 


<script>
    function saveMinimo(id) {

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
</script>