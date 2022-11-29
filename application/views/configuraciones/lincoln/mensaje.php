<div class="row">
   <div class="col-md-4">
      <div class="form-group">
         <?=form_label("Mensaje en la Factura", 'messageFactSL');?>
         <?=form_textarea('messageFactSS', $factura, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageFactSL', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
         <div class="valid-feedback"></div>
      </div>
   </div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en el Recibo", 'messageReciboSL');?>
							<?=form_textarea('messageReciboSL', $recibo, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageReciboSL', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en la Comanda", 'messageComanda');?>
							<?=form_textarea('messageComandaSL', $comanda, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageComandaSL', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
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


   function message_lincoln(id) {

      var factura = $('#messageFactSL').val();
      var recibo = $('#messageReciboSL').val();
      var comanda = $('#messageComandaSL').val();


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