<?php
require '../conn/config.php';
include '../dist/cek.php';
include '../dist/header.php';
include '../dist/nav.php';
include '../dist/sidebar.php';
include '../dist/indo.php';
$date = date('m');
$tanggal = date('Y-m-d');
?>


<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <?php
        $result = $koneksi->query("SELECT COUNT(*) FROM coba WHERE nisn AND id_pos ='2' AND status_pay = '1' AND id_bulan = $date");
        $data = $result->fetch_row();
        ?>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="small-box bg-success">
            <div class="inner">
              <h3> <?= $data[0] ?> Siswa </h3>

              <p>Sudah Bayar SPP Bulan <?php echo indo(date('Y-m')); ?></p>
            </div>
            <div class="icon">
              <i class="fas fa-copy"></i>
            </div>
          </div>
        </div>

        <?php
        $result = $koneksi->query("SELECT COUNT(*) FROM coba WHERE nisn AND id_pos ='2' AND status_pay = '0' AND id_bulan = $date");
        $data = $result->fetch_row();
        ?>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3> <?= $data[0] ?> Siswa </h3>
              <p>Belum Bayar SPP Bulan <?php echo indo(date('Y-m')); ?></p>
            </div>
            <div class="icon">
              <i class="fas fa-bell"></i>
            </div>
          </div>
        </div>

        <?php
        $query = mysqli_query($koneksi, "SELECT SUM(biaya) AS total FROM coba WHERE nisn AND tanggal = '$tanggal' AND status_pay = '1'");
        $data = mysqli_fetch_array($query);
        $query1 = mysqli_query($koneksi, "SELECT SUM(biaya) AS total FROM lain_pay_proses WHERE nisn AND tanggal = '$tanggal' AND status_pay = '1'");
        $data1 = mysqli_fetch_array($query1);
        ?>
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="small-box bg-info">
            <div class="inner">
              <h3 class="numeric"><?= $data['total'] + $data1['total'] ?> </h3>

              <p>Total Pembayaran <?= tgl_indo(date('Y-m-d')) ?></p>
            </div>
            <div class="icon">
              <i class="fas fa-shopping-cart"></i>
            </div>
          </div>
        </div>

        <?php
        $result = $koneksi->query("SELECT COUNT(*) FROM siswa");
        $row = $result->fetch_row();
        ?>
        <div class="col-12 col-sm-6 col-md-3">
          <a href="master_siswa" class="small-box bg-warning">
            <div class="inner">
              <h3><?= $row['0'] ?> </h3>
              <p>Jumlah Siswa</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-graduate"></i>
            </div>
          </a>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <label>Informasi</label>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="card-header bg-warning">
                    <strong>Pembayaaran Siswa Terbaru</strong>
                  </div>
                  <div class="card-body">
                    <table id="example2" class="table table-reaponsive">
                      <thead>
                        <tr>
                          <th>
                            No
                          </th>
                          <th>
                            Nama Siswa
                          </th>
                          <th>
                            Kelas
                          </th>
                          <th>
                            Keterangan
                          </th>
                          <th>
                            Tanggal Pembayaran
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM siswa 
                     INNER JOIN coba ON siswa.nisn = coba.nisn
                     INNER JOIN pos ON coba.id_pos = pos.id_pos
                     INNER JOIN bulan ON coba.id_bulan = bulan.id_bulan
                     INNER JOIN tahun ON coba.id_tahun = tahun.id_tahun
                     INNER JOIN kelas ON kelas.id_kelas = siswa.kelas
                     WHERE coba.status_pay ='1' ORDER BY tanggal DESC");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['nama_siswa'] ?></td>
                            <td><?= $data['nama_kelas'] ?> </td>
                            <td>Pembayaran <?= $data['nama_pos'] ?> Bulan <?= $data['nama_bulan'] ?> <?= $data['tahun_awal'] ?> </td>
                            <td><?= tgl_indo(date($data['tanggal'])) ?></td>
                          </tr>
                          </tr>
                        <?php } ?>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM siswa 
                     INNER JOIN lain_pay_proses ON siswa.nisn = lain_pay_proses.nisn
                     INNER JOIN pos ON lain_pay_proses.id_pay = pos.id_pos
                     INNER JOIN kelas ON siswa.kelas = kelas.id_kelas
                     WHERE lain_pay_proses.status_pay ='1' ORDER BY tanggal DESC");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['nama_siswa'] ?></td>
                            <td><?= $data['nama_kelas'] ?> </td>
                            <td>Pembayaran <?= $data['nama_pos'] ?> </td>
                            <td><?= tgl_indo(date($data['tanggal'])) ?></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
  </section>
</div>
</body>


<?php include '../dist/footer.php' ?>