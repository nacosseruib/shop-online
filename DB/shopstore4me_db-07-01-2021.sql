-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 07, 2021 at 08:33 PM
-- Server version: 8.0.21
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopstore4me_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkout_pool`
--

DROP TABLE IF EXISTS `checkout_pool`;
CREATE TABLE IF NOT EXISTS `checkout_pool` (
  `poolID` bigint NOT NULL AUTO_INCREMENT,
  `userID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiverID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_store_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `order_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_order_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage_rate_from` double DEFAULT NULL,
  `percentage_rate_to` double DEFAULT NULL,
  `total_cart_amount` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_total_amount` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_item_delivered_to_user` int NOT NULL DEFAULT '0',
  `item_quantity` int DEFAULT '0',
  `cart_item_list` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`poolID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkout_pool`
--

INSERT INTO `checkout_pool` (`poolID`, `userID`, `receiverID`, `user_store_details`, `order_number`, `receiver_order_number`, `percentage_rate_from`, `percentage_rate_to`, `total_cart_amount`, `receiver_total_amount`, `is_item_delivered_to_user`, `item_quantity`, `cart_item_list`, `created_at`, `updated_at`, `is_active`) VALUES
(8, '97821a68-c180-4010-88fb-0748fdd74143', '381e9201-5822-4783-919f-13f83bd6e10b', 'HMNKH57DS4RE', 'XZ4J0T2FQSUBGY3', 'D0NEDL9VRXH', NULL, NULL, NULL, NULL, 0, 1, NULL, '2020-12-30 02:00:41 pm', '2020-12-30 02:00:41 pm', 1),
(14, '381e9201-5822-4783-919f-13f83bd6e10b', '97821a68-c180-4010-88fb-0748fdd74143', '[{\"userID\":\"97821a68-c180-4010-88fb-0748fdd74143\",\"phone_number\":\"07034320256\",\"store_phone_number\":\"08037483724\",\"storeID\":\"HMNKH57DS4RE\",\"currencyID\":1,\"user_token\":\"R64AYVTA0FNBFD3NEO4GSRP77BWGJ6DY8FBQ\",\"store_country\":null,\"store_state\":null,\"store_city\":null,\"store_name\":\"Toss Ajax Tech\",\"store_address1\":\"Area 11, Abuja\",\"store_address2\":null,\"store_logo\":null,\"store_description\":\"I sell supermart stuff\"}]', 'D0NEDL9VRXH', 'XZ4J0T2FQSUBGY3', 10, 29.9, '8150', '6890', 0, 2, '{\"itemInCart\":[{\"userID\":\"97821a68-c180-4010-88fb-0748fdd74143\",\"created_at\":\"2020-12-30 01:59:05 pm\",\"productID\":\"4d48941f-2f3a-4a89-a4be-e67d7c81422d\",\"product_code\":\"6OKK4XTMLN2\",\"transactionID\":\"0OIT7YB142HI\",\"cartID\":42,\"quantity\":1,\"brand\":\"tossAjax\",\"is_available\":\"Available\",\"original_price\":\"2500\",\"user_token\":\"R64AYVTA0FNBFD3NEO4GSRP77BWGJ6DY8FBQ\",\"old_price\":\"10500\",\"product_name\":\"Color Screen Smart Bracelet D13 Waterproof Bracelet wewewew\"},{\"userID\":\"97821a68-c180-4010-88fb-0748fdd74143\",\"created_at\":\"2020-12-30 01:58:57 pm\",\"productID\":\"73d23754-7656-44f7-8c3e-b8d5204e6cfb\",\"product_code\":\"U570I2ZVVYI\",\"transactionID\":\"1AO1X3E43ZP4\",\"cartID\":41,\"quantity\":1,\"brand\":null,\"is_available\":\"Available\",\"original_price\":\"4390\",\"user_token\":\"381e9201-5822-4783-919f-13f83bd6e10b\",\"old_price\":\"6500\",\"product_name\":\"Wireless Bluetooth Portable Alarm Clock FM Radio Green\"}],\"totalCartAmount\":6890,\"productPath\":[\"http:\\/\\/localhost\\/shopstore4me.com\\/public\\/R64AYVTA0FNBFD3NEO4GSRP77BWGJ6DY8FBQ\\/product\\/\",\"http:\\/\\/localhost\\/shopstore4me.com\\/public\\/381e9201-5822-4783-919f-13f83bd6e10b\\/product\\/\"],\"productImages\":[\"365651608565326.jpg\",\"712911607980430.jpg\"],\"productPath300x300\":\"300x300\\/\",\"productPath500x500\":\"500x500\\/\",\"itemQuantity\":2}', '2020-12-30 09:35:32 pm', '2020-12-30 09:35:32 pm', 0);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `currencyID` int NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`currencyID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`currencyID`, `currency_name`, `currency_symbol`, `status`) VALUES
(1, 'US Dollar', 'USD', 1),
(2, 'Euro', 'EUR', 1),
(3, 'Naira', 'NGN', 1),
(4, 'Canadian Dollar', 'CAD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `current_login`
--

DROP TABLE IF EXISTS `current_login`;
CREATE TABLE IF NOT EXISTS `current_login` (
  `user_typeID` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT '1',
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`user_typeID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivered_product`
--

DROP TABLE IF EXISTS `delivered_product`;
CREATE TABLE IF NOT EXISTS `delivered_product` (
  `deliveredID` bigint NOT NULL,
  `delivery_userID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_userID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transactionID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buy_from_store` int NOT NULL DEFAULT '0',
  `user_experience` text,
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`deliveredID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hear_about_us`
--

DROP TABLE IF EXISTS `hear_about_us`;
CREATE TABLE IF NOT EXISTS `hear_about_us` (
  `hear_aboutID` int NOT NULL AUTO_INCREMENT,
  `how_hear_us` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`hear_aboutID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hear_about_us`
--

INSERT INTO `hear_about_us` (`hear_aboutID`, `how_hear_us`, `status`) VALUES
(1, 'Radio', 1),
(2, 'Television', 1),
(3, 'Newspaper', 1),
(4, 'Google Search', 1),
(5, 'Social Media', 1),
(6, 'Through Friend/Family', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message_inbox`
--

