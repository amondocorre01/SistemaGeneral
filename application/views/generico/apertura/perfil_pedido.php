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
                        <?=form_label("Sucursal", 'sucursal');?>
                        <select name="" id="sucursal" class="form-control" onchange="limpiar()">
                            <?php foreach ($sucursales as  $sucursal): ?>
                                <option value="<?=$sucursal->ID?>"><?=$sucursal->TEXT?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-2">
                            <?=form_button('send', 'Buscar ', ['class'=>'btn btn-danger btn-lg', 'onclick'=>'getPerfiles()', 'id'=>'getPerfiles']);?>
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
                <?=form_input(['name'=>'perfil', 'id'=>'perfil','class'=>'form-control palette-Yellow-100 bg']);?>
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

function showNewPerfil() {
    $('#newPerfil').modal('show');
}

function guardarPerfil() {
    var perfil = $('#perfil').val();
    var sucursal = $('#sucursal').val();

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