-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2024 at 04:27 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scale`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
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
-- Table structure for table `holland_personas`
--

CREATE TABLE `holland_personas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_score` int(11) NOT NULL,
  `second_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_score` int(11) NOT NULL,
  `third_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_score` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holland_personas`
--

INSERT INTO `holland_personas` (`id`, `user_id`, `first_type`, `first_score`, `second_type`, `second_score`, `third_type`, `third_score`, `created_at`, `updated_at`) VALUES
(1, 1, 'S', 40, 'A', 39, 'I', 37, '2024-10-22 14:31:24', '2024-10-22 14:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `holland_test_results`
--

CREATE TABLE `holland_test_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question_number` int(11) NOT NULL,
  `question_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holland_test_results`
--

INSERT INTO `holland_test_results` (`id`, `user_id`, `question_number`, `question_text`, `category`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'يستهويني العمل على ماكينة في خط إنتاج ومراقبة أدائها.', 'R', 1, '2024-10-22 12:34:42', '2024-10-22 12:34:42'),
(2, 1, 2, 'غالبًا ما أحاول إصلاح الأجهزة المنزلية بنفسي.', 'R', 3, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(3, 1, 3, 'من الممتع قيادة شاحنة نقل بضائع لإيصال الطلبات إلى المكاتب والمنازل.', 'R', 3, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(4, 1, 4, 'يستهويني العناية بالحيوانات الأليفة وتربيتها.', 'R', 3, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(5, 1, 5, 'أفضل طلاء جدار المنزل بنفسي عوضًا عن أجلب أحدًا من الخارج، أشعر بأنني سأتقن العمل أفضل منه.', 'R', 3, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(6, 1, 6, 'أحب أن أتعلم وأتعمق في فهم النظريات العلمية.', 'I', 3, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(7, 1, 7, 'أهتم كثيرًا بالتعمق في شخصيات قادة العالم.', 'I', 8, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(8, 1, 8, 'من المثير أن أعمل في مجالات التحقيق حول الجرائم وما شابهها.', 'I', 8, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(9, 1, 9, 'أستمتع كثيرًا بحل المسائل الرياضية والألغاز.', 'I', 8, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(10, 1, 10, 'تجذبني الأمور الغامضة وأحب مشاهدة أفلام وثائقية عنها.', 'I', 7, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(11, 1, 11, 'يستهويني تمثيل مشهد على مسرح أو برنامج يوتيوبي.', 'A', 7, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(12, 1, 12, 'أحب جمع الأعمال الفنية والاحتفاظ بها.', 'A', 8, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(13, 1, 13, 'من المثير المشاركة في كتابة سيناريو لفيلم أو برنامج تلفزيوني.', 'A', 8, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(14, 1, 14, 'أهتم بحضور الحفلات الفنية وزيارة المعارض والمتاحف.', 'A', 6, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(15, 1, 15, 'تجذبني الألحان الموسيقية والمقطوعات الغنائية أو الإنشادية بشكل كبير.', 'A', 9, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(16, 1, 16, 'أحب أن أكون أحد أفراد الفرق التي تقوم بتنظيم المناسبات الاجتماعية.', 'S', 10, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(17, 1, 17, 'أفضل العمل في الأماكن التي أستطيع من خلالها خدمة الآخرين ومساعدتهم.', 'S', 9, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(18, 1, 18, 'أهتم بالأعمال التطوعية مع الجهات والمجموعات في خدمة المجتمع.', 'S', 6, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(19, 1, 19, 'أفضل المجالات التي تهتم بممارسة أعمال التدريس والتدريب.', 'S', 9, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(20, 1, 20, 'أفضل أن أدير حلقات النقاش والحوار مع الآخرين.', 'S', 10, '2024-10-22 12:34:43', '2024-10-22 12:34:43'),
(21, 1, 21, 'أفضل العمل في إدارة سوق يختص ببيع الجملة.', 'E', 7, '2024-10-22 12:34:44', '2024-10-22 12:34:44'),
(22, 1, 22, 'تستهويني الأعمال الخاصة بالتسويق والمبيعات.', 'E', 10, '2024-10-22 12:34:44', '2024-10-22 12:34:44'),
(23, 1, 23, 'أفضل مقابلة الشخصيات الهامة والاجتماع معهم.', 'E', 8, '2024-10-22 12:34:44', '2024-10-22 12:34:44'),
(24, 1, 24, 'أعمل دائمًا على إقناع الآخرين بأفكاري، وأصر على تحقيقها.', 'E', 8, '2024-10-22 12:34:44', '2024-10-22 12:34:44'),
(25, 1, 25, 'أستطيع أن أتفاوض بشكل جيد جدًا عندما أعمل على اتفاقيات ما.', 'E', 7, '2024-10-22 12:34:44', '2024-10-22 12:34:44'),
(26, 1, 26, 'أستطيع أن أرتب وأنظم الملفات المكتبية، وأصنفها وأحفظها بشكل جيد.', 'C', 7, '2024-10-22 12:34:44', '2024-10-22 12:34:44'),
(27, 1, 27, 'غالبًا ما أقوم بتدوين الملاحظات أثناء الاجتماعات.', 'C', 6, '2024-10-22 12:34:44', '2024-10-22 12:34:44'),
(28, 1, 28, 'غالبًا ما أقوم بمراجعة وتصحيح السجلات والنماذج.', 'C', 7, '2024-10-22 12:34:44', '2024-10-22 12:34:44'),
(29, 1, 29, 'تستهويني أعمال الطباعة وإدخال البيانات على الكمبيوتر.', 'C', 9, '2024-10-22 12:34:44', '2024-10-22 12:34:44'),
(30, 1, 30, 'يمكنني تنظيم وجدولة الاجتماعات بشكل جيد لمختلف الإدارات التي أعمل معها.', 'C', 9, '2024-10-22 12:34:44', '2024-10-22 12:34:44'),
(61, 1, 1, 'يستهويني العمل على ماكينة في خط إنتاج ومراقبة أدائها.', 'R', 1, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(62, 1, 2, 'غالبًا ما أحاول إصلاح الأجهزة المنزلية بنفسي.', 'R', 1, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(63, 1, 3, 'من الممتع قيادة شاحنة نقل بضائع لإيصال الطلبات إلى المكاتب والمنازل.', 'R', 6, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(64, 1, 4, 'يستهويني العناية بالحيوانات الأليفة وتربيتها.', 'R', 4, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(65, 1, 5, 'أفضل طلاء جدار المنزل بنفسي عوضًا عن أجلب أحدًا من الخارج، أشعر بأنني سأتقن العمل أفضل منه.', 'R', 5, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(66, 1, 6, 'أحب أن أتعلم وأتعمق في فهم النظريات العلمية.', 'I', 8, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(67, 1, 7, 'أهتم كثيرًا بالتعمق في شخصيات قادة العالم.', 'I', 6, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(68, 1, 8, 'من المثير أن أعمل في مجالات التحقيق حول الجرائم وما شابهها.', 'I', 6, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(69, 1, 9, 'أستمتع كثيرًا بحل المسائل الرياضية والألغاز.', 'I', 7, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(70, 1, 10, 'تجذبني الأمور الغامضة وأحب مشاهدة أفلام وثائقية عنها.', 'I', 10, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(71, 1, 11, 'يستهويني تمثيل مشهد على مسرح أو برنامج يوتيوبي.', 'A', 8, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(72, 1, 12, 'أحب جمع الأعمال الفنية والاحتفاظ بها.', 'A', 9, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(73, 1, 13, 'من المثير المشاركة في كتابة سيناريو لفيلم أو برنامج تلفزيوني.', 'A', 8, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(74, 1, 14, 'أهتم بحضور الحفلات الفنية وزيارة المعارض والمتاحف.', 'A', 9, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(75, 1, 15, 'تجذبني الألحان الموسيقية والمقطوعات الغنائية أو الإنشادية بشكل كبير.', 'A', 5, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(76, 1, 16, 'أحب أن أكون أحد أفراد الفرق التي تقوم بتنظيم المناسبات الاجتماعية.', 'S', 10, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(77, 1, 17, 'أفضل العمل في الأماكن التي أستطيع من خلالها خدمة الآخرين ومساعدتهم.', 'S', 7, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(78, 1, 18, 'أهتم بالأعمال التطوعية مع الجهات والمجموعات في خدمة المجتمع.', 'S', 10, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(79, 1, 19, 'أفضل المجالات التي تهتم بممارسة أعمال التدريس والتدريب.', 'S', 5, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(80, 1, 20, 'أفضل أن أدير حلقات النقاش والحوار مع الآخرين.', 'S', 8, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(81, 1, 21, 'أفضل العمل في إدارة سوق يختص ببيع الجملة.', 'E', 4, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(82, 1, 22, 'تستهويني الأعمال الخاصة بالتسويق والمبيعات.', 'E', 4, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(83, 1, 23, 'أفضل مقابلة الشخصيات الهامة والاجتماع معهم.', 'E', 3, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(84, 1, 24, 'أعمل دائمًا على إقناع الآخرين بأفكاري، وأصر على تحقيقها.', 'E', 5, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(85, 1, 25, 'أستطيع أن أتفاوض بشكل جيد جدًا عندما أعمل على اتفاقيات ما.', 'E', 4, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(86, 1, 26, 'أستطيع أن أرتب وأنظم الملفات المكتبية، وأصنفها وأحفظها بشكل جيد.', 'C', 5, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(87, 1, 27, 'غالبًا ما أقوم بتدوين الملاحظات أثناء الاجتماعات.', 'C', 8, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(88, 1, 28, 'غالبًا ما أقوم بمراجعة وتصحيح السجلات والنماذج.', 'C', 4, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(89, 1, 29, 'تستهويني أعمال الطباعة وإدخال البيانات على الكمبيوتر.', 'C', 7, '2024-10-22 14:31:24', '2024-10-22 14:31:24'),
(90, 1, 30, 'يمكنني تنظيم وجدولة الاجتماعات بشكل جيد لمختلف الإدارات التي أعمل معها.', 'C', 8, '2024-10-22 14:31:24', '2024-10-22 14:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_22_144959_create_holland_test_results_table', 2),
(5, '2024_10_22_172028_create_holland_personas_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ZEEbMg0gTXhSTEI31MFuMXcAkzXUR92oP62uLW7P', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYk11U1ZwVGQySGdzS0d4VVZTbXRzV0xLcnV3Nm11aGFlWk5wNTNLOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zY2FsZS9ob2xsYW5kIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1729618284);

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'a', 'admin@admin.com', NULL, '$2y$12$6qGOkGUELTtX0rBoniPTS.zPQoTc2B9L1vRQ4JQqF.He8ci/jfg86', NULL, '2024-10-22 11:49:18', '2024-10-22 11:49:18');

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `holland_personas`
--
ALTER TABLE `holland_personas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `holland_personas_user_id_foreign` (`user_id`);

--
-- Indexes for table `holland_test_results`
--
ALTER TABLE `holland_test_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `holland_test_results_user_id_foreign` (`user_id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holland_personas`
--
ALTER TABLE `holland_personas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `holland_test_results`
--
ALTER TABLE `holland_test_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `holland_personas`
--
ALTER TABLE `holland_personas`
  ADD CONSTRAINT `holland_personas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `holland_test_results`
--
ALTER TABLE `holland_test_results`
  ADD CONSTRAINT `holland_test_results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
