<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Capresso Cafe</title>
        <link rel="icon" type="image/png" href="<?=base_url('assets/dist/img/taza.png')?>" />
        <!-- Branding Font -->
        <?=link_tag(base_url('assets/dist/css/font.css'))?>

        <!-- JQUERY -->
        <script src="<?=base_url('node_modules/jquery/dist/jquery.js')?>"></script>

        <!-- FOUNDATION ZURB -->
        <?=link_tag(base_url('node_modules/foundation-sites/dist/css/foundation.css'));?>
        <?=link_tag(base_url('node_modules/foundation-sites/dist/css/foundation-float.css'))?>
        <script src="<?=base_url('node_modules/foundation-sites/dist/js/foundation.js')?>"></script>

        <!-- LINEAWESONE -->
        <?=link_tag(base_url('node_modules/line-awesome/dist/line-awesome/css/line-awesome.css'));?>

        <!-- SWEET ALERT 2-->
        <?=link_tag(base_url('node_modules/sweetalert2/dist/sweetalert2.css'));?>
        <script src="<?=base_url('node_modules/sweetalert2/dist/sweetalert2.js')?>"></script>

        <!-- LEAFLET -->
        <script src="<?=base_url('node_modules/leaflet/dist/leaflet.js') ?>"></script>
        <?php echo link_tag('node_modules/leaflet/dist/leaflet.css'); ?>

        <!-- MIS ESTILOS -->
        <?=link_tag(base_url('assets/dist/css/theme.css'));?>
        <?=link_tag(base_url('assets/dist/css/palette.css'));?>
        <?=link_tag(base_url('assets/dist/css/mystyle.css'));?>
        <?=link_tag(base_url('assets/dist/css/mystyles.css'));?>

        <!-- SELECT 2 @3.5.3-->
        <?=link_tag(base_url('node_modules/select2/select2.css'))?>
        <script src="<?=base_url('node_modules/select2/select2.js')?>"></script>

    </head>
    <body>
        <div class="wrap-fluid" id="paper-bg">

        <div class="row">
            <div class="large-2 medium-5 small-6 large-centered medium-centered small-centered columns">
                <?=img('assets/dist/img/logo.png')?>
            </div>
        </div>

        <div class="row">
            <div class="large-11 large-centered  medium-10 medium-centered columns">
                <div class="box no-shadow">
                    <div class="box-header panel">
                        <h3 class="box-title"><i class="las la-user-edit la-2x"></i>
                            <span class="palette-White text">Actualizar Cliente</span>
                        </h3>
                    </div>

                    <div class="box-body">
                        <?=form_open(current_url(), 'data-abide data-live-validate="true" novalidate ', ['lat'=>'', 'lng'=>'', 'id'=>'0']);?>
                            <div class="row">
                                <div class="large-8 medium-12 column">
                                    <div class="row">
                                        <div class="large-5 medium-5 small-12 columns">
                                            <?=form_label("Buscar", 'cliente'); ?> 
                                            <div class="input-group">
                                                <span class="input-group-label">
                                                    <i class="las la-search"></i>
                                                </span>                      
                                                <?=form_input('cliente', null, ['id'=>'responseCliente', 'style'=>'width:100%']); ?>
                                            </div>
                                        </div>

                                        <div class="large-7 medium-7 small-12 columns">
                                            <?=form_label("Nombre completo", 'nombre'); ?> 
                                            <div class="input-group">
                                                <span class="input-group-label">
                                                    <i class="las la-user"></i>
                                                </span>
                                                <?=form_input(['name'=>'nombre','class'=>'input-group-field letras','id'=>'nombre', 'maxlength'=>'100', 'minlength'=>'2', 'required'=>'required', 'autocomplete'=>'off']); ?>
                                            </div>

                                            <span class="form-error" data-form-error-for="nombre">
                                                <?=lang('campo.requerido')?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="large-4 medium-4 small-12 columns">
                                            <?=form_label( lang('dni'), 'dni'); ?> 
                                            <div class="input-group">
                                                <span class="input-group-label">
                                                    <i class="las la-id-card"></i>
                                                </span>
                                                <?=form_input(['name'=>'dni','class'=>'input-group-field numeros', 'id'=>'dni', 'maxlength'=>'50', 'minlength'=>'5', 'readonly'=>'readonly','required'=>'required', 'autocomplete'=>'off'] ); ?>
                                            </div>

                                            <span class="form-error" data-form-error-for="dni">
                                                <?=lang('campo.requerido')?>
                                            </span>
                                        </div>

                                        <div class="large-4 medium-4 small-12 columns">
                                            <?=form_label( lang('complemento'), 'complemento'); ?> 
                                            <div class="input-group">
                                                <span class="input-group-label">
                                                    <i class="las la-id-card"></i>
                                                </span>
                                                <?=form_input(['name'=>'complemento','class'=>'input-group-field letrasnumeros', 'id'=>'complemento', 'maxlength'=>'2', 'minlength'=>'2']); ?>
                                            </div>
                                        </div>

                                        <div class="large-4 medium-4 small-12 columns">
                                            <?=form_label( lang('expedido'), 'expedido'); ?> 
                                            <div class="input-group">
                                                <span class="input-group-label">
                                                    <i class="las la-caret-square-down"></i>
                                                </span>
                                                <?=form_dropdown('expedido', $departamentos, null, ['id'=>'expedido', 'required'=>'required']); ?>
                                            </div>

                                            <span class="form-error" data-form-error-for="expedido">
                                                <?=lang('campo.requerido')?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="large-6 medium-6 small-12 columns">
                                            <?=form_label( "NIT", 'nit'); ?> 
                                            <div class="input-group">
                                                <span class="input-group-label">
                                                    <i class="las la-hand-holding-usd"></i>
                                                </span>
                                                <?=form_input(['name'=>'nit','class'=>'input-group-field numeros', 'id'=>'nit', 'maxlength'=>'15', 'minlength'=>'5']); ?>
                                            </div>
                                        </div>

                                        <div class="large-6 columns">
                                            <?=form_label("Nombre facturacion", 'nombre_factura'); ?> 
                                            <div class="input-group">
                                                <span class="input-group-label">
                                                    <i class="las la-user"></i>
                                                </span>
                                                <?=form_input(['name'=>'nombre_factura','class'=>'input-group-field letras','id'=>'nombre_factura', 'maxlength'=>'30', 'pattern'=>'[a-zA-ZáÁéÉíÍóÓúÚñÑ\.\&]{3,100}', 'required'=>'required']); ?>
                                            </div>

                                            <span class="form-error" data-form-error-for="nombre_factura">
                                                Este campo es obligatorio
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="large-6 medium-18 small-12 columns">
                                            <?=form_label("Direccion", 'direccion'); ?> 
                                            <div class="input-group">
                                                <span class="input-group-label">
                                                    <i class="las la-map-signs"></i>
                                                </span>
                                                <?=form_input(['name'=>'direccion','class'=>'input-group-field','id'=>'direccion', 'maxlength'=>'150', 'required'=>'required']); ?>
                                            </div>

                                            <span class="form-error" data-form-error-for="direccion">
                                                <?=lang('campo.requerido')?>
                                            </span>
                                        </div>

                                        <div class="large-6 columns">
                                            <?=form_label("Correo electronico", 'email'); ?> 
                                            <div class="input-group">
                                                <span class="input-group-label">
                                                    <i class="las la-envelope"></i>
                                                </span>
                                                <?=form_input(['name'=>'email','class'=>'input-group-field','id'=>'email', 'maxlength'=>'50', 'pattern'=>'email']); ?>
                                            </div>

                                            <span class="form-error" data-form-error-for="email">
                                                Este campo debe contener un formato de correo electronico
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="large-6 medium-6 small-12 columns">
                                            <?=form_label("Celular", 'celular'); ?> 
                                            <div class="input-group">
                                                <span class="input-group-label">
                                                    <i class="las la-mobile"></i>
                                                </span>
                                                <?=form_input(['name'=>'celular','class'=>'input-group-field numeros','id'=>'celular', 'maxlength'=>'8', 'pattern'=>'[0-9]{8}']); ?>
                                            </div>

                                            <span class="form-error" data-form-error-for="celular">
                                                Este campo es de 8 Digitos
                                            </span>
                                        </div>
                                        <div class="large-6 medium-6 small-12 columns">
                                            <?=form_label("Telefono fijo", 'fijo'); ?> 
                                            <div class="input-group">
                                                <span class="input-group-label">
                                                    <i class="las la-phone-volume"></i>
                                                </span>
                                                <?=form_input(['name'=>'fijo','class'=>'input-group-field numeros','id'=>'fijo', 'maxlength'=>'7', 'pattern'=>'[0-9]{7}']); ?>
                                            </div>

                                            <span class="form-error" data-form-error-for="fijo">
                                                Este campo es de 7 Digitos
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                    <div class="large-offset-4 large-4 medium-offset-3 medium-6 columns">
                                        <?=form_button(['name'=>'send', 'id'=>'send', 'type'=>'submit','content'=>'<i class="las la-user-edit la-2x palette-White text"></i>'.'<span class="palette-White text">Actualizar</span>', 'class'=>'button expanded login']);?>
                                    </div>
                                        
                                    </div>
                                </div>
                                <div class="large-4 column">
                                    <div id="mapid">
                                        
                                    </div>
                                </div>
                            </div>
                        <?=form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
    $(document).foundation();

    $("#dni").on('blur', function(event){

      
        var dni = $( this ).val();
       
        $.ajax({
            type: "POST",
            url: "<?=site_url('existe-dni')?>",
            data:  {id: dni },
            dataType: "json",
            success: function (response) {

                if(response != null) {

                    Swal.fire({
                        icon: 'error',
                        title: 'El documento de identidad ya esta registrado',
                        timer: 4500
                    });

                }
                
            }
        });
        

    });

    $("input.letras").bind('keypress', function(event) {
        var regex = new RegExp("^[a-zA-ZáéíóúñÁÉÍÓÚÑ\.\& ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    $("input.numeros").bind('keypress', function(event) {
        var regex = new RegExp("^[0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });


    $("input.letrasnumeros").bind('keypress', function(event) {
        var regex = new RegExp("^[a-zA-Z0-9 ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });


        var latitud  = -17.414;
	    var longitud = -66.1653;
		 	   
		var map = L.map('mapid').setView([ latitud, longitud], 13);


		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		 	 attribution: '&copy; OpenStreetMap contributors',
		     minZoom: 12,
		     maxZoom: 17
		}).addTo(map);


        var marker = L.marker([latitud, longitud],
		    {draggable: true}).addTo(map);

		    marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                marker.setLatLng(position, {
                draggable: 'true'
                }).bindPopup(position).update();
                $("input[name=lat]").val(position.lat);
                $("input[name=lng]").val(position.lng).keyup();

                var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+position.lat+","+position.lng+"&sensor=true&key=AIzaSyBMjBtSajbdPEsnnhAL-DiGT4txUDazQVU";
                
                $.post(url)
                    .done(function( data ) {
                        $("input[name=direccion]").val(data.results[1].address_components[0].long_name + ", " +data.results[1].address_components[1].long_name +", "+data.results[1].address_components[2].long_name);
                    });
		    });

            <?php if( $this->session->flashdata('update') ): ?>
                 map.setView(new L.LatLng(<?=$this->session->flashdata('lat')?>, <?=$this->session->flashdata('lng')?>), 17);
            <?php endif; ?>

            <?php if( $this->session->flashdata('error') ) { ?>
    
                Swal.fire({
                    icon: 'error',
                    title: 'Se ha producido un error',
                    timer: 4500
                });
            <?php } ?>

            <?php if( $this->session->flashdata('update') ) { ?>
    
                Swal.fire({
                    icon: 'success',
                    title: 'Se ha actualizado correctamente al cliente',
                    timer: 4500
                });
            <?php } ?>


            $("#responseCliente").select2({
                language: "es",
                placeholder: "Search for a repository",
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
                cliente(id);
            });

            function cliente(id){
                var cliente = id;
                
                $.post("<?=site_url('get-cliente')?>", {id:cliente})
                .done(function( data ) {

                    var cliente = JSON.parse(data);
                                
                    $('#nit').val(cliente.NIT);
                    $('#expedido').val(cliente.EXT);
                    $('#nombre').val(cliente.NOMBRE_COMPLETO);
                    $('#dni').val(cliente.CI);
                    $('#complemento').val(cliente.COMPLEMENTO);
                    $('#nombre_factura').val(cliente.NOMBRE_FACTURACION);
                    $('#email').val(cliente.EMAIL);
                    $('#direccion').val(cliente.DIRECCION);
                    $('#celular').val(cliente.CELULAR);
                    $('#fijo').val(cliente.FIJO);
                    $('input[name="id"]').val(cliente.ID_CLIENTE);
                    $('input[name="lat"]').val(cliente.LATITUD);
                    $('input[name="lng"]').val(cliente.LONGITUD);
                });
            }
</script>