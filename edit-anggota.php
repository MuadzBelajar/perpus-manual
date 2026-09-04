<?php

use App\Database;
use App\Anggota;

require_once "vendor/autoload.php";

$database = new Database(
    "localhost",
    "pustaka-manual",
    "root",
    ""
);

$db = $database->connect();
$anggotaClass = new Anggota($db);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: anggota.php");
    exit;
}

$id = (int)$_GET['id'];
if ($id <= 0) {
    header("Location: anggota.php");
    exit;
}

$dataAnggota = $anggotaClass->ambilPerId($id);

if (!$dataAnggota) {
    header("Location: anggota.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $nis_nik = trim($_POST['nis_nik']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = trim($_POST['alamat']);
    $no_telepon = trim($_POST['no_telepon']);
    $tanggal_daftar = $_POST['tanggal_daftar'];

    if (empty($nama) || empty($nis_nik) || empty($jenis_kelamin) || empty($alamat) || empty($no_telepon) || empty($tanggal_daftar)) {
        $error = "Semua kolom wajib diisi!";
    } elseif ($anggotaClass->cekDuplikatKecualiId($nis_nik, $id)) {
        $error = "NIS/NIK sudah terdaftar pada anggota lain!";
    } else {
        $berhasil = $anggotaClass->ubah($id, $nama, $nis_nik, $jenis_kelamin, $alamat, $no_telepon, $tanggal_daftar);
        if ($berhasil) {
            header("Location: anggota.php");
            exit;
        } else {
            $error = "Gagal mengubah data anggota.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/numen111104/nide-ui-default@v1.0.0/css/default-ui.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700;800&display=swap">
</head>
<body>
    
<h1>Edit Anggota</h1>

<?php if (isset($error)) : ?>
    <p><?= $error; ?></p>
<?php endif; ?>

<form method="POST">
    <div>
        <label for="nama">Nama Lengkap:</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($dataAnggota['nama']); ?>" required>
    </div>
    <div>
        <label for="nis_nik">NIS / NIK:</label>
        <input type="text" id="nis_nik" name="nis_nik" value="<?= htmlspecialchars($dataAnggota['nis_nik']); ?>" required>
    </div>
    <div>
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="">-- Pilih --</option>
            <option value="Laki-laki" <?= ($dataAnggota['jenis_kelamin'] === 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
            <option value="Perempuan" <?= ($dataAnggota['jenis_kelamin'] === 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
        </select>
    </div>
    <div>
        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" rows="3" required><?= htmlspecialchars($dataAnggota['alamat']); ?></textarea>
    </div>
    <div>
        <label for="no_telepon">No. Telepon:</label>
        <input type="text" id="no_telepon" name="no_telepon" value="<?= htmlspecialchars($dataAnggota['no_telepon']); ?>" required>
    </div>
    <div>
        <label for="tanggal_daftar">Tanggal Daftar:</label>
        <input type="date" id="tanggal_daftar" name="tanggal_daftar" value="<?= htmlspecialchars($dataAnggota['tanggal_daftar']); ?>" required>
    </div>

    <button type="submit">Simpan Perubahan</button>
    <a href="anggota.php">Batal</a>
</form>

</body>
</html>