-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2015 at 08:16 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `etest`
--

CREATE TABLE IF NOT EXISTS `etest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `question` text NOT NULL,
  `options` text NOT NULL,
  `answer` text NOT NULL,
  `sbj_id` int(11) NOT NULL,
  `qimage` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `etest_durations`
--

CREATE TABLE IF NOT EXISTS `etest_durations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sbj_id` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `no_q` int(11) NOT NULL,
  `no_p` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_pro`
--

CREATE TABLE IF NOT EXISTS `exam_pro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `question` text NOT NULL,
  `options` text NOT NULL,
  `answer` text NOT NULL,
  `sbj_id` int(11) NOT NULL,
  `qimage` text NOT NULL,
  `choosen_ans` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` text NOT NULL,
  `slevel` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level`, `slevel`) VALUES
(1, 'J.S.S. 1', 'First term'),
(2, 'J.S.S. 1', 'Second term'),
(3, 'J.S.S. 1', 'Third term'),
(4, 'J.S.S. 2', 'First term'),
(5, 'J.S.S. 2', 'Second term'),
(6, 'J.S.S. 2', 'Third term'),
(7, 'J.S.S. 3', 'First term'),
(8, 'J.S.S. 3', 'Second term'),
(9, 'J.S.S. 3', 'Third term'),
(10, 'S.S.S. 1', 'First term'),
(11, 'S.S.S. 1', 'Second term'),
(12, 'S.S.S. 1', 'Third term'),
(13, 'S.S.S. 2', 'First term'),
(14, 'S.S.S. 2', 'Second term'),
(15, 'S.S.S. 2', 'Third term'),
(16, 'S.S.S. 3', 'First term'),
(17, 'S.S.S. 3', 'Second term'),
(18, 'S.S.S. 3', 'Third term');

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE IF NOT EXISTS `library` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sbj_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `isbn` varchar(100) NOT NULL,
  `level_id` varchar(50) NOT NULL,
  `uid` varchar(115) NOT NULL,
  `pdf` text NOT NULL,
  `date` varchar(40) NOT NULL,
  `cat` text NOT NULL,
  `author` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `performancetab`
--

CREATE TABLE IF NOT EXISTS `performancetab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ifr` text NOT NULL,
  `tg` text NOT NULL,
  `st` int(11) NOT NULL,
  `lm` varchar(78) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `performancetab`
--

INSERT INTO `performancetab` (`id`, `ifr`, `tg`, `st`, `lm`) VALUES
(1, '1436873630', '1447504430', 1, '1437371951');

-- --------------------------------------------------------

--
-- Table structure for table `rec`
--

CREATE TABLE IF NOT EXISTS `rec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `sh` text NOT NULL,
  `encoded` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sc`
--

CREATE TABLE IF NOT EXISTS `sc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `sbj_id` int(11) NOT NULL,
  `score` varchar(11) NOT NULL,
  `pri` int(11) NOT NULL,
  `cat` text NOT NULL,
  `etest` text NOT NULL,
  `date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE IF NOT EXISTS `school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `address` varchar(45) NOT NULL,
  `stel` varchar(15) NOT NULL,
  `pr_name` text NOT NULL,
  `pr_email` text NOT NULL,
  `current_term` text NOT NULL,
  `term_duration` int(11) NOT NULL,
  `bk` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stud_exam_status`
--

CREATE TABLE IF NOT EXISTS `stud_exam_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_id` int(11) NOT NULL,
  `sbj_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `report` text NOT NULL,
  `examstart` text NOT NULL,
  `lastmin` text NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stud_repository`
--

CREATE TABLE IF NOT EXISTS `stud_repository` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `sbj_id` int(11) NOT NULL,
  `score` varchar(11) NOT NULL,
  `pri` int(11) NOT NULL,
  `cat` text NOT NULL,
  `etest` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `stud_sbj_profile`
--

CREATE TABLE IF NOT EXISTS `stud_sbj_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `sbj_id` int(11) NOT NULL,
  `score` varchar(11) NOT NULL,
  `pri` int(11) NOT NULL,
  `cat` text NOT NULL,
  `etest` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sbj` text NOT NULL,
  `level` int(11) NOT NULL,
  `overview` text NOT NULL,
  `material` text NOT NULL,
  `uid` int(11) NOT NULL,
  `cat` text NOT NULL,
  `etest` varchar(15) NOT NULL,
  `pri` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tm_test`
--

CREATE TABLE IF NOT EXISTS `tm_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `question` text NOT NULL,
  `options` text NOT NULL,
  `answer` text NOT NULL,
  `sbj_id` int(11) NOT NULL,
  `qimage` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE IF NOT EXISTS `tutor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `sk_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`id`, `uid`, `sk_id`) VALUES
(2, 37, 1),
(3, 38, 1),
(4, 39, 1),
(5, 40, 1),
(6, 0, 1),
(7, 0, 1),
(8, 44, 1),
(9, 51, 3),
(10, 52, 3),
(11, 53, 3),
(12, 54, 3),
(13, 64, 3),
(14, 65, 3),
(15, 66, 3),
(16, 68, 1),
(17, 69, 1),
(18, 70, 1),
(19, 74, 3),
(20, 98, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` text NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `pix` text NOT NULL,
  `admissionyear` text NOT NULL,
  `school` text NOT NULL,
  `level_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `sex` text NOT NULL,
  `bk` enum('0','1') NOT NULL,
  `cat` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `pix`, `admissionyear`, `school`, `level_id`, `score`, `sex`, `bk`, `cat`) VALUES
(1, 'Registrar', 'Akinsuyi Grate Wilson', 'cliqs@403.com', 'cbaac6303676c08e8dfa39d51d0d09e947878ad5', '1274882akinsuyi.jpg', '', '', 0, 0, 'Male', '0', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
