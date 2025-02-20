-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Feb 18, 2025 at 10:50 PM
-- Server version: 11.6.2-MariaDB-ubu2404
-- PHP Version: 8.2.27

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
-- Table structure for table `about_event`
--

CREATE TABLE `about_event` (
  `about_event_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `button_text` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_event`
--

CREATE TABLE `detail_event` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `banner_description` varchar(200) DEFAULT NULL,
  `banner_image` varchar(200) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `image_description_1` varchar(500) DEFAULT NULL,
  `image_description_2` varchar(500) DEFAULT NULL,
  `card_image` varchar(500) DEFAULT NULL,
  `card_description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_event_card_tag`
--

CREATE TABLE `detail_event_card_tag` (
  `id` int(11) NOT NULL,
  `detail_event_id` int(11) NOT NULL,
  `tag` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description_homepage` varchar(2000) DEFAULT NULL,
  `banner_description` varchar(50) DEFAULT NULL,
  `picture_homepage` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `description_homepage`, `banner_description`, `picture_homepage`) VALUES
(1, 'Dance', 'Top DJs make an appearance for unforgettable nights.', 'Top DJ\'s performing in DANCE festival!', 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?'),
(2, 'Yummy', 'A culinary journey through Haarlem\'s finest dining', 'Visit the best restaurants in Haarlem!', 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=500');

-- --------------------------------------------------------

--
-- Table structure for table `homepage`
--

CREATE TABLE `homepage` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `banner_image` varchar(200) DEFAULT NULL,
  `banner_description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `homepage`
--

INSERT INTO `homepage` (`id`, `name`, `banner_image`, `banner_description`) VALUES
(1, 'The festival', 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?w=1600', 'Join us for three days of music, food, and unforgettable memories');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `detail_event_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `ticket_limit` int(11) NOT NULL,
  `duration_minutes` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `datetime_start` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `id` int(11) NOT NULL,
  `detail_event_id` int(11) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
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
-- Table structure for table `ticket_order`
--

CREATE TABLE `ticket_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `type` enum('employee','customer','administrator') NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`type`, `first_name`, `last_name`, `phone_number`, `email_address`, `password_hash`, `salt`, `reset_token_hash`, `reset_token_expires_at`) 
VALUES ('customer', 'Meryam', 'Douiri', '0643209996', 'douirimeryam14@gmail.com', '$2y$12$9EO5OmD2qLiunmJy3iH2iu2qjyU4mx5IiU/v1c9yfnsFPNvwk4RDG', 'salt', 'c56321a9d72163240b2b9d151ee3e801a9a174512e5f936088518face1ef302a', '2025-02-19 00:19:37');

INSERT INTO `user` (`type`, `first_name`, `last_name`, `phone_number`, `email_address`, `password_hash`, `salt`, `reset_token_hash`, `reset_token_expires_at`) 
VALUES ('administrator', 'Romy', 'Groen', NULL, 'groenromy0@gmail.com', '$2y$12$w6Vh.v5QvPOglb2HAmDkXOvWz2/oyzCui4fc8jxbWW6LKswt4V20G', 'el6XUJnPebqT4oQPrewI3A==', NULL, NULL);

INSERT INTO `user` (`type`, `first_name`, `last_name`, `phone_number`, `email_address`, `password_hash`, `salt`, `reset_token_hash`, `reset_token_expires_at`) 
VALUES ('employee', 'Fiona', 'Shrek', NULL, '701224@student.inholland.nl', '$2y$12$3S3MFqiiCrSfpMp9pCmBWeJguq3EhrAnwlTtr24c3BsU8f/Z4kAdm', 'xMZpfw1LiC+St2cGSu1i7g==', NULL, NULL);

-- Indexes for dumped tables
--

--
-- Indexes for table `about_event`
--
ALTER TABLE `about_event`
  ADD PRIMARY KEY (`about_event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `detail_event`
--
ALTER TABLE `detail_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `detail_event_card_tag`
--
ALTER TABLE `detail_event_card_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_event_id` (`detail_event_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage`
--
ALTER TABLE `homepage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_event_id` (`detail_event_id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_event_id` (`detail_event_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `ticket_order`
--
ALTER TABLE `ticket_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_event`
--
ALTER TABLE `about_event`
  MODIFY `about_event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_event`
--
ALTER TABLE `detail_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_event_card_tag`
--
ALTER TABLE `detail_event_card_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `homepage`
--
ALTER TABLE `homepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_order`
--
ALTER TABLE `ticket_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `about_event`
--
ALTER TABLE `about_event`
  ADD CONSTRAINT `about_event_fk_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Constraints for table `detail_event`
--
ALTER TABLE `detail_event`
  ADD CONSTRAINT `detail_event_fk_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Constraints for table `detail_event_card_tag`
--
ALTER TABLE `detail_event_card_tag`
  ADD CONSTRAINT `detail_event_card_tag_fk_detail_event_id` FOREIGN KEY (`detail_event_id`) REFERENCES `detail_event` (`id`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_fk_detail_event_id` FOREIGN KEY (`detail_event_id`) REFERENCES `detail_event` (`id`);

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_fk_detail_event_id` FOREIGN KEY (`detail_event_id`) REFERENCES `detail_event` (`id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `ticket_order` (`id`),
  ADD CONSTRAINT `ticket_fk_session_id` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`);

--
-- Constraints for table `ticket_order`
--
ALTER TABLE `ticket_order`
  ADD CONSTRAINT `ticket_order_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
