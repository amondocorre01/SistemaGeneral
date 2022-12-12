<br>
<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.min.css')?>">
<link rel="stylesheet" href="<?=base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')?>">
<?php
    $this->session->set_userdata('datatable', 'true');
    $id_menu = intval($this->input->get('vc'));
    $id_usuario = $this->session->id_usuario;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Productos </h3>
        </div>
        
        <div class="card-body">
        <form action="<?=current_url()?>" method="GET" id="form_fecha">
        <div class="row">

            <div class="col-md-3">
                
                <div class="form-group">
                  <label>Categoria</label>
                  <a class="btnShowProducts btn-info btn-xs btnAgregarPC" title="Agregar categoria" data-toggle="modal" data-target="#modalAgregarPrimeraCategoria"><i class="fa fa-plus"></i></a>
                  <a class="btnShowProducts btn-warning btn-xs btnEditarPC" title="Editar categoria" data-toggle="modal" data-target="#procedimiento_1670344808034"><i class="fa fa-pencil"></i></a>
                  <a class="btnShowProducts btn-danger btn-xs btnEliminarPC" title="Eliminar categoria" data-toggle="modal" data-target="#procedimiento_1670344808034"><i class="fa fa-times"></i></a>
                  <select name="productoCategoria1" id="productoCategoria1" class="form-control select2" style="width: 100%;">
                    <option value="" selected="selected">Seleccione la primera categoria</option>
                    <?php
                        foreach ($primeraCategoria as $key => $value) {
                            echo '<option '.$sel.' value="'.$value->ID_CATEGORIA.'">'.$value->CATEGORIA.'</option>';
                        }
                    ?>
                  </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                  <label>Subcategoria</label>
                  <a class="btnShowProducts btn-info btn-xs btnAgregarSC" title="Agregar Subcategoria" data-toggle="modal" data-target="#modalAgregarSegundaCategoria"><i class="fa fa-plus"></i></a>
                  <a class="btnShowProducts btn-warning btn-xs btnEditarSC" title="Editar Subcategoria" data-toggle="modal" data-target="#procedimiento_1670344808034"><i class="fa fa-pencil"></i></a>
                  <a class="btnShowProducts btn-danger btn-xs btnEliminarSC" title="Eliminar Subcategoria" data-toggle="modal" data-target="#procedimiento_1670344808034"><i class="fa fa-times"></i></a>
                  <select name="productoCategoria2" id="productoCategoria2" class="form-control select2" style="width: 100%;">
                    <option value="" selected="selected">Seleccione la segunda categoria</option>
                  </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                  <label>Seleccione el producto</label>
                  <a class="btnShowProducts btn-info btn-xs btnAgregarPM" title="Agregar producto "><i class="fa fa-plus"></i></a>
                  <a class="btnShowProducts btn-warning btn-xs btnEditarPM" title="Editar producto " ><i class="fa fa-pencil"></i></a>
                  <a class="btnShowProducts btn-danger btn-xs btnEliminarPM" title="Eliminar producto " data-toggle="modal" data-target="#procedimiento_1670344808034"><i class="fa fa-times"></i></a>
                  <select name="productoMadre" id="productoMadre" class="form-control select2" style="width: 100%;">
                    <option value="" selected="selected">Seleccione el producto</option>
                  </select>
                </div>
            </div>
            <!--<div class="col-md-3">
            <input  name="vc" type="hidden" id="fecha" value="<?=$this->input->get('vc')?>">
                <input class="btn btn-primary btn-form-search" type="submit" value="Buscar" name="buscar" >
            </div>-->
        </div>
        </form>
        </div>
        </div>
    </div>
</div>

