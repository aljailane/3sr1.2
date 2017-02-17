-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- المزود: sql310.byetcluster.com
-- أنشئ في: 03 فبراير 2017 الساعة 12:51
-- إصدارة المزود: 5.6.34-79.1
-- PHP إصدارة: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- قاعدة البيانات: `4lju_19203492_betaup`
--

-- --------------------------------------------------------

--
-- بنية الجدول `php_users_login`
--

CREATE TABLE IF NOT EXISTS `php_users_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `content` text,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- إرجاع أو استيراد بيانات الجدول `php_users_login`
--

INSERT INTO `php_users_login` (`id`, `email`, `password`, `name`, `phone`, `content`, `last_login`) VALUES
(1, 'darhost56@gmail.com', '050935', 'محمد الجيلاني', '0558019313', 'text content for Demo1 user.', '2017-02-02 17:59:27'),
(2, 'demo2@demo.com', 'pass', 'Demo 2', '+9876543210', 'another text content for Demo2 user', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(200) CHARACTER SET utf8 NOT NULL,
  `userProfession` varchar(500) CHARACTER SET utf8 NOT NULL,
  `userPic` varchar(200) CHARACTER SET utf8 NOT NULL,
  `userDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- إرجاع أو استيراد بيانات الجدول `tbl_users`
--

INSERT INTO `tbl_users` (`userID`, `userName`, `userProfession`, `userPic`, `userDate`) VALUES
(25, 'Ù…Ø­Ù…Ø¯ Ø§Ù„Ø¬ÙŠÙ„Ø§Ù†ÙŠ', 'ØªØ¬Ø±Ø¨Ø©', '68ee9.png', '0000-00-00 00:00:00'),
(26, 'Ù…Ø­Ù…Ø¯ Ø§Ù„Ø¬ÙŠÙ„Ø§Ù†ÙŠ', 'ØªØ¬Ø±Ø¨Ø©', 'cf7bf.png', '0000-00-00 00:00:00'),
(27, 'Ù…Ø­Ù…Ø¯ Ø§Ù„Ø¬ÙŠÙ„Ø§Ù†ÙŠ', 'ØªØ¬Ø±Ø¨Ø©', 'c5947.png', '0000-00-00 00:00:00'),
(28, 'Ø­Ù…ÙˆØ¯ÙŠ', 'ÙƒÙ„ Ø³Ù†Ù‡ ÙˆØ§Ù†Øª Ø·ÙŠØ¨', '8bee6.png', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
