-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2026 at 02:25 PM
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
-- Database: `uppgo`
--

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2026_03_02_222817_create_users_table', 1),
(3, '2026_03_02_223343_create_nations_table', 1),
(4, '2026_03_02_225707_create_nation_user_table', 1),
(5, '2026_03_04_120134_create_password_resets_table', 2),
(6, '2026_03_06_000755_add_event_interests_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nations`
--

CREATE TABLE `nations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nations`
--

INSERT INTO `nations` (`id`, `name`, `slug`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'Stockholms nation', 'stockholms-nation', 1, 0, '2026-03-04 08:41:06', '2026-03-04 08:41:06'),
(2, 'Uplands nation', 'uplands-nation', 1, 0, '2026-03-04 08:41:06', '2026-03-04 08:41:06'),
(3, 'Gästrike-Hälsinge nation', 'gastrike-halsinge-nation', 1, 0, '2026-03-04 08:41:06', '2026-03-04 08:41:06'),
(4, 'Östgöta nation', 'ostgota-nation', 1, 0, '2026-03-04 08:41:06', '2026-03-04 08:41:06'),
(5, 'Västgöta nation', 'vastgota-nation', 1, 0, '2026-03-04 08:41:06', '2026-03-04 08:41:06'),
(6, 'Södermanlands-Nerikes nation', 'sodermanlands-nerikes-nation', 1, 0, '2026-03-04 08:41:06', '2026-03-04 08:41:06'),
(7, 'Västmanlands-Dala nation', 'vastmanlands-dala-nation', 1, 0, '2026-03-04 08:41:06', '2026-03-04 08:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `nation_user`
--

CREATE TABLE `nation_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nation_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(1, 'user1@example.com', '$2y$10$enuH8f3cg2Us.JuHlV5zwOY4nUPO94l/dOdO4R7wNDNujpFLeAjIy', '2026-03-04 11:18:30'),
(14, 'user@example.com', '$2y$10$opOz0WLZVph6xjn4r2fnte.uCqqRA/z9eRYZWtnDkuEQTs3ruw2FC', '2026-03-05 03:33:21'),
(20, 'user3@example.com', '$2y$10$uyPCMKsYHDWlVv3xePDgJ.pWL9EFnr9br6Z5uhpzqHcZUM.ln4DHm', '2026-03-05 21:26:33'),
(22, 'user5@example.com', '$2y$10$lWwxNPuNVlyHxoL0u0aFNueh9E4frco7oiBcWXURiFu1zPWmojymq', '2026-03-06 06:25:05');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_category` enum('nation','non_nation') NOT NULL,
  `event_interests` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`event_interests`)),
  `image_path` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `email_verified_at`, `password`, `user_category`, `event_interests`, `image_path`, `active`, `deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'UppGo Admin', 'admin@example.com', NULL, '$2y$10$zP8zjgWpeDlYiq2lhBUtRuSkctToAuGP1CB5E9fQjPglm0w6e31si', 'non_nation', NULL, NULL, 1, 0, NULL, '2026-03-04 08:41:06', '2026-03-04 08:41:06'),
(2, 'user', 'User', 'user@example.com', NULL, '$2y$10$ZN1TV/u0GxX5NOq8wb0YvujVIICdfpUp64/da18hEwvOxtMUOzCOG', 'nation', NULL, '1772622322_69a811f2a39b7.png', 1, 0, NULL, '2026-03-04 08:43:14', '2026-03-04 10:12:27'),
(3, 'user', 'User', 'user1@example.com', NULL, '$2y$10$6XqJxYFlM7PYptz1RAR8/OnbbnFIvnudxmPAP2L21EPTXDeomAB4C', 'nation', NULL, NULL, 1, 0, NULL, '2026-03-04 11:13:57', '2026-03-04 11:15:38'),
(4, 'user', 'User3', 'iamhaizam786@gmail.com', NULL, '$2y$10$2sg0FtbuE1RbUnI9lFcj6eIrrEeQ7d2tpIHEWCx9hYq/nWZ7zw666', 'nation', '[\"Food\"]', '1772786372_69aa92c43b75c.png', 1, 0, 'nmMBgVrMFaSQDNr6X50BiOReH5dDWeb6epZqyutk1TE7BX7gJ01kZrG0tKcP', '2026-03-04 11:21:24', '2026-03-06 07:39:32'),
(5, 'user', 'User2', 'user2@example.com', NULL, '$2y$10$b/qT1OZP9zGjwvg8SDlG9OXAF1meTE.3QU6XGrIY7OkKGyanJOsa6', 'nation', NULL, '1772735038_69a9ca3e4a82f.png', 1, 0, NULL, '2026-03-05 16:59:31', '2026-03-05 17:23:58'),
(6, 'user', 'User3', 'user3@example.com', NULL, '$2y$10$tIF/Vh8H3JdeJvitg75iNesJawMPROK92Xos5UMtuMTPERRSdKyYW', 'nation', NULL, '1772747597_69a9fb4d19f5d.png', 1, 0, NULL, '2026-03-05 18:04:33', '2026-03-05 20:53:17'),
(7, 'user', 'Usman', 'usman@example.com', NULL, '$2y$10$P3NonzVVfPi5ZPuzAgO9M.8Uh9fI6X/8MJRoWXW9JMGdVX2.02Ea6', 'non_nation', NULL, '1772751681_69aa0b41ed7c7.png', 1, 0, NULL, '2026-03-05 22:00:41', '2026-03-05 22:01:21'),
(8, 'user', 'User 5', 'user5@example.com', NULL, '$2y$10$dd1yD7BC8CPChjqUigbAEeuym9/is5zdu4XKtj.IQ.DFOw7yckvP6', 'non_nation', '[\"Food\",\"Sports\",\"Music\",\"Art\",\"Networking\"]', NULL, 1, 0, NULL, '2026-03-05 23:15:06', '2026-03-05 23:15:06'),
(9, 'user', 'User 6', 'User6@example.com', NULL, '$2y$10$Arehc3y56ZpoaLbdkwq4XOoG444cVP4TPUFw8bmqBhtIg/4TgC1h.', 'nation', '[\"Sports\",\"Music\"]', NULL, 1, 0, NULL, '2026-03-06 07:21:46', '2026-03-06 07:21:46'),
(10, 'user', 'Shakik', 'shakik@example.com', NULL, '$2y$10$HOYKnBwaoFATAshc2b1JCeFyXq6c.s0feq5ihUOrxLYZg0ScrBGki', 'nation', '[\"Music\",\"Art\"]', '1772786783_69aa945f8f580.jpeg', 1, 0, 'MKZjZrBqrOjR76sawiKV5mpEsgs6h1yzG8WbbrhRdA2GYioQmiUP8Au94ITd', '2026-03-06 07:45:14', '2026-03-06 07:55:26'),
(11, 'user', 'User7', 'user7@example.com', NULL, '$2y$10$hPidPcfUx3VhFFtqLvik4OhzXCxEv8oaY.5fpOn9fhRd8Lf2AXFkO', 'nation', '[\"Sports\"]', '1772789222_69aa9de6cb88d.png', 1, 0, 'Jb4GkYtTJYTEQm1pXAFV94S74jlmF8YpLeQirnSWexG8CVRHQxIoZM2uWEEH', '2026-03-06 08:25:59', '2026-03-06 08:28:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nations`
--
ALTER TABLE `nations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nations_name_unique` (`name`),
  ADD UNIQUE KEY `nations_slug_unique` (`slug`);

--
-- Indexes for table `nation_user`
--
ALTER TABLE `nation_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nation_user_nation_id_user_id_unique` (`nation_id`,`user_id`),
  ADD KEY `nation_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nations`
--
ALTER TABLE `nations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nation_user`
--
ALTER TABLE `nation_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nation_user`
--
ALTER TABLE `nation_user`
  ADD CONSTRAINT `nation_user_nation_id_foreign` FOREIGN KEY (`nation_id`) REFERENCES `nations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nation_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
