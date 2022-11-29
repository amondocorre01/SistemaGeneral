<div class="row">
   <div class="col-md-4">
      <div class="form-group">
         <?=form_label("Mensaje en la Factura", 'messageFactSH');?>
         <?=form_textarea('messageFactSS', $factura, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageFactSH', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
         <div class="valid-feedback"></div>
      </div>
   </div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en el Recibo", 'messageReciboSH');?>
							<?=form_textarea('messageReciboSH', $recibo, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageReciboSH', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en la Comanda", 'messageComanda');?>
							<?=form_textarea('messageComandaSH', $comanda, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageComandaSH', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
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

      var factura = $('#messageFactSH').val();
      var recibo = $('#messageReciboSH').val();
      var comanda = $('#messageComandaSH').val();


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