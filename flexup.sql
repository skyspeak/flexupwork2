-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2017 at 03:40 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flexup`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminuser`
--

CREATE TABLE `adminuser` (
  `admin_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminuser`
--

INSERT INTO `adminuser` (`admin_id`, `name`, `username`, `email`, `password`) VALUES
(1, 'fg', 'jbjb', 'jbj@rg.vom', '92eb5ffee6ae2fec3ad71c777531578f'),
(2, 'sdf', 'dgs', 'dfg@fg.com', '2f7e54fe9de9db73067f562bc22d6eae'),
(3, 'sdf', 'df', 'jbj@rg.vom', '3bbe57698e353a2acaa03306316658bb'),
(4, 'sdf', 'nbj', 'dfg@fg.com', 'b48917eeed6fec3c431f59975018ddf5'),
(5, 'mj', 'mj', 'oc@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `clientuser`
--

CREATE TABLE `clientuser` (
  `userClient_id` int(11) NOT NULL,
  `userClient_firstName` varchar(255) NOT NULL,
  `userClient_lastName` varchar(255) NOT NULL,
  `userClient_email` varchar(255) NOT NULL,
  `userClient_username` varchar(255) NOT NULL,
  `userClient_password` varchar(255) NOT NULL,
  `userClient_interests` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientuser`
--

INSERT INTO `clientuser` (`userClient_id`, `userClient_firstName`, `userClient_lastName`, `userClient_email`, `userClient_username`, `userClient_password`, `userClient_interests`) VALUES
(1, 'test', 'test', 'this is test', 'sd', '098f6bcd4621d373cade4e832627b4f6', 'thest'),
(2, 'M', 'J', 'mj@gmail.com', 'mithushan', '5f4dcc3b5aa765d61d8327deb882cf99', 'AI');

-- --------------------------------------------------------

--
-- Table structure for table `projectfields`
--

CREATE TABLE `projectfields` (
  `field_id` int(255) NOT NULL,
  `field_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projectfields`
--

INSERT INTO `projectfields` (`field_id`, `field_name`) VALUES
(1, 'Product Management'),
(2, 'Recruiting'),
(3, 'Design'),
(4, 'Sales'),
(5, 'Account Management');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(255) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_timeline` varchar(255) NOT NULL,
  `project_fields` varchar(255) NOT NULL,
  `project_location` varchar(255) NOT NULL,
  `project_description` mediumtext NOT NULL,
  `project_thumb` text NOT NULL,
  `created_by` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_timeline`, `project_fields`, `project_location`, `project_description`, `project_thumb`, `created_by`) VALUES
(9, 'Mithushan', '89', 'Design', 'df', '            This is a test    test                        ', 'e7687a6609956e969d7afeb54610707c.png', 5),
(10, 'Test Beta', '', 'Product Management', '', 'This is test description', '500x500.png', 5),
(11, 'Test', 'Test', 'Product Management', 'test', '', '500x500.png', 5),
(12, 'Test', 'Test', 'Product Management', 'test', '', '500x500.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `project_parts`
--

CREATE TABLE `project_parts` (
  `part_id` int(11) NOT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `part_description` longtext NOT NULL,
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_parts`
--

INSERT INTO `project_parts` (`part_id`, `part_name`, `part_description`, `project_id`) VALUES
(1, 'Mithushan', 'This is atest', 9),
(2, 'd', 'df', 9),
(3, 'Mithushan Test', 'This is sample part', 9),
(4, 'Test', 'This is a test', 10),
(5, 'New test', 'This is a test', 9);

-- --------------------------------------------------------

--
-- Table structure for table `project_readinglist`
--

CREATE TABLE `project_readinglist` (
  `readingList_id` int(11) NOT NULL,
  `readingList_link` varchar(255) DEFAULT NULL,
  `readingList_name` varchar(255) DEFAULT NULL,
  `part_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_readinglist`
--

INSERT INTO `project_readinglist` (`readingList_id`, `readingList_link`, `readingList_name`, `part_id`, `project_id`) VALUES
(1, 'https://www.google.lk/?gfe_rd=cr&ei=pi2KWfTWAu_t8Aezm4GYBQ', 'Google Home Page', 2, 9),
(2, 'Test', 'Test', 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `project_tasks`
--

CREATE TABLE `project_tasks` (
  `task_id` int(255) NOT NULL,
  `task_name` varchar(255) DEFAULT NULL,
  `task_details` mediumtext,
  `part_id` int(225) DEFAULT NULL,
  `project_id` int(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_tasks`
--

INSERT INTO `project_tasks` (`task_id`, `task_name`, `task_details`, `part_id`, `project_id`) VALUES
(1, 'Mithushan', 'Test', 2, 9),
(2, 'Tst ', 'Twillo', 1, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminuser`
--
ALTER TABLE `adminuser`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `clientuser`
--
ALTER TABLE `clientuser`
  ADD PRIMARY KEY (`userClient_id`);

--
-- Indexes for table `projectfields`
--
ALTER TABLE `projectfields`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `project_parts`
--
ALTER TABLE `project_parts`
  ADD PRIMARY KEY (`part_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `project_readinglist`
--
ALTER TABLE `project_readinglist`
  ADD PRIMARY KEY (`readingList_id`),
  ADD KEY `part_id` (`part_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `project_tasks`
--
ALTER TABLE `project_tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `part_id` (`part_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminuser`
--
ALTER TABLE `adminuser`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `clientuser`
--
ALTER TABLE `clientuser`
  MODIFY `userClient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `projectfields`
--
ALTER TABLE `projectfields`
  MODIFY `field_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `project_parts`
--
ALTER TABLE `project_parts`
  MODIFY `part_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `project_readinglist`
--
ALTER TABLE `project_readinglist`
  MODIFY `readingList_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `project_tasks`
--
ALTER TABLE `project_tasks`
  MODIFY `task_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `adminuser` (`admin_id`);

--
-- Constraints for table `project_parts`
--
ALTER TABLE `project_parts`
  ADD CONSTRAINT `project_parts_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Constraints for table `project_readinglist`
--
ALTER TABLE `project_readinglist`
  ADD CONSTRAINT `project_readinglist_ibfk_1` FOREIGN KEY (`part_id`) REFERENCES `project_parts` (`part_id`),
  ADD CONSTRAINT `project_readinglist_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Constraints for table `project_tasks`
--
ALTER TABLE `project_tasks`
  ADD CONSTRAINT `project_tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `project_tasks_ibfk_2` FOREIGN KEY (`part_id`) REFERENCES `project_parts` (`part_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
