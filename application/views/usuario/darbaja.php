<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title"><i class="las la-user-cog"></i>ACCESIBILIDAD</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-xs edit palette-Green-600 bg" data-toggle="modal" data-target="#nuevo">
                    <i class="las la-user-plus la-1x"></i> Nuevo Usuario
                </button>
                <br> <br>

                <table id="table" class="table table-bordered table-striped dataTable dtr-inline">

                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="nombre3" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nombre3">Nuevo Usuario</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?=form_label("Nombres", 'new_nombre');?>
                        <?=form_input('new_nombre', null, ['class'=>'form-control user', 'id'=>'new_nombre', 'required'=>'required']);?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <?=form_label("Apellido Paterno", 'new_appat');?>
                        <?=form_input('new_appat', null, ['class'=>'form-control user', 'id'=>'new_appat']);?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <?=form_label("Apellido Materno", 'new_apmat');?>
                        <?=form_input('new_apmat', null, ['class'=>'form-control', 'id'=>'new_apmat']);?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <?=form_label(lang('dni'), 'new_dni');?>
                        <?=form_input('new_dni', null, ['class'=>'form-control', 'id'=>'new_dni','minlength'=>'5', 'pattern'=>'^[0-9]{5,10}[A-Z]{2}|[0-9]{5,10}$' ,'required'=>'required']);?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" >
                        <?=form_label("Cargo", 'new_cargos');?>

                        <select name="new_expedido" id="new_expedido" class="form-control">
                            <option value="">--- Seleccione una opcion ---</option>
                                <option value="CB">Cochabamba</option>
                                <option value="SC">Santa Cruz</option>
                                <option value="LP">La Paz</option>
                                <option value="OR">Oruro</option>
                                <option value="CH">Chuquisaca</option>
                                <option value="BN">Beni</option>
                                <option value="PT">Potosi</option>
                                <option value="TJ">Tarija</option>
                                <option value="PN">Pando</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" >
                        <?=form_label("N° Teléfono", 'new_telefono');?>
                        <?=form_input(['name'=>'new_telefono', 'type'=>'text' ,'class'=>'form-control', 'maxlength'=>'7','pattern'=>'[4]{1}[0-9]{6}']);?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" >
                        <?=form_label("N° Celular", 'new_celular');?>
                        <?=form_input(['name'=>'new_celular', 'type'=>'text' ,'class'=>'form-control','maxlength'=>'8', 'pattern'=>'[6-7]{1}[0-9]{7}', 'required'=>'required' ]);?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" >
                        <?=form_label("Fecha nacimiento", 'new_nacimiento');?>
                        <?=form_input(['name'=>'new_nacimiento', 'type'=>'date' ,'class'=>'form-control', 'required'=>'required']);?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" >
                        <?=form_label("Correo electronico", 'new_email');?>
                        <?=form_input(['name'=>'new_email', 'type'=>'email' ,'class'=>'form-control']);?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" >
                        <?=form_label("Cargo", 'new_cargos');?>

                        <select name="new_cargos" id="new_cargos" class="form-control">
                            <option value="">--- Seleccione una opcion ---</option>
                            <?php foreach ($cargos as $cargo) : ?>
                                <option value="<?=$cargo->ID?>"><?=$cargo->TEXT?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" >
                        <?=form_label("Perfil", 'new_perfiles');?>
                        <select name="new_perfiles" id="new_perfiles" class="form-control">
                            <option value="">--- Seleccione una opcion ---</option>
                            <?php foreach ($perfiles as $perfil) : ?>
                                <option value="<?=$perfil->TEXT?>"><?=$perfil->TEXT?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" >
                        <?=form_label("Género", 'new_genero');?>
                        <?=form_dropdown('new_genero', [''=>'', 'F'=>'Femenino', 'M'=>'Masculino'], null,['id'=>'new_genero', 'class'=>'form-control']);?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" >
                        <?=form_label("Sueldo", 'new_sueldo');?>
                        <?=form_input(['name'=>'new_sueldo', 'type'=>'text' ,'class'=>'form-control', 'pattern'=>'[+-]?([0-9]+([.][0-9]*)?|[.][0-9]+)', 'required'=>'required' ]);?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" >
                        <?=form_label("Domicilio", 'new_domicilio');?>
                        <?=form_input(['name'=>'new_domicilio', 'type'=>'text' ,'class'=>'form-control', 'required'=>'required']);?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" >
                        <?=form_label("AFP", 'afp');?>
                        <select name="afp" id="afp" class="form-control">
                            <option value="">--- Seleccione una opcion ---</option>
                            <?php foreach ($afp as $a) : ?>
                                <option value="<?=$a->ID_AFP?>"><?=$a->NOMBRE_AFP?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" >
                        <?=form_label("N° de cuenta", 'cuentaban');?>
                        <?=form_input(['name'=>'cuentaban', 'type'=>'text' ,'class'=>'form-control', 'required'=>'required']);?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" >
                        <?=form_label("Fecha ingreso", 'ingreso');?>
                        <?=form_input(['name'=>'ingreso', 'type'=>'date' ,'class'=>'form-control', 'required'=>'required']);?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" >
                        <?=form_label("Usuario", 'usuario');?>
                        <?=form_input(['name'=>'usuario', 'type'=>'text' ,'class'=>'form-control palette-Yellow-200 bg', 'required'=>'required', 'id'=>'usuario']);?>
                    </div>
                </div>

                <div class="col-md-4">
                    <?=form_label( 'Sucursal', 'sucursal'); ?>
                    <select name="sucursal" id="new_sucursal" class="form-control">
                        <option value="">--- Seleccione una opcion ---</option>
                        <?php foreach ($sucursales as $sucursal) : ?>
                            <option value="<?=$sucursal->ID_UBICACION?>"><?=$sucursal->DESCRIPCION?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
        </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" id="confirmar_nuevo">Confirmar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="operaciones" tabindex="-1" role="dialog" aria-labelledby="nombre" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nombre"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
        <div class="col-12">
            <?=form_label( 'Sucursal', 'sucursal'); ?>
            <select name="sucursal" id="sucursal" class="form-control" data-user="" class="form-control">
                <option value="">--- Seleccione una opcion ---</option>
                <?php foreach ($sucursales as $sucursal) : ?>
                    <option value="<?=$sucursal->ID_UBICACION?>"><?=$sucursal->DESCRIPCION?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-12">
            <?=form_label( 'Operacion', 'operacion'); ?> 
            <?=form_dropdown('operacion', [''=>'', '1'=>'Asignar', '2'=>'Retirar'], null, ['id'=>'operacion', 'required'=>'required', 'class'=>'form-control']); ?>
        </div>
      </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" id="confirmar">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="nombre2" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nombre2"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <?=form_label("Nombres", 'nombres');?>
                <?=form_input('nombres', null, ['class'=>'form-control', 'id'=>'nombres', 'required'=>'required']);?>
                <div class="valid-feedback"></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <?=form_label("Apellido Paterno", 'appat');?>
                <?=form_input('appat', null, ['class'=>'form-control', 'id'=>'appat']);?>
                <div class="valid-feedback"></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <?=form_label("Apellido Materno", 'apmat');?>
                <?=form_input('apmat', null, ['class'=>'form-control', 'id'=>'apmat']);?>
                <div class="valid-feedback"></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <?=form_label(lang('dni'), 'dni');?>
                <?=form_input('dni', null, ['class'=>'form-control', 'id'=>'dni', 'required'=>'required']);?>
                <div class="valid-feedback"></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group" >
                <?=form_label("N° Telefono", 'telefono');?>
                <?=form_input(['name'=>'telefono', 'type'=>'text' ,'class'=>'form-control', 'pattern'=>'[4]{1}[0-9]{6}']);?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group" >
                <?=form_label("N° Celular", 'celular');?>
                <?=form_input(['name'=>'celular', 'type'=>'text' ,'class'=>'form-control', 'pattern'=>'[6-7]{1}[0-9]{7}', 'required'=>'required' ]);?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group" >
                <?=form_label("Fecha nacimiento", 'nacimiento');?>
                <?=form_input(['name'=>'nacimiento', 'type'=>'date' ,'class'=>'form-control', 'required'=>'required']);?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group" >
                <?=form_label("Correo electronico", 'email');?>
                <?=form_input(['name'=>'email', 'type'=>'email' ,'class'=>'form-control']);?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group" >
                <?=form_label("Cargo", 'cargos');?>
                <select name="cargos" id="cargos" class="form-control">
                    <option value="">--- Seleccione una opcion ---</option>
                    <?php foreach($cargos AS $cargo):?>
                        <option value="<?=$cargo->ID?>"><?=$cargo->TEXT?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group" >
                <?=form_label("Género", 'genero');?>
                <?=form_dropdown('genero', [''=>'', 'F'=>'Femenino', 'M'=>'Masculino'], null,['id'=>'genero', 'class'=>'form-control']);?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group" >
                <?=form_label("Fecha ingreso", 'ingreso');?>
                <?=form_input(['name'=>'ingreso', 'type'=>'date' ,'class'=>'form-control', 'required'=>'required']);?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group" >
                <?=form_label("Domicilio", 'domicilio');?>
                <?=form_input(['name'=>'domicilio', 'type'=>'text' ,'class'=>'form-control', 'required'=>'required']);?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group" >
                <?=form_label("Sueldo", 'sueldo');?>
                <?=form_input(['name'=>'sueldo', 'type'=>'text' ,'class'=>'form-control', 'pattern'=>'[+-]?([0-9]+([.][0-9]*)?|[.][0-9]+)', 'required'=>'required' ]);?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group" >
                <?=form_label("AFP", 'afp');?>
                <select name="afp" id="afp" class="form-control">
                    <option value="">--- Selecione una opcion ---</option>
                <?php foreach ($afp as $a) : ?>
                    <option value="<?=$a->ID_AFP?>"><?=$a->NOMBRE_AFP?></option>
                <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group" >
                <?=form_label("N° de cuenta", 'cuentaban');?>
                <?=form_input(['name'=>'cuentaban', 'type'=>'text' ,'class'=>'form-control', 'required'=>'required']);?>
            </div>
        </div>
      </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" id="confirmar_edicion">Confirmar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="perfiles" tabindex="-1" role="dialog" aria-labelledby="nombre" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nombre">Cambiar Perfil</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
        <div class="col-12">
            <?=form_label( 'Nuevo perfil', 'perfil'); ?>
            <select name="perfil" id="change_perfil" class="form-control" data-user="" class="form-control">
                <option value="">--- Seleccione una opcion ---</option>
                <?php foreach ($perfiles as $perfil) : ?>
                    <option value="<?=$perfil->TEXT?>"><?=$perfil->TEXT?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" id="change_idusuario">
        </div>
      </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" id="confirmar" onclick="savechangeperfil()">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<script>

       
    var table = $('#table').DataTable({
        ajax: { url: '<?=site_url('get-usuarios')?>' },
        language:{ search: "Buscar", lengthMenu: "Mostrar _MENU_", previous: "Anterior",
        zeroRecords: "Sin resultados", infoEmpty: "No hay registros disponibles",
        info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        infoFiltered: "(Filtrado de _MAX_ registros totales)",
        oPaginate: {sNext:"Siguiente", sLast: "Último", sPrevious: "Anterior", sFirst:"Primero" },
        },
        columns: [
            { title: 'Nombre completo', width:'20%',data: 'NOMBRE' },
            { title: 'Doc. Ident.', width:'10%' ,data: 'CI' },
            { title: 'Celular', width:'10%', data: 'CELULAR' },
            { title: 'Perfil', width:'10%', data: 'TIPO_USUARIO' },
            { title: 'Area', width:'10%', data: 'AREA' },
            { title: 'Cargo', width:'15%', data: 'NOMBRE_CARGO' },
            { title: 'Ubicaciones', width:'15%' ,data: null, 
                render: function (data, type, full, meta) { 

                    var body = '<table class="table table-bordered">';
                    $.each(JSON.parse(data.SUCURSALES), function (i, v) { 
                        body += '<tr><td width="100%">' + v.DESCRIPCION + '</td></tr>';
                    });
                    body += '</table>';
                    
                   return body;
                }
            },
            { title: 'Opciones', width:'15%', data: null, 
                render: function (row, type, set) { 

                    var button = '';
                    if(row.ID_STATUS == 1) {

                        button += '<button class="btn btn-danger btn-xs" onclick="baja('+row.ID_EMPLEADO+')">';
                        button +='<i class="las la-user-times la-2x"></i>';
                        button += '</button>';

                        button += '<button class="btn btn-xs edit palette-Amber-800 bg" data-toggle="modal" data-target="#editar" onclick="editEmpleado('+row.ID_EMPLEADO+',\''+row.NOMBRE+'\')">';
                        button +='<i class="las la-user-edit la-2x"></i>';
                        button += '</button>';

                        if(row.ID_USUARIO) {

                            button += '<button class="btn btn-info btn-xs user" data-toggle="modal" data-target="#operaciones" onclick="setUser('+row.ID_USUARIO+',\''+row.NOMBRE+'\')">';
                            button +='<i class="las la-store-alt la-2x"></i>';
                            button += '</button>';

                            button += '<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#perfiles" onclick="setPerfil('+row.ID_USUARIO+')">';
                            button +='<i class="las la-user-cog la-2x"></i>';
                            button += '</button>';

                        }
                    }

                    else {

                        button += '<button class="btn btn-success btn-xs" onclick="alta('+row.ID_EMPLEADO+')">';
                        button +='<i class="las la-user-check"></i>';
                        button += '</button>';

                    }
                
                    return button;

                }
            }
        ],
    });


    function baja(id) {
        $.post("<?=site_url('dar-baja')?>", {id: id})
        .done(function (data){
            console.log(data);
            table.ajax.reload();

            
            Swal.fire({
                icon: 'success',
                title: 'Se ha dado de baja a un usuario',
                timer: 4500
            });
        });
    }

    function alta(id) {
        $.post("<?=site_url('dar-alta')?>", {id: id})
        .done(function (data){
           
             table.ajax.reload();

            
            Swal.fire({
                icon: 'success',
                title: 'Se ha dado de alta a un usuario',
                timer: 4500
            });
        });
    }

    function setUser(id, nombre) {
        $('#sucursal').attr('data-user', id);

        $('#nombre').empty();
        $('#nombre').append(nombre);
    }

    function setPerfil(id) {
        $('#change_idusuario').val(id);
    }

    function editEmpleado(id, nombre) {

        $('#nombre2').empty();
        $('#nombre2').append(nombre);

        $.post("<?=site_url('get-empleado')?>", {id:id})
        .done(function (data){

            var empleado = JSON.parse(data);

            $('#nombres').val(empleado.data.NOMBRE);
            $('#appat').val(empleado.data.AP_PATERNO);
            $('#apmat').val(empleado.data.AP_MATERNO);
            $('#dni').val(empleado.data.CI);
            $('input[name="telefono"]').val(empleado.data.TELEFONO);
            $('input[name="celular"]').val(empleado.data.CELULAR);
            $('input[name="nacimiento"]').val(empleado.data.FECHA_NACIMIENTO);
            $('input[name="email"]').val(empleado.data.EMAIL);
            $('#cargos').val(empleado.data.ID_CARGO).trigger('change');
        });
    }

    $('#confirmar').on('click', function(){

        var user = $('#sucursal').attr('data-user');
        var sucursal =  $('#sucursal').val();
        var operacion = $('#operacion').val();

        $('#operaciones').modal('hide');

        if( user > 0 && sucursal > 0 && operacion > 0) {

            $.post("<?=site_url('set-ubicacion')?>", {user:user, sucursal:sucursal, operacion:operacion})
            .done(function( data ) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Se han realizado todos los cambios solicitados',
                    timer: 4500
                });

                table.ajax.reload();
            });
        }
    });


    function permisos(id, nombre) {

        $.post("<?=site_url('get-menu')?>", {id: id} )

            .done( function( data ) {

               var datos = JSON.parse(data);
                var armada

                $.each(datos, function (i, v) { 
                     
                });
            });
    }

    function savechangeperfil() {

        var id = $('#change_perfil').val();
        var user = $('#change_idusuario').val();

        if(id && user){

            $.post("<?=site_url('change-perfil')?>", {user:user, id:id})
            .done(function (data){
        
                table.ajax.reload(); 
                $('#perfiles').modal('hide');

                Swal.fire({
                icon: 'success',
                title: 'Se ha cambiado el perfil de usuario',
                timer: 4500
            });


        });


        }

        


    }

    $('.user').on('input', function(){

        var nombre = $('#new_nombre').val().substr(0,1).toLowerCase();

        var apellido = $('#new_appat').val().toLowerCase();

        var usuario = nombre+apellido;


        $.post("<?=site_url('check-user')?>", {user:usuario})
        .done(function (data){
        
            valor = JSON.parse(data);

            $('#usuario').val(valor.result);
        });
    });

    $('#new_dni').on('blur', function(){

        var dni = $('#new_dni').val();

        $.post("<?=site_url('check-dni')?>", {dni:dni})
        .done(function (data){

            valor = JSON.parse(data);

            if(valor.status == false)
            Swal.fire({
                icon: 'error',
                title: 'El Documento de Identidad ya fue registrado',
                timer: 4500
            });
        });
    });


    $('#confirmar_nuevo').on('click', function(){

        var nombre = $('#new_nombre').val();
        var appat =  $('#new_appat').val();
        var apmat = $('#new_apmat').val();
        var dni = $('#new_dni').val();
        var expedido = $('#new_expedido').val();
        var celular = $('input[name="new_celular"]').val();
        var telefono = $('input[name="new_telefono"]').val();
        var nacimiento = $('input[name="new_nacimiento"]').val();
        var email = $('input[name="new_email"]').val();
        var cargo = $('#new_cargos').val();
        var perfil = $('#new_perfiles').val();
        var sueldo = $('input[name="new_sueldo"]').val();
        var domicilio = $('input[name="new_domicilio"]').val();
        var afp = $('#afp').val();
        var cuenta = $('input[name="cuentaban"]').val();
        var ingreso = $('input[name="ingreso"]').val();
        var usuario = $('#usuario').val();
        var sucursal = $('#new_sucursal').val();
        var genero = $('#new_genero').val();




        $('#nuevo').modal('hide');

        if( nombre != '' && dni != '' && perfil > 0 && sucursal > 0) {

            $.post("<?=site_url('nuevo-usuario')?>", 
                {
                    nombre:nombre, appat:appat, apmat:apmat, dni:dni, celular:celular, 
                    telefono:telefono, nacimiento:nacimiento, email:email, cargo:cargo,
                    perfil:perfil, sueldo:sueldo, domicilio:domicilio, afp:afp, genero:genero,
                    cuenta:cuenta, ingreso:ingreso, usuario:usuario, sucursal:sucursal, expedido:expedido })
            .done(function( data ) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Se han realizado todos los cambios solicitados',
                    timer: 4500
                });

                table.ajax.reload();
            });
        }
    });

    


</script>