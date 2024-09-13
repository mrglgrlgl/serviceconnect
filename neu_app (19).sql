-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 03:13 AM
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
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@serviceconnect.com', '$2y$12$.zm7hUMdcDovx5HAYG1kh./TH6W.O5.uM1N2Jg4fDNYuwTZurvDO2', '2024-08-10 21:40:22', '2024-08-10 21:40:22');

-- --------------------------------------------------------

--
-- Table structure for table `agencies`
--

CREATE TABLE `agencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','pending') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agencies`
--

INSERT INTO `agencies` (`id`, `name`, `email`, `phone`, `address`, `logo_path`, `status`, `created_at`, `updated_at`) VALUES
(2, 'RKJJ', 'rkj@email.com', '09123456793', '123 Rizal Street, Barangay Villamonte, Bacolod City, Philippines', 'logos/60FDRvGzSIn4ZEq50q3EQT4LMNRxIcqVCyGRA044.png', 'active', '2024-08-14 19:24:57', '2024-08-30 17:00:09'),
(3, 'agency2', 'agency2@email.com', '09123456793', '123 Rizal Street, Barangay Villamonte, Bacolod City, Philippines', NULL, 'active', '2024-08-14 19:30:16', '2024-08-14 19:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `agency_services`
--

CREATE TABLE `agency_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agency_id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agency_services`
--

INSERT INTO `agency_services` (`id`, `agency_id`, `service_name`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'Janitorial', 'We offer Janitorial Services', 1, '2024-08-20 17:55:41', '2024-08-20 17:55:41'),
(2, 2, 'Repairs', 'we handle repairs', 1, '2024-08-24 06:15:42', '2024-08-24 06:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `agency_updates`
--

CREATE TABLE `agency_updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agency_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `submitted_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `reviewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agency_updates`
--

INSERT INTO `agency_updates` (`id`, `agency_id`, `name`, `email`, `phone`, `address`, `logo_path`, `submitted_by`, `status`, `reviewed_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'RKJ', 'rkj@email.com', '09123456793', '123 Rizal Street, Barangay Villamonte, Bacolod City, Philippines', NULL, 1, 'approved', 1, '2024-08-19 19:28:56', '2024-08-20 02:28:13'),
(2, 2, 'RKJ', 'rkj@email.com', '09123456793', '123 Rizal Street, Barangay Villamonte, Bacolod City, Philippines', 'logos/AT4GDV4xmjOs4nWmvNzpuPqtBkzIEVWy7gs4FC0Q.jpg', 1, 'rejected', 1, '2024-08-20 02:39:49', '2024-08-20 02:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `agency_users`
--

CREATE TABLE `agency_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agency_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agency_users`
--

INSERT INTO `agency_users` (`id`, `agency_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, 'agency user 6', 'agency1@mail.com', '$2y$12$bqsxPLPDT3WnOYJTMttg/evTfolq96GN8/Y29sGNyTywXP3p0WNam', NULL, '2024-08-16 00:43:39', '2024-08-17 10:16:29'),
(2, 3, 'andre', 'andrea@mail.com', '$2y$12$qoA/WTvCWvTk5BWg8LG.UufMB9.f3dJPoQEV1.uAGHHnA95Y97iVW', NULL, '2024-08-18 06:05:26', '2024-08-18 06:05:26');

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
(41, 50, 98, 1000.00, 'fhgfhf', '2024-07-31 05:47:53', '2024-08-06 22:11:53', 'accepted', 1),
(42, 64, 98, 233.00, 'rdfgdfg', '2024-07-31 05:50:45', '2024-07-31 05:50:45', 'pending', 1),
(43, 64, 98, 233.00, 'rdfgdfg', '2024-07-31 05:50:45', '2024-07-31 05:50:45', 'pending', 1),
(44, 66, 102, 45.00, 'sdfafd', '2024-07-31 22:46:24', '2024-07-31 23:25:22', 'rejected', 1),
(45, 66, 86, 50.00, 'sadfsdfads', '2024-07-31 23:14:42', '2024-07-31 23:25:19', 'accepted', 1),
(46, 75, 98, 1234.00, 'sfsdfsd', '2024-08-01 22:53:35', '2024-08-01 23:02:47', 'accepted', 1),
(47, 68, 98, 150.00, 'tesyes', '2024-08-02 00:19:26', '2024-08-02 00:19:26', 'pending', 1),
(48, 76, 98, 56.00, 'yees', '2024-08-02 09:56:05', '2024-08-02 09:56:26', 'accepted', 1),
(49, 82, 86, 70.00, 'Can repair heater', '2024-08-06 01:18:55', '2024-08-06 01:32:06', 'rejected', 1),
(50, 82, 102, 80.00, 'can repair cheaper', '2024-08-06 01:31:43', '2024-08-06 01:32:06', 'accepted', 1),
(51, 74, 98, 90.00, 'yes', '2024-08-06 21:42:44', '2024-08-06 21:42:44', 'pending', 1),
(52, 11, 111, 12.00, 's', '2024-08-07 09:00:20', '2024-08-07 09:00:20', 'pending', 1),
(55, 86, 109, 50.00, 'got it', '2024-08-07 23:29:58', '2024-08-07 23:55:42', 'accepted', 1),
(56, 83, 109, 15000.00, 'yes', '2024-08-08 00:13:04', '2024-08-08 00:22:18', 'accepted', 1),
(57, 88, 109, 90.00, 'yrd', '2024-08-08 01:24:18', '2024-08-08 01:24:34', 'accepted', 1),
(63, 11, 1, 123.00, 'asdfsd', '2024-08-20 20:07:33', '2024-08-20 20:07:33', 'pending', 0),
(64, 90, 1, 12.00, 'asds', '2024-08-21 04:28:46', '2024-08-26 08:28:24', 'accepted', 0),
(65, 90, 1, 12.00, 'asds', '2024-08-21 04:30:20', '2024-08-26 08:28:27', 'rejected', 0),
(66, 90, 1, 12.00, 'asds', '2024-08-21 04:30:52', '2024-08-26 08:28:27', 'rejected', 0),
(67, 90, 1, 12.00, 'asds', '2024-08-21 04:31:06', '2024-08-26 08:28:27', 'rejected', 0),
(68, 90, 1, 12.00, 'asds', '2024-08-21 04:31:11', '2024-08-26 08:28:27', 'rejected', 0),
(69, 90, 1, 12.00, 'asds', '2024-08-21 04:32:01', '2024-08-26 08:28:27', 'rejected', 0),
(70, 90, 1, 123.00, 'sdas', '2024-08-21 04:32:05', '2024-08-26 08:28:27', 'rejected', 0),
(71, 90, 1, 12.00, 'sdfsd', '2024-08-21 04:33:12', '2024-08-26 08:28:27', 'rejected', 0),
(72, 90, 1, 12.00, 'sdfsd', '2024-08-21 04:50:08', '2024-08-26 08:28:27', 'rejected', 0),
(73, 11, 1, 23.00, 'dasda', '2024-08-26 07:23:48', '2024-08-26 07:23:48', 'pending', 0),
(74, 11, 1, 23.00, 'dasda', '2024-08-26 07:25:06', '2024-08-26 07:25:06', 'pending', 0),
(75, 11, 1, 23.00, 'dasda', '2024-08-26 07:27:07', '2024-08-26 07:27:07', 'pending', 0),
(76, 11, 1, 23.00, 'dasda', '2024-08-26 07:29:48', '2024-08-26 07:29:48', 'pending', 0),
(77, 11, 1, 23.00, 'dasda', '2024-08-26 07:31:11', '2024-08-26 07:31:11', 'pending', 0),
(78, 11, 1, 23.00, 'dasda', '2024-08-26 07:38:53', '2024-08-26 07:38:53', 'pending', 0),
(79, 11, 1, 23.00, 'dasda', '2024-08-26 07:39:56', '2024-08-26 07:39:56', 'pending', 0),
(80, 11, 1, 23.00, 'dasda', '2024-08-26 07:41:44', '2024-08-26 07:41:44', 'pending', 0),
(81, 11, 1, 23.00, 'dasda', '2024-08-26 07:43:29', '2024-08-26 07:43:29', 'pending', 0),
(82, 11, 1, 233.00, 'asdad', '2024-08-26 07:52:55', '2024-08-26 07:52:55', 'pending', 0),
(83, 89, 1, 123.00, 'asddsa', '2024-08-26 22:14:19', '2024-08-26 22:15:39', 'accepted', 0),
(84, 91, 1, 700.00, 'sdf', '2024-08-27 08:56:54', '2024-08-27 08:57:12', 'accepted', 0),
(85, 92, 1, 900.00, 'Agency Channel Test', '2024-08-27 09:10:26', '2024-08-27 09:16:47', 'accepted', 0),
(86, 93, 1, 123.00, 'Test channel agench', '2024-08-27 09:24:51', '2024-08-27 09:25:05', 'accepted', 0),
(90, 133, 1, 0.00, 'CHannel creation test', '2024-08-27 19:32:06', '2024-08-27 19:32:06', 'pending', 0),
(91, 133, 1, 0.00, 'CHannel creation test', '2024-08-27 19:33:08', '2024-08-27 19:33:08', 'pending', 0),
(92, 133, 1, 0.00, 'CHannel creation test', '2024-08-27 19:33:15', '2024-08-27 19:33:56', 'accepted', 0),
(93, 132, 1, 0.00, 'channel creation test', '2024-08-27 19:42:08', '2024-08-27 19:42:56', 'accepted', 0),
(94, 131, 1, 69.00, 'channel creation test', '2024-08-27 21:59:42', '2024-08-27 22:00:22', 'accepted', 0);

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
(3, 102, 'Advanced Plumbing Certification', 'National Plumbing Association', '2023-01-15', NULL, NULL, 'certifications/Bd7wUolFNwuu5N6siBgKqIaDOz4AVXxzF42MUbtI.jpg', '2024-08-01 20:35:57', '2024-08-01 20:35:57'),
(4, 98, 'Carpentry Certification', 'National Carpentry Organization', '2024-08-01', NULL, NULL, NULL, '2024-08-07 10:23:39', '2024-08-07 10:23:39'),
(5, 109, 'Carpentry Workshop', 'Carpentry Organiztion', '2011-02-10', NULL, NULL, NULL, '2024-08-07 10:41:47', '2024-08-07 10:41:47');

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
  `is_paid` enum('pending','true') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`id`, `seeker_id`, `provider_id`, `service_request_id`, `bid_id`, `created_at`, `updated_at`, `status`, `is_on_the_way`, `is_arrived`, `is_task_started`, `is_task_completed`, `start_time`, `completion_time`, `is_paid`) VALUES
(29, 95, 1, 90, 64, '2024-08-26 08:28:24', '2024-08-27 17:54:57', 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(30, 95, 1, 89, 83, '2024-08-26 22:15:40', '2024-08-27 17:54:55', 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(31, 95, 1, 91, 84, '2024-08-27 08:57:12', '2024-08-27 17:54:51', 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(42, 95, 1, 133, 8, '2024-08-27 20:11:35', '2024-08-27 20:11:35', 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(43, 95, 1, 131, 94, '2024-08-27 22:00:22', '2024-08-27 22:00:22', 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `channel_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `message_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agency_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `agency_id`, `name`, `email`, `phone`, `position`, `gender`, `birthdate`, `photo`, `created_at`, `updated_at`) VALUES
(2, 2, 'Employee', 'employee@email.com', '09991091104', 'Position', 'male', '2024-08-15', 'photos/XieLD68xZcEwF3cR6MtmQRJFBUj2IgfHqfiA4ZOn.jpg', '2024-08-18 06:44:57', '2024-08-18 06:44:57'),
(4, 2, 'Employee 1', 'employee1@example.com', '555-555-5555', 'Position 1', 'female', '1991-08-24', NULL, '2024-08-24 06:24:58', '2024-08-24 06:24:58'),
(5, 2, 'Employee 2', 'employee2@example.com', '555-555-5555', 'Position 2', 'male', '1997-08-24', NULL, '2024-08-24 06:24:58', '2024-08-24 06:24:58'),
(6, 2, 'Employee 3', 'employee3@example.com', '555-555-5555', 'Position 3', 'female', '1999-08-24', NULL, '2024-08-24 06:24:58', '2024-08-24 06:24:58'),
(7, 2, 'Employee 4', 'employee4@example.com', '555-555-5555', 'Position 4', 'male', '1988-08-24', NULL, '2024-08-24 06:24:58', '2024-08-24 06:24:58'),
(8, 2, 'Employee 5', 'employee5@example.com', '555-555-5555', 'Position 5', 'female', '1996-08-24', NULL, '2024-08-24 06:24:58', '2024-08-24 06:24:58'),
(9, 2, 'Employee 6', 'employee6@example.com', '555-555-5555', 'Position 6', 'male', '1987-08-24', NULL, '2024-08-24 06:24:58', '2024-08-24 06:24:58'),
(10, 2, 'Employee 7', 'employee7@example.com', '555-555-5555', 'Position 7', 'female', '1991-08-24', NULL, '2024-08-24 06:24:58', '2024-08-24 06:24:58'),
(11, 2, 'Employee 8', 'employee8@example.com', '555-555-5555', 'Position 8', 'male', '1995-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(12, 2, 'Employee 9', 'employee9@example.com', '555-555-5555', 'Position 9', 'female', '1984-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(13, 2, 'Employee 10', 'employee10@example.com', '555-555-5555', 'Position 10', 'male', '1997-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(14, 2, 'Employee 11', 'employee11@example.com', '555-555-5555', 'Position 11', 'female', '2004-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(15, 2, 'Employee 12', 'employee12@example.com', '555-555-5555', 'Position 12', 'male', '1992-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(16, 2, 'Employee 13', 'employee13@example.com', '555-555-5555', 'Position 13', 'female', '2004-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(17, 2, 'Employee 14', 'employee14@example.com', '555-555-5555', 'Position 14', 'male', '1986-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(18, 2, 'Employee 15', 'employee15@example.com', '555-555-5555', 'Position 15', 'female', '1991-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(19, 2, 'Employee 16', 'employee16@example.com', '555-555-5555', 'Position 16', 'male', '2000-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(20, 2, 'Employee 17', 'employee17@example.com', '555-555-5555', 'Position 17', 'female', '1999-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(21, 2, 'Employee 18', 'employee18@example.com', '555-555-5555', 'Position 18', 'male', '1995-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(22, 2, 'Employee 19', 'employee19@example.com', '555-555-5555', 'Position 19', 'female', '1998-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(23, 2, 'Employee 20', 'employee20@example.com', '555-555-5555', 'Position 20', 'male', '2003-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(24, 2, 'Employee 21', 'employee21@example.com', '555-555-5555', 'Position 21', 'female', '1988-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(25, 2, 'Employee 22', 'employee22@example.com', '555-555-5555', 'Position 22', 'male', '1988-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(26, 2, 'Employee 23', 'employee23@example.com', '555-555-5555', 'Position 23', 'female', '1992-08-24', NULL, '2024-08-24 06:24:59', '2024-08-24 06:24:59'),
(27, 2, 'Employee 24', 'employee24@example.com', '555-555-5555', 'Position 24', 'male', '2002-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(28, 2, 'Employee 25', 'employee25@example.com', '555-555-5555', 'Position 25', 'female', '1985-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(29, 2, 'Employee 26', 'employee26@example.com', '555-555-5555', 'Position 26', 'male', '1997-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(30, 2, 'Employee 27', 'employee27@example.com', '555-555-5555', 'Position 27', 'female', '1985-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(31, 2, 'Employee 28', 'employee28@example.com', '555-555-5555', 'Position 28', 'male', '1986-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(32, 2, 'Employee 29', 'employee29@example.com', '555-555-5555', 'Position 29', 'female', '1985-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(33, 2, 'Employee 30', 'employee30@example.com', '555-555-5555', 'Position 30', 'male', '2004-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(34, 2, 'Employee 31', 'employee31@example.com', '555-555-5555', 'Position 31', 'female', '1984-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(35, 2, 'Employee 32', 'employee32@example.com', '555-555-5555', 'Position 32', 'male', '2000-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(36, 2, 'Employee 33', 'employee33@example.com', '555-555-5555', 'Position 33', 'female', '2001-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(37, 2, 'Employee 34', 'employee34@example.com', '555-555-5555', 'Position 34', 'male', '1991-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(38, 2, 'Employee 35', 'employee35@example.com', '555-555-5555', 'Position 35', 'female', '1996-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(39, 2, 'Employee 36', 'employee36@example.com', '555-555-5555', 'Position 36', 'male', '1993-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(40, 2, 'Employee 37', 'employee37@example.com', '555-555-5555', 'Position 37', 'female', '1996-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(41, 2, 'Employee 38', 'employee38@example.com', '555-555-5555', 'Position 38', 'male', '2003-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(42, 2, 'Employee 39', 'employee39@example.com', '555-555-5555', 'Position 39', 'female', '1994-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(43, 2, 'Employee 40', 'employee40@example.com', '555-555-5555', 'Position 40', 'male', '1992-08-24', NULL, '2024-08-24 06:25:00', '2024-08-24 06:25:00'),
(44, 2, 'Employee 41', 'employee41@example.com', '555-555-5555', 'Position 41', 'female', '1996-08-24', NULL, '2024-08-24 06:25:01', '2024-08-24 06:25:01'),
(45, 2, 'Employee 42', 'employee42@example.com', '555-555-5555', 'Position 42', 'male', '1992-08-24', NULL, '2024-08-24 06:25:01', '2024-08-24 06:25:01'),
(46, 2, 'Employee 43', 'employee43@example.com', '555-555-5555', 'Position 43', 'female', '1987-08-24', NULL, '2024-08-24 06:25:01', '2024-08-24 06:25:01'),
(47, 2, 'Employee 44', 'employee44@example.com', '555-555-5555', 'Position 44', 'male', '1991-08-24', NULL, '2024-08-24 06:25:01', '2024-08-24 06:25:01'),
(48, 2, 'Employee 45', 'employee45@example.com', '555-555-5555', 'Position 45', 'female', '1985-08-24', NULL, '2024-08-24 06:25:01', '2024-08-24 06:25:01'),
(49, 2, 'Employee 46', 'employee46@example.com', '555-555-5555', 'Position 46', 'male', '2003-08-24', NULL, '2024-08-24 06:25:01', '2024-08-24 06:25:01'),
(50, 2, 'Employee 47', 'employee47@example.com', '555-555-5555', 'Position 47', 'female', '2004-08-24', NULL, '2024-08-24 06:25:01', '2024-08-24 06:25:01'),
(51, 2, 'Employee 48', 'employee48@example.com', '555-555-5555', 'Position 48', 'male', '1986-08-24', NULL, '2024-08-24 06:25:01', '2024-08-24 06:25:01'),
(52, 2, 'Employee 49', 'employee49@example.com', '555-555-5555', 'Position 49', 'female', '1994-08-24', NULL, '2024-08-24 06:25:01', '2024-08-24 06:25:01'),
(53, 2, 'Employee 50', 'employee50@example.com', '555-555-5555', 'Position 50', 'male', '1985-08-24', NULL, '2024-08-24 06:25:01', '2024-08-24 06:25:01'),
(54, 2, 'Employee 51', 'employee51@email.com', '09991091104', 'Position51', 'male', '2024-08-27', NULL, '2024-08-26 07:19:30', '2024-08-26 07:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `employee_service_assignments`
--

CREATE TABLE `employee_service_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `agency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_service_assignments`
--

INSERT INTO `employee_service_assignments` (`id`, `employee_id`, `service_id`, `agency_id`, `assigned_at`, `created_at`, `updated_at`) VALUES
(9, 4, 2, 2, '2024-08-24 06:25:28', '2024-08-24 06:25:28', '2024-08-24 06:25:28'),
(10, 5, 1, 2, '2024-08-24 06:25:33', '2024-08-24 06:25:33', '2024-08-24 06:25:33'),
(12, 2, 2, 2, '2024-08-25 00:43:24', '2024-08-25 00:43:03', '2024-08-25 00:43:24'),
(13, 2, 1, 2, '2024-08-25 00:43:24', '2024-08-25 00:43:24', '2024-08-25 00:43:24');

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
(10, '2024_07_23_164252_add_task_tracking_columns_to_channel_table', 5),
(11, '2024_08_11_050525_create_admin_users_table', 6),
(12, '2024_08_13_130531_create_chats_table', 7),
(13, '2024_08_14_164630_create_agencies_table', 8),
(14, '2024_08_15_033612_create_agency_users_table', 9),
(16, '2024_08_18_040433_create_employees_table', 10),
(17, '2024_08_19_061136_add_logo_path_to_agencies_table', 11),
(18, '2024_08_20_013325_create_agency_updates_table', 12),
(19, '2024_08_20_144342_create_agency_services_table', 13),
(20, '2024_08_24_061534_create_employee_service_assignments_table', 14),
(21, '2024_08_24_105549_add_agency_id_to_employee_service_assignments_table', 15);

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
('1799b44c-34f9-4034-b34c-9c609c681da1', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 110, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":50,\"provider_name\":null}', NULL, '2024-08-06 01:31:43', '2024-08-06 01:31:43'),
('1c943f9a-eab3-449a-8b3a-68e74667b6b6', 'App\\Notifications\\BidConfirmed', 'App\\Models\\AgencyUser', 1, '{\"message\":\"Your bid has been confirmed for the service request: Sample Request 16\",\"bid_id\":94,\"service_request_id\":131}', NULL, '2024-08-27 22:00:25', '2024-08-27 22:00:25'),
('1d336f97-6858-42fa-b93e-8f487e23c5fc', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 116, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":53,\"provider_name\":null}', NULL, '2024-08-07 22:19:37', '2024-08-07 22:19:37'),
('21a06f53-5248-4458-9855-ae6aef62dbd1', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: k\",\"bid_id\":20,\"service_request_id\":27}', NULL, '2024-07-25 09:43:06', '2024-07-25 09:43:06'),
('2adb0ce8-2f21-414f-91a0-875e4574dff8', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 116, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":55,\"provider_name\":null}', NULL, '2024-08-07 23:30:00', '2024-08-07 23:30:00'),
('331a80fc-6ee5-4826-8d37-7524024db039', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: w\",\"bid_id\":14,\"service_request_id\":21}', NULL, '2024-07-22 02:30:15', '2024-07-22 02:30:15'),
('337998d6-2c91-43d4-a352-1c0bd9b1498c', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: Pump Installation\",\"bid_id\":45,\"service_request_id\":66}', NULL, '2024-07-31 23:25:22', '2024-07-31 23:25:22'),
('3596b769-d1e4-4865-8eac-5e6571faad34', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Shelving Installation\",\"bid_id\":27,\"service_request_id\":39}', NULL, '2024-07-27 07:16:48', '2024-07-27 07:16:48'),
('39f6d322-89ab-4282-a8e1-2491dd8981be', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Schedule Blocking 2\",\"bid_id\":48,\"service_request_id\":76}', NULL, '2024-08-02 09:56:27', '2024-08-02 09:56:27'),
('3c6cabaa-bb28-4c17-8c43-c2cd48cecd01', 'App\\Notifications\\BidConfirmed', 'App\\Models\\AgencyUser', 1, '{\"message\":\"Your bid has been confirmed for the service request: agency user channel test\",\"bid_id\":84,\"service_request_id\":91}', NULL, '2024-08-27 08:57:14', '2024-08-27 08:57:14'),
('4783b1ba-2de6-40e2-ac08-c116cb6bd98b', 'App\\Notifications\\BidConfirmed', 'App\\Models\\AgencyUser', 1, '{\"message\":\"Your bid has been confirmed for the service request: Agency Test\",\"bid_id\":64,\"service_request_id\":90}', NULL, '2024-08-26 08:28:26', '2024-08-26 08:28:26'),
('4c8eb5f8-eb3a-48d3-98f0-c3b8bff4699e', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: v\",\"bid_id\":19,\"service_request_id\":26}', NULL, '2024-07-25 05:07:18', '2024-07-25 05:07:18'),
('5a58ba4c-3d48-47dd-b431-689fb3c8a945', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 116, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":56,\"provider_name\":null}', NULL, '2024-08-08 00:13:05', '2024-08-08 00:13:05'),
('5b24e641-5a22-4870-ab95-8e446738f0ca', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Bookshelf Construction\",\"bid_id\":26,\"service_request_id\":38}', NULL, '2024-07-27 04:04:35', '2024-07-27 04:04:35'),
('5dfbd36f-8cdc-45a5-b719-52382c8148e2', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 95, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":46,\"provider_name\":null}', NULL, '2024-08-01 22:53:39', '2024-08-01 22:53:39'),
('7a17eeb1-91c6-433c-8f35-5f720fba2df3', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 95, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":44,\"provider_name\":null}', NULL, '2024-07-31 22:46:25', '2024-07-31 22:46:25'),
('7e684801-4283-4a2c-95df-ff82cb804846', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 103, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":47,\"provider_name\":null}', NULL, '2024-08-02 00:19:28', '2024-08-02 00:19:28'),
('8a6ed16f-1460-438a-830d-8ea7ce05132c', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 102, '{\"message\":\"Your bid has been confirmed for the service request: f\",\"bid_id\":29,\"service_request_id\":43}', NULL, '2024-07-30 07:18:37', '2024-07-30 07:18:37'),
('8b94a66d-9dae-4a77-9fcb-265d56af055d', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: v\",\"bid_id\":31,\"service_request_id\":45}', NULL, '2024-07-31 05:02:32', '2024-07-31 05:02:32'),
('9f3624b1-3d64-433b-98c6-45765847e46d', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: m\",\"bid_id\":18,\"service_request_id\":25}', NULL, '2024-07-25 04:51:30', '2024-07-25 04:51:30'),
('a5f13041-12ea-4eba-baac-88a511fd206c', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 110, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":49,\"provider_name\":null}', NULL, '2024-08-06 01:18:56', '2024-08-06 01:18:56'),
('a75ab015-08f6-4afb-babe-13f497edeb21', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 116, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":54,\"provider_name\":null}', NULL, '2024-08-07 22:20:22', '2024-08-07 22:20:22'),
('a7ac7f4d-6fde-4ee7-a246-7b8495de9607', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Gazebo Construction\",\"bid_id\":28,\"service_request_id\":40}', NULL, '2024-07-27 08:14:33', '2024-07-27 08:14:33'),
('a9b21c87-1a58-4aac-89b3-09a3e5ed6324', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 94, '{\"message\":\"Your bid has been confirmed for the service request: Dining Area Electical Repair\",\"bid_id\":21,\"service_request_id\":28}', NULL, '2024-07-26 01:35:11', '2024-07-26 01:35:11'),
('ab3d1118-419f-4f8c-929e-1a273105116c', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 109, '{\"message\":\"Your bid has been confirmed for the service request: repair door frames\",\"bid_id\":55,\"service_request_id\":86}', NULL, '2024-08-07 23:55:43', '2024-08-07 23:55:43'),
('ac840e84-d930-4151-9260-2f80abcc1a53', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 109, '{\"message\":\"Your bid has been confirmed for the service request: Create a Wooden Bench\",\"bid_id\":56,\"service_request_id\":83}', NULL, '2024-08-08 00:22:18', '2024-08-08 00:22:18'),
('b1e19429-892a-4901-b689-2d5bd6cd614a', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 102, '{\"message\":\"Your bid has been confirmed for the service request: Water Heater Repair\",\"bid_id\":50,\"service_request_id\":82}', NULL, '2024-08-06 01:32:06', '2024-08-06 01:32:06'),
('b4d3705d-6d38-4128-aa62-1279238be129', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 103, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":51,\"provider_name\":null}', NULL, '2024-08-06 21:42:47', '2024-08-06 21:42:47'),
('b519132f-2755-42f8-ab18-ffdf3b5cd4e7', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: Not flushing\",\"bid_id\":15,\"service_request_id\":22}', NULL, '2024-07-23 06:00:04', '2024-07-23 06:00:04'),
('b7b4ce68-c54c-46d3-9560-6b604f975991', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 71, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":52,\"provider_name\":null}', NULL, '2024-08-07 09:00:22', '2024-08-07 09:00:22'),
('c15f6240-b5ba-4e1a-92bf-c318e66d1d7c', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 95, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":43,\"provider_name\":null}', NULL, '2024-07-31 05:50:46', '2024-07-31 05:50:46'),
('cc7f17e0-8164-48e2-8f1e-d9b8b694fd70', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Window Replacement\",\"bid_id\":25,\"service_request_id\":32}', NULL, '2024-07-26 07:23:23', '2024-07-26 07:23:23'),
('ccc9cd68-29bf-41ef-a56f-f21c7f432341', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 95, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":48,\"provider_name\":null}', NULL, '2024-08-02 09:56:07', '2024-08-02 09:56:07'),
('cdcafe82-05e0-4d60-8309-51d7cfdfc424', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Wooden Deck Repair\",\"bid_id\":36,\"service_request_id\":53}', NULL, '2024-07-31 00:11:04', '2024-07-31 00:11:04'),
('d20f3d94-8ba7-4637-8e3f-a4b105c3d8c3', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 86, '{\"message\":\"Your bid has been confirmed for the service request: asdasdsadasdsadad\",\"bid_id\":16,\"service_request_id\":23}', NULL, '2024-07-23 22:54:05', '2024-07-23 22:54:05'),
('d32cb8f1-31b3-4247-99fe-c7ed5062ff33', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Schedule Blocking 1\",\"bid_id\":46,\"service_request_id\":75}', NULL, '2024-08-01 23:02:48', '2024-08-01 23:02:48'),
('d8b69d9d-fb03-485b-b0c5-da58f3be5e3e', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Deck Construction\",\"bid_id\":24,\"service_request_id\":31}', NULL, '2024-07-26 07:13:27', '2024-07-26 07:13:27'),
('dd7a83a9-7f1a-4151-aa9d-2cdae79ce89b', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 109, '{\"message\":\"Your bid has been confirmed for the service request: Repair Drywall\",\"bid_id\":57,\"service_request_id\":88}', NULL, '2024-08-08 01:24:34', '2024-08-08 01:24:34'),
('de7ba79b-223c-46c3-8bff-ec282d9a1346', 'App\\Notifications\\BidConfirmed', 'App\\Models\\AgencyUser', 1, '{\"message\":\"Your bid has been confirmed for the service request: Agency Test\",\"bid_id\":83,\"service_request_id\":89}', NULL, '2024-08-26 22:15:42', '2024-08-26 22:15:42'),
('f28da11f-ffd2-4084-8668-5eb6a2473ecf', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: Installation of Floating Shelves\",\"bid_id\":41,\"service_request_id\":50}', NULL, '2024-08-02 09:22:42', '2024-08-02 09:22:42'),
('f4ed755a-d297-45fa-87e2-9838c18736e4', 'App\\Notifications\\BidConfirmed', 'App\\Models\\User', 98, '{\"message\":\"Your bid has been confirmed for the service request: 1 test upload\",\"bid_id\":38,\"service_request_id\":65}', NULL, '2024-07-31 21:39:13', '2024-07-31 21:39:13'),
('f8092d80-d76e-4911-9de3-9b5d2572c697', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 95, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":42,\"provider_name\":null}', NULL, '2024-07-31 05:50:45', '2024-07-31 05:50:45'),
('f93e8919-7d7c-4558-89c8-6efd86750c2e', 'App\\Notifications\\BidPlacedNotification', 'App\\Models\\User', 116, '{\"message\":\"A provider has placed a bid on your service request.\",\"service_request_id\":57,\"provider_name\":null}', NULL, '2024-08-08 01:24:20', '2024-08-08 01:24:20'),
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
(19, NULL, NULL, NULL, NULL, 'Plumbing', NULL, '1', 1, 'sasa', 'Friday,Saturday,Sunday', NULL, '2024-07-30 02:23:59', '2024-07-30 02:24:21', 102, NULL),
(20, NULL, NULL, NULL, NULL, 'Carpentry', NULL, '1', 3, 'I am an experienced carpentry for over 3 years', 'Monday,Tuesday,Wednesday,Thursday,Friday,Saturday', NULL, '2024-08-07 08:46:17', '2024-08-07 08:46:17', 111, NULL),
(21, NULL, NULL, NULL, NULL, 'Carpentry', NULL, '1', 10, 'I am a skilled carpenter', 'Monday,Tuesday,Wednesday,Thursday,Friday', NULL, '2024-08-07 10:40:44', '2024-08-07 10:40:44', 109, NULL);

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
(9, 29, NULL, 'non_payment', 'dsds', 98, 95, '2024-08-02 02:19:00', '2024-08-02 02:19:00'),
(10, 31, NULL, 'non_payment', 'fdf', 95, 98, '2024-08-02 02:19:50', '2024-08-02 02:19:50'),
(11, 29, NULL, 'non_payment', 'f', 98, 95, '2024-08-02 03:51:54', '2024-08-02 03:51:54'),
(12, 38, NULL, 'non_payment', 'hh', 98, 95, '2024-08-02 04:02:15', '2024-08-02 04:02:15'),
(13, 30, NULL, 'non_payment', 'df', 95, 98, '2024-08-02 04:04:18', '2024-08-02 04:04:18'),
(14, 29, NULL, 'non_payment', 'sss', 98, 95, '2024-08-02 05:34:47', '2024-08-02 05:34:47'),
(15, 39, NULL, 'non_payment', 'sss', 98, 95, '2024-08-02 05:34:53', '2024-08-02 05:34:53'),
(16, 31, NULL, 'non_payment', 'sss', 98, 95, '2024-08-02 05:35:04', '2024-08-02 05:35:04'),
(17, 32, NULL, 'poor_quality_work', 'test report', 95, 98, '2024-08-02 09:54:41', '2024-08-02 09:54:41'),
(18, 30, NULL, 'non_payment', 'did not pay', 98, 95, '2024-08-07 09:33:16', '2024-08-07 09:33:16'),
(19, 32, NULL, 'non_payment', 'did not pay', 98, 95, '2024-08-07 09:33:25', '2024-08-07 09:33:25');

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
  `skill_tags` varchar(255) DEFAULT NULL,
  `provider_gender` enum('male','female') DEFAULT NULL,
  `job_type` enum('project_based','hourly_rate') NOT NULL,
  `estimated_duration` int(24) NOT NULL DEFAULT 0,
  `number_of_bids` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_direct_hire` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('open','in_progress','completed','cancelled') NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `agreed_to_terms` tinyint(1) NOT NULL DEFAULT 0,
  `min_price` decimal(10,2) DEFAULT 0.00,
  `max_price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`id`, `category`, `title`, `description`, `location`, `start_date`, `end_date`, `start_time`, `end_time`, `skill_tags`, `provider_gender`, `job_type`, `estimated_duration`, `number_of_bids`, `user_id`, `provider_id`, `is_direct_hire`, `status`, `created_at`, `updated_at`, `agreed_to_terms`, `min_price`, `max_price`) VALUES
(11, 'Carpentry', 'Broken Roof', '', 'bacolod city, forest hills', NULL, NULL, '14:26:00', '13:26:00', '', NULL, 'project_based', 0, 15, 71, NULL, 0, 'open', '2024-07-11 07:26:20', '2024-08-26 07:52:55', 0, 0.00, 0.00),
(14, 'Plumbing', 'toilet does not flush', 'asdasdasdasdasdasd', 'bacolod city, forest hills', '2024-07-03', '2024-07-20', '18:34:00', '20:34:00', 'flushing', NULL, 'hourly_rate', 1, 3, 72, NULL, 0, 'open', '2024-07-13 01:44:29', '2024-07-30 17:36:04', 0, 0.00, 0.00),
(15, 'carpentry', 'Carpentry', 'asfsdafasdf', 'asdfsdafasdf', '2024-07-15', '2024-07-16', '23:36:00', '23:37:00', 'asasdasd', NULL, 'hourly_rate', 2, 3, 75, NULL, 0, 'open', '2024-07-14 19:34:31', '2024-07-18 01:43:21', 0, 0.00, 0.00),
(17, 'building_related', 'aaaaaaaaaaaaaa', 'asdasdasd', 'bacolod city, forest hills', '2024-07-15', '2024-07-16', '19:04:00', '23:04:00', 'asdsadasa', 'male', 'project_based', 0, 1, 75, NULL, 0, 'open', '2024-07-14 21:04:23', '2024-07-19 06:09:39', 0, 0.00, 0.00),
(18, 'carpentry', 'Broken Roof', 'broken roof', 'bacolod city, forest hills', '2024-07-15', '2024-07-16', '19:45:00', '19:45:00', 'none', NULL, 'project_based', 2, 1, 86, NULL, 0, 'open', '2024-07-15 02:46:18', '2024-07-30 17:47:01', 0, 0.00, 0.00),
(19, 'Plumbing', 'toilet does not flush', 'asdfsd', 'bacolod city, forest hills', '2024-07-15', '2024-07-16', '20:57:00', '21:57:00', 'none', 'male', 'hourly_rate', 3, 1, 86, NULL, 0, 'open', '2024-07-15 02:58:02', '2024-07-30 08:27:42', 0, 0.00, 0.00),
(20, 'electrical', 'a', 'a', 'a', '2024-07-20', '2024-07-20', '19:46:00', '20:46:00', 'a', 'male', 'hourly_rate', 1, 2, 75, 86, 0, 'in_progress', '2024-07-20 03:46:50', '2024-07-21 23:44:38', 0, 0.00, 0.00),
(21, 'welding', 'w', 'w', 'w', '2024-07-25', '2024-07-25', '06:27:00', '19:27:00', 'none', NULL, 'hourly_rate', 0, 1, 75, 86, 0, 'in_progress', '2024-07-22 02:28:41', '2024-07-22 02:30:10', 0, 0.00, 0.00),
(22, 'plumbing', 'Not flushing', 'asefsdfasdfa', 'forest hills subd.', '2024-07-26', '2024-07-26', '15:57:00', '16:57:00', 'a', NULL, 'hourly_rate', 0, 1, 75, 86, 0, 'in_progress', '2024-07-23 05:57:56', '2024-07-23 06:00:00', 0, 0.00, 0.00),
(23, 'plumbing', 'asdasdsadasdsadad', 'asdasdsadasdsadad', 'forest hills subd.', '2024-07-25', '2024-07-25', '14:53:00', '16:53:00', 'flushing', NULL, 'project_based', 0, 1, 75, 86, 0, 'in_progress', '2024-07-23 22:53:36', '2024-07-23 22:53:59', 0, 0.00, 0.00),
(24, 'Plumbing', 'Broken pipe', 'pipe is broken', 'Example Locataion', '2024-07-26', '2024-07-26', '11:35:00', '13:36:00', 'plumbing', NULL, 'hourly_rate', 0, 1, 75, 86, 0, 'in_progress', '2024-07-25 02:36:58', '2024-07-25 02:37:35', 0, 0.00, 0.00),
(25, 'Plumbing', 'm', 'm', 'm', '2024-07-25', '2024-07-25', '20:50:00', '20:50:00', 'm', NULL, 'hourly_rate', 0, 1, 75, 86, 0, 'completed', '2024-07-25 04:50:49', '2024-07-25 04:52:25', 0, 0.00, 0.00),
(26, 'Plumbing', 'v', 'v', 'v', '2024-07-26', '2024-07-27', '21:06:00', '21:06:00', 'v', NULL, 'hourly_rate', 0, 1, 75, 86, 0, 'completed', '2024-07-25 05:06:45', '2024-07-25 05:09:32', 0, 0.00, 0.00),
(27, 'Plumbing', 'k', 'k', 'k', '2024-08-06', '2024-08-05', '01:41:00', '02:41:00', 'k', NULL, 'project_based', 0, 1, 75, 86, 0, 'completed', '2024-07-25 09:42:25', '2024-07-25 09:44:01', 0, 0.00, 0.00),
(28, 'Electrical', 'Dining Area Electical Repair', 'Need to repair wirings on dining area. Materials already available. Installation of chandelier.', 'Brgy. Taculing, Bacolod City', '2024-07-27', '2024-07-27', '08:00:00', '09:00:00', 'Wiring, Electric Tools', 'male', 'project_based', 1, 1, 93, 94, 0, 'in_progress', '2024-07-26 01:17:00', '2024-07-26 01:35:06', 0, 0.00, 0.00),
(29, 'Carpentry', 'House Painting', 'Painting of interior walls and ceilings.', 'Barangay Villamonte, Bacolod City', '2024-07-27', '2024-07-27', '10:39:00', '12:39:00', 'painting, interior design', NULL, 'project_based', 24, 1, 95, 98, 0, 'completed', '2024-07-26 06:40:08', '2024-07-26 06:45:17', 0, 0.00, 0.00),
(30, 'Carpentry', 'Kitchen Remodeling', 'Full kitchen remodeling including new cabinets, countertops, and flooring.', 'Barangay Alijis, Bacolod City', '2024-07-27', '2024-07-27', '11:00:00', '16:00:00', 'remodeling, carpentry', 'male', 'project_based', 6, 1, 95, 98, 0, 'completed', '2024-07-26 07:05:12', '2024-07-26 07:09:33', 0, 0.00, 0.00),
(31, 'Carpentry', 'Deck Construction', 'Construction of a wooden deck in the backyard.', 'Barangay Handumanan, Bacolod City', '2024-07-27', '2024-07-27', '11:12:00', '17:12:00', 'carpentry, construction', NULL, 'project_based', 0, 1, 95, 98, 0, 'completed', '2024-07-26 07:13:09', '2024-07-26 07:18:02', 0, 0.00, 0.00),
(32, 'Carpentry', 'Window Replacement', 'Replacement of old windows with new energy-efficient models.', 'Barangay Bata, Bacolod City', '2024-07-28', '2024-07-28', '11:22:00', '15:22:00', 'windows, installation', NULL, 'project_based', 0, 1, 95, 98, 0, 'completed', '2024-07-26 07:22:57', '2024-07-26 07:26:43', 0, 0.00, 0.00),
(33, 'Carpentry', 'Floating Shelf Installation', 'Install floating shelves in the living room', 'Barangay Mansilingan, Bacolod City', '2024-07-28', '2024-07-28', '12:59:00', '16:59:00', 'floating shelves, installation', NULL, 'hourly_rate', 4, 0, 95, NULL, 0, 'open', '2024-07-26 21:00:06', '2024-07-26 21:00:06', 0, 0.00, 0.00),
(34, 'Carpentry', 'Closet Organization System', 'Design and install a custom closet organization system.', 'Barangay Granada, Bacolod City', '2024-07-28', '2024-07-29', '15:16:00', '17:17:00', 'closet system, design', NULL, 'project_based', 16, 0, 95, NULL, 0, 'open', '2024-07-26 23:17:46', '2024-07-26 23:17:46', 0, 0.00, 0.00),
(36, 'Carpentry', 'Bathroom Renovation', 'Complete bathroom renovation including new fixtures and tiling.', 'Barangay Alijis, Bacolod City', '2024-07-27', '2024-07-27', '14:38:00', '18:38:00', 'door frames, installation', NULL, 'project_based', 24, 0, 95, NULL, 0, 'open', '2024-07-27 02:39:32', '2024-07-27 02:39:32', 0, 0.00, 0.00),
(37, 'Carpentry', 'Fence Installation', 'Installation of a wooden fence around the property.', 'Barangay Alijis, Bacolod City', '2024-07-27', '2024-07-27', '06:41:00', '18:41:00', 'door frames, installation', 'male', 'hourly_rate', 6, 0, 95, NULL, 0, 'open', '2024-07-27 02:41:54', '2024-07-27 02:41:54', 0, 0.00, 0.00),
(38, 'Carpentry', 'Bookshelf Construction', 'Need a custom-built bookshelf made from oak wood for my home office. Dimensions are 7ft tall, 4ft wide, and 1ft deep.', 'Brgy. Mandalagan, Bacolod City', '2024-08-01', '2024-08-01', '09:00:00', '19:00:00', 'Woodworking, Custom Furniture', 'male', 'project_based', 8, 1, 95, 98, 0, 'completed', '2024-07-27 03:00:58', '2024-07-27 04:05:29', 0, 0.00, 0.00),
(39, 'Carpentry', 'Shelving Installation', 'Need floating shelves installed in the living room and bedroom. Shelves and brackets are provided.', 'Brgy. Estefania, Bacolod City', '2024-07-27', '2024-07-27', '07:25:00', '20:25:00', 'Shelving, Carpentry', NULL, 'hourly_rate', 4, 1, 95, 98, 0, 'completed', '2024-07-27 03:25:55', '2024-07-27 07:18:05', 0, 0.00, 0.00),
(40, 'Carpentry', 'Gazebo Construction', 'Looking to build a gazebo in the backyard. Materials provided, need skilled carpenter to build.', 'Brgy. Granada, Bacolod City', '2024-07-30', '2024-07-30', '16:00:00', '18:01:00', 'Carpentry, Outdoor Structures', NULL, 'hourly_rate', 3, 1, 95, 98, 0, 'completed', '2024-07-27 06:03:06', '2024-08-06 21:55:17', 0, 0.00, 0.00),
(43, 'Plumbing', 'f', 'f', 'Gatuslao Street, Bacolod City', '2024-07-29', '2024-07-29', '11:37:00', '23:37:00', 'Sump Pump Installation, Flood Prevention', NULL, 'project_based', 3, 1, 95, 102, 0, 'completed', '2024-07-29 07:38:02', '2024-07-30 08:16:51', 0, 0.00, 0.00),
(45, 'Plumbing', 'v', 'v', 'v', '2024-07-31', '2024-07-31', '09:28:00', '21:28:00', 'v', NULL, 'project_based', 0, 2, 95, 86, 0, 'in_progress', '2024-07-30 17:28:43', '2024-07-31 05:02:30', 0, 0.00, 0.00),
(46, 'Carpentry', 'Frame Replacement', 'Replace an old wooden door frame with a new one, ensuring proper fit and finish.', '789 Oak Street, Barangay Estefania, Bacolod City', '2024-07-31', '2024-07-31', '00:30:00', '15:03:00', 'Door Installation, Frame Replacement', NULL, 'project_based', 4, 0, 95, NULL, 0, 'open', '2024-07-30 20:06:38', '2024-07-30 20:06:38', 0, 1200.00, 2200.00),
(47, 'Carpentry', 'Custom Bookshelf Installation', 'I need a custom bookshelf installed in my living room. Dimensions should be 10ft x 8ft.', '123 Pine Street, Barangay Villamonte, Bacolod City', '2024-07-31', '2024-07-31', '09:00:00', '13:28:00', 'Woodworking, Custom Furniture', NULL, 'project_based', 4, 0, 95, NULL, 0, 'open', '2024-07-30 21:39:01', '2024-07-30 21:39:01', 0, 1500.00, 2500.00),
(48, 'Carpentry', 'Wooden Deck Repair', 'Repair and reinforce wooden deck boards and railings in the backyard.', '654 Cedar Street, Barangay Singcang, Bacolod City', '2024-07-31', '2024-07-31', '15:43:00', '18:43:00', 'Deck Repair, Outdoor Carpentry', NULL, 'project_based', 4, 0, 95, NULL, 0, 'open', '2024-07-30 21:43:35', '2024-07-30 21:43:35', 0, 2000.00, 3000.00),
(49, 'Carpentry', 'Patio Furniture Construction', 'Build custom patio furniture including a table and benches.', '234 Banana Lane, Barangay Singcang-Airport, Bacolod City', '2024-08-04', '2024-08-04', '08:01:00', '15:01:00', 'Outdoor Furniture, Carpentry', NULL, 'project_based', 7, 0, 95, NULL, 0, 'open', '2024-07-30 22:01:47', '2024-07-30 22:01:47', 0, 2500.00, 4000.00),
(50, 'Carpentry', 'Installation of Floating Shelves', 'Need to install three floating shelves in the living room.', '876 Coconut Drive, Barangay Pahanocoy, Bacolod City', '2024-07-31', '2024-07-31', '02:05:00', '14:05:00', 'Shelving, Wall Mounting', NULL, 'project_based', 5, 1, 95, 98, 0, 'in_progress', '2024-07-30 22:08:05', '2024-08-02 09:22:35', 0, 600.00, 1200.00),
(51, 'Carpentry', 'Installation of Floating Shelves', 'Need to install three floating shelves in the living room.', '876 Coconut Drive, Barangay Pahanocoy, Bacolod City', '2024-07-31', '2024-07-31', '02:05:00', '14:05:00', 'Shelving, Wall Mounting', NULL, 'project_based', 5, 0, 95, NULL, 0, 'open', '2024-07-30 23:05:18', '2024-07-30 23:05:18', 0, 600.00, 1200.00),
(52, 'Carpentry', 'Patio Furniture Construction', 'Build custom patio furniture including a table and benches.', '234 Banana Lane, Barangay Singcang-Airport, Bacolod City', '2024-08-04', '2024-08-04', '08:01:00', '15:01:00', 'Outdoor Furniture, Carpentry', NULL, 'project_based', 7, 0, 95, NULL, 0, 'open', '2024-07-30 23:19:19', '2024-07-30 23:19:19', 1, 2500.00, 4000.00),
(53, 'Carpentry', 'Wooden Deck Repair', 'Repair and reinforce wooden deck boards and railings in the backyard.', '654 Cedar Street, Barangay Singcang, Bacolod City', '2024-07-31', '2024-07-31', '15:43:00', '18:43:00', 'Deck Repair, Outdoor Carpentry', NULL, 'project_based', 4, 1, 95, 98, 0, 'in_progress', '2024-07-30 23:26:01', '2024-07-31 00:10:59', 1, 2000.00, 3000.00),
(54, 'Carpentry', 'Test with separate table', 'Test with separate table', 'Test with separate table', '2024-07-31', '2024-07-31', '00:30:00', '15:03:00', 'Test with separate table', NULL, 'project_based', 4, 0, 95, NULL, 0, 'open', '2024-07-31 01:16:41', '2024-07-31 01:16:41', 1, 1200.00, 2200.00),
(55, 'Carpentry', 'Test with separate table', 'Test with separate table', 'Test with separate table', '2024-07-31', '2024-07-31', '00:30:00', '15:03:00', 'Test with separate table', NULL, 'project_based', 4, 0, 95, NULL, 0, 'open', '2024-07-31 01:18:56', '2024-07-31 01:18:56', 1, 1200.00, 2200.00),
(56, 'Carpentry', 'Test with separate table', 'Test with separate table', 'Test with separate table', '2024-07-31', '2024-07-31', '00:30:00', '15:03:00', 'Test with separate table', NULL, 'project_based', 4, 0, 95, NULL, 0, 'open', '2024-07-31 01:21:08', '2024-07-31 01:21:08', 1, 1200.00, 2200.00),
(57, 'Carpentry', 'Test with separate table 2', 'Test with separate table 2', 'Test with separate table 2', '2024-07-31', '2024-07-31', '05:26:00', '17:26:00', 'Test with separate table 2', NULL, 'hourly_rate', 899, 0, 95, NULL, 0, 'open', '2024-07-31 01:27:44', '2024-07-31 01:27:44', 1, 12.00, 13.00),
(58, 'Carpentry', 'test upload', 'test upload', 'test upload', '2024-07-31', '2024-08-02', '05:39:00', '17:39:00', 'test upload', NULL, 'project_based', 3444, 0, 95, NULL, 0, 'open', '2024-07-31 01:39:39', '2024-07-31 01:39:39', 1, 1.00, 2.00),
(59, 'Carpentry', 'test upload', 'test upload', 'test upload', '2024-07-31', '2024-07-31', '05:45:00', '17:45:00', 'test upload', NULL, 'hourly_rate', 3444, 0, 95, NULL, 0, 'open', '2024-07-31 01:46:14', '2024-07-31 01:46:14', 1, 1.00, 2.00),
(60, 'Carpentry', 'test upload', 'asdasdasdasdasdasdasd', 'test upload', '2024-07-31', '2024-07-31', '05:52:00', '17:52:00', 'test upload', NULL, 'project_based', 3444, 0, 95, NULL, 0, 'open', '2024-07-31 01:52:40', '2024-07-31 01:52:40', 1, 1.00, 2.00),
(61, 'Carpentry', 'test upload', 'asdasdasdasdasdasdasd', 'test upload', '2024-07-31', '2024-07-31', '05:52:00', '17:52:00', 'test upload', NULL, 'project_based', 3444, 0, 95, NULL, 0, 'open', '2024-07-31 01:53:41', '2024-07-31 01:53:41', 1, 1.00, 2.00),
(62, 'Carpentry', 'test upload', 'asdasdasdasdasdasdasd', 'test upload', '2024-07-31', '2024-07-31', '05:52:00', '17:52:00', 'test upload', NULL, 'project_based', 3444, 0, 95, NULL, 0, 'open', '2024-07-31 01:53:42', '2024-07-31 01:53:42', 1, 1.00, 2.00),
(63, 'Carpentry', 'test upload', 'test upload', 'test upload', '2024-07-31', '2024-07-31', '05:55:00', '17:55:00', 'test upload', NULL, 'project_based', 3444, 0, 95, NULL, 0, 'open', '2024-07-31 01:55:23', '2024-07-31 01:55:23', 1, 1.00, 2.00),
(64, 'Carpentry', 'test', 'test', 'test upload', '2024-07-31', '2024-07-31', '05:58:00', '17:58:00', 'test upload', NULL, 'project_based', 3444, 2, 95, NULL, 0, 'open', '2024-07-31 01:58:08', '2024-07-31 05:50:46', 1, 1.00, 2.00),
(65, 'Carpentry', '1 test upload', '1 test upload', '1 test upload', '2024-07-31', '2024-07-31', '05:59:00', '17:59:00', '1 test upload', NULL, 'project_based', 5, 3, 95, 98, 0, 'in_progress', '2024-07-31 01:59:58', '2024-07-31 21:39:10', 1, 123.00, 222.00),
(66, 'Plumbing', 'Pump Installation', 'Pump Installation', 'Pump Installation', '2024-08-01', '2024-08-01', '02:45:00', '14:45:00', 'Pump Installation', NULL, 'hourly_rate', 5, 2, 95, 86, 0, 'in_progress', '2024-07-31 22:46:07', '2024-07-31 23:25:20', 1, 23.00, 56.00),
(68, 'Carpentry', 'Custom Bookshelf Installation', 'rrtfdgfd', '123 Rizal Street, Bacolod City, Negros Occidental', '2024-08-01', '2024-08-01', '06:10:00', '18:10:00', 'Carpentry, Custom Shelving, Installation', NULL, 'project_based', 40, 1, 103, NULL, 0, 'open', '2024-08-01 02:11:30', '2024-08-02 00:19:26', 1, 5000.00, 10000.00),
(74, 'Carpentry', 'test fixed', 'test fixed', 'test fixed', '2024-08-01', '2024-08-01', '09:10:00', '21:10:00', 'test fixed', NULL, 'project_based', 5, 1, 103, NULL, 0, 'open', '2024-08-01 05:10:32', '2024-08-06 21:42:44', 1, NULL, 100.00),
(75, 'Carpentry', 'Schedule Blocking 1', 'Schedule Blocking 1', 'Schedule Blocking 1', '2024-08-03', '2024-08-03', '02:52:00', '14:52:00', 'Schedule Blocking 1', NULL, 'hourly_rate', 3, 1, 95, 98, 0, 'completed', '2024-08-01 22:52:37', '2024-08-04 23:44:03', 1, NULL, 345.00),
(76, 'Carpentry', 'Schedule Blocking 2', 'Schedule Blocking 2', 'Schedule Blocking 2', '2024-08-03', '2024-08-03', '02:52:00', '14:52:00', 'Schedule Blocking 2', NULL, 'hourly_rate', 3, 1, 95, 98, 0, 'in_progress', '2024-08-01 22:53:12', '2024-08-02 09:56:27', 1, NULL, 345.00),
(77, 'Plumbing', 'Fixing a Leaking Faucet', 'I need a professional plumber to fix a leaking faucet in my kitchen. The leak is persistent and has been worsening over the past week. Additionally, I would like the plumber to check other faucets in the house for any potential issues.', 'bacolod city, forest hills', '2024-08-05', '2024-08-05', '09:07:00', '17:07:00', 'faucet repair, plumbing, leak detection', NULL, 'project_based', 2, 0, 95, 102, 1, 'open', '2024-08-05 01:08:16', '2024-08-05 01:08:16', 1, NULL, 1500.00),
(78, 'Plumbing', 'direct hire test', 'direct hire test', 'direct hire test', '2024-08-06', '2024-08-08', '09:18:00', '21:18:00', 'direct hire test', NULL, 'project_based', 6, 0, 103, 86, 1, 'open', '2024-08-05 05:19:00', '2024-08-05 05:19:00', 1, NULL, 234.00),
(79, 'Plumbing', 'zx', 'zx', 'zx', '2024-08-06', '2024-08-08', '09:42:00', '21:42:00', 'zx', NULL, 'project_based', 1, 0, 103, NULL, 0, 'open', '2024-08-05 05:43:06', '2024-08-05 05:43:06', 1, NULL, 34.00),
(81, 'Plumbing', 'Water Heater Repair', 'I need an experienced plumber to diagnose and repair my water heater.', 'Gatuslao Street, Bacolod City', '2024-08-06', '2024-08-16', '10:42:00', '22:42:00', 'water heater repair, plumbing diagnostics, safety check', NULL, 'hourly_rate', 3, 0, 103, NULL, 0, 'open', '2024-08-05 19:00:55', '2024-08-05 19:00:55', 1, NULL, 150.00),
(82, 'Plumbing', 'Water Heater Repair', 'need someone to repair heater', 'Gatuslao Street, Bacolod City', '2024-08-07', '2024-08-07', '09:12:00', '23:12:00', 'water heater repair, plumbing diagnostics, safety check', NULL, 'hourly_rate', 3, 2, 110, 102, 0, 'completed', '2024-08-06 01:14:53', '2024-08-06 01:36:22', 1, NULL, 80.00),
(83, 'Carpentry', 'Create a Wooden Bench', 'Create a wooden bench for the garden', 'Bacolod City', '2024-08-09', '2024-08-09', '09:52:00', '17:52:00', NULL, NULL, 'project_based', 3, 2, 116, 109, 0, 'in_progress', '2024-08-07 21:52:31', '2024-08-08 00:22:18', 1, NULL, 1500.00),
(85, 'Plumbing', 'Bathroom Sink Installation', 'Install bathroom sink into our bathroom', '876 Coconut Drive, Barangay Pahanocoy, Bacolod City', '2024-08-10', '2024-08-10', '02:39:00', '14:39:00', NULL, NULL, 'project_based', 5, 0, 116, 102, 1, 'open', '2024-08-07 22:40:15', '2024-08-07 22:40:15', 1, NULL, 1500.00),
(86, 'Carpentry', 'repair door frames', 'repaire my door frames', 'Example Location', '2024-08-09', '2024-08-09', '03:25:00', '15:25:00', NULL, NULL, 'project_based', 3, 1, 116, 109, 1, 'completed', '2024-08-07 23:25:39', '2024-08-08 00:15:40', 1, NULL, 56.00),
(87, 'Carpentry', 'Assemble Furniture', 'Assemble a new dining table and chairs.', 'Gatuslao Street, Bacolod City', '2024-08-09', '2024-08-09', '05:11:00', '17:11:00', NULL, NULL, 'project_based', 44, 0, 116, NULL, 0, 'open', '2024-08-08 01:11:56', '2024-08-08 01:11:56', 1, NULL, 56.00),
(88, 'Carpentry', 'Repair Drywall', 'Repair drywall in the living room.', 'bacolod city, forest hills', '2024-08-10', '2024-08-10', '21:16:00', '12:16:00', NULL, NULL, 'hourly_rate', 6, 1, 116, 109, 0, 'in_progress', '2024-08-08 01:20:38', '2024-08-08 01:24:34', 1, 80.00, 100.00),
(89, 'Carpentry', 'Agency Test', 'Agency Test', 'Agency Test', '2024-08-21', '2024-08-21', '08:25:00', '20:25:00', NULL, 'male', 'project_based', 3, 1, 95, 1, 0, 'in_progress', '2024-08-21 04:26:18', '2024-08-26 22:15:40', 1, 123.00, 677.00),
(90, 'Carpentry', 'Agency Test', 'asdas', 'Agency Test', '2024-08-21', '2024-08-21', '08:27:00', '20:27:00', NULL, 'male', 'hourly_rate', 3, 9, 95, NULL, 0, 'in_progress', '2024-08-21 04:28:24', '2024-08-26 08:28:24', 1, 123.00, 677.00),
(91, 'Welding', 'agency user channel test', 'agency user channel test', 'agency user channel test', '2024-08-28', '2024-08-28', '00:54:00', '12:54:00', NULL, NULL, 'hourly_rate', 3, 1, 95, NULL, 0, 'in_progress', '2024-08-27 08:54:46', '2024-08-27 08:57:12', 1, 1.00, 2.00),
(92, 'Hairdressing', 'agency channel  test', 'agency channel  test', 'agency channel  test', '2024-08-31', '2024-08-31', '01:01:00', '13:01:00', NULL, NULL, 'hourly_rate', 2, 1, 95, 1, 0, 'in_progress', '2024-08-27 09:01:22', '2024-08-27 09:16:48', 1, 12.00, 123.00),
(93, 'Beauty Therapy', 'Channel agency test', 'agency channel  test', 'agency channel  test', '2024-08-29', '2024-08-29', '01:01:00', '13:01:00', NULL, NULL, 'hourly_rate', 2, 1, 95, 1, 0, 'in_progress', '2024-08-27 09:02:00', '2024-08-27 09:25:05', 1, 123.00, 123.00),
(94, 'Gardening', 'Sample Request 1', 'This is a sample description for request 1.', '789 Maple Ave, Newtown, USA', '2024-09-06', '2024-09-12', '21:40:07', '01:40:07', 'example', 'female', 'project_based', 4, 0, 77, NULL, 0, 'open', '2024-08-27 09:40:07', '2024-08-27 09:40:07', 0, 114.00, 0.00),
(95, 'Cleaning', 'Sample Request 2', 'This is a sample description for request 2.', '123 Main St, Anytown, USA', '2024-09-06', '2024-09-13', '18:40:08', '01:40:08', 'example', 'male', 'project_based', 1, 0, 90, NULL, 0, 'cancelled', '2024-08-27 09:40:08', '2024-08-27 09:40:08', 0, 149.00, 0.00),
(96, 'Electrical', 'Sample Request 1', 'This is a sample description for request 1.', '456 Elm St, Othertown, USA', '2024-09-05', '2024-09-16', '21:42:36', '03:42:36', 'example', NULL, 'project_based', 2, 0, 76, NULL, 0, 'open', '2024-08-27 09:42:36', '2024-08-27 09:42:36', 0, 100.00, 0.00),
(97, 'Carpentry', 'Sample Request 2', 'This is a sample description for request 2.', '456 Elm St, Othertown, USA', '2024-08-28', '2024-09-11', '22:42:36', '23:42:36', 'example', 'female', 'project_based', 2, 0, 90, NULL, 0, 'completed', '2024-08-27 09:42:36', '2024-08-27 09:42:36', 0, 72.00, 0.00),
(98, 'Carpentry', 'Sample Request 3', 'This is a sample description for request 3.', '123 Main St, Anytown, USA', '2024-09-02', '2024-09-09', '22:42:36', '23:42:36', 'example', 'male', 'hourly_rate', 3, 0, 99, NULL, 0, 'open', '2024-08-27 09:42:36', '2024-08-27 09:42:36', 0, 91.00, 0.00),
(99, 'Plumbing', 'Sample Request 4', 'This is a sample description for request 4.', '123 Main St, Anytown, USA', '2024-09-04', '2024-09-08', '18:42:36', '23:42:36', 'example', NULL, 'hourly_rate', 3, 0, 112, NULL, 0, 'open', '2024-08-27 09:42:36', '2024-08-27 09:42:36', 0, 149.00, 0.00),
(100, 'Gardening', 'Sample Request 5', 'This is a sample description for request 5.', '789 Maple Ave, Newtown, USA', '2024-08-30', '2024-09-07', '18:42:36', '01:42:36', 'example', 'female', 'hourly_rate', 1, 0, 80, NULL, 0, 'in_progress', '2024-08-27 09:42:36', '2024-08-27 09:42:36', 0, 61.00, 0.00),
(101, 'Cleaning', 'Sample Request 6', 'This is a sample description for request 6.', '789 Maple Ave, Newtown, USA', '2024-08-31', '2024-09-10', '18:42:37', '02:42:37', 'example', 'female', 'hourly_rate', 2, 0, 96, NULL, 0, 'in_progress', '2024-08-27 09:42:37', '2024-08-27 09:42:37', 0, 57.00, 0.00),
(102, 'Carpentry', 'Sample Request 7', 'This is a sample description for request 7.', '123 Main St, Anytown, USA', '2024-09-05', '2024-09-15', '19:42:37', '02:42:37', 'example', 'male', 'project_based', 4, 0, 80, NULL, 0, 'cancelled', '2024-08-27 09:42:37', '2024-08-27 09:42:37', 0, 102.00, 0.00),
(103, 'Plumbing', 'Sample Request 8', 'This is a sample description for request 8.', '789 Maple Ave, Newtown, USA', '2024-08-31', '2024-09-14', '22:42:37', '23:42:37', 'example', 'male', 'project_based', 3, 0, 80, NULL, 0, 'in_progress', '2024-08-27 09:42:37', '2024-08-27 09:42:37', 0, 77.00, 0.00),
(104, 'Electrical', 'Sample Request 9', 'This is a sample description for request 9.', '456 Elm St, Othertown, USA', '2024-08-29', '2024-09-14', '22:42:37', '02:42:37', 'example', 'female', 'project_based', 3, 0, 105, NULL, 0, 'completed', '2024-08-27 09:42:37', '2024-08-27 09:42:37', 0, 95.00, 0.00),
(105, 'Electrical', 'Sample Request 10', 'This is a sample description for request 10.', '123 Main St, Anytown, USA', '2024-09-05', '2024-09-12', '21:42:37', '00:42:37', 'example', 'female', 'hourly_rate', 3, 0, 86, NULL, 0, 'cancelled', '2024-08-27 09:42:37', '2024-08-27 09:42:37', 0, 142.00, 0.00),
(106, 'Gardening', 'Sample Request 11', 'This is a sample description for request 11.', '123 Main St, Anytown, USA', '2024-09-05', '2024-09-09', '20:42:37', '00:42:37', 'example', 'male', 'hourly_rate', 3, 0, 72, NULL, 0, 'in_progress', '2024-08-27 09:42:37', '2024-08-27 09:42:37', 0, 69.00, 0.00),
(107, 'Gardening', 'Sample Request 12', 'This is a sample description for request 12.', '123 Main St, Anytown, USA', '2024-09-04', '2024-09-14', '18:42:37', '23:42:37', 'example', NULL, 'project_based', 4, 0, 80, NULL, 0, 'cancelled', '2024-08-27 09:42:37', '2024-08-27 09:42:37', 0, 134.00, 0.00),
(108, 'Cleaning', 'Sample Request 13', 'This is a sample description for request 13.', '789 Maple Ave, Newtown, USA', '2024-09-06', '2024-09-13', '22:42:37', '02:42:37', 'example', NULL, 'project_based', 3, 0, 77, NULL, 0, 'cancelled', '2024-08-27 09:42:37', '2024-08-27 09:42:37', 0, 138.00, 0.00),
(109, 'Plumbing', 'Sample Request 14', 'This is a sample description for request 14.', '456 Elm St, Othertown, USA', '2024-09-02', '2024-09-10', '19:42:37', '23:42:37', 'example', 'female', 'project_based', 2, 0, 73, NULL, 0, 'cancelled', '2024-08-27 09:42:37', '2024-08-27 09:42:37', 0, 65.00, 0.00),
(110, 'Electrical', 'Sample Request 15', 'This is a sample description for request 15.', '123 Main St, Anytown, USA', '2024-09-03', '2024-09-09', '18:42:37', '00:42:37', 'example', 'female', 'hourly_rate', 2, 0, 112, NULL, 0, 'cancelled', '2024-08-27 09:42:37', '2024-08-27 09:42:37', 0, 107.00, 0.00),
(111, 'Cleaning', 'Sample Request 16', 'This is a sample description for request 16.', '123 Main St, Anytown, USA', '2024-08-30', '2024-09-11', '18:42:37', '02:42:37', 'example', 'female', 'project_based', 3, 0, 85, NULL, 0, 'cancelled', '2024-08-27 09:42:37', '2024-08-27 09:42:37', 0, 107.00, 0.00),
(112, 'Electrical', 'Sample Request 17', 'This is a sample description for request 17.', '789 Maple Ave, Newtown, USA', '2024-08-30', '2024-09-08', '22:42:37', '01:42:37', 'example', 'male', 'hourly_rate', 1, 0, 102, NULL, 0, 'cancelled', '2024-08-27 09:42:37', '2024-08-27 09:42:37', 0, 102.00, 0.00),
(113, 'Carpentry', 'Sample Request 18', 'This is a sample description for request 18.', '789 Maple Ave, Newtown, USA', '2024-09-01', '2024-09-10', '21:42:37', '00:42:37', 'example', 'male', 'hourly_rate', 2, 0, 115, NULL, 0, 'in_progress', '2024-08-27 09:42:37', '2024-08-27 09:42:37', 0, 129.00, 0.00),
(114, 'Carpentry', 'Sample Request 19', 'This is a sample description for request 19.', '456 Elm St, Othertown, USA', '2024-09-03', '2024-09-12', '20:42:38', '23:42:38', 'example', NULL, 'hourly_rate', 2, 0, 73, NULL, 0, 'cancelled', '2024-08-27 09:42:38', '2024-08-27 09:42:38', 0, 77.00, 0.00),
(115, 'Carpentry', 'Sample Request 20', 'This is a sample description for request 20.', '789 Maple Ave, Newtown, USA', '2024-08-31', '2024-09-10', '19:42:38', '00:42:38', 'example', 'female', 'project_based', 2, 0, 93, NULL, 0, 'in_progress', '2024-08-27 09:42:38', '2024-08-27 09:42:38', 0, 54.00, 0.00),
(116, 'Plumbing', 'Sample Request 1', 'This is a sample description for request 1.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:20', '19:46:20', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:20', '2024-08-27 09:46:20', 0, 0.00, 0.00),
(117, 'Plumbing', 'Sample Request 2', 'This is a sample description for request 2.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:20', '19:46:20', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:20', '2024-08-27 09:46:20', 0, 0.00, 0.00),
(118, 'Plumbing', 'Sample Request 3', 'This is a sample description for request 3.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:21', '19:46:21', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:21', '2024-08-27 09:46:21', 0, 0.00, 0.00),
(119, 'Plumbing', 'Sample Request 4', 'This is a sample description for request 4.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:21', '19:46:21', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:21', '2024-08-27 09:46:21', 0, 0.00, 0.00),
(120, 'Plumbing', 'Sample Request 5', 'This is a sample description for request 5.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:21', '19:46:21', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:21', '2024-08-27 09:46:21', 0, 0.00, 0.00),
(121, 'Plumbing', 'Sample Request 6', 'This is a sample description for request 6.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:21', '19:46:21', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:21', '2024-08-27 09:46:21', 0, 0.00, 0.00),
(122, 'Plumbing', 'Sample Request 7', 'This is a sample description for request 7.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:21', '19:46:21', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:21', '2024-08-27 09:46:21', 0, 0.00, 0.00),
(123, 'Plumbing', 'Sample Request 8', 'This is a sample description for request 8.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:21', '19:46:21', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:21', '2024-08-27 09:46:21', 0, 0.00, 0.00),
(124, 'Plumbing', 'Sample Request 9', 'This is a sample description for request 9.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:21', '19:46:21', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:21', '2024-08-27 09:46:21', 0, 0.00, 0.00),
(125, 'Plumbing', 'Sample Request 10', 'This is a sample description for request 10.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:21', '19:46:21', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:21', '2024-08-27 09:46:21', 0, 0.00, 0.00),
(126, 'Plumbing', 'Sample Request 11', 'This is a sample description for request 11.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:21', '19:46:21', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:21', '2024-08-27 09:46:21', 0, 0.00, 0.00),
(127, 'Plumbing', 'Sample Request 12', 'This is a sample description for request 12.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:21', '19:46:21', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:21', '2024-08-27 09:46:21', 0, 0.00, 0.00),
(128, 'Plumbing', 'Sample Request 13', 'This is a sample description for request 13.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:21', '19:46:21', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:21', '2024-08-27 09:46:21', 0, 0.00, 0.00),
(129, 'Plumbing', 'Sample Request 14', 'This is a sample description for request 14.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:21', '19:46:21', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:21', '2024-08-27 09:46:21', 0, 0.00, 0.00),
(130, 'Plumbing', 'Sample Request 15', 'This is a sample description for request 15.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:22', '19:46:22', 'example', 'female', 'hourly_rate', 2, 0, 95, NULL, 0, 'open', '2024-08-27 09:46:22', '2024-08-27 09:46:22', 0, 0.00, 0.00),
(131, 'Plumbing', 'Sample Request 16', 'This is a sample description for request 16.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:22', '19:46:22', 'example', 'female', 'hourly_rate', 2, 1, 95, 1, 0, 'in_progress', '2024-08-27 09:46:22', '2024-08-27 22:00:22', 0, 0.00, 0.00),
(132, 'Plumbing', 'Sample Request 17', 'This is a sample description for request 17.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:22', '19:46:22', 'example', 'female', 'hourly_rate', 2, 1, 95, 1, 0, 'in_progress', '2024-08-27 09:46:22', '2024-08-27 19:42:58', 0, 0.00, 0.00),
(133, 'Plumbing', 'Sample Request 18', 'This is a sample description for request 18.', '123 Example St', '2024-08-27', '2024-09-06', '17:46:22', '19:46:22', 'example', 'female', 'hourly_rate', 2, 3, 95, 1, 0, 'in_progress', '2024-08-27 09:46:22', '2024-08-27 19:33:57', 0, 0.00, 0.00);

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
(24, 76, 'service_requests/documents/PxoG1RtpWKCCoLMHAV4I7OBjzdWH9ShgjpmQQKk3.jpg', '2024-08-01 22:53:12', '2024-08-01 22:53:12'),
(25, 77, 'service_requests/documents/yWMm9DFKdvet9NTXzxE3Onvx8gnGi2SIOgf6sxig.webp', '2024-08-05 01:08:16', '2024-08-05 01:08:16'),
(26, 78, 'service_requests/documents/d36UKzykNSLeYGNr0ldAk4mxIJI790A457jKPN3d.jpg', '2024-08-05 05:19:01', '2024-08-05 05:19:01'),
(27, 79, 'service_requests/documents/oBNrpofgfXllTxZarvAQl5Xn2Wfj26rFD3y1GAVQ.jpg', '2024-08-05 05:43:06', '2024-08-05 05:43:06'),
(28, 79, 'service_requests/documents/YEqPBwzq0h9tWtxiP5AdNEJahxIho51Jd5jzVVbF.jpg', '2024-08-05 05:43:06', '2024-08-05 05:43:06'),
(31, 81, 'service_requests/documents/hpbF6Bkxq5timADJT4sxDjtNo8NdaI6Vce2nRN33.jpg', '2024-08-05 19:00:55', '2024-08-05 19:00:55'),
(32, 81, 'service_requests/documents/hlvfIndhdprkoRsq9b7k38cidErzkk5EuJWfelsR.jpg', '2024-08-05 19:00:55', '2024-08-05 19:00:55'),
(33, 82, 'service_requests/documents/jD1lbBMxZ63uhvVeMMnmeM2YlR6oXNaHOwXghTq1.jpg', '2024-08-06 01:14:54', '2024-08-06 01:14:54'),
(34, 82, 'service_requests/documents/h6SVJL5le5pQTzOG19LDzFoGKYsTe03N5oTXttF2.jpg', '2024-08-06 01:14:54', '2024-08-06 01:14:54'),
(35, 82, 'service_requests/documents/nmSyfXcoZpD47BmraokOszA4ofLALIZypASsh1PE.jpg', '2024-08-06 01:14:54', '2024-08-06 01:14:54'),
(36, 83, 'service_requests/documents/OPJwoorcVzmoFbIk2n2iADKYgYmOrvx1uqzp714T.jpg', '2024-08-07 21:52:33', '2024-08-07 21:52:33'),
(38, 85, 'service_requests/documents/wcfYkEYi2GxsblvT1wYQixuO7Qc5RCrAowmUErtL.webp', '2024-08-07 22:40:16', '2024-08-07 22:40:16'),
(39, 86, 'service_requests/documents/cIib8tGSYuTCyk83GAYRiiUBgZ9XwurXV6qHOvjw.jpg', '2024-08-07 23:25:40', '2024-08-07 23:25:40'),
(40, 87, 'service_requests/documents/ePcGYOI7N0S2EpS8p79LH2V7zCrfBIWWQUQ0z5qj.jpg', '2024-08-08 01:11:57', '2024-08-08 01:11:57'),
(41, 88, 'service_requests/documents/n0NWjKvSs0mdoCgGl1tJoNfl267SMY02v34Wgmeg.jpg', '2024-08-08 01:20:38', '2024-08-08 01:20:38'),
(42, 89, 'service_requests/documents/0ZOWLJFL5mZA3QByoaYwCRuXeLsKv3x5WhWtKrfu.png', '2024-08-21 04:26:19', '2024-08-21 04:26:19'),
(43, 90, 'service_requests/documents/ZjKg42FC02eNZWvuSJ9IbLb090tzJpLsCiTQ5G2h.png', '2024-08-21 04:28:24', '2024-08-21 04:28:24'),
(44, 91, 'service_requests/documents/c9Fptpjj2dySmTbR8XM1hY07iSEGdCbh3gNGeUDa.png', '2024-08-27 08:54:47', '2024-08-27 08:54:47'),
(45, 92, 'service_requests/documents/v0JM4qlluCqdvLY83RP1rLTny6f1biB1GnwxiyAR.png', '2024-08-27 09:01:22', '2024-08-27 09:01:22'),
(46, 93, 'service_requests/documents/53CEN08JuTwO7zSjvPWAYkn27Vq0c9wib7NLeN0c.png', '2024-08-27 09:02:01', '2024-08-27 09:02:01');

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
('1WavHvkqNhwi7VenJ2uWsG7cRmBU0KeiMRDoYDCJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNll5QW9RY1BTY2luVHNwbmVJVlFxdnhmbGpjYkMzUjgxczI5ZVZ2bSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2NoYW5uZWwvc2Vla2VyLzEzMSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1724855920),
('64aEDUL6s8nV0MteLsKPN2LHEyGIQF15d4mCuemo', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoib09PQ0J1a0dYQmJwakFBM05QQVVZSDRneXB4TjdjMFB6T2dYY3dGcyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FnZW5jeS9iaWRzL2NyZWF0ZS8xMzEiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FnZW5jeS9hZ2VuY3ktY2hhbm5lbC8xMzEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU5OiJsb2dpbl9hZ2VuY3lfdXNlcnNfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1724828248),
('AWna1IhB5R6kIjWyMHu3EKzdlAf9fkFt3sZ4JJUs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZExWTVJRSzJrZG9JVzM2UG9CZllnTEZyQ1RnVmVQdzdJd1paRHMxYiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FnZW5jeS9hZ2VuY3ktY2hhbm5lbC8xMzEiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1724855919),
('gOCHfyZngB1yUzuXc4CKvf8wrw8FkZOtxR5mJtir', 95, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQXlQTm9jdXNNTFNtU2RlazRuZEtPcllycVc2d2kxU2hsQmlGVE1udSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvY2hhbm5lbC9zZWVrZXIvMTMxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6OTU7fQ==', 1724828250),
('hJjMnFbo0hNQ4l4TVVyIW9LQe6QYcxNoIY4ZEwer', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibFBjTWlmTDBuQzB4UUJFUnJpMkJmd2NISDVEMzVUd1F2Z1dZWWZqaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hZ2VuY2llcyI7fXM6NTc6ImxvZ2luX2FkbWluX3VzZXJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1725066011),
('i9zlGP9MkaAdc2ooDcghCOu4fKJUVGsqt4y4mYwl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUE3c2NleGtIcHlLdDRLUGFIbTdPZk5HQzdLQ0NMWExNZEV2TWdaSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1724917678),
('Nl1D5hLwLG5a9mY1CjybwmZSgRfKrHPbJKICqEVx', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieVhMc3F2ZmtSZFNyc29ybmNIUmg1Wll0T25qSkQxNzVvVkdWaHFkeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZ2VuY3kvaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTk6ImxvZ2luX2FnZW5jeV91c2Vyc181OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1725065576),
('rYJVvQTh7hgK5whAnE5cauQ6nAHjXH45o4wgIUO1', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidGpGUUxvak9qWk9ldHM5ZVFOUkJnQk9xQ3lkcGpOcklwTThzSmdxciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZ2VuY3kvcHJvdmlkZXIvZmlsdGVyLXJlcXVlc3RzP2ZpbHRlcj1pbl9wcm9ncmVzcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTk6ImxvZ2luX2FnZW5jeV91c2Vyc181OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1724917769),
('wEFLjmYdCFFFiGbthpflYittRERdT8vunPW9Dg34', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 OPR/109.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV3hDdVdkZDNsOXhNejJjWDJGVEdtRVpVR2U2ZktoMWFScEZHc3R3TCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1725065713);

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
(102, 'Luis Navarro', 'luis.navarro@example.com', '639991090123', NULL, '$2y$12$O25zNnHMcaHb4RHBfIjg4.Y8uXWtiTufYxXc8S8CREKv5q0hJunXm', NULL, '2024-07-27 21:04:24', '2024-07-27 21:04:35', '1992-11-22', 'Brgy. Vista Alegre, Bacolod City', 'Male', 2),
(103, 'Mark Bautista', 'mark.bautista@example.com', '639123456793', NULL, '$2y$12$T01zDbsfLRpKfbEYzzaK6ecrbkViMYGh/kDaQXPRDstG3fp2G7Cwm', NULL, '2024-07-31 06:26:32', '2024-07-31 06:26:46', '1991-05-12', 'mark.bautista@example.com', 'Male', 3),
(104, 'Liza Mendoza', 'liza.mendoza@example.com', '639123456794', NULL, '$2y$12$mPuGd3h84Mjo2//HNdwcPut9ohiMp6eoMkW0KqtSXpCgqW9UCXJVa', NULL, '2024-07-31 06:28:03', '2024-07-31 06:28:34', '1993-06-25', '987 Alijis St., Bacolod City', 'Female', 3),
(105, 'Carlos Cruz', 'carlos.cruz@example.com', '639123456795', NULL, '$2y$12$C0/UF3Pkf0YqTxO3NbK7uuEnedpbwtOOFVBiS2L5SFXdJbbG3Xivq', NULL, '2024-07-31 06:30:25', '2024-07-31 06:30:33', '1989-07-30', '135 Arevalo St., Bacolod City', 'Male', 3),
(106, 'Sofia Torres', 'sofia.torres@example.com', '639123456796', NULL, '$2y$12$XsBh85next8X6UpeNvAPxOjr7HEflJ/X6oEd4aZCcpc4gjKj0JWHK', NULL, '2024-07-31 06:32:53', '2024-07-31 06:32:59', '1988-07-30', '246 Villanueva St., Bacolod City', 'Female', 3),
(108, 'Grace Villanueva', 'grace.villanueva@example.com', '639123456798', NULL, '$2y$12$NrCJsE2M2.sx9WmkAsfsYO4WrVFY2eJvIzfAxzsWUzI9NgIVTxr8.', NULL, '2024-07-31 06:35:14', '2024-07-31 06:35:14', '1988-08-24', NULL, 'Female', 3),
(109, 'Geralt Of Rivia', 'geralt@example.com', '63999109114', NULL, '$2y$12$GU638vrK3xCuqR.eTUSdkOgPBBXBlJ6pSYEc.Fu4/VEbdx2lYtmwe', NULL, '2024-08-01 06:08:58', '2024-08-01 06:09:04', '1939-09-16', '123 Rizal Street, Barangay Villamonte, Bacolod City, Philippines', 'Male', 2),
(110, 'Jerel Paligumba', 'jerel@example.com', '639991091104', NULL, '$2y$12$KOKu6NW1C8sf4LcCQc8Q4OHFTFOetuIB99AUWZQYjGyF6KtAfMCHu', NULL, '2024-08-06 01:09:09', '2024-08-06 01:09:19', '2000-01-09', '123 Rizal Street, Barangay Villamonte, Bacolod City, Philippines', 'Male', 3),
(111, 'Juan Reyes', 'juan.reyes@example.com', '6391234567', NULL, '$2y$12$jc0Sd0MkZfRtQEUv37iCUOKTHmbYz6XCiyiVxQaFg2W8IhRjOdbhq', NULL, '2024-08-07 08:32:33', '2024-08-07 08:32:37', '1991-05-12', '123 Rizal Street, Barangay Villamonte, Bacolod City, Philippines', 'Male', 2),
(112, 'Ben Mendoza', 'benmendoza@example.com', '6363927012', NULL, '$2y$12$DXknPjYxOly0n8Edkivsq.0y5L2BzXgqhr3TzWqSVOJPmRwE0vEfy', NULL, '2024-08-07 21:16:35', '2024-08-07 21:16:35', '1990-09-18', '468 6th St, Bacolod City', 'Male', 2),
(113, 'Paul Ramos', 'paul.ramos@example.com', '6392690123', NULL, '$2y$12$azxi.kEyTFgJBB4exIxgI.qZaSqq12ZxDTISGm0bS3.GkiL2.XmTO', NULL, '2024-08-07 21:28:39', '2024-08-07 21:28:39', '1987-07-20', '680 8th St, Bacolod City', 'Male', 2),
(114, 'Kristian Franco', 'kristianfranco@example.com', '6393367890', NULL, '$2y$12$BoPnkIo5kvEvseJwMaetYeOAhSe69.OYlVyEdaGX724q09OFdLu7G', NULL, '2024-08-07 21:30:26', '2024-08-07 21:30:26', '2002-09-17', 'La Carlota', 'Male', 2),
(115, 'Steven Delfin', 'stevendelfin@email.com', '6391234567', NULL, '$2y$12$GNflcFtW95Dem41cHoGkg.O92Xci5BYJ2I7msMzncwtiYISz7mrR.', NULL, '2024-08-07 21:31:38', '2024-08-07 21:31:38', '1991-05-12', 'stevendelfin@email.com', 'Male', 3),
(116, 'Meu Salmon', 'meusalmon@example.com', '6391234567', NULL, '$2y$12$iQlw8PKKZkzIGxGCZLkz9uM4c5KHorImO00FY6yND6BvNeEeY88uS', NULL, '2024-08-07 21:32:41', '2024-08-07 21:32:41', '2003-07-16', '456 Mabini Street, Barangay Mansilingan, Bacolod City, Philippines', 'Male', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_email_unique` (`email`);

--
-- Indexes for table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agencies_email_unique` (`email`);

--
-- Indexes for table `agency_services`
--
ALTER TABLE `agency_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agency_services_agency_id_foreign` (`agency_id`),
  ADD KEY `agency_services_created_by_foreign` (`created_by`);

--
-- Indexes for table `agency_updates`
--
ALTER TABLE `agency_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agency_updates_agency_id_foreign` (`agency_id`),
  ADD KEY `agency_updates_submitted_by_foreign` (`submitted_by`),
  ADD KEY `agency_updates_reviewed_by_foreign` (`reviewed_by`);

--
-- Indexes for table `agency_users`
--
ALTER TABLE `agency_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agency_users_email_unique` (`email`),
  ADD KEY `agency_users_agency_id_foreign` (`agency_id`);

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
  ADD KEY `service_request_id` (`service_request_id`),
  ADD KEY `bid_id` (`bid_id`),
  ADD KEY `channel_ibfk_provider` (`provider_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_channel_id_created_at_index` (`channel_id`,`created_at`),
  ADD KEY `chats_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_agency` (`agency_id`);

--
-- Indexes for table `employee_service_assignments`
--
ALTER TABLE `employee_service_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_service_assignments_employee_id_foreign` (`employee_id`),
  ADD KEY `employee_service_assignments_service_id_foreign` (`service_id`);

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
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agencies`
--
ALTER TABLE `agencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `agency_services`
--
ALTER TABLE `agency_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agency_updates`
--
ALTER TABLE `agency_updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agency_users`
--
ALTER TABLE `agency_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `employee_service_assignments`
--
ALTER TABLE `employee_service_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `philid_cards`
--
ALTER TABLE `philid_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `provider_details`
--
ALTER TABLE `provider_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `psa_jobs`
--
ALTER TABLE `psa_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `request_lists`
--
ALTER TABLE `request_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `service_request_images`
--
ALTER TABLE `service_request_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agency_services`
--
ALTER TABLE `agency_services`
  ADD CONSTRAINT `agency_services_agency_id_foreign` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agency_services_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `agency_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `agency_updates`
--
ALTER TABLE `agency_updates`
  ADD CONSTRAINT `agency_updates_agency_id_foreign` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agency_updates_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `admin_users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `agency_updates_submitted_by_foreign` FOREIGN KEY (`submitted_by`) REFERENCES `agency_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `agency_users`
--
ALTER TABLE `agency_users`
  ADD CONSTRAINT `agency_users_agency_id_foreign` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `channel_ibfk_3` FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` (`id`),
  ADD CONSTRAINT `channel_ibfk_4` FOREIGN KEY (`bid_id`) REFERENCES `bid` (`id`),
  ADD CONSTRAINT `channel_ibfk_provider` FOREIGN KEY (`provider_id`) REFERENCES `agency_users` (`id`);

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_agency` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_service_assignments`
--
ALTER TABLE `employee_service_assignments`
  ADD CONSTRAINT `employee_service_assignments_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employee_service_assignments_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `agency_services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `philid_cards`
--
ALTER TABLE `philid_cards`
  ADD CONSTRAINT `philid_cards_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`);

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
