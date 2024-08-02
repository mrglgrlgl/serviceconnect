-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2024 at 02:09 PM
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
-- Database: `neu_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `id` int(11) UNSIGNED NOT NULL,
  `service_request_id` bigint(20) UNSIGNED NOT NULL,
  `bidder_id` bigint(20) UNSIGNED NOT NULL,
  `bid_amount` decimal(10,2) NOT NULL,
  `bid_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `agreed_to_terms` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `service_request_id`, `bidder_id`, `bid_amount`, `bid_description`, `created_at`, `updated_at`, `status`, `agreed_to_terms`) VALUES
(1, 11, 75, 213.00, 'yas', '2024-07-14 10:24:24', '2024-07-14 10:24:24', 'pending', 0),
(5, 14, 85, 212.00, 'ye', '2024-07-14 22:42:02', '2024-07-14 22:42:02', 'pending', 0),
(6, 14, 85, 345.00, '3rdfdassdadas', '2024-07-14 23:08:09', '2024-07-14 23:08:09', 'pending', 0),
(7, 11, 85, 234.00, 'sdfsdfs', '2024-07-14 23:11:05', '2024-07-14 23:11:05', 'pending', 0),
(8, 15, 72, 500.00, 'yes', '2024-07-16 10:53:31', '2024-07-19 00:47:42', 'accepted', 0),
(9, 15, 72, 700.00, 'sg', '2024-07-17 12:08:16', '2024-07-22 03:09:48', 'pending', 0),
(10, 15, 72, 122.00, 'dafasdfasdfsa', '2024-07-18 01:43:20', '2024-07-19 00:47:42', 'rejected', 0),
(11, 17, 72, 456.00, 'ghjgkhgj', '2024-07-19 06:09:38', '2024-07-20 04:16:16', 'accepted', 0),
(12, 20, 72, 233.00, 'sss', '2024-07-20 03:47:07', '2024-07-21 23:44:38', 'rejected', 0),
(13, 20, 86, 12.00, 'a', '2024-07-20 06:24:03', '2024-07-21 23:44:38', 'accepted', 0),
(14, 21, 86, 123.00, 'this sdfsadf', '2024-07-22 02:29:47', '2024-07-22 02:30:10', 'accepted', 0),
(15, 22, 86, 56.00, 'h', '2024-07-23 05:59:43', '2024-07-23 06:00:00', 'accepted', 0),
(16, 23, 86, 400.00, 'a', '2024-07-23 22:53:51', '2024-07-23 22:53:58', 'accepted', 0),
(17, 24, 86, 123.00, 'a', '2024-07-25 02:37:26', '2024-07-25 02:37:35', 'accepted', 0),
(18, 25, 86, 12.00, 'a', '2024-07-25 04:51:23', '2024-07-25 04:51:28', 'accepted', 0),
(19, 26, 86, 233.00, 'd', '2024-07-25 05:07:08', '2024-07-25 05:07:16', 'accepted', 0),
(20, 27, 86, 333.00, '2', '2024-07-25 09:42:50', '2024-07-25 09:43:01', 'accepted', 0),
(21, 28, 94, 900.00, 'bid 1', '2024-07-26 01:32:03', '2024-07-26 01:35:06', 'accepted', 0),
(22, 29, 98, 1000.00, 'I can make it cheaper', '2024-07-26 06:41:00', '2024-07-26 06:41:09', 'accepted', 0),
(23, 30, 98, 1000.00, 'f', '2024-07-26 07:05:36', '2024-07-26 07:05:43', 'accepted', 0),
(24, 31, 98, 12000.00, 'ggg', '2024-07-26 07:13:22', '2024-07-26 07:13:27', 'accepted', 0),
(25, 32, 98, 120.00, 'g', '2024-07-26 07:23:15', '2024-07-26 07:23:23', 'accepted', 0),
(26, 38, 98, 90000.00, 'Cost not enough for the task', '2024-07-27 04:04:03', '2024-07-27 04:04:30', 'accepted', 0),
(27, 39, 98, 500.00, 'a', '2024-07-27 05:04:58', '2024-07-27 07:16:45', 'accepted', 0),
(28, 40, 98, 350.00, 'a', '2024-07-27 08:14:17', '2024-07-27 08:14:30', 'accepted', 0),
(29, 43, 102, 2000.00, 'rrr', '2024-07-30 04:27:12', '2024-07-30 07:18:28', 'accepted', 0),
(30, 19, 86, 23.00, 'fsdfs', '2024-07-30 08:27:41', '2024-07-30 08:27:41', 'pending', 0),
(31, 45, 86, 456.00, 'sdfs', '2024-07-30 17:35:09', '2024-07-31 05:02:29', 'accepted', 0),
(32, 14, 86, 234.00, 'ff', '2024-07-30 17:36:04', '2024-07-30 17:36:04', 'pending', 0),
(34, 11, 98, 100.00, 'asdfsadf', '2024-07-30 17:46:41', '2024-07-30 17:46:41', 'pending', 1),
(35, 18, 98, 34534.00, 'dggd', '2024-07-30 17:47:01', '2024-07-30 17:47:01', 'pending', 1),
(36, 53, 98, 345.00, 'gdfdfggh', '2024-07-31 00:09:42', '2024-07-31 00:10:59', 'accepted', 1),
(37, 45, 102, 345.00, 'dfdfdfd', '2024-07-31 05:02:15', '2024-07-31 05:02:32', 'rejected', 1),
(38, 65, 98, 600.00, 'sdfsdf', '2024-07-31 05:21:09', '2024-07-31 21:39:09', 'accepted', 1),
(39, 65, 98, 600.00, 'sdfsdf', '2024-07-31 05:21:54', '2024-07-31 21:39:13', 'rejected', 1),
(40, 65, 98, 600.00, 'sdfsdf', '2024-07-31 05:23:59', '2024-07-31 21:39:13', 'rejected', 1),
(41, 50, 98, 56565.00, 'fhgfhf', '2024-07-31 05:47:53', '2024-07-31 05:47:53', 'pending', 1),
(42, 64, 98, 233.00, 'rdfgdfg', '2024-07-31 05:50:45', '2024-07-31 05:50:45', 'pending', 1),
(43, 64, 98, 233.00, 'rdfgdfg', '2024-07-31 05:50:45', '2024-07-31 05:50:45', 'pending', 1),
(44, 66, 102, 45.00, 'sdfafd', '2024-07-31 22:46:24', '2024-07-31 23:25:22', 'rejected', 1),
(45, 66, 86, 50.00, 'sadfsdfads', '2024-07-31 23:14:42', '2024-07-31 23:25:19', 'accepted', 1),
(46, 75, 98, 1234.00, 'sfsdfsd', '2024-08-01 22:53:35', '2024-08-01 23:02:47', 'accepted', 1),
(47, 68, 98, 150.00, 'tesyes', '2024-08-02 00:19:26', '2024-08-02 00:19:26', 'pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `issuing_organization` varchar(255) NOT NULL,
  `date_attained` date NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`id`, `provider_id`, `name`, `issuing_organization`, `date_attained`, `expiry_date`, `description`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 102, 'Plumbing Expert Certification', 'Philippine Association of Plumbing Professionals (PAPP)', '2019-01-05', NULL, 'Certified expert in plumbing with skills in installation and repair.', 'certifications/R9QXValpzVsJ5mLch49BPFMEU8d793r4CCj1hECQ.jpg', '2024-07-29 08:22:07', '2024-07-29 08:22:07'),
(2, 102, 'HVAC Specialist Certification', 'Philippine Society of HVAC', '2021-02-22', NULL, 'Certification for expertise in heating, ventilation, and air conditioning systems.', 'certifications/JnkxG6sVy2IVi0hQwnzvKo3Bgm8TqroiOcF9PUTH.jpg', '2024-07-29 08:50:17', '2024-07-29 08:50:17'),
(3, 102, 'Advanced Plumbing Certification', 'National Plumbing Association', '2023-01-15', NULL, NULL, 'certifications/Bd7wUolFNwuu5N6siBgKqIaDOz4AVXxzF42MUbtI.jpg', '2024-08-01 20:35:57', '2024-08-01 20:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seeker_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_request_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bid_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','in_progress','completed','cancelled') NOT NULL DEFAULT 'in_progress',
  `is_on_the_way` tinyint(1) DEFAULT NULL,
  `is_arrived` enum('pending','true') DEFAULT NULL,
  `is_task_started` enum('pending','true') DEFAULT NULL,
  `is_task_completed` enum('pending','true') DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `completion_time` datetime DEFAULT NULL,
  `is_paid` enum('pending','true') DEFAULT 'pending',
  `amount_paid` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`id`, `seeker_id`, `provider_id`, `service_request_id`, `bid_id`, `created_at`, `updated_at`, `status`, `is_on_the_way`, `is_arrived`, `is_task_started`, `is_task_completed`, `start_time`, `completion_time`, `is_paid`, `amount_paid`) VALUES
