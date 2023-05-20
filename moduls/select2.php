<?php
include '../conn/config.php';

if (isset($_POST["id"])) {
    $id = $_POST['id'];
    $option = $_POST['op'];
    if ($option == '1') {
        $query = "SELECT * FROM siswa WHERE kelas = '$id'";
        $result = $koneksi->query($query);
        if (!$result) {
            printf("Errormessage: %s\n", $koneksi->error);
        } else {
            echo "<option value=''> --- Pilih Siswa ---- </option>";
            while ($data = $result->fetch_array(MYSQLI_ASSOC)) {
                echo "<option value='" . $data['nisn'] . "'>" . $data['nama_siswa'] . "</option>";
            }
        }
    }
}
