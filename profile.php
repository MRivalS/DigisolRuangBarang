<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card</title>
    <style>
        .card {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .card form {
            text-align: left;
        }

        .card form label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        .card form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .card form button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .card form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="card">
        <img src="profile-placeholder.png" alt="Profile Photo">
        <form action="submit-profile.php" method="post">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" required>

            <label for="phone">No. Telepon</label>
            <input type="tel" id="phone" name="phone" placeholder="Masukkan no. telepon" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email" required>

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>

</html>