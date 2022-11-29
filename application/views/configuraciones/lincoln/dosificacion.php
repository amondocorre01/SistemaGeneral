<div id="tab-<?=$id?>"> 

        <h2><?=$nombre_sucursal?></h2>

      <div id="opciones-lincoln">

          <ul>
              <li><a href="#opcion-2-lincoln<?=$id?>"> Impresion </a></li>
              <li><a href="#opcion-4-lincoln<?=$id?>"> Mensajes </a></li>
          </ul>
    
         
          <div id="opcion-2-lincoln<?=$id?>">
             <?php echo $this->load->view('configuraciones/lincoln/impresion', null, TRUE);?> 
          </div>
         

			 <div id="opcion-4-lincoln<?=$id?>"> 

				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en la Factura", 'messageFactSL');?>
							<?=form_textarea('messageFactSL', $factura, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageFactSL', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en el Recibo", 'messageReciboSL');?>
							<?=form_textarea('messageRecibo', $recibo, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageReciboSL', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en la Comanda", 'messageComandaSL');?>
							<?=form_textarea('messageComandaSL', $comanda, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageComandaSL', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-3">
						<?=form_button(['onclick'=>'message_lincoln('.$id.')', 'content'=>'<i class="las la-check la-1x palette-White text"></i>'.'<span class="palette-White text">Guardar</span>', 'class'=>'btn btn-md btn-danger']);?>
					</div>
				</div>
          </div>
      </div>
</div>

      <script>

        $('#opciones-lincoln').responsiveTabs({
            startCollapsed: 'accordion'
        });

        var show_update = 0;

	 function message_lincoln(id) {

		var factura = $('#messageFactSL').val();
		var recibo = $('#messageReciboSL').val();
		var comanda = $('#messageComandaSL').val();

    
		$.post("<?=site_url('set-message-lincoln')?>", {id:id, factura:factura, recibo:recibo, comanda:comanda })
			.done(function( data ) {

        Swal.fire({
            icon: 'success',
            title: 'Se ha actualizado los mensajes correctamente',
            timer: 3500
        });
		
		});

	 }
      </script>
