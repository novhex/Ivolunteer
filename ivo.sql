-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2016 at 07:44 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ivo`
--

-- --------------------------------------------------------

--
-- Table structure for table `disaster_details`
--

CREATE TABLE IF NOT EXISTS `disaster_details` (
  `disaster_id` char(11) NOT NULL,
  `dis_team_id` varchar(50) NOT NULL,
  `no_of_volunteers` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disaster_type`
--

CREATE TABLE IF NOT EXISTS `disaster_type` (
  `disaster_type_id` char(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`disaster_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disaster_type`
--

INSERT INTO `disaster_type` (`disaster_type_id`, `type`) VALUES
('1423249', 'Earthquake'),
('2340350', 'Mudslide'),
('2576673', 'Flood'),
('481919', 'Landslide');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `province` varchar(50) NOT NULL,
  `municipality` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `location_id` char(11) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`province`, `municipality`, `street`, `location_id`) VALUES
('Planet Namek', 'Picolo', 'pics', '1116135'),
('cebu', 'carmen', 'cc street', '4017296');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE IF NOT EXISTS `organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` char(11) NOT NULL,
  `org_name` varchar(50) NOT NULL,
  `org_incharge` varchar(50) NOT NULL,
  `org_email` varchar(50) NOT NULL,
  `org_contactno` char(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `org_id`, `org_name`, `org_incharge`, `org_email`, `org_contactno`) VALUES
(1, '614585116', 'Dahjong Society', 'Sano Sano', 'sanosano@mailer.com', '09191234567'),
(2, '263505112', 'Young Developers Club', 'Saitama Opaw', 'saitama_onepunchman@email.com', '09191234561'),
(3, '16457787', 'sadasd', 'sadsadsa', 'asesdas@mil.com', '1122131');

-- --------------------------------------------------------

--
-- Table structure for table `organization_members`
--

CREATE TABLE IF NOT EXISTS `organization_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` char(11) DEFAULT NULL,
  `user_id` char(11) DEFAULT NULL,
  `member_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `organization_members`
--

INSERT INTO `organization_members` (`id`, `org_id`, `user_id`, `member_date`) VALUES
(1, '614585116', '1538046', '2016-01-22'),
(2, '263505112', '5881353', '2016-01-22'),
(3, '614585116', '8540288', '2016-01-22'),
(4, '614585116', '8871822', '2016-01-22'),
(5, '614585116', '9944857', '2016-01-22'),
(7, '614585116', '8187578', '2016-01-22'),
(8, '614585116', '2183253', '2016-01-22'),
(9, '263505112', '1118198', '2016-01-22');

-- --------------------------------------------------------

--
-- Table structure for table `process_relief_operation`
--

CREATE TABLE IF NOT EXISTS `process_relief_operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `disaster_id` char(11) NOT NULL,
  `location_id` char(11) NOT NULL,
  `organized_by` varchar(30) NOT NULL,
  `disaster_date` varchar(50) NOT NULL,
  `dis_type_id` char(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dis_type_id` (`dis_type_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `process_relief_operation`
--

INSERT INTO `process_relief_operation` (`id`, `disaster_id`, `location_id`, `organized_by`, `disaster_date`, `dis_type_id`) VALUES
(1, '4255473', '4017296', 'Novi Novi', '2015-01-29', '1423249');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE IF NOT EXISTS `sponsor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sponsor_id` char(11) NOT NULL,
  `user_id` char(11) NOT NULL,
  `donation` double NOT NULL,
  `date_given` date NOT NULL,
  `org_id` char(11) DEFAULT NULL,
  `disaster_id` char(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`id`, `sponsor_id`, `user_id`, `donation`, `date_given`, `org_id`, `disaster_id`) VALUES
(1, '179778', '9090602', 30000, '2016-02-02', '614585116', '2576673');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(11) NOT NULL,
  `user_firstname` varchar(30) NOT NULL,
  `user_lastname` varchar(30) NOT NULL,
  `user_mi` varchar(1) NOT NULL,
  `user_birthdate` date NOT NULL,
  `user_age` int(10) NOT NULL,
  `user_civil_status` varchar(30) NOT NULL,
  `user_religion` varchar(30) NOT NULL,
  `user_nationality` varchar(30) NOT NULL,
  `user_gender` varchar(11) NOT NULL,
  `user_contact_no` char(30) NOT NULL,
  `user_email_add` varchar(255) NOT NULL,
  `user_profession` varchar(50) NOT NULL,
  `user_active` int(1) NOT NULL,
  `dis_team_id` char(11) NOT NULL,
  `location_id` char(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_id`, `user_firstname`, `user_lastname`, `user_mi`, `user_birthdate`, `user_age`, `user_civil_status`, `user_religion`, `user_nationality`, `user_gender`, `user_contact_no`, `user_email_add`, `user_profession`, `user_active`, `dis_team_id`, `location_id`) VALUES
(1, '1538046', 'Novi', 'Maluenda', 'E', '0000-00-00', 21, 'single', 'Catholic', 'Filipino', 'male', '09074097354', 'novhz@test.com', 'WEB DEVELOPER', 1, '11', '1111'),
(2, '5881353', 'Odo', 'Ganade', 'F', '0000-00-00', 21, 'single', 'Catholic', 'Filipino', 'male', '09074097352', 'odoh@mailer.com', 'WEB DEVELOPER', 1, '11', '1111'),
(3, '9944857', 'Poypoy', 'Popeye', 'X', '0000-00-00', 21, 'single', 'Catholic', 'Filipino', 'male', '09123456781', 'poypoy@mailer.com', 'Businessman', 1, '11', '1111'),
(4, '8133871', 'John', 'Lennon', 'W', '0000-00-00', 21, 'single', 'Catholic', 'British', 'male', '09074097350', 'johnlennon@beatles.org', 'Musician', 1, '11', '1111'),
(5, '8540288', 'Bruno', 'Soliva', 'B', '0000-00-00', 21, 'single', 'Catholic', 'Filipino', 'male', '09074097351', 'bruno@bruno.com', 'Professional Actor', 1, '11', '1111'),
(6, '8871822', 'John', 'Catayas', 'L', '0000-00-00', 21, 'single', 'Catholic', 'Filipino', 'male', '09074097351', 'baka@Mailer.com', 'Data Processor', 1, '11', '1111'),
(7, '2183253', 'Michael Novi', 'Maluenda', 'E', '1994-05-14', 22, 'single', 'Catholic', 'Filipino', 'male', '09074097354', 'novhz0514@test.com', 'Software Developer', 1, '11', '1111'),
(8, '1118198', 'Denald', 'Marimon', 'F', '1995-07-12', 21, 'single', 'Catholic', 'Filipino', 'male', '09193214567', 'denald@denald.com', 'Programmer', 1, '11', '1111'),
(9, '2263132', 'Ben', 'Tulfo', 'X', '1990-07-04', 26, 'married', 'Catholic', 'Filipino', 'male', '09193214567', 'bentulfo@ggg.com', 'Newscaster', 1, '11', '1111'),
(10, '9090602', 'Yoo', 'Hoo', 'H', '1960-10-05', 56, 'married', 'Catholic', 'British', 'male', '11111111111', 'Yohoo@m.com', 'Businessman', 1, '11', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE IF NOT EXISTS `user_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(11) NOT NULL,
  `user_username` varchar(30) NOT NULL,
  `user_userpassword` char(15) NOT NULL,
  `user_account_type` char(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user_settings`
--

INSERT INTO `user_settings` (`id`, `user_id`, `user_username`, `user_userpassword`, `user_account_type`) VALUES
(1, '1538046', 'novhex111', '1111111', 'volunteer'),
(2, '5881353', 'jmg1234', '0000000', 'volunteer'),
(3, '9944857', 'poypoy123', '1111111', 'volunteer'),
(4, '8133871', 'johnlennon123', '1111111', 'volunteer'),
(5, '8540288', 'bruno123456', '1111111', 'sponsor'),
(6, '8871822', 'bakabaka123', '1111111', 'volunteer'),
(7, '8460933', 'michaelnovi', '1111111', 'volunteer'),
(8, '8187578', 'michaelnovix', '1111111', 'volunteer'),
(9, '2183253', 'michaelnovie', '1111111', 'volunteer'),
(10, '3321112', 'aaaaaa', '1111111', 'admin'),
(11, '1118198', 'denaldmarimon', '1111111', 'volunteer'),
(12, '2263132', 'coffeecat', '1111111', 'sponsor'),
(13, '9090602', 'coffeecat1', '1111111', 'sponsor');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `process_relief_operation`
--
ALTER TABLE `process_relief_operation`
  ADD CONSTRAINT `process_relief_operation_ibfk_1` FOREIGN KEY (`dis_type_id`) REFERENCES `disaster_type` (`disaster_type_id`),
  ADD CONSTRAINT `process_relief_operation_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
