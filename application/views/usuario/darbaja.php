<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title"><i class="las la-user-times"></i>Dar de Baja</h3>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped dataTable dtr-inline">

                </table>
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

                        button += '<button class="btn btn-success btn-xs" onclick="baja('+row.ID_EMPLEADO+')">';
                        button +='<i class="las la-user-times"></i>';
                        button += '</button>';

                    }

                    else {

                        button += '<button class="btn btn-danger btn-xs" onclick="alta('+row.ID_EMPLEADO+')">';
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
        });
    }

    function alta(id) {
        $.post("<?=site_url('dar-alta')?>", {id: id})
        .done(function (data){
            console.log(data);
             table.ajax.reload();
        });
    }
</script>