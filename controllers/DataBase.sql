-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql105.epizy.com
-- Generation Time: Apr 03, 2018 at 11:32 AM
-- Server version: 5.6.35-81.0
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epiz_20545631_lf`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `x` varchar(255) NOT NULL,
  `y` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `desc` longtext NOT NULL,
  `time` varchar(255) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `stdName` varchar(255) NOT NULL,
  `stdEmail` varchar(255) NOT NULL,
  `stdRoll` varchar(255) NOT NULL,
  `stdPhone` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `x`, `y`, `item`, `desc`, `time`, `item_type`, `link`, `img`, `stdName`, `stdEmail`, `stdRoll`, `stdPhone`) VALUES
(20, '28.72136377810979', '77.14113056659698', 'Key', 'lol loololol loll', 'Block A 3rd Floor  303', 'found', '#', 'controllers/uploads/2017_08_16_12_34_29pm_key.jpg', 'Srijit S Madhavan', '08729802016@vips.edu', '08729802016', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `reqId` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `roll` varchar(255) NOT NULL,
  `phn` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
