<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title"><i class="las la-user-cog"></i>ELIMINAR USUARIO</h3>
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
        ajax: { url: '<?=site_url('get-usuarios-baja')?>' },
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
                    

                        button += '<button class="btn palette-Red-500 bg btn-xs" onclick="deleteUser('+row.ID_EMPLEADO+')">';
                        button +='<i class="las la-trash la-2x"></i>';
                        button += '</button>';

                
                    return button;

                }
            }
        ],
    });


    function deleteUser(id) {
        $.post("<?=site_url('eliminar-usuario')?>", {id: id})
        .done(function (data){
           
            table.ajax.reload();

            Swal.fire({
                icon: 'success',
                title: 'Se ha eliminado a un usuario',
                timer: 4500
            });
        });
    }

</script>