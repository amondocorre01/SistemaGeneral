<br>
<br>
<?php 

    $resultado = null;
   
    $fecha =$this->input->get('fecha');
    if($fecha)
    {
            $this->db->where('FECHA2 >=', $fecha.' 00:00:00');
            $this->db->where('FECHA2 <=', $fecha.' 23:59:59');
    }

    else {
        $this->db->where('FECHA2 >=', date('Y-m-d').' 00:00:00');
        $this->db->where('FECHA2 <=', date('Y-m-d').' 23:59:59');
    }

   
    $resultado = json_encode($this->main->getListSelect(PRE_SUC.'VENTAS v', 'ROW_NUMBER() OVER(ORDER BY v.NUMERO_FACTURADO ASC) AS row, v.*'));

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
            <h3 class="card-title">Reimpresion o Anulacion</h3>
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col-offset-3 col-md-3">
                <form action="<?=current_url()?>" method="GET" id="form_fecha">
                    <input name="fecha" type="date" class="form-control" id="fecha">
                    <input  name="vc" type="hidden" id="fecha" value="<?=$this->input->get('vc')?>">
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
       responsive: true,

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
            button += '<div class="btn-group" role="group" aria-label="Basic example">';
                button += '<button class="btn btn-primary btn-danger btn-md" iden="'+data.ID_VENTA_DOCUMENTO+'" onClick="onClickAnularFactura(this)" data-toggle="modal" data-target="#modalAnularFactura" title="Anular Factura">';
                    button +='<i class="las la-times"></i>';
                button += '</button>';
        }
        
        if(ic == true) {
            button += '<button class="btn btn-primary btn-success btn-md" onclick="copia('+data.ID_VENTA_DOCUMENTO+')" title="Imprimir copia">';
                button +='<i class="las la-copy"></i>';
            button += '</button>';
        }

        if(io == true) {
            button += '<button class="btn btn-primary btn-info btn-md" onclick="original('+data.ID_VENTA_DOCUMENTO+')" title="Imprimir original">';
                button +='<i class="las la-check-circle"></i>';
            button += '</button>';
        }

        button += '</div>';

       }

       else {

        button += '<label class="btn btn-info gender-label"><span>Anulado</span></label>';

       }


        return button;
    },
    width: "10%"
},
{ title: "Nº", className: 'text-center', data: "row", width: "5%" },
{ title: "Nº de Factura", className: 'text-center', data: "NUMERO_FACTURADO", width: "5%"},
{ title: "Fecha y Hora", className: 'text-center', data: "FECHA", width: "10%"},
{ title: "Cliente", className: 'text-center', data: "cliente", width: "10%"},
{ title: "NIT", className: 'text-center', data: "NIT", width: "8%"},
{ title: "Importe (Bs.)", className: 'text-center', data: "IMPORTE_TOTAL", width: "8%"},
{ title: "Descuento", className: 'text-center', data: "DESCUENTO", width: "5%"},
{ title: "Total a pagar", className: 'text-center', data: "TOTAL_A_PAGAR", width: "8%"},
{ title: "Detalle", className: 'text-center', data: null,
    render: function (data, type, full, meta) 
    {
       var detalle = JSON.parse(data.DETALLE);

       html = '<table width="100%" >';
       html += '<thead><tr><th class="palette-Red-500 bg" width="80%"><span class="palette-White text" >Producto</span></th><th class="palette-Grey-600 bg" width="20%"><span class="palette-White text">Precio</span></th></tr></thead><tbody>';
       

       $.each(detalle, function (i, v) { 
        html += '<tr><td>'+v.PRODUCTO_UNICO+'</td><td>'+v.PRECIO+'</td></tr>';
       });

       html += '<tbody><table>';
       
       return html;
    },
    width: "25%"
},

]});

    
$('#fecha').on('change', function(){
    $('#form_fecha').submit();
});

    


});

function onClickAnularFactura(element){
    //$('.textarea-msg').val('');
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
            //console.log(respuesta);
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
    if(selectMotivo === ''){
        alert('Error: Seleccione un motivo de anulación');
        return;
    }
    var datos = new FormData();
    datos.append("saveAnulacionFactura",'1');
    datos.append("id_venta_documento",iden);
    datos.append("codigo_motivo",selectMotivo);
    datos.append("suf_suc",'1');
    datos.append("id_menu",'1');
    datos.append("db",'1');

    $.ajax({
        url: "<?=site_url('anular-factura')?>",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            //console.log(respuesta);
            var res = JSON.stringify(respuesta);
            if(respuesta=='anulado'){
                location.reload();
                /*
                insertHtml = '<label class="btn btn-info gender-label"><span>Anulado</span></label>';
                Swal.fire({
                icon: 'success',
                title: 'Se ha anulado correctamente la factura',
                timer: 3500
                });*/
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

    /*
    if(smsText.trim() ==''){
        $(nameRow).addClass('btnDisable');
        $(nameRow).removeClass('btn-info');
        $(nameTextSms).val('');
    }else{
        $(`${nameTextSms}`).val(smsText);
        $(nameRow).addClass('btn-info');
        $(nameRow).removeClass('btnDisable');
    }*/
    
    //smsText=$('.textarea-msg').val('');
}


function copia(id) {
        $.post("<?=site_url('copia-factura')?>", {id: id,  pre_suc:''})
        .done(function( data ) {
            var url= "<?=site_url('imprimir-copia-factura')?>";
            window.open(url,'_blank');
        });
    } 

    function original(id) {
        $.post("<?=site_url('original-factura')?>", {id: id})
        .done(function( data ) {
            var url= "<?=site_url('reimprimir-factura')?>";
            window.open(url,'_blank');

        });
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
</script>
