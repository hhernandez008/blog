-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 17, 2015 at 04:30 AM
-- Server version: 10.0.22-MariaDB-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog_infos`
--

CREATE TABLE IF NOT EXISTS `blog_infos` (
  `id` int(255) unsigned NOT NULL,
  `uid` int(255) unsigned NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `time_published` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `time_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `time_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status_flags` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog_texts`
--

CREATE TABLE IF NOT EXISTS `blog_texts` (
  `id` int(255) NOT NULL,
  `biid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog_titles`
--

CREATE TABLE IF NOT EXISTS `blog_titles` (
  `id` int(10) unsigned NOT NULL COMMENT 'Unique entry id for this table.',
  `uid` int(10) unsigned NOT NULL COMMENT 'The id number from `users`.',
  `title` varchar(64) NOT NULL DEFAULT 'My Wonderful Blog' COMMENT 'The title of this user''s blog.',
  `date_modified` datetime NOT NULL COMMENT 'The date-time this title was created or last modified.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(255) unsigned NOT NULL,
  `tag` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_infos`
--
ALTER TABLE `blog_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_texts`
--
ALTER TABLE `blog_texts`
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
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tag` (`tag`);

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
-- AUTO_INCREMENT for table `blog_infos`
--
ALTER TABLE `blog_infos`
  MODIFY `id` int(255) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blog_texts`
--
ALTER TABLE `blog_texts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blog_titles`
--
ALTER TABLE `blog_titles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique entry id for this table.';
--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique entry id.';
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(255) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique entry id for the user.';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
