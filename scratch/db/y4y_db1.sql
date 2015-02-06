-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2015 at 10:21 PM
-- Server version: 5.6.22
-- PHP Version: 5.5.14

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
  `id` int(16) NOT NULL,
  `event_id` int(16) NOT NULL,
  `positions` int(16) NOT NULL DEFAULT '1',
  `user` int(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event_bookings`
--

INSERT INTO `tbl_event_bookings` (`id`, `event_id`, `positions`, `user`) VALUES
(1, 7, 1, 1),
(2, 7, 1, 1),
(3, 7, 1, 1),
(9, 8, 1, 1),
(10, 8, 1, 1),
(11, 8, 1, 1),
(12, 8, 1, 1),
(13, 8, 1, 1),
(14, 9, 1, 1),
(15, 8, 1, 1),
(16, 8, 1, 1),
(17, 8, 1, 1),
(18, 8, 1, 1),
(19, 8, 1, 1),
(20, 9, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_calendar`
--

CREATE TABLE IF NOT EXISTS `tbl_event_calendar` (
  `id` bigint(20) NOT NULL,
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
  `max` int(16) NOT NULL DEFAULT '10',
  `type` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event_calendar`
--

INSERT INTO `tbl_event_calendar` (`id`, `title`, `body`, `start_time`, `end_time`, `location`, `modified_by`, `modification_date`, `allDay`, `url`, `className`, `editable`, `startEditable`, `durationEditable`, `rendering`, `overlap`, `source`, `color`, `backgroundColor`, `borderColor`, `textColor`, `max`, `type`) VALUES
(7, 'majwega', '', '2015-02-25T00:00:00-05:00', '2015-02-25T00:00:00-05:00', '', 1, '2015-02-06 15:55:13', 0, '', '', 0, 0, 0, '', 0, '', '#3A87AD', '', '', '', 10, 'SME'),
(8, 'Godfrey', 'erwegrwg', '2015-02-27T04:30:00-05:00', '2015-02-27T05:15:00-05:00', 'ewrweg', 1, '2015-02-06 15:56:50', 0, '', '', 0, 0, 0, '', 0, '', '#3A87AD', '', '', '', 10, 'SME'),
(9, '', '', '2015-02-26T00:00:00-05:00', '2015-02-26T00:00:00-05:00', '', 1, '2015-02-02 16:22:09', 0, '', '', 0, 0, 0, '', 0, '', '#3A87AD', '', '', '', 10, 'SME'),
(10, '', '', '2015-02-25T00:00:00-05:00', '2015-02-25T00:00:00-05:00', '', 1, '2015-02-02 16:22:11', 1, '', '', 0, 0, 0, '', 0, '', '#3A87AD', '', '', '', 10, 'webinar'),
(12, '', 'sds asdsaff', '2015-02-12T14:42:35-05:00', '2015-02-11T11:47:49-05:00', '', 1, '2015-02-02 17:00:27', 1, '', '', 0, 0, 0, '', 0, '', '#3A87AD', '', '', '', 10, 'webinar'),
(13, '', '', '2015-02-02T00:00:00-0500', '2015-02-02T13:23:27-0500', '', 1, '2015-02-02 17:10:36', 1, '', '', 0, 0, 0, '', 0, '', '#ff9f89 ', '', '', '', 10, 'webinar'),
(14, '', '', '2015-02-02T00:00:00-0500', '2015-02-02T00:00:00-0500', '', 1, '2015-02-02 17:10:38', 0, '', '', 0, 0, 0, '', 0, '', '#3A87AD', '', '', '', 10, 'SME'),
(16, 's', 'dssd', '2015-02-03T00:00:00-0500', '2015-02-26T00:00:00-0500', 'sd', 1, '2015-02-03 08:59:32', 1, '', '', 0, 0, 0, '', 0, '', '#ff9f89 ', '', '', '', 232, 'webinar'),
(17, 's', 'dssd', '2015-02-03T00:00:00-0500', '2015-02-26T00:00:00-0500', 'sd', 1, '2015-02-03 09:36:53', 1, '', '', 0, 0, 0, '', 0, '', '#ff9f89 ', '', '', '', 232, 'webinar'),
(18, 's', 'dssd', '2015-02-03T00:00:00-0500', '2015-02-26T00:00:00-0500', 'sd', 1, '2015-02-03 09:37:14', 1, '', '', 0, 0, 0, '', 0, '', '#ff9f89 ', '', '', '', 232, 'webinar'),
(19, 's', 'dssd', '2015-02-03T00:00:00-0500', '2015-02-26T00:00:00-0500', 'sd', 1, '2015-02-03 09:37:41', 1, '', '', 0, 0, 0, '', 0, '', '#ff9f89 ', '', '', '', 23, 'webinar'),
(20, 'sss', 'dssd', '2015-02-03T00:00:00-0500', '2015-02-26T00:00:00-0500', 'sd', 1, '2015-02-03 09:38:29', 1, '', '', 0, 0, 0, '', 0, '', '#ff9f89 ', '', '', '', 23, 'webinar');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_waiting_list`
--

CREATE TABLE IF NOT EXISTS `tbl_event_waiting_list` (
  `id` int(16) NOT NULL,
  `event_id` int(16) NOT NULL,
  `user_id` int(16) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event_waiting_list`
--

INSERT INTO `tbl_event_waiting_list` (`id`, `event_id`, `user_id`, `added`) VALUES
(1, 21, 8, '2015-02-04 21:54:22'),
(2, 8, 1, '2015-02-04 22:03:48'),
(3, 8, 1, '2015-02-04 22:04:46'),
(4, 8, 1, '2015-02-04 22:05:15'),
(5, 8, 1, '2015-02-04 22:05:28'),
(6, 8, 1, '2015-02-04 22:09:32'),
(7, 8, 1, '2015-02-04 22:10:49'),
(8, 8, 1, '2015-02-05 14:49:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_event_bookings`
--
ALTER TABLE `tbl_event_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_event_calendar`
--
ALTER TABLE `tbl_event_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_event_waiting_list`
--
ALTER TABLE `tbl_event_waiting_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_event_bookings`
--
ALTER TABLE `tbl_event_bookings`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tbl_event_calendar`
--
ALTER TABLE `tbl_event_calendar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `tbl_event_waiting_list`
--
ALTER TABLE `tbl_event_waiting_list`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
