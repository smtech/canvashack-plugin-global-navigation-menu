# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.49-0ubuntu0.14.04.1)
# Database: canvas-custom-prefs
# Generation Time: 2016-06-10 12:17:47 +0000
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



# Dump of table enrollment-rules
# ------------------------------------------------------------

CREATE TABLE `enrollment-rules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role` enum('faculty','staff','student','advisor','no-menu','alum','departed') DEFAULT NULL COMMENT 'Custom Prefs role affected by this enrollment rule (optional, but _one_ of either role or group must be included to have any effect)',
  `group` int(11) DEFAULT NULL COMMENT 'Database ID of group affected by this rule (optional, but either a group or role must be provided for the rule to have an effect)',
  `course` int(11) NOT NULL COMMENT 'Canvas ID of the course in which the rule mandates enrollment',
  `enrollment` varchar(64) NOT NULL DEFAULT 'StudentEnrollment' COMMENT 'Enrollment role mandated by the rule (default is Student)',
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp of last modification of this rule',
  `title` varchar(255) DEFAULT NULL COMMENT 'Human-readable title for this rule',
  `description` text COMMENT 'Human-readable complete description of this rule',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table group-memberships
# ------------------------------------------------------------

CREATE TABLE `group-memberships` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL COMMENT 'Database ID of user that is a member of this group',
  `group` int(11) NOT NULL COMMENT 'Database ID of the group of which the user is a member',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp of last modification of this membership',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table groups
# ------------------------------------------------------------

CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COMMENT 'Human-readable name of this group',
  `parent` int(11) DEFAULT NULL COMMENT 'Database ID of the parent group of this group',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table menu-acl
# ------------------------------------------------------------

CREATE TABLE `menu-acl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group` int(11) NOT NULL COMMENT 'Database ID of a group that has access to this menu or menu item',
  `menu-item` int(11) DEFAULT NULL COMMENT 'Database ID of the menu or menu item for which access is provided',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table menu-clicks
# ------------------------------------------------------------

CREATE TABLE `menu-clicks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL COMMENT 'The Canvas ID of the user that clicked on this URL',
  `source` text NOT NULL COMMENT 'The source page where the link was clicked',
  `destination` text NOT NULL COMMENT 'The URL of the destination of the click',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'When the click happened',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table menu-items
# ------------------------------------------------------------

CREATE TABLE `menu-items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Database ID, used by cick.php for redirection and click-tracking',
  `parent` int(11) DEFAULT NULL COMMENT 'NULL for menus, the Database ID of the menu for menu items',
  `order` int(11) NOT NULL DEFAULT '0' COMMENT 'Order of menus or menu items within a menu (menus or menu items with equal order will be displayed alphabetically by title)',
  `title` varchar(100) DEFAULT NULL COMMENT 'Display title of the menu or menu item',
  `subtitle` varchar(100) DEFAULT NULL COMMENT 'Optional subtitle for menu items',
  `svg` text COMMENT 'SVG icon for menus (set no fill color: the SVG will be styled by the Canvas theme)',
  `target` text COMMENT 'HREF target for menu or menu item URL',
  `url` text COMMENT 'HREF for menu or menu item (menus with a non-anchor HREF will not open -- they will immediately redirect to the URL)',
  `role` enum('faculty','staff','student','no-menu') DEFAULT NULL COMMENT 'Make this menu or menu item available only for a specific Custom Prefs role (NULL to make available to all users)',
  `info` text COMMENT 'Informational text to display at the bottom of menu trays',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table users
# ------------------------------------------------------------

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL COMMENT 'Canvas user ID',
  `role` enum('faculty','staff','student','advisor','no-menu','alum','departed') NOT NULL DEFAULT 'no-menu' COMMENT 'Mutually-exclusive roles within the school',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp of last modification of this user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
