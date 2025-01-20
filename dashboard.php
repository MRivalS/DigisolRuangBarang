<?php
session_start();
include("inc_koneksi.php");

$role = $_SESSION['role'];
$nama = $_SESSION['nama'];

if ($role == 'Mahasiswa'):{
    header('Location: user.php');
} elseif ($role == 'Staff'):{
    header('Location: staf.php');
}elseif ($role == 'dosen'):{
    header('Location: dosen.php');
}endif;

?>

