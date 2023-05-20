<?php
require '../conn/config.php';
include '../dist/cek.php';
include '../dist/header.php';
include '../dist/nav.php';
include '../dist/sidebar.php';
include '../dist/indo.php';
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Proses Kenaikan Kelas</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <form action="kelulusan" method="GET" accept-charset="utf-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success"> Pilih Kelas</span>
                                    </div>
                                    <select class="form-control" name="p_kelas" onchange="this.form.submit()">
                                        <option> PIlih Kelas </option>
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
                            </form>

                            <form action="../moduls/lulus" method="POST">
                                <?php
                                if (isset($_GET['p_kelas'])) {
                                    $cari = $_GET['p_kelas'];
                                ?>
                                    <table class="table table-sm table-hover table-borderless">
                                        <thead class="bg-info">
                                            <tr>
                                                <th><input type="checkbox" id="selectall" value="checkbox" name="checkbox"></th>
                                                <th>No</th>
                                                <th>NISN / NIS</th>
                                                <th>Nama</th>
                                                <th>Kelas</th>
                                                <th>Tahun Masuk</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $query = "SELECT * FROM siswa INNER JOIN kelas ON siswa.kelas = kelas.id_kelas 
                                            INNER JOIN tahun ON siswa.id_tahun = tahun.id_tahun WHERE kelas = '$cari' AND status = '1'";
                                            $result = $koneksi->query($query);
                                            while ($data = $result->fetch_array(MYSQLI_ASSOC)) {
                                            ?>
                                                <tr>
                                                    <td><input type="checkbox" class="checkbox" name="siswa_lulus[]" value="<?= $data['nisn'] ?>"></td>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data['nisn'] ?> / <?= $data['nis'] ?></td>
                                                    <td><?= $data['nama_siswa'] ?></td>
                                                    <td><?= $data['nama_kelas'] ?></td>
                                                    <td><?= $data['tahun_awal'] ?>/<?= $data['tahun_akhir'] ?></td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="card card-outline card-success pt-3 pb-3">
                        <button type="submit" name="lulus" class="btn btn-success ml-2 mr-2 mb-2"><i class="fas fa-user-graduate"></i>&nbsp; Proses Kelulusan</button>
                        <button type="submit" name="batal" class="btn btn-danger ml-2 mr-2 mb-2"><i class="fas fa-spinner"></i>&nbsp; Batalkan Kelulusan</button>
                    </div>
                </div>

                <div class="col-5">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <label><i class="fas fa-user-graduate"></i>&nbsp; Data Siswa Lulus</label>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-hover table-borderless">
                                <input type="hidden" name="action" value="upgrade">
                                <thead class="bg-info">
                                    <tr>
                                        <th><input type="checkbox" id="selectall2" value="checkbox" name="checkbox"></th>
                                        <th>No</th>
                                        <th>NISN / NIS</th>
                                        <th>Nama</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE status = '99'");
                                    if (mysqli_num_rows($query)) {
                                        while ($data = mysqli_fetch_assoc($query)) :
                                    ?>
                                            <tr>
                                                <td><input type="checkbox" class="checkbox2" name="batal_lulus[]" value="<?= $data['nisn'] ?>"></td>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data['nisn'] ?> / <?= $data['nis'] ?></td>
                                                <td><?= $data['nama_siswa'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($data['status'] == 99) {
                                                        echo '<button class="btn btn-xs btn-success"><i class="fas fa-user-graduate"></i>&nbsp; Lulus </button>';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php
                                        endwhile;
                                    } else {
                                        echo "<td colspan=12>Belum ada siswa yang lulus.</td></tr>";
                                    } ?>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include '../dist/footer.php' ?>


<script>
    $(document).ready(function() {
        $("#selectall").change(function() {
            $(".checkbox").prop('checked', $(this).prop("checked"));
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#selectall2").change(function() {
            $(".checkbox2").prop('checked', $(this).prop("checked"));
        });
    });
</script>