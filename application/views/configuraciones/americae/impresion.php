<div class="row">
   <div class="col-3">
      <input class="form-control" type="number" name="num_comandas" id="num_comandas" onchange="ocultar($(this).val())" min="1" max="4" step="1">
   </div>
</div>

<?php foreach ($categorias as $categoria) : ?>
  <div class="row">
      <div class="col-md-4">
         <h6><?=$categoria->CATEGORIA?></h6>
      </div>
      <div class="col-md-2  comanda_1">
         <div class="form-check">
            <input class="form-check-input" onclick=elegir($(this)); type="radio" value="1" name="defaultCheck<?=$categoria->ID_CATEGORIA?>">
         </div>
      </div>

      <div class="col-md-2 comanda_2">
         <div class="form-check">
            <input class="form-check-input" onclick=elegir($(this)); type="radio" value="2" name="defaultCheck<?=$categoria->ID_CATEGORIA?>" id=>
         </div>
      </div>

      <div class="col-md-2 comanda_3">
         <div class="form-check">
            <input class="form-check-input" onclick=elegir($(this)); type="radio" value="3" name="defaultCheck<?=$categoria->ID_CATEGORIA?>">
         </div>
      </div>

      <div class="col-md-2 comanda_4">
         <div class="form-check">
            <input class="form-check-input" onclick=elegir($(this)); type="radio" value="4" name="defaultCheck<?=$categoria->ID_CATEGORIA?>">
         </div>
      </div>
  </div>
<?php endforeach; ?>

<script>
   function ocultar(n){

     switch(n) {  
      case  '1': 
         $('.comanda_2').hide('slow');
         $('.comanda_3').hide('slow');
         $('.comanda_4').hide('slow');
      break; 
      
      case  '2': 
         $('.comanda_2').show('slow');
         $('.comanda_3').hide('slow');
         $('.comanda_4').hide('slow');
      break; 
      
      case '3': 
         $('.comanda_2').show('slow');
         $('.comanda_3').show('slow');
         $('.comanda_4').hide('slow');
      break;

      case '4': 
         $('.comanda_2').show('slow');
         $('.comanda_3').show('slow');
         $('.comanda_4').show('slow');
      break;


      
   }
}


function elegir(cadena) {

   var name = cadena.attr('name');
   var contenido = name.split('defaultCheck');

   var valor = cadena.val();
   var categoria = contenido[1];

   $.post('<?=site_url('comanda-americae')?>', {categoria:categoria, valor:valor})
   .done(function(response){

      

   });

}

</script>