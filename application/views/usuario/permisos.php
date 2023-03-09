<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title"><i class="las la-user-plus"></i> Nuevo Usuario</h3>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4">
                        
                    </div>
                </div>
                <?=form_open('actualizar-permisos-usuarios', null, ['id_menu'=>$this->input->get('vc')])?>
                    <div class="row">

                        <div class="col-1">
                        <?=form_label("Usuarios", 'usuarios');?>
                        </div>

                        <div class="col-4">
                            <?=form_dropdown('usuarios', $usuarios, null,['id'=>'usuarios']);?>
                        </div>

                        <div class="col-4">
                            <?=form_submit('name', 'Confirmar los cambios', ['class'=>'btn btn-danger btn-xs']);?>
                        </div>
                    </div>
                    <div id="menu">
    
                
                    </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</div>

<script>

$('#usuarios').select2({
    placeholder: "--- Seleccione una opción ---"
});

$('#usuarios').on('change', function(){

    var id = $( this ).val();

    $.ajax({
        type: "POST",
        url: "<?=site_url('get-menu')?>",
        data: { id: id},
        dataType: "html",
        success: function (response) {
            $('#menu').empty();
            $('#menu').append(response);
        }
    });
});

<?php if($this->session->cambios): ?>

    Swal.fire({
        icon: 'success',
        title: 'Se han registrado todos los cambios',
        timer: 4500
    });

<?php endif;?>

</script>