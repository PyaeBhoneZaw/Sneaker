-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 08:59 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sneaker`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `created_at`, `updated_at`) VALUES
(1, 'Nike', '2024-01-17 10:33:37', '2024-01-17 10:33:37'),
(2, 'Adidas', '2024-01-17 10:33:37', '2024-01-17 10:33:37'),
(3, 'Air Jordan', '2024-01-17 10:33:37', '2024-01-17 10:33:37'),
(4, 'Vans', '2024-01-17 10:33:37', '2024-01-17 10:33:37'),
(5, 'New Balance', '2024-01-18 00:25:12', '2024-01-18 00:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shoe_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shoe_name` varchar(255) NOT NULL,
  `shoe_model` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `price` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nyein', 'nyein@gmail.com', 'User friendly', '2024-01-18 01:27:01', '2024-01-18 01:27:01');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_11_17_110655_create_shoes_table', 1),
(7, '2023_11_19_182415_create_brands_table', 1),
(8, '2023_11_19_184938_create_shoe_models_table', 1),
(9, '2024_01_02_065415_create_carts_table', 1),
(10, '2024_01_02_170959_create_orders_table', 1),
(11, '2024_01_02_183511_create_order_details_table', 1),
(12, '2024_01_09_095448_create_contacts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `orderDate` varchar(255) NOT NULL,
  `shoe_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `firstName`, `lastName`, `email`, `phone`, `address`, `orderDate`, `shoe_name`, `price`, `quantity`, `payment_type`, `created_at`, `updated_at`) VALUES
(1, 2, 'Pyae Bhone', 'Zaw', 'pbz@gmail.com', '09123456789', 'Yangon', 'January 18, 2024', 'Air Jordan 1 Retro Low OG SP \'Travis Scott Medium Olive\'', '700', 1, 'credit_card', '2024-01-18 00:22:39', '2024-01-18 00:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `shoe_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `shoe_id`, `size`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '4.5', '700', '2024-01-18 00:22:39', '2024-01-18 00:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shoes`
--

CREATE TABLE `shoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shoe_name` varchar(255) NOT NULL,
  `shoe_model_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL DEFAULT '1',
  `shoe_image` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shoes`
--

INSERT INTO `shoes` (`id`, `user_id`, `shoe_name`, `shoe_model_id`, `size`, `shoe_image`, `price`, `stock_quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 'A Ma Manire x Air Jordan 4 \'Violet Ore\'', 7, '[3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,14,15,16,17,18]', 'public/images/shoes/A Ma Manire x Air Jordan 4 \'Violet Ore\'.jpg', 400, 2, '2024-01-17 10:34:03', '2024-01-17 10:34:03'),
(2, 1, 'Air Jordan 1 Retro Low OG SP \'Travis Scott Medium Olive\'', 4, '[3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,14,15,16,17,18]', 'public/images/shoes/Air Jordan 1 Retro Low OG SP \'Travis Scott Medium Olive\'.jpg', 700, 0, '2024-01-17 10:34:21', '2024-01-18 00:22:39'),
(3, 1, 'Air Jordan 4 Retro SE \'Craft - Olive\'', 7, '[3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,14,15,16,17,18]', 'public/images/shoes/Air Jordan 4 Retro SE \'Craft - Olive\'.jpg', 350, 4, '2024-01-17 10:34:42', '2024-01-17 10:34:42'),
(4, 1, 'Air Jordan 1 Retro High OG \'University Blue\'', 5, '[3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,14,15,16,17,18]', 'public/images/shoes/Air Jordan 1 Retro High OG \'University Blue\'.jpg', 430, 4, '2024-01-17 10:35:05', '2024-01-17 10:35:05'),
(5, 1, 'Air Jordan 4 Retro SE \'Black Canvas\'', 7, '[3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,14,15,16,17,18]', 'public/images/shoes/Air Jordan 4 Retro SE \'Black Canvas\'.jpg', 540, 3, '2024-01-17 10:35:26', '2024-01-17 10:35:26'),
(6, 1, 'Air Jordan 4 Retro \'Red Cement\'', 7, '[3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,14,15,16,17,18]', 'public/images/shoes/Air Jordan 4 Retro \'Red Cement\'.jpg', 560, 3, '2024-01-17 10:35:45', '2024-01-17 10:35:45'),
(7, 1, 'Air Jordan 1 Retro High OG x Marvel \'Spider-Man Across the Spider-Verse\'', 5, '[3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,14,15,16,17,18]', 'public/images/shoes/Air Jordan 1 Retro High OG x Marvel \'Spider-Man Across the Spider-Verse\'.jpg', 600, 3, '2024-01-17 10:36:05', '2024-01-17 10:36:05'),
(8, 1, 'Nike Dunk Low Pro SB \'Fog\'', 1, '[3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,14,15,16,17,18]', 'public/images/shoes/Nike Dunk Low Pro SB \'Fog\'.jpg', 320, 5, '2024-01-17 10:36:31', '2024-01-17 10:36:31'),
(9, 1, 'Nike Dunk Low \'Cacao Wow\'', 1, '[3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,14,15,16,17,18]', 'public/images/shoes/Nike Dunk Low \'Cacao Wow\'.jpg', 200, 5, '2024-01-17 10:36:45', '2024-01-17 10:36:45'),
(10, 1, 'Nike x The Powerpuff Girls SB Dunk Low Prox QS \'Bubbles\'', 1, '[3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,14,15,16,17,18]', 'public/images/shoes/Nike x The Powerpuff Girls SB Dunk Low Prox QS \'Bubbles\'.jpg', 400, 5, '2024-01-17 10:37:05', '2024-01-17 10:37:05'),
(11, 1, 'Nike Dunk Low \'Black White Panda\'', 1, '[3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,14,15,16,17,18]', 'public/images/shoes/Nike Dunk Low \'Black White Panda\'.jpg', 300, 4, '2024-01-17 10:37:20', '2024-01-17 10:37:20'),
(12, 1, 'adidas Forum Low \'White Black\'', 8, '[3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,14,15,16,17,18]', 'public/images/shoes/adidas Forum Low \'White Black\'.jpg', 320, 4, '2024-01-17 10:37:44', '2024-01-17 10:37:44'),
(13, 1, 'Vans Knu Skool Classics \'Black\'', 9, '[3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,14,15,16,17,18]', 'public/images/shoes/Vans Knu Skool Classics \'Black\'.jpg', 80, 10, '2024-01-17 10:38:06', '2024-01-17 10:38:06'),
(14, 1, 'Travis Scott x Air Jordan 1 Low OG \'Reverse Mocha\'', 4, '[3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,14,15,16,17,18]', 'public/images/shoes/Travis Scott x Air Jordan 1 Low OG \'Reverse Mocha\'.jpg', 530, 3, '2024-01-17 10:38:31', '2024-01-17 10:38:31');

-- --------------------------------------------------------

--
-- Table structure for table `shoe_models`
--

CREATE TABLE `shoe_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shoe_models`
--

INSERT INTO `shoe_models` (`id`, `model_name`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 'Dunk Low', 1, '2024-01-17 10:33:37', '2024-01-17 10:33:37'),
(2, 'Dunk High', 1, '2024-01-17 10:33:37', '2024-01-17 10:33:37'),
(3, 'Air Force 1', 1, '2024-01-17 10:33:37', '2024-01-17 10:33:37'),
(4, 'Air Jordan 1 Low', 3, '2024-01-17 10:33:37', '2024-01-17 10:33:37'),
(5, 'Air Jordan 1 High', 3, '2024-01-17 10:33:37', '2024-01-17 10:33:37'),
(6, 'Air Jordan 1 Mid', 3, '2024-01-17 10:33:37', '2024-01-17 10:33:37'),
(7, 'Air Jordan 4', 3, '2024-01-17 10:33:37', '2024-01-17 10:33:37'),
(8, 'Forum Low', 2, '2024-01-17 10:33:37', '2024-01-17 10:33:37'),
(9, 'Knu Skool', 4, '2024-01-17 10:33:37', '2024-01-17 10:33:37'),
(10, 'New Balance 550', 5, '2024-01-18 00:25:19', '2024-01-18 00:25:19'),
(11, 'Forum High', 2, '2024-01-18 00:27:15', '2024-01-18 00:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pyae Bhone', 'admin@gmail.com', 'admin', '2024-01-17 10:33:37', '$2y$12$HoBKph5sO1fH.spztkkWke6OUNTvdpJQxZiQUuDHWclXoBBcnT7nq', 'QzON7ozb9h', '2024-01-17 10:33:37', '2024-01-17 10:33:37'),
(2, 'Mg Mg', 'mgmg@gmail.com', 'user', NULL, '$2y$12$RH7XC5djFJVrBctBY2mw3elupEA5DyCtsLMwVY7xZJutDVg0YNpI6', NULL, '2024-01-18 00:21:53', '2024-01-18 00:21:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_shoe_id_foreign` (`shoe_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_user_id_foreign` (`user_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_shoe_id_foreign` (`shoe_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `shoes`
--
ALTER TABLE `shoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shoes_user_id_foreign` (`user_id`);

--
-- Indexes for table `shoe_models`
--
ALTER TABLE `shoe_models`
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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoes`
--
ALTER TABLE `shoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shoe_models`
--
ALTER TABLE `shoe_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_shoe_id_foreign` FOREIGN KEY (`shoe_id`) REFERENCES `shoes` (`id`),
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_shoe_id_foreign` FOREIGN KEY (`shoe_id`) REFERENCES `shoes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shoes`
--
ALTER TABLE `shoes`
  ADD CONSTRAINT `shoes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
