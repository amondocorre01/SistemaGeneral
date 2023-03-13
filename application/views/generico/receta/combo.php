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
									<option value="<?=$value->ID_CATEGORIA_1?>"><?=$value->NOMBRE_MENU?></option>;
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-md-1">
							<div>
								<button onchange="habilitarCombo()" class="btn btn-danger btn-lg" type="button">Agregar</button>
							</div>
						</div>
					</div>

					<br>

					<div class="row" id="elemento_combo">
						<div class="col-md-3">
							
							<div class="form-group">
							<label>Categoria</label>
							<select name="productoCategoria1" id="productoCategoria1" class="form-control myFont" style="width: 100%;" onchange="getCategoria2()">
								<option value="" selected="selected">Seleccione la primera categoria</option>
								<?php
									foreach ($primeraCategoria as $key => $value) {
										echo '<option '.$sel.' value="'.$value->ID_CATEGORIA.'">'.$value->CATEGORIA.'</option>';
									}
								?>
							</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							<label>Subcategoria</label>
							<select name="productoCategoria2" id="productoCategoria2" class="form-control myFont" style="width: 100%;" onchange="getProductoMadre()" >
								<option value="" selected="selected">Seleccione la segunda categoria</option>
							</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							<label>Seleccione el producto</label>
							<select name="productoMadre" id="productoMadre" class="form-control myFont" style="width: 100%;" onchange="getProductoUnico()">
								
							</select>
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
							<label>Seleccione la Presentacion</label>
							<select name="productoUnico" id="productoUnico" class="form-control myFont" style="width: 100%;" onchange="showButtons()">
							
							</select>
							</div>
						</div>

						<div class="col-md-1">
							<div class="btn-group" role="group" aria-label="Basic example">
								<span hidden class="gbutton palette-Red-700 bg btn btn-padding" data-toggle="tooltip" data-placement="top" title="Agregar" onclick="setReceta()"><i class="las la-plus-square la-2x"></i></span>
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
				</form>
			</div>
        </div>
    </div>
</div>


<script>

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});

	
	function getCategoria2() {

		$('.loading').show(); var idc1 = $('#productoCategoria1').val();

		$.post("<?=site_url('receta-segunda-categoria')?>", {id:idc1})
		.done(function( data ) 
		{
        	$('.loading').hide();
            dato = JSON.parse(data); $('#productoCategoria2').empty();


			$('#productoCategoria2').append(new Option('--- Seleccione una Opcion ---', ''));
            
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
				$('#productoMadre').append(new Option(value.PRODUCTO_MADRE, value.ID_PRODUCTO_MADRE));
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

	function setReceta() {

		var grupo = $('#menuCombo option:selected').text();
		var idGrupo = $('#menuCombo option:selected').val();
		var nombre = $('#productoMadre option:selected').text();
		var idUnico = $('#productoUnico option:selected').val();
		var presentacion = $('#productoUnico option:selected').text();



		var row = '<tr id="row_'+idUnico+'">';

		row += '<td>'+grupo+'<input type="hidden" name="'+idUnico+'[idUnico]" value="'+idUnico+'"><input type="hidden" name="'+idUnico+'[idGrupo]" value="'+idGrupo+'"></td>';

		var tamanio = presentacion ? presentacion : 'Tamaño Unico'

		row += '<td>'+nombre+'('+tamanio+')</td>';
		row += '<td><input name="'+idUnico+'[opcional]" value="1" type="checkbox"></td>';
		row += '<td><input name="'+idUnico+'[precio]" value="0" type="number" step="0.10" min="0.00"></td>';
		row += '<td><input name="'+idUnico+'[visual]" value="1" type="checkbox"></td>';
		
		row += '<td><span onclick="borrar('+idUnico+')" class="btn btn-xs palette-Red-700 bg"><i class="las la-trash"></i></span></td>';

		row += '</tr>';

		$('#elementoReceta').append(row);

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

</script>