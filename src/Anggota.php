<?php

namespace App;
use PDO;

class Anggota {
    public function __construct(
        private PDO $db
    ) {}

    public function semua() {
        $stmt = $this->db->query("SELECT * FROM anggota ORDER BY nama ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 

    public function cekDuplikat(string $nis_nik) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM anggota WHERE nis_nik = :nis_nik");
        $stmt->execute(['nis_nik' => $nis_nik]);
        return $stmt->fetchColumn() > 0;
    }

    public function tambah(
        string $nama,
        string $nis_nik,
        string $jenis_kelamin,
        string $alamat,
        string $no_telepon,
        string $tanggal_daftar
    ) {
        $stmt = $this->db->prepare(
            "INSERT INTO anggota (nama, nis_nik, jenis_kelamin, alamat, no_telepon, tanggal_daftar) 
             VALUES (:nama, :nis_nik, :jenis_kelamin, :alamat, :no_telepon, :tanggal_daftar)"
        );
        return $stmt->execute([
            'nama' => $nama,
            'nis_nik' => $nis_nik,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,
            'no_telepon' => $no_telepon,
            'tanggal_daftar' => $tanggal_daftar
        ]);
    }

    public function ambilPerId(int $id) {
        $stmt = $this->db->prepare("SELECT * FROM anggota WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cekDuplikatKecualiId(string $nis_nik, int $id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM anggota WHERE nis_nik = :nis_nik AND id != :id");
        $stmt->execute(['nis_nik' => $nis_nik, 'id' => $id]);
        return $stmt->fetchColumn() > 0;
    }

    public function ubah(
        int $id,
        string $nama,
        string $nis_nik,
        string $jenis_kelamin,
        string $alamat,
        string $no_telepon,
        string $tanggal_daftar
    ) {
        $stmt = $this->db->prepare(
            "UPDATE anggota 
             SET nama = :nama, nis_nik = :nis_nik, jenis_kelamin = :jenis_kelamin, alamat = :alamat, no_telepon = :no_telepon, tanggal_daftar = :tanggal_daftar 
             WHERE id = :id"
        );
        return $stmt->execute([
            'id' => $id,
            'nama' => $nama,
            'nis_nik' => $nis_nik,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,
            'no_telepon' => $no_telepon,
            'tanggal_daftar' => $tanggal_daftar
        ]);
    }

    public function hapus(int $id) {
        $stmt = $this->db->prepare("DELETE FROM anggota WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
