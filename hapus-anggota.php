<?php

use App\Database;
use App\Anggota;

require_once "vendor/autoload.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: anggota.php");
    exit;
}

$id = (int)$_GET['id'];

if ($id <= 0) {
    header("Location: anggota.php");
    exit;
}

$database = new Database("localhost", "pustaka-manual", "root", "");
$db = $database->connect();
$anggotaClass = new Anggota($db);

$dataAnggota = $anggotaClass->ambilPerId($id);
if ($dataAnggota) {
    $anggotaClass->hapus($id);
}

header("Location: anggota.php");
exit;
