-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 07, 2025 at 01:03 PM
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
-- Database: `st_alphonsus_primary_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$s9jCmHq.onozcF1ulFxqLu.UyvTGWnNmMnCBlxmi4qgtvh8OXZGlm');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `c_id` int(11) NOT NULL,
  `year_group` varchar(10) DEFAULT NULL,
  `c_name` varchar(20) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `t_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`c_id`, `year_group`, `c_name`, `capacity`, `t_id`) VALUES
(1, 'Reception', NULL, NULL, NULL),
(2, 'Year 1', 'Tigers', 30, 14),
(3, 'Year 2', 'Elephants', 30, 15),
(4, 'Year 3', 'Lions', 32, 21),
(5, 'Year 4', NULL, NULL, NULL),
(6, 'Year 5', NULL, NULL, NULL),
(7, 'Year 6', 'Eagles', 11, 15);

-- --------------------------------------------------------

--
-- Table structure for table `parent_guardian`
--

CREATE TABLE `parent_guardian` (
  `pg_id` int(11) NOT NULL,
  `pg_fname` varchar(20) DEFAULT NULL,
  `pg_lname` varchar(20) DEFAULT NULL,
  `pg_address` varchar(30) DEFAULT NULL,
  `pg_email` varchar(30) DEFAULT NULL,
  `pg_phone` varchar(15) DEFAULT NULL,
  `relationship_to_pupil` varchar(20) DEFAULT NULL,
  `pg_title` varchar(50) DEFAULT NULL,
  `pg_dob` varchar(50) DEFAULT NULL,
  `pg_gender` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent_guardian`
--

INSERT INTO `parent_guardian` (`pg_id`, `pg_fname`, `pg_lname`, `pg_address`, `pg_email`, `pg_phone`, `relationship_to_pupil`, `pg_title`, `pg_dob`, `pg_gender`) VALUES
(53, 'Emily', 'Carter', '14 Rosewood Close, Birmingham', 'olivia.davies84@mail.co.uk', '07678986234', 'Mother', 'Miss', '1988-05-17', 'Female'),
(54, 'Amelia', 'Kahn', '7 Maple Avenue, Leeds', 'amelia.kahn@mail.com', '08576234564', 'Mother', 'Mrs', '1976-09-08', 'Female'),
(55, 'Marcos', 'Alonso', '32 The Crescent, Bristol', 'Marcos.a@mail.co.uk', '07468934276', 'Guardian', 'Mr', '1968-07-19', 'Male'),
(56, 'Diogo', 'Dalot', '67 Old Trafford, Manchester', 'Diogo.Dal@mail.com', '07656732986', 'Father', 'Mr', '1999-03-12', 'Male'),
(57, 'Karim', 'Benzema', '15 Glenview Road, Manchester', 'bigbenz@mail.com', '08767864345', 'Father', 'Mr', '1985-05-15', 'Male'),
(58, 'John', 'Duran', '89 Baker Street, London', 'Johnd@mail.co.uk', '09865786345', 'Father', 'Mr', '1978-09-28', 'Male'),
(59, 'Alex', 'Carson', '45 Ladbroke Grove, London', 'alcar@mail.com', '09876564356', 'Mother', 'Ms', '2000-08-19', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `pupil`
--

CREATE TABLE `pupil` (
  `p_id` int(11) NOT NULL,
  `p_fname` varchar(20) DEFAULT NULL,
  `p_lname` varchar(20) DEFAULT NULL,
  `medical_info` varchar(100) DEFAULT NULL,
  `p_dob` date DEFAULT NULL,
  `p_gender` varchar(6) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `p_address` varchar(100) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pupil`
--

INSERT INTO `pupil` (`p_id`, `p_fname`, `p_lname`, `medical_info`, `p_dob`, `p_gender`, `admission_date`, `p_address`, `c_id`) VALUES
(42, 'Jack', 'Thompson', 'Asthma', '2019-09-02', 'Male', '2024-09-01', '14 Rosewood Close, Birmingham', 1),
(43, 'Harry', 'Wilson', 'Type 2 diabetes', '2013-02-02', 'Male', '2018-09-01', '7 Maple Avenue, Leeds', 7),
(44, 'Maria', 'Alonso', 'NA', '2018-08-09', 'Female', '2022-09-01', '32 The Crescent, Bristol', 3),
(45, 'Christina', 'Dalot', 'NA', '2015-04-23', 'Female', '2019-09-01', '67 Old Trafford, Manchester', 6),
(46, 'James', 'Benzema', 'NA', '2016-01-20', 'Male', '2020-09-01', '15 Glenview Road, Manchester', 5),
(47, 'Ben', 'Duran', 'NA', '2016-10-17', 'Male', '2019-09-01', '89 Baker Street, London', 6),
(48, 'Harry', 'Carson', 'NA', '2019-08-31', 'Male', '2023-09-01', '45 Ladbroke Grove, London', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pupil_parent`
--

CREATE TABLE `pupil_parent` (
  `pg_id` int(11) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pupil_parent`
--

INSERT INTO `pupil_parent` (`pg_id`, `p_id`) VALUES
(53, 42),
(54, 43),
(55, 44),
(56, 45),
(57, 46),
(58, 47),
(59, 48);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `t_id` int(11) NOT NULL,
  `t_fname` varchar(20) DEFAULT NULL,
  `t_lname` varchar(20) DEFAULT NULL,
  `t_address` varchar(30) DEFAULT NULL,
  `t_phone` varchar(15) DEFAULT NULL,
  `salary` decimal(7,2) DEFAULT NULL,
  `background_check` varchar(100) DEFAULT NULL,
  `t_dob` date DEFAULT NULL,
  `t_gender` varchar(6) DEFAULT NULL,
  `t_email` varchar(50) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `t_title` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`t_id`, `t_fname`, `t_lname`, `t_address`, `t_phone`, `salary`, `background_check`, `t_dob`, `t_gender`, `t_email`, `hire_date`, `subject`, `t_title`) VALUES
(14, 'Lily', 'Edmondson', '30 School Lane', '78908765456', 32000.00, '1', '1993-02-27', 'Female', 'le@mail.com', '2022-07-07', 'Mathematics', 'Miss'),
(15, 'Ilhan', 'Shah', '30 Old Trafford', '08798765678', NULL, NULL, '2005-05-06', 'Male', 'ilhanshah@mail.com', NULL, 'Physical Education', 'Mr'),
(18, 'Bob', 'Filch', '30 Fletcher Avenue', '08976345543', NULL, NULL, '1978-02-01', 'Male', 'filch.bob@yahoo.com', NULL, 'Computer Science', 'Mr'),
(19, 'Darlene', 'Bing', '23 Mallard Lane', '34523312213', 30000.00, '1', '2001-12-23', 'Female', 'DarleneBing123@hotmail.co.uk', '2025-03-31', 'Music', 'Miss'),
(20, 'Sue', 'Ling', '20 Red Drive', '78906767543', 30000.00, '1', '1989-01-21', 'Female', 'Ling.S@yahoo.com', '2024-10-23', 'Geography', 'Mrs'),
(21, 'Trish', 'Valleto', '67 Munch road', '12345543123', NULL, NULL, '1984-12-12', 'Female', 'Valleto.Trish@gmail.com', NULL, 'Foreign Languages', 'Ms'),
(22, 'Henry', 'Hoobart', '1 Hoob Drive', '9098978646', NULL, NULL, '1993-02-28', 'Male', 'HoobyHenry@hoobville.com', NULL, 'Physical Education', 'Mr'),
(23, 'Pedro', 'Stall', '34 Bunch Street', '234322345609', NULL, NULL, '1967-03-12', 'Male', 'pedro.S@yahoo.co.uk', NULL, 'Religious Education', 'Mr');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `fk_t_id` (`t_id`);

--
-- Indexes for table `parent_guardian`
--
ALTER TABLE `parent_guardian`
  ADD PRIMARY KEY (`pg_id`);

--
-- Indexes for table `pupil`
--
ALTER TABLE `pupil`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `fk_c_id` (`c_id`);

--
-- Indexes for table `pupil_parent`
--
ALTER TABLE `pupil_parent`
  ADD KEY `fk_pg_id` (`pg_id`),
  ADD KEY `fk_p_id` (`p_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `parent_guardian`
--
ALTER TABLE `parent_guardian`
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `pupil`
--
ALTER TABLE `pupil`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `fk_t_id` FOREIGN KEY (`t_id`) REFERENCES `teacher` (`t_id`);

--
-- Constraints for table `pupil`
--
ALTER TABLE `pupil`
  ADD CONSTRAINT `fk_c_id` FOREIGN KEY (`c_id`) REFERENCES `classes` (`c_id`);

--
-- Constraints for table `pupil_parent`
--
ALTER TABLE `pupil_parent`
  ADD CONSTRAINT `fk_p_id` FOREIGN KEY (`p_id`) REFERENCES `pupil` (`p_id`),
  ADD CONSTRAINT `fk_pg_id` FOREIGN KEY (`pg_id`) REFERENCES `parent_guardian` (`pg_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
