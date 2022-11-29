<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en la Factura", 'messageFact');?>
							<?=form_textarea('messageFact', $factura, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageFact', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en el Recibo", 'messageRecibo');?>
							<?=form_textarea('messageRecibo', $recibo, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageRecibo', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<?=form_label("Mensaje en la Comanda", 'messageComanda');?>
							<?=form_textarea('messageComanda', $comanda, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'messageComanda', 'required'=>'required', 'rows'=>'3', 'style'=>'resize:none']);?>
							<div class="valid-feedback"></div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-3">
						<?=form_button(['onclick'=>'message_pando('.$id.')', 'content'=>'<i class="las la-check la-1x palette-White text"></i>'.'<span class="palette-White text">Guardar</span>', 'class'=>'btn btn-md btn-danger']);?>
					</div>
				</div>