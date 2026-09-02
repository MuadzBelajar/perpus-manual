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
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/numen111104/nide-ui-default@v1.0.0/css/default-ui.min.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700;800&display=swap">
<body>

<h1>Daftar Anggota</h1>
<div style="margin-bottom: 20px;">
    <a href="tambah-anggota.php" style="text-decoration: none; background-color: #28a745; color: white; padding: 6px 14px; border-radius: 6px; font-size: 18px; font-weight: bold;">Tambah Anggota +</a>
    <a href="index.php" style="text-decoration: none; background-color: #6c757d; color: white; padding: 6px 14px; border-radius: 6px; font-size: 18px; font-weight: bold; margin-left: 10px;">Kembali</a>
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
        </tr>
    </thead>
    <tbody>
        <?php if (empty($semuaAnggota)) : ?>
            <tr>
                <td colspan="7" style="text-align: center;">Belum ada data.</td>
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
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
