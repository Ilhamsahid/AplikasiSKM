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
CREATE TABLE IF NOT EXISTS `tb_instansi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `instansi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `umur` tinyint NOT NULL DEFAULT (0),
  `kelamin` enum('L','P') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'L',
  `lulusan` enum('SD','SMP','SMA','D1/D2/D3','S1/D4','S2','S3') COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table survei_kepuasan.tb_instansi: ~0 rows (approximately)

-- Dumping structure for table survei_kepuasan.tb_jawaban
CREATE TABLE IF NOT EXISTS `tb_jawaban` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pertanyaan` int NOT NULL DEFAULT '0',
  `id_instansi` int NOT NULL DEFAULT '0',
  `jawaban` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__tb_pertanyaan` (`id_pertanyaan`),
  KEY `FK__tb_instansi` (`id_instansi`),
  CONSTRAINT `FK__tb_instansi` FOREIGN KEY (`id_instansi`) REFERENCES `tb_instansi` (`id`),
  CONSTRAINT `FK__tb_pertanyaan` FOREIGN KEY (`id_pertanyaan`) REFERENCES `tb_pertanyaan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table survei_kepuasan.tb_jawaban: ~0 rows (approximately)

-- Dumping structure for table survei_kepuasan.tb_pertanyaan
CREATE TABLE IF NOT EXISTS `tb_pertanyaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(120) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table survei_kepuasan.tb_pertanyaan: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
