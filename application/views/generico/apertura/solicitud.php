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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Solicitudes</a>
        <?=form_button('agregar', '<span style="font-size:1.5rem" class="las la-save la-2x"></span>', ['class'=>'btn btn-danger btn-xs float-right', 'onclick'=>'guardarPedido()']);?>

        <?=form_button('enviar', '<span style="font-size:1.5rem" class="las la-paper-plane la-2x"></span>', ['class'=>'btn btn-success btn-xs float-right', 'onclick'=>'enviarPedido()']);?>

        <div class="row">
          <div class="col-12">
              <select name="" id="lista" class="form-control" onchange="getMinimos()">
                <option value=""></option>
                <?php foreach ($lista as $item): ?>
                  <option value="<?=$item->ID?>"><?=$item->TEXT?></option>
                <?php endforeach; ?>
              </select>
          </div>
        </div>

    </nav>


<br>
<div class="card" id="serializeExample">
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
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Stock</th>
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Stock Minimo</th>
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Solicitud</th>
                      <?php foreach ($sub->PRODUCTOS as $p): ?>
                        <tr>
                            <td width="30%"><?=$p->SUB_CATEGORIA_2?></td>
                            <td width="15%">
                              <?=$p->MEDIDA_ESTANDARIZACION?>                          
                            </td>
                            <td width="15%">
                            <?=$registro[$p->ID_SUB_CATEGORIA_2]?>
                            </td>

                            <td width="15%" id="m_<?=$p->ID_SUB_CATEGORIA_2?>">
                              0
                            </td>

                            <td width="15%">
                              <input name="<?=$p->ID_SUB_CATEGORIA_2?>" class="form-control" type="number" min="0" <?=($estado[$p->ID_SUB_CATEGORIA_2])?'readonly="readonly"':''?> step="1" value="0">
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

<script>

    
  //  $('.collapse').collapse();


    function guardarPedido(){

      var collection = $('#serializeExample form').serialize();

      $.post("<?=site_url('guardar-declaracion')?>", collection)
                .done(function( data ) {

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


    function enviarPedido()
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

          $.post("<?=site_url('enviar-declaracion')?>", {fecha:fecha})
                .done(function( data ) {

                });

          Swal.fire('Envio Exitoso!', '', 'success')
        } else if (result.isDenied) {
          Swal.fire('No se ha enviado aun', '', 'info')
        }
      })
    }

    function getMinimos() {

      d = document.getElementById("lista").value;
    
      $.post("<?=site_url('get-minimo-stock')?>", {lista:d})
      .done(function( data ) {

        minimos = JSON.parse(data);

        $.each(minimos.minimos, function (i, v) { 
          
          $('#m_'+v.ID_SUB_CATEGORIA_2).empty();
          $('#m_'+v.ID_SUB_CATEGORIA_2).html(v.STOCK);
        });

      });

    }
</script>
