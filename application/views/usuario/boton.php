<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title"><i class="las la-user-plus"></i> Permisos de Boton a Usuarios</h3>
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
                            <select name="usuarios" id="usuarios" class="form-control">
                                <?php foreach ($usuarios as $usuario): ?>
                                    <option value="<?=$usuario->ID_USUARIO?>"><?=$usuario->NOMBRE_COMPLETO?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-1">
                        <?=form_label("Menu", 'menu');?>
                        </div>

                        <div class="col-3">
                            <select name="menus" id="menus" class="form-control">
                                    <?php foreach ($menus as $menu): ?>
                                        <option value="<?=$menu->ID_VENTAS_ACCESO?>"><?=$menu->NOMBRE?></option>
                                    <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="col-2">
                            <?=form_button('name', 'Buscar', ['id'=>'buscar', 'class'=>'btn btn-danger btn-xs']);?>
                        </div>
                    </div>

                        <div  id="menu">


                    
                        </div>                   
            </div>
        </div>
    </div>
</div>

<script>

$('#buscar').on('click', function(){

    var id_menu = $('#menus').val();
    var id_usuario = $('#usuarios').val();

    $.ajax({
        type: "POST",
        url: "<?=site_url('get-permiso-boton')?>",
        data: { id_menu: id_menu, id_usuario: id_usuario, url:'<?=current_url()?>', vc:'<?=$this->input->get('vc')?>'},
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