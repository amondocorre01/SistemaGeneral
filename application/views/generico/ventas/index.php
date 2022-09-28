
<?php $categorias = $this->session->userdata('categorias')?>
<?php 
    if(isset($ventas_page)){
        echo '<input type="hidden" id="facturado_page_sucursal" name="facturado_page_sucursal" value="'.$facturado_page.'" >';
        echo '<input type="hidden" id="name_page_sucursal" name="name_page_sucursal" value="'.$name_page.'" >';
        echo '<input type="hidden" id="id_page_sucursal" name="id_page_sucursal" value="'.$ventas_page.'" >';
    }
?>
<input type="hidden" value="" name="metodo" id="metodo">
<section class="content">
        <div class="contenedor-responsivo">
            <div class="row">
                <div class="col-5 ladoDerecho">
                    <div class="card main-card-left">
                        <div class="card-body card-body-left">
                            <div class="col-12"> 
                                <div class="card card-left">
                                    <div class="card-body table-responsive p-0" style="height:490px; width:100%; overflow-x:hidden">
                                        <input type="hidden" id="id_lista_precios" value="<?=$ventas_ui?>" name="id_lista_precios">
                                        <div class="row" id="row_3">
                                            <div class="col-8">
                                                <b>Cliente:</b><span class="badge badge-success" id="labelCliente">SIN NOMBRE</span>
                                            </div>
                                            <div class="col-4">
                                                <b>NIT:</b><span class="badge badge-success" id="labelNIT">0</span>
                                            </div>
                                        </div>
                                        <table id="tableProducts" class="tableProducts table table-head-fixed">
                                            <thead>
                                                <tr>
                                                <th class="thProd">Prod.</th>
                                                <th style="text-align: center;">Pr. Unit.</th>
                                                <th style="text-align: center;">Cant.</th>
                                                <th style="text-align: center;">Total</th>
                                                <th style="text-align: center;">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div><!-- /.card-body -->
                                    <div>
                                        <span class="derechaTotal"><h4 class="total-left">TOTAL:</h4> <input class="totalTableBs" type="hidden" readonly name="totalCompra" /><h4 class="total-left"><span class="fullTotal"></span></h4> </span> 
                                    </div>
                                </div><!-- /.card table-->
                                <div class="card">
                                <div class="card-body card-body-left btn-footer-card">
                                        <a href="<?=base_url('index.php/generico/inicio?excel=1');?>" class="btn btn-app btn-sales-ini">
                                            <i class="fa fa-home"></i> Inicio
                                        </a>
                                        <a class="btn btn-app btn-sales-borrar" onclick="deleteRows();">
                                            <i class="fa fa-trash"></i> Borrar
                                        </a>
                                        <button type="button" class="btn btn-app btn-sales-cliente" data-toggle="modal" data-target="#cliente">
                                            <i class="fa fa-user"></i> Cliente
                                        </button>
                                        <button type="button" class="btn btn-app btn-sales-pagar" id="btnPagar">
                                            <i class="fa fa-money"></i>Pagar 
                                        </button>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="row">
                        <div class="col-12 main-card-right">
                            <div class="card ">
                                <div class="card-body card-categorias">
                                    <div class="row">
                                        <div id="categoria-1" class="col-12"></div>
                                        <div id="categoria-2" class="col-12"></div>
                                        <div id="categoria-3" class="col-12"></div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>


<div class="modal fade" id="pagar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box-body">
                    <div class="row" id="formas_pago">
                        <?php $formas = formas_pago($this->input->get('lp'), ID_UBICACION) ?>
                        <?php foreach ($formas as $tipo): ?>
                            <div class="mb-3 col-6 pagos" style="text-align: center;">
                                <h5><?=$tipo->FORMA_PAGO?></h5>
                                <?=img(['src'=>'assets/dist/img/'.$tipo->FOTO, 'alt'=>$tipo->FORMA_PAGO, 'onclick'=>'selectFormaPago('.$tipo->ID_FORMA_PAGO.', this)' ,'width'=>'200', 'height'=>'120', 'style'=>'opacity: .8', 'data-toggle'=>"modal", 'data-target'=>$tipo->TARGET])?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modals">
    <?php $this->load->view('generico/ventas/modals/efectivo.php', null, FALSE);  ?>
    <?php $this->load->view('generico/ventas/modals/tarjeta.php', null, FALSE);  ?>
    <?php $this->load->view('generico/ventas/modals/qr.php', null, FALSE);  ?>
    <?php $this->load->view('generico/ventas/modals/transferencia.php', null, FALSE);  ?>
