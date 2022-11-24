
<br>
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
    
        <div class="card card-outline card-danger">
            <div class="card-header">
                <center>
                <h4>Resetear Contraseña</h4>
                </center>
            </div>
            <div class="card-body">
                <div style="text-align:center">
                    <?=img(['src'=>'assets/dist/img/logo.png', 'alt'=>'Capresso', 'width'=>'30%' ,'style'=>'opacity: .8'])?>
                </div>

                <br>
                
                <?php $url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
                <input type="hidden" value="<?php echo $url; ?>" name="ruta">
                <div class="offset-md-2 col-md-8">
                    <div class="form-group mb-3">
                        <?=form_label('Seleccione usuario', 'ingreso_egreso', ['class'=>'col-form-label']);?>
                        <select class="form-control" name="tipo" required id="usuario">
                            <?php foreach ($usuarios as $value): ?>
                                <option value="<?=$value->id?>"><?=$value->text?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>

                               
                <div class="offset-md-2 col-md-8">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" id="registrar" onclick="resetPassword()" class="btn btn-block btn-success btn-sm">Enviar</button>
                        </div>
                        <div class="col-6">
                            <button type="button" id="reset"  onclick="returnInicio()" class="btn btn-block btn-danger btn-sm">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function resetPassword() {

        var id = $('#usuario').val();

        $.post("<?=site_url('reset-password')?>", {id:id})
                .done(function( data ) {

                    Swal.fire({
                        icon: 'success',
                        title: 'se ha reseteado la contraseña del usuario',
                        timer: 4500
                    });
        });
    }


    function returnInicio() {
        window.location = "<?=current_url()?>";
    }
</script>
