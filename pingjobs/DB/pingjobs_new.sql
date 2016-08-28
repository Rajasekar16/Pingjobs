-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2016 at 01:30 PM
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
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) UNSIGNED NOT NULL,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(57, 1472380761, '::1', 'EbNx5T'),
(58, 1472380946, '::1', 'u273IM'),
(59, 1472381118, '::1', 'gYR6L0');

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
('01a7fac326ada1170241fcfa1c01fb2d77ec492e', '::1', '', 0, '__ci_last_regenerate|i:1472275771;', '1472275772'),
('33f4cc6c85105678c294bf0131d294472ba2877a', '::1', '', 0, '__ci_last_regenerate|i:1472330240;loggedin_admin|a:4:{s:2:"id";s:1:"1";s:8:"username";s:20:"pingjobs@asterhr.com";s:9:"user_type";s:1:"3";s:10:"loginadmin";b:1;}', '1472330983'),
('658e6e78ee324bd1fce76e592282920a15688e50', '::1', '', 0, '__ci_last_regenerate|i:1472383385;', '1472383385');

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
(2, 'Consultancy', 1),
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
(2, 'B.Tech', 1, 1),
(3, 'BSC', 1, 1),
(4, 'MSC', 1, 1),
(5, 'ME', 2, 1),
(6, 'MTech', 2, 1),
(7, 'MCA', 2, 1),
(8, 'MBA', 2, 1);

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
  `employee_name` varchar(100) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `employee_password` varchar(100) NOT NULL,
  `employee_current_salary` tinyint(4) NOT NULL,
  `employee_expected_salary` tinyint(4) NOT NULL,
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

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_name`, `employee_email`, `employee_password`, `employee_current_salary`, `employee_expected_salary`, `employee_exp_year`, `employee_exp_month`, `employee_skills`, `employee_edu_basic`, `employee_edu_master`, `employee_address`, `employee_city`, `employee_pincode`, `employee_mobile_no`, `employee_status`, `created_date`, `employee_current_company`, `employee_current_desig`, `employee_current_from_date`, `employee_current_to_date`, `traing_course`, `traing_certificates`, `employee_industry`, `employee_functional`, `employee_resume_name`, `employee_resume_url`, `employee_notice`, `preferred_location`, `linkedin_url`, `send_mail`, `last_mail_date`, `employee_job_title`) VALUES
(1, 'Balaji S', 'test@test.com', 'D9JOI84uV9sz1VZbbTCWCavIW9dLhW4juYJtDjc8mplk2dXcS1AtK13yugpXbHAIWgwx5DD8VtYCvCQepSxTyg==', 0, 0, 0, 0, 'PHP', 2, 8, '', 1, '', '9876543210', 1, '2016-08-22 18:14:51', '', NULL, '2016-08-25', '2016-08-25', '', '', 1, 1, 'BALAJI_RESUME.docx', 'resume_1472127343_BALAJI_RESUME.docx', 0, '', '', 0, NULL, '');

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
  `link` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `email`, `password`, `company_name`, `company_type`, `about_company`, `company_employes`, `industry`, `website`, `address`, `city`, `pincode`, `contact_no`, `contact_person`, `status`, `premium_employer`, `link`, `logo`, `created_date`) VALUES
(1, 'pingjobs@asterhr.com', 'D9JOI84uV9sz1VZbbTCWCavIW9dLhW4juYJtDjc8mplk2dXcS1AtK13yugpXbHAIWgwx5DD8VtYCvCQepSxTyg==', 'Asterhr', 3, 'Asterhr', 100, 1, 'www.asterhr.com', 'Velachery', 1, 600001, '9876543210', 'Raja sekar', 1, '', 'Asterhr', '', '2016-07-25 18:13:35'),
(2, 'pingjobs@cts.com', 'D9JOI84uV9sz1VZbbTCWCavIW9dLhW4juYJtDjc8mplk2dXcS1AtK13yugpXbHAIWgwx5DD8VtYCvCQepSxTyg==', 'Congizent', 1, 'CTS - Congizent', 133, 1, '', 'Chennai', 1, 600002, '7457363453', 'Bala S', 1, '1', 'Congizent', 'logo_1471774785_download.png', '2016-07-28 19:41:39'),
(3, 'pingjobs@tcs.com', 'YCvTuMTBYKO1Xtlk/40qgnb3NQwTpGaE5c/2J8wUzRl6+TVXQzDgrcmfba/obWtz+8dpXpIXFfGUFQc+5Z2l1g==', 'Tata consultancy services', 1, 'Tata consultancy Services', 100, 3, '', 'Chennai', 1, 600006, '9876543210', 'Kumaran A', 1, '1', 'Tata-consultancy-services', 'logo_1471774741_tcs.jpg', '2016-08-15 14:43:00'),
(4, 'pingjobs@infosys.com', 'jBOC6qWtojkKDXAdiMHVH/NvtE9EH3gpig9e8aXYSMfegIWU7srJXBYUpqujPV+5yx3djOMkWSYOFdA2MFXbAg==', 'Infosys', 1, 'Infosys', 100000, 3, '', 'Chennai', 1, 600014, '9876543210', 'Infosys', 1, '1', 'Infosys', 'logo_1471774690_402382-infosys-twitter.png', '2016-08-15 14:44:29'),
(5, 'pingjobs@hcl.com', 'mBcFafoQTUnZjKJp5HPQr87QnI5wCU7juboCTWngf1FfPrjARIpS0X/mDQoAo0U6CBKZcHdFgjthHYueeFovsw==', 'HCL', 1, 'HCL', 1200, 4, '', 'Chennai', 1, 600024, '8794561230', 'David', 1, '1', 'HCL', 'logo_1471774666_guideline_based_vectors-square.png', '2016-08-15 14:48:59'),
(6, 'microsoft@pingjobs.com', 'D9JOI84uV9sz1VZbbTCWCavIW9dLhW4juYJtDjc8mplk2dXcS1AtK13yugpXbHAIWgwx5DD8VtYCvCQepSxTyg==', 'Microsoft inc', 1, 'Microsoft', 1000, 1, 'www.microsoft.com', 'Microsoft', 5, 532206, '9876543210', 'Microsoft', 1, '1', 'Microsoft-inc', 'logo_1471774549_microsoft-logo.png', '2016-08-21 08:13:47'),
(7, 'tnpsc@pingjobs.com', 'Mcmqu5QIITUtK1MDDfxn6ERlgTgPrE2wuk1Fz2cljvpOQohe98laJ6qRsBvzS1fXE4CjbZKM9u/Ldl7N9sgIaw==', 'TNPSC', 1, 'TNPSC', 1000, 5, 'www.tnpsc.in', 'TNPSC', 1, 624525, '9867546345', 'TNPSC', 1, '', 'TNPSC', '', '2016-08-27 19:12:01'),
(8, 'subbiah@asterhr.com', 'UwdcdGFIKgNrw9UZPf9HPa6mZHy0wJRZX4kWEY+bzciBjLPI+Pdj067xduTu47JeUpsX8hiFEeNvbJ3ZALP9tA==', 'Aster HR Solutions Pvt Ltd', 1, 'HR Outsourcing Firm', 10, 1, 'www.asterhr.com', 'Chennai', 1, 600123, '8015932578', 'Rajasekar', 1, '', 'Aster-HR-Solutions-Pvt-Ltd', '', '2016-08-28 10:45:16');

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
(1, 'Development', 1),
(2, 'Testing', 1),
(3, 'Govt', 1);

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
(2, 'Hardware', 1),
(3, 'IT', 1),
(4, 'BPO', 1),
(5, 'Government', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `job_type_id` tinyint(4) NOT NULL DEFAULT '1',
  `ext_post_id` int(11) NOT NULL DEFAULT '0',
  `job_name` varchar(200) DEFAULT NULL,
  `job_title` varchar(256) NOT NULL,
  `job_desc` text NOT NULL,
  `skills` tinyint(4) NOT NULL,
  `job_key_skills` varchar(100) NOT NULL,
  `job_education_spe` varchar(50) NOT NULL,
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
  `update_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_date` datetime NOT NULL,
  `job_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1- created,2.approved 3.expire,4 deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `employer_id`, `job_type_id`, `ext_post_id`, `job_name`, `job_title`, `job_desc`, `skills`, `job_key_skills`, `job_education_spe`, `job_industry_id`, `job_functional_id`, `job_experience_from`, `job_experience_to`, `job_salary_from`, `job_salary_to`, `job_no_postition`, `job_gender_id`, `job_location_id`, `premium_jobs`, `update_on`, `post_date`, `job_status`) VALUES
