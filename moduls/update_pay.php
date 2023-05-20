<?php
include '../conn/config.php';
$id_pos = $_POST['id_pos'];
$nama_pos = $_POST['nama_pos'];
$keterangan_pos = $_POST['keterangan_pos'];

$edit = mysqli_query($koneksi, "UPDATE pos SET nama_pos='$nama_pos', keterangan_pos='$keterangan_pos' WHERE id_pos='$id_pos'");
if ($edit) {
    # header('location: menu.php');
    header("location:../admin/pay?pesan=update");
} else {
    # echo "Upss Something wrong..";
    header("location:../admin/pay?pesan=gagal");
}
