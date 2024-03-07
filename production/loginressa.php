<?php
require 'koneksi.php';
session_start();

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username dan id berdasarkan id cookie
    $result = mysqli_query($conn, "SELECT id, username FROM user WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === $row['id']) {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $row['id']; // Simpan id di sesi
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

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

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