<?php
include '../conn/config.php';

if (isset($_POST['simpan'])) {
    $id_kelas = $_POST['kelas'];
    $nisn = $_POST['siswa'];
    $id_bulan = $_POST['tarif_bayar'];
    $biaya = $_POST['tarif'];
    $status_pay = $_POST['s_pay'];
    $id_tahun = $_POST['tahun'];
    $id_pos = $_POST['pos'];
    $tanggal = $_POST['tanggal'];

    $jumlah_dipilih = count($id_bulan);
    $jumlah_dipilih = count($biaya);

    for ($x = 0; $x < $jumlah_dipilih; $x++) {
        mysqli_query($koneksi, "INSERT INTO coba values('','$id_pos','$nisn','$id_kelas','$id_bulan[$x]','$id_tahun','$biaya[$x]','$status_pay','$tanggal')");
    }
    header("location:../admin/setpay?pesan=tambah");
} else {
    header("location:../admin/setpay?pesan=gagal");
}


if (isset($_POST['update'])) {
    if (isset($_POST['nisn'])) {
        $nisn = $_POST['nisn'];
        $id_bulan = $_POST['tarif_bayar'];
        $biaya = $_POST['tarif'];
        $jumlah_dipilih = count($id_bulan);
        $jumlah_dipilih = count($biaya);

        for ($x = 0; $x < $jumlah_dipilih; $x++) {
            $edit = "UPDATE coba SET biaya ='$biaya[$x]' WHERE nisn='$nisn' AND id_bulan = '$id_bulan[$x]' ";
            $query = mysqli_query($koneksi, $edit);
            header("location:../admin/setpay?pesan=update");
        }
    } else {
        header("location:../admin/setpay?pesan=gagal");
    }
}
