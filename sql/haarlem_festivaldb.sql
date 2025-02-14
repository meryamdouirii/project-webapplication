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
-- Table structure for table `homepage`
-- --------------------------------------------------------
CREATE TABLE `homepage` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(200) NOT NULL,
  `homepage_description` VARCHAR(200) DEFAULT NULL,
  `banner_image` VARCHAR(200) DEFAULT NULL,
  `banner_description` VARCHAR(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------
-- Table structure for table `event`
-- --------------------------------------------------------
CREATE TABLE `event` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(200) NOT NULL,
  `description_homepage` VARCHAR(2000) DEFAULT NULL,
  `banner_description` VARCHAR(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------
-- Table structure for table `about_event`
-- --------------------------------------------------------
CREATE TABLE `about_event` (
  `about_event_id` INT(11) NOT NULL,
  `event_id` INT(11) DEFAULT NULL,
  `title` VARCHAR(200) DEFAULT NULL,
  `description` VARCHAR(200) DEFAULT NULL,
  `button_text` VARCHAR(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------
-- Table structure for table `detail_event`
-- --------------------------------------------------------
CREATE TABLE `detail_event` (
  `id` INT(11) NOT NULL,
  `event_id` INT(11) NOT NULL,
  `banner_description` VARCHAR(200) DEFAULT NULL,
  `banner_image` VARCHAR(200) DEFAULT NULL,
  `name` VARCHAR(200) NOT NULL,
  `description` VARCHAR(500) DEFAULT NULL,
  `image_description_1` VARCHAR(500) DEFAULT NULL,
  `image_description_2` VARCHAR(500) DEFAULT NULL,
  `card_image` VARCHAR(500) DEFAULT NULL,
  `card_description` VARCHAR(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------
-- Table structure for table `detail_event_card_tag`
-- --------------------------------------------------------
CREATE TABLE `detail_event_card_tag` (
  `id` INT(11) NOT NULL,
  `detail_event_id` INT(11) NOT NULL,
  `tag` VARCHAR(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------
-- Table structure for table `session`
-- --------------------------------------------------------
CREATE TABLE `session` (
  `id` INT(11) NOT NULL,
  `detail_event_id` INT(11) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `description` VARCHAR(5000) DEFAULT NULL,
  `location` VARCHAR(255) DEFAULT NULL,
  `ticket_limit` INT(11) NOT NULL,
  `duration_minutes` INT(11) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `datetime_start` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------
-- Table structure for table `song`
-- --------------------------------------------------------
CREATE TABLE `song` (
  `id` INT(11) NOT NULL,
  `detail_event_id` INT(11) NOT NULL,
  `photo` VARCHAR(200) DEFAULT NULL,
  `title` VARCHAR(255) DEFAULT NULL,
  `description` VARCHAR(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------
-- Table structure for table `user`
-- --------------------------------------------------------
CREATE TABLE `user` (
  `id` INT(11) NOT NULL,
  `type` INT(11) NOT NULL,
  `name` VARCHAR(255) DEFAULT NULL,
  `phone_number` VARCHAR(255) DEFAULT NULL,
  `email_address` VARCHAR(255) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `salt` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------
-- Table structure for table `ticket_order`
-- --------------------------------------------------------
CREATE TABLE `ticket_order` (
  `id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `status` INT(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------
-- Table structure for table `ticket`
-- --------------------------------------------------------
CREATE TABLE `ticket` (
  `id` INT(11) NOT NULL,
  `order_id` INT(11) NOT NULL,
  `session_id` INT(11) NOT NULL,
  `purchase_date` DATETIME NOT NULL,
  `status` INT(11) NOT NULL,
  `bar_code` INT(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


--
-- Indexes for tables
--

-- Table `homepage`
ALTER TABLE `homepage`
  ADD PRIMARY KEY (`id`);

-- Table `event`
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

-- Table `about_event`
ALTER TABLE `about_event`
  ADD PRIMARY KEY (`about_event_id`),
  ADD KEY `event_id` (`event_id`);

-- Table `detail_event`
ALTER TABLE `detail_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

-- Table `detail_event_card_tag`
ALTER TABLE `detail_event_card_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_event_id` (`detail_event_id`);

-- Table `session`
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_event_id` (`detail_event_id`);

-- Table `song`
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_event_id` (`detail_event_id`);

-- Table `user`
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

-- Table `ticket_order`
ALTER TABLE `ticket_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

-- Table `ticket`
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `session_id` (`session_id`);


--
-- AUTO_INCREMENT for tables
--

ALTER TABLE `homepage`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `event`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `about_event`
  MODIFY `about_event_id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `detail_event`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `detail_event_card_tag`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `session`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `song`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ticket_order`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ticket`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;


--
-- Constraints for exported tables
--

-- Table `about_event`
ALTER TABLE `about_event`
  ADD CONSTRAINT `about_event_fk_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

-- Table `detail_event`
ALTER TABLE `detail_event`
  ADD CONSTRAINT `detail_event_fk_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

-- Table `detail_event_card_tag`
ALTER TABLE `detail_event_card_tag`
  ADD CONSTRAINT `detail_event_card_tag_fk_detail_event_id` FOREIGN KEY (`detail_event_id`) REFERENCES `detail_event` (`id`);

-- Table `session`
ALTER TABLE `session`
  ADD CONSTRAINT `session_fk_detail_event_id` FOREIGN KEY (`detail_event_id`) REFERENCES `detail_event` (`id`);

-- Table `song`
ALTER TABLE `song`
  ADD CONSTRAINT `song_fk_detail_event_id` FOREIGN KEY (`detail_event_id`) REFERENCES `detail_event` (`id`);

-- Table `ticket_order`
ALTER TABLE `ticket_order`
  ADD CONSTRAINT `ticket_order_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

-- Table `ticket`
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `ticket_order` (`id`),
  ADD CONSTRAINT `ticket_fk_session_id` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
