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
                <div class="col-8">
                    <div class="card card-outline card-success">
                        <div class="card-body">
                            <form action="kenaikankelas" method="GET" accept-charset="utf-8">
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


                            <?php
                            if (isset($_GET['p_kelas'])) {
                                $cari = $_GET['p_kelas'];
                            ?>
                                <table class="table table-sm table-hover table-borderless">
                                    <form action="../moduls/naikkelas" method="post">
                                        <input type="hidden" name="action" value="upgrade">
                                        <tbody>
                                            <tr class="bg-info">
                                                <th><input type="checkbox" id="selectall" value="checkbox" name="checkbox"></th>
                                                <th>No</th>
                                                <th>NISN / NIS</th>
                                                <th>Nama</th>
                                                <th>Kelas</th>
                                                <th>Tahun Masuk</th>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $query = "SELECT * FROM siswa INNER JOIN kelas ON siswa.kelas = kelas.id_kelas 
                                            INNER JOIN tahun ON siswa.id_tahun = tahun.id_tahun WHERE kelas = '$cari' AND status = '1'";
                                            $result = $koneksi->query($query);
                                            while ($data = $result->fetch_array(MYSQLI_ASSOC)) {
                                            ?>
                                                <tr>
                                                    <td><input type="checkbox" class="checkbox" name="update_siswa[]" value="<?= $data['nisn'] ?>"></td>
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
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-outline card-success">
                        <div class="card-body">
                            <div class="input-group">
                                <select class="form-control" name="u_kelas">
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
                        </div>
                        <button type="submit" name="update" value="update" class="btn btn-outline-success ml-3 mr-3 mb-3"><i class="fas fa-user-graduate"></i> &nbsp;Proses Kenaikan Kelas</button>
                    </div>
                </div>
                </form>
            <?php } ?>
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