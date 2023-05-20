<?php
include '../conn/config.php';

if (isset($_POST['simpan1'])) {
    if (isset($_POST['nisn'])) {
        $nisn = $_POST['nisn'];
        $nis = $_POST['nis'];
        $nama_siswa = $_POST['nama_lengkap'];
        $tempat = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_l'];
        $ibu = $_POST['ibu'];
        $ayah = $_POST['ayah'];
        $jk = $_POST['jenis_k'];
        $kelas = $_POST['kelas'];
        $nohp = $_POST['no_hp'];
        $alamat = $_POST['alamat_siswa'];
        $status = $_POST['s_status'];
        $id_tahun = $_POST['tahun_masuk'];
        $simpan = mysqli_query($koneksi, "INSERT INTO siswa VALUES('$nisn','$nis','$nama_siswa','$tempat','$tanggal_lahir','$ibu','$ayah','$jk','$kelas','$nohp','$alamat','$status','$id_tahun')");
        if ($simapn) {
            header("location:../admin/master_siswa?pesan=tambah");
        }
    } else {
        header("location:../admin/master_siswa?pesan=gagal");
    }
}


if (isset($_POST['update'])) {
    if (isset($_POST['nisn'])) {
        $nama_siswa = $_POST['nama_lengkap'];
        $jk = $_POST['jenis_k'];
        $tempat = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal'];
        $alamat = $_POST['alamat_siswa'];
        $status = $_POST['s_status'];
        $nisn = $_POST['nisn'];
        $nis = $_POST['nis'];
        $kelas = $_POST['kelas'];
        $id_tahun = $_POST['tahun_masuk'];
        $ayah = $_POST['ayah'];
        $ibu = $_POST['ibu'];
        $nohp = $_POST['no_hp'];

        $edit = "UPDATE siswa SET nisn='$nisn', nis='$nis', nama_siswa='$nama_siswa', jk='$jk', tempat='$tempat', tanggal_lahir='$tanggal_lahir', alamat='$alamat', status='$status',
                 kelas='$kelas', id_tahun='$id_tahun', ayah='$ayah', ibu='$ibu', nohp='$nohp' WHERE nisn='$nisn'";
        $query = mysqli_query($koneksi, $edit);
        if ($query) {
            header("location:../admin/master_siswa?pesan=update");
        } else {
            header("location:../admin/master_siswa?pesan=gagal_update");
        }
    }
}
