-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 29 jan 2024 om 13:03
-- Serverversie: 10.3.32-MariaDB
-- PHP-versie: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cheyenne`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `finish_time` time NOT NULL,
  `username` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `appointments`
--

INSERT INTO `appointments` (`id`, `date`, `start_time`, `finish_time`, `username`, `description`) VALUES
(4, '2023-12-01', '09:00:00', '16:00:00', 'Cherry', 'Hour registration, basic wp setup'),
(12, '2023-11-29', '09:00:00', '17:00:00', 'Cherry', 'Hour registration and detailing'),
(13, '2023-11-28', '09:00:00', '17:00:00', 'Cherry', 'Hour registration and portfolio website'),
(14, '2023-11-27', '09:00:00', '17:00:00', 'Cherry', 'Portfolio website'),
(15, '2023-11-20', '09:00:00', '17:00:00', 'Cherry', 'Portfolio website and dashboard'),
(16, '2023-11-21', '09:00:00', '17:00:00', 'Cherry', 'Portfolio website and dashboard'),
(17, '2023-11-22', '09:00:00', '17:00:00', 'Cherry', 'Portfolio website and dashboard'),
(20, '2023-11-24', '09:00:00', '16:00:00', 'Cherry', 'Portfolio website and dashboard'),
(21, '2023-11-13', '09:00:00', '17:00:00', 'Cherry', 'Portfolio website and dashboard'),
(22, '2023-11-14', '09:00:00', '17:00:00', 'Cherry', ''),
(23, '2023-11-15', '09:00:00', '17:00:00', 'Cherry', ''),
(25, '2023-11-17', '09:00:00', '16:00:00', 'Cherry', ''),
(26, '2023-11-06', '09:00:00', '17:00:00', 'Cherry', ''),
(27, '2023-11-07', '09:00:00', '17:00:00', 'Cherry', ''),
(28, '2023-11-08', '09:00:00', '17:00:00', 'Cherry', ''),
(29, '2023-11-10', '09:00:00', '16:00:00', 'Cherry', ''),
(30, '2023-10-30', '09:00:00', '17:00:00', 'Cherry', ''),
(31, '2023-10-31', '09:00:00', '17:00:00', 'Cherry', ''),
(32, '2023-11-01', '09:00:00', '17:00:00', 'Cherry', ''),
(33, '2023-11-03', '09:00:00', '16:00:00', 'Cherry', ''),
(34, '2023-10-23', '09:00:00', '17:00:00', 'Cherry', ''),
(35, '2023-10-24', '09:00:00', '17:00:00', 'Cherry', ''),
(36, '2023-10-25', '09:00:00', '17:00:00', 'Cherry', ''),
(37, '2023-10-27', '09:00:00', '16:00:00', 'Cherry', ''),
(38, '2023-10-16', '09:00:00', '17:00:00', 'Cherry', ''),
(39, '2023-10-17', '09:00:00', '17:00:00', 'Cherry', ''),
(40, '2023-10-18', '09:00:00', '17:00:00', 'Cherry', ''),
(41, '2023-10-20', '09:00:00', '16:00:00', 'Cherry', ''),
(42, '2023-10-09', '09:00:00', '17:00:00', 'Cherry', 'Project one: Kapiteinskoor'),
(43, '2023-10-10', '09:00:00', '17:00:00', 'Cherry', 'Project one: Kapiteinskoor'),
(44, '2023-10-11', '09:00:00', '17:00:00', 'Cherry', 'Project one: Kapiteinskoor'),
(45, '2023-10-13', '09:00:00', '16:00:00', 'Cherry', 'Project one: Kapiteinskoor'),
(46, '2023-10-02', '09:00:00', '17:00:00', 'Cherry', 'Project one: Kapiteinskoor'),
(47, '2023-10-03', '09:00:00', '17:00:00', 'Cherry', 'Project one: Kapiteinskoor'),
(48, '2023-10-04', '09:00:00', '17:00:00', 'Cherry', 'Project one: Kapiteinskoor'),
(49, '2023-10-06', '09:00:00', '16:00:00', 'Cherry', 'Project one: Kapiteinskoor'),
(50, '2023-09-25', '09:00:00', '17:00:00', 'Cherry', 'Hour registration'),
(51, '2023-09-26', '09:00:00', '17:00:00', 'Cherry', 'Hour registration'),
(52, '2023-09-27', '09:00:00', '17:00:00', 'Cherry', 'Hour registration'),
(54, '2023-09-29', '09:00:00', '16:00:00', 'Cherry', 'Introduction wordpress'),
(55, '2023-09-18', '09:00:00', '17:00:00', 'Cherry', 'Start coding hour registration'),
(56, '2023-09-19', '09:00:00', '17:00:00', 'Cherry', 'Hour registration'),
(57, '2023-09-20', '09:00:00', '17:00:00', 'Cherry', 'Hour registration'),
(59, '2023-09-22', '09:00:00', '16:00:00', 'Cherry', 'Hour registration'),
(60, '2023-09-11', '09:00:00', '17:00:00', 'Cherry', 'Design hour registration Photoshop'),
(62, '2023-09-13', '09:00:00', '17:00:00', 'Cherry', 'Design hour registration Photoshop'),
(63, '2023-09-15', '09:00:00', '16:00:00', 'Cherry', 'Design hour registration Photoshop'),
(64, '2023-09-04', '09:00:00', '17:00:00', 'Cherry', 'Introduction photoshop'),
(66, '2023-09-05', '09:00:00', '17:00:00', 'Cherry', 'Introduction photoshop'),
(67, '2023-09-06', '09:00:00', '17:00:00', 'Cherry', 'Introduction photoshop'),
(68, '2023-09-08', '09:00:00', '16:00:00', 'Cherry', 'Introduction photoshop'),
(69, '2023-12-04', '09:00:00', '17:00:00', 'Cherry', 'Hour registration and beginning website'),
(70, '2023-12-05', '09:00:00', '17:00:00', 'Cherry', 'Beginning website and hour registration'),
(71, '2023-12-06', '09:00:00', '17:00:00', 'Cherry', 'Hour registration and portfolio website'),
(72, '2023-12-08', '09:00:00', '16:00:00', 'Cherry', ''),
(73, '2023-12-11', '09:00:00', '17:00:00', 'Cherry', 'Internship essay'),
(74, '2023-12-12', '09:00:00', '17:00:00', 'Cherry', 'Detailing, editing, SEO checks, hour registration and portfolio website'),
(75, '2023-12-13', '09:00:00', '17:00:00', 'Cherry', ''),
(76, '2023-12-15', '09:00:00', '16:00:00', 'Cherry', ''),
(77, '2023-12-18', '09:00:00', '17:00:00', 'Cherry', ''),
(78, '2023-12-19', '09:00:00', '17:00:00', 'Cherry', ''),
(79, '2023-12-20', '09:00:00', '17:00:00', 'Cherry', ''),
(80, '2023-12-22', '09:00:00', '16:00:00', 'Cherry', 'Start on I-match project'),
(81, '2024-01-08', '09:00:00', '17:00:00', 'Cherry', 'Hour Registration'),
(82, '2024-01-09', '09:00:00', '17:00:00', 'Cherry', 'Hour registration, editing WOWWF, portfolio website'),
(84, '2024-01-10', '09:00:00', '17:00:00', 'Cherry', 'Detailing WOWWF'),
(85, '2024-01-12', '09:00:00', '16:00:00', 'Cherry', 'Detailing WOWWF'),
(86, '2024-01-15', '09:00:00', '17:00:00', 'Cherry', 'Internship-essay'),
(87, '2024-01-16', '09:00:00', '17:00:00', 'Cherry', 'Internship-essay'),
(88, '2024-01-17', '09:00:00', '17:00:00', 'Cherry', 'Design last page portfoliowebsite'),
(89, '2024-01-19', '09:00:00', '16:00:00', 'Cherry', 'Photo\'s internship-essay, last details '),
(90, '2024-01-22', '09:00:00', '17:00:00', 'Cherry', ''),
(91, '2024-01-23', '09:00:00', '17:00:00', 'Cherry', ''),
(92, '2024-01-24', '09:00:00', '17:00:00', 'Cherry', ''),
(93, '2024-01-26', '09:00:00', '16:00:00', 'Cherry', ''),
(94, '2024-01-29', '09:00:00', '17:00:00', 'Cherry', ''),
(95, '2024-01-30', '09:00:00', '17:00:00', 'Cherry', ''),
(96, '2024-01-31', '09:00:00', '17:00:00', 'Cherry', ''),
(97, '2024-02-02', '09:00:00', '16:00:00', 'Cherry', ''),
(98, '2024-02-05', '09:00:00', '17:00:00', 'Cherry', ''),
(99, '2024-02-06', '09:00:00', '17:00:00', 'Cherry', ''),
(100, '2024-02-07', '09:00:00', '17:00:00', 'Cherry', ''),
(101, '2024-02-09', '09:00:00', '16:00:00', 'Cherry', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`) VALUES
(3, 'eduard', '$2y$10$N2kxczpXU4BDTYUkHaCvSOMz8.q7x3ZQwaZNjKQ79x8di4SLohVTG'),
(5, 'Cherry', '$2y$10$fZELRNyfH18QPvxNy3MVpuz1a2Axs00NYfLDHLH694eCb05lRUvDi'),
(8, 'Cheyenne', '$2y$10$Zk1zosVZNICBks8p.AuYv.ykvMb78VHS2Bls1vO.yX9mTWEyD8.NG');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
