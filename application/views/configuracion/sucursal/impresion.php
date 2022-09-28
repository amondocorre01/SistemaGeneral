<div class="row">
   <?php foreach ($columns as $column) : ?>

      <?php switch ($column->COLUMN_NAME) {
         case 'CORREO_SUCURSAL':
             $type = 'email';
            break;
            
            case 'FECHA_LIMITE':
               $type = 'date';
            break;

            case 'ESTADO':
               $estados = ['0'=>'Deshabilitado', '1'=>'Habilitado'];
            break;
         
            default:
             $type = 'text';
            break;
      }?>


      <?php if($column->COLUMN_NAME !== 'ID_DOSIFICACION'): ?>
         <div class="col-md-3">
            <div class="form-group">
            <?php if($column->COLUMN_NAME === 'ESTADO'): ?>
               <?=form_label($column->COLUMN_NAME, $column->COLUMN_NAME.$id);?>
               <?=form_dropdown($column->COLUMN_NAME.$id, $estados, null ,['id'=>$column->COLUMN_NAME.$id, 'class'=>'form-control']);?>
            <?php else: ?>
               <?=form_label($column->COLUMN_NAME, $column->COLUMN_NAME.$id);?>
               <?=form_input(['name'=>$column->COLUMN_NAME.$id, 'type'=>$type,'class'=>'form-control', 'id'=>$column->COLUMN_NAME.$id, 'required'=>'required']);?>
            <?php endif; ?>
            </div>
         </div>
      <?php endif; ?>
   <?php endforeach; ?>
</div>

<div class="row">
   <div class="col-4">
      <?=form_button(['onclick'=>'register('.$id.')', 'content'=>'<i class="las la-save la-2x palette-White text"></i>'.'<span class="palette-White text">Registrar</span>', 'class'=>'btn btn-md btn-danger']);?>
   </div>
</div>

<script>
      function register(id) {
        var correo         =   $('#CORREO_SUCURSAL'+id).val();
        var nit            =   $('#NIT'+id).val();
        var razon          =   $('#RAZON_SOCIAL'+id).val();
        var autorizacion   =   $('#N_AUTORIZACION'+id).val();
        var actividad      =   $('#ACTIVIDAD_ECONOMICA'+id).val();
        var sistema        =   $('#SISTEMA_FACTURACION'+id).val();
        var dias           =   $('#DIAS'+id).val();
        var fecha          =   $('#FECHA_LIMITE'+id).val();
        var leyenda        =   $('#LEYENDA'+id).val();
        var llave          =   $('#LLAVE_DOSIFICACION'+id).val();
        var estado         =   $('#ESTADO'+id).val();
        var matriz         =   $('#CASA_MATRIZ'+id).val();
        var sucursal       =   $('#N_SUCURSAL'+id).val();
        var direccion      =   $('#DIRECCION_SUCURSAL'+id).val();
        var telefono       =   $('#TELEFONO'+id).val();
        var departamento   =   $('#DEPARTAMENTO_Y_PAIS'+id).val();


        datos = {correo:correo, nit:nit, razon:razon, autorizacion:autorizacion, actividad:actividad, sistema:sistema, dias:dias, fecha:fecha, leyenda:leyenda, llave:llave, estado:estado, matriz:matriz, sucursal:sucursal, direccion:direccion, telefono:telefono, departamento:departamento};

        url = '<?=site_url('save-impresion')?>'

        $.post(url, datos)
        .done(function(data) {
            table.ajax.reload();
        });
   }
</script>