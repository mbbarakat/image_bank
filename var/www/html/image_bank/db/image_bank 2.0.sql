-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2014 at 04:22 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `image_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
`eventid` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `owner` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `useragent` varchar(250) NOT NULL,
  `remotehost` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
`fileid` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(250) NOT NULL,
  `type` varchar(10) NOT NULL,
  `size` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `uploaded` varchar(25) NOT NULL,
  `updated` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`fileid`, `owner`, `title`, `description`, `filename`, `type`, `size`, `width`, `height`, `uploaded`, `updated`) VALUES
(55, 7, 'Some Image Title 2', 'A Title I got to describe some image title2', 'okami-990083.jpg', 'jpg', 320383, 1600, 1000, 'October 07, 2014, 3:05 am', 0),
(56, 7, 'Some Image Title3', 'A Title I got to describe some image title3', 'okami 2.jpg', 'jpg', 1615105, 1600, 999, 'October 07, 2014, 3:10 am', 0),
(57, 7, 'Testing owner field', 'Test Image', 'wallpaper-808979.jpg', 'jpg', 332277, 1920, 1080, 'October 07, 2014, 3:13 am', 0),
(58, 7, 'Some Image Title5', 'A Title I got to describe some image title5', 'Final Fantasy 7.jpg', 'jpg', 168457, 1920, 1080, 'October 07, 2014, 3:13 am', 0),
(59, 7, 'Testing owner field2', 'Test Image2', 'earth_by_kuldarleement.jpg', 'jpg', 1534843, 1920, 1080, 'October 15, 2014, 3:17 am', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `name`, `password`) VALUES
(7, 'peter', 'Peter Pan', '7188b62868227e0315e4b2b2a9a3e0dd4fce4c5b1507d2d919c1f4e49e8609ef'),
(8, 'Robin', 'Batman', '7188b62868227e0315e4b2b2a9a3e0dd4fce4c5b1507d2d919c1f4e49e8609ef');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
 ADD PRIMARY KEY (`fileid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`userid`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
MODIFY `eventid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
MODIFY `fileid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
