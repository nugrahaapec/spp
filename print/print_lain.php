<?php
require '../conn/config.php';
include '../dist/cek.php';
include '../dist/indo1.php';
include '../dist/header.php';
$kelas = $_GET['kelas'];
$tgl_awal = $_GET['tgl_awal'];
$tgl_akhir = $_GET['tgl_akhir'];

$query = mysqli_query($koneksi, "SELECT * FROM siswa 
INNER JOIN lain_pay_proses ON siswa.nisn = lain_pay_proses.nisn
INNER JOIN pos ON lain_pay_proses.id_pay = pos.id_pos
INNER JOIN kelas ON siswa.kelas = kelas.id_kelas
WHERE siswa.kelas = '$kelas' AND tanggal BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "' AND status_pay = '1' ");
while ($data = mysqli_fetch_array($query)) {
?>


    <div class="invoice">
        <div class="row no-print">
            <div class="col-12">
                <a href="javascript:window.print()" rel="noopener" class="btn btn-success float-right"><i class="fas fa-print"></i> Print</a>
            </div>
        </div>
        <div class="row">
            <div class="col-2 invoice-col">
                <img src="../logo/logo.png" style="width: 150px;">
            </div>
            <div class="col-10 mt-4">
                <label style="margin-bottom:-10px; font-size:35px;">SMK MEDICAL HIGH SCHOOL</label><br>
                JL. Raya Munjul No.2, RT.3/RW.1, Kec. Cipayung, Kota Jakarta Timur,
                Daerah Khusus Ibukota Jakarta 13850<br>
                Telp : 021-84597132 || Email : info@smkmhs.sch.id || Website : smkmhs.sch.id
            </div>
        </div>
        <hr style="border-top:solid 2px;">
        <p>
            <strong style="font-size: 25px;">LAPORAN PEMBAYARAN SISWA KELAS <?= $data['nama_kelas'] ?></strong>
            <br>
        <div class="invoice-col">
            <address>
                <label style="width:130px;">Tanggal Cetak</label>
                <label>:</label>
                <label><?= tgl_indo(date('Y-m-d')) ?></label><br>
                <label style="width:130px;">Jam Cetak</label>
                <label>:</label>
                <label><?= date("G:i"); ?></label><br>
            </address>
        </div>
        <div class="col-12 table-responsive">
            <table class="table">
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
                        WHERE siswa.kelas = '$kelas' AND tanggal BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "' AND status_pay = '1' ");
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
                        $query = mysqli_query($koneksi, "SELECT SUM(biaya) AS total FROM lain_pay_proses WHERE id_kelas_pay = '$kelas' AND tanggal BETWEeN '" . $tgl_awal . "' AND '" . $tgl_akhir . "'");
                        $data = mysqli_fetch_array($query);
                        ?>
                        <td colspan="5">
                            <center><b>Total</b></center>
                        </td>
                        <th class="numeric" align="left"><?= $data['total'] ?></th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mt-5">
            <div class="col-9">
            </div>
            <div class="col-3">
                <strong>
                    <div>
                        Mengetahui, <br><br><br><br><br>
                        <?= $_SESSION['nama'] ?> <br>
                        Bendahara Sekolah
                    </div>
                </strong>
            </div>
        </div>

    <?php } ?>