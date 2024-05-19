-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 09:14 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `room_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `id` int(20) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`id`, `admin_name`, `admin_pass`) VALUES
(1, 'sanjeev', 'sanjeev@123');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` varchar(150) DEFAULT NULL,
  `user_name` varchar(150) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `booking_id`, `room_name`, `price`, `total_pay`, `room_no`, `user_name`, `phonenum`, `address`) VALUES
(82, 83, 'Simple Room', 1500, 1500, NULL, 'user1', '1234', 'Bhaktapur'),
(83, 84, 'Luxery', 12, 12, NULL, 'user1', '1234', 'Bhaktapur'),
(84, 85, 'Simple Room', 1500, 1500, 'a1', 'user1', '1234', 'Bhaktapur'),
(85, 87, 'Luxery', 12, 12, NULL, 'user1', '1234', 'Bhaktapur'),
(86, 88, 'Simple room', 1300, 1300, NULL, 'user1', '1234', 'Bhaktapur'),
(87, 89, 'Delux', 2000, 2000, NULL, 'user1', '1234', 'Bhaktapur'),
(88, 90, 'Simple Room', 1500, 1500, NULL, 'user1', '1234', 'Bhaktapur'),
(89, 91, 'Simple Room', 1500, 1500, NULL, 'user1', '1234', 'Bhaktapur'),
(90, 92, 'Super Delux', 4000, 4000, NULL, 'user1', '1234', 'Bhaktapur'),
(91, 93, 'Simple Room', 1500, 7500, NULL, 'user1', '1234', 'Bhaktapur'),
(92, 94, 'Simple Room', 1500, 4500, NULL, 'user1', '1234', 'Bhaktapur'),
(93, 95, 'Simple Room', 1500, 3000, NULL, 'user1', '1234', 'Bhaktapur'),
(94, 96, 'Simple Room', 1500, 1500, NULL, 'user1', '1234', 'Bhaktapur'),
(95, 97, 'Simple Room', 1500, 1500, 'a3', 'user1', '1234', 'Bhaktapur'),
(96, 98, 'Simple Room', 1500, 1500, NULL, 'Dipesh', '1234567890', 'Bhaktapur');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `trans_id` varchar(200) NOT NULL,
  `trans_amt` int(11) NOT NULL,
  `trans_status` varchar(100) NOT NULL DEFAULT 'pending',
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `refund`, `booking_status`, `order_id`, `trans_id`, `trans_amt`, `trans_status`, `datentime`) VALUES
(83, 5, 17, '2023-11-22', '2023-11-23', 0, NULL, 'pending', 'ORD_708956', '', 0, 'pending', '2023-11-22 10:37:41'),
(84, 5, 19, '2023-11-22', '2023-11-23', 0, NULL, 'pending', 'ORD_53769', '', 0, 'pending', '2023-11-22 10:38:25'),
(85, 5, 17, '2023-11-23', '2023-11-24', 1, NULL, 'booked', 'ORD_7908986', '0006E1S', 1500, 'Success', '2023-11-22 10:39:17'),
(86, 5, 19, '2023-11-23', '2023-11-24', 0, NULL, 'pending', 'ORD_8823407', '', 0, 'pending', '2023-11-22 14:00:24'),
(87, 5, 19, '2023-11-23', '2023-11-24', 0, 1, 'cancelled', 'ORD_9202772', '0006E4P', 12, 'Success', '2023-11-22 14:01:36'),
(88, 5, 18, '2023-11-28', '2023-11-29', 0, 1, 'cancelled', 'ORD_5354873', '0006E4R', 1300, 'Success', '2023-11-22 14:02:16'),
(89, 5, 20, '2023-11-23', '2023-11-24', 0, 1, 'cancelled', 'ORD_5937136', '0006E86', 2000, 'Success', '2023-11-22 19:44:21'),
(90, 5, 17, '2023-11-22', '2023-11-23', 0, 1, 'cancelled', 'ORD_2468428', '0006E8B', 1500, 'Success', '2023-11-22 22:35:17'),
(91, 5, 17, '2023-12-24', '2023-12-25', 0, NULL, 'booked', 'ORD_9987437', '0006EHN', 1500, 'Success', '2023-11-23 16:17:56'),
(92, 5, 21, '2023-11-23', '2023-11-24', 0, NULL, 'pending', 'ORD_8959776', '', 0, 'pending', '2023-11-23 17:29:44'),
(93, 5, 17, '2023-12-04', '2023-12-09', 0, NULL, 'pending', 'ORD_5039641', '', 0, 'pending', '2023-11-23 18:08:58'),
(94, 5, 17, '2023-12-10', '2023-12-13', 0, NULL, 'booked', 'ORD_879451', '0006EJX', 4500, 'Success', '2023-11-23 18:10:53'),
(95, 5, 17, '2023-11-27', '2023-11-29', 0, 1, 'cancelled', 'ORD_4823436', '0006EK3', 3000, 'Success', '2023-11-23 18:53:02'),
(96, 5, 17, '2023-11-24', '2023-11-25', 0, 0, 'cancelled', 'ORD_8415639', '0006ELK', 1500, 'Success', '2023-11-24 10:24:17'),
(97, 5, 17, '2023-11-25', '2023-11-26', 1, NULL, 'booked', 'ORD_4097300', '0006EVW', 1500, 'Success', '2023-11-25 13:18:59'),
(98, 7, 17, '2023-11-27', '2023-11-28', 0, NULL, 'booked', 'ORD_208511', '0006EVX', 1500, 'Success', '2023-11-25 13:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(200) NOT NULL,
  `pn1` varchar(30) NOT NULL,
  `pn2` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, 'Duwakot-Changunarayan,Bhaktapur', 'https://maps.app.goo.gl/YMAAh4LKmVjAmSfWA', '9841424344', '9841424347', 'ask.bhatgaun@gmail.com', 'facebook.com/bhadgaun', 'instagram.com/bhadgaun', 'twitter.com/bhadgaun', 'https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d28262.640687525556!2d85.405265!3d27.691646!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjfCsDQxJzE1LjciTiA4NcKwMjQnMjQuMCJF!5e0!3m2!1sen!2snp!4v1696330156756!5m2!1sen!2snp');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(5, 'IMG_16372.svg', 'Router', 'Router is used as the reliable source for internet use in the room.'),
