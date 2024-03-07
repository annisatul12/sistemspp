<?php
session_start();
include('koneksi.php');
if (isset($_GET['nisn']) && !empty($_GET['nisn'])) {
    $nisn = $_GET['nisn'];

    // Hapus terlebih dahulu data di tabel pembayaran yang terkait
    $query_delete_pembayaran = $conn->prepare("DELETE FROM pembayaran WHERE nisn = ?");
    $query_delete_pembayaran->bind_param("s", $nisn);

    if ($query_delete_pembayaran->execute()) {
        // Setelah menghapus data di tabel pembayaran, baru hapus data di tabel siswa
        $query_delete_siswa = $conn->prepare("DELETE FROM siswa WHERE nisn = ?");
        $query_delete_siswa->bind_param("s", $nisn);

        if ($query_delete_siswa->execute()) {
            echo '<script>alert("DATA BERHASIL DIHAPUS!"); window.location.href = "list_siswa.php";</script>';
            exit;
        } else {
            echo "Error: " . $query_delete_siswa->error;
        }

        $query_delete_siswa->close();
    } else {
        echo "Error: " . $query_delete_pembayaran->error;
    }

    $query_delete_pembayaran->close();
} else {
    echo "Invalid request!";
}


?>
