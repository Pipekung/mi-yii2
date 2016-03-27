# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.42)
# Database: mi-yii
# Generation Time: 2016-03-27 09:55:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table auth_assignment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`)
VALUES
	('super_admin','1',1459046444);

/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table auth_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`)
VALUES
	('/*',2,NULL,NULL,NULL,1458973099,1458973099),
	('super_admin',2,NULL,NULL,NULL,1459046372,1459046372);

/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table auth_item_child
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;

INSERT INTO `auth_item_child` (`parent`, `child`)
VALUES
	('super_admin','/*');

/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table auth_rule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table borrow
# ------------------------------------------------------------

DROP TABLE IF EXISTS `borrow`;

CREATE TABLE `borrow` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `device_id` int(11) unsigned NOT NULL COMMENT 'ครุภัณฑ์',
  `user_id` int(11) unsigned NOT NULL COMMENT 'ผู้ยืม',
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT 'เลขที่การยืม',
  `borrow_date` datetime NOT NULL COMMENT 'วันที่ยืม',
  `borrow_user_id` int(11) unsigned NOT NULL COMMENT 'ผู้ดำเนินการยืม',
  `return_date` datetime DEFAULT NULL COMMENT 'วันที่คืน',
  `return_user_id` int(11) unsigned DEFAULT NULL COMMENT 'ผู้ดำเนินการคืน',
  `comment` text COMMENT 'หมายเหตุ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `borrow` WRITE;
/*!40000 ALTER TABLE `borrow` DISABLE KEYS */;

INSERT INTO `borrow` (`id`, `device_id`, `user_id`, `code`, `borrow_date`, `borrow_user_id`, `return_date`, `return_user_id`, `comment`)
VALUES
	(2,3,1,'1','2016-03-22 00:00:00',1,'2016-03-31 00:00:00',2,'');

/*!40000 ALTER TABLE `borrow` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table department
# ------------------------------------------------------------

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT 'ชื่อแผนก',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;

INSERT INTO `department` (`id`, `name`)
VALUES
	(1,'AA'),
	(2,'BB'),
	(3,'CC');

/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table device
# ------------------------------------------------------------

DROP TABLE IF EXISTS `device`;

CREATE TABLE `device` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT 'รหัสครุภัณฑ์',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT 'ชื่อครุภัณฑ์',
  `sn` varchar(20) NOT NULL DEFAULT '' COMMENT 'Serial Number',
  `brand_id` int(11) unsigned NOT NULL COMMENT 'ยี่ห้อ',
  `register_date` datetime NOT NULL COMMENT 'วันที่ลงทะเบียน',
  `status_id` int(11) unsigned NOT NULL COMMENT 'สถานะ',
  `type_id` int(11) unsigned NOT NULL COMMENT 'ประเภทครุภัณฑ์',
  `image` text COMMENT 'รูปภาพ',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `fk_device_brand_id` (`brand_id`),
  KEY `fk_device_status_id` (`status_id`),
  KEY `fk_device_type_id` (`type_id`),
  CONSTRAINT `fk_device_brand_id` FOREIGN KEY (`brand_id`) REFERENCES `device_brand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_device_status_id` FOREIGN KEY (`status_id`) REFERENCES `device_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_device_type_id` FOREIGN KEY (`type_id`) REFERENCES `device_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `device` WRITE;
/*!40000 ALTER TABLE `device` DISABLE KEYS */;

INSERT INTO `device` (`id`, `code`, `name`, `sn`, `brand_id`, `register_date`, `status_id`, `type_id`, `image`)
VALUES
	(1,'1','Macbook Air','1',4,'2016-03-01 00:00:00',1,1,'IMG_3110_517632b6021675bee6ddebbc8fe557df.jpg'),
	(2,'2','Macbook Pro','2',4,'2016-03-02 00:00:00',1,1,NULL),
	(3,'3','Macbook','3',4,'2016-03-21 00:00:00',1,1,NULL);

/*!40000 ALTER TABLE `device` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table device_brand
# ------------------------------------------------------------

DROP TABLE IF EXISTS `device_brand`;

CREATE TABLE `device_brand` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT 'ชื่อยี่ห้อ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `device_brand` WRITE;
/*!40000 ALTER TABLE `device_brand` DISABLE KEYS */;

INSERT INTO `device_brand` (`id`, `name`)
VALUES
	(1,'Acer'),
	(2,'HP'),
	(3,'Dell'),
	(4,'Apple');

/*!40000 ALTER TABLE `device_brand` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table device_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `device_status`;

CREATE TABLE `device_status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT 'ชื่อสถานะ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `device_status` WRITE;
/*!40000 ALTER TABLE `device_status` DISABLE KEYS */;

INSERT INTO `device_status` (`id`, `name`)
VALUES
	(1,'ยืมได้'),
	(2,'ยืมไม่ได้'),
	(3,'กำลังดำเนินการยืม'),
	(4,'กำลังดำเนินการซ่อม');

/*!40000 ALTER TABLE `device_status` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table device_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `device_type`;

CREATE TABLE `device_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT 'ประเภทครุภัณฑ์',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `device_type` WRITE;
/*!40000 ALTER TABLE `device_type` DISABLE KEYS */;

