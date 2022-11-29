<div class="row">
   <div class="col-md-4">
      <div class="form-group">
         <?=form_label("Mensaje en la Factura", 'messageFactSJ');?>
         <?=form_textarea('messageFactSS', $factura, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageFactSJ', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
         <div class="valid-feedback"></div>
      </div>
   </div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en el Recibo", 'messageReciboSJ');?>
							<?=form_textarea('messageReciboSJ', $recibo, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageReciboSJ', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en la Comanda", 'messageComanda');?>
							<?=form_textarea('messageComandaSJ', $comanda, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageComandaSJ', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-3">
						<?=form_button(['onclick'=>'message_hupermall('.$id.')', 'content'=>'<i class="las la-check la-1x palette-White text"></i>'.'<span class="palette-White text">Guardar</span>', 'class'=>'btn btn-md btn-danger']);?>
					</div>
				</div>
   <script>


   function message_hupermall(id) {

      var factura = $('#messageFactSJ').val();
      var recibo = $('#messageReciboSJ').val();
      var comanda = $('#messageComandaSJ').val();


      $.post("<?=site_url('set-message-jordan')?>", {id:id, factura:factura, recibo:recibo, comanda:comanda })
         .done(function( data ) {

         Swal.fire({
            icon: 'success',
            title: 'Se ha actualizado los mensajes correctamente',
            timer: 3500
         });
      
      });

   }


   </script>