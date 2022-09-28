<br>
<div class="card card-outline card-danger">
  <div class="card-header">
    <h3 class="card-title">Default Card Example</h3>
    <div class="card-tools">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span class="badge badge-primary">Label</span>
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
  <div id="responsiveTabsDemo">
    <ul>
      <?php foreach ($sucursales as $sucursal) : ?>
        <li><a href="#tab-<?=$sucursal->ID_UBICACION?>"> <?=$sucursal->DESCRIPCION?> </a></li>
      <?php endforeach; ?>
    </ul>
    
    <?php foreach ($sucursales as $sucursal) : ?>
      <div id="tab-<?=$sucursal->ID_UBICACION?>"> 

        <h2><?=$sucursal->DESCRIPCION?></h2>

      <div id="opciones-<?=$sucursal->ID_UBICACION?>">

          <ul>
              <li><a href="#opcion-1-<?=$sucursal->ID_UBICACION?>"> Dosificacion </a></li>
              <li><a href="#opcion-2-<?=$sucursal->ID_UBICACION?>"> Impresion </a></li>
              <li><a href="#opcion-3-<?=$sucursal->ID_UBICACION?>"> Venta Programada </a></li>
          </ul>

          <?php $columns = $this->db->query("select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='DOSIFICACION_F'")->result() ?>
    
          <div id="opcion-1-<?=$sucursal->ID_UBICACION?>"> 

            <div class="row">
              <div class="col-12">
              <table id="table-<?=$sucursal->ID_UBICACION?>" class="table   table-bordered table-striped dataTable dtr-inline responsive">

                </table>
              </div>
            </div>

            
          </div>
          <div id="opcion-2-<?=$sucursal->ID_UBICACION?>">

              <?php $data['columns'] = $columns ?>
              <?php $data['id'] = $sucursal->ID_UBICACION?>
              <?php echo $this->load->view('configuracion/sucursal/impresion', $data, TRUE);
              ?>

         </div>
          <div id="opcion-3-<?=$sucursal->ID_UBICACION?>"> 
        
          </div>
      </div>

      <script>
          $('#opciones-<?=$sucursal->ID_UBICACION?>').responsiveTabs({
            startCollapsed: 'accordion'
        });
      </script>

        
    
      </div>
    <?php endforeach; ?>

</div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    The footer of the card
  </div>
  <!-- /.card-footer -->
</div>
<!-- /.card -->




<script>
  $('#responsiveTabsDemo').responsiveTabs({
    startCollapsed: 'accordion'
});

var table = $('#table-4').DataTable({
        responsive: true,
        ajax: { url: '<?=site_url('get-dosificacion')?>', dataSrc:"" },
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