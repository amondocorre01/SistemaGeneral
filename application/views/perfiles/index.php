<br>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title"><i class="las la-user-cog"></i>PERFILES</h3>
            </div>
            <div class="card-body">

            <button class="btn btn-xs edit palette-Green-600 bg" data-toggle="modal" data-target="#nuevo">
                <i class="las la-user-plus la-1x"></i> Nuevo Perfil
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
        <h6 class="modal-title" id="nombre2">Editar Perfil</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">

        <?=form_hidden('id_perfil', 0); ?>

        <div class="col-md-12">
            <div class="form-group">
                <?=form_label("Perfil", 'perfil');?>
                <?=form_input('perfil', null, ['class'=>'form-control', 'id'=>'perfil', 'required'=>'required']);?>
                <div class="valid-feedback"></div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group" >
                <?=form_label("Estado", 'estado');?>
                <?=form_dropdown('estado', ['1'=>'HABILITADO', '0'=>'INHABILITADO'], null ,['id'=>'estado']);?>
            </div>
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


<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="nombre3" aria-hidden="true">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nombre3">Nuevo Perfil</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?=form_label("Perfil", 'nombre_perfil');?>
                    <?=form_input('nombre_perfil', null, ['class'=>'form-control', 'id'=>'nombre_perfil', 'required'=>'required']);?>
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

    $('#estado').select2({
        placeholder: "Seleccione una opcion"
    });
    
    var table = $('#table').DataTable({
        ajax: { url: '<?=site_url('get-perfiles')?>' },
        language:{ search: "Buscar", lengthMenu: "Mostrar _MENU_", previous: "Anterior",
        zeroRecords: "Sin resultados", infoEmpty: "No hay registros disponibles",
        info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        infoFiltered: "(Filtrado de _MAX_ registros totales)",
        oPaginate: {sNext:"Siguiente", sLast: "Último", sPrevious: "Anterior", sFirst:"Primero" },
        },
        columns: [
            { title: 'N°', width:'10%',data: 'row' },
            { title: 'Nombre de Perfil', width:'30%' ,data: 'PERFIL' },
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

                        button += '<button class="btn btn-xs edit palette-Amber-800 bg" data-toggle="modal" data-target="#editar" onclick="editPerfil('+row.ID_VENTAS_PERFIL+',\''+row.PERFIL+'\','+row.ESTADO+')">';
                        button +='<i class="las la-edit la-1x"></i>';
                        button += '</button>';

                        return button;
                }
            }
        ],
    });


    function editPerfil(id, nombre, estado) {

            $('input[name="perfil"]').val(nombre);
            $('select[name="estado"]').val(estado);
            $('input[name="id_perfil"]').val(id);
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

       
        var nombre =   $('input[name="nombre_perfil"]').val();

        $('#nuevo').modal('hide');

        if(nombre != '') {

            $.post("<?=site_url('nuevo-perfil')?>", {nombre:nombre})
            .done(function( data ) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Se ha creado nuevo perfil',
                    timer: 4500
                });

                table.ajax.reload();
            });
        }
    });
</script>