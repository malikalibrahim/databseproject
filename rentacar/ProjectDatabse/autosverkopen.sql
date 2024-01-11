-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 11 jan 2024 om 01:24
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autosverkopen`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accounts`
--

CREATE TABLE `accounts` (
  `AccountID` int(11) NOT NULL,
  `Gebruikersnaam` varchar(50) NOT NULL,
  `Wachtwoord` varchar(255) NOT NULL,
  `KlantID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `accounts`
--

INSERT INTO `accounts` (`AccountID`, `Gebruikersnaam`, `Wachtwoord`, `KlantID`) VALUES
(1, 'gebruiker1', 'wachtwoord1', 1),
(2, 'gebruiker2', 'wachtwoord2', 2),
(3, 'gebruiker3', 'wachtwoord3', 3),
(4, 'gebruiker4', 'wachtwoord4', 4),
(5, 'gebruiker5', 'wachtwoord5', 5),
(6, 'gebruiker6', 'wachtwoord6', 6),
(7, 'gebruiker7', 'wachtwoord7', 7),
(8, 'gebruiker8', 'wachtwoord8', 8),
(9, 'gebruiker9', 'wachtwoord9', 9),
(10, 'gebruiker10', 'wachtwoord10', 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `autos`
--

CREATE TABLE `autos` (
  `AutoID` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `Merk` varchar(255) NOT NULL,
  `Model` varchar(255) NOT NULL,
  `Jaar` int(11) NOT NULL,
  `Kenteken` varchar(15) NOT NULL,
  `Beschikbaarheid` tinyint(1) NOT NULL,
  `Prijs` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `autos`
--

INSERT INTO `autos` (`AutoID`, `image`, `Merk`, `Model`, `Jaar`, `Kenteken`, `Beschikbaarheid`, `Prijs`) VALUES
(1, 'Toyota.png', 'Toyota', 'Camry', 2022, 'ABC12301', 0, 50.00),
(2, 'Honda.png', 'Honda', 'Civic', 2021, 'XYZ78902', 0, 34.65),
(3, 'Ford.png', 'Ford', 'Focus', 2023, 'DEF45603', 0, 40.00),
(4, 'Chevrolet.png', 'Chevrolet', 'Malibu', 2022, 'GHI78904', 0, 50.30),
(5, 'Nissan.png', 'Nissan', 'Altima', 2021, 'JKL12305', 0, 25.75),
(6, 'Hyundai.png', 'Hyundai', 'Elantra', 2023, 'MNO98706', 0, 39.99),
(7, 'Kia.png', 'Kia', 'Optima', 2022, 'PQR45607', 0, 69.55),
(8, 'Mazda.png', 'Mazda', 'Mazda', 2021, 'STU78908', 0, 36.96),
(9, 'Volkswagen.png', 'Volkswagen', 'Jetta', 2023, 'VWX12309', 0, 46.84);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `facturen`
--

CREATE TABLE `facturen` (
  `FactuurID` int(11) NOT NULL,
  `KlantID` int(11) DEFAULT NULL,
  `AutoID` int(11) DEFAULT NULL,
  `Verhuurdatum` date DEFAULT NULL,
  `EindVerhuurdatum` date DEFAULT NULL,
  `TotaalBedrag` decimal(10,2) DEFAULT NULL,
  `FactuurDatum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `facturen`
--

INSERT INTO `facturen` (`FactuurID`, `KlantID`, `AutoID`, `Verhuurdatum`, `EindVerhuurdatum`, `TotaalBedrag`, `FactuurDatum`) VALUES
(1, 9, 2, '2023-12-01', '2023-12-08', 242.55, '2023-12-12 22:18:14'),
(30, 3, 9, '2023-12-15', '2023-12-17', 93.68, '2023-12-15 10:36:25'),
(33, 3, 5, '2023-12-16', '2023-08-12', 93.68, '2023-12-17 17:50:39'),
(34, 3, 9, '2023-12-18', '2023-12-19', 46.84, '2023-12-18 10:53:09'),
(35, 3, 1, '2023-12-25', '2023-12-30', 250.00, '2023-12-18 11:20:52'),
(36, 3, 2, '2023-12-18', '2023-12-27', 311.85, '2023-12-18 11:22:27'),
(37, 3, 6, '2023-12-18', '2023-12-21', 119.97, '2023-12-18 11:30:30'),
(38, 3, 3, '2023-12-18', '2023-12-19', 40.00, '2023-12-18 11:32:28'),
(39, 3, 9, '2023-12-18', '2023-12-28', 468.40, '2023-12-18 15:07:56');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `KlantID` int(11) NOT NULL,
  `Naam` varchar(255) NOT NULL,
  `Adres` varchar(255) NOT NULL,
  `rol` varchar(40) DEFAULT '0',
  `Rijbewijsnummer` varchar(20) NOT NULL,
  `Telefoonnummer` varchar(15) NOT NULL,
  `Emailadres` varchar(255) NOT NULL,
  `Wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`KlantID`, `Naam`, `Adres`, `rol`, `Rijbewijsnummer`, `Telefoonnummer`, `Emailadres`, `Wachtwoord`) VALUES
(1, 'John Doe', '123 Main St', 'Admin', 'ABC1234501', '555-123401', 'john.doe1@example.com', 'wachtwoord1'),
(2, 'Jane Smith', '456 Oak St', 'medewerker', 'XYZ9876502', '555-567802', 'jane.smith2@example.com', 'wachtwoord2'),
(3, 'Alice Johnsonn', '789 Maple St', '0', 'DEF4567803', '555-901203', 'alice.johnson3@example.com', '$2y$10$1wQGhfakURA8AZ8Wk4sVb.vO25LQ8cPd4SbENl6BQJm9aePHii6Ua'),
(4, 'Bob Miller', '101 Pine St', '0', 'GHI7890104', '555-345604', 'bob.miller4@example.com', 'wachtwoord4'),
(5, 'Emma Davis', '202 Cedar St', '0', 'JKL1234505', '555-678905', 'emma.davis5@example.com', 'wachtwoord5'),
(6, 'David Brown', '303 Elm St', '0', 'MNO9876506', '555-123407', 'david.brown6@example.com', '$2y$10$jhxrGFstcE4bv.AMa78wFuRGY4UJ6Q1KVfhHxJQ6wr.wBwLzXbARG'),
(7, 'Olivia White', '404 Birch St', '0', 'PQR4567807', '555-345688', 'olivia.white7@example.com', '$2y$10$QhNONjWtKY.k9qRsn5KaQuofLTxNJ5O2gQkZROFXn8z9KiBfgp5v.'),
(8, 'James Lee', '505 Walnut St', '0', 'STU7890108', '555-678908', 'james.lee8@example.com', 'wachtwoord8'),
(9, 'Sophia Wilson', '606 Oak St', '0', 'VWX1234509', '555-901209', 'sophia.wilson9@example.com', 'wachtwoord9'),
(10, 'William Taylor', '707 Pine St', '0', 'YZA9876510', '555-3456010', 'william.taylor10@example.com', 'wachtwoord10'),
(20, 'mashal', 'frf', '0', '03233', '232323', 'l3nt.7rb@gmail.com', '$2y$10$KVcJMH.1uENuAI7N0P0I9OK1UO2ZsMbXATers8yqQdHiNdzGj8Q/.'),
(22, 'mashal', 'amsterdam', '0', 'abcc123', '566464', 't4erdfffdgd@gmail.com', '$2y$10$KxSXRK7egBvVWNWWeUSAjOS7Ordep5Zt3AzjTRjrm4qfQYye7rHyG'),
(23, 'Ensar', 'Sumatrastraat 34', '0', 'MSHAL12', '0612345678', 'ensar@gmail.com', '$2y$10$n2qLwkVKLQeBWWIlXilLJey.Q1ndTYCJOdmA/PPGmEr.cW.38OoFm'),
(24, 'Ensar', 'Sumatrastraat 34', '0', 'MSHAL12', '0612345678', 'ensar7042@gmail.com', '$2y$10$RCzmNxlEtFPzNJoliY8NUOuu1vF7eIj8RTOwu5BNHZdkVFCIBQwA6');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verhuringen`
--

CREATE TABLE `verhuringen` (
  `VerhuurID` int(11) NOT NULL,
  `Verhuurdatum` date NOT NULL,
  `endVerhuurdatum` date NOT NULL,
  `KlantID` int(11) NOT NULL,
  `AutoID` int(11) NOT NULL,
  `Kosten` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `verhuringen`
--

INSERT INTO `verhuringen` (`VerhuurID`, `Verhuurdatum`, `endVerhuurdatum`, `KlantID`, `AutoID`, `Kosten`) VALUES
(1, '2023-12-01', '0000-00-00', 1, 1, 70.00);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`AccountID`),
  ADD UNIQUE KEY `Gebruikersnaam` (`Gebruikersnaam`),
  ADD KEY `KlantID` (`KlantID`);

--
-- Indexen voor tabel `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`AutoID`);

--
-- Indexen voor tabel `facturen`
--
ALTER TABLE `facturen`
  ADD PRIMARY KEY (`FactuurID`),
  ADD KEY `KlantID` (`KlantID`),
  ADD KEY `AutoID` (`AutoID`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`KlantID`);

--
-- Indexen voor tabel `verhuringen`
--
ALTER TABLE `verhuringen`
  ADD PRIMARY KEY (`VerhuurID`),
  ADD KEY `KlantID` (`KlantID`),
  ADD KEY `AutoID` (`AutoID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `accounts`
--
ALTER TABLE `accounts`
  MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `autos`
--
ALTER TABLE `autos`
  MODIFY `AutoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `facturen`
--
ALTER TABLE `facturen`
  MODIFY `FactuurID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `KlantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT voor een tabel `verhuringen`
--
ALTER TABLE `verhuringen`
  MODIFY `VerhuurID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`KlantID`) REFERENCES `klanten` (`KlantID`);

--
-- Beperkingen voor tabel `facturen`
--
ALTER TABLE `facturen`
  ADD CONSTRAINT `facturen_ibfk_1` FOREIGN KEY (`KlantID`) REFERENCES `klanten` (`KlantID`),
  ADD CONSTRAINT `facturen_ibfk_2` FOREIGN KEY (`AutoID`) REFERENCES `autos` (`AutoID`);

--
-- Beperkingen voor tabel `verhuringen`
--
ALTER TABLE `verhuringen`
  ADD CONSTRAINT `verhuringen_ibfk_1` FOREIGN KEY (`KlantID`) REFERENCES `klanten` (`KlantID`),
  ADD CONSTRAINT `verhuringen_ibfk_2` FOREIGN KEY (`AutoID`) REFERENCES `autos` (`AutoID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
