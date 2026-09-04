<?php

use App\Database;
use App\Anggota;

require_once "vendor/autoload.php";

$database = new Database("localhost", "pustaka-manual", "root", "");
$db = $database->connect();
$anggotaClass = new Anggota($db); 

$semuaAnggota = $anggotaClass->semua();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/numen111104/nide-ui-default@v1.0.0/css/default-ui.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700;800&display=swap">
</head>
<body>

<h1>Daftar Anggota</h1>
<div>
    <a href="tambah-anggota.php">Tambah Anggota +</a>
    <a href="index.php">Kembali</a>
</div>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Lengkap</th>
            <th>NIS/NIK</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>No. Telepon</th>
            <th>Tanggal Daftar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($semuaAnggota)) : ?>
            <tr>
                <td colspan="8">Belum ada data.</td>
            </tr>
        <?php else : ?>
            <?php foreach ($semuaAnggota as $a) : ?>
                <tr>
                    <td><?= htmlspecialchars($a['id']); ?></td>
                    <td><?= htmlspecialchars($a['nama']); ?></td>
                    <td><?= htmlspecialchars($a['nis_nik']); ?></td>
                    <td><?= htmlspecialchars($a['jenis_kelamin']); ?></td>
                    <td><?= htmlspecialchars($a['alamat']); ?></td>
                    <td><?= htmlspecialchars($a['no_telepon']); ?></td>
                    <td><?= htmlspecialchars($a['tanggal_daftar']); ?></td>
                    <td>
                        <a href="edit-anggota.php?id=<?= $a['id']; ?>">Edit</a>
                        <a href="hapus-anggota.php?id=<?= $a['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data anggota ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
