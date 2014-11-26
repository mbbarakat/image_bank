-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2014 at 12:14 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=392 ;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`fileid`, `owner`, `title`, `description`, `filename`, `type`, `size`, `width`, `height`, `uploaded`, `updated`) VALUES
(375, 7, '', '', 'Cloud - Sephiroth.jpg', 'jpg', 164722, 1920, 1200, 'November 22, 2014, 11:31 ', 0),
(376, 7, '', '', 'Blame.jpg', 'jpg', 538888, 1920, 1080, 'November 22, 2014, 11:32 ', 0),
(377, 7, '', '', 'Cloud.jpg', 'jpg', 216659, 1920, 1080, 'November 22, 2014, 11:32 ', 0),
(378, 7, '', '', 'Darker Than Black.jpg', 'jpg', 185544, 1680, 1050, 'November 22, 2014, 11:32 ', 0),
(379, 7, '', '', 'earth_by_kuldarleement.jpg', 'jpg', 1534843, 1920, 1080, 'November 22, 2014, 11:32 ', 0),
(380, 7, '', '', 'Final Fantasy 7.jpg', 'jpg', 168457, 1920, 1080, 'November 22, 2014, 11:32 ', 0),
(381, 7, '', '', 'okami 2.jpg', 'jpg', 1615105, 1600, 999, 'November 22, 2014, 11:32 ', 0),
(382, 7, '', '', 'Okami.jpg', 'jpg', 206969, 1920, 1080, 'November 22, 2014, 11:32 ', 0),
(383, 7, '', '', 'okami-990083.jpg', 'jpg', 320383, 1600, 1000, 'November 22, 2014, 11:32 ', 0),
(384, 7, '', '', 'Protoss.jpg', 'jpg', 419303, 1920, 1080, 'November 22, 2014, 11:32 ', 0),
(385, 7, '', '', 'Sephiroth.jpg', 'jpg', 284804, 1920, 1080, 'November 22, 2014, 11:32 ', 0),
(386, 7, '', '', 'Shadow of the Colossus.jpg', 'jpg', 353863, 1920, 1080, 'November 22, 2014, 11:32 ', 0),
(387, 7, '', '', 'Squares and Balls.jpg', 'jpg', 380230, 1920, 1080, 'November 22, 2014, 11:32 ', 0),
(388, 7, '', '', 'Tiny Dragon.jpg', 'jpg', 245429, 1920, 1080, 'November 22, 2014, 11:32 ', 0),
(389, 7, '', '', 'wallpaper-808979.jpg', 'jpg', 332277, 1920, 1080, 'November 22, 2014, 11:32 ', 0),
(390, 7, '', '', 'Wolf thing.jpg', 'jpg', 409534, 1920, 1080, 'November 22, 2014, 11:32 ', 0),
(391, 7, '', '', 'WOT.jpg', 'jpg', 312429, 1920, 1080, 'November 22, 2014, 11:32 ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `file_format`
--

CREATE TABLE IF NOT EXISTS `file_format` (
  `fileformatid` int(11) NOT NULL,
  `fileid` int(11) NOT NULL,
  `formatid` int(11) NOT NULL,
  `filename` varchar(250) NOT NULL,
  `type` varchar(100) NOT NULL,
  `size` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `format`
--

CREATE TABLE IF NOT EXISTS `format` (
  `formatid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `crop` bit(1) NOT NULL,
  `stretch` bit(1) NOT NULL,
  `type` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `format`
--

INSERT INTO `format` (`formatid`, `name`, `width`, `height`, `crop`, `stretch`, `type`, `userid`) VALUES
(1, 'thumbnail', 100, 100, b'0', b'0', 'jpg', 0),
(2, 'small', 220, 148, b'0', b'0', 'jpg', 0),
(3, 'medium', 320, 240, b'0', b'0', 'jpg', 0),
(4, 'large', 800, 600, b'0', b'0', 'jpg', 0);

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
-- Indexes for table `file_format`
--
ALTER TABLE `file_format`
 ADD PRIMARY KEY (`fileformatid`);

--
-- Indexes for table `format`
--
ALTER TABLE `format`
 ADD PRIMARY KEY (`formatid`);

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
MODIFY `fileid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=392;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
