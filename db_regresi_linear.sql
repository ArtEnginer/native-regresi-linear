-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 11:05 AM
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
-- Database: `db_regresi_linear`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertRandomYearsData` ()   BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE random_date DATE;

    WHILE i <= 100 DO
        SET random_date = DATE_ADD('2020-01-01', INTERVAL FLOOR(RAND() * 1826) DAY); -- 1826 days to cover leap years
        INSERT INTO `dataset` (`id`, `x`, `y`)
        VALUES (i, random_date, FLOOR(RAND() * 1000));
        SET i = i + 1;
    END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dataset`
--

CREATE TABLE `dataset` (
  `id` int(11) NOT NULL,
  `x` varchar(255) NOT NULL,
  `y` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dataset`
--

INSERT INTO `dataset` (`id`, `x`, `y`) VALUES
(1, '2023-03-25', '640'),
(2, '2021-05-02', '412'),
(3, '2021-04-20', '65'),
(4, '2022-09-20', '524'),
(5, '2024-12-12', '376'),
(6, '2024-07-27', '441'),
(7, '2022-04-29', '0'),
(8, '2023-01-15', '37'),
(9, '2021-10-26', '707'),
(10, '2022-03-20', '95'),
(11, '2020-09-24', '446'),
(12, '2023-12-18', '623'),
(13, '2023-09-11', '824'),
(14, '2024-07-13', '58'),
(15, '2022-11-13', '691'),
(16, '2023-09-09', '615'),
(17, '2024-04-26', '471'),
(18, '2023-11-04', '426'),
(19, '2024-02-16', '848'),
(20, '2023-11-04', '295'),
(21, '2020-11-08', '970'),
(22, '2021-09-06', '772'),
(23, '2024-04-08', '952'),
(24, '2021-01-02', '148'),
(25, '2020-09-06', '238'),
(26, '2023-11-30', '198'),
(27, '2023-03-19', '618'),
(28, '2020-10-26', '965'),
(29, '2021-09-04', '780'),
(30, '2024-06-24', '139'),
(31, '2020-01-13', '617'),
(32, '2020-05-04', '486'),
(33, '2021-02-19', '679'),
(34, '2023-07-24', '524'),
(35, '2022-06-09', '862'),
(36, '2024-04-04', '670'),
(37, '2023-12-27', '975'),
(38, '2022-06-03', '495'),
(39, '2020-02-13', '633'),
(40, '2020-06-22', '575'),
(41, '2022-12-15', '231'),
(42, '2021-11-28', '215'),
(43, '2024-08-31', '19'),
(44, '2021-06-26', '426'),
(45, '2021-03-15', '925'),
(46, '2024-07-12', '752'),
(47, '2020-03-25', '973'),
(48, '2023-08-19', '713'),
(49, '2021-12-11', '803'),
(50, '2024-04-02', '843'),
(51, '2023-04-26', '787'),
(52, '2024-09-28', '379'),
(53, '2020-04-08', '129'),
(54, '2022-06-03', '34'),
(55, '2023-08-07', '495'),
(56, '2021-08-02', '99'),
(57, '2022-09-26', '438'),
(58, '2022-09-27', '425'),
(59, '2022-05-30', '136'),
(60, '2021-03-04', '764'),
(61, '2020-08-05', '301'),
(62, '2020-10-04', '854'),
(63, '2024-01-28', '513'),
(64, '2020-08-07', '62'),
(65, '2024-10-01', '564'),
(66, '2024-11-09', '165'),
(67, '2024-07-25', '68'),
(68, '2023-01-06', '810'),
(69, '2021-03-23', '791'),
(70, '2021-02-10', '738'),
(71, '2020-02-16', '911'),
(72, '2022-05-29', '673'),
(73, '2024-08-14', '599'),
(74, '2021-02-11', '317'),
(75, '2024-08-07', '649'),
(76, '2022-06-01', '470'),
(77, '2024-07-01', '90'),
(78, '2023-10-03', '484'),
(79, '2020-11-06', '396'),
(80, '2022-05-15', '179'),
(81, '2022-05-19', '842'),
(82, '2023-11-30', '386'),
(83, '2022-12-01', '757'),
(84, '2020-03-12', '922'),
(85, '2022-06-20', '702'),
(86, '2020-02-25', '44'),
(87, '2020-08-27', '521'),
(88, '2021-01-28', '511'),
(89, '2024-07-21', '21'),
(90, '2021-11-10', '797'),
(91, '2024-05-06', '956'),
(92, '2020-11-14', '2'),
(93, '2022-06-14', '444'),
(94, '2023-09-30', '415'),
(95, '2024-02-23', '900'),
(96, '2020-01-25', '366'),
(97, '2023-12-18', '862'),
(98, '2024-09-02', '84'),
(99, '2023-02-05', '845'),
(100, '2021-11-06', '311');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `role`) VALUES
(1, 'anggaegae', 'anggaegae', 'anggaegae@gmail.com', '123', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataset`
--
ALTER TABLE `dataset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataset`
--
ALTER TABLE `dataset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
