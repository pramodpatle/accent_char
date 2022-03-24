-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 08:41 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_accent_char`
--

-- --------------------------------------------------------

--
-- Table structure for table `bdmembers`
--

CREATE TABLE `bdmembers` (
  `id` int(11) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `b_id` int(11) NOT NULL COMMENT 'Photographer id',
  `club_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL COMMENT 'Job Id from Job process table',
  `year` varchar(255) CHARACTER SET latin1 NOT NULL,
  `team_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `story_board_id` int(11) NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `jerseynumber` varchar(255) CHARACTER SET latin1 NOT NULL COMMENT 'jerseynumber',
  `nick_name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `gender` char(1) CHARACTER SET latin1 DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gr_year` int(50) DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cell_phone` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `home_phone` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `address1` text CHARACTER SET latin1,
  `address2` text CHARACTER SET latin1,
  `city` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `zip` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `uid` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'unique identifier for each player',
  `qrcode` varchar(255) CHARACTER SET latin1 NOT NULL COMMENT 'QRCode (playersID-teamId-Year-ClubId) combination',
  `parent_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `age` int(3) DEFAULT NULL,
  `grade` varchar(255) CHARACTER SET latin1 NOT NULL,
  `coach_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `height` varchar(255) CHARACTER SET latin1 NOT NULL,
  `heightinches` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `weight` varchar(255) CHARACTER SET latin1 NOT NULL,
  `position` varchar(255) CHARACTER SET latin1 NOT NULL,
  `favorite_pro` varchar(255) CHARACTER SET latin1 NOT NULL,
  `baseball_stat` text CHARACTER SET latin1 NOT NULL,
  `transactionid` varchar(50) CHARACTER SET latin1 DEFAULT NULL COMMENT 'Transaction code use as a reffrence of updated record by PDR ',
  `coach` char(1) CHARACTER SET latin1 NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Players Listing';

--
-- Dumping data for table `bdmembers`
--

INSERT INTO `bdmembers` (`id`, `sortorder`, `b_id`, `club_id`, `job_id`, `year`, `team_id`, `position_id`, `story_board_id`, `firstname`, `lastname`, `jerseynumber`, `nick_name`, `gender`, `dob`, `gr_year`, `email`, `cell_phone`, `home_phone`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `uid`, `qrcode`, `parent_name`, `age`, `grade`, `coach_name`, `height`, `heightinches`, `weight`, `position`, `favorite_pro`, `baseball_stat`, `transactionid`, `coach`) VALUES
(2, 0, 0, 0, 0, '', 0, 0, 0, 'ram', 'naresh', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', '', NULL, 'N'),
(9, 0, 266, 0, 0, '', 0, 0, 0, 'prakash', 'patle', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', '', NULL, 'N'),
(16, 0, 266, 0, 0, '', 0, 0, 0, 'PeÃŒÂrez-MeÃŒÂndez', 'Ja''laya', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', '', NULL, 'N'),
(11, 0, 266, 0, 0, '', 0, 0, 0, 'pra''kash', 'p''atle', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', '', NULL, 'N'),
(12, 0, 266, 0, 0, '', 0, 0, 0, 'pr‘agopal', 'pâ€˜tlekrishn"a', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', '', NULL, 'N'),
(13, 0, 266, 0, 0, '', 0, 0, 0, 'Ã£Ã¹ÃºÃ»Ã™', 'pafÃ£tle', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', '', NULL, 'N'),
(14, 0, 266, 0, 0, '', 0, 0, 0, 'pradiâ€˜p', 'kâ€˜rish"na', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', '', NULL, 'N'),
(15, 0, 266, 0, 0, '', 0, 0, 0, 'pr"agopal', 'pâ€˜tlekrishn', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', '', NULL, 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bdmembers`
--
ALTER TABLE `bdmembers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `qrcode` (`qrcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bdmembers`
--
ALTER TABLE `bdmembers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
