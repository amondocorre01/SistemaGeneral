<div id="tab-<?=$id?>"> 

        <h2><?=$nombre_sucursal?></h2>

      <div id="opciones-pando">

          <ul>
              <li><a href="#opcion-1-pando<?=$id?>"> Dosificacion </a></li>
              <li><a href="#opcion-2-pando<?=$id?>"> Impresion </a></li>
              <li><a href="#opcion-3-pando<?=$id?>"> Venta Programada </a></li>
          </ul>
    
          <div id="opcion-1-pando<?=$id?>"> 

          <div class="row">
            <div class="col-4">
                <?=form_button(['onclick'=>'new_pando()', 'content'=>'<i class="las la-plus-circle la-1x palette-White text"></i>'.'<span class="palette-White text">Nuevo</span>', 'class'=>'btn btn-md btn-danger']);?>
            </div>
        </div>

            <div class="row">
              <div class="col-12">
              
              <table id="table-pando" class="table table-bordered table-striped dataTable dtr-inline responsive">

              </table>
              </div>
            </div>
          </div>
          <div id="opcion-2-pando<?=$id?>">

              
         </div>
          <div id="opcion-3-pando<?=$id?>"> 
        
          </div>
      </div>
</div>

<div class="modal fade" id="nuevo_pando" tabindex="-1" role="dialog" aria-labelledby="nombre3" aria-hidden="true">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Nueva Dosificacion</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <?php $data['columns'] = $columns ?>
      <?php $data['id'] = $id?>
      <?php echo $this->load->view('configuraciones/pando/nueva', $data, TRUE);?>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="confirmar_register_pando(<?=$id?>)">Confirmar</button>
      </div>
    </div>
  </div>
</div>

      <script>

        function new_pando(){

            $('#nuevo_pando').modal('show');

        }

        function confirmar_register_pando(id) {
        var correo         =   $('#CORREO_SUCURSAL'+id).val();
        var nit            =   $('#NIT'+id).val();
        var razon          =   $('#RAZON_SOCIAL'+id).val();
        var autorizacion   =   $('#N_AUTORIZACION'+id).val();
        var actividad      =   $('#ACTIVIDAD_ECONOMICA'+id).val();
        var sistema        =   $('#SISTEMA_FACTURACION'+id).val();
        var dias           =   $('#DIAS'+id).val();
        var fecha          =   $('#FECHA_LIMITE'+id).val();
        var leyenda        =   $('#LEYENDA'+id).val();
        var llave          =   $('#LLAVE_DOSIFICACION'+id).val();
        var estado         =   $('#ESTADO'+id).val();
        var matriz         =   $('#CASA_MATRIZ'+id).val();
        var sucursal       =   $('#N_SUCURSAL'+id).val();
        var direccion      =   $('#DIRECCION_SUCURSAL'+id).val();
        var telefono       =   $('#TELEFONO'+id).val();
        var departamento   =   $('#DEPARTAMENTO_Y_PAIS'+id).val();


        datos = {correo:correo, nit:nit, razon:razon, autorizacion:autorizacion, actividad:actividad, sistema:sistema, dias:dias, fecha:fecha, leyenda:leyenda, llave:llave, estado:estado, matriz:matriz, sucursal:sucursal, direccion:direccion, telefono:telefono, departamento:departamento};

        url = '<?=site_url('nueva-pando')?>'

        $.post(url, datos)
        .done(function(data) {
            $('#nuevo_pando').modal('hide');
            table_pando.ajax.reload();
        });
   }

          $('#opciones-pando').responsiveTabs({
            startCollapsed: 'accordion'
        });

        var table_pando = $('#table-pando').DataTable({
        responsive: true,
        ajax: { url: '<?=site_url('get-pando')?>', dataSrc:"" },
        language:{ search: "Buscar", lengthMenu: "Mostrar _MENU_", previous: "Anterior",
        zeroRecords: "Sin resultados", infoEmpty: "No hay registros disponibles",
        info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        infoFiltered: "(Filtrado de _MAX_ registros totales)",
        oPaginate: {sNext:"Siguiente", sLast: "Último", sPrevious: "Anterior", sFirst:"Primero" },
        },
        columns: [
            <?php foreach ($columns as $column) : ?>
              { title: '<?=$column->COLUMN_NAME?>', data:'<?=$column->COLUMN_NAME?>' },
            <?php endforeach;?>
           
            { title: 'Estado', width:'10%' ,data: null, 
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

                        button += '<button class="btn btn-xs edit palette-Blue-400 bg" data-toggle="modal" data-target="#eye" onclick="verCUIS('+row.ID_VENTAS_F01_CUIS+')">';
                        button +='<i class="las la-eye la-1x"></i>';
                        button += '</button>';

                    if(!row.ESTADO) {

                        button += '<button class="btn btn-xs palette-Green-400 bg" onclick="activarKey('+row.ID_VENTAS_F01_CUIS+')">';
                        button +='<i class="las la-toggle-on la-1x"></i>';
                        button += '</button>';

                    }

                    else {
                        button += '<button class="btn btn-xs palette-Red-400 bg" onclick="inactivarKey('+row.ID_VENTAS_F01_CUIS+')">';
                        button +='<i class="las la-toggle-off la-1x"></i>';
                        button += '</button>';
                    }

                    return button;
                }
            }
        ],
    });
      </script>
