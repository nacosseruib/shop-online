-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 28, 2021 at 11:17 AM
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
-- Table structure for table `agent_id_card`
--

DROP TABLE IF EXISTS `agent_id_card`;
CREATE TABLE IF NOT EXISTS `agent_id_card` (
  `agent_id_cardID` bigint NOT NULL AUTO_INCREMENT,
  `userID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agentID` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`agent_id_cardID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `agent_id_card`
--

INSERT INTO `agent_id_card` (`agent_id_cardID`, `userID`, `agentID`, `file_name`, `created_at`, `approved`) VALUES
(1, '381e9201-5822-4783-919f-13f83bd6e10b', 'b4fef03e-cbd6-432e-8e01-a4f19dc253c6', '941681611419372.jpg', '2021-01-23 04:29:32 pm', 0),
(2, '381e9201-5822-4783-919f-13f83bd6e10b', 'b4fef03e-cbd6-432e-8e01-a4f19dc253c6', '402571611419372.jpg', '2021-01-23 04:29:32 pm', 1),
(3, '381e9201-5822-4783-919f-13f83bd6e10b', 'b4fef03e-cbd6-432e-8e01-a4f19dc253c6', '759781611419427.jpg', '2021-01-23 04:30:27 pm', 0),
(4, '5ce5039d-7683-4760-8bb6-2ccc4c7410a0', '7371bcf6-0093-44dd-888f-92047491cee1', '120251611441571.png', '2021-01-23 10:39:31 pm', 0),
(5, '0beabdff-2416-4c8d-8e14-942fcd1f55fa', '83a615c9-29f8-4057-9660-f64ec03ee5e1', '919111611563850.png', '2021-01-25 08:37:30 am', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
