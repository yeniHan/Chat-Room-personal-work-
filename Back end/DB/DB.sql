-- MySQL dump 10.16  Distrib 10.1.31-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version	10.1.31-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `pw` varchar(18) NOT NULL,
  `eMail` varchar(60) NOT NULL,
  `lastMsgId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'stupidBear','stupidBearpw','stupidstupid@gmail.com',10),(2,'alien','alienpw','alienFromMars@yahoo.com',NULL),(13,'happy20','happy20pw','happyhappy@naver.com',NULL),(14,'yourID','yourIDpw','vkdkdkdk@naver.com',NULL),(15,'myId','mdkdkdkdkdkdk','dkdkdkdkd@naver.com',NULL),(16,'alexoh','password','alexoh@wcoding.com',NULL),(17,'Slin','slinpass','slin@wcodingtestmail.com',35),(18,'Daniell','Dannis','Daniell.levy@hotmail.com',NULL),(19,'CSpon','test','cspon@gmail.com',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `msgs`
--

DROP TABLE IF EXISTS `msgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `msg` text NOT NULL,
  `time` datetime NOT NULL,
  `private` tinyint(4) NOT NULL,
  `receiver` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msgs`
--

LOCK TABLES `msgs` WRITE;
/*!40000 ALTER TABLE `msgs` DISABLE KEYS */;
INSERT INTO `msgs` VALUES (1,'stupidBear','Hi~!!','2018-05-10 09:58:19',0,NULL),(8,'stupidBear','Hi, happy20!!','2018-10-10 02:42:29',1,'happy20'),(9,'happy20','How was the date?','2018-10-10 03:39:22',1,'stupidBear'),(10,'stupidBear','So nice I think I fell hard to her.......OMG. ','2018-10-10 03:45:36',0,NULL),(17,'stupidBear','	Required. The datatype to convert expression to. Can be one of the following: bigint, int, smallint, tinyint, bit, decimal, numeric, money, smallmoney, float, real, datetime, smalldatetime, char, varchar, text, nchar, nvarchar, ntext, binary, varbinary, or image','2018-10-10 04:15:30',0,NULL),(18,'alien','Hi there~~','2018-10-10 04:23:39',0,NULL),(19,'alien','Hey','2018-10-10 04:32:18',0,NULL),(20,'alien','Did you finish homework??','2018-10-10 04:44:58',1,'stupidBear'),(21,'yourID','Hi, guys!!','2018-10-10 04:52:38',0,NULL),(22,'yourID','Hey, stupid~!!','2018-10-10 04:53:16',0,NULL),(24,'happy20','This is private..to alien.','2018-10-10 05:02:50',1,'alien'),(25,'stupidBear','Did you eat dinner, alien?','2018-11-11 02:51:13',0,NULL),(26,'stupidBear','No, not yet.. ','2018-11-11 02:52:48',1,'alien'),(27,'stupidBear','Good morgning!!','2018-11-11 05:54:22',0,NULL),(28,'stupidBear','I wanna go on a picnic today!!','2018-11-11 05:59:43',0,NULL),(29,'stupidBear','Hi, happy20, this is the private mode!!','2018-11-11 06:27:58',1,'happy20'),(30,'alexoh','Hello, everyone!','2018-11-11 06:38:28',0,NULL),(31,'alien','HI','2018-11-11 06:39:06',0,NULL),(32,'Daniell','heey','2018-11-11 06:39:11',0,NULL),(33,'CSpon','hey!','2018-11-11 06:40:00',0,NULL),(34,'Slin','Hey everyone!','2018-11-11 06:40:15',0,NULL),(35,'Daniell','haii slin ^^','2018-11-11 06:40:53',1,'Slin'),(36,'Slin','Hi Daniell!','2018-11-11 06:43:49',1,'Daniell'),(37,'alexoh','Another test.','2018-11-11 06:47:43',0,NULL),(38,'alexoh','Here\'s another message!','2018-11-11 06:49:00',0,NULL),(39,'alexoh','This is a private message.','2018-11-11 06:51:43',1,'alien'),(40,'alien','This is also private msg','2018-11-11 01:18:11',1,'Daniell'),(41,'stupidBear','Hi','2018-11-11 01:25:38',0,NULL),(42,'stupidBear','Hi, myId, This is a private msg!!','2018-11-11 01:26:23',1,'myId'),(43,'stupidBear','Test!!','2018-11-11 02:02:08',1,'yourID'),(44,'stupidBear','Hey, Alien, this is StupidBear. It\'s private conversation!!','2018-11-11 02:10:49',1,'alien'),(45,'yourID','I am yourID!!','2018-11-11 02:18:53',0,NULL);
/*!40000 ALTER TABLE `msgs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-12 11:16:44
