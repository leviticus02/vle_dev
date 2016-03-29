-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2016 at 08:14 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `institution_code` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `course` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `length` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `institution_code`, `course_id`, `course`, `type`, `length`) VALUES
(1, 'UoC', 'CCSBSc', 'Computer Science ', '(BSc)', 3),
(2, 'SHU', 'CSBSc', 'Computer Science ', '(BSc)', 3),
(3, 'UoC', 'PSBSc', 'Psychology ', '(BSc)', 3),
(4, 'UoC', 'ABBSc', 'Animal Behaviour ', '(BSc)', 3),
(5, 'UoC', 'ENGBsc', 'Engineering ', '(BSc)', 3),
(6, 'UoC', 'PBsc', 'Politics ', '(BSc)', 3),
(7, 'UoC', 'ELBSc', 'English literature', '(BSc)', 3),
(9, 'UoC', 'ictgcse', 'ICT', 'GCSE', 2),
(10, 'UoC', 'MK1BSc', 'Marketing', 'BSc', 3);

-- --------------------------------------------------------

--
-- Table structure for table `course_staff`
--

CREATE TABLE `course_staff` (
  `id` int(11) NOT NULL,
  `institution_code` varchar(20) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `course_level` varchar(20) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_staff`
--

INSERT INTO `course_staff` (`id`, `institution_code`, `staff_id`, `course_level`, `course_code`, `role`) VALUES
(1, 'UoC', 110, 'course', 'CCSBSc', 'leader'),
(2, 'UoC', 110, 'course', 'CCSBSc', 'admin'),
(3, 'UoC', 110, 'course', 'ELBSc', 'leader'),
(5, 'UoC', 110, 'course', 'PSBSc', 'leader'),
(6, 'UoC', 0, 'course', 'CCSBSc', '');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard User', ''),
(2, 'Administrator', '{\n"mod": 1\n}'),
(3, 'Institute Admin', '{\n"admin": 1\n}');

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `code` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`id`, `name`, `code`) VALUES
(76, 'Sheffield University', 'SHU'),
(79, 'University of Cambridge', 'UoC');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `institution_code` varchar(20) NOT NULL,
  `parent_course_code` varchar(20) NOT NULL,
  `module_code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `module_year` int(11) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `institution_code`, `parent_course_code`, `module_code`, `name`, `description`, `module_year`, `start_date`, `end_date`) VALUES
(1, 'UoC', 'CCSBSc', 'mod098908', 'Introduction to programming', 'Programming shit', 1, NULL, NULL),
(2, 'UoC', 'CCSBSc', 'mod8787', 'c++', 'c++', 2, NULL, NULL),
(3, 'UoC', 'CCSBSc', 'MOD09797987', 'Database design and implementation', 'Databases', 1, NULL, NULL),
(4, 'UoC', 'CCSBSc', 'MOD987987', 'Distributed systems programming', 'DSP', 3, NULL, NULL),
(5, 'UoC', 'CCSBSc', 'MODwq9e87', 'All years', 'all years', 5, NULL, NULL),
(7, 'UoC', 'PSBSc', 'MOD888', 'Neuro Psychology', 'Brain stuff', 1, NULL, NULL),
(8, 'UoC', 'CCSBSc', 'MOD987867', 'User Experience', 'UX', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `institution_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `user_id`, `institution_id`) VALUES
(1, 110, 'UoC');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `institution_id` varchar(20) NOT NULL,
  `course` text NOT NULL,
  `course_type` varchar(20) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `user_id`, `institution_id`, `course`, `course_type`, `year`) VALUES
(2, 100, 'UoC', 'CCSBSc', 'BSc', 1),
(3, 106, 'UoC', 'ELBSc', 'BSc', 2),
(4, 107, 'UoC', 'PSBSc', 'BSc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(60) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `institution_code` varchar(80) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `first_name`, `last_name`, `email`, `institution_code`, `password`, `salt`, `joined`, `group`) VALUES
(99, 'SHU', 'Sheffield University', '', '', 'shu@test.com', 'SHU', 'c23eaab91557c3de4ed878afc96df86d800988969fc88ae76cf4ad9f2d23c0a3', 'à~×&9¦Œ=…ü…Dµk&‰~	`ïæ8¶®O·š¡''', '2016-02-10 23:19:20', 3),
(100, 'LG553', '', 'Levi', 'Godolphin', '', 'UoC', '5bd0d3a0c1377db5073b1b4715c0578bf9295a8a3fbd94c8faad39574c5cdcd1', 'X2UæC•ø†d…xªµÌ‘(¹ÅÕ7Ä-Z×Á!g_', '2016-02-10 23:20:52', 1),
(103, 'UoC', 'University of Cambridge', '', '', 'levi.god@hotmail.co.uk', 'UoC', '252b9a1b73c9c73b45fc96aa4f33e80c3c5503f6e8bd57e82baba46c015eae1f', 'RëAË~’]\0t±r<<W•´»’@@?Sn–g~Áq.', '2016-02-11 19:07:03', 3),
(106, 'PR1', '', 'Peter', 'Roberts', '', 'UoC', '7dc2199c7c2671bc973ca320ae3918fd1559e26e1185e40ed1e2231aa9d302f1', 'Ð`¿	é,NáÆ·x¯Á³2‰³ŠW)ù@b’_F>TX)', '2016-02-13 10:10:56', 1),
(107, 'MN1', '', 'Melanie', 'Nielsen', '', 'UoC', '2173ed984203c0108db58e033ead1af108d5a472ccd91de4ffcb01a3daa94ebd', '|ó’«P‘°sÝ·Tùß<Û³Ô²£‡¿¨Vìr\Z8', '2016-02-13 21:16:21', 1),
(110, 'mh1', '', 'Mike', 'Hobbs', '', 'UoC', '230bc0379164378451db1171779ed07ec4344796f4b503c9e721c51247ea5c45', 'O,''SØ”X¸\\\n•)e¬ÄUH]²Å©–µ²C¸', '2016-02-13 21:40:31', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_staff`
--
ALTER TABLE `course_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `course_staff`
--
ALTER TABLE `course_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
