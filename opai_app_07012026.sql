-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 07, 2026 at 05:10 AM
-- Server version: 8.0.44-0ubuntu0.24.04.2
-- PHP Version: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opai_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tutorials`
--

CREATE TABLE `admin_tutorials` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `resource_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'video',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_tutorials`
--

INSERT INTO `admin_tutorials` (`id`, `app_id`, `resource_type`, `title`, `sub_title`, `url`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'video', 'Getting Started', 'Admin Panel Overview', 'https://www.youtube-nocookie.com/embed/jfKfPfyJRdk', 1, '2025-12-30 13:22:20', '2025-12-30 13:22:20'),
(2, 1, 'video', 'Support & Help', 'Account setup & basic overview', 'https://www.youtube-nocookie.com/embed/jfKfPfyJRdk', 2, NULL, '2025-12-30 13:29:52'),
(3, 1, 'video', 'How Promotions Work', 'Account setup & basic overview\r\n', 'https://www.youtube-nocookie.com/embed/jfKfPfyJRdk', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accent_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` json DEFAULT NULL,
  `coin_price` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`id`, `name`, `slug`, `primary_color`, `accent_color`, `logo_path`, `settings`, `coin_price`, `currency`, `created_at`, `updated_at`) VALUES
(1, 'App One', 'app-one', NULL, NULL, NULL, NULL, 2.100000, 'OP', '2025-12-01 01:46:50', '2025-12-01 01:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `app_champions_income_plan`
--

CREATE TABLE `app_champions_income_plan` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `rank` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `directs` int UNSIGNED NOT NULL DEFAULT '0',
  `team_volume` decimal(18,6) NOT NULL DEFAULT '0.000000',
  `points` decimal(18,6) NOT NULL DEFAULT '0.000000',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_champions_income_plan`
--

INSERT INTO `app_champions_income_plan` (`id`, `app_id`, `rank`, `directs`, `team_volume`, `points`, `created_at`, `updated_at`) VALUES
(1, 1, 'VIP1', 10, 1000.000000, 100.000000, '2025-12-12 23:07:19', '2025-12-12 23:07:19'),
(2, 1, 'VIP2', 20, 2000.000000, 200.000000, '2025-12-12 23:07:19', '2025-12-12 23:07:19'),
(3, 1, 'VIP3', 30, 3000.000000, 300.000000, '2025-12-12 23:07:19', '2025-12-12 23:07:19'),
(4, 1, 'VIP4', 40, 4000.000000, 400.000000, '2025-12-12 23:07:19', '2025-12-12 23:07:19'),
(5, 1, 'VIP5', 50, 5000.000000, 500.000000, '2025-12-12 23:07:19', '2025-12-12 23:07:19');

-- --------------------------------------------------------

--
-- Table structure for table `app_leadership_income_plan`
--

CREATE TABLE `app_leadership_income_plan` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `rank` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_volume` decimal(18,6) NOT NULL DEFAULT '0.000000',
  `points` decimal(18,6) NOT NULL DEFAULT '0.000000',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_leadership_income_plan`
--

INSERT INTO `app_leadership_income_plan` (`id`, `app_id`, `rank`, `team_volume`, `points`, `created_at`, `updated_at`) VALUES
(1, 1, 'gold', 1000.000000, 5.000000, '2025-12-12 23:07:02', '2025-12-12 23:07:02'),
(2, 1, 'sapphire', 2000.000000, 10.000000, '2025-12-12 23:07:02', '2025-12-12 23:07:02'),
(3, 1, 'emerald', 4000.000000, 20.000000, '2025-12-12 23:07:02', '2025-12-12 23:07:02'),
(4, 1, 'ruby', 8000.000000, 80.000000, '2025-12-12 23:07:02', '2025-12-12 23:07:02'),
(5, 1, 'diamond', 16000.000000, 160.000000, '2025-12-12 23:07:02', '2025-12-12 23:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `app_leadership_packages`
--

CREATE TABLE `app_leadership_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `rank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` bigint UNSIGNED DEFAULT NULL,
  `points` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_leadership_packages`
--

INSERT INTO `app_leadership_packages` (`id`, `app_id`, `rank`, `volume`, `points`, `created_at`, `updated_at`) VALUES
(1, 1, 'gold', 1000, 5, '2025-12-10 02:09:28', '2025-12-10 02:25:55'),
(2, 1, 'sapphire', 2000, 10, '2025-12-10 02:09:28', '2025-12-10 02:09:28'),
(3, 1, 'emrald', 4000, 20, '2025-12-10 02:09:28', '2025-12-10 02:09:28'),
(4, 1, 'ruby', 8000, 80, '2025-12-10 02:09:28', '2025-12-10 02:09:28'),
(5, 1, 'diamond', 16000, 160, '2025-12-10 02:09:00', '2025-12-10 02:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `app_level_packages`
--

CREATE TABLE `app_level_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `level` int UNSIGNED NOT NULL,
  `directs` int UNSIGNED NOT NULL DEFAULT '0',
  `reward` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_level_packages`
--

INSERT INTO `app_level_packages` (`id`, `app_id`, `level`, `directs`, `reward`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 35.00, '2025-12-02 23:23:04', '2026-01-06 09:52:18'),
(2, 1, 2, 2, 10.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(3, 1, 3, 2, 5.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(4, 1, 4, 3, 4.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(5, 1, 5, 3, 3.00, '2025-12-02 23:23:04', '2025-12-12 04:34:29'),
(6, 1, 6, 4, 3.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(7, 1, 7, 4, 3.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(8, 1, 8, 5, 2.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(9, 1, 9, 5, 2.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(10, 1, 10, 6, 2.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(11, 1, 11, 6, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(12, 1, 12, 7, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(13, 1, 13, 7, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(14, 1, 14, 8, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(15, 1, 15, 8, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(16, 1, 16, 9, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(17, 1, 17, 9, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(18, 1, 18, 10, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(19, 1, 19, 10, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(20, 1, 20, 10, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `app_packages`
--

CREATE TABLE `app_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `plan_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `roi_percent` decimal(5,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_packages`
--

INSERT INTO `app_packages` (`id`, `app_id`, `plan_code`, `amount`, `roi_percent`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'P1', 5.00, 0.50, 1, '2025-12-02 01:17:05', '2025-12-09 07:27:30'),
(2, 1, 'P2', 10.00, 1.00, 1, '2025-12-02 01:17:05', '2025-12-02 01:17:05'),
(3, 1, 'P3', 25.00, 1.50, 1, '2025-12-02 01:17:05', '2025-12-12 04:34:43'),
(4, 1, 'P4', 50.00, 2.00, 1, '2025-12-02 01:17:05', '2025-12-02 01:17:05'),
(5, 1, 'Free', 100000.00, 0.00, 1, '2025-12-02 01:17:05', '2025-12-02 01:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `app_promotion_packages`
--

CREATE TABLE `app_promotion_packages` (
  `id` bigint NOT NULL,
  `app_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_beneficiaries` int NOT NULL DEFAULT '0',
  `directs` int DEFAULT NULL,
  `package` text COLLATE utf8mb4_general_ci,
  `package_benefits` text COLLATE utf8mb4_general_ci,
  `benefit_levels` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `app_promotion_packages`
--

INSERT INTO `app_promotion_packages` (`id`, `app_id`, `name`, `total_beneficiaries`, `directs`, `package`, `package_benefits`, `benefit_levels`, `created_at`, `updated_at`) VALUES
(1, 1, 'HEAD START 1000', 1000, 3, '[5,10]', '[5,10]', '[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]', '2025-12-17 05:05:43', '2025-12-17 05:05:43'),
(2, 1, 'HEAD START 500', 500, 2, '[25,50]', '[25,50]', '[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]', '2025-12-17 05:05:43', '2025-12-17 05:05:43'),
(3, 1, 'HEAD START 10X', 1000, 10, '[25,50]', '[25]', '[]', '2025-12-17 10:44:27', '2025-12-17 10:44:27'),
(4, 1, 'FOUNDERS CLUB 5000', 5000, 10, '[5,10,25,50]', '[25]', '[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]', '2025-12-17 10:46:34', '2025-12-17 10:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_support_tickets`
--

CREATE TABLE `app_support_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `customer_id` int NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0 = open, 1 = replied, 2 = closed',
  `reply` text COLLATE utf8mb4_unicode_ci,
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_support_tickets`
--

INSERT INTO `app_support_tickets` (`id`, `app_id`, `customer_id`, `subject`, `message`, `file`, `status`, `reply`, `replied_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'test line', 'test content to resolve', 'support_tickets/jzSFPVbc51xtbyWBxOyEOR53jsNslMXE3y0A18hC.png', 0, NULL, NULL, '2025-12-31 12:08:24', '2025-12-31 12:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor_id` bigint UNSIGNED DEFAULT NULL,
  `direct_ids` longtext COLLATE utf8mb4_unicode_ci,
  `active_direct_ids` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_id` int NOT NULL DEFAULT '1',
  `actual_level_id` int NOT NULL DEFAULT '1',
  `leadership_rank` int DEFAULT '0',
  `leadership_points` int DEFAULT '0',
  `leadership_champions_rank` int DEFAULT '0',
  `champions_point` int DEFAULT NULL,
  `isRankAssigned` int NOT NULL DEFAULT '0',
  `isWithdrawAssigned` int NOT NULL DEFAULT '0',
  `promotion_status` text COLLATE utf8mb4_unicode_ci,
  `nonce` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iswallet_editable` tinyint(1) DEFAULT '1',
  `isphone_editable` tinyint(1) DEFAULT '1',
  `profile_image` text COLLATE utf8mb4_unicode_ci,
  `isFreePackage` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `app_id`, `name`, `email`, `phone`, `password`, `wallet_address`, `referral_code`, `telegram_username`, `sponsor_id`, `direct_ids`, `active_direct_ids`, `status`, `remember_token`, `role`, `level_id`, `actual_level_id`, `leadership_rank`, `leadership_points`, `leadership_champions_rank`, `champions_point`, `isRankAssigned`, `isWithdrawAssigned`, `promotion_status`, `nonce`, `iswallet_editable`, `isphone_editable`, `profile_image`, `isFreePackage`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'rahul@app.coms', '9000000001', '$2y$12$lvW.jg.njHMZjS5qXPkIUOtVHrtSgv3dKYHalbBNTv0uvW6OHnJAm', NULL, '59A66F', 'TELUSER123', NULL, '9/11/12/14', '11', 1, NULL, 'customer', 1, 4, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 1, 'user_profiles/1767173660_user1.png', 0, '2025-12-01 06:27:18', '2026-01-07 04:52:08'),
(9, 1, 'Blackshark', 'saad.apoorti@gmail.com', NULL, '$2y$12$lvW.jg.njHMZjS5qXPkIUOtVHrtSgv3dKYHalbBNTv0uvW6OHnJAm', '0xb7a538425d25fba4712886df7747cac897b4138e', '19F5CMJJ', NULL, 1, '10', '10', 1, NULL, 'customer', 1, 3, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 1, NULL, 0, '2026-01-02 19:09:04', '2026-01-05 20:23:14'),
(10, 1, 'Akmal', 'tirmizi.akmal@gmail.com', NULL, '$2y$12$lvW.jg.njHMZjS5qXPkIUOtVHrtSgv3dKYHalbBNTv0uvW6OHnJAm', NULL, '110C2SOAC', NULL, 9, '13', '13', 1, NULL, 'customer', 1, 2, 0, 0, 0, NULL, 0, 0, NULL, NULL, 1, 1, NULL, 0, '2026-01-02 19:12:36', '2026-01-07 00:05:43'),
(11, 1, 'Unknown', 'unknown@app.com', NULL, '$2y$12$lvW.jg.njHMZjS5qXPkIUOtVHrtSgv3dKYHalbBNTv0uvW6OHnJAm', '0x5eEC36681A4755742ECc57a3820143e9c8E50C95', '111XXK02D', 'UnknownMe', 1, NULL, NULL, 1, NULL, 'customer', 1, 1, 0, 0, 0, NULL, 0, 0, NULL, NULL, 1, 1, NULL, 1, '2026-01-03 09:58:39', '2026-01-04 05:01:11'),
(12, 1, 'Albert', 'bogdanchain98@gmail.com', '05678904311', '$2y$12$lvW.jg.njHMZjS5qXPkIUOtVHrtSgv3dKYHalbBNTv0uvW6OHnJAm', NULL, '112ETX9QV', NULL, 1, NULL, NULL, 1, NULL, 'customer', 1, 1, 0, 0, 0, NULL, 0, 0, NULL, NULL, 1, 1, NULL, 0, '2026-01-03 13:46:32', '2026-01-04 05:01:11'),
(13, 1, 'John', 'akmal.tirmizi@rediffmail.com', NULL, '$2y$12$lvW.jg.njHMZjS5qXPkIUOtVHrtSgv3dKYHalbBNTv0uvW6OHnJAm', '0xb67298cc3bd1842a76594dfe5cf1303c04ab9c9f', '113PSXBO6', 'abc', 10, NULL, NULL, 1, NULL, 'customer', 1, 1, 0, 0, 0, NULL, 0, 0, NULL, NULL, 0, 1, NULL, 0, '2026-01-03 14:27:10', '2026-01-07 00:40:05'),
(14, 1, 'LAZER FOCUS', 'tutorial010126@gmail.com', '07375710971', '$2y$12$lvW.jg.njHMZjS5qXPkIUOtVHrtSgv3dKYHalbBNTv0uvW6OHnJAm', NULL, '114WIZR4J', 'Tactical Human', 1, NULL, NULL, 1, NULL, 'customer', 1, 1, 0, 0, 0, NULL, 0, 0, NULL, NULL, 1, 1, NULL, 0, '2026-01-05 06:54:20', '2026-01-05 06:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `customer_deposits`
--

CREATE TABLE `customer_deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `package_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `roi_percent` decimal(5,2) NOT NULL,
  `roi_earned` decimal(12,4) DEFAULT '0.0000',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('pending','success','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `coin_price` decimal(10,4) NOT NULL,
  `is_free_deposit` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_deposits`
--

INSERT INTO `customer_deposits` (`id`, `app_id`, `customer_id`, `package_id`, `amount`, `roi_percent`, `roi_earned`, `transaction_id`, `payment_status`, `coin_price`, `is_free_deposit`, `created_at`, `updated_at`) VALUES
(26, 1, 9, 5, 100000.00, 0.00, 0.0000, 'FREEPACKAGE-iLub3xEy', 'success', 0.0000, 1, '2026-01-02 19:09:48', '2026-01-02 19:09:48'),
(27, 1, 10, 5, 100000.00, 0.00, 0.0000, 'FREEPACKAGE-qNQCAwSG', 'success', 0.0000, 1, '2026-01-02 21:25:18', '2026-01-02 21:25:18'),
(28, 1, 10, 2, 10.00, 1.00, 0.0000, 'DEPOSIT-VcJ7kSKf', 'success', 2.0000, 0, '2026-01-03 09:01:58', '2026-01-03 09:01:58'),
(29, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-KPMGi5ko', 'success', 2.0000, 0, '2026-01-03 10:09:23', '2026-01-03 10:09:23'),
(30, 1, 12, 5, 100000.00, 0.00, 0.0000, 'FREEPACKAGE-CWiNVNSr', 'success', 0.0000, 1, '2026-01-03 13:55:04', '2026-01-03 13:55:04'),
(31, 1, 13, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-kIkI645i', 'success', 2.0000, 0, '2026-01-03 14:33:58', '2026-01-03 14:33:58'),
(32, 1, 13, 5, 100000.00, 0.00, 0.0000, 'FREEPACKAGE-rr0ixBKM', 'success', 0.0000, 1, '2026-01-03 18:37:18', '2026-01-03 18:37:18'),
(33, 1, 14, 5, 100000.00, 0.00, 0.0000, 'FREEPACKAGE-FoKK0VA1', 'success', 0.0000, 1, '2026-01-05 06:57:38', '2026-01-05 06:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `customer_earning_details`
--

CREATE TABLE `customer_earning_details` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `reference_id` bigint UNSIGNED NOT NULL,
  `reference_amount` decimal(12,4) NOT NULL,
  `reference_level` int DEFAULT NULL,
  `amount_earned` decimal(12,4) NOT NULL,
  `flush_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `earning_type` enum('ROI','LEVEL-INCOME','BONUS','LEVEL-REWARD') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_earning_details`
--

INSERT INTO `customer_earning_details` (`id`, `app_id`, `customer_id`, `reference_id`, `reference_amount`, `reference_level`, `amount_earned`, `flush_amount`, `earning_type`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 9, 10, 10.0000, 1, 3.5000, 0.0000, 'LEVEL-REWARD', 1, '2026-01-03 09:01:58', '2026-01-03 09:01:58'),
(4, 1, 1, 11, 5.0000, 1, 1.7500, 0.0000, 'LEVEL-REWARD', 1, '2026-01-03 10:09:23', '2026-01-03 10:09:23'),
(5, 1, 10, 13, 5.0000, 1, 1.7500, 0.0000, 'LEVEL-REWARD', 1, '2026-01-03 14:33:58', '2026-01-03 14:33:58'),
(6, 1, 9, 13, 5.0000, 2, 1.7500, 0.0000, 'LEVEL-REWARD', 1, '2026-01-03 14:33:58', '2026-01-03 14:33:58'),
(7, 1, 1, 13, 5.0000, 3, 0.2500, 0.0000, 'LEVEL-REWARD', 1, '2026-01-03 14:33:58', '2026-01-03 14:33:58'),
(8, 1, 1, 10, 10.0000, 2, 1.0000, 0.0000, 'LEVEL-REWARD', 1, '2026-01-03 13:47:53', '2026-01-05 13:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `customer_financials`
--

CREATE TABLE `customer_financials` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `total_deposit` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `total_income` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `total_withdraws` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `capping_limit` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `total_topup` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_financials`
--

INSERT INTO `customer_financials` (`id`, `app_id`, `customer_id`, `total_deposit`, `total_income`, `total_withdraws`, `capping_limit`, `total_topup`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0.000000, 1.100000, 0.000000, 0.000000, 1.4000, '2025-12-31 09:10:55', '2026-01-06 09:28:29'),
(8, 1, 9, 0.000000, 5.250000, 0.000000, 0.000000, 5.5000, '2026-01-02 19:09:09', '2026-01-05 14:06:18'),
(9, 1, 10, 10.000000, 1.750000, 0.000000, 50.000000, 0.0000, '2026-01-02 19:12:55', '2026-01-03 14:33:58'),
(10, 1, 11, 5.000000, 0.000000, 0.000000, 25.000000, 5.0000, '2026-01-03 09:59:14', '2026-01-03 10:24:57'),
(11, 1, 12, 0.000000, 0.000000, 0.000000, 0.000000, 0.0000, '2026-01-03 13:54:42', '2026-01-03 13:54:42'),
(12, 1, 13, 5.000000, 0.000000, 0.000000, 25.000000, 4.5000, '2026-01-03 14:27:25', '2026-01-05 14:03:01'),
(13, 1, 14, 0.000000, 0.000000, 0.000000, 0.000000, 0.0000, '2026-01-05 06:55:54', '2026-01-05 06:55:54');

-- --------------------------------------------------------

--
-- Table structure for table `customer_flush_details`
--

CREATE TABLE `customer_flush_details` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `upline_id` bigint UNSIGNED NOT NULL,
  `reference_id` bigint UNSIGNED NOT NULL,
  `reference_amount` decimal(15,2) NOT NULL,
  `flush_amount` decimal(15,2) NOT NULL,
  `flush_level` int UNSIGNED NOT NULL,
  `reason` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_flush_details`
--

INSERT INTO `customer_flush_details` (`id`, `app_id`, `upline_id`, `reference_id`, `reference_amount`, `flush_amount`, `flush_level`, `reason`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 10, 10.00, 1.00, 2, 'NOT-ELIGIBLE', '2026-01-03 09:01:58', '2026-01-03 09:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `customer_settings`
--

CREATE TABLE `customer_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `isP2P` tinyint(1) NOT NULL DEFAULT '0',
  `isSelfTransfer` tinyint(1) NOT NULL DEFAULT '0',
  `isFreePackage` tinyint(1) NOT NULL DEFAULT '1',
  `isWithdraw` tinyint(1) NOT NULL DEFAULT '0',
  `isRankAssigned` tinyint(1) NOT NULL DEFAULT '0',
  `isWithdrawAssigned` tinyint(1) NOT NULL DEFAULT '0',
  `iswallet_editable` tinyint(1) NOT NULL DEFAULT '0',
  `isphone_editable` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_settings`
--

INSERT INTO `customer_settings` (`id`, `app_id`, `customer_id`, `isP2P`, `isSelfTransfer`, `isFreePackage`, `isWithdraw`, `isRankAssigned`, `isWithdrawAssigned`, `iswallet_editable`, `isphone_editable`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '2026-01-06 12:51:40', '2026-01-06 13:23:46'),
(2, 1, 9, 0, 0, 0, 0, 0, 0, 0, 0, '2026-01-06 12:51:40', '2026-01-06 12:51:40'),
(3, 1, 10, 0, 0, 0, 0, 0, 0, 0, 0, '2026-01-06 12:51:40', '2026-01-06 12:51:40'),
(4, 1, 11, 0, 0, 1, 0, 0, 0, 0, 0, '2026-01-06 12:51:40', '2026-01-06 12:51:40'),
(5, 1, 12, 0, 0, 0, 0, 0, 0, 0, 0, '2026-01-06 12:51:51', '2026-01-06 12:51:51'),
(6, 1, 13, 0, 0, 0, 0, 0, 0, 0, 0, '2026-01-06 12:51:51', '2026-01-06 12:51:51'),
(7, 1, 14, 0, 0, 0, 0, 0, 0, 0, 0, '2026-01-06 12:52:00', '2026-01-06 12:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer_withdraws`
--

CREATE TABLE `customer_withdraws` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `admin_charge` decimal(10,4) NOT NULL,
  `amount` decimal(10,4) NOT NULL,
  `net_amount` decimal(10,4) NOT NULL,
  `to_customer` int DEFAULT NULL,
  `transaction_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'withdraw',
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password_requests`
--

CREATE TABLE `forgot_password_requests` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `code` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `expires_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `free_deposit_packages`
--

CREATE TABLE `free_deposit_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `package_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

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
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `landing_user`
--

CREATE TABLE `landing_user` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telegram` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landing_user`
--

INSERT INTO `landing_user` (`id`, `name`, `email`, `country_code`, `phone`, `telegram`, `created_on`) VALUES
(1, 'Akmal Tirmizi', 'akmal.tirmizi@rediffmail.com', '+971', '502258570', NULL, '2026-01-05 13:24:10'),
(3, 'UNKNOWN', 'unknown@gmail.com', '+971', '78985126891', 'tghfjhijk', '2026-01-05 13:49:52'),
(4, 'dfhbfbhg', 'dfhdfh@rg.vom', '+376', '45798536458', 'kdjnmvdofjv', '2026-01-05 13:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_12_01_042935_create_apps_table', 1),
(2, '2025_12_01_043817_create_app_settings_table', 2),
(3, '0001_01_01_000000_create_users_table', 3),
(4, '2025_12_01_043930_create_nonce_table', 4),
(5, '0001_01_01_000001_create_cache_table', 5),
(6, '0001_01_01_000002_create_jobs_table', 6),
(7, '2025_11_29_131147_create_personal_access_tokens_table', 7),
(8, '2025_12_02_061151_create_app_packages_table', 8),
(9, '2025_12_03_093456_create_free_deposit_packages_table', 9),
(10, '2025_12_03_103914_create_wallet_transactions_table', 10),
(11, '2025_12_30_123116_create_admin_tutorials_table', 11),
(12, '2026_01_06_122603_create_customer_settings_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `ninepay_transactions`
--

CREATE TABLE `ninepay_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eth_9pay_json` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tron_9pay_json` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ninepay_transactions`
--

INSERT INTO `ninepay_transactions` (`id`, `transaction_id`, `eth_9pay_json`, `tron_9pay_json`, `payment_address`, `app_id`, `customer_id`, `amount`, `fees_amount`, `received_amount`, `remaining_amount`, `chain`, `network_type`, `network_name`, `currency`, `transaction_hash`, `payment_status`, `created_at`, `updated_at`) VALUES
(18, 'TXN1EBsl', '{\"address\":\"0x654727C481DC873233f11c76d3081c10F2B0c4a0\",\"createdAt\":\"2026-01-01T18:11:55.253Z\",\"info\":{\"provider\":null,\"address\":\"0x654727C481DC873233f11c76d3081c10F2B0c4a0\",\"publicKey\":\"0x039d7f67854f0a23ee477d2d9305d69a826d8356fb65a241ab0b4da81aa6b3de1c\",\"fingerprint\":\"0x21e07b02\",\"parentFingerprint\":\"0xb290d1de\",\"chainCode\":\"0x3dd4c0c0367f8e519d3a7e36adff9ed4ab5c2c55c55628414feec11023d09f9b\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TEnh4nDMzjT8wpkiBAVA5kTYZaoCW6PgiW\",\"createdAt\":\"2026-01-01T18:11:55.480Z\",\"userId\":\"TXN1EBsl\"}', '0x654727C481DC873233f11c76d3081c10F2B0c4a0', 1, 1, 10.000000, 1.000000, 0.000000, 11.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-01 18:11:55', '2026-01-02 13:02:52'),
(21, 'TXN1x5cf', '{\"address\":\"0xE758c82DC99A4aACCDB96A66Be8ea682aeae039f\",\"createdAt\":\"2026-01-02T13:03:23.217Z\",\"info\":{\"provider\":null,\"address\":\"0xE758c82DC99A4aACCDB96A66Be8ea682aeae039f\",\"publicKey\":\"0x026d908c9b16e742d4d45c335431997eac59ef3a3aed63a3f2166179dc2ee28446\",\"fingerprint\":\"0xa1597f5c\",\"parentFingerprint\":\"0x1500dcb5\",\"chainCode\":\"0x6eea48bb259a128493e47cac3a76c9ce23efc1007720e7ee085fbbf16ea5de23\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TJH5i5iw921SZPgdsTsNgjCxSXZ9zSktRn\",\"createdAt\":\"2026-01-02T13:03:23.718Z\",\"userId\":\"TXN1x5cf\"}', '0xE758c82DC99A4aACCDB96A66Be8ea682aeae039f', 1, 1, 10.000000, 1.000000, 0.000000, 11.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-02 13:03:23', '2026-01-04 11:46:54'),
(22, 'TXN100inB', '{\"address\":\"0x55b4d521451a1FAE1db7a2e25f4e9f208826a324\",\"createdAt\":\"2026-01-02T19:17:44.273Z\",\"info\":{\"provider\":null,\"address\":\"0x55b4d521451a1FAE1db7a2e25f4e9f208826a324\",\"publicKey\":\"0x03c1e9d253b88b827234635abfcac0609e7306d2f3ca646896df9c6bbe6ad98358\",\"fingerprint\":\"0xa64aa435\",\"parentFingerprint\":\"0x10271d10\",\"chainCode\":\"0xcf6e97c5725cfdb78a5670c9ced5be3ceb78e7b459c7282bcf9a2032fece1861\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TCJJAPHJDo5HuXxZyfLdzdJLvF2n4PS268\",\"createdAt\":\"2026-01-02T19:17:44.524Z\",\"userId\":\"TXN100inB\"}', '0x55b4d521451a1FAE1db7a2e25f4e9f208826a324', 1, 10, 5.000000, 1.000000, 0.000000, 6.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-02 19:17:44', '2026-01-02 19:18:34'),
(23, 'TXN106hRs', '{\"address\":\"0x27958a621B0B474d659a0444b66A733F25490EEB\",\"createdAt\":\"2026-01-02T19:18:53.203Z\",\"info\":{\"provider\":null,\"address\":\"0x27958a621B0B474d659a0444b66A733F25490EEB\",\"publicKey\":\"0x03afaf664fb4e516422eabdbee72b47d9f2ee0129ec06b320490b81e81ab914cbd\",\"fingerprint\":\"0xbd063973\",\"parentFingerprint\":\"0x6a7f8bf0\",\"chainCode\":\"0x01bf582690f90d8179f948814fa023bbfa9750b3e649e9dcca981922dabf1747\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TV2kmJ8bdKhLsg3rARR4rNLjjuACwJES8i\",\"createdAt\":\"2026-01-02T19:18:53.405Z\",\"userId\":\"TXN106hRs\"}', '0x27958a621B0B474d659a0444b66A733F25490EEB', 1, 10, 5.000000, 0.500000, 0.000000, 5.5000, 'evm', 'evm', 'polygon', 'USDT', NULL, 'cancel', '2026-01-02 19:18:53', '2026-01-02 19:19:42'),
(24, 'TXN101Fqk', '{\"address\":\"0x1340F42DdAf75F60b30F102a44694b1854282bD0\",\"createdAt\":\"2026-01-02T19:19:51.585Z\",\"info\":{\"provider\":null,\"address\":\"0x1340F42DdAf75F60b30F102a44694b1854282bD0\",\"publicKey\":\"0x036fe477b2c959eaa770940960811731cc0ae0b94cc6b67c9c9a34b0487f326d80\",\"fingerprint\":\"0x71849e57\",\"parentFingerprint\":\"0xc8a6e0fd\",\"chainCode\":\"0xeda0316648fef807862ada7b018e5d2533a5d4dc42a9a57016dcd7747f3aac49\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TDuVth4Feu5DUDGCva6ejZ3zw59ba2fJEh\",\"createdAt\":\"2026-01-02T19:19:51.800Z\",\"userId\":\"TXN101Fqk\"}', '0x1340F42DdAf75F60b30F102a44694b1854282bD0', 1, 10, 5.000000, 1.000000, 0.000000, 6.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-02 19:19:51', '2026-01-02 19:20:47'),
(25, 'TXN10ukdc', '{\"address\":\"0x975040D3D05F5fD1e7b2418CeBa6c763a7d4b414\",\"createdAt\":\"2026-01-02T19:20:57.667Z\",\"info\":{\"provider\":null,\"address\":\"0x975040D3D05F5fD1e7b2418CeBa6c763a7d4b414\",\"publicKey\":\"0x02d65df45f43e4f31945d7c05ccc3f8a2dbca29e34858d7ec848aff2d269b0a77c\",\"fingerprint\":\"0x9586fb68\",\"parentFingerprint\":\"0x11b0db8a\",\"chainCode\":\"0x6dc2c97e7ec7e5356dca368a1db824494a67cf73551fba34592e31a3a5527a91\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TScgf2fFrkyKQLEjCXemgsQNzKeYiDEfxE\",\"createdAt\":\"2026-01-02T19:20:57.904Z\",\"userId\":\"TXN10ukdc\"}', '0x975040D3D05F5fD1e7b2418CeBa6c763a7d4b414', 1, 10, 10.000000, 1.000000, 11.000000, 0.0000, 'evm', 'evm', 'bsc', 'USDT', '0x8ae9b6d430e1e20a1c0d7c9703dc0b7091bef2d9fce5bbee45025d207e4f3629', 'success', '2026-01-02 19:20:57', '2026-01-03 08:03:34'),
(26, 'TXN9B9O9', '{\"address\":\"0x589F6a2c92497fE4eE86C05c599479eC75f65A38\",\"createdAt\":\"2026-01-02T20:16:24.549Z\",\"info\":{\"provider\":null,\"address\":\"0x589F6a2c92497fE4eE86C05c599479eC75f65A38\",\"publicKey\":\"0x0245ccd7503aba155972bd86ec89dac918a2f61e3d9fbc884409309f725ecdeadf\",\"fingerprint\":\"0x0903e5e6\",\"parentFingerprint\":\"0x826082c0\",\"chainCode\":\"0xee4c55895452d0c347a9699848624264fed73f6cdfb9aad4d96218215b188046\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TGTxHWaA2t9vSVyQbnqdMeX89xehhCMLCW\",\"createdAt\":\"2026-01-02T20:16:24.781Z\",\"userId\":\"TXN9B9O9\"}', '0x589F6a2c92497fE4eE86C05c599479eC75f65A38', 1, 9, 25.000000, 0.500000, 0.000000, 25.5000, 'evm', 'evm', 'polygon', 'USDT', NULL, 'cancel', '2026-01-02 20:16:24', '2026-01-02 20:16:36'),
(27, 'TXN9rWGh', '{\"address\":\"0xA8036a2BECeeB079dE5C51436E6CCD9867817E28\",\"createdAt\":\"2026-01-02T20:16:45.274Z\",\"info\":{\"provider\":null,\"address\":\"0xA8036a2BECeeB079dE5C51436E6CCD9867817E28\",\"publicKey\":\"0x02b6c9d5eeb5ba10e5591e5950af06eff8f3b5d7c064ff803cdaa75299916aca82\",\"fingerprint\":\"0x266e88ad\",\"parentFingerprint\":\"0xd5d74dcc\",\"chainCode\":\"0x5f542e2c2fc2320403116587754736c03a62a9d356ca7cc672645b63b8453653\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TYXbQCRfzum17qXJ8yNAnbUfauGWFiV9mz\",\"createdAt\":\"2026-01-02T20:16:45.481Z\",\"userId\":\"TXN9rWGh\"}', '0xA8036a2BECeeB079dE5C51436E6CCD9867817E28', 1, 9, 25.000000, 1.000000, 0.000000, 26.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-02 20:16:45', '2026-01-03 07:00:22'),
(28, 'TXN9RJye', '{\"address\":\"0xb62931fA635E152CeA93D643b03C57927a842B21\",\"createdAt\":\"2026-01-03T07:00:45.059Z\",\"info\":{\"provider\":null,\"address\":\"0xb62931fA635E152CeA93D643b03C57927a842B21\",\"publicKey\":\"0x022854095c9c9587263a50370c3435adf5779f00d10b7ad0eea6b3636b366dc426\",\"fingerprint\":\"0xaf3b5798\",\"parentFingerprint\":\"0xc2966734\",\"chainCode\":\"0x6ca59d0eccfe46562d6946ce84a22f8fbde2cb0f1cecb9e5c0c6c42ebc6cc3fb\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TBB639ZuVtsm3ryvFYb4iK9otpo5RXaRBH\",\"createdAt\":\"2026-01-03T07:00:45.494Z\",\"userId\":\"TXN9RJye\"}', '0xb62931fA635E152CeA93D643b03C57927a842B21', 1, 9, 5.000000, 1.000000, 0.000000, 6.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-03 07:00:45', '2026-01-03 07:02:21'),
(29, 'TXN9noOG', '{\"address\":\"0x5688610F55880Ce3D0698B03279A51333aC103E0\",\"createdAt\":\"2026-01-03T07:02:35.078Z\",\"info\":{\"provider\":null,\"address\":\"0x5688610F55880Ce3D0698B03279A51333aC103E0\",\"publicKey\":\"0x02dbde49c0ac7da8c1a3baa437e56eae5c9b24d677f241edbfec3b21ad98c1a333\",\"fingerprint\":\"0xc11e0df2\",\"parentFingerprint\":\"0x05312cdf\",\"chainCode\":\"0x05beb45b492f85982cf24c3a9b7ece784319ef4822553ffbda275822c97f0bae\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TNLonzY48KKjUDXMTBy82Tz4eiFntGBpX7\",\"createdAt\":\"2026-01-03T07:02:35.325Z\",\"userId\":\"TXN9noOG\"}', '0x5688610F55880Ce3D0698B03279A51333aC103E0', 1, 9, 10.000000, 1.000000, 0.000000, 11.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-03 07:02:35', '2026-01-03 09:19:59'),
(30, 'TXN11bbvt', '{\"address\":\"0xC1E8fD3bDE55e07C21A5BC13871B2cA1aC34A9b6\",\"createdAt\":\"2026-01-03T10:03:41.794Z\",\"info\":{\"provider\":null,\"address\":\"0xC1E8fD3bDE55e07C21A5BC13871B2cA1aC34A9b6\",\"publicKey\":\"0x039e2aa591b00a6b84396a4d9cf62e4c4fff766febadd37aedc3c62c56a7a5fa78\",\"fingerprint\":\"0x3b3f9669\",\"parentFingerprint\":\"0xddd5f51b\",\"chainCode\":\"0x3094bc993fcc0d9b83f5b3f39eca8ea28e75feb1b8abc23cf653322231fa25c1\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TR8fNSA3fa71a2w11GUJRx1V4j1kBi7Msy\",\"createdAt\":\"2026-01-03T10:03:42.256Z\",\"userId\":\"TXN11bbvt\"}', '0xC1E8fD3bDE55e07C21A5BC13871B2cA1aC34A9b6', 1, 11, 5.000000, 0.500000, 5.500000, 0.0000, 'evm', 'evm', 'polygon', 'USDT', '0x972633b7d24de3490b98d9d05c97c29b5123ae2cebcf0a455085c6f1e05cfcb0', 'success', '2026-01-03 10:03:42', '2026-01-03 10:05:26'),
(31, 'TXN11p1HV', '{\"address\":\"0x4e4aD2629E822D84AC8bd52CeE969d04C2a235a3\",\"createdAt\":\"2026-01-03T10:20:26.808Z\",\"info\":{\"provider\":null,\"address\":\"0x4e4aD2629E822D84AC8bd52CeE969d04C2a235a3\",\"publicKey\":\"0x02dee8ecf50814256d745d0a7c74d573b359af40923cc439c8897329da5d4cf92e\",\"fingerprint\":\"0xc0e9b013\",\"parentFingerprint\":\"0x9128052d\",\"chainCode\":\"0xa89c5aebd5505d1f279500f7c6464ddd2fa0df916244f679fd33274d8183c105\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TMcq4kten6szrGxwxDFksXojrSr6vmV2sv\",\"createdAt\":\"2026-01-03T10:20:27.077Z\",\"userId\":\"TXN11p1HV\"}', '0x4e4aD2629E822D84AC8bd52CeE969d04C2a235a3', 1, 11, 5.000000, 1.000000, 0.000000, 6.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-03 10:20:27', '2026-01-03 10:21:02'),
(32, 'TXN11ZWcF', '{\"address\":\"0x4162d8A3dB87B491c118Bf59C45Fdd9E1dC88486\",\"createdAt\":\"2026-01-03T10:21:48.707Z\",\"info\":{\"provider\":null,\"address\":\"0x4162d8A3dB87B491c118Bf59C45Fdd9E1dC88486\",\"publicKey\":\"0x038bc84dda5e363867b84d80274bf9941c2d97ffa91b729e37a490eed81ebf52b0\",\"fingerprint\":\"0x0a2fec81\",\"parentFingerprint\":\"0x4933fce6\",\"chainCode\":\"0x4b967c90531c9f1ddab76badd768339e76b74e40041fd02911f5355e648f209d\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TXtYa9v5931hsxuB6HsVGDGMA28XxS71Yy\",\"createdAt\":\"2026-01-03T10:21:48.940Z\",\"userId\":\"TXN11ZWcF\"}', '0x4162d8A3dB87B491c118Bf59C45Fdd9E1dC88486', 1, 11, 5.000000, 0.500000, 6.000000, 0.0000, 'evm', 'evm', 'polygon', 'USDT', '0xf3261d991b14cc640f50316de2142c3806ac1807c5bdcbee9357015f23332106', 'success', '2026-01-03 10:21:49', '2026-01-03 10:24:57'),
(33, 'TXN10Zrq0', '{\"address\":\"0x447cA102D9aCb3970B566C8170f77EA941219155\",\"createdAt\":\"2026-01-03T12:54:35.650Z\",\"info\":{\"provider\":null,\"address\":\"0x447cA102D9aCb3970B566C8170f77EA941219155\",\"publicKey\":\"0x036dda1e1e426a00c32b65ee293d8f69ff763aa6acb8f82eed35f5c2efe27c22ae\",\"fingerprint\":\"0x2f7555f2\",\"parentFingerprint\":\"0x4340883e\",\"chainCode\":\"0x1d08b5fbfecc059572767e03d14f66bd8212f942d35c8a41d8d6c2a528173831\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TSzZxR2ALixB8ckDkjGmbVBW9fNwmGKpTo\",\"createdAt\":\"2026-01-03T12:54:36.183Z\",\"userId\":\"TXN10Zrq0\"}', '0x447cA102D9aCb3970B566C8170f77EA941219155', 1, 10, 10.000000, 1.000000, 0.000000, 11.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-03 12:54:36', '2026-01-03 12:55:07'),
(34, 'TXN10AGbo', '{\"address\":\"0xADc2a00Ba84134c6A94aCc1eA271CC42f69853F0\",\"createdAt\":\"2026-01-03T12:55:21.823Z\",\"info\":{\"provider\":null,\"address\":\"0xADc2a00Ba84134c6A94aCc1eA271CC42f69853F0\",\"publicKey\":\"0x036fe9d8d08d41d5cf6db87acb7d670b0fa0392029aa4f64d61cda5453095c4c97\",\"fingerprint\":\"0x021e46cc\",\"parentFingerprint\":\"0x8262152b\",\"chainCode\":\"0x609b5468de9ddbd3e76854e498687402bdf3ed013b936aa94a3708e7c8109689\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TXib1WjM2k6YjB6WX7MVbuYmSudTeJuvjX\",\"createdAt\":\"2026-01-03T12:55:22.062Z\",\"userId\":\"TXN10AGbo\"}', '0xADc2a00Ba84134c6A94aCc1eA271CC42f69853F0', 1, 10, 10.000000, 0.500000, 0.000000, 10.5000, 'evm', 'evm', 'polygon', 'USDT', NULL, 'cancel', '2026-01-03 12:55:22', '2026-01-03 12:56:09'),
(35, 'TXN10bBEw', '{\"address\":\"0x39866d449Beb97a1ABe14164C26548ea71e9774D\",\"createdAt\":\"2026-01-03T12:56:19.403Z\",\"info\":{\"provider\":null,\"address\":\"0x39866d449Beb97a1ABe14164C26548ea71e9774D\",\"publicKey\":\"0x025cc504b0add9335e0fd8d36f25d50aefd8df81c6b2860082064dbfd182bc9be0\",\"fingerprint\":\"0x556069a8\",\"parentFingerprint\":\"0xb6f24134\",\"chainCode\":\"0xbaf2739f3c19a987342eef6a2a1ef82459e1a1ec35414d1d3aa8c91a0844c36a\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TR8e6zqKFV4YwYkJLTCEU7xwifWVJGsSca\",\"createdAt\":\"2026-01-03T12:56:19.624Z\",\"userId\":\"TXN10bBEw\"}', '0x39866d449Beb97a1ABe14164C26548ea71e9774D', 1, 10, 50.000000, 1.000000, 0.000000, 51.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-03 12:56:19', '2026-01-03 12:59:56'),
(36, 'TXN10tQXe', '{\"address\":\"0x380d2bc67616BE4c49A2Af463DdDea2cBc0D2fd4\",\"createdAt\":\"2026-01-03T13:00:05.048Z\",\"info\":{\"provider\":null,\"address\":\"0x380d2bc67616BE4c49A2Af463DdDea2cBc0D2fd4\",\"publicKey\":\"0x0386cc2f6a875e5259309c1b0e81434183d9bca4509f080bba051b15ea36dcbdc5\",\"fingerprint\":\"0xd6508280\",\"parentFingerprint\":\"0x28ee40ea\",\"chainCode\":\"0x43828b53c543894ba6ee1b8de140165d66f8fe357303089b16ff27c8f60966f3\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TEWWrq8AyhARmPakmdm66rxRHV5jzHi8Bw\",\"createdAt\":\"2026-01-03T13:00:05.308Z\",\"userId\":\"TXN10tQXe\"}', '0x380d2bc67616BE4c49A2Af463DdDea2cBc0D2fd4', 1, 10, 10.000000, 0.500000, 0.000000, 10.5000, 'evm', 'evm', 'polygon', 'USDT', NULL, 'cancel', '2026-01-03 13:00:05', '2026-01-03 13:02:25'),
(37, 'TXN10w7ie', '{\"address\":\"0x580B39FF2e6027c619D33E656b855D85F76862A0\",\"createdAt\":\"2026-01-03T13:02:34.484Z\",\"info\":{\"provider\":null,\"address\":\"0x580B39FF2e6027c619D33E656b855D85F76862A0\",\"publicKey\":\"0x0377cbd111ae019aade2cf0f8d339d4ac908d9d74f0bc622135f1da6f43a78f845\",\"fingerprint\":\"0x95e62a6a\",\"parentFingerprint\":\"0x0535498a\",\"chainCode\":\"0xdedbe36253c649a0993331bc8ec6021ecd489b0271b5968dd4404fa273543cb3\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TXgtPy5Vzebd2bDA5kFq2DW4h9XJhcHHHV\",\"createdAt\":\"2026-01-03T13:02:34.708Z\",\"userId\":\"TXN10w7ie\"}', '0x580B39FF2e6027c619D33E656b855D85F76862A0', 1, 10, 10.000000, 1.000000, 0.000000, 11.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-03 13:02:34', '2026-01-03 13:12:28'),
(38, 'TXN9XsVl', '{\"address\":\"0xa281Cec96eA0966CaA2DF665F9EB76ea1209Ae85\",\"createdAt\":\"2026-01-03T13:38:54.479Z\",\"info\":{\"provider\":null,\"address\":\"0xa281Cec96eA0966CaA2DF665F9EB76ea1209Ae85\",\"publicKey\":\"0x02cac6dd7857dee5b2a8a080db382b268ed12ec0cbd304ef8574a88b51bf5ea8ca\",\"fingerprint\":\"0x241ec722\",\"parentFingerprint\":\"0x6ee77926\",\"chainCode\":\"0xfeee966ab5a882232b9053996d9bac488f4b7a32ccba999c80af6e49b9dc76eb\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TPcPV2EXC3JJpc81jbDeJFmwYEshfQM1oy\",\"createdAt\":\"2026-01-03T13:38:54.708Z\",\"userId\":\"TXN9XsVl\"}', '0xa281Cec96eA0966CaA2DF665F9EB76ea1209Ae85', 1, 9, 5.000000, 0.500000, 0.000000, 5.5000, 'evm', 'evm', 'polygon', 'USDT', NULL, 'cancel', '2026-01-03 13:38:54', '2026-01-03 13:43:53'),
(39, 'TXN9Wm0I', '{\"address\":\"0xaC2277E57fb290B9F990B22Dd1c24F832Ef1b7ab\",\"createdAt\":\"2026-01-03T13:45:39.428Z\",\"info\":{\"provider\":null,\"address\":\"0xaC2277E57fb290B9F990B22Dd1c24F832Ef1b7ab\",\"publicKey\":\"0x03ffd375b5bed4116a4979be7dbfb9796adba6ce15bf3e671f4cc5708e526d41b7\",\"fingerprint\":\"0x250c404f\",\"parentFingerprint\":\"0x4047ce2a\",\"chainCode\":\"0x5e50b85bb4bf5f6f98af2542d2460ceb7d2f60b751b762deb351bc21ff09eb19\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TN7DrnCByFmWaHgpnUxbMyLCNYPQ1YSgfX\",\"createdAt\":\"2026-01-03T13:45:39.662Z\",\"userId\":\"TXN9Wm0I\"}', '0xaC2277E57fb290B9F990B22Dd1c24F832Ef1b7ab', 1, 9, 5.000000, 1.000000, 0.000000, 6.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-03 13:45:39', '2026-01-03 13:46:52'),
(40, 'TXN9DWa6', '{\"address\":\"0x12DB26466AF0F766cC9BcFB929f4C75707137457\",\"createdAt\":\"2026-01-03T14:05:21.762Z\",\"info\":{\"provider\":null,\"address\":\"0x12DB26466AF0F766cC9BcFB929f4C75707137457\",\"publicKey\":\"0x03f6eb03c747b8d4ce435acd5d7aabc98e25f6f8ed69290344a7031a9c2eba3022\",\"fingerprint\":\"0xe9bfec5e\",\"parentFingerprint\":\"0xc9d78ada\",\"chainCode\":\"0xc47797968e732d282df633efea6f0461079318021783b39f8a38123824a4789b\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TGURvbbUtjjzLryRGhoNgsJU1M5yLQEDxo\",\"createdAt\":\"2026-01-03T14:05:22.004Z\",\"userId\":\"TXN9DWa6\"}', '0x12DB26466AF0F766cC9BcFB929f4C75707137457', 1, 9, 5.000000, 0.500000, 5.500000, 0.0000, 'evm', 'evm', 'polygon', 'USDT', '0x05578e12a84efbf898186ea353490383f60cc5e046eacfbcd884c5f26c23899b', 'success', '2026-01-03 14:05:22', '2026-01-03 14:10:34'),
(41, 'TXN9Wfpi', '{\"address\":\"0x5bc2284125209A29eA5C263a51AcC9dbB9D6b2Ec\",\"createdAt\":\"2026-01-03T14:11:07.147Z\",\"info\":{\"provider\":null,\"address\":\"0x5bc2284125209A29eA5C263a51AcC9dbB9D6b2Ec\",\"publicKey\":\"0x0341fe02e96f1b5a03703587a1dbfc39d7a422d38a2f41af8583aa1e34c426d7e0\",\"fingerprint\":\"0x24b629f8\",\"parentFingerprint\":\"0xd3c09079\",\"chainCode\":\"0x8fadf4456847f58456c6e1cc81e7532f1223a36c012c5c7df62ecdcd5a6fc6f3\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TRSdhmrknnoPUPsgzULwctjKff8tn5Z4VH\",\"createdAt\":\"2026-01-03T14:11:07.367Z\",\"userId\":\"TXN9Wfpi\"}', '0x5bc2284125209A29eA5C263a51AcC9dbB9D6b2Ec', 1, 9, 5.000000, 0.500000, 5.500000, 0.0000, 'evm', 'evm', 'polygon', 'USDT', NULL, 'cancel', '2026-01-03 14:11:07', '2026-01-03 14:11:07'),
(42, 'TXN10svk0', '{\"address\":\"0x21eB8F70f4748b0CacfBEF4e76a20e483D30a3B1\",\"createdAt\":\"2026-01-03T14:16:23.495Z\",\"info\":{\"provider\":null,\"address\":\"0x21eB8F70f4748b0CacfBEF4e76a20e483D30a3B1\",\"publicKey\":\"0x03fc46a2ebc4aa036966774f7b059cbb38bd1978ae5027537014fd30180820f32e\",\"fingerprint\":\"0x542abe72\",\"parentFingerprint\":\"0x8e2ab989\",\"chainCode\":\"0x9aa620f7c9b26969b58f77afcdba81a248e9d250b91197dc59f5d337cb005a3d\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TUrqaSQkHUMeTQyGgXgvYCfYuFKJHyrEpw\",\"createdAt\":\"2026-01-03T14:16:23.747Z\",\"userId\":\"TXN10svk0\"}', '0x21eB8F70f4748b0CacfBEF4e76a20e483D30a3B1', 1, 10, 10.000000, 0.500000, 0.000000, 10.5000, 'evm', 'evm', 'polygon', 'USDT', NULL, 'cancel', '2026-01-03 14:16:23', '2026-01-05 10:15:56'),
(43, 'TXN11IYpg', '{\"address\":\"0x4A3F639eAC274140BE1c4C4bf0AD934dA20847C7\",\"createdAt\":\"2026-01-03T14:20:02.779Z\",\"info\":{\"provider\":null,\"address\":\"0x4A3F639eAC274140BE1c4C4bf0AD934dA20847C7\",\"publicKey\":\"0x0240604be553a79da465aba90d532b8fb9211ef83bac88b398568c8a94099f2dcd\",\"fingerprint\":\"0x415de475\",\"parentFingerprint\":\"0xbc9d27f6\",\"chainCode\":\"0x799c4d17f6ac7e6057481c3d1949c1c6874a47a178289ec9201a81100c0915e6\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TKCf8A4mVyf8WuiuobvePytzcJRJV7wDaR\",\"createdAt\":\"2026-01-03T14:20:03.098Z\",\"userId\":\"TXN11IYpg\"}', '0x4A3F639eAC274140BE1c4C4bf0AD934dA20847C7', 1, 11, 5.000000, 0.500000, 0.000000, 5.5000, 'evm', 'evm', 'polygon', 'USDT', NULL, 'cancel', '2026-01-03 14:20:03', '2026-01-03 14:22:36'),
(44, 'TXN11ujq5', '{\"address\":\"0x37a389B1f4708b72DeDDF2d8446E1B67557d691D\",\"createdAt\":\"2026-01-03T14:22:42.463Z\",\"info\":{\"provider\":null,\"address\":\"0x37a389B1f4708b72DeDDF2d8446E1B67557d691D\",\"publicKey\":\"0x03cf2a1e193039d89d7401fdf30c0640a9e4ef70cc57a0234ab675201968c6b9ed\",\"fingerprint\":\"0x8bba9235\",\"parentFingerprint\":\"0xa3e6b40d\",\"chainCode\":\"0x55fa5a0995cf4bdad19fe798380a593bd73d9caa7bce3f5f5b824f70c537c770\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TL7YqxE37h82h9Z7D1hW4hDH5XirVejXWL\",\"createdAt\":\"2026-01-03T14:22:42.744Z\",\"userId\":\"TXN11ujq5\"}', '0x37a389B1f4708b72DeDDF2d8446E1B67557d691D', 1, 11, 5.000000, 1.000000, 0.000000, 6.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-03 14:22:42', '2026-01-03 15:12:27'),
(45, 'TXN139UPb', '{\"address\":\"0x5cFb6ADBBd5A0874c0983d554E1800A26e594618\",\"createdAt\":\"2026-01-03T14:28:25.843Z\",\"info\":{\"provider\":null,\"address\":\"0x5cFb6ADBBd5A0874c0983d554E1800A26e594618\",\"publicKey\":\"0x03d14e57aaec97ccbf688b9189106f92b0bd1aab450ed10982d30c76bde026cf20\",\"fingerprint\":\"0x014edd26\",\"parentFingerprint\":\"0x83fdca38\",\"chainCode\":\"0x7f9c266557098d38df3eb4993126b63a1ca72cfc72ec43cc2b9b28078a44f0f8\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TJgcVAbcRjVLTs1Z21Gi23bZq2T1HiPy5P\",\"createdAt\":\"2026-01-03T14:28:26.065Z\",\"userId\":\"TXN139UPb\"}', '0x5cFb6ADBBd5A0874c0983d554E1800A26e594618', 1, 13, 10.000000, 0.500000, 10.000000, 1.0000, 'evm', 'evm', 'polygon', 'USDT', '0x5acd450cab9f277b2b07ee3be3a58c5ad2100677128e624cefd48b1cecb8d17c', 'underpaid', '2026-01-03 14:28:26', '2026-01-03 14:30:06'),
(46, 'TXN11HoJX', '{\"address\":\"0x80dfE35EAFdfa6E0611EE8fBcdDb5d2D671C7c66\",\"createdAt\":\"2026-01-03T15:12:30.758Z\",\"info\":{\"provider\":null,\"address\":\"0x80dfE35EAFdfa6E0611EE8fBcdDb5d2D671C7c66\",\"publicKey\":\"0x023228de2558858480acb1be1f782e436c486a8f51b9a6c24848f98ebd8762a135\",\"fingerprint\":\"0x1e6b8eec\",\"parentFingerprint\":\"0x06feebba\",\"chainCode\":\"0x024f263d11c8d69f8c3de6c7893e65fc1b2c45e9fcbcd2f4bb14f08febffc79c\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TM27MPsjPx1KtXPsURBzkYPuAdkgjR5At4\",\"createdAt\":\"2026-01-03T15:12:31.590Z\",\"userId\":\"TXN11HoJX\"}', '0x80dfE35EAFdfa6E0611EE8fBcdDb5d2D671C7c66', 1, 11, 5.000000, 0.500000, 0.000000, 5.5000, 'evm', 'evm', 'polygon', 'USDT', NULL, 'pending', '2026-01-03 15:12:31', '2026-01-03 15:12:31'),
(47, 'TXN1kky3', '{\"address\":\"0x3bCF6D539f97f8f2604B2321619b4bD2dAE51F47\",\"createdAt\":\"2026-01-04T11:47:17.641Z\",\"info\":{\"provider\":null,\"address\":\"0x3bCF6D539f97f8f2604B2321619b4bD2dAE51F47\",\"publicKey\":\"0x029182ee2559edea7bd21d76482f8aba5ec471865793e6e7809aadafc7f863789b\",\"fingerprint\":\"0xe5c478d8\",\"parentFingerprint\":\"0x9538717e\",\"chainCode\":\"0x5955c6e8d9f9ec1d1b5d7a2ee295400e5046b6b14c9417b64dac2939c4feef00\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TMMzQgcQ5MMbnbMN52jxRgvfkLHpuAjaxd\",\"createdAt\":\"2026-01-04T11:47:18.081Z\",\"userId\":\"TXN1kky3\"}', '0x3bCF6D539f97f8f2604B2321619b4bD2dAE51F47', 1, 1, 10.000000, 0.500000, 0.000000, 10.5000, 'evm', 'evm', 'polygon', 'USDT', NULL, 'cancel', '2026-01-04 11:47:18', '2026-01-04 11:48:54'),
(48, 'TXN1052qb', '{\"address\":\"0x773D32c5D7d89d8E0225d9F724269f7e53406A0c\",\"createdAt\":\"2026-01-05T10:32:32.699Z\",\"info\":{\"provider\":null,\"address\":\"0x773D32c5D7d89d8E0225d9F724269f7e53406A0c\",\"publicKey\":\"0x03b9ab8d716239be98ef4e6822423051db83c109d9cc90ef5f6e18fd26e287abeb\",\"fingerprint\":\"0x96043c95\",\"parentFingerprint\":\"0x2040bce6\",\"chainCode\":\"0x9f3f55c4865dfaa7cf3221a34bbb50992d2ded4b5e319f8d7230be100e01e95e\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TGh88kAzpbTFqEx3X5nLArBkzxbkyYP7qD\",\"createdAt\":\"2026-01-05T10:32:32.939Z\",\"userId\":\"TXN1052qb\"}', '0x773D32c5D7d89d8E0225d9F724269f7e53406A0c', 1, 10, 5.000000, 1.000000, 0.000000, 6.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-05 10:32:33', '2026-01-05 10:32:42'),
(49, 'TXN10Hffm', '{\"address\":\"0x9B598E90f5eD93f1e7B5cE3952d8eA0c6c961970\",\"createdAt\":\"2026-01-05T10:32:52.161Z\",\"info\":{\"provider\":null,\"address\":\"0x9B598E90f5eD93f1e7B5cE3952d8eA0c6c961970\",\"publicKey\":\"0x03f42898148122e24d1d1e273ebf8846b9e4b3216290dadd566a0838627b43d3e1\",\"fingerprint\":\"0x8308e6ef\",\"parentFingerprint\":\"0x545e5f91\",\"chainCode\":\"0xf055846bab4cf566241eeb1738ed5e7c3092b6c46eff142a72906ba46ccb574d\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TAjqcwizyc8YsVeDxvt3Ea2cBytsi1iLNM\",\"createdAt\":\"2026-01-05T10:32:52.424Z\",\"userId\":\"TXN10Hffm\"}', '0x9B598E90f5eD93f1e7B5cE3952d8eA0c6c961970', 1, 10, 5.000000, 0.500000, 0.000000, 5.5000, 'evm', 'evm', 'polygon', 'USDT', NULL, 'cancel', '2026-01-05 10:32:52', '2026-01-05 10:33:11'),
(50, 'TXN101mQY', '{\"address\":\"0x63617fC4EB446da667f6eA8B0C7D0bc0317ad3ed\",\"createdAt\":\"2026-01-05T10:33:28.029Z\",\"info\":{\"provider\":null,\"address\":\"0x63617fC4EB446da667f6eA8B0C7D0bc0317ad3ed\",\"publicKey\":\"0x02d2aa37ca37ff67db04ebb01241fbfc39e534cd6630ea64ef9a0383139cd7e0a3\",\"fingerprint\":\"0x3d2fe150\",\"parentFingerprint\":\"0xcf1a7aab\",\"chainCode\":\"0xb4ca203756cccca91c81ba32df4e4fecb7eed38d6b862de413f1d786c75680d7\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TAJEjz7L7KTgNEd15wtGBYy1yrs1pexMs2\",\"createdAt\":\"2026-01-05T10:33:28.267Z\",\"userId\":\"TXN101mQY\"}', '0x63617fC4EB446da667f6eA8B0C7D0bc0317ad3ed', 1, 10, 5.000000, 1.000000, 0.000000, 6.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-05 10:33:28', '2026-01-05 10:33:41');

-- --------------------------------------------------------

--
-- Table structure for table `nonces`
--

CREATE TABLE `nonces` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `wallet_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nonce` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('lbXwbgZBtgTMupYscNltbunFyNyuLrNKK0y93R1q', NULL, '172.70.108.219', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkVQMmZjVHhGZ05ITkd6SHF5SWhqS2NSc3FGZWZ5Z2Rpd1dhTkc4UCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767762362);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_id` bigint UNSIGNED DEFAULT NULL,
  `wallet_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `app_id`, `wallet_address`, `phone`, `blocked`, `role`, `meta`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'sa@app.com', NULL, '$2y$12$mfB7TjU6X.H8K7ww0j79kuSvZS1np24V6JrV3zrFu7HaeG652b/IW', NULL, NULL, NULL, 0, 'superadmin', NULL, NULL, '2025-12-01 00:25:22', '2025-12-01 00:25:22'),
(2, 'Admin User', 'admin@app.com', NULL, '$2y$12$mfB7TjU6X.H8K7ww0j79kuSvZS1np24V6JrV3zrFu7HaeG652b/IW', 1, NULL, NULL, 0, 'admin', NULL, NULL, '2025-12-01 03:57:00', '2025-12-01 03:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `voter_id` bigint UNSIGNED NOT NULL,
  `sponsor_id` bigint UNSIGNED NOT NULL,
  `voted_for` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` bigint UNSIGNED NOT NULL,
  `payer_id` bigint UNSIGNED NOT NULL,
  `receiver_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,4) NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tutorials`
--
ALTER TABLE `admin_tutorials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_tutorials_app_id_index` (`app_id`);

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `apps_slug_unique` (`slug`);

--
-- Indexes for table `app_leadership_income_plan`
--
ALTER TABLE `app_leadership_income_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_leadership_packages`
--
ALTER TABLE `app_leadership_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_leadership_packages_app_id_index` (`app_id`),
  ADD KEY `app_leadership_packages_volume_index` (`volume`),
  ADD KEY `app_leadership_packages_points_index` (`points`);

--
-- Indexes for table `app_level_packages`
--
ALTER TABLE `app_level_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_level_packages_app_id_foreign` (`app_id`);

--
-- Indexes for table `app_packages`
--
ALTER TABLE `app_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_packages_app_id_index` (`app_id`),
  ADD KEY `app_packages_plan_code_index` (`plan_code`);

--
-- Indexes for table `app_promotion_packages`
--
ALTER TABLE `app_promotion_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_settings_app_id_foreign` (`app_id`);

--
-- Indexes for table `app_support_tickets`
--
ALTER TABLE `app_support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_support_tickets_app_id_index` (`app_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_app_id_foreign` (`app_id`);

--
-- Indexes for table `customer_deposits`
--
ALTER TABLE `customer_deposits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_deposits_transaction_id_unique` (`transaction_id`),
  ADD KEY `customer_deposits_app_id_index` (`app_id`),
  ADD KEY `customer_deposits_customer_id_index` (`customer_id`),
  ADD KEY `customer_deposits_package_id_index` (`package_id`);

--
-- Indexes for table `customer_earning_details`
--
ALTER TABLE `customer_earning_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_earning_details_app_id_foreign` (`app_id`);

--
-- Indexes for table `customer_financials`
--
ALTER TABLE `customer_financials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_financials_app_id_customer_id_unique` (`app_id`,`customer_id`),
  ADD KEY `customer_financials_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `customer_flush_details`
--
ALTER TABLE `customer_flush_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_app_id` (`app_id`),
  ADD KEY `idx_upline_id` (`upline_id`),
  ADD KEY `idx_reference_id` (`reference_id`),
  ADD KEY `idx_flush_level` (`flush_level`);

--
-- Indexes for table `customer_settings`
--
ALTER TABLE `customer_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_settings_app_id_customer_id_unique` (`app_id`,`customer_id`),
  ADD KEY `customer_settings_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `customer_withdraws`
--
ALTER TABLE `customer_withdraws`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_withdraws_app_id_foreign` (`app_id`),
  ADD KEY `customer_withdraws_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `forgot_password_requests`
--
ALTER TABLE `forgot_password_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `free_deposit_packages`
--
ALTER TABLE `free_deposit_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `free_deposit_packages_app_id_index` (`app_id`),
  ADD KEY `free_deposit_packages_package_id_index` (`package_id`),
  ADD KEY `free_deposit_packages_customer_id_index` (`customer_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landing_user`
--
ALTER TABLE `landing_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ninepay_transactions`
--
ALTER TABLE `ninepay_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_ninepay_payment` (`transaction_id`,`app_id`,`customer_id`,`transaction_hash`);

--
-- Indexes for table `nonces`
--
ALTER TABLE `nonces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nonces_user_id_foreign` (`user_id`),
  ADD KEY `nonces_wallet_address_index` (`wallet_address`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_vote` (`app_id`,`voter_id`,`sponsor_id`,`voted_for`) USING BTREE,
  ADD KEY `fk_votes_voter` (`voter_id`),
  ADD KEY `fk_votes_sponsor` (`sponsor_id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_transactions_app_id_foreign` (`app_id`),
  ADD KEY `wallet_transactions_payer_id_foreign` (`payer_id`),
  ADD KEY `wallet_transactions_receiver_id_foreign` (`receiver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tutorials`
--
ALTER TABLE `admin_tutorials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `app_leadership_income_plan`
--
ALTER TABLE `app_leadership_income_plan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `app_leadership_packages`
--
ALTER TABLE `app_leadership_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `app_level_packages`
--
ALTER TABLE `app_level_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `app_packages`
--
ALTER TABLE `app_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `app_promotion_packages`
--
ALTER TABLE `app_promotion_packages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_support_tickets`
--
ALTER TABLE `app_support_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customer_deposits`
--
ALTER TABLE `customer_deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `customer_earning_details`
--
ALTER TABLE `customer_earning_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_financials`
--
ALTER TABLE `customer_financials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customer_flush_details`
--
ALTER TABLE `customer_flush_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_settings`
--
ALTER TABLE `customer_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_withdraws`
--
ALTER TABLE `customer_withdraws`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forgot_password_requests`
--
ALTER TABLE `forgot_password_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `free_deposit_packages`
--
ALTER TABLE `free_deposit_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landing_user`
--
ALTER TABLE `landing_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ninepay_transactions`
--
ALTER TABLE `ninepay_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `nonces`
--
ALTER TABLE `nonces`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_leadership_packages`
--
ALTER TABLE `app_leadership_packages`
  ADD CONSTRAINT `app_leadership_packages_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_level_packages`
--
ALTER TABLE `app_level_packages`
  ADD CONSTRAINT `app_level_packages_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_packages`
--
ALTER TABLE `app_packages`
  ADD CONSTRAINT `app_packages_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD CONSTRAINT `app_settings_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_deposits`
--
ALTER TABLE `customer_deposits`
  ADD CONSTRAINT `customer_deposits_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_deposits_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_deposits_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `app_packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_earning_details`
--
ALTER TABLE `customer_earning_details`
  ADD CONSTRAINT `customer_earning_details_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_financials`
--
ALTER TABLE `customer_financials`
  ADD CONSTRAINT `customer_financials_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_financials_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_settings`
--
ALTER TABLE `customer_settings`
  ADD CONSTRAINT `customer_settings_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_settings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_withdraws`
--
ALTER TABLE `customer_withdraws`
  ADD CONSTRAINT `customer_withdraws_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_withdraws_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `free_deposit_packages`
--
ALTER TABLE `free_deposit_packages`
  ADD CONSTRAINT `free_deposit_packages_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `free_deposit_packages_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `free_deposit_packages_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `app_packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nonces`
--
ALTER TABLE `nonces`
  ADD CONSTRAINT `nonces_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `fk_votes_app` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_votes_sponsor` FOREIGN KEY (`sponsor_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_votes_voter` FOREIGN KEY (`voter_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD CONSTRAINT `wallet_transactions_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wallet_transactions_payer_id_foreign` FOREIGN KEY (`payer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wallet_transactions_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
