<div id="tab-<?=$id?>"> 

        <h2><?=$nombre_sucursal?></h2>

      <div id="opciones-americae">

          <ul>
              <li><a href="#opcion-2-americae<?=$id?>"> Impresion </a></li>
              <li><a href="#opcion-4-americae<?=$id?>"> Mensajes </a></li>
          </ul>
    
         
          <div id="opcion-2-americae<?=$id?>">
             <?php echo $this->load->view('configuraciones/americae/impresion', null, TRUE);?> 
          </div>
         

			 <div id="opcion-4-americae<?=$id?>"> 

				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en la Factura", 'messageFactSAO');?>
							<?=form_textarea('messageFactSAO', $factura, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageFactSAO', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en el Recibo", 'messageReciboSAO');?>
							<?=form_textarea('messageRecibo', $recibo, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageReciboSAO', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en la Comanda", 'messageComandaSAO');?>
							<?=form_textarea('messageComandaSAO', $comanda, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageComandaSAO', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-3">
						<?=form_button(['onclick'=>'message_americae('.$id.')', 'content'=>'<i class="las la-check la-1x palette-White text"></i>'.'<span class="palette-White text">Guardar</span>', 'class'=>'btn btn-md btn-danger']);?>
					</div>
				</div>
          </div>
      </div>
</div>

      <script>

        $('#opciones-americae').responsiveTabs({
            startCollapsed: 'accordion'
        });

        var show_update = 0;

	 function message_americae(id) {

		var factura = $('#messageFactSAO').val();
		var recibo = $('#messageReciboSAO').val();
		var comanda = $('#messageComandaSAO').val();

    
		$.post("<?=site_url('set-message-americae')?>", {id:id, factura:factura, recibo:recibo, comanda:comanda })
			.done(function( data ) {

        Swal.fire({
            icon: 'success',
            title: 'Se ha actualizado los mensajes correctamente',
            timer: 3500
        });
		
		});

	 }
      </script>
