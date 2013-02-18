-- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2013 at 07:33 PM
-- Server version: 5.5.30-log
-- PHP Version: 5.4.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gamersgate`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `computer` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `starttime` varchar(50) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `computer`, `user`, `starttime`, `time`) VALUES
(1, 1, 1, '2013-02-18 21:25:56', 2),
(2, 0, 2, '2013-03-22 23:14:33', 3),
(3, 1, 2, '2013-05-25 13:33:52', 2);

-- --------------------------------------------------------

--
-- Table structure for table `buylog`
--

CREATE TABLE IF NOT EXISTS `buylog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `employee` int(11) DEFAULT NULL,
  `old_amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `buylog`
--

INSERT INTO `buylog` (`id`, `user`, `amount`, `employee`, `old_amount`) VALUES
(1, 1, 1, 1, 1),
(2, 2, 1, 1, 1),
(3, 2, 1338, 1, 1),
(4, 2, 2675, 1, 1338);

-- --------------------------------------------------------

--
-- Table structure for table `computer`
--

CREATE TABLE IF NOT EXISTS `computer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `computer`
--

INSERT INTO `computer` (`id`, `name`, `x`, `y`) VALUES
(1, 'Computer1', 80, 150),
(2, 'Computer2', 130, 150),
(3, 'Computer 3', 180, 150),
(4, 'Computer 4', 230, 150);

-- --------------------------------------------------------

--
-- Table structure for table `computerlog`
--

CREATE TABLE IF NOT EXISTS `computerlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `computer` int(11) NOT NULL,
  `starttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `endtime` varchar(50) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `computerlog`
--

INSERT INTO `computerlog` (`id`, `computer`, `starttime`, `endtime`, `user`) VALUES
(1, 1, '2013-02-18 12:25:00', '2013-02-18 15:25:00', 1),
(2, 0, '2013-02-20 12:25:27', '2013-02-20 18:25:27', 1),
(3, 1, '2013-02-18 14:25:56', '2013-02-18 20:25:56', 2),
(4, 1, '2013-02-21 09:39:34', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `username`, `password`, `name`) VALUES
(1, 'zmorf', '2c7de60112329be5cb375bc4016f1d22', 'Andreas');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `starttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `endtime` varchar(50) DEFAULT NULL,
  `employee` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `starttime`, `endtime`, `employee`) VALUES
(1, '2013-02-18 17:39:08', '2013-02-18 23:33:33', 1),
(2, '2013-02-18 17:42:52', '2013-02-18 18:52:57', 1),
(3, '2013-02-18 17:47:17', '2013-02-18 18:52:57', 1),
(4, '2013-02-18 17:50:08', '2013-02-18 18:52:57', 1),
(5, '2013-02-18 17:51:36', '2013-02-18 18:52:57', 1),
(6, '2013-02-18 17:54:59', '2013-02-18 18:55:03', 1),
(7, '2013-02-18 17:56:55', '2013-02-18 18:56:56', 1),
(8, '2013-02-18 19:08:40', '2013-02-18 20:11:36', 1),
(9, '2013-02-18 19:11:40', '2013-02-18 20:12:38', 1),
(10, '2013-02-18 19:14:04', '2013-02-18 20:14:57', 1),
(11, '2013-02-18 19:14:59', '2013-02-18 20:22:48', 1),
(12, '2013-02-18 19:23:24', '2013-02-18 20:23:52', 1),
(13, '2013-02-18 19:23:54', '2013-02-18 20:24:50', 1),
(14, '2013-02-18 19:24:52', '2013-02-18 20:25:38', 1),
(15, '2013-02-18 19:25:39', '2013-02-18 20:27:51', 1),
(16, '2013-02-18 19:31:12', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `playTime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `playTime`) VALUES
(1, 'kalle', 'c16e24898200c27d89cd30e9abd51984', 1),
(2, 'stefan', '2e970e822e1a8834203d06abb60f59ec', 2675);

--
-- Triggers `user`
--
DROP TRIGGER IF EXISTS `buy_log_trigger`;
DELIMITER //
CREATE TRIGGER `buy_log_trigger` AFTER UPDATE ON `user`
 FOR EACH ROW INSERT INTO buylog(user,amount,old_amount) VALUES(NEW.id, NEW.playTime, OLD.playTime)
//
DELIMITER ;
