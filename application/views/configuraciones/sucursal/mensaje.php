<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<?=form_label("Mensaje en la Factura", 'messageFact'.$codigo);?>
			<?=form_textarea('messageFact'.$codigo, $factura, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageFact'.$codigo, 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
			<div class="valid-feedback"></div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<?=form_label("Mensaje en el Recibo", 'messageRecibo'.$codigo);?>
			<?=form_textarea('messageRecibo'.$codigo, $recibo, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageRecibo'.$codigo, 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
			<div class="valid-feedback"></div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<?=form_label("Mensaje en la Comanda", 'messageComanda'.$codigo);?>
			<?=form_textarea('messageComanda'.$codigo, $comanda, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageComanda'.$codigo, 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
			<div class="valid-feedback"></div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-3">
		<?=form_button(['onclick'=>'message('.$id.',\''.$codigo.'\')', 'content'=>'<i class="las la-check la-1x palette-White text"></i>'.'<span class="palette-White text">Guardar</span>', 'class'=>'btn btn-md btn-danger']);?>
	</div>
</div>


<script>

function message(id, codigo) {

var factura = $('#messageFact'+codigo).val();
var recibo = $('#messageRecibo'+codigo).val();
var comanda = $('#messageComanda'+codigo).val();


  $.post("<?=site_url('set-message')?>", {id:id, factura:factura, recibo:recibo, comanda:comanda })
	.done(function( data ) {

		Swal.fire({
			icon: 'success',
			title: 'Se ha actualizado los mensajes correctamente',
			timer: 3500
		});
  });
}

</script>