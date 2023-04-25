-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 22, 2023 at 07:47 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kittenfactoryskis`
--
CREATE DATABASE IF NOT EXISTS `kittenfactoryskis` DEFAULT CHARACTER SET armscii8 COLLATE armscii8_general_ci;
USE `kittenfactoryskis`;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `CUST_ID` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `USER_ID` int NOT NULL,
  PRIMARY KEY (`CUST_ID`),
  KEY `fk_customer_user_id` (`USER_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CUST_ID`, `first_name`, `last_name`, `address`, `USER_ID`) VALUES
(8, 'Paula', 'Jones', 'Sesame Street', 33),
(49, 'Chrystel', 'Vedesh', 'PO Box 9334', 55),
(48, 'Derwin', 'St. Hill', 'PO Box 868456', 54),
(47, 'Bunni', 'Conman123', 'Apt 581', 53),
(13, 'Meyer', 'Saxby', 'Apt 588', 39),
(12, 'Charlene', 'Writer', 'Suite 20', 38),
(11, 'Georgy', 'Farndell', '9th Floor', 37),
(46, 'Kass', 'Bollman', 'Apt 506', 52),
(45, 'Randall', 'Lasty', 'Room 992', 51),
(44, 'Bronnie', 'Penney', 'PO Box 23823', 50),
(43, 'Ardine', 'MacKeller', '12th Floor', 49),
(42, 'Dodi', 'Roskell', 'Suite 29', 48),
(41, 'Ralph', 'Meaton', '16th Floor', 47),
(40, 'Dalton', 'Balharrie', 'Room 557', 46),
(39, 'Todd', 'Lowten', 'Suite 4', 45),
(38, 'Emmye', 'Huntress', 'Room 120', 44),
(37, 'Meir', 'Cappleman', 'Suite 25', 43),
(36, 'Leanor', 'Pointon', 'PO Box 59298', 42),
(35, 'Britni', 'Bantham', 'Suite 64', 41),
(34, 'Miguela', 'Strephan', 'Apt 1697', 40),
(50, 'Christopher', ' Anstie', 'Room 21', 56),
(51, 'Dewie', 'Frans', 'Apt 1753', 57),
(52, 'Zorine', 'Stanary', 'Room 6435', 58),
(53, 'Enoch', 'Trubshawe', 'PO Box 564', 59),
(54, 'Tabbatha', 'Woofie', 'Suite 908', 60),
(55, 'Klement', 'Rougier', 'Suite 745', 61),
(56, 'Jaime', 'Rubellow', 'Apt 1823 Floral Street', 62),
(63, 'Alex', 'Hewitson', 'Utah', 89);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `EMP_ID` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `USER_ID` int NOT NULL,
  PRIMARY KEY (`EMP_ID`),
  KEY `fk_employee_user_id` (`USER_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EMP_ID`, `first_name`, `last_name`, `position`, `USER_ID`) VALUES
(11, 'Bob', 'Smith', 'admin', 34),
(12, 'Spencer', 'Young', 'CEO', 63),
(13, 'Jong', 'Lee', 'VP Sales', 64),
(14, 'Nevin', 'Hablyn', 'Marketing', 65),
(15, 'Dina', 'Shardlow', 'Mounter', 66),
(16, 'Ermentrude', 'Hill', 'Marketing', 67),
(17, 'Jud', 'Gibling', 'Mounter', 68),
(18, 'Briant', 'Robel', 'Accounting', 69),
(19, 'Elden', 'Culligan', 'Accounting', 70),
(20, 'Pernell', 'Bearman', 'Shipper', 71),
(21, 'Jordan', 'Micheal', 'Marketing', 72),
(22, 'Terrijo', 'Liptrod', 'Builder', 73),
(23, 'Elga', 'Epton', 'VP Marketing', 74),
(24, 'Annadiana', 'Clarridge', 'Waxer', 75),
(25, 'Henry', 'Towns', 'Finance', 76),
(26, 'Izsabell', 'Lasting', 'Finance Intern', 77),
(27, 'Piggy', 'Louw', 'IT', 78),
(28, 'Rochette', 'Hysom', 'Mounter', 79),
(29, 'Tides', 'Brislan', 'IT Intern', 80),
(30, 'Shadow', 'Belward', 'Master Chief', 81),
(31, 'Anyone', 'Seeingthis', 'Tester', 82);

-- --------------------------------------------------------

--
-- Table structure for table `orderline`
--

DROP TABLE IF EXISTS `orderline`;
CREATE TABLE IF NOT EXISTS `orderline` (
  `ORDLNE_ID` int NOT NULL AUTO_INCREMENT,
  `PROD_ID` int NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `ORD_ID` int NOT NULL,
  PRIMARY KEY (`ORDLNE_ID`),
  KEY `PROD_ID` (`PROD_ID`),
  KEY `ORD_ID` (`ORD_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orderline`
--

INSERT INTO `orderline` (`ORDLNE_ID`, `PROD_ID`, `quantity`, `unit_price`, `total_price`, `ORD_ID`) VALUES
(1, 1, 1, '999.99', '999.99', 2),
(2, 1, 1, '999.99', '999.99', 2),
(3, 3, 1, '999.99', '999.99', 4),
(4, 3, 1, '999.99', '999.99', 4),
(5, 4, 3, '999.99', '2999.97', 6),
(6, 3, 2, '999.99', '1999.98', 7),
(7, 1, 1, '999.99', '999.99', 7),
(8, 4, 1, '999.99', '999.99', 8),
(9, 4, 1, '999.99', '999.99', 9),
(10, 4, 1, '999.99', '999.99', 10),
(11, 1, 3, '999.99', '2999.97', 11),
(12, 2, 3, '999.99', '2999.97', 12),
(13, 4, 4, '999.99', '3999.96', 13),
(14, 2, 6, '999.99', '5999.94', 14),
(15, 2, 1, '999.99', '999.99', 15),
(16, 2, 1, '999.99', '999.99', 16),
(17, 2, 1, '999.99', '999.99', 16),
(18, 4, 11, '999.99', '10999.89', 18),
(19, 1, 1, '999.99', '999.99', 19),
(46, 11, 1, '299.95', '299.95', 35),
(45, 18, 1, '1049.99', '1049.99', 34),
(44, 17, 4, '269.99', '1079.96', 33),
(43, 10, 1, '89.40', '89.40', 32),
(26, 1, 2, '999.99', '1999.98', 23),
(27, 6, 1, '799.95', '799.95', 24),
(28, 1, 1, '999.99', '999.99', 24),
(29, 13, 1, '270.97', '270.97', 25),
(30, 3, 1, '999.99', '999.99', 25),
(31, 3, 1, '999.99', '999.99', 25),
(32, 1, 1, '999.99', '999.99', 26),
(33, 3, 1, '999.99', '999.99', 26),
(34, 17, 1, '269.99', '269.99', 27),
(35, 21, 1, '649.99', '649.99', 27),
(36, 17, 1, '269.99', '269.99', 27),
(37, 12, 1, '159.20', '159.20', 28),
(38, 10, 2, '89.40', '178.80', 28),
(39, 3, 2, '999.99', '1999.98', 29),
(40, 1, 1, '999.99', '999.99', 29),
(41, 1, 8, '999.99', '7999.92', 30),
(42, 1, 5, '999.99', '4999.95', 31);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `ORD_ID` int NOT NULL AUTO_INCREMENT,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `PMT_ID` int NOT NULL,
  `CUST_ID` int NOT NULL,
  PRIMARY KEY (`ORD_ID`),
  KEY `PMT_ID` (`PMT_ID`),
  KEY `CUST_ID` (`CUST_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ORD_ID`, `total_price`, `status`, `date`, `PMT_ID`, `CUST_ID`) VALUES
(2, '1999.98', 'Shipped', '2023-04-18', 6, 8),
(4, '1999.98', 'RTN Shipping', '2023-04-18', 6, 8),
(17, '5.00', 'processing', '2023-04-19', 6, 7),
(6, '2999.97', 'RTN Shipping', '2023-04-18', 6, 8),
(7, '2999.97', 'RTN Completed', '2023-04-18', 6, 8),
(8, '999.99', 'Shipped', '2023-04-18', 6, 8),
(9, '999.99', 'RTN Shipping', '2023-04-18', 6, 8),
(10, '999.99', 'Processing', '2023-04-18', 6, 8),
(11, '2999.97', 'RTN Requested', '2023-04-18', 6, 8),
(12, '2999.97', 'RTN Shipping', '2023-04-18', 6, 8),
(13, '3999.96', 'RTN Requested', '2023-04-18', 6, 8),
(14, '5999.94', 'RTN Requested', '2023-04-18', 6, 8),
(15, '999.99', 'RTN Requested', '2023-04-18', 6, 8),
(16, '1999.98', 'Shipped', '2023-04-18', 6, 8),
(18, '10999.89', 'Wait Inv', '2023-04-19', 6, 8),
(19, '999.99', 'RTN Requested', '2023-04-19', 6, 8),
(23, '1999.98', 'RTN Requested', '2023-04-20', 6, 8),
(24, '1799.94', 'RTN Requested', '2023-04-20', 6, 8),
(26, '1999.98', 'Processing', '2023-04-22', 31, 57),
(27, '1189.97', 'Processing', '2023-04-22', 32, 57),
(28, '338.00', 'RTN Requested', '2023-04-22', 27, 8),
(32, '89.40', 'Processing', '2023-04-22', 33, 63),
(29, '2999.97', 'RTN Requested', '2023-04-22', 18, 8),
(30, '7999.92', 'Wait Inv', '2023-04-22', 23, 8),
(31, '4999.95', 'Wait Inv', '2023-04-22', 19, 8),
(33, '1079.96', 'Processing', '2023-04-22', 33, 63),
(34, '1049.99', 'Processing', '2023-04-22', 33, 63),
(35, '299.95', 'RTN Requested', '2023-04-22', 33, 63);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `PMT_ID` int NOT NULL AUTO_INCREMENT,
  `exp_date` varchar(10) NOT NULL,
  `credit_card` varchar(16) NOT NULL,
  `CUST_ID` int NOT NULL,
  PRIMARY KEY (`PMT_ID`),
  KEY `CUST_ID` (`CUST_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PMT_ID`, `exp_date`, `credit_card`, `CUST_ID`) VALUES
(6, '06/2028', '1234567891011121', 8),
(14, '08/2002', '8756432524351243', 8),
(15, '07/2026', '5345234523234235', 8),
(33, '05/2026', '1234567890987654', 63),
(17, '01/2027', '7319497530786703', 8),
(18, '02/2024', '4376887888326304', 8),
(19, '03/2025', '1322428688587867', 8),
(20, '04/2023', '1378165598719826', 8),
(21, '08/2026', '3867976726701570', 8),
(22, '09/2023', '1696404983361981', 8),
(23, '10/2033', '4690737401223053', 8),
(24, '12/2024', '1767765894587391', 8),
(25, '12/2024', '3418199237303054', 8),
(26, '11/2023', '8690642877945268', 8),
(27, '09/2023', '7260489830332381', 8),
(28, '08/2023', '2492628005120403', 8),
(29, '01/2045', '6062641863389187', 8),
(30, '06/2023', '0077893173074022', 8),
(31, '02/2023', '6276119576723629', 57),
(32, '07/2024', '9287361590792747', 57);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `PROD_ID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `inventory` int NOT NULL,
  `imagepath` varchar(500) NOT NULL,
  PRIMARY KEY (`PROD_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`PROD_ID`, `name`, `description`, `price`, `inventory`, `imagepath`) VALUES
(1, 'All Mountain', 'Designed to do it all, the All Mountain is your perfect one ski quiver. Straight Carbon Layup in conjunction with the cruiser weight cores allows this ski to be light enough for a long day of touring, but strong and stable enough to go bell to bell at your local resort.', '999.99', 2, '../../images/all_mountain.jpg'),
(2, 'Carbon Pow', 'The Carbon Pow is a versatile, maneuverable ski that likes to get pitted. Torsion Tech lets these wider skis hold an edge on the hardpack and the Straight carbon layup means the carbon pow won\'t give out when the terrain gets dicey. The cruiser weight cores let you use this as an everyday ski that still tours extremely well.', '999.99', 11, '../../images/carbon_pow.jpg'),
(3, 'Chairman', 'The Chairman is a stable, directional charger that likes to go fast. This ski will allow you to power through inbounds chunder and inspire confidence on big mountain lines. The toors tail, cruiser weight cores and straight carbon layup make the chairman a no compromise touring ski or an everyday inbounds ripper.', '999.99', 6, '../../images/chairman.jpg'),
(4, 'El Hefe', 'Designed for the boss Heffy himself. Matt demanded a beefier version of the chairman and thats just what we made. With a a stiff flex, long turn radius, and wide footprint this ski will give you stability and piece of mind while you are straight-lining chutes, blasting through crud, or dropping big cliffs.', '999.99', 10, '../../images/el_hefe.jpg'),
(6, 'Rossignol Blackops 118', 'Finding the right combination of playful surfiness and straightline stability in a pow ski is as tough as fishing a Rainbow out of the creek with your bare hands, but Rossi nailed it with the Rossignol Black Ops 118 Tatum Skis. Tatum Monod', '799.95', 10, '../../images/rossignol.jpg'),
(9, 'G3 Climbing Skins 2.0', 'G3 x Backcountry collab for fast-gliding, Goat-worthy skins. PFC-free waterproof treatment keeps the nylon plush dry.', '70.48', 11, '../../images/g2_skins.jpg'),
(10, 'Carbon Ski Touring Pole', 'High-performance poles for seeking out hidden powder stashes.', '89.40', 10, '../../images/ski_pole.jpg'),
(11, 'Cottonwoods GORE-TEX Jacket - Men\'s', 'Every skier and snowboarder\'s ambition is a 100-day season, and we built our burly Cottonwoods GORE-TEX Jacket to get those dreamers to their goal. With GORE-TEX\'s reliable waterproofing and our tough-as-nails ski fabric, this jacket delivers top performance in powder storms, tight trees, and open groomers.', '299.95', 9, '../../images/mens_jacket.jpg'),
(12, 'Ski &amp; Snowboard Boot Bag', 'You\'ve probably heard it before, boots are the most important piece of gear you can own no matter your skill level. So while you can easily rent skis upon arrival, we built the Ski and Snowboard Boot Bag to haul the most valuable item of all.', '159.20', 9, '../../images/boot_bag.jpg'),
(13, 'Ridge Infinity Shell Pant - Men\'s', 'When we\'re on the skin track, the two concerns at the forefront of our minds are, &quot;How will we get to the top?&quot; and &quot;How much longer will we be able to enjoy this snow?&quot; Helly Hansen\'s Ridge Infinity Shell Pant addresses both issues, starting with our comfort and mobility. ', '270.97', 6, '../../images/helly_pants.jpg'),
(14, 'Logo Tee', 'Classic Logo Tee. 50/50 Cotton Polyester Blend', '20.00', 9, '../../images/logo_tee.jpg'),
(15, 'Smith Helmet', 'MIPS technology helps reduce rotational forces on the brain in the event of a fall or collision. Adjustable ventilation system allows you to customize airflow.', '149.97', 12, '../../images/smith_helmets.jpg'),
(16, 'Technically Mach 1 MV Ski Boot', 'When we want to ski fast we trust the Tecnica Mach1 MV 130 Boot to keep our foot locked in place, our edges digging into the snow, and our feet warm and functional.', '799.99', 5, '../../images/tecnica_boot.jpg'),
(17, 'Marker Griffon 13 ID Ski Bindings', 'The lighter version of the Jester, providing the same features for younger and lighter riders, is one of the most versatile freeride bindings on the market today, made for advanced to expert skiers. The new Griffon 13 ID is equipped with all new Triple Pivot Elite toe and Inter Pivot 3 freeride heel.', '269.99', 59, '../../images/marker.jpg'),
(18, 'PFD 132', 'The PFD.132 is your dream ski when it gets super deep. The huge footprint of this ski is complimented with our flyweight cores, making it unbelivably light and maneuverable while still providing all of the floatation you could ever need on even the deepest days.', '1049.99', 11, '../../images/pfd_132.jpg'),
(19, 'Razor 95', 'The Razor 95 are the perfect park and all mountain jib ski. Our Symm.Twin, hybrid laminate and carbonated pop ensure that this ski excells on both rails and jumps while the 18 gauge base and HRC-Street edges can take any abuse you throw at them. A wider platform underfoot means the Rayzrblaydz can hold their own outside the park as well.', '599.99', 7, '../../images/razor_95.jpg'),
(20, 'Razor 105', 'The Razor 105 shares many similarities with the 95 but offers a wider platform for a more all mountain friendly park ski. The 105 features our 18 gauge base and HRC-Street edges to ensure that they hold up to all the taps, rails and hidden rocks you can find. Like the rest of the Razor line it also features our Symm.Twin technology. If you need a park ski that can more than hold its own wherever you take it the Razor 105 is the ski for you.', '599.99', 8, '../../images/razor_105.jpg'),
(21, 'Razor 115', 'The Razor 115, are the perfect tool for using the entire mountain as your terrain park. Symm.Twin allows this ski to feel like a park ski on pow jumps but still maintain stablity when charging at highspeed at your local resort. Simply a must have for anyone looking to take their park tricks to the backcountry.', '649.99', 8, '../../images/razor_115.jpg'),
(22, 'Toors Light', 'The Toors light is a super lightweight dedicated touring ski. The combination of our flyweight cores, straight carbon layup and toors tail technologies allow us to create a full sidewall, durable, touring specific ski that is unbelievably light', '1049.99', 25, '../../images/toors_light.jpg'),
(23, 'Atris Ski', 'Our choice for pushing the envelope in steep and playful terrain, the Atris Ski offers stability, freedom, and control. The Atris', '719.99', 8, '../../images/black_crow.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `USER_ID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `username`, `password`, `role`) VALUES
(33, 'pjones', '$2y$10$Rwv.yXGbnunr8bwTT1a00efyVdAK.jyMzQ2seSic0VBA.8B3cSgHC', 'customer'),
(34, 'bsmith', '$2y$10$026HMdQPehkvSeyZGCr4C.8C/Orb5rnHRgi149oI44hBSbdO/ENi.', 'employee'),
(89, 'ahewitson', '$2y$10$BRhszUScPvpT.tvfsEO9lO/h0GxMgWwm4uIT89xLBBaq6NeJjjrUa', 'customer'),
(37, 'gfarndell', '$2y$10$Pf./J4AFiDsJ1Up/k8uWTuJcn9z.KUQa1sD0FK9MBZWfeNqJKFMmS', 'customer'),
(38, 'cwriter', '$2y$10$xbXLFCBmbn.xGdLsIEZYo.0mvO.HhAGig8WGdElgMnGs8aD3pcRxC', 'customer'),
(39, 'msaxby', '$2y$10$ojSvIF1jkG00LDaMTvk1Iu4Pu6njvqNlaJKS8wSOVqTMsvzI.U502', 'customer'),
(40, 'mstrephan', '$2y$10$AYmCHP2VGdQpo27MnkUquu2R3ORd9KnATXmPtJ9D2HZ9C5f4GuhkW', 'customer'),
(41, 'bbantham', '$2y$10$Ck0kWhRdhcCgX4tb5V1n2eTu6GJeW775hKIdAnj2greSXGC55Fk3S', 'customer'),
(42, 'lpointon', '$2y$10$JWHBaeeeoBFshEKXub9bAebAg5kBojIfVpn/6rcXNlZnGsJ6sj3hK', 'customer'),
(43, 'mcappleman', '$2y$10$b.ZXbIP5FkZJp91ceHzqVuKi8mBn2bsiE2LrNyfFV.sACqrfzdXOK', 'customer'),
(44, 'Emhuntress', '$2y$10$lSv5J4epIj0E7Ie0AQ9fxuEn1.QQc/73Bsx3EEbKeyg6o.Pgw7Kgy', 'customer'),
(45, 'tlow', '$2y$10$IMOR.fFHoN9IHS9eiHZOs.lWJ7KZnaHTNaceiuhu3SVgEidJNcFFa', 'customer'),
(46, 'Darrie', '$2y$10$QK8oGIWbRKlk3C2oi3sAbeuljK14YZn.w18bBveWFDaXPsMywNmFq', 'customer'),
(47, 'rmeaton', '$2y$10$zh4ue5CMOntkt71GIFta3eMj3.nzz/vOfqHNCoXdbnwYr5rreYtA2', 'customer'),
(48, 'droskell', '$2y$10$JDDZwfq2U6sOHRK.6ZG0oOg4th5X3Pkb4rSyuMQw4Y4BeWiuYD4gC', 'customer'),
(49, 'Ardimac', '$2y$10$/UjdtMyPr6EjFPv1zolctOie6fTwnl6lkMpidnaoyFgVSbObXQsDC', 'customer'),
(50, 'bronnie', '$2y$10$pXeCNTqK3iSbN00TmKUShuZ5PSAso3sf41FB0f7kTGkZhNGZApYFy', 'customer'),
(51, 'rlasty', '$2y$10$dc13tXH.T4WQBcYgQx.ig.KjYF3DKpe.Cp6RLOszrgidGlZ3hbxOS', 'customer'),
(52, 'kbol', '$2y$10$SDRPXEdXjTDP/QVAKusC8e6.41f4g9Hf8ViWIcd8NUqrJv3oBA55i', 'customer'),
(53, 'Bunnicon', '$2y$10$1cusWgAWofhn2j.vtpnh9urtJbNmQnaYUqMxKIAgYf9UGR/p3GxfC', 'customer'),
(54, 'Derwinnie', '$2y$10$EkjSADIBE9ZIFOJcz87z6..4DZCpYgXe2Djirr6z.y3qeQPwyMbc6', 'customer'),
(55, 'cved', '$2y$10$wuA8KT5J2w2hHWHJmLT26.cyPlsarbG8yfwepUXMpUaGg94R/Tqoa', 'customer'),
(56, 'christophie', '$2y$10$DWzYRaU.FyKC6nnUWB4WpukHaJXDoUwaWyCQXfkyMYEbY8aFqvKQi', 'customer'),
(57, 'dewiesag', '$2y$10$iOIoPOb2O4f8X2icWGEQO.De61X7aIyjBnCiH9oLZj6D8JmBR59tG', 'customer'),
(58, 'ztown', '$2y$10$UekIRjaMajstU2E7UGOyw.30l7iZ19p0mbfZKt1S2oknjASnWmoVq', 'customer'),
(59, 'enocj', '$2y$10$gtVcVDA8u50i7WvMN7BIbennC2sTqkxsM8i20v6H.w4foluNJ3iYa', 'customer'),
(60, 'Tabbie', '$2y$10$YlVpgG3iE7KoF0weoWNZq.9qoAdOnWsk47AdoJVMW4gC6Me5E1ZPi', 'customer'),
(61, 'ktown', '$2y$10$FV0G8WRF.DjJVOdRQVIVQexw13l7W3qXDJNhHp6nFb7SurFXHkRDC', 'customer'),
(62, 'jamie989', '$2y$10$ORO.C5iWNcyyDtD/KKeLr.j1kWrkS0x7UJ7blvBMy72AqNjDJhEDG', 'customer'),
(63, 'wowzerz', '$2y$10$9lq78PINPiRA3olzCXM0tuzevnKUqlHJbyXnjokCeCT9SU4ZHeXb6', 'employee'),
(64, 'wowtest', '$2y$10$JZqCMpaKFZN4J0rT5BJusufXMZFip.1Cp0.M8gyQUAYFRnWvYbYqO', 'employee'),
(65, 'nevie', '$2y$10$xvh7gdTZtAYc4fX.HuS7R.Jtlsh/NZ1ESBUGJ6igfTIAVy9mP1Mi2', 'employee'),
(66, 'dinner', '$2y$10$xgwWGL2/YrZ.dCDhn8VCx.xh/FJEpViKH3lX0yLJicEITMs7U5cKu', 'employee'),
(67, 'ernie', '$2y$10$dqLU7Fq3d1Rong9TY1Kwq.jIn94YeiS4obuoLcg.e2jSs8KBJLs46', 'employee'),
(68, 'judie345', '$2y$10$a.vjr2pE5kHo1qZPd64anehcJFeR31hGFzk78VAZ2zdWdPXJlrnGS', 'employee'),
(69, 'brianfamily', '$2y$10$DFBuFEeMFZ6TjZO22niWHuemiMVAUnUe5Is98j2uOOVLJ2tnxrxLW', 'employee'),
(70, 'eldenring', '$2y$10$ChqGG2On7cudO17dGLAH9u5BwwezjQ.qDrQFhHaupLVmEv9pyFZwC', 'employee'),
(71, 'pernie', '$2y$10$qkP1u7w5Ot1bWSkcT1LQjefKhs0G.FkTtVUKs6Rw6TGOre2K8tOKG', 'employee'),
(72, 'jordan23', '$2y$10$wpm.qGQKYCbqjPXPKRnxtefK.sfriIaSelJrDGwIwmOD5/2PhIEsK', 'employee'),
(73, 'terry1234', '$2y$10$e103w6LW4L8iA4wS2ZwGReTeRha8bt5lTShGpS.17FvZZgxCWvsgm', 'employee'),
(74, 'elga', '$2y$10$6OoBy06ZQJCWupEpg/bdgeSKLLAhjGOTLEmi/6vIYzIgnnLs5Ugmu', 'employee'),
(75, 'annieb', '$2y$10$N8LtFdADtvCoGJc51Os/4e/Dukeg28RvPWGmr/JJhM/vGAtPI00ii', 'employee'),
(76, 'henry7665', '$2y$10$lrKa74wvgCumunVBVTxBW.Atzh5LEP.WNWtDDBxJj0gaTjqJzvuIO', 'employee'),
(77, 'izzy', '$2y$10$IoBAMH.oorqA2rqdo1vO9eX1G01ZukiULVrDrA7soOsocnGppCu1i', 'employee'),
(78, 'winnie', '$2y$10$vVwtqsf5pZkm7yEmXxl1QuSDKmffN5Npv/UEz387cYZWd36QRUYZa', 'employee'),
(79, 'rolly5656', '$2y$10$kg0NdpTapIhGituOhho13eZZ77ciE3sRt7bR14JsrvzpufXEZ5m.K', 'employee'),
(80, 'taddie', '$2y$10$ZY8m17fixDIepLFI6yHw.eFiUHfPemvdYGd2LK.LPURDozh2LsxKa', 'employee'),
(81, 'thedarkside', '$2y$10$zge1TczCmcMXis1HF3hygui6toFGI/IL4R3rqLzlJ4M1NwJA1j5iy', 'employee'),
(82, 'yolo', '$2y$10$9S.IMizN21GX2cw8nDKjyuaqz4DThUzNZUXS1YG6jRf7qlhx.DDfW', 'employee');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
