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
                                <label>Cetak Kwitansi</label>
                            </div>
                            <form action="<?= $_SERVER["PHP_SELF"]; ?>" method="GET">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-form-label" style="margin-left:150px;">Pilih Kelas</label>
                                        <label class="col-form-label">:</label>
                                        <div class="col-sm-2">
                                            <select name="kelas" id="kelas" class="form-control" required>
                                                <option>Pilih Kelas</option>
                                                <?php
                                                $query = mysqli_query($koneksi, "SELECT *FROM kelas");
                                                while ($data = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?= $data['id_kelas'] ?>"><?= $data['nama_kelas'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <label class="col-form-label ml-4">Pilih Siswa</label>
                                        <label class="col-form-label">:</label>
                                        <div class="col-sm-2">
                                            <select name="siswa" id="siswa" class="form-control" required>
                                                <option>Pilih Siswa</option>

                                            </select>
                                        </div>
                                        <label class="col-form-label ml-4"><i class="fas fa-calendar-check"> Tanggal </i></label>
                                        <label class="col-form-label">:</label>
                                        <input type="text" name="tanggal" id="reservationdate" class="form-control col-sm-2 ml-2" data-target="#reservationdate" data-toggle="datetimepicker" placeholder="Masukan Tanggal" required></input>
                                        <button type="submit" class=" btn btn-success col-xs-2 ml-3"><i class="fas fa-search"></i> Cari Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_GET['kelas']) && isset($_GET['tanggal']) && isset($_GET['siswa'])) {
                    $kelas = $_GET['kelas'];
                    $nisn = $_GET['siswa'];
                    $tanggal = $_GET['tanggal'];
                ?>

                    <div class="container-fluid">
                        <div class="col-sm-12">
                            <div class="card card-outline card-success">
                                <div class="card-header">
                                    <label>Cetak Kwitansi</label>
                                    <a href="../print/print_kwitansi?nisn=<?= $nisn ?>&kelas=<?= $kelas ?>&tanggal=<?= $tanggal ?>" target="blank"><button class="btn btn-success btn-xs float-right"><i class="fas fa-print"> Cetak Kwitansi </i></button></a>
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
                                            WHERE siswa.kelas = '$kelas' AND lain_pay_proses.nisn = '$nisn' AND lain_pay_proses.tanggal = '$tanggal'");
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
                                            <?php
                                            $query = mysqli_query($koneksi, "SELECT * FROM siswa 
                                            INNER JOIN coba ON siswa.nisn = coba.nisn
                                            INNER JOIN pos ON coba.id_pos = pos.id_pos
                                            INNER JOIN kelas ON siswa.kelas = kelas.id_kelas
                                            WHERE siswa.kelas = '$kelas' AND coba.nisn = '$nisn' AND coba.tanggal = '$tanggal' AND status_pay = '1'");
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
                                                <tr>
                                                <?php } ?>
                                                <?php
                                                $query1 = mysqli_query($koneksi, "SELECT SUM(biaya) AS total FROM coba WHERE nisn = '$nisn' AND id_kelas = '$kelas' AND tanggal = '$tanggal' AND status_pay = '1'");
                                                $data1 = mysqli_fetch_array($query1);
                                                $total1 = $data1['total'];

                                                $query2 = mysqli_query($koneksi, "SELECT SUM(biaya) AS total FROM lain_pay_proses WHERE nisn = '$nisn' AND id_kelas_pay = '$kelas' AND tanggal = '$tanggal' ");
                                                $data2 = mysqli_fetch_array($query2);
                                                $total2 = $data2['total'];
                                                ?>
                                                </tr>
                                                <tr>
                                                    <th colspan="5">
                                                        <center>Total</center>
                                                    </th>
                                                    <th class="numeric" align="left"><?= $total1 + $total2 ?></th>
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

<?php include '../dist/footer.php'; ?>

<script>
    $(document).ready(function() {
        $("#kelas").change(function() {
            var postForm = {
                'id': document.getElementById("kelas").value,
                'op': 1
            };
            $.ajax({
                type: "post",
                url: "../moduls/select2",
                data: postForm,
                success: function(data) {
                    $("#siswa").html(data);
                }
            });
        });

    });
</script>