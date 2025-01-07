-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 14 nov. 2024 à 21:10
-- Version du serveur : 8.0.35
-- Version de PHP : 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `flip_and_find`
--

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `identifiant` int NOT NULL,
  `nom` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jeu`
--

INSERT INTO `jeu` (`identifiant`, `nom`) VALUES
(1, 'Flip and find');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `identifiant` int NOT NULL,
  `id_jeu` int NOT NULL,
  `id_exp` int NOT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_temps_mess` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`identifiant`, `id_jeu`, `id_exp`, `message`, `date_temps_mess`) VALUES
(254, 1, 16, 'Bonjour', '2024-11-14 21:22:54'),
(255, 1, 16, 'ccc', '2024-11-14 21:26:26'),
(256, 1, 16, 'Bonsoir', '2024-11-14 21:26:47'),
(257, 1, 16, 'salut', '2024-11-14 21:26:59'),
(258, 1, 16, 'd', '2024-11-14 21:27:12'),
(259, 1, 16, 'cc', '2024-11-14 21:27:32'),
(260, 1, 16, 'pruneau', '2024-11-14 21:27:40'),
(261, 1, 16, 'salut', '2024-11-14 21:28:31'),
(262, 1, 16, 'cc', '2024-11-14 21:28:34'),
(263, 1, 17, 'SALUT', '2024-11-14 21:34:12'),
(264, 1, 17, 'masterclass sah', '2024-11-14 21:40:03'),
(265, 1, 17, 'terrifiant la masterclass je cry on the chicken la', '2024-11-14 21:40:18'),
(266, 1, 17, 'c', '2024-11-14 22:06:51'),
(267, 1, 17, 'c', '2024-11-14 22:06:51'),
(268, 1, 17, 'c', '2024-11-14 22:06:51'),
(269, 1, 17, 'cc', '2024-11-14 22:06:52');

-- --------------------------------------------------------

--
-- Structure de la table `message_prive`
--

