-- =====================================================
-- E-Maintenance UNSIKA - Database Setup
-- Cara pakai:
-- 1. Buka phpMyAdmin (http://localhost/phpmyadmin)
-- 2. Klik tab "Import"
-- 3. Pilih file ini, klik "Go"
-- =====================================================

CREATE DATABASE IF NOT EXISTS `unsika_maintenance`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `unsika_maintenance`;

DROP TABLE IF EXISTS `maintenance`;

CREATE TABLE `maintenance` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_pelapor` VARCHAR(150) NOT NULL,
  `lokasi` VARCHAR(200) NOT NULL,
  `deskripsi` TEXT NOT NULL,
  `foto` VARCHAR(255) DEFAULT NULL,
  `status` ENUM('Pending','Diproses','Selesai') NOT NULL DEFAULT 'Pending',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contoh data (opsional)
INSERT INTO `maintenance` (`nama_pelapor`, `lokasi`, `deskripsi`, `status`) VALUES
('Budi Santoso', 'Gedung OECU Lt. 2', 'AC ruang 201 tidak dingin', 'Pending'),
('Siti Aminah', 'Perpustakaan Lt. 1', 'Lampu meja baca mati 3 buah', 'Diproses');
