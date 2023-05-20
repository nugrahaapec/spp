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
                    <h1 class="m-0">List Kelas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="page_users"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Kelas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <div class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#kelas">
                            <i class="fa fa-folder-plus"></i>&nbsp; Tambah Data
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-sm text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                $s = mysqli_query($koneksi, "SELECT * from kelas");
                                while ($data = mysqli_fetch_array($s)) {
                                ?>
                                    <tr>
                                        <td> <?= $no++; ?> </td>
                                        <td> <?= $data['nama_kelas'] ?></td>
                                        <td>
                                            <a href="kelas_edit?id=<?php echo $data['id_kelas']; ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger btn-xs" name="hapus1" title="Hapus" data-href="../moduls/delete_kelas?id=<?php echo $data['id_kelas']; ?>" data-toggle="modal" data-target="#modal-hapus">
                                                <i class=" fas fa-trash-restore"></i></button>
                                        </td>
                                    <?php } ?>
                                    </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="kelas" class="modal fade show">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Kelas</h4>
                                </div>
                                <form name="form_bulan" action="../moduls/add_kelas" method="post">
                                    <div class="modal-body">
                                        <div class="row">
                                            <label>Nama Kelas</label>
                                            <input type="text" name="n_kelas" class="form-control" placeholder="10.11.12.X.XI.XII" required>
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
        </div>
    </div>
</div>

<?php include '../dist/footer.php' ?>


<div class="modal fade" id="modal-hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Data Akan Dihapus?</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik <strong>"Hapus"</strong> dibawah ini jika anda yakin.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok" name="hapus_kelas">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#modal-hapus').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>