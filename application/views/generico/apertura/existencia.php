<br>
<?php  $name_impresora = $this->session->userdata('impresora'); ?>
<?php $fecha_actual = date("Y-m-d"); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Pedidos</h3>
        </div>
        <div class="card-body">
       
        <br>

            <table id="table" class="table table-bordered">

            </table>
        </div>
        </div>
    </div>
</div>

<script>

var table;

	table = $('#table').DataTable({
       // ajax: { url: '<?=site_url('get-ventas-solo-transporte')?>' },
       data: [
            {
                "id" : "1",
                "name" : "Donuts",
                "minimo": 19,
                "stock" : 43,
                "category" : "Breads",
                "special" : true
            },
            {
                "id" : "2",
                "minimo": 22,
                "name" : "Chocolate Cake",
                "stock" : 20,
                "category" : "Cakes", 
                "special" : true
            },
            {
                "id" : "3",
                "minimo": 30,
                "name" : "Baguette",
                "stock" : 34,
                "category" : "Breads", 
                "special" : true
            }
        ],
       responsive: true, scrollX: true,  order: [[2, 'desc']],

       createdRow: function(row, data, index){

        console.log(data.stock+8.3);
                if( data.stock < data.minimo){
                    $('td', row).eq(3).css({'background-color': '#ff5252', 'color':'black', 'font-size':'1.5rem', 'font-weight':'600' })
                }

                if( data.minimo + (data.minimo/2) >= data.stock && data.stock > data.minimo){
                    $('td', row).eq(3).css({'background-color': '#FFAB40', 'color':'black', 'font-size':'1.5rem', 'font-weight':'600'})
                }

                if( data.minimo + (data.minimo/2) <= data.stock){
                    $('td', row).eq(3).css({'background-color': '#69F0AE', 'color':'black', 'font-size':'1.5rem', 'font-weight':'600'})
                }
            },

    "lengthMenu": [ [15, 30, 45, -1], [15, 30, 45, "Todo"] ],
    "pageLength": 15, select: {style: 'single' },

language:{ search: "Buscar", lengthMenu: "Mostrar _MENU_", zeroRecords: "No se encontró nada",
		   info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", infoEmpty: "No hay registros disponibles", 
           infoFiltered: "(Filtrado de _MAX_ registros totales)", previous: "Anterior", oPaginate: { sNext:"Siguiente", sLast: "Último", sPrevious: "Anterior", sFirst:"Primero" },                  
        },      

columns: [

{ title: "Nombre", className: 'text-center', data: "name", width: "10%"},
{ title: "Minimo Stock", className: 'text-center', data: "minimo", width: "8%"},
{ title: "Cantidad", className: 'text-center', data: null, render: function (data, type, full, meta) {

    html = '<div class="input-group mb-3"><input class="form-control" type="number" min="1" value="0" id="row_'+data.id+'"><div class="input-group-append"><span onclick="calcular('+data.id+')" id="row_'+data.id+'" class="input-group-text" id="basic-addon2"><i class="las la-check"></i></span></div></div>';
    
    return html;

} ,width: "8%"},
{ title: "Stock", className: 'text-center', data: "stock", width: "8%"},


]});

function calcular(id) {
    
    var conteo = $('#row_'+id).val();
    
   /* $.post("<?=site_url('set-inventario')?>", {id:id, conteo:conteo })
      .done(function( data ) {
         
         alert('sumaremos');
      });*/

    table.draw();
}


</script>
