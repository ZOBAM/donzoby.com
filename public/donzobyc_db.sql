-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2024 at 06:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donzobyc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:5:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";s:1:\"j\";s:11:\"description\";}s:11:\"permissions\";a:10:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:10:\"view users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:10:\"edit users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:12:\"delete users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"create posts\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:10:\"edit posts\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:12:\"delete posts\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:10:\"view posts\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:13:\"view comments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:13:\"edit comments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"delete comments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:1:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super admin\";s:1:\"c\";s:3:\"web\";s:1:\"j\";s:70:\"This user has the permission to carry out all actions on the platform.\";}}}', 1722161634);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('approved','unapproved') NOT NULL DEFAULT 'unapproved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `content`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 16, 'my own comment is working and approving it is on the works! Hope I have not broken the editing content part.', NULL, 'approved', '2024-07-06 06:47:53', '2024-07-16 19:29:32');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `phone_code` varchar(255) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `long_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `slug`, `description`, `long_description`, `created_at`, `updated_at`) VALUES
(1, 'Graphics', 'graphics', 'Learn how to create vector graphics and work with bitmap images on the computer. Everyday graphics skills is covered here. Design logos, crop and resize images etc. Gimp, Photoshop and CorelDraw are covered here.', '<p>You need the basic skills in graphics design even if you don\'t intend to become a professional graphics designer. This is to enable you to transform your beautiful ideas into something that won\'t hurt the eyes to behold.</p>\n<p>&nbsp;</p>\n<p>There have been some intelligent program logics, well-written and implemented back-end but due to very poor UI design are not properly valued for the amount of good work put in at the back end.</p>\n<p>&nbsp;</p>\n<p>So, knowing the basic concepts of graphic design such as spacing, color contrast, alignment and hierarchy will go a long way to help you create appealing software or products.</p>', '2024-04-07 06:56:37', '2024-04-22 08:33:52'),
(2, 'Web Front-end', 'front-end', 'Start learning how to design websites. Our course covers subjects like HTML, CSS, Bootstrap etc. and scripting languages such as JavaScript used for layout, formatting and animating web pages.', '<p>Our front-end course/tutorials are focused on those programming/scripting languages (e.g html, css etc) mainly used on the client side (browsers) to layout, format and animate the front end of web applications.</p>', '2024-04-07 06:57:23', '2024-04-27 03:57:21'),
(3, 'Web Back-end', 'back-end', 'Start learning server side programming for websites and manage website data using databases. Subjects covered here include: PHP, MySQL, SQL, Laravel etc.', '<p>If you want to build something beyond static web pages, if you want to build website that can receive user\'s input and serve a tailored content, then you need to learn how to talk to the server. Start learning server side programming for websites and manage website data using databases and much more.</p>', '2024-04-07 06:58:02', '2024-04-27 03:58:25'),
(4, 'Mobile App Development', 'mobile-app-dev', 'Learn the basics of building mobile applications on the Android platform and then advance to professional mobile app developer. Simple and easy Kotlin and Java tutorial for Android.', NULL, '2024-04-07 06:59:08', '2024-04-12 07:01:16'),
(5, 'Windows App Development', 'windows-dev', 'Learn how to build windows applications easily with care given to best practices. Start programming in C Sharp (C#) and Java by following our well written windows development course.', NULL, '2024-04-07 06:59:46', '2024-04-12 07:01:33'),
(6, 'Microsoft Office', 'ms-office', 'Easy Microsoft Office tutorials that will help you accomplish important tasks easily at the office. Write and format letters, MOUs, make PowerPoint presentations, analyze results with Excel spreadsheet and manage data with Access.', NULL, '2024-04-07 07:01:48', '2024-04-12 07:01:59'),
(7, 'Office Operations', 'office-operations', 'We want to make your life in the office lot easier with clearly illustrated tutorials on carrying out office tasks such as paper work and machine operations.', NULL, '2024-04-07 07:02:37', '2024-04-12 07:02:07'),
(8, 'Internet Usage', 'internet-usage', 'Donzoby gives you some common tips and tricks for making the most of the internet without wasting the whole day online.', NULL, '2024-04-07 07:03:09', '2024-04-12 07:02:26'),
(9, 'Mobile Phone Usage', 'mobile-usage', 'Donzoby mobile guide gives necessary tips to help you utilize the great features of your phones without losing a hair', NULL, '2024-04-07 07:03:41', '2024-04-12 07:02:36'),
(10, 'Consolidated Data Plans in Nigeria', 'data-plans', 'No need visiting multiple sites to check out data plans from various networks, Donzoby.com has them in one place!', NULL, '2024-04-07 07:04:14', '2024-04-07 07:04:14');

-- --------------------------------------------------------

--
-- Table structure for table `data_plans`
--

CREATE TABLE `data_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `volume` double NOT NULL,
  `price` int(11) NOT NULL,
  `bonus_all` int(11) DEFAULT 0,
  `bonus_new_sim` int(11) DEFAULT 0,
  `validity` int(11) NOT NULL,
  `use_period` varchar(255) NOT NULL,
  `how_to_sub` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `hits` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `creator` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_plans`
--

