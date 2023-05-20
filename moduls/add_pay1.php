<?php
include '../conn/config.php';
$id_pos = $_POST['p_bayar'];
$id_tahun = $_POST['tahun_bayar'];
$pay_tipe = $_POST['tipe_bayar'];

mysqli_query($koneksi, "INSERT INTO pos_pay values('','$pay_tipe','$id_tahun','$id_pos')");
header("location:../admin/setpay?pesan=tambah");
