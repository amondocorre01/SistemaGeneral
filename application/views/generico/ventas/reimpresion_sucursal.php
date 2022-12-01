<br>
<?php 
    $resultado = null;
    $nombre_codigo_sucursal = $sucursal;
    $DB2 = $this->load->database($nombre_codigo_sucursal, TRUE);
    $datos_sucursal= getSucursal($nombre_codigo_sucursal);
    $prefix = $datos_sucursal->PREFIJO;
    $sufix = $datos_sucursal->SUFIJO;
    $cod_id_sucursal = $datos_sucursal->CODIGO_SUCURSAL;
    //$name_impresora = $datos_sucursal->IMPRESORA;
    $name_impresora = IMPRESORA_LOCAL;
    $descripcion_sucursal = $datos_sucursal->DESCRIPCION;
    $this->session->set_userdata('ubicacion_seleccionada', $datos_sucursal);
   
    $fecha =$this->input->get('fecha');
    if($fecha)
    {
            $DB2->where('FECHA2 >=', $fecha.' 00:00:00');
            $DB2->where('FECHA2 <=', $fecha.' 23:59:59');
    }

    else {
        $fecha='';
        $DB2->where('FECHA2 >=', date('Y-m-d').' 00:00:00');
        $DB2->where('FECHA2 <=', date('Y-m-d').' 23:59:59');
    }

    $DB2->select('ROW_NUMBER() OVER(ORDER BY v.NUMERO_FACTURADO ASC) AS row, v.*');
    //$DB2->select('ROW_NUMBER() OVER(ORDER BY v.NUMERO_VENTA_DIA ASC) AS row, v.*');
    $resultado =  $DB2->get($prefix.'VENTAS v');
    //
    
   
    $resultado = json_encode($resultado->result());

    $id_menu = intval($this->input->get('vc'));
    $id_usuario = $this->session->id_usuario;

    $sql = "SELECT (SELECT vab.ID_VENTAS_BOTON, vab.ESTADO
            FROM VENTAS_ACCESO_BOTON vab, VENTAS_BOTON vb
            WHERE vab.ID_VENTAS_BOTON = vb.ID_VENTAS_BOTON AND 
            ID_USUARIO = ? AND ID_VENTAS_ACCESO = ? FOR JSON AUTO) AS BOTONES";
    $data = $this->db->query($sql, array($id_usuario, $id_menu));

    $botones = $data->result();
    $botones = $botones[0]->BOTONES; 
    $botones = json_decode($botones);
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Reimpresion o Anulacion - <?=$descripcion_sucursal?></h3>
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col-offset-3 col-md-3">
                <form action="<?=current_url()?>" method="GET" id="form_fecha">
                    <input name="fecha" value="<?=$fecha?>" type="date" class="form-control" id="fecha_inicial" onchange="send()">
                    <input  name="vc" type="hidden" id="fecha" value="<?=$this->input->get('vc')?>">
                    <input  name="name_impresora" type="hidden" id="name_impresora" value="<?=$name_impresora?>">
                </form>
            </div>
        </div>
        <br>

            <table id="table" class="table table-bordered">

            </table>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAnularFactura">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Anular Factura</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group">
                    <label>Seleccione el Motivo de Anulacion</label>
                        <div class="input-group">
                            <select  class="form-control input-lg motivoAnulacion" name="motivoAnulacion" required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                <option value="">Seleccionar el motivo</option>
                                <option value="1">FACTURA MAL EMITIDA</option>
                                <option value="2">NOTA DE CREDITO-DEBITO MAL EMITIDA</option>
                                <option value="3">DATOS DE EMISION INCORRECTOS</option>
                                <option value="4">FACTURA O NOTA DE CREDITO-DEBITO DEVUELTA</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary btnSaveAnularFactura"  onclick="guardarAnularFactura(this)">Guardar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>

