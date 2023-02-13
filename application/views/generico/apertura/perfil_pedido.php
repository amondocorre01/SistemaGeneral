<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="las la-user-plus"></i> Configuracion de Perfil de Pedidos
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-3">
                        <?=form_label("Perfil", 'perfil');?>
                        <select name="" id="perfil" class="form-control" onchange="limpiar()">
                            <?php foreach ($perfiles as  $perfil): ?>
                                <option value="<?=$perfil->ID?>"><?=$perfil->TEXT?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-2">
                            <?=form_button('send', 'Buscar ', ['class'=>'btn btn-danger btn-lg', 'onclick'=>'getPerfil()', 'id'=>'getPerfiles']);?>
                    </div>
                    <div class="col-3">
                            <?=form_button('new', 'Crear Perfiles', ['class'=>'btn btn-success btn-lg', 'onclick'=>'showNewPerfil()']);?>
                    </div>

                   
                </div>

               <div id="perfiles">
                  
                              

               </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="newPerfil" tabindex="-1" role="dialog" aria-labelledby="nombre2" aria-hidden="true">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nombre2">Nuevo Perfil de Pedido</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?=form_label("Nombre de Perfil", 'perfil');?>
                <?=form_input(['name'=>'nombre_perfil', 'id'=>'nombre_perfil','class'=>'form-control palette-Yellow-100 bg']);?>
                <div class="valid-feedback"></div>
            </div>
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

function getPerfil() {

    var perfil = $('#perfil').val();

    $('.loading').show();
   
    $.ajax({
        type: "POST",
        url: "<?=site_url('get-perfil-pedido')?>",
        data: { perfil: perfil},
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

function showNewPerfil() {
    $('#newPerfil').modal('show');
}

function guardarPerfil() {
    var perfil = $('#nombre_perfil').val();
    var sucursal = '<?=$sucursal?>';

    if(perfil) {

        $.post("<?=site_url('new-perfil')?>", {perfil:perfil, sucursal:sucursal})

        .done(function( data ) {

            var response = JSON.parse(data);
                        
                if(response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se ha registrado un perfil de pedido',
                        timer: 4500
                    });
                }

                $('#getPerfiles').click();
        });
    }
}

</script>