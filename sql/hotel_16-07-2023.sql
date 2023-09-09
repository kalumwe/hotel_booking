-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 16, 2023 at 07:23 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--
-- Creation: May 30, 2023 at 02:25 AM
--

CREATE TABLE `images` (
  `image_id` int(10) UNSIGNED NOT NULL,
  `full_pic` varchar(30) CHARACTER SET latin1 NOT NULL,
  `semi_pic` varchar(30) NOT NULL,
  `thumb` varchar(30) NOT NULL,
  `caption` varchar(150) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `images`:
--

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `full_pic`, `semi_pic`, `thumb`, `caption`) VALUES
(16, '1.jpg', '1_semi.jpg', '1_tbh.jpg', 'duplex'),
(18, '1_1683995377.jpg', '1_semi_1683995377.jpg', '1_thb_1683995377.jpg', 'test'),
(19, '3_1684072876.jpg', '3_semi_1684072876.jpg', '3_thb_1684072876.jpg', 'test 2'),
(20, '4_1684073451.jpg', '4_semi.jpg', '4_thb.jpg', 'standard room'),
(21, '7.jpg', '7_semi.jpg', '7_thb.jpg', 'pexels'),
(22, '6.jpg', '6_semi.jpg', '6_thb.jpg', 'pexels'),
(23, '6_1684074143.jpg', '6_semi_1684074143.jpg', '6_thb_1684074143.jpg', 'pexels'),
(24, '9.jpg', '9_semi.jpg', '9_thb.jpg', 'fesg'),
(25, '3_1684075522.jpg', '3_semi_1684075522.jpg', '3_thb_1684075522.jpg', 'pexels'),
(26, '5.jpg', '5_semi.jpg', '5_thb.jpg', 'fesg'),
(27, '1_1684080558.jpg', '1_semi_1684080558.jpg', '1_thb_1684080558.jpg', 'duplex'),
(28, '1_1684080827.jpg', '1_semi_1684080827.jpg', '1_thb_1684080827.jpg', 'duplex'),
(29, '17_1684081812.jpg', '17_semi_1684081812.jpg', '17_thb_1684081812.jpg', 'pexels'),
(30, '15.jpg', '15_semi.jpg', '15_thb.jpg', 'pexels'),
(31, '13.jpg', '13_semi.jpg', '13_thb.jpg', 'pexels'),
(32, '6_1684083159.jpg', '6_semi_1684083159.jpg', '6_thb_1684083159.jpg', 'ok'),
(33, '3_1684086559.jpg', '3_semi_1684086559.jpg', '3_thb_1684086559.jpg', 'duplex'),
(34, '6_1684086854.jpg', '6_semi_1684086854.jpg', '6_thb_1684086854.jpg', 'super c'),
(35, '3_1684087665.jpg', '3_semi_1684087665.jpg', '3_thb_1684087665.jpg', 'duplex'),
(36, '3_1684087775.jpg', '3_semi_1684087775.jpg', '3_thb_1684087775.jpg', 'duplex'),
(37, '4_1684087973.jpg', '4_semi_1684087973.jpg', '4_thb_1684087973.jpg', 'Super Delux'),
(38, '2_1684100463.jpg', '2_semi_1684100463.jpg', '2_thb_1684100463.jpg', 'suite'),
(39, '17_1684111661.jpg', '17_semi_1684111661.jpg', '17_thb_1684111661.jpg', 'standard room'),
(40, '12.jpg', '12_semi.jpg', '12_thb.jpg', 'king style'),
(41, '11.jpg', '11_semi.jpg', '11_thb.jpg', 'superior shit'),
(42, '7_1684112967.jpg', '7_semi_1684112967.jpg', '7_thb_1684112967.jpg', 'double duplex'),
(43, '14.jpg', '14_semi.jpg', '14_thb_1684154808.jpg', 'test'),
(44, '15_1684158153.jpg', '15_semi_1684158153.jpg', '15_thb_1684158153.jpg', 'test 2'),
(45, '14_1684173784.jpg', '14_semi_1684173784.jpg', '14_thb_1684173784.jpg', 'test 3'),
(46, '1_1684176242.jpg', '1_semi_1684176242.jpg', '1_thb_1684176242.jpg', 'test 4'),
(47, '1_1684720056.jpg', '1_semi_1684720056.jpg', '1_thb_1684720056.jpg', 'xxxxxx'),
(48, '4_1684722427.jpg', '4_semi_1684722427.jpg', '4_thb_1684722427.jpg', 'super comfort'),
(49, '4_1684722645.jpg', '2_semi_1684722645.jpg', '4_thb_1684722645.jpg', 'super comfort'),
(50, '4_1684722695.jpg', '4_semi_1684722695.jpg', '4_thb_1684722695.jpg', 'super comfort'),
(51, '10.jpeg', '10_semi.jpg', '10_thb.jpg', 'super comfort'),
(52, '16.jpg', '16_semi.jpg', '16_thb.jpg', 'delux 2'),
(53, '13_1684957467.jpg', '13_semi_1684957467.jpg', '13_thb_1684957467.jpg', 'kalu'),
(54, '1_1686523565.jpg', '1_semi_1686523565.jpg', '1_thb_1686523565.jpg', 'test 2'),
(55, '9_1686530346.jpg', '9_semi_1686530346.jpg', '9_thb_1686530346.jpg', 'test'),
(56, '9_1686531076.jpg', '9_semi_1686531076.jpg', '9_thb_1686531076.jpg', 'test'),
(57, '9_1686531171.jpg', '9_semi_1686531171.jpg', '9_thb_1686531171.jpg', 'test'),
(58, '9_1686531288.jpg', '9_semi_1686531288.jpg', '9_thb_1686531288.jpg', 'test'),
(59, '9_1686531944.jpg', '9_semi_1686531944.jpg', '9_thb_1686531944.jpg', 'test'),
(60, '9_1686532047.jpg', '9_semi_1686532047.jpg', '9_thb_1686532047.jpg', 'test'),
(61, '9_1686532172.jpg', '9_semi_1686532172.jpg', '9_thb_1686532172.jpg', 'test'),
(62, '5_1686532245.jpg', '5_semi_1686532245.jpg', '5_thb_1686532245.jpg', 'test'),
(63, '5_1686532690.jpg', '5_semi_1686532690.jpg', '5_thb_1686532690.jpg', 'test'),
(64, '5_1686533064.jpg', '5_semi_1686533064.jpg', '5_thb_1686533064.jpg', 'test'),
(65, '5_1686533354.jpg', '5_semi_1686533354.jpg', '5_thb_1686533354.jpg', 'test'),
(66, '5_1686533509.jpg', '5_semi_1686533509.jpg', '5_thb_1686533509.jpg', 'test'),
(67, '9_1686565767.jpg', '9_semi_1686565767.jpg', '9_thb_1686565767.jpg', 'test'),
(68, '9_1686566150.jpg', '9_semi_1686566150.jpg', '9_thb_1686566150.jpg', 'test'),
(69, '5_1686567280.jpg', '5_semi_1686567280.jpg', '5_thb_1686567280.jpg', 'test'),
(70, '5_1686567533.jpg', '5_semi_1686567533.jpg', '5_thb_1686567533.jpg', 'test'),
(71, '5_1686567667.jpg', '5_semi_1686567667.jpg', '5_thb_1686567667.jpg', 'test'),
(72, '1_1686567930.jpg', '1_semi_1686567930.jpg', '1_thb_1686567930.jpg', 'test'),
(73, '9_1686571041.jpg', '9_semi_1686571041.jpg', '9_thb_1686571041.jpg', 'test'),
(74, '13_1686577938.jpg', '13_semi_1686577938.jpg', '13_thb_1686577938.jpg', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--
-- Creation: Jul 16, 2023 at 12:27 AM
--

CREATE TABLE `managers` (
  `uid` int(20) UNSIGNED NOT NULL,
  `uname` varchar(30) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `upass` varchar(255) NOT NULL,
  `uemail` varchar(50) NOT NULL,
  `age` tinyint(3) UNSIGNED NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `start_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_level` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `managers`:
--

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`uid`, `uname`, `first_name`, `last_name`, `upass`, `uemail`, `age`, `updated`, `start_date`, `user_level`) VALUES
(15, 'mabo', 'mabo mweshi', '', '$2y$10$9Mheqxiz.D/uu6sv27J7wegcluGBYG3C750hfsvU8dd6.8oE9RSL2', 'mabomweshi@gmail.com', 0, '2023-05-21 14:07:30', '2023-05-21 14:09:20', 0),
(65, 'kavdee', 'kalvin', 'Drax', '$2y$10$YixM2byPXvhztfOFik/sROYrR9rLJXbzGoZnq5.GQddi27UkI6Lbm', 'kalvdee@gmail.com', 28, '2023-07-16 00:35:34', '2023-05-29 17:06:20', 1),
(66, 'tomjerry', 'Thomas', 'Kat', '$2y$10$XuLSvXhrC86PrRZZrhCCv.SB/DkPkwMW0E64/c0G7bUw47hmYpm9q', 'tomkat@gmail.com', 28, '2023-07-01 19:56:12', '2023-05-29 18:32:57', 0),
(67, 'tomjery', 'Thomas', 'Jerry', '$2y$10$RlNFiH06JuUBi9G1afxOzOyj.bR/rfCq7danSPgDlFugFKKdUimQK', 'tom@gmail.com', 28, '2023-07-16 00:35:34', '2023-05-29 18:33:45', 1),
(68, 'mweshi', 'samuel', 'mweshi', '$2y$10$Tybwy01Gb5HIX1TWSprw.eo02ezP/jAdLstGQLx61BcMGFq.g7c02', 'samm@gmail.com', 27, '2023-07-07 20:18:52', '2023-06-11 22:42:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--
-- Creation: May 30, 2023 at 02:25 AM
--

CREATE TABLE `room` (
  `room_id` int(200) NOT NULL,
  `room_cat_id` int(10) UNSIGNED DEFAULT NULL,
  `room_cat` text NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `name` text NOT NULL,
  `phone` int(100) NOT NULL,
  `book` text NOT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `room`:
--   `room_cat_id`
--       `room_category` -> `room_cat_id`
--

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_cat_id`, `room_cat`, `checkin`, `checkout`, `name`, `phone`, `book`, `added`, `updated`) VALUES
(23, NULL, 'Family', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 00:56:01', '2023-05-10 00:56:39'),
(24, NULL, 'Family', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 00:56:01', '2023-05-10 00:56:39'),
(25, NULL, 'Family', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 00:56:01', '2023-05-10 00:56:39'),
(26, NULL, 'Family', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 00:56:01', '2023-05-10 00:56:39'),
(27, NULL, 'Family', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 00:56:01', '2023-05-10 00:56:39'),
(39, NULL, 'delux 2', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 00:56:01', '2023-05-10 00:56:39'),
(284, 2, 'Super Comfort', '2023-05-23', '2023-05-24', 'kalumba mweshi', 2147483600, 'true', '2023-05-10 01:34:51', '2023-05-26 02:00:57'),
(285, 2, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:34:51', '2023-05-24 19:19:20'),
(286, 2, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:34:51', '2023-05-24 19:20:31'),
(287, 2, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:34:51', '2023-05-24 19:21:03'),
(288, 2, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:34:51', '2023-05-24 19:21:27'),
(296, 3, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:36:23', '2023-05-24 19:21:58'),
(297, 3, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:36:23', '2023-05-24 19:22:14'),
(298, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:36:23', '2023-05-10 01:36:23'),
(299, 4, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:36:23', '2023-05-14 19:20:44'),
(300, 4, 'Suite', '2023-05-26', '2023-05-27', 'thandi lungu', 8888888, 'true', '2023-05-11 19:21:51', '2023-05-26 01:57:02'),
(301, 4, 'Suite', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-11 19:21:51', '2023-05-14 19:19:54'),
(302, NULL, 'Suite', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-11 19:21:51', '2023-05-11 19:21:51'),
(303, 8, 'standard', '2023-05-26', '2023-05-30', 'thandiwe lungu', 214748399, 'true', '2023-05-12 18:01:20', '2023-05-26 01:58:42'),
(304, 8, 'standard', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-12 18:01:20', '2023-05-24 19:23:06'),
(305, NULL, 'standard', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-12 18:01:21', '2023-05-12 18:01:21'),
(306, 10, 'superior', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-12 18:04:00', '2023-05-24 19:23:28'),
(307, 10, 'superior', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-12 18:04:01', '2023-05-24 19:23:43'),
(377, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:04:02', '2023-05-14 14:04:02'),
(378, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:10:51', '2023-05-14 14:10:51'),
(379, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:16:06', '2023-05-14 14:16:06'),
(380, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:16:06', '2023-05-14 14:16:06'),
(381, NULL, 'delux 2', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:22:23', '2023-05-14 14:22:23'),
(382, NULL, 'delux 2', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:22:23', '2023-05-14 14:22:23'),
(383, NULL, 'delux 2', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:26:48', '2023-05-14 14:26:48'),
(384, NULL, 'delux 2', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:34:23', '2023-05-14 14:34:23'),
(385, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:45:22', '2023-05-14 14:45:22'),
(386, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:45:22', '2023-05-14 14:45:22'),
(387, NULL, 'delux 2', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:46:50', '2023-05-14 14:46:50'),
(388, NULL, 'delux 2', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:46:50', '2023-05-14 14:46:50'),
(389, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:54:49', '2023-05-14 14:54:49'),
(390, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:54:49', '2023-05-14 14:54:49'),
(391, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:56:01', '2023-05-14 14:56:01'),
(392, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 14:56:59', '2023-05-14 14:56:59'),
(475, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 16:29:32', '2023-05-14 16:29:32'),
(476, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 16:30:12', '2023-05-14 16:30:12'),
(477, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 16:32:19', '2023-05-14 16:32:19'),
(478, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 16:35:11', '2023-05-14 16:35:11'),
(479, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 16:35:54', '2023-05-14 16:35:54'),
(480, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 16:39:47', '2023-05-14 16:39:47'),
(481, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 16:45:14', '2023-05-14 16:45:14'),
(482, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 16:51:21', '2023-05-14 16:51:21'),
(483, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 16:51:40', '2023-05-14 16:51:40'),
(484, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 16:52:39', '2023-05-14 16:52:39'),
(485, NULL, 'delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 16:55:50', '2023-05-14 16:55:50'),
(489, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:50:50', '2023-05-14 17:50:50'),
(490, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:50:50', '2023-05-14 17:50:50'),
(491, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:50:50', '2023-05-14 17:50:50'),
(492, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:50:50', '2023-05-14 17:50:50'),
(493, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:50:50', '2023-05-14 17:50:50'),
(494, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:52:38', '2023-05-14 17:52:38'),
(495, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:52:38', '2023-05-14 17:52:38'),
(496, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:52:38', '2023-05-14 17:52:38'),
(497, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:52:38', '2023-05-14 17:52:38'),
(498, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:52:38', '2023-05-14 17:52:38'),
(502, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:14', '2023-05-14 17:54:14'),
(503, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:14', '2023-05-14 17:54:14'),
(504, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:14', '2023-05-14 17:54:14'),
(505, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:14', '2023-05-14 17:54:14'),
(506, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:15', '2023-05-14 17:54:15'),
(507, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:47', '2023-05-14 17:54:47'),
(508, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:47', '2023-05-14 17:54:47'),
(509, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:47', '2023-05-14 17:54:47'),
(510, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:47', '2023-05-14 17:54:47'),
(523, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:12:53', '2023-05-14 18:12:53'),
(524, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:12:53', '2023-05-14 18:12:53'),
(525, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:12:53', '2023-05-14 18:12:53'),
(526, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:12:53', '2023-05-14 18:12:53'),
(527, NULL, 'Suite', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 21:41:04', '2023-05-14 21:41:04'),
(528, NULL, 'Suite', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 21:41:04', '2023-05-14 21:41:04'),
(529, NULL, 'Suite', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 21:41:04', '2023-05-14 21:41:04'),
(530, NULL, 'standard', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-15 00:47:41', '2023-05-15 00:47:41'),
(531, NULL, 'standard', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-15 00:47:41', '2023-05-15 00:47:41'),
(532, NULL, 'standard', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-15 00:47:41', '2023-05-15 00:47:41'),
(535, NULL, 'superior', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-15 01:06:05', '2023-05-15 01:06:05'),
(536, NULL, 'superior', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-15 01:06:05', '2023-05-15 01:06:05'),
(538, NULL, 'Double Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-15 01:09:27', '2023-05-15 01:09:27'),
(548, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:41:08', '2023-05-22 01:41:08'),
(549, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:41:08', '2023-05-22 01:41:08'),
(550, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:41:08', '2023-05-22 01:41:08'),
(551, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:41:08', '2023-05-22 01:41:08'),
(552, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:41:08', '2023-05-22 01:41:08'),
(553, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:42:34', '2023-05-22 01:42:34'),
(554, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:42:34', '2023-05-22 01:42:34'),
(555, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:42:34', '2023-05-22 01:42:34'),
(556, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:42:35', '2023-05-22 01:42:35'),
(557, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:42:35', '2023-05-22 01:42:35'),
(558, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:44:17', '2023-05-22 01:44:17'),
(559, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:44:17', '2023-05-22 01:44:17'),
(560, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:44:17', '2023-05-22 01:44:17'),
(561, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:44:17', '2023-05-22 01:44:17'),
(562, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:44:17', '2023-05-22 01:44:17'),
(563, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:45:41', '2023-05-22 01:45:41'),
(564, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:45:41', '2023-05-22 01:45:41'),
(565, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:45:41', '2023-05-22 01:45:41'),
(566, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:45:41', '2023-05-22 01:45:41'),
(567, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:45:41', '2023-05-22 01:45:41'),
(569, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:57:06', '2023-05-22 01:57:06'),
(570, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:57:06', '2023-05-22 01:57:06'),
(571, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:57:06', '2023-05-22 01:57:06'),
(572, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:57:06', '2023-05-22 01:57:06'),
(573, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:57:06', '2023-05-22 01:57:06'),
(574, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:59:15', '2023-05-22 01:59:15'),
(575, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:59:15', '2023-05-22 01:59:15'),
(576, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:59:15', '2023-05-22 01:59:15'),
(577, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:59:15', '2023-05-22 01:59:15'),
(578, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 01:59:15', '2023-05-22 01:59:15'),
(579, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 02:03:08', '2023-05-22 02:03:08'),
(580, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 02:03:08', '2023-05-22 02:03:08'),
(581, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 02:03:08', '2023-05-22 02:03:08'),
(582, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 02:03:08', '2023-05-22 02:03:08'),
(583, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 02:03:08', '2023-05-22 02:03:08'),
(584, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 02:14:41', '2023-05-22 02:14:41'),
(585, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 02:14:41', '2023-05-22 02:14:41'),
(586, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 02:14:41', '2023-05-22 02:14:41'),
(587, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 02:14:41', '2023-05-22 02:14:41'),
(588, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 02:14:41', '2023-05-22 02:14:41'),
(589, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 02:27:07', '2023-05-22 02:27:07'),
(590, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-22 02:27:07', '2023-05-22 02:27:07'),
(611, 115, 'kalu', '2023-05-23', '2023-05-25', 'kalu kavyo', 2147483647, 'true', '2023-05-24 19:44:27', '2023-05-26 02:01:31'),
(649, 120, 'test  44', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-07-05 19:15:11', '2023-07-05 19:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `room_category`
--
-- Creation: May 30, 2023 at 02:25 AM
--

CREATE TABLE `room_category` (
  `room_cat_id` int(10) UNSIGNED NOT NULL,
  `image_id` int(10) UNSIGNED DEFAULT NULL,
  `roomname` text NOT NULL,
  `room_qnty` int(11) NOT NULL,
  `available` int(11) NOT NULL,
  `booked` int(11) NOT NULL,
  `no_bed` int(11) NOT NULL,
  `bedtype` text NOT NULL,
  `facility` text NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `room_category`:
--   `image_id`
--       `images` -> `image_id`
--

--
-- Dumping data for table `room_category`
--

INSERT INTO `room_category` (`room_cat_id`, `image_id`, `roomname`, `room_qnty`, `available`, `booked`, `no_bed`, `bedtype`, `facility`, `price`, `updated`, `added`) VALUES
(2, 51, 'Super Comfort', 5, 0, 0, 1, 'double', 'AC, TV, WIFI', '450.00', '2023-05-22 12:58:21', '2023-05-21 16:44:17'),
(3, 37, 'Super Delux', 4, 0, 0, 2, 'double', 'tv, air conditioner, wi-fi,  jacuzzi, shampoo', '450.00', '2023-05-21 16:43:28', '2023-05-21 16:44:17'),
(4, 38, 'Suite', 3, 0, 0, 1, 'double', 'all shit!', '800.00', '2023-05-21 16:43:28', '2023-05-21 16:44:17'),
(8, 39, 'standard', 3, 0, 0, 1, 'single', 'standard shit', '144.00', '2023-05-21 16:43:28', '2023-05-21 16:44:17'),
(10, 41, 'superior', 2, 0, 0, 1, 'double', 'superior style', '2000.00', '2023-05-21 16:43:28', '2023-05-21 16:44:17'),
(106, 42, 'Double Duplex', 2, 0, 0, 2, 'double', 'all', '420.00', '2023-05-21 16:43:28', '2023-05-21 16:44:17'),
(107, 52, 'delux 2', 2, 0, 0, 1, 'double', 'cool', '150.00', '2023-05-23 19:20:02', '2023-05-21 16:44:17'),
(108, 24, 'delux 2', 1, 1, 0, 1, 'single', 'fff', '132.00', '2023-05-21 16:43:28', '2023-05-21 16:44:17'),
(114, 74, 'test', 1, 1, 0, 1, 'single', 'testing', '1.00', '2023-06-12 13:52:18', '2023-05-22 01:47:36'),
(115, 53, 'kalu', 2, 2, 0, 1, 'double', 'kalu style', '500.00', '2023-05-24 19:44:27', '2023-05-24 19:44:27'),
(120, NULL, 'test  44', 1, 1, 0, 1, 'single', 'jkj', '2.00', '2023-07-05 19:15:11', '2023-07-05 19:15:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uname` (`uname`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `room_cat_id` (`room_cat_id`);

--
-- Indexes for table `room_category`
--
ALTER TABLE `room_category`
  ADD PRIMARY KEY (`room_cat_id`),
  ADD KEY `room_category_ibfk_1` (`image_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `uid` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=652;

--
-- AUTO_INCREMENT for table `room_category`
--
ALTER TABLE `room_category`
  MODIFY `room_cat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`room_cat_id`) REFERENCES `room_category` (`room_cat_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `room_category`
--
ALTER TABLE `room_category`
  ADD CONSTRAINT `room_category_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
