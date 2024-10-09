-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2024 at 02:57 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `client_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `position` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `cover_image` text NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `phone_number`, `position`, `location`, `profile`, `cover_image`, `password`) VALUES
(1, 'BUHENDWA Gabriel', 'gabrielbuhendwa400@gmail.com', '+250791348977', 'CEO/Nguvutech', 'KIGALI', '66dba102efcbf.jpg', '66dba244899c0.jpg', '$2y$10$KDYcGMq3cwjTSPoWzTQnuO3L8lR9bYuRDri3IC2PteHTVTSQUtK2a');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `project_id`, `employee_id`, `date`) VALUES
(4, 3, 4, '2024-09-07'),
(5, 3, 12, '2024-09-07'),
(6, 6, 12, '2024-09-07');

-- --------------------------------------------------------

--
-- Table structure for table `attachements`
--

CREATE TABLE `attachements` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `attachement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attachements`
--

INSERT INTO `attachements` (`id`, `request_id`, `attachement`) VALUES
(1, 1, 'capteur_d\'humidite.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `password` varchar(64) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `username`, `email`, `phone_number`, `password`, `profile`) VALUES
(1, 'Alice Johnson', 'alice.johnson@example.com', '0791460743', 'password123', 'marie.jpg'),
(2, 'Bob Williams', 'bob.williams@example.com', '222-333-4444', 'password123', 'team-1.jpg'),
(3, 'Susan Lee', 'susan.lee@gmail.com', '333-444-5555', 'password123', 'team-2.jpg'),
(4, 'michael clark', 'michael.clark@example.com', '444-555-6666', 'password123', 'team-3.jpg'),
(5, 'emily harris', 'emily.harris@example.com', '555-666-7777', 'password123', 'team-3.jpg'),
(6, 'david martin', 'david.martin@example.com', '666-777-8888', 'password123', 'team-4.jpg'),
(7, 'jennifer lee', 'jennifer.lee@example.com', '777-888-9999', 'password123', 'bruce-mars.jpg'),
(8, 'robert taylor', 'robert.taylor@example.com', '888-999-0000', 'password123', 'ivana-square.jpg'),
(9, 'chris evans', 'chris.evans@example.com', '999-000-1111', 'password123', 'kal-visuals-square.jpg'),
(10, 'karen white', 'karen.white@example.com', '000-111-2222', 'password123', 'kal-visuals-square.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `client_chats`
--

CREATE TABLE `client_chats` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `attachement` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_chats`
--

