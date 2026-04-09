-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Apr 09, 2026 at 07:55 AM
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
(22, 'The Art of Custom Cakes for Every Occasion', 'প্রতিটিক কেক তৈরির উপলক্ষে সাজানোর শিল্প', 'the-art-of-custom-cakes', '<h2>Creating Memories, One Cake at a Time</h2><p>At Saffron Sweets & Bakery, we understand that every celebration is unique. That\'s why we specialize in creating custom cakes that are as special as your moments.</p>\n\n<h3>Our Custom Cake Process</h3>\n<ul>\n<li><strong>Consultation:</strong> We meet with you to understand your vision, preferences, and dietary requirements.</li>\n<li><strong>Design:</strong> Our artists sketch custom designs based on your theme, colors, and preferences.</li>\n<li><strong>Crafting:</strong> Expert bakers create your cake using premium ingredients and traditional techniques.</li>\n<li><strong>Delivery:</strong> Fresh delivery to your venue with proper setup and presentation.</li>\n</ul>\n\n<h3>Popular Custom Cake Designs</h3>\n<ul>\n<li>Wedding Cakes - Multi-tier masterpieces</li>\n<li>Birthday Cakes - Age-appropriate designs</li>\n<li>Anniversary Cakes - Elegant and sophisticated</li>\n<li>Themed Cakes - Your favorite characters and motifs</li>\n<li>Photo Cakes - Edible prints of your cherished memories</li>\n</ul>\n\n<h3>Why Choose Our Custom Cakes?</h3>\n<ul>\n<li>Fresh ingredients sourced locally</li>\n<li>Authentic Bengali sweets expertise since 1995</li>\n<li>Customizable flavors - Vanilla, Chocolate, Mango, Rose, and more</li>\n<li>Dietary options available - Sugar-free, eggless, vegan</li>\n<li>Same-day delivery for urgent orders</li>\n</ul>\n\n<p>Contact us at least 3 days before your event to discuss your custom cake requirements.</p>', '<h2>স্মৃতিটিকের জন্য স্মৃতিটিক কেক</h2><p>সাফ্রন সুইটস এন্ড বেকারিতে, আমরা বুঝতি প্রতিটিটি উপলক্ষের কেক তৈরি করতে পারদর্শক। আমাদের দক্ষ পাকিগুলিরা প্রেম উপাদান দিয়ে প্রতিটিটি স্মৃতিটিক কেক তৈরি করে।</p>', 'Discover how we create stunning custom cakes for birthdays, weddings, and special celebrations. Our expert bakers craft each cake with love and precision.', 'জন্মদিন, বিয়ে এবং বিশেষ উপলক্ষের জন্য আমাদের সুন্দর কাস্টম কেক তৈরি করি। আমাদের দক্ষ পাকিগুলিরা প্রতিটিটিটি এবং যত্নতার সাথে প্রতিটিটি কেক তৈরি করে।', 'blog/custom_cake.png', 1, 'Recipe', 'Custom Cakes, Birthday Cakes, Wedding Cakes, Party Cakes', 'published', 0, 'Custom Cakes for Every Occasion - Saffron Sweets & Bakery', 'Order custom cakes for birthdays, weddings, and special occasions. Expert bakers crafting stunning cakes since 1995.', 'Aut consectetur aliq', 26, '2026-03-24 10:53:13', '2026-03-24 10:53:13', '2026-04-09 04:48:56', NULL),
(23, 'Traditional Biscuits & Custom Cookie Creations', 'ঐতিহ্য বিস্কুট এবং কাস্টম কুকি তৈরি', 'traditional-biscuits-custom-cookies', '<h2>The Art of Bengali Biscuits</h2><p>Bengali biscuits are more than just snacks – they\'re a tradition passed down through generations. At Saffron Sweets & Bakery, we keep this tradition alive while adding modern touches.</p>\n\n<h3>Our Signature Biscuits</h3>\n<ul>\n<li><strong>Naan Khatai:</strong> Buttery, cardamom-infused shortbread cookies that melt in your mouth.</li>\n<li><strong>Shakar Para:</strong> Crispy, sugar-coated biscuits perfect with evening tea.</li>\n<li><strong>Kaju Katli Biscuit:</strong> Cashew goodness in biscuit form – a nut lover\'s dream.</li>\n<li><strong>Badam Pista Biscuit:</strong> Almond and pistachio cookies fit for royalty.</li>\n<li><strong>Coconut Biscuit (Narikoor):</strong> Delicate coconut flakes in a crunchy biscuit.</li>\n</ul>\n\n<h3>Custom Cookie Creations</h3>\n<p>Looking for something unique? Our custom cookies include:</p>\n<ul>\n<li><strong>Photo Cookies:</strong> Edible images on cookies for special events</li>\n<li><strong>Logo Cookies:</strong> Branded cookies for corporate gifting</li>\n<li><strong>Message Cookies:</strong> Cookies with custom messages and names</li>\n<li><strong>Themed Cookies:</strong> Holiday and occasion-specific shapes and designs</li>\n</ul>\n\n<h3>Perfect for Gifting</h3>\n<ul>\n<li>Wedding favors - Customized with couple\'s names</li>\n<li>Corporate gifts - Logo-embossed biscuit boxes</li>\n<li>Birthday parties - Age and theme-specific designs</li>\n<li>Festival treats - Durga Puja, Eid, Diwali specialties</li>\n</ul>\n\n<h3>Freshness Guarantee</h3>\n<ul>\n<li>Baked fresh daily in small batches</li>\nli>Premium quality ingredients - no artificial colors or flavors</li>\nli>Traditional recipes preserved since 1995</li>\n<li>Packaging that maintains freshness for weeks</li>\n</ul>\n\n<p>Contact us to discuss your custom biscuit and cookie requirements. Minimum order quantities apply for custom designs.</p>', '<h2>বাংলার বিস্কুটের ঐতিহ্য</h2><p>বাংলার বিস্কুট শুধু একটি স্ন্যাক নয় – এটি প্রজন্ম প্রজন্ম যায। সাফ্রন সুইটস এন্ড বেকারিতে, আমরা এই ঐতিহ্য বাঁচিয় রাখি আর তাজা আধুনিক ছোঁ যোগ করি।</p>', 'Explore our collection of traditional Bengali biscuits and custom cookie creations. From classic Naan Khatai to modern fusion treats, we bake something for everyone.', 'আমাদের ঐতিহ্য বিস্কুট এবং কাস্টম কুকি সংগ্রহ করুন। ক্লাসিক নান খাতা থেকে আধুনিক ফিউশন ট্রিটস - সবার কিছু না আছে।', 'blog/assorted_biscuits.png', 1, 'Recipe', 'Biscuits, Cookies, Naan Khatai, Custom Sweets, Traditional', 'published', 0, 'Traditional Biscuits & Custom Cookies - Saffron Sweets & Bakery', 'Discover our range of Bengali biscuits and custom cookies. From Naan Khatai to themed cookies for special occasions.', 'Nostrum nisi volupta', 21, '2026-03-24 10:53:25', '2026-03-24 10:53:25', '2026-04-09 04:50:03', NULL),
(28, 'The Authentic Rosogolla Experience', 'প্রামাণিক রসগোল্লার স্বাদ', 'authentic-rosogolla-experience', '<h2>The King of Bengali Sweets</h2><p>When it comes to Bengali sweets, one name stands above all – <strong>Rosogolla</strong>. And not just any rosogolla – we\'re talking about the authentic, spongy rosogolla from Porabari.</p>\n\n<h3>The Legend of Porabari</h3>\n<p>In 1868, Nobin Chandra Das created a revolutionary sweet in the small town of Porabari, West Bengal. Unlike the hard, dry sweets of the time, his rosogolla was soft, spongy, and soaked in sugar syrup. Little did he know that his creation would become the identity of Bengali sweets worldwide.</p>\n\n<h3>What Makes Authentic Rosogolla Special?</h3>\n<ul>\n<li><strong>Texture:</strong> The perfect spongy texture that absorbs syrup but maintains shape</li>\n<li><strong>Sweetness:</strong> Balanced sweetness from pure cane sugar</li>\n<li><strong>Size:</strong> Bite-sized pieces that melt in your mouth</li>\n<li><strong>Freshness:</strong> Made daily, never frozen or stored for long</li>\n<li><strong>Authenticity:</strong> Following the original Porabari recipe</li>\n</ul>\n\n<h3>Our Rosogolla Varieties</h3>\n<ul>\n<li><strong>Classic Spongy Rosogolla:</strong> The traditional favorite</li>\n<li><strong>Gulab Jamun Rosogolla:</strong> A fusion of two classics</li>\n<li><strong>Pista Rosogolla:</strong> Topped with crushed pistachios</li>\n<li><strong>Kesar Rosogolla:</strong> Infused with premium saffron</li>\n<li><strong>Chocolate Rosogolla:</strong> Modern twist on tradition</li>\n<li><strong>Rasmalai Rosogolla:</strong> Soaked in thick, creamy malai</li>\n</ul>\n\n<h3>The Saffron Difference</h3>\n<p>At Saffron Sweets & Bakery, we\'re committed to preserving the authentic taste of Porabari:</p>\n<ul>\n<li>Traditional chana (chickpea flour) base</li>\n<li>Pure ghee for richness</li>\n<li>Natural saffron for color and aroma</li>\n<li>Cardamom for authentic flavor</li>\n<li>No artificial colors or preservatives</li>\n<li>Homemade paneer for filling varieties</li>\n</ul>\n\n<h3>Why the Name \"Rosogolla\"?</h3>\n<p>The name comes from \"Ras\" (juice/syrup) and \"Golla\" (round ball). The sweet round balls floating in sugar syrup literally translates to \"round balls in juice\" – a simple, honest name for an extraordinary sweet.</p>\n\n<h3>Perfect for Every Occasion</h3>\n<ul>\n<li><strong>Puja Offerings:</strong> Traditional offering to Goddess Lakshmi</li>\n<li><strong>Dessert After Meals:</strong> The perfect ending to any feast</li>\n<li><strong>Gift Boxes:</strong> Premium packaging for gifting</li>\n<li><strong>Festival Celebrations:</strong> Durga Puja, Diwali, weddings</li>\n</ul>\n\n<p>Experience the authentic taste of Bengal with our rosogolla. Each piece is a tribute to the rich culinary heritage of our land.</p>', '<h2>বাঙালি মিষ্টিতে রাজা</h2><p>বাঙালি মিষ্টির কথা বলে একটি নাম যার চেয়ে আসে – রসগোল্লা। আর শুধু কোনো রসগোল্লা নয় – আমরা কথা বলছি প্রভারিতামিষ পোরাবাড়ির স্পঞ্জ, নরম ও সত্য রসগোল্লা।</p>', 'Discover the heritage of Bengal\'s most iconic sweet. Learn about the authentic spongy rosogolla from Porabari, its history, and why it\'s called the \"King of Bengali Sweets.\"', 'বাংলার সবচের মিষ টি প্রতীক মিষ্টি - রসগোল্লা। প্রভারিতামিষ রসগোল্লা সম্পর্কে এই মিষ্টি রসগোল্লার উত্তম-ঐতিহ্য এবং ইতিহাস জানুন।', 'blog/rosogolla.png', 1, 'Story', 'Rosogolla, Bengali Sweets, Traditional Sweets, Porabari, Heritage', 'published', 0, 'Authentic Rosogolla - The King of Bengali Sweets', 'Experience the authentic spongy rosogolla from Porabari. Learn about its history, varieties, and why it\'s Bengal\'s favorite sweet.', 'Magnam sit nesciunt', 13, '2026-03-24 11:59:14', '2026-03-24 11:45:23', '2026-04-09 07:04:51', NULL),
(29, 'The Secret Behind Our Freshly Baked Bread', 'আমাদের সদ্য বেক করা রুটির পেছনের গোপন রহস্য', 'secret-behind-freshly-baked-bread', '<p>At Saffron Sweets & Bakery, every loaf of bread tells a story of dedication and craftsmanship. Our bakers start their day before dawn to ensure that every customer gets the freshest bread possible. From our premium milk bread to whole wheat and multigrain varieties, each product is made with carefully selected ingredients.</p><p>We use traditional baking methods combined with modern techniques to achieve the perfect texture - a crispy crust with a soft, fluffy interior. Our bread selection includes classic favorites like garlic bread, fruit bread, and butter bread, all baked fresh daily.</p><p>What sets our bread apart is the slow fermentation process we use. This allows the dough to develop complex flavors naturally, resulting in bread that is not only delicious but also easier to digest. Visit us today and taste the difference!</p>', '<p>সাফরন সুইটস অ্যান্ড বেকারিতে, প্রতিটি রুটি নিষ্ঠা এবং শিল্পকৌশলের একটি গল্প বলে। আমাদের বেকাররা ভোরের আগে তাদের দিন শুরু করে যাতে প্রতিটি গ্রাহক সবচেয়ে তাজা রুটি পায়।</p>', 'Discover how our artisan bakers craft the perfect loaf every morning using traditional methods and premium ingredients.', 'আমাদের শিল্পী বেকাররা কীভাবে ঐতিহ্যবাহী পদ্ধতি এবং প্রিমিয়াম উপাদান ব্যবহার করে প্রতিদিন সকালে নিখুঁত রুটি তৈরি করেন তা জানুন।', 'products/bread_loaf.png', 1, 'Baking Tips', 'bread,baking,fresh,daily,artisan', 'published', 1, 'The Secret Behind Our Freshly Baked Bread', 'Discover the artisan baking process behind Saffron Sweets fresh bread.', 'bread, bakery, fresh, artisan', 140, '2026-04-07 04:56:38', '2026-04-09 04:56:38', '2026-04-09 04:56:38', NULL),
(30, 'Celebrate Eid with Our Special Cake Collection', 'আমাদের বিশেষ কেক কালেকশন দিয়ে ঈদ উদযাপন করুন', 'celebrate-eid-special-cake-collection', '<p>Eid is a time of joy, family gatherings, and of course, delicious food. At Saffron Sweets & Bakery, we have curated a special collection of cakes perfect for your Eid celebrations. From our stunning Eid Special Cake to elegant designs that will be the centerpiece of your festive table.</p><p>Our Eid collection features cakes adorned with beautiful decorations, intricate designs, and flavors that complement the festive spirit. Choose from chocolate truffle, red velvet, fruit-flavored, and our signature photo cakes that can be personalized with your family photos.</p><p>Order early to ensure availability! We also offer custom designs for larger gatherings. Each cake is made with premium ingredients and decorated by our experienced pastry chefs.</p>', '<p>ঈদ হলো আনন্দ, পারিবারিক সমাবেশ এবং স্বাস্থ্যকর খাবারের সময়। সাফরন সুইটস অ্যান্ড বেকারিতে, আমরা আপনার ঈদ উদযাপনের জন্য উপযুক্ত বিশেষ কেকের সংগ্রহ তৈরি করেছি।</p>', 'Make your Eid celebrations sweeter with our exclusive range of beautifully designed festive cakes.', 'আমাদের সুন্দরভাবে ডিজাইন করা উৎসবের কেকের এক্সক্লুসিভ রেঞ্জ দিয়ে আপনার ঈদ উদযাপন আরও মিষ্টি করুন।', 'products/eid_special_cake.png', 1, 'Celebration', 'eid,cake,celebration,festival,special', 'published', 1, 'Eid Special Cake Collection', 'Order special Eid cakes from Saffron Sweets & Bakery.', 'eid, cake, celebration, festival', 137, '2026-04-04 04:56:38', '2026-04-09 04:56:38', '2026-04-09 06:58:47', NULL),
(31, '5 Reasons Why Our Chocolate Chip Cookies Are Best Sellers', '৫টি কারণ কেন আমাদের চকলেট চিপ কুকিজ সর্বাধিক বিক্রিত', '5-reasons-chocolate-chip-cookies-best-sellers', '<p>Our chocolate chip cookies have been a customer favorite since day one. Here are 5 reasons why they fly off our shelves every day:</p><p><strong>1. Premium Belgian Chocolate:</strong> We use only the finest Belgian chocolate chunks, not chips, for a richer, more indulgent experience in every bite.</p><p><strong>2. Perfectly Crispy Outside, Chewy Inside:</strong> Our unique baking technique creates the ideal texture contrast that cookie lovers crave.</p><p><strong>3. No Artificial Preservatives:</strong> Made fresh daily with natural ingredients. What you taste is real butter, real vanilla, and real chocolate.</p><p><strong>4. Generous Portion Size:</strong> Each cookie is hand-scooped to ensure a generous, satisfying portion that is worth every taka.</p><p><strong>5. Made with Love:</strong> Our bakers pour their passion into every batch, ensuring consistent quality that keeps customers coming back for more.</p>', '<p>আমাদের চকলেট চিপ কুকিজ প্রথম দিন থেকেই গ্রাহকদের প্রিয়। এখানে ৫টি কারণ কেন তারা প্রতিদিন আমাদের শেলফ থেকে বিক্রি হয়ে যায়:</p>', 'Discover what makes our chocolate chip cookies irresistible - premium chocolate, perfect texture, and zero preservatives.', 'আমাদের চকলেট চিপ কুকিজকে অপ্রতিরোধ্য করে তুলেছে তা জানুন - প্রিমিয়াম চকলেট, নিখুঁত টেক্সচার এবং শূন্য প্রিজারভেটিভ।', 'products/chocolate_chip_cookies.png', 1, 'Recipe', 'cookies,chocolate,best-seller,baking,snack', 'published', 0, 'Why Our Chocolate Chip Cookies Are Best Sellers', 'Discover why Saffron chocolate chip cookies are customer favorites.', 'chocolate chip cookies, best seller, bakery', 107, '2026-04-01 04:56:38', '2026-04-09 04:56:38', '2026-04-09 04:56:38', NULL),
(32, 'A Journey Through Traditional Bangladeshi Sweets', 'ঐতিহ্যবাহী বাংলাদেশী মিষ্টির মধ্য দিয়ে একটি যাত্রা', 'journey-through-traditional-bangladeshi-sweets', '<p>Bangladesh has a rich heritage of sweet-making that dates back centuries. At Saffron Sweets, we take pride in preserving these traditional recipes while adding our own touch of excellence. Join us on a journey through some of our most beloved traditional sweets.</p><p><strong>Sandesh:</strong> A delicate Bengali sweet made from fresh chhena, sandesh comes in many varieties. Our pistachio sandesh and saffron sandesh are particularly popular, offering a perfect balance of sweetness and texture.</p><p><strong>Cham Cham:</strong> This oval-shaped sweet, coated with coconut flakes, is a feast for both the eyes and the palate. Our cham cham is made fresh daily using traditional methods.</p><p><strong>Gulab Jamun:</strong> Soft, melt-in-your-mouth dumplings soaked in fragrant rose-flavored syrup. Our gulab jamun with rose is a must-try for anyone with a sweet tooth.</p><p><strong>Laddu:</strong> No celebration in Bangladesh is complete without laddu. Our perfectly round, golden laddus are made with pure ghee and love.</p><p>Visit our shop to experience these traditional delights, each one handcrafted by our skilled sweet makers.</p>', '<p>বাংলাদেশের মিষ্টি তৈরির একটি সমৃদ্ধ ঐতিহ্য রয়েছে যা শতাব্দী পুরনো। সাফরন সুইটসে, আমরা এই ঐতিহ্যবাহী রেসিপিগুলো সংরক্ষণে গর্বিত।</p>', 'Explore the rich heritage of Bangladeshi sweets - from delicate sandesh to melt-in-your-mouth gulab jamun.', 'বাংলাদেশী মিষ্টির সমৃদ্ধ ঐতিহ্য অন্বেষণ করুন - সূক্ষ্ম সন্দেশ থেকে মুখে গলে যাওয়া গোলাপ জামুন পর্যন্ত।', 'products/sandesh_saffron.png', 1, 'Story', 'traditional,sweets,bangladesh,sandesh,gulab jamun,laddu', 'published', 1, 'Traditional Bangladeshi Sweets Journey', 'Explore traditional Bangladeshi sweets at Saffron Sweets.', 'traditional sweets, bangladeshi, sandesh, gulab jamun', 142, '2026-03-28 04:56:38', '2026-04-09 04:56:38', '2026-04-09 04:56:38', NULL),
(33, 'Perfect Pastry Pairings: Coffee and Croissants', 'নিখুঁত পেস্ট্রি জুটি: কফি এবং ক্রোয়াসাঁ', 'perfect-pastry-pairings-coffee-croissants', '<p>There is something magical about the combination of a freshly baked croissant and a perfectly brewed cup of coffee. At Saffron Sweets & Bakery, we have mastered both sides of this classic pairing.</p><p>Our croissants are made using the traditional French laminating technique, where butter is folded into the dough multiple times to create hundreds of flaky layers. The result is a pastry that shatters at first bite, revealing a soft, buttery interior that practically melts in your mouth.</p><p>Beyond croissants, our pastry selection includes Danish pastries, fruit pastries, cream rolls, and puff pastries - each one crafted with the same attention to detail. Our Danish pastries are particularly popular, featuring a buttery, flaky base topped with fruit preserves and a delicate glaze.</p><p>Whether you are looking for a quick breakfast or a leisurely afternoon treat, our pastry collection has something for every moment. Pair them with one of our sweet yogurts for the complete experience!</p>', '<p>সদ্য বেক করা ক্রোয়াসাঁ এবং নিখুঁতভাবে তৈরি কফির সমন্বয়ে জাদুকরী কিছু আছে। সাফরন সুইটস অ্যান্ড বেকারিতে, আমরা এই ক্লাসিক জুটির উভয় দিক আয়ত্ত করেছি।</p>', 'Experience the classic pairing of our buttery, flaky croissants with your favorite brew for the perfect morning treat.', 'নিখুঁত সকালের আহারের জন্য আমাদের মাখনযুক্ত, ফ্লেকি ক্রোয়াসাঁ আপনার প্রিয় ব্রু দিয়ে ক্লাসিক জুটি অনুভব করুন।', 'products/croissant.png', 1, 'Baking Tips', 'croissant,pastry,coffee,breakfast,french', 'published', 0, 'Perfect Pastry Pairings at Saffron', 'Discover perfect pastry pairings at Saffron Bakery.', 'croissant, pastry, coffee, breakfast', 101, '2026-03-25 04:56:38', '2026-04-09 04:56:38', '2026-04-09 04:56:38', NULL),
(34, 'Wedding Cakes That Make Your Special Day Unforgettable', 'আপনার বিশেষ দিনটিকে অবিস্মরণীয় করে তুলতে ওয়েডিং কেক', 'wedding-cakes-make-special-day-unforgettable', '<p>Your wedding day deserves a cake as special as the occasion itself. At Saffron Sweets & Bakery, we specialize in creating stunning wedding cakes that become the centerpiece of your celebration.</p><p>Our 3-tier wedding cake is a showstopper, featuring elegant decorations and multiple flavor layers. Each tier can be customized with different flavors - from classic vanilla sponge to rich chocolate truffle, from fruit cake to red velvet.</p><p>We work closely with each couple to design their dream cake. Whether you envision a traditional white cake with delicate floral decorations or a modern design with bold colors and unique textures, our pastry chefs can bring your vision to life.</p><p>Our wedding cake service includes a complimentary tasting session where you can sample different flavors and discuss your design preferences. We recommend booking at least 2 weeks in advance to ensure we can dedicate the time your cake deserves.</p><p>Make your special day truly unforgettable with a Saffron wedding cake. Contact us today to start planning!</p>', '<p>আপনার বিয়ের দিন এমন একটি কেক পাওয়ার যোগ্য যা অনুষ্ঠানের মতোই বিশেষ। সাফরন সুইটস অ্যান্ড বেকারিতে, আমরা অত্যাশ্চর্য ওয়েডিং কেক তৈরিতে বিশেষজ্ঞ।</p>', 'From classic 3-tier masterpieces to modern designer cakes, create the wedding cake of your dreams with our expert team.', 'ক্লাসিক ৩-টায়ার মাস্টারপিস থেকে আধুনিক ডিজাইনার কেক পর্যন্ত, আমাদের বিশেষজ্ঞ দলের সাথে আপনার স্বপ্নের ওয়েডিং কেক তৈরি করুন।', 'products/wedding_cake_3tier.png', 1, 'Celebration', 'wedding,cake,custom,celebration,3-tier', 'published', 1, 'Wedding Cakes by Saffron Bakery', 'Order your dream wedding cake from Saffron Sweets.', 'wedding cake, custom cake, celebration', 167, '2026-04-06 04:56:38', '2026-04-09 04:56:38', '2026-04-09 04:56:38', NULL);

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
(37, 6, 'hero', 'Authentic Saffron<br/><span class=\"gradient-text\">Sweets & Bakery</span>', NULL, '🎂 Premium Quality Since 1995', NULL, 'Indulge in the rich heritage of Bengal with our exquisite collection of traditional sweets and premium bakery items. Each creation is crafted with love using recipes passed down through generations.', NULL, 'Shop Now', NULL, '/shop', NULL, '🎂', 1, 1, '2026-03-25 13:04:37', '2026-04-09 06:01:05'),
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
(54, '2026_04_02_055321_create_theme_settings_table', 24),
(55, '2026_04_02_072842_add_theme_preset_to_theme_settings_table', 25);

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
(32, 16, NULL, 0, 'retail', 'ORD-69CBAF9B5859E', 'TRAN-69CBAF9B5F229-32', 108.00, 0.00, 10.80, 207.20, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Lydia\",\"last_name\":\"Farrell\",\"email\":\"rybyfofapy@mailinator.com\",\"phone\":\"+1 (793) 164-4719\",\"address\":\"Suscipit vero aut mo\",\"city\":\"sylhet\"}', '2026-03-31 11:27:23', '2026-03-31 11:27:29', 1),
(33, 2, NULL, 0, 'retail', 'ORD-69D72E2F159A3', 'TRAN-69D72E2F1BA2C-33', 43.20, 0.00, 0.00, 153.20, 'processing', 'sslcommerz', 'paid', '{\"first_name\":\"Kaseem\",\"last_name\":\"Riggs\",\"email\":\"bijyr@mailinator.com\",\"phone\":\"+1 (635) 684-5229\",\"address\":\"Dolor quisquam qui d\",\"city\":\"sylhet\"}', '2026-04-09 04:42:23', '2026-04-09 04:42:29', NULL);

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
(32, 32, 40, 108.00, 1, '2026-03-31 11:27:23', '2026-03-31 11:27:23'),
(33, 33, 93, 43.20, 1, '2026-04-09 04:42:23', '2026-04-09 04:42:23');

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
(2, 'BRD-001', 'Premium Milk Bread', 'প্রিমিয়াম মিল্ক ব্রেড / দুধের রুটি', 'premium-milk-bread', '<ul>\n<li>Premium milk bread crafted with fresh dairy and high-quality flour for a rich, soft texture.</li>\n<li>Perfectly golden crust with a fluffy, pillowy interior that melts in your mouth.</li>\n<li>Made fresh daily by our expert bakers using traditional slow-fermentation techniques.</li>\n<li>Enriched with real milk for added nutrition, calcium, and a naturally sweet flavor.</li>\n<li>Ideal for breakfast toast, sandwiches, bread pudding, and everyday family meals.</li>\n<li>No artificial preservatives, colors, or flavors — only wholesome, natural ingredients.</li>\n<li>Stay fresh longer with our sealed, eco-friendly packaging designed for maximum freshness.</li>\n<li>A staple bread loved by kids and adults alike, perfect for your daily dining table.</li>\n<li>Available in multiple sizes to suit small families, large households, and party gatherings.</li>\n<li>Trusted by thousands of customers across Bangladesh for consistent premium quality.</li>\n</ul>', 'তাজা দুধ দিয়ে তৈরি সমৃদ্ধ ও ক্রিমি মিল্ক ব্রেড। নরম টেক্সচার এবং হালকা মিষ্টি স্বাদ যা মুখে গলে যায়। সকালের টোস্ট বা স্যান্ডউইচের জন্য আদর্শ।', 80.00, NULL, 49, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:54:24'),
(3, 'BRD-002', 'Whole Wheat Bread', 'গমের আটার রুটি', 'whole-wheat-bread', '<ul>\n<li>100% whole wheat bread made from finely milled atta for maximum fiber and nutrition.</li>\n<li>Packed with natural bran and wheat germ to support healthy digestion and daily wellness.</li>\n<li>Dense, hearty texture with a nutty, earthy flavor that pairs well with any topping.</li>\n<li>Perfect health-conscious choice for weight management, diabetic-friendly, and fitness diets.</li>\n<li>Baked fresh every morning without refined flour (maida), ensuring genuine whole grain goodness.</li>\n<li>Excellent source of complex carbohydrates for sustained energy throughout your busy day.</li>\n<li>Great for sandwiches, toast, or enjoyed plain with butter and your favorite spread.</li>\n<li>Recommended by nutritionists as a daily bread alternative for a balanced, wholesome diet.</li>\n<li>No added sugar, no artificial enhancers — just pure, honest whole wheat bread.</li>\n</ul>', 'আঁশ ও পুষ্টিতে ভরপুর ১০০% গমের আটার রুটি। ঘন, পুষ্টিকর টেক্সচার বাদামি স্বাদ সহ। স্বাস্থ্য সচেতনদের জন্য উপযোগী।', 90.00, 81.00, 58, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:54:24'),
(4, 'BRD-003', 'Brown Bread', 'ব্রাউন ব্রেড / গুড়ের রুটি', 'brown-bread', '<ul>\n<li>Hearty brown bread made from a wholesome blend of whole wheat and rye flour.</li>\n<li>Rich, earthy flavor profile with a satisfyingly dense crumb and chewy texture.</li>\n<li>Packed with dietary fiber, vitamins, and essential minerals for your daily nutrition.</li>\n<li>Slow-fermented dough develops deep, complex flavors naturally without any additives.</li>\n<li>Perfect for avocado toast, grilled cheese, hearty sandwiches, and soup dipping.</li>\n<li>Made with a touch of molasses for a naturally sweet, caramel-like undertone.</li>\n<li>Contains no refined white flour, making it a smarter choice for health-conscious eaters.</li>\n<li>Stays fresh and moist longer thanks to our premium ingredient blend and careful baking.</li>\n<li>A versatile everyday bread that complements both savory and sweet accompaniments beautifully.</li>\n</ul>', 'শস্য গমের আটা থেকে তৈরি পুষ্টিকর ব্রাউন ব্রেড। আঁশে সমৃদ্ধ, ঘন টেক্সচার এবং মাটির স্বাদ।', 85.00, NULL, 20, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:54:24'),
(5, 'BRD-004', 'Garlic Bread', 'রসুনের রুটি / রসুন ব্রেড', 'garlic-bread', '<ul>\n<li>Irresistibly aromatic garlic bread infused with roasted garlic butter and fresh herbs.</li>\n<li>Crispy golden crust on the outside, soft and buttery on the inside — the perfect contrast.</li>\n<li>Made with real roasted garlic cloves, never artificial garlic powder or flavorings.</li>\n<li>Aromatic blend of Italian herbs — oregano, parsley, and thyme — elevates every bite.</li>\n<li>Ready to heat and serve, perfect as a quick side for pasta, soup, or salad dishes.</li>\n<li>Handcrafted in small batches by our skilled bakers to ensure peak flavor and freshness.</li>\n<li>Great party appetizer — simply slice, warm, and watch your guests come back for more.</li>\n<li>No artificial garlic flavor — only real, slow-roasted garlic for an authentic taste.</li>\n<li>Pairs perfectly with our marinara sauce, cream soups, or enjoyed entirely on its own.</li>\n</ul>', 'রোস্টেড রসুন মাখন দিয়ে সুগন্ধযুক্ত রসুন রুটি। মচমচে আবরণ এবং নরম ভেতর। পাস্তা বা স্যুপের সাথে উত্তম।', 120.00, NULL, 37, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:54:24'),
(6, 'BRD-005', 'Dinner Rolls / Buns', 'বান / ডিনার রোল', 'dinner-rolls-buns', '<ul>\n<li>Soft, pillowy dinner rolls baked to a perfect golden brown — ideal for any meal.</li>\n<li>Light and fluffy texture with a delicate buttery flavor that everyone at the table loves.</li>\n<li>Made fresh daily using premium flour, real butter, and a touch of honey for natural sweetness.</li>\n<li>Perfect accompaniment to soups, stews, salads, roasts, and holiday dinner spreads.</li>\n<li>Pull-apart softness makes them fun for kids and perfect for sharing at family gatherings.</li>\n<li>Can be served warm with butter, jam, honey, or used as mini sandwich buns.</li>\n<li>Available in convenient packs of 4, 6, or 12 — choose the size that fits your occasion.</li>\n<li>No preservatives or artificial dough conditioners — just honest, freshly baked goodness.</li>\n<li>Reheats beautifully in just 5 minutes in the oven, tasting as fresh as when first baked.</li>\n</ul>', 'পরিবারের খাবারের জন্য নরম, তুলতুলে ডিনার রোল। সোনালি-বাদামী আবরণ এবং মখমলে ভেতর। তরকারির সাথে ডুবিয়ে খাওয়ার জন্য চমৎকার।', 60.00, NULL, 71, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:54:24'),
(7, 'BRD-006', 'Fruit Bread', 'ফ্রুট ব্রেড', 'fruit-bread', '<ul>\n<li>Delightful fruit bread bursting with premium raisins, dried cranberries, and candied citrus peel.</li>\n<li>A perfect balance of sweet, tangy dried fruits in every soft, fluffy slice of bread.</li>\n<li>Mildly sweetened with natural fruit sugars — no refined sugar or artificial sweeteners added.</li>\n<li>Wonderful for breakfast toast with cream cheese, butter, or enjoyed fresh as a snack.</li>\n<li>Rich, fruity aroma fills your kitchen every time you open the bag or toast a slice.</li>\n<li>A festive bread perfect for holidays, tea-time, brunches, and special family occasions.</li>\n<li>Made with a enriched dough that stays incredibly soft and moist for days after baking.</li>\n<li>Each loaf is handcrafted with generously distributed fruits for consistency in every bite.</li>\n<li>A beloved classic across generations — nostalgic flavor with a modern bakery twist.</li>\n</ul>', 'শুকনো ফল ও বেরিতে ভরপুর রঙিন ফ্রুট ব্রেড। প্রতিটি কামড়ে মিষ্টি টক স্বাদ। চায়ের সাথে জলখাবারের জন্য দুর্দান্ত।', 100.00, NULL, 51, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:54:24'),
(8, 'BRD-007', 'Cheese Bread', 'চিজ ব্রেড', 'cheese-bread', '<ul>\n<li>Gourmet cheese bread loaded with generous chunks of premium mozzarella and cheddar cheese.</li>\n<li>Irresistibly cheesy pull-apart bread with a golden, crispy cheese crust on the outside.</li>\n<li>Perfect balance of bread softness and melted cheese stretch in every single bite.</li>\n<li>Made with a blend of real cheeses — no artificial cheese flavorings or processed substitutes.</li>\n<li>Ideal as a standalone snack, party appetizer, or paired with soups and pasta dishes.</li>\n<li>Warm it in the oven for 5 minutes to experience the ultimate melted cheese experience.</li>\n<li>A crowd-pleaser at parties, picnics, Iftar gatherings, and children\'s lunchboxes.</li>\n<li>Handcrafted fresh daily by our expert bakers for consistent quality and flavor.</li>\n<li>Available in regular and large sizes to satisfy both personal cravings and group snacking.</li>\n</ul>', 'প্রিমিয়াম চেডার দিয়ে বেক করা সুস্বাদু চিজ ব্রেড। সোনালি আবরণ এবং গলিত পনিরের পকেট। পনিরপ্রেমীদের আনন্দ।', 110.00, NULL, 29, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:54:24'),
(9, 'BRD-008', 'Multigrain Bread', 'মাল্টিগ্রেইন ব্রেড / মাল্টিগ্রেইন আটার রুটি', 'multigrain-bread', '<ul>\n<li>Nutritious multigrain bread crafted with seven wholesome grains and seeds for maximum health benefits.</li>\n<li>Contains oats, flaxseeds, sunflower seeds, sesame seeds, millet, barley, and whole wheat.</li>\n<li>Rich in omega-3 fatty acids, dietary fiber, protein, and essential vitamins and minerals.</li>\n<li>Nutty, hearty flavor with a satisfyingly chewy texture and crunchy seed topping.</li>\n<li>Perfect for fitness enthusiasts, weight watchers, and anyone seeking a balanced, healthy diet.</li>\n<li>Low glycemic index bread that provides sustained energy without sugar spikes or crashes.</li>\n<li>Goes wonderfully with hummus, avocado, lean meats, eggs, and fresh vegetable toppings.</li>\n<li>Baked fresh daily using a slow-fermentation process for better digestion and richer flavor.</li>\n<li>No maida, no preservatives — just pure multigrain goodness in every nutritious slice.</li>\n</ul>', 'ওটস, তিসি বীজ এবং বাজরা সহ পুষ্টিকর মাল্টিগ্রেন ব্রেড। পুষ্টিতে ঘন এবং বাদামি জটিল স্বাদ।', 130.00, 117.00, 14, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:54:24'),
(10, 'BRD-009', 'Butter Bread', 'মাখ্দন রুটি / মাখন রুটি', 'butter-bread', '<ul>\n<li>Rich, buttery bread made with generous amounts of real cream butter for unmatched softness.</li>\n<li>Ultra-soft, melt-in-your-mouth texture with a delicate golden crust and sweet butter aroma.</li>\n<li>Premium quality ingredients including imported butter, fine flour, and fresh milk.</li>\n<li>A luxurious everyday bread that transforms simple toast and sandwiches into gourmet meals.</li>\n<li>Children absolutely love the mild, creamy flavor — perfect for school lunches and snacks.</li>\n<li>Stays incredibly soft and fresh for days, thanks to the natural moisture from real butter.</li>\n<li>Excellent for making French toast, bread rolls, bread crumbs, and indulgent desserts.</li>\n<li>Handcrafted in small batches by our master bakers to ensure the highest quality every time.</li>\n<li>A premium choice for those who appreciate the finer things in their daily bread.</li>\n</ul>', 'বিশুদ্ধ ঘি দিয়ে তৈরি সমৃদ্ধ বাটার ব্রেড। নরম, আর্দ্র এবং মাখনের সুগন্ধ। সহজ কিন্তু অপ্রতিরোধ্য।', 95.00, 85.50, 98, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:54:24'),
(11, 'BRD-010', 'Burger Bun', 'বার্গার বান', 'burger-bun', '<ul>\n<li>Soft, perfectly shaped burger buns designed to hold your favorite patties without falling apart.</li>\n<li>Lightly toasted on the inside with a glossy, golden top sprinkled with sesame seeds.</li>\n<li>The ideal balance of softness and structure — holds juicy burgers while staying intact.</li>\n<li>Made fresh daily with premium flour, eggs, and a touch of sugar for a slightly sweet taste.</li>\n<li>Perfect for beef burgers, chicken sandwiches, veggie burgers, pulled pork, and sloppy joes.</li>\n<li>Available in packs of 4, 6, and 8 — convenient sizes for family meals and BBQ parties.</li>\n<li>Toasts beautifully on a pan or grill for that perfect charred, smoky flavor on the inside.</li>\n<li>No artificial dough softeners — our buns are naturally soft through careful kneading technique.</li>\n<li>Also great as breakfast buns with eggs, cheese, bacon, or sausage for a hearty morning meal.</li>\n</ul>', 'তিল বীজ টপিং সহ হালকা ও নরম বার্গার বান। বাড়িতে বানানো বার্গারের জন্য পারফেক্ট।', 70.00, 63.00, 84, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:54:24'),
(12, 'BRD-011', 'Toast Bread', 'টোস্ট রুটি', 'toast-bread', '<ul>\n<li>Perfectly sliced toast bread for quick, hassle-free breakfast preparation every morning.</li>\n<li>Evenly cut slices that fit standard toasters, ensuring golden, even toasting every time.</li>\n<li>Crispy on the outside, soft on the inside — the ideal toast texture everyone loves.</li>\n<li>Made from premium milk bread dough for a naturally sweet, rich flavor profile.</li>\n<li>Versatile base for butter toast, jam, peanut butter, cheese toast, and French toast recipes.</li>\n<li>Pre-sliced for convenience — grab and go for busy mornings, school lunches, and office snacks.</li>\n<li>Stays fresh in the sealed bag for up to 5 days without refrigeration after opening.</li>\n<li>Made with no artificial preservatives — pure, honest bread sliced for your daily convenience.</li>\n<li>A household essential across Bangladesh — trusted for quality, freshness, and great taste.</li>\n</ul>', 'সূক্ষ্ম, সমান টেক্সচার সহ ক্লাসিক সাদা টোস্ট ব্রেড। সকালের টোস্ট বা স্যান্ডউইচের জন্য উপযোগী।', 75.00, 67.50, 12, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:54:24'),
(13, 'BRD-012', 'Bread Loaf', 'রুটির লোফ', 'bread-loaf', '<ul>\n<li>Classic artisan bread loaf with a hearty, rustic crust and soft, airy interior.</li>\n<li>Traditional European-style baking technique creates beautiful irregular holes in every slice.</li>\n<li>Made with simple, clean ingredients — flour, water, salt, yeast, and a touch of olive oil.</li>\n<li>Versatile loaf perfect for sandwiches, toast, bruschetta, croutons, and bread bowls.</li>\n<li>Naturally fermented dough develops complex flavors and makes the bread easier to digest.</li>\n<li>The crusty exterior provides a satisfying crunch while the crumb stays wonderfully chewy.</li>\n<li>Excellent for dipping in olive oil, soups, or serving alongside cheese and charcuterie boards.</li>\n<li>Baked fresh daily on stone hearths for an authentic, artisan-quality bread experience.</li>\n<li>Stays fresh for 3-4 days at room temperature — refresh in the oven to restore crustiness.</li>\n</ul>', 'গ্রাম্য আবরণ সহ ঐতিহ্যবাহী ব্রেড লোফ। ঘন এবং পরিতৃপ্তিকর।', 85.00, 76.50, 34, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:54:24'),
(14, 'BRD-013', 'Bread Slices', 'রুটির স্লাইস', 'bread-slices', '<ul>\n<li>Perfectly uniform pre-sliced bread for quick sandwich making, toast, and everyday meals.</li>\n<li>Each slice is evenly cut to the ideal thickness — not too thin, not too thick — just right.</li>\n<li>Soft, fluffy texture holds together beautifully for sandwiches without tearing or crumbling.</li>\n<li>Made from our signature milk bread recipe for a mild, slightly sweet flavor the whole family enjoys.</li>\n<li>Hassle-free breakfast solution — no cutting needed, just grab slices and build your meal.</li>\n<li>Perfect for school sandwiches, office lunches, quick snacks, and late-night hunger pangs.</li>\n<li>Hygienically sliced and packaged in a sealed bag to lock in freshness and softness.</li>\n<li>Affordable, reliable, and consistently delicious — the daily bread choice for thousands of families.</li>\n<li>No trans fats, no cholesterol, and no artificial colors — a wholesome staple for your table.</li>\n</ul>', 'সুবিধার জন্য পূর্ব-কাটা রুটি। দ্রুত স্যান্ডউইচ এবং টোস্টের জন্য সমান স্লাইস।', 80.00, NULL, 80, 3, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:54:24'),
(15, 'BRD-014', 'Milk Bread (Premium)', 'দুধের পাউরুটি (নরম)', 'milk-bread-premium', '<ul>\n<li>Our most luxurious milk bread, crafted with extra milk, cream, and premium ingredients.</li>\n<li>Ultra-soft, cloud-like texture with a rich, creamy flavor that stands above regular bread.</li>\n<li>Double-milk enrichment provides superior taste, added protein, and a beautiful golden color.</li>\n<li>The softest bread in our collection — perfect for those who love melt-in-your-mouth sandwiches.</li>\n<li>Made with imported bread flour and fresh dairy for a bakery experience at your dining table.</li>\n<li>Ideal for premium sandwiches, elegant tea-time servings, and special breakfast occasions.</li>\n<li>Children and elderly love the extra-soft, gentle texture that requires minimal effort to eat.</li>\n<li>Individually crafted loaves ensure every single one meets our strict premium quality standards.</li>\n<li>Experience the difference that premium ingredients and passion make in everyday bread.</li>\n</ul>', 'দ্বিগুণ দুধ সমৃদ্ধ অতিরিক্ত ক্রিমি প্রিমিয়াম মিল্ক ব্রেড। শিশু এবং বয়স্কদের জন্য অতি-নরম টেক্সচার।', 90.00, NULL, 70, 3, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:54:24'),
(16, 'CAK-001', 'Vanilla Sponge Cake', 'ভ্যানিলা স্পঞ্জ কেক', 'vanilla-sponge-cake', '<ul>\n<li>Light, airy vanilla sponge cake baked to fluffy perfection with premium Madagascar vanilla extract.</li>\n<li>Three layers of delicate sponge generously filled with real whipped cream and vanilla buttercream.</li>\n<li>A timeless classic that serves as the perfect base for custom decorations and celebrations.</li>\n<li>Made with farm-fresh eggs, fine flour, and pure vanilla — never artificial flavors or essences.</li>\n<li>Ideal for birthdays, anniversaries, tea parties, and as an elegant everyday dessert option.</li>\n<li>Soft, melt-in-your-mouth texture that pairs beautifully with fresh fruits, chocolate, or caramel sauce.</li>\n<li>Available in multiple sizes from 1 pound to 3 pounds to suit any gathering or occasion.</li>\n<li>Handcrafted by our expert pastry chefs who bring years of cake artistry experience.</li>\n<li>A best-seller loved by customers of all ages for its pure, comforting vanilla flavor.</li>\n</ul>', 'হালকা ও এয়ারি ভ্যানিলা স্পঞ্জ কেক। ক্লাসিক ভ্যানিলা বিন স্বাদ সহ আর্দ্র ক্রাম্ব। কাস্টম সাজসজ্জার জন্য আদর্শ বেস।', 450.00, NULL, 24, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:40'),
(17, 'CAK-002', 'Chocolate Sponge Cake', 'চকোলেট স্পঞ্জ কেক', 'chocolate-sponge-cake', '<ul>\n<li>Rich, indulgent chocolate sponge cake made with premium Belgian cocoa and dark chocolate.</li>\n<li>Three layers of moist chocolate sponge filled with silky chocolate ganache and chocolate cream.</li>\n<li>Deep, intense chocolate flavor that satisfies every chocolate lover\'s deepest craving.</li>\n<li>Finished with a smooth chocolate glaze and decorative chocolate shavings on top.</li>\n<li>Made with real Belgian chocolate — no artificial cocoa substitutes or cheap chocolate flavoring.</li>\n<li>Perfect for chocolate-themed birthdays, Valentine\'s Day, anniversaries, and self-indulgent treats.</li>\n<li>Pairs wonderfully with vanilla ice cream, hot coffee, or a cold glass of milk.</li>\n<li>Available in 1lb, 2lb, and 3lb sizes with custom message options for special occasions.</li>\n<li>One of our top-selling cakes — consistently rated 5 stars by our loyal chocolate-loving customers.</li>\n</ul>', 'প্রিমিয়াম কোকো দিয়ে তৈরি সমৃদ্ধ চকলেট স্পঞ্জ। আর্দ্র, নরম ক্রাম্ব সহ গভীর চকলেট স্বাদ।', 500.00, NULL, 86, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:40'),
(18, 'CAK-003', 'Black Forest Cake', 'ব্ল্যাক ফরেস্ট কেক', 'black-forest-cake', '<ul>\n<li>Classic Black Forest Cake — layers of chocolate sponge, whipped cream, and cherries stacked to perfection.</li>\n<li>Authentic recipe featuring kirsch-soaked chocolate sponge layers and real cherry compote filling.</li>\n<li>Generously decorated with chocolate shavings, whipped cream rosettes, and fresh cherry toppings.</li>\n<li>A legendary cake that has been the centerpiece of celebrations across the world for generations.</li>\n<li>The perfect balance of rich chocolate, light cream, and tangy-sweet cherries in every forkful.</li>\n<li>Made with imported dark chocolate, fresh dairy cream, and premium maraschino cherries.</li>\n<li>Ideal for birthdays, anniversaries, corporate events, and any celebration that deserves grandeur.</li>\n<li>Available in multiple sizes with egg and eggless options to suit every dietary preference.</li>\n<li>Our bakers follow the traditional German recipe for an authentic Black Forest experience.</li>\n</ul>', 'হুইপড ক্রিম এবং চেরি ফিলিং স্তরযুক্ত ক্লাসিক ব্ল্যাক ফরেস্ট কেক। চকলেট শেভিংস দিয়ে সজ্জিত।', 650.00, NULL, 11, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:40'),
(19, 'CAK-004', 'Marble Cake', 'মার্বল কেক / মার্বেল কেক', 'marble-cake', '<ul>\n<li>Beautiful marble cake featuring an elegant swirl of vanilla and chocolate in every slice.</li>\n<li>Two perfectly blended batters create a stunning marble pattern that looks as good as it tastes.</li>\n<li>Moist, tender crumb with balanced vanilla and chocolate flavors that complement each other beautifully.</li>\n<li>A versatile cake perfect for tea-time, breakfast, dessert, or as an any-time snack.</li>\n<li>Made with real vanilla extract and Belgian cocoa — no artificial colors or flavorings used.</li>\n<li>The classic marbled appearance makes it a visually appealing centerpiece for any table setting.</li>\n<li>Loved by both kids and adults — the dual-flavor design means everyone gets the best of both worlds.</li>\n<li>Dense enough to hold up to frosting yet soft enough to enjoy plain with a cup of tea.</li>\n<li>A timeless bakery favorite that has stood the test of generations of cake lovers.</li>\n</ul>', 'ভ্যানিলা এবং চকলেট ব্যাটার মিশ্রিত সোয়ার্লড মার্বেল কেক। দ্বৈত স্বাদ সুন্দর প্যাটার্ন।', 550.00, NULL, 59, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:40'),
(20, 'CAK-005', 'Pound Cake', 'পাউন্ড কেক', 'pound-cake', '<ul>\n<li>Traditional pound cake made with a pound each of butter, sugar, eggs, and flour for rich density.</li>\n<li>Dense, buttery texture with a fine, tight crumb that slices beautifully without crumbling apart.</li>\n<li>Pure butter flavor shines through in every bite — made with real butter, never margarine or oil.</li>\n<li>A classic, elegant cake that needs no frosting — its richness speaks for itself.</li>\n<li>Perfect for serving with afternoon tea, coffee, fresh berries, or a dollop of whipped cream.</li>\n<li>The golden-brown crust provides a slight caramelized crunch that contrasts the tender interior.</li>\n<li>Excellent for making trifles, cake pops, bread pudding, or enjoying toasted with butter.</li>\n<li>A simple, honest cake that celebrates quality ingredients and traditional baking craftsmanship.</li>\n<li>Stays fresh and moist for up to a week when stored properly — perfect for advance preparation.</li>\n</ul>', 'সূক্ষ্ম ক্রাম্ব সহ ঘন, মাখনযুক্ত পাউন্ড কেক। বয়সের সাথে সমৃদ্ধ স্বাদ। চায়ের সময়ের ক্লাসিক সঙ্গী।', 480.00, 432.00, 48, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:40'),
(21, 'CAK-006', 'Chocolate Truffle Cake', 'চকোলেট ট্রাফল কেক / ট্রাফেল কেক', 'chocolate-truffle-cake', '<ul>\n<li>Ultimate chocolate indulgence — layers of dense chocolate sponge enveloped in velvety chocolate truffle cream.</li>\n<li>Made with premium dark chocolate truffle ganache for an intensely rich, luxurious flavor experience.</li>\n<li>Three layers of moist, fudgy chocolate cake with silky truffle filling between each layer.</li>\n<li>Coated in a mirror-like chocolate glaze and topped with hand-rolled chocolate truffles.</li>\n<li>A dessert that rivals the finest European chocolate shops — crafted right here in our bakery.</li>\n<li>Perfect for milestone celebrations, romantic occasions, corporate gifting, and chocoholic birthdays.</li>\n<li>Each bite delivers a burst of smooth, creamy chocolate that lingers on the palate beautifully.</li>\n<li>Made fresh to order with imported Belgian chocolate — never pre-made or frozen cakes.</li>\n<li>Our signature luxury cake — when only the absolute best chocolate experience will do.</li>\n</ul>', 'গ্যানাচে ফ্রস্টিং সহ মুখরোচক চকলেট ট্রাফল কেক। মখমলে মসৃণ টেক্সচার সহ তীব্র চকলেটি।', 750.00, NULL, 99, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:40'),
(22, 'CAK-007', 'Red Velvet Cake', 'রেড ভেলভেট কেক', 'red-velvet-cake', '<ul>\n<li>Stunning red velvet cake with vibrant crimson layers and a hint of cocoa in the sponge.</li>\n<li>Filled and frosted with generous layers of tangy, creamy cream cheese frosting — the classic pairing.</li>\n<li>The striking red color makes it a showstopper at weddings, Valentine\'s Day, and festive celebrations.</li>\n<li>Soft, velvety texture with a subtle chocolate undertone that adds depth to every bite.</li>\n<li>Made with premium cocoa, real buttermilk, and fresh cream cheese — no shortcuts or artificial flavors.</li>\n<li>A modern classic that has become one of the most requested cakes for special occasions.</li>\n<li>The contrast of deep red cake and snow-white frosting creates an unforgettable visual appeal.</li>\n<li>Available in round, heart, and square shapes with custom message and decoration options.</li>\n<li>Taste the magic that has made red velvet one of the world\'s most beloved cake flavors.</li>\n</ul>', 'ক্রিম চিজ ফ্রস্টিং সহ অসাধারণ রেড ভেলভেট কেক। সুন্দর কrimসন রঙ সহ হালকা কোকো স্বাদ।', 700.00, 630.00, 81, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:40'),
(23, 'CAK-008', 'Lemon Pound Cake', 'লেমন পাউন্ড কেক', 'lemon-pound-cake', '<ul>\n<li>Refreshing lemon pound cake bursting with bright, zesty lemon flavor in every moist slice.</li>\n<li>Made with fresh lemon juice and aromatic lemon zest for authentic citrus taste throughout.</li>\n<li>Tender, dense pound cake texture drizzled with a tangy lemon glaze that soaks into the top.</li>\n<li>A perfect balance of sweet and tart — a delightful cake for spring and summer gatherings.</li>\n<li>The sunny yellow color and fresh lemon aroma make it an uplifting treat for any day.</li>\n<li>Ideal for brunches, tea parties, garden gatherings, and as a light after-dinner dessert.</li>\n<li>Made with real lemons — no artificial lemon flavoring, citric acid, or synthetic citrus oils.</li>\n<li>Pairs beautifully with fresh berries, vanilla ice cream, or a steaming cup of Earl Grey tea.</li>\n<li>A refreshing change from chocolate and vanilla — discover why lemon cake has loyal fans worldwide.</li>\n</ul>', 'তাজা সাইট্রাস স্বাদে পূর্ণ জেস্টি লেবু পাউন্ড কেক। টক লেবু গ্লেজ সহ আর্দ্র টেক্সচার।', 520.00, 468.00, 84, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:40'),
(24, 'CAK-009', 'Coffee Cake', 'কফি কেক', 'coffee-cake', '<ul>\n<li>Rich, aromatic coffee cake infused with freshly brewed premium espresso and coffee extract.</li>\n<li>Layers of coffee-flavored sponge filled with silky coffee buttercream and a hint of cinnamon.</li>\n<li>A sophisticated dessert for coffee enthusiasts who appreciate the deep, roasted flavor of quality beans.</li>\n<li>Topped with a dusting of cocoa powder and coffee bean chocolate decorations for an elegant finish.</li>\n<li>Made with real espresso — never instant coffee or artificial coffee flavoring agents.</li>\n<li>Perfect for adult birthdays, office celebrations, dinner parties, and coffee lover gatherings.</li>\n<li>The caffeine kick adds a subtle energy boost, making it a great afternoon pick-me-up treat.</li>\n<li>Pairs naturally with a fresh cup of coffee, cappuccino, or espresso for the ultimate coffee experience.</li>\n<li>A refined, grown-up cake that stands apart from ordinary sweet cakes in both taste and character.</li>\n</ul>', 'এস্প্রেসো ইনফিউজড সুগন্ধযুক্ত কফি কেক। সমৃদ্ধ, বোল্ড স্বাদ সহ কফিপ্রেমীদের জন্য আদর্শ।', 580.00, NULL, 23, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:40'),
(25, 'CAK-010', 'Eid Special Cake', 'ঈদ স্পেশাল কেক', 'eid-special-cake', '<ul>\n<li>Specially designed Eid cake adorned with festive decorations, crescent moons, and stars to celebrate the occasion.</li>\n<li>Available in multiple flavors including chocolate, vanilla, fruit, and red velvet for your family gathering.</li>\n<li>Beautifully decorated with elegant cream work, edible glitter, and festive Eid-themed toppers.</li>\n<li>A centerpiece-worthy cake that adds sweetness and joy to your Eid celebration table.</li>\n<li>Can be personalized with custom messages like \"Eid Mubarak\" and your family name on top.</li>\n<li>Made with premium halal ingredients — every component carefully verified for Eid-appropriate consumption.</li>\n<li>Perfect for gifting to neighbors, relatives, and friends during the blessed Eid festivities.</li>\n<li>Available in 2lb, 3lb, and 5lb sizes to accommodate small family dinners and large community celebrations.</li>\n<li>Order early during Eid season as this is our highest-demand cake — limited quantities available daily.</li>\n</ul>', 'উৎসবমুখর ডিজাইনে সজ্জিত বিশেষ ঈদ কেক। ভাগ করে খাওয়ার জন্য মিষ্টি উদযাপন।', 1200.00, NULL, 51, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:40'),
(26, 'CAK-011', 'Pohela Boishakh Special', 'পহেলা বৈশাখ স্পেশাল', 'pohela-boishakh-special', '<ul>\n<li>Exclusive Pohela Boishakh (Bengali New Year) cake celebrating Bangladeshi culture and tradition.</li>\n<li>Decorated with traditional motifs, colorful patterns, and festive Boishakh-themed designs.</li>\n<li>Capture the spirit of Noboborsho with a cake as vibrant as the celebration itself.</li>\n<li>Available in traditional flavors like fruit cake and modern favorites like chocolate and red velvet.</li>\n<li>Can be customized with Bengali text, Alpona-inspired designs, and festive color combinations.</li>\n<li>A unique way to blend the joy of cake-cutting with the heritage of Bengali New Year festivities.</li>\n<li>Perfect for Boishakh fairs, cultural programs, office celebrations, and family get-togethers.</li>\n<li>Made with fresh, premium ingredients to match the freshness and hope of a brand new year.</li>\n<li>A limited-edition seasonal specialty — available only during the Pohela Boishakh celebration period.</li>\n</ul>', 'ঐতিহ্যবাহী বাংলা নববর্ষ বিশেষ কেক। সাংস্কৃতিক মোটিফ এবং উৎসবমুখর রঙে সজ্জিত।', 950.00, NULL, 62, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:41'),
(27, 'CAK-012', 'Birthday Cake - Basic', 'জন্মদিনের কেক - বেসিক', 'birthday-cake-basic', '<ul>\n<li>Classic birthday cake with colorful sprinkles, buttercream frosting, and a festive birthday design.</li>\n<li>Available in chocolate, vanilla, strawberry, and butterscotch flavors loved by kids and adults.</li>\n<li>Customizable with the birthday person\'s name, age, and a personal birthday message on top.</li>\n<li>Comes with complimentary candles and a cake knife — everything you need for the celebration.</li>\n<li>Made with light, fluffy sponge and sweet buttercream — the quintessential birthday cake experience.</li>\n<li>Perfect for children\'s parties, adult milestone birthdays, office celebrations, and surprise parties.</li>\n<li>Available in 1lb to 5lb sizes to serve from 4 to 25+ guests at your birthday event.</li>\n<li>Beautifully packaged in a sturdy cake box with window for safe transport and impressive presentation.</li>\n<li>Our most popular birthday option — reliable quality and taste that never disappoints on the big day.</li>\n</ul>', 'নাম ও বয়স অনুযায়ী কাস্টমাইজেবল ক্লাসিক জন্মদিনের কেক। বিভিন্ন ফ্লেভারে রঙিন ফ্রস্টিং সহ।', 850.00, 765.00, 82, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:41'),
(28, 'CAK-013', 'Wedding Cake - 3 Tier', 'বিয়ের কেক - ৩ স্তর', 'wedding-cake-3-tier', '<ul>\n<li>Magnificent 3-tier wedding cake designed to be the stunning centerpiece of your wedding reception.</li>\n<li>Each tier can feature a different flavor — choose from chocolate, vanilla, red velvet, fruit, and more.</li>\n<li>Elegantly decorated with hand-piped buttercream, sugar flowers, lacework, and cascading floral designs.</li>\n<li>Custom-designed to match your wedding theme, color palette, and personal style preferences.</li>\n<li>Serves 100-200 guests depending on tier sizes — perfect for medium to large wedding celebrations.</li>\n<li>Includes a complimentary cake tasting session to help you select the perfect flavor combination.</li>\n<li>Crafted by our senior pastry chefs with over a decade of wedding cake design experience.</li>\n<li>Dummy tiers available for dramatic height without waste — only real cake tiers are served to guests.</li>\n<li>Book at least 2-4 weeks in advance for custom designs — your dream wedding cake awaits.</li>\n</ul>', 'সুক্ষ্ম ডিজাইনের মার্জিত ৩-টায়ার বিয়ের কেক। বিশেষ দিনের জন্য প্রিমিয়াম সাজসজ্জা।', 3500.00, NULL, 67, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:41'),
(29, 'CAK-014', 'Cream Cake', 'ক্রিম কেক / মালাই কেক', 'cream-cake', '<ul>\n<li>Light, fluffy cream cake filled with generous layers of freshly whipped dairy cream and vanilla sponge.</li>\n<li>A delicate, ethereal cake that feels light as air yet delivers rich, satisfying flavor in every bite.</li>\n<li>The fresh cream frosting provides a clean, milky sweetness that is less heavy than buttercream alternatives.</li>\n<li>Decorated with fresh seasonal fruits on top for a beautiful presentation and natural fruity sweetness.</li>\n<li>Perfect for those who prefer a lighter, less sweet cake that doesn\'t overwhelm the palate.</li>\n<li>A popular choice for summer parties, daytime events, and as a refreshing dessert after heavy meals.</li>\n<li>Made with 100% real dairy cream — never non-dairy whipped topping or artificial cream substitutes.</li>\n<li>Best served chilled for the ultimate cream cake experience with optimal texture and flavor.</li>\n<li>Available in multiple fruit topping variations including strawberry, mango, pineapple, and mixed fruit.</li>\n</ul>', 'তাজা ক্রিমের স্তর সমৃদ্ধ ক্রিম কেক। হালকা, নরম এবং যেকোনো উদযাপনের জন্য আদর্শ।', 600.00, 540.00, 60, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:41'),
(30, 'CAK-015', 'Fruit Cake', 'ফ্রুট কেক / ফ্রুট টপিং কেক', 'fruit-cake', '<ul>\n<li>Classic fruit cake loaded with premium raisins, sultanas, candied peel, cherries, and mixed dried fruits.</li>\n<li>Rich, dense texture soaked in a blend of fruit juices and warm spices for deep, complex flavor.</li>\n<li>A traditional favorite for Christmas, weddings, Eid, and festive celebrations across cultures.</li>\n<li>The mixed fruits are pre-soaked for 48 hours to plump up and develop maximum flavor before baking.</li>\n<li>Enriched with butter, brown sugar, cinnamon, nutmeg, and a hint of ginger for a warm spiced profile.</li>\n<li>Aged fruit cakes develop even richer flavor — this cake tastes better a day or two after baking.</li>\n<li>Hearty and filling — a small slice goes a long way, making it perfect for large gatherings.</li>\n<li>Often chosen as the traditional wedding cake base, covered in marzipan and royal icing.</li>\n<li>A nostalgic, comforting cake that brings back memories of grandma\'s kitchen and family celebrations.</li>\n</ul>', 'মৌসুমি তাজা ফল দিয়ে টপ করা ফ্রুট কেক। প্রাকৃতিক মিষ্টতায় সতেজ স্বাদ।', 680.00, NULL, 97, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:41'),
(31, 'CAK-016', 'Anniversary Cake', 'বার্ষিকা কেক / স্মৃতি দিনের কেক', 'anniversary-cake', '<ul>\n<li>Elegant anniversary cake designed to celebrate love and togetherness with romantic decorations.</li>\n<li>Beautiful heart motifs, roses, and golden accents make this cake a symbol of your special bond.</li>\n<li>Customizable with the couple\'s names, anniversary year, and a personal love message on top.</li>\n<li>Available in premium flavors including red velvet, chocolate truffle, and classic vanilla sponge.</li>\n<li>Two-tier options available for milestone anniversaries like silver (25th) and golden (50th) celebrations.</li>\n<li>Each cake is individually designed by our pastry artists — no two anniversary cakes are exactly alike.</li>\n<li>Perfect for intimate dinners, surprise parties, and romantic celebrations with your loved one.</li>\n<li>Presented in an elegant gift box — ready to impress and create unforgettable anniversary memories.</li>\n<li>Complimentary anniversary candle and cake topper included with every order to complete the celebration.</li>\n</ul>', 'মার্জিত সাজসজ্জায় রোমান্টিক অ্যানিভার্সারি কেক। একসাথে কাটানো বছর উদযাপনের জন্য পারফেক্ট।', 1500.00, NULL, 63, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:41'),
(32, 'CAK-017', 'Heart Shape Cake', 'হার্ট শেপ কেক / ভালোবাসা কেক', 'heart-shape-cake', '<ul>\n<li>Charming heart-shaped cake that speaks the language of love — perfect for romantic occasions.</li>\n<li>Soft, fluffy sponge shaped into a perfect heart and decorated with beautiful cream and fondant work.</li>\n<li>An ideal gift for Valentine\'s Day, anniversaries, proposals, and \"just because I love you\" moments.</li>\n<li>Available in chocolate, red velvet, strawberry, and vanilla flavors for your loved one\'s favorite.</li>\n<li>Can be personalized with names, hearts, flowers, and a romantic message written in chocolate.</li>\n<li>Made with love by our skilled cake artists who specialize in romantic and themed cake designs.</li>\n<li>The heart shape makes an unforgettable impression — far more meaningful than a standard round cake.</li>\n<li>Available in 1lb and 2lb sizes — perfect for a couple\'s celebration or a small romantic gathering.</li>\n<li>Surprise your special someone with a heart cake that says more than words ever could.</li>\n</ul>', 'ভালোবাসা ও স্নেহের প্রতীক হার্ট আকৃতির কেক। ভ্যালেন্টাইন ডে বা রোমান্টিক অনুষ্ঠানের জন্য আদর্শ।', 720.00, NULL, 49, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:41'),
(33, 'CAK-018', 'Square Shape Cake', 'স্কয়ার শেপ কেক', 'square-shape-cake', '<ul>\n<li>Modern square-shaped cake with clean, geometric lines for a contemporary, sophisticated look.</li>\n<li>The sharp edges and flat surface provide an ideal canvas for modern cake art and message writing.</li>\n<li>Available in all popular flavors — chocolate, vanilla, red velvet, coffee, and fruit options.</li>\n<li>Perfect for corporate events, modern weddings, engagement parties, and minimalist celebrations.</li>\n<li>The square shape allows for easy, equal slicing — no more arguing over who got the bigger piece.</li>\n<li>Can be decorated with photo prints, logo designs, corporate branding, or artistic fondant work.</li>\n<li>A favorite choice for office parties, product launches, and business milestone celebrations.</li>\n<li>Stacked square tiers create a dramatic, modern wedding cake that stands out from traditional rounds.</li>\n<li>Combines modern aesthetics with our signature delicious taste — style meets substance in every slice.</li>\n</ul>', 'পরিষ্কার, আধুনিক ডিজাইনের বর্গাকার কেক। সমাবেশে কাটা এবং পরিবেশন করা সহজ।', 650.00, NULL, 92, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:41'),
(34, 'CAK-019', 'Round Shape Cake', 'গোলাকার শেপ কেক', 'round-shape-cake', '<ul>\n<li>Classic round-shaped cake — the traditional, timeless form factor for every kind of celebration.</li>\n<li>Perfectly circular layers stacked and frosted with smooth, even buttercream or cream cheese frosting.</li>\n<li>The round shape allows for beautiful piped decorations, rosettes, and floral patterns around the sides.</li>\n<li>Available in all flavors and sizes from intimate 1lb personal cakes to grand 5lb party cakes.</li>\n<li>The most popular cake shape for birthdays, anniversaries, and general celebration purposes.</li>\n<li>Easy to cut equal slices for all guests — a practical choice for parties and gatherings of any size.</li>\n<li>Serves as the perfect base for photo cakes, cartoon cakes, and custom theme decorations.</li>\n<li>Hand-frosted by our pastry chefs for a smooth, professional finish that looks great in photos.</li>\n<li>A reliable, versatile choice that pairs beautifully with any flavor, decoration, or celebration theme.</li>\n</ul>', 'যেকোনো অনুষ্ঠানের জন্য ক্লাসিক গোলাকার কেক। বিভিন্ন সাজসজ্জার জন্য বহুমুখী ডিজাইন।', 650.00, 585.00, 83, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:41'),
(35, 'CAK-020', 'Custom Cake', 'কাস্টম কেক / স্পেশাল ডিজাইন কেক', 'custom-cake', '<ul>\n<li>Fully custom cake — bring us your dream design and our pastry artists will bring it to life in cake.</li>\n<li>From superheroes to landscapes, logos to portraits — we can recreate virtually any design in cake form.</li>\n<li>Choose your flavor, size, shape, colors, and decoration theme for a truly one-of-a-kind creation.</li>\n<li>Perfect for themed birthday parties, brand launches, baby showers, and creative celebrations.</li>\n<li>Our experienced cake designers use fondant, buttercream, edible images, and hand-sculpted decorations.</li>\n<li>Submit your reference image or idea and receive a design consultation at no extra charge.</li>\n<li>Available in sizes from 2lb to 10lb+ — we handle everything from small family cakes to event showstoppers.</li>\n<li>Custom cakes require 3-7 days advance notice depending on design complexity and size.</li>\n<li>Because your special occasion deserves a cake that is as unique and memorable as the event itself.</li>\n</ul>', 'আপনার অনন্য ধারণার জন্য সম্পূর্ণ কাস্টমাইজেবল কেক। পছন্দের ফ্লেভার, ডিজাইন এবং বার্তা।', 2000.00, 1800.00, 87, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:41'),
(36, 'CAK-021', 'Cartoon Cake', 'কার্টুন কেক', 'cartoon-cake', '<ul>\n<li>Fun, colorful cartoon cake featuring your child\'s favorite animated characters hand-decorated in fondant.</li>\n<li>Popular themes include Peppa Pig, Paw Patrol, Frozen, Spider-Man, Ben 10, Mickey Mouse, and more.</li>\n<li>Each character and element is carefully hand-crafted by our cake artists for a professional, detailed look.</li>\n<li>The bright colors and beloved characters make this the ultimate birthday surprise for any child.</li>\n<li>Available in kid-friendly flavors — chocolate, vanilla, strawberry, and butterscotch are top picks.</li>\n<li>Made with food-safe, edible colors — all decorations are 100% edible and safe for children to consume.</li>\n<li>Can be paired with matching cupcakes, cookies, or cake pops for a complete themed party package.</li>\n<li>The look of pure joy on your child\'s face when they see their favorite character in cake form — priceless.</li>\n<li>A guaranteed hit at children\'s birthday parties — expect requests for seconds from all the little guests.</li>\n</ul>', 'শিশুদের জন্মদিনের মজার কার্টুন থিম কেক। জনপ্রিয় চরিত্র সাজসজ্জা সহ রঙিন ডিজাইন।', 1800.00, 1620.00, 13, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:41'),
(37, 'CAK-022', 'Photo Cake', 'ফটো কেক / ছবি প্রিন্ট কেক', 'photo-cake', '<ul>\n<li>Personalized photo cake featuring your cherished photo printed directly onto the cake with edible ink.</li>\n<li>Upload any photo — family portrait, baby picture, pet photo, or scenic shot — and we print it in high resolution.</li>\n<li>Edible image printing uses food-grade inks on sugar paper for a safe, delicious, and stunning result.</li>\n<li>The perfect gift for birthdays, anniversaries, farewells, memorials, and surprise celebrations.</li>\n<li>Available in round and square shapes with multiple size options to accommodate any group size.</li>\n<li>The photo is framed with beautiful cream borders, flowers, or decorative piping for a finished look.</li>\n<li>Made with soft sponge cake and your choice of frosting — chocolate, vanilla, or fruit cream options.</li>\n<li>A sentimental, unique cake that turns a sweet treat into a treasured memory and conversation piece.</li>\n<li>Just upload your photo at checkout and leave the rest to us — your edible masterpiece is just an order away.</li>\n</ul>', 'খাওয়ার যোগ্য ছবি প্রিন্টিং সহ পার্সোনালাইজড ফটো কেক। বিশেষ স্মৃতি উদযাপনের অনন্য উপায়।', 1600.00, 1440.00, 74, 4, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:41'),
(38, 'CAK-023', 'Fruit Flavored Cake', 'ফ্রুট ফ্লেভার কেক', 'fruit-flavored-cake', '<ul>\n<li>Refreshing fruit-flavored cake infused with the bright, tangy taste of your favorite seasonal fruits.</li>\n<li>Available in mango, strawberry, orange, pineapple, and mixed fruit flavor variations.</li>\n<li>Light, fluffy sponge paired with fruit-flavored cream that delivers a burst of fruity freshness.</li>\n<li>Topped with fresh fruit slices and fruit glaze for natural sweetness and a beautiful presentation.</li>\n<li>A lighter alternative to heavy chocolate cakes — perfect for summer parties and daytime events.</li>\n<li>The natural fruit flavors complement the soft cream and sponge for a balanced, refreshing dessert.</li>\n<li>Made with real fruit purees and extracts — not just artificial fruit syrups or flavor concentrates.</li>\n<li>Popular choice for children\'s parties, garden brunches, and as a refreshing after-meal dessert.</li>\n<li>Discover why fruit cakes are beloved across South Asia — sweet, fruity, and absolutely delightful.</li>\n</ul>', 'প্রাকৃতিক ফলের এক্সট্র্যাক্ট সহ সতেজ ফ্রুট ফ্লেভার্ড কেক। স্ট্রবেরি, আম, কমলার স্বাদে।', 720.00, NULL, 47, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:41'),
(39, 'CAK-024', 'Sponge Cake (Generic)', 'স্পঞ্জ কেক / ফোম কেক', 'sponge-cake-generic', '<ul>\n<li>Classic sponge cake with a light, airy crumb that practically floats on your palate.</li>\n<li>Made with a simple, elegant recipe of eggs, sugar, flour, and vanilla — letting quality shine through.</li>\n<li>The versatile base cake used by pastry chefs worldwide for trifles, shortcakes, and layered desserts.</li>\n<li>Lighter than butter cake but equally satisfying — a perfect everyday cake that never feels heavy.</li>\n<li>Excellent for absorbing syrups, fruit juices, and liqueurs to create soaked cake desserts.</li>\n<li>A humble yet delightful cake that proves simplicity, when done right, is the ultimate sophistication.</li>\n<li>Perfect for serving with afternoon chai, coffee, fresh cream, or a dusting of powdered sugar.</li>\n<li>Stays soft and springy for days — reheat briefly in the microwave to restore that fresh-baked warmth.</li>\n<li>The universal cake that every bakery needs — and ours is baked to golden, fluffy perfection daily.</li>\n</ul>', 'বহুমুখী স্বাদের হালকা স্পঞ্জ কেক। ট্রাইফল, টিরামিসু বা লেয়ার্ড ডেজার্টের আদর্শ বেস।', 420.00, 378.00, 81, 4, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 05:57:41'),
(40, 'CKI-001', 'Butter Cookies', 'মাখনের বিস্কুট / বাটার কুকি', 'butter-cookies', '<ul>\n<li>Classic butter cookies made with generous amounts of real, creamy butter for a rich, melt-in-mouth experience.</li>\n<li>Perfectly golden-baked with a delicate crispness that gives way to a tender, crumbly center.</li>\n<li>A timeless tea-time companion loved across generations — the essential cookie for every household.</li>\n<li>Made with premium butter, fine flour, and a hint of vanilla — no margarine or vegetable oil substitutes.</li>\n<li>The rich butter aroma that fills the room when you open the tin is simply irresistible.</li>\n<li>Ideal for gifting during Eid, Puja, Christmas, and other festive occasions in elegant packaging.</li>\n<li>Each cookie is hand-shaped and baked to uniform golden perfection for consistent quality.</li>\n<li>Pairs perfectly with chai, coffee, milk, or enjoyed as a standalone snack any time of day.</li>\n<li>A premium cookie experience that elevates the humble butter cookie to an artisan treat.</li>\n</ul>', 'সমৃদ্ধ, ক্রিমি স্বাদের ক্লাসিক বাটার কুকিজ। বিশুদ্ধ মাখন থেকে মুখে গলে যাওয়া টেক্সচার।', 120.00, 108.00, 75, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:00:20'),
(41, 'CKI-002', 'Chocolate Chip Cookies', 'চকোলেট চিপ কুকি', 'chocolate-chip-cookies', '<ul>\n<li>Irresistible chocolate chip cookies loaded with generous chunks of premium Belgian chocolate in every bite.</li>\n<li>Perfectly crispy golden edges with a soft, chewy center — the ideal cookie texture balance.</li>\n<li>Made with real Belgian chocolate chunks, not cheap chocolate chips, for a superior chocolate experience.</li>\n<li>Generous chocolate-to-cookie ratio ensures every single bite delivers a burst of melted chocolate.</li>\n<li>Baked fresh daily in small batches for maximum freshness and that just-out-of-the-oven taste.</li>\n<li>Our #1 best-selling cookie — loved by kids, teens, and adults with an equal passion for chocolate.</li>\n<li>Wonderful warm — heat for 10 seconds in the microwave for the ultimate melted chocolate experience.</li>\n<li>No artificial preservatives, flavors, or colors — just honest baking with premium ingredients.</li>\n<li>The cookie that started the chocolate chip revolution, perfected by our master bakers for you.</li>\n</ul>', 'প্রিমিয়াম চকলেট চাঙ্কসে ভরা চিউই চকলেট চিপ কুকিজ। মচমচে প্রান্ত, নরম কেন্দ্র।', 150.00, 135.00, 18, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:00:20'),
(42, 'CKI-003', 'Digestive Biscuits', 'ডাইজেস্টিভ বিস্কুট', 'digestive-biscuits', '<ul>\n<li>Wholesome digestive biscuits made with whole wheat flour and a touch of bran for added fiber.</li>\n<li>A healthy, satisfying biscuit with a slightly sweet, wheaty flavor and a crumbly, crunchy texture.</li>\n<li>The perfect guilt-free snack for health-conscious individuals who still want to enjoy a biscuit with tea.</li>\n<li>Contains whole grain goodness that aids digestion — hence the traditional name \"digestive\" biscuit.</li>\n<li>Excellent base for cheesecake crusts, pie bases, and dessert recipes requiring crushed biscuits.</li>\n<li>Mildly sweetened so the natural wheat flavor shines through — not overly sugary like regular biscuits.</li>\n<li>A classic British biscuit tradition adapted for the Bangladeshi palate with just the right sweetness.</li>\n<li>Firm enough to dunk in tea or coffee without breaking — the ultimate dunking biscuit experience.</li>\n<li>A pantry staple that families trust for a wholesome, anytime snack for children and adults alike.</li>\n</ul>', 'আঁশে সমৃদ্ধ পুষ্টিকর ডাইজেস্টিভ বিস্কুট। চা বা দুধের সাথে স্বাস্থ্যকর স্ন্যাকস।', 100.00, 90.00, 14, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:00:20');
INSERT INTO `products` (`id`, `sku`, `name_en`, `name_bn`, `slug`, `description_en`, `description_bn`, `price`, `sale_price`, `stock`, `category_id`, `views`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(43, 'CKI-004', 'Nankhatai', 'নানখাতাই', 'nankhatai', '<ul>\n<li>Traditional Nankhatai — the beloved Indian-Bengali shortbread cookie with centuries of heritage behind it.</li>\n<li>Made with ghee, gram flour, semolina, and cardamom for an authentic, aromatic flavor profile.</li>\n<li>Crumbly, melt-in-mouth texture with the rich, distinctive taste of pure ghee in every bite.</li>\n<li>A nostalgic cookie that transports you back to childhood visits to the local mithai shop with grandparents.</li>\n<li>Infused with cardamom and a hint of nutmeg for a warm, spiced aroma that fills the room.</li>\n<li>Perfect for Eid, Durga Puja, and traditional Bangladeshi celebrations where authentic flavors matter.</li>\n<li>Hand-shaped and slow-baked to achieve the characteristic cracked top and golden-brown bottom.</li>\n<li>Pairs beautifully with doodh chai (milk tea) — a match made in Bengali culinary heaven.</li>\n<li>A traditional cookie that represents the rich cultural heritage of South Asian baking traditions.</li>\n</ul>', 'এলাচ স্বাদের ঐতিহ্যবাহী ভারতীয় নানখাটাই। ঝরঝরে টেক্সচার, উৎসবমুখর অনুষ্ঠানের জন্য আদর্শ।', 130.00, NULL, 91, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:00:20'),
(44, 'CKI-005', 'Cashew Cookies', 'কাজু কুকি / কাজু বাদাম কুকি', 'cashew-cookies', '<ul>\n<li>Premium cashew cookies crafted with generous pieces of roasted cashew nuts for a luxurious crunch.</li>\n<li>Buttery cookie base loaded with whole cashew halves that deliver a rich, nutty flavor in every bite.</li>\n<li>Made with premium Goan cashews — known for their superior creaminess and naturally sweet taste.</li>\n<li>An elegant, sophisticated cookie perfect for gifting, tea parties, and upscale entertaining.</li>\n<li>The combination of buttery dough and roasted cashew creates a flavor harmony that is truly addictive.</li>\n<li>A high-protein cookie option thanks to the generous cashew content — slightly more nutritious than plain cookies.</li>\n<li>Beautifully golden-baked with visible cashew pieces on top for an artisan, handmade appearance.</li>\n<li>A favorite during Eid and festive seasons when premium quality cookies are exchanged as gifts.</li>\n<li>Experience the luxury of real cashew in every cookie — once you try these, regular cookies won\'t suffice.</li>\n</ul>', 'প্রচুর কাজু টুকরো সহ প্রিমিয়াম কাজু কুকিজ। সমৃদ্ধ, মাখনি স্বাদ এবং তৃপ্তিকর ক্রাঞ্চ।', 180.00, 162.00, 27, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:00:20'),
(45, 'CKI-006', 'Almond Cookie', 'বাদাম কুকি / বাদাম বিস্কুট', 'almond-cookie', '<ul>\n<li>Crunchy almond cookies studded with premium almond flakes and infused with almond extract.</li>\n<li>The delicate almond flavor permeates the entire cookie for a consistent nutty taste experience.</li>\n<li>Each cookie is topped with generous almond flakes that toast beautifully during baking for extra crunch.</li>\n<li>Made with real almonds — no artificial almond flavoring or synthetic nut extracts whatsoever.</li>\n<li>A sophisticated cookie choice for almond lovers who appreciate the subtle, refined taste of quality nuts.</li>\n<li>The crumbly, buttery texture combined with crunchy almond flakes creates a delightful contrast.</li>\n<li>Rich in vitamin E, healthy fats, and protein from real almonds — a smarter cookie snack option.</li>\n<li>Pairs wonderfully with green tea, black coffee, or a glass of warm milk for a comforting snack break.</li>\n<li>A premium cookie that elevates the humble almond to star status in every golden, nutty bite.</li>\n</ul>', 'কাটা বাদাম এবং বাদাম এক্সট্র্যাক্ট সহ বাদামি কুকিজ। মচমচে টেক্সচার সহ বাদামি স্বাদ।', 170.00, NULL, 41, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:00:20'),
(46, 'CKI-007', 'Coconut Cookie', 'নারিকেল কুকি / নারকেল বিস্কুট', 'coconut-cookie', '<ul>\n<li>Tropical coconut cookies made with freshly grated coconut and coconut milk for authentic island flavor.</li>\n<li>Soft, chewy center with a slightly crispy edge — the perfect coconut cookie texture combination.</li>\n<li>The sweet, fragrant aroma of toasted coconut fills every bite of these delightfully tropical treats.</li>\n<li>Made with real desiccated coconut and coconut cream — not artificial coconut flavoring agents.</li>\n<li>A beloved cookie across South Asia where coconut is a cherished ingredient in traditional sweets.</li>\n<li>The chewy coconut pieces add wonderful texture and tropical sweetness throughout the cookie.</li>\n<li>Perfect for summer tea parties, beach picnics, and as a unique addition to your cookie collection.</li>\n<li>Naturally slightly sweet and aromatic — a cookie that coconut fans will find absolutely irresistible.</li>\n<li>Transport yourself to tropical paradise with every bite of these coconut-studded, golden cookies.</li>\n</ul>', 'শুকনো নারকেল সহ ট্রপিক্যাল নারকেল কুকিজ। মিষ্টি, চিউই এবং নারকেল স্বাদে পূর্ণ।', 140.00, 126.00, 12, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:00:20'),
(47, 'CKI-008', 'Oats Cookie', 'ওটস কুকি / ওটস বিস্কুট', 'oats-cookie', '<ul>\n<li>Healthy oats cookies made with whole rolled oats, honey, and a touch of cinnamon for guilt-free snacking.</li>\n<li>Packed with dietary fiber from real oats that supports healthy digestion and keeps you full longer.</li>\n<li>Naturally sweetened with honey instead of refined sugar — a smarter choice for the health-conscious.</li>\n<li>Chewy, hearty texture with the satisfying crunch of rolled oats and a warm hint of cinnamon spice.</li>\n<li>A perfect pre-workout energy boost or afternoon snack that fuels your body without the sugar crash.</li>\n<li>Contains no maida — made entirely with whole oats and whole wheat flour for maximum nutrition.</li>\n<li>Great for weight management diets as a healthier alternative to regular cookies and sweet snacks.</li>\n<li>The cinnamon adds warmth and depth that elevates the simple oats cookie into something truly special.</li>\n<li>Fitness meets flavor in every cookie — healthy snacking has never tasted this delicious before.</li>\n</ul>', 'রোলড ওটস এবং মধু সহ স্বাস্থ্যকর ওট কুকিজ। নির্দোষ স্ন্যাকিংয়ের জন্য আঁশযুক্ত বিকল্প।', 135.00, 121.50, 25, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:00:20'),
(48, 'CKI-009', 'Sugar Cookie', 'চিনি কুকি', 'sugar-cookie', '<ul>\n<li>Classic sugar cookies with a crisp, buttery texture and a sparkling sugar topping that catches the light.</li>\n<li>Simple, pure ingredients — butter, sugar, flour, eggs, and vanilla — let the quality of each component shine.</li>\n<li>The dough is rolled and cut into perfect shapes, then topped with coarse sugar crystals for a satisfying crunch.</li>\n<li>A versatile cookie base perfect for decorating with icing, sprinkles, and food coloring for themed occasions.</li>\n<li>The clean, sweet vanilla-butter flavor makes these cookies universally loved by people of all ages.</li>\n<li>Ideal for cookie decorating parties, holiday baking, children\'s activities, and edible gift arrangements.</li>\n<li>Crispy on the edges and slightly softer in the center — the textbook sugar cookie texture everyone adores.</li>\n<li>A blank canvas for creativity — dye the dough, pipe icing, or stamp patterns for endless fun possibilities.</li>\n<li>The quintessential cookie that proves sometimes the simplest recipes create the most beloved treats.</li>\n</ul>', 'মচমচে বাইরে এবং নরম ভেতরের ক্লাসিক সুগার কুকিজ। যেকোনো সময়ের জন্য সাধারণ মিষ্টতা।', 110.00, 99.00, 32, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:00:20'),
(49, 'CKI-010', 'Cream Biscuit', 'ক্রিম বিস্কুট / মালাই বিস্কুট', 'cream-biscuit', '<ul>\n<li>Delightful cream biscuits with a smooth, sweet vanilla cream filling sandwiched between two crispy biscuits.</li>\n<li>The satisfying snap of the outer biscuit gives way to a soft, creamy center — the perfect textural contrast.</li>\n<li>A beloved childhood classic that brings back memories of lunchbox surprises and after-school treats.</li>\n<li>Made with real cream filling — not the waxy, artificial cream alternatives found in mass-produced brands.</li>\n<li>The vanilla cream is smooth, sweet, and perfectly balanced against the lightly salted biscuit shells.</li>\n<li>A crowd-pleasing biscuit for kids\' parties, school snacks, tea-time, and casual everyday munching.</li>\n<li>Convenient individually wrapped packs available — perfect for lunchboxes, travel, and on-the-go snacking.</li>\n<li>The biscuit shells are baked to a perfect crunch that holds the cream without crumbling or becoming soggy.</li>\n<li>Open a pack and experience why cream biscuits remain one of the most popular cookie varieties worldwide.</li>\n</ul>', 'ভ্যানিলা ক্রিম সহ ক্রিম-ফিলড স্যান্ডউইচ বিস্কুট। মসৃণ ক্রিমি সেন্টার সহ মচমচে বিস্কুট।', 125.00, NULL, 99, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:00:20'),
(50, 'CKI-011', 'Coconut Biscuit', 'নারিকেল বিস্কুট', 'coconut-biscuit', '<ul>\n<li>Crunchy coconut biscuits infused with real desiccated coconut throughout the dough for tropical flavor.</li>\n<li>Each biscuit is packed with toasted coconut flakes that release a wonderful nutty aroma with every bite.</li>\n<li>The double coconut effect — coconut in the dough AND on top — delivers maximum coconut satisfaction.</li>\n<li>A beloved biscuit variety across Bangladesh and South Asia where coconut is integral to the culinary tradition.</li>\n<li>The crispy texture and sweet coconut flavor make these biscuits incredibly addictive and hard to put down.</li>\n<li>Perfect for chai-time, school lunchboxes, and as a quick sweet snack with a glass of cold milk.</li>\n<li>Made with freshly grated coconut and a touch of cardamom for an authentic South Asian flavor profile.</li>\n<li>The golden-baked exterior provides a satisfying snap while the coconut inside stays wonderfully chewy.</li>\n<li>A tropical twist on the classic biscuit that will transport your taste buds to coconut groves and sandy beaches.</li>\n</ul>', 'ডো এবং টপিং উভয়ে নারকেল সহ ডাবল নারকেল বিস্কুট। সম্পূর্ণ জুড়ে তীব্র নারকেল স্বাদ।', 130.00, NULL, 38, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:00:20'),
(51, 'CKI-012', 'Jam Biscuit', 'জাম বিস্কুট / জাম পুরেল', 'jam-biscuit', '<ul>\n<li>Sweet jam biscuits featuring a buttery shortbread base topped with a dollop of fruit jam in the center.</li>\n<li>The combination of crumbly, buttery biscuit and sweet, tangy jam creates an irresistible flavor contrast.</li>\n<li>Each biscuit has a thumbprint indentation filled with real fruit jam — strawberry, raspberry, or mixed berry.</li>\n<li>A charming, homestyle cookie that looks as delightful on a cookie tray as it tastes in your mouth.</li>\n<li>The buttery shortbread base melts on the tongue while the jam center provides a fruity burst of sweetness.</li>\n<li>Perfect for holiday cookie plates, tea parties, children\'s snacks, and as a homemade-style bakery treat.</li>\n<li>Made with real fruit jam — no artificial jelly or synthetic fruit syrups in our jam centers.</li>\n<li>The visual appeal of the jam-filled center makes these biscuits a standout in any cookie assortment box.</li>\n<li>A nostalgic cookie that combines two favorites — buttery shortbread and sweet fruit jam — in one perfect bite.</li>\n</ul>', 'ফলের জ্যাম সেন্টার সহ জ্যাম-ফিলড বিস্কুট। প্রতিটি কামড়ে মিষ্টি জ্যাম সারপ্রাইজ।', 140.00, 126.00, 58, 5, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:00:20'),
(52, 'CKI-013', 'Assorted Biscuits', 'মিক্সড বিস্কুট / বিস্কুট প্যাকেট', 'assorted-biscuits', '<ul>\n<li>Premium assorted biscuit collection featuring a curated variety of our finest cookie creations in one box.</li>\n<li>Includes butter cookies, chocolate chip, coconut, almond, jam-filled, and digestive varieties in each box.</li>\n<li>Every biscuit is individually crafted and baked to perfection — this is our showcase of baking excellence.</li>\n<li>The perfect gift box for Eid, Durga Puja, Christmas, birthdays, and any celebration requiring premium sweets.</li>\n<li>Beautifully presented in an elegant tin or box with individual compartments to keep each variety fresh.</li>\n<li>A sampler that lets you discover your favorites before committing to a full pack of any single variety.</li>\n<li>Each biscuit variety is baked fresh and sealed for maximum crunch and flavor preservation in the box.</li>\n<li>Ideal for serving guests at tea-time, parties, and family gatherings where variety satisfies every preference.</li>\n<li>The ultimate biscuit gift — premium quality, beautiful presentation, and delicious variety all in one package.</li>\n</ul>', 'বিভিন্ন স্বাদের বিস্কুটের অ্যাসর্টেড প্যাক। বিস্কুটপ্রেমীদের জন্য আদর্শ উপহার প্যাক।', 160.00, 144.00, 97, 5, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:00:20'),
(53, 'SWT-001', 'Roshogolla (6 pcs)', 'রসগোল্লা (৬ পিস)', 'roshogolla-6-pcs', '<ul>\n<li>Authentic Bengali roshogolla — soft, spongy cheese balls soaked in light sugar syrup to sweet perfection.</li>\n<li>Made from fresh chhena (cottage cheese) kneaded and rolled into perfectly round, smooth balls.</li>\n<li>The syrup is delicately flavored with cardamom for a fragrant, aromatic sweetness that is not cloying.</li>\n<li>Each roshogolla is springy-soft with a melt-in-mouth texture that Bengalis have loved for centuries.</li>\n<li>Pack of 6 pieces — perfect for a small family dessert, Iftar treat, or after-meal sweet indulgence.</li>\n<li>Made fresh daily by our halwais using time-honored Bengali sweet-making techniques and recipes.</li>\n<li>No synthetic colors or flavors — the pure white color comes from fresh, high-quality milk and proper technique.</li>\n<li>Best served chilled for the classic Bengali roshogolla experience that pairs with every celebration.</li>\n<li>The quintessential Bengali sweet — no celebration in Bangladesh is complete without roshogolla on the table.</li>\n</ul>', 'চিনির সিরায় ভেজানো ৬টি নরম, স্পঞ্জি রসগোল্লা। মুখে গলে যাওয়া টেক্সচার সহ ক্লাসিক বাঙালি মিষ্টি।', 120.00, NULL, 89, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(54, 'SWT-002', 'Roshogolla (12 pcs)', 'রসগোল্লা (১২ পিস)', 'roshogolla-12-pcs', '<ul>\n<li>Authentic Bengali roshogolla — soft, spongy cheese balls soaked in light cardamom-scented sugar syrup.</li>\n<li>Family-size pack of 12 pieces — perfect for larger gatherings, parties, and festive celebrations.</li>\n<li>Made fresh from premium chhena, hand-rolled into perfectly smooth, round balls before syrup soaking.</li>\n<li>The spongy texture absorbs the light syrup beautifully, delivering sweetness in every soft, juicy bite.</li>\n<li>Classic white roshogolla made with pure milk — no artificial colors, flavors, or preservatives added.</li>\n<li>A must-have sweet for Eid, Durga Puja, weddings, and every joyous occasion in Bengali culture.</li>\n<li>Our halwais use generations-old techniques to achieve the perfect balance of softness and syrup absorption.</li>\n<li>Better value with the 12-piece pack — ideal for families, guests, and anyone who simply loves roshogolla.</li>\n<li>The king of Bengali sweets in a generous family pack — because 6 pieces are never enough for roshogolla lovers.</li>\n</ul>', 'পারিবারিক আয়োজনের জন্য ১২টি রসগোল্লার প্যাক। বিশুদ্ধ দুধ এবং মানসম্মত চিনি দিয়ে তাজা তৈরি।', 220.00, NULL, 96, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(55, 'SWT-003', 'Sandesh (10 pcs)', 'সন্দেশ (১০ পিস)', 'sandesh-10-pcs', '<ul>\n<li>Delicate Bengali sandesh made from freshly prepared chhena, lightly sweetened and molded into elegant shapes.</li>\n<li>Pack of 10 pieces — each one individually crafted with a smooth, silky texture and mild, milky sweetness.</li>\n<li>A refined, sophisticated Bengali sweet where the quality of milk and technique truly shines through.</li>\n<li>Lighter and less sweet than many Indian sweets — perfect for those who prefer subtle, elegant flavors.</li>\n<li>Made from fresh, warm chhena that is kneaded to silky smoothness before sweetening and shaping.</li>\n<li>The clean, milky flavor with a hint of cardamom makes sandesh a perfect tea-time or after-meal sweet.</li>\n<li>Each piece is a work of art — smooth, uniform, and reflecting the artisan skill of our master halwai.</li>\n<li>A beloved sweet across Bengal that represents the refined, delicate side of Bengali confectionery tradition.</li>\n<li>Refrigerate for a firmer texture or enjoy at room temperature for a softer, creamier experience.</li>\n</ul>', '১০টি সন্দেশের প্যাক, হালকা এবং সুগন্ধযুক্ত। তাজা ছানা এবং এলাচ এসেন্স দিয়ে তৈরি।', 180.00, 162.00, 35, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(56, 'SWT-004', 'Sandesh (Cream)', 'ক্রিম সন্দেশ / মালাই সন্দেশ', 'sandesh-cream', '<ul>\n<li>Luxurious cream sandesh with a smooth, velvety cream filling inside each delicate chhena shell.</li>\n<li>The combination of firm outer sandesh and soft, sweet cream center creates a delightful textural contrast.</li>\n<li>A modern variation of the classic sandesh that adds a rich, indulgent cream dimension to the traditional sweet.</li>\n<li>Made with fresh malai (clotted cream) for the filling — not artificial cream or synthetic substitutes.</li>\n<li>Each piece is carefully molded and filled by hand to ensure the perfect cream-to-sandesh ratio.</li>\n<li>The cream center oozes slightly when you bite in — a delicious surprise that elevates the sandesh experience.</li>\n<li>Perfect for special occasions, gifting, and as a premium dessert option for distinguished guests.</li>\n<li>A crowd favorite at weddings, engagement ceremonies, and festive gatherings across Bangladesh.</li>\n<li>The best of both worlds — traditional sandesh craftsmanship meets modern cream-filled indulgence.</li>\n</ul>', 'সমৃদ্ধ ক্রিম ফিলিং সহ ক্রিমি সন্দেশ ভ্যারিয়েন্ট। হালকা মিষ্টতা সহ মসৃণ টেক্সচার।', 220.00, NULL, 51, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(57, 'SWT-005', 'Sandesh (Pistachio)', 'কাজু সন্দেশ / পিস্তাচিও সন্দেশ', 'sandesh-pistachio', '<ul>\n<li>Premium pistachio sandesh topped with crushed pistachio nuts for a luxurious, nutty crunch and green color accent.</li>\n<li>The buttery, nutty flavor of pistachios complements the mild, milky sweetness of the sandesh perfectly.</li>\n<li>Made with imported Iranian pistachios — known for their superior flavor, vibrant color, and premium quality.</li>\n<li>A gourmet variation of the classic sandesh that adds elegance and sophistication to any sweet box.</li>\n<li>The pistachio topping provides a wonderful crunch that contrasts the smooth, silky sandesh texture.</li>\n<li>Perfect for gifting during Eid, Puja, and celebrations where only the finest sweets will be presented.</li>\n<li>Each piece is generously topped with pistachio crumbs — not just a garnish, but an integral part of the flavor.</li>\n<li>A premium sweet that looks beautiful on any dessert table with its distinctive green pistachio crown.</li>\n<li>The ultimate sandesh upgrade — because sometimes classic deserves a touch of luxury and nutty elegance.</li>\n</ul>', 'কাটা পেস্তা দিয়ে টপ করা প্রিমিয়াম পেস্তা সন্দেশ। মার্জিত উপস্থাপনা সহ বাদামি স্বাদ।', 280.00, NULL, 43, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(58, 'SWT-006', 'Sandesh (Saffron)', 'জাফরান সন্দেশ', 'sandesh-saffron', '<ul>\n<li>Exquisite saffron sandesh infused with premium Kashmiri saffron for a golden hue and aromatic floral sweetness.</li>\n<li>The delicate saffron flavor adds an exotic, luxurious dimension to the classic Bengali sandesh.</li>\n<li>Made with genuine Kashmiri kesar — each strand imparting its signature golden color and honey-like aroma.</li>\n<li>A premium sweet that has been cherished by Bengali royalty and connoisseurs for its refined taste.</li>\n<li>The beautiful golden-yellow color from saffron makes this sandesh visually stunning on any dessert spread.</li>\n<li>Each piece is infused with saffron during the chhena preparation for even flavor distribution throughout.</li>\n<li>Perfect for upscale gifting, festive celebrations, and occasions that call for something truly special.</li>\n<li>Saffron is known as the world\'s most expensive spice — this sandesh reflects that luxury in every bite.</li>\n<li>A royal twist on a Bengali classic — the golden color and exotic aroma make every piece a treasure.</li>\n</ul>', 'প্রিমিয়াম কাশ্মীরি জাফরান ইনফিউজড রাজকীয় জাফরান সন্দেশ। সুগন্ধি এবং বিলাসবহুল মিষ্টি।', 260.00, 234.00, 26, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(59, 'SWT-007', 'Gulab Jamun (12 pcs)', 'গোলাপ জামুন (১২ পিস)', 'gulab-jamun-12-pcs', '<ul>\n<li>Classic gulab jamun — soft, golden-brown milk dumplings soaked in fragrant rose-cardamom sugar syrup.</li>\n<li>Pack of 12 pieces — generous enough for family desserts, parties, and festive celebration servings.</li>\n<li>Made from khoya (reduced milk solids) dough, fried to a perfect golden brown before syrup soaking.</li>\n<li>The dumplings are soft, spongy, and absorb the rose-scented syrup completely for sweet, juicy perfection.</li>\n<li>Infused with real rose water and cardamom in the syrup — authentic flavor that defines classic gulab jamun.</li>\n<li>A beloved sweet across all South Asian cultures — a staple at weddings, Eid, Diwali, and every celebration.</li>\n<li>Best served warm — the syrup flows and the dumplings become even softer and more melt-in-your-mouth.</li>\n<li>Made fresh daily in our kitchen — never pre-packaged or preserved with artificial syrup extenders.</li>\n<li>The undisputed king of South Asian sweets — no celebration table is complete without gulab jamun.</li>\n</ul>', 'গোলাপ সিরায় ভেজানো ১২টি গোলাপ জামুনের প্যাক। ঐশ্বরিয় স্বাদের ডিপ-ফ্রাইড দুধের ডাম্পলিং।', 180.00, 162.00, 54, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(60, 'SWT-008', 'Gulab Jamun (Rose)', 'গোলাপ গোলাব জামুন / লাল গোলাব', 'gulab-jamun-rose', '<ul>\n<li>Premium gulab jamun infused with extra rose water for an intensely floral, aromatic syrup experience.</li>\n<li>The rose-flavored syrup elevates the classic gulab jamun to a fragrant, gourmet-level dessert.</li>\n<li>Made with real rose extract — not synthetic rose essence — for an authentic, natural floral sweetness.</li>\n<li>The dumplings are soaked longer in the rose syrup for deeper flavor penetration into every soft layer.</li>\n<li>A romantic, fragrant variation perfect for weddings, Valentine\'s celebrations, and elegant dinner parties.</li>\n<li>The rose aroma hits you the moment you open the box — an olfactory preview of the deliciousness within.</li>\n<li>Each piece glistens with the fragrant rose syrup, making them as beautiful to look at as to eat.</li>\n<li>A sophisticated take on the traditional gulab jamun that rose lovers and sweet connoisseurs will adore.</li>\n<li>Elevate your dessert table with the enchanting fragrance and taste of rose-infused gulab jamun.</li>\n</ul>', 'বাড়তি গোলাপ এসেন্স সহ বিশেষ রোজ গোলাপ জামুন। বিশেষ অনুষ্ঠানের জন্য সুগন্ধি মিষ্টি।', 200.00, NULL, 38, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(61, 'SWT-009', 'Kalo Jam', 'কালো জাম', 'kalo-jam', '<ul>\n<li>Traditional kalo jam — dark, rich milk dumplings with a dense, fudgy interior and deep caramelized sweetness.</li>\n<li>Darker and denser than gulab jamun, with a more concentrated flavor from extended frying and syrup soaking.</li>\n<li>Made from khoya dough fried until deeply golden, then soaked in thick, cardamom-scented sugar syrup.</li>\n<li>The interior is wonderfully dense and creamy — almost like a fudge — with a rich, caramel-like depth.</li>\n<li>A beloved traditional Bengali sweet that showcases the depth and complexity of South Asian confectionery.</li>\n<li>The dark exterior gives way to a lighter, cream-colored interior — a beautiful contrast in every piece.</li>\n<li>Perfect for those who find gulab jamun too soft — kalo jam offers a more substantial, satisfying bite.</li>\n<li>A nostalgic sweet that Bengali grandmothers have been making for generations using traditional techniques.</li>\n<li>Experience the rich, dark cousin of gulab jamun — deeper in flavor, denser in texture, and utterly divine.</li>\n</ul>', 'গভীর ক্যারামেলাইজড স্বাদের গাঢ়, ঘন কালো জাম। সমৃদ্ধ বাঙালি মিষ্টি সুস্বাদী।', 160.00, 144.00, 25, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(62, 'SWT-010', 'Kalo Jam (24 pcs)', 'কালো জাম (২৪ পিস)', 'kalo-jam-24-pcs', '<ul>\n<li>Family-size kalo jam pack of 24 pieces — perfect for large gatherings, events, and serious kalo jam fans.</li>\n<li>Each piece maintains the same premium quality — dark, dense, and deeply caramelized as traditional kalo jam should be.</li>\n<li>Made from khoya dough, double-fried for extra dark color, then soaked in aromatic cardamom sugar syrup.</li>\n<li>The dense, fudgy center and deep caramel notes make every piece an indulgent, satisfying experience.</li>\n<li>A generous pack that ensures everyone at the party gets their fill of this beloved traditional sweet.</li>\n<li>Excellent value for the quantity — perfect for weddings, community Iftars, and large family celebrations.</li>\n<li>The thick, dark sugar syrup clings to each piece, ensuring maximum flavor in every single bite.</li>\n<li>Our master halwai prepares large batches with the same care and attention as small ones — quality never compromised.</li>\n<li>Because when kalo jam is this good, 24 pieces might still not be enough — but it is a very good start.</li>\n</ul>', '২৪টি কালো জামের পারিবারিক প্যাক। বড় আয়োজন এবং উৎসবের জন্য আদর্শ।', 300.00, 270.00, 42, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(63, 'SWT-011', 'Khejur', 'খেজুর', 'khejur', '<ul>\n<li>Premium khejur (date sweet) made from quality date palm jaggery — a treasured Bengali winter delicacy.</li>\n<li>Made with fresh date palm extract (khejurer rosh) for an authentic, earthy, naturally caramel-like sweetness.</li>\n<li>The rich, smoky-sweet flavor of date palm jaggery is unique and cannot be replicated by any other sweetener.</li>\n<li>A seasonal specialty traditionally made during the Bengali winter months when date palms produce fresh sap.</li>\n<li>The soft, fudgy texture melts on the tongue, releasing waves of caramel, toffee, and earthy date flavor.</li>\n<li>Often shaped into distinctive forms and sometimes studded with nuts for added texture and visual appeal.</li>\n<li>A beloved sweet across rural and urban Bengal — the taste of winter tradition and Bengali culinary heritage.</li>\n<li>Made using traditional techniques passed down through generations of Bengali sweet artisans.</li>\n<li>A rare, seasonal delicacy that celebrates the unique flavors of Bengal — available in limited quantities.</li>\n</ul>', 'প্রিমিয়াম খেজুর ভর্তি খেজুর মিষ্টি। মানসম্মত খেজুর থেকে প্রাকৃতিক মিষ্টতা।', 180.00, NULL, 39, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(64, 'SWT-012', 'Roshmalai', 'রশমালাই', 'roshmalai', '<ul>\n<li>Creamy roshmalai — soft, flattened chhena discs soaked in thick, sweetened, cardamom-scented milk cream.</li>\n<li>The chhena patties are pillowy-soft and absorb the rich, creamy milk for an incredibly indulgent experience.</li>\n<li>Served in a bowl of sweet, thickened milk (rabdi) — every spoonful combines soft chhena with creamy richness.</li>\n<li>The chilled, creamy milk with soft chhena discs is the most refreshing and luxurious Bengali dessert experience.</li>\n<li>Made fresh daily — the milk base is slowly reduced and sweetened to achieve the perfect creamy consistency.</li>\n<li>A premium sweet that is often served at weddings, celebrations, and as the grand finale of a festive meal.</li>\n<li>The saffron and cardamom in the milk add aromatic depth that elevates the entire dessert to gourmet level.</li>\n<li>Must be kept refrigerated — serve chilled for the best roshmalai experience with optimal texture and flavor.</li>\n<li>The queen of Bengali desserts — if roshogolla is the king, roshmalai is the undisputed royal queen.</li>\n</ul>', 'মিষ্টি দুধের ক্রিমে ভাসমান নরম রসমালাই বল। ঐশ্বরিয় স্বাদের সূক্ষ্ম মিষ্টি।', 220.00, 198.00, 78, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(65, 'SWT-013', 'Mawa', 'মোয়া / মাওয়া', 'mawa', '<ul>\n<li>Traditional mawa (khoya) sweet made by slowly reducing fresh milk to a dense, fudgy, caramelized solid.</li>\n<li>The slow reduction process concentrates the milk\'s natural sugars, creating a deep, caramel-like richness.</li>\n<li>A pure, honest sweet with minimal ingredients — just milk, a little sugar, and cardamom for fragrance.</li>\n<li>The grainy, crumbly texture of good mawa is a testament to proper technique and patience in preparation.</li>\n<li>Used as a base ingredient in many traditional sweets and also enjoyed on its own as a simple, rich treat.</li>\n<li>Made from pure whole milk — never made from milk powder or shortcuts that compromise authentic flavor.</li>\n<li>The milk is stirred continuously for hours to prevent burning and achieve the perfect golden color and texture.</li>\n<li>A versatile sweet that pairs beautifully with puri, paratha, or as a standalone dessert after any meal.</li>\n<li>The foundation of traditional Indian sweet-making — experience pure, concentrated milk sweetness at its finest.</li>\n</ul>', 'জমাট দুধ দিয়ে তৈরি ঐতিহ্যবাহী মাওয়া। কনসেনট্রেটেড দুধের স্বাদ সহ ঘন, সমৃদ্ধ টেক্সচার।', 300.00, NULL, 20, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(66, 'SWT-014', 'Shingara', 'শিঙারা / সিংডা', 'shingara', '<ul>\n<li>Authentic Bangladeshi shingara — crispy, flaky pastry triangles stuffed with spiced potato and vegetable filling.</li>\n<li>The multi-layered, flaky crust shatters satisfyingly when you bite into it, revealing the hot, savory filling.</li>\n<li>Filled with a classic mixture of potatoes, peas, carrots, and aromatic spices like cumin and coriander.</li>\n<li>Deep-fried to a perfect golden brown that ensures maximum crispiness without being greasy or oily.</li>\n<li>A beloved Bangladeshi street food and tea-time snack that is deeply woven into the country\'s food culture.</li>\n<li>Perfect for Iftar during Ramadan — shingara is one of the most popular items on every Iftar plate.</li>\n<li>The spice blend is perfectly balanced — flavorful and aromatic without being overly hot or spicy.</li>\n<li>Best enjoyed fresh and hot with a cup of cha (tea) and green chutney for the complete experience.</li>\n<li>The Bangladeshi cousin of the Indian samosa — similar but with its own unique crust and filling style.</li>\n</ul>', 'মশলাদার সবজি বা মাংস পুর সহ মচমচে সিঙাড়া। স্তরযুক্ত আবরণ সহ জনপ্রিয় বাঙালি স্ন্যাকস।', 40.00, 36.00, 95, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(67, 'SWT-015', 'Jalebi', 'জিলাপি', 'jalebi', '<ul>\n<li>Classic jalebi — crispy, coiled spirals of fermented batter soaked in warm, saffron-cardamom sugar syrup.</li>\n<li>The batter is piped in concentric circles into hot oil, creating the iconic pretzel-like spiral shape.</li>\n<li>Fried until crispy and golden, then immediately immersed in warm syrup for a sweet, crunchy-juicy contrast.</li>\n<li>The outside stays wonderfully crisp while the inside absorbs the syrup for a soft, sweet, syrupy center.</li>\n<li>Infused with saffron for a golden color and cardamom for an aromatic, warm spice note in the syrup.</li>\n<li>Best served hot and fresh — the contrast of crispy exterior and warm syrup is an experience like no other.</li>\n<li>A beloved sweet across South Asia — the centerpiece of breakfast spreads, celebrations, and festive occasions.</li>\n<li>Perfect for dipping in warm milk (jalebi with doodh) — a classic combination that sweet lovers swear by.</li>\n<li>The sound of the first crispy bite, followed by a burst of warm syrup — jalebi is a symphony for the senses.</li>\n</ul>', 'জাফরান সিরায় ভেজানো মচমচে, কুণ্ডলী জিলাপি। টক-মিষ্টি স্বাদের উজ্জ্বল কমলা মিষ্টি।', 100.00, NULL, 70, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(68, 'SWT-016', 'Jalebi (Thin)', 'চুনা জিলাপি', 'jalebi-thin', '<ul>\n<li>Thin, crispy jalebi variant — delicately piped into finer spirals for extra crunch and elegance.</li>\n<li>The thinner shape means more surface area is fried to crispy perfection — ideal for maximum crunch lovers.</li>\n<li>Soaked in the same fragrant saffron-cardamom syrup as our regular jalebi but with a crispier, lighter texture.</li>\n<li>The thin coils are almost lace-like in their delicacy — a more refined, artisan version of the classic jalebi.</li>\n<li>A premium variety preferred by those who enjoy their jalebi extra crispy with less soft interior.</li>\n<li>Beautiful to look at — the thin, golden spirals create an intricate, web-like pattern on the plate.</li>\n<li>Perfect for elegant dessert presentations, wedding sweet tables, and upscale Iftar spreads.</li>\n<li>The crunch factor is significantly higher than regular jalebi — every bite is a satisfying crackle.</li>\n<li>Thin jalebi: because sometimes you want all the crispy, syrupy goodness with an extra satisfying crunch.</li>\n</ul>', 'অতিরিক্ত মচমচে পাতলা, সূক্ষ্ম জিলাপি। ক্লাসিক মিষ্টির হালকা সংস্করণ।', 110.00, NULL, 96, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(69, 'SWT-017', 'Chamcham', 'চমচম', 'chamcham', '<ul>\n<li>Classic Bengali cham cham — oval-shaped, syrup-soaked milk sweet coated in fresh coconut flakes.</li>\n<li>Soft, spongy chhena dough shaped into distinctive oval forms and cooked in light sugar syrup until fluffy.</li>\n<li>Generously rolled in fresh, white coconut flakes that add a wonderful tropical crunch and visual appeal.</li>\n<li>The combination of soft, sweet chhena and coconut is a beloved Bengali pairing that has stood the test of time.</li>\n<li>Often colored in pastel pink, white, and yellow for a beautiful, festive presentation on sweet platters.</li>\n<li>A wedding staple across Bengal — cham cham is an essential part of the traditional Bengali wedding sweet tray.</li>\n<li>The coconut coating stays fresh and slightly chewy, complementing the soft, syrupy interior perfectly.</li>\n<li>Made fresh daily by our experienced halwais who have perfected the art of cham cham over decades.</li>\n<li>A cheerful, colorful, and delicious Bengali sweet that brings joy to every celebration and gathering.</li>\n</ul>', 'ক্রিমি আবরণ সহ রঙিন চমচম। উজ্জ্বল রঙে নরম, স্পঞ্জি টেক্সচার।', 140.00, 126.00, 31, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(70, 'SWT-018', 'Pantua', 'পান্তুয়া', 'pantua', '<ul>\n<li>Traditional pantua — dark, round, deep-fried milk dumplings soaked in thick, aromatic sugar syrup.</li>\n<li>Similar to gulab jamun but with a darker, more caramelized exterior and a denser, richer interior.</li>\n<li>Fried at a higher temperature to achieve the characteristic dark brown, almost black, caramelized crust.</li>\n<li>The syrup is thicker and more concentrated than gulab jamun syrup, creating a more intense sweetness.</li>\n<li>A traditional Bengali sweet that is often preferred over gulab jamun by those who enjoy deeper, darker flavors.</li>\n<li>The interior is dense and creamy — almost custard-like — with notes of caramel from the extended frying.</li>\n<li>A specialty sweet that requires particular skill to fry evenly without burning — our halwais are masters of this art.</li>\n<li>Perfect for festive occasions when you want something traditional, rich, and distinctively Bengali on the table.</li>\n<li>Pantua is gulab jamun\'s darker, bolder cousin — for those who believe darker means more delicious.</li>\n</ul>', 'চিনির সিরায় ভেজানো ডিপ-ফ্রাইড পান্তুয়া। গাঢ় বাইরের সাথে গোলাপ জামুনের মতো।', 150.00, 135.00, 83, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(71, 'SWT-019', 'Laddu', 'লাড্ডু / মোতি লাড্ডু', 'laddu', '<ul>\n<li>Classic laddu — perfectly round, golden gram flour balls made with pure ghee, sugar, and cardamom.</li>\n<li>Made from besan (gram flour) roasted in pure ghee, then sweetened and shaped into smooth, round balls.</li>\n<li>The aromatic combination of roasted gram flour, ghee, and cardamom creates an irresistible nutty sweetness.</li>\n<li>Each laddu is hand-rolled to a perfect sphere with a smooth, glossy surface that reflects expert craftsmanship.</li>\n<li>No South Asian celebration is complete without laddu — it is the universal symbol of joy and festivity.</li>\n<li>The crumbly yet cohesive texture melts on the tongue, releasing waves of ghee-roasted, sweet flavor.</li>\n<li>Made with pure desi ghee — never vegetable ghee or oil — for authentic taste and aroma that real laddu demands.</li>\n<li>Perfect for Ganesh Chaturthi, Diwali, Eid, weddings, and as a prasad offering in temples and homes.</li>\n<li>The most iconic round sweet in South Asian tradition — every celebration deserves the golden perfection of laddu.</li>\n</ul>', 'বেসন এবং চিনি দিয়ে তৈরি গোলাকার লাড্ডু। বাদামি স্বাদের ক্লাসিক উৎসবমুখর মিষ্টি।', 200.00, NULL, 25, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(72, 'SWT-020', 'Laddu (Color)', 'রাঙ লাড্ডু', 'laddu-color', '<ul>\n<li>Festive colored laddu — the classic besan laddu in vibrant, cheerful colors for celebrations and special occasions.</li>\n<li>Available in a rainbow of natural food colors — saffron yellow, green (pistachio), and pink (rose) varieties.</li>\n<li>The same premium besan and pure ghee recipe as our classic laddu, enhanced with natural color and flavor infusions.</li>\n<li>Beautiful on a festive sweet platter — the bright colors add visual excitement and joy to any celebration spread.</li>\n<li>Colored using natural ingredients like saffron, rose water, and pistachio — no synthetic food dyes used.</li>\n<li>Each colored laddu has its own subtle flavor twist — saffron for yellow, cardamom for green, rose for pink.</li>\n<li>A hit with children who love the bright colors — makes any kids\' party or school event more fun and festive.</li>\n<li>Perfect for Navratri, Holi, Eid, birthday parties, and any celebration that calls for colorful, joyful sweets.</li>\n<li>Classic laddu taste with a colorful twist — because celebrations deserve both delicious flavor and visual delight.</li>\n</ul>', 'উজ্জ্বল ফুড কালার সহ রঙিন লাড্ডু ভ্যারিয়েন্ট। একই দুর্দান্ত স্বাদে উৎসবমুখর চেহারা।', 220.00, 198.00, 11, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(73, 'SWT-021', 'Barfi', 'বরফি / খোয়া বরফি', 'barfi', '<ul>\n<li>Traditional barfi — dense, fudgy milk-based sweet cut into diamond shapes, often decorated with silver leaf.</li>\n<li>Made from thickened, sweetened milk (khoya/mawa) cooked slowly until it reaches a dense, sliceable consistency.</li>\n<li>The smooth, fudgy texture delivers a concentrated milky sweetness with hints of cardamom in every piece.</li>\n<li>Available in multiple flavors including plain (milk), pistachio, cashew, coconut, and rose varieties.</li>\n<li>Often topped with edible silver foil (vark) for an elegant, traditional presentation worthy of festive gifting.</li>\n<li>A versatile sweet that is equally at home on a wedding sweet tray or as a simple after-dinner treat with tea.</li>\n<li>The dense, rich nature means a small piece is incredibly satisfying — quality over quantity in every diamond.</li>\n<li>One of the most widely recognized and loved Indian sweets — a staple in every mithai shop across South Asia.</li>\n<li>The essence of traditional Indian confectionery — pure, concentrated milk sweetness in an elegant diamond form.</li>\n</ul>', 'রুপোর পাতা সাজসজ্জা সহ ঘন দুধের বরফি। বিশেষ উদযাপনের জন্য সমৃদ্ধ, ফাজি মিষ্টি।', 280.00, NULL, 35, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(74, 'SWT-022', 'Payesh', 'পায়েশ / গুড়ের পায়েশ', 'payesh', '<ul>\n<li>Traditional payesh — Bengali rice pudding made with fragrant gobindobhog rice, milk, sugar, and nuts.</li>\n<li>Slow-cooked for hours until the rice is perfectly tender and the milk thickens into creamy, sweet perfection.</li>\n<li>The small, aromatic gobindobhog rice grains add a distinctive floral fragrance unique to authentic Bengali payesh.</li>\n<li>Garnished with fried cashews, raisins, and sometimes dates for added texture, richness, and visual appeal.</li>\n<li>A celebratory dessert in Bengali culture — payesh is a must for birthdays, anniversaries, and auspicious occasions.</li>\n<li>The creamy, sweet milk coats each rice grain, creating a comforting, warm dessert experience like no other.</li>\n<li>Served warm or chilled — both ways are delicious, though traditionalists often prefer it at room temperature.</li>\n<li>Made with full-fat milk for maximum creaminess — a rich, indulgent dessert that is worth every calorie.</li>\n<li>The Bengali birthday tradition — no birthday in Bengal is complete without a bowl of payesh from loved ones.</li>\n</ul>', 'দুধ দিয়ে স্লো-কুকড ক্রিমি চালের পায়েস। সুগন্ধি মশলা সহ ঐতিহ্যবাহী বাঙালি চালের পুডিং।', 350.00, 315.00, 52, 6, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(75, 'SWT-023', 'Kheer', 'খীর', 'kheer', '<ul>\n<li>Rich, creamy kheer — traditional South Asian rice pudding slow-cooked to thick, velvety perfection.</li>\n<li>Made by simmering rice in sweetened milk with cardamom, saffron, and premium nuts until thick and luscious.</li>\n<li>The slow reduction process concentrates the milk\'s natural sweetness and creates an incredibly creamy texture.</li>\n<li>Infused with saffron strands that impart a golden color and an exotic, floral aroma throughout the pudding.</li>\n<li>Garnished with slivered almonds, pistachios, and cashews for crunch, protein, and visual elegance.</li>\n<li>A comforting dessert that is equally appropriate for everyday family meals and grand festive celebrations.</li>\n<li>Best served chilled in individual bowls — the cool, creamy sweetness is the perfect end to any spicy meal.</li>\n<li>Made with pure ingredients — no condensed milk shortcuts, just real milk, rice, sugar, and love, slow-cooked.</li>\n<li>The ultimate comfort dessert — creamy, sweet, fragrant, and deeply satisfying in a way only kheer can be.</li>\n</ul>', 'কনডেন্সড মিল্ক দিয়ে তৈরি ঘন, সমৃদ্ধ ক্ষীর। তীব্র দুধের স্বাদের বিলাসবহুল ডেজার্ট।', 320.00, NULL, 58, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(76, 'SWT-024', 'Rasgulla', 'রাসগুল্লা / পনির সন্দেশ', 'rasgulla', '<ul>\n<li>Premium rasgulla — extra-soft, extra-spongy cheese balls soaked in lightly sweetened cardamom syrup.</li>\n<li>Made from fresh, premium-quality chhena kneaded to silky smoothness for the softest possible texture.</li>\n<li>The syrup is lighter and less sweet than regular roshogolla syrup — letting the pure milk flavor shine through.</li>\n<li>Each ball is perfectly round, white, and spongy — the hallmark of expert halwai technique and quality ingredients.</li>\n<li>A pan-South Asian sweet enjoyed across India, Bangladesh, and beyond — universally loved for its delicate flavor.</li>\n<li>The spongy texture springs back when gently pressed — a sign of perfectly made rasgulla.</li>\n<li>Serve chilled for the classic experience — the cool, syrup-soaked balls are incredibly refreshing on a hot day.</li>\n<li>A lighter, more delicate alternative to heavier fried sweets — perfect as a palate cleanser after a rich meal.</li>\n<li>The same beloved rasgulla taste you grew up with — now made with premium ingredients for an elevated experience.</li>\n</ul>', 'হালকা চিনির সিরায় নরম রসগুল্লা ডাম্পলিং। বিশ্বজুড়ে প্রিয় খাঁটি বাঙালি মিষ্টি।', 130.00, NULL, 55, 6, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:55:26'),
(77, 'DYR-001', 'Sweet Yogurt (250g)', 'মিষ্টি দই (২৫০ গ্রাম)', 'sweet-yogurt-250g', '<ul>\n<li>Creamy, sweet mishti doi (yogurt) in a convenient 250g cup — the classic Bengali fermented sweet treat.</li>\n<li>Made by caramelizing sugar before adding to milk, creating the signature brown color and rich, toasty flavor.</li>\n<li>Fermented with traditional culture for an authentic tangy-sweet taste that commercial yogurts cannot replicate.</li>\n<li>The smooth, velvety texture sets it apart — each spoonful is silky, creamy, and perfectly balanced in sweetness.</li>\n<li>Set in traditional earthen cups (matir bhand) for an earthy aroma that enhances the authentic doi experience.</li>\n<li>A refreshing dessert perfect for cooling down after a spicy meal or as a sweet afternoon snack.</li>\n<li>Made with full-fat milk for maximum creaminess — no skim milk or powder-based shortcuts in our preparation.</li>\n<li>Best served chilled — the cool, sweet-tangy combination is incredibly refreshing on hot Bangladeshi summer days.</li>\n<li>The quintessential Bengali dessert — mishti doi is as much a cultural icon as it is a delicious sweet treat.</li>\n</ul>', '২৫০ গ্রাম প্যাকে ঐতিহ্যবাহী মিষ্টি দই। অনন্য স্বাদের জন্য ক্যারামেলাইজড চিনি দিয়ে ফারমেন্টেড।', 80.00, 72.00, 25, 7, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(78, 'DYR-002', 'Sweet Yogurt (500g)', 'মিষ্টি দই (৫০০ গ্রাম)', 'sweet-yogurt-500g', '<ul>\n<li>Family-size sweet yogurt (500g) — double the quantity of our popular mishti doi for sharing and celebrations.</li>\n<li>The same authentic caramelized-sugar sweet doi recipe in a generous container for family desserts and gatherings.</li>\n<li>Made from full-cream milk fermented with traditional cultures — thick, creamy, and perfectly sweet-tangy.</li>\n<li>The caramelization of sugar gives the doi its distinctive brown color and a unique, lightly toasted sweetness.</li>\n<li>Perfect for serving 4-6 people — ideal for after-dinner dessert at family meals and small celebrations.</li>\n<li>Set in a proper container that maintains the perfect temperature and texture during the fermentation process.</li>\n<li>A healthier dessert option — probiotic-rich yogurt that satisfies your sweet tooth while supporting gut health.</li>\n<li>The larger size offers better value per gram — perfect for doi lovers who always want more of this Bengali classic.</li>\n<li>Every spoonful of our sweet yogurt connects you to centuries of Bengali culinary tradition and expertise.</li>\n</ul>', 'ভাগ করে খাওয়ার জন্য পারিবারিক সাইজের মিষ্টি দই (৫০০ গ্রাম)। ভারসাম্যপূর্ণ মিষ্টতা সহ ক্রিমি, সমৃদ্ধ টেক্সচার।', 150.00, NULL, 30, 7, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(79, 'DYR-003', 'Plain Yogurt (250g)', 'সাদা দই (২৫০ গ্রাম)', 'plain-yogurt-250g', '<ul>\n<li>Classic plain yogurt (250g) made from fresh, full-cream milk — no sugar, no flavors, just pure creamy yogurt.</li>\n<li>Thick, smooth, and tangy — the perfect base for raita, lassi, marinades, and healthy everyday snacking.</li>\n<li>Made with live active cultures that support digestion and provide natural probiotics for gut health.</li>\n<li>Free from added sugars, artificial thickeners, and preservatives — just milk and yogurt culture, purely made.</li>\n<li>Versatile kitchen staple — use in cooking, baking, smoothies, face masks, or enjoy plain with a drizzle of honey.</li>\n<li>The thick, creamy consistency holds its shape when spooned — a sign of quality yogurt made with real milk.</li>\n<li>A cooling accompaniment to spicy biryani, khichuri, and other rice dishes in traditional Bengali cuisine.</li>\n<li>Perfect for making homemade raita with cucumber and cumin or sweet lassi with sugar and cardamom.</li>\n<li>The foundation of South Asian cooking and healthy eating — pure, plain, and perfect yogurt made fresh daily.</li>\n</ul>', 'খামারের দুধ থেকে তৈরি তাজা সাধারণ দই (২৫০ গ্রাম)। চিনি ছাড়া প্রাকৃতিক প্রোবায়োটিক।', 70.00, NULL, 40, 7, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(80, 'DYR-004', 'Doi (1kg)', 'দই (১ কেজি)', 'doi-1kg', '<ul>\n<li>Generous 1kg doi (yogurt) tub — our premium sweet mishti doi in a family-size for parties and large gatherings.</li>\n<li>Authentic Bengali sweet doi with caramelized sugar flavor, rich creamy texture, and perfect sweet-tangy balance.</li>\n<li>The largest size we offer — perfect for events, celebrations, Iftar spreads, and serious doi enthusiasts.</li>\n<li>Made from full-fat milk and set with traditional cultures for the thickest, creamiest texture possible.</li>\n<li>Excellent value per kilogram — the smart choice for families, restaurants, and caterers who serve doi regularly.</li>\n<li>The earthen-set fermentation process imparts a unique, earthy aroma that enhances every spoonful.</li>\n<li>Probiotic-rich and refreshing — a sweet treat that is also genuinely good for your digestive system.</li>\n<li>Transfer to smaller bowls for serving at dinner parties — the 1kg tub is a impressive centerpiece for dessert spreads.</li>\n<li>A full kilogram of happiness — because in Bengal, there is no such thing as too much mishti doi.</li>\n</ul>', 'ফুল-ক্রিম দুধ দিয়ে তৈরি ঐতিহ্যবাহী দই (১ কেজি)। প্রোবায়োটিক উপকারিতা সহ খাঁটি স্বাদ।', 280.00, 252.00, 52, 7, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06');
INSERT INTO `products` (`id`, `sku`, `name_en`, `name_bn`, `slug`, `description_en`, `description_bn`, `price`, `sale_price`, `stock`, `category_id`, `views`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(81, 'DYR-005', 'Pure Ghee (500g)', 'খাঁটি ঘি (৫০০ গ্রাম)', 'pure-ghee-500g', '<ul>\n<li>Pure desi ghee made from 100% cow milk using traditional slow-churning method for authentic aroma and flavor.</li>\n<li>Rich, golden, and fragrant — the hallmark of genuine ghee made with care and traditional techniques.</li>\n<li>A staple in South Asian cooking — essential for biryani, dal, roti, halwa, and countless traditional recipes.</li>\n<li>Made by simmering butter until all moisture evaporates, leaving pure milk fat with a nutty, caramelized aroma.</li>\n<li>Rich in fat-soluble vitamins A, D, E, and K — a nutritious cooking fat that has been valued in Ayurveda for centuries.</li>\n<li>The high smoke point makes it ideal for deep frying, sautéing, and tempering spices without burning.</li>\n<li>No added colors, preservatives, or hydrogenated fats — just pure, honest ghee the way nature intended.</li>\n<li>Also used in traditional sweets, religious ceremonies, and as a nourishing addition to warm milk before bed.</li>\n<li>500g jar of liquid gold — the pure ghee that transforms ordinary cooking into extraordinary, flavorful dishes.</li>\n</ul>', 'মানসম্মত মাখন থেকে ক্ল্যারিফাইড বিশুদ্ধ ঘি (৫০০ গ্রাম)। খাঁটি খাবারের জন্য সোনালি, সুগন্ধি রান্নার অপরিহার্য।', 650.00, NULL, 52, 7, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(82, 'DYR-006', 'Butter', 'মাখন', 'butter', '<ul>\n<li>Fresh, creamy butter made from premium cow milk — perfect for spreading, cooking, and baking needs.</li>\n<li>Smooth, spreadable texture with a rich, milky flavor that enhances everything from toast to gourmet recipes.</li>\n<li>Made from fresh cream churned slowly to preserve the delicate, sweet flavor of natural dairy butter.</li>\n<li>A kitchen essential for baking cakes, cookies, pastries, and creating rich, flavorful sauces and gravies.</li>\n<li>No artificial colors or salt added — pure, unsalted butter that lets you control the seasoning in your cooking.</li>\n<li>The rich, creamy taste transforms simple bread, roti, paratha, and steamed vegetables into something special.</li>\n<li>Perfect for making ghee at home, clarifying for high-heat cooking, or using as a spread on warm baked goods.</li>\n<li>Packaged in a convenient, resealable wrapper to maintain freshness and prevent absorption of other refrigerator odors.</li>\n<li>The taste of real butter — once you experience it, you will never go back to margarine or artificial spreads.</li>\n</ul>', 'মানসম্মত ক্রিম থেকে তৈরি তাজা মাখন। রান্না এবং স্প্রেড করার জন্য সমৃদ্ধ, ক্রিমি টেক্সচার।', 220.00, 198.00, 91, 7, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(83, 'DYR-007', 'Dairy Creamer', 'দুগ্ধ ক্রিম / ডেইরি ক্রিম', 'dairy-creamer', '<ul>\n<li>Smooth, pourable dairy creamer that adds rich, velvety creaminess to coffee, tea, desserts, and recipes.</li>\n<li>Made from fresh dairy cream — a convenient way to add luxurious texture and mild sweetness to beverages.</li>\n<li>Perfect for enriching chai, coffee, hot chocolate, soups, curries, and homemade dessert recipes.</li>\n<li>The silky texture blends smoothly without separating — even in hot beverages and acidic preparations.</li>\n<li>A versatile ingredient for both sweet and savory cooking — from creamy pasta sauces to rich custard desserts.</li>\n<li>Made with real dairy, not non-dairy substitutes — for authentic cream flavor and natural milk richness.</li>\n<li>Elevates everyday beverages — a splash of creamer transforms ordinary tea or coffee into a café-quality experience.</li>\n<li>Convenient packaging with easy-pour spout for mess-free use in the kitchen and at the dining table.</li>\n<li>The secret ingredient behind rich, creamy restaurant-style dishes — now available for your home cooking.</li>\n</ul>', 'সমৃদ্ধ, ক্রিমি পানীয়ের জন্য ডেয়ারি ক্রিমার। কফি, চা এবং ডেজার্টের জন্য আদর্শ।', 180.00, 162.00, 89, 7, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(84, 'BUN-001', 'Cream Bun', 'ক্রিম বান / মালাই বান', 'cream-bun', '<ul>\n<li>Soft, pillowy cream bun filled with a generous core of smooth, sweet vanilla cream filling.</li>\n<li>The light, fluffy bun exterior gives way to a rich, creamy center — a delightful surprise in every bite.</li>\n<li>Made with enriched dough that stays incredibly soft and fresh throughout the day.</li>\n<li>The vanilla cream filling is made with real dairy cream — not the synthetic cream found in mass-produced buns.</li>\n<li>A beloved bakery treat for children and adults — perfect for breakfast, lunchbox, tea-time, or as a sweet snack.</li>\n<li>Lightly glazed top gives the bun a beautiful shine and a hint of extra sweetness on the crust.</li>\n<li>Convenient single-serving size — grab one on the go for a quick, satisfying, and delicious energy boost.</li>\n<li>Best enjoyed fresh but stays soft in packaging — our cream buns maintain quality for 2-3 days after purchase.</li>\n<li>The classic cream bun experience perfected by our bakers — a nostalgic treat that never goes out of style.</li>\n</ul>', 'ভ্যানিলা ক্রিম ভর্তি নরম ক্রিম বান। মিষ্টি, ক্রিমি সেন্টার সহ হালকা পেস্ট্রি।', 45.00, NULL, 27, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(85, 'BUN-002', 'Cheese Bun', 'পনির বান / সন্দেশ বান', 'cheese-bun', '<ul>\n<li>Savory cheese bun loaded with melted cheddar and mozzarella cheese throughout the soft, golden dough.</li>\n<li>The cheese is kneaded into the dough AND sprinkled on top for double cheese impact in every single bite.</li>\n<li>Golden-baked with a slightly crispy cheese crust on the outside and a warm, cheesy, soft interior.</li>\n<li>A savory alternative to sweet buns — perfect for those who prefer cheese over cream or sugar fillings.</li>\n<li>Excellent as a quick breakfast, lunchbox addition, afternoon snack, or party appetizer for guests.</li>\n<li>Warm in the oven for 3-5 minutes to experience the cheese at its melted, gooey, stretchy best.</li>\n<li>Made with a blend of real cheddar and mozzarella — no processed cheese food product or artificial cheese flavor.</li>\n<li>High in protein and calcium from the real cheese content — a slightly more nutritious bun option for snacking.</li>\n<li>The irresistible aroma of freshly baked cheese bread — once you smell it, resistance is absolutely futile.</li>\n</ul>', 'গলিত পনির টপিং সহ সুস্বাদু চিজ বান। গুগলি পনিরের স্বাদ সহ সোনালি আবরণ।', 55.00, NULL, 73, 8, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(86, 'BUN-003', 'Chocolate Bun', 'চকলেট বান / কোকো বান', 'chocolate-bun', '<ul>\n<li>Indulgent chocolate bun with a rich chocolate filling and chocolate chips baked into the soft dough.</li>\n<li>Soft, fluffy bun exterior with a molten chocolate center that oozes deliciously when warmed slightly.</li>\n<li>Made with premium cocoa and real chocolate — a chocolate lover\'s dream in convenient bun form.</li>\n<li>The chocolate chips scattered throughout the dough provide satisfying little crunches of chocolate in every bite.</li>\n<li>Perfect for breakfast, school lunchboxes, tea-time treats, and as a quick chocolate fix any time of day.</li>\n<li>The chocolate filling stays creamy and rich — not waxy or overly sweet like commercial chocolate bun brands.</li>\n<li>A favorite among children — the chocolate bun is often the first item to disappear from our bakery display.</li>\n<li>Warm for 10 seconds in the microwave for an absolutely divine melted chocolate center experience.</li>\n<li>When chocolate meets bread in perfect harmony — a match made in bakery heaven for every chocolate enthusiast.</li>\n</ul>', 'চকলেট চিপস সহ মিষ্টি চকলেট বান। চকলেটপ্রেমীদের জন্য পারফেক্ট ট্রিট।', 50.00, NULL, 21, 8, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(87, 'BUN-004', 'Cinnamon Bun', 'দারচিনি বান / ডালচিনি বান', 'cinnamon-bun', '<ul>\n<li>Aromatic cinnamon bun swirled with brown sugar and cinnamon, topped with creamy vanilla glaze drizzle.</li>\n<li>The iconic spiral shape reveals beautiful layers of cinnamon-sugar filling throughout the soft, pillowy dough.</li>\n<li>Warm spices of cinnamon combined with brown sugar create a comforting, aromatic flavor profile.</li>\n<li>Topped with a generous drizzle of sweet vanilla glaze that hardens slightly for a delicious, sweet crust.</li>\n<li>A Scandinavian bakery classic that has captured hearts worldwide — now perfected by our expert bakers.</li>\n<li>The dough is extra soft and slightly enriched with butter for a tender, pull-apart texture that is deeply satisfying.</li>\n<li>Best served warm — heat for 15 seconds and the cinnamon aroma alone will make your entire kitchen smell amazing.</li>\n<li>Perfect for weekend breakfasts, brunch gatherings, coffee dates, and as a cozy afternoon comfort snack.</li>\n<li>The ultimate comfort bun — warm cinnamon, sweet glaze, and soft bread create a hug in baked form.</li>\n</ul>', 'দারুচিনি-চিনির সোয়ার্ল সহ সুগন্ধযুক্ত সিনামন বান। অতিরিক্ত আনন্দের জন্য মিষ্টি গ্লেজ টপিং।', 48.00, NULL, 98, 8, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(88, 'BUN-005', 'Garlic Bun', 'রসুন বান / আলু বান', 'garlic-bun', '<ul>\n<li>Savory garlic bun infused with roasted garlic butter and sprinkled with herbs and parmesan on top.</li>\n<li>Soft, pull-apart bun loaded with real roasted garlic and herb butter throughout the golden dough.</li>\n<li>The aromatic blend of garlic, parsley, oregano, and parmesan creates an irresistible savory flavor.</li>\n<li>Golden-baked with a slightly crispy, garlicky crust on the outside and a warm, buttery soft interior.</li>\n<li>Perfect as a dinner side, soup accompaniment, party appetizer, or as a savory alternative to sweet snacks.</li>\n<li>Warm in the oven for 5 minutes to intensify the garlic aroma and achieve the perfect buttery softness.</li>\n<li>Made with real roasted garlic cloves — never garlic powder or artificial garlic flavoring agents.</li>\n<li>A guaranteed crowd-pleaser at dinner parties, Iftar gatherings, and family meal times.</li>\n<li>The smell alone will have everyone in the house heading to the kitchen — freshly baked garlic buns are impossible to resist.</li>\n</ul>', 'রোস্টেড রসুন মাখন ইনফিউজড গার্লিক বান। ইতালীয় খাবারের সুস্বাদু সাইড।', 50.00, 45.00, 80, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(89, 'BUN-006', 'Cheese Roll', 'পনির রোল', 'cheese-roll', '<ul>\n<li>Flaky cheese roll — crispy puff pastry wrapped around a generous filling of melted cheddar and mozzarella.</li>\n<li>Golden, flaky layers of puff pastry encase a warm, gooey cheese center for a perfect savory treat.</li>\n<li>The contrast of crispy pastry shell and melted, stretchy cheese filling is simply irresistible.</li>\n<li>Made with real butter puff pastry dough that creates hundreds of delicate, flaky layers when baked.</li>\n<li>A popular bakery snack across South Asia — perfect for Iftar, tea-time, and children\'s lunchboxes.</li>\n<li>Warm in the oven or microwave for the ultimate melted cheese and crispy pastry experience.</li>\n<li>Made with a blend of cheddar for sharpness and mozzarella for that perfect cheese stretch in every bite.</li>\n<li>A satisfying, protein-rich snack that is more filling than regular buns — great for curbing hunger between meals.</li>\n<li>The satisfying crunch of the first bite, followed by warm, melted cheese — a simple pleasure that never disappoints.</li>\n</ul>', 'সম্পূর্ণ জুড়ে পনির পুর সহ স্তরযুক্ত চিজ রোল। গলিত পনির সহ মচমচে স্তর।', 60.00, NULL, 62, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(90, 'BUN-007', 'Egg Bun', 'ডিম বান', 'egg-bun', '<ul>\n<li>Classic egg bun — soft, slightly sweet enriched bread bun made with fresh eggs for a golden color and rich flavor.</li>\n<li>The egg enrichment gives the bun a tender, slightly chewy texture that is more satisfying than plain buns.</li>\n<li>A beautiful golden-brown top with a slightly glossy sheen from the egg wash applied before baking.</li>\n<li>A versatile everyday bun — great for breakfast with butter, as a snack, or as a base for mini burgers and sliders.</li>\n<li>The subtle sweetness from the enriched dough makes it enjoyable plain — no filling or spread needed.</li>\n<li>A protein-packed bun option thanks to the fresh egg content — more nutritious than basic white bread buns.</li>\n<li>Popular for making egg sandwiches, breakfast sliders, or simply halved and toasted with jam.</li>\n<li>Made fresh daily with free-range eggs for the best color, flavor, and nutritional profile in every bun.</li>\n<li>The humble egg bun — simple, wholesome, and satisfying in a way that fancy pastries can never quite match.</li>\n</ul>', 'ভেতরে সম্পূর্ণ ডিম সহ নরম এগ বান। প্রোটিন সমৃদ্ধ সকালের নাস্তার বিকল্প।', 42.00, 37.80, 60, 8, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(91, 'BUN-008', 'Hot Dog Bun', 'হট ডগ বান / লং বান', 'hot-dog-bun', '<ul>\n<li>Soft, perfectly shaped hot dog buns designed to cradle sausages, frankfurters, and fillings without splitting.</li>\n<li>Slightly sweet, pillowy-soft dough with a gentle golden bake — the classic American-style hot dog bun.</li>\n<li>The split-top design allows easy loading of sausages, toppings, sauces, and condiments without mess.</li>\n<li>Made with enriched dough that stays soft and flexible — no cracking or crumbling when you bite in.</li>\n<li>Perfect for hot dogs, sausages, sub sandwiches, lobster rolls, and any long filling combination.</li>\n<li>Available in packs of 4 and 6 — convenient sizes for family BBQs, game-day parties, and casual dinners.</li>\n<li>Lightly toast on the inside for extra structural integrity and a pleasant crunch against the soft fillings.</li>\n<li>Made fresh daily without artificial dough conditioners — our hot dog buns are naturally soft through proper technique.</li>\n<li>The foundation of a great hot dog — because the bun matters just as much as the sausage it holds.</li>\n</ul>', 'ফ্র্যাঙ্কফার্টারের জন্য ক্লাসিক হট ডগ বান। টপিংস ভালো ধরে রাখে এমন নরম, মজবুত বান।', 40.00, NULL, 26, 8, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(92, 'BUN-009', 'Pastry Bun', 'পেস্ট্রি বান', 'pastry-bun', '<ul>\n<li>Flaky pastry bun combining the best of puff pastry and soft bread — crispy layers with a tender, airy interior.</li>\n<li>The unique laminated dough technique creates beautiful, distinct flaky layers visible when you pull the bun apart.</li>\n<li>Golden-baked exterior with visible pastry layers and a soft, bread-like center — a textural masterpiece.</li>\n<li>A versatile bun that works for both sweet applications (cream, jam) and savory fillings (cheese, chicken).</li>\n<li>The flaky crust provides a satisfying crunch while the inner layers stay wonderfully soft and chewy.</li>\n<li>Perfect for breakfast with butter and honey, or as a base for creative sandwich fillings and sliders.</li>\n<li>A specialty bakery item that showcases the skill and precision of our trained pastry chefs.</li>\n<li>Best enjoyed fresh and slightly warm — the contrast of crispy flakes and soft interior is at its peak.</li>\n<li>The marriage of French pastry technique and everyday bun convenience — sophistication meets practicality.</li>\n</ul>', 'ক্রিম ফিলিং সহ মিষ্টি পেস্ট্রি বান। ডেজার্ট বা চায়ের সময়ের জন্য সূক্ষ্ম পেস্ট্রি।', 55.00, NULL, 67, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(93, 'BUN-010', 'Fruit Bun', 'ফ্রুট বান', 'fruit-bun', '<ul>\n<li>Sweet, fruity bun studded with colorful candied fruits and raisins — a festive bakery treat year-round.</li>\n<li>The soft, enriched dough is dotted with vibrant fruit pieces that add sweetness, color, and chewy texture.</li>\n<li>A lighter, everyday alternative to traditional fruit cake — the same fruity flavor in a convenient bun form.</li>\n<li>The candied fruits include cherries, citrus peel, and raisins — each adding their own unique flavor and color.</li>\n<li>Perfect for breakfast, tea-time snack, children\'s lunchboxes, and as a cheerful addition to party food spreads.</li>\n<li>The mild sweetness of the dough complements the fruity bursts without being cloying or overwhelming.</li>\n<li>A nostalgic bakery classic that reminds many of childhood trips to the local bakery with family.</li>\n<li>Made with real candied fruits — not just raisins — for a true, colorful fruit bun experience.</li>\n<li>Bright, cheerful, and delicious — a fruit bun a day keeps the gloom away, one sweet, fruity bite at a time.</li>\n</ul>', 'শুকনো ফলে ভরা ফ্রুট বান। প্রাকৃতিক ফলের স্বাদ সহ মিষ্টি, পুষ্টিকর স্ন্যাকস।', 48.00, 43.20, 85, 8, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(94, 'PST-001', 'Puff', 'পাফ / মুরগি পাফ', 'puff', '<ul>\n<li>Classic puff pastry — hundreds of delicate, flaky layers of buttery dough baked to golden, crispy perfection.</li>\n<li>Made using traditional French lamination technique — butter is folded into the dough multiple times for maximum layers.</li>\n<li>The exterior shatters into crispy, buttery flakes while the inside stays wonderfully light and airy.</li>\n<li>A versatile pastry that can be enjoyed plain, filled with cream, or used as a base for savory and sweet creations.</li>\n<li>Perfect as a light snack with tea, as a base for tarts, or as a quick breakfast pastry on busy mornings.</li>\n<li>Made with real butter — not margarine or shortening — for authentic, rich flavor that real puff pastry demands.</li>\n<li>Each bite releases a cloud of buttery, flaky pastry layers — the hallmark of properly made puff pastry.</li>\n<li>Warm in the oven for 3-5 minutes to refresh the crispiness and release the wonderful butter aroma.</li>\n<li>The art of pastry simplified — crispy, buttery, flaky perfection that elevates any occasion or moment.</li>\n</ul>', 'স্তরযুক্ত, মাখনযুক্ত স্তর সহ ক্লাসিক পাফ পেস্ট্রি। মুখে গলে যাওয়া হালকা এবং মচমচে টেক্সচার।', 50.00, NULL, 22, 9, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(95, 'PST-002', 'Meat Puff', 'মাংসের পাফ / পোল্ট্রি পাফ', 'meat-puff', '<ul>\n<li>Savory meat puff — flaky, golden puff pastry filled with spiced minced meat and aromatic herbs.</li>\n<li>Crispy, shatteringly flaky pastry shell encases a hot, savory, perfectly spiced meat filling.</li>\n<li>The filling is made with quality minced beef or chicken, cooked with onions, garlic, ginger, and traditional spices.</li>\n<li>A hearty, protein-packed snack that satisfies hunger quickly — perfect for Iftar, tea-time, and on-the-go meals.</li>\n<li>The spice blend is carefully balanced — flavorful and aromatic without being excessively spicy or hot.</li>\n<li>Golden-baked to perfection with visible pastry layers that create a satisfying crunch with every bite.</li>\n<li>A beloved snack across South Asia and the Middle East — the meat puff is a universal comfort food.</li>\n<li>Warm in the oven or microwave for the best experience — hot filling and crispy pastry is the winning combination.</li>\n<li>The satisfying contrast of crispy, buttery pastry and hot, savory meat filling — pure comfort in every bite.</li>\n</ul>', 'মশলাদার মাংস পুর সহ সুস্বাদু মিট পাফ। স্বাদযুক্ত কিমা মাংস সহ মচমচে বাইরে।', 60.00, NULL, 92, 9, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(96, 'PST-003', 'Vegetable Puff', 'সবজি পাফ / আলুর পাফ', 'vegetable-puff', '<ul>\n<li>Delicious vegetable puff — flaky puff pastry stuffed with a spiced mixture of potatoes, peas, carrots, and herbs.</li>\n<li>A vegetarian-friendly savory pastry that delivers the same flaky, crispy satisfaction as our meat puff.</li>\n<li>The vegetable filling is cooked with cumin, coriander, turmeric, and a hint of green chili for authentic South Asian flavor.</li>\n<li>Each puff is generously filled — the vegetable-to-pastry ratio ensures maximum filling satisfaction in every bite.</li>\n<li>Perfect for vegetarians, as a lighter snack option, and for anyone who loves the classic aloo filling in pastry form.</li>\n<li>The golden, flaky pastry provides a satisfying crunch that gives way to the soft, warmly spiced vegetable interior.</li>\n<li>A popular tea-time and Iftar snack across Bangladesh — vegetable puffs disappear fast from any snack spread.</li>\n<li>Made with the same premium butter puff pastry dough as our sweet pastries — no compromise on pastry quality.</li>\n<li>Vegetables wrapped in crispy, buttery pastry perfection — proof that vegetarian snacks can be absolutely irresistible.</li>\n</ul>', 'মিশ্র সবজি পুর সহ ভেজিটেবল পাফ। মচমচে পাফ পেস্ট্রি সহ স্বাস্থ্যকর স্ন্যাকস।', 45.00, NULL, 90, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(97, 'PST-004', 'Cream Roll', 'ক্রিম রোল / মালাই রোল', 'cream-roll', '<ul>\n<li>Classic cream roll — crispy, cylindrical pastry filled with smooth, sweet vanilla cream from end to end.</li>\n<li>The pastry tube is baked to golden, flaky perfection and then piped full of velvety vanilla cream filling.</li>\n<li>The contrast of crispy, shatteringly flaky pastry and soft, sweet cream is a textural and flavor delight.</li>\n<li>A beloved bakery classic across generations — the cream roll has been a tea-time favorite for decades.</li>\n<li>Made with real dairy cream — not the synthetic, waxy filling found in mass-produced cream rolls.</li>\n<li>Each bite provides the satisfying crunch of pastry followed immediately by the smooth, sweet cream center.</li>\n<li>Perfect for children\'s parties, school snack boxes, and as a sweet treat with afternoon tea or coffee.</li>\n<li>The cylindrical shape makes it fun to eat — bite from one end and work your way through layers of cream and pastry.</li>\n<li>A simple, honest bakery treat that never goes out of style — crispy pastry and sweet cream is a timeless combination.</li>\n</ul>', 'ভ্যানিলা ক্রিম ফিলিং সহ ক্রিম রোল। মসৃণ ক্রিম সেন্টার সহ মচমচে পেস্ট্রি টিউব।', 40.00, 36.00, 78, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(98, 'PST-005', 'Fruit Pastry', 'ফ্রুট পেস্ট্রি', 'fruit-pastry', '<ul>\n<li>Beautiful fruit pastry — crisp, flaky pastry base topped with fresh seasonal fruits and a glossy fruit glaze.</li>\n<li>Individual fruit tart filled with creamy custard and decorated with sliced strawberries, kiwi, mango, or mixed fruits.</li>\n<li>The buttery pastry shell provides a crisp, crumbly base that complements the soft custard and fresh fruit topping.</li>\n<li>Each pastry is an edible work of art — colorful fruit arrangements on a bed of smooth vanilla custard.</li>\n<li>Made with fresh, seasonal fruits — the selection changes based on what is perfectly ripe and at peak flavor.</li>\n<li>The fruit glaze adds shine and a touch of sweetness that ties all the flavors together beautifully.</li>\n<li>A light, refreshing dessert option that is perfect for brunch, afternoon tea, and elegant dinner parties.</li>\n<li>Best served chilled — the cool custard, crisp pastry, and fresh fruit create a refreshing dessert experience.</li>\n<li>A bakery showstopper that looks impressive and tastes even better — fruit never had it so good.</li>\n</ul>', 'মৌসুমি ফল দিয়ে টপ করা তাজা ফ্রুট পেস্ট্রি। তাজা ফল টপিং সহ হালকা পেস্ট্রি ক্রিম বেস।', 65.00, NULL, 33, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(99, 'PST-006', 'Croissant', 'ক্রোইসান / ফ্রেঞ্চ রোল', 'croissant', '<ul>\n<li>Classic French croissant made with premium butter and traditional lamination for hundreds of flaky, airy layers.</li>\n<li>The crescent shape is iconic — golden, flaky outside with visible layers and a soft, airy, buttery interior.</li>\n<li>Made using authentic French technique — butter is folded into the dough 27 times to create perfect lamination.</li>\n<li>The aroma of freshly baked butter croissant is one of the most beloved bakery scents in the world.</li>\n<li>Perfect for breakfast with butter and jam, dipped in coffee, or used as a base for sandwiches and savory fillings.</li>\n<li>The exterior shatters into delicate, crispy flakes while the interior stays tender and slightly chewy.</li>\n<li>Made with imported European-style butter for the authentic rich, nutty flavor that defines a proper croissant.</li>\n<li>Warm for 3 minutes in the oven to restore the just-baked crispiness and release the incredible butter aroma.</li>\n<li>The gold standard of viennoiserie — our croissants bring a little piece of Paris to your breakfast table.</li>\n</ul>', 'ক্লাসিক অর্ধচন্দ্রাকৃতির মাখনযুক্ত ক্রোয়াঁসাঁ। সকালের নাস্তার জন্য মচমচে, সোনালি স্তর।', 70.00, 63.00, 62, 9, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(100, 'PST-007', 'Danish Pastry', 'ড্যানিশ পেস্ট্রি / লেয়ার্ড পেস্ট্রি', 'danish-pastry', '<ul>\n<li>Scandinavian-inspired Danish pastry — flaky, buttery dough topped with fruit filling and a sweet cream cheese layer.</li>\n<li>The laminated dough creates beautiful, puffy layers that rise dramatically during baking for a light, airy texture.</li>\n<li>Each pastry is topped with fruit preserves, sweet cream cheese, and a delicate glaze drizzle on top.</li>\n<li>A bakery specialty that requires skill and patience — our pastry chefs have mastered the art of Danish pastry making.</li>\n<li>Available in assorted flavors — apple, cherry, cheese, blueberry, and chocolate varieties to choose from.</li>\n<li>The combination of flaky pastry, creamy cheese, and fruit creates a perfect balance of textures and flavors.</li>\n<li>Perfect for weekend brunches, coffee breaks, dessert plates, and as an indulgent breakfast pastry treat.</li>\n<li>Each Danish is hand-shaped and topped — no two are exactly alike, adding artisan charm to every piece.</li>\n<li>A breakfast pastry worth waking up early for — flaky, fruity, creamy, and utterly delicious from first bite to last.</li>\n</ul>', 'ফল বা ক্রিম ফিলিং সহ ড্যানিশ পেস্ট্রি। মাখনযুক্ত পেস্ট্রি ডো এর একাধিক স্তর।', 75.00, 67.50, 19, 9, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(101, 'PST-008', 'Sausage Roll', 'সসেজ রোল', 'sausage-roll', '<ul>\n<li>Savory sausage roll — seasoned pork or chicken sausage wrapped in golden, flaky butter puff pastry.</li>\n<li>The sausage filling is perfectly seasoned with herbs and spices, then enclosed in crispy, layered puff pastry.</li>\n<li>Golden-baked until the pastry is shatteringly crisp and the sausage inside is hot and juicy.</li>\n<li>A classic British bakery snack that has become popular worldwide — perfect party food for any occasion.</li>\n<li>The butter pastry provides a satisfying crunch while the savory sausage delivers hearty, meaty satisfaction.</li>\n<li>Great for Iftar, tea-time, children\'s snacks, parties, picnics, and as a protein-rich grab-and-go meal.</li>\n<li>Made with quality sausage meat — no fillers, extenders, or mystery meat in our sausage rolls.</li>\n<li>Best served warm with tomato ketchup or mustard — the classic condiment pairing for sausage rolls.</li>\n<li>The perfect combination of flaky pastry and savory sausage — simple, satisfying, and universally loved.</li>\n</ul>', 'মশলাদার সসেজ সহ সুস্বাদু সসেজ রোল। রসালো সসেজের চারপাশে মোড়ানো পাফ পেস্ট্রি।', 80.00, NULL, 96, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(102, 'PST-009', 'Chicken Roll', 'চিকেন রোল', 'chicken-roll', '<ul>\n<li>Savory chicken roll — flaky pastry wrapped around a generous filling of spiced, minced chicken and herbs.</li>\n<li>The chicken filling is cooked with aromatic spices including cumin, coriander, black pepper, and fresh herbs.</li>\n<li>Crispy, golden puff pastry exterior gives way to a hot, flavorful chicken filling that satisfies like a full meal.</li>\n<li>A protein-packed snack perfect for lunch, tea-time, Iftar, and as a hearty on-the-go meal option.</li>\n<li>The spice level is moderate — flavorful and aromatic without being overly spicy, suitable for all palates.</li>\n<li>Made with quality chicken mince — no bones, no gristle, just clean, well-seasoned chicken in every bite.</li>\n<li>Warm in the oven for 5 minutes to restore pastry crispiness and heat the filling to perfection.</li>\n<li>A popular bakery item in Bangladesh — the chicken roll combines South Asian flavors with Western pastry technique.</li>\n<li>When crispy pastry meets spiced chicken filling — a savory snack that hits every satisfying note perfectly.</li>\n</ul>', 'মশলাদার চিকেন পুর সহ চিকেন রোল। সুস্বাদু চিকেন সেন্টার সহ মচমচে পেস্ট্রি।', 70.00, NULL, 38, 9, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(103, 'PST-010', 'Pizza Pastry', 'পিৎজা পেস্ট্রি', 'pizza-pastry', '<ul>\n<li>Savory pizza pastry — flaky puff pastry topped with pizza sauce, mozzarella cheese, and pepperoni or vegetables.</li>\n<li>The fusion of Italian pizza flavors and French puff pastry technique creates a unique, irresistible snack.</li>\n<li>Golden-baked pastry base topped with tangy tomato sauce, melted mozzarella, and your choice of toppings.</li>\n<li>The flaky pastry base provides a lighter, crispier alternative to traditional thick pizza dough.</li>\n<li>Perfect as a party appetizer, children\'s snack, lunchbox treat, or quick savory bite with afternoon tea.</li>\n<li>The cheese melts and bubbles on top of the crispy pastry, creating the perfect cheese pull with every bite.</li>\n<li>Available in pepperoni, vegetable, and cheese-only varieties to satisfy different taste preferences.</li>\n<li>Warm in the oven for 3-5 minutes for the ultimate melted cheese and crispy pastry experience.</li>\n<li>Pizza meets pastry in this creative fusion — all the pizza flavor you love in a flaky, crispy pastry package.</li>\n</ul>', 'পিজ্জা টপিংস এবং পনির সহ পিজ্জা পেস্ট্রি। মিনি পিজ্জা-ফ্লেভার্ড পেস্ট্রি স্ন্যাকস।', 85.00, 76.50, 29, 9, 0, 0, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06'),
(104, 'PST-011', 'Samosa', 'সিংডা / শিঙারা', 'samosa', '<ul>\n<li>Classic samosa — crispy, triangular pastry shell filled with spiced potatoes, peas, and aromatic herbs.</li>\n<li>The thin, flaky crust is fried to a perfect golden crisp that shatters satisfyingly with every bite.</li>\n<li>Filled with a classic mixture of potatoes, green peas, cumin, coriander, and a hint of green chili.</li>\n<li>A universally beloved South Asian snack — samosas are the life of every Iftar, party, and tea-time gathering.</li>\n<li>The filling is perfectly spiced — flavorful, aromatic, and savory without being excessively hot or spicy.</li>\n<li>Best enjoyed fresh and hot with green chutney, tamarind sauce, or ketchup for the complete samosa experience.</li>\n<li>Hand-crafted and folded by our experienced cooks who have mastered the art of the perfect samosa fold.</li>\n<li>A legendary snack that transcends borders — loved across India, Bangladesh, Pakistan, and the entire South Asian diaspora.</li>\n<li>No celebration in Bangladesh is complete without samosas — the undisputed king of Iftar and party snacks.</li>\n</ul>', 'মশলাদার আলু বা মাংস পুর সহ মচমচে সমুচা। সোনালি আবরণ সহ জনপ্রিয় দক্ষিণ এশীয় স্ন্যাকস।', 25.00, 22.50, 30, 9, 0, 1, 1, '2026-03-12 09:30:01', '2026-04-09 06:59:06');

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
(3, 2, 5, 5, 'Great garlic bread with perfect flavor balance. The garlic is aromatic but not overwhelming. Best when warmed up in the oven. Would buy again!', 1, '2026-03-16 06:41:07', '2026-03-16 06:43:14'),
(4, 17, 7, 5, 'The Black Forest Cake was absolutely divine! Rich chocolate layers with fresh cream and cherries. Every bite was heavenly. Ordered it for my anniversary and my wife loved it!', 1, '2026-04-09 05:01:26', '2026-04-09 05:01:26'),
(5, 16, 57, 5, 'Best Sandesh I have ever tasted! The pistachio topping adds such a wonderful crunch and flavor. Very authentic taste reminds me of my childhood in Dhaka.', 1, '2026-04-09 05:01:26', '2026-04-09 05:01:26'),
(6, 2, 60, 5, 'The Gulab Jamun with rose flavor is out of this world! Soft, juicy and perfectly sweetened. The rose aroma makes it extra special. Will definitely order again!', 1, '2026-04-09 05:01:26', '2026-04-09 05:01:26'),
(7, 17, 25, 5, 'Ordered the Eid Special Cake for our family gathering and it was the highlight of the celebration! Beautiful design, moist texture, and the flavor was incredible.', 1, '2026-04-09 05:01:26', '2026-04-09 05:01:26'),
(8, 16, 9, 4, 'Multigrain Bread is my daily breakfast choice now. Fresh, healthy and perfectly baked. Great for people looking for nutritious options. Delivery is always on time.', 1, '2026-04-09 05:01:26', '2026-04-09 05:01:26'),
(9, 2, 67, 5, 'The Jalebi is crispy, sweet and absolutely delicious! Served warm, it melts in your mouth. Perfect for festivals and special occasions. My whole family loves it!', 1, '2026-04-09 05:01:26', '2026-04-09 05:01:26'),
(10, 17, 40, 4, 'Butter Cookies are so addictive! Perfect balance of buttery richness and sweetness. Crispy on the outside and soft inside. Great with evening tea.', 1, '2026-04-09 05:01:26', '2026-04-09 05:01:26'),
(11, 16, 19, 5, 'The Marble Cake looks beautiful and tastes even better! Perfect swirl of chocolate and vanilla. My kids absolutely love it. Fresh and moist every single time.', 1, '2026-04-09 05:01:26', '2026-04-09 05:01:26'),
(12, 2, 66, 5, 'Best Shingara in town! Crispy flaky pastry with a flavorful filling. Perfectly spiced and always fresh. Reminds me of the street food back in old Dhaka.', 1, '2026-04-09 05:01:26', '2026-04-09 05:01:26'),
(13, 17, 44, 4, 'Cashew Cookies are premium quality! You can taste the real cashew in every bite. Elegant packaging makes it perfect for gifting. Will order more for upcoming holidays.', 1, '2026-04-09 05:01:26', '2026-04-09 05:01:26');

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
  `theme_preset` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `primary_color`, `primary_color_light`, `primary_color_dark`, `secondary_color`, `secondary_color_dark`, `accent_color`, `bg_gradient_1`, `bg_gradient_2`, `bg_gradient_3`, `bg_gradient_4`, `bg_gradient_5`, `btn_gradient_start`, `btn_gradient_end`, `menu_hover_start`, `menu_hover_end`, `text_primary`, `text_secondary`, `glass_bg`, `glass_border`, `is_active`, `theme_preset`, `created_at`, `updated_at`) VALUES
(1, '#f59e0b', '#fbbf24', '#d97706', '#f43eee', '#de1de2', '#8b5cf6', '#250967', '#400229', '#1a0b3c', '#01371d', '#341209', '#f59e0b', '#f43f5e', '#f59e0b', '#f43f5e', '#fbeaea', '#fbbf24', 'rgba(255,255,255,0.08)', 'rgba(255,255,255,0.15)', 1, 'default', '2026-04-02 06:01:15', '2026-04-07 08:18:44');

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
(2, 'Ashraful', 'ashrafulunisoft@gmail.com', '01859385787', NULL, '1997-10-28', 'male', NULL, 0, '$2y$12$qlSgxxvE3F2vQpSkWOco1efn8P74AwwvXKT9Zyn3dAxyHPceMhG6G', NULL, NULL, NULL, '3XaIHMibiXpNBj3zwXxlSjE3fnWawvWha16ot9tn98Hq1NugM84vvAy0qLZ6', NULL, NULL, '2026-03-12 04:40:47', '2026-03-30 11:36:54'),
(16, 'Md.Ashraful', 'ashrafulinstasure@gmail.com', '01947713697', NULL, NULL, NULL, NULL, 0, '$2y$12$B9AfUlnwbPtvhDDlpg5RvuTZUZaAbyFlOpOovpiRHpxp2oAbbSs0S', NULL, NULL, NULL, 'YlnadnqBfhKK12xHXdLfePbGbOi7LMXKdqTapcud5ttXxNVjhYnPLtubNU2q', NULL, NULL, '2026-03-29 10:31:05', '2026-03-29 10:31:05'),
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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
