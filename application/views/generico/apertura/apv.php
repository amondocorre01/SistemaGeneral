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

<?php if($cabecera AND $cabecera[0]->ESTADO > 10):?>

<?php if($cabecera[0]->ESTADO > 11 ):?>
  <div class="row ">
    <div class="col-md-12 text-center">
    <?=img(['src'=>'assets/dist/img/close2.png', 'width' => '15%'])?>
    </div>
  </div>
<?php endif;?>



<nav class="row navbar navbar-expand-lg navbar-dark bg-dark">

      <div class="col-9 col-md-10">
        <a class="navbar-brand" href="#">Preparacion</a>
      </div>
      <?php if($cabecera[0]->ESTADO == 11 ):?>
        <div class="col-3 col-md-1 btn-group">
            <?=form_button('agregar', '<span style="font-size:1.5rem" class="las la-save la-2x"></span>', ['class'=>'btn btn-danger btn-xs float-right btn-hide', 'onclick'=>'guardarPreparacion()']);?>
            <?=form_button('enviar', '<span style="font-size:1.5rem" class="las la-paper-plane la-2x"></span>', ['class'=>'btn btn-success btn-xs float-right btn-hide', 'onclick'=>'enviarPreparacion()']);?>
        </div>
      <?php endif;?>

      
         
       

    </nav>

<br>
<div class="card" id="serializeExample">

  <?=form_open('', '', ['db'=>$db, 'sufijo'=>$sufijo, 'fecha'=>$fecha]);?>
        
    <div id="accordion">
      <?php foreach ($existencia as $value) : ?>
        <?php $count = 0?>
        <div id="cat_<?=$value->ID_CATEGORIA?>" class="card" style="background-color: rgb(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?> )">
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

            <?php if(isset($sub->PRODUCTOS)):?>
          <div class="card" style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.6 )">
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
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Stock Solicitado</th>
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Stock Enviado</th>
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Turno</th>
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Observaciones</th>
                      <?php foreach ($sub->PRODUCTOS as $p): ?>
                        <?php if($registro[$p->ID_SUB_CATEGORIA_2] > 0):?> 
                          <?php $count = $count + 1?>
                        <tr>
                            <td width="30%"><?=$p->SUB_CATEGORIA_2?></td>
                            <td width="15%">
                              <?=$p->MEDIDA_ESTANDARIZACION?>                          
                            </td>
                            <td width="10%" id="a_<?=$p->ID_SUB_CATEGORIA_2?>">
                            <?=$registro[$p->ID_SUB_CATEGORIA_2]?>
                            </td>

                            <td width="10%" id="m_<?=$p->ID_SUB_CATEGORIA_2?>">
                                <input name="<?=$p->ID_SUB_CATEGORIA_2?>[id]" class="form-control reset_input_stock" type="number" min="0" <?=($estado[$p->ID_SUB_CATEGORIA_2]>='12')?'readonly="readonly"':''?> step="1" value="<?=$solicitada[$p->ID_SUB_CATEGORIA_2]?>">
                            </td>

                            <td width="18%" id="m_<?=$p->ID_SUB_CATEGORIA_2?>">
                                <select name="<?=$p->ID_SUB_CATEGORIA_2?>[turno]" id="" class="form-control reset_input_stock">
                                  <?php foreach($turnos AS $turno):?>
                                    <option value="<?=$turno->TURNO?>" <?=($turno->TURNO == $envio[$p->ID_SUB_CATEGORIA_2] )?'selected':'' ?>><?=$turno->TURNO?></option>
                                  <?php endforeach;?>
                                </select>
                            </td>

                            <td width="15%">                                
                              <input id="o_<?=$p->ID_SUB_CATEGORIA_2?>" name="<?=$p->ID_SUB_CATEGORIA_2?>[observacion]" class="form-control reset_input_stock" <?=($estado[$p->ID_SUB_CATEGORIA_2]>='12')?'readonly="readonly"':''?> type="text" value="<?=$observacion[$p->ID_SUB_CATEGORIA_2]?>">
                            </td>
                        </tr>
                        <?php endif; ?>
                      <?php endforeach; ?>
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
  <?=form_close();?>
</div>
<?php else:?>

  <div class="alert alert-danger" role="alert">
     NO SE HA ENVIADO SOLICITUDES PARA EL DIA
  </div>

<?php endif;?>

<script>

    
  //  $('.collapse').collapse();


    function guardarPreparacion(){

      var collection = $('#serializeExample form').serialize();

      $.post("<?=site_url('guardar-preparacion')?>", collection)
                .done(function( data ) {

                  dato = JSON.parse(data);
               
                  if(dato.status == true) {

                    Swal.fire({
                        icon: 'success',
                        title: "Se ha guardado las cantidades solicitadas",
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


    function enviarPreparacion()
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


          $.post("<?=site_url('enviar-preparacion')?>", {db:'<?=$db?>', sufijo:'<?=$sufijo?>'})
                .done(function( data ) {
                  dato = JSON.parse(data);

                  if(dato.status == true){
                    Swal.fire('Envio Exitoso!', '', 'success');

                    $('.btn-hide').hide();
                      $('#lista').hide();
                      

                      $('.reset_input_stock').attr('readonly', 'readonly');
                  }

                  else {
                    Swal.fire('No habia ninguna modificacion', '', 'info');
                  }
                  
                });

          
        } else if (result.isDenied) {
          Swal.fire('No se ha enviado aun', '', 'info')
        }
      })
    }
</script>
