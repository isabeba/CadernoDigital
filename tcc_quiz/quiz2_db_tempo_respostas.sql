-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: quiz2_db
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `tempo_respostas`
--

DROP TABLE IF EXISTS `tempo_respostas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tempo_respostas` (
  `id_tempo` int(11) NOT NULL AUTO_INCREMENT,
  `id_resultado` int(11) DEFAULT NULL,
  `id_questao` int(11) DEFAULT NULL,
  `tempo_segundos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tempo`),
  KEY `id_resultado` (`id_resultado`),
  CONSTRAINT `tempo_respostas_ibfk_1` FOREIGN KEY (`id_resultado`) REFERENCES `resultados` (`id_resultado`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tempo_respostas`
--

LOCK TABLES `tempo_respostas` WRITE;
/*!40000 ALTER TABLE `tempo_respostas` DISABLE KEYS */;
INSERT INTO `tempo_respostas` VALUES (1,1,19,3),(2,1,11,2),(3,1,38,2),(4,1,4,2),(5,1,20,2),(6,1,22,3),(7,1,44,1),(8,1,27,3),(9,1,41,2),(10,1,10,2),(11,1,23,2),(12,1,35,2),(13,1,31,2),(14,1,36,2),(15,1,26,2),(16,1,3,2),(17,1,34,1),(18,1,46,1),(19,1,29,1),(20,1,13,4),(21,2,19,2),(22,2,11,1),(23,2,38,2),(24,2,4,2),(25,2,20,2),(26,2,22,2),(27,2,44,2),(28,2,27,2),(29,2,41,2),(30,2,10,2),(31,2,23,2),(32,2,35,2),(33,2,31,1),(34,2,36,1),(35,2,26,2),(36,2,3,2),(37,2,34,1),(38,2,46,2),(39,2,29,2),(40,2,13,2),(41,5,19,2),(42,5,11,2),(43,6,7,5),(44,6,18,1),(45,6,2,2),(46,6,44,2),(47,6,21,2),(48,6,40,3),(49,6,8,2),(50,6,4,4),(51,6,41,2),(52,6,13,2),(53,6,1,3),(54,6,28,2),(55,6,27,3),(56,6,33,2),(57,6,16,2),(58,6,34,1),(59,6,47,3),(60,6,19,2),(61,6,32,1),(62,6,39,1),(63,7,7,3),(64,7,18,2),(65,7,2,1),(66,7,44,2),(67,7,21,4),(68,7,40,2),(69,7,8,2),(70,7,4,2),(71,7,41,2),(72,7,13,2),(73,7,1,2),(74,7,28,2),(75,7,27,3),(76,7,33,1),(77,7,16,2),(78,7,34,1),(79,7,47,2),(80,7,19,2),(81,7,32,2),(82,7,39,1),(83,9,7,2),(84,9,18,5),(85,9,2,19),(86,9,44,4),(87,9,21,2),(88,9,40,2),(89,9,8,4),(90,9,4,3),(91,9,41,3),(92,9,13,3),(93,9,1,2),(94,9,28,2),(95,9,27,3),(96,9,33,1),(97,9,16,1),(98,9,34,2),(99,9,47,1),(100,9,19,2),(101,9,32,3),(102,9,39,2),(103,12,7,2),(104,12,18,1),(105,12,2,1),(106,12,44,3),(107,12,21,1),(108,12,40,1),(109,12,8,2),(110,12,4,1),(111,12,41,4),(112,12,13,1),(113,12,1,1),(114,12,28,2),(115,12,27,3),(116,12,33,2),(117,12,16,1),(118,12,34,2),(119,12,47,2),(120,12,19,1),(121,12,32,1),(122,12,39,2),(123,13,14,5),(124,13,58,4),(125,13,23,3),(126,13,18,3),(127,13,35,3),(128,13,11,3),(129,13,44,53),(130,13,46,27),(131,13,34,3),(132,13,29,2),(133,13,32,2),(134,13,48,3),(135,13,28,2),(136,13,1,3),(137,13,50,3);
/*!40000 ALTER TABLE `tempo_respostas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-17  7:13:57
