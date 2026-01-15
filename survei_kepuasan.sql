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
  CONSTRAINT `FK__tb_responden` FOREIGN KEY (`id_responden`) REFERENCES `tb_responden` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__tb_pertanyaan` FOREIGN KEY (`id_pertanyaan`) REFERENCES `tb_pertanyaan` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tb_pertanyaan` (`id`, `pertanyaan`, `tipe`, `jawaban`) VALUES
(1, 'Kemudahan akses informasi layanan  Dinas Kesehatan Pengendalian Penduduk dan KB Kota Probolinggo. (informasi layanan tersedia di berbagai media elektronik dan nonelektronik)', 'SelectOne', 'Tidak Mudah:Kurang Mudah:Mudah:Sangat Mudah'),
(2, 'Kesesuaian persyaratan pelayanan dengan jenis pelayanannya', 'SelectOne', 'Tidak Sesuai:Kurang Sesuai:Sesuai:Sangat Sesuai'),
(3, 'Bagaimana pendapat Saudara tentang kemudahan Sistem, mekanisme dan prosedur pelayanan', 'SelectOne', 'Tidak Mudah:Kurang Mudah:Mudah:Sangat Mudah'),
(4, 'Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?', 'SelectOne', 'Tidak Cepat:Kurang Cepat:Cepat:Sangat Cepat'),
(5, 'Bagaimana pendapat Saudara tentang jam buka pelayanan sudah tepat waktu sesuai dengan Standar pelayanan yang dijanjikan?', 'SelectOne', 'Tidak tepat waktu:Kurang tepat waktu:Tepat waktu:Sangat tepat waktu'),
(6, 'Tarif atau biaya pelayanan yang diberikan sesuai dengan ketentuan', 'SelectOne', 'Tidak Sesuai:Kurang Sesuai:Sesuai:Sesuai/Gratis'),
(7, 'Bagaimana pendapat saudara tentang Kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan', 'SelectOne', 'Tidak Sesuai:Kurang Sesuai:Sesuai:Sangat Sesuai'),
(8, 'Bagaimana pendapat saudara tentang penanganan pengaduan pengguna pelayanan', 'SelectOne', 'Tidak ada:Ada tetapi tidak berfungsi:Ada tapi berfungsi kurang optimal:Ada dan dikelola dengan baik'),
(9, 'Bagaimana pendapat Saudara tentang kompetensi /kemampuan petugas dalam layanan?', 'SelectOne', 'Tidak Kompeten:Kurang Kompeten:Kompeten:Sangat Kompeten'),
(10, 'Bagaimana perilaku petugas dalam layanan terkait dengan kesopanan dan keramahan?', 'SelectOne', 'Tidak Sopan/Tidak Ramah:Kurang Sopan/Kurang Ramah:Sopan/Ramah:Sangat Sopan/ramah'),
(11, 'Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana pelayanan?', 'SelectOne', 'Buruk:Cukup:Baik:Sangat Baik'),
(12, 'Bagaimana pendapat Saudara tentang transparansi pelayanan (informasi dan proses pelayanan transparan akuntabel)', 'SelectOne', 'Buruk:Cukup:Baik:Sangat Baik'),
(13, 'Integritas petugas pelayanan, apakah berintegritas tinggi dan tidak melakukan KKN', 'SelectOne', 'Tidak Sesuai:Kurang Sesuai:Sesuai:Sangat Sesuai');

--
-- Dumping data for table `tb_responden`
--

