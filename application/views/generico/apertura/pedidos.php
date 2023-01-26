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
       
        <div class="row">
            <div class="col-offset-1 col-md-3">
                <label for="">Fecha Inicial</label>
                <input class="form-control" type="date" value="<?=date('Y-m-d')?>" id="filtro1" name="filtro1" onchange="filtrar()">
            </div>
                

            <div class="col-md-3">
                <label for="">Fecha Final</label>
                <input class="form-control" type="date" value="<?=date('Y-m-d')?>" id="filtro2" name="filtro2" onchange="filtrar()">
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

var inicio, final, table;

inicio = $('#filtro1');
final = $('#filtro2');

 
// Custom filtering function which will search data in column four between two values
/*$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var f1_fecha = inicio.val();
        var f2_fecha = final.val(); 
        var c_fecha = Date.parse(data[2]) / 1000;
        var a_fecha = Date.parse('<?=date('Y-m-d')?>') / 1000;

        if(f1_fecha == '' && f2_fecha == '') {

            if(c_fecha >= a_fecha){
                return true;
            }
        }

        else if(f1_fecha != '' && f2_fecha == '') {

            var f1_fecha = Date.parse(f1_fecha) / 1000;

            if(c_fecha >= f1_fecha){
                return true;
            }
        }

        else if(f1_fecha == '' && f2_fecha != '') {

            var f2_fecha = Date.parse(f2_fecha) / 1000;

            if(c_fecha <= f2_fecha){
                return true;
            }
        }


        else if(f1_fecha != '' && f2_fecha != '') {

            var f1_fecha = Date.parse(f1_fecha) / 1000;
            var f2_fecha = Date.parse(f2_fecha) / 1000;

            if(c_fecha >= f1_fecha && c_fecha <= f2_fecha){
                return true;
            }
        }

        else {
                return false;
        }
 
    });

 */

	table = $('#table').DataTable({
       // ajax: { url: '<?=site_url('get-ventas-solo-transporte')?>' },
       data: [
            {
                "id" : "FB1",
                "name" : "Donuts",
                "price": 1.99,
                "stock" : 43,
                "category" : "Breads",
                "special" : true
            },
            {
                "id" : "FB2",
                "price": 22.5,
                "name" : "Chocolate Cake",
                "stock" : 23,
                "category" : "Cakes", 
                "special" : true
            },
            {
                "id" : "FB3",
                "price": 3.95,
                "name" : "Baguette",
                "stock" : 34,
                "category" : "Breads", 
                "special" : true
            }
        ],
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

        return button;
    },
    width: "10%"
},
{ title: "Nombre", className: 'text-center', data: "name", width: "10%"},
{ title: "Stock", className: 'text-center', data: "stock", width: "8%"},
{ title: "Cantidad a Pedir", className: 'text-center', data: null, render: function (data, type, full, meta) {

    html = '<input class="form-control" type="number" min="1" id="row_'+data.id+'">';
    
    return html;

} ,width: "8%"},
{ title: "Cliente", className: 'text-center', data: null, render: function(data, type, full, meta){
    checkbox = '<input type="checkbox" class="form-control" checked="" id="checkbox_'+data.id+'">';

    return checkbox;
} ,width: "10%"},
{ title: "NIT", className: 'text-center', data: "NIT", width: "8%"},
{ title: "Total a pagar", className: 'text-center', data: "TOTAL_A_PAGAR", width: "5%"},
{ title: "Detalle", className: 'text-center', data: "NOMBRE_LISTA_PRECIOS", width: "10%"},

]});

function filtrar() {
    table.draw();
}


</script>
