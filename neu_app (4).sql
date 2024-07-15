-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2024 at 06:46 PM
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
('provider2@mail.com|127.0.0.1', 'i:2;', 1720940767),
('provider2@mail.com|127.0.0.1:timer', 'i:1720940767;', 1720940767);

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
(7, '2024_06_30_082458_create_permission_tables', 2);

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
(12, 'pending', 39, NULL, 'provider5@mail.com', '09991091104', 'Bus Driving', NULL, '1', NULL, 'as', 'provider/documents/W2XUdVAZstJI0uPktjMBwQqbsqMFIxO9hOXHYDMV.png', 'provider/documents/jXv1GE84mfwNYDjWOkgPdFbM1RcEttFIfKOjxEFP.jpg', NULL, NULL, NULL, '2024-07-14 06:12:45', '2024-07-14 06:12:45', 83);

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
(39, 83, 'pending', '2024-07-14 06:12:19', '2024-07-14 06:12:19');

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
  `expected_price` decimal(10,2) NOT NULL DEFAULT 0.00,
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

INSERT INTO `service_requests` (`id`, `category`, `title`, `description`, `location`, `start_date`, `end_date`, `start_time`, `end_time`, `skill_tags`, `provider_gender`, `job_type`, `hourly_rate`, `expected_price`, `estimated_duration`, `number_of_bids`, `attach_media`, `user_id`, `provider_id`, `status`, `created_at`, `updated_at`, `attach_media2`, `attach_media3`, `attach_media4`) VALUES
(11, 'Carpentry', 'Broken Roof', '', 'bacolod city, forest hills', NULL, NULL, '14:26:00', '13:26:00', '', NULL, 'project_based', 0.00, 0.00, 0, 0, 'service_requests/documents/RM4YFDFL9P3gSMjKdJDd88rrQ6SEigu3uYEg807i.jpg', 71, NULL, 'open', '2024-07-11 07:26:20', '2024-07-11 07:26:20', NULL, NULL, NULL),
(12, 'Carpentry', 'Broken Roof fdfsdfdsfsd', '', 'bacolod city, forest hills', NULL, NULL, '18:39:00', '16:42:00', '', NULL, 'project_based', 0.00, 0.00, 0, 0, 'service_requests/documents/gPblji1d7OBEOG5vyFV6X2hyeHltYgwPL1LRPWdT.jpg', 75, NULL, 'open', '2024-07-12 00:40:05', '2024-07-12 00:43:52', NULL, NULL, NULL),
(14, 'plumbing', 'toilet does not flush', 'asdasdasdasdasdasd', 'bacolod city, forest hills', '2024-07-03', '2024-07-20', '18:34:00', '20:34:00', 'flushing', NULL, 'hourly_rate', 123.00, 123.00, 1, 0, 'service_requests/documents/2ayFbFE0UKIIhysNJP0pyTAp9i6JIlzFBcHPEhtX.jpg', 72, NULL, 'open', '2024-07-13 01:44:29', '2024-07-13 01:44:29', NULL, NULL, NULL);

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
('DWugykM0a9zZDG6D6V7V0AOXptlo3dUgSFT3g144', 75, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibndKNU5naFlScGNqWHBxSVRqbWhGcmRXMEpYUm92S1laOGtWSWNFVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NzU7fQ==', 1720975416),
('ma0pUXm5cYcWmnihvVPlYXMy1K2DNsQwb6PeaWvh', 73, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 OPR/109.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicUR0WTc5WUJuSnFtektQSUxiMklsNHg4dHRldTdCUEp2ZURTRUdLcyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjczO30=', 1720975417);

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
(83, 'provider5 account', 'provider5@mail.com', '639991091104', NULL, '$2y$12$fxtx816hl0dqrZSULOerPeXU1q7nTkPuYO.JZqxxQi7rongC6pB5i', NULL, '2024-07-14 06:09:58', '2024-07-14 06:10:15', '1939-09-16', '123 Lacson Street Bacolod City, Negros Occidental 6100 Philippines', 'Male', 3);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `provider_details`
--
ALTER TABLE `provider_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `psa_jobs`
--
ALTER TABLE `psa_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `request_lists`
--
ALTER TABLE `request_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
