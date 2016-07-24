-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2008 at 09:08 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `geekbin_mmproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` mediumint(8) NOT NULL auto_increment,
  `image_name` varchar(255) NOT NULL,
  `image_orientation` tinyint(1) NOT NULL default '1',
  `image_roomno` mediumint(8) NOT NULL default '0',
  `image_positionno` mediumint(12) NOT NULL default '0',
  `image_framestyle` varchar(20) NOT NULL default 'black',
  `image_size` varchar(7) NOT NULL default 'medium',
  `image_artist` varchar(255) NOT NULL default '',
  `image_date` varchar(25) NOT NULL,
  `image_description` varchar(10000) NOT NULL,
  `image_active` varchar(2) NOT NULL,
  PRIMARY KEY  (`image_id`),
  KEY `image_roomno_id` (`image_roomno`),
  KEY `image_positionno` (`image_positionno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=132 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` VALUES(1, 'Cat ''O'' Pattern', 1, 1, 1, 'metal', 'large', 'Louis Wain', '1860-1939', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(2, 'Cat Beach', 1, 1, 2, 'wood', 'large', 'Louis Wain', '1860-1939', 'Description goes here.', 'on');
INSERT INTO `images` VALUES(3, 'By the Water', 0, 1, 3, 'metal', 'large', 'Louis Wain', '1860-1939', 'Description of a picture', 'on');
INSERT INTO `images` VALUES(4, 'Botanist', 0, 1, 4, 'wood', 'large', 'Louis Wain', '6 September 1985', 'Description of a picture', 'on');
INSERT INTO `images` VALUES(5, 'Cat Dolls', 0, 1, 5, 'black', 'large', 'Louis Wain', '1860-1939', 'Description of a picture', 'on');
INSERT INTO `images` VALUES(6, 'Soldier Cat', 1, 1, 6, 'metal', 'small', 'Louis Wain', '1860-1939', 'Description of a picture', 'on');
INSERT INTO `images` VALUES(7, 'Coquette', 1, 1, 7, 'black', 'medium', 'Louis Wain', '1860-1939', 'Description of a picture', 'on');
INSERT INTO `images` VALUES(8, 'Possesed Cat', 1, 1, 8, 'metal', 'large', 'Louis Wain', '1860-1939', 'Description of a picture', 'on');
INSERT INTO `images` VALUES(9, 'Garden', 0, 1, 9, 'wood', 'small', 'Louis Wain', '1860-1939', 'Description of a picture', 'on');
INSERT INTO `images` VALUES(10, 'Gato 1', 1, 1, 10, 'metal', 'medium', 'Louis Wain', '1860-1939', 'Description of a picture', 'on');
INSERT INTO `images` VALUES(11, 'Gato 2', 1, 1, 11, 'metal', 'medium', 'Louis Wain', '1860-1939', 'Description of a picture', 'on');
INSERT INTO `images` VALUES(12, 'Gato 3', 1, 1, 12, 'metal', 'medium', 'Louis Wain', '1860-1939', 'Description of a picture', 'on');
INSERT INTO `images` VALUES(13, 'Boo!', 0, 1, 13, 'black', 'small', 'Louis Wain', '1860-1939', 'Description of a picture', 'on');
INSERT INTO `images` VALUES(14, 'Flower Eyes', 1, 1, 14, 'wood', 'large', 'Louis Wain', '1860-1939', 'Description of a picture', 'on');
INSERT INTO `images` VALUES(17, 'Animal', 1, 2, 1, 'metal', 'large', 'Name Here', 'Date Here', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(18, 'Face', 1, 2, 2, 'wood', 'medium', 'Name Here', 'Date Here', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(19, 'Bust', 1, 2, 3, 'black', 'small', 'Name Here', 'Date Here', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(20, 'Gnome', 1, 2, 4, 'wood', 'medium', 'Name Here', 'Date Here', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(21, 'Agressao', 1, 2, 5, 'metal', 'large', 'Name Here', 'Date Here', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(22, 'Mice', 1, 2, 6, 'wood', 'large', 'Name', 'Date', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(23, 'Castigo', 0, 2, 7, 'black', 'medium', 'Name Here', 'Date Here', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(24, 'Der Heil und Pflege Anstalt', 1, 2, 8, 'wood', 'medium', 'Name Here', 'Date Here', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(25, 'Ein Himmelfahrts Traum', 1, 2, 9, 'black', 'medium', 'Name Here', 'Date Here', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(26, 'Escape', 0, 2, 10, 'metal', 'large', 'Name Here', 'Date Here', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(27, 'Museum of Hopelessness', 0, 2, 11, 'black', 'small', 'Name Here', 'Date Here', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(28, 'Hostilidade', 1, 2, 12, 'metal', 'small', 'Name Here', 'Date Here', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(29, 'Isolamento', 0, 2, 13, 'wood', 'medium', 'Name Here', 'Date Here', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(30, 'Perseguicao', 0, 2, 14, 'black', 'large', 'Name Here', 'Date Here', 'This is a description about the image.', 'on');
INSERT INTO `images` VALUES(33, 'Life & Death', 1, 3, 1, 'metal', 'large', 'Name Here', 'Date Here', 'Description of an image', 'on');
INSERT INTO `images` VALUES(34, 'Women', 1, 3, 2, 'black', 'medium', 'Name Here', 'Date Here', 'Description of an image', 'on');
INSERT INTO `images` VALUES(35, 'Angel', 1, 3, 3, 'wood', 'small', 'Name Here', 'Date Here', 'Description of an image', 'on');
INSERT INTO `images` VALUES(36, 'Abstract', 1, 3, 4, 'black', 'large', 'Name Here', 'Date Here', 'Description of an image', 'on');
INSERT INTO `images` VALUES(37, 'Angry!', 0, 3, 5, 'black', 'medium', 'Name Here', 'Date Here', 'Description of an image', 'on');
INSERT INTO `images` VALUES(38, '', 0, 3, 6, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(39, '', 0, 3, 7, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(40, '', 0, 3, 8, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(41, '', 0, 3, 9, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(42, '', 0, 3, 10, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(43, '', 0, 3, 11, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(44, '', 0, 3, 12, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(45, '', 0, 3, 13, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(46, '', 0, 3, 14, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(47, 'Flower Bed', 1, 4, 1, 'wood', 'medium', 'Louis Wain', 'Date Here', 'Description of an image', 'on');
INSERT INTO `images` VALUES(48, 'Love', 0, 4, 2, 'metal', 'large', 'Louis Wain', 'Date Here', 'Description of an image', 'on');
INSERT INTO `images` VALUES(49, 'Musical Cat', 1, 4, 3, 'black', 'small', 'Louis Wain', 'Date Here', 'Description of an image', 'on');
INSERT INTO `images` VALUES(50, 'MouseTrap', 0, 4, 4, 'wood', 'large', 'Louis Wain', 'Date Here', 'Description of an image', 'on');
INSERT INTO `images` VALUES(51, 'Cat', 1, 4, 5, 'black', 'large', 'Louis Wain', 'Date Here', 'Description of an image', 'on');
INSERT INTO `images` VALUES(52, 'El Gato', 1, 4, 6, 'metal', 'small', 'Louis Wain', 'Date Here', 'Description of an image', 'on');
INSERT INTO `images` VALUES(53, 'Last Supper', 0, 4, 7, 'black', 'large', 'Louis Wain', 'Date Here', 'Description of an image', 'on');
INSERT INTO `images` VALUES(54, '', 0, 4, 8, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(55, '', 0, 4, 9, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(56, '', 0, 4, 10, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(57, '', 0, 4, 11, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(58, '', 0, 4, 12, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(59, '', 0, 4, 13, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(60, '', 0, 4, 14, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(61, '', 0, 5, 1, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(62, '', 0, 5, 2, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(63, '', 0, 5, 3, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(64, '', 0, 5, 4, 'black', 'medium', '', '', '                                                                                xxx<br />                                                                        ', '');
INSERT INTO `images` VALUES(65, '', 0, 5, 5, 'black', 'medium', '', '', '                                                                                xxx<br />                                                                        ', '');
INSERT INTO `images` VALUES(66, '', 0, 5, 6, 'black', 'medium', '', '', '                                                                                xxx<br />                                                                        ', '');
INSERT INTO `images` VALUES(67, '', 1, 5, 7, 'black', 'medium', '', '', '                                                                                xxx<br />                                                                        ', '');
INSERT INTO `images` VALUES(68, '', 0, 5, 8, 'black', 'medium', '', '', '                                                                                xxx<br />                                                                        ', '');
INSERT INTO `images` VALUES(69, '', 0, 5, 9, 'black', 'medium', '', '', '                                                                                xxx<br />                                                                        ', '');
INSERT INTO `images` VALUES(70, '', 0, 5, 10, 'black', 'medium', '', '', '                                                                                xxx<br />                                                                        ', '');
INSERT INTO `images` VALUES(71, '', 1, 5, 11, 'black', 'medium', '', '', '                                                                                xxx<br />                                                                        ', '');
INSERT INTO `images` VALUES(72, '', 1, 5, 12, 'black', 'medium', '', '', '                                                                                xxx<br />                                                                        ', '');
INSERT INTO `images` VALUES(73, '', 1, 5, 13, 'black', 'medium', '', '', '                                                                                xxx<br />                                                                        ', '');
INSERT INTO `images` VALUES(74, '', 1, 5, 14, 'black', 'medium', '', '', '                                                                                xxx<br />                                                                        ', '');
INSERT INTO `images` VALUES(75, '', 0, 6, 1, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(76, '', 0, 6, 2, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(77, '', 0, 6, 3, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(78, '', 0, 6, 4, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(79, '', 0, 6, 5, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(80, '', 0, 6, 6, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(81, '', 0, 6, 7, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(82, '', 0, 6, 8, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(83, '', 0, 6, 9, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(84, '', 0, 6, 10, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(85, '', 0, 6, 11, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(86, '', 0, 6, 12, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(87, '', 0, 6, 13, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(88, '', 0, 6, 14, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(89, '', 0, 7, 1, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(90, '', 0, 7, 2, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(91, '', 0, 7, 3, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(92, '', 0, 7, 4, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(93, '', 0, 7, 5, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(94, '', 0, 7, 6, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(95, '', 0, 7, 7, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(96, '', 0, 7, 8, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(97, '', 0, 7, 9, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(98, '', 0, 7, 10, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(99, '', 0, 7, 11, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(100, '', 0, 7, 12, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(101, '', 0, 7, 13, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(102, '', 0, 7, 14, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(103, '', 0, 8, 1, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(104, '', 1, 8, 2, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(105, '', 0, 8, 3, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(106, '', 1, 8, 4, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(107, '', 1, 8, 5, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(108, '', 0, 8, 6, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(109, '', 1, 8, 7, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(110, '', 1, 8, 8, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(111, '', 1, 8, 9, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(112, '', 1, 8, 10, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(113, '', 1, 8, 11, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(114, '', 1, 8, 12, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(115, '', 1, 8, 13, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(116, '', 1, 8, 14, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(117, '', 0, 9, 1, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(118, '', 0, 9, 2, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(119, '', 0, 9, 3, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(120, '', 0, 9, 4, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(121, '', 0, 9, 5, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(122, '', 0, 9, 6, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(123, '', 0, 9, 7, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(124, '', 0, 9, 8, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(125, '', 0, 9, 9, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(126, '', 0, 9, 10, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(127, '', 0, 9, 11, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(128, '', 0, 9, 12, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(129, '', 0, 9, 13, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(130, '', 0, 9, 14, 'black', 'medium', '', '', '', '');
INSERT INTO `images` VALUES(131, '', 1, 0, 0, 'black', 'medium', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(2) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` VALUES(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `roomnames`
--

CREATE TABLE `roomnames` (
  `room_id` int(10) unsigned NOT NULL auto_increment,
  `room_name` varchar(45) NOT NULL,
  PRIMARY KEY  USING BTREE (`room_id`,`room_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `roomnames`
--

INSERT INTO `roomnames` VALUES(1, 'Schizophrenia');
INSERT INTO `roomnames` VALUES(2, 'Paranoia');
INSERT INTO `roomnames` VALUES(3, 'Madness');
INSERT INTO `roomnames` VALUES(4, 'Obsessive Compulsive');
INSERT INTO `roomnames` VALUES(5, '');
INSERT INTO `roomnames` VALUES(6, '');
INSERT INTO `roomnames` VALUES(7, '');
INSERT INTO `roomnames` VALUES(8, '');
INSERT INTO `roomnames` VALUES(9, '');
