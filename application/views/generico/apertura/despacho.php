<br>

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

        
	var table = $('#table').dataTable({
	data: <?php echo $response ?>,
    responsive: true,

    "lengthMenu": [ [15, 30, 45, -1], [15, 30, 45, "Todo"] ],
    "pageLength": 15, select: {style: 'single' },

language:{ search: "Buscar", lengthMenu: "Mostrar _MENU_", zeroRecords: "No se encontró nada",
		   info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", infoEmpty: "No hay registros disponibles", 
           infoFiltered: "(Filtrado de _MAX_ registros totales)", previous: "Anterior", oPaginate: { sNext:"Siguiente", sLast: "Último", sPrevious: "Anterior", sFirst:"Primero" },                  
        },      

columns: [

{ title: "Nº", className: 'text-center', data: "row", width: "5%" },
{ title: "Nº de Factura", className: 'text-center', data: "NUMERO_FACTURADO", width: "5%"},
{ title: "Fecha y Hora", className: 'text-center', data: "FECHA", width: "10%"},
{ title: "Cliente", className: 'text-center', data: "cliente", width: "10%"},
{ title: "NIT", className: 'text-center', data: "NIT", width: "8%"},
{ title: "Importe (Bs.)", className: 'text-center', data: "IMPORTE_TOTAL", width: "8%"},
{ title: "Descuento", className: 'text-center', data: "DESCUENTO", width: "5%"},
{ title: "Total a pagar", className: 'text-center', data: "TOTAL_A_PAGAR", width: "8%"}
]});

});

</script>