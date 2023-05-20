<?php
include '../conn/config.php';

$nisn = $_GET['nisn'];

$DELETE = mysqli_query($koneksi, "DELETE FROM siswa WHERE nisn = '$nisn'");
if ($DELETE) {
    header("location:../admin/master_siswa?pesan=hapus");
} else {
    # echo "Upss Something wrong..";
    header("location:../admin/master_siswa?pesan=gagal_hapus");
}
