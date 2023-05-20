<?php
include '../conn/config.php';
if (isset($_GET['id']) && isset($_GET['nisn']) && isset($_GET['tgl'])) {
    $id = $_GET['id'];
    $nisn = $_GET['nisn'];
    $tgl  = date('Y-m-d');
    $pos  = $_GET['pos'];

    $query = mysqli_query($koneksi, "UPDATE coba SET status_pay='1', tanggal='$tgl' WHERE id_bulan='$id' AND nisn = '$nisn' AND id_pos = '$pos'");

    if ($query) {
        echo "<script>
		alert('Pembayaran Berhasil DIlakukan');
		window.location=history.go(-1);
	</script>";
    } else {
        echo "<script>
		alert('Gagal Melakukan Pembayaran');
		window.location=history.go(-1);
	</script>";
    }
}

if (isset($_GET['status'])) {
    $status_pay = $_GET['status'];
    if ($status_pay == 1) {
        $query = mysqli_query($koneksi, "UPDATE coba SET status_pay='0' WHERE id_bulan='$id' AND nisn = '$nisn' AND id_pos = '$pos'");

        if ($query) {
            echo "<script>
		alert('Pembayaran Telah Dibatalkan');
		window.location=history.go(-1);
	</script>";
        } else {
            echo "<script>
		alert('Gagal Menghapus Pembayaran');
		window.location=history.go(-1);
	</script>";
        }
    }
}
