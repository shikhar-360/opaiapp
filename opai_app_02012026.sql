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
  `id` bigint unsigned NOT NULL,
  `app_id` bigint unsigned NOT NULL,
  `rank` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `directs` int unsigned NOT NULL DEFAULT '0',
  `team_volume` decimal(18,6) NOT NULL DEFAULT '0.000000',
  `points` decimal(18,6) NOT NULL DEFAULT '0.000000',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_champions_income_plan`
--

LOCK TABLES `app_champions_income_plan` WRITE;
/*!40000 ALTER TABLE `app_champions_income_plan` DISABLE KEYS */;
INSERT INTO `app_champions_income_plan` VALUES (1,1,'VIP1',10,1000.000000,100.000000,'2025-12-12 23:07:19','2025-12-12 23:07:19'),(2,1,'VIP2',20,2000.000000,200.000000,'2025-12-12 23:07:19','2025-12-12 23:07:19'),(3,1,'VIP3',30,3000.000000,300.000000,'2025-12-12 23:07:19','2025-12-12 23:07:19'),(4,1,'VIP4',40,4000.000000,400.000000,'2025-12-12 23:07:19','2025-12-12 23:07:19'),(5,1,'VIP5',50,5000.000000,500.000000,'2025-12-12 23:07:19','2025-12-12 23:07:19');
/*!40000 ALTER TABLE `app_champions_income_plan` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_leadership_income_plan`
--

LOCK TABLES `app_leadership_income_plan` WRITE;
/*!40000 ALTER TABLE `app_leadership_income_plan` DISABLE KEYS */;
INSERT INTO `app_leadership_income_plan` VALUES (1,1,'gold',1000.000000,5.000000,'2025-12-12 23:07:02','2025-12-12 23:07:02'),(2,1,'sapphire',2000.000000,10.000000,'2025-12-12 23:07:02','2025-12-12 23:07:02'),(3,1,'emerald',4000.000000,20.000000,'2025-12-12 23:07:02','2025-12-12 23:07:02'),(4,1,'ruby',8000.000000,80.000000,'2025-12-12 23:07:02','2025-12-12 23:07:02'),(5,1,'diamond',16000.000000,160.000000,'2025-12-12 23:07:02','2025-12-12 23:07:02');
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
INSERT INTO `app_leadership_packages` VALUES (1,1,'gold',1000,5,'2025-12-10 02:09:28','2025-12-10 02:25:55'),(2,1,'sapphire',2000,10,'2025-12-10 02:09:28','2025-12-10 02:09:28'),(3,1,'emrald',4000,20,'2025-12-10 02:09:28','2025-12-10 02:09:28'),(4,1,'ruby',8000,80,'2025-12-10 02:09:28','2025-12-10 02:09:28'),(5,1,'diamond',16000,160,'2025-12-10 02:09:00','2025-12-10 02:09:00');
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
  CONSTRAINT `app_level_packages_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_level_packages`
--

