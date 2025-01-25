<?php
require 'inc_koneksi.php'; // Koneksi ke database
include("inc_header.php");

// Ambil data user berdasarkan sesi
$role = $_SESSION['role'];
$nama = $_SESSION['nama'];

// Proses hapus data barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sqlHapus = "DELETE FROM user WHERE User_ID = ?";
    $stmt = $koneksi->prepare($sqlHapus);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: tambahan_kelola_data_user.php");
    exit;
}

// Proses update atau insert data user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['User_ID'];
    $nama_mhs = $_POST['Nama'];
    $nim_mhs = $_POST['NIM'];
    $no_hp = $_POST['Nomor_Telepon'];
    $password = md5($_POST['Password']); // Enkripsi password
    $role = $_POST['Role'];

    if ($id) {
        // Update data
        $sqlUpdate = "UPDATE user SET Nama = ?, NIM = ?, Nomor_Telepon = ?, Password = ?, Role = ? WHERE User_ID = ?";
        $stmt = $koneksi->prepare($sqlUpdate);
        $stmt->bind_param("sssssi", $nama_mhs, $nim_mhs, $no_hp, $password, $role, $id);
        $stmt->execute();
    } else {
        // Tambah data baru
        $sqlTambah = "INSERT INTO user (Nama, NIM, Nomor_Telepon, Password, Role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($sqlTambah);
        $stmt->bind_param("sssss", $nama_mhs, $nim_mhs, $no_hp, $password, $role);
        $stmt->execute();
    }
    header("Location: tambahan_kelola_data_user.php");
    exit;
}

// Ambil data user
$sqlUser = "SELECT * FROM user";
$resultUser = $koneksi->query($sqlUser)

?>

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
        <a class="navbar-brand ps-3" href="admin.php">
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
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Home</div>
                        <a class="nav-link" href="staf.php">
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
                        <div class="sb-sidenav-menu-heading">Kelola</div>

                        <a
                            class="nav-link collapsed"
                            href=""
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts1"
                            aria-expanded="false"
                            aria-controls="collapseLayouts1">
                            <div class="sb-nav-link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-add" viewBox="0 0 16 16">
                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0" />
                                    <path d="M12.096 6.223A5 5 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.5 4.5 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-.813-.927Q8.378 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.6 4.6 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10q.393 0 .774-.024a4.5 4.5 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4" />
                                </svg>
                            </div>
                            KELOLA DATA
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
                                <a class="nav-link" href="kelolabarang.php">Data Barang</a>
                                <a class="nav-link" href="kelolaruangan.php">Data Ruangan</a>
                                <a class="nav-link" href="tambahan_kelola_data_user.php">Data User</a>
                            </nav>
                        </div>

                        <div class="sb-sidenav-menu-heading">RIWAYAT</div>
                        <a class="nav-link" href="riwayatpinjamadmin.php">
                            <div class="sb-nav-link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z" />
                                </svg>
                            </div>
                            RIWAYAT PEMINJAM
                        </a>


                        <div class="sb-sidenav-menu-heading">KONFIRMASI</div>
                        <a class="nav-link" href="konfirmasiadmin.php">
                            <div class="sb-nav-link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                                </svg>
                            </div>
                            KONFIRMASI
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h3 class="mt-4">Kelola Data User</h3>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="Nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="Nama" name="Nama" required />
                                </div>
                                <div class="mb-3">
                                    <label for="NIM" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="NIM" name="NIM" required />
                                </div>
                                <div class="mb-3">
                                    <label for="Nomor_Telepon" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="Nomor_Telepon" name="Nomor_Telepon" required />
                                </div>
                                <div class="mb-3">
                                    <label for="Password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="Password" name="Password" required />
                                </div>
                                <div class="mb-3">
                                    <label for="Role" class="form-label">Role</label>
                                    <select class="form-select" id="Role" name="Role" required>
                                        <option value="Mahasiswa">Mahasiswa</option>
                                        <option value="Staff">Staff</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Nomor Telepon</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($user = $resultUser->fetch_assoc()) : ?>
                                        <tr>
                                            <td><?php echo $user['User_ID']; ?></td>
                                            <td><?php echo $user['Nama']; ?></td>
                                            <td><?php echo $user['NIM']; ?></td>
                                            <td><?php echo $user['Nomor_Telepon']; ?></td>
                                            <td><?php echo $user['Password']; ?></td>
                                            <td><?php echo $user['Role']; ?></td>
                                            <td>
                                                <a href="?edit=<?php echo $user['User_ID']; ?>" class="btn btn-warning">Edit</a>
                                                <a href="?hapus=<?php echo $user['User_ID']; ?>" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>