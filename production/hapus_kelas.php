<?php
session_start();
include('koneksi.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_kelas = $_GET['id'];

    // Hapus siswa terlebih dahulu
    $query_siswa = "DELETE FROM siswa WHERE id_kelas = '$id_kelas'";
    $result_siswa = $conn->query($query_siswa);

    // Setelah itu, hapus kelas
    $query_kelas = "DELETE FROM kelas WHERE id_kelas = '$id_kelas'";

    if ($result_siswa && $conn->query($query_kelas) === TRUE) {
        echo '<script>alert("DATA BERHASIL DIHAPUS!"); window.location.href = "list_kelas.php";</script>';
        exit;
    } else {
        echo "Error: " . $query_kelas . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request!";
}
?>
