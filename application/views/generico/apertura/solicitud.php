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
<?php if($cabecera AND $cabecera[0]->ESTADO > 9): ?>


  <div class="dropdown show">
    <a class="btn btn-secondary dropdown-toggle palette-Red-700 bg" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     Descargar Reportes
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <a class="dropdown-item" href="<?=site_url('solicitud-excel/'.$db.'/'.$sufijo)?>"><i class="las la-file-excel la-2x palette-Green-600 text"></i>  <b>Excel</b>  </a>
    </div>
  </div>

  <br><br>



<br>


<nav class="row navbar navbar-expand-lg navbar-dark bg-dark">

      <div class="col-9 col-md-6">
        <a class="navbar-brand" href="#">Solicitudes</a>
      </div>
      <?php if($cabecera[0]->ESTADO == 10 ):?>
      <div class="col-3 col-md-1 btn-group">
        <?=form_button('agregar', '<span style="font-size:1.5rem" class="las la-save la-2x"></span>', ['class'=>'btn btn-danger btn-xs float-right btn-hide', 'onclick'=>'guardarSolicitud()']);?>
      
        <?=form_button('enviar', '<span style="font-size:1.5rem" class="las la-paper-plane la-2x"></span>', ['class'=>'btn btn-success btn-xs float-right btn-hide', 'onclick'=>'enviarPedido()']);?>
      </div>

      <?php endif;?>
    </nav>


<br>
<div class="card" id="serializeExample">

  <?=form_open('', '', ['db'=>$db, 'sufijo'=>$sufijo]);?>


  <div class="row justify-content-center">
  <div class="col-8 col-md-4">
    <label for="">Perfil de Pedido</label>
    <div class="input-group">
      <select name="lista" id="lista" class="form-control">
        <option value=""></option>
        <?php foreach ($lista as $item): ?>
          <option <?=($item->ID == $cabecera[0]->PERFIL)? 'selected': ''?> value="<?=$item->ID?>"><?=$item->TEXT?></option>
        <?php endforeach; ?>
      </select>
      <div class="input-group-append">
      <?=form_button('obtener', '<span style="font-size:1.5rem" class="las la-search la-2x"></span>', ['class'=>'btn btn-success btn-xs float-right', 'onclick'=>'getMinimos()']);?>
      <?=form_button('limpiar', '<span style="font-size:1.5rem" class="las la-broom la-2x"></span>', ['class'=>'btn btn-danger btn-xs float-right', 'onclick'=>'setLimpiar()']);?>
      <?php if($cabecera[0]->ESTADO > 10 ):?>
        <?=form_button('cerrar', '<span class="las la-lock la-2x"></span>', ['class'=>'btn palette-Grey-600 bg btn-xs float-right', 'onclick'=>'cerrarTodo()']);?>

          <?=form_button('abrir', '<span class="las la-key la-2x"></span>', ['class'=>'btn palette-Pink-800 bg btn-xs float-right', 'onclick'=>'abrirTodo()']);?>
          <?php endif;?>
      </div>
    </div>
  </div>
</div>
<br>


        
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
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Unidad Conteo</th>
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Stock</th>
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Stock Minimo</th>
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Medida Solicitud</th>
                      <th style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.4 )">Solicitud</th>
                      <?php foreach ($sub->PRODUCTOS as $p): ?>
                        <tr>
                            <td width="25%"><?=$p->SUB_CATEGORIA_2?></td>
                            <td width="12%">
                              <?=$p->MEDIDA_ESTANDARIZACION?>                          
                            </td>
                            <td width="12%" id="a_<?=$p->ID_SUB_CATEGORIA_2?>">
                            <?=$registro[$p->ID_SUB_CATEGORIA_2]?>
                            </td>

                            <td width="12%">
                              <input id="m_<?=$p->ID_SUB_CATEGORIA_2?>" name="<?=$p->ID_SUB_CATEGORIA_2?>[minimo]" class="form-control" type="number" min="0" <?=($estado[$p->ID_SUB_CATEGORIA_2]>='11')?'readonly="readonly"':''?> step="1" value="<?=$minimo[$p->ID_SUB_CATEGORIA_2]?>">
                            </td>

                            <td width="12%">
                              <?=(isset($p->MEDIDA_ADECUACIÓN))?$p->MEDIDA_ADECUACIÓN: ''?>
                            </td>

                            <td width="20%">    
                              <input id="p_<?=$p->ID_SUB_CATEGORIA_2?>" type="hidden" value="<?=$p->CANTIDAD_ADECUACION_PEDIDOS?>"> 
                              
                              <input name="<?=$p->ID_SUB_CATEGORIA_2?>[precargado]" id="h_<?=$p->ID_SUB_CATEGORIA_2?>" type="hidden" value="<?=$precargado[$p->ID_SUB_CATEGORIA_2]?>"> 
                            
                              <div class="input-group">
                              <input id="s_<?=$p->ID_SUB_CATEGORIA_2?>" name="<?=$p->ID_SUB_CATEGORIA_2?>[cantidad]" class="form-control reset_input_stock" type="number" min="0" <?=($estado[$p->ID_SUB_CATEGORIA_2]>='11')?'readonly="readonly"':''?> step="1" oninput="noPrecargar(<?=$p->ID_SUB_CATEGORIA_2?>)" value="<?=$solicitud[$p->ID_SUB_CATEGORIA_2]?>">

                              <div class="input-group-append">
                                <button id="b_<?=$p->ID_SUB_CATEGORIA_2?>" onclick="enable(<?=$p->ID_SUB_CATEGORIA_2?>)" class="btn <?=($precargado[$p->ID_SUB_CATEGORIA_2])? 'btn-success':'btn-danger'?>" type="button">
                                  <i class="las la-hand-point-left"></i>
                                </button>
                              </div>
                            </div>
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
  <?=form_close();?>
