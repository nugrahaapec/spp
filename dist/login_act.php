<?php
require '../conn/config.php';
$uname = $_POST['uname'];
$pass = MD5($_POST['pass']);

$nugraha = mysqli_query($koneksi, "select * from admin where (uname='$uname' 
OR email='$uname') and pass='$pass'");
if (mysqli_num_rows($nugraha) == 1) {
	$nugraha = mysqli_fetch_array($nugraha);
	$_SESSION['uname'] = $nugraha['uname'];
	$_SESSION['nama'] = $nugraha['nama'];



	if ($nugraha['uname' or 'nama']) {
		header("location:../admin/home");
	}
} else {
	header("location:../index?pesan=gagal");
}
