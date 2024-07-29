-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2024 at 06:30 PM
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
  `status` enum('pending','accepted','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `service_request_id`, `bidder_id`, `bid_amount`, `bid_description`, `created_at`, `updated_at`, `status`) VALUES
(1, 11, 75, 213.00, 'yas', '2024-07-14 10:24:24', '2024-07-14 10:24:24', 'pending'),
(5, 14, 85, 212.00, 'ye', '2024-07-14 22:42:02', '2024-07-14 22:42:02', 'pending'),
(6, 14, 85, 345.00, '3rdfdassdadas', '2024-07-14 23:08:09', '2024-07-14 23:08:09', 'pending'),
(7, 11, 85, 234.00, 'sdfsdfs', '2024-07-14 23:11:05', '2024-07-14 23:11:05', 'pending'),
(8, 15, 72, 500.00, 'yes', '2024-07-16 10:53:31', '2024-07-19 00:47:42', 'accepted'),
(9, 15, 72, 700.00, 'sg', '2024-07-17 12:08:16', '2024-07-22 03:09:48', 'pending'),
(10, 15, 72, 122.00, 'dafasdfasdfsa', '2024-07-18 01:43:20', '2024-07-19 00:47:42', 'rejected'),
(11, 17, 72, 456.00, 'ghjgkhgj', '2024-07-19 06:09:38', '2024-07-20 04:16:16', 'accepted'),
(12, 20, 72, 233.00, 'sss', '2024-07-20 03:47:07', '2024-07-21 23:44:38', 'rejected'),
(13, 20, 86, 12.00, 'a', '2024-07-20 06:24:03', '2024-07-21 23:44:38', 'accepted'),
(14, 21, 86, 123.00, 'this sdfsadf', '2024-07-22 02:29:47', '2024-07-22 02:30:10', 'accepted'),
(15, 22, 86, 56.00, 'h', '2024-07-23 05:59:43', '2024-07-23 06:00:00', 'accepted'),
(16, 23, 86, 400.00, 'a', '2024-07-23 22:53:51', '2024-07-23 22:53:58', 'accepted'),
(17, 24, 86, 123.00, 'a', '2024-07-25 02:37:26', '2024-07-25 02:37:35', 'accepted'),
(18, 25, 86, 12.00, 'a', '2024-07-25 04:51:23', '2024-07-25 04:51:28', 'accepted'),
(19, 26, 86, 233.00, 'd', '2024-07-25 05:07:08', '2024-07-25 05:07:16', 'accepted'),
(20, 27, 86, 333.00, '2', '2024-07-25 09:42:50', '2024-07-25 09:43:01', 'accepted'),
(21, 28, 94, 900.00, 'bid 1', '2024-07-26 01:32:03', '2024-07-26 01:35:06', 'accepted'),
(22, 29, 98, 1000.00, 'I can make it cheaper', '2024-07-26 06:41:00', '2024-07-26 06:41:09', 'accepted'),
(23, 30, 98, 1000.00, 'f', '2024-07-26 07:05:36', '2024-07-26 07:05:43', 'accepted'),
(24, 31, 98, 12000.00, 'ggg', '2024-07-26 07:13:22', '2024-07-26 07:13:27', 'accepted'),
(25, 32, 98, 120.00, 'g', '2024-07-26 07:23:15', '2024-07-26 07:23:23', 'accepted'),
(26, 38, 98, 90000.00, 'Cost not enough for the task', '2024-07-27 04:04:03', '2024-07-27 04:04:30', 'accepted'),
(27, 39, 98, 500.00, 'a', '2024-07-27 05:04:58', '2024-07-27 07:16:45', 'accepted'),
(28, 40, 98, 350.00, 'a', '2024-07-27 08:14:17', '2024-07-27 08:14:30', 'accepted');

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
(16, 95, 98, 40, 28, '2024-07-27 08:14:32', '2024-07-27 08:14:32', 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 0);

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
('21a06f53-5248-4458-9855-ae6aef62dbd1', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: k\",\"bid_id\":20,\"service_request_id\":27}', NULL, '2024-07-25 09:43:06', '2024-07-25 09:43:06'),
('331a80fc-6ee5-4826-8d37-7524024db039', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: w\",\"bid_id\":14,\"service_request_id\":21}', NULL, '2024-07-22 02:30:15', '2024-07-22 02:30:15'),
('3596b769-d1e4-4865-8eac-5e6571faad34', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Shelving Installation\",\"bid_id\":27,\"service_request_id\":39}', NULL, '2024-07-27 07:16:48', '2024-07-27 07:16:48'),
('4c8eb5f8-eb3a-48d3-98f0-c3b8bff4699e', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: v\",\"bid_id\":19,\"service_request_id\":26}', NULL, '2024-07-25 05:07:18', '2024-07-25 05:07:18'),
('5b24e641-5a22-4870-ab95-8e446738f0ca', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Bookshelf Construction\",\"bid_id\":26,\"service_request_id\":38}', NULL, '2024-07-27 04:04:35', '2024-07-27 04:04:35'),
('9f3624b1-3d64-433b-98c6-45765847e46d', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: m\",\"bid_id\":18,\"service_request_id\":25}', NULL, '2024-07-25 04:51:30', '2024-07-25 04:51:30'),
('a7ac7f4d-6fde-4ee7-a246-7b8495de9607', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Gazebo Construction\",\"bid_id\":28,\"service_request_id\":40}', NULL, '2024-07-27 08:14:33', '2024-07-27 08:14:33'),
('a9b21c87-1a58-4aac-89b3-09a3e5ed6324', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 94, '{\"message\":\"Your bid has been confirmed for the service request: Dining Area Electical Repair\",\"bid_id\":21,\"service_request_id\":28}', NULL, '2024-07-26 01:35:11', '2024-07-26 01:35:11'),
('b519132f-2755-42f8-ab18-ffdf3b5cd4e7', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: Not flushing\",\"bid_id\":15,\"service_request_id\":22}', NULL, '2024-07-23 06:00:04', '2024-07-23 06:00:04'),
('cc7f17e0-8164-48e2-8f1e-d9b8b694fd70', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Window Replacement\",\"bid_id\":25,\"service_request_id\":32}', NULL, '2024-07-26 07:23:23', '2024-07-26 07:23:23'),
('d20f3d94-8ba7-4637-8e3f-a4b105c3d8c3', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: asdasdsadasdsadad\",\"bid_id\":16,\"service_request_id\":23}', NULL, '2024-07-23 22:54:05', '2024-07-23 22:54:05'),
('d8b69d9d-fb03-485b-b0c5-da58f3be5e3e', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Deck Construction\",\"bid_id\":24,\"service_request_id\":31}', NULL, '2024-07-26 07:13:27', '2024-07-26 07:13:27'),
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
-- Table structure for table `provider_details`
--

CREATE TABLE `provider_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `request_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `profilePicture` varchar(255) DEFAULT NULL,
  `work_email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `serviceCategory` varchar(255) NOT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `have_tools` varchar(255) NOT NULL,
  `years_of_experience` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `government_id_front` varchar(255) NOT NULL,
  `government_id_back` varchar(255) NOT NULL,
  `nbi_clearance` varchar(255) DEFAULT NULL,
  `tesda_certification` varchar(255) DEFAULT NULL,
  `other_credentials` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_details`
--

INSERT INTO `provider_details` (`id`, `status`, `request_id`, `profilePicture`, `work_email`, `contact_number`, `serviceCategory`, `subcategory`, `have_tools`, `years_of_experience`, `description`, `government_id_front`, `government_id_back`, `nbi_clearance`, `tesda_certification`, `other_credentials`, `created_at`, `updated_at`, `provider_id`) VALUES
(12, 'pending', 39, NULL, 'provider5@mail.com', '09991091104', 'Bus Driving', NULL, '1', NULL, 'as', 'provider/documents/W2XUdVAZstJI0uPktjMBwQqbsqMFIxO9hOXHYDMV.png', 'provider/documents/jXv1GE84mfwNYDjWOkgPdFbM1RcEttFIfKOjxEFP.jpg', NULL, NULL, NULL, '2024-07-14 06:12:45', '2024-07-14 06:12:45', 83),
(13, 'approved', 41, NULL, 'provider6@mail.com', '09991091104', 'Carpentry', NULL, '1', NULL, 's', 'provider/documents/nthQTZSRlVTvgEYkl6OF42Gbs9OSiOuMZ20m3rkw.png', 'provider/documents/5wmUBAYEWwXXOHT1JAoFNtDDApqWdEKOgP5C1z62.jpg', NULL, NULL, NULL, '2024-07-14 21:26:14', '2024-07-14 21:27:25', 85),
(14, 'approved', 42, NULL, 'andrea@mail.com', '09991091104', 'Plumbing', NULL, '1', NULL, 'e', 'provider/documents/Fj7DDPhyAFpfXiYXWpweIMM9tgQ3r6BExKru5zIJ.png', 'provider/documents/Kyc6k1szxJ1Gzn3qynwkZJe9voZ8Emgueyfx7Shs.jpg', NULL, NULL, NULL, '2024-07-15 03:49:05', '2024-07-15 03:52:29', 86),
(15, 'approved', 43, NULL, 'andrelennardamar@gmail.com', '09991091104', 'Electrical', NULL, '0', NULL, 'a', 'provider/documents/UGEKOVF9o6JH34wUirE4DNCIjPClqRVAjzRbbOGC.png', 'provider/documents/JTXdNVE0yH4T8ZDRNVoOL95JUruj7eXxjcT5P5Mj.jpg', NULL, NULL, NULL, '2024-07-22 22:53:06', '2024-07-22 23:01:14', 92),
(16, 'approved', 44, NULL, 'johndoe123@gmail.com', '639123456789', 'Electrical', NULL, '1', NULL, 'I am a freelance electrician with tesda level 2 accreditation', 'provider/documents/ZVso1ryKPiM3xB7KsSQErEU1e0rU1r8Wj3dCKUMJ.jpg', 'provider/documents/tTmIbFW1I8ST19SgXmZzw7WEgugAg49eFDpSshB8.jpg', 'provider/documents/8BEEFgFJZ7sEDuYc69isyCee9jQSdRwgGbdX8bdu.jpg', NULL, NULL, '2024-07-26 01:29:11', '2024-07-26 01:30:22', 94),
(17, 'approved', 45, NULL, 'authorizer@mail.com', '09991091104', 'Carpentry', NULL, '1', NULL, 'Skilled carpenter specializing in custom furniture', 'provider/documents/sz82JA0KGQW8Pi8AQigOt2nYcxlhNxUHmoFKCOW1.png', 'provider/documents/GUNb8inH3kCQGePnzSYI25GQsan9NDabtAOv7QhI.jpg', 'provider/documents/0rwkicakG94VXh8KAykHb3E9jaWFdJRv9Qg8tlYF.jpg', NULL, NULL, '2024-07-26 06:36:20', '2024-07-26 06:36:29', 98);

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
(24, 15, 95, 98, NULL, NULL, NULL, 10, 10, 10, 10, NULL, '2024-07-27 07:18:17', '2024-07-27 07:18:17', NULL, NULL, NULL);

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
(45, 98, 'approved', '2024-07-26 06:35:18', '2024-07-26 06:36:29');

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
  `hourly_rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  `hourly_rate_max` decimal(10,2) NOT NULL DEFAULT 0.00,
  `expected_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `expected_price_max` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estimated_duration` int(24) NOT NULL DEFAULT 0,
  `number_of_bids` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `attach_media` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('open','in_progress','completed','cancelled') NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attach_media2` varchar(255) DEFAULT NULL,
  `attach_media3` varchar(255) DEFAULT NULL,
  `attach_media4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`id`, `category`, `title`, `description`, `location`, `start_date`, `end_date`, `start_time`, `end_time`, `skill_tags`, `provider_gender`, `job_type`, `hourly_rate`, `hourly_rate_max`, `expected_price`, `expected_price_max`, `estimated_duration`, `number_of_bids`, `attach_media`, `user_id`, `provider_id`, `status`, `created_at`, `updated_at`, `attach_media2`, `attach_media3`, `attach_media4`) VALUES
(11, 'Carpentry', 'Broken Roof', '', 'bacolod city, forest hills', NULL, NULL, '14:26:00', '13:26:00', '', NULL, 'project_based', 0.00, 0.00, 0.00, 0.00, 0, 1, 'service_requests/documents/RM4YFDFL9P3gSMjKdJDd88rrQ6SEigu3uYEg807i.jpg', 71, NULL, 'open', '2024-07-11 07:26:20', '2024-07-14 23:11:07', NULL, NULL, NULL),
(14, 'Plumbing', 'toilet does not flush', 'asdasdasdasdasdasd', 'bacolod city, forest hills', '2024-07-03', '2024-07-20', '18:34:00', '20:34:00', 'flushing', NULL, 'hourly_rate', 123.00, 0.00, 123.00, 0.00, 1, 2, 'service_requests/documents/2ayFbFE0UKIIhysNJP0pyTAp9i6JIlzFBcHPEhtX.jpg', 72, NULL, 'open', '2024-07-13 01:44:29', '2024-07-14 23:08:09', NULL, NULL, NULL),
(15, 'carpentry', 'Carpentry', 'asfsdafasdf', 'asdfsdafasdf', '2024-07-15', '2024-07-16', '23:36:00', '23:37:00', 'asasdasd', NULL, 'hourly_rate', 22.00, 0.00, 0.00, 0.00, 2, 3, 'service_requests/documents/A1CjhVIrDCw9JrGZXNqqEFpGJ9QCHVf4VFFiRjR2.jpg', 75, NULL, 'open', '2024-07-14 19:34:31', '2024-07-18 01:43:21', NULL, NULL, NULL),
(17, 'building_related', 'aaaaaaaaaaaaaa', 'asdasdasd', 'bacolod city, forest hills', '2024-07-15', '2024-07-16', '19:04:00', '23:04:00', 'asdsadasa', 'male', 'project_based', 0.00, 0.00, 12312313.00, 0.00, 0, 1, 'service_requests/documents/9iGO5RTZECGxh7KD2NImqVTakXZXthLjMaDX34Us.webp', 75, NULL, 'open', '2024-07-14 21:04:23', '2024-07-19 06:09:39', NULL, NULL, NULL),
(18, 'carpentry', 'Broken Roof', 'broken roof', 'bacolod city, forest hills', '2024-07-15', '2024-07-16', '19:45:00', '19:45:00', 'none', NULL, 'project_based', 12.00, 0.00, 12.00, 0.00, 2, 0, 'service_requests/documents/Vbe9upi0EF1QKA66xuMWMIPbYYSRH7nIr0Y67tkX.jpg', 86, NULL, 'open', '2024-07-15 02:46:18', '2024-07-15 02:46:18', NULL, NULL, NULL),
(19, 'Plumbing', 'toilet does not flush', 'asdfsd', 'bacolod city, forest hills', '2024-07-15', '2024-07-16', '20:57:00', '21:57:00', 'none', 'male', 'hourly_rate', 22.00, 0.00, 22.00, 0.00, 3, 0, 'service_requests/documents/1Kw1U3Gi1D1KSKT13NMKKFd9VLBOPWTt05noRI8D.webp', 86, NULL, 'open', '2024-07-15 02:58:02', '2024-07-15 02:58:02', NULL, NULL, NULL),
(20, 'electrical', 'a', 'a', 'a', '2024-07-20', '2024-07-20', '19:46:00', '20:46:00', 'a', 'male', 'hourly_rate', 1.00, 0.00, 1.00, 0.00, 1, 2, 'service_requests/documents/LEs9cSTWsUlLTOZPgxxgllFrpGZzucUxYlYP3uhc.png', 75, 86, 'in_progress', '2024-07-20 03:46:50', '2024-07-21 23:44:38', NULL, NULL, NULL),
(21, 'welding', 'w', 'w', 'w', '2024-07-25', '2024-07-25', '06:27:00', '19:27:00', 'none', NULL, 'hourly_rate', 222.00, 0.00, 0.00, 0.00, 0, 1, 'service_requests/documents/Jpd8krZUI34URKj7pxDUuZVSJXAkULTK2ndfQ8Ij.jpg', 75, 86, 'in_progress', '2024-07-22 02:28:41', '2024-07-22 02:30:10', NULL, NULL, NULL),
(22, 'plumbing', 'Not flushing', 'asefsdfasdfa', 'forest hills subd.', '2024-07-26', '2024-07-26', '15:57:00', '16:57:00', 'a', NULL, 'hourly_rate', 400.00, 0.00, 0.00, 0.00, 0, 1, 'service_requests/documents/Ud9aAOUPIDLN9fTshz7END7v5GV7N1faAf4LEW7D.webp', 75, 86, 'in_progress', '2024-07-23 05:57:56', '2024-07-23 06:00:00', NULL, NULL, NULL),
(23, 'plumbing', 'asdasdsadasdsadad', 'asdasdsadasdsadad', 'forest hills subd.', '2024-07-25', '2024-07-25', '14:53:00', '16:53:00', 'flushing', NULL, 'project_based', 123.00, 0.00, 0.00, 0.00, 0, 1, 'service_requests/documents/ppwozcX3kVAu1PbN7tkkf4MRC6nUibAuApAIH21D.webp', 75, 86, 'in_progress', '2024-07-23 22:53:36', '2024-07-23 22:53:59', NULL, NULL, NULL),
(24, 'Plumbing', 'Broken pipe', 'pipe is broken', 'Example Locataion', '2024-07-26', '2024-07-26', '11:35:00', '13:36:00', 'plumbing', NULL, 'hourly_rate', 123.00, 0.00, 0.00, 0.00, 0, 1, 'service_requests/documents/azzWj3n9SXI0kWv0UskZWTEKYyJcv0bcXXkZH2Sv.webp', 75, 86, 'in_progress', '2024-07-25 02:36:58', '2024-07-25 02:37:35', NULL, NULL, NULL),
(25, 'Plumbing', 'm', 'm', 'm', '2024-07-25', '2024-07-25', '20:50:00', '20:50:00', 'm', NULL, 'hourly_rate', 2.00, 0.00, 0.00, 0.00, 0, 1, 'service_requests/documents/NDDf2lMpCTQHnPqnraqTkTMr7YB8vLjUq06E3XWo.jpg', 75, 86, 'completed', '2024-07-25 04:50:49', '2024-07-25 04:52:25', NULL, NULL, NULL),
(26, 'Plumbing', 'v', 'v', 'v', '2024-07-26', '2024-07-27', '21:06:00', '21:06:00', 'v', NULL, 'hourly_rate', 3.00, 0.00, 0.00, 0.00, 0, 1, 'service_requests/documents/D6m1I0Go94v46XYHBXKYtH3xOxkMwCHEZbY7Wzda.webp', 75, 86, 'completed', '2024-07-25 05:06:45', '2024-07-25 05:09:32', NULL, NULL, NULL),
(27, 'Plumbing', 'k', 'k', 'k', '2024-08-06', '2024-08-05', '01:41:00', '02:41:00', 'k', NULL, 'project_based', 0.00, 0.00, 66.00, 0.00, 0, 1, 'service_requests/documents/JmTQ5sCRtahNGu1DiatcbEB2xts04ZQssflG6EnL.jpg', 75, 86, 'completed', '2024-07-25 09:42:25', '2024-07-25 09:44:01', NULL, NULL, NULL),
(28, 'Electrical', 'Dining Area Electical Repair', 'Need to repair wirings on dining area. Materials already available. Installation of chandelier.', 'Brgy. Taculing, Bacolod City', '2024-07-27', '2024-07-27', '08:00:00', '09:00:00', 'Wiring, Electric Tools', 'male', 'project_based', 0.00, 0.00, 800.00, 0.00, 1, 1, 'service_requests/documents/mAkaPNxuelOHIN499TFa26Njm6mX6FUNgnondj5t.jpg', 93, 94, 'in_progress', '2024-07-26 01:17:00', '2024-07-26 01:35:06', NULL, NULL, NULL),
(29, 'Carpentry', 'House Painting', 'Painting of interior walls and ceilings.', 'Barangay Villamonte, Bacolod City', '2024-07-27', '2024-07-27', '10:39:00', '12:39:00', 'painting, interior design', NULL, 'project_based', 0.00, 0.00, 6000.00, 0.00, 24, 1, 'service_requests/documents/brrrGBwRB7GgoCJJTEhJFm1wD016uzPtXUxzxXY4.jpg', 95, 98, 'completed', '2024-07-26 06:40:08', '2024-07-26 06:45:17', NULL, NULL, NULL),
(30, 'Carpentry', 'Kitchen Remodeling', 'Full kitchen remodeling including new cabinets, countertops, and flooring.', 'Barangay Alijis, Bacolod City', '2024-07-27', '2024-07-27', '11:00:00', '16:00:00', 'remodeling, carpentry', 'male', 'project_based', 0.00, 0.00, 50000.00, 0.00, 6, 1, 'service_requests/documents/60spgPVOfxgFRkinO3BVIDrkCB7ptwBoYOyn6FTc.jpg', 95, 98, 'completed', '2024-07-26 07:05:12', '2024-07-26 07:09:33', NULL, NULL, NULL),
(31, 'Carpentry', 'Deck Construction', 'Construction of a wooden deck in the backyard.', 'Barangay Handumanan, Bacolod City', '2024-07-27', '2024-07-27', '11:12:00', '17:12:00', 'carpentry, construction', NULL, 'project_based', 0.00, 0.00, 15000.00, 0.00, 0, 1, 'service_requests/documents/Rkc2pMqinRH8Wm0gHtMtkzMu1w1dUlXC83r0bBB9.jpg', 95, 98, 'completed', '2024-07-26 07:13:09', '2024-07-26 07:18:02', NULL, NULL, NULL),
(32, 'Carpentry', 'Window Replacement', 'Replacement of old windows with new energy-efficient models.', 'Barangay Bata, Bacolod City', '2024-07-28', '2024-07-28', '11:22:00', '15:22:00', 'windows, installation', NULL, 'project_based', 0.00, 0.00, 12000.00, 0.00, 0, 1, 'service_requests/documents/BSrHP90ZNlGD95lc1uvCipK3ABou69IF42yu9MQ8.jpg', 95, 98, 'completed', '2024-07-26 07:22:57', '2024-07-26 07:26:43', NULL, NULL, NULL),
(33, 'Carpentry', 'Floating Shelf Installation', 'Install floating shelves in the living room', 'Barangay Mansilingan, Bacolod City', '2024-07-28', '2024-07-28', '12:59:00', '16:59:00', 'floating shelves, installation', NULL, 'hourly_rate', 300.00, 0.00, 0.00, 0.00, 4, 0, 'service_requests/documents/icfu9l9nTyV8t6yyPSoLVauH2mdWA24yVcjsWNCE.jpg', 95, NULL, 'open', '2024-07-26 21:00:06', '2024-07-26 21:00:06', NULL, NULL, NULL),
(34, 'Carpentry', 'Closet Organization System', 'Design and install a custom closet organization system.', 'Barangay Granada, Bacolod City', '2024-07-28', '2024-07-29', '15:16:00', '17:17:00', 'closet system, design', NULL, 'project_based', 0.00, 0.00, 6000.00, 0.00, 16, 0, 'service_requests/documents/lJyvbWTd4uYUsRmo05PDMraWgvrypEFmLfoXMOTk.jpg', 95, NULL, 'open', '2024-07-26 23:17:46', '2024-07-26 23:17:46', NULL, NULL, NULL),
(36, 'Carpentry', 'Bathroom Renovation', 'Complete bathroom renovation including new fixtures and tiling.', 'Barangay Alijis, Bacolod City', '2024-07-27', '2024-07-27', '14:38:00', '18:38:00', 'door frames, installation', NULL, 'project_based', 0.00, 0.00, 25000.00, 0.00, 24, 0, 'service_requests/documents/NoBnV2lgupiQltsJuHQPNN03KGfmU47vsD30wXFF.jpg', 95, NULL, 'open', '2024-07-27 02:39:32', '2024-07-27 02:39:32', NULL, NULL, NULL),
(37, 'Carpentry', 'Fence Installation', 'Installation of a wooden fence around the property.', 'Barangay Alijis, Bacolod City', '2024-07-27', '2024-07-27', '06:41:00', '18:41:00', 'door frames, installation', 'male', 'hourly_rate', 100.00, 0.00, 0.00, 0.00, 6, 0, 'service_requests/documents/KLHZDdSCQByownC33gB2s6ElW8gpI064CdxpWEgP.jpg', 95, NULL, 'open', '2024-07-27 02:41:54', '2024-07-27 02:41:54', NULL, NULL, NULL),
(38, 'Carpentry', 'Bookshelf Construction', 'Need a custom-built bookshelf made from oak wood for my home office. Dimensions are 7ft tall, 4ft wide, and 1ft deep.', 'Brgy. Mandalagan, Bacolod City', '2024-08-01', '2024-08-01', '09:00:00', '19:00:00', 'Woodworking, Custom Furniture', 'male', 'project_based', 0.00, 0.00, 2800.00, 5000.00, 8, 1, 'service_requests/documents/pCEm76jxiVLXddXPjDKyfUacXGxthuJrbq465ntw.jpg', 95, 98, 'completed', '2024-07-27 03:00:58', '2024-07-27 04:05:29', NULL, NULL, NULL),
(39, 'Carpentry', 'Shelving Installation', 'Need floating shelves installed in the living room and bedroom. Shelves and brackets are provided.', 'Brgy. Estefania, Bacolod City', '2024-07-27', '2024-07-27', '07:25:00', '20:25:00', 'Shelving, Carpentry', NULL, 'hourly_rate', 200.00, 800.00, 0.00, 0.00, 4, 1, 'service_requests/documents/HR29tFljuuSA305yhFeOtuVjZsZsDRk45LSwDEcD.jpg', 95, 98, 'completed', '2024-07-27 03:25:55', '2024-07-27 07:18:05', NULL, NULL, NULL),
(40, 'Carpentry', 'Gazebo Construction', 'Looking to build a gazebo in the backyard. Materials provided, need skilled carpenter to build.', 'Brgy. Granada, Bacolod City', '2024-07-30', '2024-07-30', '16:00:00', '18:01:00', 'Carpentry, Outdoor Structures', NULL, 'hourly_rate', 250.00, 400.00, 0.00, 0.00, 3, 1, 'service_requests/documents/hmEaTwsonyLikBSmXyiLXueMuQ0LV6wCi5fmymPK.jpg', 95, 98, 'in_progress', '2024-07-27 06:03:06', '2024-07-27 08:14:32', NULL, NULL, NULL);

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
('1MM5gWGvumBF4Cd9myI7xMVFsSx5Wl8y1UK4eISb', 95, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic0RqUk1JOXpqS1NuVW44ZzllSUJqY3JqS1F0M29TRVdHREZ5bklLbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5NTt9', 1722097286),
('AJayMLA0gqSGSB4N2MoEMEwowGos7Xk2NnDxefis', 73, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM3dTeTdSMUdFanBBUXVwTkxJMDFxSXF4dEhjOENTRzY3bGJHZ3ZvQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3Mzt9', 1722095811),
('EzyZUxEK6Gf7eBsTxo0BMRFbI5NCtwNxQb3NgxZP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 OPR/109.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSG5wVEwwenhUY3JBZVUyVG9ocW9KcGYzUE9aUGhJZWRYOXg3cFV4UCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm92aWRlci1jaGFubmVsLzIyIjt9fQ==', 1721803520),
('fN5AtbJ415jL9WpzbESex2MlsGJIbilphVk1fIaG', 86, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic0pMVHVOS0hKaDZuclJsS1BqcVBGS2poNmlxSnBZdzRjUTQzUXFaYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm92aWRlci1jaGFubmVsLzIzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjg2O30=', 1721804055),
('hKGuGoedp2VTJMfATZoF3psWnBkwjn9vlV7inILc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTzZKVkZUYldKT3ZWcVZrSlNjb2k0Z05mTzdFZ0daZnAyczVBdklDQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6NjoiZXJyb3JzIjt9czozOiJuZXciO2E6MDp7fX1zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xvZ2luIjt9czo2OiJlcnJvcnMiO086MzE6IklsbHVtaW5hdGVcU3VwcG9ydFxWaWV3RXJyb3JCYWciOjE6e3M6NzoiACoAYmFncyI7YToxOntzOjc6ImRlZmF1bHQiO086Mjk6IklsbHVtaW5hdGVcU3VwcG9ydFxNZXNzYWdlQmFnIjoyOntzOjExOiIAKgBtZXNzYWdlcyI7YToxOntzOjU6ImVtYWlsIjthOjE6e2k6MDtzOjIwOiJSb2xlIG5vdCByZWNvZ25pemVkLiI7fX1zOjk6IgAqAGZvcm1hdCI7czo4OiI6bWVzc2FnZSI7fX19fQ==', 1722096260),
('i0cXQ0ApGpsUxIG4BtZORzMN2ZDT8oaVATluIoDC', 98, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMmtBY2M5UzRjQ3VnM0NXemI2UjVZZmhFRXcxdnlXMFRJZDlVWGdEWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk4O30=', 1722096342),
('j5hlHcAt1CtnYV2F7rwryg6GmhvnczXTU4Uqman0', 75, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNFFVVksxYWFjbjZON29vQVdLUGFwd25oQllTSGkyVWZsYlhETWdZdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zZWVrZXItY2hhbm5lbC8yMyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3NTt9', 1721804049),
('kzkXWSIkKk7FaHLKqmhZibHJ8CtVjYDyMjriLadc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiM2c0eTVvb2s1M2tnMmNQakZ5Y1lVWjdIZENWSHFWaFRiSWZDUmdYWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1722096543),
('lVkxqRQgE8l5gHy3yS0R6totKkbfFFtaXEZ9plIi', 73, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicEJ6NEdGc01BaWZIRE9wcm9GQkdPVEROdFM5aFZBMlJjUGNIbmp0WSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdXRob3JpemVyL2Rhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjczO30=', 1722097525),
('VQ6fY0JAfM9Pp8zajj3y2rnOs5xLsHPegFuLOGMP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 OPR/109.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNnRBOG1RUXFHWm4xdklDNE5CNUNlbEU4RDI2M3ZoTFVIU2IxM09GeSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7fX0=', 1722097287);

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
(98, 'Luisa Garcia', 'luisagarcia@example.com', '639991091104', NULL, '$2y$12$cQZ.4yE9mCX45nNHPy3pkeQJj0KoHf4qt1Tzvrv3qqB2MV3NfLcJK', NULL, '2024-07-26 06:30:38', '2024-07-26 06:30:46', '1941-08-20', '123 Lacson Street Bacolod City, Negros Occidental 6100 Philippines', 'Male', 2);

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
-- Indexes for table `provider_details`
--
ALTER TABLE `provider_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_provider_details_request_lists` (`request_id`),
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- AUTO_INCREMENT for table `provider_details`
--
ALTER TABLE `provider_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `psa_jobs`
--
ALTER TABLE `psa_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `request_lists`
--
ALTER TABLE `request_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

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
-- Constraints for table `provider_details`
--
ALTER TABLE `provider_details`
  ADD CONSTRAINT `fk_provider_details_provider_id` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_provider_details_request_lists` FOREIGN KEY (`request_id`) REFERENCES `request_lists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`rated_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_3` FOREIGN KEY (`rated_for_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
