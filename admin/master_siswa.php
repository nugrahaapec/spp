<?php
require '../conn/config.php';
include '../dist/cek.php';
include '../dist/header.php';
include '../dist/nav.php';
include '../dist/sidebar.php';
include '../dist/indo.php';
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Siswa</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-success card-outline">
            <div class="card-header">
              <div class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#modal-default1">
                <i class="fa fa-folder-plus"></i>&nbsp; Tambah Data
              </div>
              <a href="pembayaran" class="btn btn-info btn-sm">
                <i class=" fa fa-money-bill"></i>&nbsp; Proses Pembayaran
              </a>
              <div class="btn btn-success btn-sm float-right ml-2" href="#" data-toggle="modal" data-target="#modal-upload">
                <i class="fas fa-upload"></i>&nbsp; Upload Data Siswa
              </div>
              <a href="../dist/format_siswa.xlsx" class="btn btn-light btn-sm float-right">
                <i class=" fas fa fa-download"></i>&nbsp; Download Format Siswa
              </a>
            </div>

            <div class="card-body">
              <table id="example2" class="table table-sm text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $s = mysqli_query($koneksi, "SELECT * from siswa INNER JOIN kelas ON siswa.kelas = kelas.id_kelas WHERE siswa.status = '1' order by kelas ASC");
                  while ($data = mysqli_fetch_array($s)) {
                  ?>
                    <tr>
                      <td> <?= $no++; ?> </td>
                      <td> <?= $data['nisn'] ?> / <?= $data['nis'] ?></td>
                      <td> <?= $data['nama_siswa'] ?> </td>
                      <td> <?= $data['nama_kelas'] ?> </td>
                      <td> <?php
                            if ($data['status'] == 0) {
                              echo '<span class="btn btn-danger btn-sm"><b>Tidak Aktif</b></span>';
                            } elseif ($data['status'] == 1) {
                              echo '<span class="btn btn-success btn-sm"><b>Aktif</b></span>';
                            }
                            ?> </td>
                      <td>
                        <a href="detail_siswa?nisn=<?= $data['nisn'] ?>" class=" btn btn-xs btn-primary" data-toggle="tooltip" title="" data-original-title="Lihat"><i class="fa fa-eye"></i></a>
                        <button type="button" class="btn btn-danger btn-xs" name="hapus" title="Hapus" data-href="../moduls/delete_siswa?nisn=<?= $data['nisn']; ?>" data-toggle="modal" data-target="#modal-hapus">
                          <i class=" fas fa-trash-restore"></i></button>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include '../dist/footer.php' ?>

  <div class="modal fade" id="modal-hapus">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Data SIswa Akan Dihapus?</h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik <strong>"Hapus"</strong> dibawah ini jika anda yakin.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger btn-ok">Hapus</a>
        </div>
      </div>
    </div>
  </div>

  <div id="modal-upload" class="modal fade show">
    <div class="modal-dialog modal-xs">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Upload Data Siswa</h4>
        </div>
        <form action="../moduls/upload_siswa" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <input type="file" name="file" id="file" class="form-group-input">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" name="upload" value="upload" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-master">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Data Akan Dihapus?</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Klik <strong>"Hapus"</strong> dibawah ini jika anda yakin.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn-ok">Hapus</a>
      </div>
    </div>
  </div>
</div>

<div id="modal-default1" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h4>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Data Pribadi</a></li>
              <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Data Sekolah</a></li>
              <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Data Keluarga</a></li>
            </ul>
          </div>

          <form name="form" action="../moduls/tambah_siswa" onsubmit="return validateForm()" method="post">
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="activity">
                  <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input name="nama_lengkap" type="text" class="form-control" placeholder="Nama Lengkap">
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_k" class="form-control custom-select">
                      <option>Pilih Salah Satu</option>
                      <option>laki-laki</option>
                      <option>Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input name="tempat_lahir" type="text" class="form-control" placeholder="Contoh: Jakarta">
                  </div>
                  <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <div class="input-group mb-3">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fa fa-calendar-alt"></span>
                        </div>
                      </div>
                      <input type="text" name="tanggal" class="form-control" id="reservationdate" data-target="#reservationdate" data-toggle="datetimepicker" value="<?= date('Y-m-d'); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat_siswa" class="form-control" placeholder="Masukan Alamat"></textarea>
                  </div>

                  <div class="form-group">
                    <label>Status Siswa</label>
                    <select name="s_status" class="form-control custom-select">
                      <option> Pilih Status Siswa</option>
                      <option value="1">Aktif</option>
                      <option value="0">Tidak Aktif</option>
                    </select>
                  </div>
                </div>


                <div class="tab-pane" id="timeline">
                  <div class="form-group">
                    <label>NISN</label>
                    <input name="nisn" type="text" class="form-control" placeholder="NISN">
                  </div>
                  <div class="form-group">
                    <label>NIS</label>
                    <input name="nis" type="text" class="form-control" placeholder="NIS">
                  </div>
                  <div class="form-group">
                    <label>Kelas</label>
                    <select name="kelas" class="form-control custom-select">
                      <option> Pilih Kelas</option>
                      <<?php
                        $query = mysqli_query($koneksi, "SELECT * FROM kelas  order by `nama_kelas` asc");
                        if (mysqli_num_rows($query) == 0) {
                          echo "<option>Pilih Kelas</option>";
                        } else {
                          $no = 1;
                          while ($r = mysqli_fetch_array($query)) :
                        ?> <option value="<?= $r['id_kelas']; ?>"><?php echo $r['nama_kelas'] ?>
                        </option>
                    <?php
                          endwhile;
                        }
                    ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tahun Pelajaran</label>
                    <select name="tahun_masuk" class="form-control custom-select">
                      <option> Tahun Pelajaran</option>
                      <<?php
                        $query = mysqli_query($koneksi, "SELECT * FROM tahun ORDER BY tahun_awal DESC");
                        if (mysqli_num_rows($query) == 0) {
                          echo "<option>Tahun Masuk</option>";
                        } else {
                          $no = 1;
                          while ($r = mysqli_fetch_array($query)) :
                        ?> <option value="<?php echo $r['id_tahun'] ?>"><?php echo $r['tahun_awal'] ?>/<?php echo $r['tahun_akhir'] ?>
                        </option>
                    <?php
                          endwhile;
                        }
                    ?>
                    </select>
                  </div>
                </div>

                <div class="tab-pane" id="settings">
                  <div class="form-group">
                    <label>Nama Ayah Kandung</label>
                    <input name="ayah" type="text" class="form-control" placeholder="Nama Lengkap Ayah">
                  </div>
                  <div class="form-group">
                    <label>Nama Ibu Kandung</label>
                    <input name="ibu" type="text" class="form-control" placeholder="Nama Lengkap Ibu">
                  </div>
                  <div class="form-group">
                    <label>No Handphone Orang Tua</label>
                    <input name="no_hp" type="number" class="form-control" placeholder="Nomor Handphone Aktif">
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan1" class="btn btn-primary">Simpan</button>
                  </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      function validateForm() {
        let x = document.forms["form"]["nama_lengkap", "tempat_lahir", "tanggal_lahir", "nisn", "nis"].value;
        if (x == "") {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2500,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          Toast.fire({
            icon: 'warning',
            title: '&emsp; Masih Ada Data Kosong'
          });
          return false;
        }
      }
    </script>
    <script>
      $('#modal-hapus').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });
    </script>