-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2018 at 04:59 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `id` varchar(32) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(24) NOT NULL,
  `url` varchar(192) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`id`, `user_id`, `name`, `url`, `type`, `uploaded_at`) VALUES
('1cZNC7Hgr9LivftzpQAyDFDnck6MlgzN', 2, 'avengers-logo-icon-0.png', '1cZNC7Hgr9LivftzpQAyDFDnck6MlgzN-avengers-logo-icon-0.png', 'image/png', '2018-11-05 02:07:18'),
('4w3gveFw2l8IYIQuIyqiSuwoyJs2HaJk', 2, 'PPT B.Inggris.pptx', '4w3gveFw2l8IYIQuIyqiSuwoyJs2HaJk-PPT B.Inggris.pptx', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', '2018-11-05 01:56:23'),
('64Uh2tmqbNFyS8dreEV6Qz59tIfC1vic', 2, 'Daftar Pustaka.docx', '64Uh2tmqbNFyS8dreEV6Qz59tIfC1vic-Daftar Pustaka.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2018-11-05 01:56:08'),
('b4BnF5MPl42BScvdBQ4JIp8IssTshRG0', 2, 'Screenshot (37).png', 'b4BnF5MPl42BScvdBQ4JIp8IssTshRG0-Screenshot (37).png', 'image/png', '2018-11-05 01:15:09'),
('EGqOBGHnGZhyW5XS6AQTIYhAbx13Z0mV', 2, '35. Belajar PHP untuk pe', 'EGqOBGHnGZhyW5XS6AQTIYhAbx13Z0mV-35. Belajar PHP untuk pemula ( Upload - Validasi Nama sama ).mp4', 'video/mp4', '2018-11-05 02:07:40'),
('PVae7hmqAeKssWlkYZqjgZ965ouJNmja', 2, 'LAPORAN.pptx', 'PVae7hmqAeKssWlkYZqjgZ965ouJNmja-LAPORAN.pptx', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', '2018-11-05 01:56:00'),
('QtDKJK15VT83NNPPmuHJjLybCmzdQlJ8', 2, '03PWA-Workshop.pdf', 'QtDKJK15VT83NNPPmuHJjLybCmzdQlJ8-03PWA-Workshop.pdf', 'application/pdf', '2018-11-05 01:47:57'),
('xZAxKPJQLFpJ1fvp6tqmaMvSPAIZ8VIh', 2, '1.IDENTITAS SISWA.docx', 'xZAxKPJQLFpJ1fvp6tqmaMvSPAIZ8VIh-1.IDENTITAS SISWA.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2018-11-05 02:07:06');

--
-- Triggers `arsip`
--
DELIMITER $$
CREATE TRIGGER `delete` AFTER DELETE ON `arsip` FOR EACH ROW BEGIN
	DELETE FROM data WHERE old.id = data.arsip_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `arsip_id` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `user_id`, `arsip_id`) VALUES
(1, 2, 'bHdodkwn0zUaTr8yRQGFzXl4B6Kx4of9'),
(2, 2, 'b4BnF5MPl42BScvdBQ4JIp8IssTshRG0'),
(3, 2, 'QtDKJK15VT83NNPPmuHJjLybCmzdQlJ8'),
(4, 2, 'PVae7hmqAeKssWlkYZqjgZ965ouJNmja'),
(5, 2, '64Uh2tmqbNFyS8dreEV6Qz59tIfC1vic'),
(6, 2, '4w3gveFw2l8IYIQuIyqiSuwoyJs2HaJk'),
(8, 2, 'xZAxKPJQLFpJ1fvp6tqmaMvSPAIZ8VIh'),
(9, 2, '1cZNC7Hgr9LivftzpQAyDFDnck6MlgzN'),
(10, 2, 'EGqOBGHnGZhyW5XS6AQTIYhAbx13Z0mV');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`) VALUES
(1, 'root@e.a', '123', '$2y$10$lVtFs3.crU51oo3Nv5ioE.QxCbF/NabDvTyYxBwyfE7m5y0WAQm2W'),
(2, 'test@gmail.com', 'root', '$2y$10$yGu4a7v..XgYQc8Yq1QT3eat2Y8ygTlqJEhBpfUo4jgcCa/tlH7vW'),
(3, 'dchya24@gmail.com', 'test@gmail.com', '$2y$10$kmaz8fO04xAsy7m2pO3ipu83pN/KMvYx6mb./WsU1zRt.m4djpagq'),
(4, 'gesty@gmail.com', 'pakak', '$2y$10$MkEux7SNce6ehjb07tCSeu1I6kepr.R9MsdoIjJOyvi3tQl6IGmA2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
