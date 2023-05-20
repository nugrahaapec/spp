<?php
include '../conn/config.php';


if (isset($_POST['update'])) {
    if (isset($_POST['update_siswa'])) {
        $nisn = $_POST['update_siswa'];
        $kelas = $_POST['u_kelas'];
        $jumlah_dipilih = count($nisn);

        for ($x = 0; $x < $jumlah_dipilih; $x++) {
            $edit = "UPDATE siswa SET kelas ='$kelas' WHERE nisn='$nisn[$x]'";
            $query = mysqli_query($koneksi, $edit);
            header("location:../admin/kenaikankelas?pesan=update");
        }
    } else {
        header("location:../admin/kenaikankelas?pesan=gagal");
    }
}
