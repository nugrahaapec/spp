<?php
include '../conn/config.php';

$id = $_GET['id'];

$DELETE = mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas = '$id'");
if ($DELETE) {
    header("location:../admin/kelas?pesan=hapus");
} else {
    # echo "Upss Something wrong..";
    header("location:../admin/kelas?pesan=gagal_hapus");
}
