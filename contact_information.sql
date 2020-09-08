-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2020 at 11:35 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact_information`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `birth_date` date NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `first_name`, `last_name`, `birth_date`, `email`) VALUES
(1, 'Nawshin', 'Ahmed', '1993-09-09', 'nawshin603@gmail.com'),
(2, 'Shuayeb', 'Ahmed', '1990-09-16', 'shuayeb890@gmail.com'),
(4, 'test2', 'test2last', '2020-09-01', 'test2@gmail.com'),
(5, 'test3', 'test3last', '2020-09-08', 'test3@gmail.com'),
(6, 'test4', 'test4last', '2020-09-08', 'test4@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `location_type` varchar(150) NOT NULL,
  `street` text NOT NULL,
  `city` varchar(150) NOT NULL,
  `state` varchar(150) NOT NULL,
  `zip` varchar(150) NOT NULL,
  `country` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `contact_id`, `location_type`, `street`, `city`, `state`, `zip`, `country`) VALUES
(1, 1, 'home', 'hose no 55, dhanmondi', 'Dhaka', 'Dhaka', '1215', 'Bangladesh'),
(2, 2, 'Banani', 'House 32 Banani', 'Dhaka', 'Dhaka', '12145', 'Bangladesh'),
(3, 1, 'office', 'Tejgaon Industrial Area', 'Dhaka', 'Dhaka', '12134', 'Bangladesh'),
(4, 4, 'home', 'dhaka', 'dhaka', 'dhaka', '1215', 'Bangladesh'),
(5, 5, 'Bashundhara R/A', 'Dhaka', 'Dhaka', 'Dhaka', '1216', 'Bangladesh'),
(6, 6, 'test', 'test678', 'Dhaka', 'Dhaka', '1234', 'Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `phone_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `phone_type` varchar(150) NOT NULL,
  `number` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`phone_id`, `contact_id`, `phone_type`, `number`) VALUES
(1, 1, 'mobile', '8801680067688'),
(2, 1, 'landphone', '98765435'),
(3, 2, 'office', '4567829787'),
(4, 4, 'home', '67897655'),
(5, 5, 'office', '46789765'),
(6, 6, 'home', '01680067688');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`phone_id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `phone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`contact_id`);

--
-- Constraints for table `phones`
--
ALTER TABLE `phones`
  ADD CONSTRAINT `phones_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`contact_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
