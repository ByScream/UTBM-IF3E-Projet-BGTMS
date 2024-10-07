-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 07 oct. 2024 à 11:40
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
(1, 'chess', 0, '', 0),
(2, 'Settlers of Catan', 0, '', 0),
(3, 'Ticket to Ride', 0, '', 0),
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
(2, 2),
(5, 2),
(1, 2),
(4, 2),
(3, 1),
(5, 1),
(1, 1);

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
(1, 'Les fifous', 1),
(2, 'Kiki family', 5);

-- --------------------------------------------------------

--
-- Structure de la table `tournament`
--

CREATE TABLE `tournament` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `number_of_players` int(11) NOT NULL,
  `match_rules` text NOT NULL,
  `owner` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tournament`
--

INSERT INTO `tournament` (`id`, `game_id`, `number_of_players`, `match_rules`, `owner`, `type`) VALUES
(1, 4, 2, 'Match de 2 équipes', 1, 1),
(2, 3, 3, '', 3, 0);

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
(1, 1),
(2, 1);

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
(2, 1),
(2, 3),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `pseudo` text NOT NULL,
  `prenom` text NOT NULL,
  `nom` text NOT NULL,
  `phone_number` int(10) NOT NULL,
  `favourite_game_id` int(2) NOT NULL,
  `date_of_birth` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `pseudo`, `prenom`, `nom`, `phone_number`, `favourite_game_id`, `date_of_birth`) VALUES
(1, 'mathis.richard@sfr.fr', 'abc', 'ByScream_', 'Mathis', 'Richard', 616960870, 1, '2005-03-14'),
(2, 'jerome.richard@sfr.fr', 'abcde', 'GegeDu70', 'Jérôme', 'Richard', 383, 1, '1977-04-26'),
(3, 'juline.uttewiller@gmail.com', 'aaa', 'Jul!ne', 'Juline', 'Uttewiller', 33838, 3, '2006-09-11'),
(4, 'veronique.richard@sfr.fr', 'bbb', 'Vero', 'Véronique', 'Richard', 32, 2, '1976-11-22'),
(5, 'kylian.richard@gmail.com', 'ccc', 'Vitrax', 'Kylian', 'Richard', 33372, 3, '2009-10-06');

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
  ADD KEY `tournament_id` (`tournament_id`,`player1`,`player2`),
  ADD KEY `player1` (`player1`),
  ADD KEY `player2` (`player2`);

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
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_team` (`id_team`);

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
  ADD KEY `game_id` (`game_id`),
  ADD KEY `owner` (`owner`);

--
-- Index pour la table `tournaments_teams`
--
ALTER TABLE `tournaments_teams`
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `team` (`team`);

--
-- Index pour la table `tournament_players`
--
ALTER TABLE `tournament_players`
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `player` (`player`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  ADD CONSTRAINT `tournament_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `tournament_ibfk_2` FOREIGN KEY (`owner`) REFERENCES `users` (`id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
