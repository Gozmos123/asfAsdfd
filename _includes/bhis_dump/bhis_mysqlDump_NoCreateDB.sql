-- MySQL dump 10.13  Distrib 5.7.40, for Win64 (x86_64)
--
-- Host: localhost    Database: bhis
-- ------------------------------------------------------
-- Server version	5.7.40-log

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
-- Table structure for table `childrens`
--

DROP TABLE IF EXISTS `childrens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `childrens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `prefix` varchar(10) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `age` varchar(20) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `highest_educ_attainment` varchar(255) DEFAULT NULL,
  `birthplace` longtext NOT NULL,
  `religion` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(12) DEFAULT NULL,
  `disability` varchar(255) NOT NULL,
  `mother_id` bigint(20) unsigned NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Childrens_mother_id_Mothers_id` (`mother_id`),
  KEY `FK_Childrens_last_user_Users_username` (`last_user`),
  KEY `FK_Childrens_religion_Religions_religion_name` (`religion`),
  KEY `FK_Childrens_CivilStatus_civil_status` (`civil_status`),
  CONSTRAINT `FK_Childrens_CivilStatus_civil_status` FOREIGN KEY (`civil_status`) REFERENCES `civil_status` (`civil_status`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Childrens_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Childrens_mother_id_Mothers_id` FOREIGN KEY (`mother_id`) REFERENCES `mothers` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Childrens_religion_Religions_religion_name` FOREIGN KEY (`religion`) REFERENCES `religions` (`religion_name`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `childrens`
--

LOCK TABLES `childrens` WRITE;
/*!40000 ALTER TABLE `childrens` DISABLE KEYS */;
/*!40000 ALTER TABLE `childrens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `civil_status`
--

DROP TABLE IF EXISTS `civil_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `civil_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `civil_status` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `civil_status` (`civil_status`),
  KEY `FK_CivilStatus_last_user_Users_username` (`last_user`),
  CONSTRAINT `FK_CivilStatus_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `civil_status`
--

LOCK TABLES `civil_status` WRITE;
/*!40000 ALTER TABLE `civil_status` DISABLE KEYS */;
INSERT INTO `civil_status` VALUES (1,'Single','2023-03-06 11:45:44','2023-03-06 11:45:44','admin'),(2,'Married','2023-03-06 11:45:44','2023-03-06 11:45:44','admin'),(3,'Widowed','2023-03-06 11:45:44','2023-03-06 11:45:44','admin'),(4,'Divorced/Separated','2023-03-06 11:45:44','2023-03-06 11:45:44','admin'),(5,'Annulled','2023-03-06 11:45:44','2023-03-06 11:45:44','admin'),(6,'Common-law/Live-in','2023-03-06 11:45:44','2023-03-06 11:45:44','admin'),(7,'Unknown','2023-03-06 11:45:44','2023-03-06 11:45:44','admin');
/*!40000 ALTER TABLE `civil_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deworms`
--

DROP TABLE IF EXISTS `deworms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deworms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `children_id` bigint(20) unsigned NOT NULL,
  `place_given` longtext NOT NULL,
  `date_given` date DEFAULT NULL,
  `given_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Deworms_last_user_Users_username` (`last_user`),
  KEY `FK_Deworms_children_id_Childrens_id` (`children_id`),
  CONSTRAINT `FK_Deworms_children_id_Childrens_id` FOREIGN KEY (`children_id`) REFERENCES `childrens` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Deworms_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deworms`
--

LOCK TABLES `deworms` WRITE;
/*!40000 ALTER TABLE `deworms` DISABLE KEYS */;
/*!40000 ALTER TABLE `deworms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `immunizations`
--