(2, 75, 86, 21, 14, '2024-07-22 02:30:10', '2024-07-22 02:30:10', 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(3, 75, 86, 22, 15, '2024-07-23 06:00:00', '2024-07-24 09:59:56', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, 'true', 0),
(4, 75, 86, 23, 16, '2024-07-23 22:53:59', '2024-07-25 12:42:41', 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(5, 75, 86, 24, 17, '2024-07-25 02:37:35', '2024-07-25 04:48:07', 'pending', 1, 'true', 'true', 'true', '2024-07-25 12:47:49', '2024-07-25 12:48:07', '', 0),
(6, 75, 86, 25, 18, '2024-07-25 04:51:29', '2024-07-25 04:52:24', 'completed', 1, 'true', 'true', 'true', '2024-07-25 12:52:09', '2024-07-25 12:52:19', 'true', 0),
(7, 75, 86, 26, 19, '2024-07-25 05:07:17', '2024-07-25 05:09:32', 'completed', 1, 'true', 'true', 'true', '2024-07-25 13:08:20', '2024-07-25 13:09:15', 'true', 0),
(9, 93, 94, 28, 21, '2024-07-26 01:35:06', '2024-07-26 01:41:01', 'in_progress', 1, 'pending', NULL, NULL, NULL, NULL, 'pending', 0),
(10, 95, 98, 29, 22, '2024-07-26 06:41:10', '2024-07-26 06:45:17', 'completed', 1, 'true', 'true', 'true', '2024-07-26 14:44:53', '2024-07-26 14:45:09', 'true', 0),
(11, 95, 98, 30, 23, '2024-07-26 07:05:43', '2024-07-26 07:09:33', 'completed', 1, 'true', 'true', 'true', '2024-07-26 15:07:53', '2024-07-26 15:08:07', 'true', 0),
(12, 95, 98, 31, 24, '2024-07-26 07:13:27', '2024-07-26 07:18:01', 'completed', 1, 'true', 'true', 'true', '2024-07-26 15:17:43', '2024-07-26 15:17:52', 'true', 0),
(13, 95, 98, 32, 25, '2024-07-26 07:23:23', '2024-07-26 07:26:43', 'completed', 1, 'true', 'true', 'true', '2024-07-26 15:26:28', '2024-07-26 15:26:36', 'true', 0),
(14, 95, 98, 38, 26, '2024-07-27 04:04:30', '2024-07-27 04:05:29', 'completed', 1, 'true', 'true', 'true', '2024-07-27 12:05:03', '2024-07-27 12:05:22', 'true', 0),
(15, 95, 98, 39, 27, '2024-07-27 07:16:46', '2024-07-27 07:18:04', 'completed', 1, 'true', 'true', 'true', '2024-07-27 15:17:45', '2024-07-27 15:17:59', 'true', 0),
(16, 95, 98, 40, 28, '2024-07-27 08:14:32', '2024-07-27 08:14:32', 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 0),
(17, 95, 102, 43, 29, '2024-07-30 07:18:29', '2024-07-30 08:16:51', 'completed', 1, 'true', 'true', 'true', '2024-07-30 16:16:37', '2024-07-30 16:16:44', 'true', 0),
(18, 95, 98, 53, 36, '2024-07-31 00:10:59', '2024-07-31 00:10:59', 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 0),
(19, 95, 86, 45, 31, '2024-07-31 05:02:30', '2024-07-31 05:02:30', 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 0),
(20, 95, 98, 65, 38, '2024-07-31 21:39:10', '2024-07-31 21:39:10', 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 0),
(21, 95, 86, 66, 45, '2024-07-31 23:25:21', '2024-07-31 23:36:38', 'in_progress', 1, NULL, NULL, NULL, NULL, NULL, 'pending', 0),
(22, 95, 98, 75, 46, '2024-08-01 23:02:47', '2024-08-01 23:02:47', 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 0);

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
(4, '2024_06_25_105407_add_birthdate_to_users_table', 1),
(5, '2024_06_25_114631_add_gender_to_users_table', 1),
(6, '2024_06_26_123700_add_address_column_to_users_table', 1),
(7, '2024_06_30_082458_create_permission_tables', 2),
(8, '2024_07_20_040429_create_notifications_table', 3),
(9, '2024_07_23_155951_add_task_tracking_columns_to_channels_table', 4),
(10, '2024_07_23_164252_add_task_tracking_columns_to_channel_table', 5);

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

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('14d0b7d7-a17e-4f37-8930-68a99011bcb5', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: House Painting\",\"bid_id\":22,\"service_request_id\":29}', NULL, '2024-07-26 06:41:12', '2024-07-26 06:41:12'),
('16580d1e-2d62-4872-a777-96c0761367d8', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 95, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":45,\"provider_name\":null}', NULL, '2024-07-31 23:14:43', '2024-07-31 23:14:43'),
('21a06f53-5248-4458-9855-ae6aef62dbd1', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: k\",\"bid_id\":20,\"service_request_id\":27}', NULL, '2024-07-25 09:43:06', '2024-07-25 09:43:06'),
('331a80fc-6ee5-4826-8d37-7524024db039', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: w\",\"bid_id\":14,\"service_request_id\":21}', NULL, '2024-07-22 02:30:15', '2024-07-22 02:30:15'),
('337998d6-2c91-43d4-a352-1c0bd9b1498c', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: Pump Installation\",\"bid_id\":45,\"service_request_id\":66}', NULL, '2024-07-31 23:25:22', '2024-07-31 23:25:22'),
('3596b769-d1e4-4865-8eac-5e6571faad34', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Shelving Installation\",\"bid_id\":27,\"service_request_id\":39}', NULL, '2024-07-27 07:16:48', '2024-07-27 07:16:48'),
('4c8eb5f8-eb3a-48d3-98f0-c3b8bff4699e', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: v\",\"bid_id\":19,\"service_request_id\":26}', NULL, '2024-07-25 05:07:18', '2024-07-25 05:07:18'),
('5b24e641-5a22-4870-ab95-8e446738f0ca', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Bookshelf Construction\",\"bid_id\":26,\"service_request_id\":38}', NULL, '2024-07-27 04:04:35', '2024-07-27 04:04:35'),
('5dfbd36f-8cdc-45a5-b719-52382c8148e2', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 95, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":46,\"provider_name\":null}', NULL, '2024-08-01 22:53:39', '2024-08-01 22:53:39'),
('7a17eeb1-91c6-433c-8f35-5f720fba2df3', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 95, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":44,\"provider_name\":null}', NULL, '2024-07-31 22:46:25', '2024-07-31 22:46:25'),
('7e684801-4283-4a2c-95df-ff82cb804846', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 103, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":47,\"provider_name\":null}', NULL, '2024-08-02 00:19:28', '2024-08-02 00:19:28'),
('8a6ed16f-1460-438a-830d-8ea7ce05132c', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 102, '{\"message\":\"Your bid has been confirmed for the service request: f\",\"bid_id\":29,\"service_request_id\":43}', NULL, '2024-07-30 07:18:37', '2024-07-30 07:18:37'),
('8b94a66d-9dae-4a77-9fcb-265d56af055d', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: v\",\"bid_id\":31,\"service_request_id\":45}', NULL, '2024-07-31 05:02:32', '2024-07-31 05:02:32'),
('9f3624b1-3d64-433b-98c6-45765847e46d', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: m\",\"bid_id\":18,\"service_request_id\":25}', NULL, '2024-07-25 04:51:30', '2024-07-25 04:51:30'),
('a7ac7f4d-6fde-4ee7-a246-7b8495de9607', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Gazebo Construction\",\"bid_id\":28,\"service_request_id\":40}', NULL, '2024-07-27 08:14:33', '2024-07-27 08:14:33'),
('a9b21c87-1a58-4aac-89b3-09a3e5ed6324', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 94, '{\"message\":\"Your bid has been confirmed for the service request: Dining Area Electical Repair\",\"bid_id\":21,\"service_request_id\":28}', NULL, '2024-07-26 01:35:11', '2024-07-26 01:35:11'),
('b519132f-2755-42f8-ab18-ffdf3b5cd4e7', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: Not flushing\",\"bid_id\":15,\"service_request_id\":22}', NULL, '2024-07-23 06:00:04', '2024-07-23 06:00:04'),
('c15f6240-b5ba-4e1a-92bf-c318e66d1d7c', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 95, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":43,\"provider_name\":null}', NULL, '2024-07-31 05:50:46', '2024-07-31 05:50:46'),
('cc7f17e0-8164-48e2-8f1e-d9b8b694fd70', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Window Replacement\",\"bid_id\":25,\"service_request_id\":32}', NULL, '2024-07-26 07:23:23', '2024-07-26 07:23:23'),
('cdcafe82-05e0-4d60-8309-51d7cfdfc424', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Wooden Deck Repair\",\"bid_id\":36,\"service_request_id\":53}', NULL, '2024-07-31 00:11:04', '2024-07-31 00:11:04'),
('d20f3d94-8ba7-4637-8e3f-a4b105c3d8c3', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: asdasdsadasdsadad\",\"bid_id\":16,\"service_request_id\":23}', NULL, '2024-07-23 22:54:05', '2024-07-23 22:54:05'),
('d32cb8f1-31b3-4247-99fe-c7ed5062ff33', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Schedule Blocking 1\",\"bid_id\":46,\"service_request_id\":75}', NULL, '2024-08-01 23:02:48', '2024-08-01 23:02:48'),
('d8b69d9d-fb03-485b-b0c5-da58f3be5e3e', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Deck Construction\",\"bid_id\":24,\"service_request_id\":31}', NULL, '2024-07-26 07:13:27', '2024-07-26 07:13:27'),
('f4ed755a-d297-45fa-87e2-9838c18736e4', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: 1 test upload\",\"bid_id\":38,\"service_request_id\":65}', NULL, '2024-07-31 21:39:13', '2024-07-31 21:39:13'),
('f8092d80-d76e-4911-9de3-9b5d2572c697', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 95, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":42,\"provider_name\":null}', NULL, '2024-07-31 05:50:45', '2024-07-31 05:50:45'),
('feace974-f0a7-4ff6-b126-cdd5aa33c823', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Kitchen Remodeling\",\"bid_id\":23,\"service_request_id\":30}', NULL, '2024-07-26 07:05:45', '2024-07-26 07:05:45'),
('ffee9ca7-6c92-449f-9ed0-0e545616b126', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: Broken pipe\",\"bid_id\":17,\"service_request_id\":24}', NULL, '2024-07-25 02:37:39', '2024-07-25 02:37:39');

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
(1, 'create_request', 'web', '2024-07-01 18:53:26', '2024-07-01 18:53:26'),
(2, 'approve_request', 'web', '2024-07-01 18:53:26', '2024-07-01 18:53:26'),
(3, 'reject_request', 'web', '2024-07-01 18:53:27', '2024-07-01 18:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `philid_cards`
--

CREATE TABLE `philid_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `philid_number` varchar(50) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `given_names` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `blood_type` varchar(3) NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `issue_date` date DEFAULT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `front_image` varchar(255) NOT NULL,
  `back_image` varchar(255) NOT NULL,
  `status` enum('Pending','Rejected','Accepted') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `philid_cards`
--

INSERT INTO `philid_cards` (`id`, `provider_id`, `philid_number`, `last_name`, `given_names`, `middle_name`, `address`, `date_of_birth`, `gender`, `blood_type`, `civil_status`, `issue_date`, `place_of_birth`, `front_image`, `back_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 102, '1234-5678-9101', 'Navarro', 'Luis', 'Santos', '123 Rizal Street, Barangay Villamonte, Bacolod City, Philippines', '1985-03-15', 'Male', 'O+', 'Single', '2020-03-03', 'Bacolod City, Philippines', 'philid_images/iKxLwQkQkLosDvuyHjQW8U19TbPle7hBvL4YBiKE.png', 'philid_images/trTISnn27dDMgbDe6SMaImh2ipZiTU6sNpI2lysg.jpg', 'Accepted', '2024-07-29 11:55:37', '2024-08-01 11:17:12'),
(2, 98, '2345-6789-0123', 'Garcia', 'Luisa', 'Reyes', '456 Mabini Street, Barangay Mansilingan, Bacolod City, Philippines', '2024-07-22', 'Female', 'A+', 'Married', '2021-10-15', 'Bacolod City, Philippines', 'philid_images/3NHNBhJEhuHKKf5I8Qb3qtyueBImnq7INQJTPv9r.png', 'philid_images/c8ToBNyWqVomk39o73m0DMDb1gmXjaGA0qoYMnMQ.jpg', 'Accepted', '2024-07-30 03:51:18', '2024-07-30 12:26:18'),
(3, 86, '7345-6789-0127', 'Uy', 'Andrea', 'Bianca', '123 Rizal Street, Barangay Villamonte, Bacolod City, Philippines', '2000-07-21', 'Female', 'A+', 'Single', '2024-03-23', 'Bacolod City, Philippines', 'philid_images/EYTWEFbMyyv5K7MK9pcl6ey0CrjDTu3EeR2hZr4P.png', 'philid_images/qP5Irf08mRrkOjreG2U7DbVfHEMbRI0U3zD6GoOM.jpg', 'Accepted', '2024-07-30 07:33:30', '2024-07-30 15:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `provider_details`
--

CREATE TABLE `provider_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profilePicture` varchar(255) DEFAULT NULL,
  `work_email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `serviceCategory` varchar(255) NOT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `have_tools` varchar(255) NOT NULL,
  `years_of_experience` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `availability_days` varchar(255) NOT NULL,
  `skills` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `availability_time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_details`
--

INSERT INTO `provider_details` (`id`, `request_id`, `profilePicture`, `work_email`, `contact_number`, `serviceCategory`, `subcategory`, `have_tools`, `years_of_experience`, `description`, `availability_days`, `skills`, `created_at`, `updated_at`, `provider_id`, `availability_time`) VALUES
(12, 39, NULL, 'provider5@mail.com', '09991091104', 'Bus Driving', NULL, '1', NULL, 'as', '', NULL, '2024-07-14 06:12:45', '2024-07-14 06:12:45', 83, ''),
(13, 41, NULL, 'provider6@mail.com', '09991091104', 'Carpentry', NULL, '1', NULL, 's', '', NULL, '2024-07-14 21:26:14', '2024-07-14 21:27:25', 85, ''),
(14, 42, NULL, 'andrea@mail.com', '09991091104', 'Plumbing', NULL, '1', NULL, 'e', '', NULL, '2024-07-15 03:49:05', '2024-07-15 03:52:29', 86, ''),
(15, 43, NULL, 'andrelennardamar@gmail.com', '09991091104', 'Electrical', NULL, '0', NULL, 'a', '', NULL, '2024-07-22 22:53:06', '2024-07-22 23:01:14', 92, ''),
(16, 44, NULL, 'johndoe123@gmail.com', '639123456789', 'Electrical', NULL, '1', NULL, 'I am a freelance electrician with tesda level 2 accreditation', '', NULL, '2024-07-26 01:29:11', '2024-07-26 01:30:22', 94, ''),
(17, 45, NULL, 'authorizer@mail.com', '09991091104', 'Carpentry', NULL, '1', NULL, 'Skilled carpenter specializing in custom furniture', '', NULL, '2024-07-26 06:36:20', '2024-07-26 06:36:29', 98, ''),
(19, NULL, NULL, NULL, NULL, 'Plumbing', NULL, '1', 1, 'sasa', 'Friday,Saturday,Sunday', NULL, '2024-07-30 02:23:59', '2024-07-30 02:24:21', 102, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `psa_jobs`
--

CREATE TABLE `psa_jobs` (
  `id` int(11) NOT NULL,
  `Job_Title` varchar(255) NOT NULL,
  `Occupational_Wage_in_Peso` decimal(10,2) NOT NULL,
  `Average_Occupational_Wage_2024` decimal(10,2) NOT NULL,
  `Average_Occupational_Wage_per_Hour` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `psa_jobs`
--

INSERT INTO `psa_jobs` (`id`, `Job_Title`, `Occupational_Wage_in_Peso`, `Average_Occupational_Wage_2024`, `Average_Occupational_Wage_per_Hour`) VALUES
(1, 'Carpentry', 16114.24, 18706.24, 91.54),
(2, 'Plumbing', 14544.32, 16100.00, 82.67),
(3, 'Welding', 15160.44, 17179.36, 86.19),
(4, 'Building and Related', 18706.24, 18706.24, 106.24),
(5, 'Electrical', 17179.36, 18706.24, 97.61),
(6, 'Food Service', 14606.24, 14606.24, 82.99),
(7, 'Bus Driving', 15170.00, 15170.00, 0.00),
(8, 'Stone Cutting and Masonry', 16399.36, 16399.36, 93.16),
(9, 'Hairdressing', 15782.72, 15782.72, 89.72),
(10, 'Beauty Therapy', 14009.60, 14009.60, 79.60);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `channel_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rated_for_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` enum('provider','seeker') DEFAULT NULL,
  `communication` int(11) DEFAULT NULL,
  `fairness` int(11) DEFAULT NULL,
  `quality_of_service` int(11) DEFAULT NULL,
  `professionalism` int(11) DEFAULT NULL,
  `cleanliness_tidiness` int(11) DEFAULT NULL,
  `value_for_money` int(11) DEFAULT NULL,
  `additional_feedback` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `respectfulness` int(11) DEFAULT NULL,
  `preparation` int(11) DEFAULT NULL,
  `responsiveness` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `channel_id`, `rated_by_id`, `rated_for_id`, `role`, `communication`, `fairness`, `quality_of_service`, `professionalism`, `cleanliness_tidiness`, `value_for_money`, `additional_feedback`, `created_at`, `updated_at`, `respectfulness`, `preparation`, `responsiveness`) VALUES
(15, 10, 98, 95, NULL, 10, 10, NULL, NULL, NULL, NULL, 's', '2024-07-26 06:45:32', '2024-07-26 06:45:32', 10, 10, 10),
(16, 10, 95, 98, NULL, NULL, NULL, 10, 10, 10, 9, 'dxfvx', '2024-07-26 06:45:44', '2024-07-26 06:45:44', NULL, NULL, NULL),
(17, 11, 95, 98, NULL, NULL, NULL, 10, 10, 10, 10, NULL, '2024-07-26 07:09:57', '2024-07-26 07:09:57', NULL, NULL, NULL),
(18, 11, 98, 95, NULL, 10, 10, NULL, NULL, NULL, NULL, NULL, '2024-07-26 07:10:00', '2024-07-26 07:10:00', 10, 10, 10),
(19, 13, 98, 95, NULL, 10, 10, NULL, NULL, NULL, NULL, NULL, '2024-07-26 07:26:56', '2024-07-26 07:26:56', 10, 10, 10),
(20, 13, 95, 98, NULL, NULL, NULL, 10, 10, 10, 10, NULL, '2024-07-26 07:26:57', '2024-07-26 07:26:57', NULL, NULL, NULL),
(21, 14, 95, 98, NULL, NULL, NULL, 10, 10, 10, 10, NULL, '2024-07-27 04:05:43', '2024-07-27 04:05:43', NULL, NULL, NULL),
(22, 14, 98, 95, NULL, 10, 10, NULL, NULL, NULL, NULL, NULL, '2024-07-27 04:05:45', '2024-07-27 04:05:45', 10, 10, 10),
(23, 15, 98, 95, NULL, 10, 10, NULL, NULL, NULL, NULL, NULL, '2024-07-27 07:18:16', '2024-07-27 07:18:16', 10, 10, 10),
(24, 15, 95, 98, NULL, NULL, NULL, 10, 10, 10, 10, NULL, '2024-07-27 07:18:17', '2024-07-27 07:18:17', NULL, NULL, NULL),
(25, 17, 102, 95, NULL, 10, 10, NULL, NULL, NULL, NULL, NULL, '2024-07-30 08:17:06', '2024-07-30 08:17:06', 10, 10, 10),
(26, 17, 95, 102, NULL, NULL, NULL, 10, 10, 10, 10, NULL, '2024-07-30 08:17:07', '2024-07-30 08:17:07', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_request_id` bigint(20) UNSIGNED NOT NULL,
  `reason` text DEFAULT NULL,
  `issue_type` enum('non_payment','illegal_activity','unprofessional_behavior','poor_quality_work','other') NOT NULL,
  `details` text DEFAULT NULL,
  `reported_by` bigint(20) UNSIGNED NOT NULL,
  `reported_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `service_request_id`, `reason`, `issue_type`, `details`, `reported_by`, `reported_user_id`, `created_at`, `updated_at`) VALUES
(8, 29, NULL, 'non_payment', 'f', 98, NULL, '2024-08-02 02:17:52', '2024-08-02 02:17:52'),
(9, 29, NULL, 'non_payment', 'dsds', 98, 95, '2024-08-02 02:19:00', '2024-08-02 02:19:00'),
(10, 31, NULL, 'non_payment', 'fdf', 95, 98, '2024-08-02 02:19:50', '2024-08-02 02:19:50'),
(11, 29, NULL, 'non_payment', 'f', 98, 95, '2024-08-02 03:51:54', '2024-08-02 03:51:54'),
(12, 38, NULL, 'non_payment', 'hh', 98, 95, '2024-08-02 04:02:15', '2024-08-02 04:02:15'),
(13, 30, NULL, 'non_payment', 'df', 95, 98, '2024-08-02 04:04:18', '2024-08-02 04:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `request_lists`
--

CREATE TABLE `request_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_lists`
--

INSERT INTO `request_lists` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(39, 83, 'pending', '2024-07-14 06:12:19', '2024-07-14 06:12:19'),
(41, 85, 'approved', '2024-07-14 21:25:08', '2024-07-14 21:27:25'),
(42, 86, 'approved', '2024-07-15 03:46:39', '2024-07-15 03:52:29'),
(43, 92, 'approved', '2024-07-22 22:50:53', '2024-07-22 23:01:11'),
(44, 94, 'approved', '2024-07-26 01:26:50', '2024-07-26 01:30:22'),
(45, 98, 'approved', '2024-07-26 06:35:18', '2024-07-26 06:36:29'),
(46, 102, 'pending', '2024-07-28 04:17:38', '2024-07-28 04:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'seeker', 'web', '2024-07-01 18:53:24', '2024-07-01 18:53:24'),
(2, 'authorizer', 'web', '2024-07-01 18:53:24', '2024-07-01 18:53:24'),
(3, 'provider', 'web', '2024-07-01 18:53:25', '2024-07-01 18:53:25');

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
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--

CREATE TABLE `service_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `skill_tags` varchar(255) NOT NULL,
  `provider_gender` enum('male','female') DEFAULT NULL,
  `job_type` enum('project_based','hourly_rate') NOT NULL,
  `estimated_duration` int(24) NOT NULL DEFAULT 0,
  `number_of_bids` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `attach_media` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('open','in_progress','completed','cancelled') NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attach_media2` varchar(255) DEFAULT NULL,
  `attach_media3` varchar(255) DEFAULT NULL,
  `attach_media4` varchar(255) DEFAULT NULL,
  `agreed_to_terms` tinyint(1) NOT NULL DEFAULT 0,
  `min_price` decimal(10,2) DEFAULT 0.00,
  `max_price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`id`, `category`, `title`, `description`, `location`, `start_date`, `end_date`, `start_time`, `end_time`, `skill_tags`, `provider_gender`, `job_type`, `estimated_duration`, `number_of_bids`, `attach_media`, `user_id`, `provider_id`, `status`, `created_at`, `updated_at`, `attach_media2`, `attach_media3`, `attach_media4`, `agreed_to_terms`, `min_price`, `max_price`) VALUES
(11, 'Carpentry', 'Broken Roof', '', 'bacolod city, forest hills', NULL, NULL, '14:26:00', '13:26:00', '', NULL, 'project_based', 0, 3, 'service_requests/documents/RM4YFDFL9P3gSMjKdJDd88rrQ6SEigu3uYEg807i.jpg', 71, NULL, 'open', '2024-07-11 07:26:20', '2024-07-30 17:46:42', NULL, NULL, NULL, 0, 0.00, 0.00),
(14, 'Plumbing', 'toilet does not flush', 'asdasdasdasdasdasd', 'bacolod city, forest hills', '2024-07-03', '2024-07-20', '18:34:00', '20:34:00', 'flushing', NULL, 'hourly_rate', 1, 3, 'service_requests/documents/2ayFbFE0UKIIhysNJP0pyTAp9i6JIlzFBcHPEhtX.jpg', 72, NULL, 'open', '2024-07-13 01:44:29', '2024-07-30 17:36:04', NULL, NULL, NULL, 0, 0.00, 0.00),
(15, 'carpentry', 'Carpentry', 'asfsdafasdf', 'asdfsdafasdf', '2024-07-15', '2024-07-16', '23:36:00', '23:37:00', 'asasdasd', NULL, 'hourly_rate', 2, 3, 'service_requests/documents/A1CjhVIrDCw9JrGZXNqqEFpGJ9QCHVf4VFFiRjR2.jpg', 75, NULL, 'open', '2024-07-14 19:34:31', '2024-07-18 01:43:21', NULL, NULL, NULL, 0, 0.00, 0.00),
(17, 'building_related', 'aaaaaaaaaaaaaa', 'asdasdasd', 'bacolod city, forest hills', '2024-07-15', '2024-07-16', '19:04:00', '23:04:00', 'asdsadasa', 'male', 'project_based', 0, 1, 'service_requests/documents/9iGO5RTZECGxh7KD2NImqVTakXZXthLjMaDX34Us.webp', 75, NULL, 'open', '2024-07-14 21:04:23', '2024-07-19 06:09:39', NULL, NULL, NULL, 0, 0.00, 0.00),
(18, 'carpentry', 'Broken Roof', 'broken roof', 'bacolod city, forest hills', '2024-07-15', '2024-07-16', '19:45:00', '19:45:00', 'none', NULL, 'project_based', 2, 1, 'service_requests/documents/Vbe9upi0EF1QKA66xuMWMIPbYYSRH7nIr0Y67tkX.jpg', 86, NULL, 'open', '2024-07-15 02:46:18', '2024-07-30 17:47:01', NULL, NULL, NULL, 0, 0.00, 0.00),
(19, 'Plumbing', 'toilet does not flush', 'asdfsd', 'bacolod city, forest hills', '2024-07-15', '2024-07-16', '20:57:00', '21:57:00', 'none', 'male', 'hourly_rate', 3, 1, 'service_requests/documents/1Kw1U3Gi1D1KSKT13NMKKFd9VLBOPWTt05noRI8D.webp', 86, NULL, 'open', '2024-07-15 02:58:02', '2024-07-30 08:27:42', NULL, NULL, NULL, 0, 0.00, 0.00),
(20, 'electrical', 'a', 'a', 'a', '2024-07-20', '2024-07-20', '19:46:00', '20:46:00', 'a', 'male', 'hourly_rate', 1, 2, 'service_requests/documents/LEs9cSTWsUlLTOZPgxxgllFrpGZzucUxYlYP3uhc.png', 75, 86, 'in_progress', '2024-07-20 03:46:50', '2024-07-21 23:44:38', NULL, NULL, NULL, 0, 0.00, 0.00),
(21, 'welding', 'w', 'w', 'w', '2024-07-25', '2024-07-25', '06:27:00', '19:27:00', 'none', NULL, 'hourly_rate', 0, 1, 'service_requests/documents/Jpd8krZUI34URKj7pxDUuZVSJXAkULTK2ndfQ8Ij.jpg', 75, 86, 'in_progress', '2024-07-22 02:28:41', '2024-07-22 02:30:10', NULL, NULL, NULL, 0, 0.00, 0.00),
(22, 'plumbing', 'Not flushing', 'asefsdfasdfa', 'forest hills subd.', '2024-07-26', '2024-07-26', '15:57:00', '16:57:00', 'a', NULL, 'hourly_rate', 0, 1, 'service_requests/documents/Ud9aAOUPIDLN9fTshz7END7v5GV7N1faAf4LEW7D.webp', 75, 86, 'in_progress', '2024-07-23 05:57:56', '2024-07-23 06:00:00', NULL, NULL, NULL, 0, 0.00, 0.00),
(23, 'plumbing', 'asdasdsadasdsadad', 'asdasdsadasdsadad', 'forest hills subd.', '2024-07-25', '2024-07-25', '14:53:00', '16:53:00', 'flushing', NULL, 'project_based', 0, 1, 'service_requests/documents/ppwozcX3kVAu1PbN7tkkf4MRC6nUibAuApAIH21D.webp', 75, 86, 'in_progress', '2024-07-23 22:53:36', '2024-07-23 22:53:59', NULL, NULL, NULL, 0, 0.00, 0.00),
(24, 'Plumbing', 'Broken pipe', 'pipe is broken', 'Example Locataion', '2024-07-26', '2024-07-26', '11:35:00', '13:36:00', 'plumbing', NULL, 'hourly_rate', 0, 1, 'service_requests/documents/azzWj3n9SXI0kWv0UskZWTEKYyJcv0bcXXkZH2Sv.webp', 75, 86, 'in_progress', '2024-07-25 02:36:58', '2024-07-25 02:37:35', NULL, NULL, NULL, 0, 0.00, 0.00),
(25, 'Plumbing', 'm', 'm', 'm', '2024-07-25', '2024-07-25', '20:50:00', '20:50:00', 'm', NULL, 'hourly_rate', 0, 1, 'service_requests/documents/NDDf2lMpCTQHnPqnraqTkTMr7YB8vLjUq06E3XWo.jpg', 75, 86, 'completed', '2024-07-25 04:50:49', '2024-07-25 04:52:25', NULL, NULL, NULL, 0, 0.00, 0.00),
(26, 'Plumbing', 'v', 'v', 'v', '2024-07-26', '2024-07-27', '21:06:00', '21:06:00', 'v', NULL, 'hourly_rate', 0, 1, 'service_requests/documents/D6m1I0Go94v46XYHBXKYtH3xOxkMwCHEZbY7Wzda.webp', 75, 86, 'completed', '2024-07-25 05:06:45', '2024-07-25 05:09:32', NULL, NULL, NULL, 0, 0.00, 0.00),
(27, 'Plumbing', 'k', 'k', 'k', '2024-08-06', '2024-08-05', '01:41:00', '02:41:00', 'k', NULL, 'project_based', 0, 1, 'service_requests/documents/JmTQ5sCRtahNGu1DiatcbEB2xts04ZQssflG6EnL.jpg', 75, 86, 'completed', '2024-07-25 09:42:25', '2024-07-25 09:44:01', NULL, NULL, NULL, 0, 0.00, 0.00),
(28, 'Electrical', 'Dining Area Electical Repair', 'Need to repair wirings on dining area. Materials already available. Installation of chandelier.', 'Brgy. Taculing, Bacolod City', '2024-07-27', '2024-07-27', '08:00:00', '09:00:00', 'Wiring, Electric Tools', 'male', 'project_based', 1, 1, 'service_requests/documents/mAkaPNxuelOHIN499TFa26Njm6mX6FUNgnondj5t.jpg', 93, 94, 'in_progress', '2024-07-26 01:17:00', '2024-07-26 01:35:06', NULL, NULL, NULL, 0, 0.00, 0.00),
(29, 'Carpentry', 'House Painting', 'Painting of interior walls and ceilings.', 'Barangay Villamonte, Bacolod City', '2024-07-27', '2024-07-27', '10:39:00', '12:39:00', 'painting, interior design', NULL, 'project_based', 24, 1, 'service_requests/documents/brrrGBwRB7GgoCJJTEhJFm1wD016uzPtXUxzxXY4.jpg', 95, 98, 'completed', '2024-07-26 06:40:08', '2024-07-26 06:45:17', NULL, NULL, NULL, 0, 0.00, 0.00),
(30, 'Carpentry', 'Kitchen Remodeling', 'Full kitchen remodeling including new cabinets, countertops, and flooring.', 'Barangay Alijis, Bacolod City', '2024-07-27', '2024-07-27', '11:00:00', '16:00:00', 'remodeling, carpentry', 'male', 'project_based', 6, 1, 'service_requests/documents/60spgPVOfxgFRkinO3BVIDrkCB7ptwBoYOyn6FTc.jpg', 95, 98, 'completed', '2024-07-26 07:05:12', '2024-07-26 07:09:33', NULL, NULL, NULL, 0, 0.00, 0.00),
(31, 'Carpentry', 'Deck Construction', 'Construction of a wooden deck in the backyard.', 'Barangay Handumanan, Bacolod City', '2024-07-27', '2024-07-27', '11:12:00', '17:12:00', 'carpentry, construction', NULL, 'project_based', 0, 1, 'service_requests/documents/Rkc2pMqinRH8Wm0gHtMtkzMu1w1dUlXC83r0bBB9.jpg', 95, 98, 'completed', '2024-07-26 07:13:09', '2024-07-26 07:18:02', NULL, NULL, NULL, 0, 0.00, 0.00),
(32, 'Carpentry', 'Window Replacement', 'Replacement of old windows with new energy-efficient models.', 'Barangay Bata, Bacolod City', '2024-07-28', '2024-07-28', '11:22:00', '15:22:00', 'windows, installation', NULL, 'project_based', 0, 1, 'service_requests/documents/BSrHP90ZNlGD95lc1uvCipK3ABou69IF42yu9MQ8.jpg', 95, 98, 'completed', '2024-07-26 07:22:57', '2024-07-26 07:26:43', NULL, NULL, NULL, 0, 0.00, 0.00),
(33, 'Carpentry', 'Floating Shelf Installation', 'Install floating shelves in the living room', 'Barangay Mansilingan, Bacolod City', '2024-07-28', '2024-07-28', '12:59:00', '16:59:00', 'floating shelves, installation', NULL, 'hourly_rate', 4, 0, 'service_requests/documents/icfu9l9nTyV8t6yyPSoLVauH2mdWA24yVcjsWNCE.jpg', 95, NULL, 'open', '2024-07-26 21:00:06', '2024-07-26 21:00:06', NULL, NULL, NULL, 0, 0.00, 0.00),
(34, 'Carpentry', 'Closet Organization System', 'Design and install a custom closet organization system.', 'Barangay Granada, Bacolod City', '2024-07-28', '2024-07-29', '15:16:00', '17:17:00', 'closet system, design', NULL, 'project_based', 16, 0, 'service_requests/documents/lJyvbWTd4uYUsRmo05PDMraWgvrypEFmLfoXMOTk.jpg', 95, NULL, 'open', '2024-07-26 23:17:46', '2024-07-26 23:17:46', NULL, NULL, NULL, 0, 0.00, 0.00),
(36, 'Carpentry', 'Bathroom Renovation', 'Complete bathroom renovation including new fixtures and tiling.', 'Barangay Alijis, Bacolod City', '2024-07-27', '2024-07-27', '14:38:00', '18:38:00', 'door frames, installation', NULL, 'project_based', 24, 0, 'service_requests/documents/NoBnV2lgupiQltsJuHQPNN03KGfmU47vsD30wXFF.jpg', 95, NULL, 'open', '2024-07-27 02:39:32', '2024-07-27 02:39:32', NULL, NULL, NULL, 0, 0.00, 0.00),
(37, 'Carpentry', 'Fence Installation', 'Installation of a wooden fence around the property.', 'Barangay Alijis, Bacolod City', '2024-07-27', '2024-07-27', '06:41:00', '18:41:00', 'door frames, installation', 'male', 'hourly_rate', 6, 0, 'service_requests/documents/KLHZDdSCQByownC33gB2s6ElW8gpI064CdxpWEgP.jpg', 95, NULL, 'open', '2024-07-27 02:41:54', '2024-07-27 02:41:54', NULL, NULL, NULL, 0, 0.00, 0.00),
(38, 'Carpentry', 'Bookshelf Construction', 'Need a custom-built bookshelf made from oak wood for my home office. Dimensions are 7ft tall, 4ft wide, and 1ft deep.', 'Brgy. Mandalagan, Bacolod City', '2024-08-01', '2024-08-01', '09:00:00', '19:00:00', 'Woodworking, Custom Furniture', 'male', 'project_based', 8, 1, 'service_requests/documents/pCEm76jxiVLXddXPjDKyfUacXGxthuJrbq465ntw.jpg', 95, 98, 'completed', '2024-07-27 03:00:58', '2024-07-27 04:05:29', NULL, NULL, NULL, 0, 0.00, 0.00),
(39, 'Carpentry', 'Shelving Installation', 'Need floating shelves installed in the living room and bedroom. Shelves and brackets are provided.', 'Brgy. Estefania, Bacolod City', '2024-07-27', '2024-07-27', '07:25:00', '20:25:00', 'Shelving, Carpentry', NULL, 'hourly_rate', 4, 1, 'service_requests/documents/HR29tFljuuSA305yhFeOtuVjZsZsDRk45LSwDEcD.jpg', 95, 98, 'completed', '2024-07-27 03:25:55', '2024-07-27 07:18:05', NULL, NULL, NULL, 0, 0.00, 0.00),
(40, 'Carpentry', 'Gazebo Construction', 'Looking to build a gazebo in the backyard. Materials provided, need skilled carpenter to build.', 'Brgy. Granada, Bacolod City', '2024-07-30', '2024-07-30', '16:00:00', '18:01:00', 'Carpentry, Outdoor Structures', NULL, 'hourly_rate', 3, 1, 'service_requests/documents/hmEaTwsonyLikBSmXyiLXueMuQ0LV6wCi5fmymPK.jpg', 95, 98, 'in_progress', '2024-07-27 06:03:06', '2024-07-27 08:14:32', NULL, NULL, NULL, 0, 0.00, 0.00),
(43, 'Plumbing', 'f', 'f', 'Gatuslao Street, Bacolod City', '2024-07-29', '2024-07-29', '11:37:00', '23:37:00', 'Sump Pump Installation, Flood Prevention', NULL, 'project_based', 3, 1, 'service_requests/documents/LGooYWMPDaFJyopr7A77j04ktoi0QIB1CwccJfrR.jpg', 95, 102, 'completed', '2024-07-29 07:38:02', '2024-07-30 08:16:51', NULL, NULL, NULL, 0, 0.00, 0.00),
(45, 'Plumbing', 'v', 'v', 'v', '2024-07-31', '2024-07-31', '09:28:00', '21:28:00', 'v', NULL, 'project_based', 0, 2, 'service_requests/documents/YzJfKxJygzFqTGTfeZCzNrYE0s8CUgrOJeeDTvfu.webp', 95, 86, 'in_progress', '2024-07-30 17:28:43', '2024-07-31 05:02:30', NULL, NULL, NULL, 0, 0.00, 0.00),
(46, 'Carpentry', 'Frame Replacement', 'Replace an old wooden door frame with a new one, ensuring proper fit and finish.', '789 Oak Street, Barangay Estefania, Bacolod City', '2024-07-31', '2024-07-31', '00:30:00', '15:03:00', 'Door Installation, Frame Replacement', NULL, 'project_based', 4, 0, 'service_requests/documents/gndeB1JcQgiwa6rqSpkuOL6Pz0bToaAmlVcNBIos.jpg', 95, NULL, 'open', '2024-07-30 20:06:38', '2024-07-30 20:06:38', NULL, NULL, NULL, 0, 1200.00, 2200.00),
(47, 'Carpentry', 'Custom Bookshelf Installation', 'I need a custom bookshelf installed in my living room. Dimensions should be 10ft x 8ft.', '123 Pine Street, Barangay Villamonte, Bacolod City', '2024-07-31', '2024-07-31', '09:00:00', '13:28:00', 'Woodworking, Custom Furniture', NULL, 'project_based', 4, 0, 'service_requests/documents/vbjXlPburHHtXwngB6a1wxDMINnpoZvOET3WRkVv.jpg', 95, NULL, 'open', '2024-07-30 21:39:01', '2024-07-30 21:39:01', NULL, NULL, NULL, 0, 1500.00, 2500.00),
(48, 'Carpentry', 'Wooden Deck Repair', 'Repair and reinforce wooden deck boards and railings in the backyard.', '654 Cedar Street, Barangay Singcang, Bacolod City', '2024-07-31', '2024-07-31', '15:43:00', '18:43:00', 'Deck Repair, Outdoor Carpentry', NULL, 'project_based', 4, 0, 'service_requests/documents/ppueYaEsZA59iCE7ye3Ixjqjve2LNB2HfZbvEdCf.jpg', 95, NULL, 'open', '2024-07-30 21:43:35', '2024-07-30 21:43:35', NULL, NULL, NULL, 0, 2000.00, 3000.00),
(49, 'Carpentry', 'Patio Furniture Construction', 'Build custom patio furniture including a table and benches.', '234 Banana Lane, Barangay Singcang-Airport, Bacolod City', '2024-08-04', '2024-08-04', '08:01:00', '15:01:00', 'Outdoor Furniture, Carpentry', NULL, 'project_based', 7, 0, 'service_requests/documents/JNOnDklrDePsc6KUjzn6egy8douw2kyY0TcbYRxJ.jpg', 95, NULL, 'open', '2024-07-30 22:01:47', '2024-07-30 22:01:47', NULL, NULL, NULL, 0, 2500.00, 4000.00),
(50, 'Carpentry', 'Installation of Floating Shelves', 'Need to install three floating shelves in the living room.', '876 Coconut Drive, Barangay Pahanocoy, Bacolod City', '2024-07-31', '2024-07-31', '02:05:00', '14:05:00', 'Shelving, Wall Mounting', NULL, 'project_based', 5, 1, 'service_requests/documents/GSPJGJ1JTZU3fxPYk7bSppMl0io2kV6jCqWdQ4b0.jpg', 95, NULL, 'open', '2024-07-30 22:08:05', '2024-07-31 05:47:53', NULL, NULL, NULL, 0, 600.00, 1200.00),
(51, 'Carpentry', 'Installation of Floating Shelves', 'Need to install three floating shelves in the living room.', '876 Coconut Drive, Barangay Pahanocoy, Bacolod City', '2024-07-31', '2024-07-31', '02:05:00', '14:05:00', 'Shelving, Wall Mounting', NULL, 'project_based', 5, 0, 'service_requests/documents/Cjn06PJ0WA862NjNOlCyn2x6BUovOXelxEIdutv3.png', 95, NULL, 'open', '2024-07-30 23:05:18', '2024-07-30 23:05:18', NULL, NULL, NULL, 0, 600.00, 1200.00),
(52, 'Carpentry', 'Patio Furniture Construction', 'Build custom patio furniture including a table and benches.', '234 Banana Lane, Barangay Singcang-Airport, Bacolod City', '2024-08-04', '2024-08-04', '08:01:00', '15:01:00', 'Outdoor Furniture, Carpentry', NULL, 'project_based', 7, 0, 'service_requests/documents/3zu3YP6BpV9hneFAVa8y7PrsDIbRzPt7YL2nS7zs.jpg', 95, NULL, 'open', '2024-07-30 23:19:19', '2024-07-30 23:19:19', NULL, NULL, NULL, 1, 2500.00, 4000.00),
(53, 'Carpentry', 'Wooden Deck Repair', 'Repair and reinforce wooden deck boards and railings in the backyard.', '654 Cedar Street, Barangay Singcang, Bacolod City', '2024-07-31', '2024-07-31', '15:43:00', '18:43:00', 'Deck Repair, Outdoor Carpentry', NULL, 'project_based', 4, 1, 'service_requests/documents/SCUE8GwMC0ygzWN6pyLgtUcphhJneGVTQhAkNFTR.jpg', 95, 98, 'in_progress', '2024-07-30 23:26:01', '2024-07-31 00:10:59', NULL, NULL, NULL, 1, 2000.00, 3000.00),
(54, 'Carpentry', 'Test with separate table', 'Test with separate table', 'Test with separate table', '2024-07-31', '2024-07-31', '00:30:00', '15:03:00', 'Test with separate table', NULL, 'project_based', 4, 0, NULL, 95, NULL, 'open', '2024-07-31 01:16:41', '2024-07-31 01:16:41', NULL, NULL, NULL, 1, 1200.00, 2200.00),
(55, 'Carpentry', 'Test with separate table', 'Test with separate table', 'Test with separate table', '2024-07-31', '2024-07-31', '00:30:00', '15:03:00', 'Test with separate table', NULL, 'project_based', 4, 0, NULL, 95, NULL, 'open', '2024-07-31 01:18:56', '2024-07-31 01:18:56', NULL, NULL, NULL, 1, 1200.00, 2200.00),
(56, 'Carpentry', 'Test with separate table', 'Test with separate table', 'Test with separate table', '2024-07-31', '2024-07-31', '00:30:00', '15:03:00', 'Test with separate table', NULL, 'project_based', 4, 0, NULL, 95, NULL, 'open', '2024-07-31 01:21:08', '2024-07-31 01:21:08', NULL, NULL, NULL, 1, 1200.00, 2200.00),
(57, 'Carpentry', 'Test with separate table 2', 'Test with separate table 2', 'Test with separate table 2', '2024-07-31', '2024-07-31', '05:26:00', '17:26:00', 'Test with separate table 2', NULL, 'hourly_rate', 899, 0, NULL, 95, NULL, 'open', '2024-07-31 01:27:44', '2024-07-31 01:27:44', NULL, NULL, NULL, 1, 12.00, 13.00),
(58, 'Carpentry', 'test upload', 'test upload', 'test upload', '2024-07-31', '2024-08-02', '05:39:00', '17:39:00', 'test upload', NULL, 'project_based', 3444, 0, NULL, 95, NULL, 'open', '2024-07-31 01:39:39', '2024-07-31 01:39:39', NULL, NULL, NULL, 1, 1.00, 2.00),
(59, 'Carpentry', 'test upload', 'test upload', 'test upload', '2024-07-31', '2024-07-31', '05:45:00', '17:45:00', 'test upload', NULL, 'hourly_rate', 3444, 0, NULL, 95, NULL, 'open', '2024-07-31 01:46:14', '2024-07-31 01:46:14', NULL, NULL, NULL, 1, 1.00, 2.00),
(60, 'Carpentry', 'test upload', 'asdasdasdasdasdasdasd', 'test upload', '2024-07-31', '2024-07-31', '05:52:00', '17:52:00', 'test upload', NULL, 'project_based', 3444, 0, NULL, 95, NULL, 'open', '2024-07-31 01:52:40', '2024-07-31 01:52:40', NULL, NULL, NULL, 1, 1.00, 2.00),
(61, 'Carpentry', 'test upload', 'asdasdasdasdasdasdasd', 'test upload', '2024-07-31', '2024-07-31', '05:52:00', '17:52:00', 'test upload', NULL, 'project_based', 3444, 0, NULL, 95, NULL, 'open', '2024-07-31 01:53:41', '2024-07-31 01:53:41', NULL, NULL, NULL, 1, 1.00, 2.00),
(62, 'Carpentry', 'test upload', 'asdasdasdasdasdasdasd', 'test upload', '2024-07-31', '2024-07-31', '05:52:00', '17:52:00', 'test upload', NULL, 'project_based', 3444, 0, NULL, 95, NULL, 'open', '2024-07-31 01:53:42', '2024-07-31 01:53:42', NULL, NULL, NULL, 1, 1.00, 2.00),
(63, 'Carpentry', 'test upload', 'test upload', 'test upload', '2024-07-31', '2024-07-31', '05:55:00', '17:55:00', 'test upload', NULL, 'project_based', 3444, 0, NULL, 95, NULL, 'open', '2024-07-31 01:55:23', '2024-07-31 01:55:23', NULL, NULL, NULL, 1, 1.00, 2.00),
(64, 'Carpentry', 'test', 'test', 'test upload', '2024-07-31', '2024-07-31', '05:58:00', '17:58:00', 'test upload', NULL, 'project_based', 3444, 2, NULL, 95, NULL, 'open', '2024-07-31 01:58:08', '2024-07-31 05:50:46', NULL, NULL, NULL, 1, 1.00, 2.00),
(65, 'Carpentry', '1 test upload', '1 test upload', '1 test upload', '2024-07-31', '2024-07-31', '05:59:00', '17:59:00', '1 test upload', NULL, 'project_based', 5, 3, NULL, 95, 98, 'in_progress', '2024-07-31 01:59:58', '2024-07-31 21:39:10', NULL, NULL, NULL, 1, 123.00, 222.00),
(66, 'Plumbing', 'Pump Installation', 'Pump Installation', 'Pump Installation', '2024-08-01', '2024-08-01', '02:45:00', '14:45:00', 'Pump Installation', NULL, 'hourly_rate', 5, 2, NULL, 95, 86, 'in_progress', '2024-07-31 22:46:07', '2024-07-31 23:25:20', NULL, NULL, NULL, 1, 23.00, 56.00),
(68, 'Carpentry', 'Custom Bookshelf Installation', 'rrtfdgfd', '123 Rizal Street, Bacolod City, Negros Occidental', '2024-08-01', '2024-08-01', '06:10:00', '18:10:00', 'Carpentry, Custom Shelving, Installation', NULL, 'project_based', 40, 1, NULL, 103, NULL, 'open', '2024-08-01 02:11:30', '2024-08-02 00:19:26', NULL, NULL, NULL, 1, 5000.00, 10000.00),
(74, 'Carpentry', 'test fixed', 'test fixed', 'test fixed', '2024-08-01', '2024-08-01', '09:10:00', '21:10:00', 'test fixed', NULL, 'project_based', 5, 0, NULL, 103, NULL, 'open', '2024-08-01 05:10:32', '2024-08-01 05:10:32', NULL, NULL, NULL, 1, NULL, 100.00),
(75, 'Carpentry', 'Schedule Blocking 1', 'Schedule Blocking 1', 'Schedule Blocking 1', '2024-08-03', '2024-08-03', '02:52:00', '14:52:00', 'Schedule Blocking 1', NULL, 'hourly_rate', 3, 1, NULL, 95, 98, 'in_progress', '2024-08-01 22:52:37', '2024-08-01 23:02:47', NULL, NULL, NULL, 1, NULL, 345.00),
(76, 'Carpentry', 'Schedule Blocking 2', 'Schedule Blocking 2', 'Schedule Blocking 2', '2024-08-03', '2024-08-03', '02:52:00', '14:52:00', 'Schedule Blocking 2', NULL, 'hourly_rate', 3, 0, NULL, 95, NULL, 'open', '2024-08-01 22:53:12', '2024-08-01 22:53:12', NULL, NULL, NULL, 1, NULL, 345.00);

-- --------------------------------------------------------

--
-- Table structure for table `service_request_images`
--

CREATE TABLE `service_request_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_request_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_request_images`
--

INSERT INTO `service_request_images` (`id`, `service_request_id`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 56, 'service_requests/documents/wdEE6ewrkUDtGGKnPYm8CpKeGlQeyGWC0YESPKDd.jpg', '2024-07-31 01:21:09', '2024-07-31 01:21:09'),
(2, 57, 'service_requests/documents/eUdxJhB68G74rMbvhwWtF9P13t0aZAoA1OyWnWvW.jpg', '2024-07-31 01:27:44', '2024-07-31 01:27:44'),
(3, 58, 'service_requests/documents/2YPKVPZ2u3uehjMOcyOhitHEBfrbEX6fC7EPkE5H.jpg', '2024-07-31 01:39:39', '2024-07-31 01:39:39'),
(4, 59, 'service_requests/documents/Ml7Y9lBc6OPBfvRDzB7yAuoZMDnL23b2dGyUVVUc.jpg', '2024-07-31 01:46:14', '2024-07-31 01:46:14'),
(5, 59, 'service_requests/documents/JOW5KQZn4XQBZUm6ohhwQjDth7t5OWiDRenHs8Vd.jpg', '2024-07-31 01:46:14', '2024-07-31 01:46:14'),
(6, 59, 'service_requests/documents/eOXyUcmtdBw7P3g9GQuOsnzMf4lBfYLWfK7xGqro.jpg', '2024-07-31 01:46:15', '2024-07-31 01:46:15'),
(7, 59, 'service_requests/documents/IUqxfr9xeZuI0wHUFvCqhiUfGqdfySsFMwuR617p.jpg', '2024-07-31 01:46:15', '2024-07-31 01:46:15'),
(8, 64, 'service_requests/documents/Njzs3LkIGyQCiPiAvMw49wnoArHwgYh3qR1QcPje.jpg', '2024-07-31 01:58:08', '2024-07-31 01:58:08'),
(9, 64, 'service_requests/documents/ASZ45utrBmVQTQLc3DAu0xfIOmqAI1UgW5hfamd5.jpg', '2024-07-31 01:58:08', '2024-07-31 01:58:08'),
(10, 64, 'service_requests/documents/RArgZNDTODvXI13E0D4X8rC2lk23HWkZjMGVPmRO.jpg', '2024-07-31 01:58:08', '2024-07-31 01:58:08'),
(11, 64, 'service_requests/documents/PU3nzaA7lAieQ8ahjMkhF488W3ojtagMuSn9qBhU.jpg', '2024-07-31 01:58:08', '2024-07-31 01:58:08'),
(12, 65, 'service_requests/documents/bWgTELpipPIZci5UHOsBPNYUodqKDf1ycIlYzOyY.jpg', '2024-07-31 01:59:58', '2024-07-31 01:59:58'),
(13, 66, 'service_requests/documents/dzAwwgcfLv5pHpvXWxKbNxNvmWKOo8f6cqz9V9fm.webp', '2024-07-31 22:46:09', '2024-07-31 22:46:09'),
(15, 68, 'service_requests/documents/rXka6M9l5XIHxrOtg7a6eB7V9D3qYD9Ave4ggcbP.jpg', '2024-08-01 02:11:31', '2024-08-01 02:11:31'),
(22, 74, 'service_requests/documents/PHq2KRM2GEt9bY4ylNyni8VHMHDQHARMBDnpxNRJ.jpg', '2024-08-01 05:10:32', '2024-08-01 05:10:32'),
(23, 75, 'service_requests/documents/FPbkvzPftXQhWcuRk7BeGwzAHg7wbMgTCXKYWCfI.jpg', '2024-08-01 22:52:39', '2024-08-01 22:52:39'),
(24, 76, 'service_requests/documents/PxoG1RtpWKCCoLMHAV4I7OBjzdWH9ShgjpmQQKk3.jpg', '2024-08-01 22:53:12', '2024-08-01 22:53:12');

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
('GS9hpbFCaqJguw5cIlfcMNsVpEhAh7Z5p9kzi5Xv', 98, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiR2FKV0J4UVRZbnNOcW04RHJ5R2VKbUMyaEVnbG4xU2w3Z21qUUVSeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm92aWRlci9teXJlcXVlc3RzIjt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk4O30=', 1722600246),
('wkTQw7az4q9AOYy7JkirO7HVsFKqXthMKzrgDcgt', 95, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUkxMTFB4SzVHRU9aRlJNY0NybHdieExOUVpybDhBNWFmUjR6WXM3VyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6OTU7fQ==', 1722600260);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cell_no` varchar(12) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `birth_date` date NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `role` int(11) DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `cell_no`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `birth_date`, `address`, `gender`, `role`) VALUES
(71, 'Seeker Account', 'seeker@mail.com', '639991091104', NULL, '$2y$12$rXky9snehiX4bZrV9g6y1u5O6dDE9P3J3Q9aIr.Y50wQAYqqpC/KO', NULL, '2024-07-06 08:28:08', '2024-07-08 18:15:20', '1940-10-15', 'Forest Hills Subdivision, Bacolod, Philippines', 'Male', 2),
(72, 'Provider Account', 'provider@mail.com', '639991091104', NULL, '$2y$12$RurZ00Xvyr3x66olWJGbtuj9qyKDeNNRzfjeiUDqxeByeWnngAM56', NULL, '2024-07-06 08:29:20', '2024-07-06 08:35:22', '1939-09-16', 'Alijis, Bacolod, Philippines', 'Male', 2),
(73, 'authorizer Account', 'authorizer@mail.com', '639991091104', NULL, '$2y$12$CPYPEm1Z3CE5/oQeSEMTIu9tem9V4x2MqqbfIEyWCmV0BRemcVbK2', NULL, '2024-07-06 08:33:03', '2024-07-06 08:33:32', '1939-07-12', 'La Carlota, Philippines', 'Male', 1),
(74, 'seeker2 account', 'seeker2@mail.com', '639991091104', NULL, '$2y$12$3WuzDYI.yyW7H9iSzCcOruxgOahNat09mvDEKM3BtbkuOOQ26V3uS', NULL, '2024-07-08 10:01:17', '2024-07-08 10:01:17', '1940-09-18', NULL, 'Male', 3),
(75, 'seeker3 Account', 'seeker3@mail.com', '639991091104', NULL, '$2y$12$5c5JtMr6CNF8NfoVhuJ/O.9yr/hsaiM5lR1PHACOKj71xTqYKhDla', NULL, '2024-07-08 17:58:04', '2024-07-08 17:58:49', '1937-10-15', 'La Carlota, Philippines', 'Male', 3),
(76, 'seeker4 account', 'seeker4@gmail.com', '639991091104', NULL, '$2y$12$RVgt907ps6f/TaeHsFM/A.rQEQ7/1eaE2rxmZnVoh50rPFgsPcA3q', NULL, '2024-07-08 23:20:03', '2024-07-08 23:20:13', '1941-09-18', '123 Lacson Street Bacolod City, Negros Occidental 6100 Philippines', 'Male', 3),
(77, 'a a', 'a@mail.com', '639991091104', NULL, '$2y$12$daQ3kD9vrf8WgZujTTCLv..gjyRaIDL.dPM.NVnlx2Cv921jP6zNC', NULL, '2024-07-09 00:27:09', '2024-07-09 01:26:00', '1940-09-18', '123 Lacson Street Bacolod City, Negros Occidental 6100 Philippines', 'Male', 2),
(78, 'b b', 'b@gmail.com', '639991091104', NULL, '$2y$12$OxSl8Kq39Gx23/NIsT./AeX/xqjPIIx07kFeS.iJFtxptIJ.IlAeK', NULL, '2024-07-09 01:33:36', '2024-07-09 01:33:44', '1939-08-18', '123 Lacson Street Bacolod City, Negros Occidental 6100 Philippines', 'Female', 3),
(80, 'provider2 account', 'provider2@mail.com', '639991091104', NULL, '$2y$12$5Ta65NBYc7rAY7tYlcsTou4VjfMVBlOTQEdnaKxRW0Zayhr00F7hO', NULL, '2024-07-13 23:09:20', '2024-07-13 23:16:03', '1939-09-16', '123 Lacson Street Bacolod City, Negros Occidental 6100 Philippines', 'Male', 2),
(81, 'provider3 account', 'provider3@mail.com', '639991091104', NULL, '$2y$12$hXwe9Wi4i9G5ZXJFfMd1c.Ehnatz4s6dhVaQ2wm8TCWz5c4nuu6xq', NULL, '2024-07-13 23:17:59', '2024-07-13 23:19:31', '1939-09-16', 'Forest Hills Subdivision, Bacolod, Philippines', 'Male', 2),
(82, 'provider4 account', 'provider4@mail.com', '639991091104', NULL, '$2y$12$v9DB3f1H/TF4bejBzWcXUuu4MDxB55ksVFXuuyx6O4M49vwWZnnH2', NULL, '2024-07-13 23:20:30', '2024-07-13 23:24:25', '1939-09-16', 'La Carlota, Philippines', 'Male', 2),
(83, 'provider5 account', 'provider5@mail.com', '639991091104', NULL, '$2y$12$fxtx816hl0dqrZSULOerPeXU1q7nTkPuYO.JZqxxQi7rongC6pB5i', NULL, '2024-07-14 06:09:58', '2024-07-14 06:10:15', '1939-09-16', '123 Lacson Street Bacolod City, Negros Occidental 6100 Philippines', 'Male', 3),
(85, 'provider6 account', 'provider6@mail.com', '639991091104', NULL, '$2y$12$/IroPoUtp4sZk/FhPLmtj.PK8L2Ghd/HcgLppisWVM6LtA1EfAIgK', NULL, '2024-07-14 21:20:44', '2024-07-14 21:27:25', '1940-08-16', '123 Lacson Street Bacolod City, Negros Occidental 6100 Philippines', 'Female', 2),
(86, 'Andrea Uy', 'andrea@mail.com', '639991091104', NULL, '$2y$12$GxmCtGPVSHXfzRWvX9HlCutak30YHFUPlgjc3whFoJKVK6mj.9nP.', NULL, '2024-07-15 02:36:53', '2024-07-15 03:52:29', '1942-09-17', NULL, 'Female', 2),
(90, 'a a', 'takememars@gmail.com', '639991091104', NULL, '$2y$12$Evm.dufrcu7RglfQIkj0N.FtP1ufxIa2b/xPJ.QHYmgPW7AvOQ5Qq', NULL, '2024-07-16 06:50:02', '2024-07-16 06:50:07', '1940-10-17', '123 Lacson Street Bacolod City, Negros Occidental 6100 Philippines', 'Male', 2),
(92, 'andre amar', 'andrelennardamar@gmail.com', '639991091104', NULL, '$2y$12$XSRIf9A7o8ulxQ4r/WgWLOVf2rc3jLhBmpbQvSEysypVJC9uVbRxa', NULL, '2024-07-22 22:49:21', '2024-07-22 22:49:34', '1940-08-19', 'Kanlaon Volcano Crater', 'Male', 2),
(93, 'Joshua Dela Cruz', 'josh123@gmail.com', '639123456789', NULL, '$2y$12$lnTqrDLVzh0K.3ufp/i85.ZBcYFYLjCutHUSC65zUrAG/JR.QDUOa', NULL, '2024-07-26 01:07:42', '2024-07-26 01:09:03', '2000-01-01', 'Bacolod City, Bacolod, Philippines', 'Male', 2),
(94, 'John Doe', 'johndoe123@gmail.com', '6312345678', NULL, '$2y$12$weDescKzb9XVn/hMx743IeoWCj9XXPa.3wsL.4.UlOIRrxji5Rlw2', NULL, '2024-07-26 01:23:07', '2024-07-26 01:30:22', '2000-01-01', 'Bacolod City, Bacolod, Philippines', 'Male', 2),
(95, 'Andre Amar', 'andre123@mail.com', '639991091104', NULL, '$2y$12$AYAG67oNe8L1Pfm8XUZjHO64owXj/pfshLXo.3hYpK.pGSleh4Qne', NULL, '2024-07-26 06:18:26', '2024-07-26 06:18:39', '1938-07-16', 'Kaer Morhen White Mountains Kaedwen', 'Male', 3),
(96, 'Luisa Garcia', 'luisa.garcia@example.com', '639570250603', NULL, '$2y$12$zpFwXLXbco5WeNd4XMSQEu1iDTwGw8wxh1scqJBRan922BIpEFyEy', NULL, '2024-07-26 06:24:44', '2024-07-26 06:24:44', '1985-02-15', NULL, 'Female', 2),
(98, 'Luisa Garcia', 'luisagarcia@example.com', '639991091104', NULL, '$2y$12$cQZ.4yE9mCX45nNHPy3pkeQJj0KoHf4qt1Tzvrv3qqB2MV3NfLcJK', NULL, '2024-07-26 06:30:38', '2024-07-26 06:30:46', '1941-08-20', '123 Lacson Street Bacolod City, Negros Occidental 6100 Philippines', 'Male', 2),
(99, 'Jose Garcia', 'jose.garcia@example.com', '9991012345', NULL, '$2y$12$SsmuGN9F6yPsiG093KKA3.zlfV6ICL.Wc0Q.43hMC44WJG3xmFJge', NULL, '2024-07-27 10:52:40', '2024-07-27 10:53:01', '1958-02-21', 'Brgy. Mandalagan, Bacolod City', 'Male', 3),
(101, 'Juan Reyes', 'juan.reyes@example.com', '639991034567', NULL, '$2y$12$BS.MwMo.RTitXZ0qrJM5COWKJYC8SvrdKGXyc2GUJ/SRASw70tmRu', NULL, '2024-07-27 12:48:02', '2024-07-27 12:48:10', '1939-09-16', 'Brgy. Taculing, Bacolod City', 'Male', 2),
(102, 'Luis Navarro', 'luis.navarro@example.com', '639991090123', NULL, '$2y$12$O25zNnHMcaHb4RHBfIjg4.Y8uXWtiTufYxXc8S8CREKv5q0hJunXm', NULL, '2024-07-27 21:04:24', '2024-07-27 21:04:35', '1992-11-22', 'Brgy. Vista Alegre, Bacolod City', 'Male', 2),
(103, 'Mark Bautista', 'mark.bautista@example.com', '639123456793', NULL, '$2y$12$T01zDbsfLRpKfbEYzzaK6ecrbkViMYGh/kDaQXPRDstG3fp2G7Cwm', NULL, '2024-07-31 06:26:32', '2024-07-31 06:26:46', '1991-05-12', 'mark.bautista@example.com', 'Male', 3),
(104, 'Liza Mendoza', 'liza.mendoza@example.com', '639123456794', NULL, '$2y$12$mPuGd3h84Mjo2//HNdwcPut9ohiMp6eoMkW0KqtSXpCgqW9UCXJVa', NULL, '2024-07-31 06:28:03', '2024-07-31 06:28:34', '1993-06-25', '987 Alijis St., Bacolod City', 'Female', 3),
(105, 'Carlos Cruz', 'carlos.cruz@example.com', '639123456795', NULL, '$2y$12$C0/UF3Pkf0YqTxO3NbK7uuEnedpbwtOOFVBiS2L5SFXdJbbG3Xivq', NULL, '2024-07-31 06:30:25', '2024-07-31 06:30:33', '1989-07-30', '135 Arevalo St., Bacolod City', 'Male', 3),
(106, 'Sofia Torres', 'sofia.torres@example.com', '639123456796', NULL, '$2y$12$XsBh85next8X6UpeNvAPxOjr7HEflJ/X6oEd4aZCcpc4gjKj0JWHK', NULL, '2024-07-31 06:32:53', '2024-07-31 06:32:59', '1988-07-30', '246 Villanueva St., Bacolod City', 'Female', 3),
(108, 'Grace Villanueva', 'grace.villanueva@example.com', '639123456798', NULL, '$2y$12$NrCJsE2M2.sx9WmkAsfsYO4WrVFY2eJvIzfAxzsWUzI9NgIVTxr8.', NULL, '2024-07-31 06:35:14', '2024-07-31 06:35:14', '1988-08-24', NULL, 'Female', 3),
(109, 'Geralt Of Rivia', 'geralt@example.com', '63999109114', NULL, '$2y$12$GU638vrK3xCuqR.eTUSdkOgPBBXBlJ6pSYEc.Fu4/VEbdx2lYtmwe', NULL, '2024-08-01 06:08:58', '2024-08-01 06:09:04', '1939-09-16', '123 Rizal Street, Barangay Villamonte, Bacolod City, Philippines', 'Male', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bidder_id` (`bidder_id`),
  ADD KEY `bid_ibfk_1` (`service_request_id`);

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
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seeker_id` (`seeker_id`),
  ADD KEY `provider_id` (`provider_id`),
  ADD KEY `service_request_id` (`service_request_id`),
  ADD KEY `bid_id` (`bid_id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- Indexes for table `philid_cards`
--
ALTER TABLE `philid_cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `philid_number` (`philid_number`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `provider_details`
--
ALTER TABLE `provider_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_provider_details_provider_id` (`provider_id`);

--
-- Indexes for table `psa_jobs`
--
ALTER TABLE `psa_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channel_id` (`channel_id`),
  ADD KEY `rated_by_id` (`rated_by_id`),
  ADD KEY `rated_for_id` (`rated_for_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_request_id` (`service_request_id`),
  ADD KEY `reported_by` (`reported_by`),
  ADD KEY `fk_reports_reported_user_id` (`reported_user_id`);

--
-- Indexes for table `request_lists`
--
ALTER TABLE `request_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requests_user_id_foreign` (`user_id`);

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
-- Indexes for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `service_request_images`
--
ALTER TABLE `service_request_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_request_id` (`service_request_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `philid_cards`
--
ALTER TABLE `philid_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `provider_details`
--
ALTER TABLE `provider_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `psa_jobs`
--
ALTER TABLE `psa_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `request_lists`
--
ALTER TABLE `request_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `service_request_images`
--
ALTER TABLE `service_request_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`bidder_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `certifications`
--
ALTER TABLE `certifications`
  ADD CONSTRAINT `certifications_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `channel`
--
ALTER TABLE `channel`
  ADD CONSTRAINT `channel_ibfk_1` FOREIGN KEY (`seeker_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `channel_ibfk_2` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `channel_ibfk_3` FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` (`id`),
  ADD CONSTRAINT `channel_ibfk_4` FOREIGN KEY (`bid_id`) REFERENCES `bid` (`id`);

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
-- Constraints for table `philid_cards`
--
ALTER TABLE `philid_cards`
  ADD CONSTRAINT `philid_cards_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `provider_details`
--
ALTER TABLE `provider_details`
  ADD CONSTRAINT `fk_provider_details_provider_id` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`rated_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_3` FOREIGN KEY (`rated_for_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_reports_reported_user_id` FOREIGN KEY (`reported_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `request_lists`
--
ALTER TABLE `request_lists`
  ADD CONSTRAINT `requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD CONSTRAINT `service_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `service_request_images`
--
ALTER TABLE `service_request_images`
  ADD CONSTRAINT `service_request_images_ibfk_1` FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
