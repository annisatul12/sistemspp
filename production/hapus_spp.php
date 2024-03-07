
<?php
session_start();
// Sertakan file koneksi
include('koneksi.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_spp = $_GET['id'];
    $query = "DELETE FROM spp WHERE id_spp = '$id_spp'";
    if ($conn->query($query) === TRUE) {
        // Redirect kembali ke halaman list_spp.php dengan pesan sukses
        echo '<script>alert("DATA BERHASIL DIHAPUS!"); window.location.href = "list_spp.php";</script>';
        exit;
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request!";
}
?>

