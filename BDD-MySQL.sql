-- MySQL dump 10.18  Distrib 10.3.27-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: messagerie
-- ------------------------------------------------------
-- Server version	10.3.27-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` varchar(10) NOT NULL,
  `Heure` varchar(30) NOT NULL,
  `Auteur` varchar(50) NOT NULL,
  `Message` varchar(200) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (1,'01/04/2020','22:55:53','Mathis','Bonjour à tous !');
INSERT INTO `chat` VALUES (2,'01/04/2020','22:59:27','Mathis','Vous allez bien ?');
INSERT INTO `chat` VALUES (3,'01/04/2020','22:59:44','Benjamin','Oui bonjour bonsoir');
INSERT INTO `chat` VALUES (4,'01/04/2020','22:59:52','Mathis','Incroyable');
INSERT INTO `chat` VALUES (5,'01/04/2020','23:00:16','Benjamin','C\'est beau la technologie');
INSERT INTO `chat` VALUES (6,'01/04/2020','23:00:32','Mathis','Ouais, c\'est trop bien !');
INSERT INTO `chat` VALUES (7,'01/04/2020','23:01:59','Mathis','👌');
INSERT INTO `chat` VALUES (8,'01/04/2020','23:02:48','lorenzo',' salut la commu');
INSERT INTO `chat` VALUES (9,'01/04/2020','23:03:16','Mathis','Beaucoup d’interactions dans ce tchat !');
INSERT INTO `chat` VALUES (10,'01/04/2020','23:23:34','Benjamin','N\'hésitez pas à interagir dans le chat');
INSERT INTO `chat` VALUES (11,'28/04/2020','10:54:19','WALID','BONJOUR');
INSERT INTO `chat` VALUES (12,'28/04/2020','10:54:22','WALID','CECI EST UN TEST ');
INSERT INTO `chat` VALUES (13,'28/04/2020','10:54:34','WALID','CA MARCHE ');
INSERT INTO `chat` VALUES (14,'28/04/2020','10:54:50','WALID','JE TESTE ENCORE');
INSERT INTO `chat` VALUES (15,'28/04/2020','10:55:42','WALID','IL Y A PLUS DE 10 MESSAGES AFFICHE');
INSERT INTO `chat` VALUES (16,'28/04/2020','10:57:20','WALID','IL FAUT QUE CA FONCTIONNE SANS RAFRAICHIR LA PAGE');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-01  0:00:01
