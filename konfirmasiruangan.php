<?php
session_start();
include("inc_koneksi.php");


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
    <button
      class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
      id="sidebarToggle"
      href="#!">
      <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->
    <form
      class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <div class="input-group">

        <body>
          <h1 style="color: white; font-size: 24px; font-family: 'Poppins', sans-serif; margin: 0;">
            Hello, <?php echo $nama ?>, (<?php echo $role ?>)
          </h1>
        </body>
      </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle"
          id="navbarDropdown"
          href="#"
          role="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="profile.php">Profile</a></li>
          <li><a class="dropdown-item" href="#!">Activity Log</a></li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="formlogin.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark collapse" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <div class="sb-sidenav-menu-heading">Home</div>
          <a class="nav-link" href="user.php">
            <div class="sb-nav-link-icon">
              <i class="bi bi-house-door"></i>
            </div>
            Home
        </div>
        <a class="nav-link" href="user.php">
          <div class="sb-nav-link-icon">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="currentColor"
              class="bi bi-house-door"
              viewBox="0 0 16 16">
              <path
                d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
            </svg>
          </div>
          Home
        </a>
        <div class="sb-sidenav-menu-heading">Layanan</div>

        <a
          class="nav-link collapsed"
          href="#"
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
            <a class="nav-link" href="pengembalianbarang.php">Barang </a>
            <a class="nav-link" href="pengembalianruangan.php"> Ruangan </a>
          </nav>
        </div>

      </div>
  </div>
  </nav>
  </div>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4">
        <h1 class="mt-4">KONFIRMASI PEMINJAMAN RUANGAN</h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="user.php">Home</a></li>
          <li class="breadcrumb-item active">Data Konfirmasi Ruangan</li>
        </ol>
        <div class="card mb-4">
          <div class="card-header">
            <i class="fas fa-table me-1"></i>
            View Konfirmasi Peminjaman Ruangan
          </div>
          <!-- Tabel responsif -->
          <div class="table-responsive">
            <table class="table table-dark table-striped">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Ruangan</th>
                  <th scope="col">Tgl. Pinjam</th>
                  <th scope="col">Tgl. Kembali</th>
                  <th scope="col">Riwayat</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <!-- PHP untuk data tabel -->
                <?php
                $no = 1;
                if ($confirmedResult->num_rows > 0) {
                  while ($row = $confirmedResult->fetch_assoc()) {
                    echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nama_ruangan']}</td>
                                <td>{$row['tanggal_mulai']}</td>
                                <td>{$row['tanggal_selesai']}</td>
                                <td>{$row['riwayat']}</td>
                                <td>{$row['status']}</td>
                            </tr>";
                    $no++;
                  }
                } else {
                  echo "<tr><td colspan='6'>Belum ada data konfirmasi.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
      <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
          <div class="text-muted">Copyright &copy; Your Website 2023</div>

        </div>
      </div>
    </footer>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
</body>

</html>