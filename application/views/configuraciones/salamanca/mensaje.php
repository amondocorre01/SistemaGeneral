<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<?=form_label("Mensaje en la Factura", 'messageFactSS');?>
			<?=form_textarea('messageFactSS', $factura, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageFactSS', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
			<div class="valid-feedback"></div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<?=form_label("Mensaje en el Recibo", 'messageReciboSS');?>
			<?=form_textarea('messageReciboSS', $recibo, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageReciboSS', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
			<div class="valid-feedback"></div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<?=form_label("Mensaje en la Comanda", 'messageComandaSS');?>
			<?=form_textarea('messageComandaSS', $comanda, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageComandaSS', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
			<div class="valid-feedback"></div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-3">
		<?=form_button(['onclick'=>'message_salamanca('.$id.')', 'content'=>'<i class="las la-check la-1x palette-White text"></i>'.'<span class="palette-White text">Guardar</span>', 'class'=>'btn btn-md btn-danger']);?>
	</div>
</div>

<script>

   function message_salamanca(id) {

      var factura = $('#messageFactSS').val();
      var recibo = $('#messageReciboSS').val();
      var comanda = $('#messageComandaSS').val();

      $.post("<?=site_url('set-message-salamanca')?>", {id:id, factura:factura, recibo:recibo, comanda:comanda })
         .done(function( data ) {

         Swal.fire({
            icon: 'success',
            title: 'Se ha actualizado los mensajes correctamente',
            timer: 3500
         });
      });
   }

</script>