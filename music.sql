-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2024 at 04:07 PM
-- Server version: 10.5.24-MariaDB-cll-lve-log
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prozhebe_step`
--

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `id` int(11) NOT NULL,
  `fileid` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `filesize` int(20) NOT NULL,
  `duration` int(20) NOT NULL,
  `performer` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `caption` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `date` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`id`, `fileid`, `title`, `filesize`, `duration`, `performer`, `caption`, `date`) VALUES
(1, 'CQACAgQAAx0CeISy6wADaWZS7yLtFYPSTqS6PlHw136JQIx7AAKzFAAChUaZUo5W1B5cjVnnNQQ', 'Bot Parast ', 7420783, 308, 'Moein ', 'معین - بت پرست', 1716711203),
(2, 'CQACAgQAAx0CeISy6wADamZS8mIH-6dmYNO5yAc9CvcXUzHoAAK1FAAChUaZUmFy_b7kypcQNQQ', 'Gol Niloofar [Msbmusic.IR] ', 8355490, 204, 'Ali Lohrasbi', 'علی لهراسبی', 1716712035),
(3, 'CQACAgQAAx0CeISy6wADa2ZS-kbgdmAiTdYFrlz2IZaN2iGvAAK8FAAChUaZUoxhCMPu7wGYNQQ', 'Khoda [ahangstan.com]', 6999218, 172, 'Amir Radan [ahangstan.com]', '', 1716714054),
(4, 'CQACAgQAAx0CeISy6wADbGZTIOuJ0zsC21yTrHxW_PHW4nCpAALjFAAChUaZUpnZgkCUi2B6NQQ', '', 8179042, 340, '', 'معین', 1716723947),
(5, 'CQACAgQAAx0CeISy6wADbWZTJoPG_Z_9z72MdT8KVgnv9RUlAALqFAAChUaZUoLnZbOkQkHtNQQ', 'Tannaz ', 6440251, 267, 'Moein ', 'معین تن ناز', 1716725380),
(6, 'CQACAgQAAx0CeISy6wADcGZTKw0X5EbU_YH6hUoEzUt65-TyAALtFAAChUaZUvaolWKvftdONQQ', 'Ahang Jadid ~ MokhtalefMusic.com', 9149817, 227, '(Mokhtalef Music)', 'یاس', 1716726541),
(7, 'CQACAgQAAx0CeISy6wADcWZTK0EtaIBuK-a42bIyaiJ8yqUnAALvFAAChUaZUv2CnnFD3e7ZNQQ', 'Nabasham', 8101918, 201, 'Sami Beigi  -  پردیس موزیک', 'سامی بیگی - نباشی', 1716726594),
(8, 'CQACAgQAAx0CeISy6wADcmZTK2nXubdZGDLWHpiYia5JMER2AALyFAAChUaZUs5RgPn16W6CNQQ', 'Vasat Mire Delam', 7055837, 174, 'Emad Talebzadeh', 'عماد طالب زاده - واست میره دلم', 1716726634);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
