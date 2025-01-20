<?php
session_start();
include("inc_koneksi.php");
if(!isset($_SESSION['admin_username'])){
    header("locatio:formlogin.php");
}

// Cegah cache browser
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1
header('Pragma: no-cache'); // HTTP 1.0
header('Expires: 0'); // Proxies

?>

