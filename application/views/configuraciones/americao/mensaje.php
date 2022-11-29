<div class="row">
   <div class="col-md-4">
      <div class="form-group">
         <?=form_label("Mensaje en la Factura", 'messageFactSAO');?>
         <?=form_textarea('messageFactSS', $factura, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageFactSAO', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
         <div class="valid-feedback"></div>
      </div>
   </div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en el Recibo", 'messageReciboSAO');?>
							<?=form_textarea('messageReciboSAO', $recibo, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageReciboSAO', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en la Comanda", 'messageComanda');?>
							<?=form_textarea('messageComandaSAO', $comanda, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageComandaSAO', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-3">
						<?=form_button(['onclick'=>'message_americao('.$id.')', 'content'=>'<i class="las la-check la-1x palette-White text"></i>'.'<span class="palette-White text">Guardar</span>', 'class'=>'btn btn-md btn-danger']);?>
					</div>
				</div>

   <script>


   function message_salamanca(id) {

      var factura = $('#messageFactSAO').val();
      var recibo = $('#messageReciboSAO').val();
      var comanda = $('#messageComandaSAO').val();


      $.post("<?=site_url('set-message-americao')?>", {id:id, factura:factura, recibo:recibo, comanda:comanda })
         .done(function( data ) {

         Swal.fire({
            icon: 'success',
            title: 'Se ha actualizado los mensajes correctamente',
            timer: 3500
         });
      
      });

   }


   </script>