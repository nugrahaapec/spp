<?php
require '../conn/config.php';
include '../dist/cek.php';
include '../dist/header.php';
include '../dist/nav.php';
include '../dist/sidebar.php';
include '../dist/indo.php';
$tipe = $_GET['tipe'];

?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="content">
        <div class="container-fluid">
          <div class="col-sm-12">
            <div class="card card-outline card-success">
              <div class="card-header">
                <label>SETTING PEMBAYARAN</label>
              </div>
              <form action="set_pay" method="GET">
                <div class="card-body">
                  <div class="form-group row">
                    <input type="hidden" name="tipe" class="form-control" value="<?= $tipe ?>">
                    <label class="col-form-label" style="width:130px; margin-left: 80px;">Tahun Pelajaraan</label>
                    <label class="col-form-label">:</label>
                    <div class="col-sm-2">
                      <select name="tahun" id="tahun" class="form-control">
                        <?php
                        $query = mysqli_query($koneksi, "SELECT *FROM tahun");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                          <option value="<?= $data['id_tahun'] ?>"><?= $data['tahun_awal'] ?>/<?= $data['tahun_akhir'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <label class="col-form-label ml-2" style="width:100px;">Pembayaran</label>
                    <label class="col-form-label">:</label>
                    <div class="col-sm-2">
                      <select name="id" id="id" class="form-control">
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM pos_pay
                        INNER JOIN pos ON pos_pay.id_pos = pos.id_pos WHERE pay_tipe = 'Bulanan' GROUP BY pos.id_pos");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                          <option value="<?= $data['id_pos'] ?>"><?= $data['nama_pos'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <label class="col-form-label ml-2" style="width:50px;">Kelas</label>
                    <label class="col-form-label">:</label>
                    <div class="col-sm-2">
                      <select name="kelas" id="kelas" class="form-control">
                        <?php
                        $query = mysqli_query($koneksi, "SELECT *FROM kelas");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                          <option value="<?= $data['id_kelas'] ?>"><?= $data['nama_kelas'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <button type="submit" class=" btn btn-success col-xs-2 ml-3"><i class="fas fa-search"></i> Cari Data</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php
      if (isset($_GET['tahun']) && isset($_GET['kelas']) && isset($_GET['id']) && isset($_GET['tipe'])) {
        $kelas = $_GET['kelas'];
        $tahun = $_GET['tahun'];
        $id = $_GET['id'];
        $tipe = $_GET['tipe'];
      ?>
        <div class="content">
          <div class="container-fluid">
            <div class="col-sm-12">
              <div class="card card-outline card-success">
                <div class="card-header">
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM pos_pay
                        INNER JOIN pos ON pos_pay.id_pos = pos.id_pos WHERE pay_id = $id");
                  while ($data = mysqli_fetch_array($query)) {
                  ?>
                    <b>Edit Tagihan <?= $data['nama_pos'] ?> Per Siswa</b>
                  <?php } ?>
                </div>
                <div class="card-body">
                  <table class="table table-sm table-borderless">
                    <thead>
                      <tr>
                        <th>
                          No
                        </th>
                        <th>
                          NISN / NIS
                        </th>
                        <th>
                          Nama Siswa
                        </th>
                        <th>
                          Kelas
                        </th>
                        <th>
                          Pembayaran
                        </th>
                        <th>
                          Tahun Ajaran
                        </th>
                        <th>
                          Total Tagihan /Tahun
                        </th>
                        <th>
                          Aksi
                        </th>
                      </tr>
                    <tbody>
                      <?php $no = 1;
                      $query = mysqli_query($koneksi, "SELECT * FROM coba INNER JOIN siswa ON coba.nisn = siswa.nisn 
                        INNER JOIN kelas ON coba.id_kelas = kelas.id_kelas INNER JOIN pos ON coba.id_pos = pos.id_pos
                        INNER JOIN tahun ON coba.id_tahun = tahun.id_tahun WHERE coba.id_kelas = $kelas AND coba.id_tahun = $tahun AND coba.id_pos = '$id' GROUP BY coba.nisn");
                      while ($data = mysqli_fetch_array($query)) : ?>
                        <tr>
                          <td style="width: 50px;"><?= $no++; ?></td>
                          <td style="width: 250px;"><?= $data['nisn'] ?> / <?= $data['nis'] ?></td>
                          <td style="width: 300px;"><?= $data['nama_siswa'] ?></td>
                          <td><?= $data['nama_kelas'] ?></td>
                          <td><?= $data['nama_pos'] ?></td>
                          <td><?= $data['tahun_awal'] ?>/<?= $data['tahun_akhir'] ?></td>
                          <td class="numeric"><?= $data['biaya'] * 12 ?></td>
                          <td>
                            <a href="edit_set_pay?id=<?= $id ?>&nisn=<?= $data['nisn'] ?>&kelas=<?= $data['id_kelas'] ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                          </td>
                        </tr>
                    <?php endwhile;
                    } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <?php include '../dist/footer.php' ?>