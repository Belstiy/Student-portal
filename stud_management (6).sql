-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 04:07 AM
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
-- Database: `stud_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_classes`
--

CREATE TABLE `assigned_classes` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `assigned_class` varchar(255) NOT NULL,
  `section` varchar(10) NOT NULL,
  `stream` varchar(50) NOT NULL,
  `academic_year` varchar(10) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `assignment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assigned_classes`
--

INSERT INTO `assigned_classes` (`id`, `student_id`, `assigned_class`, `section`, `stream`, `academic_year`, `grade`, `sex`, `assignment_date`) VALUES
(13, 'dbu1403910', 'Class 9-1', 'A', 'Not Selected', '2017', '9', '', '2025-05-02 10:18:51'),
(14, 'dbu1403911', 'Class 9-2', 'A', 'Not Selected', '2017', '9', '', '2025-05-02 10:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `billing_rates`
--

CREATE TABLE `billing_rates` (
  `year` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing_rates`
--

INSERT INTO `billing_rates` (`year`, `amount`) VALUES
(2017, 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `grade` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_name`, `grade`) VALUES
(13, '0007', 'ict', 'Grade 11'),
(14, '01', 'amharic', 'Grade 9'),
(15, '04', 'Biology', 'Grade 9');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `feedback_type` enum('general','academic','facilities','staff','suggestion','complaint') NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `message` text NOT NULL,
  `contact_permission` tinyint(1) DEFAULT 0,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `name`, `email`, `feedback_type`, `rating`, `message`, `contact_permission`, `submitted_at`) VALUES
