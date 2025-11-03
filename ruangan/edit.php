<?php
require_once "../classes/ruangan.php";
$ruangan = new ruangan();

$id = $_GET['id'];
$data = $ruangan->getById($id);

if (isset($_POST['submit'])) {
    $ruangan->update($id, $_POST['nama_ruangan'], $_POST['kapasitas'], $_POST['lokasi']);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Ruangan</title>
</head>
<body>
    <h2>Edit Ruangan</h2>
    <form method="POST">
        Nama Ruangan: <input type="text" name="nama_ruangan" value="<?= $data['nama_ruangan'] ?>" required><br>
        Kapasitas: <input type="number" name="kapasitas" value="<?= $data['kapasitas'] ?>"><br>
        Lokasi: <input type="text" name="lokasi" value="<?= $data['lokasi'] ?>"><br>
        <button type="submit" name="submit">Update</button>
    </form>
</body>
</html>
