<br>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title"><i class="las la-boxes"></i>Cronograma de Entregas</h3>
            </div>
            <div class="card-body table-responsive">

            
	<div class="row">
		<div class="col-2">
			<button class="btn btn-xs btn-padding edit palette-Green-600 bg" data-toggle="modal" data-target="#nuevo">
				<i class="las la-plus la-1x"></i> Agregar
			</button>
		</div>

		<div class="col-2">
		<?=form_label('Fecha', 'fecha')?>
			<div class="input-group mb-3">
				<input id="fecha" type="date" class="form-control">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="las la-search" onclick="filtrar()"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
			
			
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
        <h6 class="modal-title" id="nombre3">Nueva Entrega</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
	  		<div class="col-md-12">
                <div class="form-group">
                    <?=form_label("Sucursal", 'sucursal');?>
                    <select name="" id="sucursal" class="form-control">
						<?php foreach ($sucursales as $s): ?>
							<option value="<?=$s->ID_UBICACION?>"><?=$s->DESCRIPCION?></option>
						<?php endforeach;?>
					</select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?=form_label("Turno", 'turno');?>
                    <select name="" id="turno" class="form-control">
						<?php foreach ($turnos as $t): ?>
							<option value="<?=$t->ID_TURNO?>"><?=$t->TURNO?></option>
						<?php endforeach;?>
					</select>
                </div>
            </div>
      </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="guardarRuta()">Confirmar</button>
      </div>
    </div>
  </div>
</div>



<script>


var fecha, table;

fecha = $('#fecha');
 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var f_fecha = fecha.val(); 
       
        var c_fecha = Date.parse(data[2]) / 1000;
        var a_fecha = Date.parse('<?=date('Y-m-d')?>') / 1000;
        


        if(f_fecha == ''){
            if(c_fecha == a_fecha){
                return true;
            }

            else {
                return false;
            }
        }

        else {

            var f_fecha = Date.parse(f_fecha) / 1000;

            if(f_fecha == c_fecha){
                    return true;
            }

            else {
                return false;
            }

        }});
   
    table = $('#table').DataTable({
        responsive: true,
        ajax: { url: '<?=site_url('get-cronograma')?>' },
        language:{ search: "Buscar", lengthMenu: "Mostrar _MENU_", previous: "Anterior",
        zeroRecords: "Sin resultados", infoEmpty: "No hay registros disponibles",
        info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        infoFiltered: "(Filtrado de _MAX_ registros totales)",
        oPaginate: {sNext:"Siguiente", sLast: "Último", sPrevious: "Anterior", sFirst:"Primero" },
        },
        columns: [
            { title: 'Turno', width:'12%' ,data: 'TURNO' },
            { title: 'Sucursal', width:'12%' ,data: 'DESCRIPCION' },
            { title: 'Fecha', width:'12%' ,data: 'FECHA' },           
            { title: 'Estado', width:'12%' ,data: 'ESTADO_CRONOGRAMA' }, 

        ],
    });


    function filtrar() {

      table.draw();
    }


    function guardarRuta() {

		var turno = $('#turno').val();
		var ubicacion = $('#sucursal').val();
		var fecha = '<?=date('Y-m-d')?>';

		$.post("<?=site_url('agregar-sucursal-cronograma')?>", {turno:turno, ubicacion:ubicacion, fecha:fecha})
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

	function llegada(id) {

		$.post("<?=site_url('confirmar-llegada')?>", {id:id})
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
</script>