<?php

use App\Database;
use App\Anggota;

require_once "vendor/autoload.php";

$database = new Database("localhost", "pustaka-manual", "root", "");
$db = $database->connect();
$anggotaClass = new Anggota($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $nis_nik = trim($_POST['nis_nik']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = trim($_POST['alamat']);
    $no_telepon = trim($_POST['no_telepon']);
    $tanggal_daftar = $_POST['tanggal_daftar'];

    if (empty($nama) || empty($nis_nik) || empty($jenis_kelamin) || empty($alamat) || empty($no_telepon) || empty($tanggal_daftar)) {
        $error = "Semua kolom wajib diisi!";
    } elseif ($anggotaClass->cekDuplikat($nis_nik)) {
        $error = "NIS/NIK sudah terdaftar!";
    } else {
        $berhasil = $anggotaClass->tambah($nama, $nis_nik, $jenis_kelamin, $alamat, $no_telepon, $tanggal_daftar);
        if ($berhasil) {
            header("Location: anggota.php");
            exit;
        } else {
            $error = "Gagal menyimpan data.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
</head>
<link rel="stylesheet" href="https://jsdelivr.net">
<link rel="preconnect" href="https://gstatic.com" crossorigin>
<link rel="stylesheet" href="https://googleapis.com">
<body>
    
<h1>Tambah Anggota</h1>

<?php if (isset($error)) : ?>
    <p style="color: red; font-weight: bold;"><?= $error; ?></p>
<?php endif; ?>

<form method="POST">
    <div>
        <label for="nama">Nama Lengkap:</label>
        <input type="text" id="nama" name="nama" required>
    </div>
    <div>
        <label for="nis_nik">NIS / NIK:</label>
        <input type="text" id="nis_nik" name="nis_nik" required>
    </div>
    <div>
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="">-- Pilih --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
    </div>
    <div>
        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" rows="3" required></textarea>
    </div>
    <div>
        <label for="no_telepon">No. Telepon:</label>
        <input type="text" id="no_telepon" name="no_telepon" required>
    </div>
    <div>
        <label for="tanggal_daftar">Tanggal Daftar:</label>
        <input type="date" id="tanggal_daftar" name="tanggal_daftar" value="<?= date('Y-m-d'); ?>" required>
    </div>

    <button type="submit">Simpan</button>
    <a href="anggota.php">Kembali</a>
</form>

</body>
</html>