</div>
    <!-- Main content -->

    <div class="modal fade" id="modalAgregarMensaje">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Mensaje</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="box-body">
                <label>Mensaje:</label>
                <div class="form-group">  
                <div class="input-group">
                    <textarea class="form-control input-lg textarea-msg" rows="4" required name="mensaje" placeholder="Ingrese el mensaje (*)"><?php echo strip_tags('');?></textarea>
                </div>
                </div>
            </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary btnSaveMsg"  onclick="guardarMensaje(this)">Guardar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <div class="modal fade" id="cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Seleccion del cliente frecuente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">

            <div class="row">
                <div class="form-group col-12">
                    <?=form_label("Cliente:", 'cliente'); ?> 
                    <div class="input-group">                        
                       <?=form_input('cliente', null, ['id'=>'responseCliente', 'style'=>'width:100%']); ?>
                    </div>
                </div>

                <div class="form-group col-8">
                    <?=form_label("Nombre completo", 'res_nombre_completo'); ?>
                    <div class="form-group">
                        <?=form_input('res_nombre_completo', 'SIN NOMBRE', ['class'=>'form-control micliente', 'id'=>'res_nombre_completo', 'readonly'=>'readonly']);?>
                    </div>
                </div>

                <div class="form-group col-4">
                    <?=form_label("C.I.", 'res_ci'); ?>
                    <div class="form-group">
                        <?=form_input('res_ci', '0', ['class'=>'form-control', 'id'=>'res_ci', 'readonly'=>'readonly']);?>
                    </div>
                </div>

                <div class="form-group col-8">
                    <?=form_label("Nombre a facturar", 'res_facturar_a'); ?>
                    <div class="form-group">
                        <?=form_input('res_facturar_a', 'SIN NOMBRE', ['class'=>'form-control micliente', 'id'=>'res_facturar_a']);?>
                    </div>
                </div>
                

                <div class="form-group col-4">
                    <?=form_label("NIT", 'res_nit'); ?>
                    <div class="form-group">
                        <?=form_input('res_nit', 0, ['class'=>'form-control micliente', 'id'=>'res_nit']);?>
                    </div>
                </div>

                <div class="form-group col-8">
                    <?=form_label("E-mail", 'res_email'); ?>
                    <div class="form-group">
                        <?=form_input('res_email', null, ['class'=>'form-control micliente', 'id'=>'res_email', 'readonly'=>'readonly']);?>
                    </div>
                </div>

                <div class="form-group col-4">
                    <?=form_label("Llamar por:", 'res_llamar'); ?>
                    <div class="form-group">
                        <?=form_input('res_llamar', null, ['class'=>'form-control', 'id'=>'res_llamar']);?>
                    </div>
                </div>
                <input type="hidden" name="res_id" id="res_id" value="1">
            </div>

            <div class="row" id="row_1">
                <div class="col-2">
                    <a href="<?=site_url('cliente-capresso')?>" target="_blank" class="btn btn-block bg-gradient-info btn-sm"><i class="fa fa-plus"></i></a>
                </div>

                <div class="col-4">
                    <button type="button" id="nextCliente" class="btn btn-block bg-gradient-warning btn-sm nextcliente">Continuar</button>
                </div>
            </div>

            <div class="row" id="row_2">
                <div class="col-offset-4 col-4">
                    <button type="button" id="updateCliente" class="btn btn-block palette-Teal-400 bg btn-sm">Actualizar</button>
                </div>
                <div class="col-4">
                    <button type="button" id="nextCliente" class="btn btn-block bg-gradient-warning btn-sm nextcliente">Continuar</button>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>

    

<div class="modal fade" id="adicional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">QR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                
            </div>
        </div>
    </div>
