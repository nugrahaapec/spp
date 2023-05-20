<?php
include '../conn/config.php';
include '../dist/header.php';
include '../dist/indo1.php';



if (isset($_POST["id_pay"]) && isset($_POST["nisn_siswa"])) {
  $id_pay = $_POST["id_pay"];
  $nisn_siswa = $_POST["nisn_siswa"];
  $no = 1;
  $query = "SELECT * FROM lain_pay_proses 
    INNER JOIN siswa ON siswa.nisn = lain_pay_proses.nisn
    INNER JOIN pos ON lain_pay_proses.id_pay = pos.id_pos
    WHERE lain_pay_proses.id_pay = '$id_pay' AND lain_pay_proses.nisn = '$nisn_siswa' ";
  $result = mysqli_query($koneksi, $query);
  while ($data = mysqli_fetch_array($result)) {
    echo "
        <table class='table table-sm text-nowrap'>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pembayaran</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td> '" . $no++ . "'</td>
                <td> '" . $data['nama_pos'] . "'</td>
                <td> '" . $data['keterangan'] . "' </td>
                <td>
                </td>
            </tr>
    </tbody>
    </table>
    ";
  }
} else {
  echo "Belum ada transaksi yang dilakukan";
}
