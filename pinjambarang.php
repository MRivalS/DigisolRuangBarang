<?php
session_start();
include("inc_header.php");
include("inc_koneksi.php");


// Query untuk mengambil barang yang tersedia
$queryBarangTersedia = "SELECT * FROM barang WHERE status = 'tersedia'";
$resultBarangTersedia = $koneksi->query($queryBarangTersedia);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $kode_barang = $_POST['kode_barang'];
  $tanggal_mulai = $_POST['tanggal_mulai'];
  $tanggal_selesai = $_POST['tanggal_selesai'];
  $jam_mulai = $_POST['jam_mulai'];
  $jam_selesai = $_POST['jam_selesai'];
  $deskripsi = $_POST['deskripsi'];
  $user_id = $_SESSION['user_id']; // Ambil dari session user

  // Insert ke tabel peminjaman_barang
        $query = "INSERT INTO peminjaman_barang 
(barang, tanggal_mulai, tanggal_selesai, jam_mulai, jam_selesai, deskripsi, status, admin_status, kode_barang, user_id) 
SELECT nama_barang, '$tanggal_mulai', '$tanggal_selesai', '$jam_mulai', '$jam_selesai', '$deskripsi', 'pending', 'pending', kode_barang, '$user_id'
FROM barang WHERE kode_barang = '$kode_barang'";


if ($koneksi->query($query)) {
  // Hapus barang dari tabel barang
  $deleteQuery = "DELETE FROM barang WHERE kode_barang = '$kode_barang'";
  $koneksi->query($deleteQuery);
  
    echo "<script>alert('Pengajuan peminjaman berhasil!, lakukan konfirmasi anda dan staf!.');</script>";
  } else {
    echo "<script>alert('Terjadi kesalahan: " . $koneksi->error . "');</script>";
  }
}


// Ambil data barang yang tersedia
$queryBarangTersedia = "SELECT kode_barang, nama_barang FROM barang WHERE status = 'tersedia'";
$resultBarangTersedia = $koneksi->query($queryBarangTersedia);

// Query untuk data yang sudah dikonfirmasi
$confirmedResult = $koneksi->query("SELECT * FROM peminjaman_barang WHERE status IN ('pending')");



$role = $_SESSION['role'];
$nama = $_SESSION['nama'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Ruang Barang</title>
  <link rel="icon" href="./assets/img/LogoRB.png" />
  <link
    href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css"
    rel="stylesheet" />

  <link href="css/styles.css" rel="stylesheet" />
  <script
    src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"
    crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="user.php">
      <img
        src="assets/img/HomeRB.png"
        alt="Logo"
        style="width: 120px; height: 40px" />
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

      <body>
        <h1 style="color: white; font-size: 24px; font-family: 'Poppins', sans-serif; margin: 0;">
          Hello, <?php echo $nama ?>, (<?php echo $role ?>)
        </h1>
      </body>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#!">profile</a></li>
          <li><a class="dropdown-item" href="#!">Activity Log</a></li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="formlogin.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">HOME</div>
            <a class="nav-link" href="user.php">
              <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                  <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                </svg></div>
              Home
            </a>
            <div class="sb-sidenav-menu-heading">Layanan</div>
            <a
              class="nav-link collapsed"
              href="user.php"
              data-bs-toggle="collapse"
              data-bs-target="#collapseLayouts1"
              aria-expanded="false"
              aria-controls="collapseLayouts1">
              <div class="sb-nav-link-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                  <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5" />
                  <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
                </svg>
              </div>
              PEMINJAMAN
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div
              class="collapse"
              id="collapseLayouts1"
              aria-labelledby="headingOne"
              data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="pinjambarang.php">Pinjam Barang</a>
                <a class="nav-link" href="pinjamruangan.php">Pinjam Ruangan</a>
              </nav>
            </div>
            <a class="nav-link" href="konfirmasi.php">
              <div class="sb-nav-link-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                  <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                </svg>
              </div>
              KONFIRMASI
            </a>


            <a
              class="nav-link collapsed"
              href="#"
              data-bs-toggle="collapse"
              data-bs-target="#collapseLayouts2"
              aria-expanded="false"
              aria-controls="collapseLayouts2">
              <div class="sb-nav-link-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-minus" viewBox="0 0 16 16">
                  <path d="M5.5 9a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5" />
                  <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
                </svg>
              </div>
              PENGEMBALIAN
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            <div
              class="collapse"
              id="collapseLayouts2"
              aria-labelledby="headingTwo">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="pengembalianbarang.php">Barang</a>
                <a class="nav-link" href="pengembalianruangan.php">Ruangan</a>
              </nav>
            </div>


          </div>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">FORM PEMINJAMAN BARANG</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="user.php">Home</a></li>
            <li class="breadcrumb-item active">Isi Data Dengan Tepat</li>
          </ol>
          <div class="container">
            <div class="form-container">
              <form method="POST">
                <input type="hidden" name="pinjam" value="1">
                <!-- Pilih Barang -->
                <div class="mb-3">
                  <label for="barang" class="form-label">Pilih Barang*</label>
                  <select class="form-select" name="kode_barang" required>
                    <option value="" disabled selected>Masukkan barang</option>
                    <?php
                    if ($resultBarangTersedia->num_rows > 0) {
                      while ($row = $resultBarangTersedia->fetch_assoc()) {
                        echo "<option value='" . $row['kode_barang'] . "'>" . $row['nama_barang'] . "</option>";
                      }
                    } else {
                      echo "<option value='' disabled>Tidak ada barang tersedia</option>";
                    }
                    ?>
                  </select>
                </div>
                <!-- Tanggal Mulai dan Selesai -->
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="tanggalMulai" class="form-label">Tanggal Mulai*</label>
                    <input type="date" class="form-control" name="tanggal_mulai" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="tanggalSelesai" class="form-label">Tanggal Selesai*</label>
                    <input type="date" class="form-control" name="tanggal_selesai" required>
                  </div>
                </div>
                <!-- Jam Mulai dan Selesai -->
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="jamMulai" class="form-label">Jam Mulai*</label>
                    <input type="time" class="form-control" name="jam_mulai" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="jamSelesai" class="form-label">Jam Selesai*</label>
                    <input type="time" class="form-control" name="jam_selesai" required>
                  </div>
                </div>
                <!-- Deskripsi Peminjaman -->
                <div class="mb-3">
                  <label for="deskripsi" class="form-label">Deskripsi Peminjaman*</label>
                  <textarea class="form-control" name="deskripsi" rows="4" placeholder="Kasih alasannya dong..." required></textarea>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-lg">Kirim</button>

              </form>
            </div>
          </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; BY DIGISOL 2024</div>

          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
</body>

</html>