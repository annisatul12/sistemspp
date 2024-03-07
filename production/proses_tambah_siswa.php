<?php 
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $kelas = $_POST['kelas'];
        $kompetensi = $_POST['kompetensi'];

        // Use prepared statement to prevent SQL injection
        $query = "INSERT INTO kelas (id_kelas, nama_kelas, kompetensi_keahlian) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);

        // Check if the statement is prepared successfully
        if ($stmt) {
            $stmt->bind_param("iss", $id, $kelas, $kompetensi);
            if ($stmt->execute()) {
                echo "<script>
                        alert('Kelas Berhasil ditambahkan!');
                        window.location.href= 'list_kelas.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Kelas Gagal ditambahkan!');
                        window.location.href= 'list_kelas.php';
                      </script>";
            }
            $stmt->close(); // Close the statement after execution
        } else {
            echo "<script>
                    alert('Error in preparing statement!');
                    window.location.href= 'list_kelas.php';
                  </script>";
        }
    }
}
?>