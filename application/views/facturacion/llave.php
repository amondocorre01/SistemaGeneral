<br>
<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title"><i class="las la-key"></i>API KEY's</h3>
            </div>
            <div class="card-body">

            <button class="btn btn-xs edit palette-Green-600 bg" data-toggle="modal" data-target="#nuevo">
                <i class="las la-key la-1x"></i> Nueva API Key
            </button>
            <br> <br>

                <table id="table" class="table table-bordered table-striped dataTable dtr-inline">

                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="nombre2" aria-hidden="true">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nombre2">Ver API Key</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?=form_label("Token Api", 'key');?>
                <?=form_textarea('key', null, ['class'=>'form-control palette-Yellow-100 bg', 'id'=>'key', 'required'=>'required', 'readonly'=>'readonly', 'style'=>'resize:none']);?>
                <div class="valid-feedback"></div>
            </div>
        </div>
      </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="nombre3" aria-hidden="true">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nombre3">Nueva API Key</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">

            <div class="col-md-12">
                <div class="form-group">
                    <?=form_label("API Key", 'apikey');?>
                    <?=form_input('apikey', null, ['class'=>'form-control', 'placeholder'=>'TokenApi' ,'id'=>'apikey', 'required'=>'required']);?>
                    <div class="valid-feedback"></div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <?=form_label("Token API", 'llave');?>
                    <?=form_textarea('llave', null, ['class'=>'form-control', 'id'=>'llave', 'required'=>'required']);?>
                    <div class="valid-feedback"></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?=form_label("Fecha Activacion", 'activacion');?>
                    <?=form_input(['name'=>'activacion', 'type'=>'date', 'class'=>'form-control', 'id'=>'activacion', 'required'=>'required']);?>
                    <div class="valid-feedback"></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?=form_label("Fecha Vencimiento", 'vencimiento');?>
                    <?=form_input(['name'=>'vencimiento', 'type'=>'date', 'class'=>'form-control', 'id'=>'vencimiento', 'required'=>'required']);?>
                    <div class="valid-feedback"></div>
                </div>
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

<script>

    
    
    var table = $('#table').DataTable({
        responsive: true,
        ajax: { url: '<?=site_url('get-llaves')?>' },
        language:{ search: "Buscar", lengthMenu: "Mostrar _MENU_", previous: "Anterior",
        zeroRecords: "Sin resultados", infoEmpty: "No hay registros disponibles",
        info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        infoFiltered: "(Filtrado de _MAX_ registros totales)",
        oPaginate: {sNext:"Siguiente", sLast: "Último", sPrevious: "Anterior", sFirst:"Primero" },
        },
        columns: [
            { title: 'N°', width:'8%',data: 'row' },
            { title: 'Token API', width:'40%' ,data: 'TOKEN_API' },
            { title: 'Fecha Activacion', width:'15%' ,data: 'FECHA_ACTIVACION' },
            { title: 'Fecha Vencimiento', width:'15%' ,data: 'FECHA_VENCIMIENTO' },
            { title: 'Estado', width:'15%' ,data: null, 
                render: function (data, type, full, meta) { 

                    var body = '';

                    if(data.ESTADO == 1)
                    {
                        body = '<label class="palette-Green-600 bg"><span class="palette-White text">HABILITADO</span></label>';
                    }

                    else 
                    {       
                        body = '<label class="palette-Red-600 bg"><span class="palette-White text">INABILITADO</span></label>';   
                    }   
                    
                   return body;
                }
            },
            { title: 'Opciones', width:'15%', data: null, 
                render: function (row, type, set) { 

                    var button = '' 

                        button += '<button class="verKey btn btn-xs edit palette-Blue-400 bg" data-toggle="modal" data-target="#eye" onclick="verKey('+row.ID_VENTAS_LLAVE+')">';
                        button +='<i class="las la-eye la-1x"></i>';
                        button += '</button>';

                    if(!row.ESTADO) {

                        button += '<button class="btn btn-xs palette-Green-400 bg" onclick="activarKey('+row.ID_VENTAS_LLAVE+')">';
                        button +='<i class="las la-toggle-on la-1x"></i>';
                        button += '</button>';

                    }

                    else {
                        button += '<button class="btn btn-xs palette-Red-400 bg" onclick="inactivarKey('+row.ID_VENTAS_LLAVE+')">';
                        button +='<i class="las la-toggle-off la-1x"></i>';
                        button += '</button>';
                    }

                    return button;
                }
            }
        ],
    });


    function verKey(id) {

        $.post("<?=site_url('get-key')?>", {id:id})
        .done(function(data){
                dato = JSON.parse(data);
             var res = dato.response.TOKEN_API;

             $('textarea#key').val(res);
             $('#editar').modal('show');
        });
    }

    function activarKey(id) {

        $.post("<?=site_url('activar-key')?>", {id:id})
        .done(function(data){
                dato = JSON.parse(data);
               var mensaje = dato.message;
               var status = dato.status;
               var icon = dato.icon;

               table.ajax.reload();

               Swal.fire({
                        icon: icon,
                        title: mensaje,
                        timer: 4500
                    });
        });
    }

    function inactivarKey(id) {

        $.post("<?=site_url('inactivar-key')?>", {id:id})
        .done(function(data){
                dato = JSON.parse(data);
            var mensaje = dato.message;
            var status = dato.status;
            var icon = dato.icon;

            table.ajax.reload();

            Swal.fire({
                icon: icon,
                title: mensaje,
                timer: 4500
            });
        });
    }

    $('#confirmar').on('click', function(){

        var id =  $('input[name="id_perfil"]').val();
        var nombre =   $('input[name="perfil"]').val();
        var estado = $('select[name="estado"]').val();

        $('#editar').modal('hide');

        if( id > 0 && nombre != '') {

            $.post("<?=site_url('set-perfil')?>", {id:id, nombre:nombre, estado:estado})
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

    $('#confirmar_nuevo').on('click', function(){

       
        var apikey =   $('input[name="apikey"]').val();
        var llave =   $('textarea[name="llave"]').val();
        var activacion =   $('input[name="activacion"]').val();
        var vencimiento =   $('input[name="vencimiento"]').val();


        $('#nuevo').modal('hide');

        if(apikey != '' && llave != '' && vencimiento != '' && activacion != '' ) {

            $.post("<?=site_url('nueva-llave')?>", {apikey:apikey, llave:llave, activacion:activacion, vencimiento:vencimiento})
            .done(function( data ) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Se ha registrado nueva API Key',
                    timer: 4500
                });

                table.ajax.reload();
            });
        }

        else 
        {
              
            Swal.fire({
                    icon: 'error',
                    title: 'Todos los campos son obligatorios',
                    timer: 4500
                });
        }
    });

    tippy('.verKey', {content: 'Ver Token API' });
</script>