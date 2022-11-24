-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2022 at 05:59 PM
-- Server version: 8.0.29-0ubuntu0.22.04.2
-- PHP Version: 8.1.2

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
  `uid` int NOT NULL,
  `product_id` int NOT NULL,
  `product_code` varchar(32) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `uid`, `product_id`, `product_code`, `added`) VALUES
(2, 1, 49, 'KEN347FEK', '2022-06-11 20:18:04');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `pid` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `uid`, `pid`, `quantity`, `added`) VALUES
(5, 8, 48, 1, '2022-06-20 18:59:56'),
(6, 8, 55, 1, '2022-06-20 19:00:05'),
(11, 1, 49, 1, '2022-06-21 11:57:50'),
(12, 1, 54, 2, '2022-06-21 13:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `phone` int NOT NULL,
  `fax` int NOT NULL,
  `theme` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL DEFAULT 'auto',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fullname`, `email`, `password`, `phone`, `fax`, `theme`, `date`) VALUES
(1, 'Ászity Martin', 'martinaszity@icloud.com', '$2y$10$gJFV872qGobbfmJOusgIee.8PXlX0WLYDWsTELKOV1Q8gL6A54MLC', 307106140, 123456789, 'light', '2022-02-15 14:39:49'),
(8, 'Minta Misi', 'mintamisi@email.com', '$2y$10$U/gV9fAbjayNnzNKt7WVruVCFynwv4S7bhiF.BFHJTzVZDkMduWPi', 309876543, 123456789, 'light', '2022-06-20 18:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `customers__card`
--

CREATE TABLE `customers__card` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `cid` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `cardname` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `cardnum` varchar(4) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `expiry` date NOT NULL,
  `cvc` varchar(3) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `value` int NOT NULL DEFAULT '30000',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__card`
--

INSERT INTO `customers__card` (`id`, `uid`, `cid`, `cardname`, `cardnum`, `expiry`, `cvc`, `value`, `date`) VALUES
(3, 1, '4325df90sdf8', 'Mappa+ kártya', '6249', '2025-06-01', '961', 98500, '2022-06-14 12:43:40'),
(63, 8, '4576c72455f5ca96c1', 'PayPal', '2026', '2022-06-30', '158', 30000, '2022-06-23 16:35:25'),
(6, 1, '5f40c7429411', 'Mastercard', '5678', '2024-06-21', '129', 16000, '2022-06-21 08:35:12'),
(8, 1, '68435fca8a1e', 'PayPal', '9343', '2024-06-22', '784', 30000, '2022-06-22 07:56:43'),
(27, 8, 'd1445037c37e', 'Mappa+ kártya', '1473', '2022-06-29', '637', 100000, '2022-06-22 19:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `customers__card__deleted`
--

CREATE TABLE `customers__card__deleted` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `cid` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__card__deleted`
--

INSERT INTO `customers__card__deleted` (`id`, `uid`, `cid`, `date`) VALUES
(5, 8, '4576c7159705430734', '2022-06-23 17:26:37'),
(7, 1, '734467a51a8c6a4bbf', '2022-06-24 19:41:20');

-- --------------------------------------------------------

--
-- Table structure for table `customers__card__info`
--

CREATE TABLE `customers__card__info` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `cid` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `number` varchar(16) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `holder` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__card__info`
--

INSERT INTO `customers__card__info` (`id`, `uid`, `cid`, `number`, `holder`, `type`, `provider`, `date`) VALUES
(1, 1, '4325df90sdf8', '1235140830146249', 'Ásztiy Martin', 'Virtuális kártya', 'Mappa Papír Kft.', '2022-06-14 12:53:36'),
(6, 1, '5f40c7429411', '1234123456785678', 'Ásztiy Martin', 'Mastercard kredit kártya', 'Mastercard Inc.', '2022-06-21 08:35:12'),
(8, 1, '68435fca8a1e', '8324994472389343', 'Ászity Martin', 'PayPal virtuális kártya', 'PayPal Inc.', '2022-06-22 07:56:43'),
(27, 8, 'd1445037c37e', '9613595646741473', 'Minta Misi', 'Virtuális kártya', 'Mappa Papír Kft.', '2022-06-22 19:15:54'),
(63, 8, '4576c72455f5ca96c1', '1991383549622026', 'Minta Misi', 'PayPal virtuális kártya', 'PayPal Inc.', '2022-06-23 16:35:25');

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
(46, 1, '4325df90sdf8', '2022-06-24 19:41:20');

-- --------------------------------------------------------

--
-- Table structure for table `customers__card__subscription`
--

CREATE TABLE `customers__card__subscription` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `sub` int NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__card__subscription`
--

INSERT INTO `customers__card__subscription` (`id`, `uid`, `sub`, `date`) VALUES
(1, 1, 2, '2022-06-27 13:22:25'),
(2, 8, 1, '2022-06-23 15:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `customers__deactivated`
--

CREATE TABLE `customers__deactivated` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers__deleted`
--

CREATE TABLE `customers__deleted` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers__inv`
--

CREATE TABLE `customers__inv` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `settlement` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `postal` int NOT NULL,
  `tax` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__inv`
--

INSERT INTO `customers__inv` (`id`, `uid`, `company`, `settlement`, `address`, `postal`, `tax`, `date`) VALUES
(1, 1, 'Mappa Papír Kft.', 'Kiskunhalas', 'Kossuth utca 13-15', 6400, 123456789, '2022-02-15 14:39:49'),
(3, 8, 'Minta Kft', 'Kiskunhalas', 'Minta utca 3', 6400, 123456789, '2022-06-20 18:53:28');

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
(3, 8, 'hu', 'Budapest', 7200, '2022-06-20 18:53:28');

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
(3, 8, 100000, 'HUF', '2022-06-20 18:53:28');

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
(3, 8, 0, '2022-06-20 18:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `customers__ship`
--

CREATE TABLE `customers__ship` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `settlement` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `postal` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__ship`
--

INSERT INTO `customers__ship` (`id`, `uid`, `settlement`, `address`, `postal`, `date`) VALUES
(1, 1, 'Kunfehértó', 'Kossuth utca 24', 6413, '2022-02-15 14:39:49'),
(3, 8, 'Kiskunhalas', 'Minta Utca 11', 6400, '2022-06-20 18:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `customers__subpay__pool`
--

CREATE TABLE `customers__subpay__pool` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `cid` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `sid` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__subpay__pool`
--

INSERT INTO `customers__subpay__pool` (`id`, `uid`, `cid`, `sid`, `date`) VALUES
(1, 1, '4325df90sdf8', 2, '2022-05-27 13:22:25'),
(2, 8, 'd1445037c37e', 2, '2022-05-23 15:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `customers__subscription__data`
--

CREATE TABLE `customers__subscription__data` (
  `id` int NOT NULL,
  `type` varchar(64) COLLATE utf8mb4_hungarian_ci NOT NULL,
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
(1, 1, '4325df90sdf8', '2022-06-27 08:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `customers__token`
--

CREATE TABLE `customers__token` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `token` varchar(1024) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `agent` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
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
(21, 8, '2bca8699bde6ea3e9efe62233f0d860383101ded102d29b7b9de2d186ccb1ffd', 'Chrome:103.0.0.0:Linux', 1687779037, '2022-06-26 11:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `customers__transactions`
--

CREATE TABLE `customers__transactions` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `cid` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `item` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `price` int NOT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `note` varchar(1024) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__transactions`
--

INSERT INTO `customers__transactions` (`id`, `uid`, `cid`, `item`, `price`, `type`, `note`, `date`) VALUES
(1, 1, '4325df90sdf8', 'su_2', 1500, 0, 'csomagra való feliratkozás', '2022-06-27 13:22:25'),
(2, 1, '5f40c7429411', '', 5000, 1, 'funkció hiba okozta kártérítés', '2022-06-27 15:50:33'),
(3, 1, '68435fca8a1e', 'pr_58', 10870, 0, 'termék megvásárlása', '2022-06-27 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `e__banned`
--

CREATE TABLE `e__banned` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e__subs`
--

CREATE TABLE `e__subs` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `disc` int NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `e__subs`
--

INSERT INTO `e__subs` (`id`, `uid`, `email`, `disc`, `date`) VALUES
(2, 1, 'martinaszity@icloud.com', 0, '2022-06-11 14:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `target_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `description` varchar(2048) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
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
-- Table structure for table `login__attempts`
--

CREATE TABLE `login__attempts` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `status` int NOT NULL,
  `browser` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `device` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `sys` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
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
(11, 8, 'Kiskunhalas', 'Hungary', 1, 'Chrome', 'desktop', 'Linux', '81.183.188.150', '2022-06-26 11:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `uid` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
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
  `pid` int NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders__sh`
--

CREATE TABLE `orders__sh` (
  `id` int NOT NULL,
  `oid` int NOT NULL,
  `uid` int NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `settlement` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `postal` int NOT NULL,
  `phone` int NOT NULL,
  `note` varchar(1024) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `product_code` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_quantity` int NOT NULL,
  `product_quantity_unit` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_brand` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_type` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_color` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_info` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_width` int NOT NULL,
  `product_width_unit` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_height` int NOT NULL,
  `product_height_unit` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_length` int NOT NULL,
  `product_length_unit` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_image` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_price` int NOT NULL,
  `product_price_unit` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_code`, `product_quantity`, `product_quantity_unit`, `product_brand`, `product_type`, `product_color`, `product_name`, `product_info`, `product_width`, `product_width_unit`, `product_height`, `product_height_unit`, `product_length`, `product_length_unit`, `product_image`, `product_price`, `product_price_unit`, `added`) VALUES
(9, 'DII341SZI', 30, 'db', 'Diplomat', 'Iratrendező', 'színes', 'Iratrendező', 'Papírral bevont kartonból készült, masszív tokos iratrendező, 35 mm-es\r\ngerincvastagsággal. Ragasztott gerinccímke, kihúzólyuk, kétgyűrűs\r\nszerkezet segíti a használatát. Irodai és otthoni használatra egyaránt.', 35, 'mm', 40, 'cm', 15, 'cm', '095470420220417213817.png', 890, 'huf', '2022-04-17 15:38:17'),
(10, 'EOF233FEH', 0, 'csom', 'Euro Office', 'Fénymásolópapír', 'fehér', 'Fénymásolópapír', 'Irodai papír általános felhasználásra -alkalmas fénymásolókba, faxokba,\r\nlézer és tintasugaras nyomtatókba - magas fehérség - gyors\r\nfutásteljesítmény - kiemelkedő teljesítmény a kategóriáján belül -', 210, 'cm', 35, 'cm', 300, 'mm', '583ce0020220417214135.png', 1530, 'huf', '2022-04-17 15:41:35'),
(11, 'GRG223FEH', 2, 'db', 'Gréta', 'Gyorsfűző', 'fehér', 'Gyorsfűző', 'Belül natúr, kívül fehér színű, 230 gr-os kartonból készült gyorsfűző\r\nmappa, elején feliratozásra alkalmas 3 vonalas nyomattal. A mappában\r\nelhelyezett lapok lyukasztás után a fémlefűző szerkezettel rögzíthetők.', 210, 'mm', 2, 'cm', 300, 'mm', '9319f4c20220417214349.png', 25, 'huf', '2022-04-17 15:43:49'),
(12, 'GRI223FEH', 30, 'db', 'Gréta', 'Iratgyűjtő', 'fehér', 'Iratgyűjtő', 'Belül natúr, kívül fehér színű, 230 gr-os kartonból készült három pólyás\r\niratgyűjtő mappa, elején feliratozásra alkalmas 3 vonalas nyomattal. A\r\nmappában elhelyezett lapok a behajtott pólyák segítségével akadályozzák', 210, 'mm', 2, 'cm', 300, 'mm', '320cef720220417214619.png', 30, 'huf', '2022-04-17 15:46:19'),
(13, 'KOH221FEH', 2, 'db', 'Kores', 'Hibajavító', 'fehér', 'Hibajavító', '0,9 mm-es golyóval a pontos javításért, egyenletes folyadékadagolás, gyorsan szárad, tökéletesen fed, kompakt kivitel, oldószeres, 10 ml-es kiszerelés.', 2, 'cm', 2, 'cm', 14, 'cm', 'cf9461f20220417215208.png', 340, 'huf', '2022-04-17 15:52:08'),
(14, 'SAL681KEK', 30, 'db', 'Sax', 'Lyukasztó', 'kék', 'Lyukasztó', 'Könnyűfém testű, fémszerkezetű lyukasztógép ütköztetőléccel. Egyszerre\r\nlyukasztható lapok száma: max. 30 lap. Lyuktávolság: 80 mm. Lyukátmérő:5,5\r\nmm.', 6, 'cm', 8, 'cm', 13, 'cm', 'af4ee1020220417215356.png', 2190, 'huf', '2022-04-17 15:53:56'),
(15, 'WEO641PIR', 30, 'db', 'Wedo', ' Olló', 'piros', ' Olló', 'Ergonomikus, gumírozott fogórész a kényelmes használat\r\nérdekében.Univerzális: papír, karton, öntapadós szalag, stb. vágására\r\nalkalmas. Rozsdamentes csiszolt acél él.', 6, 'cm', 3, 'cm', 16, 'cm', 'cc7526120220417220222.png', 495, 'huf', '2022-04-17 16:02:22'),
(16, 'EAP182KEK', 30, 'db', 'Eagle', 'Pénzkazetta', 'kék', 'Pénzkazetta', 'Egyszínű, fém, kulccsal zárható pénzkazetta, műanyag, kiemelhető érmetartóval.', 192, 'mm', 82, 'mm', 262, 'mm', '0721c7720220417220428.png', 3920, 'huf', '2022-04-17 16:04:28'),
(17, 'OPB383FEK', 30, 'db', 'Opoint', 'Bélyegzőfesték', 'fekete', 'Bélyegzőfesték', 'Bélyegző párna festék műanyag tubusban, hagyományos és automata\r\nbélyegzőkhöz.\r\nŰrtartalom: 30 ml.', 3, 'cm', 8, 'cm', 3, 'cm', 'f59cf1d20220417222001.png', 140, 'huf', '2022-04-17 16:20:01'),
(18, 'HAI532NAR', 30, 'db', 'Han', 'Iratpapucs', 'narancssárga', 'Iratpapucs', 'Újrahasznosított műanyagból készült irattartó, mely tárolásra és\r\narchiválásra egyaránt használható C/4 méretig. Praktikus kihúzólyukkal, és\r\náttekinhető kivitelben.', 5, 'cm', 30, 'cm', 25, 'cm', '65f632420220417222404.png', 860, 'huf', '2022-04-17 16:24:04'),
(19, 'HAI532KEK', 30, 'db', 'Han', 'Iratpapucs', 'kék', 'Iratpapucs', 'Újrahasznosított műanyagból készült irattartó, mely tárolásra és\r\narchiválásra egyaránt használható C/4 méretig. Praktikus kihúzólyukkal, és\r\náttekinhető kivitelben.', 5, 'cm', 30, 'cm', 25, 'cm', '019bce420220417222607.png', 860, 'huf', '2022-04-17 16:26:07'),
(20, 'HAI532ZOL', 30, 'db', 'Han', 'Iratpapucs', 'zöld', 'Iratpapucs', 'Újrahasznosított műanyagból készült irattartó, mely tárolásra és\r\narchiválásra egyaránt használható C/4 méretig. Praktikus kihúzólyukkal, és\r\náttekinhető kivitelben.', 5, 'cm', 30, 'cm', 25, 'cm', 'c2a997520220417222732.png', 860, 'huf', '2022-04-17 16:27:32'),
(21, 'HAI532ROZ', 30, 'db', 'Han', 'Iratpapucs', 'rózsaszín', 'Iratpapucs', 'Újrahasznosított műanyagból készült irattartó, mely tárolásra és\r\narchiválásra egyaránt használható C/4 méretig. Praktikus kihúzólyukkal, és\r\náttekinhető kivitelben.', 5, 'cm', 30, 'cm', 25, 'cm', '544fc9a20220417222904.png', 860, 'huf', '2022-04-17 16:29:04'),
(22, 'CUP232FEK', 30, 'db', 'Curver', 'Papírkosár', 'fekete', ' Papírkosár', 'Fekete színű, 11 literes műanyag papírkosár, 30 cm magassággal.', 20, 'cm', 30, 'cm', 20, 'cm', 'a063a0320220417223051.png', 690, 'huf', '2022-04-17 16:30:51'),
(23, 'SEA131EZU', 30, 'db', 'Sencor', 'Számológép', 'ezüst', 'Asztali számológép', 'Asztali számológép, kettős áramellátás, 12 számjegyes kijelző.\r\nJellemzők:\r\n- 12 számjegyes kijelző', 12, 'cm', 3, 'cm', 14, 'cm', 'd6223c020220417223255.png', 1990, 'huf', '2022-04-17 16:32:55'),
(24, 'EAP182PIR', 30, 'db', 'Eagle', 'Pénzkazetta', 'piros', 'Pénzkazetta', 'Egyszínű, fém, kulccsal zárható pénzkazetta, műanyag, kiemelhető érmetartóval.', 192, 'mm', 82, 'mm', 262, 'mm', '234628b20220417223655.png', 3920, 'huf', '2022-04-17 16:36:55'),
(25, 'BLJ368SZI', 30, 'csom', 'Bluering', 'Jelölőcímke', 'színes', 'Jelölőcímke', 'Műanyag, öntapadós, visszaszedhető nyíl alakú neon jelölő címke könyvek,\r\ndokumentumok oldalainak megjelölésére. Színek: rózsa, zöld, sárga, kék,\r\nnarancs.', 3, 'cm', 5, 'mm', 8, 'cm', 'f6ec88e20220417223841.png', 195, 'huf', '2022-04-17 16:38:41'),
(26, 'PAI322ROZ', 30, 'db', 'Pantaplast', 'Irattasak', 'rózsaszín', 'Irattasak', 'Kiválóan alkalmas A/4 méretű dokumentumok lyukasztás nélküli tárolására. 2\r\nzsebes kivitell, rugalmas, színes, pasztell színű polipropilén alapanyag,\r\npatent segítségével könnyen záródik. Méret: 330x235 mm.', 330, 'mm', 2, 'cm', 235, 'mm', '66e44f320220417224232.png', 290, 'huf', '2022-04-17 16:42:32'),
(27, 'PAI322KEK', 30, 'db', 'Pantaplast', 'Irattasak', 'kék', 'Irattasak', 'Kiválóan alkalmas A/4 méretű dokumentumok lyukasztás nélküli tárolására. 2\r\nzsebes kivitell, rugalmas, színes, pasztell színű polipropilén alapanyag,\r\npatent segítségével könnyen záródik. Méret: 330x235 mm.', 330, 'mm', 2, 'cm', 235, 'mm', '66e44f320220417224332.png', 290, 'huf', '2022-04-17 16:43:32'),
(28, 'PAI322SAR', 30, 'db', 'Pantaplast', 'Irattasak', 'sárga', 'Irattasak', 'Kiválóan alkalmas A/4 méretű dokumentumok lyukasztás nélküli tárolására. 2\r\nzsebes kivitell, rugalmas, színes, pasztell színű polipropilén alapanyag,\r\npatent segítségével könnyen záródik. Méret: 330x235 mm.', 330, 'mm', 2, 'cm', 235, 'mm', '66e44f320220417224432.png', 290, 'huf', '2022-04-17 16:44:32'),
(29, 'SUS211KEK', 30, 'csom', 'Submed', 'Szájmaszk', 'kék', ' Szájmaszk', 'Orvosi szájmaszk, egyszerhasználatos sterilizált védőmaszk. 3 rétegű\r\nkivitel, mely használat után eldobható. Az orvosi maszk a fülön\r\ngumipánttal rögzíthető. Könnyen felhelyezhető, stabil, kényelmes viseletet', 20, 'cm', 1, 'cm', 10, 'cm', '51a6c7520220417225136.png', 55, 'huf', '2022-04-17 16:51:36'),
(30, 'SET464FEK', 30, 'db', 'Securit', 'Tábla', 'fekete', ' Tábla', '40x60 cm-es krétatábla fa kerettel és mindkét oldalon írható felülettel.\r\nA csomag ajándék fehér krétamarkert tartalmaz. A tábla krétamarkerrel\r\nírható és nedves ruhával törölhető. Reklámhordozónak, információs táblának,', 40, 'cm', 60, 'cm', 4, 'cm', '16cd18f20220417225528.png', 4720, 'huf', '2022-04-17 16:55:28'),
(31, 'LUG111FEK', 30, 'db', 'Luxor', 'Írószer', 'fekete', 'Golyóstoll', 'Nyomógombos műanyag golyóstoll modern dizájnnal, kényelmes, gumírozott\r\nmarkolattal. Tolltest színével megegyező ultra alacsony viszkózitású\r\ntinta. Betét írásvastagsága 0,7 mm, nem cserélhető.', 15, 'mm', 15, 'mm', 145, 'mm', '78948e020220417225737.png', 120, 'huf', '2022-04-17 16:57:37'),
(32, 'LUG111KEK', 30, 'db', 'Luxor', 'Írószer', 'kék', 'Golyóstoll', 'Nyomógombos műanyag golyóstoll modern dizájnnal, kényelmes, gumírozott\r\nmarkolattal. Tolltest színével megegyező ultra alacsony viszkózitású\r\ntinta. Betét írásvastagsága 0,7 mm, nem cserélhető.', 15, 'mm', 15, 'mm', 145, 'mm', '78948e020220417225837.png', 120, 'huf', '2022-04-17 16:58:37'),
(33, 'LUG111PIR', 30, 'db', 'Luxor', 'Írószer', 'piros', 'Golyóstoll', 'Nyomógombos műanyag golyóstoll modern dizájnnal, kényelmes, gumírozott\r\nmarkolattal. Tolltest színével megegyező ultra alacsony viszkózitású\r\ntinta. Betét írásvastagsága 0,7 mm, nem cserélhető.', 15, 'mm', 15, 'mm', 145, 'mm', '78948e020220417225937.png', 120, 'huf', '2022-04-17 16:59:37'),
(34, 'LUG111ZOL', 30, 'db', 'Luxor', 'Írószer', 'zöld', 'Golyóstoll', 'Nyomógombos műanyag golyóstoll modern dizájnnal, kényelmes, gumírozott\r\nmarkolattal. Tolltest színével megegyező ultra alacsony viszkózitású\r\ntinta. Betét írásvastagsága 0,7 mm, nem cserélhető.', 15, 'mm', 15, 'mm', 145, 'mm', '78948e020220417230037.png', 120, 'huf', '2022-04-17 17:00:37'),
(35, 'SET464FEH', 30, 'db', 'Securit', 'Tábla', 'fehér', ' Tábla', '40x60 cm-es krétatábla fa kerettel és mindkét oldalon írható felülettel.\r\nA csomag ajándék fehér krétamarkert tartalmaz. A tábla krétamarkerrel\r\nírható és nedves ruhával törölhető. Reklámhordozónak, információs táblának,', 40, 'cm', 60, 'cm', 4, 'cm', '16cd18f20220417230528.png', 4720, 'huf', '2022-04-17 16:55:28'),
(36, 'SET464ZOL', 30, 'db', 'Securit', 'Tábla', 'zöld', ' Tábla', '40x60 cm-es krétatábla fa kerettel és mindkét oldalon írható felülettel.\r\nA csomag ajándék fehér krétamarkert tartalmaz. A tábla krétamarkerrel\r\nírható és nedves ruhával törölhető. Reklámhordozónak, információs táblának,', 40, 'cm', 60, 'cm', 4, 'cm', '16cd18f20220417230028.png', 4720, 'huf', '2022-04-17 16:55:28'),
(37, 'EAP182FEK', 30, 'db', 'Eagle', 'Pénzkazetta', 'fekete', 'Pénzkazetta', 'Egyszínű, fém, kulccsal zárható pénzkazetta, műanyag, kiemelhető érmetartóval.', 192, 'mm', 82, 'mm', 262, 'mm', '0721c7720220417220528.png', 3920, 'huf', '2022-04-17 16:05:28'),
(38, 'EDA221SAR', 30, 'db', 'EDDING', 'Írószer', 'sárga', 'Alkoholos marker', 'Kúpos kerek hegy. Vízálló, gyorsan száradó alkoholbázisú tinta.\r\nÍráshoz, színezéshez, fém, üveg és műanyag felületre használható. A kupak színe megegyezik a tinta színével. Nem maszatol\r\nVonalvastagság: 1,5-3 mm', 20, 'mm', 20, 'mm', 145, 'mm', '2501fd420220423140452.png', 300, 'huf', '2022-04-23 10:04:52'),
(39, 'EDA221NAR', 30, 'db', 'EDDING', 'Írószer', 'narancssárga', 'Alkoholos marker', 'Kúpos kerek hegy. Vízálló, gyorsan száradó alkoholbázisú tinta.\r\nÍráshoz, színezéshez, fém, üveg és műanyag felületre használható. A kupak színe megegyezik a tinta színével. Nem maszatol\r\nVonalvastagság: 1,5-3 mm', 20, 'mm', 20, 'mm', 145, 'mm', '2501fd420220423140500.png', 300, 'huf', '2022-04-23 10:05:00'),
(40, 'EDA221BAR', 30, 'db', 'EDDING', 'Írószer', 'barna', 'Alkoholos marker', 'Kúpos kerek hegy. Vízálló, gyorsan száradó alkoholbázisú tinta.\r\nÍráshoz, színezéshez, fém, üveg és műanyag felületre használható. A kupak színe megegyezik a tinta színével. Nem maszatol\r\nVonalvastagság: 1,5-3 mm', 20, 'mm', 20, 'mm', 145, 'mm', '2501fd420220423140600.png', 300, 'huf', '2022-04-23 10:06:00'),
(41, 'EDA221ROZ', 30, 'db', 'EDDING', 'Írószer', 'rózsaszín', 'Alkoholos marker', 'Kúpos kerek hegy. Vízálló, gyorsan száradó alkoholbázisú tinta.\r\nÍráshoz, színezéshez, fém, üveg és műanyag felületre használható. A kupak színe megegyezik a tinta színével. Nem maszatol\r\nVonalvastagság: 1,5-3 mm', 20, 'mm', 20, 'mm', 145, 'mm', '2501fd420220423140700.png', 300, 'huf', '2022-04-23 10:07:00'),
(42, 'EDA221LIL', 30, 'db', 'EDDING', 'Írószer', 'lila', 'Alkoholos marker', 'Kúpos kerek hegy. Vízálló, gyorsan száradó alkoholbázisú tinta.\r\nÍráshoz, színezéshez, fém, üveg és műanyag felületre használható. A kupak színe megegyezik a tinta színével. Nem maszatol\r\nVonalvastagság: 1,5-3 mm', 20, 'mm', 20, 'mm', 145, 'mm', '2501fd420220423140800.png', 300, 'huf', '2022-04-23 10:08:00'),
(43, 'CEA221FEK', 30, 'db', 'CENTROPEN', 'Írószer', 'fekete', 'Alkoholos marker', 'Csomagolási egység: 12 db/dob\r\n\r\nAlkohol bázisú, permanent festékkel töltött filctoll kúpos heggyel. Írásvastagság: 1-3 mm. Minden felületre ír, víz és hőálló, nem fakul.', 20, 'mm', 20, 'mm', 145, 'mm', '1c5bc8020220423141804.png', 175, 'huf', '2022-04-23 10:18:04'),
(44, 'CEA221KEK', 30, 'db', 'CENTROPEN', 'Írószer', 'kék', 'Alkoholos marker', 'Csomagolási egység: 12 db/dob\r\n\r\nAlkohol bázisú, permanent festékkel töltött filctoll kúpos heggyel. Írásvastagság: 1-3 mm. Minden felületre ír, víz és hőálló, nem fakul.', 20, 'mm', 20, 'mm', 145, 'mm', '1c5bc8020220423141900.png', 175, 'huf', '2022-04-23 10:19:00'),
(45, 'CEA221PIR', 30, 'db', 'CENTROPEN', 'Írószer', 'piros', 'Alkoholos marker', 'Csomagolási egység: 12 db/dob\r\n\r\nAlkohol bázisú, permanent festékkel töltött filctoll kúpos heggyel. Írásvastagság: 1-3 mm. Minden felületre ír, víz és hőálló, nem fakul.', 20, 'mm', 20, 'mm', 145, 'mm', '1c5bc8020220423142000.png', 175, 'huf', '2022-04-23 10:20:00'),
(46, 'FOA221KEK', 30, 'db', 'Fortuna', 'Írószer', 'kék', 'Alkoholos rostiron', 'Csomagolási egység: 40 db/csom\r\nAlkoholbázisú, permanent festékkel töltött marker precíziós fémfoglalatú írócsúccsal. Írásvastagság: 0,5mm.', 20, 'mm', 20, 'mm', 145, 'mm', 'abc631b20220423142447.png', 135, 'huf', '2022-04-23 10:24:47'),
(47, 'FOA221PIR', 29, 'db', 'Fortuna', 'Írószer', 'piros', 'Alkoholos rostiron', 'Csomagolási egység: 40 db/csom\r\nAlkoholbázisú, permanent festékkel töltött marker precíziós fémfoglalatú írócsúccsal. Írásvastagság: 0,5mm.', 20, 'mm', 20, 'mm', 145, 'mm', 'abc631b20220423142500.png', 135, 'huf', '2022-04-23 10:25:00'),
(48, 'FOA221ZOL', 30, 'db', 'Fortuna', 'Írószer', 'zöld', 'Alkoholos rostiron', 'Csomagolási egység: 40 db/csom\r\nAlkoholbázisú, permanent festékkel töltött marker precíziós fémfoglalatú írócsúccsal. Írásvastagság: 0,5mm.', 20, 'mm', 20, 'mm', 145, 'mm', 'abc631b20220423142600.png', 135, 'huf', '2022-04-23 10:26:00'),
(49, 'KEN347FEK', 30, 'db', 'Kensington', 'Táska', 'fekete', 'Notebook táska', 'A „Classic Sleeve” kivitel védi számítógépét. Párnázott belső notebook rekesz, belső irattároló zseb. Párnázott vállpánt. Első és hátsó külső zsebek, sok hellyel a kiegészítők számára.', 30, 'cm', 40, 'cm', 7, 'cm', '05449f720220423150248.png', 7870, 'huf', '2022-04-23 11:02:48'),
(50, 'MAN347FEK', 30, 'db', 'MANHATTAN', 'Táska', 'fekete', 'Notebook táska', 'Rendelésre!\r\nKönnyű, tartós, könnyen tisztítható vízálló anyag.\r\nKülső méret: 31 x 41 x 7 cm\r\nBelső méret: 29 x 39 x 5 cm', 30, 'cm', 40, 'cm', 7, 'cm', '05449f720220423150500.png', 3585, 'huf', '2022-04-23 11:05:48'),
(51, 'SIG221KEK', 30, 'db', 'Signetta', 'Írószer', 'kék', 'Golyóstoll', 'Eldobható golyóstoll biztonsági kupakkal, tinta színével megegyező tolltest. Vonalvastagság: 0,7 mm. Íráshossz: 2500 m.', 20, 'mm', 20, 'mm', 145, 'mm', '537755520220423150806.png', 55, 'huf', '2022-04-23 11:08:06'),
(52, 'SIG221PIR', 30, 'db', 'Signetta', 'Írószer', 'piros', 'Golyóstoll', 'Eldobható golyóstoll biztonsági kupakkal, tinta színével megegyező tolltest. Vonalvastagság: 0,7 mm. Íráshossz: 2500 m.', 20, 'mm', 20, 'mm', 145, 'mm', '537755520220423150900.png', 55, 'huf', '2022-04-23 11:09:00'),
(53, 'SIG221ZOL', 28, 'db', 'Signetta', 'Írószer', 'zöld', 'Golyóstoll', 'Eldobható golyóstoll biztonsági kupakkal, tinta színével megegyező tolltest. Vonalvastagság: 0,7 mm. Íráshossz: 2500 m.', 20, 'mm', 20, 'mm', 145, 'mm', '537755520220423151000.png', 55, 'huf', '2022-04-23 11:10:00'),
(54, 'CAS112NAR', 30, 'db', 'Casio', 'Számológép', 'narancssárga', 'Asztali számológép', '12 számjegyű, NAGY DÖNTÖTT KIJELZŐ, ÁFA számítás, valutaváltás, elem (1xLR44)+napelem, utolsó szám javítása, gyökvonás, %, 00, +/-, narancs szín.\r\nMéret: 149,5 x 104,5 x 22,1 mm', 145, 'mm', 105, 'mm', 22, 'mm', 'd1267f220220423152213.png', 4325, 'huf', '2022-04-23 11:22:13'),
(55, 'CAS112ZOL', 7, 'db', 'Casio', 'Számológép', 'zöld', 'Asztali számológép', '12 számjegyű, NAGY DÖNTÖTT KIJELZŐ, ÁFA számítás, valutaváltás, elem (1xLR44)+napelem, utolsó szám javítása, gyökvonás, %, 00, +/-, narancs szín.\r\nMéret: 149,5 x 104,5 x 22,1 mm', 145, 'mm', 105, 'mm', 22, 'mm', 'd1267f220220423152300.png', 4325, 'huf', '2022-04-23 11:23:00'),
(56, 'CAS112ROZ', 23, 'db', 'Casio', 'Számológép', 'rózsaszín', 'Asztali számológép', '12 számjegyű, NAGY DÖNTÖTT KIJELZŐ, ÁFA számítás, valutaváltás, elem (1xLR44)+napelem, utolsó szám javítása, gyökvonás, %, 00, +/-, narancs szín.\r\nMéret: 149,5 x 104,5 x 22,1 mm', 145, 'mm', 105, 'mm', 22, 'mm', 'd1267f220220423152400.png', 4325, 'huf', '2022-04-23 11:24:00'),
(57, 'CAS161FEK', 29, 'db', 'Casio', 'Számológép', 'fekete', 'Asztali számológép', '12 számjegyű, NAGY DÖNTÖTT KIJELZŐ, ÁFA számítás, valutaváltás, elem (1xLR44)+napelem, utolsó szám javítása, gyökvonás, %, 00, +/-, narancs szín.\r\nMéret: 149,5 x 104,5 x 22,1 mm', 105, 'mm', 60, 'mm', 10, 'mm', 'd1267f220220423153000.png', 1945, 'huf', '2022-04-23 11:30:00'),
(58, 'CAS162FEK', 28, 'db', 'Casio', 'Számológép', 'fekete', 'Asztali számológép', '417 funkció, 10 (+2) számjegy, S-VPAM, kétsoros kijelző, természetes algebrai bevitelt biztosító kijelző, 9 memória, törtszámítás, koordináta transzformáció, statisztika, komplex számok, mátrixok, vektorok, logikai műveletek, mérnöki szimbólumok .', 105, 'mm', 180, 'mm', 10, 'mm', 'd1267f220220423153100.png', 10870, 'huf', '2022-04-23 11:31:00'),
(59, 'CAS163FEK', 30, 'db', 'Casio', 'Számológép', 'fekete', 'Asztali számológép', '417 funkció, 10 (+2) számjegy, S-VPAM, kétsoros kijelző, természetes algebrai bevitelt biztosító kijelző, 9 memória, törtszámítás, koordináta transzformáció, statisztika, komplex számok, mátrixok, vektorok, logikai műveletek, mérnöki szimbólumok .', 115, 'mm', 65, 'mm', 17, 'mm', 'd1267f220220423153500.png', 1725, 'huf', '2022-04-23 11:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_discount`
--

CREATE TABLE `product_discount` (
  `id` int NOT NULL,
  `code` varchar(32) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_id` int NOT NULL,
  `discount` int NOT NULL,
  `new_price` int NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `product_discount`
--

INSERT INTO `product_discount` (`id`, `code`, `product_id`, `discount`, `new_price`, `start`, `end`) VALUES
(1, 'CAS112NAR', 54, 30, 3780, '2022-04-24 12:20:00', '2023-04-30 12:20:00'),
(2, 'SET464ZOL', 36, 50, 2360, '2022-04-24 13:00:00', '2023-04-01 13:00:00'),
(3, 'DII341SZI', 9, 20, 715, '2022-04-25 19:47:00', '2023-04-30 19:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `pid` int NOT NULL,
  `description` varchar(2048) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `stars` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `uid`, `pid`, `description`, `stars`, `date`) VALUES
(1, 1, 13, 'A vélemény elküldésével hozzájárul ahhoz, hogy megadott e-mail címét a Mappa Papír Kft. (6400 Kiskunhalas, Kossuth utca 13-15; mappapapir.hu) adatkezelőként kezelje. Az adatkezelésről további tájékoztatások itt érhetőek el.A vélemény elküldésével hozzájárul ahhoz, hogy megadott e-mail címét a Mappa Papír Kft. (6400 Kiskunhalas, Kossuth utca 13-15; mappapapir.hu) adatkezelőként kezelje. Az adatkezelésről további tájékoztatások itt érhetőek el.', 4, '2022-06-20 15:19:31'),
(2, 8, 29, 'A vélemény elküldésével hozzájárul ahhoz, hogy megadott e-mail címét a Mappa Papír Kft. (6400 Kiskunhalas, Kossuth utca 13-15; mappapapir.hu) adatkezelőként kezelje. Az adatkezelésről további tájékoztatások itt érhetőek el.A vélemény elküldésével hozzájárul ahhoz, hogy megadott e-mail címét a Mappa Papír Kft. (6400 Kiskunhalas, Kossuth utca 13-15; mappapapir.hu) adatkezelőként kezelje. Az adatkezelésről további tájékoztatások itt érhetőek el.', 5, '2022-06-21 10:03:50');

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

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `token` varchar(1024) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `agent` varchar(512) COLLATE utf8mb4_hungarian_ci NOT NULL,
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
  `email` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `valid` tinyint(1) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `u__email`
--

INSERT INTO `u__email` (`id`, `uid`, `email`, `valid`, `date`) VALUES
(1, 1, 'martinaszity@icloud.com', 0, '2022-06-12 16:29:32'),
(3, 8, 'mintamisi@email.com', 0, '2022-06-20 18:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `u__password`
--

CREATE TABLE `u__password` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `factor` tinyint(1) NOT NULL DEFAULT '0',
  `factor__type` varchar(32) COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `u__password`
--

INSERT INTO `u__password` (`id`, `uid`, `password`, `factor`, `factor__type`, `date`) VALUES
(1, 1, '$2y$10$gJFV872qGobbfmJOusgIee.8PXlX0WLYDWsTELKOV1Q8gL6A54MLC', 0, NULL, '2022-06-19 16:24:41'),
(3, 8, '$2y$10$U/gV9fAbjayNnzNKt7WVruVCFynwv4S7bhiF.BFHJTzVZDkMduWPi', 0, NULL, '2022-06-20 18:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `u__pass__history`
--

CREATE TABLE `u__pass__history` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `status` int NOT NULL,
  `browser` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `device` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `sys` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
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
(7, 8, 'Budapest', 'Hungary', 0, 'Chrome', 'desktop', 'Linux', '37.76.1.192', '2022-06-24 13:21:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `product_id` (`product_id`);

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
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `orders__sh`
--
ALTER TABLE `orders__sh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oid` (`oid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- Indexes for table `product_discount`
--
ALTER TABLE `product_discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers__card`
--
ALTER TABLE `customers__card`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `customers__card__deleted`
--
ALTER TABLE `customers__card__deleted`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers__card__info`
--
ALTER TABLE `customers__card__info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `customers__card__primary`
--
ALTER TABLE `customers__card__primary`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `customers__card__subscription`
--
ALTER TABLE `customers__card__subscription`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `customers__inv`
--
ALTER TABLE `customers__inv`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers__lang`
--
ALTER TABLE `customers__lang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers__money`
--
ALTER TABLE `customers__money`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers__priv`
--
ALTER TABLE `customers__priv`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers__ship`
--
ALTER TABLE `customers__ship`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers__subpay__pool`
--
ALTER TABLE `customers__subpay__pool`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers__subscription__data`
--
ALTER TABLE `customers__subscription__data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers__subscription__payment`
--
ALTER TABLE `customers__subscription__payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers__token`
--
ALTER TABLE `customers__token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customers__transactions`
--
ALTER TABLE `customers__transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `e__banned`
--
ALTER TABLE `e__banned`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `e__subs`
--
ALTER TABLE `e__subs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login__attempts`
--
ALTER TABLE `login__attempts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders__sh`
--
ALTER TABLE `orders__sh`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `product_discount`
--
ALTER TABLE `product_discount`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rv__u`
--
ALTER TABLE `rv__u`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `u__email`
--
ALTER TABLE `u__email`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `u__password`
--
ALTER TABLE `u__password`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `u__pass__history`
--
ALTER TABLE `u__pass__history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

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
-- Constraints for table `login__attempts`
--
ALTER TABLE `login__attempts`
  ADD CONSTRAINT `login__attempts_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notify`
--
ALTER TABLE `notify`
  ADD CONSTRAINT `notify_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notify_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders__sh`
--
ALTER TABLE `orders__sh`
  ADD CONSTRAINT `orders__sh_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders__sh_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_discount`
--
ALTER TABLE `product_discount`
  ADD CONSTRAINT `product_discount_ibfk_1` FOREIGN KEY (`code`) REFERENCES `products` (`product_code`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_discount_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `rvr__w`
--
ALTER TABLE `rvr__w`
  ADD CONSTRAINT `rvr__w_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rv__d`
--
ALTER TABLE `rv__d`
  ADD CONSTRAINT `rv__d_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `reviews` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rv__d_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rv__r`
--
ALTER TABLE `rv__r`
  ADD CONSTRAINT `rv__r_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `reviews` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rv__r_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rv__u`
--
ALTER TABLE `rv__u`
  ADD CONSTRAINT `rv__u_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `reviews` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rv__u_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `token_ibfk_1` FOREIGN KEY (`id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `u__email`
--
ALTER TABLE `u__email`
  ADD CONSTRAINT `u__email_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `u__password`
--
ALTER TABLE `u__password`
  ADD CONSTRAINT `u__password_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `u__pass__history`
--
ALTER TABLE `u__pass__history`
  ADD CONSTRAINT `u__pass__history_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `remove__deleted__profiles` ON SCHEDULE EVERY 1 DAY STARTS '2022-06-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM customers WHERE id = (SELECT uid FROM customers__deleted WHERE DATEDIFF( NOW( ) ,  date ) >=30)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
