<div class="row">
  <div class="col-12">
      <table class="table">
          <tr>
            <th>N°</th>
            <th>Referencia Boton</th>
            <th>Accion</th>
          </tr>

        <?php foreach ($respuesta as $value): ?>
          <tr>
            <td><p class="lead"><?=$value->row?></p></td>
            <td><p class="lead"><?=$value->REFERENCIA_BOTON?></p></td>
            <td>
              <select class="form-control <?=($value->HABILITADO == 1)?' palette-Green-A100 bg':''?>" name="" id="estado_<?=$value->ID?>" onchange="change(<?=$value->ID?>)">
                <option value="1" <?=($value->HABILITADO == 1) ? 'selected ="selected"': '' ?>" > HABILITADO</option>
                <option value="0" <?=($value->HABILITADO == 0) ? 'selected ="selected"': '' ?>" > INHABILITADO</option>
              </select>
            </td>
          </tr>
        <?php endforeach;?>
      </table>
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

</script>
