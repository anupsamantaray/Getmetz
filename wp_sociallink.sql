-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2016 at 10:40 AM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wp_getmedz`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_sociallink`
--

DROP TABLE IF EXISTS `wp_sociallink`;
CREATE TABLE IF NOT EXISTS `wp_sociallink` (
  `image_id` int(22) NOT NULL AUTO_INCREMENT,
  `image_title` varchar(255) NOT NULL,
  `image_mouse_over` varchar(255) NOT NULL,
  `image_link` varchar(255) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `wp_sociallink`
--

INSERT INTO `wp_sociallink` (`image_id`, `image_title`, `image_mouse_over`, `image_link`) VALUES
(1, 'Facebook', '1458970023fb.png', 'www.facebook.com'),
(3, 'Google Plus', '1458970160google.png', 'www.google.com'),
(4, 'Mail ', '1458970220mail.png', 'www.mail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
