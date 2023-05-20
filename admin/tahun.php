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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Tahun Pelajaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="page_users"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Tahun Pelajran</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="col-sm-12">
                <?php
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == "tambah") {
                        echo "<div class='fade show toasts-top-right fixed p-2'>
                        <div class='alert alert-success' role='alert' fade show>
                        <div class='alert-header bg-success'> <i class='icon fas fa-check'></i>Data Berhasil Di Tambah</strong>
                        </div></div></div>";
                        echo "<meta http-equiv='refresh' content='2; url=tahun'>";
                    }
                }
                ?>
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <div class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#bulan">
                            <i class="fa fa-folder-plus"></i>&nbsp; Tambah Data
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="example2" class="table table-sm text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Pelajran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                $s = mysqli_query($koneksi, "SELECT * from tahun");
                                while ($data = mysqli_fetch_array($s)) {
                                ?>
                                    <tr>
                                        <td> <?= $no++; ?> </td>
                                        <td> <?= $data['tahun_awal'] ?>/<?= $data['tahun_akhir'] ?></td>
                                        <td>
                                            <a href="edit_tahun?id=<?= $data['id_tahun'] ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                        </td>
                                    <?php } ?>
                                    </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="bulan" class="modal fade show">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Tahun Pelajaran</h4>
                                </div>
                                <form name="form_bulan" action="../moduls/add_tahun" method="post">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Tahun Awal</label>
                                                <input type="text" name="t_awal" class="form-control" placeholder="Contoh: 2021" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Tahun Akhir</label>
                                                <input type="text" name="t_akhir" class="form-control" placeholder="Contoh: 2022" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <button type="submit" name="simpan1" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php include '../dist/footer.php' ?>