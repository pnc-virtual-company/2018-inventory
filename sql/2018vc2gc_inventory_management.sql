-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 30, 2018 at 04:51 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2018vc2gc_inventory_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

DROP TABLE IF EXISTS `borrow`;
CREATE TABLE IF NOT EXISTS `borrow` (
  `idBorrow` int(50) UNSIGNED NOT NULL AUTO_INCREMENT,
  `borrower` varchar(30) NOT NULL,
  `itemBorrow` varchar(30) NOT NULL,
  `startDate` date DEFAULT NULL,
  `returnDate` date DEFAULT NULL,
  `actualDate` date DEFAULT NULL,
  PRIMARY KEY (`idBorrow`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`idBorrow`, `borrower`, `itemBorrow`, `startDate`, `returnDate`, `actualDate`) VALUES
(31, 'Admin ADMINISTRATOR', '15', '2018-05-28', '2018-05-29', '2018-05-28'),
(32, 'Admin ADMINISTRATOR', '15', '2018-05-28', '2018-05-29', '2018-05-28'),
(33, 'Admin ADMINISTRATOR', '15', '2018-05-28', '0000-00-00', '2018-05-28'),
(34, 'Admin ADMINISTRATOR', '15', '2018-05-28', '2018-05-29', NULL),
(35, 'Admin ADMINISTRATOR', '16', '2018-05-28', '2018-05-29', '2018-05-30'),
(36, 'Admin ADMINISTRATOR', '15', '2018-05-28', '2018-05-29', '2018-05-28'),
(37, 'Admin ADMINISTRATOR', '15', '2018-05-24', '2018-05-26', '2018-05-29'),
(38, 'Soheng CHHUM', '18', '2018-05-28', '2018-05-29', '2018-05-28'),
(39, 'Test TEST', '20', '2018-05-30', '2018-05-31', NULL),
(40, 'Admin ADMINISTRATOR', '16', '2018-05-30', '0000-00-00', '2018-05-29'),
(41, 'Admin ADMINISTRATOR', '16', '2018-05-10', '0000-00-00', NULL),
(42, 'Admin ADMINISTRATOR', '18', '0000-00-00', '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `idbrand` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idbrand`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`idbrand`, `brand`) VALUES
(2, 'Philips'),
(3, 'sony'),
(5, 'Unknown'),
(6, 'Sony'),
(7, 'Microtic '),
(8, 'SAMSUNG'),
(9, 'LG'),
(10, 'Panasonic'),
(12, 'sony'),
(14, 'Samsung');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `idcategory` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcategory`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`idcategory`, `category`) VALUES
(3, 'Garden'),
(6, 'Fan'),
(10, 'Pen'),
(12, 'Air conditioner'),
(13, 'Chair'),
(14, 'Desktop'),
(15, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `iddepartment` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iddepartment`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`iddepartment`, `department`) VALUES
(1, 'Admin & Finance'),
(3, 'WEP'),
(4, 'SNA'),
(5, 'Training '),
(7, 'Test2');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `iditem` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `item` varchar(45) DEFAULT NULL,
  `itemdescription` varchar(300) DEFAULT NULL,
  `itemcost` varchar(45) DEFAULT NULL,
  `condition` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `materialid` int(11) DEFAULT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `departmentid` int(11) DEFAULT NULL,
  `locationid` int(11) DEFAULT NULL,
  `modelid` int(11) DEFAULT NULL,
  `ownerid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`iditem`),
  KEY `fk_item_material_idx` (`materialid`),
  KEY `fk_item_category1_idx` (`categoryid`),
  KEY `fk_item_department1_idx` (`departmentid`),
  KEY `fk_item_location1_idx` (`locationid`),
  KEY `fk_item_model1_idx` (`modelid`),
  KEY `fk_item_owner1_idx` (`ownerid`),
  KEY `fk_item_users1_idx` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`iditem`, `code`, `date`, `item`, `itemdescription`, `itemcost`, `condition`, `status`, `materialid`, `categoryid`, `departmentid`, `locationid`, `modelid`, `ownerid`, `userid`) VALUES
(15, 'A22-F', '0000-00-00', 'Chair by ANZ', 'This chair was donated by ANZ company.', '', 'Damaged', '2', 2, 13, 3, 2, 0, 3, 9),
(16, 'B21-G', '0000-00-00', 'RJ45 cable', 'This item was owned by SNA student for VC2.', '', 'Damaged', '2', 2, 0, 4, 1, 0, 2, 5),
(18, 'A22-I', '2018-05-15', 'Apple airII', 'This computer was donated by Chip Mong Group Company.', '219', 'New', '2', 5, 15, 3, 2, 4, 2, 1),
(19, 'Teachers room-J', '0000-00-00', 'Apple air 2', '', '', 'Fair', '0', 3, 15, 3, 3, 0, 2, 9),
(21, 'Test2-J', '0000-00-00', 'Test_Item', 'this is a test', '', 'Broken', '0', 6, 17, 7, 5, 7, 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `idlocation` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idlocation`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`idlocation`, `location`) VALUES
(1, 'B21'),
(2, 'A22'),
(3, 'Teachers room'),
(4, 'Strorage room'),
(5, 'Test2');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE IF NOT EXISTS `material` (
  `idmaterial` int(11) NOT NULL AUTO_INCREMENT,
  `material` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmaterial`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`idmaterial`, `material`) VALUES
(1, 'Wood'),
(2, 'Plastic'),
(3, 'Resin'),
(4, 'Composite'),
(5, 'Iron'),
(6, 'Test2');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
CREATE TABLE IF NOT EXISTS `model` (
  `idmodel` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(45) DEFAULT NULL,
  `brandid` int(11) DEFAULT NULL,
  PRIMARY KEY (`idmodel`),
  KEY `fk_model_brand1_idx` (`brandid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`idmodel`, `model`, `brandid`) VALUES
