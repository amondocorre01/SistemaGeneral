<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title"><i class="las la-user-cog"></i>ACCESIBILIDAD</h3>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped dataTable dtr-inline">

                </table>
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
            <?=form_dropdown('sucursal', $sucursales, null, ['id'=>'sucursal', 'required'=>'required', 'data-user'=>'']); ?>
        </div>

        <div class="col-12">
            <?=form_label( 'Operacion', 'operacion'); ?> 
            <?=form_dropdown('operacion', [''=>'', '1'=>'Asignar', '2'=>'Retirar'], null, ['id'=>'operacion', 'required'=>'required']); ?>
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
                <?=form_dropdown('cargos', $cargos, null ,['id'=>'cargos']);?>
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
                <?=form_dropdown('afp', $afp, null,['id'=>'afp', 'class'=>'form-control']);?>
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

<script>

    $('#sucursal').select2({
        placeholder: "Seleccione una opcion"
    });

    $('#operacion').select2({
        placeholder: "Seleccione una opcion"
    });

    $('#cargos').select2({
        placeholder: "Seleccione una opcion"
    });
    
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
                        button +='<i class="las la-user-times"></i>';
                        button += '</button>';

                        button += '<button class="btn btn-xs edit palette-Amber-800 bg" data-toggle="modal" data-target="#editar" onclick="editEmpleado('+row.ID_EMPLEADO+',\''+row.NOMBRE+'\')">';
                        button +='<i class="las la-user-edit"></i>';
                        button += '</button>';

                        if(row.ID_USUARIO) {

                            button += '<button class="btn btn-info btn-xs user" data-toggle="modal" data-target="#operaciones" onclick="setUser('+row.ID_USUARIO+',\''+row.NOMBRE+'\')">';
                            button +='<i class="las la-store-alt"></i>';
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
</script>