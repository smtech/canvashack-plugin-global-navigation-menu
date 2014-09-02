# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.38-0ubuntu0.12.04.1)
# Database: canvas-custom-prefs
# Generation Time: 2014-09-02 03:06:17 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table courses
# ------------------------------------------------------------

CREATE TABLE `courses` (
  `id` int(11) unsigned NOT NULL COMMENT 'Canvas course ID',
  `menu-visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Is this course visible in the Courses menu?',
  `calendar-visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Is this course visible in the Calendar?',
  `calendar-name` text COMMENT 'What is the custom name for this course in Calendar?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;

INSERT INTO `courses` (`id`, `menu-visible`, `calendar-visible`, `calendar-name`)
VALUES
	(97,0,1,'Faculty'),
	(489,0,0,NULL),
	(497,0,1,NULL),
	(1277,0,1,NULL),
	(2056,0,0,NULL);

/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table groups
# ------------------------------------------------------------

CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COMMENT 'Human-readable name of this group',
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `parent`)
VALUES
	(1,'Arts Department',NULL),
	(2,'Classics Department',NULL),
	(3,'English Department',NULL),
	(4,'History and Social Sciences Department',NULL),
	(5,'Mathematics Department',11),
	(6,'Modern Languages Department',NULL),
	(7,'Psychology Department',NULL),
	(8,'Religion Department',NULL),
	(9,'Science Department',11),
	(11,'STEM',NULL),
	(12,'Academic Technology',NULL);

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table menu-caches
# ------------------------------------------------------------