INSERT INTO `device_type` (`id`, `name`)
VALUES
	(1,'คอมพิวเตอร์'),
	(2,'เครื่องพิมพ์');

/*!40000 ALTER TABLE `device_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table migration
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;

INSERT INTO `migration` (`version`, `apply_time`)
VALUES
	('m000000_000000_base',1459005621);

/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table profile
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `officer_code` int(6) NOT NULL COMMENT 'รหัสเจ้าหน้าที่',
  `title` varchar(15) DEFAULT NULL COMMENT 'คำนำหน้า',
  `firstname` varchar(25) NOT NULL DEFAULT '' COMMENT 'ชื่อ',
  `lastname` varchar(40) NOT NULL DEFAULT '' COMMENT 'นามสกุล',
  `nickname` varchar(20) DEFAULT NULL COMMENT 'ชื่อเล่น',
  `department_id` int(11) NOT NULL COMMENT 'แผนก',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;

INSERT INTO `profile` (`user_id`, `officer_code`, `title`, `firstname`, `lastname`, `nickname`, `department_id`)
VALUES
	(1,1234,'mr','admin','system','zz',2),
	(2,0,NULL,'member','system',NULL,1),
	(3,3,'','demo','system','',2);

/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table profile_copy
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profile_copy`;

CREATE TABLE `profile_copy` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `profile_copy_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table repair
# ------------------------------------------------------------

DROP TABLE IF EXISTS `repair`;

CREATE TABLE `repair` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `divice_id` int(11) unsigned NOT NULL COMMENT 'ครุภัณฑ์',
  `user_id` int(11) unsigned NOT NULL COMMENT 'ผู้แจ้งซ่อม',
  `code` varchar(15) NOT NULL DEFAULT '' COMMENT 'รหัสการแจ้งซ่อม',
  `date` datetime NOT NULL COMMENT 'วันที่แจ้งซ่อม',
  `cost` float DEFAULT '0' COMMENT 'ค่าใช้จ่าย',
  `status_id` int(11) unsigned NOT NULL COMMENT 'สถานะ',
  `comment` text COMMENT 'หมายเหตุ',
  `receiver_user_id` int(11) unsigned NOT NULL COMMENT 'ผู้รับเรื่อง',
  `return_user_id` int(11) unsigned DEFAULT NULL COMMENT 'ผู้ส่งคืน',
  `return_date` datetime DEFAULT NULL COMMENT 'วันที่ส่งคืน',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `repair` WRITE;
/*!40000 ALTER TABLE `repair` DISABLE KEYS */;

INSERT INTO `repair` (`id`, `divice_id`, `user_id`, `code`, `date`, `cost`, `status_id`, `comment`, `receiver_user_id`, `return_user_id`, `return_date`)
VALUES
	(1,1,2,'1','2016-03-23 00:00:00',NULL,1,'',1,NULL,NULL),
	(2,1,2,'1','2016-03-22 00:00:00',NULL,1,'',1,NULL,NULL),
	(3,2,2,'1','2016-03-29 00:00:00',NULL,2,'',1,NULL,NULL);

/*!40000 ALTER TABLE `repair` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table repair_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `repair_status`;

CREATE TABLE `repair_status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT 'สถานะ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `repair_status` WRITE;
/*!40000 ALTER TABLE `repair_status` DISABLE KEYS */;

INSERT INTO `repair_status` (`id`, `name`)
VALUES
	(1,'รอดำเนินการ'),
	(2,'ดำเนินการซ่อม'),
	(3,'ซ่อมเสร็จเรียบร้อย'),
	(4,'ยกเลิก'),
	(5,'จำหน่าย');

/*!40000 ALTER TABLE `repair_status` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table social_account
# ------------------------------------------------------------

DROP TABLE IF EXISTS `social_account`;

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text,
  `code` varchar(32) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`),
  CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table token
# ------------------------------------------------------------

DROP TABLE IF EXISTS `token`;

CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`),
  CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;

INSERT INTO `token` (`user_id`, `code`, `created_at`, `type`)
VALUES
	(1,'dRlkxCo3hEfKpsiWyY5wogRmZJjvPiMc',1458963516,0);

/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_email` (`email`),
  UNIQUE KEY `user_unique_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`)
VALUES
	(1,'admin','admin@local.host','$2y$10$GGp3tY5FI48mDGuNi2L1GOPTVHHpgU60TpP0v5mAUWQ2JfzmlVUuu','e196oA4jPymNXBYfqspw8PWTdEIlBSYr',1458963516,NULL,NULL,'::1',1458963516,1458963516,0),
	(2,'member','member@local.host','$2y$10$ZvYgPA6dTJATM4LOTNvr3O7NMmx8nvfzJkVjukYpmLzN1C1Lkblqu','E7pq3jS-HATZ1K7EjBN11Nze91bBeQR7',1458967817,NULL,NULL,'::1',1458967817,1458967817,0),
	(3,'demo','demo@local.host','$2y$10$8D8S1ElSDrFqb/Rxi1eze.ucIYBq8W1veSjrs.V1cbSSrkYfBDwyS','31vevj7ClQOIjFJQ_-wKG4dzSNDwAto9',1459005290,NULL,NULL,'::1',1459005290,1459005290,0);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
