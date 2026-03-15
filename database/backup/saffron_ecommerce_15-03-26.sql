-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Mar 15, 2026 at 10:50 AM
-- Server version: 8.0.45
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vmsucbl_db_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `label` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `label`, `name`, `phone`, `address`, `city`, `state`, `postal_code`, `is_default`, `created_at`, `updated_at`) VALUES
(2, 2, 'Office', 'Ashraful', '01947713697', 'Shewrapara , Mirpur Dhaka', 'Dhaka', 'kafrul', NULL, 1, '2026-03-12 08:30:23', '2026-03-12 08:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `b2_b_customers`
--

CREATE TABLE `b2_b_customers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trade_license_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'retailer',
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` text COLLATE utf8mb4_unicode_ci,
  `shipping_address` text COLLATE utf8mb4_unicode_ci,
  `credit_limit` decimal(12,2) NOT NULL DEFAULT '0.00',
  `current_balance` decimal(12,2) NOT NULL DEFAULT '0.00',
  `payment_terms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash_on_delivery',
  `payment_days` int NOT NULL DEFAULT '0',
  `pricing_tier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'standard',
  `wholesale_discount` decimal(5,2) NOT NULL DEFAULT '0.00',
  `approval_status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `rejection_reason` text COLLATE utf8mb4_unicode_ci,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_bn` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt_en` text COLLATE utf8mb4_unicode_ci,
  `excerpt_bn` text COLLATE utf8mb4_unicode_ci,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','published','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `session_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(14, NULL, 'ZPtc3RSDLg78jjO2eucFcZi6Fn7bImfrLQwYrfDb', 2, 1, '2026-03-15 07:21:52', '2026-03-15 07:21:52'),
(26, NULL, 'kP935sq399WL24QGvlOhROqJgPLIAaVZnkZdVl5y', 52, 1, '2026-03-15 10:05:28', '2026-03-15 10:05:28'),
(28, 2, NULL, 86, 1, '2026-03-15 10:38:25', '2026-03-15 10:38:25'),
(29, 2, NULL, 104, 1, '2026-03-15 10:40:27', '2026-03-15 10:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_bn` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_en`, `name_bn`, `description_en`, `description_bn`, `slug`, `parent_id`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'Breads', 'রুটি', 'Fresh breads for your daily needs', 'আপনার দৈনন্দিন প্রয়োজনের জন্য তাজা রুটি', 'breads', NULL, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(4, 'Cakes', 'কেক', 'Delicious cakes for every occasion', 'প্রতিটি অনুষ্ঠানের জন্য সুস্বাদু কেক', 'cakes', NULL, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(5, 'Cookies & Biscuits', 'কুকি / বিস্কুট', 'Crispy cookies and biscuits', 'খাস্তা কুকি এবং বিস্কুট', 'cookies-biscuits', NULL, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(6, 'Traditional Sweets', 'ঐতিহ্যবাহী মিষ্টি', 'Authentic Bengali sweets', 'খাঁটি বাঙালি মিষ্টি', 'traditional-sweets', NULL, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(7, 'Dairy Products', 'দুগ্ধজাত', 'Fresh dairy products', 'তাজা দুগ্ধজাত পণ্য', 'dairy-products', NULL, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(8, 'Buns & Rolls', 'বান / রোল', 'Fresh buns and rolls', 'তাজা বান এবং রোল', 'buns-rolls', NULL, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(9, 'Pastries & Savories', 'পেস্ট্রি / নোন-ভেজ ফুড', 'Savory pastries and snacks', 'নোন-ভেজ পেস্ট্রি এবং স্ন্যাকস', 'pastries-savories', NULL, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('percent','fixed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `max_discount` decimal(10,2) DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `usage_limit` int DEFAULT NULL,
  `usage_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(15, '2026_01_22_041040_create_user_infos_table', 1),
(16, '2026_01_22_045605_create_studentloginfroms_table', 1),
(17, '2026_01_23_120000_add_visit_id_to_rfids_table', 1),
(18, '2026_01_23_185341_update_visit_status_enum_only', 1),
(19, '2026_01_24_000000_add_checkin_checkout_columns_to_visits_table', 1),
(20, '2026_03_10_100001_create_categories_table', 1),
(21, '2026_03_10_100002_create_products_table', 1),
(22, '2026_03_10_100003_create_product_images_table', 1),
(23, '2026_03_10_100004_create_tags_table', 1),
(24, '2026_03_10_100005_create_product_tag_table', 1),
(25, '2026_03_10_100006_create_carts_table', 1),
(26, '2026_03_10_100007_create_orders_table', 1),
(27, '2026_03_10_100008_create_order_items_table', 2),
(28, '2026_03_10_100009_create_coupons_table', 2),
(29, '2026_03_10_100010_create_reviews_table', 2),
(30, '2026_03_10_100011_create_point_transactions_table', 2),
(31, '2026_03_11_055333_rename_product_orders_to_orders_table', 3),
(32, '2026_03_11_080351_add_is_approved_to_reviews_table', 4),
(33, '2026_03_11_081935_add_coupon_tracking_fields', 5),
(34, '2026_03_11_090839_add_banned_to_users_table', 6),
(35, '2026_03_11_091614_create_b2_b_customers_table', 7),
(36, '2026_03_11_091755_add_b2b_fields_to_orders_table', 7),
(37, '2026_03_11_162735_create_blog_posts_table', 8),
(38, '2026_03_12_072651_create_addresses_table', 9),
(39, '2026_03_12_081141_add_customer_fields_to_users_table', 10),
(40, '2026_03_12_092937_add_description_to_categories_table', 11),
(41, '2026_03_15_054032_add_session_id_to_carts_table', 12),
(42, '2026_03_15_055054_make_user_id_nullable_in_carts_table', 13),
(43, '2026_03_15_074449_create_wishlists_table', 14),
(44, '2026_03_15_093415_add_transaction_id_to_orders_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `visit_id` bigint UNSIGNED NOT NULL,
  `channel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `b2b_customer_id` bigint UNSIGNED DEFAULT NULL,
  `is_b2b_order` tinyint(1) NOT NULL DEFAULT '0',
  `order_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'retail',
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `final_amount` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coupon_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `b2b_customer_id`, `is_b2b_order`, `order_type`, `order_number`, `transaction_id`, `total_amount`, `discount`, `final_amount`, `status`, `payment_method`, `payment_status`, `shipping_address`, `created_at`, `updated_at`, `coupon_id`) VALUES
(1, 2, NULL, 0, 'retail', 'ORD-69B66F084BEF4', NULL, 280.00, 0.00, 340.00, 'cancelled', 'cod', 'failed', '{\"first_name\":\"Regina\",\"last_name\":\"Armstrong\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Assumenda quia ipsam\",\"city\":\"rajshahi\"}', '2026-03-15 08:34:16', '2026-03-15 09:55:28', NULL),
(2, 2, NULL, 0, 'retail', 'ORD-69B67DE5EFDCE', NULL, 67.50, 0.00, 127.50, 'pending', 'bkash', 'unpaid', '{\"first_name\":\"Uriah\",\"last_name\":\"Hunter\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Mirpur Dhaka\",\"city\":\"chittagong\"}', '2026-03-15 09:37:41', '2026-03-15 09:37:41', NULL),
(3, 2, NULL, 0, 'retail', 'ORD-69B67F063BFE0', NULL, 67.50, 0.00, 127.50, 'pending', 'bkash', 'unpaid', '{\"first_name\":\"Gregory\",\"last_name\":\"Pruitt\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Mirpur DHaka\",\"city\":\"dhaka\"}', '2026-03-15 09:42:30', '2026-03-15 09:42:30', NULL),
(4, 2, NULL, 0, 'retail', 'ORD-69B67FF1E88F3', 'TRAN-69B67FF1ED821-4', 67.50, 0.00, 127.50, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Margaret\",\"last_name\":\"Price\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Sed aliquam asperior\",\"city\":\"rajshahi\"}', '2026-03-15 09:46:25', '2026-03-15 09:46:26', NULL),
(5, 2, NULL, 0, 'retail', 'ORD-69B680881D046', 'TRAN-69B68088221B6-5', 67.50, 0.00, 127.50, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Lev\",\"last_name\":\"Cardenas\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Reprehenderit conse\",\"city\":\"dhaka\"}', '2026-03-15 09:48:56', '2026-03-15 09:48:56', NULL),
(6, 2, NULL, 0, 'retail', 'ORD-69B6819105F8B', 'TRAN-69B681910B553-6', 67.50, 0.00, 127.50, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Megan\",\"last_name\":\"Banks\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Esse amet et non au\",\"city\":\"sylhet\"}', '2026-03-15 09:53:21', '2026-03-15 09:53:21', NULL),
(7, 2, NULL, 0, 'retail', 'ORD-69B681D504FB5', 'TRAN-69B681D50B9F2-7', 67.50, 0.00, 127.50, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Eugenia\",\"last_name\":\"May\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Voluptates duis in q\",\"city\":\"dhaka\"}', '2026-03-15 09:54:29', '2026-03-15 09:54:29', NULL),
(8, 2, NULL, 0, 'retail', 'ORD-69B6834903720', 'TRAN-69B683490894D-8', 67.50, 0.00, 127.50, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Cailin\",\"last_name\":\"Gould\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Dhakar\",\"city\":\"sylhet\"}', '2026-03-15 10:00:41', '2026-03-15 10:00:41', NULL),
(9, 2, NULL, 0, 'retail', 'ORD-69B684AB256FF', 'TRAN-69B684AB2B24E-9', 67.50, 0.00, 127.50, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Julie\",\"last_name\":\"Madden\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Aliqua Quam sequi c\",\"city\":\"dhaka\"}', '2026-03-15 10:06:35', '2026-03-15 10:06:35', NULL),
(10, 2, NULL, 0, 'retail', 'ORD-69B6866BD47B1', 'TRAN-69B6866BDA46F-10', 67.50, 0.00, 127.50, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Briar\",\"last_name\":\"Bates\",\"email\":\"ashrafulinstasure@gmail.com\",\"phone\":\"01947713697\",\"address\":\"Odio excepturi porro\",\"city\":\"dhaka\"}', '2026-03-15 10:14:03', '2026-03-15 10:14:04', NULL),
(11, 2, NULL, 0, 'retail', 'ORD-69B686F0108E4', 'TRAN-69B689B2DC72F-11', 50.00, 0.00, 110.00, 'shipped', 'sslcommerz', 'paid', '{\"first_name\":\"Nolan\",\"last_name\":\"Sosa\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Id eius similique nu\",\"city\":\"sylhet\"}', '2026-03-15 10:16:16', '2026-03-15 10:29:58', NULL),
(12, 2, NULL, 0, 'retail', 'ORD-69B687EEC5264', 'TRAN-69B687EECBA8F-12', 50.00, 0.00, 110.00, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"May\",\"last_name\":\"Jarvis\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Pariatur Commodo re\",\"city\":\"chittagong\"}', '2026-03-15 10:20:30', '2026-03-15 10:20:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 73, 280.00, 1, '2026-03-15 08:34:16', '2026-03-15 08:34:16'),
(2, 2, 100, 67.50, 1, '2026-03-15 09:37:41', '2026-03-15 09:37:41'),
(3, 3, 100, 67.50, 1, '2026-03-15 09:42:30', '2026-03-15 09:42:30'),
(4, 4, 100, 67.50, 1, '2026-03-15 09:46:25', '2026-03-15 09:46:25'),
(5, 5, 100, 67.50, 1, '2026-03-15 09:48:56', '2026-03-15 09:48:56'),
(6, 6, 100, 67.50, 1, '2026-03-15 09:53:21', '2026-03-15 09:53:21'),
(7, 7, 100, 67.50, 1, '2026-03-15 09:54:29', '2026-03-15 09:54:29'),
(8, 8, 100, 67.50, 1, '2026-03-15 10:00:41', '2026-03-15 10:00:41'),
(9, 9, 100, 67.50, 1, '2026-03-15 10:06:35', '2026-03-15 10:06:35'),
(10, 10, 100, 67.50, 1, '2026-03-15 10:14:03', '2026-03-15 10:14:03'),
(11, 11, 86, 50.00, 1, '2026-03-15 10:16:16', '2026-03-15 10:16:16'),
(12, 12, 86, 50.00, 1, '2026-03-15 10:20:30', '2026-03-15 10:20:30');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `point_transactions`
--

CREATE TABLE `point_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `points` int NOT NULL,
  `type` enum('earn','redeem') COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_bn` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `category_id` bigint UNSIGNED NOT NULL,
  `views` int NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name_en`, `name_bn`, `slug`, `description_en`, `description_bn`, `price`, `sale_price`, `stock`, `category_id`, `views`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'BRD-001', 'Premium Milk Bread', 'প্রিমিয়াম মিল্ক ব্রেড / দুধের রুটি', 'premium-milk-bread', 'Delicious Premium Milk Bread. Made with premium ingredients following traditional recipes.', 'সুস্বাদু প্রিমিয়াম মিল্ক ব্রেড / দুধের রুটি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 80.00, NULL, 49, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(3, 'BRD-002', 'Whole Wheat Bread', 'গমের আটার রুটি', 'whole-wheat-bread', 'Delicious Whole Wheat Bread. Made with premium ingredients following traditional recipes.', 'সুস্বাদু গমের আটার রুটি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 90.00, 81.00, 58, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(4, 'BRD-003', 'Brown Bread', 'ব্রাউন ব্রেড / গুড়ের রুটি', 'brown-bread', 'Delicious Brown Bread. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ব্রাউন ব্রেড / গুড়ের রুটি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 85.00, NULL, 20, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(5, 'BRD-004', 'Garlic Bread', 'রসুনের রুটি / রসুন ব্রেড', 'garlic-bread', 'Delicious Garlic Bread. Made with premium ingredients following traditional recipes.', 'সুস্বাদু রসুনের রুটি / রসুন ব্রেড. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 120.00, NULL, 37, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(6, 'BRD-005', 'Dinner Rolls / Buns', 'বান / ডিনার রোল', 'dinner-rolls-buns', 'Delicious Dinner Rolls / Buns. Made with premium ingredients following traditional recipes.', 'সুস্বাদু বান / ডিনার রোল. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 60.00, NULL, 71, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(7, 'BRD-006', 'Fruit Bread', 'ফ্রুট ব্রেড', 'fruit-bread', 'Delicious Fruit Bread. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ফ্রুট ব্রেড. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 100.00, NULL, 51, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(8, 'BRD-007', 'Cheese Bread', 'চিজ ব্রেড', 'cheese-bread', 'Delicious Cheese Bread. Made with premium ingredients following traditional recipes.', 'সুস্বাদু চিজ ব্রেড. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 110.00, NULL, 29, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(9, 'BRD-008', 'Multigrain Bread', 'মাল্টিগ্রেইন ব্রেড / মাল্টিগ্রেইন আটার রুটি', 'multigrain-bread', 'Delicious Multigrain Bread. Made with premium ingredients following traditional recipes.', 'সুস্বাদু মাল্টিগ্রেইন ব্রেড / মাল্টিগ্রেইন আটার রুটি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 130.00, 117.00, 14, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(10, 'BRD-009', 'Butter Bread', 'মাখ্দন রুটি / মাখন রুটি', 'butter-bread', 'Delicious Butter Bread. Made with premium ingredients following traditional recipes.', 'সুস্বাদু মাখ্দন রুটি / মাখন রুটি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 95.00, 85.50, 98, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(11, 'BRD-010', 'Burger Bun', 'বার্গার বান', 'burger-bun', 'Delicious Burger Bun. Made with premium ingredients following traditional recipes.', 'সুস্বাদু বার্গার বান. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 70.00, 63.00, 84, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(12, 'BRD-011', 'Toast Bread', 'টোস্ট রুটি', 'toast-bread', 'Delicious Toast Bread. Made with premium ingredients following traditional recipes.', 'সুস্বাদু টোস্ট রুটি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 75.00, 67.50, 12, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(13, 'BRD-012', 'Bread Loaf', 'রুটির লোফ', 'bread-loaf', 'Delicious Bread Loaf. Made with premium ingredients following traditional recipes.', 'সুস্বাদু রুটির লোফ. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 85.00, 76.50, 34, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(14, 'BRD-013', 'Bread Slices', 'রুটির স্লাইস', 'bread-slices', 'Delicious Bread Slices. Made with premium ingredients following traditional recipes.', 'সুস্বাদু রুটির স্লাইস. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 80.00, NULL, 80, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(15, 'BRD-014', 'Milk Bread (Premium)', 'দুধের পাউরুটি (নরম)', 'milk-bread-premium', 'Delicious Milk Bread (Premium). Made with premium ingredients following traditional recipes.', 'সুস্বাদু দুধের পাউরুটি (নরম). প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 90.00, NULL, 70, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(16, 'CAK-001', 'Vanilla Sponge Cake', 'ভ্যানিলা স্পঞ্জ কেক', 'vanilla-sponge-cake', 'Delicious Vanilla Sponge Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ভ্যানিলা স্পঞ্জ কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 450.00, NULL, 24, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(17, 'CAK-002', 'Chocolate Sponge Cake', 'চকোলেট স্পঞ্জ কেক', 'chocolate-sponge-cake', 'Delicious Chocolate Sponge Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু চকোলেট স্পঞ্জ কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 500.00, NULL, 86, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(18, 'CAK-003', 'Black Forest Cake', 'ব্ল্যাক ফরেস্ট কেক', 'black-forest-cake', 'Delicious Black Forest Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ব্ল্যাক ফরেস্ট কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 650.00, NULL, 11, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(19, 'CAK-004', 'Marble Cake', 'মার্বল কেক / মার্বেল কেক', 'marble-cake', 'Delicious Marble Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু মার্বল কেক / মার্বেল কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 550.00, NULL, 59, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(20, 'CAK-005', 'Pound Cake', 'পাউন্ড কেক', 'pound-cake', 'Delicious Pound Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু পাউন্ড কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 480.00, 432.00, 48, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(21, 'CAK-006', 'Chocolate Truffle Cake', 'চকোলেট ট্রাফল কেক / ট্রাফেল কেক', 'chocolate-truffle-cake', 'Delicious Chocolate Truffle Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু চকোলেট ট্রাফল কেক / ট্রাফেল কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 750.00, NULL, 99, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(22, 'CAK-007', 'Red Velvet Cake', 'রেড ভেলভেট কেক', 'red-velvet-cake', 'Delicious Red Velvet Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু রেড ভেলভেট কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 700.00, 630.00, 81, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(23, 'CAK-008', 'Lemon Pound Cake', 'লেমন পাউন্ড কেক', 'lemon-pound-cake', 'Delicious Lemon Pound Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু লেমন পাউন্ড কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 520.00, 468.00, 84, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(24, 'CAK-009', 'Coffee Cake', 'কফি কেক', 'coffee-cake', 'Delicious Coffee Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু কফি কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 580.00, NULL, 23, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(25, 'CAK-010', 'Eid Special Cake', 'ঈদ স্পেশাল কেক', 'eid-special-cake', 'Delicious Eid Special Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ঈদ স্পেশাল কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 1200.00, NULL, 51, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(26, 'CAK-011', 'Pohela Boishakh Special', 'পহেলা বৈশাখ স্পেশাল', 'pohela-boishakh-special', 'Delicious Pohela Boishakh Special. Made with premium ingredients following traditional recipes.', 'সুস্বাদু পহেলা বৈশাখ স্পেশাল. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 950.00, NULL, 62, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(27, 'CAK-012', 'Birthday Cake - Basic', 'জন্মদিনের কেক - বেসিক', 'birthday-cake-basic', 'Delicious Birthday Cake - Basic. Made with premium ingredients following traditional recipes.', 'সুস্বাদু জন্মদিনের কেক - বেসিক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 850.00, 765.00, 82, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(28, 'CAK-013', 'Wedding Cake - 3 Tier', 'বিয়ের কেক - ৩ স্তর', 'wedding-cake-3-tier', 'Delicious Wedding Cake - 3 Tier. Made with premium ingredients following traditional recipes.', 'সুস্বাদু বিয়ের কেক - ৩ স্তর. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 3500.00, NULL, 67, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(29, 'CAK-014', 'Cream Cake', 'ক্রিম কেক / মালাই কেক', 'cream-cake', 'Delicious Cream Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ক্রিম কেক / মালাই কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 600.00, 540.00, 60, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(30, 'CAK-015', 'Fruit Cake', 'ফ্রুট কেক / ফ্রুট টপিং কেক', 'fruit-cake', 'Delicious Fruit Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ফ্রুট কেক / ফ্রুট টপিং কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 680.00, NULL, 97, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(31, 'CAK-016', 'Anniversary Cake', 'বার্ষিকা কেক / স্মৃতি দিনের কেক', 'anniversary-cake', 'Delicious Anniversary Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু বার্ষিকা কেক / স্মৃতি দিনের কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 1500.00, NULL, 63, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(32, 'CAK-017', 'Heart Shape Cake', 'হার্ট শেপ কেক / ভালোবাসা কেক', 'heart-shape-cake', 'Delicious Heart Shape Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু হার্ট শেপ কেক / ভালোবাসা কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 720.00, NULL, 49, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(33, 'CAK-018', 'Square Shape Cake', 'স্কয়ার শেপ কেক', 'square-shape-cake', 'Delicious Square Shape Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু স্কয়ার শেপ কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 650.00, NULL, 92, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(34, 'CAK-019', 'Round Shape Cake', 'গোলাকার শেপ কেক', 'round-shape-cake', 'Delicious Round Shape Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু গোলাকার শেপ কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 650.00, 585.00, 83, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(35, 'CAK-020', 'Custom Cake', 'কাস্টম কেক / স্পেশাল ডিজাইন কেক', 'custom-cake', 'Delicious Custom Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু কাস্টম কেক / স্পেশাল ডিজাইন কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 2000.00, 1800.00, 87, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(36, 'CAK-021', 'Cartoon Cake', 'কার্টুন কেক', 'cartoon-cake', 'Delicious Cartoon Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু কার্টুন কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 1800.00, 1620.00, 13, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(37, 'CAK-022', 'Photo Cake', 'ফটো কেক / ছবি প্রিন্ট কেক', 'photo-cake', 'Delicious Photo Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ফটো কেক / ছবি প্রিন্ট কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 1600.00, 1440.00, 74, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(38, 'CAK-023', 'Fruit Flavored Cake', 'ফ্রুট ফ্লেভার কেক', 'fruit-flavored-cake', 'Delicious Fruit Flavored Cake. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ফ্রুট ফ্লেভার কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 720.00, NULL, 47, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(39, 'CAK-024', 'Sponge Cake (Generic)', 'স্পঞ্জ কেক / ফোম কেক', 'sponge-cake-generic', 'Delicious Sponge Cake (Generic). Made with premium ingredients following traditional recipes.', 'সুস্বাদু স্পঞ্জ কেক / ফোম কেক. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 420.00, 378.00, 81, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(40, 'CKI-001', 'Butter Cookies', 'মাখনের বিস্কুট / বাটার কুকি', 'butter-cookies', 'Delicious Butter Cookies. Made with premium ingredients following traditional recipes.', 'সুস্বাদু মাখনের বিস্কুট / বাটার কুকি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 120.00, 108.00, 75, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(41, 'CKI-002', 'Chocolate Chip Cookies', 'চকোলেট চিপ কুকি', 'chocolate-chip-cookies', 'Delicious Chocolate Chip Cookies. Made with premium ingredients following traditional recipes.', 'সুস্বাদু চকোলেট চিপ কুকি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 150.00, 135.00, 18, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(42, 'CKI-003', 'Digestive Biscuits', 'ডাইজেস্টিভ বিস্কুট', 'digestive-biscuits', 'Delicious Digestive Biscuits. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ডাইজেস্টিভ বিস্কুট. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 100.00, 90.00, 14, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(43, 'CKI-004', 'Nankhatai', 'নানখাতাই', 'nankhatai', 'Delicious Nankhatai. Made with premium ingredients following traditional recipes.', 'সুস্বাদু নানখাতাই. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 130.00, NULL, 91, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(44, 'CKI-005', 'Cashew Cookies', 'কাজু কুকি / কাজু বাদাম কুকি', 'cashew-cookies', 'Delicious Cashew Cookies. Made with premium ingredients following traditional recipes.', 'সুস্বাদু কাজু কুকি / কাজু বাদাম কুকি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 180.00, 162.00, 27, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(45, 'CKI-006', 'Almond Cookie', 'বাদাম কুকি / বাদাম বিস্কুট', 'almond-cookie', 'Delicious Almond Cookie. Made with premium ingredients following traditional recipes.', 'সুস্বাদু বাদাম কুকি / বাদাম বিস্কুট. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 170.00, NULL, 41, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(46, 'CKI-007', 'Coconut Cookie', 'নারিকেল কুকি / নারকেল বিস্কুট', 'coconut-cookie', 'Delicious Coconut Cookie. Made with premium ingredients following traditional recipes.', 'সুস্বাদু নারিকেল কুকি / নারকেল বিস্কুট. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 140.00, 126.00, 12, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(47, 'CKI-008', 'Oats Cookie', 'ওটস কুকি / ওটস বিস্কুট', 'oats-cookie', 'Delicious Oats Cookie. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ওটস কুকি / ওটস বিস্কুট. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 135.00, 121.50, 25, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(48, 'CKI-009', 'Sugar Cookie', 'চিনি কুকি', 'sugar-cookie', 'Delicious Sugar Cookie. Made with premium ingredients following traditional recipes.', 'সুস্বাদু চিনি কুকি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 110.00, 99.00, 32, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(49, 'CKI-010', 'Cream Biscuit', 'ক্রিম বিস্কুট / মালাই বিস্কুট', 'cream-biscuit', 'Delicious Cream Biscuit. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ক্রিম বিস্কুট / মালাই বিস্কুট. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 125.00, NULL, 99, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(50, 'CKI-011', 'Coconut Biscuit', 'নারিকেল বিস্কুট', 'coconut-biscuit', 'Delicious Coconut Biscuit. Made with premium ingredients following traditional recipes.', 'সুস্বাদু নারিকেল বিস্কুট. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 130.00, NULL, 38, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(51, 'CKI-012', 'Jam Biscuit', 'জাম বিস্কুট / জাম পুরেল', 'jam-biscuit', 'Delicious Jam Biscuit. Made with premium ingredients following traditional recipes.', 'সুস্বাদু জাম বিস্কুট / জাম পুরেল. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 140.00, 126.00, 58, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(52, 'CKI-013', 'Assorted Biscuits', 'মিক্সড বিস্কুট / বিস্কুট প্যাকেট', 'assorted-biscuits', 'Delicious Assorted Biscuits. Made with premium ingredients following traditional recipes.', 'সুস্বাদু মিক্সড বিস্কুট / বিস্কুট প্যাকেট. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 160.00, 144.00, 97, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(53, 'SWT-001', 'Roshogolla (6 pcs)', 'রসগোল্লা (৬ পিস)', 'roshogolla-6-pcs', 'Delicious Roshogolla (6 pcs). Made with premium ingredients following traditional recipes.', 'সুস্বাদু রসগোল্লা (৬ পিস). প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 120.00, NULL, 89, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(54, 'SWT-002', 'Roshogolla (12 pcs)', 'রসগোল্লা (১২ পিস)', 'roshogolla-12-pcs', 'Delicious Roshogolla (12 pcs). Made with premium ingredients following traditional recipes.', 'সুস্বাদু রসগোল্লা (১২ পিস). প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 220.00, NULL, 96, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(55, 'SWT-003', 'Sandesh (10 pcs)', 'সন্দেশ (১০ পিস)', 'sandesh-10-pcs', 'Delicious Sandesh (10 pcs). Made with premium ingredients following traditional recipes.', 'সুস্বাদু সন্দেশ (১০ পিস). প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 180.00, 162.00, 35, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(56, 'SWT-004', 'Sandesh (Cream)', 'ক্রিম সন্দেশ / মালাই সন্দেশ', 'sandesh-cream', 'Delicious Sandesh (Cream). Made with premium ingredients following traditional recipes.', 'সুস্বাদু ক্রিম সন্দেশ / মালাই সন্দেশ. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 220.00, NULL, 51, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(57, 'SWT-005', 'Sandesh (Pistachio)', 'কাজু সন্দেশ / পিস্তাচিও সন্দেশ', 'sandesh-pistachio', 'Delicious Sandesh (Pistachio). Made with premium ingredients following traditional recipes.', 'সুস্বাদু কাজু সন্দেশ / পিস্তাচিও সন্দেশ. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 280.00, NULL, 43, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(58, 'SWT-006', 'Sandesh (Saffron)', 'জাফরান সন্দেশ', 'sandesh-saffron', 'Delicious Sandesh (Saffron). Made with premium ingredients following traditional recipes.', 'সুস্বাদু জাফরান সন্দেশ. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 260.00, 234.00, 26, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(59, 'SWT-007', 'Gulab Jamun (12 pcs)', 'গোলাপ জামুন (১২ পিস)', 'gulab-jamun-12-pcs', 'Delicious Gulab Jamun (12 pcs). Made with premium ingredients following traditional recipes.', 'সুস্বাদু গোলাপ জামুন (১২ পিস). প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 180.00, 162.00, 54, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(60, 'SWT-008', 'Gulab Jamun (Rose)', 'গোলাপ গোলাব জামুন / লাল গোলাব', 'gulab-jamun-rose', 'Delicious Gulab Jamun (Rose). Made with premium ingredients following traditional recipes.', 'সুস্বাদু গোলাপ গোলাব জামুন / লাল গোলাব. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 200.00, NULL, 38, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(61, 'SWT-009', 'Kalo Jam', 'কালো জাম', 'kalo-jam', 'Delicious Kalo Jam. Made with premium ingredients following traditional recipes.', 'সুস্বাদু কালো জাম. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 160.00, 144.00, 25, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(62, 'SWT-010', 'Kalo Jam (24 pcs)', 'কালো জাম (২৪ পিস)', 'kalo-jam-24-pcs', 'Delicious Kalo Jam (24 pcs). Made with premium ingredients following traditional recipes.', 'সুস্বাদু কালো জাম (২৪ পিস). প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 300.00, 270.00, 42, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(63, 'SWT-011', 'Khejur', 'খেজুর', 'khejur', 'Delicious Khejur. Made with premium ingredients following traditional recipes.', 'সুস্বাদু খেজুর. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 180.00, NULL, 39, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(64, 'SWT-012', 'Roshmalai', 'রশমালাই', 'roshmalai', 'Delicious Roshmalai. Made with premium ingredients following traditional recipes.', 'সুস্বাদু রশমালাই. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 220.00, 198.00, 78, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(65, 'SWT-013', 'Mawa', 'মোয়া / মাওয়া', 'mawa', 'Delicious Mawa. Made with premium ingredients following traditional recipes.', 'সুস্বাদু মোয়া / মাওয়া. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 300.00, NULL, 20, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(66, 'SWT-014', 'Shingara', 'শিঙারা / সিংডা', 'shingara', 'Delicious Shingara. Made with premium ingredients following traditional recipes.', 'সুস্বাদু শিঙারা / সিংডা. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 40.00, 36.00, 95, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(67, 'SWT-015', 'Jalebi', 'জিলাপি', 'jalebi', 'Delicious Jalebi. Made with premium ingredients following traditional recipes.', 'সুস্বাদু জিলাপি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 100.00, NULL, 70, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(68, 'SWT-016', 'Jalebi (Thin)', 'চুনা জিলাপি', 'jalebi-thin', 'Delicious Jalebi (Thin). Made with premium ingredients following traditional recipes.', 'সুস্বাদু চুনা জিলাপি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 110.00, NULL, 96, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(69, 'SWT-017', 'Chamcham', 'চমচম', 'chamcham', 'Delicious Chamcham. Made with premium ingredients following traditional recipes.', 'সুস্বাদু চমচম. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 140.00, 126.00, 31, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(70, 'SWT-018', 'Pantua', 'পান্তুয়া', 'pantua', 'Delicious Pantua. Made with premium ingredients following traditional recipes.', 'সুস্বাদু পান্তুয়া. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 150.00, 135.00, 83, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(71, 'SWT-019', 'Laddu', 'লাড্ডু / মোতি লাড্ডু', 'laddu', 'Delicious Laddu. Made with premium ingredients following traditional recipes.', 'সুস্বাদু লাড্ডু / মোতি লাড্ডু. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 200.00, NULL, 25, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(72, 'SWT-020', 'Laddu (Color)', 'রাঙ লাড্ডু', 'laddu-color', 'Delicious Laddu (Color). Made with premium ingredients following traditional recipes.', 'সুস্বাদু রাঙ লাড্ডু. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 220.00, 198.00, 11, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(73, 'SWT-021', 'Barfi', 'বরফি / খোয়া বরফি', 'barfi', 'Delicious Barfi. Made with premium ingredients following traditional recipes.', 'সুস্বাদু বরফি / খোয়া বরফি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 280.00, NULL, 35, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(74, 'SWT-022', 'Payesh', 'পায়েশ / গুড়ের পায়েশ', 'payesh', 'Delicious Payesh. Made with premium ingredients following traditional recipes.', 'সুস্বাদু পায়েশ / গুড়ের পায়েশ. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 350.00, 315.00, 52, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(75, 'SWT-023', 'Kheer', 'খীর', 'kheer', 'Delicious Kheer. Made with premium ingredients following traditional recipes.', 'সুস্বাদু খীর. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 320.00, NULL, 58, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(76, 'SWT-024', 'Rasgulla', 'রাসগুল্লা / পনির সন্দেশ', 'rasgulla', 'Delicious Rasgulla. Made with premium ingredients following traditional recipes.', 'সুস্বাদু রাসগুল্লা / পনির সন্দেশ. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 130.00, NULL, 55, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(77, 'DYR-001', 'Sweet Yogurt (250g)', 'মিষ্টি দই (২৫০ গ্রাম)', 'sweet-yogurt-250g', 'Delicious Sweet Yogurt (250g). Made with premium ingredients following traditional recipes.', 'সুস্বাদু মিষ্টি দই (২৫০ গ্রাম). প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 80.00, 72.00, 25, 7, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(78, 'DYR-002', 'Sweet Yogurt (500g)', 'মিষ্টি দই (৫০০ গ্রাম)', 'sweet-yogurt-500g', 'Delicious Sweet Yogurt (500g). Made with premium ingredients following traditional recipes.', 'সুস্বাদু মিষ্টি দই (৫০০ গ্রাম). প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 150.00, NULL, 30, 7, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(79, 'DYR-003', 'Plain Yogurt (250g)', 'সাদা দই (২৫০ গ্রাম)', 'plain-yogurt-250g', 'Delicious Plain Yogurt (250g). Made with premium ingredients following traditional recipes.', 'সুস্বাদু সাদা দই (২৫০ গ্রাম). প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 70.00, NULL, 40, 7, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(80, 'DYR-004', 'Doi (1kg)', 'দই (১ কেজি)', 'doi-1kg', 'Delicious Doi (1kg). Made with premium ingredients following traditional recipes.', 'সুস্বাদু দই (১ কেজি). প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 280.00, 252.00, 52, 7, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(81, 'DYR-005', 'Pure Ghee (500g)', 'খাঁটি ঘি (৫০০ গ্রাম)', 'pure-ghee-500g', 'Delicious Pure Ghee (500g). Made with premium ingredients following traditional recipes.', 'সুস্বাদু খাঁটি ঘি (৫০০ গ্রাম). প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 650.00, NULL, 52, 7, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(82, 'DYR-006', 'Butter', 'মাখন', 'butter', 'Delicious Butter. Made with premium ingredients following traditional recipes.', 'সুস্বাদু মাখন. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 220.00, 198.00, 91, 7, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(83, 'DYR-007', 'Dairy Creamer', 'দুগ্ধ ক্রিম / ডেইরি ক্রিম', 'dairy-creamer', 'Delicious Dairy Creamer. Made with premium ingredients following traditional recipes.', 'সুস্বাদু দুগ্ধ ক্রিম / ডেইরি ক্রিম. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 180.00, 162.00, 89, 7, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(84, 'BUN-001', 'Cream Bun', 'ক্রিম বান / মালাই বান', 'cream-bun', 'Delicious Cream Bun. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ক্রিম বান / মালাই বান. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 45.00, NULL, 27, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(85, 'BUN-002', 'Cheese Bun', 'পনির বান / সন্দেশ বান', 'cheese-bun', 'Delicious Cheese Bun. Made with premium ingredients following traditional recipes.', 'সুস্বাদু পনির বান / সন্দেশ বান. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 55.00, NULL, 73, 8, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(86, 'BUN-003', 'Chocolate Bun', 'চকলেট বান / কোকো বান', 'chocolate-bun', 'Delicious Chocolate Bun. Made with premium ingredients following traditional recipes.', 'সুস্বাদু চকলেট বান / কোকো বান. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 50.00, NULL, 21, 8, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(87, 'BUN-004', 'Cinnamon Bun', 'দারচিনি বান / ডালচিনি বান', 'cinnamon-bun', 'Delicious Cinnamon Bun. Made with premium ingredients following traditional recipes.', 'সুস্বাদু দারচিনি বান / ডালচিনি বান. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 48.00, NULL, 98, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(88, 'BUN-005', 'Garlic Bun', 'রসুন বান / আলু বান', 'garlic-bun', 'Delicious Garlic Bun. Made with premium ingredients following traditional recipes.', 'সুস্বাদু রসুন বান / আলু বান. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 50.00, 45.00, 80, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(89, 'BUN-006', 'Cheese Roll', 'পনির রোল', 'cheese-roll', 'Delicious Cheese Roll. Made with premium ingredients following traditional recipes.', 'সুস্বাদু পনির রোল. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 60.00, NULL, 62, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(90, 'BUN-007', 'Egg Bun', 'ডিম বান', 'egg-bun', 'Delicious Egg Bun. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ডিম বান. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 42.00, 37.80, 60, 8, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(91, 'BUN-008', 'Hot Dog Bun', 'হট ডগ বান / লং বান', 'hot-dog-bun', 'Delicious Hot Dog Bun. Made with premium ingredients following traditional recipes.', 'সুস্বাদু হট ডগ বান / লং বান. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 40.00, NULL, 26, 8, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(92, 'BUN-009', 'Pastry Bun', 'পেস্ট্রি বান', 'pastry-bun', 'Delicious Pastry Bun. Made with premium ingredients following traditional recipes.', 'সুস্বাদু পেস্ট্রি বান. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 55.00, NULL, 67, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(93, 'BUN-010', 'Fruit Bun', 'ফ্রুট বান', 'fruit-bun', 'Delicious Fruit Bun. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ফ্রুট বান. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 48.00, 43.20, 85, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(94, 'PST-001', 'Puff', 'পাফ / মুরগি পাফ', 'puff', 'Delicious Puff. Made with premium ingredients following traditional recipes.', 'সুস্বাদু পাফ / মুরগি পাফ. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 50.00, NULL, 22, 9, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(95, 'PST-002', 'Meat Puff', 'মাংসের পাফ / পোল্ট্রি পাফ', 'meat-puff', 'Delicious Meat Puff. Made with premium ingredients following traditional recipes.', 'সুস্বাদু মাংসের পাফ / পোল্ট্রি পাফ. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 60.00, NULL, 92, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(96, 'PST-003', 'Vegetable Puff', 'সবজি পাফ / আলুর পাফ', 'vegetable-puff', 'Delicious Vegetable Puff. Made with premium ingredients following traditional recipes.', 'সুস্বাদু সবজি পাফ / আলুর পাফ. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 45.00, NULL, 90, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(97, 'PST-004', 'Cream Roll', 'ক্রিম রোল / মালাই রোল', 'cream-roll', 'Delicious Cream Roll. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ক্রিম রোল / মালাই রোল. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 40.00, 36.00, 78, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(98, 'PST-005', 'Fruit Pastry', 'ফ্রুট পেস্ট্রি', 'fruit-pastry', 'Delicious Fruit Pastry. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ফ্রুট পেস্ট্রি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 65.00, NULL, 33, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(99, 'PST-006', 'Croissant', 'ক্রোইসান / ফ্রেঞ্চ রোল', 'croissant', 'Delicious Croissant. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ক্রোইসান / ফ্রেঞ্চ রোল. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 70.00, 63.00, 62, 9, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(100, 'PST-007', 'Danish Pastry', 'ড্যানিশ পেস্ট্রি / লেয়ার্ড পেস্ট্রি', 'danish-pastry', 'Delicious Danish Pastry. Made with premium ingredients following traditional recipes.', 'সুস্বাদু ড্যানিশ পেস্ট্রি / লেয়ার্ড পেস্ট্রি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 75.00, 67.50, 19, 9, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(101, 'PST-008', 'Sausage Roll', 'সসেজ রোল', 'sausage-roll', 'Delicious Sausage Roll. Made with premium ingredients following traditional recipes.', 'সুস্বাদু সসেজ রোল. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 80.00, NULL, 96, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(102, 'PST-009', 'Chicken Roll', 'চিকেন রোল', 'chicken-roll', 'Delicious Chicken Roll. Made with premium ingredients following traditional recipes.', 'সুস্বাদু চিকেন রোল. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 70.00, NULL, 38, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(103, 'PST-010', 'Pizza Pastry', 'পিৎজা পেস্ট্রি', 'pizza-pastry', 'Delicious Pizza Pastry. Made with premium ingredients following traditional recipes.', 'সুস্বাদু পিৎজা পেস্ট্রি. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 85.00, 76.50, 29, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01'),
(104, 'PST-011', 'Samosa', 'সিংডা / শিঙারা', 'samosa', 'Delicious Samosa. Made with premium ingredients following traditional recipes.', 'সুস্বাদু সিংডা / শিঙারা. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।', 25.00, 22.50, 30, 9, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-12 09:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE `product_tag` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rfids`
--

CREATE TABLE `rfids` (
  `id` bigint UNSIGNED NOT NULL,
  `tag_uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2026-03-11 06:07:36', '2026-03-11 06:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `studentloginfroms`
--

CREATE TABLE `studentloginfroms` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `avatar`, `date_of_birth`, `gender`, `email_verified_at`, `banned`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'amshuvo64@gmail.com', NULL, NULL, NULL, NULL, NULL, 0, '$2y$12$JODAZTqdEu88S/XhnWTjYOPOSX6Z.5vGz8RiUgW3uPW98PM3Hqstu', NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-11 06:07:25', '2026-03-11 06:07:36'),
(2, 'Ashraful', 'ashrafulunisoft@gmail.com', '01859385787', NULL, '1997-10-28', 'male', NULL, 0, '$2y$12$smp24hvozG9pfZf/mvR.2Oayl6v.dHC2ncjhMykspYqK8u9h70wHm', NULL, NULL, NULL, 'RZo9mdArJUVdLLGhuW7ed0a0MzO3djSIwcxjNhWoLVTFjbHUYxK3b9LYZ5qb', NULL, NULL, '2026-03-12 04:40:47', '2026-03-12 08:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_infos`
--

CREATE TABLE `user_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `first name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_blocks`
--

CREATE TABLE `visitor_blocks` (
  `id` bigint UNSIGNED NOT NULL,
  `visitor_id` bigint UNSIGNED NOT NULL,
  `block_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `blocked_by` bigint UNSIGNED NOT NULL,
  `blocked_at` timestamp NOT NULL,
  `unblocked_by` bigint UNSIGNED DEFAULT NULL,
  `unblocked_at` timestamp NULL DEFAULT NULL,
  `status` enum('blocked','unblocked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'blocked',
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
  `otp_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel` enum('email','sms','both') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'both',
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
  `purpose` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_time` datetime NOT NULL,
  `status` enum('pending_otp','pending_host','approved','rejected','checked_in','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending_otp',
  `approved_at` timestamp NULL DEFAULT NULL,
  `checkin_time` timestamp NULL DEFAULT NULL,
  `checkout_time` timestamp NULL DEFAULT NULL,
  `otp_verified_at` timestamp NULL DEFAULT NULL,
  `rfid` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rejected_reason` text COLLATE utf8mb4_unicode_ci,
  `otp` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(12, 2, 104, '2026-03-15 10:39:33', '2026-03-15 10:39:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `b2_b_customers`
--
ALTER TABLE `b2_b_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `b2_b_customers_user_id_foreign` (`user_id`),
  ADD KEY `b2_b_customers_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_posts_slug_unique` (`slug`),
  ADD KEY `blog_posts_user_id_foreign` (`user_id`);

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_session_id_index` (`session_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
  ADD UNIQUE KEY `product_orders_order_number_unique` (`order_number`),
  ADD KEY `product_orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_coupon_id_foreign` (`coupon_id`),
  ADD KEY `orders_b2b_customer_id_foreign` (`b2b_customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

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
-- Indexes for table `point_transactions`
--
ALTER TABLE `point_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `point_transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_tag_product_id_foreign` (`product_id`),
  ADD KEY `product_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

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
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `wishlists_user_id_index` (`user_id`),
  ADD KEY `wishlists_product_id_index` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `b2_b_customers`
--
ALTER TABLE `b2_b_customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `point_transactions`
--
ALTER TABLE `point_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_tag`
--
ALTER TABLE `product_tag`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studentloginfroms`
--
ALTER TABLE `studentloginfroms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_infos`
--
ALTER TABLE `user_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitor_blocks`
--
ALTER TABLE `visitor_blocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitor__otps`
--
ALTER TABLE `visitor__otps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visit_logs`
--
ALTER TABLE `visit_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visit_types`
--
ALTER TABLE `visit_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `b2_b_customers`
--
ALTER TABLE `b2_b_customers`
  ADD CONSTRAINT `b2_b_customers_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `b2_b_customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `orders_b2b_customer_id_foreign` FOREIGN KEY (`b2b_customer_id`) REFERENCES `b2_b_customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `point_transactions`
--
ALTER TABLE `point_transactions`
  ADD CONSTRAINT `point_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
