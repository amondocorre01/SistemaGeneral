<?php
$name_impresora = $this->session->userdata('impresora');
?>
<br>
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
    
        <div class="card card-outline card-danger">
            <div class="card-header">
                <center>
                <h4>Ingresos e Egresos</h4>
                </center>
            </div>
            <div class="card-body">
                <?php if( ! isset($_SESSION['id_apertura_turno'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    Atencion: Debe iniciar la APERTURA DE CAJA.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <?php else: ?>
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
                <?=form_open('registrar-movimiento', 'id="formIE"')?>
                <?php $url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
                <input type="hidden" value="<?php echo $url; ?>" name="ruta">
                <div class="offset-md-2 col-md-8">
                    <div class="form-group mb-3">
                        <?=form_label('Seleccione tipo de movimiento', 'ingreso_egreso', ['class'=>'col-form-label']);?>
                        <?=form_dropdown('ingreso_egreso', [''=>'', 'I'=>'Ingreso', 'E'=>'Egreso'], null, ['class'=>'custom-select rounded-0', 'id'=>'ingreso_egreso', 'required'=>'required', 'onchange'=>'option_tipo()'])?>
                    </div>
                </div>

                <div class="offset-md-2 col-md-8">
                    <div class="form-group">
                        <?=form_label('Detalle de movimiento', 'tipo_movimiento', ['class'=>'col-form-label']);?>
                        <?=form_dropdown('tipo_movimiento', null, null, ['class'=>'custom-select rounded-0', 'id'=>'tipo_movimiento', 'onchange'=>'es_permitido()'])?>
                    </div>
                </div>

                <div class="offset-md-2 col-md-8">
                    <div class="form-group">
                        <?=form_label('Monto de movimiento', 'monto', ['class'=>'col-form-label']);?>
                        <?=form_input('monto', null, ['class'=>'form-control decimales', 'id'=>'monto', 'required'=>'required'])?>
                    </div>
                </div>

                <div class="offset-md-2 col-md-8">
                    <div class="form-group">
                        <?=form_label('Descripcion', 'descripcion', ['class'=>'col-form-label']);?>
                        <?=form_input('descripcion', null, ['class'=>'form-control', 'id'=>'descripcion', 'disabled'=>'disabled'])?>
                    </div>
                </div>
                
                <div class="offset-md-2 col-md-8">
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" id="registrar" class="btn btn-block btn-outline-dark btn-sm">Enviar</button>
                        </div>
                        <div class="col-6">
                            <button type="button" id="reset"  onclick="returnInicio()" class="btn btn-block btn-danger btn-sm">Cancelar</button>
                        </div>
                    </div>
                </div>
                <?=form_close()?>
                <?php endif;?>
                <center>
                    <br>
                <a class="btn btn-app" onclick="abrirGavetera('<?=$name_impresora?>');">
                            <i class="fa fa-archive"></i> Abrir gabeta de dinero
                        </a>
                </center>
            </div>
        </div>
    </div>
</div>

<script>

function abrirGavetera(name_impresora){
        var url= "<?=site_url('abrir-gaveta')?>";
        window.open(url,'_blank');
    }

$('.decimales').on('input', function () {
    this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
});

 function option_tipo() {

    var valor = $('#ingreso_egreso').val();

    $('#monto').val('');
    $('#descripcion').val('');


        $.ajax({ type: "POST", url: "<?=site_url('detalle-IE')?>", data: {tipo: valor}, dataType: "json",
            success: function (response) {
                $("#tipo_movimiento option").remove();
                $('#tipo_movimiento').append('<option value="">---Seleccione una opcion---</option>');
                $.each(response, function (i, v) { 
                    $('#tipo_movimiento').append('<option allow="'+v.ESTADO_MOTIVO+'" value="'+v.ID_VENTAS_DESCRIPCION_IE+'">'+v.DESCRIPCION+'</option>');
                });
            }
        });
        
        if(valor === 'I') {
            $('#registrar').empty();
            $('#registrar').append('Registrar Ingreso');

        }

        if(valor === 'E') {
            $('#registrar').empty();
            $('#registrar').append('Registrar Egreso');

        }

 }

    function es_permitido() {
        var allow = $("#tipo_movimiento option:selected").attr('allow');
        if(allow == 1)
        {
            $('#descripcion').removeAttr('disabled');
        }
        else {
            $('#descripcion').attr('disabled','disabled');
        }
    }


    function returnInicio() {
        window.location = "<?=current_url()?>";
    }
</script>