</div>


<div id="extra"> </div>


<script>
    $(document).ready(function() {
        $('.sidebar-toggle-btn').PushMenu(100);
        $.ajax({
            type: "post",
            url: "<?=site_url('categoria-1')?>",
            dataType: "html",
            success: function (response) {
                $('#categoria-1').empty();
                $('#categoria-1').append(response);
            }
        });
    });

    $('#volver-categoria-1').on('click', function(){
        $('#categoria-1').show('slow');
        $('#categoria-2').hide();
    });

    function cliente(id){
        var cliente = id;
        
        $.post("<?=site_url('get-cliente')?>", {id:cliente})
        .done(function( data ) {

            var cliente = JSON.parse(data);
                        
            $('#res_nit').val(cliente.NIT);
            $('#res_nombre_completo').val(cliente.NOMBRE_COMPLETO);
            $('#res_ci').val(cliente.CI);
            $('#res_facturar_a').val(cliente.NOMBRE_FACTURACION);
            $('#res_email').val(cliente.EMAIL);
            $('#res_id').val(cliente.ID_CLIENTE);

            $('#labelCliente').empty();
            $('#labelCliente').append(cliente.NOMBRE_FACTURACION);

            $('#labelNIT').empty();
            $('#labelNIT').append(cliente.NIT);

        });
    }

    function guardarMensaje(element){
        $('#modalAgregarMensaje').modal('toggle');
        var iden = $(element).attr("idRow");
        var nameRow='.row-'+iden;
        var nameTextSms = '.sms-'+iden;
        smsText=$('.textarea-msg').val();
        
        if(smsText.trim() ==''){
            $(nameRow).addClass('btnDisable');
            $(nameRow).removeClass('btn-info');
            $(nameTextSms).val('');
        }else{
            $(`${nameTextSms}`).val(smsText);
            $(nameRow).addClass('btn-info');
            $(nameRow).removeClass('btnDisable');
        }
        
        smsText=$('.textarea-msg').val('');
    }
   
    function selectFormaPago(id, content) {

        $('.pagos').removeClass("palette-Red-500 bg");       
        $(content).parent().addClass("palette-Red-500 bg");

        $('#metodo').val(id);

        $('#pagar').modal('hide');

        switch (id) {
            case 1:
                var monto =  $('input[name="totalCompra"]').val();
                parseInt($('#valorInput').val(monto));
            break;
        }
    }

    function productoAdicional(id, row) {

        $.post("<?=site_url('producto-adicional')?>", {id:id})
        
        .done(function( data ) {
            
            var resultado = JSON.parse(data);

            if(resultado.result != null)
            {
                var procedimiento = JSON.parse(resultado.result.PROCEDIMIENTO);
            var frutas = JSON.parse(resultado.result.FRUTAS);

            var proc = '<div class="modal fade" id="procedimiento_'+row+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                proc += '<div class="modal-dialog" role="document">';
                    proc += '<div class="modal-content">';
                        proc += '<div class="modal-header">';
                        proc += '<h5 class="modal-title">Personalizacion del producto sin costo adicional</h5>';
                     proc += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                    proc += '<span aria-hidden="true">&times;</span>';
                    proc += '</button></div><div class="modal-body" id="proc_'+row+'"></div></div></div></div>';
            

            $('#extra').append(proc);

            var content = '<div class="row">';

                $.each(procedimiento, function (i, v) {
                    
                      pos = i+1;

                      content += '<div class="col-6">';

                      content += '<div class="col-12">';
                            content += '<button type="button" class="btn btn-block bg-gradient-info btn-sm">'+v.PREGUNTA+'</button>';
                      content += '</div></div>';

                      content += '<div class="col-6">';
                            content += '<div class="col-12">';
                                content += '<select class="form-control" name="fruta-'+pos+'-'+row+'" id="fruta-'+pos+'-'+row+'" >';
                           
                        $.each(frutas, function (index, value) { 

                            content += '<option value="'+value.id_fruta+'">'+value.frutas+'</option>';
    
                        });

                      content += '</select></div></div>';
                });

              content += '<div class="row">';

                content += '<button type="button" class="btn btn-block bg-gradient-danger btn-s btn-aceptar-frutas" data-dismiss="modal" aria-label="Close">';
                    content += 'Aceptar';
                    content += '</button>';
            
            content += '</div>';

            $('#proc_'+row).append(content);
            $('#procedimiento_*').modal('hide');
            $('#procedimiento_'+row).modal('show');
            }
        });
    }

    
    $('.nextcliente').on('click', function(){
        $('#cliente').modal('hide');
    });

    function guardarPedido(){
        var datos_tabla = ($("#tableProducts>tbody").html()).trim();
        if(datos_tabla ==''){
            alert('Agregue productos para continuar');    
            return;
        }
        const id_lista_precios = $('#id_lista_precios').val();
        const facturado_page_sucursal = $('#facturado_page_sucursal').val();
        const nombreCliente = $('#res_nombre_completo').val();
        const facturar_cliente_a = $('#res_facturar_a').val();
        const nitCliente = $('#res_nit').val();
        const importeTotal = $('.totalTableBs').val();
        const formaPago = $('#metodo').val();// me devuelve id
        const montoRecibido = $('#montoInput').val();
        const montoCambio = $('#cambioInput').val();
        const idCliente = $('#responseCliente').val();
        const llamarPor = $('#res_llamar').val();

        const identificadores = document.getElementsByName("identificadores");
        const idProductosUnicos = document.getElementsByName("idProductosUnicos");    
        const nombresProductos = document.getElementsByName("nombresProductos");
        const preciosUnitarios = document.getElementsByName("preciosUnitarios");
        const cantidades = document.getElementsByName("cantidades");
        const subtotales = document.getElementsByName("subtotales");
        const paraLlevar = document.getElementsByName("paraLlevar");
        const mensajes = document.getElementsByName("mensajes");
        const recibos = document.getElementsByName("recibos");

        const listIdentificadores = new Array();
        const listIdProductosUnicos = new Array();
        const listProducts = new Array();
        const listPreciosUnitarios = new Array();
        const listCantidades = new Array();
        const listSubtotales = new Array();
        const listParaLlevar = new Array();
        const listMensajes = new Array();
        const listRecibos = new Array();
        const listFrutas = new Array();
        identificadores.forEach(element => {
            var iden = element.value;
            var listF = new Array();
            var nameFruta1='#fruta-1-'+iden;
            var nameFruta2='#fruta-2-'+iden;
            var nameFruta3='#fruta-3-'+iden;
            var nameFruta4='#fruta-4-'+iden;
            var maxFrutas = 4;
            for (let k = 1; k <= maxFrutas; k++) {
                var nameFruta='#fruta-'+k+'-'+iden;
                if ( $(nameFruta1).length > 0 ) {
                    var fruta = $(nameFruta).val();
                    listF.push(fruta);
                }
            }
            listFrutas.push(listF);
        });

        identificadores.forEach(element => {
            listIdentificadores.push(element.value);
        });
        idProductosUnicos.forEach(element => {
            listIdProductosUnicos.push(element.value);
        });
        nombresProductos.forEach(element => {
            listProducts.push(element.value);
        });
        preciosUnitarios.forEach(element => {
            listPreciosUnitarios.push(element.value);
        });
        cantidades.forEach(element => {
            listCantidades.push(element.value);
        });
        subtotales.forEach(element => {
            listSubtotales.push(element.value);
        });
        paraLlevar.forEach(element => {
            listParaLlevar.push(element.value);
        });
        mensajes.forEach(element => {
            listMensajes.push(element.value);
            
        });
        recibos.forEach(element => {
            listRecibos.push(element.value);
        });
        
        var datos = new FormData();
        datos.append("savePedido",'1');
        datos.append("idCliente", idCliente);
        datos.append("idListaPrecios", id_lista_precios);
        datos.append("sucursalEsFacturado", facturado_page_sucursal);
        datos.append("nombreCliente", nombreCliente);
        datos.append("facturar_cliente_a", facturar_cliente_a);
        datos.append("nitCliente", nitCliente);
        datos.append("importeTotal", importeTotal);
        datos.append("formaPago", formaPago);
        datos.append("montoRecibido", montoRecibido);
        datos.append("montoCambio", montoCambio);
        datos.append("llamarPor", llamarPor);
        datos.append("identificadores", JSON.stringify(listIdentificadores));
        datos.append("idProductosUnicos", JSON.stringify(listIdProductosUnicos));
        datos.append("productos", JSON.stringify(listProducts));
        datos.append("preciosUnitarios", JSON.stringify(listPreciosUnitarios));
        datos.append("cantidades", JSON.stringify(listCantidades));
        datos.append("subtotales", JSON.stringify(listSubtotales));
        datos.append("paraLlevar", JSON.stringify(listParaLlevar));
        datos.append("mensajes", JSON.stringify(listMensajes));
        datos.append("recibos", JSON.stringify(listRecibos));
        datos.append("frutas", JSON.stringify(listFrutas));

        $.ajax({
            url: "<?=site_url('guardar-pedido')?>",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                var longitud = parseInt(respuesta.datos_factura.nit_cliente.length);
                console.log(respuesta);
                
                var res = JSON.stringify(respuesta);
                
                if(respuesta){
                        Swal.fire({
                        icon: 'success',
                        title: 'Se ha registrado correctamente la venta',
                        timer: 3500
                        });
                        var esFacturado = $('#facturado_page_sucursal').val();
                        if(longitud < 11 && esFacturado == '1')
                        {
                            var url= "<?=site_url('imprimir-factura')?>/1";
                            window.open(url,'_blank');
                            window.location.href = "<?=current_url()?>";
                        }

                        else {
                            var url= "<?=site_url('imprimir-recibo')?>/1";
                            window.open(url,'_blank');
                            window.location.href = "<?=current_url()?>";
                        }
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error , No se ha registrado.',
                        timer: 3500
                    });
                }
            }
        });
       
    }   


