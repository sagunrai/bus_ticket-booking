-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2022 at 03:13 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bussewa`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutuses`
--

CREATE TABLE `aboutuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `aboutus` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pphone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pgender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `map` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `bookingdate` date DEFAULT NULL,
  `bus_id` bigint(20) UNSIGNED DEFAULT NULL,
  `departuretime` time DEFAULT NULL,
  `arrivaltime` time DEFAULT NULL,
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `pname`, `pemail`, `pphone`, `pgender`, `page`, `map`, `bookingdate`, `bus_id`, `departuretime`, `arrivaltime`, `payment`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Samana Parsai', 'samanaparsai@gmail.com', '98707877', 'female', '21', '1,1,3', NULL, NULL, NULL, NULL, NULL, 'active', '2022-01-04 09:21:19', '2022-01-04 09:21:19'),
(2, 'Pradip Sah', 'pradipks2020@gmail.com', '98707877', 'male', '21', '1,1,3|2,1,3', NULL, NULL, NULL, NULL, NULL, 'active', '2022-01-04 09:31:28', '2022-01-04 09:31:28'),
(3, 'Pradip Sah', 'pradipks2020@gmail.com', '98707877', 'male', '21', '1,1,3', NULL, NULL, NULL, NULL, NULL, 'active', '2022-01-04 09:54:13', '2022-01-04 09:54:13'),
(4, 'Pradip Sah', 'pradipks2020@gmail.com', '98707877', 'male', '21', '46|41', NULL, NULL, NULL, NULL, NULL, 'active', '2022-01-05 00:15:53', '2022-01-05 00:15:53'),
(5, 'Samana Parsai', 'samanaparsai@gmail.com', '98707877', 'female', '20', '1|11|21|31', NULL, NULL, NULL, NULL, NULL, 'active', '2022-01-05 00:33:14', '2022-01-05 00:33:14'),
(6, 'Samana Parsai', 'samanaparsai@gmail.com', '98707877', 'female', '21', '16', NULL, NULL, NULL, NULL, NULL, 'active', '2022-01-05 01:31:30', '2022-01-05 01:31:30'),
(7, 'Pradip Sah', 'samanaparsai@gmail.com', '98707877', 'male', '21', '12|22|27', NULL, NULL, NULL, NULL, NULL, 'active', '2022-01-05 15:19:31', '2022-01-05 15:19:31'),
(8, 'Pradip Sah', 'pradipks2020@gmail.com', '98707877', 'male', '21', '1', NULL, NULL, NULL, NULL, NULL, 'active', '2022-01-07 11:05:02', '2022-01-07 11:05:02'),
(9, 'Pradip Sah', 'pradipks2020@gmail.com', '98707877', 'male', '21', '21|26', NULL, 4, NULL, NULL, NULL, 'active', '2022-01-13 12:22:45', '2022-01-13 12:22:45'),
(10, 'Pradip Sah', 'pradipks2020@gmail.com', '98707877', 'male', '21', '21|26', NULL, 4, NULL, NULL, NULL, 'active', '2022-01-13 12:22:46', '2022-01-13 12:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bustype` bigint(20) UNSIGNED DEFAULT NULL,
  `busroute` bigint(20) UNSIGNED DEFAULT NULL,
  `departuretime` time NOT NULL,
  `arrivaltime` time NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `persitprice` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `persitpricedisper` int(250) NOT NULL,
  `sunday` int(250) DEFAULT 0,
  `monday` int(250) DEFAULT 0,
  `tuesday` int(250) DEFAULT 0,
  `wednesday` int(250) DEFAULT 0,
  `thursday` int(250) DEFAULT 0,
  `friday` int(250) DEFAULT 0,
  `saturday` int(250) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `name`, `bustype`, `busroute`, `departuretime`, `arrivaltime`, `image`, `status`, `created_at`, `updated_at`, `persitprice`, `persitpricedisper`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`) VALUES
(3, 'Shri Bawa Lal Tour and Travels', 1, 8, '09:10:00', '00:10:00', 'upload/content/image/image-2022-01-10-12-41-03-hwL.jpg', 'inactive', '2022-01-03 10:25:09', '2022-01-10 06:57:24', '200', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'AC Delux Bus Sales Agents, AC Delux Bus Sales Representatives', 1, 5, '04:14:00', '18:14:00', 'upload/content/image/image-2022-01-03-04-14-47-gZj.jpg', 'active', '2022-01-03 10:29:47', '2022-01-03 10:29:47', '200', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'GrihaSewa Delux', 3, 8, '07:00:00', '12:01:00', 'upload/content/image/image-2022-01-05-08-58-03-vpl.jpg', 'active', '2022-01-05 15:13:03', '2022-01-05 15:13:03', '900', 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Najani Travels Delux(AC)', 3, 3, '13:13:00', '06:15:00', 'upload/content/image/image-2022-01-06-01-13-20-sLl.jpg', 'active', '2022-01-06 07:28:20', '2022-01-06 07:28:20', '500', 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Main BUs Deleux sewa', 3, 3, '23:00:00', '14:34:00', 'upload/content/image/image-2022-01-08-10-31-52-Dwu.jpg', 'active', '2022-01-08 04:46:52', '2022-01-08 04:46:52', '800', 2, 1, 1, 1, 1, 1, 1, NULL),
(9, 'Pradip kumar Sah', 1, 4, '22:33:00', '14:36:00', 'upload/content/image/image-2022-01-08-10-32-44-CEg.jpg', 'active', '2022-01-08 04:47:44', '2022-01-08 04:47:44', '112', 22, 1, 1, 1, 1, 1, 1, 1),
(10, 'Pradip kumar Sah', 1, 3, '22:34:00', '22:38:00', 'upload/content/image/image-2022-01-08-10-33-22-nlo.jpg', 'active', '2022-01-08 04:48:22', '2022-01-08 04:48:22', '65', 6556, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bustypes`
--

