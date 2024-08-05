-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 26 juil. 2024 à 21:56
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `heroku`
--

-- --------------------------------------------------------

--
-- Structure de la table `billing`
--

CREATE TABLE `billing` (
  `BillingID` int(11) NOT NULL,
  `GuestID` int(11) DEFAULT NULL,
  `BookingID` int(11) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `BillingDate` date DEFAULT NULL,
  `PaymentStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `booking`
--

CREATE TABLE `booking` (
  `BookingID` int(11) NOT NULL,
  `GuestID` int(11) DEFAULT NULL,
  `RoomID` int(11) DEFAULT NULL,
  `BookingDate` date DEFAULT NULL,
  `CheckInDate` date DEFAULT NULL,
  `CheckOutDate` date DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `GuestID` int(11) DEFAULT NULL,
  `BookingID` int(11) DEFAULT NULL,
  `FeedbackText` text DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `FeedbackDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `guests`
--

CREATE TABLE `guests` (
  `GuestID` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Nationality` varchar(50) DEFAULT NULL,
  `PassportNumber` varchar(50) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `CHECKINDATE` date DEFAULT NULL,
  `CHECKOUTDATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roomimages`
--

CREATE TABLE `roomimages` (
  `ImageID` int(11) NOT NULL,
  `RoomID` int(11) DEFAULT NULL,
  `ImagePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roomimages`
--

INSERT INTO `roomimages` (`ImageID`, `RoomID`, `ImagePath`) VALUES
(4, 3, 'standard4.jpg'),
(5, 4, 'pexels-pixabay-276551.jpg'),
(6, 5, 'pexels-heyho-6527055.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE `rooms` (
  `RoomID` int(11) NOT NULL,
  `RoomName` varchar(100) DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Capacity` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `NumberBed` int(11) DEFAULT NULL,
  `TypeBed` varchar(50) DEFAULT NULL,
  `Wifi` tinyint(1) DEFAULT 0,
  `TV` tinyint(1) DEFAULT 0,
  `Climatiseur` tinyint(1) DEFAULT 0,
  `FreeDrink` tinyint(1) DEFAULT 0,
  `Image` varchar(255) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Disponibility` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`RoomID`, `RoomName`, `Type`, `Capacity`, `Price`, `Description`, `NumberBed`, `TypeBed`, `Wifi`, `TV`, `Climatiseur`, `FreeDrink`, `Image`, `Quantity`, `Disponibility`) VALUES
(3, 'Jack & Jill', 'Family', 5, 540.00, 'Family comfort room with all services', 3, 'King, Standard', 0, 1, 1, 1, 'standard3.jpg', 4, 1),
(4, 'Space', 'Suite', 4, 270.00, 'Suite comfort for vacation', 2, 'Queen', 1, 0, 1, 1, 'pexels-muhammad-tanvir-713696178-18285938.jpg', 4, 1),
(5, 'Luxinary', 'Suite', 4, 280.00, 'Big room for vacation', 2, 'King', 1, 1, 1, 1, 'deluxe.jpg', 4, 0);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `ServiceID` int(11) NOT NULL,
  `ServiceName` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`ServiceID`, `ServiceName`, `Description`, `Price`) VALUES
(1, 'Picine', 'Pool 3m', 10.00),
(2, 'Breakfast', 'Enjoy your breakfast to start your day right', 12.00);

-- --------------------------------------------------------

--
-- Structure de la table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Position` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `staff`
--

INSERT INTO `staff` (`StaffID`, `FullName`, `Email`, `Password`, `Phone`, `Position`) VALUES
(1, 'Michel Angelo', 'Michel@email.com', 'cookre', '0987654', 'Cooker');

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

CREATE TABLE `transactions` (
  `TransactionID` int(11) NOT NULL,
  `BillingID` int(11) DEFAULT NULL,
  `TransactionDate` date DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `PaymentMethod` varchar(50) DEFAULT NULL,
  `TransactionStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`BillingID`),
  ADD KEY `GuestID` (`GuestID`),
  ADD KEY `BookingID` (`BookingID`);

--
-- Index pour la table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `GuestID` (`GuestID`),
  ADD KEY `RoomID` (`RoomID`);

--
-- Index pour la table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `GuestID` (`GuestID`),
  ADD KEY `BookingID` (`BookingID`);

--
-- Index pour la table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`GuestID`);

--
-- Index pour la table `roomimages`
--
ALTER TABLE `roomimages`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `RoomID` (`RoomID`);

--
-- Index pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`RoomID`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Index pour la table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Index pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `BillingID` (`BillingID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `billing`
--
ALTER TABLE `billing`
  MODIFY `BillingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `booking`
--
ALTER TABLE `booking`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `guests`
--
ALTER TABLE `guests`
  MODIFY `GuestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `roomimages`
--
ALTER TABLE `roomimages`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `billing_ibfk_1` FOREIGN KEY (`GuestID`) REFERENCES `guests` (`GuestID`),
  ADD CONSTRAINT `billing_ibfk_2` FOREIGN KEY (`BookingID`) REFERENCES `booking` (`BookingID`);

--
-- Contraintes pour la table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`GuestID`) REFERENCES `guests` (`GuestID`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`);

--
-- Contraintes pour la table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`GuestID`) REFERENCES `guests` (`GuestID`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`BookingID`) REFERENCES `booking` (`BookingID`);

--
-- Contraintes pour la table `roomimages`
--
ALTER TABLE `roomimages`
  ADD CONSTRAINT `roomimages_ibfk_1` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`);

--
-- Contraintes pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`BillingID`) REFERENCES `billing` (`BillingID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
