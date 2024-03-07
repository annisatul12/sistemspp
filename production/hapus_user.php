<?php
// Include file koneksi database
include 'koneksi.php';

// Cek apakah parameter id_user telah diterima melalui URL dan tidak kosong
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Mengambil nilai id_user dari URL
    $id = $_GET['id'];

    // Query untuk menghapus data pengguna berdasarkan id_user
    $query = "DELETE FROM user WHERE id_user = $id";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Pengguna berhasil dihapus.');
            window.location.href = 'list_user.php';
        </script>";
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Tutup koneksi database
    mysqli_close($conn);
} else {
    echo "<script>
            alert('ID pengguna tidak valid.');
            window.location.href = 'list_user.php';
        </script>";
}
?>
