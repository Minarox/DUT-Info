-- MySQL dump 10.18  Distrib 10.3.27-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cabinet
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
-- Table structure for table `Authentification`
--

DROP TABLE IF EXISTS `Authentification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Authentification` (
  `Pseudo` varchar(10) NOT NULL,
  `Mdp` varchar(10) NOT NULL,
  PRIMARY KEY (`Pseudo`,`Mdp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Authentification`
--

LOCK TABLES `Authentification` WRITE;
/*!40000 ALTER TABLE `Authentification` DISABLE KEYS */;
INSERT INTO `Authentification` VALUES ('Secretaire','MotDePasse');
/*!40000 ALTER TABLE `Authentification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Medecin`
--

DROP TABLE IF EXISTS `Medecin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Medecin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Civilite` varchar(3) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Medecin`
--

LOCK TABLES `Medecin` WRITE;
/*!40000 ALTER TABLE `Medecin` DISABLE KEYS */;
INSERT INTO `Medecin` VALUES (4,'Mr','Balkany','Patrick');
INSERT INTO `Medecin` VALUES (8,'MMe','Isabelle','Isabelle');
/*!40000 ALTER TABLE `Medecin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RendezVous`
--

DROP TABLE IF EXISTS `RendezVous`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RendezVous` (
  `Date_RDV` date NOT NULL,
  `Heure` time NOT NULL,
  `Id_Usager` int(11) NOT NULL,
  `Id_Medecin` varchar(50) NOT NULL,
  `Duree` smallint(6) NOT NULL,
  PRIMARY KEY (`Date_RDV`,`Heure`,`Id_Usager`,`Id_Medecin`),
  KEY `FK_Usager` (`Id_Usager`),
  KEY `FK_Medecin` (`Id_Medecin`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RendezVous`
--

LOCK TABLES `RendezVous` WRITE;
/*!40000 ALTER TABLE `RendezVous` DISABLE KEYS */;
INSERT INTO `RendezVous` VALUES ('2020-01-11','15:55:00',34,'4',30);
INSERT INTO `RendezVous` VALUES ('2020-01-17','15:40:00',35,'4',30);
INSERT INTO `RendezVous` VALUES ('2020-01-18','15:55:00',34,'8',30);
INSERT INTO `RendezVous` VALUES ('2020-01-20','12:00:00',34,'4',30);
INSERT INTO `RendezVous` VALUES ('2020-01-20','12:20:00',39,'4',30);
INSERT INTO `RendezVous` VALUES ('2020-01-21','12:30:00',34,'4',30);
INSERT INTO `RendezVous` VALUES ('2020-01-31','15:17:00',34,'4',30);
/*!40000 ALTER TABLE `RendezVous` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usager`
--

DROP TABLE IF EXISTS `Usager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usager` (
  `Id_Usager` int(11) NOT NULL AUTO_INCREMENT,
  `Civilite` varchar(3) DEFAULT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL,
  `Date_Naissance` date DEFAULT NULL,
  `Adresse` varchar(50) DEFAULT NULL,
  `Ville` varchar(50) DEFAULT NULL,
  `Code_Postal` varchar(5) DEFAULT NULL,
  `Lieu_Naissance` varchar(50) DEFAULT NULL,
  `Num_Securite_Sociale` bigint(11) DEFAULT NULL,
  `Medecin_T` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Usager`),
  KEY `fk_id_medecin` (`Medecin_T`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usager`
--

LOCK TABLES `Usager` WRITE;
/*!40000 ALTER TABLE `Usager` DISABLE KEYS */;
INSERT INTO `Usager` VALUES (34,'Mr','Benalla','Alexandre','1991-09-08','Dans un bel appartement','Paris','75000','Evreux',45887587895,4);
INSERT INTO `Usager` VALUES (35,'MMe','LeCrayon','Marine','1968-08-05','EnFrance','Paris','75003','Neuilly-sur-Seine',55555555555,NULL);
INSERT INTO `Usager` VALUES (38,'Mr','sdfg','sdfg','2020-01-06','sdfg','sdfg','31320','sdfg',11111111111,NULL);
INSERT INTO `Usager` VALUES (39,'Mr','Emmanuel','Marron','1977-12-21','LaBanque','Paris','75006','Amienssdfgsdfg',45875687584,4);
/*!40000 ALTER TABLE `Usager` ENABLE KEYS */;
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
