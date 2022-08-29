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
                    <div class="row">
                        <div class="col-1">
                        <?=form_label("Usuarios", 'usuarios');?>
                        </div>

                        <div class="col-3">
                            <?=form_dropdown('usuarios', $usuarios, null,['id'=>'usuarios']);?>
                        </div>

                        <div class="col-1">
                        <?=form_label("Menu", 'menu');?>
                        </div>

                        <div class="col-3">
                            <?=form_dropdown('menus', $menus, null,['id'=>'menus']);?>
                        </div>


                        <div class="col-2">
                            <?=form_button('name', 'Buscar', ['id'=>'buscar', 'class'=>'btn btn-danger btn-xs']);?>
                        </div>
                    </div>

                    <?=form_open('aprobar-cambios-botones', null, ['vc'=>$this->input->post('vc')])?>
                        <div class="row align-items-center"  id="menu">


                    
                        </div>
                        <?=form_submit()?>
                    <?=form_close();?>
            </div>
        </div>
    </div>
</div>

<script>

$('#usuarios').select2({
    placeholder: "--- Seleccione una opcion ---"
});

$('#menus').select2({
    placeholder: "--- Seleccione una opcion ---"
});

$('#buscar').on('click', function(){

    var id_menu = $('#menus').val();
    var id_usuario = $('#usuarios').val();

    $.ajax({
        type: "POST",
        url: "<?=site_url('get-permiso-boton')?>",
        data: { id_menu: id_menu, id_usuario: id_usuario},
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