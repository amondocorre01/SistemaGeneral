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
 

  <nav class="row navbar navbar-expand-lg navbar-dark bg-dark">
        
        
          <div class="col-9 col-md-10">
            <a class="navbar-brand" href="#">Inventario</a>
          </div>
          <div class="col-3 col-md-2 btn-group">
              <?php if($cabecera[0]->ESTADO == 9 ):?>
                  <?=form_button('agregar', '<span style="font-size:1.5rem" class="las la-save la-2x"></span>', ['class'=>'btn btn-danger btn-xs float-right btn-hide', 'onclick'=>'guardarDeclaracion()']);?>
            
                  <?=form_button('enviar', '<span style="font-size:1.5rem" class="las la-paper-plane la-2x"></span>', ['class'=>'btn btn-success btn-xs float-right btn-hide', 'onclick'=>'enviarDeclaracion()']);?>

                  <?php if($cabecera[0]->ESTADO > 9 ):?>
                    <?=form_button('cerrar', '<span class="las la-lock la-2x"></span>', ['class'=>'btn btn-danger btn-xs float-right', 'onclick'=>'cerrarTodo()']);?>
                    <?=form_button('abrir', '<span class="las la-key la-2x"></span>', ['class'=>'btn btn-success btn-xs float-right', 'onclick'=>'abrirTodo()']);?>
                <?php endif;?>
               <?php endif; ?>
          </div>
        
    </nav>

  <br>

<div class="card" id="serializeExample">

  <?=form_open('', '', ['db'=>$db, 'sufijo'=>$sufijo]);?>
  <form method="post">
    <div id="accordion">
      <?php foreach ($existencia as $value) : ?>
        <div class="card" style="background-color: rgb(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?> )">
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
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Nota</th>
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Cantidad Declarada</th>
                      <?php foreach ($sub->PRODUCTOS as $p): ?>
                        <tr>
                            <td width="30%"><?=$p->SUB_CATEGORIA_2?></td>
                            <td width="20%">
                              <?=$p->MEDIDA_ESTANDARIZACION?>                          
                            </td>
                            <td width="30%">
                              <small><?=$p->NOTA?></small>
                            </td>
                            <td width="20%">
                              <input name="<?=$p->ID_SUB_CATEGORIA_2?>" class="form-control enviado" type="number" min="0" <?=($cabecera[0]->ESTADO > 9)?'readonly':''?> step="1" value="<?=$registro[$p->ID_SUB_CATEGORIA_2]?>">
                            </td>
                        </tr>
                      <?php endforeach; ?>
                </table>
            </div>
            </div>
          </div>
          <?php endif; ?>
          <?php endforeach; ?>
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


    function guardarDeclaracion(){

      var collection = $('#serializeExample form').serialize();
      $('.loading').show();
      $.post("<?=site_url('guardar-declaracion')?>", collection)
                .done(function( data ) {
                  $('.loading').hide();
                  dato = JSON.parse(data);
               
                  if(dato.status == true) {

                    Swal.fire({
                        icon: 'success',
                        title: "Se ha guardado las cantidades inventariadas",
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


    function enviarDeclaracion()
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
          $('.loading').show();
          var fecha = '<?=date('Y-m-d')?>'

          $.post("<?=site_url('enviar-declaracion')?>", {fecha:fecha, db:'<?=$db?>', sufijo:'<?=$sufijo?>'})
                .done(function( data ) {
                  $('.loading').hide();
                  Swal.fire('Envio Exitoso!', '', 'success');

                  $('.btn-hide').hide();

                  $('.enviado').attr('readonly', 'readonly');

                });

          
        } else if (result.isDenied) {
          Swal.fire('No se ha enviado aun', '', 'info')
        }
      })
    }

    function abrirTodo() {

      Swal.fire({
        title: 'Deseas abrir el formulario?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Si',
        denyButtonText: 'No',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $('.loading').show();
          var fecha = '<?=date('Y-m-d')?>'

          $.post("<?=site_url('abrir-declaracion')?>", {fecha:fecha, db:'<?=$db?>', sufijo:'<?=$sufijo?>'})
                .done(function( data ) {
                  $('.loading').hide();
                  dato = JSON.parse(data);

                  if(dato.status == true) {
                    Swal.fire('El formulario fue abierto', '', 'success');
                    $('.enviado').attr('readonly',false);
                  }
                  else {
                    Swal.fire('No se cumplieron las condiciones para abrir el formuario', '', 'info');
                  }
                });

          
        } else if (result.isDenied) {
          Swal.fire('No se ha enviado aun', '', 'info')
        }
      })
    }


    function cerrarTodo() {

    Swal.fire({
      title: 'Deseas cerrar y guardar el formulario?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Si',
      denyButtonText: 'No',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        $('.loading').show();
        var fecha = '<?=date('Y-m-d')?>'

        $.post("<?=site_url('abrir-declaracion')?>", {fecha:fecha, db:'<?=$db?>', sufijo:'<?=$sufijo?>'})
              .done(function( data ) {
                $('.loading').hide();
                dato = JSON.parse(data);

                if(dato.status == true) {
                  guardarDeclaracion();
                  Swal.fire('El formulario fue guardado y cerrado', '', 'success');
                  $('.enviado').attr('readonly',true);
                }
                else {
                  Swal.fire('No se cumplieron las condiciones para cerrar y guardar el formuario', '', 'info');
                }
              });

        
      } else if (result.isDenied) {
        Swal.fire('No se ha enviado aun', '', 'info')
      }
    })
  }
</script>
