<?php
require '../conn/config.php';
include '../dist/cek.php';
include '../dist/header.php';
include '../dist/nav.php';
include '../dist/sidebar.php';
include '../dist/indo.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM tahun WHERE id_tahun='$id'");
while ($data = mysqli_fetch_array($query)) {
?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <div class="card card-outline card-success">
                            <div class="card-header"><strong>
                                    <label> EDIT TAHUN PELAJARAN </label>
                                </strong>
                            </div>
                            <form action="../moduls/add_tahun" method="POST">
                                <input type="hidden" class="form-control" name="id_tahun" readonly value="<?php echo $data['id_tahun'] ?>">
                                <div class="card-body">
                                    <div class="form-group-sm pb-3">
                                        <label>Tahun Awal</label>
                                        <input type="text" class="form-control" name="t_awal" value="<?php echo $data['tahun_awal'] ?>">
                                    </div>
                                    <div class="form-group-sm">
                                        <label>Tahun Akhir</label>
                                        <input type="text" class="form-control" name="t_akhir" value="<?php echo $data['tahun_akhir'] ?>">
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card card-outline card-success pt-3 pb-3">
                            <button type="submit" name="simpan_tahun" class="btn btn-success ml-2 mr-2 mb-2"><i class="far fa-save"></i> Simpan</button>
                            <button type="button" name="batal" class="btn btn-info ml-2 mr-2 mb-2" onclick="history.back(-1)"><i class="fas fa-spinner"></i> Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php include '../dist/footer.php' ?>