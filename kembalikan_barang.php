<?php
session_start();
include 'inc_koneksi.php'; // Pastikan file koneksi ke database Anda sudah benar

// Pastikan hanya user yang sudah login dapat mengakses halaman ini
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kembalikan_barang'])) {
    $kode_barang = $_POST['id_peminjaman']; // Menggunakan kode_barang dari input hidden

    // Ambil data barang yang dikembalikan
    $queryBarang = "SELECT * FROM peminjaman_barang WHERE kode_barang = '$kode_barang'";
    $result = $koneksi->query($queryBarang);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_barang = $row['barang'];

        // Periksa apakah kode_barang sudah ada di tabel barang
        $checkQuery = "SELECT * FROM barang WHERE kode_barang = '$kode_barang'";
        $checkResult = $koneksi->query($checkQuery);

        if ($checkResult->num_rows === 0) {
            // Masukkan barang kembali ke tabel barang
            $insertQuery = "INSERT INTO barang (nama_barang, kode_barang) VALUES ('$nama_barang', '$kode_barang')";
            if ($koneksi->query($insertQuery)) {
                // Hapus peminjaman dari tabel peminjaman_barang
                $deleteQuery = "DELETE FROM peminjaman_barang WHERE kode_barang = '$kode_barang'";
                if ($koneksi->query($deleteQuery)) {
                    echo "<script>alert('Barang berhasil dikembalikan!');</script>";
                } else {
                    echo "<script>alert('Gagal menghapus data peminjaman: " . $koneksi->error . "');</script>";
                }
            } else {
                echo "<script>alert('Terjadi kesalahan saat mengembalikan barang: " . $koneksi->error . "');</script>";
            }
        } else {
            echo "<script>alert('Barang dengan kode ini sudah ada di tabel barang.');</script>";
        }
    } else {
        echo "<script>alert('Data peminjaman tidak ditemukan.');</script>";
    }
}


// Ambil data peminjaman dari database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM peminjaman_barang WHERE user_id = '$user_id' AND status = 'terkonfirmasi'";
$result = $koneksi->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Barang</title>
    <link rel="stylesheet" href="style.css"> <!-- Ganti dengan file CSS Anda -->
</head>
<body>
    <div class="container">
        <h1>Pengembalian Barang</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kode Barang</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['barang']); ?></td>
                            <td><?= htmlspecialchars($row['kode_barang']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal_mulai']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal_selesai']); ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="id_peminjaman" value="<?= $row['kode_barang']; ?>">
                                    <button type="submit" name="kembalikan_barang" class="btn btn-success">Kembalikan</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Tidak ada barang yang sedang dipinjam.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</body>
</html>
