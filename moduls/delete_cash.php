<?php
include '../conn/config.php';

$id_proses = $_GET['id_proses'];
$nisn = $_GET['nisn'];
$pos = $_GET['pos'];

$DELETE3 = mysqli_query($koneksi, "DELETE FROM lain_pay_proses WHERE id_proses = '$id_proses'");
if ($DELETE3) {
    header("location:../admin/pay?pesan=hapus");
} else {
    # echo "Upss Something wrong..";
    header("location:../admin/pay?pesan=gagal_hapus");
}
