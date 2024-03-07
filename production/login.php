<?php
require 'koneksi.php';
session_start();

// cek cookie
if (isset($_COOKIE['id_petugas']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id_petugas'];
    $key = $_COOKIE['key'];

    // ambil username dan id berdasarkan id cookie
    $result = mysqli_query($conn, "SELECT id_petugas, username, password FROM petugas WHERE id_petugas = '$id'");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === $row['id_petugas']) {
        $_SESSION['login'] = true;
        $_SESSION['id_petugas'] = $row['id_petugas']; // Simpan id di sesi
        // $_SESSION['username'] = $row['username']; // Simpan username di sesi
    }
}



if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        echo "<script language='JavaScript'>
        alert('Username dan password wajib diisi');
        document.location = 'login.php';
        </script>";
        exit;
    }

    $result = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$username'");

    // cek username
    if ($result->num_rows === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row["password"]) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION['username'] = $username;
            // Jika login berhasil, arahkan ke halaman berdasarkan peran
            $level = $row['level'];
            if ($level == 'admin') {
                header("Location: index.php");
            } elseif ($level == 'petugas') {
                header("Location: index.php");
            } elseif ($level == 'siswa') {
                header("Location: index.php");
            }
            exit;
        } else {
            echo "<script language='JavaScript'>
            alert('Password salah');
            document.location = 'login.php';
            </script>";
            exit;
        }
    } else {
        echo "<script language='JavaScript'>
        alert('Username tidak ditemukan');
        document.location = 'login.php';
        </script>";
        exit;

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="images/smk.png" type="image/ico" />
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <style>
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(to bottom, #778899 0%, white 50%, #778899 100%);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

        hr {
            border-top: 2px solid #9ACD32;
        }
        
        .login-container {
            background-color: #F5F5F5;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .login-container h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: calc(100% - 20px); /* Tambahkan padding untuk ikon */
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #9ACD32;
            border-radius: 5px;
            padding-left: 35px; /* Jarak ikon dengan input */
        }

        .login-container input[type="text"]::placeholder,
        .login-container input[type="password"]::placeholder {
            color: #999; /* Warna placeholder */
        }

        .login-container .input-icon {
            position: relative;
        }

        .login-container .input-icon i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #999; /* Warna ikon */
        }

        .login-container button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background: linear-gradient(to bottom, #9ACD32 0%, white 50%, #9ACD32 100%);
            border: none;
            border-radius: 5px;
            color: black;
            cursor: pointer;
        }

        .login-container button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">   
        <h1>Aplikasi Pembayaran SPP</h1>
        <hr>
        <img src="images/smk.png">
        <form action="" method="post">
        <div class="input-icon">
                <i class="fa fa-user"></i>
            <input type="text" name="username" placeholder="Username" required><br>
            </div><div class="input-icon">
                <i class="fa fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required><br><br></div>
            <button type="submit" name="login" style="font-size: 1.2em;">Login</button>

        </form>
    </div>
</body>
</html>
