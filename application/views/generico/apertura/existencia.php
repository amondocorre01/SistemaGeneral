<br>
<style>
  button {
     margin-top: 0px;
  }
</style>
<div id="accordion">
  <?php foreach ($existencia as $value) : ?>
    <div class="card" style="background-color: rgb(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?> )">
      <div class="card-header" id="heading<?=$value->ID_CATEGORIA?>">
        <h5 class="mb-0">
        <?=$value->CATEGORIA?>

          <button class="btn btn-danger float-right btn-xs" data-toggle="collapse" data-target="#collapse<?=$value->ID_CATEGORIA?>" aria-expanded="true" aria-controls="collapseOne">
            <i class="las la-plus" ></i>
          </button>
        </h5>
      </div>

      <div id="collapse<?=$value->ID_CATEGORIA?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body" style="background-color:white">

        <?php $subcategoria = json_decode($value->SUBCATEGORIA)?>

        <div class="accordion" id="accordionExample">
			<?php foreach ($subcategoria as $sub) : ?>
			<div class="card" style="background-color: rgba(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?>, 0.5 )">
			<div class="card-header" id="heading_sc_<?=$sub->ID_SUB_CATEGORIA_1?>">
			<h5 class="mb-0">
			<?=$sub->SUB_CATEGORIA_1?>
				<button class="btn btn-danger float-right btn-xs" data-toggle="collapse" data-target="#subcollapse<?=$sub->ID_SUB_CATEGORIA_1?>" aria-expanded="true" aria-controls="collapseOne">
				<i class="las la-plus" ></i>
				</button>
			</h5>
			</div>

				<div id="subcollapse<?=$sub->ID_SUB_CATEGORIA_1?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body" style="background-color:white">
					Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
				</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

           
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<script>
    $('.collapse').collapse()
</script>







<!--
<div id="accordion">
  <?php foreach ($existencia as $value) : ?>
    <div class="card" style="background-color: rgb(<?=$value->COLOR_R?>, <?=$value->COLOR_G?>, <?=$value->COLOR_B?> )">
      <div class="card-header" id="heading<?=$value->ID_CATEGORIA?>">
        <h5 class="mb-0">
        <?=$value->CATEGORIA?>

          <button class="btn btn-danger float-right btn-xs" data-toggle="collapse" data-target="#collapse<?=$value->ID_CATEGORIA?>" aria-expanded="true" aria-controls="collapseOne">
            <i class="las la-plus" ></i>
          </button>
        </h5>
      </div>

      <div id="collapse<?=$value->ID_CATEGORIA?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body" style="background-color:white">
            <table id="table_<?=$value->ID_CATEGORIA?>">
                           
            </table>
          
            <script>
              var table = $('#table_<?=$value->ID_CATEGORIA?>').DataTable({
                  responsive: true,
                  data: '<?=$value->PRODUCTOS?>',
                  language:{ search: "Buscar", lengthMenu: "Mostrar _MENU_", previous: "Anterior",
                  zeroRecords: "Sin resultados", infoEmpty: "No hay registros disponibles",
                  info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                  infoFiltered: "(Filtrado de _MAX_ registros totales)",
                  oPaginate: {sNext:"Siguiente", sLast: "Último", sPrevious: "Anterior", sFirst:"Primero" },
                  },
                  columns: [
                      { title: 'N°', width:'10%',data: 'row' },
                      { title: 'Producto', width:'10%' ,data: 'PRODUCTO_MADRE' },
                      { title: 'Sub-categoria', width:'10%' ,data: 'CATEGORIA_2' },
                      { title: 'Categoria', width:'10%' ,data: 'CATEGORIA' },
                      { title: 'Precio', width:'10%' ,data: 'PRECIO' },
                      { title: 'Lista', width:'10%' ,data: 'NOMBRE_LISTA_PRECIOS' },
                  ],
              });
            </script>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>


<!--

<table id="table_<?=$value->ID_CATEGORIA?>">
                           
                           </table>
                         
                           <script>
                             var table = $('#table_<?=$value->ID_CATEGORIA?>').DataTable({
                                 responsive: true,
                                 data: '<?=$value->PRODUCTOS?>',
                                 language:{ search: "Buscar", lengthMenu: "Mostrar _MENU_", previous: "Anterior",
                                 zeroRecords: "Sin resultados", infoEmpty: "No hay registros disponibles",
                                 info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                 infoFiltered: "(Filtrado de _MAX_ registros totales)",
                                 oPaginate: {sNext:"Siguiente", sLast: "Último", sPrevious: "Anterior", sFirst:"Primero" },
                                 },
                                 columns: [
                                     { title: 'N°', width:'10%',data: 'row' },
                                     { title: 'Producto', width:'10%' ,data: 'PRODUCTO_MADRE' },
                                     { title: 'Sub-categoria', width:'10%' ,data: 'CATEGORIA_2' },
                                     { title: 'Categoria', width:'10%' ,data: 'CATEGORIA' },
                                     { title: 'Precio', width:'10%' ,data: 'PRECIO' },
                                     { title: 'Lista', width:'10%' ,data: 'NOMBRE_LISTA_PRECIOS' },
                                 ],
                             });
                           </script>
                            -->