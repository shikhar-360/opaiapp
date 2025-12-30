-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2025 at 10:52 AM
-- Server version: 10.6.22-MariaDB-0ubuntu0.22.04.1-log
-- PHP Version: 8.1.2-1ubuntu2.22

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
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `primary_color` varchar(255) DEFAULT NULL,
  `accent_color` varchar(255) DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`settings`)),
  `currency` varchar(255) DEFAULT NULL,
  `coin_price` decimal(10,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`id`, `name`, `slug`, `primary_color`, `accent_color`, `logo_path`, `settings`, `currency`, `coin_price`, `created_at`, `updated_at`) VALUES
(1, 'App One', 'app-one', NULL, NULL, NULL, NULL, 'OP', '2.1000', '2025-12-01 01:46:50', '2025-12-01 01:46:50'),
(4, 'App Three', 'app-three', '#1d4ed8', '#ff0000', 'logo.png', NULL, 'OPP', '2.2000', '2025-12-01 01:58:32', '2025-12-01 01:58:32'),
(6, 'App Five', 'app-five', '#1d4ed8', '#ff0000', 'logo.png', '{\"padding\":\"1px\",\"margin\":\"2px\"}', 'OPPP', '2.3000', '2025-12-01 02:09:35', '2025-12-01 02:09:35'),
(7, 'new app12', 'new-app12', '#db0a0a', '#04762a', 'logos/571jXy96jzi3PyoO6CiU4aymYeK395pvedYnVO7E.png', '[]', 'OPPPP', '5.0000', '2025-12-04 05:24:54', '2025-12-12 01:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `app_champions_income_plan`
--

CREATE TABLE `app_champions_income_plan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `rank` varchar(50) NOT NULL,
  `directs` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `team_volume` decimal(18,6) NOT NULL DEFAULT 0.000000,
  `points` decimal(18,6) NOT NULL DEFAULT 0.000000,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_champions_income_plan`
--

INSERT INTO `app_champions_income_plan` (`id`, `app_id`, `rank`, `directs`, `team_volume`, `points`, `created_at`, `updated_at`) VALUES
(1, 1, 'VIP1', 10, '1000.000000', '100.000000', '2025-12-12 23:07:19', '2025-12-12 23:07:19'),
(2, 1, 'VIP2', 20, '2000.000000', '200.000000', '2025-12-12 23:07:19', '2025-12-12 23:07:19'),
(3, 1, 'VIP3', 30, '3000.000000', '300.000000', '2025-12-12 23:07:19', '2025-12-12 23:07:19'),
(4, 1, 'VIP4', 40, '4000.000000', '400.000000', '2025-12-12 23:07:19', '2025-12-12 23:07:19'),
(5, 1, 'VIP5', 50, '5000.000000', '500.000000', '2025-12-12 23:07:19', '2025-12-12 23:07:19');

-- --------------------------------------------------------

--
-- Table structure for table `app_leadership_income_plan`
--

CREATE TABLE `app_leadership_income_plan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `rank` varchar(50) NOT NULL,
  `team_volume` decimal(18,6) NOT NULL DEFAULT 0.000000,
  `points` decimal(18,6) NOT NULL DEFAULT 0.000000,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_leadership_income_plan`
--

INSERT INTO `app_leadership_income_plan` (`id`, `app_id`, `rank`, `team_volume`, `points`, `created_at`, `updated_at`) VALUES
(1, 1, 'gold', '1000.000000', '5.000000', '2025-12-12 23:07:02', '2025-12-12 23:07:02'),
(2, 1, 'sapphire', '2000.000000', '10.000000', '2025-12-12 23:07:02', '2025-12-12 23:07:02'),
(3, 1, 'emerald', '4000.000000', '20.000000', '2025-12-12 23:07:02', '2025-12-12 23:07:02'),
(4, 1, 'ruby', '8000.000000', '80.000000', '2025-12-12 23:07:02', '2025-12-12 23:07:02'),
(5, 1, 'diamond', '16000.000000', '160.000000', '2025-12-12 23:07:02', '2025-12-12 23:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `app_leadership_packages`
--

CREATE TABLE `app_leadership_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `rank` varchar(255) NOT NULL,
  `volume` bigint(20) UNSIGNED DEFAULT NULL,
  `points` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `level` int(10) UNSIGNED NOT NULL,
  `directs` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `reward` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_level_packages`
--

INSERT INTO `app_level_packages` (`id`, `app_id`, `level`, `directs`, `reward`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '35.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(2, 1, 2, 2, '10.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(3, 1, 3, 2, '5.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(4, 1, 4, 3, '4.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(5, 1, 5, 3, '3.00', '2025-12-02 23:23:04', '2025-12-12 04:34:29'),
(6, 1, 6, 4, '3.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(7, 1, 7, 4, '3.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(8, 1, 8, 5, '2.50', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(9, 1, 9, 5, '2.50', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(10, 1, 10, 6, '2.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(11, 1, 11, 6, '1.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(12, 1, 12, 7, '1.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(13, 1, 13, 7, '1.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(14, 1, 14, 8, '1.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(15, 1, 15, 8, '1.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(16, 1, 16, 9, '1.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(17, 1, 17, 9, '1.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(18, 1, 18, 10, '1.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(19, 1, 19, 10, '1.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(20, 1, 20, 11, '1.00', '2025-12-02 23:23:04', '2025-12-02 23:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `app_packages`
--

CREATE TABLE `app_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `plan_code` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `roi_percent` decimal(5,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_packages`
--

INSERT INTO `app_packages` (`id`, `app_id`, `plan_code`, `amount`, `roi_percent`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'P1', '5.00', '0.50', 1, '2025-12-02 01:17:05', '2025-12-09 07:27:30'),
(2, 1, 'P2', '10.00', '1.00', 1, '2025-12-02 01:17:05', '2025-12-02 01:17:05'),
(3, 1, 'P3', '25.00', '1.50', 1, '2025-12-02 01:17:05', '2025-12-12 04:34:43'),
(4, 1, 'P4', '50.00', '2.00', 1, '2025-12-02 01:17:05', '2025-12-02 01:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `app_promotion_packages`
--

CREATE TABLE `app_promotion_packages` (
  `id` bigint(20) NOT NULL,
  `app_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `total_beneficiaries` int(11) NOT NULL DEFAULT 0,
  `directs` int(11) DEFAULT NULL,
  `package` text DEFAULT NULL,
  `package_benefits` text DEFAULT NULL,
  `benefit_levels` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`value`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_support_tickets`
--

CREATE TABLE `app_support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = open, 1 = replied, 2 = closed',
  `reply` text DEFAULT NULL,
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_support_tickets`
--

INSERT INTO `app_support_tickets` (`id`, `app_id`, `customer_id`, `subject`, `message`, `file`, `status`, `reply`, `replied_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'test tickets', 'test message', NULL, 0, NULL, NULL, '2025-12-15 07:35:55', '2025-12-15 07:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `wallet_address` varchar(255) DEFAULT NULL,
  `referral_code` varchar(255) DEFAULT NULL,
  `telegram_username` varchar(255) DEFAULT NULL,
  `sponsor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `direct_ids` longtext DEFAULT NULL,
  `active_direct_ids` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `level_id` int(11) DEFAULT 1,
  `leadership_rank` int(11) DEFAULT 0,
  `leadership_points` int(11) DEFAULT 0,
  `leadership_champions_rank` int(11) DEFAULT 0,
  `champions_point` int(11) DEFAULT NULL,
  `isRankAssigned` int(11) NOT NULL DEFAULT 0,
  `promotion_status` text DEFAULT NULL,
  `nonce` varchar(255) DEFAULT NULL,
  `iswallet_editable` tinyint(1) DEFAULT 1,
  `isphone_editable` tinyint(1) DEFAULT 1,
  `profile_image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `app_id`, `name`, `email`, `phone`, `password`, `wallet_address`, `referral_code`, `telegram_username`, `sponsor_id`, `direct_ids`, `active_direct_ids`, `status`, `remember_token`, `role`, `level_id`, `leadership_rank`, `leadership_points`, `leadership_champions_rank`, `champions_point`, `isRankAssigned`, `promotion_status`, `nonce`, `iswallet_editable`, `isphone_editable`, `profile_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'User1', 'rahul@app.coms', '9000000001', '$2y$12$2F0J8ItT5kLyHWYcDPVtj.Lpaq9JCvU.usA/2q73HPpI4DYfjDMsW', '0x8a4b086f9c80648E88bB096627D1223BD759A66F', '59A66F', 'TELUSER123', NULL, '2/3/4/5/6/11/34/36/37/38', '11/7/6', 1, NULL, 'customer', 4, 1, 1085, 1, NULL, 0, '1', NULL, 1, 1, 'user_profiles/1765971962_Screenshot 2025-09-25 101004.png', '2025-12-01 06:27:18', '2025-12-30 10:52:01'),
(2, 1, 'Akmal', 'akmal.tirmizi@rediffmail.com', '9329408570', '$2y$12$r/ZooKbD4H7e1JAwIjTJOOHCZfBjc01xLvrn67SKzDKkj2ZtmL90u', NULL, '12MF4YHH', '@akmaltirmizi', 1, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-26 10:39:34', '2025-12-26 10:39:34'),
(3, 1, 'Soiam', 'saadimran88@gmail.com', NULL, '$2y$12$xAlZdzTjzSLgCv3/O6NSUuKKbjQz49vACByg1qc63nP/gDekR41de', NULL, '13KYRJ0S', NULL, 1, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-26 10:51:40', '2025-12-26 10:51:40'),
(4, 1, '123', 'saad@gmail.com', NULL, '$2y$12$TNVg7LI77cqjIgTE9VioPeq5GsX35eUBdGSx18gQEwGIP7J75ywG.', NULL, '14EPZK92', NULL, 1, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-26 10:53:43', '2025-12-26 10:53:43'),
(5, 1, 'A', 'a@a.com', NULL, '$2y$12$5GBbGw7Tid1icHUUA1YWduIU1IE6guSL7QS17wigzL.bLyFsQBb0a', NULL, '150TSRM0', NULL, 1, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-26 10:55:32', '2025-12-26 10:55:32'),
(6, 1, 'saad imran', 'saad.apoorti@gmail.com', NULL, '$2y$12$ptKZDqz6mUoQBgFHFJ0jBOg2lSdmx.WzSah5kuqEZpbZ7RJEn3WVW', NULL, '16XJ47CQ', NULL, 1, '7/8/9/39', '7/9', 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-26 11:08:12', '2025-12-30 10:25:30'),
(7, 1, 'Akmal', 'tirmizi.akmal@gmail.com', '971502258570', '$2y$12$GXpnzMv0ACdPffokSLyMaua9KcARIHnTGPHcaNPeJPmXyzQqxigvu', NULL, '17O6OP4F', '@akmal', 1, '10', '10', 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-26 11:28:27', '2025-12-26 12:57:37'),
(8, 1, 'xyz', 'oneragle1988@gmail.com', NULL, '$2y$12$MKCqiXYXRAnvUnPxA7J6QubcvPMmG6MR/Y8q2jY/vAZdtlvB3H16q', NULL, '1878PM6P', NULL, 6, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-26 12:31:08', '2025-12-26 12:31:08'),
(9, 1, 'Peter', 'r2fmindset@gmail.com', '2234567890', '$2y$12$mHMHScbnsyn1IjTQfInFpu6wFDDFe/Iu0M2k4bKK51AsRnfq2cVw6', NULL, '196U4J7M', 'xyz123', 6, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-26 12:35:17', '2025-12-26 12:35:17'),
(10, 1, 'saad', 'advancedtradingmart@gmail.com', NULL, '$2y$12$9h3dHItB/.swfvtInx5boueimgpwsOytE6zXRN5.QWwGa5iWHdFSO', NULL, '110XZVSEK', NULL, 7, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-26 12:56:53', '2025-12-26 12:56:53'),
(11, 1, 'UNKNOWN', 'unknown@gmail.com', '7777777777', '$2y$12$iP8m74inWEgWcX2BUv0kMe97GIdxOcVUE4.fLrADzwQk7bwqDPYj6', NULL, '111MJZT5B', 'unknown', 1, '12/15/16/17/18/19/20/21/22/23', '12/15/16/17/18/20/19/22/21/23', 1, NULL, 'customer', 19, 1, 1085, 1, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:20:26', '2025-12-30 10:52:01'),
(12, 1, 'Unknown1', 'unknown1@gmail.com', '7777777778', '$2y$12$mzwkCN0uq45mNzJKphYZkeNsCL1ccUPrk376M5itA8x23Xe1meu.C', NULL, '112FHEUR8', 'unknown1', 11, '13', '13', 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:22:55', '2025-12-27 07:25:10'),
(13, 1, 'unknown2', 'unknown2@gmail.com', '7777777788', '$2y$12$GhAnj6ZIuJKZ7sqKbXn7Q.7c0DFmBa/Ifh9sma7CCmeu4lx5xt0ei', NULL, '113CHA2DC', 'unknown2', 12, '14', '14', 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:24:17', '2025-12-27 07:26:13'),
(14, 1, 'unknown3', 'unknown3@gmail.com', '7777777888', '$2y$12$z5ATPCQc/CIyDKrgbN7K4OWyzwawQm2EFd7mYDPy2TZDFJfUjRFeS', NULL, '114KSKQU0', 'unknown3', 13, '25', '25', 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:25:50', '2025-12-27 07:49:32'),
(15, 1, 'unknown4', 'unknown4@gmail.com', '9999999999', '$2y$12$NjkywdFP/vcHQ5RbjyA2jOuku4oANNB49L55C7Dy9Hm6wDTAaweZW', NULL, '115IOH7SM', 'unknown4', 11, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:30:20', '2025-12-27 07:30:20'),
(16, 1, 'unknown15', 'unknown15@gmail.com', '1234567891', '$2y$12$.pO.PUFrHUYhpG/VV5BF9e9eU3/trP6USsc5/0hXQms4oVCb.14GG', NULL, '11636U86E', 'unknown15', 11, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:32:48', '2025-12-27 07:32:48'),
(17, 1, 'unknown5', 'unknown5@gmail.com', '5555555555', '$2y$12$8A.1DkId5Bxv2h9gD8kRUulHstqz2rKntfbdtQf5fGA1edUXvPdgy', NULL, '117TGF9YM', 'unknown5', 11, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:33:23', '2025-12-27 07:33:23'),
(18, 1, 'unknown14', 'unknown14@gmail.com', '1234567899', '$2y$12$pNkYmwe4Tj02h0clXLtEWurBI4Q.vQ5Ke4ZzENkDOccbU.eZIkqIa', NULL, '118H5FIR9', 'unknown14', 11, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:34:04', '2025-12-27 07:34:04'),
(19, 1, 'unknown6', 'unknown6@gmail.com', '9999999990', '$2y$12$K6kZSqBfJVTkwJ8EZCaBr.V/m/wTTszC4/Kgr0DKRIGarq5onsXXm', NULL, '1191ULL3H', 'unknown6', 11, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:34:41', '2025-12-27 07:34:41'),
(20, 1, 'unknown13', 'unknown13@gmail.com', '1234567898', '$2y$12$lABhbsczRL0BW5KlwCljp.BBUpagWsXjp/B6Do0LorJoe1x1kF7TO', NULL, '120VHYY68', 'unknown13', 11, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:34:58', '2025-12-27 07:34:58'),
(21, 1, 'unknown12', 'unknown12@gmail.com', '1234567896', '$2y$12$uIsIyEBalk9dl/qL1J67curbJHz.FWtWWIjykUhSd5px2sr0ZJU4m', NULL, '121CYC5UW', 'unknown12', 11, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:35:37', '2025-12-27 07:35:37'),
(22, 1, 'unknown7', 'unknown7@gmail.com', '7878787878', '$2y$12$cdBaf.bYD11c.lfj1sRuluPvKHvqY3BTEAW2BuMjZEv7LKnmjL7Lq', NULL, '1224G45R6', 'unknown7', 11, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:36:15', '2025-12-27 07:36:15'),
(23, 1, 'unknown11', 'unknown11@gmail.com', '1234567895', '$2y$12$O/GO3PGXYD1XZx5qN.bTgOLKWEKHv9cKEau4wqHqxqcZbINr9nA76', NULL, '123QH0HAV', 'unknown15@gmail.com', 11, '24', '24', 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:38:51', '2025-12-27 07:48:52'),
(24, 1, 'unknown25', 'unknown25@gmail.com', '131486451352', '$2y$12$cXhZv4SbIJfGgrqOGbIghOxVQUMYxrA1k.3Mp..lHt5iG2QPKLkIG', NULL, '1245HRD95', 'unknown25', 23, '26', '26', 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:48:42', '2025-12-27 07:49:58'),
(25, 1, 'UNKNOWN8', 'unknown8@gmail.com', '8888888884', '$2y$12$PWMSKadzbl4VEzCYVT2Pr.wdckLhSG/d47XNlC7nBxX6TY/J1UuPW', NULL, '1258KNJD8', 'unknown8', 14, '27', '27', 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:48:54', '2025-12-27 07:50:43'),
(26, 1, 'unknown24', 'unknown24@gmail.com', '231352456132', '$2y$12$eQ.Teryoai47VqPPb7B2eOSIGjPR8Ib0.zHynoyDahQbdNZwHLkS.', NULL, '1264OD64D', 'unknown24', 24, '28', '28', 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:49:38', '2025-12-27 07:50:41'),
(27, 1, 'unknown9', 'unknown9@gmail.com', '1234567890', '$2y$12$FgHqQJndpfqppiEe31QWQOaUIFEMoTh.zV.pl.7SXf.S4o3nRQInK', NULL, '127F2MRNS', 'unknown9', 25, '30', '30', 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:50:19', '2025-12-27 07:51:52'),
(28, 1, 'unknown23', 'unknown23@gmail.com', '1250456310531', '$2y$12$J8Rl2FQwN2zjTnXMUENDxOzo8Bw7Uo9AuUnGbOaCzhGbPDOpVoOri', NULL, '128APQOF9', 'unknown23', 26, '29', '29', 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:50:30', '2025-12-27 07:51:35'),
(29, 1, 'unknown22', 'unknown22@gmail.com', '52153454153', '$2y$12$0f099zEmLmKWVgoO12XeBughN1jvBcfSQlBKu9jqj6MLhRWDJ2Wxm', NULL, '129T3GYGK', 'unknown22', 28, '32', '32', 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:51:23', '2025-12-27 07:52:48'),
(30, 1, 'unknown10', 'unknown10@gmail.com', '7878789789', '$2y$12$NJf7Q8R1D97bQSSx/zaP6.pGQCoPPOEjRsta/v7TvdmHbFFm22Px6', NULL, '130BRITHA', 'unknown10', 27, '31', '31', 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:51:30', '2025-12-27 07:52:53'),
(31, 1, 'unknown16', 'unknown16@gmail.com', '78547854785', '$2y$12$/Hp2oWPWv0bfKcC.U1Pt6uOv7zLjAEFU5cxElNykHEZUYB/fAFHNy', NULL, '131JR5YTB', 'unknown16', 30, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:52:31', '2025-12-27 07:52:31'),
(32, 1, 'unknown21', 'unknown21@gmail.com', '5161505100230', '$2y$12$pFo5I/qCb2JkFQimOtbXC.GEOAsXOWQ1jpMpcnqklS.EQVOd5D3yW', NULL, '132XAHDAV', 'unknown21', 29, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 07:52:34', '2025-12-27 07:52:34'),
(36, 1, 'unknownu', 'unknownu@example.com', NULL, '$2y$12$2F0J8ItT5kLyHWYcDPVtj.Lpaq9JCvU.usA/2q73HPpI4DYfjDMsW', NULL, '136SSL4FG', NULL, 1, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-27 09:15:51', '2025-12-27 09:15:51'),
(37, 1, 'akmal', 'akmal.tirmizi@rediffmail.con', '0987654321', '$2y$12$uvFghUV3yoSIGMelXC9Yy.cDD3WJKPhxd5h47U70p2yuxdFTqGxrK', NULL, '137YMHLLF', '@abbadabba', 1, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-28 16:32:53', '2025-12-28 16:32:53'),
(38, 1, 'Akmal', 'admin@irondoge.io', '0987654322', '$2y$12$NnHHKEPgOw.X8TTrniDM3OWcwR/i0zbUVtzbkav6rHNRKxeOBZapK', NULL, '13883JEHF', '@abs', 1, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-28 22:41:15', '2025-12-28 22:41:15'),
(39, 1, 'A', 'gore.mohit1@gmail.com', '08109419091', '$2y$12$.RGm5g8w9WhjiLmarS8.NuXXmKkonO3Bg2wcrdvngh58FJRaIvsHy', NULL, '1395B8YPW', NULL, 6, NULL, NULL, 1, NULL, 'customer', 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, NULL, '2025-12-30 10:02:42', '2025-12-30 10:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `customer_deposits`
--

CREATE TABLE `customer_deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `roi_percent` decimal(5,2) NOT NULL,
  `roi_earned` decimal(12,4) DEFAULT 0.0000,
  `transaction_id` varchar(255) NOT NULL,
  `payment_status` enum('pending','success','failed') NOT NULL DEFAULT 'pending',
  `coin_price` decimal(10,4) NOT NULL,
  `is_free_deposit` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_deposits`
--

INSERT INTO `customer_deposits` (`id`, `app_id`, `customer_id`, `package_id`, `amount`, `roi_percent`, `roi_earned`, `transaction_id`, `payment_status`, `coin_price`, `is_free_deposit`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '5.00', '0.50', '0.0000', 'DEPOSIT-oaYocsxo', 'success', '2.0000', 0, '2025-12-13 14:49:40', '2025-12-13 14:49:40'),
(8, 1, 10, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-yeSVVZpZ', 'success', '2.0000', 0, '2025-12-26 12:57:37', '2025-12-26 12:57:37'),
(9, 1, 7, 2, '10.00', '1.00', '0.0000', 'DEPOSIT-HiQ1VV4s', 'success', '2.0000', 0, '2025-12-26 12:59:51', '2025-12-26 12:59:51'),
(10, 1, 7, 2, '10.00', '1.00', '0.0000', 'DEPOSIT-y7JgIVMy', 'success', '2.0000', 0, '2025-12-26 13:00:04', '2025-12-26 13:00:04'),
(11, 1, 9, 2, '10.00', '1.00', '0.0000', 'DEPOSIT-YURtfvtS', 'success', '2.0000', 0, '2025-12-26 15:27:08', '2025-12-26 15:27:08'),
(12, 1, 9, 2, '10.00', '1.00', '0.0000', 'DEPOSIT-cXTwuLHW', 'success', '2.0000', 0, '2025-12-26 15:27:54', '2025-12-26 15:27:54'),
(13, 1, 9, 3, '25.00', '1.50', '0.0000', 'DEPOSIT-hdxAnHqy', 'success', '2.0000', 0, '2025-12-26 15:28:04', '2025-12-26 15:28:04'),
(14, 1, 9, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-1TCCM9RK', 'success', '2.0000', 0, '2025-12-26 15:28:11', '2025-12-26 15:28:11'),
(15, 1, 11, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-rI3AjKqt', 'success', '2.0000', 0, '2025-12-27 07:21:54', '2025-12-27 07:21:54'),
(16, 1, 12, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-1SaGsyAA', 'success', '2.0000', 0, '2025-12-27 07:23:26', '2025-12-27 07:23:26'),
(17, 1, 13, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-Qgsnpe6X', 'success', '2.0000', 0, '2025-12-27 07:25:10', '2025-12-27 07:25:10'),
(18, 1, 14, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-rmGYUwih', 'success', '2.0000', 0, '2025-12-27 07:26:13', '2025-12-27 07:26:13'),
(19, 1, 15, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-K75JSSYI', 'success', '2.0000', 0, '2025-12-27 07:31:01', '2025-12-27 07:31:01'),
(20, 1, 16, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-Mkf90Y5a', 'success', '2.0000', 0, '2025-12-27 07:33:16', '2025-12-27 07:33:16'),
(21, 1, 17, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-t0yX7kWj', 'success', '2.0000', 0, '2025-12-27 07:33:47', '2025-12-27 07:33:47'),
(22, 1, 18, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-E3olpfja', 'success', '2.0000', 0, '2025-12-27 07:34:21', '2025-12-27 07:34:21'),
(23, 1, 20, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-MLYNqLFh', 'success', '2.0000', 0, '2025-12-27 07:35:09', '2025-12-27 07:35:09'),
(24, 1, 19, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-tSI16kWX', 'success', '2.0000', 0, '2025-12-27 07:35:27', '2025-12-27 07:35:27'),
(25, 1, 22, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-4LjlvWff', 'success', '2.0000', 0, '2025-12-27 07:37:34', '2025-12-27 07:37:34'),
(26, 1, 21, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-RuVRhzyz', 'success', '2.0000', 0, '2025-12-27 07:38:16', '2025-12-27 07:38:16'),
(27, 1, 23, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-Bw4pvFFb', 'success', '2.0000', 0, '2025-12-27 07:39:01', '2025-12-27 07:39:01'),
(28, 1, 24, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-xuqnyA0S', 'success', '2.0000', 0, '2025-12-27 07:48:52', '2025-12-27 07:48:52'),
(29, 1, 25, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-77DfD58N', 'success', '2.0000', 0, '2025-12-27 07:49:32', '2025-12-27 07:49:32'),
(30, 1, 26, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-YvImkqG4', 'success', '2.0000', 0, '2025-12-27 07:49:58', '2025-12-27 07:49:58'),
(31, 1, 28, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-drnAK48q', 'success', '2.0000', 0, '2025-12-27 07:50:41', '2025-12-27 07:50:41'),
(32, 1, 27, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-tdLy7Dpd', 'success', '2.0000', 0, '2025-12-27 07:50:43', '2025-12-27 07:50:43'),
(33, 1, 29, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-wj5L2EJS', 'success', '2.0000', 0, '2025-12-27 07:51:35', '2025-12-27 07:51:35'),
(34, 1, 30, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-uOU6maNj', 'success', '2.0000', 0, '2025-12-27 07:51:52', '2025-12-27 07:51:52'),
(35, 1, 32, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-RqBvnmj3', 'success', '2.0000', 0, '2025-12-27 07:52:48', '2025-12-27 07:52:48'),
(36, 1, 31, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-cBVemes8', 'success', '2.0000', 0, '2025-12-27 07:52:53', '2025-12-27 07:52:53'),
(37, 1, 1, 2, '10.00', '1.00', '0.0000', 'FREEPACKAGE-1-d3EZ0dhQ', 'success', '2.0000', 1, '2025-12-27 17:05:54', '2025-12-27 17:05:54'),
(38, 1, 1, 2, '10.00', '1.00', '0.0000', 'FREEPACKAGE-1-mbnZFux1', 'success', '2.0000', 1, '2025-12-27 17:07:03', '2025-12-27 17:07:03'),
(39, 1, 6, 4, '50.00', '2.00', '0.0000', 'DEPOSIT-OjZ71HZJ', 'success', '2.0000', 0, '2025-12-28 17:25:19', '2025-12-28 17:25:19'),
(40, 1, 1, 2, '10.00', '1.00', '0.0000', 'FREEPACKAGE-1-ZIxwPeBz', 'success', '2.0000', 1, '2025-12-29 06:34:31', '2025-12-29 06:34:31'),
(41, 1, 1, 2, '10.00', '1.00', '0.0000', 'FREEPACKAGE-1-HQ7xIcZE', 'success', '2.0000', 1, '2025-12-29 06:47:32', '2025-12-29 06:47:32'),
(42, 1, 1, 2, '10.00', '1.00', '0.0000', 'DEPOSIT-EzaepH1R', 'success', '2.0000', 1, '2025-12-29 06:47:41', '2025-12-29 06:47:41'),
(43, 1, 1, 2, '10.00', '1.00', '0.0000', 'DEPOSIT-l090aoNf', 'success', '2.0000', 1, '2025-12-29 06:50:19', '2025-12-29 06:50:19'),
(44, 1, 1, 2, '10.00', '1.00', '0.0000', 'DEPOSIT-YZzDipOr', 'success', '2.0000', 0, '2025-12-29 06:54:52', '2025-12-29 06:54:52'),
(45, 1, 1, 2, '10.00', '1.00', '0.0000', 'FREEPACKAGE-1-RVMNfWCD', 'success', '2.0000', 1, '2025-12-29 06:54:59', '2025-12-29 06:54:59'),
(46, 1, 1, 2, '10.00', '1.00', '0.0000', 'DEPOSIT-FAUzzsvV', 'success', '2.0000', 0, '2025-12-29 06:55:40', '2025-12-29 06:55:40'),
(47, 1, 1, 2, '10.00', '1.00', '0.0000', 'DEPOSIT-rv28QTFU', 'pending', '2.0000', 0, '2025-12-29 06:56:24', '2025-12-29 06:56:24'),
(48, 1, 1, 2, '10.00', '1.00', '0.0000', 'DEPOSIT-xxLzWOxM', 'pending', '2.0000', 0, '2025-12-29 06:57:13', '2025-12-29 06:57:13'),
(49, 1, 1, 2, '10.00', '1.00', '0.0000', 'DEPOSIT-KGNXB5Pp', 'success', '2.0000', 0, '2025-12-29 06:58:07', '2025-12-29 06:58:07'),
(50, 1, 1, 2, '10.00', '1.00', '0.0000', 'FREEPACKAGE-1-OoOlDhO3', 'success', '2.0000', 1, '2025-12-29 07:00:29', '2025-12-29 07:00:29'),
(51, 1, 1, 2, '10.00', '1.00', '0.0000', 'DEPOSIT-mEGOSMG3', 'success', '2.0000', 0, '2025-12-30 05:48:21', '2025-12-30 05:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `customer_earning_details`
--

CREATE TABLE `customer_earning_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL COMMENT 'referenced to id of apps table',
  `customer_id` bigint(20) UNSIGNED NOT NULL COMMENT 'referenced to the id of customer table',
  `reference_id` bigint(20) UNSIGNED NOT NULL COMMENT 'referenced to 1. id of customer_deposits table (ROI)\r\n2. id of app_level_package table (ROI-ON-ROI)',
  `reference_amount` decimal(12,4) NOT NULL COMMENT 'referenced the amount we are calculating the earning on \r\ne.g. amount+roi_amoun in customer_deposits table',
  `amount_earned` decimal(12,4) NOT NULL,
  `earning_type` enum('LEVEL-REWARD') NOT NULL,
  `reference_level` int(11) DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_earning_details`
--

INSERT INTO `customer_earning_details` (`id`, `app_id`, `customer_id`, `reference_id`, `reference_amount`, `amount_earned`, `earning_type`, `reference_level`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 10, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-26 12:57:37', '2025-12-26 12:57:37'),
(2, 1, 6, 10, '50.0000', '5.0000', 'LEVEL-REWARD', 2, 1, '2025-12-26 12:57:37', '2025-12-26 12:57:37'),
(3, 1, 1, 10, '50.0000', '2.5000', 'LEVEL-REWARD', 3, 1, '2025-12-26 12:57:37', '2025-12-26 12:57:37'),
(4, 1, 6, 7, '10.0000', '3.5000', 'LEVEL-REWARD', 1, 1, '2025-12-26 12:59:51', '2025-12-26 12:59:51'),
(5, 1, 1, 7, '10.0000', '1.0000', 'LEVEL-REWARD', 2, 1, '2025-12-26 12:59:51', '2025-12-26 12:59:51'),
(6, 1, 6, 7, '10.0000', '3.5000', 'LEVEL-REWARD', 1, 1, '2025-12-26 13:00:04', '2025-12-26 13:00:04'),
(7, 1, 1, 7, '10.0000', '1.0000', 'LEVEL-REWARD', 2, 1, '2025-12-26 13:00:04', '2025-12-26 13:00:04'),
(8, 1, 6, 9, '10.0000', '3.5000', 'LEVEL-REWARD', 1, 1, '2025-12-26 15:27:08', '2025-12-26 15:27:08'),
(9, 1, 1, 9, '10.0000', '1.0000', 'LEVEL-REWARD', 2, 1, '2025-12-26 15:27:08', '2025-12-26 15:27:08'),
(10, 1, 6, 9, '10.0000', '3.5000', 'LEVEL-REWARD', 1, 1, '2025-12-26 15:27:54', '2025-12-26 15:27:54'),
(11, 1, 1, 9, '10.0000', '1.0000', 'LEVEL-REWARD', 2, 1, '2025-12-26 15:27:54', '2025-12-26 15:27:54'),
(12, 1, 6, 9, '25.0000', '8.7500', 'LEVEL-REWARD', 1, 1, '2025-12-26 15:28:04', '2025-12-26 15:28:04'),
(13, 1, 1, 9, '25.0000', '2.5000', 'LEVEL-REWARD', 2, 1, '2025-12-26 15:28:04', '2025-12-26 15:28:04'),
(14, 1, 6, 9, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-26 15:28:11', '2025-12-26 15:28:11'),
(15, 1, 1, 9, '50.0000', '5.0000', 'LEVEL-REWARD', 2, 1, '2025-12-26 15:28:11', '2025-12-26 15:28:11'),
(16, 1, 1, 11, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:21:54', '2025-12-27 07:21:54'),
(17, 1, 11, 12, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:23:26', '2025-12-27 07:23:26'),
(18, 1, 1, 12, '50.0000', '5.0000', 'LEVEL-REWARD', 2, 1, '2025-12-27 07:23:26', '2025-12-27 07:23:26'),
(19, 1, 12, 13, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:25:10', '2025-12-27 07:25:10'),
(20, 1, 1, 13, '50.0000', '2.5000', 'LEVEL-REWARD', 3, 1, '2025-12-27 07:25:10', '2025-12-27 07:25:10'),
(21, 1, 13, 14, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:26:13', '2025-12-27 07:26:13'),
(22, 1, 1, 14, '50.0000', '2.0000', 'LEVEL-REWARD', 4, 1, '2025-12-27 07:26:13', '2025-12-27 07:26:13'),
(23, 1, 11, 15, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:31:01', '2025-12-27 07:31:01'),
(24, 1, 1, 15, '50.0000', '5.0000', 'LEVEL-REWARD', 2, 1, '2025-12-27 07:31:01', '2025-12-27 07:31:01'),
(25, 1, 11, 16, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:33:16', '2025-12-27 07:33:16'),
(26, 1, 1, 16, '50.0000', '5.0000', 'LEVEL-REWARD', 2, 1, '2025-12-27 07:33:16', '2025-12-27 07:33:16'),
(27, 1, 11, 17, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:33:47', '2025-12-27 07:33:47'),
(28, 1, 1, 17, '50.0000', '5.0000', 'LEVEL-REWARD', 2, 1, '2025-12-27 07:33:47', '2025-12-27 07:33:47'),
(29, 1, 11, 18, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:34:21', '2025-12-27 07:34:21'),
(30, 1, 1, 18, '50.0000', '5.0000', 'LEVEL-REWARD', 2, 1, '2025-12-27 07:34:21', '2025-12-27 07:34:21'),
(31, 1, 11, 20, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:35:09', '2025-12-27 07:35:09'),
(32, 1, 1, 20, '50.0000', '5.0000', 'LEVEL-REWARD', 2, 1, '2025-12-27 07:35:09', '2025-12-27 07:35:09'),
(33, 1, 11, 19, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:35:27', '2025-12-27 07:35:27'),
(34, 1, 1, 19, '50.0000', '5.0000', 'LEVEL-REWARD', 2, 1, '2025-12-27 07:35:27', '2025-12-27 07:35:27'),
(35, 1, 11, 22, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:37:34', '2025-12-27 07:37:34'),
(36, 1, 1, 22, '50.0000', '5.0000', 'LEVEL-REWARD', 2, 1, '2025-12-27 07:37:34', '2025-12-27 07:37:34'),
(37, 1, 11, 21, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:38:16', '2025-12-27 07:38:16'),
(38, 1, 1, 21, '50.0000', '5.0000', 'LEVEL-REWARD', 2, 1, '2025-12-27 07:38:16', '2025-12-27 07:38:16'),
(39, 1, 11, 23, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:39:01', '2025-12-27 07:39:01'),
(40, 1, 1, 23, '50.0000', '5.0000', 'LEVEL-REWARD', 2, 1, '2025-12-27 07:39:01', '2025-12-27 07:39:01'),
(41, 1, 23, 24, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:48:52', '2025-12-27 07:48:52'),
(42, 1, 11, 24, '50.0000', '5.0000', 'LEVEL-REWARD', 2, 1, '2025-12-27 07:48:52', '2025-12-27 07:48:52'),
(43, 1, 1, 24, '50.0000', '2.5000', 'LEVEL-REWARD', 3, 1, '2025-12-27 07:48:52', '2025-12-27 07:48:52'),
(44, 1, 14, 25, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:49:33', '2025-12-27 07:49:33'),
(45, 1, 11, 25, '50.0000', '2.0000', 'LEVEL-REWARD', 4, 1, '2025-12-27 07:49:33', '2025-12-27 07:49:33'),
(46, 1, 1, 25, '50.0000', '1.5000', 'LEVEL-REWARD', 5, 1, '2025-12-27 07:49:33', '2025-12-27 07:49:33'),
(47, 1, 24, 26, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:49:58', '2025-12-27 07:49:58'),
(48, 1, 11, 26, '50.0000', '2.5000', 'LEVEL-REWARD', 3, 1, '2025-12-27 07:49:58', '2025-12-27 07:49:58'),
(49, 1, 1, 26, '50.0000', '2.0000', 'LEVEL-REWARD', 4, 1, '2025-12-27 07:49:58', '2025-12-27 07:49:58'),
(50, 1, 26, 28, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:50:41', '2025-12-27 07:50:41'),
(51, 1, 11, 28, '50.0000', '2.0000', 'LEVEL-REWARD', 4, 1, '2025-12-27 07:50:41', '2025-12-27 07:50:41'),
(52, 1, 1, 28, '50.0000', '1.5000', 'LEVEL-REWARD', 5, 1, '2025-12-27 07:50:41', '2025-12-27 07:50:41'),
(53, 1, 25, 27, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:50:43', '2025-12-27 07:50:43'),
(54, 1, 11, 27, '50.0000', '1.5000', 'LEVEL-REWARD', 5, 1, '2025-12-27 07:50:43', '2025-12-27 07:50:43'),
(55, 1, 1, 27, '50.0000', '1.5000', 'LEVEL-REWARD', 6, 1, '2025-12-27 07:50:43', '2025-12-27 07:50:43'),
(56, 1, 28, 29, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:51:35', '2025-12-27 07:51:35'),
(57, 1, 11, 29, '50.0000', '1.5000', 'LEVEL-REWARD', 5, 1, '2025-12-27 07:51:35', '2025-12-27 07:51:35'),
(58, 1, 1, 29, '50.0000', '1.5000', 'LEVEL-REWARD', 6, 1, '2025-12-27 07:51:35', '2025-12-27 07:51:35'),
(59, 1, 27, 30, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:51:52', '2025-12-27 07:51:52'),
(60, 1, 11, 30, '50.0000', '1.5000', 'LEVEL-REWARD', 6, 1, '2025-12-27 07:51:52', '2025-12-27 07:51:52'),
(61, 1, 1, 30, '50.0000', '1.5000', 'LEVEL-REWARD', 7, 1, '2025-12-27 07:51:52', '2025-12-27 07:51:52'),
(62, 1, 29, 32, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:52:48', '2025-12-27 07:52:48'),
(63, 1, 11, 32, '50.0000', '1.5000', 'LEVEL-REWARD', 6, 1, '2025-12-27 07:52:48', '2025-12-27 07:52:48'),
(64, 1, 1, 32, '50.0000', '1.5000', 'LEVEL-REWARD', 7, 1, '2025-12-27 07:52:48', '2025-12-27 07:52:48'),
(65, 1, 30, 31, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-27 07:52:53', '2025-12-27 07:52:53'),
(66, 1, 11, 31, '50.0000', '1.5000', 'LEVEL-REWARD', 7, 1, '2025-12-27 07:52:53', '2025-12-27 07:52:53'),
(67, 1, 1, 31, '50.0000', '1.2500', 'LEVEL-REWARD', 8, 1, '2025-12-27 07:52:53', '2025-12-27 07:52:53'),
(68, 1, 1, 6, '50.0000', '17.5000', 'LEVEL-REWARD', 1, 1, '2025-12-28 17:25:19', '2025-12-28 17:25:19');

-- --------------------------------------------------------

--
-- Table structure for table `customer_financials`
--

CREATE TABLE `customer_financials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `total_deposit` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `total_income` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `total_withdraws` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `capping_limit` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `total_topup` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_financials`
--

INSERT INTO `customer_financials` (`id`, `app_id`, `customer_id`, `total_deposit`, `total_income`, `total_withdraws`, `capping_limit`, `total_topup`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '45.000000', '118.250000', '0.000000', '2775.000000', '255.0000', '2025-12-13 17:56:05', '2025-12-30 05:48:21'),
(23, 1, 2, '0.000000', '0.000000', '0.000000', '2500.000000', '500.0000', '2025-12-26 10:39:34', '2025-12-26 10:39:34'),
(24, 1, 3, '0.000000', '0.000000', '0.000000', '2500.000000', '500.0000', '2025-12-26 10:51:40', '2025-12-26 10:51:40'),
(25, 1, 4, '0.000000', '0.000000', '0.000000', '2500.000000', '500.0000', '2025-12-26 10:53:43', '2025-12-26 10:53:43'),
(26, 1, 5, '0.000000', '0.000000', '0.000000', '2500.000000', '500.0000', '2025-12-26 10:55:32', '2025-12-26 10:55:32'),
(27, 1, 6, '50.000000', '45.250000', '0.000000', '2750.000000', '450.0000', '2025-12-26 11:08:12', '2025-12-28 17:25:19'),
(28, 1, 7, '20.000000', '17.500000', '0.000000', '2600.000000', '480.0000', '2025-12-26 11:28:27', '2025-12-26 13:00:04'),
(29, 1, 8, '0.000000', '0.000000', '0.000000', '2500.000000', '500.0000', '2025-12-26 12:31:08', '2025-12-26 12:31:08'),
(30, 1, 9, '95.000000', '0.000000', '0.000000', '2975.000000', '405.0000', '2025-12-26 12:35:17', '2025-12-26 15:28:11'),
(31, 1, 10, '50.000000', '0.000000', '0.000000', '2750.000000', '450.0000', '2025-12-26 12:56:53', '2025-12-26 12:57:37'),
(32, 1, 11, '50.000000', '194.000000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:20:26', '2025-12-27 07:52:53'),
(33, 1, 12, '50.000000', '17.500000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:22:55', '2025-12-27 07:25:10'),
(34, 1, 13, '50.000000', '17.500000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:24:17', '2025-12-27 07:26:13'),
(35, 1, 14, '50.000000', '17.500000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:25:50', '2025-12-27 07:49:32'),
(36, 1, 15, '50.000000', '0.000000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:30:20', '2025-12-27 07:31:01'),
(37, 1, 16, '50.000000', '0.000000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:32:48', '2025-12-27 07:33:16'),
(38, 1, 17, '50.000000', '0.000000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:33:23', '2025-12-27 07:33:47'),
(39, 1, 18, '50.000000', '0.000000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:34:04', '2025-12-27 07:34:21'),
(40, 1, 19, '50.000000', '0.000000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:34:41', '2025-12-27 07:35:27'),
(41, 1, 20, '50.000000', '0.000000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:34:58', '2025-12-27 07:35:09'),
(42, 1, 21, '50.000000', '0.000000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:35:37', '2025-12-27 07:38:16'),
(43, 1, 22, '50.000000', '0.000000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:36:15', '2025-12-27 07:37:34'),
(44, 1, 23, '50.000000', '17.500000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:38:51', '2025-12-27 07:48:52'),
(45, 1, 24, '50.000000', '17.500000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:48:42', '2025-12-27 07:49:58'),
(46, 1, 25, '50.000000', '17.500000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:48:54', '2025-12-27 07:50:43'),
(47, 1, 26, '50.000000', '17.500000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:49:38', '2025-12-27 07:50:41'),
(48, 1, 27, '50.000000', '17.500000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:50:19', '2025-12-27 07:51:52'),
(49, 1, 28, '50.000000', '17.500000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:50:30', '2025-12-27 07:51:35'),
(50, 1, 29, '50.000000', '17.500000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:51:23', '2025-12-27 07:52:48'),
(51, 1, 30, '50.000000', '17.500000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:51:30', '2025-12-27 07:52:53'),
(52, 1, 31, '50.000000', '0.000000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:52:31', '2025-12-27 07:52:53'),
(53, 1, 32, '50.000000', '0.000000', '0.000000', '2750.000000', '450.0000', '2025-12-27 07:52:34', '2025-12-27 07:52:48'),
(57, 1, 36, '0.000000', '0.000000', '0.000000', '2500.000000', '500.0000', '2025-12-27 09:15:51', '2025-12-27 09:15:51'),
(58, 1, 37, '0.000000', '0.000000', '0.000000', '2500.000000', '500.0000', '2025-12-28 16:32:53', '2025-12-28 16:32:53'),
(59, 1, 38, '0.000000', '0.000000', '0.000000', '2500.000000', '500.0000', '2025-12-28 22:41:15', '2025-12-28 22:41:15'),
(60, 1, 39, '0.000000', '0.000000', '0.000000', '2500.000000', '500.0000', '2025-12-30 10:02:42', '2025-12-30 10:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `customer_flush_details`
--

CREATE TABLE `customer_flush_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `upline_id` bigint(20) UNSIGNED NOT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `reference_amount` decimal(15,2) NOT NULL,
  `flush_amount` decimal(15,2) NOT NULL,
  `flush_level` int(10) UNSIGNED NOT NULL,
  `reason` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_flush_details`
--

INSERT INTO `customer_flush_details` (`id`, `app_id`, `upline_id`, `reference_id`, `reference_amount`, `flush_amount`, `flush_level`, `reason`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 13, '50.00', '5.00', 2, 'NOT-ELIGIBLE', '2025-12-27 07:25:10', '2025-12-27 07:25:10'),
(2, 1, 12, 14, '50.00', '5.00', 2, 'NOT-ELIGIBLE', '2025-12-27 07:26:13', '2025-12-27 07:26:13'),
(3, 1, 11, 14, '50.00', '2.50', 3, 'NOT-ELIGIBLE', '2025-12-27 07:26:13', '2025-12-27 07:26:13'),
(4, 1, 13, 25, '50.00', '5.00', 2, 'NOT-ELIGIBLE', '2025-12-27 07:49:33', '2025-12-27 07:49:33'),
(5, 1, 12, 25, '50.00', '2.50', 3, 'NOT-ELIGIBLE', '2025-12-27 07:49:33', '2025-12-27 07:49:33'),
(6, 1, 23, 26, '50.00', '5.00', 2, 'NOT-ELIGIBLE', '2025-12-27 07:49:58', '2025-12-27 07:49:58'),
(7, 1, 24, 28, '50.00', '5.00', 2, 'NOT-ELIGIBLE', '2025-12-27 07:50:41', '2025-12-27 07:50:41'),
(8, 1, 23, 28, '50.00', '2.50', 3, 'NOT-ELIGIBLE', '2025-12-27 07:50:41', '2025-12-27 07:50:41'),
(9, 1, 14, 27, '50.00', '5.00', 2, 'NOT-ELIGIBLE', '2025-12-27 07:50:43', '2025-12-27 07:50:43'),
(10, 1, 13, 27, '50.00', '2.50', 3, 'NOT-ELIGIBLE', '2025-12-27 07:50:43', '2025-12-27 07:50:43'),
(11, 1, 12, 27, '50.00', '2.00', 4, 'NOT-ELIGIBLE', '2025-12-27 07:50:43', '2025-12-27 07:50:43'),
(12, 1, 26, 29, '50.00', '5.00', 2, 'NOT-ELIGIBLE', '2025-12-27 07:51:35', '2025-12-27 07:51:35'),
(13, 1, 24, 29, '50.00', '2.50', 3, 'NOT-ELIGIBLE', '2025-12-27 07:51:35', '2025-12-27 07:51:35'),
(14, 1, 23, 29, '50.00', '2.00', 4, 'NOT-ELIGIBLE', '2025-12-27 07:51:35', '2025-12-27 07:51:35'),
(15, 1, 25, 30, '50.00', '5.00', 2, 'NOT-ELIGIBLE', '2025-12-27 07:51:52', '2025-12-27 07:51:52'),
(16, 1, 14, 30, '50.00', '2.50', 3, 'NOT-ELIGIBLE', '2025-12-27 07:51:52', '2025-12-27 07:51:52'),
(17, 1, 13, 30, '50.00', '2.00', 4, 'NOT-ELIGIBLE', '2025-12-27 07:51:52', '2025-12-27 07:51:52'),
(18, 1, 12, 30, '50.00', '1.50', 5, 'NOT-ELIGIBLE', '2025-12-27 07:51:52', '2025-12-27 07:51:52'),
(19, 1, 28, 32, '50.00', '5.00', 2, 'NOT-ELIGIBLE', '2025-12-27 07:52:48', '2025-12-27 07:52:48'),
(20, 1, 26, 32, '50.00', '2.50', 3, 'NOT-ELIGIBLE', '2025-12-27 07:52:48', '2025-12-27 07:52:48'),
(21, 1, 24, 32, '50.00', '2.00', 4, 'NOT-ELIGIBLE', '2025-12-27 07:52:48', '2025-12-27 07:52:48'),
(22, 1, 23, 32, '50.00', '1.50', 5, 'NOT-ELIGIBLE', '2025-12-27 07:52:48', '2025-12-27 07:52:48'),
(23, 1, 27, 31, '50.00', '5.00', 2, 'NOT-ELIGIBLE', '2025-12-27 07:52:53', '2025-12-27 07:52:53'),
(24, 1, 25, 31, '50.00', '2.50', 3, 'NOT-ELIGIBLE', '2025-12-27 07:52:53', '2025-12-27 07:52:53'),
(25, 1, 14, 31, '50.00', '2.00', 4, 'NOT-ELIGIBLE', '2025-12-27 07:52:53', '2025-12-27 07:52:53'),
(26, 1, 13, 31, '50.00', '1.50', 5, 'NOT-ELIGIBLE', '2025-12-27 07:52:53', '2025-12-27 07:52:53'),
(27, 1, 12, 31, '50.00', '1.50', 6, 'NOT-ELIGIBLE', '2025-12-27 07:52:53', '2025-12-27 07:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `customer_withdraws`
--

CREATE TABLE `customer_withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `admin_charge` decimal(10,4) NOT NULL,
  `amount` decimal(10,4) NOT NULL,
  `net_amount` decimal(10,4) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password_requests`
--

CREATE TABLE `forgot_password_requests` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `code` varchar(25) NOT NULL,
  `expires_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forgot_password_requests`
--

INSERT INTO `forgot_password_requests` (`id`, `customer_id`, `code`, `expires_at`, `created_at`, `updated_at`) VALUES
(5, 2, 'MCXGAW', '2025-12-26 10:56:29', '2025-12-26 10:41:29', '2025-12-26 10:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `free_deposit_packages`
--

CREATE TABLE `free_deposit_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `free_deposit_packages`
--

INSERT INTO `free_deposit_packages` (`id`, `app_id`, `package_id`, `customer_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
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
(12, '2025_12_01_111219_create_customers_table', 8),
(13, '2025_12_02_061151_create_app_packages_table', 9),
(14, '2025_12_02_061821_create_customer_deposits_table', 10),
(16, '2025_12_02_094431_create_customer_earning_details_table', 11),
(17, '2025_12_03_044502_create_app_level_packages_table', 12),
(18, '2025_12_03_093456_create_free_deposit_packages_table', 13),
(20, '2025_12_03_103914_create_wallet_transactions_table', 14),
(21, '2025_12_04_050908_create_customer_withdraws_table', 15),
(22, '2025_12_04_054615_create_customer_financials_table', 16),
(23, '2025_12_06_072117_create_ninepay_transactions_table', 17),
(24, '2025_12_10_072313_create_app_leadership_packages_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `ninepay_transactions`
--

CREATE TABLE `ninepay_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `eth_9pay_json` text NOT NULL,
  `tron_9pay_json` text NOT NULL,
  `payment_address` varchar(255) NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `fees_amount` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `received_amount` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `chain` varchar(255) DEFAULT NULL,
  `network_type` varchar(255) DEFAULT NULL,
  `network_name` varchar(255) DEFAULT NULL,
  `currency` varchar(225) DEFAULT NULL,
  `transaction_hash` text DEFAULT NULL,
  `payment_status` enum('pending','success','failed','underpaid','cancel') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonces`
--

CREATE TABLE `nonces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `wallet_address` varchar(255) NOT NULL,
  `nonce` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\UsersModel', 2, 'api-token', 'acbcfa09efbf3b206817b787deb8444c9766725952774ad3b4913b9742c2d684', '[\"*\"]', '2025-12-01 00:37:39', NULL, '2025-12-01 00:29:15', '2025-12-01 00:37:39'),
(3, 'App\\Models\\UsersModel', 2, 'api-token', '580a3dcda3492dc22aece7dc55ad81d3a91beb9636907ec751910292e6659cde', '[\"*\"]', '2025-12-01 04:59:30', NULL, '2025-12-01 00:47:15', '2025-12-01 04:59:30'),
(6, 'App\\Models\\UsersModel', 2, 'api-token', '9abd1f09e16b044dabaa4874642213fc36ba163464df7e285f055e6527ffd6c1', '[\"*\"]', '2025-12-01 05:20:44', '2025-12-01 05:25:44', '2025-12-01 04:43:51', '2025-12-01 05:20:44'),
(9, 'App\\Models\\UsersModel', 2, 'api-token', 'bdc48e3264cee8deea7345cb01a1914b73be41c61f9571dc901385c85e3afb1b', '[\"*\"]', '2025-12-01 05:22:20', '2025-12-01 05:24:21', '2025-12-01 05:20:18', '2025-12-01 05:22:21'),
(10, 'App\\Models\\CustomersModel', 4, 'customer-login', 'b2cafd92513837b1692b03ff034a0c7fffec2e1c21d12753b5d2a4e2f5e36c69', '[\"*\"]', NULL, NULL, '2025-12-01 07:19:02', '2025-12-01 07:19:02'),
(11, 'App\\Models\\CustomersModel', 4, 'customer-login', '8692efc728668993e7946053b31bb741a700450cd6f92a729d84113b68505453', '[\"*\"]', '2025-12-02 04:11:01', NULL, '2025-12-01 07:19:26', '2025-12-02 04:11:01'),
(12, 'App\\Models\\CustomersModel', 2, 'web3-login', '11e3abbda5fca13dbc8f1d8ad14a902ddf309f2ffc5165a39bb2746f9954b0ae', '[\"*\"]', NULL, NULL, '2025-12-02 00:35:13', '2025-12-02 00:35:13'),
(13, 'App\\Models\\CustomersModel', 4, 'customer-login', '5ba98648941f0d3317fc75506bc862e34d0b222988ad3e247a6f7a6260e6fba5', '[\"*\"]', NULL, NULL, '2025-12-03 04:39:03', '2025-12-03 04:39:03'),
(14, 'App\\Models\\CustomersModel', 5, 'customer-login', '82bd8a4daffdc6947526d25bd49746c7fff58cd25b7de089ddba55fece3eb0e1', '[\"*\"]', '2025-12-03 06:02:40', NULL, '2025-12-03 04:40:22', '2025-12-03 06:02:40'),
(15, 'App\\Models\\CustomersModel', 4, 'customer-login', 'c831b19000134fe2d0adb96d30d02f0cd431eb1f40699e5503b308bdb70ca28e', '[\"*\"]', NULL, NULL, '2025-12-03 06:04:47', '2025-12-03 06:04:47'),
(16, 'App\\Models\\CustomersModel', 2, 'customer-login', 'f4f81b2c0c53ebb4104404af9fd80654acde84a3f0d4747b55c06dedc79a226e', '[\"*\"]', '2025-12-03 06:18:40', NULL, '2025-12-03 06:05:16', '2025-12-03 06:18:40'),
(17, 'App\\Models\\CustomersModel', 2, 'customer-login', 'a0410fd065a477a1376457b7be4a63e22d8acc0bb31678e43639c590237ae38c', '[\"*\"]', '2025-12-04 01:45:26', NULL, '2025-12-04 01:07:50', '2025-12-04 01:45:26'),
(18, 'App\\Models\\CustomersModel', 2, 'web3-login', '6290caaff9584b532041f5acbb9ada42bbac3a2242abe0cb3ea021fa02e88f69', '[\"*\"]', NULL, NULL, '2025-12-04 04:01:05', '2025-12-04 04:01:05'),
(19, 'App\\Models\\CustomersModel', 2, 'web3-login', 'fa71960da7f3e40a2058cab7771915b7e12f896df5661988bb4a66d0770f8370', '[\"*\"]', NULL, NULL, '2025-12-04 04:01:25', '2025-12-04 04:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  `app_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`, `app_id`) VALUES
('DKpLKAWrwin799wNU0ayCA1gT8UhK08eA30rUVNT', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMGZEenZyWXJzRnByQUhUVmh3c051Wjl5dVpPeDFXeDY0dEczbFlBUSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2xldmVscGFja2FnZXMiO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3BhY2thZ2VzIjtzOjU6InJvdXRlIjtzOjIwOiJhZG1pbi5wYWNrYWdlcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1765363065, NULL),
('lb0tSx9an1PSDmm2mRE7iChSWMpkEbZbp5FCseoG', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZzlUaUdNemlQNmpsaDF5WHpnNTVaUldFdWs4dXFaWlBxeVFiRjgwZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sZWFkZXJzaGlwcGFja2FnZXMiO3M6NToicm91dGUiO3M6MzA6ImFkbWluLmxlYWRlcnNoaXBwYWNrYWdlcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYWNrYWdlcyI7fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1765353371, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `app_id` bigint(20) UNSIGNED DEFAULT NULL,
  `wallet_address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT 0,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `app_id`, `wallet_address`, `phone`, `blocked`, `role`, `meta`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Super Admin', 'sa@app.com', NULL, '$2y$12$mfB7TjU6X.H8K7ww0j79kuSvZS1np24V6JrV3zrFu7HaeG652b/IW', NULL, NULL, NULL, 0, 'superadmin', NULL, NULL, '2025-12-01 00:25:22', '2025-12-01 00:25:22'),
(3, 'Admin User', 'admin@app.com', NULL, '$2y$12$mfB7TjU6X.H8K7ww0j79kuSvZS1np24V6JrV3zrFu7HaeG652b/IW', 1, NULL, NULL, 0, 'admin', NULL, NULL, '2025-12-01 03:57:00', '2025-12-01 03:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `voter_id` bigint(20) UNSIGNED NOT NULL,
  `sponsor_id` bigint(20) UNSIGNED NOT NULL,
  `voted_for` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `app_id`, `voter_id`, `sponsor_id`, `voted_for`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 7, 'HELPFULL', '2025-12-26 13:07:00', '2025-12-26 13:07:00'),
(2, 1, 7, 6, 'ACTIVE', '2025-12-26 13:07:22', '2025-12-26 13:07:22'),
(3, 1, 7, 6, 'HELPFULL', '2025-12-26 13:07:22', '2025-12-26 13:07:22'),
(4, 1, 7, 6, 'HONEST', '2025-12-26 13:07:22', '2025-12-26 13:07:22'),
(5, 1, 10, 7, 'HONEST', '2025-12-26 13:07:40', '2025-12-26 13:07:40'),
(6, 1, 9, 6, 'ACTIVE', '2025-12-26 16:39:25', '2025-12-26 16:39:25'),
(7, 1, 11, 1, 'ACTIVE', '2025-12-27 07:55:37', '2025-12-27 07:55:37'),
(8, 1, 11, 1, 'HELPFULL', '2025-12-27 07:55:37', '2025-12-27 07:55:37'),
(9, 1, 11, 1, 'HONEST', '2025-12-27 07:55:37', '2025-12-27 07:55:37'),
(10, 1, 1, 9, 'ACTIVE', '2025-12-27 14:53:56', '2025-12-27 14:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `payer_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,4) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

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
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`),
  ADD UNIQUE KEY `customers_referral_code_unique` (`referral_code`),
  ADD KEY `customers_app_id_index` (`app_id`),
  ADD KEY `customers_wallet_address_index` (`wallet_address`),
  ADD KEY `customers_sponsor_id_index` (`sponsor_id`);

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
  ADD KEY `customer_earning_details_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_earning_details_app_id_index` (`app_id`),
  ADD KEY `customer_earning_details_earning_type_index` (`earning_type`),
  ADD KEY `customer_earning_details_referene_id_foreign` (`reference_id`);

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
  ADD UNIQUE KEY `unique_ninepay_payment` (`transaction_id`,`app_id`,`customer_id`,`transaction_hash`) USING HASH;

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
  ADD KEY `sessions_last_activity_index` (`last_activity`),
  ADD KEY `sessions_app_id_index` (`app_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_app_id_foreign` (`app_id`),
  ADD KEY `users_wallet_address_index` (`wallet_address`),
  ADD KEY `users_phone_index` (`phone`);

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
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `app_leadership_income_plan`
--
ALTER TABLE `app_leadership_income_plan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `app_leadership_packages`
--
ALTER TABLE `app_leadership_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `app_level_packages`
--
ALTER TABLE `app_level_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `app_packages`
--
ALTER TABLE `app_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `app_promotion_packages`
--
ALTER TABLE `app_promotion_packages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_support_tickets`
--
ALTER TABLE `app_support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `customer_deposits`
--
ALTER TABLE `customer_deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `customer_earning_details`
--
ALTER TABLE `customer_earning_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `customer_financials`
--
ALTER TABLE `customer_financials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `customer_flush_details`
--
ALTER TABLE `customer_flush_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customer_withdraws`
--
ALTER TABLE `customer_withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forgot_password_requests`
--
ALTER TABLE `forgot_password_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `free_deposit_packages`
--
ALTER TABLE `free_deposit_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ninepay_transactions`
--
ALTER TABLE `ninepay_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nonces`
--
ALTER TABLE `nonces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `customer_earning_details_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_earning_details_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_earning_details_referene_id_foreign` FOREIGN KEY (`reference_id`) REFERENCES `customer_deposits` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE SET NULL;

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
