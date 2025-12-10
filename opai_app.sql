-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2025 at 07:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `coin_price` decimal(10,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`id`, `name`, `slug`, `primary_color`, `accent_color`, `logo_path`, `settings`, `coin_price`, `created_at`, `updated_at`) VALUES
(1, 'App One', 'app-one', NULL, NULL, NULL, NULL, 2.1000, '2025-12-01 01:46:50', '2025-12-01 01:46:50'),
(4, 'App Three', 'app-three', '#1d4ed8', '#ff0000', 'logo.png', NULL, 2.2000, '2025-12-01 01:58:32', '2025-12-01 01:58:32'),
(6, 'App Five', 'app-five', '#1d4ed8', '#ff0000', 'logo.png', '{\"padding\":\"1px\",\"margin\":\"2px\"}', 2.3000, '2025-12-01 02:09:35', '2025-12-01 02:09:35'),
(7, 'new app1', 'new-app1', '#db0a0a', '#04762a', 'logos/571jXy96jzi3PyoO6CiU4aymYeK395pvedYnVO7E.png', '[]', 5.0000, '2025-12-04 05:24:54', '2025-12-04 05:41:17');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_level_packages`
--

INSERT INTO `app_level_packages` (`id`, `app_id`, `level`, `directs`, `reward`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 35.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(2, 1, 2, 1, 10.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(3, 1, 3, 2, 5.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(4, 1, 4, 2, 4.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(5, 1, 5, 3, 3.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(6, 1, 6, 3, 3.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(7, 1, 7, 4, 3.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(8, 1, 8, 4, 2.50, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(9, 1, 9, 5, 2.50, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(10, 1, 10, 5, 2.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(11, 1, 11, 6, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(12, 1, 12, 6, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(13, 1, 13, 7, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(14, 1, 14, 7, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(15, 1, 15, 8, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(16, 1, 16, 8, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(17, 1, 17, 9, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(18, 1, 18, 9, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(19, 1, 19, 10, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04'),
(20, 1, 20, 10, 1.00, '2025-12-02 23:23:04', '2025-12-02 23:23:04');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_packages`
--

