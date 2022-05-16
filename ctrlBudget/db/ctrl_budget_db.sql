-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 01, 2021 at 03:03 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ctrl_budget_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

DROP TABLE IF EXISTS `expense`;
CREATE TABLE IF NOT EXISTS `expense` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `plan_id` int(12) NOT NULL,
  `title` varchar(255) NOT NULL,
  `eDate` date NOT NULL,
  `person_id` int(12) NOT NULL,
  `amount_spent` float NOT NULL,
  `bill_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plan_id` (`plan_id`),
  KEY `person_id` (`person_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `plan_id`, `title`, `eDate`, `person_id`, `amount_spent`, `bill_path`) VALUES
(1, 1, 'pizza', '2021-07-17', 2, 220, NULL),
(2, 1, 'oats', '2021-07-16', 1, 100, NULL),
(3, 1, 'pav', '2021-07-13', 3, 100, 'img/17-07-2021-1626504576.jpg'),
(4, 1, 'vada', '2021-07-12', 2, 150, NULL),
(5, 6, 'bus ticket', '2021-07-21', 13, 7500, 'img/20-07-2021-1626780254.jpg'),
(6, 11, 'petrol', '2021-07-23', 30, 150, 'img/21-07-2021-1626879503.jpg'),
(7, 11, 'disel', '2021-07-21', 31, 600, NULL),
(8, 15, 'petrol', '2021-07-24', 41, 4500, 'img/22-07-2021-1626964784.jpg'),
(9, 4, 'flsjdlf', '2021-07-30', 9, 450, NULL),
(10, 17, 'petrol', '2021-07-28', 47, 220.6, NULL),
(11, 16, 'petrol', '2021-07-29', 44, 890, 'img/28-07-2021-1627468270.jpg'),
(12, 18, 'petrol', '2021-08-02', 48, 30, 'img/01-08-2021-1627827714.jpg'),
(13, 18, 'diesel', '2021-08-10', 49, 40, NULL),
(14, 18, 'tp', '2021-08-05', 49, 20, NULL),
(15, 14, 't1', '2021-08-27', 38, 6500, 'img/01-08-2021-1627829801.jpg'),
(16, 14, 'jhj', '2021-08-12', 37, 450, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `peoples_in_grp`
--

DROP TABLE IF EXISTS `peoples_in_grp`;
CREATE TABLE IF NOT EXISTS `peoples_in_grp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plan_id` (`plan_id`),
  KEY `person_id` (`person_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peoples_in_grp`
--

INSERT INTO `peoples_in_grp` (`id`, `plan_id`, `person_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(7, 3, 7),
(8, 4, 8),
(9, 4, 9),
(10, 5, 10),
(11, 6, 11),
(12, 6, 12),
(13, 6, 13),
(14, 6, 14),
(15, 6, 15),
(16, 7, 16),
(17, 7, 17),
(18, 7, 18),
(19, 7, 19),
(20, 7, 20),
(21, 8, 21),
(22, 8, 22),
(23, 9, 23),
(24, 9, 24),
(25, 9, 25),
(26, 9, 26),
(27, 9, 27),
(28, 10, 28),
(29, 11, 29),
(30, 11, 30),
(31, 11, 31),
(32, 12, 32),
(33, 12, 33),
(34, 12, 34),
(35, 13, 35),
(36, 13, 36),
(37, 14, 37),
(38, 14, 38),
(39, 14, 39),
(40, 15, 40),
(41, 15, 41),
(42, 15, 42),
(43, 15, 43),
(44, 16, 44),
(45, 16, 45),
(46, 17, 46),
(47, 17, 47),
(48, 18, 48),
(49, 18, 49),
(50, 19, 50);

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

DROP TABLE IF EXISTS `persons`;
CREATE TABLE IF NOT EXISTS `persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`id`, `name`) VALUES
(1, 'abc'),
(2, 'xyz'),
(3, 'cba'),
(4, 'raman'),
(5, 'ajay'),
(6, 'vijay'),
(7, 'ajay'),
(8, 'ravi'),
(9, 'kavi'),
(10, 'kaju'),
(11, 'abc sharma'),
(12, 'bca verma'),
(13, 'HC Verma'),
(14, 'html G'),
(15, 'phpWala Bhai'),
(16, 'abc sharma'),
(17, 'bca verma'),
(18, 'html G'),
(19, 'php bhai'),
(20, 'hc verma'),
(21, 'xyz bhai'),
(22, 'abc don'),
(23, 'abc bhai'),
(24, 'xyz sharma'),
(25, 'bca verma'),
(26, 'ok bhai '),
(27, 'col bhai'),
(28, 'gama bhai'),
(29, 'abc jha'),
(30, 'ajay bhai'),
(31, 'sharam dinesh'),
(32, 'afsdjl'),
(33, 'jfdskjo oj'),
(34, 'pfsdkp pro'),
(35, 'fdsfsfer erefa s'),
(36, 'sfs sdf sdf '),
(37, 'fsf sdf ds'),
(38, 'df sdf dsf '),
(39, 'sdf sd fsdf'),
(40, 'ajay bhai'),
(41, 'vijay sharma'),
(42, 'don bhai'),
(43, 'john doe'),
(44, 'ajay a1'),
(45, 'vijay v1'),
(46, 'abc1'),
(47, 'xyz1'),
(48, 'a1'),
(49, 'b1'),
(50, 'fas');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
CREATE TABLE IF NOT EXISTS `plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `initial_budget` float NOT NULL,
  `peoples_in_grp` int(11) NOT NULL CHECK (`peoples_in_grp` > 0),
  `title` varchar(255) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `initial_budget`, `peoples_in_grp`, `title`, `date_from`, `date_to`, `user_id`) VALUES
