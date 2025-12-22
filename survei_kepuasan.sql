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
CREATE DATABASE IF NOT EXISTS `survei_kepuasan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `survei_kepuasan`;

-- Dumping structure for table survei_kepuasan.tb_instansi
CREATE TABLE IF NOT EXISTS `tb_responden` (
  `id` int NOT NULL AUTO_INCREMENT,
  `responden` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `umur` tinyint NOT NULL DEFAULT (0),
  `kelamin` enum('L','P') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'L',
  `lulusan` enum('SD','SMP','SMA','D1/D2/D3','S1/D4','S2','S3') COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table survei_kepuasan.tb_instansi: ~0 rows (approximately)

-- Dumping structure for table survei_kepuasan.tb_pertanyaan
CREATE TABLE IF NOT EXISTS `tb_pertanyaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `tipe` enum('SelectOne','Date') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'SelectOne',
  `jawaban` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tb_jawaban` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pertanyaan` int NOT NULL DEFAULT '0',
  `id_responden` int NOT NULL DEFAULT '0',
  `jawaban` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `nilai` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__tb_pertanyaan` (`id_pertanyaan`),
  KEY `FK__tb_responden` (`id_responden`),
  CONSTRAINT `FK__tb_responden` FOREIGN KEY (`id_responden`) REFERENCES `tb_responden` (`id`),
  CONSTRAINT `FK__tb_pertanyaan` FOREIGN KEY (`id_pertanyaan`) REFERENCES `tb_pertanyaan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tb_pertanyaan` (`id`, `pertanyaan`, `tipe`, `jawaban`) VALUES
(1, 'Apa jenis pelayanan yang pernah Saudara urusi?', 'SelectOne', 'Pelayanan Rekomendasi Ijin Praktik/Kerja Tenaga Kesehatan:Pelayanan Rekomendasi Ijin Fasilitas Kesehatan:Pelayanan Konsultasi PIRT:Pelayanan Fogging'),
(2, 'Kapan Saudara terakhir mengurus ijin untuk organisasi Saudara', 'Date', NULL),
(3, 'Kemudahan akses informasi layanan  Dinas Kesehatan Pengendalian Penduduk dan KB Kota Probolinggo. (informasi layanan tersedia di berbagai media elektronik dan nonelektronik)', 'SelectOne', 'Tidak Mudah:Kurang Mudah:Mudah:Sangat Mudah'),
(4, 'Kesesuaian persyaratan pelayanan dengan jenis pelayanannya', 'SelectOne', 'Tidak Sesuai:Kurang Sesuai:Sesuai:Sangat Sesuai'),
(5, 'Bagaimana pendapat Saudara tentang kemudahan Sistem, mekanisme dan prosedur pelayanan', 'SelectOne', 'Tidak Mudah:Kurang Mudah:Mudah:Sangat Mudah'),
(6, 'Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?', 'SelectOne', 'Tidak Cepat:Kurang Cepat:Cepat:Sangat Cepat'),
(7, 'Bagaimana pendapat Saudara tentang jam buka pelayanan sudah tepat waktu sesuai dengan Standar pelayanan yang dijanjikan?', 'SelectOne', 'Tidak tepat waktu:Kurang tepat waktu:Tepat waktu:Sangat tepat waktu'),
(8, 'Tarif atau biaya pelayanan yang diberikan sesuai dengan ketentuan', 'SelectOne', 'Tidak Sesuai:Kurang Sesuai:Sesuai:Sesuai/Gratis'),
(9, 'Bagaimana pendapat saudara tentang Kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan', 'SelectOne', 'Tidak Sesuai:Kurang Sesuai:Sesuai:Sangat Sesuai'),
(10, 'Bagaimana pendapat saudara tentang penanganan pengaduan pengguna pelayanan', 'SelectOne', 'Tidak ada:Ada tetapi tidak berfungsi:Ada tapi berfungsi kurang optimal:Ada dan dikelola dengan baik'),
(11, 'Bagaimana pendapat Saudara tentang kompetensi /kemampuan petugas dalam layanan?', 'SelectOne', 'Tidak Kompeten:Kurang Kompeten:Kompeten:Sangat Kompeten'),
(12, 'Bagaimana perilaku petugas dalam layanan terkait dengan kesopanan dan keramahan?', 'SelectOne', 'Tidak Sopan/Tidak Ramah:Kurang Sopan/Kurang Ramah:Sopan/Ramah:Sangat Sopan/ramah'),
(13, 'Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana pelayanan?', 'SelectOne', 'Buruk:Cukup:Baik:Sangat Baik'),
(14, 'Bagaimana pendapat Saudara tentang transparansi pelayanan (informasi dan proses pelayanan transparan akuntabel)', 'SelectOne', 'Buruk:Cukup:Baik:Sangat Baik'),
(15, 'Integritas petugas pelayanan, apakah berintegritas tinggi dan tidak melakukan KKN', 'SelectOne', 'Tidak Sesuai:Kurang Sesuai:Sesuai:Sangat Sesuai');