CREATE TABLE `menu-caches` (
  `user` int(11) unsigned NOT NULL,
  `menus` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table menu-clicks
# ------------------------------------------------------------

CREATE TABLE `menu-clicks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `source` text NOT NULL,
  `destination` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table menu-items
# ------------------------------------------------------------

CREATE TABLE `menu-items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu` int(11) DEFAULT NULL,
  `column` int(11) DEFAULT NULL,
  `section` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) DEFAULT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `style` text,
  `target` text,
  `url` text,
  `groups` text,
  `role` enum('faculty','staff','student','no-menu') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `menu-items` WRITE;
/*!40000 ALTER TABLE `menu-items` DISABLE KEYS */;

INSERT INTO `menu-items` (`id`, `menu`, `column`, `section`, `order`, `title`, `subtitle`, `style`, `target`, `url`, `groups`, `role`)
VALUES
	(1,NULL,NULL,NULL,1,'Resources',NULL,NULL,NULL,NULL,NULL,NULL),
	(2,1,41,NULL,1,'General',NULL,NULL,NULL,NULL,NULL,'faculty'),
	(3,1,41,NULL,2,'The Center for Innovation<br />in Teaching and Learning',NULL,NULL,NULL,NULL,NULL,NULL),
	(4,1,41,NULL,3,'Research &amp; Writing',NULL,NULL,NULL,NULL,NULL,NULL),
	(5,1,41,NULL,4,'On Campus',NULL,NULL,NULL,NULL,NULL,NULL),
	(6,1,41,2,1,'Faculty Resources','Calendars, Forms, Policies, Guides',NULL,NULL,'/courses/97',NULL,NULL),
	(7,1,41,2,2,'Academic Technology','Shared files',NULL,'_blank','https://drive.google.com/a/stmarksschool.org/?tab=co#folders/0Bx1atGpuKjk9UHJ3MU5nRms5Zms','a:1:{i:0;i:12;}',NULL),
	(8,1,41,2,2,'History Dept.','Shared files',NULL,'_blank','https://drive.google.com/a/stmarksschool.org/?tab=mo#folders/0Bxkl1PbtN3mKa1B0Ym5nSXoxU2M','a:1:{i:0;i:4;}',NULL),
	(9,1,41,2,2,'Modern Languages Dept.',NULL,NULL,NULL,'/courses/1294','a:1:{i:0;i:6;}',NULL),
	(10,1,41,3,1,'Information for Students','Student Enrichment &amp; Academic Support',NULL,NULL,'/courses/491',NULL,NULL),
	(11,1,41,3,2,'Information for Faculty','Professional Development &amp; Academic Support',NULL,NULL,'/courses/97/wiki/the-center-for-innovation-in-teaching-and-learning',NULL,'faculty'),
	(12,1,41,3,3,'Writing Lab',NULL,NULL,NULL,'/courses/491/wiki/writing-lab',NULL,NULL),
	(13,1,41,3,4,'Mathematics Lab',NULL,NULL,NULL,'/courses/491/wiki/mathematics-lab',NULL,NULL),
	(14,1,41,4,1,'Library','Catalog, Online Resources, References',NULL,'_blank','http://library.stmarksschool.org',NULL,NULL),
	(15,1,41,4,2,'Writing Manual','All the steps you need to write',NULL,'_blank','https://drive.google.com/a/stmarksschool.org/folderview?id=0ByGbqFAT3Vy1aXdRY2hoNlY4WjA&usp=sharing',NULL,NULL),
	(16,1,41,5,1,'All School Information','Information, Organizations, Calendar',NULL,NULL,'/courses/2056',NULL,NULL),
	(17,1,41,5,2,'Weekend Activities Sign-ups',NULL,NULL,'_blank','http://www2.stmarksschool.org',NULL,'student'),
	(18,1,41,5,3,'Weekend Permission Sign-out',NULL,NULL,'_blank','https://docs.google.com/a/stmarksschool.org/forms/d/11ImFsy_-gz17MHnulm3gQMykarsKFJavR5HESomlkaY/viewform?usp=send_form',NULL,'student'),
	(19,1,41,5,4,'FLIK Menu',NULL,NULL,'_blank','http://www.myschooldining.com/SMS/?cmd=menus',NULL,NULL),
	(20,1,41,5,5,'Athletics',NULL,NULL,'_blank','http://www.stmarksschool.org/athletics/teamlisting.aspx',NULL,NULL),
	(21,NULL,NULL,NULL,2,'Lion Hub',NULL,NULL,NULL,NULL,NULL,NULL),
	(22,21,42,NULL,1,'Training &amp; Support',NULL,NULL,NULL,NULL,NULL,NULL),
	(23,21,42,NULL,2,'Communication &amp; Storage',NULL,NULL,NULL,NULL,NULL,NULL),
	(24,21,42,NULL,3,'Academics Office',NULL,NULL,NULL,NULL,NULL,NULL),
	(25,21,42,NULL,4,'Service Desks',NULL,NULL,NULL,NULL,NULL,'faculty'),
	(26,21,42,22,1,'Canvas Training',NULL,NULL,NULL,'/courses/489',NULL,'faculty'),
	(27,21,42,22,2,'Lynda.com','Software Training &amp; Tutorials',NULL,'_blank','http://iplogin.lynda.com',NULL,NULL),
	(28,21,42,22,3,'SMS',NULL,NULL,'_blank','http://sms.stmarksschool.org',NULL,NULL),
	(29,21,42,22,4,'Tech Support Documents',NULL,NULL,'_blank','http://www.stmarksschool.org/academics/technology/Tech-Docs/index.aspx',NULL,'faculty'),
	(30,21,42,23,1,'Gmail',NULL,NULL,'_blank','https://mail.google.com/a/stmarksschool.org',NULL,NULL),
	(31,21,42,23,2,'Google Drive',NULL,NULL,'_blank','https://drive.google.com/a/stmarksschool.org/#my-drive',NULL,NULL),
	(32,21,42,23,3,'Minerva Web Access',NULL,NULL,'_blank','http://minerva.stmarksschool.org',NULL,'faculty'),
	(33,21,42,23,4,'Athena Web Access',NULL,NULL,'_blank','http://athena.stmarksschool.org',NULL,'faculty'),
	(34,21,42,23,4,'Athena Web Access',NULL,NULL,'_blank','http://athena.stmarksschool.org',NULL,'student'),
	(35,21,42,24,1,'CurricuPlan',NULL,NULL,'_blank','http://hosting.curricuplan.com/ms/customers/St%20Marks/cup/curricuplan.nsf',NULL,'faculty'),
	(36,21,42,24,2,'FAWeb','Window Grades &amp; Comments',NULL,'_blank','http://faweb.stmarksschool.org',NULL,'faculty'),
	(37,21,42,24,3,'NetClassroom','Course Registration',NULL,'_blank','http://netclassroom.stmarksschool.org',NULL,NULL),
	(38,21,42,25,1,'Technology Help Desk',NULL,NULL,'_blank','https://stmarks.zendesk.com/requests?output_type=table',NULL,NULL),
	(39,21,42,25,2,'School Dude',NULL,NULL,'_blank','http://www.myschoolbuilding.com/myschoolbuilding/msbdefault_email.asp?frompage=myrequest.asp',NULL,'faculty'),
	(40,21,42,25,3,'Communications Request',NULL,NULL,'_blank','http://www.stmarksschool.org/about-st-marks/communications-department/index.aspx',NULL,NULL),
	(41,1,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(42,21,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `menu-items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL COMMENT 'Canvas user ID',
  `role` enum('faculty','staff','student','no-menu') NOT NULL DEFAULT 'no-menu' COMMENT 'Mutually-exclusive roles within the school',
  `groups` text COMMENT 'Serialized array of group IDs of which this user is a member',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `role`, `groups`)
VALUES
	(1,'faculty','a:3:{i:0;i:5;i:1;i:11;i:2;i:12;}');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
