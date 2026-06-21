-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2024 at 04:35 AM
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
-- Database: `trip_booking_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `trip_date` date DEFAULT NULL,
  `num_people` int(11) DEFAULT NULL,
  `hotel_service` tinyint(1) DEFAULT NULL,
  `transport_service` tinyint(1) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(11) NOT NULL,
  `trip_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price_per_person` decimal(10,2) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `trip_name`, `description`, `price_per_person`, `image_path`) VALUES
(1, 'LAMPUNG - BALI', 'Nikmati perjalanan seru dari Lampung ke Bali, yang membawa Anda melintasi keindahan alam Pulau Sumatra dan Jawa sebelum tiba di Pulau Dewata. Mulai dari pesona pantai hingga kekayaan budaya, trip ini menggabungkan petualangan dan relaksasi, menawarkan pengalaman tak terlupakan saat Anda menjelajahi berbagai destinasi ikonik seperti Ubud, Kuta, dan Tanah Lot. Dengan pemandangan memukau dan tradisi lokal yang kaya, perjalanan ini akan menjadi liburan penuh kenangan yang menyatukan keindahan alam dan keunikan budaya.Nikmati perjalanan seru dari Lampung ke Bali.', 308.69, 'images/trip1.jpg'),
(2, 'LAMPUNG - MALAYSIA', 'Rasakan petualangan tak terlupakan dengan perjalanan dari Lampung ke Malaysia, menjelajahi keindahan alam dan keanekaragaman budaya sepanjang rute. Dimulai dari Lampung, Anda akan melintasi lautan menuju Malaysia, di mana Anda bisa mengeksplorasi destinasi terkenal seperti Kuala Lumpur, dengan Menara Petronas yang ikonik, hingga kota-kota bersejarah seperti Malaka dan Penang. Trip ini menggabungkan keindahan pantai tropis, landmark modern, dan warisan budaya, menjadikannya pengalaman liburan yang sempurna bagi para pencari petualangan dan penikmat budaya.', 617.38, 'images/trip2.jpg'),
(3, 'FULL TRIP PALEMBANG', 'Full Trip Palembang adalah paket wisata lengkap yang menawarkan pengalaman menyeluruh menjelajahi kota Palembang, ibu kota Provinsi Sumatera Selatan. Dalam perjalanan ini, peserta akan diajak mengunjungi berbagai destinasi ikonik seperti Jembatan Ampera, Sungai Musi, Pulau Kemaro, serta wisata sejarah di Benteng Kuto Besak dan Museum Sultan Mahmud Badaruddin II. Wisata kuliner khas Palembang seperti pempek dan tekwan juga menjadi bagian penting dari perjalanan ini. Dengan Full Trip Palembang, wisatawan dapat menikmati keindahan alam, budaya, serta sejarah kota Palembang dalam satu paket yang menyenangkan.', 185.22, 'images/trip3.jpg'),
(4, 'Full Trip Lampung', 'Selami keindahan Lampung dalam perjalanan seru yang memadukan pesona alam, budaya, dan petualangan. Mulailah perjalanan Anda dengan menjelajahi pantai-pantai menawan seperti Pantai Tanjung Setia dan Pantai Krui, yang terkenal dengan ombak surfingnya. Lanjutkan dengan mengunjungi Gunung Krakatau, simbol megah dari kekuatan alam yang menawarkan panorama spektakuler. Nikmati pula keindahan air terjun, seperti Air Terjun Curup Tujuh, dan rasakan kedamaian di desa-desa tradisional yang memancarkan kekayaan budaya lokal. Seluruh perjalanan ini dirancang untuk memberikan pengalaman yang memuaskan dan memperkaya wawasan Anda tentang keajaiban Lampung.', 92.61, 'images/trip4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_id` (`trip_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
