-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: quiz_db
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
-- Table structure for table `alternativas`
--

DROP TABLE IF EXISTS `alternativas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alternativas` (
  `id_alternativa` int(11) NOT NULL AUTO_INCREMENT,
  `id_questao` int(11) DEFAULT NULL,
  `texto` varchar(255) NOT NULL,
  `correta` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_alternativa`),
  KEY `id_questao` (`id_questao`),
  CONSTRAINT `alternativas_ibfk_1` FOREIGN KEY (`id_questao`) REFERENCES `questoes` (`id_questao`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alternativas`
--

LOCK TABLES `alternativas` WRITE;
/*!40000 ALTER TABLE `alternativas` DISABLE KEYS */;
INSERT INTO `alternativas` VALUES (1,1,'a)  depressÃ£o.',0),(2,1,'b)  dobra.',1),(3,1,'c)  falÃ©sia.',0),(4,1,'d)  coxilha.',0),(5,2,'as correntes de convecÃ§Ã£o da Ã¡gua oceÃ¢nica e a manutenÃ§Ã£o da temperatura corporal.',0),(6,2,' as correntes de conduÃ§Ã£o do magma e a manutenÃ§Ã£o da respiraÃ§Ã£o cutÃ¢nea',0),(7,2,'as correntes de convecÃ§Ã£o do magma e a manutenÃ§Ã£o da respiraÃ§Ã£o cutÃ¢nea.',1),(8,2,' as correntes de convecÃ§Ã£o do magma e a manutenÃ§Ã£o da respiraÃ§Ã£o pulmonar.',0),(9,3,'a convenÃ§Ã£o cartogrÃ¡fica, conjunto de regras que busca garantir a neutralidade de um mapa.',0),(10,3,'  o etnocentrismo, doutrina socioespacial que defende simetria entre diferentes paÃ­ses em um mapa-mÃºndi.',0),(11,3,'o eurocentrismo, visÃ£o de mundo que institui a Europa enquanto parte central e superior do mapa-mÃºndi.',1),(12,3,'a orientaÃ§Ã£o espacial, relaÃ§Ã£o que usa a latitude e a longitude para oferecer precisÃ£o na construÃ§Ã£o de um mapa.',0),(13,4,'a ciclagem de nutrientes e o combate Ã  erosÃ£o.',1),(14,4,' o processo de litificaÃ§Ã£o e a estratificaÃ§Ã£o dos horizontes.',0),(15,4,'a formaÃ§Ã£o de voÃ§orocas e o incremento do intemperismo.',0),(16,4,'a retenÃ§Ã£o de umidade e a interrupÃ§Ã£o da pedogÃªnese.',0),(17,5,' buscarem novos encontros.',0),(18,5,' fugirem da prÃ³pria identidade.',1),(19,5,' procurarem lugares inexplorados.',0),(20,5,' partirem em experiÃªncias inusitadas.',0),(21,6,' sinais indicativos da doenÃ§a.',1),(22,6,' Ã­ndice de crescimento de casos.',0),(23,6,'exames para diagnÃ³stico do tumor.',0),(24,6,'mitos a respeito da heranÃ§a genÃ©tica.',0),(25,7,'provoca dispersÃ£o da atenÃ§Ã£o em seu pÃºblico.',0),(26,7,'funciona por meio de uma frequÃªncia de ondas curtas.',0),(27,7,'propicia divulgaÃ§Ã£o de conteÃºdo para seus usuÃ¡rios.',1),(28,7,' tem um formato inteiramente semelhante ao das redes sociais.',0),(29,8,' personificaÃ§Ã£o.',0),(30,8,'antÃ­tese.',0),(31,8,'eufemismo.',0),(32,8,' hipÃ©rbole.',1),(33,9,' representa uma histÃ³ria paralela ligada a uma histÃ³ria principal.',0),(34,9,' hÃ¡ apenas um conflito que se resolve em pouco tempo.',0),(35,9,'possui estrutura simples e apresenta um cunho pedagÃ³gico.',0),(36,9,'Ã© uma narrativa breve que comenta um evento do cotidiano',1),(37,10,'a alta de preÃ§os',0),(38,10,'a polÃ­tica clientelista',0),(39,10,'as reformas urbanas',0),(40,10,'o arbÃ­trio governamental.',1),(41,11,'56',0),(42,11,'58',0),(43,11,'62',1),(44,11,'60',0),(45,12,' V e IV.',1),(46,12,' I e IV.',0),(47,12,'I e V.',0),(48,12,'V e I.',0),(49,13,'8250.',0),(50,13,'7920.',0),(51,13,' 6545.',0),(52,13,' 5500.',1),(53,14,' 12,50',0),(54,14,'20,00',0),(55,14,' 24,00',1),(56,14,' 30,00',0),(57,15,'147,00',0),(58,15,'150,00',0),(59,15,'162,50',1),(60,15,'165,75',0),(61,16,'  11 520.',0),(62,16,' 14 400.',1),(63,16,' 18 000.',0),(64,16,'  390 000.',0),(65,17,'4',0),(66,17,'5',1),(67,17,'6',0),(68,17,'19',0),(69,18,'I, pois o valor Ã© R$ 7,00.',1),(70,18,'I, pois o valor Ã© R$ 4,00.',0),(71,18,' II, pois o valor Ã© R$ 6,00.',0),(72,18,' II, pois o componente X, que Ã© o mais utilizado, tem menor preÃ§o.',0),(73,19,'24',0),(74,19,' 35',0),(75,19,' 555',0),(76,19,'1110',1),(77,20,' 3 x 219',1),(78,20,' 3 x 220',0),(79,20,'3 x 221',0),(80,20,' 3 x 220 - 1',0),(81,21,'13525,0',0),(82,21,'135,25',0),(83,21,'13,525',0),(84,21,'1,3525',1),(85,22,' Soberania popular.',1),(86,22,' DivisÃ£o de classes.',0),(87,22,'AcÃºmulo de capital.',0),(88,22,' Defesa da propriedade.',0),(89,23,'ValorizaÃ§Ã£o da economia local.',1),(90,23,'ElaboraÃ§Ã£o de projetos culturais.',0),(91,23,' Estabelecimento de regras comerciais.',0),(92,23,' Incremento da infraestrutura educacional.',0),(93,24,' a fragilidade da gestÃ£o empresarial horizontal, explicitamente no controle dos trabalhadores nas linhas de produÃ§Ã£o.',0),(94,24,'a precarizaÃ§Ã£o do trabalho, sobretudo nos paÃ­ses em que se esperam baixos custos de produÃ§Ã£o.',1),(95,24,'a baixa qualificaÃ§Ã£o da mÃ£o de obra empregada nas fÃ¡bricas, especialmente em setores produtivos modernos.',0),(96,24,'avanÃ§o do meio tÃ©cnico-cientÃ­fico-informacional, particularmente no desinteresse pelo emprego da forÃ§a humana.',0),(97,25,' situaÃ§Ã£o de revolta individual.',0),(98,25,' satisfaÃ§Ã£o de desejos pessoais.',0),(99,25,'participaÃ§Ã£o em aÃ§Ãµes decisÃ³rias.',1),(100,25,' permanÃªncia em passividade social.',0),(101,26,' ruptura de valores institucionalizados.',1),(102,26,'negaÃ§Ã£o da ideia de subjetividade.',0),(103,26,'aceitaÃ§Ã£o da hierarquia de gÃªnero.',0),(104,26,'consolidaÃ§Ã£o da estratificaÃ§Ã£o social.',0),(105,27,'RejeiÃ§Ã£o de costumes elitistas.',0),(106,27,' RepulsÃ£o de condutas misÃ³ginas.',0),(107,27,' CondenaÃ§Ã£o do preconceito racial.',1),(108,27,' CriminalizaÃ§Ã£o de prÃ¡ticas homofÃ³bicas.',0),(109,28,' cultura do cancelamento.',0),(110,28,'prÃ¡tica do feminicÃ­dio.',1),(111,28,'aÃ§Ã£o involuntÃ¡ria.',0),(112,28,'defesa da honra.',0),(113,29,'valorizaÃ§Ã£o do trabalho braÃ§al.',0),(114,29,'reiteraÃ§Ã£o das hierarquias sociais.',1),(115,29,' sacralizaÃ§Ã£o das atividades laborais.',0),(116,29,' superaÃ§Ã£o das exclusÃµes econÃ´micas.',0),(117,30,'flexibilizaÃ§Ã£o do CÃ³digo Civil.',0),(118,30,'promoÃ§Ã£o da inclusÃ£o social.',1),(119,30,' reduÃ§Ã£o da maioridade penal.',0),(120,30,'expansÃ£o do perÃ­odo de reclusÃ£o.',0);
/*!40000 ALTER TABLE `alternativas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-22 11:57:11
