<?php
include '../conn/config.php';
$id = $_GET['id'];

$nisn = $_POST['nisn_siswa'];
$id_payment = $_POST['nama_bayar'];
$id_tahun = $_POST['tp_'];
$pay_id = $_POST['tipe_'];
$id_kelas = $_POST['kelas'];
$id_tahun = $_POST['tp_'];
$bill_bulan = $_POST['tarif_bayar'];


$query = mysqli_query($koneksi, "insert into siswa values('$nisn','$nis','$nama_siswa','$tempat','$tanggal_lahir','$ibu','$ayah','$jk','$kelas','$nohp','$alamat','$status','$id_tahun')");
header("location:../admin/setpay?pesan=tambah");
