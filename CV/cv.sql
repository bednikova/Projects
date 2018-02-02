-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for cv
CREATE DATABASE IF NOT EXISTS `cv` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cv`;

-- Dumping structure for table cv.guest
CREATE TABLE IF NOT EXISTS `guest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table cv.guest: 1 rows
DELETE FROM `guest`;
/*!40000 ALTER TABLE `guest` DISABLE KEYS */;
INSERT INTO `guest` (`id`, `username`, `password`, `name`) VALUES
	(1, 'test', 'test', '0');
/*!40000 ALTER TABLE `guest` ENABLE KEYS */;

-- Dumping structure for table cv.home
CREATE TABLE IF NOT EXISTS `home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table cv.home: 1 rows
DELETE FROM `home`;
/*!40000 ALTER TABLE `home` DISABLE KEYS */;
INSERT INTO `home` (`id`, `first_name`, `last_name`, `address`, `phone`, `email`, `date_of_birth`) VALUES
	(1, 'Mihaela', 'Bednikova', 'Bulgaria,Sofia', '+359899810701', 'mihaela.bednikova@gmail.com', '1993-05-27');
/*!40000 ALTER TABLE `home` ENABLE KEYS */;

-- Dumping structure for table cv.information
CREATE TABLE IF NOT EXISTS `information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL DEFAULT '0',
  `last_name` varchar(50) NOT NULL DEFAULT '0',
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(50) NOT NULL DEFAULT '0',
  `phone` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table cv.information: 1 rows
DELETE FROM `information`;
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
INSERT INTO `information` (`id`, `first_name`, `last_name`, `date_of_birth`, `address`, `phone`, `email`) VALUES
	(1, 'Mihaela', 'Bednikova', '1993-05-27', 'Bulgaria, Sofia', '+359899810701', 'mihaela.bednikova@gmail.com');
/*!40000 ALTER TABLE `information` ENABLE KEYS */;

-- Dumping structure for table cv.skills
CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(50) DEFAULT '0',
  `level` varchar(50) DEFAULT '0',
  `experience` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table cv.skills: 8 rows
DELETE FROM `skills`;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` (`id`, `language`, `level`, `experience`) VALUES
	(1, 'C++', 'base', '6 years'),
	(2, 'PHP', 'base', '4 months'),
	(3, 'HTML', 'base', ''),
	(4, 'CSS', 'base', ''),
	(5, 'C#', 'base', ''),
	(6, 'JavaScript', 'base', ''),
	(7, 'Bash', 'base', ''),
	(8, 'Scheme', 'base', '');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
