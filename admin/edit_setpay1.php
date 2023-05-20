<?php
require '../conn/config.php';
include '../dist/cek.php';
include '../dist/header.php';
include '../dist/nav.php';
include '../dist/sidebar.php';
include '../dist/indo.php';

$id = $_GET['id'];
$tipe = $_GET['tipe'];
$tahun = $_GET['tahun'];
$pos = $_GET['pos'];

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <div class="card card-outline card-success">
                        <?php
                        $query = mysqli_query($koneksi, "SELECT *
                        FROM pos
                        INNER JOIN pos_pay ON pos.id_pos = pos_pay.id_pos
                        INNER JOIN tahun ON tahun.id_tahun = pos_pay.id_tahun
                        WHERE pos_pay.pay_id = $id AND pos_pay.id_tahun = $tahun");
                        while ($data = mysqli_fetch_array($query)) { ?>
                            <div class="card-header"><strong>
                                    <label> SETTING BIAYA PEMBAYARAN <?= strtoupper($data['nama_pos']); ?> <?= $data['tahun_awal']; ?>/<?= $data['tahun_akhir']; ?> </label>
                                </strong>
                            </div>
                            <form action="edit_setpay1" method="GET">
                                <input type="hidden" class="form-control" name="id" id="tipe" value="<?= $data['pay_id']; ?>" readonly>
                                <input type="hidden" class="form-control" name="pos" id="pos" value="<?= $data['id_pos']; ?>" readonly>
                                <input type="hidden" class="form-control" name="tahun" id="tahun" value="<?= $tahun ?>" readonly>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-form-label" style=width:150px;>Nama Pembayaran</label>
                                        <label class="col-form-label">:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="NP" placeholder="<?= $data['nama_pos']; ?> - <?= $data['tahun_awal']; ?>/<?= $data['tahun_akhir']; ?>" readonly>
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
                                            <input type="text" class="form-control" name="tipe" id="tipe" value="<?= $data['pay_tipe']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label" style=width:150px;>Kelas</label>
                                        <label class="col-form-label">:</label>
                                        <div class="input-group col-8">
                                            <select name="id_kls" id="kelas" class="form-control">
                                                <?php
                                                $query = mysqli_query($koneksi, "SELECT *FROM kelas");
                                                while ($data = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?= $data['id_kelas'] ?>"><?= $data['nama_kelas'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="input-group-append pl-2">
                                                <button type="submit" class="btn btn-info btn-sm float-right" value="cari"><i class="fas fa-folder"></i> &emsp14; Tampilkan Siswa</button>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>

                <div class="card card-outline card-success">
                    <div class="card-header">
                        <label>MASUKAN JUMLAH BIAYA DIBAWAH JIKA SEMUA SAMA</label>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label" style=width:150px;>Jumlah Biaya (Rp.)</label>
                            <label class="col-form-label">:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control numeric" name="biaya" id="biaya" placeholder="Masukan Nominal dan tekan Enter">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            if (isset($_GET['id_kls'])) {
                $cari = $_GET['id_kls'];
            ?>
                <div class="col-7">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas = '$cari'");
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <label>INFORMASI SISWA KELAS <?= $data['nama_kelas']; ?></label>
                            <?php } ?>
                        </div>
                        <div class="card-body">
                            <form action="../moduls/add_lainpay" method="POST">
                                <table class="table table-sm table-borderless table-responsive-sm">
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
                                                Tahun Ajaran
                                            </th>
                                            <th>
                                                Jumlah Tagihan
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $query = mysqli_query($koneksi, "SELECT * FROM siswa 
                                        INNER JOIN kelas ON siswa.kelas = kelas.id_kelas 
                                        INNER JOIN tahun ON siswa.id_tahun = tahun.id_tahun WHERE kelas = '$cari'");
                                        while ($data = mysqli_fetch_array($query)) :
                                        ?>
                                            <input type="hidden" class="form-control" name="nis" value="<?= $data['nis']; ?>">
                                            <input type="hidden" class="form-control" name="nisn[]" value="<?= $data['nisn']; ?>">
                                            <input type="hidden" class="form-control" name="kelas" value="<?= $data['id_kelas']; ?>/<?= $data['nama_kelas']; ?>">
                                            <input type="hidden" class="form-control" name="pembayaran" value="<?= $pos ?>">
                                            <input type="hidden" class="form-control" name="p_tipe" value="<?= $tipe ?>">
                                            <input type="hidden" class="form-control" name="tahun" value="<?= $tahun ?>">
                                            <input type="hidden" class="form-control" name="status" value="0">
                                            <input type="hidden" class="form-control" name="bill_cash" value="0">
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $data['nisn'] ?> / <?= $data['nis'] ?></td>
                                                <td><?= $data['nama_siswa'] ?></td>
                                                <td><?= $data['nama_kelas'] ?></td>
                                                <td><?= $data['tahun_awal'] ?>/<?= $data['tahun_akhir'] ?></td>
                                                <td><input type="text" class="form-control numeric col-sm-8" name="tarif[]" id="tarif<?= $data['nisn']; ?>">
                                                </td>
                                            </tr>
                                        <?php endwhile;
                                        ?>
                                    </tbody>
                                </table>
                                <div class="footer pt-3">
                                    <button type="submit" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
                                    <a href="javascript:history.go(-1)" type="button" class="btn btn-warning">Batal</a>
                                </div>
                            </form>
                        <?php } ?>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>



<?php include '../dist/footer.php' ?>

<script type="text/javascript">
    $("#biaya").keypress(function(event) {
        var biaya = $("#biaya").val();
        if (event.keyCode == 13) {
            event.preventDefault();
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM siswa");
            while ($data = mysqli_fetch_array($query)) {
            ?>
                $("#tarif<?php echo $data['nisn'] ?>").val(biaya);
            <?php } ?>
        }
    });
</script>