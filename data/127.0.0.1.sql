-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2014 at 08:59 AM
-- Server version: 5.5.27-log
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `news`
--
CREATE DATABASE `news` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `news`;

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `folder` varchar(50) NOT NULL,
  `date_creation` date NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `name`, `folder`, `date_creation`, `time_stamp`) VALUES
(1, 'NZ Newspaper', 'nz', '2014-08-17', '2014-08-17 02:06:14'),
(2, 'AU Newspaper', 'au', '2014-08-17', '2014-08-17 02:11:17'),
(3, 'Admin Page', 'admin', '2014-08-17', '2014-08-17 02:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE IF NOT EXISTS `publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_country` varchar(3) NOT NULL,
  `pub_name` varchar(150) NOT NULL,
  `source` varchar(50) NOT NULL,
  `issue` varchar(50) NOT NULL,
  `job_number` varchar(50) NOT NULL,
  `status` varchar(25) NOT NULL,
  `site` varchar(100) NOT NULL,
  `date_creation` date NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `publication`
--

INSERT INTO `publication` (`id`, `state_country`, `pub_name`, `source`, `issue`, `job_number`, `status`, `site`, `date_creation`, `time_stamp`) VALUES
(1, 'NZ', 'PROPERTY PRESS - NORTH SHORE', 'ONLINE', 'THURSDAY', 'OFFLINE', 'ACTIVE', 'http://www.propertypress.co.nz/', '2014-08-18', '2014-08-18 05:54:52'),
(2, 'NZ', 'PROPERTY PRESS - CENTRAL AUCKLAND', 'ONLINE', 'THURSDAY', 'OFFLINE', 'ACTIVE', 'http://www.propertypress.co.nz/', '2014-08-18', '2014-08-18 05:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operator_id` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `access_level` int(1) NOT NULL,
  `date_creation` date NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `operator_id` (`operator_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `operator_id`, `username`, `password`, `firstname`, `lastname`, `access_level`, `date_creation`, `time_stamp`) VALUES
(1, 642, 'DoctoleroS', 'Sunday', 'Sunday', 'Doctolero', 4, '0000-00-00', '0000-00-00 00:00:00'),
(3, 623, 'admin', 'admin', 'admin', 'admin', 4, '2014-08-16', '2014-08-17 05:55:30'),
(4, 642, 'doctoleros', 'sunday', 'Sunday', 'Doctolero', 642, '2014-08-16', '2014-08-17 01:45:52'),
(5, 642, 'doctoleros', 'sunday', 'Sunday', 'Doctolero', 642, '2014-08-16', '2014-08-17 01:52:40');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
