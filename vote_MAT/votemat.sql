

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'mayeshakader13@gmail.com', '123');

-- --------------------------------------------------------



CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `symbol` varchar(50) NOT NULL,
  `symphoto` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `tvotes` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `candidate` (`id`, `cname`, `symbol`, `symphoto`, `position`, `tvotes`) VALUES
(20, 'Mr. Rahim', 'nouka', '...res/nouka.png', 'Chairman', 3),
(21, 'Mr. Karim', 'dhaner shish', '...res/dhaner shish.png', 'Chairman', 6),
(22, 'Mr. Kuddus', 'douat', '...res/douat.png', 'Vice Chairman', 6),
(23, 'Mr Jabbar', 'eagle', '...res/egal.png', 'ViceChairman', 4),
(24, 'Ms. Safia', 'chaka', '...res/chaka.jpg', 'Councilar', 10),
(25, 'Ms. Rebecca', 'Ghori', '...res/ghori.jpg', 'Councilor', 8);



CREATE TABLE `can_position` (
  `id` int(255) NOT NULL,
  `position_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `can_position` (`id`, `position_name`) VALUES
(1, 'Chairman'),
(2, 'Vice Chairman'),
(3,'Councilar');



CREATE TABLE `phno_change` (
  `id` int(255) NOT NULL,
  `vname` varchar(50) NOT NULL,
  `idname` varchar(20) NOT NULL,
  `idcard` varchar(300) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `old_phno` varchar(15) NOT NULL,
  `new_phno` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE `register` (
  `id` int(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `idname` varchar(50) NOT NULL,
  `idnum` varchar(50) NOT NULL,
  `idcard` varchar(300) NOT NULL,
  `inst_id` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `verify` varchar(10) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `fname`, `lname`, `idname`, `idnum`, `idcard`, `inst_id`, `dob`, `gender`, `phone`, `address`, `verify`, `status`) VALUES
(46, 'Arafat', 'hossen', 'NID', 'P01CO20197498', 'img/3R (1).jpg', '22617', '2000-05-14', 'male', '01930710779', 'Dhanmondi', 'yes', 'voted'),
(47, 'Tasmiah', 'Iqbal', 'Passport', 'P01CO20197301', 'img/4R (1).jpg', '22618', '2000-03-18', 'female', '01723100666', 'Banashree', 'yes', 'not voted'),
(48, 'Mayesha', 'Kader', 'NID', 'P01CO20197173', 'img/5R (1).jpg', '22619', '2000-02-24', 'female', '8600929366', 'Mirpur', 'yes', 'voted'),
(49, 'Sharmin', 'Akter', 'Other ID Card', 'P01CO20197428', 'img/6R (1).jpg', '22620', '2003-02-24', 'female', '9421532533', 'Dhamrai', 'yes', 'voted');



CREATE TABLE `voting` (
  `id` int(50) NOT NULL,
  `voting_title` varchar(50) NOT NULL,
  `vot_start_date` datetime NOT NULL,
  `vot_end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `voting` (`id`, `voting_title`, `vot_start_date`, `vot_end_date`) VALUES
(1, 'Voting 2024', '2024-07-10 22:01:00', '2024-07-10 23:18:00');



ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `symbol` (`symbol`);


ALTER TABLE `can_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phno_change`
--
ALTER TABLE `phno_change`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `idnum` (`idnum`),
  ADD UNIQUE KEY `inst_id` (`inst_id`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `can_position`
--
ALTER TABLE `can_position`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `phno_change`
--
ALTER TABLE `phno_change`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

