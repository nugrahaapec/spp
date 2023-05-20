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
                    <h1 class="m-0">List Pembayaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="page_users"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Pembayaran</li>
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
                        <div class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#pos">
                            <i class="fa fa-folder-plus"></i>&nbsp; Tambah Data
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-sm text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pembayaran</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                $s = mysqli_query($koneksi, "SELECT * from pos order by id_pos ASC");
                                while ($data = mysqli_fetch_array($s)) {
                                ?>
                                    <tr>
                                        <td> <?= $no++; ?> </td>
                                        <td> <?= $data['nama_pos'] ?></td>
                                        <td> <?= $data['keterangan_pos'] ?> </td>
                                        <td>
                                            <a href="edit_pay?id=<?php echo $data['id_pos']; ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger btn-xs" name="hapus1" title="Hapus" data-href="../moduls/delete_pay?id=<?php echo $data['id_pos']; ?>" data-toggle="modal" data-target="#modal-hapus">
                                                <i class=" fas fa-trash-restore"></i></button>
                                        </td>
                                    <?php } ?>
                                    </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="pos" class="modal fade show">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">Tambah Pembayaran</h4>
                                </div>
                                <form name="form_pay" action="../moduls/add_pay" method="post">
                                    <div class="modal-body">
                                        <div id="add_pembayaran">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Nama Pembayaran</label>
                                                    <input type="text" required="" name="pos_nama" class="form-control" placeholder="Contoh: SPP">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Keterangan</label>
                                                    <input type="text" required="" name="pos_ket" class="form-control" placeholder="Contoh: Sumbangan Pendidikan">
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
                                    <a class="btn btn-danger btn-ok">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../dist/footer.php' ?>

<script>
    $('#modal-hapus').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>