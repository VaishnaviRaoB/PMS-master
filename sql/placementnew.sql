-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 01:45 PM
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
-- Database: `placementnew`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `uname` varchar(10) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`uname`, `pwd`, `fname`, `lname`, `email`, `phone`) VALUES
('admin1', 'pass123', 'John', 'Doe', 'john.doe@example.com', '1234567890'),
('admin2', 'pass456', 'Jane', 'Smith', 'jane.smith@example.com', '0987654321'),
('admin3', 'pass789', 'Alice', 'Johnson', 'alice.johnson@example.com', '5555555555'),
('admin4', 'pass321', 'Bob', 'Brown', 'bob.brown@example.com', '4444444444'),
('admin5', 'pass654', 'Charlie', 'Davis', 'charlie.davis@example.com', '3333333333');

-- --------------------------------------------------------

--
-- Table structure for table `applied`
--

CREATE TABLE `applied` (
  `usn` varchar(20) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `company` varchar(200) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'Unknown',
  `chances` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applied`
--

INSERT INTO `applied` (`usn`, `student_name`, `company`, `status`, `chances`)
VALUES
('USN001', 'Alice Wonderland', 'General Electric', 'Selected', 'High'),
('USN002', 'Bob Builder', 'Tata Consultancy Services (TCS)', 'Rejected', 'Low'),
('USN003', 'Charlie Chocolate', 'Wipro', 'Attended', 'High'),
('USN004', 'David Copperfield', 'General Electric', 'Selected', 'High'),
('USN005', 'Eve Adams', 'Infosys', 'Attended', 'Low'),
('USN001', 'Alice Wonderland', 'Siemens AG', 'Attended', 'Medium'),
('USN002', 'Bob Builder', 'Infosys', 'Unknown', NULL),
('USN004', 'David Copperfield', 'Siemens AG', 'Rejected', 'Medium'),
('USN005', 'Eve Adams', 'Concentrix', 'Applied', 'High');



-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `name` varchar(130) NOT NULL,
  `type` varchar(30) NOT NULL,
  `address` varchar(200) NOT NULL,
  `number` varchar(11) NOT NULL,
  `website` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `minperc` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--
INSERT INTO `company` (`name`, `type`, `address`, `number`, `website`, `status`, `minperc`) VALUES
('Infosys', 'IT', 'Bangalore, India', '8088888888', 'https://www.infosys.com', 'Active', '60'),
('Accenture', 'BPO', 'Dublin, Ireland', '1234567890', 'https://www.accenture.com', 'Active', '60'),
('McKinsey & Company', 'Consulting', 'New York, USA', '2124467000', 'https://www.mckinsey.com', 'Active', '75'),
('General Electric', 'Manufacturing', 'Boston, USA', '6174433000', 'https://www.ge.com', 'Active', '70'),
('Johnson & Johnson', 'Healthcare', 'New Brunswick, USA', '7325240400', 'https://www.jnj.com', 'Active', '75'),
('JPMorgan Chase', 'Finance', 'New York, USA', '2122706000', 'https://www.jpmorganchase.com', 'Active', '80'),
('Walmart', 'Retail', 'Bentonville, USA', '4792734000', 'https://www.walmart.com', 'Active', '80'),
('Harvard University', 'Education', 'Cambridge, USA', '6174951000', 'https://www.harvard.edu', 'Active', '90'),
('Marriott International', 'Hospitality', 'Bethesda, USA', '3013803000', 'https://www.marriott.com', 'Active', '70'),
('CBRE Group', 'Real Estate', 'Los Angeles, USA', '2136133333', 'https://www.cbre.com', 'Active', '70'),
('Verizon Communications', 'Telecommunications', 'New York, USA', '2123951000', 'https://www.verizon.com', 'Active', '70');



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feed`
--

INSERT INTO `feed` (`id`, `user`, `message`, `date`, `time`) VALUES
(1, 'admin1', 'Welcome to the new placement portal!', '2024-06-01', '09:00:00'),
(2, 'admin2', 'New companies have been added.', '2024-06-02', '10:00:00'),
(3, 'admin3', 'Training sessions will start next week.', '2024-06-03', '11:00:00'),
(4, 'admin4', 'Placement results will be announced soon.', '2024-06-04', '12:00:00'),
(5, 'admin5', 'Feedback sessions are now open.', '2024-06-05', '13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `join_course`
--

CREATE TABLE `join_course` (
  `course_name` varchar(255) NOT NULL,
  `enrollment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `student_name` varchar(100) NOT NULL,
  `usn` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `join_course`
--

INSERT INTO `join_course` (`course_name`, `enrollment_date`, `student_name`, `usn`) VALUES
('Data Structures', '2024-06-01 03:30:00', 'Alice Wonderland', 'USN001'),
('Algorithms', '2024-06-01 03:30:00', 'Bob Builder', 'USN002'),
('Operating Systems', '2024-06-01 03:30:00', 'Charlie Chocolate', 'USN003'),
('Database Management', '2024-06-01 03:30:00', 'David Copperfield', 'USN004'),
('Machine Learning', '2024-06-01 03:30:00', 'Eve Adams', 'USN005');

-- --------------------------------------------------------

--
-- Table structure for table `studentlogin`
--

CREATE TABLE `studentlogin` (
  `usn` varchar(20) NOT NULL,
  `uname` varchar(10) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `secque` varchar(100) NOT NULL,
  `secans` varchar(100) NOT NULL,
  `course` varchar(100) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `percentage` varchar(10) DEFAULT NULL,
  `yop` varchar(10) DEFAULT NULL,
  `sslc` varchar(100) DEFAULT NULL,
  `puc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentlogin`
--

INSERT INTO `studentlogin` (`usn`, `uname`, `pwd`, `fname`, `lname`, `email`, `phone`, `secque`, `secans`, `course`, `branch`, `percentage`, `yop`, `sslc`, `puc`) VALUES
('USN001', 'student1', 'stud123', 'Alice', 'Wonderland', 'alice@example.com', '1234509876', 'Pet name', 'Fluffy', 'B.Tech', 'CSE', '85', '2024', '90', '92'),
('USN002', 'student2', 'stud456', 'Bob', 'Builder', 'bob@example.com', '2345610987', 'maiden name', 'Smith', 'B.Tech', 'ECE', '80', '2024', '85', '88'),
('USN003', 'student3', 'stud789', 'Charlie', 'Chocolate', 'charlie@example.com', '3456721098', 'First school', 'Greenwood', 'B.Tech', 'EEE', '78', '2024', '88', '86'),
('USN004', 'student4', 'stud321', 'David', 'Copperfield', 'david@example.com', '4567832109', 'Favorite book', 'Harry Potter', 'B.Tech', 'ME', '82', '2024', '87', '89'),
('USN005', 'student5', 'stud654', 'Eve', 'Adams', 'eve@example.com', '5678943210', 'Favorite color', 'Blue', 'B.Tech', 'CE', '84', '2024', '89', '90');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
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

INSERT INTO `training` (`course`, `lecturer`, `description`, `start_date`, `end_date`, `duration`) VALUES
('Data Structures', 'Dr. Smith', 'In-depth study of data structures.', '2024-06-10', '2024-07-10', 30),
('Algorithms', 'Dr. Johnson', 'Algorithm design and analysis.', '2024-06-15', '2024-07-15', 30),
('Operating Systems', 'Prof. Brown', 'Operating system concepts.', '2024-06-20', '2024-07-20', 30),
('Database Management', 'Dr. White', 'Database systems and SQL.', '2024-06-25', '2024-07-25', 30),
('Machine Learning', 'Prof. Black', 'Introduction to machine learning.', '2024-06-30', '2024-07-30', 30),
('dbms', 'a', 'abc', '2024-06-20', '2024-07-06', 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`uname`);

--
-- Indexes for table `applied`
--
ALTER TABLE `applied`
  ADD KEY `usn` (`usn`),
  ADD KEY `company` (`company`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `feed`
--
ALTER TABLE `feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `join_course`
--
ALTER TABLE `join_course`
  ADD KEY `usn` (`usn`);

--
-- Indexes for table `studentlogin`
--
ALTER TABLE `studentlogin`
  ADD PRIMARY KEY (`usn`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `join_course`
--
ALTER TABLE `join_course`
  ADD CONSTRAINT `join_course_ibfk_1` FOREIGN KEY (`usn`) REFERENCES `studentlogin` (`usn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;