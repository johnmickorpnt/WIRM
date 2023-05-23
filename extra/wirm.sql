-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 05:35 PM
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

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `reservation_id`, `amount`, `bank_name`, `bank_location`, `proof_of_payment`, `created_at`, `updated_at`) VALUES
(1, 12, '310.00', 'asd', 'asd', '../../../assets/uploads/qrcode_1684725543.png', '2023-05-23 15:07:27', '2023-05-23 15:07:27'),
(2, 13, '310.00', 'asd', 'asd', '../../../assets/uploads/qrcode_1684725731.png', '2023-05-23 15:15:38', '2023-05-23 15:15:38'),
(3, 14, '310.00', 'asd', 'asd', '../../../assets/uploads/qrcode_1684725481.png', '2023-05-23 15:19:32', '2023-05-23 15:19:32'),
(4, 14, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdacfdd184_6bbb93611fd53db3.png', '2023-05-23 15:25:03', '2023-05-23 15:25:03'),
(5, 15, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdb161bb45_9b4d0cd7b2d06410.png', '2023-05-23 15:26:14', '2023-05-23 15:26:14'),
(6, 15, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdb224164f_5b0250f76b63d744.png', '2023-05-23 15:26:26', '2023-05-23 15:26:26'),
(7, 15, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdb452ec61_69c1b70c30d52d96.png', '2023-05-23 15:27:01', '2023-05-23 15:27:01'),
(8, 15, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdb45de77b_a4d3e53cb127608e.png', '2023-05-23 15:27:01', '2023-05-23 15:27:01'),
(9, 15, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdb8c39a66_7d54ba8e8812cf22.png', '2023-05-23 15:28:12', '2023-05-23 15:28:12'),
(10, 15, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdb8d0f28e_81f83a15e81169cb.png', '2023-05-23 15:28:13', '2023-05-23 15:28:13'),
(11, 15, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdba5d7400_484f3b9a02daac4a.png', '2023-05-23 15:28:37', '2023-05-23 15:28:37'),
(12, 15, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdba676e77_9d6df4b8791f083c.png', '2023-05-23 15:28:38', '2023-05-23 15:28:38'),
(13, 15, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdbaec4eee_aab04ba857214081.png', '2023-05-23 15:28:46', '2023-05-23 15:28:46'),
(14, 15, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdbb730fb3_35aecb0e36fb9e3e.png', '2023-05-23 15:28:55', '2023-05-23 15:28:55'),
(15, 16, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdc049a343_3bc931c7ec2a1c79.png', '2023-05-23 15:30:12', '2023-05-23 15:30:12'),
(16, 16, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdc1aa3805_fb125d7095b8d1de.png', '2023-05-23 15:30:34', '2023-05-23 15:30:34'),
(17, 16, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdc1b44721_059605e0c0a64074.png', '2023-05-23 15:30:35', '2023-05-23 15:30:35'),
(18, 16, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdc1ba519a_fda666bab48e1a42.png', '2023-05-23 15:30:35', '2023-05-23 15:30:35'),
(19, 18, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdc407241b_01379694e31b9552.png', '2023-05-23 15:31:12', '2023-05-23 15:31:12'),
(20, 18, '310.00', 'asd', 'asd', '../../../assets/uploads/646cdcd997c15_6e3077704c48108b.png', '2023-05-23 15:33:45', '2023-05-23 15:33:45');

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
(2, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 4400, 'confirmed', '2023-04-13 08:53:02', '2023-04-13 08:53:02'),
(3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 2000, 'checked_out', NULL, NULL),
(4, 2, 3, '2023-05-17 00:00:00', '2023-05-17 00:00:00', 2222, 222, 'cancelled', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 2, 3, '2023-05-25 00:00:00', '2023-05-17 00:00:00', 2222, 222, 'confirmed', '2023-05-16 09:17:58', '2023-05-16 09:17:58'),
(6, 1, 3, '2023-05-25 00:00:00', '2023-05-17 00:00:00', 2, 2, 'pending', '2023-05-16 09:24:03', '2023-05-16 09:24:03'),
(7, 1, 1, '2023-05-23 12:00:00', '2023-05-30 12:00:00', 2, 233, 'confirmed', '2023-05-16 22:21:44', '2023-05-16 22:21:44'),
(9, 17, 3, '2023-05-24 00:00:00', '2023-05-25 00:00:00', 2, 4620, 'pending', '2023-05-23 20:21:55', '2023-05-23 20:21:55'),
(10, 2, 3, '2023-05-24 00:00:00', '2023-05-25 00:00:00', 2, 4620, 'cancelled', '2023-05-23 20:25:14', '2023-05-23 20:25:14'),
(11, 2, 3, '2023-05-24 00:00:00', '2023-05-25 00:00:00', 2, 4620, 'cancelled', '2023-05-23 20:25:57', '2023-05-23 20:25:57'),
(12, 2, 3, '2023-05-24 00:00:00', '2023-05-25 00:00:00', 2, 4620, 'cancelled', '2023-05-23 22:31:58', '2023-05-23 22:31:58'),
(13, 2, 3, '2023-05-24 00:00:00', '2023-05-25 00:00:00', 2, 4620, 'paid', '2023-05-23 23:14:20', '2023-05-23 23:14:20'),
(14, 2, 3, '2023-05-24 00:00:00', '2023-05-25 00:00:00', 2, 4620, 'paid', '2023-05-23 23:15:17', '2023-05-23 23:15:17'),
(15, 2, 3, '2023-05-24 00:00:00', '2023-05-25 00:00:00', 2, 4620, 'paid', '2023-05-23 23:25:59', '2023-05-23 23:25:59'),
(16, 2, 3, '2023-05-24 00:00:00', '2023-05-25 00:00:00', 2, 4620, 'paid', '2023-05-23 23:30:02', '2023-05-23 23:30:02'),
(17, 2, 3, '2023-05-24 00:00:00', '2023-05-25 00:00:00', 2, 4620, 'cancelled', '2023-05-23 23:30:47', '2023-05-23 23:30:47'),
(18, 2, 3, '2023-05-24 00:00:00', '2023-05-25 00:00:00', 2, 4620, 'confirmed', '2023-05-23 23:30:59', '2023-05-23 23:30:59');

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
(3, 'asd', 'asd', '09194282431', 'johnmickooo28@gmail.com', '$2y$10$iV7VriCT.eiu3TZCNf/4gu8lCtrRRGxJnBpNyRnbeJf7kmna4T01S', '2023-05-16 23:37:49', '2023-05-16 23:37:49'),
(4, 'JOhn Micko', 'gsag', '09194282431', 'johnmickooo0@gmail.com', '$2y$10$ZYz7fF2KoFIEm1zd5IETg.AJQsfNbKvZ61CGssmRxLEHAa1B0k7oG', '2023-05-17 05:53:18', '2023-05-17 05:53:18'),
(5, 'John Micko', 'Rapanot', '09194282431', 'pewdiepewdzpewds@gmail.comgas', '$2y$10$CzeGcPWEUjWgi5.EAxmTPuAXQZa9Yme50II6X8FWKyjtAPotR6.Y.', '2023-05-17 05:53:44', '2023-05-17 05:53:44');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