(1, 2, 1, 0, 'Software-Trainee-Congizent-Chennai', 'Software Trainee', 'Software Trainee', 2, 'HTML, CSS,JS,MYSQL,PHP', 'CSE', 1, 1, '0', '2', '1.50', '3', 12, 3, 1, '1', '2016-08-27 14:17:19', '2016-07-29 21:07:24', 2),
(2, 3, 2, 0, 'Software-Engineer-Tata-consultancy-services-Chennai', 'Software Engineer', 'Software Engineer', 4, 'Java,Spring,Sturts', 'Computer science', 1, 1, '', '', '', '', 10, 3, 1, '1', '2016-08-27 19:58:30', '2016-08-15 14:53:59', 2),
(4, 3, 1, 0, 'Customer-support-Tata-consultancy-services-Chennai', 'Customer support', 'Test', 6, 'Good communication skills', 'CS', 4, 1, '0', '1', '50000', '100000', 10, 3, 1, '1', '2016-08-27 19:58:23', '2016-08-21 00:35:24', 2),
(6, 3, 1, 0, 'Hardware-Engineer-Tata-consultancy-services-Chennai', 'Hardware Engineer', 'Hard ware Engineer', 7, 'Hardware,Networking', 'test', 2, 1, '', '', '', '', 12, 3, 1, '1', '2016-08-27 19:59:12', '2016-08-21 06:27:18', 2),
(7, 4, 2, 0, 'Testing-Infosys-Chennai', 'Testing', 'Testing', 3, 'Testing,Automation', 'CSE, IT', 3, 1, '', '', '', '', 12, 3, 1, '1', '2016-08-27 19:21:11', '2016-08-21 06:49:10', 2),
(8, 6, 3, 0, 'Software-Trainee-Microsoft-inc-Chennai', 'Software Trainee', 'Software Trainee', 5, 'ODBC,Oracle', 'IT, CSE', 3, 1, '', '', '', '', 10, 3, 1, '1', '2016-08-27 19:21:41', '2016-08-21 10:50:30', 2),
(9, 7, 4, 0, 'TNPSC-Group-4-TNPSC-Chennai', 'TNPSC Group 4', 'TNPSC Group 4', 8, 'Computer knowledge', 'All', 5, 3, '', '', '', '', 10, 3, 1, '0', '2016-08-27 19:15:44', '2016-08-27 19:13:24', 2),
(10, 4, 2, 0, 'Management-Trainee-Infosys-Bangalore', 'Management Trainee', 'Management Trainee', 9, 'Good Communication Skills', 'ALL', 1, 1, '', '', '', '', 6, 3, 5, '0', '2016-08-27 19:23:46', '2016-08-27 19:18:07', 2);

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

