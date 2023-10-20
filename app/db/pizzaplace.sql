-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2023 at 05:53 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzaplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerId` varchar(4) NOT NULL,
  `customerName` varchar(50) NOT NULL,
  `customerInfix` int(50) NOT NULL,
  `customerLastName` int(50) NOT NULL,
  `customerIsActive` int(1) NOT NULL,
  `customerCreateDate` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredientId` varchar(4) NOT NULL,
  `ingredientName` varchar(50) NOT NULL,
  `ingredientIsActive` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredientId`, `ingredientName`, `ingredientIsActive`) VALUES
('1111', 'Chorizo', 1),
('2222', 'pepperoni', 1),
('4444', 'cheese', 1),
('5555', 'mushroom', 1),
('6666', 'Tomato', 1),
('7777', 'mozarella', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderhaspizzas`
--

CREATE TABLE `orderhaspizzas` (
  `orderId` varchar(4) NOT NULL,
  `pizzaId` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` varchar(4) NOT NULL,
  `orderCustomerId` varchar(4) NOT NULL,
  `orderNumber` int(10) NOT NULL,
  `orderIsActive` int(1) NOT NULL,
  `orderCreateDate` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pizzahasingredients`
--

CREATE TABLE `pizzahasingredients` (
  `pizzaId` varchar(4) NOT NULL,
  `ingredientId` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pizzahasingredients`
--

INSERT INTO `pizzahasingredients` (`pizzaId`, `ingredientId`) VALUES
('1234', '2222'),
('3333', '6666'),
('4567', '4444'),
('5555', '4444'),
('6666', '1111'),
('9999', '5555');

-- --------------------------------------------------------

--
-- Table structure for table `pizzas`
--

CREATE TABLE `pizzas` (
  `pizzaId` varchar(4) NOT NULL,
  `pizzaName` varchar(50) NOT NULL,
  `pizzaImage` varchar(255) NOT NULL,
  `pizzaPrice` varchar(5) NOT NULL,
  `pizzaIsActive` varchar(1) NOT NULL,
  `pizzaCreateDate` int(10) NOT NULL,
  `pizzaDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pizzas`
--

INSERT INTO `pizzas` (`pizzaId`, `pizzaName`, `pizzaImage`, `pizzaPrice`, `pizzaIsActive`, `pizzaCreateDate`, `pizzaDescription`) VALUES
('1234', 'pizza pepperoni', '/public/img/pizza.jpg', '$10', '1', 11111, 'pizza met tomatensaus, kaas en heerlijke pepperoni!'),
('3333', 'pizza caprese', '/public/img/pizza-caprese (1).jpg', '$15', '1', 213131, 'pizza with tomato, mozarella and pesto!'),
('4567', 'pizza margharita', '/public/img/pizzamargharita.jpg', '$10', '1', 1111, 'pizza with melted cheese!'),
('5555', 'pizza 4 cheese', '/public/img/pizza4cheese.jpg', '$12', '1', 11111, 'pizza with 4 cheeses. '),
('6473', 'pizza tono', '/public/img/pizzatono.jpg', '$15', '1', 111111, 'pizza with red onion and tuna'),
('6666', 'pizza meatlovers', '/public/img/pizzameatlovers.jpg', '$9', '1', 11111, 'pizza with ham, chorizo and pepperoni'),
('9999', 'pizza mushroom', '/public/img/pizzamushroom.jpg', '$8', '1', 1114214, 'pizza with mushrooms');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredientId`);

--
-- Indexes for table `orderhaspizzas`
--
ALTER TABLE `orderhaspizzas`
  ADD PRIMARY KEY (`orderId`,`pizzaId`),
  ADD KEY `pizzaId` (`pizzaId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `orderCustomerId` (`orderCustomerId`);

--
-- Indexes for table `pizzahasingredients`
--
ALTER TABLE `pizzahasingredients`
  ADD PRIMARY KEY (`pizzaId`,`ingredientId`),
  ADD KEY `ingredientId` (`ingredientId`);

--
-- Indexes for table `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`pizzaId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderhaspizzas`
--
ALTER TABLE `orderhaspizzas`
  ADD CONSTRAINT `orderhaspizzas_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orderhaspizzas_ibfk_2` FOREIGN KEY (`pizzaId`) REFERENCES `pizzas` (`pizzaId`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`orderCustomerId`) REFERENCES `customers` (`customerId`) ON UPDATE CASCADE;

--
-- Constraints for table `pizzahasingredients`
--
ALTER TABLE `pizzahasingredients`
  ADD CONSTRAINT `pizzahasingredients_ibfk_1` FOREIGN KEY (`ingredientId`) REFERENCES `ingredients` (`ingredientId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pizzahasingredients_ibfk_2` FOREIGN KEY (`pizzaId`) REFERENCES `pizzas` (`pizzaId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