INSERT INTO `tb_responden` 
(`id`, `responden`, `umur`, `kelamin`, `lulusan`, `jenis_pelayanan`, `no_hp`, `pekerjaan`, `tanggal_terakhir_kali`, `tanggal`) VALUES
(11, 'Fiarl', 19, 'L', 'SMA', 'Pelayanan Lainnya', '081234567890', 'Mahasiswa', '2026-01-01', '2025-12-24'),
(12, 'Fajrul', 19, 'L', 'SMA', 'Pelayanan Rekomendasi Ijin Fasilitas Kesehatan', '081234567891', 'Mahasiswa', '2026-01-01', '2025-12-26'),
(13, 'Fahri', 19, 'L', 'SMA', 'Pelayanan Konsultasi PIRT', '081234567892', 'Pelajar', '2026-01-01', '2025-12-27'),
(14, 'Fahruj', 19, 'L', 'SMA', 'Pelayanan Fogging', '081234567893', 'Pelajar', '2026-01-02', '2026-01-14'),
(15, 'asedash', 17, 'L', 'SMP', 'Pelayanan Konsultasi PIRT', '081234567894', 'Pelajar', '2026-01-01', '2026-01-14'),
(16, 'Haku', 24, 'L', 'S1/D4', 'Pelayanan Fogging', '081234567895', 'Pegawai Swasta', '2026-01-03', '2026-01-14'),
(18, 'ilhamsah', 12, 'L', 'SMA', 'Pelayanan Rekomendasi Ijin Fasilitas Kesehatan', '081234567896', 'Pelajar', '2026-01-13', '2026-01-14'),
(19, 'Sah', 12, 'L', 'SMP', 'Pelayanan Konsultasi PIRT', '081234567897', 'Pelajar', '2026-01-13', '2026-01-14'),
(20, 'Ilham Sahid Maulana', 14, 'L', 'SD', 'Pelayanan Rekomendasi Ijin Fasilitas Kesehatan', '081234567898', 'Pelajar', '2026-01-01', '2026-01-14');

--
-- Dumping data for table `tb_jawaban`
--

