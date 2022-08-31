<!-- BOOTSTRAP SWITCH-->
<?=link_tag('node_modules/bootstrap4-toggle/css/bootstrap4-toggle.min.css')?>
  <script src="<?=base_url('node_modules/bootstrap4-toggle/js/bootstrap4-toggle.min.js')?>"></script>

<?php foreach ($menu as $value): ?>

  
    <div class="row">
      <div class="col-6 border border-bottom border-gray"><p class="lead" style="font-weight: 500;"><?=$value->NOMBRE?></p></div>
      <div class="col-2"> 
      <input name="escogidos[]" value="<?=$value->ID_VENTAS_ACCESO?>" type="checkbox" <?=($value->ACCEDE)? 'checked': '' ?>  data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary" data-size="xs" data-on="SI" data-off="NO">
      </div>
    </div>
    <hr>
     <?php $hijos =  $this->main->getQuery('select nombre from ventas_acceso where estado=1 and sistema_general=1 and nivel_superior='.$value->ID_VENTAS_ACCESO)?>
<?php endforeach;?>