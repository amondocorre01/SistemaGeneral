<?php
$tipo_usuario = $this->session->userdata('tipo_usuario');
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-link"><h5 class="m-0"><?=$tipo_usuario;?> 
      <?php
        if(isset($name_page)){
          echo '/ ';
          echo '<span class="name_sucursal">'.$name_page.'</span>';
        }
      ?>
      </h5></li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fa fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form id="formSearchProduct" class="form-inline" action="#" onsubmit="searchProduct(this);event.preventDefault();">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar inputSearchProduct" type="search" placeholder="Buscar" aria-label="Buscar">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fa fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fa fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
    <li class="nav-link"><?=$tipo_usuario?> / <a href="<?=base_url('index.php/generico/inicio')?>">inicio</a></li>
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments"></i>
          <span class="badge badge-danger navbar-badge">0</span>
        </a>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
      <?php if(isset($_SESSION['notification_ac'])):?>
        <a class="nav-link bell-danger" data-toggle="dropdown" href="#">
          <i class="fa fa-bell"></i>
          <span class="badge badge-danger navbar-badge">
              1
          </span>
        </a>
        <?php else:?>
          <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell"></i>
          <span class="badge badge-danger navbar-badge">
              0
          </span>
        </a>
        <?php endif;?>
        
        <?php if(isset($_SESSION['notification_ac'])){ ?>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="<?=$_SESSION['notification_ac_link']?>" class="dropdown-item">
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Administrador
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm"><?=$_SESSION['notification_ac']?></p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
        </div>
        <?php } ?>

      </li>
      
      <li class="nav-item">
        <a class="nav-link" alt="salir" href="<?php echo site_url('login/logout'); ?>">
          <i class="fa fa-sign-out"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <script src="<?php echo base_url('assets/dist/js/form-search-products.js'); ?>"></script>
  <script>
    function searchProduct($event){
      var text = $('.inputSearchProduct').val();
      $.ajax({
            type: "post",
            url: "<?=site_url('categoria-3')?>",
            data: {search: text},
            dataType: "html",
            success: function (response) {
                $('#categoria-1').hide('slow');
                $('#categoria-2').hide('slow');
                $('#categoria-3').empty();
                $('#categoria-3').show('slow');
                $('#categoria-3').append(response);
            }
        });
    }
  </script>