-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2016 at 03:28 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pingjobs_asterhr`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `timestamp` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `user_agent`, `last_activity`, `data`, `timestamp`) VALUES
('387a4c1249c057d93a0495431f498e03bcbb7609', '::1', '', 0, '__ci_last_regenerate|i:1469969816;', '1469970508');

-- --------------------------------------------------------

--
-- Table structure for table `company_type`
--

CREATE TABLE `company_type` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_type`
--

INSERT INTO `company_type` (`id`, `name`, `status`) VALUES
(1, 'Company', 1),
(2, 'Consultant', 1),
(3, 'Admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `status`) VALUES
(1, 'India', 1),
(2, 'United State of America', 1),
(3, 'United kingdom', 1);

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `name`, `status`) VALUES
(1, 'Team Leader', 1),
(2, 'Software Engineer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `level` tinyint(4) NOT NULL COMMENT '1=>basic,2=>master',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>active,2=>inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `name`, `level`, `status`) VALUES
(1, 'B.E', 1, 1),
(2, 'M.E', 2, 1),
(3, 'Bsc - ComputerScrience', 1, 1),
(4, 'Bcom', 1, 1),
(5, 'B.Com', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `education_level`
--

CREATE TABLE `education_level` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education_level`
--

INSERT INTO `education_level` (`id`, `name`, `status`) VALUES
(1, 'Basic', 1),
(2, 'Master', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `employee_current_salary` tinyint(4) NOT NULL,
  `employee_expected_salary` tinyint(4) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `employee_password` varchar(100) NOT NULL,
  `employee_exp_year` tinyint(3) NOT NULL,
  `employee_exp_month` tinyint(3) NOT NULL,
  `employee_skills` text NOT NULL,
  `employee_edu_basic` int(11) NOT NULL,
  `employee_edu_master` int(11) NOT NULL,
  `employee_address` varchar(200) NOT NULL,
  `employee_city` tinyint(4) NOT NULL,
  `employee_pincode` varchar(20) NOT NULL,
  `employee_mobile_no` varchar(50) NOT NULL,
  `employee_status` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_current_company` varchar(60) DEFAULT NULL,
  `employee_current_desig` smallint(6) DEFAULT NULL,
  `employee_current_from_date` date DEFAULT NULL,
  `employee_current_to_date` date DEFAULT NULL,
  `traing_course` varchar(45) DEFAULT NULL,
  `traing_certificates` varchar(45) DEFAULT NULL,
  `employee_industry` tinyint(4) DEFAULT NULL,
  `employee_functional` tinyint(4) DEFAULT NULL,
  `employee_resume_name` varchar(50) NOT NULL,
  `employee_resume_url` varchar(128) NOT NULL,
  `employee_notice` int(11) NOT NULL,
  `preferred_location` varchar(50) NOT NULL,
  `linkedin_url` varchar(256) NOT NULL,
  `send_mail` tinyint(1) DEFAULT '0',
  `last_mail_date` datetime DEFAULT NULL,
  `employee_job_title` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `company_type` tinyint(4) NOT NULL,
  `about_company` text NOT NULL,
  `company_employes` mediumint(9) NOT NULL,
  `industry` tinyint(4) NOT NULL,
  `website` varchar(120) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` tinyint(4) NOT NULL,
  `pincode` int(11) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0-created,1-active,2-after sent activate link,3- delete',
  `premium_employer` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 - Premium, 0 - Non premium employer',
  `logo` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `email`, `password`, `company_name`, `company_type`, `about_company`, `company_employes`, `industry`, `website`, `address`, `city`, `pincode`, `contact_no`, `contact_person`, `status`, `premium_employer`, `logo`, `created_date`) VALUES
(1, 'pingjobs@asterhr.com', 'D9JOI84uV9sz1VZbbTCWCavIW9dLhW4juYJtDjc8mplk2dXcS1AtK13yugpXbHAIWgwx5DD8VtYCvCQepSxTyg==', 'Asterhr', 3, 'Asterhr', 100, 1, 'www.asterhr.com', 'Velachery', 1, 600001, '9876543210', 'Raja sekar', 1, '1', '', '2016-07-25 18:13:35'),
(2, 'test@test.com', 'D9JOI84uV9sz1VZbbTCWCavIW9dLhW4juYJtDjc8mplk2dXcS1AtK13yugpXbHAIWgwx5DD8VtYCvCQepSxTyg==', 'Test', 1, 'test', 133, 1, '', 'tes', 1, 523234, '7457363453', 'Test', 1, '0', '', '2016-07-28 19:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `functional`
--

CREATE TABLE `functional` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `functional`
--

INSERT INTO `functional` (`id`, `name`, `status`) VALUES
(1, 'Develpment', 1),
(2, 'Testing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `industry`
--

CREATE TABLE `industry` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industry`
--

INSERT INTO `industry` (`id`, `name`, `status`) VALUES
(1, 'Software', 1),
(2, 'Hardware', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `job_type_id` tinyint(4) NOT NULL DEFAULT '1',
  `job_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1- created,2.approved 3.expire,4 deleted',
  `job_title` varchar(256) NOT NULL,
  `job_desc` text NOT NULL,
  `job_education_id` tinyint(4) NOT NULL,
  `job_education_spe` varchar(50) NOT NULL,
  `job_key_skill` varchar(256) NOT NULL,
  `job_industry_id` tinyint(4) NOT NULL,
  `job_functional_id` tinyint(4) NOT NULL,
  `job_experience_from` varchar(10) NOT NULL,
  `job_experience_to` varchar(10) NOT NULL,
  `job_salary_from` varchar(10) NOT NULL,
  `job_salary_to` varchar(10) NOT NULL,
  `job_no_postition` int(11) NOT NULL,
  `job_gender_id` tinyint(4) NOT NULL COMMENT '1.male,2.female,3.eny',
  `job_location_id` tinyint(4) NOT NULL,
  `premium_jobs` enum('1','0') NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL,
  `update_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `employer_id` int(11) NOT NULL,
  `ext_post_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `job_type_id`, `job_status`, `job_title`, `job_desc`, `job_education_id`, `job_education_spe`, `job_key_skill`, `job_industry_id`, `job_functional_id`, `job_experience_from`, `job_experience_to`, `job_salary_from`, `job_salary_to`, `job_no_postition`, `job_gender_id`, `job_location_id`, `premium_jobs`, `post_date`, `update_on`, `employer_id`, `ext_post_id`) VALUES
(1, 1, 1, 'TEST', 'TEST', 1, 'cse', 'C', 1, 1, '', '', '', '', 12, 3, 1, '1', '2016-07-29 21:07:24', '2016-07-29 21:07:24', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_applied`
--

CREATE TABLE `job_applied` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `applied_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_approve` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_type`
--

CREATE TABLE `job_type` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_type`
--

INSERT INTO `job_type` (`id`, `name`, `status`) VALUES
(1, 'Fresher', 1),
(2, 'Experience', 1),
(3, 'Walk-ins', 1),
(4, 'Govt Jobs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` tinyint(4) NOT NULL,
  `state_id` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `state_id`, `name`, `status`) VALUES
(1, 1, 'Chennai', 1),
(2, 1, 'Madurai', 1);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `name`, `status`) VALUES
(1, 'bellow 50.000 p/a', 1),
(2, '50,000 - to - 10,0000 p/a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(35) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `status`) VALUES
(1, 'C', 1),
(2, 'C++', 1),
(3, 'HTML', 1),
(4, 'HTML5', 1),
(5, 'CSS', 1),
(6, 'CSS3', 1),
(7, 'Javascript', 1),
(8, 'Jquery', 1),
(9, 'PHP', 1),
(10, 'MySQL', 1),
(11, 'Java', 1),
(12, '.Net', 1);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` tinyint(4) NOT NULL,
  `country_id` tinyint(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `country_id`, `name`, `status`) VALUES
(1, 1, 'Tamilnadu', 1),
(2, 1, 'Kerala', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `company_type`
--
ALTER TABLE `company_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `education_level`
--
ALTER TABLE `education_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_email` (`employee_email`),
  ADD KEY `employee_status` (`employee_status`),
  ADD KEY `employee_city` (`employee_city`),
  ADD KEY `employee_functional` (`employee_functional`),
  ADD KEY `employee_industry` (`employee_industry`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `city` (`city`),
  ADD KEY `status` (`status`),
  ADD KEY `industry` (`industry`),
  ADD KEY `company_type` (`company_type`);

--
-- Indexes for table `functional`
--
ALTER TABLE `functional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `industry`
--
ALTER TABLE `industry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_type_id` (`job_type_id`),
  ADD KEY `job_ibfk_2` (`job_education_id`),
  ADD KEY `job_ibfk_3` (`job_industry_id`),
  ADD KEY `job_ibfk_4` (`job_functional_id`),
  ADD KEY `job_location_id` (`job_location_id`),
  ADD KEY `employer_id` (`employer_id`);

--
-- Indexes for table `job_applied`
--
ALTER TABLE `job_applied`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `apply_job` (`job_id`,`user_id`);

--
-- Indexes for table `job_type`
--
ALTER TABLE `job_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_type`
--
ALTER TABLE `company_type`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `education_level`
--
ALTER TABLE `education_level`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `functional`
--
ALTER TABLE `functional`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `industry`
--
ALTER TABLE `industry`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `job_applied`
--
ALTER TABLE `job_applied`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_level_fky` FOREIGN KEY (`level`) REFERENCES `education_level` (`id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`employee_city`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`employee_functional`) REFERENCES `functional` (`id`),
  ADD CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`employee_industry`) REFERENCES `industry` (`id`);

--
-- Constraints for table `employer`
--
ALTER TABLE `employer`
  ADD CONSTRAINT `employer_ibfk_1` FOREIGN KEY (`city`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `employer_ibfk_2` FOREIGN KEY (`industry`) REFERENCES `industry` (`id`),
  ADD CONSTRAINT `employer_ibfk_3` FOREIGN KEY (`company_type`) REFERENCES `company_type` (`id`);

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`job_type_id`) REFERENCES `job_type` (`id`),
  ADD CONSTRAINT `job_ibfk_2` FOREIGN KEY (`job_education_id`) REFERENCES `education` (`id`),
  ADD CONSTRAINT `job_ibfk_3` FOREIGN KEY (`job_industry_id`) REFERENCES `industry` (`id`),
  ADD CONSTRAINT `job_ibfk_4` FOREIGN KEY (`job_functional_id`) REFERENCES `functional` (`id`),
  ADD CONSTRAINT `job_ibfk_5` FOREIGN KEY (`job_location_id`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `job_ibfk_6` FOREIGN KEY (`employer_id`) REFERENCES `employer` (`id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`);

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `state_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
