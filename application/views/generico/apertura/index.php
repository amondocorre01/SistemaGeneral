<?php
$name_impresora = $this->session->userdata('impresora');
?>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="card card-outline card-danger">
            <div class="card-header">
            <h3 class="card-title">Apertura de Caja</h3>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('msg')): ?>
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <?= $this->session->flashdata('msg') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <?php endif ?>
                <div style="text-align:center">
                    <?=img(['src'=>'assets/dist/img/logo.png', 'alt'=>'Capresso', 'width'=>'30%' ,'style'=>'opacity: .8'])?>
                </div>

                <br>
                <form action="<?php echo site_url('apertura-caja'); ?>" method="post">
                <div class="offset-md-3 col-md-6">
                    <label>Monto de apertura de caja</label>
                    <div class="input-group mb-3">
                        <input id="money" oninput="check()" type="text" class="form-control entero" required name="apertura" placeholder="Debe ingresar un valor">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa fa-money"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="text-align:center">
                        <button type="submit" id="apertura" class="btn btn-app palette-Green-600 bg">
                            <i class="fa fa-money palette-White text"></i> <span class="palette-White text">Registar apertura de caja</span>
                        </button>
                        <a class="btn btn-app" onclick="abrirGavetera('<?=$name_impresora?>');">
                            <i class="fa fa-archive"></i> Abrir gabeta de dinero
                        </a>
                        <?php if(! isset($_SESSION['monto_apertura_pendiente'])):?>
                        <a href="<?php echo site_url('apertura-caja-pendiente/'); ?>" class="btn btn-app palette-Blue-600 bg">
                            <i class="fa fa-users palette-White text"></i> <span class="palette-White text">Abrir turno con pendiente</span>
                        </a>
                        <?php endif; ?>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    function abrirGavetera(name_impresora){
        var url= "<?=site_url('abrir-gaveta')?>";
        window.open(url,'_blank');
    }

    function check() {
        var money = parseInt($('#money').val());
        if(money >=0) {
            $('#apertura').removeAttr('disabled');
        }
        else {
            $('#apertura').attr('disabled', 'disabled');
        }   
    }

    $('.entero').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    
</script>
  