<?php

use App\Database;
use App\Buku;

require_once "vendor/autoload.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$database = new Database("localhost", "pustaka-manual", "root", "");
$db = $database->connect();
$buku = new Buku($db);

$dataBuku = $buku->ambilPerId($id);
if ($dataBuku) {
    $buku->hapus($id);
}

header("Location: index.php");
exit;

