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
        return $stmt->execute([
            'judul' => $judul,
            'penulis' => $penulis,
            'tahun' => $tahun,
            'stok' => $stok
        ]);
    }

    public function ambilPerId(int $id) {
        $stmt = $this->db->prepare(
            "SELECT * FROM buku WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function ubah(
        int $id,
        string $judul,
        string $penulis,
        int $tahun,
        int $stok
    ) {
        $stmt = $this->db->prepare(
            "UPDATE buku SET judul = :judul, penulis = :penulis, tahun = :tahun, stok = :stok WHERE id = :id"
        );
        return $stmt->execute([
            'id' => $id,
            'judul' => $judul,
            'penulis' => $penulis,
            'tahun' => $tahun,
            'stok' => $stok
        ]);
    }

    public function hapus(int $id) {
        $stmt = $this->db->prepare(
            "DELETE FROM buku WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }
}
