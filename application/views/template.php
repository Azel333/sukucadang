<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PT Tunas | TOYOTA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/skins/_all-skins.min.css">

  <script src="<?= base_url() ?>assets/sweet/sweetalert2.all.min.js"></script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?= base_url() ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b></b>TYT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>PT Tunas</b>TOYOTA</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            </a>
            <ul class="dropdown-menu">
              <ul class="menu">
                <li>
                  <!-- start message -->
                  <a href="#">
                    <div class="pull-left">
                    </div>
                  </a>
                </li>
                <!-- end message -->
              </ul>
            </ul>
            <!-- Notifications: style can be found in dropdown.less -->

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            </a>
            <ul class="dropdown-menu">
              <li class="header"></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">

                </ul>
              </li>
            </ul>
            </li>
            <!-- Tasks: style can be found in dropdown.less -->
            <li class="dropdown tasks-menu">
              <ul class="menu">
                <div class="progress xs">
                  <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                  </div>
                </div>


                <!-- end task item -->
            </li>
          </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?= $this->fungsi->user_login()->nama ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url() ?>assets/dist/img/tunas.jpeg" class="img" alt="User Image">
                <p> <?= $this->fungsi->user_login()->nama ?>
                </p>
                <small><?= ucfirst($this->fungsi->user_login()->jabatan) ?></small>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?= site_url('auth/logout') ?>" class="btn btn-flat bg-blue">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">

            <img src="<?= base_url() ?>assets/dist/img/tunas.jpeg" class="img" alt="User Image">
          </div>
          <div class="pull-left info">

            <p><?= ucfirst($this->fungsi->user_login()->nama) ?></p>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
          </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header"><?php echo $this->session->userdata('jabatan')?></li>
          <li>
            <a href="<?= site_url('dashboard') ?>"><i class="fa  fa-home"></i> <span>Halaman Utama</span></a>
          </li>
          <?php if ($this->session->userdata('jabatan') == 'Admin') { ?>
          <li>
            <a href="<?= site_url('user') ?>">
              <i class="fa fa-user"></i>
              <span>User</span>
              </span>
            </a>
            <!-- <li class="active treeview">
          <a href="<?= base_url('http://localhost/sukucadang/') ?>">
            <i class="fa  fa-home"></i> <span>Halaman Utama</span>
            <span class="pull-right-container">
             
            </span>
          </a> -->
          </li>
          <?php } if ($this->session->userdata('jabatan') == 'Service Advisor') { ?>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Permintaan</span>
                <span class="pull-right-container">
                  <span class="fa fa-angle-left pull-right"></span>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?= base_url() ?>permintaan"><i class="fa fa-edit"></i>Form Permintaan</a></li>
                <li class="active"><a href="<?= base_url() ?>permintaan/data"><i class="fa fa-table"></i>Data Permintaan</a></li>
              </ul>
            </li>
          <?php } else {
            if ($this->session->userdata('jabatan') == 'Gudang') { ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-cog"></i> <span>Suku Cadang</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active"><a href="<?= base_url() ?>sukucadang"><i class="fa fa-table"></i> Data Suku Cadang</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-cart-plus"></i> <span>Transaksi</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="<?= base_url() ?>permintaan/data"><i class="fa fa-table"></i>Suku Cadang Keluar </a></li>
              <li class="active"><a href="<?= base_url() ?>stock/in/"><i class="fa fa-edit"></i>Suku Cadang Masuk </a></li>
            </ul>
          </li>
              <?php } ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-arrows-v"></i> <span>Purchase Order</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="<?= base_url() ?>purchaseorder/datapo"><i class="fa fa-edit"></i> Data Purchase Order </a></li>
                <?php if ($this->session->userdata('jabatan') == 'Gudang') { ?>
              <li class="active"><a href="<?= base_url() ?>purchaseorder"><i class="fa fa-table"></i> Form Purchase Order </a></li>
              <?php } ?>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Laporan</span>
              <span class="pull-right-container">
                <span class="fa fa-angle-left pull-right"></span>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active"><a href="<?= base_url() ?>stock/stock_out_data"><i class="fa fa-book"></i> Laporan Keluar</a></li>
              <li class="active"><a href="<?= base_url() ?>stock/laporan_in_data"><i class="fa fa-book"></i> Laporan Masuk</a></li>
            </ul>
          </li>
          <?php if ($this->session->userdata('jabatan') == 'Gudang') { ?>
          <li class="active">
            <a href="<?= site_url('supplier') ?>"><i class="fa fa-truck"></i> <span>Data Supplier</span>
            </a>
          </li>
          <?php }} ?>

          <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php echo $contents ?>
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">

      </div>
      <strong>Copyright &copy; 2020 <a href="https://adminlte.io">Politeknik STMI Jakarta</a>.</strong> PT Tunas Toyota
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
          <h3 class="control-sidebar-heading">Recent Activity</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:void(0)">
                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                  <p>Will be 23 on April 24th</p>
                </div>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <i class="menu-icon fa fa-user bg-yellow"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                  <p>New phone +1(800)555-1234</p>
                </div>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                  <p>nora@example.com</p>
                </div>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <i class="menu-icon fa fa-file-code-o bg-green"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                  <p>Execution time 5 seconds</p>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

          <h3 class="control-sidebar-heading">Tasks Progress</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:void(0)">
                <h4 class="control-sidebar-subheading">
                  Custom Template Design
                  <span class="label label-danger pull-right">70%</span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                </div>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <h4 class="control-sidebar-subheading">
                  Update Resume
                  <span class="label label-success pull-right">95%</span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                </div>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <h4 class="control-sidebar-subheading">
                  Laravel Integration
                  <span class="label label-warning pull-right">50%</span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                </div>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <h4 class="control-sidebar-subheading">
                  Back End Framework
                  <span class="label label-primary pull-right">68%</span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
          <form method="post">
            <h3 class="control-sidebar-heading">General Settings</h3>

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Report panel usage
                <input type="checkbox" class="pull-right" checked>
              </label>

              <p>
                Some information about this general settings option
              </p>
            </div>
            <!-- /.form-group -->

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Allow mail redirect
                <input type="checkbox" class="pull-right" checked>
              </label>

              <p>
                Other sets of options are available
              </p>
            </div>
            <!-- /.form-group -->

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Expose author name in posts
                <input type="checkbox" class="pull-right" checked>
              </label>

              <p>
                Allow the user to show his name in blog posts
              </p>
            </div>
            <!-- /.form-group -->

            <h3 class="control-sidebar-heading">Chat Settings</h3>

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Show me as online
                <input type="checkbox" class="pull-right" checked>
              </label>
            </div>
            <!-- /.form-group -->

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Turn off notifications
                <input type="checkbox" class="pull-right">
              </label>
            </div>
            <!-- /.form-group -->

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Delete chat history
                <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
              </label>
            </div>
            <!-- /.form-group -->
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->


  <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?= base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
  <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
  <script src="<?= base_url() ?>assets/dist/js/demo.js"></script>

  <script src="<?= base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#table1').DataTable();

      <?php if($this->session->flashdata('alert_title')){ ?>
        swal.fire({
          title: "<?= $this->session->flashdata('alert_title'); ?>",
          html: "<?= $this->session->flashdata('alert_msg') ?? ""; ?>",
          icon: "<?= $this->session->flashdata('alert_icon') ?? "success"; ?>"
        });
      <?php } ?>
    });


  </script>

</body>

</html>