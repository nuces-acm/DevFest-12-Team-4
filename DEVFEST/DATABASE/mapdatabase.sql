-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2012 at 08:51 AM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mapdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `dmarkers`
--

CREATE TABLE IF NOT EXISTS `dmarkers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `cnic` varchar(20) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` float(20,12) NOT NULL,
  `lng` float(20,12) NOT NULL,
  `specialization` varchar(60) NOT NULL,
  `contact` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dmarkers`
--

INSERT INTO `dmarkers` (`id`, `name`, `cnic`, `address`, `lat`, `lng`, `specialization`, `contact`) VALUES
(2, 'Dr. devfest', '123456-123-4', 'Milaad street, Lahore Pakistan', 32.482170104980, 74.302787780762, '24 hour tortureing', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `userId` int(5) NOT NULL AUTO_INCREMENT,
  `userName` varchar(26) NOT NULL,
  `userPassword` varchar(26) NOT NULL,
  `key` varchar(4) NOT NULL,
  `permissions` varchar(7) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `key` (`key`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11113 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userId`, `userName`, `userPassword`, `key`, `permissions`) VALUES
(1, 'admin', 'admin', 'qw23', 'power');

-- --------------------------------------------------------

--
-- Table structure for table `pmarkers`
--

CREATE TABLE IF NOT EXISTS `pmarkers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `cnic` varchar(20) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` float(12,6) NOT NULL,
  `lng` float(12,6) NOT NULL,
  `disease` varchar(30) NOT NULL,
  `contact` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `pmarkers`
--

INSERT INTO `pmarkers` (`id`, `name`, `cnic`, `address`, `lat`, `lng`, `disease`, `contact`) VALUES
(48, 'eastren college', '34603-5733454-7', 'Eastern College, Lahore, Pakistan', 31.486191, 74.305542, 'jmga', '02375'),
(46, 'fast nu', '34603-5733454-7', 'Girls school, Lahore, Pakistan', 34.479279, 74.303482, 'dengue', '02375'),
(43, 'fast nu', '34603-5733454-7', 'Lahore, Pakistan', 33.545052, 74.340683, 'dengue', '02375'),
(44, 'fast nu', '34603-5733454-7', 'Milaad St, Lahore, Pakistan', 32.482170, 74.302788, 'dengue', '02375'),
(42, 'fast nu', '34603-5733454-7', 'Lahore, Pakistan', 31.545050, 74.340683, 'dengue', '02375'),
(49, 'eastren college', '34603-5733454-7', 'Eastern College, Lahore, Pakistan', 31.486191, 74.305542, 'dengue', '02375'),
(51, 'eastren college', '34603-5733454-7', 'Eastern College, Lahore, Pakistan', 31.486191, 74.305542, 'dengue', '02375');
