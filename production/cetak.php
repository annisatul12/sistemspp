<?php
include 'koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kwitansi Pembayaran</title>
    <style>
        /* Gaya CSS untuk halaman cetak */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 5px 0;
        }
        hr {
            border-top: px solid #ccc;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .center {
            text-align: center;
        }
        .flex-container {
            display: flex;
        }
        .left-column,
        .right-column {
            flex: 1;
        }
        .left-column {
            text-align: left;
        }
        .right-column {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id_pembayaran = $_GET['id'];
    
        $query = "SELECT * FROM pembayaran WHERE id_pembayaran='$id_pembayaran'";
        $result = $conn->query($query);
    
        if ($result->num_rows > 0) {
            $kelas = $result->fetch_assoc();
        } else {
            echo "Failed to fetch data: " . mysqli_error($conn);
            exit;
        }
    }
    $query = "SELECT pembayaran.*, petugas.nama_petugas, siswa.nama FROM pembayaran JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn = siswa.nisn WHERE pembayaran.id_pembayaran = '$id_pembayaran';
    ";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $kelas = $result->fetch_assoc();
    } else {
        echo "Failed to fetch data: " . mysqli_error($conn);
        exit;
    } ?>
        <h2>KWITANSI PEMBAYARAN SPP</h2>
        <hr>
        <br><br>
        <div class="info">
            <p>Nama: <?php echo $kelas['nama']; ?></p>
            <?php 
$nama = $kelas['nama'];
$qr = "SELECT nama_kelas, kompetensi_keahlian FROM kelas WHERE id_kelas IN (SELECT id_kelas FROM siswa WHERE nama = '$nama')";
$hasil = $conn->query($qr);
if ($hasil) {
    if ($hasil->num_rows > 0) {
        $juru = $hasil->fetch_assoc();
?>
        <p>Kelas: <?php echo $juru['nama_kelas']; ?></p>
        <p>Jurusan: <?php echo $juru['kompetensi_keahlian']; ?></p>
<?php
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "Gagal mengambil data: " . $conn->error;
    exit;
}
?>

            <p>Tanggal: <?php echo $kelas['tgl_bayar']; ?></p>
            <br>
            <table border='1 px'>
                <thead>
                    <tr>
						  <th>Petugas</th>
                          <th>Nisn</th>
						  <th>SPP</th>
						  <th>Total Bayar</th>
</tr>
</thead>
<tbody>
    <tr>
        <td>
            <?php echo $kelas['nama_petugas']; ?>
        </td>
        <td>
            <?php echo $kelas['nisn']; ?>
        </td>
        <td>
            <?php echo $kelas['tahun_dibayar']; ?>
        </td>
        <td>
            <?php echo $kelas['jumlah_bayar']; ?>
        </td>
    </tr></tbody></table>
    <br><br>
    <div class="right-column">
        <h4>Staf TU</h4><br><br>
        <h4>
            <?php echo $kelas['nama_petugas']; ?> 
</h4>
</div><br>
<div class="center">
    
        
        <div class="footer">
            <p>Terima kasih atas pembayaran Anda.</p>
            <p>Silakan simpan kwitansi ini sebagai bukti pembayaran.</p>
        </div>
    </div>

    <script>
        // Lakukan cetak otomatis ketika halaman dimuat
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
