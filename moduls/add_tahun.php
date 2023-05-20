<?php
include '../conn/config.php';

if (isset($_POST['simpan1'])) {
    $tahun_awal = $_POST['t_awal'];
    $tahun_akhir = $_POST['t_akhir'];

    $simpan = mysqli_query($koneksi, "INSERT INTO tahun VALUES('$id_tahun','$tahun_awal','$tahun_akhir')");
    if ($simpan) {
        header("location:../admin/tahun?pesan=tambah");
    } else {
        header("location:../admin/tahun?pesan=gagal");
    }
}



if (isset($_POST['simpan_tahun'])) {
    $id_tahun = $_POST['id_tahun'];
    $tahun_awal = $_POST['t_awal'];
    $tahun_akhir = $_POST['t_akhir'];

    $edit = "UPDATE tahun SET tahun_awal='$tahun_awal' , tahun_akhir='$tahun_akhir' WHERE id_tahun='$id_tahun'";
    $query = mysqli_query($koneksi, $edit);
    if ($query) {
        header("location:../admin/tahun?pesan=update");
    } else {
        header("location:../admin/tahun?pesan=gagal");
    }
}