DROP TABLE IF EXISTS `message_inbox`;
CREATE TABLE IF NOT EXISTS `message_inbox` (
  `inboxID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `senderID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiverID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `flag` int NOT NULL DEFAULT '0',
  `is_active` int NOT NULL DEFAULT '1',
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`inboxID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `message_inbox`
--

INSERT INTO `message_inbox` (`inboxID`, `senderID`, `receiverID`, `message`, `file_name`, `flag`, `is_active`, `updated_at`, `created_at`) VALUES
('3a8c9874-4082-4553-b4af-fe93e5300ac9', '381e9201-5822-4783-919f-13f83bd6e10b', '381e9201-5822-4783-919f-13f83bd6e10b', 'Got your message. Thanks you (Normal Message: wdihihiq fiqhfiqifq ifqiw fqwifjqw ifjiw fjwifjiwjfiqwjfi qwijfqw ijfiqw fiqwjfiqwjfi qwifjqwi fjw fjwif wifqw ifjiqwjfiqw fiqwjfi qwfijqwfiqwjf iqwjfi wifjqw ifqwijf iqwfijwq fijw ifjwfjqwif qwijf iw)', NULL, 1, 1, '2021-01-04 01:44:41 pm', '2021-01-04 01:44:41 pm'),
('e7e1fdcf-4810-48a2-a735-93010cd36948', '381e9201-5822-4783-919f-13f83bd6e10b', '381e9201-5822-4783-919f-13f83bd6e10b', 'Updated at: January 04, 2021 04:51:04 pm <p>I will really like to the whole package. Am sure it will look very fine on you.</p><p>I will be expecting it.</p><p>Thanks you so much.</p>Later<br>\r\n                                                            <br>\r\n                                                            <br>\r\n                                                            <hr>\r\n                                                            <b>Original Message:</b><br>\r\n                                                            Updated at: 2021-01-04 04:37:46 pm <p><em>Okay. please try to do it quickly.</em></p><p><em>Thank you.</em></p><em>Best regard.</em>\r\n                                                            <hr>\r\n                                                            <b>Original Message:</b><br>\r\n                                                            Got your message. Thanks you (Normal Message: wdihihiq fiqhfiqifq ifqiw fqwifjqw ifjiw fjwifjiwjfiqwjfi qwijfqw ijfiqw fiqwjfiqwjfi qwifjqwi fjw fjwif wifqw ifjiqwjfiqw fiqwjfi qwfijqwfiqwjf iqwjfi wifjqw ifqwijf iqwfijwq fijw ifjwfjqwif qwijf iw)', NULL, 1, 1, '2021-01-04 04:51:04 pm', '2021-01-04 01:45:58 pm'),
('9f7e394d-8738-4c0b-92b5-c032d2dde966', '381e9201-5822-4783-919f-13f83bd6e10b', '381e9201-5822-4783-919f-13f83bd6e10b', 'Sure. I will give you discount if u but more. Thanks (Normal Message: Do you have discount if i buy many of this items)', NULL, 0, 1, '2021-01-04 01:46:34 pm', '2021-01-04 01:46:34 pm');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `productID` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `userID` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currencyID` int DEFAULT NULL,
  `product_code` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `original_price` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_price` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryID` int DEFAULT NULL,
  `collectionID` int DEFAULT NULL,
  `brand` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_available` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_comment` int DEFAULT NULL,
  `is_online` int NOT NULL DEFAULT '0',
  `product_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product_feature` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payment_method` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_status` int NOT NULL DEFAULT '1',
  `is_deleted` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`productID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `userID`, `currencyID`, `product_code`, `product_token`, `product_name`, `original_price`, `old_price`, `categoryID`, `collectionID`, `brand`, `is_available`, `is_comment`, `is_online`, `product_details`, `product_feature`, `payment_method`, `created_at`, `updated_at`, `admin_status`, `is_deleted`) VALUES
('8e74ad08-7119-4eb2-a3e3-4f10cb416fb6', '381e9201-5822-4783-919f-13f83bd6e10b', 3, 'MD2Y9A8WF19', '2NRWOCMO37CRM83GSST8', 'Sony PS 3 Wireless Game Pad - Single Pad', '6000', NULL, 5, 18, 'Sony', 'Available', 1, 1, '<p>This high performance wireless ps3 \r\njoypad has everything you need to play the game. It features eight-way \r\ndigital D-buttons, eight digital fire buttons, vibration feedback (Dual \r\nShock), plus both turbo &amp; normal modes. With super control and \r\ndurability and thumb-controlled analog sticks, this user friendly and \r\neasy to install and Play pad is ready for immediate gaming action</p>', '<div class=\"row -pas\"><article class=\"col8 -pvs\"><div class=\"card-b -fh\"><h2 class=\"hdr -upp -fs14 -m -pam\">Key Features</h2><div class=\"markup -pam\"><ul><li>Built-in pressure sensors rumble and vibrate along with the actions on the screen for more exciting game play</li><li>SIXAXIS motion-sensing technology picks up on your movements for a natural, interactive feel</li><li>Bluetooth technology provides precise wireless game play</li><li>Charge the controller through your PlayStation 3 using the controller\'s USB cable</li><li>PlayStation 3 system can support up to seven wireless controllers at one time (not include</li></ul></div></div></article><article class=\"col8 -pvs\"><div class=\"card-b -fh\"><h2 class=\"hdr -upp -fs14 -m -pam\">Specifications</h2><ul class=\"-pvs -mvxs -phm -lsn\"><li class=\"-pvxs\"><span class=\"-b\">SKU</span>: SO521EL1KXNWMNAFAMZ</li><li class=\"-pvxs\"><span class=\"-b\">Color</span>: black</li><li class=\"-pvxs\"><span class=\"-b\">Main Material</span>: plastic</li><li class=\"-pvxs\"><span class=\"-b\">Model</span>: ps 3</li><li class=\"-pvxs\"><span class=\"-b\">Production Country</span>: China</li><li class=\"-pvxs\"><span class=\"-b\">Product Line</span>: IFEATURE</li><li class=\"-pvxs\"><span class=\"-b\">Size (L x W x H cm)</span>: not specific</li><li class=\"-pvxs\"><span class=\"-b\">Weight (kg)</span>: 0.2</li></ul></div></article></div>', NULL, '2020-12-11 11:29:31 am', '2020-12-16 09:58:29 pm', 1, 0),
('dd6b10c1-9afe-4f20-9d0e-e8e938ff1563', '381e9201-5822-4783-919f-13f83bd6e10b', 3, '015BSDQXBAV', '0RQRKOGI3MC8H23HDRS0', 'Hp 15.6\" 15-10210U Touchscreen Intel Core I5- 8GB, 2TB HDD,Windows 10 Home', '340000', '420000', 5, 13, 'Hp', 'Available', 1, 1, '<div class=\"markup -mhm -pvl -oxa -sc\"><ul class=\"itemColumn\"><li class=\"item\">15.6-inch HD WLED-backlit touchscreen</li><li class=\"item\">Intel Core i5-10210U</li><li class=\"item\">8GB memory</li><li class=\"item\">2TB HDD</li><li class=\"item\">Intel HD Graphics 620</li><li class=\"item\">Bluetooth 4.2, Webcam</li><li class=\"item\">Windows 10 Home</li><li class=\"item\">15.6-inch HD WLED-backlit touchscreen</li><li class=\"item\">Intel Core i5-10210U</li><li class=\"item\">8GB memory</li><li class=\"item\">2TB HDD</li><li class=\"item\">Intel HD Graphics 620</li><li class=\"item\">Bluetooth 4.2, Webcam</li><li class=\"item\">Windows 10 Home</li><li class=\"item\">15.6-inch HD WLED-backlit touchscreen</li><li class=\"item\">Intel Core i5-10210U</li><li class=\"item\">8GB memory</li><li class=\"item\">2TB HDD</li><li class=\"item\">Intel HD Graphics 620</li><li class=\"item\">Bluetooth 4.2, Webcam</li><li class=\"item\">Windows 10 Home</li><li class=\"item\">15.6-inch HD WLED-backlit touchscreen</li><li class=\"item\">Intel Core i5-10210U</li><li class=\"item\">8GB memory</li><li class=\"item\">2TB HDD</li><li class=\"item\">Intel HD Graphics 620</li><li class=\"item\">Bluetooth 4.2, Webcam</li><li class=\"item\">Windows 10 Home</li><li class=\"item\">15.6-inch HD WLED-backlit touchscreen</li><li class=\"item\">Intel Core i5-10210U</li><li class=\"item\">8GB memory</li><li class=\"item\">2TB HDD</li><li class=\"item\">Intel HD Graphics 620</li><li class=\"item\">Bluetooth 4.2, Webcam</li><li class=\"item\">Windows 10 Home</li><li class=\"item\">15.6-inch HD WLED-backlit touchscreen</li><li class=\"item\">Intel Core i5-10210U</li><li class=\"item\">8GB memory</li><li class=\"item\">2TB HDD</li><li class=\"item\">Intel HD Graphics 620</li><li class=\"item\">Bluetooth 4.2, Webcam</li><li class=\"item\">Windows 10 Home</li><li class=\"item\">15.6-inch HD WLED-backlit touchscreen</li><li class=\"item\">Intel Core i5-10210U</li><li class=\"item\">8GB memory</li><li class=\"item\">2TB HDD</li><li class=\"item\">Intel HD Graphics 620</li><li class=\"item\">Bluetooth 4.2, Webcam</li><li class=\"item\">Windows 10 Home</li><li class=\"item\">15.6-inch HD WLED-backlit touchscreen</li><li class=\"item\">Intel Core i5-10210U</li><li class=\"item\">8GB memory</li><li class=\"item\">2TB HDD</li><li class=\"item\">Intel HD Graphics 620</li><li class=\"item\">Bluetooth 4.2, Webcam</li><li class=\"item\">Windows 10 Home</li></ul></div>', '<div class=\"row -pas\"><article class=\"col8 -pvs\"><div class=\"card-b -fh\"><h2 class=\"hdr -upp -fs14 -m -pam\">Key Features</h2><div class=\"markup -pam\">\r\n        \r\n            <ul class=\"itemColumn\"><li class=\"item\">\r\n                            15.6-inch  HD WLED-backlit touchscreen\r\n                        </li><li class=\"item\">\r\n                            Intel Core i5-10210U</li><li class=\"item\">\r\n                            8GB memory\r\n                        </li><li class=\"item\">\r\n                            2TB HDD</li><li class=\"item\">\r\n                            Intel HD Graphics 620\r\n                        </li><li class=\"item\">\r\n                            Bluetooth 4.2, Webcam\r\n                        </li><li class=\"item\">\r\n                            Windows 10 Home</li></ul>\r\n        \r\n    </div></div></article><article class=\"col8 -pvs\"><div class=\"card-b -fh\"><h2 class=\"hdr -upp -fs14 -m -pam\">What’s in the box</h2><div class=\"markup -pam\">LAPTOP,CHARGER AND MANUAL<br></div></div></article><article class=\"col8 -pvs\"><div class=\"card-b -fh\"><h2 class=\"hdr -upp -fs14 -m -pam\">Specifications</h2><ul class=\"-pvs -mvxs -phm -lsn\"><li class=\"-pvxs\"><span class=\"-b\">SKU</span>: HP246EL0Z20P4NAFAMZ</li><li class=\"-pvxs\"><span class=\"-b\">Processor Type</span>: Intel Core i5</li><li class=\"-pvxs\"><span class=\"-b\">Display Features</span>: Full HD</li><li class=\"-pvxs\"><span class=\"-b\">Display Size (inches)</span>: 15.6</li><li class=\"-pvxs\"><span class=\"-b\">Hard Disk (GB)</span>: 2048</li><li class=\"-pvxs\"><span class=\"-b\">Operating System</span>: Windows 10</li><li class=\"-pvxs\"><span class=\"-b\">Internal Memory(GB)</span>: 8</li><li class=\"-pvxs\"><span class=\"-b\">Color</span>: BLACK</li><li class=\"-pvxs\"><span class=\"-b\">Product Line</span>: IFEATURE</li><li class=\"-pvxs\"><span class=\"-b\">Weight (kg)</span>: 2.04</li></ul></div></article></div>', NULL, '2020-12-11 11:21:51 am', '2020-12-14 09:18:26 pm', 1, 0),
('33986b9f-d98f-4103-bec2-097b38adebae', '381e9201-5822-4783-919f-13f83bd6e10b', 3, 'IKIGLO210VM', 'LR3OT1ME9BC14B13ZGOT', 'Mamador COOKING OIL- 1.5L', '1400', '1600', 1, 9, 'Mamador', 'Available', 1, 1, '<div class=\"markup -mhm -pvl -oxa -sc\"><p style=\"caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px;\">Mamador\r\n is a healthy cooking oil for heart health and tasty meals. It\'s \r\ncholesterol free and also contains Omega 6 &amp; 9 proven to keep heart \r\nhealthy. It is triple filtered to deliver superior golden colour and \r\nensure removal of all impurities thus 100% Pure. Mamador Pure Vegetable \r\nOil is a healthy choice for your daily cooking as it also contains \r\nVitamins A and E, which provide major health benefits to the whole \r\nfamily.</p><p style=\"caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px;\">Other benefits of Mamador Pure Vegetable Oil include its stability under the Nigerian climate. It does not oxidize in sunlight.</p><p style=\"caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px;\">It\r\n is suitable for all types of cooking, frying and baking and brings out \r\nthe expected natural taste on any meals prepared with it.</p><p style=\"caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px;\">Mamador\r\n Cooking Oil is produced and packaged locally (in Nigeria) in a world \r\nclass refinery- ISO, NAFDAC and CODEX-certified manufacturing \r\nenvironment which guarantees 100% product quality and freshness.</p><ul><li>Tamper proof packaging</li><li>Cholesterol Free</li><li>Free from artificial additives</li><li>Natural source of Vitamin E</li><li>Fortified with Vitamin A</li><li>Naturally contains Omega 6 &amp; 9</li></ul></div>', '<div class=\"row -pas\"><article class=\"col8 -pvs\"><div class=\"card-b -fh\"><h2 class=\"hdr -upp -fs14 -m -pam\">Key Features</h2><div class=\"markup -pam\">Mamador\r\n cooking oil delivers superior quality, purity and taste because only \r\nthe good gets in. Mamador products are made from palm oil which makes it\r\n great for all of your cooking requirements; whether you’re frying, \r\nusing oil as a recipe ingredient or as a dressing for a delicious salad,\r\n the purity of Mamador oil will ensure your food tastes great. Mamador \r\ncooking oil offer consumers a healthier way to cook. They are free from \r\nartificial additives, but contain essential Vitamins which help the body\r\n maintain a strong and healthy immune system.<ul style=\"caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px;\"><li>Tamper proof packaging</li><li>Cholesterol Free</li><li>Free from artificial additives</li><li>Natural source of Vitamin E</li><li>Fortified with Vitamin A</li><li>Naturally contains Omega 6 &amp; 9</li></ul></div></div></article><article class=\"col8 -pvs\"><div class=\"card-b -fh\"><h2 class=\"hdr -upp -fs14 -m -pam\">What’s in the box</h2><div class=\"markup -pam\">MAMADOR COOKING OIL- 1.5L x1</div></div></article><article class=\"col8 -pvs\"><div class=\"card-b -fh\"><h2 class=\"hdr -upp -fs14 -m -pam\">Specifications</h2><ul class=\"-pvs -mvxs -phm -lsn\"><li class=\"-pvxs\"><span class=\"-b\">SKU</span>: MA127FF0ADKNTNAFAMZ</li><li class=\"-pvxs\"><span class=\"-b\">Main Material</span>: OIL</li><li class=\"-pvxs\"><span class=\"-b\">Model</span>: VEGETABLE OIL</li><li class=\"-pvxs\"><span class=\"-b\">Production Country</span>: Nigeria</li><li class=\"-pvxs\"><span class=\"-b\">Product Line</span>: PZ CUSSONS</li><li class=\"-pvxs\"><span class=\"-b\">Weight (kg)</span>: 0.35</li></ul></div></article></div>', NULL, '2020-12-11 11:11:00 am', '2020-12-16 09:58:20 pm', 1, 0),
('0de6de96-f4c1-4811-9961-f8c5ce2a324a', '381e9201-5822-4783-919f-13f83bd6e10b', 3, 'O27GV8BANXQ', '0G47HIW3SHCPQC7ER7R7', 'Ktc Almond Oil, Castor Oil And Coconut Oil Combo', '3900', '10500', 1, 9, 'Ktc', 'Available', 1, 1, '<p><b>The combination of three great oils</b> from nature\'s foods.&nbsp; Known \r\nfor their great benefits when used for both hair and skin care.A \r\ncombination of these three oils or used singly can be used to moisturize\r\n the skin and hair, relieve allergy and treat skin blemishes.<b><br></b>Coconut oilIts natural antioxidant properties make it great for stopping wrinkles and skin irritation.<br>Almond oilThanks to the<b>&nbsp;</b>Vitamin E<b>,</b> sweet almond oil keeps your&nbsp;skin&nbsp;cells healthy, protects your&nbsp;skin&nbsp;from UV radiation damage, and helps your<b>&nbsp;</b>skin<b>&nbsp;</b>look\r\n smooth, soft, and free of fine lines. The fatty acids help \r\nyour&nbsp;skin&nbsp;retain moisture and can heal chapped and irritated&nbsp;skin. Plus,\r\n the&nbsp;vitamin A&nbsp;can help reduce&nbsp;acne.<br>Castor oilAcne: The \r\nantimicrobial and&nbsp;anti-inflammatory&nbsp;properties of castor oil make it \r\nuseful in reducing&nbsp;acne. Ricinoleic acid can inhibit growth in the \r\nbacteria that cause&nbsp;acne. Texture: Castor oil is also rich in other \r\nfatty acids. These can enhance smoothness and softness when applied to \r\nfacial<b>&nbsp;</b>skin</p>', '<article class=\"col8 -pvs\"><div class=\"card-b -fh\"><h2 class=\"hdr -upp -fs14 -m -pam\">Key Features</h2><div class=\"markup -pam\"><ul><li>Three must have Pantry items</li><li>Sweet almond oil keeps your&nbsp;skin&nbsp;cells healthy,</li><li>Protects your&nbsp;skin&nbsp;from UV radiation damage</li><li>Helps your<b style=\"color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 16px;\">&nbsp;</b>skin<b style=\"color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 16px;\">&nbsp;</b>look smooth, soft, and free of fine lines</li><li>Contains Vitamin E</li><li>Coconut oil contains&nbsp;natural antioxidant properties</li><li>Great for stopping wrinkles and skin irritation.</li><li>Castor oil has&nbsp;antimicrobial and&nbsp;anti-inflammatory&nbsp;properties </li><li><article class=\"col8 -pvs\"><div class=\"card-b -fh\"><h2 class=\"hdr -upp -fs14 -m -pam\">Specifications</h2><ul class=\"-pvs -mvxs -phm -lsn\"><li class=\"-pvxs\"><span class=\"-b\">SKU</span>: KT310HB0Z0JJHNAFAMZ</li><li class=\"-pvxs\"><span class=\"-b\">Skin Type</span>: All Skin Types</li><li class=\"-pvxs\"><span class=\"-b\">Production Country</span>: UK</li><li class=\"-pvxs\"><span class=\"-b\">Product Line</span>: Kimani Ventures</li><li class=\"-pvxs\"><span class=\"-b\">Weight (kg)</span>: 0.8</li></ul></div></article></li></ul></div></div></article>', NULL, '2020-12-11 10:50:16 am', '2020-12-16 09:58:40 pm', 1, 0),
('88275bd5-76b7-4370-b518-6132795540d4', '381e9201-5822-4783-919f-13f83bd6e10b', 3, '83SQKMFT41Z', 'BX5T4NG5R03TA61NB1R2', 'Color Screen Smart Bracelet D13 Waterproof Bracelet', '3187', '13200', 4, NULL, 'Bracelet', 'Available', 1, 1, '<p><br></p><h3 style=\"box-sizing: border-box; padding: 8px 0px; margin: 0px;\">\"If you think ourproducts are useful, please introduceyour friends to buy them</h3><h3 style=\"box-sizing: border-box; padding: 8px 0px; margin: 0px;\">Your 5-StarPositive Feedback is much appreciated!</h3><h3 style=\"box-sizing: border-box; padding: 8px 0px; margin: 0px;\">Welcome to Shopping Here!\"</h3><h3 style=\"box-sizing: border-box; padding: 8px 0px; margin: 0px; font-weight: 400; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \">How\r\n to Charge Remove the bands off the tracker host and you can see the \r\nbuilt-in USB plug with metal pins, insert the USB plug into a USB \r\ncharger(such as phone charger) for charging, no charging cable needed</h3><br><b>1.if the watch cannot be started, please charge it for 2 hours before use.&nbsp;<br style=\"box-sizing: border-box; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \">2.watch no need charger，directly charge in the usb charger or in the computer usb port.</b><p></p><p><br></p><h3 style=\"box-sizing: border-box; padding: 8px 0px; margin: 0px;\">Dear,thank you for your patience.All order need about 2 weeks in shipping.</h3><br><h3 style=\"box-sizing: border-box; padding: 8px 0px; margin: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \">Feature Function:&nbsp;<br style=\"box-sizing: border-box;\">Blood Pressure<br style=\"box-sizing: border-box;\">Passometer<br style=\"box-sizing: border-box;\">Sleep Tracker<br style=\"box-sizing: border-box;\">Push Message<br style=\"box-sizing: border-box;\">Heart Rate Tracker<br style=\"box-sizing: border-box;\">Blood oxygen<br style=\"box-sizing: border-box;\">Alarm Clock<br style=\"box-sizing: border-box;\">Remote Control<br style=\"box-sizing: border-box;\">Social Media Notifications<br style=\"box-sizing: border-box;\">Message Reminder<br style=\"box-sizing: border-box;\">Call Reminder<br style=\"box-sizing: border-box;\">1.3 inch large screen color screen smart bracelet<br style=\"box-sizing: border-box;\">&nbsp;<br style=\"box-sizing: border-box;\">APP Language: Korean,Russian,Spanish,English,German,Italian,Japanese,French,Portuguese<br style=\"box-sizing: border-box;\">&nbsp;<br style=\"box-sizing: border-box;\">Specification:<br style=\"box-sizing: border-box;\">Style: Sport<br style=\"box-sizing: border-box;\">Case Material: PLASTIC<br style=\"box-sizing: border-box;\">Waterproof Grade:Life Waterproof IP67<br style=\"box-sizing: border-box;\">Screen Type: Color LCD<br style=\"box-sizing: border-box;\">Band Detachable: Yes<br style=\"box-sizing: border-box;\">Touch Screen: Yes<br style=\"box-sizing: border-box;\">Compatibility: All Compatible<br style=\"box-sizing: border-box;\">Blutooth: 4.0<br style=\"box-sizing: border-box;\">Bettery: 180mAh<br style=\"box-sizing: border-box;\">System: IOS 9.0 &amp; Android 5.0 above<br style=\"box-sizing: border-box;\">APP name: Lefun health, please scan the code in the manual to download and install the app.<br style=\"box-sizing: border-box;\">&nbsp;<br style=\"box-sizing: border-box;\">&nbsp;<br style=\"box-sizing: border-box;\">Package include:<br style=\"box-sizing: border-box;\">1 * Smart bracelet<br style=\"box-sizing: border-box;\">1 * User manual<br style=\"box-sizing: border-box;\">1 * Retail box(it is USB charging, there is no charger in the box)</h3><br><h3 style=\"box-sizing: border-box; padding: 8px 0px; margin: 0px; font-weight: 400; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \">Note:<br style=\"box-sizing: border-box;\">Wearable\r\n devices monitors human activities through electronic sensors,and they \r\nare at the consumer electuonics level.It\'s normal for certain \r\ndeviation.The user should treat data objectively.<br style=\"box-sizing: border-box;\">--Please do not compared to hospital equipment about reading,it is NOT a medical device!<br style=\"box-sizing: border-box;\">--Before using, scan the QR code on the manual to download the app and connect it to the watch with APP.&nbsp;<br style=\"box-sizing: border-box;\">--\r\n For Android user: Please always authorize the app access to all phone \r\nfunctions and always let it operating on. and please turn on the GPS on \r\nyour phone before you connect it.<br style=\"box-sizing: border-box;\">--Please charge it for 2-3 hours when you receive it. it was run out of power after the long delivery. Thank you!</h3>', '<div class=\"markup -pam\"><h3 style=\"box-sizing: border-box; padding: 8px 0px; margin: 0px; font-weight: 400; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, \">The\r\n color of the actual items may vary slightly from the images above due \r\nto different computer screens.There may be slight size deviations due to\r\n manual measurement, different measuring methods and tools.&nbsp;&nbsp;Thanks for \r\nyour understandings.Hope you have a great day!!For understand more \r\nproducts, click seller Information to enter our store for purchase.</h3></div><article class=\"col8 -pvs\"><div class=\"card-b -fh\"><h2 class=\"hdr -upp -fs14 -m -pam\">What’s in the box</h2><div class=\"markup -pam\"><h3 style=\"box-sizing: border-box; padding: 8px 0px; margin: 0px; color: rgb(40, 40, 40); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Helvetica Neue&quot;, Arial, sans-serif;\">1 * Smart bracelet<br style=\"box-sizing: border-box;\">1 * User manual<br style=\"box-sizing: border-box;\">1 * Retail box(it is USB charging, there is no charger in the box)</h3></div></div></article><article class=\"col8 -pvs\"><div class=\"card-b -fh\"><h2 class=\"hdr -upp -fs14 -m -pam\">Specifications</h2><ul class=\"-pvs -mvxs -phm -lsn\"><li class=\"-pvxs\"><span class=\"-b\">SKU</span>: TS657EA0HUFVQNAFAMZ</li><li class=\"-pvxs\"><span class=\"-b\">Color</span>: Black</li><li class=\"-pvxs\"><span class=\"-b\">Main Material</span>: Other</li><li class=\"-pvxs\"><span class=\"-b\">Model</span>: Smart Bracelet</li><li class=\"-pvxs\"><span class=\"-b\">Production Country</span>: China</li><li class=\"-pvxs\"><span class=\"-b\">Product Line</span>: TsdTech</li><li class=\"-pvxs\"><span class=\"-b\">Weight (kg)</span>: 0.2</li></ul></div></article>', '<p><br></p>', '2020-12-11 04:35:02 pm', '2020-12-18 03:25:37 pm', 1, 0),
('13089288-2234-4a65-a2d6-77156f9ebfbc', '381e9201-5822-4783-919f-13f83bd6e10b', 3, 'MZ176MGL8U3', 'UGV23SZW6QIOBUFSDNTA', 'Color Screen Smart Bracelet D13 Waterproof Bracelet', '2500', '2500', 20, 15, 'Bracelet', 'Available', 1, 1, 'sdvsdvsd', NULL, NULL, '2020-12-12 04:00:17 pm', '2020-12-16 09:58:11 pm', 1, 0),
('22f1bdc9-89ed-4e21-9470-fef2ef63b8ca', '381e9201-5822-4783-919f-13f83bd6e10b', 3, 'Z321B3A6IBR', '5ZK3N5OWCN5MPID6MYL4', 'Face Cap afafa', '2500', '4500', 1, 1, 'Geneva | Similar products from Geneva', 'Available', 1, 1, 'scasca', NULL, NULL, '2020-12-14 02:17:43 pm', '2020-12-14 10:26:47 pm', 1, 0),
('2dccea5c-1457-4993-8894-6294f2e78b2b', '381e9201-5822-4783-919f-13f83bd6e10b', 3, 'RLZVQTGSG60', 'KV620Q8YM4X46EVKLIHD', 'Nice Curly Hair', '2850', '4500', 2, NULL, 'Nice Curly Hair', 'Available', 1, 1, '<div class=\"markup -mhm -pvl -oxa -sc\"><b>This Kinky curly soft is&nbsp; premium fibre</b>&nbsp;\r\n blend&nbsp; that comes in 16\" length. it is made from natural hair blend, \r\nand does not shed or tangle.Proper care for natural hair extensions<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">Not\r\n everyone has naturally exotic hair, hence the desire for the Brazilian,\r\n Indian, Peruvian and Cambodian hairs, regardless of their prices. The \r\nreason some women are able to reuse their natural hair extensions for as\r\n long as a year is the maintenance practice. Hair extensions require \r\nwork as they are not like the natural hair. The better you take care of \r\nyour natural hair extensions, the longer they will last.</p><p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">In order to ensure long-lasting extensions and wigs, the following tips will prove helpful:</p><p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">Detangling hair</p><p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">To get rid of tangles, gently comb out&nbsp;<a data-cke-saved-href=\"http://www.humanhairnigeria.com.ng/\" href=\"http://www.humanhairnigeria.com.ng/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(119, 119, 119); text-decoration-line: none; margin: 0px; padding: 0px; border: 0px rgb(234, 234, 234); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; transition: color 0.2s ease 0s;\">hair extensions</a>&nbsp;using\r\n a wide tooth brush or a detangling brush. While combing, do not just \r\ninsert the brush to the root of the hair, start combing from the ends \r\nand slowly work your way to the top (the root). To avoid removing the \r\nhair while combing, support the extension with your hand.</p><p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">Washing</p><p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">It\r\n is advisable to wash the hair at least once in a week, but not more \r\nthan three times in a week. Washing them too much will make them appear \r\ntoo dry and they will get damaged faster, which is undesirable. It is \r\nbest to wash gently with cold water and a very gentle shampoo, free of \r\nsulphite. Always apply moisturising conditioner after washing. Rinse the\r\n hair and dry.<br style=\"box-sizing: border-box;\"></p><p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">Drying hair&nbsp;</p><p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">Pat the hair dry and avoid rubbing with a towel as this will lead to breakage. It is best to allow<a data-cke-saved-href=\"http://www.humanhairnigeria.com.ng/\" href=\"http://www.humanhairnigeria.com.ng/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(119, 119, 119); text-decoration-line: none; margin: 0px; padding: 0px; border: 0px rgb(234, 234, 234); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; transition: color 0.2s ease 0s;\">&nbsp; hair extensions</a>&nbsp;dry\r\n in air, as excessive use of hair dryer will lead to damage of the hair.\r\n However, if necessary the dryer should be put on a cool setting, and \r\nthe extension should be combed out gently with a wide tooth brush while \r\ndrying.</p><p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">Styling natural hair extensions</p><p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">It\r\n is best to discuss your&nbsp; hair style preferences with your stylist. Use \r\nstyling products that are alcohol free such as mousse, gel, and \r\nhairspray in moderation. Avoid oily or greasy products, as it can cause \r\nextreme tangling of the hair.</p><p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">Applying heat</p><p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">Heat\r\n is the biggest enemy of hair extensions. Excessive use of heat causes \r\nthe ends of the hair to weaken and become brittle, leading to breakage. \r\nIf heat must be used, heat protectant must be applied to the hair \r\nbefore-hand. The use of flat irons should be avoided.</p><p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">Sleeping with natural hair</p><p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">Avoid sleeping with the natural<a data-cke-saved-href=\"http://www.humanhairnigeria.com.ng/\" href=\"http://www.humanhairnigeria.com.ng/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(119, 119, 119); text-decoration-line: none; margin: 0px; padding: 0px; border: 0px rgb(234, 234, 234); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; transition: color 0.2s ease 0s;\">&nbsp;hair</a>&nbsp;wet\r\n , for it may get tangled while sleeping. Plait the hair, pin it up, \r\nroller-set it or roll with bendy rollers before sleeping. Sleep with a \r\nsatin cap or on a satin covered pillow to avoid pillow friction.</p><p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: 18px; vertical-align: baseline;\">Other things to take note of:</p><ul style=\"box-sizing: border-box; margin: 0px 0px 9px; color: rgb(96, 96, 96); font-family: inherit; font-size: 12px; font-style: inherit; font-variant: inherit; font-weight: inherit; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: inherit; vertical-align: baseline; list-style: none;\"><li style=\"box-sizing: border-box; font-family: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; margin: 0px; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: inherit; vertical-align: baseline;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n Avoid touching the hair every time. Touching&nbsp; hair extensions leads to \r\nthe transfer of oils from the hand to the hair, leading to them become \r\nunsightly.</li><li style=\"box-sizing: border-box; font-family: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; margin: 0px; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: inherit; vertical-align: baseline;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n Rinse your hair in tap water before and after going into the swimming \r\npool. The heavily chlorinated water has damaging effects on natural \r\nhair.</li><li style=\"box-sizing: border-box; font-family: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; margin: 0px; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: inherit; vertical-align: baseline;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Do not use towels to rigorously dry out your natural hair extensions, to avoid breakage.</li><li style=\"box-sizing: border-box; font-family: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; margin: 0px; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: inherit; vertical-align: baseline;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n Oil your scalp whenever your scalp feels itchy. Avoid scratching \r\nbecause it can result in frizzy roots and noticeable tracks.</li><li style=\"box-sizing: border-box; font-family: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; margin: 0px; padding: 0px; border: 0px rgb(234, 234, 234); font-stretch: inherit; line-height: inherit; vertical-align: baseline;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n When storing your&nbsp; hair, store them in well ventilated packs, and in \r\nsuch a way that they do not get matted and tangled.</li></ul></div>', NULL, NULL, '2020-12-14 08:12:30 pm', '2020-12-14 09:10:33 pm', 1, 0),
('73d23754-7656-44f7-8c3e-b8d5204e6cfb', '381e9201-5822-4783-919f-13f83bd6e10b', 3, 'U570I2ZVVYI', '9L5WD3YT9QQWUZLW3ZEO', 'Wireless Bluetooth Portable Alarm Clock FM Radio Green', '4390', '6500', 6, NULL, NULL, 'Available', 0, 1, '<b>SPECIFICATIONS</b>Bluetooth version: 5.0&nbsp;Output Power: 3W \r\nTHD=10%Frequency Response: 80HZ- 20KHZ&nbsp;SNR:≥65dBRadio Frequency: \r\n87.5MHZ-108MHZ&nbsp;Temperature range:30°c-50°c&nbsp;Speaker: ： 40Ω/3WDisplay \r\nDimmer: 3-LevelItem Weight: 0. 32 kgBattery. 3. 7V 1400mAh lithium \r\nbatterySize W x D x H: 131*46* 69 mm<br>Battery LifeBuilt-in \r\nRechargeable Battery: 3. 7V 1400mAh lithium batteryPlaying Time: Approx \r\n3-6 hours(Playing volumeCharging Time: Approx 3-4 hoursStand by: Approx \r\n200 hours<br>ACCESSORIES1 x Speaker1 x User Manual1 x Micro USB Charging Cable<br><b>NOTES</b>1.\r\n Please READ the user manual carefully before using this product and \r\nkeep the it for future reference.2. Please wipe the LED screen with lens\r\n cloth gently to avoid scratching the surface.3.Connection: Bluetooth, \r\nup to 16G Micro SD card, 3.5 line-in Aux Cable. 87.5-108MHz.4.Built-in \r\nrechargeable battery, this device can be charged from mobile phone adapt\r\n or computer.When the speaker prompts tone battery low, please charge \r\nthe speaker. If do not use it ,please turn it off. If you do not use it \r\nfor a long time, please charge it within 2-3 months to protect the \r\nbattery.5. When the speaker is malfunction, please insert and press \r\nthe\"RESET\" button built in the AUX socket, use some tools like \r\nstraighten clip.', NULL, NULL, '2020-12-14 09:13:50 pm', '2020-12-16 09:58:03 pm', 1, 0),
('61b56290-9319-4be9-a40f-c6f626c21da4', '381e9201-5822-4783-919f-13f83bd6e10b', 3, 'NRHLJ5KDP9O', '4D55UG8NFE1E9SGD05UH', 'Gionee S11 Lite 5.7-Inch HD (4GB,64GB ROM) Android 7.1 (13MP + 2MP) + 16MP Dual SIM 4G LTE Fingerprint ID Smartphone - Black', '39850', NULL, 4, 23, 'Gionee', 'Available', 1, 0, '<b>SPECIFICATIONS</b>Bluetooth version: 5.0&nbsp;Output Power: 3W \r\nTHD=10%Frequency Response: 80HZ- 20KHZ&nbsp;SNR:≥65dBRadio Frequency: \r\n87.5MHZ-108MHZ&nbsp;Temperature range:30°c-50°c&nbsp;Speaker: ： 40Ω/3WDisplay \r\nDimmer: 3-LevelItem Weight: 0. 32 kgBattery. 3. 7V 1400mAh lithium \r\nbatterySize W x D x H: 131*46* 69 mm<br>Battery LifeBuilt-in \r\nRechargeable Battery: 3. 7V 1400mAh lithium batteryPlaying Time: Approx \r\n3-6 hours(Playing volumeCharging Time: Approx 3-4 hoursStand by: Approx \r\n200 hours<br>ACCESSORIES1 x Speaker1 x User Manual1 x Micro USB Charging Cable<br><b>NOTES</b>1.\r\n Please READ the user manual carefully before using this product and \r\nkeep the it for future reference.2. Please wipe the LED screen with lens\r\n cloth gently to avoid scratching the surface.3.Connection: Bluetooth, \r\nup to 16G Micro SD card, 3.5 line-in Aux Cable. 87.5-108MHz.4.Built-in \r\nrechargeable battery, this device can be charged from mobile phone adapt\r\n or computer.When the speaker prompts tone battery low, please charge \r\nthe speaker. If do not use it ,please turn it off. If you do not use it \r\nfor a long time, please charge it within 2-3 months to protect the \r\nbattery.5. When the speaker is malfunction, please insert and press \r\nthe\"RESET\" button built in the AUX socket, use some tools like \r\nstraighten clip.', NULL, NULL, '2020-12-14 09:17:14 pm', '2021-01-06 07:53:35 am', 1, 0),
('b85b6892-0685-4b34-ad8e-4617628b9872', '381e9201-5822-4783-919f-13f83bd6e10b', 3, '1M3FP0YRW1U', 'XJ9HW92C0D8RJ068XCK2', 'Leather Belt - Black', '2399', '0', 8, NULL, 'Belt', 'Available', 1, 1, 'This contemporary leather belt  featuring a simple design, premium leather and classic stitch detail. Smart, versatile belt made from 100% leather. It features smooth stainless buckle.', NULL, NULL, '2020-12-14 09:23:11 pm', '2021-01-05 10:15:05 pm', 1, 0),
('4d48941f-2f3a-4a89-a4be-e67d7c81422d', '97821a68-c180-4010-88fb-0748fdd74143', 1, '6OKK4XTMLN2', 'UVJBLSNRE3D9U5T3KV7U', 'Color Screen Smart Bracelet D13 Waterproof Bracelet wewewew', '2500', '10500', 6, NULL, 'tossAjax', 'Available', 0, 1, 'Cool and nice product<br>', NULL, NULL, '2020-12-21 03:42:06 pm', '2020-12-23 08:21:45 pm', 1, 0),
('893d9765-45c3-4323-9183-f057d158f9d5', '97821a68-c180-4010-88fb-0748fdd74143', 1, 'P0MC0ZJNJDJ', 'JP2I7L9QWNN4C7AGLKX1', 'How to Use orWhere in Laravel? - HDTuto.com', '2500', '4500', 12, NULL, 'Laravel', 'Available', 0, 1, 'How to Use orWhere in Laravel? - HDTuto.com', NULL, NULL, '2020-12-23 10:26:53 pm', '2020-12-24 11:43:52 am', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_cart`
--

DROP TABLE IF EXISTS `product_cart`;
CREATE TABLE IF NOT EXISTS `product_cart` (
  `cartID` bigint NOT NULL AUTO_INCREMENT,
  `userID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `store_token` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transactionID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_order_placed` int NOT NULL DEFAULT '0',
  `is_cancel` int NOT NULL DEFAULT '0',
  `checkout` int NOT NULL DEFAULT '0',
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_item_delivered` int NOT NULL DEFAULT '0',
  `delivery_code` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deliver_user_match` int DEFAULT '0',
  `is_to_be_delivered_by` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_item_confirm_by_store` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`cartID`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_cart`
--

INSERT INTO `product_cart` (`cartID`, `userID`, `productID`, `quantity`, `status`, `store_token`, `transactionID`, `order_number`, `is_order_placed`, `is_cancel`, `checkout`, `created_at`, `updated_at`, `is_item_delivered`, `delivery_code`, `is_deliver_user_match`, `is_to_be_delivered_by`, `is_item_confirm_by_store`) VALUES
(30, '381e9201-5822-4783-919f-13f83bd6e10b', '2dccea5c-1457-4993-8894-6294f2e78b2b', 1, 0, 'GHYUJIKJ7TDE4E4', 'DJ03BS3UKJID', 'D0NEDL9VRXH', 1, 0, 1, '2020-12-26 11:08:36 am', '2020-12-30 09:35:32 pm', 0, NULL, 0, NULL, 0),
(31, '381e9201-5822-4783-919f-13f83bd6e10b', '33986b9f-d98f-4103-bec2-097b38adebae', 1, 0, 'GHYUJIKJ7TDE4E4', 'IDTOF3RMF2MC', 'D0NEDL9VRXH', 1, 0, 1, '2020-12-26 11:18:25 am', '2020-12-30 09:35:32 pm', 0, NULL, 0, NULL, 0),
(32, '381e9201-5822-4783-919f-13f83bd6e10b', '0de6de96-f4c1-4811-9961-f8c5ce2a324a', 1, 0, 'GHYUJIKJ7TDE4E4', 'B92VS69JW392', 'D0NEDL9VRXH', 1, 0, 1, '2020-12-26 11:28:41 am', '2020-12-30 09:35:32 pm', 0, NULL, 0, NULL, 0),
(43, '97821a68-c180-4010-88fb-0748fdd74143', '2dccea5c-1457-4993-8894-6294f2e78b2b', 1, 1, 'HMNKH57DS4RE', 'V90GKLTSDOVE', 'XZ4J0T2FQSUBGY3', 0, 0, 0, '2020-12-30 01:59:41 pm', '2020-12-30 02:00:41 pm', 0, NULL, 0, NULL, 0),
(41, '97821a68-c180-4010-88fb-0748fdd74143', '73d23754-7656-44f7-8c3e-b8d5204e6cfb', 1, 0, 'HMNKH57DS4RE', '1AO1X3E43ZP4', 'XZ4J0T2FQSUBGY3', 1, 0, 0, '2020-12-30 01:58:57 pm', '2020-12-30 02:00:41 pm', 0, NULL, 1, '381e9201-5822-4783-919f-13f83bd6e10b', 0),
(42, '97821a68-c180-4010-88fb-0748fdd74143', '4d48941f-2f3a-4a89-a4be-e67d7c81422d', 1, 0, 'HMNKH57DS4RE', '0OIT7YB142HI', 'XZ4J0T2FQSUBGY3', 1, 0, 0, '2020-12-30 01:59:05 pm', '2020-12-30 02:00:41 pm', 0, NULL, 1, '381e9201-5822-4783-919f-13f83bd6e10b', 0),
(45, '381e9201-5822-4783-919f-13f83bd6e10b', '4d48941f-2f3a-4a89-a4be-e67d7c81422d', 1, 0, 'HMNKH57DS4RE', 'UDQUXTGKPBIQ', 'BQ9VYX9LZMFSZGM', 1, 0, 0, '2021-01-02 04:04:23 pm', '2021-01-07 11:39:28 am', 0, 'ZIGG5S11TPLIQQY', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `categoryID` int NOT NULL AUTO_INCREMENT,
  `category` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`categoryID`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`categoryID`, `category`, `icon`, `url`, `status`) VALUES
(1, 'Supermarket', 'fa fa-apple', NULL, 1),
(2, 'Health & Beauty', 'fa fa-medkit', NULL, 1),
(3, 'Home & Office', 'fa fa-cutlery', NULL, 1),
(4, 'Phones & Tablets', 'fa fa-mobile-phone', NULL, 1),
(5, 'Computing', 'fa fa-desktop', NULL, 1),
(6, 'Electronics', 'fa fa-tv', NULL, 1),
(7, 'Fashion', 'fa fa-heart', NULL, 1),
(8, 'Baby Products', 'fa fa-user-o', NULL, 1),
(9, 'Gaming', 'fa fa-gamepad', NULL, 1),
(10, 'Sporting Goods', 'fa fa-futbol-o', NULL, 0),
(11, 'Automobile', 'fa fa-car', NULL, 0),
(12, 'Books, Movies & Music', 'fa fa-file-movie-o', NULL, 1),
(13, 'Musical Instruments', 'fa fa-music', NULL, 1),
(14, 'Pet Supplies', 'fa fa-smile-o', NULL, 0),
(15, 'Garden & Outdoors', 'fa fa-object-group', NULL, 1),
(16, 'Industrial & Scientific', 'fa fa-university', NULL, 1),
(17, 'Services', 'fa fa-fort-awesome', NULL, 0),
(18, 'Livestock', 'fa fa-truck', NULL, 1),
(19, 'Holiday Supplies & Gifts', 'fa fa-gift', NULL, 1),
(20, 'Bags, Shoes & Accessories\r\n', 'fa fa-shopping-bag', NULL, 1),
(21, 'Cameras & Photo', 'fa fa-video-camera', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_collection`
--

DROP TABLE IF EXISTS `product_collection`;
CREATE TABLE IF NOT EXISTS `product_collection` (
  `collectionID` int NOT NULL AUTO_INCREMENT,
  `categoryID` int DEFAULT NULL,
  `collection` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`collectionID`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_collection`
--

INSERT INTO `product_collection` (`collectionID`, `categoryID`, `collection`, `url`, `status`) VALUES
(1, 1, 'Red Wine', NULL, 1),
(2, 1, 'Grains & Rice', NULL, 1),
(3, 1, 'Pasta', NULL, 1),
(4, 1, 'Noodles', NULL, 1),
(5, 1, 'Breakfast Foods', NULL, 1),
(6, 1, 'Flours & Meals', NULL, 1),
(7, 1, 'Coffee', NULL, 1),
(8, 1, 'Water', NULL, 1),
(9, 1, 'Cooking Oil', NULL, 1),
(10, 1, 'Juices', NULL, 1),
(11, 1, 'Soft Drink', NULL, 1),
(12, 1, 'Candy & Chocolate', NULL, 1),
(13, 5, 'Laptop', NULL, 1),
(14, 5, 'Desktop', NULL, 1),
(15, 5, 'Scanners', NULL, 1),
(16, 5, 'Batteries', NULL, 1),
(17, 5, 'External Hard Drive', NULL, 1),
(18, 5, 'Game Pad', NULL, 1),
(19, 5, 'Game Disk', NULL, 1),
(20, 5, 'Game', NULL, 1),
(21, 5, 'Game Cable', NULL, 1),
(22, 4, 'Smart Watch', NULL, 1),
(23, 4, 'Basic Phones', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_colour`
--

DROP TABLE IF EXISTS `product_colour`;
CREATE TABLE IF NOT EXISTS `product_colour` (
  `colourID` int NOT NULL AUTO_INCREMENT,
  `colour_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colour_symbol` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colour_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`colourID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_colour`
--

INSERT INTO `product_colour` (`colourID`, `colour_name`, `colour_symbol`, `colour_code`, `status`) VALUES
(1, 'Yello', 'YL', 'FFFF00', 1),
(2, 'Blue', 'BL', '0000FF', 1),
(3, 'Purple', 'PP', '800080', 1),
(4, 'Red', 'RD', 'FF0000', 1),
(5, 'White', 'WH', 'FFFFFF', 1),
(6, 'Black', 'BK', '000000', 1),
(7, 'Gold', 'GD', 'ECC5C0', 1),
(8, 'Silver', 'Sl', 'C0C0C0', 1),
(9, 'Green', 'GR', '008000', 1),
(10, 'Navy', 'NV', '000080', 1),
(11, 'Lime', 'LM', '00FF00', 1),
(12, 'Grey', 'GY', '808080', 1),
(13, 'Brown', 'BR', 'A52A2A', 1),
(14, 'Magenta', 'MG', 'FF00FF', 1),
(15, 'Olive', 'OL', '808000', 1),
(16, 'Maroon', 'MA', '800000', 1),
(17, 'Orange', 'OR', 'FFA500', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_comment`
--

DROP TABLE IF EXISTS `product_comment`;
CREATE TABLE IF NOT EXISTS `product_comment` (
  `commentID` bigint NOT NULL AUTO_INCREMENT,
  `userID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` longtext,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`commentID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_comment`
--

INSERT INTO `product_comment` (`commentID`, `userID`, `productID`, `comment`, `name`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, '381e9201-5822-4783-919f-13f83bd6e10b', '13089288-2234-4a65-a2d6-77156f9ebfbc', 'I love this product. Nice product to have.', 'Samson Ajax', NULL, 1, '2020-12-22 02:02:31 pm', '2020-12-22 02:02:31 pm'),
(2, '381e9201-5822-4783-919f-13f83bd6e10b', 'b85b6892-0685-4b34-ad8e-4617628b9872', 'wdihihiq fiqhfiqifq ifqiw fqwifjqw ifjiw fjwifjiwjfiqwjfi qwijfqw ijfiqw fiqwjfiqwjfi qwifjqwi fjw fjwif wifqw ifjiqwjfiqw fiqwjfi qwfijqwfiqwjf iqwjfi wifjqw ifqwijf iqwfijwq fijw ifjwfjqwif qwijf iw', 'Samson Tope', 'sams@jwfw.jwwwf', 1, '2020-12-22 02:21:47 pm', '2020-12-22 02:21:47 pm'),
(3, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 'Do you have discount if i buy many of this items', NULL, NULL, 1, '2021-01-03 07:06:34 pm', '2021-01-03 07:06:34 pm'),
(4, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 'well, the product is fine.', 'Samson', NULL, 1, '2021-01-03 07:17:29 pm', '2021-01-03 07:17:29 pm');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
CREATE TABLE IF NOT EXISTS `product_image` (
  `product_imageID` bigint NOT NULL AUTO_INCREMENT,
  `userID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `productID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`product_imageID`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_imageID`, `userID`, `productID`, `file_name`, `file_description`, `created_at`) VALUES
(1, '381e9201-5822-4783-919f-13f83bd6e10b', 'be398554-71ec-4593-991a-fc2215f95d35', '930341607554498.jpg', NULL, '2020-12-09 10:54:58 pm'),
(2, '381e9201-5822-4783-919f-13f83bd6e10b', 'ff623135-7df8-46e4-ac70-19bf083fff3e', '672731607593114.jpg', NULL, '2020-12-10 09:38:34 am'),
(3, '381e9201-5822-4783-919f-13f83bd6e10b', 'ff623135-7df8-46e4-ac70-19bf083fff3e', '368581607593114.jpg', NULL, '2020-12-10 09:38:34 am'),
(4, '381e9201-5822-4783-919f-13f83bd6e10b', 'ff623135-7df8-46e4-ac70-19bf083fff3e', '981511607593114.jpg', NULL, '2020-12-10 09:38:34 am'),
(5, '381e9201-5822-4783-919f-13f83bd6e10b', 'ff623135-7df8-46e4-ac70-19bf083fff3e', '757211607593114.jpg', NULL, '2020-12-10 09:38:34 am'),
(6, '381e9201-5822-4783-919f-13f83bd6e10b', 'ff623135-7df8-46e4-ac70-19bf083fff3e', '805661607593114.jpg', NULL, '2020-12-10 09:38:34 am'),
(7, '381e9201-5822-4783-919f-13f83bd6e10b', 'c36c142a-6e6d-44bc-86ca-07ccc7bc97bc', '401111607593719.jpg', NULL, '2020-12-10 09:48:39 am'),
(8, '381e9201-5822-4783-919f-13f83bd6e10b', 'c36c142a-6e6d-44bc-86ca-07ccc7bc97bc', '502641607593719.jpg', NULL, '2020-12-10 09:48:39 am'),
(9, '381e9201-5822-4783-919f-13f83bd6e10b', 'c36c142a-6e6d-44bc-86ca-07ccc7bc97bc', '840071607593719.jpg', NULL, '2020-12-10 09:48:39 am'),
(10, '381e9201-5822-4783-919f-13f83bd6e10b', 'c36c142a-6e6d-44bc-86ca-07ccc7bc97bc', '122151607593719.jpg', NULL, '2020-12-10 09:48:39 am'),
(11, '381e9201-5822-4783-919f-13f83bd6e10b', 'c36c142a-6e6d-44bc-86ca-07ccc7bc97bc', '907511607593719.jpg', NULL, '2020-12-10 09:48:39 am'),
(12, '381e9201-5822-4783-919f-13f83bd6e10b', '2a40ca33-1d95-4143-b93b-4adbc7afc3e3', '413981607594121.jpg', NULL, '2020-12-10 09:55:21 am'),
(13, '381e9201-5822-4783-919f-13f83bd6e10b', '2a40ca33-1d95-4143-b93b-4adbc7afc3e3', '880191607594121.jpg', NULL, '2020-12-10 09:55:21 am'),
(14, '381e9201-5822-4783-919f-13f83bd6e10b', '2a40ca33-1d95-4143-b93b-4adbc7afc3e3', '321751607594121.jpg', NULL, '2020-12-10 09:55:21 am'),
(15, '381e9201-5822-4783-919f-13f83bd6e10b', '2a40ca33-1d95-4143-b93b-4adbc7afc3e3', '128881607594121.jpg', NULL, '2020-12-10 09:55:21 am'),
(16, '381e9201-5822-4783-919f-13f83bd6e10b', '44999a88-4a13-4862-8d7a-9aec59e93e24', '601251607606086.jpg', NULL, '2020-12-10 01:14:46 pm'),
(17, '381e9201-5822-4783-919f-13f83bd6e10b', '44999a88-4a13-4862-8d7a-9aec59e93e24', '829201607606086.jpg', NULL, '2020-12-10 01:14:46 pm'),
(18, '381e9201-5822-4783-919f-13f83bd6e10b', '44999a88-4a13-4862-8d7a-9aec59e93e24', '352121607606086.jpg', NULL, '2020-12-10 01:14:46 pm'),
(19, '381e9201-5822-4783-919f-13f83bd6e10b', '44999a88-4a13-4862-8d7a-9aec59e93e24', '172351607606086.jpg', NULL, '2020-12-10 01:14:46 pm'),
(20, '381e9201-5822-4783-919f-13f83bd6e10b', '44999a88-4a13-4862-8d7a-9aec59e93e24', '709371607606086.jpg', NULL, '2020-12-10 01:14:46 pm'),
(21, '381e9201-5822-4783-919f-13f83bd6e10b', 'c285a0c8-5a10-4f79-9cb8-413b829d06ea', '439201607606390.jpg', NULL, '2020-12-10 01:19:50 pm'),
(22, '381e9201-5822-4783-919f-13f83bd6e10b', 'c285a0c8-5a10-4f79-9cb8-413b829d06ea', '970551607606390.jpg', NULL, '2020-12-10 01:19:50 pm'),
(23, '381e9201-5822-4783-919f-13f83bd6e10b', 'c285a0c8-5a10-4f79-9cb8-413b829d06ea', '981581607606390.jpg', NULL, '2020-12-10 01:19:50 pm'),
(24, '381e9201-5822-4783-919f-13f83bd6e10b', '60d8e0d1-f070-42ce-b1e7-ecdc2f4756d8', '266611607607008.jpg', NULL, '2020-12-10 01:30:08 pm'),
(25, '381e9201-5822-4783-919f-13f83bd6e10b', '97eafc6d-4ce7-479a-ab78-638e3246c138', '133811607607119.jpg', NULL, '2020-12-10 01:31:59 pm'),
(26, '381e9201-5822-4783-919f-13f83bd6e10b', '97eafc6d-4ce7-479a-ab78-638e3246c138', '216861607607119.jpg', NULL, '2020-12-10 01:31:59 pm'),
(27, '381e9201-5822-4783-919f-13f83bd6e10b', '15d9dd08-4bef-4eba-b745-593411384b9e', '115241607607194.jpg', NULL, '2020-12-10 01:33:14 pm'),
(28, '381e9201-5822-4783-919f-13f83bd6e10b', '15d9dd08-4bef-4eba-b745-593411384b9e', '399971607607194.jpg', NULL, '2020-12-10 01:33:14 pm'),
(29, '381e9201-5822-4783-919f-13f83bd6e10b', '15d9dd08-4bef-4eba-b745-593411384b9e', '226371607607194.jpg', NULL, '2020-12-10 01:33:14 pm'),
(30, '381e9201-5822-4783-919f-13f83bd6e10b', 'ccb134aa-34b0-492e-88e4-992a4d4585d0', '527721607607326.jpg', NULL, '2020-12-10 01:35:26 pm'),
(31, '381e9201-5822-4783-919f-13f83bd6e10b', 'ccb134aa-34b0-492e-88e4-992a4d4585d0', '508601607607326.jpg', NULL, '2020-12-10 01:35:26 pm'),
(32, '381e9201-5822-4783-919f-13f83bd6e10b', 'ec3026b0-2a21-4001-82d3-2e2da5110f94', '398041607607421.jpg', NULL, '2020-12-10 01:37:01 pm'),
(33, '381e9201-5822-4783-919f-13f83bd6e10b', 'ec3026b0-2a21-4001-82d3-2e2da5110f94', '581551607607421.jpg', NULL, '2020-12-10 01:37:01 pm'),
(34, '381e9201-5822-4783-919f-13f83bd6e10b', 'ecadbc2e-4173-4d1d-b6fd-520af4179a9c', '728451607607569.jpg', NULL, '2020-12-10 01:39:29 pm'),
(35, '381e9201-5822-4783-919f-13f83bd6e10b', 'ecadbc2e-4173-4d1d-b6fd-520af4179a9c', '893721607607569.jpg', NULL, '2020-12-10 01:39:29 pm'),
(36, '381e9201-5822-4783-919f-13f83bd6e10b', 'ecadbc2e-4173-4d1d-b6fd-520af4179a9c', '784981607607569.jpg', NULL, '2020-12-10 01:39:29 pm'),
(37, '381e9201-5822-4783-919f-13f83bd6e10b', 'eda86658-901e-4988-9a62-0f100c6a5fc2', '924761607607793.jpg', NULL, '2020-12-10 01:43:13 pm'),
(38, '381e9201-5822-4783-919f-13f83bd6e10b', 'eda86658-901e-4988-9a62-0f100c6a5fc2', '395251607607793.jpg', NULL, '2020-12-10 01:43:13 pm'),
(39, '381e9201-5822-4783-919f-13f83bd6e10b', 'f52a607c-e412-4a82-a66a-052313cf2a67', '486261607607923.jpg', NULL, '2020-12-10 01:45:23 pm'),
(40, '381e9201-5822-4783-919f-13f83bd6e10b', 'f52a607c-e412-4a82-a66a-052313cf2a67', '270631607607923.jpg', NULL, '2020-12-10 01:45:23 pm'),
(41, '381e9201-5822-4783-919f-13f83bd6e10b', 'f52a607c-e412-4a82-a66a-052313cf2a67', '773241607607923.jpg', NULL, '2020-12-10 01:45:23 pm'),
(42, '381e9201-5822-4783-919f-13f83bd6e10b', '1ee3b971-3645-43d0-a13c-1445ef2f7929', '175131607608142.jpg', NULL, '2020-12-10 01:49:02 pm'),
(43, '381e9201-5822-4783-919f-13f83bd6e10b', '4fdd59bb-ba4e-43d0-ae2c-87babe387248', '541421607608267.jpg', NULL, '2020-12-10 01:51:07 pm'),
(44, '381e9201-5822-4783-919f-13f83bd6e10b', '49222450-2ecf-45f3-b7f8-f0631fe622a0', '939671607608467.jpg', NULL, '2020-12-10 01:54:27 pm'),
(45, '381e9201-5822-4783-919f-13f83bd6e10b', '73283bcb-b9e8-4fa1-9c69-023b5cee3f21', '395561607608509.jpg', NULL, '2020-12-10 01:55:09 pm'),
(46, '381e9201-5822-4783-919f-13f83bd6e10b', 'f284c2f9-0227-4513-a172-a6bde56fed07', '982351607608528.jpg', NULL, '2020-12-10 01:55:28 pm'),
(47, '381e9201-5822-4783-919f-13f83bd6e10b', 'fc1aedca-ec54-44b8-ac07-cddd9e6fc9e1', '163651607608965.jpg', NULL, '2020-12-10 02:02:45 pm'),
(48, '381e9201-5822-4783-919f-13f83bd6e10b', 'fc1aedca-ec54-44b8-ac07-cddd9e6fc9e1', '520471607608965.jpg', NULL, '2020-12-10 02:02:45 pm'),
(49, '381e9201-5822-4783-919f-13f83bd6e10b', 'fc1aedca-ec54-44b8-ac07-cddd9e6fc9e1', '599241607608965.jpg', NULL, '2020-12-10 02:02:45 pm'),
(50, '381e9201-5822-4783-919f-13f83bd6e10b', 'fc1aedca-ec54-44b8-ac07-cddd9e6fc9e1', '752731607608965.jpg', NULL, '2020-12-10 02:02:45 pm'),
(51, '381e9201-5822-4783-919f-13f83bd6e10b', 'fc1aedca-ec54-44b8-ac07-cddd9e6fc9e1', '419391607608965.jpg', NULL, '2020-12-10 02:02:45 pm'),
(52, '381e9201-5822-4783-919f-13f83bd6e10b', '91edfe97-023a-4a5f-9952-2409d3a76895', '999321607609187.jpg', NULL, '2020-12-10 02:06:27 pm'),
(53, '381e9201-5822-4783-919f-13f83bd6e10b', '91edfe97-023a-4a5f-9952-2409d3a76895', '144931607609187.jpg', NULL, '2020-12-10 02:06:27 pm'),
(54, '381e9201-5822-4783-919f-13f83bd6e10b', '91edfe97-023a-4a5f-9952-2409d3a76895', '175071607609187.jpg', NULL, '2020-12-10 02:06:27 pm'),
(55, '381e9201-5822-4783-919f-13f83bd6e10b', '3d27f559-8cd0-4674-99bf-20bc30e94b85', '128671607610107.jpg', NULL, '2020-12-10 02:21:47 pm'),
(56, '381e9201-5822-4783-919f-13f83bd6e10b', '3d27f559-8cd0-4674-99bf-20bc30e94b85', '379141607610107.jpg', NULL, '2020-12-10 02:21:47 pm'),
(57, '381e9201-5822-4783-919f-13f83bd6e10b', '3d27f559-8cd0-4674-99bf-20bc30e94b85', '852491607610107.jpg', NULL, '2020-12-10 02:21:47 pm'),
(58, '381e9201-5822-4783-919f-13f83bd6e10b', '3d27f559-8cd0-4674-99bf-20bc30e94b85', '449991607610107.jpg', NULL, '2020-12-10 02:21:47 pm'),
(59, '381e9201-5822-4783-919f-13f83bd6e10b', '0d9c5b68-3ddc-4c29-a13a-e597bcdb8a89', '510841607610677.jpg', NULL, '2020-12-10 02:31:17 pm'),
(60, '381e9201-5822-4783-919f-13f83bd6e10b', '0d9c5b68-3ddc-4c29-a13a-e597bcdb8a89', '578981607610677.jpg', NULL, '2020-12-10 02:31:17 pm'),
(61, '381e9201-5822-4783-919f-13f83bd6e10b', '0d9c5b68-3ddc-4c29-a13a-e597bcdb8a89', '847271607610677.jpg', NULL, '2020-12-10 02:31:17 pm'),
(62, '381e9201-5822-4783-919f-13f83bd6e10b', '0d9c5b68-3ddc-4c29-a13a-e597bcdb8a89', '946021607610677.jpg', NULL, '2020-12-10 02:31:17 pm'),
(63, '381e9201-5822-4783-919f-13f83bd6e10b', '0d9c5b68-3ddc-4c29-a13a-e597bcdb8a89', '983631607610677.jpg', NULL, '2020-12-10 02:31:17 pm'),
(64, '381e9201-5822-4783-919f-13f83bd6e10b', '0d9c5b68-3ddc-4c29-a13a-e597bcdb8a89', '530111607610677.jpg', NULL, '2020-12-10 02:31:17 pm'),
(65, '381e9201-5822-4783-919f-13f83bd6e10b', '0de6de96-f4c1-4811-9961-f8c5ce2a324a', '295181607683816.jpg', NULL, '2020-12-11 10:50:16 am'),
(66, '381e9201-5822-4783-919f-13f83bd6e10b', '0de6de96-f4c1-4811-9961-f8c5ce2a324a', '594681607683816.jpg', NULL, '2020-12-11 10:50:16 am'),
(67, '381e9201-5822-4783-919f-13f83bd6e10b', '33986b9f-d98f-4103-bec2-097b38adebae', '801861607685060.jpg', NULL, '2020-12-11 11:11:00 am'),
(68, '381e9201-5822-4783-919f-13f83bd6e10b', '33986b9f-d98f-4103-bec2-097b38adebae', '317921607685060.jpg', NULL, '2020-12-11 11:11:00 am'),
(69, '381e9201-5822-4783-919f-13f83bd6e10b', '33986b9f-d98f-4103-bec2-097b38adebae', '982281607685060.jpg', NULL, '2020-12-11 11:11:00 am'),
(70, '381e9201-5822-4783-919f-13f83bd6e10b', 'dd6b10c1-9afe-4f20-9d0e-e8e938ff1563', '535281607685711.jpg', NULL, '2020-12-11 11:21:51 am'),
(71, '381e9201-5822-4783-919f-13f83bd6e10b', 'dd6b10c1-9afe-4f20-9d0e-e8e938ff1563', '260471607685712.jpg', NULL, '2020-12-11 11:21:52 am'),
(72, '381e9201-5822-4783-919f-13f83bd6e10b', 'dd6b10c1-9afe-4f20-9d0e-e8e938ff1563', '415051607685712.jpg', NULL, '2020-12-11 11:21:52 am'),
(73, '381e9201-5822-4783-919f-13f83bd6e10b', 'dd6b10c1-9afe-4f20-9d0e-e8e938ff1563', '560961607685712.jpg', NULL, '2020-12-11 11:21:52 am'),
(75, '381e9201-5822-4783-919f-13f83bd6e10b', '8e74ad08-7119-4eb2-a3e3-4f10cb416fb6', '804421607686171.jpg', NULL, '2020-12-11 11:29:31 am'),
(76, '381e9201-5822-4783-919f-13f83bd6e10b', '8e74ad08-7119-4eb2-a3e3-4f10cb416fb6', '803991607686172.jpg', NULL, '2020-12-11 11:29:32 am'),
(77, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', '954351607704502.jpg', NULL, '2020-12-11 04:35:02 pm'),
(78, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', '871891607704503.jpg', NULL, '2020-12-11 04:35:03 pm'),
(79, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', '946021607704503.jpg', NULL, '2020-12-11 04:35:03 pm'),
(80, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', '585411607704503.jpg', NULL, '2020-12-11 04:35:03 pm'),
(81, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', '883091607704503.jpg', NULL, '2020-12-11 04:35:03 pm'),
(82, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', '596851607704503.jpg', NULL, '2020-12-11 04:35:03 pm'),
(83, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', '778531607737146.jpg', NULL, '2020-12-12 01:39:06 am'),
(84, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', '866891607740007.jpg', NULL, '2020-12-12 02:26:47 am'),
(89, '381e9201-5822-4783-919f-13f83bd6e10b', '13089288-2234-4a65-a2d6-77156f9ebfbc', '342091607788817.jpg', NULL, '2020-12-12 04:00:17 pm'),
(88, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', '282851607745646.jpg', 'efef e fefw ef', '2020-12-12 04:00:46 am'),
(90, '381e9201-5822-4783-919f-13f83bd6e10b', '13089288-2234-4a65-a2d6-77156f9ebfbc', '371681607788818.jpg', NULL, '2020-12-12 04:00:18 pm'),
(91, '381e9201-5822-4783-919f-13f83bd6e10b', '13089288-2234-4a65-a2d6-77156f9ebfbc', '147631607788818.jpg', NULL, '2020-12-12 04:00:18 pm'),
(92, '381e9201-5822-4783-919f-13f83bd6e10b', '13089288-2234-4a65-a2d6-77156f9ebfbc', '522881607788819.jpg', NULL, '2020-12-12 04:00:19 pm'),
(93, '381e9201-5822-4783-919f-13f83bd6e10b', '13089288-2234-4a65-a2d6-77156f9ebfbc', '894761607788819.webp', NULL, '2020-12-12 04:00:19 pm'),
(94, '381e9201-5822-4783-919f-13f83bd6e10b', '22f1bdc9-89ed-4e21-9470-fef2ef63b8ca', '176851607955464.jpg', NULL, '2020-12-14 02:17:44 pm'),
(95, '381e9201-5822-4783-919f-13f83bd6e10b', '2dccea5c-1457-4993-8894-6294f2e78b2b', '609041607976750.jpg', 'Nice Curly Hair', '2020-12-14 08:12:30 pm'),
(96, '381e9201-5822-4783-919f-13f83bd6e10b', '73d23754-7656-44f7-8c3e-b8d5204e6cfb', '712911607980430.jpg', NULL, '2020-12-14 09:13:50 pm'),
(97, '381e9201-5822-4783-919f-13f83bd6e10b', '61b56290-9319-4be9-a40f-c6f626c21da4', '729691607980634.jpg', NULL, '2020-12-14 09:17:14 pm'),
(98, '381e9201-5822-4783-919f-13f83bd6e10b', '61b56290-9319-4be9-a40f-c6f626c21da4', '870131607980635.jpg', NULL, '2020-12-14 09:17:15 pm'),
(99, '381e9201-5822-4783-919f-13f83bd6e10b', 'b85b6892-0685-4b34-ad8e-4617628b9872', '457821607980991.jpg', NULL, '2020-12-14 09:23:11 pm'),
(100, '232bbfdd-22aa-4f35-811f-5eae0ecd88d6', 'b47894c8-d76a-4210-996b-8cebac0b5aa3', '861231608563545.png', NULL, '2020-12-21 03:12:25 pm'),
(101, '97821a68-c180-4010-88fb-0748fdd74143', '4d48941f-2f3a-4a89-a4be-e67d7c81422d', '365651608565326.jpg', NULL, '2020-12-21 03:42:06 pm'),
(102, '97821a68-c180-4010-88fb-0748fdd74143', '4d48941f-2f3a-4a89-a4be-e67d7c81422d', '685051608565326.jpg', NULL, '2020-12-21 03:42:06 pm'),
(103, '97821a68-c180-4010-88fb-0748fdd74143', '4d48941f-2f3a-4a89-a4be-e67d7c81422d', '850121608565326.jpg', NULL, '2020-12-21 03:42:06 pm'),
(104, '97821a68-c180-4010-88fb-0748fdd74143', '4d48941f-2f3a-4a89-a4be-e67d7c81422d', '523461608565326.jpg', NULL, '2020-12-21 03:42:06 pm'),
(105, '97821a68-c180-4010-88fb-0748fdd74143', '893d9765-45c3-4323-9183-f057d158f9d5', '482941608762414.jpg', NULL, '2020-12-23 10:26:54 pm'),
(106, '381e9201-5822-4783-919f-13f83bd6e10b', '45a4c320-a09f-4e43-b10d-fac392f71f0a', '424781609335816.png', NULL, '2020-12-30 01:43:36 pm');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

DROP TABLE IF EXISTS `product_size`;
CREATE TABLE IF NOT EXISTS `product_size` (
  `sizeID` int NOT NULL AUTO_INCREMENT,
  `size_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`sizeID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`sizeID`, `size_name`, `size_code`, `status`) VALUES
(1, 'Extra-Extra Large', 'XXL', 1),
(2, 'Extra Large', 'XL', 1),
(3, 'Large', 'L', 1),
(4, 'Medium', 'M', 1),
(5, 'Small', 'S', 1),
(6, 'Extra Small', 'XS', 1),
(7, 'Extra-Extra Small', 'XXS', 1),
(8, 'All Colours', 'All', 0);

-- --------------------------------------------------------

--
-- Table structure for table `store_premium`
--

DROP TABLE IF EXISTS `store_premium`;
CREATE TABLE IF NOT EXISTS `store_premium` (
  `premiumID` int NOT NULL AUTO_INCREMENT,
  `premium_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `premium_days` int DEFAULT '30',
  `price` double DEFAULT '0',
  `currency` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`premiumID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `store_premium`
--

INSERT INTO `store_premium` (`premiumID`, `premium_name`, `premium_days`, `price`, `currency`, `status`) VALUES
(1, 'No Active Premium Plan', 0, 0, 'USD', 1),
(2, 'Super Admin Premium', 30, 0, 'USD', 1),
(3, 'Basic Premium Plan', 30, 15, 'USD', 1),
(4, 'Standard Premium Plan', 30, 25, 'USD', 1),
(5, 'Gold Premium Plan', 30, 50, 'USD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `try_catch_error`
--

DROP TABLE IF EXISTS `try_catch_error`;
CREATE TABLE IF NOT EXISTS `try_catch_error` (
  `errorID` int NOT NULL AUTO_INCREMENT,
  `throwable_error` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `function_module_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solution` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `error_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '0',
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`errorID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_token` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suspended` int NOT NULL DEFAULT '0',
  `last_login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_token`, `username`, `email`, `email_verified_at`, `password`, `suspended`, `last_login`, `current_login`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
('97821a68-c180-4010-88fb-0748fdd74143', 'R64AYVTA0FNBFD3NEO4GSRP77BWGJ6DY8FBQ', 'tossajax', 'tossajax@yahoo.com', NULL, '$2y$10$1XpcO2/yrPTKNws3OM7QUerT7CFGRpnSQVQhHtBLOCd.C9tuAOXL.', 0, NULL, NULL, 1, NULL, '2020-12-21 15:32:13', '2021-01-07 20:30:44'),
('381e9201-5822-4783-919f-13f83bd6e10b', '381e9201-5822-4783-919f-13f83bd6e10b', 'samson', 'samsontopeajax@gmail.com', NULL, '$2y$10$uAPuvqW0C/eYR8Z1WDGgeeEg32YnerrRIAchHgcWRvl1X1mQvoecS', 0, NULL, NULL, 1, NULL, '2020-12-08 22:58:09', '2020-12-08 22:58:09'),
('0beabdff-2416-4c8d-8e14-942fcd1f55fa', 'MZ9OEKTX7ND3XCMP022EFZW6Q9GC0XG4518T', 'user22', 'user2@yahoo.com', NULL, '$2y$10$GEbputCF/AHptn4gqadLduVGzjm47W5KCVNjsWvfSoKz64xXuIqkW', 0, NULL, NULL, 0, NULL, '2021-01-01 18:26:06', '2021-01-01 18:26:06'),
('5ce5039d-7683-4760-8bb6-2ccc4c7410a0', 'DD9GL173OKLI7214LY7VFP5EOZAHWL6GKBDM', 'user11', 'user1@yahoo.com', NULL, '$2y$10$Kz/4CHumZcxB3cf7tlvzaOZ0iInfxwJjD0oMxJAEtFkIFdQHrZCNe', 0, NULL, NULL, 1, NULL, '2021-01-01 18:23:20', '2021-01-01 18:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_product_colour`
--

DROP TABLE IF EXISTS `user_product_colour`;
CREATE TABLE IF NOT EXISTS `user_product_colour` (
  `user_product_colourID` bigint NOT NULL AUTO_INCREMENT,
  `userID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colourID` int DEFAULT NULL,
  PRIMARY KEY (`user_product_colourID`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_product_colour`
--

INSERT INTO `user_product_colour` (`user_product_colourID`, `userID`, `productID`, `colourID`) VALUES
(20, '381e9201-5822-4783-919f-13f83bd6e10b', '13089288-2234-4a65-a2d6-77156f9ebfbc', 6),
(19, '381e9201-5822-4783-919f-13f83bd6e10b', '13089288-2234-4a65-a2d6-77156f9ebfbc', 5),
(18, '381e9201-5822-4783-919f-13f83bd6e10b', '13089288-2234-4a65-a2d6-77156f9ebfbc', 4),
(17, '381e9201-5822-4783-919f-13f83bd6e10b', '13089288-2234-4a65-a2d6-77156f9ebfbc', 3),
(16, '381e9201-5822-4783-919f-13f83bd6e10b', '13089288-2234-4a65-a2d6-77156f9ebfbc', 2),
(15, '381e9201-5822-4783-919f-13f83bd6e10b', '8e74ad08-7119-4eb2-a3e3-4f10cb416fb6', 6),
(14, '381e9201-5822-4783-919f-13f83bd6e10b', 'dd6b10c1-9afe-4f20-9d0e-e8e938ff1563', 12),
(13, '381e9201-5822-4783-919f-13f83bd6e10b', 'dd6b10c1-9afe-4f20-9d0e-e8e938ff1563', 8),
(12, '381e9201-5822-4783-919f-13f83bd6e10b', 'dd6b10c1-9afe-4f20-9d0e-e8e938ff1563', 6),
(21, '381e9201-5822-4783-919f-13f83bd6e10b', '22f1bdc9-89ed-4e21-9470-fef2ef63b8ca', 4),
(22, '381e9201-5822-4783-919f-13f83bd6e10b', '22f1bdc9-89ed-4e21-9470-fef2ef63b8ca', 6),
(30, '381e9201-5822-4783-919f-13f83bd6e10b', '2dccea5c-1457-4993-8894-6294f2e78b2b', 6),
(31, '381e9201-5822-4783-919f-13f83bd6e10b', '73d23754-7656-44f7-8c3e-b8d5204e6cfb', 11),
(32, '381e9201-5822-4783-919f-13f83bd6e10b', '61b56290-9319-4be9-a40f-c6f626c21da4', 6),
(63, '381e9201-5822-4783-919f-13f83bd6e10b', 'b85b6892-0685-4b34-ad8e-4617628b9872', 6),
(59, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 13),
(58, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 12),
(57, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 11),
(56, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 10),
(55, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 9),
(54, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 8),
(53, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 7),
(52, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 6),
(51, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 5),
(50, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 4),
(49, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 3),
(48, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 2),
(47, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 1),
(60, '97821a68-c180-4010-88fb-0748fdd74143', '893d9765-45c3-4323-9183-f057d158f9d5', 2),
(61, '97821a68-c180-4010-88fb-0748fdd74143', '893d9765-45c3-4323-9183-f057d158f9d5', 4),
(62, '381e9201-5822-4783-919f-13f83bd6e10b', '45a4c320-a09f-4e43-b10d-fac392f71f0a', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_product_size`
--

DROP TABLE IF EXISTS `user_product_size`;
CREATE TABLE IF NOT EXISTS `user_product_size` (
  `user_product_sizeID` bigint NOT NULL AUTO_INCREMENT,
  `userID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sizeID` int DEFAULT NULL,
  PRIMARY KEY (`user_product_sizeID`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_product_size`
--

INSERT INTO `user_product_size` (`user_product_sizeID`, `userID`, `productID`, `sizeID`) VALUES
(1, '381e9201-5822-4783-919f-13f83bd6e10b', '22f1bdc9-89ed-4e21-9470-fef2ef63b8ca', 3),
(2, '381e9201-5822-4783-919f-13f83bd6e10b', '22f1bdc9-89ed-4e21-9470-fef2ef63b8ca', 4),
(42, '381e9201-5822-4783-919f-13f83bd6e10b', '2dccea5c-1457-4993-8894-6294f2e78b2b', 6),
(41, '381e9201-5822-4783-919f-13f83bd6e10b', '2dccea5c-1457-4993-8894-6294f2e78b2b', 5),
(40, '381e9201-5822-4783-919f-13f83bd6e10b', '2dccea5c-1457-4993-8894-6294f2e78b2b', 4),
(39, '381e9201-5822-4783-919f-13f83bd6e10b', '2dccea5c-1457-4993-8894-6294f2e78b2b', 3),
(38, '381e9201-5822-4783-919f-13f83bd6e10b', '2dccea5c-1457-4993-8894-6294f2e78b2b', 2),
(43, '381e9201-5822-4783-919f-13f83bd6e10b', '73d23754-7656-44f7-8c3e-b8d5204e6cfb', 4),
(44, '381e9201-5822-4783-919f-13f83bd6e10b', '61b56290-9319-4be9-a40f-c6f626c21da4', 4),
(67, '381e9201-5822-4783-919f-13f83bd6e10b', 'b85b6892-0685-4b34-ad8e-4617628b9872', 5),
(66, '381e9201-5822-4783-919f-13f83bd6e10b', 'b85b6892-0685-4b34-ad8e-4617628b9872', 4),
(65, '381e9201-5822-4783-919f-13f83bd6e10b', 'b85b6892-0685-4b34-ad8e-4617628b9872', 3),
(61, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 7),
(60, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 6),
(59, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 5),
(58, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 4),
(57, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 3),
(56, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 2),
(55, '381e9201-5822-4783-919f-13f83bd6e10b', '88275bd5-76b7-4370-b518-6132795540d4', 1),
(62, '97821a68-c180-4010-88fb-0748fdd74143', '893d9765-45c3-4323-9183-f057d158f9d5', 4),
(63, '381e9201-5822-4783-919f-13f83bd6e10b', '45a4c320-a09f-4e43-b10d-fac392f71f0a', 4),
(64, '381e9201-5822-4783-919f-13f83bd6e10b', '45a4c320-a09f-4e43-b10d-fac392f71f0a', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE IF NOT EXISTS `user_profile` (
  `user_profileID` bigint NOT NULL AUTO_INCREMENT,
  `userID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storeID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_typeID` int DEFAULT NULL,
  `currencyID` int DEFAULT NULL,
  `is_store_suspended` int DEFAULT '1',
  `store_country` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_state` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_city` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_latitude` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_logtitude` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_zip_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_ip_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_address1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `store_address2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `delivery_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `store_phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `store_logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `store_advert_banner` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `how_did_you_know_about_usID` int DEFAULT NULL,
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `store_premium` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_profileID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`user_profileID`, `userID`, `first_name`, `last_name`, `gender`, `profile_picture`, `phone_number`, `storeID`, `user_typeID`, `currencyID`, `is_store_suspended`, `store_country`, `store_state`, `store_city`, `store_latitude`, `store_logtitude`, `store_zip_code`, `store_ip_address`, `store_name`, `store_address1`, `store_address2`, `delivery_address`, `store_phone_number`, `store_description`, `store_logo`, `store_advert_banner`, `how_did_you_know_about_usID`, `created_at`, `updated_at`, `status`, `store_premium`) VALUES
(1, '381e9201-5822-4783-919f-13f83bd6e10b', 'Samson', 'Ajax', 'Male', '934331609550498.jpg', '07034320265', 'GHYUJIKJ7TDE4E4', 2, 3, 0, 'NG', 'FCT', 'Abuja', NULL, NULL, '12345', NULL, 'Ajax Store Glamour', 'Lugbe Abuja', 'Lugbe Abuja', '23, Behind Amac Market, Lugbe, Abuja.', '07034320265', 'We are open for business', '915131609560966.gif', '385031609882362.jpg', NULL, NULL, '2021-01-07', 1, 1),
(4, '97821a68-c180-4010-88fb-0748fdd74143', 'Toss', 'Ajax', 'Male', NULL, '07034320256', 'HMNKH57DS4RE', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, '12345', NULL, 'Toss Ajax Tech', 'Area 11, Abuja', NULL, '48B, Challenge Stree, Kubua, Abuja', '08037483724', 'I sell supermart stuff', NULL, NULL, NULL, NULL, '2021-01-07', 1, 1),
(7, '0beabdff-2416-4c8d-8e14-942fcd1f55fa', 'user2', 'user2', 'Male', NULL, '8092379882', 'UFIA0XGNUO5C819', 2, 3, 1, 'NG', 'FCT', 'Abuja', NULL, NULL, '12345', NULL, 'user22 store', 'user 22 Lugbe Abuja', NULL, NULL, '08394845545', 'i sell a  lot of bags and shoes', NULL, NULL, NULL, NULL, NULL, 1, 1),
(6, '5ce5039d-7683-4760-8bb6-2ccc4c7410a0', 'user1', 'user1', 'Male', NULL, '08032379883', NULL, 3, 3, 1, 'NG', NULL, NULL, NULL, NULL, '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `user_typeID` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_store` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`user_typeID`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_typeID`, `type_name`, `is_store`, `status`, `updated_at`) VALUES
(1, 'Sell Products Only(Own a store)', 1, 1, '2020-12-08'),
(2, 'Sell and Buy Products(Own a Store)', 1, 1, NULL),
(3, 'Buy Products Only', 0, 1, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
