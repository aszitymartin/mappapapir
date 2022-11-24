-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2022 at 04:48 PM
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
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_code` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `user_id`, `product_id`, `product_code`, `added`) VALUES
(39, 2, 42, 'EDA221LIL', '2022-05-27 10:33:44'),
(40, 2, 41, 'EDA221ROZ', '2022-05-27 10:33:45');

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
(47, 2, 50, 1, '2022-05-27 10:33:49'),
(48, 2, 47, 1, '2022-05-27 10:33:53'),
(49, 2, 53, 1, '2022-05-27 10:33:58'),
(94, 1, 55, 1, '2022-06-07 07:48:13'),
(97, 1, 54, 1, '2022-06-07 08:11:38'),
(103, 1, 53, 1, '2022-06-09 21:06:49');

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
(1, 'Ászity Martin', 'martinaszity@icloud.com', '$2y$10$YvSRtXIt61JuRuibDrzfGuG/nBRgQ7cn2wxMnZAZqLG2hlVSspx4G', 307106140, 123456789, 'light', '2022-02-15 14:39:49'),
(4, 'Molra Mokus', 'molnarmokus@email.com', '$2y$10$TeGZidBBB4zkPjHaEio7XOqp3gAJqWFV8cFJsImRhXT5h1aE5G1LW', 301234567, 123456789, 'auto', '2022-06-09 19:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `customerss`
--

CREATE TABLE `customerss` (
  `customer_id` int NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `login_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `inv_company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `inv_settlement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `inv_address_line` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `inv_postal_code` int NOT NULL,
  `inv_tax_id` int NOT NULL,
  `ship_settlement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `ship_address_line` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `ship_postal_code` int NOT NULL,
  `phone_number` int NOT NULL,
  `fax_number` int NOT NULL,
  `theme` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL DEFAULT 'auto',
  `money` int NOT NULL DEFAULT '100000',
  `currency` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL DEFAULT 'HUF',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customerss`
--

INSERT INTO `customerss` (`customer_id`, `full_name`, `email_address`, `login_password`, `inv_company_name`, `inv_settlement`, `inv_address_line`, `inv_postal_code`, `inv_tax_id`, `ship_settlement`, `ship_address_line`, `ship_postal_code`, `phone_number`, `fax_number`, `theme`, `money`, `currency`, `created`) VALUES
(1, 'Mappa Papír', 'staff@mappapapir.hu', '$2y$10$YvSRtXIt61JuRuibDrzfGuG/nBRgQ7cn2wxMnZAZqLG2hlVSspx4G', 'Mappa Papír Kft.', 'Kiskunhalas', 'Kossuth utca 13-15', 6400, 123456789, 'Kiskunhalas', 'Kossuth utca 13-15', 6400, 305157175, 123456789, 'light', 54500000, 'HUF', '2022-02-15 14:39:49'),
(2, 'Aszity Martin', 'mintamisi@email.com', '$2y$10$YvSRtXIt61JuRuibDrzfGuG/nBRgQ7cn2wxMnZAZqLG2hlVSspx4G', 'Minta Kft', 'Kecskemet', 'Minta utca 3', 6000, 123456789, 'Kecskemet', 'Minta utca 3', 6000, 301234567, 123456789, 'light', 100000, 'HUF', '2022-04-03 06:39:49'),
(12, 'Minta Mihaly', 'mintamihaly@email.com', '$2y$10$EYUd1QjgPptX/4xOwvkVv..4P8qwTSXh2lmez8YASiyqlFBXAedVS', 'Minta Kft', 'Kecskemet', 'Minta utca 3', 6000, 123456789, 'Kiskunhalas', 'Minta utca 5', 6400, 301234567, 123456789, 'auto', 10000, 'HUF', '2022-06-07 16:43:25');

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
(3, 4, 'Minta Kft', 'Kecskemet', 'Minta utca 3', 6000, 123456789, '2022-06-09 19:45:55');

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
(2, 4, 100000, 'HUF', '2022-06-09 19:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `customers__priv`
--

CREATE TABLE `customers__priv` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `privilege` int DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers__priv`
--

INSERT INTO `customers__priv` (`id`, `uid`, `privilege`, `date`) VALUES
(1, 1, 2, '2022-02-15 14:39:49'),
(2, 4, 0, '2022-06-09 19:45:55');

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
(2, 4, 'Kiskunhalas', 'Minta utca 4', 6400, '2022-06-09 19:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `e__banned`
--

CREATE TABLE `e__banned` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `email` varchar(256) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e__subs`
--

CREATE TABLE `e__subs` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `email` varchar(256) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `disc` int NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int NOT NULL,
  `sender_id` int NOT NULL,
  `target_id` int NOT NULL,
  `title` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `description` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `image` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `type` int NOT NULL,
  `status` int NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `sender_id`, `target_id`, `title`, `description`, `image`, `type`, `status`, `created`) VALUES
