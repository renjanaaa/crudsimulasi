<?php
require_once "../classes/ruangan.php";
$ruangan = new ruangan();

if (isset($_POST['submit'])) {
    $ruangan->create($_POST['nama_ruangan'], $_POST['kapasitas'], $_POST['lokasi']);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Ruangan</title>
</head>
<body>
    <h2>Tambah Ruangan</h2>
    <form method="POST">
        Nama Ruangan: <input type="text" name="nama_ruangan" required><br>
        Kapasitas: <input type="number" name="kapasitas"><br>
        Lokasi: <input type="text" name="lokasi"><br>
        <button type="submit" name="submit">Simpan</button>
    </form>
</body>
</html>
