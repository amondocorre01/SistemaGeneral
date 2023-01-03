<br>
<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title"><i class="las la-key"></i>Eventos Justificativos</h3>
            </div>
            <div class="card-body">

            <button class="btn btn-xs edit palette-Green-600 bg" data-toggle="modal" data-target="#nuevo">
                <i class="las la-calendar-day la-1x"></i> Nuevo Evento Justificativo
            </button>
            <br> <br>

                <table id="table" class="table table-bordered table-striped dataTable dtr-inline">

                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="nombre3" aria-hidden="true">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="nombre3">Nuevo Evento significativo</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">

            <div class="col-md-12">
                <div class="form-group">
                    <?=form_label("API Key", 'evento');?>
                    <select name="evento" id="evento" class="form-control">
                            <?php foreach ($eventos as $value) :?>
                              <option value="<?=$value->ID_VENTAS_F01_CUIS.'-'.$value->CODIGO?>"><?=$value->DESCRIPCION?></option>
                            <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <?=form_label("Fecha Inicio", 'activacion');?>
                    <?=form_input(['name'=>'activacion', 'type'=>'date', 'class'=>'form-control', 'id'=>'activacion', 'required'=>'required']);?>
                    <div class="valid-feedback"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <?=form_label("Hora Inicio", 'h_activacion');?>
                    <?=form_input(['name'=>'h_activacion', 'type'=>'time', 'class'=>'form-control', 'id'=>'h_activacion', 'required'=>'required']);?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <?=form_label("Fecha Vencimiento", 'vencimiento');?>
                    <?=form_input(['name'=>'vencimiento', 'type'=>'date', 'class'=>'form-control', 'id'=>'vencimiento', 'required'=>'required']);?>
                    <div class="valid-feedback"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <?=form_label("Hora Fin", 'h_vencimiento');?>
                    <?=form_input(['name'=>'h_vencimiento', 'type'=>'time', 'class'=>'form-control', 'id'=>'h_vencimiento', 'required'=>'required']);?>
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
        ajax: { url: '<?=site_url('get-eventos')?>' },
        language:{ search: "Buscar", lengthMenu: "Mostrar _MENU_", previous: "Anterior",
        zeroRecords: "Sin resultados", infoEmpty: "No hay registros disponibles",
        info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        infoFiltered: "(Filtrado de _MAX_ registros totales)",
        oPaginate: {sNext:"Siguiente", sLast: "Último", sPrevious: "Anterior", sFirst:"Primero" },
        },
        columns: [
            { title: 'N°', width:'8%',data: 'row' },
            { title: 'Codigo', width:'40%' ,data: 'CODIGO' },
            { title: 'Descripcion', width:'15%' ,data: 'DESCRIPCION' },
            { title: 'Fecha Inicio', width:'15%' ,data: 'INICIO_EVENTO' },
            { title: 'Fecha Fin', width:'15%' ,data: 'FIN_EVENTO' },
        ],
    });

    $('#confirmar_nuevo').on('click', function(){

        var codigo = $('#evento').val();
        var descripcion = $('#evento option:selected').text();;
       

        var activacion =   $('input[name="activacion"]').val();
        var vencimiento =   $('input[name="vencimiento"]').val();

        var h_activacion =   $('#h_activacion').val();
        var h_vencimiento =   $('#h_vencimiento').val();

        $('#nuevo').modal('hide');

        if(codigo != '' && descripcion != '' && vencimiento != '' && activacion != '' && h_activacion != '' && h_vencimiento != '' ) {

            $.post("<?=site_url('nuevo-evento')?>", {codigo:codigo, descripcion:descripcion, activacion:activacion, vencimiento:vencimiento, h_activacion:h_activacion, h_vencimiento:h_vencimiento
            })
            .done(function( data ) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Se ha registrado un nuevo evento significativo',
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
</script>