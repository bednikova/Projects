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


-- Dumping database structure for orders
CREATE DATABASE IF NOT EXISTS `orders` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `orders`;

-- Dumping structure for table orders.category
CREATE TABLE IF NOT EXISTS `category` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table orders.category: 3 rows
DELETE FROM `category`;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`Id`, `Name`) VALUES
	(1, 'Coca Cola Products'),
	(2, 'Water'),
	(3, 'Natural juice');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table orders.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ProductId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table orders.orders: 2 rows
DELETE FROM `orders`;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`Id`, `ProductId`) VALUES
	(1, 1),
	(2, 5);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table orders.product
CREATE TABLE IF NOT EXISTS `product` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `IdCategory` int(11) NOT NULL,
  `IdQuantity` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table orders.product: 11 rows
DELETE FROM `product`;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`Id`, `Name`, `IdCategory`, `IdQuantity`) VALUES
	(1, 'Coca Cola', 1, 7),
	(2, 'Devin', 2, 5),
	(3, 'Devin', 2, 10),
	(4, 'Coca Cola', 1, 1),
	(5, 'Coca Cola', 1, 2),
	(6, 'Bankia', 2, 10),
	(7, 'Coca Cola', 1, 3),
	(8, 'Fanta', 1, 3),
	(9, 'Coca Cola', 1, 6),
	(10, 'Fanta', 1, 6),
	(11, 'Orange juice', 3, 5);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Dumping structure for table orders.quantity
CREATE TABLE IF NOT EXISTS `quantity` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table orders.quantity: 9 rows
DELETE FROM `quantity`;
/*!40000 ALTER TABLE `quantity` DISABLE KEYS */;
INSERT INTO `quantity` (`Id`, `Description`) VALUES
	(1, '300ml'),
	(2, '400ml'),
	(3, '500ml'),
	(4, '700ml'),
	(5, '1l'),
	(6, '1.5l'),
	(7, '2l'),
	(8, '5l'),
	(10, '10l');
/*!40000 ALTER TABLE `quantity` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
