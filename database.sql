-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 06:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` int(8) NOT NULL,
  `FIRST_NAME` varchar(100) NOT NULL,
  `LAST_NAME` varchar(100) NOT NULL,
  `LOGIN_USERNAME` varchar(100) NOT NULL,
  `LOGIN_PASSWORD` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `FIRST_NAME`, `LAST_NAME`, `LOGIN_USERNAME`, `LOGIN_PASSWORD`) VALUES
(1, 'John', 'Doe', 'admin1', 'abcde123'),
(2, 'Peter', 'Jane', 'admin2', 'abcde123'),
(3, 'Wei', 'Lim', 'admin3', 'abcde123'),
(4, 'John', 'Johnson', 'admin4', 'abcde123'),
(5, 'Doe', 'Doe', 'admin5', 'abcde123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `RESERVATION_ID` int(8) NOT NULL,
  `CAR_ID` int(8) UNSIGNED NOT NULL,
  `PICKUP_DATE` date NOT NULL,
  `DROPOFF_DATE` date NOT NULL,
  `CUSTOMER_ID` int(8) NOT NULL,
  `CUSTOMER_HP` varchar(50) NOT NULL,
  `ORDER_TOTAL` int(8) NOT NULL,
  `ADMIN_ID` int(8) NOT NULL,
  `BOOKING_DATE` date NOT NULL,
  `STATUS` varchar(55) NOT NULL DEFAULT 'Confirmed',
  `LAST_EDITED` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`RESERVATION_ID`, `CAR_ID`, `PICKUP_DATE`, `DROPOFF_DATE`, `CUSTOMER_ID`, `CUSTOMER_HP`, `ORDER_TOTAL`, `ADMIN_ID`, `BOOKING_DATE`, `STATUS`, `LAST_EDITED`) VALUES
(10001, 3, '2023-04-15', '2023-04-17', 1005, '0123224872', 9600, 1, '2023-04-15', 'Confirmed', '2023-04-15 00:00:00'),
(10002, 1, '2023-04-16', '2023-04-18', 1006, '0112223333', 19600, 1, '2023-04-15', 'Cancelled', '2023-04-15 00:00:00'),
(10003, 3, '2023-04-17', '2023-04-18', 1007, '0102028888', 4800, 2, '2023-04-15', 'Confirmed', '2023-04-17 00:12:42'),
(10004, 3, '2023-04-18', '2023-04-19', 1008, '0112233444', 4800, 1, '2023-04-15', 'Confirmed', '2023-04-17 13:08:07'),
(10006, 5, '2023-04-27', '2023-04-28', 1006, '0112223333', 1350, 4, '2023-04-15', 'Confirmed', '2023-04-17 14:56:25'),
(10007, 8, '2023-04-18', '2023-04-20', 1010, '0144442222', 5600, 1, '2023-04-17', 'Confirmed', '2023-04-17 14:47:23'),
(10008, 5, '2023-04-27', '2023-04-29', 1010, '0144442222', 2700, 4, '2023-04-17', 'Cancelled', '2023-04-17 14:52:16'),
(10009, 5, '2023-04-29', '2023-05-02', 1006, '0112223333', 4050, 4, '2023-04-17', 'Confirmed', '2023-04-17 14:57:26'),
(10010, 6, '2023-04-26', '2023-04-28', 1011, '0102228765', 12000, 5, '2023-04-20', 'Confirmed', '2023-04-20 18:40:37'),
(10011, 4, '2023-04-24', '2023-04-26', 1012, '0134567111', 2700, 5, '2023-04-20', 'Confirmed', '2023-04-20 18:49:44'),
(10012, 7, '2023-04-22', '2023-04-23', 1013, '0193331234', 7000, 5, '2023-04-20', 'Confirmed', '2023-04-20 19:01:41'),
(10013, 8, '2023-04-28', '2023-04-29', 1014, '0123451122', 2800, 5, '2023-04-20', 'Confirmed', '2023-04-20 19:16:26'),
(10014, 6, '2023-05-04', '2023-05-05', 1015, '0129894344', 6000, 5, '2023-04-20', 'Confirmed', '2023-04-20 19:30:17'),
(10015, 5, '2023-05-03', '2023-05-04', 1016, '0138786562', 1350, 5, '2023-04-20', 'Confirmed', '2023-04-20 19:39:40'),
(10016, 7, '2023-04-25', '2023-04-27', 1017, '960219113452', 14000, 3, '2023-04-20', 'Confirmed', '2023-04-20 19:44:05'),
(10017, 8, '2023-04-25', '2023-04-28', 1018, '0138979955', 8400, 3, '2023-04-20', 'Confirmed', '2023-04-20 19:47:04'),
(10018, 1, '2023-04-21', '2023-04-22', 1019, '0118878235', 9800, 3, '2023-04-20', 'Confirmed', '2023-04-20 20:06:33'),
(10019, 8, '2023-05-02', '2023-05-03', 1020, '0125678822', 2800, 4, '2023-04-20', 'Confirmed', '2023-04-21 13:20:00'),
(10020, 1, '2023-04-25', '2023-04-26', 1013, '0193331234', 9800, 3, '2023-04-20', 'Confirmed', '2023-04-20 20:24:11'),
(10021, 4, '2023-05-01', '2023-05-03', 1021, '0192239876', 2700, 4, '2023-04-20', 'Cancelled', '2023-04-21 13:17:53'),
(10022, 4, '2023-04-21', '2023-04-22', 1006, '0112223333', 1350, 3, '2023-04-20', 'Confirmed', '2023-04-20 20:59:15'),
(10023, 8, '2023-04-29', '2023-04-30', 1010, '0144442222', 2800, 2, '2023-04-20', 'Confirmed', '2023-04-20 22:42:41'),
(10024, 6, '2023-04-21', '2023-04-22', 1014, '0123451122', 6000, 2, '2023-04-20', 'Confirmed', '2023-04-20 23:07:33'),
(10025, 8, '2023-04-24', '2023-04-25', 1016, '0138786562', 2800, 4, '2023-04-20', 'Cancelled', '2023-04-21 13:20:49'),
(10026, 5, '2023-04-25', '2023-04-26', 1005, '0123224872', 1350, 2, '2023-04-20', 'Confirmed', '2023-04-20 23:16:32'),
(10027, 1, '2023-04-27', '2023-04-28', 1005, '0123224872', 9800, 2, '2023-04-20', 'Confirmed', '2023-04-20 23:43:50'),
(10028, 6, '2023-04-30', '2023-05-01', 1019, '0118878235', 6000, 2, '2023-04-20', 'Confirmed', '2023-04-20 23:46:02'),
(10029, 6, '2023-05-01', '2023-05-02', 1014, '0123451122', 6000, 4, '2023-04-20', 'Cancelled', '2023-04-21 13:18:53'),
(10030, 1, '2023-04-26', '2023-04-27', 1007, '0102028888', 9800, 2, '2023-04-21', 'Confirmed', '2023-04-21 00:04:27'),
(10031, 6, '2023-05-23', '2023-05-26', 1011, '0102228765', 18000, 2, '2023-04-21', 'Confirmed', '2023-04-24 18:12:27'),
(10032, 1, '2023-05-05', '2023-05-06', 1006, '0112223333', 9800, 4, '2023-04-21', 'Confirmed', '2023-04-21 13:05:24'),
(10033, 1, '2023-05-29', '2023-05-31', 1022, '0122343322', 19600, 2, '2023-04-24', 'Confirmed', '2023-04-24 18:13:21'),
(10034, 3, '2023-05-04', '2023-05-05', 1018, '0138979955', 4800, 2, '2023-04-24', 'Confirmed', '2023-04-24 18:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `CAR_ID` int(8) UNSIGNED NOT NULL,
  `CAR_NAME` varchar(80) NOT NULL,
  `REGISTRATION_NUM` varchar(25) NOT NULL,
  `CAR_TYPE` varchar(50) NOT NULL,
  `SEAT_CAPACITY` int(5) NOT NULL,
  `PRICE` int(8) NOT NULL,
  `STATUS` varchar(55) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CAR_ID`, `CAR_NAME`, `REGISTRATION_NUM`, `CAR_TYPE`, `SEAT_CAPACITY`, `PRICE`, `STATUS`) VALUES
