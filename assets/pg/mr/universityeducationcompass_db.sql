-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2024 at 07:50 PM
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

--
-- Dumping data for table `career_opportunities`
--

INSERT INTO `career_opportunities` (`opportunity_id`, `department_id`, `job_title`, `job_description`, `salary_range`) VALUES
('1', '1', 'مبرمج', '<p>كخريج كلية التربية قسم علوم الحاسبات، يمكنك العمل كمطور برمجيات في قطاع التعليم. ستكون مسؤولاً عن تطوير وصيانة تطبيقات وبرمجيات التعليم الإلكتروني، ونظم إدارة التعلم الإلكتروني، والمواقع الإلكترونية التعليمية. يتطلب هذا الدور مهارات قوية في البرمجة وتطوير البرمجيات، والتفكير الإبداعي في تصميم وتطوير تجارب التعلم الرقمي. يمكن أن تكون الفرصة للعمل في القطاع الحكومي مع الجامعات والمدارس الحكومية، أو في القطاع الخاص مع الشركات التقنية ومزودي الحلول التعليمية. تتيح لك هذه الوظيفة فرصة للمساهمة في تطوير التعليم الإلكتروني وتحسين تجارب التعلم للطلاب والمعلمين، مع فرصة للنمو المهني والتطور في مجال تكنولوجيا المعلومات في قطاع التعليم.</p>', '5000'),
('67', '1', '55', '<p>كخريج كلية التربية قسم علوم الحاسبات، يمكنك العمل كمطور برمجيات في قطاع التعليم. ستكون مسؤولاً عن تطوير وصيانة تطبيقات وبرمجيات التعليم الإلكتروني، ونظم إدارة التعلم الإلكتروني، والمواقع الإلكترونية التعليمية. يتطلب هذا الدور مهارات قوية في البرمجة وتطوير البرمجيات، والتفكير الإبداعي في تصميم وتطوير تجارب التعلم الرقمي. يمكن أن تكون الفرصة للعمل في القطاع الحكومي مع الجامعات والمدارس الحكومية، أو في القطاع الخاص مع الشركات التقنية ومزودي الحلول التعليمية. تتيح لك هذه الوظيفة فرصة للمساهمة في تطوير التعليم الإلكتروني وتحسين تجارب التعلم للطلاب والمعلمين، مع فرصة للنمو المهني والتطور في مجال تكنولوجيا المعلومات في قطاع التعليم.</p>', '55');

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
('45', 'كلية التربية للعلوم الصرفة', 'عدوي اللدود هو العمل اللاحق لرائعة جين وبستر \" صاحب الظل الطويل \" وقد نشرت لاول مرة عام 1915 ، وكانت من بين الكتب العشرة الافضل مبيعاً في الولايات المتحدة لعام 1916.\r\n\r\nومثل جزئها الاول تتألف هذه الرواية من سلسلة من الرسائل لكنها تكتب هذه المرة بقلم سالي مكبرايد الصديقة الاقرب لجودي آبوت التي كما سيتضح للقارئ منذ البداية عهدت اليها بمهمة ادارة ميتم جون غرير لكي تتولى الاشراف على اصلاحه والتخلص من السياسات القديمة التي جعلت من الملجأ مكانا قاتما وكئيباً.\r\n\r\nمنذ حالة الهلع الاولى التي تنتاب سالي مكبرايد لتوليها المهمة وحتى نهاية العمل يتتبع القارئ بإلهام وشغف القوة الانثوية الناعمة وتأثيرها في اعادة صياغة الذات والعالم.', 78.9, 'kwe2', 'colleges_img/_5b899f4f-10f9-43bf-93ef-9130e817fb17.jpeg'),
('4545', 'كلية التربية للعلوم الصرفة2', '<p>عدوي اللدود هو العمل اللاحق لرائعة جين وبستر &quot; صاحب الظل الطويل &quot; وقد نشرت لاول مرة عام 1915 ، وكانت من بين الكتب العشرة الافضل مبيعاً في الولايات المتحدة لعام 1916.</p><p>ومثل جزئها الاول تتألف هذه الرواية من سلسلة من الرسائل لكنها تكتب هذه المرة بقلم سالي مكبرايد الصديقة الاقرب لجودي آبوت التي كما سيتضح للقارئ منذ البداية عهدت اليها بمهمة ادارة ميتم جون غرير لكي تتولى الاشراف على اصلاحه والتخلص من السياسات القديمة التي جعلت من الملجأ مكانا قاتما وكئيباً.</p><p>منذ حالة الهلع الاولى التي تنتاب سالي مكبرايد لتوليها المهمة وحتى نهاية العمل يتتبع القارئ بإلهام وشغف القوة الانثوية الناعمة وتأثيرها في اعادة صياغة الذات والعالم.</p>', 67, '099', 'colleges_img/_608bdd2f-bd20-4558-8304-f3becf40ba45.jpeg'),
('56789', 'كلية التربية للعلوم الصرفة الانسانية', '                                            ', 88, '099', 'colleges_img/_34ec1c70-0ad6-40c9-9dba-0d2f65bc4c48.jpeg'),
('66', 'كلية التربية للعلوم الصرفة1', '', 90, '099', 'colleges_img/_83e01622-b7f9-4273-879b-37d245cd5e59.jpeg'),
('77', '77', '', 77, '111', 'colleges_img/_91699209-b922-4883-9749-7b0568977b21.jpeg'),
('77777', 'كلية التربية للعلوم الصرفة17777', '', 88, 'kwe2', 'colleges_img/operative-system.png'),
('888888', '888888888', '', 88, '099', 'colleges_img/_71276617-3e81-41be-8e60-bf8bd644b2c3.jpeg'),
('890', '909', '', 90, '099', 'colleges_img/university.png'),
('90666', '89', '', 78, '099', 'colleges_img/_9d45f9f7-0fe5-436d-a4c8-9619f8e1526c.jpeg'),
('99', '99999', '', 99, '099', 'colleges_img/_83e01622-b7f9-4273-879b-37d245cd5e59.jpeg');

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

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `department_id`, `course_description`, `course_stage`) VALUES
('098765', 'هندسة برمجيات', '1', '<p>مادة هندسة الحاسوب هي فرع من الهندسة يركز على تطوير وتصميم أنظمة الحاسوب وتطبيقاتها. تتعامل مادة هندسة الحاسوب مع مجموعة واسعة من المواضيع التي تشمل البرمجة، وهندسة البرمجيات، والشبكات، ونظم التشغيل، وتصميم وتحليل الخوارزميات، والذكاء الاصطناعي، وتصميم الأنظمة المدمجة، والتشفير، والأمان السيبراني، والحوسبة السحابية، والواقع الافتراضي والواقع المعزز، والتطبيقات الحاسوبية في مجالات متعددة مثل الطب، والتصنيع، والترفيه، والتعليم.</p><p>من خلال دراسة هندسة الحاسوب، يتعلم الطلاب كيفية تصميم وتطوير البرمجيات والأنظمة الحاسوبية بشكل فعّال وفعّال. يتضمن ذلك فهم أساسيات البرمجة والتعامل مع لغات البرمجة المختلفة، وفهم أساسيات تصميم وتحليل الأنظمة، وتطوير مهارات في العمل مع التقنيات الحديثة والأدوات البرمجية.</p><p>تعتبر هندسة الحاسوب مجالًا ديناميكيًا ومتطورًا، حيث تتطور التقنيات باستمرار وتظهر تحديات جديدة تتطلب حلولًا مبتكرة. لذلك، فإن الطلاب الذين يدرسون هندسة الحاسوب يحتاجون إلى أن يكونوا متجددين وملمين بأحدث التقنيات والاتجاهات في المجال، بالإضافة إلى تطوير مهارات الحلول الإبداعية والتفكير النقدي.</p>', 1),
('3', 'التشفير55', '1', '<p>مادة هندسة الحاسوب هي فرع من الهندسة يركز على تطوير وتصميم أنظمة الحاسوب وتطبيقاتها. تتعامل مادة هندسة الحاسوب مع مجموعة واسعة من المواضيع التي تشمل البرمجة، وهندسة البرمجيات، والشبكات، ونظم التشغيل، وتصميم وتحليل الخوارزميات، والذكاء الاصطناعي، وتصميم الأنظمة المدمجة، والتشفير، والأمان السيبراني، والحوسبة السحابية، والواقع الافتراضي والواقع المعزز، والتطبيقات الحاسوبية في مجالات متعددة مثل الطب، والتصنيع، والترفيه، والتعليم.</p><p>من خلال دراسة هندسة الحاسوب، يتعلم الطلاب كيفية تصميم وتطوير البرمجيات والأنظمة الحاسوبية بشكل فعّال وفعّال. يتضمن ذلك فهم أساسيات البرمجة والتعامل مع لغات البرمجة المختلفة، وفهم أساسيات تصميم وتحليل الأنظمة، وتطوير مهارات في العمل مع التقنيات الحديثة والأدوات البرمجية.</p><p>تعتبر هندسة الحاسوب مجالًا ديناميكيًا ومتطورًا، حيث تتطور التقنيات باستمرار وتظهر تحديات جديدة تتطلب حلولًا مبتكرة. لذلك، فإن الطلاب الذين يدرسون هندسة الحاسوب يحتاجون إلى أن يكونوا متجددين وملمين بأحدث التقنيات والاتجاهات في المجال، بالإضافة إلى تطوير مهارات الحلول الإبداعية والتفكير النقدي.</p>', 1),
('35555555', 'التشفير5', '1', '', 3),
('3777', 'جافا', '1', '', 1),
('4444444', 'التشفير', '1', '', 3),
('555', '555', '1', '', 2),
('55563', 'التشفير55', '1', '', 4),
('666', 'التشفير', '1', '', 1),
('75555', 'هياكل متقطعة', '1', '', 1),
('77', '8', '1', '', 2),
('89', 'التشفير', '1', '', 2),
('898', 'التشفير', '1', '', 1),
('89809', 'الاحياء', '1', '', 1),
('jggg', 'تصميم منطقي', '1', '', 1);

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
  `departments_img_path` varchar(255) NOT NULL,
  `TheCounter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `college_id`, `department_description`, `scientific_department_message`, `required_GPA`, `evening_GPA`, `parallel_GPA`, `parallel_study_fees`, `evening_study_fees`, `departments_img_path`, `TheCounter`) VALUES
('1', 'الحاسبات', '45', 'عدوي اللدود هو العمل اللاحق لرائعة جين وبستر \\\" صاحب الظل الطويل \\\" وقد نشرت لاول مرة عام 1915 ، وكانت من بين الكتب العشرة الافضل مبيعاً في الولايات المتحدة لعام 1916.ومثل جزئها الاول تتألف هذه الرواية من سلسلة من الرسائل لكنها تكتب هذه المرة بقلم سالي مكبرايد الصديقة الاقرب لجودي آبوت التي كما سيتضح للقارئ منذ البداية عهدت اليها بمهمة ادارة ميتم جون غرير لكي تتولى الاشراف على اصلاحه والتخلص من السياسات القديمة التي جعلت من الملجأ مكانا قاتما وكئيباً.منذ حالة الهلع الاولى التي تنتاب سالي مكبرايد لتوليها المهمة وحتى نهاية العمل يتتبع القارئ بإلهام وشغف القوة الانثوية الناعمة وتأثيرها في اعادة صياغة الذات والعالم.', 'عدوي اللدود هو العمل اللاحق لرائعة جين وبستر \\\" صاحب الظل الطويل \\\" وقد نشرت لاول مرة عام 1915 ، وكانت من بين الكتب العشرة الافضل مبيعاً في الولايات المتحدة لعام 1916.ومثل جزئها الاول تتألف هذه الرواية من سلسلة من الرسائل لكنها تكتب هذه المرة بقلم سالي مكبرايد الصديقة الاقرب لجودي آبوت التي كما سيتضح للقارئ منذ البداية عهدت اليها بمهمة ادارة ميتم جون غرير لكي تتولى الاشراف على اصلاحه والتخلص من السياسات القديمة التي جعلت من الملجأ مكانا قاتما وكئيباً.منذ حالة الهلع الاولى التي تنتاب سالي مكبرايد لتوليها المهمة وحتى نهاية العمل يتتبع القارئ بإلهام وشغف القوة الانثوية الناعمة وتأثيرها في اعادة صياغة الذات والعالم.', 65, 88, 77.77, 11, 11, 'departments_img/٢٠٢٣٠٧٠٩_٠٩٣٢٢٩.jpg', 1),
('2222', 'الحاسبات1', '45', '', '', 89, 88, 77.77, 89, 89, 'departments_img/_34ec1c70-0ad6-40c9-9dba-0d2f65bc4c48.jpeg', 4),
('22787', 'الرياضيات', '45', '', '', 90, 88, 77.77, 90, 90, 'departments_img/_9d45f9f7-0fe5-436d-a4c8-9619f8e1526c.jpeg', 3),
('3333', 'الفيزياء', '66', '', '                        ', 88, 88, 77.77, 88, 88, 'departments_img/_71276617-3e81-41be-8e60-bf8bd644b2c3.jpeg', 2),
('45', 'الحاسبات1444', '77777', '<p>عدوي اللدود هو العمل اللاحق لرائعة جين وبستر &quot; صاحب الظل الطويل &quot; وقد نشرت لاول مرة عام 1915 ، وكانت من بين الكتب العشرة الافضل مبيعاً في الولايات المتحدة لعام 1916.</p>\r\n\r\n<p>ومثل جزئها الاول تتألف هذه الرواية من سلسلة من الرسائل لكنها تكتب هذه المرة بقلم سالي مكبرايد الصديقة الاقرب لجودي آبوت التي كما سيتضح للقارئ منذ البداية عهدت اليها بمهمة ادارة ميتم جون غرير لكي تتولى الاشراف على اصلاحه والتخلص من السياسات القديمة التي جعلت من الملجأ مكانا قاتما وكئيباً.</p>\r\n\r\n<p>منذ حالة الهلع الاولى التي تنتاب سالي مكبرايد لتوليها المهمة وحتى نهاية العمل يتتبع القارئ بإلهام وشغف القوة الانثوية الناعمة وتأثيرها في اعادة صياغة الذات والعالم.</p>\r\n', '', 99, 44, 44, 44, 44, 'departments_img/sddefault.jpg', 7),
('ff66', 'الرياضيات77', '45', '', '', 77, 77, 77, 77, 77, 'departments_img/_35d35935-0ed2-4340-b56b-69f21ccb9683.jpeg', 6),
('ooi', '99', '45', '', '', 99, 99, 99, 99, 99, 'departments_img/_e7d43632-a86f-4cbf-a948-808970139ef5.jpeg', 5);

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
(59, NULL, '1', '$2y$13$ye66mvYQr3YXsCP1rcS/YutOt1.apSIJ.lSHgpuUEs.MymiWGG5z6', 'Admin', '2024-03-11', '09:12:00', 'qqwwertyui488@gmail.com', NULL),
(70, NULL, '9', '$2y$13$TwUIu61ZHYpEfWK0NZDSvOQsoby.dgmwWm4vPiQpgzQoRituG9vFO', 'college', '2024-03-08', '08:44:00', '', '45'),
(72, '1', '22', '$2y$13$6mEBb0eB1tB8HGyP8O1Fc.8WUQf25/icnBsxealLzqGwVS7qg1NF.', 'department', '2024-03-11', '08:15:00', '', NULL),
(73, NULL, '2', '$2y$13$gXtr3lHbVxevBEJKgEXxJuVOu0I4QhcmzFSTwvSB5KXBrU/JlG1/S', 'SubAdmin', '2024-03-08', '06:03:00', 'qqwwertyui488@gmail.com', NULL);

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

--
-- Dumping data for table `student_projects`
--

INSERT INTO `student_projects` (`project_id`, `department_id`, `project_name`, `project_description`, `project_supervisor`, `student_name`, `student_projects_img_path`) VALUES
('1 ', '1', 'بوصلة التعليم الجامعي', 'retyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy                  ', 'د. حامد', 'مرتضى حيدر عبدالرضا', 'student_projects_img/sddefault.jpg'),
('156 ', '1', '555555555', '', '5555555555555', '555555555555555', 'student_projects_img/sddefault.jpg'),
('5665 ', '1', '5656', '', '5656', '56', 'student_projects_img/operative-system2.png'),
('ff ', '1', 'ff', '', 'ff', 'ff', 'student_projects_img/ن.png'),
('gggdd ', '1', 'dsf', '', 'sadf', 'sadf', 'student_projects_img/GitHub - 1.png'),
('ggggggg ', '1', 'ggg', '', 'ggggggg', 'gggggg', 'student_projects_img/Mind map -1.png'),
('p0 ', '1', 'p0pp', '', 'p0p', 'p0p', 'student_projects_img/university-education-compassFinsh.png');

-- --------------------------------------------------------

--
-- Table structure for table `top_students`
--

CREATE TABLE `top_students` (
  `student_id` varchar(12) NOT NULL,
  `department_id` varchar(12) DEFAULT NULL,
  `student_name` varchar(100) NOT NULL,
  `Graduation_Year` date NOT NULL,
  `Cumulative_Rating` double NOT NULL,
  `top_students_img_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `top_students`
