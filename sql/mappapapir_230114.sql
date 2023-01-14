-- phpMyAdmin SQL Dump
-- version 5.1.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 14, 2023 at 10:51 AM
-- Server version: 8.0.31-0ubuntu2
-- PHP Version: 8.1.7-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mappapapir`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `uid` int NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `pid`, `uid`, `added`) VALUES
(5, 2, 1, '2022-10-11 07:29:34'),
(9, 2, 8, '2022-10-12 07:15:28'),
(11, 3, 8, '2022-10-13 08:56:05'),
(12, 59, 10, '2022-10-18 07:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `pid` int NOT NULL,
  `quantity` int NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `uid`, `pid`, `quantity`, `added`) VALUES
(32, 1, 66, 2, '2022-09-26 06:22:15'),
(35, 1, 61, 2, '2022-09-28 07:33:36'),
(36, 1, 5, 1, '2022-09-28 08:29:30'),
(41, 1, 2, 1, '2022-10-10 06:44:36'),
(53, 8, 2, 1, '2022-10-13 09:23:47'),
(58, 10, 1, 5, '2022-10-18 06:50:15'),
(59, 10, 2, 3, '2022-10-18 06:50:16'),
(65, 1, 82, 1, '2022-12-12 09:52:05'),
(66, 1, 1, 6, '2022-12-31 10:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `phone` int NOT NULL,
  `fax` int NOT NULL,
  `theme` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL DEFAULT 'auto',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fullname`, `email`, `password`, `phone`, `fax`, `theme`, `date`) VALUES
