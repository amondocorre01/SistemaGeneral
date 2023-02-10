<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo base_url('assets/dist/img/taza.png'); ?>">
  <title>Capresso</title>

  <!-- SWEET ALERT 2-->
    <?=link_tag(base_url('node_modules/sweetalert2/dist/sweetalert2.css'));?>
    <script src="<?=base_url('node_modules/sweetalert2/dist/sweetalert2.js')?>"></script>
  
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
  <?=link_tag('node_modules/datatables.net-responsive-dt/css/responsive.dataTables.css')?>
  <script src="<?=base_url('node_modules/datatables.net/js/jquery.dataTables.js')?>"></script>
  
  <script src="<?=base_url('node_modules/datatables.net-responsive/js/dataTables.responsive.js')?>"></script>

  <script src="<?=base_url('node_modules/datatables.net-responsive-dt/js/responsive.dataTables.js')?>"></script>

  <script src="<?=base_url('node_modules/datatables.net-responsive/js/dataTables.responsive.js')?>"></script>
	<script src="<?= base_url('node_modules/datatables.net-responsive-dt/js/responsive.dataTables.js') ?>"></script>

  
  
 
  

  <!-- SELECT 2 @3.5.3-->
  <!--
  <?=link_tag(base_url('node_modules/select2/select2.css'))?>
  <?=link_tag('assets/plugins/select2-bootstrap4/select2-bootstrap4-theme/select2-bootstrap4.css')?>
  <script src="<?=base_url('node_modules/select2/select2.js')?>"></script>-->
  
  <?=link_tag(base_url('assets/plugins/select2/css/select2.min.css'))?>
  <?=link_tag(base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'))?>
   
  <script src="<?=base_url('node_modules/file-upload-with-preview/dist/file-upload-with-preview.min.js') ?>"></script>
<?=link_tag('node_modules/file-upload-with-preview/dist/file-upload-with-preview.min.css'); ?>

<!-- RESPONSIVE TABS -->
<script src="<?=base_url('node_modules/responsive-tabs/js/jquery.responsiveTabs.js')?>"></script>
  <?=link_tag('node_modules/responsive-tabs/css/responsive-tabs.css')?>
  <?=link_tag('node_modules/responsive-tabs/css/style.css')?>

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed 
<?php
  $title='';
  if(isset($collapse)){
    echo $collapse;
  }
?>
">








<!--<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed ">-->
<div class="wrapper">

  <!-- Preloader -->
  <div class="loading justify-content-center align-items-center">
    <img class="loading-image" src="<?php echo base_url('assets/dist/img/taza_loading.png'); ?>" alt="Loading..." />
  </div>


 
  <Script>

    $(document).ready(function () {
        $('.loading').hide();
    });

  </Script>