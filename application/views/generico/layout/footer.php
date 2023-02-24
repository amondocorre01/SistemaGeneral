<!--<footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="https://www.capressocafe.com/">Capresso Cafe</a>.</strong>
    Todos los derechos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>-->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url('assets/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

<!-- DataTables  & Plugins -->
<?php
  if(isset($_SESSION['datatable'])): ?>
    <script src="<?=base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jszip/jszip.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/pdfmake/pdfmake.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/pdfmake/vfs_fonts.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.print.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')?>"></script>
    <script>


    var totales = $("#example1").DataTable({
      "lengthChange": false,
      "autoWidth": false,
      "responsive": true,
      language:{ search: "Buscar", lengthMenu: "Mostrar _MENU_", zeroRecords: "No se encontró nada",
                    info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", infoEmpty: "No hay registros disponibles", 
                    infoFiltered: "(Filtrado de _MAX_ registros totales)", previous: "Anterior", oPaginate: { sNext:"Siguiente", sLast: "Último", sPrevious: "Anterior", sFirst:"Primero" },                  
                    }, 
      "buttons": [
      {
        extend:'pdfHtml5',
        text:'pdf',
        orientation: 'landscape',
        pageSize: 'LEGAL',
        title: '<?=$_SESSION['title']?>',
        download: 'open',
        exportOptions: {
        columns: ":not(.no-exportar)" //exportar toda columna que no tenga la clase no-exportar
        }
      },{
        extend:'excelHtml5',
        text:'excel',
        title: '<?=$_SESSION['title']?>',
        exportOptions: {
        columns: ":not(.no-exportar)" //exportar toda columna que no tenga la clase no-exportar
        }
      }
    ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('.buttons-pdf').attr('class','btn btn-secondary buttons-excel buttons-html5 btn-xs');
    $('.buttons-excel').attr('class','btn btn-secondary buttons-pdf buttons-html5 btn-xs');


    $(function () {
      $('.select2').select2()
    });

    </script>
    
  <?php 
  $this->session->unset_userdata('datatable');
  endif; 
?>

<!-- Sparkline -->
<script src="<?=base_url('assets/plugins/select2/js/select2.full.min.js')?>"></script>

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
<?php
  if(isset($_SESSION['form-validate'])): ?>
<!-- jquery-validation -->
<script src="<?=base_url('assets/plugins/jquery-validation/jquery.validate.js')?>"></script>
<script src="<?=base_url('assets/plugins/jquery-validation/additional-methods.min.js')?>"></script>
<script>
  
</script>
<?php 
  $this->session->unset_userdata('form-validate');
  endif; 
?>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/dist/js/adminlte.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets/dist/js/demo.js')?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- DAataTables-->
<!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <?=link_tag('https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css')?> -->
<!-- DATA TABLES -->

<script>
<?php if($this->input->get('vc')):?>
 const testData = document.getElementById("menunav_<?=$this->input->get('vc')?>");

 let superior = testData.getAttribute("data-sup");

 testData.style.color = "#dc3545";

 testData.style.fontWeight = "700";

 const testSuperior= document.getElementById("menunav_"+superior);
 if(testSuperior){
  testSuperior.style.color = "#FFFFFF";
 }

 

 //$( testSuperior ).parent().css( "background-color", "#dc3545" );

 $( testSuperior ).parent().addClass('menu-is-opening menu-open');
 $( testSuperior ).parent().parent().addClass('menu-is-opening menu-open');
<?php endif; ?>
 


</script>

   

</body>
</html>