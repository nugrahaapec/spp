<?php
include '../conn/config.php';


if (isset($_POST['lulus'])) {
    if (isset($_POST['siswa_lulus'])) {
        $nisn = $_POST['siswa_lulus'];
        $jumlah_dipilih = count($nisn);

        for ($x = 0; $x < $jumlah_dipilih; $x++) {
            $edit = "UPDATE siswa SET status ='99' WHERE nisn='$nisn[$x]'";
            $query = mysqli_query($koneksi, $edit);
            header("location:../admin/kelulusan?pesan=update");
        }
    } else {
        header("location:../admin/kelulusan?pesan=gagal");
    }
}

if (isset($_POST['batal'])) {
    if (isset($_POST['batal_lulus'])) {
        $nisn = $_POST['batal_lulus'];
        $jumlah_dipilih = count($nisn);

        for ($x = 0; $x < $jumlah_dipilih; $x++) {
            $edit = "UPDATE siswa SET status ='1' WHERE nisn='$nisn[$x]'";
            $query = mysqli_query($koneksi, $edit);
            header("location:../admin/kelulusan?pesan=update");
        }
    } else {
        header("location:../admin/kelulusan?pesan=gagal");
    }
}
