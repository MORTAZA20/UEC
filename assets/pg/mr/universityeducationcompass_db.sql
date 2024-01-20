-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2024 at 07:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `universityeducationcompass_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `career_opportunities`
--

CREATE TABLE `career_opportunities` (
  `opportunity_id` varchar(12) NOT NULL,
  `department_id` varchar(12) DEFAULT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_description` text DEFAULT NULL,
  `salary_range` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `college_id` varchar(12) NOT NULL,
  `college_name` varchar(100) NOT NULL,
  `college_description` text DEFAULT NULL,
  `required_GPA` int(11) DEFAULT NULL,
  `university_id` varchar(12) DEFAULT NULL,
  `colleges_img_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`college_id`, `college_name`, `college_description`, `required_GPA`, `university_id`, `colleges_img_path`) VALUES
('332', '323', '', 323, '1', 'colleges_img/computer.png'),
('44568888', '888', '', 88, '1', 'colleges_img/computer.png'),
('5656', '65656', '', 56656, '1', 'colleges_img/data-mining.png'),
('787', '78788', '<p>بلتايبايائيبلئيبسلئيسباليقابيبلايبليبايابيبايباليبا</p>\\r\\n', 7878, '1', 'colleges_img/caesar-cipher.png'),
('9865499', 'كلية التربية للعلوم الصرفة', '', 3, '1', 'colleges_img/اسئلة شبكات2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` varchar(12) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `department_id` varchar(12) DEFAULT NULL,
  `course_description` text DEFAULT NULL,
  `course_stage` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` varchar(12) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `college_id` varchar(12) DEFAULT NULL,
  `department_description` text DEFAULT NULL,
  `scientific_department_message` text DEFAULT NULL,
  `required_GPA` int(11) DEFAULT NULL,
  `evening_GPA` int(11) DEFAULT NULL,
  `parallel_GPA` int(11) DEFAULT NULL,
  `parallel_study_fees` int(11) NOT NULL,
  `evening_study_fees` int(11) NOT NULL,
  `departments_img_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `college_id`, `department_description`, `scientific_department_message`, `required_GPA`, `evening_GPA`, `parallel_GPA`, `parallel_study_fees`, `evening_study_fees`, `departments_img_path`) VALUES
('2278', 'الحاسبات', '9865499', '', '', 4, 44, 4, 4, 4, 'departments_img/LOGO1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `inf_login`
--

CREATE TABLE `inf_login` (
  `Admin_id` int(200) NOT NULL,
  `department_id` varchar(100) DEFAULT NULL,
  `AdminUserName` varchar(100) DEFAULT NULL,
  `AdminPassword` varchar(1000) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `RegistrationData` date DEFAULT NULL,
  `RegistrationTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inf_login`
--

INSERT INTO `inf_login` (`Admin_id`, `department_id`, `AdminUserName`, `AdminPassword`, `type`, `RegistrationData`, `RegistrationTime`) VALUES
(43, NULL, '1', '$2y$13$h2cewiz9DbXGKAcUpd1t5OaNyN.jTDnyr.x7p/bfT/ymYF1HdyTK.', 'Admin', '2024-01-20', '09:23:00'),
(51, '2278', '2', '$2y$13$Q7MXgJXrN4IGmnx7VDAOXuR3mr1ZMqiK.6dZJpHztV8W4pYQQA2rm', 'department', '2024-01-20', '09:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_projects`
--

CREATE TABLE `student_projects` (
  `project_id` varchar(12) NOT NULL,
  `department_id` varchar(12) DEFAULT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_description` text DEFAULT NULL,
  `project_supervisor` varchar(100) DEFAULT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_projects_img_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `top_students`
--

CREATE TABLE `top_students` (
  `student_id` varchar(12) NOT NULL,
  `department_id` varchar(12) DEFAULT NULL,
  `student_name` varchar(100) NOT NULL,
  `Graduation_Year` date NOT NULL,
  `Cumulative_Rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `university_id` varchar(12) NOT NULL,
  `university_name` varchar(100) NOT NULL,
  `university_location` varchar(100) DEFAULT NULL,
  `university_website` varchar(255) DEFAULT NULL,
  `universities_img_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`university_id`, `university_name`, `university_location`, `university_website`, `universities_img_path`) VALUES
('1', 'ك1', 'البصرة', 'صقث1', 'universities_img/LOGO1.jpg'),
('kwe28', 'حيدر', 'بل', 'بلا', 'universities_img/photo_2023-11-11_13-16-29.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `career_opportunities`
--
ALTER TABLE `career_opportunities`
  ADD PRIMARY KEY (`opportunity_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`college_id`),
  ADD KEY `university_id` (`university_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `inf_login`
--
ALTER TABLE `inf_login`
  ADD PRIMARY KEY (`Admin_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `student_projects`
--
ALTER TABLE `student_projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `top_students`
--
ALTER TABLE `top_students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`university_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inf_login`
--
ALTER TABLE `inf_login`
  MODIFY `Admin_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `career_opportunities`
--
ALTER TABLE `career_opportunities`
  ADD CONSTRAINT `career_opportunities_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `colleges`
--
ALTER TABLE `colleges`
  ADD CONSTRAINT `colleges_ibfk_1` FOREIGN KEY (`university_id`) REFERENCES `universities` (`university_id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`college_id`);

--
-- Constraints for table `inf_login`
--
ALTER TABLE `inf_login`
  ADD CONSTRAINT `inf_login_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `student_projects`
--
ALTER TABLE `student_projects`
  ADD CONSTRAINT `student_projects_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `top_students`
--
ALTER TABLE `top_students`
  ADD CONSTRAINT `top_students_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
