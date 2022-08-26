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

   
    $resultado = json_encode($this->main->getListSelect('PP_VENTAS v', 'ROW_NUMBER() OVER(ORDER BY v.FECHA DESC) AS row, v.*', ['ID_VENTA_DOCUMENTO'=>'DESC']));

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
            button += '<form action="'+url_anular+'" method="post" id="anular'+data.ID_VENTA_DOCUMENTO+'">';
                button += '<input name="id" type="hidden" value="'+data.ID_VENTA_DOCUMENTO+'"/>';
                button += '<input name="db" type="hidden" value="prueba"/>';
                button += '<input name="suf_suc" type="hidden" value="PP_"/>';
                button += '<input name="id_menu" type="hidden" value="<?=$id_menu?>"/>';
                button += '<button class="btn btn-primary btn-danger btn-md" type="submit" form="anular'+data.ID_VENTA_DOCUMENTO+'" title="Anular Factura">';
                    button +='<i class="las la-times"></i>';
                button += '</button>';
            button += '</form>';
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


function copia(id) {
        $.post("<?=site_url('copia-factura')?>", {id: id,  pre_suc:'PP_'})
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
