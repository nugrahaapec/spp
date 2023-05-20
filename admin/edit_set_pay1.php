<?php
require '../conn/config.php';
include '../dist/cek.php';
include '../dist/header.php';
include '../dist/nav.php';
include '../dist/sidebar.php';
include '../dist/indo.php';

$nisn = $_GET['nisn'];
$pos = $_GET['pos'];

$query = mysqli_query($koneksi, "SELECT * FROM lain_pay INNER JOIN siswa ON lain_pay.nisn = siswa.nisn 
INNER JOIN kelas ON lain_pay.id_kelas = kelas.id_kelas INNER JOIN pos ON lain_pay.id_pay = pos.id_pos
INNER JOIN tahun ON lain_pay.id_tahun = tahun.id_tahun WHERE lain_pay.nisn = $nisn AND lain_pay.id_pay = '$pos'");
$data = mysqli_fetch_array($query) ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-5">
          <div class="card card-outline card-success">
            <div class="card-header"><strong>
                <label> EDIT BIAYA PEMBAYARAN <?= strtoupper($data['nama_pos']); ?></label>
              </strong>
            </div>
            <div class="card-body">
              <div class="form-group row">
                <label class="col-form-label" style=width:150px;>Nama Pembayaran</label>
                <label class="col-form-label">:</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" placeholder="<?= $data['nama_pos']; ?> - <?= $data['tahun_awal']; ?>/<?= $data['tahun_akhir']; ?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label" style=width:150px;>Tahun Pelajaraan</label>
                <label class="col-form-label">:</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" placeholder="<?= $data['tahun_awal']; ?>/<?= $data['tahun_akhir']; ?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label" style=width:150px;>Tipe</label>
                <label class="col-form-label">:</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" placeholder="<?= $data['pay_tipe']; ?>" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-7">
          <div class="card card-outline card-success">
            <div class="card-header">
              <label>EDIT BIAYA SISWA A.N <?= strtoupper($data['nama_siswa']); ?></label>
            </div>
            <div class="card-body">
              <form action="../moduls/update_lainpay" method="POST">
                <div class="form-group row">
                  <label class="col-form-label" style=width:150px;>Nama Siswa</label>
                  <label class="col-form-label">:</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="<?= strtoupper($data['nama_siswa']); ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label" style=width:150px;>Kelas</label>
                  <label class="col-form-label">:</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="<?= $data['nama_kelas']; ?>" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-form-label" style=width:150px;>Biaya (Rp.)</label>
                  <label class="col-form-label">:</label>
                  <div class="col-sm-8">
                    <input type="hidden" class="form-control" name="nisn" id="nisn" value="<?= $data['nisn']; ?>">
                    <input type="text" class="form-control numeric" name="biaya" id="biaya" value="<?= $data['bill_pay']; ?>">
                  </div>
                </div>

                <div class="footer pt-3">
                  <button type="submit" name="simpan" id="simpan" value="simpan" class="btn btn-primary">Simpan</button>
                  <a href="javascript:history.go(-1)" type="button" class="btn btn-warning">Batal</a>
                </div>
              </form>
            </div>
          </div>
        </div>


        <?php include '../dist/footer.php' ?>

        <script>
          $(document).ready(function() {
            $('.numeric').inputmask("numeric", {
              removeMaskOnSubmit: true,
              radixPoint: ".",
              groupSeparator: ",",
              digits: 2,
              autoGroup: true,
              prefix: 'Rp ', //Space after $, this will not truncate the first character.
              rightAlign: false,
              // oncleared: function() {
              //   self.Value('');
              // }
            });
          });
        </script>