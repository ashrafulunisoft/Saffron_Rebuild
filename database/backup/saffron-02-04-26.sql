-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Apr 02, 2026 at 06:46 AM
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

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title_en`, `title_bn`, `slug`, `content_en`, `content_bn`, `excerpt_en`, `excerpt_bn`, `featured_image`, `user_id`, `category`, `tags`, `status`, `is_featured`, `meta_title`, `meta_description`, `meta_keywords`, `views`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(22, 'The Art of Custom Cakes for Every Occasion', 'প্রতিটিক কেক তৈরির উপলক্ষে সাজানোর শিল্প', 'the-art-of-custom-cakes', '<h2>Creating Memories, One Cake at a Time</h2><p>At Saffron Sweets & Bakery, we understand that every celebration is unique. That\'s why we specialize in creating custom cakes that are as special as your moments.</p>\n\n<h3>Our Custom Cake Process</h3>\n<ul>\n<li><strong>Consultation:</strong> We meet with you to understand your vision, preferences, and dietary requirements.</li>\n<li><strong>Design:</strong> Our artists sketch custom designs based on your theme, colors, and preferences.</li>\n<li><strong>Crafting:</strong> Expert bakers create your cake using premium ingredients and traditional techniques.</li>\n<li><strong>Delivery:</strong> Fresh delivery to your venue with proper setup and presentation.</li>\n</ul>\n\n<h3>Popular Custom Cake Designs</h3>\n<ul>\n<li>Wedding Cakes - Multi-tier masterpieces</li>\n<li>Birthday Cakes - Age-appropriate designs</li>\n<li>Anniversary Cakes - Elegant and sophisticated</li>\n<li>Themed Cakes - Your favorite characters and motifs</li>\n<li>Photo Cakes - Edible prints of your cherished memories</li>\n</ul>\n\n<h3>Why Choose Our Custom Cakes?</h3>\n<ul>\n<li>Fresh ingredients sourced locally</li>\n<li>Authentic Bengali sweets expertise since 1995</li>\n<li>Customizable flavors - Vanilla, Chocolate, Mango, Rose, and more</li>\n<li>Dietary options available - Sugar-free, eggless, vegan</li>\n<li>Same-day delivery for urgent orders</li>\n</ul>\n\n<p>Contact us at least 3 days before your event to discuss your custom cake requirements.</p>', '<h2>স্মৃতিটিকের জন্য স্মৃতিটিক কেক</h2><p>সাফ্রন সুইটস এন্ড বেকারিতে, আমরা বুঝতি প্রতিটিটি উপলক্ষের কেক তৈরি করতে পারদর্শক। আমাদের দক্ষ পাকিগুলিরা প্রেম উপাদান দিয়ে প্রতিটিটি স্মৃতিটিক কেক তৈরি করে।</p>', 'Discover how we create stunning custom cakes for birthdays, weddings, and special celebrations. Our expert bakers craft each cake with love and precision.', 'জন্মদিন, বিয়ে এবং বিশেষ উপলক্ষের জন্য আমাদের সুন্দর কাস্টম কেক তৈরি করি। আমাদের দক্ষ পাকিগুলিরা প্রতিটিটিটি এবং যত্নতার সাথে প্রতিটিটি কেক তৈরি করে।', 'blog/custom_cake.png', 1, 'Recipe', 'Custom Cakes, Birthday Cakes, Wedding Cakes, Party Cakes', 'published', 0, 'Custom Cakes for Every Occasion - Saffron Sweets & Bakery', 'Order custom cakes for birthdays, weddings, and special occasions. Expert bakers crafting stunning cakes since 1995.', 'Aut consectetur aliq', 21, '2026-03-24 10:53:13', '2026-03-24 10:53:13', '2026-03-31 09:20:58', NULL),
(23, 'Traditional Biscuits & Custom Cookie Creations', 'ঐতিহ্য বিস্কুট এবং কাস্টম কুকি তৈরি', 'traditional-biscuits-custom-cookies', '<h2>The Art of Bengali Biscuits</h2><p>Bengali biscuits are more than just snacks – they\'re a tradition passed down through generations. At Saffron Sweets & Bakery, we keep this tradition alive while adding modern touches.</p>\n\n<h3>Our Signature Biscuits</h3>\n<ul>\n<li><strong>Naan Khatai:</strong> Buttery, cardamom-infused shortbread cookies that melt in your mouth.</li>\n<li><strong>Shakar Para:</strong> Crispy, sugar-coated biscuits perfect with evening tea.</li>\n<li><strong>Kaju Katli Biscuit:</strong> Cashew goodness in biscuit form – a nut lover\'s dream.</li>\n<li><strong>Badam Pista Biscuit:</strong> Almond and pistachio cookies fit for royalty.</li>\n<li><strong>Coconut Biscuit (Narikoor):</strong> Delicate coconut flakes in a crunchy biscuit.</li>\n</ul>\n\n<h3>Custom Cookie Creations</h3>\n<p>Looking for something unique? Our custom cookies include:</p>\n<ul>\n<li><strong>Photo Cookies:</strong> Edible images on cookies for special events</li>\n<li><strong>Logo Cookies:</strong> Branded cookies for corporate gifting</li>\n<li><strong>Message Cookies:</strong> Cookies with custom messages and names</li>\n<li><strong>Themed Cookies:</strong> Holiday and occasion-specific shapes and designs</li>\n</ul>\n\n<h3>Perfect for Gifting</h3>\n<ul>\n<li>Wedding favors - Customized with couple\'s names</li>\n<li>Corporate gifts - Logo-embossed biscuit boxes</li>\n<li>Birthday parties - Age and theme-specific designs</li>\n<li>Festival treats - Durga Puja, Eid, Diwali specialties</li>\n</ul>\n\n<h3>Freshness Guarantee</h3>\n<ul>\n<li>Baked fresh daily in small batches</li>\nli>Premium quality ingredients - no artificial colors or flavors</li>\nli>Traditional recipes preserved since 1995</li>\n<li>Packaging that maintains freshness for weeks</li>\n</ul>\n\n<p>Contact us to discuss your custom biscuit and cookie requirements. Minimum order quantities apply for custom designs.</p>', '<h2>বাংলার বিস্কুটের ঐতিহ্য</h2><p>বাংলার বিস্কুট শুধু একটি স্ন্যাক নয় – এটি প্রজন্ম প্রজন্ম যায। সাফ্রন সুইটস এন্ড বেকারিতে, আমরা এই ঐতিহ্য বাঁচিয় রাখি আর তাজা আধুনিক ছোঁ যোগ করি।</p>', 'Explore our collection of traditional Bengali biscuits and custom cookie creations. From classic Naan Khatai to modern fusion treats, we bake something for everyone.', 'আমাদের ঐতিহ্য বিস্কুট এবং কাস্টম কুকি সংগ্রহ করুন। ক্লাসিক নান খাতা থেকে আধুনিক ফিউশন ট্রিটস - সবার কিছু না আছে।', 'blog/assorted_biscuits.png', 1, 'Recipe', 'Biscuits, Cookies, Naan Khatai, Custom Sweets, Traditional', 'published', 0, 'Traditional Biscuits & Custom Cookies - Saffron Sweets & Bakery', 'Discover our range of Bengali biscuits and custom cookies. From Naan Khatai to themed cookies for special occasions.', 'Nostrum nisi volupta', 17, '2026-03-24 10:53:25', '2026-03-24 10:53:25', '2026-04-02 06:44:47', NULL),
(28, 'The Authentic Rosogolla Experience', 'প্রামাণিক রসগোল্লার স্বাদ', 'authentic-rosogolla-experience', '<h2>The King of Bengali Sweets</h2><p>When it comes to Bengali sweets, one name stands above all – <strong>Rosogolla</strong>. And not just any rosogolla – we\'re talking about the authentic, spongy rosogolla from Porabari.</p>\n\n<h3>The Legend of Porabari</h3>\n<p>In 1868, Nobin Chandra Das created a revolutionary sweet in the small town of Porabari, West Bengal. Unlike the hard, dry sweets of the time, his rosogolla was soft, spongy, and soaked in sugar syrup. Little did he know that his creation would become the identity of Bengali sweets worldwide.</p>\n\n<h3>What Makes Authentic Rosogolla Special?</h3>\n<ul>\n<li><strong>Texture:</strong> The perfect spongy texture that absorbs syrup but maintains shape</li>\n<li><strong>Sweetness:</strong> Balanced sweetness from pure cane sugar</li>\n<li><strong>Size:</strong> Bite-sized pieces that melt in your mouth</li>\n<li><strong>Freshness:</strong> Made daily, never frozen or stored for long</li>\n<li><strong>Authenticity:</strong> Following the original Porabari recipe</li>\n</ul>\n\n<h3>Our Rosogolla Varieties</h3>\n<ul>\n<li><strong>Classic Spongy Rosogolla:</strong> The traditional favorite</li>\n<li><strong>Gulab Jamun Rosogolla:</strong> A fusion of two classics</li>\n<li><strong>Pista Rosogolla:</strong> Topped with crushed pistachios</li>\n<li><strong>Kesar Rosogolla:</strong> Infused with premium saffron</li>\n<li><strong>Chocolate Rosogolla:</strong> Modern twist on tradition</li>\n<li><strong>Rasmalai Rosogolla:</strong> Soaked in thick, creamy malai</li>\n</ul>\n\n<h3>The Saffron Difference</h3>\n<p>At Saffron Sweets & Bakery, we\'re committed to preserving the authentic taste of Porabari:</p>\n<ul>\n<li>Traditional chana (chickpea flour) base</li>\n<li>Pure ghee for richness</li>\n<li>Natural saffron for color and aroma</li>\n<li>Cardamom for authentic flavor</li>\n<li>No artificial colors or preservatives</li>\n<li>Homemade paneer for filling varieties</li>\n</ul>\n\n<h3>Why the Name \"Rosogolla\"?</h3>\n<p>The name comes from \"Ras\" (juice/syrup) and \"Golla\" (round ball). The sweet round balls floating in sugar syrup literally translates to \"round balls in juice\" – a simple, honest name for an extraordinary sweet.</p>\n\n<h3>Perfect for Every Occasion</h3>\n<ul>\n<li><strong>Puja Offerings:</strong> Traditional offering to Goddess Lakshmi</li>\n<li><strong>Dessert After Meals:</strong> The perfect ending to any feast</li>\n<li><strong>Gift Boxes:</strong> Premium packaging for gifting</li>\n<li><strong>Festival Celebrations:</strong> Durga Puja, Diwali, weddings</li>\n</ul>\n\n<p>Experience the authentic taste of Bengal with our rosogolla. Each piece is a tribute to the rich culinary heritage of our land.</p>', '<h2>বাঙালি মিষ্টিতে রাজা</h2><p>বাঙালি মিষ্টির কথা বলে একটি নাম যার চেয়ে আসে – রসগোল্লা। আর শুধু কোনো রসগোল্লা নয় – আমরা কথা বলছি প্রভারিতামিষ পোরাবাড়ির স্পঞ্জ, নরম ও সত্য রসগোল্লা।</p>', 'Discover the heritage of Bengal\'s most iconic sweet. Learn about the authentic spongy rosogolla from Porabari, its history, and why it\'s called the \"King of Bengali Sweets.\"', 'বাংলার সবচের মিষ টি প্রতীক মিষ্টি - রসগোল্লা। প্রভারিতামিষ রসগোল্লা সম্পর্কে এই মিষ্টি রসগোল্লার উত্তম-ঐতিহ্য এবং ইতিহাস জানুন।', 'blog/rosogolla.png', 1, 'Story', 'Rosogolla, Bengali Sweets, Traditional Sweets, Porabari, Heritage', 'published', 0, 'Authentic Rosogolla - The King of Bengali Sweets', 'Experience the authentic spongy rosogolla from Porabari. Learn about its history, varieties, and why it\'s Bengal\'s favorite sweet.', 'Magnam sit nesciunt', 7, '2026-03-24 11:59:14', '2026-03-24 11:45:23', '2026-03-24 12:11:12', NULL);

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
(54, 1, NULL, 43, 1, '2026-03-25 06:13:59', '2026-03-25 11:48:14'),
(62, 2, NULL, 104, 1, '2026-03-30 07:23:36', '2026-03-30 12:15:26'),
(67, 1, NULL, 69, 1, '2026-04-02 05:39:46', '2026-04-02 06:01:47');

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
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt_en` text COLLATE utf8mb4_unicode_ci,
  `content_en` longtext COLLATE utf8mb4_unicode_ci,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt_bn` text COLLATE utf8mb4_unicode_ci,
  `content_bn` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `slug`, `title_en`, `excerpt_en`, `content_en`, `title_bn`, `excerpt_bn`, `content_bn`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'terms', 'Terms & Conditions', 'Terms and conditions for using Saffron Sweets & Bakery website', '<p>By accessing and using the Saffron Sweets & Bakery website, you accept and agree to be bound by the terms and provisions of this agreement.</p><p>All prices are in BDT (Bangladeshi Taka) and are subject to change without notice.</p><p>Due to the perishable nature of our products, we cannot accept returns or exchanges.</p>', 'শর্তাবলী ও শর্তনামা', NULL, NULL, NULL, NULL, NULL, 1, '2026-03-16 08:03:17', '2026-03-16 08:03:17'),
(2, 'privacy', 'Privacy Policy', 'Privacy policy for Saffron Sweets & Bakery', '<p>We respect your privacy and are committed to protecting your personal data.</p><p>We collect information to provide better services to our customers.</p><p>Your information is securely stored and never shared with third parties.</p>', 'গোপনীয়তা নীতি', NULL, NULL, NULL, NULL, NULL, 1, '2026-03-16 08:03:17', '2026-03-16 08:03:17'),
(3, 'about', 'About Us', 'Learn about Saffron - Bengali Traditional Sweets', '<h2>Our Story</h2><p>Saffron started as a small shop where we made traditional Bengali sweets. Today we are one of the finest sweet and bakery brands in Bangladesh.</p><h2>Our Values</h2><p>We believe in quality, purity, and customer satisfaction. Every product is made with love and care.</p>', 'আমাদের সম্পর্কে', 'স্বর্ণভাস্কর - বাংলার ঐতিহ্যবাহী মিষ্টান্নের কথা', '<h2>আমাদের গল্প</h2><p>স্বর্ণভাস্কর শুরু হয়েছিল একটি ছোট্ট দোকান থেকে, যেখানে আমরা ঐতিহ্যবাহী বাংলা মিষ্টান্ন তৈরি করতাম। আজ আমরা বাংলাদেশের অন্যতম সেরা মিষ্টান্ন এবং বেকারি ব্র্যান্ড।</p><h2>আমাদের মূল্যবোধ</h2><p>আমরা বিশ্বাস করি গুণমান, বিশুদ্ধতা এবং গ্রাহক সন্তুষ্টিতে। প্রতিটি পণ্য আমরা তৈরি করি ভালোবাসা এবং যত্ন সহকারে।</p>', 'About Us - Saffron', 'Learn about Saffron, our story, values, and commitment to quality sweets.', NULL, 1, '2026-03-16 08:03:17', '2026-03-25 06:47:17'),
(4, 'return', 'Return Policy', 'Return and refund policy....', '<p>Due to the perishable nature of our products, we cannot accept returns or exchanges.</p><p>If you receive a damaged or incorrect order, please contact us within 24 hours of delivery.</p><p>We will work to resolve the issue promptly.</p>', 'রিটার্ন পলিসি', NULL, NULL, NULL, NULL, NULL, 1, '2026-03-16 08:03:17', '2026-03-29 08:46:37'),
(5, 'faq', 'Frequently Asked Questions', 'Find answers to common questions', '<p><strong>Q: What are your delivery hours?</strong><br>A: We deliver from 9 AM to 9 PM, 7 days a week.</p><p><strong>Q: How long does delivery take?</strong><br>A: Delivery typically takes 2-4 hours within Dhaka.</p><p><strong>Q: What payment methods do you accept?</strong><br>A: We accept Cash on Delivery, bKash, Nagad, and credit/debit cards.</p>', 'সাধারণ জিজ্ঞাসিত প্রশ্নাবলী', NULL, NULL, NULL, NULL, NULL, 1, '2026-03-16 08:03:17', '2026-03-16 08:03:17'),
(6, 'home', 'Home', 'Welcome to Saffron - Authentic Bengali Sweets & Bakery', '<p>We specialize in traditional Bengali sweets and bakery products. Our rasgulla, sandesh, and sweets are made with the finest ingredients.</p>', 'হোম পেজ', 'স্বাগতম স্বর্ণভাস্কর - প্রামাণিক বাংলা মিষ্টান্ন ও বেকারি', '<p>আমরা ঐতিহ্যবাহী বাংলা মিষ্টান্ন এবং বেকারি পণ্যের জন্য পরিচিত। আমাদের রসগোল্লা, সন্দেশ, গুড়ের মিষ্টি এবং তাজা বেকারি পণ্যগুলি প্রস্তুত করা হয় শ্রেষ্ঠ উপাদান দিয়ে।</p>', 'Saffron - Best Bengali Sweets & Bakery', 'Authentic Bengali sweets, rasgulla, sandesh, and fresh bakery products. Order online now!', NULL, 1, '2026-03-16 08:11:03', '2026-03-25 06:46:44'),
(7, 'contact', 'Contact Us', 'Get in touch with us', '<p>We\'d love to hear from you. Fill out the form below or contact us directly.</p>', 'যোগাযোগ করুন', 'আমাদের সাথে যোগাযোগ করুন', '<p>আমরা আপনার মতামত শুনতে চাই। নিচের ফর্মটি পূরণ করুন অথবা সরাসরি যোগাযোগ করুন।</p>', 'Contact Us - Saffron', 'Contact Saffron for orders, inquiries, or feedback.', NULL, 1, '2026-03-25 06:47:17', '2026-03-25 06:47:17'),
(9, 'footer', 'Footer', 'Footer sections and links', 'Footer content managed through CMS sections', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-03-29 09:37:03', '2026-03-29 09:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `cms_sections`
--

CREATE TABLE `cms_sections` (
  `id` bigint UNSIGNED NOT NULL,
  `cms_page_id` bigint UNSIGNED NOT NULL,
  `section_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_en` text COLLATE utf8mb4_unicode_ci,
  `subtitle_bn` text COLLATE utf8mb4_unicode_ci,
  `content_en` longtext COLLATE utf8mb4_unicode_ci,
  `content_bn` longtext COLLATE utf8mb4_unicode_ci,
  `button_text_en` text COLLATE utf8mb4_unicode_ci,
  `button_text_bn` text COLLATE utf8mb4_unicode_ci,
  `button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_sections`
--

INSERT INTO `cms_sections` (`id`, `cms_page_id`, `section_key`, `title_en`, `title_bn`, `subtitle_en`, `subtitle_bn`, `content_en`, `content_bn`, `button_text_en`, `button_text_bn`, `button_url`, `image_url`, `icon`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(30, 3, 'our_story', 'Our Story', 'আমাদের গল্প', 'About <span class=\"gradient-text\">Saffron</span>', NULL, 'Three generations of handcrafted sweetness, made with love and served with joy since 1995.', '<p>স্বর্ণভাস্কর শুরু হয়েছিল একটি ছোট্ট দোকান থেকে, যেখানে আমরা ঐতিহ্যবাহী বাংলা মিষ্টান্ন তৈরি করতাম। আজ আমরা বাংলাদেশের অন্যতম সেরা মিষ্টান্ন এবং বেকারি ব্র্যান্ড।</p>', NULL, NULL, NULL, NULL, '🏪', 1, 1, '2026-03-25 06:47:17', '2026-03-29 07:03:49'),
(32, 7, 'contact_info', 'Contact <span class=\"gradient-text\">Information</span>', 'যোগাযোগের তথ্য', 'Get in <span class=\"gradient-text\">Touch</span>', 'আমাদের সাথে যোগাযোগ করুন', 'Phone\r\n+880 1730 702000\r\nEmail\r\ninfo@saffronsweets.com.bd\r\nBusiness Hours\r\nMon - Sat: 9AM - 9PM\r\nSunday: 10AM - 6PM', NULL, NULL, NULL, NULL, NULL, '📞', 1, 1, '2026-03-25 06:47:17', '2026-03-29 08:24:36'),
(37, 6, 'hero', 'Authentic Saffron<br/><span class=\"gradient-text\">Sweets & Bakery</span>', NULL, '🎂 Premium Quality Since 1995', NULL, 'Indulge in the rich heritage of Bengal with our exquisite collection of traditional sweets and premium bakery items. Each creation is crafted with love using recipes passed down through generations.', NULL, 'Shop Now', NULL, '/shop', NULL, '🎂', 1, 1, '2026-03-25 13:04:37', '2026-03-29 11:25:13'),
(38, 6, 'who-we-are', 'Who We Are', NULL, 'Authentic Saffron<br/><span class=\"gradient-text\">Sweets & Traditional Bakery</span>', NULL, 'Welcome to Saffron, where tradition meets excellence. We bring you the finest collection of authentic Bengali sweets and premium bakery items, crafted with love and the purest saffron. Our skilled artisans use time-honored recipes passed down through generations to create mouth-watering treats that will transport you to the streets of Bangladesh. From roshogolla to sandesh, from freshly baked cakes to artisan cookies – every bite is a celebration of flavor.', NULL, NULL, NULL, NULL, NULL, '🏪', 2, 1, '2026-03-25 13:04:37', '2026-03-29 05:49:56'),
(39, 6, 'specialty', 'Authentic Bengali Sweets Collection', NULL, 'Authentic Bengali<br/><span class=\"gradient-text\">Sweets Collection</span>', NULL, 'Indulge in the rich heritage of Bengal with our exquisite collection of traditional sweets, crafted with love and the finest ingredients.\n\nFrom the melt-in-your-mouth roshogolla to the delicate sandesh, our sweets are made using recipes passed down through generations. Each sweet is a celebration of authentic Bengali tradition, bringing you the true taste of home.', NULL, 'Discover Sweets', NULL, '/shop/category/traditional-sweets', NULL, '🍮', 3, 1, '2026-03-25 13:04:52', '2026-03-29 05:50:18'),
(40, 6, 'chocolate-paradise', 'Premium Chocolate & Cocoa Delights', NULL, 'Premium Chocolate &<br/><span class=\"gradient-text\">Cocoa Delights</span>', NULL, 'Experience the ultimate indulgence with our exquisite collection of handcrafted chocolates, made from the finest cocoa beans sourced from around the world.\n\nFrom silky smooth dark chocolate to creamy milk chocolate truffles, our master chocolatiers create artisanal pieces that will delight your senses. Each chocolate is carefully crafted to deliver an unforgettable taste experience.', NULL, 'Discover Chocolates', NULL, '/shop', NULL, '🍫', 4, 1, '2026-03-25 13:04:52', '2026-03-29 05:56:13'),
(41, 6, 'browse-categories', 'Browse Categories', NULL, 'Explore Our <span class=\"gradient-text\">Delicious</span> Collection', NULL, 'Discover our wide range of categories featuring traditional Bengali sweets, premium bakery items, artisan chocolates, and more. Each category is carefully curated to bring you the best flavors.', NULL, NULL, NULL, NULL, NULL, '🛒', 5, 1, '2026-03-25 13:04:52', '2026-03-29 05:59:00'),
(42, 6, 'featured_products', 'Our Collection', NULL, 'Featured <span class=\"gradient-text\">Products</span>', NULL, 'Handpicked favorites from our extensive collection. Each product is carefully selected to ensure the highest quality and taste.', NULL, NULL, NULL, NULL, NULL, '⭐', 6, 1, '2026-03-25 13:05:26', '2026-03-29 06:02:58'),
(43, 6, 'new-arrivals', 'New Arrivals', NULL, 'New <span class=\"gradient-text\">Arrivals</span>', NULL, 'Discover our latest creations - fresh from the oven and ready to delight your taste buds. Our chefs are constantly innovating to bring you new and exciting flavors.', NULL, 'View All New Arrivals', NULL, '/shop?sort=newest', NULL, '✨', 7, 1, '2026-03-25 13:05:26', '2026-03-29 06:05:25'),
(44, 6, 'best-offers', 'Best Offers', NULL, 'Best <span class=\"gradient-text\">Offers</span>', NULL, 'Our most loved products that customers keep coming back for. These are our top-rated items based on customer reviews and sales.', NULL, NULL, NULL, NULL, NULL, '🏷️', 8, 1, '2026-03-25 13:05:26', '2026-03-29 06:07:14'),
(45, 6, 'blog', 'Latest News', NULL, 'From Our <span class=\"gradient-text\">Blog</span>', NULL, 'Discover recipes, stories, and sweet updates from our kitchen. Learn about the art of sweet-making, traditional recipes, and the latest news from Saffron.', NULL, 'View All Posts', NULL, '/blog', NULL, '📰', 9, 1, '2026-03-25 13:05:26', '2026-03-29 06:12:05'),
(46, 3, 'our_heritage', 'Our <span class=\"gradient-text\">Heritage</span>', NULL, 'Three Generations of Excellence', NULL, 'Founded in 1995, Saffron has been serving the finest authentic Bengali sweets and premium bakery items for over three decades. What started as a small family business has grown into one of the most beloved sweet shops in Bangladesh.\r\n\r\nOur skilled artisans use time-honored recipes passed down through generations to create treats that bring joy to thousands of customers every day. We take pride in preserving the authentic taste of Bengali traditions while embracing innovation to delight modern palates.\r\n\r\nEvery sweet that leaves our kitchen carries the legacy of our founders and the love of our customers.', NULL, NULL, NULL, NULL, NULL, '🏛️', 2, 1, '2026-03-29 06:58:16', '2026-03-29 07:09:35'),
(47, 3, 'our_beginning', 'Our  <span class=\"gradient-text\">Beginning</span>', NULL, 'Where Tradition Meets Excellence', NULL, 'Welcome to Saffron, where tradition meets excellence. Founded in 1995, we\'ve been serving the finest authentic Bengali sweets and premium bakery items for over three decades.\r\n\r\nWhat started as a small family business has grown into one of the most beloved sweet shops in Bangladesh. Our skilled artisans use time-honored recipes passed down through generations to create treats that bring joy to thousands of customers every day.', NULL, NULL, NULL, NULL, NULL, '🏠', 3, 1, '2026-03-29 07:02:58', '2026-03-29 07:10:16'),
(48, 3, 'our_core_values', 'Our Core <span class=\"gradient-text\">Values</span>', NULL, 'The Foundation of Our Excellence', NULL, '✨ Quality\r\n\r\nOnly the finest ingredients\r\n\r\n👨‍🍳 Tradition\r\n\r\nAuthentic recipes\r\n\r\n💝 Passion\r\n\r\nMade with love\r\n\r\n🏆 Excellence\r\n\r\n30+ years of trust', NULL, NULL, NULL, NULL, NULL, '💎', 4, 1, '2026-03-29 07:11:15', '2026-03-29 07:25:55'),
(49, 7, 'social_links', 'Follow Us', NULL, 'Stay <span class=\"gradient-text\">Connected</span>', NULL, 'facebook\nhttps://facebook.com/saffronsweets\ninstagram\nhttps://instagram.com/saffronsweets\ntwitter\nhttps://twitter.com/saffronsweets\nyoutube\nhttps://youtube.com/saffronsweets', NULL, NULL, NULL, NULL, NULL, '🔗', 2, 1, '2026-03-29 08:14:09', '2026-03-29 08:16:26'),
(50, 5, 'ordering_payment', 'Ordering & Payment', NULL, 'Payment & Ordering', NULL, 'How do I place an order?\r\n\r\nBrowse our products, add items to your cart, and proceed to checkout. You will need to create an account or log in to complete your purchase. Follow the step-by-step instructions to enter your delivery address and payment information.\r\n\r\nWhat payment methods do you accept?\r\n\r\nWe accept cash on delivery (COD), bKash, Nagad, Rocket, and all major credit/debit cards. For online payments, you will be redirected to a secure payment gateway.\r\n\r\nIs my payment information secure?\r\n\r\nAbsolutely! We use industry-standard SSL encryption and secure payment gateways to ensure your payment information is protected. We never store your complete credit card details on our servers.', NULL, NULL, NULL, NULL, NULL, '🛒', 1, 1, '2026-03-29 08:30:28', '2026-03-29 08:36:17'),
(51, 5, 'delivery_shipping', 'Delivery & Shipping', NULL, 'Fast & Reliable', NULL, 'What are your delivery areas?\n\nWe currently deliver across Dhaka city. We are working hard to expand our delivery network to other cities. Enter your address during checkout to check if delivery is available in your area.\n\nHow long does delivery take?\n\nFor orders within Dhaka: Same-day delivery for orders placed before 2 PM, next-day delivery for orders placed after 2 PM. Delivery time is typically 3-6 hours depending on your location.\n\nWhat are the delivery charges?\n\nDelivery charge starts from ৳50 within Dhaka city, depending on your location. Free delivery is available for orders above ৳500.', NULL, NULL, NULL, NULL, NULL, '🚚', 2, 1, '2026-03-29 08:30:51', '2026-03-29 08:30:51'),
(52, 5, 'products_quality', 'Products & Quality', NULL, 'Fresh & Premium', NULL, 'How fresh are your products?\n\nAll our products are freshly made daily. We take pride in using premium ingredients and traditional recipes to ensure the highest quality. Sweets and bakery items are prepared in small batches throughout the day.\n\nDo you offer custom orders for special occasions?\n\nYes! We specialize in custom cakes, sweet boxes, and bakery items for weddings, birthdays, corporate events, and festivals. Please contact us at least 48-72 hours in advance for custom orders. Call us at +880 1730 702000.\n\nAre your products vegetarian?\n\nMost of our sweets are vegetarian (made without eggs). However, some cakes and bakery items contain eggs. Please check the product description or contact us if you have specific dietary requirements.', NULL, NULL, NULL, NULL, NULL, '🍪', 3, 1, '2026-03-29 08:30:51', '2026-03-29 08:30:51'),
(53, 5, 'returns_refunds', 'Returns & Refunds', NULL, 'Hassle-Free', NULL, 'What is your return policy?\n\nDue to the perishable nature of our products, we cannot accept returns. However, if you receive a damaged or incorrect order, please contact us within 2 hours of delivery. We will either replace the items or issue a refund. For detailed policy, please visit our Returns page.\n\nHow do I request a refund?\n\nIf you are eligible for a refund, contact our customer service at +880 1730 702000 or email info@saffronsweets.com.bd. Refunds are processed within 5-7 business days to your original payment method.', NULL, NULL, NULL, NULL, NULL, '🔄', 4, 1, '2026-03-29 08:30:51', '2026-03-29 08:30:51'),
(54, 5, 'account_support', 'Account & Support', NULL, 'Here to Help', NULL, 'Do I need to create an account to order?\n\nYes, creating an account allows you to track your orders, save addresses, view order history, and enjoy exclusive member discounts. It only takes a minute to register!\n\nHow can I contact customer support?\n\nOur customer support team is available Mon-Sat, 9AM-9PM. Call us at +880 1730 702000, email info@saffronsweets.com.bd, or message us on Facebook/Instagram. We typically respond within 30 minutes during business hours.\n\nDo you have a loyalty program?\n\nYes! Earn 1 point for every ৳10 spent. Collect 100 points and get ৳50 off your next order. Premium members get exclusive discounts, early access to new products, and special birthday treats!', NULL, NULL, NULL, NULL, NULL, '🎧', 5, 1, '2026-03-29 08:30:51', '2026-03-29 08:30:51'),
(55, 4, 'important_notice', 'Important Notice', NULL, NULL, NULL, 'Due to the perishable nature of our sweets and bakery products, we have specific return policies to ensure product quality and food safety. Please read this policy carefully before making a purchase.', NULL, NULL, NULL, NULL, NULL, '⚠️', 1, 1, '2026-03-29 08:41:36', '2026-03-29 09:06:43'),
(56, 4, 'return_eligibility', 'Return Eligibility', NULL, NULL, NULL, 'You may request a return or exchange in the following circumstances:\n\nWrong products delivered (items different from your order)\nDamaged products received (broken packaging, spoiled items)\nMissing items in your order\nPoor quality or freshness issues (must be reported within 2 hours)\nManufacturing defects or foreign objects in products', NULL, NULL, NULL, NULL, NULL, '✓', 2, 1, '2026-03-29 08:41:36', '2026-03-29 08:41:36'),
(57, 4, 'time_frame_returns', 'Time Frame for Returns', NULL, NULL, NULL, 'Same-day returns: Must be reported within 2 hours of delivery\nDamaged/incorrect items: Report within 2 hours of delivery\nQuality issues: Must contact us within 2 hours, with photo evidence\nMissing items: Report within 2 hours of delivery\n\nNote: No returns will be accepted after the specified time frames or if the products have been consumed partially.', NULL, NULL, NULL, NULL, NULL, '⏰', 3, 1, '2026-03-29 08:41:36', '2026-03-29 08:41:36'),
(58, 4, 'non_returnable_items', 'Non-Returnable Items', NULL, NULL, NULL, 'The following items cannot be returned or exchanged:\n\nProducts that have been partially or fully consumed\nItems returned after the specified time frame\nProducts without original packaging (if applicable)\nItems damaged due to customer mishandling\nPersonalized/custom orders (unless there is a quality issue)\nItems marked as Final Sale or Non-Returnable\nTemperature-sensitive products that were not properly stored after delivery', NULL, NULL, NULL, NULL, NULL, '🚫', 4, 1, '2026-03-29 08:42:14', '2026-03-29 08:42:14'),
(59, 4, 'how_to_request_return', 'How to Request a Return', NULL, NULL, NULL, 'Follow these simple steps to request a return or refund:\n\nStep 1: Contact our customer service immediately at +880 1730 702000\nStep 2: Provide your order number and describe the issue\nStep 3: Send clear photos of damaged/incorrect items (if applicable)\nStep 4: Our team will review your request within 1-2 hours\nStep 5: If approved, we will arrange replacement or process refund', NULL, NULL, NULL, NULL, NULL, '📋', 5, 1, '2026-03-29 08:42:14', '2026-03-29 08:42:14'),
(60, 4, 'refund_policy', 'Refund Policy', NULL, NULL, NULL, 'Refunds are processed based on the payment method and circumstances:\n\nCash on Delivery (COD): Refund will be processed to your bKash/Nagad/Rocket account within 5-7 business days\nbKash/Nagad/Rocket: Refund to the same number within 3-5 business days\nCredit/Debit Card: Refund to the same card within 7-10 business days (depends on bank)\nReplacement: Free replacement will be delivered within 24-48 hours (depending on product availability)', NULL, NULL, NULL, NULL, NULL, '💰', 6, 1, '2026-03-29 08:42:14', '2026-03-29 08:42:14'),
(61, 4, 'delivery_charges_returns', 'Delivery Charges for Returns', NULL, NULL, NULL, 'Valid returns (our fault): No additional delivery charges for replacement items\nInvalid returns (customer error): Customer bears return delivery cost\nRefund only cases: Original delivery charges are non-refundable', NULL, NULL, NULL, NULL, NULL, '🚚', 7, 1, '2026-03-29 08:42:29', '2026-03-29 08:42:29'),
(62, 4, 'order_cancellations', 'Order Cancellations', NULL, NULL, NULL, 'Before processing: Full refund if cancelled within 30 minutes of order placement\r\nAfter processing but before delivery: 10% cancellation fee applies\r\nAfter dispatch: Cannot be cancelled (follow return process instead)\r\nCustom orders: Cannot be cancelled once production has started', NULL, NULL, NULL, NULL, NULL, '❌', 8, 1, '2026-03-29 08:42:29', '2026-03-29 08:47:50'),
(63, 2, 'privacy_last_updated', 'Last Updated....', NULL, NULL, NULL, 'March 15, 2026 | March 15, 2026', NULL, NULL, NULL, NULL, NULL, '📅', 1, 1, '2026-03-29 08:50:03', '2026-03-29 09:00:20'),
(64, 2, 'privacy_introduction', 'Introduction', NULL, NULL, NULL, 'Saffron Sweets and Bakery (we, our, or us) respects your privacy and is committed to protecting your personal data. This privacy policy explains how we collect, use, disclose, and safeguard your information when you visit our website saffronsweets.com.bd and use our services.\r\n\r\nBy using our website and services, you agree to the collection and use of information in accordance with this policy. If you disagree with any part of this policy, please do not use our website or services.', NULL, NULL, NULL, NULL, NULL, 'ℹ️', 2, 1, '2026-03-29 08:50:03', '2026-03-29 09:01:15'),
(65, 2, 'info_collect_personal', 'Personal Information', NULL, 'Information We Collect', NULL, 'Name, email address, phone number\nDelivery address and billing information\nAccount credentials (username, encrypted password)\nProfile information (date of birth, gender - optional)\nPayment information (processed securely through payment gateways)', NULL, NULL, NULL, NULL, NULL, '👤', 3, 1, '2026-03-29 08:50:03', '2026-03-29 08:50:03'),
(66, 2, 'info_collect_order', 'Order Information', NULL, 'Information We Collect', NULL, 'Products viewed, added to cart, or purchased\nOrder history and transaction details\nWishlist items\nDelivery preferences and instructions', NULL, NULL, NULL, NULL, NULL, '🛒', 4, 1, '2026-03-29 08:50:03', '2026-03-29 08:50:03'),
(67, 2, 'info_collect_technical', 'Technical Information', NULL, 'Information We Collect', NULL, 'IP address, browser type, and device information\nOperating system and browsing behavior\nCookies and similar tracking technologies\nPages visited and time spent on website', NULL, NULL, NULL, NULL, NULL, '💻', 5, 1, '2026-03-29 08:50:03', '2026-03-29 08:50:03'),
(68, 2, 'how_use_info', 'How We Use Your Information', NULL, NULL, NULL, 'Order Processing: To process, fulfill, and deliver your orders\nAccount Management: To create and manage your account\nCommunication: To send order confirmations, updates, and notifications\nCustomer Support: To respond to your inquiries and provide assistance\nPayment Processing: To process transactions securely\nPersonalization: To recommend products and improve your shopping experience\nMarketing: To send promotional offers (with your consent)\nAnalytics: To analyze website usage and improve our services\nFraud Prevention: To detect and prevent fraudulent activities\nLegal Compliance: To comply with legal obligations', NULL, NULL, NULL, NULL, NULL, '⚙️', 6, 1, '2026-03-29 08:50:25', '2026-03-29 08:50:25'),
(69, 2, 'data_sharing', 'Data Sharing and Disclosure', NULL, NULL, NULL, 'We respect your privacy and do not sell your personal data. We may share your information only in the following circumstances:\n\nPayment Gateways (bKash, Nagad, SSL Commerz) | Process payments securely\nDelivery Partners | Deliver your orders\nService Providers (Hosting, Email, Analytics) | Operate our website and services\nLegal Authorities | Comply with legal requirements\nBusiness Partners (with consent) | Special promotions and offers\n\nNote: We share only the minimum necessary information required for the specified purpose. All third parties are bound by confidentiality obligations.', NULL, NULL, NULL, NULL, NULL, '🔗', 7, 1, '2026-03-29 08:50:25', '2026-03-29 08:50:25'),
(70, 2, 'cookies_tracking', 'Cookies and Tracking Technologies', NULL, NULL, NULL, 'Remember your login credentials and preferences\nKeep items in your shopping cart\nAnalyze website traffic and user behavior\nPersonalize content and advertisements\nImprove website functionality and performance\n\nCookie Types:\nEssential Cookies | Required for basic website functionality\nAnalytics Cookies | Help us understand user behavior\nFunctionality Cookies | Remember preferences and settings\nAdvertising Cookies | Display relevant ads (with consent)\n\nYou can manage cookie preferences through your browser settings. However, disabling cookies may affect website functionality.', NULL, NULL, NULL, NULL, NULL, '🍪', 8, 1, '2026-03-29 08:50:25', '2026-03-29 08:50:25'),
(71, 2, 'data_security', 'Data Security', NULL, NULL, NULL, 'SSL Encryption: All data transmission is encrypted using SSL/TLS\nSecure Payment: Payment processing through PCI DSS compliant gateways\nPassword Hashing: Passwords are stored using bcrypt hashing\nAccess Control: Limited access to personal data on a need-to-know basis\nRegular Audits: Periodic security assessments and updates\nData Backup: Secure backup with disaster recovery plan\n\nImportant: While we take all reasonable measures to protect your data, no method of transmission over the internet is 100% secure. We cannot guarantee absolute security.', NULL, NULL, NULL, NULL, NULL, '🔒', 9, 1, '2026-03-29 08:50:25', '2026-03-29 08:50:25'),
(72, 2, 'privacy_rights', 'Your Privacy Rights', NULL, NULL, NULL, 'Access: Request a copy of your personal data\nCorrection: Update or correct inaccurate information\nDeletion: Request deletion of your personal data (subject to legal obligations)\nObjection: Object to processing of your personal data\nRestriction: Request restriction of data processing\nData Portability: Receive your data in a structured format\nWithdraw Consent: Withdraw consent at any time (where processing is based on consent)\n\nTo exercise these rights, contact us at privacy@saffronsweets.com.bd. We will respond within 30 days.', NULL, NULL, NULL, NULL, NULL, '🛡️', 10, 1, '2026-03-29 08:50:25', '2026-03-29 08:50:25'),
(73, 2, 'data_retention', 'Data Retention', NULL, NULL, NULL, 'Account Information: Until account deletion\nOrder History: 5 years from purchase date (legal requirement)\nPayment Records: 5 years (tax and legal requirement)\nCommunication Logs: 2 years\nAnalytics Data: Aggregated and anonymized after 26 months\n\nAfter the retention period, data is securely deleted or anonymized unless required for legal proceedings.', NULL, NULL, NULL, NULL, NULL, '📦', 11, 1, '2026-03-29 08:50:41', '2026-03-29 08:50:41'),
(74, 2, 'children_privacy', 'Children Privacy', NULL, NULL, NULL, 'Our services are not intended for children under 13. We do not knowingly collect personal information from children under 13. If you are a parent or guardian and believe your child has provided us with personal data, please contact us immediately.\n\nIf we become aware that we have collected personal data from a child under 13 without parental consent, we will take steps to remove that information.', NULL, NULL, NULL, NULL, NULL, '👶', 12, 1, '2026-03-29 08:50:41', '2026-03-29 08:50:41'),
(75, 2, 'third_party_links', 'Third-Party Websites', NULL, NULL, NULL, 'Our website may contain links to third-party websites (social media, payment gateways, delivery partners). We are not responsible for the privacy practices of these third parties. We encourage you to review their privacy policies.', NULL, NULL, NULL, NULL, NULL, '🔗', 13, 1, '2026-03-29 08:50:41', '2026-03-29 08:50:41'),
(76, 2, 'policy_changes', 'Changes to This Privacy Policy', NULL, NULL, NULL, 'We may update this privacy policy from time to time. We will notify you of any changes by:\n\nPosting the new policy on this page with an updated Last Modified date\nSending an email notification for significant changes\nDisplaying a prominent notice on our website\n\nYour continued use of our services after the effective date constitutes acceptance of the updated policy.', NULL, NULL, NULL, NULL, NULL, '📝', 14, 1, '2026-03-29 08:50:41', '2026-03-29 08:50:41'),
(77, 2, 'privacy_contact', 'Contact Us', NULL, NULL, NULL, 'If you have questions, concerns, or requests regarding this privacy policy or our data practices, please contact us:\r\n\r\nEmail | privacy@saffronsweets.com.bd\r\nPhone | +880 1730 702000\r\nAddress | Dhaka, Bangladesh\r\n\r\nWe will respond to your privacy-related inquiries within 30 days.', NULL, NULL, NULL, NULL, NULL, '📧', 15, 1, '2026-03-29 08:50:41', '2026-03-29 09:01:46'),
(78, 1, 'terms_acceptance', 'Acceptance of Terms', NULL, NULL, NULL, 'By accessing and using the Saffron Sweets and Bakery website, you accept and agree to be bound by the terms and provisions of this agreement. If you do not agree to abide by these terms, please do not use this service.', NULL, NULL, NULL, NULL, NULL, '✓', 1, 1, '2026-03-29 09:03:35', '2026-03-29 09:10:08'),
(79, 1, 'terms_products_services', 'Products and Services', NULL, NULL, NULL, 'All products displayed on our website are subject to availability. We reserve the right to discontinue any product at any time. We strive to provide accurate product descriptions and images, but we do not warrant that descriptions are error-free.', NULL, NULL, NULL, NULL, NULL, '🛍️', 2, 1, '2026-03-29 09:03:35', '2026-03-29 09:03:35'),
(80, 1, 'terms_pricing_payment', 'Pricing and Payment', NULL, NULL, NULL, 'All prices are in BDT (Bangladeshi Taka) and are subject to change without notice. We reserve the right to modify prices or discontinue products at any time. Payment is due at the time of placing your order. We accept cash on delivery, bKash, Nagad, and major credit or debit cards.', NULL, NULL, NULL, NULL, NULL, '💰', 3, 1, '2026-03-29 09:03:35', '2026-03-29 09:03:35'),
(81, 1, 'terms_orders_delivery', 'Orders and Delivery', NULL, NULL, NULL, 'We reserve the right to accept or decline any order. Delivery times are estimates and cannot be guaranteed. We are not liable for any delays in delivery. Once an order is placed, you will receive an order confirmation via email or SMS.', NULL, NULL, NULL, NULL, NULL, '🚚', 4, 1, '2026-03-29 09:03:35', '2026-03-29 09:03:35'),
(82, 1, 'terms_returns_refunds', 'Returns and Refunds', NULL, NULL, NULL, 'Due to the perishable nature of our products, we cannot accept returns or exchanges. However, if you receive a damaged or incorrect order, please contact us within 24 hours of delivery, and we will work to resolve the issue.', NULL, NULL, NULL, NULL, NULL, '🔄', 5, 1, '2026-03-29 09:03:35', '2026-03-29 09:03:35'),
(83, 1, 'terms_user_accounts', 'User Accounts', NULL, NULL, NULL, 'You are responsible for maintaining the confidentiality of your account information. You agree to notify us immediately of any unauthorized use of your account. We are not liable for any loss or damage arising from your failure to protect your account information.', NULL, NULL, NULL, NULL, NULL, '👤', 6, 1, '2026-03-29 09:03:48', '2026-03-29 09:03:48'),
(84, 1, 'terms_intellectual_property', 'Intellectual Property', NULL, NULL, NULL, 'All content on this website, including text, graphics, logos, images, and software, is the property of Saffron Sweets and Bakery or its content suppliers and is protected by copyright and other intellectual property laws.', NULL, NULL, NULL, NULL, NULL, '©️', 7, 1, '2026-03-29 09:03:48', '2026-03-29 09:03:48'),
(85, 1, 'terms_limitation_liability', 'Limitation of Liability', NULL, NULL, NULL, 'Saffron Sweets and Bakery shall not be liable for any indirect, incidental, special, or consequential damages arising out of or in connection with the use of our products or services.', NULL, NULL, NULL, NULL, NULL, '⚖️', 8, 1, '2026-03-29 09:03:48', '2026-03-29 09:03:48'),
(86, 1, 'terms_privacy', 'Privacy Policy', NULL, NULL, NULL, 'Your use of our website is also governed by our Privacy Policy. Please review our Privacy Policy, which also governs the website and informs users of our data collection practices.', NULL, NULL, NULL, NULL, NULL, '🔒', 9, 1, '2026-03-29 09:03:48', '2026-03-29 09:03:48'),
(87, 1, 'terms_changes', 'Changes to Terms', NULL, NULL, NULL, 'We reserve the right to modify these terms at any time. Changes will be effective immediately upon posting to the website. Your continued use of the website following the posting of changes constitutes your acceptance of such changes.', NULL, NULL, NULL, NULL, NULL, '📝', 10, 1, '2026-03-29 09:03:48', '2026-03-29 09:03:48'),
(88, 1, 'terms_contact', 'Contact Information', NULL, NULL, NULL, 'If you have any questions about these Terms and Conditions, please contact us at:\n\nEmail | info@saffronsweets.com.bd\nPhone | +880 1730 702000', NULL, NULL, NULL, NULL, NULL, '📞', 11, 1, '2026-03-29 09:03:48', '2026-03-29 09:03:48'),
(89, 9, 'footer_brand_description', 'About Saffron', NULL, NULL, NULL, 'Three generations of handcrafted sweetness. Made with love, served with joy since 1995. Experience the authentic taste of tradition.', NULL, NULL, NULL, NULL, NULL, '🏪', 1, 1, '2026-03-29 09:37:03', '2026-03-30 04:21:31'),
(90, 9, 'footer_social_links', 'Social Media', NULL, NULL, NULL, 'facebook | https://facebook.com/saffronsweets\ninstagram | https://instagram.com/saffronsweets\ntwitter | https://twitter.com/saffronsweets\nyoutube | https://youtube.com/saffronsweets', NULL, NULL, NULL, NULL, NULL, '📱', 2, 1, '2026-03-29 09:37:03', '2026-03-29 09:37:03'),
(91, 9, 'footer_quick_links', 'Quick Links', NULL, NULL, NULL, 'home|/|Home\nproducts|/shop|Products\ncart|/cart|Cart\nabout|/about|About Us\ncontact|/contact|Contact', NULL, NULL, NULL, NULL, NULL, '🔗', 3, 1, '2026-03-29 09:37:03', '2026-03-30 03:49:44'),
(92, 9, 'footer_customer_service', 'Customer Service', NULL, NULL, NULL, 'faq|/faq|FAQ\nreturn|/return|Return Policy\nprivacy|/privacy|Privacy Policy\nterms|/terms|Terms of Service', NULL, NULL, NULL, NULL, NULL, '🎧', 4, 1, '2026-03-29 09:37:03', '2026-03-30 03:44:56'),
(93, 9, 'footer_contact', 'Contact Us', NULL, NULL, NULL, 'address | Jahir Smart Tower, 205/1, Begum Rokeya Sharani, Dhaka-1207\nphone | +880 1730 702000\nemail | info@saffronsweets.com.bd\nhours | Mon-Sat: 9AM-9PM | Sun: 10AM-6PM', NULL, NULL, NULL, NULL, NULL, '📍', 5, 1, '2026-03-29 09:37:16', '2026-03-29 09:37:16'),
(94, 9, 'footer_copyright', 'Copyright Text', NULL, NULL, NULL, '© {year} Saffron Sweets and Bakery. All rights reserved. Crafted with 💝', NULL, NULL, NULL, NULL, NULL, '©️', 6, 1, '2026-03-29 09:37:16', '2026-03-29 09:37:16'),
(95, 9, 'footer_payment_icons', 'Payment Methods', NULL, NULL, NULL, 'Visa | 💳\nMasterCard | 🏦\nbKash | 📱\nSSL Secure | 🔐', NULL, NULL, NULL, NULL, NULL, '💳', 7, 1, '2026-03-29 09:37:16', '2026-03-29 09:37:16'),
(96, 6, 'stats', 'Our Sweet Success', NULL, 'Trusted by thousands of sweet lovers', NULL, '250+ Products,15K+ Happy Customers,30+ Years Experience,4.9★ Rating', NULL, NULL, NULL, NULL, NULL, '📦,😊,🏆,⭐', 2, 1, '2026-03-29 11:02:02', '2026-03-29 11:02:02');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'Medge Waters', 'lyzel@mailinator.com', 'Ipsa quo voluptas d', 'Accusantium hic esse', 0, '2026-03-16 05:57:26', '2026-03-16 05:57:26'),
(2, 'Vivian Callahan', 'muluni@mailinator.com', 'Molestias facilis vo', 'Magna aperiam cupida', 0, '2026-03-16 05:57:40', '2026-03-16 05:57:40'),
(3, 'Kaseem Barr', 'miluxe@mailinator.com', 'Laborum Facilis con', 'Eaque consectetur al', 0, '2026-03-16 05:58:09', '2026-03-16 05:58:09'),
(5, 'Leo Mendez', 'nyjeti@mailinator.com', 'Do ipsum dolor nihi', 'Aut esse similique c', 0, '2026-03-16 08:38:24', '2026-03-16 08:38:24'),
(6, 'Madonna Mason', 'cohiqyw@mailinator.com', 'Sint corrupti odit', 'Officia rerum sunt', 0, '2026-03-25 05:48:37', '2026-03-25 05:48:37'),
(7, 'Odysseus Black', 'tafyquna@mailinator.com', 'Culpa velit facilis', 'Eius at qui veniam', 0, '2026-03-29 08:15:31', '2026-03-29 08:15:31'),
(8, 'Ray Andrews', 'tuhasifyz@mailinator.com', 'Illum ea id evenie', 'Aute beatae odit rer', 0, '2026-03-29 08:21:31', '2026-03-29 08:21:31'),
(9, 'Hollee Watson', 'zegyf@mailinator.com', 'Impedit ab esse vel', 'Distinctio Delectus', 0, '2026-03-30 03:49:52', '2026-03-30 03:49:52'),
(10, 'Lisandra Wyatt', 'talo@mailinator.com', 'Dolore possimus qui', 'Eligendi recusandae', 0, '2026-03-30 04:52:54', '2026-03-30 04:52:54');

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

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `max_discount`, `expires_at`, `usage_limit`, `usage_count`, `created_at`, `updated_at`) VALUES
(1, 'RAMADAN10', 'percent', 10.00, 500.00, '2026-03-31 23:25:00', 100, 8, '2026-03-16 05:40:19', '2026-03-31 11:27:23'),
(2, 'WELCOME10', 'percent', 10.00, 200.00, '2026-04-15 06:51:34', NULL, 0, '2026-03-16 06:51:34', '2026-03-16 06:51:34'),
(3, 'SAVE50', 'fixed', 50.00, NULL, '2026-05-15 06:51:34', NULL, 0, '2026-03-16 06:51:34', '2026-03-16 06:51:34'),
(4, 'FIRST20', 'percent', 20.00, 500.00, '2026-03-31 06:51:34', 100, 0, '2026-03-16 06:51:34', '2026-03-16 06:51:34');

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
(44, '2026_03_15_093415_add_transaction_id_to_orders_table', 15),
(45, '2026_03_15_054805_create_contacts_table', 16),
(46, '2026_03_16_070854_add_session_id_to_wishlists_table', 17),
(47, '2026_03_16_071409_make_user_id_nullable_in_wishlists_table', 18),
(49, '2026_03_16_074738_create_cms_pages_table', 19),
(50, '2026_03_16_081558_create_cms_sections_table', 20),
(51, '2026_03_24_065148_create_settings_table', 21),
(52, '2026_03_24_070416_add_shipping_amount_to_orders_table', 22),
(53, '2026_03_29_105217_create_subscribers_table', 23),
(54, '2026_04_02_055321_create_theme_settings_table', 24);

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
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17);

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
  `shipping_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
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

