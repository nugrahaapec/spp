<?php
include '../conn/config.php';
$nisn = $_POST['nisn'];
$nis = $_POST['nis'];
$id_pay = $_POST['pay'];
$id_kelas_pay = $_POST['kelas'];
$id_tahun_pay = $_POST['tahun'];
$tanggal = $_POST['tanggal_pay'];
$biaya = $_POST['bayar_pay'];
$keterangan = $_POST['keterangan_pay'];
$status_pay = $_POST['status_pay'];

$tambah = mysqli_query($koneksi, "INSERT iNTO lain_pay_proses VALUE('','$nisn','$nis','$id_pay','$id_kelas_pay','$id_tahun_pay','$tanggal','$biaya','$keterangan',$status_pay)");
if ($tambah) {
    # header('location: menu.php');
    echo "<script>
		alert('Pembayaran Berhasil DIlakukan');
		window.location=history.go(-1);
	</script>";
} else {
    echo "<script>
    alert('Pembayaran Berhasil DIlakukan');
    window.location=history.go(-1);
</script>";
}
