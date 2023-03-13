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
			
			<div class="card-body">
				<form action="<?=current_url()?>" method="GET" id="form_fecha">
					<div class="row">

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
								<span hidden class="gbutton palette-Grey-700 bg btn btn-padding" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editReceta()"><i class="las la-pen-square la-2x"></i></span>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-md-12" id="table-receta">

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


	function setReceta() {
		$.ajax({
			type: "POST", url: "<?=site_url('get-table-receta')?>", dataType: "html",
			success: function (response) {
				$('#table-receta').empty();
				$('#table-receta').append(response);
			}
		});
	}

	function showButtons() {

		$('.gbutton').removeAttr('hidden');

	}


	function editReceta() {

		var id = $('#productoUnico').val(); 

		$.ajax({
			type: "POST", url: "<?=site_url('edit-table-receta')?>", data:{id:id}, dataType: "html",
			success: function (response) {
				$('#table-receta').empty();
				$('#table-receta').append(response);
			}
		});
	}
</script>