-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2016 at 07:06 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `igadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `evaluation_id` int(11) NOT NULL,
  `eval_type` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_start` datetime NOT NULL,
  `session_end` datetime DEFAULT NULL,
  `sus_score` decimal(5,2) DEFAULT NULL,
  `sum_score` decimal(5,2) DEFAULT NULL,
  `chromosome` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`evaluation_id`, `eval_type`, `user_id`, `session_start`, `session_end`, `sus_score`, `sum_score`, `chromosome`) VALUES
(9, 0, 118, '2016-02-08 18:52:28', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_task`
--

CREATE TABLE `evaluation_task` (
  `evaluation_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `start_time` decimal(30,15) NOT NULL,
  `end_time` double(30,15) DEFAULT NULL,
  `total_time` double(30,15) DEFAULT NULL,
  `shortest_distance` int(11) DEFAULT NULL,
  `travelled_distance` tinyint(11) DEFAULT NULL,
  `seq_score` int(4) DEFAULT NULL,
  `completed` tinyint(4) DEFAULT NULL,
  `error_count` tinyint(4) DEFAULT NULL,
  `wrong_clicks` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation_task`
--

INSERT INTO `evaluation_task` (`evaluation_id`, `task_id`, `start_time`, `end_time`, `total_time`, `shortest_distance`, `travelled_distance`, `seq_score`, `completed`, `error_count`, `wrong_clicks`) VALUES
(9, 1, '1454953948.524600000000000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `generation`
--

CREATE TABLE `generation` (
  `generation_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `generation_number` tinyint(4) NOT NULL,
  `mutation_rate` decimal(6,4) NOT NULL,
  `crossover_rate` decimal(6,4) NOT NULL,
  `total_fitness` decimal(6,4) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `generation`
--

INSERT INTO `generation` (`generation_id`, `session_id`, `section`, `generation_number`, `mutation_rate`, `crossover_rate`, `total_fitness`, `start_time`, `end_time`) VALUES
(317, 114, 1, 1, '0.0500', '0.8500', '6.4000', '2016-02-08 18:46:47', '2016-02-08 18:47:11'),
(318, 114, 1, 2, '0.0500', '0.8500', '6.0000', '2016-02-08 18:47:11', '2016-02-08 18:47:23'),
(319, 114, 2, 1, '0.0500', '0.8500', '0.0000', '2016-02-08 18:47:23', '2016-02-08 18:47:36'),
(320, 114, 2, 2, '0.0500', '0.8500', '6.0000', '2016-02-08 18:47:36', '2016-02-08 18:47:48'),
(321, 114, 3, 1, '0.0500', '0.8500', '6.0000', '2016-02-08 18:47:48', '2016-02-08 18:48:00'),
(322, 114, 3, 2, '0.0500', '0.8500', '6.0000', '2016-02-08 18:48:00', '2016-02-08 18:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `individual`
--

CREATE TABLE `individual` (
  `individual_id` int(11) NOT NULL,
  `generation_id` int(11) NOT NULL,
  `chromosome` varchar(500) NOT NULL,
  `fitness` decimal(6,4) DEFAULT NULL,
  `image_path` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `individual`
--

INSERT INTO `individual` (`individual_id`, `generation_id`, `chromosome`, `fitness`, `image_path`) VALUES
(3750, 317, '15,1,3,0,2,5,4,2,10,18,2,16,10', '0.5000', 'thumbnails/individual_3750.jpg'),
(3751, 317, '19,0,2,2,1,1,2,4,8,1,3,16,1', '0.5000', 'thumbnails/individual_3751.jpg'),
(3752, 317, '9,1,4,2,1,4,0,4,1,12,3,5,3', '0.5000', 'thumbnails/individual_3752.jpg'),
(3753, 317, '4,0,3,2,2,2,3,6,2,19,4,5,7', '0.5000', 'thumbnails/individual_3753.jpg'),
(3754, 317, '10,1,1,0,0,6,2,0,10,12,5,1,3', '0.5000', 'thumbnails/individual_3754.jpg'),
(3755, 317, '19,1,4,1,0,5,3,2,5,1,1,12,4', '0.5000', 'thumbnails/individual_3755.jpg'),
(3756, 317, '12,1,0,0,0,2,2,2,1,4,1,2,0', '0.5000', 'thumbnails/individual_3756.jpg'),
(3757, 317, '2,0,5,0,2,2,5,0,0,2,1,4,2', '0.5000', 'thumbnails/individual_3757.jpg'),
(3758, 317, '8,2,1,2,2,4,1,5,1,5,0,9,10', '0.9000', 'thumbnails/individual_3758.jpg'),
(3759, 317, '14,2,4,0,2,4,3,2,2,3,0,6,9', '0.5000', 'thumbnails/individual_3759.jpg'),
(3760, 317, '7,2,4,2,1,1,2,4,2,19,4,6,8', '0.5000', 'thumbnails/individual_3760.jpg'),
(3761, 317, '15,0,4,2,2,3,3,4,3,0,3,1,3', '0.5000', 'thumbnails/individual_3761.jpg'),
(3762, 318, '9,1,4,0,0,4,2,5,1,12,5,1,3', '0.5000', 'thumbnails/individual_3762.jpg'),
(3763, 318, '12,1,0,0,0,2,2,2,1,4,1,2,0', '0.5000', 'thumbnails/individual_3763.jpg'),
(3764, 318, '16,2,1,2,2,4,5,1,1,5,1,15,2', '0.5000', 'thumbnails/individual_3764.jpg'),
(3765, 318, '4,0,3,2,2,4,1,6,2,5,4,9,10', '0.5000', 'thumbnails/individual_3765.jpg'),
(3766, 318, '8,2,1,2,2,4,1,5,1,5,0,9,10', '0.5000', 'thumbnails/individual_3766.jpg'),
(3767, 318, '10,1,1,2,1,6,0,4,10,12,1,5,8', '0.5000', 'thumbnails/individual_3767.jpg'),
(3768, 318, '8,2,1,2,2,4,1,5,1,5,0,9,10', '0.5000', 'thumbnails/individual_3768.jpg'),
(3769, 318, '7,2,4,2,1,3,3,4,2,19,3,1,3', '0.5000', 'thumbnails/individual_3769.jpg'),
(3770, 318, '15,0,4,2,2,1,2,4,3,0,4,6,8', '0.5000', 'thumbnails/individual_3770.jpg'),
(3771, 318, '10,1,1,2,1,6,0,4,10,12,1,5,8', '0.5000', 'thumbnails/individual_3771.jpg'),
(3772, 318, '15,0,4,2,2,1,2,4,3,0,4,6,8', '0.5000', 'thumbnails/individual_3772.jpg'),
(3773, 318, '12,1,0,0,0,2,2,2,1,4,1,2,0', '0.5000', 'thumbnails/individual_3773.jpg'),
(3774, 319, '7,3,14,4,3,16,3,2,12,1,4,14,8,16,15', '0.0000', 'thumbnails/individual_3774.jpg'),
(3775, 319, '19,1,3,9,4,4,13,5,17,12,2,6,6,7,0', '0.0000', 'thumbnails/individual_3775.jpg'),
(3776, 319, '12,6,17,6,3,15,3,5,7,4,4,6,7,19,5', '0.0000', 'thumbnails/individual_3776.jpg'),
(3777, 319, '5,6,5,6,2,6,19,5,13,6,3,11,7,19,11', '0.0000', 'thumbnails/individual_3777.jpg'),
(3778, 319, '13,5,0,7,1,1,12,4,8,16,3,11,4,19,18', '0.0000', 'thumbnails/individual_3778.jpg'),
(3779, 319, '11,4,1,5,4,19,4,5,8,15,0,17,4,8,13', '0.0000', 'thumbnails/individual_3779.jpg'),
(3780, 319, '10,8,17,6,1,0,11,8,7,13,4,7,4,4,5', '0.0000', 'thumbnails/individual_3780.jpg'),
(3781, 319, '18,7,11,7,1,4,18,1,6,16,1,17,7,6,17', '0.0000', 'thumbnails/individual_3781.jpg'),
(3782, 319, '2,7,18,6,4,18,8,6,15,5,6,4,5,6,6', '0.0000', 'thumbnails/individual_3782.jpg'),
(3783, 319, '6,8,6,7,4,12,15,7,7,5,5,17,4,16,19', '0.0000', 'thumbnails/individual_3783.jpg'),
(3784, 319, '11,5,13,4,1,12,16,6,8,16,5,18,4,1,9', '0.0000', 'thumbnails/individual_3784.jpg'),
(3785, 319, '13,0,15,4,0,8,13,4,13,5,1,5,5,16,1', '0.0000', 'thumbnails/individual_3785.jpg'),
(3786, 320, '7,3,14,4,3,16,3,2,12,18,4,14,7,16,15', '0.5000', 'thumbnails/individual_3786.jpg'),
(3787, 320, '7,3,14,4,3,16,3,2,12,18,4,14,7,16,15', '0.5000', 'thumbnails/individual_3787.jpg'),
(3788, 320, '7,3,14,4,3,16,3,2,12,1,4,14,8,16,3', '0.5000', 'thumbnails/individual_3788.jpg'),
(3789, 320, '7,3,14,4,3,16,3,2,12,18,4,14,7,16,15', '0.5000', 'thumbnails/individual_3789.jpg'),
(3790, 320, '2,7,18,6,4,18,8,6,15,19,6,4,5,6,6', '0.5000', 'thumbnails/individual_3790.jpg'),
(3791, 320, '7,3,14,4,3,16,3,2,12,1,4,14,8,16,15', '0.5000', 'thumbnails/individual_3791.jpg'),
(3792, 320, '7,3,14,4,3,16,3,2,11,1,4,14,8,16,15', '0.5000', 'thumbnails/individual_3792.jpg'),
(3793, 320, '7,3,14,4,3,16,3,2,11,1,4,14,8,16,15', '0.5000', 'thumbnails/individual_3793.jpg'),
(3794, 320, '7,3,14,4,3,16,3,2,12,18,4,14,7,16,15', '0.5000', 'thumbnails/individual_3794.jpg'),
(3795, 320, '7,3,14,4,3,16,3,2,12,1,3,14,8,16,15', '0.5000', 'thumbnails/individual_3795.jpg'),
(3796, 320, '7,3,14,4,3,16,3,2,12,1,4,14,8,16,3', '0.5000', 'thumbnails/individual_3796.jpg'),
(3797, 320, '7,3,14,4,3,16,3,2,12,18,4,14,7,16,15', '0.5000', 'thumbnails/individual_3797.jpg'),
(3798, 321, '12,8,3', '0.5000', 'thumbnails/individual_3798.jpg'),
(3799, 321, '12,12,2', '0.5000', 'thumbnails/individual_3799.jpg'),
(3800, 321, '14,9,1', '0.5000', 'thumbnails/individual_3800.jpg'),
(3801, 321, '4,19,0', '0.5000', 'thumbnails/individual_3801.jpg'),
(3802, 321, '0,7,2', '0.5000', 'thumbnails/individual_3802.jpg'),
(3803, 321, '9,11,5', '0.5000', 'thumbnails/individual_3803.jpg'),
(3804, 321, '16,9,2', '0.5000', 'thumbnails/individual_3804.jpg'),
(3805, 321, '2,1,2', '0.5000', 'thumbnails/individual_3805.jpg'),
(3806, 321, '3,2,5', '0.5000', 'thumbnails/individual_3806.jpg'),
(3807, 321, '15,8,2', '0.5000', 'thumbnails/individual_3807.jpg'),
(3808, 321, '7,18,5', '0.5000', 'thumbnails/individual_3808.jpg'),
(3809, 321, '15,1,3', '0.5000', 'thumbnails/individual_3809.jpg'),
(3810, 322, '7,18,5', '0.5000', 'thumbnails/individual_3810.jpg'),
(3811, 322, '14,18,1', '0.5000', 'thumbnails/individual_3811.jpg'),
(3812, 322, '7,9,5', '0.5000', 'thumbnails/individual_3812.jpg'),
(3813, 322, '15,8,2', '0.5000', 'thumbnails/individual_3813.jpg'),
(3814, 322, '12,0,5', '0.5000', 'thumbnails/individual_3814.jpg'),
(3815, 322, '7,9,5', '0.5000', 'thumbnails/individual_3815.jpg'),
(3816, 322, '2,1,2', '0.5000', 'thumbnails/individual_3816.jpg'),
(3817, 322, '7,18,5', '0.5000', 'thumbnails/individual_3817.jpg'),
(3818, 322, '7,18,5', '0.5000', 'thumbnails/individual_3818.jpg'),
(3819, 322, '16,9,3', '0.5000', 'thumbnails/individual_3819.jpg'),
(3820, 322, '15,9,3', '0.5000', 'thumbnails/individual_3820.jpg'),
(3821, 322, '2,1,2', '0.5000', 'thumbnails/individual_3821.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `chromosome` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section`, `session_id`, `chromosome`) VALUES
(162, 1, 114, '15,0,4,2,2,1,2,4,3,0,4,6,8'),
(163, 2, 114, '7,3,14,4,3,16,3,2,12,18,4,14,7,16,15'),
(164, 3, 114, '7,18,5');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selection_operator` tinyint(2) NOT NULL,
  `crossover_operator` tinyint(2) NOT NULL,
  `mutation_operator` tinyint(2) NOT NULL,
  `elitism_count` tinyint(4) NOT NULL,
  `max_generations` tinyint(4) NOT NULL,
  `population_size` tinyint(4) NOT NULL,
  `tournament_size` tinyint(4) DEFAULT NULL,
  `session_start` datetime NOT NULL,
  `session_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `user_id`, `selection_operator`, `crossover_operator`, `mutation_operator`, `elitism_count`, `max_generations`, `population_size`, `tournament_size`, `session_start`, `session_end`) VALUES
(114, 118, 1, 1, 1, 1, 2, 12, 2, '2016-02-08 18:46:47', '2016-02-08 18:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `task_number` tinyint(4) NOT NULL,
  `question` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `max_timeout` int(11) NOT NULL,
  `target_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_number`, `question`, `description`, `max_timeout`, `target_id`) VALUES
(1, 1, 'Add product 1 to shopping cart', 'Add product 1 to shopping cart', 30, 'product_1'),
(2, 2, 'Search for Product 2 using the search bar', 'Search for Product 2 using the search bar', 30, 'search_bar'),
(3, 3, 'View all products from Category 2', 'View all products from Category 2', 60, 'category_nav'),
(4, 4, 'Change price currency to Euro', 'Change price currency to Euro', 60, 'currency_bar'),
(5, 5, 'Read shipping terms and conditions', 'Read shipping terms and conditions', 60, 'footer'),
(6, 6, 'Go to the website''s Facebook page', 'Go to the website''s Facebook page', 30, 'social_icons');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `sex` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `surname`, `age`, `sex`) VALUES
(118, 'Alex', 'Spiteri', 24, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`evaluation_id`),
  ADD UNIQUE KEY `eval_type` (`eval_type`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `evaluation_task`
--
ALTER TABLE `evaluation_task`
  ADD PRIMARY KEY (`evaluation_id`,`task_id`),
  ADD KEY `evaluation_id` (`evaluation_id`,`task_id`),
  ADD KEY `task_fk` (`task_id`);

--
-- Indexes for table `generation`
--
ALTER TABLE `generation`
  ADD PRIMARY KEY (`generation_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `section` (`section`);

--
-- Indexes for table `individual`
--
ALTER TABLE `individual`
  ADD PRIMARY KEY (`individual_id`),
  ADD KEY `generation_id` (`generation_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `section` (`section`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `generation`
--
ALTER TABLE `generation`
  MODIFY `generation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;
--
-- AUTO_INCREMENT for table `individual`
--
ALTER TABLE `individual`
  MODIFY `individual_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3822;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `user_foreignkey` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluation_task`
--
ALTER TABLE `evaluation_task`
  ADD CONSTRAINT `evaluation_fk` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluation` (`evaluation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_fk` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`);

--
-- Constraints for table `generation`
--
ALTER TABLE `generation`
  ADD CONSTRAINT `generation_ibfk_1` FOREIGN KEY (`section`) REFERENCES `section` (`section`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `session_fk` FOREIGN KEY (`session_id`) REFERENCES `session` (`session_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `individual`
--
ALTER TABLE `individual`
  ADD CONSTRAINT `generation_fk` FOREIGN KEY (`generation_id`) REFERENCES `generation` (`generation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`session_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
