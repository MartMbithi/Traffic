-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 03, 2021 at 01:28 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traffic`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` varchar(200) NOT NULL,
  `login_user_name` varchar(200) DEFAULT NULL,
  `login_password` varchar(200) DEFAULT NULL,
  `login_rank` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `login_user_name`, `login_password`, `login_rank`) VALUES
('35e16fcc2c2078dd762950ffb2cf5b57110546938e', 'doejames@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Motorist'),
('5f681389abf2ae2ba62a79c7173d8c348e268fc7c3', 'jd@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Motorist'),
('682bba22b3e100961e5aa1f62828ca3f24124c185e', 'System Admin', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Administrator'),
('e696876023bb5eba172b08991b56acb5a098bec603', 'jamesdoe@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Officer');

-- --------------------------------------------------------

--
-- Table structure for table `motorist`
--

CREATE TABLE `motorist` (
  `motorist_id` varchar(200) NOT NULL,
  `motorist_full_name` varchar(200) DEFAULT NULL,
  `motorist_email` varchar(200) DEFAULT NULL,
  `motorist_mobile` varchar(200) DEFAULT NULL,
  `motorist_id_no` varchar(200) DEFAULT NULL,
  `motorist_license_no` varchar(200) DEFAULT NULL,
  `motorist_dob` varchar(200) DEFAULT NULL,
  `motorist_login_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `motorist`
--

INSERT INTO `motorist` (`motorist_id`, `motorist_full_name`, `motorist_email`, `motorist_mobile`, `motorist_id_no`, `motorist_license_no`, `motorist_dob`, `motorist_login_id`) VALUES
('a3324b17cbb489a2f36786f2bed1aa15873d3b6037', 'James Doe', 'jd@mail.com', '900523824', '900093', 'KBD 990F', '2021-09-03', '5f681389abf2ae2ba62a79c7173d8c348e268fc7c3'),
('fd9a3ee2b2c36b47e975d9cdb52c5786c91fc6d07e', 'Doe James', 'doejames@mail.com', '+25487742312', '09876543456', 'KCS 908A', '2021-09-03', '35e16fcc2c2078dd762950ffb2cf5b57110546938e');

-- --------------------------------------------------------

--
-- Table structure for table `offences`
--

CREATE TABLE `offences` (
  `offence_id` varchar(200) NOT NULL,
  `offence_date` varchar(200) DEFAULT NULL,
  `offence_location` varchar(200) DEFAULT NULL,
  `offence_rule_id` varchar(200) DEFAULT NULL,
  `offence_motorist_id` varchar(200) DEFAULT NULL,
  `offence_vehicle_type` varchar(200) DEFAULT NULL,
  `offence_vehicle_registration` varchar(200) DEFAULT NULL,
  `offence_report` longtext DEFAULT NULL,
  `offence_officer_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offences`
--

INSERT INTO `offences` (`offence_id`, `offence_date`, `offence_location`, `offence_rule_id`, `offence_motorist_id`, `offence_vehicle_type`, `offence_vehicle_registration`, `offence_report`, `offence_officer_id`) VALUES
('c228063b9959581b97e50ed479dae9e30feb4c7e7b', '2021-09-10', 'Globe Cinema RoundAbout', '564ce0f989f46544b27180968cb87144873383c3fa', 'a3324b17cbb489a2f36786f2bed1aa15873d3b6037', 'bcbc5d3dd2e32e5673eb870929c4dd10cfef7b30b4', 'KBA 900F', 'You should not change lanes unnecessarily. Moreover, you should never change lanes in a manner that forces vehicles behind you to suddenly brake or steer in order to avoid hitting you. When changing lanes, always look in the rearview mirror and also look over your shoulder to check behind you. In particular, changing lanes and cutting in front of a vehicle immediately behind you forces the driver to suddenly turn the steering wheel and slam on the brakes, which can cause a major accident. ', '7691c651afaa0329807320aa83d3c98e8b1d7dc90c');

-- --------------------------------------------------------

--
-- Table structure for table `offenses_payments`
--

CREATE TABLE `offenses_payments` (
  `payment_id` varchar(200) NOT NULL,
  `payment_ref` varchar(200) DEFAULT NULL,
  `payment_date` varchar(200) DEFAULT NULL,
  `payment_offence_id` varchar(200) DEFAULT NULL,
  `payment_transaction_no` varchar(200) DEFAULT NULL,
  `payment_amount` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offenses_payments`
--

INSERT INTO `offenses_payments` (`payment_id`, `payment_ref`, `payment_date`, `payment_offence_id`, `payment_transaction_no`, `payment_amount`) VALUES
('651a077fc3a05af94eb776b7fb6f711480b2ed2636', 'OZ04RI6KQ5', '2021-09-03', 'c228063b9959581b97e50ed479dae9e30feb4c7e7b', '9087654435', '2500');

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE `officer` (
  `officer_id` varchar(200) NOT NULL,
  `officer_full_name` varchar(200) DEFAULT NULL,
  `officer_email` varchar(200) DEFAULT NULL,
  `officer_mobile` varchar(200) DEFAULT NULL,
  `officer_staff_no` varchar(200) DEFAULT NULL,
  `officer_login_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `officer`
--

INSERT INTO `officer` (`officer_id`, `officer_full_name`, `officer_email`, `officer_mobile`, `officer_staff_no`, `officer_login_id`) VALUES
('7691c651afaa0329807320aa83d3c98e8b1d7dc90c', 'James Doe', 'jamesdoe@mail.com', '+25489903423', 'STF-90524', 'e696876023bb5eba172b08991b56acb5a098bec603'),
('912a75a7e076a5a8654d89496bfbe9ed3c6c6624db', 'System Admin', 'sysadmin@mail.com', '+254737229776', 'STFF-001', '682bba22b3e100961e5aa1f62828ca3f24124c185e');

-- --------------------------------------------------------

--
-- Table structure for table `traffic_rules`
--

CREATE TABLE `traffic_rules` (
  `rule_id` varchar(200) NOT NULL,
  `rule_name` varchar(200) DEFAULT NULL,
  `rule_desc` longtext DEFAULT NULL,
  `rule_charge` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `traffic_rules`
--

INSERT INTO `traffic_rules` (`rule_id`, `rule_name`, `rule_desc`, `rule_charge`) VALUES
('45e3f0a7b06b5b0cd14113c7918d719a6765d2a085', 'Maintain a safe distance from the vehicle in front of you!', 'When driving a vehicle with new tires on a dry road surface, you need to allow a vehicle-to-vehicle distance of about 100 m at 100 km/h and 80 m at 80 km/h.\r\nMoreover, when driving a vehicle with worn tires on a road wet from rain, you need to allow about twice this distance.', '3690'),
('564ce0f989f46544b27180968cb87144873383c3fa', 'Do not cut off other vehicles!', 'You should not change lanes unnecessarily. Moreover, you should never change lanes in a manner that forces vehicles behind you to suddenly brake or steer in order to avoid hitting you. When changing lanes, always look in the rearview mirror and also look over your shoulder to check behind you. In particular, changing lanes and cutting in front of a vehicle immediately behind you forces the driver to suddenly turn the steering wheel and slam on the brakes, which can cause a major accident. ', '10000'),
('a8a7ff99b6f4f3b2a5b2f128d4f327b1f26f71508b', 'Always drive at a safe speed and within the speed limit!', 'A roadway’s maximum speed is the speed limit indicated for that particular roadway. All drivers must travel within the speed limit and in accordance with road and traffic conditions. In other words, each driver is responsible for driving at a safe speed that does not pose a danger on the roadway, and should never take it for granted that it is safe to travel at the speed limit.', '2500'),
('bd3243e9344e211b15f28bc5bad3a7708d7a22c9dd', 'Do not stop or park on the expressway!', 'Stopping or parking a vehicle on an expressway is illegal under the Road Traffic Act. Stopping on the shoulder or side strip is extremely dangerous because it poses a risk of rear-end collisions with approaching vehicles. Moreover, parking on the shoulder in front of toll gates, payment plazas, and elsewhere in order to wait for the ETC time period discount is not only subject to a fine under the Road Traffic Act, it is dangerous to other drivers. For breaks, please use the nearest service or parking area.', '4590'),
('bee50c9832bd66d93cd38cf93d2de64a46b2c695a1', 'National Expressway main lane vehicular speed limit', 'National Expressway main lane vehicular speed limit', '3500');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `vehicle_type_id` varchar(200) NOT NULL,
  `vehicle_type_name` varchar(200) DEFAULT NULL,
  `vehicle_type_desc` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`vehicle_type_id`, `vehicle_type_name`, `vehicle_type_desc`) VALUES
('bcbc5d3dd2e32e5673eb870929c4dd10cfef7b30b4', 'Sport Utility Vehicle', 'SUVs—often also referred to as crossovers—tend to be taller and boxier than sedans, offer an elevated seating position, and have more ground clearance than a car. They include a station wagon-like cargo area that is accessed through a flip-up rear hatch door, and many offer all-wheel drive. The larger ones have three rows of seats. Sizes start at subcompact (Hyundai Kona, Nissan Kicks), mid-size, and go all the way to full-size (Ford Expedition, Chevrolet Tahoe). Luxury brands offer many SUV models in most of the same size categories. '),
('e68e805669bf531570552fa37a8dfb963e72303da9', 'Sedan', 'A sedan has four doors and a traditional trunk. Like vehicles in many categories, they\'re available in a range of sizes from small (subcompact vehicles like Nissan Versa and Kia Rio) to compacts (Honda Civic, Toyota Corolla) to mid-size (Honda Accord, Nissan Altima), and full-size (Toyota Avalon, Dodge Charger). Luxury brands like Mercedes-Benz and Lexus have sedans in similar sizes as well. '),
('ed4ebecfe1bb5e2d5d0b8173198c962f3fe3e160ab', 'Sports Car', 'These are the sportiest, hottest, coolest-looking coupes and convertibles—low to the ground, sleek, and often expensive. They generally are two-seaters, but sometimes have small rear seats as well. Cars like the Porsche 911 and Mazda Miata are typical sports cars, but you can stretch the definition to include muscle cars like the Ford Mustang and Dodge Challenger. Then there are the high-end exotic dream cars with sky-high price tags for the one percent, cars like the Ferrari 488 GTB and Aston Martin Vantage, which stop traffic with their spaceship looks. '),
('f78e49ce30a83b6f76838b40abe4eab3d08ca59bae', 'Coupe', 'A coupe has historically been considered a two-door car with a trunk and a solid roof. This would include cars like a Ford Mustang or Audi A5—or even two-seat sports cars like the Chevrolet Corvette and Porsche Boxster. Recently, however, car companies have started to apply the word \"coupe\" to four-door cars or crossovers with low, sleek rooflines that they deem \"coupe-like.\" This includes vehicles as disparate as a Mercedes-Benz CLS sedan and BMW X6 SUV. At Car and Driver, we still consider a coupe to be a two-door car.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `motorist`
--
ALTER TABLE `motorist`
  ADD PRIMARY KEY (`motorist_id`),
  ADD KEY `Login` (`motorist_login_id`);

--
-- Indexes for table `offences`
--
ALTER TABLE `offences`
  ADD PRIMARY KEY (`offence_id`),
  ADD KEY `Motorist` (`offence_motorist_id`),
  ADD KEY `Officer` (`offence_officer_id`),
  ADD KEY `Traffic Rule` (`offence_rule_id`),
  ADD KEY `offence_vehicle_type` (`offence_vehicle_type`);

--
-- Indexes for table `offenses_payments`
--
ALTER TABLE `offenses_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `Offence_ID` (`payment_offence_id`);

--
-- Indexes for table `officer`
--
ALTER TABLE `officer`
  ADD PRIMARY KEY (`officer_id`),
  ADD KEY `officer_login_id` (`officer_login_id`);

--
-- Indexes for table `traffic_rules`
--
ALTER TABLE `traffic_rules`
  ADD PRIMARY KEY (`rule_id`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`vehicle_type_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offences`
--
ALTER TABLE `offences`
  ADD CONSTRAINT `Motorist` FOREIGN KEY (`offence_motorist_id`) REFERENCES `motorist` (`motorist_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Officer` FOREIGN KEY (`offence_officer_id`) REFERENCES `officer` (`officer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Traffic Rule` FOREIGN KEY (`offence_rule_id`) REFERENCES `traffic_rules` (`rule_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offenses_payments`
--
ALTER TABLE `offenses_payments`
  ADD CONSTRAINT `Offence_ID` FOREIGN KEY (`payment_offence_id`) REFERENCES `offences` (`offence_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
