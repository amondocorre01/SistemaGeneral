<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="las la-users la-2x"></i> Acceso de Perfiles - Ventas
                </h3>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-1">
                    
                    </div>

                    <div class="col-3">
                    <?=form_label("Perfiles", 'perfil');?>
                        <select name="" id="perfil" class="form-control">
                            <?php foreach ($perfiles as  $perfil): ?>
                                <option value="<?=$perfil->id?>"><?=$perfil->text?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="col-2">
                        <?=form_button('send', 'Buscar accesos', ['class'=>'btn btn-danger btn-lg', 'onclick'=>'getAcessos()']);?>
                    </div>
                </div>

                <div id="menu">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$('#perfil').on('change', function(){
    $('#menu').empty();
});


function getAcessos() {

    var id = $('#perfil').val();

    $('.loading').show();

    $.ajax({
        type: "POST",
        url: "<?=site_url('get-acceso-perfil')?>",
        data: { id: id, filtro:'SISTEMA_VENTAS'},
        dataType: "html",
        success: function (response) {
            $('.loading').hide();
            $('#menu').empty();
            $('#menu').append(response);
        }
    });


}

    <?php if($this->session->success): ?>

        Swal.fire({
            icon: 'success',
            title: 'Se han registrado todos los cambios',
            timer: 4500
        });

    <?php endif;?>

</script>