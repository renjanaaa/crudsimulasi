<?php
require_once "../classes/lab.php";
$lab = new lab();
$data = $lab->read();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Lab</title>
</head>
<body>
    <h2>Daftar Lab</h2>
    <a href="create.php">Tambah Lab</a>
    <br><br>
    <a href="../index.php">⬅ Kembali ke Halaman Utama</a>
    <br><br>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nama Lab</th>
            <th>Kapasitas</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($data as $d): ?>
        <tr>
            <td><?= $d['id_lab'] ?></td>
            <td><?= $d['nama_lab'] ?></td>
            <td><?= $d['kapasitas'] ?></td>
            <td><?= $d['lokasi'] ?></td>
            <td>
                <a href="edit.php?id=<?= $d['id_lab'] ?>">Edit</a> | 
                <a href="delete.php?id=<?= $d['id_lab'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