(1, 2000, 3, 'demo 3 people', '2021-07-11', '2021-08-01', 2),
(2, 2000, 3, 'demo 2 people', '2021-07-12', '2021-07-31', 2),
(3, 5500, 1, 'goa', '2021-07-13', '2021-09-09', 2),
(4, 6700, 2, 'demo 2 person', '2021-07-13', '2021-10-02', 1),
(5, 7500, 1, 'trip to mumbai', '2021-07-13', '2021-08-23', 2),
(6, 20000, 5, 'Pune Trip', '2021-07-20', '2021-08-05', 4),
(7, 10000, 5, 'pune return trip', '2021-08-05', '2021-08-31', 4),
(8, 500, 2, 'pani puri', '2021-07-20', '2021-07-23', 4),
(9, 40000, 5, 'mumbai trip', '2021-07-21', '2021-08-20', 3),
(10, 1000, 1, 'dumas', '2021-07-21', '2021-09-01', 3),
(11, 5000, 3, 'goa', '2021-07-21', '2021-08-26', 5),
(12, 5000, 3, 'trip1', '2021-07-17', '2021-09-03', 1),
(13, 6000, 2, 'sfasad', '2021-07-16', '2021-07-31', 1),
(14, 6500, 3, 'fsdfds fsd', '2021-07-16', '2021-08-27', 1),
(15, 14000, 4, 'trip 2 mumbai', '2021-07-21', '2021-08-27', 6),
(16, 12001, 2, 'dhananjay 1', '2021-07-28', '2021-08-02', 7),
(17, 13000.5, 2, 'd2', '2021-07-28', '2021-07-31', 7),
(18, 70, 2, 'mumbai to goa', '2021-08-01', '2021-09-01', 9),
(19, 60, 1, 'ex', '2021-08-06', '2021-08-17', 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`) VALUES
(1, 'jay', 'jay@gmail.com', '96e79218965eb72c92a549dd5a330112', '8888888888'),
(2, 'john doe', 'john@gmail.com', 'e3ceb5881a0a1fdaad01296d7554868d', '7878787878'),
(3, 'ajay', 'ajay@gmail.com', '96e79218965eb72c92a549dd5a330112', '6545874521'),
(4, 'ajay sharma', 'ajay@ymail.com', 'e3ceb5881a0a1fdaad01296d7554868d', '6589658965'),
(5, 'dhananjay', 'dhananjaythomble@gmail.com', '3230b8a7ec31386ab88d98e06cc29e9b', '6985478541'),
(6, 'user a', 'user1@gmail.com', '96e79218965eb72c92a549dd5a330112', '6985478547'),
(7, 'dhananjay t', 'dhananjay@gmail.com', 'c92b51b2f4d93d4e1081670bd9273402', '2365478569'),
(8, 'help', 'help@gmail.com', 'a8399d56ecd4074c08f490d0b545c0e1', '6854785412'),
(9, 'abc', 'abc@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '8547856985');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
