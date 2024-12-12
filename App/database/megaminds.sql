-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 07:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `tags` text NOT NULL,
  `Image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_ID`, `course_name`, `description`, `level`, `start_date`, `end_date`, `rating`, `fees`, `tags`, `Image`) VALUES
(2, 'Introduction to Artificial Intelligence', 'This course provides an overview of Artificial Intelligence (AI), including its history, principles, and applications. Topics include problem-solving, search algorithms, knowledge representation, reasoning, and basic machine learning techniques. Students will explore real-world applications like robotics, natural language processing, and AI ethics.', 'beginner', '2024-11-17', '2024-12-24', 0, 90, 'ai', ''),
(3, 'Full Stack Developer', 'This course covers the complete web development process, including both front-end and back-end technologies. Students will learn HTML, CSS, JavaScript, React (or Angular), Node.js, Express, and databases like MongoDB or SQL. The course emphasizes creating fully functional, scalable web applications and understanding the deployment process.', 'advanced', '2024-12-01', '2024-12-27', 0, 90, 'swe', ''),
(4, 'Deep Learning', 'Deep Learning delves into advanced machine learning techniques inspired by the structure and function of the human brain. Topics include neural networks, convolutional neural networks (CNNs), recurrent neural networks (RNNs), and frameworks like TensorFlow or PyTorch. Students will apply these methods to tasks like image recognition, natural language processing, and autonomous systems.', 'advanced', '2024-09-01', '2024-12-31', 0, 300, 'ai', ''),
(5, 'Cloud Computing and Big Data', 'This course focuses on cloud computing concepts and big data management. Students learn about cloud service models (IaaS, PaaS, SaaS), distributed computing, Hadoop, Spark, and data storage solutions. The course emphasizes analyzing massive datasets and leveraging cloud platforms like AWS or Azure.\r\n\r\n', 'beginner', '2024-10-01', '2024-12-30', 0, 300, 'cs', ''),
(6, 'Data structures and Algorithms', 'This course provides a strong foundation in organizing and processing data efficiently. Topics include arrays, linked lists, stacks, queues, trees, graphs, sorting, and searching algorithms. Students will develop problem-solving skills and optimize computational performance.', 'intermediate', '2024-11-06', '2025-01-04', 0, 300, 'cs', ''),
(7, 'Networks and Security', 'This course introduces the fundamentals of computer networks and cybersecurity. Topics include network protocols, architecture, and hardware, along with encryption, firewalls, intrusion detection, and ethical hacking. Students will gain skills in designing secure systems and mitigating cyber threats.', 'intermediate', '2024-09-11', '2024-10-10', 0, 70, 'INS', ''),
(8, 'Object-Oriented Programming (OOP)', 'Object-Oriented Programming introduces the principles of OOP, including classes, objects, inheritance, polymorphism, and encapsulation. The course emphasizes designing reusable and maintainable code using languages like Java, Python, or C++.', 'intermediate', '2024-12-03', '2025-01-15', 0, 200, 'swe', ''),
(9, 'Image Processing', 'Image Processing covers techniques for manipulating and analyzing digital images. Topics include image transformations, filters, edge detection, segmentation, and feature extraction. Students will work on applications in computer vision, medical imaging, and multimedia.', 'beginner', '2024-12-03', '2025-02-04', 0, 300, 'ai', '');

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
(42, 'laila', 'amgad', 'laila@gmail.com', 12345, 1),
(43, 'Malakkk', 'Mohamed', 'malak@gmail.com', 123, 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--

CREATE TABLE `user_courses` (
  `user_id` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_courses`
--

INSERT INTO `user_courses` (`user_id`, `course_ID`) VALUES
(43, 2),
(43, 6);

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
-- Indexes for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD PRIMARY KEY (`user_id`,`course_ID`),
  ADD KEY `course_ID` (`course_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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

--
-- Constraints for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD CONSTRAINT `user_courses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `user_courses_ibfk_2` FOREIGN KEY (`course_ID`) REFERENCES `courses` (`course_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