INSERT INTO `data_plans` (`id`, `provider`, `title`, `volume`, `price`, `bonus_all`, `bonus_new_sim`, `validity`, `use_period`, `how_to_sub`, `description`, `hits`, `creator`, `created_at`, `updated_at`) VALUES
(1, 'glo', 'Glo 45mb for ₦50 data plan', 45, 50, 5, 5, 24, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu.', 'The data bonus is usable from 12:00am - 5:00am', 335, 1, '2020-04-05 18:52:29', '2020-08-10 22:52:14'),
(2, 'glo', 'Glo 115mb for N100 data plan', 115, 100, 35, 80, 24, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu.', 'The data bonus of 35MB is usable from 12AM to 5AM for both old and new SIM. New user has extra 45M to enjoy at anytime.', 373, 1, '2020-04-05 18:57:02', '2020-08-10 22:29:46'),
(3, 'glo', 'Glo 240mb for ₦200 data plan', 240, 200, 110, 260, 48, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu.', 'The bonus data is usable from 12:00 - 5:00am. For new SIM, 160MB of the bonus can be used at anytime.', 370, 1, '2020-04-05 19:06:54', '2020-08-11 07:05:12'),
(4, 'glo', 'Glo 800mb data plan', 800, 500, 550, 1393, 96, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu.', 'The bonus data is usable from 12:00 - 5:00am. For new SIM, 838.4MB of the bonus can be used at anytime.', 793, 1, '2020-04-05 19:14:08', '2020-08-11 07:20:13'),
(5, 'glo', 'Glo 1.9GB data plan', 1945.6, 1000, 1024, 2355, 720, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu.', 'The bonus data is usable from 12:00 - 5:00am and <b>is valid for 2days</b>. For new SIM, 1.3GB of the bonus can be used at anytime.', 377, 1, '2020-04-05 19:19:51', '2020-08-11 07:32:42'),
(6, 'glo', 'Glo 3.5GB data plan', 3584, 1500, 600, 3328, 720, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu.', 'The bonus data is usable from 12:00 - 5:00am. For new SIM, 2.7GB of the bonus can be used at anytime.', 412, 1, '2020-04-05 19:25:17', '2020-08-11 07:41:54'),
(7, 'glo', 'Glo 5.2GB data plan', 5324.8, 2000, 600, 4403, 720, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu.', 'The bonus data is usable from 12:00 - 5:00am. For new SIM, 3.8GB of the bonus can be used at anytime.', 397, 1, '2020-04-06 17:25:37', '2020-08-11 07:52:37'),
(8, 'glo', 'Glo 6.8GB data plan', 6963.2, 2500, 900, 6093, 720, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu', 'The bonus data is usable from 12:00 - 5:00am. For new SIM, 5.2GB of the bonus can be used at anytime.', 395, 1, '2020-04-07 17:22:04', '2020-08-11 07:59:47'),
(9, 'glo', 'Glo 9GB data plan', 9216, 3000, 1024, 8192, 720, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu', 'The bonus data is usable from 12:00 - 5:00am. For new SIM, 7.25GB of the bonus can be used at anytime.', 362, 1, '2020-04-07 17:24:19', '2020-08-11 08:02:17'),
(10, 'glo', 'Glo 12.25GB for N4000 data plan', 12544, 4000, 1024, 6912, 720, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu', 'The bonus data is usable from 12:00 - 5:00am. For new SIM, 6GB of the bonus can be used at anytime.', 352, 1, '2020-04-07 17:45:46', '2020-08-11 08:09:00'),
(12, 'glo', 'Glo 27.5GB for N8,000 Data Plan', 28160, 8000, 2048, 9728, 720, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu', 'The bonus data is usable from 12:00 - 5:00am. For new SIM, 8.5GB of the bonus can be used at anytime.', 340, 1, '2020-04-07 17:51:45', '2020-08-11 08:32:47'),
(13, 'mtn', 'MTN 2.5GB Data Plan', 2560, 500, NULL, NULL, 48, 'anytime', 'Dial *131*1# on your Mtn line and follow the instructions.', NULL, 747, 25, '2020-04-07 18:00:36', '2020-04-08 10:18:58'),
(14, 'glo', 'Glo 46GB for N10,000 data plan', 47104, 10000, 4096, 4096, 720, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu', 'The data bonus is usable from 12:00am - 5:00am', 350, 1, '2020-04-07 18:03:07', '2020-08-11 08:37:21'),
(15, 'glo', 'Glo 86GB for N15,000 data plan', 88064, 15000, 7168, 7168, 720, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu', 'The data bonus is usable from 12:00am - 5:00am', 377, 1, '2020-04-07 18:05:09', '2020-08-11 08:38:08'),
(16, 'glo', 'Glo 109GB for N18,000 data plan', 111616, 18000, 10240, 10240, 720, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu', 'The data bonus is usable from 12:00am - 5:00am', 330, 1, '2020-04-07 18:06:32', '2020-08-11 08:38:52'),
(17, 'glo', 'Glo 126GB for N20,000 data plan', 129024, 20000, 12288, 12288, 720, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu', 'The data bonus is usable from 12:00am - 5:00am', 363, 1, '2020-04-07 18:08:46', '2020-08-11 08:39:27'),
(18, 'mtn', 'MTN 40MB Data Plan', 40, 50, NULL, NULL, 24, 'anytime', 'Text \"114\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 382, 1, '2020-04-08 09:49:16', '2020-08-11 08:45:52'),
(20, 'mtn', 'MTN 100MB Data Plan', 100, 100, NULL, NULL, 24, 'anytime', 'Text \"104\" to 131 on your Mtn line.', 'You can also dial *131*1# on you Mtn line and follow the instructions.', 368, 1, '2020-04-08 09:53:17', '2020-08-11 08:46:53'),
(21, 'mtn', 'MTN 1GB Data Plan', 1024, 300, NULL, NULL, 24, 'anytime', 'Text \"155\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 400, 25, '2020-04-08 09:55:05', '2020-04-08 18:21:56'),
(22, 'mtn', 'MTN 200MB Data Plan', 200, 200, NULL, NULL, 72, 'anytime', 'Text \"113\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 372, 1, '2020-04-08 09:57:53', '2020-08-11 08:52:34'),
(23, 'mtn', 'MTN 2GB Data Plan', 2048, 500, NULL, NULL, 48, 'anytime', 'Text \"154\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 748, 25, '2020-04-08 09:59:10', '2020-04-08 18:18:41'),
(25, 'mtn', 'MTN 350MB for N300 Data Plan', 350, 300, NULL, NULL, 168, 'anytime', 'Text \"102\" to 131 on your Mtn line,', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 369, 1, '2020-04-08 17:28:25', '2020-08-11 08:57:36'),
(26, 'mtn', 'MTN 1GB Data Plan', 1024, 500, NULL, NULL, 168, 'anytime', 'Text \"142\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 732, 25, '2020-04-08 17:34:39', '2020-04-08 18:15:28'),
(27, 'mtn', 'MTN 1GB for N500 Data Plan', 1024, 500, NULL, NULL, 168, 'anytime', 'Text \"142\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 761, 1, '2020-04-08 17:35:00', '2020-08-11 08:59:03'),
(28, 'mtn', 'MTN 6GB for N1,500 Data Plan', 6144, 1500, NULL, NULL, 168, 'anytime', 'Text \"143\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 361, 1, '2020-04-08 17:36:02', '2020-08-11 08:59:47'),
(29, 'mtn', 'MTN 750MB for N500 Data Plan', 750, 500, NULL, NULL, 336, 'anytime', 'Text \"103\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 682, 1, '2020-04-08 17:38:59', '2020-08-11 09:00:34'),
(30, 'mtn', 'MTN 1.5GB for N1,000 Data Plan', 1536, 1000, NULL, NULL, 720, 'anytime', 'Text \"106\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 389, 1, '2020-04-08 17:42:25', '2020-08-11 09:01:59'),
(32, 'mtn', 'MTN 2GB for N1,200 Data Plan (free night streaming)', 2048, 1200, NULL, NULL, 720, 'anytime', 'Text \"130\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.\n\nThis plan offers free YouTube Night Streaming.', 456, 1, '2020-04-08 17:43:19', '2020-08-11 09:04:32'),
(33, 'mtn', 'MTN 3GB for N1,500 Data Plan', 3072, 1500, NULL, NULL, 720, 'anytime', 'Text \"131\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 377, 1, '2020-04-08 17:44:06', '2020-08-11 09:05:22'),
(34, 'mtn', 'MTN 4.5GB for N2,000 Data Plan', 4608, 2000, NULL, NULL, 720, 'anytime', 'Text \"110\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 362, 1, '2020-04-08 17:45:30', '2020-08-11 09:06:38'),
(35, 'mtn', 'MTN 6GB for N2,500 Data Plan', 6144, 2500, NULL, NULL, 720, 'anytime', 'Text \"147\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 382, 1, '2020-04-08 17:46:24', '2020-08-11 09:07:16'),
(36, 'mtn', 'MTN 8GB for N3,000 Data Plan', 8192, 3000, NULL, NULL, 720, 'anytime', 'Dial *131*1# on your Mtn line and follow the instructions.', NULL, 383, 1, '2020-04-08 17:48:15', '2020-08-11 09:08:09'),
(37, 'mtn', 'MTN 10GB for N3,500 Data Plan', 10240, 3500, NULL, NULL, 720, 'anytime', 'Text *107* to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 351, 1, '2020-04-08 17:51:02', '2020-08-11 09:08:48'),
(38, 'mtn', 'MTN 15GB for N5,000 Data Plan', 15360, 5000, NULL, NULL, 720, 'anytime', 'Text \"116\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 337, 1, '2020-04-08 18:27:35', '2020-08-11 09:09:31'),
(39, 'mtn', 'MTN 20GB for N6,000 Data Plan', 20480, 6000, NULL, NULL, 720, 'anytime', 'Dial *131*1# on your Mtn line and follow the instructions.', NULL, 391, 1, '2020-04-08 18:30:44', '2020-08-11 09:09:53'),
(40, 'mtn', 'MTN 40GB for N10,000 Data Plan', 40960, 10000, NULL, NULL, 720, 'anytime', 'Text \"117\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 349, 1, '2020-04-08 18:33:28', '2020-08-11 09:10:27'),
(41, 'mtn', 'MTN 75GB for N15,000 Data Plan', 76800, 15000, NULL, NULL, 720, 'anytime', 'Text \"150\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 412, 1, '2020-04-08 18:38:08', '2020-08-11 09:11:25'),
(42, 'mtn', 'MTN 110GB for N20,000 Data Plan', 112640, 20000, NULL, NULL, 720, 'anytime', 'Text \"149\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 370, 1, '2020-04-08 18:39:11', '2020-08-11 09:11:55'),
(43, 'mtn', 'MTN 75GB N20,000 (60days) Data Plan', 76800, 20000, NULL, NULL, 1440, 'anytime', 'Text \"118\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 453, 1, '2020-04-08 18:40:54', '2020-08-11 09:14:30'),
(44, 'mtn', 'MTN 120GB for N30,000 Data Plan', 122880, 30000, NULL, NULL, 1440, 'anytime', 'Text \"138\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 369, 1, '2020-04-08 18:42:00', '2020-08-11 09:15:44'),
(45, 'mtn', 'MTN 150GB for N50,000 Data Plan', 153600, 50000, NULL, NULL, 2160, 'anytime', 'Text \"133\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 360, 1, '2020-04-08 18:43:32', '2020-08-11 09:27:30'),
(48, 'mtn', 'MTN 250GB for N75,000 Data Plan', 256000, 75000, NULL, NULL, 2160, 'anytime', 'Text \"134\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 382, 1, '2020-04-08 20:14:30', '2020-08-11 09:26:57'),
(49, 'mtn', 'MTN 400GB Data Plan', 409600, 120000, NULL, NULL, 8760, 'anytime', 'Text \"156\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 367, 25, '2020-04-08 22:15:09', '2020-04-08 22:15:09'),
(50, 'mtn', 'MTN 1000GB Data Plan', 1024000, 250000, NULL, NULL, 8760, 'anytime', 'Text \"136\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 371, 25, '2020-04-08 22:16:17', '2020-04-08 22:16:17'),
(51, 'mtn', 'MTN 2000GB Data Plan', 2048000, 450000, NULL, NULL, 8760, 'anytime', 'Text \"137\" to 131 on your Mtn line.', 'You can also dial *131*1# on your Mtn line and follow the instructions.', 358, 25, '2020-04-08 22:17:20', '2020-04-08 22:17:20'),
(74, 'airtel', 'Airtel 100mb for ₦100 Data Plan', 100, 100, NULL, NULL, 24, 'anytime', 'Dial *141*100# on your Airtel line', 'You can as well dial *141# on your Airtel line and follow the optional menu.\r\nEnjoy super fast browsing usable between 12 am Saturday and 11:59 pm Sunday.', 364, 1, '2020-04-15 17:13:36', '2020-08-11 15:50:48'),
(76, 'mtn', 'MTN 30GB for N8,000 Data Plan', 30720, 8000, NULL, NULL, 1440, 'anytime', 'Text \"119\" to 131', NULL, 326, 1, '2020-08-11 09:23:39', '2020-08-11 09:23:39'),
(77, 'airtel', 'Airtel 40MB for ₦50 Data Plan', 40, 50, NULL, NULL, 24, 'anytime', 'Dial *141*50#', NULL, 394, 1, '2020-08-11 14:16:10', '2020-08-11 14:16:10'),
(78, 'airtel', 'Airtel 200MB for ₦200 Data Plan', 200, 200, NULL, NULL, 72, 'anytime', 'Dial *141*200#', NULL, 387, 1, '2020-08-11 16:16:15', '2020-08-11 16:16:15'),
(79, 'airtel', 'Airtel 1GB for N300 Data Plan', 1024, 300, NULL, NULL, 24, 'anytime', 'Dial *141*354#', NULL, 376, 1, '2020-08-11 16:20:04', '2020-08-11 16:20:04'),
(80, 'airtel', 'Airtel 350MB for ₦300 Data Plan', 350, 300, NULL, NULL, 168, 'anytime', '*141*300#', NULL, 368, 1, '2020-08-11 16:34:51', '2020-08-11 16:34:51'),
(81, 'airtel', 'Airtel 750MB for ₦500 Data Plan', 750, 500, NULL, NULL, 336, 'anytime', '*141*500#', NULL, 703, 1, '2020-08-11 16:36:13', '2020-08-11 16:36:13'),
(82, 'airtel', 'Airtel 1GB for ₦500 Data Plan', 1024, 500, NULL, NULL, 168, 'anytime', '*141*502#', NULL, 758, 1, '2020-08-11 16:43:20', '2020-08-11 16:43:20'),
(83, 'airtel', 'Airtel 2GB for ₦500 Data Plan', 2048, 500, NULL, NULL, 48, 'anytime', 'Dial *141*504#', NULL, 739, 1, '2020-08-11 16:46:17', '2020-08-11 16:46:17'),
(84, 'airtel', 'Airtel 6GB for ₦1500 Data Plan', 6144, 1500, NULL, NULL, 168, 'anytime', 'Dial: *141*1504#', NULL, 367, 1, '2020-08-11 16:49:09', '2020-08-11 16:49:09'),
(85, 'airtel', 'Airtel 1.5GB for ₦1000 Data Plan', 1536, 1000, NULL, NULL, 720, 'anytime', 'Dial *141*1000#', NULL, 382, 1, '2020-08-11 16:51:34', '2020-08-11 16:51:34'),
(86, 'airtel', 'Airtel 2GB for ₦1,200 Data Plan', 2048, 1200, NULL, NULL, 720, 'anytime', 'Dial *141*1200#', NULL, 368, 1, '2020-08-11 16:58:17', '2020-08-11 16:58:17'),
(87, 'airtel', 'Airtel 3GB for ₦1500 Data Plan', 3072, 1500, NULL, NULL, 720, 'anytime', 'Dial *141*1500#', NULL, 380, 1, '2020-08-11 17:00:04', '2020-08-11 17:00:04'),
(88, 'airtel', 'Airtel 4.5GB for ₦2000 Data Plan', 4608, 2000, NULL, NULL, 720, 'anytime', 'Dial *141*2000#', NULL, 383, 1, '2020-08-11 17:01:25', '2020-08-11 17:01:25'),
(89, 'airtel', 'Airtel 6GB for ₦2500 Data Plan', 6144, 2500, NULL, NULL, 720, 'anytime', 'Dial *141*2500#', NULL, 339, 1, '2020-08-11 17:03:31', '2020-08-11 17:03:31'),
(90, 'airtel', 'Airtel 8GB for ₦3000 Data Plan', 8192, 3000, NULL, NULL, 720, 'anytime', 'Dial *141*3000#', NULL, 383, 1, '2020-08-11 17:04:57', '2020-08-11 17:04:57'),
(91, 'airtel', 'Airtel 11GB for ₦4000 Data Plan', 11264, 4000, NULL, NULL, 720, 'anytime', 'Dial *141*4000#', NULL, 368, 1, '2020-08-11 17:06:21', '2020-08-11 17:06:21'),
(92, 'airtel', 'Airtel Mega 15GB for ₦5,000 Data Plan', 15360, 5000, NULL, NULL, 720, 'anytime', 'Dial *141*5000#', NULL, 369, 1, '2020-08-11 17:10:21', '2020-08-11 17:10:21'),
(93, 'airtel', 'Airtel Mega 25GB for ₦8000 Data Plan', 25600, 8000, NULL, NULL, 720, 'anytime', 'Dial *141*8000#', NULL, 369, 1, '2020-08-11 17:12:09', '2020-08-11 17:12:09'),
(94, 'airtel', 'Airtel Mega 40GB for ₦10,000 Data Plan', 40960, 10000, NULL, NULL, 720, 'anytime', 'Dial *141*10000#', NULL, 353, 1, '2020-08-11 17:13:36', '2020-08-11 17:13:36'),
(95, 'airtel', 'Airtel (Social) 700MB for ₦300 Data Plan', 700, 300, NULL, NULL, 600, 'anytime', 'Dial *688*1#', 'This data plan from Airtel gives you access to Facebook, Twitter, and Whatsap', 419, 1, '2020-08-11 17:15:36', '2020-08-11 17:52:27'),
(96, 'airtel', 'Airtel Mega 120GB for ₦20,000 Data Plan', 122880, 20000, NULL, NULL, 720, 'anytime', 'Dial *141*20000#', NULL, 365, 1, '2020-08-11 17:17:15', '2020-08-11 17:17:15'),
(97, 'airtel', 'Airtel (Social) 20MB for ₦25.00 Data Plan', 20, 25, NULL, NULL, 24, 'anytime', 'Dial *948*4#', 'This plan gives access to chatting on WhatsApp only', 433, 1, '2020-08-11 21:20:12', '2020-08-11 21:20:12'),
(98, 'airtel', 'Airtel (Social) 40MB for ₦50.00 Data Plan', 40, 50, NULL, NULL, 24, 'anytime', 'Dial *991*4#', 'These plans give access to Facebook, Twitter, WhatsApp.', 477, 1, '2020-08-11 21:24:14', '2020-08-11 21:24:14'),
(100, 'airtel', 'Airtel Mega 75GB for ₦15,000.00 Data Plan', 76800, 15000, NULL, NULL, 720, 'anytime', 'Dial *141*15000#', NULL, 356, 1, '2020-08-11 21:34:32', '2020-08-11 21:34:32'),
(101, 'airtel', 'Airtel Mega 200GB for ₦30,000.00 Data Plan', 204800, 30000, NULL, NULL, 720, 'anytime', 'Dial *141*30000#', NULL, 375, 1, '2020-08-11 21:39:46', '2020-08-11 21:39:46'),
(102, 'airtel', 'Airtel Mega 280GB for ₦36,000.00 Data Plan', 286720, 36000, NULL, NULL, 720, 'anytime', 'Dial *141*36000#', NULL, 366, 1, '2020-08-11 21:43:23', '2020-08-11 21:43:23'),
(103, 'airtel', 'Airtel Mega 400GB for ₦50,000.00 Data Plan', 409600, 50000, NULL, NULL, 2160, 'anytime', 'Dial *141*50000#', NULL, 371, 1, '2020-08-11 21:45:42', '2020-08-11 21:45:42'),
(104, 'airtel', 'Airtel Mega 500GB for ₦60,000.00 Data Plan', 512000, 60000, NULL, NULL, 2880, 'anytime', 'Dial *141*60000#', NULL, 376, 1, '2020-08-11 21:47:25', '2020-08-11 21:47:25'),
(105, 'airtel', 'Airtel Mega 1000GB for ₦100,000.00 Data Plan', 1024000, 100000, NULL, NULL, 8760, 'anytime', 'Dial *141*100000#', NULL, 387, 1, '2020-08-11 21:49:51', '2020-08-11 21:49:51'),
(106, 'airtel', 'Airtel (Social) 200MB for ₦100.00 Data Plan', 200, 100, NULL, NULL, 120, 'anytime', 'Dial *688*3#', 'These plans give access to Facebook, Twitter, WhatsApp.', 439, 1, '2020-08-11 22:00:58', '2020-08-11 22:00:58'),
(107, 'airtel', 'Airtel (Instagram) 250MB for ₦100.00 Data Plan', 250, 100, NULL, NULL, 24, 'anytime', 'Dial *141*105#', 'This plan can be used only for accessing Instagram', 488, 1, '2020-08-11 22:12:47', '2020-08-11 22:15:05'),
(108, 'airtel', 'Airtel (Opera) 300MB for ₦100.00 Data Plan', 300, 100, NULL, NULL, 720, 'anytime', 'Dial *141*103#', 'This plans gives access to Opera mini browser and news app only.<br>\n<strong>NOTE: <strong> <em>Video streaming and downloads are not allowed on these bundle</em>', 460, 1, '2020-08-11 22:13:54', '2020-08-11 22:56:37'),
(109, 'airtel', 'Airtel (Opera) 25MB for ₦20.00 Data Plan', 25, 20, 0, NULL, 24, 'anytime', 'Dial *141*253#', 'This plans gives access to Opera mini browser and news app only.<br>\n<strong>NOTE: <strong> <em>Video streaming and downloads are not allowed on these bundle</em>', 503, 1, '2020-08-11 22:58:54', '2020-08-11 22:58:54'),
(110, 'airtel', 'Airtel (Opera) 100MB for ₦50.00 Data Plan', 100, 50, NULL, NULL, 168, 'anytime', 'Dial *141*53#', 'This plans gives access to Opera mini browser and news app only.<br>\n<strong>NOTE: <strong> <em>Video streaming and downloads are not allowed on these bundle</em>', 410, 1, '2020-08-11 23:00:15', '2020-08-11 23:00:15'),
(111, '9mobile', '9mobile 25MB for ₦50.00 Data Plan', 25, 50, NULL, NULL, 24, 'anytime', 'Dial *229*3*8#', NULL, 347, 1, '2020-08-11 23:51:43', '2020-08-11 23:51:43'),
(112, '9mobile', '9mobile 100MB for ₦100.00 Data Plan', 100, 100, NULL, NULL, 24, 'anytime', 'Dial *229*3*1#', NULL, 376, 1, '2020-08-11 23:52:58', '2020-08-11 23:52:58'),
(113, '9mobile', '9mobile 250MB for ₦200.00 Data Plan', 250, 200, NULL, NULL, 168, 'anytime', 'Dial *229*2*10# or Text \"AND11\" to 229', NULL, 385, 1, '2020-08-11 23:55:22', '2020-08-11 23:55:22'),
(114, '9mobile', '9mobile 650MB for ₦200.00 Data Plan', 650, 200, NULL, NULL, 24, 'anytime', 'Dial *229*3*2#', NULL, 375, 1, '2020-08-11 23:57:13', '2020-08-11 23:57:13'),
(115, '9mobile', '9mobile  1GB + social for ₦300.00 Data Plan', 1024, 300, NULL, NULL, 336, 'anytime', 'Dial *229*3*3#', NULL, 305, 1, '2020-08-12 00:01:27', '2020-08-12 00:01:27'),
(116, '9mobile', '9mobile 1GB + social for ₦500.00 Data Plan', 1024, 500, NULL, NULL, 168, 'anytime', 'Dial  *229*2*1#', NULL, 664, 1, '2020-08-12 00:03:12', '2020-08-12 00:03:12'),
(117, '9mobile', '9mobile 2GB + social for ₦500.00 Data Plan', 2048, 500, NULL, NULL, 72, 'anytime', 'Dial *229*3*4#', NULL, 315, 1, '2020-08-12 00:04:36', '2020-08-12 00:04:36'),
(118, '9mobile', '9mobile 7GB + social for ₦1,500.00 Data Plan', 7168, 1500, NULL, NULL, 168, 'anytime', 'Dial *229*2*2#', NULL, 334, 1, '2020-08-12 00:05:51', '2020-08-12 00:05:51'),
(119, '9mobile', '9mobile 1GB (Night) for ₦200.00 Data Plan', 1024, 200, NULL, NULL, 24, 'night', 'Dial  *229*3*11#', 'This is a night only plan and can be used within the hours of 11pm - 5am.', 479, 1, '2020-08-12 00:10:24', '2020-08-12 00:10:24'),
(120, '9mobile', '9mobile 3GB (Night and Weekend) for ₦1,000.00 Data Plan', 3072, 1000, NULL, NULL, 720, 'evening', 'Dial *229*3*12#', 'This data offer from 9mobile can be used during weekends and in the evening (7pm - 6:59am)', 460, 1, '2020-08-12 00:15:26', '2020-08-12 00:15:26'),
(121, '9mobile', '9mobile 7GB (Night and Weekend) for ₦2,000.00 Data Plan', 7168, 2000, NULL, NULL, 720, 'evening', 'Dial *229*3*13#', 'This data plan can be used in the evenings(7pm-6:59am) and on weekends.', 484, 1, '2020-08-12 00:19:36', '2020-08-12 00:20:35'),
(122, '9mobile', '9mobile 500MB for ₦500.00 Data Plan', 500, 500, NULL, NULL, 720, 'anytime', 'Dial *229*2*12#', NULL, 292, 1, '2020-08-12 00:26:39', '2020-08-12 00:26:39'),
(123, '9mobile', '9mobile 1.5GB for ₦1,000.00 Data Plan', 1536, 1000, NULL, NULL, 720, 'anytime', 'Dial *229*2*7#', NULL, 382, 1, '2020-08-12 00:28:19', '2020-08-12 00:28:19'),
(124, '9mobile', '9mobile 2GB for ₦1,200.00 Data Plan', 2048, 1200, NULL, NULL, 720, 'anytime', 'Dial *229*2*25# or Text \"AND11\" to 229', NULL, 378, 1, '2020-08-12 00:31:06', '2020-08-12 00:31:06'),
(125, '9mobile', '9mobile 3GB for ₦1,500.00 Data Plan', 3072, 1500, NULL, NULL, 720, 'anytime', '*229*2*3#', NULL, 361, 1, '2020-08-12 00:32:20', '2020-08-12 00:32:20'),
(126, '9mobile', '9mobile 4.5GB for ₦2,000.00 Data Plan', 4608, 2000, NULL, NULL, 720, 'anytime', 'Dial *229*2*8# or Text \"AND2\" to 229', NULL, 370, 1, '2020-08-12 00:34:19', '2020-08-12 00:34:19'),
(127, '9mobile', '9mobile 11GB for ₦4,000.00 Data Plan', 11264, 4000, NULL, NULL, 720, 'anytime', 'Dial *229*2*36#', NULL, 370, 1, '2020-08-12 00:36:29', '2020-08-12 00:36:29'),
(128, '9mobile', '9mobile 15GB for ₦5,000.00 Data Plan', 15360, 5000, NULL, NULL, 720, 'anytime', 'Dial  *229*2*37#', NULL, 360, 1, '2020-08-12 00:37:29', '2020-08-12 00:37:29'),
(129, '9mobile', '9mobile 40GB for ₦10,000.00 Data Plan', 40960, 10000, NULL, NULL, 720, 'anytime', 'Dial *229*4*1#', NULL, 371, 1, '2020-08-12 00:39:35', '2020-08-12 00:39:35'),
(130, '9mobile', '9mobile 75GB for ₦15,000.00 Data Plan', 76800, 15000, NULL, NULL, 720, 'anytime', 'Dial *229*2*4#', NULL, 372, 1, '2020-08-12 00:41:12', '2020-08-12 00:41:12'),
(131, '9mobile', '9mobile 75GB for ₦25,000.00 Data Plan', 76800, 25000, NULL, NULL, 2160, 'anytime', 'dial *229*5*1#', NULL, 337, 1, '2020-08-12 00:43:35', '2020-08-12 00:43:35'),
(132, '9mobile', '9mobile 165GB for ₦50,000.00 Data Plan', 168960, 50000, NULL, NULL, 4320, 'anytime', 'dial *229*5*2#', NULL, 377, 1, '2020-08-12 00:45:13', '2020-08-12 00:45:13'),
(133, '9mobile', '9mobile 365GB for ₦100,000.00 Data Plan', 373760, 100000, NULL, NULL, 8760, 'anytime', 'Dial *229*5*3#', NULL, 325, 1, '2020-08-12 00:46:29', '2020-08-12 00:47:06'),
(136, 'glo', 'Glo 17GB for ₦5,000.00 Data Plan', 17408, 5000, 1280, 6144, 720, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu', 'Data bonus is usable at night (12am-5am) except for New subscribers that can use 5GB of their bonus at anytime.', 392, 1, '2020-08-12 11:26:20', '2020-08-12 11:26:20'),
(137, 'glo', 'Glo 1GB for ₦300.00 Data Plan', 1024, 300, NULL, NULL, 24, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu.', NULL, 399, 1, '2020-08-12 11:31:46', '2020-08-12 11:31:46'),
(138, 'glo', 'Glo 2GB for ₦500.00 Data Plan', 2048, 500, NULL, NULL, 48, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu.', NULL, 363, 1, '2020-08-12 11:32:32', '2020-08-12 11:32:32'),
(139, 'glo', 'Glo (Sunday) 2.25GB for ₦200.00 Data Plan', 2304, 200, NULL, NULL, 24, 'weekend', 'Dial *777# on your Glo line and follow the displayed menu.', 'This data plan is for use on Sundays only and it expires once the next day begins.', 463, 1, '2020-08-12 11:34:44', '2020-08-12 11:34:44'),
(140, 'glo', 'Glo 7GB for ₦1,500.00 Data Plan', 7168, 1500, NULL, NULL, 168, 'anytime', 'Dial *777# on your Glo line and follow the displayed menu.', NULL, 358, 1, '2020-08-12 11:35:52', '2020-08-12 11:35:52'),
(141, 'glo', 'Glo Night 250MB for ₦25.00 Data Plan', 250, 25, NULL, NULL, 24, 'night', 'Dial *777# on your Glo line and follow the displayed menu.', 'This pan can be used from 12am to 5am', 395, 1, '2020-08-12 11:38:33', '2020-08-12 11:38:33'),
(142, 'glo', 'Glo Night 500MB for ₦50.00 Data Plan', 500, 50, NULL, NULL, 24, 'night', 'Dial *777# on your Glo line and follow the displayed menu.', 'This pan can be used from 12am to 5am', 347, 1, '2020-08-12 11:40:26', '2020-08-12 11:40:26'),
(143, 'glo', 'Glo Night 1GB for ₦100.00 Data Plan', 1024, 100, NULL, NULL, 120, 'night', 'Dial *777# on your Glo line and follow the displayed menu.', 'This plan can be used from 12am to 5am and it is valid for 5 nights.', 331, 1, '2020-08-12 11:42:31', '2020-08-12 11:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_04_04_130631_create_courses_table', 1),
(5, '2024_04_04_130659_create_subjects_table', 1),
(6, '2024_05_02_135536_create_permission_tables', 1),
(7, '2024_06_20_053342_create_countries_table', 1),
(8, '2024_06_25_150110_create_posts_table', 1),
(10, '2024_06_25_155918_create_post_images_table', 1),
(12, '2024_06_26_092210_create_data_plans_table', 3),
(14, '2024_06_27_130829_add_description_to_roles_table', 4),
(16, '2024_06_25_154301_create_comments_table', 5),
(17, '2024_07_15_123849_create_personal_access_tokens_table', 6),
(18, '2024_07_23_205734_create_post_syncs_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view users', 'web', '2024-06-27 11:36:06', '2024-06-27 11:36:06'),
(2, 'edit users', 'web', '2024-06-27 11:36:59', '2024-06-27 11:36:59'),
(3, 'delete users', 'web', '2024-06-27 11:37:42', '2024-06-27 11:37:42'),
(4, 'create posts', 'web', '2024-06-27 11:38:19', '2024-06-27 11:38:19'),
(5, 'edit posts', 'web', '2024-06-27 11:38:26', '2024-06-27 11:38:26'),
(6, 'delete posts', 'web', '2024-06-27 11:39:00', '2024-06-27 11:39:00'),
(7, 'view posts', 'web', '2024-06-27 11:39:52', '2024-06-27 11:39:52'),
(8, 'view comments', 'web', '2024-07-06 07:52:04', '2024-07-06 07:52:04'),
(9, 'edit comments', 'web', '2024-07-06 07:52:22', '2024-07-06 07:52:22'),
(10, 'delete comments', 'web', '2024-07-06 07:52:32', '2024-07-06 07:52:32');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('course-series','special-series','how-tos') NOT NULL,
  `topic` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `hits` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `status` enum('published','unpublished') NOT NULL DEFAULT 'unpublished',
  `comment_status` enum('open','closed') NOT NULL DEFAULT 'closed',
  `comment_count` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `tags` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sort_value` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `subject_id`, `version`, `parent_id`, `type`, `topic`, `content`, `hits`, `status`, `comment_status`, `comment_count`, `tags`, `slug`, `description`, `sort_value`, `created_at`, `updated_at`) VALUES
(1, 1, 6, NULL, NULL, '', 'Introduction to JavaScript', '<p>JavaScript is one of the most popular programming languages on earth and is used to add interactivity to webpages, process data, as well as create various applications (mobile apps, desktop apps, games, and more).</p>\n<p>JavaScript is the programming language of HTML and the Web. Although recently by the coming of certain frameworks JavaScript can as well be used on the server side to do some work initially reserved for server side languages like PHP, ASP etc.</p>\n<p>In this course, we are going to focus on using JavaScript on the client side (inside the browser) and subsequent courses can take care of the server aspect of JavaScript.</p>\n<h2>How difficult is JavaScript?</h2>\n<p>This is the question bugging the minds of most newcomers to programming especially web design starters. Some even ask if one cannot have a great web designing career without learning programming at least in JavaScript.</p>\n<p>To be sincere with you, it\'s not that hard to learn JavaScript and start solving some common website issues with it if you give it a little commitment. To this I must add that if you really want to take it further to the professional level of JavaScript programming, it will take a bit more time and learning to get to the pro level but you need not fear, it\'s something you can definitely do.</p>\n<h2>How to learn JavaScript</h2>\n<p>Thank God for the age we are in: access to information and learning materials has never been this easy and most times equally free. There are a couple of way you can learn JavaScript:</p>\n<ol>\n<li>Download free ebooks and read</li>\n<li>Search for tutorial videos on youtube</li>\n<li>Search for code examples that accomplishes simple tasks and examine them</li>\n<li>Register for a training class either online or in a physical location such as a training institute.</li>\n</ol>\n<h2>How not to learn JavaScript</h2>\n<p>There is only one way we want to discourage you from following in learning this programming language in order for you not to waste your time and make only little progress in this journey. And that is don\'t learn by reading alone! Yes, get dirty and code, code and code again! It\'s better you write a program and it is not working properly than for you not to write at all because you fear making mistakes.</p>\n<p>The average life of every programmer is spent correcting errors and mistakes in codes. So, don\'t worry about getting it wrong when you write a program, when it\'s not working, there are lots of forums online that can help you easily fix it.</p>\n<p>Even pros make mistake, so, get coding as soon as possible.</p>\n<p><em>Happy learning!</em></p>', 1443, 'published', 'open', 0, 'JavaScript, learn javascript, web scripting, client side programming, scripting', 'introduction_to_javascript', 'An introduction to JavaScript, the programming language of HTML and the web. A simple tutorial on programming with JavaScript.', 1, '2018-11-19 11:33:49', '2024-07-06 16:18:16'),
(2, 1, 2, NULL, NULL, '', 'Crop an Image with GIMP', '<p>To crop an image is a task that is very important yet very simple to carry out. Just relax, and we promise to lay it all down clearly for even a complete novice to master the art of cropping with GIMP.</p>\n<p>Just for the sake of little more clearance in case you wondering what the word \"Crop\" means, after all we are not dealing with farms here. Don\'t worry I will give simple explanation below. Cropping an image simply means to remove portion(s) of an image that is not desirable while keeping the part we want.</p>\n<p>Now, enough of the words, let get to action because action they say speaks louder than voice!</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://www.donzoby.com/images/courses/gimp/crop-image.png\" alt=\"image to crop with gimp\" width=\"316\" height=\"220\" /></p>\n<p><strong>Our mission:</strong> <em>To remove all other parts of the above image and keep only the circle and the writing inside it.</em></p>\n<ol>\n<li>First, open the image/picture you want to crop in GIMP</li>\n<li>Click on the Crop tool within the tool box (in the right pane) or press <strong>Shift+C</strong> on the keyboard (for Windows OS).</li>\n<li>Click and drag over the portion of the image you want to keep. as shown in the figure below.<br /><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://www.donzoby.com/images/courses/gimp/select-crop-portion.png\" alt=\"select portion to crop\" width=\"318\" height=\"222\" /><br /><strong>NOTE</strong>: The portion of the image outside your selection (that is, the partion greyed out) will be thrown away!<br /><br /></li>\n<li>Finally press the <strong>Enter</strong> key on the keyboard or double click within your selection. The image will look like shown below:<br /><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://www.donzoby.com/images/courses/gimp/crop-image-result.png\" alt=\"crop image result\" width=\"214\" height=\"213\" /></li>\n</ol>\n<p>Thank God! We are done!</p>\n<p>Do you want to learn more about working with GIMP? Check out our GIMP tutorial section and keep tuned for more clear and precise lessons.</p>\n<p>With this knowledge that you have just gotten, you are on your way to becoming much more efficient in working with images by keeping only the needed part while throwing away unecessary ones.</p>', 2176, 'published', 'open', 0, 'crop an image with gimp, crop an image, cropping with gimp, cropping, gimp', 'crop_an_image_with_gimp', 'A very simple tutorial on how to Crop an image in GIMP using the crop tool. Quickly learn how to keep only the needed part of an image.', 17, '2018-12-05 20:16:02', '2024-07-06 19:26:13'),
(3, 1, 33, NULL, NULL, '', 'Glo 2.5gigs free YouTube Data', '<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://donzoby.com/images/courses/service-providers/dzb_00046_glo-free-youtube-data.png\" alt=\"\" width=\"340\" height=\"352\" /></p>\n<p><span style=\"text-decoration: underline;\"><strong>Update</strong></span>: <em>Glo Network has discontinued this offer at the moment. I tested it and also had to call their customer care to confirm. They quietly removed the offer without making it well known to the customer. </em></p>\n<p><em>What they offer now in place of the free Youtube data is a data bonus that can be used to browse any website. They are not always that big. The size depends on the data plan you purchased. It\'s volume ranges from 10% - 20% of purchased data volume and can only be used at night (12:00am - 5:00am).</em></p>\n<hr />\n<p>Today I want to tell you about a legitimate and easy way to watch video online for FREE! Yeah, you heard it right. It\'s for free. It\'s very possible that you have been missing this great opportunity at your disposal for a while without even knowing it. But don&rsquo;t worry, that&rsquo;s why we are here at Donzoby.com to make your life better.</p>\n<p>You will agree with me that there is always one thing or the other that you need to watch online but data is sometimes a hindrance to this especially for those in developing nations where price of internet subscription is still very high.</p>\n<p>It could be a tutorial, a sermon, entertainment or just about any video that you want to view online.</p>\n<p>This guide is for watching video only on YouTube and for people that meet the following conditions:</p>\n<ol>\n<li>Resides in Nigeria</li>\n<li>Has Glo Mobile as their service provider</li>\n<li>Subscribes to a data plan of at least N500.00 (five hundred naira)</li>\n<li>Let me also add, \"Can wake up at night when sleep is sweet!\"</li>\n</ol>\n<p>When you subscribe for data plan that ranges from N500 and above, Glo attaches an additional 2.5gigs data to your subscription.</p>\n<p>It\'s this additional data that is reserved for streaming or watching YouTube videos. But wait before you rush and burn up your subscription, this free data is a nocturnal animal! This means that it only functions at night. Yes, not evening but deep into the dead night.</p>\n<p><em><strong>Start time</strong></em><br />1:00am</p>\n<p><em><strong>End Time</strong></em><br />5:30am</p>\n<p>So, from the above, you have a window of 4hrs 30mins each day to watch YouTube videos for free.</p>\n<h3>Caution when using Glo free YouTube data</h3>\n<p>If you have been around the Nigerian telcos for a while now, you would\'ve known that they are very good at painful surprises. So, in order to avoid you fighting with customer care, take note of the following:</p>\n<ul style=\"list-style-type: square;\">\n<li>Wait until it\'s a few minutes past 1:00am maybe 1:02</li>\n<li>Turn off your data and turn it on again</li>\n<li>Check your available data volume on your current subscription. The reason is because there is no way to check the volume of this additional free data for YouTube.</li>\n<li>Check your available data volume again after watching for like 10mins. If you notice any significant reduction in the data volume, please run for your data! This means the additional free data is not active on your account. But if the volume remains unchanged, congratulations enjoy yourself.</li>\n<li>Don\'t exceed 5:30am on the dot.</li>\n<li>Finally, repeat the above every night of free streaming because you might exhaust the free 2.5gigs and enter without any warning into your main data volume.</li>\n</ul>\n<p>Thanks and God bless.</p>\n<p>If you have any question, please feel free to throw in your comment below. I will try to respond as quickly as I can.<br /><br /></p>', 1459, 'published', 'open', 0, 'youtube, free youtube, glo, glo free data, night youtube', 'glo_2.5gigs_free_youtube_data', 'When you subscribe for data plan that ranges from N500 and above, Glo attaches an additional 2.5gigs data to your subscription for free.', 3, '2018-12-26 19:29:12', '2024-07-06 16:18:16'),
(4, 1, 4, NULL, NULL, '', 'What is HTML?', '<h3>Brief History of HTML</h3>\r\n<p>HTML which stands for HyperText Markup Language was invented at a company called CERN in Geneva by a scientist and academic by name Tim Berners-Lee in the year 1989.</p>\r\n<p>The arrival of HTML marked the beginning of the World Wide Web (www) as we know it today. HTML is considered the language of the web and according to Donzoby.com, it is the skeletal frame of all living web pages.</p>\r\n<h3>What is HTML Used For?</h3>\r\n<p>Although it seems plain and self explanatory already, we still know that for some reasons you might still be wondering what exactly is HTML used for?</p>\r\n<p>To put it simply, it is a markup language used for \"building\" web pages. Each website is made up of web pages and each web page is built (structured and laid out) using HTML.</p>\r\n<p>By learning HTML, you are equipping yourself with a great tool for limitless possibilities as a web designer or developer.</p>\r\n<h3>How Hard is HTML?</h3>\r\n<p>I will rather prefer the question on your mind is \"How simple is HTML?\" and the reason is because HTML is not a difficult or complicated markup language to learn because some of its components are self explanatory (especially HTML 5) and quite intuitive.</p>\r\n<p>You will be building your own web pages in no time by following through this tutorial on creating web pages with HTML.</p>\r\n<h3>How to recognize HTML file or document</h3>\r\n<p>HTML files have a .html or .htm file extension. For instance, if you see a file named \"my-site.html\". It tells you that the file is a web page. You can open it with your browser and view the web page. Your browser will interpret the markup language and render it appropriately.</p>', 1527, 'published', 'open', 0, 'what is html, meaning of html, introduction to html, html, history of html, html file', 'what_is_html', 'It is an acronym for HyperText Markup Language. It was invented by Tim Berners-Lee in 1989. It is used to define the structure and layout of a web page. According to Donzoby.com, it is the skeletal frame of all living web pages.', 4, '2019-02-08 12:49:37', '2024-07-06 18:54:02'),
(5, 1, 33, NULL, NULL, '', 'Glo Revamped Night Plans', '<p>&nbsp;</p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Today, Glo Mobile network sent me this message:</span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://donzoby.com/images/courses/service-providers/Glo_night_data_new.jpg\" alt=\"\" width=\"220\" height=\"263\" /></span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">This marks Glo\'s attempt to remain the data grandmaster that it has positioned itself to be and if you are a heavy data user like me, I know that this is good news.</span></p>\n<p class=\"MsoNormal\">&nbsp;</p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>Why Does This Even Matter?</strong></span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Ok, that\'s a nice question that deserves a clear answer. The reason why we are talking about the latest Glo Night Data offering is that it goes a step ahead of what other competing networks are offering at the moment. To put it simply, it seems that Glo assembled their marketing magicians and asked them to come up with a night data plan that will beat what is currently being offered without going too far on Glo\'s own part.</span></p>\n<ul style=\"list-style-type: square;\">\n<li class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">&nbsp;&nbsp;MTN offers a maximum of 500mb per night (250mb for N25 x 2 or 500mb for N50) from 12:00midnight &ndash; 5:00am<br /><br /></span></li>\n<li class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">&nbsp;Airtel offers 250mb for N25 (you can subscribe twice for the night)<br /><br /></span></li>\n<li class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">&nbsp;9mobile offers 250mb for and N501gb for N200<br /><br /></span></li>\n</ul>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Considering the above, you can see why the new Glo night plan beats them all not just in the price but also in the validity period.</span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><br /><strong>Who is Eligible?</strong></span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">At the moment every Glo customer is qualified for this new night data plan unlike Airtel and MTN that restrict theirs to customers on a special package.<br /><br /></span></p>\n<p><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>How to Subscribe</strong></span></p>\n<p><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Follow the steps bellow to subscribe for this new plan:</span></p>\n<ol>\n<li><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Dial *777#</span></li>\n<li><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Type 1 and send to buy data</span></li>\n<li><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Type 1 and send to buy 3G-4G data</span></li>\n<li><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Type 7 and send for Night and weekend plan</span></li>\n<li><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Type 3 and send for N100 = 1GB 5days (12am-5am)</span></li>\n</ol>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">N100 will be deducted from your account and you will be given 1GB to use between 12am and 5am for five(5) days.</span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Enjoy while it last!</span></p>\n<p class=\"MsoNormal\">&nbsp;</p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Do you like this new offer from Glo? What do you think? Share your thoughts in the comment section below.</span></p>\n<p>&nbsp;</p>', 1524, 'published', 'open', 0, 'glo night plan, glo new night plan, glo N100 for 1gb', 'glo_revamped_night_plans', 'Glo just released new night browsing data plans that beat all the other competitors both in volume and the duration of validity.', 5, '2019-12-17 20:27:14', '2024-07-06 16:18:16'),
(6, 1, 33, NULL, NULL, '', 'Check Your Data Balance On The Glo Mobile Network', '<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://www.donzoby.com/images/courses/service-providers/glo_data_balance.png\" alt=\"\" /></p>\n<p>&nbsp;</p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">We are glad to have you with us through this fast and simple guide on how to check your data balance on the Glo Mobile network.<br /><br /></span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">This is specifically written for those in Nigeria but Glo could as well retain the same USSD</span> <span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">(Unstructured Supplementary Service Data) code for similar operations across international borders.<br /><br /></span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>There are two ways to do this:</strong></span></p>\n<ul style=\"list-style-type: circle;\">\n<li class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Use the Customer Services menu by dialing *777#<br /><br /></span></li>\n<li class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Choose buy data by typing 1 and pressing send<br /><br /></span></li>\n<li class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">From the listed data options choose manage plan by typing 4<br /><br /></span></li>\n<li class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Finally, type in 4 again and send to get your data balance. When you perform this last step, your data plan remaining volume and validity details will be staring straight at you.<br /><br /></span></li>\n</ul>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>Second way to check glo data balance</strong></span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">This one involves just one step and I believe you don\'t need anyone to tell you that it\'s what I always use. Who doesn\'t want an easy life when possible?<br /><br /></span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Dial *127*0# and then send. Voila! You will get the same result as the one above.</span></p>\n<p class=\"MsoNormal\">&nbsp;</p>\n<p class=\"MsoNormal\"><em><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><span style=\"color: #323232; font-family: sans-serif; font-size: 18.6667px;\">What do you think? Share your thoughts in the comment section below.</span></span></em></p>\n<p>&nbsp;</p>', 1552, 'published', 'open', 0, 'glo data balance, check glo data balance, how to check data balance on glo network', 'check_your_data_balance_on_the_glo_mobile_network', 'Simple steps on how to check your data balance on the Glo network from www.donzoby.com.', 6, '2020-03-06 00:43:24', '2024-07-06 16:18:16'),
(7, 1, 33, NULL, NULL, '', 'Data Plan Validity Period', '<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://www.donzoby.com/images/courses/Service Providers/data_plan_validity_period.png\" alt=\"\" /></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">When you are going about your daily tasks and utilizing all the good things we now have around us, it may not come to your mind that some of the things we cannot do without now only came on the scene few years ego.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">With every service we have to consume, there are at least a few information that we need in order to make the most out of it. One of such services is the data services from our various service providers.<br /><br /></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>What is data plan validity period?</strong></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Almost all service providers or mobile network carriers attach validity period to the data plans they offer. Based on this, we set out to clarify what that means and how it can help you make the most out of your plans.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Validity period of a data plan simply means the stipulated duration (hours, days, weeks, months or years) within which you can still utilize your remaining data volume.<br /><br /></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>What happens when I exceed my data validity period?</strong></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Generally, you will cease to have access to your remaining data (if any is still remaining). This means that you won\'t be able to browse and use the internet.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">But, if you observed, I used the word \"Generally\" in the beginning of the above paragraph and the reason is because different Internet Service Providers have different way of treating validity period expiration.<br /><br /></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>What if I still have unused data?</strong></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">It depends on your service provider as we mentioned above. Some will wipe out the remaining data. Some others will suspend your data plan but will rollover your remaining data when you renew your subscription.<br /><br /></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>What is data rollover?</strong></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Let explain this with an example: Assuming you subscribed for 2gigs data with a validity period of one (1) week and you happened to have used only 1gig within the first week after your subscription. If you renew your plan with your service provider, you will get the usual 2gigs plus the remaining 1 gig from your previous subscription bringing your total data volume to 3gigs.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">To know whether your service provider offers data rollover you need to contact the customer care and they will give you needed information on your desired plan.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Finally, it\'s very important to keep in mind that most mobile network operators have a specified time limit between your data plan expiration and renewal. It is only within this time limit that you can have your unused data rolled over.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Please like our page and use the comment box below if you need further clarification on this topic.</span></p>', 1423, 'published', 'open', 0, 'data validity period, data plan validity, validity of data plan, data bundle validity', 'data_plan_validity_period', 'Validity period of a data plan simply means the stipulated duration within which you can still utilize your remaining data volume.', 7, '2020-03-06 17:02:22', '2024-07-06 16:18:16'),
(8, 1, 4, NULL, NULL, '', 'Tools for Working with HTML', '<h3><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://donzoby.com/images/courses/html/dzb_00051_sublime-editor.png\" alt=\"\" width=\"444\" height=\"231\" /></h3>\n<h3>Only Two Tools</h3>\n<p>There are basically only two things you need in order to create web pages using HTML:</p>\n<ul style=\"list-style-type: square;\">\n<li><strong>Text Editor</strong>: A computer program used for creating text files. The good news is that no matter the Operating System you are using, there is a text editor that came with it and as basic as the text editor might be, it is enough to code with HTML.</li>\n<li><strong>A Browser</strong>: It\'s a software application used for viewing web pages. Popular browsers include: Chrome, Firefox, Safari, Internet Explorer, Opera and Edge. Just as text editor, I am almost certain that your computer has a browser already installed because almost all Operating System come with a browser pre-installed.</li>\n</ul>\n<p>From the above, we can safely conclude that you have all the tools you need for creating web pages using HTML.</p>\n<h3>A Note on Text Editor</h3>\n<p>While you can create web pages using basic text editors such as WordPad or Notepad on Windows and&nbsp;<span style=\"font-family: Verdana, sans-serif; font-size: 15px;\">TextEdit (Mac)</span>&nbsp;for example, it will take you more time and labor to get things done.</p>\n<p>To make the task of writing codes easier, there is a special class of text editors called Integrated Development Environment (IDE). They are text editors with lot more features such as auto completion of codes, error detecting and tracing, line numbering etc that makes it much more fun and easier to write codes.</p>\n<p>While there are several IDEs out there and it\'s hard to say which one is really better than the other, I will recommend that you get started with Sublime Text. It is free and you can&nbsp;<a title=\"Get Sublime Text IDE\" href=\"https://www.sublimetext.com/download\" target=\"_blank\" rel=\"noopener\">download it here</a>.</p>\n<h3>A Note on Browsers</h3>\n<p>Having only one browser for viewing your web pages built with HTML is good for a beginner but as you go further and add more features to your page, it will be inadequate to test your work using only one web browser.</p>\n<p>All the listed browsers above are free to download and use, so, try get more than just one of them. If possible, get all of them if you really want to be sure that your web pages will display uniformly across browsers.</p>\n<h4>Browsers Download Links:</h4>\n<p><a title=\"Get Google Chrome Browser\" href=\"https://www.google.com/chrome/\" target=\"_blank\" rel=\"noopener\">Download Chrome</a><br /><a title=\"Get Firefox Browser\" href=\"https://www.mozilla.org/en-US/firefox/new/\" target=\"_blank\" rel=\"noopener\">Download Firefox</a><br /><a title=\"Get Safari Web Browser\" href=\"https://safari.en.softonic.com/download\" target=\"_blank\" rel=\"noopener\">Download Safari</a><br /><a title=\"Get Opera Browser\" href=\"https://www.opera.com/download\" target=\"_blank\" rel=\"noopener\">Download Opera</a></p>', 1311, 'published', 'open', 0, 'Tools for Working with HTML, html tools, html editor, web browsers, browsers, browsers download links', 'tools_for_working_with_html', 'There are basically only two things you need in order to create web pages using HTML. A text editor to write the code and a Browser to render the code you have written.', 8, '2020-07-16 19:31:26', '2024-07-06 18:54:53'),
(9, 1, 4, NULL, NULL, '', 'Your First Website', '<p>We are going to dive right in and write the code for our first website below and then proceed to explain the HTML that made that happen and from there go deeper into other aspects of HTML that could not be added to our simple and yet complete website.</p>\n<p>Open any text editor of your choice (we recommend Sublime Text but any other text editor can serve) and type in the following code:</p>\n<pre class=\"language-markup\"><code data-linenumber=1>&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n&lt;head&gt;\n     &lt;title&gt;My Site&lt;/title&gt;\n&lt;/head&gt;\n&lt;body&gt;\n     &lt;h1&gt;Welcome to my website!&lt;/h1&gt;\n     &lt;p&gt;I was told to put my thoughts in a paragraph.&lt;/p&gt;\n&lt;/body&gt;\n&lt;/html&gt;</code></pre>\n<p>Now, save the code in any location of your choice.</p>\n<p><strong>NOTE</strong>: <em>Be sure to save it as a .html file if not you will not get the expected result. If you are having any challenge in making this work, use the the comment section below and you will be helped.</em></p>\n<p>After saving your file, it is now time to see the result of your code. Go ahead and open the file you just saved with any web browser of your choice (Chrome, Firefox, Safari, Opera etc) and you will see the result of your hard work displayed as below:</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://donzoby.com/images/courses/html/dzb_00052_first-site-result.png\" alt=\"\" width=\"602\" height=\"278\" /></p>\n<p>Congratulations! You\'ve built your first website. Although it doesn\'t do much at the moment, but we have laid solid foundation upon which we can build any website no matter how complex it may be.</p>\n<h3>What We Just Did:</h3>\n<p>Remember that from the previous lessons we understood that HTML is a markup language, so what we did above was to give the browser certain content (data) and information describing the content and how it should be displayed.</p>\n<p><strong>&lt;!Doctype html&gt;</strong> : This tells the browser that this document/file is a HTML document.</p>\n<p><strong>&lt;html&gt;</strong> : This surrounds everything in a HTML document, it serves as the root element for the webpage.</p>\n<p><strong>&lt;head&gt;</strong> : This defines a section (element) of the webpage that will not be displayed on the page but provides information about the webpage.</p>\n<p><strong>&lt;title&gt;</strong> : As the name suggests, this provides a title for the webpage. The content of the title element is displayed on the browser\'s title bar or as the name of the browser\'s tab where the webpage is open.</p>\n<p><strong>&lt;body&gt;</strong> : This is the element that defines the part of the document that will be displayed on the browser. It serves as the container for every other thing displayed on the webpage.</p>\n<p><strong>&lt;h1&gt;</strong> : This defines a heading for the content of the webpage.</p>\n<p><strong>&lt;p&gt;</strong> : This defines a paragraph.</p>\n<p>If you don\'t yet fully understand the concept of element, don\'t worry in the next lesson, we will look at HTML elements and how many of them are used including the ones you have seen above.</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>', 1288, 'published', 'open', 0, 'build website, html, first website with HTML', 'your_first_website', 'Here we guide you through the process of creating your first website. It\'s simple but yet validly complete.', 9, '2020-07-17 13:21:10', '2024-07-06 18:54:34'),
(10, 1, 4, NULL, NULL, 'course-series', 'Html Elements', '<p>HTML is made up of segments describing the structure and content of the webpage that are called elements.</p>\n<p>Basically, an HTML element is composed of the following:</p>\n<p>&lt;<code data-linenumber=\"1\">tagname</code>&gt;: &nbsp;opening tag</p>\n<p>Content</p>\n<p class=\"MsoNormal\">&lt;/<code data-linenumber=\"1\">tagname</code>&gt;: closing tag</p>\n<p>For example, to add a paragraph to a webpage, we will wrap the text (content) of the paragraph in the paragraph element tag:</p>\n<p>&nbsp;</p>\n<pre class=\"language-markup\" style=\"word-spacing: 0px;\"><code>&lt;p&gt; My first paragraph &lt;/p&gt;</code></pre>\n<p>Let\'s take a look at how they\'re written graphically and in more details:</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://donzoby.com/images/courses/html/dzb_00053_element-structure.png\" alt=\"\" width=\"487\" height=\"341\" /></p>\n<p>&nbsp;</p>\n<pre class=\"language-markup\" style=\"word-spacing: 0px;\"><code>&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n	&lt;head&gt;\n		&lt;title&gt;My Site&lt;/title&gt;\n	&lt;/head&gt;\n	&lt;body&gt;\n		&lt;p&gt;My first paragraph.&lt;/p&gt;\n	&lt;/body&gt;\n&lt;/html&gt;</code></pre>\n<p class=\"MsoNormal\"><strong>Remember:</strong>&nbsp;<em>From our earlier lesson we established that every html page must start with a DOCTYPE declaration, followed by the &lt;html&gt; element which will wrap every other elements on the page. The &lt;body&gt; section is where you put contents that will be displayed on the page</em>.</p>\n<h3>Empty&nbsp;HTML&nbsp;elements</h3>\n<p class=\"MsoNormal\">There are certain elements in HTLM that doesn\'t have content (empty elements) and therefore they don\'t have closing tags. example is the &lt;<code data-linenumber=\"1\">br</code>&gt; element used for adding line breaks.</p>\n<h3>Nested&nbsp;HTML&nbsp;elemets</h3>\n<p>An element in HTML can contain other element(s). The only time this cannot work is if you are trying to put a block level element inside an inline element (<em>we will learn about block and inline elements below</em>)</p>\n<p>When an element is containing another element, we have what is called nested elements. Like in our example above, the &lt;<code data-linenumber=\"1\">p</code>&gt; element is nested inside the &lt;<code data-linenumber=\"1\">body</code>&gt; element and the &lt;<code data-linenumber=\"1\">body</code>&gt; element in turn is nested within the &lt;<code data-linenumber=\"1\">html</code>&gt; element which is the root element.</p>\n<p>The &lt;<code data-linenumber=\"1\">body</code>&gt; element is the parent element to the &lt;<code data-linenumber=\"1\">p</code>&gt; element and the &lt;<code data-linenumber=\"1\">p</code>&gt; element is a child element of the &lt;<code data-linenumber=\"1\">body</code>&gt; element. The same relationship exist between the &lt;<code data-linenumber=\"1\">html</code>&gt; element and the &lt;<code data-linenumber=\"1\">body</code>&gt; element.</p>\n<p>If two HTML elements have the same parent element, the two elements are said to be siblings.&nbsp;</p>\n<p><strong>NOTE</strong>:&nbsp;<em>From here onwards, we will only be writing the elements in focus without writing the full HTML documents (we will omit Doctype declaration, &lt;head&gt;, and &lt;body&gt; tags). This will save space and make it easier for us to focus on the main thing at hand.&nbsp;<span style=\"text-decoration: underline;\">Just keep in mind that whatever element we are dealing with has to be put within the &lt;body&gt;&lt;/body&gt; tags of your HTML document</span></em>.</p>', 1226, 'published', 'open', 0, 'html element, html elements, html tags, empty html elements, opening tag, closing tag, nested elements, block elements, inline elements', 'html_elements', 'HTML is made up of segments describing the structure and content of the webpage that are called elements.', 10, '2020-07-23 17:43:38', '2024-07-09 18:48:34'),
(11, 1, 6, NULL, NULL, '', 'Say Hello in JavaScript', '<p>Having introduced JavaScript briefly in our earlier lesson, here we are going to move straight into writing your first JavaScript program.</p>\n<p>One important thing, and that\'s the first thing you have to consider is how do you let the browser displaying your webpage know that the next lines of code you are about to write is not just another HTML code but a JavaScript code?</p>\n<h3>Script Element &lt;<code data-linenumber=\"1\">script</code>&gt; comes to the rescue!</h3>\n<p>In order to let the browser know that you are about to write JavaScript and it should interpret it accordingly, you use the script element of HTML.</p>\n<p>Create an HTML document and within the &lt;<code data-linenumber=\"1\">head</code>&gt; section, add the following:</p>\n<p>&nbsp;</p>\n<pre class=\"language-javascript\" style=\"word-spacing: 0px;\"><code data-linenumber=1>&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n	&lt;head&gt;\n		&lt;title&gt;My Site&lt;/title&gt;\n		&lt;script&gt;\n			document.write(\"Hello from here.\");\n		&lt;/script&gt;\n	&lt;/head&gt;\n	&lt;body&gt;\n	&lt;/body&gt;\n&lt;/html&gt;</code></pre>\n<p>Save your work and open the HTML document in a browser. You should see a result similar to this:</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://www.donzoby.com/images/courses/javascript/dzb_00054_first-js.png\" alt=\"\" width=\"530\" height=\"237\" /></p>\n<h3>What you just did:</h3>\n<ol>\n<li>You notified the browser that you are about to write JavaScript code by using the opening script tag (&lt;<code data-linenumber=\"1\">script</code>&gt;)</li>\n<li>You used a function (more on this later) to write \"<code data-linenumber=\"1\">Hello from here</code>\" to the webpage.</li>\n<li>Finally, you informed the browser that you are done writing JavaScript by adding the closing script tag (&lt;/<code data-linenumber=\"1\">script</code>&gt;).</li>\n</ol>\n<p>If you followed through till now and got the result as shown, then congratulation! You just wrote your first JavaScript program. Although this is very basic, it is still an achievement because a journey of a thousand miles begins with a single step.</p>\n<div class=\"alert alert-info\" role=\"alert\"><strong>NOTE:</strong>&nbsp;There are other better ways to send output to the browser but for now&nbsp;<code data-linenumber=\"1\">documen.write()</code>&nbsp;should serve. We will introduce the rest as we progress.</div>', 1177, 'published', 'open', 0, 'first js program, first JavaScript program, first code', 'say_hello_in_javascript', 'Having introduced JavaScript briefly, the next best step for us to take is to fold up our sleeves and get dirty by writing our first code. I assure that you will learn more this way.', 11, '2020-08-21 22:07:52', '2024-07-06 16:18:17'),
(12, 1, 6, NULL, NULL, '', 'Where To Put JavaScript in HTML', '<p>You can put your JavaScript almost anywhere on your webpage but there is a few recommended ways to do it and that\'s what we will be considering.</p>\n<p>Basically, you have two kinds of scripts according to where they are written at:</p>\n<p><strong>Internal JavaScript</strong>: This is written within the opening and closing tag of the &lt;html&gt; root element a webpage.</p>\n<ul style=\"list-style-type: circle;\">\n<li>You can put it at the head section as you did in first JavaScript program</li>\n<li>You can put it within the body element as shown below:</li>\n</ul>\n<p>&nbsp;</p>\n<pre class=\"language-markup\" style=\"word-spacing: 0px;\"><code data-linenumber=1>&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n	&lt;head&gt;\n		&lt;title&gt;My Site&lt;/title&gt;\n	&lt;/head&gt;\n	&lt;body&gt;\n		&lt;script&gt;\n			document.write(\"Hello from here.\");\n		&lt;/script&gt;\n	&lt;/body&gt;\n&lt;/html&gt;</code></pre>\n<ul style=\"list-style-type: circle;\">\n<li>Or we can put it as element attribute as below:</li>\n</ul>\n<p>&nbsp;</p>\n<pre class=\"language-markup\" style=\"word-spacing: 0px;\"><code data-linenumber=1>&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n	&lt;head&gt;\n		&lt;title&gt;My Site&lt;/title&gt;\n	&lt;/head&gt;\n	&lt;body onload=\"document.write(\'Hello from here.\')\"&gt;\n	&lt;/body&gt;\n&lt;/html&gt;</code></pre>\n<p>The implementation of this last example of internal placement of JavaScript code is a bit different from the ealier two: the \"<code data-linenumber=\"1\">onload</code>\" attribute of the &lt;<code data-linenumber=\"1\">body</code>&gt; element is known as event in JavaScript (more on this later in this course). The code above in plain sentene is an instruction to the browser to display the message \"<code data-linenumber=\"1\">Hello from here.</code>\" to the webpage when the &lt;<code data-linenumber=\"1\">body</code>&gt; element is loaded.</p>\n<div class=\"alert alert-danger\" role=\"alert\">\n<p>As much as possible, avoid adding JavaScript as an attribute of html elements. It has disadvantages that will make your life much more difficult as your code grow in size.</p>\n</div>\n<p>Internal JavaScript is best when you are writing a script that will be used for only one page of your website. If one JavaScript code will be used in more than one page of your website, then internal JavaScript is a wrong way to go.</p>\n<p><strong>External JavaScript</strong>: This is the most efficient as it separates your JavaScript code from your HTML markup and therefore making it easier to maintain and use in multiple pages.</p>\n<p>To add an external JavaScript, you will still use the script tag as before (as in the head, body section) but this time around, it will have a \"src\" attribute pointing to the external JavaScript file.</p>\n<h3>How to Connect External JavaScript file to Your HTML Page</h3>\n<p>Assuming that you are saving your html file in a directory (folder) named projects:</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://www.donzoby.com/images/courses/javascript/dzb_00055_link-jsFile.png\" alt=\"\" width=\"582\" height=\"328\" /></p>\n<p>You can link to the JavaScript file by placing the below line at the&nbsp;<code data-linenumber=\"1\">head</code>&nbsp;section of your html file:</p>\n<p>&nbsp;</p>\n<pre class=\"language-markup\" style=\"word-spacing: 0px;\"><code data-linenumber=1>&lt;script src=\"hello.js\"&gt;&lt;/script&gt;</code></pre>\n<p>Then write the below JavaScript code in a new file and save it as&nbsp;<em>hello.js</em></p>\n<p>&nbsp;</p>\n<pre class=\"language-javascript\" style=\"word-spacing: 0px;\"><code data-linenumber=1>document.write(\"Hello from here.\");</code></pre>\n<div class=\"alert alert-info\" role=\"alert\">\n<p><strong>NOTE</strong>: When saving your JavaScript file, make sure it has a .js file extension so that it can be recognized and processed as a JavaScript file by the browser.</p>\n</div>\n<p>You can place external JavaScript at any place of your choice just like the internal JavaScript (except as an attribute of html).</p>', 1631, 'published', 'open', 0, 'js, where to put js, , where to put JavaScript, external js, internal js, js in element attribute', 'where_to_put_javascript_in_html', 'Deciding where to put your JavaScript code is vital and it\'s not such a hard choice to make. You have a couple of option regarding where to place your JS code: internal js or external js.', 12, '2020-08-21 22:10:37', '2024-07-06 16:18:17'),
(13, 1, 36, NULL, NULL, 'course-series', 'Introduction to PHP', '<p>PHP is a full featured programming language, easy to learn (unfortunately easy also to abuse), widely used and mainly used for back-end (server side) programming. It was created in 1994 by Ramsus Lerdorf.</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://www.donzoby.net/images/courses/php/dzb_00013_blobid0.png\" alt=\"\" width=\"698\" height=\"170\" /></p>\n<p>PHP initially stood for Personal Home Page but now stands for Hypertext Preprocessor.</p>\n<p>While PHP is used mainly for writing server-side codes/programs, it can also be used for other purposes such as building apps that runs outside of web server but because the original intention for creating PHP right from the beginning was for web programming, it is still best suited for that purpose.</p>\n<p>The aspect of PHP we shall be looking at here is the server-side programming aspect of it.</p>\n<p>Since it\'s a server-side language, it requires a web server to run. Unlike JavaScript that the browser can interpret without requiring any other tool, the browser cannot understand a PHP file.</p>\n<h3>How do we use PHP to build WebPages?</h3>\n<p>PHP is written on the server, interpreted by the server and then the output is sent to the client (browser) as HTML or other appropriate formats.</p>\n<p>From the above it is becoming clear that for us to write and run PHP codes, we need to have access to a web server and a PHP interpreter. Some personal computers (PCs) come with a server already installed and therefore the only additional thing for you to do is to install PHP. You can download and get PHP installation instructions from PHP\'s website at www.php.net.</p>\n<p>If you don&rsquo;t have a server already installed in your computer, you don\'t need to worry because setting up a web server alongside PHP has been greatly simplified by the help of some tools.</p>\n<p>There are several of such tools but I will recommend XAMPP server. It comes with Apache Server, PHP, MariaDB, Perl and MySQL (even includes phpMyAdmin for managing MySQL databases).</p>\n<p>To download and install XAMPP go to their webpage at www.apachefriends.org. They have installer for various platforms like Windows, Linux and OS X, download the one made for your operating system and install it.</p>\n<p>If you are done with the installation, then you are ready to start writing, executing&nbsp; and seeing the result of PHP code in your browser.</p>\n<h3>At what point would you need PHP?</h3>\n<p>You can build a webpage with structure, styling and interactivity using HTML, CSS and JavaScript only. The pages will look great and may even be all that some kind of websites require. But if you want go further into any of the following, then PHP can help:</p>\n<ul style=\"list-style-type: circle;\">\n<li>Collect users\' data for permanent storage</li>\n<li>Store data in database</li>\n<li>User authentication</li>\n<li>Work on files and directories</li>\n<li>Generate media on the fly etc</li>\n</ul>', 1142, 'published', 'open', 0, 'php, introduction to php, start programming in php', 'introduction_to_php', 'PHP Stand for Hypertext Preprocessor. It is a Server side scripting language, versatile, full-featured and easy to learn, write and deploy.', 13, '2020-08-21 22:12:58', '2024-07-20 16:57:06'),
(14, 1, 3, NULL, NULL, 'course-series', 'What is CorelDraw?', '<p>CorelDRAW is a vector graphics creator and editor developed by Alludo that is used to create a variety of graphics design works such as banners, signs, flyers, book covers, tracts, magazines etc.</p>\n<p>CorelDraw is beginners\' friendly and also used by seasoned graphics designers in the industry.</p>', 13, 'published', 'open', 0, 'corel draw, what is coreldraw', 'just_a_test_run', 'CorelDRAW is a vector graphics creator and editor developed by Alludo that is used to create a variety of graphic design works', 14, '2024-04-09 17:26:31', '2024-07-06 16:18:17'),
(15, 1, 1, NULL, NULL, 'course-series', 'What is Photoshop?', '<p>Adobe Photoshop is an image editor and graphics design software developed and published by Adobe.</p>\n<p>Photoshop is the industry leader in picture editing, image retouching, remixing, etc. It is so popular that it has been made into a \"verb\". An image can be said to have been \"photoshopped\".</p>\n<p>Although Photoshop is not free, you can rest assured that whatever amount you pay for it is worth the amount of image manipulation prowess packed into the product.</p>', 17, 'published', 'open', 0, 'adobe, photoshop', 'just_a_test_run1', 'Adobe Photoshop is an image editor and graphics design software developed and published by Adobe.', 15, '2024-04-09 18:06:49', '2024-07-06 16:18:17');
INSERT INTO `posts` (`id`, `author_id`, `subject_id`, `version`, `parent_id`, `type`, `topic`, `content`, `hits`, `status`, `comment_status`, `comment_count`, `tags`, `slug`, `description`, `sort_value`, `created_at`, `updated_at`) VALUES
(16, 1, 4, NULL, NULL, 'course-series', 'HTML Block Elements', '<p>Most HTML elements are defined as&nbsp;<strong>block </strong>or&nbsp;<strong>inline&nbsp;</strong>elements based on their display value. Block&nbsp; elements start from a new line and occupies all the available width of its parent element. </p>\n<p><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">Block elements take up the whole available width. To explain it further; block elements do not allow any other element to stay by their sides (left or right) by default, other neighboring elements can only be above or below them.</span></span></p>\n<h3><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">Examples of Block Elements</span></span></h3>\n<ul style=\"list-style-type: square;\">\n<li><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">main</span></span></li>\n<li><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">h1, h2, h3, h4, h5, h6</span></span></li>\n<li><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">div</span></span></li>\n<li><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">p</span></span></li>\n<li><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">table</span></span></li>\n<li><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">ul &amp; ol</span></span></li>\n<li><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">li</span></span></li>\n<li><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">form</span></span></li>\n<li><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">article</span></span></li>\n<li><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">aside</span></span></li>\n<li><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">section</span></span></li>\n<li><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">etc</span></span></li>\n</ul>\n<p><span style=\"font-family: Verdana, sans-serif;\"><span style=\"font-size: 15px;\">When you learn Cascading Style Sheet (CSS), you will know how to make any of the above-listed elements display in other forms different from \"block\".</span></span></p>', 117, 'published', 'open', 0, 'html, block element, html block element', 'html_block_elements', 'HTML block elements do not allow any other element to stay by their sides (left or right) by default, other neighboring elements can only be above or below them', 18, '2024-04-09 19:33:19', '2024-07-09 18:46:53'),
(17, 1, 2, NULL, NULL, 'course-series', 'Scale an Image with Gimp', '<p>When working with images, you do not always have the images in the exact size (dimensions) you want them to be. Not that there are some parts to throw away (in which case cropping will solve the problem) but rather it is that the size is either too small or too big for purpose.</p>\n<p>If we want to use Gimp to solve this kind of problem, then the tool we need is the <strong>scale</strong> tool. The scale tool is used to scale an image (increase or decrease the size without throwing away any part of the image).</p>\n<p>Consider the image below:</p>\n<p>The current dimension is 45px by 34px</p>\n<p>Let\'s say we want to increase the size of the image by 50%.&nbsp;</p>', 36, 'published', 'open', 0, 'gimp scale, scale an image, image scaling', 'just_a_test_run6', 'a simple way to scale an image using gimp', 2, '2024-04-12 12:10:20', '2024-07-06 19:26:13'),
(18, 1, 4, NULL, NULL, 'course-series', 'HTML Inline Elements', '<p class=\"MsoNormal\">Inline elements are normally without line breaks. They don\'t start on a new line and therefore other inline elements can be displayed by their side horizontally.</p>\n<p>These set of HTML elements only takes up the minimum amount of width required to fit their content. They allow other elements to stay side by side with them.</p>\n<h3>Examples of Inline HTML Elements:</h3>\n<ul style=\"list-style-type: square;\">\n<li>img</li>\n<li>span</li>\n<li>input</li>\n<li>a</li>\n<li>textarea</li>\n<li>etc</li>\n</ul>\n<p>You can use Cascading Style Sheet (CSS) to change the display format of any of the above-listed inline elements.</p>\n<div class=\"tw-flex\">&nbsp;</div>', 31, 'published', 'open', 0, 'inline element, html elements, html inline elements', 'just_a_test_run_html2', 'HTML inline elements don\'t start on a new line and therefore other inline elements can be displayed by their side horizontally', 16, '2024-04-17 14:37:46', '2024-07-19 20:59:18'),
(19, 1, 36, NULL, NULL, 'how-tos', 'How to Solve 403 Forbidden Error When Post Content Contain Inline Style', '<p>Being cheap is one of the main advantages of hosting a website on shared hosting (cPanel). Still, one of its main disadvantages is that you may not have access to certain server configurations that might be very important to you.</p>\n<p>When you are faced with this limitation, you may reach out to the shared hosting support team and they will help you out or in a worse-case scenario, you will have to find an alternative around what you are trying to achieve.</p>\n<p class=\"alert alert-info\" role=\"alert\"><strong>Note:</strong> This is specifically for websites whose backends are written in PHP or Laravel.</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://www.donzoby.net/images/courses/php/dzb_00019_blobid0.png\" alt=\"\" width=\"646\" height=\"119\" /></p>\n<p>If you are getting a 403 Forbidden error when trying to submit a form that contains an inline styling (like a textarea containing HTML elements), and you cannot (or you do not want) to contact your hosting company to change server configuration for, this post presents a simple workaround.</p>\n<h3>What is causing the problem?</h3>\n<p>The problem is that some shared hosting servers are configured in such a way as to reject incoming POST requests that contain a certain combination of strings (maybe for security reasons or so).</p>\n<p>So, if a request with the following input goes through:</p>\n<p><code>&lt;p&gt;</code></p>\n<div><code>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Pariatur quis laboriosam commodi, culpa officiis a quod dolores rerum provident velit tempora quisquam veritatis labore, omnis nobis ducimus delectus earum voluptatibus!</code></div>\n<p><code>&lt;/p&gt;</code></p>\n<p>But a request with the following input fails with 403 Forbidden error.</p>\n<p><code>&lt;p style=\"font-size: 16px\"&gt;</code></p>\n<div><code>Lorem, ipsum dolor sit amet consectetur adipisicing elit.&nbsp;Pariatur quis laboriosam commodi, culpa officiis a quod dolores rerum provident velit tempora quisquam veritatis labore, omnis nobis ducimus delectus earum voluptatibus!</code></div>\n<p><code>&lt;/p&gt;</code></p>\n<p>Your server is configured to reject a POST request containing the \'style\' attribute.</p>\n<h3>The solution</h3>\n<p>The best solution is to safely configure your server to allow this type of request. In this way, you will not need to write any extra line of code to accomplish the same result as the second option below.</p>\n<p>The second option will cost two additional lines of code:</p>\n<ol class=\"tw-list-decimal\">\n<li>The line on the front end using JavaScript to replace the \'style\' attribute with another string (for example xstyle).<br />\n<pre class=\"language-javascript\"><code>let htmlString = `&lt;p style=\"font-size: 16px\"&gt;hello world ...&lt;/p&gt;`;\nconst stringToSubmit = htmlString.replaceAll(\"style=\", \"xstyle\");​</code></pre>\n</li>\n<li>The line on the backend to change back to the \'style\' attribute<br />\n<pre class=\"language-php\"><code>$html_string = str_replace(\'style=\', \'style=\', $_POST[\'stringToSubmit\']);​</code></pre>\n</li>\n</ol>\n<p><strong>Extra tip for Laravel:</strong> If you are using <a title=\"Laravel website\" href=\"https://laravel.com/\">Laravel</a> (PHP framework) at the back end, there is an even better way to do step two above, and that is by defining an attribute mutator in your eloquent model. This way, you will not have to replace it in multiple places.</p>', 0, 'published', 'open', 0, '403 forbidden, post request inline style failure,', 'how_to_solve_403_forbidden_error_when_post_content_contain_inline_style', 'This is a solution specifically for when a post request made to a PHP back end fails because the submitted content contains a certain combination of strings.', 0, '2024-07-19 22:12:15', '2024-07-20 16:20:23'),
(20, 1, 36, NULL, NULL, 'how-tos', 'PHP Data Types', '<p>Being cheap is one of the main advantages of hosting a website on shared hosting (cPanel). Still, one of its main disadvantages is that you may not have access to certain server configurations that might be very important to you.</p>\n<p>When you are faced with this limitation, you may reach out to the shared hosting support team and they will help you out or in a worse-case scenario, you will have to find an alternative around what you are trying to achieve.</p>\n<p>Note: This is specifically for websites whose backends are written in PHP or Laravel.</p>\n<p>If you are getting a 403 Forbidden error when trying to submit a form that contains an inline styling (like a textarea containing HTML elements), and you cannot (or you do not want) to contact your hosting company to change server configuration for, this post presents a simple workaround.</p>\n<h3>What is causing the problem?</h3>\n<p>The problem is that some shared hosting servers are configured in such a way as to reject incoming POST requests that contain a certain combination of strings (maybe for security reasons or so).</p>\n<p>So, if a request with the following input goes through:</p>\n<p><code>&lt;p&gt;</code></p>\n<div><code>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Pariatur quis laboriosam commodi, culpa officiis a quod dolores rerum provident velit tempora quisquam veritatis labore, omnis nobis ducimus delectus earum voluptatibus!</code></div>\n<p><code>&lt;/p&gt;</code></p>\n<p>But a request with the following input fails with 403 Forbidden error.</p>\n<p><code>&lt;p style=\"font-size: 16px\"&gt;</code></p>\n<div><code>Lorem, ipsum dolor sit amet consectetur adipisicing elit.&nbsp;Pariatur quis laboriosam commodi, culpa officiis a quod dolores rerum provident velit tempora quisquam veritatis labore, omnis nobis ducimus delectus earum voluptatibus!</code></div>\n<p><code>&lt;/p&gt;</code></p>\n<p>Your server is configured to reject a POST request containing the \'style\' attribute.</p>\n<h3>The solution</h3>\n<p>The best solution is to safely configure your server to allow this type of request. In this way, you will not need to write any extra line of code to accomplish the same result as the second option below.</p>\n<p>The second option will cost two additional lines of code:</p>\n<ol class=\"tw-list-decimal\">\n<li>The line on the front end using JavaScript to replace the \'style\' attribute with another string (for example xstyle).<br />\n<pre class=\"language-javascript\"><code>let htmlString = `&lt;p style=\"font-size: 16px\"&gt;hello world ...&lt;/p&gt;`;\nconst stringToSubmit = htmlString.replaceAll(\"style=\", \"xstyle\");​</code></pre>\n</li>\n<li>The line on the backend to change back to the \'style\' attribute<br />\n<pre class=\"language-php\"><code>$html_string = str_replace(\'xstyle=\', \'style=\', $_POST[\'stringToSubmit\']);​</code></pre>\n</li>\n</ol>\n<p><strong>Extra tip for Laravel:</strong> If you are using Laravel (PHP framework) at the back end, there is an even better way to do step two above, and that is by defining an attribute mutator in your eloquent model. This way, you will not have to replace it in multiple places.</p>', 0, 'published', 'open', 0, '403 forbidden, post request inline style failure,', 'php_data_types', 'This is a solution specifically for when a post request made to a PHP back end fails because the submitted content contains a certain combination of strings.', 0, '2024-07-19 22:15:50', '2024-07-21 07:25:35'),
(21, 1, 6, NULL, NULL, 'course-series', 'JavaScript Data Types', '<p>What is happening to all of mankind?</p>\n<p><img src=\"http://www.donzoby.net/images/courses/javascript/dzb_00021_blobid1.png\" alt=\"\" width=\"698\" height=\"170\" /></p>\n<table class=\"ws-table-all\" style=\"box-sizing: inherit; border-collapse: collapse; border-spacing: 0px; width: 663px; border: 1px solid #cccccc; margin: 20px 0px; font-family: Verdana, sans-serif; font-size: 15px; height: 45px;\">\n<tbody style=\"box-sizing: inherit;\">\n<tr style=\"box-sizing: inherit; border-bottom: 1px solid #dddddd;\">\n<td style=\"box-sizing: inherit; padding: 8px; vertical-align: top; width: 793.65px;\">Returns the key of a value if it is found in the array, and FALSE otherwise. If the value is found in the array more than once, the first matching key is returned.</td>\n</tr>\n</tbody>\n</table>\n<p><img src=\"http://www.donzoby.net/images/courses/javascript/dzb_00021_blobid0.png\" alt=\"\" width=\"569\" height=\"105\" /></p>\n<table class=\"ws-table-all\" style=\"box-sizing: inherit; border-collapse: collapse; border-spacing: 0px; width: 664px; border: 1px solid #cccccc; margin: 20px 0px; font-family: Verdana, sans-serif; font-size: 15px; height: 66px;\">\n<tbody style=\"box-sizing: inherit;\">\n<tr style=\"box-sizing: inherit; border-bottom: 1px solid #dddddd;\">\n<td style=\"box-sizing: inherit; padding: 8px; vertical-align: top; width: 793.65px;\">Returns the key of a value if it is found in the array, and FALSE otherwise. The first matching key is returned if the value is found in the array more than once.</td>\n</tr>\n</tbody>\n</table>\n<p><img src=\"http://www.donzoby.net/images/courses/javascript/dzb_00021_blobid2.png\" alt=\"\" width=\"698\" height=\"170\" /></p>\n<p>I am curious but before trying to solve a problem, let me verify that actually, it is a problem.</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>', 0, 'published', 'open', 0, 'inline element, html elements, html inline elements', 'javascript_data_types', 'Returns the key of a value if it is found in the array, and FALSE otherwise. If the value is found in the array more than once, the first matching key is returned.', 0, '2024-07-22 11:34:53', '2024-07-28 07:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE `post_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) NOT NULL,
  `dimension` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`dimension`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_images`
--

INSERT INTO `post_images` (`id`, `post_id`, `link`, `dimension`, `created_at`, `updated_at`) VALUES
(3, 1, 'images/courses/javascript/dzb-web-design.png', NULL, '2018-12-25 21:44:40', '2024-04-08 14:28:10'),
(11, 2, 'images/courses/gimp/crop-image.png', NULL, '2019-01-03 05:49:17', '2024-04-08 14:28:10'),
(12, 2, 'images/courses/gimp/select-crop-portion.png', NULL, '2019-01-03 05:49:17', '2024-04-08 14:28:10'),
(13, 2, 'images/courses/gimp/crop-image-result.png', NULL, '2019-01-03 05:49:17', '2024-04-08 14:28:10'),
(15, 5, 'images/courses/service-providers/glo_night_data_new.jpg', NULL, '2019-12-18 06:33:05', '2024-04-08 14:28:10'),
(16, 6, 'images/courses/service-providers/glo_data_balance.png', NULL, '2020-03-06 00:43:24', '2024-04-08 14:28:10'),
(18, 8, 'images/courses/html/dzb_00051_sublime-editor.png', NULL, '2020-07-16 19:31:26', '2024-04-08 14:28:10'),
(19, 3, 'images/courses/service-providers/dzb_00046_glo-free-youtube-data.png', NULL, '2020-07-16 20:25:00', '2024-04-08 14:28:10'),
(21, 9, 'images/courses/html/dzb_00052_first-site-result.png', NULL, '2020-07-22 07:17:15', '2024-04-08 14:28:10'),
(22, 10, 'images/courses/html/dzb_00053_element-structure.png', NULL, '2020-07-23 17:43:38', '2024-04-08 14:28:10'),
(23, 11, 'images/courses/javascript/dzb_00054_first-js.png', NULL, '2020-08-21 22:07:52', '2024-04-08 14:28:10'),
(24, 12, 'images/courses/javascript/dzb_00055_link-jsfile.png', NULL, '2020-08-21 22:10:37', '2024-04-08 14:28:10'),
(25, 19, 'images/courses/php/dzb_00019_blobid0.png', NULL, '2024-07-20 16:19:50', '2024-07-20 16:19:50'),
(26, 19, 'images/courses/php/dzb_00019_blobid0.png', NULL, '2024-07-20 16:20:23', '2024-07-20 16:20:23'),
(27, 13, 'images/courses/php/dzb_00013_blobid0.png', NULL, '2024-07-20 16:57:06', '2024-07-20 16:57:06'),
(140, 21, 'images/courses/javascript/dzb_00021_blobid0.png', NULL, '2024-07-28 06:54:53', '2024-07-28 06:54:53'),
(141, 21, 'images/courses/javascript/dzb_00021_blobid0.png', NULL, '2024-07-28 06:54:54', '2024-07-28 06:54:54'),
(142, 21, 'images/courses/javascript/dzb_00021_blobid1.png', NULL, '2024-07-28 07:00:44', '2024-07-28 07:00:44'),
(143, 21, 'images/courses/javascript/dzb_00021_blobid2.png', NULL, '2024-07-28 07:00:44', '2024-07-28 07:00:44'),
(144, 21, 'images/courses/javascript/dzb_00021_blobid1.png', NULL, '2024-07-28 07:00:44', '2024-07-28 07:00:44'),
(145, 21, 'images/courses/javascript/dzb_00021_blobid2.png', NULL, '2024-07-28 07:00:44', '2024-07-28 07:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `post_syncs`
--

CREATE TABLE `post_syncs` (
  `id` char(36) NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `what_changed` text NOT NULL,
  `synced` tinyint(1) NOT NULL DEFAULT 0,
  `sync_attempts` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_syncs`
--

INSERT INTO `post_syncs` (`id`, `post_id`, `what_changed`, `synced`, `sync_attempts`, `created_at`, `updated_at`) VALUES
('9c983752-3768-4c15-b873-3fb14b0538ea', 21, 'What is up', 0, 0, '2024-07-23 23:02:50', '2024-07-23 23:02:50'),
('9c98a828-2373-4548-8911-4282f0fdc761', 21, '[\"content\"]', 0, 0, '2024-07-24 04:18:21', '2024-07-24 04:18:21'),
('9c98b274-21a6-4ba7-8dcf-74b3f4b0360b', 21, '[\"images\",\"content\"]', 0, 0, '2024-07-24 04:47:09', '2024-07-24 04:47:09'),
('9c98b303-cd4e-4f1d-b816-d63105ad1bdd', 21, '[\"images\",\"content\"]', 0, 0, '2024-07-24 04:48:43', '2024-07-24 04:48:43'),
('9c98b3a7-b681-4a1a-8472-d932882cf687', 21, '[\"content\"]', 0, 0, '2024-07-24 04:50:30', '2024-07-24 04:50:30'),
('9c98b3dc-0cf3-4e85-8833-8d048a14e6ce', 21, '[\"images\",\"content\"]', 0, 0, '2024-07-24 04:51:05', '2024-07-24 04:51:05'),
('9c98b448-9e8f-484f-a601-314ac6bf3df1', 21, '[\"images\",\"content\"]', 0, 0, '2024-07-24 04:52:16', '2024-07-24 04:52:16'),
('9c98bbf5-809e-4305-b234-a2f3248f7a04', 21, '[\"content\"]', 0, 0, '2024-07-24 05:13:43', '2024-07-24 05:13:43'),
('9c98bc50-6e1b-43a8-a6d5-ecdc41d26a5a', 21, '[\"images\",\"content\"]', 0, 0, '2024-07-24 05:14:43', '2024-07-24 05:14:43'),
('9c98bca2-f7b3-4334-8343-733223f9c858', 21, '[\"images\",\"content\"]', 0, 0, '2024-07-24 05:15:37', '2024-07-24 05:15:37'),
('9c98bd45-4755-4566-b1ed-1a854ffb7fc8', 21, '[\"content\"]', 0, 0, '2024-07-24 05:17:23', '2024-07-24 05:17:23'),
('9c98bd81-f2cd-418c-b198-87f6f051ba85', 21, '[\"images\",\"content\"]', 0, 0, '2024-07-24 05:18:03', '2024-07-24 05:18:03'),
('9c98bdc3-5edb-459d-b22f-8a2555229293', 21, '[\"images\",\"content\"]', 0, 0, '2024-07-24 05:18:46', '2024-07-24 05:18:46'),
('9c98bdf1-9701-490b-9ad8-da87eeb5c74a', 21, '[\"content\"]', 0, 0, '2024-07-24 05:19:16', '2024-07-24 05:19:16'),
('9c98be95-76a2-4b1b-b2cd-f97ae3b09fb5', 21, '[\"images\",\"content\"]', 0, 0, '2024-07-24 05:21:04', '2024-07-24 05:21:04'),
('9c98c65c-ade3-4c1c-844a-fc1741a33fb7', 21, '[\"images\",\"content\"]', 0, 0, '2024-07-24 05:42:49', '2024-07-24 05:42:49'),
('9c98f65d-955d-46e4-8177-032bc78457ae', 21, '[\"content\"]', 0, 0, '2024-07-24 07:57:02', '2024-07-24 07:57:02'),
('9c98f686-e5ed-4499-98db-236e24b7be4d', 21, '[\"content\"]', 0, 0, '2024-07-24 07:57:29', '2024-07-24 07:57:29'),
('9c98f860-5ac5-426e-a68d-e1de1a199a07', 21, '[\"content\"]', 0, 0, '2024-07-24 08:02:40', '2024-07-24 08:02:40'),
('9c994459-31e8-4aa5-8059-0f3b74422baf', 21, '[\"content\"]', 0, 0, '2024-07-24 11:35:06', '2024-07-24 11:35:06'),
('9c99450a-47a4-4c23-b682-c96067105a36', 21, '[\"images\",\"content\"]', 0, 0, '2024-07-24 11:37:02', '2024-07-24 11:37:02'),
('9c9958e2-c59a-4905-a51d-d536cc4c569a', 21, '[\"content\"]', 0, 0, '2024-07-24 12:32:31', '2024-07-24 12:32:31'),
('9c995eac-9311-4e3b-8242-4852abb4d441', 21, '[\"content\"]', 0, 0, '2024-07-24 12:48:42', '2024-07-24 12:48:42'),
('9c995fc2-2b0f-4bda-bdc7-e9e19dda03d6', 21, '[\"content\"]', 0, 0, '2024-07-24 12:51:44', '2024-07-24 12:51:44'),
('9c996035-540e-47ea-8c22-ff1571f0fe9f', 21, '[\"content\"]', 0, 0, '2024-07-24 12:53:00', '2024-07-24 12:53:00'),
('9c996043-2a03-4bd4-9cbe-59614818fe46', 21, '[\"content\"]', 0, 0, '2024-07-24 12:53:09', '2024-07-24 12:53:09'),
('9c9961d0-376c-4840-8c62-f80639ab10a1', 21, '[\"content\",\"images\",\"content\"]', 0, 0, '2024-07-24 12:57:29', '2024-07-24 12:57:29'),
('9c996241-6c7e-4408-88e4-618183add857', 21, '[\"content\"]', 0, 0, '2024-07-24 12:58:43', '2024-07-24 12:58:43'),
('9c996356-3162-4d6a-afe5-94b6b98b0187', 21, '[\"images\",\"content\"]', 0, 0, '2024-07-24 13:01:45', '2024-07-24 13:01:45'),
('9c9963ad-9cee-4a38-afef-81ff1ecf68cf', 21, '[\"content\"]', 0, 0, '2024-07-24 13:02:42', '2024-07-24 13:02:42'),
('9c9963cf-965a-49d7-9bfe-cc95bb2538ff', 21, '[\"content\",\"images\",\"content\"]', 0, 0, '2024-07-24 13:03:04', '2024-07-24 13:03:04'),
('9c9963fb-1dd5-4342-888b-60c7940de392', 21, '[\"content\",\"images\",\"content\"]', 0, 0, '2024-07-24 13:03:33', '2024-07-24 13:03:33'),
('9c996e55-b22c-4d2e-b215-5fb3edd87a7f', 21, '[\"content\",\"images\",\"content\"]', 0, 0, '2024-07-24 13:32:30', '2024-07-24 13:32:30'),
('9c996e79-b3a9-4f30-985d-472305a5ca24', 21, '[\"content\",\"images\",\"content\"]', 0, 0, '2024-07-24 13:32:53', '2024-07-24 13:32:53'),
('9c996f44-641b-4417-85d5-48da7765f24e', 21, '[\"content\",\"images\",\"content\"]', 0, 0, '2024-07-24 13:35:06', '2024-07-24 13:35:06'),
('9c996f7f-f524-4a4b-a51d-43a2f8981228', 21, '[\"content\"]', 0, 0, '2024-07-24 13:35:45', '2024-07-24 13:35:45'),
('9c996f8f-9510-4dca-9d81-d9c43d8051e7', 21, '[\"content\"]', 0, 0, '2024-07-24 13:35:56', '2024-07-24 13:35:56'),
('9c996fee-a738-45a1-b65f-b732087ffdc5', 21, '[\"topic\"]', 0, 0, '2024-07-24 13:36:58', '2024-07-24 13:36:58'),
('9c997010-33e1-4cab-ba6a-9ba65f71f521', 21, '[\"topic\",\"content\"]', 0, 0, '2024-07-24 13:37:20', '2024-07-24 13:37:20'),
('9c999ad1-8e61-4155-a961-923258f3a267', 21, '[\"content\"]', 0, 0, '2024-07-24 15:36:53', '2024-07-24 15:36:53'),
('9c999aeb-563d-4418-a4f4-462c12910361', 21, '[\"content\",\"description\",\"tags\"]', 0, 0, '2024-07-24 15:37:10', '2024-07-24 15:37:10'),
('9c999b07-8983-44f8-b3ba-4e35375ec240', 21, '[\"topic\",\"content\",\"description\",\"tags\"]', 0, 0, '2024-07-24 15:37:28', '2024-07-24 15:37:28'),
('9c999ca7-6e89-475e-97d6-67b62d1ce1c6', 21, '[\"topic\"]', 0, 0, '2024-07-24 15:42:01', '2024-07-24 15:42:01'),
('9c99a092-6bb8-48a4-b023-f57f1a5e0499', 21, '[\"content\"]', 0, 0, '2024-07-24 15:52:58', '2024-07-24 15:52:58'),
('9c99a0e6-63b3-4ca1-9bc0-b0502fe0d157', 21, '[\"content\"]', 0, 0, '2024-07-24 15:53:53', '2024-07-24 15:53:53'),
('9c99a16a-d3c3-446c-b154-07bb820b2ee2', 21, '[\"content\"]', 0, 0, '2024-07-24 15:55:20', '2024-07-24 15:55:20'),
('9c99a2e3-dde3-48b9-9990-9b0cd11e4cf1', 21, '[\"content\"]', 0, 0, '2024-07-24 15:59:27', '2024-07-24 15:59:27'),
('9c99a322-fc72-41df-b04c-68674b30f0eb', 21, '[\"content\"]', 0, 0, '2024-07-24 16:00:09', '2024-07-24 16:00:09'),
('9c99a46b-dc1a-497f-b83d-933503faab66', 21, '[\"content\"]', 0, 0, '2024-07-24 16:03:44', '2024-07-24 16:03:44'),
('9c99a8bf-294f-4334-a771-f015b505ea6b', 21, '[\"content\"]', 0, 0, '2024-07-24 16:15:50', '2024-07-24 16:15:50'),
('9c99a953-fd83-4f88-8b46-4452e597d22a', 21, '[\"content\"]', 0, 0, '2024-07-24 16:17:27', '2024-07-24 16:17:27'),
('9c99aa7a-79f8-46e9-acc2-c264647b6d32', 21, '[\"content\"]', 0, 0, '2024-07-24 16:20:40', '2024-07-24 16:20:40'),
('9c99aaf0-e8a0-4d97-8c30-e7bfcb85e0ce', 21, '[\"content\"]', 0, 0, '2024-07-24 16:21:58', '2024-07-24 16:21:58'),
('9c99d98a-a6d7-44a6-acb4-be81340b59c9', 21, '[\"content\"]', 0, 0, '2024-07-24 18:32:16', '2024-07-24 18:32:16'),
('9c99dae0-ae57-4900-b247-009f5f5a1bf1', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-24 18:36:00', '2024-07-24 18:36:00'),
('9c99db48-6aa8-4644-9e7a-095d0bd259d0', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"],\"added_images\":[]}', 0, 0, '2024-07-24 18:37:08', '2024-07-24 18:37:08'),
('9c99df38-1090-40c7-9e9c-9982817e417f', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"]}', 0, 0, '2024-07-24 18:48:09', '2024-07-24 18:48:09'),
('9c99e0e2-6de3-41b5-9b10-19cbdd1d933c', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"],\"added_images\":[]}', 0, 0, '2024-07-24 18:52:48', '2024-07-24 18:52:48'),
('9c99ea16-cc1c-4219-894b-5e771260a166', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-24 19:18:32', '2024-07-24 19:18:32'),
('9c99eb84-3c69-4787-b1a4-b65bdb7488a5', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"]}', 0, 0, '2024-07-24 19:22:32', '2024-07-24 19:22:32'),
('9c9ad0ec-d000-4c44-80f5-d97b566d74bd', 21, '[\"content\"]', 0, 0, '2024-07-25 06:04:00', '2024-07-25 06:04:00'),
('9c9ad188-455b-46f7-af57-24f52fbf4443', 21, '[\"content\"]', 0, 0, '2024-07-25 06:05:42', '2024-07-25 06:05:42'),
('9c9ad244-aece-410f-b262-a670e6e7dd53', 21, '[\"content\"]', 0, 0, '2024-07-25 06:07:46', '2024-07-25 06:07:46'),
('9c9adf4c-592b-4c04-a34d-2d46f9c7bd39', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid3.png\"]}', 0, 0, '2024-07-25 06:44:12', '2024-07-25 06:44:12'),
('9c9ae537-5e08-4437-af54-2f7ac20aee67', 21, '[\"content\"]', 0, 0, '2024-07-25 07:00:45', '2024-07-25 07:00:45'),
('9c9ae62b-012a-41a4-841f-814615626953', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\"]}', 0, 0, '2024-07-25 07:03:24', '2024-07-25 07:03:24'),
('9c9ae9ae-d35a-4bbb-9b63-06e772bc4bc5', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-25 07:13:14', '2024-07-25 07:13:14'),
('9c9d66d5-a9c1-4e24-a3a2-12357a5b506a', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"]}', 0, 0, '2024-07-26 12:54:50', '2024-07-26 12:54:50'),
('9c9d692f-d6fd-464f-b249-fb0d7c1552b4', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"],\"added_images\":[]}', 0, 0, '2024-07-26 13:01:25', '2024-07-26 13:01:25'),
('9c9d6b34-a332-4b02-bf68-d2201ee202e5', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-26 13:07:04', '2024-07-26 13:07:04'),
('9c9d6c29-c6b8-417e-a2b3-749f6860b206', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"],\"added_images\":[]}', 0, 0, '2024-07-26 13:09:44', '2024-07-26 13:09:44'),
('9c9d6d05-3f2e-41fe-a297-bfeb0db5e590', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\"]}', 0, 0, '2024-07-26 13:12:08', '2024-07-26 13:12:08'),
('9c9d7051-fb3c-4c8c-a44b-865d3cb9f4e9', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-26 13:21:22', '2024-07-26 13:21:22'),
('9c9d75a4-ba04-4010-aad2-7a5594d4b2be', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"],\"added_images\":[]}', 0, 0, '2024-07-26 13:36:15', '2024-07-26 13:36:15'),
('9c9d75e7-d442-4e86-8f7a-ceeff086dcda', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\"]}', 0, 0, '2024-07-26 13:36:59', '2024-07-26 13:36:59'),
('9c9d768b-03da-4c84-8c83-3520b16c418c', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-26 13:38:46', '2024-07-26 13:38:46'),
('9c9d777a-822a-4fb7-bcb5-d3c8e7c8829a', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"]}', 0, 0, '2024-07-26 13:41:23', '2024-07-26 13:41:23'),
('9c9d77e5-334f-4639-9fe4-d5a86ffc3db3', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"],\"added_images\":[]}', 0, 0, '2024-07-26 13:42:33', '2024-07-26 13:42:33'),
('9c9d7830-c698-4fcd-8b8e-5940330b7a52', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\"]}', 0, 0, '2024-07-26 13:43:22', '2024-07-26 13:43:22'),
('9c9d78c5-6e43-4e3c-ac3b-246d40decea5', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-26 13:45:00', '2024-07-26 13:45:00'),
('9c9d79ee-0f57-4e47-80b0-a433946661c6', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid3.png\"]}', 0, 0, '2024-07-26 13:48:14', '2024-07-26 13:48:14'),
('9c9d8c55-0e15-460e-a5f5-27abedfbac66', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\"]}', 0, 0, '2024-07-26 14:39:41', '2024-07-26 14:39:41'),
('9c9d8e63-b713-473b-b04c-1caca1568fe6', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-26 14:45:26', '2024-07-26 14:45:26'),
('9c9d8f68-93d6-4214-9559-ed5da2585f85', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"]}', 0, 0, '2024-07-26 14:48:17', '2024-07-26 14:48:17'),
('9c9d902e-bb9c-4956-9ea2-0b1677898f5a', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"],\"added_images\":[]}', 0, 0, '2024-07-26 14:50:27', '2024-07-26 14:50:27'),
('9c9d9110-d46d-4bf3-865f-cdc934e10058', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\"]}', 0, 0, '2024-07-26 14:52:55', '2024-07-26 14:52:55'),
('9c9d923e-0916-4e9c-bd01-b4e89f6d698f', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-26 14:56:13', '2024-07-26 14:56:13'),
('9c9d92e7-98f7-40c7-af19-34a9a21527d1', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"]}', 0, 0, '2024-07-26 14:58:04', '2024-07-26 14:58:04'),
('9c9d9efd-4582-4e4e-a4e7-ac0132d6c5a5', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\"],\"added_images\":[]}', 0, 0, '2024-07-26 15:31:51', '2024-07-26 15:31:51'),
('9c9da127-d0cb-4906-bd95-b1ff486e66f8', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"],\"added_images\":[]}', 0, 0, '2024-07-26 15:37:55', '2024-07-26 15:37:55'),
('9c9da234-8226-4d54-99b1-e5a390a9fa74', 21, '[\"content\"]', 0, 0, '2024-07-26 15:40:51', '2024-07-26 15:40:51'),
('9c9da247-fd92-4348-841f-cae57cffcd03', 21, '[\"content\"]', 0, 0, '2024-07-26 15:41:04', '2024-07-26 15:41:04'),
('9c9da2ae-9afc-4d5c-bfc8-202b029d76b7', 21, '[\"content\"]', 0, 0, '2024-07-26 15:42:11', '2024-07-26 15:42:11'),
('9c9da334-4e35-451b-bb41-1da801651852', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"],\"added_images\":[]}', 0, 0, '2024-07-26 15:43:39', '2024-07-26 15:43:39'),
('9c9da35a-4a88-4743-b2f5-bd3927a0851c', 21, '[\"content\"]', 0, 0, '2024-07-26 15:44:04', '2024-07-26 15:44:04'),
('9c9da36e-49d8-4995-b8de-2a468c391a93', 21, '[\"content\"]', 0, 0, '2024-07-26 15:44:17', '2024-07-26 15:44:17'),
('9c9da3e9-af5c-4fea-8e8e-a9df6c036d04', 21, '[\"content\"]', 0, 0, '2024-07-26 15:45:38', '2024-07-26 15:45:38'),
('9c9ee109-b8dc-4742-bfff-4404e3c97b7f', 21, '[\"content\"]', 0, 0, '2024-07-27 06:32:22', '2024-07-27 06:32:22'),
('9c9ee20b-ee1a-4e1e-9db6-cd4f32c7d45d', 21, '[\"content\"]', 0, 0, '2024-07-27 06:35:11', '2024-07-27 06:35:11'),
('9c9ee2b4-ca52-4c1c-a325-6c80ee86a878', 21, '[\"content\"]', 0, 0, '2024-07-27 06:37:02', '2024-07-27 06:37:02'),
('9c9ee329-7e0c-45dd-8b62-1c72c3bcdb6f', 21, '[\"content\"]', 0, 0, '2024-07-27 06:38:19', '2024-07-27 06:38:19'),
('9c9ee37c-1877-4fe7-809e-6bb0f28932a7', 21, '[\"content\"]', 0, 0, '2024-07-27 06:39:13', '2024-07-27 06:39:13'),
('9c9ee3b4-314f-496d-9a3e-625dc71cc39f', 21, '[\"content\"]', 0, 0, '2024-07-27 06:39:50', '2024-07-27 06:39:50'),
('9c9ee3e6-7b25-42e0-aeae-e34d6ca2bc3a', 21, '[\"content\"]', 0, 0, '2024-07-27 06:40:23', '2024-07-27 06:40:23'),
('9c9ee46a-e6c4-4dba-b388-ccce53bca5ca', 21, '[\"content\",\"tags\"]', 0, 0, '2024-07-27 06:41:49', '2024-07-27 06:41:49'),
('9c9ee57c-d7e1-4ef0-a278-6fb69274eed6', 21, '[\"tags\"]', 0, 0, '2024-07-27 06:44:49', '2024-07-27 06:44:49'),
('9c9ee984-0b4b-432a-9d07-ad233929f1e4', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\"]}', 0, 0, '2024-07-27 06:56:05', '2024-07-27 06:56:05'),
('9c9f2b28-c0b9-4cc1-8f43-b764cc777751', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-27 09:59:38', '2024-07-27 09:59:38'),
('9c9f2fac-a93d-4dfb-bf3b-c3fb660f9b6b', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"],\"added_images\":[]}', 0, 0, '2024-07-27 10:12:15', '2024-07-27 10:12:15'),
('9c9f32b8-0ba5-45de-b8cc-4bbbffa24921', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\"]}', 0, 0, '2024-07-27 10:20:46', '2024-07-27 10:20:46'),
('9c9f3519-ed35-4fe5-92f1-24d7ae2d5c1f', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"]}', 0, 0, '2024-07-27 10:27:26', '2024-07-27 10:27:26'),
('9ca0bed7-124d-4cf8-96ca-158a8536893a', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"],\"added_images\":[]}', 0, 0, '2024-07-28 04:48:24', '2024-07-28 04:48:24'),
('9ca0bf87-dd86-4d77-92b6-98ba4a1c0596', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-28 04:50:20', '2024-07-28 04:50:20'),
('9ca0bfca-8c72-45b7-8510-3e9836bfcf6a', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"],\"added_images\":[]}', 0, 0, '2024-07-28 04:51:04', '2024-07-28 04:51:04'),
('9ca0c249-b689-4713-a29b-4d1b357f8619', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-28 04:58:03', '2024-07-28 04:58:03'),
('9ca0c446-b2e8-4359-addf-7ed198db48f1', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"],\"added_images\":[]}', 0, 0, '2024-07-28 05:03:36', '2024-07-28 05:03:36'),
('9ca0c51f-cfbb-4a00-b4e6-6914f767c84b', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-28 05:05:58', '2024-07-28 05:05:58'),
('9ca0c822-66d8-4745-809a-83644a576ee8', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"]}', 0, 0, '2024-07-28 05:14:23', '2024-07-28 05:14:23'),
('9ca0c877-8b15-45b8-8e2c-0856f429c9c2', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"],\"added_images\":[]}', 0, 0, '2024-07-28 05:15:19', '2024-07-28 05:15:19'),
('9ca0c93b-9d51-4896-842e-aef9c0ae9ba2', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-28 05:17:28', '2024-07-28 05:17:28'),
('9ca0cb01-bdef-431c-968a-7dd8292d368a', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"],\"added_images\":[]}', 0, 0, '2024-07-28 05:22:25', '2024-07-28 05:22:25'),
('9ca0cb78-b2aa-4b49-b6f6-b81a8dd7ed57', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-28 05:23:43', '2024-07-28 05:23:43'),
('9ca0cdda-d5c2-4ce3-9e1a-a81e646f270c', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"],\"added_images\":[]}', 0, 0, '2024-07-28 05:30:23', '2024-07-28 05:30:23'),
('9ca0ce28-9b31-40a8-bde8-a9961b7fb9a3', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-28 05:31:14', '2024-07-28 05:31:14'),
('9ca0cf6a-5c0b-4cd6-bd97-958955db9da1', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid3.png\"]}', 0, 0, '2024-07-28 05:34:45', '2024-07-28 05:34:45'),
('9ca0d0eb-77d2-4995-99d8-4e0294eed241', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid3.png\"],\"added_images\":[]}', 0, 0, '2024-07-28 05:38:57', '2024-07-28 05:38:57'),
('9ca0d123-e85e-49f8-8562-e6daca02cfe1', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-28 05:39:34', '2024-07-28 05:39:34'),
('9ca0d369-6a4c-4a5b-9198-2eecc07fd2ec', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid3.png\"]}', 0, 0, '2024-07-28 05:45:56', '2024-07-28 05:45:56'),
('9ca0d537-8e7d-4167-b202-2a0fb88de850', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid4.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid5.png\"]}', 0, 0, '2024-07-28 05:50:58', '2024-07-28 05:50:58'),
('9ca0d5cf-dd82-41c8-80d4-8c0e7e40c3e1', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid3.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid4.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid5.png\"],\"added_images\":[]}', 0, 0, '2024-07-28 05:52:38', '2024-07-28 05:52:38'),
('9ca0d625-a7ba-459c-b9d4-ad6e947b5506', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\"]}', 0, 0, '2024-07-28 05:53:34', '2024-07-28 05:53:34'),
('9ca0d661-6412-42ee-9c37-e9ea170e8861', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\"],\"added_images\":[]}', 0, 0, '2024-07-28 05:54:14', '2024-07-28 05:54:14'),
('9ca0d6b0-cbec-423e-b51a-eaa74e40577f', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-28 05:55:06', '2024-07-28 05:55:06'),
('9ca0df02-3662-4c3c-80cc-6befaaa95637', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"],\"added_images\":[]}', 0, 0, '2024-07-28 06:18:21', '2024-07-28 06:18:21'),
('9ca0dfa1-edd0-4c16-8667-5cbe17c7f7ee', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-28 06:20:06', '2024-07-28 06:20:06'),
('9ca0e7fb-97d9-4bc6-aff1-053e1e0161c4', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"]}', 0, 0, '2024-07-28 06:43:27', '2024-07-28 06:43:27'),
('9ca0e8bd-2384-4f6c-9b13-b7d9b83b5018', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid3.png\"]}', 0, 0, '2024-07-28 06:45:34', '2024-07-28 06:45:34'),
('9ca0e8f9-42aa-4768-b390-81889b8b9856', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid3.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid3.png\"],\"added_images\":[]}', 0, 0, '2024-07-28 06:46:13', '2024-07-28 06:46:13'),
('9ca0e9a7-5fc7-4f4f-b377-3eb7ba1a0b06', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-28 06:48:07', '2024-07-28 06:48:07'),
('9ca0ea2a-f7c6-4871-8c2c-cc12addfcd5e', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\"]}', 0, 0, '2024-07-28 06:49:33', '2024-07-28 06:49:33'),
('9ca0eada-a9ec-49dc-ab21-fb261e065e59', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"]}', 0, 0, '2024-07-28 06:51:29', '2024-07-28 06:51:29'),
('9ca0eb0b-6d30-4394-af7d-3fc8fbaa0204', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"],\"added_images\":[]}', 0, 0, '2024-07-28 06:52:00', '2024-07-28 06:52:00'),
('9ca0ec12-d58d-4a8d-a9be-3a863b546c58', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid0.png\"]}', 0, 0, '2024-07-28 06:54:53', '2024-07-28 06:54:53'),
('9ca0ee29-bfad-42e2-83ac-4f1401b371cb', 21, '{\"0\":\"content\",\"1\":\"images\",\"2\":\"content\",\"removed_images\":[],\"added_images\":[\"images\\/courses\\/javascript\\/dzb_00021_blobid1.png\",\"images\\/courses\\/javascript\\/dzb_00021_blobid2.png\"]}', 0, 0, '2024-07-28 07:00:44', '2024-07-28 07:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'web', 'This user has the permission to carry out all actions on the platform.', '2024-06-27 11:41:14', '2024-06-27 12:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('DMRfL9ZIno0s1AnGLR6ozvRQdwBiv6LAgNaZ6oov', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTGM2OGdPaVBQUlkybU9HVlBqRklwZnFpWTkyUDlxRURQdVcxb2tsUyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vd3d3LmRvbnpvYnkubmV0L3Bvc3RzLzIxL2VkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1722151145);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `long_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `course_id`, `name`, `slug`, `description`, `long_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Photoshop', 'photoshop', 'Photoshop is the most popular and equally very powerful imaging and graphic design application. If you want to be able to retouch that family picture and much more, start learning Photoshop at Donzoby.', NULL, '2024-04-07 07:10:23', '2024-04-07 07:10:23'),
(2, 1, 'GIMP', 'gimp', 'GIMP is a free image manipulation program. GIMP packs lots of features for picture editing but unlike Photoshop, you don\'t have to pay to use Gimp. Learn GIMP at Donzoby.', NULL, '2024-04-07 07:10:47', '2024-04-07 07:10:47'),
(3, 1, 'CorelDraw', 'coreldraw', 'Corel Draw is a comprehensive vector-based drawing program for the graphics professional. Unleash your artistic creativity by learning simple Corel Draw at Donzoby.', NULL, '2024-04-07 07:11:41', '2024-04-07 07:11:41'),
(4, 2, 'HTML', 'html', 'Pages of Websites  are created with HTML. Learn practical HTML at Donzoby.com and build your first website in a short time.', NULL, '2024-04-07 07:12:53', '2024-04-07 07:12:53'),
(5, 2, 'Cascading Style Sheets (CSS)', 'css', 'Cascading Style Sheets control the look and feel of web documents. Learn how to write CSS formatting rules to tell browsers how to display web pages.', NULL, '2024-04-07 07:15:25', '2024-04-22 09:12:52'),
(6, 2, 'JavaScript', 'javascript', 'To make web pages come alive and respond to users immediately, you need JavaScript. We make learning JavaScript easy and less confusing at Donzoby.', NULL, '2024-04-07 07:15:49', '2024-04-07 07:15:49'),
(7, 2, 'Bootstrap', 'bootstrap', 'Bootstrap is a framework for building responsive and mobile-first websites. It takes care of cross browsers CSS issues and many more stuffs. Quickly learn Bootstrap at Donzoby.com', NULL, '2024-04-07 07:16:10', '2024-04-07 07:16:10'),
(8, 3, 'Structured Query Language (SQL)', 'sql', 'The standard language for working with database is SQL which stands for Structured Query Language. You will learn how to write standard queries that can run across database systems.', NULL, '2024-04-07 07:17:10', '2024-04-22 09:11:35'),
(9, 3, 'MySQL', 'mysql', 'MySQL is a Relational Database Management System(RDMS) that is free to use. We will show you to combine PHP and MySQL to build powerful websites', NULL, '2024-04-07 07:17:35', '2024-04-07 07:17:35'),
(10, 3, 'Laravel', 'laravel', 'Laravel is a PHP framework that simplifies the process of development with PHP. It makes your code more structured. Build your first Laravel website in a few and clear steps at Donzoby.com', NULL, '2024-04-07 07:17:54', '2024-04-07 07:17:54'),
(11, 4, 'Kotlin', 'android-kotlin', 'Kotlin is a Java like programming language that is compatible with the Android Operating System. Kotlin solves many problems that exist in Java and made it easier to accomplish tasks. Start Donzoby Kotlin tutorial to see it in action.', NULL, '2024-04-07 07:18:39', '2024-04-07 07:18:39'),
(12, 4, 'Android Java', 'android-java', 'Java is a high level and platform independent programming language. You will learn how to use Java in building of Android apps.', NULL, '2024-04-07 07:19:02', '2024-04-20 16:09:21'),
(13, 4, 'Swift', 'io-swift', 'Swift is a powerful and intuitive programming language that is used to create iOS apps.', NULL, '2024-04-07 07:22:11', '2024-04-07 07:22:11'),
(14, 4, 'Flutter', 'flutter', 'Flutter is a framework created by Google for building cross-platform apps. It builds UI by utilizing widgets.', NULL, '2024-04-07 07:25:28', '2024-04-07 07:25:28'),
(15, 5, 'C Sharp', 'c-sharp', 'Easy to understand C sharp (C Sharp #) tutorial for the beginners and new programmers at Donzoby.com', NULL, '2024-04-07 07:26:26', '2024-04-07 07:26:26'),
(21, 5, 'Windows Java', 'windows-java', 'Java is a high-level and platform-independent programming language. It is used to build mobile apps as well as Windows apps.', NULL, '2024-04-07 07:30:13', '2024-04-07 07:30:13'),
(22, 6, 'Microsoft Word', 'ms-word', 'Learn Microsoft Word and format word documents with ease. MS Word is the world\'s most popular word processing software.', NULL, '2024-04-07 07:30:47', '2024-04-07 07:30:47'),
(23, 6, 'Microsoft PowerPoint', 'ms-powerpoint', 'Our PowerPoint tutorial will teach you how to prepare presentations for your meetings and conferences in easy steps.', NULL, '2024-04-07 07:32:31', '2024-04-07 07:32:31'),
(24, 6, 'Microsoft Excel', 'ms-excel', 'Learn Excel spreadsheets from the basics. Microsoft Excel is an interactive software for the organization, analysis, and storage of data in tabular form', NULL, '2024-04-07 07:34:15', '2024-04-07 07:34:15'),
(25, 6, 'Microsoft Access', 'ms-access', 'Learn our Microsoft Access tutorial for beginners. Access is a Relational Database Management from Microsoft', NULL, '2024-04-07 07:34:56', '2024-04-07 07:34:56'),
(26, 7, 'Paper Works', 'paper-work', 'Practical guides on how to work with papers, and paper-related stuff in small offices and computer business centers', NULL, '2024-04-07 07:36:04', '2024-04-07 07:36:04'),
(27, 7, 'Machine Operation', 'machine-operations', 'Practical guides on how to operate, and work with common machines in small offices and computer business centers.', NULL, '2024-04-07 07:36:57', '2024-04-07 07:36:57'),
(28, 8, 'Online Services', 'online-services', 'In this tutorial, we will teach you how to use services online efficiently while avoiding risks.', NULL, '2024-04-07 07:38:17', '2024-04-07 07:38:17'),
(29, 8, 'Browsers', 'browsers', 'Browsers are special computer programs that send requests to the server and process the server response to user-readable formats.', NULL, '2024-04-07 07:38:58', '2024-04-07 07:38:58'),
(30, 8, 'Miscellaneous', 'miscellaneous', 'Various topics on the use of the Internet and the World Wide Web are covered here to enable you to browse the web effectively.', NULL, '2024-04-07 07:40:08', '2024-04-07 07:40:08'),
(31, 9, 'Android Phones', 'android-phones', 'Learn about Android Phones, features, tricks and tips for effective use of your phones.', NULL, '2024-04-07 07:54:17', '2024-04-07 07:54:17'),
(32, 9, 'iPhones', 'iphones', 'Learn about iPhones, features, tricks and tips for effective use of your phones.', NULL, '2024-04-07 07:54:37', '2024-04-07 07:54:37'),
(33, 9, 'Service Providers', 'service-providers', 'We bring you the latest on service providers\' data plans, voice call tariffs, free YouTube sessions, and much more.', NULL, '2024-04-07 07:55:24', '2024-04-07 07:55:24'),
(34, 9, 'Apps', 'apps', 'Learn to use the power of applications in your phone to solve daily problems and increase efficiency.\"', NULL, '2024-04-07 07:55:48', '2024-04-07 07:55:48'),
(35, 9, 'Hardware', 'hardware', 'Get tips and ideas on how to care for and prolong the lifespan of your phone. General guides and tips on phone hardware and accessories.', NULL, '2024-04-07 07:56:34', '2024-04-07 07:56:34'),
(36, 3, 'Hypertext Preprocessor (PHP)', 'php', 'In this course, you will learn how to use PHP one of the most popular languages for server side programming to create dynamic website that can accept and process user\'s input.', NULL, '2024-04-09 09:42:16', '2024-04-09 09:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `test_posts`
--

CREATE TABLE `test_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('course-series','special-series','how-tos') NOT NULL,
  `topic` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `hits` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `status` enum('published','unpublished') NOT NULL DEFAULT 'unpublished',
  `comment_status` enum('open','closed') NOT NULL DEFAULT 'closed',
  `comment_count` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `tags` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sort_value` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_posts`
--

INSERT INTO `test_posts` (`id`, `author_id`, `subject_id`, `version`, `parent_id`, `type`, `topic`, `content`, `hits`, `status`, `comment_status`, `comment_count`, `tags`, `slug`, `description`, `sort_value`, `created_at`, `updated_at`) VALUES
(1, 1, 6, NULL, NULL, '', 'Introduction to JavaScript', '<p>JavaScript is one of the most popular programming languages on earth and is used to add interactivity to webpages, process data, as well as create various applications (mobile apps, desktop apps, games, and more).</p>\n<p>JavaScript is the programming language of HTML and the Web. Although recently by the coming of certain frameworks JavaScript can as well be used on the server side to do some work initially reserved for server side languages like PHP, ASP etc.</p>\n<p>In this course, we are going to focus on using JavaScript on the client side (inside the browser) and subsequent courses can take care of the server aspect of JavaScript.</p>\n<h2>How difficult is JavaScript?</h2>\n<p>This is the question bugging the minds of most newcomers to programming especially web design starters. Some even ask if one cannot have a great web designing career without learning programming at least in JavaScript.</p>\n<p>To be sincere with you, it\'s not that hard to learn JavaScript and start solving some common website issues with it if you give it a little commitment. To this I must add that if you really want to take it further to the professional level of JavaScript programming, it will take a bit more time and learning to get to the pro level but you need not fear, it\'s something you can definitely do.</p>\n<h2>How to learn JavaScript</h2>\n<p>Thank God for the age we are in: access to information and learning materials has never been this easy and most times equally free. There are a couple of way you can learn JavaScript:</p>\n<ol>\n<li>Download free ebooks and read</li>\n<li>Search for tutorial videos on youtube</li>\n<li>Search for code examples that accomplishes simple tasks and examine them</li>\n<li>Register for a training class either online or in a physical location such as a training institute.</li>\n</ol>\n<h2>How not to learn JavaScript</h2>\n<p>There is only one way we want to discourage you from following in learning this programming language in order for you not to waste your time and make only little progress in this journey. And that is don\'t learn by reading alone! Yes, get dirty and code, code and code again! It\'s better you write a program and it is not working properly than for you not to write at all because you fear making mistakes.</p>\n<p>The average life of every programmer is spent correcting errors and mistakes in codes. So, don\'t worry about getting it wrong when you write a program, when it\'s not working, there are lots of forums online that can help you easily fix it.</p>\n<p>Even pros make mistake, so, get coding as soon as possible.</p>\n<p><em>Happy learning!</em></p>', 1443, 'published', 'open', 0, 'JavaScript, learn javascript, web scripting, client side programming, scripting', 'introduction_to_javascript', 'An introduction to JavaScript, the programming language of HTML and the web. A simple tutorial on programming with JavaScript.', 1, '2018-11-19 11:33:49', '2024-07-06 16:18:16'),
(2, 1, 2, NULL, NULL, '', 'Crop an Image with GIMP', '<p>To crop an image is a task that is very important yet very simple to carry out. Just relax, and we promise to lay it all down clearly for even a complete novice to master the art of cropping with GIMP.</p>\n<p>Just for the sake of little more clearance in case you wondering what the word \"Crop\" means, after all we are not dealing with farms here. Don\'t worry I will give simple explanation below. Cropping an image simply means to remove portion(s) of an image that is not desirable while keeping the part we want.</p>\n<p>Now, enough of the words, let get to action because action they say speaks louder than voice!</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://www.donzoby.com/images/courses/gimp/crop-image.png\" alt=\"image to crop with gimp\" width=\"316\" height=\"220\" /></p>\n<p><strong>Our mission:</strong> <em>To remove all other parts of the above image and keep only the circle and the writing inside it.</em></p>\n<ol>\n<li>First, open the image/picture you want to crop in GIMP</li>\n<li>Click on the Crop tool within the tool box (in the right pane) or press <strong>Shift+C</strong> on the keyboard (for Windows OS).</li>\n<li>Click and drag over the portion of the image you want to keep. as shown in the figure below.<br /><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://www.donzoby.com/images/courses/gimp/select-crop-portion.png\" alt=\"select portion to crop\" width=\"318\" height=\"222\" /><br /><strong>NOTE</strong>: The portion of the image outside your selection (that is, the partion greyed out) will be thrown away!<br /><br /></li>\n<li>Finally press the <strong>Enter</strong> key on the keyboard or double click within your selection. The image will look like shown below:<br /><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://www.donzoby.com/images/courses/gimp/crop-image-result.png\" alt=\"crop image result\" width=\"214\" height=\"213\" /></li>\n</ol>\n<p>Thank God! We are done!</p>\n<p>Do you want to learn more about working with GIMP? Check out our GIMP tutorial section and keep tuned for more clear and precise lessons.</p>\n<p>With this knowledge that you have just gotten, you are on your way to becoming much more efficient in working with images by keeping only the needed part while throwing away unecessary ones.</p>', 2176, 'published', 'open', 0, 'crop an image with gimp, crop an image, cropping with gimp, cropping, gimp', 'crop_an_image_with_gimp', 'A very simple tutorial on how to Crop an image in GIMP using the crop tool. Quickly learn how to keep only the needed part of an image.', 17, '2018-12-05 20:16:02', '2024-07-06 19:26:13'),
(3, 1, 33, NULL, NULL, '', 'Glo 2.5gigs free YouTube Data', '<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://donzoby.com/images/courses/service-providers/dzb_00046_glo-free-youtube-data.png\" alt=\"\" width=\"340\" height=\"352\" /></p>\n<p><span style=\"text-decoration: underline;\"><strong>Update</strong></span>: <em>Glo Network has discontinued this offer at the moment. I tested it and also had to call their customer care to confirm. They quietly removed the offer without making it well known to the customer. </em></p>\n<p><em>What they offer now in place of the free Youtube data is a data bonus that can be used to browse any website. They are not always that big. The size depends on the data plan you purchased. It\'s volume ranges from 10% - 20% of purchased data volume and can only be used at night (12:00am - 5:00am).</em></p>\n<hr />\n<p>Today I want to tell you about a legitimate and easy way to watch video online for FREE! Yeah, you heard it right. It\'s for free. It\'s very possible that you have been missing this great opportunity at your disposal for a while without even knowing it. But don&rsquo;t worry, that&rsquo;s why we are here at Donzoby.com to make your life better.</p>\n<p>You will agree with me that there is always one thing or the other that you need to watch online but data is sometimes a hindrance to this especially for those in developing nations where price of internet subscription is still very high.</p>\n<p>It could be a tutorial, a sermon, entertainment or just about any video that you want to view online.</p>\n<p>This guide is for watching video only on YouTube and for people that meet the following conditions:</p>\n<ol>\n<li>Resides in Nigeria</li>\n<li>Has Glo Mobile as their service provider</li>\n<li>Subscribes to a data plan of at least N500.00 (five hundred naira)</li>\n<li>Let me also add, \"Can wake up at night when sleep is sweet!\"</li>\n</ol>\n<p>When you subscribe for data plan that ranges from N500 and above, Glo attaches an additional 2.5gigs data to your subscription.</p>\n<p>It\'s this additional data that is reserved for streaming or watching YouTube videos. But wait before you rush and burn up your subscription, this free data is a nocturnal animal! This means that it only functions at night. Yes, not evening but deep into the dead night.</p>\n<p><em><strong>Start time</strong></em><br />1:00am</p>\n<p><em><strong>End Time</strong></em><br />5:30am</p>\n<p>So, from the above, you have a window of 4hrs 30mins each day to watch YouTube videos for free.</p>\n<h3>Caution when using Glo free YouTube data</h3>\n<p>If you have been around the Nigerian telcos for a while now, you would\'ve known that they are very good at painful surprises. So, in order to avoid you fighting with customer care, take note of the following:</p>\n<ul style=\"list-style-type: square;\">\n<li>Wait until it\'s a few minutes past 1:00am maybe 1:02</li>\n<li>Turn off your data and turn it on again</li>\n<li>Check your available data volume on your current subscription. The reason is because there is no way to check the volume of this additional free data for YouTube.</li>\n<li>Check your available data volume again after watching for like 10mins. If you notice any significant reduction in the data volume, please run for your data! This means the additional free data is not active on your account. But if the volume remains unchanged, congratulations enjoy yourself.</li>\n<li>Don\'t exceed 5:30am on the dot.</li>\n<li>Finally, repeat the above every night of free streaming because you might exhaust the free 2.5gigs and enter without any warning into your main data volume.</li>\n</ul>\n<p>Thanks and God bless.</p>\n<p>If you have any question, please feel free to throw in your comment below. I will try to respond as quickly as I can.<br /><br /></p>', 1459, 'published', 'open', 0, 'youtube, free youtube, glo, glo free data, night youtube', 'glo_2.5gigs_free_youtube_data', 'When you subscribe for data plan that ranges from N500 and above, Glo attaches an additional 2.5gigs data to your subscription for free.', 3, '2018-12-26 19:29:12', '2024-07-06 16:18:16'),
(4, 1, 4, NULL, NULL, '', 'What is HTML?', '<h3>Brief History of HTML</h3>\r\n<p>HTML which stands for HyperText Markup Language was invented at a company called CERN in Geneva by a scientist and academic by name Tim Berners-Lee in the year 1989.</p>\r\n<p>The arrival of HTML marked the beginning of the World Wide Web (www) as we know it today. HTML is considered the language of the web and according to Donzoby.com, it is the skeletal frame of all living web pages.</p>\r\n<h3>What is HTML Used For?</h3>\r\n<p>Although it seems plain and self explanatory already, we still know that for some reasons you might still be wondering what exactly is HTML used for?</p>\r\n<p>To put it simply, it is a markup language used for \"building\" web pages. Each website is made up of web pages and each web page is built (structured and laid out) using HTML.</p>\r\n<p>By learning HTML, you are equipping yourself with a great tool for limitless possibilities as a web designer or developer.</p>\r\n<h3>How Hard is HTML?</h3>\r\n<p>I will rather prefer the question on your mind is \"How simple is HTML?\" and the reason is because HTML is not a difficult or complicated markup language to learn because some of its components are self explanatory (especially HTML 5) and quite intuitive.</p>\r\n<p>You will be building your own web pages in no time by following through this tutorial on creating web pages with HTML.</p>\r\n<h3>How to recognize HTML file or document</h3>\r\n<p>HTML files have a .html or .htm file extension. For instance, if you see a file named \"my-site.html\". It tells you that the file is a web page. You can open it with your browser and view the web page. Your browser will interpret the markup language and render it appropriately.</p>', 1527, 'published', 'open', 0, 'what is html, meaning of html, introduction to html, html, history of html, html file', 'what_is_html', 'It is an acronym for HyperText Markup Language. It was invented by Tim Berners-Lee in 1989. It is used to define the structure and layout of a web page. According to Donzoby.com, it is the skeletal frame of all living web pages.', 4, '2019-02-08 12:49:37', '2024-07-06 18:54:02'),
(5, 1, 33, NULL, NULL, '', 'Glo Revamped Night Plans', '<p>&nbsp;</p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Today, Glo Mobile network sent me this message:</span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://donzoby.com/images/courses/service-providers/Glo_night_data_new.jpg\" alt=\"\" width=\"220\" height=\"263\" /></span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">This marks Glo\'s attempt to remain the data grandmaster that it has positioned itself to be and if you are a heavy data user like me, I know that this is good news.</span></p>\n<p class=\"MsoNormal\">&nbsp;</p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>Why Does This Even Matter?</strong></span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Ok, that\'s a nice question that deserves a clear answer. The reason why we are talking about the latest Glo Night Data offering is that it goes a step ahead of what other competing networks are offering at the moment. To put it simply, it seems that Glo assembled their marketing magicians and asked them to come up with a night data plan that will beat what is currently being offered without going too far on Glo\'s own part.</span></p>\n<ul style=\"list-style-type: square;\">\n<li class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">&nbsp;&nbsp;MTN offers a maximum of 500mb per night (250mb for N25 x 2 or 500mb for N50) from 12:00midnight &ndash; 5:00am<br /><br /></span></li>\n<li class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">&nbsp;Airtel offers 250mb for N25 (you can subscribe twice for the night)<br /><br /></span></li>\n<li class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">&nbsp;9mobile offers 250mb for and N501gb for N200<br /><br /></span></li>\n</ul>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Considering the above, you can see why the new Glo night plan beats them all not just in the price but also in the validity period.</span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><br /><strong>Who is Eligible?</strong></span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">At the moment every Glo customer is qualified for this new night data plan unlike Airtel and MTN that restrict theirs to customers on a special package.<br /><br /></span></p>\n<p><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>How to Subscribe</strong></span></p>\n<p><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Follow the steps bellow to subscribe for this new plan:</span></p>\n<ol>\n<li><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Dial *777#</span></li>\n<li><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Type 1 and send to buy data</span></li>\n<li><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Type 1 and send to buy 3G-4G data</span></li>\n<li><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Type 7 and send for Night and weekend plan</span></li>\n<li><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Type 3 and send for N100 = 1GB 5days (12am-5am)</span></li>\n</ol>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">N100 will be deducted from your account and you will be given 1GB to use between 12am and 5am for five(5) days.</span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Enjoy while it last!</span></p>\n<p class=\"MsoNormal\">&nbsp;</p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Do you like this new offer from Glo? What do you think? Share your thoughts in the comment section below.</span></p>\n<p>&nbsp;</p>', 1524, 'published', 'open', 0, 'glo night plan, glo new night plan, glo N100 for 1gb', 'glo_revamped_night_plans', 'Glo just released new night browsing data plans that beat all the other competitors both in volume and the duration of validity.', 5, '2019-12-17 20:27:14', '2024-07-06 16:18:16'),
(6, 1, 33, NULL, NULL, '', 'Check Your Data Balance On The Glo Mobile Network', '<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://www.donzoby.com/images/courses/service-providers/glo_data_balance.png\" alt=\"\" /></p>\n<p>&nbsp;</p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">We are glad to have you with us through this fast and simple guide on how to check your data balance on the Glo Mobile network.<br /><br /></span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">This is specifically written for those in Nigeria but Glo could as well retain the same USSD</span> <span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">(Unstructured Supplementary Service Data) code for similar operations across international borders.<br /><br /></span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>There are two ways to do this:</strong></span></p>\n<ul style=\"list-style-type: circle;\">\n<li class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Use the Customer Services menu by dialing *777#<br /><br /></span></li>\n<li class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Choose buy data by typing 1 and pressing send<br /><br /></span></li>\n<li class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">From the listed data options choose manage plan by typing 4<br /><br /></span></li>\n<li class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Finally, type in 4 again and send to get your data balance. When you perform this last step, your data plan remaining volume and validity details will be staring straight at you.<br /><br /></span></li>\n</ul>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>Second way to check glo data balance</strong></span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">This one involves just one step and I believe you don\'t need anyone to tell you that it\'s what I always use. Who doesn\'t want an easy life when possible?<br /><br /></span></p>\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Dial *127*0# and then send. Voila! You will get the same result as the one above.</span></p>\n<p class=\"MsoNormal\">&nbsp;</p>\n<p class=\"MsoNormal\"><em><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><span style=\"color: #323232; font-family: sans-serif; font-size: 18.6667px;\">What do you think? Share your thoughts in the comment section below.</span></span></em></p>\n<p>&nbsp;</p>', 1552, 'published', 'open', 0, 'glo data balance, check glo data balance, how to check data balance on glo network', 'check_your_data_balance_on_the_glo_mobile_network', 'Simple steps on how to check your data balance on the Glo network from www.donzoby.com.', 6, '2020-03-06 00:43:24', '2024-07-06 16:18:16'),
(7, 1, 33, NULL, NULL, '', 'Data Plan Validity Period', '<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://www.donzoby.com/images/courses/Service Providers/data_plan_validity_period.png\" alt=\"\" /></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">When you are going about your daily tasks and utilizing all the good things we now have around us, it may not come to your mind that some of the things we cannot do without now only came on the scene few years ego.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">With every service we have to consume, there are at least a few information that we need in order to make the most out of it. One of such services is the data services from our various service providers.<br /><br /></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>What is data plan validity period?</strong></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Almost all service providers or mobile network carriers attach validity period to the data plans they offer. Based on this, we set out to clarify what that means and how it can help you make the most out of your plans.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Validity period of a data plan simply means the stipulated duration (hours, days, weeks, months or years) within which you can still utilize your remaining data volume.<br /><br /></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>What happens when I exceed my data validity period?</strong></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Generally, you will cease to have access to your remaining data (if any is still remaining). This means that you won\'t be able to browse and use the internet.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">But, if you observed, I used the word \"Generally\" in the beginning of the above paragraph and the reason is because different Internet Service Providers have different way of treating validity period expiration.<br /><br /></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>What if I still have unused data?</strong></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">It depends on your service provider as we mentioned above. Some will wipe out the remaining data. Some others will suspend your data plan but will rollover your remaining data when you renew your subscription.<br /><br /></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\"><strong>What is data rollover?</strong></span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Let explain this with an example: Assuming you subscribed for 2gigs data with a validity period of one (1) week and you happened to have used only 1gig within the first week after your subscription. If you renew your plan with your service provider, you will get the usual 2gigs plus the remaining 1 gig from your previous subscription bringing your total data volume to 3gigs.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">To know whether your service provider offers data rollover you need to contact the customer care and they will give you needed information on your desired plan.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Finally, it\'s very important to keep in mind that most mobile network operators have a specified time limit between your data plan expiration and renewal. It is only within this time limit that you can have your unused data rolled over.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;\">Please like our page and use the comment box below if you need further clarification on this topic.</span></p>', 1423, 'published', 'open', 0, 'data validity period, data plan validity, validity of data plan, data bundle validity', 'data_plan_validity_period', 'Validity period of a data plan simply means the stipulated duration within which you can still utilize your remaining data volume.', 7, '2020-03-06 17:02:22', '2024-07-06 16:18:16'),
(8, 1, 4, NULL, NULL, '', 'Tools for Working with HTML', '<h3><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://donzoby.com/images/courses/html/dzb_00051_sublime-editor.png\" alt=\"\" width=\"444\" height=\"231\" /></h3>\n<h3>Only Two Tools</h3>\n<p>There are basically only two things you need in order to create web pages using HTML:</p>\n<ul style=\"list-style-type: square;\">\n<li><strong>Text Editor</strong>: A computer program used for creating text files. The good news is that no matter the Operating System you are using, there is a text editor that came with it and as basic as the text editor might be, it is enough to code with HTML.</li>\n<li><strong>A Browser</strong>: It\'s a software application used for viewing web pages. Popular browsers include: Chrome, Firefox, Safari, Internet Explorer, Opera and Edge. Just as text editor, I am almost certain that your computer has a browser already installed because almost all Operating System come with a browser pre-installed.</li>\n</ul>\n<p>From the above, we can safely conclude that you have all the tools you need for creating web pages using HTML.</p>\n<h3>A Note on Text Editor</h3>\n<p>While you can create web pages using basic text editors such as WordPad or Notepad on Windows and&nbsp;<span style=\"font-family: Verdana, sans-serif; font-size: 15px;\">TextEdit (Mac)</span>&nbsp;for example, it will take you more time and labor to get things done.</p>\n<p>To make the task of writing codes easier, there is a special class of text editors called Integrated Development Environment (IDE). They are text editors with lot more features such as auto completion of codes, error detecting and tracing, line numbering etc that makes it much more fun and easier to write codes.</p>\n<p>While there are several IDEs out there and it\'s hard to say which one is really better than the other, I will recommend that you get started with Sublime Text. It is free and you can&nbsp;<a title=\"Get Sublime Text IDE\" href=\"https://www.sublimetext.com/download\" target=\"_blank\" rel=\"noopener\">download it here</a>.</p>\n<h3>A Note on Browsers</h3>\n<p>Having only one browser for viewing your web pages built with HTML is good for a beginner but as you go further and add more features to your page, it will be inadequate to test your work using only one web browser.</p>\n<p>All the listed browsers above are free to download and use, so, try get more than just one of them. If possible, get all of them if you really want to be sure that your web pages will display uniformly across browsers.</p>\n<h4>Browsers Download Links:</h4>\n<p><a title=\"Get Google Chrome Browser\" href=\"https://www.google.com/chrome/\" target=\"_blank\" rel=\"noopener\">Download Chrome</a><br /><a title=\"Get Firefox Browser\" href=\"https://www.mozilla.org/en-US/firefox/new/\" target=\"_blank\" rel=\"noopener\">Download Firefox</a><br /><a title=\"Get Safari Web Browser\" href=\"https://safari.en.softonic.com/download\" target=\"_blank\" rel=\"noopener\">Download Safari</a><br /><a title=\"Get Opera Browser\" href=\"https://www.opera.com/download\" target=\"_blank\" rel=\"noopener\">Download Opera</a></p>', 1311, 'published', 'open', 0, 'Tools for Working with HTML, html tools, html editor, web browsers, browsers, browsers download links', 'tools_for_working_with_html', 'There are basically only two things you need in order to create web pages using HTML. A text editor to write the code and a Browser to render the code you have written.', 8, '2020-07-16 19:31:26', '2024-07-06 18:54:53'),
(9, 1, 4, NULL, NULL, '', 'Your First Website', '<p>We are going to dive right in and write the code for our first website below and then proceed to explain the HTML that made that happen and from there go deeper into other aspects of HTML that could not be added to our simple and yet complete website.</p>\n<p>Open any text editor of your choice (we recommend Sublime Text but any other text editor can serve) and type in the following code:</p>\n<pre class=\"language-markup\"><code data-linenumber=1>&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n&lt;head&gt;\n     &lt;title&gt;My Site&lt;/title&gt;\n&lt;/head&gt;\n&lt;body&gt;\n     &lt;h1&gt;Welcome to my website!&lt;/h1&gt;\n     &lt;p&gt;I was told to put my thoughts in a paragraph.&lt;/p&gt;\n&lt;/body&gt;\n&lt;/html&gt;</code></pre>\n<p>Now, save the code in any location of your choice.</p>\n<p><strong>NOTE</strong>: <em>Be sure to save it as a .html file if not you will not get the expected result. If you are having any challenge in making this work, use the the comment section below and you will be helped.</em></p>\n<p>After saving your file, it is now time to see the result of your code. Go ahead and open the file you just saved with any web browser of your choice (Chrome, Firefox, Safari, Opera etc) and you will see the result of your hard work displayed as below:</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://donzoby.com/images/courses/html/dzb_00052_first-site-result.png\" alt=\"\" width=\"602\" height=\"278\" /></p>\n<p>Congratulations! You\'ve built your first website. Although it doesn\'t do much at the moment, but we have laid solid foundation upon which we can build any website no matter how complex it may be.</p>\n<h3>What We Just Did:</h3>\n<p>Remember that from the previous lessons we understood that HTML is a markup language, so what we did above was to give the browser certain content (data) and information describing the content and how it should be displayed.</p>\n<p><strong>&lt;!Doctype html&gt;</strong> : This tells the browser that this document/file is a HTML document.</p>\n<p><strong>&lt;html&gt;</strong> : This surrounds everything in a HTML document, it serves as the root element for the webpage.</p>\n<p><strong>&lt;head&gt;</strong> : This defines a section (element) of the webpage that will not be displayed on the page but provides information about the webpage.</p>\n<p><strong>&lt;title&gt;</strong> : As the name suggests, this provides a title for the webpage. The content of the title element is displayed on the browser\'s title bar or as the name of the browser\'s tab where the webpage is open.</p>\n<p><strong>&lt;body&gt;</strong> : This is the element that defines the part of the document that will be displayed on the browser. It serves as the container for every other thing displayed on the webpage.</p>\n<p><strong>&lt;h1&gt;</strong> : This defines a heading for the content of the webpage.</p>\n<p><strong>&lt;p&gt;</strong> : This defines a paragraph.</p>\n<p>If you don\'t yet fully understand the concept of element, don\'t worry in the next lesson, we will look at HTML elements and how many of them are used including the ones you have seen above.</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>', 1288, 'published', 'open', 0, 'build website, html, first website with HTML', 'your_first_website', 'Here we guide you through the process of creating your first website. It\'s simple but yet validly complete.', 9, '2020-07-17 13:21:10', '2024-07-06 18:54:34'),
(10, 1, 4, NULL, NULL, 'course-series', 'Html Elements', '<p>HTML is made up of segments describing the structure and content of the webpage that are called elements.</p>\n<p>Basically, an HTML element is composed of the following:</p>\n<p>&lt;<code data-linenumber=\"1\">tagname</code>&gt;: &nbsp;opening tag</p>\n<p>Content</p>\n<p class=\"MsoNormal\">&lt;/<code data-linenumber=\"1\">tagname</code>&gt;: closing tag</p>\n<p>For example, to add a paragraph to a webpage, we will wrap the text (content) of the paragraph in the paragraph element tag:</p>\n<p>&nbsp;</p>\n<pre class=\"language-markup\" style=\"word-spacing: 0px;\"><code>&lt;p&gt; My first paragraph &lt;/p&gt;</code></pre>\n<p>Let\'s take a look at how they\'re written graphically and in more details:</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://donzoby.com/images/courses/html/dzb_00053_element-structure.png\" alt=\"\" width=\"487\" height=\"341\" /></p>\n<p>&nbsp;</p>\n<pre class=\"language-markup\" style=\"word-spacing: 0px;\"><code>&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n	&lt;head&gt;\n		&lt;title&gt;My Site&lt;/title&gt;\n	&lt;/head&gt;\n	&lt;body&gt;\n		&lt;p&gt;My first paragraph.&lt;/p&gt;\n	&lt;/body&gt;\n&lt;/html&gt;</code></pre>\n<p class=\"MsoNormal\"><strong>Remember:</strong>&nbsp;<em>From our earlier lesson we established that every html page must start with a DOCTYPE declaration, followed by the &lt;html&gt; element which will wrap every other elements on the page. The &lt;body&gt; section is where you put contents that will be displayed on the page</em>.</p>\n<h3>Empty&nbsp;HTML&nbsp;elements</h3>\n<p class=\"MsoNormal\">There are certain elements in HTLM that doesn\'t have content (empty elements) and therefore they don\'t have closing tags. example is the &lt;<code data-linenumber=\"1\">br</code>&gt; element used for adding line breaks.</p>\n<h3>Nested&nbsp;HTML&nbsp;elemets</h3>\n<p>An element in HTML can contain other element(s). The only time this cannot work is if you are trying to put a block level element inside an inline element (<em>we will learn about block and inline elements below</em>)</p>\n<p>When an element is containing another element, we have what is called nested elements. Like in our example above, the &lt;<code data-linenumber=\"1\">p</code>&gt; element is nested inside the &lt;<code data-linenumber=\"1\">body</code>&gt; element and the &lt;<code data-linenumber=\"1\">body</code>&gt; element in turn is nested within the &lt;<code data-linenumber=\"1\">html</code>&gt; element which is the root element.</p>\n<p>The &lt;<code data-linenumber=\"1\">body</code>&gt; element is the parent element to the &lt;<code data-linenumber=\"1\">p</code>&gt; element and the &lt;<code data-linenumber=\"1\">p</code>&gt; element is a child element of the &lt;<code data-linenumber=\"1\">body</code>&gt; element. The same relationship exist between the &lt;<code data-linenumber=\"1\">html</code>&gt; element and the &lt;<code data-linenumber=\"1\">body</code>&gt; element.</p>\n<p>If two HTML elements have the same parent element, the two elements are said to be siblings.&nbsp;</p>\n<p><strong>NOTE</strong>:&nbsp;<em>From here onwards, we will only be writing the elements in focus without writing the full HTML documents (we will omit Doctype declaration, &lt;head&gt;, and &lt;body&gt; tags). This will save space and make it easier for us to focus on the main thing at hand.&nbsp;<span style=\"text-decoration: underline;\">Just keep in mind that whatever element we are dealing with has to be put within the &lt;body&gt;&lt;/body&gt; tags of your HTML document</span></em>.</p>', 1226, 'published', 'open', 0, 'html element, html elements, html tags, empty html elements, opening tag, closing tag, nested elements, block elements, inline elements', 'html_elements', 'HTML is made up of segments describing the structure and content of the webpage that are called elements.', 10, '2020-07-23 17:43:38', '2024-07-09 18:48:34'),
(11, 1, 6, NULL, NULL, '', 'Say Hello in JavaScript', '<p>Having introduced JavaScript briefly in our earlier lesson, here we are going to move straight into writing your first JavaScript program.</p>\n<p>One important thing, and that\'s the first thing you have to consider is how do you let the browser displaying your webpage know that the next lines of code you are about to write is not just another HTML code but a JavaScript code?</p>\n<h3>Script Element &lt;<code data-linenumber=\"1\">script</code>&gt; comes to the rescue!</h3>\n<p>In order to let the browser know that you are about to write JavaScript and it should interpret it accordingly, you use the script element of HTML.</p>\n<p>Create an HTML document and within the &lt;<code data-linenumber=\"1\">head</code>&gt; section, add the following:</p>\n<p>&nbsp;</p>\n<pre class=\"language-javascript\" style=\"word-spacing: 0px;\"><code data-linenumber=1>&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n	&lt;head&gt;\n		&lt;title&gt;My Site&lt;/title&gt;\n		&lt;script&gt;\n			document.write(\"Hello from here.\");\n		&lt;/script&gt;\n	&lt;/head&gt;\n	&lt;body&gt;\n	&lt;/body&gt;\n&lt;/html&gt;</code></pre>\n<p>Save your work and open the HTML document in a browser. You should see a result similar to this:</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://www.donzoby.com/images/courses/javascript/dzb_00054_first-js.png\" alt=\"\" width=\"530\" height=\"237\" /></p>\n<h3>What you just did:</h3>\n<ol>\n<li>You notified the browser that you are about to write JavaScript code by using the opening script tag (&lt;<code data-linenumber=\"1\">script</code>&gt;)</li>\n<li>You used a function (more on this later) to write \"<code data-linenumber=\"1\">Hello from here</code>\" to the webpage.</li>\n<li>Finally, you informed the browser that you are done writing JavaScript by adding the closing script tag (&lt;/<code data-linenumber=\"1\">script</code>&gt;).</li>\n</ol>\n<p>If you followed through till now and got the result as shown, then congratulation! You just wrote your first JavaScript program. Although this is very basic, it is still an achievement because a journey of a thousand miles begins with a single step.</p>\n<div class=\"alert alert-info\" role=\"alert\"><strong>NOTE:</strong>&nbsp;There are other better ways to send output to the browser but for now&nbsp;<code data-linenumber=\"1\">documen.write()</code>&nbsp;should serve. We will introduce the rest as we progress.</div>', 1177, 'published', 'open', 0, 'first js program, first JavaScript program, first code', 'say_hello_in_javascript', 'Having introduced JavaScript briefly, the next best step for us to take is to fold up our sleeves and get dirty by writing our first code. I assure that you will learn more this way.', 11, '2020-08-21 22:07:52', '2024-07-06 16:18:17'),
(12, 1, 6, NULL, NULL, '', 'Where To Put JavaScript in HTML', '<p>You can put your JavaScript almost anywhere on your webpage but there is a few recommended ways to do it and that\'s what we will be considering.</p>\n<p>Basically, you have two kinds of scripts according to where they are written at:</p>\n<p><strong>Internal JavaScript</strong>: This is written within the opening and closing tag of the &lt;html&gt; root element a webpage.</p>\n<ul style=\"list-style-type: circle;\">\n<li>You can put it at the head section as you did in first JavaScript program</li>\n<li>You can put it within the body element as shown below:</li>\n</ul>\n<p>&nbsp;</p>\n<pre class=\"language-markup\" style=\"word-spacing: 0px;\"><code data-linenumber=1>&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n	&lt;head&gt;\n		&lt;title&gt;My Site&lt;/title&gt;\n	&lt;/head&gt;\n	&lt;body&gt;\n		&lt;script&gt;\n			document.write(\"Hello from here.\");\n		&lt;/script&gt;\n	&lt;/body&gt;\n&lt;/html&gt;</code></pre>\n<ul style=\"list-style-type: circle;\">\n<li>Or we can put it as element attribute as below:</li>\n</ul>\n<p>&nbsp;</p>\n<pre class=\"language-markup\" style=\"word-spacing: 0px;\"><code data-linenumber=1>&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n	&lt;head&gt;\n		&lt;title&gt;My Site&lt;/title&gt;\n	&lt;/head&gt;\n	&lt;body onload=\"document.write(\'Hello from here.\')\"&gt;\n	&lt;/body&gt;\n&lt;/html&gt;</code></pre>\n<p>The implementation of this last example of internal placement of JavaScript code is a bit different from the ealier two: the \"<code data-linenumber=\"1\">onload</code>\" attribute of the &lt;<code data-linenumber=\"1\">body</code>&gt; element is known as event in JavaScript (more on this later in this course). The code above in plain sentene is an instruction to the browser to display the message \"<code data-linenumber=\"1\">Hello from here.</code>\" to the webpage when the &lt;<code data-linenumber=\"1\">body</code>&gt; element is loaded.</p>\n<div class=\"alert alert-danger\" role=\"alert\">\n<p>As much as possible, avoid adding JavaScript as an attribute of html elements. It has disadvantages that will make your life much more difficult as your code grow in size.</p>\n</div>\n<p>Internal JavaScript is best when you are writing a script that will be used for only one page of your website. If one JavaScript code will be used in more than one page of your website, then internal JavaScript is a wrong way to go.</p>\n<p><strong>External JavaScript</strong>: This is the most efficient as it separates your JavaScript code from your HTML markup and therefore making it easier to maintain and use in multiple pages.</p>\n<p>To add an external JavaScript, you will still use the script tag as before (as in the head, body section) but this time around, it will have a \"src\" attribute pointing to the external JavaScript file.</p>\n<h3>How to Connect External JavaScript file to Your HTML Page</h3>\n<p>Assuming that you are saving your html file in a directory (folder) named projects:</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://www.donzoby.com/images/courses/javascript/dzb_00055_link-jsFile.png\" alt=\"\" width=\"582\" height=\"328\" /></p>\n<p>You can link to the JavaScript file by placing the below line at the&nbsp;<code data-linenumber=\"1\">head</code>&nbsp;section of your html file:</p>\n<p>&nbsp;</p>\n<pre class=\"language-markup\" style=\"word-spacing: 0px;\"><code data-linenumber=1>&lt;script src=\"hello.js\"&gt;&lt;/script&gt;</code></pre>\n<p>Then write the below JavaScript code in a new file and save it as&nbsp;<em>hello.js</em></p>\n<p>&nbsp;</p>\n<pre class=\"language-javascript\" style=\"word-spacing: 0px;\"><code data-linenumber=1>document.write(\"Hello from here.\");</code></pre>\n<div class=\"alert alert-info\" role=\"alert\">\n<p><strong>NOTE</strong>: When saving your JavaScript file, make sure it has a .js file extension so that it can be recognized and processed as a JavaScript file by the browser.</p>\n</div>\n<p>You can place external JavaScript at any place of your choice just like the internal JavaScript (except as an attribute of html).</p>', 1631, 'published', 'open', 0, 'js, where to put js, , where to put JavaScript, external js, internal js, js in element attribute', 'where_to_put_javascript_in_html', 'Deciding where to put your JavaScript code is vital and it\'s not such a hard choice to make. You have a couple of option regarding where to place your JS code: internal js or external js.', 12, '2020-08-21 22:10:37', '2024-07-06 16:18:17'),
(13, 1, 36, NULL, NULL, 'course-series', 'Introduction to PHP', '<p>PHP is a full featured programming language, easy to learn (unfortunately easy also to abuse), widely used and mainly used for back-end (server side) programming. It was created in 1994 by Ramsus Lerdorf.</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://www.donzoby.net/images/courses/php/dzb_00013_blobid0.png\" alt=\"\" width=\"698\" height=\"170\" /></p>\n<p>PHP initially stood for Personal Home Page but now stands for Hypertext Preprocessor.</p>\n<p>While PHP is used mainly for writing server-side codes/programs, it can also be used for other purposes such as building apps that runs outside of web server but because the original intention for creating PHP right from the beginning was for web programming, it is still best suited for that purpose.</p>\n<p>The aspect of PHP we shall be looking at here is the server-side programming aspect of it.</p>\n<p>Since it\'s a server-side language, it requires a web server to run. Unlike JavaScript that the browser can interpret without requiring any other tool, the browser cannot understand a PHP file.</p>\n<h3>How do we use PHP to build WebPages?</h3>\n<p>PHP is written on the server, interpreted by the server and then the output is sent to the client (browser) as HTML or other appropriate formats.</p>\n<p>From the above it is becoming clear that for us to write and run PHP codes, we need to have access to a web server and a PHP interpreter. Some personal computers (PCs) come with a server already installed and therefore the only additional thing for you to do is to install PHP. You can download and get PHP installation instructions from PHP\'s website at www.php.net.</p>\n<p>If you don&rsquo;t have a server already installed in your computer, you don\'t need to worry because setting up a web server alongside PHP has been greatly simplified by the help of some tools.</p>\n<p>There are several of such tools but I will recommend XAMPP server. It comes with Apache Server, PHP, MariaDB, Perl and MySQL (even includes phpMyAdmin for managing MySQL databases).</p>\n<p>To download and install XAMPP go to their webpage at www.apachefriends.org. They have installer for various platforms like Windows, Linux and OS X, download the one made for your operating system and install it.</p>\n<p>If you are done with the installation, then you are ready to start writing, executing&nbsp; and seeing the result of PHP code in your browser.</p>\n<h3>At what point would you need PHP?</h3>\n<p>You can build a webpage with structure, styling and interactivity using HTML, CSS and JavaScript only. The pages will look great and may even be all that some kind of websites require. But if you want go further into any of the following, then PHP can help:</p>\n<ul style=\"list-style-type: circle;\">\n<li>Collect users\' data for permanent storage</li>\n<li>Store data in database</li>\n<li>User authentication</li>\n<li>Work on files and directories</li>\n<li>Generate media on the fly etc</li>\n</ul>', 1142, 'published', 'open', 0, 'php, introduction to php, start programming in php', 'introduction_to_php', 'PHP Stand for Hypertext Preprocessor. It is a Server side scripting language, versatile, full-featured and easy to learn, write and deploy.', 13, '2020-08-21 22:12:58', '2024-07-20 16:57:06'),
(14, 1, 3, NULL, NULL, 'course-series', 'What is CorelDraw?', '<p>CorelDRAW is a vector graphics creator and editor developed by Alludo that is used to create a variety of graphics design works such as banners, signs, flyers, book covers, tracts, magazines etc.</p>\n<p>CorelDraw is beginners\' friendly and also used by seasoned graphics designers in the industry.</p>', 13, 'published', 'open', 0, 'corel draw, what is coreldraw', 'just_a_test_run', 'CorelDRAW is a vector graphics creator and editor developed by Alludo that is used to create a variety of graphic design works', 14, '2024-04-09 17:26:31', '2024-07-06 16:18:17');
INSERT INTO `test_posts` (`id`, `author_id`, `subject_id`, `version`, `parent_id`, `type`, `topic`, `content`, `hits`, `status`, `comment_status`, `comment_count`, `tags`, `slug`, `description`, `sort_value`, `created_at`, `updated_at`) VALUES
(15, 1, 6, NULL, NULL, 'course-series', 'JavaScript Data Types', '<p>What is happening to all of mankind?</p>\n<p><img src=\"http://www.donzoby.net/images/courses/javascript/dzb_00021_blobid0.png\" alt=\"\" width=\"698\" height=\"170\" /></p>\n<table class=\"ws-table-all\" style=\"box-sizing: inherit; border-collapse: collapse; border-spacing: 0px; width: 663px; border: 1px solid #cccccc; margin: 20px 0px; font-family: Verdana, sans-serif; font-size: 15px; height: 45px;\">\n<tbody style=\"box-sizing: inherit;\">\n<tr style=\"box-sizing: inherit; border-bottom: 1px solid #dddddd;\">\n<td style=\"box-sizing: inherit; padding: 8px; vertical-align: top; width: 793.65px;\">Returns the key of a value if it is found in the array, and FALSE otherwise. If the value is found in the array more than once, the first matching key is returned.</td>\n</tr>\n</tbody>\n</table>\n<p><img src=\"http://www.donzoby.net/images/courses/javascript/dzb_00021_blobid1.png\" alt=\"\" width=\"635\" height=\"117\" /></p>\n<table class=\"ws-table-all\" style=\"box-sizing: inherit; border-collapse: collapse; border-spacing: 0px; width: 664px; border: 1px solid #cccccc; margin: 20px 0px; font-family: Verdana, sans-serif; font-size: 15px; height: 66px;\">\n<tbody style=\"box-sizing: inherit;\">\n<tr style=\"box-sizing: inherit; border-bottom: 1px solid #dddddd;\">\n<td style=\"box-sizing: inherit; padding: 8px; vertical-align: top; width: 793.65px;\">Returns the key of a value if it is found in the array, and FALSE otherwise. The first matching key is returned if the value is found in the array more than once.</td>\n</tr>\n</tbody>\n</table>\n<p><img src=\"http://www.donzoby.net/images/courses/javascript/dzb_00021_blobid2.png\" alt=\"\" width=\"410\" height=\"204\" /></p>\n<p>I am curious but before trying to solve a problem, let me verify that actually, it is a problem.</p>\n<p>&nbsp;</p>', 0, 'published', 'open', 0, 'inline element, html elements, html inline elements', 'javascript_data_types', 'Returns the key of a value if it is found in the array, and FALSE otherwise. If the value is found in the array more than once, the first matching key is returned.', 0, '2024-07-22 11:34:53', '2024-07-27 10:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `test_post_images`
--

CREATE TABLE `test_post_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_post_id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) NOT NULL,
  `dimension` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`dimension`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_post_images`
--

INSERT INTO `test_post_images` (`id`, `test_post_id`, `link`, `dimension`, `created_at`, `updated_at`) VALUES
(3, 1, 'images/courses/javascript/dzb-web-design.png', NULL, '2018-12-25 21:44:40', '2024-04-08 14:28:10'),
(11, 2, 'images/courses/gimp/crop-image.png', NULL, '2019-01-03 05:49:17', '2024-04-08 14:28:10'),
(12, 2, 'images/courses/gimp/select-crop-portion.png', NULL, '2019-01-03 05:49:17', '2024-04-08 14:28:10'),
(13, 2, 'images/courses/gimp/crop-image-result.png', NULL, '2019-01-03 05:49:17', '2024-04-08 14:28:10'),
(15, 5, 'images/courses/service-providers/glo_night_data_new.jpg', NULL, '2019-12-18 06:33:05', '2024-04-08 14:28:10'),
(16, 6, 'images/courses/service-providers/glo_data_balance.png', NULL, '2020-03-06 00:43:24', '2024-04-08 14:28:10'),
(18, 8, 'images/courses/html/dzb_00051_sublime-editor.png', NULL, '2020-07-16 19:31:26', '2024-04-08 14:28:10'),
(19, 3, 'images/courses/service-providers/dzb_00046_glo-free-youtube-data.png', NULL, '2020-07-16 20:25:00', '2024-04-08 14:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `tel` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `post_count` bigint(20) NOT NULL DEFAULT 0,
  `status` enum('active','suspended') NOT NULL DEFAULT 'active',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `tel`, `gender`, `avatar`, `country`, `post_count`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Peter', 'Edenben', 'upc4you@gmail.com', '2018-12-24 19:31:45', '08034563475', 'male', 'images/profile/upc4you_1.png', 'Nigeria', 3, 'active', '$2y$12$iY5s6Zfd0eu0X4BF1pJEJuzmX5iD4FkHmh9tE.E.kx.ExzdRWYhGO', NULL, '2018-11-12 15:42:30', '2024-07-22 11:34:53'),
(2, 'Donzoby', NULL, 'upc4u@gmail.com', '2018-12-11 00:00:00', '07067137110', 'male', 'images/profile/upc4u_2.jpg', 'Nigeria', 0, 'active', '$2y$12$B3yDY5uHtIp/drn8F6iQeOu4uBqp2R1DsjCITX7N4yNJL/uy2SsXS', NULL, '2018-12-16 13:18:11', '2024-07-08 12:11:37'),
(3, 'Wilfred Kelechi', NULL, 'greatbishopking@gmail.com', '2022-10-14 00:30:21', '08132640916', 'm', '', 'Nigeria', 0, 'active', '$2y$10$pLvqjWixca8rZNxQZiIMueo8NQxPzAgdUyOr0t2.gIMX1qVliub0O', NULL, '2022-10-14 00:24:11', '2022-10-14 00:30:21'),
(4, 'digitupl', NULL, 'digitu2oo@gadania.site', '2023-10-06 14:01:10', '87738624382', '1', '', 'Cook Islands', 0, 'active', '$2y$10$01iXzm6Vg42ZJsydbFBPseoTmgo.UI7aBM1zxJsuvKH479MZWK4Si', NULL, '2023-10-06 13:56:25', '2023-10-06 14:01:10'),
(5, 'wmltupl', NULL, 'wmltu2oo@catcasinostyle.ru', '2023-11-17 19:10:07', '84953431687', '1', '', 'Cook Islands', 0, 'active', '$2y$10$p/l.mLQrWlvnzdXqtOXZ5u3hORaJf7KeoudRgsnA5ITKemLRbp7be', NULL, '2023-11-17 19:07:09', '2023-11-17 19:10:07'),
(6, 'Chizoba', 'De', 'realdonzoby@gmail.com', '2024-05-01 16:36:41', '23467676767', '', 'images/profile/realdonzoby_7767.jpg', 'NIG', 0, 'active', '$2y$12$W21vODHyIeA8MRPDAW9HrO9J8kiM9O2zGCI6/8mwpiCRWTlcIY2De', NULL, '2024-05-01 16:36:36', '2024-05-01 17:10:52'),
(7, 'Proomarry', NULL, 'outlizgog@envelopelink.space', '2024-06-15 10:13:06', '82545929737', '', '', 'Singapore', 0, 'active', '$2y$10$50F1pGbUf.IhAhaAPf3sLukQBRXAhIei3maYEEzQK6y8h8n5aUpJ.', NULL, '2024-05-21 04:55:57', '2024-05-21 04:58:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `data_plans`
--
ALTER TABLE `data_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`author_id`),
  ADD KEY `posts_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_images_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_syncs`
--
ALTER TABLE `post_syncs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_syncs_post_id_foreign` (`post_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `subjects_course_id_foreign` (`course_id`);

--
-- Indexes for table `test_posts`
--
ALTER TABLE `test_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`author_id`),
  ADD KEY `test_posts_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `test_post_images`
--
ALTER TABLE `test_post_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_post_images_test_post_id_foreign` (`test_post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_tel_unique` (`tel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_plans`
--
ALTER TABLE `data_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `test_posts`
--
ALTER TABLE `test_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `test_post_images`
--
ALTER TABLE `test_post_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_images`
--
ALTER TABLE `post_images`
  ADD CONSTRAINT `post_images_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_syncs`
--
ALTER TABLE `post_syncs`
  ADD CONSTRAINT `post_syncs_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `test_post_images`
--
ALTER TABLE `test_post_images`
  ADD CONSTRAINT `test_post_images_test_post_id_foreign` FOREIGN KEY (`test_post_id`) REFERENCES `test_posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
