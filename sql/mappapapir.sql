-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2022 at 09:33 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

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
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(32) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `user_id`, `product_id`, `product_code`, `added`) VALUES
(13, 1, 58, 'CAS162FEK', '2022-04-25 17:48:01');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `pcode` varchar(32) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `uid`, `pid`, `pcode`, `added`) VALUES
(0, 1, 9, 'DII341SZI', '2022-04-25 17:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(6) NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `login_password` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `inv_company_name` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `inv_settlement` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `inv_address_line` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `inv_postal_code` int(6) NOT NULL,
  `inv_tax_id` int(12) NOT NULL,
  `ship_settlement` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `ship_address_line` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `ship_postal_code` int(6) NOT NULL,
  `phone_number` int(12) NOT NULL,
  `fax_number` int(12) NOT NULL,
  `theme` varchar(32) COLLATE utf8mb4_hungarian_ci NOT NULL DEFAULT 'auto',
  `money` int(6) NOT NULL DEFAULT 10000,
  `currency` varchar(3) COLLATE utf8mb4_hungarian_ci NOT NULL DEFAULT 'HUF',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `full_name`, `email_address`, `login_password`, `inv_company_name`, `inv_settlement`, `inv_address_line`, `inv_postal_code`, `inv_tax_id`, `ship_settlement`, `ship_address_line`, `ship_postal_code`, `phone_number`, `fax_number`, `theme`, `money`, `currency`, `created`) VALUES
(1, 'Személyzet', 'staff@mappapapir.hu', '$2y$10$YvSRtXIt61JuRuibDrzfGuG/nBRgQ7cn2wxMnZAZqLG2hlVSspx4G', 'Minta Kft', 'Kecskemet', 'Minta utca 3', 6000, 123456789, 'Kecskemet', 'Minta utca 3', 6000, 301234567, 123456789, 'light', 10000, 'HUF', '2022-02-15 14:39:49'),
(2, 'Aszity Martin', 'mintamisi@email.com', '$2y$10$YvSRtXIt61JuRuibDrzfGuG/nBRgQ7cn2wxMnZAZqLG2hlVSspx4G', 'Minta Kft', 'Kecskemet', 'Minta utca 3', 6000, 123456789, 'Kecskemet', 'Minta utca 3', 6000, 301234567, 123456789, 'light', 10000, 'HUF', '2022-04-03 06:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `description` varchar(2048) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `image` varchar(256) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `type` int(3) NOT NULL,
  `status` int(3) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `sender_id`, `target_id`, `title`, `description`, `image`, `type`, `status`, `created`) VALUES
