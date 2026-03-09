-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Feb 22, 2026 at 04:39 AM
-- Server version: 8.0.44
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prime_bank_db_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('free','busy','offline') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'offline',
  `last_seen` timestamp NULL DEFAULT NULL,
  `total_calls` int NOT NULL DEFAULT '0',
  `total_duration` int NOT NULL DEFAULT '0',
  `average_rating` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `user_id`, `name`, `email`, `phone`, `department`, `status`, `last_seen`, `total_calls`, `total_duration`, `average_rating`, `created_at`, `updated_at`) VALUES
(7, 16, 'Test Staff Agent', 'teststaff_1771055233@example.com', NULL, 'Customer Support', 'free', '2026-02-17 07:00:31', 5, -186640, 0, '2026-02-14 07:47:14', '2026-02-17 07:00:31'),
(8, 1, 'Receptionist', 'ashrafulinstasure@gmail.com', NULL, 'Customer Support', 'free', '2026-02-22 04:37:29', 60, -59004, 0.08, '2026-02-14 07:49:50', '2026-02-22 04:37:45'),
(9, 2, 'Staff', 'ashrafulunisoft@gmail.com', NULL, 'Customer Support', 'free', '2026-02-18 08:54:16', 1, -9880, 0, '2026-02-18 06:09:34', '2026-02-18 08:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `call_feedback`
--

CREATE TABLE `call_feedback` (
  `id` bigint UNSIGNED NOT NULL,
  `call_session_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `agent_id` bigint UNSIGNED DEFAULT NULL,
  `rating` int NOT NULL COMMENT '1-5 stars',
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `customer_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `call_feedback`
--

INSERT INTO `call_feedback` (`id`, `call_session_id`, `user_id`, `agent_id`, `rating`, `comment`, `customer_name`, `created_at`, `updated_at`) VALUES
(3, 12, 17, 7, 5, 'Excellent service! The agent was very helpful and professional.', 'Test Visitor Customer', '2026-02-14 07:47:16', '2026-02-14 07:47:16'),
(4, 13, 4, 7, 5, NULL, 'Visitor', '2026-02-14 07:50:55', '2026-02-14 07:50:55'),
(5, 15, 4, 7, 3, NULL, 'Visitor', '2026-02-14 07:52:35', '2026-02-14 07:52:35'),
(6, 16, 4, 7, 3, 'jkdfjafj', 'Visitor', '2026-02-16 11:54:50', '2026-02-16 11:54:50'),
(7, 17, 4, 7, 3, NULL, 'Visitor', '2026-02-17 07:04:45', '2026-02-17 07:04:45'),
(8, 18, 4, 9, 5, NULL, 'Visitor', '2026-02-18 08:54:27', '2026-02-18 08:54:27'),
(9, 19, 4, 8, 5, NULL, 'Visitor', '2026-02-18 08:57:42', '2026-02-18 08:57:42'),
(10, 19, 4, 8, 4, NULL, 'Visitor', '2026-02-18 08:58:15', '2026-02-18 08:58:15'),
(11, 20, 4, 8, 5, NULL, 'Visitor', '2026-02-18 08:59:10', '2026-02-18 08:59:10'),
(12, 21, 4, 8, 5, NULL, 'Visitor', '2026-02-18 09:16:25', '2026-02-18 09:16:25'),
(13, 22, 4, 8, 5, NULL, 'Visitor', '2026-02-18 09:20:07', '2026-02-18 09:20:07'),
(14, 24, 4, 8, 5, NULL, 'Visitor', '2026-02-18 09:29:32', '2026-02-18 09:29:32'),
(15, 27, 4, 8, 3, NULL, 'Visitor', '2026-02-18 09:41:14', '2026-02-18 09:41:14'),
(16, 28, 4, 8, 5, NULL, 'Visitor', '2026-02-18 09:42:23', '2026-02-18 09:42:23'),
(17, 25, 4, 8, 5, NULL, 'Visitor', '2026-02-18 10:12:20', '2026-02-18 10:12:20'),
(18, 31, 4, 8, 5, NULL, 'Visitor', '2026-02-18 10:15:28', '2026-02-18 10:15:28'),
(19, 32, 4, 8, 5, NULL, 'Visitor', '2026-02-18 10:18:33', '2026-02-18 10:18:33'),
(20, 33, 4, 8, 5, NULL, 'Visitor', '2026-02-18 10:19:19', '2026-02-18 10:19:19'),
(21, 34, 4, 8, 5, NULL, 'Visitor', '2026-02-18 10:20:25', '2026-02-18 10:20:25'),
(22, 36, 4, 8, 5, NULL, 'Visitor', '2026-02-18 10:33:22', '2026-02-18 10:33:22'),
(23, 37, 4, 8, 5, NULL, 'Visitor', '2026-02-18 10:34:49', '2026-02-18 10:34:49'),
(24, 39, 4, 8, 5, NULL, 'Visitor', '2026-02-18 10:38:45', '2026-02-18 10:38:45'),
(25, 39, 4, 8, 4, NULL, 'Visitor', '2026-02-18 10:39:20', '2026-02-18 10:39:20'),
(26, 46, 4, 8, 5, NULL, 'Visitor', '2026-02-18 11:45:20', '2026-02-18 11:45:20'),
(27, 45, 4, 8, 5, NULL, 'Visitor', '2026-02-18 11:48:04', '2026-02-18 11:48:04'),
(28, 48, 4, 8, 5, NULL, 'Visitor', '2026-02-18 11:52:55', '2026-02-18 11:52:55'),
(29, 51, 4, 8, 5, NULL, 'Visitor', '2026-02-18 12:05:42', '2026-02-18 12:05:42'),
(30, 54, 4, 8, 5, NULL, 'Visitor', '2026-02-18 12:11:34', '2026-02-18 12:11:34'),
(31, 57, 4, 8, 5, NULL, 'Visitor', '2026-02-19 04:14:19', '2026-02-19 04:14:19'),
(32, 59, 4, 8, 5, NULL, 'Visitor', '2026-02-19 04:18:44', '2026-02-19 04:18:44'),
(33, 61, 4, 8, 5, 'GOOD', 'Visitor', '2026-02-22 04:37:45', '2026-02-22 04:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `call_metrics`
--

CREATE TABLE `call_metrics` (
  `id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL DEFAULT (curdate()),
  `total_calls` int NOT NULL DEFAULT '0',
  `connected_calls` int NOT NULL DEFAULT '0',
  `missed_calls` int NOT NULL DEFAULT '0',
  `total_duration` int NOT NULL DEFAULT '0',
  `total_wait_time` int NOT NULL DEFAULT '0',
  `average_wait_time` double NOT NULL DEFAULT '0',
  `average_rating` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `call_metrics`
--

INSERT INTO `call_metrics` (`id`, `date`, `total_calls`, `connected_calls`, `missed_calls`, `total_duration`, `total_wait_time`, `average_wait_time`, `average_rating`, `created_at`, `updated_at`) VALUES
(1, '2026-02-14', 6, 0, 6, -175, 0, 0, 0, '2026-02-14 04:46:53', '2026-02-14 07:52:20'),
(2, '2026-02-16', 1, 0, 1, -186135, 0, 0, 0, '2026-02-16 11:54:38', '2026-02-16 11:54:38'),
(3, '2026-02-17', 1, 0, 1, -330, 0, 0, 0, '2026-02-17 07:00:31', '2026-02-17 07:00:31'),
(4, '2026-02-18', 53, 0, 53, -12705, -436, 0, 0, '2026-02-18 08:54:16', '2026-02-18 12:43:55'),
(5, '2026-02-19', 5, 0, 5, -55948, -20, 0, 0, '2026-02-19 04:14:14', '2026-02-19 04:19:51'),
(6, '2026-02-22', 2, 0, 2, -154, -12, 0, 0, '2026-02-22 04:37:29', '2026-02-22 04:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `call_queue`
--

CREATE TABLE `call_queue` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('waiting','connected','cancelled','timeout','ended') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'waiting',
  `position` int NOT NULL DEFAULT '0',
  `joined_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `connected_at` timestamp NULL DEFAULT NULL,
  `ended_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `call_queue`
--

INSERT INTO `call_queue` (`id`, `user_id`, `customer_name`, `customer_phone`, `customer_email`, `status`, `position`, `joined_at`, `connected_at`, `ended_at`, `created_at`, `updated_at`) VALUES
(14, 17, 'Test Visitor Customer', '', 'testvisitor_1771055233@example.com', 'ended', 0, '2026-02-14 07:47:15', '2026-02-14 07:47:15', '2026-02-14 07:47:16', '2026-02-14 07:47:15', '2026-02-14 07:47:16'),
(15, 18, 'Second Visitor', '', 'visitor2_1771055233@example.com', 'connected', 1, '2026-02-14 07:47:15', '2026-02-14 07:49:59', NULL, '2026-02-14 07:47:15', '2026-02-14 07:49:59'),
(16, 4, 'Visitor', '', 'kali1212hit@gmail.com', 'ended', 0, '2026-02-14 07:49:15', '2026-02-14 07:49:15', '2026-02-14 07:50:50', '2026-02-14 07:49:15', '2026-02-14 07:50:50'),
(17, 4, 'Visitor', '', 'kali1212hit@gmail.com', 'ended', 0, '2026-02-14 07:51:00', '2026-02-14 07:51:00', '2026-02-14 07:52:20', '2026-02-14 07:51:00', '2026-02-14 07:52:20'),
(18, 4, 'Visitor', '', 'kali1212hit@gmail.com', 'ended', 0, '2026-02-14 08:12:23', '2026-02-14 08:12:23', '2026-02-16 11:54:38', '2026-02-14 08:12:23', '2026-02-16 11:54:38'),
(19, 4, 'Visitor', '', 'kali1212hit@gmail.com', 'ended', 0, '2026-02-17 06:55:01', '2026-02-17 06:55:01', '2026-02-17 07:00:31', '2026-02-17 06:55:01', '2026-02-17 07:00:31'),
(20, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'cancelled', 1, '2026-02-18 05:39:03', NULL, NULL, '2026-02-18 05:39:03', '2026-02-18 06:08:45'),
(21, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 06:08:46', '2026-02-18 06:09:36', '2026-02-18 08:54:16', '2026-02-18 06:08:46', '2026-02-18 08:54:16'),
(22, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 08:55:47', '2026-02-18 08:55:51', '2026-02-18 08:58:06', '2026-02-18 08:55:47', '2026-02-18 08:58:06'),
(23, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 08:58:21', '2026-02-18 08:58:24', '2026-02-18 08:58:57', '2026-02-18 08:58:21', '2026-02-18 08:58:57'),
(24, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 09:15:50', '2026-02-18 09:15:52', '2026-02-18 09:16:18', '2026-02-18 09:15:50', '2026-02-18 09:16:18'),
(25, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 09:16:31', '2026-02-18 09:16:47', '2026-02-18 09:16:55', '2026-02-18 09:16:31', '2026-02-18 09:16:55'),
(26, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 09:20:12', '2026-02-18 09:20:15', '2026-02-18 09:20:29', '2026-02-18 09:20:12', '2026-02-18 09:20:29'),
(27, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 09:27:44', '2026-02-18 09:27:48', '2026-02-18 09:29:27', '2026-02-18 09:27:44', '2026-02-18 09:29:27'),
(28, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 09:29:36', '2026-02-18 09:29:39', '2026-02-18 09:30:36', '2026-02-18 09:29:36', '2026-02-18 09:30:36'),
(29, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 09:38:03', '2026-02-18 09:38:05', '2026-02-18 09:38:53', '2026-02-18 09:38:03', '2026-02-18 09:38:53'),
(30, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 09:38:54', '2026-02-18 09:39:00', '2026-02-18 09:39:22', '2026-02-18 09:38:54', '2026-02-18 09:39:22'),
(31, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 09:41:23', '2026-02-18 09:41:27', '2026-02-18 09:42:05', '2026-02-18 09:41:23', '2026-02-18 09:42:05'),
(32, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 09:46:38', '2026-02-18 09:46:42', '2026-02-18 09:47:27', '2026-02-18 09:46:38', '2026-02-18 09:47:27'),
(33, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 10:12:27', '2026-02-18 10:12:33', '2026-02-18 10:13:13', '2026-02-18 10:12:27', '2026-02-18 10:13:13'),
(34, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 10:14:33', '2026-02-18 10:14:39', '2026-02-18 10:15:23', '2026-02-18 10:14:33', '2026-02-18 10:15:23'),
(35, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 10:15:35', '2026-02-18 10:15:39', '2026-02-18 10:15:59', '2026-02-18 10:15:35', '2026-02-18 10:15:59'),
(36, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 10:18:38', '2026-02-18 10:18:44', '2026-02-18 10:19:08', '2026-02-18 10:18:38', '2026-02-18 10:19:08'),
(37, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 10:19:23', '2026-02-18 10:19:31', '2026-02-18 10:20:00', '2026-02-18 10:19:23', '2026-02-18 10:20:00'),
(38, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 10:20:38', '2026-02-18 10:20:44', '2026-02-18 10:22:13', '2026-02-18 10:20:38', '2026-02-18 10:22:13'),
(39, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 10:32:18', '2026-02-18 10:32:20', '2026-02-18 10:33:17', '2026-02-18 10:32:18', '2026-02-18 10:33:17'),
(40, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 10:33:30', '2026-02-18 10:33:32', '2026-02-18 10:34:04', '2026-02-18 10:33:30', '2026-02-18 10:34:04'),
(41, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 10:34:55', '2026-02-18 10:34:57', '2026-02-18 10:35:46', '2026-02-18 10:34:55', '2026-02-18 10:35:46'),
(42, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 10:37:27', '2026-02-18 10:37:29', '2026-02-18 10:39:06', '2026-02-18 10:37:27', '2026-02-18 10:39:06'),
(43, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 10:39:25', '2026-02-18 10:39:53', '2026-02-18 10:40:35', '2026-02-18 10:39:25', '2026-02-18 10:40:35'),
(44, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 10:42:44', '2026-02-18 10:42:47', '2026-02-18 10:43:20', '2026-02-18 10:42:44', '2026-02-18 10:43:20'),
(45, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 10:48:36', '2026-02-18 10:48:39', '2026-02-18 10:50:09', '2026-02-18 10:48:36', '2026-02-18 10:50:09'),
(46, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 10:52:00', '2026-02-18 10:52:04', '2026-02-18 10:53:01', '2026-02-18 10:52:00', '2026-02-18 10:53:01'),
(47, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 11:36:15', '2026-02-18 11:36:45', '2026-02-18 11:37:29', '2026-02-18 11:36:15', '2026-02-18 11:37:29'),
(48, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 11:38:16', '2026-02-18 11:38:47', '2026-02-18 11:39:15', '2026-02-18 11:38:16', '2026-02-18 11:39:15'),
(49, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 11:40:08', '2026-02-18 11:40:12', '2026-02-18 11:41:03', '2026-02-18 11:40:08', '2026-02-18 11:41:03'),
(50, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 11:45:26', '2026-02-18 11:45:31', '2026-02-18 11:46:15', '2026-02-18 11:45:26', '2026-02-18 11:46:15'),
(51, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 11:48:12', '2026-02-18 11:48:15', '2026-02-18 11:48:58', '2026-02-18 11:48:12', '2026-02-18 11:48:58'),
(52, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 11:53:02', '2026-02-18 11:53:08', '2026-02-18 11:54:28', '2026-02-18 11:53:02', '2026-02-18 11:54:28'),
(53, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 11:57:25', '2026-02-18 11:57:31', '2026-02-18 12:00:45', '2026-02-18 11:57:25', '2026-02-18 12:00:45'),
(54, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 12:04:31', '2026-02-18 12:04:34', '2026-02-18 12:05:29', '2026-02-18 12:04:31', '2026-02-18 12:05:29'),
(55, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 12:05:50', '2026-02-18 12:05:58', '2026-02-18 12:06:17', '2026-02-18 12:05:50', '2026-02-18 12:06:17'),
(56, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 12:06:28', '2026-02-18 12:06:33', '2026-02-18 12:06:51', '2026-02-18 12:06:28', '2026-02-18 12:06:51'),
(57, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 12:10:54', '2026-02-18 12:10:59', '2026-02-18 12:11:15', '2026-02-18 12:10:54', '2026-02-18 12:11:15'),
(58, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 12:12:09', '2026-02-18 12:12:13', '2026-02-18 12:13:14', '2026-02-18 12:12:09', '2026-02-18 12:13:14'),
(59, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 12:40:35', '2026-02-18 12:40:40', '2026-02-18 12:43:55', '2026-02-18 12:40:35', '2026-02-18 12:43:55'),
(60, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-18 12:45:56', '2026-02-18 12:45:59', '2026-02-19 04:14:14', '2026-02-18 12:45:56', '2026-02-19 04:14:14'),
(61, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'cancelled', 1, '2026-02-19 04:14:27', NULL, NULL, '2026-02-19 04:14:27', '2026-02-19 04:14:42'),
(62, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-19 04:14:46', '2026-02-19 04:14:50', '2026-02-19 04:16:34', '2026-02-19 04:14:46', '2026-02-19 04:16:34'),
(63, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-19 04:17:09', '2026-02-19 04:17:14', '2026-02-19 04:17:43', '2026-02-19 04:17:09', '2026-02-19 04:17:43'),
(64, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-19 04:18:47', '2026-02-19 04:18:51', '2026-02-19 04:19:51', '2026-02-19 04:18:47', '2026-02-19 04:19:51'),
(65, 4, 'Visitor', '01859385787', 'kali1212hit@gmail.com', 'ended', 1, '2026-02-22 04:36:06', '2026-02-22 04:36:12', '2026-02-22 04:37:29', '2026-02-22 04:36:06', '2026-02-22 04:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `call_sessions`
--

CREATE TABLE `call_sessions` (
  `id` bigint UNSIGNED NOT NULL,
  `channel_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agora_uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `agent_id` bigint UNSIGNED DEFAULT NULL,
  `call_queue_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('ringing','connected','ended') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ringing',
  `started_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ended_at` timestamp NULL DEFAULT NULL,
  `duration` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `call_sessions`
--

INSERT INTO `call_sessions` (`id`, `channel_name`, `agora_uid`, `user_id`, `agent_id`, `call_queue_id`, `status`, `started_at`, `ended_at`, `duration`, `created_at`, `updated_at`) VALUES
(12, 'call_6990288326735_1771055235', NULL, 17, 7, 14, 'ended', '2026-02-14 07:47:15', '2026-02-14 07:47:15', 0, '2026-02-14 07:47:15', '2026-02-14 07:47:15'),
(13, 'call_699028fba1cf6_1771055355', NULL, 4, 7, 16, 'ended', '2026-02-14 07:49:15', '2026-02-14 07:50:50', -95, '2026-02-14 07:49:15', '2026-02-14 07:50:50'),
(14, 'call_699029273b614_1771055399', NULL, 18, 8, 15, 'ringing', '2026-02-14 07:49:59', NULL, 0, '2026-02-14 07:49:59', '2026-02-14 07:49:59'),
(15, 'call_69902964683c6_1771055460', NULL, 4, 7, 17, 'ended', '2026-02-14 07:51:00', '2026-02-14 07:52:20', -80, '2026-02-14 07:51:00', '2026-02-14 07:52:20'),
(16, 'call_69902e67ba00e_1771056743', NULL, 4, 7, 18, 'ended', '2026-02-14 08:12:23', '2026-02-16 11:54:38', -186135, '2026-02-14 08:12:23', '2026-02-16 11:54:38'),
(17, 'call_699410c511115_1771311301', NULL, 4, 7, 19, 'ended', '2026-02-17 06:55:01', '2026-02-17 07:00:31', -331, '2026-02-17 06:55:01', '2026-02-17 07:00:31'),
(18, 'call_699557a08035e_1771394976', NULL, 4, 9, 21, 'ended', '2026-02-18 06:09:36', '2026-02-18 08:54:16', -9880, '2026-02-18 06:09:36', '2026-02-18 08:54:16'),
(19, 'call_69957e972e742_1771404951', NULL, 4, 8, 22, 'ended', '2026-02-18 08:55:51', '2026-02-18 08:58:06', -135, '2026-02-18 08:55:51', '2026-02-18 08:58:06'),
(20, 'call_69957f3073b29_1771405104', NULL, 4, 8, 23, 'ended', '2026-02-18 08:58:24', '2026-02-18 08:58:57', -33, '2026-02-18 08:58:24', '2026-02-18 08:58:57'),
(21, 'call_69958348bcfa9_1771406152', NULL, 4, 8, 24, 'ended', '2026-02-18 09:15:52', '2026-02-18 09:16:18', -26, '2026-02-18 09:15:52', '2026-02-18 09:16:18'),
(22, 'call_6995837f6b7e0_1771406207', NULL, 4, 8, 25, 'ended', '2026-02-18 09:16:47', '2026-02-18 09:16:55', -9, '2026-02-18 09:16:47', '2026-02-18 09:16:55'),
(23, 'call_6995844fd6258_1771406415', NULL, 4, 8, 26, 'ended', '2026-02-18 09:20:15', '2026-02-18 09:20:29', -15, '2026-02-18 09:20:15', '2026-02-18 09:20:29'),
(24, 'call_6995861438a73_1771406868', NULL, 4, 8, 27, 'ended', '2026-02-18 09:27:48', '2026-02-18 09:29:27', -99, '2026-02-18 09:27:48', '2026-02-18 09:29:27'),
(25, 'call_699586830837e_1771406979', NULL, 4, 8, 28, 'ended', '2026-02-18 09:29:39', '2026-02-18 09:30:36', -58, '2026-02-18 09:29:39', '2026-02-18 09:30:36'),
(26, 'call_6995887d8fa72_1771407485', NULL, 4, 8, 29, 'ended', '2026-02-18 09:38:05', '2026-02-18 09:38:53', -48, '2026-02-18 09:38:05', '2026-02-18 09:38:53'),
(27, 'call_699588b436fdd_1771407540', NULL, 4, 8, 30, 'ended', '2026-02-18 09:39:00', '2026-02-18 09:39:22', -23, '2026-02-18 09:39:00', '2026-02-18 09:39:22'),
(28, 'call_6995894739bfc_1771407687', NULL, 4, 8, 31, 'ended', '2026-02-18 09:41:27', '2026-02-18 09:42:05', -38, '2026-02-18 09:41:27', '2026-02-18 09:42:05'),
(29, 'call_69958a82c6102_1771408002', NULL, 4, 8, 32, 'ended', '2026-02-18 09:46:42', '2026-02-18 09:47:27', -45, '2026-02-18 09:46:42', '2026-02-18 09:47:27'),
(30, 'call_69959091b77c1_1771409553', NULL, 4, 8, 33, 'ended', '2026-02-18 10:12:33', '2026-02-18 10:13:13', -40, '2026-02-18 10:12:33', '2026-02-18 10:13:13'),
(31, 'call_6995910fce4c0_1771409679', NULL, 4, 8, 34, 'ended', '2026-02-18 10:14:39', '2026-02-18 10:15:23', -44, '2026-02-18 10:14:39', '2026-02-18 10:15:23'),
(32, 'call_6995914b00768_1771409739', NULL, 4, 8, 35, 'ended', '2026-02-18 10:15:39', '2026-02-18 10:15:59', -21, '2026-02-18 10:15:39', '2026-02-18 10:15:59'),
(33, 'call_699592044af21_1771409924', NULL, 4, 8, 36, 'ended', '2026-02-18 10:18:44', '2026-02-18 10:19:08', -25, '2026-02-18 10:18:44', '2026-02-18 10:19:08'),
(34, 'call_69959233528ad_1771409971', NULL, 4, 8, 37, 'ended', '2026-02-18 10:19:31', '2026-02-18 10:20:00', -29, '2026-02-18 10:19:31', '2026-02-18 10:20:00'),
(35, 'call_6995927c7bccb_1771410044', NULL, 4, 8, 38, 'ended', '2026-02-18 10:20:44', '2026-02-18 10:22:13', -89, '2026-02-18 10:20:44', '2026-02-18 10:22:13'),
(36, 'call_69959534eda58_1771410740', NULL, 4, 8, 39, 'ended', '2026-02-18 10:32:20', '2026-02-18 10:33:17', -58, '2026-02-18 10:32:20', '2026-02-18 10:33:17'),
(37, 'call_6995957cbe4e4_1771410812', NULL, 4, 8, 40, 'ended', '2026-02-18 10:33:32', '2026-02-18 10:34:04', -33, '2026-02-18 10:33:32', '2026-02-18 10:34:04'),
(38, 'call_699595d1ac161_1771410897', NULL, 4, 8, 41, 'ended', '2026-02-18 10:34:57', '2026-02-18 10:35:46', -50, '2026-02-18 10:34:57', '2026-02-18 10:35:46'),
(39, 'call_69959669e9cc3_1771411049', NULL, 4, 8, 42, 'ended', '2026-02-18 10:37:29', '2026-02-18 10:39:06', -97, '2026-02-18 10:37:29', '2026-02-18 10:39:06'),
(40, 'call_699596f928c8f_1771411193', NULL, 4, 8, 43, 'ended', '2026-02-18 10:39:53', '2026-02-18 10:40:35', -43, '2026-02-18 10:39:53', '2026-02-18 10:40:35'),
(41, 'call_699597a7b122e_1771411367', NULL, 4, 8, 44, 'ended', '2026-02-18 10:42:47', '2026-02-18 10:43:20', -34, '2026-02-18 10:42:47', '2026-02-18 10:43:20'),
(42, 'call_69959907a24bd_1771411719', NULL, 4, 8, 45, 'ended', '2026-02-18 10:48:39', '2026-02-18 10:50:09', -90, '2026-02-18 10:48:39', '2026-02-18 10:50:09'),
(43, 'call_699599d4d218b_1771411924', NULL, 4, 8, 46, 'ended', '2026-02-18 10:52:04', '2026-02-18 10:53:01', -57, '2026-02-18 10:52:04', '2026-02-18 10:53:01'),
(44, 'call_6995a44d4c51d_1771414605', NULL, 4, 8, 47, 'ended', '2026-02-18 11:36:45', '2026-02-18 11:37:29', -44, '2026-02-18 11:36:45', '2026-02-18 11:37:29'),
(45, 'call_6995a4c7bd87e_1771414727', NULL, 4, 8, 48, 'ended', '2026-02-18 11:38:47', '2026-02-18 11:39:15', -28, '2026-02-18 11:38:47', '2026-02-18 11:39:15'),
(46, 'call_6995a51cbc9b7_1771414812', NULL, 4, 8, 49, 'ended', '2026-02-18 11:40:12', '2026-02-18 11:41:03', -51, '2026-02-18 11:40:12', '2026-02-18 11:41:03'),
(47, 'call_6995a65b2a59e_1771415131', NULL, 4, 8, 50, 'ended', '2026-02-18 11:45:31', '2026-02-18 11:46:15', -44, '2026-02-18 11:45:31', '2026-02-18 11:46:15'),
(48, 'call_6995a6ff88763_1771415295', NULL, 4, 8, 51, 'ended', '2026-02-18 11:48:15', '2026-02-18 11:48:58', -43, '2026-02-18 11:48:15', '2026-02-18 11:48:58'),
(49, 'call_6995a824f2043_1771415588', NULL, 4, 8, 52, 'ended', '2026-02-18 11:53:09', '2026-02-18 11:54:28', -80, '2026-02-18 11:53:09', '2026-02-18 11:54:28'),
(50, 'call_6995a92bb66d0_1771415851', NULL, 4, 8, 53, 'ended', '2026-02-18 11:57:31', '2026-02-18 12:00:45', -194, '2026-02-18 11:57:31', '2026-02-18 12:00:45'),
(51, 'call_6995aad2cc949_1771416274', NULL, 4, 8, 54, 'ended', '2026-02-18 12:04:34', '2026-02-18 12:05:29', -56, '2026-02-18 12:04:34', '2026-02-18 12:05:29'),
(52, 'call_6995ab266bd01_1771416358', NULL, 4, 8, 55, 'ended', '2026-02-18 12:05:58', '2026-02-18 12:06:17', -19, '2026-02-18 12:05:58', '2026-02-18 12:06:17'),
(53, 'call_6995ab4989d0b_1771416393', NULL, 4, 8, 56, 'ended', '2026-02-18 12:06:33', '2026-02-18 12:06:51', -18, '2026-02-18 12:06:33', '2026-02-18 12:06:51'),
(54, 'call_6995ac530820c_1771416659', NULL, 4, 8, 57, 'ended', '2026-02-18 12:10:59', '2026-02-18 12:11:15', -16, '2026-02-18 12:10:59', '2026-02-18 12:11:15'),
(55, 'call_6995ac9d774c1_1771416733', NULL, 4, 8, 58, 'ended', '2026-02-18 12:12:13', '2026-02-18 12:13:14', -62, '2026-02-18 12:12:13', '2026-02-18 12:13:14'),
(56, 'call_6995b3483c6cc_1771418440', NULL, 4, 8, 59, 'ended', '2026-02-18 12:40:40', '2026-02-18 12:43:55', -196, '2026-02-18 12:40:40', '2026-02-18 12:43:55'),
(57, 'call_6995b487de416_1771418759', NULL, 4, 8, 60, 'ended', '2026-02-18 12:45:59', '2026-02-19 04:14:14', -55696, '2026-02-18 12:45:59', '2026-02-19 04:14:14'),
(58, 'call_69968e3a06bca_1771474490', NULL, 4, 8, 62, 'ended', '2026-02-19 04:14:50', '2026-02-19 04:16:34', -104, '2026-02-19 04:14:50', '2026-02-19 04:16:34'),
(59, 'call_69968ecaaf70f_1771474634', NULL, 4, 8, 63, 'ended', '2026-02-19 04:17:14', '2026-02-19 04:17:43', -29, '2026-02-19 04:17:14', '2026-02-19 04:17:43'),
(60, 'call_69968f2bbaae1_1771474731', NULL, 4, 8, 64, 'ended', '2026-02-19 04:18:51', '2026-02-19 04:19:51', -60, '2026-02-19 04:18:51', '2026-02-19 04:19:51'),
(61, 'call_699a87bc154d2_1771734972', NULL, 4, 8, 65, 'ended', '2026-02-22 04:36:12', '2026-02-22 04:37:29', -77, '2026-02-22 04:36:12', '2026-02-22 04:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `insurance_package_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `claim_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `claim_amount` decimal(12,2) NOT NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('submitted','under_review','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, 'f67b8db4-cad1-48b7-b1b2-eb1dd80fc788', 'redis', 'default', '{\"uuid\":\"f67b8db4-cad1-48b7-b1b2-eb1dd80fc788\",\"displayName\":\"App\\\\Notifications\\\\VisitorRegistered\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Visitor\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:35:\\\"App\\\\Notifications\\\\VisitorRegistered\\\":3:{s:10:\\\"\\u0000*\\u0000visitor\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Visitor\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"\\u0000*\\u0000visit\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Visit\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"00a68a37-73ae-42a9-a0d3-d9e2bf895374\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"},\"createdAt\":1769095333,\"id\":\"L0CEhANtY2S3xIi4atjPcLrgClBIssxT\",\"attempts\":0,\"delay\":null}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\Visitor]. in /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:780\nStack trace:\n#0 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(110): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Queue/SerializesAndRestoresModelIdentifiers.php(63): Illuminate\\Notifications\\Notification->restoreModel()\n#2 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Queue/SerializesModels.php(97): Illuminate\\Notifications\\Notification->getRestoredPropertyValue()\n#3 [internal function]: Illuminate\\Notifications\\Notification->__unserialize()\n#4 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(95): unserialize()\n#5 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(62): Illuminate\\Queue\\CallQueuedHandler->getCommand()\n#6 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call()\n#7 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(485): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(435): Illuminate\\Queue\\Worker->process()\n#9 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(201): Illuminate\\Queue\\Worker->runJob()\n#10 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon()\n#11 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#12 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Container/Util.php(43): Illuminate\\Container\\BoundMethod::{closure:Illuminate\\Container\\BoundMethod::call():35}()\n#14 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure()\n#15 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#16 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Container/Container.php(799): Illuminate\\Container\\BoundMethod::call()\n#17 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Console/Command.php(211): Illuminate\\Container\\Container->call()\n#18 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/symfony/console/Command/Command.php(341): Illuminate\\Console\\Command->execute()\n#19 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Console/Command.php(180): Symfony\\Component\\Console\\Command\\Command->run()\n#20 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/symfony/console/Application.php(1102): Illuminate\\Console\\Command->run()\n#21 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/symfony/console/Application.php(356): Symfony\\Component\\Console\\Application->doRunCommand()\n#22 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/symfony/console/Application.php(195): Symfony\\Component\\Console\\Application->doRun()\n#23 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(198): Symfony\\Component\\Console\\Application->run()\n#24 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle()\n#25 /home/ashraful/Unisoft/VMSUCBL/VMSUCBL/vms-ucbl/artisan(16): Illuminate\\Foundation\\Application->handleCommand()\n#26 {main}', '2026-01-22 16:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_packages`
--

CREATE TABLE `insurance_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `coverage_amount` decimal(12,2) NOT NULL,
  `duration_months` int NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_20_050527_add_two_factor_columns_to_users_table', 1),
(5, '2026_01_20_050539_create_personal_access_tokens_table', 1),
(6, '2026_01_20_101151_create_permission_tables', 1),
(7, '2026_01_21_075910_create_visitors_table', 1),
(8, '2026_01_21_080315_create_visitor_blocks_table', 1),
(9, '2026_01_21_080400_create_visit_types_table', 1),
(10, '2026_01_21_080600_create_visits_table', 1),
(11, '2026_01_21_081745_create_rfids_table', 1),
(12, '2026_01_21_083711_create_visit_logs_table', 1),
(13, '2026_01_21_093741_create_notifications_table', 1),
(14, '2026_01_21_094133_create_visitor__otps_table', 1),
(16, '2026_01_23_120000_add_visit_id_to_rfids_table', 2),
(17, '2026_01_23_185341_update_visit_status_enum_only', 3),
(18, '2026_01_24_000000_add_checkin_checkout_columns_to_visits_table', 4),
(19, '2026_01_22_041040_create_user_infos_table', 5),
(20, '2026_01_22_045605_create_studentloginfroms_table', 5),
(21, '2026_01_27_090741_create_insurance_pacages_table', 5),
(22, '2026_01_27_091027_create_orders_table', 5),
(23, '2026_01_27_091158_create_claims_table', 5),
(24, '2026_02_14_100000_create_video_call_tables', 6),
(25, '2026_02_14_065214_fix_call_queue_status_enum', 7),
(26, '2026_02_18_051300_add_phone_to_users_table', 8),
(27, '2026_02_18_053200_create_video_call_otps_table', 9),
(28, '2026_02_18_120000_create_video_call_chats_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 1),
(7, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 1),
(9, 'App\\Models\\User', 1),
(10, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 2),
(5, 'App\\Models\\User', 2),
(6, 'App\\Models\\User', 2),
(7, 'App\\Models\\User', 2),
(8, 'App\\Models\\User', 2),
(9, 'App\\Models\\User', 2),
(10, 'App\\Models\\User', 2),
(11, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 8),
(4, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(4, 'App\\Models\\User', 11),
(4, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(4, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 16),
(4, 'App\\Models\\User', 17),
(4, 'App\\Models\\User', 18);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `visit_id` bigint UNSIGNED NOT NULL,
  `channel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `insurance_package_id` bigint UNSIGNED NOT NULL,
  `policy_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','active','expired','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view visitors', 'web', '2026-01-22 19:15:03', '2026-01-22 19:15:03'),
(2, 'create visitors', 'web', '2026-01-22 19:15:03', '2026-01-22 19:15:03'),
(3, 'edit visitors', 'web', '2026-01-22 19:15:03', '2026-01-22 19:15:03'),
(4, 'delete visitors', 'web', '2026-01-22 19:15:03', '2026-01-22 19:15:03'),
(5, 'create visit', 'web', '2026-01-23 18:54:52', '2026-01-23 18:54:52'),
(6, 'verify visit otp', 'web', '2026-01-23 18:54:52', '2026-01-23 18:54:52'),
(7, 'approve visit', 'web', '2026-01-23 18:54:52', '2026-01-23 18:54:52'),
(8, 'reject visit', 'web', '2026-01-23 18:54:52', '2026-01-23 18:54:52'),
(9, 'checkin visit', 'web', '2026-01-23 18:54:52', '2026-01-23 18:54:52'),
(10, 'checkout visit', 'web', '2026-01-23 18:54:52', '2026-01-23 18:54:52'),
(11, 'view live dashboard', 'web', '2026-01-23 18:54:52', '2026-01-23 18:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rfids`
--

CREATE TABLE `rfids` (
  `id` bigint UNSIGNED NOT NULL,
  `tag_uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `assigned_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `visit_id` bigint UNSIGNED DEFAULT NULL,
  `generated_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2026-01-22 04:47:18', '2026-01-22 04:47:18'),
(2, 'staff', 'web', '2026-01-22 04:47:18', '2026-01-22 04:47:18'),
(3, 'receptionist', 'web', '2026-01-22 04:47:18', '2026-01-22 04:47:18'),
(4, 'visitor', 'web', '2026-01-22 04:47:18', '2026-01-22 04:47:18'),
(5, 'Manager', 'web', '2026-01-22 08:32:57', '2026-01-22 08:32:57'),
(12, 'play', 'web', '2026-01-22 08:54:36', '2026-01-22 08:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(1, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(1, 3),
(5, 3),
(6, 3),
(9, 3),
(10, 3),
(11, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4sNcZ0sgF79KLz9M9N2nVcQTvG5aJJSgxSv2pv0q', 3, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMFk0YzRYTWtzM1JMMGc1cXFoSlJlYmlqZHh0a2lPNFJCUDRzWGljWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjtzOjU6InJvdXRlIjtzOjc6InByb2ZpbGUiO31zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1769078417),
('gTo8Jzn1r6YmgbTdVdRCFv3aDgCJLyEVZDWn4djk', 3, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTFhaUmxlNEtBekFPd3d4cnpNNGk1cldpVTJzc0lra0dIVGVScnpMeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1769070951);

-- --------------------------------------------------------

--
-- Table structure for table `studentloginfroms`
--

CREATE TABLE `studentloginfroms` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Receptionist', 'ashrafulinstasure@gmail.com', NULL, NULL, '$2y$12$iGysvL.hNGbGlCzB8z/uHOHSRB/yIXeaJgfGzFtmXb8ipZXU3x3/K', NULL, NULL, NULL, 'g0J2rx860U1g4Euk8Zg4LSs7ELVR5vmo7OpdVT7vP3LqKZdKYdP8W2ZMeDmI', NULL, NULL, '2026-01-22 03:50:39', '2026-01-22 03:50:39'),
(2, 'Staff', 'ashrafulunisoft@gmail.com', NULL, NULL, '$2y$12$cYI2OLGJ7cLuNJkz1tLYIO8l6e4UGO2BLjdZUK9NJCqFVSGvq1d.u', NULL, NULL, NULL, '1VR5RfTHCJuJoXAQxGZbUdX0lyRD5XI8v4yXYMSY7CTT0GnYQenp5OrdxDw4', NULL, NULL, '2026-01-22 03:50:39', '2026-01-22 07:25:39'),
(3, 'Admin', 'amshuvo64@gmail.com', NULL, NULL, '$2y$12$iGysvL.hNGbGlCzB8z/uHOHSRB/yIXeaJgfGzFtmXb8ipZXU3x3/K', NULL, NULL, NULL, 'wp5qQMozFBJwz2TTgbHgKfWFNvEbYSXfSGPgmWhaTbH6owv0XRmBv5OImGWm', NULL, NULL, '2026-01-22 03:50:39', '2026-01-22 03:50:39'),
(4, 'Visitor', 'kali1212hit@gmail.com', '01859385787', NULL, '$2y$12$iGysvL.hNGbGlCzB8z/uHOHSRB/yIXeaJgfGzFtmXb8ipZXU3x3/K', NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-22 03:50:39', '2026-01-22 03:50:39'),
(7, 'Customer Care Agent', 'staff@test.com', NULL, NULL, '$2y$12$YN7hIcj7JF6S4JCC16J8a.DKLMHMaYRB.DE3QUPOFdO4lhuavu3Tm', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-14 06:53:11', '2026-02-14 06:53:11'),
(8, 'Test Customer', 'customer@test.com', NULL, NULL, '$2y$12$7oQloK8EolDtafacqwPvVugKAfLUoxJoglksmk1WXvvrg6qI/pJjW', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-14 06:53:11', '2026-02-14 06:53:11'),
(9, 'Second Customer', 'customer2@test.com', NULL, NULL, '$2y$12$cvOYX6hGT6TNc5jzKN1qAOSLrzJ3cAKle95is3/iEVQCwJrNjp1pm', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-14 06:53:15', '2026-02-14 06:53:15'),
(12, 'Second Visitor', 'visitor2@example.com', NULL, NULL, '$2y$12$lMTdCVX4zPCXjpBzPSDY8uHtU9rAfT0wCSJbSeoMyPovy1YTs3kqy', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-14 07:43:45', '2026-02-14 07:43:45'),
(16, 'Test Staff Agent', 'teststaff_1771055233@example.com', NULL, NULL, '$2y$12$BCqGRH0qGfr7Mm2AOLt/gO9qZsWcCu8AiAFhOE2ENAVDZHuCzT1Eu', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-14 07:47:14', '2026-02-14 07:47:14'),
(17, 'Test Visitor Customer', 'testvisitor_1771055233@example.com', NULL, NULL, '$2y$12$sF.w1qeasfSsqiuJnJIRoey9B0vBQ9aWDt2NQiGQy6Ng/H4pP8/hK', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-14 07:47:14', '2026-02-14 07:47:14'),
(18, 'Second Visitor', 'visitor2_1771055233@example.com', NULL, NULL, '$2y$12$jaq1oIB96oD/C9INU66UTeZbhJV38EOhqikI6iRg4TYG/vN8iEppC', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-14 07:47:15', '2026-02-14 07:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_infos`
--

CREATE TABLE `user_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `first name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_call_chats`
--

CREATE TABLE `video_call_chats` (
  `id` bigint UNSIGNED NOT NULL,
  `call_session_id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `sender_type` enum('customer','agent') COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_call_chats`
--

INSERT INTO `video_call_chats` (`id`, `call_session_id`, `sender_id`, `sender_type`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 44, 1, 'agent', 'Hello', 1, '2026-02-18 11:36:54', '2026-02-18 11:36:55'),
(2, 44, 4, 'customer', 'hii', 1, '2026-02-18 11:37:01', '2026-02-18 11:37:02'),
(3, 45, 4, 'customer', 'hello', 1, '2026-02-18 11:38:58', '2026-02-18 11:38:59'),
(4, 45, 1, 'agent', 'it\'s working', 1, '2026-02-18 11:39:05', '2026-02-18 11:39:05'),
(5, 45, 4, 'customer', '16277', 1, '2026-02-18 11:39:10', '2026-02-18 11:39:11'),
(6, 47, 1, 'agent', 'hlw', 1, '2026-02-18 11:45:41', '2026-02-18 11:45:41'),
(7, 48, 4, 'customer', 'hello', 1, '2026-02-18 11:48:29', '2026-02-18 11:48:30'),
(8, 49, 4, 'customer', 'hello', 1, '2026-02-18 11:53:55', '2026-02-18 11:53:56'),
(9, 50, 4, 'customer', 'hello4', 1, '2026-02-18 11:57:42', '2026-02-18 11:57:42'),
(10, 51, 4, 'customer', 'hello', 1, '2026-02-18 12:04:47', '2026-02-18 12:04:48'),
(11, 56, 4, 'customer', 'hello', 1, '2026-02-18 12:42:02', '2026-02-18 12:42:03'),
(12, 58, 4, 'customer', 'hello', 1, '2026-02-19 04:15:58', '2026-02-19 04:15:59'),
(13, 58, 1, 'agent', 'tyytyt', 1, '2026-02-19 04:16:08', '2026-02-19 04:16:09'),
(14, 61, 4, 'customer', 'hello', 1, '2026-02-22 04:36:57', '2026-02-22 04:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `video_call_otps`
--

CREATE TABLE `video_call_otps` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `otp_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel` enum('email','sms','both') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sms',
  `expires_at` timestamp NOT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `attempts` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_call_otps`
--

INSERT INTO `video_call_otps` (`id`, `user_id`, `otp_hash`, `channel`, `expires_at`, `verified_at`, `attempts`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 4, 'a5ab7e91294de0cc92380abb3edd15e0c915771e0401b1cdcf02390b43da67ba', 'sms', '2026-02-18 05:48:19', '2026-02-18 05:38:33', 0, 0, '2026-02-18 05:38:19', '2026-02-18 05:38:33'),
(2, 4, '9416765759ca684ff5ec588d030f6f76d99e0120f63f51256987d691855af082', 'sms', '2026-02-18 06:43:30', '2026-02-18 06:33:54', 0, 0, '2026-02-18 06:33:30', '2026-02-18 06:33:54'),
(3, 4, 'fcb89439f685621515968d4315ac5290ea612e5d8f4cd290aa689d10f1ccaef6', 'sms', '2026-02-18 06:58:05', '2026-02-18 06:48:17', 0, 0, '2026-02-18 06:48:05', '2026-02-18 06:48:17'),
(4, 4, '553887630f834843d3771abd5b348544d8634377a6bcb422eb6df057e96e20b5', 'sms', '2026-02-18 07:18:08', NULL, 0, 0, '2026-02-18 07:08:08', '2026-02-18 07:08:47'),
(5, 4, '810198b0fcf9d1045f1f803a896173b55b042dad416aaa3e2618bfab4d951d6d', 'sms', '2026-02-18 07:18:47', '2026-02-18 07:08:59', 0, 0, '2026-02-18 07:08:47', '2026-02-18 07:08:59'),
(6, 4, '11fceb0b9aa776552117f214bec765cfe2e0d9bd30996fe043803d64fed047a1', 'sms', '2026-02-18 07:19:42', NULL, 0, 0, '2026-02-18 07:09:42', '2026-02-18 07:09:52'),
(7, 4, '7a6d8ef275bff9ce63bf75e034a71d685533b1c7a2d1265e29d832be0e32340d', 'sms', '2026-02-18 07:19:52', '2026-02-18 07:10:14', 0, 0, '2026-02-18 07:09:52', '2026-02-18 07:10:14'),
(8, 4, '50e8c7645ee939ef3fa4f811611f42a600f3fa9a4d04506473739191fdf10451', 'sms', '2026-02-18 08:25:18', '2026-02-18 08:15:36', 0, 0, '2026-02-18 08:15:18', '2026-02-18 08:15:36'),
(9, 4, '7fea288781d8217619442688c7aa582de55ba67ce8172bcd01b9bb9ebf119af2', 'sms', '2026-02-18 09:02:43', '2026-02-18 08:52:59', 0, 0, '2026-02-18 08:52:43', '2026-02-18 08:52:59'),
(10, 4, 'fc1213c8f132456b92b05f9728a7ab87470c5184f042a7eebff27e0dd9a69874', 'sms', '2026-02-18 09:37:25', '2026-02-18 09:27:42', 0, 0, '2026-02-18 09:27:25', '2026-02-18 09:27:42'),
(11, 4, 'c5ea50ae5e3fda69a09e76c77c3a9b977db61804b4f4bca4c651d42410754b38', 'sms', '2026-02-18 10:24:13', '2026-02-18 10:14:31', 0, 0, '2026-02-18 10:14:13', '2026-02-18 10:14:31'),
(12, 4, 'd4a23d53dcbfeeda639f6c38063f1a62535d7d703468dab717bf4d1399546c95', 'sms', '2026-02-18 10:47:12', '2026-02-18 10:37:25', 0, 0, '2026-02-18 10:37:12', '2026-02-18 10:37:25'),
(13, 4, '458f1593341bfff85bd0292c44b89b4d5e1bf205ca9c0eef99e2bef376220715', 'sms', '2026-02-18 10:52:26', '2026-02-18 10:42:42', 0, 0, '2026-02-18 10:42:26', '2026-02-18 10:42:42'),
(14, 4, 'bf79f35a05e1ea318ebb5317f1cbf55d0b1c86cb33ba22042e576c098888cf57', 'sms', '2026-02-18 10:58:15', '2026-02-18 10:48:33', 0, 0, '2026-02-18 10:48:15', '2026-02-18 10:48:33'),
(15, 4, '9e839c2d3df609e93f483524aa9da3d3f91c4860de21e95e98d23315b96025dd', 'sms', '2026-02-18 12:07:08', '2026-02-18 11:57:23', 0, 0, '2026-02-18 11:57:08', '2026-02-18 11:57:23'),
(16, 4, '074af09ab9182f2d406324bd0b761b3df214f85569316d56cc39925d55ce0869', 'sms', '2026-02-18 12:21:44', '2026-02-18 12:12:07', 0, 0, '2026-02-18 12:11:44', '2026-02-18 12:12:07'),
(17, 4, 'eee1818700349599a8b996e41b0225cd0c581060c67fda9f23c33023b2c244a0', 'sms', '2026-02-18 12:54:19', NULL, 0, 0, '2026-02-18 12:44:19', '2026-02-18 12:44:20'),
(18, 4, '8157bb54d84a6ca415ca9ade4d70ae7891ee393d259e11df99f61a2428921fbb', 'sms', '2026-02-18 12:54:20', NULL, 1, 0, '2026-02-18 12:44:20', '2026-02-18 12:45:34'),
(19, 4, 'd888f91c9fbae5acc16bf1f0ed76d63c67597a7782b8e2b4bcf1bf4f21248caa', 'sms', '2026-02-18 12:55:34', '2026-02-18 12:45:53', 0, 0, '2026-02-18 12:45:34', '2026-02-18 12:45:53'),
(20, 4, 'e38a3c82e365ba8194982751cdb5bfee96612aa1f31759f7bb4e0ff4e80f46bc', 'sms', '2026-02-19 04:23:31', '2026-02-19 04:14:00', 0, 0, '2026-02-19 04:13:31', '2026-02-19 04:14:00'),
(21, 4, '9c0dc7201a3dc8fe991599e81c32a1dc4c4d623f59ff8127b35fe2ef140c8b76', 'sms', '2026-02-22 04:45:45', '2026-02-22 04:36:03', 0, 0, '2026-02-22 04:35:45', '2026-02-22 04:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `name`, `phone`, `email`, `address`, `is_blocked`, `created_at`, `updated_at`, `deleted_at`) VALUES
(24, 'Kessie Davis', '+1 (837) 683-2037', 'geluwe@mailinator.com', 'Flores and Foreman Trading', 0, '2026-01-23 10:38:11', '2026-01-23 10:38:11', NULL),
(25, 'ashraful', '01859385787', 'ashrafulunisoft@gmail.com', 'Flores and Foreman Trading', 0, '2026-01-23 10:40:51', '2026-01-23 10:40:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visitor_blocks`
--

CREATE TABLE `visitor_blocks` (
  `id` bigint UNSIGNED NOT NULL,
  `visitor_id` bigint UNSIGNED NOT NULL,
  `block_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `blocked_by` bigint UNSIGNED NOT NULL,
  `blocked_at` timestamp NOT NULL,
  `unblocked_by` bigint UNSIGNED DEFAULT NULL,
  `unblocked_at` timestamp NULL DEFAULT NULL,
  `status` enum('blocked','unblocked') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'blocked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitor__otps`
--

CREATE TABLE `visitor__otps` (
  `id` bigint UNSIGNED NOT NULL,
  `visitor_id` bigint UNSIGNED NOT NULL,
  `otp_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel` enum('email','sms','both') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'both',
  `expires_at` timestamp NOT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `attempts` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` bigint UNSIGNED NOT NULL,
  `visitor_id` bigint UNSIGNED NOT NULL,
  `meeting_user_id` bigint UNSIGNED NOT NULL,
  `visit_type_id` bigint UNSIGNED NOT NULL,
  `purpose` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_time` datetime NOT NULL,
  `otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_verified_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending_otp','pending_host','approved','rejected','checked_in','completed','pending','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rfid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `checkin_time` timestamp NULL DEFAULT NULL,
  `checkout_time` timestamp NULL DEFAULT NULL,
  `rejected_reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `visitor_id`, `meeting_user_id`, `visit_type_id`, `purpose`, `schedule_time`, `otp`, `otp_verified_at`, `status`, `rfid`, `approved_at`, `checkin_time`, `checkout_time`, `rejected_reason`, `created_at`, `updated_at`) VALUES
(26, 24, 1, 2, 'Rerum quia laboriosa', '2026-01-23 00:00:00', NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2026-01-23 10:38:11', '2026-01-23 10:38:11'),
(27, 25, 2, 2, 'Metting', '2026-01-23 00:00:00', NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2026-01-23 10:40:51', '2026-01-23 10:40:51'),
(28, 25, 2, 1, 'meeting', '2026-01-23 00:00:00', NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2026-01-23 10:49:31', '2026-01-23 10:49:31'),
(29, 25, 2, 2, 'urgent', '2026-01-23 00:00:00', NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2026-01-23 10:55:04', '2026-01-23 10:55:04'),
(30, 25, 2, 2, 'urgent', '2026-01-23 00:00:00', NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2026-01-23 11:02:32', '2026-01-23 11:02:32'),
(31, 25, 2, 1, 'urgent', '2026-01-23 00:00:00', NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2026-01-23 12:54:17', '2026-01-23 12:54:17'),
(32, 25, 2, 1, 'urgent', '2026-01-23 00:00:00', NULL, NULL, 'pending_otp', NULL, NULL, NULL, NULL, NULL, '2026-01-23 19:18:36', '2026-01-23 19:18:36'),
(33, 25, 2, 1, 'urgent', '2026-01-23 00:00:00', NULL, NULL, 'pending_otp', NULL, NULL, NULL, NULL, NULL, '2026-01-23 19:22:26', '2026-01-23 19:22:26'),
(34, 25, 2, 1, 'urgent', '2026-01-23 00:00:00', NULL, NULL, 'pending_otp', NULL, NULL, NULL, NULL, NULL, '2026-01-23 19:26:04', '2026-01-23 19:26:04'),
(35, 25, 2, 1, 'urgent', '2026-01-23 00:00:00', NULL, '2026-01-23 19:31:21', 'pending', NULL, NULL, NULL, NULL, NULL, '2026-01-23 19:30:55', '2026-01-23 19:31:21'),
(36, 25, 2, 1, 'urgent', '2026-01-23 00:00:00', NULL, '2026-01-23 19:41:56', 'approved', 'RFID-HWFDAAHX', '2026-01-23 19:43:37', NULL, NULL, NULL, '2026-01-23 19:41:30', '2026-01-23 19:43:37'),
(37, 25, 2, 1, 'urgent', '2026-01-23 00:00:00', NULL, '2026-01-23 19:49:15', 'completed', 'RFID-TUKXPKMR', '2026-01-23 19:49:33', '2026-01-23 20:10:19', '2026-01-23 20:10:31', NULL, '2026-01-23 19:48:54', '2026-01-23 20:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `visit_logs`
--

CREATE TABLE `visit_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `visit_id` bigint UNSIGNED NOT NULL,
  `rfid_id` bigint UNSIGNED NOT NULL,
  `checkin_time` timestamp NULL DEFAULT NULL,
  `checkout_time` timestamp NULL DEFAULT NULL,
  `total_minutes` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visit_types`
--

CREATE TABLE `visit_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visit_types`
--

INSERT INTO `visit_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Meeting', NULL, NULL),
(2, 'Interview', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agents_email_unique` (`email`),
  ADD KEY `agents_user_id_foreign` (`user_id`);

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
-- Indexes for table `call_feedback`
--
ALTER TABLE `call_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `call_feedback_call_session_id_foreign` (`call_session_id`),
  ADD KEY `call_feedback_user_id_foreign` (`user_id`),
  ADD KEY `call_feedback_agent_id_foreign` (`agent_id`);

--
-- Indexes for table `call_metrics`
--
ALTER TABLE `call_metrics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `call_queue`
--
ALTER TABLE `call_queue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `call_queue_user_id_foreign` (`user_id`);

--
-- Indexes for table `call_sessions`
--
ALTER TABLE `call_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `call_sessions_channel_name_unique` (`channel_name`),
  ADD KEY `call_sessions_user_id_foreign` (`user_id`),
  ADD KEY `call_sessions_agent_id_foreign` (`agent_id`),
  ADD KEY `call_sessions_call_queue_id_foreign` (`call_queue_id`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `claims_claim_number_unique` (`claim_number`),
  ADD KEY `claims_user_id_foreign` (`user_id`),
  ADD KEY `claims_insurance_package_id_foreign` (`insurance_package_id`),
  ADD KEY `claims_order_id_foreign` (`order_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `insurance_packages`
--
ALTER TABLE `insurance_packages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_visit_id_foreign` (`visit_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_policy_number_unique` (`policy_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_insurance_package_id_foreign` (`insurance_package_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `rfids`
--
ALTER TABLE `rfids`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rfids_tag_uid_unique` (`tag_uid`),
  ADD KEY `rfids_visit_id_foreign` (`visit_id`),
  ADD KEY `rfids_generated_by_foreign` (`generated_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `studentloginfroms`
--
ALTER TABLE `studentloginfroms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentloginfroms_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_infos`
--
ALTER TABLE `user_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_infos_email_unique` (`email`);

--
-- Indexes for table `video_call_chats`
--
ALTER TABLE `video_call_chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_call_chats_call_session_id_foreign` (`call_session_id`),
  ADD KEY `video_call_chats_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `video_call_otps`
--
ALTER TABLE `video_call_otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_call_otps_user_id_is_active_index` (`user_id`,`is_active`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitors_phone_index` (`phone`),
  ADD KEY `visitors_email_index` (`email`);

--
-- Indexes for table `visitor_blocks`
--
ALTER TABLE `visitor_blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_blocks_visitor_id_foreign` (`visitor_id`),
  ADD KEY `visitor_blocks_blocked_by_foreign` (`blocked_by`),
  ADD KEY `visitor_blocks_unblocked_by_foreign` (`unblocked_by`);

--
-- Indexes for table `visitor__otps`
--
ALTER TABLE `visitor__otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor__otps_visitor_id_is_active_index` (`visitor_id`,`is_active`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visits_visitor_id_foreign` (`visitor_id`),
  ADD KEY `visits_meeting_user_id_foreign` (`meeting_user_id`),
  ADD KEY `visits_visit_type_id_foreign` (`visit_type_id`);

--
-- Indexes for table `visit_logs`
--
ALTER TABLE `visit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_logs_visit_id_foreign` (`visit_id`),
  ADD KEY `visit_logs_rfid_id_foreign` (`rfid_id`);

--
-- Indexes for table `visit_types`
--
ALTER TABLE `visit_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `visit_types_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `call_feedback`
--
ALTER TABLE `call_feedback`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `call_metrics`
--
ALTER TABLE `call_metrics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `call_queue`
--
ALTER TABLE `call_queue`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `call_sessions`
--
ALTER TABLE `call_sessions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `insurance_packages`
--
ALTER TABLE `insurance_packages`
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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rfids`
--
ALTER TABLE `rfids`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `studentloginfroms`
--
ALTER TABLE `studentloginfroms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_infos`
--
ALTER TABLE `user_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_call_chats`
--
ALTER TABLE `video_call_chats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `video_call_otps`
--
ALTER TABLE `video_call_otps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `visitor_blocks`
--
ALTER TABLE `visitor_blocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitor__otps`
--
ALTER TABLE `visitor__otps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `visit_logs`
--
ALTER TABLE `visit_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visit_types`
--
ALTER TABLE `visit_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agents`
--
ALTER TABLE `agents`
  ADD CONSTRAINT `agents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `call_feedback`
--
ALTER TABLE `call_feedback`
  ADD CONSTRAINT `call_feedback_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `call_feedback_call_session_id_foreign` FOREIGN KEY (`call_session_id`) REFERENCES `call_sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `call_feedback_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `call_queue`
--
ALTER TABLE `call_queue`
  ADD CONSTRAINT `call_queue_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `call_sessions`
--
ALTER TABLE `call_sessions`
  ADD CONSTRAINT `call_sessions_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `call_sessions_call_queue_id_foreign` FOREIGN KEY (`call_queue_id`) REFERENCES `call_queue` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `call_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `claims`
--
ALTER TABLE `claims`
  ADD CONSTRAINT `claims_insurance_package_id_foreign` FOREIGN KEY (`insurance_package_id`) REFERENCES `insurance_packages` (`id`),
  ADD CONSTRAINT `claims_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `claims_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_insurance_package_id_foreign` FOREIGN KEY (`insurance_package_id`) REFERENCES `insurance_packages` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rfids`
--
ALTER TABLE `rfids`
  ADD CONSTRAINT `rfids_generated_by_foreign` FOREIGN KEY (`generated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `rfids_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_call_chats`
--
ALTER TABLE `video_call_chats`
  ADD CONSTRAINT `video_call_chats_call_session_id_foreign` FOREIGN KEY (`call_session_id`) REFERENCES `call_sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `video_call_chats_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_call_otps`
--
ALTER TABLE `video_call_otps`
  ADD CONSTRAINT `video_call_otps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visitor_blocks`
--
ALTER TABLE `visitor_blocks`
  ADD CONSTRAINT `visitor_blocks_blocked_by_foreign` FOREIGN KEY (`blocked_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `visitor_blocks_unblocked_by_foreign` FOREIGN KEY (`unblocked_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `visitor_blocks_visitor_id_foreign` FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visitor__otps`
--
ALTER TABLE `visitor__otps`
  ADD CONSTRAINT `visitor__otps_visitor_id_foreign` FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_meeting_user_id_foreign` FOREIGN KEY (`meeting_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `visits_visit_type_id_foreign` FOREIGN KEY (`visit_type_id`) REFERENCES `visit_types` (`id`),
  ADD CONSTRAINT `visits_visitor_id_foreign` FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visit_logs`
--
ALTER TABLE `visit_logs`
  ADD CONSTRAINT `visit_logs_rfid_id_foreign` FOREIGN KEY (`rfid_id`) REFERENCES `rfids` (`id`),
  ADD CONSTRAINT `visit_logs_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
