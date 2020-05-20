-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: panda_news
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (2,'fdas','alert(&amp;amp;quot;Hello! I am an alert box!!&amp;amp;quot;);2',1,'2020-05-18 17:20:40','2020-05-18 18:53:21'),(7,'test','test',1,'2020-05-18 18:36:11','2020-05-18 18:36:11'),(8,'test','alert(&quot;Hello! I am an alert box!!&quot;);',1,'2020-05-18 19:54:35','2020-05-18 19:54:35');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `password` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_uindex` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (19,'Michał','Pikosz','emailupdate17@gmail.com','male',1,'$2y$10$XxORVfJCRS6ChxOHCyhDE.8GjnUEnXzuPEEzxf6R85oQ4Aue.vbNm','2020-05-17 02:57:49','2020-05-17 02:57:49'),(21,'Michał','Pikosz','emailupdate18@gmail.com','male',1,'$2y$10$FpdgrZbl2SObguulFDYRbuLo2mRKNYjM742zM3nQ4EeZajRfBQE1y','2020-05-17 03:00:06','2020-05-17 03:00:06'),(23,'Michał','Pikosz','emailupdate19@gmail.com','male',1,'$2y$12$OssM8Db2iRnk33UcsaRhueZ76u3LW44UmvSQI7OQOrxRjaJ.c6Wpm','2020-05-17 03:02:01','2020-05-17 03:02:01'),(24,'Michał','Pikosz','emailupdate20@gmail.com','male',1,'$2y$12$OFBFDs10py4fhBkZP5JNNeT24CMpTr.ppj4qSNek3nFiqwmn2zT8G','2020-05-17 03:02:44','2020-05-17 03:02:44'),(25,'Michał','Pikosz','emailupdate21@gmail.com','male',1,'$2y$12$wjERORqYc0NnRBv5ZLMMmu9PJbHfRmYCmtgGsFrL0aUWjB8F39n/u','2020-05-17 03:11:12','2020-05-17 03:11:12'),(26,'Michał','Pikosz','emailupdate22@gmail.com','male',1,'$2y$12$nSZdrmqlZVypuGmP/.Cch.ccGPdJUCXcHqJ3zl81zJn3msjU8mqY.','2020-05-17 03:18:33','2020-05-17 03:18:33'),(28,'Michał','Pikosz','emailupdate23@gmail.com','male',1,'$2y$10$DOlUpF.Bd8f5PPlGyIisSeTfun.8RXXMUXU5vtEw3JpLkZecGvrZm','2020-05-17 03:45:39','2020-05-17 03:45:39'),(29,'Michał','Pikosz','emailupdate24@gmail.com','male',1,'$2y$10$VYT4ioTZkAH2MjYlyKhEwOwJoqSyvz43sqlChgUuwBTRtk/lYcX.O','2020-05-17 03:49:51','2020-05-17 03:49:51'),(30,'Michał','Pikosz','dfsafads@dfsafds.pl','male',1,'Qwer1234','2020-05-18 12:02:18','2020-05-18 12:02:18'),(32,'Michał','Pikosz','admin@admin.pl','male',1,'Qwer1234','2020-05-18 12:03:04','2020-05-18 12:03:04'),(34,'Michał','Pikosz','admin2@admin.pl','male',1,'Qwer1234','2020-05-18 12:03:12','2020-05-18 12:03:12'),(36,'Michał','Pikosz','admin23@admin.pl','male',1,'Qwer1234','2020-05-18 12:03:20','2020-05-18 12:03:20'),(38,'Michał','Pikosz','admin24@admin.pl','male',1,'Qwer1234','2020-05-18 12:05:38','2020-05-18 12:05:38'),(39,'Michał','','admin25@gmail.com','male',1,'Qwer1234','2020-05-18 12:08:48','2020-05-18 12:08:48'),(40,'Michał','','','male',1,'Qwer1234','2020-05-18 12:09:05','2020-05-18 12:09:05'),(41,'Michał','Pikosz','mpikosz@gmail.com','male',1,'Qwer1234','2020-05-18 12:54:49','2020-05-18 12:54:49'),(43,'','','admin','male',1,'Kenan12!','2020-05-18 13:05:53','2020-05-18 13:05:53'),(54,'','','admin@fdsafdas.pl','male',1,'Kenan12!','2020-05-18 13:12:23','2020-05-18 13:12:23'),(55,'Michał','Pikosz','admin@admin.plpl','male',1,'Kenan12!','2020-05-18 13:18:16','2020-05-18 13:18:16'),(64,'Michał','Pikosz','emailannona200@gmail.com','male',1,'Qwer1234','2020-05-18 18:09:42','2020-05-18 18:09:42'),(65,'Justyna','Kupa','jusia@o2.pl','female',1,'Jusia0204','2020-05-18 18:11:43','2020-05-18 18:11:43'),(66,'fdsafds','fdsa','fdsafdsa','male',1,'$2y$10$pPanzLL0GRLghFpotPR/MetVwTPlrHngPpf1qCh.XmF56L0cxrOt2','2020-05-18 18:17:52','2020-05-18 18:17:52'),(67,'test','test','test@test.eu','male',1,'$2y$10$0QKOxasWIbD68/dXKspiquImWls.d98GaKvRGaTYOdZUEH072LYYe','2020-05-18 18:49:56','2020-05-18 18:49:56');
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

-- Dump completed on 2020-05-20 12:30:00