<div class="card" id="agregarEditarProducto">
  <div class="card-body">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label>Producto</label>
          <input type="text" class="form-control" name="producto" id="producto" placeholder="Nombre del producto">
        </div>
        <div class="form-group">
        <label>Detalle del producto</label>
              <textarea class="form-control input-sm " rows="2" id="detalleProducto" name="detalle" placeholder="Ingrese el detalle."><?php echo strip_tags('');?></textarea>
        </div>

        
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Seleccione unidad de medida</label>
          <select name="unidadMedida" id="unidadMedida" class="form-control select2" style="width: 100%;">
            <option value="" selected="selected">Seleccione unidad de medida</option>
            <?php
            foreach ($unidadesMedida as $key => $value) {
              echo '<option id="udMedida_'.$key.'" value="'.$value->CODIGO.'" >'.$value->DESCRIPCION.'</option>';
            }
            ?>
          </select>
        </div>
        <br>
        <div class="row">
          <label class="col-sm-12 ">¿Incluirá transporte?</label>
          <div class="form-group col-sm-4">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="radio" name="tieneTransporte" id="transporteSi" value="1">
              <label for="transporteSi" class="custom-control-label">SI</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="radio" name="tieneTransporte" id="transporteNo" value="0" checked>
              <label for="transporteNo" class="custom-control-label">NO</label>
            </div>
          </div>
          <div class="form-group col-md-8 inputPrecioTransporte">
            <input type="number" class="form-control input-sm" name="precioTransporte" id="precioTransporte" placeholder="Precio">
          </div>
        </div>
        

        
        
        

      </div>  
      <div class="col-md-3">
        <div class="row">
          <div class="form-group col-md-6">
            <label>Cod. Act. Económica</label>
            <input type="text" class="form-control" name="actividadEconomica" id="actividadEconomica" placeholder="563010"><!-- -->
          </div>
          <div class="form-group col-md-6">
            <label>Cod. Producto SIN</label>
            <input type="text" class="form-control" name="productoSIN" id="productoSIN" placeholder="99100"><!--65200-->
          </div>
        </div>
            
       

        <div class="select2-purple">
          <label>Seleccione tamaños del producto:</label>
          <select class="select2" id="selectTam" name="selectTam" multiple="multiple" data-placeholder="Seleccione..." data-dropdown-css-class="select2-purple" style="width: 100%;">
            <?php
            foreach ($tamProductos as $key => $value) {
              echo '<option id="costos_'.$key.'" value="'.$value->ID_TAMAÑO.'" >'.$value->TAMAÑO.'</option>';
            }
            ?>
          </select>
        </div>

        
        
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Subir Imagen del Producto:</label>
          <input type="file" id="nuevaFoto" name="nuevaFoto">
          <!--<p class="help-block"><br/>Peso máximo: 2 MB - Dimensiones : 200 x 200 o similar.</p>-->
        </div>
        <center>
          <img src="<?=base_url('assets/dist/img/default-image.jpg')?>" class="img-thumbnail previsualizar" width="120px">
        </center>
      </div>
    </div>
    

    <table id="tablaProductos" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th class="text-center">Tamaño</th>
        <th class="text-center">Frutas</th>
        <?php
          foreach ($listasPrecios as $key => $value) {
            echo '<th class="text-center">'.$value->NOMBRE_LISTA_PRECIOS.'</th>';
          }
        ?>
        <th class="text-center">Acciones</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <div> 
      <center>
        <button class="btn btn-primary">Guardar cambios</button>
      </center>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAgregarPrimeraCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar 1ra categoria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputPassword1">Primera categoria</label>
              <input type="text" class="form-control" name="primeraCategoria" id="primeraCategoriaMPC" placeholder="Ingrese la categoria">
            </div>
          </div>
      </div>
      
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary"  onclick="guardarPrimeraCategoria()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAgregarSegundaCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar 2da categoria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="box-body">
          <div class="form-group">
              <label>Primera categoria</label>
              <input type="text" class="form-control" name="primeraCategoria" id="priCategoria" readonly placeholder="Ingrese la categoria">
            </div>
            <div class="form-group">
              <label>Segunda categoria</label>
              <input type="text" class="form-control" name="segundaCategoria" id="segundaCategoriaMSC" placeholder="Ingrese la categoria">
            </div>
          </div>
      </div>
      
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary"  onclick="guardarSegundaCategoria()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAgregarCostos">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar frutas y precios</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="box-body">
          
          <input type="hidden" id="idTamProducto" class="form-control" placeholder="">
          <div class="form-group row">
                <label class="col-sm-6 col-form-label">Tamaño seleccionado:</label>
                <div class="col-sm-6">
                <input type="text" readonly id="textTamProducto" class="form-control" placeholder="">
                </div>
              </div>
          <div class="form-group row">
            <label class="col-sm-6 col-form-label">¿Incluirá frutas?</label>
            <div class="form-group col-sm-2">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="radio" name="tieneFrutas" id="frutasSi" value="1">
                <label for="frutasSi" class="custom-control-label">SI</label>
              </div>
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="radio" name="tieneFrutas" id="frutasNo" value="0" checked>
                <label for="frutasNo" class="custom-control-label">NO</label>
              </div>
            </div>
            <div class="form-group col-sm-4 cantidadFrutasModal">
              <select name="cantidadFrutasModal" id="cantidadFrutasModal" class="form-control select2" style="width: 100%;">
                <option value="" selected="selected">Cantidad</option>
                <option value="1" >1</option>
                <option value="2" >2</option>
                <option value="3" >3</option>
                <option value="4" >4</option>
              </select>
            </div>
          </div>
            <?php
              foreach ($listasPrecios as $key => $value) {
                echo '
                <div class="form-group row">
                    <label class="col-sm-6 col-form-label">Costo '.$value->NOMBRE_LISTA_PRECIOS.'</label>
                    <div class="col-sm-6">
                      <input type="number" iden="'.$value->ID_NOMBRE_LISTA_PRECIOS.'" name="modalCostos" value="0" class="form-control modalCostos" placeholder="">
                    </div>
                  </div>
                ';
              }
            ?>
            
          </div>
      </div>
      
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardarProductoMadre" >Agregar</button>
        <button type="button" class="btn btn-primary" id="guardarEditarProductoMadre" >Modificar</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    $('#agregarEditarProducto').hide();
    $('#productoCategoria2').prop( "disabled", true );
    $('#productoMadre').prop( "disabled", true );
    $('.btnAgregarPC').show();
    $('.btnEditarPC').hide();
    $('.btnEliminarPC').hide();

    $('.btnAgregarSC').hide();
    $('.btnEditarSC').hide();
    $('.btnEliminarSC').hide();

    $('.btnAgregarPM').hide();
    $('.btnEditarPM').hide();
    $('.btnEliminarPM').hide();

    $('.inputPrecioTransporte').hide();

    $('#productoCategoria1').on('change',function(){
        var primera_categoria_id = $(this).val();
        var texto_seleccionado = $('#productoCategoria1 option:selected').html();
        $('#agregarEditarProducto').hide();

        $('.btnEditarSC').hide();
        $('.btnEliminarSC').hide();

        $('.btnAgregarPM').hide();
        $('.btnEditarPM').hide();
        $('.btnEliminarPM').hide();
        if(primera_categoria_id != ''){
          $('.btnEditarPC').show();
          $('.btnEliminarPC').show();
          $('.btnAgregarSC').show();
        }else{
          $('.btnEditarPC').hide();
          $('.btnEliminarPC').hide();

          $('.btnAgregarSC').hide();
          $('.btnEditarSC').hide();
          $('.btnEliminarSC').hide();

          $('.btnAgregarPM').hide();
          $('.btnEditarPM').hide();
          $('.btnEliminarPM').hide();
        }
        $('#productoCategoria2').prop( "disabled", true );
        $('#productoMadre').prop( "disabled", true );
        var datos = new FormData();
        datos.append("primera_categoria_id",primera_categoria_id);
        datos.append("texto_seleccionado",texto_seleccionado);
        $('#productoCategoria2').html('<option value="">Cargando segunda categoria ...</option>'); 
        if(primera_categoria_id){
            $.ajax({
                method:'POST',
                url:'<?=site_url("productos-segunda-categoria")?>',
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success:function(html){
                  $('#productoCategoria2').prop( "disabled", false );
                    $('#productoCategoria2').html(html);
                    $('#productoMadre').html('<option value="">Seleccione segunda categoria</option>'); 
                    //$('#iglesia').html('<option value="">Seleccione una zona primero</option>'); 
                }
            }); 
        }else{
            $('#productoCategoria2').html('<option value="">Seleccione primera categoria</option>');
            $('#productoMadre').html('<option value="">Seleccione segunda categoria</option>'); 
            //$('#iglesia').html('<option value="">Seleccione una zona primero</option>'); 
        }
    });
    
    $('#productoCategoria2').on('change',function(){
        var segunda_categoria_id = $(this).val();
        var texto_seleccionado = $('#productoCategoria2 option:selected').html();
        $('#agregarEditarProducto').hide();
        $('.btnEditarPM').hide();
        $('.btnEliminarPM').hide();
        if(segunda_categoria_id != ''){
          $('.btnEditarSC').show();
          $('.btnEliminarSC').show();
          $('.btnAgregarPM').show();
        }else{
          $('.btnEditarSC').hide();
          $('.btnEliminarSC').hide();

          $('.btnAgregarPM').hide();
          $('.btnEditarPM').hide();
          $('.btnEliminarPM').hide();
        }
        $('#productoMadre').prop( "disabled", true );
        var datos = new FormData();
        datos.append("segunda_categoria_id",segunda_categoria_id);
        datos.append("texto_seleccionado",texto_seleccionado);

        $('#productoMadre').html('<option value="">Cargando productos...</option>'); 
        if(segunda_categoria_id){
            $.ajax({
                method:'POST',
                url:'<?=site_url("productos-madre")?>',
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success:function(html){
                    $('#productoMadre').prop( "disabled", false );
                    $('#productoMadre').html(html);
                    //$('#iglesia').html('<option value="">Seleccione segunda categoria</option>'); 
                }
            }); 
        }else{
            $('#productoMadre').html('<option value="">Seleccione segunda categoria</option>'); 
            //$('#iglesia').html('<option value="">Seleccione una zona primero</option>'); 
        }
    });
    
    $('#productoMadre').on('change',function(){
        var producto_madre_id = $(this).val();
        if(producto_madre_id != ''){
          $('.btnEditarPM').show();
          $('.btnEliminarPM').show();
        }else{
          $('.btnEditarPM').hide();
          $('.btnEliminarPM').hide();
        }
        $('#agregarEditarProducto').hide();
    });

    $('#selectTam').on('change',function(){
      var seleccion = this.selectedIndex;
      var text = $("#selectTam option:selected").val();
      var listaPreciosSeleccionados = new Array();
      $("#selectTam :selected").each(function() {
        listaPreciosSeleccionados.push(this.value);
        });
      
      var listaPreciosSeleccionadosText = new Array();
      $("#selectTam :selected").each(function() {
        listaPreciosSeleccionadosText.push(this.text);
      });
      
        for (let i = 0; i < listaPreciosSeleccionados.length; i++) {
          const listaPrecios = document.getElementsByName("listaPrecios");
          const listaPreciosTabla = new Array();
            listaPrecios.forEach(element => {
              listaPreciosTabla.push(element.value);
            });
          const incluye = listaPreciosTabla.includes(listaPreciosSeleccionados[i]);
          if(incluye == false){
            $( "#guardarEditarProductoMadre" ).prop( "disabled", true );
            $( "#guardarProductoMadre" ).prop( "disabled", false );
            $("#guardarProductoMadre").css('display', 'block');
            $("#guardarEditarProductoMadre").css('display', 'none');
            $('#idTamProducto').val(listaPreciosSeleccionados[i]);
            $('#textTamProducto').val(listaPreciosSeleccionadosText[i]);
            $("#modalAgregarCostos").modal("show");
            $(".modalCostos").val('0');
            $("#frutasNo").prop('checked', true);
            $("#frutasSi").prop('checked',false);
            $(".cantidadFrutasModal").hide();
            $("#cantidadFrutasModal").val('');
            $('#cantidadFrutasModal').select2();
            /*
            let row = `
            <td><input type="hidden" name="listaPrecios" value="${listaPreciosSeleccionados[i]}" />${listaPreciosSeleccionadosText[i]}</td>
            <td><input type="number" min='0' name="listaPrecios_1" /></td>
            <td><input type="number" min='0' name="listaPrecios_2" /></td>
            <td><input type="number" min='0' name="listaPrecios_3" /></td>
            <td><input type="number" min='0' name="listaPrecios_4" /></td>
            <td><input type="number" min='0' name="listaPrecios_5" /></td>
            <td><input type="number" min='0' name="listaPrecios_6" /></td>
            <td><input type="number" min='0' name="listaPrecios_7" /></td>
            `;
            $("#tablaProductos>tbody").append(`
            <tr id="products-tr-${listaPreciosSeleccionados[i]}">
            ${row}
            <td><a class="btnShowProducts btn-danger deleteRow btn-xs" iden="${listaPreciosSeleccionados[i]}"><i class="fa fa-times"></i></a></td>
            </tr>
            `);*/
            i= listaPreciosSeleccionados.length;
          }
        }
        //eliminarFilas
        const listaPrecios = document.getElementsByName("listaPrecios"); 
        const listaPreciosTabla = new Array();
            listaPrecios.forEach(element => {
              listaPreciosTabla.push(element.value);
            });
        for (let j = 0; j < listaPreciosTabla.length; j++) {
          const element = listaPreciosTabla[j];
          const incluye = listaPreciosSeleccionados.includes(listaPreciosTabla[j]);
          if(incluye == false){
            var text_id= `#products-tr-${listaPreciosTabla[j]}`;
            $(text_id).remove();
          }
        }
    });

    $("#modalAgregarCostos").on('hidden.bs.modal', function () {
      var listaPreciosSeleccionados = new Array();
      $("#selectTam :selected").each(function() {
        listaPreciosSeleccionados.push(this.value);
        });
      const listaPrecios = document.getElementsByName("listaPrecios"); 
      const listaPreciosTabla = new Array();
          listaPrecios.forEach(element => {
            listaPreciosTabla.push(element.value);
          });
      for (let i = 0; i < listaPreciosSeleccionados.length; i++) {
        const element = listaPreciosSeleccionados[i];
        const incluye = listaPreciosTabla.includes(element);
          if(incluye == false){
            $('#selectTam option[value="'+element+'"]').prop("selected", false);
            $("#selectTam").css('display', 'none');
            $("#selectTam").css('display', 'block');
            $('#selectTam').select2();
          }
      }

    });

    $('input[type=radio][name=tieneFrutas]').change(function() {
      if(this.value == '1'){
          $(".cantidadFrutasModal").show();
      }
      else {
        $("#cantidadFrutasModal").val('');
        $(".cantidadFrutasModal").hide();
        $('#cantidadFrutasModal').select2();
      }
    });

    $('input[type=radio][name=tieneTransporte]').change(function() {
      if(this.value == '1'){
          $(".inputPrecioTransporte").show();
      }
      else {
        $("#precioTransporte").val('');
        $(".inputPrecioTransporte").hide();
      }
    });

    $('#guardarProductoMadre').on('click',function(){
      var idTamProducto = $('#idTamProducto').val();
      var textTamProducto = $('#textTamProducto').val();
      var cantFrutas = $('#cantidadFrutasModal').val();
      if(cantFrutas == ''){
        cantFrutas ='0';
      }
      const modalPrecios = document.getElementsByName("modalCostos"); 
      var rowsPrecio='';
      modalPrecios.forEach(element => {
        var costoElement = element.value;
        var iden = $(element).attr('iden');
        rowsPrecio = `${rowsPrecio}'<td align="center"><input class="in-cant listaPreciosTabla-${idTamProducto}" type="hidden" value="${costoElement}" min='0' name="listaCostos_${iden}" />${costoElement}</td>`;
      });
      let row = `
      <td align="center"><input type="hidden" name="listaPrecios" value="${idTamProducto}" />${textTamProducto}</td>
      <td align="center"><input type="hidden" name="cantidadFrutas" value="${cantFrutas}" />${cantFrutas}</td>
      ${rowsPrecio}
      `;
      $("#tablaProductos>tbody").prepend(`
      <tr id="products-tr-${idTamProducto}">
      ${row}
      <td align="center">
        <a class="btnShowProducts btn-warning editRow btn-xs" iden="${idTamProducto}" textTam="${textTamProducto}"><i class="fa fa-pencil"></i></a>  
        <a class="btnShowProducts btn-danger deleteRow btn-xs" iden="${idTamProducto}"><i class="fa fa-times"></i></a>
      </td>
      </tr>
      `);
      $("#modalAgregarCostos").modal("hide");
    });

    $('#guardarEditarProductoMadre').on('click',function(){
      var idTamProducto = $('#idTamProducto').val();
      var text_id= `#products-tr-${idTamProducto}`;
      $(text_id).remove();
      var textTamProducto = $('#textTamProducto').val();
      var cantFrutas = $('#cantidadFrutasModal').val();
      if(cantFrutas == ''){
        cantFrutas ='0';
      }
      const modalPrecios = document.getElementsByName("modalCostos"); 
      var rowsPrecio='';
      modalPrecios.forEach(element => {
        var costoElement = element.value;
        var iden = $(element).attr('iden');
        rowsPrecio = `${rowsPrecio}'<td align="center"><input class="in-cant listaPreciosTabla-${idTamProducto}" type="hidden" value="${costoElement}" min='0' name="listaCostos_${iden}" />${costoElement}</td>`;
      });
      let row = `
      <td align="center"><input type="hidden" name="listaPrecios" value="${idTamProducto}" />${textTamProducto}</td>
      <td align="center"><input type="hidden" name="cantidadFrutas" value="${cantFrutas}" />${cantFrutas}</td>
      ${rowsPrecio}
      `;
      $("#tablaProductos>tbody").prepend(`
      <tr id="products-tr-${idTamProducto}">
      ${row}
      <td align="center">
        <a class="btnShowProducts btn-warning editRow btn-xs" iden="${idTamProducto}" textTam="${textTamProducto}"><i class="fa fa-pencil"></i></a>  
        <a class="btnShowProducts btn-danger deleteRow btn-xs" iden="${idTamProducto}"><i class="fa fa-times"></i></a>
      </td>
      </tr>
      `);
      $("#modalAgregarCostos").modal("hide");
    });

});

