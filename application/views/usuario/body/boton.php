<!-- BOOTSTRAP SWITCH-->
<?=link_tag('node_modules/bootstrap4-toggle/css/bootstrap4-toggle.min.css')?>
  <script src="<?=base_url('node_modules/bootstrap4-toggle/js/bootstrap4-toggle.min.js')?>"></script>

<?php foreach ($botones as $value): ?>
    <div class="col-1">
        <p class="lead">N° <?=$value->row?></p>
    </div>
    <div class="col-2 border border-bottom border-gray"><p class="lead" style="font-weight: 500;"><?=$value->REFERENCIA_BOTON?></p></div>
    <div class="col-1"> 
    <input class="align-items-center" name="escogidos[]" value="<?=$value->ID_VENTAS_BOTON?>" type="checkbox" <?=($value->HABILITADO)? 'checked': '' ?>  data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary" data-size="xs" data-on="SI" data-off="NO">
    </div>
<?php endforeach;?>
