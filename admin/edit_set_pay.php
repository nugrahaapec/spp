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
                                    <h4> SETTING BIAYA PEMBAYARAN <?= strtoupper($data['nama_pos']); ?> <?= $data['tahun_awal']; ?>/<?= $data['tahun_akhir']; ?> </h4>
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


                                <div class="form-group row">
                                    <label class="col-form-label" style=width:150px;>Biaya Bulanan (Rp.)</label>
                                    <label class="col-form-label">:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control numeric" id="biaya" name="biaya" placeholder="Masukan nominal dan tekan enter">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-7">
                        <div class="card card-outline card-success">
                            <form action="../moduls/getdata" method="post">
                                <div class="card-body">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM coba 
                                    INNER JOIN siswa ON coba.nisn = siswa.nisn
                                    INNER JOIN kelas ON coba.id_kelas =  kelas.id_kelas
                                    INNER JOIN tahun ON coba.id_tahun = tahun.id_tahun
                                    INNER JOIN pos ON coba.id_pos = pos.id_pos
                                    INNER JOIN bulan ON coba.id_bulan = bulan.id_bulan WHERE coba.nisn = '$nisn' AND coba.id_kelas = '$kelas' AND coba.id_pos = '$id'");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <div class="form-group row">
                                            <label class="col-form-label" style=width:150px;><?= $data['nama_bulan']; ?></label>
                                            <label class="col-form-label">:</label>
                                            <div class="col-sm-8">
                                                <input type="hidden" name="nisn" class="form-control" value="<?= $data['nisn']; ?>">
                                                <input type="hidden" name="tarif_bayar[]" class="form-control" value="<?= $data['id_bulan']; ?>">
                                                <input type="text" name="tarif[]" class="form-control numeric" id="tarif<?= $data['id_bulan']; ?>" value="<?= $data['biaya']; ?>" required>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" name="update" id="update" class="btn btn-primary">Simpan</button>
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
                $query = mysqli_query($koneksi, "SELECT *
                                    FROM bulan");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    $("#tarif<?php echo $data['id_bulan'] ?>").val(biaya);
                <?php } ?>
            }
        });
    </script>