<script>
   $(document).ready(function(){

    var datos = <?=json_encode($botones)?>;

    let puede_a = datos.find(el => el.ID_VENTAS_BOTON == 1);
    var anular = puede_a['ESTADO'];

    let puede_ic = datos.find(el => el.ID_VENTAS_BOTON == 2);
    var ic = puede_ic['ESTADO'];

    let puede_io = datos.find(el => el.ID_VENTAS_BOTON == 3);
    var io = puede_io['ESTADO'];

	   var table = $('#table').dataTable({
	   data: <?php echo $resultado ?>,
       responsive: true, scrollX: true,  order: [[2, 'desc']],


    "lengthMenu": [ [15, 30, 45, -1], [15, 30, 45, "Todo"] ],
    "pageLength": 15, select: {style: 'single' },

language:{ search: "Buscar", lengthMenu: "Mostrar _MENU_", zeroRecords: "No se encontró nada",
		   info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", infoEmpty: "No hay registros disponibles", 
           infoFiltered: "(Filtrado de _MAX_ registros totales)", previous: "Anterior", oPaginate: { sNext:"Siguiente", sLast: "Último", sPrevious: "Anterior", sFirst:"Primero" },                  
        },      

columns: [

{ title:"Accion", className: 'check-boy', data: null, orderable: false, className: 'text-center',
    render: function (data, type, full, meta) 
    {
      
        var button = '';
       url_anular = "<?=site_url('anular-factura')?>";
       url_copia = "<?=site_url('copia-factura')?>";


       if(data.ANULADO == 0){
        if(anular == true) {

           // var pv2 = data.ID_CUIS;
           // var pv_current='';
           // if(pv==pv2){
            if(data.NUMERO_FACTURADO != '0') {
                button += '<div class="btn-group" role="group" aria-label="Basic example">';
                button += '<button class="btn btn-primary btn-danger btn-md" iden="'+data.ID_VENTA_DOCUMENTO+'" onClick="onClickAnularFactura(this)" data-toggle="modal" data-target="#modalAnularFactura" title="Anular Factura">';
                    button +='<i class="las la-times"></i>';
                button += '</button>';
            }
            //}
        }
        
        if(ic == true) {
            button += '<button class="btn btn-primary btn-success btn-md" onclick="reimprimirFacturaRollo('+data.ID_VENTA_DOCUMENTO+');imprimirFacturaRolloLocal('+data.ID_VENTA_DOCUMENTO+')" title="Imprimir factura rollo">';
                button +='<i class="las la-copy"></i>';
            button += '</button>';
        }
        if(data.NUMERO_FACTURADO != 0) {
            if(io == true) {
                button += '<button class="btn btn-primary btn-info btn-md" onclick="reimprimirFacturaCarta('+data.ID_VENTA_DOCUMENTO+')" title="Imprimir factura carta">';
                    button +='<i class="las la-check-circle"></i>';
                button += '</button>';
            }
        }

        var oculta = btoa(data.DETALLE);

        button += '<button class="btn btn-info btn-md palette-Red-600 bg" onclick="detalle(\''+data.ID_VENTA_DOCUMENTO+'\',\''+oculta+'\')" title="Ver Detalle">';
                button +='<i class="las la-eye"></i>';
            button += '</button>';
            if(data.NUMERO_FACTURADO != 0) {
                button += '<a class="btn btn-info btn-sm btn-enlace-siat" target="_blank" href="'+data.URL_FACTURA+'" title="Ver Factura en el SIAT">';
                    button +='<i class="las la-eye"></i>';
                button += '</a>';
            }

            if(data.MONTO_INGRESADO != null) {
            
                button += '<button class="btn btn-info btn-md palette-Orange-600 bg"  data-precio="'+data.MONTO_INGRESADO+'" data-ubicacion="'+data.UBICACION_TRANSPORTE+'" data-referencia="'+data.REFERENCIA_ENTREGA+'" title="Datos de transporte" data-venta="'+data.ID_VENTA_DOCUMENTO+'" data-cliente="'+data.cliente+'" onclick="datosTransporte($(this))">';
                    button +='<i class="las la-taxi"></i>';
                button += '</button>';
            }

            if(data.VENTA_PROGRAMADA != null) {
            
                datos = JSON.parse(data.VENTA_PROGRAMADA);

                button += '<button class="btn btn-info btn-md palette-Grey-600 bg"  data-fecha="'+datos[0].FECHA_DE_ENVIO+'" data-hora="'+datos[0].HORA_DE_ENVIO+'" data-direccion="'+datos[0].DETALLE_DIRECCION+'" data-dedicatoria="'+datos[0].DEDICATORIA+'" data-cliente="'+data.cliente+'" title="Venta Programada" onclick="datosVentaProgramada($(this))">';
                    button +='<i class="las la-calendar-day"></i>';
                button += '</button>';
            }
        
        button += '</div>';

       }

       else {

        button += '<label class="btn btn-info gender-label"><span>Anulado</span></label>';
        if(data.NUMERO_FACTURADO != 0) {
            button += '<a class="btn btn-info btn-sm btn-enlace-siat-an" target="_blank" href="'+data.URL_FACTURA+'" title="Ver Factura en el SIAT">';
                button +='<i class="las la-eye"></i>';
            button += '</a>';
        }

       }


        return button;
    },
    width: "15%"
},
{ title: "Nº", className: 'text-center', data: "row", width: "5%" },
{ title: "Nº de Factura", className: 'text-center', data: "NUMERO_FACTURADO", width: "5%"},
{ title: "Fecha y Hora", className: 'text-center', data: "FECHA", width: "5%"},
{ title: "Cliente", className: 'text-center', data: "cliente", width: "10%"},
{ title: "NIT", className: 'text-center', data: "NIT", width: "8%"},
{ title: "Total a pagar", className: 'text-center', data: "TOTAL_A_PAGAR", width: "5%"},
{ title: "Detalle", className: 'text-center', data: "NOMBRE_LISTA_PRECIOS", width: "10%"},


]});

});

