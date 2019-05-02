# Host: localhost  (Version: 5.5.53)
# Date: 2018-12-23 11:39:20
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "news"
#

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '文章内容',
  `veiws` int(11) DEFAULT '0' COMMENT '浏览量',
  `time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

#
# Data for table "news"
#

/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (36,'震惊!11岁女同学放学后...','震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n震惊!11岁女同学放学后被各科老师轮流布置家庭作业!\r\n',0,'2018-12-22 18:30:19'),(37,'震惊!00后居然没有活过20岁的!','震惊!00后居然没有活过20岁的!\r\n震惊!00后居然没有活过20岁的!\r\n震惊!00后居然没有活过20岁的!\r\n震惊!00后居然没有活过20岁的!\r\n震惊!00后居然没有活过20岁的!\r\n震惊!00后居然没有活过20岁的!\r\n震惊!00后居然没有活过20岁的!\r\n震惊!00后居然没有活过20岁的!\r\n震惊!00后居然没有活过20岁的!\r\n震惊!00后居然没有活过20岁的!\r\n震惊!00后居然没有活过20岁的!\r\n震惊!00后居然没有活过20岁的!\r\n震惊!00后居然没有活过20岁的!\r\n震惊!00后居然没有活过20岁的!',0,NULL),(38,'我是第一','我是第一我是第一',0,NULL),(39,'早上好','早上好\r\n早上好\r\n早上好\r\n早上好\r\n早上好\r\n早上好\r\n早上好\r\n早上好\r\n早上好\r\n早上好\r\n早上好',0,NULL),(40,'你好','星期天\r\n20181223',0,NULL);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('aaaa','bbbbbb'),('1233','cccccc'),('1234','aaaaaa'),('121312','xxxxxx'),('1111','123456'),('123456','123456'),('123456789','123456'),('1234567','请输入密码'),('963','963');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
