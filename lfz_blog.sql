-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2015 at 11:10 AM
-- Server version: 5.5.41-log
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lfz_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE IF NOT EXISTS `avatars` (
`id` int(10) unsigned NOT NULL COMMENT 'The unique id for this avatar.',
  `uid` int(10) unsigned NOT NULL COMMENT 'The id number from `users`.',
  `pic` varchar(64) DEFAULT NULL COMMENT 'The filename of the avatar image.',
  `date_modified` datetime NOT NULL COMMENT 'The date/time this avatar was created or last modified.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_titles`
--

CREATE TABLE IF NOT EXISTS `blog_titles` (
`id` int(10) unsigned NOT NULL COMMENT 'Unique entry id for this table.',
  `uid` int(10) unsigned NOT NULL COMMENT 'The id number from `users`.',
  `title` varchar(64) NOT NULL DEFAULT 'My Wonderful Blog' COMMENT 'The title of this user''s blog.',
  `date_modified` datetime NOT NULL COMMENT 'The date-time this title was created or last modified.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
`id` int(10) unsigned NOT NULL COMMENT 'Unique entry id.',
  `uid` int(10) unsigned NOT NULL COMMENT 'Id number from `users`.',
  `login_ip` varchar(64) NOT NULL COMMENT 'The IP that last logged in for this id (sha1-encrypted).',
  `auth_token` varchar(64) NOT NULL COMMENT 'Encrypted authorization token.',
  `login_timestamp` int(10) unsigned NOT NULL COMMENT 'Unix timestamp this id was last logged in.'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL COMMENT 'Unique entry id for the user.',
  `email` varchar(64) NOT NULL,
  `username` varchar(32) NOT NULL COMMENT 'Display name for this user.',
  `password` varchar(256) NOT NULL COMMENT 'SHA1-encrypted password for this user.',
  `date_started` datetime NOT NULL COMMENT 'The date-time this user created an account.'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_titles`
--
ALTER TABLE `blog_titles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatars`
--
ALTER TABLE `avatars`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique id for this avatar.';
--
-- AUTO_INCREMENT for table `blog_titles`
--
ALTER TABLE `blog_titles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique entry id for this table.';
--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique entry id.',AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique entry id for the user.',AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
