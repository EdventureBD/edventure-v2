-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2021 at 06:38 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virtual_academy`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `causer_type`, `causer_id`, `properties`, `created_at`, `updated_at`) VALUES
(1, 'User', 'created', 'App\\Models\\User', 1, NULL, NULL, '{\"attributes\":{\"name\":\"Admin\",\"email\":\"admin@app.com\"}}', '2021-01-30 18:49:43', '2021-01-30 18:49:43'),
(2, 'User', 'created', 'App\\Models\\User', 2, NULL, NULL, '{\"attributes\":{\"name\":\"Price Collins\",\"email\":\"leuschke.florence@example.org\"}}', '2021-01-30 18:49:47', '2021-01-30 18:49:47'),
(3, 'User', 'created', 'App\\Models\\User', 3, NULL, NULL, '{\"attributes\":{\"name\":\"Mathilde Hamill III\",\"email\":\"ondricka.keeley@example.com\"}}', '2021-01-30 18:49:48', '2021-01-30 18:49:48'),
(4, 'User', 'created', 'App\\Models\\User', 4, NULL, NULL, '{\"attributes\":{\"name\":\"Laurence Stanton\",\"email\":\"borer.lenna@example.com\"}}', '2021-01-30 18:49:48', '2021-01-30 18:49:48'),
(5, 'User', 'created', 'App\\Models\\User', 5, NULL, NULL, '{\"attributes\":{\"name\":\"Ms. Herta Schamberger\",\"email\":\"garrison.price@example.com\"}}', '2021-01-30 18:49:48', '2021-01-30 18:49:48'),
(6, 'User', 'created', 'App\\Models\\User', 6, NULL, NULL, '{\"attributes\":{\"name\":\"Eugene Moore\",\"email\":\"elissa.bosco@example.com\"}}', '2021-01-30 18:49:49', '2021-01-30 18:49:49'),
(7, 'User', 'created', 'App\\Models\\User', 7, NULL, NULL, '{\"attributes\":{\"name\":\"Maye Quigley\",\"email\":\"kaya91@example.com\"}}', '2021-01-30 18:49:49', '2021-01-30 18:49:49'),
(8, 'User', 'created', 'App\\Models\\User', 8, NULL, NULL, '{\"attributes\":{\"name\":\"Nikko Haag\",\"email\":\"volkman.anabel@example.org\"}}', '2021-01-30 18:49:49', '2021-01-30 18:49:49'),
(9, 'User', 'created', 'App\\Models\\User', 9, NULL, NULL, '{\"attributes\":{\"name\":\"Miss Cordia Moore II\",\"email\":\"leopold.waters@example.org\"}}', '2021-01-30 18:49:50', '2021-01-30 18:49:50'),
(10, 'User', 'created', 'App\\Models\\User', 10, NULL, NULL, '{\"attributes\":{\"name\":\"Dr. Lindsay McDermott\",\"email\":\"rcruickshank@example.com\"}}', '2021-01-30 18:49:50', '2021-01-30 18:49:50'),
(11, 'User', 'created', 'App\\Models\\User', 11, NULL, NULL, '{\"attributes\":{\"name\":\"Miss Karelle Thompson\",\"email\":\"jeanie55@example.com\"}}', '2021-01-30 18:49:51', '2021-01-30 18:49:51'),
(12, 'User', 'created', 'App\\Models\\User', 12, NULL, NULL, '{\"attributes\":{\"name\":\"Janiya Olson\",\"email\":\"haag.raegan@example.org\"}}', '2021-01-30 18:49:51', '2021-01-30 18:49:51'),
(13, 'User', 'created', 'App\\Models\\User', 13, NULL, NULL, '{\"attributes\":{\"name\":\"Drake Haag Jr.\",\"email\":\"ijerde@example.com\"}}', '2021-01-30 18:49:51', '2021-01-30 18:49:51'),
(14, 'User', 'created', 'App\\Models\\User', 14, NULL, NULL, '{\"attributes\":{\"name\":\"Morton Wisozk\",\"email\":\"mayer.heath@example.net\"}}', '2021-01-30 18:49:51', '2021-01-30 18:49:51'),
(15, 'User', 'created', 'App\\Models\\User', 15, NULL, NULL, '{\"attributes\":{\"name\":\"Josefina Goyette\",\"email\":\"emmie83@example.org\"}}', '2021-01-30 18:49:52', '2021-01-30 18:49:52'),
(16, 'User', 'created', 'App\\Models\\User', 16, NULL, NULL, '{\"attributes\":{\"name\":\"Sydni Pfeffer\",\"email\":\"cory28@example.net\"}}', '2021-01-30 18:49:52', '2021-01-30 18:49:52'),
(17, 'User', 'created', 'App\\Models\\User', 17, NULL, NULL, '{\"attributes\":{\"name\":\"Dejah Walsh\",\"email\":\"abernathy.wayne@example.net\"}}', '2021-01-30 18:49:52', '2021-01-30 18:49:52'),
(18, 'User', 'created', 'App\\Models\\User', 18, NULL, NULL, '{\"attributes\":{\"name\":\"Willa Fritsch\",\"email\":\"quitzon.duane@example.net\"}}', '2021-01-30 18:49:52', '2021-01-30 18:49:52'),
(19, 'User', 'created', 'App\\Models\\User', 19, NULL, NULL, '{\"attributes\":{\"name\":\"Jedediah Schowalter\",\"email\":\"yward@example.net\"}}', '2021-01-30 18:49:53', '2021-01-30 18:49:53'),
(20, 'User', 'created', 'App\\Models\\User', 20, NULL, NULL, '{\"attributes\":{\"name\":\"Dr. Timmothy Moore\",\"email\":\"rhintz@example.net\"}}', '2021-01-30 18:49:54', '2021-01-30 18:49:54'),
(21, 'User', 'created', 'App\\Models\\User', 21, NULL, NULL, '{\"attributes\":{\"name\":\"Prof. Maribel Botsford PhD\",\"email\":\"hermiston.salvador@example.net\"}}', '2021-01-30 18:49:54', '2021-01-30 18:49:54'),
(22, 'Course Category', 'created', 'App\\Models\\Admin\\CourseCategory', 1, NULL, NULL, '[]', '2021-01-30 18:49:54', '2021-01-30 18:49:54'),
(23, 'Course Category', 'created', 'App\\Models\\Admin\\CourseCategory', 2, NULL, NULL, '[]', '2021-01-30 18:49:54', '2021-01-30 18:49:54'),
(24, 'Course Category', 'created', 'App\\Models\\Admin\\CourseCategory', 3, NULL, NULL, '[]', '2021-01-30 18:49:55', '2021-01-30 18:49:55'),
(25, 'Course Category', 'created', 'App\\Models\\Admin\\CourseCategory', 4, NULL, NULL, '[]', '2021-01-30 18:49:55', '2021-01-30 18:49:55'),
(26, 'Course Category', 'created', 'App\\Models\\Admin\\CourseCategory', 5, NULL, NULL, '[]', '2021-01-30 18:49:56', '2021-01-30 18:49:56'),
(27, 'Course Category', 'created', 'App\\Models\\Admin\\CourseCategory', 6, NULL, NULL, '[]', '2021-01-30 18:49:56', '2021-01-30 18:49:56'),
(28, 'Course Category', 'created', 'App\\Models\\Admin\\CourseCategory', 7, NULL, NULL, '[]', '2021-01-30 18:49:57', '2021-01-30 18:49:57'),
(29, 'Course Category', 'created', 'App\\Models\\Admin\\CourseCategory', 8, NULL, NULL, '[]', '2021-01-30 18:49:57', '2021-01-30 18:49:57'),
(30, 'Course', 'created', 'App\\Models\\Admin\\Course', 1, 'App\\Models\\User', 1, '[]', '2021-01-30 18:52:47', '2021-01-30 18:52:47'),
(31, 'Course', 'created', 'App\\Models\\Admin\\Course', 2, NULL, NULL, '[]', '2021-01-30 18:58:57', '2021-01-30 18:58:57'),
(32, 'Course', 'created', 'App\\Models\\Admin\\Course', 4, NULL, NULL, '[]', '2021-01-30 19:01:03', '2021-01-30 19:01:03'),
(33, 'Course', 'created', 'App\\Models\\Admin\\Course', 5, NULL, NULL, '[]', '2021-01-30 19:01:03', '2021-01-30 19:01:03'),
(34, 'Course', 'created', 'App\\Models\\Admin\\Course', 6, NULL, NULL, '[]', '2021-01-30 19:01:04', '2021-01-30 19:01:04'),
(35, 'Course', 'created', 'App\\Models\\Admin\\Course', 7, NULL, NULL, '[]', '2021-01-30 19:01:04', '2021-01-30 19:01:04'),
(36, 'Course Topic', 'created', 'App\\Models\\Admin\\CourseTopic', 1, 'App\\Models\\User', 1, '[]', '2021-01-30 19:03:17', '2021-01-30 19:03:17'),
(37, 'Course Topic', 'created', 'App\\Models\\Admin\\CourseTopic', 2, 'App\\Models\\User', 1, '[]', '2021-01-30 19:03:48', '2021-01-30 19:03:48'),
(38, 'Course Topic', 'created', 'App\\Models\\Admin\\CourseTopic', 4, 'App\\Models\\User', 1, '[]', '2021-01-30 19:04:46', '2021-01-30 19:04:46'),
(39, 'Course Lecture', 'created', 'App\\Models\\Admin\\CourseLecture', 1, 'App\\Models\\User', 1, '[]', '2021-01-30 19:05:26', '2021-01-30 19:05:26'),
(40, 'Live Class', 'created', 'App\\Models\\Admin\\ContentTag', 1, 'App\\Models\\User', 1, '[]', '2021-01-30 19:06:02', '2021-01-30 19:06:02'),
(41, 'Live Class', 'updated', 'App\\Models\\Admin\\ContentTag', 1, 'App\\Models\\User', 1, '[]', '2021-01-30 19:08:43', '2021-01-30 19:08:43'),
(42, 'Live Class', 'created', 'App\\Models\\Admin\\ExamType', 1, 'App\\Models\\User', 1, '[]', '2021-01-31 05:06:10', '2021-01-31 05:06:10'),
(43, 'Live Class', 'created', 'App\\Models\\Admin\\ExamType', 2, 'App\\Models\\User', 1, '[]', '2021-01-31 05:07:39', '2021-01-31 05:07:39'),
(44, 'Live Class', 'created', 'App\\Models\\Admin\\ExamType', 3, 'App\\Models\\User', 1, '[]', '2021-01-31 05:08:12', '2021-01-31 05:08:12'),
(45, 'Live Class', 'updated', 'App\\Models\\Admin\\ExamType', 3, 'App\\Models\\User', 1, '[]', '2021-01-31 05:20:35', '2021-01-31 05:20:35'),
(46, 'Live Class', 'updated', 'App\\Models\\Admin\\ExamType', 3, 'App\\Models\\User', 1, '[]', '2021-01-31 05:20:52', '2021-01-31 05:20:52'),
(47, 'Batch', 'created', 'App\\Models\\Admin\\Batch', 1, 'App\\Models\\User', 1, '[]', '2021-01-31 05:22:41', '2021-01-31 05:22:41'),
(48, 'Batch Lecture', 'created', 'App\\Models\\Admin\\BatchLecture', 1, 'App\\Models\\User', 1, '[]', '2021-01-31 05:23:31', '2021-01-31 05:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_running_days` int(11) NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `student_limit` int(11) NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `title`, `slug`, `batch_running_days`, `teacher_id`, `student_limit`, `course_id`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Batch001', 'batch001', 1, 4, 40, 2, 1, 0, '2021-01-31 05:22:41', '2021-01-31 05:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `batch_lectures`
--

