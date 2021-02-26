-- MySQL dump 10.17  Distrib 10.3.25-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: chatter
-- ------------------------------------------------------
-- Server version	10.3.25-MariaDB-0ubuntu0.20.04.1

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
-- Table structure for table `uzytkownicy`
--

DROP TABLE IF EXISTS `uzytkownicy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imie` varchar(40) NOT NULL,
  `nazwisko` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `dataUtworzenia` datetime NOT NULL,
  `jestDostepny` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uzytkownicy`
--

LOCK TABLES `uzytkownicy` WRITE;
/*!40000 ALTER TABLE `uzytkownicy` DISABLE KEYS */;
INSERT INTO `uzytkownicy` VALUES (1,'Robert','Lato','robert@lato.pl','$2y$10$Ho4nfbCaRVIq0fOrkmWvLOxJ5yG6n.2a5rPRf6emdO0ThvxEkJRTq','defaultpicture.jpg','2021-01-25 00:30:03',0),(2,'Jan','Kowalski','jan@kowalski.pl','$2y$10$B.rl3gi/Sw1vg7YMz1RJCud2BGMLrVigKrhERb862XWi55V4QwW/2','defaultpicture.jpg','2021-01-25 00:30:23',0),(3,'Beata','Iksinska','beata@iksinska.pl','$2y$10$xv4kxWBiFtQASlWWOw7TB.as9dUQvMcQA7OWBidvMeKmRafKsNc.O','defaultpicture.jpg','2021-01-25 00:30:45',0),(4,'Damian','Nowak','damian@nowak.pl','$2y$10$0zm5SMkHfVy0R.PIuvKQZuquw1uX0UvLdJ7Yy.HaguVaL2MNPq31y','defaultpicture.jpg','2021-01-25 00:30:57',0),(5,'Agata','Kowalska','agata@kowalska.pl','$2y$10$T5FiZouBIoyvA6uhpBWAvudVF6SVHL2WsHNGyoirstY6q4NP7GXnK','defaultpicture.jpg','2021-01-25 00:31:16',0);
/*!40000 ALTER TABLE `uzytkownicy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiadomosci`
--

DROP TABLE IF EXISTS `wiadomosci`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiadomosci` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idNadawcy` int(11) NOT NULL,
  `idOdbiorcy` int(11) NOT NULL,
  `wiadomosc` varchar(255) NOT NULL,
  `dataUtworzenia` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiadomosci`
--

LOCK TABLES `wiadomosci` WRITE;
/*!40000 ALTER TABLE `wiadomosci` DISABLE KEYS */;
INSERT INTO `wiadomosci` VALUES (1,1,2,'cześć Jan!','2021-01-25 00:32:57'),(2,1,2,'testuje 123','2021-01-25 00:33:11'),(3,2,1,'hej, ja też testuje','2021-01-25 00:33:33'),(4,2,1,'test 123','2021-01-25 00:33:37'),(5,1,2,'kolejny test','2021-01-25 00:33:44');
/*!40000 ALTER TABLE `wiadomosci` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `znajomi`
--

DROP TABLE IF EXISTS `znajomi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `znajomi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idNadawcy` int(11) NOT NULL,
  `idOdbiorcy` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_relationship` (`idNadawcy`,`idOdbiorcy`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `znajomi`
--

LOCK TABLES `znajomi` WRITE;
/*!40000 ALTER TABLE `znajomi` DISABLE KEYS */;
INSERT INTO `znajomi` VALUES (1,1,2,1),(2,1,3,1),(3,2,3,1),(4,1,4,1),(5,1,5,0);
/*!40000 ALTER TABLE `znajomi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-25  0:36:55
