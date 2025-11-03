<?php
require_once "../classes/lab.php";
$lab = new lab();

if (isset($_POST['submit'])) {
    $lab->create($_POST['nama_lab'], $_POST['kapasitas'], $_POST['lokasi']);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Lab</title>
</head>
<body>
    <h2>Tambah Lab</h2>
    <form method="POST">
        Nama Lab: <input type="text" name="nama_lab" required><br>
        Kapasitas: <input type="number" name="kapasitas"><br>
        Lokasi: <input type="text" name="lokasi"><br>
        <button type="submit" name="submit">Simpan</button>
    </form>
</body>
</html>
