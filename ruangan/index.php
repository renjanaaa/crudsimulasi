<?php
require_once "../classes/ruangan.php";
$ruangan = new ruangan();
$data = $ruangan->read();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Ruangan</title>
</head>
<body>
    <h2>Daftar Ruangan</h2>
    <a href="create.php">Tambah Ruangan</a>
    <br><br>
    <a href="../index.php">⬅ Kembali ke Halaman Utama</a>
    <br><br>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nama Ruangan</th>
            <th>Kapasitas</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($data as $d): ?>
        <tr>
            <td><?= $d['id_ruangan'] ?></td>
            <td><?= $d['nama_ruangan'] ?></td>
            <td><?= $d['kapasitas'] ?></td>
            <td><?= $d['lokasi'] ?></td>
            <td>
                <a href="edit.php?id=<?= $d['id_ruangan'] ?>">Edit</a> | 
                <a href="delete.php?id=<?= $d['id_ruangan'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
