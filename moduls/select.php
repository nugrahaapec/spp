<?php
include '../conn/config.php';
include '../dist/header.php';
include '../dist/indo1.php';

if (isset($_POST["data_id"]) && isset($_POST["data_nisn"])) {
    $data_id = $_POST["data_id"];
    $data_nisn = $_POST["data_nisn"];
    $query = "SELECT * FROM lain_pay 
    INNER JOIN pos ON lain_pay.id_pay = pos.id_pos 
    INNER JOIN tahun ON lain_pay.id_tahun = tahun.id_tahun
    WHERE lain_pay.id_pay = '$data_id' AND lain_pay.nisn = '$data_nisn' ";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);
    if ($data) {
        echo "
    <div class='form-group'>
      <input name='nisn' type='hidden' class='form-control' value='" . $data['nisn'] . "' >
      <input name='nis' type='hidden' class='form-control' value='" . $data['nis'] . "' >
      <input name='kelas' type='hidden' class='form-control' value='" . $data['id_kelas'] . "' >
      <input name='tahun' type='hidden' class='form-control' value='" . $data['id_tahun'] . "' >
      <input name='pay' type='hidden' class='form-control' value='" . $data['id_pay'] . "' >
      <label>Nama Pembayaran</label>
      <input type='text' class='form-control' value='" . $data['nama_pos'] . " T.A " . $data['tahun_awal'] . "/" . $data['tahun_akhir'] . "' readonly>
      </div>
      <div class='form-group'>
      <label>Tanggal Pembayran</label>
      <input type='text' name='tanggal_pay' id='tanggal_pay' class='form-control' value='" . date('Y-m-d') . "' readonly>
      <input type='hidden' name='status_pay' id='status_pay' class='form-control' value='1' readonly>
      </div>
      <div class='row'>
      <div class='form-group col-6'>
      <label>Jumlah Bayar</label>
      <input name='bayar_pay' id='bayar_pay' type='text' class='form-control numeric' required>
      </div>";
        echo "
      <div class='form-group col-6'>
      <label>Keterangan</label>
      <input name='keterangan_pay' id='keterangan_pay' type='text' class='form-control' required>
      </div>
    ";
    }
}
if (isset($_POST["nisn_siswa"]) && isset($_POST["id_pay"])) {
    $id_pay = $_POST["id_pay"];
    $nisn_siswa = $_POST["nisn_siswa"];
    echo "
<table class='table table-sm'>
    <thead>
        <tr>
            <th> NO </th>
            <th> Tanggal Pembayaran </th>
            <th> Jumlah Bayar </th>
            <th> Keterangan </th>
            <th> Batal Bayar </th>
        </tr>
    </thead>";
    $no = 0;
    $query = mysqli_query($koneksi, "SELECT * FROM lain_pay_proses WHERE nisn = '$nisn_siswa' AND id_pay = '$id_pay' ORDER BY tanggal DESC");
    if (mysqli_num_rows($query)) {
        while ($data = mysqli_fetch_assoc($query)) :
            $no++;
            echo "
    <tbody>
        <tr>
            <td> $no </td>
            <td> " . tgl_indo(date($data['tanggal'])) . " </td>
            <td class='numeric'> $data[biaya] </td>
            <td> $data[keterangan] </td>
            <td> <a href='../moduls/delete_cash?id_proses=$data[id_proses]' name='hapus_pay' onclick='return konfirmasi()' class='btn btn-xs btn-danger'>Batalkan Pembayaran</a></td>
        </tr>";
        endwhile;
    } else {
        echo "<td colspan=12><br><lable>Belum Ada Transaksi.</lable></br></td>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "
            <div class='modal-footer'>
            <button class='btn btn-secondary' data-dismiss='modal'>Tutup</button>
            </div>";
}
