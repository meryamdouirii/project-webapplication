-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 07 feb 2025 om 11:36
-- Serverversie: 11.6.2-MariaDB-ubu2404
-- PHP-versie: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haarlem_festivaldb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `detail_event`
--

CREATE TABLE `detail_event` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `amount_stars` int(11) DEFAULT NULL,
  `banner_image` mediumblob DEFAULT NULL,
  `detail_image_1` blob DEFAULT NULL,
  `detail_image_2` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `event_page`
--

CREATE TABLE `event_page` (
  `id` int(11) NOT NULL,
  `home_page_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `banner_image` mediumblob DEFAULT NULL,
  `smaller_image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `home_page`
--

CREATE TABLE `home_page` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `banner_image` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `detail_event_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `ticket_limit` int(11) NOT NULL,
  `duration_minutes` int(11) NOT NULL,
  `price` float NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `song`
--

CREATE TABLE `song` (
  `id` int(11) NOT NULL,
  `dance_event_id` int(11) NOT NULL,
  `photo` blob DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `purchase_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `bar_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ticket_order`
--

CREATE TABLE `ticket_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `detail_event`
--
ALTER TABLE `detail_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexen voor tabel `event_page`
--
ALTER TABLE `event_page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `home_page_id` (`home_page_id`);

--
-- Indexen voor tabel `home_page`
--
ALTER TABLE `home_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_event_id` (`detail_event_id`);

--
-- Indexen voor tabel `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dance_event_id` (`dance_event_id`);

--
-- Indexen voor tabel `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexen voor tabel `ticket_order`
--
ALTER TABLE `ticket_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `detail_event`
--
ALTER TABLE `detail_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `event_page`
--
ALTER TABLE `event_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `home_page`
--
ALTER TABLE `home_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `song`
--
ALTER TABLE `song`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `ticket_order`
--
ALTER TABLE `ticket_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `detail_event`
--
ALTER TABLE `detail_event`
  ADD CONSTRAINT `detail_event_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event_page` (`id`);

--
-- Beperkingen voor tabel `event_page`
--
ALTER TABLE `event_page`
  ADD CONSTRAINT `event_page_ibfk_1` FOREIGN KEY (`home_page_id`) REFERENCES `home_page` (`id`);

--
-- Beperkingen voor tabel `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`detail_event_id`) REFERENCES `detail_event` (`id`);

--
-- Beperkingen voor tabel `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_1` FOREIGN KEY (`dance_event_id`) REFERENCES `detail_event` (`id`);

--
-- Beperkingen voor tabel `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `ticket_order` (`id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`);

--
-- Beperkingen voor tabel `ticket_order`
--
ALTER TABLE `ticket_order`
  ADD CONSTRAINT `ticket_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
