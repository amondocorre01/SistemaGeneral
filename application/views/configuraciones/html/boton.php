<?php if($configuraciones):?>

   <?php foreach($configuraciones AS $configuracion): ?>

   <div class="row">

      <div class="col-2">
         <div class="p-3 mb-2 bg-secondary text-white lead cajaLineaVenta">
            <div class="form-group">
               <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                  <?php
                     $estado = $configuracion->ESTADO;
                     $checked = '';
                     if($estado == '1'){
                        $checked = 'checked';
                     }
                  ?>
                  <input type="checkbox" class="custom-control-input" id="lineacheckbox-<?=$configuracion->ID?>" iden="<?=$configuracion->ID?>" onchange="checkLineaVenta(this);" <?=$checked?> >
                  <label class="custom-control-label" for="lineacheckbox-<?=$configuracion->ID?>"></label>
               </div>
            </div>
            <?=$configuracion->CANAL?>
         </div>
      </div>

      <div class="col-2">
         <label>Envios con Transporte</label>
         <?=form_dropdown('transporte', ['1'=>'ACTIVO', '0'=>'INACTIVO'], $configuracion->TRANSPORTE, ['class'=>'form-control', 'id'=>'TRANSPORTE'.$configuracion->ID, 'onchange'=>'saveConfiguracion('.$configuracion->ID.',\'TRANSPORTE\')']);?>
      </div>

      <div class="col-2">
         <label>Venta Programada</label>
         <?=form_dropdown('programada', ['1'=>'ACTIVO', '0'=>'INACTIVO'], $configuracion->ENVIO_PROGRAMADO, ['class'=>'form-control', 'id'=>'ENVIO_PROGRAMADO'.$configuracion->ID, 'onchange'=>'saveConfiguracion('.$configuracion->ID.',\'ENVIO_PROGRAMADO\')']);?>
      </div>

      <div class="col-2">
         <label>Descuento Facturado</label>
         <?=form_dropdown('facturado', ['1'=>'ACTIVO', '0'=>'INACTIVO'], $configuracion->DESCUENTO_FACTURADO, ['class'=>'form-control', 'id'=>'DESCUENTO_FACTURADO'.$configuracion->ID, 'onchange'=>'saveConfiguracion('.$configuracion->ID.',\'DESCUENTO_FACTURADO\')']);?>
      </div>

      <div class="col-2">
         <label>Descuento Tradicional</label>
         <?=form_dropdown('tradicional', ['1'=>'ACTIVO', '0'=>'INACTIVO'], $configuracion->DESCUENTO_TRADICIONAL, ['class'=>'form-control', 'id'=>'DESCUENTO_TRADICIONAL'.$configuracion->ID, 'onchange'=>'saveConfiguracion('.$configuracion->ID.',\'DESCUENTO_TRADICIONAL\')']);?>
      </div>

      <div class="col-1"></div>
   </div>
<?php endforeach; ?>
<?php else:?>
   <script>
        Swal.fire({
            icon: 'error',
            title: 'La sucursal no tiene registro para el canal de venta solicitado',
            timer: 4500
         });
   </script>
<?php endif; ?>


<script>

function checkLineaVenta(element) {
   var valor = '0'; 
   if (element.checked){
      valor = '1';
      $(element).prop("checked", false);
   }else{
      valor = '0';
      $(element).prop("checked", true);
   }
      
         
   swal.fire({
        title: "¿Estás seguro?",
        text: "El estado cambiara.",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Continuar"
    }).then((result) => {
        if (result.isConfirmed) {
         var iden = $(element).attr('iden');
         var sc = updateEstado(iden,'ESTADO',valor,element);
        }
      });
}

function updateEstado(id, columna ,valor,element){
   $.post("<?=site_url('set-configuracion-boton')?>", {id:id, boton:columna, valor:valor })
      .done(function( data ) {
         if (element.checked){
            $(element).prop("checked", false);
         }else{
            $(element).prop("checked", true);
         }
         Swal.fire({
            icon: 'success',
            title: 'Se ha guardado la configuracion solicitada',
            timer: 4500
         });
      });
}

   function saveConfiguracion(id, boton) {

    var valor = $('#'+boton+id).val(); 

    console.log(valor);

   

      $.post("<?=site_url('set-configuracion-boton')?>", {id:id, boton:boton, valor:valor })
      .done(function( data ) {
         Swal.fire({
            icon: 'success',
            title: 'Se ha guardado la configuracion solicitada',
            timer: 4500
         });
      });
   }
</script>