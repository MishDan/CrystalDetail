-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 01:46 AM
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
(2, 5, 'Audi A5 Coupe', '2025-04-22', '10:00:00', '2025-05-15 13:05:56', 2),
(40, 7, 'bmw x5', '2025-05-30', '11:00:00', '2025-06-01 19:22:55', 2),
(42, 18, 'BMW 3 Series', '2025-06-03', '15:00:00', '2025-05-30 21:00:00', 4),
(43, 24, 'Honda Civic', '2025-05-28', '12:00:00', '2025-05-26 21:00:00', 3),
(44, 25, 'Volvo XC60', '2025-06-16', '12:00:00', '2025-06-12 21:00:00', 4),
(45, 11, 'Volvo XC60', '2025-05-19', '14:00:00', '2025-05-16 21:00:00', 4),
(46, 21, 'Toyota Corolla', '2025-06-12', '16:00:00', '2025-06-08 21:00:00', 5),
(47, 17, 'Mazda 6', '2025-06-07', '11:00:00', '2025-06-04 21:00:00', 1),
(48, 12, 'BMW 3 Series', '2025-05-27', '17:00:00', '2025-05-25 21:00:00', 2),
(49, 16, 'Toyota Corolla', '2025-06-08', '12:00:00', '2025-06-05 21:00:00', 1),
(50, 26, 'Mazda 6', '2025-06-04', '08:00:00', '2025-06-01 21:00:00', 5),
(51, 31, 'Audi A4', '2025-05-22', '12:00:00', '2025-05-19 21:00:00', 3),
(52, 33, 'Mazda 6', '2025-06-10', '12:00:00', '2025-06-06 21:00:00', 6),
(53, 30, 'Ford Focus', '2025-06-04', '11:00:00', '2025-05-31 21:00:00', 1),
(54, 17, 'Honda Civic', '2025-05-27', '11:00:00', '2025-05-23 21:00:00', 4),
(55, 17, 'Toyota Corolla', '2025-06-04', '13:00:00', '2025-05-31 21:00:00', 2),
(56, 21, 'BMW 3 Series', '2025-05-21', '11:00:00', '2025-05-19 21:00:00', 2),
(57, 10, 'Audi A4', '2025-05-21', '15:00:00', '2025-05-17 21:00:00', 6),
(58, 29, 'Volvo XC60', '2025-05-22', '15:00:00', '2025-05-19 21:00:00', 3),
(59, 21, 'Ford Focus', '2025-05-27', '08:00:00', '2025-05-24 21:00:00', 6),
(60, 27, 'Ford Focus', '2025-06-09', '14:00:00', '2025-06-07 21:00:00', 4),
(61, 14, 'Volvo XC60', '2025-05-31', '13:00:00', '2025-05-28 21:00:00', 4),
(62, 25, 'Volvo XC60', '2025-05-25', '10:00:00', '2025-05-21 21:00:00', 6),
(63, 27, 'Volvo XC60', '2025-06-07', '09:00:00', '2025-06-05 21:00:00', 2),
(64, 19, 'Mazda 6', '2025-06-04', '08:00:00', '2025-06-02 21:00:00', 2),
(65, 28, 'Toyota Corolla', '2025-06-04', '15:00:00', '2025-06-02 21:00:00', 2),
(66, 28, 'BMW 3 Series', '2025-06-03', '15:00:00', '2025-05-30 21:00:00', 4),
(67, 22, 'Audi A4', '2025-06-11', '15:00:00', '2025-06-09 21:00:00', 5),
(68, 15, 'Volvo XC60', '2025-06-10', '15:00:00', '2025-06-07 21:00:00', 5),
(69, 22, 'Mazda 6', '2025-05-26', '13:00:00', '2025-05-22 21:00:00', 5),
(70, 13, 'BMW 3 Series', '2025-05-21', '11:00:00', '2025-05-19 21:00:00', 6),
(71, 10, 'Toyota Corolla', '2025-05-30', '17:00:00', '2025-05-28 21:00:00', 5),
(72, 15, 'Honda Civic', '2025-06-01', '10:00:00', '2025-05-29 21:00:00', 6),
(73, 19, 'Ford Focus', '2025-05-26', '17:00:00', '2025-05-22 21:00:00', 2),
(74, 26, 'Mazda 6', '2025-06-09', '17:00:00', '2025-06-06 21:00:00', 4),
(75, 27, 'Ford Focus', '2025-06-08', '13:00:00', '2025-06-04 21:00:00', 6),
(76, 31, 'Audi A4', '2025-06-08', '10:00:00', '2025-06-05 21:00:00', 2),
(77, 14, 'Volvo XC60', '2025-06-04', '15:00:00', '2025-05-31 21:00:00', 3),
(78, 22, 'Volvo XC60', '2025-05-31', '10:00:00', '2025-05-28 21:00:00', 6),
(79, 13, 'BMW 3 Series', '2025-05-22', '12:00:00', '2025-05-18 21:00:00', 6),
(80, 19, 'Mazda 6', '2025-05-20', '08:00:00', '2025-05-17 21:00:00', 5),
(81, 13, 'Volvo XC60', '2025-05-28', '14:00:00', '2025-05-24 21:00:00', 6),
(82, 18, 'Mazda 6', '2025-05-25', '10:00:00', '2025-05-22 21:00:00', 1),
(83, 19, 'Ford Focus', '2025-06-11', '13:00:00', '2025-06-09 21:00:00', 5),
(84, 22, 'Volvo XC60', '2025-05-22', '17:00:00', '2025-05-18 21:00:00', 1),
(85, 16, 'BMW 3 Series', '2025-06-05', '17:00:00', '2025-06-02 21:00:00', 2),
(86, 15, 'Ford Focus', '2025-06-03', '10:00:00', '2025-05-31 21:00:00', 2),
(87, 11, 'Audi A4', '2025-05-31', '15:00:00', '2025-05-27 21:00:00', 1),
(88, 30, 'Honda Civic', '2025-06-01', '12:00:00', '2025-05-29 21:00:00', 5),
(89, 24, 'Toyota Corolla', '2025-06-10', '16:00:00', '2025-06-07 21:00:00', 4),
(90, 27, 'Toyota Corolla', '2025-05-21', '16:00:00', '2025-05-19 21:00:00', 6),
(91, 16, 'Audi A4', '2025-05-23', '12:00:00', '2025-05-19 21:00:00', 6);

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
(10, 'Images_db\\After_bmwM4.png', 'Exterior Wash', 'Our team expertly cleans the exterior of a car, removing dirt and grime.', 'Наша команда профессионально моет кузов автомобиля, удаляя грязь и пыль.', 'Mūsu komanda profesionāli tīra automašīnas virsbūvi, noņemot netīrumus un putekļus.', 'Car undergoing exterior wash with water jets', 'Автомобиль на мойке кузова с водяными струями', 'Auto tiek mazgāts ar ūdens strūklām'),
(11, 'Images_db\\After_Audi_Q8.png', 'Interior Cleaning', 'Deep cleaning the car interior to restore its pristine condition.', 'Глубокая чистка салона автомобиля для восстановления его идеального состояния.', 'Rūpīga automašīnas salona tīrīšana, lai atjaunotu tā nevainojamo stāvokli.', 'Interior of a car being vacuumed and wiped down', 'Салон автомобиля чистят пылесосом и протирают', 'Automašīnas salons tiek tīrīts ar putekļu sūcēju un noslaucīts'),
(12, 'Images_db\\Ekrānuzņēmums 2025-04-17 181926.png', 'Polishing', 'Polishing the car’s surface to bring out a mirror-like shine.', 'Полировка поверхности автомобиля для придания зеркального блеска.', 'Automašīnas virsmas pulēšana, lai panāktu spoguļa spīdumu.', 'Car being polished to a shiny finish', 'Автомобиль полируют до блестящего состояния', 'Automašīna tiek pulēta līdz spīdīgam stāvoklim'),
(13, 'Images_db\\rolls_royce_phantom_top_10.jpg', 'Ceramic Coating', 'Applying a ceramic coating for long-lasting protection and shine.', 'Нанесение керамического покрытия для долговременной защиты и блеска.', 'Keramiskā pārklājuma uzklāšana ilgstošai aizsardzībai un spīdumam.', 'Applying ceramic coating to a car’s surface', 'Нанесение керамического покрытия на кузов автомобиля', 'Keramiskā pārklājuma uzklāšana uz automašīnas virsbūves'),
(14, 'Images_db\\f228cf2s-960.jpg', 'Scratch Touch-ups', 'Carefully touching up scratches to restore the car’s flawless look.', 'Аккуратное устранение царапин для восстановления идеального вида автомобиля.', 'Rūpīga skrāpējumu labošana, lai atjaunotu automašīnas nevainojamo izskatu.', 'Car with scratches being carefully repaired', 'Ремонт царапин на автомобиле с аккуратной обработкой', 'Automašīna ar skrāpējumiem tiek rūpīgi labota'),
(15, 'Images_db\\images.jpg', 'Paint Protection Film', 'Installing paint protection film to shield the car from damage.', 'Установка защитной пленки для защиты автомобиля от повреждений.', 'Aizsargplēves uzstādīšana, lai pasargātu automašīnu no bojājumiem.', 'Applying paint protection film to a car’s hood', 'Нанесение защитной пленки на капот автомобиля', 'Aizsargplēves uzklāšana uz automašīnas motora pārsega');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `service` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `phone`, `service`, `message`, `created_at`) VALUES
(2, 'John Carter', 'john.carter@example.com', '+37120000001', 'Polishing', 'Hi! I’m interested in getting my car polished this week.', '2025-06-01 22:42:15'),
(3, 'Emily Stone', 'emily.stone@example.com', '+37120000002', 'Interior Cleaning', 'Do you offer pet hair removal during interior cleaning?', '2025-06-01 22:41:15'),
(4, 'Michael Lee', 'michael.lee@example.com', '+37120000003', 'Scratch Touch-ups', 'Need a quote for fixing two scratches on my driver door.', '2025-06-01 22:43:15'),
(5, 'Sophia Green', 'sophia.green@example.com', '+37120000004', 'Ceramic Coating', 'How long does the ceramic coating protection last?', '2025-06-01 22:41:15'),
(6, 'Oliver White', 'oliver.white@example.com', '+37120000005', 'Exterior Wash', 'Is there an express exterior wash option?', '2025-06-01 22:41:15'),
(7, 'Иван Иванов', 'ivan.ivanov@example.com', '+37120000006', 'Полировка', 'Здравствуйте, сколько времени занимает полировка?', '2025-06-01 22:41:15'),
(8, 'Елена Смирнова', 'elena.smirnova@example.com', '+37120000007', 'Чистка салона', 'Можно ли записаться на чистку салона на выходные?', '2025-06-01 22:41:15'),
(9, 'Артем Козлов', 'artem.kozlov@example.com', '+37120000008', 'Удаление царапин', 'У меня царапина на капоте, можно ли устранить?', '2025-06-01 22:41:15'),
(10, 'Наталья Орлова', 'natalia.orlova@example.com', '+37120000009', 'Керамическое покрытие', 'Подходит ли керамика для старых авто?', '2025-06-01 22:41:15'),
(11, 'Сергей Волков', 'sergey.volkov@example.com', '+37120000010', 'Мойка кузова', 'Можно ли использовать бесконтактную мойку?', '2025-06-01 22:41:15'),
(12, 'Jānis Ozoliņš', 'janis.ozolins@example.com', '+37120000011', 'Pulēšana', 'Labdien! Vai pieejama pulēšana piektdienā?', '2025-06-01 22:41:15'),
(13, 'Līga Liepa', 'liga.liepa@example.com', '+37120000012', 'Salona tīrīšana', 'Vai salona tīrīšana iekļauj ādas kopšanu?', '2025-06-01 22:41:15'),
(14, 'Artūrs Kalniņš', 'arturs.kalnins@example.com', '+37120000013', 'Skrāpējumu labošana', 'Ir sīki skrāpējumi. Varat palīdzēt?', '2025-06-01 22:41:15'),
(15, 'Baiba Ziediņa', 'baiba.ziedina@example.com', '+37120000014', 'Keramikas pārklājums', 'Cik ilgi kalpo keramiskais pārklājums?', '2025-06-01 22:41:15'),
(16, 'Mārtiņš Bērziņš', 'martins.berzins@example.com', '+37120000015', 'Ārpuses mazgāšana', 'Vai ir pieejama ātra mazgāšana?', '2025-06-01 22:41:15'),
(17, 'Toms Eglītis', 'toms.eglitis@example.com', '+37120000016', 'Paint Protection Film', 'Vai uzstādāt aizsargplēvi?', '2025-06-01 22:41:15'),
(18, 'Anna Kalniņa', 'anna.kalnina@example.com', '+37120000017', 'Ceramic Coating', 'Book me in for ceramic next Tuesday, please.', '2025-06-01 22:41:15'),
(19, 'Марина Лебедева', 'marina.lebedeva@example.com', '+37120000018', 'Полировка', 'Понравилась прошлая услуга, хочу повторить.', '2025-06-01 22:41:15'),
(20, 'Rebeka Grīva', 'rebeka.griva@example.com', '+37120000019', 'Scratch Touch-ups', 'Strīpa uz durvīm. Cik maksās?', '2025-06-01 22:41:15'),
(21, 'Alex Johnson', 'alex.johnson@example.com', '+37120000020', 'Interior Cleaning', 'Can I add ozone disinfection to my cleaning?', '2025-06-01 22:41:15'),
(22, 'Zane Krūmiņa', 'zane.krumina@example.com', '+37120000021', 'Pulēšana', 'Auto stāvoklis nav ideāls – ieteikumi?', '2025-06-01 22:41:15'),
(23, 'Игорь Михайлов', 'igor.mikhailov@example.com', '+37120000022', 'Мойка кузова', 'Можно записаться утром?', '2025-06-01 22:41:15'),
(24, 'Kristīne Ozola', 'kristine.ozola@example.com', '+37120000023', 'Ārpuses mazgāšana', 'Vai strādājat arī svētdienās?', '2025-06-01 22:41:15'),
(25, 'Edgars Petersons', 'edgars.petersons@example.com', '+37120000024', 'Polishing', 'Any discount if I bring two cars?', '2025-06-01 22:41:15'),
(26, 'Laura Bennet', 'laura.bennet@example.com', '+37120000025', 'Scratch Touch-ups', 'I need urgent help with deep scratches.', '2025-06-01 22:41:15');

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
(20, 'John Carter', 'https://images.pexels.com/photos/376464/pexels-photo-376464.jpeg', 5, 'Flawless polish job, my car shines like new!', 'Polishing'),
(21, 'Emily Stone', 'https://images.pexels.com/photos/1681010/pexels-photo-1681010.jpeg', 4, 'The scratch touch-up was great, barely visible now.', 'Scratch Touch-ups'),
(22, 'Liam Brown', 'https://images.pexels.com/photos/1704120/pexels-photo-1704120.jpeg', 4.5, 'Interior cleaning exceeded my expectations!', 'Interior Cleaning'),
(23, 'Sophia Green', 'https://images.pexels.com/photos/733872/pexels-photo-733872.jpeg', 5, 'Exterior wash left my car spotless. Highly recommended!', 'Exterior Wash'),
(24, 'Oliver White', 'https://images.pexels.com/photos/8980885/pexels-photo-8980885.jpeg', 4.5, 'Ceramic coating was worth every cent. Amazing results.', 'Ceramic Coating'),
(25, 'Иван Иванов', 'https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg', 5, 'Полировка великолепна, машина выглядит как новая!', 'Polishing'),
(26, 'Анастасия Смирнова', 'https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg', 4, 'Удаление царапин прошло отлично, результат порадовал.', 'Scratch Touch-ups'),
(27, 'Дмитрий Петров', 'https://images.pexels.com/photos/2104258/pexels-photo-2104258.jpeg', 5, 'Салон вычищен до блеска. Очень доволен.', 'Interior Cleaning'),
(28, 'Елена Кузнецова', 'https://images.pexels.com/photos/213399/pexels-photo-213399.jpeg', 4.5, 'Кузов отмыт до зеркального блеска.', 'Exterior Wash'),
(29, 'Сергей Волков', 'https://images.pexels.com/photos/2108817/pexels-photo-2108817.jpeg', 4.5, 'Керамическое покрытие держится отлично. Рекомендую.', 'Ceramic Coating'),
(30, 'Jānis Ozoliņš', 'https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg', 5, 'Pulēšana izdevās izcili, auto spīd kā jauns!', 'Polishing'),
(31, 'Anna Kalniņa', 'https://images.pexels.com/photos/2448749/pexels-photo-2448749.jpeg', 4, 'Skrāpējumi gandrīz vairs nav redzami. Lielisks darbs.', 'Scratch Touch-ups'),
(32, 'Mārtiņš Bērziņš', 'https://images.pexels.com/photos/2417848/pexels-photo-2417848.jpeg', 5, 'Salona tīrīšana bija nevainojama.', 'Interior Cleaning'),
(33, 'Līga Liepa', 'https://images.pexels.com/photos/532172/pexels-photo-532172.jpeg', 4.5, 'Auto virsbūve izskatās lieliski pēc mazgāšanas.', 'Exterior Wash'),
(34, 'Artūrs Siliņš', 'https://images.pexels.com/photos/1028741/pexels-photo-1028741.jpeg', 5, 'Keramiskā pārklājuma rezultāts pārspēja cerības.', 'Ceramic Coating'),
(35, 'Laura Bennet', 'https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg', 5, 'Perfect from start to finish!', 'Paint Protection Film'),
(36, 'Мария Лебедева', 'https://images.pexels.com/photos/3587496/pexels-photo-3587496.jpeg', 4.5, 'Быстро и качественно!', 'Paint Protection Film'),
(37, 'Toms Eglītis', 'https://images.pexels.com/photos/3299736/pexels-photo-3299736.jpeg', 4, 'Viss izdarīts kā solīts.', 'Paint Protection Film'),
(38, 'Nina Holmes', 'https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg', 3.5, 'Decent service, could improve in timing.', 'Interior Cleaning'),
(39, 'Vadims Ivanovs', 'https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg', 5, 'Просто супер!', 'Exterior Wash');

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
(1, '🚿', '⇢€49.99', '1 hour', 'Exterior Wash', 'Мойка кузова', 'Ārpuses mazgāšana', 'Thorough cleaning of your vehicle\'s exterior using premium products that protect your paint while removing dirt and grime.', 'Тщательная очистка кузова вашего автомобиля с использованием высококачественных средств, которые защищают краску и удаляют грязь и пыль.', 'Rūpīga automašīnas ārpuses tīrīšana, izmantojot augstākās kvalitātes produktus, kas aizsargā jūsu krāsu, vienlaikus noņemot netīrumus un netīrumus.'),
(2, '🧹', '⇢€39.99', '2 hours', 'Interior Cleaning', 'Чистка салона', 'Salona tīrīšana', 'Deep cleaning of all interior surfaces, including vacuuming, steam cleaning, and conditioning of leather and plastic surfaces.', 'Глубокая чистка всех внутренних поверхностей, включая пылесос, паровую очистку и обработку кожи и пластика.', 'Dziļa visu salona virsmu tīrīšana, tostarp putekļsūcēja izmantošana, tvaika tīrīšana un ādas un plastmasas virsmu apstrāde.'),
(3, '✨', '⇢€149.99', '3-4 hours', 'Polishing', 'Полировка', 'Pulēšana', 'Machine polishing to remove swirl marks, light scratches, and oxidation, restoring your car\'s paint to a mirror-like finish.', 'Машинная полировка для удаления круговых царапин, легких повреждений и окисления, восстанавливая зеркальный блеск краски.', 'Pulēšana ar mašīnu, lai noņemtu apļveida skrāpējumus, vieglus bojājumus un oksidāciju, atjaunojot krāsas spīdumu kā spogulī.'),
(4, '🛡️', '⇢€499.99', '1-2 days', 'Ceramic Coating', 'Керамическое покрытие', 'Keramikas pārklājums', 'Advanced protective layer that bonds with your car\'s paint, providing long-lasting protection against UV rays, chemicals, and scratches.', 'Современное защитное покрытие, которое связывается с краской автомобиля и обеспечивает длительную защиту от УФ-лучей, химии и царапин.', 'Uzlabots aizsargslānis, kas saistās ar jūsu automašīnas krāsu un nodrošina ilgstošu aizsardzību pret UV stariem, ķimikālijām un skrāpējumiem.'),
(5, '🔧', '⇢€99.99', '2-3 hours', 'Scratch Touch-ups', 'Удаление царапин', 'Skrāpējumu labošana', 'Professional repair of minor scratches and paint damage to restore your vehicle\'s appearance and prevent further damage.', 'Профессиональное устранение мелких царапин и повреждений краски для восстановления внешнего вида автомобиля и предотвращения дальнейших повреждений.', 'Profesionāla nelielu skrāpējumu un krāsas bojājumu novēršana, lai atjaunotu automašīnas izskatu un novērstu turpmākus bojājumus.'),
(6, '🎨', '⇢€899.99', '1-2 days', 'Paint Protection Film', 'Пленка для защиты краски', 'Krāsas aizsargplēve', 'Invisible urethane film applied to high-impact areas to protect your paint from stone chips, scratches, and environmental damage.', 'Невидимая уретановая пленка, наносимая на уязвимые участки, чтобы защитить краску от сколов, царапин и внешнего воздействия.', 'Neredzama uretāna plēve, kas uzklāta uz pakļautām virsmām, lai aizsargātu krāsu no akmens triekiem, skrāpējumiem un vides bojājumiem.');

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
(7, 'Andrejs', 'Smirnov', 'admin', '$2y$10$K.66xILIDEAv3cSOVcBEiebgSiR6/KARFnyfcZDlmhtVBwI0vf9VO', 'adminov@gmail.com', 'bmw', 'x5', '+37126254005', '2025-04-21 18:40:54', 'admin', 'user_6808a9049c0850.09902629.png'),
(10, 'Jānis', 'Ozoliņš', 'janisoz', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'janis.ozolins@example.com', 'Audi', 'A6', '+37120000001', '2025-06-01 22:25:06', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(11, 'Līga', 'Liepa', 'ligaliepa', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'liga.liepa@example.com', 'BMW', 'X1', '+37120000002', '2025-06-01 22:25:06', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(12, 'Artūrs', 'Kalniņš', 'artursk', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'arturs.kalnins@example.com', 'Mercedes', 'C-Class', '+37120000003', '2025-06-01 22:25:06', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(13, 'Inese', 'Ziediņa', 'inesez', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'inese.ziedina@example.com', 'Toyota', 'RAV4', '+37120000004', '2025-06-01 22:25:06', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(14, 'Mārtiņš', 'Bērziņš', 'martinsb', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'martins.berzins@example.com', 'Volvo', 'XC60', '+37120000005', '2025-06-01 22:25:06', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(15, 'Elīna', 'Andersone', 'elinaa', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'elina.andersone@example.com', 'Mazda', 'CX-5', '+37120000006', '2025-06-01 22:25:06', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(16, 'Roberts', 'Kļaviņš', 'robertsk', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'roberts.klavins@example.com', 'Ford', 'Focus', '+37120000007', '2025-06-01 22:25:06', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(17, 'Kristīne', 'Ozola', 'kristineo', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'kristine.ozola@example.com', 'Honda', 'Civic', '+37120000008', '2025-06-01 22:25:06', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(18, 'Edgars', 'Petersons', 'edgarsp', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'edgars.petersons@example.com', 'Nissan', 'Qashqai', '+37120000009', '2025-06-01 22:25:06', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(19, 'Zane', 'Krūmiņa', 'zanek', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'zane.krumina@example.com', 'Peugeot', '3008', '+37120000010', '2025-06-01 22:25:06', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(20, 'Renārs', 'Siliņš', 'renarss', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'renars.silins@example.com', 'Skoda', 'Octavia', '+37120000011', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(21, 'Anete', 'Eglīte', 'aneteeg', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'anete.eglite@example.com', 'Kia', 'Sportage', '+37120000012', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(22, 'Rūdolfs', 'Ābols', 'rudolfsab', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'rudolfs.abols@example.com', 'Hyundai', 'Tucson', '+37120000013', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(23, 'Baiba', 'Lapiņa', 'baibal', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'baiba.lapina@example.com', 'Renault', 'Megane', '+37120000014', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(24, 'Jānis', 'Pētersons', 'janisp', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'janis.peters@example.com', 'Opel', 'Insignia', '+37120000015', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(25, 'Agnese', 'Kalēja', 'agnesek', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'agnese.kaleja@example.com', 'Volkswagen', 'Passat', '+37120000016', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(26, 'Nauris', 'Grants', 'naurisg', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'nauris.grants@example.com', 'Seat', 'Leon', '+37120000017', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(27, 'Linda', 'Strautiņa', 'lindas', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'linda.strautina@example.com', 'Citroen', 'C4', '+37120000018', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(28, 'Toms', 'Vilks', 'tomsv', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'toms.vilks@example.com', 'Tesla', 'Model 3', '+37120000019', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(29, 'Ilze', 'Mežs', 'ilzem', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'ilze.mezs@example.com', 'Honda', 'CR-V', '+37120000020', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(30, 'Sandis', 'Liepiņš', 'sandisl', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'sandis.liepins@example.com', 'Lexus', 'RX', '+37120000021', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(31, 'Rebeka', 'Grīva', 'rebekag', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'rebeka.griva@example.com', 'Fiat', '500X', '+37120000022', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(32, 'Edgars', 'Ozols', 'edgarso', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'edgars.ozols@example.com', 'Chevrolet', 'Cruze', '+37120000023', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(33, 'Sarmīte', 'Vītola', 'sarmitev', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'sarmite.vitola@example.com', 'Subaru', 'Forester', '+37120000024', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png'),
(34, 'Andis', 'Bērziņš', 'andisb', '$2y$10$8kGxwYoS3r6nTGiImwTHeeAp9b4cQ.yq5shjU8zzIXKjv3tBLqg7e', 'andis.berzins@example.com', 'Mitsubishi', 'Outlander', '+37120000025', '2025-06-01 22:26:04', 'user', 'icon_default_userDaadasd08JJDd_(d.png');

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