$("#responseCliente").select2({
    language: "es",
    placeholder: "Buscar cliente",
    minimumInputLength: 3,
    maximumSelectionSize: 1,
    tags:true,
    ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
        url: "<?=site_url('mis-clientes')?>",
        dataType: 'json',
        quietMillis: 250,
        data: function (term, page) {
            return {
                q: term, // search term
            };
        },
        results: function (data, page) { // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to alter the remote JSON data
            return { results: data.results };
        }
    }
});

$("#responseCliente").on('change', function(){
    
   var id = $("#responseCliente").val();

   $('#res_facturar_a').removeAttr('readonly');
   $('#res_nit').removeAttr('readonly');
   $('#res_email').removeAttr('readonly');
   
   cliente(id);
});

$('.micliente').on('input', function(){
    $('#row_1').hide();
    $('#row_2').show('slow');     
});

$('#res_facturar_a').on('input', function(){

    var nuevo = $(this).val();

    console.log(nuevo);

    $('#labelCliente').empty();
    $('#labelCliente').append(nuevo);
});


$('#res_nit').on('input', function(){

  var nuevo = $(this).val();

  $('#labelNIT').empty();
  $('#labelNIT').append(cliente.NIT);

});


$('#updateCliente').on('click', function(){

   var nit = $('#res_nit').val();
   var facturar_a = $('#res_facturar_a').val();
   var email = $('#res_email').val();
   var id = $("#responseCliente").val();

   $.post("<?=site_url('actualizar-cliente')?>", {id:id, nit:nit,  facturar_a:facturar_a, email:email}) 
    .done(function( data ) {
        $('#row_2').hide();
        $('#row_1').show('slow');

        response = JSON.parse(data);

        if(response.status == true)
        {
            Swal.fire({
                icon: 'success',
                title: 'Se ha actualizado correctamente los datos del cliente',
                timer: 3500
            });
        }
    });
   
});

$('.btn-sales-cliente').on('click', function(){
    $('#nextCliente').attr('data-toggle','modal');
    $('#nextCliente').attr('data-target','#pagar');

    $('#btnPagar').attr('data-toggle','modal');
    $('#btnPagar').attr('data-target','#pagar');

    $('#row_3').show('slow');
});


$('#row_2').hide();
$('#row_3').hide();

</script>
