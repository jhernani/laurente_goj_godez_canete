-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2015 at 07:59 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `UNAME` varchar(15) DEFAULT NULL,
  `ISMIS_ID` int(10) unsigned DEFAULT NULL,
  `PWORD` binary(32) NOT NULL,
  `SALT` varchar(7) NOT NULL,
  `EMAIL` varchar(225) NOT NULL,
  `ROOM` int(10) unsigned DEFAULT NULL,
  `ACC_TYPE` enum('0','1') NOT NULL DEFAULT '0',
  `ADMIN_TYPE` enum('0','1','2','3') DEFAULT '0',
  `STATUS` enum('0','1') NOT NULL DEFAULT '1',
  `IMAGE_PATH` text,
  `START_DATE` date DEFAULT '0000-00-00',
  `END_DATE` date DEFAULT '0000-00-00',
  `ACC_ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ACC_ID`),
  UNIQUE KEY `EMAIL` (`EMAIL`),
  UNIQUE KEY `UNAME` (`UNAME`),
  KEY `ACCOUNT_FK1` (`ROOM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`UNAME`, `ISMIS_ID`, `PWORD`, `SALT`, `EMAIL`, `ROOM`, `ACC_TYPE`, `ADMIN_TYPE`, `STATUS`, `IMAGE_PATH`, `START_DATE`, `END_DATE`, `ACC_ID`) VALUES
('system', NULL, '35636561333130663631663936653063', 'TEST', 'sys@admin.com', NULL, '1', '3', '1', NULL, '0000-00-00', '0000-00-00', 1111111),
('supv', NULL, '35636561333130663631663936653063', 'TEST', 'supv@admin.com', NULL, '1', '1', '1', NULL, '0000-00-00', '0000-00-00', 1111112),
('acctg', NULL, '35636561333130663631663936653063', 'TEST', 'acctg@admin.com', NULL, '1', '2', '1', NULL, '0000-00-00', '0000-00-00', 1111113),
(NULL, 9303322, '5cea310f61f96e0cf5342d406d300af4', 'TEST', 'jhunluis@gmail.com', 23, '0', '0', '0', NULL, '2015-10-07', '0000-00-00', 15100713),
(NULL, NULL, '175cd3f98c63db960ab98466765e7c30', 'TEST', 'dorm_supervisor@gmail.com', NULL, '1', '1', '1', NULL, '0000-00-00', '0000-00-00', 15100714),
(NULL, NULL, 'dd806ab414ccbdd75ea37639bad935bf', 'TEST', 'finance_admin@usc.com', NULL, '1', '2', '1', NULL, '0000-00-00', '0000-00-00', 15100715),
(NULL, NULL, 'f4e83ea1a4278f8acf93d1e3e508beaf', 'TEST', 'system_admin@gmail.com', NULL, '1', '3', '1', NULL, '0000-00-00', '0000-00-00', 15100716),
(NULL, 9123123, '5cea310f61f96e0cf5342d406d300af4', 'TEST', 'james@gmail.com', 23, '0', '0', '0', NULL, '2015-10-07', '2015-10-07', 15100717);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `C_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `C_ABBR` tinytext NOT NULL,
  `C_NAME` text NOT NULL,
  `MAX_YEAR` int(10) unsigned NOT NULL,
  PRIMARY KEY (`C_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`C_ID`, `C_ABBR`, `C_NAME`, `MAX_YEAR`) VALUES
(1, 'BSICT', 'Bachelor of Science in Information and Communication Technology', 4),
(2, 'BSIT', 'Bachelor of Science in Information Technology', 4),
(3, 'BSN', 'Bachelor of Science in Nursing', 4),
(4, 'BSPharma', 'Bachelor of Science in Pharmacy', 4),
(5, 'BSChemE', 'Bachelor of Science in Chemical Engineering', 5),
(6, 'BSCE', 'Bachelor of Science in Civil Engineering', 5),
(7, 'BSECE', 'Bachelor of Science in Electronics and Communcication Engineering', 5),
(8, 'BSME', 'Bachelor of Science in Mechanical Engineering', 5),
(9, 'BSArchi', 'Bachelor of Science in Architecture', 5),
(10, 'BSID', 'Bachelor of Science in Interior Design', 4),
(11, 'BSAccountancy', 'Bachelor of Science in Interior Design', 5),
(12, 'BSHRM', 'Bachelor of Science in Hotel and Restaurant Management', 4),
(13, 'BSBA', 'Bachelor of Science in Business Administration', 4);

-- --------------------------------------------------------

--
-- Table structure for table `due`
--

CREATE TABLE IF NOT EXISTS `due` (
  `ACC_ID` int(10) unsigned NOT NULL,
  `DUE_START` date NOT NULL,
  `DUE_DATE` date NOT NULL,
  `DUE_STATUS` enum('0','1','2') DEFAULT '0',
  KEY `DUE_FK` (`ACC_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `due`
--

INSERT INTO `due` (`ACC_ID`, `DUE_START`, `DUE_DATE`, `DUE_STATUS`) VALUES
(15100713, '2015-10-07', '2015-11-06', '0'),
(15100717, '2015-10-07', '2015-11-06', '0');

-- --------------------------------------------------------

--
-- Table structure for table `fee`
--

CREATE TABLE IF NOT EXISTS `fee` (
  `FEE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FEE_NAME` varchar(225) NOT NULL,
  `VALUE` decimal(15,2) NOT NULL,
  `ACTIVE` enum('0','1') DEFAULT '1',
  `CATEGORY` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`FEE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `fee`
--

INSERT INTO `fee` (`FEE_ID`, `FEE_NAME`, `VALUE`, `ACTIVE`, `CATEGORY`) VALUES
(1, 'Standard Room for 6', '1600.00', '1', '0'),
(2, 'Standard Room for 4', '1800.00', '1', '0'),
(3, 'Standard Room for 2', '3600.00', '1', '0'),
(4, 'Standard Room for 1', '4800.00', '1', '0'),
(5, 'Premium Room for 6', '1000.00', '1', '0'),
(6, 'Premium Room for 4', '3300.00', '1', '0'),
(7, 'Premium Room for 2', '6600.00', '1', '0'),
(8, 'Premium Room for 1', '8800.00', '1', '0'),
(9, 'Tablet', '200.00', '1', '1'),
(10, 'Laptop', '250.00', '1', '1'),
(11, 'Personal Electric Fan', '200.00', '1', '1'),
(12, 'Personal Computer', '350.00', '1', '1'),
(13, 'Flat Iron', '200.00', '1', '1'),
(14, 'DVD Player', '100.00', '1', '1'),
(15, 'Cassette Player', '100.00', '1', '1'),
(16, 'Rice Cooker', '200.00', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `INFO_ID` int(10) unsigned NOT NULL,
  `FNAME` varchar(225) NOT NULL,
  `LNAME` varchar(225) NOT NULL,
  `MNAME` varchar(225) DEFAULT NULL,
  `G_FNAME` varchar(225) DEFAULT NULL,
  `G_LNAME` varchar(225) DEFAULT NULL,
  `G_MNAME` varchar(225) DEFAULT NULL,
  `CONTACT` text NOT NULL,
  `GENDER` enum('M','F') NOT NULL,
  `BDATE` date NOT NULL,
  `YEAR` enum('1','2','3','4','5') DEFAULT NULL,
  `C_ID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`INFO_ID`),
  KEY `INFO_FK2` (`C_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`INFO_ID`, `FNAME`, `LNAME`, `MNAME`, `G_FNAME`, `G_LNAME`, `G_MNAME`, `CONTACT`, `GENDER`, `BDATE`, `YEAR`, `C_ID`) VALUES
(1111111, 'Lenver', 'Melgar', 'Sieras', NULL, NULL, NULL, '', 'M', '1992-11-08', NULL, NULL),
(1111112, 'Lenver', 'Melgar', 'Sieras', NULL, NULL, NULL, '', 'M', '1992-11-08', NULL, NULL),
(1111113, 'Lenver', 'Melgar', 'Sieras', NULL, NULL, NULL, '', 'M', '1992-11-08', NULL, NULL),
(15100713, 'Jhun', 'Laurente', NULL, NULL, NULL, NULL, '09328777231', 'M', '1992-11-06', '3', 1),
(15100714, 'Jhun', 'Laurente', NULL, NULL, NULL, NULL, '', 'M', '1992-11-06', NULL, NULL),
(15100715, 'Yani', 'Salvatore', NULL, NULL, NULL, NULL, '', 'M', '1988-11-07', NULL, NULL),
(15100716, 'Jan', 'Go', NULL, NULL, NULL, NULL, '', 'M', '1990-07-09', NULL, NULL),
(15100717, 'James', 'Arnold', NULL, NULL, NULL, NULL, '09328777211', 'M', '1989-10-15', '4', 6);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `USER` int(10) unsigned NOT NULL,
  `ACTV` varchar(225) NOT NULL,
  `ACTV_DATE` datetime NOT NULL,
  KEY `LOGS_FK` (`USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`USER`, `ACTV`, `ACTV_DATE`) VALUES
(15100713, 'Sign In', '2015-10-07 13:52:00'),
(15100713, 'Create Admin Account', '2015-10-07 13:53:00'),
(15100713, 'Create Admin Account', '2015-10-07 13:53:00'),
(15100713, 'Create Admin Account', '2015-10-07 13:54:00'),
(15100713, 'Sign Out', '2015-10-07 13:54:00'),
(15100714, 'Sign In', '2015-10-07 13:56:00'),
(15100714, 'Sign Out', '2015-10-07 13:56:00'),
(15100714, 'Sign In', '2015-10-07 13:58:00'),
(15100714, 'Sign Out', '2015-10-07 13:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `payable`
--

CREATE TABLE IF NOT EXISTS `payable` (
  `FEE_ID` int(10) unsigned NOT NULL,
  `ACC` int(10) unsigned NOT NULL,
  `CATEGORY` enum('0','1') DEFAULT '0',
  `DUE_DATE` date NOT NULL,
  `PAYABLE_STATUS` enum('0','1') DEFAULT '0',
  KEY `PAYABLE_FK` (`FEE_ID`),
  KEY `PAYABLE_FK2` (`ACC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payable`
--

INSERT INTO `payable` (`FEE_ID`, `ACC`, `CATEGORY`, `DUE_DATE`, `PAYABLE_STATUS`) VALUES
(1, 15100713, '0', '2015-11-06', '0'),
(1, 15100717, '0', '2015-11-06', '0'),
(9, 15100717, '0', '2015-11-06', '0');

-- --------------------------------------------------------

--
-- Table structure for table `privacy`
--

CREATE TABLE IF NOT EXISTS `privacy` (
  `ACC_ID` int(10) unsigned NOT NULL,
  `COURSE` enum('0','1') DEFAULT '1',
  `BDATE` enum('0','1') DEFAULT '1',
  `GENDER` enum('0','1') DEFAULT '1',
  `EMAIL` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`ACC_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privacy`
--

INSERT INTO `privacy` (`ACC_ID`, `COURSE`, `BDATE`, `GENDER`, `EMAIL`) VALUES
(15100713, '1', '1', '1', '1'),
(15100717, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `ACC` int(10) unsigned NOT NULL,
  `RESERVE_DATE` datetime NOT NULL,
  `ROOM` int(10) unsigned NOT NULL,
  `RESERVE_STATUS` enum('0','1','2','3') NOT NULL DEFAULT '0',
  PRIMARY KEY (`ACC`),
  KEY `RESERVATION_FK2` (`ROOM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `ROOM_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `BLG_ID` int(10) unsigned NOT NULL,
  `BLG_NAME` varchar(225) NOT NULL,
  `ROOM_NO` int(10) unsigned NOT NULL,
  `RESERVED` int(10) unsigned DEFAULT '0',
  `POPULATION` int(10) unsigned DEFAULT '0',
  `TYPE` enum('0','1') NOT NULL,
  `CAP` enum('1','2','4','6') NOT NULL,
  `GENDER` enum('M','F') NOT NULL,
  PRIMARY KEY (`ROOM_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`ROOM_ID`, `BLG_ID`, `BLG_NAME`, `ROOM_NO`, `RESERVED`, `POPULATION`, `TYPE`, `CAP`, `GENDER`) VALUES
(1, 1, 'Saint Mary', 1, 0, 0, '0', '6', 'M'),
(2, 1, 'Saint Mary', 2, 0, 0, '0', '6', 'M'),
(3, 1, 'Saint Mary', 3, 0, 0, '0', '6', 'M'),
(4, 1, 'Saint Mary', 4, 0, 0, '0', '6', 'M'),
(5, 1, 'Saint Mary', 5, 0, 0, '0', '6', 'M'),
(6, 1, 'Saint Mary', 6, 0, 0, '0', '6', 'M'),
(7, 1, 'Saint Mary', 7, 0, 0, '0', '6', 'M'),
(8, 1, 'Saint Mary', 8, 0, 0, '0', '6', 'M'),
(9, 1, 'Saint Mary', 9, 0, 0, '0', '6', 'M'),
(10, 1, 'Saint Mary', 10, 0, 0, '0', '6', 'M'),
(11, 1, 'Saint Mary', 11, 0, 0, '1', '6', 'M'),
(12, 2, 'Saint Joseph', 1, 0, 0, '0', '6', 'M'),
(13, 2, 'Saint Joseph', 2, 0, 0, '0', '6', 'M'),
(14, 2, 'Saint Joseph', 3, 0, 0, '0', '6', 'M'),
(15, 2, 'Saint Joseph', 4, 0, 0, '0', '6', 'M'),
(16, 2, 'Saint Joseph', 5, 0, 0, '0', '6', 'M'),
(17, 2, 'Saint Joseph', 6, 0, 0, '0', '6', 'M'),
(18, 2, 'Saint Joseph', 7, 0, 0, '0', '6', 'M'),
(19, 2, 'Saint Joseph', 8, 0, 0, '0', '6', 'M'),
(20, 2, 'Saint Joseph', 9, 0, 0, '0', '6', 'M'),
(21, 2, 'Saint Joseph', 10, 0, 0, '0', '6', 'M'),
(22, 2, 'Saint Joseph', 11, 0, 0, '1', '6', 'M'),
(23, 3, 'Saint Arnold', 1, 0, 1, '0', '6', 'M'),
(24, 3, 'Saint Arnold', 2, 0, 0, '0', '6', 'M'),
(25, 3, 'Saint Arnold', 3, 0, 0, '0', '6', 'M'),
(26, 3, 'Saint Arnold', 4, 0, 0, '0', '6', 'M'),
(27, 3, 'Saint Arnold', 5, 0, 0, '0', '6', 'M'),
(28, 3, 'Saint Arnold', 6, 0, 0, '0', '6', 'M'),
(29, 3, 'Saint Arnold', 7, 0, 0, '0', '6', 'M'),
(30, 3, 'Saint Arnold', 8, 0, 0, '0', '6', 'M'),
(31, 3, 'Saint Arnold', 9, 0, 0, '0', '6', 'M'),
(32, 3, 'Saint Arnold', 10, 0, 0, '0', '6', 'M'),
(33, 3, 'Saint Arnold', 11, 0, 0, '1', '6', 'M'),
(34, 4, 'Building 1', 1, 0, 0, '0', '1', 'M'),
(35, 4, 'Building 1', 2, 0, 0, '0', '2', 'M'),
(36, 4, 'Building 1', 3, 0, 0, '0', '4', 'M'),
(37, 4, 'Building 1', 4, 0, 0, '0', '6', 'M'),
(38, 4, 'Building 1', 5, 0, 0, '0', '1', 'F'),
(39, 4, 'Building 1', 6, 0, 0, '0', '2', 'F'),
(40, 4, 'Building 1', 7, 0, 0, '0', '4', 'F'),
(41, 4, 'Building 1', 8, 0, 0, '0', '6', 'F'),
(42, 5, 'Building 2', 1, 0, 0, '0', '1', 'M'),
(43, 5, 'Building 2', 2, 0, 0, '0', '2', 'M'),
(44, 5, 'Building 2', 3, 0, 0, '0', '4', 'M'),
(45, 5, 'Building 2', 4, 0, 0, '0', '6', 'M'),
(46, 5, 'Building 2', 5, 0, 0, '0', '1', 'F'),
(47, 5, 'Building 2', 6, 0, 0, '0', '2', 'F'),
(48, 5, 'Building 2', 7, 0, 0, '0', '4', 'F'),
(49, 5, 'Building 2', 8, 0, 0, '0', '6', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `TRANS_DATE` date NOT NULL,
  `ACC_ID` int(10) unsigned NOT NULL,
  `FEE_ID` int(10) unsigned NOT NULL,
  KEY `FINANCE_FK1` (`ACC_ID`),
  KEY `FINANCE_FK2` (`FEE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `ACCOUNT_FK1` FOREIGN KEY (`ROOM`) REFERENCES `room` (`ROOM_ID`),
  ADD CONSTRAINT `ACCOUNT_FK2` FOREIGN KEY (`ACC_ID`) REFERENCES `info` (`INFO_ID`);

--
-- Constraints for table `due`
--
ALTER TABLE `due`
  ADD CONSTRAINT `DUE_FK` FOREIGN KEY (`ACC_ID`) REFERENCES `account` (`ACC_ID`);

--
-- Constraints for table `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `INFO_FK2` FOREIGN KEY (`C_ID`) REFERENCES `course` (`C_ID`);

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `LOGS_FK` FOREIGN KEY (`USER`) REFERENCES `account` (`ACC_ID`);

--
-- Constraints for table `payable`
--
ALTER TABLE `payable`
  ADD CONSTRAINT `PAYABLE_FK` FOREIGN KEY (`FEE_ID`) REFERENCES `fee` (`FEE_ID`),
  ADD CONSTRAINT `PAYABLE_FK2` FOREIGN KEY (`ACC`) REFERENCES `account` (`ACC_ID`);

--
-- Constraints for table `privacy`
--
ALTER TABLE `privacy`
  ADD CONSTRAINT `PRIVACY_FK` FOREIGN KEY (`ACC_ID`) REFERENCES `account` (`ACC_ID`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `RESERVATION_FK1` FOREIGN KEY (`ACC`) REFERENCES `account` (`ACC_ID`),
  ADD CONSTRAINT `RESERVATION_FK2` FOREIGN KEY (`ROOM`) REFERENCES `room` (`ROOM_ID`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `FINANCE_FK1` FOREIGN KEY (`ACC_ID`) REFERENCES `account` (`ACC_ID`),
  ADD CONSTRAINT `FINANCE_FK2` FOREIGN KEY (`FEE_ID`) REFERENCES `fee` (`FEE_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