INSERT INTO `tb_jawaban` (`id`, `id_pertanyaan`, `id_responden`, `jawaban`, `nilai`) VALUES
(363, 1, 11, 'Kurang Mudah', 2),
(364, 2, 11, 'Sesuai', 3),
(365, 3, 11, 'Sangat Mudah', 4),
(366, 4, 11, 'Sangat Cepat', 4),
(367, 5, 11, 'Tepat waktu', 3),
(368, 6, 11, 'Sesuai/Gratis', 4),
(369, 7, 11, 'Sesuai', 3),
(370, 8, 11, 'Ada dan dikelola dengan baik', 4),
(371, 9, 11, 'Sangat Kompeten', 4),
(372, 10, 11, 'Sopan/Ramah', 3),
(373, 11, 11, 'Sangat Baik', 4),
(374, 12, 11, 'Sangat Baik', 4),
(375, 13, 11, 'Sangat Sesuai', 4),
(376, 1, 12, 'Sangat Mudah', 4),
(377, 2, 12, 'Sangat Sesuai', 4),
(378, 3, 12, 'Mudah', 3),
(379, 4, 12, 'Sangat Cepat', 4),
(380, 5, 12, 'Tepat waktu', 3),
(381, 6, 12, 'Sesuai/Gratis', 4),
(382, 7, 12, 'Sangat Sesuai', 4),
(383, 8, 12, 'Ada tapi berfungsi kurang optimal', 3),
(384, 9, 12, 'Sangat Kompeten', 4),
(385, 10, 12, 'Sangat Sopan/ramah', 4),
(386, 11, 12, 'Sangat Baik', 4),
(387, 12, 12, 'Sangat Baik', 4),
(388, 13, 12, 'Sesuai', 3),
(389, 1, 13, 'Mudah', 3),
(390, 2, 13, 'Sangat Sesuai', 4),
(391, 3, 13, 'Mudah', 3),
(392, 4, 13, 'Cepat', 3),
(393, 5, 13, 'Sangat tepat waktu', 4),
(394, 6, 13, 'Sesuai', 3),
(395, 7, 13, 'Sesuai', 3),
(396, 8, 13, 'Ada tapi berfungsi kurang optimal', 3),
(397, 9, 13, 'Sangat Kompeten', 4),
(398, 10, 13, 'Sangat Sopan/ramah', 4),
(399, 11, 13, 'Sangat Baik', 4),
(400, 12, 13, 'Baik', 3),
(401, 13, 13, 'Sangat Sesuai', 4),
(402, 1, 14, 'Sangat Mudah', 4),
(403, 2, 14, 'Sangat Sesuai', 4),
(404, 3, 14, 'Sangat Mudah', 4),
(405, 4, 14, 'Sangat Cepat', 4),
(406, 5, 14, 'Sangat tepat waktu', 4),
(407, 6, 14, 'Sesuai/Gratis', 4),
(408, 7, 14, 'Sesuai', 3),
(409, 8, 14, 'Ada tapi berfungsi kurang optimal', 3),
(410, 9, 14, 'Kompeten', 3),
(411, 10, 14, 'Sangat Sopan/ramah', 4),
(412, 11, 14, 'Sangat Baik', 4),
(413, 12, 14, 'Sangat Baik', 4),
(414, 13, 14, 'Sesuai', 3),
(415, 1, 15, 'Mudah', 3),
(416, 2, 15, 'Sangat Sesuai', 4),
(417, 3, 15, 'Mudah', 3),
(418, 4, 15, 'Sangat Cepat', 4),
(419, 5, 15, 'Sangat tepat waktu', 4),
(420, 6, 15, 'Sesuai/Gratis', 4),
(421, 7, 15, 'Sangat Sesuai', 4),
(422, 8, 15, 'Ada dan dikelola dengan baik', 4),
(423, 9, 15, 'Sangat Kompeten', 4),
(424, 10, 15, 'Sangat Sopan/ramah', 4),
(425, 11, 15, 'Sangat Baik', 4),
(426, 12, 15, 'Baik', 3),
(427, 13, 15, 'Sangat Sesuai', 4),
(428, 1, 16, 'Mudah', 3),
(429, 2, 16, 'Sangat Sesuai', 4),
(430, 3, 16, 'Sangat Mudah', 4),
(431, 4, 16, 'Cepat', 3),
(432, 5, 16, 'Sangat tepat waktu', 4),
(433, 6, 16, 'Sesuai/Gratis', 4),
(434, 7, 16, 'Sesuai', 3),
(435, 8, 16, 'Ada dan dikelola dengan baik', 4),
(436, 9, 16, 'Sangat Kompeten', 4),
(437, 10, 16, 'Sangat Sopan/ramah', 4),
(438, 11, 16, 'Baik', 3),
(439, 12, 16, 'Sangat Baik', 4),
(440, 13, 16, 'Sangat Sesuai', 4),
(454, 1, 18, 'Kurang Mudah', 2),
(455, 2, 18, 'Sesuai', 3),
(456, 3, 18, 'Sangat Mudah', 4),
(457, 4, 18, 'Cepat', 3),
(458, 5, 18, 'Sangat tepat waktu', 4),
(459, 6, 18, 'Sesuai/Gratis', 4),
(460, 7, 18, 'Sangat Sesuai', 4),
(461, 8, 18, 'Ada tapi berfungsi kurang optimal', 3),
(462, 9, 18, 'Sangat Kompeten', 4),
(463, 10, 18, 'Sangat Sopan/ramah', 4),
(464, 11, 18, 'Sangat Baik', 4),
(465, 12, 18, 'Sangat Baik', 4),
(466, 13, 18, 'Sangat Sesuai', 4),
(467, 1, 20, 'Kurang Mudah', 2),
(468, 2, 20, 'Sesuai', 3),
(469, 3, 20, 'Sangat Mudah', 4),
(470, 4, 20, 'Sangat Cepat', 4),
(471, 5, 20, 'Sangat tepat waktu', 4),
(472, 6, 20, 'Sesuai/Gratis', 4),
(473, 7, 20, 'Sangat Sesuai', 4),
(474, 8, 20, 'Ada tapi berfungsi kurang optimal', 3),
(475, 9, 20, 'Sangat Kompeten', 4),
(476, 10, 20, 'Sopan/Ramah', 3),
(477, 11, 20, 'Baik', 3),
(478, 12, 20, 'Sangat Baik', 4),
(479, 13, 20, 'Sangat Sesuai', 4);
