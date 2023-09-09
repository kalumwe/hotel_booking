-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 17, 2023 at 02:03 AM
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

CREATE TABLE `images` (
  `image_id` int(10) UNSIGNED NOT NULL,
  `full_pic` varchar(30) CHARACTER SET latin1 NOT NULL,
  `semi_pic` varchar(30) NOT NULL,
  `thumb` varchar(30) NOT NULL,
  `caption` varchar(150) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(46, '1_1684176242.jpg', '1_semi_1684176242.jpg', '1_thb_1684176242.jpg', 'test 4');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `uid` int(20) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `upass` char(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `uemail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`uid`, `uname`, `upass`, `fullname`, `uemail`) VALUES
(1, 'mamun', '1234', 'Abdullah Al Mamun', 'mamunwitchbug@gmail.com'),
(3, 'jinat', 'jinat', 'Jinat Afroj', 'afrojjinat@gmail.com'),
(6, 'admin', '1234', 'admin', 'admin@admin.com'),
(14, 'kalu3', '$2y$10$6FXzhzCqiNbAVqERzVil2u.g7h7EvoOZWEbzFz8C6bnOdpq4gSERe', 'kalu mwe', 'kalu3@gmail.com'),
(15, 'mabo', '$2y$10$9Mheqxiz.D/uu6sv27J7wegcluGBYG3C750hfsvU8dd6.8oE9RSL2', 'mabo mweshi', 'mabomweshi@gmail.com'),
(62, 'sub', '$2y$10$p1n4Qgjtc/SUp23mgcqObeF/HFmKSoP63oaqMD.O4kxqqWocDOMOW', 'kalu mwe', 'sub@gmail.com'),
(63, 'subzero', '$2y$10$x.exeBx77iyTsGfFkhIVWeH4pXanHpo8rkGvrtVHsDi2V8EQ7psbO', 'kalu mwe', 'subzero@gmail.com'),
(64, 'subzro', '$2y$10$aFelaq8Tx1ejqbv/AAJTOO5pje.4E8dQBpPi6LeWV3vyGQrHkXVWe', 'kalu mwe', 'subzro@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `room`
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
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_cat_id`, `room_cat`, `checkin`, `checkout`, `name`, `phone`, `book`, `added`, `updated`) VALUES
(23, NULL, 'Family', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 00:56:01', '2023-05-10 00:56:39'),
(24, NULL, 'Family', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 00:56:01', '2023-05-10 00:56:39'),
(25, NULL, 'Family', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 00:56:01', '2023-05-10 00:56:39'),
(26, NULL, 'Family', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 00:56:01', '2023-05-10 00:56:39'),
(27, NULL, 'Family', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 00:56:01', '2023-05-10 00:56:39'),
(39, NULL, 'delux 2', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 00:56:01', '2023-05-10 00:56:39'),
(284, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:34:51', '2023-05-10 01:34:51'),
(285, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:34:51', '2023-05-10 01:34:51'),
(286, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:34:51', '2023-05-10 01:34:51'),
(287, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:34:51', '2023-05-10 01:34:51'),
(288, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:34:51', '2023-05-10 01:34:51'),
(289, 1, 'Duplex', '2023-05-14', '2023-05-15', 'kalu kav', 2147483647, 'true', '2023-05-10 01:35:28', '2023-05-14 19:07:54'),
(290, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:35:28', '2023-05-10 01:35:28'),
(291, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:35:28', '2023-05-10 01:35:28'),
(296, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:36:23', '2023-05-10 01:36:23'),
(297, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:36:23', '2023-05-10 01:36:23'),
(298, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:36:23', '2023-05-10 01:36:23'),
(299, 4, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-10 01:36:23', '2023-05-14 19:20:44'),
(300, 4, 'Suite', '2023-05-14', '2023-05-15', 'thandi lungu', 2147483647, 'true', '2023-05-11 19:21:51', '2023-05-14 19:21:12'),
(301, 4, 'Suite', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-11 19:21:51', '2023-05-14 19:19:54'),
(302, NULL, 'Suite', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-11 19:21:51', '2023-05-11 19:21:51'),
(303, NULL, 'standard', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-12 18:01:20', '2023-05-12 18:01:20'),
(304, NULL, 'standard', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-12 18:01:20', '2023-05-12 18:01:20'),
(305, NULL, 'standard', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-12 18:01:21', '2023-05-12 18:01:21'),
(306, NULL, 'superior', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-12 18:04:00', '2023-05-12 18:04:00'),
(307, NULL, 'superior', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-12 18:04:01', '2023-05-12 18:04:01'),
(309, NULL, 'king', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-12 20:32:34', '2023-05-12 20:32:34'),
(310, NULL, 'king', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-12 20:32:34', '2023-05-12 20:32:34'),
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
(435, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 15:46:06', '2023-05-14 15:46:06'),
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
(486, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:49:19', '2023-05-14 17:49:19'),
(487, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:49:19', '2023-05-14 17:49:19'),
(488, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:49:19', '2023-05-14 17:49:19'),
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
(499, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:52:49', '2023-05-14 17:52:49'),
(500, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:52:49', '2023-05-14 17:52:49'),
(501, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:52:49', '2023-05-14 17:52:49'),
(502, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:14', '2023-05-14 17:54:14'),
(503, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:14', '2023-05-14 17:54:14'),
(504, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:14', '2023-05-14 17:54:14'),
(505, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:14', '2023-05-14 17:54:14'),
(506, NULL, 'Super Comfort', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:15', '2023-05-14 17:54:15'),
(507, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:47', '2023-05-14 17:54:47'),
(508, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:47', '2023-05-14 17:54:47'),
(509, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:47', '2023-05-14 17:54:47'),
(510, NULL, 'Super Delux', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 17:54:47', '2023-05-14 17:54:47'),
(511, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:07:45', '2023-05-14 18:07:45'),
(512, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:07:45', '2023-05-14 18:07:45'),
(513, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:07:45', '2023-05-14 18:07:45'),
(514, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:08:07', '2023-05-14 18:08:07'),
(515, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:08:08', '2023-05-14 18:08:08'),
(516, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:08:08', '2023-05-14 18:08:08'),
(517, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:08:46', '2023-05-14 18:08:46'),
(518, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:08:46', '2023-05-14 18:08:46'),
(519, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:08:46', '2023-05-14 18:08:46'),
(520, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:09:35', '2023-05-14 18:09:35'),
(521, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:09:35', '2023-05-14 18:09:35'),
(522, NULL, 'Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-14 18:09:35', '2023-05-14 18:09:35'),
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
(533, NULL, 'king', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-15 00:59:01', '2023-05-15 00:59:01'),
(534, NULL, 'king', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-15 00:59:01', '2023-05-15 00:59:01'),
(535, NULL, 'superior', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-15 01:06:05', '2023-05-15 01:06:05'),
(536, NULL, 'superior', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-15 01:06:05', '2023-05-15 01:06:05'),
(537, NULL, 'Double Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-15 01:09:27', '2023-05-15 01:09:27'),
(538, NULL, 'Double Duplex', '0000-00-00', '0000-00-00', '', 0, 'false', '2023-05-15 01:09:27', '2023-05-15 01:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `room_category`
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
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_category`
--

INSERT INTO `room_category` (`room_cat_id`, `image_id`, `roomname`, `room_qnty`, `available`, `booked`, `no_bed`, `bedtype`, `facility`, `price`) VALUES
(1, 36, 'Duplex', 3, 0, 0, 1, 'single', 'AC, TV, Wifi,', '300.00'),
(2, 34, 'Super Comfort', 5, 0, 0, 1, 'double', 'AC, TV, WIFI', '300.00'),
(3, 37, 'Super Delux', 4, 0, 0, 2, 'double', 'tv, air conditioner, wi-fi,  jacuzzi, shampoo', '450.00'),
(4, 38, 'Suite', 3, 0, 0, 1, 'double', 'all shit!', '800.00'),
(8, 39, 'standard', 3, 0, 0, 1, 'single', 'standard shit', '144.00'),
(10, 41, 'superior', 2, 0, 0, 1, 'double', 'superior style', '2000.00'),
(47, 40, 'king', 2, 0, 0, 1, 'double', 'king shit', '1000.00'),
(106, 42, 'Double Duplex', 2, 0, 0, 2, 'double', 'all', '420.00'),
(107, NULL, 'delux', 1, 0, 0, 1, 'single', 'nmn', '150.00'),
(108, 24, 'delux 2', 1, 1, 0, 1, 'single', 'fff', '132.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`uid`);

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
  MODIFY `image_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `uid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=547;

--
-- AUTO_INCREMENT for table `room_category`
--
ALTER TABLE `room_category`
  MODIFY `room_cat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`room_cat_id`) REFERENCES `room_category` (`room_cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_category`
--
ALTER TABLE `room_category`
  ADD CONSTRAINT `room_category_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
