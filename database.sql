-- ============================================
-- Script Pembuatan Database & Tabel Beasiswa
-- ============================================

-- Membuat database
CREATE DATABASE IF NOT EXISTS daftar_beasiswa;

-- Gunakan database
USE daftar_beasiswa;

-- Membuat tabel beasiswa
CREATE TABLE IF NOT EXISTS beasiswa (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,          -- ID unik pendaftaran
    nama VARCHAR(200) NOT NULL,                     -- Nama lengkap pendaftar
    email VARCHAR(100) NOT NULL,                    -- Email pendaftar
    no_hp VARCHAR(20) NOT NULL,                     -- Nomor HP pendaftar
    semester INT(2) NOT NULL,                       -- Semester saat ini (1-8)
    ipk_terakhir FLOAT(4,2) NOT NULL,               -- IPK terakhir
    pilihan_beasiswa VARCHAR(50) NOT NULL,          -- Pilihan jenis beasiswa
    status_ajuan VARCHAR(50) DEFAULT 'Belum di verifikasi'  -- Status pengajuan
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
