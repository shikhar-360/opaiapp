-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 03, 2026 at 04:48 AM
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
(1, 1, 1, 1, 35.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
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
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `app_id`, `name`, `email`, `phone`, `password`, `wallet_address`, `referral_code`, `telegram_username`, `sponsor_id`, `direct_ids`, `active_direct_ids`, `status`, `remember_token`, `role`, `level_id`, `leadership_rank`, `leadership_points`, `leadership_champions_rank`, `champions_point`, `isRankAssigned`, `promotion_status`, `nonce`, `iswallet_editable`, `isphone_editable`, `profile_image`, `isFreePackage`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'rahul@app.coms', '9000000001', '$2y$12$2F0J8ItT5kLyHWYcDPVtj.Lpaq9JCvU.usA/2q73HPpI4DYfjDMsW', NULL, '59A66F', 'TELUSER123', NULL, '9', NULL, 1, NULL, 'customer', 1, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 1, 'user_profiles/1767173660_user1.png', 0, '2025-12-01 06:27:18', '2026-01-02 19:09:04'),
(9, 1, 'Blackshark', 'user2@app.coms', NULL, '$2y$12$2F0J8ItT5kLyHWYcDPVtj.Lpaq9JCvU.usA/2q73HPpI4DYfjDMsW', NULL, '19F5CMJJ', NULL, 1, '10', NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, 0, '2026-01-02 19:09:04', '2026-01-02 19:12:36'),
(10, 1, 'Akmal', 'user3@app.coms', NULL, '$2y$12$2F0J8ItT5kLyHWYcDPVtj.Lpaq9JCvU.usA/2q73HPpI4DYfjDMsW', NULL, '110C2SOAC', NULL, 9, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, 0, '2026-01-02 19:12:36', '2026-01-02 21:25:18');

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
(27, 1, 10, 5, 100000.00, 0.00, 0.0000, 'FREEPACKAGE-qNQCAwSG', 'success', 0.0000, 1, '2026-01-02 21:25:18', '2026-01-02 21:25:18');

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
  `earning_type` enum('ROI','LEVEL-INCOME','BONUS','LEVEL-REWARD') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 1, 1, 0.000000, 0.000000, 0.000000, 0.000000, 0.0000, '2025-12-31 09:10:55', '2026-01-02 11:39:27'),
