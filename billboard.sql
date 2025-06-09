-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2025 at 06:27 AM
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
-- Database: `billboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `billboards`
--

CREATE TABLE `billboards` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `dimensions` varchar(100) DEFAULT NULL,
  `daily_rate` decimal(10,2) NOT NULL,
  `weekly_rate` decimal(10,2) DEFAULT NULL,
  `monthly_rate` decimal(10,2) DEFAULT NULL,
  `billboard_type_id` int(11) DEFAULT NULL,
  `status` enum('available','booked','maintenance') DEFAULT 'available',
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billboards`
--

INSERT INTO `billboards` (`id`, `owner_id`, `title`, `description`, `location`, `dimensions`, `daily_rate`, `weekly_rate`, `monthly_rate`, `billboard_type_id`, `status`, `features`, `created_at`, `updated_at`) VALUES
(8, NULL, 'railway park', NULL, 'attock', NULL, 500.00, NULL, NULL, NULL, 'available', NULL, '2025-03-15 05:57:28', '2025-03-15 05:57:28'),
(9, NULL, 'Billboard 1', NULL, 'Bata Stop', NULL, 10.00, NULL, NULL, NULL, 'available', NULL, '2025-04-07 05:36:19', '2025-04-07 05:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `billboard_images`
--

CREATE TABLE `billboard_images` (
  `id` int(11) NOT NULL,
  `billboard_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_primary` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billboard_types`
--

CREATE TABLE `billboard_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billboard_types`
--

INSERT INTO `billboard_types` (`id`, `type_name`, `description`) VALUES
(1, 'Digital', 'Electronic billboards that display digital images that can be changed remotely.'),
(2, 'Traditional', 'Static billboards with printed advertisements.'),
(3, 'Mobile', 'Advertisements placed on vehicles or portable structures.');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `advertiser_id` int(11) NOT NULL,
  `billboard_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `ad_message` text NOT NULL,
  `content_url` varchar(255) DEFAULT NULL,
  `payment_status` enum('unpaid','paid','refunded') DEFAULT 'unpaid',
  `payment_method` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `advertiser_id`, `billboard_id`, `start_date`, `end_date`, `total_cost`, `ad_message`, `content_url`, `payment_status`, `payment_method`, `transaction_id`, `notes`, `created_at`, `updated_at`, `status`) VALUES
(15, 9, 8, '2025-03-12', '2025-03-27', 7500.00, 'hello', '../assets/uploads/download (6).png', 'unpaid', NULL, NULL, NULL, '2025-03-23 14:25:40', '2025-03-23 14:26:00', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `contact_submissions`
--

CREATE TABLE `contact_submissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_submissions`
--

INSERT INTO `contact_submissions` (`id`, `name`, `email`, `contact_number`, `message`, `created_at`) VALUES
(1, 'Usman Zafar', 'usmanzafarofficial125@gmail.com', '', 'hello', '2025-03-09 02:49:34'),
(2, 'Usman Zafar', 'usmanzafarofficial125@gmail.com', '', 'i want to advertise', '2025-03-09 02:49:45'),
(3, 'Usman Zafar', 'usmanzafarofficial125@gmail.com', '03205665222', 'hi', '2025-03-09 02:54:37'),
(4, 'Usman Zafar', 'usmanzafarofficial125@gmail.com', '03205665222', 'hi', '2025-03-09 02:56:25'),
(5, 'Usman Zafar', 'usmanzafarofficial125@gmail.com', '03205665395', 'hellloo', '2025-03-09 05:37:45'),
(6, 'Usman Zafar', 'usmanzafarofficial125@gmail.com', '03205665392', 'hello i want to  advertise', '2025-03-12 11:32:01');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`, `is_read`) VALUES
(39, 8, 9, 'hello a', '2025-03-15 11:38:59', 1),
(40, 9, 8, 'hey owner', '2025-03-15 11:39:10', 1),
(41, 8, 9, 'i want to list the advertisment\r\n', '2025-03-15 11:39:50', 1),
(42, 9, 8, 'ok where\r\n', '2025-03-15 11:39:59', 1),
(43, 9, 8, 'hello sir', '2025-03-15 11:51:39', 1),
(44, 8, 9, 'hey', '2025-03-15 11:51:55', 1),
(45, 9, 8, 'how are you', '2025-03-15 11:52:06', 1),
(46, 8, 9, 'i want to book a billboard', '2025-03-15 11:52:27', 1),
(47, 9, 8, 'ok when', '2025-03-15 11:52:35', 1),
(48, 8, 9, 'hello a how are you', '2025-03-23 15:40:14', 1),
(49, 9, 8, 'hey owner i am fine', '2025-03-23 15:40:29', 1),
(50, 8, 9, 'hello\r\n', '2025-04-07 04:57:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `billboard_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `profile_image` varchar(255) DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `company_name`, `user_type_id`, `is_admin`, `profile_image`, `verification_token`, `is_verified`, `reset_token`, `reset_token_expiry`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, '2025-03-08 02:17:38', '2025-03-08 02:17:38'),
(5, 'admin', 'admin@gmail.com', '$2y$10$RNM6fT9eKdGbo6leP2SuIeq56ZqJ9qHkMObEvGdd9lPZxDYLkDPEq', 's', 's', 2, 0, NULL, NULL, 0, NULL, NULL, NULL, '2025-03-08 17:31:23', '2025-03-08 17:31:23'),
(7, 'owner', 'owner@gmail.com', '$2y$10$FvyexGvYDQ.r6MDmupeQzejQl2eHs3SNuX2EPKHV.vpbXLxQSfxau', NULL, NULL, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, '2025-03-09 03:13:14', '2025-03-09 03:13:14'),
(8, 'o', 'o@gmail.com', '$2y$10$Mn8ByQ39Dqt2sia9qyBOA.azn1OgkOURQi4CntnBMP0wX9qILXVM.', NULL, NULL, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, '2025-03-09 05:53:15', '2025-03-09 05:53:15'),
(9, 'a', 'a@gmail.com', '$2y$10$KAhRIEHF8JVgjoVavxikG.Sfff4z2xKXgGzNZhtpo2fWs7TSfrrYW', NULL, NULL, 2, 0, NULL, NULL, 0, NULL, NULL, NULL, '2025-03-09 05:54:16', '2025-03-25 10:52:57'),
(11, 'you', 'you@gmail.com', '$2y$10$LMqbatEIyEybG13svsWBO.4jPYtDSs4oKWBZdAgkWIqKXqFoTI8wS', NULL, NULL, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, '2025-03-12 11:30:37', '2025-03-15 11:50:15'),
(14, 'namse', 'namse@gmail.com', '$2y$10$GY4IAogtQ6ZKuv/PFd4vXOITVOT5FrWSWOa1zC6XvcB83YZbXIV6e', NULL, NULL, 2, 0, NULL, NULL, 0, NULL, NULL, NULL, '2025-03-15 05:55:50', '2025-03-15 05:55:50'),
(16, 'main', 'main@gmail.com', '$2y$10$71q7Nfg4OmIOSY3c9t8i8.2We1ME6WiCygSZgItTNgUZFG8gHIrQi', NULL, NULL, 3, 0, NULL, NULL, 0, NULL, NULL, NULL, '2025-03-15 07:31:43', '2025-03-15 07:31:43'),
(17, 'nomi', 'nomi@gmail.com', '$2y$10$9dt.D6HDw2t.DwbK5644.u093trIOHiFh74POOf8Z8Ct9MVrjSEzq', NULL, NULL, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, '2025-03-15 07:32:50', '2025-03-15 07:32:50'),
(18, 'ne', 'ne@gmail.com', '$2y$10$rAvwx/ltsTVn27TWNMGndemvPoqq99Qx.5aYzHdMj9W6QPVZeJBpO', NULL, NULL, 2, 0, NULL, NULL, 0, NULL, NULL, NULL, '2025-03-15 08:12:48', '2025-03-15 08:12:48'),
(19, 'wahab', 'wahab@gmail.com', '$2y$10$LivKpDhFjA0afmHn9oDKouBWd1Z6qwJW5cT5q/7fUTli1tv7ekd0y', NULL, NULL, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, '2025-03-15 08:17:24', '2025-03-15 08:17:24'),
(20, 'new', 'new@gmail.com', '$2y$10$VBUjPNo0sy5CHQ9kbXXoyuuKHcJ5dDEIiIOWyQjlwK5cEUbAQ/QlS', NULL, NULL, 2, 0, NULL, NULL, 0, NULL, NULL, NULL, '2025-03-15 11:50:43', '2025-03-15 11:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `type_name`) VALUES
(3, 'Admin'),
(2, 'advertiser'),
(1, 'billboard_owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billboards`
--
ALTER TABLE `billboards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billboard_type_id` (`billboard_type_id`),
  ADD KEY `billboards_ibfk_1` (`owner_id`);

--
-- Indexes for table `billboard_images`
--
ALTER TABLE `billboard_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billboard_id` (`billboard_id`);

--
-- Indexes for table `billboard_types`
--
ALTER TABLE `billboard_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertiser_id` (`advertiser_id`),
  ADD KEY `billboard_id` (`billboard_id`);

--
-- Indexes for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `messages_ibfk_2` (`receiver_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `billboard_id` (`billboard_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_name` (`type_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billboards`
--
ALTER TABLE `billboards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `billboard_images`
--
ALTER TABLE `billboard_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billboard_types`
--
ALTER TABLE `billboard_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billboards`
--
ALTER TABLE `billboards`
  ADD CONSTRAINT `billboards_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `billboards_ibfk_2` FOREIGN KEY (`billboard_type_id`) REFERENCES `billboard_types` (`id`);

--
-- Constraints for table `billboard_images`
--
ALTER TABLE `billboard_images`
  ADD CONSTRAINT `billboard_images_ibfk_1` FOREIGN KEY (`billboard_id`) REFERENCES `billboards` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`advertiser_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`billboard_id`) REFERENCES `billboards` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`billboard_id`) REFERENCES `billboards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
