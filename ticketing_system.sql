-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 03:35 AM
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
-- Database: `ticketing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `Name` text NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Name`, `username`, `password`, `email`, `role`) VALUES
('Guidance', 'guidance123', 'guidance123', 'omegarobertlois@gmail.com', 'Admin'),
('Sabin L. Valcos', 'sabin123', 'sabin123', 'sabin123@gmail.com', 'Teacher'),
('Demetrio L. Galang', 'demetrio123', 'demetrio123', 'demetrio123@gmail.com', 'Teacher'),
('Zion T. Vergara', 'zion123', 'zion123', 'zion123@gmail.com', 'Teacher'),
('Jaime P. Mendez', 'jaime123', 'jaime123', 'jaime123@gmail.com', 'Teacher'),
('Ethaniel H. Alvarado', 'ethaniel123', 'ethaniel123', 'ethaniel123@gmail.com', 'Teacher');

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `TOKEN` varchar(8) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_tokens`
--

INSERT INTO `auth_tokens` (`TOKEN`, `datetime`) VALUES
('Uow02p13', '2024-05-12 12:49:41'),
('', '2024-05-13 00:36:42'),
('aQsku8Kj', '2024-05-13 00:40:03'),
('FSMvdInP', '2024-05-13 00:42:15'),
('HNzbVF4t', '2024-05-13 00:59:10'),
('V081mfX1', '2024-05-13 01:05:25'),
('2ZjVY7EQ', '2024-05-13 01:58:57'),
('vMbz9xk2', '2024-05-13 02:00:43'),
('HiEKOyzn', '2024-05-13 02:02:04'),
('B0aNnmqW', '2024-05-13 02:04:42'),
('rJHgqmqG', '2024-05-13 02:07:06'),
('H9BIxagx', '2024-05-13 02:12:50'),
('IUT1PfHi', '2024-05-13 02:15:55'),
('TxXw1cAQ', '2024-05-13 02:18:06'),
('pXNLsrAO', '2024-05-13 02:27:23'),
('BZ2UkDzt', '2024-05-13 02:31:28'),
('wVvTKhAt', '2024-05-13 02:33:41'),
('MT7IDzyO', '2024-05-13 02:37:35'),
('0cN0c0XQ', '2024-05-13 02:46:53'),
('mxj6eGwA', '2024-05-13 02:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `report_ID` varchar(8) NOT NULL,
  `remarks` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `remarks`
--

INSERT INTO `remarks` (`report_ID`, `remarks`) VALUES
('I40Pq184', 1),
('CTuOmAhK', 1),
('pvdKi4Uo', 1),
('zvPvyKLZ', 1),
('Tg9mYSqj', 1),
('UUFqmQAD', 1),
('FgA0SLJz', 1),
('Z0hrcMV3', 1),
('aF5ovr1z', 1),
('lKaCKdMw', 1),
('mScY8WOa', 1),
('wlNcxezG', 1),
('QawH3WzT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `report_records`
--

CREATE TABLE `report_records` (
  `report_ID` varchar(8) NOT NULL,
  `date_time` datetime NOT NULL,
  `student_name` text NOT NULL,
  `offense_type` varchar(128) NOT NULL,
  `further_details` varchar(512) NOT NULL,
  `reporter` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report_records`
--

INSERT INTO `report_records` (`report_ID`, `date_time`, `student_name`, `offense_type`, `further_details`, `reporter`) VALUES
('I40Pq184', '2024-05-08 08:04:21', 'John Michael E. Gomez', 'Gambling', 'The student was seen playing lucky  at the back of the school yard while betting 20 pesos per call.', 'Sabin Marks'),
('CTuOmAhK', '2024-05-06 13:49:00', 'Mike G. Saludo', 'Smoking and Drinking Alcoholic Drinks', 'The student was seen drinking beer during lunch break in the comfort room alongside two other students.', 'Sabin Marks'),
('pvdKi4Uo', '2024-05-03 10:30:00', 'Micah T. De Leus', 'Forging of Signatures', 'The student attempted to forge his adviser\'s signature.', 'Sabin Marks'),
('zvPvyKLZ', '2024-05-03 11:04:00', 'John E. Saver', 'Cutting Classes', 'The student was seen outside the campus cutting classes by the school guard.', 'Sabin Marks'),
('Tg9mYSqj', '2024-05-07 07:21:00', 'Riley M. Rosales', 'Cutting Classes', 'A student was caught cutting classes near the basketball court during a routine check of the school premises alongside with other students.', 'Demetrio L. Galang'),
('UUFqmQAD', '2024-05-07 09:47:00', 'Mike G. Saludo', 'Gambling', 'The student was engaged in gambling and playing cards with other students in their homeroom as reported by the other teachers in the other room.', 'Demetrio L. Galang'),
('FgA0SLJz', '2024-05-09 14:55:00', 'Theo A. Tecson', 'Cutting Classes', 'The student was seen exiting the campus while classes were still ongoing by the school guard, the student was attempting to go to the nearby computer shop.', 'Ethaniel H. Alvarado'),
('Z0hrcMV3', '2024-05-09 14:41:00', 'John E. Saver', 'Cutting Classes', 'The student was seen going out with other students attempting to go to the nearby computer shop.', 'Sabin Marks'),
('aF5ovr1z', '2024-04-30 07:01:00', 'Albert L. Santiago', 'Not Wearing Proper Uniform', 'The student insisted to not wear the proper uniform and gave unreasonable reasons.', 'Jaime P. Mendez'),
('lKaCKdMw', '2024-05-09 08:08:00', 'Jonathan N. Diaz', 'Stealing', '3 students reported that Jonathan attempted to steal the allowance of one of his classmates during the P.E. class when no one was around the classroom.', 'Jaime P. Mendez'),
('mScY8WOa', '2024-05-07 08:12:00', 'Arvin F. Andres', 'Not Wearing I.D.', 'The student already brought his I.D. but refused to wear it inside the campus.', 'Zion T. Vergara'),
('wlNcxezG', '2024-05-09 08:23:00', 'Jayson R. Concepcion', 'Not Wearing I.D.', 'The student did not wear his I.D. as he claimed that he had forgotten it at home.', 'Zion T. Vergara'),
('QawH3WzT', '2024-04-29 14:55:00', 'Arvin F. Andres', 'Cutting Classes', 'The student was seen in the canteen while the teacher was still tackling the daily lesson.', 'Zion T. Vergara');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