CREATE TABLE `bustypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `map` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `seats` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_row` int(11) NOT NULL DEFAULT 0,
  `n_col` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bustypes`
--

INSERT INTO `bustypes` (`id`, `name`, `map`, `seats`, `n_row`, `n_col`, `created_at`, `updated_at`) VALUES
(1, '22 Setebus', '1,1,1|2,1,1|3,1,1|5,1,1|4,1,1|6,1,1|7,1,1|8,1,1|9,1,1|10,1,1', '22', 10, 5, '2022-01-03 15:52:58', '2022-01-03 15:52:58'),
(2, 'i dont know', '1,1,1|2,1,1|3,1,1|1,5,2|2,4,1|2,5,1|3,4,1|3,5,1|4,5,1|4,4,1|5,4,1|5,5,1|6,4,1|6,5,1|7,5,1|7,4,1|8,4,1|8,5,1|9,5,1|9,4,1|10,4,1|10,5,1|10,2,1|10,1,1|10,3,1|8,2,1|9,1,1|9,2,1|8,1,1|7,2,1|7,1,1|6,1,1|6,2,1|5,2,2|5,1,1|4,1,0|3,2,1', '40', 10, 5, '2022-01-05 01:36:16', '2022-01-05 01:36:16'),
(3, '38 Sete Bus', '1,1,1|2,1,1|3,1,1|4,1,1|5,1,1|6,1,1|7,1,1|8,1,1|9,1,1|10,1,1|10,2,1|10,3,1|10,4,1|10,5,1|9,5,1|9,4,1|8,4,1|8,5,1|9,2,1|8,2,1|7,2,1|6,2,1|5,2,1|4,2,1|7,4,1|7,5,1|6,5,1|6,4,1|5,4,1|5,5,1|4,4,1|4,5,1|1,2,0|1,5,2|2,5,1|2,4,1|2,2,0|3,2,1', '38', 10, 5, '2022-01-05 15:09:31', '2022-01-05 15:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sn` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_parent` tinyint(1) NOT NULL DEFAULT 1,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subparent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `sn`, `name`, `is_parent`, `parent_id`, `subparent_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Dharan', 1, NULL, NULL, 'active', '2022-01-02 10:00:17', '2022-01-02 10:00:17'),
(2, 0, 'BRT', 1, NULL, NULL, 'active', '2022-01-02 10:00:23', '2022-01-02 10:00:23'),
(3, 0, 'BRT to Dharan', 0, 1, 2, 'active', '2022-01-02 10:00:39', '2022-01-02 10:00:39'),
(4, 0, 'BRT to Dharan', 0, 2, 1, 'active', '2022-01-02 10:00:50', '2022-01-02 10:00:50'),
(5, 0, 'BRT to Dharan', 0, 2, 1, 'active', '2022-01-02 10:00:51', '2022-01-02 10:00:51'),
(6, 0, 'Itahari', 1, NULL, NULL, 'active', '2022-01-05 15:04:05', '2022-01-05 15:04:05'),
(7, 0, 'Damak', 1, NULL, NULL, 'active', '2022-01-05 15:04:11', '2022-01-05 15:04:11'),
(8, 0, 'Itahari to Damak', 0, 6, 7, 'active', '2022-01-05 15:06:07', '2022-01-05 15:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `contactuses`
--

CREATE TABLE `contactuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contactus` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `slag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `name`, `image`, `description`, `status`, `slag`, `created_at`, `updated_at`) VALUES
(2, NULL, 'content/epaper/imagecpzknk0ye.jpg', NULL, 'active', 'KQQbGKXA', '2022-01-07 12:09:36', '2022-01-07 12:09:36'),
(3, NULL, 'content/epaper/imagegnboftrdg.jpg', NULL, 'active', 'CiyrD9IX', '2022-01-07 12:09:47', '2022-01-07 12:09:47'),
(4, NULL, 'content/epaper/imaget1aemj7ex.jpg', NULL, 'active', 'EoSnRBW0', '2022-01-07 12:09:52', '2022-01-07 12:09:52'),
(5, NULL, 'content/epaper/image7bsqf6sbt.jpg', NULL, 'active', 'iqtbF25D', '2022-01-07 12:10:19', '2022-01-07 12:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facebook` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_20_133207_create_links_table', 1),
(5, '2021_06_24_125809_create_categories_table', 1),
(6, '2021_06_25_141526_create_settings_table', 1),
(7, '2021_08_01_080831_create_aboutuses_table', 1),
(8, '2021_08_01_081406_create_contactuses_table', 1),
(9, '2021_08_01_081428_create_privacypolicies_table', 1),
(10, '2021_08_02_112938_create_termsandconditions_table', 1),
(11, '2021_12_30_130642_create_bustypes_table', 1),
(12, '2021_12_30_173050_create_buses_table', 1),
(17, '2022_01_04_134215_create_bookings_table', 2),
(18, '2022_02_02_125739_create_galleries_table', 3),
(19, '2022_01_12_163509_create_new_column_inusertable', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privacypolicies`
--

CREATE TABLE `privacypolicies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `privacypolicy` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footerlogo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logotext` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descriptionfooter` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `termsandconditions`
--

CREATE TABLE `termsandconditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `termsandconditions` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('user','Superadmin','Admin','Author','Editor') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `role`, `status`, `remember_token`, `created_at`, `updated_at`, `phone`, `gender`) VALUES
(1, 'Pradip Sah', 'pradipks2022@gmail.com', NULL, '000000000', 'content/users/imagewxy0gfhfi.jpg', 'Admin', 'active', NULL, '2022-01-03 15:51:56', '2022-01-10 05:03:20', NULL, NULL),
(5, 'Pradip kumar Sah', 'pradipks2020@gmail.com', NULL, '$2y$10$lYNr8.zeDjQhLm4RJLKQF.Cwv6uqDUtZaXqtaGEn4LEHe2vCCUpGy', NULL, 'Admin', 'active', 'M1JnyEQLqJxymp58QQtBvilrGS5Zclg3AjniKcWVOHXvazWn7O0OCXhzUEdX', '2022-01-12 10:31:59', '2022-01-12 10:31:59', NULL, NULL),
(6, 'Pradip kumar Sah', 'pradipks2024@gmail.com', NULL, '$2y$10$3KckZnGaCj467YDu5HNsiupfbxvXD/YLrehArspvyCQE4SFgPuzty', NULL, 'user', 'active', NULL, '2022-01-12 10:43:45', '2022-01-12 10:43:45', NULL, NULL),
(7, 'Pradip kumar Sah', 'pradipks2055@gmail.com', NULL, '$2y$10$l0BKA70YeSB9p7O.gO/zuO7pb.XCicjV0EZtNjJo7T7fjMPiyGGNK', NULL, 'user', 'active', NULL, '2022-01-12 10:52:20', '2022-01-12 10:52:20', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutuses`
--
ALTER TABLE `aboutuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_bus_id_foreign` (`bus_id`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buses_bustype_foreign` (`bustype`),
  ADD KEY `buses_busroute_foreign` (`busroute`);

--
-- Indexes for table `bustypes`
--
ALTER TABLE `bustypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`),
  ADD KEY `categories_subparent_id_foreign` (`subparent_id`);

--
-- Indexes for table `contactuses`
--
ALTER TABLE `contactuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `galleries_slag_unique` (`slag`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `links_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `privacypolicies`
--
ALTER TABLE `privacypolicies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_slag_unique` (`slag`);

--
-- Indexes for table `termsandconditions`
--
ALTER TABLE `termsandconditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutuses`
--
ALTER TABLE `aboutuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bustypes`
--
ALTER TABLE `bustypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contactuses`
--
ALTER TABLE `contactuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `privacypolicies`
--
ALTER TABLE `privacypolicies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `termsandconditions`
--
ALTER TABLE `termsandconditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_bus_id_foreign` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `categories_subparent_id_foreign` FOREIGN KEY (`subparent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
