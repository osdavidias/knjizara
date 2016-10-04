-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for knjizara
CREATE DATABASE IF NOT EXISTS `knjizara` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `knjizara`;


-- Dumping structure for table knjizara.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `username` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(16) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table knjizara.admin: ~0 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`username`, `password`) VALUES
	('pero', '123');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


-- Dumping structure for table knjizara.kategorije
CREATE TABLE IF NOT EXISTS `kategorije` (
  `br_kategorije` int(11) NOT NULL AUTO_INCREMENT,
  `naziv_kategorije` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`br_kategorije`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table knjizara.kategorije: ~1 rows (approximately)
/*!40000 ALTER TABLE `kategorije` DISABLE KEYS */;
INSERT INTO `kategorije` (`br_kategorije`, `naziv_kategorije`) VALUES
	(1, 'Poezija'),
	(3, 'Znanstvena fantastika');
/*!40000 ALTER TABLE `kategorije` ENABLE KEYS */;


-- Dumping structure for table knjizara.knjige
CREATE TABLE IF NOT EXISTS `knjige` (
  `br_knjige` int(11) NOT NULL,
  `br_kategorije` int(11) NOT NULL,
  `autor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `naslov` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cijena` decimal(10,2) NOT NULL,
  `opis` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `godina_izdanja` int(11) NOT NULL,
  PRIMARY KEY (`br_knjige`),
  KEY `br_kategorije` (`br_kategorije`),
  CONSTRAINT `FK_knjige_kategorije` FOREIGN KEY (`br_kategorije`) REFERENCES `kategorije` (`br_kategorije`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table knjizara.knjige: ~0 rows (approximately)
/*!40000 ALTER TABLE `knjige` DISABLE KEYS */;
INSERT INTO `knjige` (`br_knjige`, `br_kategorije`, `autor`, `naslov`, `cijena`, `opis`, `godina_izdanja`) VALUES
	(1, 1, 'Dobriša Cesarić', 'Voćka Poslije Kiše', 77.45, 'Poezija Dobriše Cesarića', 1978);
/*!40000 ALTER TABLE `knjige` ENABLE KEYS */;


-- Dumping structure for table knjizara.kupci
CREATE TABLE IF NOT EXISTS `kupci` (
  `br_kupca` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `grad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `post_br` int(11) NOT NULL,
  PRIMARY KEY (`br_kupca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table knjizara.kupci: ~0 rows (approximately)
/*!40000 ALTER TABLE `kupci` DISABLE KEYS */;
/*!40000 ALTER TABLE `kupci` ENABLE KEYS */;


-- Dumping structure for table knjizara.narudzbe
CREATE TABLE IF NOT EXISTS `narudzbe` (
  `br_narudzbe` int(11) NOT NULL AUTO_INCREMENT,
  `br_kupca` int(11) NOT NULL DEFAULT '0',
  `kolicina` int(11) NOT NULL DEFAULT '0',
  `datum` date NOT NULL DEFAULT '0000-00-00',
  `status_narudzbe` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ime_dostava` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `prezime_dostava` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `grad_dostava` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `adresa_dostava` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`br_narudzbe`),
  KEY `br_kupca` (`br_kupca`),
  CONSTRAINT `FK_narudzbe_kupci` FOREIGN KEY (`br_kupca`) REFERENCES `kupci` (`br_kupca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table knjizara.narudzbe: ~0 rows (approximately)
/*!40000 ALTER TABLE `narudzbe` DISABLE KEYS */;
/*!40000 ALTER TABLE `narudzbe` ENABLE KEYS */;


-- Dumping structure for table knjizara.narudzbe_knjige
CREATE TABLE IF NOT EXISTS `narudzbe_knjige` (
  `br_narudzbe` int(11) NOT NULL,
  `br_knjige` int(11) NOT NULL,
  `cijena` decimal(10,2) NOT NULL,
  `kolicina` int(11) NOT NULL,
  PRIMARY KEY (`br_narudzbe`,`br_knjige`),
  KEY `br_narudzbe` (`br_narudzbe`),
  KEY `br_knjige` (`br_knjige`),
  CONSTRAINT `FK_narudzbe_knjige_knjige` FOREIGN KEY (`br_knjige`) REFERENCES `knjige` (`br_knjige`),
  CONSTRAINT `FK_narudzbe_knjige_narudzbe` FOREIGN KEY (`br_narudzbe`) REFERENCES `narudzbe` (`br_narudzbe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table knjizara.narudzbe_knjige: ~0 rows (approximately)
/*!40000 ALTER TABLE `narudzbe_knjige` DISABLE KEYS */;
/*!40000 ALTER TABLE `narudzbe_knjige` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
