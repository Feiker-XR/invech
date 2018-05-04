/*
SQLyog Community v12.5.0 (64 bit)
MySQL - 5.5.54-log : Database - alafei
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`alafei` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `alafei`;

/*Table structure for table `gygy_played_pl_group` */

DROP TABLE IF EXISTS `gygy_played_pl_group`;

CREATE TABLE `gygy_played_pl_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `playedId` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `gygy_played_pl_group` */

insert  into `gygy_played_pl_group`(`id`,`playedId`,`name`,`sort`) values 
(1,301,'万位',0),
(2,301,'千位',1),
(3,301,'百位',2),
(4,301,'十位',3),
(5,301,'个位',4),
(6,301,'总和、龙虎和',5),
(7,302,'万位',0),
(8,302,'千位',1),
(9,302,'百位',2),
(10,302,'十位',3),
(11,302,'个位',4);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