$('body').on('click', 'a.deleteRow', function() {
  var iden = $(this).attr('iden');  
  $('#selectTam option[value="'+iden+'"]').prop("selected", false);
  $("#selectTam").css('display', 'none');
  $("#selectTam").css('display', 'block');
  $('#selectTam').select2();
  $(this).parents('tr').remove();
});

$('body').on('click', 'a.editRow', function() {
  $( "#guardarEditarProductoMadre" ).prop( "disabled", false );
  $( "#guardarProductoMadre" ).prop( "disabled", true );
  $("#guardarProductoMadre").css('display', 'none');
  $("#guardarEditarProductoMadre").css('display', 'block');
  var iden = $(this).attr('iden');
  var textTam = $(this).attr('textTam');
  $('#idTamProducto').val(iden);
  $('#textTamProducto').val(textTam);
  $(".modalCostos").val('0');
  //agregar costos al modal
  //var listaPreciosTabla = $('.listaPreciosTabla-'+iden).val();
  const listaPreciosTabla = document.getElementsByClassName('listaPreciosTabla-'+iden);
  var arraylistaPreciosTabla = new Array();
  for (let item of listaPreciosTabla) {
    arraylistaPreciosTabla.push(item.value);
  }
  const listaPreciosModal = document.getElementsByName("modalCostos"); 
  for (let i = 0; i < arraylistaPreciosTabla.length; i++) {
    const element = arraylistaPreciosTabla[i];
    listaPreciosModal[i].value=element;
  }
  
  $("#modalAgregarCostos").modal("show");
 
});


