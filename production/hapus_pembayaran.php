<?php
session_start();
include('koneksi.php');

if (isset($_GET['id_pembayaran']) && !empty($_GET['id_pembayaran'])) {
    $id_pembayaran = $_GET['id_pembayaran'];

    // Hapus data pembayaran
    $query_hapus_pembayaran = $conn->prepare("DELETE FROM pembayaran WHERE id_pembayaran = ?");
    $query_hapus_pembayaran->bind_param("i", $id_pembayaran);

    if ($query_hapus_pembayaran->execute()) {
        echo '<script>alert("Data Pembayaran Berhasil Dihapus!"); window.location.href = "list_pembayaran.php";</script>';
        exit;
    } else {
        echo "Error: " . $query_hapus_pembayaran->error;
    }

    $query_hapus_pembayaran->close();
} else {
    echo "Invalid request!";
}
?>
