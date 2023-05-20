<?php
require '../conn/config.php';
include '../dist/cek.php';
include '../dist/header.php';
include '../dist/nav.php';
include '../dist/sidebar.php';
include '../dist/indo.php';
$nisn = $_GET['nisn'];
$query = mysqli_query($koneksi, "SELECT * from siswa 
INNER JOIN kelas ON siswa.kelas = kelas.id_kelas
INNER JOIN tahun ON siswa.id_tahun = tahun.id_tahun WHERE siswa.nisn = '$nisn'");
foreach ($query as $data);
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Note:</h5>
                    Halaman ini dapat digunakan untuk mengedit data siswa dan melihat detail siswa.
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-success card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="../logo/user.png" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center"><?= $data['nama_siswa'] ?></h3>
                                <p class="text-muted text-center"><?= $data['nisn'] ?> / <?= $data['nis'] ?></p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <i class="fas fa-calendar-day">&nbsp; Tempat, Tanggal Lahir</i> <b class="float-right" class="float-right"><?= $data['tempat'] ?>, <?= tgl_indo(date($data['tanggal_lahir'])) ?></b>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-school">&nbsp; Kelas</i> <b class="float-right" class="float-right"><?= $data['nama_kelas'] ?></b>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-phone-alt">&nbsp; No. Handphone</i> <b class="float-right" class="float-right"><?= $data['nohp'] ?></b>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-check-circle">&nbsp; Status</i> <b class="float-right" class="float-right">
                                            <?php
                                            if ($data['status'] == 0) {
                                                echo '<span class="btn btn-danger btn-sm"><b>Tidak Aktif</b></span>';
                                            } elseif ($data['status'] == 1) {
                                                echo '<span class="btn btn-success btn-sm"><b>Aktif</b></span>';
                                            }
                                            ?>
                                        </b>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card card-success card-outline">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Data Pribadi</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Data Sekolah</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Data Keluarga</a></li>
                                </ul>
                            </div>

                            <form action="../moduls/tambah_siswa" method="POST">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="activity">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input name="nama_lengkap" type="text" class="form-control" value="<?= ucwords($data['nama_siswa']) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <input name="jenis_k" type="text" class="form-control" value="<?= ucfirst($data['jk']) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input name="tempat_lahir" type="text" class="form-control" value="<?= $data['tempat'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fa fa-calendar-alt"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="tanggal" class="form-control" id="reservationdate" data-target="#reservationdate" data-toggle="datetimepicker" value="<?= date($data['tanggal_lahir']); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea name="alamat_siswa" class="form-control"><?= $data['alamat'] ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Status Siswa</label>
                                                <select name="s_status" class="form-control custom-select">
                                                    <option value="1">Aktif</option>
                                                    <option value="0">Tidak Aktif</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="tab-pane" id="timeline">
                                            <div class="form-group">
                                                <label>NISN</label>
                                                <input name="nisn" type="text" class="form-control" value="<?= $data['nisn'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>NIS</label>
                                                <input name="nis" type="text" class="form-control" value="<?= $data['nis'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Kelas</label>
                                                <select name="kelas" class="form-control custom-select">
                                                    <option value="<?= $data['id_kelas']; ?>"><?= $data['nama_kelas'] ?>
                                                    </option>
                                                    <?php
                                                    $query = mysqli_query($koneksi, "SELECT * FROM kelas");
                                                    foreach ($query as $data) { ?>
                                                        <option value="<?= $data['id_kelas']; ?>"><?= $data['nama_kelas'] ?>
                                                        </option>
                                                    <?php }; ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Tahun Pelajaran</label>
                                                <select name="tahun_masuk" class="form-control custom-select">
                                                    <?php
                                                    $query = mysqli_query($koneksi, "SELECT * FROM siswa INNER JOIN tahun ON siswa.id_tahun = tahun.id_tahun WHERE siswa.nisn = '$nisn'");
                                                    $data = mysqli_fetch_array($query);
                                                    ?>
                                                    <option value="<?= $data['id_tahun']; ?>"><?= $data['tahun_awal'] ?>/<?= $data['tahun_akhir'] ?>
                                                    </option>
                                                    <?php
                                                    $query = mysqli_query($koneksi, "SELECT * FROM tahun");
                                                    foreach ($query as $data) { ?>
                                                        <option value="<?= $data['id_tahun']; ?>"><?= $data['tahun_awal'] ?>/<?= $data['tahun_akhir'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="settings">
                                            <?php
                                            $query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn = '$nisn'");
                                            foreach ($query as $data);
                                            ?>
                                            <div class="form-group">
                                                <label>Nama Ayah Kandung</label>
                                                <input name="ayah" type="text" class="form-control" value="<?= $data['ayah'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Ibu Kandung</label>
                                                <input name="ibu" type="text" class="form-control" value="<?= $data['ibu'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>No Handphone Orang Tua</label>
                                                <input name="no_hp" type="text" maxlength="13" class="form-control" max="13" onkeypress="return hanyaAngka(event)" value="<?= $data['nohp'] ?>">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" onclick="history.go(-1)">Batal</button>
                                                <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

<?php
include '../dist/footer.php';
?>

<script>
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>