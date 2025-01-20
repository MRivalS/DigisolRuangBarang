<?php
require 'inc_koneksi.php'; // Koneksi ke database
include("inc_header.php");

// Query untuk data yang sudah dikonfirmasi
$role = $_SESSION['role'];
$nama = $_SESSION['nama'];

// Proses update atau tambah data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['User_ID'];
    $nama_mhs = $_POST['Nama'];
    $nim_mhs = $_POST['NIM'];
    $no_hp = $_POST['Nomor_Telepon'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);  // Menggunakan password_hash() yang lebih aman
    $Role = $_POST['Role'];

    try {
        if ($id) {
            // Update data
            $sqlUpdate = "UPDATE user SET Nama = ?, NIM = ?, Nomor_Telepon = ?, Password = ?, Role = ? WHERE User_ID = ?";
            $stmt = $koneksi->prepare($sqlUpdate);
            $stmt->bind_param("sssssi", $nama_mhs, $nim_mhs, $no_hp, $password, $Role, $id);
            $stmt->execute();
            $_SESSION['message'] = "Data berhasil diperbarui!";
        } else {
            // Tambah data baru
            $sqlTambah = "INSERT INTO user (Nama, NIM, Nomor_Telepon, Password, Role) VALUES (?, ?, ?, ?, ?)";
            $stmt = $koneksi->prepare($sqlTambah);
            $stmt->bind_param("sssss", $nama_mhs, $nim_mhs, $no_hp, $password, $Role);
            $stmt->execute();
            $_SESSION['message'] = "Data berhasil ditambahkan!";
        }
    } catch (mysqli_sql_exception $e) {
        // Menangani error SQL (misalnya duplicate entry)
        $_SESSION['error'] = "Terjadi kesalahan saat memproses data: " . $e->getMessage();
    }

    header("Location: tambahan_kelola_data_user.php");
    exit;
}


// Ambil data user
$sqlUser = "SELECT * FROM user";
$resultUser = $koneksi->query($sqlUser);

// Ambil data Role yang tersedia
$sqlRole = "SELECT DISTINCT Role FROM user";
$resultRole = $koneksi->query($sqlRole);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ruang Barang</title>
    <link rel="icon" href="./assets/img/LogoRB.png" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="admin.php">
            <img src="assets/img/HomeRB.png" alt="Logo" style="width: 120px; height: 40px" />
        </a>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <!-- Sidebar code here -->
        </div>

        <div id="layoutSidenav_content">
            <div class="container-fluid px-4">
                <h1 class="mt-4">Manajemen Data User</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Solusi Terbaik Untuk Anda</li>
                </ol>

                <!-- Menampilkan Pesan Error atau Sukses -->
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['message']; ?>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                <?php elseif (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['error']; ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <div class="container">
                    <div class="form-container">
                        <form method="POST" action="">
                            <!-- Form input data user -->
                            <input type="hidden" name="User_ID" id="User_ID">
                            <div class="mb-3">
                                <label for="Nama" class="form-label">Nama</label>
                                <input type="text" name="Nama" class="form-control" id="Nama" placeholder="Masukkan Nama Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="NIM" class="form-label">NIM</label>
                                <input type="text" name="NIM" class="form-control" id="NIM" placeholder="Masukkan NIM Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="Nomor_Telepon" class="form-label">No HP</label>
                                <input type="text" name="Nomor_Telepon" class="form-control" id="Nomor_Telepon" placeholder="Masukkan No HP Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="Password" class="form-label">Password</label>
                                <input type="password" name="Password" class="form-control" id="Password" placeholder="Masukkan Password Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="Role" class="form-label">Sebagai</label>
                                <select class="form-select" name="Role" id="Role" required>
                                    <option value="" disabled selected>Masukkan Sebagai</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Staff">Staff</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel Data User -->
                    <div class="card" style="margin-top: 30px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>No HP</th>
                                    <th>Password</th>
                                    <th>Sebagai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($resultUser->num_rows > 0) {
                                    while ($row = $resultUser->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['User_ID'] . "</td>";
                                        echo "<td>" . $row['Nama'] . "</td>";
                                        echo "<td>" . $row['NIM'] . "</td>";
                                        echo "<td>" . $row['Nomor_Telepon'] . "</td>";
                                        echo "<td>" . $row['Password'] . "</td>";
                                        echo "<td>" . $row['Role'] . "</td>";
                                        echo "<td><a href='?hapus=" . $row['User_ID'] . "'>Hapus</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
