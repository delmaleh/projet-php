-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2016 at 08:46 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpzag_demos`
--

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `label`, `link`, `parent`, `sort`) VALUES
(1, 'PHP', '#', 0, 0),
(2, 'Tutorials', '#', 1, NULL),
(3, 'Scripts', '#', 1, NULL),
(4, 'Arrays', '#', 2, NULL),
(5, 'Operators', '#', 2, NULL),
(6, 'Arithmetic operators', '#', 5, NULL),
(7, 'Assignment operators', '$', 5, NULL),
(8, 'Java', '#', 0, NULL),
(9, 'Tutorials', '', 8, NULL),
(10, 'Programs', '', 8, NULL),
(11, 'JavaScript', '#', 0, NULL),
(12, 'MySQL', '#', 0, NULL),
(13, 'CSS', '', 0, NULL),
(14, 'Tutorials', '', 13, NULL),
(15, 'Servlet', '', 9, NULL),
(16, 'JSP', '', 9, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