</div>

<?php else:?>
  <div class="alert alert-danger" role="alert">
     NO SE HA ENVIADO INVENTARIO DEL DIA
  </div>
<?php endif;?>

<script>

    function guardarSolicitud(){

      var collection = $('#serializeExample form').serialize();
      $('.loading').show();


      $.post("<?=site_url('guardar-solicitud')?>", collection)
                .done(function( data ) {
                  $('.loading').hide();


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

          
          var fecha = '<?=$this->session->fecha_conteo?>';
          $('.loading').show();

          $.post("<?=site_url('enviar-pedido')?>", {ubicacion:<?=$sucursal?> ,fecha:fecha, db:'<?=$db?>', sufijo:'<?=$sufijo?>'})
                .done(function( data ) {
                  $('.loading').hide();

                  dato = JSON.parse(data);

                  if(dato.status == true){
                    Swal.fire('Envio Exitoso!', '', 'success');

                      $('.btn-hide').hide();
                      $('#lista').hide();
                      

                      $('.reset_input_stock').attr('readonly', 'readonly');
                  }

                  else {
                    Swal.fire(dato.message, '', 'info');
                  }
                  
                });

          
        } else if (result.isDenied) {
          Swal.fire('No se ha enviado aun', '', 'info')
        }
      })
    }

    function getMinimos() {

      Swal.fire({
        title: 'Deseas cargar la sugerencia del perfil?, puedes perder toda informacion guardada anteriormente ',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Si',
        denyButtonText: 'No',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {


          d = document.getElementById("lista").value;
    
      $.post("<?=site_url('get-minimo-stock')?>", {lista:d})
      .done(function( data ) {

        response = JSON.parse(data);

        

        $('.reset_stock').empty();
        $('.reset_stock').append(0);

        
        $.each(response.productos, function (key, val) { 
           var status = $('#h_'+val.ID_SUB_CATEGORIA_2).val();
           if(status == 1){
            $('#s_'+val.ID_SUB_CATEGORIA_2).val(0);
           }
        }); 



        $.each(response.productos, function (i, v) { 
          
          precargado = $('#h_'+v.ID_SUB_CATEGORIA_2).val();

          console.log(precargado);

          if(precargado == 1) 
          {
              //$('#m_'+v.ID_SUB_CATEGORIA_2).empty();
              $('#m_'+v.ID_SUB_CATEGORIA_2).val(Number(v.STOCK));

              var operacion = ((Number(v.STOCK) * Number(v.ADECUACION))-Number($('#a_'+v.ID_SUB_CATEGORIA_2).html()));
              //operacion = Math.ceil(operacion / Number($('#p_'+v.ID_SUB_CATEGORIA_2).val()));
              //operacion = (operacion / Number($('#p_'+v.ID_SUB_CATEGORIA_2).val()));
              operacion = (operacion / Number($('#a_'+v.ID_SUB_CATEGORIA_2).html()));
              if( operacion >=0.5)
              {
                $('#s_'+v.ID_SUB_CATEGORIA_2).val(Math.ceil(operacion));
              }

              else 
              {
                $('#s_'+v.ID_SUB_CATEGORIA_2).val(0);
              }
          }

          

          
        });

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
    
    $.post("<?=site_url('verificar-solicitud')?>", {db:'<?=$db?>', sufijo:'<?=$sufijo?>'})
          .done(function( data ) {
            $('.loading').hide();
            dato = JSON.parse(data);

            if(dato.status == true) {
              Swal.fire('El formulario fue abierto', '', 'success');
              $('.reset_input_stock').attr('readonly',false);
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

  $.post("<?=site_url('verificar-solicitud')?>", {db:'<?=$db?>', sufijo:'<?=$sufijo?>'})
        .done(function( data ) {
          $('.loading').hide();
          dato = JSON.parse(data);

          if(dato.status == true) {
            guardarSolicitud();
            Swal.fire('El formulario fue guardado y cerrado', '', 'success');
            $('.reset_input_stock').attr('readonly',true);
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

function noPrecargar(id) {
  $('input[name="' + id + '[precargado]"]').val(0);
}

function enable(id) {
  
  var status =  $('#h_'+id).val();

  console.log(status);

  if(status == 1) {
    $('#h_'+id).val(0);
    $('#b_'+id).removeClass('btn-success');
    $('#b_'+id).addClass('btn-danger');
  }

  else 
  {
    $('#h_'+id).val(1);
    $('#b_'+id).removeClass('btn-danger');
    $('#b_'+id).addClass('btn-success');
  }

}


function setLimpiar() {

  Swal.fire({
    title: 'Deseas limpiar todas la modificaciones manuales?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: 'Si',
    denyButtonText: 'No',
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {

  $.post("<?=site_url('set-limpiar')?>")
   .done(function( data ) {

    response = JSON.parse(data);
    
    $.each(response.productos, function (key, val) { 
      var status = $('#h_'+val.ID_SUB_CATEGORIA_2).val();
      if(status == 0){
        $('#s_'+val.ID_SUB_CATEGORIA_2).val(0);
      }
    }); 
  });

      
    } else if (result.isDenied) {
      Swal.fire('Ha elegido no limpiar', '', 'info')
    }
  })
}
</script>
