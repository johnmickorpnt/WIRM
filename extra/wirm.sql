-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2023 at 11:01 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wirm`
--

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_location` varchar(255) DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `num_of_guests` int(11) NOT NULL DEFAULT 2,
  `total_price` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `customer_id`, `room_id`, `start_date`, `end_date`, `num_of_guests`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2023-05-22 12:00:00', '2023-05-22 12:00:00', 2, 4400, 'cancelled', '2023-04-13 08:51:53', '2023-04-13 08:51:53'),
(4, 2, 3, '2023-05-17 00:00:00', '2023-05-17 00:00:00', 2222, 222, 'cancelled', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 2, 3, '2023-09-26 00:00:00', '2023-09-26 08:00:00', 2222, 222, 'confirmed', '2023-05-16 09:17:58', '2023-05-16 09:17:58'),
(6, 1, 2, '2023-09-24 18:58:51', '2023-09-26 00:58:51', 2, 2000, 'confirmed', '2023-09-25 00:59:11', '2023-09-25 00:59:11'),
(7, 9, 4, '2023-09-29 12:00:00', '2023-09-29 06:00:00', 2, 8000, 'pending', '2023-09-25 04:07:49', '2023-09-25 04:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `type` enum('2 Single Beds','1 King Sized Bed','1 Queen Sized Bed','Suite Room') NOT NULL,
  `occupancy` int(11) NOT NULL,
  `rate_sun_thurs` int(11) NOT NULL,
  `rate_fri_sat` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `availability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `type`, `occupancy`, `rate_sun_thurs`, `rate_fri_sat`, `description`, `availability`) VALUES
(1, 1, '1 King Sized Bed', 2, 2200, 3400, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ratione dolore rerum neque facere excepturi recusandae consequuntur quae? Debitis necessitatibus ullam quia, obcaecati molestiae nesciunt reprehenderit, eos tempora iure, culpa optio!\r\nLibero omnis quos, dolores voluptates aspernatur numquam vel tenetur, quasi, deleniti rem veritatis et quae officiis repellat eligendi. Aperiam esse atque, praesentium cumque dolor enim eum ipsum mollitia non accusamus?\r\nConsectetur asperiores delectus inventore harum iste maiores vel necessitatibus beatae porro eius, adipisci voluptatibus repellendus eum impedit ullam libero dicta fugiat officiis odio obcaecati. Voluptates itaque nostrum qui odit quia!\r\nReprehenderit corporis voluptatibus iure blanditiis sed numquam aliquid unde dolor amet delectus. Impedit id enim, voluptatibus distinctio sunt non rem minus officiis, reprehenderit fuga quisquam adipisci. Perferendis dolore at tempora.\r\nMolestias quaerat ducimus sint minus laborum labore libero nostrum perferendis accusamus, animi quidem quos tempore alias eveniet magni, exercitationem eaque hic soluta nobis voluptas dolorem tempora vel omnis nemo? Provident!', 1),
(2, 2, '1 King Sized Bed', 2, 4620, 5830, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ratione dolore rerum neque facere excepturi recusandae consequuntur quae? Debitis necessitatibus ullam quia, obcaecati molestiae nesciunt reprehenderit, eos tempora iure, culpa optio!\r\nLibero omnis quos, dolores voluptates aspernatur numquam vel tenetur, quasi, deleniti rem veritatis et quae officiis repellat eligendi. Aperiam esse atque, praesentium cumque dolor enim eum ipsum mollitia non accusamus?\r\nConsectetur asperiores delectus inventore harum iste maiores vel necessitatibus beatae porro eius, adipisci voluptatibus repellendus eum impedit ullam libero dicta fugiat officiis odio obcaecati. Voluptates itaque nostrum qui odit quia!\r\nReprehenderit corporis voluptatibus iure blanditiis sed numquam aliquid unde dolor amet delectus. Impedit id enim, voluptatibus distinctio sunt non rem minus officiis, reprehenderit fuga quisquam adipisci. Perferendis dolore at tempora.\r\nMolestias quaerat ducimus sint minus laborum labore libero nostrum perferendis accusamus, animi quidem quos tempore alias eveniet magni, exercitationem eaque hic soluta nobis voluptas dolorem tempora vel omnis nemo? Provident!', 1),
(3, 3, '2 Single Beds', 2, 4620, 5830, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ratione dolore rerum neque facere excepturi recusandae consequuntur quae? Debitis necessitatibus ullam quia, obcaecati molestiae nesciunt reprehenderit, eos tempora iure, culpa optio!\r\nLibero omnis quos, dolores voluptates aspernatur numquam vel tenetur, quasi, deleniti rem veritatis et quae officiis repellat eligendi. Aperiam esse atque, praesentium cumque dolor enim eum ipsum mollitia non accusamus?\r\nConsectetur asperiores delectus inventore harum iste maiores vel necessitatibus beatae porro eius, adipisci voluptatibus repellendus eum impedit ullam libero dicta fugiat officiis odio obcaecati. Voluptates itaque nostrum qui odit quia!\r\nReprehenderit corporis voluptatibus iure blanditiis sed numquam aliquid unde dolor amet delectus. Impedit id enim, voluptatibus distinctio sunt non rem minus officiis, reprehenderit fuga quisquam adipisci. Perferendis dolore at tempora.\r\nMolestias quaerat ducimus sint minus laborum labore libero nostrum perferendis accusamus, animi quidem quos tempore alias eveniet magni, exercitationem eaque hic soluta nobis voluptas dolorem tempora vel omnis nemo? Provident!', 1),
(4, 4, 'Suite Room', 2, 8000, 10000, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ratione dolore rerum neque facere excepturi recusandae consequuntur quae? Debitis necessitatibus ullam quia, obcaecati molestiae nesciunt reprehenderit, eos tempora iure, culpa optio!\r\nLibero omnis quos, dolores voluptates aspernatur numquam vel tenetur, quasi, deleniti rem veritatis et quae officiis repellat eligendi. Aperiam esse atque, praesentium cumque dolor enim eum ipsum mollitia non accusamus?\r\nConsectetur asperiores delectus inventore harum iste maiores vel necessitatibus beatae porro eius, adipisci voluptatibus repellendus eum impedit ullam libero dicta fugiat officiis odio obcaecati. Voluptates itaque nostrum qui odit quia!\r\nReprehenderit corporis voluptatibus iure blanditiis sed numquam aliquid unde dolor amet delectus. Impedit id enim, voluptatibus distinctio sunt non rem minus officiis, reprehenderit fuga quisquam adipisci. Perferendis dolore at tempora.\r\nMolestias quaerat ducimus sint minus laborum labore libero nostrum perferendis accusamus, animi quidem quos tempore alias eveniet magni, exercitationem eaque hic soluta nobis voluptas dolorem tempora vel omnis nemo? Provident!', 1),
(5, 5, '2 Single Beds', 2, 2200, 3410, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ratione dolore rerum neque facere excepturi recusandae consequuntur quae? Debitis necessitatibus ullam quia, obcaecati molestiae nesciunt reprehenderit, eos tempora iure, culpa optio!\r\nLibero omnis quos, dolores voluptates aspernatur numquam vel tenetur, quasi, deleniti rem veritatis et quae officiis repellat eligendi. Aperiam esse atque, praesentium cumque dolor enim eum ipsum mollitia non accusamus?\r\nConsectetur asperiores delectus inventore harum iste maiores vel necessitatibus beatae porro eius, adipisci voluptatibus repellendus eum impedit ullam libero dicta fugiat officiis odio obcaecati. Voluptates itaque nostrum qui odit quia!\r\nReprehenderit corporis voluptatibus iure blanditiis sed numquam aliquid unde dolor amet delectus. Impedit id enim, voluptatibus distinctio sunt non rem minus officiis, reprehenderit fuga quisquam adipisci. Perferendis dolore at tempora.\r\nMolestias quaerat ducimus sint minus laborum labore libero nostrum perferendis accusamus, animi quidem quos tempore alias eveniet magni, exercitationem eaque hic soluta nobis voluptas dolorem tempora vel omnis nemo? Provident!', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `contact_number`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'JOhn Micko', 'Rapanot', '09194282431', 'johnmickooo28@gmail.com', '$2y$10$/HgPj6HXHv9ziLCmZ90QseKyB.7PtrRLg4KAWIGx2FKWgDOaJMA/6', '2023-04-13 04:24:55', '2023-04-13 04:24:55'),
(2, 'JOhn Micko', 'Rapanot', '09194282431', 'johnmickorapanot@yahoo.com', '$2y$10$2ReMljneCDBupknZ.Juv7OJzi5/D03brh1zdgrkpQgm5e/2AeizXa', '2023-04-13 04:45:31', '2023-04-13 04:45:31'),
(4, 'JOhn Micko', 'gsag', '09194282431', 'johnmickooo0@gmail.com', '$2y$10$ZYz7fF2KoFIEm1zd5IETg.AJQsfNbKvZ61CGssmRxLEHAa1B0k7oG', '2023-05-17 05:53:18', '2023-05-17 05:53:18'),
(9, 'John Micko ', 'Rapanot', '09194282431', 'pewdiepewdzpewds@gmail.com', '$2y$10$//hk5X78xY6RW3Rj2NA4p.pfR2TALCsAJ7ao2f9nQ9E4L.s6S5xBu', '2023-09-23 21:15:19', '2023-09-23 21:15:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Rooms` (`room_id`),
  ADD KEY `FK_Customer` (`customer_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `FK_Customer` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_Rooms` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