--
-- Dumping data for table `job_applied`
--

INSERT INTO `job_applied` (`id`, `job_id`, `user_id`, `applied_on`, `admin_approve`) VALUES
(1, 8, 1, '2016-08-25 12:29:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_education_mapping`
--

CREATE TABLE `job_education_mapping` (
  `job_education_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `education_id` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_education_mapping`
--

INSERT INTO `job_education_mapping` (`job_education_id`, `job_id`, `education_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 2, 2, 1),
(4, 2, 7, 1),
(5, 4, 3, 1),
(6, 6, 1, 1),
(7, 6, 2, 1),
(8, 6, 3, 1),
(9, 7, 5, 1),
(10, 7, 7, 1),
(11, 8, 1, 1),
(12, 8, 2, 1),
(13, 9, 1, 1),
(14, 9, 2, 1),
(15, 10, 8, 1);

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
(2, 1, 'Madurai', 1),
(4, 2, 'Thirvanthapuram', 2),
(5, 3, 'Bangalore', 1);

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
(1, '.Net Jobs', 1),
(2, 'PHP Jobs', 1),
(3, 'Testing Jobs', 1),
(4, 'Java Jobs', 1),
(5, 'Oracle Jobs', 1),
(6, 'BPO Jobs', 1),
(7, 'Hardware and Networking Jobs', 1),
(8, 'Govt Jobs', 1),
(9, 'Management Jobs', 1);

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
(2, 1, 'Kerala', 1),
(3, 1, 'Karnataka', 1),
(4, 1, 'Andra pradesh', 1),
(5, 1, 'Mumbai', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(11) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `subscribed_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `email_id`, `subscribed_date`, `status`) VALUES
(1, 'test@test.com', '2016-08-03 19:02:10', 1),
(2, 'testing@test.com', '2016-08-03 19:08:11', 1),
(3, 'raja16hr@gmail.com', '2016-08-16 15:11:28', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`captcha_id`),
  ADD KEY `word` (`word`);

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
  ADD UNIQUE KEY `job_name_unique` (`job_name`),
  ADD KEY `job_type_id` (`job_type_id`),
  ADD KEY `job_ibfk_3` (`job_industry_id`),
  ADD KEY `job_ibfk_4` (`job_functional_id`),
  ADD KEY `job_location_id` (`job_location_id`),
  ADD KEY `employer_id` (`employer_id`),
  ADD KEY `job_key_skill` (`skills`);

--
-- Indexes for table `job_applied`
--
ALTER TABLE `job_applied`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `apply_job` (`job_id`,`user_id`);

--
-- Indexes for table `job_education_mapping`
--
ALTER TABLE `job_education_mapping`
  ADD PRIMARY KEY (`job_education_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `education_id` (`education_id`);

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
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
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
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `education_level`
--
ALTER TABLE `education_level`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `functional`
--
ALTER TABLE `functional`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `industry`
--
ALTER TABLE `industry`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `job_applied`
--
ALTER TABLE `job_applied`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `job_education_mapping`
--
ALTER TABLE `job_education_mapping`
  MODIFY `job_education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  ADD CONSTRAINT `job_ibfk_3` FOREIGN KEY (`job_industry_id`) REFERENCES `industry` (`id`),
  ADD CONSTRAINT `job_ibfk_4` FOREIGN KEY (`job_functional_id`) REFERENCES `functional` (`id`),
  ADD CONSTRAINT `job_ibfk_5` FOREIGN KEY (`job_location_id`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `job_ibfk_6` FOREIGN KEY (`employer_id`) REFERENCES `employer` (`id`),
  ADD CONSTRAINT `job_ibfk_7` FOREIGN KEY (`skills`) REFERENCES `skills` (`id`);

--
-- Constraints for table `job_education_mapping`
--
ALTER TABLE `job_education_mapping`
  ADD CONSTRAINT `education_id_fk` FOREIGN KEY (`education_id`) REFERENCES `education` (`id`),
  ADD CONSTRAINT `job_id_fk1` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`);

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
