-- Create database and set default parameters
CREATE DATABASE IF NOT EXISTS megaminds;
USE megaminds;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Set character set and collation
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Table structure for table `pages`
-- --------------------------------------------------------

CREATE TABLE `pages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FreindlyName` varchar(50) NOT NULL,
  `LinkAddress` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------

CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert data into `users`
INSERT INTO `users` (`ID`, `FName`, `LName`, `Email`, `Password`, `role`) VALUES
(25, 'Nouran', 'Hassan', 'Nouran@gmail.com', 1234, 2),
(27, 'Roaa', 'Khaled', 'Roaa@gmail.com', 246, 1),
(36, 'Jana', 'Hassan', 'haha@gmail.com', 0, 1),
(37, 'Salma', 'Ahmed', 'salma@gmail.com', 111, 1),
(38, 'Yahia', 'Tamer', 'yahia@gmail.com', 222, 1),
(39, 'Mayar', 'Khaled', 'mayar@gmail.com', 333, 1),
(40, 'Hussein', 'Magdy', 'huissen@gmail.com', 123, 1);

-- --------------------------------------------------------
-- Table structure for table `usertype`
-- --------------------------------------------------------

CREATE TABLE `usertype` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `UserTypeName` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------
-- Table structure for table `usertype_pages`
-- --------------------------------------------------------

CREATE TABLE `usertype_pages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL,
  `PageID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `role` (`role`),
  KEY `PageID` (`PageID`),
  CONSTRAINT `usertype_pages_role_fk` FOREIGN KEY (`role`) REFERENCES `usertype` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `usertype_pages_page_fk` FOREIGN KEY (`PageID`) REFERENCES `pages` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------
-- AUTO_INCREMENT for dumped tables
-- --------------------------------------------------------

-- AUTO_INCREMENT for table `pages`
ALTER TABLE `pages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

-- AUTO_INCREMENT for table `users`
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

-- AUTO_INCREMENT for table `usertype`
ALTER TABLE `usertype`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

-- AUTO_INCREMENT for table `usertype_pages`
ALTER TABLE `usertype_pages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
