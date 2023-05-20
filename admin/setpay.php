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
                    <h1 class="m-0">Setting Pembayaran</h1>
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
                        <div class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pos1">
                            <i class="fa fa-folder-plus"></i>&nbsp; Tambah Data
                        </div>
                        <a href="set_pay?tipe=Bulanan"><button class="btn btn-sm btn-default" data-toggle="tooltip" title="Bayar"><i class="fas fa-edit"></i>&nbsp; Edit Tagihan Bulanan </button></a>
                        <a href="set_pay1?tipe=Lainnya"><button class="btn btn-sm btn-warning" data-toggle="tooltip" title="Bayar"><i class="fas fa-edit"></i>&nbsp; Edit Tagihan Lainnya </button></a>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-sm text-nowrap">
                            <thead>
                                <tr>
                                    <th>Nama Pembayaran</th>
                                    <th>Tipe</th>
                                    <th>Tahun Pelajaran</th>
                                    <th>Setting Biaya</th>
                                    <th>
                                        Aksi
                                    </th>
                                </tr>
                                </tbody>
                            <tbody>
                                <?php
                                $s = mysqli_query($koneksi, "SELECT *
                                    FROM pos
                                    INNER JOIN pos_pay ON pos.id_pos = pos_pay.id_pos
                                    INNER JOIN tahun ON tahun.id_tahun = pos_pay.id_tahun");
                                while ($data = mysqli_fetch_array($s)) {
                                ?>
                                    <tr>
                                        <td> <?= $data['nama_pos'] ?> </td>
                                        <td> <?= $data['pay_tipe'] ?></td>
                                        <td> <?= $data['tahun_awal'] ?>/<?= $data['tahun_akhir'] ?> </td>
                                        <td>
                                            <a href="edit_setpay?id=<?= $data['pay_id'] ?>&tipe=<?= $data['pay_tipe'] ?>&tahun=<?= $data['id_tahun'] ?>&pos=<?= $data['id_pos'] ?>" class=" btn btn-xs btn-primary" data-toggle="tooltip" title="Setting">Atur Tarif Pembayaran</i></a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-xs" name="hapus" title="Hapus" data-href="../moduls/delete_pay?id=<?php echo $data['pay_id']; ?>" data-toggle="modal" data-target="#hapus">
                                                <i class=" fas fa-trash-restore"></i></button>
                                        </td>
                                    <?php } ?>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="pos1" class="modal fade show">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Setting Pembayaran</h4>
            </div>
            <form name="form_pay" action="../moduls/add_pay1" method="post">
                <div class="modal-body">
                    <div id="add_pembayaran">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nama Pembayaran</label>
                                <select name="p_bayar" class="form-control">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM pos");
                                    if (mysqli_num_rows($query) == 0) {
                                        echo "<option>Pilih Pembayaran</option>";
                                    } else {
                                        while ($r = mysqli_fetch_array($query)) :
                                    ?> <option value="<?php echo $r['id_pos'] ?>"><?php echo $r['nama_pos'] ?>
                                            </option>
                                    <?php
                                        endwhile;
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label> Tahun Pelajaran<small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
                                <select name="tahun_bayar" class="form-control">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM tahun");
                                    if (mysqli_num_rows($query) == 0) {
                                        echo "<option>Pilih Tahun</option>";
                                    } else {
                                        while ($r = mysqli_fetch_array($query)) :
                                    ?> <option value="<?php echo $r['id_tahun'] ?>"><?php echo $r['tahun_awal'] ?>/<?php echo $r['tahun_akhir'] ?>
                                            </option>
                                    <?php
                                        endwhile;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Pilih Tipe Pembayaran <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
                                <select name="tipe_bayar" class="form-control">
                                    <option value="">-Pilih Tipe-</option>
                                    <option>Bulanan</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" name="simpan1" class="btn btn-primary">Simpan</button>
                        </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>


<?php include '../dist/footer.php' ?>

<div class="modal fade" id="hapus">
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

<script>
    $('#hapus').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>