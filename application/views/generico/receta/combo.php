<?=link_tag('assets/plugins/select2/css/select2.min.css')?>
<?=link_tag('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>
<script src="<?=base_url('assets/plugins/select2/js/select2.js')?>" ></script>

<style>
	.myFont{
		font-size: 1rem;
	}
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
			<div class="card-header">
				<h3 class="card-title">Receta Combo</h3>
			</div>
			
			<div class="card-body" id="serializeExample">
				<form action="<?=current_url()?>" method="GET" id="form_fecha">

					<div class="row">
						<div class="col-md-3">
							<label for="menuCombo"> Menu Combo</label>
							<select name="menuCombo" id="menuCombo" class="form-control" style="width: 100%;">
								<option value="" selected="selected">Seleccione una Opción</option>
								<?php foreach ($combo as $key => $value) : ?>
									<option value="<?=$value->ID_CATEGORIA_1?>"><?=$value->COMBO_MADRE.'-'.$value->NOMBRE_MENU?></option>;
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-md-4 btn-group">
							<button onclick="buscarElementos()" class="btn btn-success btn-lg" type="button"><i class="las la-search la-1x"></i>Buscar</button>
							<button onclick="verModal()" class="btn btn-danger btn-lg" type="button"><i class="las la-plus la-1x"></i>Agregar</button>
							<button onclick="limpiarElementos()" class="btn btn-info btn-lg" type="button"><i class="las la-broom la-1x"></i>Limpiar</button>
							
						</div>
					</div>

					<br><hr><br><br>

					<div id="buscador">

					<div class="row control-group" id="elemento_combo">
						<div class="col-md-3">
							
							<div class="form-group">
							<label>Categoria</label>
							<span onclick="rowsCat1()" class="btnShowProducts btn-info btn-xs" title="Agregar los elementos"><i class="fa fa-plus"></i></span>
							<select name="productoCategoria1" id="productoCategoria1" class="form-control myFont select2" style="width: 100%;" onchange="getCategoria2()">
								<option value="">---Seleccione una opcion---</option>
								<option value="-1">Todos</option>
								<?php
									foreach ($primeraCategoria as $key => $value) {
										echo '<option value="'.$value->ID_CATEGORIA.'">'.$value->CATEGORIA.'</option>';
									}
								?>
							</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							<label>Subcategoria</label>
							<span onclick="rowsCat2()" class="btnShowProducts btn-info btn-xs" title="Agregar los elementos"><i class="fa fa-plus"></i></span>
							<select name="productoCategoria2" id="productoCategoria2" class="form-control myFont select2" style="width: 100%;" onchange="getProductoMadre()" >
								<option value="" selected="selected">Seleccione la segunda categoria</option>
							</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							<label>Producto</label>
							<span onclick="rowsCat3()" class="btnShowProducts btn-info btn-xs" title="Agregar los elementos"><i class="fa fa-plus"></i></span>
							<select name="productoMadre" id="productoMadre" class="form-control myFont select2" style="width: 100%;" onchange="getProductoUnico()">
								
							</select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
							<label>Presentacion</label>
							<span onclick="rowsCat4()" class="btnShowProducts btn-info btn-xs" title="Agregar los elementos"><i class="fa fa-plus"></i></span>
							<select name="productoUnico" id="productoUnico" class="form-control myFont select2" style="width: 100%;">
							
							</select>
							</div>
						</div>

					</div>

					<br>
					<div class="row">
						<div class="col-md-12" id="table-receta">
							<?=form_open('', '');?>
								<table class="table table-bordered table-striped" id="receta-item">
										<tr>
											<th width="30%">Grupo </th>
											<th width="30%">Nombre</th>
											<th width="10%">Opcional</th>
											<th width="10%">Precio</th>
											<th width="10%">Opcion visual</th>
											<th width="10%">Opciones</th>
											
										</tr>
										<tbody id="elementoReceta">

										</tbody>
								</table>

								<?=form_button('agregar', '<span style="font-size:1.5rem" class="las la-save la-2x"></span> Guardar Receta', ['class'=>'btn palette-Red-700 bg btn-xs float-right btn-hide', 'onclick'=>'guardarReceta()']);?>
							</form>
						</div>
					</div>

					</div>
				</form>
			</div>
        </div>
    </div>
</div>


<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nombre2">Agregar Grupo</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row" id="newGroup">
		<form method="POST"> 
        <div class="col-md-12">
            <div class="form-group">
                <?=form_label("Nombre de Grupo", 'grupo');?>
                <select name="cat1" id="cat1" class="form-control" style="width: 100%;">
					<option value="" selected="selected">Seleccione una Categoria</option>
					<?php	foreach ($cat1 as $c) : ?>
						<option value="<?=$c->ID_CATEGORIA?>"><?=$c->CATEGORIA?></option>;
					<?php endforeach; ?>
				</select>
            </div>

			<div class="form-group">
                <?=form_label("Cantidad", 'cantidad');?>
                <?=form_input(['class'=>'form-control', 'name'=>'cantidad']);?>
            </div>

			<div class="form-group">
                <?=form_label("Orden", 'orden');?>
				<select name="orden1" id="orden1" class="form-control" style="width: 100%;">
					<option value="" selected="selected">Seleccione un Orden Disponible</option>
					<?php	foreach ($orden as $o) : ?>
						<option value="<?=$o->value?>"><?=$o->value?></option>;
					<?php endforeach; ?>
				</select>
            </div>

			<div class="form-group">
                <?=form_label("Combo madre", 'madre');?>
				<select name="madre" id="madre" class="form-control" style="width: 100%;">
					<option value="" selected="selected">Seleccione una Opcion</option>
					<?php	foreach ($madre as $m) : ?>
						<option value="<?=$m->value?>"><?=$m->value?></option>;
					<?php endforeach; ?>
				</select>
            </div>

			<div class="form-group">
                <?=form_label("Agregar", 'agregarInput');?>
				<?=form_input(['id'=>'agregarInput', 'type'=>'checkbox', 'value'=>'1']);?>
            </div>
        </div>
		</form>
      </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn palette-Red-700 bg" onclick="agregarGrupo()">Registrar</button>
      </div>
    </div>
  </div>
</div>


<script>

	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
		$('#buscador').hide();
	});

	$('.select2').select2({
		theme: "classic"
	});

	
	function getCategoria2() {

		$('.loading').show(); var idc1 = $('#productoCategoria1').val();

		$.post("<?=site_url('receta-segunda-categoria')?>", {id:idc1})
		.done(function( data ) 
		{
        	$('.loading').hide();
            dato = JSON.parse(data); 
			$('#productoCategoria2').empty();
			$('#productoMadre').empty();
			$('#productoUnico').empty();


			$('#productoCategoria2').append(new Option('--- Seleccione una Opcion ---', ''));
            $('#productoCategoria2').append(new Option('Todos', '-1'));
			$.each(dato, function( index, value ) {
				$('#productoCategoria2').append(new Option(value.CATEGORIA_2, value.ID_CATEGORIA_2));
		 	});
    	});	
	}

	function getProductoMadre() {

		$('.loading').show(); var idc2 = $('#productoCategoria2').val();

		$.post("<?=site_url('receta-producto-madre')?>", {id:idc2})
		.done(function( data ) 
		{
			$('.loading').hide();
			dato = JSON.parse(data); $('#productoMadre').empty();
			
			
			$('#productoMadre').append(new Option('--- Seleccione una Opcion ---', ''));
			$.each(dato, function( index, value ) {
				$('#productoMadre').append(new Option(value.PRODUCTO, value.ID_PRODUCTO_MADRE));
			});
		});	
	}

	function getProductoUnico() {

		$('.loading').show(); var idpm = $('#productoMadre').val();

		$.post("<?=site_url('receta-producto-unico')?>", {id:idpm})
		.done(function( data ) 
		{
			$('.loading').hide();
			dato = JSON.parse(data); $('#productoUnico').empty();
			
			
			$('#productoUnico').append(new Option('--- Seleccione una Opcion ---', ''));
			$.each(dato, function( index, value ) {
				$('#productoUnico').append(new Option(value.TAMAÑO, value.ID_PRODUCTO_UNICO));
			});
		});	
	}

	function showButtons() {
		$('.gbutton').removeAttr('hidden');
	}


	function guardarReceta()
	{
		var collection = $('#serializeExample form').serialize();

		$.post("<?=site_url('guardar-receta-combo')?>", collection)
			.done(function( data ) {
				dato = JSON.parse(data);


				Swal.fire({
                        icon: dato.icon,
                        title: dato.message,
                        timer: 4500
                    });
			});
	}


	function verModal(){

			$('#agregar').modal('show');

	}

	function agregarGrupo(){
		var collection = $('#newGroup form').serialize();

		$.post("<?=site_url('agregar-grupo')?>", collection)
            .done(function( data ) {

				dato = JSON.parse(data);

				$('#agregar').modal('hide');

				$('#menuCombo').append(new Option(dato.nombre, dato.id));

				Swal.fire({
                        icon: dato.icon,
                        title: dato.message,
                        timer: 4500
                    });

			});
	}

	function borrar(id,menu)
	{
		$('#row_'+id+'_'+menu).remove();

		$.post('<?=site_url('delete-elemento-combo')?>', {id:id, menu:menu})
		.done(function( data ) {
			datos = JSON.parse(data);

			if(datos.status == true) {
				Swal.fire({
					icon: 'success',
					title: 'Se ha quitado el elemento del combo',
					timer: 4500
				});
			}
		});
	}

	function verMenuCombo() {

		alert('Hola');
	}

	function buscarElementos() {

		var id = $('#menuCombo option:selected').val();
		var nombre = $('#menuCombo option:selected').text();
		
		if(id > 0)
		{
			$('#buscador').show('slow');


			$.post('<?=site_url('get-elementos-combo')?>', {id:id, nombre:nombre})
			.done(function( data ) {

				var datos = JSON.parse(data);
				
				$.each(datos, function (index, value) { 


					var grupo = value.GRUPO;
					var idGrupo = value.ID_CATEGORIA_1;
				    var nombre = value.PRODUCTO_MADRE;
					var idUnico = value.ID_PRODUCTO_UNICO;
					var opcional = value.OPCIONAL;
					var precio = value.PRECIO;
					var menu = value.ID_VENTAS_MENU_COMBO;
					var presentacion = $('#productoUnico option:selected').text();

				    var row = '<tr class="palette-Green-100 bg" id="row_'+idUnico+'_'+menu+'">';

					row += '<td>'+grupo+'<input type="hidden" name="'+idUnico+'[idUnico]" value="'+idUnico+'"><input type="hidden" name="'+idUnico+'[idGrupo]" value="'+idGrupo+'"></td>';

					var tamanio = presentacion ? presentacion : 'Tamaño Unico'

					row += '<td>'+nombre+'('+tamanio+')</td>';
					row += '<td><input name="'+idUnico+'[opcional]" value="'+opcional+'" type="checkbox"></td>';
					row += '<td><input name="'+idUnico+'[precio]" value="'+precio+'" type="number" step="0.10" min="0.00"></td>';
					row += '<td><input name="'+idUnico+'[visual]" value="1" type="checkbox"></td>';
					
					row += '<td><span onclick="borrar('+idUnico+','+menu+')" class="btn btn-xs palette-Red-700 bg"><i class="las la-trash"></i></span></td>';

					row += '</tr>';

					$('#elementoReceta').append(row);
					 
				});
			});
		}
	}

	function rowsCat1() {

		var id = $('#productoCategoria1 option:selected').val();


		if(id) 
		{
			$.post("<?=site_url('set-categoria-1')?>", {id:id})
			.done(function( data ) {

				var datos = JSON.parse(data);
					
					$.each(datos, function (index, value) { 


						var grupo = $('#menuCombo option:selected').text();
						var idGrupo = $('#menuCombo option:selected').val();
						var nombre = value.NOMBRE;
						var idUnico = value.ID_PRODUCTO_UNICO;
						var presentacion = $('#productoUnico option:selected').text();

						var row = '<tr class="temporal" id="row_'+idUnico+'">';

						row += '<td>'+grupo+'<input type="hidden" name="'+idUnico+'[idUnico]" value="'+idUnico+'"><input type="hidden" name="'+idUnico+'[idGrupo]" value="'+idGrupo+'"></td>';

						row += '<td>'+nombre+'</td>';
						row += '<td><input name="'+idUnico+'[opcional]" value="1" type="checkbox"></td>';
						row += '<td><input name="'+idUnico+'[precio]" value="0" type="number" step="0.10" min="0.00"></td>';
						row += '<td><input name="'+idUnico+'[visual]" value="1" type="checkbox"></td>';
						
						row += '<td><span onclick="borrar('+idUnico+')" class="btn btn-xs palette-Red-700 bg"><i class="las la-trash"></i></span></td>';

						row += '</tr>';

						$('#elementoReceta').append(row);
						
					});
			});
		}

		else 
		{
			Swal.fire({
                        icon: 'info',
                        title: 'Debe elegir una categoria primero',
                        timer: 4500
                    });
		}

	}

	function rowsCat2() {

		var id1 = $('#productoCategoria1 option:selected').val();
		var id2 = $('#productoCategoria2 option:selected').val();

		if(id1 && id2) {

			$.post("<?=site_url('set-categoria-2')?>", {id1:id1, id2:id2})
			.done(function( data ) {

			var datos = JSON.parse(data);
		
			$.each(datos, function (index, value) { 

					var grupo = $('#menuCombo option:selected').text();
					var idGrupo = $('#menuCombo option:selected').val();
					var nombre = value.NOMBRE;
					var idUnico = value.ID_PRODUCTO_UNICO;
					var presentacion = $('#productoUnico option:selected').text();

					var row = '<tr class="temporal" id="row_'+idUnico+'">';

					row += '<td>'+grupo+'<input type="hidden" name="'+idUnico+'[idUnico]" value="'+idUnico+'"><input type="hidden" name="'+idUnico+'[idGrupo]" value="'+idGrupo+'"></td>';

					row += '<td>'+nombre+'</td>';
					row += '<td><input name="'+idUnico+'[opcional]" value="1" type="checkbox"></td>';
					row += '<td><input name="'+idUnico+'[precio]" value="0" type="number" step="0.10" min="0.00"></td>';
					row += '<td><input name="'+idUnico+'[visual]" value="1" type="checkbox"></td>';
					
					row += '<td><span onclick="borrar('+idUnico+')" class="btn btn-xs palette-Red-700 bg"><i class="las la-trash"></i></span></td>';

					row += '</tr>';

					$('#elementoReceta').append(row);
					
				});
			});
		}

		else 
		{
			Swal.fire({
				icon: 'info',
				title: 'Debe elegir una sub-categoria primero',
				timer: 4500
			});
		}	
	}

	function rowsCat3() {

		var id1 = $('#productoCategoria1 option:selected').val();
		var id2 = $('#productoCategoria2 option:selected').val();
		var id3 = $('#productoMadre option:selected').val();

		if(id1 && id2 && id3) {

		$.post("<?=site_url('set-categoria-3')?>", {id1:id1, id2:id2, id3:id3})
		.done(function( data ) {

		var datos = JSON.parse(data);

			$.each(datos, function (index, value) { 


				var grupo = $('#menuCombo option:selected').text();
				var idGrupo = $('#menuCombo option:selected').val();
				var nombre = value.NOMBRE;
				var idUnico = value.ID_PRODUCTO_UNICO;
				var presentacion = $('#productoUnico option:selected').text();

				var row = '<tr class="temporal" id="row_'+idUnico+'">';

				row += '<td>'+grupo+'<input type="hidden" name="'+idUnico+'[idUnico]" value="'+idUnico+'"><input type="hidden" name="'+idUnico+'[idGrupo]" value="'+idGrupo+'"></td>';

				row += '<td>'+nombre+'</td>';
				row += '<td><input name="'+idUnico+'[opcional]" value="1" type="checkbox"></td>';
				row += '<td><input name="'+idUnico+'[precio]" value="0" type="number" step="0.10" min="0.00"></td>';
				row += '<td><input name="'+idUnico+'[visual]" value="1" type="checkbox"></td>';
				
				row += '<td><span onclick="borrar('+idUnico+')" class="btn btn-xs palette-Red-700 bg"><i class="las la-trash"></i></span></td>';

				row += '</tr>';

				$('#elementoReceta').append(row);
				
			});
		});

	}

		else 
		{
			Swal.fire({
				icon: 'info',
				title: 'Debe elegir un producto primero',
				timer: 4500
			});
		}
	}

	function rowsCat4() {

		var id1 = $('#productoCategoria1 option:selected').val();
		var id2 = $('#productoCategoria2 option:selected').val();
		var id3 = $('#productoMadre option:selected').val();
		var id4 = $('#productoUnico option:selected').val();

		$.post("<?=site_url('set-categoria-4')?>", {id1:id1, id2:id2, id3:id3, id4:id4})
		.done(function( data ) {

		var datos = JSON.parse(data);

			$.each(datos, function (index, value) { 


				var grupo = $('#menuCombo option:selected').text();
				var idGrupo = $('#menuCombo option:selected').val();
				var nombre = value.NOMBRE;
				var idUnico = value.ID_PRODUCTO_UNICO;
				var presentacion = $('#productoUnico option:selected').text();

				var row = '<tr class="temporal" id="row_'+idUnico+'">';

				row += '<td>'+grupo+'<input type="hidden" name="'+idUnico+'[idUnico]" value="'+idUnico+'"><input type="hidden" name="'+idUnico+'[idGrupo]" value="'+idGrupo+'"></td>';

				row += '<td>'+nombre+'</td>';
				row += '<td><input name="'+idUnico+'[opcional]" value="1" type="checkbox"></td>';
				row += '<td><input name="'+idUnico+'[precio]" value="0" type="number" step="0.10" min="0.00"></td>';
				row += '<td><input name="'+idUnico+'[visual]" value="1" type="checkbox"></td>';
				
				row += '<td><span onclick="borrar('+idUnico+')" class="btn btn-xs palette-Red-700 bg"><i class="las la-trash"></i></span></td>';

				row += '</tr>';

				$('#elementoReceta').append(row);
				
			});
		});
	}


	function limpiarElementos() {
		$('.temporal').remove();
	}

</script>