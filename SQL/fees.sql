-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 02:34 PM
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
-- Database: `fees`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(100) NOT NULL DEFAULT '../uploads/adminplaceholder.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `picture`) VALUES
(1, 'Ahmad Ali', 'uqaabhaider153@gmail.com', '$2y$10$qphhAh2uu12FoXnbcyXK1.popXXhiDTGdSLWI9ATvYAME.gsIUgB6', '../uploads/1733825910_b2.jpeg'),
(2, 'Muhammad Rizwan', 'mrab949@gmail.com', '$2y$10$2zpupL6im6LkaFMdiCs77.v74LkInZblQupqr38Z9EBieB.Bi4wf2', '../uploads/1734093721_1733404595_14.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `challan`
--

CREATE TABLE `challan` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(50) NOT NULL,
  `session` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `challan` varchar(255) DEFAULT '',
  `fee_status` enum('unpaid','pending','paid') DEFAULT 'unpaid',
  `uploaded_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `challan`
--

INSERT INTO `challan` (`id`, `roll_no`, `session`, `semester`, `amount`, `challan`, `fee_status`, `uploaded_date`) VALUES
(1, 'CPE-1', '2020-2024', '8th Semester', 55600, '../uploads/1733775098_1.jpg', 'paid', '2024-12-09 20:11:38'),
(2, 'CPE-2', '2020-2024', '8th Semester', 45609, '../uploads/1733775161_5.jpg', 'paid', '2024-12-09 20:12:41'),
(3, 'CPE-3', '2020-2024', '8th Semester', 56005, '../uploads/1733775219_7.jpg', 'paid', '2024-12-09 20:13:39'),
(4, 'CPE-4', '2020-2024', '8th Semester', 55600, '../uploads/1733775271_3.jpg', 'paid', '2024-12-09 20:14:31'),
(5, 'CPE-5', '2020-2024', '8th Semester', 55600, '../uploads/1733775319_3.jpg', 'paid', '2024-12-09 20:15:19'),
(6, 'CPE-6', '2020-2024', '8th Semester', 55606, '../uploads/1733775368_13.jpg', 'paid', '2024-12-09 20:16:08'),
(7, 'CPE-7', '2020-2024', '8th Semester', 55600, '../uploads/1733775440_11.jpg', 'paid', '2024-12-09 20:17:20'),
(8, 'CPE-8', '2020-2024', '8th Semester', 56777, '../uploads/1733775488_13.jpg', 'paid', '2024-12-09 20:18:08'),
(16, 'CPE-2', '2023-2027', '4th Semester', 45609, '../uploads/1733821398_sp.jpg', 'paid', '2024-12-10 09:03:18'),
(17, 'CPE-6', '2023-2027', '3rd Semester', 55606, '../uploads/1733823117_BGpic.jpg', 'paid', '2024-12-10 09:31:57'),
(18, 'CPE-6', '2023-2027', '4th Semester', 55600, '../uploads/1733824223_bf.jpg', 'paid', '2024-12-10 09:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `challanmsg`
--

CREATE TABLE `challanmsg` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(50) NOT NULL,
  `session` varchar(50) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `challanmsg`
--

INSERT INTO `challanmsg` (`id`, `roll_no`, `session`, `subject`, `message`, `date`) VALUES
(1, 'CPE-1', '2020-2024', 'Your Challan Has Been Accepted', 'Dear Rizwan,<br><br>We are pleased to inform you that your fee challan for 8th Semester has been <strong>Accepted</strong>.<br>Your payment has been successfully processed.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 20:19:37'),
(2, 'CPE-3', '2020-2024', 'Your Challan Has Been Accepted', 'Dear Imran,<br><br>We are pleased to inform you that your fee challan for 8th Semester has been <strong>Accepted</strong>.<br>Your payment has been successfully processed.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 20:20:04'),
(3, 'CPE-4', '2020-2024', 'Your Challan Has Been Accepted', 'Dear Zeeshan,<br><br>We are pleased to inform you that your fee challan for 8th Semester has been <strong>Accepted</strong>.<br>Your payment has been successfully processed.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 20:20:21'),
(4, 'CPE-6', '2020-2024', 'Your Challan Has Been Accepted', 'Dear Riyaz,<br><br>We are pleased to inform you that your fee challan for 8th Semester has been <strong>Accepted</strong>.<br>Your payment has been successfully processed.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 20:20:42'),
(5, 'CPE-2', '2020-2024', 'Your Challan Has Been Accepted', 'Dear Irfan,<br><br>We are pleased to inform you that your fee challan for 8th Semester has been <strong>Accepted</strong>.<br>Your payment has been successfully processed.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 20:21:00'),
(6, 'CPE-7', '2020-2024', 'Your Challan Has Been Accepted', 'Dear Qaswer,<br><br>We are pleased to inform you that your fee challan for 8th Semester has been <strong>Accepted</strong>.<br>Your payment has been successfully processed.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 20:21:19'),
(7, 'CPE-8', '2020-2024', 'Your Challan Has Been Accepted', 'Dear Rabia,<br><br>We are pleased to inform you that your fee challan for 8th Semester has been <strong>Accepted</strong>.<br>Your payment has been successfully processed.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 20:21:36'),
(8, 'CPE-5', '2020-2024', 'Your Challan Has Been Accepted', 'Dear Amna,<br><br>We are pleased to inform you that your fee challan for 8th Semester has been <strong>Accepted</strong>.<br>Your payment has been successfully processed.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 20:21:54'),
(9, 'CPE-2', '2024-2028', 'Your Challan Has Been Rejected', 'Dear ,<br><br>We regret to inform you that your fee challan for  has been <strong>Rejected</strong>.<br>Unfortunately, your payment could not be processed. Please review and resubmit.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 21:38:31'),
(10, 'CPE-2', '2024-2028', 'Your Challan Has Been Rejected', 'Dear ,<br><br>We regret to inform you that your fee challan for 1st Semester has been <strong>Rejected</strong>.<br>Unfortunately, your payment could not be processed. Please review and resubmit.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 21:42:13'),
(11, 'CPE-2', '2024-2028', 'Your Challan Has Been Rejected', 'Dear ,<br><br>We regret to inform you that your fee challan for 1st Semester has been <strong>Rejected</strong>.<br>Unfortunately, your payment could not be processed. Please review and resubmit.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 21:43:53'),
(12, 'CPE-2', '2024-2028', 'Your Challan Has Been Rejected', 'Dear ,<br><br>We regret to inform you that your fee challan for 2nd Semester has been <strong>Rejected</strong>.<br>Unfortunately, your payment could not be processed. Please review and resubmit.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 21:44:51'),
(13, 'CPE-2', '2024-2028', 'Your Challan Has Been Rejected', 'Dear ,<br><br>We regret to inform you that your fee challan for 1st Semester has been <strong>Rejected</strong>.<br>Unfortunately, your payment could not be processed. Please review and resubmit.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 21:46:25'),
(14, 'CPE-2', '2024-2028', 'Your Challan Has Been Rejected', 'Dear ,<br><br>We regret to inform you that your fee challan for 1st Semester has been <strong>Rejected</strong>.<br>Unfortunately, your payment could not be processed. Please review and resubmit.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 21:49:53'),
(15, 'CPE-2', '2024-2028', 'Your Challan Has Been Rejected', 'Dear Umer,<br><br>We regret to inform you that your fee challan for 1st Semester has been <strong>Rejected</strong>.<br>Unfortunately, your payment could not be processed. Please review and resubmit.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-09 21:52:52'),
(16, 'CPE-1', '2024-2028', 'Your Challan Has Been Rejected', 'Dear Ali Ahmad,<br><br>We regret to inform you that your fee challan for 1st Semester has been <strong>Rejected</strong>.<br>Unfortunately, your payment could not be processed. Please review and resubmit.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-10 04:57:21'),
(17, 'CPE-2', '2023-2027', 'Your Challan Has Been Accepted', 'Dear M Raza,<br><br>We are pleased to inform you that your fee challan for 4th Semester has been <strong>Accepted</strong>.<br>Your payment has been successfully processed.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-10 09:07:53'),
(18, 'CPE-6', '2023-2027', 'Your Challan Has Been Accepted', 'Dear Rizwan,<br><br>We are pleased to inform you that your fee challan for 3rd Semester has been <strong>Accepted</strong>.<br>Your payment has been successfully processed.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-10 09:34:13'),
(19, 'CPE-6', '2023-2027', 'Your Challan Has Been Accepted', 'Dear Uqaab Haider,<br><br>We are pleased to inform you that your fee challan for 4th Semester has been <strong>Accepted</strong>.<br>Your payment has been successfully processed.<br>If you have any questions, feel free to contact us.<br><br>Best regards,<br>Department of Computer Engineering<br>Bahauddin Zakariya University, Multan', '2024-12-10 10:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `comment`, `created_at`) VALUES
(1, 'Muhammad Rizwan', 'mrab949@gmail.com', 'Thanks for developing such a nice system! I really enjoy this system as it has a lot of functionalities and user friendly.', '2024-12-10 05:03:28'),
(2, 'Ahmad Ali', 'uqaabhaider@gmail.com', 'Thanks for  developing such a nice system!', '2024-12-10 05:06:27'),
(3, 'Muhammad Rehan', 'uqaabhaider153@gmail.com', 'aansnksnksnn', '2024-12-10 07:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `subject`, `message`, `date`) VALUES
(1, 'Fee Due Date', 'Dear students please ensure to pay your dues before the due date.', '2024-12-10 04:54:02'),
(2, 'Fee Due Date', 'message', '2024-12-10 09:28:31'),
(3, 'Scholarship Notice', 'message', '2024-12-10 10:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `roll_no` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `session` varchar(50) NOT NULL,
  `id_card` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `fee_status` enum('unpaid','pending','paid') DEFAULT 'unpaid',
  `due_date` date DEFAULT NULL,
  `label` varchar(100) DEFAULT '1st Semester',
  `picture` varchar(255) NOT NULL DEFAULT 'studentplaceholder.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `father_name`, `roll_no`, `email`, `session`, `id_card`, `dob`, `gender`, `fee_status`, `due_date`, `label`, `picture`) VALUES
(1, 'Rizwan', 'Muhammad', 'CPE-1', 'mrab1@gmail.com', '2020-2024', '1234567890121', '2024-12-01', 'male', 'paid', '2024-12-11', '8th Semester', 'studentplaceholder.jpg'),
(2, 'Irfan', 'Haji Muhammad Bukhsh', 'CPE-2', 'mrab2@gmail.com', '2020-2024', '1234567890122', '2024-12-01', 'male', 'paid', '2024-12-11', '8th Semester', 'studentplaceholder.jpg'),
(3, 'Imran', 'Ramzan', 'CPE-3', 'mrab3@gmail.com', '2020-2024', '1234567890123', '2024-12-01', 'male', 'paid', '2024-12-11', '8th Semester', 'studentplaceholder.jpg'),
(4, 'Zeeshan', 'Haji', 'CPE-4', 'mrab4@gmail.com', '2020-2024', '1234567890124', '2024-12-01', 'male', 'paid', '2024-12-11', '8th Semester', 'studentplaceholder.jpg'),
(5, 'Amna', 'Zulfiqar', 'CPE-5', 'mrab5@gmail.com', '2020-2024', '1234567890125', '2024-12-01', 'female', 'paid', '2024-12-11', '8th Semester', 'studentplaceholder.jpg'),
(6, 'Riyaz', 'Bashir', 'CPE-6', 'mrab6@gmail.com', '2020-2024', '1234567890126', '2024-12-01', 'male', 'paid', '2024-12-11', '8th Semester', 'studentplaceholder.jpg'),
(7, 'Qaswer', 'Falak shair', 'CPE-7', 'mrab7@gmail.com', '2020-2024', '1234567890127', '2024-12-01', 'male', 'paid', '2024-12-11', '8th Semester', 'studentplaceholder.jpg'),
(8, 'Rabia', 'Allah Yar', 'CPE-8', 'mrab8@gmail.com', '2020-2024', '1234567890128', '2024-12-01', 'female', 'paid', '2024-12-11', '8th Semester', 'studentplaceholder.jpg'),
(9, 'Habeeb', 'Rathor', 'CPE-1', 'mrab11@gmail.com', '2021-2025', '1234567890111', '2024-12-01', 'male', 'unpaid', '2025-01-06', '7th Semester', 'studentplaceholder.jpg'),
(10, 'Rizoo', 'Muhammad', 'CPE-2', 'mrab12@gmail.com', '2021-2025', '1234567890112', '2024-12-01', 'male', 'unpaid', '2025-01-06', '7th Semester', 'studentplaceholder.jpg'),
(11, 'Rizwan B', 'Akmal', 'CPE-3', 'mrab13@gmail.com', '2021-2025', '1234567890113', '2024-12-01', 'male', 'unpaid', '2025-01-06', '7th Semester', 'studentplaceholder.jpg'),
(12, 'Eman', 'Shahid', 'CPE-4', 'mrab14@gmail.com', '2021-2025', '1234567890114', '2024-12-01', 'female', 'unpaid', '2025-01-06', '7th Semester', 'studentplaceholder.jpg'),
(13, 'Ruki', 'Ruka', 'CPE-5', 'mrab15@gmail.com', '2021-2025', '1234567890115', '2024-12-01', 'female', 'unpaid', '2025-01-06', '7th Semester', 'studentplaceholder.jpg'),
(14, 'HAMZA', 'Muhammad', 'CPE-6', 'mrab16@gmail.com', '2021-2025', '1234567890116', '2024-12-01', 'male', 'unpaid', '2025-01-06', '7th Semester', 'studentplaceholder.jpg'),
(15, 'Noshair', 'Nosha', 'CPE-7', 'mrab17@gmail.com', '2021-2025', '1234567890117', '2024-12-01', 'male', 'unpaid', '2025-01-06', '7th Semester', 'studentplaceholder.jpg'),
(16, 'Rubab', 'Rehan', 'CPE-8', 'mrab18@gmail.com', '2021-2025', '1234567890118', '2024-12-01', 'female', 'unpaid', '2025-01-06', '7th Semester', 'studentplaceholder.jpg'),
(17, 'Rizwan', 'Muhammad', 'CPE-9', 'mrab19@gmail.com', '2021-2025', '1234567890119', '2024-12-01', 'male', 'unpaid', '2025-01-06', '7th Semester', 'studentplaceholder.jpg'),
(18, 'Rehan', 'Khan', 'CPE-1', 'mrab10@gmail.com', '2022-2026', '1234567890100', '2024-12-01', 'male', 'unpaid', '2025-01-03', '5th Semester', 'studentplaceholder.jpg'),
(19, 'Ali', 'Akber', 'CPE-2', 'mrab20@gmail.com', '2022-2026', '1234567890200', '2024-12-01', 'male', 'unpaid', '2025-01-03', '5th Semester', 'studentplaceholder.jpg'),
(20, 'Kashif', 'Ahmad', 'CPE-3', 'mrab30@gmail.com', '2022-2026', '1234567890300', '2024-12-01', 'male', 'unpaid', '2025-01-03', '5th Semester', 'studentplaceholder.jpg'),
(21, 'Sidra', 'Dildar', 'CPE-4', 'mrab40@gmail.com', '2022-2026', '1234567890400', '2024-12-01', 'female', 'unpaid', '2025-01-03', '5th Semester', 'studentplaceholder.jpg'),
(22, 'Saima', 'Ahmad', 'CPE-5', 'mrab500@gmail.com', '2022-2026', '1234567890500', '2024-12-01', 'female', 'unpaid', '2025-01-03', '5th Semester', 'studentplaceholder.jpg'),
(23, 'Adil', 'Master', 'CPE-6', 'mrab600@gmail.com', '2022-2026', '1234567890600', '2024-12-01', 'male', 'unpaid', '2025-01-03', '5th Semester', 'studentplaceholder.jpg'),
(24, 'Nisha', 'Kamal', 'CPE-7', 'mrab700@gmail.com', '2022-2026', '1234567890700', '2024-12-01', 'female', 'unpaid', '2025-01-03', '5th Semester', 'studentplaceholder.jpg'),
(25, 'Mohsin', 'Falak shair', 'CPE-8', 'mrab800@gmail.com', '2022-2026', '1234567890800', '2024-12-01', 'male', 'unpaid', '2025-01-03', '5th Semester', 'studentplaceholder.jpg'),
(26, 'Ayesha noreen', 'Mazhar Hussain', 'CPE-1', 'mrab10000@gmail.com', '2023-2027', '6676767556456', '2024-12-01', 'female', 'unpaid', '2024-12-25', '3rd Semester', 'studentplaceholder.jpg'),
(27, 'M Raza', 'Haq Nawaz', 'CPE-2', 'mrab1001@gmail.com', '2023-2027', '1004567890123', '2024-12-01', 'male', 'unpaid', '2024-12-25', '3rd Semester', '../uploads/1733810128_raaz.jpg'),
(28, 'Aniqa ', 'Rathor', 'CPE-3', 'mrab1002@gmail.com', '2023-2027', '1002567890123', '2024-12-01', 'female', 'unpaid', '2024-12-25', '3rd Semester', 'studentplaceholder.jpg'),
(29, 'Uqaab', 'Ahmad Hassan', 'CPE-4', 'mrab10003@gmail.com', '2023-2027', '1200567890123', '2024-12-01', 'male', 'unpaid', '2024-12-25', '3rd Semester', 'studentplaceholder.jpg'),
(30, 'Bushra', 'Hamid', 'CPE-5', 'mrab939@gmail.com', '2023-2027', '1200067890123', '2024-12-01', 'female', 'unpaid', '2024-12-25', '3rd Semester', 'studentplaceholder.jpg'),
(31, 'Muhammad Rizwan', 'Haji Muhammad Bukhsh', 'CPE-6', 'mrab94@gmail.com', '2023-2027', '3610265395415', '2024-12-01', 'male', 'paid', '2024-12-27', '3rd Semester', '../uploads/1734091203_1733404595_14.jpg'),
(32, 'Ahmad', 'Major', 'CPE-7', 'mrab919@gmail.com', '2023-2027', '1230007890123', '2024-12-01', 'male
