<div id="tab-<?=$id?>"> 

        <h2><?=$nombre_sucursal?></h2>

      <div id="opciones-jordan">

          <ul>
              <li><a href="#opcion-2-jordan<?=$id?>"> Impresion </a></li>
              <li><a href="#opcion-4-jordan<?=$id?>"> Mensajes </a></li>
          </ul>
    
         
          <div id="opcion-2-jordan<?=$id?>">
             <?php echo $this->load->view('configuraciones/jordan/impresion', null, TRUE);?> 
          </div>
         

			 <div id="opcion-4-jordan<?=$id?>"> 

				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en la Factura", 'messageFactSJ');?>
							<?=form_textarea('messageFactSJ', $factura, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageFactSJ', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en el Recibo", 'messageReciboSJ');?>
							<?=form_textarea('messageRecibo', $recibo, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageReciboSJ', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en la Comanda", 'messageComandaSJ');?>
							<?=form_textarea('messageComandaSJ', $comanda, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageComandaSJ', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-3">
						<?=form_button(['onclick'=>'message_jordan('.$id.')', 'content'=>'<i class="las la-check la-1x palette-White text"></i>'.'<span class="palette-White text">Guardar</span>', 'class'=>'btn btn-md btn-danger']);?>
					</div>
				</div>
          </div>
      </div>
</div>

      <script>

        $('#opciones-jordan').responsiveTabs({
            startCollapsed: 'accordion'
        });

        var show_update = 0;

	 function message_jordan(id) {

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
