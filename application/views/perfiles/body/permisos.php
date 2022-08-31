<!-- BOOTSTRAP SWITCH-->
<?=link_tag('node_modules/bootstrap4-toggle/css/bootstrap4-toggle.min.css')?>
  <script src="<?=base_url('node_modules/bootstrap4-toggle/js/bootstrap4-toggle.min.js')?>"></script>

<?php foreach ($menu as $value): ?>
    <div class="row palette-Red-200 bg">
      <div class="col-9"><p class="lead" style="font-weight: 500;"><?=$value->NOMBRE?></p></div>
      <div class="col-3"> 
      <input name="escogidos[]" value="<?=$value->ID_VENTAS_ACCESO?>" type="checkbox" <?=($value->ACCEDE)? 'checked': '' ?>  data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary" data-size="xs" data-on="SI" data-off="NO">
      </div>
    </div>
     <?php  $this->db->where('NIVEL_SUPERIOR', $value->ID_VENTAS_ACCESO);
            $hijos = $this->main->getListSelect('VENTAS_ACCESO va', 'ID_VENTAS_ACCESO, NOMBRE, NIVEL_SUPERIOR,NUMERO_ORDEN, ( 
                SELECT ID_VENTAS_ACCESO 
                FROM VENTAS_PERMISO_PERFIL vpp 
                WHERE vpp.ID_VENTAS_PERFIL = '.$id.' AND 
                vpp.ID_VENTAS_ACCESO = va.ID_VENTAS_ACCESO
            ) AS ACCEDE');
    ?>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <?php foreach ($hijos as $hijo): ?>
                        <div class="col-1"></div>
                        <div class="col-8"><p class="lead" style="font-weight: 500;"><?=$hijo->NOMBRE?></p></div>
                        <div class="col-3"> 
                            <input name="escogidos[]" value="<?=$hijo->ID_VENTAS_ACCESO?>" type="checkbox" <?=($hijo->ACCEDE)? 'checked': '' ?>  data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary" data-size="xs" data-on="SI" data-off="NO">
                        </div>

                        <?php  $this->db->where('NIVEL_SUPERIOR', $hijo->ID_VENTAS_ACCESO);
                                $nietos = $this->main->getListSelect('VENTAS_ACCESO va', 'ID_VENTAS_ACCESO, NOMBRE, NIVEL_SUPERIOR,NUMERO_ORDEN, ( 
                                    SELECT ID_VENTAS_ACCESO 
                                    FROM VENTAS_PERMISO_PERFIL vpp 
                                    WHERE vpp.ID_VENTAS_PERFIL = '.$id.' AND 
                                    vpp.ID_VENTAS_ACCESO = va.ID_VENTAS_ACCESO
                                ) AS ACCEDE');
                        ?>
                        <?php if($nietos): ?>
                        <div class="row">
                            <?php foreach ($nietos as $nieto): ?>
                                <div class="col-3">

                                </div>
                                <div class="col-6"><p class="lead" style="font-weight: 500;"><?=$nieto->NOMBRE?></p></div>
                                <div class="col-3"> 
                                <input name="escogidos[]" value="<?=$nieto->ID_VENTAS_ACCESO?>" type="checkbox" <?=($nieto->ACCEDE)? 'checked': '' ?>  data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary" data-size="xs" data-on="SI" data-off="NO">
                                </div>
                                <?php  $this->db->where('NIVEL_SUPERIOR', $nieto->ID_VENTAS_ACCESO);
                                        $bisnietos = $this->main->getListSelect('VENTAS_ACCESO va', 'ID_VENTAS_ACCESO, NOMBRE, NIVEL_SUPERIOR,NUMERO_ORDEN, ( 
                                            SELECT ID_VENTAS_ACCESO 
                                            FROM VENTAS_PERMISO_PERFIL vpp 
                                            WHERE vpp.ID_VENTAS_PERFIL = '.$id.' AND 
                                            vpp.ID_VENTAS_ACCESO = va.ID_VENTAS_ACCESO
                                        ) AS ACCEDE');
                                ?>
                                

                                <div class="col-12">

                                <?php foreach ($bisnietos as $bisnieto): ?>
                                    <div class="row">

                                        <div class="col-4">
                                        </div>

                                        <div class="col-5"><p class="lead" style="font-weight: 500;"><?=$bisnieto->NOMBRE?></p></div>
                                        <div class="col-3"> 
                                            <input name="escogidos[]" value="<?=$bisnieto->ID_VENTAS_ACCESO?>" type="checkbox" <?=($bisnieto->ACCEDE)? 'checked': '' ?>  data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary" data-size="xs" data-on="SI" data-off="NO">
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