<?php
include '../conn/config.php';

$id = $_GET['id'];
$DELETE = mysqli_query($koneksi, "DELETE FROM pos_pay WHERE pay_id = '$id'");
if ($DELETE) {
    header("location:../admin/setpay?pesan=hapus");
} else {
    # echo "Upss Something wrong..";
    header("location:../admin/setpay?pesan=gagal_hapus");
}

$DELETE1 = mysqli_query($koneksi, "DELETE FROM pos WHERE id_pos = '$id'");
if ($DELETE1) {
    header("location:../admin/pay?pesan=hapus");
} else {
    # echo "Upss Something wrong..";
    header("location:../admin/pay?pesan=gagal_hapus");
}