CREATE TABLE `batch_lectures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch_lectures`
--

INSERT INTO `batch_lectures` (`id`, `batch_id`, `course_id`, `topic_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, '2021-01-31 05:23:31', '2021-01-31 05:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `batch_student_enrollments`
--

CREATE TABLE `batch_student_enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_tags`
--

CREATE TABLE `content_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` bigint(20) UNSIGNED NOT NULL,
  `lecture_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_tags`
--

INSERT INTO `content_tags` (`id`, `title`, `slug`, `course_id`, `topic_id`, `lecture_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ict updated', 'ict-updated', 2, 1, 1, 1, '2021-01-30 19:06:02', '2021-01-30 19:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_category_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `slug`, `course_category_id`, `description`, `price`, `duration`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Ict BD', 'ict-bd', 1, 'fadfadvfdffvwrgfv', 1234, 23, 1, 0, '2021-01-30 18:52:47', '2021-01-30 18:52:47'),
(2, 'ict', 'ict', 1, 'asdacfjeifue edfuhwevfuws', 1234, 23, 1, 0, '2021-01-30 18:58:57', '2021-01-30 18:58:57'),
(4, 'chemistry', 'chemistry', 5, 'asdacfjeifue edfuhwevfuws', 1234, 23, 1, 0, '2021-01-30 19:01:03', '2021-01-30 19:01:03'),
(5, 'math', 'math', 2, 'asdacfjeifue edfuhwevfuws', 1234, 23, 1, 0, '2021-01-30 19:01:03', '2021-01-30 19:01:03'),
(6, 'english', 'english', 3, 'asdacfjeifue edfuhwevfuws', 1234, 23, 1, 0, '2021-01-30 19:01:04', '2021-01-30 19:01:04'),
(7, 'physics', 'physics', 4, 'asdacfjeifue edfuhwevfuws', 1234, 23, 1, 0, '2021-01-30 19:01:04', '2021-01-30 19:01:04');

-- --------------------------------------------------------

--
-- Table structure for table `course_categories`
--

CREATE TABLE `course_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_categories`
--

INSERT INTO `course_categories` (`id`, `title`, `slug`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 'ict', 'ict', 1, 0, '2021-01-30 18:49:54', '2021-01-30 18:49:54'),
(2, 'math', 'math', 1, 0, '2021-01-30 18:49:54', '2021-01-30 18:49:54'),
(3, 'engilsh', 'engilsh', 1, 0, '2021-01-30 18:49:55', '2021-01-30 18:49:55'),
(4, 'physics', 'physics', 1, 0, '2021-01-30 18:49:55', '2021-01-30 18:49:55'),
(5, 'chemistry', 'chemistry', 1, 0, '2021-01-30 18:49:56', '2021-01-30 18:49:56'),
(6, 'biology', 'biology', 1, 0, '2021-01-30 18:49:56', '2021-01-30 18:49:56'),
(7, 'grammer', 'grammer', 1, 0, '2021-01-30 18:49:56', '2021-01-30 18:49:56'),
(8, 'economics', 'economics', 1, 0, '2021-01-30 18:49:57', '2021-01-30 18:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `course_lectures`
--

CREATE TABLE `course_lectures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_lectures`
--

INSERT INTO `course_lectures` (`id`, `title`, `slug`, `course_id`, `topic_id`, `url`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 'first chap', 'first-chap', 2, 1, '3433', 1, 0, '2021-01-30 19:05:26', '2021-01-30 19:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `course_topics`
--

CREATE TABLE `course_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_topics`
--

INSERT INTO `course_topics` (`id`, `title`, `slug`, `course_id`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 'first chap', 'first-chap', 2, 1, 0, '2021-01-30 19:03:17', '2021-01-30 19:03:17'),
(2, 'second chap', 'second-chap', 2, 1, 0, '2021-01-30 19:03:47', '2021-01-30 19:03:47'),
(4, 'first chap math', 'first-chap-math', 5, 1, 0, '2021-01-30 19:04:46', '2021-01-30 19:04:46');

-- --------------------------------------------------------

--
-- Table structure for table `exam_types`
--

CREATE TABLE `exam_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_types`
--

INSERT INTO `exam_types` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'MCQ', 'mcq', '2021-01-31 05:06:09', '2021-01-31 05:06:09'),
(2, 'CQ', 'cq', '2021-01-31 05:07:39', '2021-01-31 05:07:39'),
(3, 'Assignment', 'assignment', '2021-01-31 05:08:12', '2021-01-31 05:20:51');

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
-- Table structure for table `live_classes`
--

CREATE TABLE `live_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` bigint(20) UNSIGNED NOT NULL,
  `live_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` date NOT NULL,
  `start_date` date NOT NULL,
  `end_time` date NOT NULL,
  `end_date` date NOT NULL,
  `is_special` tinyint(4) NOT NULL,
  `order` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
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
(4, '2021_01_21_081001_create_user_types_table', 1),
(5, '2021_01_22_100402_create_activity_log_table', 1),
(6, '2021_01_23_210825_create_course_categories_table', 1),
(7, '2021_01_23_211334_create_courses_table', 1),
(8, '2021_01_24_123858_create_course_topics_table', 1),
(9, '2021_01_25_110129_create_course_lectures_table', 1),
(10, '2021_01_26_125117_create_batches_table', 1),
(11, '2021_01_28_132604_create_batch_lectures_table', 1),
(12, '2021_01_29_195749_create_live_classes_table', 1),
(13, '2021_01_30_110742_create_payments_table', 1),
(14, '2021_01_30_192534_create_batch_student_enrollments_table', 1),
(15, '2021_01_30_194528_create_content_tags_table', 1),
(17, '2021_01_31_103417_create_exam_types_table', 2);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `trx_id` bigint(20) NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_account_number` bigint(20) NOT NULL,
  `days_for` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `user_type` tinyint(4) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_admin`, `user_type`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@app.com', NULL, 1, 1, NULL, '$2y$10$5u52PDsHUZrBweHKbM8/mOfhVVqAtE4SZf.bK7l/r/cKLO5zK3nr6', NULL, '2021-01-30 18:49:43', '2021-01-30 18:49:43'),
(2, 'Price Collins', 'leuschke.florence@example.org', NULL, 0, 3, NULL, '$2y$10$tPf.S5L5fuKMHpsUf4J.zO.QtNoPhILOEGJRLLKbYBnf57yUgi4b.', NULL, '2021-01-30 18:49:46', '2021-01-30 18:49:46'),
(3, 'Mathilde Hamill III', 'ondricka.keeley@example.com', NULL, 0, 3, NULL, '$2y$10$ZSSfgUROAmu..k68708uj.HwLPDHKRTP.oFXCKEwJ6yhwQJDI9Pt2', NULL, '2021-01-30 18:49:47', '2021-01-30 18:49:47'),
(4, 'Laurence Stanton', 'borer.lenna@example.com', NULL, 0, 2, NULL, '$2y$10$iIBS3TQXNGTjjYKjBhb1uuj9YhL3uiaNrSMsXMQxTIU2eXiAOt5oe', NULL, '2021-01-30 18:49:48', '2021-01-30 18:49:48'),
(5, 'Ms. Herta Schamberger', 'garrison.price@example.com', NULL, 0, 3, NULL, '$2y$10$3Dfnn05C/jFnyAzCmweyvu0YcZeySZvk51PLO0UBZaWvsAvvIK1H6', NULL, '2021-01-30 18:49:48', '2021-01-30 18:49:48'),
(6, 'Eugene Moore', 'elissa.bosco@example.com', NULL, 1, 1, NULL, '$2y$10$L6ao4qx/sLRTG8Ie7.GN8.6yStwmSvAKZcAeeZEfW9LN5HXOpfy0S', NULL, '2021-01-30 18:49:49', '2021-01-30 18:49:49'),
(7, 'Maye Quigley', 'kaya91@example.com', NULL, 1, 1, NULL, '$2y$10$AL6qicb4KBYAfT9tbZ6RdOwCFtGz84kskoi00weQXKCXvp9wP/74q', NULL, '2021-01-30 18:49:49', '2021-01-30 18:49:49'),
(8, 'Nikko Haag', 'volkman.anabel@example.org', NULL, 0, 2, NULL, '$2y$10$ZepikHlOzmosl//EUUsbgugMoFa1FWudyF8BECT0vJXio35GN31yK', NULL, '2021-01-30 18:49:49', '2021-01-30 18:49:49'),
(9, 'Miss Cordia Moore II', 'leopold.waters@example.org', NULL, 0, 3, NULL, '$2y$10$sfDG2cdXklaXBTMFqH0jGugWzHd2V66v/J23fHX6ZcubgDB3gIWsm', NULL, '2021-01-30 18:49:49', '2021-01-30 18:49:49'),
(10, 'Dr. Lindsay McDermott', 'rcruickshank@example.com', NULL, 1, 1, NULL, '$2y$10$YdMNwB16383z1GE00bZxN.b5LTbITR.mtwPQm1zSvwZHkAAo/4AuC', NULL, '2021-01-30 18:49:50', '2021-01-30 18:49:50'),
(11, 'Miss Karelle Thompson', 'jeanie55@example.com', NULL, 1, 1, NULL, '$2y$10$H7RiGlKIvyXDAVjaJcyGguT20xKxmUqDG./JuWk5V6RxzGTbg.RLG', NULL, '2021-01-30 18:49:50', '2021-01-30 18:49:50'),
(12, 'Janiya Olson', 'haag.raegan@example.org', NULL, 0, 2, NULL, '$2y$10$A.WyRNaBcGvElsXZtW.9Ru/EuagMIuGi17rvBITqmVzfRJvtEdyCK', NULL, '2021-01-30 18:49:51', '2021-01-30 18:49:51'),
(13, 'Drake Haag Jr.', 'ijerde@example.com', NULL, 1, 1, NULL, '$2y$10$zXtjtkkn0hWil1YkHrXQDu6yo0vTsy3vT4Q9Z7uzcTC4vc1SHoi5O', NULL, '2021-01-30 18:49:51', '2021-01-30 18:49:51'),
(14, 'Morton Wisozk', 'mayer.heath@example.net', NULL, 1, 1, NULL, '$2y$10$WLJNcW8gMq13Me4117GrHueFGjwGzAXJWQeNBML6y0qYMUBOAvGHW', NULL, '2021-01-30 18:49:51', '2021-01-30 18:49:51'),
(15, 'Josefina Goyette', 'emmie83@example.org', NULL, 0, 2, NULL, '$2y$10$2.qptQMDM51nxmnVDPday.ARkxrlJ4Q6TWaIej4QpAHiB1lx0srDq', NULL, '2021-01-30 18:49:51', '2021-01-30 18:49:51'),
(16, 'Sydni Pfeffer', 'cory28@example.net', NULL, 0, 2, NULL, '$2y$10$kuz/YxshG7Tjuvp1zOX9POPgyA.rDdakkVDqDJvP2AIxeBAMV6lLm', NULL, '2021-01-30 18:49:52', '2021-01-30 18:49:52'),
(17, 'Dejah Walsh', 'abernathy.wayne@example.net', NULL, 0, 3, NULL, '$2y$10$J46PW3Z0jmHMeW2z3XQo1ec6abDVTYw9iTZLdnlmRI2EGwqDXiYd.', NULL, '2021-01-30 18:49:52', '2021-01-30 18:49:52'),
(18, 'Willa Fritsch', 'quitzon.duane@example.net', NULL, 0, 3, NULL, '$2y$10$86Aw/VzN8qscl0DOJ0Obw.6wicjnwIigmSts4DCZEIXdAuVKRsnVW', NULL, '2021-01-30 18:49:52', '2021-01-30 18:49:52'),
(19, 'Jedediah Schowalter', 'yward@example.net', NULL, 0, 2, NULL, '$2y$10$0YlR4SdfGdm4xIuTN33l.eaDehYvkb5u96JMNhUJXl.AozTGoAi9y', NULL, '2021-01-30 18:49:53', '2021-01-30 18:49:53'),
(20, 'Dr. Timmothy Moore', 'rhintz@example.net', NULL, 1, 1, NULL, '$2y$10$A7EBnjctZesHOAniXXosfuazXMHwXr3PoiRd5u.RitGa44psFzHGy', NULL, '2021-01-30 18:49:53', '2021-01-30 18:49:53'),
(21, 'Prof. Maribel Botsford PhD', 'hermiston.salvador@example.net', NULL, 0, 2, NULL, '$2y$10$x9v9Hqtq3KrYZLOIqblH3OzdiyzFv.GH/LWEWYKPPl.dGzDD3LIHm', NULL, '2021-01-30 18:49:54', '2021-01-30 18:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2021-01-30 18:49:57', '2021-01-30 18:49:57'),
(2, 'Teacher', '2021-01-30 18:49:57', '2021-01-30 18:49:57'),
(3, 'Student', '2021-01-30 18:49:57', '2021-01-30 18:49:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `batches_title_unique` (`title`),
  ADD UNIQUE KEY `batches_slug_unique` (`slug`),
  ADD KEY `batches_teacher_id_foreign` (`teacher_id`),
  ADD KEY `batches_course_id_foreign` (`course_id`);

--
-- Indexes for table `batch_lectures`
--
ALTER TABLE `batch_lectures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_lectures_batch_id_foreign` (`batch_id`),
  ADD KEY `batch_lectures_course_id_foreign` (`course_id`),
  ADD KEY `batch_lectures_topic_id_foreign` (`topic_id`);

--
-- Indexes for table `batch_student_enrollments`
--
ALTER TABLE `batch_student_enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_tags`
--
ALTER TABLE `content_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_tags_slug_unique` (`slug`),
  ADD KEY `content_tags_course_id_foreign` (`course_id`),
  ADD KEY `content_tags_topic_id_foreign` (`topic_id`),
  ADD KEY `content_tags_lecture_id_foreign` (`lecture_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_slug_unique` (`slug`),
  ADD KEY `courses_course_category_id_foreign` (`course_category_id`);

--
-- Indexes for table `course_categories`
--
ALTER TABLE `course_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_categories_slug_unique` (`slug`);

--
-- Indexes for table `course_lectures`
--
ALTER TABLE `course_lectures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_lectures_slug_unique` (`slug`),
  ADD KEY `course_lectures_course_id_foreign` (`course_id`),
  ADD KEY `course_lectures_topic_id_foreign` (`topic_id`);

--
-- Indexes for table `course_topics`
--
ALTER TABLE `course_topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_topics_slug_unique` (`slug`),
  ADD KEY `course_topics_course_id_foreign` (`course_id`);

--
-- Indexes for table `exam_types`
--
ALTER TABLE `exam_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exam_types_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `live_classes`
--
ALTER TABLE `live_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `live_classes_slug_unique` (`slug`),
  ADD KEY `live_classes_batch_id_foreign` (`batch_id`),
  ADD KEY `live_classes_course_id_foreign` (`course_id`),
  ADD KEY `live_classes_topic_id_foreign` (`topic_id`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_student_id_foreign` (`student_id`),
  ADD KEY `payments_course_id_foreign` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batch_lectures`
--
ALTER TABLE `batch_lectures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batch_student_enrollments`
--
ALTER TABLE `batch_student_enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_tags`
--
ALTER TABLE `content_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course_categories`
--
ALTER TABLE `course_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course_lectures`
--
ALTER TABLE `course_lectures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_topics`
--
ALTER TABLE `course_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_types`
--
ALTER TABLE `exam_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_classes`
--
ALTER TABLE `live_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batches`
--
ALTER TABLE `batches`
  ADD CONSTRAINT `batches_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batches_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `batch_lectures`
--
ALTER TABLE `batch_lectures`
  ADD CONSTRAINT `batch_lectures_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batch_lectures_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batch_lectures_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `course_topics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `content_tags`
--
ALTER TABLE `content_tags`
  ADD CONSTRAINT `content_tags_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `content_tags_lecture_id_foreign` FOREIGN KEY (`lecture_id`) REFERENCES `course_lectures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `content_tags_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `course_topics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_course_category_id_foreign` FOREIGN KEY (`course_category_id`) REFERENCES `course_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_lectures`
--
ALTER TABLE `course_lectures`
  ADD CONSTRAINT `course_lectures_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_lectures_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `course_topics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_topics`
--
ALTER TABLE `course_topics`
  ADD CONSTRAINT `course_topics_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `live_classes`
--
ALTER TABLE `live_classes`
  ADD CONSTRAINT `live_classes_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `live_classes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `live_classes_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `course_topics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
