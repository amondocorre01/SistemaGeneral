<div class="row">
  <div class="col-12">
      <table class="table">
          <tr>
            <th>
              N°
            </th>
            <th>
              Referencia Boton
            </th>
            <th>
              Accion
            </th>
          </tr>

        <?php foreach ($respuesta as $value): ?>
          <tr>
            <td>
              <p class="lead"><?=$value->row?></p>
            </td>
            <td>
              <p class="lead"><?=$value->REFERENCIA_BOTON?></p>
            </td>
            <td>
              <select class="form-control" name="" id="estado_<?=$value->ID?>" onchange="change(<?=$value->ID?>)">
                <option value="1" <?=($value->HABILITADO == 1) ? 'selected ="selected"': '' ?>" > HABILITADO</option>
                <option value="0" <?=($value->HABILITADO == 0) ? 'selected ="selected"': '' ?>" > INHABILITADO</option>
              </select>
            </td>
          </tr>
        <?php endforeach;?>
      </table>
  </div>
</div>
  

<div class="row">
    <div class="col-3">
      <?=form_button('habilitar', 'Habilitar Todos', ['id'=>'habilitar', 'class'=>'btn btn-danger btn-lg', 'onclick'=>'cambiarTodos('.$id_usuario.','.$id_menu.', 1)'  ]);?>
    </div>

    <div class="col-3">
      <?=form_button('habilitar', 'Desactivar Todos', ['id'=>'habilitar', 'class'=>'btn btn-dark btn-lg', 'onclick'=>'cambiarTodos('.$id_usuario.','.$id_menu.', 0)']);?>
    </div>
</div>


<script>

  function change(id) {

    var estado = $('#estado_'+id).val();

    if(id > 0) {

        $.post("<?=site_url('set-estado-boton')?>", {id:id, estado:estado})
        .done(function( data ) {

            console.log(data);
        
        });
    }
  }


  function cambiarTodos(usuario, menu, estado) {

    $.post("<?=site_url('set-estado-botones')?>", {usuario:usuario, menu:menu, estado:estado})
        .done(function( data ) {

          Swal.fire({
              icon: 'success',
              title: 'Se ha actualizado el estado de los botones',
              timer: 4500
          });

          setTimeout(function(){
            window.location.href = "<?=$url.'?vc='.$vc?>";
          }, 2000);
        
        });
  }

</script>
