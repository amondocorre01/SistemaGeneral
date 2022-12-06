<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title"><i class="las la-user-plus"></i> Acceso de Usuarios - Sistema de Ventas</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-1">
                    <?=form_label("Usuario", 'usuario');?>
                    </div>

                    <div class="col-4">
                        <select name="usuario" id="usuario" class="form-control">
                            <option value="">--- Seleccione un Usuario ---</option>

                            <?php foreach ($usuarios as $usuario):?>
                                <option value="<?=$usuario->ID_USUARIO?>"><?=$usuario->NOMBRE_COMPLETO?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="col-4">
                        <?=form_button('name', 'Buscar', ['class'=>'btn btn-danger btn-lg', 'onclick'=>'searchAcceso()']);?>
                    </div>
                </div>

                    <div id="menu">
    
                
                    </div>
            </div>
        </div>
    </div>
</div>

<script>

    function searchAcceso() {

        var id = $('#usuario').val();

        $.ajax({
            type: "POST",
            url: "<?=site_url('get-usuario-venta')?>",
            data: { id: id},
            dataType: "html",
            success: function (response) {
                $('#menu').empty();
                $('#menu').append(response);
            }
        });
    }



$('#usuario').on('change', function(){

    var id = $( this ).val();
    $('#menu').empty();

    $.ajax({
        type: "POST",
        url: "<?=site_url('get-usuario-venta')?>",
        data: { id: id},
        dataType: "html",
        success: function (response) {
            $('#menu').empty();
            $('#menu').append(response);
        }
    });
});

<?php if($this->session->success): ?>

    Swal.fire({
        icon: 'success',
        title: 'Se han registrado todos los cambios',
        timer: 4500
    });

<?php endif;?>

</script>