LOCK TABLES `app_level_packages` WRITE;
/*!40000 ALTER TABLE `app_level_packages` DISABLE KEYS */;
INSERT INTO `app_level_packages` VALUES (1,1,1,1,35.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(2,1,2,2,10.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(3,1,3,2,5.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(4,1,4,3,4.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(5,1,5,3,3.00,'2025-12-02 23:23:04','2025-12-12 04:34:29'),(6,1,6,4,3.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(7,1,7,4,3.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(8,1,8,5,2.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(9,1,9,5,2.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(10,1,10,6,2.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(11,1,11,6,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(12,1,12,7,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(13,1,13,7,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(14,1,14,8,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(15,1,15,8,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(16,1,16,9,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(17,1,17,9,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(18,1,18,10,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(19,1,19,10,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04'),(20,1,20,10,1.00,'2025-12-02 23:23:04','2025-12-02 23:23:04');
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
INSERT INTO `app_packages` VALUES (1,1,'P1',5.00,0.50,1,'2025-12-02 01:17:05','2025-12-09 07:27:30'),(2,1,'P2',10.00,1.00,1,'2025-12-02 01:17:05','2025-12-02 01:17:05'),(3,1,'P3',25.00,1.50,1,'2025-12-02 01:17:05','2025-12-12 04:34:43'),(4,1,'P4',50.00,2.00,1,'2025-12-02 01:17:05','2025-12-02 01:17:05'),(5,1,'Free',100000.00,0.00,1,'2025-12-02 01:17:05','2025-12-02 01:17:05');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_support_tickets`
--

LOCK TABLES `app_support_tickets` WRITE;
/*!40000 ALTER TABLE `app_support_tickets` DISABLE KEYS */;
INSERT INTO `app_support_tickets` VALUES (1,1,1,'test line','test content to resolve','support_tickets/jzSFPVbc51xtbyWBxOyEOR53jsNslMXE3y0A18hC.png',0,NULL,NULL,'2025-12-31 12:08:24','2025-12-31 12:08:24');
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
INSERT INTO `apps` VALUES (1,'App One','app-one',NULL,NULL,NULL,NULL,2.100000,'OP','2025-12-01 01:46:50','2025-12-01 01:46:50');
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
  `roi_percent` decimal(5,2) NOT NULL,
  `roi_earned` decimal(12,4) DEFAULT '0.0000',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('pending','success','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `coin_price` decimal(10,4) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_deposits`
--

LOCK TABLES `customer_deposits` WRITE;
/*!40000 ALTER TABLE `customer_deposits` DISABLE KEYS */;
INSERT INTO `customer_deposits` VALUES (1,1,1,1,5.00,1.00,0.0000,'DEPOSIT-yBn1J93I','success',2,0,'2026-01-01 18:09:45','2026-01-01 18:09:45');
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
  `earning_type` enum('ROI','LEVEL-INCOME','BONUS','LEVEL-REWARD') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_earning_details_app_id_foreign` (`app_id`),
  CONSTRAINT `customer_earning_details_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_financials_app_id_customer_id_unique` (`app_id`,`customer_id`),
  KEY `customer_financials_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_financials_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `customer_financials_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_financials`
--

LOCK TABLES `customer_financials` WRITE;
/*!40000 ALTER TABLE `customer_financials` DISABLE KEYS */;
INSERT INTO `customer_financials` VALUES (1,1,1,25.000000,17.500000,0.000000,625.000000,475.0000,'2025-12-31 09:10:55','2026-01-01 18:12:38');
/*!40000 ALTER TABLE `customer_financials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_flush_details`
--

DROP TABLE IF EXISTS `customer_flush_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_flush_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `upline_id` bigint unsigned NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_amount` decimal(15,2) NOT NULL,
  `flush_amount` decimal(15,2) NOT NULL,
  `flush_level` int unsigned NOT NULL,
  `reason` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_app_id` (`app_id`),
  KEY `idx_upline_id` (`upline_id`),
  KEY `idx_reference_id` (`reference_id`),
  KEY `idx_flush_level` (`flush_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_flush_details`
--

LOCK TABLES `customer_flush_details` WRITE;
/*!40000 ALTER TABLE `customer_flush_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_flush_details` ENABLE KEYS */;
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
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_withdraws_app_id_foreign` (`app_id`),
  KEY `customer_withdraws_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_withdraws_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `customer_withdraws_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor_id` bigint unsigned DEFAULT NULL,
  `direct_ids` longtext COLLATE utf8mb4_unicode_ci,
  `active_direct_ids` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_id` int DEFAULT '1',
  `leadership_rank` int DEFAULT '0',
  `leadership_points` int DEFAULT '0',
  `leadership_champions_rank` int DEFAULT '0',
  `champions_point` int DEFAULT NULL,
  `isRankAssigned` int NOT NULL DEFAULT '0',
  `promotion_status` text COLLATE utf8mb4_unicode_ci,
  `nonce` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iswallet_editable` tinyint(1) DEFAULT '1',
  `isphone_editable` tinyint(1) DEFAULT '1',
  `profile_image` text COLLATE utf8mb4_unicode_ci,
  `isFreePackage` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customers_app_id_foreign` (`app_id`),
  CONSTRAINT `customers_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,1,'admin','rahul@app.coms','9000000001','$2y$12$2F0J8ItT5kLyHWYcDPVtj.Lpaq9JCvU.usA/2q73HPpI4DYfjDMsW',NULL,'59A66F','TELUSER123',NULL,NULL,NULL,1,NULL,'customer',1,NULL,NULL,NULL,NULL,0,NULL,NULL,0,1,'user_profiles/1767173660_user1.png',0,'2025-12-01 06:27:18','2026-01-01 18:09:45');
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
  PRIMARY KEY (`id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2025_12_01_042935_create_apps_table',1),(2,'2025_12_01_043817_create_app_settings_table',2),(3,'0001_01_01_000000_create_users_table',3),(4,'2025_12_01_043930_create_nonce_table',4),(5,'0001_01_01_000001_create_cache_table',5),(6,'0001_01_01_000002_create_jobs_table',6),(7,'2025_11_29_131147_create_personal_access_tokens_table',7),(8,'2025_12_02_061151_create_app_packages_table',8),(9,'2025_12_03_093456_create_free_deposit_packages_table',9),(10,'2025_12_03_103914_create_wallet_transactions_table',10),(11,'2025_12_30_123116_create_admin_tutorials_table',11);
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
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eth_9pay_json` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tron_9pay_json` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `amount` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `fees_amount` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `received_amount` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `remaining_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `chain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `network_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `network_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_hash` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('pending','success','failed','underpaid','cancel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_ninepay_payment` (`transaction_id`,`app_id`,`customer_id`,`transaction_hash`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
INSERT INTO `sessions` VALUES ('chlRdrfX5sR2MzeJXklIbXJKBMmUFi4eum1Mz2Sr',NULL,'172.69.224.189','Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS3dWMVlsZkIwZHNFQzJTYnUySGxSZFhsVndYT0ZZWVdLZFl2cHBWcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2xldmVsY2FsY3VsYXRvciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTU6ImxvZ2luX2N1c3RvbWVyXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1767310289),('dAXouc97Xow7I6oMahfxSxg1SsfecAto9wRU4IXE',NULL,'162.159.110.15','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/601.2.4 (KHTML, like Gecko) Version/9.0.1 Safari/601.2.4 facebookexternalhit/1.1 Facebot Twitterbot/1.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUVBeU51R01OeU43MG45eXMydlpzbnpRYU1TM0JEbEZRcDRxeEUwaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1767312612),('DJuCtvYWjNa1ghnfYgtCJ3an0lkPExlBYeHRCQrU',NULL,'172.69.194.154','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Safari/605.1.15','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTRtd1VIdmlCbVpaNzRmb1ViZmt0VWdadXduMktNSGhnTTZrOXJwUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjA6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3JlZ2lzdGVyP3Nwb25zb3Jjb2RlPTU5QTY2RiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1767304152),('Ep9nUPTNzKBhfvdIwpLQgNd2z4qoj5NcYk05qT4y',NULL,'43.130.37.243','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoibm1zMmg5blczSk96SmZuQ0dCY1pJa0Z2M0k5RlJMc0F2bmYzbmg0ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly83Mi42MS4xNDguNTUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1767313500),('FhGvVznCXaIOvaKhJEHpQ0V7IzAf04IsoI3ewF8M',NULL,'172.236.22.96','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:8.0) Gecko/20100101 Firefox/8.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR0NnRkllZzRRUGlESFV6QmNBWTFEQUhnN2Q4dTl3QVdDVlRLNVJLdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly83Mi42MS4xNDguNTUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1767328614),('fSPNAWtyeJDegV7Ro3JcJZ3kDbchPEQ4PGz9KwY6',NULL,'151.238.51.60','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXl3cGpoek1jd0NPaGFScXNCQ29mcnRFVWJVS2ZVOUpkdDZySUZ3VyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly83Mi42MS4xNDguNTUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1767317880),('FzqagPMMTW5FNGywuZVYNIdamoPpcSpYJr3yoqBZ',NULL,'172.64.213.108','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRWZGT0ZuVHZBckU3NzBtOVdNaml2TWh2T2lFdHhQTUxqeXZEQThHciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NToibG9naW5fY3VzdG9tZXJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1767312850),('Ktp8qC3TUbEZTvx3i6uQmRw52Gdj4oeRfJAFv40R',NULL,'147.185.132.26','Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWEZyY294a1ViTzVVUENCTjBGZ2JoYjU1dFNBclFyNUJsS0ptc1Y5WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly83Mi42MS4xNDguNTUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1767312452),('qR9oI2huGEJvsdF3Fi8CnNfvppjbZMx0ySipoqSX',NULL,'162.158.216.189','Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148','YTozOntzOjY6Il90b2tlbiI7czo0MDoidXU5aXRWdTJSeHJwUEhOajlzZVV2d3EySTdJTVhSSHlzR1Y5Y3YzOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1767312600),('uJMoO82z9eOVUgrC2f6hklYYu3kKSDBsy3L74UDz',NULL,'172.71.241.101','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMUhxQ1R2cFRuQjQ0UFZhV3RVYW9CREEwNnVCUjBXVXlhbE1PSHVzSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3N0YXRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NToibG9naW5fY3VzdG9tZXJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1767312923);
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
  `voted_for` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_vote` (`app_id`,`voter_id`,`sponsor_id`,`voted_for`) USING BTREE,
  KEY `fk_votes_voter` (`voter_id`),
  KEY `fk_votes_sponsor` (`sponsor_id`),
  CONSTRAINT `fk_votes_app` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_votes_sponsor` FOREIGN KEY (`sponsor_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_votes_voter` FOREIGN KEY (`voter_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votes`
--

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallet_transactions`
--

DROP TABLE IF EXISTS `wallet_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wallet_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint unsigned NOT NULL,
  `payer_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `amount` decimal(10,4) NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `wallet_transactions_app_id_foreign` (`app_id`),
  KEY `wallet_transactions_payer_id_foreign` (`payer_id`),
  KEY `wallet_transactions_receiver_id_foreign` (`receiver_id`),
  CONSTRAINT `wallet_transactions_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wallet_transactions_payer_id_foreign` FOREIGN KEY (`payer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wallet_transactions_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallet_transactions`
--

LOCK TABLES `wallet_transactions` WRITE;
/*!40000 ALTER TABLE `wallet_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallet_transactions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-02  4:40:12