DROP TABLE IF EXISTS `immunizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `immunizations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `children_id` bigint(20) unsigned NOT NULL,
  `vaccine_name` varchar(255) NOT NULL,
  `dose` varchar(50) NOT NULL,
  `date_given` date DEFAULT NULL,
  `immunization_type` varchar(100) NOT NULL,
  `administered_by` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Immunizations_last_user_Users_username` (`last_user`),
  KEY `FK_Immunizations_children_id_Childrens_id` (`children_id`),
  KEY `FK_Immunizations_ImmunizationsType` (`immunization_type`),
  CONSTRAINT `FK_Immunizations_ImmunizationsType` FOREIGN KEY (`immunization_type`) REFERENCES `immunizations_type` (`immunization_type`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Immunizations_children_id_Childrens_id` FOREIGN KEY (`children_id`) REFERENCES `childrens` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Immunizations_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `immunizations`
--

LOCK TABLES `immunizations` WRITE;
/*!40000 ALTER TABLE `immunizations` DISABLE KEYS */;
/*!40000 ALTER TABLE `immunizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `immunizations_type`
--

DROP TABLE IF EXISTS `immunizations_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `immunizations_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `immunization_type` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `immunization_type` (`immunization_type`),
  KEY `FK_ImmunizationsType_last_user_Users_username` (`last_user`),
  CONSTRAINT `FK_ImmunizationsType_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `immunizations_type`
--

LOCK TABLES `immunizations_type` WRITE;
/*!40000 ALTER TABLE `immunizations_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `immunizations_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mothers`
--

DROP TABLE IF EXISTS `mothers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mothers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(20) NOT NULL DEFAULT 'Female',
  `civil_status` varchar(25) NOT NULL,
  `highest_educ_attainment` varchar(255) DEFAULT NULL,
  `birthplace` longtext NOT NULL,
  `religion` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(12) DEFAULT NULL,
  `purok_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Mothers_Puroks_purok_name` (`purok_name`),
  KEY `FK_Mothers_last_user_Users_username` (`last_user`),
  KEY `FK_Mothers_religion_Religions_religion_name` (`religion`),
  KEY `FK_Mothers_CivilStatus_civil_status` (`civil_status`),
  CONSTRAINT `FK_Mothers_CivilStatus_civil_status` FOREIGN KEY (`civil_status`) REFERENCES `civil_status` (`civil_status`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Mothers_Puroks_purok_name` FOREIGN KEY (`purok_name`) REFERENCES `puroks` (`purok_name`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Mothers_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Mothers_religion_Religions_religion_name` FOREIGN KEY (`religion`) REFERENCES `religions` (`religion_name`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mothers`
--

LOCK TABLES `mothers` WRITE;
/*!40000 ALTER TABLE `mothers` DISABLE KEYS */;
/*!40000 ALTER TABLE `mothers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puroks`
--

DROP TABLE IF EXISTS `puroks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puroks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purok_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purok_name` (`purok_name`),
  KEY `FK_Puroks_last_user_Users_username` (`last_user`),
  CONSTRAINT `FK_Puroks_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puroks`
--

LOCK TABLES `puroks` WRITE;
/*!40000 ALTER TABLE `puroks` DISABLE KEYS */;
INSERT INTO `puroks` VALUES (1,'1','2023-03-06 11:45:44','2023-03-06 11:45:44','admin'),(2,'2','2023-03-06 11:45:44','2023-03-06 11:45:44','admin'),(3,'3','2023-03-06 11:45:44','2023-03-06 11:45:44','admin');
/*!40000 ALTER TABLE `puroks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `religions`
--

DROP TABLE IF EXISTS `religions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `religions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `religion_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `religion_name` (`religion_name`),
  KEY `FK_Religions_last_user_Users_username` (`last_user`),
  CONSTRAINT `FK_Religions_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `religions`
--

LOCK TABLES `religions` WRITE;
/*!40000 ALTER TABLE `religions` DISABLE KEYS */;
INSERT INTO `religions` VALUES (1,'Roman Catholic','2023-03-06 11:45:44','2023-03-06 11:45:44','admin');
/*!40000 ALTER TABLE `religions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_logs`
--

DROP TABLE IF EXISTS `user_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `action` varchar(255) NOT NULL,
  `content` longtext,
  `changes` longtext,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_UserLogs_Users_username` (`username`),
  CONSTRAINT `FK_UserLogs_Users_username` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_logs`
--

LOCK TABLES `user_logs` WRITE;
/*!40000 ALTER TABLE `user_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `user_type` varchar(25) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `prefix` varchar(10) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `birthplace` longtext NOT NULL,
  `religion` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(12) DEFAULT NULL,
  `purok_name` varchar(100) NOT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `FK_Users_Puroks_purok_name` (`purok_name`),
  KEY `FK_Users_religion_Religions_religion_name` (`religion`),
  CONSTRAINT `FK_Users_Puroks_purok_name` FOREIGN KEY (`purok_name`) REFERENCES `puroks` (`purok_name`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Users_religion_Religions_religion_name` FOREIGN KEY (`religion`) REFERENCES `religions` (`religion_name`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','836bc6397d06de5f635683cff01822564683b57c5298c38bd389628685d9ce9d74cba952fc80ac305a6dd1d122bb041dfa93377880d478f27b99da3fafc05bf6','administrator','uploads/undraw_profile_2.svg','Administrative',NULL,'User',NULL,'1990-01-01',33,'Male','Married','Catanduanes','Roman Catholic',NULL,NULL,'1',NULL,'2023-03-06 11:45:44','2023-03-06 11:45:44'),(2,'bhw','e4067370171a220c63003a03bee4a4da84ece058e9441a4c9a5206a33648438727685cb9cc601464f7b272f11430361d6f22bbcae62ea70b4c43d9cca4b24789','bhw','uploads/undraw_profile_1.svg','BHW',NULL,'User',NULL,'1990-01-01',33,'Female','Married','Catanduanes','Roman Catholic',NULL,NULL,'1',NULL,'2023-03-06 11:45:44','2023-03-06 11:45:44'),(3,'user','6ae2d3bfb3b95517b358fcdb29f7743246101ebf13f797d8244df795eec2d1d769a41c059dc37beadac8e40cecab4352764336a90302920ddeb1a6c6df4e8a00','user','uploads/undraw_profile_2.svg','Barangay',NULL,'User',NULL,'1990-01-01',33,'Male','Married','Catanduanes','Roman Catholic',NULL,NULL,'1',NULL,'2023-03-06 11:45:44','2023-03-06 11:45:44');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vitamins`
--

DROP TABLE IF EXISTS `vitamins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vitamins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `children_id` bigint(20) unsigned NOT NULL,
  `date_given` date DEFAULT NULL,
  `given_by` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Vitamins_last_user_Users_username` (`last_user`),
  KEY `FK_Vitamins_children_id_Childrens_id` (`children_id`),
  CONSTRAINT `FK_Vitamins_children_id_Childrens_id` FOREIGN KEY (`children_id`) REFERENCES `childrens` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Vitamins_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vitamins`
--

LOCK TABLES `vitamins` WRITE;
/*!40000 ALTER TABLE `vitamins` DISABLE KEYS */;
/*!40000 ALTER TABLE `vitamins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weights`
--

DROP TABLE IF EXISTS `weights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weights` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `children_id` bigint(20) unsigned NOT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `height` decimal(8,2) DEFAULT NULL,
  `nutrition_status` varchar(100) DEFAULT NULL,
  `checked_by` varchar(255) DEFAULT NULL,
  `date_checked` date NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Weights_last_user_Users_username` (`last_user`),
  KEY `FK_Weights_children_id_Childrens_id` (`children_id`),
  CONSTRAINT `FK_Weights_children_id_Childrens_id` FOREIGN KEY (`children_id`) REFERENCES `childrens` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Weights_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weights`
--

LOCK TABLES `weights` WRITE;
/*!40000 ALTER TABLE `weights` DISABLE KEYS */;
/*!40000 ALTER TABLE `weights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bhis'
--

--
-- Dumping routines for database 'bhis'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-06 11:46:24