INSERT INTO `app_packages` (`id`, `app_id`, `plan_code`, `amount`, `roi_percent`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'P1', 5.00, 0.50, 1, '2025-12-02 01:17:05', '2025-12-09 07:27:30'),
(2, 1, 'P2', 10.00, 1.00, 1, '2025-12-02 01:17:05', '2025-12-02 01:17:05'),
(3, 1, 'P3', 25.00, 1.50, 1, '2025-12-02 01:17:05', '2025-12-02 01:17:05'),
(4, 1, 'P4', 50.00, 2.00, 1, '2025-12-02 01:17:05', '2025-12-02 01:17:05');

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
  `sponsor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `direct_ids` longtext DEFAULT NULL,
  `active_direct_ids` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `nonce` varchar(255) DEFAULT NULL,
  `eth_9pay_json_stop` text DEFAULT NULL,
  `tron_9pay_json_stop` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `app_id`, `name`, `email`, `phone`, `password`, `wallet_address`, `referral_code`, `sponsor_id`, `direct_ids`, `active_direct_ids`, `status`, `remember_token`, `role`, `level_id`, `nonce`, `eth_9pay_json_stop`, `tron_9pay_json_stop`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rahul Sharmas', 'rahul@app.coms', '9000000001', '$2y$12$.yj5C8olW1S7cZd0MKoKe.PMN2maBz75W82jJOVhlGfVtpE6jkJKi', '0x1111111111111111111111111111111111111111', '111111', NULL, '', NULL, 1, NULL, 'customer', NULL, NULL, NULL, NULL, '2025-12-01 06:27:18', '2025-12-09 23:23:51'),
(2, 1, 'Priya Verma', 'priya@app.com', '9000000002', '$2y$12$.yj5C8olW1S7cZd0MKoKe.PMN2maBz75W82jJOVhlGfVtpE6jkJKi', '0x8a4b086f9c80648e88bb096627d1223bd759a99f', '222222', 1, '3/4', NULL, 1, NULL, 'customer', 3, NULL, NULL, NULL, '2025-12-01 06:27:18', '2025-12-05 07:16:26'),
(3, 1, 'Vikram Singh', 'vikram@app.com', '9000000003', '$2y$12$.yj5C8olW1S7cZd0MKoKe.PMN2maBz75W82jJOVhlGfVtpE6jkJKi', '0x8a4b086f9c80648E88bB096627D1223BD759A00F', '59A00F', 2, '5/6/7/9/10/11', '10/11', 1, NULL, 'customer', 4, NULL, NULL, NULL, '2025-12-01 06:27:18', '2025-12-09 05:24:02'),
(4, 1, 'John Doe', 'john@example.com', '9000000004', '$2y$12$.yj5C8olW1S7cZd0MKoKe.PMN2maBz75W82jJOVhlGfVtpE6jkJKi', '0x8a4b086f9c80648e88bb096627d1223bd759a55f', 'PQRST2', 2, NULL, NULL, 1, NULL, 'customer', NULL, NULL, NULL, NULL, '2025-12-01 06:58:13', '2025-12-03 00:02:41'),
(5, 1, 'Jina Davis', 'jina@example.com', '9000000005', '$2y$12$mJmyJLtfR6ce7ZylZQ1N8.vVtmaMq25AcOSkCCNsg2vO/vaCnkixa', '0x8a4b086f9c80648e88bb096627d1223bd759a77f', 'AB123C', 3, '8', NULL, 1, NULL, 'customer', NULL, NULL, NULL, NULL, '2025-12-01 06:59:25', '2025-12-04 07:43:43'),
(6, 1, 'Sujit Kumar', 'sujit@example.com', '9000000006', '$2y$12$Biwa1jYHRGfsK.ALCFGlbuZ6kyCvIqSLerC1kGr3Lp6uHdptslt.C', '0x8a4b086f9c80648e88bb096627d1223bd759a88f', 'ABCDEF', 3, NULL, NULL, 1, NULL, 'customer', NULL, NULL, NULL, NULL, '2025-12-01 07:02:14', '2025-12-03 00:02:41'),
(7, 1, 'Mira Iyar', 'mira@example.com', '9000000007', '$2y$12$JWQpL5BRa9UXY1iH/ogeMuELKp6KQ9WhWDO4BeZApBD1vvWDPMLCu', '0x8a4b086f9c80648e88bb096627d1223bd759a99f', 'VTVUC2', 3, NULL, NULL, 1, NULL, 'customer', NULL, NULL, NULL, NULL, '2025-12-01 07:04:37', '2025-12-03 00:02:41'),
(8, 1, 'avi jha', 'hello@360core.inc', NULL, '$2y$12$ekV0t40mOPLWbEC7XK0RLOXHOyJiQspj0MCXVWRtRndPV9KLOqt2C', NULL, 'A1GCGH', 5, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 07:43:43', '2025-12-04 07:43:43'),
(9, 1, 'van matt', 'van@app.com', NULL, '$2y$12$.yj5C8olW1S7cZd0MKoKe.PMN2maBz75W82jJOVhlGfVtpE6jkJKi', '0x8a4b086f9c80648E88bB096627D1223BD759A66I', '59A66I', 3, NULL, NULL, 1, NULL, 'customer', NULL, NULL, NULL, NULL, '2025-12-05 07:23:53', '2025-12-08 23:06:10'),
(10, 1, 'suman', 'suman@app.com', NULL, '$2y$12$.yj5C8olW1S7cZd0MKoKe.PMN2maBz75W82jJOVhlGfVtpE6jkJKi', '0x8a4b086f9c80648E88bB096627D1223BD759A66F', '59A66F', 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-09 03:39:50', '2025-12-09 03:39:50'),
(11, 1, 'rajan', 'rajan@app.com', NULL, '$2y$12$VSXgC2a4z1mxZ0.3beYnReGueOxSrZBnwPjhuUbzgiSCNBhPC2FWO', NULL, NULL, 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-09 04:32:24', '2025-12-09 04:32:24');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_deposits`
--

