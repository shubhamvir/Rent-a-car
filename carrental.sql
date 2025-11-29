-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2024 at 08:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `car_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `days_rented` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `car_id`, `customer_id`, `start_date`, `days_rented`) VALUES
(1, 3, 19, '2024-04-02', 2),
(2, 4, 19, '2024-04-10', 3),
(3, 4, 19, '2024-04-10', 3),
(4, 3, 19, '2024-04-24', 1),
(5, 4, 19, '2024-04-22', 3),
(6, 4, 19, '2024-04-22', 3),
(7, 3, 19, '2024-04-06', 4);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `agency_id` int(11) DEFAULT NULL,
  `model` varchar(100) NOT NULL,
  `vehicle_number` varchar(20) NOT NULL,
  `seating_capacity` int(11) NOT NULL,
  `rent_per_day` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `agency_id`, `model`, `vehicle_number`, `seating_capacity`, `rent_per_day`) VALUES
(3, NULL, 'Scorpio s11 black 2024', 'MP 04 5556', 9, 3500.00),
(4, NULL, 'New i20 sports 2023', 'MP 04 2566', 4, 2500.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('customer','agency') NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`, `name`) VALUES
(8, 'xyz', '$2y$10$X5xK00m9tVzHd.JP5PLJS.nUXhLo3NS8u/0kgkzsVuy6tb1DmfL4G', 'agency', 'xyz'),
(9, 'xyz', '$2y$10$t6DZHijUkNQlIEJJnxRLUuHljICDHWlxGrj9hxoNrDfWPM9zmNfiq', 'agency', 'xyz'),
(10, 'xyz', '$2y$10$eWoKYgR62.VTZagzh0qeHeKN5wrgX76Jf7aHoF1fPfK0vbPi7MxV.', 'agency', 'xyz'),
(11, 'xyz', '$2y$10$TqUTR1YUfDgQuAiNtTBGJeaJ5BYmPS3KelLmk7NSCy6PV6bQOhW1y', 'agency', 'xyz'),
(12, 'car', '$2y$10$llZ9Z6x1XNB9mIg8D57zvudeeZe53tIIRcyDinhgMHVrX3rmczSiq', 'agency', 'Cars'),
(13, 'car', '$2y$10$zzaogRVrHuAkZetNXq42dO14TeSUko48iZUTTPdTW7BIMY2bneOY.', 'agency', 'Cars'),
(14, '123', '$2y$10$LKQZZUjKWrXlK6l34YvKU.fSJDWerleybzQ/aaR4WTBfUFL0GBFQK', 'agency', '123'),
(15, '456', '$2y$10$mzbRwq492yQqubA6uOb/c.L71nI/hExn00dsjrjmkt.jk76eZTWCW', 'customer', '456'),
(16, '456', '$2y$10$IG7ckfbJmvQB0zG8.LTdg.apM0aOI52wXUXkB2.p6N8B712TZdRMy', 'customer', '456'),
(17, '456', '$2y$10$1K.4Yuzrj3ceYta.l5kc/.wmVXs9JsWrzQRqTydnwtMsOFZI9Z4Ia', 'customer', '456'),
(18, '456', '$2y$10$g/cZsDqNLPuQ05RtFNh3UeKw5yjkaef63EaeYR8Qx66MrMw3rWsKu', 'customer', '456'),
(19, 'devesh', '$2y$10$AZ6zrV0RO9rCXt09Lg9nMu7DK9./YTqft9tbfcnAg729/wGZTw5Ju', 'customer', 'devesh'),
(20, 'sneha', '$2y$10$D5zACyVbMVEBwOGQVCBvpu3SSa3vHzI27xC2rQOKMR2Y4eIRhWv0W', 'customer', 'sneha'),
(21, 'abc', '$2y$10$OXS2RCnhb5qTAe/p//SamORz5MTzmwXRlFPBQbnwfbfRyBodoe8di', 'agency', 'ABC'),
(22, 'sneha', '$2y$10$GFEemICcEySD80GSu8y5IOBEVUXXpbFewD.BIOUMArhXTHTpEvBQG', 'customer', 'Sneha'),
(23, 'sneha', '$2y$10$fy69X3YqC6Yz6JGlYiWfzuuXZCS4i10u5.wL9W0m6dk3dw69JPfm6', 'customer', 'Sneha');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