(1, 1, 1, 'Webshop title', 'This is an even longer webshop feedback message than the previous ones.', '', 0, 0, '2022-04-01 12:39:49'),
(2, 2, 1, 'Product title', 'This is an even longer webshop feedback message than the previous ones. This is an even longer webshop feedback message than the previous ones. This is an even longer webshop feedback message than the previous ones. This is an even longer webshop feedback message than the previous ones.', '', 1, 0, '2022-04-01 13:39:49'),
(3, 1, 1, 'Order title', 'This is a longer order feedback message', '', 2, 1, '2022-04-01 13:39:49'),
(4, 1, 1, 'Product title', 'This is a longer product feedback message', '', 1, 0, '2022-04-01 13:29:49'),
(5, 2, 1, 'Product title', 'This is a longer product feedback message', '', 0, 2, '2022-04-01 15:29:49'),
(6, 1, 1, 'A \"Hozzáadás a kedvencekhez\" funkció nem működik a websop-ban', 'Küldjön visszajelzést fejlesztőinknek, hogy kijavíthassák az Ön által talált hibákat.', '', 0, 0, '2022-04-16 16:44:29'),
(7, 1, 1, 'title', 'description', 'abd14df20220417140157.png', 0, 0, '2022-04-17 10:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(32) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_quantity_unit` varchar(11) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_brand` varchar(128) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_type` varchar(64) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_color` varchar(12) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_name` varchar(32) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_info` varchar(1024) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_width` int(11) NOT NULL,
  `product_width_unit` varchar(11) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_height` int(11) NOT NULL,
  `product_height_unit` varchar(11) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_length` int(11) NOT NULL,
  `product_length_unit` varchar(11) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_image` varchar(256) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_price_unit` varchar(11) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_code`, `product_quantity`, `product_quantity_unit`, `product_brand`, `product_type`, `product_color`, `product_name`, `product_info`, `product_width`, `product_width_unit`, `product_height`, `product_height_unit`, `product_length`, `product_length_unit`, `product_image`, `product_price`, `product_price_unit`, `added`) VALUES
(9, 'DII341SZI', 30, 'db', 'Diplomat', 'Iratrendező', 'színes', 'Iratrendező', 'Papírral bevont kartonból készült, masszív tokos iratrendező, 35 mm-es\r\ngerincvastagsággal. Ragasztott gerinccímke, kihúzólyuk, kétgyűrűs\r\nszerkezet segíti a használatát. Irodai és otthoni használatra egyaránt.', 35, 'mm', 40, 'cm', 15, 'cm', '095470420220417213817.png', 890, 'huf', '2022-04-17 17:38:17'),
(10, 'EOF233FEH', 30, 'csom', 'Euro Office', 'Fénymásolópapír', 'fehér', 'Fénymásolópapír', 'Irodai papír általános felhasználásra -alkalmas fénymásolókba, faxokba,\r\nlézer és tintasugaras nyomtatókba - magas fehérség - gyors\r\nfutásteljesítmény - kiemelkedő teljesítmény a kategóriáján belül -', 210, 'cm', 35, 'cm', 300, 'mm', '583ce0020220417214135.png', 1530, 'huf', '2022-04-17 17:41:35'),
(11, 'GRG223FEH', 30, 'db', 'Gréta', 'Gyorsfűző', 'fehér', 'Gyorsfűző', 'Belül natúr, kívül fehér színű, 230 gr-os kartonból készült gyorsfűző\r\nmappa, elején feliratozásra alkalmas 3 vonalas nyomattal. A mappában\r\nelhelyezett lapok lyukasztás után a fémlefűző szerkezettel rögzíthetők.', 210, 'mm', 2, 'cm', 300, 'mm', '9319f4c20220417214349.png', 25, 'huf', '2022-04-17 17:43:49'),
(12, 'GRI223FEH', 30, 'db', 'Gréta', 'Iratgyűjtő', 'fehér', 'Iratgyűjtő', 'Belül natúr, kívül fehér színű, 230 gr-os kartonból készült három pólyás\r\niratgyűjtő mappa, elején feliratozásra alkalmas 3 vonalas nyomattal. A\r\nmappában elhelyezett lapok a behajtott pólyák segítségével akadályozzák', 210, 'mm', 2, 'cm', 300, 'mm', '320cef720220417214619.png', 30, 'huf', '2022-04-17 17:46:19'),
(13, 'KOH221FEH', 30, 'db', 'Kores', 'Hibajavító', 'fehér', 'Hibajavító', '0,9 mm-es golyóval a pontos javításért, egyenletes folyadékadagolás, gyorsan szárad, tökéletesen fed, kompakt kivitel, oldószeres, 10 ml-es kiszerelés.', 2, 'cm', 2, 'cm', 14, 'cm', 'cf9461f20220417215208.png', 340, 'huf', '2022-04-17 17:52:08'),
(14, 'SAL681KEK', 30, 'db', 'Sax', 'Lyukasztó', 'kék', 'Lyukasztó', 'Könnyűfém testű, fémszerkezetű lyukasztógép ütköztetőléccel. Egyszerre\r\nlyukasztható lapok száma: max. 30 lap. Lyuktávolság: 80 mm. Lyukátmérő:5,5\r\nmm.', 6, 'cm', 8, 'cm', 13, 'cm', 'af4ee1020220417215356.png', 2190, 'huf', '2022-04-17 17:53:56'),
(15, 'WEO641PIR', 30, 'db', 'Wedo', ' Olló', 'piros', ' Olló', 'Ergonomikus, gumírozott fogórész a kényelmes használat\r\nérdekében.Univerzális: papír, karton, öntapadós szalag, stb. vágására\r\nalkalmas. Rozsdamentes csiszolt acél él.', 6, 'cm', 3, 'cm', 16, 'cm', 'cc7526120220417220222.png', 495, 'huf', '2022-04-17 18:02:22'),
(16, 'EAP182KEK', 30, 'db', 'Eagle', 'Pénzkazetta', 'kék', 'Pénzkazetta', 'Egyszínű, fém, kulccsal zárható pénzkazetta, műanyag, kiemelhető érmetartóval.', 192, 'mm', 82, 'mm', 262, 'mm', '0721c7720220417220428.png', 3920, 'huf', '2022-04-17 18:04:28'),
(17, 'OPB383FEK', 30, 'db', 'Opoint', 'Bélyegzőfesték', 'fekete', 'Bélyegzőfesték', 'Bélyegző párna festék műanyag tubusban, hagyományos és automata\r\nbélyegzőkhöz.\r\nŰrtartalom: 30 ml.', 3, 'cm', 8, 'cm', 3, 'cm', 'f59cf1d20220417222001.png', 140, 'huf', '2022-04-17 18:20:01'),
(18, 'HAI532NAR', 30, 'db', 'Han', 'Iratpapucs', 'narancssárga', 'Iratpapucs', 'Újrahasznosított műanyagból készült irattartó, mely tárolásra és\r\narchiválásra egyaránt használható C/4 méretig. Praktikus kihúzólyukkal, és\r\náttekinhető kivitelben.', 5, 'cm', 30, 'cm', 25, 'cm', '65f632420220417222404.png', 860, 'huf', '2022-04-17 18:24:04'),
(19, 'HAI532KEK', 30, 'db', 'Han', 'Iratpapucs', 'kék', 'Iratpapucs', 'Újrahasznosított műanyagból készült irattartó, mely tárolásra és\r\narchiválásra egyaránt használható C/4 méretig. Praktikus kihúzólyukkal, és\r\náttekinhető kivitelben.', 5, 'cm', 30, 'cm', 25, 'cm', '019bce420220417222607.png', 860, 'huf', '2022-04-17 18:26:07'),
(20, 'HAI532ZOL', 30, 'db', 'Han', 'Iratpapucs', 'zöld', 'Iratpapucs', 'Újrahasznosított műanyagból készült irattartó, mely tárolásra és\r\narchiválásra egyaránt használható C/4 méretig. Praktikus kihúzólyukkal, és\r\náttekinhető kivitelben.', 5, 'cm', 30, 'cm', 25, 'cm', 'c2a997520220417222732.png', 860, 'huf', '2022-04-17 18:27:32'),
(21, 'HAI532ROZ', 30, 'db', 'Han', 'Iratpapucs', 'rózsaszín', 'Iratpapucs', 'Újrahasznosított műanyagból készült irattartó, mely tárolásra és\r\narchiválásra egyaránt használható C/4 méretig. Praktikus kihúzólyukkal, és\r\náttekinhető kivitelben.', 5, 'cm', 30, 'cm', 25, 'cm', '544fc9a20220417222904.png', 860, 'huf', '2022-04-17 18:29:04'),
(22, 'CUP232FEK', 30, 'db', 'Curver', 'Papírkosár', 'fekete', ' Papírkosár', 'Fekete színű, 11 literes műanyag papírkosár, 30 cm magassággal.', 20, 'cm', 30, 'cm', 20, 'cm', 'a063a0320220417223051.png', 690, 'huf', '2022-04-17 18:30:51'),
(23, 'SEA131EZU', 30, 'db', 'Sencor', 'Számológép', 'ezüst', 'Asztali számológép', 'Asztali számológép, kettős áramellátás, 12 számjegyes kijelző.\r\nJellemzők:\r\n- 12 számjegyes kijelző', 12, 'cm', 3, 'cm', 14, 'cm', 'd6223c020220417223255.png', 1990, 'huf', '2022-04-17 18:32:55'),
(24, 'EAP182PIR', 30, 'db', 'Eagle', 'Pénzkazetta', 'piros', 'Pénzkazetta', 'Egyszínű, fém, kulccsal zárható pénzkazetta, műanyag, kiemelhető érmetartóval.', 192, 'mm', 82, 'mm', 262, 'mm', '234628b20220417223655.png', 3920, 'huf', '2022-04-17 18:36:55'),
(25, 'BLJ368SZI', 30, 'csom', 'Bluering', 'Jelölőcímke', 'színes', 'Jelölőcímke', 'Műanyag, öntapadós, visszaszedhető nyíl alakú neon jelölő címke könyvek,\r\ndokumentumok oldalainak megjelölésére. Színek: rózsa, zöld, sárga, kék,\r\nnarancs.', 3, 'cm', 5, 'mm', 8, 'cm', 'f6ec88e20220417223841.png', 195, 'huf', '2022-04-17 18:38:41'),
(26, 'PAI322ROZ', 30, 'db', 'Pantaplast', 'Irattasak', 'rózsaszín', 'Irattasak', 'Kiválóan alkalmas A/4 méretű dokumentumok lyukasztás nélküli tárolására. 2\r\nzsebes kivitell, rugalmas, színes, pasztell színű polipropilén alapanyag,\r\npatent segítségével könnyen záródik. Méret: 330x235 mm.', 330, 'mm', 2, 'cm', 235, 'mm', '66e44f320220417224232.png', 290, 'huf', '2022-04-17 18:42:32'),
(27, 'PAI322KEK', 30, 'db', 'Pantaplast', 'Irattasak', 'kék', 'Irattasak', 'Kiválóan alkalmas A/4 méretű dokumentumok lyukasztás nélküli tárolására. 2\r\nzsebes kivitell, rugalmas, színes, pasztell színű polipropilén alapanyag,\r\npatent segítségével könnyen záródik. Méret: 330x235 mm.', 330, 'mm', 2, 'cm', 235, 'mm', '66e44f320220417224332.png', 290, 'huf', '2022-04-17 18:43:32'),
(28, 'PAI322SAR', 30, 'db', 'Pantaplast', 'Irattasak', 'sárga', 'Irattasak', 'Kiválóan alkalmas A/4 méretű dokumentumok lyukasztás nélküli tárolására. 2\r\nzsebes kivitell, rugalmas, színes, pasztell színű polipropilén alapanyag,\r\npatent segítségével könnyen záródik. Méret: 330x235 mm.', 330, 'mm', 2, 'cm', 235, 'mm', '66e44f320220417224432.png', 290, 'huf', '2022-04-17 18:44:32'),
(29, 'SUS211KEK', 30, 'csom', 'Submed', 'Szájmaszk', 'kék', ' Szájmaszk', 'Orvosi szájmaszk, egyszerhasználatos sterilizált védőmaszk. 3 rétegű\r\nkivitel, mely használat után eldobható. Az orvosi maszk a fülön\r\ngumipánttal rögzíthető. Könnyen felhelyezhető, stabil, kényelmes viseletet', 20, 'cm', 1, 'cm', 10, 'cm', '51a6c7520220417225136.png', 55, 'huf', '2022-04-17 18:51:36'),
(30, 'SET464FEK', 30, 'db', 'Securit', 'Tábla', 'fekete', ' Tábla', '40x60 cm-es krétatábla fa kerettel és mindkét oldalon írható felülettel.\r\nA csomag ajándék fehér krétamarkert tartalmaz. A tábla krétamarkerrel\r\nírható és nedves ruhával törölhető. Reklámhordozónak, információs táblának,', 40, 'cm', 60, 'cm', 4, 'cm', '16cd18f20220417225528.png', 4720, 'huf', '2022-04-17 18:55:28'),
(31, 'LUG111FEK', 30, 'db', 'Luxor', 'Írószer', 'fekete', 'Golyóstoll', 'Nyomógombos műanyag golyóstoll modern dizájnnal, kényelmes, gumírozott\r\nmarkolattal. Tolltest színével megegyező ultra alacsony viszkózitású\r\ntinta. Betét írásvastagsága 0,7 mm, nem cserélhető.', 15, 'mm', 15, 'mm', 145, 'mm', '78948e020220417225737.png', 120, 'huf', '2022-04-17 18:57:37'),
(32, 'LUG111KEK', 30, 'db', 'Luxor', 'Írószer', 'kék', 'Golyóstoll', 'Nyomógombos műanyag golyóstoll modern dizájnnal, kényelmes, gumírozott\r\nmarkolattal. Tolltest színével megegyező ultra alacsony viszkózitású\r\ntinta. Betét írásvastagsága 0,7 mm, nem cserélhető.', 15, 'mm', 15, 'mm', 145, 'mm', '78948e020220417225837.png', 120, 'huf', '2022-04-17 18:58:37'),
(33, 'LUG111PIR', 30, 'db', 'Luxor', 'Írószer', 'piros', 'Golyóstoll', 'Nyomógombos műanyag golyóstoll modern dizájnnal, kényelmes, gumírozott\r\nmarkolattal. Tolltest színével megegyező ultra alacsony viszkózitású\r\ntinta. Betét írásvastagsága 0,7 mm, nem cserélhető.', 15, 'mm', 15, 'mm', 145, 'mm', '78948e020220417225937.png', 120, 'huf', '2022-04-17 18:59:37'),
(34, 'LUG111ZOL', 30, 'db', 'Luxor', 'Írószer', 'zöld', 'Golyóstoll', 'Nyomógombos műanyag golyóstoll modern dizájnnal, kényelmes, gumírozott\r\nmarkolattal. Tolltest színével megegyező ultra alacsony viszkózitású\r\ntinta. Betét írásvastagsága 0,7 mm, nem cserélhető.', 15, 'mm', 15, 'mm', 145, 'mm', '78948e020220417230037.png', 120, 'huf', '2022-04-17 19:00:37'),
(35, 'SET464FEH', 30, 'db', 'Securit', 'Tábla', 'fehér', ' Tábla', '40x60 cm-es krétatábla fa kerettel és mindkét oldalon írható felülettel.\r\nA csomag ajándék fehér krétamarkert tartalmaz. A tábla krétamarkerrel\r\nírható és nedves ruhával törölhető. Reklámhordozónak, információs táblának,', 40, 'cm', 60, 'cm', 4, 'cm', '16cd18f20220417230528.png', 4720, 'huf', '2022-04-17 18:55:28'),
(36, 'SET464ZOL', 30, 'db', 'Securit', 'Tábla', 'zöld', ' Tábla', '40x60 cm-es krétatábla fa kerettel és mindkét oldalon írható felülettel.\r\nA csomag ajándék fehér krétamarkert tartalmaz. A tábla krétamarkerrel\r\nírható és nedves ruhával törölhető. Reklámhordozónak, információs táblának,', 40, 'cm', 60, 'cm', 4, 'cm', '16cd18f20220417230028.png', 4720, 'huf', '2022-04-17 18:55:28'),
(37, 'EAP182KEK', 30, 'db', 'Eagle', 'Pénzkazetta', 'fekete', 'Pénzkazetta', 'Egyszínű, fém, kulccsal zárható pénzkazetta, műanyag, kiemelhető érmetartóval.', 192, 'mm', 82, 'mm', 262, 'mm', '0721c7720220417220528.png', 3920, 'huf', '2022-04-17 18:05:28'),
(38, 'EDA221SAR', 30, 'db', 'EDDING', 'Írószer', 'sárga', 'Alkoholos marker', 'Kúpos kerek hegy. Vízálló, gyorsan száradó alkoholbázisú tinta.\r\nÍráshoz, színezéshez, fém, üveg és műanyag felületre használható. A kupak színe megegyezik a tinta színével. Nem maszatol\r\nVonalvastagság: 1,5-3 mm', 20, 'mm', 20, 'mm', 145, 'mm', '2501fd420220423140452.png', 300, 'huf', '2022-04-23 12:04:52'),
(39, 'EDA221NAR', 30, 'db', 'EDDING', 'Írószer', 'narancssárga', 'Alkoholos marker', 'Kúpos kerek hegy. Vízálló, gyorsan száradó alkoholbázisú tinta.\r\nÍráshoz, színezéshez, fém, üveg és műanyag felületre használható. A kupak színe megegyezik a tinta színével. Nem maszatol\r\nVonalvastagság: 1,5-3 mm', 20, 'mm', 20, 'mm', 145, 'mm', '2501fd420220423140500.png', 300, 'huf', '2022-04-23 12:05:00'),
(40, 'EDA221BAR', 30, 'db', 'EDDING', 'Írószer', 'barna', 'Alkoholos marker', 'Kúpos kerek hegy. Vízálló, gyorsan száradó alkoholbázisú tinta.\r\nÍráshoz, színezéshez, fém, üveg és műanyag felületre használható. A kupak színe megegyezik a tinta színével. Nem maszatol\r\nVonalvastagság: 1,5-3 mm', 20, 'mm', 20, 'mm', 145, 'mm', '2501fd420220423140600.png', 300, 'huf', '2022-04-23 12:06:00'),
(41, 'EDA221ROZ', 30, 'db', 'EDDING', 'Írószer', 'rózsaszín', 'Alkoholos marker', 'Kúpos kerek hegy. Vízálló, gyorsan száradó alkoholbázisú tinta.\r\nÍráshoz, színezéshez, fém, üveg és műanyag felületre használható. A kupak színe megegyezik a tinta színével. Nem maszatol\r\nVonalvastagság: 1,5-3 mm', 20, 'mm', 20, 'mm', 145, 'mm', '2501fd420220423140700.png', 300, 'huf', '2022-04-23 12:07:00'),
(42, 'EDA221LIL', 30, 'db', 'EDDING', 'Írószer', 'lila', 'Alkoholos marker', 'Kúpos kerek hegy. Vízálló, gyorsan száradó alkoholbázisú tinta.\r\nÍráshoz, színezéshez, fém, üveg és műanyag felületre használható. A kupak színe megegyezik a tinta színével. Nem maszatol\r\nVonalvastagság: 1,5-3 mm', 20, 'mm', 20, 'mm', 145, 'mm', '2501fd420220423140800.png', 300, 'huf', '2022-04-23 12:08:00'),
(43, 'CEA221FEK', 30, 'db', 'CENTROPEN', 'Írószer', 'fekete', 'Alkoholos marker', 'Csomagolási egység: 12 db/dob\r\n\r\nAlkohol bázisú, permanent festékkel töltött filctoll kúpos heggyel. Írásvastagság: 1-3 mm. Minden felületre ír, víz és hőálló, nem fakul.', 20, 'mm', 20, 'mm', 145, 'mm', '1c5bc8020220423141804.png', 175, 'huf', '2022-04-23 12:18:04'),
(44, 'CEA221KEK', 30, 'db', 'CENTROPEN', 'Írószer', 'kék', 'Alkoholos marker', 'Csomagolási egység: 12 db/dob\r\n\r\nAlkohol bázisú, permanent festékkel töltött filctoll kúpos heggyel. Írásvastagság: 1-3 mm. Minden felületre ír, víz és hőálló, nem fakul.', 20, 'mm', 20, 'mm', 145, 'mm', '1c5bc8020220423141900.png', 175, 'huf', '2022-04-23 12:19:00'),
(45, 'CEA221PIR', 30, 'db', 'CENTROPEN', 'Írószer', 'piros', 'Alkoholos marker', 'Csomagolási egység: 12 db/dob\r\n\r\nAlkohol bázisú, permanent festékkel töltött filctoll kúpos heggyel. Írásvastagság: 1-3 mm. Minden felületre ír, víz és hőálló, nem fakul.', 20, 'mm', 20, 'mm', 145, 'mm', '1c5bc8020220423142000.png', 175, 'huf', '2022-04-23 12:20:00'),
(46, 'FOA221KEK', 30, 'db', 'Fortuna', 'Írószer', 'kék', 'Alkoholos rostiron', 'Csomagolási egység: 40 db/csom\r\nAlkoholbázisú, permanent festékkel töltött marker precíziós fémfoglalatú írócsúccsal. Írásvastagság: 0,5mm.', 20, 'mm', 20, 'mm', 145, 'mm', 'abc631b20220423142447.png', 135, 'huf', '2022-04-23 12:24:47'),
(47, 'FOA221PIR', 30, 'db', 'Fortuna', 'Írószer', 'piros', 'Alkoholos rostiron', 'Csomagolási egység: 40 db/csom\r\nAlkoholbázisú, permanent festékkel töltött marker precíziós fémfoglalatú írócsúccsal. Írásvastagság: 0,5mm.', 20, 'mm', 20, 'mm', 145, 'mm', 'abc631b20220423142500.png', 135, 'huf', '2022-04-23 12:25:00'),
(48, 'FOA221ZOL', 30, 'db', 'Fortuna', 'Írószer', 'zöld', 'Alkoholos rostiron', 'Csomagolási egység: 40 db/csom\r\nAlkoholbázisú, permanent festékkel töltött marker precíziós fémfoglalatú írócsúccsal. Írásvastagság: 0,5mm.', 20, 'mm', 20, 'mm', 145, 'mm', 'abc631b20220423142600.png', 135, 'huf', '2022-04-23 12:26:00'),
(49, 'KEN347FEK', 30, 'db', 'Kensington', 'Táska', 'fekete', 'Notebook táska', 'A „Classic Sleeve” kivitel védi számítógépét. Párnázott belső notebook rekesz, belső irattároló zseb. Párnázott vállpánt. Első és hátsó külső zsebek, sok hellyel a kiegészítők számára.', 30, 'cm', 40, 'cm', 7, 'cm', '05449f720220423150248.png', 7870, 'huf', '2022-04-23 13:02:48'),
(50, 'MAN347FEK', 30, 'db', 'MANHATTAN', 'Táska', 'fekete', 'Notebook táska', 'Rendelésre!\r\nKönnyű, tartós, könnyen tisztítható vízálló anyag.\r\nKülső méret: 31 x 41 x 7 cm\r\nBelső méret: 29 x 39 x 5 cm', 30, 'cm', 40, 'cm', 7, 'cm', '05449f720220423150500.png', 3585, 'huf', '2022-04-23 13:05:48'),
(51, 'SIG221KEK', 30, 'db', 'Signetta', 'Írószer', 'kék', 'Golyóstoll', 'Eldobható golyóstoll biztonsági kupakkal, tinta színével megegyező tolltest. Vonalvastagság: 0,7 mm. Íráshossz: 2500 m.', 20, 'mm', 20, 'mm', 145, 'mm', '537755520220423150806.png', 55, 'huf', '2022-04-23 13:08:06'),
(52, 'SIG221PIR', 30, 'db', 'Signetta', 'Írószer', 'piros', 'Golyóstoll', 'Eldobható golyóstoll biztonsági kupakkal, tinta színével megegyező tolltest. Vonalvastagság: 0,7 mm. Íráshossz: 2500 m.', 20, 'mm', 20, 'mm', 145, 'mm', '537755520220423150900.png', 55, 'huf', '2022-04-23 13:09:00'),
(53, 'SIG221ZOL', 30, 'db', 'Signetta', 'Írószer', 'zöld', 'Golyóstoll', 'Eldobható golyóstoll biztonsági kupakkal, tinta színével megegyező tolltest. Vonalvastagság: 0,7 mm. Íráshossz: 2500 m.', 20, 'mm', 20, 'mm', 145, 'mm', '537755520220423151000.png', 55, 'huf', '2022-04-23 13:10:00'),
(54, 'CAS112NAR', 30, 'db', 'Casio', 'Számológép', 'narancssárga', 'Asztali számológép', '12 számjegyű, NAGY DÖNTÖTT KIJELZŐ, ÁFA számítás, valutaváltás, elem (1xLR44)+napelem, utolsó szám javítása, gyökvonás, %, 00, +/-, narancs szín.\r\nMéret: 149,5 x 104,5 x 22,1 mm', 145, 'mm', 105, 'mm', 22, 'mm', 'd1267f220220423152213.png', 4325, 'huf', '2022-04-23 13:22:13'),
(55, 'CAS112ZOL', 30, 'db', 'Casio', 'Számológép', 'zöld', 'Asztali számológép', '12 számjegyű, NAGY DÖNTÖTT KIJELZŐ, ÁFA számítás, valutaváltás, elem (1xLR44)+napelem, utolsó szám javítása, gyökvonás, %, 00, +/-, narancs szín.\r\nMéret: 149,5 x 104,5 x 22,1 mm', 145, 'mm', 105, 'mm', 22, 'mm', 'd1267f220220423152300.png', 4325, 'huf', '2022-04-23 13:23:00'),
(56, 'CAS112ROZ', 30, 'db', 'Casio', 'Számológép', 'rózsaszín', 'Asztali számológép', '12 számjegyű, NAGY DÖNTÖTT KIJELZŐ, ÁFA számítás, valutaváltás, elem (1xLR44)+napelem, utolsó szám javítása, gyökvonás, %, 00, +/-, narancs szín.\r\nMéret: 149,5 x 104,5 x 22,1 mm', 145, 'mm', 105, 'mm', 22, 'mm', 'd1267f220220423152400.png', 4325, 'huf', '2022-04-23 13:24:00'),
(57, 'CAS161FEK', 30, 'db', 'Casio', 'Számológép', 'fekete', 'Asztali számológép', '12 számjegyű, NAGY DÖNTÖTT KIJELZŐ, ÁFA számítás, valutaváltás, elem (1xLR44)+napelem, utolsó szám javítása, gyökvonás, %, 00, +/-, narancs szín.\r\nMéret: 149,5 x 104,5 x 22,1 mm', 105, 'mm', 60, 'mm', 10, 'mm', 'd1267f220220423153000.png', 1945, 'huf', '2022-04-23 13:30:00'),
(58, 'CAS162FEK', 30, 'db', 'Casio', 'Számológép', 'fekete', 'Asztali számológép', '417 funkció, 10 (+2) számjegy, S-VPAM, kétsoros kijelző, természetes algebrai bevitelt biztosító kijelző, 9 memória, törtszámítás, koordináta transzformáció, statisztika, komplex számok, mátrixok, vektorok, logikai műveletek, mérnöki szimbólumok .', 105, 'mm', 180, 'mm', 10, 'mm', 'd1267f220220423153100.png', 10870, 'huf', '2022-04-23 13:31:00'),
(59, 'CAS163FEK', 30, 'db', 'Casio', 'Számológép', 'fekete', 'Asztali számológép', '417 funkció, 10 (+2) számjegy, S-VPAM, kétsoros kijelző, természetes algebrai bevitelt biztosító kijelző, 9 memória, törtszámítás, koordináta transzformáció, statisztika, komplex számok, mátrixok, vektorok, logikai műveletek, mérnöki szimbólumok .', 115, 'mm', 65, 'mm', 17, 'mm', 'd1267f220220423153500.png', 1725, 'huf', '2022-04-23 13:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_discount`
--

CREATE TABLE `product_discount` (
  `id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount` int(3) NOT NULL,
  `new_price` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `product_discount`
--

INSERT INTO `product_discount` (`id`, `code`, `product_id`, `discount`, `new_price`, `start`, `end`) VALUES
(12, 'CAS112NAR', 54, 30, 3780, '2022-04-24 12:20:00', '2022-04-30 12:20:00'),
(13, 'SET464ZOL', 36, 50, 2360, '2022-04-24 13:00:00', '2022-04-30 13:00:00'),
(14, 'DII341SZI', 9, 20, 715, '2022-04-25 19:47:00', '2022-04-30 19:47:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `product_discount`
--
ALTER TABLE `product_discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
