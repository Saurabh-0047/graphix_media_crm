-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2024 at 06:48 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `graphix_media_crm`
--

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_08_07_055114_create_tb_admin_table', 1),
(6, '2024_08_07_055427_create_tb_users', 2),
(7, '2024_08_07_063335_create_tb_user_designations', 3),
(8, '2024_08_08_064707_create_tb_projects', 4),
(9, '2024_08_08_131553_create_tb_project_services', 5),
(10, '2024_08_09_115524_create_tb_notifications', 6),
(11, '2024_08_09_134752_create_tb_project_messages', 7),
(12, '2024_08_20_113948_create_tb_project_assignments', 8),
(13, '2024_08_20_203119_create_tb_modules', 9);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `user_name`, `user_id`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Nishant Kumar', 'gm_admin', '$2y$10$0BFFQWvlYSqa9OYywAHcaem1Ejy2dtPj0jWCvuuT6DhybxaqpFxcW', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_modules`
--

CREATE TABLE `tb_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_heading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_modules`
--

INSERT INTO `tb_modules` (`id`, `project_id`, `module_heading`, `module_description`, `module_status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '4', 'Front End', 'Full Fnction Front end', 'Completed', '2', '2024-08-20 15:16:45', '2024-08-20 16:35:18'),
(2, '4', 'Backend', 'Full Function Backend', 'Accepted', '2', '2024-08-20 15:16:45', '2024-08-20 16:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifications`
--

CREATE TABLE `tb_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unread_by` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_by` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_notifications`
--

INSERT INTO `tb_notifications` (`id`, `heading`, `message`, `project_id`, `unread_by`, `read_by`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Project Assigned', 'New Project Assigned To You By Admin', '1', '[\"0001\"]', '[\"sk001\"]', NULL, '2024-08-20 07:02:36', '2024-08-20 07:21:50'),
(2, 'New Message', 'Saurabh Sent A Message', '1', '[\"0001\"]', '[\"sk001\",\"gm_admin\"]', NULL, '2024-08-20 07:11:41', '2024-08-20 08:20:20'),
(3, 'New Message', 'Nishant Kumar Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 08:29:04', '2024-08-20 12:37:56'),
(4, 'New Message', 'Nishant Kumar Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 08:41:47', '2024-08-20 12:37:56'),
(5, 'New Message', 'Nishant Kumar Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 08:46:26', '2024-08-20 12:37:56'),
(6, 'New Message', 'Nishant Kumar Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 08:46:33', '2024-08-20 12:37:56'),
(7, 'New Message', 'Nishant Kumar Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 10:31:19', '2024-08-20 12:37:56'),
(8, 'New Message', 'Saurabh Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 10:36:52', '2024-08-20 12:37:56'),
(9, 'New Message', 'Nishant Kumar Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 10:37:15', '2024-08-20 12:37:56'),
(10, 'New Message', 'Saurabh Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 10:39:19', '2024-08-20 12:37:56'),
(11, 'New Message', 'Saurabh Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 10:40:13', '2024-08-20 12:37:56'),
(12, 'New Message', 'Saurabh Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 12:19:05', '2024-08-20 12:37:56'),
(13, 'New Message', 'Saurabh Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 12:19:34', '2024-08-20 12:37:56'),
(14, 'New Message', 'Nishant Kumar Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 12:22:19', '2024-08-20 12:37:56'),
(15, 'New Message', 'Nishant Kumar Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 12:22:29', '2024-08-20 12:37:56'),
(16, 'New Message', 'Saurabh Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 12:40:17', '2024-08-20 12:44:32'),
(17, 'New Message', 'Nishant Kumar Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 12:40:22', '2024-08-20 12:44:32'),
(18, 'Project Assigned', 'New Project Assigned To You By Admin', '2', '[\"0001\",\"sweta@123456\"]', '[\"sk001\"]', NULL, '2024-08-20 12:41:30', '2024-08-20 12:44:32'),
(19, 'Project Assigned', 'New Project Assigned To You By Admin', '4', '[\"0001\"]', '[\"sk001\"]', NULL, '2024-08-20 15:16:45', '2024-08-20 15:51:32'),
(20, 'Project Assigned', 'New Project Assigned To You By Admin', '5', '[\"kaifahmed\",\"sweta@123456\"]', '[]', NULL, '2024-08-20 15:20:52', '2024-08-20 15:20:52'),
(21, 'New Message', 'Nishant Kumar Sent A Message', '1', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 15:25:42', '2024-08-20 15:51:32'),
(22, 'New Message', 'Nishant Kumar Sent A Message', '4', '[\"0001\"]', '[\"sk001\",\"gm_admin\"]', NULL, '2024-08-20 15:42:40', '2024-08-20 16:23:11'),
(23, 'New Message', 'Nishant Kumar Sent A Message', '4', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 16:23:04', '2024-08-20 16:28:42'),
(24, 'Module Accepted', 'Unknown Sender Accepted A Module', '4', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 16:28:56', '2024-08-20 16:31:17'),
(25, 'Module Accepted', 'Saurabh Accepted A Module', '4', '[\"0001\"]', '[\"sk001\",\"gm_admin\"]', NULL, '2024-08-20 16:31:24', '2024-08-20 16:36:04'),
(26, 'Module Completed', 'Saurabh Completed A Module', '4', '[\"0001\"]', '[\"sk001\",\"gm_admin\"]', NULL, '2024-08-20 16:35:18', '2024-08-20 16:36:04'),
(27, 'New Message', 'Nishant Kumar Sent A Message', '4', '[\"0001\"]', '[\"gm_admin\",\"sk001\"]', NULL, '2024-08-20 16:42:15', '2024-08-20 16:46:03'),
(28, 'New Message', 'Nishant Kumar Sent A Message', '4', '[\"0001\"]', '[\"sk001\",\"gm_admin\"]', NULL, '2024-08-20 16:43:05', '2024-08-20 16:46:11'),
(29, 'New Message', 'Saurabh Sent A Message', '4', '{\"1\":\"0001\",\"2\":\"gm_admin\"}', '[]', NULL, '2024-08-20 16:44:51', '2024-08-20 16:44:51'),
(30, 'New Message', 'Saurabh Sent A Message', '4', '{\"1\":\"0001\",\"2\":\"gm_admin\"}', '[]', NULL, '2024-08-20 16:44:54', '2024-08-20 16:44:54'),
(31, 'New Message', 'Saurabh Sent A Message', '4', '{\"1\":\"0001\",\"2\":\"gm_admin\"}', '[]', NULL, '2024-08-20 16:44:58', '2024-08-20 16:44:58'),
(32, 'New Message', 'Saurabh Sent A Message', '4', '{\"1\":\"0001\",\"2\":\"gm_admin\"}', '[]', NULL, '2024-08-20 16:46:34', '2024-08-20 16:46:34'),
(33, 'New Message', 'Nishant Kumar Sent A Message', '4', '[\"0001\"]', '[\"sk001\",\"gm_admin\"]', NULL, '2024-08-20 16:47:38', '2024-08-20 16:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_projects`
--

CREATE TABLE `tb_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `packages` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sold_by_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_to` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_projects`
--

INSERT INTO `tb_projects` (`id`, `business_name`, `client_name`, `contact_no`, `email_id`, `address`, `website`, `packages`, `remarks`, `sold_by_id`, `assigned_to`, `created_at`, `updated_at`) VALUES
(1, 'Khublal Agro Pvt Limited', 'Mr Khublal Kumar', '07903134728', 'zeyaalam301@gmail.com', 'Kadru', 'khublalagro.com', '\"Software Development,App Development,Domain,Hosting\"', 'Make A Trackin Software and Applications', '5', '\"2,4\"', '2024-08-20 07:02:36', '2024-08-20 07:02:36'),
(2, 'Steel Plant', 'new client', '07903134728', 'zeyaalam301@gmail.com', 'Kadru', 'https://graphixmedia.in/', '\"Software Development,Hosting\"', '456', '2', '\"2,4,6\"', '2024-08-20 12:41:30', '2024-08-20 12:41:30'),
(3, 'RDCIS', 'SK Kushwaha', '07903134728', 'sk37700@gmail.com', 'Kasba', 'rdcis.co', '\"Software Development,App Development,Domain,Hosting\"', 'hhh', '5', '\"2,4\"', '2024-08-20 15:16:22', '2024-08-20 15:16:22'),
(4, 'RDCIS', 'SK Kushwaha', '07903134728', 'sk37700@gmail.com', 'Kasba', 'rdcis.co', '\"Software Development,App Development,Domain,Hosting\"', 'hhh', '5', '\"2,4\"', '2024-08-20 15:16:45', '2024-08-20 15:16:45'),
(5, 'dgdg', 'fdfdf', '07903134728', 'sk37700@gmail.com', 'Kasba', 'dggd.com', '\"Website Designing,Hosting\"', 'gdgdg', '2', '\"1,6\"', '2024-08-20 15:20:52', '2024-08-20 15:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_project_assigned`
--

CREATE TABLE `tb_project_assigned` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_project_assigned`
--

INSERT INTO `tb_project_assigned` (`id`, `project_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '1', '2', '2024-08-20 07:02:36', '2024-08-20 07:02:36'),
(2, '1', '4', '2024-08-20 07:02:36', '2024-08-20 07:02:36'),
(3, '2', '2', '2024-08-20 12:41:30', '2024-08-20 12:41:30'),
(4, '2', '4', '2024-08-20 12:41:30', '2024-08-20 12:41:30'),
(5, '2', '6', '2024-08-20 12:41:30', '2024-08-20 12:41:30'),
(6, '4', '2', '2024-08-20 15:16:45', '2024-08-20 15:16:45'),
(7, '4', '4', '2024-08-20 15:16:45', '2024-08-20 15:16:45'),
(8, '5', '1', '2024-08-20 15:20:52', '2024-08-20 15:20:52'),
(9, '5', '6', '2024-08-20 15:20:52', '2024-08-20 15:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_project_messages`
--

CREATE TABLE `tb_project_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_by_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_project_messages`
--

INSERT INTO `tb_project_messages` (`id`, `project_id`, `sent_by_user_id`, `message`, `created_at`, `updated_at`) VALUES
(1, '1', 'sk001', 'd', '2024-08-20 07:11:41', '2024-08-20 07:11:41'),
(2, '1', 'gm_admin', 'd', '2024-08-20 08:29:04', '2024-08-20 08:29:04'),
(3, '1', 'gm_admin', 'fggf', '2024-08-20 08:41:47', '2024-08-20 08:41:47'),
(4, '1', 'gm_admin', 'fdfsd', '2024-08-20 08:46:26', '2024-08-20 08:46:26'),
(5, '1', 'gm_admin', 'gdf', '2024-08-20 08:46:33', '2024-08-20 08:46:33'),
(6, '1', 'gm_admin', 'sdsd', '2024-08-20 10:31:19', '2024-08-20 10:31:19'),
(7, '1', 'sk001', '789456', '2024-08-20 10:36:52', '2024-08-20 10:36:52'),
(8, '1', 'gm_admin', 'ok', '2024-08-20 10:37:15', '2024-08-20 10:37:15'),
(9, '1', 'sk001', 'thffg', '2024-08-20 10:39:19', '2024-08-20 10:39:19'),
(10, '1', 'sk001', 'sddsf', '2024-08-20 10:40:13', '2024-08-20 10:40:13'),
(11, '1', 'sk001', 'rrr', '2024-08-20 12:19:05', '2024-08-20 12:19:05'),
(12, '1', 'sk001', '789', '2024-08-20 12:19:34', '2024-08-20 12:19:34'),
(13, '1', 'gm_admin', 'gdfdf', '2024-08-20 12:22:19', '2024-08-20 12:22:19'),
(14, '1', 'gm_admin', 'sefd', '2024-08-20 12:22:29', '2024-08-20 12:22:29'),
(15, '1', 'sk001', 'dhsjdh', '2024-08-20 12:40:17', '2024-08-20 12:40:17'),
(16, '1', 'gm_admin', 'DFFDFD', '2024-08-20 12:40:22', '2024-08-20 12:40:22'),
(17, '1', 'gm_admin', 'dggd', '2024-08-20 15:25:42', '2024-08-20 15:25:42'),
(18, '4', 'gm_admin', 'Accepted', '2024-08-20 15:42:40', '2024-08-20 15:42:40'),
(19, '4', 'gm_admin', 'jj', '2024-08-20 16:23:04', '2024-08-20 16:23:04'),
(20, '4', 'gm_admin', 'dgdg', '2024-08-20 16:42:15', '2024-08-20 16:42:15'),
(21, '4', 'gm_admin', 'test', '2024-08-20 16:43:05', '2024-08-20 16:43:05'),
(22, '4', 'sk001', 'dggd', '2024-08-20 16:44:51', '2024-08-20 16:44:51'),
(23, '4', 'sk001', 'gsgsg', '2024-08-20 16:44:54', '2024-08-20 16:44:54'),
(24, '4', 'sk001', 'gfd', '2024-08-20 16:44:58', '2024-08-20 16:44:58'),
(25, '4', 'sk001', 'dgdg', '2024-08-20 16:46:34', '2024-08-20 16:46:34'),
(26, '4', 'gm_admin', 'ddd', '2024-08-20 16:47:38', '2024-08-20 16:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_project_services`
--

CREATE TABLE `tb_project_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_project_services`
--

INSERT INTO `tb_project_services` (`id`, `service`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Website Designing', '1', '2024-08-08 08:02:11', '2024-08-08 08:32:01'),
(4, 'Software Development', '1', '2024-08-08 08:22:36', '2024-08-08 08:22:36'),
(5, 'App Development', '1', '2024-08-08 08:27:44', '2024-08-08 08:27:44'),
(6, 'S.E.O.', '1', '2024-08-08 10:50:46', '2024-08-08 10:50:46'),
(7, 'Domain', '1', '2024-08-08 10:50:54', '2024-08-08 10:50:54'),
(8, 'Hosting', '1', '2024-08-08 10:50:59', '2024-08-08 10:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `user_name`, `user_id`, `user_phone`, `user_email`, `password`, `designation_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kaif Ahmed', 'kaifahmed', '9988774455', 'kaifahmed07@gmail.com', '$2y$10$0BFFQWvlYSqa9OYywAHcaem1Ejy2dtPj0jWCvuuT6DhybxaqpFxcW', '1', '1', NULL, '2024-08-20 08:39:53'),
(2, 'Saurabh', 'sk001', '7903134728', 'abc@gmail.com', '$2y$10$0BFFQWvlYSqa9OYywAHcaem1Ejy2dtPj0jWCvuuT6DhybxaqpFxcW', '1', '1', '2024-08-07 02:04:24', '2024-08-07 03:11:50'),
(4, 'Rahul Ranjan', '0001', '7992320463', 'rahul.rk52@gmail.com', '$2y$10$LlgAswf09uiZkaPdmLkKKO9zB3eOtvYzVwOgFbTuomBUks5F4HOea', '7', '1', '2024-08-08 08:54:21', '2024-08-08 08:54:21'),
(5, 'Graphix Media Office', 'GM-001', '0000000000', 'graphixmedia@in.net', '$2y$10$Bi65/T1YvpW2cv3ZdxgZfuyNanxXD859f8hYqbG0cP2maGzV6wQTa', '8', '1', '2024-08-08 10:50:21', '2024-08-08 10:50:21'),
(6, 'Sweta Kumari', 'sweta@123456', '7894561230', 'sweta@graphixmedia.com', '$2y$10$afCthGjkB41.AG9ElgekX.8kG7xU3OM8eXjt9mFNvSjheTuwwXNN6', '3', '1', '2024-08-10 12:33:11', '2024-08-10 12:33:11'),
(7, '789', '789789', '7894567894', 'yhg@gjh', '$2y$10$6ZXJPJie5Lin8r5ixRhf.e.ynvU6DBh1NdI.H0IgVUsyKt/6JvLt6', '8', '1', '2024-08-10 12:34:26', '2024-08-10 12:34:26');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_designations`
--

CREATE TABLE `tb_user_designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_user_designations`
--

INSERT INTO `tb_user_designations` (`id`, `designation`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PHP Developer', '1', '2024-08-07 01:15:45', '2024-08-08 01:09:51'),
(2, 'Dot Net Developer', '1', '2024-08-07 01:18:55', '2024-08-08 01:09:52'),
(3, 'Web Designer', '1', '2024-08-07 01:20:42', '2024-08-07 01:20:42'),
(4, 'Tele Caller', '1', '2024-08-07 01:21:07', '2024-08-07 01:21:07'),
(5, 'Marketing', '1', '2024-08-07 01:21:17', '2024-08-07 01:21:17'),
(7, 'Project Manager', '1', '2024-08-08 07:08:21', '2024-08-08 07:32:30'),
(8, 'Office', '1', '2024-08-08 10:49:01', '2024-08-08 10:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_modules`
--
ALTER TABLE `tb_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_notifications`
--
ALTER TABLE `tb_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_projects`
--
ALTER TABLE `tb_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_project_assigned`
--
ALTER TABLE `tb_project_assigned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_project_messages`
--
ALTER TABLE `tb_project_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_project_services`
--
ALTER TABLE `tb_project_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user_designations`
--
ALTER TABLE `tb_user_designations`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_modules`
--
ALTER TABLE `tb_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_notifications`
--
ALTER TABLE `tb_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_projects`
--
ALTER TABLE `tb_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_project_assigned`
--
ALTER TABLE `tb_project_assigned`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_project_messages`
--
ALTER TABLE `tb_project_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_project_services`
--
ALTER TABLE `tb_project_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_user_designations`
--
ALTER TABLE `tb_user_designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