INSERT INTO `customer_deposits` (`id`, `app_id`, `customer_id`, `package_id`, `amount`, `roi_percent`, `roi_earned`, `transaction_id`, `payment_status`, `coin_price`, `is_free_deposit`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 5.00, 0.50, 0.0754, '4UKQY8pN3lGO', 'success', 2.0000, 0, '2025-12-02 04:02:38', '2025-12-04 01:21:31'),
(2, 1, 4, 1, 5.00, 0.50, 0.0754, 'RAND-U4VOq0Aoito9', 'success', 2.0000, 0, '2025-12-02 04:04:00', '2025-12-04 01:21:32'),
(3, 1, 3, 3, 25.00, 1.50, 1.1419, 'RAND-VqAQLH2Mukae', 'success', 2.0000, 0, '2025-12-02 04:04:38', '2025-12-04 01:21:32'),
(4, 1, 4, 3, 25.00, 1.50, 1.1419, 'RAND-Au9qhcQcWCta', 'success', 2.0000, 0, '2025-12-02 04:05:00', '2025-12-04 01:21:32'),
(5, 1, 4, 3, 25.00, 1.50, 1.1419, 'RAND-nNOc51gLzffn', 'success', 2.0000, 0, '2025-12-02 04:11:01', '2025-12-04 01:21:32'),
(6, 1, 5, 2, 10.00, 1.00, 0.1000, 'FREEPACKAGE-2', 'success', 2.0000, 0, '2025-12-03 04:41:07', '2025-12-04 01:21:32'),
(7, 1, 5, 3, 25.00, 1.50, 0.3750, 'RAND-eB2LaWCggGcU', 'success', 2.0000, 0, '2025-12-03 04:42:34', '2025-12-04 01:21:32'),
(8, 1, 2, 2, 10.00, 1.00, 0.0000, 'RAND-cXX36lQnl6P6', 'success', 2.0000, 0, '2025-12-04 01:13:17', '2025-12-04 01:13:17'),
(9, 1, 2, 2, 10.00, 1.00, 0.0000, 'RAND-sKp0fO2FLTO9', 'pending', 2.0000, 0, '2025-12-05 00:26:53', '2025-12-05 00:26:53'),
(10, 1, 2, 2, 10.00, 1.00, 0.0000, 'RAND-3knlRyVHEUlG', 'success', 2.0000, 0, '2025-12-05 00:27:18', '2025-12-05 00:27:18'),
(11, 1, 2, 2, 10.00, 1.00, 0.0000, 'RAND-psDAcqvzshE4', 'success', 2.0000, 0, '2025-12-05 00:27:39', '2025-12-05 00:27:39'),
(12, 1, 2, 2, 10.00, 1.00, 0.0000, 'RAND-G9cYOYO5LiJL', 'success', 2.0000, 0, '2025-12-05 00:27:51', '2025-12-05 00:27:51'),
(13, 1, 9, 1, 5.00, 0.50, 0.0000, 'DEPOSITrPKzUGv3', 'success', 2.0000, 0, '2025-12-09 02:13:29', '2025-12-09 02:13:29'),
(14, 1, 10, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-3Otb4Ibm', 'pending', 2.0000, 0, '2025-12-09 04:21:55', '2025-12-09 04:21:55'),
(17, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-VJghyTKu', 'success', 2.0000, 0, '2025-12-09 04:38:00', '2025-12-09 04:38:00'),
(18, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-1YZS36hJ', 'success', 2.0000, 0, '2025-12-09 04:56:59', '2025-12-09 04:56:59'),
(19, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-vZoQFiow', 'success', 2.0000, 0, '2025-12-09 05:02:29', '2025-12-09 05:02:29'),
(20, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-NA1vDk4H', 'success', 2.0000, 0, '2025-12-09 05:03:27', '2025-12-09 05:03:27'),
(21, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-6jdmuo1X', 'success', 2.0000, 0, '2025-12-09 05:03:51', '2025-12-09 05:03:51'),
(22, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-T3pS7AmL', 'success', 2.0000, 0, '2025-12-09 05:04:20', '2025-12-09 05:04:20'),
(23, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-D2w2guS4', 'success', 2.0000, 0, '2025-12-09 05:05:00', '2025-12-09 05:05:00'),
(24, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-W2QulTbO', 'success', 2.0000, 0, '2025-12-09 05:08:46', '2025-12-09 05:08:46'),
(25, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-pNTu2GII', 'success', 2.0000, 0, '2025-12-09 05:09:34', '2025-12-09 05:09:34'),
(26, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-frVLz5Yr', 'success', 2.0000, 0, '2025-12-09 05:11:11', '2025-12-09 05:11:11'),
(27, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-prYQKrpI', 'success', 2.0000, 0, '2025-12-09 05:14:50', '2025-12-09 05:14:50'),
(28, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-65WIqjeN', 'success', 2.0000, 0, '2025-12-09 05:15:16', '2025-12-09 05:15:16'),
(29, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-sWnIwkZP', 'success', 2.0000, 0, '2025-12-09 05:17:22', '2025-12-09 05:17:22'),
(30, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-fworodTm', 'success', 2.0000, 0, '2025-12-09 05:20:56', '2025-12-09 05:20:56'),
(31, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-41PSWY5w', 'success', 2.0000, 0, '2025-12-09 05:21:17', '2025-12-09 05:21:17'),
(32, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-BHykMGA6', 'success', 2.0000, 0, '2025-12-09 05:22:40', '2025-12-09 05:22:40'),
(33, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-3GCn8tZs', 'success', 2.0000, 0, '2025-12-09 05:22:53', '2025-12-09 05:22:53'),
(34, 1, 11, 1, 5.00, 0.50, 0.0000, 'DEPOSIT-1RyWDykz', 'success', 2.0000, 0, '2025-12-09 05:24:02', '2025-12-09 05:24:02');

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
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_earning_details`
--

INSERT INTO `customer_earning_details` (`id`, `app_id`, `customer_id`, `reference_id`, `reference_amount`, `amount_earned`, `earning_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 5.0000, 0.0250, '', 1, '2025-12-02 05:33:05', '2025-12-02 05:33:05'),
(2, 1, 4, 2, 5.0000, 0.0250, '', 1, '2025-12-02 05:33:05', '2025-12-02 05:33:05'),
(3, 1, 4, 3, 25.0000, 0.3750, '', 1, '2025-12-02 05:33:05', '2025-12-02 05:33:05'),
(4, 1, 4, 4, 25.0000, 0.3750, '', 1, '2025-12-02 05:33:05', '2025-12-02 05:33:05'),
(5, 1, 4, 5, 25.0000, 0.3750, '', 1, '2025-12-02 05:33:05', '2025-12-02 05:33:05'),
(6, 1, 4, 1, 5.0250, 0.0251, '', 1, '2025-12-02 05:33:20', '2025-12-02 05:33:20'),
(7, 1, 4, 2, 5.0250, 0.0251, '', 1, '2025-12-02 05:33:20', '2025-12-02 05:33:20'),
(8, 1, 4, 3, 25.3750, 0.3806, '', 1, '2025-12-02 05:33:20', '2025-12-02 05:33:20'),
(9, 1, 4, 4, 25.3750, 0.3806, '', 1, '2025-12-02 05:33:20', '2025-12-02 05:33:20'),
(10, 1, 4, 5, 25.3750, 0.3806, '', 1, '2025-12-02 05:33:20', '2025-12-02 05:33:20'),
(14, 1, 2, 3, 2.3169, 0.1158, '', 1, '2025-12-03 04:00:45', '2025-12-03 04:00:45'),
(15, 1, 2, 1, 5.0501, 0.0253, '', 1, '2025-12-04 01:21:31', '2025-12-04 01:21:31'),
(16, 1, 4, 2, 5.0501, 0.0253, '', 1, '2025-12-04 01:21:32', '2025-12-04 01:21:32'),
(17, 1, 3, 3, 25.7556, 0.3863, '', 1, '2025-12-04 01:21:32', '2025-12-04 01:21:32'),
(18, 1, 4, 4, 25.7556, 0.3863, '', 1, '2025-12-04 01:21:32', '2025-12-04 01:21:32'),
(19, 1, 4, 5, 25.7556, 0.3863, '', 1, '2025-12-04 01:21:32', '2025-12-04 01:21:32'),
(20, 1, 5, 6, 10.0000, 0.1000, '', 1, '2025-12-04 01:21:32', '2025-12-04 01:21:32'),
(21, 1, 5, 7, 25.0000, 0.3750, '', 1, '2025-12-04 01:21:32', '2025-12-04 01:21:32'),
(22, 1, 3, 4, 5.0000, 0.2000, 'LEVEL-REWARD', 1, '2025-12-09 05:24:02', '2025-12-09 05:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `customer_financials`
--

CREATE TABLE `customer_financials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `total_deposit` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `total_roi` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `total_withdraws` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `capping_limit` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `total_topup` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_financials`
--

INSERT INTO `customer_financials` (`id`, `app_id`, `customer_id`, `total_deposit`, `total_roi`, `total_withdraws`, `capping_limit`, `total_topup`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 35.000000, 0.029100, 0.112000, 2.000000, 0.0000, '2025-12-04 01:13:17', '2025-12-05 00:36:51'),
(2, 1, 4, 55.000000, 3.164900, 0.000000, 2.000000, 0.0000, '2025-12-04 01:21:32', '2025-12-04 01:21:32'),
(3, 1, 3, 25.000000, 0.386300, 0.000000, 2.000000, 0.0000, '2025-12-04 01:21:32', '2025-12-04 01:21:32'),
(4, 1, 5, 35.000000, 0.475000, 0.000000, 2.000000, 6.0000, '2025-12-04 01:21:32', '2025-12-06 07:08:23'),
(6, 1, 9, 5.000000, 0.000000, 0.000000, 0.000000, 90.0000, '2025-12-08 23:52:59', '2025-12-09 02:13:29'),
(7, 1, 10, 5.000000, 0.000000, 0.000000, 0.000000, 5.0000, '2025-12-09 04:21:08', '2025-12-09 04:24:52'),
(8, 1, 11, 90.000000, 0.000000, 0.000000, 0.000000, 20.0000, '2025-12-09 04:37:25', '2025-12-09 05:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `customer_withdraws`
--

CREATE TABLE `customer_withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `admin_charge` decimal(10,4) NOT NULL,
  `fees` decimal(10,4) NOT NULL,
  `coin_price` decimal(10,4) NOT NULL,
  `amount` decimal(10,4) NOT NULL,
  `admin_charge_amount` decimal(10,4) NOT NULL,
  `fees_amount` decimal(10,4) NOT NULL,
  `net_amount` decimal(10,4) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_withdraws`
--

INSERT INTO `customer_withdraws` (`id`, `app_id`, `customer_id`, `admin_charge`, `fees`, `coin_price`, `amount`, `admin_charge_amount`, `fees_amount`, `net_amount`, `transaction_id`, `transaction_type`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 0.0010, 0.0010, 0.0010, 0.0010, 0.0010, 0.0010, 0.0010, 'WITHDRAW-CQeCbn', 'WITHDRAW', '2025-12-04 01:40:24', '2025-12-04 01:40:24'),
(2, 1, 2, 0.0010, 0.0010, 0.0010, 0.0010, 0.0010, 0.0010, 0.0010, 'WITHDRAW-2QuKuD', 'WITHDRAW', '2025-12-04 01:45:26', '2025-12-04 01:45:26'),
(3, 1, 2, 0.1100, 0.1100, 0.1100, 0.1100, 0.1100, 0.1100, 0.1100, 'WITHDRAW-BJ4RiR', 'WITHDRAW', '2025-12-05 00:36:51', '2025-12-05 00:36:51');

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
(1, 1, 1, 5, 1, '2025-12-03 04:27:05', '2025-12-03 04:27:05'),
(2, 1, 2, 5, 1, '2025-12-03 04:27:05', '2025-12-03 04:27:05'),
(3, 1, 1, 2, 0, '2025-12-10 00:53:12', '2025-12-10 01:09:14');

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
(23, '2025_12_06_072117_create_ninepay_transactions_table', 17);

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
  `currency` varchar(225) DEFAULT NULL,
  `transaction_hash` text DEFAULT NULL,
  `payment_status` enum('pending','success','failed','underpaid') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ninepay_transactions`
--

INSERT INTO `ninepay_transactions` (`id`, `transaction_id`, `eth_9pay_json`, `tron_9pay_json`, `payment_address`, `app_id`, `customer_id`, `amount`, `fees_amount`, `received_amount`, `chain`, `currency`, `transaction_hash`, `payment_status`, `created_at`, `updated_at`) VALUES
(27, 'TXN279L6mU', '{\"id\":13278,\"userId\":\"9\",\"projectId\":\"ninepaytest\",\"address\":\"0xC4A1fFa591253d729376bBa0Db2c6cE5BB7ba49e\",\"isETH\":true,\"chains\":[\"eth\"],\"createdAt\":\"2025-12-08 09:36:55\"}', '{\"id\":13273,\"userId\":\"59A66F\",\"projectId\":\"ninepaytest\",\"address\":\"TA83giEwDNLooM6Hb6fRAUu2PNf949G3fk\",\"isETH\":false,\"chains\":[\"TRX\"],\"createdAt\":\"2025-12-06 09:21:44\"}', '0xC4A1fFa591253d729376bBa0Db2c6cE5BB7ba49e', 1, 9, 50.000000, 0.000000, 30.000000, NULL, NULL, '0bc39eba25c1be86fdf65a0d618d83880a49315fcadf6837c482495a263a366', 'success', '2025-12-08 23:31:22', '2025-12-08 23:55:43'),
(28, 'TXN279L6mU', '{\"id\":13278,\"userId\":\"9\",\"projectId\":\"ninepaytest\",\"address\":\"0xC4A1fFa591253d729376bBa0Db2c6cE5BB7ba49e\",\"isETH\":true,\"chains\":[\"eth\"],\"createdAt\":\"2025-12-08 09:36:55\"}', '{\"id\":13273,\"userId\":\"59A66F\",\"projectId\":\"ninepaytest\",\"address\":\"TA83giEwDNLooM6Hb6fRAUu2PNf949G3fk\",\"isETH\":false,\"chains\":[\"TRX\"],\"createdAt\":\"2025-12-06 09:21:44\"}', '0xC4A1fFa591253d729376bBa0Db2c6cE5BB7ba49e', 1, 9, 20.000000, 0.000000, 20.000000, NULL, NULL, '0bc39eba25c1be86fdf65a0d618d83880a49315fcadf6837c482495a263a367', 'success', '2025-12-08 23:55:54', '2025-12-09 00:20:38'),
(29, 'TXN2992cOF', '{\"id\":13278,\"userId\":\"9\",\"projectId\":\"ninepaytest\",\"address\":\"0xC4A1fFa591253d729376bBa0Db2c6cE5BB7ba49e\",\"isETH\":true,\"chains\":[\"eth\"],\"createdAt\":\"2025-12-08 09:36:55\"}', '{\"id\":13273,\"userId\":\"59A66F\",\"projectId\":\"ninepaytest\",\"address\":\"TA83giEwDNLooM6Hb6fRAUu2PNf949G3fk\",\"isETH\":false,\"chains\":[\"TRX\"],\"createdAt\":\"2025-12-06 09:21:44\"}', '0xC4A1fFa591253d729376bBa0Db2c6cE5BB7ba49e', 1, 9, 30.000000, 0.000000, 10.000000, NULL, NULL, '0bc39eba25c1be86fdf65a0d618d83880a49315fcadf6837c482366a263a495', 'success', '2025-12-09 00:24:29', '2025-12-09 01:05:03'),
(33, 'TXN2992cOF', '{\"id\":13278,\"userId\":\"9\",\"projectId\":\"ninepaytest\",\"address\":\"0xC4A1fFa591253d729376bBa0Db2c6cE5BB7ba49e\",\"isETH\":true,\"chains\":[\"eth\"],\"createdAt\":\"2025-12-08 09:36:55\"}', '{\"id\":13273,\"userId\":\"59A66F\",\"projectId\":\"ninepaytest\",\"address\":\"TA83giEwDNLooM6Hb6fRAUu2PNf949G3fk\",\"isETH\":false,\"chains\":[\"TRX\"],\"createdAt\":\"2025-12-06 09:21:44\"}', '0xC4A1fFa591253d729376bBa0Db2c6cE5BB7ba49e', 1, 9, 20.000000, 0.000000, 10.000000, NULL, NULL, '0bc39eba25c1be86fdf65a0d618d83880a49315fcadf6837c482366a263a496', 'success', '2025-12-09 00:56:04', '2025-12-09 01:05:03'),
(34, 'TXN2992cOF', '{\"id\":13278,\"userId\":\"9\",\"projectId\":\"ninepaytest\",\"address\":\"0xC4A1fFa591253d729376bBa0Db2c6cE5BB7ba49e\",\"isETH\":true,\"chains\":[\"eth\"],\"createdAt\":\"2025-12-08 09:36:55\"}', '{\"id\":13273,\"userId\":\"59A66F\",\"projectId\":\"ninepaytest\",\"address\":\"TA83giEwDNLooM6Hb6fRAUu2PNf949G3fk\",\"isETH\":false,\"chains\":[\"TRX\"],\"createdAt\":\"2025-12-06 09:21:44\"}', '0xC4A1fFa591253d729376bBa0Db2c6cE5BB7ba49e', 1, 9, 10.000000, 0.000000, 10.000000, NULL, NULL, '0bc39eba25c1be86fdf65a0d618d83880a49315fcadf6837c482366a263a497', 'success', '2025-12-09 00:58:25', '2025-12-09 01:05:03'),
(36, 'TXN369z2Wn', '{\"id\":13278,\"userId\":\"9\",\"projectId\":\"ninepaytest\",\"address\":\"0xC4A1fFa591253d729376bBa0Db2c6cE5BB7ba49e\",\"isETH\":true,\"chains\":[\"eth\"],\"createdAt\":\"2025-12-08 09:36:55\"}', '{\"id\":13273,\"userId\":\"59A66F\",\"projectId\":\"ninepaytest\",\"address\":\"TA83giEwDNLooM6Hb6fRAUu2PNf949G3fk\",\"isETH\":false,\"chains\":[\"TRX\"],\"createdAt\":\"2025-12-06 09:21:44\"}', '0xC4A1fFa591253d729376bBa0Db2c6cE5BB7ba49e', 1, 9, 10.000000, 0.000000, 10.000000, NULL, NULL, '0bc39eba25c1be86fdf65a0d618d83880a49315fcadf6837c482366a263a498', 'success', '2025-12-09 01:05:31', '2025-12-09 01:07:28'),
(37, 'TXN3710KITT', '{\"address\":\"0x2bA581af03DEb935D0C1CEc03C20c0e3d17DE6b1\",\"createdAt\":\"2025-12-09T09:44:42.007Z\",\"info\":{\"provider\":null,\"address\":\"0x2bA581af03DEb935D0C1CEc03C20c0e3d17DE6b1\",\"publicKey\":\"0x03be19eb6f5e1cd540a034c9c4e046b2842040883b4bd7e5ca5c54c11768a6a329\",\"fingerprint\":\"0xdc1fb3f7\",\"parentFingerprint\":\"0x418f67a9\",\"chainCode\":\"0x612df29ac42d3d3ad04230139d09c6a3139cead54d3ae8b090250f089b52f05d\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TQCbWBCNppYJvZWF2wGNkiS47vY6kqy4pb\",\"createdAt\":\"2025-12-09T09:44:43.191Z\",\"userId\":\"10\"}', '0x2bA581af03DEb935D0C1CEc03C20c0e3d17DE6b1', 1, 10, 10.000000, 0.000000, 10.000000, NULL, NULL, '0bc39eba25c1be86fdf65a0d618d83880a49315fcadf6837c482495a263a477', 'success', '2025-12-09 04:14:43', '2025-12-09 04:21:08'),
(38, 'TXN3811kJCU', '{\"address\":\"0x4a7A5F35c6000E145b8B67AB2Df1095DF3A6A2e5\",\"createdAt\":\"2025-12-09T10:03:19.295Z\",\"info\":{\"provider\":null,\"address\":\"0x4a7A5F35c6000E145b8B67AB2Df1095DF3A6A2e5\",\"publicKey\":\"0x02416409d42dcab0f280d99f1f9f16f58fd45c5d8fc5a55bcee48fdee48fcce2ef\",\"fingerprint\":\"0x9ebcaf25\",\"parentFingerprint\":\"0xa18ab3b8\",\"chainCode\":\"0x3b28703e9dc416b1f06143cc4d9d5d5d9d87b4756e6cbc7423cc540dc5661b8f\",\"path\":\"m/44\'/60\'/0\'/0/0\",\"index\":0,\"depth\":5}}', '{\"address\":\"TVSRFmKDu5CZPWUGoDHVBdVToHMddW2hWu\",\"createdAt\":\"2025-12-09T10:03:20.050Z\",\"userId\":\"11\"}', '0x4a7A5F35c6000E145b8B67AB2Df1095DF3A6A2e5', 1, 11, 10.000000, 0.000000, 10.000000, NULL, NULL, '0bc39eba25c1be86fdf65a0d618d83880a49315fcadf6837c482495a263a488', 'success', '2025-12-09 04:33:19', '2025-12-09 04:37:25');

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
('ceasI5lSwVHoqUaIUbzq9cw0dwi2jPSeYmlbVYEy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWdha2MzaWFqRU9yek04R0J6Q1FGTnFQQWQ1UUZWTWp0ZTgyRUhCbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7czo1OiJyb3V0ZSI7czoxMToiYWRtaW4ubG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1765349182, NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `app_id`, `wallet_address`, `phone`, `blocked`, `role`, `meta`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Super Admin', 'sa@app.com', NULL, '$2y$12$mfB7TjU6X.H8K7ww0j79kuSvZS1np24V6JrV3zrFu7HaeG652b/IW', NULL, NULL, NULL, 0, 'superadmin', NULL, NULL, '2025-12-01 00:25:22', '2025-12-01 00:25:22'),
(3, 'Admin User', 'admin@app.com', NULL, '$2y$12$mfB7TjU6X.H8K7ww0j79kuSvZS1np24V6JrV3zrFu7HaeG652b/IW', 1, NULL, NULL, 0, 'admin', NULL, NULL, '2025-12-01 03:57:00', '2025-12-01 03:57:00'),
(4, 'admin2', 'admin2@app.com', NULL, '$2y$12$AJ5lZb7hXhvUeXcuQ9ckIOB.iSD5fyjJHHOxYLvvLj9NPdVqimfvm', 6, NULL, NULL, 0, 'admin', NULL, NULL, '2025-12-04 05:53:29', '2025-12-04 05:53:29'),
(5, 'admin2', 'admn2@app.com', NULL, '$2y$12$v4lyb.lDCv.NzmYbFyrc9eHfN/MrrhaM0WVsXZ/2hMITGydwhUKUm', 1, NULL, NULL, 0, 'admin', NULL, NULL, '2025-12-04 05:56:23', '2025-12-04 05:56:23'),
(6, 'admin33', 'admin33@app.com', NULL, '$2y$12$TmkfIpYtHZ9ju7.W/NLQgugtyJ0zDdd7b.bj9o6vHMxvg4inPTN8q', 1, NULL, NULL, 0, 'admin', NULL, NULL, '2025-12-04 05:57:03', '2025-12-04 06:02:33');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `app_id`, `payer_id`, `receiver_id`, `amount`, `transaction_id`, `transaction_type`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, 10.0000, 'P2PTRANS-4h01-2-5', 'P2PTRANSFER', '2025-12-03 06:13:58', '2025-12-03 06:13:58'),
(2, 1, 2, 5, 10.0000, 'P2PTRANS-AlAa-2-5', 'P2PTRANSFER', '2025-12-03 06:18:40', '2025-12-03 06:18:40'),
(3, 1, 2, 3, 10.0000, 'P2PTRANS-cpHh-2-3', 'P2PTRANSFER', '2025-12-05 00:46:01', '2025-12-05 00:46:01'),
(4, 1, 2, 3, 10.0000, 'P2PTRANS-9ZNn-2-3', 'P2PTRANSFER', '2025-12-05 00:46:58', '2025-12-05 00:46:58'),
(5, 1, 2, 7, 20.0000, 'P2PTRANS-mVaM-2-7', 'P2PTRANSFER', '2025-12-05 00:48:14', '2025-12-05 00:48:14');

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
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_settings_app_id_foreign` (`app_id`);

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
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer_deposits`
--
ALTER TABLE `customer_deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `customer_earning_details`
--
ALTER TABLE `customer_earning_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `customer_financials`
--
ALTER TABLE `customer_financials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_withdraws`
--
ALTER TABLE `customer_withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `free_deposit_packages`
--
ALTER TABLE `free_deposit_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ninepay_transactions`
--
ALTER TABLE `ninepay_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

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
