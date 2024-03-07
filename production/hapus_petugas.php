<?php
session_start();
// Sertakan file koneksi
include('koneksi.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_petugas = $_GET['id'];

    // Hapus data pembayaran terkait
    $query_delete_pembayaran = "DELETE FROM pembayaran WHERE id_petugas = ?";
    $stmt_delete_pembayaran = $conn->prepare($query_delete_pembayaran);
    $stmt_delete_pembayaran->bind_param("i", $id_petugas);

    if ($stmt_delete_pembayaran->execute()) {
        $stmt_delete_pembayaran->close();

        // Hapus petugas setelah data pembayaran terkait dihapus
        $query_delete_petugas = "DELETE FROM petugas WHERE id_petugas = ?";
        $stmt_delete_petugas = $conn->prepare($query_delete_petugas);
        $stmt_delete_petugas->bind_param("i", $id_petugas);

        if ($stmt_delete_petugas->execute()) {
            // Redirect kembali ke halaman list_petugas.php dengan pesan sukses
            echo '<script>alert("DATA BERHASIL DIHAPUS!"); window.location.href = "list_petugas.php";</script>';
            exit;
        } else {
            echo "Error: " . $query_delete_petugas . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $query_delete_pembayaran . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request!";
}
?>
