<div class="row" style="margin-top:0.5rem">
    <div class="col-sm-12 center" style="text-align:center">
        <h5>Categoria 2</h5>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        <button class="second btn btn-primary palette-Teal-400 bg col-sm-12">
            <i class="fa fa-product-hunt fa-2x"></i>
            <span style="margin:1rem">Browni</span>
        </button>
    </div>
    <div class="col-sm-3">
        <button class="second btn btn-primary palette-Teal-400 bg col-sm-12">
            <i class="fa fa-tags fa-2x"></i>
            <span style="margin:1rem">Tiramisu</span>
        </button>
    </div>
                                                                                                                                                    
    <div class="col-sm-3">
        <button class="second btn btn-primary palette-Teal-400 bg col-sm-12">
            <i class="la la-mug-hot la-2x"></i>
            <span style="margin:1rem">Torta de Capuccino</span>
        </button>
    </div>

    <div class="col-sm-3">
        <button class="second btn btn-primary palette-Teal-400 bg col-sm-12">
            <i class="la la-ice-cream la-2x"></i>
            <span style="margin:1rem">Pizza de Jamon</span>
        </button>
    </div>
</div>

<div class="" id="categoria-3"></div>


<script>
    $('.second').on('click', function(){
        $.ajax({
            type: "post",
            url: "<?=site_url('categoria-3')?>",
            data: {id:4},
            dataType: "html",
            success: function (response) {
                $('#categoria-3').empty();
                $('#categoria-3').append(response);
            }
        });
    });
</script>