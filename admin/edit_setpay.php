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

if ($_GET['tipe'] != 'Bulanan') {
    echo "<script>location.href='edit_setpay1?id=$id&tipe=$tipe&kelas=$kelas&tahun=$tahun&pos=$pos'</script>";
    exit;
}

$query = mysqli_query($koneksi, "SELECT *
FROM pos
INNER JOIN pos_pay ON pos.id_pos = pos_pay.id_pos
INNER JOIN tahun ON tahun.id_tahun = pos_pay.id_tahun
WHERE pos_pay.pay_id = $id");
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
                            <form action="../moduls/getdata" method="post">
                                <input type="hidden" class="form-control" name="s_pay" value="0">
                                <input type="hidden" class="form-control" name="tahun" value="<?= $data['id_tahun']; ?>">
                                <input type="hidden" class="form-control" name="pos" value="<?= $data['id_pos']; ?>">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-form-label" style=width:150px;>Nama Pembayaran</label>
                                        <label class="col-form-label">:</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="nama_bayar" class="form-control" id="NP" value="<?= $data['id_pos']; ?>" readonly>
                                            <input type="text" name="namabayar" class="form-control" id="NP" placeholder="<?= $data['nama_pos']; ?> - <?= $data['tahun_awal']; ?>/<?= $data['tahun_akhir']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label" style=width:150px;>Tahun Pelajaraan</label>
                                        <label class="col-form-label">:</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="tp_" class="form-control" id="bln" value="<?= $tahun ?>" readonly>
                                            <input type="text" name="tp" class="form-control" id="TP" placeholder="<?= $data['tahun_awal']; ?>/<?= $data['tahun_akhir']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label" style=width:150px;>Tipe</label>
                                        <label class="col-form-label">:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="tipe" id="tipe" placeholder="<?= $data['pay_tipe']; ?>" readonly>
                                            <input type="hidden" class="form-control" name="tipe_" value="<?= $data['pay_id']; ?>" readonly>
                                            <input type="hidden" class="form-control" name="status" value="0" readonly>
                                            <input type="hidden" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label" style=width:150px;>Kelas</label>
                                        <label class="col-form-label">:</label>
                                        <div class="col-sm-8">
                                            <select name="kelas" id="kelas" class="form-control">
                                                <option value=''> --- Pilih Kelas ---- </option>
                                                <?php
                                                $query = "SELECT * FROM kelas";
                                                $result = $koneksi->query($query);
                                                if (!$result) {
                                                    printf("Errormessage: %s\n", $koneksi->error);
                                                }
                                                while ($data = $result->fetch_array(MYSQLI_ASSOC)) {
                                                ?>
                                                    <option value="<?= $data['id_kelas'] ?>"><?= $data['nama_kelas'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label" style=width:150px;>Nama Siswa</label>
                                        <label class="col-form-label">:</label>
                                        <div class="col-sm-8">
                                            <select name="siswa" id="siswa" class="form-control">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label" style=width:150px;>Biaya Bulanan (Rp.)</label>
                                        <label class="col-form-label">:</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="jumlah" class="form-control numeric" id="biaya" name="biaya" placeholder="Masukan nominal dan tekan enter">
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="col-7">
                        <div class="card card-outline card-success">
                            <div class="card-body">
                                <?php
                                $query = mysqli_query($koneksi, "SELECT *
                                    FROM bulan");
                                while ($data = mysqli_fetch_array($query)) {
                                ?>
                                    <div class="form-group row">
                                        <label class="col-form-label" style=width:150px;><?= $data['nama_bulan']; ?></label>
                                        <label class="col-form-label">:</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="tarif_bayar[]" class="form-control" value="<?= $data['id_bulan']; ?>">
                                            <input type="text" name="tarif[]" class="form-control numeric" id="tarif<?= $data['id_bulan']; ?>" required>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class=" card-footer">
                                <button type="submit" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
                                <a href="setpay" type="button" class="btn btn-warning">Batal</a>
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