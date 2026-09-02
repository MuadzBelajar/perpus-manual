<?php

use App\Buku;
use App\Database;

require_once "vendor/autoload.php";

$database = new Database("localhost", "pustaka-manual", "root", "");
$db = $database->connect();
$buku = new Buku($db); 

$semuaBuku = $buku->semua();
$bukuAndrea = $buku->bukuAndrea();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/numen111104/nide-ui-default@v1.0.0/css/default-ui.min.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700;800&display=swap">
<body>

<h1>Perpustakaan</h1>

<div style="margin-bottom: 25px;">
    <a href="tambah.php" style="text-decoration: none; background-color: #007bff; color: white; padding: 6px 14px; border-radius: 6px; font-size: 16px; font-weight: bold;">Tambah Buku +</a>
    <a href="anggota.php" style="text-decoration: none; background-color: #ffc107; color: #212529; padding: 6px 14px; border-radius: 6px; font-size: 16px; font-weight: bold; margin-left: 10px;">Manajemen Anggota </a>
</div>

<h2>Daftar Semua Buku</h2>
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($semuaBuku as $b) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($b['judul']); ?></td>
                <td><?= htmlspecialchars($b['penulis']); ?></td>
                <td><?= htmlspecialchars($b['tahun']); ?></td>
                <td><?= htmlspecialchars($b['stok']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2>Buku Andrea Hirata</h2>
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        <?php $noAndrea = 1; ?>
        <?php foreach ($bukuAndrea as $ba) : ?>
            <tr>
                <td><?= $noAndrea++; ?></td>
                <td><?= htmlspecialchars($ba['judul']); ?></td>
                <td><?= htmlspecialchars($ba['penulis']); ?></td>
                <td><?= htmlspecialchars($ba['tahun']); ?></td>
                <td><?= htmlspecialchars($ba['stok']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
