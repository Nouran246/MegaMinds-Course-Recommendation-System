-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2024 at 03:22 PM
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
-- Database: `megaminds`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_ID` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `level` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `rating` int(11) NOT NULL,
  `fees` int(11) NOT NULL,
  `tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `ID` int(11) NOT NULL,
  `FriendlyName` varchar(50) NOT NULL,
  `LinkAddress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`ID`, `FriendlyName`, `LinkAddress`) VALUES
(1, 'Admin Courses', 'views/Admins/courses.php'),
(2, 'Admin Members', 'views/Admins/members.php'),
(3, 'User Cart', 'views/Users/cart-page.php'),
(4, 'User Courses', 'views/Users/Courses.php'),
(5, 'User Home', 'views/Users/index.php'),
(6, 'Inside Course', 'views/Users/InsideCourse.php'),
(7, 'User Login', 'views/Users/login.php'),
(8, 'Meeting Details', 'views/Users/meeting-details.php'),
(9, 'User Profile', 'views/Users/profile.php'),
(10, 'User Register', 'views/Users/register.php');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` int(11) NOT NULL,
  `usertype_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FName`, `LName`, `Email`, `Password`, `usertype_id`) VALUES
(25, 'Nouran', 'Hassan', 'Nouran@gmail.com', 1234, 2),
(27, 'Roaa', 'Khaled', 'Roaa@gmail.com', 246, 1),
(36, 'Jana', 'Hassan', 'haha@gmail.com', 0, 1),
(37, 'Salma', 'Ahmed', 'salma@gmail.com', 111, 1),
(38, 'Yahia', 'Tamer', 'yahia@gmail.com', 222, 1),
(39, 'Mayar', 'Khaled', 'mayar@gmail.com', 333, 1),
(40, 'Hussein', 'Magdy', 'huissen@gmail.com', 123, 1),
(41, 'laila', 'amgad', 'laila2201298@miueypt.edu.eg', 1234, 1),
(42, 'laila', 'amgad', 'laila@gmail.com', 12345, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `ID` int(11) NOT NULL,
  `UserTypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`ID`, `UserTypeName`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `usertype_pages`
--

CREATE TABLE `usertype_pages` (
  `ID` int(11) NOT NULL,
  `usertype_id` int(11) DEFAULT NULL,
  `PageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_ID`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `users_role_fk` (`usertype_id`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usertype_pages`
--
ALTER TABLE `usertype_pages`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `role` (`usertype_id`),
  ADD KEY `PageID` (`PageID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usertype_pages`
--
ALTER TABLE `usertype_pages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_fk` FOREIGN KEY (`usertype_id`) REFERENCES `usertype` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