(1, 'Lenovo X2', NULL),
(2, 'Lenovo X2', NULL),
(3, 'Lenovo T1', NULL),
(4, 'ProBook6440b', 2),
(5, 'ProBook70b', 2),
(6, 'ProBook6460b', 2),
(7, 'Test2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

DROP TABLE IF EXISTS `owner`;
CREATE TABLE IF NOT EXISTS `owner` (
  `idowner` int(11) NOT NULL AUTO_INCREMENT,
  `owner` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idowner`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`idowner`, `owner`) VALUES
(1, 'EDU department '),
(2, 'IT admin'),
(3, 'ERO'),
(4, 'Reth NHEL'),
(6, 'Test2');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(412) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_roles1_idx` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `login`, `password`, `active`, `role`) VALUES
(1, 'Benjamin', 'BALET', 'benjamin.balet@gmail.com', 'bbalet', '$2a$08$LeUbaGFqJjLSAN7to9URsuHB41zcmsMBgBhpZuFp2y2OTxtVcMQ.C', 1, 1),
(2, 'john', 'DOE', 'jdoe@test.org', 'jdoe', '$2a$08$sZjK.lypJ7EQLwvZ8sLRd.FiUEBsDuCsJg9UCw0n0U/pR.hj0o9lC', 1, 2),
(3, 'Bob', 'DENARD', 'bdenard@test.org', 'bdenard', '$2a$08$14jdHTPUZe5.zXxQ1NqhhO83xUt2Zkr.csGw10BH75B3VrJiNU8Bq', 1, 2),
(5, 'Admin', 'ADMINISTRATOR', 'admin@skeleton.org', 'admin', '$2a$08$cnX6al6aTkoyh/N/tKZ11e8ec9J/sldA6R4NdP.2qhhDi0OD3ek1G', 1, 1),
(7, 'Panha', 'HUOR', 'panha.huor@student.passerellesnumeriques.org', 'panha', '$2a$08$rPG73j58iO1hu/OvMgH1Ze538r5PQRpPtWihpaKGp7SsLJmHXlSw2', 1, 2),
(8, 'Dalin', 'LOEM', 'dalin@gmail.com', 'dloem', '$2a$08$sQQVERlHQG4V4Dn/ZE.HL.mWspgrJPnSwsx/TY7Up6w2KUD1AaVYS', NULL, 2),
(9, 'Soheng', 'CHHUM', 'soheng.chhum@gmail.com', 'schhum', '$2a$08$UcrXBNozwnhycsmseqqBJ.6yKyGjrCvTgRyu6sRZ6N/FGWCIzdlrq', NULL, 2),
(10, 'Bunla', 'RATH', 'bunla.rath@gmail.com', 'brath', '$2a$08$Q0UZHEUEVJOKoEM2PltdEemd59HEUn8ca5JSomEcI1iNTo.HvByge', NULL, 2),
(11, 'Sinat', 'NEAM', 'dalin@gmail.com', 'sneam', '$2a$08$pJN5p0tP3XLNEq0atUA6a.lUEsNGlFhV3lxz53TY7AuIq7C.jQhMy', NULL, 2),
(15, 'Test_Matt', 'TEST', 'faefea', 'ttest', '$2a$08$33nDde6DgjSEj/ugJvmJseYoWdDXKwdZvXApJxVOTAVkns.//1eN2', 1, 2);

--
-- Constraints for dumped tables
--

--²
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`brandid`) REFERENCES `brand` (`idbrand`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
