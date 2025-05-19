-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 11:32 AM
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
-- Database: `car_users_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_model` varchar(100) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `car_model`, `appointment_date`, `appointment_time`, `created_at`, `service_id`) VALUES
(1, 5, 'Audi A5 Coupe2', '2025-04-25', '10:00:00', '2025-04-23 13:05:56', 2),
(2, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-04-21 13:05:56', 2),
(3, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-04-21 13:05:56', 2),
(4, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-04-21 13:05:56', 2),
(6, 5, 'Audi A5 Coupe', '2025-04-23', '10:00:00', '2025-04-21 13:05:56', 2),
(7, 5, 'Audi A5 Coupe', '2025-04-20', '10:00:00', '2025-04-21 13:05:56', 2),
(8, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-04-21 13:05:56', 2),
(9, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-04-21 13:05:56', 2),
(10, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-04-21 13:05:56', 2),
(11, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-04-21 13:05:56', 2),
(12, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-04-21 13:05:56', 2),
(13, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-04-21 13:05:56', 2),
(14, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-04-21 13:05:56', 2),
(15, 5, 'Audi A5 Coupe', '2025-04-20', '20:00:00', '2025-04-21 13:05:56', 2),
(23, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-04-21 13:05:56', 2),
(24, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-04-21 13:05:56', 2),
(25, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-04-21 13:05:56', 2),
(26, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-04-21 13:05:56', 2),
(33, 7, 'bmw x5', '2025-04-30', '09:00:00', '2025-04-23 21:21:06', 2),
(34, 5, 'Audi A5 Coupe', '2025-04-23', '12:00:00', '2025-04-24 08:34:21', 3),
(35, 7, 'bmw x5', '2025-05-05', '10:00:00', '2025-05-05 11:10:05', 1),
(36, 7, 'bmw x5', '2025-05-07', '09:00:00', '2025-05-05 11:10:16', 2);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image_url` text NOT NULL,
  `service` varchar(100) DEFAULT NULL,
  `caption_en` text DEFAULT NULL,
  `caption_ru` text DEFAULT NULL,
  `caption_lv` text DEFAULT NULL,
  `alt_text_en` varchar(255) DEFAULT NULL,
  `alt_text_ru` varchar(255) DEFAULT NULL,
  `alt_text_lv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image_url`, `service`, `caption_en`, `caption_ru`, `caption_lv`, `alt_text_en`, `alt_text_ru`, `alt_text_lv`) VALUES
(1, 'Images_db/After_bmwM4.png', 'Ceramic Coating', 'Yellow BMW M4 with premium ceramic coating', 'RUC', 'LVC', 'Black BMW M4', NULL, NULL),
(2, 'Images_db/After_MB_S.png', 'Exterior Wash', 'Mercedes-Benz S-Class after detailing', 'RUC', 'LVC', 'Mercedes-Benz S-Class', NULL, NULL),
(3, 'Images_db/After_Audi_Q8.png', 'Interior Cleaning', 'Immaculate interior detail', 'RUC', 'LVC', 'Luxury SUV Interior', NULL, NULL),
(6, 'Images_db/Ekrānuzņēmums 2025-04-17 181926.png', 'audi', 'addddddddddddddddddddddddd', 'RUC', 'LVC', 'adadad', 'фвфвфв', 'aaaaaaaaaaaaaaa'),
(8, 'Images_db/Ekrānuzņēmums 2025-02-03 182226.png', 'New Service', '', '', '', 'вфвфвфdd', 'dadadada', '');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image_url` text DEFAULT NULL,
  `stars` float DEFAULT NULL,
  `text` text DEFAULT NULL,
  `service` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `image_url`, `stars`, `text`, `service`) VALUES
(1, 'Michael Thompson', 'https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg', 5, 'Incredible service! My BMW looks better than when I first bought it. The ceramic coating is amazing!', 'Ceramic Coating'),
(2, 'Sarah Williams', 'https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg', 4.5, 'I got the interior cleaning package and was blown away by the results.', 'Interior Cleaning'),
(12, 'вфвфвdadad', 'https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg', 5, 'Incredible service! My BMW looks better than when I first bought it. The ceramic coating is amazing!', 'Ceramic Coating'),
(13, 'Sarah Williamsdadadadadad', 'https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg', 4.5, 'I got the interior cleaning package and was blown away by the results.', 'Interior Cleaning'),
(14, 'adad', 'https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg', 5, 'Incredible service! My BMW looks better than when I first bought it. The ceramic coating is amazing!', 'Ceramic Coating'),
(15, 'Sarah Williams', 'https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg', 4.5, 'I got the interior cleaning package and was blown away by the results.', 'Interior Cleaning'),
(16, 'Michael Thompsonadadsada', 'https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg', 5, 'Incredible service! My BMW looks better than when I first bought it. The ceramic coating is amazing!', 'Ceramic Coating'),
(17, 'Sarah Williams', 'https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg', 4.5, 'I got the interior cleaning package and was blown away by the results.', 'Interior Cleaning'),
(18, 'admins admminovs', 'Images_db/user_68080cb8459213.25321537.png', 2, 'Govno', 'Polishing'),
(19, 'Daniils Miscuks', 'Images_db/After_Audi_Q8.png', 4, 'уцафаца', 'Polishing');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `icon` varchar(10) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `title_en` varchar(100) DEFAULT NULL,
  `title_ru` varchar(100) DEFAULT NULL,
  `title_lv` varchar(100) DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `description_ru` text DEFAULT NULL,
  `description_lv` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `icon`, `price`, `duration`, `title_en`, `title_ru`, `title_lv`, `description_en`, `description_ru`, `description_lv`) VALUES
(1, '🚿', 'From €49.99', '1 hour', 'Exterior Wash', 'фв', 'dad', 'Thorough cleaning of your vehicle\'s exterior using premium products that protect your paint while removing dirt and grime.', 'Тщательная очистка кузова вашего автомобиля с использованием высококачественных средств, которые защищают краску и удаляют грязь и пыль.', 'Rūpīga automašīnas ārpuses tīrīšana, izmantojot augstākās kvalitātes produktus, kas aizsargā jūsu krāsu, vienlaikus noņemot netīrumus un netīrumus.'),
(2, '🧹', 'From €9.99', '2 hours', 'Interior Cleaning', NULL, NULL, 'Deep cleaning of all interior surfaces, including vacuuming, steam cleaning, and conditioning of leather and plastic surfaces.', NULL, NULL),
(3, '✨', 'From €149.99', '3-4 hours', 'Polishing', NULL, NULL, 'Machine polishing to remove swirl marks, light scratches, and oxidation, restoring your car\'s paint to a mirror-like finish.', NULL, NULL),
(4, '🛡️', 'From €499.99', '1-2 days', 'Ceramic Coating', NULL, NULL, 'Advanced protective layer that bonds with your car\'s paint, providing long-lasting protection against UV rays, chemicals, and scratches.', NULL, NULL),
(5, '🔧', 'From €99.99', '2-3 hours', 'Scratch Touch-ups', NULL, NULL, 'Professional repair of minor scratches and paint damage to restore your vehicle\'s appearance and prevent further damage.', NULL, NULL),
(6, '🎨', 'From €899.99', '1-2 days', 'Paint Protection Film', NULL, NULL, 'Invisible urethane film applied to high-impact areas to protect your paint from stone chips, scratches, and environmental damage.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `gmail` varchar(150) NOT NULL,
  `car_make` varchar(100) DEFAULT NULL,
  `car_model` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('user','moder','admin','banned') NOT NULL DEFAULT 'user',
  `profile_image` varchar(255) DEFAULT 'icon_default_userDaadasd08JJDd_(d.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `gmail`, `car_make`, `car_model`, `phone`, `created_at`, `role`, `profile_image`) VALUES
(5, 'Daniils', 'Miscuks', 'Mish', '$2y$10$Usq/LWqnPuYkvtWN/TXZEuioXsPj67nMkC/kv8xlJZ1YfFuYvWcZa', 'daniils.micuks@gmail.com', 'Audi', 'A5 Coupe', '+37126254005', '2025-04-20 18:12:43', 'moder', 'After_Audi_Q8.png'),
(7, 'admins', 'admminovs', 'admin', '$2y$10$K.66xILIDEAv3cSOVcBEiebgSiR6/KARFnyfcZDlmhtVBwI0vf9VO', 'adminov@gmail.com', 'bmw', 'x5', '+37126254005', '2025-04-21 18:40:54', 'admin', 'user_6808a9049c0850.09902629.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gmail` (`gmail`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