(1, NULL, 'kebede', 'matiwosyabibal@gmail.com', 'academic', 5, 'good', 0, '2025-05-26 01:45:02'),
(2, NULL, 'kebede', 'matiwosyabibal@gmail.com', 'facilities', 5, 'good', 1, '2025-05-26 01:52:05'),
(3, NULL, 'kebede', 'matiwosyabibal@gmail.com', 'academic', 5, 'good', 1, '2025-05-26 01:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` varchar(50) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `zone` varchar(100) DEFAULT NULL,
  `woreda` varchar(100) DEFAULT NULL,
  `kebele` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `certificate_path` varchar(255) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `grade` varchar(10) DEFAULT NULL,
  `academic_year` varchar(20) DEFAULT NULL,
  `stream` varchar(20) DEFAULT 'Not Selected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `middle_name`, `last_name`, `sex`, `dob`, `region`, `zone`, `woreda`, `kebele`, `phone`, `photo_path`, `certificate_path`, `guardian_name`, `guardian_phone`, `status`, `grade`, `academic_year`, `stream`) VALUES
('dbu1', 'worku', 'tilahun', 'simachewu', 'Male', '2010-01-07', 'Amhara', 'north shewa', 'magate', '01', '0913086270', 'uploads/photos/test1.jpg', 'uploads/certificates/fxsg.pdf', 'Kebede worku', '0913086250', 'Active', '9', '2017', 'Not Selected'),
('dbu1403910', 'abebe', 'tilahun', 'kebede', 'Male', '2003-02-03', 'Amhara', 'north shewa', 'magate', '01', '0913086270', 'uploads/photos/YDS09266 copy.jpg', 'uploads/certificates/photo_2025-04-08_14-53-41.jpg', 'Kebede worku', '0924639875', 'Active', '9', '2017', 'Not Selected'),
('dbu1403911', 'kidist', 'tilahun', 'kebede', 'Female', '2002-02-02', 'Amhara', 'north shewa', 'magate', '01', '0913086270', 'uploads/photos/test1.jpg', 'uploads/certificates/rt.pdf', 'Kebede worku', '0913086250', 'Active', '9', '2017', 'Not Selected'),
('dbu1403912', 'kidist', 'yabibal', 'alemu', 'Male', '2025-06-07', 'Amhara', 'north shewa', 'magate', '01', '0924832989', 'uploads/photos/vecteezy_a-man-driving-a-bus-in-the-city_49647553.jpg', 'uploads/certificates/fxsg.pdf', 'Kebede worku', '0913086270', 'Active', '9', '2025', 'Not Selected'),
('dbu1403915', 'belsete', 'tilahun', 'simachewu', 'Male', '2010-01-07', 'Amhara', 'north shewa', 'magate', '01', '0913086270', 'uploads/photos/test1.jpg', 'uploads/certificates/fxsg.pdf', 'Kebede worku', '0924832989', 'Pending', '9', '2025-2026', 'Not Selected');

-- --------------------------------------------------------

--
-- Table structure for table `student_payment`
--

CREATE TABLE `student_payment` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `slip_path` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `billing_year` varchar(20) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_payment`
--

INSERT INTO `student_payment` (`id`, `student_id`, `amount`, `payment_method`, `slip_path`, `status`, `billing_year`, `submitted_at`) VALUES
(9, 'dbu1403910', 200.00, 'Bank', 'uploads/payment_slips/ss.png', '✔️ Verified', '2017', '2025-05-02 08:58:47'),
(10, 'dbu1403911', 200.00, 'Bank', 'uploads/payment_slips/rt.pdf', '✔️ Verified', '2017', '2025-05-02 09:40:03'),
(11, 'dbu1403912', 200.00, 'Bank', 'uploads/payment_slips/fxsg.pdf', '✔️ Verified', '2017', '2025-05-02 09:40:23'),
(12, 'dbu1403913', 200.00, 'Bank', 'uploads/payment_slips/fxsg.pdf', '✔️ Verified', '2017', '2025-05-02 09:40:53'),
(13, 'dmu1403910', 200.00, 'Bank', 'uploads/payment_slips/fxsg.pdf', 'Pending', '2017', '2025-05-06 16:13:48'),
(14, 'dbu1', 200.00, 'Bank', 'uploads/payment_slips/fxsg.pdf', '✔️ Verified', '2017', '2025-05-07 16:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `student_results`
--

CREATE TABLE `student_results` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `section` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `total` int(11) NOT NULL,
  `average` float NOT NULL,
  `status` varchar(10) NOT NULL,
  `rank` int(11) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_results`
--

INSERT INTO `student_results` (`id`, `student_id`, `grade`, `section`, `year`, `semester`, `total`, `average`, `status`, `rank`, `approved`) VALUES
(15, 'dbu1403911', '9', 'A', '2017', '1', 1075, 97.73, 'Promoted', 1, 1),
(17, 'dbu1', '9', 'A', '2017', '2', 1094, 99.45, 'Promoted', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject_marks`
--

CREATE TABLE `subject_marks` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `year` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `amharic` int(11) DEFAULT NULL,
  `english` int(11) DEFAULT NULL,
  `mathematics` int(11) DEFAULT NULL,
  `biology` int(11) DEFAULT NULL,
  `chemistry` int(11) DEFAULT NULL,
  `physics` int(11) DEFAULT NULL,
  `history` int(11) DEFAULT NULL,
  `civics` int(11) DEFAULT NULL,
  `geography` int(11) DEFAULT NULL,
  `it` int(11) DEFAULT NULL,
  `pe` int(11) DEFAULT NULL,
  `technicaldrawing` int(11) DEFAULT NULL,
  `business` int(11) DEFAULT NULL,
  `economics` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_marks`
--

INSERT INTO `subject_marks` (`id`, `student_id`, `year`, `semester`, `amharic`, `english`, `mathematics`, `biology`, `chemistry`, `physics`, `history`, `civics`, `geography`, `it`, `pe`, `technicaldrawing`, `business`, `economics`) VALUES
(9, 'dbu1403911', '2017', '1', 100, 100, 100, 100, 95, 96, 94, 95, 96, 99, 100, NULL, NULL, NULL),
(11, 'dbu1', '2017', '2', 100, 100, 100, 100, 99, 96, 99, 100, 100, 100, 100, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` varchar(20) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `first_name`, `last_name`, `sex`, `email`, `phone`, `department`, `qualification`, `created_at`) VALUES
('12', 'micael', 'tadese', 'Male', 'l@gmail.com', '0913086279', 'amharic', 'BSC of amharic', '2025-05-02 09:05:59'),
('15', 'belsete', 'simachewu', 'Male', 'be@gmail.com', '0920832989', 'chemistery', 'msc of chemistery', '2025-05-07 08:16:39'),
('21', 'almaze', 'enkue', 'Female', 'a@gmail.com', '0913086279', 'amharic', 'BSC of biology', '2025-05-02 09:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_courses`
--

CREATE TABLE `teacher_courses` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `year` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_courses`
--

INSERT INTO `teacher_courses` (`id`, `teacher_id`, `course_code`, `section`, `year`) VALUES
(2, '21', '01', 'A upto D', '2017');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(100) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `sex` enum('Male','Female','Other') DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','student','teacher','registral','department_head') DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `sex`, `username`, `password`, `role`, `status`) VALUES
('10', 'Amare', 'Abebe', 'Male', 'm', 'f899139df5e1059396431415e770c6dd', 'student', 'active'),
('17', 'Amare', 'Abebe', 'Male', 'mati', '0768281a05da9f27df178b5c39a51263', 'department_head', 'active'),
('96', 'Amare', 'kebede', 'Male', 'matib', '0768281a05da9f27df178b5c39a51263', 'student', 'active'),
('99', 'Amare', 'kebede', 'Male', 'xx', '08f90c1a417155361a5c4b8d297e0d78', 'student', 'active'),
('stud1', 'Degene', 'Tesgay', 'Male', 'dg', 'f899139df5e1059396431415e770c6dd', 'admin', 'active'),
('user2', 'Tigist', 'Demeke', 'Female', 'tg', '3644a684f98ea8fe223c713b77189a77', 'student', 'active'),
('user3', 'abebeawu', 'abebe', 'Male', 'ab', '94f6d7e04a4d452035300f18b984988c', 'teacher', 'active'),
('user4', 'abebeawu', 'abebe', 'Male', 'abe', '18d8042386b79e2c279fd162df0205c8', 'registral', 'active'),
('user5', 'Amare', 'kebede', 'Male', 'hi', '0768281a05da9f27df178b5c39a51263', 'department_head', 'active'),
('user6', 'Yabibal', 'kebede', 'Male', 'hd', 'cee631121c2ec9232f3a2f028ad5c89b', 'department_head', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_classes`
--
ALTER TABLE `assigned_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `billing_rates`
--
ALTER TABLE `billing_rates`
  ADD PRIMARY KEY (`year`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_payment`
--
ALTER TABLE `student_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_results`
--
ALTER TABLE `student_results`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`,`year`,`semester`);

--
-- Indexes for table `subject_marks`
--
ALTER TABLE `subject_marks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`,`year`,`semester`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  ADD PRIMARY KEY (`teacher_id`,`course_code`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `course_code` (`course_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_classes`
--
ALTER TABLE `assigned_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_payment`
--
ALTER TABLE `student_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student_results`
--
ALTER TABLE `student_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subject_marks`
--
ALTER TABLE `subject_marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_classes`
--
ALTER TABLE `assigned_classes`
  ADD CONSTRAINT `assigned_classes_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  ADD CONSTRAINT `teacher_courses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_courses_ibfk_2` FOREIGN KEY (`course_code`) REFERENCES `courses` (`course_code`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
