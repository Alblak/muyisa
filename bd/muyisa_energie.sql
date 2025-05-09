-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 09 mai 2025 à 08:41
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
(2, '2025-04-23', 'mazout', 12000, 2, 0, 0),
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
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `client` text NOT NULL,
  `type` int(11) NOT NULL,
  `numfacture` int(11) NOT NULL,
  `statut` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `dates`, `client`, `type`, `numfacture`, `statut`, `supprimer`) VALUES
(8, '2025-04-26', 'ME0001', 0, 1, 1, 0),
(9, '2025-04-26', 'ME0002', 0, 2, 1, 0),
(10, '2025-04-28', 'ME0002', 0, 3, 0, 0),
(11, '2025-04-28', 'ME0001', 0, 4, 0, 0),
(12, '2025-04-28', 'ME0001', 0, 5, 1, 0),
(13, '2025-04-28', 'ME0001', 0, 6, 0, 0),
(14, '2025-04-28', 'ME0001', 0, 7, 1, 0),
(15, '2025-05-06', 'ME0002', 0, 8, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande_ap`
--

CREATE TABLE `commande_ap` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `fournisseur` int(11) NOT NULL,
  `numcommande` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande_ap`
--

INSERT INTO `commande_ap` (`id`, `dates`, `fournisseur`, `numcommande`, `supprimer`) VALUES
(1, '2025-05-02', 1, 1, 0),
(2, '2025-05-02', 1, 2, 0),
(3, '2025-05-02', 1, 3, 0),
(4, '2025-05-02', 1, 4, 0),
(5, '2025-05-02', 1, 5, 0),
(6, '2025-05-02', 1, 6, 0),
(7, '2025-05-02', 1, 7, 0),
(8, '2025-05-02', 1, 8, 0),
(9, '2025-05-03', 1, 9, 0),
(10, '2025-05-06', 1, 10, 0);

-- --------------------------------------------------------

--
-- Structure de la table `entree`
--

CREATE TABLE `entree` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `commande` int(11) NOT NULL,
  `quantite_essence` double NOT NULL,
  `quantite_mazout` double NOT NULL,
  `reste_argent` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `entree`
--

INSERT INTO `entree` (`id`, `dates`, `commande`, `quantite_essence`, `quantite_mazout`, `reste_argent`, `supprimer`) VALUES
(1, '2025-05-06', 10, 9900, 4500, 1100, 0),
(2, '2025-05-06', 9, 39000, 223000, 0, 0),
(3, '2025-05-06', 8, 1000, 6700, 31200, 0),
(4, '2025-05-06', 7, 0, 12000, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `prenom` text NOT NULL,
  `adresse` text NOT NULL,
  `telephone` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `postnom`, `prenom`, `adresse`, `telephone`, `supprimer`) VALUES
(1, 'kkkkKKK', 'KKKKkk', 'KKKK', 'kkkkkk', '-0988888888888', 0);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `commande` int(11) NOT NULL,
  `type` text NOT NULL,
  `type_achat` text NOT NULL,
  `quantite` double NOT NULL,
  `prixunitaire` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `commande`, `type`, `type_achat`, `quantite`, `prixunitaire`, `supprimer`) VALUES
(1, 8, 'essence', 'litre', 18, 5500, 0),
(2, 8, 'mazout', 'litre', 2, 6000, 0),
(4, 9, 'essence', 'litre', 3, 5500, 0),
(5, 9, 'essence', 'fut', 3, 80000, 0),
(6, 9, 'mazout', 'litre', 3, 6000, 0),
(9, 12, 'essence', 'fut', 1, 80000, 0),
(10, 12, 'essence', 'litre', 1, 5500, 0),
(12, 14, 'essence', 'litre', 2, 5500, 0),
(13, 14, 'essence', 'fut', 1, 80000, 0),
(14, 2, 'essence', '', 22, 80000, 0),
(15, 3, 'essence', '', 12, 80000, 0),
(16, 4, 'mazout', '', 4, 300000, 0),
(17, 5, 'essence', '', 12, 80000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `panier_ap`
--

CREATE TABLE `panier_ap` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL,
  `commande` int(11) NOT NULL,
  `quantite` double NOT NULL,
  `prixunitaire` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panier_ap`
--

INSERT INTO `panier_ap` (`id`, `type`, `commande`, `quantite`, `prixunitaire`, `supprimer`) VALUES
(1, 'essence', 6, 2, 2000, 0),
(4, 'mazout', 7, 12, 23, 0),
(5, 'mazout', 8, 7, 2000, 0),
(6, 'essence', 8, 10, 3400, 0),
(7, 'essence', 9, 39, 200, 0),
(8, 'mazout', 9, 223, 8, 0),
(9, 'essence', 10, 10, 1000, 0),
(10, 'mazout', 10, 5, 2000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

CREATE TABLE `prix` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `prix_essenceL` double NOT NULL,
  `prix_mazoutL` double NOT NULL,
  `prix_essenceF` double NOT NULL,
  `prix_mazoutF` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prix`
--

INSERT INTO `prix` (`id`, `dates`, `prix_essenceL`, `prix_mazoutL`, `prix_essenceF`, `prix_mazoutF`, `supprimer`) VALUES
(1, '2025-04-24', 5000, 6000, 0, 0, 0),
(2, '2025-04-24', 5500, 6000, 0, 0, 0),
(3, '2025-04-24', 5500, 6000, 80000, 840999, 0),
(4, '2025-04-28', 5500, 6000, 80000, 300000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `sortie`
--

CREATE TABLE `sortie` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `quantite` int(11) NOT NULL,
  `type` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(5, '2025-04-22', 2900, 0),
(6, '2025-04-28', 2850, 0);

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
(1, 'kambale', 'kiLIM', 'julien', 'caissiere', '1745823599.jpg', 'julienkiLIM.@me.drc', '0101', 0),
(2, 'kmk', 'kkk', 'klkk', 'admin', 'sscru3.webp', 'klkkkkk.@me.drc', '8898', 0),
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
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande_ap`
--
ALTER TABLE `commande_ap`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entree`
--
ALTER TABLE `entree`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier_ap`
--
ALTER TABLE `panier_ap`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prix`
--
ALTER TABLE `prix`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sortie`
--
ALTER TABLE `sortie`
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
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `commande_ap`
--
ALTER TABLE `commande_ap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `entree`
--
ALTER TABLE `entree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `panier_ap`
--
ALTER TABLE `panier_ap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `prix`
--
ALTER TABLE `prix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `sortie`
--
ALTER TABLE `sortie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `taux`
--
ALTER TABLE `taux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
