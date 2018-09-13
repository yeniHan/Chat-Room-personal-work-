-- MySQL dump 10.16  Distrib 10.1.31-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: chatroom
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
-- Table structure for table `msgs`
--

DROP TABLE IF EXISTS `msgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `msg` text NOT NULL,
  `private` tinyint(4) NOT NULL,
  `receiver` varchar(10) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msgs`
--

LOCK TABLES `msgs` WRITE;
/*!40000 ALTER TABLE `msgs` DISABLE KEYS */;
INSERT INTO `msgs` VALUES (51,'admin','This dialogue is extracted from the script of the series 01 episode 03 â€“ \"The Fuzzy Boots Corollary\" of \"The Big Bang Theory',0,NULL,'2018-09-13 02:29:52'),(52,'sheldon','Please donâ€™t tell me that your hopeless infatuation is devolving into pointless jealousy.',0,NULL,'2018-09-13 02:37:23'),(53,'leonard','No, Iâ€™m not jealous, Iâ€™m just a little concerned for her. I didnâ€™t like the look of the guy that she was with.',0,NULL,'2018-09-13 02:38:20'),(54,'howard','Because he looked better than you?',0,NULL,'2018-09-13 02:47:34'),(55,'leonard','Yeah. He was kinda dreamy.',0,NULL,'2018-09-13 02:54:47'),(58,'sheldon','Well, at least now you can retrieve the black box from the twisted smouldering wreckage that was once your fantasy of dating her, and analyse the data so that you donâ€™t crash into geek mountain again.',0,NULL,'2018-09-13 03:27:43'),(59,'howard',' disagree, love is not a sprint, itâ€™s a marathon. A relentless pursuit that only ends when she falls into your arms. Or hits you with the pepper spray.',0,NULL,'2018-09-13 07:18:32'),(63,'leonard','Well, Iâ€™m done with Penny. Iâ€™m going to be more realistic and go after someone my own speed.',0,NULL,'2018-09-13 07:28:56'),(64,'sheldon','Like who?',1,'leonard','2018-09-13 07:30:20'),(65,'leonard',' I donâ€™t know. Olivia Geiger?',1,'sheldon','2018-09-13 07:30:59'),(66,'sheldon','The dietician at the cafeteria with the limp and the lazy eye?',1,'leonard','2018-09-13 07:32:03'),(67,'leonard','Yeah.',0,NULL,'2018-09-13 08:29:01'),(68,'leonard','Yeah',1,'sheldon','2018-09-13 09:04:51'),(76,'admin','1)\"Private chat\" function: You can see how it works by loggin in with leonard\'s or sheldon\'s account.',0,NULL,'2018-09-13 15:19:37'),(77,'admin','2)\"Showing only unread messages\" function: You can see how it works by loggin in with sheldon\'s account.',0,NULL,'2018-09-13 15:19:49'),(78,'admin','*[Account] password: (member name)+ pw (ex) id=> sheldon, pw=> sheldonpw',0,NULL,'2018-09-13 15:20:13'),(79,'admin','For more information, please refer to the README.md file.',0,NULL,'2018-09-13 15:20:25');
/*!40000 ALTER TABLE `msgs` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (20,'admin','adminpw','admin@email.com',NULL),(21,'sheldon','sheldonpw','sheldon@email.com',58),(22,'leonard','leonardpw','leonard@email.com',NULL),(23,'howard','howardpw','howard@email.com',NULL),(24,'laj','lajpw','laj@email.com',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-14  0:22:47
