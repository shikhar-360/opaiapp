-- MySQL dump 10.13  Distrib 8.0.44, for Linux (x86_64)
--
-- Host: localhost    Database: opai_app
-- ------------------------------------------------------
-- Server version	8.0.44-0ubuntu0.24.04.2

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
-- Table structure for table `admin_audit_logs`
--

DROP TABLE IF EXISTS `admin_audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_audit_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` bigint unsigned DEFAULT NULL,
  `app_id` int NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id_x` (`admin_id`),
  KEY `model_id_x` (`model_id`),
  KEY `app_id` (`app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_audit_logs`
--

LOCK TABLES `admin_audit_logs` WRITE;
/*!40000 ALTER TABLE `admin_audit_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_tutorials`
--

DROP TABLE IF EXISTS `admin_tutorials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_tutorials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `resource_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'video',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `admin_tutorials_app_id_index` (`app_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_tutorials`
--

LOCK TABLES `admin_tutorials` WRITE;
/*!40000 ALTER TABLE `admin_tutorials` DISABLE KEYS */;
INSERT INTO `admin_tutorials` VALUES (1,1,'video','Getting Started','Admin Panel Overview','https://www.youtube-nocookie.com/embed/jfKfPfyJRdk',1,'2025-12-30 13:22:20','2025-12-30 13:22:20'),(2,1,'video','Support & Help','Account setup & basic overview','https://www.youtube-nocookie.com/embed/jfKfPfyJRdk',2,NULL,'2025-12-30 13:29:52'),(3,1,'video','How Promotions Work','Account setup & basic overview\r\n','https://www.youtube-nocookie.com/embed/jfKfPfyJRdk',2,NULL,NULL);
/*!40000 ALTER TABLE `admin_tutorials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_champions_income_plan`
--

DROP TABLE IF EXISTS `app_champions_income_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_champions_income_plan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `rank` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `directs` int unsigned NOT NULL DEFAULT '0',
  `team_volume` decimal(18,6) NOT NULL DEFAULT '0.000000',
  `points` decimal(18,6) NOT NULL DEFAULT '0.000000',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rank` (`rank`),
  KEY `app_id_x` (`app_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_champions_income_plan`
--

LOCK TABLES `app_champions_income_plan` WRITE;
/*!40000 ALTER TABLE `app_champions_income_plan` DISABLE KEYS */;
INSERT INTO `app_champions_income_plan` VALUES (1,1,'VIP1',10,1000.000000,200.000000,'2025-12-12 23:07:19','2025-12-12 23:07:19'),(2,1,'VIP2',20,2000.000000,400.000000,'2025-12-12 23:07:19','2025-12-12 23:07:19'),(3,1,'VIP3',30,3000.000000,600.000000,'2025-12-12 23:07:19','2025-12-12 23:07:19'),(4,1,'VIP4',40,4000.000000,800.000000,'2025-12-12 23:07:19','2025-12-12 23:07:19'),(5,1,'VIP5',50,5000.000000,1000.000000,'2025-12-12 23:07:19','2025-12-12 23:07:19');
/*!40000 ALTER TABLE `app_champions_income_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_fee_pool`
--

DROP TABLE IF EXISTS `app_fee_pool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_fee_pool` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `network_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_pool` decimal(10,4) NOT NULL,
  `reserved_amount` decimal(10,4) NOT NULL,
  `used_amount` decimal(10,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `app_fee_pool_app_id_foreign` (`app_id`),
  CONSTRAINT `app_fee_pool_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_fee_pool`
--

LOCK TABLES `app_fee_pool` WRITE;
/*!40000 ALTER TABLE `app_fee_pool` DISABLE KEYS */;
INSERT INTO `app_fee_pool` VALUES (1,1,'bsc',500.0000,0.0000,0.0000,'2026-01-13 12:25:44','2026-01-15 07:45:16');
/*!40000 ALTER TABLE `app_fee_pool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_leadership_income_plan`
--

DROP TABLE IF EXISTS `app_leadership_income_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_leadership_income_plan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `rank` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_volume` decimal(18,6) NOT NULL DEFAULT '0.000000',
  `points` decimal(18,6) NOT NULL DEFAULT '0.000000',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rank` (`rank`),
  KEY `app_id_x` (`app_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_leadership_income_plan`
--

LOCK TABLES `app_leadership_income_plan` WRITE;
/*!40000 ALTER TABLE `app_leadership_income_plan` DISABLE KEYS */;
INSERT INTO `app_leadership_income_plan` VALUES (1,1,'gold',1000.000000,30.000000,'2025-12-12 23:07:02','2025-12-12 23:07:02'),(2,1,'sapphire',2000.000000,60.000000,'2025-12-12 23:07:02','2025-12-12 23:07:02'),(3,1,'emerald',4000.000000,120.000000,'2025-12-12 23:07:02','2025-12-12 23:07:02'),(4,1,'ruby',8000.000000,250.000000,'2025-12-12 23:07:02','2025-12-12 23:07:02'),(5,1,'diamond',16000.000000,500.000000,'2025-12-12 23:07:02','2025-12-12 23:07:02');
/*!40000 ALTER TABLE `app_leadership_income_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_leadership_packages`
--

DROP TABLE IF EXISTS `app_leadership_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_leadership_packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `rank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` bigint unsigned DEFAULT NULL,
  `points` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rank` (`rank`),
  KEY `app_leadership_packages_app_id_index` (`app_id`),
  KEY `app_leadership_packages_volume_index` (`volume`),
  KEY `app_leadership_packages_points_index` (`points`),
  CONSTRAINT `app_leadership_packages_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_leadership_packages`
--

LOCK TABLES `app_leadership_packages` WRITE;
/*!40000 ALTER TABLE `app_leadership_packages` DISABLE KEYS */;
INSERT INTO `app_leadership_packages` VALUES (1,1,'gold',1000,30,'2025-12-10 02:09:28','2025-12-10 02:25:55'),(2,1,'sapphire',2000,60,'2025-12-10 02:09:28','2025-12-10 02:09:28'),(3,1,'emrald',4000,120,'2025-12-10 02:09:28','2025-12-10 02:09:28'),(4,1,'ruby',8000,250,'2025-12-10 02:09:28','2025-12-10 02:09:28'),(5,1,'diamond',16000,500,'2025-12-10 02:09:00','2025-12-10 02:09:00');
/*!40000 ALTER TABLE `app_leadership_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_level_packages`
--

DROP TABLE IF EXISTS `app_level_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_level_packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `level` int unsigned NOT NULL,
  `directs` int unsigned NOT NULL DEFAULT '0',
  `reward` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `app_level_packages_app_id_foreign` (`app_id`),
  KEY `level_x` (`level`),
  CONSTRAINT `app_level_packages_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_level_packages`
--

LOCK TABLES `app_level_packages` WRITE;
/*!40000 ALTER TABLE `app_level_packages` DISABLE KEYS */;
INSERT INTO `app_level_packages` VALUES (1,1,1,0,20.00,'2025-12-02 23:23:04','2026-01-06 09:52:18'),(2,1,2,1,10.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(3,1,3,2,5.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(4,1,4,2,4.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(5,1,5,3,10.00,'2025-12-02 23:23:04','2025-12-12 04:34:29'),(6,1,6,3,3.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(7,1,7,4,3.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(8,1,8,4,2.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(9,1,9,5,2.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(10,1,10,5,10.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(11,1,11,6,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(12,1,12,6,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(13,1,13,7,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(14,1,14,7,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(15,1,15,8,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(16,1,16,8,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(17,1,17,9,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(18,1,18,9,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(19,1,19,10,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(20,1,20,10,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04');
/*!40000 ALTER TABLE `app_level_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_packages`
--

DROP TABLE IF EXISTS `app_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `plan_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `roi_percent` decimal(5,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `app_packages_app_id_index` (`app_id`),
  KEY `app_packages_plan_code_index` (`plan_code`),
  CONSTRAINT `app_packages_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_packages`
--

LOCK TABLES `app_packages` WRITE;
/*!40000 ALTER TABLE `app_packages` DISABLE KEYS */;
INSERT INTO `app_packages` VALUES (1,1,'P1',5.00,0.50,1,'2025-12-02 01:17:05','2026-01-13 12:35:22'),(2,1,'P2',10.00,1.00,1,'2025-12-02 01:17:05','2025-12-02 01:17:05'),(3,1,'P3',25.00,1.50,1,'2025-12-02 01:17:05','2025-12-12 04:34:43'),(4,1,'P4',50.00,2.00,1,'2025-12-02 01:17:05','2025-12-02 01:17:05'),(5,1,'Free',100000.00,0.00,1,'2025-12-02 01:17:05','2025-12-02 01:17:05');
/*!40000 ALTER TABLE `app_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_promotion_packages`
--

DROP TABLE IF EXISTS `app_promotion_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_promotion_packages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `app_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_beneficiaries` int NOT NULL DEFAULT '0',
  `directs` int DEFAULT NULL,
  `package` text COLLATE utf8mb4_general_ci,
  `package_benefits` text COLLATE utf8mb4_general_ci,
  `benefit_levels` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_promotion_packages`
--

LOCK TABLES `app_promotion_packages` WRITE;
/*!40000 ALTER TABLE `app_promotion_packages` DISABLE KEYS */;
INSERT INTO `app_promotion_packages` VALUES (1,1,'HEAD START 1000',1000,3,'[5,10]','[5,10]','[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]','2025-12-17 05:05:43','2025-12-17 05:05:43'),(2,1,'HEAD START 500',500,2,'[25,50]','[25,50]','[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]','2025-12-17 05:05:43','2025-12-17 05:05:43'),(3,1,'HEAD START 10X',1000,10,'[25,50]','[25]','[]','2025-12-17 10:44:27','2025-12-17 10:44:27'),(4,1,'FOUNDERS CLUB 5000',5000,10,'[5,10,25,50]','[25]','[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]','2025-12-17 10:46:34','2025-12-17 10:46:34');
/*!40000 ALTER TABLE `app_promotion_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_settings`
--

DROP TABLE IF EXISTS `app_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `app_settings_app_id_foreign` (`app_id`),
  CONSTRAINT `app_settings_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_settings`
--

LOCK TABLES `app_settings` WRITE;
/*!40000 ALTER TABLE `app_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_support_tickets`
--

DROP TABLE IF EXISTS `app_support_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_support_tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `customer_id` int NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0 = open, 1 = replied, 2 = closed',
  `reply` text COLLATE utf8mb4_unicode_ci,
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `app_support_tickets_app_id_index` (`app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_support_tickets`
--

LOCK TABLES `app_support_tickets` WRITE;
/*!40000 ALTER TABLE `app_support_tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_support_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apps`
--

DROP TABLE IF EXISTS `apps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `apps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accent_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `coin_price` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_withdraw_fee` decimal(12,2) NOT NULL DEFAULT '5.00',
  `cappingx` decimal(12,2) NOT NULL DEFAULT '5.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apps_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apps`
--

LOCK TABLES `apps` WRITE;
/*!40000 ALTER TABLE `apps` DISABLE KEYS */;
INSERT INTO `apps` VALUES (1,'OPAI','opai','#000000','#ffffff','logos/X59O9HjdNlhsnBXZGlqN71Ir3Fv65rufdRLKU2VO.png',NULL,0.001000,'OP',5.00,5.00,'2025-12-01 01:46:50','2026-01-09 09:41:24');
/*!40000 ALTER TABLE `apps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_deposits`
--

DROP TABLE IF EXISTS `customer_deposits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_deposits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `package_id` bigint unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `roi_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `roi_earned` decimal(12,4) DEFAULT '0.0000',
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('pending','success','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `coin_price` decimal(10,4) NOT NULL,
  `tokens` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `is_free_deposit` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_deposits_transaction_id_unique` (`transaction_id`),
  KEY `customer_deposits_app_id_index` (`app_id`),
  KEY `customer_deposits_customer_id_index` (`customer_id`),
  KEY `customer_deposits_package_id_index` (`package_id`),
  CONSTRAINT `customer_deposits_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `customer_deposits_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `customer_deposits_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `app_packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_deposits`
--

LOCK TABLES `customer_deposits` WRITE;
/*!40000 ALTER TABLE `customer_deposits` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_deposits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_earning_details`
--

DROP TABLE IF EXISTS `customer_earning_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_earning_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_amount` decimal(12,4) NOT NULL,
  `reference_level` int DEFAULT NULL,
  `amount_earned` decimal(12,4) NOT NULL,
  `flush_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `earning_type` enum('level-reward','flush-income') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_earning_details_app_id_foreign` (`app_id`),
  KEY `earning_type_x` (`earning_type`),
  KEY `reference_id_x` (`reference_id`) USING BTREE,
  CONSTRAINT `customer_earning_details_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_earning_details`
--

LOCK TABLES `customer_earning_details` WRITE;
/*!40000 ALTER TABLE `customer_earning_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_earning_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_financials`
--

DROP TABLE IF EXISTS `customer_financials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_financials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `total_deposit` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `total_income` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `total_withdraws` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `capping_limit` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `total_topup` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `total_tokens` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_financials_app_id_customer_id_unique` (`app_id`,`customer_id`),
  KEY `customer_financials_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_financials_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `customer_financials_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_financials`
--

LOCK TABLES `customer_financials` WRITE;
/*!40000 ALTER TABLE `customer_financials` DISABLE KEYS */;
INSERT INTO `customer_financials` VALUES (1,1,1,0.000000,0.000000,0.000000,0.000000,0.0000,0.0000,'2025-12-31 09:10:55','2026-01-15 07:56:13');
/*!40000 ALTER TABLE `customer_financials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_settings`
--

DROP TABLE IF EXISTS `customer_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `isP2P` tinyint(1) NOT NULL DEFAULT '1',
  `isSelfTransfer` tinyint(1) NOT NULL DEFAULT '1',
  `isFreePackage` tinyint(1) NOT NULL DEFAULT '1',
  `isWithdraw` tinyint(1) NOT NULL DEFAULT '1',
  `isRankAssigned` tinyint(1) NOT NULL DEFAULT '0',
  `isWithdrawAssigned` tinyint(1) NOT NULL DEFAULT '0',
  `iswallet_editable` tinyint(1) NOT NULL DEFAULT '1',
  `isphone_editable` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_settings_app_id_customer_id_unique` (`app_id`,`customer_id`),
  KEY `customer_settings_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_settings_app_id_foreign1` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `customer_settings_customer_id_foreign1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_settings`
--

LOCK TABLES `customer_settings` WRITE;
/*!40000 ALTER TABLE `customer_settings` DISABLE KEYS */;
INSERT INTO `customer_settings` VALUES (1,1,1,1,1,1,0,0,0,0,0,'2026-01-06 12:51:40','2026-01-07 10:22:02');
/*!40000 ALTER TABLE `customer_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_withdraws`
--

DROP TABLE IF EXISTS `customer_withdraws`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_withdraws` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `admin_charge` decimal(10,4) NOT NULL,
  `amount` decimal(10,4) NOT NULL,
  `net_amount` decimal(10,4) NOT NULL,
  `pool_fees` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `to_customer` int DEFAULT NULL,
  `transaction_type` enum('withdraw','selftransfer','p2ptransfer','') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'withdraw',
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_status` enum('pending','success') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaction_id` (`transaction_id`),
  KEY `customer_withdraws_app_id_foreign` (`app_id`),
  KEY `customer_withdraws_customer_id_foreign` (`customer_id`),
  KEY `to_customer_x` (`to_customer`),
  KEY `transaction_type_x` (`transaction_type`),
  KEY `transaction_status_x` (`transaction_status`),
  CONSTRAINT `customer_withdraws_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `customer_withdraws_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_withdraws`
--

LOCK TABLES `customer_withdraws` WRITE;
/*!40000 ALTER TABLE `customer_withdraws` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_withdraws` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor_id` bigint unsigned DEFAULT NULL,
  `direct_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `active_direct_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_id` int NOT NULL DEFAULT '1',
  `actual_level_id` int NOT NULL DEFAULT '1',
  `leadership_rank` int DEFAULT '0',
  `leadership_points` int DEFAULT '0',
  `leadership_champions_rank` int DEFAULT '0',
  `champions_point` int DEFAULT NULL,
  `isRankAssigned` int NOT NULL DEFAULT '0',
  `isWithdrawAssigned` int NOT NULL DEFAULT '0',
  `promotion_status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `nonce` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iswallet_editable` tinyint(1) DEFAULT '1',
  `isphone_editable` tinyint(1) DEFAULT '1',
  `profile_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `isFreePackage` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `wallet_address` (`wallet_address`),
  UNIQUE KEY `referral_code` (`referral_code`),
  UNIQUE KEY `telegram_username` (`telegram_username`),
  UNIQUE KEY `phone` (`phone`),
  KEY `customers_app_id_foreign` (`app_id`),
  KEY `sponsor_id_x` (`sponsor_id`),
  KEY `level_id_x` (`level_id`),
  KEY `actual_level_id_x` (`actual_level_id`),
  KEY `leadership_rank_x` (`leadership_rank`),
  KEY `leadership_champions_rank_x` (`leadership_champions_rank`),
  CONSTRAINT `customers_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,1,'admin','admin@ordinarypeopleai.com','9000000001','$2y$12$lvW.jg.njHMZjS5qXPkIUOtVHrtSgv3dKYHalbBNTv0uvW6OHnJAm','0x8a4b086f9c80648e88bb096627d1223bd759a66f','59A66F','TELUSER123',NULL,NULL,NULL,1,NULL,'customer',1,0,NULL,NULL,NULL,NULL,0,0,NULL,NULL,0,1,'user_profiles/1767173660_user1.png',0,'2025-12-01 06:27:18','2026-01-15 07:51:46');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forgot_password_requests`
--

DROP TABLE IF EXISTS `forgot_password_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forgot_password_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `code` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `expires_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `customer_id_x` (`customer_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forgot_password_requests`
--

LOCK TABLES `forgot_password_requests` WRITE;
/*!40000 ALTER TABLE `forgot_password_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `forgot_password_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `free_deposit_packages`
--

DROP TABLE IF EXISTS `free_deposit_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `free_deposit_packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `package_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `free_deposit_packages_app_id_index` (`app_id`),
  KEY `free_deposit_packages_package_id_index` (`package_id`),
  KEY `free_deposit_packages_customer_id_index` (`customer_id`),
  CONSTRAINT `free_deposit_packages_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `free_deposit_packages_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `free_deposit_packages_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `app_packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `free_deposit_packages`
--

LOCK TABLES `free_deposit_packages` WRITE;
/*!40000 ALTER TABLE `free_deposit_packages` DISABLE KEYS */;
/*!40000 ALTER TABLE `free_deposit_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_user`
--

DROP TABLE IF EXISTS `landing_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `landing_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telegram` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_user`
--

LOCK TABLES `landing_user` WRITE;
/*!40000 ALTER TABLE `landing_user` DISABLE KEYS */;
INSERT INTO `landing_user` VALUES (1,'Akmal Tirmizi','akmal.tirmizi@rediffmail.com','+971','502258570',NULL,'2026-01-05 13:24:10'),(3,'UNKNOWN','unknown@gmail.com','+971','78985126891','tghfjhijk','2026-01-05 13:49:52'),(4,'dfhbfbhg','dfhdfh@rg.vom','+376','45798536458','kdjnmvdofjv','2026-01-05 13:50:14');
/*!40000 ALTER TABLE `landing_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2025_12_01_042935_create_apps_table',1),(2,'2025_12_01_043817_create_app_settings_table',2),(3,'0001_01_01_000000_create_users_table',3),(4,'2025_12_01_043930_create_nonce_table',4),(5,'0001_01_01_000001_create_cache_table',5),(6,'0001_01_01_000002_create_jobs_table',6),(7,'2025_11_29_131147_create_personal_access_tokens_table',7),(8,'2025_12_02_061151_create_app_packages_table',8),(9,'2025_12_03_093456_create_free_deposit_packages_table',9),(10,'2025_12_03_103914_create_wallet_transactions_table',10),(11,'2025_12_30_123116_create_admin_tutorials_table',11),(12,'2026_01_06_122603_create_customer_settings_table',12),(14,'2026_01_12_060130_create_admin_audit_logs_table',13),(15,'2026_01_13_055050_create_app_fee_pool_table',14);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ninepay_transactions`
--

DROP TABLE IF EXISTS `ninepay_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ninepay_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eth_9pay_json` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tron_9pay_json` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `amount` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `fees_amount` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `received_amount` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `remaining_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `chain` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `network_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `network_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_hash` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('pending','success','failed','underpaid','cancel') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `app_fee_pool_id` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_ninepay_payment` (`transaction_id`,`app_id`,`customer_id`,`transaction_hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ninepay_transactions`
--

LOCK TABLES `ninepay_transactions` WRITE;
/*!40000 ALTER TABLE `ninepay_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ninepay_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nonces`
--

DROP TABLE IF EXISTS `nonces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nonces` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `wallet_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nonce` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nonces_user_id_foreign` (`user_id`),
  KEY `nonces_wallet_address_index` (`wallet_address`),
  CONSTRAINT `nonces_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nonces`
--

LOCK TABLES `nonces` WRITE;
/*!40000 ALTER TABLE `nonces` DISABLE KEYS */;
/*!40000 ALTER TABLE `nonces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('2M9h6InsClHZkPu3cKT2sktUuZqz7RP5CTk6RoL4',NULL,'162.159.110.14','Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS29nN3h1cmVDeU43VWEyUXVQVHV4dUlMT2hyM2dpSUd0MGt4NTVKMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3Byb2ZpbGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1768464029),('35fugcAjFDSjQmfboZGX9UsN94QyhpHzRkUGeVot',NULL,'172.71.232.74','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDNZdDBhUzFZMDlvbHhWM0gzNlJsWElBTWFFdDFPcExzMjNSc0ZOSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3Byb2ZpbGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1768463111),('4QhDdN1b0mp3oWZDSI6TIfZb7X6qU0SKb40cJudd',NULL,'172.68.164.24','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYXVkcGdMemVFMWlIVjF6RmNLUXExTm9XeGNZS0tmR3NKQ0xDRUI5RyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTU6ImxvZ2luX2N1c3RvbWVyXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NjQ7fQ==',1768462932),('6XbXlx56tp75YNk5cfku9fjAB0gKRug30BXholez',NULL,'172.71.130.41','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicTN0RWpFcnhGYlZFNHgxQXMxTGV1MENIaDRocVZLbXRSclJ1WEdyaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1768464507),('7g57WK7F553VCFKF16BuiiWI9WxM1GcqOWZl17Vu',NULL,'162.159.122.41','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQTE0OWlubE0xd2RyOEhBdGRWUHVvNlBzN3hXUk9HSlZGSmxmYmRoSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTU6ImxvZ2luX2N1c3RvbWVyXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTg7fQ==',1768460870),('7N1rNOzNxMHNnVP96vLYiw1JASQkpCbY8igoBdlv',NULL,'95.156.139.139','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGljZlpLQmxSRFZ6MmZVZEQwWHd1V0lpVnVzTnczcFV5NWtNb3hmRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly83Mi42MS4xNDguNTUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1768458017),('B5lz7jd26ZYxuLZzBVpfoV6AwGlnc9d6DWfOxU5Z',NULL,'172.71.124.158','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidm9jVWZUb1JVWEtTMlRWVzhvdFV4ZU80T001UUZZVW5RV1NCZ3ppZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3dpdGhkcmF3Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NToibG9naW5fY3VzdG9tZXJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1768463800),('Drj9ckbvoWDBOpa1nYjKz1eblBwlEvax7tE7CJkX',NULL,'147.185.133.229','Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity','YTozOntzOjY6Il90b2tlbiI7czo0MDoibFl6R2JzVVJwVWNDQWxucGxSR2w0QUtJOHQ4TGlXMGhmcHYxTnRBNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly83Mi42MS4xNDguNTUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1768457965),('GdtlgeunnFU3uWsWxDAgI2xiHqOYdiAlSehwSn2f',NULL,'172.69.166.88','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidW9sUDh4UzkyQmg1YzFvNGxVWW9temk5Wlg2cGNaQmlIbGlaWHl5MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1768456997),('GP5UIOzJ02yHt2JNGwCVtRnGhUWqQXcDHTA7Y8kB',NULL,'172.71.119.31','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDRwWk5PS2xSNXNEMXpVMFh4aEpLdU9YOE40TVhFRzdTYkpxU0NrYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3JlZ2lzdGVyP3Nwb25zb3Jjb2RlPTE1MzczUFJTVyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1768458659),('Gp7hkkyXmWIcKOlOHpJ09LBSKz783H0N3PSWfbgx',NULL,'162.159.110.15','Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Mobile/15E148 Safari/604.1','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSlVnZmFLbkk4dHNkMmdjMjdzck5DMlQ2MDRWbEFXdmYzQVF1cERPViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3BheS1xciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTU6ImxvZ2luX2N1c3RvbWVyXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1768463117),('GxIMeKlRF28Qsb3sgViS8CswuXugSRx5zAglefBq',NULL,'141.101.98.147','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNUprbU9JdGtlMmJCMHlzRmdTMUpwNllNSEtUVGpNUWo5MDJzZWtJbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NToibG9naW5fY3VzdG9tZXJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozNTt9',1768465935),('GyUtvvZUG2J0fCqZ65D96kQ0TOIdk2V8M52kY8CL',NULL,'172.64.192.189','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoic1I2ekJVZE1zNXVsajVPdXpudHJXaHg1eHlrTU01cU1LUU93ZHV6SCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1768463792),('hJ0GglJVg8DXm6yhddvzz1HNPl4kcrFEEVowAtpm',NULL,'172.68.164.25','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR1Z2eHdKNm5lRkZkUFVQcUFlZ2JibWxxaWY1RkttQVRpOTBzM1MzdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3JlZ2lzdGVyP3Nwb25zb3Jjb2RlPTE2NDZVR09UWiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1768463018),('Hmqs2QaImL4yzcUUVYiv5g0JGWCT8VF58X3R0T34',NULL,'104.23.216.73','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoib2pZTTFKQUpmWjVNc2l3NjdtY2VGVFZGOTRualVTVzVsdllWaTdXaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTU6ImxvZ2luX2N1c3RvbWVyXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NjM7fQ==',1768462976),('jTC7PEw4xcR4E19aGZ3HlLIsewPmFZbjknEYElfr',NULL,'104.23.175.146','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUElMUEhMSnRGS1NLQTFDT2U3WUtYdFZ3TXZuME5XQTI1R2U4RVFYYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTU6ImxvZ2luX2N1c3RvbWVyXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NjA7fQ==',1768461339),('JZUvALzjqWxt3X9yLsTZaTDuaFWJgqfwGyTRt6GU',NULL,'162.158.88.108','Snap URL Preview Service; bot; snapchat; https://developers.snap.com/robots','YTozOntzOjY6Il90b2tlbiI7czo0MDoiV0s4dTJwWGNBZGdSZzFpVkZVbDIyMnFjZXhuZGRpWExDOVI2N1J0TCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3JlZ2lzdGVyP3Nwb25zb3Jjb2RlPTE1MzczUFJTVyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1768459402),('KWZfqZ9fTvXZ9akEFYoVGnneuIghgFvaFi8pa9YN',NULL,'162.159.122.40','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkhhcWJybjVVYnF1cWFGY0QwYmx0dkVXalUzbEwxeDNXZTM3T0tZRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3JlZ2lzdGVyP3Nwb25zb3Jjb2RlPTExODBFSEVIUSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1768460886),('kyFcfRryKo6mIVEQMEipdwIQ1Q1mdK4u3eYd1CuF',NULL,'172.71.232.37','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQzBlVHRreGVIYndiN1cwbmZIZXV1OTR0UE93aW51anZySXZ2NWV1YyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1768463112),('lLYZ2GLHkKUPVfsKBGeddL9tctaoisUrQqKx8j8S',NULL,'172.70.86.209','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36 EdgA/143.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoieFBEaTh6b0VUc2lESXBqUXpxMUdCNWFlaVNBODh0YTBHR0JBN3NBaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTU6ImxvZ2luX2N1c3RvbWVyXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NjE7fQ==',1768461200),('mcgfXpwtYnGss6n0svsC5RSkGELOt7xuaJ1RrV08',NULL,'141.101.95.46','Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVnVWeVM3SHVCVDc4WmhxOFBtNnJaaEdIcUhIOGJLdzgweGtnOW50YyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NToibG9naW5fY3VzdG9tZXJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1Mzt9',1768464545),('nc9Ed8dD0rZOjeeH5I7tKGjh49CLzi3Rqrqn4vv8',NULL,'162.159.122.41','Mozilla/5.0 (Linux; Android 14; V2045) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/123.0.6312.118 Mobile Safari/537.36 VivoBrowser/15.0.2.4','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOVNNMlVFU3dRZExhMFp0Y1BocXhIV0tDeGt1REdLUTlldG9wY0NlMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTU6ImxvZ2luX2N1c3RvbWVyXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NjI7fQ==',1768462244),('O9ba6BHMuVmMgIveUaH7COdS9maoJUGTLcUNVhju',NULL,'104.23.229.135','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/601.2.4 (KHTML, like Gecko) Version/9.0.1 Safari/601.2.4 facebookexternalhit/1.1 Facebot Twitterbot/1.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoibFhyUDRxVmVZMGh0RTg2SHZHbU1BVElqeXpTM0tBSGE4NEhDcE0wWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1768464030),('OsdF4oqDvYdeHYgUeru4Tc5GygKAagBID9xPcXp0',NULL,'172.71.81.230','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXpMVUVKRWFWcEw3aUx2OWh1ZXhKbjE1VkpXSzJwSlJZRUM2OGhSMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3JlZ2lzdGVyP3Nwb25zb3Jjb2RlPTE2NDZVR09UWiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1768462949),('P5gzfcyqKOnM4RcZXlQC38aPHWLUeWyTF4rU8ZGY',NULL,'172.70.93.62','Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Snapchat/13.74.0.38 (like Safari/8622.2.11.10.8, panda)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaU0wT2hnZm9kVnBrcWVSNURMMW5UQ2NNMFRXcG9Kbjl3MzU2OVB0ZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3JlZ2lzdGVyP3Nwb25zb3Jjb2RlPTE1MzczUFJTVyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1768459411),('PifjwpiRt6jvqubfKnXSZLcemn8B28DD9F3uIcNF',NULL,'162.158.235.239','Snap URL Preview Service; bot; snapchat; https://developers.snap.com/robots','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2Zwc0ZXTTlQaGh5djlwVEswRDMzOVhWZXlVM0hDSjNjRXM5alNEWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3JlZ2lzdGVyP3Nwb25zb3Jjb2RlPTE1MzczUFJTVyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1768462359),('SsrH81ifcy8ZPbRxbSqBSw8Lx9Ia17eWh6wc5IHj',NULL,'104.23.175.146','Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) GSA/27.0.155813979 Mobile/14E304 Safari/602.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGpIRE41NFpYaTF5SVpjWmxPVGF1b3NWMzV0RDhCYTJOWnJ3Z2JFYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3JlZ2lzdGVyP3Nwb25zb3Jjb2RlPTE1MzczUFJTVyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1768462359),('wF0YADryCcQ7bfjMs1xs1P7c7FL8db8ED6WF5Ba5',NULL,'172.69.194.155','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSjh1NzM1NHphMDVJRmFiOWJNREwxTlI0aUFVTElXODVES29PU2RjeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3JlZ2lzdGVyIjt9fQ==',1768463993),('yEU1QeEv9APk6oMmPku3P9f0ky6rggPqSLKzCcpo',NULL,'162.159.110.14','Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHc1UVJZdmhiNmtVdGdZWVdYWVVaTVA5WXd4Ykp4VE1pVE9xcmN2aSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1768464030),('Ym2eEYVHFtCiGemgb0kh0RQU2zs49bbGHAVFW80f',NULL,'141.101.95.46','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUNkVzNTczc1NlFnWUV1Tm5INjVhZVRkbkNCY3RxdWlySnFNM2dOeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3JlZ2lzdGVyP3Nwb25zb3Jjb2RlPTE1MzczUFJTVyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1768459604);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_id` bigint unsigned DEFAULT NULL,
  `wallet_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  CONSTRAINT `users_chk_1` CHECK (json_valid(`meta`))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Admin','sa@app.com',NULL,'$2y$12$mfB7TjU6X.H8K7ww0j79kuSvZS1np24V6JrV3zrFu7HaeG652b/IW',NULL,NULL,NULL,0,'superadmin',NULL,NULL,'2025-12-01 00:25:22','2025-12-01 00:25:22'),(2,'Admin User','admin@app.com',NULL,'$2y$12$mfB7TjU6X.H8K7ww0j79kuSvZS1np24V6JrV3zrFu7HaeG652b/IW',1,NULL,NULL,0,'admin',NULL,NULL,'2025-12-01 03:57:00','2025-12-01 03:57:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `votes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `voter_id` bigint unsigned NOT NULL,
  `sponsor_id` bigint unsigned NOT NULL,
  `voted_for` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_vote` (`app_id`,`voter_id`,`sponsor_id`,`voted_for`) USING BTREE,
  KEY `fk_votes_voter` (`voter_id`),
  KEY `fk_votes_sponsor` (`sponsor_id`),
  CONSTRAINT `fk_votes_app` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_votes_sponsor` FOREIGN KEY (`sponsor_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_votes_voter` FOREIGN KEY (`voter_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votes`
--

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-15  8:37:35
