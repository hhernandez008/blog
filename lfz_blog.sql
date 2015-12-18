-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 17, 2015 at 07:15 PM
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
  `time_created` int(10) unsigned NOT NULL COMMENT 'Unix timestamp when this blog was created.',
  `time_published` int(10) unsigned DEFAULT NULL COMMENT 'Unix timestamp when this blog was given the public flag.',
  `time_modified` int(10) unsigned DEFAULT NULL COMMENT 'Unix timestamp when this blog was modified.',
  `time_deleted` int(10) unsigned DEFAULT NULL COMMENT 'Unix timestamp when this blog was given the delete flag.',
  `status_flags` tinyint(3) unsigned NOT NULL COMMENT 'Mask flag values: DELETE=128, PUBLIC=1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_infos`
--

INSERT INTO `blog_infos` (`id`, `uid`, `time_created`, `time_published`, `time_modified`, `time_deleted`, `status_flags`) VALUES
(2, 37, 1450341493, NULL, NULL, NULL, 0),
(3, 37, 1450341538, NULL, NULL, NULL, 1),
(4, 37, 1450341739, NULL, NULL, NULL, 0),
(5, 37, 1450341772, NULL, NULL, NULL, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_texts`
--

INSERT INTO `blog_texts` (`id`, `biid`, `title`, `text`, `tags`) VALUES
(1, 2, 'Blog Title 1', 'Sed non ante diam. In ac egestas ipsum. Mauris porta, felis vel lacinia faucibus, urna justo mattis eros, mattis varius libero ligula id est. Praesent ut suscipit risus. Nullam lobortis eu ipsum sed posuere. Nullam neque urna, suscipit et libero in, iaculis ultricies justo. Suspendisse non odio tempus nisi consequat auctor. Quisque quis enim cursus, iaculis dui vel, tincidunt neque. Integer ultricies, massa a imperdiet sollicitudin, tellus nulla egestas lectus, ut imperdiet erat est vitae nulla. Pellentesque quam nisl, venenatis et accumsan et, dignissim sit amet mi.\r\n\r\nMauris ut felis ante. Nullam in turpis arcu. Nulla facilisi. In a faucibus ante. Cras faucibus est eu finibus iaculis. Quisque aliquam sem quis euismod convallis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin facilisis feugiat convallis. Pellentesque tincidunt est ac erat ullamcorper laoreet. Etiam at fringilla nisl. Phasellus purus mauris, consequat at molestie nec, malesuada non urna. Integer iaculis libero a orci cursus ultricies. Nam ac ornare libero, at gravida ipsum.', ' 1, 2, 3,'),
(2, 3, 'Blog Title 2', 'Morbi ex dolor, egestas sit amet efficitur eu, scelerisque non metus. Integer vulputate mi id interdum congue. Vestibulum quis mauris nunc. Fusce eget hendrerit ligula. In quis orci imperdiet, condimentum lacus non, venenatis sapien. Nunc imperdiet ipsum felis, eget feugiat orci molestie eu. Donec porttitor aliquam euismod. Curabitur blandit sed enim nec pulvinar. Quisque vestibulum magna nec odio condimentum rutrum. Suspendisse sed vehicula lorem. Cras in feugiat enim, consequat fringilla orci. Suspendisse tristique nulla sit amet consequat molestie. Curabitur commodo sagittis eros vitae aliquam. Duis interdum nulla metus, non mollis dui pharetra ac.\r\n\r\nIn quam eros, dictum ut iaculis iaculis, volutpat ut tortor. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed interdum consectetur nisl a ullamcorper. Duis sit amet ante eget lorem varius porttitor. Nullam suscipit dui eget urna pulvinar, sed aliquet justo mattis. Nunc eros ligula, eleifend et elementum quis, tempus id erat. Integer mollis, lorem at imperdiet pharetra, elit quam tincidunt ligula, eu ullamcorper risus enim at felis. Cras pulvinar quam non nibh venenatis, quis euismod purus eleifend. Donec consectetur orci leo, ut sagittis eros tincidunt in. Duis quis pretium sapien. Morbi enim nisl, lobortis et tristique sit amet, vehicula lacinia massa. Fusce eu diam vitae arcu vulputate rhoncus quis eget dolor. Aenean euismod lectus quis quam volutpat facilisis.', ' 2, 3, 4,'),
(3, 4, 'Blog Title 3', 'Morbi ex dolor, egestas sit amet efficitur eu, scelerisque non metus. Integer vulputate mi id interdum congue. Vestibulum quis mauris nunc. Fusce eget hendrerit ligula. In quis orci imperdiet, condimentum lacus non, venenatis sapien. Nunc imperdiet ipsum felis, eget feugiat orci molestie eu. Donec porttitor aliquam euismod. Curabitur blandit sed enim nec pulvinar. Quisque vestibulum magna nec odio condimentum rutrum. Suspendisse sed vehicula lorem. Cras in feugiat enim, consequat fringilla orci. Suspendisse tristique nulla sit amet consequat molestie. Curabitur commodo sagittis eros vitae aliquam. Duis interdum nulla metus, non mollis dui pharetra ac.\r\n\r\nIn quam eros, dictum ut iaculis iaculis, volutpat ut tortor. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed interdum consectetur nisl a ullamcorper. Duis sit amet ante eget lorem varius porttitor. Nullam suscipit dui eget urna pulvinar, sed aliquet justo mattis. Nunc eros ligula, eleifend et elementum quis, tempus id erat. Integer mollis, lorem at imperdiet pharetra, elit quam tincidunt ligula, eu ullamcorper risus enim at felis. Cras pulvinar quam non nibh venenatis, quis euismod purus eleifend. Donec consectetur orci leo, ut sagittis eros tincidunt in. Duis quis pretium sapien. Morbi enim nisl, lobortis et tristique sit amet, vehicula lacinia massa. Fusce eu diam vitae arcu vulputate rhoncus quis eget dolor. Aenean euismod lectus quis quam volutpat facilisis.', ' 3, 4, 5,'),
(4, 5, 'Blog Title 4', 'Morbi ex dolor, egestas sit amet efficitur eu, scelerisque non metus. Integer vulputate mi id interdum congue. Vestibulum quis mauris nunc. Fusce eget hendrerit ligula. In quis orci imperdiet, condimentum lacus non, venenatis sapien. Nunc imperdiet ipsum felis, eget feugiat orci molestie eu. Donec porttitor aliquam euismod. Curabitur blandit sed enim nec pulvinar. Quisque vestibulum magna nec odio condimentum rutrum. Suspendisse sed vehicula lorem. Cras in feugiat enim, consequat fringilla orci. Suspendisse tristique nulla sit amet consequat molestie. Curabitur commodo sagittis eros vitae aliquam. Duis interdum nulla metus, non mollis dui pharetra ac.\r\n\r\nIn quam eros, dictum ut iaculis iaculis, volutpat ut tortor. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed interdum consectetur nisl a ullamcorper. Duis sit amet ante eget lorem varius porttitor. Nullam suscipit dui eget urna pulvinar, sed aliquet justo mattis. Nunc eros ligula, eleifend et elementum quis, tempus id erat. Integer mollis, lorem at imperdiet pharetra, elit quam tincidunt ligula, eu ullamcorper risus enim at felis. Cras pulvinar quam non nibh venenatis, quis euismod purus eleifend. Donec consectetur orci leo, ut sagittis eros tincidunt in. Duis quis pretium sapien. Morbi enim nisl, lobortis et tristique sit amet, vehicula lacinia massa. Fusce eu diam vitae arcu vulputate rhoncus quis eget dolor. Aenean euismod lectus quis quam volutpat facilisis.', ' 4, 5, 6,');

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `uid`, `login_ip`, `auth_token`, `login_timestamp`) VALUES
(17, 37, '2af5670e04f6129d6eecf9e484f3c0572b43082b', '7c30c9c69694192cc515b65e72471139140de43f', 1450293538),
(18, 37, '2af5670e04f6129d6eecf9e484f3c0572b43082b', 'cbfb97aa32dbb4bd23e42e9e39b58bc9b4fffad4', 1450294194),
(19, 37, '2af5670e04f6129d6eecf9e484f3c0572b43082b', '3da35920a81976c13ea620bf4337e28b1c5fda55', 1450295502),
(20, 37, 'd0c38a15c458ecbcb6f9ad7f4bf412cd6644c8cd', '44475332d5562bdbc7e64ac4fbc1783bd744fa73', 1450348067),
(21, 37, '2af5670e04f6129d6eecf9e484f3c0572b43082b', '38c5fa39e25cd463be8c4ec97e958c365b175272', 1450378958),
(22, 37, '2af5670e04f6129d6eecf9e484f3c0572b43082b', 'bc3fee15836ddcf9748bf2e29cbbc3e026199081', 1450378972);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(255) unsigned NOT NULL,
  `tag` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(4, 'Fashion'),
(3, 'Music'),
(1, 'News'),
(6, 'Politics'),
(2, 'Sports'),
(5, 'Technology');

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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `date_started`) VALUES
(37, 'rtransfig@gmail.com', 'rtransfig', '235e9cb705df72be29cb948a2856c54c2bf8c2be', '2015-12-16 19:14:25');

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
  MODIFY `id` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `blog_texts`
--
ALTER TABLE `blog_texts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `blog_titles`
--
ALTER TABLE `blog_titles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique entry id for this table.';
--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique entry id.',AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique entry id for the user.',AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
