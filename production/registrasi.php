<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>
    <h2>Registrasi Admin</h2>
    <form method="post" action="proses_registrasi.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="peran">Peran:</label>
        <select id="peran" name="peran">
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
            <option value="siswa">Siswa</option>
        </select><br>
        <button type="submit">Daftar</button>
    </form>
</body>
</html>
