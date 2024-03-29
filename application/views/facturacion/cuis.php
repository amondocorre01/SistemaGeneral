<br>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title"><i class="las la-key"></i>CUIS</h3>
            </div>
            <div class="card-body table-responsive">

            <button class="btn btn-xs edit palette-Green-600 bg" data-toggle="modal" data-target="#nuevo">
                <i class="las la-key la-1x"></i> Nuevo CUIS
            </button>
            <br> <br>

                <table id="table" class="table table-striped table-hover dt-responsive display table-bordered dataTable dtr-inline">

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
        <h6 class="modal-title" id="nombre3">Nuevo CUIS</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?=form_label("Codigo de ambiente", 'ambiente');?>
                    <?=form_input('ambiente', null, ['class'=>'form-control', 'id'=>'ambiente', 'required'=>'required', 'placeholder'=>'2']);?>
                    <div class="valid-feedback"></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?=form_label("Punto de Venta", 'venta');?>
                    <?=form_input('venta', null, ['class'=>'form-control', 'id'=>'venta', 'placeholder'=>'1' ,'required'=>'required']);?>
                    <div class="valid-feedback"></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?=form_label("Codigo de Sistema", 'sistema');?>
                    <?=form_input('sistema', null, ['class'=>'form-control', 'id'=>'sistema', 'placeholder'=>'7228C6496C77C09EE700B6F' ,'required'=>'required']);?>
                    <div class="valid-feedback"></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?=form_label("NIT", 'nit');?>
                    <?=form_input('nit', null, ['class'=>'form-control', 'id'=>'nit', 'placeholder'=>'4394186018' ,'required'=>'required']);?>
                    <div class="valid-feedback"></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?=form_label("Sucursal", 'sucursal');?>
                    <?=form_dropdown('sucursal', $sucursales, null,[ 'id'=>'sucursal', 'required'=>'required', 'class'=>'form-control']);?>
                    <div class="valid-feedback"></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?=form_label("Codigo de Modalidad", 'modalidad');?>
                    <?=form_input('modalidad', null, ['class'=>'form-control', 'placeholder'=>'1' ,'id'=>'modalidad', 'required'=>'required']);?>
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

function loader() {

        Swal.fire({
    imageUrl: '<?=base_url('assets/dist/img/1amw.gif')?>',
    imageHeight: 500,
    imageAlt: 'A tall image',
    showConfirmButton: false
    })
}


    $('#sucursal').select2({
        placeholder: "Seleccione una sucursal"
    });
    
    var table = $('#table').DataTable({
        responsive: true,
        ajax: { url: '<?=site_url('get-cuis')?>' },
        language:{ search: "Buscar", lengthMenu: "Mostrar _MENU_", previous: "Anterior",
        zeroRecords: "Sin resultados", infoEmpty: "No hay registros disponibles",
        info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        infoFiltered: "(Filtrado de _MAX_ registros totales)",
        oPaginate: {sNext:"Siguiente", sLast: "Último", sPrevious: "Anterior", sFirst:"Primero" },
        },
        columns: [
            { title: 'N°', width:'8%',data: 'row' },
            { title: 'Cod. Amb.', width:'8%' ,data: 'CODIGO_AMBIENTE' },
            { title: 'Codigo Sistema', width:'8%' ,data: 'CODIGO_SISTEMA' },
            { title: 'NIT', width:'8%' ,data: 'NIT' },
            { title: 'Cod. Mod.', width:'8%' ,data: 'CODIGO_MODALIDAD' },
            { title: 'Cod. Suc.', width:'8%' ,data: 'CODIGO_SUCURSAL' },
            { title: 'Cod. PV.', width:'8%' ,data: 'CODIGO_PUNTO_VENTA' },
            { title: 'Cod. Cuis', width:'8%' ,data: 'CODIGO_CUIS' },
            { title: 'Fec. Vig.', width:'8%' ,data: 'FECHA_VIGENCIA' },
            { title: 'Cod.', width:'15%' ,data: 'CODIGO' },
            { title: 'Descrip.', width:'20%' ,data: 'DESCRIPCION' },
            { title: 'Trans.', width:'10%' ,data: 'TRANSACCION' },
            
            
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


    function verCUIS(id) {

        $.post("<?=site_url('ver-cuis')?>", {id:id})
        .done(function(data){
                dato = JSON.parse(data);
             var res = dato.response.CODIGO_CUIS;

             $('textarea#key').val(res);
             $('#editar').modal('show');
        });
    }

    function activarKey(id) {

        $.post("<?=site_url('activar-cuis')?>", {id:id})
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

        $.post("<?=site_url('inactivar-cuis')?>" ,{id:id}, loader())
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
        })
        .complete(function(){
            swal.close()
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

       
        var ambiente =   $('input[name="ambiente"]').val();
        var venta =   $('input[name="venta"]').val();
        var sistema =   $('input[name="sistema"]').val();
        var nit =   $('input[name="nit"]').val();
        var sucursal =   $('select[name="sucursal"]').val();
        var modalidad =   $('input[name="modalidad"]').val();
        

        if(ambiente != '' && venta != '' && sistema != '' && nit != '' && sucursal != '' && modalidad != '' ) {
            
            var datos = new FormData();
            datos.append("ambiente", ambiente);
            datos.append("venta", venta);
            datos.append("sistema", sistema);
            datos.append("nit", nit);
            datos.append("sucursal", sucursal);
            datos.append("modalidad", modalidad);

            $.ajax({
                beforeSend: loader(),
                url: "<?=site_url('nuevo-cuis')?>",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "html",
                success:function(respuesta){
                    swal.close()
                    var res = JSON.stringify(respuesta);
                    if(respuesta){
                        //$('#nuevo').modal('hide'); 
                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hubo un error , No se ha registrado.',
                            timer: 3500
                        });
                    }
                }
            });
        }else{
            Swal.fire({
                    icon: 'error',
                    title: 'Todos los campos son requeridos',
                    timer: 4500
                });
        }
    });
</script>