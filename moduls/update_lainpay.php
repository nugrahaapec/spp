<?php
include '../conn/config.php';

if (isset($_POST['simpan'])) {
    if (isset($_POST['nisn'])) {

        $nisn = $_POST['nisn'];
        $bill_pay   = $_POST['biaya'];

        $edit = "UPDATE lain_pay SET bill_pay='$bill_pay' WHERE nisn='$nisn'";
        $query = mysqli_query($koneksi, $edit);
        if ($query) {
            header("location:../admin/setpay?pesan=update");
        } else {
            # echo "Upss Something wrong..";
            echo "<script>alert('Data Gagal di Update ');location.href='../admin/setpay?pesan=gagal';</script>";
        }
    }
}
