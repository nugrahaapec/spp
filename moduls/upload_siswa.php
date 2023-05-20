<?php
include '../conn/config.php';
require '../dist/vendor/excel_reader2.php';
require '../dist/vendor/SpreadsheetReader.php';


if (isset($_POST['upload'])) {

    $file = $_FILES['file']['name'];
    $ekstensi = explode(".", $file);
    $file_name = strtolower(end($ekstensi));
    $data_baru = "file-" . date('Y-m-d') . "-" . date("h.i.s") . "." . $file_name;

    $target_dir = "../dist/temp_data/" . $data_baru;
    $path = move_uploaded_file($_FILES['file']['tmp_name'], $target_dir);
    unlink($path);

    error_reporting(0);
    ini_set('display_error', 0);

    $reader = new SpreadsheetReader($target_dir);
    $no = 1;
    foreach ($reader as $row) {
        $nisn           =   $row[0];
        $nis            =   $row[1];
        $nama_siswa     =   $row[2];
        $tempat         =   $row[3];
        $tanggal_lahir  =   $row[4];
        $ibu            =   $row[5];
        $ayah           =   $row[6];
        $jk             =   $row[7];
        $kelas          =   $row[8];
        $nohp           =   $row[9];
        $alamat         =   $row[10];
        $status         =   $row[11];
        $id_tahun       =   $row[12];
        if (
            $nisn == "" && $nisn == "" && $nama_siswa == "" && $tempat == "" && $tanggal_lahir == "" && $ibu == "" && $ayah == "" && $jk == "" && $kelas == ""
            && $nohp == "" && $alamat == "" && $status == "" && $id_tahun == ""
        )
            continue;

        if ($no > 1) {
            mysqli_query($koneksi, "INSERT INTO siswa VALUES('$nisn','$nis','$nama_siswa','$tempat','$tanggal_lahir','$ibu','$ayah','$jk','$kelas','$nohp','$alamat','$status','$id_tahun')");
            header("location:../admin/master_siswa?pesan=tambah");
        } else {
            header("location:../admin/master_siswa?pesan=gagal");
        }
        $no++;
    }
}
