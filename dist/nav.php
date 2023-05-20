<?php
include '../dist/indo1.php';
?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="dropdown">

            <i class="fa fa-user">&nbsp; <?php echo $_SESSION['nama'] ?> </i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <i class="fas fa-calendar-alt"> <?php echo tgl_indo(date('Y-m-d')) ?></i>
          </a>
      </ul>
    </nav>
    <!-- /.navbar -->