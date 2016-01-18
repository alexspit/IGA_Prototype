-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2016 at 07:23 PM
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
  `type` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sessionStart` datetime NOT NULL,
  `sessionEnd` datetime NOT NULL,
  `sus_score` decimal(5,2) NOT NULL,
  `sum_score` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_task`
--

CREATE TABLE `evaluation_task` (
  `evaluation_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `total_time` int(11) NOT NULL,
  `shortest_distance` int(11) NOT NULL,
  `travelled_distance` tinyint(4) NOT NULL,
  `seq_score` int(11) NOT NULL,
  `completed` tinyint(4) NOT NULL,
  `error_count` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `generation`
--

CREATE TABLE `generation` (
  `generation_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `generation_number` tinyint(4) NOT NULL,
  `mutation_rate` decimal(6,4) NOT NULL,
  `crossover_rate` decimal(6,4) NOT NULL,
  `total_fitness` decimal(6,4) DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `generation`
--

INSERT INTO `generation` (`generation_id`, `session_id`, `generation_number`, `mutation_rate`, `crossover_rate`, `total_fitness`, `startTime`, `endTime`) VALUES
(75, 68, 1, '0.0500', '0.8500', '5.8000', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 68, 2, '0.0500', '0.8500', '5.1000', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 68, 3, '0.0500', '0.8500', '6.4000', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 68, 4, '0.0500', '0.8500', '0.0000', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 68, 5, '0.0500', '0.8500', '5.7000', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 68, 6, '0.0500', '0.8500', '6.8000', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 68, 7, '0.0500', '0.8500', '8.8000', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 68, 8, '0.0500', '0.8500', '9.6000', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 68, 9, '0.0500', '0.8500', '9.3000', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 68, 10, '0.0500', '0.8500', '6.0000', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(456, 75, '2,3,3,1,0,0,1', '0.3000', 'thumbnails/individual_456.jpg'),
(457, 75, '8,1,0,0,1,1,3', '0.2000', 'thumbnails/individual_457.jpg'),
(458, 75, '5,1,1,1,2,1,1', '0.7000', 'thumbnails/individual_458.jpg'),
(459, 75, '18,3,3,2,1,0,3', '0.6000', 'thumbnails/individual_459.jpg'),
(460, 75, '0,0,3,4,1,0,6', '1.0000', 'thumbnails/individual_460.jpg'),
(461, 75, '1,2,2,6,0,0,4', '0.1000', 'thumbnails/individual_461.jpg'),
(462, 75, '6,3,0,4,2,1,4', '0.5000', 'thumbnails/individual_462.jpg'),
(463, 75, '14,1,3,5,1,0,3', '0.1000', 'thumbnails/individual_463.jpg'),
(464, 75, '2,0,0,5,1,0,5', '0.1000', 'thumbnails/individual_464.jpg'),
(465, 75, '9,2,3,5,0,0,3', '1.0000', 'thumbnails/individual_465.jpg'),
(466, 75, '11,1,3,2,1,0,4', '1.0000', 'thumbnails/individual_466.jpg'),
(467, 75, '1,0,0,4,1,2,6', '0.2000', 'thumbnails/individual_467.jpg'),
(468, 76, '11,1,3,2,1,0,4', '0.8000', 'thumbnails/individual_468.jpg'),
(469, 76, '2,3,3,1,0,0,1', '0.7000', 'thumbnails/individual_469.jpg'),
(470, 76, '14,1,3,5,1,0,3', '0.2000', 'thumbnails/individual_470.jpg'),
(471, 76, '14,1,3,5,1,0,3', '0.2000', 'thumbnails/individual_471.jpg'),
(472, 76, '1,2,2,6,0,0,4', '0.1000', 'thumbnails/individual_472.jpg'),
(473, 76, '5,1,1,1,2,1,1', '0.6000', 'thumbnails/individual_473.jpg'),
(474, 76, '1,3,0,2,1,2,0', '0.2000', 'thumbnails/individual_474.jpg'),
(475, 76, '18,3,3,2,1,0,3', '0.6000', 'thumbnails/individual_475.jpg'),
(476, 76, '5,2,1,1,2,0,1', '0.7000', 'thumbnails/individual_476.jpg'),
(477, 76, '1,2,2,6,0,0,4', '0.1000', 'thumbnails/individual_477.jpg'),
(478, 76, '5,2,1,1,2,0,1', '0.7000', 'thumbnails/individual_478.jpg'),
(479, 76, '0,0,0,0,1,0,6', '0.2000', 'thumbnails/individual_479.jpg'),
(480, 77, '11,1,3,2,1,0,4', '0.8000', 'thumbnails/individual_480.jpg'),
(481, 77, '5,2,1,1,2,0,1', '1.0000', 'thumbnails/individual_481.jpg'),
(482, 77, '14,1,3,5,1,0,3', '0.1000', 'thumbnails/individual_482.jpg'),
(483, 77, '1,0,2,6,0,0,4', '0.1000', 'thumbnails/individual_483.jpg'),
(484, 77, '11,1,3,2,1,0,0', '0.6000', 'thumbnails/individual_484.jpg'),
(485, 77, '14,3,3,5,1,0,3', '0.1000', 'thumbnails/individual_485.jpg'),
(486, 77, '5,2,2,1,0,0,4', '0.1000', 'thumbnails/individual_486.jpg'),
(487, 77, '11,1,3,5,1,0,3', '0.7000', 'thumbnails/individual_487.jpg'),
(488, 77, '5,1,1,3,2,1,1', '0.9000', 'thumbnails/individual_488.jpg'),
(489, 77, '11,1,3,2,1,0,0', '0.5000', 'thumbnails/individual_489.jpg'),
(490, 77, '5,1,1,3,2,1,1', '0.5000', 'thumbnails/individual_490.jpg'),
(491, 77, '5,2,1,1,2,0,1', '1.0000', 'thumbnails/individual_491.jpg'),
(492, 78, '5,2,1,1,2,0,1', '0.0000', 'thumbnails/individual_492.jpg'),
(493, 78, '5,1,1,3,2,1,1', '0.0000', 'thumbnails/individual_493.jpg'),
(494, 78, '5,2,2,1,1,0,5', '0.0000', 'thumbnails/individual_494.jpg'),
(495, 78, '11,1,1,3,1,0,1', '0.0000', 'thumbnails/individual_495.jpg'),
(496, 78, '5,1,1,1,2,0,1', '0.0000', 'thumbnails/individual_496.jpg'),
(497, 78, '5,1,2,6,1,0,4', '0.0000', 'thumbnails/individual_497.jpg'),
(498, 78, '5,1,2,6,1,0,4', '0.0000', 'thumbnails/individual_498.jpg'),
(499, 78, '5,2,3,1,0,0,4', '0.0000', 'thumbnails/individual_499.jpg'),
(500, 78, '5,2,1,1,0,1,1', '0.0000', 'thumbnails/individual_500.jpg'),
(501, 78, '5,1,1,3,2,1,1', '0.0000', 'thumbnails/individual_501.jpg'),
(502, 78, '5,2,2,1,1,0,5', '0.0000', 'thumbnails/individual_502.jpg'),
(503, 78, '11,1,1,3,1,0,1', '0.0000', 'thumbnails/individual_503.jpg'),
(504, 79, '5,1,3,3,2,1,4', '0.5000', 'thumbnails/individual_504.jpg'),
(505, 79, '5,2,3,1,0,0,1', '0.5000', 'thumbnails/individual_505.jpg'),
(506, 79, '5,2,2,1,1,0,4', '0.1000', 'thumbnails/individual_506.jpg'),
(507, 79, '5,3,1,1,0,1,1', '0.5000', 'thumbnails/individual_507.jpg'),
(508, 79, '5,1,2,6,2,0,1', '0.1000', 'thumbnails/individual_508.jpg'),
(509, 79, '5,1,1,3,2,1,1', '0.6000', 'thumbnails/individual_509.jpg'),
(510, 79, '5,1,1,3,2,1,1', '0.6000', 'thumbnails/individual_510.jpg'),
(511, 79, '5,3,1,3,1,1,4', '0.7000', 'thumbnails/individual_511.jpg'),
(512, 79, '5,1,1,5,2,1,1', '0.9000', 'thumbnails/individual_512.jpg'),
(513, 79, '5,2,2,1,1,0,4', '0.1000', 'thumbnails/individual_513.jpg'),
(514, 79, '5,3,1,1,0,1,1', '1.0000', 'thumbnails/individual_514.jpg'),
(515, 79, '5,1,2,6,2,0,1', '0.1000', 'thumbnails/individual_515.jpg'),
(516, 80, '5,3,1,1,0,1,1', '0.9000', 'thumbnails/individual_516.jpg'),
(517, 80, '5,1,2,6,2,0,1', '0.1000', 'thumbnails/individual_517.jpg'),
(518, 80, '5,2,2,1,1,0,1', '0.1000', 'thumbnails/individual_518.jpg'),
(519, 80, '18,1,1,5,2,1,1', '0.1000', 'thumbnails/individual_519.jpg'),
(520, 80, '5,1,2,3,1,0,1', '0.1000', 'thumbnails/individual_520.jpg'),
(521, 80, '5,1,3,3,2,1,4', '0.7000', 'thumbnails/individual_521.jpg'),
(522, 80, '5,3,3,3,2,1,4', '1.0000', 'thumbnails/individual_522.jpg'),
(523, 80, '5,2,1,3,0,0,1', '1.0000', 'thumbnails/individual_523.jpg'),
(524, 80, '5,3,1,1,1,1,4', '1.0000', 'thumbnails/individual_524.jpg'),
(525, 80, '5,2,2,1,1,0,1', '0.1000', 'thumbnails/individual_525.jpg'),
(526, 80, '5,1,1,3,0,1,1', '0.7000', 'thumbnails/individual_526.jpg'),
(527, 80, '5,3,3,3,2,1,4', '1.0000', 'thumbnails/individual_527.jpg'),
(528, 81, '5,2,1,3,0,0,1', '0.7000', 'thumbnails/individual_528.jpg'),
(529, 81, '5,3,3,3,0,1,1', '1.0000', 'thumbnails/individual_529.jpg'),
(530, 81, '18,1,2,5,2,1,1', '0.1000', 'thumbnails/individual_530.jpg'),
(531, 81, '5,3,1,1,0,1,1', '1.0000', 'thumbnails/individual_531.jpg'),
(532, 81, '5,0,1,1,1,1,4', '1.0000', 'thumbnails/individual_532.jpg'),
(533, 81, '5,0,1,3,0,0,1', '0.8000', 'thumbnails/individual_533.jpg'),
(534, 81, '5,0,1,3,0,0,1', '1.0000', 'thumbnails/individual_534.jpg'),
(535, 81, '18,1,1,5,2,1,1', '0.1000', 'thumbnails/individual_535.jpg'),
(536, 81, '5,2,3,1,1,0,1', '1.0000', 'thumbnails/individual_536.jpg'),
(537, 81, '5,3,3,3,0,1,1', '1.0000', 'thumbnails/individual_537.jpg'),
(538, 81, '18,1,2,5,2,1,1', '0.1000', 'thumbnails/individual_538.jpg'),
(539, 81, '5,3,1,1,0,1,1', '1.0000', 'thumbnails/individual_539.jpg'),
(540, 82, '5,3,3,3,0,1,1', '1.0000', 'thumbnails/individual_540.jpg'),
(541, 82, '5,3,1,1,2,1,1', '0.9000', 'thumbnails/individual_541.jpg'),
(542, 82, '5,0,1,1,1,1,4', '0.9000', 'thumbnails/individual_542.jpg'),
(543, 82, '5,0,1,3,0,0,1', '0.9000', 'thumbnails/individual_543.jpg'),
(544, 82, '0,0,2,5,2,1,1', '0.1000', 'thumbnails/individual_544.jpg'),
(545, 82, '5,1,2,5,0,1,1', '0.1000', 'thumbnails/individual_545.jpg'),
(546, 82, '5,3,3,1,0,1,1', '1.0000', 'thumbnails/individual_546.jpg'),
(547, 82, '5,0,3,1,1,0,1', '1.0000', 'thumbnails/individual_547.jpg'),
(548, 82, '5,1,1,3,0,0,1', '0.9000', 'thumbnails/individual_548.jpg'),
(549, 82, '5,3,3,1,0,1,1', '1.0000', 'thumbnails/individual_549.jpg'),
(550, 82, '5,2,1,1,1,0,1', '0.8000', 'thumbnails/individual_550.jpg'),
(551, 82, '5,0,3,1,1,0,1', '1.0000', 'thumbnails/individual_551.jpg'),
(552, 83, '5,3,3,1,0,1,1', '1.0000', 'thumbnails/individual_552.jpg'),
(553, 83, '5,0,1,3,0,0,1', '0.9000', 'thumbnails/individual_553.jpg'),
(554, 83, '5,1,2,1,1,1,1', '0.1000', 'thumbnails/individual_554.jpg'),
(555, 83, '5,0,3,1,1,1,1', '1.0000', 'thumbnails/individual_555.jpg'),
(556, 83, '5,1,2,5,0,0,1', '0.8000', 'thumbnails/individual_556.jpg'),
(557, 83, '5,0,1,3,0,0,1', '0.8000', 'thumbnails/individual_557.jpg'),
(558, 83, '5,3,1,1,0,1,1', '0.9000', 'thumbnails/individual_558.jpg'),
(559, 83, '5,0,1,3,0,1,1', '0.8000', 'thumbnails/individual_559.jpg'),
(560, 83, '5,0,3,1,0,0,1', '1.0000', 'thumbnails/individual_560.jpg'),
(561, 83, '5,1,2,1,1,1,1', '0.1000', 'thumbnails/individual_561.jpg'),
(562, 83, '5,3,3,1,0,0,1', '1.0000', 'thumbnails/individual_562.jpg'),
(563, 83, '5,3,1,1,0,1,1', '0.9000', 'thumbnails/individual_563.jpg'),
(564, 84, '5,3,3,1,0,0,1', '0.5000', 'thumbnails/individual_564.jpg'),
(565, 84, '5,1,2,1,1,1,1', '0.5000', 'thumbnails/individual_565.jpg'),
(566, 84, '5,3,0,1,0,1,1', '0.5000', 'thumbnails/individual_566.jpg'),
(567, 84, '5,3,3,1,1,1,1', '0.5000', 'thumbnails/individual_567.jpg'),
(568, 84, '5,3,1,3,0,0,1', '0.5000', 'thumbnails/individual_568.jpg'),
(569, 84, '17,3,1,1,0,0,2', '0.5000', 'thumbnails/individual_569.jpg'),
(570, 84, '5,0,2,4,0,0,1', '0.5000', 'thumbnails/individual_570.jpg'),
(571, 84, '5,3,1,2,0,1,1', '0.5000', 'thumbnails/individual_571.jpg'),
(572, 84, '5,3,3,1,0,1,1', '0.5000', 'thumbnails/individual_572.jpg'),
(573, 84, '5,3,0,1,0,1,1', '0.5000', 'thumbnails/individual_573.jpg'),
(574, 84, '5,1,1,3,0,1,1', '0.5000', 'thumbnails/individual_574.jpg'),
(575, 84, '5,0,2,4,0,0,1', '0.5000', 'thumbnails/individual_575.jpg');

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
(68, 87, 2, 1, 1, 1, 10, 12, 2, '2016-01-18 18:43:41', NULL);

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
  `target_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(87, 'Sarah', 'Spiteri', 20, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`evaluation_id`),
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
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `individual`
--
ALTER TABLE `individual`
  ADD PRIMARY KEY (`individual_id`),
  ADD KEY `generation_id` (`generation_id`);

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
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `generation`
--
ALTER TABLE `generation`
  MODIFY `generation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `individual`
--
ALTER TABLE `individual`
  MODIFY `individual_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=696;
--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `session_fk` FOREIGN KEY (`session_id`) REFERENCES `session` (`session_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `individual`
--
ALTER TABLE `individual`
  ADD CONSTRAINT `generation_fk` FOREIGN KEY (`generation_id`) REFERENCES `generation` (`generation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