(6, 1, 1, 'A \"Hozzáadás a kedvencekhez\" funkció nem működik a websop-ban', 'Küldjön visszajelzést fejlesztőinknek, hogy kijavíthassák az Ön által talált hibákat.', 'abd14df20220417140157.png', 0, 0, '2022-04-16 16:44:29');

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
(13, 10, 1, 'martinaszity@icloud.com', '2022-06-09 20:35:16');

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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `pid`, `quantity`, `subtotal`, `date`) VALUES
(21, 1, 10, 1, 1530, '2022-05-30 19:14:02'),
(23, 1, 58, 1, 55, '2022-05-30 19:16:11'),
(24, 1, 58, 1, 10870, '2022-05-30 19:31:29'),
(25, 1, 57, 1, 1945, '2022-05-31 15:24:58'),
(26, 1, 56, 5, 21625, '2022-05-31 15:25:23'),
(27, 1, 47, 1, 135, '2022-05-31 15:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `orders__sh`
--

CREATE TABLE `orders__sh` (
  `id` int NOT NULL,
  `oid` int NOT NULL,
  `uid` int NOT NULL,
  `fullname` varchar(256) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(256) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `settlement` varchar(256) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `address` varchar(256) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `postal` int NOT NULL,
  `phone` int NOT NULL,
  `note` varchar(1024) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `orders__sh`
--

INSERT INTO `orders__sh` (`id`, `oid`, `uid`, `fullname`, `email`, `settlement`, `address`, `postal`, `phone`, `note`, `date`) VALUES
(19, 21, 1, 'Ásztiy Martin', 'martinaszity@icloud.com', 'Kunfehértó', 'Kossuth utca 24', 6413, 307106140, '', '2022-05-30 21:14:02'),
(21, 23, 1, 'Ásztiy Martin', 'martinaszity@icloud.com', 'Kunfehértó', 'Kossuth utca 24', 6413, 307106140, '', '2022-05-30 21:16:11'),
(22, 21, 1, 'Ásztiy Martin', 'martinaszity@icloud.com', 'Kunfehértó', 'Kossuth utca 24', 6413, 307106140, '', '2022-05-30 21:31:29'),
(23, 25, 1, 'Ásztiy Martin', 'martinaszity@icloud.com', 'Kunfehértó', 'Kossuth utca 24', 6413, 307106140, '', '2022-05-31 17:24:58'),
(24, 26, 1, 'Ásztiy Martin', 'martinaszity@icloud.com', 'Kunfehértó', 'Kossuth utca 24', 6413, 307106140, '', '2022-05-31 17:25:24'),
(25, 27, 1, 'Ásztiy Martin', 'martinaszity@icloud.com', 'Kunfehértó', 'Kossuth utca 24', 6413, 307106140, '', '2022-05-31 17:52:46'),
(26, 28, 1, 'Ásztiy Martin', 'martinaszity@icloud.com', 'Kunfehértó', 'Kossuth utca 24', 6413, 307106140, '', '2022-06-02 16:01:58'),
(27, 28, 1, 'Ásztiy Martin', 'martinaszity@icloud.com', 'Kunfehértó', 'Kossuth utca 24', 6413, 307106140, '', '2022-06-02 16:02:25');

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
(37, 'EAP182KEK', 30, 'db', 'Eagle', 'Pénzkazetta', 'fekete', 'Pénzkazetta', 'Egyszínű, fém, kulccsal zárható pénzkazetta, műanyag, kiemelhető érmetartóval.', 192, 'mm', 82, 'mm', 262, 'mm', '0721c7720220417220528.png', 3920, 'huf', '2022-04-17 16:05:28'),
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
(55, 'CAS112ZOL', 30, 'db', 'Casio', 'Számológép', 'zöld', 'Asztali számológép', '12 számjegyű, NAGY DÖNTÖTT KIJELZŐ, ÁFA számítás, valutaváltás, elem (1xLR44)+napelem, utolsó szám javítása, gyökvonás, %, 00, +/-, narancs szín.\r\nMéret: 149,5 x 104,5 x 22,1 mm', 145, 'mm', 105, 'mm', 22, 'mm', 'd1267f220220423152300.png', 4325, 'huf', '2022-04-23 11:23:00'),
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
  `code` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
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
(12, 'CAS112NAR', 54, 30, 3780, '2022-04-24 12:20:00', '2023-04-30 12:20:00'),
(13, 'SET464ZOL', 36, 50, 2360, '2022-04-24 13:00:00', '2023-04-01 13:00:00'),
(14, 'DII341SZI', 9, 20, 715, '2022-04-25 19:47:00', '2023-04-30 19:47:00');

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
(10, 1, 10, 'A monitortalp túldizájnolt, nem praktikus. A tartórész túlzottan hátranyúlik, emiatt, ha fal elé tesszük, sok hely vész el feleslegesen. Gondolom, távolságtartási célja is lehet ennek, de az így kialakuló kb. 13 cm, ami a monitor-lap leghátsó pontja és a fal között kialakul, túlzásnak tűnik, és ilyenkor bosszantóan sok hely vész el, illetve az asztal mérete miatt túl közel kerül a használóhoz.', 5, '2022-06-10 08:47:26');

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
  `token` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `agent` varchar(512) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `expiry` int DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `uid`, `token`, `agent`, `expiry`, `date`) VALUES
(5, 1, 'a25ae2269559ac4deea41f6cd486ba0df4badae2df0eab67f8a1ce7349d6d1838d346d4789b3e882cc698c3622d15abac8311acf51b56732df42a8acf96b12e95b83aab9f3ee76d6da59b7caf77f38b39552273497e40e1d52d53491160fb8e98211be3d93573a68b6838e61069b5142bd973e038e5cd8a88806c3ed92642001bfd489281dfebc326bf0fe61ea493127aaeacb97bbac95aa457bd581ff6f29731e725f61c9ccc8571da69c3c0e80eebb8b9a7b7acf2c66c11a0f49e10dd4d1e9b8e56d085de729ec49009daf77b0fd737a443fd8039634cd1e00f8599be2512af35bfaf4d71dcf0a69b78229c91367cd28c4ab00c0e45e0cfd63a271745f281b', 'Chrome:101.0.4951.54:linux', 1683981334, '2022-05-13 12:35:34'),
(6, 1, '01886f03d2c54337b5f653cc2ea17c14b80533b0ba26f863952da74e284d13c252224b1d0d798971a861a75ca34f7ca37ca15b1e22cfece4454b4f120b707b732ec1d3df3059f37b393e0fb015d0416ec4fb1e37b21f876509662cd5987188d67a4824a4493e6dd61ad2415fd4a8f6dca61a11d4a244c786e17a88763658041190fde09e6ee0d783608cb1fafab2b380241d6f06d7eaf3783cabda644952f3f87fc6a29944b832ea7a87b9a9f56905c547d406c87feff3c904eeffd71e21f506d189fa30390adc4095cea4917b09a8fc5c355366e4e68b6da8def5604c39640b9e7bbc506a9477a1cf69d34292bfb672acfaa07af3c4ec124c06405b903aae1c', 'Safari:15.4:mac', 1684778191, '2022-05-22 17:56:31'),
(7, 2, '0b8f688889174690fcf804ecd02d6c790babbbaf2d20364284d0e421afd5012f4152564f79bdc3d86ce8622216f5fc77978553773004613510f1db57a40963ea82519ca6456a4c224237350da14c9226037ac25a77c65ed57f1acf3ebd9abc9a9b3886c740893cf3ef823512d1d210828c16dedad78f37e3ed3ac16c81258b8f056d0b7e24b32e6820da161c22b43e87968dfac684297061625dbd3fda3ca25200f41ade8df9084b77dfa54356771f1255077c76ff4838a1ad5e70c497c734d14e0709538c59e0fa0e6355d31eca0393b71259e13e588f67d450c1ce0c21ab86a5307b8751660d48600d62c6640ceb215c073aae64fc8ca711549a6d9b3fdbf1', 'Chrome:102.0.5005.61:linux', 1685183597, '2022-05-27 10:33:17'),
(8, 1, '8d1e68f416e2b140148b90860cb524af80bd584908882a88fdc4ea8e70ed1588c733c10c4f4d9d1dc8ca35af415828ea72a2412a37cdd2dda5e3d581fc8026729fce5c4a3baf34d6c180c7ed83a0b42b5a98f740f135c1f3cc83fb018a377ff4833431eddc433b6a4ff401d0f5a29392829f132a391a779856b60ebf37e4a6a2aaaf3141b5f410df694d5fb3a00a3ed9c91d948e2f8425ab6ce48c00cf6d1e25d1b663de1c59640a7c94e578efbaea15f9e277419021f5ec57b121c4ed46b5811080a5daacc82165cc8081e6ebe2642a8ea0362ab9a55223e7ad8dfd8fc5d5e0ebfd9d02efa0f80084e41262495a4f840d12b7fc9cc946e65630666ae73d368c', 'Chrome:100.0.4896.88:linux', 1685379289, '2022-05-29 16:54:49'),
(9, 1, '890e1de5329b1c30101650c1e4a524178583403c9ef9656f5e068eba59987c7a40f609d3d2603c5564f00051ab4bd615f33f7cc7f9ac109c04bbe8b1e63f493396d6e22dc56ec4bf49186d482ff79f8f40eb6a66a7843523f33ca921b83f724d87996b71d6d86aedd77c046f715ee5b15da49092ec15e9d3df7f946447b10f512503c20c1b504a4cf5f7b2d299b1d51828e330c62e706477883ea2c66f2ef3cd8f150e2d9afcdeea9f73935267eaf19a328d08ef773b68aebf755388a61920741928d2a941529088015d302ef45d8853cfbceda874505cd971e2b0f1bbfd05194dd9dbeabda1ec9576c63afbdc07239402729aac73b57e8fc7f492b23447d809', 'Chrome:102.0.5005.61:linux', 1685458822, '2022-05-30 15:00:22'),
(10, 2, 'd367efc3477fa6e48b668e8696ee4c1e25cf4b0629b06a718f01c1d0c8b916423188083d48477b5c3027f59ca8df5aab7bb6e789d16a4bc9721937be0d047f19f4d3ab065fe1fc6a63a14428030e5ef68c5f498df971d2cc70a7ec65befc890cce506b6da8c8b74e22e20727a75027ea3c0dc3719045bf5426f12caaf67b4dd8b2b26239f3b2582c04d749ea5580914379e7cf00135c8b270a051cad624268ad85ad609451d76dfe81128e35e7a0cc7d7f02a2cada718dfda5f43963cc9b77dfdc0b06bb633ceb4af9462a436b3e99f7a465b8d62ed3bd38eb258cd4d5445d709bd242dd9e0e2f48f371186e2c600934e9c897ea5c0ba0634993a16b474222af', 'Chrome:102.0.5005.61:linux', 1685714756, '2022-06-02 14:05:56'),
(11, 12, 'fea6eb99ac5fa076bdc4c0f6066684bfd7b3e53021e6566d521d30a29d374cec87969b1b9c216e1be130dbf17bd45eff4d29c4a8d8cf11de31b51aade97e186a13628bb6e0dd8863038cf9f15be6ad667ab24e7937ac572c88808804550994207f777dbadd3aefaccd95d49c0329feb9f6743da51d07940dd9f36f2b036711f78a6914d6b88e89f8d98f06552e2741b370b257bdec66addddb58f7f6a2c392cd151e1a862ca7e02071ca0b9c90b6ada80f83542cff1aae1be6a34e63cef08fc997cb3ee72f886da4883abf969536d0ad1475f74695e86fd4aaf23d1d9ce0b6a5256b44d6457bcc8a97109f611594849b60c572843d68d21d41e70645625dc445', 'Chrome:102.0.5005.61:linux', 1686156396, '2022-06-07 16:46:36'),
(12, 12, '9511beb5a5878e8d4947f5b87d76f513e5ab79c6bdda04c2f35b183e0882aa959d0602b604d859e924fd1667702fc8d0b89cbf3dc29bc70473e73404a079f3eb04bedd0e5922343b1ec0658d8c32a579b4d83d45653941d664c7cb42389919a9a61a509a5e6ee352ae935d1bdb67015256a28103623fbf4d9ff94905d89040e1337454ce7c6886577923adbeb3c62b6bde4804d6032785a750b0076b64d324db55912952ecb8bb33fbdc40ff53cd210e6ed3bda4430a733659275be4c922743b213e81525127d434715bcb9d9db6895dea81f76d1d716899eba4bf006adf0d11439ef61928deaca11091dcef5c640ceb42880b1a427ca251cceada8302c0b1fe', 'Chrome:102.0.5005.61:linux', 1686160044, '2022-06-07 17:47:24'),
(13, 1, 'af6e834eac9b6f60c2e7f8e45b47a764f1bfa9123d7a90578f2a02374a4c00bb098d901013b3b6350c413545510910b7f3007007d850dca9bd2eefdfcc828933c42c40015324289b947a11d27f9006be595b16b4d68e6d7ce7d51df4aba865ba070b51c39ab1da1b971359780a9b2b47430260b3fb1be9f999059a9f1a0674edef03a13d3cb9cbe9e1c9e6969e4330f9ae279c449d9cf1895e05b5d94e614cceebcbd233ce4b424525a2139f5aa3a2c674ee6d68d4053bf7a4d82ce9ad19a78abbe762a55815bf0f574788a2d8aa76c437afb952258956872a89666005a68edb380a729fcda8627b779d2b89208ae13a5e20c1ae074b16530d1093eb97454aea', 'Chrome:102.0.5005.61:linux', 1686333119, '2022-06-09 17:51:59'),
(14, 1, '4e04703f9ec45625a90cf4117f6dfa7cfc08c5067b4c23ce6d35a9a98ba86296306c795b799308e51b7a85e2f73ba75042c6623854edea77610cf40de2cae3ce6412f83d2728643bf030b7772964aca11142bfb9ddee6adaa8914ce422bc4eb829dfed38e62ec2a6f17c4fef9255ef02f660f221ee07a8ac85fd0b30ab4265d69d41b08916253aeb2de2d04b3b5c95b4481d7ad2c625c7a641188c8ec69a914608ef0c8db3faa65950b92061916f960bb07e6f4423c39c250c1b570186c8ba7fa1e858e3bd330ef317291ccc96af7eb2b699b479f29d4a9f474a0d5d4f857c3b1cb2e6b169c3d19aa8b53fc2c1b89def07d85f07eaf89b90c7c06162a94022f7', 'Chrome:102.0.5005.61:linux', 1686342795, '2022-06-09 20:33:15'),
(15, 4, '677d69c98490fd3da609a7ee922b516c2a4db8c403f0dde3a32c3139aca953251c151d338fa21aba532a03ac4b85818a629d4bd9062693619f2da2c892bf7adfa2a931257241260488f0cdd9d1e29c2443cdea46029eee3367a5aedea32d485ce1153e8f9d982419408bb98e790c762e88d27ef96f27a627a0ccbe570f96562285ac197cf3595914356005e8b92bb3fc28c079bac08a0108001d65315ccc1766eb1a69080d3eadaa906480245e0d5a88ee0af768468441fd441f249ab85a4b13a3a9197b11e722ce0e8a0ba966053e3091d786922cf9bfe073d1f3f8208e72f5f46de1a8d171480a07c5621e1cd30313dfdfcb1431291fa1702f3a530be307a1', 'Chrome:102.0.5005.61:linux', 1686391687, '2022-06-10 10:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `u__email`
--

CREATE TABLE `u__email` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `u__email`
--

INSERT INTO `u__email` (`id`, `uid`, `email`, `valid`, `date`) VALUES
(1, 1, 'martinaszity@icloud.com', 0, '2022-06-10 10:41:54'),
(2, 12, 'mintamihaly@email.com', 0, '2022-06-07 16:43:25'),
(3, 4, 'molnarmokus@email.com', 0, '2022-06-09 19:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `u__password`
--

CREATE TABLE `u__password` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `u__password`
--

INSERT INTO `u__password` (`id`, `uid`, `password`, `date`) VALUES
(1, 1, '$2y$10$YvSRtXIt61JuRuibDrzfGuG/nBRgQ7cn2wxMnZAZqLG2hlVSspx4G', '2022-02-15 14:39:49'),
(2, 12, '$2y$10$EYUd1QjgPptX/4xOwvkVv..4P8qwTSXh2lmez8YASiyqlFBXAedVS', '2022-06-07 16:43:25'),
(3, 4, '$2y$10$TeGZidBBB4zkPjHaEio7XOqp3gAJqWFV8cFJsImRhXT5h1aE5G1LW', '2022-06-09 19:45:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerss`
--
ALTER TABLE `customerss`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customers__inv`
--
ALTER TABLE `customers__inv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers__money`
--
ALTER TABLE `customers__money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers__priv`
--
ALTER TABLE `customers__priv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers__ship`
--
ALTER TABLE `customers__ship`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `e__banned`
--
ALTER TABLE `e__banned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `e__subs`
--
ALTER TABLE `e__subs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders__sh`
--
ALTER TABLE `orders__sh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_discount`
--
ALTER TABLE `product_discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rvr__w`
--
ALTER TABLE `rvr__w`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rv__d`
--
ALTER TABLE `rv__d`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rv__r`
--
ALTER TABLE `rv__r`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rv__u`
--
ALTER TABLE `rv__u`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `u__email`
--
ALTER TABLE `u__email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `u__password`
--
ALTER TABLE `u__password`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customerss`
--
ALTER TABLE `customerss`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers__inv`
--
ALTER TABLE `customers__inv`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers__money`
--
ALTER TABLE `customers__money`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers__priv`
--
ALTER TABLE `customers__priv`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers__ship`
--
ALTER TABLE `customers__ship`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `e__banned`
--
ALTER TABLE `e__banned`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `e__subs`
--
ALTER TABLE `e__subs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders__sh`
--
ALTER TABLE `orders__sh`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `product_discount`
--
ALTER TABLE `product_discount`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rvr__w`
--
ALTER TABLE `rvr__w`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rv__d`
--
ALTER TABLE `rv__d`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `rv__r`
--
ALTER TABLE `rv__r`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rv__u`
--
ALTER TABLE `rv__u`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
