-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 11:42 AM
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
-- Database: `jobguru`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `created_at`, `image`) VALUES
(1, 'ravi', 'shubhamsahu5nov2016@gmail.com', '123456', '2024-11-08 08:40:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `applied_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `job_id`, `full_name`, `email`, `mobile_no`, `resume`, `applied_on`) VALUES
(3, 24, 'Shubham sahu', 'shubhamsahu5nov2016@gmail.com', '7348537852', 'uploads/673874f71ae496.85724432.pdf', '2024-11-16 10:33:27'),
(4, 16, 'Rahul GUpta', 'rahulgupta123@gmail.com', '7309852559', 'uploads/673875781df450.86379814.pdf', '2024-11-16 10:35:36');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `job_type` enum('Full-Time','Part-Time','Contract','Internship','Temporary','Fresher') NOT NULL,
  `schedule` enum('Morning Shift','Day Shift','Night Shift','Flexible Shift','Fixed Shift') NOT NULL,
  `job_location` varchar(255) DEFAULT NULL,
  `pay` varchar(200) DEFAULT NULL,
  `posted_days` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `job_title`, `job_type`, `schedule`, `job_location`, `pay`, `posted_days`, `image`) VALUES
(14, 'Microsoft', 'Software Engineer', 'Full-Time', 'Fixed Shift', 'Bengaluru', '₹15,00,000 - ₹20,00,000 per year', '7', 'img/ms.png'),
(15, 'Google', 'Data Scientist', 'Full-Time', 'Fixed Shift', 'Hyderabad', '4000000 per year', '5', 'img/google.png'),
(16, 'Amazon Web Services (AWS)', 'Cloud Solutions Architect', 'Full-Time', 'Night Shift', 'Remote (India)', '₹25,00,000 - ₹35,00,000 per year', '15', 'img/amazon.png'),
(17, 'IBM', 'Cybersecurity Analyst', 'Full-Time', 'Fixed Shift', 'Pune', '₹12,00,000 - ₹18,00,000 per year', '10', 'img/ibm.png'),
(18, 'Infosys', 'Java Developer', 'Full-Time', 'Morning Shift', 'Chennai', '₹8,00,000 - ₹12,00,000 per year', '1', 'img/infosys.png'),
(19, 'TCS', 'Java Developer', 'Contract', 'Night Shift', 'Chennai', '₹8,00,000 - ₹12,00,000 per year', '2', 'img/tcs.jpg'),
(20, 'Wipro', 'Front-End Developer', 'Part-Time', 'Night Shift', 'Bengaluru', '₹7,50,000 - ₹10,00,000 per year', '12', 'img/wipro.jpg'),
(21, 'HCL Technologies', 'System Administrator', 'Full-Time', 'Morning Shift', 'Noida', '₹6,00,000 - ₹9,00,000 per year', '1', 'img/hcl.png'),
(22, 'Tech Mahindra', 'Python Developer', 'Internship', 'Day Shift', 'Hyderabad', '₹5,000 - ₹10,000 per month', '3', 'img/tech.png'),
(23, 'Dell Technologies', 'Network Engineer', 'Full-Time', 'Fixed Shift', 'Remote (India)', '₹14,00,000 - ₹18,00,000 per year', '5', 'img/dell.png'),
(24, 'Paytm', 'Backend Developer', 'Full-Time', 'Fixed Shift', 'Noida', '₹10,00,000 - ₹14,00,000 per year', '2', 'img/paytm.png'),
(25, 'Flipkart', 'Backend Developer', 'Full-Time', 'Night Shift', 'Noida', '₹9,00,000 - ₹13,00,000 per year', '6', 'img/flipkart.png'),
(26, 'TCS', 'Backend Developer', 'Full-Time', 'Night Shift', 'Noida', '₹10,00,000 - ₹14,00,000 per year', '7', 'img/tcs.jpg'),
(27, 'Wipro', 'Front-End Developer', 'Full-Time', 'Night Shift', ' Pune', '₹7,50,000 - ₹10,00,000 per year', '4', 'img/wipro.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `created_at`, `image`, `dob`, `address`) VALUES
(5, 'Shubham sahu', 'shubhamsahu5nov2016@gmail.com', '7348537852', '$2y$10$jyhJCAAd9EVoCXCeVTzXbuDEm8HjtTO5p23xIUAcsLPfT4Ad4uooK', '2024-11-16 09:51:57', 'uploads/673875ded8113.jpg', '2003-04-25', 'Rani ki sarai, Azamgarh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