(8, 1, 9, 0.000000, 0.000000, 0.000000, 0.000000, 0.0000, '2026-01-02 19:09:09', '2026-01-02 19:09:09'),
(9, 1, 10, 0.000000, 0.000000, 0.000000, 0.000000, 0.0000, '2026-01-02 19:12:55', '2026-01-02 19:12:55');

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
(11, '2025_12_30_123116_create_admin_tutorials_table', 11);

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
(21, 'TXN1x5cf', '{\"address\":\"0xE758c82DC99A4aACCDB96A66Be8ea682aeae039f\",\"createdAt\":\"2026-01-02T13:03:23.217Z\",\"info\":{\"provider\":null,\"address\":\"0xE758c82DC99A4aACCDB96A66Be8ea682aeae039f\",\"publicKey\":\"0x026d908c9b16e742d4d45c335431997eac59ef3a3aed63a3f2166179dc2ee28446\",\"fingerprint\":\"0xa1597f5c\",\"parentFingerprint\":\"0x1500dcb5\",\"chainCode\":\"0x6eea48bb259a128493e47cac3a76c9ce23efc1007720e7ee085fbbf16ea5de23\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TJH5i5iw921SZPgdsTsNgjCxSXZ9zSktRn\",\"createdAt\":\"2026-01-02T13:03:23.718Z\",\"userId\":\"TXN1x5cf\"}', '0xE758c82DC99A4aACCDB96A66Be8ea682aeae039f', 1, 1, 10.000000, 1.000000, 0.000000, 11.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'pending', '2026-01-02 13:03:23', '2026-01-02 13:03:23'),
(22, 'TXN100inB', '{\"address\":\"0x55b4d521451a1FAE1db7a2e25f4e9f208826a324\",\"createdAt\":\"2026-01-02T19:17:44.273Z\",\"info\":{\"provider\":null,\"address\":\"0x55b4d521451a1FAE1db7a2e25f4e9f208826a324\",\"publicKey\":\"0x03c1e9d253b88b827234635abfcac0609e7306d2f3ca646896df9c6bbe6ad98358\",\"fingerprint\":\"0xa64aa435\",\"parentFingerprint\":\"0x10271d10\",\"chainCode\":\"0xcf6e97c5725cfdb78a5670c9ced5be3ceb78e7b459c7282bcf9a2032fece1861\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TCJJAPHJDo5HuXxZyfLdzdJLvF2n4PS268\",\"createdAt\":\"2026-01-02T19:17:44.524Z\",\"userId\":\"TXN100inB\"}', '0x55b4d521451a1FAE1db7a2e25f4e9f208826a324', 1, 10, 5.000000, 1.000000, 0.000000, 6.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-02 19:17:44', '2026-01-02 19:18:34'),
(23, 'TXN106hRs', '{\"address\":\"0x27958a621B0B474d659a0444b66A733F25490EEB\",\"createdAt\":\"2026-01-02T19:18:53.203Z\",\"info\":{\"provider\":null,\"address\":\"0x27958a621B0B474d659a0444b66A733F25490EEB\",\"publicKey\":\"0x03afaf664fb4e516422eabdbee72b47d9f2ee0129ec06b320490b81e81ab914cbd\",\"fingerprint\":\"0xbd063973\",\"parentFingerprint\":\"0x6a7f8bf0\",\"chainCode\":\"0x01bf582690f90d8179f948814fa023bbfa9750b3e649e9dcca981922dabf1747\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TV2kmJ8bdKhLsg3rARR4rNLjjuACwJES8i\",\"createdAt\":\"2026-01-02T19:18:53.405Z\",\"userId\":\"TXN106hRs\"}', '0x27958a621B0B474d659a0444b66A733F25490EEB', 1, 10, 5.000000, 0.500000, 0.000000, 5.5000, 'evm', 'evm', 'polygon', 'USDT', NULL, 'cancel', '2026-01-02 19:18:53', '2026-01-02 19:19:42'),
(24, 'TXN101Fqk', '{\"address\":\"0x1340F42DdAf75F60b30F102a44694b1854282bD0\",\"createdAt\":\"2026-01-02T19:19:51.585Z\",\"info\":{\"provider\":null,\"address\":\"0x1340F42DdAf75F60b30F102a44694b1854282bD0\",\"publicKey\":\"0x036fe477b2c959eaa770940960811731cc0ae0b94cc6b67c9c9a34b0487f326d80\",\"fingerprint\":\"0x71849e57\",\"parentFingerprint\":\"0xc8a6e0fd\",\"chainCode\":\"0xeda0316648fef807862ada7b018e5d2533a5d4dc42a9a57016dcd7747f3aac49\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TDuVth4Feu5DUDGCva6ejZ3zw59ba2fJEh\",\"createdAt\":\"2026-01-02T19:19:51.800Z\",\"userId\":\"TXN101Fqk\"}', '0x1340F42DdAf75F60b30F102a44694b1854282bD0', 1, 10, 5.000000, 1.000000, 0.000000, 6.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'cancel', '2026-01-02 19:19:51', '2026-01-02 19:20:47'),
(25, 'TXN10ukdc', '{\"address\":\"0x975040D3D05F5fD1e7b2418CeBa6c763a7d4b414\",\"createdAt\":\"2026-01-02T19:20:57.667Z\",\"info\":{\"provider\":null,\"address\":\"0x975040D3D05F5fD1e7b2418CeBa6c763a7d4b414\",\"publicKey\":\"0x02d65df45f43e4f31945d7c05ccc3f8a2dbca29e34858d7ec848aff2d269b0a77c\",\"fingerprint\":\"0x9586fb68\",\"parentFingerprint\":\"0x11b0db8a\",\"chainCode\":\"0x6dc2c97e7ec7e5356dca368a1db824494a67cf73551fba34592e31a3a5527a91\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TScgf2fFrkyKQLEjCXemgsQNzKeYiDEfxE\",\"createdAt\":\"2026-01-02T19:20:57.904Z\",\"userId\":\"TXN10ukdc\"}', '0x975040D3D05F5fD1e7b2418CeBa6c763a7d4b414', 1, 10, 10.000000, 1.000000, 0.000000, 11.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'pending', '2026-01-02 19:20:57', '2026-01-02 19:20:57'),
(26, 'TXN9B9O9', '{\"address\":\"0x589F6a2c92497fE4eE86C05c599479eC75f65A38\",\"createdAt\":\"2026-01-02T20:16:24.549Z\",\"info\":{\"provider\":null,\"address\":\"0x589F6a2c92497fE4eE86C05c599479eC75f65A38\",\"publicKey\":\"0x0245ccd7503aba155972bd86ec89dac918a2f61e3d9fbc884409309f725ecdeadf\",\"fingerprint\":\"0x0903e5e6\",\"parentFingerprint\":\"0x826082c0\",\"chainCode\":\"0xee4c55895452d0c347a9699848624264fed73f6cdfb9aad4d96218215b188046\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TGTxHWaA2t9vSVyQbnqdMeX89xehhCMLCW\",\"createdAt\":\"2026-01-02T20:16:24.781Z\",\"userId\":\"TXN9B9O9\"}', '0x589F6a2c92497fE4eE86C05c599479eC75f65A38', 1, 9, 25.000000, 0.500000, 0.000000, 25.5000, 'evm', 'evm', 'polygon', 'USDT', NULL, 'cancel', '2026-01-02 20:16:24', '2026-01-02 20:16:36'),
(27, 'TXN9rWGh', '{\"address\":\"0xA8036a2BECeeB079dE5C51436E6CCD9867817E28\",\"createdAt\":\"2026-01-02T20:16:45.274Z\",\"info\":{\"provider\":null,\"address\":\"0xA8036a2BECeeB079dE5C51436E6CCD9867817E28\",\"publicKey\":\"0x02b6c9d5eeb5ba10e5591e5950af06eff8f3b5d7c064ff803cdaa75299916aca82\",\"fingerprint\":\"0x266e88ad\",\"parentFingerprint\":\"0xd5d74dcc\",\"chainCode\":\"0x5f542e2c2fc2320403116587754736c03a62a9d356ca7cc672645b63b8453653\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TYXbQCRfzum17qXJ8yNAnbUfauGWFiV9mz\",\"createdAt\":\"2026-01-02T20:16:45.481Z\",\"userId\":\"TXN9rWGh\"}', '0xA8036a2BECeeB079dE5C51436E6CCD9867817E28', 1, 9, 25.000000, 1.000000, 0.000000, 26.0000, 'evm', 'evm', 'bsc', 'USDT', NULL, 'pending', '2026-01-02 20:16:45', '2026-01-02 20:16:45');

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
('24nPlGF7QFzLgbwybsi0udxwY42g1TzCq0RLA7Pf', NULL, '104.23.175.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicFMyTXp2WmtCZnVqNzdaMEVPdGY4bmVMdU83MlEzSUx0Rm94dDI3bCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3N0YXRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NToibG9naW5fY3VzdG9tZXJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMDt9', 1767393845),
('jsmLxU9JJP8tuRTC3bqFthxL1zgylEJZm7suusW2', NULL, '108.162.226.13', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGxhbDFiRDVJV2FScjY0NU9iRTBheFdzdW01RDQwYzRYQlVMSGV5SyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767401671),
('KwaSCT7ATS6P3OaGHevsmXwUYTFXiaOV6FcLqMm1', NULL, '35.203.210.77', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZFlhZGRmN2tPMW1yQlhHVlh4dG1Md3VKcWV0THNlY0c4eXFzbXlXSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly83Mi42MS4xNDguNTUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767397064),
('lZXzDWXgsQ1Nij11HgJjbdNrL9uvAxelVDrXAOFf', NULL, '172.70.93.62', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2pMMUpqSElvajRMb21CTk1jWEtlVEdiMExrT2N6VW4yNnI3R3hzVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767394945),
('sjM9C1bGUpaAhtLk0K93VDSpgWel3lpbt9p9gRrt', NULL, '172.70.108.219', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUUc5MGplODFtVEg2RHkzM2lTOUFFZFhxS2dKaWlIOUpMd2xTWjZrTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL292ZXJ2aWV3Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NToibG9naW5fY3VzdG9tZXJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1767414708),
('v3uczT46PEC2tocexzBYNZXp0zTc6PgnjCBa42z3', NULL, '205.210.31.226', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic0ZLT3A5NEh6MHlwQ0x3clpZd2tNRHpnWVJVS00yWWppWm5BZHhVTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly83Mi42MS4xNDguNTUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767415514),
('xUTGo7W7KWes7CJGorxypHozIPTR1w5oMUqS77xW', NULL, '104.23.229.135', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU1ltTU10MFpXZmNDTWo5R2I2U05sTHRKVUd2MUZFSFE0WlNaTFlnMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly91c2VyLm9yZGluYXJ5cGVvcGxlYWkuY29tL3RpY2tldHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU1OiJsb2dpbl9jdXN0b21lcl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwO30=', 1767401071),
('ZyCeHFGSQ3NJkye9Aj7GVGJH9WZFys44rcusbI9m', NULL, '43.130.78.203', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGh1SjRsRGlobkNzWkVPdE9NeWN0dkdLNkZvempvRG42ZzBETVV0WSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly83Mi42MS4xNDguNTUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767400312);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer_deposits`
--
ALTER TABLE `customer_deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customer_earning_details`
--
ALTER TABLE `customer_earning_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_financials`
--
ALTER TABLE `customer_financials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer_flush_details`
--
ALTER TABLE `customer_flush_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_withdraws`
--
ALTER TABLE `customer_withdraws`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ninepay_transactions`
--
ALTER TABLE `ninepay_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
