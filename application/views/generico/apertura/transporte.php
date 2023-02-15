<br>
<style>
  button {
     margin-top: 0px;
  }

  .table-classic {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.table-classic td, .table-classic th {
  border: 1px solid #ddd;
  padding: 8px;
}

.card-header {
    padding: 0.25rem 1.25rem 0.15rem;
}

.table-classic tr:nth-child(even){background-color: #f2f2f2;}

.table-classic tr:hover {background-color: #ddd;}

.table-classic th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #b30035;
  color: black;
}
</style>
<?php if($registro): ?>
  <?php if($cabecera[0]->ESTADO > 13 ):?>
    <div class="row ">
      <div class="col-md-12 text-center">
        <?=img(['src'=>'assets/dist/img/close2.png', 'width' => '15%'])?>
      </div>
    </div>
  <?php endif;?>

  	<nav class="row navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="col-8 col-md-10">
			<a class="navbar-brand" href="#">Entrega</a>
		</div>
		<div class="col-2 col-md-1 btn-group">
			<?php if($cabecera[0]->ESTADO == 13 ):?>
				<?=form_button('agregar', '<span style="font-size:1.5rem" class="las la-save la-2x"></span>', ['class'=>'btn btn-danger btn-xs float-right btn-hide', 'onclick'=>'guardarEntrega()']);?>
		
				<?=form_button('enviar', '<span style="font-size:1.5rem" class="las la-paper-plane la-2x"></span>', ['class'=>'btn btn-success btn-xs float-right btn-hide', 'onclick'=>'enviarEntrega()']);?>
			<?php endif; ?>
		</div>
        
    </nav>

  <br>

<div class="card" id="serializeExample">

  <?=form_open('', '', ['db'=>$db, 'sufijo'=>$sufijo]);?>
  <form method="post">
    <div id="accordion">
      
      <?php foreach ($existencia as $value) : ?>
        <?php $count = 0;?>
        <div id="cat_<?=$value->ID_CATEGORIA?>"  class="card" style="background-color: rgb(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?> )">
          <div class="card-header" id="heading<?=$value->ID_CATEGORIA?>">
            <h6 >
            <?=$value->CATEGORIA?>

              <span class="btn btn-danger float-right btn-xs" data-toggle="collapse" data-target="#collapse<?=$value->ID_CATEGORIA?>" aria-expanded="true" aria-controls="collapseOne">
                <i class="las la-plus" ></i>
              </span>
            </h6>
          </div>

          <div id="collapse<?=$value->ID_CATEGORIA?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body" style="background-color:white">

            <?php $subcategoria = json_decode($value->SUBCATEGORIA)?>

            <div class="accordion" id="accordionExample">
          <?php foreach ($subcategoria as $sub) : ?>
            <?php $count2 = 0 ?>
            <?php if(isset($sub->PRODUCTOS)):?>
          <div id="subcat_<?=$sub->ID_SUB_CATEGORIA_1?>" class="card" style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.6 )">
            <div class="card-header" id="heading_sc_<?=$sub->ID_SUB_CATEGORIA_1?>">
              <h6>
              <?=$sub->SUB_CATEGORIA_1?>
                <span class="btn btn-danger float-right btn-xs" data-toggle="collapse" data-target="#subcollapse<?=$sub->ID_SUB_CATEGORIA_1?>" aria-expanded="true" aria-controls="collapseOne">
                <i class="las la-plus" ></i>
                </span>
              </h6>
            </div>

            <div id="subcollapse<?=$sub->ID_SUB_CATEGORIA_1?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body" style="background-color:white">
                <table class="table-classic" id="table_<?=$sub->ID_SUB_CATEGORIA_1?>">
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Producto</th>
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Unidad Medida</th>
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Cantidad Enviada</th>
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Cantidad Aceptada</th>
					  <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Cantidad Regresada</th>
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Observacion</th>
                      
                      <?php foreach ($sub->PRODUCTOS as $p): ?>
                        <?php if($registro[$p->ID_SUB_CATEGORIA_2] > 0):?> 
                          <?php $count = $count + 1?>
                          <?php $count2 = $count2 + 1?>
                        <tr>
                            <td width="20%"><?=$p->SUB_CATEGORIA_2?></td>
                            <td width="15%">
                              <?=$p->MEDIDA_ESTANDARIZACION?>                          
                            </td>
                            <td width="15%" id="r_<?=$registro[$p->ID_SUB_CATEGORIA_2]?>">
                              <?=$registro[$p->ID_SUB_CATEGORIA_2]?>                      
                            </td>
							<td width="15%" id="r_<?=$registro[$p->ID_SUB_CATEGORIA_2]?>">
                              <?=$aceptada[$p->ID_SUB_CATEGORIA_2]?>                      
                            </td>
                            <td width="20%">
                              <input onblur="checkCantidad(<?=$registro[$p->ID_SUB_CATEGORIA_2]?>,<?=$p->ID_SUB_CATEGORIA_2?>)" id="pro_<?=$p->ID_SUB_CATEGORIA_2?>"  name="<?=$p->ID_SUB_CATEGORIA_2?>[cantidad]" class="form-control enviado" type="number" min="0" max="<?=$registro[$p->ID_SUB_CATEGORIA_2]?>" <?=($cabecera[0]->ESTADO > 13)?'readonly="readonly"':''?> step="1" value="<?=$registro[$p->ID_SUB_CATEGORIA_2]?>">
                            </td>
                            <td width="20%">
                              <input name="<?=$p->ID_SUB_CATEGORIA_2?>[observacion]" class="form-control enviado" type="text" <?=($cabecera[0]->ESTADO > 13)?'readonly="readonly"':''?> value="">
                            </td>
                        </tr>
                        <?php endif; ?>   
                      <?php endforeach; ?>
                      <script>
                        var cantidad2 = '<?=$count2?>';
                        var subcategoria = '<?=$sub->ID_SUB_CATEGORIA_1?>';
                          console.log(subcategoria);
                          if(cantidad2 == 0) {
                            
                            $('#subcat_'+subcategoria).attr("hidden", true);

                          }
                      </script>
                </table>
            </div>
            </div>
          </div>
          <?php endif; ?>
          <?php endforeach; ?>
          <script>
            var cantidad = '<?=$count?>';
            var categoria = '<?=$value->ID_CATEGORIA?>';

              if(cantidad == 0) {
                $('#cat_'+categoria).attr("hidden", true);
              }
          </script>
        </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </form>
</div>
<?php else:?>
  <div class="alert alert-danger" role="alert">
     NO SE HIZO LA PRIMERA DECLARACION DE INVENTARIO DEL DIA
  </div>
 
<?php endif;?>

<script>


    function guardarRecepcion(){

      var collection = $('#serializeExample form').serialize();

      $.post("<?=site_url('guardar-recepcion')?>", collection)
                .done(function( data ) {

                  dato = JSON.parse(data);
               
                  if(dato.status == true) {

                    Swal.fire({
                        icon: 'success',
                        title: "Se ha guardado la recepcion de productos",
                        timer: 4500
                    });

                  }

                  else 
                  {
                    Swal.fire({
                        icon: 'error',
                        title: "No habia nada que actualizar",
                        timer: 4500
                    });
                  }
          
                });
    }


    function enviarRecepcion()
    {
      Swal.fire({
        title: 'Deseas enviar todos los cambios?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Si',
        denyButtonText: 'No',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

          var fecha = '<?=date('Y-m-d')?>'

          $.post("<?=site_url('enviar-recepcion')?>", {fecha:fecha, db:'<?=$db?>', sufijo:'<?=$sufijo?>'})
                .done(function( data ) {

                  Swal.fire('Envio Exitoso!', '', 'success');

                  $('.btn-hide').hide();

                  $('.enviado').attr('readonly', 'readonly');

                });

          
        } else if (result.isDenied) {
          Swal.fire('No se ha enviado aun', '', 'info')
        }
      })
    }


    function checkCantidad(cant, id) {

      var recibida = $('#pro_'+id).val();

      
      if(recibida > cant) {
          $('#pro_'+id).val(cant);
      }

    }
</script>