(1, 'Rolls Royce Phantom (Blue)', 'RR 88', 'Luxurious Car', 5, 9800, 'Active'),
(3, 'Bentley Continental Flying Spur (White)', 'BEN 8', 'Luxurious Car', 5, 4800, 'Active'),
(4, 'Mercedes Benz CLS 350 (Silver)', 'CLS 350', 'Luxurious Car', 4, 1350, 'Active'),
(5, 'Jaguar S Type (Champagne)', 'JGR 3', 'Luxurious Car', 5, 1350, 'Active'),
(6, 'Ferrari F430 Scuderia (Red)', 'FF 430', 'Sports Car', 2, 6000, 'Active'),
(7, 'Lamborghini Murcielago LP640 (Matte Black)', 'LP 640', 'Sports Car', 2, 7000, 'Active'),
(8, 'Porsche Boxster (White) ', 'PB 13', 'Sports Car', 2, 2800, 'Active'),
(9, 'Lexus SC430 (Black)', 'SC 430', 'Sports Car', 4, 1600, 'Active'),
(10, 'Jaguar MK 2 (White)', 'MK 2', 'Classics Car', 5, 2200, 'Active'),
(11, 'Rolls Royce Silver Spirit Limousine (Georgian Silver)', 'RR 8', 'Classics Car', 5, 3200, 'Active'),
(12, 'MG TD (Red)', 'MGTD 9', 'Classics Car', 2, 2500, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CUSTOMER_ID` int(8) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `ID_NUM` varchar(50) NOT NULL,
  `CONTACT_NUM` varchar(50) NOT NULL,
  `ADMIN_ID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CUSTOMER_ID`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `ID_NUM`, `CONTACT_NUM`, `ADMIN_ID`) VALUES
(1005, 'Kim', 'Noe', 'km@email.com', '12345567', '0123224872', 1),
(1006, 'James', 'Bond', 'jb@gmail.com', '123123123', '0112223333', 1),
(1007, 'Jeff', 'T', 'jt@email.com', '321432543', '0102028888', 2),
(1008, 'Lil', 'Nas', 'ln@hotmail.my', '123456123', '0112233444', 2),
(1010, 'Stephen', 'James', 'james@email.com', '2345612345', '0144442222', 1),
(1011, 'Tony', 'Chris', 'chris@gmail.com', '635241987', '0102228765', 5),
(1012, 'Joe', 'Chris', 'joechris@gmail.com', '1234565656', '0134567111', 5),
(1013, 'Joe', 'Ying', 'jy@outlook.com', '021123453211', '0193331234', 5),
(1014, 'Chris', 'Loki', 'loki@email.com', '234510105455', '0123451122', 5),
(1015, 'Pento', 'Muro', 'pento@hotmail.my', '001122145677', '0129894344', 5),
(1016, 'Jannet', 'Yellen', 'jannet@gmail.com', '881029035116', '0138786562', 5),
(1017, 'Ivanka', 'Trump', 'it@email.com', '0112234567', '960219113452', 3),
(1018, 'Chris', 'Gensler', 'gensler@imf.com', '780123054321', '0138979955', 3),
(1019, 'Gary', 'Joe', 'garyjoe@gmail.com', '121130014354', '0118878235', 3),
(1020, 'Gary', 'Lim', 'garylim@email.com', '101213045687', '0125678822', 3),
(1021, 'King', 'Jho', 'kingjho@hotmail.my', '650227051044', '0192239876', 3),
(1022, 'Mia', 'Linda', 'mia@email.com', '950317035123', '0122343322', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`),
  ADD UNIQUE KEY `LOGIN_USERNAME` (`LOGIN_USERNAME`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`RESERVATION_ID`),
  ADD KEY `CUSTOMER_ID` (`CUSTOMER_ID`),
  ADD KEY `ADMIN_ID` (`ADMIN_ID`),
  ADD KEY `CAR_ID` (`CAR_ID`),
  ADD KEY `CUSTOMER_HP` (`CUSTOMER_HP`) USING BTREE;

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CAR_ID`),
  ADD UNIQUE KEY `REGISTRATION_NUM` (`REGISTRATION_NUM`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CUSTOMER_ID`),
  ADD UNIQUE KEY `PHONE_NUM` (`CONTACT_NUM`),
  ADD UNIQUE KEY `LICENSE_NUM` (`ID_NUM`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD KEY `ADMIN_ID` (`ADMIN_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ADMIN_ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `RESERVATION_ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10035;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `CAR_ID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CUSTOMER_ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1023;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`CUSTOMER_ID`) REFERENCES `customers` (`CUSTOMER_ID`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`ADMIN_ID`) REFERENCES `admin` (`ADMIN_ID`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`CAR_ID`) REFERENCES `cars` (`CAR_ID`),
  ADD CONSTRAINT `bookings_ibfk_4` FOREIGN KEY (`CUSTOMER_HP`) REFERENCES `customers` (`CONTACT_NUM`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`ADMIN_ID`) REFERENCES `admin` (`ADMIN_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