function send() {
    $('#form_fecha').submit();
}

function onClickAnularFactura(element){
    var iden = $(element).attr("iden");
    $('.btnSaveAnularFactura').attr("iden",iden);
    cargarMotivosAnulacion();
}
function cargarMotivosAnulacion(){
    $(".motivoAnulacion").empty();
    var datos = new FormData();
    datos.append("loadMotivosAnulacion",'1');
    $.ajax({
        url: "<?=site_url('motivos-anulacion')?>",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            var res = JSON.stringify(respuesta);
            if(respuesta){
                for(var i=0; i<respuesta.length;i++){
                    var resp=respuesta[i];
                    var id=resp['CODIGO'];
                    var descripcion=resp['DESCRIPCION'];
                    //ponerEstilo(fecha,name_periodo,periodo,texto);
                    let option="<option value='"+id+"' >"+descripcion+"</option>";
                    $('.motivoAnulacion').prepend(option);
                }
                let option2="<option selected value=''>Seleccione el motivo</option>";
                $('.motivoAnulacion').prepend(option2);
            }
        },
        error: function (error){
            console.log(error.responseText);
        }
        });
}

function guardarAnularFactura(element){
    //$('#modalAnularFactura').modal('toggle');
    var iden = $(element).attr("iden");
    var selectMotivo = $('.motivoAnulacion').val();
    if(selectMotivo == '' || selectMotivo == null){
        alert('Error: Seleccione un motivo de anulación');
        return;
    }
    swal.fire({
        title: "¿Estás seguro?",
        text: "Estás por anular una factura, este no se podrá recuperar más adelante.",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Continuar"
    }).then((result) => {
        if (result.isConfirmed) {
            var datos = new FormData();
            datos.append("saveAnulacionFactura",'1');
            datos.append("id_venta_documento",iden);
            datos.append("codigo_motivo",selectMotivo);
            datos.append("cod_id_sucursal","<?=$cod_id_sucursal?>");
            datos.append("nombre_codigo_sucursal","<?=$nombre_codigo_sucursal?>");
            datos.append("prefijo_sucursal","<?=$prefix?>");
            datos.append("sufijo_sucursal","<?=$sufix?>");

            $.ajax({
                url: "<?=site_url('anular-factura')?>",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success:function(respuesta){
                    if(respuesta == 'anulado'){
                        /*
                        var url= "<?=site_url('imprimir-factura-anulada-carta')?>"+"/"+iden;
                        window.open(url,'_blank');
                        var url= "<?=site_url('imprimir-factura-anulada-rollo')?>"+"/"+iden;
                        window.open(url,'_blank');*/
                        swal.fire({
                            title: "Anulado",
                            text: "Anulaste una factura.",
                        });
                        location.reload();
                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hubo un error , No se ha anulado.',
                            timer: 3500
                        });
                    }
                },
                error: function (error){
                    console.log(error.responseText);
                }
            });
            //Swal.fire('Saved!', '', 'success')
        }
    });

   }


    function reimprimirFacturaRollo(id) {
        var url= "<?=site_url('reimprimir-factura-rollo')?>"+"/"+id;
        window.open(url,'_blank');
    }
    
    function imprimirFacturaRolloLocal(id){
        var datos = new FormData();
        datos.append("obtenerFactura",'1');
        datos.append("id_venta_documento",id);
        datos.append("nombre_codigo_sucursal","<?=$nombre_codigo_sucursal?>");
        datos.append("prefijo_sucursal","<?=$prefix?>");
        datos.append("sufijo_sucursal","<?=$sufix?>");

        $.ajax({
            url: "<?=site_url('obtener-objeto-factura')?>"+"/"+id,
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                if(respuesta){
                    res= JSON.parse(respuesta);
                    imprimirFactura(res);
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error.',
                        timer: 3500
                    });
                }
            },
            error: function (error){
                console.log(error.responseText);
            }
        });
    }

    async function imprimirFactura(datos){
        //console.log(datos);
        var impresora = $('#name_impresora').val();
        datos.impresora_local= impresora;
        //console.log(datos);
        datos = JSON.stringify(datos);
        
        await setTimeout(async() =>{ 
            const rawResponse = await fetch('https://capresso.local/printFacturaComanda', {
            method: 'POST',
            body: datos
        }); 
        }, 1000);
    }

    function reimprimirFacturaCarta(id) {
        var url= "<?=site_url('reimprimir-factura-carta')?>"+"/"+id;
        window.open(url,'_blank');
    } 

    var anulado = '<?=$this->session->flashdata('anulado');?>';
    if(anulado == 'SI')
            {
                Swal.fire({
                    icon: 'success',
                    title: 'Se ha anulado la factura correctamente',
                    timer: 3500
                });
            }
			
	function detalle(id,content) {

        content = atob(content);
        var detalle = JSON.parse(content);

        html = '<table class="table table-head-fixed text-nowrap">';
        html += '<thead><tr><th class="palette-Red-500 bg" width="55%"><span class="palette-White text">Producto</span></th><th class="palette-Grey-600 bg" width="15%"><span class="palette-White text">Cantidad</span></th><th class="palette-Grey-600 bg" width="15%"><span class="palette-White text">P. Unit.</span></th><th class="palette-Grey-600 bg" width="15%"><span class="palette-White text">Precio</span></th></tr></thead><tbody>';


        $.each(detalle, function (i, v) { 
        html += '<tr><td>'+v.PRODUCTO_UNICO+'</td><td>'+v.CANTIDAD+'</td><td>'+v.UNITARIO+'</td><td>'+v.PRECIO+'</td></tr>';
        });

        html += '<tbody><table> <button onclick="imprimirComanda('+id+');" >Imprimir</button>';


        $('#detallecompra').empty();
        $('#detallecompra').append(html);
        $('#detalle').modal('show');


    }

    function imprimirComanda(id){
        var url= "<?=site_url('imprimir-comanda')?>"+"/"+id;
        window.open(url,'_blank');
    }

    function datosTransporte(v) {
        
       var precio = v.data('precio');
       var ubicacion = encodeURIComponent(v.data('ubicacion'));
       var referencia = v.data('referencia');
       var cliente = v.data('cliente');
       var venta = v.data('venta');


       $('#solicitado').attr('max', precio);
       $('#referencia').val(referencia);
       $('#telefonoChofer').attr('data-url', ubicacion);
       $('#telefonoChofer').attr('data-cliente', cliente);
       $('#telefonoChofer').attr('data-venta', venta);



       $('#transporte').modal('show');
    }

    function datosVentaProgramada(v) {
        
        var fecha = v.data('fecha'); 
        var hora = v.data('hora'); 
        var direccion = v.data('direccion');
        var dedicatoria = v.data('dedicatoria'); 

        $('#pfecha').val(fecha);
        $('#phora').val(hora);
        $('#pdireccion').val(direccion);
        $('#pdedicatoria').val(dedicatoria);

        $('#ventaProgramada').modal('show');
    }


    function checkPrecio() {
        var precio = Number($('#solicitado').val());
        var max = $('#solicitado').attr('max');

        if(precio > max) {

            Swal.fire({
                    icon: 'error',
                    title: 'El precio a cobrar es mayor que el precio referencial',
                    timer: 3500
                });
        
        }
    }


