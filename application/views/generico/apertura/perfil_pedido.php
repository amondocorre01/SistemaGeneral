<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="las la-user-plus"></i> Acceso de Botones a las Sucursales
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-3">
                        <?=form_label("Sucursal", 'sucursal');?>
                        <select name="" id="sucursal" class="form-control" onchange="limpiar()">
                            <?php foreach ($sucursales as  $sucursal): ?>
                                <option value="<?=$sucursal->ID?>"><?=$sucursal->TEXT?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-1"></div>

                    <?=form_button('send', 'Buscar ', ['class'=>'btn btn-danger btn-lg', 'onclick'=>'getPerfiles()']);?>
                </div>

               <div id="permisos">
                  
                              

               </div>
            </div>
        </div>
    </div>
</div>

<script>


function getPerfiles() {

    var sucursal = $('#sucursal').val();

    $('.loading').show();
   
    $.ajax({
        type: "POST",
        url: "<?=site_url('get-perfil-pedido')?>",
        data: { sucursal: sucursal},
        dataType: "html",
        success: function (response) {

            $('.loading').hide();

            $('#perfiles').empty();
            $('#perfiles').append(response);
        }
    });


}

function limpiar() {

    $('#permisos').empty();

}

</script>