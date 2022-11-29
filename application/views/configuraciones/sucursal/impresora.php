<div class="row">
      <div class="col-md-6">
         <div class="form-group">
            <?=form_label("Impresora", 'impresora'.$codigo);?>
            <?=form_input('impresora'.$codigo, $impresora, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'impresora'.$codigo]);?>
            <div class="valid-feedback"></div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-3">
         <?=form_button(['onclick'=>'impresora('.$id.')', 'content'=>'<i class="las la-check la-1x palette-White text"></i>'.'<span class="palette-White text">Guardar</span>', 'class'=>'btn btn-md btn-danger']);?>
      </div>
   </div>

   <script>
      function impresora(id) {

         impresora = $('#impresora<?=$codigo?>').val();

         $.post("<?=site_url('set-impresora')?>", {id:id, impresora:impresora})
         .done(function( data ) {

            Swal.fire({
               icon: 'success',
               title: 'Se ha actualizado el nombre de la impresora correctamente',
               timer: 3500
            });

         });

      }
   </script>