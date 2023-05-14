-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 14, 2023 at 10:54 AM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Database: `notification_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `rank_data`
--

DROP TABLE IF EXISTS `rank_data`;
CREATE TABLE IF NOT EXISTS `rank_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_value` double(15,2) NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rank_data`
--

INSERT INTO `rank_data` (`id`, `rank_value`, `rank`) VALUES
(1, 10.00, 1),
(2, 18.00, 2),
(3, 20.00, 3);
COMMIT;
