-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 09, 2015 at 07:18 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `y4y_db1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_bookings`
--

CREATE TABLE IF NOT EXISTS `tbl_event_bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(16) NOT NULL,
  `positions` int(16) NOT NULL DEFAULT '1',
  `user` int(16) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `polo_idx` (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_event_bookings`
--

INSERT INTO `tbl_event_bookings` (`id`, `event_id`, `positions`, `user`, `added`) VALUES
(2, 10, 1, 1, '2015-02-09 03:51:32'),
(3, 10, 1, 1, '2015-02-09 03:51:42'),
(4, 10, 1, 1, '2015-02-09 04:34:41'),
(5, 10, 1, 1, '2015-02-09 04:36:15'),
(6, 10, 1, 1, '2015-02-09 04:36:29'),
(7, 10, 1, 1, '2015-02-09 04:38:14'),
(8, 10, 1, 1, '2015-02-09 04:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_calendar`
--

CREATE TABLE IF NOT EXISTS `tbl_event_calendar` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `start_time` varchar(100) NOT NULL,
  `end_time` varchar(100) NOT NULL,
  `location` text NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modification_date` datetime NOT NULL,
  `allDay` tinyint(2) DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `className` varchar(32) DEFAULT NULL,
  `editable` tinyint(2) DEFAULT '0',
  `startEditable` tinyint(2) DEFAULT '0',
  `durationEditable` tinyint(2) DEFAULT '0',
  `rendering` varchar(255) DEFAULT NULL,
  `overlap` tinyint(2) DEFAULT '0',
  `source` varchar(64) DEFAULT NULL,
  `color` varchar(32) DEFAULT NULL,
  `backgroundColor` varchar(32) DEFAULT NULL,
  `borderColor` varchar(32) DEFAULT NULL,
  `textColor` varchar(32) DEFAULT NULL,
  `max` int(16) NOT NULL DEFAULT '1',
  `type` varchar(32) NOT NULL DEFAULT 'default',
  `status` varchar(45) DEFAULT 'open',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event_calendar`
--

INSERT INTO `tbl_event_calendar` (`id`, `title`, `body`, `start_time`, `end_time`, `location`, `modified_by`, `modification_date`, `allDay`, `url`, `className`, `editable`, `startEditable`, `durationEditable`, `rendering`, `overlap`, `source`, `color`, `backgroundColor`, `borderColor`, `textColor`, `max`, `type`, `status`) VALUES
(0, 'sdfs', 'sdfsdf', '2015-02-11T00:00:00-0500', '2015-02-19T00:00:00-0500', 'sdf', 1, '2015-02-07 16:32:12', 0, '', '', 0, 0, 0, '', 0, '', '#3A87AD', '', '', '', 10, 'SME', 'open'),
(8, 'jkj', 'erwegrwg', '2015-02-27T04:30:00-05:00', '2015-02-27T05:15:00-05:00', 'ewrweg', 1, '2015-02-02 15:35:16', 0, '', '', 0, 0, 0, '', 0, '', '', '', '', '', 1, 'default', 'open'),
(9, '', '', '2015-02-26T00:00:00-05:00', '2015-02-26T00:00:00-05:00', 'dss', 1, '2015-02-07 23:21:42', 0, '', '', 0, 0, 0, '', 0, '', '#3A87AD', '', '', '', 1, 'null', 'open'),
(10, '', '', '2015-02-25T00:00:00-05:00', '2015-02-25T00:00:00-05:00', '', 1, '2015-02-02 16:22:11', 0, '', '', 0, 0, 0, '', 0, '', '', '', '', '', 1, 'default', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_waiting_list`
--

CREATE TABLE IF NOT EXISTS `tbl_event_waiting_list` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `event_id` int(16) NOT NULL,
  `user_id` int(16) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `positions` int(16) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_event_bookings`
--
ALTER TABLE `tbl_event_bookings`
  ADD CONSTRAINT `polo` FOREIGN KEY (`event_id`) REFERENCES `tbl_event_calendar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
