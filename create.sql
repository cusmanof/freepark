-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.6.26


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO, MYSQL323' */;


--
-- Create schema test
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ test;
USE test;

DROP TABLE IF EXISTS `freedays_tbl`;
CREATE TABLE `freedays_tbl` (
  `owner` varchar(64) DEFAULT NULL,
  `parkId` varchar(64) NOT NULL DEFAULT '',
  `userId` varchar(64) NOT NULL DEFAULT '',
  `free_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`parkId`,`free_date`,`userId`)
) TYPE=InnoDB;

/*!40000 ALTER TABLE `freedays_tbl` DISABLE KEYS */;
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('','','chic','2015-10-28');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('','','chic','2015-10-31');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','chic','2015-10-23');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','','2015-10-25');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','','2015-10-26');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','chic','2015-10-27');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','','2015-10-28');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','','2015-10-29');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','','2015-11-02');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','','2015-11-03');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','chic','2015-11-05');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','','2015-11-06');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','chic','2015-11-06');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','','2015-11-08');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','','2015-11-09');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','','2015-11-10');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','','2015-11-15');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','','2015-11-16');
INSERT INTO `freedays_tbl` (`owner`,`parkId`,`userId`,`free_date`) VALUES 
  ('frank','123','','2015-11-17');
/*!40000 ALTER TABLE `freedays_tbl` ENABLE KEYS */;


DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) TYPE=InnoDB AUTO_INCREMENT=5;

/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`,`name`,`description`) VALUES 
  (1,'admin','Administrator');
INSERT INTO `groups` (`id`,`name`,`description`) VALUES 
  (2,'members','General User');
INSERT INTO `groups` (`id`,`name`,`description`) VALUES 
  (3,'user','a bay user');
INSERT INTO `groups` (`id`,`name`,`description`) VALUES 
  (4,'owner','bay owner');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;


DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  AUTO_INCREMENT=5;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`ip_address`,`username`,`password`,`salt`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`first_name`,`last_name`,`company`,`phone`) VALUES 
  (1,'127.0.0.1','admin','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,NULL,'42LBK.V80eJyEjT858gWE.',1268889823,1445561630,1,'Admin','istrator','ADMIN','0');
INSERT INTO `users` (`id`,`ip_address`,`username`,`password`,`salt`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`first_name`,`last_name`,`company`,`phone`) VALUES 
  (2,'::1','frank','$2y$08$jeJNXjEU6ndGDzRcJtS.fOZGY/sXDdmwe7ERsAV3egnhNaubW.szm',NULL,'frank.cusmano@thalesgroup.com.au',NULL,NULL,NULL,NULL,1445487184,1445561796,1,'frank','cusmano','thales','0448204160');
INSERT INTO `users` (`id`,`ip_address`,`username`,`password`,`salt`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`first_name`,`last_name`,`company`,`phone`) VALUES 
  (3,'::1','cusmanof','$2y$08$OYAN34ra2R0lFFdSxCNchuI2omrOaRqn3s2jwptoQqruM/zV1EiA2',NULL,'cusmanof@gmail.com',NULL,NULL,NULL,NULL,1445502117,NULL,1,NULL,NULL,NULL,NULL);
INSERT INTO `users` (`id`,`ip_address`,`username`,`password`,`salt`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`first_name`,`last_name`,`company`,`phone`) VALUES 
  (4,'::1','chic','$2y$08$hvGjY4ELyekkqWvtjFEUW.9ag3ipoGp6o.CeXgvPRlFWZQZshvMPW',NULL,'cusmanof@gmail.com',NULL,NULL,NULL,NULL,1445502173,NULL,1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) AUTO_INCREMENT=13;

/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`,`user_id`,`group_id`) VALUES 
  (5,1,1);
INSERT INTO `users_groups` (`id`,`user_id`,`group_id`) VALUES 
  (6,1,4);
INSERT INTO `users_groups` (`id`,`user_id`,`group_id`) VALUES 
  (11,2,1);
INSERT INTO `users_groups` (`id`,`user_id`,`group_id`) VALUES 
  (12,2,4);
INSERT INTO `users_groups` (`id`,`user_id`,`group_id`) VALUES 
  (9,3,2);
INSERT INTO `users_groups` (`id`,`user_id`,`group_id`) VALUES 
  (10,4,2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
