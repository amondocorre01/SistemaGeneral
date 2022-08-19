<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title"><i class="las la-user-plus"></i> Nuevo Usuario</h3>
            </div>
            <div class="card-body">

                <?=form_open(site_url('guardar-usuario'), 'class="needs-validation" novalidate', null);?>

                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <?=form_label("Nombres", 'nombre');?>
                                <?=form_input('nombre', null, ['class'=>'form-control', 'id'=>'nombre', 'required'=>'required']);?>
                                <div class="valid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <?=form_label("Apellido Paterno", 'appat');?>
                                <?=form_input('appat', null, ['class'=>'form-control', 'id'=>'appat']);?>
                                <div class="valid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <?=form_label("Apellido Materno", 'apmat');?>
                                <?=form_input('apmat', null, ['class'=>'form-control', 'id'=>'apmat']);?>
                                <div class="valid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <?=form_label(lang('dni'), 'dni');?>
                                <?=form_input('dni', null, ['class'=>'form-control', 'id'=>'dni', 'required'=>'required']);?>
                                <div class="valid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" >
                                <?=form_label("N° Telefono", 'telefono');?>
                                <?=form_input(['name'=>'telefono', 'type'=>'text' ,'class'=>'form-control', 'pattern'=>'[4]{1}[0-9]{6}']);?>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" >
                                <?=form_label("N° Celular", 'celular');?>
                                <?=form_input(['name'=>'celular', 'type'=>'text' ,'class'=>'form-control', 'pattern'=>'[6-7]{1}[0-9]{7}', 'required'=>'required' ]);?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group" >
                                <?=form_label("Fecha nacimiento", 'nacimiento');?>
                                <?=form_input(['name'=>'nacimiento', 'type'=>'date' ,'class'=>'form-control', 'required'=>'required']);?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" >
                                <?=form_label("Correo electronico", 'email');?>
                                <?=form_input(['name'=>'email', 'type'=>'email' ,'class'=>'form-control']);?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" >
                                <?=form_label("Cargo", 'cargos');?>
                                <?=form_dropdown('cargos', $cargos, null ,['id'=>'cargos', 'class'=>'form-control']);?>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" >
                                <?=form_label("Género", 'genero');?>
                                <?=form_dropdown('genero', [''=>'', 'F'=>'Femenino', 'M'=>'Masculino'], null,['id'=>'genero', 'class'=>'form-control']);?>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" >
                                <?=form_label("Fecha ingreso", 'ingreso');?>
                                <?=form_input(['name'=>'ingreso', 'type'=>'date' ,'class'=>'form-control', 'required'=>'required']);?>
                            </div>
                        </div>

                       
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" >
                                <?=form_label("Domicilio", 'domicilio');?>
                                <?=form_input(['name'=>'domicilio', 'type'=>'text' ,'class'=>'form-control', 'required'=>'required']);?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <?=form_label("Ubicacion", 'ubicacion');?>
                            <?=form_multiselect('ubicacion[]', $ubicaciones, null, ['id'=>'ubicacion','required'=>'required']);?>
                        </div>
                    </div>

                    <div class="row">
                       

                        <div class="col-md-2">
                            <div class="form-group" >
                                <?=form_label("Sueldo", 'sueldo');?>
                                <?=form_input(['name'=>'sueldo', 'type'=>'text' ,'class'=>'form-control', 'pattern'=>'[+-]?([0-9]+([.][0-9]*)?|[.][0-9]+)', 'required'=>'required' ]);?>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" >
                                <?=form_label("AFP", 'afp');?>
                                <?=form_dropdown('afp', $afp, null,['id'=>'afp', 'class'=>'form-control']);?>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" >
                                <?=form_label("N° de cuenta", 'cuentaban');?>
                                <?=form_input(['name'=>'cuentaban', 'type'=>'text' ,'class'=>'form-control', 'required'=>'required']);?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <button class="btn btn-lg palette-Red-800 bg" type="submit"><i class="las la-check-circle"></i>Registrar</button>
                        </div>
                    </div>

                    
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<script>
    $('#cargos').select2();
    $('#genero').select2({
        placeholder: "---Seleccione una opción---"
    });
    $('#afp').select2({
        placeholder: "---Seleccione una opción---"
    });

    $('#ubicacion').select2({
        placeholder: "---Seleccione una o varias opciónes---"
    });

    
</script>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