--

INSERT INTO `top_students` (`student_id`, `department_id`, `student_name`, `Graduation_Year`, `Cumulative_Rating`, `top_students_img_path`) VALUES
('000 ', '1', 'مرتضى حيدر', '2024-01-28', 78.9, 'top_students_img/logo1m.jpg'),
('0007 ', '1', '7', '2024-02-25', 50, 'top_students_img/photo_2024-03-11_14-15-18.jpg'),
('666 ', '45', '666', '2024-03-02', 77, 'top_students_img/data-mining.png'),
('77 ', '1', 'حيدر عبد', '2024-03-10', 89, 'top_students_img/sddefault.jpg'),
('7777845 ', '1', 'المهندس مجتبى ابن الحي', '2023-01-11', 99, 'top_students_img/photo_2024-03-11_14-15-18.jpg'),
('7886432 ', '1', 'مرتضى244444', '2024-03-02', 89, 'top_students_img/ن.png'),
('8787878 ', '45', '87878', '2024-03-03', 77, 'top_students_img/sddefault.jpg'),
('88 ', '1', 'حيدر عبدعلي', '2024-03-24', 67, NULL),
('9900 ', '1', 'مرتضى عبدالرضا', '2024-03-02', 89, NULL);

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
('099', 'جامعة القادسية', 'الديوانية', 'بلا', 'universities_img/_9d45f9f7-0fe5-436d-a4c8-9619f8e1526c.jpeg'),
('1', 'جامعة البصرة', 'البصرة', '6666666', 'universities_img/_4235b54f-ba8f-4f16-b27c-9194166273df.jpeg'),
('111', 'جامعة ذي قار', 'الناصرية', '66', 'universities_img/Support.png'),
('1255', 'sdfs783', '66', '66', 'universities_img/_f777cba4-bb28-4f72-a255-eb219ecf6bf7.jpeg'),
('2', '23', '2', '2', 'universities_img/_71276617-3e81-41be-8e60-bf8bd644b2c3.jpeg'),
('3', 'بغداد3', 'بغداد', 'sdfg', 'universities_img/_3e943703-ec9c-449e-b492-8d6628bae29b.jpeg'),
('455g', 'sdf553', 'بغداد77', '22', 'universities_img/OIG2..jpeg'),
('67', 'جامعة الكرمة', '2', 'صقث', 'universities_img/logo23.png'),
('777777', '33', '77777', '77777777777', 'universities_img/_71276617-3e81-41be-8e60-bf8bd644b2c3.jpeg'),
('788', 'جامعة الكرمة', 'بغداد', 'صقث', 'universities_img/_826ae60c-933e-46d0-9891-ef9fd64586aa.jpeg'),
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
  ADD KEY `college_id` (`college_id`),
  ADD KEY `TheCounter` (`TheCounter`);

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
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `TheCounter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inf_login`
--
ALTER TABLE `inf_login`
  MODIFY `Admin_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

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
