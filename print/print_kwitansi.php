<?php
require '../conn/config.php';
include '../dist/cek.php';
include '../dist/header.php';
include '../dist/indo1.php';

$kelas = $_GET['kelas'];
$nisn = $_GET['nisn'];
$tanggal = $_GET['tanggal'];

$query1 = mysqli_query($koneksi, "SELECT * FROM siswa 
INNER JOIN kelas ON siswa.kelas = kelas.id_kelas
WHERE siswa.kelas = '$kelas' AND siswa.nisn = '$nisn'");
while ($data1 = mysqli_fetch_array($query1)) {
?>
    <div class="content-fluid">
        <div class="invoice p-3 mb-3">
            <div class="row">
                <div class="col-1 mt-1">
                    <img src="../logo/logo.png" style="height: 70px;"></img>
                </div>
                <div class="col-11">
                    <label> SMK MEDICAL HIGH SCHOOL </label><br>
                    JL. Raya Munjul No.2, RT.3/RW.1, Kec. Cipayung, Kota Jakarta Timur,
                    Daerah Khusus Ibukota Jakarta 13850<br>
                    Telp : 021-84597132 || Email : info@smkmhs.sch.id || Website : smkmhs.sch.id
                </div>
            </div>
            <hr style="border-top:solid 2px;">
            </hr>
            <br>
            <CENTER>
                <label style="font-size:25px ;"> KWITANSI PEMBAYARAN </label>
            </CENTER>
            <br>
            <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                    <address class="float-left">
                        <label style="width:130px;">NISN / NIS</label>
                        <label>:</label>
                        <label><?= $nisn ?></label><br>
                        <label style="width:130px;">Nama Siswa</label>
                        <label>:</label>
                        <label><?= $data1['nama_siswa'] ?></label><br>
                        <label style="width:130px;">Kelas</label>
                        <label>:</label>
                        <label><?= $data1['nama_kelas'] ?></label>
                    </address>
                </div>
                <div class="col-sm-6 invoice-col">
                    <address class="float-right">
                        <label style="width:130px;">Tanggal Cetak</label>
                        <label>:</label>
                        <label><?= tgl_indo(date('Y-m-d')) ?></label><br>
                        <label style="width:130px;">Jam Cetak</label>
                        <label>:</label>
                        <label><?= date("G:i"); ?></label><br>
                    </address>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th style="width: 22cm;">Nama Pembayaran</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query2 = mysqli_query($koneksi, "SELECT * FROM siswa 
                            INNER JOIN lain_pay_proses ON siswa.nisn = lain_pay_proses.nisn
                            INNER JOIN pos ON lain_pay_proses.id_pay = pos.id_pos
                            INNER JOIN kelas ON siswa.kelas = kelas.id_kelas
                            WHERE siswa.kelas = '$kelas' AND lain_pay_proses.nisn = '$nisn' AND lain_pay_proses.tanggal = '$tanggal'");
                        while ($data2 = mysqli_fetch_array($query2)) {
                        ?>
                            <tr>
                                <td><?= $data2['nama_pos'] ?> </td>
                                <td class="numeric"><?= $data2['biaya'] ?></td>
                            </tr>
                        <?php } ?>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM siswa 
                        INNER JOIN coba ON siswa.nisn = coba.nisn
                        INNER JOIN pos ON coba.id_pos = pos.id_pos
                        INNER JOIN kelas ON siswa.kelas = kelas.id_kelas
                        INNER JOIN bulan ON coba.id_bulan = bulan.id_bulan
                        INNER JOIN tahun ON coba.id_tahun = tahun.id_tahun
                        WHERE siswa.kelas = '$kelas' AND coba.nisn = '$nisn' AND coba.tanggal = '$tanggal' AND status_pay = '1'");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?= $data['nama_pos'] ?> Bulan <?= $data['nama_bulan'] ?> <?= $data['tahun_awal'] ?> </td>
                                <td class="numeric"><?= $data['biaya'] ?></td>
                            </tr>
                        <?php } ?>
                        <?php
                        $query1 = mysqli_query($koneksi, "SELECT SUM(biaya) AS total FROM coba WHERE nisn = '$nisn' AND id_kelas = '$kelas' AND tanggal = '$tanggal' AND status_pay = '1'");
                        $data1 = mysqli_fetch_array($query1);
                        $total1 = $data1['total'];

                        $query2 = mysqli_query($koneksi, "SELECT SUM(biaya) AS total FROM lain_pay_proses WHERE nisn = '$nisn' AND id_kelas_pay = '$kelas' AND tanggal = '$tanggal' AND status_pay = '1' ");
                        $data2 = mysqli_fetch_array($query2);
                        $total2 = $data2['total'];
                        ?>
                        <tr>
                            <td>
                                <center><b>Total</b></center>
                            </td>
                            <th class="numeric" align="left"><?= $total1 + $total2 ?></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-9">
                <br class="lead">Note : </br>
                <p> * Kwitansi ini sebagai bukti pembayaran yang sah.</p>
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
        </div>
        <div class="row no-print">
            <div class="col-6">
                <a href="javascript:window.print()" rel="noopener" class="btn btn-success float-right"><i class="fas fa-print"></i> Print</a>
            </div>
        </div>
    </div>