</script>
<div class="modal fade" id="detalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header col-11 text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Detalle de la compra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body" id="detallecompra">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="transporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header col-12 text-center">
                <h5 class="modal-title" id="exampleModalLabel">Informacion de envio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detalleTransporte">
                <div class="row">
                    <div class="form-group col-12">
                        <?=form_label("Monto solicitado"); ?>
                        <div class="form-group">
                            <?=form_input(['type'=>'number', 'class'=>'form-control', 'id'=>'solicitado', 'step'=>'1', 'min'=>'0', 'max'=>'0', 'oninput'=>'checkPrecio()']);?>
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <?=form_label("referencia"); ?>
                        <div class="form-group">
                            <?=form_input(['type'=>'text', 'class'=>'form-control', 'id'=>'referencia', 'readonly'=>'readonly']);?>
                        </div>
                    </div>

                    <?=form_input(['type'=>'hidden', 'id'=>'urlmaps']);?>

                    <div class="form-group col-12">
                        <?=form_label("Telefono del chofer"); ?>
                        <div class="input-group">
                        <input type="text" name="telefonoChofer" id="telefonoChofer" oninput="urlWhats()" class="form-control rounded-0" data-url="">
                            <span class="input-group-append">
                                <button class="btn btn-danger" onclick="btnImprimirDatosEnvio('<?=$name_impresora?>');" type="button"><i class="las la-print la-2x"></i></button>
                                <a href="" target="_blank" id="whatsapp" class="btn btn-success" type="button"><i class="lab la-whatsapp la-2x"></i></a>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <?=form_button(['id'=>'enviarTransporte', 'onclick'=>'saveEgreso()','content'=>'<i class="las la-save la-1x palette-White text"></i>'.'<span class="palette-White text">Registrar</span>', 'class'=>'btn palette-Red-A400 bg expanded']);?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ventaProgramada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header col-12 text-center">
                <h5 class="modal-title" id="exampleModalLabel">Venta Programada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detalleVentaProgramada">

                <div class="row">
                    <div class="form-group col-12">
                        <?=form_label("Fecha de envio"); ?>
                        <div class="form-group">
                            <?=form_input(['type'=>'date', 'class'=>'form-control', 'id'=>'pfecha', 'readonly'=>'readonly']);?>
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <?=form_label("Hora de entrega"); ?>
                        <div class="form-group">
                            <?=form_input(['type'=>'time', 'class'=>'form-control', 'id'=>'phora', 'readonly'=>'readonly']);?>
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <?=form_label("Detalle direccion"); ?>
                        <div class="form-group">
                            <?=form_input(['type'=>'text', 'class'=>'form-control', 'id'=>'pdireccion', 'readonly'=>'readonly']);?>
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <?=form_label("Dedicatoria"); ?>
                        <div class="form-group">
                            <?=form_input(['type'=>'text', 'class'=>'form-control', 'id'=>'pdedicatoria', 'readonly'=>'readonly']);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function saveEgreso() {
        $('#transporte').modal('hide');

        var precio = $('#solicitado').val();
        var telefono = $('#telefono').val();
        var venta = $('#telefonoChofer').data('venta');

        $.post('<?=site_url('save-egreso-transpote')?>', {precio:precio, telefono:telefono,  venta:venta})

        .done(function (data) {
            
            console.log(data);
        
        });
    }

    function urlWhats() {

        var telefono = $('#telefonoChofer').val();
        var ubicacion = $('#telefonoChofer').data('url');
        var referencia =$('#referencia').val();
        var cliente = $('#telefonoChofer').data('cliente');

        var texto = 'https://api.whatsapp.com/send?phone=591'+telefono+'&text='+'Nombre:'+cliente+'Ref: '+referencia+' en la ubicacion:'+ ubicacion;
        
        $('#whatsapp').attr('href', texto);


    }

    async function btnImprimirDatosEnvio(name_impresora){
        var nombre_ref = $('#telefonoChofer').data('cliente');
        var referencia_envio = $('#referencia').val();
        var datos = {};
        datos.impresora_local = name_impresora;
        datos.nombre_ref = nombre_ref;
        datos.referencia_envio = referencia_envio;
        datos = JSON.stringify(datos);
        await setTimeout(async() =>{ 
            const rawResponse = await fetch('https://capresso.local/printBoletaEnvio', {
            method: 'POST',
            body: datos
        });
        }, 1000);
    }

</script>

