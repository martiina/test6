-- Adminer 4.2.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `movies`;
CREATE TABLE `movies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `title` varchar(16) NOT NULL,
  `rating` int(5) NOT NULL,
  `release_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `movies` (`id`, `user_id`, `title`, `rating`, `release_date`) VALUES
(1,	19,	'Big Hero 6',	5,	'2015-03-03 00:00:00'),
(2,	19,	'Pacific Rim',	2,	'1998-09-21 00:00:00'),
(3,	19,	'Avengers',	4,	'2012-03-05 00:00:00'),
(4,	18,	'Transformers 4',	1,	'2015-08-05 00:00:00'),
(5,	18,	'Muumioru lood',	5,	'0000-00-00 00:00:00'),
(6,	19,	'Transformers 4',	1,	'0000-00-00 00:00:00'),
(7,	19,	'Transformers 2',	1,	'0000-00-00 00:00:00'),
(8,	19,	'Transformers',	1,	'2000-01-25 00:00:00'),
(9,	21,	'12',	5,	'1998-03-09 00:00:00'),
(10,	21,	'12345678',	4,	'1970-01-01 00:00:00'),
(11,	21,	'ko&uuml;&otilde;',	5,	'2010-02-05 00:00:00'),
(12,	21,	'film',	4,	'2010-10-10 00:00:00'),
(13,	21,	'film&uuml;&otild',	2,	'2010-10-10 00:00:00'),
(14,	22,	'Lammas Aias',	2,	'2015-10-30 00:00:00'),
(15,	19,	'Test',	2,	'2015-10-30 00:00:00');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(24) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `password`, `salt`) VALUES
(18,	'Martin',	'40b45314b55a8d052b8d49cd8a8a7e27f089fbab2faa156320ed57bb58a7d31c',	'Û²ò­ŠŠOW(µ>2¸ýaµAD#Fèþ†ÕtØh6V-'),
(19,	'Truth',	'1af5d56f684cfd86e63c72d2f8d52f91b38ad90eb5b78ce0bda7a81fda159607',	'jKï¹Ë£\r“CU¹ÍÐ˜ï{µ}H¨‹Ë\Z¡*{9°'),
(20,	'&lt;b&gt;test&lt;/b&gt;',	'00a120b67947b02359e3ecbd63cb4989c07b1a7ef2675ae6f1b0002e8dc2cf77',	'\"Œ¬pM<ƒÁ¶\'¾èìÝ–ñfàZ«üwVda'),
(21,	'teele',	'f71caa1a1a7890bd70128335f1aff934e393b278b23f3cbc41d18ac3bc9eb272',	'ëž¨Ç¡~&èBÁº€ow¦¹\'f;ŒL¹\'Ñ'),
(22,	'test',	'860e2dff75876ee7991380742bc7069bf7de6073b5ffb800ed797fe22f5b370e',	'íÔ€à9›ØÚ«÷5sG\ZãìV(²º›Œ‹M:');

-- 2015-11-20 10:31:43
