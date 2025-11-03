<?php
require_once "../classes/lab.php";
$lab = new lab();

$id = $_GET['id'];
$data = $lab->getById($id);

if (isset($_POST['submit'])) {
    $lab->update($id, $_POST['nama_lab'], $_POST['kapasitas'], $_POST['lokasi']);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Lab</title>
</head>
<body>
    <h2>Edit Lab</h2>
    <form method="POST">
        Nama Lab: <input type="text" name="nama_lab" value="<?= $data['nama_lab'] ?>" required><br>
        Kapasitas: <input type="number" name="kapasitas" value="<?= $data['kapasitas'] ?>"><br>
        Lokasi: <input type="text" name="lokasi" value="<?= $data['lokasi'] ?>"><br>
        <button type="submit" name="submit">Update</button>
    </form>
</body>
</html>
