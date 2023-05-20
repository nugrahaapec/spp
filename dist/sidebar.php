<aside class="main-sidebar sidebar-light-primary elevation-4">
  <a class="brand-link">
    <img src="../logo/logo.png" class="brand-image img-circle elevation-3" style="opacity: 1">
    <span class="brand-text font-weight-black"><b>SMK MHS</b></span>
  </a>
  </br>

  <div class="sidebar">
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item menu-open">
        <li class="nav-item">
          <a href="home" class="nav-link">
            <i class="fas fa-home nav-icon"></i>
            <p>Dashboard</p>
          </a>
        </li>
        </li>

        <li class="nav-item">
          <a href="pembayaran" class="nav-link">
            <i class="fas fa-file-invoice nav-icon"></i>
            <p>Pembayaran</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-file nav-icon"></i>
            <p>
              Pengaturan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="pay" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nama Pembayaran</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="setpay" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Jenis Pembayaran</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Master Data
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="master_siswa" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Siswa</p>
              </a>
            </li>
          </ul>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="bulan" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Bulan</p>
              </a>
            </li>
          </ul>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="tahun" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tahun Pelajaran</p>
              </a>
            </li>
          </ul>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="kelas" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Kelas</p>
              </a>
            </li>
          </ul>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="kenaikankelas" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Kenaikan Kelas</p>
              </a>
            </li>
          </ul>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="kelulusan" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Kelulusan</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Laporan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="laporan_month" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pembayaran Bulanan</p>
              </a>
            </li>
          </ul>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="laporan" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pembayaran Lainnya</p>
              </a>
            </li>
          </ul>
        </li>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="kwitansi">
            <i class="nav-icon fa fa-receipt"></i>
            <p>
              Cetak Kwitansi
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="user" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Management User
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-default">
            <i class="nav-icon fa fa-sign-out-alt"></i>
            <p>
              Sign Out
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="backup" class="nav-link">
            <i class="nav-icon fas fa-server"></i>
            <p>
              Backup Database
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Yakin ingin Keluar?</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Klik <strong>"Sign Out"</strong> dibawah ini jika anda yakin.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="logout">Sign Out</a>
      </div>
    </div>
  </div>
</div>