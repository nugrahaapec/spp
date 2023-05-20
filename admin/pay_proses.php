<?php
require '../conn/config.php';
include '../dist/cek.php';
include '../dist/header.php';
include '../dist/nav.php';
include '../dist/sidebar.php';
include '../dist/indo.php';

$id = $_GET['id'];
$nisn = $_GET['nisn'];
$kelas = $_GET['kelas'];

$query = mysqli_query($koneksi, "SELECT * FROM coba INNER JOIN siswa ON coba.nisn = siswa.nisn 
INNER JOIN kelas ON coba.id_kelas = kelas.id_kelas INNER JOIN pos ON coba.id_pos = pos.id_pos
INNER JOIN tahun ON coba.id_tahun = tahun.id_tahun WHERE coba.nisn = $nisn AND coba.id_pos = '$id'");
while ($data = mysqli_fetch_array($query)) {


?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-5">
                        <div class="card card-outline card-success">
                            <div class="card-header"><strong>
                                    <label> Detail Informasi Siswa </label>
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
                                    <label class="col-form-label" style=width:150px;>Nama Siswa</label>
                                    <label class="col-form-label">:</label>
                                    <div class="col-sm-8">
                                        <?php
                                        $query = "SELECT * FROM siswa WHERE nisn ='$nisn'";
                                        $result = $koneksi->query($query);
                                        if (!$result) {
                                            printf("Errormessage: %s\n", $koneksi->error);
                                        }
                                        while ($data = $result->fetch_array(MYSQLI_ASSOC)) {
                                        ?>
                                            <input type="text" class="form-control" placeholder="<?= $data['nama_siswa']; ?>" readonly>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label" style=width:150px;>Kelas</label>
                                    <label class="col-form-label">:</label>
                                    <div class="col-sm-8">
                                        <?php
                                        $query = "SELECT * FROM kelas WHERE id_kelas = '$kelas'";
                                        $result = $koneksi->query($query);
                                        $data = $result->fetch_array(MYSQLI_ASSOC)
                                        ?>
                                        <input type="text" class="form-control" placeholder="<?= $data['nama_kelas']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-7">
                        <div class="card card-outline card-success">
                            <div class="card-header"><strong>
                                    <label> Proses Pembayaran </label>
                                </strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>SPP Bulan</th>
                                            <th>Proses</th>
                                            <th>Tanggal Pembayaran</th>
                                            <th>Keeterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($koneksi, "SELECT * FROM coba 
                                    INNER JOIN siswa ON coba.nisn = siswa.nisn
                                    INNER JOIN kelas ON coba.id_kelas =  kelas.id_kelas
                                    INNER JOIN tahun ON coba.id_tahun = tahun.id_tahun
                                    INNER JOIN pos ON coba.id_pos = pos.id_pos
                                    INNER JOIN bulan ON coba.id_bulan = bulan.id_bulan WHERE coba.nisn = '$nisn' AND coba.id_kelas = '$kelas' AND coba.id_pos = '$id'");
                                        while ($data = mysqli_fetch_array($query)) {
                                        ?>
                                            <tr>
                                                <td><?= $data['nama_bulan'] ?></td>
                                                <td><?php
                                                    if ($data['status_pay'] == 0) {
                                                        echo "
                                                            <a href='../moduls/pay_bulan?id=$data[id_bulan]&nisn=$data[nisn]&pos=$data[id_pos]&tgl=" . date($data['tanggal']) . "'><span title='Tolak'>
                                                            <button class='btn btn-info btn-xs' data-toggle='tooltip' title='Bayar' onclick='return bayar()'> 
                                                            <i class='fas fa-money-check-alt'></i> &nbsp; Proses Pembayaran &nbsp;
                                                            </button></span></a>";
                                                    } elseif ($data['status_pay'] == 1) {
                                                        echo "<a href='../moduls/pay_bulan?id=$data[id_bulan]&nisn=$data[nisn]&pos=$data[id_pos]&status=$data[status_pay]&tgl=" . date($data['tanggal']) . "'><button class='btn btn-danger btn-xs' data-toggle='tooltip' title='Cancle' 
                                                        onclick='return cancle()'> <i class='fas fa-money-check-alt'></i> &nbsp; Batalkan Pembayaran &nbsp;
                                                            </button></a>";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($data['status_pay'] == 0) {
                                                        echo "";
                                                    } elseif ($data['status_pay'] == 1) {
                                                        echo "" . tgl_indo(date($data['tanggal'])) . "";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($data['status_pay'] == 0) {
                                                        echo "SPP Bulan $data[nama_bulan] Belum Dibayar";
                                                    } elseif ($data['status_pay'] == 1) {
                                                        echo "Sudah Dibayaarkan";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="update" id="update" class="btn btn-primary">Simpan</button>
                                <a href="javascript:window.history.go(-1);" type="button" class="btn btn-warning">Batal</a>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../dist/footer.php' ?>