(6, 'IMG_79051.svg', 'Wifi', ' Wifi is essential for network'),
(7, 'IMG_40349.svg', 'Fan', ' Wind Energy'),
(8, 'IMG_30160.svg', 'AC', 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE `feature` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`id`, `name`) VALUES
(4, 'Sofa'),
(6, 'wifi'),
(7, 'TV'),
(8, 'Heater');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`) VALUES
(17, 'Simple Room', 340, 1500, 1, 2, 3, 'This is suitable for cost effective person', 1, 0),
(18, 'Simple room', 290, 1300, 1, 2, 2, 'This is simple room', 1, 0),
(19, 'Luxery', 500, 12, 5, 4, 6, 'This room is for you.', 1, 0),
(20, 'Delux', 200, 2000, 2, 2, 0, 'This is delux room', 1, 0),
(21, 'Super Delux', 250, 4000, 4, 2, 3, 'This is premimum room', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(43, 17, 7),
(44, 17, 8),
(46, 18, 7),
(47, 18, 8),
(48, 19, 5),
(49, 19, 7),
(50, 19, 8),
(51, 20, 7),
(52, 20, 8),
(53, 21, 5),
(54, 21, 6),
(55, 21, 7),
(56, 21, 8);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(47, 17, 4),
(48, 17, 6),
(49, 17, 7),
(50, 18, 4),
(51, 18, 6),
(52, 18, 7),
(53, 19, 4),
(54, 19, 6),
(55, 19, 7),
(56, 19, 8),
(57, 20, 4),
(58, 20, 6),
(59, 20, 7),
(60, 20, 8),
(61, 21, 4),
(62, 21, 6),
(63, 21, 7),
(64, 21, 8);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(14, 17, 'IMG_85493.jpg', 1),
(16, 18, 'IMG_41864.png', 1),
(17, 19, 'IMG_35449.png', 1),
(18, 19, 'IMG_32847.jpg', 0),
(19, 19, 'IMG_74460.png', 0),
(22, 20, 'IMG_69487.jpg', 1),
(23, 20, 'IMG_42563.png', 0),
(24, 21, 'IMG_87471.png', 1),
(25, 21, 'IMG_71238.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(255) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'Bhagatgaun', 'Bhagatgaun Bhagatgaun Bhagatgaun Bhagatgaun Bhagatgaun Bhagatgaun Bhagatgaun Bhagatgaun Bhagatgaun BhagatgaunBhagatgaunBhagatgaunBhagatgaun Bhagatgaun BhagatgaunBhagatgaun ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(4, 'Yadhav', 'IMG_76241.webp'),
(5, 'Nati Kaji Shrestha', 'IMG_23388.jpg'),
(6, 'Fathaman Rajbhandari', 'IMG_96515.jpeg'),
(7, 'ss', 'IMG_74534.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phonenum` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `status`, `datentime`) VALUES
(3, 'Sujan', 'sujan@gmail.com', 'LisankhuPakhar-03,Sindupalchowk', '123456789', 45300, '2001-12-25', 'IMG_53383.jpg', '$2y$10$OcfJ66vyrALZxEiuNamwqu1giZl/spFU9tQ6aRydl5kBntWyLr2My', 1, '2023-10-15 13:18:56'),
(5, 'user1', 'sanjeevsht58@gmail.com', 'Bhaktapur', '1234', 42300, '2000-10-25', 'IMG_66056.jpg', '$2y$10$C71hFqhBknhmSbFAIiJPqembwMGVQK.HrQioMWh4fNyAS6BK84c4m', 1, '2023-10-27 10:10:18'),
(6, 'Sanjib Shrestha', 'sanj@gmail.com', 'LisankhuPakhar-03,Sindupalchowk', '12345', 45300, '1998-05-11', 'IMG_40706.jpeg', '$2y$10$yaSX.6GOoPVUBZrmbWt/metJcEgMfz70SG51HCndRzc/BJg0EjFWO', 1, '2023-11-09 09:48:13'),
(7, 'Dipesh', 'dipesh@gmail.com', 'Bhaktapur', '1234567890', 46000, '1995-01-25', 'IMG_21287.webp', '$2y$10$NmHCC4/Y/lxfp1Mmv.URY.TOLj/ynTw8klAFdLdm28/zu65BUgw.G', 1, '2023-11-25 13:24:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(4, 'Sanjib Shrestha', 'sanjibsht2001@gmail.com', 'subject', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit aperiam corporis architecto! Libero distinctio, repudiandae laboriosam reprehenderit inventore deleniti error.', '2023-10-06', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`room_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `rm_id` (`room_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_images_ibfk_1` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feature`
--
ALTER TABLE `feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `feature` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rm_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
