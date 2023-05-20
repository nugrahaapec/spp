<?php
include '../conn/config.php';
$nama_bulan = $_POST['bulan'];

mysqli_query($koneksi, "insert into bulan values('$id_bulan','$nama_bulan')");
header("location:../admin/bulan?pesan=tambah");