CREATE TABLE `message_prive` (
  `id` int NOT NULL,
  `id_1` int NOT NULL,
  `id_2` int NOT NULL,
  `contenu` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lu` tinyint(1) NOT NULL,
  `date_temps_envoie` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_temps_lecture` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message_prive`
--

INSERT INTO `message_prive` (`id`, `id_1`, `id_2`, `contenu`, `lu`, `date_temps_envoie`, `date_temps_lecture`) VALUES
(21, 1, 2, 'Salut, comment ça va ?', 1, '2024-10-01 08:15:00', '2024-10-01 08:16:00'),
(22, 2, 1, 'Bien, et toi ?', 1, '2024-10-01 08:17:00', '2024-10-01 08:18:00'),
(23, 3, 4, 'Bonjour, tu es dispo pour un projet ?', 1, '2024-10-02 09:00:00', '2024-10-02 09:01:00'),
(24, 4, 3, 'Oui, dis-moi en plus.', 0, '2024-10-02 09:05:00', NULL),
(25, 1, 2, 'On se retrouve à quelle heure ?', 1, '2024-10-03 10:20:00', '2024-10-03 10:25:00'),
(26, 3, 1, '13h00 ça te va ?', 1, '2024-10-03 10:30:00', '2024-10-03 10:35:00'),
(27, 2, 4, 'As-tu reçu les documents ?', 1, '2024-10-04 11:00:00', '2024-10-04 11:05:00'),
(28, 1, 2, 'Oui, tout est bon.', 1, '2024-10-04 11:10:00', '2024-10-04 11:12:00'),
(29, 2, 3, 'Tu es là ce soir ?', 0, '2024-10-05 18:15:00', NULL),
(30, 3, 4, 'Oui, vers 19h.', 0, '2024-10-05 18:20:00', NULL),
(31, 3, 1, 'Merci pour ton aide hier !', 1, '2024-10-06 14:30:00', '2024-10-06 14:32:00'),
(32, 4, 3, 'Avec plaisir !', 1, '2024-10-06 14:35:00', '2024-10-06 14:36:00'),
(33, 4, 1, 'Penses-tu que le projet est réalisable ?', 1, '2024-10-07 15:00:00', '2024-10-07 15:02:00'),
(34, 2, 4, 'Oui, mais ça demande du travail.', 0, '2024-10-07 15:05:00', NULL),
(35, 3, 2, 'Tu peux me rappeler demain ?', 1, '2024-10-08 09:10:00', '2024-10-08 09:12:00'),
(36, 1, 2, 'Bien sûr, à quelle heure ?', 1, '2024-10-08 09:15:00', '2024-10-08 09:17:00'),
(37, 4, 1, 'Salut, toujours partant pour samedi ?', 1, '2024-10-09 13:25:00', '2024-10-09 13:30:00'),
(38, 3, 2, 'Oui, on se tient au courant.', 1, '2024-10-09 13:35:00', '2024-10-09 13:37:00'),
(39, 1, 3, 'Tu as reçu le mail ?', 1, '2024-10-10 08:45:00', '2024-10-10 08:47:00'),
(40, 3, 1, 'Oui, merci.', 1, '2024-10-10 08:50:00', '2024-10-10 08:52:00');

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

CREATE TABLE `score` (
  `identifiant` int NOT NULL,
  `id_joueur` int NOT NULL,
  `id_jeu` int NOT NULL DEFAULT '1',
  `difficulte` text COLLATE utf8mb4_general_ci NOT NULL,
  `score` int NOT NULL,
  `date_temps_partie` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `theme` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `score`
--

INSERT INTO `score` (`identifiant`, `id_joueur`, `id_jeu`, `difficulte`, `score`, `date_temps_partie`, `theme`) VALUES
(81, 17, 1, 'Facile', 200, '2024-11-13 23:11:37', 'Meme'),
(82, 16, 1, 'Moyen', 100, '2024-11-14 09:12:51', 'Meme'),
(85, 16, 1, 'Facile', 29, '2024-11-14 18:49:54', 'Meme'),
(86, 16, 1, 'Facile', 22, '2024-11-14 18:52:50', 'Meme'),
(87, 16, 1, 'Facile', 30, '2024-11-14 18:54:54', 'Meme'),
(88, 16, 1, 'Facile', 25, '2024-11-14 18:56:16', 'Meme'),
(89, 16, 1, 'Facile', 26, '2024-11-14 19:01:29', 'Meme');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `identifiant` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mot_de_passe` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pseudo` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_temps_insc` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_temps_derniere_co` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `level` int NOT NULL,
  `xp` int NOT NULL,
  `goal_xp` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`identifiant`, `email`, `mot_de_passe`, `pseudo`, `date_temps_insc`, `date_temps_derniere_co`, `level`, `xp`, `goal_xp`) VALUES
(16, 'lucasmarrant@gmail.com', '$2y$10$haNGQUX7kUAlW8KuqsPfqe85lYgFFahZbWeo7394EhyILV61TbG2e', 'LucasMarrant', '2024-11-13 13:51:58', '2024-11-13 13:51:58', 10, 50, 158),
(17, 'idris@gmail.com', '$2y$10$a4Cg0vgW.Yq7oWjtUfT9n.Vw1wWF4AEQWV9AitpTAF9zecWQ6y4Am', 'Idris', '2024-11-13 22:58:23', '2024-11-13 22:58:23', 0, 6, 100),
(18, 'nigno@gmail.com', '$2y$10$T5lJ2/srMeF2c/X4PkNBquXwmflrEx6yCN6XFfe4jSjZT7r6Etz5e', 'Nigno', '2024-11-14 09:46:48', '2024-11-14 09:46:48', 0, 0, 100),
(19, 'mathys@gmail.com', '$2y$10$WP1UKiXQJlLDzf.d6ffyru/p9dIwmAa8okS9JrkL/h.aqlz53uBtC', 'Mathys', '2024-11-14 13:26:50', '2024-11-14 13:26:50', 0, 0, 100);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD PRIMARY KEY (`identifiant`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`identifiant`),
  ADD KEY `util_mess` (`id_exp`),
  ADD KEY `jeu_mess` (`id_jeu`);

--
-- Index pour la table `message_prive`
--
ALTER TABLE `message_prive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_prive_id1_utilisateur` (`id_1`),
  ADD KEY `message_prive_id2_utilisateur` (`id_2`);

--
-- Index pour la table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`identifiant`),
  ADD KEY `joueur_score` (`id_joueur`),
  ADD KEY `jeu_score` (`id_jeu`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`identifiant`),
  ADD UNIQUE KEY `email` (`email`,`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `identifiant` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `identifiant` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT pour la table `message_prive`
--
ALTER TABLE `message_prive`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `score`
--
ALTER TABLE `score`
  MODIFY `identifiant` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `identifiant` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `jeu_mess` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`identifiant`);

--
-- Contraintes pour la table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `jeu_score` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`identifiant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
