-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2016 at 01:05 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `mac` varchar(20) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userStatus` enum('Y','N') NOT NULL DEFAULT 'N',
  `userAddress` varchar(100) DEFAULT NULL,
  `tokenCode` varchar(100) NOT NULL,
  `tbl_TempSet` varchar(100) DEFAULT NULL,
  `tbl_RoomTemp` varchar(100) DEFAULT NULL,
  `timestamp_value` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userEmail` (`userEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

//+----+-----------------+--------+--------+--------+-------------+---------------------+
//| id | name            | L_temp | C_temp | H_temp | room_status | timestamp_value     |
//+----+-----------------+--------+--------+--------+-------------+---------------------+
//|  1 | 파더            |     27 |   28.5 |     27 | 1           | 2017-01-28 23:46:36 |
CREATE TABLE IF NOT EXISTS `tbl_temperature` (
  `id` INT UNSIGNED NOT NULL,
  `numSensor` VARCHAR(16) DEFAULT NULL,
  `roomName` VARCHAR(16) DEFAULT NULL,
  `L_temp` float(4) DEFAULT NULL,
  `C_temp` float(4) DEFAULT NULL,
  `H_temp` float(4) DEFAULT NULL,
  `roomStatus` float(4) DEFAULT NULL,
  `timestamp_value` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;


//+----+---------------------+---------------+-----------------+----------------+
//| id | timestamp_value     | current_temps | sensor_name     | current_status |
//+----+---------------------+---------------+-----------------+----------------+
//|  0 | 2017-01-28 22:21:49 |          27.4 | 28-051621306fff | 1              |
//+----+---------------------+---------------+-----------------+----------------+
DROP TABLE IF EXISTS `tbl_room_temps`;
CREATE TABLE `tbl_room_temps` (
  `id` INT UNSIGNED NOT NULL,
  `timestamp_value` datetime DEFAULT NULL,
  `current_temps` float(4) DEFAULT NULL,
  `sensor_name` VARCHAR(40) DEFAULT NULL,
  `current_status` float(4) DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

