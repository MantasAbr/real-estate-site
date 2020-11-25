-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 25, 2020 at 03:57 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portalas`
--

-- --------------------------------------------------------

--
-- Table structure for table `object`
--

CREATE TABLE `object` (
  `object_id` varchar(32) COLLATE utf8_lithuanian_ci NOT NULL,
  `seller_id` varchar(32) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `buyer_id` varchar(32) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `is_pending` tinyint(1) UNSIGNED DEFAULT NULL,
  `is_sold` tinyint(1) UNSIGNED DEFAULT NULL,
  `times_reserved` int(8) DEFAULT NULL,
  `views` int(10) DEFAULT NULL,
  `image` varchar(200) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_lithuanian_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_lithuanian_ci NOT NULL,
  `price` int(15) NOT NULL,
  `description` varchar(200) COLLATE utf8_lithuanian_ci NOT NULL,
  `upload_time` datetime NOT NULL,
  `buy_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `object`
--

INSERT INTO `object` (`object_id`, `seller_id`, `buyer_id`, `is_pending`, `is_sold`, `times_reserved`, `views`, `image`, `address`, `city`, `price`, `description`, `upload_time`, `buy_time`) VALUES
('2c59366010b2d2038597c4a4eed01190', '0d8a51ed902e221fdb4be7a6e13899d5', NULL, 0, 0, 0, 0, '2c59366010b2d2038597c4a4eed01190-1606310889.jpg', 'Baltijos prospektas 111a', 'KlaipÄ—da', 75000, 'Statytojas parduoda butus naujame gyvenamÅ³jÅ³ namÅ³ komplekse Baltijos Terasos. Butai parduodami tiesiogiai, be tarpininkÅ³, pirkÄ—jams nÄ—ra papildomÅ³ komisiniÅ³ ar pan. mokesÄiÅ³.', '2020-11-25 15:28:09', NULL),
('32fcb978141dbc646b8dbcad5cdc5a87', 'ef599000139676a68461e02773f586d3', NULL, 0, 0, 2, 13, '32fcb978141dbc646b8dbcad5cdc5a87-1606310369.png', 'BasanaviÄiaus gatvÄ— 61c', 'GargÅ¾dai', 65000, 'Butas naujai Ä¯rengtame name', '2020-11-24 15:23:42', NULL),
('37d0c7051797160dbf0ee03a171f545f', 'ef599000139676a68461e02773f586d3', NULL, 0, 0, 0, 0, '37d0c7051797160dbf0ee03a171f545f-1606310232.jpg', 'Daujoto gatvÄ— 65', 'Vilnius', 84000, 'Parduodamas 59 kv m dviejÅ³ kambariÅ³ butas itin ekonomiÅ¡kame A energinio naudingumo name, kurio langai orientuoti Ä¯ Å¡iaurÄ—s bei rytÅ³ puses.', '2020-11-25 15:17:12', NULL),
('4fa34dd4cd0e5c0411020f53a556f5fd', 'ef599000139676a68461e02773f586d3', NULL, 0, 0, 0, 2, '4fa34dd4cd0e5c0411020f53a556f5fd-1606310329.jpg', 'VydÅ«no gatvÄ— 126', 'Vilnius', 99700, 'PARDUODAMAS ERDVUS, Å VIESUS IR NAUJAI SUREMONTUOTAS 70 m2 BUTAS PILAITÄ–JE.', '2020-11-25 15:18:49', NULL),
('504db57a4b43c21e5e799cb1b149caca', '0d8a51ed902e221fdb4be7a6e13899d5', '7e5f7874eeb2298a40966d5a45060220', 0, 1, 1, 5, 'unnamed.jpg', 'sklypo g. 5', 'Kretinga', 2000, 'tusÄias sklypas', '2020-11-07 12:12:51', '2020-11-10 16:35:28'),
('68efdcb3c30f1be1945c846b65220632', '0d8a51ed902e221fdb4be7a6e13899d5', NULL, 0, 0, 1, 24, 'Vygintas-1-2.png', 'SaulÄ—s gatvÄ— 55', 'Å akiai', 60000, 'Naujai statytas namas', '2020-11-07 12:25:59', NULL),
('8c02e35619a3fdeb0bcca78e449b8012', '0d8a51ed902e221fdb4be7a6e13899d5', NULL, 0, 0, 0, 2, '8c02e35619a3fdeb0bcca78e449b8012-1606311091.jpg', 'Karaliaus Mindaugo gatvÄ— 12', 'GargÅ¾dai', 62600, 'Ypatingai patogi vieta Karaliaus Mindaugo g. 12 GargÅ¾dai. Å alia keli prekybos centrai, mokyklos, darÅ¾eliai. Pukiai iÅ¡vystyta infrastruktÅ«ra, geras susisiekimas su bet kuria miesto dalimi.', '2020-11-25 15:31:31', NULL),
('ecbc82f62ea4d06b3f96cb5785cd4c1c', 'ef599000139676a68461e02773f586d3', 'a73cbb1897653b49b1ec823499de30e9', 0, 1, 1, 12, '75_1680x1000xwatermark-populiarus-namo-projektas-pigus-namu-projektai-nps-projektai-samanta-1.jpg', 'Lenktoji g. 14a', 'GargÅ¾dai', 120000, 'Paprastas, tradicinis, keturÅ¡laitis namas', '2020-11-08 15:44:21', '2020-11-10 15:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_level_message`
--

CREATE TABLE `user_level_message` (
  `user_id` varchar(32) COLLATE utf8_lithuanian_ci NOT NULL,
  `message` varchar(200) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vartotojas`
--

CREATE TABLE `vartotojas` (
  `userid` varchar(32) NOT NULL,
  `userlevel` tinyint(1) UNSIGNED DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `telephone` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vartotojas`
--

INSERT INTO `vartotojas` (`userid`, `userlevel`, `username`, `telephone`, `email`, `password`, `timestamp`) VALUES
('0d8a51ed902e221fdb4be7a6e13899d5', 5, 'martynas', '+37063315984', 'asesumartynas@gmail.com', '8215a9c39ea84e593c0d148f157ec070', '2020-11-25 13:36:00'),
('44c250868e3f726b78c193bbfe4504fe', 4, 'mantas', '+37063313985', 'mantas.abramavicius@ktu.edu', '69801766d5124e68cb46ce653f6dc24e', '2020-11-24 17:22:58'),
('7e5f7874eeb2298a40966d5a45060220', 4, 'greenas', '+37063333333', 'aaaa@aaaa.aaaa', 'eed3acfc38fa07d38ff67b670d8ae485', '2020-11-25 12:49:04'),
('8712ba1b7d9dc029ca69ff8fa1b199fb', 4, 'vartotojas', '+37069512684', 'vartotojas@gmail.com', '0ac5677b1f07b02b1d388042cbeecf9b', '2020-11-24 16:47:56'),
('a73cbb1897653b49b1ec823499de30e9', 4, 'akvile', '+37067128898', 'knismesis666@gmail.com', 'c07125ea8319bc6fd7f9df2cf3a164b2', '2020-11-23 14:22:39'),
('bb543f5cff2815416ccce30e70c4e3d2', 9, 'admin', 'admin', 'mantasabra@gmail.com', '6e5b5410415bde908bd4dee15dfb167a', '2020-11-25 13:49:46'),
('ef599000139676a68461e02773f586d3', 5, 'pardavejas', '+37063315982', 'seller@gmail.com', '24b65e2b058916841db1a7659ecbb68a', '2020-11-25 13:49:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `object`
--
ALTER TABLE `object`
  ADD PRIMARY KEY (`object_id`);

--
-- Indexes for table `user_level_message`
--
ALTER TABLE `user_level_message`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vartotojas`
--
ALTER TABLE `vartotojas`
  ADD PRIMARY KEY (`userid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