INSERT INTO `orders` (`id`, `user_id`, `b2b_customer_id`, `is_b2b_order`, `order_type`, `order_number`, `transaction_id`, `total_amount`, `shipping_amount`, `discount`, `final_amount`, `status`, `payment_method`, `payment_status`, `shipping_address`, `created_at`, `updated_at`, `coupon_id`) VALUES
(1, 2, NULL, 0, 'retail', 'ORD-69B66F084BEF4', NULL, 280.00, 0.00, 0.00, 340.00, 'cancelled', 'cod', 'failed', '{\"first_name\":\"Regina\",\"last_name\":\"Armstrong\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Assumenda quia ipsam\",\"city\":\"rajshahi\"}', '2026-03-15 08:34:16', '2026-03-15 09:55:28', NULL),
(2, 2, NULL, 0, 'retail', 'ORD-69B67DE5EFDCE', NULL, 67.50, 0.00, 0.00, 127.50, 'pending', 'bkash', 'unpaid', '{\"first_name\":\"Uriah\",\"last_name\":\"Hunter\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Mirpur Dhaka\",\"city\":\"chittagong\"}', '2026-03-15 09:37:41', '2026-03-15 09:37:41', NULL),
(3, 2, NULL, 0, 'retail', 'ORD-69B67F063BFE0', NULL, 67.50, 0.00, 0.00, 127.50, 'pending', 'bkash', 'unpaid', '{\"first_name\":\"Gregory\",\"last_name\":\"Pruitt\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Mirpur DHaka\",\"city\":\"dhaka\"}', '2026-03-15 09:42:30', '2026-03-15 09:42:30', NULL),
(4, 2, NULL, 0, 'retail', 'ORD-69B67FF1E88F3', 'TRAN-69B67FF1ED821-4', 67.50, 0.00, 0.00, 127.50, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Margaret\",\"last_name\":\"Price\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Sed aliquam asperior\",\"city\":\"rajshahi\"}', '2026-03-15 09:46:25', '2026-03-15 09:46:26', NULL),
(5, 2, NULL, 0, 'retail', 'ORD-69B680881D046', 'TRAN-69B68088221B6-5', 67.50, 0.00, 0.00, 127.50, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Lev\",\"last_name\":\"Cardenas\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Reprehenderit conse\",\"city\":\"dhaka\"}', '2026-03-15 09:48:56', '2026-03-15 09:48:56', NULL),
(6, 2, NULL, 0, 'retail', 'ORD-69B6819105F8B', 'TRAN-69B681910B553-6', 67.50, 0.00, 0.00, 127.50, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Megan\",\"last_name\":\"Banks\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Esse amet et non au\",\"city\":\"sylhet\"}', '2026-03-15 09:53:21', '2026-03-15 09:53:21', NULL),
(7, 2, NULL, 0, 'retail', 'ORD-69B681D504FB5', 'TRAN-69B681D50B9F2-7', 67.50, 0.00, 0.00, 127.50, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Eugenia\",\"last_name\":\"May\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Voluptates duis in q\",\"city\":\"dhaka\"}', '2026-03-15 09:54:29', '2026-03-15 09:54:29', NULL),
(8, 2, NULL, 0, 'retail', 'ORD-69B6834903720', 'TRAN-69B683490894D-8', 67.50, 0.00, 0.00, 127.50, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Cailin\",\"last_name\":\"Gould\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Dhakar\",\"city\":\"sylhet\"}', '2026-03-15 10:00:41', '2026-03-15 10:00:41', NULL),
(9, 2, NULL, 0, 'retail', 'ORD-69B684AB256FF', 'TRAN-69B684AB2B24E-9', 67.50, 0.00, 0.00, 127.50, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Julie\",\"last_name\":\"Madden\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Aliqua Quam sequi c\",\"city\":\"dhaka\"}', '2026-03-15 10:06:35', '2026-03-15 10:06:35', NULL),
(10, 2, NULL, 0, 'retail', 'ORD-69B6866BD47B1', 'TRAN-69B6866BDA46F-10', 67.50, 0.00, 0.00, 127.50, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Briar\",\"last_name\":\"Bates\",\"email\":\"ashrafulinstasure@gmail.com\",\"phone\":\"01947713697\",\"address\":\"Odio excepturi porro\",\"city\":\"dhaka\"}', '2026-03-15 10:14:03', '2026-03-15 10:14:04', NULL),
(11, 2, NULL, 0, 'retail', 'ORD-69B686F0108E4', 'TRAN-69B689B2DC72F-11', 50.00, 0.00, 0.00, 110.00, 'shipped', 'sslcommerz', 'paid', '{\"first_name\":\"Nolan\",\"last_name\":\"Sosa\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Id eius similique nu\",\"city\":\"sylhet\"}', '2026-03-15 10:16:16', '2026-03-15 10:29:58', NULL),
(12, 2, NULL, 0, 'retail', 'ORD-69B687EEC5264', 'TRAN-69B687EECBA8F-12', 50.00, 0.00, 0.00, 110.00, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"May\",\"last_name\":\"Jarvis\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Pariatur Commodo re\",\"city\":\"chittagong\"}', '2026-03-15 10:20:30', '2026-03-15 10:20:40', NULL),
(13, 2, NULL, 0, 'retail', 'ORD-69B7982EB6926', NULL, 198.00, 0.00, 0.00, 258.00, 'pending', 'card', 'unpaid', '{\"first_name\":\"Cyrus\",\"last_name\":\"Barber\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"In eveniet facilis\",\"city\":\"dhaka\"}', '2026-03-16 05:42:06', '2026-03-16 05:42:06', NULL),
(14, 2, NULL, 0, 'retail', 'ORD-69B798848C5AC', 'TRAN-69B79884918C8-14', 198.00, 0.00, 0.00, 258.00, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Cyrus\",\"last_name\":\"Barber\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"In eveniet facilis\",\"city\":\"dhaka\"}', '2026-03-16 05:43:32', '2026-03-16 05:43:44', NULL),
(15, 2, NULL, 0, 'retail', 'ORD-69B798E523158', 'TRAN-69B798E528AB4-15', 22.50, 0.00, 0.00, 82.50, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Margaret\",\"last_name\":\"Preston\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Elit molestiae cons\",\"city\":\"sylhet\"}', '2026-03-16 05:45:09', '2026-03-16 05:45:15', NULL),
(16, 2, NULL, 0, 'retail', 'ORD-69B7A8E0BDB0A', 'TRAN-69B7A8E0C2CE0-16', 280.00, 0.00, 0.00, 340.00, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Melissa\",\"last_name\":\"Neal\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Anim magna sapiente\",\"city\":\"chittagong\"}', '2026-03-16 06:53:20', '2026-03-16 06:53:26', NULL),
(17, 2, NULL, 0, 'retail', 'ORD-69B7A91D8B713', 'TRAN-69B7A91D91D17-17', 22.50, 0.00, 0.00, 82.50, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Latifah\",\"last_name\":\"Mcdaniel\",\"email\":\"bekotihuco@mailinator.com\",\"phone\":\"+1 (848) 722-3433\",\"address\":\"Saepe doloremque mai\",\"city\":\"khulna\"}', '2026-03-16 06:54:21', '2026-03-16 06:54:28', NULL),
(18, 2, NULL, 0, 'retail', 'ORD-69B7B00F725FD', 'TRAN-69B7B00F78CAD-18', 67.50, 0.00, 6.75, 120.75, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Jamal\",\"last_name\":\"Contreras\",\"email\":\"jenupypyca@mailinator.com\",\"phone\":\"+1 (228) 108-6744\",\"address\":\"Non ea illum non iu\",\"city\":\"chittagong\"}', '2026-03-16 07:23:59', '2026-03-16 07:24:05', 1),
(19, 2, NULL, 0, 'retail', 'ORD-69B7C27366FB7', 'TRAN-69B7C277DCA78-19', 22.50, 0.00, 2.25, 80.25, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Darrel\",\"last_name\":\"Campos\",\"email\":\"zefenatu@mailinator.com\",\"phone\":\"+1 (819) 809-7425\",\"address\":\"Itaque accusantium o\",\"city\":\"chittagong\"}', '2026-03-16 08:42:27', '2026-03-16 08:42:38', 1),
(20, 2, NULL, 0, 'retail', 'ORD-69B7C366F0DD6', 'TRAN-69B7C36703A11-20', 144.00, 0.00, 14.40, 189.60, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Riley\",\"last_name\":\"Salinas\",\"email\":\"pilim@mailinator.com\",\"phone\":\"+1 (424) 945-3328\",\"address\":\"Laboriosam consecte\",\"city\":\"rajshahi\"}', '2026-03-16 08:46:30', '2026-03-16 08:46:40', 1),
(21, 2, NULL, 0, 'retail', 'ORD-69C213D6A77A4', 'TRAN-69C213D6AD758-21', 22.50, 0.00, 2.25, 80.25, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Cruz\",\"last_name\":\"Farmer\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Voluptatem est place\",\"city\":\"rajshahi\"}', '2026-03-24 04:32:22', '2026-03-24 04:32:30', 1),
(22, 2, NULL, 0, 'retail', 'ORD-69C2332D7926E', 'TRAN-69C2332D7F615-22', 50.00, 0.00, 0.00, 110.00, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Kirestin\",\"last_name\":\"Dean\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"Do ut in sed optio\",\"city\":\"khulna\"}', '2026-03-24 06:46:05', '2026-03-24 06:46:16', NULL),
(23, 2, NULL, 0, 'retail', 'ORD-69C23A30DE92E', 'TRAN-69C23A30E7889-23', 63.00, 0.00, 6.30, 166.70, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"asdf\",\"last_name\":\"as delfj\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"asdfjasd\",\"city\":\"dhaka\"}', '2026-03-24 07:16:00', '2026-03-24 07:16:08', 1),
(24, 2, NULL, 0, 'retail', 'ORD-69C24997D4E20', 'TRAN-69C24997DB41C-24', 22.50, 0.00, 0.00, 132.50, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Serena\",\"last_name\":\"Francis\",\"email\":\"qohire@mailinator.com\",\"phone\":\"+1 (963) 426-9806\",\"address\":\"Enim eos nulla nost\",\"city\":\"sylhet\"}', '2026-03-24 08:21:43', '2026-03-24 08:21:55', NULL),
(25, 2, NULL, 0, 'retail', 'ORD-69C8FE949A849', 'TRAN-69C8FE949FFA6-25', 81.00, 0.00, 8.10, 142.90, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"asdfasdf\",\"last_name\":\"asdfasdf\",\"email\":\"ashrafulunisoft@gmail.com\",\"phone\":\"01859385787\",\"address\":\"DHaka\",\"city\":\"dhaka\"}', '2026-03-29 10:27:32', '2026-03-29 10:27:39', 1),
(26, 16, NULL, 0, 'retail', 'ORD-69C8FFEF537F5', 'TRAN-69C8FFEF591F0-26', 67.50, 0.00, 0.00, 137.50, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Natalie\",\"last_name\":\"Wallace\",\"email\":\"lokol@mailinator.com\",\"phone\":\"+1 (875) 657-6007\",\"address\":\"Similique consectetu\",\"city\":\"khulna\"}', '2026-03-29 10:33:19', '2026-03-29 10:33:26', NULL),
(27, 16, NULL, 0, 'retail', 'ORD-69C901957BE57', 'TRAN-69C9019581873-27', 63.00, 0.00, 0.00, 173.00, 'pending', 'sslcommerz', 'unpaid', '{\"first_name\":\"Carlos\",\"last_name\":\"Trujillo\",\"email\":\"hadanil@mailinator.com\",\"phone\":\"+1 (502) 612-2673\",\"address\":\"Mollitia vitae expli\",\"city\":\"dhaka\"}', '2026-03-29 10:40:21', '2026-03-29 10:40:21', NULL),
(28, 16, NULL, 0, 'retail', 'ORD-69C901DEAD5D7', 'TRAN-69C901E308DCC-28', 63.00, 0.00, 0.00, 173.00, 'cancelled', 'sslcommerz', 'failed', '{\"first_name\":\"Amery\",\"last_name\":\"Beck\",\"email\":\"gugohamiq@mailinator.com\",\"phone\":\"+1 (895) 368-7856\",\"address\":\"Unde voluptatem a iu\",\"city\":\"rajshahi\"}', '2026-03-29 10:41:34', '2026-03-29 10:41:46', NULL),
(29, 16, NULL, 0, 'retail', 'ORD-69C9021139CB3', 'TRAN-69C9021142B05-29', 650.00, 0.00, 0.00, 720.00, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Ciaran\",\"last_name\":\"House\",\"email\":\"wizo@mailinator.com\",\"phone\":\"+1 (726) 761-8308\",\"address\":\"Eu modi repudiandae\",\"city\":\"dhaka\"}', '2026-03-29 10:42:25', '2026-03-29 10:42:32', NULL),
(30, 16, NULL, 0, 'retail', 'ORD-69C902FBCEE70', 'TRAN-69C902FBD4EF7-30', 67.50, 0.00, 0.00, 137.50, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Myles\",\"last_name\":\"Hudson\",\"email\":\"fyrez@mailinator.com\",\"phone\":\"+1 (295) 168-2749\",\"address\":\"Vero qui magnam solu\",\"city\":\"rajshahi\"}', '2026-03-29 10:46:19', '2026-03-29 10:46:26', NULL),
(31, 2, NULL, 0, 'retail', 'ORD-69C912FC36585', 'TRAN-69C912FC3CAB9-31', 63.00, 0.00, 0.00, 133.00, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Bevis\",\"last_name\":\"Preston\",\"email\":\"vekunyl@mailinator.com\",\"phone\":\"+1 (694) 448-9246\",\"address\":\"Aperiam voluptas sol\",\"city\":\"sylhet\"}', '2026-03-29 11:54:36', '2026-03-29 11:54:42', NULL),
(32, 16, NULL, 0, 'retail', 'ORD-69CBAF9B5859E', 'TRAN-69CBAF9B5F229-32', 108.00, 0.00, 10.80, 207.20, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Lydia\",\"last_name\":\"Farrell\",\"email\":\"rybyfofapy@mailinator.com\",\"phone\":\"+1 (793) 164-4719\",\"address\":\"Suscipit vero aut mo\",\"city\":\"sylhet\"}', '2026-03-31 11:27:23', '2026-03-31 11:27:29', 1);

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
(12, 12, 86, 50.00, 1, '2026-03-15 10:20:30', '2026-03-15 10:20:30'),
(13, 13, 72, 198.00, 1, '2026-03-16 05:42:06', '2026-03-16 05:42:06'),
(14, 14, 72, 198.00, 1, '2026-03-16 05:43:32', '2026-03-16 05:43:32'),
(15, 15, 104, 22.50, 1, '2026-03-16 05:45:09', '2026-03-16 05:45:09'),
(16, 16, 73, 280.00, 1, '2026-03-16 06:53:20', '2026-03-16 06:53:20'),
(17, 17, 104, 22.50, 1, '2026-03-16 06:54:21', '2026-03-16 06:54:21'),
(18, 18, 100, 67.50, 1, '2026-03-16 07:23:59', '2026-03-16 07:23:59'),
(19, 19, 104, 22.50, 1, '2026-03-16 08:42:27', '2026-03-16 08:42:27'),
(20, 20, 52, 144.00, 1, '2026-03-16 08:46:30', '2026-03-16 08:46:30'),
(21, 21, 104, 22.50, 1, '2026-03-24 04:32:22', '2026-03-24 04:32:22'),
(22, 22, 94, 50.00, 1, '2026-03-24 06:46:05', '2026-03-24 06:46:05'),
(23, 23, 99, 63.00, 1, '2026-03-24 07:16:00', '2026-03-24 07:16:00'),
(24, 24, 104, 22.50, 1, '2026-03-24 08:21:43', '2026-03-24 08:21:43'),
(25, 25, 3, 81.00, 1, '2026-03-29 10:27:32', '2026-03-29 10:27:32'),
(26, 26, 100, 67.50, 1, '2026-03-29 10:33:19', '2026-03-29 10:33:19'),
(27, 27, 99, 63.00, 1, '2026-03-29 10:40:21', '2026-03-29 10:40:21'),
(28, 28, 99, 63.00, 1, '2026-03-29 10:41:34', '2026-03-29 10:41:34'),
(29, 29, 81, 650.00, 1, '2026-03-29 10:42:25', '2026-03-29 10:42:25'),
(30, 30, 100, 67.50, 1, '2026-03-29 10:46:19', '2026-03-29 10:46:19'),
(31, 31, 99, 63.00, 1, '2026-03-29 11:54:36', '2026-03-29 11:54:36'),
(32, 32, 40, 108.00, 1, '2026-03-31 11:27:23', '2026-03-31 11:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('amshuvo64@gmail.com', '$2y$12$yiXpADNvcO2cN4r/RZW6zOY1ETVM6xaq1rNxgzLpgt6e.fU./EHfC', '2026-03-25 09:20:08');

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
(2, 'BRD-001', 'Premium Milk Bread', 'প্রিমিয়াম মিল্ক ব্রেড / দুধের রুটি', 'premium-milk-bread', 'Rich and creamy milk bread made with fresh dairy milk. Soft texture with a subtle sweetness that melts in your mouth. Perfect for breakfast toast or sandwiches.', 'তাজা দুধ দিয়ে তৈরি সমৃদ্ধ ও ক্রিমি মিল্ক ব্রেড। নরম টেক্সচার এবং হালকা মিষ্টি স্বাদ যা মুখে গলে যায়। সকালের টোস্ট বা স্যান্ডউইচের জন্য আদর্শ।', 80.00, NULL, 49, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(3, 'BRD-002', 'Whole Wheat Bread', 'গমের আটার রুটি', 'whole-wheat-bread', '100% whole wheat bread packed with fiber and nutrients. Dense, hearty texture with a nutty flavor. Ideal for health-conscious individuals.', 'আঁশ ও পুষ্টিতে ভরপুর ১০০% গমের আটার রুটি। ঘন, পুষ্টিকর টেক্সচার বাদামি স্বাদ সহ। স্বাস্থ্য সচেতনদের জন্য উপযোগী।', 90.00, 81.00, 58, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(4, 'BRD-003', 'Brown Bread', 'ব্রাউন ব্রেড / গুড়ের রুটি', 'brown-bread', 'Nutritious brown bread made from whole grain wheat flour. Rich in fiber with a satisfying dense texture and earthy taste.', 'শস্য গমের আটা থেকে তৈরি পুষ্টিকর ব্রাউন ব্রেড। আঁশে সমৃদ্ধ, ঘন টেক্সচার এবং মাটির স্বাদ।', 85.00, NULL, 20, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(5, 'BRD-004', 'Garlic Bread', 'রসুনের রুটি / রসুন ব্রেড', 'garlic-bread', 'Aromatic garlic bread infused with roasted garlic butter. Crispy crust with soft interior. Perfect accompaniment to pasta or soups.', 'রোস্টেড রসুন মাখন দিয়ে সুগন্ধযুক্ত রসুন রুটি। মচমচে আবরণ এবং নরম ভেতর। পাস্তা বা স্যুপের সাথে উত্তম।', 120.00, NULL, 37, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(6, 'BRD-005', 'Dinner Rolls / Buns', 'বান / ডিনার রোল', 'dinner-rolls-buns', 'Soft, pillowy dinner rolls perfect for family meals. Golden-brown crust with a fluffy interior. Great for dipping in gravies.', 'পরিবারের খাবারের জন্য নরম, তুলতুলে ডিনার রোল। সোনালি-বাদামী আবরণ এবং মখমলে ভেতর। তরকারির সাথে ডুবিয়ে খাওয়ার জন্য চমৎকার।', 60.00, NULL, 71, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(7, 'BRD-006', 'Fruit Bread', 'ফ্রুট ব্রেড', 'fruit-bread', 'Colorful fruit bread loaded with dried fruits and berries. Sweet, tangy flavor with every bite. Excellent for tea-time snacking.', 'শুকনো ফল ও বেরিতে ভরপুর রঙিন ফ্রুট ব্রেড। প্রতিটি কামড়ে মিষ্টি টক স্বাদ। চায়ের সাথে জলখাবারের জন্য দুর্দান্ত।', 100.00, NULL, 51, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(8, 'BRD-007', 'Cheese Bread', 'চিজ ব্রেড', 'cheese-bread', 'Savory cheese bread baked with premium cheddar. Golden crust with melted cheese pockets throughout. A cheesy delight.', 'প্রিমিয়াম চেডার দিয়ে বেক করা সুস্বাদু চিজ ব্রেড। সোনালি আবরণ এবং গলিত পনিরের পকেট। পনিরপ্রেমীদের আনন্দ।', 110.00, NULL, 29, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(9, 'BRD-008', 'Multigrain Bread', 'মাল্টিগ্রেইন ব্রেড / মাল্টিগ্রেইন আটার রুটি', 'multigrain-bread', 'Wholesome multigrain bread with oats, flaxseeds, and millets. Nutrient-dense with a nutty, complex flavor profile.', 'ওটস, তিসি বীজ এবং বাজরা সহ পুষ্টিকর মাল্টিগ্রেন ব্রেড। পুষ্টিতে ঘন এবং বাদামি জটিল স্বাদ।', 130.00, 117.00, 14, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(10, 'BRD-009', 'Butter Bread', 'মাখ্দন রুটি / মাখন রুটি', 'butter-bread', 'Rich butter bread made with pure clarified butter. Soft, moist crumb with a buttery aroma. Simple yet irresistible.', 'বিশুদ্ধ ঘি দিয়ে তৈরি সমৃদ্ধ বাটার ব্রেড। নরম, আর্দ্র এবং মাখনের সুগন্ধ। সহজ কিন্তু অপ্রতিরোধ্য।', 95.00, 85.50, 98, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(11, 'BRD-010', 'Burger Bun', 'বার্গার বান', 'burger-bun', 'Light and fluffy burger buns with sesame seed topping. Perfectly sized for homemade burgers and sliders.', 'তিল বীজ টপিং সহ হালকা ও নরম বার্গার বান। বাড়িতে বানানো বার্গারের জন্য পারফেক্ট।', 70.00, 63.00, 84, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(12, 'BRD-011', 'Toast Bread', 'টোস্ট রুটি', 'toast-bread', 'Classic white toast bread with a fine, even texture. Perfectly slices for morning toast or sandwiches.', 'সূক্ষ্ম, সমান টেক্সচার সহ ক্লাসিক সাদা টোস্ট ব্রেড। সকালের টোস্ট বা স্যান্ডউইচের জন্য উপযোগী।', 75.00, 67.50, 12, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(13, 'BRD-012', 'Bread Loaf', 'রুটির লোফ', 'bread-loaf', 'Traditional bread loaf with a rustic crust. Dense and satisfying, perfect for hearty appetites.', 'গ্রাম্য আবরণ সহ ঐতিহ্যবাহী ব্রেড লোফ। ঘন এবং পরিতৃপ্তিকর।', 85.00, 76.50, 34, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(14, 'BRD-013', 'Bread Slices', 'রুটির স্লাইস', 'bread-slices', 'Pre-sliced bread for convenience. Uniform slices ideal for quick sandwiches and toast.', 'সুবিধার জন্য পূর্ব-কাটা রুটি। দ্রুত স্যান্ডউইচ এবং টোস্টের জন্য সমান স্লাইস।', 80.00, NULL, 80, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(15, 'BRD-014', 'Milk Bread (Premium)', 'দুধের পাউরুটি (নরম)', 'milk-bread-premium', 'Extra creamy premium milk bread with double milk content. Ultra-soft texture, perfect for kids and elderly.', 'দ্বিগুণ দুধ সমৃদ্ধ অতিরিক্ত ক্রিমি প্রিমিয়াম মিল্ক ব্রেড। শিশু এবং বয়স্কদের জন্য অতি-নরম টেক্সচার।', 90.00, NULL, 70, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(16, 'CAK-001', 'Vanilla Sponge Cake', 'ভ্যানিলা স্পঞ্জ কেক', 'vanilla-sponge-cake', 'Light and airy vanilla sponge cake. Moist crumb with classic vanilla bean flavor. Perfect base for custom decorations.', 'হালকা ও এয়ারি ভ্যানিলা স্পঞ্জ কেক। ক্লাসিক ভ্যানিলা বিন স্বাদ সহ আর্দ্র ক্রাম্ব। কাস্টম সাজসজ্জার জন্য আদর্শ বেস।', 450.00, NULL, 24, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(17, 'CAK-002', 'Chocolate Sponge Cake', 'চকোলেট স্পঞ্জ কেক', 'chocolate-sponge-cake', 'Rich chocolate sponge made with premium cocoa. Deep chocolate flavor with a moist, tender crumb.', 'প্রিমিয়াম কোকো দিয়ে তৈরি সমৃদ্ধ চকলেট স্পঞ্জ। আর্দ্র, নরম ক্রাম্ব সহ গভীর চকলেট স্বাদ।', 500.00, NULL, 86, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(18, 'CAK-003', 'Black Forest Cake', 'ব্ল্যাক ফরেস্ট কেক', 'black-forest-cake', 'Classic black forest cake layered with whipped cream and cherry filling. Decorated with chocolate shavings.', 'হুইপড ক্রিম এবং চেরি ফিলিং স্তরযুক্ত ক্লাসিক ব্ল্যাক ফরেস্ট কেক। চকলেট শেভিংস দিয়ে সজ্জিত।', 650.00, NULL, 11, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(19, 'CAK-004', 'Marble Cake', 'মার্বল কেক / মার্বেল কেক', 'marble-cake', 'Swirled marble cake combining vanilla and chocolate batters. Beautiful pattern with dual flavors.', 'ভ্যানিলা এবং চকলেট ব্যাটার মিশ্রিত সোয়ার্লড মার্বেল কেক। দ্বৈত স্বাদ সুন্দর প্যাটার্ন।', 550.00, NULL, 59, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(20, 'CAK-005', 'Pound Cake', 'পাউন্ড কেক', 'pound-cake', 'Dense, buttery pound cake with a fine crumb. Rich flavor that improves with age. Classic tea-time companion.', 'সূক্ষ্ম ক্রাম্ব সহ ঘন, মাখনযুক্ত পাউন্ড কেক। বয়সের সাথে সমৃদ্ধ স্বাদ। চায়ের সময়ের ক্লাসিক সঙ্গী।', 480.00, 432.00, 48, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(21, 'CAK-006', 'Chocolate Truffle Cake', 'চকোলেট ট্রাফল কেক / ট্রাফেল কেক', 'chocolate-truffle-cake', 'Decadent chocolate truffle cake with ganache frosting. Intensely chocolatey with a velvety smooth texture.', 'গ্যানাচে ফ্রস্টিং সহ মুখরোচক চকলেট ট্রাফল কেক। মখমলে মসৃণ টেক্সচার সহ তীব্র চকলেটি।', 750.00, NULL, 99, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(22, 'CAK-007', 'Red Velvet Cake', 'রেড ভেলভেট কেক', 'red-velvet-cake', 'Stunning red velvet cake with cream cheese frosting. Subtle cocoa flavor with a beautiful crimson color.', 'ক্রিম চিজ ফ্রস্টিং সহ অসাধারণ রেড ভেলভেট কেক। সুন্দর কrimসন রঙ সহ হালকা কোকো স্বাদ।', 700.00, 630.00, 81, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(23, 'CAK-008', 'Lemon Pound Cake', 'লেমন পাউন্ড কেক', 'lemon-pound-cake', 'Zesty lemon pound cake bursting with fresh citrus flavor. Moist texture with a tangy lemon glaze.', 'তাজা সাইট্রাস স্বাদে পূর্ণ জেস্টি লেবু পাউন্ড কেক। টক লেবু গ্লেজ সহ আর্দ্র টেক্সচার।', 520.00, 468.00, 84, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(24, 'CAK-009', 'Coffee Cake', 'কফি কেক', 'coffee-cake', 'Aromatic coffee cake infused with espresso. Perfect for coffee lovers with a rich, bold taste.', 'এস্প্রেসো ইনফিউজড সুগন্ধযুক্ত কফি কেক। সমৃদ্ধ, বোল্ড স্বাদ সহ কফিপ্রেমীদের জন্য আদর্শ।', 580.00, NULL, 23, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(25, 'CAK-010', 'Eid Special Cake', 'ঈদ স্পেশাল কেক', 'eid-special-cake', 'Special Eid cake decorated with festive designs. Sweet celebration treat perfect for sharing.', 'উৎসবমুখর ডিজাইনে সজ্জিত বিশেষ ঈদ কেক। ভাগ করে খাওয়ার জন্য মিষ্টি উদযাপন।', 1200.00, NULL, 51, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(26, 'CAK-011', 'Pohela Boishakh Special', 'পহেলা বৈশাখ স্পেশাল', 'pohela-boishakh-special', 'Traditional Bengali New Year special cake. Decorated with cultural motifs and festive colors.', 'ঐতিহ্যবাহী বাংলা নববর্ষ বিশেষ কেক। সাংস্কৃতিক মোটিফ এবং উৎসবমুখর রঙে সজ্জিত।', 950.00, NULL, 62, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(27, 'CAK-012', 'Birthday Cake - Basic', 'জন্মদিনের কেক - বেসিক', 'birthday-cake-basic', 'Classic birthday cake customizable with name and age. Available in various flavors with colorful frosting.', 'নাম ও বয়স অনুযায়ী কাস্টমাইজেবল ক্লাসিক জন্মদিনের কেক। বিভিন্ন ফ্লেভারে রঙিন ফ্রস্টিং সহ।', 850.00, 765.00, 82, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(28, 'CAK-013', 'Wedding Cake - 3 Tier', 'বিয়ের কেক - ৩ স্তর', 'wedding-cake-3-tier', 'Elegant 3-tier wedding cake masterpiece. Intricate design with premium decorations for your special day.', 'সুক্ষ্ম ডিজাইনের মার্জিত ৩-টায়ার বিয়ের কেক। বিশেষ দিনের জন্য প্রিমিয়াম সাজসজ্জা।', 3500.00, NULL, 67, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(29, 'CAK-014', 'Cream Cake', 'ক্রিম কেক / মালাই কেক', 'cream-cake', 'Rich cream cake with layers of fresh cream. Light, fluffy and perfect for any celebration.', 'তাজা ক্রিমের স্তর সমৃদ্ধ ক্রিম কেক। হালকা, নরম এবং যেকোনো উদযাপনের জন্য আদর্শ।', 600.00, 540.00, 60, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(30, 'CAK-015', 'Fruit Cake', 'ফ্রুট কেক / ফ্রুট টপিং কেক', 'fruit-cake', 'Fruit-loaded cake topped with seasonal fresh fruits. Refreshing taste with natural sweetness.', 'মৌসুমি তাজা ফল দিয়ে টপ করা ফ্রুট কেক। প্রাকৃতিক মিষ্টতায় সতেজ স্বাদ।', 680.00, NULL, 97, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(31, 'CAK-016', 'Anniversary Cake', 'বার্ষিকা কেক / স্মৃতি দিনের কেক', 'anniversary-cake', 'Romantic anniversary cake with elegant decorations. Perfect for celebrating years of togetherness.', 'মার্জিত সাজসজ্জায় রোমান্টিক অ্যানিভার্সারি কেক। একসাথে কাটানো বছর উদযাপনের জন্য পারফেক্ট।', 1500.00, NULL, 63, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(32, 'CAK-017', 'Heart Shape Cake', 'হার্ট শেপ কেক / ভালোবাসা কেক', 'heart-shape-cake', 'Heart-shaped cake symbolizing love and affection. Ideal for Valentine Day or romantic occasions.', 'ভালোবাসা ও স্নেহের প্রতীক হার্ট আকৃতির কেক। ভ্যালেন্টাইন ডে বা রোমান্টিক অনুষ্ঠানের জন্য আদর্শ।', 720.00, NULL, 49, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(33, 'CAK-018', 'Square Shape Cake', 'স্কয়ার শেপ কেক', 'square-shape-cake', 'Square-shaped cake with clean, modern design. Easy to slice and serve for gatherings.', 'পরিষ্কার, আধুনিক ডিজাইনের বর্গাকার কেক। সমাবেশে কাটা এবং পরিবেশন করা সহজ।', 650.00, NULL, 92, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(34, 'CAK-019', 'Round Shape Cake', 'গোলাকার শেপ কেক', 'round-shape-cake', 'Classic round cake suitable for any occasion. Versatile design allows for various decorations.', 'যেকোনো অনুষ্ঠানের জন্য ক্লাসিক গোলাকার কেক। বিভিন্ন সাজসজ্জার জন্য বহুমুখী ডিজাইন।', 650.00, 585.00, 83, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(35, 'CAK-020', 'Custom Cake', 'কাস্টম কেক / স্পেশাল ডিজাইন কেক', 'custom-cake', 'Fully customizable cake for your unique vision. Choose flavors, design, and message for personalization.', 'আপনার অনন্য ধারণার জন্য সম্পূর্ণ কাস্টমাইজেবল কেক। পছন্দের ফ্লেভার, ডিজাইন এবং বার্তা।', 2000.00, 1800.00, 87, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(36, 'CAK-021', 'Cartoon Cake', 'কার্টুন কেক', 'cartoon-cake', 'Fun cartoon-themed cake for children birthdays. Colorful design with popular character decorations.', 'শিশুদের জন্মদিনের মজার কার্টুন থিম কেক। জনপ্রিয় চরিত্র সাজসজ্জা সহ রঙিন ডিজাইন।', 1800.00, 1620.00, 13, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(37, 'CAK-022', 'Photo Cake', 'ফটো কেক / ছবি প্রিন্ট কেক', 'photo-cake', 'Personalized photo cake with edible image printing. A unique way to celebrate special memories.', 'খাওয়ার যোগ্য ছবি প্রিন্টিং সহ পার্সোনালাইজড ফটো কেক। বিশেষ স্মৃতি উদযাপনের অনন্য উপায়।', 1600.00, 1440.00, 74, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(38, 'CAK-023', 'Fruit Flavored Cake', 'ফ্রুট ফ্লেভার কেক', 'fruit-flavored-cake', 'Refreshing fruit-flavored cake with natural fruit extracts. Available in strawberry, mango, orange flavors.', 'প্রাকৃতিক ফলের এক্সট্র্যাক্ট সহ সতেজ ফ্রুট ফ্লেভার্ড কেক। স্ট্রবেরি, আম, কমলার স্বাদে।', 720.00, NULL, 47, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(39, 'CAK-024', 'Sponge Cake (Generic)', 'স্পঞ্জ কেক / ফোম কেক', 'sponge-cake-generic', 'Light sponge cake with versatile flavor. Perfect base for trifles, tiramisu, or layered desserts.', 'বহুমুখী স্বাদের হালকা স্পঞ্জ কেক। ট্রাইফল, টিরামিসু বা লেয়ার্ড ডেজার্টের আদর্শ বেস।', 420.00, 378.00, 81, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(40, 'CKI-001', 'Butter Cookies', 'মাখনের বিস্কুট / বাটার কুকি', 'butter-cookies', 'Classic butter cookies with rich, creamy taste. Melt-in-your-mouth texture from pure butter.', 'সমৃদ্ধ, ক্রিমি স্বাদের ক্লাসিক বাটার কুকিজ। বিশুদ্ধ মাখন থেকে মুখে গলে যাওয়া টেক্সচার।', 120.00, 108.00, 75, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(41, 'CKI-002', 'Chocolate Chip Cookies', 'চকোলেট চিপ কুকি', 'chocolate-chip-cookies', 'Chewy chocolate chip cookies loaded with premium chocolate chunks. Crispy edges, soft center.', 'প্রিমিয়াম চকলেট চাঙ্কসে ভরা চিউই চকলেট চিপ কুকিজ। মচমচে প্রান্ত, নরম কেন্দ্র।', 150.00, 135.00, 18, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(42, 'CKI-003', 'Digestive Biscuits', 'ডাইজেস্টিভ বিস্কুট', 'digestive-biscuits', 'Wholesome digestive biscuits rich in fiber. Perfect healthy snack with tea or milk.', 'আঁশে সমৃদ্ধ পুষ্টিকর ডাইজেস্টিভ বিস্কুট। চা বা দুধের সাথে স্বাস্থ্যকর স্ন্যাকস।', 100.00, 90.00, 14, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(43, 'CKI-004', 'Nankhatai', 'নানখাতাই', 'nankhatai', 'Traditional Indian nankhatai with cardamom flavor. Crumbly texture, perfect for festive occasions.', 'এলাচ স্বাদের ঐতিহ্যবাহী ভারতীয় নানখাটাই। ঝরঝরে টেক্সচার, উৎসবমুখর অনুষ্ঠানের জন্য আদর্শ।', 130.00, NULL, 91, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(44, 'CKI-005', 'Cashew Cookies', 'কাজু কুকি / কাজু বাদাম কুকি', 'cashew-cookies', 'Premium cashew cookies with generous cashew pieces. Rich, buttery taste with satisfying crunch.', 'প্রচুর কাজু টুকরো সহ প্রিমিয়াম কাজু কুকিজ। সমৃদ্ধ, মাখনি স্বাদ এবং তৃপ্তিকর ক্রাঞ্চ।', 180.00, 162.00, 27, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(45, 'CKI-006', 'Almond Cookie', 'বাদাম কুকি / বাদাম বিস্কুট', 'almond-cookie', 'Almond cookies with sliced almonds and almond extract. Nutty flavor with a delicate crunch.', 'কাটা বাদাম এবং বাদাম এক্সট্র্যাক্ট সহ বাদামি কুকিজ। মচমচে টেক্সচার সহ বাদামি স্বাদ।', 170.00, NULL, 41, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(46, 'CKI-007', 'Coconut Cookie', 'নারিকেল কুকি / নারকেল বিস্কুট', 'coconut-cookie', 'Tropical coconut cookies with desiccated coconut. Sweet, chewy, and full of coconut flavor.', 'শুকনো নারকেল সহ ট্রপিক্যাল নারকেল কুকিজ। মিষ্টি, চিউই এবং নারকেল স্বাদে পূর্ণ।', 140.00, 126.00, 12, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(47, 'CKI-008', 'Oats Cookie', 'ওটস কুকি / ওটস বিস্কুট', 'oats-cookie', 'Healthy oat cookies with rolled oats and honey. Fiber-rich alternative for guilt-free snacking.', 'রোলড ওটস এবং মধু সহ স্বাস্থ্যকর ওট কুকিজ। নির্দোষ স্ন্যাকিংয়ের জন্য আঁশযুক্ত বিকল্প।', 135.00, 121.50, 25, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(48, 'CKI-009', 'Sugar Cookie', 'চিনি কুকি', 'sugar-cookie', 'Classic sugar cookies with a crisp exterior and soft interior. Simple sweetness perfect for any time.', 'মচমচে বাইরে এবং নরম ভেতরের ক্লাসিক সুগার কুকিজ। যেকোনো সময়ের জন্য সাধারণ মিষ্টতা।', 110.00, 99.00, 32, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(49, 'CKI-010', 'Cream Biscuit', 'ক্রিম বিস্কুট / মালাই বিস্কুট', 'cream-biscuit', 'Cream-filled sandwich biscuits with vanilla cream. Crunchy biscuit with smooth creamy center.', 'ভ্যানিলা ক্রিম সহ ক্রিম-ফিলড স্যান্ডউইচ বিস্কুট। মসৃণ ক্রিমি সেন্টার সহ মচমচে বিস্কুট।', 125.00, NULL, 99, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(50, 'CKI-011', 'Coconut Biscuit', 'নারিকেল বিস্কুট', 'coconut-biscuit', 'Double coconut biscuits with coconut in dough and topping. Intense coconut flavor throughout.', 'ডো এবং টপিং উভয়ে নারকেল সহ ডাবল নারকেল বিস্কুট। সম্পূর্ণ জুড়ে তীব্র নারকেল স্বাদ।', 130.00, NULL, 38, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(51, 'CKI-012', 'Jam Biscuit', 'জাম বিস্কুট / জাম পুরেল', 'jam-biscuit', 'Jam-filled biscuits with fruit preserve center. Sweet jam surprise in every bite.', 'ফলের জ্যাম সেন্টার সহ জ্যাম-ফিলড বিস্কুট। প্রতিটি কামড়ে মিষ্টি জ্যাম সারপ্রাইজ।', 140.00, 126.00, 58, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(52, 'CKI-013', 'Assorted Biscuits', 'মিক্সড বিস্কুট / বিস্কুট প্যাকেট', 'assorted-biscuits', 'Assorted biscuit pack with variety of flavors. Perfect gift pack for biscuit lovers.', 'বিভিন্ন স্বাদের বিস্কুটের অ্যাসর্টেড প্যাক। বিস্কুটপ্রেমীদের জন্য আদর্শ উপহার প্যাক।', 160.00, 144.00, 97, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(53, 'SWT-001', 'Roshogolla (6 pcs)', 'রসগোল্লা (৬ পিস)', 'roshogolla-6-pcs', 'Pack of 6 soft, spongy roshogollas soaked in sugar syrup. Classic Bengali sweet with melt-in-mouth texture.', 'চিনির সিরায় ভেজানো ৬টি নরম, স্পঞ্জি রসগোল্লা। মুখে গলে যাওয়া টেক্সচার সহ ক্লাসিক বাঙালি মিষ্টি।', 120.00, NULL, 89, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(54, 'SWT-002', 'Roshogolla (12 pcs)', 'রসগোল্লা (১২ পিস)', 'roshogolla-12-pcs', 'Pack of 12 roshogollas perfect for family gatherings. Freshly made with pure milk and quality sugar.', 'পারিবারিক আয়োজনের জন্য ১২টি রসগোল্লার প্যাক। বিশুদ্ধ দুধ এবং মানসম্মত চিনি দিয়ে তাজা তৈরি।', 220.00, NULL, 96, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(55, 'SWT-003', 'Sandesh (10 pcs)', 'সন্দেশ (১০ পিস)', 'sandesh-10-pcs', 'Pack of 10 sandesh pieces, light and aromatic. Made with fresh chhena and cardamom essence.', '১০টি সন্দেশের প্যাক, হালকা এবং সুগন্ধযুক্ত। তাজা ছানা এবং এলাচ এসেন্স দিয়ে তৈরি।', 180.00, 162.00, 35, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(56, 'SWT-004', 'Sandesh (Cream)', 'ক্রিম সন্দেশ / মালাই সন্দেশ', 'sandesh-cream', 'Creamy sandesh variant with rich cream filling. Smooth texture with subtle sweetness.', 'সমৃদ্ধ ক্রিম ফিলিং সহ ক্রিমি সন্দেশ ভ্যারিয়েন্ট। হালকা মিষ্টতা সহ মসৃণ টেক্সচার।', 220.00, NULL, 51, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(57, 'SWT-005', 'Sandesh (Pistachio)', 'কাজু সন্দেশ / পিস্তাচিও সন্দেশ', 'sandesh-pistachio', 'Premium pistachio sandesh topped with crushed pistachios. Nutty flavor with elegant presentation.', 'কাটা পেস্তা দিয়ে টপ করা প্রিমিয়াম পেস্তা সন্দেশ। মার্জিত উপস্থাপনা সহ বাদামি স্বাদ।', 280.00, NULL, 43, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(58, 'SWT-006', 'Sandesh (Saffron)', 'জাফরান সন্দেশ', 'sandesh-saffron', 'Royal saffron sandesh infused with premium kashmiri saffron. Aromatic and luxurious sweet.', 'প্রিমিয়াম কাশ্মীরি জাফরান ইনফিউজড রাজকীয় জাফরান সন্দেশ। সুগন্ধি এবং বিলাসবহুল মিষ্টি।', 260.00, 234.00, 26, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(59, 'SWT-007', 'Gulab Jamun (12 pcs)', 'গোলাপ জামুন (১২ পিস)', 'gulab-jamun-12-pcs', 'Pack of 12 gulab jamuns soaked in rose-flavored syrup. Deep-fried milk dumplings with divine taste.', 'গোলাপ সিরায় ভেজানো ১২টি গোলাপ জামুনের প্যাক। ঐশ্বরিয় স্বাদের ডিপ-ফ্রাইড দুধের ডাম্পলিং।', 180.00, 162.00, 54, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(60, 'SWT-008', 'Gulab Jamun (Rose)', 'গোলাপ গোলাব জামুন / লাল গোলাব', 'gulab-jamun-rose', 'Special rose gulab jamun with enhanced rose essence. Aromatic sweet perfect for special occasions.', 'বাড়তি গোলাপ এসেন্স সহ বিশেষ রোজ গোলাপ জামুন। বিশেষ অনুষ্ঠানের জন্য সুগন্ধি মিষ্টি।', 200.00, NULL, 38, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(61, 'SWT-009', 'Kalo Jam', 'কালো জাম', 'kalo-jam', 'Dark, dense kalo jam with deep caramelized flavor. Rich and indulgent Bengali sweet delicacy.', 'গভীর ক্যারামেলাইজড স্বাদের গাঢ়, ঘন কালো জাম। সমৃদ্ধ বাঙালি মিষ্টি সুস্বাদী।', 160.00, 144.00, 25, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(62, 'SWT-010', 'Kalo Jam (24 pcs)', 'কালো জাম (২৪ পিস)', 'kalo-jam-24-pcs', 'Family pack of 24 kalo jam pieces. Perfect for large gatherings and festivals.', '২৪টি কালো জামের পারিবারিক প্যাক। বড় আয়োজন এবং উৎসবের জন্য আদর্শ।', 300.00, 270.00, 42, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(63, 'SWT-011', 'Khejur', 'খেজুর', 'khejur', 'Premium date-filled khejur sweet. Natural sweetness from quality dates with authentic taste.', 'প্রিমিয়াম খেজুর ভর্তি খেজুর মিষ্টি। মানসম্মত খেজুর থেকে প্রাকৃতিক মিষ্টতা।', 180.00, NULL, 39, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(64, 'SWT-012', 'Roshmalai', 'রশমালাই', 'roshmalai', 'Soft roshmalai balls floating in sweet milk cream. Delicate sweet with heavenly taste.', 'মিষ্টি দুধের ক্রিমে ভাসমান নরম রসমালাই বল। ঐশ্বরিয় স্বাদের সূক্ষ্ম মিষ্টি।', 220.00, 198.00, 78, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(65, 'SWT-013', 'Mawa', 'মোয়া / মাওয়া', 'mawa', 'Traditional mawa sweet made with reduced milk. Dense, rich texture with concentrated milk flavor.', 'জমাট দুধ দিয়ে তৈরি ঐতিহ্যবাহী মাওয়া। কনসেনট্রেটেড দুধের স্বাদ সহ ঘন, সমৃদ্ধ টেক্সচার।', 300.00, NULL, 20, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(66, 'SWT-014', 'Shingara', 'শিঙারা / সিংডা', 'shingara', 'Crispy shingara with spiced vegetable or meat filling. Popular Bengali snack with flaky crust.', 'মশলাদার সবজি বা মাংস পুর সহ মচমচে সিঙাড়া। স্তরযুক্ত আবরণ সহ জনপ্রিয় বাঙালি স্ন্যাকস।', 40.00, 36.00, 95, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(67, 'SWT-015', 'Jalebi', 'জিলাপি', 'jalebi', 'Crispy, coiled jalebi soaked in saffron syrup. Bright orange sweet with tangy-sweet taste.', 'জাফরান সিরায় ভেজানো মচমচে, কুণ্ডলী জিলাপি। টক-মিষ্টি স্বাদের উজ্জ্বল কমলা মিষ্টি।', 100.00, NULL, 70, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(68, 'SWT-016', 'Jalebi (Thin)', 'চুনা জিলাপি', 'jalebi-thin', 'Thin, delicate jalebi with extra crispiness. Lighter version of the classic sweet.', 'অতিরিক্ত মচমচে পাতলা, সূক্ষ্ম জিলাপি। ক্লাসিক মিষ্টির হালকা সংস্করণ।', 110.00, NULL, 96, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(69, 'SWT-017', 'Chamcham', 'চমচম', 'chamcham', 'Colorful chamcham sweet with creamy coating. Soft, spongy texture in vibrant colors.', 'ক্রিমি আবরণ সহ রঙিন চমচম। উজ্জ্বল রঙে নরম, স্পঞ্জি টেক্সচার।', 140.00, 126.00, 31, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(70, 'SWT-018', 'Pantua', 'পান্তুয়া', 'pantua', 'Deep-fried pantua soaked in sugar syrup. Similar to gulab jamun with darker exterior.', 'চিনির সিরায় ভেজানো ডিপ-ফ্রাইড পান্তুয়া। গাঢ় বাইরের সাথে গোলাপ জামুনের মতো।', 150.00, 135.00, 83, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(71, 'SWT-019', 'Laddu', 'লাড্ডু / মোতি লাড্ডু', 'laddu', 'Round laddu made with gram flour and sugar. Classic festive sweet with nutty flavor.', 'বেসন এবং চিনি দিয়ে তৈরি গোলাকার লাড্ডু। বাদামি স্বাদের ক্লাসিক উৎসবমুখর মিষ্টি।', 200.00, NULL, 25, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(72, 'SWT-020', 'Laddu (Color)', 'রাঙ লাড্ডু', 'laddu-color', 'Colorful laddu variant with vibrant food colors. Festive appearance with same great taste.', 'উজ্জ্বল ফুড কালার সহ রঙিন লাড্ডু ভ্যারিয়েন্ট। একই দুর্দান্ত স্বাদে উৎসবমুখর চেহারা।', 220.00, 198.00, 11, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(73, 'SWT-021', 'Barfi', 'বরফি / খোয়া বরফি', 'barfi', 'Dense milk barfi with silver foil decoration. Rich, fudgy sweet for special celebrations.', 'রুপোর পাতা সাজসজ্জা সহ ঘন দুধের বরফি। বিশেষ উদযাপনের জন্য সমৃদ্ধ, ফাজি মিষ্টি।', 280.00, NULL, 35, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(74, 'SWT-022', 'Payesh', 'পায়েশ / গুড়ের পায়েশ', 'payesh', 'Creamy rice payesh slow-cooked with milk. Traditional Bengali rice pudding with aromatic spices.', 'দুধ দিয়ে স্লো-কুকড ক্রিমি চালের পায়েস। সুগন্ধি মশলা সহ ঐতিহ্যবাহী বাঙালি চালের পুডিং।', 350.00, 315.00, 52, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(75, 'SWT-023', 'Kheer', 'খীর', 'kheer', 'Thick, rich kheer made with condensed milk. Luxurious dessert with intense milk flavor.', 'কনডেন্সড মিল্ক দিয়ে তৈরি ঘন, সমৃদ্ধ ক্ষীর। তীব্র দুধের স্বাদের বিলাসবহুল ডেজার্ট।', 320.00, NULL, 58, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(76, 'SWT-024', 'Rasgulla', 'রাসগুল্লা / পনির সন্দেশ', 'rasgulla', 'Soft rasgulla dumplings in light sugar syrup. Authentic Bengali sweet loved worldwide.', 'হালকা চিনির সিরায় নরম রসগুল্লা ডাম্পলিং। বিশ্বজুড়ে প্রিয় খাঁটি বাঙালি মিষ্টি।', 130.00, NULL, 55, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(77, 'DYR-001', 'Sweet Yogurt (250g)', 'মিষ্টি দই (২৫০ গ্রাম)', 'sweet-yogurt-250g', 'Traditional sweet yogurt (mishti doi) in 250g pack. Fermented with caramelized sugar for unique taste.', '২৫০ গ্রাম প্যাকে ঐতিহ্যবাহী মিষ্টি দই। অনন্য স্বাদের জন্য ক্যারামেলাইজড চিনি দিয়ে ফারমেন্টেড।', 80.00, 72.00, 25, 7, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(78, 'DYR-002', 'Sweet Yogurt (500g)', 'মিষ্টি দই (৫০০ গ্রাম)', 'sweet-yogurt-500g', 'Family-size sweet yogurt (500g) perfect for sharing. Creamy, rich texture with balanced sweetness.', 'ভাগ করে খাওয়ার জন্য পারিবারিক সাইজের মিষ্টি দই (৫০০ গ্রাম)। ভারসাম্যপূর্ণ মিষ্টতা সহ ক্রিমি, সমৃদ্ধ টেক্সচার।', 150.00, NULL, 30, 7, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(79, 'DYR-003', 'Plain Yogurt (250g)', 'সাদা দই (২৫০ গ্রাম)', 'plain-yogurt-250g', 'Fresh plain yogurt (250g) made from farm milk. Natural probiotic without added sugar.', 'খামারের দুধ থেকে তৈরি তাজা সাধারণ দই (২৫০ গ্রাম)। চিনি ছাড়া প্রাকৃতিক প্রোবায়োটিক।', 70.00, NULL, 40, 7, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(80, 'DYR-004', 'Doi (1kg)', 'দই (১ কেজি)', 'doi-1kg', 'Traditional doi (1kg) made with full-cream milk. Authentic taste with probiotic benefits.', 'ফুল-ক্রিম দুধ দিয়ে তৈরি ঐতিহ্যবাহী দই (১ কেজি)। প্রোবায়োটিক উপকারিতা সহ খাঁটি স্বাদ।', 280.00, 252.00, 52, 7, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(81, 'DYR-005', 'Pure Ghee (500g)', 'খাঁটি ঘি (৫০০ গ্রাম)', 'pure-ghee-500g', 'Pure ghee (500g) clarified from quality butter. Golden, aromatic cooking essential for authentic dishes.', 'মানসম্মত মাখন থেকে ক্ল্যারিফাইড বিশুদ্ধ ঘি (৫০০ গ্রাম)। খাঁটি খাবারের জন্য সোনালি, সুগন্ধি রান্নার অপরিহার্য।', 650.00, NULL, 52, 7, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(82, 'DYR-006', 'Butter', 'মাখন', 'butter', 'Fresh butter made from quality cream. Rich, creamy texture perfect for cooking and spreading.', 'মানসম্মত ক্রিম থেকে তৈরি তাজা মাখন। রান্না এবং স্প্রেড করার জন্য সমৃদ্ধ, ক্রিমি টেক্সচার।', 220.00, 198.00, 91, 7, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(83, 'DYR-007', 'Dairy Creamer', 'দুগ্ধ ক্রিম / ডেইরি ক্রিম', 'dairy-creamer', 'Dairy creamer for rich, creamy beverages. Perfect for coffee, tea, and desserts.', 'সমৃদ্ধ, ক্রিমি পানীয়ের জন্য ডেয়ারি ক্রিমার। কফি, চা এবং ডেজার্টের জন্য আদর্শ।', 180.00, 162.00, 89, 7, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(84, 'BUN-001', 'Cream Bun', 'ক্রিম বান / মালাই বান', 'cream-bun', 'Soft cream bun filled with vanilla cream. Light pastry with sweet, creamy center.', 'ভ্যানিলা ক্রিম ভর্তি নরম ক্রিম বান। মিষ্টি, ক্রিমি সেন্টার সহ হালকা পেস্ট্রি।', 45.00, NULL, 27, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(85, 'BUN-002', 'Cheese Bun', 'পনির বান / সন্দেশ বান', 'cheese-bun', 'Savory cheese bun with melted cheese topping. Golden crust with gooey cheese flavor.', 'গলিত পনির টপিং সহ সুস্বাদু চিজ বান। গুগলি পনিরের স্বাদ সহ সোনালি আবরণ।', 55.00, NULL, 73, 8, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(86, 'BUN-003', 'Chocolate Bun', 'চকলেট বান / কোকো বান', 'chocolate-bun', 'Sweet chocolate bun with chocolate chips. Perfect treat for chocolate lovers.', 'চকলেট চিপস সহ মিষ্টি চকলেট বান। চকলেটপ্রেমীদের জন্য পারফেক্ট ট্রিট।', 50.00, NULL, 21, 8, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(87, 'BUN-004', 'Cinnamon Bun', 'দারচিনি বান / ডালচিনি বান', 'cinnamon-bun', 'Aromatic cinnamon bun with cinnamon-sugar swirl. Topped with sweet glaze for extra indulgence.', 'দারুচিনি-চিনির সোয়ার্ল সহ সুগন্ধযুক্ত সিনামন বান। অতিরিক্ত আনন্দের জন্য মিষ্টি গ্লেজ টপিং।', 48.00, NULL, 98, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(88, 'BUN-005', 'Garlic Bun', 'রসুন বান / আলু বান', 'garlic-bun', 'Garlic bun infused with roasted garlic butter. Savory side for Italian meals.', 'রোস্টেড রসুন মাখন ইনফিউজড গার্লিক বান। ইতালীয় খাবারের সুস্বাদু সাইড।', 50.00, 45.00, 80, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(89, 'BUN-006', 'Cheese Roll', 'পনির রোল', 'cheese-roll', 'Flaky cheese roll with cheese filling throughout. Crispy layers with melted cheese.', 'সম্পূর্ণ জুড়ে পনির পুর সহ স্তরযুক্ত চিজ রোল। গলিত পনির সহ মচমচে স্তর।', 60.00, NULL, 62, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(90, 'BUN-007', 'Egg Bun', 'ডিম বান', 'egg-bun', 'Soft egg bun with whole egg inside. Protein-rich breakfast option.', 'ভেতরে সম্পূর্ণ ডিম সহ নরম এগ বান। প্রোটিন সমৃদ্ধ সকালের নাস্তার বিকল্প।', 42.00, 37.80, 60, 8, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(91, 'BUN-008', 'Hot Dog Bun', 'হট ডগ বান / লং বান', 'hot-dog-bun', 'Classic hot dog bun perfect for frankfurters. Soft, sturdy bun that holds toppings well.', 'ফ্র্যাঙ্কফার্টারের জন্য ক্লাসিক হট ডগ বান। টপিংস ভালো ধরে রাখে এমন নরম, মজবুত বান।', 40.00, NULL, 26, 8, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(92, 'BUN-009', 'Pastry Bun', 'পেস্ট্রি বান', 'pastry-bun', 'Sweet pastry bun with cream filling. Delicate pastry for dessert or tea-time.', 'ক্রিম ফিলিং সহ মিষ্টি পেস্ট্রি বান। ডেজার্ট বা চায়ের সময়ের জন্য সূক্ষ্ম পেস্ট্রি।', 55.00, NULL, 67, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(93, 'BUN-010', 'Fruit Bun', 'ফ্রুট বান', 'fruit-bun', 'Fruit bun loaded with dried fruits. Sweet, nutritious snack with natural fruitiness.', 'শুকনো ফলে ভরা ফ্রুট বান। প্রাকৃতিক ফলের স্বাদ সহ মিষ্টি, পুষ্টিকর স্ন্যাকস।', 48.00, 43.20, 85, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(94, 'PST-001', 'Puff', 'পাফ / মুরগি পাফ', 'puff', 'Classic puff pastry with flaky, buttery layers. Light and crispy texture melts in mouth.', 'স্তরযুক্ত, মাখনযুক্ত স্তর সহ ক্লাসিক পাফ পেস্ট্রি। মুখে গলে যাওয়া হালকা এবং মচমচে টেক্সচার।', 50.00, NULL, 22, 9, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(95, 'PST-002', 'Meat Puff', 'মাংসের পাফ / পোল্ট্রি পাফ', 'meat-puff', 'Savory meat puff with spiced meat filling. Crispy exterior with flavorful minced meat inside.', 'মশলাদার মাংস পুর সহ সুস্বাদু মিট পাফ। স্বাদযুক্ত কিমা মাংস সহ মচমচে বাইরে।', 60.00, NULL, 92, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(96, 'PST-003', 'Vegetable Puff', 'সবজি পাফ / আলুর পাফ', 'vegetable-puff', 'Vegetable puff with mixed vegetable filling. Healthy snack with crispy puff pastry.', 'মিশ্র সবজি পুর সহ ভেজিটেবল পাফ। মচমচে পাফ পেস্ট্রি সহ স্বাস্থ্যকর স্ন্যাকস।', 45.00, NULL, 90, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(97, 'PST-004', 'Cream Roll', 'ক্রিম রোল / মালাই রোল', 'cream-roll', 'Cream roll with vanilla cream filling. Crispy pastry tube with smooth cream center.', 'ভ্যানিলা ক্রিম ফিলিং সহ ক্রিম রোল। মসৃণ ক্রিম সেন্টার সহ মচমচে পেস্ট্রি টিউব।', 40.00, 36.00, 78, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(98, 'PST-005', 'Fruit Pastry', 'ফ্রুট পেস্ট্রি', 'fruit-pastry', 'Fresh fruit pastry topped with seasonal fruits. Light pastry cream base with fresh fruit topping.', 'মৌসুমি ফল দিয়ে টপ করা তাজা ফ্রুট পেস্ট্রি। তাজা ফল টপিং সহ হালকা পেস্ট্রি ক্রিম বেস।', 65.00, NULL, 33, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(99, 'PST-006', 'Croissant', 'ক্রোইসান / ফ্রেঞ্চ রোল', 'croissant', 'Buttery croissant with classic crescent shape. Flaky, golden layers perfect for breakfast.', 'ক্লাসিক অর্ধচন্দ্রাকৃতির মাখনযুক্ত ক্রোয়াঁসাঁ। সকালের নাস্তার জন্য মচমচে, সোনালি স্তর।', 70.00, 63.00, 62, 9, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(100, 'PST-007', 'Danish Pastry', 'ড্যানিশ পেস্ট্রি / লেয়ার্ড পেস্ট্রি', 'danish-pastry', 'Danish pastry with fruit or cream filling. Multiple layers of buttery pastry dough.', 'ফল বা ক্রিম ফিলিং সহ ড্যানিশ পেস্ট্রি। মাখনযুক্ত পেস্ট্রি ডো এর একাধিক স্তর।', 75.00, 67.50, 19, 9, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(101, 'PST-008', 'Sausage Roll', 'সসেজ রোল', 'sausage-roll', 'Savory sausage roll with seasoned sausage. Puff pastry wrapped around juicy sausage.', 'মশলাদার সসেজ সহ সুস্বাদু সসেজ রোল। রসালো সসেজের চারপাশে মোড়ানো পাফ পেস্ট্রি।', 80.00, NULL, 96, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(102, 'PST-009', 'Chicken Roll', 'চিকেন রোল', 'chicken-roll', 'Chicken roll with spiced chicken filling. Crispy pastry with savory chicken center.', 'মশলাদার চিকেন পুর সহ চিকেন রোল। সুস্বাদু চিকেন সেন্টার সহ মচমচে পেস্ট্রি।', 70.00, NULL, 38, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(103, 'PST-010', 'Pizza Pastry', 'পিৎজা পেস্ট্রি', 'pizza-pastry', 'Pizza pastry with pizza toppings and cheese. Mini pizza-flavored pastry snack.', 'পিজ্জা টপিংস এবং পনির সহ পিজ্জা পেস্ট্রি। মিনি পিজ্জা-ফ্লেভার্ড পেস্ট্রি স্ন্যাকস।', 85.00, 76.50, 29, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52'),
(104, 'PST-011', 'Samosa', 'সিংডা / শিঙারা', 'samosa', 'Crispy samosa with spiced potato or meat filling. Popular South Asian snack with golden crust.', 'মশলাদার আলু বা মাংস পুর সহ মচমচে সমুচা। সোনালি আবরণ সহ জনপ্রিয় দক্ষিণ এশীয় স্ন্যাকস।', 25.00, 22.50, 30, 9, 0, 1, 1, '2026-03-12 09:30:01', '2026-03-30 06:21:52');

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

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `is_primary`, `created_at`, `updated_at`) VALUES
(1, 2, 'products/premium_milk_bread.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(2, 3, 'products/whole_wheat_bread.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(3, 4, 'products/brown_bread.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(4, 5, 'products/garlic_bread.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(5, 6, 'products/dinner_rolls.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:47:09'),
(6, 7, 'products/fruit_bread.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(7, 8, 'products/cheese_bread.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(8, 9, 'products/multigrain_bread.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(9, 10, 'products/butter_bread.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(10, 11, 'products/burger_bun.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(11, 12, 'products/toast_bread.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(12, 13, 'products/bread_loaf.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(13, 14, 'products/bread_slices.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(14, 15, 'products/milk_bread_premium.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(15, 16, 'products/vanilla_sponge_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(16, 17, 'products/chocolate_sponge_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(17, 18, 'products/black_forest_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(18, 19, 'products/marble_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(19, 20, 'products/pound_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(20, 21, 'products/chocolate_truffle_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(21, 22, 'products/red_velvet_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(22, 23, 'products/lemon_pound_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(23, 24, 'products/coffee_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(24, 25, 'products/eid_special_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(25, 26, 'products/pohela_boishakh_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:47:09'),
(26, 27, 'products/birthday_cake_basic.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(27, 28, 'products/wedding_cake_3tier.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(28, 29, 'products/cream_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(29, 30, 'products/fruit_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(30, 31, 'products/anniversary_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(31, 32, 'products/heart_shape_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(32, 33, 'products/square_shape_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(33, 34, 'products/round_shape_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(34, 35, 'products/custom_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(35, 36, 'products/cartoon_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(36, 37, 'products/photo_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(37, 38, 'products/fruit_flavored_cake.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(38, 39, 'products/sponge_cake_generic.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(39, 40, 'products/butter_cookies.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(40, 41, 'products/chocolate_chip_cookies.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(41, 42, 'products/digestive_biscuits.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(42, 43, 'products/nankhatai.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(43, 44, 'products/cashew_cookies.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(44, 45, 'products/almond_cookies.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:47:09'),
(45, 46, 'products/coconut_cookies.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:47:09'),
(46, 47, 'products/oats_cookies.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:47:09'),
(47, 48, 'products/sugar_cookies.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:47:09'),
(48, 49, 'products/cream_biscuit.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(49, 50, 'products/coconut_biscuit.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(50, 51, 'products/jam_biscuit.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(51, 52, 'products/assorted_biscuits.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(52, 53, 'products/rosogolla.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(53, 54, 'products/roshogolla_12pcs.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(54, 55, 'products/sandesh.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(55, 56, 'products/sandesh_cream.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(56, 57, 'products/sandesh_pistachio.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(57, 58, 'products/sandesh_saffron.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(58, 59, 'products/gulab_jamun.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(59, 60, 'products/gulab_jamun_rose.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(60, 61, 'products/kalo_jam.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(61, 62, 'products/kalo_jam_24pcs.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:47:09'),
(62, 63, 'products/khejur.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(63, 64, 'products/roshmalai.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(64, 65, 'products/mawa.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(65, 66, 'products/shingara.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(66, 67, 'products/jalebi.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(67, 68, 'products/jalebi_thin.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(68, 69, 'products/chamcham.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(69, 70, 'products/pantua.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(70, 71, 'products/laddu.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(71, 72, 'products/laddu_color.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(72, 73, 'products/barfi.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(73, 74, 'products/payesh.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(74, 75, 'products/kheer.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(75, 76, 'products/rasgulla.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(76, 77, 'products/sweet_yogurt_250g.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(77, 78, 'products/sweet_yogurt_500g.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(78, 79, 'products/plain_yogurt_250g.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(79, 80, 'products/doi_1kg.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(80, 81, 'products/pure_ghee_500g.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(81, 82, 'products/butter.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(82, 83, 'products/dairy_creamer.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(83, 84, 'products/cream_bun.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(84, 85, 'products/cheese_bun.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(85, 86, 'products/chocolate_bun.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(86, 87, 'products/cinnamon_bun.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(87, 88, 'products/garlic_bun.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(88, 89, 'products/cheese_roll.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(89, 90, 'products/egg_bun.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(90, 91, 'products/hot_dog_bun.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(91, 92, 'products/pastry_bun.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(92, 93, 'products/fruit_bun.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(93, 94, 'products/puff.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(94, 95, 'products/meat_puff.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(95, 96, 'products/vegetable_puff.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(96, 97, 'products/cream_roll.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(97, 98, 'products/fruit_pastry.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(98, 99, 'products/croissant.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(99, 100, 'products/danish_pastry.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(100, 101, 'products/sausage_roll.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(101, 102, 'products/chicken_roll.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(102, 103, 'products/pizza_pastry.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34'),
(103, 104, 'products/samosa.png', 1, '2026-03-16 05:22:57', '2026-03-31 08:46:34');

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

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 2, 53, 5, 'The best roshogolla I\'ve ever had! Absolutely authentic taste and the delivery was super fast. Can\'t forget the test for 1sec, so yummy!!!Highly recommended! ', 1, '2026-03-16 06:30:39', '2026-03-16 06:35:30'),
(2, 2, 2, 5, 'Excellent quality bread! Very soft and fresh. Perfect for breakfast and sandwiches. The texture is amazing and it stays fresh for days. Highly recommended!', 1, '2026-03-16 06:40:59', '2026-03-16 06:43:14'),
(3, 2, 5, 5, 'Great garlic bread with perfect flavor balance. The garlic is aromatic but not overwhelming. Best when warmed up in the oven. Would buy again!', 1, '2026-03-16 06:41:07', '2026-03-16 06:43:14');

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
(1, 'admin', 'web', '2026-03-11 06:07:36', '2026-03-11 06:07:36'),
(2, 'visitor', 'web', '2026-03-16 09:56:44', '2026-03-16 09:56:44'),
(3, 'customer', 'web', '2026-03-29 10:09:09', '2026-03-29 10:09:09'),
(4, 'staff', 'web', '2026-03-29 10:09:09', '2026-03-29 10:09:09');

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
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text' COMMENT 'text, number, boolean, json',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general' COMMENT 'general, shipping, payment, etc.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `created_at`, `updated_at`) VALUES
(1, 'shipping_inside_dhaka', '70', 'number', 'shipping', '2026-03-24 06:53:52', '2026-03-24 07:11:20'),
(2, 'shipping_outside_dhaka', '110', 'number', 'shipping', '2026-03-24 06:53:52', '2026-03-24 07:11:20'),
(3, 'free_shipping_threshold', '1000', 'number', 'shipping', '2026-03-24 06:53:52', '2026-03-24 06:53:52');

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
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `subscribed_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `is_active`, `subscribed_at`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 'amshuvo64@gmail.com', 1, '2026-03-29 10:55:52', '127.0.0.1', '2026-03-29 10:55:52', '2026-03-29 10:55:52'),
(2, 'ashrafulinstasure@gmail.com', 1, '2026-03-29 10:56:09', '127.0.0.1', '2026-03-29 10:56:09', '2026-03-29 10:56:09'),
(3, 'asdfa@gmail.com', 1, '2026-03-29 10:56:19', '127.0.0.1', '2026-03-29 10:56:19', '2026-03-29 10:56:19');

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
-- Table structure for table `theme_settings`
--

CREATE TABLE `theme_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `primary_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#f59e0b',
  `primary_color_light` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#fbbf24',
  `primary_color_dark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#d97706',
  `secondary_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#f43f5e',
  `secondary_color_dark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#e11d48',
  `accent_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#8b5cf6',
  `bg_gradient_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#0f0a00',
  `bg_gradient_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#1a0a00',
  `bg_gradient_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#0d0520',
  `bg_gradient_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#001a0d',
  `bg_gradient_5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#0f0502',
  `btn_gradient_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#f59e0b',
  `btn_gradient_end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#f43f5e',
  `menu_hover_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#f59e0b',
  `menu_hover_end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#f43f5e',
  `text_primary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#f5e6cc',
  `text_secondary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#fbbf24',
  `glass_bg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rgba(255,255,255,0.08)',
  `glass_border` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rgba(255,255,255,0.15)',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `primary_color`, `primary_color_light`, `primary_color_dark`, `secondary_color`, `secondary_color_dark`, `accent_color`, `bg_gradient_1`, `bg_gradient_2`, `bg_gradient_3`, `bg_gradient_4`, `bg_gradient_5`, `btn_gradient_start`, `btn_gradient_end`, `menu_hover_start`, `menu_hover_end`, `text_primary`, `text_secondary`, `glass_bg`, `glass_border`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '#f59e0b', '#fbbf24', '#d97706', '#f43f5e', '#e11d48', '#8b5cf6', '#0f0a00', '#1a0a00', '#0d0520', '#001a0d', '#0f0502', '#f59e0b', '#f43f5e', '#f59e0b', '#f43f5e', '#f5e6cc', '#fbbf24', 'rgba(255,255,255,0.08)', 'rgba(255,255,255,0.15)', 1, '2026-04-02 06:01:15', '2026-04-02 06:46:27');

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
(2, 'Ashraful', 'ashrafulunisoft@gmail.com', '01859385787', NULL, '1997-10-28', 'male', NULL, 0, '$2y$12$qlSgxxvE3F2vQpSkWOco1efn8P74AwwvXKT9Zyn3dAxyHPceMhG6G', NULL, NULL, NULL, 'LHUyVYZTOoqeYwgwrGrCdSqCqAdwo6P7nLdvS1LH3X9GFGGVQ8L8Tc97yN21', NULL, NULL, '2026-03-12 04:40:47', '2026-03-30 11:36:54'),
(16, 'Md.Ashraful', 'ashrafulinstasure@gmail.com', '01947713697', NULL, NULL, NULL, NULL, 0, '$2y$12$B9AfUlnwbPtvhDDlpg5RvuTZUZaAbyFlOpOovpiRHpxp2oAbbSs0S', NULL, NULL, NULL, '2sdoJh2JH4yIuV56YP31PHTXUtn5SwwAKGnwBMUbqkrYyFayM0XNS9fVMZqK', NULL, NULL, '2026-03-29 10:31:05', '2026-03-29 10:31:05'),
(17, 'Otto Hewitt', 'siqor@mailinator.com', '+1 (134) 842-6812', NULL, NULL, NULL, NULL, 0, '$2y$12$gKeGY1TSNawDOJMMkOogUuF6szjafYDRt//mMnteN/Bg5yuxxGOUm', NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-31 05:17:29', '2026-03-31 05:17:29');

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
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cms_pages_slug_unique` (`slug`);

--
-- Indexes for table `cms_sections`
--
ALTER TABLE `cms_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cms_sections_section_key_unique` (`section_key`),
  ADD KEY `cms_sections_cms_page_id_foreign` (`cms_page_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `studentloginfroms`
--
ALTER TABLE `studentloginfroms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentloginfroms_email_unique` (`email`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_email_unique` (`email`),
  ADD KEY `subscribers_email_index` (`email`),
  ADD KEY `subscribers_is_active_index` (`is_active`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme_settings`
--
ALTER TABLE `theme_settings`
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
  ADD UNIQUE KEY `wishlists_user_id_product_id_session_id_unique` (`user_id`,`product_id`,`session_id`),
  ADD KEY `wishlists_user_id_index` (`user_id`),
  ADD KEY `wishlists_product_id_index` (`product_id`),
  ADD KEY `wishlists_session_id_index` (`session_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cms_sections`
--
ALTER TABLE `cms_sections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `product_tag`
--
ALTER TABLE `product_tag`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rfids`
--
ALTER TABLE `rfids`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studentloginfroms`
--
ALTER TABLE `studentloginfroms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theme_settings`
--
ALTER TABLE `theme_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- Constraints for table `cms_sections`
--
ALTER TABLE `cms_sections`
  ADD CONSTRAINT `cms_sections_cms_page_id_foreign` FOREIGN KEY (`cms_page_id`) REFERENCES `cms_pages` (`id`) ON DELETE CASCADE;

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
