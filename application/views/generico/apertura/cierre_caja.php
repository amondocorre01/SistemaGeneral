<?php
$name_impresora = $this->session->userdata('impresora');
?>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="card card-outline card-danger">
            <div class="card-header">
            <h3 class="card-title">Cierre de Caja</h3>
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
                <?php if(! isset($_SESSION['id_apertura_turno'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        Atencion: Debe iniciar la APERTURA DE CAJA.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <?php else: ?>
                <?php if(isset($_SESSION['monto_apertura_pendiente'])):?>
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                Atención: Esta pendiente el registro del monto con el ingreso del turno. <br>
                Para registrar la información ingrese en el menú lateral en la opción APERTURA DE CAJA.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php else: ?>
                <div style="text-align:center">
                    <?=img(['src'=>'assets/dist/img/logo.png', 'alt'=>'Capresso', 'width'=>'30%' ,'style'=>'opacity: .8'])?>
                </div>

                <br>
                <?=form_open('cierre-caja', 'id="formCC"')?>
                <?php $url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
                <input type="hidden" value="<?php echo $url; ?>" name="ruta">
                <div class="offset-md-3 col-md-6">
                    <label>Monto de cierre de caja</label>
                    <div class="input-group mb-3">
                        <input id="money" oninput="check()" type="text" class="form-control entero" required name="cierre" placeholder="Debe ingresar un valor">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa fa-money"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="text-align:center">
                    <center>
                    <button type="submit" id="apertura" class="btn btn-app palette-Green-600 bg">
                            <i class="fa fa-money palette-White text"></i> <span class="palette-White text">Registar cierre de caja</span>
                        </button>
                        <a class="btn btn-app" onclick="abrirGavetera('<?=$name_impresora?>');">
                            <i class="fa fa-archive"></i> Abrir gaveta de dinero
                        </a>
                    </center>
                </div>
                <?=form_close()?>
                <?php endif; ?>
                <?php endif; ?>
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
  