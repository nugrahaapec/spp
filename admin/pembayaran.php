<?php
require '../conn/config.php';
include '../dist/cek.php';
include '../dist/header.php';
include '../dist/nav.php';
include '../dist/sidebar.php';
include '../dist/indo.php';
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Transaksi Pembayaran Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active">Pembayaran</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="col-sm-12">
        <div class="card card-outline card-success">
          <form action="pembayaran" method="GET">
            <div class="card-body">
              <a href="master_siswa" class="btn btn-danger btn-sm pull-right"><i class="fas fa-graduation-cap"></i>&nbsp; Referensi Data Siswa</a>
              <div class="input-group float-md-right col-4">
                <input type="number" name="cari" class="form-control form-control-sm" placeholder="Masukan NISN / NIS Siswa" required></input>
                <div class="input-group-append">
                  <button type="submit" class="btn btn-success btn-sm float-right" value="cari"><i class="fas fa-search"></i> &emsp14; Cari Data</button>
                </div>
              </div>
            </div>
        </div>
      </div>
      </form>
    </div>


    <?php
    if (isset($_GET['cari'])) {
      $cari = $_GET['cari'];
      $query = mysqli_query($koneksi, "SELECT * FROM siswa INNER JOIN tahun ON tahun.id_tahun = siswa.id_tahun INNER JOIN kelas ON kelas.id_kelas = siswa.Kelas 
      WHERE siswa.nisn =$cari AND siswa.status = '1'");
      while ($r = mysqli_fetch_array($query)) :
    ?>
        <div class="content">
          <div class="container-fluid">
            <div class="col-sm-12">
              <div class="card card-outline card-success">
                <div class="card-header">
                  <b>Informasi Siswa</b>
                </div>
                <div class="card-body table-sm table-borderless">
                  <table class="table text-nowrap">
                    <table class="table table-borderless">
                      <tbody>
                        <tr>
                          <td width="200px;">Tahun Pelajaran</td>
                          <td width="4">:</td>
                          <td><strong><?= $r['tahun_awal'] ?>/<?= $r['tahun_akhir'] ?><strong></strong></strong></td>

                        </tr>
                        <tr>
                          <td>NISN / NIS</td>
                          <td>:</td>
                          <td><?= $r['nisn'] ?> / <?= $r['nis'] ?></td>
                        </tr>
                        <tr>
                          <td>Nama Siswa</td>
                          <td>:</td>
                          <td><?= $r['nama_siswa'] ?></td>
                        </tr>
                        <tr>
                          <td>Kelas</td>
                          <td>:</td>
                          <td><?= $r['nama_kelas'] ?></td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>

              <div class="card card-outline card-success">
                <div class="card-header">
                  <b>Riwayat Pembayaran Terakhir</b>
                  <a href="../print/print_all?nisn=<?= $cari ?>" target="blank"> <button type="button" class="btn btn-success btn-sm float-right"><i class="fas fa-print"></i> &emsp14; Cetak Seluruh Pembayaran</button></a>
                </div>
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <table class="table table-borderless-sm table-head-fixed text-nowrap">
                    <thead class="table=bordered">
                      <tr>
                        <th>Nama Pembayaran</th>
                        <th>Jumlah DIbayarkan </th>
                        <th>Tanggal Pembayaran</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = mysqli_query($koneksi, "SELECT * FROM siswa 
                     INNER JOIN coba ON siswa.nisn = coba.nisn
                     INNER JOIN pos ON coba.id_pos = pos.id_pos
                     INNER JOIN bulan ON coba.id_bulan = bulan.id_bulan
                     INNER JOIN tahun ON coba.id_tahun = tahun.id_tahun
                     WHERE siswa.nisn = '$cari' AND coba.status_pay ='1'");
                      while ($data = mysqli_fetch_array($query)) {
                      ?>
                        <tr>
                          <td><?= $data['nama_pos'] ?> Bulan <?= $data['nama_bulan'] ?> <?= $data['tahun_awal'] ?> </td>
                          <td class="numeric"><?= $data['biaya'] ?> </td>
                          <td><?= tgl_indo(date($data['tanggal'])) ?></td>
                        </tr>
                      <?php } ?>
                      <?php
                      $query = mysqli_query($koneksi, "SELECT * FROM siswa 
                     INNER JOIN lain_pay_proses ON siswa.nisn = lain_pay_proses.nisn
                     INNER JOIN pos ON lain_pay_proses.id_pay = pos.id_pos
                     WHERE siswa.nisn = '$cari' AND lain_pay_proses.status_pay ='1' ORDER BY tanggal DESC  ");
                      while ($data = mysqli_fetch_array($query)) {
                      ?>
                        <tr>
                          <td><?= $data['nama_pos'] ?></td>
                          <td class="numeric"><?= $data['biaya'] ?> </td>
                          <td><?= tgl_indo(date($data['tanggal'])) ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>


              <div class="card card-outline card-success">
                <div class="card-header">
                  <b>Pilih Pembayaran</b>
                </div>
                <div class="card-body">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#bulanan" data-toggle="tab"><i class="fas fa-shopping-cart"></i> Bulanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#lainnya" data-toggle="tab"><i class="fas fa-shopping-cart"></i> Lain-lain</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="bulanan">
                      <table class="table table-sm table-borderless text-wrap">
                        <thead>
                          <tr>
                            <th>Nama Pembayaran</th>
                            <th>Tahun Pelajaran</th>
                            <th>Proses Pembayaran</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $s = mysqli_query($koneksi, "SELECT *
                                     FROM coba INNER JOIN siswa ON coba.nisn = siswa.nisn
                                    INNER JOIN tahun ON coba.id_tahun = tahun.id_tahun INNER JOIN pos ON coba.id_pos = pos.id_pos
                                    WHERE siswa.nisn = '$cari' GROUP BY coba.id_pos");
                          while ($data = mysqli_fetch_array($s)) {
                          ?>

                            <tr>
                              <td> <?= $data['nama_pos'] ?> </td>
                              <td> <?= $data['tahun_awal'] ?>/<?= $data['tahun_akhir'] ?> </td>
                              <td> <a href="pay_proses?id=<?= $data['id_pos'] ?>&nisn=<?= $data['nisn'] ?>&kelas=<?= $data['kelas'] ?> "> <button class='btn btn-info btn-xs' data-toggle='tooltip' title='Bayar'>
                                    <i class='fas fa-money-check-alt'></i> &nbsp; Bayar
                                  </button> </a></td>
                            <?php } ?>
                            </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="tab-pane" id="lainnya">
                      <table class="table table-sm table-borderless text-wrap">
                        <thead>
                          <tr>
                            <th>Nama Pembayaran</th>
                            <th>Total Tagihan</th>
                            <th>DIbayarkan</th>
                            <th>Status</th>
                            <th>Proses Pembayaran</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $s = mysqli_query($koneksi, "SELECT *
                                    FROM lain_pay INNER JOIN siswa ON lain_pay.nisn = siswa.nisn
                                    INNER JOIN tahun ON lain_pay.id_tahun = tahun.id_tahun 
                                    INNER JOIN pos ON lain_pay.id_pay = pos.id_pos
                                    WHERE lain_pay.nisn = '$cari' ");
                          while ($data = mysqli_fetch_array($s)) {
                          ?>
                            <tr>
                              <td> <?= $data['nama_pos'] ?> T.A <?= $data['tahun_awal'] ?>/<?= $data['tahun_akhir'] ?> </td>
                              <td class="numeric"><?= $data['bill_pay'] - $data['bill_pay_cash'] ?></td>
                              <td class="numeric"><?= $data['bill_pay_cash'] ?> </td>
                              <td><?php
                                  if ($data['bill_pay'] - $data['bill_pay_cash'] == 0) {
                                    echo "<button class='btn btn-success btn-xs view_list' data-toggle='tooltip' title='Bayar' data-id_pay=" . $data['id_pay'] . " data-nisn_siswa=" . $data['nisn'] . "> 
                                      Sudah Lunas
                                      </button>";
                                  } elseif ($data['bill_pay'] > 0) {
                                    echo "<button class='btn btn-danger btn-xs view_list' data-toggle='tooltip' title='Bayar' data-id_pay=" . $data['id_pay'] . " data-nisn_siswa=" . $data['nisn'] . "> 
                                      Belum Lunas
                                      </button>";
                                  }
                                  ?>
                              </td>
                              <td>
                                <?php
                                if ($data['bill_pay'] - $data['bill_pay_cash'] == 0) {
                                  echo "<button class='btn btn-info btn-xs view_data' data-toggle='tooltip' title='Tidak Ada Pembayaran' disabled> 
                                    <i class='fas fa-money-check-alt'></i> &nbsp; Tidak Ada Pembayaran 
                                    </button>";
                                } elseif ($data['bill_pay'] > 0) {
                                  echo "<button class='btn btn-info btn-xs view_data' data-toggle='tooltip' title='Bayar' data-id=" . $data['id_pay'] . " data-nisn=" . $data['nisn'] . "> 
                                    <i class='fas fa-money-check-alt'></i> &nbsp; Bayar
                                    </button>";
                                }
                                ?>
                              </td>
                            <?php } ?>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php
      endwhile;
    }
        ?>
          </div>
        </div>
  </div>
</div>


<?php include '../dist/footer.php' ?>

<div id="modal-default1" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <label class="modal-title">List Pembayaran</label>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="bayar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Proses Pembayaran </h4>
      </div>
      <form action="../moduls/add_lainpay_proses" method="POST" id="fbayar">
        <div class="modal-body" id="tampil">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    </form>
  </div>
</div>
</div>

<div class="modal fade" id="lihat">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">List Pembayaran </h4>
      </div>
      <div class="modal-body" id="data_list">

      </div>
    </div>
    </form>
  </div>
</div>
</div>

<script>
  $(document).ready(function() {
    $('.view_data').click(function() {
      var data_id = $(this).data("id")
      var data_nisn = $(this).data("nisn")
      $.ajax({
        url: "../moduls/select",
        method: "POST",
        data: {
          data_id: data_id,
          data_nisn: data_nisn
        },
        success: function(data) {
          $("#tampil").html(data)
          $("#bayar").modal('show')
        }
      })
    })
  })
</script>

<script>
  $(document).ready(function() {
    $('.view_list').click(function() {
      var id_pay = $(this).data("id_pay")
      var nisn_siswa = $(this).data("nisn_siswa")
      $.ajax({
        url: "../moduls/select",
        method: "POST",
        data: {
          id_pay: id_pay,
          nisn_siswa: nisn_siswa
        },
        success: function(data) {
          $("#data_list").html(data)
          $("#lihat").modal('show')
        }
      })
    })
  })
</script>