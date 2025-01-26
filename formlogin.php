<?php
session_start();
$conn = new mysqli('127.0.0.1:3306', 'u715710898_root', 'Ruangbarang10', 'u715710898_multiuser');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['NIM'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM user WHERE NIM = '$nim' AND Password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['User_ID'];
        $_SESSION['role'] = $user['Role'];
        $_SESSION['nama'] = $user['Nama'];

        // Redirect berdasarkan role
        if ($user['Role'] == 'Mahasiswa') {
            header('Location: dashboard.php');
        } elseif ($user['Role'] == 'Staff') {
            header('Location: dashboard.php');
        }
    } else {
        header("locatio:formlogin.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Barang</title>
    <link rel="icon" href="./assets/img/LogoRB.png" />
    <link rel="stylesheet" href="./assets/img/LogoRB.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        /* Reset dasar */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .login-container {
            text-align: center;
            width: 100%;
        }

        .login-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            width: 350px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        .logo img {
            width: 70px;
            /* Sesuaikan dengan ukuran gambar logo Anda */
            margin-bottom: 20px;
        }

        h2 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }

        p {
            color: #666;
            font-size: 14px;
            margin: 5px 0 20px 0;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-login {
            background-color: #88c0d0;
            /* Warna biru muda sesuai desain */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #5a98a8;
            /* Warna biru lebih gelap untuk hover */
        }

        footer {
            margin-top: 20px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card" class="table-responsive">
            <div class="logo">
                <!-- Ganti logo.png dengan gambar logo Anda -->
                <img src="./assets/img/LogoRB.png" alt="Logo">
            </div>
            <h2>Login</h2>
            <p>Masuk dengan akun Anda</p>
            <form method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="NIM" placeholder="Masukkan Nim" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>
                <button type="submit" name="login" class="btn-login">Login</button>
            </form>

        </div>
        <footer>
            <p>Copyright © By DIGISOL 2024</p>
        </footer>
    </div>
    <script>
        // Menambahkan state kosong ke history
        history.pushState(null, null, window.location.href);

        // Tangkap event "popstate"
        window.addEventListener('popstate', function(event) {
            // Mengatur ulang state untuk mencegah kembali
            history.pushState(null, null, window.location.href);

            // Memuat ulang halaman (refresh)
            location.reload();

        });
    </script>
</body>

</html>