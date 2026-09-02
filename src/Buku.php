<?php

namespace App;
use PDO;

class Buku {
    public function __construct(
        private PDO $db
    ) {}

    public function semua() {
        $stmt = $this->db->query(
            "SELECT * from buku ORDER BY judul"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 

    public function bukuAndrea() {
        $stmt = $this->db->prepare(
            "SELECT * from buku WHERE penulis = :penulis ORDER BY judul"
        );
        $stmt->execute(['penulis' => 'Andrea Hirata']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tambah(
        string $judul,
        string $penulis,
        int $tahun,
        int $stok
) {
    $stmt = $this->db->prepare(
        "INSERT INTO buku (judul, penulis, tahun, stok) VALUES (:judul, :penulis, :tahun, :stok)"
    );
    $stmt->execute([
        'judul' => $judul,
        'penulis' => $penulis,
        'tahun' => $tahun,
        'stok' => $stok
    ]);
}




}