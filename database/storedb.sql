-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 21 juil. 2026 à 21:09
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
-- Base de données : `storedb`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'client',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `password`, `role`, `created_at`) VALUES
(1, 'Hamza', 'Tyamani', 'tyhamza@gmail.com', '+212604498628', 'Hay halloul', '$2y$10$0lJz/7fKPWxEYEesIc4D5uG70xYBKzIMzO8bROxnC/2w7PLIM1ih.', 'client', '2026-06-06 17:41:35'),
(2, 'Leo', 'Messi', 'messi@gmail.come', '+8737639292', 'Inter Miami', '$2y$10$E/cdeKqoRjsseSfFZTuV8eHP9q7BONnWF2P7ITbKzy/ZT6m0ikM1G', 'client', '2026-06-07 00:03:40'),
(3, 'cristaino', 'Ronaldo', 'cr7@gmail.com', '+735289234', 'Rabat', 'cr7', 'admin', '2026-06-06 23:43:34'),
(4, 'Ali', 'Ayt', 'ali@gmail.com', '+368782387', 'Tinghir', '$2y$10$G2iSK1pTEMM5lSUGN61Fcu7uoAnqZsHsLr2C90nzRND8mIOqkQ68a', 'client', '2026-06-07 02:20:14'),
(5, 'saka', 'bokayo', 'saka@gmail.com', '+373839293', 'England', '$2y$10$eQCPHNZKov6RfZNbEs7YjOhOuaZTx5XNC2/lsmeDpOykFw/Abf.ki', 'client', '2026-06-07 12:03:05'),
(6, 'karim', 'fala', 'kamal@gmail.com', '0363533636', 'England', '$2y$10$7sWBkPtD3gxU/IgIhcYCseQ8SKIdr93TwXCcr6qOzbwa1ZHnfbESC', 'client', '2026-06-12 11:17:38');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
