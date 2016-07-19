# ************************************************************
# Sequel Pro SQL dump
# バージョン 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# ホスト: 127.0.0.1 (MySQL 5.7.12)
# データベース: payments
# 作成時刻: 2016-07-10 19:02:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

create database payments;
use payments;

# テーブルのダンプ card_hashes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `card_hashes`;

CREATE TABLE `card_hashes` (
  `user_id` int(11) unsigned NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fingerprint` varchar(255) NOT NULL DEFAULT '',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `card_hashes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ charges
# ------------------------------------------------------------

DROP TABLE IF EXISTS `charges`;

CREATE TABLE `charges` (
  `user_id` int(11) unsigned NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `charge_id` varchar(255) NOT NULL DEFAULT '',
  `summary` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `charge_id` (`charge_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `charges_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cha_rec_id` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `amount` int(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cha_rec_id` (`cha_rec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ recursions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `recursions`;

CREATE TABLE `recursions` (
  `user_id` int(11) unsigned NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recursion_id` varchar(255) NOT NULL DEFAULT '',
  `summary` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `charge_id` (`recursion_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `recursions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

