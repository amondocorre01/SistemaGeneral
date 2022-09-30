
<?php foreach ($categorias as $categoria) : ?>
  <div class="row">
      <div class="col-md-4">
         <h6><?=$categoria->CATEGORIA?></h6>
      </div>
      <div class="col-md-2  comanda_1">
         <div class="form-check">
            <input class="form-check-input" type="radio" value="1" name="defaultCheck<?=$categoria->ID_CATEGORIA?>">
         </div>
      </div>

      <div class="col-md-2 comanda_2">
         <div class="form-check">
            <input class="form-check-input" type="radio" value="1" name="defaultCheck<?=$categoria->ID_CATEGORIA?>">
         </div>
      </div>

      <div class="col-md-2 comanda_3">
         <div class="form-check">
            <input class="form-check-input" type="radio" value="1" name="defaultCheck<?=$categoria->ID_CATEGORIA?>">
         </div>
      </div>

      <div class="col-md-2 comanda_4">
         <div class="form-check">
            <input class="form-check-input" type="radio" value="1" name="defaultCheck<?=$categoria->ID_CATEGORIA?>">
         </div>
      </div>
  </div>
<?php endforeach; ?>