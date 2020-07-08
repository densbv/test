-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `articles` (`id`, `author_id`, `name`, `text`, `created_at`) VALUES
(1,	1,	'Lorem ipsum dolor sit amet, consectetur adipiscing elit',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco',	'2020-07-08 16:30:39'),
(2,	1,	'laboris nisi ut aliquip ex ea commodo consequat.',	'laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non',	'2020-07-08 16:30:50'),
(3,	1,	'Cursus euismod quis viverra nibh cras.',	'Cursus euismod quis viverra nibh cras. Nisl pretium fusce id velit ut tortor. Enim neque volutpat ac tincidunt vitae semper quis lectus. Nibh venenatis cras sed felis. Quam quisque id diam vel quam elementum. Dictum sit amet justo donec enim diam. Adipiscing elit duis tristique sollicitudin. Lacus vel facilisis volutpat est velit egestas dui id. In',	'2020-07-08 16:31:03'),
(4,	1,	'Amet justo donec enim diam vulputate ut.',	'Amet justo donec enim diam vulputate ut. Quis commodo odio aenean sed adipiscing diam. Cursus vitae congue mauris rhoncus aenean vel elit scelerisque mauris. Vestibulum morbi blandit cursus risus at ultrices. Consectetur libero id faucibus nisl tincidunt eget nullam. Adipiscing elit pellentesque habitant morbi tristique senectus et netus. Odio',	'2020-07-08 16:31:13'),
(5,	1,	'Est pellentesque elit ullamcorper dignissim cras. ',	'Est pellentesque elit ullamcorper dignissim cras. At ultrices mi tempus imperdiet nulla malesuada pellentesque elit. Dictum sit amet justo donec enim diam. Nulla pharetra diam sit amet nisl suscipit. Urna molestie at elementum eu facilisis. Lorem dolor sed viverra ipsum nunc aliquet bibendum. Sagittis nisl rhoncus mattis rhoncus urna neque. Velit dignissim sodales ut eu sem. Et malesuada fames ac turpis egestas.',	'2020-07-08 16:31:24');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `role` enum('admin','user') NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `nickname`, `email`, `is_confirmed`, `role`, `password_hash`, `auth_token`, `created_at`) VALUES
(1,	'admin',	'admin@gmail.com',	1,	'admin',	'$2y$10$SMEkEvq8YITGZ2Hnl4SFXu8MgYQisRmcKOtamuFtD151tzR27V1ii',	'57b654f8affb1f1da57a458f25a6a1d625acd5f02986db34a80b1060af15c34a3701dbf9a39e1c48',	'2020-06-26 17:42:15'),
(2,	'user',	'user@gmail.com',	1,	'user',	'hash2',	'token2',	'2020-06-26 17:42:15');

DROP TABLE IF EXISTS `users_activation_codes`;
CREATE TABLE `users_activation_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users_activation_codes` (`id`, `user_id`, `code`) VALUES
(1,	4,	'33ed3a400bd12295357f810db5567e37');

-- 2020-07-08 09:38:11
