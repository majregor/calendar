-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 02, 2015 at 10:13 PM
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
  `textColor` varchar(32) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event_calendar`
--

INSERT INTO `tbl_event_calendar` (`id`, `title`, `body`, `start_time`, `end_time`, `location`, `modified_by`, `modification_date`, `allDay`, `url`, `className`, `editable`, `startEditable`, `durationEditable`, `rendering`, `overlap`, `source`, `color`, `backgroundColor`, `borderColor`, `textColor`) VALUES
(7, '', '', '2015-02-04T00:00:00-05:00', '2015-02-04T00:00:00-05:00', '', 1, '2015-02-02 15:34:48', 0, '', '', 0, 0, 0, '', 0, '', '', '', '', ''),
(8, 'jkj', 'erwegrwg', '2015-02-27T04:30:00-05:00', '2015-02-27T05:15:00-05:00', 'ewrweg', 1, '2015-02-02 15:35:16', 0, '', '', 0, 0, 0, '', 0, '', '', '', '', ''),
(9, '', '', '2015-02-26T00:00:00-05:00', '2015-02-26T00:00:00-05:00', '', 1, '2015-02-02 16:22:09', 0, '', '', 0, 0, 0, '', 0, '', '', '', '', ''),
(10, '', '', '2015-02-25T00:00:00-05:00', '2015-02-25T00:00:00-05:00', '', 1, '2015-02-02 16:22:11', 0, '', '', 0, 0, 0, '', 0, '', '', '', '', ''),
(11, 'makino', 'qwqwqw', '2015-02-17T10:32:00-05:00', '2015-02-18T16:40:43-05:00', 'ww', 1, '2015-02-02 16:38:55', 0, '', '', 0, 0, 0, '', 0, '', '', '', '', ''),
(12, '', 'sds asdsaff', '2015-02-12T14:42:35-05:00', '2015-02-11T11:47:49-05:00', '', 1, '2015-02-02 17:00:27', 0, '', '', 0, 0, 0, '', 0, '', '', '', '', ''),
(13, '', '', '2015-02-02T00:00:00-0500', '2015-02-02T13:23:27-0500', '', 1, '2015-02-02 17:10:36', 0, '', '', 0, 0, 0, '', 0, '', '', '', '', ''),
(14, '', '', '2015-02-02T00:00:00-0500', '2015-02-02T00:00:00-0500', '', 1, '2015-02-02 17:10:38', 0, '', '', 0, 0, 0, '', 0, '', '', '', '', ''),
(15, '', 'qwqwqw', '2015-02-02T12:30:26-0500', '2015-02-11T18:33:37-0500', 'asfasfa', 1, '2015-02-02 17:12:14', 0, '', '', 0, 0, 0, '', 0, '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_event_calendar`
--
ALTER TABLE `tbl_event_calendar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_event_calendar`
--
ALTER TABLE `tbl_event_calendar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
