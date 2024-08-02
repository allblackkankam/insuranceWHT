-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 02, 2024 at 05:29 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insurancedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int NOT NULL AUTO_INCREMENT,
  `facility_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `facility_contact` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `facility_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `logo` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `secretkey` varchar(255) NOT NULL DEFAULT '',
  `facility_status` tinyint(1) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL DEFAULT '',
  `location` varchar(255) NOT NULL DEFAULT '',
  `date` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `facility_name`, `email`, `facility_contact`, `facility_id`, `logo`, `secretkey`, `facility_status`, `address`, `location`, `date`) VALUES
(11, 'Man King', 'man@gmail.com', 'maning', 'C695580734399', NULL, '171091910121383', 0, '', '', '2024-03-20 07:18:21');

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

DROP TABLE IF EXISTS `entry`;
CREATE TABLE IF NOT EXISTS `entry` (
  `id` int NOT NULL AUTO_INCREMENT,
  `facility_id` varchar(50) NOT NULL DEFAULT '',
  `user_id` varchar(50) NOT NULL DEFAULT '',
  `entry_id` varchar(20) NOT NULL DEFAULT '',
  `insurance_code` varchar(20) NOT NULL DEFAULT '',
  `amount_drugs` varchar(20) NOT NULL DEFAULT '0',
  `amount_services` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `adjustment_services` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `adjustment_drugs` varchar(20) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `drugs_paid` varchar(20) NOT NULL DEFAULT '0',
  `services_paid` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `tax_paid` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `tax` tinyint(1) NOT NULL DEFAULT '0',
  `balance` varchar(20) NOT NULL DEFAULT '',
  `in_entry` tinyint(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entry`
--

INSERT INTO `entry` (`id`, `facility_id`, `user_id`, `entry_id`, `insurance_code`, `amount_drugs`, `amount_services`, `adjustment_services`, `adjustment_drugs`, `type`, `drugs_paid`, `services_paid`, `tax_paid`, `tax`, `balance`, `in_entry`, `date`) VALUES
(31, 'C695580734399', 'U847454998629', '202401', '7125984', '0', '200', '0', ' 0', 0, '0', '0', '0', 0, '', 0, '2024-07-31 22:20:24'),
(30, 'C695580734399', 'U847454998629', '202407', '4354114', '0', '0', '0', '0', 1, '0', '500', '0', 0, '', 0, '2024-07-31 22:17:24'),
(27, 'C695580734399', 'U847454998629', '202407', '7125984', '0', '0', '0', '0', 1, '0', '4000', '300', 0, '', 0, '2024-07-31 14:58:32'),
(28, 'C695580734399', 'U847454998629', '202407', '4354114', '1000', '1000', '200', '200', 0, '0', '0', '0', 0, '', 0, '2024-07-31 22:13:07'),
(29, 'C695580734399', 'U847454998629', '202407', '4354114', '0', '0', '0', '0', 1, '300', '500', '30', 0, '', 0, '2024-07-31 22:16:17'),
(26, 'C695580734399', 'U847454998629', '202407', '7125984', '2000', '5000', '300', '300', 0, '0', '0', '0', 0, '', 0, '2024-07-31 14:54:07');

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

DROP TABLE IF EXISTS `insurance`;
CREATE TABLE IF NOT EXISTS `insurance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `facility_id` varchar(200) NOT NULL DEFAULT '',
  `insurance_name` varchar(200) NOT NULL DEFAULT '',
  `insurance_code` varchar(50) NOT NULL DEFAULT '',
  `insurance_status` tinyint(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`id`, `facility_id`, `insurance_name`, `insurance_code`, `insurance_status`, `date`) VALUES
(31, 'C695580734399', 'hgg', '7125984', 0, '2024-05-06 17:37:39'),
(30, 'C695580734399', 'df', '8245991', 2, '2024-05-06 17:09:38'),
(29, 'C695580734399', 'bv', '5111631', 2, '2024-05-06 17:09:32'),
(28, 'C695580734399', 'b', '6893393', 2, '2024-05-06 17:09:25'),
(27, 'C695580734399', 'hg', '4354114', 0, '2024-05-06 17:09:20'),
(26, 'C695580734399', 'asgh', '5047076', 2, '2024-05-06 17:08:54'),
(25, 'C695580734399', 'asdasd zczx', '8579731', 2, '2024-04-28 11:33:06'),
(24, 'C695580734399', 'sadsad', '3879896', 0, '2024-04-28 11:33:03'),
(23, 'C695580734399', 'ddgdffg', '985219', 2, '2024-04-28 11:32:41'),
(20, 'C695580734399', 'ass', '7306465', 2, '2024-04-27 16:36:30'),
(21, 'C695580734399', 'fddfs', '6464027', 0, '2024-04-28 11:32:27'),
(22, 'C695580734399', 'fdsf', '1304015', 0, '2024-04-28 11:32:31'),
(32, 'C695580734399', 'czxcxz', '3188583', 2, '2024-07-29 21:25:05'),
(33, 'C695580734399', 'sasdsa', '1908220', 0, '2024-08-01 07:50:27'),
(34, 'C695580734399', 'AAAAAA', '9450773', 0, '2024-08-01 07:50:34'),
(35, 'C695580734399', 'aaaaaa', '9233150', 0, '2024-08-01 07:51:12'),
(36, 'C695580734399', 'aaaaa', '5881083', 0, '2024-08-01 07:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `facility_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'user',
  `contact` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_pic` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  `user_role` tinyint(1) DEFAULT '0',
  `date` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `facility_id`, `user_id`, `contact`, `user_pic`, `user_status`, `user_role`, `date`) VALUES
(11, 'Man', 'King24', 'man@gmail.com', 'kings', '$2y$10$E2QYWD3AXv2RDvzLvX7iFOgPwv6EsWQl7b.YvQmh67D6N1WM9i3P2', 'C695580734399', 'U847454998629', '0987653452', NULL, 0, 2, '2024-03-20 07:18:21'),
(12, 'sadasd', 'asdasdas', 'man@gmail.com', 'manking', '$2y$10$yvS5ECya1ti0uAOZgDuu7OTleB8RhCa444bsA54JY31CIG.0HNIVa', 'C695580734399', 'U958444780143', '3234234234234', NULL, 0, 2, '2024-04-27 22:04:07'),
(13, 'asdasd', 'asdasd', 'man@gmail.com', 'blackman', '$2y$10$314tk9L8YGqr8f.B2z6UbeTEHcLoF5xB55RkhaZ9xiku4jtm760x.', 'C695580734399', 'U223482252827', '', NULL, 1, 2, '2024-04-27 22:08:08'),
(14, 'asdasdasd', 'asdasdasd', 'man@gmail.com', 'mamama', '$2y$10$3IoBULoX0vVZjZWDO2uiOeJcs3iopYUs7kwdAYKcKkU4pLmfXm4tO', 'C695580734399', 'U362202314556', '5656565', NULL, 0, 3, '2024-04-28 04:13:32'),
(15, 'asdasdas', 'asdasd', 'man@gmail.com', 'rerere', '$2y$10$9TxcCwTXkOC.CtBxIrc39er7vA50gPtGSpPL5eoKUyOzn1kT9KqMO', 'C695580734399', 'U686232282334', '', NULL, 2, 4, '2024-04-28 04:17:08'),
(16, 'asdasd', 'asdasd', 'man@gmail.com', 'kingss', '$2y$10$UlqTBn784cjJRa82e7z0TuN6pWJ3SciPKS3NC0UtaoiX8EbUeUTIy', 'C695580734399', 'U028055548927', '', NULL, 2, 2, '2024-04-28 04:19:28'),
(17, 'sadasd', 'asdasd', 'man@gmail.com', 'kingsss', '$2y$10$PFlVuhrHAh5evgChvjmEPu8mrdmexS.gvRiPaKdZh.63UyrwHbFwe', 'C695580734399', 'U310947164601', '', NULL, 0, 2, '2024-04-28 04:20:29'),
(18, 'Free', 'Mee', 'man@gmail.com', 'mankings', '$2y$10$FOrL5AsUGoGbPzJ7PPPCzODHLfZyWUr33p0MN4L.ghVxECGLYgEiu', 'C695580734399', 'U320480853162', '89789789789789', NULL, 0, 2, '2024-04-28 04:23:35'),
(19, 'asdasdas', 'dasdasd', 'man@gmail.com', 'asasas', '$2y$10$.42vwa9WlxnB/Go7Puj50.KnEPt7A9HJg8m8CpmnbA73QralH4G0m', 'C695580734399', 'U440738612626', '686787867', NULL, 1, 2, '2024-04-28 04:26:09'),
(20, 'sdasdasd', 'asdasdasd', 'man@gmail.com', 'aadsas', '$2y$10$0SIoDXq1ErcmX2.vWkVJpe4CfK0uid7NCAv6Ojsik6eNPumEAb.Pi', 'C695580734399', 'U250187483858', '', NULL, 2, 2, '2024-04-28 04:28:12'),
(21, 'Wee', 'Good', 'man@gmail.com', 'mankingsssssss', '$2y$10$0YBCVsXhPtzPhJp79OGju.0tqsdUQH9S3V.lruqGhAH8HP0kR3qw.', 'C695580734399', 'U246732084579', '1231231231231231', NULL, 0, 2, '2024-04-28 04:29:47'),
(22, 'meeeeee', 'ceeeeeeee', 'man@gmail.com', 'meeecee', '$2y$10$81NOEpVRSYe40ZYy87tuCOco4D0iXdSItpKajw1J2tF/It0T.mQXm', 'C695580734399', 'U600838825728', '3424234234234234', NULL, 0, 4, '2024-04-28 10:52:09');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
