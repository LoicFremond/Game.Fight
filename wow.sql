-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: game
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `characters`
--

DROP TABLE IF EXISTS `characters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `characters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `picture` varchar(55) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `characters`
--

LOCK TABLES `characters` WRITE;
/*!40000 ALTER TABLE `characters` DISABLE KEYS */;
INSERT INTO `characters` VALUES (2,'Anduin','/public/pictures/anduin.jpg','Pretre'),(3,'Jaina','/public/pictures/jaina.jpg','Mage'),(4,'Guldan','/public/pictures/Guldan.jpg','Demoniste'),(5,'Varian','/public/pictures/varian.jpg','Guerrier'),(6,'Arthas','/public/pictures/arthas.jpg','Paladin'),(9,'Lili','/public/pictures/lili.png','Moine'),(10,'Thrall','/public/pictures/thrall.jpg','Chaman'),(11,'Sylvanas','/public/pictures/sylvanas.png','Chasseur'),(12,'Garona','/public/pictures/garona.jpg','Voleur'),(13,'Malfurion','/public/pictures/malfurion.jpg','Druide'),(14,'Illidan','/public/pictures/illidan.jpg','DemonHunter'),(15,'Mograine','/public/pictures/mograine.jpg','DeathKnight');
/*!40000 ALTER TABLE `characters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `characters2`
--

DROP TABLE IF EXISTS `characters2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `characters2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `picture` text,
  `type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `characters2`
--

LOCK TABLES `characters2` WRITE;
/*!40000 ALTER TABLE `characters2` DISABLE KEYS */;
INSERT INTO `characters2` VALUES (2,'Anduin','/public/pictures/anduin.jpg','Pretre'),(3,'Jaina','/public/pictures/jaina.jpg','Mage'),(4,'Guldan','/public/pictures/Guldan.jpg','Demoniste'),(5,'Varian','/public/pictures/varian.jpg','Guerrier'),(6,'Arthas','/public/pictures/arthas.jpg','Paladin'),(9,'Lili','/public/pictures/lili.png','Moine'),(10,'Thrall','/public/pictures/thrall.jpg','Chaman'),(11,'Sylvanas','/public/pictures/sylvanas.png','Chasseur'),(12,'Garona','/public/pictures/garona.jpg','Voleur'),(13,'Malfurion','/public/pictures/malfurion.jpg','Druide'),(14,'Illidan','/public/pictures/illidan.jpg','DemonHunter'),(15,'Mograine','/public/pictures/mograine.jpg','DeathKnight');
/*!40000 ALTER TABLE `characters2` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-01 11:25:47
