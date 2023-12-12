-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: junta_cartago_centro
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `control_documento`
--

DROP TABLE IF EXISTS `control_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `control_documento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_documento` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_documento` (`id_documento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `control_documento`
--

LOCK TABLES `control_documento` WRITE;
/*!40000 ALTER TABLE `control_documento` DISABLE KEYS */;
/*!40000 ALTER TABLE `control_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento`
--

DROP TABLE IF EXISTS `documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `tipo_documento` varchar(191) NOT NULL,
  `descripcion` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento`
--

LOCK TABLES `documento` WRITE;
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
INSERT INTO `documento` VALUES (1,'Documento1','2023-01-01','Tipo1','Descripción del Documento 1','',1,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(2,'Documento2','2023-02-15','Tipo2','Descripción del Documento 2','',1,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(3,'Documento3','2023-03-10','Tipo1','Descripción del Documento 3','',0,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(4,'Documento4','2023-04-20','Tipo3','Descripción del Documento 4','',1,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(5,'Documento5','2023-05-05','Tipo2','Descripción del Documento 5','',0,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(6,'Documento6','2023-06-18','Tipo1','Descripción del Documento 6','',1,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(7,'Documento7','2023-07-22','Tipo3','Descripción del Documento 7','',1,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(8,'Documento8','2023-08-08','Tipo2','Descripción del Documento 8','',0,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(9,'Documento9','2023-09-30','Tipo1','Descripción del Documento 9','',1,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(10,'Documento10','2023-10-12','Tipo3','Descripción del Documento 10','',0,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(11,'Documento11','2023-11-25','Tipo2','Descripción del Documento 11','',1,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(12,'Documento12','2023-12-05','Tipo1','Descripción del Documento 12','',1,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(13,'Documento13','2024-01-08','Tipo3','Descripción del Documento 13','',0,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(14,'Documento14','2024-02-14','Tipo2','Descripción del Documento 14','',1,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(15,'Documento15','2024-03-19','Tipo1','Descripción del Documento 15','',0,'2023-12-09 22:21:27','2023-12-09 22:21:27',0),(16,'nameTest1','2023-12-10','2','Desc','',1,'2023-12-11 02:46:27','2023-12-11 02:46:27',0),(17,'Prueba','2023-12-10','4','Prueba2','archivos/1702265445G4_SC60_J_Historias_De_Usuario.xlsx',1,'2023-12-11 03:31:09','2023-12-11 03:31:09',0);
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `estado` int NOT NULL,
  `fecha` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin',1,'2023-12-11 03:37:07'),(2,'user',1,'2023-12-11 03:37:07');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `apellido` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cedula` varchar(9) NOT NULL,
  `correo` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `estado` int NOT NULL,
  `rol` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `rol` (`rol`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Eduardo','Flores','117490538','test@test.com','3d35b9cf36e4c5b56c13bdc336c39df4',1,'1','2023-12-09 22:02:39','2023-12-09 22:02:39'),(3,'Juanito','Pérez','123456789','juanito@juanito.com','3d35b9cf36e4c5b56c13bdc336c39df4',1,'2','2023-12-10 00:26:54','2023-12-10 00:26:54');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-11  0:23:58
