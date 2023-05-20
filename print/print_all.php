<?php
require '../conn/config.php';
include '../dist/cek.php';
include '../dist/indo1.php';
include '../dist/header.php';
$nisn = $_GET['nisn'];

$query = mysqli_query($koneksi, "SELECT * FROM siswa
INNER JOIN kelas ON siswa.kelas = kelas.id_kelas
INNER JOIN tahun ON siswa.id_tahun = tahun.id_tahun
WHERE siswa.nisn = '$nisn' AND siswa.status ='1'");
$data = mysqli_fetch_array($query);
?>



<div class="content-fluid">
    <div class="invoice p-0 mb-3">
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
        </hr>
        <br>
        <center><strong style="font-size: 25px;">REKAPITULASI PEMBAYARAN SISWA</strong></center>
        <br>
        <br>

        <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
                <address class="float-left">
                    <label style="width:130px;">NISN / NIS</label>
                    <label>:</label>
                    <label><?= $nisn ?> / <?= $data['nis'] ?></label><br>
                    <label style="width:130px;">Nama Siswa</label>
                    <label>:</label>
                    <label><?= $data['nama_siswa'] ?></label><br>
                    <label style="width:130px;">Kelas</label>
                    <label>:</label>
                    <label><?= $data['nama_kelas'] ?></label><br>
                </address>
            </div>
            <div class="col-sm-6 invoice-col">
                <address class="float-right">
                    <label style="width:130px;">Tanggal Cetak</label>
                    <label>:</label>
                    <label><?= tgl_indo(date('Y-m-d')) ?></label><br>
                    <label style="width:130px;">Jam Cetak</label>
                    <label>:</label>
                    <label><?= date("h:i"); ?></label><br>
                </address>
            </div>
        </div>

        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                No
                            </th>
                            <th>
                                Nama Pembayaran
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
                     INNER JOIN coba ON siswa.nisn = coba.nisn
                     INNER JOIN pos ON coba.id_pos = pos.id_pos
                     INNER JOIN bulan ON coba.id_bulan = bulan.id_bulan
                     INNER JOIN tahun ON coba.id_tahun = tahun.id_tahun
                     INNER JOIN kelas ON coba.id_kelas = kelas.id_kelas
                     WHERE siswa.nisn = '$nisn' AND coba.status_pay ='1'");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data['nama_pos'] ?> Bulan <?= $data['nama_bulan'] ?> <?= $data['tahun_awal'] ?> </td>
                                <td><?= tgl_indo(date($data['tanggal'])) ?></td>
                                <td class="numeric"><?= $data['biaya'] ?> </td>
                            </tr>
                        <?php } ?>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM siswa 
                    INNER JOIN lain_pay_proses ON siswa.nisn = lain_pay_proses.nisn
                    INNER JOIN pos ON lain_pay_proses.id_pay = pos.id_pos
                    INNER JOIN kelas ON lain_pay_proses.id_kelas_pay = kelas.id_kelas
                    WHERE siswa.nisn = '$nisn' AND lain_pay_proses.status_pay ='1' ORDER BY tanggal DESC  ");
                        if (mysqli_num_rows($query)) {
                            while ($data = mysqli_fetch_assoc($query)) :
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['nama_pos'] ?></td>
                                    <td><?= tgl_indo(date($data['tanggal'])) ?></td>
                                    <td class="numeric"><?= $data['biaya'] ?> </td>
                                </tr>
                        <?php endwhile;
                        } ?>
                        <?php
                        $query1 = mysqli_query($koneksi, "SELECT SUM(biaya) AS total FROM coba WHERE nisn = '$nisn' AND status_pay = '1'");
                        $data1 = mysqli_fetch_array($query1);
                        $total1 = $data1['total'];

                        $query2 = mysqli_query($koneksi, "SELECT SUM(biaya) AS total FROM lain_pay_proses WHERE nisn = '$nisn' AND status_pay = '1' ");
                        $data2 = mysqli_fetch_array($query2);
                        $total2 = $data2['total'];
                        ?>
                        <tr>
                            <td colspan="3">
                                <center><b>Total</b></center>
                            </td>
                            <th class="numeric" align="left"><?= $total1 + $total2 ?></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6">
                <p>Note :</p>
                <p class="mt-n3">Ini adalah kwitansi asil harap disimpan dengan baik.</p>
                <p class="mt-n3">*Sebagai syarat pengambilan ijazah</p>
            </div>
            <div class="col-6">
                <strong>
                    <div class="float-right">
                        Mengetahui, <br><br><br><br><br>
                        <?= $_SESSION['nama'] ?> <br>
                        Bendahara Sekolah
                    </div>
                </strong>
            </div>
        </div>
        <div class="row no-print">
            <div class="col-6">
                <a href="javascript:window.print()" rel="noopener" class="btn btn-success float-right"><i class="fas fa-print"></i> Print</a>
            </div>
        </div>
    </div>
</div>