(1, 'Aszity Martin', 'martinaszity@icloud.com', '$2y$10$gJFV872qGobbfmJOusgIee.8PXlX0WLYDWsTELKOV1Q8gL6A54MLC', 302547895, 123456789, 'light', '2022-02-15 14:39:49'),
(8, 'Minta Misi', 'mintamisi@email.com', '$2y$10$U/gV9fAbjayNnzNKt7WVruVCFynwv4S7bhiF.BFHJTzVZDkMduWPi', 309876543, 123456789, 'light', '2022-06-20 18:53:28'),
(9, 'Pesti Bela', 'kovacsjani@email.com', '$2y$10$PYIkXT6ACwm/3PgLYXMVuu1DZ6zWoPW9ygNii3yQ1FYpawwCWh78i', 301234567, 123456789, 'light', '2022-07-30 08:31:49'),
(10, 'Gemesi Fanni', 'gemesifanni@gmail.com', '$2y$10$xc/Iph/BymaaLlJR4pZzde7XcLwuxOr.vU8rswiEGrbYsPQW0KGkK', 302547895, 123456789, 'dark', '2022-10-18 06:48:35'),
(11, 'Gemesi Andrea', 'gemesiandrea@gmai.com', '$2y$10$JKHv8hwcJZNKOHcVUUytYeHLCLgnlsIJosS5mkfCoUS94HnGXVGM.', 302548795, 123456789, 'auto', '2022-10-24 07:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `customers__card`
--

CREATE TABLE `customers__card` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `cid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `cardname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `cardnum` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `expiry` date NOT NULL,
  `cvc` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `value` int NOT NULL DEFAULT '30000',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__card`
--

INSERT INTO `customers__card` (`id`, `uid`, `cid`, `cardname`, `cardnum`, `expiry`, `cvc`, `value`, `date`) VALUES
(67, 10, '23256745cbbe12ddd8', 'Mappa+ kártya', '9644', '2025-10-18', '512', 30000, '2022-10-18 06:48:35'),
(70, 11, '232567e9d192a7d5f9', 'Mappa+ kártya', '9904', '2025-10-24', '201', 30000, '2022-10-24 07:19:50'),
(3, 1, '4325df90sdf8', 'Mappa+ kártya', '6249', '2025-06-01', '961', 7220000, '2022-06-14 12:43:40'),
(63, 8, '4576c72455f5ca96c1', 'PayPal', '2026', '2022-06-30', '158', 30000, '2022-06-23 16:35:25'),
(65, 9, '5475676b75e356c5c5', 'Mappa+ kártya', '6195', '2025-07-30', '493', 28500, '2022-07-30 08:31:49'),
(8, 1, '68435fca8a1e', 'PayPal', '9343', '2024-06-22', '784', 30000, '2022-06-22 07:56:43'),
(68, 10, '7344672cf5e330a285', 'Visa', '6484', '2022-10-31', '915', 30000, '2022-10-23 08:10:43'),
(66, 8, '7344677330c559ab45', 'Mastercard', '1234', '2022-10-25', '123', 30000, '2022-10-17 08:19:35'),
(27, 8, 'd1445037c37e', 'Mappa+ kártya', '1473', '2022-06-29', '637', 100000, '2022-06-22 19:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `customers__card__deleted`
--

CREATE TABLE `customers__card__deleted` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `cid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__card__deleted`
--

INSERT INTO `customers__card__deleted` (`id`, `uid`, `cid`, `date`) VALUES
(5, 8, '4576c7159705430734', '2022-06-23 17:26:37'),
(7, 1, '734467a51a8c6a4bbf', '2022-06-24 19:41:20'),
(8, 10, '734467122845979a4e', '2022-10-24 08:43:49'),
(9, 11, '1584e3e850f99f9b56', '2022-10-24 08:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `customers__card__info`
--

CREATE TABLE `customers__card__info` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `cid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `number` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `holder` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__card__info`
--

INSERT INTO `customers__card__info` (`id`, `uid`, `cid`, `number`, `holder`, `type`, `provider`, `date`) VALUES
(1, 1, '4325df90sdf8', '1235140830146249', 'Ásztiy Martin', 'Virtuális kártya', 'Mappa Papír Kft.', '2022-06-14 12:53:36'),
(8, 1, '68435fca8a1e', '8324994472389343', 'Ászity Martin', 'PayPal virtuális kártya', 'PayPal Inc.', '2022-06-22 07:56:43'),
(27, 8, 'd1445037c37e', '9613595646741473', 'Minta Misi', 'Virtuális kártya', 'Mappa Papír Kft.', '2022-06-22 19:15:54'),
(63, 8, '4576c72455f5ca96c1', '1991383549622026', 'Minta Misike', 'PayPal virtuális kártya', 'PayPal Inc.', '2022-06-23 16:35:25'),
(65, 9, '5475676b75e356c5c5', '9912255750416195', 'Pesti Bela', 'Virtuális kártya', 'Mappa Papír Kft.', '2022-07-30 08:31:49'),
(66, 8, '7344677330c559ab45', '1234123412341234', 'Minta Misi', 'Mastercard kredit kártya', 'Mastercard Inc.', '2022-10-17 08:19:35'),
(67, 10, '23256745cbbe12ddd8', '8045321862249644', 'Gemesi Fanni', 'Virtuális kártya', 'Mappa Papír Kft.', '2022-10-18 06:48:35'),
(68, 10, '7344672cf5e330a285', '4818362348996484', 'Gémesi Fanni', 'PayPal virtuális kártya', 'PayPal Inc.', '2022-10-23 08:10:43'),
(70, 11, '232567e9d192a7d5f9', '7899307218349904', 'Gemesi Andrea', 'Virtuális kártya', 'Mappa Papír Kft.', '2022-10-24 07:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `customers__card__primary`
--

CREATE TABLE `customers__card__primary` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `cid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__card__primary`
--

INSERT INTO `customers__card__primary` (`id`, `uid`, `cid`, `date`) VALUES
(45, 8, 'd1445037c37e', '2022-06-23 17:26:53'),
(47, 9, '5475676b75e356c5c5', '2022-07-30 08:31:49'),
(50, 1, '4325df90sdf8', '2022-10-24 08:42:09'),
(51, 10, '23256745cbbe12ddd8', '2022-10-24 08:43:49'),
(52, 11, '232567e9d192a7d5f9', '2022-10-24 08:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `customers__card__subscription`
--

CREATE TABLE `customers__card__subscription` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `sub` int NOT NULL DEFAULT '1',
  `price` int NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__card__subscription`
--

INSERT INTO `customers__card__subscription` (`id`, `uid`, `sub`, `price`, `date`) VALUES
(1, 1, 3, 5000, '2022-09-25 14:14:56'),
(2, 8, 3, 5000, '2022-06-23 15:55:10'),
(3, 9, 1, 0, '2022-07-30 08:31:49'),
(4, 10, 1, 0, '2022-10-18 06:48:35'),
(5, 11, 1, 0, '2022-10-24 07:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `customers__deactivated`
--

CREATE TABLE `customers__deactivated` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers__deleted`
--

CREATE TABLE `customers__deleted` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers__header`
--

CREATE TABLE `customers__header` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `initials` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `color` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__header`
--

INSERT INTO `customers__header` (`id`, `uid`, `initials`, `color`) VALUES
(1, 1, 'AM', '1abc9c'),
(2, 8, 'MM', '9b59b6'),
(3, 9, 'PB', '34495e'),
(4, 10, 'GF', '6ace27'),
(5, 11, 'GA', '6ace27');

-- --------------------------------------------------------

--
-- Table structure for table `customers__inv`
--

CREATE TABLE `customers__inv` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `settlement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `postal` int NOT NULL,
  `tax` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__inv`
--

INSERT INTO `customers__inv` (`id`, `uid`, `company`, `settlement`, `address`, `postal`, `tax`, `date`) VALUES
(1, 1, 'Minta Kft', 'Kecskemét', 'Minta utca 3', 6050, 123456789, '2022-02-15 14:39:49'),
(3, 8, 'Minta Kft', 'Kiskunhalas', 'Minta utca 3', 6400, 123456789, '2022-06-20 18:53:28'),
(4, 9, 'Minta Kft', 'Kiskunhalas', 'Minta utca 3', 6400, 123456789, '2022-07-30 08:31:49'),
(5, 10, 'Minta Kft', 'Kecskemét', 'Minta utca 3', 6000, 123456789, '2022-10-18 06:48:35'),
(6, 11, 'Minta KFT', 'Kecskemét', 'Minta utca 3', 6000, 123456789, '2022-10-24 07:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `customers__lang`
--

CREATE TABLE `customers__lang` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `language` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL DEFAULT 'hu',
  `capital` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL DEFAULT 'Budapest',
  `offset` int NOT NULL DEFAULT '7200',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__lang`
--

INSERT INTO `customers__lang` (`id`, `uid`, `language`, `capital`, `offset`, `date`) VALUES
(1, 1, 'hu', 'Budapest', 7200, '2022-02-15 14:39:49'),
(3, 8, 'hu', 'Budapest', 7200, '2022-06-20 18:53:28'),
(4, 9, 'hu', 'Budapest', 7200, '2022-07-30 08:31:49'),
(5, 10, 'hu', 'Budapest', 7200, '2022-10-18 06:48:35'),
(6, 11, 'hu', 'Budapest', 7200, '2022-10-24 07:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `customers__money`
--

CREATE TABLE `customers__money` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `money` int NOT NULL DEFAULT '100000',
  `currency` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL DEFAULT 'HUF',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__money`
--

INSERT INTO `customers__money` (`id`, `uid`, `money`, `currency`, `date`) VALUES
(1, 1, 10000000, 'HUF', '2022-02-15 14:39:49'),
(3, 8, 100000, 'HUF', '2022-06-20 18:53:28'),
(4, 9, 100000, 'HUF', '2022-07-30 08:31:49'),
(5, 10, 100000, 'HUF', '2022-10-18 06:48:35'),
(6, 11, 100000, 'HUF', '2022-10-24 07:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `customers__priv`
--

CREATE TABLE `customers__priv` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `privilege` int NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__priv`
--

INSERT INTO `customers__priv` (`id`, `uid`, `privilege`, `date`) VALUES
(1, 1, 2, '2022-02-15 14:39:49'),
(3, 8, 1, '2022-06-20 18:53:28'),
(4, 9, 0, '2022-07-30 08:31:49'),
(5, 10, 0, '2022-10-18 06:48:35'),
(6, 11, 0, '2022-10-24 07:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `customers__ship`
--

CREATE TABLE `customers__ship` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `settlement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `postal` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__ship`
--

INSERT INTO `customers__ship` (`id`, `uid`, `settlement`, `address`, `postal`, `date`) VALUES
(1, 1, 'Kecskemét', 'Minta utca 3', 6000, '2022-02-15 14:39:49'),
(3, 8, 'Kiskunhalas', 'Minta Utca 11', 6400, '2022-06-20 18:53:28'),
(4, 9, 'Kecskemet', 'Minta utca 11', 6000, '2022-07-30 08:31:49'),
(5, 10, 'Kecskemét', 'Minta utca 3', 6000, '2022-10-18 06:48:35'),
(6, 11, 'Kecskemét', 'Minta utca 9', 6000, '2022-10-24 07:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `customers__subpay__pool`
--

CREATE TABLE `customers__subpay__pool` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `cid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `sid` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__subpay__pool`
--

INSERT INTO `customers__subpay__pool` (`id`, `uid`, `cid`, `sid`, `date`) VALUES
(1, 1, '4325df90sdf8', 2, '2022-05-27 13:22:25'),
(2, 8, 'd1445037c37e', 2, '2022-05-23 15:55:10'),
(3, 11, '232567e9d192a7d5f9', 1, '2022-10-26 07:52:00'),
(4, 9, '5475676b75e356c5c5', 1, '2022-10-26 07:55:22');

-- --------------------------------------------------------

--
-- Table structure for table `customers__subscription__data`
--

CREATE TABLE `customers__subscription__data` (
  `id` int NOT NULL,
  `type` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__subscription__data`
--

INSERT INTO `customers__subscription__data` (`id`, `type`, `price`) VALUES
(1, 'free', 0),
(2, 'loyal', 1500),
(3, 'enterprise', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `customers__subscription__payment`
--

CREATE TABLE `customers__subscription__payment` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `cid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__subscription__payment`
--

INSERT INTO `customers__subscription__payment` (`id`, `uid`, `cid`, `date`) VALUES
(1, 1, '4325df90sdf8', '2022-06-27 08:20:45'),
(2, 8, 'd1445037c37e', '2022-10-25 07:19:43'),
(3, 11, '232567e9d192a7d5f9', '2022-10-26 07:52:00'),
(4, 9, '5475676b75e356c5c5', '2022-10-26 07:55:22');

-- --------------------------------------------------------

--
-- Table structure for table `customers__token`
--

CREATE TABLE `customers__token` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `token` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `expiry` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__token`
--

INSERT INTO `customers__token` (`id`, `uid`, `token`, `agent`, `expiry`, `date`) VALUES
(1, 1, '06073fa73e12475a13687967ba8f39137411ffad12cb9de5fb48bfaf82ac7f4c', 'Chrome:102.0.0.0:Linux', 1687207017, '2022-06-19 20:36:57'),
(3, 8, '73060848936c54c5caa4f58870f58f82b9ff3ec88ae4a729b3b86c371fefeea5', 'Chrome:102.0.0.0:Linux', 1687287226, '2022-06-20 18:53:46'),
(4, 8, '73060848936c54c5caa4f58870f58f82b9ff3ec88ae4a729b3b86c371fefeea5', 'Chrome:102.0.0.0:Linux', 1687288151, '2022-06-20 19:09:11'),
(5, 1, '096e325c0ded5ee65a12f9edb33cc360762cd41321d8c0e8e8d6ece8443b4fd7', 'Chrome:102.0.0.0:Linux', 1687288194, '2022-06-20 19:09:54'),
(6, 8, '73060848936c54c5caa4f58870f58f82b9ff3ec88ae4a729b3b86c371fefeea5', 'Chrome:102.0.0.0:Linux', 1687288609, '2022-06-20 19:16:49'),
(7, 8, '73060848936c54c5caa4f58870f58f82b9ff3ec88ae4a729b3b86c371fefeea5', 'Chrome:102.0.0.0:Linux', 1687288683, '2022-06-20 19:18:03'),
(8, 8, '73060848936c54c5caa4f58870f58f82b9ff3ec88ae4a729b3b86c371fefeea5', 'Chrome:102.0.0.0:Linux', 1687288977, '2022-06-20 19:22:57'),
(9, 8, '73060848936c54c5caa4f58870f58f82b9ff3ec88ae4a729b3b86c371fefeea5', 'Chrome:102.0.0.0:Linux', 1687289069, '2022-06-20 19:24:29'),
(10, 8, '73060848936c54c5caa4f58870f58f82b9ff3ec88ae4a729b3b86c371fefeea5', 'Chrome:102.0.0.0:Linux', 1687289364, '2022-06-20 19:29:24'),
(11, 1, '69f0c5b7eaed31783e8b2cd7dcfe371e0179859eeaae00ee7d28c866a0f0f0cd', 'Chrome:102.0.0.0:Linux', 1687303442, '2022-06-20 23:24:02'),
(12, 1, '21c9d7b522db38b0303fadcc493af8d48c659f187355bd86a83dd27e3e00db3b', 'Chrome:102.0.0.0:Linux', 1687435869, '2022-06-22 12:11:09'),
(13, 8, '974565c469d905168680527a8c1183b2dba6d0353ba4b00b8cb3e0d6a7ae7e05', 'Chrome:102.0.0.0:Linux', 1687436086, '2022-06-22 12:14:46'),
(14, 8, '974565c469d905168680527a8c1183b2dba6d0353ba4b00b8cb3e0d6a7ae7e05', 'Chrome:102.0.0.0:Linux', 1687443092, '2022-06-22 14:11:32'),
(15, 1, '21c9d7b522db38b0303fadcc493af8d48c659f187355bd86a83dd27e3e00db3b', 'Chrome:102.0.0.0:Linux', 1687466934, '2022-06-22 20:48:54'),
(16, 1, '21c9d7b522db38b0303fadcc493af8d48c659f187355bd86a83dd27e3e00db3b', 'Chrome:102.0.0.0:Linux', 1687466969, '2022-06-22 20:49:29'),
(17, 1, 'e3d98659e7d8ef8da8a66785d20415a8fba26d6008bb837859678890efc042da', 'Chrome:102.0.0.0:Linux', 1687511898, '2022-06-23 09:18:18'),
(18, 1, 'e3d98659e7d8ef8da8a66785d20415a8fba26d6008bb837859678890efc042da', 'Chrome:102.0.0.0:Linux', 1687515190, '2022-06-23 10:13:10'),
(19, 8, '524abd84047f6d61fdfcb372c14212ce69543a088e0fa11d5c18e54f23da7f95', 'Chrome:102.0.0.0:Linux', 1687608950, '2022-06-24 12:15:50'),
(20, 1, '9b40a08699f3b30b63a45261a580a6ec2bee802fc3017b7f65da2e3db2b8da19', 'Chrome:102.0.0.0:Linux', 1687613338, '2022-06-24 13:28:58'),
(21, 8, '2bca8699bde6ea3e9efe62233f0d860383101ded102d29b7b9de2d186ccb1ffd', 'Chrome:103.0.0.0:Linux', 1687779037, '2022-06-26 11:30:37'),
(22, 9, '4942501c5c1d968bf94e5291a34a9c66229ecf9347fde29917fc77f6aba810e8', 'Safari:15.5:Mac', 1691250217, '2022-08-05 15:43:37'),
(23, 1, '23ad15a455b27ebc5ec1ab3194bf57e582703a5b7148edd1439e1d586473c8e6', 'Chrome:104.0.0.0:Linux', 1691251178, '2022-08-05 15:59:38'),
(24, 9, '4942501c5c1d968bf94e5291a34a9c66229ecf9347fde29917fc77f6aba810e8', 'Chrome:104.0.0.0:Linux', 1691254183, '2022-08-05 16:49:43'),
(25, 8, '69548005c553ffb6434b49cf644b95ec5c36e56d35b88eb2615062d4a2c1d215', 'Chrome:104.0.0.0:Linux', 1691316380, '2022-08-06 10:06:20'),
(26, 1, 'fcef995ab6f072067d18e7a44450151f365ed51156d508d6ec47d2bc27fe5fa5', 'Chrome:104.0.0.0:Linux', 1691316792, '2022-08-06 10:13:12'),
(27, 8, '69548005c553ffb6434b49cf644b95ec5c36e56d35b88eb2615062d4a2c1d215', 'Chrome:104.0.0.0:Linux', 1691316824, '2022-08-06 10:13:44'),
(28, 1, 'fcef995ab6f072067d18e7a44450151f365ed51156d508d6ec47d2bc27fe5fa5', 'Chrome:104.0.0.0:Linux', 1691317300, '2022-08-06 10:21:40'),
(29, 8, '69548005c553ffb6434b49cf644b95ec5c36e56d35b88eb2615062d4a2c1d215', 'Chrome:104.0.0.0:Linux', 1691322247, '2022-08-06 11:44:07'),
(30, 9, 'ab9e18834de471d552f28e4a2568b8d1c04163175e53da2b28246e49d48a6407', 'Chrome:104.0.0.0:Linux', 1691336217, '2022-08-06 15:36:57'),
(31, 1, 'bcb00d678db9e633efa185196035add8dc655a21203fbeb77d3af5d5bc87a7f5', 'Chrome:104.0.0.0:Linux', 1691424147, '2022-08-07 16:02:27'),
(32, 1, 'bcb00d678db9e633efa185196035add8dc655a21203fbeb77d3af5d5bc87a7f5', 'Chrome:104.0.0.0:Linux', 1691424760, '2022-08-07 16:12:40'),
(33, 9, '617aa4ce6be80217bd7ae575c3f53f2aa909e0d399e62bc9f92b447ee64b2153', 'Chrome:104.0.0.0:Linux', 1691424938, '2022-08-07 16:15:38'),
(34, 1, 'e3df88d517125433be267bbdc39e8d7084ecfa68d57d0a80c477a259f0cf9e63', 'Chrome:104.0.0.0:Linux', 1691487465, '2022-08-08 09:37:45'),
(35, 10, 'd7d84465a89ab19d63cf432d1430bedb3df2c62ebfedabe121777de7fc01b8fa', 'Chrome:106.0.0.0:Windows', 1697611752, '2022-10-18 06:49:12'),
(36, 10, 'd7d84465a89ab19d63cf432d1430bedb3df2c62ebfedabe121777de7fc01b8fa', 'Chrome:106.0.0.0:Windows', 1697613063, '2022-10-18 07:11:03'),
(37, 1, 'a18a0c37635cdfa7bac79048ffbb24b2e440b336fdf2c59e7e8abe09b086a850', 'Chrome:106.0.0.0:Linux', 1698130930, '2022-10-24 07:02:10'),
(38, 1, 'a18a0c37635cdfa7bac79048ffbb24b2e440b336fdf2c59e7e8abe09b086a850', 'Chrome:106.0.0.0:Linux', 1698131236, '2022-10-24 07:07:16'),
(39, 10, '9f749c6d2762b42b4a5143e869d57bf2231ab71667c24207829ae489ce768123', 'Chrome:106.0.0.0:Windows', 1698131662, '2022-10-24 07:14:22'),
(40, 10, '9f749c6d2762b42b4a5143e869d57bf2231ab71667c24207829ae489ce768123', 'Chrome:106.0.0.0:Windows', 1698132288, '2022-10-24 07:24:48'),
(41, 11, 'ce09bb93f06adf85aa9eb2dde5e0a3f59d4f8eed449d431d893d04a47cd2e049', 'Chrome:106.0.0.0:Windows', 1698136688, '2022-10-24 08:38:08'),
(42, 1, '4f14b247d4dea634b623bc6cb9dd2327cdeec147e7dd1875374be1678cdb43ca', 'Chrome:107.0.0.0:Linux', 1698334785, '2022-10-26 15:39:45'),
(43, 8, 'a686a18ab330dc9ef2643ee510b46270fab0384948f499a1bc1f5021ef55a2a4', 'Chrome:107.0.0.0:Linux', 1698396386, '2022-10-27 08:46:26'),
(44, 1, '940d94763ff1414c5af5dd7a25366ba062182cdc0a7caf2c99520c482e9ab257', 'Chrome:107.0.0.0:Linux', 1700549028, '2022-11-21 06:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `customers__transactions`
--

CREATE TABLE `customers__transactions` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `cid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `item` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `price` int NOT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `note` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__transactions`
--

INSERT INTO `customers__transactions` (`id`, `uid`, `cid`, `item`, `price`, `type`, `note`, `date`) VALUES
(1, 1, '4325df90sdf8', 'su_2', 1500, 0, 'csomagra való feliratkozás', '2022-06-27 13:22:25'),
(3, 1, '68435fca8a1e', 'pr_1', 10870, 0, 'termék megvásárlása', '2022-06-27 16:00:00'),
(4, 1, '4325df90sdf8', 'su_3', 4550, 0, 'csomagra való feliratkozás', '2022-07-01 17:35:18'),
(5, 1, '4325df90sdf8', 'su_2', 1050, 0, 'csomagra való feliratkozás', '2022-07-01 17:35:37'),
(6, 1, '4325df90sdf8', 'su_3', 4550, 0, 'csomagra való feliratkozás', '2022-07-01 17:39:00'),
(7, 1, '4325df90sdf8', 'su_2', 1050, 0, 'csomagra való feliratkozás', '2022-07-01 17:39:12'),
(8, 1, '4325df90sdf8', 'su_2', 1500, 0, 'csomagra való feliratkozás', '2022-07-01 17:39:52'),
(9, 1, '4325df90sdf8', 'su_2', 1500, 0, 'csomagra való feliratkozás', '2022-07-01 17:42:47'),
(10, 1, '4325df90sdf8', 'su_2', 1500, 0, 'csomagra való feliratkozás', '2022-07-01 19:07:20'),
(11, 1, '4325df90sdf8', 'su_2', 1500, 0, 'csomagra való feliratkozás', '2022-09-22 09:30:36'),
(12, 1, '4325df90sdf8', 'su_3', 4550, 0, 'csomagra való feliratkozás', '2022-09-22 14:32:16'),
(13, 1, '4325df90sdf8', 'su_3', 4550, 0, 'csomagra való feliratkozás', '2022-09-25 14:14:56'),
(14, 8, 'd1445037c37e', 'su_2', 1500, 0, 'csomagra való feliratkozás', '2022-10-25 07:19:43'),
(15, 8, 'd1445037c37e', 'su_3', 5000, 0, 'csomagra való feliratkozás', '2022-10-26 07:37:01'),
(16, 8, 'd1445037c37e', 'su_2', 1500, 0, 'csomagra való feliratkozás', '2022-10-26 07:37:34'),
(17, 8, 'd1445037c37e', 'su_1', 0, 0, 'csomagra való feliratkozás', '2022-10-26 07:38:08'),
(18, 8, 'd1445037c37e', 'su_2', 1500, 0, 'csomagra való feliratkozás', '2022-10-26 07:38:18'),
(19, 8, 'd1445037c37e', 'su_3', 5000, 0, 'csomagra való feliratkozás', '2022-10-26 07:39:05'),
(20, 8, 'd1445037c37e', 'su_2', 1500, 0, 'csomagra való feliratkozás', '2022-10-26 07:39:28'),
(21, 8, 'd1445037c37e', 'su_3', 5000, 0, 'csomagra való feliratkozás', '2022-10-26 07:42:38'),
(22, 11, '232567e9d192a7d5f9', 'su_3', 5000, 0, 'csomagra való feliratkozás', '2022-10-26 07:52:00'),
(23, 11, '232567e9d192a7d5f9', 'su_2', 1500, 0, 'csomagra való feliratkozás', '2022-10-26 07:52:37'),
(24, 11, '232567e9d192a7d5f9', 'su_1', 0, 0, 'csomagra való feliratkozás', '2022-10-26 07:52:56'),
(25, 11, '232567e9d192a7d5f9', 'su_2', 1500, 0, 'csomagra való feliratkozás', '2022-10-26 07:54:23'),
(26, 11, '232567e9d192a7d5f9', 'su_3', 5000, 0, 'csomagra való feliratkozás', '2022-10-26 07:54:49'),
(27, 11, '232567e9d192a7d5f9', 'su_1', 0, 0, 'csomagra való feliratkozás', '2022-10-26 07:55:10'),
(28, 9, '5475676b75e356c5c5', 'su_2', 1500, 0, 'csomagra való feliratkozás', '2022-10-26 07:55:22'),
(29, 9, '5475676b75e356c5c5', 'su_1', 0, 0, 'csomagra való feliratkozás', '2022-10-26 07:55:48'),
(30, 10, '23256745cbbe12ddd8', 'cr_1', 1500, 1, 'Teszt jovairas a funkcip kiprobalasahoz', '2022-11-03 09:55:51'),
(31, 10, '23256745cbbe12ddd8', 'cr_1', 1500, 1, '1500 forint jóváírása az okozott károk miatt', '2022-11-03 09:58:03'),
(32, 10, '23256745cbbe12ddd8', 'cr_1', 1500, 1, 'Teszt jóváírás a tesztelés érdekében', '2022-11-03 09:58:39'),
(33, 9, '5475676b75e356c5c5', 'cr_0', 1500, 0, 'Egyenleg levonasa funkcio kiprobalasa teszt jelleggel', '2022-11-07 07:21:10'),
(34, 10, '23256745cbbe12ddd8', 'cr_0', 6000, 0, 'Teszt egyenleg levonas, a logolas teszafks ghajhs;klfdghks;lfh', '2022-11-08 12:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `def__header`
--

CREATE TABLE `def__header` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `links` varchar(2048) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `def__header`
--

INSERT INTO `def__header` (`id`, `uid`, `links`, `date`) VALUES
(1, 1, 'Webáruház=/browse;Fórum=/forum;Rólunk=/about', '2022-11-25 09:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `def__news`
--

CREATE TABLE `def__news` (
  `id` int NOT NULL,
  `uid` int DEFAULT NULL,
  `no` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `description` varchar(2048) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `image` varchar(1024) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `def__news`
--

INSERT INTO `def__news` (`id`, `uid`, `no`, `title`, `description`, `image`, `date`) VALUES
(1, 1, 2, 'Hibajavítók', 'Hibajavító folyadékok, rollerek, tollak a hibák javításához. A folyadék gyors száradást és kiváló lefedettséget biztosít. A rollerek a gyakori felhasználók számára ideális megoldás. A toll kézhez álló apró hibák, kis területek, vonalak javításához.', '1.jpg', '2022-11-25 08:52:00'),
(2, 1, 3, 'Írószerek', 'Írószerek és betétek több mint ezer típusból álló palettáját kínáljuk készletről a legolcsóbbtól a prémium termékekig bezárólag.', '2.jpg', '2022-11-25 08:55:07'),
(3, 1, 4, 'Iratrendezők', 'Több mint 500 féle iratrendező, iratgyűjtő, iratpapucs, irattasak és iratrendezési kellék érhető el kínálatunkban széles színválasztékban.', '3.jpg', '2022-11-25 08:55:40'),
(4, 1, 5, 'Adathordozók', 'Írható és újraírható CD, DVD, pendrive, memóriakártya többféle márkában, kiszerelésben és változatos tárolási kapacitással az Ön igényei szerint.', '4.jpg', '2022-11-25 08:56:07'),
(5, 1, 6, 'Irodai kisgépek', 'Az irodai munkát, elsősorban a vágást, tűzést, lyukasztást segítő egyszerű eszközök. Megkönnyítik az iratok összefűzését, szétválasztását, tárolását, kényelmesebbé teszik a munkavégzést.', '5.jpg', '2022-11-25 08:56:47'),
(6, 1, 7, 'Kreatív termékek', 'Tinták, kartonok, ragasztók, rajzeszközök és már kreatív kellékanyagok széles választékát találja meg szaküzletünkben és egyéni megrendelések beszerzését is vállaljuk.', '6.jpg', '2022-11-25 08:57:17'),
(7, 1, 8, 'Irodaszerek', 'Bélyegzők, adathordozók, táskák, fémhálós termékek és további irodai kiegészítők elérhetőek webáruházunkban valamint szaküzletünkben azonnal, készletről.', '7.jpg', '2022-11-25 08:57:50'),
(8, 1, 1, 'Karácsonyi leárazás', '50% kedvezmény minden termékünkre karácsony alkalmából. <br><strong>Kód: CM-AI-221231</strong><br>Kellemes ünnepeket!', '8.jpg', '2022-12-19 19:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `def__news__status`
--

CREATE TABLE `def__news__status` (
  `id` int NOT NULL,
  `nid` int NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `def__news__status`
--

INSERT INTO `def__news__status` (`id`, `nid`, `status`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `def__page`
--

CREATE TABLE `def__page` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `webmester` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `meta` varchar(4096) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `def__page`
--

INSERT INTO `def__page` (`id`, `uid`, `title`, `description`, `webmester`, `email`, `icon`, `meta`, `date`) VALUES
(1, 1, 'Mappa Papír', 'Mappa Papír Irodaszer nagykereskedelem. Kiskunhalason és környékén ingyenes kiszállítás.', 'Ászity Martin', 'webmester@mappapapir.hu', 'favicon.ico', 'charset=UTF-8;keywords=tuzogép,fénymásolópapír,békéscsaba,eagle,kiszállítás,békéscsaba,írószer,irodaszer,nagyker, nagykereskedelem,ingyen,cd,dvd,zebra,boríték,füzet,dosszié,toll, golyóstoll,papír,atbt,iratrendezo,verbatim,import;rights=Mappa Papír', '2022-11-25 09:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `e__banned`
--

CREATE TABLE `e__banned` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e__subs`
--

CREATE TABLE `e__subs` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `disc` int NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `e__subs`
--

INSERT INTO `e__subs` (`id`, `uid`, `email`, `disc`, `date`) VALUES
(2, 1, 'martinaszity@icloud.com', 0, '2022-06-11 14:24:23'),
(3, 10, 'gemesifanni@gmail.com', 0, '2022-10-18 07:00:14'),
(4, 11, 'gemesiandrea@gmai.com', 0, '2022-10-24 08:44:39');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `target_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `description` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `type` int NOT NULL,
  `status` int NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `uid`, `target_id`, `title`, `description`, `image`, `type`, `status`, `created`) VALUES
(1, 1, 2, 'A \"Hozzáadás a kedvencekhez\" funkció nem működik a websop-ban', 'Küldjön visszajelzést fejlesztőinknek, hogy kijavíthassák az Ön által talált hibákat.', 'abd14df20220417140157.png', 0, 0, '2022-04-16 16:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `description` varchar(6144) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `uid`, `ip`, `category`, `description`, `date`) VALUES
(2, 1, '37.76.61.150', 'Termék létrehozása', '#82 termék sikeresen fel lett véve az adatbázisba.', '2022-08-28 16:20:52'),
(3, 1, '37.76.58.67', 'Termék szerkesztése', '#78 termék thumbnailja sikeresen meg lett változtatva.', '2022-08-28 19:47:51'),
(4, 1, '37.76.58.67', 'Termék szerkesztése', '#78 termék státusza sikeresen meg lett változtatva ( -> 3).', '2022-08-28 20:44:43'),
(5, 1, '37.76.58.67', 'Termék szerkesztése', '#78 termék státusza sikeresen meg lett változtatva ( -> 3).', '2022-08-28 20:53:18'),
(6, 1, '37.76.58.67', 'Termék szerkesztése', '#78 termék státusza sikeresen meg lett változtatva ( -> 2).', '2022-08-28 21:02:07'),
(7, 1, '37.76.58.67', 'Termék szerkesztése', '#78 termék státusza sikeresen meg lett változtatva ( -> 1).', '2022-08-28 21:02:13'),
(8, 1, '37.76.58.232', 'Termék szerkesztése', '#78 termék kategóriája sikeresen meg lett változtatva (Kategória:  -> Irodai egerek, Címkék: Irodai egér,Vezeték nélküli,Népszerű,Új termék -> Irodai egér,Vezeték nélküli,Népszerű).', '2022-08-29 09:31:35'),
(9, 1, '37.76.58.232', 'Termék szerkesztése', '#78 termék neve / leírása sikeresen meg lett változtatva (Név:  -> 2.4 G vezeték nélküli egér, 1200 DPI mobil optikai vezeték nélküli egér USB vevővel, hordozható számítógépes egér vezeték nélküli egér laptophoz, PC-hez, asztali számítógéphez, MacBookhoz, 5 gomb, Leírás: <ul><li>【MAXIMÁLIS KÉZÉRZÉS】 A modern kontúros forma, az izzadságálló és bőrbarát felület a maximális kényelemért és támogatásért. Az átgondolt gyűrű és a kisujjtámasz extra kényelmet biztosít. A robusztus, gumival ellátott görgő gondoskodik arról, hogy a keze ne csússzon el görgetés közben.</li><li>【PLUG &amp; PLAY SZUPER KÖNNYŰ HASZNÁLAT】 Valóban plug &amp; play kialakítás, nem kell illesztőprogramot telepíteni. A 2,4 GHz-es vezeték nélküli átviteli technológia erőteljes és megbízható kapcsolatot biztosít 43,0 lábig. A hordozható kialakítás megkönnyíti a táskában való tárolását. Ez a legjobb egér ajándéknak.</li><li>【ERŐS TARTÓSSÁG ÉS HOSSZÚ MŰKÖDÉSI TÁVOLSÁG】 6 000 000-szeres billentyűleütési tesztet teljesített, hogy garantálja az extra tartósságot. A 2,4 GHz-es vezeték nélküli technológia és a professzionális chip hosszabb munkatávolságot biztosít.</li><li>【RENDKÍVÜL ALACSONY FELFOGYASZTÁS】 Ennek a vezeték nélküli egérnek a működtetéséhez 2 AAA elem szükséges (nem tartozék), és 7 perc inaktivitás után alvó módba kapcsol az energiatakarékosság érdekében, és bármely gomb megnyomásával egyszerűen aktiválható.</li><li>【SZÉLES KOMPATIBILITÁS】 Jól kompatibilis a Windows 7/8/10/XP, Vista 7/8, Mac és Linux operációs rendszerekkel stb. Vezeték nélküli számítógépes egér laptophoz, asztali számítógéphez, PC-hez, Macbookhoz és egyéb eszközökhöz. Ez a vezeték nélküli egér 45 napos pénz-visszatérítést és 365 napos gondtalan garanciát élvez. Megjegyzés: az oldalsó gombok nem érhetők el Mac OS rendszeren, de a másik funkció normál módon használható.</li></ul> -> <ul><li>【MAXIMÁLIS KÉZÉRZÉS】 A modern kontúros forma, az izzadságálló és bőrbarát felület a maximális kényelemért és támogatásért. Az átgondolt gyűrű és a kisujjtámasz extra kényelmet biztosít. A robusztus, gumival ellátott görgő gondoskodik arról, hogy a keze ne csússzon el görgetés közben.</li><li>【PLUG &amp; PLAY SZUPER KÖNNYŰ HASZNÁLAT】 Valóban plug &amp; play kialakítás, nem kell illesztőprogramot telepíteni. A 2,4 GHz-es vezeték nélküli átviteli technológia erőteljes és megbízható kapcsolatot biztosít 43,0 lábig. A hordozható kialakítás megkönnyíti a táskában való tárolását. Ez a legjobb egér ajándéknak.</li><li>【ERŐS TARTÓSSÁG ÉS HOSSZÚ MŰKÖDÉSI TÁVOLSÁG】 6 000 000-szeres billentyűleütési tesztet teljesített, hogy garantálja az extra tartósságot. A 2,4 GHz-es vezeték nélküli technológia és a professzionális chip hosszabb munkatávolságot biztosít.</li><li>【RENDKÍVÜL ALACSONY FELFOGYASZTÁS】 Ennek a vezeték nélküli egérnek a működtetéséhez 2 AAA elem szükséges (nem tartozék), és 7 perc inaktivitás után alvó módba kapcsol az energiatakarékosság érdekében, és bármely gomb megnyomásával egyszerűen aktiválható.</li><li>【SZÉLES KOMPATIBILITÁS】 Jól kompatibilis a Windows 7/8/10/XP, Vista 7/8, Mac és Linux operációs rendszerekkel stb. Vezeték nélküli számítógépes egér laptophoz, asztali számítógéphez, PC-hez, Macbookhoz és egyéb eszközökhöz. Ez a vezeték nélküli egér 45 napos pénz-visszatérítést és 365 napos gondtalan garanciát élvez. Megjegyzés: az oldalsó gombok nem érhetők el Mac OS rendszeren, de a másik funkció normál módon használható.</li></ul>).', '2022-08-29 10:18:28'),
(13, 1, '37.76.55.200', 'Termék szerkesztése', '#78 termék miniatűrjei sikeresen meg lettek változtatva. (b3c1ed020220826203507.jpeg,1238b9720220826203507.jpeg,47c0bee20220826203507.jpeg,007037b20220826203507.jpeg,5e186ce20220826203507.jpeg -> 468ef4720220829220743.png,0d6bb9420220829220743.png)', '2022-08-29 20:07:43'),
(14, 1, '37.76.55.200', 'Termék szerkesztése', '#78 termék miniatűrjei sikeresen meg lettek változtatva. (468ef4720220829220743.png,0d6bb9420220829220743.png -> 504ef2820220829220900.jpeg,2b4c06d20220829220900.jpeg,9898c2c20220829220900.jpeg,0ed141720220829220900.jpeg,ab1c72f20220829220900.jpeg)', '2022-08-29 20:09:00'),
(15, 1, '81.183.181.135', 'Termék szerkesztése', '#78 termék raktár adatai sikeresen meg lettek változtatva (Azonosító:  -> B07WCW1-RED, Mennyiség: 30 -> 30, Raktár mennyiség: 30 -> 31, Mértékegység: Darab -> Darab, Utólagos rendelések: 0 -> 0).', '2022-09-03 10:07:45'),
(16, 1, '81.183.181.135', 'Termék szerkesztése', '#78 termék variációi sikeresen meg lettek változtatva (Szín: Piros -> Fekete, Anyag: Műanyag -> Műanyag, Stílus: Vezeték nélküli -> Vezeték nélküli, Márka: Memzuoix -> Memzuoix, Egyedi: Gombok száma:6,Platform:Windows7/8/10/XP/Vista7/8 / Linux & Mac OS (Az oldalsó gombok nem elérhetők),USB nano vevőegység mellékelve:Igen,DPI szint:2600/2000/1600/1200/800,Csatlakozási technológia:2.4 GHz-es vezeték nélküli,Maximális akkumulátor-élettartam:24 hónap,Elemek száma:2 AA (nem tartalmazza) -> Gombok száma:6,Platform:Windows7/8/10/XP/Vista7/8 / Linux & Mac OS (Az oldalsó gombok nem elérhetők),USB nano vevőegység mellékelve:Igen,DPI szint:2600/2000/1600/1200/800,Csatlakozási technológia:2.4 GHz-es vezeték nélküli,Maximális akkumulátor-élettartam:24 hónap,Elemek száma:2 AA (nem tartalmazza)).', '2022-09-03 11:06:57'),
(17, 1, '81.183.181.135', 'Termék szerkesztése', '#78 termék variációi sikeresen meg lettek változtatva (Szín: Fekete -> Piros, Anyag: Műanyag -> Műanyag, Stílus: Vezeték nélküli -> Vezeték nélküli, Márka: Memzuoix -> Memzuoix, Egyedi: Gombok száma:6,Platform:Windows7/8/10/XP/Vista7/8 / Linux & Mac OS (Az oldalsó gombok nem elérhetők),USB nano vevőegység mellékelve:Igen,DPI szint:2600/2000/1600/1200/800,Csatlakozási technológia:2.4 GHz-es vezeték nélküli,Maximális akkumulátor-élettartam:24 hónap,Elemek száma:2 AA (nem tartalmazza) -> Gombok száma:6,Platform:Windows7/8/10/XP/Vista7/8 / Linux & Mac OS (Az oldalsó gombok nem elérhetők),USB nano vevőegység mellékelve:Igen,DPI szint:2600/2000/1600/1200/800,Csatlakozási technológia:2.4 GHz-es vezeték nélküli,Maximális akkumulátor-élettartam:24 hónap,Elemek száma:2 AA (nem tartalmazza)).', '2022-09-03 11:07:17'),
(18, 1, '81.183.181.135', 'Termék szerkesztése', '#78 termék szállítási adatai sikeresen meg lettek változtatva (Fizikai: 1 -> 1, Súly: 81 -> 82, Súly mért: Gramm -> Gramm, Hossz: 4 -> 4, Magasság: 2 -> 2, Szélesség: 1 -> 1, Dimenzió mért: Inch -> Inch, Visszatérítés: 0 -> 0).', '2022-09-03 11:55:00'),
(19, 1, '81.183.181.135', 'Termék szerkesztése', '#78 termék meta adatai sikeresen meg lettek változtatva (Név: Termékleírás -> Termékleírása, Leírás: Vezetéknélküli Irodai Egér halk kattintás, fekete és arany színű. 2.4G csatlakozás. Ergonomikus tervezés. -> Vezetéknélküli Irodai Egér halk kattintás, fekete és arany színű. 2.4G csatlakozás. Ergonomikus tervezés., Kulcsszavak: Egér,Egerek,Irodai Egér,Vezetéknélküli egér,Gaming Egér -> ).', '2022-09-03 12:14:26'),
(20, 1, '81.183.181.135', 'Termék szerkesztése', '#78 termék meta adatai sikeresen meg lettek változtatva (Név: Termékleírása -> Termékleírás, Leírás: Vezetéknélküli Irodai Egér halk kattintás, fekete és arany színű. 2.4G csatlakozás. Ergonomikus tervezés. -> Vezetéknélküli Irodai Egér halk kattintás, fekete és arany színű. 2.4G csatlakozás. Ergonomikus tervezés., Kulcsszavak: Egér,Egerek,Irodai Egér,Vezetéknélküli egér,Gaming Egér -> Egér,Egerek,Irodai Egér,Vezetéknélküli egér,Gaming Egér).', '2022-09-03 12:15:27'),
(21, 1, '81.183.181.135', 'Termék szerkesztése', '#78 termék véleményezésének beállításai sikeresen meg lettek változtatva (Engedélyezés: 1 -> 1, Hitelesítés: 0 -> 0, Szavazás: 0 -> 1, Nevek feltűntetése: 1  -> 1).', '2022-09-03 12:27:13'),
(22, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználó jogainak megváltoztatása (0 -> 1)', '2022-10-13 08:40:19'),
(23, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználó mentett #1 termék törlése.', '2022-10-13 08:52:45'),
(24, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználó mentett #3 termék hozzáadása.', '2022-10-13 08:56:05'),
(25, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználó kosarába új terméket vett fel:  #4', '2022-10-13 09:13:12'),
(26, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználó kosarából terméke(ket) törölt:  #1', '2022-10-13 09:19:56'),
(27, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználó kosarába új terméket vett fel:  #2', '2022-10-13 09:23:47'),
(28, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználó kosarából terméket törölt:  #4', '2022-10-13 09:23:56'),
(29, 1, '37.76.9.218', 'Felhasználó szerkesztése', '#8 felhasználó jogainak megváltoztatása (1 -> 0)', '2022-10-15 10:41:31'),
(30, 1, '37.76.9.218', 'Felhasználó szerkesztése', '#8 felhasználó jogainak megváltoztatása (0 -> 1)', '2022-10-15 10:41:41'),
(31, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználónak új kártyát vett fel: 7344677330c559ab45', '2022-10-17 08:19:35'),
(32, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#10 felhasználó kosarából terméket törölt:  #59', '2022-10-18 06:50:06'),
(33, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#10 felhasználó kosarába új terméket vett fel:  #1', '2022-10-18 06:50:15'),
(34, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#10 felhasználó kosarába új terméket vett fel:  #2', '2022-10-18 06:50:17'),
(35, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#10 felhasználó mentett #59 termék hozzáadása.', '2022-10-18 07:09:34'),
(36, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak új kártyát vett fel: 7344672cf5e330a285', '2022-10-23 08:10:43'),
(37, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak új kártyát vett fel: 734467122845979a4e', '2022-10-23 08:26:08'),
(38, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak 7344672cf5e330a285 kártyáját szerkesztette.', '2022-10-23 09:17:36'),
(39, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak 734467122845979a4e kártyáját szerkesztette.', '2022-10-23 09:18:05'),
(40, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak 734467122845979a4e kártyáját szerkesztette.', '2022-10-23 09:21:01'),
(41, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak 734467122845979a4e kártyáját szerkesztette.', '2022-10-23 09:32:26'),
(42, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak 734467122845979a4e kártyáját szerkesztette.', '2022-10-23 09:35:16'),
(43, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak 734467122845979a4e kártyáját szerkesztette.', '2022-10-23 09:37:40'),
(44, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak 734467122845979a4e kártyáját szerkesztette.', '2022-10-23 09:38:37'),
(45, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak 734467122845979a4e kártyáját szerkesztette.', '2022-10-23 09:42:47'),
(46, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak 734467122845979a4e kártyáját szerkesztette.', '2022-10-23 09:43:17'),
(47, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak 734467122845979a4e kártyáját szerkesztette.', '2022-10-23 09:44:19'),
(48, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak 734467122845979a4e kártyáját szerkesztette.', '2022-10-23 09:44:48'),
(49, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak 734467122845979a4e kártyáját szerkesztette.', '2022-10-23 09:44:57'),
(50, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak 734467122845979a4e kártyáját szerkesztette.', '2022-10-23 09:52:48'),
(51, 1, '37.76.3.130', 'Felhasználó szerkesztése', '#10 felhasználónak 734467122845979a4e kártyáját szerkesztette.', '2022-10-23 09:53:03'),
(52, 11, '195.199.179.161', 'Regisztráció', '#11 felhasználó sikeresen regisztrált', '2022-10-24 07:19:50'),
(53, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#11 felhasználónak új kártyát vett fel: 1584e3e850f99f9b56', '2022-10-24 08:47:35'),
(54, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználót feliratkoztatta a következő csomagra: 2', '2022-10-25 07:19:43'),
(55, 1, '8.8.8.8', 'Felhasználó szerkesztése', '#8 felhasználót feliratkoztatta a következő csomagra: 3', '2022-10-26 07:37:01'),
(56, 1, '8.8.8.8', 'Felhasználó szerkesztése', '#8 felhasználót feliratkoztatta a következő csomagra: 2', '2022-10-26 07:37:34'),
(57, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználót feliratkoztatta a következő csomagra: 1', '2022-10-26 07:38:08'),
(58, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználót feliratkoztatta a következő csomagra: 2', '2022-10-26 07:38:18'),
(59, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználót feliratkoztatta a következő csomagra: 3', '2022-10-26 07:39:05'),
(60, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználót feliratkoztatta a következő csomagra: 2', '2022-10-26 07:39:28'),
(61, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználót feliratkoztatta a következő csomagra: 3', '2022-10-26 07:42:38'),
(62, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#11 felhasználót feliratkoztatta a következő csomagra: 3', '2022-10-26 07:52:00'),
(63, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#11 felhasználót feliratkoztatta a következő csomagra: 2', '2022-10-26 07:52:37'),
(64, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#11 felhasználót feliratkoztatta a következő csomagra: 1', '2022-10-26 07:52:56'),
(65, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#11 felhasználót feliratkoztatta a következő csomagra: 2', '2022-10-26 07:54:23'),
(66, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#11 felhasználót feliratkoztatta a következő csomagra: 3', '2022-10-26 07:54:49'),
(67, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#11 felhasználót feliratkoztatta a következő csomagra: 1', '2022-10-26 07:55:10'),
(68, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#9 felhasználót feliratkoztatta a következő csomagra: 2', '2022-10-26 07:55:22'),
(69, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#9 felhasználót feliratkoztatta a következő csomagra: 1', '2022-10-26 07:55:48'),
(70, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználónak szerkesztette a személyes információit.', '2022-10-26 08:46:25'),
(71, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználónak szerkesztette a személyes információit.', '2022-10-26 08:46:43'),
(72, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználónak szerkesztette a fiók információit.', '2022-10-27 08:34:41'),
(73, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#8 felhasználónak szerkesztette a fiók információit.', '2022-10-27 08:35:55'),
(74, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#9 felhasználónak szerkesztette a fiók információit.', '2022-10-27 08:36:16'),
(75, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#9 felhasználónak szerkesztette a fiók információit.', '2022-10-27 08:36:30'),
(76, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#9 felhasználónak szerkesztette a fiók információit.', '2022-10-27 08:36:35'),
(77, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#9 felhasználónak szerkesztette a fiók információit.', '2022-10-27 08:36:47'),
(78, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#9 felhasználónak szerkesztette a fiók információit.', '2022-10-27 08:39:06'),
(79, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#9 felhasználónak szerkesztette a fiók információit.', '2022-10-27 08:39:28'),
(80, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#10 felhasználónak 1500 forintot írt jóvá. Új egyenleg: 33000 ; cid=23256745cbbe12ddd8', '2022-11-03 09:55:51'),
(81, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#10 felhasználónak 1500 forintot írt jóvá. Új egyenleg: 34500 Ft ; cid=23256745cbbe12ddd8', '2022-11-03 09:58:03'),
(82, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#10 felhasználónak 1500 forintot írt jóvá. Új egyenleg: 36000 Ft ; cid=23256745cbbe12ddd8', '2022-11-03 09:58:39'),
(83, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#9 felhasználónak 1500 forintot vont le. Új egyenleg: 28500 Ft ; cid=5475676b75e356c5c5', '2022-11-07 07:21:10'),
(84, 1, '195.199.179.161', 'Felhasználó szerkesztése', '#10 felhasználónak 6000 forintot vont le. Új egyenleg: 30000 Ft ; cid=23256745cbbe12ddd8', '2022-11-08 12:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `login__attempts`
--

CREATE TABLE `login__attempts` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `status` int NOT NULL,
  `browser` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `device` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `sys` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `login__attempts`
--

INSERT INTO `login__attempts` (`id`, `uid`, `location`, `country`, `status`, `browser`, `device`, `sys`, `ip`, `date`) VALUES
(1, 1, 'Kiskunhalas', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '81.183.185.245', '2022-06-14 11:05:36'),
(2, 1, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.48.196', '2022-06-22 12:11:09'),
(3, 8, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.48.196', '2022-06-22 12:14:46'),
(4, 8, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.48.196', '2022-06-22 14:11:32'),
(5, 1, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.48.196', '2022-06-22 20:48:54'),
(6, 1, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.48.196', '2022-06-22 20:49:29'),
(7, 1, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.60.193', '2022-06-23 09:18:18'),
(8, 1, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.60.193', '2022-06-23 10:13:10'),
(9, 8, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.1.192', '2022-06-24 12:15:50'),
(10, 1, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.1.192', '2022-06-24 13:28:58'),
(11, 8, 'Kiskunhalas', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '81.183.188.150', '2022-06-26 11:30:37'),
(12, 9, 'Budapest', 'Hungary', 1, 'Safari', 'mobile', 'Mac', '37.76.4.115', '2022-08-05 15:43:37'),
(13, 1, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.4.115', '2022-08-05 15:59:38'),
(14, 9, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.4.115', '2022-08-05 16:49:43'),
(15, 8, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.6.32', '2022-08-06 10:06:20'),
(16, 1, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.6.32', '2022-08-06 10:13:12'),
(17, 8, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.6.32', '2022-08-06 10:13:44'),
(18, 1, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.6.32', '2022-08-06 10:21:40'),
(19, 8, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.6.32', '2022-08-06 11:44:07'),
(20, 9, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.7.153', '2022-08-06 15:36:57'),
(21, 1, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.24.20', '2022-08-07 16:02:27'),
(22, 1, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.24.20', '2022-08-07 16:12:40'),
(23, 9, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.24.20', '2022-08-07 16:15:38'),
(24, 1, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.14.173', '2022-08-08 09:37:45'),
(25, 10, 'Baja', 'Hungary', 1, 'Chrome', 'desktop', 'Windows', '195.199.179.161', '2022-10-18 06:49:12'),
(26, 10, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Windows', '195.199.179.161', '2022-10-18 07:10:46'),
(27, 10, 'Baja', 'Hungary', 1, 'Chrome', 'desktop', 'Windows', '195.199.179.161', '2022-10-18 07:11:03'),
(28, 1, 'Baja', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-24 07:02:10'),
(29, 1, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-24 07:04:58'),
(30, 1, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-24 07:05:12'),
(31, 1, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-24 07:05:30'),
(32, 10, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Windows', '195.199.179.161', '2022-10-24 07:06:27'),
(33, 10, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Windows', '195.199.179.161', '2022-10-24 07:06:48'),
(34, 1, 'Baja', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-24 07:07:16'),
(35, 10, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Windows', '195.199.179.161', '2022-10-24 07:08:15'),
(36, 10, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Windows', '195.199.179.161', '2022-10-24 07:11:20'),
(37, 10, 'Baja', 'Hungary', 1, 'Chrome', 'desktop', 'Windows', '195.199.179.161', '2022-10-24 07:14:22'),
(38, 10, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Windows', '37.76.30.98', '2022-10-24 07:24:48'),
(39, 11, 'Baja', 'Hungary', 1, 'Chrome', 'desktop', 'Windows', '195.199.179.161', '2022-10-24 08:38:08'),
(40, 1, 'Budapest', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '37.76.53.47', '2022-10-26 15:39:45'),
(41, 8, 'Baja', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-27 08:46:26'),
(42, 1, 'Baja', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-11-21 06:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `uid` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`id`, `pid`, `uid`, `email`, `date`) VALUES
(1, 10, 1, 'martinaszity@icloud.com', '2022-06-12 17:12:09');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `pid` varchar(512) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `status` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders__invoice`
--

CREATE TABLE `orders__invoice` (
  `id` int NOT NULL,
  `oid` int NOT NULL,
  `zip` int NOT NULL,
  `settlement` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `tax` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders__old`
--

CREATE TABLE `orders__old` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `pid` int NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `orders__old`
--

INSERT INTO `orders__old` (`id`, `uid`, `pid`, `quantity`, `subtotal`, `date`) VALUES
(1, 1, 1, 1, 8565, '2022-08-03 10:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `orders__payment`
--

CREATE TABLE `orders__payment` (
  `id` int NOT NULL,
  `oid` int NOT NULL,
  `cid` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `voucherUsed` tinyint(1) NOT NULL,
  `voucherCode` varchar(512) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `voucherDiscount` int NOT NULL,
  `subTotal` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders__sh`
--

CREATE TABLE `orders__sh` (
  `id` int NOT NULL,
  `oid` int NOT NULL,
  `uid` int NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `settlement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `postal` int NOT NULL,
  `phone` int NOT NULL,
  `note` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders__ship`
--

CREATE TABLE `orders__ship` (
  `id` int NOT NULL,
  `oid` int NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `zip` int NOT NULL,
  `settlement` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `note` varchar(2048) COLLATE utf8mb4_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders__user`
--

CREATE TABLE `orders__user` (
  `id` int NOT NULL,
  `oid` int NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `description` varchar(6144) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `thumbnail`, `added`) VALUES
(1, 'Tudományos Számológép', '<ul><li>Robusztus, professzionális tudományos számológép.</li><li>2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt</li><li>Könnyen kezel 1 és 2 változó statisztikai számításokat és három szögmódot (fok, radián és fokozat), valamint tudományos és mérnöki hamisítási módokat</li><li>Napelemes és akkumulátoros</li></ul>', 'd1267f2202208203104700.png', '2022-08-03 08:53:48'),
(2, 'Tudományos Számológép', '<ul><li>Robusztus, professzionális tudományos számológép.</li><li>2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt</li><li>Könnyen kezel 1 és 2 változó statisztikai számításokat és három szögmódot (fok, radián és fokozat), valamint tudományos és mérnöki hamisítási módokat</li><li>Napelemes és akkumulátoros</li></ul>', 'd8223c020220417223255.png', '2022-08-20 15:36:14'),
(3, 'Tudományos Számológép', '<ul><li>Robusztus, professzionális tudományos számológép.</li><li>2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt</li><li>Könnyen kezel 1 és 2 változó statisztikai számításokat és három szögmódot (fok, radián és fokozat), valamint tudományos és mérnöki hamisítási módokat</li><li>Napelemes és akkumulátoros</li></ul>', 'd7223c020220417223255.png', '2022-08-20 15:36:14'),
(4, 'Tudományos Számológép', '<ul><li>Robusztus, professzionális tudományos számológép.</li><li>2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt</li><li>Könnyen kezel 1 és 2 változó statisztikai számításokat és három szögmódot (fok, radián és fokozat), valamint tudományos és mérnöki hamisítási módokat</li><li>Napelemes és akkumulátoros</li></ul>', 'd6223c020220417223255.png', '2022-08-20 15:36:14'),
(5, 'Haladó tudományos számológép', '<ul><li>A Natural Textbook Display egyszerű megjelenítést biztosít a számításokról</li><li>A kemény védőtok segít megelőzni a tárolás során bekövetkező sérüléseket</li><li>A napelemes üzem biztosítja a folyamatos használatot</li><li>Tökéletes algebrához, számításokhoz, statisztikákhoz és egyebekhez</li></ul>', 'a063a0320220417223051.png', '2022-08-21 16:52:51'),
(6, 'Haladó tudományos számológép', '<ul><li>A Natural Textbook Display egyszerű megjelenítést biztosít a számításokról</li><li>A kemény védőtok segít megelőzni a tárolás során bekövetkező sérüléseket</li><li>A napelemes üzem biztosítja a folyamatos használatot</li><li>Tökéletes algebrához, számításokhoz, statisztikákhoz és egyebekhez</li></ul>', 'b063a0320220417223051.png', '2022-08-21 16:52:51'),
(7, 'Haladó tudományos számológép', '<ul><li>A Natural Textbook Display egyszerű megjelenítést biztosít a számításokról</li><li>A kemény védőtok segít megelőzni a tárolás során bekövetkező sérüléseket</li><li>A napelemes üzem biztosítja a folyamatos használatot</li><li>Tökéletes algebrához, számításokhoz, statisztikákhoz és egyebekhez</li></ul>', 'c063a0320220417223051.png', '2022-08-21 16:52:51'),
(8, 'Linon Brooklyn Sherpa irodai szék', '<ul><li>A plüss ülés és háttámla kényelmét szolgálja munka közben</li><li>Rusztikus barna műbőr kárpit</li><li>Ezüst alap fekete dupla kerekekkel</li><li>Karfa magasság: 24\"-28\", karfa szélessége: 1,58\"</li><li>Alapmélység: 5,5\", Alapszélesség: 12,6\"</li></ul>', '65f632420220417222404.png', '2022-08-21 17:24:34'),
(9, 'Állítható extra plüss forgatható otthoni irodai munkaszék polírozott króm alappal', '<ul><li>Vastag párnázott ülés és háttámla beépített deréktámasszal</li><li>Állítható magasság a kényelem érdekében</li><li>A strapabíró polírozott króm alap és a nagy teljesítményű, minden irányított kerekek egyenletes mozgást tesznek lehetővé a szőnyegen</li><li>Extra plüss, extra masszív és ami a legfontosabb extra stílus divatos butik színekkel</li></ul><p><strong>Paraméterek:</strong></p><ul><li>Teljes méret: 26” sz x 24,75” mé x 31-34,25” ma</li><li>Ülés mérete: 18,5” sz x 18” mé x 3,5” ma</li><li>Hátsó mérete: 21” sz x 12,75” mé  x 3,5” ma</li></ul><p><br></p>', 'cf9461f20220417215208.png', '2022-08-21 17:24:34'),
(10, 'Állítható extra plüss forgatható otthoni irodai munkaszék polírozott króm alappal', '<ul><li>Vastag párnázott ülés és háttámla beépített deréktámasszal</li><li>Állítható magasság a kényelem érdekében</li><li>A strapabíró polírozott króm alap és a nagy teljesítményű, minden irányított kerekek egyenletes mozgást tesznek lehetővé a szőnyegen</li><li>Extra plüss, extra masszív és ami a legfontosabb extra stílus divatos butik színekkel</li></ul><p><strong>Paraméterek:</strong></p><ul><li>Teljes méret: 26” sz x 24,75” mé x 31-34,25” ma</li><li>Ülés mérete: 18,5” sz x 18” mé x 3,5” ma</li><li>Hátsó mérete: 21” sz x 12,75” mé  x 3,5” ma</li></ul><p><br></p>', 'df9461f20220417215208.png', '2022-08-21 17:24:34'),
(11, 'Állítható extra plüss forgatható otthoni irodai munkaszék polírozott króm alappal', '<ul><li>Vastag párnázott ülés és háttámla beépített deréktámasszal</li><li>Állítható magasság a kényelem érdekében</li><li>A strapabíró polírozott króm alap és a nagy teljesítményű, minden irányított kerekek egyenletes mozgást tesznek lehetővé a szőnyegen</li><li>Extra plüss, extra masszív és ami a legfontosabb extra stílus divatos butik színekkel</li></ul><p><strong>Paraméterek:</strong></p><ul><li>Teljes méret: 26” sz x 24,75” mé x 31-34,25” ma</li><li>Ülés mérete: 18,5” sz x 18” mé x 3,5” ma</li><li>Hátsó mérete: 21” sz x 12,75” mé  x 3,5” ma</li></ul><p><br></p>', 'ef9461f20220417215208.png', '2022-08-21 17:24:34'),
(12, '2.4G vezeték nélküli 2400Dpi irodai egér', '<p>Újratölthető 2,4G vezeték nélküli játékegér, háttérvilágítású, 2400 dpi-s némító egerek irodai egér PC-hez laptophoz</p><p><br></p><p><strong>Paraméterek</strong>: </p><ul><li>2,4G vezeték nélküli átviteli technológia, </li><li>10M vezeték nélküli vételi távolság. </li><li>Újratölthető Design, beépített 500 Mah lítium akkumulátor</li><li>Harmadik fokozat Dpi beállítás</li><li>Elegáns irodai vezeték nélküli egér</li><li>Nagy felbontás: Max 800/1200/2400 Dpi </li><li>Nagy felbontás a Fluid Motionfashion Ergo számára</li><li>Omic Design: Ergonomikus kialakítás, kényelmes markolat, stílusos megjelenés, könnyen hordozható </li></ul><p><strong>Specifikáció</strong>: </p><ul><li>Modell: G8622</li><li>Szín: Fekete</li><li>Anyag: Műanyag</li><li>Élettartam: 5 millió kattintás </li><li>Vezeték nélküli távolság: 10M6</li><li>Munka: Fotoelektromosság</li><li>Akkumulátorkapacitás: 500Mah（Tölthető lítium akkumulátor）Töltőkábel hossza: 24 cm</li><li>Projekt típusa: Ergonomics 108000 Optical 1200 2400. (1200 Dpi alapértelmezett)</li><li> Üzemmód: Opto-Elektronikus</li><li>Névleges feszültség / Áram: 3,7 V / 18 Ma</li><li>Tápellátás típusa: Újratölthető (Töltési idő 2H, Működési idő 150H) Vezeték nélküli, 14 Ghz</li><li>Gombok: 2 gomb és 1 kerek (középső birka) és Dpi</li><li>Rendszerkövetelmények: Windows 98 / Me / 2000 / Xp / Win 7 / Win8 /</li><li>Csomag tartalma: 1 X 2,4 G vezeték nélküli egér1 X USB</li></ul><p><br></p>', 'mc5bc8020220423141900.png', '2022-08-21 18:46:35'),
(13, '2.4G vezeték nélküli 2400Dpi irodai egér', '<p>Újratölthető 2,4G vezeték nélküli játékegér, háttérvilágítású, 2400 dpi-s némító egerek irodai egér PC-hez laptophoz</p><p><br></p><p><strong>Paraméterek</strong>: </p><ul><li>2,4G vezeték nélküli átviteli technológia, </li><li>10M vezeték nélküli vételi távolság. </li><li>Újratölthető Design, beépített 500 Mah lítium akkumulátor</li><li>Harmadik fokozat Dpi beállítás</li><li>Elegáns irodai vezeték nélküli egér</li><li>Nagy felbontás: Max 800/1200/2400 Dpi </li><li>Nagy felbontás a Fluid Motionfashion Ergo számára</li><li>Omic Design: Ergonomikus kialakítás, kényelmes markolat, stílusos megjelenés, könnyen hordozható </li></ul><p><strong>Specifikáció</strong>: </p><ul><li>Modell: G8622</li><li>Szín: Fehér</li><li>Anyag: Műanyag</li><li>Élettartam: 5 millió kattintás </li><li>Vezeték nélküli távolság: 10M6</li><li>Munka: Fotoelektromosság</li><li>Akkumulátorkapacitás: 500Mah（Tölthető lítium akkumulátor）Töltőkábel hossza: 24 cm</li><li>Projekt típusa: Ergonomics 108000 Optical 1200 2400. (1200 Dpi alapértelmezett)</li><li> Üzemmód: Opto-Elektronikus</li><li>Névleges feszültség / Áram: 3,7 V / 18 Ma</li><li>Tápellátás típusa: Újratölthető (Töltési idő 2H, Működési idő 150H) Vezeték nélküli, 14 Ghz</li><li>Gombok: 2 gomb és 1 kerek (középső birka) és Dpi</li><li>Rendszerkövetelmények: Windows 98 / Me / 2000 / Xp / Win 7 / Win8 /</li><li>Csomag tartalma: 1 X 2,4 G vezeték nélküli egér1 X USB</li></ul><p><br></p>', 'oc5bc8020220423141900.png', '2022-08-21 18:46:35'),
(54, 'Vezeték nélküli egér, 2.4G vékony hordozható számítógépes egér nano vevővel notebookhoz, PC-hez, laptophoz, számítógéphez', '<ul><li>ALACSONY FELFOGYASZTÁS: Az intelligens alvó üzemmód jobban meghosszabbítja az akkumulátor élettartamát. Automatikus alvó módba lép, ha 5 percig nem használja az akkumulátor kímélése érdekében, és rá kell kattintania, az egér ismét munkamódba lép</li><li>STABIL CSATLAKOZTATÁS: A 2,4 GHz-es vezeték nélküli erősebb interferencia-ellenes képességet, gyorsabb átviteli sebességet és megbízhatóbb kapcsolatot biztosít, a munkatávolság akár 15 m is lehet, a magas DPI pedig simábbá teszi a követést a legtöbb felületen</li><li>SZÉLES KOMPATIBILITÁS: Jól kompatibilis a Windows7/8/10/XP, Vista, Mac OS X 10.4 stb. operációs rendszerekkel. Alkalmas asztali számítógépekhez, laptopokhoz, PC-hez, Macbookhoz és egyéb eszközökhöz</li><li>ERGONOMIKUS ÉS KOMPAKT KIALAKÍTÁS: Az USB-vevő a számítógép USB-portjában marad, vagy kényelmesen elhelyezhető a vezeték nélküli egérben, ha nem használja. A könnyű és egyszerű funkcióknak köszönhetően az egér tökéletes utazáshoz, irodához, otthonhoz</li><li>SUTTOTT ÉS ÉRZÉKENY KATTINTÁS: A sima matt felület és a halk kattanások jobb felhasználói élményt biztosítanak, és felszabadítják a mások zavarása miatti aggódást, és továbbra is koncentrált maradhat munka közben</li></ul>', '54ba60f20220825220111.png', '2022-08-25 20:01:11'),
(55, 'Vezeték nélküli egér, 2.4G vékony hordozható számítógépes egér nano vevővel notebookhoz, PC-hez, laptophoz, számítógéphez', '<ul><li>ALACSONY FELFOGYASZTÁS: Az intelligens alvó üzemmód jobban meghosszabbítja az akkumulátor élettartamát. Automatikus alvó módba lép, ha 5 percig nem használja az akkumulátor kímélése érdekében, és rá kell kattintania, az egér ismét munkamódba lép</li><li>STABIL CSATLAKOZTATÁS: A 2,4 GHz-es vezeték nélküli erősebb interferencia-ellenes képességet, gyorsabb átviteli sebességet és megbízhatóbb kapcsolatot biztosít, a munkatávolság akár 15 m is lehet, a magas DPI pedig simábbá teszi a követést a legtöbb felületen</li><li>SZÉLES KOMPATIBILITÁS: Jól kompatibilis a Windows7/8/10/XP, Vista, Mac OS X 10.4 stb. operációs rendszerekkel. Alkalmas asztali számítógépekhez, laptopokhoz, PC-hez, Macbookhoz és egyéb eszközökhöz</li><li>ERGONOMIKUS ÉS KOMPAKT KIALAKÍTÁS: Az USB-vevő a számítógép USB-portjában marad, vagy kényelmesen elhelyezhető a vezeték nélküli egérben, ha nem használja. A könnyű és egyszerű funkcióknak köszönhetően az egér tökéletes utazáshoz, irodához, otthonhoz</li><li>SUTTOTT ÉS ÉRZÉKENY KATTINTÁS: A sima matt felület és a halk kattanások jobb felhasználói élményt biztosítanak, és felszabadítják a mások zavarása miatti aggódást, és továbbra is koncentrált maradhat munka közben</li></ul>', 'e85272120220825221715.png', '2022-08-25 20:17:15'),
(56, 'Hűtős hátizsák szigetelt, könnyű, szivárgásmentes', '<ul><li>600 Oxford, nagy sűrűségű habszivacs és szivárgásmentes bélés</li><li>Szigetelt hűtő hátizsák: A szigetelt hátizsákok belsejében lévő szigetelőanyag és a szivárgásmentes bélés együtt működik, hogy megakadályozza a szivárgást és 16 órán keresztül melegen / hidegen tartsa az ételeket</li><li>Nagy kapacitású hűtők: 13,0\\\" x 7,5\\\" x 15,8\\\" / 33 cm x 19 cm x 40 cm (H x SZ x M), Súly: 1,1 font / 500 g, 30 doboz (330 ml) tárolására alkalmas, elegendő hely minden szükségleted számára</li><li>Több zseb: 1 fő tágas tárolórekesz, 2 oldalsó hálós zseb, 2 nagy elülső cipzáros zseb az edények tárolására, 1 cipzáras zseb a fedélen, 1 hálós zseb és 1 sörnyitó a pánton</li><li>Könnyű, de tartós: Vízálló, strapabíró szövetből készült, a legjobb könnyű hátizsák hűtővel munkához, piknikhez, országúti / tengerparti kirándulásokhoz, túrázáshoz, kempingezéshez vagy kerékpározáshoz, tökéletes ajándék férfiaknak és nőknek</li><li>Több funkció: A szigetelt hűtő hátizsákunk stílusos kialakítása lehetővé teszi, hogy ebéd-hátizsákként vagy napi csomagként is használható. Tökéletes ebédekhez, piknikekhez, munkához vagy utazáshoz</li></ul>', 'ad8a8a020220825224440.png', '2022-08-25 20:44:40'),
(57, 'Hűtős hátizsák szigetelt, könnyű, szivárgásmentes', '<ul><li>600 Oxford, nagy sűrűségű habszivacs és szivárgásmentes bélés</li><li>Szigetelt hűtő hátizsák: A szigetelt hátizsákok belsejében lévő szigetelőanyag és a szivárgásmentes bélés együtt működik, hogy megakadályozza a szivárgást és 16 órán keresztül melegen / hidegen tartsa az ételeket</li><li>Nagy kapacitású hűtők: 13,0\\\\\\\" x 7,5\\\\\\\" x 15,8\\\\\\\" / 33 cm x 19 cm x 40 cm (H x SZ x M), Súly: 1,1 font / 500 g, 30 doboz (330 ml) tárolására alkalmas, elegendő hely minden szükségleted számára</li><li>Több zseb: 1 fő tágas tárolórekesz, 2 oldalsó hálós zseb, 2 nagy elülső cipzáros zseb az edények tárolására, 1 cipzáras zseb a fedélen, 1 hálós zseb és 1 sörnyitó a pánton</li><li>Könnyű, de tartós: Vízálló, strapabíró szövetből készült, a legjobb könnyű hátizsák hűtővel munkához, piknikhez, országúti / tengerparti kirándulásokhoz, túrázáshoz, kempingezéshez vagy kerékpározáshoz, tökéletes ajándék férfiaknak és nőknek</li><li>Több funkció: A szigetelt hűtő hátizsákunk stílusos kialakítása lehetővé teszi, hogy ebéd-hátizsákként vagy napi csomagként is használható. Tökéletes ebédekhez, piknikekhez, munkához vagy utazáshoz</li></ul>', 'd4dc6eb20220826124036.png', '2022-08-26 10:40:36'),
(58, 'Hűtős hátizsák szigetelt, könnyű, szivárgásmentes', '<ul><li>600 Oxford, nagy sűrűségű habszivacs és szivárgásmentes bélés</li><li>Szigetelt hűtő hátizsák: A szigetelt hátizsákok belsejében lévő szigetelőanyag és a szivárgásmentes bélés együtt működik, hogy megakadályozza a szivárgást és 16 órán keresztül melegen / hidegen tartsa az ételeket</li><li>Nagy kapacitású hűtők: 13,0\\\\\\\\\\\\\\\" x 7,5\\\\\\\\\\\\\\\" x 15,8\\\\\\\\\\\\\\\" / 33 cm x 19 cm x 40 cm (H x SZ x M), Súly: 1,1 font / 500 g, 30 doboz (330 ml) tárolására alkalmas, elegendő hely minden szükségleted számára</li><li>Több zseb: 1 fő tágas tárolórekesz, 2 oldalsó hálós zseb, 2 nagy elülső cipzáros zseb az edények tárolására, 1 cipzáras zseb a fedélen, 1 hálós zseb és 1 sörnyitó a pánton</li><li>Könnyű, de tartós: Vízálló, strapabíró szövetből készült, a legjobb könnyű hátizsák hűtővel munkához, piknikhez, országúti / tengerparti kirándulásokhoz, túrázáshoz, kempingezéshez vagy kerékpározáshoz, tökéletes ajándék férfiaknak és nőknek</li><li>Több funkció: A szigetelt hűtő hátizsákunk stílusos kialakítása lehetővé teszi, hogy ebéd-hátizsákként vagy napi csomagként is használható. Tökéletes ebédekhez, piknikekhez, munkához vagy utazáshoz</li></ul>', 'db5091e20220826124441.png', '2022-08-26 10:44:41'),
(59, 'Hátizsák hűtő szivárgásmentes 28 dobozos hűtő hátizsák szigetelt vízálló', '<ul><li>Anyaga: vízálló Oxford + nagy sűrűségű hab + szivárgásmentes bélés</li><li>Cipzáros záródás</li><li>Könnyű, mégis tartós: Szivárgásálló, strapabíró anyagból készült, a legjobb könnyű hideg hátizsák piknikhez, országúti/parti kirándulásokhoz, túrázáshoz, kempingezéshez, horgászathoz, kerékpározáshoz, vadászathoz, tökéletes ajándék férfiaknak, nőknek.</li><li>Nagy hátizsák hűtő: 15,8\\\" x 11,8\\\" x 7,0\\\" (Ma x H x SZ), Súly: 1,6 font / 750 g, legalább 28 doboz, körülbelül 25 liter fér el, elegendő hely minden szükségleted számára.</li><li>Szivárgásmentes szigetelt hátizsák: A nagy sűrűségű szigetelőanyag és az ebédlő hátizsák belsejében lévő szivárgásmentes bélés együtt működik, hogy megakadályozza a szivárgást és 16 órán át hidegen tartsa az ételeket.</li><li>Több zseb: 1 fő tágas tárolórekesz, 1 cipzáras zseb a fedélen az ételek számára, 2 nagy elülső zseb az edények tárolására, 2 oldalsó hálós zseb, tökéletes piknik hátizsák hűtők mindennapi használatra.</li><li>Többfunkciós: Hőszigetelt hűtő hátizsákunk stílusos kialakítása révén ebéd-hátizsákként vagy napi csomagként is használható. Tökéletes ebédekhez, piknikekhez, munkához vagy utazáshoz.</li></ul>', '3019bec20220826125249.png', '2022-08-26 10:52:49'),
(60, 'Hátizsák hűtő szivárgásmentes 28 dobozos hűtő hátizsák szigetelt vízálló', '<ul><li>Anyaga: vízálló Oxford + nagy sűrűségű hab + szivárgásmentes bélés</li><li>Cipzáros záródás</li><li>Könnyű, mégis tartós: Szivárgásálló, strapabíró anyagból készült, a legjobb könnyű hideg hátizsák piknikhez, országúti/parti kirándulásokhoz, túrázáshoz, kempingezéshez, horgászathoz, kerékpározáshoz, vadászathoz, tökéletes ajándék férfiaknak, nőknek.</li><li>Nagy hátizsák hűtő: 15,8\\\\\\\" x 11,8\\\\\\\" x 7,0\\\\\\\" (Ma x H x SZ), Súly: 1,6 font / 750 g, legalább 28 doboz, körülbelül 25 liter fér el, elegendő hely minden szükségleted számára.</li><li>Szivárgásmentes szigetelt hátizsák: A nagy sűrűségű szigetelőanyag és az ebédlő hátizsák belsejében lévő szivárgásmentes bélés együtt működik, hogy megakadályozza a szivárgást és 16 órán át hidegen tartsa az ételeket.</li><li>Több zseb: 1 fő tágas tárolórekesz, 1 cipzáras zseb a fedélen az ételek számára, 2 nagy elülső zseb az edények tárolására, 2 oldalsó hálós zseb, tökéletes piknik hátizsák hűtők mindennapi használatra.</li><li>Többfunkciós: Hőszigetelt hűtő hátizsákunk stílusos kialakítása révén ebéd-hátizsákként vagy napi csomagként is használható. Tökéletes ebédekhez, piknikekhez, munkához vagy utazáshoz.</li></ul>', '0d0723a20220826131816.png', '2022-08-26 11:18:16'),
(61, 'Hátizsák hűtő szivárgásmentes 33 dobozos hűtő hátizsák szigetelt vízálló', '<ul><li>Szigetelt hűtő hátizsák: A szigetelt hátizsák belsejében lévő szigetelőanyag és a szivárgásmentes bélés együtt működik, hogy megakadályozza a szivárgást és 16 órán át hidegen/frissen tartsa az ételeket</li><li>Nagy kapacitás: TOUIT hátizsák hűtő, mérete 11 ⅓\\\" * 7 ¾\\\" * 16 ½\\\" (29 * 20 * 42 cm). Űrtartalom 24 liter (6,3 gallon), akár 33 doboz (355 ml) is elfér, elegendő hely élelmiszerek, italok becsomagolásához és a szükségleteit</li><li>Könnyű, de tartós: Vízálló, strapabíró oxford szövetből készült, nem könnyű tépni. Súlya 1,87 font / 850 g, párnázott részekkel a hátoldalon a legjobb kényelem érdekében. A legjobb könnyű hátizsák hűtővel munkához, piknikhez, országúti / tengerparti kirándulásokhoz, túrázáshoz, kempingezéshez, kerékpározáshoz</li><li>Több zseb: 1 fő rekesszel rendelkezik, hogy ételeit vagy italait frissen és hűvösen tartsa. 1 elülső hálós zseb és 1 elülső cipzáras zseb és 1 felső zseb apró tárgyak tárolására. 2 oldalzseb vizespalackok vagy italok tárolására. Az elülső elasztikus kötél a törölközők elhelyezésére alkalmas</li><li>Több funkció: </li></ul><ol><li class=\\\"ql-indent-1\\\">szigetelt hűtő hátizsákunk stílusos kialakítása miatt strandhátizsákként vagy napi csomagként is használható. </li><li class=\\\"ql-indent-1\\\">Tökéletes strandoláshoz, kempingezéshez, munkához, kirándulásokhoz, szabadban stb. Tökéletes ajándék férfiaknak, nőknek is</li></ol>', '5cdb0d220220826132805.png', '2022-08-26 11:28:05'),
(62, 'Hátizsák hűtő szivárgásmentes 33 dobozos hűtő hátizsák szigetelt vízálló', '<ul><li>Szigetelt hűtő hátizsák: A szigetelt hátizsák belsejében lévő szigetelőanyag és a szivárgásmentes bélés együtt működik, hogy megakadályozza a szivárgást és 16 órán át hidegen/frissen tartsa az ételeket</li><li>Nagy kapacitás: TOUIT hátizsák hűtő, mérete 11 ⅓\\\\\\\" * 7 ¾\\\\\\\" * 16 ½\\\\\\\" (29 * 20 * 42 cm). Űrtartalom 24 liter (6,3 gallon), akár 33 doboz (355 ml) is elfér, elegendő hely élelmiszerek, italok becsomagolásához és a szükségleteit</li><li>Könnyű, de tartós: Vízálló, strapabíró oxford szövetből készült, nem könnyű tépni. Súlya 1,87 font / 850 g, párnázott részekkel a hátoldalon a legjobb kényelem érdekében. A legjobb könnyű hátizsák hűtővel munkához, piknikhez, országúti / tengerparti kirándulásokhoz, túrázáshoz, kempingezéshez, kerékpározáshoz</li><li>Több zseb: 1 fő rekesszel rendelkezik, hogy ételeit vagy italait frissen és hűvösen tartsa. 1 elülső hálós zseb és 1 elülső cipzáras zseb és 1 felső zseb apró tárgyak tárolására. 2 oldalzseb vizespalackok vagy italok tárolására. Az elülső elasztikus kötél a törölközők elhelyezésére alkalmas</li><li>Több funkció: </li></ul><ol><li class=\\\"\\\\&quot;ql-indent-1\\\\&quot;\\\">szigetelt hűtő hátizsákunk stílusos kialakítása miatt strandhátizsákként vagy napi csomagként is használható. </li><li class=\\\"\\\\&quot;ql-indent-1\\\\&quot;\\\">Tökéletes strandoláshoz, kempingezéshez, munkához, kirándulásokhoz, szabadban stb. Tökéletes ajándék férfiaknak, nőknek is</li></ol>', 'fa753b620220826133343.png', '2022-08-26 11:33:43'),
(63, 'Hátizsák hűtő szivárgásmentes 35 dobozos hűtő hátizsák szigetelt vízálló', '<ul><li>Szivárgásmentes és szigetelt: A nagy sűrűségű szigetelőanyag és a szigetelt hűtő hátizsák belsejében lévő szivárgásmentes bélés együtt működnek, hogy biztosítsák a szivárgást, és 16 órán keresztül melegen/hidegen tartsák az ételeket. A belső bélés kiváló minőségű anyagból készült és könnyen tisztítható. Bármikor ihat hideg sört, ehet friss harapnivalókat vagy gyümölcsöt barátaival vagy családjával.</li><li>Nagy kapacitás és több rekesz: Szivárgásmentes hátizsák hűtő: 19\\\"x 13\\\"x 9\\\" (HxSzxM). A fő táska 35 doboz (27 liter) befogadására képes. A Maelstrom szigetelt hátizsák több zsebbel rendelkezik a praktikus tároláshoz és a kényelmes rendszerezéshez. Tágas hátizsák tágas cipzáras fő rekesszel, 1 felső cipzáras zsebbel, 1 elülső cipzáras zsebbel, 1 elülső elasztikus kötélhálóval, 1 elülső evőeszköztároló táskával, 2 hálós oldalzsebbel és egy rejtett hátsó cipzáras zsebbel, 1 vállpántos kártyazsebbel.</li><li>Ergonomikus és kényelmes kialakítás: A vastagabb, párnázott háttámla ergonomikus, légáteresztő kialakítással, valamint az állítható, lélegző és párnázott S vállpántokkal segít csökkenteni a fáradtságot egy hosszú utazási nap során. A hátizsák jégláda fogantyúval rendelkezik, amely munkatakarékos és tartós. Az állítható mellkasi csat tökéletesen elosztja a csomag súlyát, és stabilan és középen tartja. Mellkasi csat túlélősípként a gyors és egyszerű használat érdekében vészhelyzetben.</li><li>Egyedi funkciójú kialakítás: Két fűszeres palack helyezhető az edénytároló táska tetejére a könnyű hozzáférés érdekében. A vállpánt rozsdamentes acél sörnyitóval rendelkezik a sör és italok könnyű kinyitásához. A hátizsák bal oldalán öt hevedernyílás található a hálós táska felett, amelyekbe kulcsok, kulacsok és egyéb eszközök akaszthatók. A jobb oldali hálós táska felett egy állítható csat található, amely tökéletesen tartja a borosüveget. A vállpánt sztreccs zsinórral rendelkezik a napszemüveg felakasztásához.</li><li class=\\\"\\\\&quot;\\\\\\\\&quot;ql-indent-1\\\\\\\\&quot;\\\\&quot;\\\">Sokoldalú: Amellett, hogy kiváló puha hűtő szigetelt szivárgásmentes táskaként használják, tökéletes könnyű felszerelés ebéd hátizsákhoz, túra hátizsákhoz, kemping hátizsákhoz, horgász hátizsákhoz, utazó hátizsákhoz, vadászathoz, ösvényhez, kerékpározáshoz és egyéb szabadtéri tevékenységekhez. Férfiak és nők számára egyaránt alkalmas.</li></ul>', 'd3419e320220826134530.png', '2022-08-26 11:45:30'),
(64, 'Hátizsák hűtő szivárgásmentes 35 dobozos hűtő hátizsák szigetelt vízálló', '<ul><li>Szivárgásmentes és szigetelt: A nagy sűrűségű szigetelőanyag és a szigetelt hűtő hátizsák belsejében lévő szivárgásmentes bélés együtt működnek, hogy biztosítsák a szivárgást, és 16 órán keresztül melegen/hidegen tartsák az ételeket. A belső bélés kiváló minőségű anyagból készült és könnyen tisztítható. Bármikor ihat hideg sört, ehet friss harapnivalókat vagy gyümölcsöt barátaival vagy családjával.</li><li>Nagy kapacitás és több rekesz: Szivárgásmentes hátizsák hűtő: 19\\\\\\\"x 13\\\\\\\"x 9\\\\\\\" (HxSzxM). A fő táska 35 doboz (27 liter) befogadására képes. A Maelstrom szigetelt hátizsák több zsebbel rendelkezik a praktikus tároláshoz és a kényelmes rendszerezéshez. Tágas hátizsák tágas cipzáras fő rekesszel, 1 felső cipzáras zsebbel, 1 elülső cipzáras zsebbel, 1 elülső elasztikus kötélhálóval, 1 elülső evőeszköztároló táskával, 2 hálós oldalzsebbel és egy rejtett hátsó cipzáras zsebbel, 1 vállpántos kártyazsebbel.</li><li>Ergonomikus és kényelmes kialakítás: A vastagabb, párnázott háttámla ergonomikus, légáteresztő kialakítással, valamint az állítható, lélegző és párnázott S vállpántokkal segít csökkenteni a fáradtságot egy hosszú utazási nap során. A hátizsák jégláda fogantyúval rendelkezik, amely munkatakarékos és tartós. Az állítható mellkasi csat tökéletesen elosztja a csomag súlyát, és stabilan és középen tartja. Mellkasi csat túlélősípként a gyors és egyszerű használat érdekében vészhelyzetben.</li><li>Egyedi funkciójú kialakítás: Két fűszeres palack helyezhető az edénytároló táska tetejére a könnyű hozzáférés érdekében. A vállpánt rozsdamentes acél sörnyitóval rendelkezik a sör és italok könnyű kinyitásához. A hátizsák bal oldalán öt hevedernyílás található a hálós táska felett, amelyekbe kulcsok, kulacsok és egyéb eszközök akaszthatók. A jobb oldali hálós táska felett egy állítható csat található, amely tökéletesen tartja a borosüveget. A vállpánt sztreccs zsinórral rendelkezik a napszemüveg felakasztásához.</li><li class=\\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;ql-indent-1\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\\">Sokoldalú: Amellett, hogy kiváló puha hűtő szigetelt szivárgásmentes táskaként használják, tökéletes könnyű felszerelés ebéd hátizsákhoz, túra hátizsákhoz, kemping hátizsákhoz, horgász hátizsákhoz, utazó hátizsákhoz, vadászathoz, ösvényhez, kerékpározáshoz és egyéb szabadtéri tevékenységekhez. Férfiak és nők számára egyaránt alkalmas.</li></ul>', '7fca41e20220826140650.png', '2022-08-26 12:06:50'),
(65, 'Titan Guide sorozatú hűtő hátizsák', '<ul><li>Párnázott hátrész Cool Stream légáteresztő hálós panelekkel, állítható, párnázott pántokkal, valamint több belső és külső zsebbel</li><li>Deep Freeze nagy teljesítményű szigetelés - többrétegű rendszer, amely megvédi a jeget a legintenzívebb hőtől</li><li>A ColdBlock alap 3 vastag SuperFoam réteget tartalmaz, amelyek úgy vannak kialakítva, hogy távol tartsák a forró talaj vezető hőjét.</li><li>A szivárgásmentes Microban bélés véd a bakteriális szagok és foltok ellen, és megkönnyíti a termék tisztítását</li><li>A Rhino-Tech folt- és vízálló védőréteg kopás- és szúrásálló, és idővel nem reped meg</li></ul>', '0d7b53e20220826141757.png', '2022-08-26 12:17:57'),
(66, 'Számológép, standard funkciójú asztali számológép', '<ul><li>Kétirányú tápellátás: napelem (csak világosban működik) és elem (egy AA elem NEM tartozék). Megjegyzés: Győződjön meg arról, hogy egy AA elem van behelyezve a folyamatos és pontos használat érdekében</li><li>Nagy 12 számjegyű kijelző</li><li>Adó- és valutaváltás, funkció- és parancsjelek</li><li>Be és Ki gombok, Profit margin %, +,-, Key Rollover</li><li>Asztali számológép. A Helect ügyfélszolgálata</li></ul>', '327540520220826171453.png', '2022-08-26 15:14:53'),
(67, 'Számológép, standard funkciójú asztali számológép', '<ul><li>Kétirányú tápellátás: napelem (csak világosban működik) és elem (egy AA elem NEM tartozék). Megjegyzés: Győződjön meg arról, hogy egy AA elem van behelyezve a folyamatos és pontos használat érdekében</li><li>Nagy 12 számjegyű kijelző</li><li>Adó- és valutaváltás, funkció- és parancsjelek</li><li>Be és Ki gombok, Profit margin %, +,-, Key Rollover</li><li>Asztali számológép. A Helect ügyfélszolgálata</li></ul>', '0a9a4dc20220826171802.png', '2022-08-26 15:18:02'),
(68, 'Alapvető szabványos számológép 12 számjegyű asztali számológép nagy LCD kijelzővel irodai, iskolai, otthoni és üzleti használatra, modern dizájn', '<p>✔ Könnyen leolvasható számológép nagy LCD kijelzővel és 12 számjegyű kijelzővel</p><p>✔ Univerzális asztali számológép, nagyon alkalmas otthoni, irodai vagy bolti használatra</p><p>✔ Tartós ABS anyagból készült. Fehér, kék, rózsaszín, többféle divatstílus. Kompakt méret, kényelmes utazáshoz és táskákba csomagolásához</p><p>✔ Automatikus kikapcsolás, Független memória, M+, M-, végösszeg (GT), százalék (%)</p><p>✔ A kivehető műanyag gombok és a nagy rugalmasságú gombkialakítás megkönnyíti a bevitelt</p>', '2d0654920220826172604.png', '2022-08-26 15:26:04'),
(69, 'Alapvető szabványos számológép 12 számjegyű asztali számológép nagy LCD kijelzővel irodai, iskolai, otthoni és üzleti használatra, modern dizájn', '<p>✔ Könnyen leolvasható számológép nagy LCD kijelzővel és 12 számjegyű kijelzővel</p><p>✔ Univerzális asztali számológép, nagyon alkalmas otthoni, irodai vagy bolti használatra</p><p>✔ Tartós ABS anyagból készült. Fehér, kék, rózsaszín, többféle divatstílus. Kompakt méret, kényelmes utazáshoz és táskákba csomagolásához</p><p>✔ Automatikus kikapcsolás, Független memória, M+, M-, végösszeg (GT), százalék (%)</p><p>✔ A kivehető műanyag gombok és a nagy rugalmasságú gombkialakítás megkönnyíti a bevitelt</p>', '380471620220826172956.png', '2022-08-26 15:29:56'),
(70, 'Számológép, normál funkciós alapszámítások, napelemes, kettős teljesítményű irodai számológép fedéllel, fém panel', '<ul><li>A mini méretű zsebszámológép üzleti utazásokhoz alkalmas</li><li>A 8 számjegyű nagy LCD kijelző és a fém panel hosszú élettartamot biztosít</li><li>Kettős tápellátás, napelem és akkumulátor (cella elemmel együtt), napelem funkció még félhomályban is működik</li><li>Az emberi szokásokhoz igazodó puha gumi gombkialakítás, kényelmes tapintású</li><li>PP burkolattal rendelkezik, amely megvédi a billentyűzetet és a képernyőt a karcolásoktól</li></ul>', '4d3014420220826174641.png', '2022-08-26 15:46:41'),
(71, 'Modern, századközép oldalsó szék étkezőszék természetes fa lábakkal konyhába, nappaliba, étkezőbe, 1 darabos készlet', '<ul><li>Kivitel: Ergonomikus kialakítás, tökéletes magasság és hajlított ülés jól megtámasztja a felhasználó hátát ülés közben, és könnyű beszélgetést tesz lehetővé</li><li>ERŐS FELÉPÍTÉS: Jól készült és tartósan megépített. Fekete támasztékok biztosítják a stabilitást. Gyönyörű és elegáns kiegészítője lehet bármely helyiségnek.</li><li>Modern stílus: Modern dizájn, egyszerű, de stílusos. Tökéletes minden helyzetre, pl. nappali, étkező, iroda, váróterem és party.</li><li>Ideális otthoni és irodai használatra - nappali, étkező, hálószoba, előcsarnok, recepció, várótermek és bankettek.</li><li>Ha bármilyen kérdése van, forduljon hozzánk bizalommal e-mailben, és azonnal kielégítő megoldást adunk Önnek.</li></ul>', '69bb20420220826175601.png', '2022-08-26 15:56:01'),
(72, 'Modern, századközép oldalsó szék étkezőszék természetes fa lábakkal konyhába, nappaliba, étkezőbe, 1 darabos készlet', '<ul><li>Kivitel: Ergonomikus kialakítás, tökéletes magasság és hajlított ülés jól megtámasztja a felhasználó hátát ülés közben, és könnyű beszélgetést tesz lehetővé</li><li>ERŐS FELÉPÍTÉS: Jól készült és tartósan megépített. Fekete támasztékok biztosítják a stabilitást. Gyönyörű és elegáns kiegészítője lehet bármely helyiségnek.</li><li>Modern stílus: Modern dizájn, egyszerű, de stílusos. Tökéletes minden helyzetre, pl. nappali, étkező, iroda, váróterem és party.</li><li>Ideális otthoni és irodai használatra - nappali, étkező, hálószoba, előcsarnok, recepció, várótermek és bankettek.</li><li>Ha bármilyen kérdése van, forduljon hozzánk bizalommal e-mailben, és azonnal kielégítő megoldást adunk Önnek.</li></ul>', 'e5ec38f20220826175854.png', '2022-08-26 15:58:54'),
(73, 'Ergonomikus, légáteresztő, hálós, forgó íróasztalszék állítható magasságú és deréktámasztó karfával otthoni, irodai és tanulmányi használatra', '<ul><li>Középtámlájú, gurulós forgószék, ideális otthoni és irodai használatra, és kényelmes, 8 órás ülésélményt biztosít</li><li>A modern, karcsú kialakítás acélhengerrel és tömör görgős kerekekkel stabil és robusztus ülést biztosít otthoni irodájában</li><li>A 120 fokban állítható háttámla tökéletesen illeszkedik a test vonalához, és támogatja gerincének természetes ívét; 360 fokos elforgatás</li><li>Az integrált deréktáji párna extra párnázást biztosít a munkával összefüggő sérülések megelőzésében és a stressz csökkentésében; Egyedülálló ringatási mód a fokozott ellazulásért</li><li>Légáteresztő hálós felülettel rendelkezik, amely lehetővé teszi a levegő áthaladását a háttámlán, és hűvös marad</li></ul>', 'fe77fa320220826180810.png', '2022-08-26 16:08:10'),
(74, 'Ergonomikus, légáteresztő, hálós, forgó íróasztalszék állítható magasságú és deréktámasztó karfával otthoni, irodai és tanulmányi használatra', '<ul><li>Középtámlájú, gurulós forgószék, ideális otthoni és irodai használatra, és kényelmes, 8 órás ülésélményt biztosít</li><li>A modern, karcsú kialakítás acélhengerrel és tömör görgős kerekekkel stabil és robusztus ülést biztosít otthoni irodájában</li><li>A 120 fokban állítható háttámla tökéletesen illeszkedik a test vonalához, és támogatja gerincének természetes ívét; 360 fokos elforgatás</li><li>Az integrált deréktáji párna extra párnázást biztosít a munkával összefüggő sérülések megelőzésében és a stressz csökkentésében; Egyedülálló ringatási mód a fokozott ellazulásért</li><li>Légáteresztő hálós felülettel rendelkezik, amely lehetővé teszi a levegő áthaladását a háttámlán, és hűvös marad</li></ul>', 'cf7008c20220826180952.png', '2022-08-26 16:09:52'),
(75, 'Ergonomikus irodai rajzoló számítógépes asztali szék felhajtható és állítható magasságú karokkal', '<ul><li>Funkció – A kartámasz billenthető, állítható hátradőlés. A lábak a lábgyűrűre helyezhetők, hogy csökkentsék a lábak ellenállását és csökkentsék a csípőre nehezedő nyomást, ami enyhítheti a hosszan tartó ülés okozta fáradtságot.</li><li>Háttámla és ülés – A hálós háttámla és a hálós ülés biztosítja a légáramlást az extra kényelem érdekében. A kiváló minőségű háló rugalmas és ellenáll a kopásnak és a deformációnak.</li><li>Lábgyűrű – A lábgyűrűt az igényeinek megfelelően megfelelő magasságba állíthatja. A lábgyűrű acélból készült a jó tartósság érdekében.</li><li>Ergonomikus háttámla - Egyedülálló háttámla kialakítás. A hát jól illeszkedik a gerincéhez, és jelentősen enyhíti a fáradtságot és a hátfájást.</li><li>Irodai méretek - 26,77\\\"Sz x 22,44\\\"Mé x 43,70\\\"-50,94\\\"Ma.</li><li>Garancia és értékesítés utáni szolgáltatás – Az irodai asztali szék garanciája 36 hónap. Az Amazon értékesítés utáni szolgáltatást nyújthat, megoldhatja a vásárlók által igényelt csatornákat, és bármikor visszatérítheti vagy kicserélheti a terméket.</li></ul>', '23b991920220826181639.png', '2022-08-26 16:16:39'),
(76, 'Vezeték nélküli egér, Pro 2.4G Ergonomikus vezeték nélküli optikai egér USB nano vevővel laptophoz, PC-hez, számítógéphez, Chromebookhoz, notebookhoz, 6 gomb, 24 hónapos akkumulátor-élettartam, 2600 DPI, 5 beállítási fokozat', '<ul><li>Plug &amp; Play: A vezeték nélküli egérhez tartozik egy apró USB Nano vevő (az egér hátulján található), csatlakoztassa a számítógépéhez, majd felejtse el. Az 5 állítható DPI-szinttel (2600-2000-1600-1200-800) szabadon választhatja meg a kurzor sebességét.</li><li>2,4 GHz-es számítógépes egér: Megbízható kapcsolatot biztosít akár 15 méteres (50 láb) megnövelt munkatávolsággal, és kiküszöböli a késéseket, a kimaradásokat és az interferenciát. Ergonómikus egér kontúros formájával és puha gumi markolatával egész napos kényelmet biztosít.</li><li>TECKNET Tru-Wave technológia: A vezeték nélküli játék egér precíz, intelligens kurzorvezérlést biztosít számos felülettípuson. TECKNET Co-Link technológia – nincs szükség a párosítás újbóli létrehozására, ha a jel elveszik vagy leáll.</li><li>Problémamentes kialakítás: A laptophoz készült vezeték nélküli egér intelligens automatikus alvó üzemmóddal rendelkezik az energiatakarékosság érdekében, és akár 24 hónapos akkumulátor-élettartamot is biztosít az akkumulátor töltöttségi szintjét jelző kijelzővel. (az akkumulátor élettartama a felhasználó és a számítási feltételek függvényében változhat).</li><li>Széleskörű kompatibilitás: az USB egér kompatibilis a Windows XP, Vista, 7, 8, 8.1, 10, Mac OS (az oldalsó gombok nem állnak rendelkezésre) és Linux operációs rendszerekkel. Működik notebook, Chromebook, PC, laptop, számítógép és sok más eszközzel. (az elemeket NEM tartalmazza)</li></ul>', '53f25fe20220826201617.png', '2022-08-26 18:16:17'),
(77, 'Vezeték nélküli egér, Pro 2.4G Ergonomikus vezeték nélküli optikai egér USB nano vevővel laptophoz, PC-hez, számítógéphez, Chromebookhoz, notebookhoz, 6 gomb, 24 hónapos akkumulátor-élettartam, 2600 DPI, 5 beállítási fokozat', '<ul><li>Plug &amp; Play: A vezeték nélküli egérhez tartozik egy apró USB Nano vevő (az egér hátulján található), csatlakoztassa a számítógépéhez, majd felejtse el. Az 5 állítható DPI-szinttel (2600-2000-1600-1200-800) szabadon választhatja meg a kurzor sebességét.</li><li>2,4 GHz-es számítógépes egér: Megbízható kapcsolatot biztosít akár 15 méteres (50 láb) megnövelt munkatávolsággal, és kiküszöböli a késéseket, a kimaradásokat és az interferenciát. Ergonómikus egér kontúros formájával és puha gumi markolatával egész napos kényelmet biztosít.</li><li>TECKNET Tru-Wave technológia: A vezeték nélküli játék egér precíz, intelligens kurzorvezérlést biztosít számos felülettípuson. TECKNET Co-Link technológia – nincs szükség a párosítás újbóli létrehozására, ha a jel elveszik vagy leáll.</li><li>Problémamentes kialakítás: A laptophoz készült vezeték nélküli egér intelligens automatikus alvó üzemmóddal rendelkezik az energiatakarékosság érdekében, és akár 24 hónapos akkumulátor-élettartamot is biztosít az akkumulátor töltöttségi szintjét jelző kijelzővel. (az akkumulátor élettartama a felhasználó és a számítási feltételek függvényében változhat).</li><li>Széleskörű kompatibilitás: az USB egér kompatibilis a Windows XP, Vista, 7, 8, 8.1, 10, Mac OS (az oldalsó gombok nem állnak rendelkezésre) és Linux operációs rendszerekkel. Működik notebook, Chromebook, PC, laptop, számítógép és sok más eszközzel. (az elemeket NEM tartalmazza)</li></ul>', '5ec71f920220826202644.png', '2022-08-26 18:26:44'),
(78, '2.4 G vezeték nélküli egér, 1200 DPI mobil optikai vezeték nélküli egér USB vevővel, hordozható számítógépes egér vezeték nélküli egér laptophoz, PC-hez, asztali számítógéphez, MacBookhoz, 5 gomb', '<ul><li>【MAXIMÁLIS KÉZÉRZÉS】 A modern kontúros forma, az izzadságálló és bőrbarát felület a maximális kényelemért és támogatásért. Az átgondolt gyűrű és a kisujjtámasz extra kényelmet biztosít. A robusztus, gumival ellátott görgő gondoskodik arról, hogy a keze ne csússzon el görgetés közben.</li><li>【PLUG &amp; PLAY SZUPER KÖNNYŰ HASZNÁLAT】 Valóban plug &amp; play kialakítás, nem kell illesztőprogramot telepíteni. A 2,4 GHz-es vezeték nélküli átviteli technológia erőteljes és megbízható kapcsolatot biztosít 43,0 lábig. A hordozható kialakítás megkönnyíti a táskában való tárolását. Ez a legjobb egér ajándéknak.</li><li>【ERŐS TARTÓSSÁG ÉS HOSSZÚ MŰKÖDÉSI TÁVOLSÁG】 6 000 000-szeres billentyűleütési tesztet teljesített, hogy garantálja az extra tartósságot. A 2,4 GHz-es vezeték nélküli technológia és a professzionális chip hosszabb munkatávolságot biztosít.</li><li>【RENDKÍVÜL ALACSONY FELFOGYASZTÁS】 Ennek a vezeték nélküli egérnek a működtetéséhez 2 AAA elem szükséges (nem tartozék), és 7 perc inaktivitás után alvó módba kapcsol az energiatakarékosság érdekében, és bármely gomb megnyomásával egyszerűen aktiválható.</li><li>【SZÉLES KOMPATIBILITÁS】 Jól kompatibilis a Windows 7/8/10/XP, Vista 7/8, Mac és Linux operációs rendszerekkel stb. Vezeték nélküli számítógépes egér laptophoz, asztali számítógéphez, PC-hez, Macbookhoz és egyéb eszközökhöz. Ez a vezeték nélküli egér 45 napos pénz-visszatérítést és 365 napos gondtalan garanciát élvez. Megjegyzés: az oldalsó gombok nem érhetők el Mac OS rendszeren, de a másik funkció normál módon használható.</li></ul>', 'cfe97a820220826203507.png', '2022-08-26 18:35:07'),
(79, 'Apple Magic Mouse', '<ul><li>A Magic Mouse vezeték nélküli és újratölthető, optimalizált lábkialakításával simán csúszik az asztalon.</li><li>A Multi-Touch felület lehetővé teszi egyszerű gesztusok végrehajtását, például lapozást a weboldalak között és a dokumentumok görgetését.</li><li>A hihetetlenül hosszú élettartamú belső akkumulátor körülbelül egy hónapig vagy még tovább táplálja a Magic Mouse-t a töltések között.</li><li>A dobozból azonnal kivehető, és automatikusan párosítható a Mac géppel, és tartalmaz egy szőtt USB-C-Lightning kábelt, amely lehetővé teszi a párosítást és a töltést a Mac USB-C portjához csatlakoztatva.</li><li>Rendszerkövetelmények: Bluetooth-kompatibilis Mac OS X 10.11 vagy újabb rendszerrel, iPad iPadOS 13.4 vagy újabb verzióval</li></ul>', 'f6720c620220826204744.png', '2022-08-26 18:47:44'),
(82, 'Apple Magic Mouse', '<ul><li>A Magic Mouse vezeték nélküli és újratölthető, optimalizált lábkialakításával simán csúszik az asztalon.</li><li>A Multi-Touch felület lehetővé teszi egyszerű gesztusok végrehajtását, például lapozást a weboldalak között és a dokumentumok görgetését.</li><li>A hihetetlenül hosszú élettartamú belső akkumulátor körülbelül egy hónapig vagy még tovább táplálja a Magic Mouse-t a töltések között.</li><li>A dobozból azonnal kivehető, és automatikusan párosítható a Mac géppel, és tartalmaz egy szőtt USB-C-Lightning kábelt, amely lehetővé teszi a párosítást és a töltést a Mac USB-C portjához csatlakoztatva.</li><li>Rendszerkövetelmények: Bluetooth-kompatibilis Mac OS X 10.11 vagy újabb rendszerrel, iPad iPadOS 13.4 vagy újabb verzióval</li></ul>', '3f7195920220828180106.png', '2022-08-28 16:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `products__category`
--

CREATE TABLE `products__category` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `tags` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `products__category`
--

INSERT INTO `products__category` (`id`, `pid`, `category`, `tags`) VALUES
(1, 1, 'Számológépek', 'Számológép,Tudományos,Fekete, Napelemes'),
(2, 2, 'Számológépek', 'Számológép,Tudományos,Kék, Napelemes'),
(3, 3, 'Számológépek', 'Számológép,Tudományos,Fehér,Napelemes'),
(4, 4, 'Számológépek', 'Számológép,Tudományos,Rózsaszín,Napelemes'),
(5, 5, 'Számológépek', 'Számológép,Tudományos,Fekete,Napelemes'),
(6, 6, 'Számológépek', 'Számológép,Tudományos,Fehér,Napelemes'),
(7, 7, 'Számológépek', 'Számológép,Tudományos,Rózsaszín,Napelemes'),
(8, 8, 'Irodai székek', 'Szék, Irodai szék, Székek, Elegáns, Guruló szék, Forgó szék'),
(9, 9, 'Irodai székek', 'Szék, Irodai szék, Székek, Elegáns, Guruló szék, Forgó szék'),
(10, 10, 'Irodai székek', 'Szék, Irodai szék, Székek, Elegáns, Guruló szék, Forgó szék'),
(11, 11, 'Irodai székek', 'Szék, Irodai szék, Székek, Elegáns, Guruló szék, Forgó szék'),
(12, 12, 'Irodai egerek', 'Egér, Egerek, Irodai egerek, Vezetéknélküli egér, Gaming Egér'),
(13, 13, 'Irodai egerek', 'Egér, Egerek, Irodai egerek, Vezetéknélküli egér, Gaming Egér'),
(32, 54, 'Irodai egerek', 'Irodai egér,Vezeték nélküli,Népszerű,Új termék'),
(33, 55, 'Irodai egerek', 'Irodai egér,Vezeték nélküli,Népszerű,Új termék'),
(34, 56, 'Hátizsákok', 'Hátizsák,Vízálló,Szigetelt,Könnyű'),
(35, 57, 'Hátizsákok', 'Hátizsák,Vízálló,Szigetelt,Könnyű'),
(36, 58, 'Hátizsákok', 'Hátizsák,Vízálló,Szigetelt,Könnyű'),
(37, 59, 'Hátizsákok', 'Új termék,Népszerű,Hátizsák,Vízálló,Vízlepergető'),
(38, 60, 'Hátizsákok', 'Új termék,Népszerű,Hátizsák,Vízálló,Vízlepergető'),
(39, 61, 'Hátizsákok', 'Új termék,Népszerű,Hátizsák,Vízálló,Vízlepergető'),
(40, 62, 'Hátizsákok', 'Új termék,Népszerű,Hátizsák,Vízálló,Vízlepergető'),
(41, 63, 'Hátizsákok', 'Új termék,Népszerű,Hátizsák,Vízálló,Vízlepergető'),
(42, 64, 'Hátizsákok', 'Új termék,Népszerű,Hátizsák,Vízálló,Vízlepergető'),
(43, 65, 'Hátizsákok', 'Új termék,Népszerű,Hátizsák,Vízálló,Vízlepergető'),
(44, 66, 'Számológépek', 'Számológép,Tudományos,Fekete,Napelemes'),
(45, 67, 'Számológépek', 'Számológép,Fekete,Napelemes'),
(46, 68, 'Számológépek', 'Számológép,Napelemes,Asztali számológép,Szabványos számológép'),
(47, 69, 'Számológépek', 'Számológép,Napelemes,Asztali számológép,Szabványos számológép'),
(48, 70, 'Számológépek', 'Számológép,Hagyományos számológép,Fekete,Napelemes'),
(49, 71, 'Irodai székek', 'Szék,Irodai szék,Székek,Elegáns'),
(50, 72, 'Irodai székek', 'Szék,Irodai szék,Székek,Elegáns'),
(51, 73, 'Irodai székek', 'Szék,Irodai szék,Székek,Elegáns'),
(52, 74, 'Irodai székek', 'Szék,Irodai szék,Székek,Elegáns'),
(53, 75, 'Irodai székek', 'Szék,Irodai szék,Székek,Elegáns'),
(54, 76, 'Irodai egerek', 'Irodai egér,Vezeték nélküli,Népszerű,Új termék'),
(55, 77, 'Irodai egerek', 'Irodai egér,Vezeték nélküli,Népszerű,Új termék'),
(56, 78, 'Irodai egerek', 'Irodai egér,Vezeték nélküli,Népszerű'),
(57, 79, 'Irodai egerek', 'Irodai egér,Vezeték nélküli,Népszerű,Új termék'),
(60, 82, 'Irodai egerek', 'Irodai egér,Vezeték nélküli,Népszerű,Új termék');

-- --------------------------------------------------------

--
-- Table structure for table `products__inventory`
--

CREATE TABLE `products__inventory` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `code` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `quantity` int NOT NULL,
  `q__warehouse` int NOT NULL,
  `unit` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `backorder` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `products__inventory`
--

INSERT INTO `products__inventory` (`id`, `pid`, `code`, `quantity`, `q__warehouse`, `unit`, `backorder`) VALUES
(1, 1, 'TI-30XIIS-FEK', 2, 50, 'Darab', 0),
(2, 2, 'TI-30XIIS-KEK', 0, 34, 'Darab', 0),
(3, 3, 'TI-30XIIS-FEH', 30, 50, 'Darab', 0),
(4, 4, 'TI-30XIIS-ROZ', 30, 50, 'Darab', 0),
(5, 5, 'CA-FX115ESPLUS2-FEK', 30, 50, 'Darab', 0),
(6, 6, 'CA-FX115ESPLUS2-FEH', 30, 50, 'Darab', 0),
(7, 7, 'CA-FX115ESPLUS2-ROZ', 30, 50, 'Darab', 0),
(8, 8, '‎AMZN1512-ELE', 30, 50, 'Darab', 0),
(9, 9, 'OSP-HF-ABV', 30, 50, 'Darab', 0),
(10, 10, 'OSP-HF-BLV', 30, 50, 'Darab', 0),
(11, 11, 'OSP-HF-OYV', 30, 50, 'Darab', 0),
(12, 12, 'AMI-RWGM-BLA', 30, 50, 'Darab', 0),
(13, 13, 'AMI-RWGM-WHI', 30, 50, 'Darab', 0),
(29, 54, 'VSWM-S001', 30, 30, 'Darab', 0),
(30, 55, 'VSWM-S002', 30, 30, 'Darab', 0),
(31, 56, 'TR0260-FUS', 30, 30, 'Darab', 0),
(32, 57, 'TR0260-GRY', 30, 30, 'Darab', 0),
(33, 58, 'TR0260-TDB', 30, 30, 'Darab', 0),
(34, 59, 'TBC-28-GRG', 30, 30, 'Darab', 0),
(35, 60, 'TBC-28-LTG', 30, 30, 'Darab', 0),
(36, 61, 'TBC-CBI-850-BLC', 30, 30, 'Darab', 0),
(37, 62, 'TBC-CBI-850-BLU', 30, 30, 'Darab', 0),
(38, 63, 'MLS-CBL-ORN', 30, 30, 'Darab', 0),
(39, 64, 'MLS-CBL-GRN', 30, 30, 'Darab', 0),
(40, 65, 'ARZ-NEO-BLU', 30, 30, 'Darab', 0),
(41, 66, 'H1001-CLC-BK', 30, 50, 'Darab', 0),
(42, 67, 'H1001-CLC-GR', 30, 50, 'Darab', 0),
(43, 68, 'EOCO-CLC-GR', 30, 50, 'Darab', 1),
(44, 69, 'EOCO-CLC-PN', 30, 50, 'Darab', 0),
(45, 70, 'DL-BSCL-BL', 30, 50, 'Darab', 0),
(46, 71, 'KU-191-WHT', 30, 50, 'Darab', 0),
(47, 72, 'KU-191-BLK', 30, 50, 'Darab', 0),
(48, 73, 'SMU-AIM-GRY', 30, 50, 'Darab', 0),
(49, 74, 'SMU-AIM-BLK', 30, 50, 'Darab', 0),
(50, 75, 'HMS8805D-BLK', 30, 50, 'Darab', 0),
(51, 76, 'B015NBTMMC-BLK', 30, 30, 'Darab', 0),
(52, 77, 'B015NBTMMC-BLU', 30, 30, 'Darab', 0),
(53, 78, 'B07WCW1-RED', 30, 31, 'Darab', 0),
(54, 79, 'APPL-MM-WH', 30, 30, 'Darab', 0),
(57, 82, 'APPL-MM-BL', 30, 30, 'Darab', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products__media`
--

CREATE TABLE `products__media` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `images` varchar(4096) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `products__media`
--

INSERT INTO `products__media` (`id`, `pid`, `images`) VALUES
(1, 1, 'md1d2267f2202208203104700.png,md2d2267f2202208203104700.png,md3d2267f2202208203104700.png,md4d2267f2202208203104700.png'),
(2, 2, 'md1d8223c020220417223255.png'),
(3, 3, 'md1d7223c020220417223255.png,md2d7223c020220417223255.png'),
(4, 4, 'md1d6223c020220417223255.png'),
(5, 5, 'md1a063a0320220417223051.png,md2a063a0320220417223051.png'),
(6, 6, 'md1b063a0320220417223051.png'),
(7, 7, 'md1c063a0320220417223051.png'),
(8, 8, 'md165f632420220417222404.png,md265f632420220417222404.png,md365f632420220417222404.png,md465f632420220417222404.png,md565f632420220417222404.jpg'),
(9, 9, 'md1cf9461f20220417215208.png,md2cf9461f20220417215208.png,md3cf9461f20220417215208.png,md4cf9461f20220417215208.png,md5cf9461f20220417215208.png'),
(10, 10, 'md1df9461f20220417215208.png,md2df9461f20220417215208.png,md3df9461f20220417215208.png,md4df9461f20220417215208.png,md5df9461f20220417215208.png'),
(11, 11, 'md1ef9461f20220417215208.png,md2ef9461f20220417215208.png,md3ef9461f20220417215208.png'),
(12, 12, 'md1mc5bc8020220423141900.png,md2mc5bc8020220423141900.png,md3mc5bc8020220423141900.png,md4mc5bc8020220423141900.png,md5mc5bc8020220423141900.png'),
(13, 13, 'md1oc5bc8020220423141900.png,md2oc5bc8020220423141900.png,md3oc5bc8020220423141900.png,md4oc5bc8020220423141900.png'),
(27, 54, 'a7ccd1f20220825220111.jpeg,c15a32920220825220111.jpeg,f45bdb520220825220111.jpeg,af8f76620220825220111.jpeg'),
(28, 55, 'c837cf320220825221715.jpeg,e471bc520220825221715.jpeg,a0d9c2120220825221715.jpeg,540489e20220825221715.jpeg,a19681920220825221715.jpeg'),
(29, 56, '7bd23ae20220825224440.jpeg,adfd16320220825224440.jpeg,d79da4320220825224440.jpeg,22825bb20220825224440.png,ff49a1220220825224440.jpeg'),
(30, 57, 'faa6ff020220826124036.png,f69bd4520220826124036.jpeg'),
(31, 58, '31a8f3f20220826124441.png,1dda59420220826124441.jpeg'),
(32, 59, 'b8b88be20220826125249.jpeg,4b9269f20220826125249.jpeg'),
(33, 60, 'e4f501520220826131816.png,4c0588a20220826131816.jpeg,2ee166a20220826131816.png,0372e8c20220826131816.jpeg'),
(34, 61, 'b3e614020220826132805.png,91c50a620220826132805.png,4de1bb620220826132805.jpeg'),
(35, 62, 'c25b5c320220826133343.png,14e638320220826133343.png,2711a5920220826133343.jpeg'),
(36, 63, 'd3419e320220826134530.png,382db9620220826134530.png'),
(37, 64, '7fca41e20220826140650.png,127857e20220826140650.png'),
(38, 65, '1f6d7b620220826141757.png,1d1b4ef20220826141757.png,991dfb320220826141757.png,121010c20220826141757.png,2c2dabb20220826141757.png'),
(39, 66, '36b0e1b20220826171453.jpeg,3b62ae320220826171453.jpeg,67127a620220826171453.jpeg,d8eed2720220826171453.jpeg'),
(40, 67, 'fe1477c20220826171802.jpeg,59fe4e920220826171802.jpeg,860250820220826171802.jpeg,5ef10e420220826171802.jpeg'),
(41, 68, '22d52f820220826172604.jpeg,1275c3720220826172604.jpeg,3b0e8fe20220826172604.jpeg'),
(42, 69, '007460e20220826172956.jpeg,215a8bc20220826172956.jpeg,6b0b91e20220826172956.jpeg'),
(43, 70, '4cae2a220220826174641.jpeg,174c8c620220826174641.jpeg,5e2effe20220826174641.jpeg'),
(44, 71, '5e38cb420220826175601.jpeg,f87eb5920220826175601.jpeg,aa3e7b120220826175601.jpeg'),
(45, 72, '084e7f520220826175854.png,5ac2bcc20220826175854.jpeg,b6f69ae20220826175854.jpeg'),
(46, 73, '386b02520220826180810.jpeg,ea497c420220826180810.jpeg,acfbce420220826180810.jpeg'),
(47, 74, '2aeae2620220826180952.jpeg,5540b7920220826180952.jpeg,d382c0920220826180952.jpeg'),
(48, 75, 'ff7aaf520220826181639.png,b74157a20220826181639.png,a71ef3b20220826181639.jpeg,cb376bf20220826181639.jpeg'),
(49, 76, '2d1ba0020220826201617.png,564e68f20220826201617.png,b498b2120220826201617.png,f792e0d20220826201617.jpeg,9a5a73020220826201617.jpeg'),
(50, 77, '1fc558d20220826202644.png,79a543720220826202644.png,7437b9120220826202644.png,8e0728620220826202644.jpeg,8a073ff20220826202644.jpeg'),
(51, 78, '504ef2820220829220900.jpeg,2b4c06d20220829220900.jpeg,9898c2c20220829220900.jpeg,0ed141720220829220900.jpeg,ab1c72f20220829220900.jpeg'),
(52, 79, '9633eaf20220826204744.png,1f1299a20220826204744.png,8ee7a8e20220826204744.png,5b36e5820220826204744.png'),
(55, 82, '7bd4a0b20220828182052.png,362338d20220828182052.png,db5c4fe20220828182052.png,b5c68ed20220828182052.png');

-- --------------------------------------------------------

--
-- Table structure for table `products__meta`
--

CREATE TABLE `products__meta` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `description` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `keywords` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `products__meta`
--

INSERT INTO `products__meta` (`id`, `pid`, `title`, `description`, `keywords`) VALUES
(1, 1, 'Termékleírás', 'Robusztus, professzionális tudományos számológép. 2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt.', 'Számológép, Tudományos Számológép, Napelemes Számológép, Fekete Számológép'),
(2, 2, 'Termékleírás', 'Robusztus, professzionális tudományos számológép. 2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt.', 'Számológép, Tudományos Számológép, Napelemes Számológép, Kék Számológép'),
(3, 3, 'Termékleírás', 'Robusztus, professzionális tudományos számológép. 2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt.', 'Számológép, Tudományos Számológép, Napelemes Számológép, Fehér Számológép'),
(4, 4, 'Termékleírás', 'Robusztus, professzionális tudományos számológép. 2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt.', 'Számológép, Tudományos Számológép, Napelemes Számológép, Fehér Számológép'),
(5, 5, 'Termékleírás', 'Robusztus, professzionális tudományos számológép. 2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt.', 'Számológép, Tudományos Számológép, Napelemes Számológép, Fekete Számológép'),
(6, 6, 'Termékleírás', 'Robusztus, professzionális tudományos számológép. 2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt.', 'Számológép, Tudományos Számológép, Napelemes Számológép, Fehér Számológép'),
(7, 7, 'Termékleírás', 'Robusztus, professzionális tudományos számológép. 2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt.', 'Számológép, Tudományos Számológép, Napelemes Számológép, Rózsaszín Számológép'),
(8, 8, 'Termékleírás', 'Plüss üléss és háttámlás kényelmes irodai forgósszék', 'Szék, Irodai szék, Székek, Elegáns, Guruló szék, Forgó szék'),
(9, 9, 'Termékleírás', 'Plüss üléss és háttámlás kényelmes irodai forgósszék', 'Szék, Irodai szék, Székek, Elegáns, Guruló szék, Forgó szék'),
(10, 10, 'Termékleírás', 'Plüss üléss és háttámlás kényelmes irodai forgósszék', 'Szék, Irodai szék, Székek, Elegáns, Guruló szék, Forgó szék'),
(11, 11, 'Termékleírás', 'Plüss üléss és háttámlás kényelmes irodai forgósszék', 'Szék, Irodai szék, Székek, Elegáns, Guruló szék, Forgó szék'),
(12, 12, 'Termékleírás', 'Vezetéknélküli Irodai Egér 2400 Dpi', 'Egér, Egerek, Irodai Egér, Vezetéknélküli egér, Gaming Egér'),
(13, 13, 'Termékleírás', 'Vezetéknélküli Irodai Egér 2400 Dpi', 'Egér, Egerek, Irodai Egér, Vezetéknélküli egér, Gaming Egér'),
(26, 54, 'Termékleírás', 'Vezetéknélküli Irodai Egér halk kattintás, fekete és arany színű. 2.4G csatlakozás. Ergonomikus tervezés.', 'Egér,Egerek,Irodai Egér,Vezetéknélküli egér,Gaming Egér'),
(27, 55, 'Termékleírás', 'Vezetéknélküli Irodai Egér halk kattintás, fekete és arany színű. 2.4G csatlakozás. Ergonomikus tervezés.', 'Egér,Egerek,Irodai Egér,Vezetéknélküli egér,Gaming Egér'),
(28, 56, 'Termékleírás', 'Akár nagy érdeklődést mutat az országúti/tengerparti kirándulások, piknikek vagy napi túrák iránt, a TOURIT hátizsákos hűtő a legjobb partnere minden típusú szabadtéri tevékenységhez.Hőszigetelt hátizsákunk stílusos kialakításának köszönhetően ebéd-hátizsákként vagy napi csomagként is használható.', 'Hátizsák,Vízálló hátizsák,Fekete hátizsák,Hátizsák túrázásra'),
(29, 57, 'Termékleírás', 'Akár nagy érdeklődést mutat az országúti/tengerparti kirándulások, piknikek vagy napi túrák iránt, a TOURIT hátizsákos hűtő a legjobb partnere minden típusú szabadtéri tevékenységhez.Hőszigetelt hátizsákunk stílusos kialakításának köszönhetően ebéd-hátizsákként vagy napi csomagként is használható.', 'Hátizsák,Vízálló hátizsák,Fekete hátizsák,Hátizsák túrázásra'),
(30, 58, 'Termékleírás', 'Akár nagy érdeklődést mutat az országúti/tengerparti kirándulások, piknikek vagy napi túrák iránt, a TOURIT hátizsákos hűtő a legjobb partnere minden típusú szabadtéri tevékenységhez.Hőszigetelt hátizsákunk stílusos kialakításának köszönhetően ebéd-hátizsákként vagy napi csomagként is használható.', 'Hátizsák,Vízálló hátizsák,Fekete hátizsák,Hátizsák túrázásra'),
(31, 59, 'Termékleírás', 'Akár nagy érdeklődést mutat az országúti/tengerparti kirándulások, piknikek vagy napi túrák iránt, a TOURIT hátizsákos hűtő a legjobb partnere minden típusú szabadtéri tevékenységhez.Hőszigetelt hátizsákunk stílusos kialakításának köszönhetően ebéd-hátizsákként vagy napi csomagként is használható.', 'Hátizsák,Vízálló hátizsák,Fekete hátizsák,Hátizsák túrázásra'),
(32, 60, 'Termékleírás', 'Akár nagy érdeklődést mutat az országúti/tengerparti kirándulások, piknikek vagy napi túrák iránt, a TOURIT hátizsákos hűtő a legjobb partnere minden típusú szabadtéri tevékenységhez.Hőszigetelt hátizsákunk stílusos kialakításának köszönhetően ebéd-hátizsákként vagy napi csomagként is használható.', 'Hátizsák,Vízálló hátizsák,Fekete hátizsák,Hátizsák túrázásra'),
(33, 61, 'Termékleírás', 'Akár nagy érdeklődést mutat az országúti/tengerparti kirándulások, piknikek vagy napi túrák iránt, a TOURIT hátizsákos hűtő a legjobb partnere minden típusú szabadtéri tevékenységhez.Hőszigetelt hátizsákunk stílusos kialakításának köszönhetően ebéd-hátizsákként vagy napi csomagként is használható.', 'Hátizsák,Vízálló hátizsák,Fekete hátizsák,Hátizsák túrázásra'),
(34, 62, 'Termékleírás', 'Akár nagy érdeklődést mutat az országúti/tengerparti kirándulások, piknikek vagy napi túrák iránt, a TOURIT hátizsákos hűtő a legjobb partnere minden típusú szabadtéri tevékenységhez.Hőszigetelt hátizsákunk stílusos kialakításának köszönhetően ebéd-hátizsákként vagy napi csomagként is használható.', 'Hátizsák,Vízálló hátizsák,Kék hátizsák,Hátizsák túrázásra'),
(35, 63, 'Termékleírás', 'Akár nagy érdeklődést mutat az országúti/tengerparti kirándulások, piknikek vagy napi túrák iránt, a TOURIT hátizsákos hűtő a legjobb partnere minden típusú szabadtéri tevékenységhez.Hőszigetelt hátizsákunk stílusos kialakításának köszönhetően ebéd-hátizsákként vagy napi csomagként is használható.', 'Hátizsák,Vízálló hátizsák,Narancssárga hátizsák,Hátizsák túrázásra'),
(36, 64, 'Termékleírás', 'Akár nagy érdeklődést mutat az országúti/tengerparti kirándulások, piknikek vagy napi túrák iránt, a TOURIT hátizsákos hűtő a legjobb partnere minden típusú szabadtéri tevékenységhez.Hőszigetelt hátizsákunk stílusos kialakításának köszönhetően ebéd-hátizsákként vagy napi csomagként is használható.', 'Hátizsák,Vízálló hátizsák,Zöld hátizsák,Hátizsák túrázásra'),
(37, 65, 'Termékleírás', 'Akár nagy érdeklődést mutat az országúti/tengerparti kirándulások, piknikek vagy napi túrák iránt, a TOURIT hátizsákos hűtő a legjobb partnere minden típusú szabadtéri tevékenységhez.Hőszigetelt hátizsákunk stílusos kialakításának köszönhetően ebéd-hátizsákként vagy napi csomagként is használható.', 'Hátizsák,Vízálló hátizsák,Kék hátizsák,Hátizsák túrázásra'),
(38, 66, 'Termékleírás', 'Robusztus, professzionális tudományos számológép. 2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt.', 'Számológép,Tudományos Számológép,Napelemes Számológép,Fekete Számológép'),
(39, 67, 'Termékleírás', 'Robusztus, professzionális tudományos számológép. 2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt.', 'Számológép,Tudományos Számológép,Napelemes Számológép,Zöld Számológép'),
(40, 68, 'Termékleírás', 'Robusztus, professzionális tudományos számológép. 2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt.', 'Számológép,Napelemes Számológép,Zöld Számológép,Szabványos számológép'),
(41, 69, 'Termékleírás', 'Robusztus, professzionális tudományos számológép. 2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt.', 'Számológép,Napelemes Számológép,Rózsaszín Számológép,Szabványos számológép'),
(42, 70, 'Termékleírás', 'Robusztus, professzionális tudományos számológép. 2 soros kijelzője egyszerre mutatja a bevitelt és a számított eredményt.', 'Számológép,Napelemes Számológép,Fekete Számológép'),
(43, 71, 'Termékleírás', 'Modern, századközép oldalsó szék étkezőszék természetes fa lábakkal konyhába, nappaliba, étkezőbe, 1 darabos készlet', 'Szék,Irodai szék,Székek,Elegáns'),
(44, 72, 'Termékleírás', 'Modern, századközép oldalsó szék étkezőszék természetes fa lábakkal konyhába, nappaliba, étkezőbe, 1 darabos készlet', 'Szék,Irodai szék,Székek,Elegáns'),
(45, 73, 'Termékleírás', 'Modern, századközép oldalsó szék étkezőszék természetes fa lábakkal konyhába, nappaliba, étkezőbe, 1 darabos készlet', 'Szék,Irodai szék,Székek,Elegáns'),
(46, 74, 'Termékleírás', 'Modern, századközép oldalsó szék étkezőszék természetes fa lábakkal konyhába, nappaliba, étkezőbe, 1 darabos készlet', 'Szék,Irodai szék,Székek,Elegáns'),
(47, 75, 'Termékleírás', 'Modern, századközép oldalsó szék étkezőszék természetes fa lábakkal konyhába, nappaliba, étkezőbe, 1 darabos készlet', 'Szék,Irodai szék,Székek,Elegáns'),
(48, 76, 'Termékleírás', 'Vezetéknélküli Irodai Egér halk kattintás, fekete és arany színű. 2.4G csatlakozás. Ergonomikus tervezés.', 'Egér,Egerek,Irodai Egér,Vezetéknélküli egér,Gaming Egér'),
(49, 77, 'Termékleírás', 'Vezetéknélküli Irodai Egér halk kattintás, fekete és arany színű. 2.4G csatlakozás. Ergonomikus tervezés.', 'Egér,Egerek,Irodai Egér,Vezetéknélküli egér,Gaming Egér'),
(50, 78, 'Termékleírás', 'Vezetéknélküli Irodai Egér halk kattintás, fekete és arany színű. 2.4G csatlakozás. Ergonomikus tervezés.', 'Egér,Egerek,Irodai Egér,Vezetéknélküli egér,Gaming Egér'),
(51, 79, 'Termékleírás', 'A Magic Mouse vezeték nélküli és újratölthető, optimalizált lábkialakításával simán csúszik az asztalon.', 'Egér,Egerek,Irodai Egér,Vezetéknélküli egér,Apple,Magic Mouse,Magic Mouse 2'),
(54, 82, 'Termékleírás', 'A Magic Mouse vezeték nélküli és újratölthető, optimalizált lábkialakításával simán csúszik az asztalon.', 'Egér,Egerek,Irodai Egér,Vezetéknélküli egér,Apple,Magic Mouse,Magic Mouse 2');

-- --------------------------------------------------------

--
-- Table structure for table `products__pricing`
--

CREATE TABLE `products__pricing` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `base` int NOT NULL,
  `discounted` tinyint(1) DEFAULT NULL,
  `discount` int DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `products__pricing`
--

INSERT INTO `products__pricing` (`id`, `pid`, `base`, `discounted`, `discount`, `start`, `end`) VALUES
(1, 1, 8565, NULL, 0, NULL, NULL),
(2, 2, 8565, NULL, 0, NULL, NULL),
(3, 3, 8565, NULL, 0, NULL, NULL),
(4, 4, 8565, NULL, 0, NULL, NULL),
(5, 5, 6245, NULL, 0, NULL, NULL),
(6, 6, 6245, NULL, 0, NULL, NULL),
(7, 7, 6245, NULL, 0, NULL, NULL),
(8, 8, 65683, NULL, 0, NULL, NULL),
(9, 9, 74146, NULL, 0, NULL, NULL),
(10, 10, 74146, NULL, 0, NULL, NULL),
(11, 11, 74146, NULL, 0, NULL, NULL),
(12, 12, 804, NULL, 0, NULL, NULL),
(13, 13, 804, NULL, 0, NULL, NULL),
(22, 54, 4500, NULL, 0, NULL, NULL),
(23, 55, 4500, 0, 0, NULL, NULL),
(24, 56, 19000, 0, 0, NULL, NULL),
(25, 57, 19000, 0, 0, NULL, NULL),
(26, 58, 19000, 0, 0, NULL, NULL),
(27, 59, 18600, 1, 16, '2022-08-26 12:00:00', '2022-10-25 12:00:00'),
(28, 60, 18600, 0, 0, NULL, NULL),
(29, 61, 18600, 0, 0, NULL, NULL),
(30, 62, 18600, 0, 0, NULL, NULL),
(31, 63, 18600, 0, 0, NULL, NULL),
(32, 64, 18600, 0, 0, NULL, NULL),
(33, 65, 32655, 0, 0, NULL, NULL),
(34, 66, 3720, 1, 11, '2022-08-26 17:00:00', '2022-09-25 17:00:00'),
(35, 67, 3720, 0, 0, NULL, NULL),
(36, 68, 4125, 0, 0, NULL, NULL),
(37, 69, 4125, 0, 0, NULL, NULL),
(38, 70, 3305, 0, 0, NULL, NULL),
(39, 71, 28520, 0, 0, NULL, NULL),
(40, 72, 28520, 0, 0, NULL, NULL),
(41, 73, 32695, 0, 0, NULL, NULL),
(42, 74, 32695, 0, 0, NULL, NULL),
(43, 75, 55390, 0, 0, NULL, NULL),
(44, 76, 8230, 1, 40, '2022-08-26 20:00:00', '2022-09-02 20:00:00'),
(45, 77, 8230, 0, 0, NULL, NULL),
(46, 78, 9465, 1, 26, '2022-08-26 20:00:00', '2022-09-25 20:00:00'),
(47, 79, 32935, 0, 0, NULL, NULL),
(50, 82, 32935, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products__review`
--

CREATE TABLE `products__review` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `auth` tinyint(1) NOT NULL,
  `vote` tinyint(1) NOT NULL,
  `privacy` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `products__review`
--

INSERT INTO `products__review` (`id`, `pid`, `enable`, `auth`, `vote`, `privacy`) VALUES
(1, 1, 1, 0, 1, 0),
(2, 2, 1, 0, 1, 0),
(3, 3, 1, 0, 1, 0),
(4, 4, 1, 0, 1, 0),
(5, 5, 1, 0, 1, 0),
(6, 6, 1, 0, 1, 0),
(7, 7, 1, 0, 1, 0),
(8, 8, 1, 0, 1, 0),
(9, 9, 1, 0, 1, 0),
(10, 10, 1, 0, 1, 0),
(11, 11, 1, 0, 1, 0),
(12, 12, 1, 0, 1, 0),
(13, 13, 1, 0, 1, 0),
(20, 54, 1, 0, 0, 1),
(21, 55, 1, 0, 0, 1),
(22, 56, 1, 0, 0, 1),
(23, 57, 1, 0, 0, 1),
(24, 58, 1, 0, 0, 1),
(25, 59, 1, 0, 0, 1),
(26, 60, 1, 0, 0, 1),
(27, 61, 1, 0, 0, 1),
(28, 62, 1, 0, 0, 1),
(29, 63, 1, 0, 0, 1),
(30, 64, 1, 0, 0, 1),
(31, 65, 1, 0, 0, 1),
(32, 66, 1, 0, 1, 1),
(33, 67, 1, 0, 1, 1),
(34, 68, 1, 0, 1, 1),
(35, 69, 1, 0, 1, 1),
(36, 70, 1, 0, 1, 1),
(37, 71, 1, 0, 1, 1),
(38, 72, 1, 0, 1, 1),
(39, 73, 1, 0, 1, 1),
(40, 74, 1, 0, 1, 1),
(41, 75, 1, 0, 1, 1),
(42, 76, 1, 0, 0, 1),
(43, 77, 1, 0, 0, 1),
(44, 78, 1, 0, 1, 1),
(45, 79, 1, 0, 0, 1),
(48, 82, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products__search`
--

CREATE TABLE `products__search` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `price` int NOT NULL,
  `refund` tinyint NOT NULL,
  `backorder` tinyint NOT NULL,
  `savg` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `products__search`
--

INSERT INTO `products__search` (`id`, `pid`, `name`, `category`, `tags`, `brand`, `price`, `refund`, `backorder`, `savg`) VALUES
(1, 1, 'tudomanyos-szamologep', 'szamologepek', 'szamologep,tudomanyos,fekete,napelemes', 'texas-instruments', 8565, 0, 0, 4),
(2, 2, 'tudomanyos-szamologep', 'szamologepek', 'szamologep,tudomanyos,kek,napelemes', 'texas-instruments', 8565, 0, 0, 4),
(3, 3, 'tudomanyos-szamologep', 'szamologepek', 'szamologep,tudomanyos,feher,napelemes', 'texas-instruments', 8565, 0, 0, 4),
(4, 4, 'tudomanyos-szamologep', 'szamologepek', 'szamologep,tudomanyos,rozsaszin,napelemes', 'texas-instruments', 8565, 0, 0, 4),
(5, 5, 'halado-tudomanyos-szamologep', 'szamologepek', 'szamologep,tudomanyos,fekete,napelemes', 'casio', 6245, 0, 0, 0),
(6, 6, 'halado-tudomanyos-szamologep', 'szamologepek', 'szamologep,tudomanyos,feher,napelemes', 'casio', 6245, 0, 0, 0),
(7, 7, 'halado-tudomanyos-szamologep', 'szamologepek', 'szamologep,tudomanyos,rozsaszin,napelemes', 'casio', 6245, 0, 0, 0),
(8, 8, 'linon-brooklyn-sherpa-irodai-szek', 'irodai-szekek', 'szek,irodai-szek,szekek,elegans,gurulo-szek,forgo-szek', 'linon-home-decor-products', 65683, 0, 0, 0),
(9, 9, 'allithato-extra-pluss-forgathato-otthoni-irodai-munkaszek-polirozott-krom-alappal', 'irodai-szek', 'szek,irodai-szek,szekek,elegans,gurulo-szek,forgo-szek', 'osp-home-furnishing', 74146, 0, 0, 0),
(10, 10, 'allithato-extra-pluss-forgathato-otthoni-irodai-munkaszek-polirozott-krom-alappal', 'irodai-szek', 'szek,irodai-szek,szekek,elegans,gurulo-szek,forgo-szek', 'osp-home-furnishing', 74146, 0, 0, 0),
(11, 11, 'allithato-extra-pluss-forgathato-otthoni-irodai-munkaszek-polirozott-krom-alappal', 'irodai-szek', 'szek,irodai-szek,szekek,elegans,gurulo-szek,forgo-szek', 'osp-home-furnishing', 74146, 0, 0, 0),
(12, 12, '2.4g-vezetek-nelkuli-2400dpi-irodai-eger', 'irodai-egerek', 'irodai-eger,vezetek-nelkuli,nepszeru,uj-termek', 'amikadom', 804, 0, 0, 0),
(13, 13, '2.4g-vezetek-nelkuli-2400dpi-irodai-eger', 'irodai-egerek', 'irodai-eger,vezetek-nelkuli,nepszeru,uj-termek', 'amikadom', 804, 0, 0, 0),
(14, 54, 'vezetek-nelkuli-eger-2.4g-vekony-hordozhato-szamitogepes-eger-nano-vevovel-notebookhoz-pc-hez-laptophoz-szamitogephez', 'irodai-egerek', 'irodai-eger,vezetek-nelkuli,nepszeru,uj-termek', 'vssoplor', 4500, 0, 0, 0),
(15, 55, 'vezetek-nelkuli-eger-2.4g-vekony-hordozhato-szamitogepes-eger-nano-vevovel-notebookhoz-pc-hez-laptophoz-szamitogephez', 'irodai-egerek', 'irodai-eger,vezetek-nelkuli,nepszeru,uj-termek', 'vssoplor', 4500, 0, 0, 0),
(16, 56, 'hutos-hatizsak-szigetelt-konnyu-szivargasmentes', 'hatizsakok', 'hatizsak,vizallo,szigetelt,konnyu', 'tourit', 19000, 0, 0, 0),
(17, 57, 'hutos-hatizsak-szigetelt-konnyu-szivargasmentes', 'hatizsakok', 'hatizsak,vizallo,szigetelt,konnyu', 'tourit', 19000, 0, 0, 0),
(18, 58, 'hutos-hatizsak-szigetelt-konnyu-szivargasmentes', 'hatizsakok', 'hatizsak,vizallo,szigetelt,konnyu', 'tourit', 19000, 0, 0, 0),
(19, 59, 'hatizsak-huto-szivargasmentes-28-dobozos-huto-hatizsak-szigetelt-vizallo', 'hatizsakok', 'uj-termek,nepszeru,hatizsak,vizallo,vizlepergeto', 'tourit', 18600, 0, 0, 4),
(20, 60, 'hatizsak-huto-szivargasmentes-28-dobozos-huto-hatizsak-szigetelt-vizallo', 'hatizsakok', 'uj-termek,nepszeru,hatizsak,vizallo,vizlepergeto', 'tourit', 18600, 0, 0, 4),
(21, 61, 'hatizsak-huto-szivargasmentes-33-dobozos-huto-hatizsak-szigetelt-vizallo', 'hatizsakok', 'uj-termek,nepszeru,hatizsak,vizallo,vizlepergeto', 'tourit', 18600, 0, 0, 0),
(22, 62, 'hatizsak-huto-szivargasmentes-33-dobozos-huto-hatizsak-szigetelt-vizallo', 'hatizsakok', 'uj-termek,nepszeru,hatizsak,vizallo,vizlepergeto', 'tourit', 18600, 0, 0, 0),
(23, 63, 'hatizsak-huto-szivargasmentes-35-dobozos-huto-hatizsak-szigetelt-vizallo', 'hatizsakok', 'uj-termek,nepszeru,hatizsak,vizallo,vizlepergeto', 'maelstrom', 18600, 0, 0, 5),
(24, 64, 'hatizsak-huto-szivargasmentes-35-dobozos-huto-hatizsak-szigetelt-vizallo', 'hatizsakok', 'uj-termek,nepszeru,hatizsak,vizallo,vizlepergeto', 'maelstrom', 18600, 0, 0, 5),
(25, 65, 'titan-guide-sorozatu-huto-hatizsak', 'hatizsakok', 'uj-termek,nepszeru,hatizsak,vizallo,vizlepergeto', 'arctic-zone', 32655, 0, 0, 0),
(26, 66, 'szamologep-standard-funkcioju-asztali-szamologep', 'szamologepek', 'szamologep,tudomanyos,fekete,napelemes', 'helect', 3720, 0, 0, 3),
(27, 67, 'szamologep-standard-funkcioju-asztali-szamologep', 'szamologepek', 'szamologep,tudomanyos,zold,napelemes', 'helect', 3720, 0, 0, 3),
(28, 68, 'alapveto-szabvanyos-szamologep-12-szamjegyu-asztali-szamologep-nagy-lcd-kijelzovel-irodai-iskolai-otthoni-es-uzleti-hasznalatra-modern-dizajn', 'szamologepek', 'szamologep,tudomanyos,zold,napelemes', 'eoocoo', 4125, 0, 0, 5),
(29, 69, 'alapveto-szabvanyos-szamologep-12-szamjegyu-asztali-szamologep-nagy-lcd-kijelzovel-irodai-iskolai-otthoni-es-uzleti-hasznalatra-modern-dizajn', 'szamologepek', 'szamologep,tudomanyos,rozsaszin,napelemes', 'eoocoo', 4125, 0, 0, 5),
(30, 70, 'szamologep-normal-funkcios-alapszamitasok-napelemes-kettos-teljesitmenyu-irodai-szamologep-fedellel-fem-panel', 'szamologepek', 'szamologep,tudomanyos,fekete,napelemes', 'deli', 3305, 0, 0, 1),
(31, 71, 'modern-szazadkozep-oldalso-szek-etkezoszek-termeszetes-fa-labakkal-konyhaba-nappaliba-etkezobe-1-darabos-keszlet', 'irodai-szekek', 'szek,irodai-szek,szekek,elegans', 'canglong', 28520, 0, 0, 0),
(32, 72, 'modern-szazadkozep-oldalso-szek-etkezoszek-termeszetes-fa-labakkal-konyhaba-nappaliba-etkezobe-1-darabos-keszlet', 'irodai-szekek', 'szek,irodai-szek,szekek,elegans', 'canglong', 28520, 0, 0, 0),
(33, 73, 'ergonomikus-legatereszto-halos-forgo-iroasztalszek-allithato-magassagu-es-derektamaszto-karfaval-otthoni-irodai-es-tanulmanyi-hasznalatra', 'irodai-szekek', 'szek,irodai-szek,szekek,elegans', 'smug', 32695, 0, 0, 0),
(34, 74, 'ergonomikus-legatereszto-halos-forgo-iroasztalszek-allithato-magassagu-es-derektamaszto-karfaval-otthoni-irodai-es-tanulmanyi-hasznalatra', 'irodai-szekek', 'szek,irodai-szek,szekek,elegans', 'smug', 32695, 0, 0, 0),
(35, 75, 'ergonomikus-irodai-rajzolo-szamitogepes-asztali-szek-felhajthato-es-allithato-magassagu-karokkal', 'irodai-szekek', 'szek,irodai-szek,szekek,elegans', 'bojuzija', 55390, 0, 0, 0),
(36, 76, 'vezetek-nelkuli-eger-pro-2.4g-ergonomikus-vezetek-nelkuli-optikai-eger-usb-nano-vevovel-laptophoz-pc-hez-szamitogephez-chromebookhoz-notebookhoz-6-gomb-24-honapos-akkumulator-elettartam-2600-dpi-5-beallitasi-fokozat', 'irodai-egerek', 'irodai-eger,vezetek-nelkuli,nepszeru,uj-termek', 'tecknet', 8230, 0, 0, 0),
(37, 77, 'vezetek-nelkuli-eger-pro-2.4g-ergonomikus-vezetek-nelkuli-optikai-eger-usb-nano-vevovel-laptophoz-pc-hez-szamitogephez-chromebookhoz-notebookhoz-6-gomb-24-honapos-akkumulator-elettartam-2600-dpi-5-beallitasi-fokozat', 'irodai-egerek', 'irodai-eger,vezetek-nelkuli,nepszeru,uj-termek', 'tecknet', 8230, 0, 0, 0),
(38, 78, '2.4-g-vezetek-nelkuli-eger-1200-dpi-mobil-optikai-vezetek-nelkuli-eger-usb-vevovel-hordozhato-szamitogepes-eger-vezetek-nelkuli-eger-laptophoz-pc-hez-asztali-szamitogephez-macbookhoz-5-gomb', 'irodai-egerek', 'irodai-eger,vezetek-nelkuli,nepszeru,uj-termek', 'memzuoix', 9465, 0, 0, 0),
(39, 79, 'apple-magic-mouse', 'irodai-egerek', 'irodai-eger,vezetek-nelkuli,nepszeru,uj-termek', 'apple', 32935, 0, 0, 0),
(40, 82, 'apple-magic-mouse', 'irodai-egerek', 'irodai-eger,vezetek-nelkuli,nepszeru,uj-termek', 'apple', 32935, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products__shipping`
--

CREATE TABLE `products__shipping` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `physical` tinyint(1) NOT NULL,
  `weight` int DEFAULT NULL,
  `w__unit` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `width` int DEFAULT NULL,
  `height` int DEFAULT NULL,
  `length` int DEFAULT NULL,
  `d__unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `refund` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `products__shipping`
--

INSERT INTO `products__shipping` (`id`, `pid`, `physical`, `weight`, `w__unit`, `width`, `height`, `length`, `d__unit`, `refund`) VALUES
(1, 1, 1, 136, 'Gramm', 8, 2, 16, 'Centiméter', 0),
(2, 2, 1, 136, 'Gramm', 8, 2, 16, 'Centiméter', 0),
(3, 3, 1, 136, 'Gramm', 8, 2, 16, 'Centiméter', 0),
(4, 4, 1, 136, 'Gramm', 8, 2, 16, 'Centiméter', 0),
(5, 5, 1, 170, 'Gramm', 14, 5, 22, 'Centiméter', 0),
(6, 6, 1, 170, 'Gramm', 14, 5, 22, 'Centiméter', 0),
(7, 7, 1, 170, 'Gramm', 14, 5, 22, 'Centiméter', 0),
(8, 8, 1, 10, 'Kilógramm', 65, 65, 86, 'Centiméter', 0),
(9, 9, 1, 9, 'Kilógramm', 26, 34, 25, 'Inch', 0),
(10, 10, 1, 9, 'Kilógramm', 26, 34, 25, 'Inch', 0),
(11, 11, 1, 9, 'Kilógramm', 26, 34, 25, 'Inch', 0),
(12, 12, 1, 70, 'Gramm', 1, 1, 1, 'Inch', 0),
(13, 13, 1, 70, 'Gramm', 1, 1, 1, 'Inch', 0),
(18, 54, 1, 81, 'Gramm', 4, 2, 1, 'Inch', 0),
(19, 55, 1, 81, 'Gramm', 4, 2, 1, 'Inch', 0),
(20, 56, 1, 50, 'Dekagramm', 15, 7, 13, 'Inch', 1),
(21, 57, 1, 50, 'Dekagramm', 15, 7, 13, 'Inch', 0),
(22, 58, 1, 50, 'Dekagramm', 15, 7, 13, 'Inch', 0),
(23, 59, 1, 72, 'Dekagramm', 7, 15, 11, 'Inch', 0),
(24, 60, 1, 72, 'Dekagramm', 7, 15, 11, 'Inch', 0),
(25, 61, 1, 850, 'Gramm', 4, 16, 12, 'Inch', 0),
(26, 62, 1, 850, 'Gramm', 4, 16, 12, 'Inch', 0),
(27, 63, 1, 850, 'Gramm', 5, 15, 10, 'Inch', 0),
(28, 64, 1, 850, 'Gramm', 5, 15, 10, 'Inch', 0),
(29, 65, 1, 2, 'Kilógramm', 12, 22, 12, 'Inch', 0),
(30, 66, 1, 136, 'Gramm', 8, 2, 16, 'Centiméter', 0),
(31, 67, 1, 136, 'Gramm', 8, 2, 16, 'Centiméter', 0),
(32, 68, 1, 136, 'Gramm', 8, 2, 16, 'Centiméter', 1),
(33, 69, 1, 136, 'Gramm', 8, 2, 16, 'Centiméter', 0),
(34, 70, 1, 136, 'Gramm', 8, 2, 16, 'Centiméter', 0),
(35, 71, 1, 10, 'Kilógramm', 65, 65, 86, 'Centiméter', 0),
(36, 72, 1, 10, 'Kilógramm', 65, 65, 86, 'Centiméter', 0),
(37, 73, 1, 10, 'Kilógramm', 65, 65, 86, 'Centiméter', 0),
(38, 74, 1, 10, 'Kilógramm', 65, 65, 86, 'Centiméter', 0),
(39, 75, 1, 10, 'Kilógramm', 65, 65, 86, 'Centiméter', 0),
(40, 76, 1, 81, 'Gramm', 4, 2, 1, 'Inch', 0),
(41, 77, 1, 81, 'Gramm', 4, 2, 1, 'Inch', 0),
(42, 78, 1, 82, 'Gramm', 4, 2, 1, 'Inch', 0),
(43, 79, 1, 81, 'Gramm', 4, 2, 1, 'Inch', 0),
(46, 82, 1, 81, 'Gramm', 4, 2, 1, 'Inch', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products__status`
--

CREATE TABLE `products__status` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `status` int NOT NULL,
  `schedule` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `products__status`
--

INSERT INTO `products__status` (`id`, `pid`, `status`, `schedule`) VALUES
(1, 1, 1, NULL),
(2, 2, 1, NULL),
(3, 3, 1, NULL),
(4, 4, 1, NULL),
(5, 5, 1, NULL),
(6, 6, 1, NULL),
(7, 7, 1, NULL),
(8, 8, 1, NULL),
(9, 9, 1, NULL),
(10, 10, 1, NULL),
(11, 11, 1, NULL),
(12, 12, 1, NULL),
(13, 13, 1, NULL),
(18, 54, 1, NULL),
(19, 55, 1, NULL),
(20, 56, 1, NULL),
(21, 57, 1, NULL),
(22, 58, 1, NULL),
(23, 59, 1, NULL),
(24, 60, 1, NULL),
(25, 61, 1, NULL),
(26, 62, 1, NULL),
(27, 63, 1, NULL),
(28, 64, 1, NULL),
(29, 65, 1, NULL),
(30, 66, 1, NULL),
(31, 67, 1, NULL),
(32, 68, 1, NULL),
(33, 69, 1, NULL),
(34, 70, 1, NULL),
(35, 71, 1, NULL),
(36, 72, 1, NULL),
(37, 73, 1, NULL),
(38, 74, 1, NULL),
(39, 75, 1, NULL),
(40, 76, 1, NULL),
(41, 77, 1, NULL),
(42, 78, 1, NULL),
(43, 79, 1, NULL),
(46, 82, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products__variations`
--

CREATE TABLE `products__variations` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `material` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `style` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `custom` varchar(8192) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `products__variations`
--

INSERT INTO `products__variations` (`id`, `pid`, `color`, `material`, `style`, `brand`, `model`, `custom`) VALUES
(1, 1, 'Fekete', 'Műanyag', 'Napelem és elem', 'Texas Instruments', 'TI-30XIIS', 'Elemek száma:1 CR123A (tartalmazza),ASIN:B00000JBNX,Modellszám:30XIIS/TBL/1L1/BK,Országos készletszám:7420-01-478-7048,Gyártó:Texas Instruments,Származási ország:Philippines'),
(2, 2, 'Kék', 'Műanyag', 'Napelem és elem', 'Texas Instruments', 'TI-30XIIS', 'Elemek száma:1 CR123A (tartalmazza),ASIN:B00000JBNX,Modellszám:30XIIS/TBL/1L1/BM,Országos készletszám:7420-01-478-7048,Gyártó:Texas Instruments,Származási ország:Philippines'),
(3, 3, 'Fehér', 'Műanyag', 'Napelem és elem', 'Texas Instruments', 'TI-30XIIS', 'Elemek száma:1 CR123A (tartalmazza),ASIN:B00000JBNX,Modellszám:30XIIS/TBL/1L1/WH,Országos készletszám:7420-01-478-7048,Gyártó:Texas Instruments,Származási ország:Philippines'),
(4, 4, 'Rózsaszín', 'Műanyag', 'Napelem és elem', 'Texas Instruments', 'TI-30XIIS', 'Elemek száma:1 CR123A (tartalmazza),ASIN:B00000JBNX,Modellszám:30XIIS/TBL/1L1/PI,Országos készletszám:7420-01-478-7048,Gyártó:Texas Instruments,Származási ország:Philippines'),
(5, 5, 'Fekete', 'Műanyag', 'Napelem és elem', 'Casio', 'FX-115ESPLUS2', 'Kijelző mérete: 14 cm, Elemek száma: 1 LR44 elem (tartalmazza)'),
(6, 6, 'Fehér', 'Műanyag', 'Napelem és elem', 'Casio', 'FX-115ESPLUS2', 'Kijelző mérete: 15 cm, Elemek száma: 1 LR44 elem (tartalmazza)'),
(7, 7, 'Rózsaszín', 'Műanyag', 'Napelem és elem', 'Casio', 'FX-115ESPLUS2', 'Kijelző mérete: 15 cm, Elemek száma: 1 LR44 elem (tartalmazza)'),
(8, 8, 'Elefántcsont', 'Fém', 'Plüss huzatos', '‎Linon Home Decor Products', 'LHDP-BSOC-IVO', 'Különleges tulajdonság: Állítható ülésmagasság, Ülés anyaga: Műbőr,A termékhez javasolt felhasználás: Irodai felhasználás,Származási ország: Kína'),
(9, 9, 'Atlantikkék', 'Mérnöki fa, hab, ötvözött acél, polipropilén, szövet', 'Párnázott', '‎OSP Home Furnishings', '‎BRL26-B20', 'Háttámla stílusa: Párnázott, Különleges jellemzők: állítható magasság - kartámasz - forgatható - gördülő,Javasolt felhasználási környezet: Iroda, Javasolt maximális súly: 100 kg, Származási ország: Kína'),
(10, 10, 'Fekete', 'Mérnöki fa, hab, ötvözött acél, polipropilén, szövet', 'Párnázott', '‎OSP Home Furnishings', '‎BRL26-B20', 'Háttámla stílusa: Párnázott, Különleges jellemzők: állítható magasság - kartámasz - forgatható - gördülő,Javasolt felhasználási környezet: Iroda, Javasolt maximális súly: 100 kg, Származási ország: Kína'),
(11, 11, 'Osztriga', 'Mérnöki fa, hab, ötvözött acél, polipropilén, szövet', 'Párnázott', '‎OSP Home Furnishings', '‎BRL26-B20', 'Háttámla stílusa: Párnázott, Különleges jellemzők: állítható magasság - kartámasz - forgatható - gördülő,Javasolt felhasználási környezet: Iroda, Javasolt maximális súly: 100 kg, Származási ország: Kína'),
(12, 12, 'Fekete', 'Műanyag', 'Vezetéknélküli', 'Amikadom', '95X220611GGF220422593', 'Származási ország: Kína'),
(13, 13, 'Fehér', 'Műanyag', 'Vezetéknélküli', 'Amikadom', '95X220611GGF220422593', 'Származási ország: Kína'),
(17, 54, 'Fekete és Arany', 'Műanyag', 'Vezeték nélküli', 'Vssoplor', 'S001', NULL),
(18, 55, 'Fekete és Ezüst', 'Műanyag', 'Vezeték nélküli', 'Vssoplor', 'S001', 'Gombok száma:3,Platform:Windows / Windows 2000 Server / Windows 10 / Mac OS X 10.4 Tiger / Windows 7 / Windows XP / Windows 8 / Windows Vista,Származási ország:Kína'),
(19, 56, 'Fekete', 'Műszál', 'Vízálló', 'TOURIT', '600D', 'Méret:L,Kapacitás:28 Centiliter,Extra:1 sörbontó a szíjon'),
(20, 57, 'Szürke', 'Műszál', 'Vízálló', 'TOURIT', '600D', 'Méret:L,Kapacitás:28 Centiliter,Extra:1 sörbontó a szíjon'),
(21, 58, 'Fekete terepmintás', 'Műszál', 'Vízálló', 'TOURIT', '600D', 'Méret:L,Kapacitás:28 Centiliter,Extra:1 sörbontó a szíjon'),
(22, 59, 'Sötét szürke', 'Műszál', 'Vízlepergető', 'TOURIT', 'B07Q1N', NULL),
(23, 60, 'Világos szürke', 'Műszál', 'Vízlepergető', 'TOURIT', 'B07Q1N', NULL),
(24, 61, 'Fekete', 'Műszál', 'Vízlepergető', 'TOURIT', 'AN001-FUS-X', NULL),
(25, 62, 'Kék', 'Műszál', 'Vízlepergető', 'TOURIT', 'AN001-FUS-X', NULL),
(26, 63, 'Narancssárga', 'Poliészter', 'Vízlepergető', 'Maelstrom', 'B09P9', 'Javasolt felhasználók:Uniszex-felnőtt,Tartalmazott komponensek:Nincs,Gyártó:Maelstrom,Méret:35 doboz,Garancia leírása:1 év garancia'),
(27, 64, 'Zöld', 'Poliészter', 'Vízlepergető', 'Maelstrom', 'B09P9', 'Javasolt felhasználók:Uniszex-felnőtt,Tartalmazott komponensek:Nincs,Gyártó:Maelstrom,Méret:35 doboz,Garancia leírása:1 év garancia'),
(28, 65, 'Kék', 'Neoprén', 'Vízálló', 'Arctic Zone', 'Titan Guide Series', 'Garancia leírása:Limitált,Javasolt felhasználók:Uniszex-felnőtt,Darabszám:1,Gyártó:California Innovations,Méret:30 dobozos hátizsák hűtő'),
(29, 66, 'Fekete', 'Műanyag', 'Napelem és elem', 'Helect', 'H1001', 'Elemek száma:1 AA (nem tartalmazza),Gyártó:Helect'),
(30, 67, 'Zöld', 'Műanyag', 'Napelem és elem', 'Helect', 'H1001', 'Elemek száma:1 AA (nem tartalmazza),Gyártó:Helect'),
(31, 68, 'Zöld', 'Műanyag', 'Napelem', 'EooCoo', 'EOBC-STC', 'Elemek száma:1 AA (nem tartalmazza),Gyártó:EooCoo,Kijelző:LCD'),
(32, 69, 'Rózsaszín', 'Műanyag', 'Napelem', 'EooCoo', 'EOBC-STC', 'Elemek száma:1 AA (nem tartalmazza),Gyártó:EooCoo,Kijelző:LCD'),
(33, 70, 'Fekete', 'Műanyag', 'Napelem és elem', 'Deli', 'DL-CLC-3PD', NULL),
(34, 71, 'Bézs', 'Fa és műanyag', 'Párnázott', 'CangLong', 'KU-191221', ' Ülés anyaga: Műbőr,A termékhez javasolt felhasználás: Irodai felhasználás,Származási ország: Kína,Különleges tulajdonság:A párna elérhetősége'),
(35, 72, 'Fekete', 'Fa és műanyag', 'Párnázott', 'CangLong', 'KU-191221', ' Ülés anyaga: Műbőr,A termékhez javasolt felhasználás: Irodai felhasználás,Származási ország: Kína,Különleges tulajdonság:A párna elérhetősége'),
(36, 73, 'Szürke', 'Műanyag és fém', 'Légáteresztő', 'SMUG', 'B09C6122Q1', 'A termékhez javasolt felhasználás: Irodai felhasználás,Származási ország: Kína'),
(37, 74, 'Fekete', 'Műanyag és fém', 'Légáteresztő', 'SMUG', 'B09C6122Q1', 'A termékhez javasolt felhasználás: Irodai felhasználás,Származási ország: Kína'),
(38, 75, 'Fekete', 'Nejlon', 'Légáteresztő', 'BOJUZIJA', 'B0B9JR27NZ', 'A termékhez javasolt felhasználás: Irodai felhasználás,Származási ország: Kína,Különleges tulajdonság:Kartámasz és Lábtámasz'),
(39, 76, 'Fekete', 'Műanyag', 'Vezeték nélküli', 'TeckNet', 'FBA_841256', 'Gombok száma:6,Platform:Windows7/8/10/XP/Vista7/8 / Linux & Mac OS (Az oldalsó gombok nem elérhetők),USB nano vevőegység mellékelve:Igen,DPI szint:2600/2000/1600/1200/800,Csatlakozási technológia:2.4 GHz-es vezeték nélküli,Maximális akkumulátor-élettartam:24 hónap,Elemek száma:2 AA (nem tartalmazza)'),
(40, 77, 'Kék', 'Műanyag', 'Vezeték nélküli', 'TeckNet', 'FBA_841256', 'Gombok száma:6,Platform:Windows7/8/10/XP/Vista7/8 / Linux & Mac OS (Az oldalsó gombok nem elérhetők),USB nano vevőegység mellékelve:Igen,DPI szint:2600/2000/1600/1200/800,Csatlakozási technológia:2.4 GHz-es vezeték nélküli,Maximális akkumulátor-élettartam:24 hónap,Elemek száma:2 AA (nem tartalmazza)'),
(41, 78, 'Piros', 'Műanyag', 'Vezeték nélküli', 'Memzuoix', 'B07WCW1PB3', 'Gombok száma:6,Platform:Windows7/8/10/XP/Vista7/8 / Linux & Mac OS (Az oldalsó gombok nem elérhetők),USB nano vevőegység mellékelve:Igen,DPI szint:2600/2000/1600/1200/800,Csatlakozási technológia:2.4 GHz-es vezeték nélküli,Maximális akkumulátor-élettartam:24 hónap,Elemek száma:2 AA (nem tartalmazza)'),
(42, 79, 'Fehér', 'Műanyag', 'Vezeték nélküli', 'Apple', 'APPMM-2', 'Rendszerkövetelmények:Bluetooth-kompatibilis Mac OS X 10.11 vagy újabb rendszerrel / iPad iPadOS 13.4 vagy újabb verzióval,Port típusa:USB-C'),
(45, 82, 'Fekete', 'Műanyag', 'Vezeték nélküli', 'Apple', 'APPMM-2', 'Rendszerkövetelmények:Bluetooth-kompatibilis Mac OS X 10.11 vagy újabb rendszerrel / iPad iPadOS 13.4 vagy újabb verzióval,Port típusa:USB-C');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `pid` int NOT NULL,
  `description` varchar(6144) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `stars` int NOT NULL,
  `privacy` tinyint(1) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `uid`, `pid`, `description`, `stars`, `privacy`, `date`) VALUES
(1, 1, 1, '<p>Ez egy jó számológép. Remekül működik. Több funkciója van, mint amennyit valószínűleg valaha is használni fogok. Akkor miért nem ajánlom?</p><p><br></p><p><strong>Tervezési hibája van.</strong></p><p><br></p><p>Csatoltam 3 fotót, ahol a képernyő látható. Észre fogja venni, hogy amikor bekapcsolja a számológépet, és szögből nézi (<em>mintha az asztalon tartotta volna tesztelés közben</em>), a számok <strong>nem</strong> <strong>olvashatók</strong>. A látóvonalnak majdnem merőlegesnek vagy egyenesnek kell lennie, hogy tisztán lássa. <strong>Ez nem befolyásolja a számológép működését</strong>, de kényelmetlenné válik, ha a számológép fölé kell húzni, vagy fel kell emelni az olvasáshoz. Egy tesztfelvétel során ez az állandó mozgás elég gyanús volt ahhoz, hogy a proktor figyelmeztetését indokolja.</p>', 3, 1, '2022-08-05 11:07:06'),
(2, 8, 3, '<p>Ez egy kiváló számológép. Dolgozom a munkahelyemen a 6 szigmás zöldövezet minősítésén, a vizsgához pedig egy \"alfabetikus billentyűzet nélküli számológép\" kell. Tehát nem tudtam használni a régi <a href=\"https://www.amazon.com/Texas-Instruments-TI-89-Advanced-Graphing-Calculator/dp/B00000JF55/ref=cm_cr_dp_d_rvw_txt?ie=UTF8\" target=\"_blank\">Texas Instruments TI-89 Advanced Graphing Calculator-</a>omat az egyetemről vagy a <a href=\"https://www.amazon.com/Texas-Instruments-TI-85-Advanced-Graphing-Scientific-Calculator/dp/B008LZM1CQ/ref=cm_cr_dp_d_rvw_txt?ie=UTF8\" target=\"_blank\">Texas Instruments TI-85 Advanced Graphing Scientific Calculator</a>-omat a középiskolából. Még csak néhány hete használom, de már most lenyűgözött, milyen könnyű vele dolgozni. Kifejezetten lenyűgöz a statisztikai képessége – azt hittem volna, hogy nagyobb teljesítményű grafikus számológépre lesz szüksége, hogy elvégezze azokat a dolgokat, amelyeket ezzel a kis sráccal meg tudtam csinálni.</p>', 5, 0, '2022-08-05 11:09:28'),
(8, 1, 66, '<p>Ez egy kiváló számológép. Dolgozom a munkahelyemen a 6 szigmás zöldövezet minősítésén, a vizsgához pedig egy \"alfabetikus billentyűzet nélküli számológép\" kell. Tehát nem tudtam használni a régi <a href=\"https://www.amazon.com/Texas-Instruments-TI-89-Advanced-Graphing-Calculator/dp/B00000JF55/ref=cm_cr_dp_d_rvw_txt?ie=UTF8\" target=\"_blank\">Texas Instruments TI-89 Advanced Graphing Calculator-</a>omat az egyetemről vagy a <a href=\"https://www.amazon.com/Texas-Instruments-TI-85-Advanced-Graphing-Scientific-Calculator/dp/B008LZM1CQ/ref=cm_cr_dp_d_rvw_txt?ie=UTF8\" target=\"_blank\">Texas Instruments TI-85 Advanced Graphing Scientific Calculator</a>-omat a középiskolából. Még csak néhány hete használom, de már most lenyűgözött, milyen könnyű vele dolgozni. Kifejezetten lenyűgöz a statisztikai képessége – azt hittem volna, hogy nagyobb teljesítményű grafikus számológépre lesz szüksége, hogy elvégezze azokat a dolgokat, amelyeket ezzel a kis sráccal meg tudtam csinálni.</p>', 3, 0, '2022-09-10 11:57:37'),
(9, 9, 1, '<p>Ez egy kiváló számológép. Dolgozom a munkahelyemen a 6 szigmás zöldövezet minősítésén, a vizsgához pedig egy \"alfabetikus billentyűzet nélküli számológép\" kell. Tehát nem tudtam használni a régi <a href=\"https://www.amazon.com/Texas-Instruments-TI-89-Advanced-Graphing-Calculator/dp/B00000JF55/ref=cm_cr_dp_d_rvw_txt?ie=UTF8\" target=\"_blank\">Texas Instruments TI-89 Advanced Graphing Calculator-</a>omat az egyetemről vagy a <a href=\"https://www.amazon.com/Texas-Instruments-TI-85-Advanced-Graphing-Scientific-Calculator/dp/B008LZM1CQ/ref=cm_cr_dp_d_rvw_txt?ie=UTF8\" target=\"_blank\">Texas Instruments TI-85 Advanced Graphing Scientific Calculator</a>-omat a középiskolából. Még csak néhány hete használom, de már most lenyűgözött, milyen könnyű vele dolgozni. Kifejezetten lenyűgöz a statisztikai képessége – azt hittem volna, hogy nagyobb teljesítményű grafikus számológépre lesz szüksége, hogy elvégezze azokat a dolgokat, amelyeket ezzel a kis sráccal meg tudtam csinálni.</p>', 5, 0, '2022-09-10 11:57:37'),
(20, 1, 63, '<p>A férjem ebédes táskájába vettem, mert a hűtő fogantyúja folyamatosan leesett, és egy nagy zacskó kell neki az ebédhez, mert sok italt hord, ez tökéletes volt!</p><p>Már egy ideje tart, és úgy gondolom, hogy ez az új dolog megérte a pénzét</p>', 5, 1, '2022-09-17 16:22:29'),
(21, 10, 59, '<p><a href=\"MOBIL.COM\" target=\"_blank\">ikshdfhishflckdnkjhfeiwHAJDNC</a></p><p><a href=\"MOBIL.COM\" target=\"_blank\">NLKEsklídvkjshkjfhckjsídb</a></p><p>cjkgfkjsdn,jcs,mdjcdsh</p><p>fhwjkenjfdb</p><p>gvjhdfbrgkhrefukdsjhsdhkhekjhKEŰ</p><p><br></p>', 4, NULL, '2022-10-18 07:05:27'),
(22, 10, 1, '<p>Nagyon jó termék. </p>', 4, 1, '2022-10-24 07:27:15'),
(23, 11, 70, '<p>Borzalmasan rossz ez a számológép kérem vissza most azonnal az árát!</p>', 1, 0, '2022-10-24 08:39:44'),
(24, 11, 68, '<p>Nagyon jó a termék kedvenc színemben rendeltem meg ez a menta zöld valami mesés egy szín!</p>', 5, 1, '2022-10-24 08:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `rvr__w`
--

CREATE TABLE `rvr__w` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rv__d`
--

CREATE TABLE `rv__d` (
  `id` int NOT NULL,
  `rid` int NOT NULL,
  `uid` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rv__r`
--

CREATE TABLE `rv__r` (
  `id` int NOT NULL,
  `rid` int NOT NULL,
  `uid` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `rv__r`
--

INSERT INTO `rv__r` (`id`, `rid`, `uid`, `date`) VALUES
(2, 2, 1, '2022-08-08 09:37:59'),
(3, 9, 10, '2022-10-24 07:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `rv__u`
--

CREATE TABLE `rv__u` (
  `id` int NOT NULL,
  `rid` int NOT NULL,
  `uid` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `rv__u`
--

INSERT INTO `rv__u` (`id`, `rid`, `uid`, `date`) VALUES
(8, 1, 8, '2022-08-06 10:15:59'),
(21, 1, 9, '2022-08-06 15:43:58'),
(23, 2, 9, '2022-08-26 19:14:30'),
(26, 9, 10, '2022-10-24 07:27:30'),
(27, 23, 1, '2022-10-24 08:46:17'),
(28, 24, 1, '2022-12-10 16:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `token` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `agent` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `expiry` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `uid`, `token`, `agent`, `expiry`, `date`) VALUES
(1, 1, '718f8cc0b50a6c9a7423e203c65f686d1e4ea1e51f1fd20236c9bc943624406fabcb140062c21ebdc32e99f161fae350233e1db84f1898eb45b02d12c883f727c392181fc6c9b4426f94ecb52e79e1cf92b3f4a481acaabaa6ce658e772b204035c6b7b6a586c305f7f89af217721d37883bcd9cc675113ba6bf7aa2addaf82b6f15ded58466bf5d5052e58bd5ee938aa81d0ef5b2f5d89c5bbf76dce2126b6f827c4a998dcf5a8a07469833dff06683d636f8f98ffdea9f87aa65813822ff998045762d01a37e352c08cc1de74a1cb5312938fed573f1202b1c9cbf3cc1ef180101599d0aca578cf848e62b7c261eff06edc1ebf525a1d70c0d04c984abcd3a', 'Chrome:102.0.0.0:Linux', 1687191313, '2022-06-19 16:15:13');

-- --------------------------------------------------------

--
-- Table structure for table `u__email`
--

CREATE TABLE `u__email` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `valid` tinyint(1) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `u__email`
--

INSERT INTO `u__email` (`id`, `uid`, `email`, `valid`, `date`) VALUES
(6, 11, 'gemesiandrea@gmai.com', 0, '2022-10-24 07:19:50'),
(5, 10, 'gemesifanni@gmail.com', 0, '2022-10-18 06:48:35'),
(4, 9, 'kovacsjani@email.com', 0, '2022-10-27 08:36:30'),
(1, 1, 'martinaszity@icloud.com', 0, '2022-06-12 16:29:32'),
(3, 8, 'mintamisi@email.com', 0, '2022-10-27 08:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `u__password`
--

CREATE TABLE `u__password` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `factor` tinyint(1) NOT NULL DEFAULT '0',
  `factor__type` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `u__password`
--

INSERT INTO `u__password` (`id`, `uid`, `password`, `factor`, `factor__type`, `date`) VALUES
(1, 1, '$2y$10$gJFV872qGobbfmJOusgIee.8PXlX0WLYDWsTELKOV1Q8gL6A54MLC', 0, NULL, '2022-06-19 16:24:41'),
(3, 8, '$2y$10$U/gV9fAbjayNnzNKt7WVruVCFynwv4S7bhiF.BFHJTzVZDkMduWPi', 0, NULL, '2022-06-20 18:53:28'),
(4, 9, '$2y$10$PYIkXT6ACwm/3PgLYXMVuu1DZ6zWoPW9ygNii3yQ1FYpawwCWh78i', 0, NULL, '2022-07-30 08:31:49'),
(5, 10, '$2y$10$xc/Iph/BymaaLlJR4pZzde7XcLwuxOr.vU8rswiEGrbYsPQW0KGkK', 0, NULL, '2022-10-18 06:48:35'),
(6, 11, '$2y$10$JKHv8hwcJZNKOHcVUUytYeHLCLgnlsIJosS5mkfCoUS94HnGXVGM.', 0, NULL, '2022-10-24 07:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `u__pass__history`
--

CREATE TABLE `u__pass__history` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `status` int NOT NULL,
  `browser` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `device` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `sys` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `u__pass__history`
--

INSERT INTO `u__pass__history` (`id`, `uid`, `location`, `country`, `status`, `browser`, `device`, `sys`, `ip`, `date`) VALUES
(1, 1, 'Budapest', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '37.76.28.187', '2022-06-19 16:07:21'),
(2, 1, 'Budapest', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '37.76.28.187', '2022-06-19 16:09:22'),
(3, 1, 'Budapest', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '37.76.28.187', '2022-06-19 16:10:23'),
(4, 8, 'Budapest', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '37.76.1.192', '2022-06-24 13:09:52'),
(5, 8, 'Budapest', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '37.76.1.192', '2022-06-24 13:20:25'),
(6, 8, 'Budapest', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '37.76.1.192', '2022-06-24 13:21:22'),
(7, 8, 'Budapest', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '37.76.1.192', '2022-06-24 13:21:55'),
(8, 1, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-17 06:15:05'),
(9, 1, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-17 06:15:28'),
(10, 1, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-17 06:20:43'),
(11, 1, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-17 06:20:55'),
(12, 1, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-17 06:24:20'),
(13, 1, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-17 06:24:29'),
(14, 1, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-17 06:28:24'),
(15, 1, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-17 06:28:30'),
(16, 1, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-17 06:48:07'),
(17, 1, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-17 06:48:19'),
(18, 10, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Windows', '195.199.179.161', '2022-10-24 07:10:29'),
(19, 1, 'Baja', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '195.199.179.161', '2022-10-27 08:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `value` int NOT NULL,
  `cf` tinyint NOT NULL,
  `active` tinyint DEFAULT NULL,
  `expiry` datetime NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `uid`, `code`, `category`, `description`, `value`, `cf`, `active`, `expiry`, `created`) VALUES
(1, 1, 'TU-SZ-231231', 'Számológépek', '10% kedvezmény minden számológépre.', 10, 0, 1, '2024-01-01 00:00:00', '2022-12-19 10:40:06'),
(2, 1, 'CM-AI-221231', '*', '25% év végi leárazás minden termékünkre.', 25, 1, 1, '2023-01-01 00:00:00', '2022-12-19 10:45:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers__card`
--
ALTER TABLE `customers__card`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `customers__card__deleted`
--
ALTER TABLE `customers__card__deleted`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `customers__card__info`
--
ALTER TABLE `customers__card__info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `customers__card__primary`
--
ALTER TABLE `customers__card__primary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `customers__card__subscription`
--
ALTER TABLE `customers__card__subscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `customers__deactivated`
--
ALTER TABLE `customers__deactivated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `customers__deleted`
--
ALTER TABLE `customers__deleted`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `customers__header`
--
ALTER TABLE `customers__header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `customers__inv`
--
ALTER TABLE `customers__inv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `customers__lang`
--
ALTER TABLE `customers__lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `customers__money`
--
ALTER TABLE `customers__money`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `customers__priv`
--
ALTER TABLE `customers__priv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `customers__ship`
--
ALTER TABLE `customers__ship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `customers__subpay__pool`
--
ALTER TABLE `customers__subpay__pool`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `customers__subscription__data`
--
ALTER TABLE `customers__subscription__data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers__subscription__payment`
--
ALTER TABLE `customers__subscription__payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `customers__token`
--
ALTER TABLE `customers__token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `customers__transactions`
--
ALTER TABLE `customers__transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `def__header`
--
ALTER TABLE `def__header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `def__news`
--
ALTER TABLE `def__news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `def__news__status`
--
ALTER TABLE `def__news__status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nid` (`nid`);

--
-- Indexes for table `def__page`
--
ALTER TABLE `def__page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `e__banned`
--
ALTER TABLE `e__banned`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `e__subs`
--
ALTER TABLE `e__subs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`uid`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `login__attempts`
--
ALTER TABLE `login__attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `orders__invoice`
--
ALTER TABLE `orders__invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oid` (`oid`);

--
-- Indexes for table `orders__old`
--
ALTER TABLE `orders__old`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `orders__payment`
--
ALTER TABLE `orders__payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oid` (`oid`);

--
-- Indexes for table `orders__sh`
--
ALTER TABLE `orders__sh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oid` (`oid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `orders__ship`
--
ALTER TABLE `orders__ship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oid` (`oid`);

--
-- Indexes for table `orders__user`
--
ALTER TABLE `orders__user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oid` (`oid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products__category`
--
ALTER TABLE `products__category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `products__inventory`
--
ALTER TABLE `products__inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `products__media`
--
ALTER TABLE `products__media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `products__meta`
--
ALTER TABLE `products__meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `products__pricing`
--
ALTER TABLE `products__pricing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `products__review`
--
ALTER TABLE `products__review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `products__search`
--
ALTER TABLE `products__search`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);
ALTER TABLE `products__search` ADD FULLTEXT KEY `name` (`name`,`category`,`tags`,`brand`);

--
-- Indexes for table `products__shipping`
--
ALTER TABLE `products__shipping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `products__status`
--
ALTER TABLE `products__status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `products__variations`
--
ALTER TABLE `products__variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `rvr__w`
--
ALTER TABLE `rvr__w`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `rv__d`
--
ALTER TABLE `rv__d`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `rv__r`
--
ALTER TABLE `rv__r`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `rv__u`
--
ALTER TABLE `rv__u`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `u__email`
--
ALTER TABLE `u__email`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `u__password`
--
ALTER TABLE `u__password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `u__pass__history`
--
ALTER TABLE `u__pass__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers__card`
--
ALTER TABLE `customers__card`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `customers__card__deleted`
--
ALTER TABLE `customers__card__deleted`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers__card__info`
--
ALTER TABLE `customers__card__info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `customers__card__primary`
--
ALTER TABLE `customers__card__primary`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `customers__card__subscription`
--
ALTER TABLE `customers__card__subscription`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers__deactivated`
--
ALTER TABLE `customers__deactivated`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers__deleted`
--
ALTER TABLE `customers__deleted`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers__header`
--
ALTER TABLE `customers__header`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers__inv`
--
ALTER TABLE `customers__inv`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers__lang`
--
ALTER TABLE `customers__lang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers__money`
--
ALTER TABLE `customers__money`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers__priv`
--
ALTER TABLE `customers__priv`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers__ship`
--
ALTER TABLE `customers__ship`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers__subpay__pool`
--
ALTER TABLE `customers__subpay__pool`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers__subscription__data`
--
ALTER TABLE `customers__subscription__data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers__subscription__payment`
--
ALTER TABLE `customers__subscription__payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers__token`
--
ALTER TABLE `customers__token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `customers__transactions`
--
ALTER TABLE `customers__transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `def__header`
--
ALTER TABLE `def__header`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `def__news`
--
ALTER TABLE `def__news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `def__news__status`
--
ALTER TABLE `def__news__status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `def__page`
--
ALTER TABLE `def__page`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `e__banned`
--
ALTER TABLE `e__banned`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `e__subs`
--
ALTER TABLE `e__subs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `login__attempts`
--
ALTER TABLE `login__attempts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders__invoice`
--
ALTER TABLE `orders__invoice`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders__old`
--
ALTER TABLE `orders__old`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders__payment`
--
ALTER TABLE `orders__payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders__sh`
--
ALTER TABLE `orders__sh`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders__ship`
--
ALTER TABLE `orders__ship`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders__user`
--
ALTER TABLE `orders__user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `products__category`
--
ALTER TABLE `products__category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `products__inventory`
--
ALTER TABLE `products__inventory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `products__media`
--
ALTER TABLE `products__media`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `products__meta`
--
ALTER TABLE `products__meta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `products__pricing`
--
ALTER TABLE `products__pricing`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `products__review`
--
ALTER TABLE `products__review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `products__search`
--
ALTER TABLE `products__search`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `products__shipping`
--
ALTER TABLE `products__shipping`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `products__status`
--
ALTER TABLE `products__status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `products__variations`
--
ALTER TABLE `products__variations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rvr__w`
--
ALTER TABLE `rvr__w`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rv__d`
--
ALTER TABLE `rv__d`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rv__r`
--
ALTER TABLE `rv__r`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rv__u`
--
ALTER TABLE `rv__u`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `u__email`
--
ALTER TABLE `u__email`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `u__password`
--
ALTER TABLE `u__password`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `u__pass__history`
--
ALTER TABLE `u__pass__history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers__card`
--
ALTER TABLE `customers__card`
  ADD CONSTRAINT `customers__card_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers__card__deleted`
--
ALTER TABLE `customers__card__deleted`
  ADD CONSTRAINT `customers__card__deleted_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers__card__info`
--
ALTER TABLE `customers__card__info`
  ADD CONSTRAINT `customers__card__info_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers__card__info_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `customers__card` (`cid`) ON DELETE CASCADE;

--
-- Constraints for table `customers__card__primary`
--
ALTER TABLE `customers__card__primary`
  ADD CONSTRAINT `customers__card__primary_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers__card__primary_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `customers__card` (`cid`) ON DELETE CASCADE;

--
-- Constraints for table `customers__card__subscription`
--
ALTER TABLE `customers__card__subscription`
  ADD CONSTRAINT `customers__card__subscription_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers__deactivated`
--
ALTER TABLE `customers__deactivated`
  ADD CONSTRAINT `customers__deactivated_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers__deleted`
--
ALTER TABLE `customers__deleted`
  ADD CONSTRAINT `customers__deleted_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers__header`
--
ALTER TABLE `customers__header`
  ADD CONSTRAINT `customers__header_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers__inv`
--
ALTER TABLE `customers__inv`
  ADD CONSTRAINT `customers__inv_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers__lang`
--
ALTER TABLE `customers__lang`
  ADD CONSTRAINT `customers__lang_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers__money`
--
ALTER TABLE `customers__money`
  ADD CONSTRAINT `customers__money_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers__priv`
--
ALTER TABLE `customers__priv`
  ADD CONSTRAINT `customers__priv_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers__ship`
--
ALTER TABLE `customers__ship`
  ADD CONSTRAINT `customers__ship_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers__subpay__pool`
--
ALTER TABLE `customers__subpay__pool`
  ADD CONSTRAINT `customers__subpay__pool_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers__subpay__pool_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `customers__card` (`cid`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers__subpay__pool_ibfk_3` FOREIGN KEY (`sid`) REFERENCES `customers__subscription__data` (`id`);

--
-- Constraints for table `customers__subscription__payment`
--
ALTER TABLE `customers__subscription__payment`
  ADD CONSTRAINT `customers__subscription__payment_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers__token`
--
ALTER TABLE `customers__token`
  ADD CONSTRAINT `customers__token_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers__transactions`
--
ALTER TABLE `customers__transactions`
  ADD CONSTRAINT `customers__transactions_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers__transactions_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `customers__card` (`cid`) ON DELETE CASCADE;

--
-- Constraints for table `def__header`
--
ALTER TABLE `def__header`
  ADD CONSTRAINT `def__header_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `def__news`
--
ALTER TABLE `def__news`
  ADD CONSTRAINT `def__news_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `def__news__status`
--
ALTER TABLE `def__news__status`
  ADD CONSTRAINT `def__news__status_ibfk_1` FOREIGN KEY (`nid`) REFERENCES `def__news` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `def__page`
--
ALTER TABLE `def__page`
  ADD CONSTRAINT `def__page_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `e__banned`
--
ALTER TABLE `e__banned`
  ADD CONSTRAINT `e__banned_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `e__subs`
--
ALTER TABLE `e__subs`
  ADD CONSTRAINT `e__subs_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`);

--
-- Constraints for table `login__attempts`
--
ALTER TABLE `login__attempts`
  ADD CONSTRAINT `login__attempts_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders__invoice`
--
ALTER TABLE `orders__invoice`
  ADD CONSTRAINT `orders__invoice_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders__old`
--
ALTER TABLE `orders__old`
  ADD CONSTRAINT `orders__old_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders__old_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders__payment`
--
ALTER TABLE `orders__payment`
  ADD CONSTRAINT `orders__payment_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders__ship`
--
ALTER TABLE `orders__ship`
  ADD CONSTRAINT `orders__ship_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders__user`
--
ALTER TABLE `orders__user`
  ADD CONSTRAINT `orders__user_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD CONSTRAINT `vouchers_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
