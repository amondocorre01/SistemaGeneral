<div class="row">
    <?php $i = 1; ?>
    <?php foreach($cat1 as $row): ?>
        <?php if($i == $row->ORDENADO): ?>
            <div class="first col-md-1-7 areacat" data-id="<?=$row->ID_CATEGORIA?>">
                <div class="card bg-gradient-danger viewtable">
                    <div class="card-body cat1">
                        <?=ellipsize($row->CATEGORIA, 30, 0.5, '...');?>
                    </div>
                </div>
            </div>
        <?php else:?>
           
            <?php while ($row->ORDENADO != $i) : ?>
                <div class="col-md-1-7 areacat">
                    
                </div>
                <?php $i= $i + 1;?>
            <?php endwhile; ?>
            <div class="first col-md-1-7 areacat" data-id="<?=$row->ID_CATEGORIA?>">
                <div class="card bg-gradient-danger viewtable">
                    <div class="card-body cat1">
                        <?=ellipsize($row->CATEGORIA, 50, 0.5, '...');?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php $i= $i + 1;?>
    <?php endforeach; ?>
</div>


<script>

$('.first').on('click', function(){

    var myArray = [];
    
    $.each(<?=json_encode($cat1) ?>, function (index, value) { 
          myArray[value.ID_CATEGORIA] = $.parseJSON(value.CAT2);
      });

        var id = $(this).data("id");
        var cat2 = myArray[id];

        var bcat2 = '';
                bcat2 += '<div class="row">';
                    bcat2 += '<div class="volver-cat1 col-3 h-100">';
                    bcat2 += '<button title="VOLVER" class="btn btn-primary palette-Black bg col-sx-12 btn-xs expanded">';
                    bcat2 += '<span style="font-size: 0.7rem; font-weight:600"><i class="las la-undo"></i>CATEGORIAS';
                    bcat2 += '</span></button></div>' ;
                bcat2 += '</div>';
        
                bcat2 += '<div class="row">';
                $.each(cat2, function (i, v) { 
                   
                    var text = v.CATEGORIA_2;
                    var size = text.length
                   
                    bcat2 += '<div class="col-md-2-5 areacat" onclick="second('+v.ID_CATEGORIA_2+')">';
                        bcat2 += '<div class="card bg-gradient-danger viewtable">';
                            bcat2 += '<div class="card-body cat1">';
                                bcat2 += ellipsis(text, size);
                            bcat2 += '</div>';
                        bcat2 += '</div>';
                    bcat2 += '</div>';
                });

                bcat2 += '</div>';

            $('#categoria-1').hide('slow');
            $('#categoria-2').empty();
            $('#categoria-2').append(bcat2);
            $('#categoria-2').show('slow');

            $('.volver-cat1').on('click', function(){
                $('#categoria-2').hide('slow');
                $('#categoria-1').show();
            });
    });

    function second(id) {

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
                var botonesMessages = $('.btnMessages');
                $.each(botonesMessages, function( index, btnMessage ) {
                    console.log(btnMessage);
                });
            }
        });
    }

    function ellipsis(text, size) {

        if(size > 20)
            return text.substring(0, 20)+'...';
        else 
            return text;
    }

</script>


 