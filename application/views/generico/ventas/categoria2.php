<div class="row">
    <?php foreach($cat2 as $row): ?>
        <div class="col-4">
        <button data-id="<?=$row->ID_CATEGORIA_2?>" class="second btn btn-primary palette-Red-800 bg col-sx-12 btn-lg expanded" data-tooltip="tooltip" title="<?=mb_strtoupper($row->CATEGORIA_2)?>">
            <span style="margin:0.5rem; font-size: 0.7rem; font-weight:600">
                <?=ellipsize(mb_strtoupper($row->CATEGORIA_2), 25, .5);?>
            </span>
        </button>
    </div>
    <?php endforeach; ?>

    <div class="col-4">
        <button id="volver-categoria-1" class="btn btn-primary palette-Red-400 bg col-xs-12 btn-lg expanded">
            <span style="margin:0.5rem; font-size: 0.7rem; font-weight:600">
                VOLVER
            </span>
        </button>
    </div>
    <button data-id="" class="second btn btn-primary palette-Black bg col-sx-4 btnProduct">
                                    <span style="margin:0.5rem; font-size: 0.7rem; font-weight:600">
                                        grande
                                    </span>
                                </button>
</div>
<script>
    $('#volver-categoria-1').on('click', function(){
        $('#categoria-1').show('slow');
        $('#categoria-2').hide();
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
                //deshabilitar botones 
            }
        });
    });
</script>
