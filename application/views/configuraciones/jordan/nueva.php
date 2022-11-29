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
         <div class="col-md-6">
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