$('.btnAgregarSC').on('click',function(){
  var texto_seleccionado = $('#productoCategoria1 option:selected').html();
  $('#priCategoria').val(texto_seleccionado);
});

$('.btnAgregarPM').on('click',function(){
  $('#productoMadre').val('');
  $('#productoMadre').select2();
  $('.btnEditarPM').hide();
  $('.btnEliminarPM').hide();
  $('#agregarEditarProducto').show();
  $(".cantidadFrutasModal").hide();
  $("#cantidadFrutasModal").val('');
  $('.inputPrecioTransporte').hide();
  $('#precioTransporte').val('');
  $("#transporteNo").prop('checked', true);
  $("#transporteSi").prop('checked',false);
  var texto_seleccionado = $('#productoCategoria1 option:selected').html();
  var texto_seleccionado = $('#productoCategoria2 option:selected').html();
});

$('.btnEditarPM').on('click',function(){
      console.log('Cargando datos para editar');
      $('#agregarEditarProducto').show();
      $('.btnEditarPM').hide();
      $('.btnEliminarPM').hide();
      $('#agregarEditarProducto').show();
      $(".cantidadFrutasModal").hide();
      $("#cantidadFrutasModal").val('');
      $('.inputPrecioTransporte').hide();
      $('#precioTransporte').val('');
      $("#transporteNo").prop('checked', true);
      $("#transporteSi").prop('checked',false);

      $('#producto').val('');
      $('#detalleProducto').val('');
      $('#unidadMedida').val('');
      $('#unidadMedida').select2();
      $('#actividadEconomica').val('');
      $('#productoSIN').val('');
      var rutaImagen = "<?=base_url('assets/dist/img/default-image.jpg')?>";
      $(".previsualizar").attr("src", rutaImagen);

      //
      var id_producto_madre = $('#productoMadre').val();
      var datos = new FormData();
      datos.append("id_producto_madre",id_producto_madre);
      $.ajax({
          method:'POST',
          url:'<?=site_url("load-producto-madre")?>',
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success:function(respuesta){
            //console.log(respuesta);
            //console.log('Producto madre',respuesta.ID_PRODUCTO_MADRE);
            //console.log('respuesta',respuesta.resultado);
            var obj = JSON.parse(respuesta.resultado);
            //console.log(obj[0]);
            var idProdMadre = obj[0].ID_PRODUCTO_MADRE; 
            var prodMadre = obj[0].PRODUCTO_MADRE;
            var actEconomica = obj[0].CODIGO_ACTIVIDAD_ECONOMICA;
            var codProdSin = obj[0].CODIGO_PRODUCTO_SIN;
            var codUnidadMedida = obj[0].CODIGO_UNIDAD_MEDIDA;
            var imagen = obj[0].Imagenes;
            var transporte = obj[0].TRANSPORTE;
            var precioTransporte = obj[0].PRECIO_TRANSPORTE;
            var detalleProducto = obj[0].DETALLE;
            if(imagen){
              console.log('si imagen');
              $(".previsualizar").attr("src", "data:image/png;base64,"+imagen);
            }else{
              console.log('no existe imagen');
            }
            $('#detalleProducto').val(detalleProducto);
            $('#unidadMedida').val(codUnidadMedida);
            $('#unidadMedida').select2();
            $('#actividadEconomica').val(actEconomica);
            $('#productoSIN').val(codProdSin);
            if(transporte){
              $("#transporteNo").prop('checked', false);
              $("#transporteSi").prop('checked',true);
              $('#precioTransporte').val(precioTransporte);
              $('.inputPrecioTransporte').show();
            }else{
              console.log('no incluye transporte');
              $('#precioTransporte').val('0');
              $("#transporteNo").prop('checked', true);
              $("#transporteSi").prop('checked',false);
              $('.inputPrecioTransporte').hide();
            }
            console.log(obj[0]);
            console.log('Producto',prodMadre);
            if(prodMadre ==''){
              var texto_seleccionado = $('#productoMadre option:selected').html();
              prodMadre = texto_seleccionado;
            }
            $('#producto').val(prodMadre);
            cargarTablaPrecios(id_producto_madre);
            if(respuesta == 'ok'){
              Swal.fire({
                icon: 'success',
                title: 'Se ha registrado correctamente.',
                timer: 3500
              });
              window.location.href = "<?=current_url()?>";
            }
          }
      });
});

