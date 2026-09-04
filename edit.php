<?php

use App\Database;
use App\Buku;

require_once "vendor/autoload.php";

$database = new Database(
    "localhost",
    "pustaka-manual",
    "root",
    ""
);

$db = $database->connect();
$buku = new Buku($db);

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];
$dataBuku = $buku->ambilPerId($id);

if (!$dataBuku) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = (int)$_POST['tahun'];
    $stok = (int)$_POST['stok'];

    $berhasil = $buku->ubah($id, $judul, $penulis, $tahun, $stok);
    if ($berhasil) {
        header("Location: index.php?status=terubah");
        exit;
    } else {
        $error = "Gagal mengubah data buku.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/numen111104/nide-ui-default@v1.0.0/css/default-ui.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700;800&display=swap">
</head>
<body>
    
<h1>Edit Buku</h1>

<?php if (isset($error)) : ?>
    <p><?= $error; ?></p>
<?php endif; ?>

<form method="POST">
    <div>
        <label for="judul">Judul:</label>
        <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($dataBuku['judul']); ?>" required>
    </div>
    <div>
        <label for="penulis">Penulis:</label>
        <input type="text" id="penulis" name="penulis" value="<?= htmlspecialchars($dataBuku['penulis']); ?>" required>
    </div>
    <div>
        <label for="tahun">Tahun:</label>
        <input type="number" id="tahun" name="tahun" value="<?= htmlspecialchars($dataBuku['tahun']); ?>" required>
    </div>
    <div>
        <label for="stok">Stok:</label>
        <input type="number" id="stok" name="stok" value="<?= htmlspecialchars($dataBuku['stok']); ?>" required>
    </div>

    <button type="submit">Simpan Perubahan</button>
    <a href="index.php">Batal</a>
</form>

</body>
</html>
