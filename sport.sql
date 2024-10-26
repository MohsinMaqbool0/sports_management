-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2024 at 07:16 PM
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
-- Database: `sport`
--

-- --------------------------------------------------------

--
-- Table structure for table `c_equipment`
--

CREATE TABLE `c_equipment` (
  `e_id` int(11) NOT NULL,
  `e_name` varchar(18) DEFAULT NULL,
  `e_category` varchar(16) DEFAULT NULL,
  `e_brand_name` varchar(18) DEFAULT NULL,
  `e_purchased_date` date DEFAULT NULL,
  `e_serail_id` varchar(10) DEFAULT NULL,
  `flag` text DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_equipment`
--

INSERT INTO `c_equipment` (`e_id`, `e_name`, `e_category`, `e_brand_name`, `e_purchased_date`, `e_serail_id`, `flag`) VALUES
(1, 'Running Shoes', 'Footwear', 'Nike', '2022-01-01', 'S584', '0'),
(2, 'Tennis Racket', 'Sports Equipment', 'Wilson', '2022-02-15', 'T58', '0'),
(3, 'Basketball', 'Sports Equipment', 'Spalding', '2022-03-10', 'B12', '0'),
(4, 'Yoga Mat', 'Fitness Accessor', 'Liforme', '2022-04-05', 'Y02', '0'),
(5, 'Dumbbells Set', 'Fitness Equipmen', 'Bowflex', '2022-05-20', 'D18', '0'),
(6, 'BAT', 'Cirket', 'Hero', '2024-01-17', 'B01', '0'),
(10, 'TEST', 'Cirket', 'Hero', '2024-01-13', 'T01', '0'),
(12, 'dfsdf', 'sdfs', 'dfds', '2024-01-23', 'sdfs', '0');

-- --------------------------------------------------------

--
-- Table structure for table `c_student`
--

CREATE TABLE `c_student` (
  `s_id` int(11) NOT NULL,
  `s_first_name` varchar(10) DEFAULT NULL,
  `s_last_name` varchar(10) DEFAULT NULL,
  `s_roll_no` varchar(8) DEFAULT NULL,
  `s_stream` varchar(15) DEFAULT NULL,
  `s_semester` varchar(15) DEFAULT NULL,
  `s_batch` varchar(8) DEFAULT NULL,
  `s_student_reg` varchar(18) DEFAULT NULL,
  `s_phone_no` varchar(13) DEFAULT NULL,
  `flag` text DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_student`
--

INSERT INTO `c_student` (`s_id`, `s_first_name`, `s_last_name`, `s_roll_no`, `s_stream`, `s_semester`, `s_batch`, `s_student_reg`, `s_phone_no`, `flag`) VALUES
(3, 'Mohsin', 'Maqbool', '41', 'BAC', '4th', '2020', '875-IIT-2021', '7006414090', '0');

-- --------------------------------------------------------

--
-- Table structure for table `c_transaction`
--

CREATE TABLE `c_transaction` (
  `t_id` int(11) NOT NULL,
  `t_student_id` int(11) DEFAULT NULL,
  `flag` text DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_transaction`
--

INSERT INTO `c_transaction` (`t_id`, `t_student_id`, `flag`) VALUES
(66, 2, 'COMPLETED'),
(67, 2, 'COMPLETED'),
(68, 3, 'COMPLETED');

-- --------------------------------------------------------

--
-- Table structure for table `c_transaction_cart`
--

CREATE TABLE `c_transaction_cart` (
  `c_c_id` int(11) NOT NULL,
  `c_equipment_id` int(10) DEFAULT NULL,
  `c_initail_status` text DEFAULT NULL,
  `c_start_date` text DEFAULT NULL,
  `c_return_date` text DEFAULT NULL,
  `c_transaction_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_transaction_cart`
--

INSERT INTO `c_transaction_cart` (`c_c_id`, `c_equipment_id`, `c_initail_status`, `c_start_date`, `c_return_date`, `c_transaction_id`) VALUES
(39, 1, 'EXCELLENT', '2024-01-26', '2024-01-26', 66),
(40, 1, 'GOOD', '2024-01-26', '2024-01-26', 67),
(41, 3, 'GOOD', '2024-01-26', '2024-01-26', 67),
(42, 5, 'DAMAGED', '2024-01-26', '2024-01-26', 68),
(43, 2, 'EXCELLENT', '2024-01-26', '2024-01-26', 68),
(44, 4, 'GOOD', '2024-01-26', '2024-01-26', 68),
(45, 10, 'EXCELLENT', '2024-01-26', '2024-01-26', 68),
(46, 6, 'POOR', '2024-01-26', '2024-01-26', 68),
(47, 12, 'POOR', '2024-01-26', '2024-01-26', 67);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `username` varchar(18) DEFAULT NULL,
  `email_id` varchar(80) DEFAULT NULL,
  `employee_id` varchar(16) DEFAULT NULL,
  `desgination` varchar(22) DEFAULT NULL,
  `d_o_j` date DEFAULT current_timestamp(),
  `flag` varchar(12) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `username`, `email_id`, `employee_id`, `desgination`, `d_o_j`, `flag`, `passwd`) VALUES
(0, 'Mohsin Maqbool', 'admin', 'mohsinmaqbool0@gmail.com', 'E202408', 'Trainer', '2024-01-11', 'Active', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `c_equipment`
--
ALTER TABLE `c_equipment`
  ADD PRIMARY KEY (`e_id`),
  ADD UNIQUE KEY `e_name` (`e_name`);

--
-- Indexes for table `c_student`
--
ALTER TABLE `c_student`
  ADD PRIMARY KEY (`s_id`),
  ADD UNIQUE KEY `s_student_reg` (`s_student_reg`),
  ADD UNIQUE KEY `s_student_reg_2` (`s_student_reg`);

--
-- Indexes for table `c_transaction`
--
ALTER TABLE `c_transaction`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `c_transaction_cart`
--
ALTER TABLE `c_transaction_cart`
  ADD PRIMARY KEY (`c_c_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `c_equipment`
--
ALTER TABLE `c_equipment`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `c_student`
--
ALTER TABLE `c_student`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `c_transaction`
--
ALTER TABLE `c_transaction`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `c_transaction_cart`
--
ALTER TABLE `c_transaction_cart`
  MODIFY `c_c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
