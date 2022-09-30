<br>
<div class="card card-outline card-danger">
  <div class="card-header">
    <h3 class="card-title">Default Card Example</h3>
    <div class="card-tools">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span class="badge badge-primary">Label</span>
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
    <?php switch ($sucursal->ID_UBICACION) {
      case '2':
        $data['columns'] = $this->db->query("select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='DOSIFICACION_F'")->result();
        $data['nombre_sucursal'] = $sucursal->DESCRIPCION;
        $data['id']= $sucursal->ID_UBICACION;
        $data['categorias'] = $res_cat;

        
        $this->load->view('configuraciones/pando/dosificacion', $data, FALSE);
      break;

      case '4':
        $data['columns'] = $this->db->query("select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='DOSIFICACION_F'")->result();
        $data['nombre_sucursal'] = $sucursal->DESCRIPCION;
        $data['id']= $sucursal->ID_UBICACION;
        $this->load->view('configuraciones/salamanca/dosificacion', $data, FALSE);
      break;
      
      default:
        # code...
        break;
    } ?>
  <?php endforeach; ?>      
</div>
   
</div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    The footer of the card
  </div>
  <!-- /.card-footer -->
</div>
<!-- /.card -->




<script>
  $('#responsiveTabsDemo').responsiveTabs({
    startCollapsed: 'accordion'
});
</script>