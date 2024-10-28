-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 28 oct. 2024 à 10:13
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
-- Base de données : `if3e_projet_b`
--

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `game_name` text NOT NULL,
  `type` int(1) NOT NULL,
  `rules` text NOT NULL,
  `number_of_players` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `games`
--

INSERT INTO `games` (`id`, `game_name`, `type`, `rules`, `number_of_players`) VALUES
(1, 'chess', 0, '', 2),
(2, 'Settlers of Catan', 0, '', 2),
(3, 'Ticket to Ride', 0, '', 2),
(4, 'Monopoly', 1, 'bla bla bla', 2);

-- --------------------------------------------------------

--
-- Structure de la table `match_player`
--

CREATE TABLE `match_player` (
  `tournament_id` int(11) NOT NULL,
  `player1` int(11) NOT NULL,
  `player2` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `location` text NOT NULL,
  `progress` text NOT NULL,
  `score_player1` int(11) NOT NULL,
  `score_player2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `match_player`
--

INSERT INTO `match_player` (`tournament_id`, `player1`, `player2`, `date`, `time`, `location`, `progress`, `score_player1`, `score_player2`) VALUES
(8, 12, 13, '2024-10-21', '2024-10-28 08:41:40', 'efrfer', 'En cours', 2, 3),
(8, 14, 13, '2024-10-21', '2024-10-28 08:54:48', 'ee', 'terminé', 0, 4),
(8, 12, 14, '2024-10-21', '2024-10-28 08:55:40', '', '', 0, 4);

-- --------------------------------------------------------

--
-- Structure de la table `match_team`
--

CREATE TABLE `match_team` (
  `tournament_id` int(11) NOT NULL,
  `team1` int(11) NOT NULL,
  `team2` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `location` text NOT NULL,
  `progress` text NOT NULL,
  `score_team1` int(11) NOT NULL,
  `score_team2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `match_team`
--

INSERT INTO `match_team` (`tournament_id`, `team1`, `team2`, `date`, `time`, `location`, `progress`, `score_team1`, `score_team2`) VALUES
(7, 8, 9, '0000-00-00', '2024-10-28 09:01:48', 'test', 'Terminé', 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `player_team`
--

CREATE TABLE `player_team` (
  `id_user` int(11) NOT NULL,
  `id_team` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `player_team`
--

INSERT INTO `player_team` (`id_user`, `id_team`) VALUES
(10, 8),
(10, 9);

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` text NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `owner`) VALUES
(8, 'Richard Team', 10),
(9, 'Uttewiller company', 10);

-- --------------------------------------------------------

--
-- Structure de la table `tournament`
--

CREATE TABLE `tournament` (
  `id` int(11) NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `name` varchar(256) NOT NULL,
  `number_of_players` int(11) NOT NULL,
  `match_rules` text NOT NULL,
  `owner` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tournament`
--

INSERT INTO `tournament` (`id`, `game_id`, `name`, `number_of_players`, `match_rules`, `owner`, `type`) VALUES
(7, 4, 'Tournoi d\'Héricourt', 3, 'Elimination directe', 10, 1),
(8, 1, 'Tournoi de Belfort', 2, 'Elimination directe', 10, 0),
(9, 4, 'Championnat BFC', 5, 'eee', 10, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tournaments_teams`
--

CREATE TABLE `tournaments_teams` (
  `team` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tournaments_teams`
--

INSERT INTO `tournaments_teams` (`team`, `tournament_id`) VALUES
(8, 7),
(9, 7);

-- --------------------------------------------------------

--
-- Structure de la table `tournament_players`
--

CREATE TABLE `tournament_players` (
  `tournament_id` int(11) NOT NULL,
  `player` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tournament_players`
--

INSERT INTO `tournament_players` (`tournament_id`, `player`) VALUES
(8, 10),
(8, 12),
(8, 13),
(8, 14);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` text NOT NULL,
  `pseudo` text NOT NULL,
  `prenom` text NOT NULL,
  `nom` text NOT NULL,
  `phone_number` int(10) NOT NULL,
  `favourite_game_id` int(2) DEFAULT NULL,
  `date_of_birth` date DEFAULT current_timestamp(),
  `is_organizer` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `pseudo`, `prenom`, `nom`, `phone_number`, `favourite_game_id`, `date_of_birth`, `is_organizer`) VALUES
(10, 'mathis.richard@sfr.fr', '$2y$10$u3RvAalYLqquqTKRaOLpBeXd1uAUBrVrAC2CVTjYvE3pkMKnRxeFi', 'ByScream_', 'Mathis', 'Richard', 616960870, 1, '2005-02-14', 1),
(11, 'kylian.richard@gmail.com', '$2y$10$5viVvMfK4/v9yHldlY3OOeeikc5Yb8OIz.BZJm99wIVKyAWrTAJ6e', 'Vitrax', 'Kylian', 'Richard', 0, 2, '2009-10-06', 0),
(12, 'veronique.richard@sfr.fr', '$2y$10$tcKV7okQj/sPtupAzjDUVuWUrcedCxlqlS4SN3befXlG9DPiQPLm.', 'Vero70', 'Véronique', 'Richard', 0, 1, '1976-11-22', 0),
(13, 'jeromerichard69@sfr.fr', '$2y$10$go5AZzyC14ulLEiT39hIh..kyB0LsnjaItXaEH.XpEG1QoI0P3iWS', 'Gege70', 'Jérôme', 'Richard', 0, 4, '1977-04-26', 0),
(14, 'juline.uttewiller@gmail.com', '$2y$10$sk3u//hyiuEIJNwjr/WoNehHlhwbV.e.36k4u/BEeRxYRl6aUPtke', 'Jul!ne', 'Juline', 'Richard', 0, 1, '2006-09-11', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `match_player`
--
ALTER TABLE `match_player`
  ADD KEY `player1` (`player1`),
  ADD KEY `player2` (`player2`),
  ADD KEY `tournament_id` (`tournament_id`);

--
-- Index pour la table `match_team`
--
ALTER TABLE `match_team`
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `team1` (`team1`),
  ADD KEY `team2` (`team2`);

--
-- Index pour la table `player_team`
--
ALTER TABLE `player_team`
  ADD UNIQUE KEY `id_user_2` (`id_user`,`id_team`),
  ADD KEY `id_team` (`id_team`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `owner` (`owner`);

--
-- Index pour la table `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`owner`),
  ADD KEY `game_id` (`game_id`);

--
-- Index pour la table `tournaments_teams`
--
ALTER TABLE `tournaments_teams`
  ADD UNIQUE KEY `team_2` (`team`,`tournament_id`),
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `team` (`team`);

--
-- Index pour la table `tournament_players`
--
ALTER TABLE `tournament_players`
  ADD UNIQUE KEY `tournament_id_2` (`tournament_id`,`player`),
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `player` (`player`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourite_game_id` (`favourite_game_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `match_player`
--
ALTER TABLE `match_player`
  ADD CONSTRAINT `match_player_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`),
  ADD CONSTRAINT `match_player_ibfk_2` FOREIGN KEY (`player1`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `match_player_ibfk_3` FOREIGN KEY (`player2`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `match_team`
--
ALTER TABLE `match_team`
  ADD CONSTRAINT `match_team_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`),
  ADD CONSTRAINT `match_team_ibfk_2` FOREIGN KEY (`team1`) REFERENCES `teams` (`team_id`),
  ADD CONSTRAINT `match_team_ibfk_3` FOREIGN KEY (`team2`) REFERENCES `teams` (`team_id`);

--
-- Contraintes pour la table `player_team`
--
ALTER TABLE `player_team`
  ADD CONSTRAINT `player_team_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `player_team_ibfk_2` FOREIGN KEY (`id_team`) REFERENCES `teams` (`team_id`);

--
-- Contraintes pour la table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `tournament`
--
ALTER TABLE `tournament`
  ADD CONSTRAINT `tournament_ibfk_2` FOREIGN KEY (`owner`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tournament_ibfk_3` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);

--
-- Contraintes pour la table `tournaments_teams`
--
ALTER TABLE `tournaments_teams`
  ADD CONSTRAINT `tournaments_teams_ibfk_1` FOREIGN KEY (`team`) REFERENCES `teams` (`team_id`),
  ADD CONSTRAINT `tournaments_teams_ibfk_2` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`);

--
-- Contraintes pour la table `tournament_players`
--
ALTER TABLE `tournament_players`
  ADD CONSTRAINT `tournament_players_ibfk_1` FOREIGN KEY (`player`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tournament_players_ibfk_2` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`favourite_game_id`) REFERENCES `games` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
