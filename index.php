<?php
require 'conn/config.php';
require 'dist/notback.php';
include 'header.php';

?>


<div class="hold-transition login-page">
  <div class="login-box">
    <?php
    if (isset($_GET['pesan'])) {
      if ($_GET['pesan'] == "logout") {
        echo "<div  class='alert alert-success alert-dismissible fade show'
         role='alert'><button type='button' class='close' data-dismiss='alert'
         aria-hidden='true'>x</button>Anda Berhasil Logout.</div>";
        echo "<meta http-equiv='refresh' content='2; url=index'>";
      }
    }
    ?>


    <?php
    if (isset($_GET['pesan'])) {
      if ($_GET['pesan'] == "gagal") {
        echo "<div class='alert alert-danger alert-dismissible fade show'
         role='alert'><button type='button' class='close' data-dismiss='alert'
         aria-hidden='true'>x</button>Username atau Password Salah</div>";
        echo "<meta http-equiv='refresh' content='2; url=index'>";
      }
    }
    ?>
    <!-- /.login-logo -->
    <div class="card card-outline card-success">
      <div class="card-header text-center">
        <img src="logo/logo.png" width="170" height=150">
        <br></br>
        <h4><b>Sistem Pembayaran Sekolah</b></h4>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Masukan Username dan Password</p>

        <form action="dist/login_act.php" method="post">
          <div class="input-group mb-3">
            <input type="text" name="uname" maxlength="50" class="form-control" placeholder="Username / Email" required />

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="pass" maxlength="50" class="form-control" placeholder="Password" required />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="social-auth-links text-right mt-4 mb-4">
            <button type="submit" name="login" class="btn btn-success">Masuk</button>
            <button type="reset" class="btn btn-warning">Batal</button>
          </div>
          <marquee class="mt-4"><b>SMK MEDICAL HIGH SCHOOL &copy; <?php echo date('Y'); ?></b></marquee>
        </form>