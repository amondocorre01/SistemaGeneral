
<div class="row">
	<div class="col-2">
		<span onclick="agregarElementos()" class="btn btn-xs palette-Red-700 bg" data-toggle="modal" data-target="#nuevo">
			<i class="las la-plus la-1x"></i> Agregar
		</span>
	</div>
</div>

<div class="card" id="serializeExample">

<?=form_open('', '');?>

	<table class="table table-bordered table-striped" id="receta-item">
		
			<tr>
				<th width="30%">Nombre</th>
				<th width="10%">Es fruta</th>
				<th width="10%">Para mesa</th>
				<th width="10%">Para llevar</th>
				<th width="10%">Mandatorio</th>
				<th width="10%">Perecedero</th>
				<th width="10%">Medida</th>
				<th width="10%">Eliminar</th>
			</tr>
			<tbody id="elementoReceta">

			</tbody>
		
	</table>
</form>
</div>

<div class="row">
	<div class="col-md-3">

		<?=form_button('agregar', '<span style="font-size:1.5rem" class="las la-save la-2x"></span>', ['class'=>'btn btn-danger btn-xs float-right btn-hide', 'onclick'=>'guardarReceta()']);?>

	</div>
</div>


<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="nombre2" aria-hidden="true">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nombre2">Nuevo Elemento de Receta</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?=form_label("Elemento", 'elementos');?>
				<select name="elementos" id="elementos" class="form-control select2">
					<?php foreach ($elementos as $e) : ?>
						<option value="<?=$e->ID?>"><?=$e->SUB_CATEGORIA_2?></option>
					<?php endforeach;?>
				</select>
            </div>
        </div>
      </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" onclick="addElement()" class="btn btn-danger" data-dismiss="modal">Agregar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script src="<?=base_url('assets/plugins/select2/js/select2.js')?>" ></script>

<script>

	$('#elementos').select2({dropdownParent: $('#nuevo')});

	function agregarElementos() 
	{
		$('#nuevo').modal('show');
	}

	function addElement()
	{
		var nombre = $('#elementos option:selected').text();
		var idAll = $('#elementos option:selected').val();

		var separado = idAll.split('-');
		var id = separado[0];
		var adecuacion = separado[1];

		var unico = $('#productoUnico option:selected').val();

		var row = '<tr id="row_'+id+'">';

		row += '<td>'+nombre+'<input type="hidden" name="'+id+'[idUnico]" value="'+unico+'"><input type="hidden" name="'+id+'[id]" value="'+id+'"><input type="hidden" name="'+id+'[id]" value="'+id+'"></td>';

		row += '<td><input name="'+id+'[fruta]" value="1" type="checkbox"></td>';
		row += '<td><input name="'+id+'[mesa]" value="1" type="checkbox"></td>';
		row += '<td><input name="'+id+'[llevar]" value="1" type="checkbox"></td>';
		row += '<td><input name="'+id+'[manda]" value="1" type="checkbox"></td>';
		row += '<td><input name="'+id+'[perece]" value="1" type="checkbox"></td>';
		row += '<td><input name="'+id+'[adecuacion]" class="form-control" value="'+adecuacion+'" type="text"></td>';
		row += '<td><span onclick="borrar('+id+')" class="btn btn-xs palette-Red-700 bg"><i class="las la-trash"></i></span></td>';

		row += '</tr>';

		$('#elementoReceta').append(row);

	}

	function borrar(id)
	{
		$('#row_'+id).remove();
	}

	function guardarReceta()
	{
		var collection = $('#serializeExample form').serialize();

		$.post("<?=site_url('guardar-receta')?>", collection)
			.done(function( data ) {
				dato = JSON.parse(data);
			});
	}

</script>