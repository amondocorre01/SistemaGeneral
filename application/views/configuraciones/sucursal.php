<br>
<div class="card card-outline card-danger">
  <div class="card-header">
    <h3 class="card-title">Configuracion</h3>
    <div class="card-tools">
      <!-- Buttons, labels, and many other things can be placed here! -->
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
  <div id="responsiveTabsDemo">
      <ul>
        <?php foreach ($sucursales as $sucursal) : ?>
          <li><a href="#tab-<?=$sucursal->ID_UBICACION?>"> <?=$sucursal->DESCRIPCION?> </a></li>
        <?php endforeach; ?>
      </ul>

        <?php
            $sql_cat = "EXEC GET_CATEGORIAS ";
            $res_cat = $this->db->query($sql_cat)->result();
        ?>      

      <?php foreach ($sucursales as $sucursal) : ?>
        
      <?php     
            $data['nombre_sucursal'] = $sucursal->DESCRIPCION;
            $data['codigo'] = $sucursal->CODIGO;
            $data['id']= $sucursal->ID_UBICACION;
            $data['categorias'] = $res_cat;

            $data['factura'] = $sucursal->MENSAJE_FACTURA;
            $data['recibo'] = $sucursal->MENSAJE_RECIBO;
            $data['comanda'] = $sucursal->MENSAJE_COMANDA;
            $data['impresora'] = $sucursal->IMPRESORA;
            
            $this->load->view('configuraciones/sucursal/dosificacion', $data, FALSE);
        ?>  
      <?php endforeach; ?>
        
</div>
   
</div>
  </div>
</div>
<!-- /.card -->

<script>
  $('#responsiveTabsDemo').responsiveTabs({
    startCollapsed: 'accordion'
});
</script>