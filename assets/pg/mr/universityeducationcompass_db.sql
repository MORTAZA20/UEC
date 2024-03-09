-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 09:40 PM
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
  `required_GPA` double DEFAULT NULL,
  `university_id` varchar(12) DEFAULT NULL,
  `colleges_img_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`college_id`, `college_name`, `college_description`, `required_GPA`, `university_id`, `colleges_img_path`) VALUES
('00', '00', '<p>dfgdfg dfg sfdg sdfg sdg</p>\\r\\n', 90, '099', 'colleges_img/_f777cba4-bb28-4f72-a255-eb219ecf6bf7.jpeg'),
('45', 'كلية التربية للعلوم الصرفة2', '                        <p>fghfghfgh</p>\\\\r\\\\n\\\\r\\\\n<p>\\\\\\\\r\\\\\\\\n</p>\\\\r\\\\n                    ', 78.9, 'kwe2', 'colleges_img/_5b899f4f-10f9-43bf-93ef-9130e817fb17.jpeg'),
('56789', 'dgd', '', 88, '099', 'colleges_img/_34ec1c70-0ad6-40c9-9dba-0d2f65bc4c48.jpeg'),
('66', 'كلية التربية للعلوم الصرفة1', '', 90, '099', 'colleges_img/_83e01622-b7f9-4273-879b-37d245cd5e59.jpeg'),
('77', '77', '', 77, '111', 'colleges_img/_91699209-b922-4883-9749-7b0568977b21.jpeg'),
('890', '909', '', 90, '099', 'colleges_img/university.png');

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
  `required_GPA` double DEFAULT NULL,
  `evening_GPA` double DEFAULT NULL,
  `parallel_GPA` double DEFAULT NULL,
  `parallel_study_fees` int(11) NOT NULL,
  `evening_study_fees` int(11) NOT NULL,
  `departments_img_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `college_id`, `department_description`, `scientific_department_message`, `required_GPA`, `evening_GPA`, `parallel_GPA`, `parallel_study_fees`, `evening_study_fees`, `departments_img_path`) VALUES
('1', 'الحاسبات1', '45', '<p>السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;السلام عليكم&nbsp;</p>\\r\\n\\r\\n<p>FT</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<div id=\\\"\\\\&quot;gtx-trans\\\\&quot;\\\" style=\\\"\\\\&quot;left:898px\\\">\\\\r\\\\n\\r\\n<div class=\\\"\\\\&quot;gtx-trans-icon\\\\&quot;\\\">&nbsp;</div>\\r\\n\\\\r\\\\n</div>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '                                                                                                ', 65, 88, 77.77, 11, 11, 'departments_img/_83e01622-b7f9-4273-879b-37d245cd5e59.jpeg'),
('3333', 'الحاسبات7', '66', '', '', 88, 88, 77.77, 88, 88, 'departments_img/_71276617-3e81-41be-8e60-bf8bd644b2c3.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `inf_login`
--

CREATE TABLE `inf_login` (
  `Admin_id` int(200) NOT NULL,
  `department_id` varchar(100) DEFAULT NULL,
  `AdminUserName` varchar(100) DEFAULT NULL,
  `AdminPassword` varchar(500) DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `RegistrationData` date DEFAULT NULL,
  `RegistrationTime` time DEFAULT NULL,
  `Gmail` varchar(70) NOT NULL,
  `college_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inf_login`
--

INSERT INTO `inf_login` (`Admin_id`, `department_id`, `AdminUserName`, `AdminPassword`, `type`, `RegistrationData`, `RegistrationTime`, `Gmail`, `college_id`) VALUES
(59, NULL, '1', '$2y$13$ye66mvYQr3YXsCP1rcS/YutOt1.apSIJ.lSHgpuUEs.MymiWGG5z6', 'Admin', '2024-03-03', '08:46:00', 'qqwwertyui488@gmail.com', NULL),
(70, NULL, '9', '$2y$13$TwUIu61ZHYpEfWK0NZDSvOQsoby.dgmwWm4vPiQpgzQoRituG9vFO', 'college', '2024-02-20', '11:28:00', '', '45'),
(72, '1', '22', '$2y$13$6mEBb0eB1tB8HGyP8O1Fc.8WUQf25/icnBsxealLzqGwVS7qg1NF.', 'department', '2024-02-27', '07:35:00', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `Off_And_On` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`Off_And_On`, `id`) VALUES
(1, 1);

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
  `Cumulative_Rating` double NOT NULL
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
('099', 'جامعة القادسية3', 'الديوانية', 'بلا', 'universities_img/_9d45f9f7-0fe5-436d-a4c8-9619f8e1526c.jpeg'),
('1', '13', '1', '1', 'universities_img/_4235b54f-ba8f-4f16-b27c-9194166273df.jpeg'),
('111', 'جامعة ذي قار3', 'الناصرية', '66', 'universities_img/Support.png'),
('1255', 'sdfs783', '66', '66', 'universities_img/_f777cba4-bb28-4f72-a255-eb219ecf6bf7.jpeg'),
('2', '23', '2', '2', 'universities_img/_71276617-3e81-41be-8e60-bf8bd644b2c3.jpeg'),
('3', 'بغداد3', 'بغداد', 'sdfg', 'universities_img/_3e943703-ec9c-449e-b492-8d6628bae29b.jpeg'),
('455g', 'sdf553', 'بغداد77', '22', 'universities_img/OIG2..jpeg'),
('67', 'جامعة الكرمة3', '2', 'صقث', 'universities_img/logo23.png'),
('777777', '33', '77777', '77777777777', 'universities_img/_71276617-3e81-41be-8e60-bf8bd644b2c3.jpeg'),
('788', 'جامعة الكرمة', 'بغداد', 'صقث', 'universities_img/_826ae60c-933e-46d0-9891-ef9fd64586aa.jpeg'),
('88', 'حلة3', 'حححححححح', 'حححححح', 'universities_img/LOGO233.png'),
('kwe2', 'جامعة الكرمة3', '2', 'بلا', 'universities_img/LOGO4.jpg');

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
  ADD KEY `department_id` (`department_id`),
  ADD KEY `inf_login_ibfk_2` (`college_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `Admin_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `inf_login_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`),
  ADD CONSTRAINT `inf_login_ibfk_2` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`college_id`);

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
