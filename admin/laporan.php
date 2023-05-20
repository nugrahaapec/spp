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
            <div class="content">
                <div class="container-fluid">
                    <div class="col-sm-12">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <label>Laporan Pembayaran Lain</label>
                            </div>
                            <form action="<?= $_SERVER["PHP_SELF"]; ?>" method="GET">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-form-label" style="width:80px; margin-left: 120px;">Pilih Kelas</label>
                                        <label class="col-form-label">:</label>
                                        <div class="col-sm-2">
                                            <select name="kelas" id="kelas" class="form-control">
                                                <option></option>
                                                <?php
                                                $query = mysqli_query($koneksi, "SELECT *FROM kelas");
                                                while ($data = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?= $data['id_kelas'] ?>"><?= $data['nama_kelas'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <label class="col-form-label ml-2" style="width:120px;"><i class="fas fa-calendar-check"> Tanggal Awal</i></label>
                                        <label class="col-form-label">:</label>
                                        <input type="text" name="tanggal_awal" id="reservationdate" class="form-control col-sm-2 ml-2" data-target="#reservationdate" data-toggle="datetimepicker"></input>
                                        <label class="col-form-label ml-3" style="width:120px;"><i class="fas fa-calendar-check"> Tanggal Akhir</i></label>
                                        <label class="col-form-label">:</label>
                                        <input type="text" name="tanggal_akhir" id="reservationdate2" class="form-control col-sm-2 ml-2" data-target="#reservationdate2" data-toggle="datetimepicker"></input>
                                        <button type="submit" class=" btn btn-success col-xs-2 ml-3"><i class="fas fa-search"></i> Cari Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_GET['kelas']) && isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir'])) {
                    $kelas = $_GET['kelas'];
                    $tanggal_awal = $_GET['tanggal_awal'];
                    $tanggal_akhir = $_GET['tanggal_akhir'];
                ?>

                    <div class="container-fluid">
                        <div class="col-sm-12">
                            <div class="card card-outline card-success">
                                <div class="card-header">
                                    <label>Detail Laporan</label>
                                    <a href="../print/print_lain?kelas=<?= $kelas ?>&tgl_awal=<?= $tanggal_awal ?>&tgl_akhir=<?= $tanggal_akhir ?>" target="blank"><button class="btn btn-success btn-xs float-right"><i class="fas fa-print"> Cetak Laporan </i></button></a>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
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
                                                    Pembayaran
                                                </th>
                                                <th>
                                                    Tanggal Pembayaran
                                                </th>
                                                <th>
                                                    Jumlah Bayar
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $query = mysqli_query($koneksi, "SELECT * FROM siswa 
                                            INNER JOIN lain_pay_proses ON siswa.nisn = lain_pay_proses.nisn
                                            INNER JOIN pos ON lain_pay_proses.id_pay = pos.id_pos
                                            INNER JOIN kelas ON siswa.kelas = kelas.id_kelas
                                            WHERE siswa.kelas = '$kelas' AND tanggal BETWEeN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "' AND status_pay = '1' ");
                                            while ($data = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $data['nama_siswa'] ?></td>
                                                    <td><?= $data['nama_kelas'] ?></td>
                                                    <td><?= $data['nama_pos'] ?></td>
                                                    <td><?= tgl_indo(date($data['tanggal'])) ?></td>
                                                    <td class="numeric"><?= $data['biaya'] ?></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <?php
                                                $query = mysqli_query($koneksi, "SELECT SUM(biaya) AS total FROM lain_pay_proses WHERE id_kelas_pay = '$kelas' AND tanggal BETWEeN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "'");
                                                $data = mysqli_fetch_array($query);
                                                ?>
                                                <th colspan="5">
                                                    <center>Total</center>
                                                </th>
                                                <th class="numeric" align="left"><?= $data['total'] ?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include '../dist/footer.php';
