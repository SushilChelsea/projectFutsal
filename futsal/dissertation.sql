-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2018 at 02:36 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dissertation`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(3, 'leo', 'leo'),
(4, 'dan', 'dan');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `futsal_id` int(11) NOT NULL,
  `timing` varchar(255) NOT NULL,
  `date` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `customer_name`, `futsal_id`, `timing`, `date`, `customer_id`) VALUES
(26, 'Suman', 1, '12-1Pm', '2018/4/27', 3);

-- --------------------------------------------------------

--
-- Table structure for table `futsals`
--

CREATE TABLE `futsals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` int(10) NOT NULL,
  `location` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `futsals`
--

INSERT INTO `futsals` (`id`, `name`, `email`, `password`, `telephone`, `location`, `city`, `img`, `description`) VALUES
(1, 'Surya Futsal', 'suryafutsal@gmail.com', 'futsal', 2147483647, 'dhumbarahi', 'Kathmandu', 'wireframe.png', 'This is one of the best futsal.'),
(2, 'White Horse Futsal', 'whorsefutsal@gmail.com', 'futsal', 14526352, 'sukhedhara', 'Kathmandu', 'viewadmin.png', 'Futsal servie providing since 2010.'),
(3, 'Dhuku Futsal', 'dhukufutsal@gmail.com', 'futsal', 14578956, 'dhumbarahi', 'Kathmandu', 'dhuku.jpg', 'One of the beautifully structured futsal.');

-- --------------------------------------------------------

--
-- Table structure for table `hourly_rates`
--

CREATE TABLE `hourly_rates` (
  `id` int(11) NOT NULL,
  `hourly_rate` varchar(55) NOT NULL,
  `futsal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hourly_rates`
--

INSERT INTO `hourly_rates` (`id`, `hourly_rate`, `futsal_id`) VALUES
(1, '50', 1),
(2, '40', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `futsal_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `is_open` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `futsal_id`, `date`, `is_open`, `description`) VALUES
(1, 1, '2018/4/20', 'no', 'Inter-futsal competetion'),
(2, 1, '2018/4/20', 'no', 'Strike on this area.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `gender`, `location`, `city`) VALUES
(3, 'Suman', 'Pandey', 'suman@gmail.com', 'suman', 'male', 'Sinamangal', 'Kathmandu'),
(4, 'Lienol', 'Messi', 'messi@gmail.com', 'messi', 'male', 'Koteswor', 'Kathmandu'),
(5, 'Sudep', 'Devkota', 'sudep@gmail.com', 'sudip', 'male', 'Maitidevi', 'Kathmandu'),
(6, 'Bikash', 'KC', 'bikash@gmail.com', 'bikash', 'male', 'Kirtipur', 'Kathmandu'),
(7, 'Saxxam', 'Shrestha', 'saxxam@gmail.com', 'saxxam', 'male', 'Kalopool', 'Kathmandu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `futsals`
--
ALTER TABLE `futsals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `hourly_rates`
--
ALTER TABLE `hourly_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `futsals`
--
ALTER TABLE `futsals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hourly_rates`
--
ALTER TABLE `hourly_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
