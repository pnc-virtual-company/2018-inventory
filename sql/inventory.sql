-- ---------------------------------------------------
-- Inventory Management System Schema definition
--
-- @license      http://opensource.org/licenses/AGPL-3.0 AGPL-3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS inventory CHARACTER SET utf8 COLLATE utf8_general_ci;
USE inventory;

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
(1, 'Philips'),
(2, 'Sony'),
(3, 'Unknown'),
(4, 'Sony'),
(5, 'Microtik'),
(6, 'SAMSUNG'),
(7, 'LG'),
(8, 'Panasonic'),
(9, 'Lenovo'),
(10, 'HP'),
(11, 'Samsung');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `idcategory` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `acronym` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`idcategory`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`idcategory`, `category`) VALUES
(1, 'Garden'),
(2, 'Fan'),
(3, 'Pen'),
(4, 'Air conditioner'),
(5, 'Chair'),
(6, 'Desktop'),
(7, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `iddepartment` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`iddepartment`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`iddepartment`, `department`) VALUES
(1, 'Admin & Finance'),
(3, 'WEP'),
(4, 'SNA'),
(5, 'Training');

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
  `itemdescription` TEXT DEFAULT NULL,
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
(1, '', '0000-00-00', 'Simple chair', 'A chair made of wood', '', 'New', '0', 1, 5, 3, 0, 0, 0, 0),
(2, '', '0000-00-00', 'Computer', 'It is a laptop', '', 'New', '0', 4, 7, 0, 0, 2, 3, 0),
(24, '-O', '0000-00-00', 'Plastic chair', 'Cheap chair', '', 'Fair', '0', 0, 5, 0, 0, 0, 0, 0),
(25, 'A22-P', '0000-00-00', 'Chair \'executive\'', 'Enhanced version', '', 'Damaged', '0', 4, 5, 0, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `idlocation` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idlocation`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`idlocation`, `location`) VALUES
(1, 'B21'),
(2, 'A22'),
(3, 'Teachers room'),
(4, 'Strorage room');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE IF NOT EXISTS `material` (
  `idmaterial` int(11) NOT NULL AUTO_INCREMENT,
  `material` varchar(255) DEFAULT NULL,
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
(5, 'Iron');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
CREATE TABLE IF NOT EXISTS `model` (
  `idmodel` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(255) DEFAULT NULL,
  `brandid` int(11) DEFAULT NULL,
  PRIMARY KEY (`idmodel`),
  KEY `fk_model_brand1_idx` (`brandid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`idmodel`, `model`, `brandid`) VALUES
(1, 'Lenovo X2', 9),
(2, 'Lenovo X2', 9),
(3, 'Lenovo T1', 9),
(4, 'ProBook 6440b', 10),
(5, 'ProBook 70b', 10),
(6, 'ProBook 6460b', 10);

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

DROP TABLE IF EXISTS `owner`;
CREATE TABLE IF NOT EXISTS `owner` (
  `idowner` int(11) NOT NULL AUTO_INCREMENT,
  `owner` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idowner`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`idowner`, `owner`) VALUES
(1, 'EDU department'),
(2, 'IT admin'),
(3, 'ERO');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
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
(1, 'Admin', 'ADMINISTRATOR', 'admin@ims.org', 'admin', '$2a$08$cnX6al6aTkoyh/N/tKZ11e8ec9J/sldA6R4NdP.2qhhDi0OD3ek1G', 1, 1);

--
-- Constraints for dumped tables
--

--
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
