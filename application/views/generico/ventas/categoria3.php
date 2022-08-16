<?php if(!$search):?>
    
<div class="row">
    <div class="col-sm-3">
        <button id="volver-categoria-2" class="btn btn-primary palette-Black bg col-xs-12 btn-xs expanded">
            <span style="margin:0.5rem; font-size: 0.7rem; font-weight:600">
                <i class="las la-angle-left"></i>ATRAS
            </span>
        </button>
    </div>

    <div class="col-sm-3">
        <button id="volver-categoria-1" class="btn btn-primary palette-Black bg col-xs-12 btn-xs expanded">
            <span style="margin:0.5rem; font-size: 0.7rem; font-weight:600">
                <i class="las la-angle-double-left"></i>CATEGORIAS
            </span>
        </button>
    </div>
</div>
<div class="row">
    <?php foreach($cat3 as $row): ?>
        <?php $productos = json_decode($row->productos)?>
            <?php foreach($productos as $producto): ?>

                <div class="col-md-6 col-sm-6 col-12">
                    <div class="info-box">
                    <img width="85" height="95" src="data:image/png;base64,<?=($producto->Imagenes)?$producto->Imagenes:LOGO?>" />
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size:large"><?=($producto->PRODUCTO_MADRE)?></span>
                            <div class="row">
                                <?php foreach($producto->PRESENTACION as $p):?>
                                    <?php if($p->ID_NOMBRE_LISTA_PRECIOS == $this->session->id_lista): ?>
                                        <?php 
                                            $id_pro = $p->ID_PRODUCTO_UNICO;
                                            $idenBtn='btnPro-'.$id_pro;
                                         ?>
                                        <div class="col-md-4">
                                            <button type="button" iden="<?=$id_pro?>" nombre="<?=$producto->PRODUCTO_MADRE?>" precio_unit="<?=$p->PRECIO?>" tam="<?=$p->TAMAÑO?>" class="btn btn-danger btn-md btnProduct <?=$idenBtn?>">
                                                <?=$p->TAMAÑO?><span class="badge badge-teal"><?=$p->PRECIO.' Bs.'?></span>
                                            </button>
                                        </div>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
<?php else:?>
    <div class="row">
        <?php foreach($cat3 as $row): ?>
            <?php $productos = json_decode($row->productos)?>
            <?php foreach($productos as $producto): ?>
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="info-box">
                        <img width="85" height="95" src="data:image/png;base64,<?=($producto->Imagenes)?$producto->Imagenes:LOGO?>" />
                        <div class="info-box-content">
                            <span class="info-box-text"><?=($producto->PRODUCTO_MADRE)?></span>
                            <div class="row">
                                <?php foreach($producto->PRESENTACION as $p):?>
                                    <?php if($p->ID_NOMBRE_LISTA_PRECIOS == $this->session->id_lista): ?>
                                    <?php 
                                        $id_pro = $p->ID_PRODUCTO_UNICO;
                                        $idenBtn='btnPro-'.$id_pro; ?>
                                <div class="col-md-3">
                                    <button type="button" iden="<?=$id_pro?>" nombre="<?=$producto->PRODUCTO_MADRE?>" precio_unit="<?=$p->PRECIO?>" tam="<?=$p->TAMAÑO?>" class="btn btn-danger btn-xs btnProduct <?=$idenBtn?>">
                                        <?=$p->TAMAÑO?><span class="badge badge-teal"><?=$p->PRECIO.' Bs.'?></span>
                                    </button>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

   
<script>
    $('#volver-categoria-2').on('click', function(){
        $('#categoria-2').show('slow');
        $('#categoria-3').hide();
    });

    $('#volver-categoria-1').on('click', function(){
        $('#categoria-1').show('slow');
        $('#categoria-3').hide();
    });

    $('.second').on('click', function(){
        var id = $(this).data("id");

        $.ajax({
            type: "post",
            url: "<?=site_url('categoria-3')?>",
            data: {id: id},
            dataType: "html",
            success: function (response) {
                $('#categoria-2').hide('slow');
                $('#categoria-3').empty();
                $('#categoria-3').show('slow');
                $('#categoria-3').append(response);
            }
        });
    });

    $('.btnProduct').on('click', function(){
        var id = ''+(Date.now()) / 1000;
    id = id.replace(/\./g, '');
    var nameClass='row-'+id;
    var nameTextSms = 'sms-'+id;
    var nameClassCant = 'cant-'+id;
    var nameForCarry = 'llevar-'+id;
    var nombre = $(this).attr("nombre");
    var idProd = $(this).attr("iden");
    var valUnit = $(this).attr("precio_unit");
    var tam = $(this).attr("tam");
    if(tam != ''){
        tam = '-'+tam;
    }

    productoAdicional(idProd, id);

    let row = `
    <input value="${id}" type="hidden" name="identificadores" />
    <input value="${idProd}" type="hidden" name="idProductosUnicos" />
    
    <td class="celdaProducts thProd"> <input value="1" type="hidden" name="recibos" /> <input value="${nombre}${tam}" type="hidden" name="nombresProductos" />${nombre}${tam}</td>
    <td class="celdaProducts" style="text-align: center;"><input value="${valUnit}" class="in-cant" type="hidden" min="0" name="preciosUnitarios" />${valUnit}</td>
    <td class="celdaProducts" style="text-align: center;"><input class="in-cant celdaCantidad ${nameClassCant}" type="number" min="1" value="1" name="cantidades" onchange="onChangeQuantityCurrent(this)" /></td>
    <td class="celdaProducts" style="text-align: center;"><input value="0" class="in-cant" type="hidden" name="subtotales" /><span class="spanSubtotales"></span></td>
    `;
    $("#tableProducts>tbody").append(`
    <tr>
    ${row}
    <td class="celdaProducts" style="text-align: center;">
    <input class="${nameForCarry}" value="0" type="hidden" name="paraLlevar" />
    <button class="btn btnDisable btn-xs" onClick="onClickAddCart(this,'${nameForCarry}')"><i class="fa fa-cart-plus"></i></button>
        <input class="${nameTextSms}" type="hidden" name="mensajes" />
        <button class="btn btnDisable btn-xs ${nameClass} btnMessages" iden="${id}" onClick="onClickAddMessage(this)" data-toggle="modal" data-target="#modalAgregarMensaje" ><i class="fa fa-comment-o"></i></button>
        <button class="btn btn-warning btn-xs"  data-toggle="modal" data-target="#procedimiento_${id}" ><i class="fa fa-pencil"></i></button>
        <button class="btn btn-danger deleteRow btn-xs" iden="${id}"><i class="fa fa-times"></i></button>
    </td>
    </tr>
    `);
    calcularTotales();
    calcularRecibos();
    return false;
    
});
$('body').on('click', 'button.deleteRow', function() {
    $(this).parents('tr').remove();
    calcularTotales();
    calcularRecibos();
});
    
</script>