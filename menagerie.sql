-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 06, 2014 at 03:45 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `menagerie`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_emotion`
--

CREATE TABLE `user_emotion` (
  `user_emotion_id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(30) NOT NULL,
  `url` varchar(255) NOT NULL,
  `mood` varchar(45) NOT NULL,
  PRIMARY KEY (`user_emotion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user_emotion`
--

INSERT INTO `user_emotion` (`user_emotion_id`, `token`, `url`, `mood`) VALUES
(1, 'hey', 'http://www.nytimes.com/2014/04/05/business/bold-bid-to-combat-a-crisis-in-legal-education.html', '2'),
(2, 'hey', 'http://www.nytimes.com/2014/04/06/technology/technologys-man-problem.html', '1'),
(3, 'hey', 'http://www.nytimes.com/2014/04/06/magazine/flash-boys-michael-lewis.html', '2'),
(4, 'hey', 'http://www.nytimes.com/2014/04/05/opinion/chinas-poisonous-waterways.html', '0'),
(5, 'hey', 'http://www.nytimes.com/2014/04/05/opinion/following-orders-in-rwanda.html', '0'),
(6, 'hey', 'http://www.nytimes.com/2014/04/06/opinion/sunday/a-rationalists-mystical-moment.html', '2'),
(7, 'hey', 'http://www.nytimes.com/2014/04/02/world/europe/jerry-roberts-last-of-team-of-british-code-breakers-dies-at-93.html', '1'),
(8, 'hey', 'http://www.nytimes.com/2014/04/05/us/politics/george-bush-portrait-exhibition-opens-in-dallas.html', '0'),
(9, 'hey', 'http://www.nytimes.com/2014/04/04/opinion/cohen-in-search-of-home.html', '1'),
(10, 'hey', 'http://www.nytimes.com/2014/04/05/opinion/charter-school-refugees.html', '1'),
(11, 'hey', 'http://www.nytimes.com/2014/04/06/opinion/sunday/kristof-her-first-and-last-book.html', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
