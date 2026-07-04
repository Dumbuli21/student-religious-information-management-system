-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2026 at 10:47 PM
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
-- Database: `srims`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `subject_type`, `subject_id`, `properties`, `created_at`, `updated_at`) VALUES
(1, 1, 'Created Announcement', 'Announcement', 1, '{\"title\":\"Welcome Students\"}', '2026-07-03 20:17:28', '2026-07-03 20:17:28'),
(2, 1, 'login', 'User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.127.0 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"note\":\"User logged in\"}', '2026-07-03 17:20:06', '2026-07-03 17:20:06'),
(3, 1, 'logout', 'User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.127.0 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"note\":\"User logged out\"}', '2026-07-03 17:23:56', '2026-07-03 17:23:56'),
(4, 2, 'login', 'User', 2, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.127.0 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"note\":\"User logged in\"}', '2026-07-03 17:24:13', '2026-07-03 17:24:13'),
(5, 2, 'logout', 'User', 2, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.127.0 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"note\":\"User logged out\"}', '2026-07-03 17:24:45', '2026-07-03 17:24:45'),
(6, 1, 'logout', 'User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged out\"}', '2026-07-03 17:24:57', '2026-07-03 17:24:57'),
(7, 2, 'login', 'User', 2, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged in\"}', '2026-07-03 17:25:11', '2026-07-03 17:25:11'),
(8, 2, 'logout', 'User', 2, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged out\"}', '2026-07-03 17:27:12', '2026-07-03 17:27:12'),
(9, 1, 'login', 'User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged in\"}', '2026-07-03 17:27:32', '2026-07-03 17:27:32'),
(10, 1, 'logout', 'User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged out\"}', '2026-07-03 17:33:59', '2026-07-03 17:33:59'),
(11, 5, 'login', 'User', 5, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged in\"}', '2026-07-03 17:34:22', '2026-07-03 17:34:22'),
(12, 5, 'logout', 'User', 5, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged out\"}', '2026-07-03 17:34:41', '2026-07-03 17:34:41'),
(13, 1, 'login', 'User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged in\"}', '2026-07-03 17:35:03', '2026-07-03 17:35:03'),
(14, 1, 'logout', 'User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged out\"}', '2026-07-03 17:36:38', '2026-07-03 17:36:38'),
(15, 6, 'login', 'User', 6, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged in\"}', '2026-07-03 17:36:53', '2026-07-03 17:36:53'),
(16, 6, 'logout', 'User', 6, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged out\"}', '2026-07-03 17:41:34', '2026-07-03 17:41:34'),
(17, 1, 'login', 'User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged in\"}', '2026-07-03 17:41:51', '2026-07-03 17:41:51'),
(18, 1, 'logout', 'User', 1, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged out\"}', '2026-07-03 17:43:15', '2026-07-03 17:43:15'),
(19, 7, 'login', 'User', 7, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged in\"}', '2026-07-03 17:43:37', '2026-07-03 17:43:37'),
(20, 7, 'login', 'User', 7, '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/150.0.0.0 Safari\\/537.36\",\"note\":\"User logged in\"}', '2026-07-03 17:43:37', '2026-07-03 17:43:37');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `religion_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `religion_id`, `title`, `content`, `published_at`, `is_published`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Welcome Students', 'Welcome to Student Religious Information Management System.', '2026-07-03 20:17:28', 1, 1, '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'COICT', '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL),
(2, 'Engineering', '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL),
(3, 'Business', '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL),
(4, 'Education', '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `religion_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `max_participants` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('upcoming','ongoing','completed','cancelled') NOT NULL DEFAULT 'upcoming',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `religion_id`, `title`, `description`, `start_date`, `end_date`, `location`, `max_participants`, `status`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Friday Prayer', 'Weekly Congregational Prayer', '2026-07-10 12:30:00', '2026-07-10 14:00:00', 'University Mosque', 500, 'upcoming', 1, '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `attended` tinyint(1) DEFAULT NULL,
  `attended_at` timestamp NULL DEFAULT NULL,
  `marked_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `religion_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('pending','reviewed','resolved') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `religion_id`, `user_id`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'System Feedback', 'The system is user friendly.', 'pending', '2026-07-03 20:17:28', '2026-07-03 20:17:28');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Certificate', '2026-07-03 20:17:27', '2026-07-03 20:17:27', NULL),
(2, 'Diploma', '2026-07-03 20:17:27', '2026-07-03 20:17:27', NULL),
(3, 'Bachelor', '2026-07-03 20:17:27', '2026-07-03 20:17:27', NULL),
(4, 'Master', '2026-07-03 20:17:27', '2026-07-03 20:17:27', NULL),
(5, 'PhD', '2026-07-03 20:17:27', '2026-07-03 20:17:27', NULL);

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
(1, '2026_03_25_105648_create_religions_table', 1),
(2, '2026_03_25_105649_create_roles_table', 1),
(3, '2026_03_25_195948_create_levels_table', 1),
(4, '2026_03_25_200011_create_departments_table', 1),
(5, '2026_03_25_200101_create_programmes_table', 1),
(6, '2026_03_25_200102_create_regions_table', 1),
(7, '2026_03_25_200102_create_users_table', 1),
(8, '2026_03_25_200103_create_announcements_table', 1),
(9, '2026_03_25_200104_create_events_table', 1),
(10, '2026_03_25_200105_create_event_registrations_table', 1),
(11, '2026_03_25_200106_create_notifications_table', 1),
(12, '2026_03_25_200107_create_feedback_table', 1),
(13, '2026_03_25_200108_create_activity_logs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `religion_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('announcement','event','general') NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `reference_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `religion_id`, `type`, `title`, `message`, `reference_id`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'announcement', 'New Announcement', 'A new announcement has been posted.', 1, 0, '2026-07-03 20:17:28', '2026-07-03 20:17:28');

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`id`, `name`, `department_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Computer Science', 1, '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL),
(2, 'Information Technology', 1, '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL),
(3, 'Civil Engineering', 2, '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL),
(4, 'Accounting', 3, '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mbeya', '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL),
(2, 'Dar es Salaam', '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL),
(3, 'Dodoma', '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL),
(4, 'Arusha', '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL),
(5, 'Mwanza', '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`id`, `name`, `description`, `logo`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Islam', 'Muslim Community', NULL, 'active', '2026-07-03 20:17:27', '2026-07-03 20:17:27', NULL),
(2, 'Christianity', 'Christian Community', NULL, 'active', '2026-07-03 20:17:27', '2026-07-03 20:17:27', NULL),
(3, 'Hinduism', 'Hindu Community', NULL, 'active', '2026-07-03 20:17:27', '2026-07-03 20:17:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` enum('super_admin','religious_admin','sub_admin','student') NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'System Super Administrator', '2026-07-03 20:17:27', '2026-07-03 20:17:27'),
(2, 'religious_admin', 'Religious Administrator', '2026-07-03 20:17:27', '2026-07-03 20:17:27'),
(3, 'sub_admin', 'Sub Administrator', '2026-07-03 20:17:27', '2026-07-03 20:17:27'),
(4, 'student', 'Student User', '2026-07-03 20:17:27', '2026-07-03 20:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `religion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `programme_id` bigint(20) UNSIGNED DEFAULT NULL,
  `region_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `student_number` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `year_of_study` tinyint(3) UNSIGNED DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `password_changed` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `religion_id`, `role_id`, `level_id`, `department_id`, `programme_id`, `region_id`, `name`, `email`, `student_number`, `phone`, `gender`, `year_of_study`, `password`, `is_active`, `password_changed`, `remember_token`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 1, NULL, NULL, NULL, NULL, 'codeguy', 'admin@example.com', 'admin', '0712345678', NULL, NULL, '$2y$12$daiHBNnle3z4FUvj5iIcneTK2EuHMlw8jTLjSN5UuHTlc8Ex/YMbi', 1, 1, NULL, NULL, '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL),
(2, 1, 4, 3, 1, 1, 1, 'Juma Ally', 'juma@student.com', '2025-04-001', '0755123456', 'male', 1, '$2y$12$4M9UQAEEd1mbwveU6Og7VOw/qBjq2QY4Yn16lDw2ShPsE8XaWzKd2', 1, 0, NULL, 1, '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL),
(3, 2, 4, 3, 1, 2, 2, 'John Peter', 'john@student.com', '2025-04-002', '0711111111', 'male', 2, 'REPLACE_WITH_BCRYPT_HASH_OF_must123', 1, 0, NULL, 1, '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL),
(4, 1, 4, 3, 2, 3, 3, 'Aisha Hassan', 'aisha@student.com', '2025-04-003', '0788888888', 'female', 3, 'REPLACE_WITH_BCRYPT_HASH_OF_must123', 1, 0, NULL, 1, '2026-07-03 20:17:28', '2026-07-03 20:17:28', NULL),
(5, 2, 4, 3, 1, 2, 3, 'Anold kara', 'kara@gmail.com', '2410045', '0746878098', 'male', 2, '$2y$12$LhkLAnDDJcKpoKFu0TQn9.64WzdonVnlWJ2f.tIhO2tSG73cTlENe', 1, 0, NULL, 1, '2026-07-03 17:33:16', '2026-07-03 17:33:16', NULL),
(6, 1, 2, 3, 2, 3, 1, 'Imam Qasim', 'imam@gmail.com', '2410040', '0746878095', 'male', 3, '$2y$12$HUxtH1G7dceUeRUD4Lbo0eke3d5UUA7aTq4fFVitTc1PgOsKAes7u', 1, 0, NULL, 1, '2026-07-03 17:36:21', '2026-07-03 17:36:21', NULL),
(7, 2, 2, 3, 3, 4, 4, 'kelvi kelvin', 'kelvin@gmail.com', '2410041', '0746876098', 'male', 2, '$2y$12$NoSVRY./nOQBP8Q/SASLzuywIETVpyuB7qZnubE7GImofj4lthY6q', 1, 1, NULL, 1, '2026-07-03 17:43:02', '2026-07-03 17:43:02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcements_religion_id_foreign` (`religion_id`),
  ADD KEY `announcements_created_by_foreign` (`created_by`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_religion_id_foreign` (`religion_id`),
  ADD KEY `events_created_by_foreign` (`created_by`);

--
-- Indexes for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_registrations_event_id_foreign` (`event_id`),
  ADD KEY `event_registrations_user_id_foreign` (`user_id`),
  ADD KEY `event_registrations_marked_by_foreign` (`marked_by`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_religion_id_foreign` (`religion_id`),
  ADD KEY `feedback_user_id_foreign` (`user_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `levels_name_unique` (`name`);

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
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_religion_id_foreign` (`religion_id`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programmes_department_id_foreign` (`department_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regions_name_unique` (`name`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `religions_name_unique` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_student_number_unique` (`student_number`),
  ADD KEY `users_religion_id_foreign` (`religion_id`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_level_id_foreign` (`level_id`),
  ADD KEY `users_department_id_foreign` (`department_id`),
  ADD KEY `users_programme_id_foreign` (`programme_id`),
  ADD KEY `users_region_id_foreign` (`region_id`),
  ADD KEY `users_created_by_foreign` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `announcements_religion_id_foreign` FOREIGN KEY (`religion_id`) REFERENCES `religions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `events_religion_id_foreign` FOREIGN KEY (`religion_id`) REFERENCES `religions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD CONSTRAINT `event_registrations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_registrations_marked_by_foreign` FOREIGN KEY (`marked_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `event_registrations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_religion_id_foreign` FOREIGN KEY (`religion_id`) REFERENCES `religions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedback_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_religion_id_foreign` FOREIGN KEY (`religion_id`) REFERENCES `religions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `programmes`
--
ALTER TABLE `programmes`
  ADD CONSTRAINT `programmes_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_programme_id_foreign` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_religion_id_foreign` FOREIGN KEY (`religion_id`) REFERENCES `religions` (`id`),
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
