<?=link_tag('node_modules/bootstrap4-toggle/css/bootstrap4-toggle.min.css')?>
  <script src="<?=base_url('node_modules/bootstrap4-toggle/js/bootstrap4-toggle.min.js')?>"></script>

<?php foreach ($menu as $value): ?>
    <div class="row palette-Red-200 bg">
      <div class="col-9"><p class="lead" style="font-weight: 500;"><?=$value->NOMBRE?></p></div>
      <div class="col-3"> 

      <select class="form-control level1 <?=($value->ACCEDE == 1)?' palette-Green-A100 bg':''?>" id="nivel<?=$value->ID_VENTAS_ACCESO?>" onchange="activar(<?=$value->ID_VENTAS_ACCESO?>)" >
        <option <?=($value->ACCEDE) ? 'selected' : '' ?> value="1"> ACTIVO </option>
        <option <?=($value->ACCEDE == NULL) ? 'selected' : '' ?> value="0"> INACTIVO </option>
      </select>
      </div>
    </div>
     <?php  
            $this->db->where($sistema, 1);
            $this->db->order_by('NUMERO_ORDEN', 'ASC');
            $this->db->where('NIVEL_SUPERIOR', $value->ID_VENTAS_ACCESO);
            $hijos = $this->main->getListSelect('VENTAS_ACCESO va', 'ID_VENTAS_ACCESO, NOMBRE, NIVEL_SUPERIOR,NUMERO_ORDEN, ( 
              SELECT ESTADO FROM VENTAS_USUARIOS_ACCESO vua 
              WHERE vua.ID_USUARIO = '.$id.' AND 
              vua.ID_VENTAS_ACCESO = va.ID_VENTAS_ACCESO
          ) AS ACCEDE');
    ?>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <?php foreach ($hijos as $hijo): ?>
                        <div class="col-1"></div>
                        <div class="col-8"><p class="lead" style="font-weight: 500;"><?=$hijo->NOMBRE?></p></div>
                        <div class="col-3"> 
                            <select class="form-control level1 <?=($hijo->ACCEDE == 1)?' palette-Green-A100 bg':''?>"" id="nivel<?=$hijo->ID_VENTAS_ACCESO?>" onchange="activar(<?=$hijo->ID_VENTAS_ACCESO?>)" >
                                <option <?=($hijo->ACCEDE) ? 'selected' : '' ?> value="1"> ACTIVO </option>
                                <option <?=($hijo->ACCEDE == NULL) ? 'selected' : '' ?> value="0"> INACTIVO </option>
                            </select>
                        </div>

                        <?php  
                                $this->db->where($sistema, 1);
                                $this->db->order_by('NUMERO_ORDEN', 'ASC');
                                $this->db->where('NIVEL_SUPERIOR', $hijo->ID_VENTAS_ACCESO);
                                $nietos = $this->main->getListSelect('VENTAS_ACCESO va', 'ID_VENTAS_ACCESO, NOMBRE, NIVEL_SUPERIOR,NUMERO_ORDEN, ( 
                                  SELECT ESTADO 
                                  FROM VENTAS_USUARIOS_ACCESO vua 
                                  WHERE vua.ID_USUARIO = '.$id.' AND 
                                  vua.ID_VENTAS_ACCESO = va.ID_VENTAS_ACCESO
                              ) AS ACCEDE');
                        ?>
                        <?php if($nietos): ?>
                        <div class="row">
                            <?php foreach ($nietos as $nieto): ?>
                                <div class="col-3">

                                </div>
                                <div class="col-6"><p class="lead" style="font-weight: 500;"><?=$nieto->NOMBRE?></p></div>
                                <div class="col-3"> 
                                <select class="form-control <?=($nieto->ACCEDE == 1)?' palette-Green-A100 bg':''?>"" id="nivel<?=$nieto->ID_VENTAS_ACCESO?>" onchange="activar(<?=$nieto->ID_VENTAS_ACCESO?>)" >
                                    <option <?=($nieto->ACCEDE) ? 'selected' : '' ?> value="1"> ACTIVO </option>
                                    <option <?=($nieto->ACCEDE == NULL) ? 'selected' : '' ?> value="0"> INACTIVO </option>
                                </select>
                                </div>
                                <?php  
                                    $this->db->where($sistema, 1);
                                    $this->db->order_by('NUMERO_ORDEN', 'ASC');
                                    $this->db->where('NIVEL_SUPERIOR', $nieto->ID_VENTAS_ACCESO);
                                        $bisnietos = $this->main->getListSelect('VENTAS_ACCESO va', 'ID_VENTAS_ACCESO, NOMBRE, NIVEL_SUPERIOR,NUMERO_ORDEN, ( 
                                          SELECT ESTADO 
                                          FROM VENTAS_USUARIOS_ACCESO vua 
                                          WHERE vua.ID_USUARIO = '.$id.' AND 
                                          vua.ID_VENTAS_ACCESO = va.ID_VENTAS_ACCESO
                                      ) AS ACCEDE');
                                ?>
                                

                                <div class="col-12">

                                <?php foreach ($bisnietos as $bisnieto): ?>
                                    <div class="row">

                                        <div class="col-4">
                                        </div>

                                        <div class="col-5"><p class="lead" style="font-weight: 500;"><?=$bisnieto->NOMBRE?></p></div>
                                        <div class="col-3"> 
                                            <select class="form-control <?=($bisnieto->ACCEDE == 1)?' palette-Green-A100 bg':''?>"" id="nivel<?=$bisnieto->ID_VENTAS_ACCESO?>" onchange="activar(<?=$bisnieto->ID_VENTAS_ACCESO?>)" >
                                                <option <?=($bisnieto->ACCEDE) ? 'selected' : '' ?> value="1"> ACTIVO </option>
                                                <option <?=($bisnieto->ACCEDE == NULL) ? 'selected' : '' ?> value="0"> INACTIVO </option>
                                            </select>
                                        </div>

                                    </div>
                                <?php endforeach;?>
                                </div>      
                            <?php endforeach;?>
                        </div>
                    <?php endif; ?>
                <?php endforeach;?>
            </div>
        </div>
    </div>
<?php endforeach;?>


<script>
    function activar(id) {

        var estado = $('#nivel'+id).val();
        var usuario = $('#usuario').val();

        $.post("<?=site_url('update-permiso')?>", {estado:estado, usuario:usuario, id:id})
        
        .done(function( data ) {

            Swal.fire({
                icon: 'success',
                title: 'Se ha guardado el cambio solicitado',
                timer: 3500
            });

        });

    }
</script>