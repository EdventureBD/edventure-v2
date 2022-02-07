-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2022 at 12:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virtual_academy_2`
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

-- --------------------------------------------------------

--
-- Table structure for table `aptitude_test_mcqs`
--

CREATE TABLE `aptitude_test_mcqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field1` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field2` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field3` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field4` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` int(11) NOT NULL,
  `explanation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `number_of_attempt` int(11) NOT NULL,
  `gain_marks` int(11) NOT NULL,
  `success_rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aptitude_test_mcqs`
--

INSERT INTO `aptitude_test_mcqs` (`id`, `question`, `slug`, `image`, `field1`, `field2`, `field3`, `field4`, `answer`, `explanation`, `exam_id`, `number_of_attempt`, `gain_marks`, `success_rate`, `created_at`, `updated_at`) VALUES
(3533, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;Test Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;Arithmetic 1<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;New Aptitude Test 1<br>Question&nbsp; 1</h3>', '8089fb16-8ee4-4f6b-84d1-c200c9833017', NULL, '<p>Option 1</p>', '<p>Option 2<br></p>', '<p>Option 3<br></p>', '<p>Option 4<br></p>', 1, NULL, 213, 5, 1, 20, '2022-01-26 05:18:44', '2022-01-26 10:42:16'),
(3534, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;Test Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;Arithmetic 1<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;New Aptitude Test 1<br>Arithmetic 2</h3>', '79740dc4-623f-47b0-b7d4-5187d6292745', NULL, '<p>Option 1</p>', '<p>Option 2<br></p>', '<p>Option 3<br></p>', '<p>Option 4<br></p>', 2, '<p>Option 2 is ans</p>', 213, 5, 1, 20, '2022-01-26 05:19:22', '2022-01-26 10:42:16'),
(3535, '<p>AAA Aptitude Test MCQ 1<br></p>', 'f2b761d0-8ef3-4217-bce1-5ac4c55ffdb9', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 1, '<p>Opt 1 is ans</p>', 217, 1, 1, 100, '2022-01-27 05:34:04', '2022-01-27 12:38:28'),
(3536, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\">AAA Aptitude Test MCQ 2</h3>', 'f5600e70-f87f-42eb-8ca0-20ddbb204c0b', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 2, '<p>Opt 2 is ans</p>', 217, 1, 1, 100, '2022-01-27 05:34:50', '2022-01-27 12:38:27'),
(3540, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;AAA Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;AAA Course Topic 1<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;AAA Aptitude Test<br>Question 1</h3>', '67b51ce1-2195-4436-b213-2265962310cd', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 1, '<p>Opt 1 is ans</p>', 229, 2, 2, 100, '2022-02-06 06:09:32', '2022-02-06 12:43:20'),
(3541, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;AAA Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;AAA Course Topic 1<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;AAA Aptitude Test<br>Question 2</h3>', 'ca541f17-143d-4029-b293-e074c0c0b6d0', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 2, '<p>Opt 2 is ans</p>', 229, 0, 0, 0, '2022-02-06 06:10:44', '2022-02-06 06:10:44'),
(3542, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;AAA Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;AAA Course Topic 1<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;AAA Aptitude Test<br>Question 3</h3>', '168a9a47-7dba-492e-95c6-9998e046e231', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 3, '<p>Opt 3 is ans</p>', 229, 2, 2, 100, '2022-02-06 06:11:34', '2022-02-06 12:43:20'),
(3543, '<div>Course : AAA Course 1</div><div>Topic : AAA Course Topic 2</div><div>Exam : AAA Course Topic 2 Aptitude Test<br>Aptitude Test MCQ 1</div>', '8409313d-84c4-4445-8beb-c8177be46062', NULL, '<p>Opt 1<br></p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 1, NULL, 233, 1, 1, 100, '2022-02-07 06:40:29', '2022-02-07 06:53:51'),
(3544, '<div>Course : AAA Course 1</div><div>Topic : AAA Course Topic 2</div><div>Exam : AAA Course Topic 2 Aptitude Test<br>Aptitude Test MCQ 2<br></div>', '094c3de1-4cfa-412a-9e69-f9a2eb4293e1', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 2, NULL, 233, 1, 1, 100, '2022-02-07 06:44:34', '2022-02-07 06:53:51'),
(3545, '<div>Course : AAA Course 1</div><div>Topic : AAA Course Topic 2</div><div>Exam : AAA Course Topic 2 Aptitude Test<br>Aptitude Test MCQ 3</div>', '88069c89-958e-4a4f-91a4-edf06f60513b', NULL, 'Opt 1', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 2, NULL, 233, 1, 0, 0, '2022-02-07 06:51:22', '2022-02-07 06:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marks` int(11) NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(16, 'batch 1 Edited', 'batch-1-edited', 0, 728, 5, 33, 1, 0, '2022-01-04 08:11:17', '2022-01-04 08:18:27'),
(17, 'batch 2', 'batch-2', 0, 728, 3, 32, 1, 0, '2022-01-04 08:20:23', '2022-01-04 08:20:23'),
(18, 'Test Batch 1', 'test-batch-1', 0, 728, 10, 39, 1, 0, '2022-01-26 05:13:10', '2022-01-26 05:13:10'),
(21, 'AAA Batch 1', 'aaa-batch-1', 0, 728, 2, 44, 1, 0, '2022-02-06 06:12:31', '2022-02-06 06:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `batch_exams`
--

CREATE TABLE `batch_exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch_exams`
--

INSERT INTO `batch_exams` (`id`, `batch_id`, `exam_id`, `status`, `created_at`, `updated_at`) VALUES
(126, 16, 190, 1, '2022-01-04 12:21:10', '2022-01-04 12:21:10'),
(127, 16, 191, 1, '2022-01-04 12:21:35', '2022-01-04 12:21:35'),
(128, 16, 192, 1, '2022-01-04 12:21:42', '2022-01-04 12:21:42'),
(129, 16, 194, 1, '2022-01-05 05:14:53', '2022-01-05 05:14:53'),
(130, 16, 197, 1, '2022-01-05 10:19:53', '2022-01-05 10:19:53'),
(131, 16, 193, 1, '2022-01-05 10:19:58', '2022-01-05 10:19:58'),
(148, 21, 229, 1, '2022-02-06 06:13:01', '2022-02-06 06:13:01'),
(149, 21, 230, 1, '2022-02-06 06:24:27', '2022-02-06 06:24:27'),
(150, 21, 231, 1, '2022-02-06 10:49:34', '2022-02-06 10:49:34');

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
(24, 16, 33, 266, 1, '2022-01-04 08:11:34', '2022-01-04 08:11:34'),
(25, 16, 33, 267, 1, '2022-01-10 12:44:13', '2022-01-10 12:44:13'),
(26, 18, 39, 269, 1, '2022-01-26 05:13:40', '2022-01-26 05:13:40'),
(32, 21, 44, 277, 1, '2022-02-06 06:14:03', '2022-02-06 06:14:03'),
(33, 21, 44, 278, 1, '2022-02-06 06:14:17', '2022-02-06 06:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `batch_student_enrollments`
--

CREATE TABLE `batch_student_enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `batch_rank` int(11) DEFAULT NULL,
  `note_list` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `individual_batch_days` int(11) NOT NULL,
  `accessed_days` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch_student_enrollments`
--

INSERT INTO `batch_student_enrollments` (`id`, `batch_id`, `payment_id`, `course_id`, `student_id`, `batch_rank`, `note_list`, `individual_batch_days`, `accessed_days`, `status`, `created_at`, `updated_at`) VALUES
(470, 16, 564, 33, 712, 3, 'Free enrolment', 0, 365, 1, '2022-01-04 13:04:00', '2022-01-27 05:49:31'),
(471, 16, 565, 33, 5, 1, 'Free enrolment', 0, 365, 1, '2022-01-12 04:46:10', '2022-01-27 05:49:31'),
(472, 16, 569, 33, 6, 2, 'Free enrolment', 0, 365, 1, '2022-01-23 12:37:22', '2022-02-05 06:11:17'),
(473, 18, 567, 39, 5, 1, 'Free enrolment', 0, 365, 1, '2022-01-26 05:19:54', '2022-01-27 05:49:31'),
(476, 21, 572, 44, 5, NULL, 'Free enrolment', 0, 365, 1, '2022-02-06 06:12:48', '2022-02-06 06:12:48'),
(477, 21, 573, 44, 6, NULL, 'Free enrolment', 0, 365, 1, '2022-02-06 06:36:07', '2022-02-06 06:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `subtitle`, `banner`, `meta_tag`, `meta_description`, `description`, `author_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'শেখার যাদু-লার্নিং এনালিটিক্স', '81f1e831-9d77-429e-804b-b9919a19c30b', 'শেখার যাদু-লার্নিং এনালিটিক্স', '/storage/blog/cL4M6Ytxg9RtS615QIkpaA6dT6JWE5qhz7R3Zn7N.png', 'শেখার যাদু, edventure, HSC 2021', 'মানুষ হিসেবে নিত্য-নতুন জিনিসের প্রতি আগ্রহ এবং তা শেখার চেষ্টা সম্ভবত আমাদের সব থেকে পুরাতন ও গুরুত্বপূর্ণ বৈশিষ্ট্যগুলোর একটি। জন্মের ঠিক পর থেকেই আমরা বিভিন্ন উপায়ে বিভিন্ন জিনিস শিখে আসছি এবং স্বাচ্ছন্দে তা জীবনে চর্চা করে আসছি। শিখার প্রতি আমাদের এই ন্যাচারাল আগ্রহ-ই আমাদেরকে আজ সকল প্রানীদের মধ্যে বিশেষ এক জায়গায় এনে দাড় করিয়েছে। পড়াশোনা এবং পরীক্ষার মত ভীতিকর শব্দগুলোর সাথে পরিচিত হওয়ার আগে কোন কিছু শিখতে সম্ভবত আমাদের তেমন কোন অনীহা ছিল না। হাটার চেষ্টা করতে যেয়ে বারবার হোচট খেয়ে, পরে যেয়েও ঠিক উঠে দাড়িয়েছি সবাই, হাটতে শিখেছি। শেখার এই যাত্রায় বারবার ভুল করে বিভিন্ন বাধা অতিক্রম করার পথে, আমাদের মস্তিষ্কই আমাদেরকে কিছু শর্টকাট শিখিয়েছে। হাটা শিখতে আমাদের যতটুকু কষ্ট হয়েছে, যত সময় লেগেছে, দৌড়ানো শিখতে কিন্তু ততটুকু লাগে নি। আমাদের অতীতের ভুল এবং শেখার ধরণ বুঝে আমাদের মস্তিষ্কই আমাদেরকে আমাদের মত করে নতুন জিনিস আরো সহজভাবে শিখতে সাহায্য করেছে। সহজ ভাষায়, পুরোনো তথ্য-উপাত্ত এবং ব্যবহারের  উপর ভিত্তি করে আমাদের মস্তিষ্ক এই যে আমাদের শিখন-প্রক্রিয়ার বিভিন্ন দিক ভবিষ্যতে কিভাবে সামলানো উচিত তা নিয়ে ধারনা দেয়, এটাই লার্নিংএনালিটিক্স', '<p></p><p>মানুষ হিসেবে নিত্য-নতুন জিনিসের প্রতি আগ্রহ এবং তা শেখার চেষ্টা সম্ভবত আমাদের সব থেকে পুরাতন ও গুরুত্বপূর্ণ বৈশিষ্ট্যগুলোর একটি। জন্মের ঠিক পর থেকেই আমরা বিভিন্ন উপায়ে বিভিন্ন জিনিস শিখে আসছি এবং স্বাচ্ছন্দে তা জীবনে চর্চা করে আসছি। শিখার প্রতি আমাদের এই ন্যাচারাল আগ্রহ-ই আমাদেরকে আজ সকল প্রানীদের মধ্যে বিশেষ এক জায়গায় এনে দাড় করিয়েছে। পড়াশোনা এবং পরীক্ষার মত ভীতিকর শব্দগুলোর সাথে পরিচিত হওয়ার আগে কোন কিছু শিখতে সম্ভবত আমাদের তেমন কোন অনীহা ছিল না। হাটার চেষ্টা করতে যেয়ে বারবার হোচট খেয়ে, পরে যেয়েও ঠিক উঠে দাড়িয়েছি সবাই, হাটতে শিখেছি। শেখার এই যাত্রায় বারবার ভুল করে বিভিন্ন বাধা অতিক্রম করার পথে, আমাদের মস্তিষ্কই আমাদেরকে কিছু শর্টকাট শিখিয়েছে। হাটা শিখতে আমাদের যতটুকু কষ্ট হয়েছে, যত সময় লেগেছে, দৌড়ানো শিখতে কিন্তু ততটুকু লাগে নি। আমাদের অতীতের ভুল এবং শেখার ধরণ বুঝে আমাদের মস্তিষ্কই আমাদেরকে আমাদের মত করে নতুন জিনিস আরো সহজভাবে শিখতে সাহায্য করেছে। সহজ ভাষায়, পুরোনো তথ্য-উপাত্ত এবং ব্যবহারের  উপর ভিত্তি করে আমাদের মস্তিষ্ক এই যে আমাদের শিখন-প্রক্রিয়ার বিভিন্ন দিক ভবিষ্যতে কিভাবে সামলানো উচিত তা নিয়ে ধারনা দেয়, এটাই লার্নিংএনালিটিক্স বা <span style=\"font-size: 1rem;\">শিখন-বিশ্লেষণ এর মূল কাজ।</span></p><p style=\"text-align: center; \"><b style=\"color: rgb(156, 0, 255);\">হামাগুড়ি থেকে হাঁটতে শেখা</b></p><p style=\"text-align: center; \"><img src=\"https://edventurebd.com/storage/uploadImages/CcmpNT46fxk56uqiBtcBzSCJpHpymmE2e57svQiu.jpg\" style=\"width: 50%;\"><b style=\"color: rgb(156, 0, 255);\"><br></b></p><p style=\"text-align: center; \"><span style=\"color: rgb(156, 0, 255); font-weight: 700;\">০ থেকে ১৪ মাসে হাঁটতে শেখা</span><br><img src=\"https://edventurebd.com/storage/uploadImages/xTkNowK5oorMIE76eBEVkqIOgi4Pydn9sieJcKo9.jpg\" style=\"width: 473px; height: 449.683px; float: left;\" class=\"note-float-left\"></p><p style=\"text-align: center; \"><span style=\"font-weight: bold; color: rgb(156, 0, 255);\"><br></span></p><p style=\"text-align: center; \"><span style=\"font-weight: bold; color: rgb(156, 0, 255);\">১৪ থেকে ১৮ মাসে দৌড়ানো</span></p><p style=\"text-align: center; \">    <img src=\"https://edventurebd.com/storage/uploadImages/SQrsAVdn25NxlDM2l3LRH686SUqofdxeSc3XGcYN.jpg\" style=\"width: 363.4px; height: 314.767px;\"></p><div style=\"text-align: left; margin-left: 25px;\"><span style=\"font-size: 1rem;\"><br></span></div><div style=\"text-align: left; margin-left: 25px;\"><br><img src=\"https://edventurebd.com/storage/uploadImages/uhaTYL2dljtMLsFRKLTwLdQ9IG54DUrpRhqHvAIa.jpg\" style=\"width: 25%; float: right;\" class=\"note-float-right\"></div><p>লার্নিং এনালিটিক্স কি এবং কিভাবে কাজ করে এবার একটি উদাহরণ এর সাহায্যে আরো সহজভাবে বুঝার চেষ্টা করি। ধরো তুমি তোমার স্কুলের মোটামুটি রেগুলার একজন ছাত্র। ক্লাসে মনযোগী থাকার চেষ্টা করো, সময়মত সব হোম ওয়ার্ক করার চেষ্টা করো এবংপরীক্ষায় তার ফলাফলও পাও। খুব বেশি কঠিন লাগত না স্কুলের পড়া। কিন্তু স্কুল ছেড়ে কলেজে উঠার পর হঠাত তুমি সবকিছু নিয়ে একটূ হিমশিম খাওয়া শুরু করলে। মোটা-মোটা এতগুলা বইয়ের সবগুলো পাতার কোথায় কি আছে, তোমার কোথায় পড়া বাকি আছে এটা ট্র্যাক করতে যেয়ে তুমি পরলে মহাবিপদে। খোদ আইন্সটাইনও এতকিছুর ভীড়ে সামলে উঠতে পারত কিনা তা নিয়েও তোমার মনে এখন যথেষ্ঠ সন্দেহ।</p><p>ঠিক এমন সময় তুমি একটি প্ল্যাটফর্ম এর নাম শুনলে যা তোমাকে একটা ম্যাজিক পাওয়ার <span style=\"font-size: 1rem;\">দেয়ার প্রতিশ্রুতি করলো। কোন বইয়ের কোন টপিকে তোমার সমস্যা, সেই সমস্যা থেকে বের হতে কি করা লাগবে, পরীক্ষার আগের রাতে কি পড়া লাগবে, কি বাদ দেয়া লাগবে- সবই জানতে পারবে এক জায়গা থেকে। শুনতে রূপকথার মতো শোনালেও প্রযুক্তির শক্তিতে এটা এখন বাস্তব। আইন্সটাইন যেখানে হিমশিম খাওয়ার কথা, সেখানে তোমার এতকিছু ট্র্যাক তুমি আসলে কিভাবে করতে পারছো? এই প্ল্যাটফর্ম ঠিক কি করে আসলে? প্রথম প্যারায় ঠিক যে উপায়ে আমাদের মস্তিষ্ক আমাদের জন্য শর্টকাট তৈরির কথা বলা আছে, এখানেও ঠিক তা হয়। এই সিস্টেম এর সাথে তুমি যত বেশি ইন্টারেক্ট করবে, যত বেশি পার্টিসিপেট করবে, পরীক্ষা দিবে, সিস্টেম-ই তোমার ফলাফল এর উপর ভিত্তি করে তোমার খুটিনাটি সমস্যা </span><span style=\"font-size: 1rem;\">থেকে শুরু করে সবকিছুর ট্র্যাক রাখবে তোমার মত করে। আলাদা আলাদা ইনপুট এর উপর ভিত্তি করে প্রত্যেক ইউজার এর জন্য এরকম আলাদা আলাদা লার্নিং শর্টকাট তৈরি করাই লার্নিং এনালিটিক্স মুল কাজ।</span></p><p style=\"text-align: center; \"><img src=\"https://edventurebd.com/storage/uploadImages/UDWxNW9EKtOX2GrHZHpWobL74DvgXP8b6FApB0Ao.jpg\" style=\"width: 552px; float: left;\" class=\"note-float-left\"></p><p style=\"text-align: left;\">এখন মুল কথায় আসা যাক। আমাদের মস্তিষ্কই যেহেতু আমাদের সব ডাটা এনালাইসিস করে আমাদের ভবিষ্যতের যাত্রা ক্রমাগত সুগম করতে কাজ করে যাচ্ছে, আলাদা লার্নিং এনালিটিক্স এর দরকার টা আসলে কি? দরকার টা হলো- এই শেখার পথটা আরো সহজ এবং কম ঝামেলাযুক্ত করে তোলা। ছোটবেলা যখন আমরা আসক্তের মত বিভিন্ন নতুন <span style=\"font-size: 1rem;\">জিনিস ক্রমাগত শিখে যেতাম, আলাদা করে অনেক বেশি এফোর্ট দেয়া লাগতো না। তখন আমাদের ভাবার জিনিস কম ছিল, জীবন অনেক বেশি সহজ ছিল। ক্লাসের ১০ টা সাব্জেক্টের ২০ রকম চিন্তা, স্যারদের বকুনি, রাস্তার জ্যাম, বান্ধবীর মন খারাপ সহ নানবিধ সমস্যার মুখোমুখি হতে হত না। মোদ্দা কথা, একবিংশ শতাব্দীর এই ফাস্ট জীবনে সবকিছুর জন্য আলাদা সময় বের করে নেয়াটা খুবই কঠিন। জীবন এখন প্রযুক্তির সাথে পাল্লা দিয়ে খুবই দ্রুতগতিতে আগাচ্ছে। এই গতির সাথে তাল মিলাতে দরকার জীবনকে আরো সহজ করে তোলার উপায়। লার্নিং এনালিটিক্স ঠিক তেমন একটা টুল। প্রতিটি সাব্জেক্টের জন্য আলাদা করে ঘন্টার পর ঘন্টা সময় ব্যয় করে নিজের যেই strength and weakness আমরা বের করতে পারি, লার্নিং এনালিটিক্স তা আমাদের করে দিবে মুহুর্তের মধ্যেই। স্যারদের কাছে সারাদিন দৌড়াদৌড়ি করে, পড়ানোর ভাইয়াদের সারাদিন </span><span style=\"font-size: 1rem;\">ফেইসবুক/হোয়াটস এপে গুতানোর পরও যখন বুঝতে পারি না ঠিক কি করলে আমি আমার দুর্বলতার জায়গা গুলো থেকে বের হয়ে আসতে পারবো, সত্যিই তখন অনেক হতাশ লাগে। কিন্তু কাউকে আসলে এই পুরো ব্যাপারটাতে দোষও দেয়া যায় না। স্যার বা পড়ানোর ভাইয়াদেরও দেখা যায় একসাথে অনেকজন্ ছাত্রের খোজ রাখা লাগে। ছাত্রের তুলনায় </span><span style=\"font-size: 1rem;\">শিক্ষকের অনুপাত যখন আমাদের দেশে ভয়ানকভাবে কম, চাইলেও খুব বেশি করা হয়ত সম্ভবও হয়ে উঠে না। ঠিক এরকম অসংখ্য কারণে আমাদের দরকার লার্নিং এনালিটিক্স এবং তার যথাযথ ব্যবহার করতে শেখা।</span></p><p style=\"text-align: left;\"><span style=\"font-size: 1rem;\"> একটি সুচিন্তিত লার্নিং এনালিটিক্স সিস্টেম শুধু মাত্র শেখার পদ্ধতিকে সহজই করে তুলে না বরং দেখিয়ে দেয় দুর্বলতার জায়গা থেকে বের হয়ে আসার সুনির্দিষ্ট পথ। </span><span style=\"font-size: 1rem;\">বহুল জনসংখ্যা এবং অপ্রতুল শিক্ষা-ব্যবস্থা অবকাঠামোর আমাদের এই </span><span style=\"font-size: 1rem;\">দেশ অনেক দিন ধরেই শিক্ষার্থীদের জ্ঞানার্জনের পথকে করে রেখেছে দুর্গম। অদূর ভবিষ্যতে কখনো যেহেতু আমাদের জনসংখ্যা হুট করে কমে যাওয়া বা শিক্ষা প্রতিষ্ঠান আকাশ্চুম্বী বেড়ে যাওয়ার সম্ভাবনা কম, </span><span style=\"font-size: 1rem;\">শেখার কাজে লার্নিং এনালিটিক্স এর যথাযথ ব্যবহারের আসলে কোন </span><span style=\"font-size: 1rem;\">বিকল্প নেই ।</span></p><p><span style=\" text-align: center; font-size: 1rem;\">   </span>                                                          <span style=\" text-align: center; font-size: 1rem;\">  </span></p><p></p><p></p>', 632, 1, '2021-11-27 13:15:49', '2021-12-19 09:13:16'),
(3, 'পার্সোনালাইজ্‌ড এডুকেশনে শিক্ষক কি অপ্রয়োজনীয়?', '0571e70a-5b30-42d5-8ca0-b1bb43f2a46d', 'পার্সোনালাইজ্‌ড এডুকেশনে শিক্ষক কি অপ্রয়োজনীয়?', '/storage/blog/ZMTNupwx8hMWUThcpsHOFsHUYYpBVRoAKV04s0Wt.png', 'পার্সোনালাইজ্‌ড এডুকেশন, Edventure', 'নিজের মতো করে শেখা বা \"পার্সোনালাইজ্‌ড এডুকেশন\"-এর \"নিজের মতো\" অংশটা আসলে অনেক কিছুই বোঝাতে পারে। কেউ যদি নিজের সময় মতো অনলাইনে ভিডিও দেখে এবং পরীক্ষা দিয়ে একটা কোর্স কমপ্লিট করে, তবে সেটাকেও বলা যেতে পারে পার্সোনালাইজ্‌ড এডুকেশন, কারন স্টুডেন্টকে কোন বাধা-ধরা রুটিনে আবদ্ধ থাকতে হয়নি। অন্যদিকে, যদি স্টুডেন্টের দক্ষতা, দুর্বলতা, এবং আগ্রহের উপর ভিত্তিকরে সম্পূর্ণ নিজস্ব শিখন-যাত্রা বা লার্নিং জার্নি তৈরি করা হয়, তবে সেটাও এক ধরণের \"নিজের মতো শেখা\"।', '<h4>নিজের মতো শিখতে হলে শিক্ষকের দরকার কী?</h4><p>নিজের মতো করে শেখার কোনো প্রয়োজন আছে কি না সেটার উত্তর বের করার আগে আসলে দরকার নিজের মতো করে শেখা বলতে আদৌ কী বোঝায় তা বের করা।</p><p>নিজের মতো করে শেখা বা \"পার্সোনালাইজ্‌ড এডুকেশন\"-এর \"নিজের মতো\" অংশটা আসলে অনেক কিছুই বোঝাতে পারে। কেউ যদি নিজের সময় মতো অনলাইনে ভিডিও দেখে এবং পরীক্ষা দিয়ে একটা কোর্স কমপ্লিট করে, তবে সেটাকেও বলা যেতে পারে পার্সোনালাইজ্‌ড এডুকেশন, কারন স্টুডেন্টকে কোন বাধা-ধরা রুটিনে আবদ্ধ থাকতে হয়নি।</p><p>অন্যদিকে, যদি স্টুডেন্টের দক্ষতা, দুর্বলতা, এবং  আগ্রহের উপর ভিত্তিকরে সম্পূর্ণ নিজস্ব শিখন-যাত্রা বা লার্নিং জার্নি  তৈরি করা হয়, তবে সেটাও এক ধরণের \"নিজের মতো শেখা\"। ঠিক এই কাজটাই পৃথিবীর অসংখ্য এড-টেক প্রতিষ্ঠান করার চেষ্টা করে চলেছে।</p><p>কিন্তু এই লার্নিং জার্নি যদি শুধু ভিডিও দেখা, কুইজ দেয়া, আর প্র্যাকটিস করার মধ্যে সীমাবদ্ধ থাকে, আর তাই যদি যথাযথ শিক্ষার জন্য যথেষ্ট হয়, তবে কী শিক্ষকের কাজ হবে শুধু ভিডিও বানানো? অর্থাৎ টেকনোলজি কি তবে আগামীতে টীচার দের প্রয়োজন কমিয়ে আনবে? এখন যেমন স্টুডেন্টের সাথে একজন কেয়ারিং টীচার কথা বলে বোঝার চেষ্টা করে কীভাবে তাকে সবচেয়ে ভালো ভাবে সাহায্য করা যায়, ভবিষ্যতে কি তবে সেটা হয়ে যাবে একটা মেশিনের বা এপ্লিকেশনের দায়িত্ত্ব? একবিংশ শতকের নতুন টেকনোলজি কি তাহলে আমাদের শিক্ষা-ব্যবস্থাকে সম্পূর্ণ অটোমেশনের আওতায় এনে টীচারদের চাকরি নিয়ে টানাটানি করবে?</p><p>এই প্রশ্নগুলোর উত্তর খোজার আগে বলে রাখা ভালো, নতুন টেকনোলজি পড়াশোনাকে রাতারাতি বদলে ফেলার আশংকা আগেও অনেকবার করা হয়েছে। প্রথম যখন সিডি বা কম্প্যাক্ট ডিস্কের মাধ্যমে ভিডিও শেয়ার করার প্রযুক্তি এলো তখনি ধরে নেয়া হয়েছিল এটা শিক্ষা-ব্যবস্থাকে বদলে দেবে রাতারাতি। বাস্তবেই কি তা হয়েছে? এনিমেশন-সহ ভিডিও ব্যবহার করে অসংখ্য শিক্ষক ইউটিউবে বিভিন্ন জটিল কন্সেপ্টের সহজ ব্যাখ্যা দিয়ে চলেছেন প্রতিনিয়ত। আর তা দেখে যদিও আমরা অনেকেই উপকৃত হচ্ছি, কিন্তু তাই বলে টীচার এবং স্টুডেন্টের মাঝে যোগাযোগের বিকল্প হিসেবে এখনো কোন মাধ্যম শক্তভাবে গড়ে উঠতে সক্ষম হয়নি। এটার কারণ সহজভাবে বলা যায়, শেখার প্রক্রিয়া বা লার্নিং প্রসেস কোন একমুখী প্রক্রিয়া না। অর্থাৎ একজন স্টুডেন্ট শুধু লেকচার শুনে, আর ভিডিও দেখলে এই প্রসেসটা কেবল শুরু হয়। এরপর স্টুডেন্ট তা নিয়ে চিন্তা করবে এবং স্বাভাবিক-ভাবেই প্রশ্ন করবে। কোনো ক্ষেত্রে একজন শিক্ষক নিজেই কৌতুহল-উদ্দীপক প্রশ্ন করে স্টুডেন্টকে ভাবিয়ে তুলবে। লার্নিং প্রসেসের এই অংশটা  আসলে সবচেয়ে গুরুত্বপূর্ণ। নীচের ছবিটাতে এই ব্যাপারটা তুলে ধরা হয়েছে।<br></p><p><img src=\"https://hammerhead-strand-2d9.notion.site/image/https%3A%2F%2Fs3-us-west-2.amazonaws.com%2Fsecure.notion-static.com%2F9829cf26-0ddb-4010-811b-43eee9d45fdb%2FUntitled.png?table=block&amp;id=ba29d558-b048-4240-bc12-a2823b2e86f8&amp;spaceId=f82f801f-4c03-43ec-aebd-fcc0bf44ce62&amp;width=1230&amp;userId=&amp;cache=v2\" style=\"width: 100%;\"><br></p><p>আমরা দেখতে পাই একজন শিক্ষকের সাথে কথোপকথন এবং প্রশ্নোত্তর ছাড়া একজন শিক্ষার্থীর শেখার প্রক্রিয়া প্রায় অর্ধেকটাই বাকি থেকে যায়। আর তাই, যতই অত্যাধুনিক প্রযুক্তি এসে পড়াশোনার প্রক্রিয়াটা সহজ করার চেষ্টা করুক, শিক্ষা-ব্যবস্থায় শিক্ষকের ভূমিকা অদুর ভবিষ্যতে কমে যাবে বলে আমরা বিশ্বাস করি না।</p><p>তাহলে প্রযুক্তির প্রভাবে শিক্ষা-ব্যবস্থার মাঝে কেমন পরিবর্তন আমরা আশা করতে পারি? প্রযুক্তির বদৌলতে একজন শিক্ষার্থী দেশের যে কোনো প্রান্তে বসে তার শিক্ষকের সাথে যোগাযোগের মাধ্যমে নিজের পড়াশোনা এগিয়ে নিতে পারছে। অর্থাৎ প্রতিটি স্টুডেন্টের ভৌগলিক অবস্থান, শিক্ষা-প্রতিষ্ঠান, এবং তার পরিবারের আর্থিক সঙ্গতি যাই হোক না কেন, ভবিষ্যতের প্রযুক্তি প্রতিটি স্টুডেন্টকে দিবে শ্রেষ্ঠ টীচারদের সাথে যোগাযোগের সুযোগ।</p><p>বর্তমান শিক্ষা-ব্যবস্থায় শিক্ষার্থী এবং শিক্ষকের মধ্যে যে সময়টুকু ব্যয় হয়, তা যে বেশিরভাগ সময় কার্যকর হয়, তা নয়। অর্থাৎ প্রতিদিন শিক্ষার্থী কোচিং অথবা টিউটরের কাছে যাচ্ছে ঠিকই কিন্তু রুটিনে বাধা সময়টার খুব ছোট একটা অংশ তাদের অতিবাহিত হয় পড়া বুঝে নিতে অথবা নতুন কিছু শিখতে। এর চেয়ে যদি শিক্ষার্থী নিজের প্রয়োজন অনুযায়ী একজন শিক্ষকের কাছে সময় চেয়ে নিতে পারতো, তাহলে হয়তো দশ-পনেরো মিনিটই যথেষ্ট হতে পারে একজন শিক্ষার্থির বের করে রাখা সমস্যা সমাধানের জন্য।</p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p>নিজের মতো শেখার থেকেও বেশি প্রয়োজন আসলে ব্যক্তিগত সহযোগীর ভূমিকায় একজন যত্নবান টীচার। তাই আমরা বলছি, পার্সোনালাইজ্‌ড এডুকেশনের থেকেও সম্ভবত বেশি গুরুত্বপূর্ণ পার্সোনাল এসিসটেন্স বা নিজের মতো সহযোগিতা। এই সহযোগীর ভুমিকায় শিক্ষকদের সবচেয়ে বড় সহায়ক হতে পারে টেকনোলজি।</p>', 3, 0, '2021-12-19 09:16:26', '2021-12-19 10:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `completed_lectures`
--

CREATE TABLE `completed_lectures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `lecture_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `completed_lectures`
--

INSERT INTO `completed_lectures` (`id`, `student_id`, `lecture_id`, `created_at`, `updated_at`) VALUES
(1, 5, 442, '2022-02-06 09:13:35', '2022-02-06 09:13:35'),
(2, 5, 443, '2022-02-06 09:14:46', '2022-02-06 09:14:46'),
(3, 6, 442, '2022-02-06 09:39:16', '2022-02-06 09:39:16'),
(4, 6, 443, '2022-02-06 13:20:49', '2022-02-06 13:20:49'),
(5, 5, 444, '2022-02-07 04:52:42', '2022-02-07 04:52:42');

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
  `lecture_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_tags`
--

INSERT INTO `content_tags` (`id`, `title`, `slug`, `course_id`, `topic_id`, `lecture_id`, `status`, `created_at`, `updated_at`) VALUES
(2506, 'Content Tag made from Course lecture 1', 'c3e8defd-bbe5-49d0-b6df-65827f79f574', 33, 266, 430, 1, '2022-01-04 11:35:31', '2022-01-04 11:35:31'),
(2507, 'Content Tag made from Course lecture 2', 'e8970c12-be42-4cbf-9452-53f1ca2a4ae2', 33, 266, 431, 1, '2022-01-04 11:36:06', '2022-01-04 11:36:06'),
(2508, 'Some content Tag 1', 'fb8b65f9-6ab2-4338-8b2a-c5a474dc4c74', 33, 267, 432, 1, '2022-01-24 10:02:23', '2022-01-24 10:02:23'),
(2509, 'Arithmetic Tag 1', '3ff48ae2-1965-4f26-813a-36998f417f16', 39, 269, 433, 1, '2022-01-26 05:17:39', '2022-01-26 05:17:39'),
(2510, 'Arithmetic Tag 2', '1682ff4d-bc5e-4a72-9f84-4b3e8d548d54', 39, 269, 433, 1, '2022-01-26 05:17:55', '2022-01-26 05:17:55'),
(2511, 'Tag 1 for Arithmetic 2', '1f6ca8a6-65d1-4a55-ada5-53e74b55578f', 39, 270, 434, 1, '2022-01-26 12:18:50', '2022-01-26 12:18:50'),
(2512, 'Tag 2 for Arithmetic 2', '4de858ab-ecc5-4fab-9419-e30d21db8bd5', 39, 270, 435, 1, '2022-01-26 12:19:27', '2022-01-26 12:19:27'),
(2522, 'AAA Content Tag 1', '1dbb4bb4-8584-4f55-9b99-c308d6b70779', 44, 277, NULL, 1, '2022-02-06 06:07:28', '2022-02-06 06:07:28'),
(2523, 'AAA Content Tag 2', '3a0e0c88-45fc-476d-982a-9533ae6ce95e', 44, 277, NULL, 1, '2022-02-06 06:07:45', '2022-02-06 06:07:45'),
(2524, 'AAA Content Tag 3', '1cd410de-d323-4b96-9ea3-5910bd7168c3', 44, 277, NULL, 1, '2022-02-06 06:08:02', '2022-02-06 06:08:02'),
(2525, 'AAA Content Tag 1 related to Course Topic 2', '2a120745-830b-45e4-ae0b-8be9a464871a', 44, 278, NULL, 1, '2022-02-07 06:14:02', '2022-02-07 06:14:02'),
(2526, 'AAA Content Tag 2 related to Course Topic 2', '5ec41d92-2a48-4488-99fe-ab7163007b13', 44, 278, NULL, 1, '2022-02-07 06:14:34', '2022-02-07 06:14:34'),
(2527, 'AAA Content Tag 3 related to Course Topic 2', '9cc06267-72fe-4b28-9aca-ab67601a8184', 44, 278, NULL, 1, '2022-02-07 06:15:18', '2022-02-07 06:15:18');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `intermediary_level_id` bigint(20) UNSIGNED NOT NULL,
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

INSERT INTO `courses` (`id`, `title`, `slug`, `icon`, `banner`, `trailer`, `course_category_id`, `intermediary_level_id`, `description`, `price`, `duration`, `status`, `order`, `created_at`, `updated_at`) VALUES
(26, 'Course 1 Related to intermediary level 1', 'course-1', '/storage/course/A0nSF40eGhrJVnObqsebTwqtHZSBmOnTUIMCYzcB.png', '/storage/course/wbdy8qR3EPjMbEBCZBOUn7fCWulr9Sus8RGmCSu1.png', NULL, 6, 1, 'course 1', 650, 1, 1, 0, '2021-11-23 10:19:35', '2021-11-28 07:56:24'),
(27, 'Course 2 Related to intermediary level 1', 'course-2', '/storage/course/A0nSF40eGhrJVnObqsebTwqtHZSBmOnTUIMCYzcB.png', '/storage/course/wbdy8qR3EPjMbEBCZBOUn7fCWulr9Sus8RGmCSu1.png', NULL, 6, 1, 'course 2', 700, 1, 1, 0, '2021-11-23 10:19:35', '2021-11-28 07:56:24'),
(28, 'Course 3 Related to intermediary level 2 now', 'course-3-related-to-intermediary-level-2-now', '/storage/course/796OahPdhXp3hoSCOk5ZpIhn2LHqhsXf1oeUz5Fi.jpg', '/storage/course/hH2pGZe3IqUaVQ61X5GGfPIkpmKR2QO8cnwnV76G.jpg', NULL, 6, 4, 'course 3', 751, 1, 1, 0, '2021-11-23 10:19:35', '2022-01-02 09:52:49'),
(29, 'Course 4 Related to intermediary level 4', 'course-4', '/storage/course/A0nSF40eGhrJVnObqsebTwqtHZSBmOnTUIMCYzcB.png', '/storage/course/wbdy8qR3EPjMbEBCZBOUn7fCWulr9Sus8RGmCSu1.png', NULL, 7, 4, 'course 3', 800, 1, 1, 0, '2021-11-23 10:19:35', '2021-11-28 07:56:24'),
(30, 'Course 5 Related to intermediary level 4', 'course-5', '/storage/course/A0nSF40eGhrJVnObqsebTwqtHZSBmOnTUIMCYzcB.png', '/storage/course/wbdy8qR3EPjMbEBCZBOUn7fCWulr9Sus8RGmCSu1.png', NULL, 7, 4, 'course 5', 850, 1, 1, 0, '2021-11-23 10:19:35', '2021-11-28 07:56:24'),
(31, 'Course 6 Related to intermediary level 1', 'course-6-related-to-intermediary-level-1', '/storage/course/ziUTTojK5RYh1lpqUZrevszeR2wh6sWri7PDFJL4.png', '/storage/course/5XuwlEeV9SsAGvcAynzTD97E6cbVbvmBxVprTyai.png', 'https://www.youtube.com/watch?v=_fdR3C6ErZ8', NULL, 1, 'Description of Course 6 Related to intermediary level 1', 10, 36, 1, 0, '2022-01-01 06:03:40', '2022-01-01 06:03:40'),
(32, 'Chemistry Bundle', 'chemistry-bundle', NULL, NULL, NULL, NULL, 11, 'Chemistry Bundle', 0, 3, 1, 0, '2022-01-02 10:18:33', '2022-01-04 13:03:07'),
(33, 'Physics Bundle', 'physics-bundle', NULL, NULL, NULL, NULL, 11, 'Physics Bundle', 0, 4, 1, 0, '2022-01-02 10:18:53', '2022-01-04 13:02:52'),
(34, 'Biology Bundle', 'biology-bundle', '/storage/course/kWQ6BRZLFwmHtP29pAtgzh4aSGxNKS0JerAfb8ED.png', '/storage/course/llbyLyt4hUIHdhPfeK11wRZMNUYBfRvnBDSix29N.png', 'https://www.youtube.com/watch?v=j_q0D_jbMk8', NULL, 11, 'Biology Bundle', 0, 5, 1, 0, '2022-01-02 10:19:26', '2022-01-04 13:03:01'),
(35, 'EEE Admission', 'eee-admission', '/storage/course/k2fHaVelDJq3szJelUj6tp6F8LoT8aTq9YBJb4Ru.jpg', '/storage/course/77tCKVE549IixvaI986k1BYyF0QO76eyZrE3PncM.jpg', 'https://www.youtube.com/watch?v=j_q0D_jbMk8', NULL, 12, 'EEE Admission', 111, 5, 1, 0, '2022-01-02 10:24:12', '2022-01-02 10:24:12'),
(36, 'CSE Admission Bundle', 'cse-admission-bundle', NULL, NULL, NULL, NULL, 12, 'CSE Admission Bundle', 222, 3, 1, 0, '2022-01-02 10:24:39', '2022-01-02 10:24:39'),
(37, 'Commerce Adminssion Bundle LOL', 'commerce-adminssion-bundle-lol', '/storage/course/DnpH9DZlo7NsvKYcMKGEwxVleOYCUqlQ4uy2i00T.png', '/storage/course/pVymTO9L2RfgUQRjKTsURIF3UO8jCHKwWgkZwMSb.png', 'https://www.youtube.com/watch?v=o0v41bhlpi0', NULL, 12, 'Commerce Adminssion Bundle LOL', 333, 12, 1, 0, '2022-01-02 10:26:19', '2022-01-02 10:26:19'),
(38, 'Philosophy Bundle', 'philosophy-bundle', NULL, NULL, NULL, NULL, 11, 'Philosophy Bundle', 0, 6, 1, 0, '2022-01-04 08:21:43', '2022-01-04 08:21:43'),
(39, 'Test Course 1', 'test-course-1', NULL, NULL, 'SoCuPpCFj7Y', NULL, 15, 'Test Course Category 1 > Intermediary Level 1 > Test Course 1', 0, 4, 1, 0, '2022-01-26 05:04:23', '2022-01-26 05:04:23'),
(44, 'AAA Course 1', 'aaa-course-1', NULL, NULL, 'mpqct1zMqTE', NULL, 19, 'Some Description', 0, 5, 1, 0, '2022-02-06 05:19:44', '2022-02-06 05:19:44');

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
(1, 'HSC', 'hsc', 0, 0, '2021-10-25 10:11:09', '2021-11-16 11:05:02'),
(2, 'SSC', 'ssc', 0, 0, '2021-10-25 10:11:09', '2021-11-16 10:49:47'),
(3, 'Trial Model Test ', 'free-model-test', 1, 0, '2021-11-16 06:39:40', '2021-11-18 10:36:12'),
(4, 'Preparation Model Test ', 'preparation-model-test', 1, 0, '2021-11-16 06:40:51', '2021-11-16 11:04:55'),
(5, 'Final Model Test ', 'final-model-test', 1, 0, '2021-11-16 06:41:01', '2021-11-16 11:05:01'),
(6, 'New Course Category 1', 'new-course-category-1', 1, 0, '2021-11-16 06:41:01', '2021-11-16 11:05:01'),
(7, 'New Course Category 2', 'new-course-category-2', 1, 0, '2021-11-16 06:41:01', '2021-11-16 11:05:01'),
(8, 'Academic', 'academic', 1, 0, '2022-01-02 10:11:14', '2022-01-02 10:11:14'),
(9, 'Admission', 'admission', 1, 0, '2022-01-02 10:11:45', '2022-01-02 10:11:45'),
(12, 'Test Course Category 1', 'test-course-category-1', 1, 0, '2022-01-26 04:59:21', '2022-01-26 04:59:21'),
(15, 'AAA Course Category', 'aaa-course-category', 1, 0, '2022-02-06 05:17:45', '2022-02-06 05:17:45');

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
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `markdown_text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_lectures`
--

INSERT INTO `course_lectures` (`id`, `title`, `slug`, `course_id`, `topic_id`, `exam_id`, `url`, `markdown_text`, `pdf`, `status`, `order`, `created_at`, `updated_at`) VALUES
(430, 'Course lecture related Academic->HSC->Physics Bundle->LOLOL', 'course-lecture-related-academic-hsc-physics-bundle-lolol', 33, 266, 0, 'https://www.youtube.com/watch?v=cL9E3tb46Ms', '<p>Dagnabbit boi. This is some dummay tex to keep this field fuul.</p>', '/storage/lectures/pdf/g0KZiBbWHslKbGXclr77lKWhPDcLbO4mc2TbgehW.pdf', 1, 0, '2022-01-04 06:00:13', '2022-01-04 06:00:13'),
(431, 'Course lecture 2 related Academic->HSC->Physics Bundle->LOLOL', 'course-lecture-2-related-academic-hsc-physics-bundle-lolol', 33, 266, 0, 'https://www.youtube.com/watch?v=cL9E3tb46Ms', NULL, NULL, 1, 0, '2022-01-04 06:30:27', '2022-01-04 06:30:27'),
(432, 'Some lecture 1', 'some-lecture-1', 33, 267, 0, 'SoCuPpCFj7Y', '<p>Some content&nbsp;lecture 1</p>', NULL, 1, 0, '2022-01-24 10:01:26', '2022-01-24 10:01:26'),
(433, 'Arithmetic 1', 'arithmetic-1', 39, 269, 0, 'SoCuPpCFj7Y', 'Some&nbsp;Arithmetic 1 test', '/storage/lectures/pdf/C5fh07SqaCpPJxDWDRu8ZM8oda9bWHDN2EarvHAZ.pdf', 1, 0, '2022-01-26 05:10:47', '2022-01-26 05:10:47'),
(434, 'Lecture For Arithmetic 2', 'lecture-for-arithmetic-2', 39, 270, 0, 'SoCuPpCFj7Y', NULL, NULL, 1, 0, '2022-01-26 12:13:57', '2022-01-26 12:13:57'),
(435, 'Lecture 2 For Arithmetic 2', 'lecture-2-for-arithmetic-2', 39, 270, 0, 'fwJQ0Qhl67c', NULL, NULL, 1, 0, '2022-01-26 12:14:55', '2022-01-26 12:14:55'),
(442, 'AAA Lecture Title 1', 'aaa-lecture-title-1', 44, 277, 230, 'u1pS2xw3FI4&list=TLPQMDYwMjIwMjILDporsccQ8A&index=6', NULL, '/storage/lectures/pdf/SOD1EjIRrU9fU1blFLshm5BHwKT8dNrK8F2IQ8we.pdf', 1, 0, '2022-02-06 08:51:45', '2022-02-06 08:55:40'),
(443, 'AAA Lecture Title 2', 'aaa-lecture-title-2', 44, 277, 230, '-eKMWQJIlBA', NULL, '/storage/lectures/pdf/fhMZ1Su8PmCNVjCYP4HQ2LNSne1o4mmx2FXgDhli.pdf', 1, 0, '2022-02-06 08:58:26', '2022-02-06 08:58:26'),
(444, 'AAA Lecture Title 3', 'aaa-lecture-title-3', 44, 277, 231, 'YGOzQWKGJ_M', NULL, '/storage/lectures/pdf/xkGlTukz7vNwYcNtWcMIY2gisuFN3qJicEnu9mvJ.pdf', 1, 0, '2022-02-06 10:54:06', '2022-02-06 10:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `course_topics`
--

CREATE TABLE `course_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `intermediary_level_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_topics`
--

INSERT INTO `course_topics` (`id`, `title`, `slug`, `course_id`, `intermediary_level_id`, `status`, `order`, `created_at`, `updated_at`) VALUES
(266, 'New course topic related Academic->HSC->Physics Bundle LOLOL', 'new-course-topic-related-academic-hsc-physics-bundle', 33, 11, 1, 0, '2022-01-03 13:49:29', '2022-01-03 13:50:02'),
(267, 'New course topic 2 related Academic->HSC->Physics Bundle', 'new-course-topic-2-related-academic-hsc-physics-bundle', 33, 11, 1, 0, '2022-01-03 13:49:44', '2022-01-03 13:49:44'),
(268, 'New course topic 3 related Academic->HSC->Physics Bundle Edited', 'new-course-topic-3-related-academic-hsc-physics-bundle', 33, 11, 1, 0, '2022-01-04 06:26:24', '2022-01-04 06:28:07'),
(269, 'Arithmetic 1', 'c3219e5d-59f5-4487-9c92-e6c9d879720a', 39, 15, 1, 0, '2022-01-26 05:09:39', '2022-01-26 05:09:39'),
(270, 'Arithmetic 2', '27413bf7-9c9e-4a6f-b561-cc81f0db5537', 39, 15, 1, 0, '2022-01-26 12:12:09', '2022-01-26 12:12:09'),
(277, 'AAA Course Topic 1', 'f3cb07d0-c452-4323-ab88-54d78e66c1dc', 44, 19, 1, 0, '2022-02-06 05:20:15', '2022-02-06 05:20:15'),
(278, 'AAA Course Topic 2', '99eeda80-5350-499c-ae80-d62ed1224000', 44, 19, 1, 0, '2022-02-06 05:22:01', '2022-02-06 05:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `cq_exam_papers`
--

CREATE TABLE `cq_exam_papers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `exam_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creative_question_id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `submitted_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submitted_pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checked_paper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `creative_questions`
--

CREATE TABLE `creative_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `creative_question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `standard_ans_pdf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `c_q_s`
--

CREATE TABLE `c_q_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marks` int(11) NOT NULL,
  `creative_question_id` bigint(20) UNSIGNED NOT NULL,
  `number_of_attempt` int(11) NOT NULL,
  `gain_marks` int(11) NOT NULL,
  `success_rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `details_results`
--

CREATE TABLE `details_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `exam_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `gain_marks` int(11) NOT NULL,
  `mcq_ans` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `details_results`
--

INSERT INTO `details_results` (`id`, `exam_id`, `exam_type`, `question_id`, `batch_id`, `student_id`, `gain_marks`, `mcq_ans`, `status`, `created_at`, `updated_at`) VALUES
(19111, 190, 'MCQ', 3522, 16, 712, 1, 3, 1, '2022-01-04 13:06:41', '2022-01-04 13:06:41'),
(19112, 190, 'MCQ', 3523, 16, 712, 1, 2, 1, '2022-01-04 13:06:41', '2022-01-04 13:06:41'),
(19283, 210, 'Pop Quiz', 14, 16, 5, 0, 2, 1, '2022-01-19 12:12:01', '2022-01-19 12:12:01'),
(19284, 210, 'Pop Quiz', 13, 16, 5, 1, 4, 1, '2022-01-19 12:12:01', '2022-01-19 12:12:01'),
(19285, 210, 'Pop Quiz', 890, 16, 5, 1, NULL, 1, '2022-01-19 12:14:21', '2022-01-19 12:14:21'),
(19286, 210, 'Pop Quiz', 891, 16, 5, 2, NULL, 1, '2022-01-19 12:14:21', '2022-01-19 12:14:21'),
(19287, 210, 'Pop Quiz', 892, 16, 5, 3, NULL, 1, '2022-01-19 12:14:21', '2022-01-19 12:14:21'),
(19288, 210, 'Pop Quiz', 893, 16, 5, 1, NULL, 1, '2022-01-19 12:14:21', '2022-01-19 12:14:21'),
(19289, 210, 'Pop Quiz', 910, 16, 5, 1, NULL, 1, '2022-01-19 12:14:21', '2022-01-19 12:14:21'),
(19290, 210, 'Pop Quiz', 911, 16, 5, 2, NULL, 1, '2022-01-19 12:14:21', '2022-01-19 12:14:21'),
(19291, 210, 'Pop Quiz', 912, 16, 5, 1, NULL, 1, '2022-01-19 12:14:22', '2022-01-19 12:14:22'),
(19292, 210, 'Pop Quiz', 913, 16, 5, 2, NULL, 1, '2022-01-19 12:14:22', '2022-01-19 12:14:22'),
(19293, 210, 'Pop Quiz', 13, 16, 6, 0, 1, 1, '2022-01-23 12:37:43', '2022-01-23 12:37:43'),
(19294, 210, 'Pop Quiz', 14, 16, 6, 0, 4, 1, '2022-01-23 12:37:43', '2022-01-23 12:37:43'),
(19297, 211, 'Pop Quiz', 20, 16, 5, 1, 1, 1, '2022-01-24 11:17:21', '2022-01-24 11:17:21'),
(19298, 211, 'Pop Quiz', 21, 16, 5, 1, 2, 1, '2022-01-24 11:17:21', '2022-01-24 11:17:21'),
(19299, 211, 'Pop Quiz', 914, 16, 5, 1, NULL, 1, '2022-01-24 11:25:45', '2022-01-24 11:25:45'),
(19300, 211, 'Pop Quiz', 915, 16, 5, 2, NULL, 1, '2022-01-24 11:25:46', '2022-01-24 11:25:46'),
(19301, 211, 'Pop Quiz', 916, 16, 5, 2, NULL, 1, '2022-01-24 11:25:46', '2022-01-24 11:25:46'),
(19302, 211, 'Pop Quiz', 917, 16, 5, 3, NULL, 1, '2022-01-24 11:25:46', '2022-01-24 11:25:46'),
(19309, 212, 'Topic End Exam', 21, 16, 5, 0, 1, 1, '2022-01-24 12:53:21', '2022-01-24 12:53:21'),
(19310, 212, 'Topic End Exam', 20, 16, 5, 1, 1, 1, '2022-01-24 12:53:21', '2022-01-24 12:53:21'),
(19311, 212, 'Topic End Exam', 914, 16, 5, 1, NULL, 1, '2022-01-24 13:05:32', '2022-01-24 13:05:32'),
(19312, 212, 'Topic End Exam', 915, 16, 5, 1, NULL, 1, '2022-01-24 13:05:32', '2022-01-24 13:05:32'),
(19313, 212, 'Topic End Exam', 916, 16, 5, 2, NULL, 1, '2022-01-24 13:05:33', '2022-01-24 13:05:33'),
(19314, 212, 'Topic End Exam', 917, 16, 5, 2, NULL, 1, '2022-01-24 13:05:33', '2022-01-24 13:05:33'),
(19315, 212, 'Topic End Exam', 21, 16, 6, 0, 1, 1, '2022-01-25 06:45:48', '2022-01-25 06:45:48'),
(19316, 212, 'Topic End Exam', 20, 16, 6, 0, 2, 1, '2022-01-25 06:45:48', '2022-01-25 06:45:48'),
(19317, 212, 'Topic End Exam', 914, 16, 6, 1, NULL, 1, '2022-01-25 06:46:46', '2022-01-25 06:46:46'),
(19318, 212, 'Topic End Exam', 915, 16, 6, 1, NULL, 1, '2022-01-25 06:46:46', '2022-01-25 06:46:46'),
(19319, 212, 'Topic End Exam', 916, 16, 6, 1, NULL, 1, '2022-01-25 06:46:47', '2022-01-25 06:46:47'),
(19320, 212, 'Topic End Exam', 917, 16, 6, 1, NULL, 1, '2022-01-25 06:46:47', '2022-01-25 06:46:47'),
(19321, 210, 'Pop Quiz', 890, 16, 6, 1, NULL, 1, '2022-01-25 06:53:03', '2022-01-25 06:53:03'),
(19322, 210, 'Pop Quiz', 891, 16, 6, 1, NULL, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(19323, 210, 'Pop Quiz', 892, 16, 6, 1, NULL, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(19324, 210, 'Pop Quiz', 893, 16, 6, 1, NULL, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(19325, 210, 'Pop Quiz', 910, 16, 6, 1, NULL, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(19326, 210, 'Pop Quiz', 911, 16, 6, 1, NULL, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(19327, 210, 'Pop Quiz', 912, 16, 6, 1, NULL, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(19328, 210, 'Pop Quiz', 913, 16, 6, 1, NULL, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(19375, 213, 'Aptitude Test', 3533, 18, 5, 0, 2, 1, '2022-01-26 10:42:16', '2022-01-26 10:42:16'),
(19376, 213, 'Aptitude Test', 3534, 18, 5, 0, 1, 1, '2022-01-26 10:42:16', '2022-01-26 10:42:16'),
(19389, 214, 'Pop Quiz', 22, 18, 5, 1, 1, 1, '2022-01-26 11:32:39', '2022-01-26 11:32:39'),
(19390, 214, 'Pop Quiz', 23, 18, 5, 1, 2, 1, '2022-01-26 11:32:39', '2022-01-26 11:32:39'),
(19391, 214, 'Pop Quiz', 918, 18, 5, 1, NULL, 1, '2022-01-26 11:33:11', '2022-01-26 11:33:11'),
(19392, 214, 'Pop Quiz', 919, 18, 5, 2, NULL, 1, '2022-01-26 11:33:11', '2022-01-26 11:33:11'),
(19393, 214, 'Pop Quiz', 920, 18, 5, 3, NULL, 1, '2022-01-26 11:33:11', '2022-01-26 11:33:11'),
(19394, 214, 'Pop Quiz', 921, 18, 5, 3, NULL, 1, '2022-01-26 11:33:11', '2022-01-26 11:33:11'),
(19395, 214, 'Pop Quiz', 922, 18, 5, 1, NULL, 1, '2022-01-26 11:33:12', '2022-01-26 11:33:12'),
(19396, 214, 'Pop Quiz', 923, 18, 5, 2, NULL, 1, '2022-01-26 11:33:12', '2022-01-26 11:33:12'),
(19397, 214, 'Pop Quiz', 924, 18, 5, 2, NULL, 1, '2022-01-26 11:33:12', '2022-01-26 11:33:12'),
(19398, 214, 'Pop Quiz', 925, 18, 5, 3, NULL, 1, '2022-01-26 11:33:13', '2022-01-26 11:33:13'),
(19419, 229, 'Aptitude Test', 3542, 21, 6, 1, 3, 1, '2022-02-06 07:13:35', '2022-02-06 07:13:35'),
(19420, 229, 'Aptitude Test', 3540, 21, 6, 1, 1, 1, '2022-02-06 07:13:36', '2022-02-06 07:13:36'),
(19421, 229, 'Aptitude Test', 3542, 21, 5, 1, 3, 1, '2022-02-06 12:43:20', '2022-02-06 12:43:20'),
(19422, 229, 'Aptitude Test', 3540, 21, 5, 1, 1, 1, '2022-02-06 12:43:20', '2022-02-06 12:43:20'),
(19423, 230, 'Pop Quiz', 32, 21, 5, 1, 2, 1, '2022-02-07 04:48:53', '2022-02-07 04:48:53'),
(19424, 230, 'Pop Quiz', 31, 21, 5, 1, 1, 1, '2022-02-07 04:48:53', '2022-02-07 04:48:53'),
(19425, 230, 'Pop Quiz', 946, 21, 5, 1, NULL, 1, '2022-02-07 04:52:14', '2022-02-07 04:52:14'),
(19426, 230, 'Pop Quiz', 947, 21, 5, 2, NULL, 1, '2022-02-07 04:52:14', '2022-02-07 04:52:14'),
(19427, 230, 'Pop Quiz', 948, 21, 5, 1, NULL, 1, '2022-02-07 04:52:14', '2022-02-07 04:52:14'),
(19428, 230, 'Pop Quiz', 949, 21, 5, 3, NULL, 1, '2022-02-07 04:52:14', '2022-02-07 04:52:14'),
(19429, 230, 'Pop Quiz', 942, 21, 5, 1, NULL, 1, '2022-02-07 04:52:14', '2022-02-07 04:52:14'),
(19430, 230, 'Pop Quiz', 943, 21, 5, 2, NULL, 1, '2022-02-07 04:52:14', '2022-02-07 04:52:14'),
(19431, 230, 'Pop Quiz', 944, 21, 5, 2, NULL, 1, '2022-02-07 04:52:15', '2022-02-07 04:52:15'),
(19432, 230, 'Pop Quiz', 945, 21, 5, 3, NULL, 1, '2022-02-07 04:52:15', '2022-02-07 04:52:15'),
(19433, 233, 'Aptitude Test', 3545, 21, 5, 0, 3, 1, '2022-02-07 06:53:51', '2022-02-07 06:53:51'),
(19434, 233, 'Aptitude Test', 3543, 21, 5, 1, 1, 1, '2022-02-07 06:53:51', '2022-02-07 06:53:51'),
(19435, 233, 'Aptitude Test', 3544, 21, 5, 1, 2, 1, '2022-02-07 06:53:51', '2022-02-07 06:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` bigint(20) UNSIGNED DEFAULT NULL,
  `exam_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `special` tinyint(1) DEFAULT NULL,
  `marks` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `question_limit` int(11) DEFAULT NULL,
  `question_limit_2` int(10) UNSIGNED DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `threshold_marks` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `title`, `slug`, `course_id`, `topic_id`, `exam_type`, `special`, `marks`, `duration`, `question_limit`, `question_limit_2`, `order`, `threshold_marks`, `created_at`, `updated_at`) VALUES
(190, 'Physics Exam 1 MCQ', '6b80f46a-b2a6-46cf-a21a-f9895d4ca129', 33, 266, 'MCQ', 0, 20, 20, 20, NULL, 0, 0, '2022-01-04 10:44:04', '2022-01-04 10:49:06'),
(191, 'Physics Exam 2 CQ', '3702c8e2-9745-4cdf-9e39-54f73ddd212f', 33, 266, 'CQ', NULL, 100, 300, 10, NULL, 0, 0, '2022-01-04 10:50:02', '2022-01-04 10:50:02'),
(192, 'Physics Assignment 3', 'a99f69de-306a-4ef1-8dcb-e9617c98045b', 33, 266, 'Assignment', 0, 20, 1440, 0, NULL, 0, 0, '2022-01-04 10:54:23', '2022-01-04 10:54:23'),
(193, 'Physics Exam 4 Special', '1fc3ae2c-73cc-4071-a320-d1afc3d935a2', 33, NULL, 'MCQ', 1, 10, 10, 10, NULL, 0, 0, '2022-01-04 13:13:33', '2022-01-04 13:13:33'),
(194, 'Test 1', 'c4d41070-e7ab-420b-8fa7-a0f0058e4e99', 33, 266, 'MCQ', NULL, 10, 10, 10, NULL, 0, 0, '2022-01-05 04:46:10', '2022-01-05 04:46:10'),
(196, 'Test 2 CQ', '03edcf3c-d96d-4c77-856b-372272ea9dfd', 33, 266, 'CQ', NULL, 100, 300, 10, NULL, 0, 0, '2022-01-05 04:49:49', '2022-01-05 04:49:49'),
(197, 'ASSignemnt Est aspernatur quam ', 'ddc56767-d26e-46c3-a1cc-c4f8c759ef83', 33, 266, 'Assignment', 0, 10, 1440, 0, NULL, 0, 0, '2022-01-05 10:15:40', '2022-01-05 10:15:55'),
(229, 'AAA Aptitude Test', 'fde71b70-6c21-4526-ba65-d83e77abcce8', 44, 277, 'Aptitude Test', NULL, 2, 2, 2, NULL, 2, 1, '2022-02-06 06:03:42', '2022-02-06 06:03:42'),
(230, 'AAA Island 1 Pop Quiz 1', 'ecb295f6-c6bc-43d7-a9f6-ec6c8ee8391c', 44, 277, 'Pop Quiz', NULL, 10, 10, 5, NULL, 1, 5, '2022-02-06 06:15:40', '2022-02-06 06:15:40'),
(231, 'AAA Topic End Exam 1', '563897e0-c78e-4a1a-b699-a021ca0e5551', 44, 277, 'Topic End Exam', NULL, 10, 20, 10, NULL, 6, 5, '2022-02-06 10:48:13', '2022-02-06 10:48:13'),
(232, 'AAA Course Topic 2 Pop Quiz 1', '4e72dee6-d1e6-4383-a8be-c21c4b70a9f1', 44, 278, 'Pop Quiz', NULL, 10, 30, 5, NULL, 5, 5, '2022-02-07 06:04:24', '2022-02-07 11:39:25'),
(233, 'AAA Course Topic 2 Aptitude Test', 'dd40e605-85d7-4d4a-912c-63eb6ff5a0ce', 44, 278, 'Aptitude Test', NULL, 2, 2, 2, NULL, 1, 2, '2022-02-07 06:25:41', '2022-02-07 06:25:41'),
(234, 'AAA Course Topic 2 Pop Quiz 2', '84f7c2d5-65a4-4544-86f3-641c08520d9e', 44, 278, 'Pop Quiz', NULL, 10, 2, 3, 2, 12, 5, '2022-02-07 11:19:59', '2022-02-07 11:39:32');

-- --------------------------------------------------------

--
-- Table structure for table `exam_papers`
--

CREATE TABLE `exam_papers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `exam_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `submitted_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submitted_pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checked_paper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `exam_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `gain_marks` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `checked` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`id`, `exam_id`, `exam_type`, `batch_id`, `student_id`, `gain_marks`, `status`, `checked`, `created_at`, `updated_at`) VALUES
(650, 190, NULL, 16, 712, 2, 1, NULL, '2022-01-04 13:06:24', '2022-01-04 13:06:42'),
(764, 210, 'Pop Quiz MCQ', 16, 5, 1, 1, NULL, '2022-01-19 12:12:01', '2022-01-19 12:12:01'),
(765, 210, 'Pop Quiz CQ', 16, 5, 13, 1, 1, '2022-01-19 12:12:02', '2022-01-19 12:14:22'),
(766, 210, 'Pop Quiz MCQ', 16, 6, 0, 1, NULL, '2022-01-23 12:37:43', '2022-01-23 12:37:43'),
(767, 210, 'Pop Quiz CQ', 16, 6, 8, 1, 1, '2022-01-23 12:37:44', '2022-01-25 06:53:05'),
(770, 211, 'Pop Quiz MCQ', 16, 5, 2, 1, NULL, '2022-01-24 11:17:21', '2022-01-24 11:17:21'),
(771, 211, 'Pop Quiz CQ', 16, 5, 8, 1, 1, '2022-01-24 11:17:21', '2022-01-24 11:25:46'),
(774, 212, 'Topic End Exam MCQ', 16, 5, 1, 1, NULL, '2022-01-24 12:53:21', '2022-01-24 12:53:21'),
(775, 212, 'Topic End Exam CQ', 16, 5, 6, 1, 1, '2022-01-24 12:53:21', '2022-01-24 13:05:33'),
(776, 212, 'Topic End Exam MCQ', 16, 6, 0, 1, NULL, '2022-01-25 06:45:48', '2022-01-25 06:45:48'),
(777, 212, 'Topic End Exam CQ', 16, 6, 4, 1, 1, '2022-01-25 06:45:49', '2022-01-25 06:46:47'),
(792, 213, 'Aptitude Test', 18, 5, 0, 1, NULL, '2022-01-26 10:42:11', '2022-01-26 10:42:16'),
(797, 214, 'Pop Quiz MCQ', 18, 5, 2, 1, NULL, '2022-01-26 11:32:39', '2022-01-26 11:32:39'),
(798, 214, 'Pop Quiz CQ', 18, 5, 17, 1, 1, '2022-01-26 11:32:40', '2022-01-26 11:33:13'),
(807, 229, 'Aptitude Test', 21, 6, 2, 1, NULL, '2022-02-06 06:46:27', '2022-02-06 07:13:36'),
(808, 229, 'Aptitude Test', 21, 5, 2, 1, NULL, '2022-02-06 11:11:12', '2022-02-06 12:43:20'),
(809, 230, 'Pop Quiz MCQ', 21, 5, 2, 1, NULL, '2022-02-07 04:48:53', '2022-02-07 04:48:53'),
(810, 230, 'Pop Quiz CQ', 21, 5, 15, 1, 1, '2022-02-07 04:48:53', '2022-02-07 04:52:15'),
(811, 233, 'Aptitude Test', 21, 5, 2, 1, NULL, '2022-02-07 06:53:33', '2022-02-07 06:53:51');

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
-- Table structure for table `image_uploads`
--

CREATE TABLE `image_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_uploads`
--

INSERT INTO `image_uploads` (`id`, `image`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, '/storage/uploadImages/CcmpNT46fxk56uqiBtcBzSCJpHpymmE2e57svQiu.jpg', NULL, NULL, '2021-11-27 12:44:11', '2021-11-27 12:44:11'),
(2, '/storage/uploadImages/xTkNowK5oorMIE76eBEVkqIOgi4Pydn9sieJcKo9.jpg', NULL, 'bb4616b9-c89b-487e-92fe-99e2fb626b03', '2021-11-27 12:55:31', '2021-11-27 12:55:31'),
(3, '/storage/uploadImages/SQrsAVdn25NxlDM2l3LRH686SUqofdxeSc3XGcYN.jpg', NULL, '9505f18e-dadc-47bd-be08-aa943a92b0c7', '2021-11-27 12:55:41', '2021-11-27 12:55:41'),
(4, '/storage/uploadImages/UDWxNW9EKtOX2GrHZHpWobL74DvgXP8b6FApB0Ao.jpg', NULL, '112918f1-c30e-4712-9f23-d6292afe853f', '2021-11-27 12:55:52', '2021-11-27 12:55:52'),
(5, '/storage/uploadImages/uhaTYL2dljtMLsFRKLTwLdQ9IG54DUrpRhqHvAIa.jpg', NULL, '88a8c1d3-8c3a-4177-883a-c00e7b1a1b9f', '2021-11-27 12:56:10', '2021-11-27 12:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `intermediary_levels`
--

CREATE TABLE `intermediary_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `intermediary_levels`
--

INSERT INTO `intermediary_levels` (`id`, `course_category_id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 'New intermediary level 1 related to course category 1', 'new-intermediary-level-1', 1, '2021-12-29 09:16:39', '2021-12-30 09:04:58'),
(2, 6, 'New intermediary level 2 related to course category 1', 'new-intermediary-level-2', 1, '2021-12-29 09:16:39', '2021-12-30 04:32:00'),
(3, 6, 'New intermediary level 3 related to course category 1', 'new-intermediary-level-3', 1, '2021-12-29 09:16:39', '2021-12-30 09:05:00'),
(4, 7, 'New intermediary level 4 related to course category 2', 'new-intermediary-level-4', 1, '2021-12-29 09:16:39', '2021-12-30 04:31:54'),
(5, 7, 'New intermediary level 5 related to course category 2', 'new-intermediary-level-5', 1, '2021-12-29 09:16:39', '2021-12-30 04:32:00'),
(7, 7, 'New intermediary level 6 related to course category 2', 'new-intermediary-level-6-related-to-course-category-2', 1, '2021-12-30 10:37:34', '2021-12-30 10:37:34'),
(8, 7, 'New intermediary level 7 related to course category 2 no boiii', 'new-intermediary-level-7-related-to-course-category-2-no-boiii', 0, '2021-12-30 10:56:02', '2021-12-30 12:34:24'),
(9, 6, 'New intermediary level 8 related to course category 1', 'new-intermediary-level-8-related-to-course-category-1', 1, '2021-12-30 10:57:50', '2021-12-30 10:57:50'),
(11, 8, 'HSC', 'hsc', 1, '2022-01-02 10:12:23', '2022-01-02 10:12:23'),
(12, 9, 'BUET', 'buet', 1, '2022-01-02 10:12:40', '2022-01-02 10:12:40'),
(13, 8, 'SSC', 'ssc', 1, '2022-01-02 10:27:15', '2022-01-02 10:27:15'),
(14, 9, 'DU', 'du', 1, '2022-01-02 10:27:30', '2022-01-02 10:27:30'),
(15, 12, 'Test Intermediary Level 1', 'test-intermediary-level-1', 1, '2022-01-26 05:02:02', '2022-01-26 05:08:00'),
(19, 15, 'AAA Intermediary Level 1', 'aaa-intermediary-level-1', 1, '2022-02-06 05:18:10', '2022-02-06 05:18:10'),
(20, 15, 'AAA Intermediary Level 2', 'aaa-intermediary-level-2', 1, '2022-02-06 05:18:23', '2022-02-06 05:18:23');

-- --------------------------------------------------------

--
-- Table structure for table `live_classes`
--

CREATE TABLE `live_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` bigint(20) UNSIGNED DEFAULT NULL,
  `live_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `start_date` date NOT NULL,
  `show_link_limit_time` time DEFAULT NULL,
  `is_always_show` tinyint(1) DEFAULT NULL,
  `is_special` tinyint(1) DEFAULT NULL,
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
(16, '2021_01_31_121105_create_exams_table', 1),
(17, '2021_01_31_210901_create_batch_exams_table', 1),
(18, '2021_01_31_215913_create_student_exam_attempts_table', 1),
(19, '2021_02_01_104834_create_creative_questions_table', 1),
(20, '2021_02_01_104835_create_c_q_s_table', 1),
(21, '2021_02_01_105343_create_m_c_q_s_table', 1),
(22, '2021_02_11_110617_create_assignments_table', 1),
(23, '2021_02_22_172158_create_student_details_table', 1),
(24, '2021_03_04_155158_create_notifications_table', 1),
(25, '2021_03_16_122012_create_question_content_tags_table', 1),
(26, '2021_03_17_143859_create_exam_results_table', 1),
(27, '2021_03_17_144252_create_details_results_table', 1),
(28, '2021_03_17_144443_create_question_content_tag_analyses_table', 1),
(29, '2021_03_17_144525_create_exam_papers_table', 1),
(30, '2021_04_04_114203_create_payment_numbers_table', 1),
(31, '2021_05_12_124737_create_image_uploads_table', 1),
(32, '2021_10_13_190925_create_cq_exam_papers_table', 1),
(33, '2021_10_18_204524_add_checked_papers_to_exam_paper_table', 1),
(34, '2021_10_18_210808_create_blogs_table', 1),
(35, '2021_10_24_185848_add_batch_rank_to_batch_student_enrollment', 1),
(36, '2021_11_10_210330_drop_columns_from_live_class_table', 2),
(37, '2021_11_13_175628_add_banner_meta_tag_to_blog', 2),
(38, '2021_11_21_183352_add_pdf_to_lecture_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `m_c_q_s`
--

CREATE TABLE `m_c_q_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field1` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field2` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field3` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field4` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` int(11) NOT NULL,
  `explanation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `number_of_attempt` int(11) NOT NULL,
  `gain_marks` int(11) NOT NULL,
  `success_rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_c_q_s`
--

INSERT INTO `m_c_q_s` (`id`, `question`, `slug`, `image`, `field1`, `field2`, `field3`, `field4`, `answer`, `explanation`, `exam_id`, `number_of_attempt`, `gain_marks`, `success_rate`, `created_at`, `updated_at`) VALUES
(3522, '<p>What is Doge ??</p>', 'bcb7dfef-3b81-4eb4-8ce6-0da585c074e3', '/storage/question/mcq/rUw0hOklQS8hgAWKtPhZiqwyhY9hoygXkxbbXFI1.jpg', 'A dog', 'A meme', '<p>A shibe</p>', 'Not important', 3, NULL, 190, 1, 1, 100, '2022-01-04 11:39:26', '2022-01-04 13:06:41'),
(3523, '<p>What is Cate HECC ??</p>', '364ba162-12be-4b0e-8de0-c1042a3a37fa', '/storage/question/mcq/jwilpJklwmfRBpLdWBjtzBtkXXnEvqPaCMeyB5F1.jpg', '<p>A cat</p>', '<p>Doge\'s arch enemy</p>', '<p>Purrfect</p>', '<p>meow ??</p>', 2, NULL, 190, 1, 1, 100, '2022-01-04 11:57:38', '2022-01-06 06:07:06'),
(3524, '<p>Are you Speical boi ??</p>', 'b14445d1-7a2b-4aa9-8696-1b2cf0a2f91d', NULL, '<p>Only Doge is special</p>', '<p>Yes<br></p>', '<p>No</p>', '<p>Maybe</p>', 1, NULL, 193, 0, 0, 0, '2022-01-04 13:14:48', '2022-01-04 13:14:48'),
(3525, '<p>THis is a question</p>', '10cf3c0c-7c2b-47e0-b1ab-ef46b4764914', NULL, '<p>is this ??&nbsp;&nbsp;&nbsp;&nbsp;</p>', '<p>yes</p>', '<p>no</p>', '<p>maybe</p>', 1, NULL, 194, 0, 0, 0, '2022-01-05 04:46:49', '2022-01-05 04:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('akiffaiaz@gmail.com', '$2y$10$UvfaREMTodJ5kZK.YflQFOdEwD9p.tjuS9xkazY3vfyU7ri9TopEW', '2021-11-04 09:48:57'),
('minhazmahin761@gmail.com', '$2y$10$y87V3NuFHfzAuooQ28AhGOuGuCSl5jh4oz3s/Qi5KxMqoH5ND9nRO', '2021-11-09 06:17:02'),
('jnaima561@gmail.com', '$2y$10$JZrU0iQJZBEutoFt6jA.lujNSrbVZhl2jzx26nxpcMR9hUk2Tsacm', '2021-11-09 06:38:09'),
('hasanmdmamun282@gmail.com', '$2y$10$cc7ZHS5kSmAe.4EsVuUTWe4KwfGQFto0Bc5Ko6TvKwO.g0D/qlRQG', '2021-11-22 09:11:08'),
('huraynejannatafroz@gmail.com', '$2y$10$C9jUU8G03okhhUs0vepzE.s29e/01jo5QRyU0UrtBnVxRHO4tWMeS', '2021-11-27 19:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trx_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `days_for` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `student_id`, `course_id`, `batch_id`, `name`, `email`, `contact`, `trx_id`, `payment_type`, `amount`, `payment_account_number`, `days_for`, `accepted`, `created_at`, `updated_at`) VALUES
(564, 712, 33, 16, 'Test', 'nikisa7762@iistoria.com', '01951254193', 'FREE', 'FREE', 0, '0', 365, 1, '2022-01-04 13:04:00', '2022-01-04 13:04:00'),
(565, 5, 33, 16, 'Student', 'student@app.com', '01621343444', 'FREE', 'FREE', 0, '0', 365, 1, '2022-01-12 04:46:10', '2022-01-12 04:46:10'),
(566, 6, 33, 16, 'Student2', 'student2@app.com', '01821343444', 'FREE', 'FREE', 0, '0', 365, 1, '2022-01-23 12:37:22', '2022-01-23 12:37:22'),
(567, 5, 39, 18, 'Student', 'student@app.com', '01621343444', 'FREE', 'FREE', 0, '0', 365, 1, '2022-01-26 05:19:54', '2022-01-26 05:19:54'),
(569, 6, 33, 16, 'Student2', 'student2@app.com', '01821343444', 'FREE', 'FREE', 0, '0', 365, 1, '2022-02-05 06:11:17', '2022-02-05 06:11:17'),
(572, 5, 44, 21, 'Student', 'student@app.com', '01621343444', 'FREE', 'FREE', 0, '0', 365, 1, '2022-02-06 06:12:48', '2022-02-06 06:12:48'),
(573, 6, 44, 21, 'Student2', 'student2@app.com', '01821343444', 'FREE', 'FREE', 0, '0', 365, 1, '2022-02-06 06:36:06', '2022-02-06 06:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `payment_numbers`
--

CREATE TABLE `payment_numbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bkash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nogod` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rocket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pop_quiz_cqs`
--

CREATE TABLE `pop_quiz_cqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marks` int(11) NOT NULL,
  `creative_question_id` bigint(20) UNSIGNED NOT NULL,
  `number_of_attempt` int(11) NOT NULL,
  `gain_marks` int(11) NOT NULL,
  `success_rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pop_quiz_cqs`
--

INSERT INTO `pop_quiz_cqs` (`id`, `question`, `slug`, `image`, `marks`, `creative_question_id`, `number_of_attempt`, `gain_marks`, `success_rate`, `created_at`, `updated_at`) VALUES
(890, 'Voluptatem incidunt.fds&nbsp;&nbsp;Edited<span style=\"color: rgb(33, 37, 41); background-color: rgba(0, 0, 0, 0.05);\">&nbsp;Edited</span>', '69abd277-6f44-43ab-9d7b-8532bc6f3cc6', NULL, 1, 226, 9, 9, 100, '2022-01-08 12:58:47', '2022-01-25 06:53:03'),
(891, 'Magni quam nulla qui.dg h&nbsp;Edited<span style=\"color: rgb(33, 37, 41); background-color: rgba(0, 0, 0, 0.05);\">&nbsp;Edited</span>', '5788ed5a-6ffd-443d-afbc-b48b50908685', NULL, 2, 226, 9, 17, 94, '2022-01-08 12:58:47', '2022-01-25 06:53:04'),
(892, 'Aperiam consequatur . gfh&nbsp;Edited<span style=\"color: rgb(33, 37, 41); background-color: rgba(0, 0, 0, 0.05);\">&nbsp;Edited</span>', 'a318610c-8c1a-4ec8-bd97-6d0cd62c317b', NULL, 3, 226, 9, 23, 85, '2022-01-08 12:58:47', '2022-01-25 06:53:04'),
(893, 'Non corrupti, nihil . gh&nbsp;Edited<span style=\"color: rgb(33, 37, 41); background-color: rgba(0, 0, 0, 0.05);\">&nbsp;Edited</span>', 'bde8bf0a-c0a8-472b-9f86-3a00b00a204c', NULL, 4, 226, 9, 13, 36, '2022-01-08 12:58:47', '2022-01-25 06:53:04'),
(910, 'Pop Quiz CQ question 2', '92abfa13-4ac5-49c2-ada9-30db6b538687', NULL, 1, 231, 8, 8, 100, '2022-01-18 11:05:57', '2022-01-25 06:53:04'),
(911, 'Pop Quiz CQ question 2', '4eba8302-13d1-46e3-b93f-7ab6188ece79', NULL, 2, 231, 8, 14, 88, '2022-01-18 11:05:57', '2022-01-25 06:53:04'),
(912, 'Pop Quiz CQ question 2', '5378f66a-282d-4f61-a921-c676d5b32f6d', NULL, 3, 231, 8, 10, 42, '2022-01-18 11:05:57', '2022-01-25 06:53:04'),
(913, 'Pop Quiz CQ question 2', '71b8246f-bb88-4691-9ad7-5d80ee6fd282', NULL, 4, 231, 8, 13, 41, '2022-01-18 11:05:57', '2022-01-25 06:53:04'),
(914, '<p>CQ Sub Question 1<br></p>', 'd4c6cd09-472c-4f90-bc46-c262c0c6c341', NULL, 1, 232, 1, 1, 100, '2022-01-24 10:05:18', '2022-01-24 11:25:45'),
(915, '<p>CQ Sub Question 2<br></p>', '64fc9191-2497-42c0-a23c-73b8f480d43d', NULL, 2, 232, 1, 2, 100, '2022-01-24 10:05:18', '2022-01-24 11:25:46'),
(916, '<p>CQ Sub Question 3<br></p>', 'ee74dbef-f7a2-4638-b1e2-65304d62af8b', NULL, 3, 232, 1, 2, 67, '2022-01-24 10:05:18', '2022-01-24 11:25:46'),
(917, '<p>CQ Sub Question 4<br></p>', 'a9757bf0-4154-4d43-a3d7-8863fcaa90df', NULL, 4, 232, 1, 3, 75, '2022-01-24 10:05:18', '2022-01-24 11:25:46'),
(918, '<p>Pop Quiz New CQ 1<br></p>', 'e5df6010-8356-4293-845a-1172b86cfb63', NULL, 1, 233, 5, 5, 100, '2022-01-26 05:26:36', '2022-01-26 11:33:11'),
(919, '<p>Pop Quiz New CQ 2<br></p>', 'c532ebdc-78b6-46d7-a8d5-038b555fd369', NULL, 2, 233, 5, 9, 90, '2022-01-26 05:26:36', '2022-01-26 11:33:11'),
(920, '<p>Pop Quiz New CQ 3<br></p>', 'd744c934-ef01-4b54-9d4f-ffce24b6807b', NULL, 3, 233, 5, 13, 87, '2022-01-26 05:26:36', '2022-01-26 11:33:11'),
(921, '<p>Pop Quiz New CQ 4<br></p>', '66477c9f-e055-444d-b9c7-a39c01d15c22', NULL, 4, 233, 5, 17, 85, '2022-01-26 05:26:36', '2022-01-26 11:33:11'),
(922, '<p>Pop Quiz New CQ 1<br></p>', '0d371f23-bd40-42e8-bbf3-b2e2055e1e4c', NULL, 1, 234, 5, 5, 100, '2022-01-26 05:27:28', '2022-01-26 11:33:12'),
(923, '<p>Pop Quiz New CQ 2<br></p>', '3fffa7f4-b8f4-4ae1-8813-fbdbba62df97', NULL, 2, 234, 5, 9, 90, '2022-01-26 05:27:28', '2022-01-26 11:33:12'),
(924, '<p>Pop Quiz New CQ 3<br></p>', 'de365311-9783-4f61-b7e1-8bb70b1aa227', NULL, 3, 234, 5, 11, 73, '2022-01-26 05:27:28', '2022-01-26 11:33:12'),
(925, '<p>Pop Quiz New CQ 4<br></p>', 'e4174c1c-4055-4298-9eb5-f82af94c734b', NULL, 4, 234, 5, 14, 70, '2022-01-26 05:27:28', '2022-01-26 11:33:13'),
(926, '<p>Pop Quiz CQ 1 for Arithmetic 2<br></p>', '6781ee9b-045f-4d98-bb71-71cf6b668b9a', NULL, 1, 235, 0, 0, 0, '2022-01-26 12:23:35', '2022-01-26 12:23:35'),
(927, '<p>Pop Quiz CQ 2 for Arithmetic 2<br></p>', 'd0e8ddf9-29b4-4f3d-b124-bb21befa65dc', NULL, 2, 235, 0, 0, 0, '2022-01-26 12:23:35', '2022-01-26 12:23:35'),
(928, '<p>Pop Quiz CQ 3 for Arithmetic 2<br></p>', '6c2816ea-33b8-4f3d-a6cb-3665c98ca10c', NULL, 3, 235, 0, 0, 0, '2022-01-26 12:23:35', '2022-01-26 12:23:35'),
(929, '<p>Pop Quiz CQ 4 for Arithmetic 2<br></p>', '4a57d2e7-ee81-416a-8681-088ed6fda1cd', NULL, 4, 235, 0, 0, 0, '2022-01-26 12:23:35', '2022-01-26 12:23:35'),
(930, '<p>AAA Pop Quiz CQ 1<br></p>', 'ea195c9e-4b7b-4e70-97bc-c0ad375221e9', NULL, 1, 236, 1, 1, 100, '2022-01-27 05:39:26', '2022-01-27 12:59:57'),
(931, '<p>AAA Pop Quiz CQ 2<br></p>', 'a2d34ce5-a6a1-4cfb-8f65-ba729da5c0ba', NULL, 2, 236, 1, 1, 50, '2022-01-27 05:39:26', '2022-01-27 12:59:57'),
(932, '<p>AAA Pop Quiz CQ 3<br></p>', '9f759d8c-969b-46a9-ad75-fa3127a0aed5', NULL, 3, 236, 1, 2, 67, '2022-01-27 05:39:26', '2022-01-27 12:59:57'),
(933, '<p>AAA Pop Quiz CQ 4<br></p>', '195084a1-9ded-42ba-b017-17bec00aa494', NULL, 4, 236, 1, 3, 75, '2022-01-27 05:39:26', '2022-01-27 12:59:57'),
(934, '<p>AAA Pop Quiz CQ 1<br></p>', '6b682872-6efb-4cc1-9647-1563d1555f60', NULL, 1, 237, 1, 1, 100, '2022-01-27 05:40:13', '2022-01-27 12:59:56'),
(935, '<p>AAA Pop Quiz CQ 2<br></p>', 'e501726a-5553-47e1-8789-64fee9b403f7', NULL, 2, 237, 1, 2, 100, '2022-01-27 05:40:13', '2022-01-27 12:59:56'),
(936, '<p>AAA Pop Quiz CQ 3<br></p>', '3d159181-c27e-4c2a-90c8-4c7bff84f771', NULL, 3, 237, 1, 2, 67, '2022-01-27 05:40:13', '2022-01-27 12:59:56'),
(937, '<p>AAA Pop Quiz CQ 4<br></p>', '2ff77af2-80a0-4c70-be38-e2593816ad20', NULL, 4, 237, 1, 1, 25, '2022-01-27 05:40:13', '2022-01-27 12:59:56'),
(938, '<p>AAA Pop Quiz 2 CQ 1<br></p>', '4d52c02f-ae9f-4874-9f08-94524e21fcde', NULL, 1, 238, 1, 1, 100, '2022-01-27 05:45:43', '2022-01-27 12:57:44'),
(939, '<p>AAA Pop Quiz 2 CQ 2<br></p>', '6e59814d-e5d7-4483-8a96-45b4332a733b', NULL, 2, 238, 1, 2, 100, '2022-01-27 05:45:43', '2022-01-27 12:57:45'),
(940, '<p>AAA Pop Quiz 2 CQ 3<br></p>', '238773b7-add8-45e4-9cbd-9f34899e34c4', NULL, 3, 238, 1, 3, 100, '2022-01-27 05:45:44', '2022-01-27 12:57:45'),
(941, '<p>AAA Pop Quiz 2 CQ 4<br></p>', '94ac0b3d-bc2c-4847-ba98-e8f4a0e91740', NULL, 4, 238, 1, 2, 50, '2022-01-27 05:45:44', '2022-01-27 12:57:45'),
(942, '<p>AAA Pop Quiz CQ 1<br></p>', '93a450c5-2b91-44c0-853c-5cf640f00c31', NULL, 1, 239, 1, 1, 100, '2022-02-06 13:27:59', '2022-02-07 04:52:14'),
(943, '<p>AAA Pop Quiz CQ 2<br></p>', 'de16dcce-5369-45bf-b4df-931cc48bf1f2', NULL, 2, 239, 1, 2, 100, '2022-02-06 13:27:59', '2022-02-07 04:52:15'),
(944, '<p>AAA Pop Quiz CQ 3<br></p>', 'fcfee2a2-e887-41e7-b21b-d6ca38452fe8', NULL, 3, 239, 1, 2, 67, '2022-02-06 13:27:59', '2022-02-07 04:52:15'),
(945, '<p>AAA Pop Quiz CQ 4<br></p>', 'ac6951a2-5c87-4889-8638-732c4672210e', NULL, 4, 239, 1, 3, 75, '2022-02-06 13:27:59', '2022-02-07 04:52:15'),
(946, '<p><span style=\"color: rgb(33, 37, 41);\">AAA Pop Quiz CQ 2</span><br></p>', 'd162c345-6cee-4773-beb4-351db79e61be', NULL, 1, 240, 1, 1, 100, '2022-02-06 13:29:15', '2022-02-07 04:52:14'),
(947, '<p><span style=\"color: rgb(33, 37, 41);\">AAA Pop Quiz CQ 2</span><br></p>', 'a814be21-29b5-484c-9137-9662648dd8f3', NULL, 2, 240, 1, 2, 100, '2022-02-06 13:29:15', '2022-02-07 04:52:14'),
(948, '<p><span style=\"color: rgb(33, 37, 41);\">AAA Pop Quiz CQ 2</span><br></p>', 'c0f71938-9470-4246-8df2-a7e84573ba59', NULL, 3, 240, 1, 1, 33, '2022-02-06 13:29:15', '2022-02-07 04:52:14'),
(949, '<p><span style=\"color: rgb(33, 37, 41);\">AAA Pop Quiz CQ 2</span><br></p>', '09fc9058-2893-4a60-aa99-985b981e7af3', NULL, 4, 240, 1, 3, 75, '2022-02-06 13:29:15', '2022-02-07 04:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `pop_quiz_cq_exam_papers`
--

CREATE TABLE `pop_quiz_cq_exam_papers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `exam_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creative_question_id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `submitted_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submitted_pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checked_paper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pop_quiz_cq_exam_papers`
--

INSERT INTO `pop_quiz_cq_exam_papers` (`id`, `exam_id`, `exam_type`, `creative_question_id`, `batch_id`, `student_id`, `submitted_text`, `submitted_pdf`, `checked_paper`, `status`, `created_at`, `updated_at`) VALUES
(61, 210, 'Pop Quiz', 226, 16, 5, 'Some adwadawd', '', NULL, 1, '2022-01-19 12:12:02', '2022-01-19 12:12:02'),
(62, 210, 'Pop Quiz', 231, 16, 5, 'Some adwadawd', '', NULL, 1, '2022-01-19 12:12:02', '2022-01-19 12:12:02'),
(63, 210, 'Pop Quiz', 226, 16, 6, 'Student 2 here. Make way !!', '', NULL, 1, '2022-01-23 12:37:43', '2022-01-23 12:37:43'),
(64, 210, 'Pop Quiz', 231, 16, 6, 'Student 2 here. Make way !!', '', NULL, 1, '2022-01-23 12:37:43', '2022-01-23 12:37:43'),
(66, 211, 'Pop Quiz', 232, 16, 5, 'Some Answer', '', NULL, 1, '2022-01-24 11:17:21', '2022-01-24 11:17:21'),
(79, 214, 'Pop Quiz', 233, 18, 5, 'Attempted Pop Quiz', '', NULL, 1, '2022-01-26 11:32:39', '2022-01-26 11:32:39'),
(80, 214, 'Pop Quiz', 234, 18, 5, 'Attempted Pop Quiz', '', NULL, 1, '2022-01-26 11:32:40', '2022-01-26 11:32:40'),
(84, 230, 'Pop Quiz', 240, 21, 5, 'plox', '', NULL, 1, '2022-02-07 04:48:53', '2022-02-07 04:48:53'),
(85, 230, 'Pop Quiz', 239, 21, 5, 'plox', '', NULL, 1, '2022-02-07 04:48:53', '2022-02-07 04:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `pop_quiz_creative_questions`
--

CREATE TABLE `pop_quiz_creative_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `creative_question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `standard_ans_pdf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pop_quiz_creative_questions`
--

INSERT INTO `pop_quiz_creative_questions` (`id`, `creative_question`, `slug`, `image`, `exam_id`, `standard_ans_pdf`, `created_at`, `updated_at`) VALUES
(226, 'Soluta repellendus. . asd Edited<span style=\"color: rgb(33, 37, 41); background-color: rgba(0, 0, 0, 0.05);\">&nbsp;Edited</span>', 'd9e68727-26dd-4c38-aa44-c9230c4350c5', NULL, 210, 'public/question/pop_quiz_cq/answer/b9q7ccDE4Kpdmwugscd0nYVCCbsqBUmUGhA72Xkp.pdf', '2022-01-08 12:58:47', '2022-01-09 13:05:31'),
(228, 'Sample Topic End CQ 1', '5f37eb2c-ac70-4d10-bc46-5162635757f6', NULL, 202, 'public/question/topic_end_exam_cq/answer/Nfbeiyz6uKVB05bG1tDB2VFTigaA7QzFUbOD1hyW.pdf', '2022-01-09 11:46:31', '2022-01-09 11:46:31'),
(229, 'Ut dolores non rerum. asdfa', '3d0abedc-eddb-4d1c-9e05-af2d45b42ef0', NULL, 202, 'public/question/topic_end_exam_cq/answer/h8JlgnwOYp18ZDwhrt6dwg1mbMJOJOkMJ0FpGLYw.pdf', '2022-01-09 11:47:09', '2022-01-09 11:47:09'),
(231, 'Pop Quiz CQ question 2', '8bd6f596-c8cc-4816-9ac2-a2273bb5c2b2', NULL, 210, 'public/question/pop_quiz_cq/answer/M77EtIm9DqNSuQB956u1fuWhI76gKqX0lqlYPpsN.pdf', '2022-01-18 11:05:57', '2022-01-18 11:05:57'),
(232, '<p>CQ Question 1</p>', '7ab484f3-aee0-4982-b291-73cdb53f031b', NULL, 211, 'public/question/pop_quiz_cq/answer/zKh8tefYiVer3CPN6pjSNIijkSc0LJfxtMVUlf24.pdf', '2022-01-24 10:05:18', '2022-01-24 10:05:18'),
(233, '<p>Pop Quiz New Creative Question 1</p>', 'a6e8c231-f2ab-4917-a9be-eac35e4bd703', NULL, 214, 'public/question/pop_quiz_cq/answer/2wKwxaVdhocJzL4X6qgCKjsgv9vXZWov1rYhZWSV.pdf', '2022-01-26 05:26:36', '2022-01-26 05:26:36'),
(234, 'Pop Quiz New Creative Question 2', 'eef9590b-ed1c-4cbf-bd94-b5ba0ea4f12d', NULL, 214, 'public/question/pop_quiz_cq/answer/2SyaKSO155bE65pSOfDbiqLMfb0e8XO0uSlPF9ux.pdf', '2022-01-26 05:27:28', '2022-01-26 05:27:28'),
(235, '<p>Pop Quiz Creative Question for Arithmetic 2</p>', '0822b802-99c4-4ddc-b59c-b01de7181bd0', NULL, 216, 'public/question/pop_quiz_cq/answer/EMr9vtMCXyLmwVuWCRRiPzdKnRbGUkEgF7IE1XCK.pdf', '2022-01-26 12:23:35', '2022-01-26 12:23:35'),
(236, '<p>AAA Pop Quiz 1 Creative Question 2</p>', '9d4e01b9-937e-45a3-8189-b8096225930f', NULL, 218, 'public/question/pop_quiz_cq/answer/M98tpn9pZACTWUjHDuoxwRuJWg5B1XRpxJfuQaef.pdf', '2022-01-27 05:39:26', '2022-01-27 12:40:09'),
(237, '<p>AAA Pop Quiz 1 Creative Question 1<br></p>', '82042bb6-8924-4424-8dd5-280ff3d7702e', NULL, 218, 'public/question/pop_quiz_cq/answer/aDX181DPOPDpr7njuSu76Sedbn6ExibP71ZAT6C4.pdf', '2022-01-27 05:40:13', '2022-01-27 05:44:01'),
(238, '<p>AAA Pop Quiz 2 Creative Question 1</p>', '01d4e1a3-3a99-4436-9e76-0be013cec0f9', NULL, 220, 'public/question/pop_quiz_cq/answer/vPvrXiQv3I29OFfsG2m0e49kfmhxMg41uol5oHQG.pdf', '2022-01-27 05:45:43', '2022-01-27 05:45:43'),
(239, 'AAA Pop Quiz Creative Question 1', 'e5af21ce-2cd0-4bbc-a7e4-e5ff7727cf5a', NULL, 230, 'public/question/pop_quiz_cq/answer/UAflofn2vKx58WfsJrQ9RBh5XdUfy4scIk4Drswm.pdf', '2022-02-06 13:27:59', '2022-02-06 13:27:59'),
(240, '<p><font color=\"#212529\">AAA Pop Quiz Creative Question 2</font><br></p>', 'e5f78107-04a9-4ff6-90a9-30c6f03e76e5', NULL, 230, 'public/question/pop_quiz_cq/answer/COxyGWcBZHkiHWThtQTzyR4keKE7QL2yhVdtnZoj.pdf', '2022-02-06 13:29:15', '2022-02-06 13:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `pop_quiz_mcqs`
--

CREATE TABLE `pop_quiz_mcqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` longtext DEFAULT NULL,
  `slug` char(36) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `field1` longtext DEFAULT NULL,
  `field2` longtext DEFAULT NULL,
  `field3` longtext DEFAULT NULL,
  `field4` longtext DEFAULT NULL,
  `answer` int(11) NOT NULL,
  `explanation` longtext DEFAULT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `number_of_attempt` int(11) NOT NULL,
  `gain_marks` int(11) NOT NULL,
  `success_rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pop_quiz_mcqs`
--

INSERT INTO `pop_quiz_mcqs` (`id`, `question`, `slug`, `image`, `field1`, `field2`, `field3`, `field4`, `answer`, `explanation`, `exam_id`, `number_of_attempt`, `gain_marks`, `success_rate`, `created_at`, `updated_at`) VALUES
(13, 'Dolore cumque dolore.s ghgf', '781d1213-a52f-4fa6-a143-599cd4fe8ed6', NULL, 'Sed qui quis eum max. gsh&nbsp;', 'Quia anim ad tempori.sd f', 'Consectetur, omnis m.kfg', 'Non non sint proiden. hgj', 4, 'Saepe officia irure . fdgfds', 210, 0, 0, 0, '2022-01-08 12:59:12', '2022-01-08 12:59:12'),
(14, '<p>&nbsp;asdfasd f asdfa</p>', 'dd0d45c8-6b18-489b-aff0-2098fefedf77', NULL, '<p>&nbsp;asdf adsfad s</p>', '<p>&nbsp;asdf dasf</p>', '<p>sad fdsa&nbsp;</p>', '<p>&nbsp;asdfdasf</p>', 1, '<p>&nbsp;asdfsadf</p>', 210, 0, 0, 0, '2022-01-08 13:19:29', '2022-01-08 13:19:29'),
(20, '<p>Question 1</p>', 'f00adc1f-988c-4f3d-a07c-f1fa2605279b', NULL, '<p>Option&nbsp; 1<br></p>', '<p>Option&nbsp; 2<br></p>', '<p>Option&nbsp; 3<br></p>', '<p>Option&nbsp; 4<br></p>', 1, '<p>Option 1 is ans</p>', 211, 0, 0, 0, '2022-01-24 10:03:38', '2022-01-24 10:03:38'),
(21, '<p>Question 2</p>', 'c30ba568-cdcb-4ded-8d44-2a222c03c9e0', NULL, '<p>Option 1<br></p>', '<p>Option 2<br></p>', '<p>Option 3<br></p>', '<p>Option 4<br></p>', 2, 'Option 2 is ans', 211, 0, 0, 0, '2022-01-24 10:04:18', '2022-01-24 10:04:18'),
(22, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;Test Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;Arithmetic 1<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;New Pop Quiz 1</h3><p style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><br></p><p style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><br></p><p style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\">Pop Quiz New MCQ 1</p>', '5256999b-a4f6-451d-bd25-8b1550849ac1', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 1, '<p>opt 1 is ans</p>', 214, 0, 0, 0, '2022-01-26 05:24:51', '2022-01-26 05:24:51'),
(23, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;Test Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;Arithmetic 1<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;New Pop Quiz 1<br><br>Pop Quiz New MCQ 2</h3>', 'c95cec84-0412-4997-bc2d-901ad20894bf', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 2, '<p>Opt 2 is ans</p>', 214, 0, 0, 0, '2022-01-26 05:25:33', '2022-01-26 05:25:33'),
(24, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;Test Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;Arithmetic 2<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;Exam 1 for Arithmetic 2</h3><p style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><br></p><p style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><br></p><p style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\">Pop Quiz MCQ Exam 2</p>', '6432390f-d39e-4044-9341-942dfe7bfe78', NULL, 'opt 1', 'opt 2', 'opt 3', 'opt43', 1, 'opt 1 ans', 216, 0, 0, 0, '2022-01-26 12:22:11', '2022-01-26 12:22:11'),
(25, 'AAA Pop Quiz 1 MCQ 1', 'f12aa298-9ea9-47cb-8e6f-ee3f9753f566', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 1, '<p>Option 1 is ans</p>', 218, 0, 0, 0, '2022-01-27 05:37:55', '2022-01-27 05:43:53'),
(26, '<p>AAA Pop Quiz 1 MCQ 2</p>', '34ba3314-f99e-4881-8d91-a0f4a77f1e22', NULL, '<p>Opt 1</p>', '<p>Opt 2</p>', '<p>Opt 3</p>', '<p>Opt 4</p>', 2, '<p>Opt 2 is ans</p>', 218, 0, 0, 0, '2022-01-27 05:38:32', '2022-01-27 05:43:46'),
(27, '<p>AAA Pop Quiz 2 MCQ 1</p>', '5748e5ac-1cde-4e3c-b212-8415b8ae03b8', NULL, '<p>Opt 1<br></p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 1, '<p>opt 1 is ans</p>', 220, 0, 0, 0, '2022-01-27 05:42:06', '2022-01-27 05:43:17'),
(28, '<p>AAA Pop Quiz 2 MCQ 2</p>', '3a417b85-e562-42b0-bc95-a9dcf961a392', NULL, '<p>Opt 1</p>', 'Opt 2', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 2, '<p>Opt 2 is ans<br></p>', 220, 0, 0, 0, '2022-01-27 05:43:07', '2022-01-27 05:43:07'),
(29, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;BBB Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;BBB Course Topic 1<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;BBB Pop Quiz 1<br><br>Pop Quiz MCQ 1</h3>', '5bdfe2d5-1ead-46d4-b400-689cf30078b4', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 1, '<p>Opt 1 is ans</p>', 226, 0, 0, 0, '2022-02-05 12:44:18', '2022-02-05 12:44:18'),
(30, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;BBB Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;BBB Course Topic 1<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;BBB Pop Quiz 1<br>Question 2</h3>', '35c830e4-4ae4-452b-ab5b-7b2210828254', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 2, '<p>Opt 2 is ans</p>', 226, 0, 0, 0, '2022-02-05 12:45:16', '2022-02-05 12:45:16'),
(31, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;AAA Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;AAA Course Topic 1<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;AAA Island 1 Pop Quiz 1<br>Pop Quiz MCQ 1</h3>', '1d83e521-7d0c-4b1d-847d-4000f52b0a7a', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 1, NULL, 230, 0, 0, 0, '2022-02-06 06:17:39', '2022-02-06 06:17:39'),
(32, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;AAA Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;AAA Course Topic 1<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;AAA Island 1 Pop Quiz 1<br>Pop Quiz MCQ 2</h3>', '7a26b0b9-3938-44e9-ba4d-73b42ac7fe1d', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 2, NULL, 230, 0, 0, 0, '2022-02-06 06:18:19', '2022-02-06 06:18:19'),
(33, '<div>Course : AAA Course 1</div><div>Topic : AAA Course Topic 2</div><div>Exam : AAA Course Topic 2 Pop Quiz 2<br>Pop Quiz MCQ 1</div>', '3527847c-9026-4cf5-b1ca-794ba1edb136', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 1, '<p><br></p>', 232, 0, 0, 0, '2022-02-07 06:20:24', '2022-02-07 06:20:24'),
(34, '<div>Course : AAA Course 1</div><div>Topic : AAA Course Topic 2</div><div>Exam : AAA Course Topic 2 Pop Quiz 2<br>Pop Quiz MCQ 2</div>', '49f98b4c-047f-43e1-8482-6dc7884482ae', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 2, NULL, 232, 0, 0, 0, '2022-02-07 06:21:15', '2022-02-07 06:21:15'),
(35, '<p>Course : AAA Course 1</p><p>Topic : AAA Course Topic 2</p><p>Exam : AAA Course Topic 2 Pop Quiz 2<br>MCQ 1</p>', '0fd08312-9add-4c7f-859c-6fb3f445b46f', NULL, '<p>Opt 1</p>', '<p>Opt 2</p>', '<p>Opt 3</p>', '<p>Opt 4</p>', 1, NULL, 234, 0, 0, 0, '2022-02-07 11:40:15', '2022-02-07 11:40:15'),
(36, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;AAA Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;AAA Course Topic 2<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;AAA Course Topic 2 Pop Quiz 2<br>MCQ 2</h3>', 'aa427bf5-6013-4120-9670-6076c38ce2f9', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 2, NULL, 234, 0, 0, 0, '2022-02-07 11:41:25', '2022-02-07 11:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `question_content_tags`
--

CREATE TABLE `question_content_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `content_tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_content_tags`
--

INSERT INTO `question_content_tags` (`id`, `exam_type`, `question_id`, `content_tag_id`, `created_at`, `updated_at`) VALUES
(8770, 'MCQ', 3522, 2506, '2022-01-04 11:56:32', '2022-01-04 11:56:32'),
(8772, 'CQ', 838, 2506, '2022-01-04 12:02:47', '2022-01-04 12:02:47'),
(8773, 'CQ', 839, 2506, '2022-01-04 12:02:48', '2022-01-04 12:02:48'),
(8774, 'CQ', 840, 2506, '2022-01-04 12:02:48', '2022-01-04 12:02:48'),
(8775, 'CQ', 841, 2506, '2022-01-04 12:02:48', '2022-01-04 12:02:48'),
(8776, 'MCQ', 3524, 2507, '2022-01-04 13:14:48', '2022-01-04 13:14:48'),
(8777, 'MCQ', 3525, 2506, '2022-01-05 04:46:49', '2022-01-05 04:46:49'),
(8778, 'CQ', 842, 2507, '2022-01-05 04:51:10', '2022-01-05 04:51:10'),
(8779, 'CQ', 843, 2506, '2022-01-05 04:51:10', '2022-01-05 04:51:10'),
(8780, 'CQ', 844, 2506, '2022-01-05 04:51:10', '2022-01-05 04:51:10'),
(8781, 'CQ', 845, 2507, '2022-01-05 04:51:10', '2022-01-05 04:51:10'),
(8782, 'MCQ', 3526, 2507, '2022-01-05 12:05:34', '2022-01-05 12:05:34'),
(8783, 'MCQ', 3530, 2507, '2022-01-05 12:43:12', '2022-01-05 12:43:12'),
(8784, 'MCQ', 3531, 2507, '2022-01-05 12:50:14', '2022-01-05 12:50:14'),
(8785, 'MCQ', 3532, 2506, '2022-01-05 12:57:31', '2022-01-05 12:57:31'),
(8786, 'MCQ', 3533, 2507, '2022-01-05 12:59:25', '2022-01-05 12:59:25'),
(8791, 'Aptitude Test', 3541, 2507, '2022-01-06 05:29:10', '2022-01-06 05:29:10'),
(8796, 'MCQ', 3523, 2507, '2022-01-06 06:07:06', '2022-01-06 06:07:06'),
(8797, 'Aptitude Test', 3542, 2506, '2022-01-06 07:03:11', '2022-01-06 07:03:11'),
(8798, 'Aptitude Test', 3543, 2506, '2022-01-06 07:43:49', '2022-01-06 07:43:49'),
(8799, 'Aptitude Test', 3543, 2507, '2022-01-06 07:43:49', '2022-01-06 07:43:49'),
(8801, 'Pop Quiz', 4, 2506, '2022-01-06 12:38:45', '2022-01-06 12:38:45'),
(8808, 'Aptitude Test', 7, 2506, '2022-01-08 05:16:29', '2022-01-08 05:16:29'),
(8809, 'Aptitude Test', 7, 2507, '2022-01-08 05:16:29', '2022-01-08 05:16:29'),
(8821, 'CQ', 846, 2506, '2022-01-08 06:03:53', '2022-01-08 06:03:53'),
(8822, 'CQ', 847, 2507, '2022-01-08 06:03:53', '2022-01-08 06:03:53'),
(8823, 'CQ', 848, 2507, '2022-01-08 06:03:53', '2022-01-08 06:03:53'),
(8824, 'CQ', 849, 2507, '2022-01-08 06:03:53', '2022-01-08 06:03:53'),
(8825, 'PopQuizCQ', 850, 2506, '2022-01-08 07:14:31', '2022-01-08 07:14:31'),
(8826, 'PopQuizCQ', 851, 2506, '2022-01-08 07:14:31', '2022-01-08 07:14:31'),
(8827, 'PopQuizCQ', 852, 2506, '2022-01-08 07:14:31', '2022-01-08 07:14:31'),
(8828, 'PopQuizCQ', 853, 2506, '2022-01-08 07:14:31', '2022-01-08 07:14:31'),
(8829, 'Aptitude Test', 3527, 2506, '2022-01-08 07:27:17', '2022-01-08 07:27:17'),
(8830, 'Aptitude Test', 3528, 2506, '2022-01-08 07:28:18', '2022-01-08 07:28:18'),
(8831, 'PopQuizCQ', 854, 2507, '2022-01-08 07:34:33', '2022-01-08 07:34:33'),
(8832, 'PopQuizCQ', 855, 2507, '2022-01-08 07:34:33', '2022-01-08 07:34:33'),
(8833, 'PopQuizCQ', 856, 2507, '2022-01-08 07:34:33', '2022-01-08 07:34:33'),
(8834, 'PopQuizCQ', 857, 2507, '2022-01-08 07:34:33', '2022-01-08 07:34:33'),
(8835, 'PopQuizCQ', 858, 2506, '2022-01-08 09:35:47', '2022-01-08 09:35:47'),
(8836, 'PopQuizCQ', 859, 2506, '2022-01-08 09:35:47', '2022-01-08 09:35:47'),
(8837, 'PopQuizCQ', 860, 2507, '2022-01-08 09:35:47', '2022-01-08 09:35:47'),
(8838, 'PopQuizCQ', 861, 2507, '2022-01-08 09:35:47', '2022-01-08 09:35:47'),
(8839, 'PopQuizCQ', 862, 2506, '2022-01-08 09:43:40', '2022-01-08 09:43:40'),
(8840, 'PopQuizCQ', 863, 2507, '2022-01-08 09:43:41', '2022-01-08 09:43:41'),
(8841, 'PopQuizCQ', 864, 2506, '2022-01-08 09:43:41', '2022-01-08 09:43:41'),
(8842, 'PopQuizCQ', 865, 2507, '2022-01-08 09:43:41', '2022-01-08 09:43:41'),
(8843, 'PopQuizCQ', 866, 2506, '2022-01-08 09:45:33', '2022-01-08 09:45:33'),
(8844, 'PopQuizCQ', 867, 2506, '2022-01-08 09:45:33', '2022-01-08 09:45:33'),
(8845, 'PopQuizCQ', 868, 2507, '2022-01-08 09:45:33', '2022-01-08 09:45:33'),
(8846, 'PopQuizCQ', 869, 2507, '2022-01-08 09:45:33', '2022-01-08 09:45:33'),
(8847, 'Pop Quiz', 870, 2507, '2022-01-08 10:54:09', '2022-01-08 10:54:09'),
(8848, 'Pop Quiz', 871, 2507, '2022-01-08 10:54:09', '2022-01-08 10:54:09'),
(8849, 'Pop Quiz', 872, 2507, '2022-01-08 10:54:09', '2022-01-08 10:54:09'),
(8850, 'Pop Quiz', 873, 2507, '2022-01-08 10:54:09', '2022-01-08 10:54:09'),
(8859, 'Pop Quiz', 874, 2507, '2022-01-08 12:03:29', '2022-01-08 12:03:29'),
(8860, 'Pop Quiz', 875, 2507, '2022-01-08 12:03:29', '2022-01-08 12:03:29'),
(8861, 'Pop Quiz', 876, 2507, '2022-01-08 12:03:29', '2022-01-08 12:03:29'),
(8862, 'Pop Quiz', 877, 2507, '2022-01-08 12:03:29', '2022-01-08 12:03:29'),
(8863, 'Pop Quiz', 10, 2507, '2022-01-08 12:27:40', '2022-01-08 12:27:40'),
(8864, 'Pop Quiz', 11, 2507, '2022-01-08 12:41:07', '2022-01-08 12:41:07'),
(8865, 'Pop Quiz', 878, 2507, '2022-01-08 12:43:20', '2022-01-08 12:43:20'),
(8866, 'Pop Quiz', 879, 2507, '2022-01-08 12:43:21', '2022-01-08 12:43:21'),
(8867, 'Pop Quiz', 880, 2507, '2022-01-08 12:43:21', '2022-01-08 12:43:21'),
(8868, 'Pop Quiz', 881, 2507, '2022-01-08 12:43:21', '2022-01-08 12:43:21'),
(8869, 'Pop Quiz', 5, 2506, '2022-01-08 12:44:14', '2022-01-08 12:44:14'),
(8870, 'Pop Quiz', 5, 2507, '2022-01-08 12:44:14', '2022-01-08 12:44:14'),
(8871, 'Pop Quiz', 882, 2506, '2022-01-08 12:48:12', '2022-01-08 12:48:12'),
(8872, 'Pop Quiz', 883, 2506, '2022-01-08 12:48:12', '2022-01-08 12:48:12'),
(8873, 'Pop Quiz', 884, 2506, '2022-01-08 12:48:12', '2022-01-08 12:48:12'),
(8874, 'Pop Quiz', 885, 2506, '2022-01-08 12:48:12', '2022-01-08 12:48:12'),
(8879, 'Pop Quiz', 886, 2507, '2022-01-08 12:49:57', '2022-01-08 12:49:57'),
(8880, 'Pop Quiz', 887, 2507, '2022-01-08 12:49:57', '2022-01-08 12:49:57'),
(8881, 'Pop Quiz', 888, 2507, '2022-01-08 12:49:58', '2022-01-08 12:49:58'),
(8882, 'Pop Quiz', 889, 2507, '2022-01-08 12:49:58', '2022-01-08 12:49:58'),
(8891, 'Pop Quiz', 13, 2507, '2022-01-08 12:59:12', '2022-01-08 12:59:12'),
(8892, 'Pop Quiz', 14, 2506, '2022-01-08 13:19:29', '2022-01-08 13:19:29'),
(8893, 'Pop Quiz', 14, 2507, '2022-01-08 13:19:29', '2022-01-08 13:19:29'),
(8903, 'Pop Quiz', 894, 2507, '2022-01-09 06:44:33', '2022-01-09 06:44:33'),
(8904, 'Pop Quiz', 895, 2507, '2022-01-09 06:44:33', '2022-01-09 06:44:33'),
(8905, 'Pop Quiz', 896, 2507, '2022-01-09 06:44:33', '2022-01-09 06:44:33'),
(8906, 'Pop Quiz', 897, 2506, '2022-01-09 06:44:33', '2022-01-09 06:44:33'),
(8908, 'Topic End Exam', 17, 2506, '2022-01-09 09:42:48', '2022-01-09 09:42:48'),
(8909, 'Topic End Exam', 18, 2507, '2022-01-09 09:45:21', '2022-01-09 09:45:21'),
(8914, 'Pop Quiz', 17, 2506, '2022-01-09 11:01:34', '2022-01-09 11:01:34'),
(8938, 'Pop Quiz', 906, 2507, '2022-01-09 12:34:26', '2022-01-09 12:34:26'),
(8939, 'Pop Quiz', 907, 2507, '2022-01-09 12:34:26', '2022-01-09 12:34:26'),
(8940, 'Pop Quiz', 908, 2507, '2022-01-09 12:34:26', '2022-01-09 12:34:26'),
(8941, 'Pop Quiz', 909, 2507, '2022-01-09 12:34:26', '2022-01-09 12:34:26'),
(8942, 'Pop Quiz', 890, 2507, '2022-01-09 13:05:31', '2022-01-09 13:05:31'),
(8943, 'Pop Quiz', 891, 2507, '2022-01-09 13:05:31', '2022-01-09 13:05:31'),
(8944, 'Pop Quiz', 892, 2507, '2022-01-09 13:05:31', '2022-01-09 13:05:31'),
(8945, 'Pop Quiz', 893, 2507, '2022-01-09 13:05:31', '2022-01-09 13:05:31'),
(8950, 'Topic End Exam', 19, 2506, '2022-01-09 13:08:32', '2022-01-09 13:08:32'),
(8951, 'Topic End Exam', 902, 2506, '2022-01-09 13:08:51', '2022-01-09 13:08:51'),
(8952, 'Topic End Exam', 903, 2506, '2022-01-09 13:08:51', '2022-01-09 13:08:51'),
(8953, 'Topic End Exam', 904, 2507, '2022-01-09 13:08:51', '2022-01-09 13:08:51'),
(8954, 'Topic End Exam', 905, 2507, '2022-01-09 13:08:51', '2022-01-09 13:08:51'),
(8955, 'Topic End Exam', 898, 2506, '2022-01-09 13:15:44', '2022-01-09 13:15:44'),
(8956, 'Topic End Exam', 899, 2506, '2022-01-09 13:15:44', '2022-01-09 13:15:44'),
(8957, 'Topic End Exam', 900, 2506, '2022-01-09 13:15:45', '2022-01-09 13:15:45'),
(8958, 'Topic End Exam', 901, 2506, '2022-01-09 13:15:45', '2022-01-09 13:15:45'),
(8959, 'Aptitude Test', 3529, 2507, '2022-01-10 12:37:58', '2022-01-10 12:37:58'),
(8960, 'Aptitude Test', 3530, 2506, '2022-01-12 06:37:16', '2022-01-12 06:37:16'),
(8961, 'Aptitude Test', 3531, 2507, '2022-01-12 06:37:57', '2022-01-12 06:37:57'),
(8962, 'Aptitude Test', 3532, 2506, '2022-01-12 06:38:34', '2022-01-12 06:38:34'),
(8963, 'Topic End Exam', 906, 2507, '2022-01-12 11:36:35', '2022-01-12 11:36:35'),
(8964, 'Topic End Exam', 907, 2507, '2022-01-12 11:36:35', '2022-01-12 11:36:35'),
(8965, 'Topic End Exam', 908, 2507, '2022-01-12 11:36:35', '2022-01-12 11:36:35'),
(8966, 'Topic End Exam', 909, 2507, '2022-01-12 11:36:36', '2022-01-12 11:36:36'),
(8967, 'Topic End Exam', 910, 2507, '2022-01-12 11:37:04', '2022-01-12 11:37:04'),
(8968, 'Topic End Exam', 911, 2507, '2022-01-12 11:37:04', '2022-01-12 11:37:04'),
(8969, 'Topic End Exam', 912, 2507, '2022-01-12 11:37:04', '2022-01-12 11:37:04'),
(8970, 'Topic End Exam', 913, 2507, '2022-01-12 11:37:05', '2022-01-12 11:37:05'),
(8971, 'Pop Quiz', 910, 2506, '2022-01-18 11:05:57', '2022-01-18 11:05:57'),
(8972, 'Pop Quiz', 911, 2506, '2022-01-18 11:05:57', '2022-01-18 11:05:57'),
(8973, 'Pop Quiz', 912, 2507, '2022-01-18 11:05:57', '2022-01-18 11:05:57'),
(8974, 'Pop Quiz', 913, 2507, '2022-01-18 11:05:57', '2022-01-18 11:05:57'),
(8975, 'Pop Quiz', 20, 2508, '2022-01-24 10:03:38', '2022-01-24 10:03:38'),
(8976, 'Pop Quiz', 21, 2508, '2022-01-24 10:04:18', '2022-01-24 10:04:18'),
(8977, 'Pop Quiz', 914, 2508, '2022-01-24 10:05:18', '2022-01-24 10:05:18'),
(8978, 'Pop Quiz', 915, 2508, '2022-01-24 10:05:18', '2022-01-24 10:05:18'),
(8979, 'Pop Quiz', 916, 2508, '2022-01-24 10:05:18', '2022-01-24 10:05:18'),
(8980, 'Pop Quiz', 917, 2508, '2022-01-24 10:05:18', '2022-01-24 10:05:18'),
(8981, 'Topic End Exam', 20, 2508, '2022-01-24 12:15:28', '2022-01-24 12:15:28'),
(8982, 'Topic End Exam', 21, 2508, '2022-01-24 12:16:00', '2022-01-24 12:16:00'),
(8983, 'Topic End Exam', 914, 2508, '2022-01-24 12:17:25', '2022-01-24 12:17:25'),
(8984, 'Topic End Exam', 915, 2508, '2022-01-24 12:17:26', '2022-01-24 12:17:26'),
(8985, 'Topic End Exam', 916, 2508, '2022-01-24 12:17:27', '2022-01-24 12:17:27'),
(8986, 'Topic End Exam', 917, 2508, '2022-01-24 12:17:27', '2022-01-24 12:17:27'),
(8989, 'Pop Quiz', 22, 2510, '2022-01-26 05:24:52', '2022-01-26 05:24:52'),
(8990, 'Pop Quiz', 23, 2510, '2022-01-26 05:25:33', '2022-01-26 05:25:33'),
(8991, 'Pop Quiz', 918, 2509, '2022-01-26 05:26:36', '2022-01-26 05:26:36'),
(8992, 'Pop Quiz', 919, 2509, '2022-01-26 05:26:36', '2022-01-26 05:26:36'),
(8993, 'Pop Quiz', 920, 2510, '2022-01-26 05:26:36', '2022-01-26 05:26:36'),
(8994, 'Pop Quiz', 921, 2510, '2022-01-26 05:26:36', '2022-01-26 05:26:36'),
(8995, 'Pop Quiz', 922, 2509, '2022-01-26 05:27:28', '2022-01-26 05:27:28'),
(8996, 'Pop Quiz', 923, 2510, '2022-01-26 05:27:28', '2022-01-26 05:27:28'),
(8997, 'Pop Quiz', 924, 2509, '2022-01-26 05:27:28', '2022-01-26 05:27:28'),
(8998, 'Pop Quiz', 925, 2510, '2022-01-26 05:27:28', '2022-01-26 05:27:28'),
(8999, 'Topic End Exam', 22, 2509, '2022-01-26 05:42:02', '2022-01-26 05:42:02'),
(9000, 'Topic End Exam', 23, 2510, '2022-01-26 05:42:58', '2022-01-26 05:42:58'),
(9001, 'Topic End Exam', 918, 2509, '2022-01-26 05:44:01', '2022-01-26 05:44:01'),
(9002, 'Topic End Exam', 919, 2509, '2022-01-26 05:44:01', '2022-01-26 05:44:01'),
(9003, 'Topic End Exam', 920, 2510, '2022-01-26 05:44:01', '2022-01-26 05:44:01'),
(9004, 'Topic End Exam', 921, 2510, '2022-01-26 05:44:01', '2022-01-26 05:44:01'),
(9005, 'Pop Quiz', 24, 2512, '2022-01-26 12:22:11', '2022-01-26 12:22:11'),
(9006, 'Pop Quiz', 926, 2511, '2022-01-26 12:23:35', '2022-01-26 12:23:35'),
(9007, 'Pop Quiz', 927, 2511, '2022-01-26 12:23:35', '2022-01-26 12:23:35'),
(9067, 'Aptitude Test', 3540, 2506, '2022-02-06 06:09:59', '2022-02-06 06:09:59'),
(9068, 'Aptitude Test', 3540, 2507, '2022-02-06 06:09:59', '2022-02-06 06:09:59'),
(9069, 'Aptitude Test', 3541, 2523, '2022-02-06 06:10:44', '2022-02-06 06:10:44'),
(9070, 'Aptitude Test', 3541, 2524, '2022-02-06 06:10:44', '2022-02-06 06:10:44'),
(9071, 'Aptitude Test', 3542, 2522, '2022-02-06 06:11:34', '2022-02-06 06:11:34'),
(9072, 'Aptitude Test', 3542, 2524, '2022-02-06 06:11:34', '2022-02-06 06:11:34'),
(9073, 'Pop Quiz', 31, 2522, '2022-02-06 06:17:39', '2022-02-06 06:17:39'),
(9074, 'Pop Quiz', 32, 2523, '2022-02-06 06:18:19', '2022-02-06 06:18:19'),
(9075, 'Pop Quiz', 942, 2522, '2022-02-06 13:27:59', '2022-02-06 13:27:59'),
(9076, 'Pop Quiz', 943, 2523, '2022-02-06 13:27:59', '2022-02-06 13:27:59'),
(9077, 'Pop Quiz', 944, 2524, '2022-02-06 13:27:59', '2022-02-06 13:27:59'),
(9078, 'Pop Quiz', 945, 2522, '2022-02-06 13:27:59', '2022-02-06 13:27:59'),
(9079, 'Pop Quiz', 946, 2522, '2022-02-06 13:29:15', '2022-02-06 13:29:15'),
(9080, 'Pop Quiz', 947, 2524, '2022-02-06 13:29:15', '2022-02-06 13:29:15'),
(9081, 'Pop Quiz', 948, 2523, '2022-02-06 13:29:15', '2022-02-06 13:29:15'),
(9082, 'Pop Quiz', 949, 2522, '2022-02-06 13:29:15', '2022-02-06 13:29:15'),
(9083, 'Pop Quiz', 33, 2525, '2022-02-07 06:20:25', '2022-02-07 06:20:25'),
(9084, 'Pop Quiz', 34, 2526, '2022-02-07 06:21:15', '2022-02-07 06:21:15'),
(9085, 'Aptitude Test', 3543, 2525, '2022-02-07 06:40:29', '2022-02-07 06:40:29'),
(9086, 'Aptitude Test', 3544, 2526, '2022-02-07 06:44:34', '2022-02-07 06:44:34'),
(9088, 'Aptitude Test', 3545, 2526, '2022-02-07 06:51:53', '2022-02-07 06:51:53'),
(9089, 'Pop Quiz', 35, 2525, '2022-02-07 11:40:15', '2022-02-07 11:40:15'),
(9090, 'Pop Quiz', 36, 2526, '2022-02-07 11:41:25', '2022-02-07 11:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `question_content_tag_analyses`
--

CREATE TABLE `question_content_tag_analyses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content_tag_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `number_of_attempt` int(11) NOT NULL,
  `gain_marks` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_content_tag_analyses`
--

INSERT INTO `question_content_tag_analyses` (`id`, `content_tag_id`, `student_id`, `exam_type`, `question_id`, `number_of_attempt`, `gain_marks`, `status`, `created_at`, `updated_at`) VALUES
(21359, 2506, 712, 'MCQ', 3522, 1, 1, 1, '2022-01-04 13:06:41', '2022-01-04 13:06:41'),
(21360, 2507, 712, 'MCQ', 3523, 1, 1, 1, '2022-01-04 13:06:41', '2022-01-04 13:06:41'),
(21477, 2507, 5, 'Aptitude Test', 3531, 1, 1, 1, '2022-01-19 11:40:52', '2022-01-19 11:40:52'),
(21478, 2506, 5, 'Aptitude Test', 3530, 1, 0, 1, '2022-01-19 11:40:52', '2022-01-19 11:40:52'),
(21479, 2507, 5, 'Pop Quiz', 910, 1, 1, 1, '2022-01-19 12:08:21', '2022-01-19 12:08:21'),
(21480, 2506, 5, 'Pop Quiz', 910, 1, 1, 1, '2022-01-19 12:08:21', '2022-01-19 12:08:21'),
(21481, 2507, 5, 'Pop Quiz', 911, 1, 1, 1, '2022-01-19 12:08:22', '2022-01-19 12:08:22'),
(21482, 2506, 5, 'Pop Quiz', 911, 1, 1, 1, '2022-01-19 12:08:22', '2022-01-19 12:08:22'),
(21483, 2507, 5, 'Pop Quiz', 912, 1, 1, 1, '2022-01-19 12:08:22', '2022-01-19 12:08:22'),
(21484, 2507, 5, 'Pop Quiz', 912, 1, 1, 1, '2022-01-19 12:08:22', '2022-01-19 12:08:22'),
(21485, 2507, 5, 'Pop Quiz', 913, 1, 1, 1, '2022-01-19 12:08:22', '2022-01-19 12:08:22'),
(21486, 2507, 5, 'Pop Quiz', 913, 1, 1, 1, '2022-01-19 12:08:22', '2022-01-19 12:08:22'),
(21487, 2507, 5, 'Pop Quiz', 890, 1, 1, 1, '2022-01-19 12:08:22', '2022-01-19 12:08:22'),
(21488, 2507, 5, 'Pop Quiz', 891, 1, 2, 1, '2022-01-19 12:08:22', '2022-01-19 12:08:22'),
(21489, 2507, 5, 'Pop Quiz', 892, 1, 3, 1, '2022-01-19 12:08:22', '2022-01-19 12:08:22'),
(21490, 2507, 5, 'Pop Quiz', 893, 1, 1, 1, '2022-01-19 12:08:23', '2022-01-19 12:08:23'),
(21491, 2507, 5, 'Pop Quiz', 890, 1, 1, 1, '2022-01-19 12:14:21', '2022-01-19 12:14:21'),
(21492, 2507, 5, 'Pop Quiz', 891, 1, 2, 1, '2022-01-19 12:14:21', '2022-01-19 12:14:21'),
(21493, 2507, 5, 'Pop Quiz', 892, 1, 3, 1, '2022-01-19 12:14:21', '2022-01-19 12:14:21'),
(21494, 2507, 5, 'Pop Quiz', 893, 1, 1, 1, '2022-01-19 12:14:21', '2022-01-19 12:14:21'),
(21495, 2507, 5, 'Pop Quiz', 910, 1, 1, 1, '2022-01-19 12:14:21', '2022-01-19 12:14:21'),
(21496, 2506, 5, 'Pop Quiz', 910, 1, 1, 1, '2022-01-19 12:14:21', '2022-01-19 12:14:21'),
(21497, 2507, 5, 'Pop Quiz', 911, 1, 2, 1, '2022-01-19 12:14:22', '2022-01-19 12:14:22'),
(21498, 2506, 5, 'Pop Quiz', 911, 1, 2, 1, '2022-01-19 12:14:22', '2022-01-19 12:14:22'),
(21499, 2507, 5, 'Pop Quiz', 912, 1, 1, 1, '2022-01-19 12:14:22', '2022-01-19 12:14:22'),
(21500, 2507, 5, 'Pop Quiz', 912, 1, 1, 1, '2022-01-19 12:14:22', '2022-01-19 12:14:22'),
(21501, 2507, 5, 'Pop Quiz', 913, 1, 2, 1, '2022-01-19 12:14:22', '2022-01-19 12:14:22'),
(21502, 2507, 5, 'Pop Quiz', 913, 1, 2, 1, '2022-01-19 12:14:22', '2022-01-19 12:14:22'),
(21503, 2508, 5, 'Pop Quiz', 914, 1, 1, 1, '2022-01-24 11:25:46', '2022-01-24 11:25:46'),
(21504, 2508, 5, 'Pop Quiz', 915, 1, 2, 1, '2022-01-24 11:25:46', '2022-01-24 11:25:46'),
(21505, 2508, 5, 'Pop Quiz', 916, 1, 2, 1, '2022-01-24 11:25:46', '2022-01-24 11:25:46'),
(21506, 2508, 5, 'Pop Quiz', 917, 1, 3, 1, '2022-01-24 11:25:46', '2022-01-24 11:25:46'),
(21507, 2508, 5, 'Topic End Exam', 914, 1, 1, 1, '2022-01-24 12:44:34', '2022-01-24 12:44:34'),
(21508, 2508, 5, 'Topic End Exam', 914, 1, 1, 1, '2022-01-24 12:44:34', '2022-01-24 12:44:34'),
(21509, 2508, 5, 'Topic End Exam', 915, 1, 1, 1, '2022-01-24 12:44:35', '2022-01-24 12:44:35'),
(21510, 2508, 5, 'Topic End Exam', 915, 1, 1, 1, '2022-01-24 12:44:35', '2022-01-24 12:44:35'),
(21511, 2508, 5, 'Topic End Exam', 916, 1, 2, 1, '2022-01-24 12:44:35', '2022-01-24 12:44:35'),
(21512, 2508, 5, 'Topic End Exam', 916, 1, 2, 1, '2022-01-24 12:44:35', '2022-01-24 12:44:35'),
(21513, 2508, 5, 'Topic End Exam', 917, 1, 2, 1, '2022-01-24 12:44:35', '2022-01-24 12:44:35'),
(21514, 2508, 5, 'Topic End Exam', 917, 1, 2, 1, '2022-01-24 12:44:35', '2022-01-24 12:44:35'),
(21515, 2508, 5, 'Topic End Exam', 914, 1, 1, 1, '2022-01-24 13:05:32', '2022-01-24 13:05:32'),
(21516, 2508, 5, 'Topic End Exam', 914, 1, 1, 1, '2022-01-24 13:05:32', '2022-01-24 13:05:32'),
(21517, 2508, 5, 'Topic End Exam', 915, 1, 1, 1, '2022-01-24 13:05:33', '2022-01-24 13:05:33'),
(21518, 2508, 5, 'Topic End Exam', 915, 1, 1, 1, '2022-01-24 13:05:33', '2022-01-24 13:05:33'),
(21519, 2508, 5, 'Topic End Exam', 916, 1, 2, 1, '2022-01-24 13:05:33', '2022-01-24 13:05:33'),
(21520, 2508, 5, 'Topic End Exam', 916, 1, 2, 1, '2022-01-24 13:05:33', '2022-01-24 13:05:33'),
(21521, 2508, 5, 'Topic End Exam', 917, 1, 2, 1, '2022-01-24 13:05:33', '2022-01-24 13:05:33'),
(21522, 2508, 5, 'Topic End Exam', 917, 1, 2, 1, '2022-01-24 13:05:33', '2022-01-24 13:05:33'),
(21523, 2508, 6, 'Topic End Exam', 914, 1, 1, 1, '2022-01-25 06:46:46', '2022-01-25 06:46:46'),
(21524, 2508, 6, 'Topic End Exam', 914, 1, 1, 1, '2022-01-25 06:46:46', '2022-01-25 06:46:46'),
(21525, 2508, 6, 'Topic End Exam', 915, 1, 1, 1, '2022-01-25 06:46:46', '2022-01-25 06:46:46'),
(21526, 2508, 6, 'Topic End Exam', 915, 1, 1, 1, '2022-01-25 06:46:47', '2022-01-25 06:46:47'),
(21527, 2508, 6, 'Topic End Exam', 916, 1, 1, 1, '2022-01-25 06:46:47', '2022-01-25 06:46:47'),
(21528, 2508, 6, 'Topic End Exam', 916, 1, 1, 1, '2022-01-25 06:46:47', '2022-01-25 06:46:47'),
(21529, 2508, 6, 'Topic End Exam', 917, 1, 1, 1, '2022-01-25 06:46:47', '2022-01-25 06:46:47'),
(21530, 2508, 6, 'Topic End Exam', 917, 1, 1, 1, '2022-01-25 06:46:47', '2022-01-25 06:46:47'),
(21531, 2507, 6, 'Pop Quiz', 890, 1, 1, 1, '2022-01-25 06:53:03', '2022-01-25 06:53:03'),
(21532, 2507, 6, 'Pop Quiz', 891, 1, 1, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(21533, 2507, 6, 'Pop Quiz', 892, 1, 1, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(21534, 2507, 6, 'Pop Quiz', 893, 1, 1, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(21535, 2507, 6, 'Pop Quiz', 910, 1, 1, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(21536, 2506, 6, 'Pop Quiz', 910, 1, 1, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(21537, 2507, 6, 'Pop Quiz', 911, 1, 1, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(21538, 2506, 6, 'Pop Quiz', 911, 1, 1, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(21539, 2507, 6, 'Pop Quiz', 912, 1, 1, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(21540, 2507, 6, 'Pop Quiz', 912, 1, 1, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(21541, 2507, 6, 'Pop Quiz', 913, 1, 1, 1, '2022-01-25 06:53:04', '2022-01-25 06:53:04'),
(21542, 2507, 6, 'Pop Quiz', 913, 1, 1, 1, '2022-01-25 06:53:05', '2022-01-25 06:53:05'),
(21597, 2509, 5, 'Pop Quiz', 918, 1, 1, 1, '2022-01-26 11:33:11', '2022-01-26 11:33:11'),
(21598, 2509, 5, 'Pop Quiz', 918, 1, 1, 1, '2022-01-26 11:33:11', '2022-01-26 11:33:11'),
(21599, 2509, 5, 'Pop Quiz', 919, 1, 2, 1, '2022-01-26 11:33:11', '2022-01-26 11:33:11'),
(21600, 2509, 5, 'Pop Quiz', 919, 1, 2, 1, '2022-01-26 11:33:11', '2022-01-26 11:33:11'),
(21601, 2510, 5, 'Pop Quiz', 920, 1, 3, 1, '2022-01-26 11:33:11', '2022-01-26 11:33:11'),
(21602, 2510, 5, 'Pop Quiz', 920, 1, 3, 1, '2022-01-26 11:33:11', '2022-01-26 11:33:11'),
(21603, 2510, 5, 'Pop Quiz', 921, 1, 3, 1, '2022-01-26 11:33:12', '2022-01-26 11:33:12'),
(21604, 2510, 5, 'Pop Quiz', 921, 1, 3, 1, '2022-01-26 11:33:12', '2022-01-26 11:33:12'),
(21605, 2509, 5, 'Pop Quiz', 922, 1, 1, 1, '2022-01-26 11:33:12', '2022-01-26 11:33:12'),
(21606, 2510, 5, 'Pop Quiz', 923, 1, 2, 1, '2022-01-26 11:33:12', '2022-01-26 11:33:12'),
(21607, 2509, 5, 'Pop Quiz', 924, 1, 2, 1, '2022-01-26 11:33:12', '2022-01-26 11:33:12'),
(21608, 2510, 5, 'Pop Quiz', 925, 1, 3, 1, '2022-01-26 11:33:13', '2022-01-26 11:33:13'),
(21613, 2506, 6, 'Aptitude Test', 3542, 1, 1, 1, '2022-02-06 07:13:35', '2022-02-06 07:13:35'),
(21614, 2522, 6, 'Aptitude Test', 3542, 1, 1, 1, '2022-02-06 07:13:35', '2022-02-06 07:13:35'),
(21615, 2524, 6, 'Aptitude Test', 3542, 1, 1, 1, '2022-02-06 07:13:35', '2022-02-06 07:13:35'),
(21616, 2506, 6, 'Aptitude Test', 3540, 1, 1, 1, '2022-02-06 07:13:36', '2022-02-06 07:13:36'),
(21617, 2507, 6, 'Aptitude Test', 3540, 1, 1, 1, '2022-02-06 07:13:36', '2022-02-06 07:13:36'),
(21618, 2506, 5, 'Aptitude Test', 3542, 1, 1, 1, '2022-02-06 12:43:20', '2022-02-06 12:43:20'),
(21619, 2522, 5, 'Aptitude Test', 3542, 1, 1, 1, '2022-02-06 12:43:20', '2022-02-06 12:43:20'),
(21620, 2524, 5, 'Aptitude Test', 3542, 1, 1, 1, '2022-02-06 12:43:20', '2022-02-06 12:43:20'),
(21621, 2506, 5, 'Aptitude Test', 3540, 1, 1, 1, '2022-02-06 12:43:20', '2022-02-06 12:43:20'),
(21622, 2507, 5, 'Aptitude Test', 3540, 1, 1, 1, '2022-02-06 12:43:20', '2022-02-06 12:43:20'),
(21623, 2522, 5, 'Pop Quiz', 946, 1, 1, 1, '2022-02-07 04:52:14', '2022-02-07 04:52:14'),
(21624, 2524, 5, 'Pop Quiz', 947, 1, 2, 1, '2022-02-07 04:52:14', '2022-02-07 04:52:14'),
(21625, 2523, 5, 'Pop Quiz', 948, 1, 1, 1, '2022-02-07 04:52:14', '2022-02-07 04:52:14'),
(21626, 2522, 5, 'Pop Quiz', 949, 1, 3, 1, '2022-02-07 04:52:14', '2022-02-07 04:52:14'),
(21627, 2522, 5, 'Pop Quiz', 942, 1, 1, 1, '2022-02-07 04:52:14', '2022-02-07 04:52:14'),
(21628, 2523, 5, 'Pop Quiz', 943, 1, 2, 1, '2022-02-07 04:52:15', '2022-02-07 04:52:15'),
(21629, 2524, 5, 'Pop Quiz', 944, 1, 2, 1, '2022-02-07 04:52:15', '2022-02-07 04:52:15'),
(21630, 2522, 5, 'Pop Quiz', 945, 1, 3, 1, '2022-02-07 04:52:15', '2022-02-07 04:52:15'),
(21631, 2526, 5, 'Aptitude Test', 3545, 1, 0, 1, '2022-02-07 06:53:51', '2022-02-07 06:53:51'),
(21632, 2506, 5, 'Aptitude Test', 3543, 1, 1, 1, '2022-02-07 06:53:51', '2022-02-07 06:53:51'),
(21633, 2507, 5, 'Aptitude Test', 3543, 1, 1, 1, '2022-02-07 06:53:51', '2022-02-07 06:53:51'),
(21634, 2525, 5, 'Aptitude Test', 3543, 1, 1, 1, '2022-02-07 06:53:51', '2022-02-07 06:53:51'),
(21635, 2526, 5, 'Aptitude Test', 3544, 1, 1, 1, '2022-02-07 06:53:51', '2022-02-07 06:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` bigint(20) NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gaurdian_contact_no` bigint(20) DEFAULT NULL,
  `relation_with_gaurdian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_exam_attempts`
--

CREATE TABLE `student_exam_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `is_completed` tinyint(4) NOT NULL,
  `attended_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_exam_attempts`
--

INSERT INTO `student_exam_attempts` (`id`, `exam_id`, `student_id`, `is_completed`, `attended_at`, `created_at`, `updated_at`) VALUES
(8, 191, 712, 1, '2022-01-05', '2022-01-05 07:26:31', '2022-01-05 07:26:31'),
(40, 210, 5, 1, '2022-01-19', '2022-01-19 12:12:02', '2022-01-19 12:12:02'),
(41, 210, 6, 1, '2022-01-23', '2022-01-23 12:37:43', '2022-01-23 12:37:43'),
(43, 211, 5, 1, '2022-01-24', '2022-01-24 11:17:21', '2022-01-24 11:17:21'),
(45, 212, 5, 1, '2022-01-24', '2022-01-24 12:53:21', '2022-01-24 12:53:21'),
(46, 212, 6, 1, '2022-01-25', '2022-01-25 06:45:48', '2022-01-25 06:45:48'),
(54, 214, 5, 1, '2022-01-26', '2022-01-26 11:32:40', '2022-01-26 11:32:40'),
(55, 220, 5, 1, '2022-01-27', '2022-01-27 12:55:25', '2022-01-27 12:55:25'),
(56, 218, 5, 1, '2022-01-27', '2022-01-27 12:58:44', '2022-01-27 12:58:44'),
(57, 219, 5, 1, '2022-01-27', '2022-01-27 13:08:07', '2022-01-27 13:08:07'),
(58, 230, 5, 1, '2022-02-07', '2022-02-07 04:48:53', '2022-02-07 04:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `topic_end_exam_cqs`
--

CREATE TABLE `topic_end_exam_cqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marks` int(11) NOT NULL,
  `creative_question_id` bigint(20) UNSIGNED NOT NULL,
  `number_of_attempt` int(11) NOT NULL,
  `gain_marks` int(11) NOT NULL,
  `success_rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topic_end_exam_cqs`
--

INSERT INTO `topic_end_exam_cqs` (`id`, `question`, `slug`, `image`, `marks`, `creative_question_id`, `number_of_attempt`, `gain_marks`, `success_rate`, `created_at`, `updated_at`) VALUES
(898, '<p>Topic End Exam CQ 1<span style=\"font-size: 1rem;\">&nbsp;</span><span style=\"font-size: 1rem;\">Edited</span><br></p>', 'e6879a02-d4fc-4cbe-a453-b7428e8f9e5a', NULL, 1, 229, 0, 0, 0, '2022-01-09 12:00:56', '2022-01-09 13:15:44'),
(899, '<p>Topic End Exam CQ 1<span style=\"font-size: 1rem;\">&nbsp;</span><span style=\"font-size: 1rem;\">Edited</span><br></p>', 'f67a6875-b790-47d9-93b4-735625015675', NULL, 2, 229, 0, 0, 0, '2022-01-09 12:00:56', '2022-01-09 13:15:44'),
(900, '<p>Topic End Exam CQ 1<span style=\"font-size: 1rem;\">&nbsp;</span><span style=\"font-size: 1rem;\">Edited</span><br></p>', '58050151-dea3-4007-b0b9-9241eb4fe6be', NULL, 3, 229, 0, 0, 0, '2022-01-09 12:00:56', '2022-01-09 13:15:44'),
(901, '<p>Topic End Exam CQ 1<span style=\"font-size: 1rem;\">&nbsp;</span><span style=\"font-size: 1rem;\">Edited</span><br></p>', 'b841e7cd-923e-41fc-9532-33108da6b930', NULL, 4, 229, 0, 0, 0, '2022-01-09 12:00:56', '2022-01-09 13:15:45'),
(906, 'Enim minima magna ad.afga', 'b8e3054e-ee04-4a7c-ba74-a569b763d41a', NULL, 1, 231, 0, 0, 0, '2022-01-12 11:36:35', '2022-01-12 11:36:35'),
(907, 'Alias ipsum vitae al.hgjfg', '52e820d9-03e7-4183-b679-b5c9d3c222cb', NULL, 2, 231, 0, 0, 0, '2022-01-12 11:36:35', '2022-01-12 11:36:35'),
(908, 'Numquam optio, excep. fdgfd', '6535d22c-3dcc-4580-9951-1e7e1435e64e', NULL, 3, 231, 0, 0, 0, '2022-01-12 11:36:35', '2022-01-12 11:36:35'),
(909, 'Harum non qui a volu.aewarre', '94dfc8cc-41b9-4caa-a63e-9311bcec0c28', NULL, 4, 231, 0, 0, 0, '2022-01-12 11:36:35', '2022-01-12 11:36:35'),
(910, 'Dolorum et officiis .ljhkjl', '7f778cea-1056-4320-a428-ffe0b4058bf9', NULL, 1, 232, 0, 0, 0, '2022-01-12 11:37:04', '2022-01-12 11:37:04'),
(911, 'Aliquam consequuntur.tyreeuy', 'e9d4249b-183e-4bbb-a700-09f2269c8697', NULL, 2, 232, 0, 0, 0, '2022-01-12 11:37:04', '2022-01-12 11:37:04'),
(912, 'Maiores est ut eos, .bvnbvn', '22dbd73f-55e5-42cf-aef7-40d4f60e7261', NULL, 3, 232, 0, 0, 0, '2022-01-12 11:37:04', '2022-01-12 11:37:04'),
(913, 'Non iure exercitatio.hdd brt', 'bf9358d6-0eb2-4179-a3f8-34acc9181844', NULL, 4, 232, 0, 0, 0, '2022-01-12 11:37:05', '2022-01-12 11:37:05'),
(914, '<p>CQ sub Question 1<br></p>', '1c6f570a-5752-4a08-a208-a54d750dd146', NULL, 1, 233, 3, 3, 100, '2022-01-24 12:17:25', '2022-01-25 06:46:46'),
(915, '<p>CQ sub Question 2<br></p>', '64feeed4-6f82-4b12-b620-29e5f9b7b466', NULL, 2, 233, 3, 3, 50, '2022-01-24 12:17:26', '2022-01-25 06:46:46'),
(916, '<p>CQ sub Question 3<br></p>', '78c05695-46a9-489f-85da-b45b27ce168e', NULL, 3, 233, 3, 5, 56, '2022-01-24 12:17:26', '2022-01-25 06:46:47'),
(917, '<p>CQ sub Question 4<br></p>', '30b73824-f501-4eea-8c92-9a5a7b359d63', NULL, 4, 233, 3, 5, 42, '2022-01-24 12:17:27', '2022-01-25 06:46:47'),
(918, '<p>New Topic End Exam CQ 1<br></p>', 'eb6215ef-90f5-438e-8b3b-9deab4c14a41', NULL, 1, 234, 1, 1, 100, '2022-01-26 05:44:01', '2022-01-26 05:45:47'),
(919, '<p>New Topic End Exam CQ 2<br></p>', '10d4edde-00cf-4ac2-b216-7358d758f6bf', NULL, 2, 234, 1, 1, 50, '2022-01-26 05:44:01', '2022-01-26 05:45:47'),
(920, '<p>New Topic End Exam CQ 3<br></p>', 'c8571324-a2bd-4a0a-8902-721e049b33cc', NULL, 3, 234, 1, 2, 67, '2022-01-26 05:44:01', '2022-01-26 05:45:47'),
(921, '<p>New Topic End Exam CQ 4<br></p>', '1377f06b-9d98-4954-becc-359964ee8b71', NULL, 4, 234, 1, 2, 50, '2022-01-26 05:44:01', '2022-01-26 05:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `topic_end_exam_cq_exam_papers`
--

CREATE TABLE `topic_end_exam_cq_exam_papers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `exam_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creative_question_id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `submitted_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submitted_pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checked_paper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topic_end_exam_creative_questions`
--

CREATE TABLE `topic_end_exam_creative_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `creative_question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `standard_ans_pdf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topic_end_exam_creative_questions`
--

INSERT INTO `topic_end_exam_creative_questions` (`id`, `creative_question`, `slug`, `image`, `exam_id`, `standard_ans_pdf`, `created_at`, `updated_at`) VALUES
(229, 'Topic End Exam CQ 1&nbsp;Edited', '65549c82-c341-48ae-8a0f-7daa5443c514', NULL, 202, 'public/question/topic_end_exam_cq/answer/UG5pYLXG50hnJnnEDhWSfN8xUGbqbSsVmDKSEPaA.pdf', '2022-01-09 12:00:56', '2022-01-09 13:15:44'),
(231, 'Reprehenderit commod. gfhg', '05715c1a-d9e2-4a0c-8e19-377e888d2acf', NULL, 202, 'public/question/topic_end_exam_cq/answer/dUZiGkyr6s8FiVLTpu1lvXpKvsjjinUL7QrS3cX7.pdf', '2022-01-12 11:36:35', '2022-01-12 11:36:35'),
(232, 'Consequatur, aut omn. iuoui', '0e8da80f-dc39-4876-8703-171215704732', NULL, 202, 'public/question/topic_end_exam_cq/answer/pmILqYqcoZKaHzE3ryS6PbP7Hd9l9xEhWCY64AFP.pdf', '2022-01-12 11:37:04', '2022-01-12 11:37:04'),
(233, '<p>CQ Question 1</p>', 'ef684433-bbc1-442c-8b84-9e7bd0b78870', NULL, 212, 'public/question/topic_end_exam_cq/answer/6vYa72FfbFRmdG8fzQhjOlB0ui3dCAfbBADXLPFH.pdf', '2022-01-24 12:17:25', '2022-01-24 12:17:25'),
(234, '<p>New Topic End Exam Creative Question 1</p>', '691f9f81-a2d5-4668-95f2-e0d62d2d9e06', NULL, 215, 'public/question/topic_end_exam_cq/answer/7XhlLx28IwdAyMzDg3dZgqpUdFV1Q7OtDbDy1fOg.pdf', '2022-01-26 05:44:01', '2022-01-26 05:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `topic_end_exam_mcqs`
--

CREATE TABLE `topic_end_exam_mcqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` longtext DEFAULT NULL,
  `slug` char(36) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `field1` longtext DEFAULT NULL,
  `field2` longtext DEFAULT NULL,
  `field3` longtext DEFAULT NULL,
  `field4` longtext DEFAULT NULL,
  `answer` int(11) NOT NULL,
  `explanation` longtext DEFAULT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `number_of_attempt` int(11) NOT NULL,
  `gain_marks` int(11) NOT NULL,
  `success_rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic_end_exam_mcqs`
--

INSERT INTO `topic_end_exam_mcqs` (`id`, `question`, `slug`, `image`, `field1`, `field2`, `field3`, `field4`, `answer`, `explanation`, `exam_id`, `number_of_attempt`, `gain_marks`, `success_rate`, `created_at`, `updated_at`) VALUES
(17, '<p>Topic End Exam MCQ 1</p>', '1f34d0bc-ad2b-4056-9c79-0c365d8fd41c', NULL, '<p>Topic End Exam MCQ Opt 1<br></p>', '<p>Topic End Exam MCQ Opt 2<br></p>', '<p>Topic End Exam MCQ Opt 3<br></p>', '<p>Topic End Exam MCQ Opt 4<br></p>', 1, '<p>Opt 1 is answer</p>', 202, 0, 0, 0, '2022-01-09 09:42:48', '2022-01-09 09:42:48'),
(18, 'Topic End Exam Question 2', '95004113-6480-4b8f-acaa-324df5aca785', NULL, 'Topic End Exam Question 2 Opt 1', 'Topic End Exam Question 2 Opt 2', 'Topic End Exam Question 2 Opt 3', '<p>Topic End Exam Question 2 Opt 4<br></p>', 3, 'Opt 3 is answer.', 202, 0, 0, 0, '2022-01-09 09:45:21', '2022-01-09 09:45:21'),
(19, '<p>Topic End Exam MCQ 3 Edited Edited</p>', '2a6f245f-ec16-48c2-8626-d4cd7cac8748', NULL, '<p>Topic End Exam MCQ 3 Opt 1<br></p>', '<p>Topic End Exam MCQ 3 Opt 2<br></p>', '<p>Topic End Exam MCQ 3 Opt 3<br></p>', '<p>Topic End Exam MCQ 3 Opt 4<br></p>', 3, 'Opt 3 is ans', 202, 0, 0, 0, '2022-01-09 10:15:33', '2022-01-09 13:08:32'),
(20, '<p>Question&nbsp; 1</p>', '52f77a85-274d-4977-9c35-9df4ee3e7c07', NULL, '<p>Option 1</p>', '<p>Option 2<br></p>', '<p>Option 3<br></p>', '<p>Option 4<br></p>', 1, '<p>Option 1 is ans</p>', 212, 0, 0, 0, '2022-01-24 12:15:28', '2022-01-24 12:15:28'),
(21, '<p>Question 2</p>', '9f4be5b4-4397-469a-8fbc-8e1f2216226e', NULL, '<p>Option 1</p>', '<p>Option 2<br></p>', '<p>Option 3<br></p>', '<p>Option 4<br></p>', 2, '<p>Option 2 is ans</p>', 212, 0, 0, 0, '2022-01-24 12:16:00', '2022-01-24 12:16:00'),
(22, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;Test Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;Arithmetic 1<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;New Topic End Exam 1<br>Topic End Exam MCQ 1</h3>', 'a6516829-1381-46dc-9f97-23d627b6e71f', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 1, NULL, 215, 0, 0, 0, '2022-01-26 05:42:02', '2022-01-26 05:42:02'),
(23, '<h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><span style=\"font-weight: bolder;\">Course :</span>&nbsp;Test Course 1<br><span style=\"font-weight: bolder;\">Topic :</span>&nbsp;Arithmetic 1<br><span style=\"font-weight: bolder;\">Exam :</span>&nbsp;New Topic End Exam 1</h3><p style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><br></p><p style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\"><br></p><h3 class=\"card-title\" style=\"font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41);\">Topic End Exam MCQ 2</h3>', 'd9eb0aab-4b9f-473d-a96a-455e1f859230', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 2, '<p>Opt 2 is ans</p>', 215, 0, 0, 0, '2022-01-26 05:42:58', '2022-01-26 05:42:58'),
(24, '<p>AAA Topic End Exam 1 MCQ 1<br></p>', '5d12cca2-928c-4e43-bfc5-e57913bb923a', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 1, NULL, 219, 0, 0, 0, '2022-01-27 12:30:51', '2022-01-27 12:31:34'),
(25, '<p>AAA Topic End Exam MCQ 2</p>', 'a82876de-bcd6-4b70-ab88-f5cce090920c', NULL, '<p>Opt 1</p>', '<p>Opt 2<br></p>', '<p>Opt 3<br></p>', '<p>Opt 4<br></p>', 2, NULL, 219, 0, 0, 0, '2022-01-27 12:31:24', '2022-01-27 12:31:24'),
(26, '<p>AAA Topic End Exam 2 MCQ 1</p>', 'c5caa885-4e55-4a86-a4ca-45d0dd5a56cd', NULL, '<p>opt 1</p>', '<p>opt 2</p>', '<p>opt 3</p>', '<p>opt 4</p>', 1, NULL, 221, 0, 0, 0, '2022-01-27 13:26:36', '2022-01-27 13:26:36'),
(27, '<p>AAA Topic End Exam 2 MCQ 2<br></p>', '3f7ea361-7841-44de-a6ec-9f803764ae3e', NULL, '<p>opt 1</p>', '<p>opt 2</p>', '<p>opt 3</p>', '<p>opt 4</p>', 2, NULL, 221, 0, 0, 0, '2022-01-27 13:27:07', '2022-01-27 13:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `user_type` tinyint(4) DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `is_admin`, `user_type`, `provider_id`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@app.com', '01521343444', NULL, 1, 1, NULL, NULL, '$2y$10$yTtQBk0QtWYSkv7gnKv4tehzxVso1jIZgmEG/GU6ZWs/VuHoatmuW', 'sVo3W2gdYQqnHPbgtu7mIaAVQCe0wKeF6QjgZpT3RYzs3X6mdTWuNi6PAj1p', '2021-10-25 10:11:08', '2021-10-25 10:11:08'),
(2, 'Admin2', 'admin2@app.com', '01521343424', NULL, 1, 1, NULL, NULL, '$2y$10$kanEhb9C5MZezDQwWO2CA.6RHWtU0xr5voZXrH5Pd59zGu3s.o38m', NULL, '2021-10-25 10:11:08', '2021-10-25 10:11:08'),
(3, 'Teacher', 'teacher@app.com', '01521343414', NULL, 0, 2, NULL, NULL, '$2y$10$inm2oToZkoFOnvvqIv5PHewmLf7n6yP9e0sCVWvhV6bWOY6ZabjAu', NULL, '2021-10-25 10:11:09', '2021-10-25 10:11:09'),
(4, 'Teacher2', 'teacher2@app.com', '01421343444', NULL, 0, 2, NULL, NULL, '$2y$10$6jCJxZUDYKtz39JDwYHpJ.BApOrPBsDiPv04Rr1GP9QJ9c8msWzoC', NULL, '2021-10-25 10:11:09', '2021-10-25 10:11:09'),
(5, 'Student', 'student@app.com', '01621343444', NULL, 0, 3, NULL, NULL, '$2y$10$K54Crn4SOZj2BYnZv0uuzOfCw7FZJRZla1VaDlT/xz5U8w4odVhIS', NULL, '2021-10-25 10:11:09', '2021-10-25 10:11:09'),
(6, 'Student2', 'student2@app.com', '01821343444', NULL, 0, 3, NULL, NULL, '$2y$10$y30azawNHV7btVG4Z6M.VeA1O/bbIlsN6j3zUt4LcU8f.5BbURIWG', NULL, '2021-10-25 10:11:09', '2021-10-25 10:11:09'),
(7, 'Rahim', 'top5way.service@gmail.com', '01822005133', NULL, 0, 3, NULL, NULL, '$2y$10$g2VdC4HeriOG/GGJFpuf3ueuQVIGIn9JQQ.9CGOcIFFXVbO6cdXbi', NULL, '2021-10-25 14:43:19', '2021-10-25 14:43:19'),
(8, 'Test fahim', 'akakib.bd@gmail.com', '01521484888', NULL, 0, 3, NULL, NULL, '$2y$10$ruOGhNqSoBpEPQzf6fzkCu/zVnoiYhKrggW5hoo9nTjx0lcIvOpMu', NULL, '2021-10-27 06:11:32', '2021-10-27 06:11:32'),
(9, 'test', 'test123@gmail.com', '01918339988', NULL, 0, 3, NULL, NULL, '$2y$10$epp6Puft8hbbI8kM58TRyumBqF4pZJJL.I8GgdnIMcDCiBawbzIyW', NULL, '2021-10-27 07:12:13', '2021-10-27 07:12:13'),
(10, 'test_96', 'zfarhan@live.com', '01739166077', NULL, 0, 3, NULL, NULL, '$2y$10$QRG9RkYprZWl3gzVsv3HEOGWESTFOcaC5nwwwNp0p3Csow8vCZCre', NULL, '2021-10-27 07:41:37', '2021-10-27 07:41:37'),
(11, 'Iftekhar', 'tasfiqshahriar@gmail.com', '01797013969', NULL, 0, 3, NULL, NULL, '$2y$10$/pUkrVmVQwtWV7VwTfw8W.jsGxmEuY43eSrJvSa4Px4JSRJxrTQkW', NULL, '2021-10-27 12:57:35', '2021-10-27 12:57:35'),
(13, 'Admin3', 'admin3@app.com', '01865649707', NULL, 1, 1, NULL, NULL, '$2y$10$CjjfeO3BxyjMVGEO.w0NWeMA9ZvD1D6ryiaACbez7Din.cYXofZaq', 'n9lUjMSzfIVXWxhc33kwdo9APT99MAz9dmDIqu9K0vNw3qOIbOiUXo2h5uoQ', '2021-10-28 09:28:56', '2021-10-28 09:28:56'),
(14, 'rajon', 'rajon@gmail.com', '01737483734', NULL, 0, 3, NULL, NULL, '$2y$10$IyrXgrMrOEgp.YnWhpvDmeHCs69KBXrAFlbgAhAx8/wfEJINd2mcu', NULL, '2021-10-28 09:38:30', '2021-10-28 09:38:30'),
(15, 'labib', 'labib@gmail.com', '01894377535', NULL, 0, 3, NULL, NULL, '$2y$10$ipe5ll6S5iIHOWwGUm0jD.kiMeLBRiLTlRysKV5a6pqZqqySLx0Eu', 'RWIqBynN89WtAStSddYl9PvJvLPmAMYPCyfPzw3aOZJfyC7hoJIYIN0PQxSr', '2021-10-28 09:45:37', '2021-10-28 09:45:37'),
(16, 'shownok', 'shownok@gmail.com', '01737477263', NULL, 0, 3, NULL, NULL, '$2y$10$0Y3xUyjMHSJ/Hq2PjeuTyOqn5lgZf/BNTHN1gYA/TnX3jonUXpVfe', NULL, '2021-10-28 09:51:49', '2021-10-28 09:51:49'),
(17, 'student3', 'student3@app.com', '01836284727', NULL, 0, 3, NULL, NULL, '$2y$10$IjPx6bqyvBmqCKMoF9re4eL1t7GainFEw/0ZJGrw27af7KjrA/W7C', NULL, '2021-10-28 16:17:55', '2021-10-28 16:17:55'),
(18, 'new user', 'new@gmail.com', '01738462942', NULL, 0, 3, NULL, NULL, '$2y$10$FAtK4uyVeTdf9IjHeJLsze72TlzTMXfqnNf3cp1dMLNZo2F6BW7Uy', NULL, '2021-10-29 08:53:56', '2021-10-29 08:53:56'),
(19, 'Nahid test', 'nahida@gmail.com', '01779652777', NULL, 0, 3, NULL, NULL, '$2y$10$TKkLvjwrC1jvUNWz6w5dheoK.JUISsZDOVe5n2fcV.ehQQ4v6Aj0W', NULL, '2021-10-29 09:11:34', '2021-10-29 09:11:34'),
(20, 'FAHIM UDDIN', 'fahim1234@gmail.com', '01732169133', NULL, 0, 3, NULL, NULL, '$2y$10$1ARjn3g32qXne0AFa/MhCuMVokiAcvALh04XsQnpA.ZSMx2D8hCjC', NULL, '2021-10-29 09:34:52', '2021-10-29 09:34:52'),
(23, 'Riyad Amin', 'nurulaminryd@gmail.com', NULL, NULL, 0, 3, NULL, NULL, '$2y$10$YyGIvHBsGWh.C5FXBmEhoOD06O8SllxQtLs98rAFRqJojVIhhZvcy', NULL, '2021-10-14 21:12:30', '2021-10-14 21:12:30'),
(25, 'nizubizu', 'nizubizu1@gmail.com', '01925878858', NULL, 0, 3, NULL, NULL, '$2y$10$xD3pycjPMUiV6JQG7dnyNuQ2Y7G4yXMbprCA.xNY7XrxIe1xlOP1q', NULL, '2021-10-18 18:39:19', '2021-10-18 18:39:19'),
(27, 'Enan', 'akiffaiaz@gmail.com', '01685305058', NULL, 0, 3, NULL, NULL, '$2y$10$Jt3tmIm574bU9xZSYeFQo.CcyTtsQ/SfS0gHVxtWmaepLPF5vVBBC', NULL, '2021-10-20 14:36:31', '2021-10-20 14:36:31'),
(29, 'khalid', 'farhan@gmail.com', '01723456793', NULL, 0, 3, NULL, NULL, '$2y$10$/Nli2RTancU7sHmx9EvbOO43bzZ0RN5IOiNKjeatTtBywheC4TlEq', NULL, '2021-10-20 20:11:35', '2021-10-20 20:11:35'),
(30, 'bism', 'bism@gmail.com', '01896372645', NULL, 0, 3, NULL, NULL, '$2y$10$iC2Wf0MWHjkk5mNOqFS6cuK.WbRIKMZGEguV15EmhAav28sSnMFwW', NULL, '2021-10-20 20:14:23', '2021-10-20 20:14:23'),
(31, 'test24', 'test24@gmail.com', '01616228244', NULL, 0, 3, NULL, NULL, '$2y$10$yTWG4738uitzyt197lkgvOqp.EiAxCEbixkSw0bVSGvXDRfSJQ.rW', NULL, '2021-10-20 23:36:33', '2021-10-20 23:36:33'),
(32, 'Iftikhar Mohammed Khan', 'iamiftikharkhan1@gmail.com', '01722200632', NULL, 0, 3, NULL, NULL, '$2y$10$2X2A6wGKGSH6hU2rfk1tXOs9JHcptUzY8yy5kSscFWgi3FC/Te5QO', NULL, '2021-10-21 04:18:55', '2021-10-21 04:18:55'),
(33, 'Haider Nafiz', 'haidern48@gmail.com', '01556320371', NULL, 0, 3, NULL, NULL, '$2y$10$qIOXc9r8bGWJrooqGm1NkeRkQoo8xRx79Aoux3TexQOKIOb5mwU1O', NULL, '2021-10-21 10:18:06', '2021-10-21 10:18:06'),
(34, 'nil hasan', 'nilhasan@gmail.com', '01812656457', NULL, 0, 3, NULL, NULL, '$2y$10$W.WVVZTXc0.D3DAcMWgRYOWP1rfqIF7/MDZE6T5uk1WPnPRYoBBKe', NULL, '2021-10-21 14:47:32', '2021-10-21 14:47:32'),
(35, 'Ruponti Islam', 'rupontislam01@gmail.com', '01849716399', NULL, 0, 3, NULL, NULL, '$2y$10$6jn1Yw8esdDnkpsVpF7WIucijVxPz2MM5WHu3vhwgynaqbvTrvkXK', 'ppYXHW726JYApf9Sdh1ch08XIhEt3Y5tQouSvG2edY8mjnZwtrGPXSPbKlsY', '2021-10-21 14:54:57', '2021-10-21 14:54:57'),
(36, 'Md Durjoy', 'Durjoysardar2@gmail.com', '01708745096', NULL, 0, 3, NULL, NULL, '$2y$10$EtwVj97MlbQFrZf6I6dn3uefjXxyaP6LrMyoeK4VZGm5xgwD.O70G', 'DEgpbfjSCLsj5eZk7VGg4KmnYsatIG8OL7rpVCebaDunzqB0O9NJUhYPtBU2', '2021-10-21 15:37:28', '2021-10-21 15:37:28'),
(37, 'Tanmoy Dhar', 'ttanmoydhar@gmail.com', '01575100796', NULL, 0, 3, NULL, NULL, '$2y$10$abiyqrV82sYD2pW61Unf2urMYD61YQHFn1LyGwQL5k/bWhF0sV5UC', NULL, '2021-10-23 09:57:47', '2021-10-23 09:57:47'),
(38, 'Abul Kalam', 'th.riddha@gmail.com', '01793690456', NULL, 0, 3, NULL, NULL, '$2y$10$J0TVo0cYOp/eIEnF3lOeF.M8sM3PWtXf1nKnU1Z7UNQidNB.FLfDC', NULL, '2021-10-23 10:07:15', '2021-10-23 10:07:15'),
(39, 'Abdullah Al-Amin', 'alamin787.abdullah@gmail.com', '01681982500', NULL, 0, 3, NULL, NULL, '$2y$10$Eglk22n0C605nJ4KMuxDG.6D0osvNP1BED646QVPfH4NqxyGcdY.y', NULL, '2021-10-24 12:18:49', '2021-10-24 12:18:49'),
(40, 'Tania Akter', 'taniaaktermariam@gmail.com', '01964188982', NULL, 0, 3, NULL, NULL, '$2y$10$.livzxOTgv/EieiqD2HQ6.0Mvcm7vSff5rjgS1YG4uNdYK/5ubjla', NULL, '2021-10-24 20:31:01', '2021-10-24 20:31:01'),
(41, 'Sheikh Kohinoor Rahman Dipu.', 'sheikhkohinurrahman@gmail.com', '01812312624', NULL, 0, 3, NULL, NULL, '$2y$10$3nYlmbizjI0lMbvAYpADgenLTyyPQmLbuFqUUOj15s47taMiHWFNy', NULL, '2021-10-24 21:17:40', '2021-10-24 21:17:40'),
(42, 'Mahim Hasan', 'jahidtashfi@gmail.com', '01734733651', NULL, 0, 3, NULL, NULL, '$2y$10$fdqFL4stGd7Zzo0TdYKlS.913sXrQmAWwtIW.NmzF3arAEmzVneJC', NULL, '2021-10-24 21:25:28', '2021-10-24 21:25:28'),
(43, 'Nusrat jahan', 'labonnonusrat1@gmail.com', '01886705315', NULL, 0, 3, NULL, NULL, '$2y$10$G6JaPWAVk8ceuCr0bWuFYODAhh7.knYa9I74A/VDUUSyt1TVNUony', NULL, '2021-10-24 22:36:41', '2021-10-24 22:36:41'),
(44, 'হোসেন মোঃ শাহরিয়ার', 'shahriarhosenshuvo6817@gmail.com', '01730266817', NULL, 0, 3, NULL, NULL, '$2y$10$be2c9y8YVDpWX2fyRILZ2ev3JZdT7ZLsMGU3vsXA9VMF1azq4dvfO', NULL, '2021-10-25 05:59:15', '2021-10-25 05:59:15'),
(45, 'Shakib Khan Shouvo', 'shakibkhanshouvo@gmail.com', '01883462882', NULL, 0, 3, NULL, NULL, '$2y$10$n1H25qNWZLnGnefsHE5cnOZdKi95mgaVHjJ9q.Zzq3x1SCtwUKVXO', '5EPQ3VFYoAsUbdvoldLJXmbEKa9E3Qjv6dKPVEgssf9cOajvDurmj4lUX9AQ', '2021-10-25 07:49:01', '2021-10-25 07:49:01'),
(46, 'Sripa chk', 'asa389514@gmail.com', '01810665967', NULL, 0, 3, NULL, NULL, '$2y$10$6IW0Z.vpBE.wDUyuoNO4jecvvHR.IlllhbmuHNZJTA9YuflZgGAtS', NULL, '2021-10-25 08:09:40', '2021-10-25 08:09:40'),
(47, 'ZIHADUL HOQUE', 'hzihadul37@gmail.com', '01521323663', NULL, 0, 3, NULL, NULL, '$2y$10$YUOZtYIe3eZByyjPdjMmWeYYm1ym3lBvmG80tvQt/0OrIoFglU3c2', NULL, '2021-10-25 12:07:46', '2021-10-25 12:07:46'),
(48, 'Md Rofiquddin Al Rafi', 'rafiquddinalrafi@gmail.com', '01910294460', NULL, 0, 3, NULL, NULL, '$2y$10$yuZ8PS97CGb8PrLJ6fcdb.I6.2NKJW.kwVWSCvNqNrDT2XH9dzt3S', NULL, '2021-10-25 15:09:33', '2021-10-25 15:09:33'),
(49, 'Zawad UL Hoque', 'uzawad@gmail.com', '01521323680', NULL, 0, 3, NULL, NULL, '$2y$10$SuKp3g2UtRB2DtMvzNYmvuGBLNakdrWBF1nH5bapoP/fLlAy1flEC', 'CJz0OiX7w1KZs5zJ4XIQXF75TcIYH5hLeClMTs54syvqKNJ4Sf5EFxxz49aq', '2021-10-25 21:59:31', '2021-10-25 21:59:31'),
(50, 'Noor Habiba Prema', 'premanoorhabiba@gmail.com', '01774484124', NULL, 0, 3, NULL, NULL, '$2y$10$9jQ975mQNM8223SuHSb95ugcAx7M9nYkDRBzFLjjCbniS2IcSDQ82', NULL, '2021-10-25 22:35:22', '2021-10-25 22:35:22'),
(51, 'Tasnimul', 'tasnimul221@gmail.com', '01828711432', NULL, 0, 3, NULL, NULL, '$2y$10$vmOva4QAOQ1ZhfAlrZpwk..jLfv51bNyHsrjPraWxtAiSUz.aJPBK', NULL, '2021-10-25 23:33:32', '2021-10-25 23:33:32'),
(52, 'Shirina Akter', 'shirinaakter252@gmail.com', '01610559032', NULL, 0, 3, NULL, NULL, '$2y$10$3XiN3DCKKmyy0R1JOn/3b.OfSF14ReKgn4h6iJgn65hmc17Z4ANNC', NULL, '2021-10-26 00:38:58', '2021-10-26 00:38:58'),
(53, 'Angela Klapka', 'angelaklapka@gmail.com', '01780067727', NULL, 0, 3, NULL, NULL, '$2y$10$mpmE34upt34bdWMlFCnD6uVL2fPPvCjtWrCk4N5OwSXdNF6TIKpTa', NULL, '2021-10-26 05:58:15', '2021-10-26 05:58:15'),
(54, 'J.alam', 'alamja048@gmail.com', '01853810785', NULL, 0, 3, NULL, NULL, '$2y$10$iLm5P0IOg3qdMuIwMfcQuOwkXSvMCCTiAvFDyZUy4zFh/VEoFmOQm', NULL, '2021-10-26 06:54:19', '2021-10-26 06:54:19'),
(55, 'MD SALEHIN ISLAM', 'msionlinekingdom@gmail.com', '01927620633', NULL, 0, 3, NULL, NULL, '$2y$10$LQaI/4muKPXjwBK1Bjah9.l/O2.FP37APirSRyyVVlLfdBleK/Tt.', NULL, '2021-10-26 07:25:18', '2021-10-26 07:25:18'),
(56, 'Kazi Ehasan', 'kaziehasan516@gmail.com', '01645455781', NULL, 0, 3, NULL, NULL, '$2y$10$dlbJ.TJopCGGIADNxS.exeAdFya/ROhQVm59aNTyIwerfC2fdj0py', NULL, '2021-10-26 10:24:54', '2021-10-26 10:24:54'),
(57, 'Forhad', 'forhad@gmail.com', '01623589555', NULL, 0, 3, NULL, NULL, '$2y$10$oB5ysODowj2zFkeiarXPZurv7NmsrCC05ATdujMdL5ofHiCdq/ali', NULL, '2021-10-26 11:15:35', '2021-10-26 11:15:35'),
(59, 'Mahbuba', 'mahbubarowson301@gmail.com', '01748806121', NULL, 0, 3, NULL, NULL, '$2y$10$bjcbInu5rTVzTSjN8GVya.x3BKV.Ujhli7gMMh9TVZBiSW6Bn8WPG', NULL, '2021-10-26 14:21:10', '2021-10-26 14:21:10'),
(60, 'Surovy Akter', 'shishirshaon55@gmail.com', '01764069170', NULL, 0, 3, NULL, NULL, '$2y$10$CbN49xAdiu7DCzXhfL4wFOXS.Bnu7ZvE.KXSznkEebfAuVcUt4P4K', NULL, '2021-10-26 15:25:39', '2021-10-26 15:25:39'),
(61, 'monzima rhuma apon', 'monzimarhumaapon@gmail.com', '01725897234', NULL, 0, 3, NULL, NULL, '$2y$10$u9kRIywbM0AofK6Qeenopuyrv2FzcRLCGK7yY1XllL0eYbi4vSIVq', NULL, '2021-10-26 15:47:01', '2021-10-26 15:47:01'),
(62, 'Hiya', 'rupislam@424', '01718672091', NULL, 0, 3, NULL, NULL, '$2y$10$J9RK1X9E7ehZ0AuLPFQQQOs/3PXiAaP3cRGmNCTyv7ZAHwjID3Dta', NULL, '2021-10-26 16:11:04', '2021-10-26 16:11:04'),
(63, 'test', 'rahima@gmail.com', '01822332311', NULL, 0, 3, NULL, NULL, '$2y$10$EjJpXHEAc2g7mOrMjwI.Mer2cak09uKp9AvxexpYkQkFsBiXQBS7q', NULL, '2021-10-29 13:31:13', '2021-10-29 13:31:13'),
(64, 'Sami Abigail', 'tabassumnabila707@gmail.com', '01634719460', NULL, 0, 3, NULL, NULL, '$2y$10$fznKMAqPfeR1.C2JEBCLBeY7sKf5NVhLrj8gBKzloLcMlqsIYNSUm', NULL, '2021-10-29 13:44:19', '2021-10-29 13:44:19'),
(67, 'Shahriar', 'saziaafrin787@gmail.com', '01785489742', NULL, 0, 3, NULL, NULL, '$2y$10$MU5HHR23nqROsxk.nFY.c.U909.8E3KODGxXm29noAqSEinkVjh/C', NULL, '2021-10-30 09:50:26', '2021-10-30 09:50:26'),
(68, 'nizam123', 'nizam123@gmail.com', 'NULL', NULL, 0, 3, NULL, NULL, '$2y$10$dkCd2bvPMFn4ifw/ThiDb.HXcves8I09ZvMg3usNWhgn9GFzgZaJC', NULL, '2021-10-30 10:53:21', '2021-10-30 10:53:21'),
(70, 'Akib test', 'akakib.ctg@gmail.com', '01812005133', NULL, 0, 3, NULL, NULL, '$2y$10$.UVw9cN4RCh2ODgvu7VUuehhh8EQleV7ClUcOTnoqghhXBEYp7TOm', 'o6By5F0QdQSDv6x2q9N0giEjSv60agYOPzVMhikjc2fpCY17RNI3EJ3ujcMk', '2021-10-30 16:14:46', '2021-10-30 16:17:18'),
(71, 'muna', 'cadetshahriar2877@gmail.com', '01703463698', NULL, 0, 3, NULL, NULL, '$2y$10$7zBD/W.phmhlGry0/tacUesy4FZ.Q4wrssMhQk0Yx7dY7oVaUqGo.', 'mkuNGSil2OA4YiQPxGvnvpTtpn6IrpndZmlA79fppAQWbkXKYvkHSLIDwgcm', '2021-10-31 15:14:36', '2021-10-31 15:14:36'),
(72, 'Tasnimul Hasan', 'tasinhasan98@gmail.com', '01742657964', NULL, 0, 3, NULL, NULL, '$2y$10$dm2sIotFrjv3oZtE.R8.XOda8JxFv07bugGqKmHX2A//aj/iFekkq', 'Sf5VDC9PdSqEuDRb2DHCQUPV2nn8hR1o6h8VFyb21IDw7auhMWo6F5BAbJgl', '2021-10-31 15:45:30', '2021-10-31 15:45:30'),
(73, 'Ibrahim Hossain Rony', 'ibrahim.buet.ipe@gmail.com', '01533081180', NULL, 0, 3, NULL, NULL, '$2y$10$Es3QytXiwVcIYL6di1DwMe/LYHeUK/pi7WYo91k2/d5N5sA9nc1Mi', NULL, '2021-11-01 12:42:29', '2021-11-01 12:42:29'),
(74, 'Ahmed Imtiaz', 'ahmedsaimon73@gmail.com', '01835330547', NULL, 0, 3, NULL, NULL, '$2y$10$7UCV7Poi4a.sLOEQplVP..c2FtqZUVdpXx2WLc8fETkwlVukJMgbK', '7SvYActwD6NakbpO1LHzkMPOayILMwLfE0KdIRq1mLRSdRvOiWRS7Y9PqFwZ', '2021-11-01 13:36:27', '2021-11-01 13:36:27'),
(75, 'samia islam', 'samiaislam773@gmail.com', '01885786028', NULL, 0, 3, NULL, NULL, '$2y$10$0yRjewkF6M/JNlr/4fD9recWkEerGF5Z7rpZj.jIYStC80DFZYK92', NULL, '2021-11-01 14:49:21', '2021-11-01 14:49:21'),
(76, 'Siaft', 'popyakhand@gmail.com', '01761422231', NULL, 0, 3, NULL, NULL, '$2y$10$CO9D/5tURy4Nj5O9uGNMc.bTjfTvpINNFyxtWeYBvjFwnlwwDyDaO', NULL, '2021-11-01 15:21:10', '2021-11-01 15:21:10'),
(77, 'Jannatul Adon', 'jannatuladon672@gmail.com', '01885524756', NULL, 0, 3, NULL, NULL, '$2y$10$9EZnHFgSq94KCjNLlx/1iOh9bfbJvVCItrNk6Bbp0NoskZW.UlvwG', NULL, '2021-11-01 15:52:42', '2021-11-01 15:52:42'),
(78, 'Md.Abdullah al amin', 'mh3408927@gmail.com', '01988643296', NULL, 0, 3, NULL, NULL, '$2y$10$/cDzfH2VBAWThW7qLgO.4ujmf3v.vxiF3NaYyfKMFTEdMP154pIPO', NULL, '2021-11-01 16:12:08', '2021-11-01 16:12:08'),
(79, 'Jahan Ahmed Chowdhury', 'jahanahmedchowdhury10@gmail.com', '01701136774', NULL, 0, 3, NULL, NULL, '$2y$10$RYVQB6bdbxZoZ3vTTtPEfu/1UQ8XaKugcWDNWBN4K.uAm04mIx3PC', NULL, '2021-11-01 16:43:39', '2021-11-01 16:43:39'),
(80, 'Jannatul Isra', 'jannatul.isra40000@gmail.com', '01798056115', NULL, 0, 3, NULL, NULL, '$2y$10$7YDw/91FvuBsTp8.ZKySve4tApiWdCMWg.8/mdGP6GvId1dkWjdiu', NULL, '2021-11-01 17:11:53', '2021-11-01 17:11:53'),
(81, 'Samme sultana', 'sammesultana742@gamil.com', '01315558047', NULL, 0, 3, NULL, NULL, '$2y$10$hqGBqVHKg1UO0yGjpzvQTOaLX/VdUaLuWvdV68FuaelmxX4QRWn8K', NULL, '2021-11-01 17:33:14', '2021-11-01 17:33:14'),
(82, 'ABU BAKKAR SIDDIQUE FUAD', 'abubakkarsiddique1252@gmail.com', '01878369674', NULL, 0, 3, NULL, NULL, '$2y$10$HWgZzAlhChWL9OWYhos35.ajMpW1BWRhjnBhtb1Z0yes5nWliqWWi', '5EpDNaaRSLrJaH8upgIB5IQXKAnACZ5NeyY1zPG2qAKuFF1qDXIbNGIxG93J', '2021-11-01 17:42:48', '2021-11-01 17:42:48'),
(83, 'Imrul hasan', 'imrulhasan502@gmail.com', '01406872968', NULL, 0, 3, NULL, NULL, '$2y$10$I3phwL924jOD6B0tjE2oX.ElNucZ2yTdNCkKO4Wi6B50tmsfakRIK', NULL, '2021-11-01 18:07:01', '2021-11-01 18:07:01'),
(84, 'MUHAMMAD ARIFUL ISLAM', 'arifemd208@emile.com', '01752333675', NULL, 0, 3, NULL, NULL, '$2y$10$ljc5Uvp6evb.B.pwUCs/4OCwj45/n7DIOHTJmWsTt/UHf7ZVK/57i', NULL, '2021-11-01 18:15:11', '2021-11-01 18:15:11'),
(85, 'Jabed shekh', 'nsajabed201@gmail.com', '01707175005', NULL, 0, 3, NULL, NULL, '$2y$10$dlyb9QKI/e2wRAY2xKD8FO7CgJuvjGfoY2KQw9/UftlOC/536HMiK', NULL, '2021-11-01 18:16:24', '2021-11-01 18:16:24'),
(86, 'Ashraful Alam Rifat', 'ar.rifat424@gmail.com', '01889955242', NULL, 0, 3, NULL, NULL, '$2y$10$wGhF4SZwPYxc9BAJ9lluq.rvw0.mC19U8bs/rPkatvqqJZkuEAskK', NULL, '2021-11-01 18:18:08', '2021-11-01 18:18:08'),
(87, 'Shuvo Barua', 'shuvobarua304@gmail.com', '01825731144', NULL, 0, 3, NULL, NULL, '$2y$10$4.7JC68/fcZB9DCKj7e4/OPcyy2PfYD.oaxYOAy3w1AQrzbtwmZ7G', NULL, '2021-11-01 18:35:06', '2021-11-01 18:35:06'),
(88, 'Sourav Chandra Nath', 'souravnath314@gmail.com', '01822283500', NULL, 0, 3, NULL, NULL, '$2y$10$Jjw/WX8Y0f6A.KsrBNqnbOCc3XgcuQN2qJ6pBInk5TXP2sj.G9lNG', NULL, '2021-11-01 18:46:53', '2021-11-01 18:46:53'),
(89, 'Mohammad Jubaer Ahmad', 'mohammadjubaerahmad0044@gmail.com', '01635773233', NULL, 0, 3, NULL, NULL, '$2y$10$afrIM7T2N7601DZJCy6wL.xJb.eAEiWvcT9.KBiYi.3GLeerTouMS', NULL, '2021-11-01 22:05:39', '2021-11-01 22:05:39'),
(90, 'Khurshiduzzman Mohammad', 'muhammadzim424@gmail.com', '01739389423', NULL, 0, 3, NULL, NULL, '$2y$10$7u1jN4WqiuyC90vaCbRtIOykW5A7NoU8Ko6lgb6N1uABW42LAplhu', NULL, '2021-11-01 23:52:17', '2021-11-01 23:52:17'),
(91, 'Amimul Ihsan Sabit', 'ihsansabit55@gmail.com', '01822356806', NULL, 0, 3, NULL, NULL, '$2y$10$714oxKPV0t6HxDgCGIU9wu5NsB.Vs5.FwleshVy.u6DLx9btjzJKy', NULL, '2021-11-01 23:55:18', '2021-11-01 23:55:18'),
(92, 'SOHEL RANA', 'mr488470@gmail.com', '01850145858', NULL, 0, 3, NULL, NULL, '$2y$10$dCaxUp6l09oQcZq5389dq.bwegnrdyzAnon9qS9uQt3PveFJfIkgO', NULL, '2021-11-02 00:27:57', '2021-11-02 00:27:57'),
(93, 'Sujon ray', 'roys24535@gmail.com', '01944631132', NULL, 0, 3, NULL, NULL, '$2y$10$6e8xKfF3WRuMNZEjn8aW..qf8R.fkDf6xxS/a6A2Nx8Iw3GbHgrvK', NULL, '2021-11-02 00:40:12', '2021-11-02 00:40:12'),
(94, 'Sabi kun Tanha', 'tarintanha9582@gmail.com', '01680057032', NULL, 0, 3, NULL, NULL, '$2y$10$iE9mjP1nPjsibXw6ymS71.n4GO5Ik5KOrgVT4mid/vOjbXQ111dUy', NULL, '2021-11-02 00:43:24', '2021-11-02 00:43:24'),
(95, 'Md. Mominul Islam', 'mominulislamofficial1@gmail.com', '01798426316', NULL, 0, 3, NULL, NULL, '$2y$10$CNBBImAGS0ThshiI66vvqO5H0gQWYBwoXUVFEqnCmsdRW5C2KqX/m', NULL, '2021-11-02 00:49:30', '2021-11-02 00:49:30'),
(96, 'Ayesha Hossain', 'ahbayesha2002@gmail.com', '01844676899', NULL, 0, 3, NULL, NULL, '$2y$10$ZIPFdvI3.VC/e16Sde4giOS1amuKQRZB1AT0.x4X25PSuE6W5SiK6', NULL, '2021-11-02 00:52:20', '2021-11-02 00:52:20'),
(97, 'Md Jubraz', 'jubraz8255@gmail.com', '01894375641', NULL, 0, 3, NULL, NULL, '$2y$10$YMjLeHhOL698WKXxZ9RPWeXWNPw5rvEwnV.9cXCMEouSylT1L4CmK', NULL, '2021-11-02 01:11:07', '2021-11-02 01:11:07'),
(98, 'mr manik', 'mmd424125@gamil.com', '01890193555', NULL, 0, 3, NULL, NULL, '$2y$10$Sw4H1c6JSaj./KaxX4YIG.f5JvFr9r5sGt9P7iVC0B.yX5BlwPauO', NULL, '2021-11-02 01:14:33', '2021-11-02 01:14:33'),
(99, 'MD Abdullah', 'abarnob11@gmail.com', '01643361725', NULL, 0, 3, NULL, NULL, '$2y$10$QqHkO/irpbWfMe7xG6EjCe6v1D8CenieQAdMvrraPKtew.DJAe9LW', NULL, '2021-11-02 01:33:44', '2021-11-02 01:33:44'),
(100, 'Saharea alam', 'sahareaalam450@gmail.com', '01888173787', NULL, 0, 3, NULL, NULL, '$2y$10$OjmU6Ja/N6.FjbhZtumC6OVuumong3fSR8/CwJX9a6bBiI3YinIgm', NULL, '2021-11-02 01:52:10', '2021-11-02 01:52:10'),
(101, 'MD Rifat', 'Mdrifat1005id@gmail.com', '01608061402', NULL, 0, 3, NULL, NULL, '$2y$10$tL4Sqy8jYWgCG6TGUReFte/1i4gs.x.U5PWWqPillShRKDMTzxDiK', NULL, '2021-11-02 01:53:30', '2021-11-02 01:53:30'),
(102, 'Emon Sarker', 'hkaaemon3@gmail.com', '01608081188', NULL, 0, 3, NULL, NULL, '$2y$10$lePrbQiQuql9evdHg2r7ieMd8VPXBHUMJgsjV7klXb.Q/DEqEuQmi', NULL, '2021-11-02 02:08:05', '2021-11-02 02:08:05'),
(103, 'Rasedul Alam B3 659', 'rasedulalam00119659@gmail.com', '01890298877', NULL, 0, 3, NULL, NULL, '$2y$10$xJO64kPXe24OKVCfRRav3Ou/QgTA0jPPJiuENR8lN41wzagRoFxGK', NULL, '2021-11-02 02:39:44', '2021-11-02 02:39:44'),
(104, 'Mujahidul Islam Majed', 'mujahidulislammajed@gmail.com', '01621932715', NULL, 0, 3, NULL, NULL, '$2y$10$LbFEVITxoQ35794.UcUYVePduPNbYWgAr0tU7qDrKVsM7KfgOaLu6', NULL, '2021-11-02 02:49:45', '2021-11-02 02:49:45'),
(105, 'koushik', 'Koushikmajumder2003@gmail.com', '01817476952', NULL, 0, 3, NULL, NULL, '$2y$10$iWL8fNWmWhy4dx.QyDxND.U09GjfXUCdomF7XECYXFVmbHq8Z0aCW', NULL, '2021-11-02 02:53:22', '2021-11-02 02:53:22'),
(106, 'Sadman saddif', 'saddif7432@gmail.com', '01874325651', NULL, 0, 3, NULL, NULL, '$2y$10$eLI8wLu6/NcqDa/WgRavseC.eJpTZTRFEVuVdLDKa55UskxyrrF.e', NULL, '2021-11-02 02:54:26', '2021-11-02 02:54:26'),
(107, 'Naeem', 'naeemsarkar53@gmail.com', '01580317400', NULL, 0, 3, NULL, NULL, '$2y$10$/WVufs9vsrw1CDg7YRgt6eAAJDx7IUh6hgQFwRnyCF16X/k.E5uou', NULL, '2021-11-02 03:14:19', '2021-11-02 03:14:19'),
(108, 'Tanik', 'anikglaxy@gmail.com', '01828289091', NULL, 0, 3, NULL, NULL, '$2y$10$HAAWPiRILvDrUaGVll8RzuAjOvRuZeLz791gg.IS6LybQRDdpUv4m', NULL, '2021-11-02 03:19:51', '2021-11-02 03:19:51'),
(109, 'Hossain Md Feroj', 'www.ferojahmed1st@gmail.com', '01306110630', NULL, 0, 3, NULL, NULL, '$2y$10$vgJtimjHr/Q784q7GHJ7su0ajES0J6mh55UaCgPoi4I3qdBvDUsiW', NULL, '2021-11-02 03:23:15', '2021-11-02 03:23:15'),
(110, 'মোঃ রবিউল', 'mdrobeul559@gmail.com', '01611082419', NULL, 0, 3, NULL, NULL, '$2y$10$FqoQTIpXIy3b2OnfyJjTI.R5iosXi5h3Dk8CVI/9fIRGqr1TayqBW', NULL, '2021-11-02 03:40:42', '2021-11-02 03:40:42'),
(111, 'Imthiaz', 'mdimthiz12@gmail.com', '01608948035', NULL, 0, 3, NULL, NULL, '$2y$10$mrPdgLtDAfFDIf0NMlsPXO8G3AdidgOzDtQPsGx5BJ1VWUV0BiwqW', NULL, '2021-11-02 03:49:43', '2021-11-02 03:49:43'),
(112, 'Kawsar Ahmed', 'kawsarahmed20122002@gmail.com', '01646539732', NULL, 0, 3, NULL, NULL, '$2y$10$nLLDwfNEjQpdSQDxZB6Oy.EMKUgMFYKoBRiMATZvEKbj/DaFylvIO', NULL, '2021-11-02 03:51:48', '2021-11-02 03:51:48'),
(113, 'Md Sorowar Jahan Prince', 'sjprince353557@gmail.com', '01310046716', NULL, 0, 3, NULL, NULL, '$2y$10$K9YhW66bdTYDxphmTNoSJ.G1JKQkzOsmUidmeiWW7fOGNXkT6Vk.i', NULL, '2021-11-02 04:44:35', '2021-11-02 04:44:35'),
(114, 'Md: sabbir ahmed', 'mdsabbirahed201@gmail.com', '01648584311', NULL, 0, 3, NULL, NULL, '$2y$10$3hKUxQcuO8JvIwKIMculCOvpxjDZTooLjInt74mrgGDybTeqtzQpW', NULL, '2021-11-02 05:00:16', '2021-11-02 05:00:16'),
(115, 'Md Obaidulla', 'mobaidulla62@gmail.com', '01722797148', NULL, 0, 3, NULL, NULL, '$2y$10$9jT8Cpd/.etqhKKmIUCTbeyEeHUGl3.qHSXiR9VItkYT36PdUbsoK', NULL, '2021-11-02 05:17:24', '2021-11-02 05:17:24'),
(116, 'Sadia Ahmed', 'sadiaahmed766@gmail.com', '01756516626', NULL, 0, 3, NULL, NULL, '$2y$10$zzXyXN.uGuKng0ZShZ10IOzDcZAPYVO1J.qD7iOytrMiNOdCyWeYK', 'MoRMGmjV8yjRJesGf1ThdVOAoLBXQ03RBQknwjfiCh50emuSS2azT0TxASA7', '2021-11-02 05:37:21', '2021-11-02 05:37:21'),
(117, 'Hojaifa Bin Huda', 'hojaifa5008@gmail.com', '01833611722', NULL, 0, 3, NULL, NULL, '$2y$10$TJba00V7pzV1R5By1LPiK.0B8rC50MxGe3LQ2ezq0YZKms7eTteOK', 'Y45nHmtbmaPZTIK1KPQoVtqe00gp0Xn8IXQeaqNZcGxfc4QDw4rmbYoG039y', '2021-11-02 05:55:55', '2021-11-02 05:55:55'),
(118, 'lijasrkar@gmail.com', 'lijasrkar@gmail.com', '01888573351', NULL, 0, 3, NULL, NULL, '$2y$10$vc8a7Yqy2a814xNOvbkK.uRw1Ry4db1GUyHacYRZNnmqFk6dni.Aa', NULL, '2021-11-02 06:00:21', '2021-11-02 06:00:21'),
(119, 'Shanto Deb', 'santodev408@gmail.com', '01758254464', NULL, 0, 3, NULL, NULL, '$2y$10$XBku/ijQC3NnTVRevO70Eu4B47mOiu2/4JM.Qsk2X7AYC8roUYkLm', NULL, '2021-11-02 06:18:04', '2021-11-02 06:18:04'),
(120, 'Md Mizanur rahman', 'shawonchowdhury317@gmail.com', '01904613790', NULL, 0, 3, NULL, NULL, '$2y$10$nIPkW2Op5fnw2t6eCL5lO.auwNZHMtjEzH9YcMoe1PnNdRepa3vx2', NULL, '2021-11-02 06:25:16', '2021-11-02 06:25:16'),
(121, 'Nomayer Fardin', 'fardinnomayer@gmail.com', '01575448140', NULL, 0, 3, NULL, NULL, '$2y$10$qeI0/ZUPrVtTZSMjMfY9nu76upHrZyGg.CysIet7lOqslVOsdqp4G', NULL, '2021-11-02 06:33:17', '2021-11-02 06:33:17'),
(122, 'Zamil', 'zamilulhoque006@gmail.com', '01558855300', NULL, 0, 3, NULL, NULL, '$2y$10$wXtItjGNjBFHVaik4nZ6IeNmqUeajWsskJdWAh39.NhuI8fHVVXle', NULL, '2021-11-02 06:38:49', '2021-11-02 06:38:49'),
(123, 'Tasin Bhuyian', 'tasintamanna91@gmail.com', '01580450215', NULL, 0, 3, NULL, NULL, '$2y$10$WJ6jXtlb0o56Xyz8kDhV3.RSxTErCaYzzRaodm9AUbL2ORh/7X1Ja', NULL, '2021-11-02 06:49:44', '2021-11-02 06:49:44'),
(124, 'Tanvir', 'farzana021290@gmail.com', '01768630362', NULL, 0, 3, NULL, NULL, '$2y$10$6tKKkaA94ch9kP7CZqtC1.JAAFvafvrfnnJ5KM/CcCwbmHEC5CbUG', NULL, '2021-11-02 07:02:14', '2021-11-02 07:02:14'),
(125, 'Md.Thwhidul Islam', 'thwhid24@gmail.com', '01843778673', NULL, 0, 3, NULL, NULL, '$2y$10$Y4O/1zWZBhnisPd4TTL/GOJOs1i9qD.Fb0uj76QApPbsGwctJGabi', NULL, '2021-11-02 07:09:10', '2021-11-02 07:09:10'),
(126, 'Md Hasan Khandaker', 'hasankhandaker744@gmail.com', '01311937325', NULL, 0, 3, NULL, NULL, '$2y$10$V0/2xqSOZ9R2p6WMRq/GdOZSkqOSXO54G33RlM7BBg634FQEW1KQ2', NULL, '2021-11-02 07:13:04', '2021-11-02 07:13:04'),
(127, 'Emon devsharma', 'emondevsharma@gmail.com', '01308851507', NULL, 0, 3, NULL, NULL, '$2y$10$M1yT0nBERq8nRIEbzjl/WOcBFcw1NxmBFMMBloOmViYDIpU1i0JQC', NULL, '2021-11-02 07:16:15', '2021-11-02 07:16:15'),
(128, 'Ahmed imtiaj', 'imtiaj.tm@gmail.com', '01575173272', NULL, 0, 3, NULL, NULL, '$2y$10$wNeCOrNJ4cg9VWHj/WnHAOGizVEN64f4waaPY2CanXMXCxvhBpaBe', NULL, '2021-11-02 07:45:42', '2021-11-02 07:45:42'),
(129, 'Pias Roy', 'piasroy44444@gmail.com', '01748597039', NULL, 0, 3, NULL, NULL, '$2y$10$WkoUSLni4a3cWfs4edABf.6oR/c.QW6Zocs5HCcNqKp07ilSpCH..', NULL, '2021-11-02 07:57:38', '2021-11-02 07:57:38'),
(130, 'Shubrata nath', 'shubratanath@gmail.com', '01610928790', NULL, 0, 3, NULL, NULL, '$2y$10$bxlvwLulf0M/4u94HS9dV.zR4whC6IpE92t3nZ.8zLFapBV/m2PMq', NULL, '2021-11-02 07:58:43', '2021-11-02 07:58:43'),
(131, 'Md Rubel', 'badshamdrubel873@gmail.com', '01810269075', NULL, 0, 3, NULL, NULL, '$2y$10$cnClSMwF7kw8iRikirPs5ecdoZfLdHHGNoPYvReTMVHo1JkdA3UYS', NULL, '2021-11-02 08:05:21', '2021-11-02 08:05:21'),
(132, 'M R RIZON', 'mrrizon0@gmail.com', '01870490594', NULL, 0, 3, NULL, NULL, '$2y$10$QEsGuY4MTj97Ls/eriR1yeczPFiQjvm5/q5aU05.5dl.ynrrL2lty', NULL, '2021-11-02 08:18:01', '2021-11-02 08:18:01'),
(133, 'Md.muzahid', 'muzahidulislam122001@gmail.com', '01980053385', NULL, 0, 3, NULL, NULL, '$2y$10$cn9AgffUAnuF9gXfywaOXeuESir/wDKwDdQKonrVK8iAJROPS4E7y', NULL, '2021-11-02 08:25:24', '2021-11-02 08:25:24'),
(134, 'Bishawjeet das', 'bishawjeet67374@gmail.com', '01870589314', NULL, 0, 3, NULL, NULL, '$2y$10$lyZG5lFDeqKwHRLRVoks5e9i3c406/HnmdvAKfrD8kmT6lBeo0mym', NULL, '2021-11-02 08:31:35', '2021-11-02 08:31:35'),
(135, 'Rasel kabir', 'raselkabir@gmail.com', '01972685744', NULL, 0, 3, NULL, NULL, '$2y$10$bHNZ9didjyaODEEttJnrOuo5XAchjingcaf3vShzDjAcsgyYCNrGy', NULL, '2021-11-02 08:44:37', '2021-11-02 08:44:37'),
(136, 'Sheikh Mehrab Hasan', 'sheikhmehrab95@gmail.com', '01308055762', NULL, 0, 3, NULL, NULL, '$2y$10$O9MSlxiaGyKDoiPMuDsRmeI2dY2IaDAcbTtRdL0qsldg7dJfHnliy', NULL, '2021-11-02 09:05:16', '2021-11-02 09:05:16'),
(137, 'Md.Zobaer Ahmed', 'mdzobaerahmed31@gmail.com', '01783503006', NULL, 0, 3, NULL, NULL, '$2y$10$NL5WVJkpYtQz7ZImvvUdteuxkZV3epywQugmIouI1ZOzu6WDYrWGO', NULL, '2021-11-02 09:26:28', '2021-11-02 09:26:28'),
(138, 'MD Emon Ali', 'mdemonali140@gamil.com', '01575696962', NULL, 0, 3, NULL, NULL, '$2y$10$5TdY2msCvq8z./g0veKgie4XX8DZ8t5t0pIoPQyLtr2bSjZm48.c2', NULL, '2021-11-02 09:27:55', '2021-11-02 09:27:55'),
(139, 'MD Shahjahan Shourav', 'mshasi1129@gmail.com', '01852453936', NULL, 0, 3, NULL, NULL, '$2y$10$Rwi4g0NHI53zjkIOPYGXeeTgpSdLFHpJYMe5d.nuozfGE7TyHna0e', NULL, '2021-11-02 09:55:24', '2021-11-02 09:55:24'),
(140, 'Sajib', 'sibnasadi@gmail.com', '01306728895', NULL, 0, 3, NULL, NULL, '$2y$10$g6DJRnn9h3LxhxiInpvs9.YI.W6LF9ndmuktbD1thX1i00aw3DSXC', NULL, '2021-11-02 09:55:46', '2021-11-02 09:55:46'),
(141, 'Md Ahasanul Islam', 'mtube556@gmail.com', '01628281689', NULL, 0, 3, NULL, NULL, '$2y$10$KBXC.e1g0g1h.mfK/NxDxum3E3XKczz.VV3AY0..zyHCNmpbpFRVW', 'WdQqwfTzdsm75unSOlcw9a0AOzyv3XEfYEwzDPAxj89hkcBWouwLsAudKS5h', '2021-11-02 10:00:45', '2021-11-02 10:00:45'),
(142, 'Kasfi kamal ranjan', 'rjkamal92@gmail.com', '01918926919', NULL, 0, 3, NULL, NULL, '$2y$10$/O30C46OSWgsYORj8cziw.UnrkWJ.9YGVmAY6lHWP9Lca6QjN4yWa', NULL, '2021-11-02 10:08:42', '2021-11-02 10:08:42'),
(143, 'Robin', 'robin21batch@gmail.com', '01916470391', NULL, 0, 3, NULL, NULL, '$2y$10$sY4lQxbW6S8ebiAYLoQuA./UdCTiRvtWUufVsNdR/2t2R7Ilq0tGW', NULL, '2021-11-02 10:10:01', '2021-11-02 10:10:01'),
(144, 'Tohidul Islam', 'tohedulislam688@gmail.com', '01581127810', NULL, 0, 3, NULL, NULL, '$2y$10$GH.FDBAX5FIxy0rCE7ua6eG7okuSjOCvO/DZnBFFCi4D8bHNfdKmC', NULL, '2021-11-02 10:28:05', '2021-11-02 10:28:05'),
(145, 'Noor Shahriar', 'abrarshsidark@gmail.com', '01890269876', NULL, 0, 3, NULL, NULL, '$2y$10$w/ex/S4JwXRwNpWDYStFhuSLDY0.7q1PuWjdq0J51tY0mbMs2Pwqq', NULL, '2021-11-02 10:29:44', '2021-11-02 10:29:44'),
(146, 'Sadman Shahadat', 'sadman8668@gmail.com', '01851561440', NULL, 0, 3, NULL, NULL, '$2y$10$C0A.J0WzWQnC4JetDvx.me32ZBXRyo0K3e.axczyiikkGK4Me7j1O', NULL, '2021-11-02 10:53:56', '2021-11-02 10:53:56'),
(147, 'Hossain JABED', 'jannatjabedahmed@gmail.com', '01310223753', NULL, 0, 3, NULL, NULL, '$2y$10$ZVmOXi98l12A0DydmovS9.9LiHiKcbDYbwI0nh9IBqfBhcJYt7S8m', NULL, '2021-11-02 10:57:57', '2021-11-02 10:57:57'),
(148, 'NAZMUS SHAKIB', 'mnshakib2001@gmail.com', '01644489607', NULL, 0, 3, NULL, NULL, '$2y$10$0d6o.oNTYb.JpuYHbHKu9OwFSKa17RYBa8ZT2alecw/c5CMPyFeKG', 'OlpibOJVgPZP3r4dddErM0tfHXRSY4im2avLBs6WUkNR0degKX614lUjNE2b', '2021-11-02 11:01:39', '2021-11-02 11:01:39'),
(149, 'Rafid ibne mashud', 'rafidibnemashud12591@gmail.com', '01724215834', NULL, 0, 3, NULL, NULL, '$2y$10$wZ2ZKZPOb1M8kpuY1a6jM.re.UzDAde5DQjCN9ciDJ2xhvmbdQYyO', NULL, '2021-11-02 11:03:27', '2021-11-02 11:03:27'),
(150, 'Sayem Sadat', 'sayemsadat2001@gmail.com', '01319114144', NULL, 0, 3, NULL, NULL, '$2y$10$xQI6QJbTBa3yPP0RKCup0e3l8Arh2KFT1XAg6VkK7r1UzHv3LrXE6', NULL, '2021-11-02 11:21:36', '2021-11-02 11:21:36'),
(151, 'Masum billah', 'bmasum538@gmail.com', '01997511013', NULL, 0, 3, NULL, NULL, '$2y$10$3h6DsXKBfjWkAdIxTqhmyezExP5q6MR8z4t9TrodyWHtBg/WswNnm', NULL, '2021-11-02 11:34:25', '2021-11-02 11:34:25'),
(152, 'Arin Molla', 'arinrahman2003@gmail.com', '01774083440', NULL, 0, 3, NULL, NULL, '$2y$10$0HAGjT39puWVzPlA9QHAjeSapnLwnCRqk2HiTntB0WMIFc1cRtnZ2', NULL, '2021-11-02 11:48:33', '2021-11-02 11:48:33'),
(153, 'Md sagor', 'mdsagor0164498@gmail.com', '01644984896', NULL, 0, 3, NULL, NULL, '$2y$10$yjvdnmIRQDfdTBDUEaGG5eYZRSKRibUmF53Z2gZIoVTNsaS7fgk16', NULL, '2021-11-02 11:57:23', '2021-11-02 11:57:23'),
(154, 'Md vubon', 'mdvubon991@gmail.com', '01780925956', NULL, 0, 3, NULL, NULL, '$2y$10$CZ6FTHquGnkc3gwREgWOseY3YDsntT4M60B6tT1m3etNWFIU9wzwS', NULL, '2021-11-02 12:01:03', '2021-11-02 12:01:03'),
(155, 'MD.Rajaul Karim', 'kurimrajaul@gmail.com', '01865255188', NULL, 0, 3, NULL, NULL, '$2y$10$q.CZ2YwXtfN.gJiyw13iY.xfgUkHhezxVFzdWoyDPOnFz3WakQpiS', NULL, '2021-11-02 12:02:06', '2021-11-02 12:02:06'),
(156, 'MD SAKIB AL HASSAN', 'hassansakibal267@gmail.com', '01636468085', NULL, 0, 3, NULL, NULL, '$2y$10$YmSNy4DTyLBnpIpRJj/8SeEPp3JZc5mGTi8r2f5fUub4O9qEML9du', NULL, '2021-11-02 12:11:03', '2021-11-02 12:11:03'),
(157, 'Sushanta Roy', 'rssushanta150@gmail.com', '01719165578', NULL, 0, 3, NULL, NULL, '$2y$10$lPUlyJgzELEPFlrogakS2OQlEjnohCeZZndhp3NSAtAQhmLMN.4QO', NULL, '2021-11-02 12:13:41', '2021-11-02 12:13:41'),
(158, 'Ahanaf Chowdhury Nihal', 'nihalchoww@gmail.com', '01797234694', NULL, 0, 3, NULL, NULL, '$2y$10$tXDdkQ1.5xiJwsWNn1Piae1Iknvhr8Tx1GftJ/q8TrsmXqL9uIAF2', NULL, '2021-11-02 12:23:49', '2021-11-02 12:23:49'),
(159, 'Nayon', 'nayonmaitra1@gmail.com', '01775677349', NULL, 0, 3, NULL, NULL, '$2y$10$1C5tH/FwHIDkLBkYHyLJG.UZP3x4UXykzMTORYrYLLEDN.zlvNvf2', NULL, '2021-11-02 12:39:57', '2021-11-02 12:39:57'),
(160, 'Roni', 'ronifaruk77@gmail.com', '01776859045', NULL, 0, 3, NULL, NULL, '$2y$10$I9s.5GX9EymV.OC/WolmL.DC7SDAHvjeK9B/3R7feRpyzcqMfKnBy', NULL, '2021-11-02 12:41:01', '2021-11-02 12:41:01'),
(161, 'Riyad', 'shahajalal259@gmail.com', '01891788714', NULL, 0, 3, NULL, NULL, '$2y$10$ETSnfuGQzPB.Xhx8QT44juk5aNyVBAIa7Zi7axQkK1Nc0deA0YnW2', NULL, '2021-11-02 12:52:22', '2021-11-02 12:52:22'),
(162, 'Md Mujahid Rayhan', 'mdmujahid2000abc@gmail.com', '01743589519', NULL, 0, 3, NULL, NULL, '$2y$10$YcY7d4PcbYkuJ3Xd6adURu2klrFR25uzCPLuwKGBHXyhXn7BgOmb2', NULL, '2021-11-02 13:11:34', '2021-11-02 13:11:34'),
(163, 'Niloy Pramanik', '190289niloypramanik@gmail.com', '01645258026', NULL, 0, 3, NULL, NULL, '$2y$10$CIOBUrkPNDbC5Ot2wkkicOhyc9mZD8IWCxJxmLG3EV9dV1uijhNBi', NULL, '2021-11-02 13:16:32', '2021-11-02 13:16:32'),
(164, 'SHOFI KAMAL', 'shofikamal001@gmail.com', '01533301982', NULL, 0, 3, NULL, NULL, '$2y$10$a/Z4je7dcQfa1xk9M/nAx.9AjXqRls/Enb4Fw00Nwc/DMQYw.7ACK', '83niuLk6jx40OSysgDzK8fOdqPGN6D93MI5BJQONCp9G4oF1paKzfaXDR9Q9', '2021-11-02 13:17:10', '2021-11-28 08:57:37'),
(165, 'Minyat', 'minyatjaman7902@gmail.com', '01889827902', NULL, 0, 3, NULL, NULL, '$2y$10$DTbznPgYvewbvGYRwf7RvOna75FaZe1C6FMCKR7y6Uso3tM3NNMLu', NULL, '2021-11-02 13:26:17', '2021-11-02 13:26:17'),
(166, 'MAHAMUDULLA HASAN', 'manamudulla2003@gmail.com', '01309433635', NULL, 0, 3, NULL, NULL, '$2y$10$mh/20GTzy0PeSoM106vvduWdSqtTLwm1u2RWH13QdA5FUhmmjAltW', NULL, '2021-11-02 13:39:22', '2021-11-02 13:39:22'),
(167, 'Arshad', 'arshadrahman297@gmail.com', '01744362362', NULL, 0, 3, NULL, NULL, '$2y$10$hE8nLlZGte0xjI3qb1.59eA7PF6djIPdzVMQguSADc/CnbasA5ZfW', NULL, '2021-11-02 14:00:15', '2021-11-02 14:00:15'),
(168, 'Md.Sojib Hossain', 'mdsojibhossainripon56@gmail.com', '01777131880', NULL, 0, 3, NULL, NULL, '$2y$10$mVcaFJcy7fnTtDn16UBDPef9snq1vUR9k/23oE.uZWTvWj3bC5gCW', NULL, '2021-11-02 14:06:24', '2021-11-02 14:06:24'),
(169, 'Abdullah Al Sakib', 'aasakib13@gmail.com', '01782930930', NULL, 0, 3, NULL, NULL, '$2y$10$Y35gA8//JX5Kx.mp.p.5BOUwIGSxdoJlOAbVPpZSC23eBFURECKNa', NULL, '2021-11-02 14:09:18', '2021-11-02 14:09:18'),
(170, 'Md Mintu Ali', 'alimdmintu67@gmai.com', '01639933824', NULL, 0, 3, NULL, NULL, '$2y$10$/gLJrpSl2.Oewr6hE1mHxOS9DxZ6zqX34INAHC4W6hC9gc68mLgKe', NULL, '2021-11-02 14:29:44', '2021-11-02 14:29:44'),
(171, 'Md.Julfikar Alam', 'mdjulfikeralom@gmile.com', '01957887986', NULL, 0, 3, NULL, NULL, '$2y$10$NuAK0TbqGjW8MRljfnmfTexe3qSxm69ZZoIkt3xA..ytk7ydarmXy', NULL, '2021-11-02 14:30:25', '2021-11-02 14:30:25'),
(172, 'Md Yak Safu', 'yaksafu2020@gmail.com', '01642468704', NULL, 0, 3, NULL, NULL, '$2y$10$hCZGObN0w4K.bD1BANolmehdbeGmM0iuur9Plmbo6tCNy1IZkwR.m', NULL, '2021-11-02 15:35:24', '2021-11-02 15:35:24'),
(173, 'Sazzad', 'sazzadn33@gmail.com', '01675172006', NULL, 0, 3, NULL, NULL, '$2y$10$/x33ddvVYYiVSS9VcnO/cOU0CI47AQhE4k5eM6kE/i/rOgT0Qfpdm', NULL, '2021-11-02 15:57:14', '2021-11-02 15:57:14'),
(174, 'Hridoy Hossen', 'hossenhridoy041@gmail.vom', '01304912357', NULL, 0, 3, NULL, NULL, '$2y$10$dzzMTSfo8stDb6ftGpNGz.Oe69gLMCZx8EPDVnVT6JkH9/g99EVyi', NULL, '2021-11-02 16:14:41', '2021-11-02 16:14:41'),
(175, 'Abu Hojaifa Shantho', 'hojaifabhuyan@gmail.com', '01642242126', NULL, 0, 3, NULL, NULL, '$2y$10$S28F3eHZDNE34hzxtfSuQeshW0S/5VALuWDlNmtj9gVE7sf3SpYT6', NULL, '2021-11-02 16:17:17', '2021-11-02 16:17:17'),
(176, 'SushovanAcharjee', 'sushovanacharjee143@gmail.com', '01864846395', NULL, 0, 3, NULL, NULL, '$2y$10$qwyNdAa4TF1K.DP9yO1Z7uzLlajMjAhqV3NWGfUQmeKxuFpsEaLpm', NULL, '2021-11-02 16:20:54', '2021-11-02 16:20:54'),
(177, 'Salim tg', 'uncommonboy871@gmail.com', '01902249726', NULL, 0, 3, NULL, NULL, '$2y$10$q6rtaYCohMQP8KO8H2YVe.RqTF.wqW7/6pEsF1sG7s4y2lNOG7gzu', NULL, '2021-11-02 16:37:32', '2021-11-02 16:37:32'),
(178, 'Jibon', 'jibonahmed1009@gmail.com', '01964525183', NULL, 0, 3, NULL, NULL, '$2y$10$YNDoW3f27RllMo9ThV.AWuiQnnSw0TooQfLSl2c1NO7ico7jaK0Mi', 'RNFCGzxKTtvhgULFrRxvWBP9SSqaSpfWdPlmb8WbovfrWyEVJguzVwNQyNuR', '2021-11-02 16:47:22', '2021-11-02 16:47:22'),
(179, 'Sifat Abu Saleh', 'sifatabusaleh05@gmail.com', '01305723106', NULL, 0, 3, NULL, NULL, '$2y$10$Km0sRjUmqsCE2zNA2UUxFe7sA4MnVQBUMdh53BbiMoDnFKSYb22PC', NULL, '2021-11-02 16:48:24', '2021-11-02 16:48:24'),
(180, 'Fahim Islam', 'nadirulfahim@gmail.com', '01646147035', NULL, 0, 3, NULL, NULL, '$2y$10$J./ttDio4m2WYbSmOUAFWeiUflQxezEB5vKF4lsIsuKyFAY6kh/nS', NULL, '2021-11-02 16:52:39', '2021-11-02 16:52:39'),
(181, 'Md.Alif hossein', 'admanalif7146@gmail.com', '01852363053', NULL, 0, 3, NULL, NULL, '$2y$10$5qmCsZqM4x44SaKzEb3XrudZ0xrjPrB5Xjli0J50LXwqQG7.mdtSO', NULL, '2021-11-02 17:02:19', '2021-11-02 17:02:19'),
(182, 'Rony Hasan', 'rakibhasanrony2005@gmail.com', '01323959079', NULL, 0, 3, NULL, NULL, '$2y$10$N0XlCwK/bMJiICuNCnOh/efprSfzZlbCM5UwkdOhnlpoSP.t4gzTO', NULL, '2021-11-02 17:21:20', '2021-11-02 17:21:20'),
(183, 'Arif Mahmud', 'abfmahmud135@gmail.com', '01715924300', NULL, 0, 3, NULL, NULL, '$2y$10$rg24AJ0RYkXnwqsEA6zT9.9XXkUWJqZaCnHk.SkWIboW4NISdqXW.', NULL, '2021-11-02 17:35:35', '2021-11-02 17:35:35'),
(184, 'Md Rana Hossain', 'jranaofow@gmail.com', '01873712150', NULL, 0, 3, NULL, NULL, '$2y$10$PGP37yicNRNAzJZNRlGIe.BaUcG4hdA7U0zpXlYqscUIAVFcznNm6', NULL, '2021-11-02 17:42:18', '2021-11-02 17:42:18'),
(185, 'Ruhul Amin', 'aminbaburuhul@gmail.com', '01810128377', NULL, 0, 3, NULL, NULL, '$2y$10$FqOgnTh5/KsFrwcfdcci5ewX.wpgu8pdhvxgKyaxulDi80NxzT17m', NULL, '2021-11-02 17:43:33', '2021-11-02 17:43:33'),
(186, 'Md.Emon khan', 'mmmemonkhan90@gmail.com', '01827869027', NULL, 0, 3, NULL, NULL, '$2y$10$wlhRvBQ1wULMX4/zgvJY6uRwu7hyWpgQpeL0mrgRowIgDk8aFxyay', NULL, '2021-11-02 17:55:27', '2021-11-02 17:55:27'),
(187, 'Abdullah Al Masum', 'abdullamasum3647@gmail.com', '01828041402', NULL, 0, 3, NULL, NULL, '$2y$10$mDhyHphUsKalSOzOeTuT7.bTY1t5vI6oolircyZgZMYa.kA8V8RG2', NULL, '2021-11-02 19:17:45', '2021-11-02 19:17:45'),
(188, 'Md.Rakibuzzaman', 'mdrakibuzzamanafnan786@gmail.com', '01717285387', NULL, 0, 3, NULL, NULL, '$2y$10$9bMoZ6VyRdq0Ut8YNW1dR.bE0KTBBc5.CcoLUvlTGgYBoxNZdFq4a', NULL, '2021-11-02 19:56:53', '2021-11-02 19:56:53'),
(189, 'Bayazid sheikh', 'mdbayazid4348@gmail.com', '01309994348', NULL, 0, 3, NULL, NULL, '$2y$10$Ztu4WCpF0EwhdbzQNTNzbepJjFJVeCPciuTuO38oRPJ3qv0D/p5NG', NULL, '2021-11-02 20:22:42', '2021-11-02 20:22:42'),
(190, 'Md. Mahmudul Hasan', 'mahmudulhasan121121@gmail.com', '01321700241', NULL, 0, 3, NULL, NULL, '$2y$10$apT6y3pNSTj6bpDR7gv4heB415YKf90etqPe6khemfwpRF5f3EoY6', NULL, '2021-11-02 22:17:47', '2021-11-02 22:17:47'),
(191, 'Rion', 'rezwanul565@gmail.com', '01703757765', NULL, 0, 3, NULL, NULL, '$2y$10$1TW7raq9eMip6I9X.gYrsu4YX4sqrcDgwe4Ym5lSg0lSqpzKtEPN.', NULL, '2021-11-02 22:41:36', '2021-11-02 22:41:36'),
(192, 'Sameen Siraj', 'saminsiraj58@gmail.com', '01309736405', NULL, 0, 3, NULL, NULL, '$2y$10$w/kGj3pThvrR2E7v8cHnC.ylPW58gARWNyXOF16s20yn1bxXGa92a', NULL, '2021-11-02 22:50:22', '2021-11-02 22:50:22'),
(193, 'Tanay saha', 'tanaysaha14@gmail.com', '01710302669', NULL, 0, 3, NULL, NULL, '$2y$10$97gu1NlwHKgDu70M9qIp9u.QViH8mOYdUh5ekpHCvFd.RDJIAenF2', NULL, '2021-11-03 00:28:42', '2021-11-03 00:28:42'),
(194, 'Md Nurul Ajam Jibon', 'mdnurulajamj@gmail.com', '01638138836', NULL, 0, 3, NULL, NULL, '$2y$10$kt2ajXQeNLbK3om5QKXjdejM/D7X5tg0WMhbrbb1Rw6nm4oNTfGfy', NULL, '2021-11-03 00:39:59', '2021-11-03 00:39:59'),
(195, 'Md Rakibul Islam', 'sh3355333@gmail.com', '01875863538', NULL, 0, 3, NULL, NULL, '$2y$10$VyNNwwxwFmWS/oIVhNxsh.RPCtAakphKHhdy3p38CNXAH2sxeJcSy', NULL, '2021-11-03 01:30:43', '2021-11-03 01:30:43'),
(196, 'Nayem Islam', 'naimulislammn@outlook.com', '01796891122', NULL, 0, 3, NULL, NULL, '$2y$10$s43z2VgAo.MU4eWus9IdxOTuoEYcdZUjE4vU1as876qxp/fKcQTJ6', NULL, '2021-11-03 01:51:10', '2021-11-03 01:51:10'),
(197, 'Durjoy das', 'durjoyd1858@gmail.com', '01891476244', NULL, 0, 3, NULL, NULL, '$2y$10$Cesj5ET.xfaxT32OAJLbS.LSq90cwuJNXfEEbki9GHGTL7hSVdzBe', NULL, '2021-11-03 01:51:50', '2021-11-03 01:51:50'),
(198, 'MD Nur HoSEN', 'nurislam01408@gmail.com', '01408123334', NULL, 0, 3, NULL, NULL, '$2y$10$XoMCWJpYYB5wT9BShuMPWeYNyrKKN.3XOm5xz2HaVGneK0g5HbVam', NULL, '2021-11-03 02:05:54', '2021-11-03 02:05:54'),
(199, 'Shihab khan', 'airtelshihab67@gmail.com', '01744709829', NULL, 0, 3, NULL, NULL, '$2y$10$G.q3CXWJKBmijNM16NCyfOfYdcPBcLKvdx8ePMF7Gxn/vpmifJ5HS', NULL, '2021-11-03 02:16:11', '2021-11-03 02:16:11'),
(200, 'Hridoy khan', 'hridoykhan171329@gmail.com', '01997207365', NULL, 0, 3, NULL, NULL, '$2y$10$wOrBIXJK1dxBd46dUV1RCe2y8qY0VfMqEVMffr2eeZ.14EKqOHOtS', NULL, '2021-11-03 02:40:09', '2021-11-03 02:40:09'),
(201, 'Mohammad sabbir Rahman', 'mohammadsabbirrahman02@gmail.com', '01859774224', NULL, 0, 3, NULL, NULL, '$2y$10$y0/B.StbCC.AfKnQ/HhLaOVUDE/Cz4WoaEuGf3IFsLoc/undEb.Zq', NULL, '2021-11-03 02:55:37', '2021-11-03 02:55:37'),
(202, 'Shahriar', 'ducemcswag@gmail.com', '01818607674', NULL, 0, 3, NULL, NULL, '$2y$10$rmx4lYUspUrKm/vhgSmRE.Hl1OgomipPrCvMI8leqVxaNTCXdU7PK', NULL, '2021-11-03 04:01:54', '2021-11-03 04:01:54'),
(203, 'MD. TANVIR HASAN', 'modasserfokir@gmail.com', '01608257327', NULL, 0, 3, NULL, NULL, '$2y$10$KfvK3iPbhvW7r6JJrybvLuVxmj3fwuoSMnNoXV5bj2wqWMEBJzUDm', NULL, '2021-11-03 04:42:04', '2021-11-03 04:42:04'),
(204, 'রেজওয়ান আহমেদ', 'razoanerohan@gmail.com', '01303399089', NULL, 0, 3, NULL, NULL, '$2y$10$DAdMikiBo3GtvHZVnKXRlO8eDiXRnHj5P4a1DliY8VCWX2bRCdFKO', NULL, '2021-11-03 04:54:51', '2021-11-03 04:54:51'),
(205, 'Atikur Rahman', 'atik7op@gmail.com', '01758354336', NULL, 0, 3, NULL, NULL, '$2y$10$y.jbLjI05C..WJwB59tm8OUQL4LojBi4lyr5MwFjMpXcvPKrqHhC2', NULL, '2021-11-03 05:13:54', '2021-11-03 05:13:54'),
(206, 'Md. Tasin Rayhan', 'tasinrayhan585726@gmail.com', '01888585726', NULL, 0, 3, NULL, NULL, '$2y$10$w/XVGk1yoCl35hojxcNBcObXtwxdvm9yyY1p9m7eyP6/KYwOILH8.', NULL, '2021-11-03 05:28:56', '2021-11-03 05:28:56'),
(207, 'Anupom chakraborti', 'anupomchakroborthy589@gmail.com', '01704287036', NULL, 0, 3, NULL, NULL, '$2y$10$NZ9SfzDTHfjCmkn2bw8avOGBKHl5ZkpbRKC9PD/CzN8uf5.P8XFsy', NULL, '2021-11-03 05:30:39', '2021-11-03 05:30:39'),
(208, 'Alina Jubaida', 'alina.jubaida876@gmail.com', '01309660019', NULL, 0, 3, NULL, NULL, '$2y$10$dSin.c3qxrCwlJTe.nrCLe/naN6nYatJJEKcDrzWbUh9cz.crDUyO', NULL, '2021-11-03 05:46:58', '2021-11-03 05:46:58'),
(209, 'Masum', 'x10gerxb@gmail.com', '01928051882', NULL, 0, 3, NULL, NULL, '$2y$10$ybGKsvUDZQM4r0MABEOmJOC.2x44G5taMtm0BSTcx/eKC8Mf7FHey', NULL, '2021-11-03 05:56:55', '2021-11-03 05:56:55'),
(210, 'Omar faruk', 'omarfaruk189330@gmail.com', '01768237383', NULL, 0, 3, NULL, NULL, '$2y$10$U8exrVgAVsWEumNbqJELF.agCmi5fZIfbSMt8u33ETjRCRX2sqxka', NULL, '2021-11-03 06:14:18', '2021-11-03 06:14:18'),
(211, 'Durjoy', 'djanupjoy@gmail.com', '01878312757', NULL, 0, 3, NULL, NULL, '$2y$10$LWmgy9I/yVB4Jf/TSDxNoOgoJVEQK6XqkaWrwFIffeUgbMZ/.FweG', NULL, '2021-11-03 06:25:17', '2021-11-03 06:25:17'),
(212, 'Raaz Khan', 'raaz03get@gmail.com', '01753791475', NULL, 0, 3, NULL, NULL, '$2y$10$ltw6iD/FwICQ67CHoJyugevy6w6iN.EI1aD3o9RNUn03gn2zhLST2', NULL, '2021-11-03 06:45:58', '2021-11-03 06:45:58'),
(213, 'Rushdia Afrin Zahan', 'rushhridi2019@gmai.com', '01302173599', NULL, 0, 3, NULL, NULL, '$2y$10$I1uZaB9gr1DEazaag3aeWejlVWwSK1I0llG2.PokSHczR.2/dHdLm', NULL, '2021-11-03 06:51:13', '2021-11-03 06:51:13'),
(214, 'ENAMUL ISLAM', 'islamenamul600@gmail.com', '01790350128', NULL, 0, 3, NULL, NULL, '$2y$10$WXsNwtcj34aK5Wj0Ep2dOeUU8mLDg6ZVXaCQhmFcRu2GAemdBanmi', NULL, '2021-11-03 06:52:01', '2021-11-03 06:52:01'),
(215, 'MDShajib Hasan', 'abrarshojib@gimial.com', '01822124867', NULL, 0, 3, NULL, NULL, '$2y$10$0yDDez6E2kVPIkhcv8lIyed8xXTMVDIY3.OdcSGO5vSr1cXPYgwGi', NULL, '2021-11-03 07:00:25', '2021-11-03 07:00:25'),
(216, 'Anojith Roy Anik', 'anojithroy@gmail.com', '01843772750', NULL, 0, 3, NULL, NULL, '$2y$10$3ITBeayVCyqFXjxisSpwg.ULhLi4YfbUVHWC3UIUME71Cqlq8Zfge', NULL, '2021-11-03 07:14:50', '2021-11-03 07:14:50'),
(217, 'sourov podder', 'sourovpodder@gmail.com', '01846187098', NULL, 0, 3, NULL, NULL, '$2y$10$gj8BskLvoe0oj/GFNpWGne2ZslqcXVd0Uw5JMry3fuXNrIrOUtjXm', NULL, '2021-11-03 07:15:46', '2021-11-03 07:15:46'),
(218, 'NAJMUS SAKIB', 'forgetme2119@gmail.com', '01625022110', NULL, 0, 3, NULL, NULL, '$2y$10$p5VqtmPmS34xllP1hI5In.I1C4FD09dlRoAr4a6iW8v8hrue6JPEK', NULL, '2021-11-03 07:17:55', '2021-11-03 07:17:55'),
(219, 'Minhaz Rohan', 'minhazrohan03@gmail.com', '01301877953', NULL, 0, 3, NULL, NULL, '$2y$10$nOr9.i1MN0Y985xxSpitLeyBO3w8E/FFb1iBf9t3r0oKsGSibr5GK', NULL, '2021-11-03 07:28:54', '2021-11-03 07:28:54'),
(220, 'Mehedi hasan', 'mehedihasan01716270688@gmail.com', '01313890083', NULL, 0, 3, NULL, NULL, '$2y$10$p7jVnuYCWWkCphvIFXcPeePmf48g7ddK7jpw0j7IskO8bfQ.kGGB6', NULL, '2021-11-03 07:39:08', '2021-11-03 07:39:08'),
(221, 'Gazi Asib', 'gaziasib69@gmail.com', '01733788773', NULL, 0, 3, NULL, NULL, '$2y$10$ukAe5rntcrDUYIpbHmEN4.mB5J08wZtyx/CkiJzHok.QNXfegmh8W', NULL, '2021-11-03 07:47:11', '2021-11-03 07:47:11'),
(222, 'RanaAhmed', 'ranaalrazi3@gmail.com', '01715923500', NULL, 0, 3, NULL, NULL, '$2y$10$qhvrBJCuSUuNwIjGWFO/7ur0HegM/QwI3rDqbC9CQ6Or1vUA/.JFK', NULL, '2021-11-03 08:15:05', '2021-11-03 08:15:05'),
(223, 'rufaida jebin', 'rufaidajebin25@gmail.com', '01406302329', NULL, 0, 3, NULL, NULL, '$2y$10$OaK5Tjn.gj81FMIvzxFuG.JsIA3zqrJZmrdXPwbUNXi1aU6BY7FS6', NULL, '2021-11-03 08:29:29', '2021-11-03 08:29:29'),
(224, 'MD Ashraful Alarm Nayem', 'mdashrafulalamnayem@gmail.com', '01735516934', NULL, 0, 3, NULL, NULL, '$2y$10$ZIwZVbxA4hSSegozEAeLeuJBgX7jB341o0KIa.cchY6NRNlBfiwXm', 'JBzlJYf2ytsgT2vd4wQZcwWgyAKB1gb7g7ZIqqROt3kNNfkpkBtIndK5vfYH', '2021-11-03 08:37:08', '2021-11-03 08:37:08'),
(225, 'M H Mamun Sarkar', 'mahamudulmam@gmail.com', '01776216179', NULL, 0, 3, NULL, NULL, '$2y$10$Whbldyya92enFE1O7RmTjOmCvKwYM8Cy4.0JTy3ZmvgvW1CO4f3kO', NULL, '2021-11-03 08:52:00', '2021-11-03 08:52:00'),
(226, 'Firuj Asif', 'mahamudasif2002@gmail.com', '01815497392', NULL, 0, 3, NULL, NULL, '$2y$10$.9w8UqL.6aDP5gygzbPZmuNSF6MF64C9RxjA7yRCDeOrFVj2kj6pC', NULL, '2021-11-03 09:04:27', '2021-11-03 09:04:27'),
(227, 'Md Owakil', 'mdowakil1@gmail.com', '01902347276', NULL, 0, 3, NULL, NULL, '$2y$10$t0FAp4m71viL65vqqCVPi.WdakpwahPOu1qILEHR37k3m55ua55va', NULL, '2021-11-03 09:07:40', '2021-11-03 09:07:40'),
(228, 'K. M Anisul Islam', 'samidularefin@gmail.com', '01790415996', NULL, 0, 3, NULL, NULL, '$2y$10$i9xhikiHxxR6GA0rHQ1ikedaL0KcaWtY2phzTGnaOYe1zFxPZKcvq', NULL, '2021-11-03 09:24:44', '2021-11-03 09:24:44'),
(229, 'Md. Shabeeb Ameen', 'shabeebameen2019@gmail.com', '01902949079', NULL, 0, 3, NULL, NULL, '$2y$10$vJdi4oI6Mdr6ufjon65DTOL2iXn8y96M0824u0JjX4R1uRVBscldi', NULL, '2021-11-03 09:39:14', '2021-11-03 09:39:14'),
(230, 'Emdad', 'emdadarman09@gmail.com', '01521203609', NULL, 0, 3, NULL, NULL, '$2y$10$AEYrlqWKW7eUWhl/NiQ3.O2niMdepd2tpiRdf55jBy5.E0yshp6n6', NULL, '2021-11-03 10:21:43', '2021-11-03 10:21:43'),
(231, 'adnan test', 'adnansobhan1996@gmail.com', '01621527776', NULL, 0, 3, NULL, NULL, '$2y$10$sS3MUqq.lcoj3FfXh059Z.NwgIkNVtc5LjRuYPNKKxxoVcnwKCLYy', NULL, '2021-11-03 10:56:17', '2021-11-03 10:56:17'),
(232, 'Rifat hossain', 'rifat62659@gmail.com', '01626594941', NULL, 0, 3, NULL, NULL, '$2y$10$Qkq42CaHBNwQ56MjlJsjXONvgIEWzoKzNFFneg7U2JDQEld7a5cfG', NULL, '2021-11-03 11:11:17', '2021-11-03 11:11:17'),
(233, 'Rony sen', 'senr57038@gmail.com', '01314333819', NULL, 0, 3, NULL, NULL, '$2y$10$k3GjfFcwBBjU.JGS1gVRjehUrc0C2m2XgDjYIJSOIeYhEufU00V0C', NULL, '2021-11-03 11:13:03', '2021-11-03 11:13:03'),
(234, 'Gourob Saha', 'gourobsaha738@gmail.com', '01629974738', NULL, 0, 3, NULL, NULL, '$2y$10$sh9qp5jROFVjrhKrXIxvGO1c35PlxrXv3BKIhog.fovfbK3s.pfr.', NULL, '2021-11-03 11:26:07', '2021-11-03 11:26:07'),
(235, 'Jisan', 'furiousknight321@gmail.com', '01401342017', NULL, 0, 3, NULL, NULL, '$2y$10$6XqpJuEYoKKkR.hyR.uYb.ZAJdBxRfKF.o0.pDVsyJpGFdlVUV3va', NULL, '2021-11-03 11:29:31', '2021-11-03 11:29:31'),
(236, 'MD S SOHAG', 'm2552ds@gmail.com', '01642759204', NULL, 0, 3, NULL, NULL, '$2y$10$J9iPUJaSOkV7xx2Fg0RhmOZvyB5khDMW4ZHTaG.hccoaOuQcu1OkK', NULL, '2021-11-03 12:07:21', '2021-11-03 12:07:21'),
(237, 'Ramim Sarkar', 'ramimsarkar41@gmail.com', '01319146740', NULL, 0, 3, NULL, NULL, '$2y$10$tBFLuo8/3ALcAqSaLmJ54exVDHMC3JeAOe5EGPydwO8.Myq96AoNu', 'Kv67ZblZqToV799YPQSn5P9pRlwdkM7U1EZQ869vdkJKBuqbmvzJwDwmy2F6', '2021-11-03 12:17:31', '2021-11-03 12:17:31'),
(238, 'Md Humayun Kabir', 'humayun5232@gmail.com', '01719262579', NULL, 0, 3, NULL, NULL, '$2y$10$VueYTAz5gQnXNq/23QcTZ.9LktQB.Dm47YJ.ZBudjy6C/9CjiIsaa', NULL, '2021-11-03 12:36:44', '2021-11-03 12:36:44'),
(239, 'Saykot', 'efratsaykot@gmail.com', '01750560384', NULL, 0, 3, NULL, NULL, '$2y$10$hJlcmYke9VXY6/4DsPrFiebpH7TukgcxgPI1wEzL70UZFFwvq/2bq', NULL, '2021-11-03 12:43:02', '2021-11-03 12:43:02'),
(240, 'Nur Muhammad', 'nurm7742@gmail.com', '01738245884', NULL, 0, 3, NULL, NULL, '$2y$10$gQXoypZeXSRvCtbDByzj.OS2ulLYBcidzUBPe/gEt5QsydLx1.J3i', NULL, '2021-11-03 12:50:34', '2021-11-03 12:50:34'),
(241, 'Nazmulhosaain', 'shihabhasan140203@gmail.com', '01302975363', NULL, 0, 3, NULL, NULL, '$2y$10$iFJAr24dX6Mtdd1gcsRIVuoS5YeNIHmBrwXJDinBC1PzDpBQF3ipu', NULL, '2021-11-03 13:22:43', '2021-11-03 13:22:43'),
(242, 'Md. Shakibul Islam Bhuiyan Sifat', 'sifatshakibulislam@gmail.com', '01907741717', NULL, 0, 3, NULL, NULL, '$2y$10$nzGi/CcFzeRynDMJdG0OYuG0E.z8uSa7HoVp2NxAFdRbeyYoFFeXa', NULL, '2021-11-03 13:46:34', '2021-11-03 13:46:34'),
(243, 'Apurbo Sharma', 'apu68898@gmail.com', '01770823306', NULL, 0, 3, NULL, NULL, '$2y$10$h95I7xXt1u7EWh7TVdZFX.hBLgo4yCKozfUrgH5yehvoVSa5EwL1C', NULL, '2021-11-03 13:54:02', '2021-11-03 13:54:02'),
(244, 'MD Musrur Bin Fardues', 'musrur.alif@gmail.com', '01714501406', NULL, 0, 3, NULL, NULL, '$2y$10$naJmybHzeqWCn.8jWO7E9eQeN5OL0T4SmhAbSxwR0SE8OMLC2g4yy', NULL, '2021-11-03 13:57:51', '2021-11-03 13:57:51'),
(245, 'Shipon chandro', 'shiponchondro3@gmail.com', '01796830304', NULL, 0, 3, NULL, NULL, '$2y$10$EQJ.ZXT7M0a67TtzpSbOPe9xtdX4U9zQAFXOjd/WBm5A.On9jPQdK', '2LK6IXUiEUJCLreTX0HZ1wCGzWkyV5SHw2MdA0HXW4SQBCV9D5TKMVRGLaRf', '2021-11-03 14:20:51', '2021-11-03 14:20:51'),
(246, 'Sifat Hasan', 'sifathasan55555@gmail.com', '01864414755', NULL, 0, 3, NULL, NULL, '$2y$10$COfxKFq.80EhqIU7ZX/C4.qy5ecDkaw98vKc4nEy9Vxp8.561R9Ga', NULL, '2021-11-03 14:27:45', '2021-11-03 14:27:45'),
(247, 'CHOWDHURY SAYEB ISLAM', 'chowdhurysayebislam@gmail.com', '01819430157', NULL, 0, 3, NULL, NULL, '$2y$10$gvsbzqXyYRLNbu2pG0W7b.sF1zuEyGBIsjqWHPjsIPjP.81/7JgYe', NULL, '2021-11-03 14:47:28', '2021-11-03 14:47:28'),
(248, 'MD Mizanur Rahman', 'mr.mizan1132@gmail.com', '01518641046', NULL, 0, 3, NULL, NULL, '$2y$10$9UQOgkis3Z/DBEcjOKZXue3difs3xMqZd7.i/iGVOLPouUOSpljGy', NULL, '2021-11-03 15:00:07', '2021-11-03 15:00:07'),
(249, 'Arif Hossain', 'arifhossain19810@gmail.com', '01892484115', NULL, 0, 3, NULL, NULL, '$2y$10$gUK4INKCDPKeQZRJYXp7Jezj0SJfOj6gjUWaqb9PbAVc310GfNN7y', NULL, '2021-11-03 15:02:35', '2021-11-03 15:02:35'),
(250, 'Sojib', 'smsojibss18799@gmail.com', '01773369452', NULL, 0, 3, NULL, NULL, '$2y$10$xCjNS68StUm/l/7jNbSeyue68kB2QOT.sSSXkUzzPl4xAcC5PkfRq', NULL, '2021-11-03 15:04:42', '2021-11-03 15:04:42');
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `is_admin`, `user_type`, `provider_id`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(251, 'Mustakim', 'hasnatrakib0@gmail.com', '01888604488', NULL, 0, 3, NULL, NULL, '$2y$10$RrAQjnGy3F7BA85xP2wsrObP3WO4hIXLc9J.V7M3z3zyq4Sh8V5Na', NULL, '2021-11-03 15:14:42', '2021-11-03 15:14:42'),
(252, 'Raihan Mohammad', 'dgladem420@gmail.com', '01883886747', NULL, 0, 3, NULL, NULL, '$2y$10$Y.G3OLX4LQYzpVmDfl9X/Oaoz34IyAHfKgkw2Qhrox1ShqkYQgXPy', NULL, '2021-11-03 15:17:17', '2021-11-03 15:17:17'),
(253, 'Islam Sazzatul', 'sazzatulislam26@gmail.com', '01874500952', NULL, 0, 3, NULL, NULL, '$2y$10$0oHA4RBYWG92QfVreDUiJeeLu7VLogycv1e.yj4DckFg/7Zm3NyWG', NULL, '2021-11-03 15:22:58', '2021-11-03 15:22:58'),
(254, 'Naim Naimur Rahman', 'www.naime882001@gmail.com', '01758819020', NULL, 0, 3, NULL, NULL, '$2y$10$g8wUKGrrQ8sh8zuoM0o3.OUMXL/PzhYN3VeHtjmPfwpyods0wPHFW', NULL, '2021-11-03 15:24:34', '2021-11-03 15:24:34'),
(255, 'Md.Shakif Khan Saikat', 'sakif.khan.0182@gmail.com', '01814119495', NULL, 0, 3, NULL, NULL, '$2y$10$SzW4X1srkL8AxlQzeLeA8.JSVrYKJDRrmcIJhd2/SmBIYy7d3lPcu', NULL, '2021-11-03 15:37:49', '2021-11-03 15:37:49'),
(256, 'Robiul', 'robiulhasan667589@gmail.com', '01828145709', NULL, 0, 3, NULL, NULL, '$2y$10$8aHe4SCcom4pryaDyFEQyePhJWr2eZKuB2gXe6iaWST/2pHNcDt7y', NULL, '2021-11-03 15:40:06', '2021-11-03 15:40:06'),
(257, 'Mohammad Fahim', 'fahimm9187@gmail.com', '01878559187', NULL, 0, 3, NULL, NULL, '$2y$10$BPLVi6DLOTKOxJ.M5NF/cORXT/xciKxRvOgX9ugJ1t/nrMkiVJVHe', NULL, '2021-11-03 15:58:27', '2021-11-03 15:58:27'),
(258, 'suleman Ahmed', 'sulemanahmedsuhag65@gmail.com', '01715341765', NULL, 0, 3, NULL, NULL, '$2y$10$/pQxinGLRJyl9K98hDvpO.CaEEvHS1Oz2NIF/zvqWfNyeZFXzuXmO', NULL, '2021-11-03 16:05:06', '2021-11-03 16:05:06'),
(259, 'Hasan Moon', 'rakibulhasano4.moon@gmail.com', '01640693226', NULL, 0, 3, NULL, NULL, '$2y$10$4/a8BdwavSKMU9bkjPkGyO8NvOY4r1SM1jmeV3u2e99igkWgRhewG', NULL, '2021-11-03 16:07:47', '2021-11-03 16:07:47'),
(260, 'Islam MD Shoriful', 'mdshorifulislamsajib7292@gmail.com', '01892444914', NULL, 0, 3, NULL, NULL, '$2y$10$rPIoIhZWvYYl0JzvX3VE0eQiy4lChwk.Zt8LavfyCR.ImjvDWJyIW', NULL, '2021-11-03 16:18:29', '2021-11-03 16:18:29'),
(261, 'Kamal Uddin', 'Kamaluddin07301@gmail.com', '01567894316', NULL, 0, 3, NULL, NULL, '$2y$10$uWfICHwZfjkVm/8wTKqhye1D6fvDswKyNZgYBzYMNXrmNBV9kX/7O', NULL, '2021-11-03 16:26:00', '2021-11-03 16:26:00'),
(262, 'Mohiudden Rafi', 'mridhamohiudden@gmail.com', '01863383186', NULL, 0, 3, NULL, NULL, '$2y$10$QI.TSDXitA.WE603Rx4fseFwuJmo1XdJxVfgUfzlbW0b.lHS6Pele', NULL, '2021-11-03 16:42:26', '2021-11-03 16:42:26'),
(263, 'JAYED AHMED', 'jayed9153@gmail.com', '01758842325', NULL, 0, 3, NULL, NULL, '$2y$10$KPjbLK5uuk9qmBT5xocRHOzUtWi2.LMlW5iv7GDmt0pxSAWOdb9Li', NULL, '2021-11-03 17:27:06', '2021-11-03 17:27:06'),
(264, 'MD shuab ahmed', 'mdshuabahmedshimul@gemil.com', '01988948199', NULL, 0, 3, NULL, NULL, '$2y$10$uWgV6a/SRacEmF7fbFE9Y.O0ndHsW4p6TqdNSarT2z1iEEIINlSwK', NULL, '2021-11-03 17:46:38', '2021-11-03 17:46:38'),
(265, 'Md Rakibul Hasan', 'mdrakibulhasan515@gmail.com', '01756524475', NULL, 0, 3, NULL, NULL, '$2y$10$QqgYk.QKDKAd4oM/70jS5Owa7cA4B1wlL/xqAVTtSBacHSSa03xv2', 'AuBB2IewBt0ouNXllQ4Is2XuIK8w5nSbKujd5wRrz5sGqfe3ok1plt9Pzs7q', '2021-11-03 17:50:56', '2021-11-03 17:50:56'),
(266, 'Mehedi', 'hmahadi120@gmail.com', '01405315968', NULL, 0, 3, NULL, NULL, '$2y$10$cVUA85JLEB4mGCfNsM0IU.iH1/p.1Oly8.m0dQHOU9DT6hmLER.4.', NULL, '2021-11-03 17:53:00', '2021-11-03 17:53:00'),
(267, 'Sojol bug', 'sojolbug@gmail.com', '01304570759', NULL, 0, 3, NULL, NULL, '$2y$10$XyHfgEtrP0p5upzT3Yhv/.86n.0ygUlmSpEytmQ4hdyoLHF43iRu2', NULL, '2021-11-03 18:08:43', '2021-11-03 18:08:43'),
(268, 'Md Shamiul Islam mission', 'mdshamiulislammission124@gmail.com', '01609604866', NULL, 0, 3, NULL, NULL, '$2y$10$zQ4zLHTFmC1dhd52BwsW7uBHIcg6Oyb.JCsjVFSIq.RDRh1kYYSFW', 't0Z4IiNsErHJrKMwoht2G59RWPywKSll8uQrv3kWrL6QWaHOTAzrz50QtQoq', '2021-11-03 18:21:57', '2021-11-03 18:21:57'),
(269, 'আসিফ আবদুল মজিদ', 'abdulmajidasif0@gmail.com', '01686588915', NULL, 0, 3, NULL, NULL, '$2y$10$/4omp7Kuui3MIU/yUUrvLuHvsBdHpfWlR9JMaNgNUqWoek/Um5P4W', NULL, '2021-11-03 18:27:23', '2021-11-03 18:27:23'),
(270, 'Zidanur Rahman Khan', 'zidman107@gmail.com', '01305928868', NULL, 0, 3, NULL, NULL, '$2y$10$KnSIoxsWC1URt0OtFVtWKOsPtKbQoE3C8DZNeAl41M.W9ZFVsCaVS', NULL, '2021-11-03 18:34:40', '2021-11-03 18:34:40'),
(271, 'Ramisha Islam Rodela', 'rodelaramisha@gmail.com', '01676733943', NULL, 0, 3, NULL, NULL, '$2y$10$JoiqzSIL9lDsxMqt6yd4MeapWW7WaMBgJKc7hDm575RW1uMUWhjJ6', NULL, '2021-11-03 19:37:17', '2021-11-03 19:37:17'),
(272, 'Souman', 'soumanbarua4@gmail.com', '01870825701', NULL, 0, 3, NULL, NULL, '$2y$10$y2rTNaKaGPhRMoAjpvxWMelU7SN9Rsoi4oKz7bsJgszlbcJWW47Fa', NULL, '2021-11-03 19:46:11', '2021-11-03 19:46:11'),
(273, 'Siddiq Saimun', 'saimunsiddiq@gmail.com', '01791672683', NULL, 0, 3, NULL, NULL, '$2y$10$GWVoO5F5/pu1teRC4GXaFuIEUMdHjuWW.BnK3yxdqoPqSJINFUmHW', '9aC4RBZIqspMnlAJTHyivNJh5NziqmTCSZ7YOX1C6EI9qiR5KrNpK2YZW5iv', '2021-11-03 20:14:04', '2021-11-03 20:14:04'),
(274, 'anas', 'anasislambd@gmail.com', '01772961354', NULL, 0, 3, NULL, NULL, '$2y$10$eIjLrRSVvLOuTyVTa6u7eeBTuM7KQZNoc6hvk39DrAEtzbbHgqQSO', '9rjhftuwUxuCqUb4gS03Jw88vLY7Cpqbk07XlXfT0PrO608bpO3Ym3WVngtd', '2021-11-03 20:18:31', '2021-11-03 20:18:31'),
(275, 'Md Tanjim Arafat', 'tanjimrakib360@gmail.com', '01759091704', NULL, 0, 3, NULL, NULL, '$2y$10$UKPD3uUnuPQZcgmGf1yogubltvHZRmgeludc9pjzmKSQMcikpTSJi', NULL, '2021-11-03 20:38:22', '2021-11-03 20:38:22'),
(276, 'Nazmus Sakib Akash', 'nazmusakash@gmail.com', '01739337965', NULL, 0, 3, NULL, NULL, '$2y$10$qYlGTbo5.O10lMFjIPxlPuv3fvSHPEA6SJUmHbQX2o2CxbE0Wv6g.', NULL, '2021-11-03 22:48:03', '2021-11-03 22:48:03'),
(277, 'Mohammed Ashfak Chowdhury', 'mohammedashfakchowdhury@gmail.com', '01810437414', NULL, 0, 3, NULL, NULL, '$2y$10$tSMuCNswiOf.lkN869vQ2.bfI6QhPzOo16QuWgnnb.AYqvvrVOg9q', NULL, '2021-11-04 02:41:35', '2021-11-04 02:41:35'),
(278, 'Abir Hossain apu', 'abirhossainapu18@gmail.com', '01609700922', NULL, 0, 3, NULL, NULL, '$2y$10$.jc/y1Dql8er9sxPN/udpenMrTJF9rfbmiyLoinBl0CHevrVrRam.', NULL, '2021-11-04 02:42:57', '2021-11-04 02:42:57'),
(279, 'Mohammad sayem', 'sayemmohammad729@gmail.com', '01919629539', NULL, 0, 3, NULL, NULL, '$2y$10$HA.WlrMywm2vfk2.kKNPtuGqoUjX/7uejw1bKaQpeSvPAOdpChde6', NULL, '2021-11-04 02:46:06', '2021-11-04 02:46:06'),
(280, 'Sabit MD.Samin Yeasir', 'sysabit7@gmail.com', '01306627569', NULL, 0, 3, NULL, NULL, '$2y$10$1SmjsXZ8DnaaKDcfXc90Qe6fWt6JvhGgntMgmdRAvtH2VqdZKki9e', NULL, '2021-11-04 02:52:10', '2021-11-04 02:52:10'),
(281, 'zamshed Alam', 'zamshedul1234@gmail.com', '01875735899', NULL, 0, 3, NULL, NULL, '$2y$10$PrsTWp.Q9a.gmHLajGFnbOqvedJuzYMetu8Il.GZGgl.SzLNX5KFe', NULL, '2021-11-04 03:27:14', '2021-11-04 03:27:14'),
(282, 'Mohammad Naser Uddin', 'kodalactg321@gmail.com', '01690043143', NULL, 0, 3, NULL, NULL, '$2y$10$81tOucCSIt1Gg2O/PkFuYOlMpD8.P8vYHx2scOcvRR7Am4pRwVDWe', NULL, '2021-11-04 03:32:07', '2021-11-04 03:32:07'),
(283, 'Md Sabbir sarker', 'sarkersabbir920@gmail.com', '01538390431', NULL, 0, 3, NULL, NULL, '$2y$10$bNQm2JlRw6xt7nTnKhswmuWLP8dZMlRw3czhj3bXtoHCZ6Zrdka7y', NULL, '2021-11-04 03:57:28', '2021-11-04 03:57:28'),
(284, 'Joy Das', 'jdas27513@gmail.com', '01751176544', NULL, 0, 3, NULL, NULL, '$2y$10$oixoROe4Smtsl0xj50NBnuTR9IfuHrKQe4PD26psfxSi86ut281Uy', NULL, '2021-11-04 04:06:46', '2021-11-04 04:06:46'),
(285, 'MD Rashedul Islam', 'irashedul@gmail.com', '01904820751', NULL, 0, 3, NULL, NULL, '$2y$10$ujJQatjmXvIhKthNeMXQVucCfwYuUC3IYbGrIGmiH0IU8AxBn/Gb2', 'OEgWtCt7SIumIRksdgE65DhT9DispuH56kzGjLZYjcFp5YskSezOhdpjVhm4', '2021-11-04 04:09:27', '2021-11-04 04:09:27'),
(286, 'Belayet Hasan Bishal', 'bishalhasan@gmail.com', '01928955625', NULL, 0, 3, NULL, NULL, '$2y$10$1d9Ja3Lq/MFRvu/4389YAupvkCpuA63x0JsVYlscy.DebWwEazVgu', NULL, '2021-11-04 04:32:25', '2021-11-04 04:32:25'),
(287, 'Minhaz', 'mnhzmaruf822@gamil.com', '01822865960', NULL, 0, 3, NULL, NULL, '$2y$10$7F6fM7C7lUh6zZbN9YprtO3.neyuLqFOJW.5KSm2pJjk8YTBBBg1C', NULL, '2021-11-04 04:44:44', '2021-11-04 04:44:44'),
(288, 'MD kamrul Hasan', 'kamrhasan86676@gmail.com', '01407986676', NULL, 0, 3, NULL, NULL, '$2y$10$6n1/g2Db0n2SFaCIxne6UerZF.H9XAMf41T015QznHUOOuizy/ztC', NULL, '2021-11-04 04:52:11', '2021-11-04 04:52:11'),
(289, 'Himel Sujan', 'himalsujan2222@gmail.com', '01958217609', NULL, 0, 3, NULL, NULL, '$2y$10$v8gC3YqM9IIn55hAOqolKORwOqv..ELRZtKO1uT5li6RvE7FfL0ey', NULL, '2021-11-04 04:55:11', '2021-11-04 04:55:11'),
(290, 'Minhaz Muntasir Mahin', 'minhazmahin761@gmail.com', '01789340084', NULL, 0, 3, NULL, NULL, '$2y$10$uPtRb8G8svPcyodXh5ECueqWMtET055oZMbKYgWrK24/.ZEd0.8Xe', NULL, '2021-11-04 05:20:40', '2021-11-04 05:20:40'),
(291, 'Abdullah Al Faysal', 'faysalabdullahal2@gmail.com', '01779413897', NULL, 0, 3, NULL, NULL, '$2y$10$i10m1N5FZLQfqhDaM8iHru0uSqCeOGgHYvqZ25rCxIFdykx1CT3E2', 'wpAItJGQ3HJPgfQRSbRB2XVgqfVgRa1DVaOHH3QiV5mSSQ3cxtRyj9v7YpMN', '2021-11-04 06:18:37', '2021-11-04 06:18:37'),
(292, 'MD SHANTO ISLAM', 'shantohosin24@gmail.com', '01648229371', NULL, 0, 3, NULL, NULL, '$2y$10$3CKiNHem5K8HAKIDD0wTfOyyqf359sNHCBEsu328d2VwFqihZu2eW', NULL, '2021-11-04 07:03:44', '2021-11-04 07:03:44'),
(293, 'Rifat', 'hossenrifat298@gamil.com', '01647596296', NULL, 0, 3, NULL, NULL, '$2y$10$T0CO.ItRi8U790Ug1UqLjOqiLTEBjiBCysJaJ8aDYc7hfmPHPL3vy', NULL, '2021-11-04 07:17:28', '2021-11-04 07:17:28'),
(294, 'Niaj Mahdi', 'kornelniaj@gmail.com', '01759532061', NULL, 0, 3, NULL, NULL, '$2y$10$koVMG6/DrilKSIVfO7xMH.5V.JyNBFmIysn/RRtJA5p6aSa1YV4Di', NULL, '2021-11-04 07:23:05', '2021-11-04 07:23:05'),
(295, 'Sakib', 'florasmith9641@gmail.com', '01959599641', NULL, 0, 3, NULL, NULL, '$2y$10$2V/egKeZzZw/LgOVATEngeu5TxURzpj4rn3YecKK1rbcPf4qU1Ogq', NULL, '2021-11-04 07:29:08', '2021-11-04 07:29:08'),
(296, 'MD ALIF MAHMUD', 'alifmahmud2270@gmail.com', '01843152270', NULL, 0, 3, NULL, NULL, '$2y$10$LE/wXT.Zi10I0NRauU09NOfUkgGaC0BSTNzWxmFiaAI5AYJhA7ZR2', NULL, '2021-11-04 07:30:16', '2021-11-04 07:30:16'),
(297, 'MD Tasin Parvez', 'tahsin6088@gmail.com', '01941431911', NULL, 0, 3, NULL, NULL, '$2y$10$aQN60.SKliuIINMfPBQi2uHd5u.rTIjVoS4woIiv4E2YmSN99tH02', NULL, '2021-11-04 07:47:02', '2021-11-04 07:47:02'),
(298, 'Sadman Ashik', 'sadmanashiq68@gmail.com', '01645245704', NULL, 0, 3, NULL, NULL, '$2y$10$AsIRhRhisAyG90LrUFi7.OPMDY9nDZ76RwzdKKeR0RTK28r6jTahm', NULL, '2021-11-04 07:55:41', '2021-11-04 07:55:41'),
(299, 'Nayeemul Islam', 'inayeemul909@gmail.com', '01760335921', NULL, 0, 3, NULL, NULL, '$2y$10$HKiWK2DIwxHveLtZQYjntOWq/sJBpaay6/RffVTSgFa8I.eEFsG7S', NULL, '2021-11-04 07:57:28', '2021-11-04 07:57:28'),
(300, 'A.h nur', 'mdr745933@gmail.com', '01706027955', NULL, 0, 3, NULL, NULL, '$2y$10$1JK.Oktff.JpNkvPGgkO7e4Ok8kAoQIpL2Rusi/CyYdyQPNyiUiqe', NULL, '2021-11-04 08:04:57', '2021-11-04 08:04:57'),
(301, 'Reyad Ahmed', 'sababrafsan@gmail.com', '01852610055', NULL, 0, 3, NULL, NULL, '$2y$10$In0yMfssViIkkDYxekwYJOdTJSOTRszIxMkbtK/qyW5Cek8TI0sle', NULL, '2021-11-04 08:17:22', '2021-11-04 08:17:22'),
(302, 'Md. Mamun Hasan', 'hasanmdmamun282@gmail.com', '01842725205', NULL, 0, 3, NULL, NULL, '$2y$10$TA2bvbyZVsnw5yawhRGVu.k/LuUNg7DN8UlXGkFn.497JLVD66jGC', NULL, '2021-11-04 08:22:22', '2021-11-04 08:22:22'),
(303, 'Sakin Akhon', 'fardinahmedsakin@gmail.com', '01688200556', NULL, 0, 3, NULL, NULL, '$2y$10$LT7qKItZmrLyq80csRhF/uZ9KGDY8SKbL8PiZlAxyb.4ZkpTJ1LHq', NULL, '2021-11-04 08:25:54', '2021-11-04 08:25:54'),
(304, 'Syed Hasanuzzaman Apu', 'tabuhassantapu@gmail.com', '01401879740', NULL, 0, 3, NULL, NULL, '$2y$10$UipUEPUWxpeYPgvNXFIWJux3KKey3XcWm/CcnbVxGI.kU7pkwXcT2', NULL, '2021-11-04 08:53:12', '2021-11-04 08:53:12'),
(305, 'Md. Redwan Hossen', 'redwanhossen1952@gmail.com', '01319867596', NULL, 0, 3, NULL, NULL, '$2y$10$wxjuOsxdbWjWPlaW06ye1.sYi3d3Q7fg/I3QBGrV5OM9KMX9QZyNW', NULL, '2021-11-04 08:57:30', '2021-11-04 08:57:30'),
(306, 'Ashik Roy', 'ashikroy363@gmail.com', '01816992991', NULL, 0, 3, NULL, NULL, '$2y$10$cmr.pyTAR4LoYwC0zfx8Lu0ghVMEapdd0DhITHQHxoyhop8CiY6aK', NULL, '2021-11-04 09:07:22', '2021-11-04 09:07:22'),
(307, 'MD Jesan', 'jesanhossen984@gmail.com', '01878427917', NULL, 0, 3, NULL, NULL, '$2y$10$/IIH.ireBzaPaKrKe0IXJ.jpF5ELruFvWdvLd05Xzvo9SvUfN4.aC', NULL, '2021-11-04 09:24:39', '2021-11-04 09:24:39'),
(308, 'safwan', 'mdnaiyamhoosin@gmail.com', '01306575759', NULL, 0, 3, NULL, NULL, '$2y$10$BvAuKb6Sde5bzUjeLr5OreIUX.ZK.hzPij5kuWEH97GXyw7ZZQw0u', NULL, '2021-11-04 09:25:56', '2021-11-04 09:25:56'),
(309, 'মোঃ আরমান উদ্দিন', 'mda277494@gmail.com', '01567820667', NULL, 0, 3, NULL, NULL, '$2y$10$JXB.unz7yKBdEhmHVUEppOSKhRrDsYvdLddl0l6vIhGUzcMvn2e66', NULL, '2021-11-04 09:41:03', '2021-11-04 09:41:03'),
(310, 'Mohammad Maruf Dhali', 'maruf.dhali92@gmail.com', '01814352621', NULL, 0, 3, NULL, NULL, '$2y$10$zCLOBLAjs/mGzAg4Ok17ceGIzDb34hoRl/Z5NBAwbqGWEsTCSrlve', NULL, '2021-11-04 09:50:59', '2021-11-04 09:50:59'),
(311, 'Ahmed Sohel', 'ahmedsohel9991@gmail.com', '01916011294', NULL, 0, 3, NULL, NULL, '$2y$10$0lnx80ZZIWlGZBOygb6J6eXNGfWbFCLr6wrwsSqAIAGKROEtbASDW', 'JFQXuS4AwQlwO14SEKCcb46c9VIgLXt5d1SxYt9WWLP6FlyeaVWgK0R63xNP', '2021-11-04 09:53:29', '2021-11-04 09:53:29'),
(312, 'Proshanto Chandra Das', 'proshantodas354@gmail.com', '01323812586', NULL, 0, 3, NULL, NULL, '$2y$10$b/GR8fvIvW.z3X0LcZMiMOoWdAiI6ZBZwnK7cwFOnYtP/gVGeVP/O', NULL, '2021-11-04 10:02:20', '2021-11-04 10:02:20'),
(313, 'Habib', 'sk.ismail.hsn@gmail.com', '01863189168', NULL, 0, 3, NULL, NULL, '$2y$10$NnmLGrkSOQ.47iigte9upeAfZUW2dekr3Ix56eYsXB2X8/HJHs8Oe', 'gqH7rCFRpnPllTUdtph1lDXPsoT9Pagaj4fhqkNWTEqsv5qEUfqsGdJt3lzT', '2021-11-04 10:47:27', '2021-11-04 10:47:27'),
(314, 'anamul', 'tmanamul6@gmail.com', '01724749048', NULL, 0, 3, NULL, NULL, '$2y$10$GLQT2tsnhqz9n2CdSv9ADeyt4F6EP5bmDCF8BqahcCnv5AOj3lM22', NULL, '2021-11-04 10:48:36', '2021-11-04 10:48:36'),
(315, 'Topu Hossen', 'topuhossen10444@gmail.com', '01749197791', NULL, 0, 3, NULL, NULL, '$2y$10$9u2uO7mZeM/glkP5y.LDGOfaSiwQ8oLk56a7yfzZ5VZmqbSg8Fc6m', NULL, '2021-11-04 10:49:53', '2021-11-04 10:49:53'),
(316, 'Shakib', 'shakiburahman09@gmail.com', '01956109909', NULL, 0, 3, NULL, NULL, '$2y$10$lf86HWKn8Ug9BQTpsn8Dc.jg1KSPvv/rZ78g3y4XR7YHBO7/Anuku', NULL, '2021-11-04 11:12:16', '2021-11-04 11:12:16'),
(317, 'Abu siddik al mubin', 'heromubin2020@gmail.com', '01632242841', NULL, 0, 3, NULL, NULL, '$2y$10$5TZMTtqQHWSGDe.fX9PLNOn.1na1wunDS5zqU5Gb8GAvfCS5NOwIK', NULL, '2021-11-04 11:20:05', '2021-11-04 11:20:05'),
(318, 'Minhaj AL Islam', 'minhajalislam1@gmail.com', '01775859677', NULL, 0, 3, NULL, NULL, '$2y$10$j1agSl3v/8anJNJ8K4/DruPC.R4vhV6HlsM/wTRjGhFUwh.J3J5lS', NULL, '2021-11-04 11:20:51', '2021-11-04 11:20:51'),
(319, 'Jishan biswas', 'j4763507@gmail.com', '01725094994', NULL, 0, 3, NULL, NULL, '$2y$10$JmZUFbDifsR2q6X2xxZpwuHUh4Dfq4/Tvxy3w2u7e3QNC65RrC3c.', 'M63xUEEwsNjjgtaxgSaWDKLEO3RpdFT9uxasp8n1F1k0cj0hEjyFEqdXybnT', '2021-11-04 11:23:17', '2021-11-04 11:23:17'),
(320, 'Masrafi', 'mashrafihossain888@gmail.com', '01937140583', NULL, 0, 3, NULL, NULL, '$2y$10$BfujqZD.R49t2HpQSdx2HO.gcHMTte5UvVL.JbbgZIQJAnCku2VwW', NULL, '2021-11-04 11:28:36', '2021-11-04 11:28:36'),
(321, 'Nayeem', 'www.pureboy32@gmail.com', '01646003071', NULL, 0, 3, NULL, NULL, '$2y$10$ACwocF7jXFaibjjZOc/C1.tGAih/wdomytquLVgyveXbWs5Pslwe6', NULL, '2021-11-04 11:30:28', '2021-11-04 11:30:28'),
(322, 'Biplob', 'mdbiplobhosen055@gmail.com', '01931722531', NULL, 0, 3, NULL, NULL, '$2y$10$8Kimc65Mi5gGrKafgRYVd.bVJNXIAEJPxvjgEaJjGWxiMyJOjzKK2', NULL, '2021-11-04 11:33:02', '2021-11-04 11:33:02'),
(323, 'Shuvo', 'md.shuvoahmed4545@gmail.com', '01884476735', NULL, 0, 3, NULL, NULL, '$2y$10$awThCmSBvkHEvF9HgDb.AuHBkIPCgoQHacZEnYEpkZubdr4TzMxuO', NULL, '2021-11-04 11:41:41', '2021-11-04 11:41:41'),
(324, 'Sahadul Islam', 'si179024@gmail.com', '01316754574', NULL, 0, 3, NULL, NULL, '$2y$10$DrEqeB.Q4dIDPcEuOzMOT.dCf4fOz0uSpM5XOnUFJdA.4euBwyKQu', NULL, '2021-11-04 11:44:20', '2021-11-04 11:44:20'),
(325, 'HARIQUE RAHMAN JAIF', 'harique02jaif@gmail.com', '01580117250', NULL, 0, 3, NULL, NULL, '$2y$10$r6YZWoe5vv3DbYRIFnGAAOo4PXmxqW88yN9pojAkXG7V.QuhTK9Zi', NULL, '2021-11-04 11:59:44', '2021-11-04 11:59:44'),
(326, 'Rezowan Ahmed Tonmoy', 'vulture25009@gmail.com', '01537704295', NULL, 0, 3, NULL, NULL, '$2y$10$PVDVD13YO8B5U96.EEM6VeeXbCxo/.EMuoM3pofT2iNIihhOy48f.', NULL, '2021-11-04 12:29:12', '2021-11-04 12:29:12'),
(327, 'Arif Sarkar', 'sarkar.arif1995@gmail.com', '01317916869', NULL, 0, 3, NULL, NULL, '$2y$10$uazp/sCbIAjju5B5eaDB7OPQq/ioShTrATwqk.r/1OZIqLhujvTvq', NULL, '2021-11-04 12:55:21', '2021-11-04 12:55:21'),
(328, 'Radif Ahnaf', 'duforbetter@gmail.com', '01864927398', NULL, 0, 3, NULL, NULL, '$2y$10$LiKBosA.f3lPd3Xm7sOwpO3ea/F9S3Y4guA/v5WRP1UAje5lgeuSu', NULL, '2021-11-04 12:57:46', '2021-11-04 12:57:46'),
(329, 'Rownak Niloy', 'rownakniloy69@gmail.com', '01558622125', NULL, 0, 3, NULL, NULL, '$2y$10$F45a.rLmgOdjKjAafOkJCOJXZsu1OJKy4TpZcQJfGavUs5HCXopV6', NULL, '2021-11-04 13:14:21', '2021-11-04 13:14:21'),
(330, 'Md.Ujjol Miah', 'ujjolmiha0@g-mail.com', '01783554083', NULL, 0, 3, NULL, NULL, '$2y$10$6uphastqX7ZqBwY87/QcdOOZxMT2r6jBHFfhsZTuD3c0H2VCmTbg.', NULL, '2021-11-04 13:18:37', '2021-11-04 13:18:37'),
(331, 'Mdjubair', 'jubairbinislma2000@gmail.com', '01744402659', NULL, 0, 3, NULL, NULL, '$2y$10$TzwJesSQ9MfXvDDEn9lHseLyPZTwdb2zb3BbflOH1jF67.ygrGX62', NULL, '2021-11-04 13:19:08', '2021-11-04 13:19:08'),
(332, 'Meer Zeeshan', 'meerzee8080@gmail.com', '01405367236', NULL, 0, 3, NULL, NULL, '$2y$10$/YG2j/2WNbcxrG1Dwm89Y.uNAn5fkxaByk8p6wuA5WY2S0EO4IGky', NULL, '2021-11-04 13:27:08', '2021-11-04 13:27:08'),
(333, 'Sumaiya akther shanta', 'jannatshanta219@gmaii.gmail.com', '01746304151', NULL, 0, 3, NULL, NULL, '$2y$10$pUU67p8HfEYXzmGlO3o1ueMn2I4Wn6K8G/XKFmMthpgRo5s8bxOOW', NULL, '2021-11-04 13:30:45', '2021-11-04 13:30:45'),
(334, 'Mobarak', 'mdmobarakh325@gmail.com', '01770946421', NULL, 0, 3, NULL, NULL, '$2y$10$9uciCgSwidFkK53cYqLZU.E542z.mtK8R0FMMFvMjO8kEoH4FsEf2', NULL, '2021-11-04 13:54:55', '2021-11-04 13:54:55'),
(335, 'Atif Ananto', 'anuananto232000@gmail.com', '01318494623', NULL, 0, 3, NULL, NULL, '$2y$10$vydlyMPE6wi.pBjmyupTb.s1hV9DM9gV0ETBnfYgVcv9eKj1zvmJC', NULL, '2021-11-04 14:01:40', '2021-11-04 14:01:40'),
(336, 'Meraj Hossain Tushar', 'marajhossin416@gmail.com', '01773699655', NULL, 0, 3, NULL, NULL, '$2y$10$8gTFiSzvAA03PSETd1fjCunbfc67NADW8tK3D4C3BFy5Y5M/S6u8C', NULL, '2021-11-04 14:02:46', '2021-11-04 14:02:46'),
(337, 'Nd Hafizur Rahman', 'mdhafiz1850@gmail.com', '01614324763', NULL, 0, 3, NULL, NULL, '$2y$10$dPNRamQ8B21qRy/54jlGi.H/0NM.rOfVte6rWfqryRBdOQ2BID7X6', NULL, '2021-11-04 14:04:49', '2021-11-04 14:04:49'),
(338, 'Tarith kanti barman', 'tarith133@gmail.com', '01826583555', NULL, 0, 3, NULL, NULL, '$2y$10$N1cMh5vIloqyVCAOFG2Puun.IX2CbKTHRHnQ.5qh.3EBiSo4xr94u', NULL, '2021-11-04 14:06:00', '2021-11-04 14:06:00'),
(339, 'Shahriar Shobuj', '2003aass2020@gmail.com', '01712618785', NULL, 0, 3, NULL, NULL, '$2y$10$bxD0wWIxpyH5RPk3VWHyzOb2XUiOIK1D3Im.3x/qklu.8TVzFq9pm', NULL, '2021-11-04 14:36:41', '2021-11-04 14:36:41'),
(340, 'Asad Rasel', 'asadrasel420@gmail.com', '01915873724', NULL, 0, 3, NULL, NULL, '$2y$10$kk85dIgq3cNWwDXOuuApceQLCdxWxO6SXJCeuP7F4htQwYaYlY0xy', NULL, '2021-11-04 14:43:41', '2021-11-04 14:43:41'),
(341, 'Md.Abu Talha', 'abutalha1010@gmail.com', '01701941555', NULL, 0, 3, NULL, NULL, '$2y$10$ZxpHZ3.fHGQMkROfSloy2eihA84ffIQZc6fjYkBxGetuRcxIF9jtG', NULL, '2021-11-04 15:02:29', '2021-11-04 15:02:29'),
(342, 'Maria Akter Supti', 'abutalhascout@gmail.com', '01968203083', NULL, 0, 3, NULL, NULL, '$2y$10$z1L8wHAE23dEhzq72u.nCuIVLNUuYLSpHoa2rHKR7ulXlxk0FqTgG', NULL, '2021-11-04 15:05:03', '2021-11-04 15:05:03'),
(343, 'Toufiq Hasan Imroze', 'toufiqhasanimroze@gmail.com', '01752259411', NULL, 0, 3, NULL, NULL, '$2y$10$c5m9WLtLYWKXs6B6fIaRGuUk4xwNUnI7XDGL3PX6Je.gRKDNrFzaC', NULL, '2021-11-04 15:12:52', '2021-11-04 15:12:52'),
(344, 'Prottoy Sarker', 'prottoysarker952@gmail.com', '01862792735', NULL, 0, 3, NULL, NULL, '$2y$10$uyLGHRlJHcsyfBjgW2i88OvhGuTDIcIoPNKu/ErSr8mB6e4v/xYXi', NULL, '2021-11-04 15:33:40', '2021-11-04 15:33:40'),
(345, 'Sakibul islam shahin', 'Shahinmollah0181@gmail.com', '01304140181', NULL, 0, 3, NULL, NULL, '$2y$10$dCx491WDFatnXzPhMSG8ZuHPhXybRVYsaSVQVVPdEyF.TdaqDJL0K', NULL, '2021-11-04 16:30:12', '2021-11-04 16:30:12'),
(346, 'Nirob', 'nitobsaha897@gmail.com', '01859222444', NULL, 0, 3, NULL, NULL, '$2y$10$B8rWklGWbN1MZltjzviELuah/gFdE2La/pi8qkMwN/fQH9byj6n86', NULL, '2021-11-04 16:39:26', '2021-11-04 16:39:26'),
(347, 'Sujon Ahmed', 'sahmed33462@gmail.com', '01879495373', NULL, 0, 3, NULL, NULL, '$2y$10$KlpWyFaptZOAkhE9VGO4VeWMVUFA2HvyoajvL9Et7hRVm9beWk3P6', NULL, '2021-11-04 16:42:13', '2021-11-04 16:42:13'),
(348, 'Mahbub Hasan', 'msboymonir223@gmail.com', '01868539393', NULL, 0, 3, NULL, NULL, '$2y$10$WJ2Ck3juiEGDjtzdvSbnJOIfVDtqGkb2PeRnswK3eY3Tpkx7JzDJy', 'LCJHvA9Z2WBnMw3Fsitp6uAaw6nlMtWOYPyb8PYjM0Xm0klM7t2hUuORr914', '2021-11-04 16:43:31', '2021-11-04 16:43:31'),
(349, 'Shohel Adnan', 'shoheladnan07@gmail.com', '01646715748', NULL, 0, 3, NULL, NULL, '$2y$10$BjKY/vppVNN0PxCcvR7LHu.1F0U.PhgcIpj2fKr2a.nutP2py0d4O', NULL, '2021-11-04 16:54:08', '2021-11-04 16:54:08'),
(350, 'Abdullah Al Fahad', 'abdullahfahad9277@gmail.com', '01834338383', NULL, 0, 3, NULL, NULL, '$2y$10$ugZA1SGzeyvxe6bEDOl5/eSP8nLA52Z3M4YoogToOaDKNOJqrRM56', NULL, '2021-11-04 16:56:29', '2021-11-04 16:56:29'),
(351, 'Abir Hossain Kafi', 'abirkafi01@gmail.com', '01731652587', NULL, 0, 3, NULL, NULL, '$2y$10$Ht09wigjB8eLF5LHCJZ/eukDIXql5HTq5pK5Oo/2Sz//4QXRJT63O', 'xa40rgz9ro6aIHdz6XoPtDCxeqL9N8N8g3DeieCRlpIFeVjTUnZB5H53DgAx', '2021-11-04 16:59:18', '2021-11-04 16:59:18'),
(352, 'Ibrahim', 'ebrahim.hossain273@gmail.ocm', '01774662012', NULL, 0, 3, NULL, NULL, '$2y$10$1XrjFWpN6cdY.gHDfAegguOHpwCxC2N1oXhJVCOHkcsIt5sJoy7TO', NULL, '2021-11-04 17:03:11', '2021-11-04 17:03:11'),
(353, 'Niloy Ahamed', 'Niloy.black01@gmail.com', '01927770847', NULL, 0, 3, NULL, NULL, '$2y$10$RG0XYRQqMdrrwza9IIIhT.5lhaAuDRXwpcQ.lW4KXUXoWe1/BoadW', NULL, '2021-11-04 17:12:35', '2021-11-04 17:12:35'),
(354, 'Nazmul Hossain Tuhin', 'nazmulhossaintuhin55@gmail.com', '01824072396', NULL, 0, 3, NULL, NULL, '$2y$10$DML92eHhesmp.8keuZOvkuLOn90MIKg.6oRaZtZgcZoqttoIqO44G', NULL, '2021-11-04 17:37:12', '2021-11-04 17:37:12'),
(355, 'Nahid Hasan', 'nahidniloy120@gmail.com', '01762206831', NULL, 0, 3, NULL, NULL, '$2y$10$JQ0720Ap32wzCyhUc43HoOSKRJm3S0DyIRdtE9HqySgCIza0bl6Ci', NULL, '2021-11-04 17:46:06', '2021-11-04 17:46:06'),
(356, 'Md Rakibul Islam Riyed', 'riyed6617@gmail.com', '01725922026', NULL, 0, 3, NULL, NULL, '$2y$10$2UqTdZqWv8gNDPkux6rYv.o7dkyJo6Bs2ssQAprwf/xx00OFXzB.i', NULL, '2021-11-04 17:46:29', '2021-11-04 17:46:29'),
(357, 'Md saiful islam', 'mdaros4242@gmail.com', '01309321503', NULL, 0, 3, NULL, NULL, '$2y$10$7KGtd8d7ntKgCom84y2WteEI5sCXg8BQdgTdZ8KNNptr.i0qqDJ2i', NULL, '2021-11-04 17:53:39', '2021-11-04 17:53:39'),
(358, 'Sk. Habib', 'Butnew@fuwamofu.con', '01744295670', NULL, 0, 3, NULL, NULL, '$2y$10$Y2hKFJx.ekn8K3I/jY/X6uI/5hyiB4qV2.7vOVUqeaueyYIxRgiHO', NULL, '2021-11-04 17:54:59', '2021-11-04 17:54:59'),
(359, 'Al Jaber', 'aljaber4073@gmail.com', '01629817340', NULL, 0, 3, NULL, NULL, '$2y$10$lFdlPBcYjSYuz9957U/s3u1lul7XeEg7xydsQlOYLwEGgk9E92Tg.', NULL, '2021-11-04 18:05:21', '2021-11-04 18:05:21'),
(360, 'Muhammed Rayhan', 'isqahmed12@gmail.com', '01648761497', NULL, 0, 3, NULL, NULL, '$2y$10$NcDi/7q9A4BNeYswKzcenOyMMlPyj9vIKlzBrYVX1bx/n.wolo78S', NULL, '2021-11-04 18:14:41', '2021-11-04 18:14:41'),
(361, 'Sabbir Ahmed', 'hi0587256@gmail.com', '01408824506', NULL, 0, 3, NULL, NULL, '$2y$10$fxzP737rNMzS3Yv7nNP7eOwv.G73p0p1fdcuh1.7KiFBQJdQqyl1u', NULL, '2021-11-04 18:19:22', '2021-11-04 18:19:22'),
(362, 'Hasibur Rahman Nyeem', 'hasiburrahman14022001n1@gmail.com', '01642049209', NULL, 0, 3, NULL, NULL, '$2y$10$sHOEHQc7UzdUHY3x/Z/eu.iRwBjQvPTBk92sW4HMWgv9FZs9suvra', NULL, '2021-11-04 18:26:44', '2021-11-04 18:26:44'),
(363, 'Salman Shihab', 'salmanshihab76@gmail.com', '01814563976', NULL, 0, 3, NULL, NULL, '$2y$10$oAUx9VmOdHgHkkefC.qhrOJtdvo2BXJmNO2EtsWe6euRfXkttaK16', NULL, '2021-11-04 18:57:17', '2021-11-04 18:57:17'),
(364, 'Tahosin Akib', 'tahosinakib89@gmail.com', '01306876907', NULL, 0, 3, NULL, NULL, '$2y$10$EyUEmVYt6sUIKUGb/ZmsQeFtEYhgjhmrivzmo2YPH6.8XFDzxT8Wu', NULL, '2021-11-04 19:24:27', '2021-11-04 19:24:27'),
(365, 'Ibrahim Hossan', 'hossenibrahim672@gmail.com', '01308506633', NULL, 0, 3, NULL, NULL, '$2y$10$MrTJLHFTTfg/bBCji1L9.usBsgXihUnySgBz0qOmQ/L/MVbaRdIaO', 'ivtBpnJdzhHhuK11lHuKwyGqReISrW2o5Td4STuppepcFKWYBt1fQCNIaHQM', '2021-11-04 19:26:02', '2021-11-04 19:26:02'),
(366, 'Md. Manik', 'sddicricket154@gmail.com', '01906078939', NULL, 0, 3, NULL, NULL, '$2y$10$q4j4G.sHeL0vNj.hE4WZs..tf0QTRUt/Br5SdFWiQ/wiV2gLUbSRm', NULL, '2021-11-04 19:28:53', '2021-11-04 19:28:53'),
(367, 'Sajin sheke', 'sajinsheke1357@gmail.com', '01776890719', NULL, 0, 3, NULL, NULL, '$2y$10$.iJa54zy06lKA.HT.O5hies8o/JANnrVohlamC70QFkeGWyOwi7XC', NULL, '2021-11-04 19:57:47', '2021-11-04 19:57:47'),
(368, 'Md Zobaidul Hoque Sourav', 'mdsourav1278@gmail.com', '01888637520', NULL, 0, 3, NULL, NULL, '$2y$10$4.e4PhM4hCOSn.2fo9MOrOklh/7Q96cRZIvhf46wBOy8rjgxEiCZC', NULL, '2021-11-04 20:15:03', '2021-11-04 20:15:03'),
(369, 'Md Azizur Rahman', 'aziz1610382417@gmail.com', '01967632424', NULL, 0, 3, NULL, NULL, '$2y$10$c4tqWI7IVZ2TyBhzRPi9eeeX2uPnUA3NAWd1WY9z0iLaiGzIEpbxW', NULL, '2021-11-04 21:33:07', '2021-11-04 21:33:07'),
(370, 'Shuvojit Bairagi', 'shuvojitshuvo6@gmail.com', '01707816403', NULL, 0, 3, NULL, NULL, '$2y$10$jLNNUOo7hmQoqxcqfuPxtujdJ3.8mQO.AmpOergtQFxUN5OqPS4xW', NULL, '2021-11-05 01:23:56', '2021-11-05 01:23:56'),
(371, 'MD sadik', 'harunatw514@gmail.com', '01311969406', NULL, 0, 3, NULL, NULL, '$2y$10$DXI6jnzCbWCZBVwlTNFuC.f9ToZV5gHvpM7iYT1fRCWDfd5Vu8KYW', NULL, '2021-11-05 01:29:03', '2021-11-05 01:29:03'),
(372, 'MIFTAHUL MILLAT SHAH', 'miftahulmillat82@gmail.com', '01521719095', NULL, 0, 3, NULL, NULL, '$2y$10$2EfT45NAltsOlNLNXff9CevyYJO5nyNCUknZWFGTtUtSrUPrkHMui', NULL, '2021-11-05 02:24:47', '2021-11-05 02:24:47'),
(373, 'Jamal salman', 'jamalsheikh084@gmail.com', '01771165289', NULL, 0, 3, NULL, NULL, '$2y$10$tdW16KpwjrdE8Q11NsJP6OxDdNw0lIiItBfaZWcS8K/lNHdzdnpA.', NULL, '2021-11-05 03:03:09', '2021-11-05 03:03:09'),
(374, 'Suklal das', 'suklalsctsuklal@gmail.com', '01764608741', NULL, 0, 3, NULL, NULL, '$2y$10$u5u2FlV73vigh7HPQ43teuh4o8yLg5EkByiA2a5bJgqR4o/wWKY.6', NULL, '2021-11-05 03:37:03', '2021-11-05 03:37:03'),
(375, 'Tanjid khan', 'khntanjid@gmail.com', '01631655478', NULL, 0, 3, NULL, NULL, '$2y$10$iZcZiELkycoL4TUuo2U.weTsYDrty.j.1iRJUZzN0GZgc7gGkaqNy', NULL, '2021-11-05 03:46:12', '2021-11-05 03:46:12'),
(376, 'Kazi Maksudul Haque', 'maksudulhaqu123@gmail.com', '01718750901', NULL, 0, 3, NULL, NULL, '$2y$10$554QuV72k.Cbbkm3UzJ2DuDTzgFwCaLT8CC162fSdRjg1hNkGsO8K', NULL, '2021-11-05 04:10:26', '2021-11-05 04:10:26'),
(377, 'Sharmin Aziza', 'sharminaziza56@gmail.com', '01608978517', NULL, 0, 3, NULL, NULL, '$2y$10$D9mqLW8NA1SawlyuB/SSJO4ovA/jMikeJGRGlYaGb/pgFFD4l7vxe', NULL, '2021-11-05 04:14:20', '2021-11-05 04:14:20'),
(378, 'Tanzir Ahsan', 'tanzirahsan22@gmail.com', '01318448165', NULL, 0, 3, NULL, NULL, '$2y$10$tkvK015qKr3yzZYKD6yruOCuAFc8LMHZk4E0ohuYo/WMGB2yxPhuW', NULL, '2021-11-05 04:14:43', '2021-11-05 04:14:43'),
(379, 'Md Habibullah', 'ythabibullah58@gmail.com', '01760414802', NULL, 0, 3, NULL, NULL, '$2y$10$riwdb2LUAjbOgEchTPqaqez3yXduAYgpgcT5mlyhCw0mLvayv/2KS', NULL, '2021-11-05 04:19:57', '2021-11-05 04:19:57'),
(380, 'Mamunur Rashid', 'kmsmamunur@gmail.com', '01936571659', NULL, 0, 3, NULL, NULL, '$2y$10$1fC.Epz31qJUSN4kDc04X.ReLV..YeiiuupcUZlpchcvt/Ob5xr0i', NULL, '2021-11-05 04:48:00', '2021-11-05 04:48:00'),
(381, 'Priya', 'premaashrafpriya@gmail.com', '01720354398', NULL, 0, 3, NULL, NULL, '$2y$10$KAArb8G6KSwGJXa5GDJj8eB736A1cW7TFeGPGQg6QSst9G6jNgpyO', NULL, '2021-11-05 05:09:11', '2021-11-05 05:09:11'),
(382, 'Bdlal Hussein', 'hussainbelal93@gmail.com', '01886169552', NULL, 0, 3, NULL, NULL, '$2y$10$9ig10yOYebS.ASv6EyHU7.rdJ2mT2wd4gZ0Cn7iLzOZSH2max6QxC', NULL, '2021-11-05 05:16:00', '2021-11-05 05:16:00'),
(383, 'MD Mahmud', 'mahamudhossainarafat88@gmail.com', '01887287614', NULL, 0, 3, NULL, NULL, '$2y$10$cVVIehcotgo9gWp1pitUKucVinVCd6FymiNjkWTNCBnb6NyPzlAai', NULL, '2021-11-05 05:23:10', '2021-11-05 05:23:10'),
(384, 'Fahim khan', 'yourgmail@gmail.com', '01307880071', NULL, 0, 3, NULL, NULL, '$2y$10$Epc/m5STqxWrd/rAAKehjewyLK8AcTl6XJWuUvwUDz12Q.ZXShix.', NULL, '2021-11-05 06:15:07', '2021-11-05 06:15:07'),
(385, 'Tanvir Ahmmed', 'tanvirahmmed251@gmail.com', '01736587252', NULL, 0, 3, NULL, NULL, '$2y$10$x4EvUqcNaRqoWOuQu4qtoeMuKy2Y5vZXPOmlZo5pY8GW9f2qSVHqy', NULL, '2021-11-05 06:31:20', '2021-11-05 06:31:20'),
(386, 'Mugdho protim', 'mugdhoprotim2000@gmail.com', '01308523098', NULL, 0, 3, NULL, NULL, '$2y$10$1yYD3w9b4dn.WuAUW1VNHOJzpzIpmKfPVKs1mOcPumvESWo535yo2', NULL, '2021-11-05 07:17:15', '2021-11-05 07:17:15'),
(387, 'Saiful Islam', 'si2769763@gmail.com', '01308363590', NULL, 0, 3, NULL, NULL, '$2y$10$tBMbMTyJRmEsGgP3uZ3AH.KpsSm0maH83KJd2zh2Yg9DhMaB4t/F.', NULL, '2021-11-05 08:10:51', '2021-11-05 08:10:51'),
(388, 'Raj sarkar', 'petloverjsr570@gmail.com', '01935001161', NULL, 0, 3, NULL, NULL, '$2y$10$T3qx3LNr2hsuISMDLFpM0uMgOiipX7j0g3H/H3OsLDjD.9sV1hufa', NULL, '2021-11-05 08:16:37', '2021-11-05 08:16:37'),
(389, 'Badar Hossain', '12041badarhossain@gmail.com', '01310384789', NULL, 0, 3, NULL, NULL, '$2y$10$6plKQfiaybaXTvAbDo.3cOF1V5JmJ8..Ql29UT6u6rfZa8KyfUZHi', NULL, '2021-11-05 08:28:49', '2021-11-05 08:28:49'),
(390, 'MD Mehedi Hasan', 'ahsanmehedi7@gmail.com', '01794935241', NULL, 0, 3, NULL, NULL, '$2y$10$acd5exMQ1mPAhZ2CScT56O8lIqXoPbZQY9kn4NZM7ocAt2tmRTGiq', NULL, '2021-11-05 08:46:39', '2021-11-05 08:46:39'),
(391, 'Badsha Faisal', 'artistfaisal12345@gmail.com', '01760026247', NULL, 0, 3, NULL, NULL, '$2y$10$sEqQdxH6X.fokpTzDNCYRuFCaikRIfrJ3TO5wAI9hLadUMtqujZbq', NULL, '2021-11-05 08:52:14', '2021-11-05 08:52:14'),
(392, 'Mohammad Ullah', 'mu2927691@gmail.com', '01772329464', NULL, 0, 3, NULL, NULL, '$2y$10$yUsbBzUF.liIGfJ8z0x9KeEjU9rkicJ8.N6/bVKjtbhJ3RG/zaGiS', NULL, '2021-11-05 09:07:02', '2021-11-05 09:07:02'),
(393, 'Shahed Ahmed Saikat', 'saikatahmed673@gmail.com', '01642812767', NULL, 0, 3, NULL, NULL, '$2y$10$jopS30nLvlPRPHJsbIXkq.OxjVXRB81fHgmVwQghjQJcuBQFMug.C', NULL, '2021-11-05 09:11:15', '2021-11-05 09:11:15'),
(394, 'Amjad Hossain', 'amjadhossain0186@gmail.com', '01874991533', NULL, 0, 3, NULL, NULL, '$2y$10$lk2JPU8brMcjr6jA.z5qb.IM44JhOsYwybwpq6ShAHWTo3k3g83mG', NULL, '2021-11-05 09:34:57', '2021-11-05 09:34:57'),
(395, 'Tanvir Hossain Shihab', 'shihabvs002@gmail.com', '01727916074', NULL, 0, 3, NULL, NULL, '$2y$10$Bn5TO08mcuKaBEui0c7mGeSbPWQthpP9nhMEtFX2KCgeHzijCGxhK', NULL, '2021-11-05 09:36:15', '2021-11-05 09:36:15'),
(396, 'Anik Kumar', 'aniksingh2004om@gmail.com', '01770692023', NULL, 0, 3, NULL, NULL, '$2y$10$CAc2oitBwBewrTFvgjwN..a.sVCzVK9EXTmCoMWEbi8AatQtbEBqe', NULL, '2021-11-05 10:40:10', '2021-11-05 10:40:10'),
(397, 'Md Sabur miah', 'mdabsaburmiah23452345@gmail.com', '01311757493', NULL, 0, 3, NULL, NULL, '$2y$10$ieSxl9sYmZLaMsUmb2lrmekAU00j3QFfE6azXlNMIIGMyhMPUUYx2', NULL, '2021-11-05 11:20:25', '2021-11-05 11:20:25'),
(398, 'Azam', 'evilsquad47@gmail.com', '01905292787', NULL, 0, 3, NULL, NULL, '$2y$10$.YCJBz21BDWDxc/hhkFgOOvlsSqWhwjny4oFZyK0m1I2UD1IgafDS', NULL, '2021-11-05 11:39:00', '2021-11-05 11:39:00'),
(399, 'Dhrubo', 'dcd.mission@gmail.com', '01827307481', NULL, 0, 3, NULL, NULL, '$2y$10$836fZxF06dCMZ6HynCYTbeKMow1chzVSmUTpLNls6tVULtFvKkGTy', NULL, '2021-11-05 11:46:45', '2021-11-05 11:46:45'),
(400, 'Shadin', 'abrarfaizshadin@gmail.com', '01719968083', NULL, 0, 3, NULL, NULL, '$2y$10$3NmHRBhtFfK8GE298FdOOOHU0RfuUYL9m3RNe7e.IcnkXIf3MWgx.', NULL, '2021-11-05 11:53:51', '2021-11-05 11:53:51'),
(401, 'Bisheajit Acharjee', 'bishwajitacharjee6@gmail.com', '01660036227', NULL, 0, 3, NULL, NULL, '$2y$10$o3f/umfRz.POlBbu9HfvdO.lOqfXJ.O9aWIEXZtUk5wLo518544TS', NULL, '2021-11-05 11:58:01', '2021-11-05 11:58:01'),
(402, 'Rejwanul Kabir', 'rejwan1818@gmail.com', '01625705009', NULL, 0, 3, NULL, NULL, '$2y$10$mRZc42c.ESNMy6fWmn70.uEeREPAyRhMzhBrBwQEqFeUHBeKxFyEe', NULL, '2021-11-05 12:05:11', '2021-11-05 12:05:11'),
(403, 'Fahim Chowdhury', 'fahimc543@gmail.com', '01643421103', NULL, 0, 3, NULL, NULL, '$2y$10$s/jCPKaW9S1Gpajk5TIhZ.ZkgV.zuVBXwaY81.MokeoK/m5F724.m', NULL, '2021-11-05 12:15:33', '2021-11-05 12:15:33'),
(404, 'Md Abdur razzak roni', 'razzak72abdur@gmail.com', '01409522051', NULL, 0, 3, NULL, NULL, '$2y$10$fkKmo3h4cs6RNhJVk4KMHuxtPvNIcjWeIulBLLpCCJmhihqiJwIYy', NULL, '2021-11-05 12:55:12', '2021-11-05 12:55:12'),
(405, 'Rafi', 'devilasif278@gmail.com', '01728340697', NULL, 0, 3, NULL, NULL, '$2y$10$WPC5WAs/4gbPbvz6olAp4OuG83UjPfOe.s1kKzg4IcolhrLKFs.Ae', NULL, '2021-11-05 13:15:26', '2021-11-05 13:15:26'),
(406, 'Tasnim samee', 'tsamee444@gmail.com', '01716810271', NULL, 0, 3, NULL, NULL, '$2y$10$7iQQSi1CijA4.plhV6vHkumayAcO1jh0IaGmBp1VJJVk2Dy4SB3XW', NULL, '2021-11-05 13:29:48', '2021-11-05 13:29:48'),
(407, 'Md Yasin Arafat', 'farhanarafat277@gmail.com', '01753552269', NULL, 0, 3, NULL, NULL, '$2y$10$UbS.mdmI4YbokZrm/Ef6CusaikTrS5O2xekrrQC3L6D5hZILhRfA6', NULL, '2021-11-05 14:13:18', '2021-11-05 14:13:18'),
(408, 'Sarkar Sujon', 'sujonsarkar3176@gmail.com', '01726692209', NULL, 0, 3, NULL, NULL, '$2y$10$csyRrsmDr6a3iwIk4yedBOeHU7510JI7hQrAaO81LNSuVum6H0WnG', NULL, '2021-11-05 14:19:33', '2021-11-05 14:19:33'),
(409, 'Steven Smith 49', 'nahidsiddik123456@gmail.com', '01893957807', NULL, 0, 3, NULL, NULL, '$2y$10$sykh1aMiUe9OIHTjLJu6x.XVjye8Btsjd/wAkP3yKSgLIbjWvi70O', NULL, '2021-11-05 14:43:18', '2021-11-05 14:43:18'),
(410, 'Fahim Al Fardin', 'fardinaptitude@gmail.com', '01813136423', NULL, 0, 3, NULL, NULL, '$2y$10$Y1vzTzB.VCc6AYaTlGfrQuc8O8ewGr5m91fOR/KLc6.ivt85Cb7fm', NULL, '2021-11-05 15:25:03', '2021-11-05 15:25:03'),
(411, 'Rahman Rumanur', 'rumanrahman0000@gmail.com', '01761967431', NULL, 0, 3, NULL, NULL, '$2y$10$pCegBsjigL/CbgSWMObsn.sppthjeQTFGbC5ujVtUEzWwMj5fyPoa', NULL, '2021-11-05 15:49:50', '2021-11-05 15:49:50'),
(412, 'Md Mehedi Hasan Sojib', 'sojibeng24@gmail.com', '01727121554', NULL, 0, 3, NULL, NULL, '$2y$10$jQQ7//tOiFdu2RnH8dl/DOEgeYXqZpJQ8wyQ8AG5gNk9cnV2WNGta', NULL, '2021-11-05 16:44:35', '2021-11-05 16:44:35'),
(413, 'Shohel Rana', 'sorkarshohelrana064@gmai.com', '01785304483', NULL, 0, 3, NULL, NULL, '$2y$10$bvyqsla8tuKoFfZkWcduBu5w0I.dBiB/wpVTPjvuBl4JMtTt1bat6', NULL, '2021-11-05 16:53:48', '2021-11-05 16:53:48'),
(414, 'Nazmul Islam', 'mulnaz31@gmail.com', '01789634419', NULL, 0, 3, NULL, NULL, '$2y$10$nwK8yxsTPvPS6yTEyBZJCuHOVjcuLeFhiN.buLUbJHpYhbCZYjEYq', NULL, '2021-11-05 18:02:18', '2021-11-05 18:02:18'),
(415, 'Tonmoy Afjal', 'woasiafjal@gmail.com', '01313392988', NULL, 0, 3, NULL, NULL, '$2y$10$Dkk7dTGNrlYXefWlo7UWG.qtWMkIzfTUBGcO1MUnQ9MByTjKyKdWm', NULL, '2021-11-05 18:44:32', '2021-11-05 18:44:32'),
(416, 'Prithu Mahmud', 'prithu.tanjum@gmail.com', '01722355674', NULL, 0, 3, NULL, NULL, '$2y$10$.KVs0o7IsJcq3QCLWcEsLedLie2dpILhVHckgkiizRyrKOc5kyCKO', NULL, '2021-11-05 19:15:29', '2021-11-05 19:15:29'),
(417, 'Avesheq Chanda', 'avesheqdrmc@gmail.com', '01859180132', NULL, 0, 3, NULL, NULL, '$2y$10$vX1wqXRxO1XDEeD6rOZnBegspdL/oOwcw6UAnbYjpQ1InHAAx1b7m', NULL, '2021-11-05 19:18:29', '2021-11-05 19:18:29'),
(418, 'Adon mazumder', 'ruhulmaani2002@gmail.com', '01886273730', NULL, 0, 3, NULL, NULL, '$2y$10$7myHnjqLGsCT8o6jIJ.ILOSJqTQ5326/aTKuFVnHT.P0VEc04yvDq', NULL, '2021-11-05 21:18:31', '2021-11-05 21:18:31'),
(419, 'Saharia asif', 'sahariakobirasif@gmail.com', '01786655150', NULL, 0, 3, NULL, NULL, '$2y$10$yNFy5OQmOguSbDYaS8QdqOaQATtiXu5zqx1xDb6rjnWoymBf0m3sq', NULL, '2021-11-06 03:13:26', '2021-11-06 03:13:26'),
(420, 'Md. Sumon hossen', 'mdsumonhossen216@gmail.com', '01761188937', NULL, 0, 3, NULL, NULL, '$2y$10$FpLOICg8mMitBekw/FWFD.Rz3xxS6BThqIO4BcWxcQB6zqWT/VrD6', NULL, '2021-11-06 08:48:40', '2021-11-06 08:48:40'),
(421, 'Shahriar Arnob', 'shahriararnob23@gmail.com', '01621847494', NULL, 0, 3, NULL, NULL, '$2y$10$IZDK/3LverBlMxT3PYkvjeOlFzvxqc3vzpnd23egTKbthNSjonCNO', NULL, '2021-11-06 09:03:39', '2021-11-06 09:03:39'),
(422, 'MD. SAJIB HOSSAIN', 'renesasajibhossain@gmail.com', '01743030630', NULL, 0, 3, NULL, NULL, '$2y$10$6BgscsNvBYLX41n5QioAbeLViuh0G7bGK6ayeyqMLOJOttP.I29lu', NULL, '2021-11-06 09:37:04', '2021-11-06 09:37:04'),
(423, 'Md Mojahid Islam Alif', 'mojahidislam373@gmail.com', '01723168940', NULL, 0, 3, NULL, NULL, '$2y$10$adZF4YvxRhOFoIzdMMkT2.FCZxrmmnpExEMZYtvsNKdXOspfJmI/2', NULL, '2021-11-06 11:24:47', '2021-11-06 11:24:47'),
(424, 'SHOVAN BISWAS', 'shovansbs@gmail.com', '01305066101', NULL, 0, 3, NULL, NULL, '$2y$10$ytB2/fAJLmbzK3T4RXQyw.DXWECaUmIOM8yfjKoEewgZrITEuZkD6', NULL, '2021-11-06 15:28:12', '2021-11-06 15:28:12'),
(425, 'Noshin salsabil', 'noshinsalsabil72@gmail.com', '01678833075', NULL, 0, 3, NULL, NULL, '$2y$10$Rp3dOmNh2pdvVcn0J9ZyruyP87ZSaUOSJP7fknIwpeJiO2f074Lbu', NULL, '2021-11-06 15:57:46', '2021-11-06 15:57:46'),
(426, 'Mustafiz', 'Stokeben166@gmail.com', '01796459638', NULL, 0, 3, NULL, NULL, '$2y$10$K5qppnzypRVTqatVHM606ufoVspBqzbkVYamtu7p7fP4r50MwMamK', NULL, '2021-11-06 16:30:41', '2021-11-06 16:30:41'),
(427, 'Sidratul Muntaha', 'mimisidratul@gmail.com', '01315569525', NULL, 0, 3, NULL, NULL, '$2y$10$LhM6tism/bT3yCnL7AjQD.TZq5XISuyF8AT9SXjCKTCP7FcxuJvNe', NULL, '2021-11-07 05:12:35', '2021-11-07 05:12:35'),
(428, 'Jarratul Muntaha', 'jarratultiti@gmail.com', '01315569524', NULL, 0, 3, NULL, NULL, '$2y$10$NhwsG5V.IgNJywk3d8AjL.8.1/0QqvPX2C07PinKxOgFgr0b5r85y', NULL, '2021-11-07 05:18:19', '2021-11-07 05:18:19'),
(429, 'shohana akter lima', 'shohanaakterlima5@gmail.com', '01319459819', NULL, 0, 3, NULL, NULL, '$2y$10$OL.mM0zwrngsZyA39CzxYudf03AdFW/hcfBg9RbjOZeXVLR.AdLl.', NULL, '2021-11-07 08:21:44', '2021-11-07 08:21:44'),
(430, 'Muhibur Rahman Himel', 'mrhimel018@gmai.com', '01835345885', NULL, 0, 3, NULL, NULL, '$2y$10$4Zq16FimWhN3arfBUBQL6uY2TblcXAmqA3g.IPbbWl5FHIkCm1KiS', NULL, '2021-11-07 12:16:06', '2021-11-07 12:16:06'),
(431, 'Md.Mission', 'mdmission262@gmail.com', '01987190063', NULL, 0, 3, NULL, NULL, '$2y$10$.VX6FEQtiZVTfOI.t4Q0GuxObabD50lTKmiwhSGfOElSdBdkDIA22', NULL, '2021-11-07 12:28:08', '2021-11-07 12:28:08'),
(432, 'Rupa sultana', 'rafiqulislamm761@gemai.com', '01308274606', NULL, 0, 3, NULL, NULL, '$2y$10$9kIGmgLoIKSJUY2rT4dfZuEmRpnDorW1M3/vMh7oaAasEsbjLNbqS', NULL, '2021-11-07 18:10:26', '2021-11-07 18:10:26'),
(433, 'Spondon', 'rahmanmosiur841@gmail.com', '01303235028', NULL, 0, 3, NULL, NULL, '$2y$10$h72qh4cTV4bLUyztG/CZsuh1vCdQl2REy9ZSdr9xfmoOs.HNybKJ.', NULL, '2021-11-07 18:17:47', '2021-11-07 18:17:47'),
(434, 'Jannatul hurain', 'huraynejannatafroz@gmail.com', '01625432802', NULL, 0, 3, NULL, NULL, '$2y$10$e38SIIRFDmZ8778VXJZcgeHpp/jTQ5Y6A.DCQ/CBf7l6jyyS/CD1a', NULL, '2021-11-07 19:53:29', '2021-11-07 19:53:29'),
(435, 'Md.Shahinur Islam', 'mdshahinurislamshahin603@gmail.com', '01717762603', NULL, 0, 3, NULL, NULL, '$2y$10$VeFYMX/mw4McZAwCgMf6xel6.ng6ratwt4EZ/3ANh1e6kCCH/DORC', NULL, '2021-11-07 21:22:57', '2021-11-07 21:22:57'),
(436, 'Mst Tasmira Akter', 'tasmiraoishi993@gmail.com', '01794508354', NULL, 0, 3, NULL, NULL, '$2y$10$xXnM1WIB9l0T9d/ETL5MT./CbEiqVPGkVzkJoHjtjhRa4s7gBz4Ii', NULL, '2021-11-08 01:56:50', '2021-11-08 01:56:50'),
(437, 'Aflatun Jaman Adiba', 'aflatunadiba627@gmail.com', '01710713337', NULL, 0, 3, NULL, NULL, '$2y$10$KEiABAzMbN1tPtqMaUZ1T.sEIYIVbPbUN9BZ0sSYtZQQpgyD5hdaO', NULL, '2021-11-08 02:21:29', '2021-11-08 02:21:29'),
(438, 'Shaikh Nurayen Tanha', 'tanhanurayen@gmail.com', '01531161554', NULL, 0, 3, NULL, NULL, '$2y$10$a/4pKBApjnf1P9fKRNNEoevyBhTCQ1FUtNUlQmHwIGMsqFetB7kqC', NULL, '2021-11-08 03:48:36', '2021-11-08 03:48:36'),
(439, 'Abdul Ahad Shaikh', 'shaikhabdulahad26@gmail.com', '01740755751', NULL, 0, 3, NULL, NULL, '$2y$10$GGuJtrYRtUOA7huDtW6sEuKN52hS/LcdrLecCUw/Zra5nrfG2amwO', NULL, '2021-11-08 04:10:54', '2021-11-08 04:10:54'),
(440, 'Ornob Das', 'antord493@gmail.com', '01741505582', NULL, 0, 3, NULL, NULL, '$2y$10$9411TnxR98IIizcd48yGruK3V5715/RJ00ja3Xm3VepIZf8weew0a', NULL, '2021-11-08 04:15:06', '2021-11-08 04:15:06'),
(441, 'Md Usha Bin Alom', 'yoshabin420@gmail.com', '01910029370', NULL, 0, 3, NULL, NULL, '$2y$10$CWfH20jfh9E39D7z3S7eweY4/I7kGyGnDXXLQoRCwp8IFTHaH7LTC', '5vDSDVqsQGwg895TQP9OMXyzsgMLg0IFtSdm5RiKxi6wpjqjdmB6FWUfdir4', '2021-11-08 05:10:38', '2021-11-08 05:10:38'),
(442, 'Kazi Muedul Islam', 'kazimuedulislam@gmail.com', '01402909667', NULL, 0, 3, NULL, NULL, '$2y$10$RQumiVJvjOwuUjlIXk5jI.dcP08OaTZHBLlkHxlHAjN2H1zS/CNb2', NULL, '2021-11-08 05:32:04', '2021-11-08 05:32:04'),
(443, 'Sujana Islam Shatu', 'sujanaislamshatu0330@gmail.com', '01710330824', NULL, 0, 3, NULL, NULL, '$2y$10$qUTJ31AqmGeDBSS7zsoriOaTcy2/uSNxHvQ3P6tqNONNmY2M/0p8G', NULL, '2021-11-08 05:53:31', '2021-11-08 05:53:31'),
(444, 'Fariza Afrin Prapti', 'afrinfariza@gmail.com', '01314500480', NULL, 0, 3, NULL, NULL, '$2y$10$1bb2f21HMqBQ8RMrk0q9reWYJpXwoUSZUef0FBR.gvvLhcX2C4fPq', NULL, '2021-11-08 07:22:38', '2021-11-08 07:22:38'),
(445, 'Riajul', '1199riajulislam@gmil.com', '01302912040', NULL, 0, 3, NULL, NULL, '$2y$10$9InhsEUK7JgZGOstaqPJQuhqY9j5Z2jXWZOBAxB5iUwHDXXjoJPju', NULL, '2021-11-08 07:48:22', '2021-11-08 07:48:22'),
(446, 'Aysha Nizam', 'ayshanizam89@gmail.com', '01712392550', NULL, 0, 3, NULL, NULL, '$2y$10$Wc.toe1jNsASB6HTW7nSH.NXJj1mSEBZx0FEk9plzsC4rTwc.RVdS', NULL, '2021-11-08 07:59:24', '2021-11-08 07:59:24'),
(447, 'Jannatun Naima', 'jnaima561@gmail.com', '01319177115', NULL, 0, 3, NULL, NULL, '$2y$10$LpKJQ5JfdjH.qhWXdD4D..oPKFePWfwYeiNnuEjiLJzkkKN9NXCkW', NULL, '2021-11-08 08:06:00', '2021-11-08 08:06:00'),
(448, 'Mithila Farzana Antora', 'mithilaantora@gmail.com', '01310604713', NULL, 0, 3, NULL, NULL, '$2y$10$PH8sKwztSqILxe5zKudQqu0gV5Bk0454BvSoZ74qv2gB8v16lpP5O', NULL, '2021-11-08 08:29:59', '2021-11-08 08:29:59'),
(449, 'M.Monirul Islam', 'monirul7512@gmail.com', '01735182016', NULL, 0, 3, NULL, NULL, '$2y$10$HDjyGJt6a9L5lczjPNa2YugzYsQDiZDN8Tug9Ynoeq9W5TvGLxPua', NULL, '2021-11-08 08:50:33', '2021-11-08 08:50:33'),
(450, 'Forhad Reza', 'forhadreza1612@gmail.com', '01701570907', NULL, 0, 3, NULL, NULL, '$2y$10$NKsJx8EVGbvs40OB6RZkKOy8h5N/BPSMUgrJG0ipnlHQ3dy6V23TO', NULL, '2021-11-08 09:47:29', '2021-11-08 09:47:29'),
(451, 'Sanjida RHAMAN', 'Shohanurrahamanmohon@gmail.com', '01864431275', NULL, 0, 3, NULL, NULL, '$2y$10$Xmxkov1TGJ5TKhJBG4g4aOIrbFbfL7/dsGLRntYe5P5kzY7kf.I6q', NULL, '2021-11-08 09:49:26', '2021-11-08 09:49:26'),
(452, 'Aysha siddika', 'ashiddika441@gmail.com', '01962368523', NULL, 0, 3, NULL, NULL, '$2y$10$NL8yCeeywMEYNIajF1zEWu2kO2d.iF49p8iwOY5CK1mnqBKJKy/JO', NULL, '2021-11-08 10:21:23', '2021-11-08 10:21:23'),
(453, 'Israt', 'isabasarker@gamil.com', '01871118076', NULL, 0, 3, NULL, NULL, '$2y$10$1lFeU/Nvfh/EYof3kZmePeexukmo1NNM4UetAEPcxoO3vRMeIeFrq', NULL, '2021-11-08 10:37:58', '2021-11-08 10:37:58'),
(454, 'Mahbuba Mojib Surayea', 'mmsurayea272@gmail.com', '01842876971', NULL, 0, 3, NULL, NULL, '$2y$10$.OCJxYJWSu1u/JA8wE86NuPaAlO0zah/J0GdywUqkFG1YoI3Y9YRu', NULL, '2021-11-08 10:48:01', '2021-11-08 10:48:01'),
(455, 'Monika khan', 'abirkhanabir834@gmail.com', '01821996479', NULL, 0, 3, NULL, NULL, '$2y$10$NGqbD91NMkVry/S6ghrG/em.kk/MHjr5tWDLFULV5BS/kFxHpbEke', NULL, '2021-11-08 11:01:21', '2021-11-08 11:01:21'),
(456, 'Amortya Saha', 'amortasaha@gmail.com', '01744406887', NULL, 0, 3, NULL, NULL, '$2y$10$9e7Dhc7f8LYIZ/BYwGbds.wW6T.VUz24QQqC1eaD0Mr3L7bcvd.T6', NULL, '2021-11-08 11:02:44', '2021-11-08 11:02:44'),
(457, 'Abu Bokkor', 'abubokkir.pv@gmail.com', '01301244679', NULL, 0, 3, NULL, NULL, '$2y$10$tqYu.vzVZNHm12qrQMcP6ei0tPh/HLLphA06rkd7hIvZZCmbf93S2', NULL, '2021-11-08 11:25:22', '2021-11-08 11:25:22'),
(458, 'Joy Paul', 'joyp48198@gmail.com', '01784216253', NULL, 0, 3, NULL, NULL, '$2y$10$twjhiF513HF9uVh/OWAXVOQvGTXEaf10sk/XI2Dunqy44ZWD3yU3e', NULL, '2021-11-08 11:43:14', '2021-11-08 11:43:14'),
(459, 'MD Ruhul Amin', 'shipontalukdar4444@gamil.com', '01812750726', NULL, 0, 3, NULL, NULL, '$2y$10$30wjdlnQZAc4AfMX1aZwM.dXfFM04IfZFvb4bmXmtSIlpV4dJKGFy', NULL, '2021-11-08 11:48:46', '2021-11-08 11:48:46'),
(460, 'SONJIB CHANDRA BARMAN', 'sonjibbarmon830@gamil.comarmon', '01710557102', NULL, 0, 3, NULL, NULL, '$2y$10$Sl0jCeLDnyaobPEjLpc9I.CFm5i2otJSBS3mibm2cDYLZ8wqzCUVq', NULL, '2021-11-08 11:49:47', '2021-11-08 11:49:47'),
(461, 'Sowrov', 'mokaddeasowrov@gmail.com', '01797574649', NULL, 0, 3, NULL, NULL, '$2y$10$.yavPniPnNkBgflar3UlGO3AuhvMCMvMAPPIHB7eiH4mtbzXES3FS', NULL, '2021-11-08 11:55:02', '2021-11-08 11:55:02'),
(462, 'Leo Sabbir', 'ns5120582@gmail.com', '01315509529', NULL, 0, 3, NULL, NULL, '$2y$10$9LGKIwgueQkKdNLjBiUSlOgqJWMgRYgCfj3bb4TcpHZc8KlYlC//W', NULL, '2021-11-08 12:16:24', '2021-11-08 12:16:24'),
(463, 'Mst Mohona Haque', 'haquemohona396@gmail.com', '01781370413', NULL, 0, 3, NULL, NULL, '$2y$10$WHelQTwBIUtL0pb2XhHEcekgozEbqvwsxCCqx/dwYU7mI7mSjRQrW', NULL, '2021-11-08 13:48:22', '2021-11-08 13:48:22'),
(464, 'Md Tarek ahmed', 'tarekahmed2916@gmail.com', '01745027558', NULL, 0, 3, NULL, NULL, '$2y$10$nPodqtX8XCDfaaT3xf/BsezOh7nWKwJzsU7WXE/9r/Bkx4em1cOd.', NULL, '2021-11-08 14:07:38', '2021-11-08 14:07:38'),
(465, 'Md Tanvir', 'mdtanvir8882223@gmail.com', '01827924683', NULL, 0, 3, NULL, NULL, '$2y$10$8MvXPgYCnTZgpO4GxezCYupzwp5cLUGcXLk6/ZBMDUfKeqZCKWdgu', NULL, '2021-11-08 14:16:53', '2021-11-08 14:16:53'),
(466, 'Shadiya islam rasin', 'shadiya.rasin01@gmail.com', '01774513553', NULL, 0, 3, NULL, NULL, '$2y$10$AdptsDTnFWazFOPSJ6PvHeDq06hDFoPZshDaO8nxtpux1Iim9JlGG', NULL, '2021-11-08 14:43:30', '2021-11-08 14:43:30'),
(467, 'Juyel Hasan', 'juyelhasan162@email.Com', '01608820167', NULL, 0, 3, NULL, NULL, '$2y$10$d3tSwYpmoEvLguUzrnoyMODpqnA1ZowrIfrgfLsXtfxAmNmA2erMO', NULL, '2021-11-08 14:54:50', '2021-11-08 14:54:50'),
(468, 'Md shakib hossen', 'studentmdshakibhossen@gmail.com', '01811248373', NULL, 0, 3, NULL, NULL, '$2y$10$i0SKR2vpZjzoYLBzaFQz4.TfaqiJqzUTJvUc9BYnvWDojoKonAFPO', NULL, '2021-11-08 15:49:02', '2021-11-08 15:49:02'),
(469, 'Md Khalid Hasan Emon', 'mdkhalidhasanemon2004@gmail.com', '01796513746', NULL, 0, 3, NULL, NULL, '$2y$10$vxVPrAkXbSXddaY52MiUTe9phzwGOjlGLG.pg7sbNWlHeBmz5EkdG', NULL, '2021-11-08 16:23:22', '2021-11-08 16:23:22'),
(470, 'MD Farhadul islam', 'mdfarhadulislam87@gmail.com', '01877972970', NULL, 0, 3, NULL, NULL, '$2y$10$LQtILbswoB1KGyGl1haRI.WT87bO1sZip5jLbWsvYE5POdqQYgg7W', NULL, '2021-11-08 16:33:06', '2021-11-08 16:33:06'),
(471, 'Most shanzida khatun', 'sanjida141894@gmail.com', '01871893279', NULL, 0, 3, NULL, NULL, '$2y$10$ImGr4KeRkPAim4j9SYsQIOQFiImE6h9XOLm7tEDrMcH5bW2gW2ofG', NULL, '2021-11-08 16:56:37', '2021-11-08 16:56:37'),
(472, 'সিনথিয়া আফরিন', 'golpakatha@gmail.com', '01831627963', NULL, 0, 3, NULL, NULL, '$2y$10$KrRuHQGnw0srmtOR20YgK.TqOkOLtUkJEY2P2RS7xUUsRaOV1M/Oa', NULL, '2021-11-08 17:01:35', '2021-11-08 17:01:35'),
(473, 'Farjana tarin', 'farjanatarin24@gmail.com', '01845443181', NULL, 0, 3, NULL, NULL, '$2y$10$qRWFv8.hozL.tb0T6My3NOQRbexW1S6QH0EfW.OzadQFGNRpN1S.K', NULL, '2021-11-08 17:13:15', '2021-11-08 17:13:15'),
(474, 'Md.Abu Kawser.', 'kawserhasib89@gmail.com', '01315267528', NULL, 0, 3, NULL, NULL, '$2y$10$PZWbdxGfsVLuw2c3OTimverzGCROFCUogTtjblK1.u5IrZH/fWIOq', NULL, '2021-11-08 17:39:36', '2021-11-08 17:39:36'),
(475, 'Mamun Bahadur', 'mamunbahadur111@gmail.com', '01650289109', NULL, 0, 3, NULL, NULL, '$2y$10$d2UA8eonvKzvhWggGFAjUOQSnnihzXxwEJkc94rzrBRRXQqHT8mSK', NULL, '2021-11-08 18:25:01', '2021-11-08 18:25:01'),
(476, 'itz_arxansary', 'ansaryempire2005@icloud.com', '01792610929', NULL, 0, 3, NULL, NULL, '$2y$10$kF63kvViOU2aA.Z/C0VbTeF89CdUhbJWdRgeysL6Gstf83CZPQv7m', NULL, '2021-11-08 18:25:40', '2021-11-08 18:25:40'),
(477, 'Maria Mostafiz', 'mariamostafiz2004@gmail.com', '01537227578', NULL, 0, 3, NULL, NULL, '$2y$10$nTqKmMqPW4Kybn4rGZEyrOS8o990JHKzPWgw37vHewXAQChm6PvV.', NULL, '2021-11-08 18:50:36', '2021-11-08 18:50:36'),
(478, 'Sadeya Akter', 'Sadeyaakter60@gmail.com', '01743072498', NULL, 0, 3, NULL, NULL, '$2y$10$3EzcRU9hnNOLQMlabKa7XedwC/zob/Lw0tGzstalumbb1LgetBKYu', NULL, '2021-11-08 19:45:09', '2021-11-08 19:45:09'),
(479, 'Aongon Saha', 'aongonsaha143@gmail.com', '01303550623', NULL, 0, 3, NULL, NULL, '$2y$10$QB3UXWQAeBGIp/IlQtX2Wum2VAXAAakgaigqN7550j0tCDU.hm9Fe', NULL, '2021-11-08 19:52:29', '2021-11-08 19:52:29'),
(480, 'Hasin Abrar', 'hasin.abrar2004@gmail.com', '01922126295', NULL, 0, 3, NULL, NULL, '$2y$10$iVx2XnWIe2gBvnhErJL82uuKAPSwPi4gz9ZwGs6kRhIvB3CCrbxti', NULL, '2021-11-08 20:22:34', '2021-11-08 20:22:34'),
(481, 'Mushfika Jannat Nourin', 'smalamgir7474@gmail.com', '01851233607', NULL, 0, 3, NULL, NULL, '$2y$10$TiAFtGqkvIpfe/T4DLv8Tux9wJ0.BP50J4MAu1TXEtywebgk8uEza', NULL, '2021-11-08 20:41:29', '2021-11-08 20:41:29'),
(482, 'Sadia Sultana', 'sultanasadia2005@gmail.com', '01781219959', NULL, 0, 3, NULL, NULL, '$2y$10$A.yjSOqD32D1DyXfv8NZs.ytwFIqY5iMK3KNJaxF2Y4kdfYpKod86', NULL, '2021-11-08 20:44:45', '2021-11-08 20:44:45'),
(483, 'Ahmed Kamran', 'kamran558012@gmail.com', '01309335038', NULL, 0, 3, NULL, NULL, '$2y$10$LNYPHfxftZzP4/sUe17XhOaRZK1KnAVxFUWI0tSz9Ogke.kxMefoi', NULL, '2021-11-08 20:58:47', '2021-11-08 20:58:47'),
(484, 'Mostafiz Rahman', 'mostafizrahman3114@gmail.com', '01761664308', NULL, 0, 3, NULL, NULL, '$2y$10$ONp/Cj3ihTHYr1J8Bbs22Ojt9qwD/174SnpFXvDnxoHSe4sp8iyTC', NULL, '2021-11-09 01:20:54', '2021-11-09 01:20:54'),
(485, 'UMME SALIMA SIDDIKA', 'ummesalimashikha@gmail.com', '01705942801', NULL, 0, 3, NULL, NULL, '$2y$10$I72HCVuX0CYJbTL3HGtwHuqE7imtz8qntoSyCXf44qdDFGKojxKpS', NULL, '2021-11-09 03:31:40', '2021-11-09 03:31:40'),
(486, 'Tisha', 'tasninatisha@gmail.com', '01872764775', NULL, 0, 3, NULL, NULL, '$2y$10$AS3R4JUWsNJby1D7taLEKuiXK/7OsYslcfM/8SAJaHfj08D4EKfsW', NULL, '2021-11-09 03:51:49', '2021-11-09 03:51:49'),
(487, 'Ahosan Habib', 'mdahosan193653@gamil.com', '01701516640', NULL, 0, 3, NULL, NULL, '$2y$10$44/kMyPoMsPTw9ezidyB6.2XD0J0hBMuNq5nfKzN67w8y1V5Of8Ya', NULL, '2021-11-09 04:39:07', '2021-11-09 04:39:07'),
(488, 'Oishi Basak', 'basakoishi7@gmail.com', '01997558320', NULL, 0, 3, NULL, NULL, '$2y$10$hLTjewaJbI359DikXlA3pe0kWDrCUhd2khe20OAnQOATaQr0mFkji', 'Eo3EamsAEPiC3F68fURZPsGniaFTdl1sXkCOb4KRRPMgrF8S3H1B6i3py88q', '2021-11-09 05:24:42', '2021-11-09 05:24:42');
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `is_admin`, `user_type`, `provider_id`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(489, 'Rafi Rafiul hasan', 'bdmail.rafi@gmail.com', '01704348413', NULL, 0, 3, NULL, NULL, '$2y$10$NwDGB3/WRJYZaP90uUaU3eKt8BR51aaLZCteiegswCO40hLvoxxd.', NULL, '2021-11-09 05:37:11', '2021-11-09 05:37:11'),
(490, 'Fahim', 'themighty2002@gmail.com', '01646870487', NULL, 0, 3, NULL, NULL, '$2y$10$4upPeyhgIHfh1aethwgeIOjuHhEyvrvsxM71aQAy79iQmMSbFuOXC', '96Phw7Itw14axuhvbnt8g7dUHBT3G3Id1DN7prDVOnrVoJEOe9XcU4Hrfopd', '2021-11-09 05:52:47', '2021-11-09 05:52:47'),
(491, 'Tahjib Hossain Khan', 'tahjibkhan31@gmail.com', '01683740130', NULL, 0, 3, NULL, NULL, '$2y$10$ujSbaM2aEFvineRwOW.a1ug60cNrXxj80DsBNiz4Ly9vp47YcoU/m', NULL, '2021-11-09 06:06:26', '2021-11-09 06:06:26'),
(492, 'Ripon Roy', 'ripon1020@gmail.com', '01319161980', NULL, 0, 3, NULL, NULL, '$2y$10$JCoCCRdzGpUGnaiatHt.4eabWH6i4a77210jUNbjd5lqduiqdHV4.', NULL, '2021-11-09 06:13:46', '2021-11-09 06:13:46'),
(493, 'Eva Ahmed', 'evaa44631@gmail.com', '01818537268', NULL, 0, 3, NULL, NULL, '$2y$10$Kpp1wC6oHZysghx8GcHFW.2vG9dNSnk5doYhRA5RGsy71BVdmkHzK', NULL, '2021-11-09 06:22:32', '2021-11-09 06:22:32'),
(494, 'Karimun nahar kolpona', 'shadinahammed63@gmail.com', '01902356174', NULL, 0, 3, NULL, NULL, '$2y$10$1Oj2aUrWa3xvHccC06.WZentCAtjH6cgL9fb8bmnYk2U3WlLgYthm', NULL, '2021-11-09 07:01:23', '2021-11-09 07:01:23'),
(495, 'Shamima0109', 'Shamimaakter0912@gmail.com', '01704847889', NULL, 0, 3, NULL, NULL, '$2y$10$7f6mK0DfhdB/GF.S6C.s3ub7NdT4mrnpy7nt9lDUMWiICISyRe/72', NULL, '2021-11-09 08:12:46', '2021-11-09 08:12:46'),
(496, 'Sayeed Al sahaf mahi', 'Sahaf0001@gmail.com', '01675019981', NULL, 0, 3, NULL, NULL, '$2y$10$Bs1BAZS21cYdaJnxd9DXTOwrTyx8vmXLe8nNVlm8X93/WgxZlZYQi', NULL, '2021-11-09 08:50:21', '2021-11-09 08:50:21'),
(497, 'Bishal.mondal', 'mondalbishal947@gmail.com', '01920398818', NULL, 0, 3, NULL, NULL, '$2y$10$YqTRgXWvkU5E4gbldE7Y1em/CzDRnEjZ49E/ZN6S5gLQaeLwS4cRe', NULL, '2021-11-09 09:04:41', '2021-11-09 09:04:41'),
(498, 'Abdullah Al Abir', 'abirabdullahal10@gmail.com', '01931212471', NULL, 0, 3, NULL, NULL, '$2y$10$woeLk0IHjdwA4.Ld6M3RPO.kNO0yNpl4NaOdudjXznsd0s4F8YJj6', 'gA2NnoVigdFNiDzLvhlghQoyiYJAoXzE5C4KO2sAywNRaoXa2gm1SNkHFQri', '2021-11-09 09:06:51', '2021-11-09 09:06:51'),
(499, 'Ahona Rahman Moon', 'ahonamollik20202@gmail.com', '01644861922', NULL, 0, 3, NULL, NULL, '$2y$10$IciesFEh5h5xUNbPNL/lcO13xFZsIPQnVKEoqXbVfAtDAVxHqwyqu', NULL, '2021-11-09 10:08:06', '2021-11-09 10:08:06'),
(500, 'Shraboni Bhowmik', 'Shraboni.debnath1212@gmail.com', '01932795857', NULL, 0, 3, NULL, NULL, '$2y$10$UUktnkhTjXdDj9CqXydHZ.7zHFPLTCQfEFlb16ILz4chNkczhlrhW', NULL, '2021-11-09 11:53:39', '2021-11-09 11:53:39'),
(501, 'Hasibul hossen Shanto', 'hasibulhossenshanto31@gmail.com', '01755787177', NULL, 0, 3, NULL, NULL, '$2y$10$M41E8ZVzlTddlejvsYYaHe4HPdjyaF7gvA/C1wPk/J3GdmeMxttlm', NULL, '2021-11-09 11:55:27', '2021-11-09 11:55:27'),
(502, 'Md Mehedi Hasan', 'hm924586@gmail.com', '01305080135', NULL, 0, 3, NULL, NULL, '$2y$10$kWv6R/luwcugbtFO7hW2d.oBnPhusBv/b/jI4ApqIxxd1edHQdxgi', 'XcDdmq63GqTmfPyEN6jbIZzy1pcCIGR1R2VnAVwCLpE9Y2cnXKfjFSEVMxmx', '2021-11-09 12:29:50', '2021-11-09 12:29:50'),
(503, 'Zishan Ahmed', 'zishanahmed3657@gmail.com', '01601443737', NULL, 0, 3, NULL, NULL, '$2y$10$89m/d7pdv4JKPCZoLFYSnuuOi56ol0CK4BblU3pToZQYpQG1xDvQW', NULL, '2021-11-09 12:46:12', '2021-11-09 12:46:12'),
(504, 'Jinia afrin', 'sumyaurmi2@gmail.com', '01404620384', NULL, 0, 3, NULL, NULL, '$2y$10$z8kHqaSaYnniDQNjxQTj3eitUvrXjkKfYVePnWbTY.LJSq9Abq3UC', NULL, '2021-11-09 13:14:33', '2021-11-09 13:14:33'),
(505, 'Urmy', 'urmi88447@gmail.com', '01778076325', NULL, 0, 3, NULL, NULL, '$2y$10$hsclM5BplJzsQ4IkbJBrHe3udT3xXZctDA8G6b8t8F3dpEKVqOB4W', NULL, '2021-11-09 13:27:46', '2021-11-09 13:27:46'),
(506, 'Abrar zahin', 'abzahin7@gmail.com', '01764848779', NULL, 0, 3, NULL, NULL, '$2y$10$zxy1YKmjHSEytiGx.VaQ3.VN6pXlPtDdYUOcrJ.UYrMoo3kNTLMh6', NULL, '2021-11-09 14:57:22', '2021-11-09 14:57:22'),
(507, 'Tahmina Akter Moni', 'tmoni5088@gmail.com', '01750737506', NULL, 0, 3, NULL, NULL, '$2y$10$W31Ergdw.DZvb.LTLHsIYuXaSSLFzVMU.uDo/3sxgkOUYm4SFWrIO', NULL, '2021-11-09 15:06:51', '2021-11-09 15:06:51'),
(508, 'Tasin ali', 'manmango905@gmail.com', '01608968563', NULL, 0, 3, NULL, NULL, '$2y$10$0fLokxLoP7BY4J5q8ulNR.QJDH18bXjS7BX7VGOfvBb1aClzNgODK', NULL, '2021-11-09 15:24:42', '2021-11-09 15:24:42'),
(509, 'Mujahidul islam', 'freelancermujahid71@gmail.com', '01822947613', NULL, 0, 3, NULL, NULL, '$2y$10$dRm76evlteqJWRncimqTUOW4cE70E7b0MSMlD7FKBkA4xpQfZ5gWy', NULL, '2021-11-09 16:21:55', '2021-11-09 16:21:55'),
(510, 'Moyeen', 'moyeenalamj@gmail.com', '01797856418', NULL, 0, 3, NULL, NULL, '$2y$10$8bHaDcasMxVdTaFHlVxaxegBIX1cef2/8oiWx0to2UYvzblYlulm2', NULL, '2021-11-09 17:49:30', '2021-11-09 17:49:30'),
(511, 'Mst. Nahida Akter', 'mstnahida2000@gmail.com', '01309245040', NULL, 0, 3, NULL, NULL, '$2y$10$FVVZFiSHrCzdbdHUcHtlLOZofb7v0Y2PfmPA8r4KKQW8/k5DMV2ZS', NULL, '2021-11-09 17:52:16', '2021-11-09 17:52:16'),
(512, 'Rukaiya Hasanat Rima', 'rukaiyarima417@gmail.com', '01761419417', NULL, 0, 3, NULL, NULL, '$2y$10$hGhLVTuGi5dJjO87Za/CWOnE3M7z40IQFI9KWHo8tbWUOUqtPTqui', NULL, '2021-11-09 18:42:34', '2021-11-09 18:42:34'),
(513, 'Sadia akter', 'sadiaaktersimu279@gmail.com', '01312949465', NULL, 0, 3, NULL, NULL, '$2y$10$TdN7rB.GkIvUN27P4BwUYO2hosIU7NiwjOXxW5mhk19EOMvmlxoz.', NULL, '2021-11-09 21:33:20', '2021-11-09 21:33:20'),
(514, 'Md Ashikuzzaman', 'ashikbiplob38@gmail.com', '01730514751', NULL, 0, 3, NULL, NULL, '$2y$10$v8OCVUo5IJHycKkkUdXQduIKiCnrzuPj564jBDftQ.QEYvktorzRm', NULL, '2021-11-10 03:38:26', '2021-11-10 03:38:26'),
(515, 'Prodip Chandra Barman', 'educationprodip06@gmail.com', '01786881595', NULL, 0, 3, NULL, NULL, '$2y$10$yECvqUtFFV/IieXsuVjf0OAfV1V3o2b9SwD4Nxpej3YyD.TRnH6Oq', NULL, '2021-11-10 05:25:59', '2021-11-10 05:25:59'),
(516, 'Sabrina Sultana', 'sabrina2003sultana@gmail.com', '01626950941', NULL, 0, 3, NULL, NULL, '$2y$10$LQZcCc7AH.5dg3fgyJCePuiF4kHedBSh4eCUxCCyI6frP8I.185X6', NULL, '2021-11-10 05:40:43', '2021-11-10 05:40:43'),
(517, 'mst. marufa akter', 'mstmarufaa43@gmail.com', '01305386438', NULL, 0, 3, NULL, NULL, '$2y$10$KPeUhf9EXatDsqp4vf24AO33sGZtAmsXP1uGFTxxgQbtC7ew4iAc2', NULL, '2021-11-10 08:00:31', '2021-11-10 08:00:31'),
(518, 'Tahaniatun Nuha', 'tahaniatun2020@gmail.com', '01810433205', NULL, 0, 3, NULL, NULL, '$2y$10$YewzXnzomATqQuqGBmk9Ru/My9m3FVCNNfcqPNhC7imNKSL6Qa6di', NULL, '2021-11-10 08:04:20', '2021-11-10 08:04:20'),
(519, 'Md. Kayes Uddin', 'p0575788@gmail.com', '01312192165', NULL, 0, 3, NULL, NULL, '$2y$10$ii0nclfkk4l2QwmKGlDBiO1YUmcFDgjmxqKNWUEiv/pKWef6u7rYu', NULL, '2021-11-10 09:15:54', '2021-11-10 09:15:54'),
(520, 'Farhana Ferdous', 'muna.sopno@gmail.com', '01823848694', NULL, 0, 3, NULL, NULL, '$2y$10$2i2KxHLLwwAA9QNaZE8uOuyU6h5nf3AaTNZ0SOZwmcE7N06mrZVka', NULL, '2021-11-10 09:53:24', '2021-11-10 09:53:24'),
(521, 'Zahid Sikder', 'fahim.arafat@gmail.com', '01600280330', NULL, 0, 3, NULL, NULL, '$2y$10$9oKmaumxV04jlSI81H3Rm.s6oV8viQubogSYnb9Sibo/R.xsgg0Lq', NULL, '2021-11-10 10:45:42', '2021-11-10 10:45:42'),
(522, 'Ayshee sarkar', 'nikhilsarkariris50@gmail.com', '01608164393', NULL, 0, 3, NULL, NULL, '$2y$10$yb8cKhAkSKmDRH4V9HpYLO4TZ32Wo7mGDMYbU2BJBw/9cdYux7Wiq', NULL, '2021-11-10 12:43:17', '2021-11-10 12:43:17'),
(523, 'admin4@app.com', 'admin4@app.com', '01580660680', NULL, 1, 1, NULL, NULL, '$2y$10$JH1.EE0mB..Wtz/.iJfgpurlXrJV8e8XcadR.uQQ8KpzGFh6WwJbK', NULL, '2021-11-10 13:06:54', '2021-11-10 13:09:02'),
(524, 'rasel ', 'admin5@app.com', '01647727702', NULL, 1, 1, NULL, NULL, '$2y$10$QiqNHDoJT7wxU5FBqU36.Oc9uVzeBXf9U70yn2JaES8ZBDHhAvo5a', 'vn8DMH23cuXPvVWz8zoYmCNnI8Ov61pnuiiJJi5ikkVz3xhjzVaR08jcay8D', '2021-11-10 13:13:36', '2021-11-10 13:13:36'),
(525, 'Mursheduzzaman Mithel', 'mursheduzzamanmithel262@gmail.com', '01312033456', NULL, 0, 3, NULL, NULL, '$2y$10$OE2CsfGBM.t1VsPcceOsh.C0Y2XxIspZswbDoWKKOHLW1bMPUKcVq', NULL, '2021-11-10 14:36:20', '2021-11-10 14:36:20'),
(526, 'Meher Neeger Borsa', 'meher.borsa158@gmail.com', '01795751812', NULL, 0, 3, NULL, NULL, '$2y$10$iWox3hZDrk73nNc1D1XvHOCWAHUFXImGxg3Ifiy6ohHM.TSxKfOtG', NULL, '2021-11-10 15:09:42', '2021-11-10 15:09:42'),
(527, 'Shamima Akter', 'shamima.akter2@gmail.com', '01712820191', NULL, 0, 3, NULL, NULL, '$2y$10$DcYpBhb09j4uJFLBivOL2Otnb37Vzbph3HWiiSlfaX/I5AqWZpV6S', NULL, '2021-11-10 17:49:09', '2021-11-10 17:49:09'),
(528, 'Tahidul Islam Tusar', 'msik21122000@gmail.com', '01856720134', NULL, 0, 3, NULL, NULL, '$2y$10$hCSOmhBLm0TCEWgMiJcWgOvcwDotHgj/3FvN.aYp4A6g40IrIrOqa', NULL, '2021-11-10 19:03:53', '2021-11-10 19:03:53'),
(529, 'Kazi Fahim', 'faridulkaji98@gmail.com', '01877577006', NULL, 0, 3, NULL, NULL, '$2y$10$KhCHhoNG05zUuShf74aSuejz9KAWXdVku9q6Ngz.OOB3yVF/U7Wle', NULL, '2021-11-10 19:44:23', '2021-11-10 19:44:23'),
(530, 'Arpita Kundu', 'arpitakindu.1@gmail.com', '01705907180', NULL, 0, 3, NULL, NULL, '$2y$10$vC0kmBZdpQFeIxrGgcJyVuMfDTS6pfQfQ2LgE8iK8KTK0v2giOrly', NULL, '2021-11-10 21:10:47', '2021-11-10 21:10:47'),
(531, 'Irham  Al Hasan', 'Irhamrafi2005@gmail.com', '01609999815', NULL, 0, 3, NULL, NULL, '$2y$10$1iuWTCbQIEDyPTpesbmf5OCEG1KM1dghrzXZiKpDvhzuOTJA2rKNa', NULL, '2021-11-11 01:06:29', '2021-11-11 01:06:29'),
(532, 'Mohammad Rahat Abdullah', 'mohammadrahatabdullah13@gmail.com', '01725555801', NULL, 0, 3, NULL, NULL, '$2y$10$viQvfoLhg2ep0F/YHjw5Xe61.rpzZDLLLCyxuCtK2fMB1tbX8Lysu', NULL, '2021-11-11 03:22:15', '2021-11-11 03:22:15'),
(533, 'Zannatara Sultana', 'jannnati90@gmail.com', '01748607200', NULL, 0, 3, NULL, NULL, '$2y$10$gRpa9iUcGBH3IF9JFW/CZu0ukrdCZEGFgUL1MOz0bosbPAu.rT7Vu', NULL, '2021-11-11 05:59:17', '2021-11-11 05:59:17'),
(534, 'HRiDoY sHaRma', 'hridoysharma08@gmail.com', '01868421452', NULL, 0, 3, NULL, NULL, '$2y$10$uf/Lkzp2/p.3Hk4DrTEKjeDQ8hW3d8pKwTtNv11x3xitgSzeUyXLu', NULL, '2021-11-11 06:05:37', '2021-11-11 06:05:37'),
(535, 'onik@app.com', 'soundblastcoc@gmail.com', '01676279255', NULL, 1, 1, NULL, NULL, '$2y$10$xwd0BPCfcdFdvLAfuhRsE.TLZ8O5Ad1Ibdl6fJSE/aDVMLaHpCC5C', NULL, '2021-11-11 06:18:39', '2021-11-11 06:18:39'),
(536, 'Farzana Akter', 'herbalresearchinstitute5@gmail.com', '01533526119', NULL, 0, 3, NULL, NULL, '$2y$10$fD9Z44JrfO3q/nfTmtekKOJrWYkxt5kP5nq0SSVVLs5KwZ1iY3ybm', NULL, '2021-11-11 06:50:20', '2021-11-11 06:50:20'),
(537, 'rony', 'admin7@app.com', '01533081181', NULL, 1, 1, NULL, NULL, '$2y$10$Y4un3hWuhtzHusPFJTl/zesFWAy7OsoyixFpcjqvq3TQ2RDhP/KIS', NULL, '2021-11-11 07:17:17', '2021-11-11 07:17:17'),
(538, 'hamja', 'admin8@app.com', '01838644445', NULL, 1, 1, NULL, NULL, '$2y$10$erKhEhr9Ld/MYplOu4enpOTuUEDBDU/jSmK5eb/8bMbar6NcM2pI2', NULL, '2021-11-11 07:19:35', '2021-11-11 07:19:35'),
(539, 'Ahamed Ashik', 'ashikahamed71bd@gmail.com', '01300512078', NULL, 0, 3, NULL, NULL, '$2y$10$RROjHzh5VnWwA7Zb/oDq8.0UpJfH2Zjt.ar1m4FJuofCqNqKcafTq', NULL, '2021-11-11 08:45:01', '2021-11-11 08:45:01'),
(540, 'Tanu Dey', 'tanudey4002@gmail.com', '01745553220', NULL, 0, 3, NULL, NULL, '$2y$10$JqyMZDlsjaZ40OVtZcB2P.3IEzoo.GneaorHG3ViTFzn5FAgzosdi', NULL, '2021-11-11 09:26:15', '2021-11-11 09:26:15'),
(541, 'Abidur Rhaman Mashfi', 'mashfiabidur2003@gmail.com', '01864595476', NULL, 0, 3, NULL, NULL, '$2y$10$EoJrm/l7PujqkQaa1.11J.O2PHf8s.5UifxY8Dqdn.TjI9x0Yh476', NULL, '2021-11-11 09:45:32', '2021-11-11 09:45:32'),
(542, 'admin6', 'admin6@app.com', '01915564585', NULL, 1, 1, NULL, NULL, '$2y$10$ditjLOylQh9EdfgccKUlZusCJudI1fy/OW.8MI4o7NcEasfUK7uVa', NULL, '2021-11-11 10:17:21', '2021-11-11 10:17:21'),
(543, 'Shafayet Ahmed Nobel', 'shafayetahmedn@gmail.com', '01688576510', NULL, 0, 3, NULL, NULL, '$2y$10$cLgdwRyjeGwu0QxVI49GT.sX22453ETUOg70sauZAYlH1.9SNQgAC', NULL, '2021-11-11 11:06:18', '2021-11-11 11:06:18'),
(544, 'Sumaiya Mishu', 'admin@admin.com', '01797992547', NULL, 0, 3, NULL, NULL, '$2y$10$gUwK1DyG7lrJnAQN4Ise.OPpjJ5smGTLB7x1.gfvGQAYlchnjtLpu', NULL, '2021-11-11 12:07:28', '2021-11-11 12:07:28'),
(545, 'jobayer al zadid', 'www.mohammedjobayeralzadid@gmail.com', '01756771607', NULL, 0, 3, NULL, NULL, '$2y$10$e/x9byqesNTCZUfNk3EzcOUySindsYq5Oob8vEW8ddJtEOvzVxKAC', NULL, '2021-11-11 12:08:50', '2021-11-11 12:08:50'),
(546, 'Ruqaiya Rahman Mastura', 'lordistics99@gmail.com', '01320634709', NULL, 0, 3, NULL, NULL, '$2y$10$h2J1OlwGpbJNsoQoHZPwlOhfnqOJDMeG/G2DhKpbMmcu3/zufpNnC', NULL, '2021-11-11 15:33:17', '2021-11-11 15:33:17'),
(547, 'Eliyas Mahmud Mahin', 'eliyasmahmud873@gmail.com', '01773487825', NULL, 0, 3, NULL, NULL, '$2y$10$VRgcuGwHyEf9.quoXPz/G.qSUZRpDpeHXLRqYwigDL/sKtHKNqbk.', 'p2ds6Z9qOK2ctVjmNlqC3N8Tx3RcRvxx95z59djcB1YJjCAaEnTQ8Z2eoWo1', '2021-11-11 17:37:06', '2021-11-11 17:37:06'),
(548, 'Mustakim Ur Rahman', 'mustakimurrahman2004@gmail.com', '01759472447', NULL, 0, 3, NULL, NULL, '$2y$10$ic9WM1GaDguLCNKrkYJh4.lvg6F/Y90DQcYQvVHpO6mjL79yykx6G', NULL, '2021-11-11 17:43:56', '2021-11-11 17:43:56'),
(549, 'Abu Fazle Rabbi Zihad', 'www.notilas05@gmail.com', '01779980043', NULL, 0, 3, NULL, NULL, '$2y$10$/xE56snTKsnB9mdCBmopsu457hi8DmBQ7YWwUrVEmZOsHJ1NVo89.', NULL, '2021-11-11 17:45:59', '2021-11-11 17:45:59'),
(550, 'Minhaz Muntasir Mahin', 'muhammadshanto317@gmail.com', '01756205368', NULL, 0, 3, NULL, NULL, '$2y$10$LAfPEEGMRjH60az3Su8w3uHLPsxllfMZr6Lg8ssjvjy7TFmGLf7jS', NULL, '2021-11-11 18:04:30', '2021-11-11 18:04:30'),
(551, 'Istiyaq Ahmed', 'istiyaqahmednirab@gmail.com', '01703258154', NULL, 0, 3, NULL, NULL, '$2y$10$XeaBtYbeZqT.dVT9AJGS7.XGqJ3fWcRkpy/k5d38TUceEUJ066rGe', NULL, '2021-11-11 19:35:53', '2021-11-11 19:35:53'),
(552, 'Md. Arif', 'arifmahamud239@gmail.com', '01302780787', NULL, 0, 3, NULL, NULL, '$2y$10$p5tjmLMsVtbS.0HrVY2WF.PRXIJ5FN35SBYDTnrkUtaLpjGT.rTmq', NULL, '2021-11-11 19:43:18', '2021-11-11 19:43:18'),
(553, 'Sanjida Tasnim', 'tasnimsanjida142@gmail.com', '01985067177', NULL, 0, 3, NULL, NULL, '$2y$10$200JI030Nv/X1WlC3Kh70OPYwHrIK2XyrVBslTRr5NItSfqOcpNVW', NULL, '2021-11-11 21:27:55', '2021-11-11 21:27:55'),
(554, 'Sakib Hossain', 'hossainsakib926@gmail.com', '01786007557', NULL, 0, 3, NULL, NULL, '$2y$10$wqs4.18CMgBd/8AntkerkOBmNti4b4//hNFBgXLFCI8SzADPt/rZe', 'G7zLvZZm2H66o9GS5RhosJLBf5zWAHZ9Pinz724yfwwrdb2DBfDgTk51beAZ', '2021-11-12 02:18:34', '2021-11-12 02:18:34'),
(555, 'Md Fahim   Hassan', 'msfareha832@gamil.com', '01400339482', NULL, 0, 3, NULL, NULL, '$2y$10$.DXwFPSa37ixRup9QHkabOWsV.qrwLwYS5XUIK2EGBCeYE3mv/YEK', NULL, '2021-11-12 02:52:09', '2021-11-12 02:52:09'),
(556, 'Sharmin Akter', 'sharminakter@gmail.com', '01618993594', NULL, 0, 3, NULL, NULL, '$2y$10$WnBhxcC5SPDUZxDCyFa6eu3BB29T/juLhpHr.tSxNcrhWJgXJdIVq', NULL, '2021-11-12 02:55:14', '2021-11-12 02:55:14'),
(557, 'Md.Iqbal hossain', 'mdiqbalh095@gmail.com', '01865944193', NULL, 0, 3, NULL, NULL, '$2y$10$7PN4MHZve4Ze/CuqSdvTPe0mPp2jZZJ6PiNiR2Q4gxgGxMTBzmuka', NULL, '2021-11-12 04:04:12', '2021-11-12 04:04:12'),
(558, 'Rushdia afrin Zahan', 'rushdiahridita@gamil.com', '01911278036', NULL, 0, 3, NULL, NULL, '$2y$10$S188UxOMgokmTu/J7NC96OR5Q/gnt8TxQ.VrwWevbIQTvYezAbdZO', NULL, '2021-11-12 04:16:05', '2021-11-12 04:16:05'),
(559, 'Talha', 'talhaabul2580@gmail.com', '01799928860', NULL, 0, 3, NULL, NULL, '$2y$10$cl4XzHEKkx0HYWytYfgBMeJ7RAn8oxrc7CbETM5S8H2BdFaoAY6Qy', NULL, '2021-11-12 04:46:48', '2021-11-12 04:46:48'),
(560, 'MD Rana Ahammed', 'mdranaahammed557@gmail.com', '01764069557', NULL, 0, 3, NULL, NULL, '$2y$10$oL8eYKsVIET1mZSrJYyMNerMjPnhI5GkBH8NRhXGxHh2P/0v0AKcS', NULL, '2021-11-12 04:58:12', '2021-11-12 04:58:12'),
(561, 'ahamed_tanvir47', 'ahamedtanvir346@gmail.com', '01767850899', NULL, 0, 3, NULL, NULL, '$2y$10$2UR8NkE86EGhAOsJRjaUxe/CAG7XY33Ony9bx4hPVV1y.X9U2cv7i', NULL, '2021-11-12 06:44:27', '2021-11-12 06:44:27'),
(562, 'Md.Mominul Islam', 'islamayan123456@gmail.com', '01611655192', NULL, 0, 3, NULL, NULL, '$2y$10$.qS5FlYAKUKSHNCoBFH5Ne0FIMpXGjx2IH2WdkYlU/AxxSI0qz7wm', NULL, '2021-11-12 06:46:32', '2021-11-12 06:46:32'),
(563, 'zafar Ahmed', 'zafarahmad233020@gmail.com', '01823340916', NULL, 0, 3, NULL, NULL, '$2y$10$tH8u0qki.sQH0ELAGAru.e2DG5HiGaKzx0XlaHc0iPQGn68bz6VBm', NULL, '2021-11-12 07:49:53', '2021-11-12 07:49:53'),
(564, 'sadia tabassum', 'sadiatabassumchadni2003@gmail.com', '01725412840', NULL, 0, 3, NULL, NULL, '$2y$10$6c4Scl9OlpoiHkpPSNMTROTqUq4/yTevWgAL7.qv4qJor1mqRemym', NULL, '2021-11-12 09:20:44', '2021-11-12 09:20:44'),
(565, 'আবু বকর সিদ্দিক', 'mdabubokkorsiddikm1@gmail.com', '01571293749', NULL, 0, 3, NULL, NULL, '$2y$10$97u71rGbFwHoE4hSmianIeQzdsHjVrk2GEFDw7kqVuBGkpbIZFFie', NULL, '2021-11-12 10:11:34', '2021-11-12 10:11:34'),
(566, 'Md Hossain Mahmud Shifat', 'baborsaifuddin@gmail.com', '01951987157', NULL, 0, 3, NULL, NULL, '$2y$10$d8JLwzoiHBhPKyet8BOaUOjG/Y8Vl0yRIZU2AzgA9vubHlMOSS3IW', NULL, '2021-11-12 11:11:35', '2021-11-12 11:11:35'),
(567, 'Sajjad', 'sajjadulhossain2066@gmail.com', '01712241602', NULL, 0, 3, NULL, NULL, '$2y$10$PylfN.of0FqarBhz1LJ5C.cQzzDK/kU25FFIlD8o.Kgdh.8g0SF96', NULL, '2021-11-12 11:47:47', '2021-11-12 11:47:47'),
(568, 'Nusrat jahan', 'nusu1435@gmail.com', '01300354338', NULL, 0, 3, NULL, NULL, '$2y$10$iYxZ99r97cRm/YArrmyQhuk8Hn3wld7lZF5.Khvvr6lB6CSbDJUuS', NULL, '2021-11-12 11:55:31', '2021-11-12 11:55:31'),
(569, 'Mohammad Saiful Alam', 'dushipon129@gmail.com', '01717960402', NULL, 0, 3, NULL, NULL, '$2y$10$cOZetOATNk7BXilmn18pLOhcwkgCz6jl3a2ZgSuB6piUXKFsGq51K', NULL, '2021-11-12 12:30:47', '2021-11-12 12:30:47'),
(570, 'Md Forhad Reza', 'mdforhadr22@gmail.com', '01925527981', NULL, 0, 3, NULL, NULL, '$2y$10$phZwKTplAyx.qgOA6PnrTeeNtRW4hqcdwdTE6MF89Z..8v4BM61FW', NULL, '2021-11-12 13:39:02', '2021-11-12 13:39:02'),
(571, 'Samanta islam prapti', 'islamsamantha77@gmail.com', '01315910358', NULL, 0, 3, NULL, NULL, '$2y$10$4ak6aXVgK9yRvlC3Lae83.EEUXO/Qb56k67cqj.d/GE56kohlY3yu', NULL, '2021-11-12 16:12:32', '2021-11-12 16:12:32'),
(572, 'Ashik Mahmud Akash', 'mahmudakashashik@gmail.com', '01304381899', NULL, 0, 3, NULL, NULL, '$2y$10$2ERgq2i5XPFE9Hlk6GfRBO0LB3Cn95NjLTGn9mN471cgfEYhoA6Bm', NULL, '2021-11-12 16:46:06', '2021-11-12 16:46:06'),
(573, 'shahriya shuvo', 'shahriyashuvo86@gmail.com', '01786240184', NULL, 0, 3, NULL, NULL, '$2y$10$CFQxcSuY58fwxJQ713o.G.RA2hxvl38tjPADbfsPUmX.UI4enAnVe', NULL, '2021-11-12 18:52:03', '2021-11-12 18:52:03'),
(574, 'HAMER KANTI TRIPURA', 'homertripura@gmail.com', '01572554649', NULL, 0, 3, NULL, NULL, '$2y$10$m7YP..fSMwWmFi9mczE0E.xZYvmn8RjkSTK7DcY74r9WTz0ZWBN7O', NULL, '2021-11-13 01:38:51', '2021-11-13 01:38:51'),
(575, 'Rabiul Islam', 'rabiulislam01112003@gmail.com', '01537704474', NULL, 0, 3, NULL, NULL, '$2y$10$eROPR5vx9ssHhwqJKOL3Eu5t8E6/DheGNOfNP79SO6NR.Rsdv9cwG', NULL, '2021-11-13 01:51:50', '2021-11-13 01:51:50'),
(576, 'Akash Islam', 'akashaliakash728@gmail.com', '01875809215', NULL, 0, 3, NULL, NULL, '$2y$10$tTf3VL/4STfmN.hBwweVbeG8oknh/X5Pcs3dy.QATREMIlDO4sLiK', NULL, '2021-11-13 03:48:06', '2021-11-13 03:48:06'),
(577, 'Shahriar Rifat', 'mightyrifat75@gmail.com', '01840057448', NULL, 0, 3, NULL, NULL, '$2y$10$J5aJZnxS2pnC3gPyPEWpBeiVg/WsKlbIyBq4LAWKHLfdmxi9DKf.i', NULL, '2021-11-13 03:54:31', '2021-11-13 03:54:31'),
(578, 'TAHSIN AHMED SPORSHO', 'tahmedsporsho4@gmail.com', '01643083037', NULL, 0, 3, NULL, NULL, '$2y$10$RHtHKct24XhlpIEqQrXYqeERrtrbMh2P8fYRaHjslGf1uEsCFrT5W', NULL, '2021-11-13 06:43:39', '2021-11-13 06:43:39'),
(579, 'Sadia Islam', 'sadiaislamsrabonty@gmail.com', '01317928484', NULL, 0, 3, NULL, NULL, '$2y$10$Mnj/913g3GQu1yI4UOPVZu7ztg4hdmmgnn5PUZsAzw2so6uo.WJ16', NULL, '2021-11-13 08:47:25', '2021-11-13 08:47:25'),
(580, 'Jahid patowary', 'alvatorspro@gmail.com', '01792732951', NULL, 0, 3, NULL, NULL, '$2y$10$iY8VtyVJ931CZnLwKUGf3.RV2CdFY9HYVcv6eRVY0wf.iFb0mI.vS', NULL, '2021-11-13 09:38:48', '2021-11-13 09:38:48'),
(581, 'Md. Zinan Karar', 'zinankarar@gmail.com', '01842376050', NULL, 0, 3, NULL, NULL, '$2y$10$kJ49X.lOT/flvJ1cSuSkfugl9hS.XHqhkFM5Q1xjV1B3MA8uohuIG', NULL, '2021-11-13 13:21:51', '2021-11-13 13:21:51'),
(582, 'Rahul Biswas', 'biswasrahul062@gmail.com', '01706614366', NULL, 0, 3, NULL, NULL, '$2y$10$ft63xkCu.nrE/CUNpUIaAu91ZozXpT1W9aFqkCSOgd41nz2pmrCT6', NULL, '2021-11-13 16:10:43', '2021-11-13 16:10:43'),
(583, 'Sohel rana', 'sohelrana3927445@gmail.com', '01826581264', NULL, 0, 3, NULL, NULL, '$2y$10$2opga4SjZ4ooFCjmFrMIs.7ncRKwZbX5ELw7U0H7RMjZ/tDA0/11.', NULL, '2021-11-13 17:24:38', '2021-11-13 17:24:38'),
(584, 'Tasfiul Hedayet', 'tasfiul.hedayet2021@gmail.com', '01724506570', NULL, 0, 3, NULL, NULL, '$2y$10$e5mqC0HJHOG/Ft2k/65c9O6A6T5.636kSS.MOlvNAXrNRUTDrXT3a', NULL, '2021-11-13 17:32:03', '2021-11-13 17:32:03'),
(585, 'sadia akter usha', 'sadiaakterusha2@gmail.com', '01744890580', NULL, 0, 3, NULL, NULL, '$2y$10$/Dvk7l0SDnqGf1OsG5N3.eOUZgjO8KRtTSRQdedwkkzEMXd1XvejG', NULL, '2021-11-14 03:29:16', '2021-11-14 03:29:16'),
(586, 'M. HOSSAIN', 'm.hossain4471@gmail.com', '01568825471', NULL, 0, 3, NULL, NULL, '$2y$10$I/46XLZJ7Bk0LichIKzf0OLkznbpAlqXQEEVwur5W3dbb4PjcNBb6', NULL, '2021-11-14 05:33:01', '2021-11-14 05:33:01'),
(587, 'Jannat parvin', 'parvinjannat168@gmail.com', '01610892726', NULL, 0, 3, NULL, NULL, '$2y$10$bAUlqXD9B4YZEmMjWc4kvehufEv1OgVNYz83OdB76QRY0F8lDEFam', NULL, '2021-11-14 08:34:42', '2021-11-14 08:34:42'),
(588, 'Sudip Paul', 'sudip1206035@gmail.com', '01689543959', NULL, 0, 3, NULL, NULL, '$2y$10$KLCRc7M.1GgwUseyPytplubppmYxYMGWT89ClP6iddRj7A2.RgCoC', NULL, '2021-11-14 09:04:57', '2021-11-14 09:04:57'),
(589, 'Shamim', 'an5000963@gemil.com', '01757747461', NULL, 0, 3, NULL, NULL, '$2y$10$xKsbr3eGnt8h3vT1sqMf7.Pyyj7/sWbIUCl5nV5qqeWgqzwmw2vke', NULL, '2021-11-14 10:00:20', '2021-11-14 10:00:20'),
(590, 'Shilpi akthar', 'Shilpiakthar6@gmail.com', '01307328772', NULL, 0, 3, NULL, NULL, '$2y$10$FlGOZ79kijsjX0N82bA0UORJYROcIUVvMQX.OlSY44BYPsGN5ncJi', NULL, '2021-11-14 11:58:15', '2021-11-14 11:58:15'),
(591, 'Md.Murad Hasan', 'mdmuradhasan867@gmail.com', '01872251640', NULL, 0, 3, NULL, NULL, '$2y$10$thQXbhPsr6GhpYHga/QLHejjmN5F2xCNOfk7MWlzmz/6binz79gGK', NULL, '2021-11-14 14:05:44', '2021-11-14 14:05:44'),
(592, 'Nusrat Jahan Nabila', 'NusratJahanNabila96299@gmail.com', '01767116146', NULL, 0, 3, NULL, NULL, '$2y$10$UtasMr.NFj3v3eE3IYEvnO43YbOSOdwts7lGkiw5fHs3qODjApLAy', NULL, '2021-11-14 14:31:15', '2021-11-14 14:31:15'),
(593, 'AKIB KHAN', 'akibkhana549@gmail.com', '01648817870', NULL, 0, 3, NULL, NULL, '$2y$10$E6y/wZR7tza1lf.hJq2qBu0m1WVJnx9q3peHJ0cUqGMmUkWcaqj66', NULL, '2021-11-14 14:42:28', '2021-11-14 14:42:28'),
(594, 'Saqlain Morshed', 'saqlainmorshed07@gmail.com', '01531540290', NULL, 0, 3, NULL, NULL, '$2y$10$vCQsujlKlK/BGXTqv6/yjeTpCHtd7AN2uFrQn01AEfnIYMDy4F/Ka', NULL, '2021-11-15 04:19:45', '2021-11-15 04:19:45'),
(595, 'Rifat Bin Alam Rohit', 'rifat.rohit1412@gmail.com', '01687129490', NULL, 0, 3, NULL, NULL, '$2y$10$WXhk0m215iw.wjnbhEIX.OZVYar0WAJh1wb3ZYbnM1qwpCoPD0qSy', NULL, '2021-11-15 09:40:26', '2021-11-15 09:40:26'),
(596, 'TAREK MD SABBIR', 'tareksabbir20@gmail.com', '01317482908', NULL, 0, 3, NULL, NULL, '$2y$10$opP2cwP16RrsMZUxhXk2NOF9u0B7U1d3BCApAyuSlftViwRz2/zrm', NULL, '2021-11-15 12:18:31', '2021-11-15 12:18:31'),
(597, 'Istiaq Ahmed', 'istiaqahmed500@gmail.com', '01798622513', NULL, 0, 3, NULL, NULL, '$2y$10$lF67QfU9qcJ2QPLbUxXmSuSXBn1YPVnfJFw904uvFnJWPTAF5Nfom', NULL, '2021-11-16 11:10:00', '2021-11-16 11:10:00'),
(598, 'Mahadi', 'mh3467988@gmail.com', '01966006092', NULL, 0, 3, NULL, NULL, '$2y$10$cU.xkhGyz3t/heOCn8/MjulZe/KzawXERMM3oBVNPotGIk.w9u4/G', NULL, '2021-11-16 12:51:17', '2021-11-16 12:51:17'),
(599, 'sathi', 'sathikhatun2001@gmail.com', '01302428425', NULL, 0, 3, NULL, NULL, '$2y$10$hrYnl8xwXrPA/.5e00481eBo0nNPCpxQRmbZsJE5cBmM7n3DY/8Ee', NULL, '2021-11-16 14:59:18', '2021-11-16 14:59:18'),
(600, 'Fahmid Hasan Saad', 'fahmidhasansaad981@gmail.com', '01703928393', NULL, 0, 3, NULL, NULL, '$2y$10$5tmZPj.ShfbPuXr0Q1kxm..gdnkHy2De1IRoHafLE3RhbZcb.cTai', NULL, '2021-11-17 01:48:41', '2021-11-17 01:48:41'),
(601, 'Sumaiya Tahseen', 'sumaiyatahseen0@gmail.com', '01986087508', NULL, 0, 3, NULL, NULL, '$2y$10$ITK/enxEpsi9Ap5eam5GYOUz1iYpe1ZTr5A9Vxi6P9LTr2FC6pfYG', NULL, '2021-11-17 03:09:14', '2021-11-17 03:09:14'),
(602, 'Binita', 'agarwalbinita20@gmail.com', '01648397063', NULL, 0, 3, NULL, NULL, '$2y$10$vl2vCuIC3oGyQpMAsguGVOYFx5EA751F7RepXQaD50.f5DfDIaVmG', NULL, '2021-11-17 05:57:36', '2021-11-17 05:57:36'),
(603, 'নিজাম উদ্দিন', 'nu292257@gmail.com', '01701319323', NULL, 0, 3, NULL, NULL, '$2y$10$TJnLepS9wzGN2vD.uyfIz.nH5Ucdxm5GJeEebjxHW4TKUXO3gQYtG', NULL, '2021-11-17 11:24:07', '2021-11-17 11:24:07'),
(605, 'admin007@app.com', 'mohammedjobayeralzadid@gmail.com', '01925858202', NULL, 1, 1, NULL, NULL, '$2y$10$Gm5lkPOytsPUpjy1qzRtbeDYsLXZsRUx1Ak9RsGDmh2llseuv4WJO', NULL, '2021-11-18 06:51:21', '2021-11-18 06:54:45'),
(606, 'Ahmed Hossain', 'ahmedhossain595525@gmail.com', '01986817620', NULL, 0, 3, NULL, NULL, '$2y$10$zYk8PCf82u1EOas9/LOonuPnRVFXL2H/nj7.qlRfgYBWbV67zLv0a', NULL, '2021-11-18 07:38:45', '2021-11-18 07:38:45'),
(607, 'SM Abdullah Al Kabid', 'sakilkabid@gmail.com', '01754882401', NULL, 0, 3, NULL, NULL, '$2y$10$a3eduwfm2SkiztEJKhb/NeMKvMBt8xvKL8uMs1gek0DulTGEPMBWO', NULL, '2021-11-18 08:50:11', '2021-11-18 08:50:11'),
(608, 'JIBAN JOTI PAUL', 'jibanjotip@gmail.com', '01946539156', NULL, 0, 3, NULL, NULL, '$2y$10$oy3Yt4afyUH2GtiNdunQQOMU8qajVTr2lhnvCthqzKRHCVpQpb0V2', NULL, '2021-11-18 10:58:18', '2021-11-18 10:58:18'),
(609, 'Mst Sathi Khatun', 'sathikgatun2001@gmail.com', '01729018522', NULL, 0, 3, NULL, NULL, '$2y$10$itwsyrmWkzRfqr4TJ2dXZuh6Lqg1G7MPhv78RN4yINzzlXe7i.pGe', NULL, '2021-11-18 12:37:38', '2021-11-18 12:37:38'),
(610, 'Talha Tahmid', 'talhatah2022@gmail.com', '01738349444', NULL, 0, 3, NULL, NULL, '$2y$10$mD7Gn9nCRMUEzNSoPKUd9.fDbxdfxVT7reCQYQuC0cwNrQ1qQ87Rq', NULL, '2021-11-18 13:02:07', '2021-11-18 13:02:07'),
(611, 'Kanij Fatema', 'kanijfat95@gmail.com', '01732137261', NULL, 0, 3, NULL, NULL, '$2y$10$W/l1NAdIVp156pnmg87Dz.k5oqirx4nSaapJgABQwo0wBm/MBv9oO', NULL, '2021-11-18 13:04:31', '2021-11-18 13:04:31'),
(612, 'Syed Abu Toha', 'syedtoha20@gmail.com', '01819210130', NULL, 0, 3, NULL, NULL, '$2y$10$06KEZCNLUns3PmkPsWXIauegC7qYFyFYbrZ8UZgEFY83NkXjEoEEy', NULL, '2021-11-18 16:02:09', '2021-11-18 16:02:09'),
(613, 'Rahat Muztahid', 'rahat05rpaim@gmail.com', '01717034465', NULL, 0, 3, NULL, NULL, '$2y$10$T5IVDOqluD/QaF2q1g3RGeeclcyd3/kmcDkKCrwkct8wwcDxuHRAW', NULL, '2021-11-18 17:32:08', '2021-11-18 17:32:08'),
(614, 'Abrar', 'mactavish975@gmail.com', '01894894684', NULL, 0, 3, NULL, NULL, '$2y$10$DPjJsVoFjtGlieTFX6Mh0uGbwrgqDH9HH2nJRRiy/8glcfnqHL7dm', NULL, '2021-11-19 08:28:37', '2021-11-19 08:28:37'),
(615, 'Nasser Kamal', 'nasserkamal237@gmail.com', '01644137350', NULL, 0, 3, NULL, NULL, '$2y$10$7NNrMHNP6.KZLYq0cui2COjfDBwj01LWD258ixmpbjT8817uGtLY2', NULL, '2021-11-20 10:03:57', '2021-11-20 10:03:57'),
(616, 'Raj sarkar1', 'foodloverjsr570@gmail.com', '01745209257', NULL, 0, 3, NULL, NULL, '$2y$10$.y1SQS/Ntnd7SjRdTZshduNXHAkIDPgaDbnaOsttGnv6q96zo4pQS', NULL, '2021-11-20 15:57:09', '2021-11-20 15:57:09'),
(617, 'MD Ashraful Islam', 'ashrafulsm22@gmail.com', '01319427544', NULL, 0, 3, NULL, NULL, '$2y$10$prl41zwe2R3evuuKgkRwe./bHO.rE3gkhFILOEZ8t9ZBulyiUuSNy', NULL, '2021-11-20 17:51:43', '2021-11-20 17:51:43'),
(618, 'Shahriar Tousif', 'shahriart20t@gmail.com', '01641008832', NULL, 0, 3, NULL, NULL, '$2y$10$iFLkEkXpM7Ofnq8FPnTQOuub8TIL7tMiscYcgJGXLD7PwzYh2mz2m', NULL, '2021-11-21 14:12:40', '2021-11-21 14:12:40'),
(619, 'Motasim Billah Sadi', 'motasimbillahsadi.bd@gmail.com', '01875813552', NULL, 0, 3, NULL, NULL, '$2y$10$z2PAKqShplGir2PNTbdi7eO5diTxcgMIBJOK0AXQF.3l8FptoiyXO', NULL, '2021-11-21 14:20:26', '2021-11-21 14:20:26'),
(620, 'Md Yousuf Niaz', 'mdyousufniaz@gmail.com', '01521734955', NULL, 0, 3, NULL, NULL, '$2y$10$dPuxhM7o/0RCs/B3V6NMiuP/5zUb/q3cJEJhZfKi.gboYYSu/d5h2', NULL, '2021-11-22 03:57:51', '2021-11-22 03:57:51'),
(621, 'Shawon', 'noorh111523@gmail.com', '01887487150', NULL, 0, 3, NULL, NULL, '$2y$10$WQU6Yt2skOnJLH5VvU7XzeROKI3GpAYUcDR45rWiZiV2Ap/ADBvUG', NULL, '2021-11-22 04:06:23', '2021-11-22 04:06:23'),
(622, 'Rashedul Hasan Riju', 'rashedriju01@gmail.com', '01575021568', NULL, 0, 3, NULL, NULL, '$2y$10$bJzZVvT6rwK6WW6LtzlHTuDtwz9As08PoVYJ8ljP.hjhSdyKEiMi.', NULL, '2021-11-22 04:56:14', '2021-11-22 04:56:14'),
(623, 'Mahafuja Mitu', 'mitumahafuja906@gmail.com', '01701994108', NULL, 0, 3, NULL, NULL, '$2y$10$eSBGdiHf24JWgYvYrf3FfugKdhC1xENdaN.4IlxTtxyQTfsR15aEe', NULL, '2021-11-22 06:17:04', '2021-11-22 06:17:04'),
(624, 'Md. Tasin Alam', 'tasin020316@gmail.com', '01768277099', NULL, 0, 3, NULL, NULL, '$2y$10$ey/cFAEm3lGYtZvER.p/qeuh0casvFCtWZnss9bqNqu341nNHR1TC', '9R5Y21MD3RhhMZSGyshfJna18xxR6lxWzSi63pu1hZOLYcM1tWe53J0ZVpsN', '2021-11-22 06:22:17', '2021-11-22 06:22:17'),
(625, 'Afroza Pervin', 'afrozapervin2000@gmail.com', '01409266624', NULL, 0, 3, NULL, NULL, '$2y$10$kF2mUK2nSTUr3Xo7Yy6MFe3TZM8dB8V0XebTRQYVgFwICB2s3yEDq', NULL, '2021-11-22 13:35:05', '2021-11-22 13:35:05'),
(626, 'Mo vlogs', 'muhammadmosiurr@gmail.com', '01759271880', NULL, 0, 3, NULL, NULL, '$2y$10$NyFXXj.LGg3C4GcmJNRmGuAZho7v/w8FDi7G4VUO9LxmAVidGJLAO', NULL, '2021-11-22 14:36:02', '2021-11-22 14:36:02'),
(627, 'smabdullah', 'sakilkabid@app.com', '01754882402', NULL, 1, 1, NULL, NULL, '$2y$10$JJ6tCYTHVOkMgrFaVCFvReFu28O.FcAbWA/TWqjBYwEalBUKeGUOy', 'LinETGBpeBxI3QAsATjsj0NDfGtMHy8H63RrB2lf3kQHJN1JNgEtoyiXjZOL', '2021-11-23 06:24:23', '2021-11-23 06:24:23'),
(628, 'Ararat wasi', 'wasiarafat@gmail.com', '01934558678', NULL, 0, 3, NULL, NULL, '$2y$10$pDj47QS9Nt0gcLI/VS0zd.rTbO7zJr.Nffi3EPnee1736REUevdI6', NULL, '2021-11-23 13:42:46', '2021-11-23 13:42:46'),
(629, 'Nafija hossen', 'nafijahossenamatullah@gmail.com', '01640849576', NULL, 0, 3, NULL, NULL, '$2y$10$JCba/1MfZy3hBn7vOUZuMujb7V4fNeWifLDnYg3p1dOKbpcNR8VvW', NULL, '2021-11-24 03:05:44', '2021-11-24 03:05:44'),
(630, 'sakib', 'sakib@app.com', '01683479802', NULL, 1, 1, NULL, 'public/user/G2kaHWjTP4mLdeofpnLsb8UGri6GALyAPcsaLYFc.png', '$2y$10$iMQA0cnIyPvsBm1l4WcBp./96Rp.kLKUirzUxMqPvj8JnlfB.XefK', NULL, '2021-11-24 05:30:36', '2021-11-24 05:37:56'),
(631, 'Abdullah Al-amin', 'abdullah.al.amin@g.bracu.ac.bd', '01737824283', NULL, 0, 3, NULL, NULL, '$2y$10$GRha9r5qTeebMTuPtfRP9uNRK4o.ifjsKUmOSTpRAbrL2W5j7cDH.', 'EpsK9eaovvT1kYlp8ZjlyLuK6mtIg0jnaQkfPG04GAQs5EDKuwkrXove81qC', '2021-11-24 07:11:05', '2021-11-24 07:11:05'),
(632, 'Md. Shahriar Iftekhar ', 'Shahriar@gmail.com', '01555555553', NULL, 0, 2, NULL, '/storage/user/xjRVEa7si2GVGtp1VBCFGUZVrcmJAbVkuI3iHAI1.png', '$2y$10$YNGFBuqJoi2w7WQlt9wWXOTZL1VNSGr3DaqVgiU3SsVD6wE1EaqBi', NULL, '2021-11-27 12:04:42', '2021-11-27 12:06:05'),
(633, 'Sharmin Afrose', 'sharminafrose95@gamil.com', '01977991517', NULL, 0, 3, NULL, NULL, '$2y$10$rStz6.jVF.98rk0o23wNjuxhp5tH5GnpQTMGO6527heV0g/dnuDV.', NULL, '2021-11-29 04:33:47', '2021-11-29 04:33:47'),
(634, 'Syed Nazmus Sakib', 'nasa.sakib48@gmail.com', '01931650289', NULL, 0, 3, NULL, NULL, '$2y$10$9N6QsVy1axwooPxFfIE47OsbAt8yvshXrk7i.S0G8HcxFviK1hRAO', NULL, '2021-11-29 04:36:04', '2021-11-29 04:36:04'),
(635, 'Sinthia saba', 'sinthiasaba94@gmail.com', '01746430300', NULL, 0, 3, NULL, NULL, '$2y$10$xZ.4ip8dInqlUEfVunfvMOUO9M.hB9O5EuXd07nfeJusKpAl2Xryi', NULL, '2021-11-30 07:15:51', '2021-11-30 07:15:51'),
(636, 'আশরাফুল ইসলাম (রাজিব)', 'ashrafulislamrazib6@gmail.com', '01306873558', NULL, 0, 3, NULL, NULL, '$2y$10$TtBjwniPSBZTIgOazxKCyOBRwNWfSWdQHtKqgAM6rHB8J1/EUwlH6', NULL, '2021-11-30 07:29:11', '2021-11-30 07:29:11'),
(637, 'Ariful Islam', 'arif00069@gmail.com', '01670134603', NULL, 0, 3, NULL, NULL, '$2y$10$rfKjHUGpcg2Gk448p.Nu/O0yIXEfDPg418Ano1vG.CKKjgqa4QxDi', NULL, '2021-11-30 07:51:46', '2021-11-30 07:51:46'),
(638, 'Sk Mehedi Hasan', 'mehedi42200@gmail.com', '01742200459', NULL, 0, 3, NULL, NULL, '$2y$10$k2Okgi8o6hr9lDixUP3q.OZcYw5rIA4JuvZlKXxD5WrjDYWAVs18a', NULL, '2021-11-30 08:11:25', '2021-11-30 08:11:25'),
(639, 'Alfi Khan', 'alfi9624@gmail.com', '01647654618', NULL, 0, 3, NULL, NULL, '$2y$10$mdQTmg2NZLOo2i1S2qbsmunQjkWGy8ThDysodmbxQyxgtk6bIiAUW', NULL, '2021-11-30 12:38:43', '2021-11-30 12:38:43'),
(640, 'Sourav roy', 'souravkumar1sk@gmail.com', '01783451563', NULL, 0, 3, NULL, NULL, '$2y$10$yKtpE0tE6t.H04Tg2dNaS.E75gUklPbBkjEqFo/vARiA//1FGss0O', NULL, '2021-11-30 12:41:32', '2021-11-30 12:41:32'),
(641, 'Kasfia Jaman Prionti', 'kasfiajamanp@gmail.com', '01717261592', NULL, 0, 3, NULL, NULL, '$2y$10$6fkFgPJD9dmzyMfIRo0Be.qlh4xSkf5J9x85ITQhve/YbJ43VeEQ.', NULL, '2021-11-30 12:52:30', '2021-11-30 12:52:30'),
(642, 'Taz', 'tazrianahmed96@gmail.com', '01647809250', NULL, 0, 3, NULL, NULL, '$2y$10$RJWAdpysLR411/NT2VT2yeTkRkIjSZvVzugMDIiSQrXCOp1BWXCxW', NULL, '2021-11-30 13:10:55', '2021-11-30 13:10:55'),
(644, 'অজিত দাশ', 'testajith@gmail.com', '01843306208', NULL, 0, 3, NULL, NULL, '$2y$10$UwE43FDHtr2Umx87Xcy.Vunfw28HZXMpYuZzpovsMmeUJ8cXKrbQK', NULL, '2021-11-30 13:32:19', '2021-11-30 13:32:19'),
(645, 'Nishat Mst. Mansura Akter', 'mansuranishat78@gmail.com', '01751602082', NULL, 0, 3, NULL, NULL, '$2y$10$RtYTNqZjL2ObQg5vxGD5M.SVWEiEmSDD78xQAeyR0HG/W8ceT6z7i', 'srn0iFvrn2mgoX6tuYUT3RxlGNigBczhNTH6mIR4atPBZwnp0SrNBGnllTi9', '2021-11-30 15:30:47', '2021-11-30 15:30:47'),
(646, 'Yousha', 'jahangiryousha@gmail.com', '01975079290', NULL, 0, 3, NULL, NULL, '$2y$10$Cua/hunOISFotRsnTDaxZ.w0QonxygjIj/X8rZjbnWPLiEpDRKzj6', NULL, '2021-11-30 19:58:27', '2021-11-30 19:58:27'),
(647, 'G.M.SADRIL HASAN', 'sadrilhasan420@gmail.com', '01537100652', NULL, 0, 3, NULL, NULL, '$2y$10$mX7g14lCf9oMXAB1s/XHnOlJ5zWaUZpid0cyre8wBBe3RlHlSDzf2', NULL, '2021-12-01 06:05:43', '2021-12-01 06:05:43'),
(648, 'Islam Md Tarekul', 'mdtarekulislam116378@gmail.com', '01859606191', NULL, 0, 3, NULL, NULL, '$2y$10$QzrpYmTYIT4FXbAY8XrcLOEM8abkvFfV2n6WaBVJ4LI0IHP4BO9vq', NULL, '2021-12-01 06:48:17', '2021-12-01 06:48:17'),
(649, 'Jannatul Fardaus', 'Jfardaus84@gmail.com', '01881418353', NULL, 0, 3, NULL, NULL, '$2y$10$MoHynm652NLP/zPjGA4QhuC/KdSCPCsFn26IgXTUglgvl/yV6lgKe', NULL, '2021-12-01 08:16:32', '2021-12-01 08:16:32'),
(650, 'শিমুল শিমুল', 'shimulislam123098@gmail.com', '01770273515', NULL, 0, 3, NULL, NULL, '$2y$10$NepZmziTNpKQIAJBJNmQPuXAuyt4TpfmUwjqiP5uIA280tc3FUhKi', NULL, '2021-12-01 11:55:10', '2021-12-01 11:55:10'),
(651, 'Sayed Fahim Alim', 'lackjack792@gmail.com', '01988513812', NULL, 0, 3, NULL, NULL, '$2y$10$cu/Ga0UdqYy2N89pkhfdzOZbROL3FN3snIwJYRBOnl2bjU5sscmvW', NULL, '2021-12-01 15:21:09', '2021-12-01 15:21:09'),
(652, 'HUMAYARA MUSTAFA KUASHA', 'mustafakuasha2003@gmail.com', '01731348842', NULL, 0, 3, NULL, NULL, '$2y$10$H8bfn4BTL85t/qciYcWPNeoWxD2actYotIPfDe0cD9Ij1gtZJwYzS', NULL, '2021-12-01 20:18:09', '2021-12-01 20:18:09'),
(653, 'Mehedi Hasan', 'mehedihasan440@gmail.com', '01987945875', NULL, 0, 3, NULL, NULL, '$2y$10$BV.5WfFKAfkSeevsuI8PC.dS73FkAW/1JaEZLzMlTUYDI1p.BU0qK', NULL, '2021-12-02 09:14:11', '2021-12-02 09:14:11'),
(654, 'Md. Ibrahim', 'ibrahimadorer@gmail.com', '01810866829', NULL, 0, 3, NULL, NULL, '$2y$10$wy8S0lTdfDohlbJyfNS8kOz/.Wdco0SmFSweMED1DyeIVA.qwl3fi', NULL, '2021-12-02 11:06:04', '2021-12-02 11:06:04'),
(655, 'Anter Al Madina', 'madinamadina2673@gmail.com', '01709824668', NULL, 0, 3, NULL, NULL, '$2y$10$LCF1fvt5Q5C42V31csMereATzB86Q6tHxyOqcHLHG/nrO7iGovRVW', NULL, '2021-12-02 11:32:38', '2021-12-02 11:32:38'),
(656, 'MD Nayan Hossain', 'mdnoyonh95@gmail.com', '01707665728', NULL, 0, 3, NULL, NULL, '$2y$10$Gnld5OTv1uvZ13J6mmjX2O4y6VHs6RhuO49vwZYQGLUqtnF3IbnqO', NULL, '2021-12-02 13:46:55', '2021-12-02 13:46:55'),
(657, 'Emon', 'hasanemonhasan087@gmail.com', '01795713665', NULL, 0, 3, NULL, NULL, '$2y$10$rOSzAIeC2A/vsyhpt3lum.8VQ4tHr3CLRZkrhGzUF8jl1vy2Tupa2', NULL, '2021-12-02 14:36:11', '2021-12-02 14:36:11'),
(658, 'K. M. ASHRAFUL ISLAM', 'k.mashrafulislam2008@gmail.com', '01537311336', NULL, 0, 3, NULL, NULL, '$2y$10$CqAxzMw2GjlSz7IlOm0w8eA480GhvwpE20MC/ebG7ff5lRj0p3/Xy', NULL, '2021-12-02 15:06:16', '2021-12-02 15:06:16'),
(659, 'Md Tauhid Ur Rahman', 'tauhidrahoman@gmail.com', '01302363852', NULL, 0, 3, NULL, NULL, '$2y$10$GLYZqqNCaogHZaBJ0GvmHeQG5b8UPwSE/AbgX5Ylo0N8jELBTXY/m', NULL, '2021-12-03 01:18:01', '2021-12-03 01:18:01'),
(660, 'Iffat Chhowa', 'iffatchowastudent@gmail.com', '01715937294', NULL, 0, 3, NULL, NULL, '$2y$10$5D5IDB0V794mUN/AOjFb0uBBujXexwd1c07tM6gAmNDaHTNDWZvpC', NULL, '2021-12-03 05:15:18', '2021-12-03 05:15:18'),
(661, 'ShaonKumar', 'ShaonKumar@gmail.com', '01816563981', NULL, 0, 3, NULL, NULL, '$2y$10$xK9OAbgxrcZcQmyG7r5gceyzAJb1tkqx.yhtby2ePfuaMQcAghiTS', NULL, '2021-12-03 09:26:23', '2021-12-03 09:26:23'),
(662, 'Tahasina Alam Taesa', 'Nasrinalamto@gmail.com', '01872181680', NULL, 0, 3, NULL, NULL, '$2y$10$xfRn7dNTEixITj6vLtPGgufYdRlLBQUlEif8bWRChDZpHzNgk/N7K', NULL, '2021-12-03 14:05:42', '2021-12-03 14:05:42'),
(663, 'Taniya Akther', 'mimitisha1@gmail.com', '01850735536', NULL, 0, 3, NULL, NULL, '$2y$10$Dly1K8QHvp.YKoJb1uIb4.ZnPcKmMSvNh/xps71OH5cVUx8B.u1gC', NULL, '2021-12-03 14:46:26', '2021-12-03 14:46:26'),
(664, 'Bayazid', 'bayazid.dic@gmail.com', '01741037905', NULL, 0, 3, NULL, NULL, '$2y$10$Im39gXwtkynNFJz0yOyn7eC1PA0Ag4khzu3MBbHwLnL2J2TLOEdHu', NULL, '2021-12-03 15:10:10', '2021-12-03 15:10:10'),
(665, 'MALIHA MOURIN', 'malihamourin59@gmail.com', '01626600712', NULL, 0, 3, NULL, NULL, '$2y$10$UzHNI181P5GoH9.oZddiuuATPNcq0vWEykOZDxMqnxJ.DLLtb4zyq', NULL, '2021-12-03 18:38:27', '2021-12-03 18:38:27'),
(666, 'মেশকাত জাহান', 'masketjahan00@gmail.com', '01744614156', NULL, 0, 3, NULL, NULL, '$2y$10$g0psR7DgXdwuUEC94KcStu7OWR.aeG9YhNRcrnf9H4R2mH2gvF1oi', NULL, '2021-12-04 00:44:15', '2021-12-04 00:44:15'),
(667, 'Md.Ibna Omar', 'zidnictg123@gmail.com', '01813952963', NULL, 0, 3, NULL, NULL, '$2y$10$KpqzbPAtVe.hIei.glwS0.7xft9kldjYl41uDcqmImwJMRlATsCaG', NULL, '2021-12-04 10:30:17', '2021-12-04 10:30:17'),
(668, 'Mashrura', 'maishahabib24@gmail.com', '01889272000', NULL, 0, 3, NULL, NULL, '$2y$10$0GCZZEKySJdrQkURzGMbM.RTCS6LbBcRo2dz1oz4Mb729F3ZfQUrK', NULL, '2021-12-04 12:51:39', '2021-12-04 12:51:39'),
(669, 'Md Jahid Hasan', 'mdjahidhasan1204@gmail.com', '01738207814', NULL, 0, 3, NULL, NULL, '$2y$10$ND/PdQaWEDtHHc3dTgSSv.sulVJKkOGWNli.2YCr/qibdIh0yDxZu', 'GINCn5Y3Lw6f2SfDhUDBl618a4pv2r80VCaDAYSozp2oZGdK7ircSMo5GfXh', '2021-12-04 13:34:21', '2021-12-04 13:34:21'),
(670, 'Mehedi Hasan Rony', 'mdnrony700@gmail.com', '01783755320', NULL, 0, 3, NULL, NULL, '$2y$10$f1zoQbDjXgqhJ2f/Rk2srOvg0UYMwRq24Olb4pfwdP7mxoi9su8/e', NULL, '2021-12-04 13:49:11', '2021-12-04 13:49:11'),
(671, 'Fahim Abdullah', 'fahimabdullah274@gmail.com', '01815492510', NULL, 0, 3, NULL, NULL, '$2y$10$VCMXqOVcBEfEkSN1.ioRue/1.4gB/K3kFDC4rdo9SHq5728merX22', NULL, '2021-12-04 15:38:37', '2021-12-04 15:38:37'),
(672, 'Shaheed Muhammad', 'hardworking@gmail.com', '01633715922', NULL, 0, 3, NULL, NULL, '$2y$10$VLsXePVRV/eammC9yuCn5.zrdAii2bzy0UgCUerprtLBBEkD0NrZ6', NULL, '2021-12-04 18:25:47', '2021-12-04 18:25:47'),
(673, 'Jabir mahmud', 'ms2460751@gmail.com', '01873505865', NULL, 0, 3, NULL, NULL, '$2y$10$t8ROAWN1Ad/FIDrD2Wwk5eytMAzQpSguiDYXIoxIq95PXmLduccV2', NULL, '2021-12-04 19:42:56', '2021-12-04 19:42:56'),
(674, 'Shagota', 'shagotakunduprapti@gmail.com', '01736716375', NULL, 0, 3, NULL, NULL, '$2y$10$U4IU8J0TsYLAvCj7nediaOM/dFbZZyGECvZ9ObKZUS2RN5jU4w2eO', NULL, '2021-12-04 20:23:44', '2021-12-04 20:23:44'),
(675, 'SHIBBIR AHMED', 'shibbirahmedops@gmail.com', '01518340563', NULL, 0, 3, NULL, NULL, '$2y$10$RrrFxUJfhXPXI6ZC0nHEG.DrDpOqdOIFhWYBwo3tM8KWzNbKg1qCu', NULL, '2021-12-05 05:28:14', '2021-12-05 05:28:14'),
(676, 'Md Asif Ul Haque Mitul', 'askhanasif4@gmail.com', '01795830967', NULL, 0, 3, NULL, NULL, '$2y$10$SjfyioOa7kOd9Skxw5NCtOuabX5vKMSg8kB5WVYzlgJL/pEx31bJy', 'zEcWn7jKYNFUOPj3h139i4wigNsfTLhYwhBGuWLiIJtHqiYXIK33hVwi9cRd', '2021-12-05 06:31:33', '2021-12-05 06:31:33'),
(677, 'Md Yeasin Arafat', 'yeasinarafat82040@gmail.com', '01567952858', NULL, 0, 3, NULL, NULL, '$2y$10$3IvFXTkvYs.xDIWmiDbH1.VQhemIkLvO2q/9Q49S75IAr5S7cftEO', NULL, '2021-12-05 07:11:24', '2021-12-05 07:11:24'),
(678, 'Arijit', 'babuchyhahahaha@gmail.com', '01558885404', NULL, 0, 3, NULL, NULL, '$2y$10$tjgWs8GOSLVZic5893FES.N94AeB6P05O/TOOSxbn27PkHs7.S/jW', NULL, '2021-12-05 07:16:24', '2021-12-05 07:16:24'),
(679, 'Rafi Bin Kamal', 'ifartahsanrafi@gmail.com', '01973160168', NULL, 0, 3, NULL, NULL, '$2y$10$MhMT.qe0VFhLyDbr9Q.Hy.hCc/U6zxdbCVDLvMabbDoaVYLk/Xof.', NULL, '2021-12-05 11:39:12', '2021-12-05 11:39:12'),
(680, 'Bekash barmon', 'bekashbarmon46@gmail.com', '01883689387', NULL, 0, 3, NULL, NULL, '$2y$10$1JOEH15QCclqFCU9g/zcE.y8ok04AUTPt6G9uevnZwz9bZGlgH0Se', NULL, '2021-12-05 12:40:55', '2021-12-05 12:40:55'),
(681, 'sultana', 'shefaabidasultana@gmail.com', '01568204628', NULL, 0, 3, NULL, NULL, '$2y$10$08QL6TbrFuX412q4vwS0ue.eGXORPCCK8gTzGHfoZeic8bPmy6Yme', NULL, '2021-12-05 14:55:32', '2021-12-05 14:55:32'),
(682, 'Anwar hussain', 'Anwarhussainmef237@gmail.com', '01826993499', NULL, 0, 3, NULL, NULL, '$2y$10$KzsafniRi7i/lbFPdaW4uOOkxy7VRdgDTdYOchsJWFRBwro6Atx1u', NULL, '2021-12-05 17:14:46', '2021-12-05 17:14:46'),
(683, 'Abu naim', 'nayeem351204@gmail.com', '01997351204', NULL, 0, 3, NULL, NULL, '$2y$10$WtkA7S7SUVJe5OuY.3dSo.H/RMeakmqntApf7e07ZEY9lrP9H8SU.', NULL, '2021-12-06 05:20:29', '2021-12-06 05:20:29'),
(684, 'Jannaty Islam Anonna', 'shamimosman8181@gmail.com', '01987118540', NULL, 0, 3, NULL, NULL, '$2y$10$xZ8c2i5zHjK6rg46jMf/j.rgrX0kA2yMl92mmppfre9zwcApF5Nt6', NULL, '2021-12-06 14:56:01', '2021-12-06 14:56:01'),
(685, 'Sohel rana', 'boosterbasir5101@gmail.com', '01780824921', NULL, 0, 3, NULL, NULL, '$2y$10$qNfEV5YD2RRAn75xqV5IT.Bnpyg3EiycAvYwQYZETKk5pqYQfL4ZK', NULL, '2021-12-06 19:34:59', '2021-12-06 19:34:59'),
(686, 'MD Rezaul Karim', 'mdrezaulkarim9091@gmail.com', '01821321188', NULL, 0, 3, NULL, NULL, '$2y$10$rIxGZvCcDyEvrc.vaDIfQuDAcVF19Iw6UFbZWeIQlt2xL2aWWVv16', NULL, '2021-12-07 06:12:30', '2021-12-07 06:12:30'),
(687, 'Tanjir Mahmud', 'hackertx219@gmail.com', '01787421397', NULL, 0, 3, NULL, NULL, '$2y$10$iZZpcfi.XuFJPdUECH5SLOgoSzM6O9JF/IePnJLpU6akgL5OKRUX2', NULL, '2021-12-07 06:20:32', '2021-12-07 06:20:32'),
(688, 'sayem', 'sainasheikh018@gmail.com', '01978866723', NULL, 0, 3, NULL, NULL, '$2y$10$POi4A.eu2Qtbjv.BNIlyveGKKW0qRfmA2FHzjpmwl8gWLUrWhTsUm', NULL, '2021-12-07 07:44:50', '2021-12-07 07:44:50'),
(689, 'Ahasanul Haque Jony', 'ahasanulhaquejony@gmail.com', '01794662349', NULL, 0, 3, NULL, NULL, '$2y$10$yJN7xrP1v/tlOtEukLHtpOps4Xb51QA86dr.w5l5ms2HODt/FAXde', NULL, '2021-12-07 09:02:19', '2021-12-07 09:02:19'),
(690, 'মোঃ মারুফ', 'Hojrotomor306@gmail.com', '01792572306', NULL, 0, 3, NULL, NULL, '$2y$10$jvsPTN98gFuiPIXfvreQKefimzZBH1.rElyW3gK4V3h7j5YMoBaQa', NULL, '2021-12-07 14:39:22', '2021-12-07 14:39:22'),
(691, 'Emon Islam', 'emon66758@gmail.com', '01867325165', NULL, 0, 3, NULL, NULL, '$2y$10$lfnN.YJA7soM4UbBNzhRWuJN7yAQGDb.QKTJbqWGNfw5bnQS2JE0S', NULL, '2021-12-07 17:52:43', '2021-12-07 17:52:43'),
(692, 'Mehrin Nasa Mom', 'mommumu9@gmail.com', '01622307570', NULL, 0, 3, NULL, NULL, '$2y$10$xurYR8qRyjSwz3IjtsZFnOIVOkbIZC7E9W8W1Dm.AEBUrPgGyGr8C', NULL, '2021-12-08 03:48:19', '2021-12-08 03:48:19'),
(693, 'Mohammad Najmul Huda', 'mnhnh7738@gmail.com', '01310160262', NULL, 0, 3, NULL, NULL, '$2y$10$W5CGypTG9uPy2w3.MDFVbOyQmsFNY1GRez0WzJhyUhi3aU.dSlQp2', NULL, '2021-12-08 05:18:04', '2021-12-08 05:18:04'),
(694, 'MD Jamil Islam', 'mja31016@gmail.com', '01799193198', NULL, 0, 3, NULL, NULL, '$2y$10$xgWtyLMH9W0.4Gl5dhJgXu5L9aHlkza.LFF2YTAozPXfDrHzIPCv2', NULL, '2021-12-08 09:18:49', '2021-12-08 09:18:49'),
(695, 'HRidita', 'hridihowlader90@gmail.com', '01612414134', NULL, 0, 3, NULL, NULL, '$2y$10$jTdR6FghyleQF7GQfAu23ep/E5.bxMyZjiFEn/q16bUmF.P25Hwe6', NULL, '2021-12-08 10:18:01', '2021-12-08 10:18:01'),
(696, 'SUBIR Mitro', 'subirmitro111@gmail.com', '01408090136', NULL, 0, 3, NULL, NULL, '$2y$10$HSx0oV0Gid/P.oos3dH2eur3TCxPaqS0msM69b58h3cTvvH4vy6Sq', NULL, '2021-12-08 11:25:40', '2021-12-08 11:25:40'),
(697, 'Md. Rakib Hasan Rifat', 'mdrakibhasanrifat2020@gmail.com', '01580541611', NULL, 0, 3, NULL, NULL, '$2y$10$mxWYpM2iFMSSUzmhGnA0o.rBhWbi5lghdEGxmXC47UAFbhLxk5WIK', NULL, '2021-12-09 00:08:18', '2021-12-09 00:08:18'),
(698, 'Tabiya khanam', 'Tabiyakhanam5@gmail.com', '01633972803', NULL, 0, 3, NULL, NULL, '$2y$10$x/o6/TdwIoEcHuHivXaYPeVCEz.7f0B1Hd/2pbgtTIWMaD41bsaSO', NULL, '2021-12-09 05:55:17', '2021-12-09 05:55:17'),
(699, 'Nurul Huda', 'nh69960@gmail.com', '01727313515', NULL, 0, 3, NULL, NULL, '$2y$10$hYuK0FxgVVIWcXLv6VaCNe1eKH6.20KzSIm.1QLfhWCus4/QMlQSG', NULL, '2021-12-09 06:29:42', '2021-12-09 06:29:42'),
(700, 'S.M. Sabit bin Hossain', 'sabitbinhossain867@gmail.com', '01810066076', NULL, 0, 3, NULL, NULL, '$2y$10$J/YYatJgho8lB7pd.W8bOefO9zc10R1jqDb04jRvX6TIZ3UxQuZj2', NULL, '2021-12-09 08:52:29', '2021-12-09 08:52:29'),
(701, 'rifat', 'rifat.livetechltd@gmail.com', '01686520282', NULL, 0, 3, NULL, NULL, '$2y$10$rrWixbFy6mor.QAtKNC.2.6M0R9DKj4zgNlXGP22zl0MK/HQ.V0Ca', NULL, '2021-12-09 09:53:32', '2021-12-09 09:53:32'),
(702, 'Nayeem Ullah Anik', 'nhkanik0001666@gmail.com', '01709319001', NULL, 0, 3, NULL, NULL, '$2y$10$gh4/gBT.A6f2rkSzLDApIeat62Nch27yOPV.vK//R5Vt9B8ig1F2W', NULL, '2021-12-09 11:37:57', '2021-12-09 11:37:57'),
(703, 'Naoshadchowdhury', 'naoshadchowdhury@gmail.com', '01778652097', NULL, 0, 3, NULL, NULL, '$2y$10$.N5kZ9Wu0dWY2OBzxCmzt.HU3DwhCr1yZS6Yro9mcp7bYtAfjeTyG', NULL, '2021-12-09 12:10:21', '2021-12-09 12:10:21'),
(704, 'Rasel Riad', 'siamrasel002@gmail.com', '01914435934', NULL, 0, 3, NULL, NULL, '$2y$10$CM44nRqbfA3iuAHsJU3Dg.QRvziRaZU7fyV5biCAORQbbn4OffRiq', NULL, '2021-12-09 16:15:33', '2021-12-09 16:15:33'),
(705, 'Faisal Ahmed', 'foysalahmadnkm@gmail.com', '01881477626', NULL, 0, 3, NULL, NULL, '$2y$10$IEqwEdCcJgABGOYLec4vnutIrlhFlE6TAdzgsP8YvVUs2IHbTT.3.', NULL, '2021-12-09 18:37:25', '2021-12-09 18:37:25'),
(706, 'Amir Hamza', 'hamza02988@gmail.com', '01758620900', NULL, 0, 3, NULL, NULL, '$2y$10$owrhowkQjbcDABkMomfgzu7vGHdCRYEfwG6iJ3mXYM62YzHh7Gu5m', NULL, '2021-12-10 01:18:11', '2021-12-10 01:18:11'),
(707, 'Jisan lslam', 'alijisan464@gmail.com', '01821883732', NULL, 0, 3, NULL, NULL, '$2y$10$VwvBDF00ffxgLgvTxk6sd.5HOmYkhzDO60SJL6C1uAKxjX2IYHQJe', NULL, '2021-12-10 08:13:18', '2021-12-10 08:13:18'),
(708, 'Tawhid uzzaman', 'tawhiduzzaman588@gmail.com', '01740035654', NULL, 0, 3, NULL, NULL, '$2y$10$P34CS/jM59DdF1hMDTvwiOY5uJN07urcK1lnsep3709SvcoZHKtfm', NULL, '2021-12-10 14:20:22', '2021-12-10 14:20:22'),
(709, 'Most. Rumana khatun', 'm.rumana718@gmail.com', '01744499718', NULL, 0, 3, NULL, NULL, '$2y$10$fsn.Vh3Uv.jnEpchyk9F0eBb.o89Zqc9kqnEZ9q5dC2Ncmbdxsz2u', NULL, '2021-12-10 16:54:45', '2021-12-10 16:54:45'),
(710, 'Tabassum Nishat', 'nasi5748@gmail.com', '01718991846', NULL, 0, 3, NULL, NULL, '$2y$10$j6uyk.Q60aUfukKMRJRmwev1iRcoGgC6d7wnv0JaG2AEyURq4Wzky', NULL, '2021-12-10 17:58:58', '2021-12-10 17:58:58'),
(712, 'Test', 'nikisa7762@iistoria.com', '01951254193', NULL, 0, 3, NULL, NULL, '$2y$10$rLMsgXVmTO26kGLbYXhz2uWAmSnweqdx12V7FC6hm8s/ysitdnFpu', NULL, '2021-12-11 07:24:14', '2021-12-11 07:24:14'),
(713, 'Sadia Ahammed Sinigdha', 'mahabubasha056@gmail.com', '01774242004', NULL, 0, 3, NULL, NULL, '$2y$10$KlVC.ZekwjCnVsOn16ZO8O/EBmanwafwjl9Eq0BVciIyXZYS.3kRG', NULL, '2021-12-11 16:53:15', '2021-12-11 16:53:15'),
(714, 'Tanzimul Hasan', 'tanzimulhasan478@gmail.com', '01790242942', NULL, 0, 3, NULL, NULL, '$2y$10$2zPaujiwEXlyPl8cFcnOxuQ0HKw8PmzTNk.J/g/mlQh9lkYFbQRTi', NULL, '2021-12-11 18:01:46', '2021-12-11 18:01:46'),
(715, 'Md Masud', 'amaksuda@564gmail.com', '01320621812', NULL, 0, 3, NULL, NULL, '$2y$10$SnDkILEzCM6Rbdzte7TQoOZuUS2bawmilDgGf5j1oS/e0mjieT3/O', NULL, '2021-12-12 06:57:55', '2021-12-12 06:57:55'),
(716, 'Fariha Yesmin', 'yesminfaria020@gamil.com', '01970688828', NULL, 0, 3, NULL, NULL, '$2y$10$EXV8ddjFNBHuBsacXwvEZOzGTZ6caYW3sosk5AKYEpBbNdJ8IB1ji', NULL, '2021-12-12 11:40:06', '2021-12-12 11:40:06'),
(717, 'Abdur Rahim', 'abdurrahim442tarek@gmail.com', '01966428175', NULL, 0, 3, NULL, NULL, '$2y$10$L0Vz88kRREden9YTvxRVMeCFxiIbc2u4h5nWz/G.MtJwQQu.dmsXK', NULL, '2021-12-12 11:57:10', '2021-12-12 11:57:10'),
(718, 'HAFIJOR RAMAN', 'hafijor13@gmail.com', '01785378068', NULL, 0, 3, NULL, NULL, '$2y$10$SgzoZmCljHjGxNKr.AqRy.784xnbFUsSglMXjvIjQUf6hQlf0sq7u', NULL, '2021-12-12 12:56:02', '2021-12-12 12:56:02'),
(719, 'Azmin arabi', 'azminarabi@gmile.com', '01745126212', NULL, 0, 3, NULL, NULL, '$2y$10$uo3VaGuatKffPOgOmyccQOV9lEztR0JKRTOG1ldRtft1EiKptIQFm', NULL, '2021-12-12 15:10:57', '2021-12-12 15:10:57'),
(720, 'Ritu Das', 'ritukhagrachari97@gmail.com', '01846674740', NULL, 0, 3, NULL, NULL, '$2y$10$PPuXGaTQRiVBjSiaAGSrf.k3tXErd3ocNKXZchOXrds.9BCacu0ya', NULL, '2021-12-13 04:37:08', '2021-12-13 04:37:08'),
(721, 'Samiha chowdhury raisa', 'samihachowdhury1100@gmail.com', '01712493328', NULL, 0, 3, NULL, NULL, '$2y$10$2Z4n0IATG/cOeYf9Lm5wpeoxPQgZIbewzGJG8ogqxyggun2gRkhmm', NULL, '2021-12-13 08:42:22', '2021-12-13 08:42:22'),
(722, 'TASNIM FERDOUS', 'tasnimferdous031@gmail.com', '01517167373', NULL, 0, 3, NULL, NULL, '$2y$10$jgYmRItdy7lxm/BV2IWtqOt18nsHaUrAMfcEIwdRedcxRxO0HlblO', NULL, '2021-12-13 12:10:59', '2021-12-13 12:10:59'),
(723, 'JOY ACHARJEE', 'joyacharjee517724@gmail.com', '01969074431', NULL, 0, 3, NULL, NULL, '$2y$10$DRJPq3kbEspH8hxigUgZy.31QyWI66Ytlk7/nLQMRWrvyJdKD7VNm', NULL, '2021-12-13 12:42:11', '2021-12-13 12:42:11'),
(724, 'Tanvin', 'tanvintanha004@gmail.com', '01764156140', NULL, 0, 3, NULL, NULL, '$2y$10$vzQyJE30xk.tMVffRA2AwejBrPwvy0GOMIi4y7aElLrg8zO54hw6O', NULL, '2021-12-14 13:46:45', '2021-12-14 13:46:45'),
(725, 'MD:Arifur Rahman', 'arifur5836@gmail.com', '01310605836', NULL, 0, 3, NULL, NULL, '$2y$10$qMeeTp5pgJins374DuG.o.AX4ZiC6A5EsXSTB5skjyT8soPfqiw76', NULL, '2021-12-14 15:31:13', '2021-12-14 15:31:13'),
(726, 'Md Lokman Hussain.', 'lokmanhussain356@gmail.com', '01408539127', NULL, 0, 3, NULL, NULL, '$2y$10$f6BHo2x1gGRoBKiSONuQP./L3IokfdncbQtkq04fv3Bj3lBXWVzdq', NULL, '2021-12-14 16:45:25', '2021-12-14 16:45:25'),
(727, 'Ataher Sams', 'ataher.thesis@gmail.com', '01822000089', NULL, 0, 3, NULL, NULL, '$2y$10$bX87U80edPu9rOR1JKMDeO1V0SG9OKU/hmmyYypJRMW9uaq1pPBGC', NULL, '2021-12-19 08:44:25', '2021-12-19 08:44:25'),
(728, 'Test Teacher 1', 'testteacher1@mail.com', '12121212121', NULL, 0, 2, NULL, '/storage/user/gwITqqQysD9btKwM9KD39uc2n451tTVr701WTzbT.jpg', '$2y$10$ZLVOuu7/8J/ug39MzfVF1uq9zhcohb4QmVhDzQKmcUo4vlbbnet/6', NULL, '2022-01-04 07:28:49', '2022-01-04 07:28:49');

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
(1, 'Admin', '2021-10-25 10:11:09', '2021-10-25 10:11:09'),
(2, 'Teacher', '2021-10-25 10:11:09', '2021-10-25 10:11:09'),
(3, 'Student', '2021-10-25 10:11:09', '2021-10-25 10:11:09');

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
-- Indexes for table `aptitude_test_mcqs`
--
ALTER TABLE `aptitude_test_mcqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aptitude_test_mcqs_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignments_exam_id_foreign` (`exam_id`);

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
-- Indexes for table `batch_exams`
--
ALTER TABLE `batch_exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_exams_batch_id_foreign` (`batch_id`),
  ADD KEY `batch_exams_exam_id_foreign` (`exam_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_student_enrollments_batch_id_foreign` (`batch_id`),
  ADD KEY `batch_student_enrollments_payment_id_foreign` (`payment_id`),
  ADD KEY `batch_student_enrollments_course_id_foreign` (`course_id`),
  ADD KEY `batch_student_enrollments_student_id_foreign` (`student_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_author_id_foreign` (`author_id`);

--
-- Indexes for table `completed_lectures`
--
ALTER TABLE `completed_lectures`
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
-- Indexes for table `cq_exam_papers`
--
ALTER TABLE `cq_exam_papers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cq_exam_papers_exam_id_foreign` (`exam_id`),
  ADD KEY `cq_exam_papers_creative_question_id_foreign` (`creative_question_id`),
  ADD KEY `cq_exam_papers_batch_id_foreign` (`batch_id`),
  ADD KEY `cq_exam_papers_student_id_foreign` (`student_id`);

--
-- Indexes for table `creative_questions`
--
ALTER TABLE `creative_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creative_questions_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `c_q_s`
--
ALTER TABLE `c_q_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_q_s_creative_question_id_foreign` (`creative_question_id`);

--
-- Indexes for table `details_results`
--
ALTER TABLE `details_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `details_results_exam_id_foreign` (`exam_id`),
  ADD KEY `details_results_batch_id_foreign` (`batch_id`),
  ADD KEY `details_results_student_id_foreign` (`student_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exams_slug_unique` (`slug`),
  ADD KEY `exams_course_id_foreign` (`course_id`),
  ADD KEY `exams_topic_id_foreign` (`topic_id`);

--
-- Indexes for table `exam_papers`
--
ALTER TABLE `exam_papers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_papers_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_papers_batch_id_foreign` (`batch_id`),
  ADD KEY `exam_papers_student_id_foreign` (`student_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_results_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_results_batch_id_foreign` (`batch_id`),
  ADD KEY `exam_results_student_id_foreign` (`student_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `image_uploads`
--
ALTER TABLE `image_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intermediary_levels`
--
ALTER TABLE `intermediary_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_classes`
--
ALTER TABLE `live_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `live_classes_slug_unique` (`slug`),
  ADD KEY `live_classes_batch_id_foreign` (`batch_id`),
  ADD KEY `live_classes_topic_id_foreign` (`topic_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_c_q_s`
--
ALTER TABLE `m_c_q_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_c_q_s_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- Indexes for table `payment_numbers`
--
ALTER TABLE `payment_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pop_quiz_cqs`
--
ALTER TABLE `pop_quiz_cqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pop_quiz_cqs_creative_question_id_foreign` (`creative_question_id`);

--
-- Indexes for table `pop_quiz_cq_exam_papers`
--
ALTER TABLE `pop_quiz_cq_exam_papers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pop_quiz_cq_exam_papers_exam_id_foreign` (`exam_id`),
  ADD KEY `pop_quiz_cq_exam_papers_creative_question_id_foreign` (`creative_question_id`),
  ADD KEY `pop_quiz_cq_exam_papers_batch_id_foreign` (`batch_id`),
  ADD KEY `pop_quiz_cq_exam_papers_student_id_foreign` (`student_id`);

--
-- Indexes for table `pop_quiz_creative_questions`
--
ALTER TABLE `pop_quiz_creative_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creative_questions_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `pop_quiz_mcqs`
--
ALTER TABLE `pop_quiz_mcqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pop_quiz_mcqs_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `question_content_tags`
--
ALTER TABLE `question_content_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_content_tags_content_tag_id_foreign` (`content_tag_id`);

--
-- Indexes for table `question_content_tag_analyses`
--
ALTER TABLE `question_content_tag_analyses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_content_tag_analyses_content_tag_id_foreign` (`content_tag_id`),
  ADD KEY `question_content_tag_analyses_student_id_foreign` (`student_id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `student_exam_attempts`
--
ALTER TABLE `student_exam_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_exam_attempts_exam_id_foreign` (`exam_id`),
  ADD KEY `student_exam_attempts_student_id_foreign` (`student_id`);

--
-- Indexes for table `topic_end_exam_cqs`
--
ALTER TABLE `topic_end_exam_cqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_end_exam_cqs_creative_question_id_foreign` (`creative_question_id`);

--
-- Indexes for table `topic_end_exam_cq_exam_papers`
--
ALTER TABLE `topic_end_exam_cq_exam_papers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_end_exam_cq_exam_papers_exam_id_foreign` (`exam_id`),
  ADD KEY `topic_end_exam_cq_exam_papers_creative_question_id_foreign` (`creative_question_id`),
  ADD KEY `topic_end_exam_cq_exam_papers_batch_id_foreign` (`batch_id`),
  ADD KEY `topic_end_exam_cq_exam_papers_student_id_foreign` (`student_id`);

--
-- Indexes for table `topic_end_exam_creative_questions`
--
ALTER TABLE `topic_end_exam_creative_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creative_questions_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `topic_end_exam_mcqs`
--
ALTER TABLE `topic_end_exam_mcqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_end_exam_mcqs_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17045;

--
-- AUTO_INCREMENT for table `aptitude_test_mcqs`
--
ALTER TABLE `aptitude_test_mcqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3546;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `batch_exams`
--
ALTER TABLE `batch_exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `batch_lectures`
--
ALTER TABLE `batch_lectures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `batch_student_enrollments`
--
ALTER TABLE `batch_student_enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=478;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `completed_lectures`
--
ALTER TABLE `completed_lectures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `content_tags`
--
ALTER TABLE `content_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2528;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `course_categories`
--
ALTER TABLE `course_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `course_lectures`
--
ALTER TABLE `course_lectures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=445;

--
-- AUTO_INCREMENT for table `course_topics`
--
ALTER TABLE `course_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `cq_exam_papers`
--
ALTER TABLE `cq_exam_papers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `creative_questions`
--
ALTER TABLE `creative_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `c_q_s`
--
ALTER TABLE `c_q_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=850;

--
-- AUTO_INCREMENT for table `details_results`
--
ALTER TABLE `details_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19436;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `exam_papers`
--
ALTER TABLE `exam_papers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=812;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_uploads`
--
ALTER TABLE `image_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `intermediary_levels`
--
ALTER TABLE `intermediary_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `live_classes`
--
ALTER TABLE `live_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `m_c_q_s`
--
ALTER TABLE `m_c_q_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3527;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=574;

--
-- AUTO_INCREMENT for table `payment_numbers`
--
ALTER TABLE `payment_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pop_quiz_cqs`
--
ALTER TABLE `pop_quiz_cqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=950;

--
-- AUTO_INCREMENT for table `pop_quiz_cq_exam_papers`
--
ALTER TABLE `pop_quiz_cq_exam_papers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `pop_quiz_creative_questions`
--
ALTER TABLE `pop_quiz_creative_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `pop_quiz_mcqs`
--
ALTER TABLE `pop_quiz_mcqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `question_content_tags`
--
ALTER TABLE `question_content_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9091;

--
-- AUTO_INCREMENT for table `question_content_tag_analyses`
--
ALTER TABLE `question_content_tag_analyses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21636;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_exam_attempts`
--
ALTER TABLE `student_exam_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `topic_end_exam_cqs`
--
ALTER TABLE `topic_end_exam_cqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=926;

--
-- AUTO_INCREMENT for table `topic_end_exam_cq_exam_papers`
--
ALTER TABLE `topic_end_exam_cq_exam_papers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `topic_end_exam_creative_questions`
--
ALTER TABLE `topic_end_exam_creative_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `topic_end_exam_mcqs`
--
ALTER TABLE `topic_end_exam_mcqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=729;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aptitude_test_mcqs`
--
ALTER TABLE `aptitude_test_mcqs`
  ADD CONSTRAINT `aptitude_test_mcqs_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `batches`
--
ALTER TABLE `batches`
  ADD CONSTRAINT `batches_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batches_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `batch_exams`
--
ALTER TABLE `batch_exams`
  ADD CONSTRAINT `batch_exams_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batch_exams_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `batch_lectures`
--
ALTER TABLE `batch_lectures`
  ADD CONSTRAINT `batch_lectures_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batch_lectures_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batch_lectures_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `course_topics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `batch_student_enrollments`
--
ALTER TABLE `batch_student_enrollments`
  ADD CONSTRAINT `batch_student_enrollments_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batch_student_enrollments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batch_student_enrollments_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batch_student_enrollments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `cq_exam_papers`
--
ALTER TABLE `cq_exam_papers`
  ADD CONSTRAINT `cq_exam_papers_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cq_exam_papers_creative_question_id_foreign` FOREIGN KEY (`creative_question_id`) REFERENCES `creative_questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cq_exam_papers_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cq_exam_papers_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `creative_questions`
--
ALTER TABLE `creative_questions`
  ADD CONSTRAINT `creative_questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `c_q_s`
--
ALTER TABLE `c_q_s`
  ADD CONSTRAINT `c_q_s_creative_question_id_foreign` FOREIGN KEY (`creative_question_id`) REFERENCES `creative_questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `details_results`
--
ALTER TABLE `details_results`
  ADD CONSTRAINT `details_results_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `details_results_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `details_results_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exams_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `course_topics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_papers`
--
ALTER TABLE `exam_papers`
  ADD CONSTRAINT `exam_papers_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_papers_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_papers_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD CONSTRAINT `exam_results_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_results_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_results_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `live_classes`
--
ALTER TABLE `live_classes`
  ADD CONSTRAINT `live_classes_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `live_classes_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `course_topics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `m_c_q_s`
--
ALTER TABLE `m_c_q_s`
  ADD CONSTRAINT `m_c_q_s_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pop_quiz_cqs`
--
ALTER TABLE `pop_quiz_cqs`
  ADD CONSTRAINT `pop_quiz_cqs_pop_quiz_creative_question_id_foreign` FOREIGN KEY (`creative_question_id`) REFERENCES `pop_quiz_creative_questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pop_quiz_cq_exam_papers`
--
ALTER TABLE `pop_quiz_cq_exam_papers`
  ADD CONSTRAINT `pop_quiz_cq_exam_papers_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pop_quiz_cq_exam_papers_creative_question_id_foreign` FOREIGN KEY (`creative_question_id`) REFERENCES `pop_quiz_creative_questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pop_quiz_cq_exam_papers_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pop_quiz_cq_exam_papers_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pop_quiz_creative_questions`
--
ALTER TABLE `pop_quiz_creative_questions`
  ADD CONSTRAINT `pop_quiz_creative_questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pop_quiz_mcqs`
--
ALTER TABLE `pop_quiz_mcqs`
  ADD CONSTRAINT `pop_quiz_mcqs_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`);

--
-- Constraints for table `question_content_tags`
--
ALTER TABLE `question_content_tags`
  ADD CONSTRAINT `question_content_tags_content_tag_id_foreign` FOREIGN KEY (`content_tag_id`) REFERENCES `content_tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_content_tag_analyses`
--
ALTER TABLE `question_content_tag_analyses`
  ADD CONSTRAINT `question_content_tag_analyses_content_tag_id_foreign` FOREIGN KEY (`content_tag_id`) REFERENCES `content_tags` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_content_tag_analyses_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_details`
--
ALTER TABLE `student_details`
  ADD CONSTRAINT `student_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_exam_attempts`
--
ALTER TABLE `student_exam_attempts`
  ADD CONSTRAINT `student_exam_attempts_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_exam_attempts_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `topic_end_exam_cqs`
--
ALTER TABLE `topic_end_exam_cqs`
  ADD CONSTRAINT `topic_end_exam_cqs_topic_end_exam_creative_question_id_foreign` FOREIGN KEY (`creative_question_id`) REFERENCES `topic_end_exam_creative_questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `topic_end_exam_cq_exam_papers`
--
ALTER TABLE `topic_end_exam_cq_exam_papers`
  ADD CONSTRAINT `topic_end_exam_cq_exam_papers_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `topic_end_exam_cq_exam_papers_creative_question_id_foreign` FOREIGN KEY (`creative_question_id`) REFERENCES `topic_end_exam_creative_questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `topic_end_exam_cq_exam_papers_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `topic_end_exam_cq_exam_papers_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `topic_end_exam_creative_questions`
--
ALTER TABLE `topic_end_exam_creative_questions`
  ADD CONSTRAINT `topic_end_exam_creative_questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`);

--
-- Constraints for table `topic_end_exam_mcqs`
--
ALTER TABLE `topic_end_exam_mcqs`
  ADD CONSTRAINT `topic_end_exam_mcqs_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
