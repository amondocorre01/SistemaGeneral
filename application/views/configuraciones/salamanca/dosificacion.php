<div id="tab-<?=$id?>"> 
        <h2><?=$nombre_sucursal?></h2>

      <div id="opciones-salamanca">

          <ul>
              <li><a href="#opcion-2-salamanca<?=$id?>"> Impresion </a></li>
              <li><a href="#opcion-4-salamanca<?=$id?>"> Mensajes </a></li>
          </ul>
    
          <div id="opcion-2-salamanca<?=$id?>">
            <?php echo $this->load->view('configuraciones/salamanca/impresion', null, TRUE);?> 
          </div>
          <div id="opcion-4-salamanca<?=$id?>"> 

          <?php echo $this->load->view('configuraciones/salamanca/mensaje', null, TRUE);?> 
          </div>
      </div>
</div>

<script>

  $('#opciones-salamanca').responsiveTabs({
      startCollapsed: 'accordion'
  });

  var show_update = 0;

  function message_pando(id) {

    var factura = $('#messageFact').val();
    var recibo = $('#messageRecibo').val();
    var comanda = $('#messageComanda').val();


    $.post("<?=site_url('set-message-salamanca')?>", {id:id, factura:factura, recibo:recibo, comanda:comanda })
    .done(function( data ) {

      Swal.fire({
          icon: 'success',
          title: 'Se ha actualizado los mensajes correctamente',
          timer: 3500
      });
    });
  }
               
</script>