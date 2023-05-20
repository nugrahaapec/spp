<?php
include '../conn/config.php';

if (isset($_POST['simpan1'])) {
    $nama_kelas = $_POST['n_kelas'];
    $tambah = mysqli_query($koneksi, "INSERT INTO kelas VALUES('$id_kelas','$nama_kelas')");
    if ($tambah) {
        header("location:../admin/kelas?pesan=tambah");
    } else {
        header("location:../admin/kelas?pesan=gagal");
    }
}


if (isset($_POST['edit_kelas'])) {
    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['e_kelas'];
    $edit = "UPDATE kelas SET nama_kelas='$nama_kelas' WHERE id_kelas='$id_kelas'";
    $query = mysqli_query($koneksi, $edit);
    if ($query) {
        header("location:../admin/kelas?pesan=tambah");
    } else {
        header("location:../admin/kelas?pesan=gagal");
    }
}
