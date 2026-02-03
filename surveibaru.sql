-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for survei_kepuasan
CREATE DATABASE IF NOT EXISTS `survei_baru` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `survei_baru`;

-- Dumping structure for table survei_kepuasan.tb_instansi
CREATE TABLE IF NOT EXISTS `tb_responden` (
  `id` int NOT NULL AUTO_INCREMENT,
  `responden` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `umur` tinyint NOT NULL DEFAULT (0),
  `kelamin` enum('L','P') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'L',
  `lulusan` enum('SD','SMP','SMA','D1/D2/D3','S1/D4','S2','S3') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_pelayanan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_hp` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pekerjaan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_terakhir_kali` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table survei_kepuasan.tb_instansi: ~0 rows (approximately)

-- Dumping structure for table survei_kepuasan.tb_pertanyaan
CREATE TABLE IF NOT EXISTS `tb_pertanyaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE tb_opsi_jawaban (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pertanyaan_id INT NOT NULL,
  label VARCHAR(100) NOT NULL,
  nilai INT NOT NULL,
  urutan INT NOT NULL,

  CONSTRAINT fk_opsi_pertanyaan
    FOREIGN KEY (pertanyaan_id)
    REFERENCES tb_pertanyaan(id)
    ON DELETE RESTRICT
);

CREATE TABLE `tb_jawaban` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_responden` int NOT NULL DEFAULT '0',
  `opsi_jawaban_id` INT NOT NULL,

  PRIMARY KEY (`id`),
  KEY `FK__tb_responden` (`id_responden`),
  CONSTRAINT `FK__tb_responden` FOREIGN KEY (`id_responden`) REFERENCES `tb_responden` (`id`) ON DELETE CASCADE,
  CONSTRAINT fk_jawaban_opsi
  FOREIGN KEY (opsi_jawaban_id)
  REFERENCES tb_opsi_jawaban(id)
  ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `tb_faskes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama_faskes` VARCHAR(150) NOT NULL,
  `jenis` ENUM('PUSKESMAS','RUMAH_SAKIT') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `tb_faskes`
ADD COLUMN `is_active` TINYINT(1) NOT NULL DEFAULT 1 AFTER `nama_faskes`;

INSERT INTO `tb_pertanyaan` (`id`, `pertanyaan`) VALUES
(1, 'Kemudahan akses informasi layanan  Dinas Kesehatan Pengendalian Penduduk dan KB Kota Probolinggo. (informasi layanan tersedia di berbagai media elektronik dan nonelektronik)'),
(2, 'Kesesuaian persyaratan pelayanan dengan jenis pelayanannya'),
(3, 'Bagaimana pendapat Saudara tentang kemudahan Sistem, mekanisme dan prosedur pelayanan'),
(4, 'Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?'),
(5, 'Bagaimana pendapat Saudara tentang jam buka pelayanan sudah tepat waktu sesuai dengan Standar pelayanan yang dijanjikan?'),
(6, 'Tarif atau biaya pelayanan yang diberikan sesuai dengan ketentuan'),
(7, 'Bagaimana pendapat saudara tentang Kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan'),
(8, 'Bagaimana pendapat saudara tentang penanganan pengaduan pengguna pelayanan'),
(9, 'Bagaimana pendapat Saudara tentang kompetensi /kemampuan petugas dalam layanan?'),
(10, 'Bagaimana perilaku petugas dalam layanan terkait dengan kesopanan dan keramahan?'),
(11, 'Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana pelayanan?'),
(12, 'Bagaimana pendapat Saudara tentang transparansi pelayanan (informasi dan proses pelayanan transparan akuntabel)'),
(13, 'Integritas petugas pelayanan, apakah berintegritas tinggi dan tidak melakukan KKN');

INSERT INTO `tb_opsi_jawaban`
(`id`, `pertanyaan_id`, `label`, `nilai`, `urutan`) VALUES

-- PERTANYAAN 1
(NULL, 1, 'Tidak Mudah', 1, 1),
(NULL, 1, 'Kurang Mudah', 2, 2),
(NULL, 1, 'Mudah', 3, 3),
(NULL, 1, 'Sangat Mudah', 4, 4),

-- PERTANYAAN 2
(NULL, 2, 'Tidak Sesuai', 1, 1),
(NULL, 2, 'Kurang Sesuai', 2, 2),
(NULL, 2, 'Sesuai', 3, 3),
(NULL, 2, 'Sangat Sesuai', 4, 4),

-- PERTANYAAN 3
(NULL, 3, 'Tidak Mudah', 1, 1),
(NULL, 3, 'Kurang Mudah', 2, 2),
(NULL, 3, 'Mudah', 3, 3),
(NULL, 3, 'Sangat Mudah', 4, 4),

-- PERTANYAAN 4
(NULL, 4, 'Tidak Cepat', 1, 1),
(NULL, 4, 'Kurang Cepat', 2, 2),
(NULL, 4, 'Cepat', 3, 3),
(NULL, 4, 'Sangat Cepat', 4, 4),

-- PERTANYAAN 5
(NULL, 5, 'Tidak Tepat', 1, 1),
(NULL, 5, 'Kurang Tepat', 2, 2),
(NULL, 5, 'Tepat', 3, 3),
(NULL, 5, 'Sangat Tepat', 4, 4),

-- PERTANYAAN 6
(NULL, 6, 'Tidak Sesuai', 1, 1),
(NULL, 6, 'Kurang Sesuai', 2, 2),
(NULL, 6, 'Sesuai', 3, 3),
(NULL, 6, 'Sangat Sesuai', 4, 4),

-- PERTANYAAN 7
(NULL, 7, 'Tidak Sesuai', 1, 1),
(NULL, 7, 'Kurang Sesuai', 2, 2),
(NULL, 7, 'Sesuai', 3, 3),
(NULL, 7, 'Sangat Sesuai', 4, 4),

-- PERTANYAAN 8
(NULL, 8, 'Tidak Baik', 1, 1),
(NULL, 8, 'Kurang Baik', 2, 2),
(NULL, 8, 'Baik', 3, 3),
(NULL, 8, 'Sangat Baik', 4, 4),

-- PERTANYAAN 9
(NULL, 9, 'Tidak Kompeten', 1, 1),
(NULL, 9, 'Kurang Kompeten', 2, 2),
(NULL, 9, 'Kompeten', 3, 3),
(NULL, 9, 'Sangat Kompeten', 4, 4),

-- PERTANYAAN 10
(NULL, 10, 'Tidak Sopan', 1, 1),
(NULL, 10, 'Kurang Sopan', 2, 2),
(NULL, 10, 'Sopan', 3, 3),
(NULL, 10, 'Sangat Sopan', 4, 4),

-- PERTANYAAN 11
(NULL, 11, 'Tidak Baik', 1, 1),
(NULL, 11, 'Kurang Baik', 2, 2),
(NULL, 11, 'Baik', 3, 3),
(NULL, 11, 'Sangat Baik', 4, 4),

-- PERTANYAAN 12
(NULL, 12, 'Tidak Transparan', 1, 1),
(NULL, 12, 'Kurang Transparan', 2, 2),
(NULL, 12, 'Transparan', 3, 3),
(NULL, 12, 'Sangat Transparan', 4, 4),

-- PERTANYAAN 13
(NULL, 13, 'Tidak Berintegritas', 1, 1),
(NULL, 13, 'Kurang Berintegritas', 2, 2),
(NULL, 13, 'Berintegritas', 3, 3),
(NULL, 13, 'Sangat Berintegritas', 4, 4);



INSERT INTO `tb_faskes` (`id`, `nama_faskes`, `is_active`, `jenis`) VALUES
(1, 'Puskesmas Wonoasih', 1, 'PUSKESMAS'),
(2, 'Puskesmas Kanigaran', 1, 'PUSKESMAS'),
(3, 'Puskesmas Kedopok', 1, 'PUSKESMAS'),
(4, 'Puskesmas Ketapang', 1, 'PUSKESMAS'),
(5, 'RSUD Kota Probolinggo', 1, 'RUMAH_SAKIT');

ALTER TABLE tb_responden
ADD COLUMN faskes_id INT NULL AFTER id;

ALTER TABLE tb_responden
ADD CONSTRAINT fk_responden_faskes
FOREIGN KEY (faskes_id)
REFERENCES tb_faskes(id)
ON DELETE RESTRICT;

ALTER TABLE tb_pertanyaan ADD is_active TINYINT(1) DEFAULT 1;
