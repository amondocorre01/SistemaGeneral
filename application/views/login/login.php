<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo base_url('assets/dist/img/taza.png'); ?>">
  <title>Capresso</title>

  <!-- Font Awesome -->
  <?=link_tag(base_url('node_modules/font-awesome/css/font-awesome.css'))?>
  <!-- Theme style -->
  <?=link_tag('assets/dist/css/adminlte.min.css')?>
  <?=link_tag('assets/dist/css/login.css')?>
  <!-- Tempusdominus Bootstrap 4 -->
   <!-- Branding Font -->
   <?=link_tag(base_url('assets/dist/css/font.css'))?>
  <!-- Font Awesome -->
  <?=link_tag(base_url('node_modules/font-awesome/css/font-awesome.css'))?>
   <!-- Line - Awesone -->
   <?=link_tag(base_url('node_modules/line-awesome/dist/line-awesome/css/line-awesome.css'))?>
  <!-- Ionicons -->
  <?=link_tag(base_url('node_modules/@icon/ionicons/ionicons.css'))?>
  <!-- Tempusdominus Bootstrap 4 -->
  <?=link_tag(base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'))?>
  <!-- iCheck -->
  <?=link_tag(base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'))?>
  <!-- JQVMap -->
  <?=link_tag(base_url('assets/plugins/jqvmap/jqvmap.min.css'))?>
  <!-- Theme style -->
  <?=link_tag(base_url('assets/dist/css/adminlte.min.css'))?>
  <!-- overlayScrollbars -->
  <?=link_tag(base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'))?>
  <!-- Daterange picker -->
  <?=link_tag(base_url('assets/plugins/daterangepicker/daterangepicker.css'))?>
  <!-- summernote -->
  <?=link_tag(base_url('assets/plugins/summernote/summernote-bs4.min.css'))?>
   <!-- Mis Estilos-->
   <?=link_tag(base_url('assets/dist/css/mystyles.css'))?>
   <?=link_tag('assets/dist/css/mystyles.css')?>
   <?=link_tag('assets/dist/css/palette.css')?>
   <script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url('assets/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
<script src="<?=base_url('assets/dist/js/supervisor.js')?>"></script>
  <!-- links para exportar a excel -->
  <script src="<?=base_url('assets/dist/js/export-excel/xlsx.full.min.js')?>"></script>
  <script src="<?=base_url('assets/dist/js/export-excel/FileSaver.min.js')?>"></script>
  <script src="<?=base_url('assets/dist/js/export-excel/tableexport.min.js')?>"></script>

  <!-- DATA TABLES -->
  <script src="<?=base_url('node_modules/datatables.net/js/jquery.dataTables.js')?>"></script>
  <?=link_tag(base_url('node_modules/datatables.net-dt/css/jquery.dataTables.css'))?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <?=img(['src'=>'assets/dist/img/logo.png', 'alt'=>''])?>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"></p>
      <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
          <?= $this->session->flashdata('msg') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif ?>
      <?php if ($this->session->flashdata('msg-success')): ?>
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <?= $this->session->flashdata('msg-success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <?php endif ?>
        <?php 
        //$_SERVER['SERVER_ADDR']='www.google.com';
        //echo 'server:'.$_SERVER['SERVER_ADDR']; ?>
      <form action="<?php echo site_url('login/inicio'); ?>" method="post">
      <label>Usuario</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" required name="usuario" placeholder="Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-user"></span>
            </div>
          </div>
        </div>
        <label>Contraseña</label>
        <div class="input-group mb-3" id="show_hide_password" >
          <input type="password" class="form-control" required name="password" placeholder="Contraseña">
          <div class="input-group-append" >
            <div class="input-group-text" >
              <a href="#" class="link-view-password"><span class="fa fa-eye-slash"></span></a>
            </div>
          </div>
        </div>
                
        <div class="row">
            <div class="col-8"></div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <a>V. 1.0.5 General</a>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<div class="modal fade" id="modalImprimirCierreApertura">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Cierre de Caja</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="box-body">
                  
                  
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary">Imprimir</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!-- /.login-box -->

<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- Sparkline -->
<script src="<?=base_url('assets/plugins/sparklines/sparkline.js')?>"></script>
<!-- JQVMap -->
<script src="<?=base_url('assets/plugins/jqvmap/jquery.vmap.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url('assets/plugins/jquery-knob/jquery.knob.min.js')?>"></script>
<!-- daterangepicker -->
<script src="<?=base_url('assets/plugins/moment/moment.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/daterangepicker/daterangepicker.js')?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>"></script>
<!-- Summernote -->
<script src="<?=base_url('assets/plugins/summernote/summernote-bs4.min.js')?>"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/dist/js/adminlte.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets/dist/js/demo.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/dist/js/login.js'); ?>"></script>
<script type="text/javascript">
   $(document).ready(function() {
    <?php
      if(isset($_SESSION['data-imprimir'])){
        echo 'openPrintCierreCaja();';
      }
    ?>
   });
  
  function openPrintCierreCaja(){
    var url= "<?=site_url('imprimir-cierre-caja')?>";
      window.open(url,'_blank');
  }
</script>
</body>
</html>
