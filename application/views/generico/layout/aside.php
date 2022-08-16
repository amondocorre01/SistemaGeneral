<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div style="text-align:center; margin-top:1.5rem">
      <a href="#" class="center">
          <?=img(['src'=>'assets/dist/img/logo.png', 'alt'=>'Capresso', 'width'=>'60%' ,'style'=>'opacity: .8'])?>
      </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
           <?=img(['src'=>'assets/dist/img/user-200.png', 'class'=>'img-circle elevation-2', 'alt'=>'User Image'])?>
        </div>
        <div class="info">
				<a href="#" class="d-block"><?php echo $this->session->userdata('nombre'); ?></a>
			</div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?=$menu?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>