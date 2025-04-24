-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 24 avr. 2025 à 12:05
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `muyisa_energie`
--

-- --------------------------------------------------------

--
-- Structure de la table `approvisionnement`
--

CREATE TABLE `approvisionnement` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `type` varchar(11) NOT NULL,
  `quantite` double NOT NULL,
  `montant` double NOT NULL,
  `statut` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `approvisionnement`
--

INSERT INTO `approvisionnement` (`id`, `dates`, `type`, `quantite`, `montant`, `statut`, `supprimer`) VALUES
(1, '2025-04-23', '', 10.5, 230, 0, 1),
(2, '2025-04-23', 'mazout', 344, 999, 0, 0),
(3, '2025-04-24', 'essence', 20000, 200000000, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `numero` varchar(50) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `prenom` text NOT NULL,
  `photo` text NOT NULL,
  `genre` varchar(2) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`numero`, `nom`, `postnom`, `prenom`, `photo`, `genre`, `telephone`, `supprimer`) VALUES
('ME0001', 'kambale ', 'kilima', 'julien', '1745405356.jpg', 'M', '0977139499', 0),
('ME0002', 'kambale ', 'kamala', 'albert', '1745403341.jpg', 'M', '0971402590', 0),
('ME0003', 'kam', 'kok', 'kkk', '1745405631.jpg', 'F', '0977139490', 1),
('ME0004', 'kamla', 'lll', 'lll', '1745405932.jpg', 'F', '0977139490', 1);

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

CREATE TABLE `prix` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `prix_essence` double NOT NULL,
  `prix_mazout` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prix`
--

INSERT INTO `prix` (`id`, `dates`, `prix_essence`, `prix_mazout`, `supprimer`) VALUES
(1, '2025-04-24', 5000, 6000, 0),
(2, '2025-04-24', 5500, 6000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `taux`
--

CREATE TABLE `taux` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `equivalent` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `taux`
--

INSERT INTO `taux` (`id`, `dates`, `equivalent`, `supprimer`) VALUES
(1, '2025-04-22', 2850, 0),
(2, '2025-04-22', 2000, 0),
(3, '2025-04-22', 2900, 0),
(4, '2025-04-22', 2908, 0),
(5, '2025-04-22', 2900, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `prenom` text NOT NULL,
  `fonction` text NOT NULL,
  `photo` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `postnom`, `prenom`, `fonction`, `photo`, `username`, `password`, `supprimer`) VALUES
(1, 'kambale', 'kamala', 'albert', 'comptable', 'al.jpg', 'albertkamala.@me.drc', '0101', 1),
(2, 'kmk', 'kkk', 'klkk', 'Gerant', 'sscru3.webp', 'klkkkkk.@me.drc', '8898', 1),
(3, 'kambale', 'kamala', 'albert', 'gerant', '1745404332.jpg', 'albertkamala.@me.drc', '0101', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`numero`);

--
-- Index pour la table `prix`
--
ALTER TABLE `prix`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `taux`
--
ALTER TABLE `taux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `prix`
--
ALTER TABLE `prix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `taux`
--
ALTER TABLE `taux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
