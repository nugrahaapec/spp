<?php
include '../conn/config.php';

if (isset($_POST['simpan'])) {

    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $id_kelas = $_POST['kelas'];
    $id_pay = $_POST['pembayaran'];
    $pay_tipe = $_POST['p_tipe'];
    $id_tahun = $_POST['tahun'];
    $status_pay = $_POST['status'];
    $bill_pay = $_POST['tarif'];
    $bill_pay_cash = $_POST['bill_cash'];

    $jumlah_dipilih = count($nisn);
    $jumlah_dipilih = count($bill_pay);

    $cek = mysqli_query($koneksi, "SELECT * FROM lain_pay WHERE nisn='$nisn' AND id_pay = '$id_pay'");
    $query = mysqli_num_rows($cek);
    if ($cek == 0) {
        header("location:../admin/setpay?pesan=gagal");
    } else {
        for ($x = 0; $x < $jumlah_dipilih; $x++) {
            mysqli_query($koneksi, "INSERT into lain_pay values('','$nisn[$x]','$nis','$id_kelas','$id_pay','$pay_tipe','$id_tahun','$status_pay','$bill_pay[$x]','$bill_pay_cash')");
            header("location:../admin/setpay?pesan=tambah");
        }
    }
}
