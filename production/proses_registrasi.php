<?php
// Koneksi ke database (gantilah dengan detail koneksi Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_spp";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $peran = $_POST['peran'];

    // Generate id_user dengan 3 huruf dari peran dan 7 angka acak
    $id_user = substr($peran, 0, 3) . mt_rand(1000000, 9999999);

    $stmt = $conn->prepare("INSERT INTO users (id_user, username, password, peran) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id_user, $username, $password, $peran);

    if ($stmt->execute()) {
        echo "Registrasi berhasil. ID User: $id_user";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