function cargarTablaPrecios(id_producto_madre){
  console.log('cargando precios');
  var datos = new FormData();
    datos.append("id_producto_madre",id_producto_madre);
    $.ajax({
        method:'POST',
        url:'<?=site_url("obtener-lista-precios")?>',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
          console.log(respuesta);
        }
    });
}

function guardarPrimeraCategoria(){
  var primera_categoria = $('#primeraCategoriaMPC').val();
  if(primera_categoria){
    var datos = new FormData();
    datos.append("nombre_pc",primera_categoria);
    $.ajax({
        method:'POST',
        url:'<?=site_url("guardar-primera-categoria")?>',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
          if(respuesta == 'ok'){
            Swal.fire({
              icon: 'success',
              title: 'Se ha registrado correctamente.',
              timer: 3500
            });
            window.location.href = "<?=current_url()?>";
          }
        }
    });
  }
  
}

function guardarSegundaCategoria(){
  var primera_categoria = $('#productoCategoria1').val();
  var segunda_categoria = $('#segundaCategoriaMSC').val();
  if(segunda_categoria){
    var datos = new FormData();
    datos.append("categoria_1",primera_categoria);
    datos.append("nombre_sc",segunda_categoria);
    $.ajax({
        method:'POST',
        url:'<?=site_url("guardar-segunda-categoria")?>',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
          if(respuesta == 'ok'){
            Swal.fire({
              icon: 'success',
              title: 'Se ha registrado correctamente.',
              timer: 3500
            });
            window.location.href = "<?=current_url()?>";
          }
        }
    });
  }
  
}

$("#nuevaFoto").change(function(){
  var img = $('#nuevaFoto').val();
  if(img == ''){
    var rutaImagen = "<?=base_url('assets/dist/img/default-image.jpg')?>";
    $(".previsualizar").attr("src", rutaImagen);
    return;
  }
var imagen = this.files[0];
/*=============================================
  VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  =============================================*/
  if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
    $(".nuevaFoto").val("");
     swal({
        title: "Error al subir la imagen",
        text: "¡La imagen debe estar en formato JPG o PNG!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });
  }else if(imagen["size"] > 2000000){
    $(".nuevaFoto").val("");
     swal({
        title: "Error al subir la imagen",
        text: "¡La imagen no debe pesar más de 2MB!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });
  }else{
    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function(event){
      var rutaImagen = event.target.result;
      $(".previsualizar").attr("src", rutaImagen);
    })
  }
})

function imprimirDetalleTurno(){
  var url= "<?=site_url('imprimir-detalle-turno')?>";
  window.open(url,'_blank');
}

</script>

