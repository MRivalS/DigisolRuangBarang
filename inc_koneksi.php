<?php
$host = "127.0.0.1:3306"; // Ganti dengan host Anda
$user = "u715710898_root"; // Ganti dengan username Anda
$password = "Ruangbarang10"; // Ganti dengan password Anda
$database = "u715710898_multiuser"; // Pastikan ini adalah nama database Anda (tutup dengan tanda kutip)

$koneksi = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error); // Gunakan $koneksi, bukan $conn
} 
?>
