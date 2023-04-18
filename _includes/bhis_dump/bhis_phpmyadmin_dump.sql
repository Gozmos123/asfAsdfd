-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2023 at 04:47 AM
-- Server version: 5.7.40-log
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bhis`
--

-- --------------------------------------------------------

--
-- Table structure for table `childrens`
--

CREATE TABLE `childrens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `prefix` varchar(10) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `age` varchar(20) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `highest_educ_attainment` varchar(255) DEFAULT NULL,
  `birthplace` longtext NOT NULL,
  `religion` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(12) DEFAULT NULL,
  `disability` varchar(255) NOT NULL,
  `mother_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `civil_status`
--

CREATE TABLE `civil_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `civil_status` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `civil_status`
--

INSERT INTO `civil_status` (`id`, `civil_status`, `created_at`, `updated_at`, `last_user`) VALUES
(1, 'Single', '2023-03-06 11:45:44', '2023-03-06 11:45:44', 'admin'),
(2, 'Married', '2023-03-06 11:45:44', '2023-03-06 11:45:44', 'admin'),
(3, 'Widowed', '2023-03-06 11:45:44', '2023-03-06 11:45:44', 'admin'),
(4, 'Divorced/Separated', '2023-03-06 11:45:44', '2023-03-06 11:45:44', 'admin'),
(5, 'Annulled', '2023-03-06 11:45:44', '2023-03-06 11:45:44', 'admin'),
(6, 'Common-law/Live-in', '2023-03-06 11:45:44', '2023-03-06 11:45:44', 'admin'),
(7, 'Unknown', '2023-03-06 11:45:44', '2023-03-06 11:45:44', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `deworms`
--

CREATE TABLE `deworms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `children_id` bigint(20) UNSIGNED NOT NULL,
  `place_given` longtext NOT NULL,
  `date_given` date DEFAULT NULL,
  `given_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `immunizations`
--

CREATE TABLE `immunizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `children_id` bigint(20) UNSIGNED NOT NULL,
  `vaccine_name` varchar(255) NOT NULL,
  `dose` varchar(50) NOT NULL,
  `date_given` date DEFAULT NULL,
  `immunization_type` varchar(100) NOT NULL,
  `administered_by` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `immunizations_type`
--

CREATE TABLE `immunizations_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `immunization_type` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mothers`
--

CREATE TABLE `mothers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(20) NOT NULL DEFAULT 'Female',
  `civil_status` varchar(25) NOT NULL,
  `highest_educ_attainment` varchar(255) DEFAULT NULL,
  `birthplace` longtext NOT NULL,
  `religion` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(12) DEFAULT NULL,
  `purok_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `puroks`
--

CREATE TABLE `puroks` (
  `id` int(10) UNSIGNED NOT NULL,
  `purok_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `puroks`
--

INSERT INTO `puroks` (`id`, `purok_name`, `created_at`, `updated_at`, `last_user`) VALUES
(1, '1', '2023-03-06 11:45:44', '2023-03-06 11:45:44', 'admin'),
(2, '2', '2023-03-06 11:45:44', '2023-03-06 11:45:44', 'admin'),
(3, '3', '2023-03-06 11:45:44', '2023-03-06 11:45:44', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `id` int(10) UNSIGNED NOT NULL,
  `religion_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`id`, `religion_name`, `created_at`, `updated_at`, `last_user`) VALUES
(1, 'Roman Catholic', '2023-03-06 11:45:44', '2023-03-06 11:45:44', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `user_type` varchar(25) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `prefix` varchar(10) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `birthplace` longtext NOT NULL,
  `religion` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(12) DEFAULT NULL,
  `purok_name` varchar(100) NOT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `photo`, `first_name`, `middle_name`, `last_name`, `prefix`, `birthdate`, `age`, `sex`, `civil_status`, `birthplace`, `religion`, `email`, `contact_no`, `purok_name`, `last_login_date`, `created_at`, `updated_at`) VALUES
(1, 'admin', '836bc6397d06de5f635683cff01822564683b57c5298c38bd389628685d9ce9d74cba952fc80ac305a6dd1d122bb041dfa93377880d478f27b99da3fafc05bf6', 'administrator', 'uploads/undraw_profile_2.svg', 'Administrative', NULL, 'User', NULL, '1990-01-01', 33, 'Male', 'Married', 'Catanduanes', 'Roman Catholic', NULL, NULL, '1', NULL, '2023-03-06 11:45:44', '2023-03-06 11:45:44'),
(2, 'bhw', 'e4067370171a220c63003a03bee4a4da84ece058e9441a4c9a5206a33648438727685cb9cc601464f7b272f11430361d6f22bbcae62ea70b4c43d9cca4b24789', 'bhw', 'uploads/undraw_profile_1.svg', 'BHW', NULL, 'User', NULL, '1990-01-01', 33, 'Female', 'Married', 'Catanduanes', 'Roman Catholic', NULL, NULL, '1', NULL, '2023-03-06 11:45:44', '2023-03-06 11:45:44'),
(3, 'user', '6ae2d3bfb3b95517b358fcdb29f7743246101ebf13f797d8244df795eec2d1d769a41c059dc37beadac8e40cecab4352764336a90302920ddeb1a6c6df4e8a00', 'user', 'uploads/undraw_profile_2.svg', 'Barangay', NULL, 'User', NULL, '1990-01-01', 33, 'Male', 'Married', 'Catanduanes', 'Roman Catholic', NULL, NULL, '1', NULL, '2023-03-06 11:45:44', '2023-03-06 11:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `action` varchar(255) NOT NULL,
  `content` longtext,
  `changes` longtext,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vitamins`
--

CREATE TABLE `vitamins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `children_id` bigint(20) UNSIGNED NOT NULL,
  `date_given` date DEFAULT NULL,
  `given_by` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `weights`
--

CREATE TABLE `weights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `children_id` bigint(20) UNSIGNED NOT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `height` decimal(8,2) DEFAULT NULL,
  `nutrition_status` varchar(100) DEFAULT NULL,
  `checked_by` varchar(255) DEFAULT NULL,
  `date_checked` date NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `childrens`
--
ALTER TABLE `childrens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Childrens_mother_id_Mothers_id` (`mother_id`),
  ADD KEY `FK_Childrens_last_user_Users_username` (`last_user`),
  ADD KEY `FK_Childrens_religion_Religions_religion_name` (`religion`),
  ADD KEY `FK_Childrens_CivilStatus_civil_status` (`civil_status`);

--
-- Indexes for table `civil_status`
--
ALTER TABLE `civil_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `civil_status` (`civil_status`),
  ADD KEY `FK_CivilStatus_last_user_Users_username` (`last_user`);

--
-- Indexes for table `deworms`
--
ALTER TABLE `deworms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Deworms_last_user_Users_username` (`last_user`),
  ADD KEY `FK_Deworms_children_id_Childrens_id` (`children_id`);

--
-- Indexes for table `immunizations`
--
ALTER TABLE `immunizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Immunizations_last_user_Users_username` (`last_user`),
  ADD KEY `FK_Immunizations_children_id_Childrens_id` (`children_id`),
  ADD KEY `FK_Immunizations_ImmunizationsType` (`immunization_type`);

--
-- Indexes for table `immunizations_type`
--
ALTER TABLE `immunizations_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `immunization_type` (`immunization_type`),
  ADD KEY `FK_ImmunizationsType_last_user_Users_username` (`last_user`);

--
-- Indexes for table `mothers`
--
ALTER TABLE `mothers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Mothers_Puroks_purok_name` (`purok_name`),
  ADD KEY `FK_Mothers_last_user_Users_username` (`last_user`),
  ADD KEY `FK_Mothers_religion_Religions_religion_name` (`religion`),
  ADD KEY `FK_Mothers_CivilStatus_civil_status` (`civil_status`);

--
-- Indexes for table `puroks`
--
ALTER TABLE `puroks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purok_name` (`purok_name`),
  ADD KEY `FK_Puroks_last_user_Users_username` (`last_user`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `religion_name` (`religion_name`),
  ADD KEY `FK_Religions_last_user_Users_username` (`last_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `FK_Users_Puroks_purok_name` (`purok_name`),
  ADD KEY `FK_Users_religion_Religions_religion_name` (`religion`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_UserLogs_Users_username` (`username`);

--
-- Indexes for table `vitamins`
--
ALTER TABLE `vitamins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Vitamins_last_user_Users_username` (`last_user`),
  ADD KEY `FK_Vitamins_children_id_Childrens_id` (`children_id`);

--
-- Indexes for table `weights`
--
ALTER TABLE `weights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Weights_last_user_Users_username` (`last_user`),
  ADD KEY `FK_Weights_children_id_Childrens_id` (`children_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `childrens`
--
ALTER TABLE `childrens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `civil_status`
--
ALTER TABLE `civil_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `deworms`
--
ALTER TABLE `deworms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `immunizations`
--
ALTER TABLE `immunizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `immunizations_type`
--
ALTER TABLE `immunizations_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mothers`
--
ALTER TABLE `mothers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `puroks`
--
ALTER TABLE `puroks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vitamins`
--
ALTER TABLE `vitamins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weights`
--
ALTER TABLE `weights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `childrens`
--
ALTER TABLE `childrens`
  ADD CONSTRAINT `FK_Childrens_CivilStatus_civil_status` FOREIGN KEY (`civil_status`) REFERENCES `civil_status` (`civil_status`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Childrens_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Childrens_mother_id_Mothers_id` FOREIGN KEY (`mother_id`) REFERENCES `mothers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Childrens_religion_Religions_religion_name` FOREIGN KEY (`religion`) REFERENCES `religions` (`religion_name`) ON UPDATE CASCADE;

--
-- Constraints for table `civil_status`
--
ALTER TABLE `civil_status`
  ADD CONSTRAINT `FK_CivilStatus_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `deworms`
--
ALTER TABLE `deworms`
  ADD CONSTRAINT `FK_Deworms_children_id_Childrens_id` FOREIGN KEY (`children_id`) REFERENCES `childrens` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Deworms_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `immunizations`
--
ALTER TABLE `immunizations`
  ADD CONSTRAINT `FK_Immunizations_ImmunizationsType` FOREIGN KEY (`immunization_type`) REFERENCES `immunizations_type` (`immunization_type`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Immunizations_children_id_Childrens_id` FOREIGN KEY (`children_id`) REFERENCES `childrens` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Immunizations_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `immunizations_type`
--
ALTER TABLE `immunizations_type`
  ADD CONSTRAINT `FK_ImmunizationsType_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `mothers`
--
ALTER TABLE `mothers`
  ADD CONSTRAINT `FK_Mothers_CivilStatus_civil_status` FOREIGN KEY (`civil_status`) REFERENCES `civil_status` (`civil_status`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Mothers_Puroks_purok_name` FOREIGN KEY (`purok_name`) REFERENCES `puroks` (`purok_name`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Mothers_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Mothers_religion_Religions_religion_name` FOREIGN KEY (`religion`) REFERENCES `religions` (`religion_name`) ON UPDATE CASCADE;

--
-- Constraints for table `puroks`
--
ALTER TABLE `puroks`
  ADD CONSTRAINT `FK_Puroks_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `religions`
--
ALTER TABLE `religions`
  ADD CONSTRAINT `FK_Religions_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_Users_Puroks_purok_name` FOREIGN KEY (`purok_name`) REFERENCES `puroks` (`purok_name`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Users_religion_Religions_religion_name` FOREIGN KEY (`religion`) REFERENCES `religions` (`religion_name`) ON UPDATE CASCADE;

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `FK_UserLogs_Users_username` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `vitamins`
--
ALTER TABLE `vitamins`
  ADD CONSTRAINT `FK_Vitamins_children_id_Childrens_id` FOREIGN KEY (`children_id`) REFERENCES `childrens` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Vitamins_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `weights`
--
ALTER TABLE `weights`
  ADD CONSTRAINT `FK_Weights_children_id_Childrens_id` FOREIGN KEY (`children_id`) REFERENCES `childrens` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Weights_last_user_Users_username` FOREIGN KEY (`last_user`) REFERENCES `users` (`username`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
