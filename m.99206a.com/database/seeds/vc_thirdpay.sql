/*
SQLyog Community
MySQL - 5.5.47 : Database - js1_188ksb1_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Data for the table `vc_thirdpay` */

insert  into `vc_thirdpay`(`id`,`name`,`type`,`pid`,`pkey`,`seckey`,`pubkey`,`prikey`,`purl`,`hrefbackurl`,`callbackurl`,`queryurl`,`add_time`,`update_time`,`warntime`) values (1,'萝卜支付','lbpay','2434','4c09b8164779413ca2867a401dab2144',NULL,NULL,NULL,'http://gt.luobofu.net/chargebank.aspx','https://www.pay.cn/api/lbpay/hrefbackurl.php','http://front.8889s.com/pay/notify/thirdtype/lbpay/','http://www.luobofu.com/search.aspx',1494566207,1496046918,NULL);
insert  into `vc_thirdpay`(`id`,`name`,`type`,`pid`,`pkey`,`seckey`,`pubkey`,`prikey`,`purl`,`hrefbackurl`,`callbackurl`,`queryurl`,`add_time`,`update_time`,`warntime`) values (2,'得力付支付','dlfpay','16977','ed480e188709783c62b32d94b63c6471',NULL,NULL,NULL,'http://api.gengzhifu.com/pay/PayBank.aspx','https://pay1.zf590.com/api/dlpay/hrefbackurl.php','https://pay1.zf590.com/api/dlpay/callbackurl.php','http://api.gengzhifu.com/pay/queryOrder.aspx',1494575915,1496139807,NULL);
insert  into `vc_thirdpay`(`id`,`name`,`type`,`pid`,`pkey`,`seckey`,`pubkey`,`prikey`,`purl`,`hrefbackurl`,`callbackurl`,`queryurl`,`add_time`,`update_time`,`warntime`) values (3,'巨米云支付','jmypay','87754004','2415SIxEqCXO6BrKbaUMi4wqIQ3idQfX',NULL,NULL,NULL,'http://pay.gdgdxy.com/iApppay/PayOrder','https://www.pay.cn/api/jmypay/hrefbackurl.php','https://www.pay.cn/api/jmypay/callbackurl.php','http://pay.gdgdxy.com/iApppay/queryOrder',1494663053,1495177488,NULL);
insert  into `vc_thirdpay`(`id`,`name`,`type`,`pid`,`pkey`,`seckey`,`pubkey`,`prikey`,`purl`,`hrefbackurl`,`callbackurl`,`queryurl`,`add_time`,`update_time`,`warntime`) values (4,'捷宝支付','jbpay','001440348160001','889A19C9E57C82EBC46C6C3894A3E457',NULL,NULL,NULL,'http://api.jb8pay.com/passivePay','http://www.pay.cn/api/jbpay/hrefbackurl.php','http://www.pay.cn/api/jbpay/callbackurl.php','http://api.jb8pay.com/qrcodeQuery',1495176339,1495176339,NULL);
insert  into `vc_thirdpay`(`id`,`name`,`type`,`pid`,`pkey`,`seckey`,`pubkey`,`prikey`,`purl`,`hrefbackurl`,`callbackurl`,`queryurl`,`add_time`,`update_time`,`warntime`) values (5,'聚源支付','jypay','17085','443cd161e57dc9ac5a53e290e391bd51',NULL,NULL,NULL,'http://pay.juypay.com/PayBank.aspx','http://www.pay.cn/api/jypay/return_url','http://www.pay.cn/api/jypay/notify_url.php','',1496058955,NULL,NULL);
insert  into `vc_thirdpay`(`id`,`name`,`type`,`pid`,`pkey`,`seckey`,`pubkey`,`prikey`,`purl`,`hrefbackurl`,`callbackurl`,`queryurl`,`add_time`,`update_time`,`warntime`) values (6,'101卡支付','101pay','8882131','b917e04047c94b9bbc198fd73b7f437b',NULL,NULL,NULL,'http://api.101ka.com/GateWay/Bank/Default.aspx','http://www.pay.cn/api/101pay/return_url.php','http://www.pay.cn/api/101pay/notify_url.php','',1496117706,NULL,NULL);
insert  into `vc_thirdpay`(`id`,`name`,`type`,`pid`,`pkey`,`seckey`,`pubkey`,`prikey`,`purl`,`hrefbackurl`,`callbackurl`,`queryurl`,`add_time`,`update_time`,`warntime`) values (7,'科迅支付','kxpay','2479','9b485a9802144c74ae0d36989e428451',NULL,NULL,NULL,'http://pay.kexunpay.com/ChargeBank.aspx','http://www.pay.cn/api/kxpay/hrefbackurl.php','http://www.pay.cn/api/kxpay/callbackurl.php','',1496120460,1501847974,NULL);
insert  into `vc_thirdpay`(`id`,`name`,`type`,`pid`,`pkey`,`seckey`,`pubkey`,`prikey`,`purl`,`hrefbackurl`,`callbackurl`,`queryurl`,`add_time`,`update_time`,`warntime`) values (8,'讯付宝支付','xfbpay','1722','39f378f79ae04e9184736d6c1403b122',NULL,'','','http://payment.qxpay.cc/Bank/index.aspx','http://www.pay.cn/api/xfbpay/hrefbackurl','http://www.pay.cn/api/xfbpay/callbackurl.php','',1496647113,NULL,NULL);
insert  into `vc_thirdpay`(`id`,`name`,`type`,`pid`,`pkey`,`seckey`,`pubkey`,`prikey`,`purl`,`hrefbackurl`,`callbackurl`,`queryurl`,`add_time`,`update_time`,`warntime`) values (9,'金海哲支付','jhzpay','zz149241641759109YA13DKVQ','',NULL,'20170805/6ffa96624e37e2e25d839589ea7df73e.txt','20170805/4c051373c8b96cac31f09010e9137c6e.pem','http://zf.szjhzxxkj.com/ownPay/pay','http://www.pay.cn/api/hrefbackurl.php','http://www.pay.cn/api/callbackurl.php','http://zf.szjhzxxkj.com/own/business/orderInquiry',1496901832,1501847073,10);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
