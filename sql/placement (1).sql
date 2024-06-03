-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2024 at 05:27 PM
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
-- Database: `placement`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(255) NOT NULL,
  `uname` varchar(10) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `uname`, `pwd`, `fname`, `lname`, `email`, `phone`) VALUES
(1, 'admin1', '123', 'Girish', 'GV', 'girishgv21@gmail.com', '9742492316'),
(2, 'vp', '12345', 'Varun', 'VP', 'vp@gmail.com', '890863432'),
(5, 'admin2', '12345', 'Sharath', 'GV', 'gvs@gmail.com', '9876765678');

-- --------------------------------------------------------

--
-- Table structure for table `applied`
--

CREATE TABLE `applied` (
  `id` int(100) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'Unknown',
  `chances` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `applied`
--

INSERT INTO `applied` (`id`, `name`, `company`, `status`, `chances`) VALUES
(1, 'Mohith', 'Infosys', 'Attended', NULL),
(2, 'Mohith', 'TCS', 'Selected\r\n', NULL),
(3, 'Girish', 'Mobinius', 'Attended', NULL),
(4, 'Girish', 'Infosys', 'Selected', NULL),
(5, 'Naveen', 'Invensis Technologies Private Limited', 'Attended', NULL),
(6, 'Vinay ', 'Transact Bpo Services', 'Selected', NULL),
(7, 'Vinay ', 'Qbix Intergrated Services', 'Attended', NULL),
(9, 'Bharath', 'Invensis Technologies Private Limited', 'Attended', NULL),
(12, 'Girish', 'Mobinius', 'Selected', NULL),
(13, 'Girish', 'Cognizant Technology Solutions', 'Attended', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(100) NOT NULL,
  `name` varchar(130) NOT NULL,
  `type` varchar(30) NOT NULL,
  `address` varchar(200) NOT NULL,
  `number` varchar(11) NOT NULL,
  `website` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `minperc` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `type`, `address`, `number`, `website`, `status`, `minperc`) VALUES
(1, 'Infosys', 'IT', ' 27th Main, Old Madiwala, Jay Bheema Nagar, 1st Stage, BTM Layout 1, Bengaluru, Karnataka 560068', '9897876564', 'https://www.infosys.com/', 'Active', '70'),
(2, 'TCS', 'IT', 'Mumbai, Maharashtra', '8967879890', 'https://www.tcs.com/', 'Inactive', '70'),
(3, 'Connexions BPO Services Pvt Ltd', 'BPO', 'No.130, Chithaara House, 4th Floor, 5th Main Rd, 3rd Phase, J. P. Nagar, Bengaluru, Karnataka 560078', '8965456789', 'https://connexionsbpo.com', 'Active', '70'),
(4, 'Invensis Technologies Private Limited', 'BPO', '34/1, Upkar Chambers, Rashtriya Vidyalaya Road, 2nd Block, Basavanagudi, Bengaluru, Karnataka 560004', '8026572306', 'https://www.invensis.net', 'Active', '50'),
(5, 'Mobinius', 'IT', 'No. 311/ 19, 2nd Floor, 1st Main Rd, 8th Block, Jayanagar, Bengaluru, Karnataka 560082', '8050892700', 'https://www.mobinius.com', 'Active', '70'),
(6, 'Wipro', 'IT', ' Block C, Sarjapur Main Rd, Doddakannelli, Bengaluru, Karnataka 560035', '9078767654', 'https://www.wipro.com/', 'Active', '80%'),
(7, 'Techiesys Web design', 'IT', ' #65/2, Shree Ganesh towers 3rd floor Shop no 1,2, Near Unilet opp sumangali Silks, B Narayanaswamappa Rd, Yeswanthpur, Bengaluru, Karnataka 560022', '99003 44725', 'https://www.techiesys.in/', 'Active', '60%'),
(8, 'Cognizant Technology Solutions', 'IT', 'BLOCK D1, Manayata Tech Park, Thanisandra, Bengaluru, Karnataka 560045', '-', 'https://www.cognizant.com', 'Active', '70'),
(9, 'Transact Bpo Services', 'BPO', 'No 44/1, Tumkur Road, Yeshwanthpur, Bangalore - 560022, Opposite to Vaishnavi Sapphire Mall', '9152875945', 'https://www.transactglobal.com/', 'Active', ''),
(10, 'Qbix Intergrated Services', 'BPO', 'Anantheshwara Complex .3rd Floor, Jayamahal, Bangalore - 560046, Above Honda Activa Service Station,Next to SBI Bank', '9152333908', 'https://qbix.com', 'Active', '50'),
(11, 'ASD India Services', 'BPO', 'Unit No 2201A, 22nd Floor, WTC Bangalore, Brigade Gateway, Rajajinagar Extension,Malleswaram, Bengaluru, Karnataka 560055', '99722 21716', 'http://www.asdindiaservices.com', 'Active', '50'),
(12, 'Swan InfoSystems', 'BPO', 'No: 35 2nd & 3rd Floor Annapoorneshwari Towers,, Uttarahalli Main Road, Gowdana Palya, RR Layout, Padmanabhanagar, Bengaluru, Karnataka 560061', '98862 08887', 'https://swaninfosystems.in', 'Active', '60'),
(13, 'ABC', 'IT', '#5et5hv', '8965456789', 'https://ab.com', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `feed`
--

CREATE TABLE `feed` (
  `id` int(255) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `feed`
--

INSERT INTO `feed` (`id`, `user`, `message`, `date`, `time`) VALUES
(2, 'admin1', 'Hello everybody this is the demo text on your feed youll receive further updates in the same way!!', '2019-05-05', '19:14:39'),
(4, 'vp', 'Infosys company has been added interested students can apply !!\r\n-Admin', '2019-05-05', '20:04:42'),
(7, 'admin1', 'More IT and BPO companies added! -Admin', '2019-05-07', '12:31:27'),
(5, 'admin1', 'Do not post unnecessary comments!!', '2019-05-05', '22:48:06'),
(6, 'admin1', '4 more companies added checkout!!!\r\n-Admin', '2019-05-05', '22:50:41'),
(8, 'admin1', 'Infosys interview is being held tomorrow at 10:00 AM in college campus', '2019-05-08', '11:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `join_course`
--

CREATE TABLE `join_course` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `enrollment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `student_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `join_course`
--

INSERT INTO `join_course` (`id`, `course_name`, `enrollment_date`, `student_name`) VALUES
(6, 'Web Development', '2024-03-23 15:43:24', 'Girish'),
(7, 'Digital Marketing', '2024-03-23 15:43:28', 'Girish'),
(8, 'Graphic Design', '2024-03-23 15:45:30', 'Girish'),
(9, 'Graphic Design', '2024-03-23 15:53:54', 'Girish'),
(10, 'Graphic Design', '2024-03-23 15:55:20', 'Girish'),
(11, 'Graphic Design', '2024-03-23 15:55:46', 'Girish'),
(12, 'Web Development', '2024-03-23 16:04:11', 'Girish'),
(13, 'Web Development', '2024-03-23 16:05:12', 'Girish'),
(14, 'Digital Marketing', '2024-03-23 16:17:35', 'Girish'),
(15, 'Digital Marketing', '2024-03-23 16:18:01', ''),
(16, 'Digital Marketing', '2024-03-23 16:19:14', 'Girish'),
(17, 'Digital Marketing', '2024-03-23 16:21:45', 'Girish'),
(18, 'Digital Marketing', '2024-03-23 16:21:51', 'Girish'),
(19, 'Digital Marketing', '2024-03-23 16:24:30', 'Girish'),
(20, 'Data Science', '2024-03-23 16:24:56', 'Girish'),
(21, 'Data Science', '2024-03-23 16:25:39', 'Girish'),
(22, 'Graphic Design', '2024-03-23 16:25:43', 'Girish');

-- --------------------------------------------------------

--
-- Table structure for table `studentlogin`
--

CREATE TABLE `studentlogin` (
  `id` int(255) NOT NULL,
  `uname` varchar(10) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `secque` varchar(100) NOT NULL,
  `secans` varchar(100) NOT NULL,
  `course` varchar(100) DEFAULT NULL,
  `percentage` varchar(10) DEFAULT NULL,
  `yop` varchar(10) DEFAULT NULL,
  `sslc` varchar(100) DEFAULT NULL,
  `puc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentlogin`
--

INSERT INTO `studentlogin` (`id`, `uname`, `pwd`, `fname`, `lname`, `email`, `phone`, `secque`, `secans`, `course`, `percentage`, `yop`, `sslc`, `puc`) VALUES
(1, 'naveen', '12345', 'Naveen', 'RS', 'naveenrs@gmail.com', '9868909876', 'Which is Favourite Food?', 'Gobi Manchurian', 'BCOM', '70', '2019', NULL, NULL),
(2, 'girishgv21', '12345', 'Girish', 'G V', 'girishgv21@gmail.com', '9742492316', 'Which is your Favourite Mobile Company?', 'Motorola', 'BCA', '78', '2019', '92', '72'),
(7, 'mohith', '12345', 'Mohith', 'SB', 'mohith@gmail.com', '9876789865', 'Which is your First Phone?', 'Samsung', 'BCA', '82', '2019', NULL, NULL),
(9, 'vinay', '12345', 'Vinay ', 'Kumar', 'vinay@gmail.com', '9089876789', 'Which is your First Phone?', 'Nokia', 'BBA', '76', '2019', '81', '73'),
(10, 'bharath', '12345', 'Bharath', 'N', 'bharath@gmail.com', '9632629993', 'Which is your Favourite Mobile Company?', 'OnePlus', 'BCOM', '82', '2019', '59', '82');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `course` varchar(255) NOT NULL,
  `lecturer` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`id`, `course`, `lecturer`, `description`, `start_date`, `end_date`, `duration`) VALUES
(1, 'Web Development', 'John Doe', 'Learn HTML, CSS, and JavaScript.', '2024-04-01', '2024-05-01', 30),
(2, 'Data Science', 'Jane Smith', 'Introduction to data analysis and machine learning.', '2024-04-15', '2024-06-15', 60),
(3, 'Digital Marketing', 'Alex Johnson', 'Social media marketing and SEO strategies.', '2024-05-01', '2024-06-30', 60),
(4, 'Graphic Design', 'Emily Brown', 'Introduction to Adobe Photoshop and Illustrator.', '2024-04-10', '2024-05-10', 30),
(5, 'Mobile App Development', 'Michael Wilson', 'Learn to develop mobile apps for iOS and Android.', '2024-05-15', '2024-07-15', 60);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `uname` (`uname`);

--
-- Indexes for table `applied`
--
ALTER TABLE `applied`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed`
--
ALTER TABLE `feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `join_course`
--
ALTER TABLE `join_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentlogin`
--
ALTER TABLE `studentlogin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uname` (`uname`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `applied`
--
ALTER TABLE `applied`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feed`
--
ALTER TABLE `feed`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `join_course`
--
ALTER TABLE `join_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `studentlogin`
--
ALTER TABLE `studentlogin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
