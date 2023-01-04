
<?php foreach ($canales as $canal): ?>
    <div class="row palette-Red-200 bg">
      <div class="col-9"><p class="lead" style="font-weight: 500;"><?=$canal->NOMBRE_LISTA_PRECIOS?></p></div>
      <div class="col-3"> 

      <select class="form-control <?=($canal->FACTURADO == 1)?' palette-Green-A100 bg':''?>" id="nivel<?=$value->ID_NOMBRE_LISTA_PRECIOS?>" onchange="activar(<?=$value->ID_NOMBRE_LISTA_PRECIOS?>)" >
        <option <?=($canal->FACTURADO == 1) ? 'selected' : '' ?> value="1"> FACTURADO </option>
        <option <?=($canal->FACTURADO == 0) ? 'selected' : '' ?> value="0"> NO FACTURADO </option>
      </select>
      </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="row">
                <?php foreach ($formas as $forma): ?>
                        <div class="col-1"></div>
                        <div class="col-8"><p class="lead" style="font-weight: 500;"><?=$forma->DESCRIPCION?></p></div>
                        <div class="col-3"> 
                            <?php $estado = $this->main->getField('VENTAS_FORMA_PAGO_ESTADO', 'ID_ESTADO', ['ID_FORMA_PAGO'=>$forma->CODIGO, 'ID_UBICACION'=> $sucursal, 'ID_LISTA_VENTAS'=>$canal->ID_NOMBRE_LISTA_PRECIOS])?>
                            <select onchange="cambiarEstado(<?=$forma->CODIGO?>, <?=$sucursal?>, <?= $canal->ID_NOMBRE_LISTA_PRECIOS?>)" id="forma_<?=$forma->CODIGO.'-'.$sucursal.'-'.$canal->ID_NOMBRE_LISTA_PRECIOS?>"    class="form-control <?=($estado == 1)?' palette-Green-A100 bg':''?>">  
                                <option <?=($estado == 1) ? 'selected' : '' ?> value="1"> ACTIVO </option>
                                <option <?=($estado == 0) ? 'selected' : '' ?> value="0"> INACTIVO </option>
                            </select>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endforeach;?>


<script>

    function cambiarEstado(cod, sucursal, canal) {

        var value = $('#forma_'+cod+'-'+sucursal+'-'+canal).val();

        $.post("<?=site_url('update-forma')?>", {forma:cod, sucursal:sucursal, canal:canal, value:value})
        
        .done(function( data ) {

            Swal.fire({
                icon: 'success',
                title: 'Se ha guardado el cambio solicitado',
                timer: 2500
            });

        });

    }

</script>