INSERT INTO `client_chats` (`id`, `client_id`, `admin_id`, `subject`, `message`, `attachement`, `created_at`) VALUES
(21, 1, 1, 'Project Proposal', 'Hello, I have attached the project proposal for your review.', 'proposal.pdf', '2024-08-23 18:14:37'),
(22, 1, 1, NULL, 'Thank you for the proposal. I have received it and will review it shortly.', '', '2024-08-23 18:14:37'),
(23, 1, 1, NULL, 'Can you please confirm the receipt of the document?', '', '2024-08-23 18:14:37'),
(24, 1, 1, NULL, 'Yes, I have received the document. I will get back to you after reviewing it.', '', '2024-08-23 18:14:37'),
(25, 1, 1, 'Design Mockups', 'I have attached the design mockups for the new interface.', 'design_mockups.zip', '2024-08-23 18:14:37'),
(26, 1, 1, NULL, 'Thanks for the design mockups. They look great. I will share them with the team.', '', '2024-08-23 18:14:37'),
(27, 1, 1, NULL, 'Let me know if you need any changes.', '', '2024-08-23 18:14:37'),
(28, 1, 1, NULL, 'No changes needed at the moment. We will proceed with this design.', '', '2024-08-23 18:14:37'),
(29, 1, 1, 'Project Deadline', 'The project is almost complete. I will send the final files soon.', '', '2024-08-23 18:14:37'),
(30, 1, 1, NULL, 'Great! Please send the final files when ready.', '', '2024-08-23 18:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `completed_project`
--

CREATE TABLE `completed_project` (
  `completed_id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `completed_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `completed_project`
--

INSERT INTO `completed_project` (`completed_id`, `request_id`, `completed_date`) VALUES
(1, 1, '2024-09-07 01:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `completed_project_team`
--

CREATE TABLE `completed_project_team` (
  `team_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `completed_id` int(11) DEFAULT NULL,
  `status` enum('completed','not completed') DEFAULT 'not completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `completed_project_team`
--

INSERT INTO `completed_project_team` (`team_id`, `employee_id`, `completed_id`, `status`) VALUES
(1, 10, 1, 'not completed'),
(2, 5, 1, 'not completed'),
(3, 6, 1, 'not completed');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(1, 'Business Strategy Consulting'),
(2, 'IT Consulting'),
(3, 'Financial Advisory'),
(4, 'Marketing and Sales Consulting'),
(5, 'Human Resources Consulting'),
(6, 'Risk Management Consulting'),
(7, 'Operations Consulting'),
(8, 'Legal and Compliance Consulting'),
(9, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `salary` float DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `username`, `email`, `phone`, `address`, `position`, `dob`, `salary`, `cv`, `password`, `profile`, `department_id`, `start_date`, `note`) VALUES
(1, 'john doe', 'john.doe@example.com', '123-456-7890', '123 Main St', 'Consultant', '1985-05-15', 60000, 'john_cv.pdf', 'password123', 'marie.jpg', 1, '2023-08-17', ''),
(2, 'jane smith', 'jane.smith@example.com', '234-567-8901', '456 Elm St', 'IT Specialist', '1990-08-22', 70000, 'jane_cv.pdf', 'password123', 'team-1.jpg', 2, '2023-08-17', ''),
(3, 'peter parker', 'peter.parker@example.com', '345-678-9012', '789 Oak St', 'Financial Analyst', '1988-11-10', 65000, 'peter_cv.pdf', 'password123', 'team-2.jpg', 3, '2023-08-17', ''),
(4, 'bruce wayne', 'bruce.wayne@example.com', '456-789-0123', '123 Gotham St', 'Marketing Manager', '1982-02-19', 80000, 'bruce_cv.pdf', 'password123', 'team-3.jpg', 1, '2023-08-17', ''),
(5, 'clark kent', 'clark.kent@example.com', '567-890-1234', '456 Metropolis St', 'HR Manager', '1985-12-14', 75000, 'clark_cv.pdf', 'password123', 'team-3.jpg', 5, '2023-08-17', ''),
(6, 'diana prince', 'diana.prince@example.com', '678-901-2345', '789 Themyscira St', 'Risk Analyst', '1992-03-25', 72000, 'diana_cv.pdf', 'password123', 'team-4.jpg', 6, '2023-08-17', ''),
(7, 'Barry allen', 'barry.allen@example.com', '789-012-3456', '123 Central City St', 'Operations Manager', '1999-12-25', 7000, 'barry_cv.pdf', 'password123', 'bruce-mars.jpg', 7, '2023-08-17', 'This employee is a good employee'),
(8, 'hal jordan', 'hal.jordan@example.com', '890-123-4567', '456 Coast City St', 'Legal Consultant', '1986-09-30', 74000, 'hal_cv.pdf', 'password123', 'ivana-square.jpg', 8, '2023-08-17', ''),
(9, 'bruce jordan', 'bruce.jordan@example.com', '890-123-4567', '456 Coast City St', 'Legal Consultant', '1986-09-30', 74000, 'hal_cv.pdf', 'password123', 'kal-visuals-square.jpg', 8, '2023-08-17', ''),
(10, 'arthur curry', 'arthur.curry@example.com', '901-234-5678', '789 Atlantis St', 'Consultant', '1991-07-07', 70000, 'arthur_cv.pdf', 'password123', 'kal-visuals-square.jpg', 9, '2023-08-17', ''),
(12, 'NDAYISABA Gloire', 'ndayisabarenzaho@gmail.com', '+25079146074', 'Kigali', 'Manager', '2024-09-05', 3000, 'Chapter_2.pdf', '$2y$10$KDYcGMq3cwjTSPoWzTQnuO3L8lR9bYuRDri3IC2PteHTVTSQUtK2a', 'team-2.jpg', 2, '2024-09-05', 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `goal`
--

CREATE TABLE `goal` (
  `goal_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `goals_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goal`
--

INSERT INTO `goal` (`goal_id`, `request_id`, `goals_number`) VALUES
(13, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `goals_id` int(11) NOT NULL,
  `goal_id` int(11) NOT NULL,
  `goal_name` varchar(255) NOT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  `set_goal` enum('pending','completed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`goals_id`, `goal_id`, `goal_name`, `status`, `set_goal`) VALUES
(23, 13, 'Planning', 'pending', 'pending'),
(24, 13, 'Design', 'pending', 'pending'),
(25, 13, 'Implementation', 'pending', 'pending'),
(26, 13, 'Testing', 'pending', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `sender` enum('ADMIN','CLIENT') DEFAULT NULL,
  `message_text` text DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages_with_employees`
--

CREATE TABLE `messages_with_employees` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `message_text` text NOT NULL,
  `file_name` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `employee_profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `off_employees`
--

CREATE TABLE `off_employees` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `off_employees`
--

INSERT INTO `off_employees` (`id`, `employee_id`, `start_date`, `end_date`) VALUES
(1, 5, '2024-09-07', '2024-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `perfomance`
--

CREATE TABLE `perfomance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `task` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perfomance`
--

INSERT INTO `perfomance` (`id`, `employee_id`, `project_id`, `task`) VALUES
(1, 1, 1, 'completed'),
(2, 2, 2, 'not completed'),
(3, 3, 3, 'completed'),
(4, 4, 4, 'completed'),
(5, 5, 5, 'not completed'),
(6, 6, 6, 'completed'),
(7, 7, 7, 'completed'),
(8, 8, 8, 'not completed'),
(9, 9, 9, 'completed'),
(10, 10, 10, 'not completed');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `goals_id` int(11) NOT NULL,
  `status` enum('pending','completed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `goals_id`, `status`) VALUES
(1, 23, 'completed'),
(2, 24, 'completed'),
(3, 25, 'completed'),
(4, 26, 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `project_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `request_id`, `project_status`) VALUES
(1, 1, 'completed'),
(2, 2, 'Pending'),
(3, 3, 'Assigned'),
(4, 4, NULL),
(5, 5, NULL),
(6, 6, 'Assigned'),
(7, 7, 'Pending'),
(8, 8, 'Assigned'),
(9, 9, 'Assigned'),
(10, 10, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_image` varchar(255) NOT NULL,
  `service_category` varchar(255) NOT NULL,
  `service_details` text NOT NULL,
  `priority_level` varchar(20) NOT NULL,
  `deadline` date NOT NULL,
  `amount` float NOT NULL,
  `request_date` date NOT NULL,
  `cover_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `client_id`, `company_name`, `position`, `project_name`, `project_image`, `service_category`, `service_details`, `priority_level`, `deadline`, `amount`, `request_date`, `cover_image`) VALUES
(1, 1, 'Tech Innovations Ltd.', 'Manager', 'Corporate Website Redesign', 'home-decor-1.jpg', 'Website Development', 'Develop a company website with e-commerce capabilities.', 'High', '1970-01-01', 900, '2024-08-20', 'capteur_d_humidite.PNG'),
(2, 2, 'Global IT Solutions', 'Director', 'Advanced Network Setup', 'home-decor-2.jpg', 'IT Infrastructure', 'Set up a secure IT network for a new office.', 'Medium', '2024-10-01', 7500, '2024-08-20', ''),
(3, 3, 'Digital Ventures', 'CEO', 'Product Launch Campaign', 'home-decor-3.jpg', 'Digital Marketing ', 'Create a digital marketing strategy for product launch.', 'High', '2025-01-28', 3000, '2024-08-20', ''),
(4, 4, 'Compliance Experts', 'COO', 'Regulatory Audit', 'logo-court.jpg', 'Legal Compliance', 'Review and update all legal documents for compliance.', 'Low', '2024-11-01', 2000, '2024-08-20', ''),
(5, 5, 'Talent Seekers', 'HR Head', 'Executive Recruitment Strategy', 'vr-bg.jpg', 'Recruitment Services', 'Assist in recruiting top talent for the technology department.', 'Medium', '2024-09-20', 4500, '2024-08-20', ''),
(6, 6, 'Brand Masters', 'Marketing Lead', 'Market Rebranding Initiative', 'home-decor-1.jpg', 'Brand Strategy', 'Develop a comprehensive brand strategy.', 'High', '2024-09-25', 4000, '2024-08-20', ''),
(7, 7, 'Efficiency Consultants', 'Project Manager', 'Business Process Optimization', 'home-decor-2.jpg', 'Operations Consulting', 'Optimize operations for better efficiency.', 'Medium', '2024-10-05', 6000, '2024-08-20', ''),
(8, 8, 'Risk Managers Inc.', 'Legal Advisor', 'Enterprise Risk Assessment', 'home-decor-3.jpg', 'Risk Management', 'Implement a risk management framework.', 'Low', '2024-12-01', 5500, '2024-08-20', ''),
(9, 9, 'Finance Gurus', 'Finance Head', 'Strategic Financial Planning', 'logo-court.jpg', 'Financial Advisory', 'Provide financial advisory services for mergers.', 'High', '2024-09-10', 8000, '2024-08-20', ''),
(10, 10, 'Cyber Protectors', 'IT Manager', 'Advanced Threat Detection', 'vr-bg.jpg', 'Cybersecurity', 'Enhance cybersecurity measures across all systems.', 'High', '2024-09-05', 7000, '2024-08-20', '');

-- --------------------------------------------------------

--
-- Table structure for table `working_employees`
--

CREATE TABLE `working_employees` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `working_employees`
--

INSERT INTO `working_employees` (`id`, `employee_id`, `request_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `attachements`
--
ALTER TABLE `attachements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `client_chats`
--
ALTER TABLE `client_chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `completed_project`
--
ALTER TABLE `completed_project`
  ADD PRIMARY KEY (`completed_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `completed_project_team`
--
ALTER TABLE `completed_project_team`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `complete_id` (`completed_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `goal`
--
ALTER TABLE `goal`
  ADD PRIMARY KEY (`goal_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`goals_id`),
  ADD KEY `fk_goal_id` (`goal_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `messages_with_employees`
--
ALTER TABLE `messages_with_employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `off_employees`
--
ALTER TABLE `off_employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `perfomance`
--
ALTER TABLE `perfomance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_goals_id` (`goals_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `working_employees`
--
ALTER TABLE `working_employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `request_id` (`request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attachements`
--
ALTER TABLE `attachements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `client_chats`
--
ALTER TABLE `client_chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `completed_project`
--
ALTER TABLE `completed_project`
  MODIFY `completed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `completed_project_team`
--
ALTER TABLE `completed_project_team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `goal`
--
ALTER TABLE `goal`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `goals_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages_with_employees`
--
ALTER TABLE `messages_with_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `off_employees`
--
ALTER TABLE `off_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perfomance`
--
ALTER TABLE `perfomance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `working_employees`
--
ALTER TABLE `working_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `assignment_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `assignment_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Constraints for table `attachements`
--
ALTER TABLE `attachements`
  ADD CONSTRAINT `attachements_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`);

--
-- Constraints for table `client_chats`
--
ALTER TABLE `client_chats`
  ADD CONSTRAINT `client_chats_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `client_chats_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `client_chats_ibfk_3` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `completed_project`
--
ALTER TABLE `completed_project`
  ADD CONSTRAINT `completed_project_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE CASCADE;

--
-- Constraints for table `completed_project_team`
--
ALTER TABLE `completed_project_team`
  ADD CONSTRAINT `completed_project_team_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `completed_project_team_ibfk_2` FOREIGN KEY (`completed_id`) REFERENCES `completed_project` (`completed_id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `goal`
--
ALTER TABLE `goal`
  ADD CONSTRAINT `goal_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`);

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `fk_goal_id` FOREIGN KEY (`goal_id`) REFERENCES `goal` (`goal_id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `messages_with_employees`
--
ALTER TABLE `messages_with_employees`
  ADD CONSTRAINT `messages_with_employees_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`);

--
-- Constraints for table `off_employees`
--
ALTER TABLE `off_employees`
  ADD CONSTRAINT `off_employees_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Constraints for table `perfomance`
--
ALTER TABLE `perfomance`
  ADD CONSTRAINT `perfomance_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `perfomance_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `fk_goals_id` FOREIGN KEY (`goals_id`) REFERENCES `goals` (`goals_id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `working_employees`
--
ALTER TABLE `working_employees`
  ADD CONSTRAINT `working_employees_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `working_employees_ibfk_2` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
