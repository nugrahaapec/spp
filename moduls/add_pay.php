<?php
include '../conn/config.php';
$nama_pos = $_POST['pos_nama'];
$keterangan_pos = $_POST['pos_ket'];


mysqli_query($koneksi, "insert into pos values('$id_pos','$nama_pos','$keterangan_pos')");
header("location:../admin/pay?pesan=tambah");
