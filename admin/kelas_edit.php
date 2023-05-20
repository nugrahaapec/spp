<?php
require '../conn/config.php';
include '../dist/cek.php';
include '../dist/header.php';
include '../dist/nav.php';
include '../dist/sidebar.php';
include '../dist/indo.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas='$id'");
while ($data = mysqli_fetch_array($query)) {
?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <div class="card card-outline card-success">
                            <div class="card-header"><strong>
                                    <label> EDIT KELAS </label>
                                </strong>
                            </div>
                            <form action="../moduls/add_kelas" method="POST">
                                <input type="hidden" class="form-control" name="id_kelas" readonly value="<?php echo $data['id_kelas'] ?>">
                                <div class="card-body">
                                    <div class="form-group-sm pb-3">
                                        <label>Nama Kelas</label>
                                        <input type="text" class="form-control" name="e_kelas" value="<?php echo $data['nama_kelas'] ?>">
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card card-outline card-success pt-3 pb-3">
                            <button type="submit" name="edit_kelas" class="btn btn-success ml-2 mr-2 mb-2"><i class="far fa-save"></i> Simpan</button>
                            <button type="button" name="batal" class="btn btn-info ml-2 mr-2 mb-2" onclick="history.back(-1)"><i class="fas fa-spinner"></i> Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php include '../dist/footer.php' ?>