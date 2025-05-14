-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 14 mai 2025 à 17:54
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
-- Structure de la table `bondesortie`
--

CREATE TABLE `bondesortie` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `libelle` text NOT NULL,
  `montant` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bondesortie`
--

INSERT INTO `bondesortie` (`id`, `dates`, `libelle`, `montant`, `supprimer`) VALUES
(1, '2025-05-13', 'achat materiel', 150, 0),
(2, '2025-05-13', 'frais de transport', 200, 1),
(3, '2025-05-13', 'payement logiciel', 88, 0);

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
(8, '2025-04-26', 'ME0001', 2, 1, 1, 0),
(9, '2025-04-26', 'ME0002', 2, 2, 1, 0),
(12, '2025-04-28', 'ME0001', 2, 5, 1, 0),
(14, '2025-04-28', 'ME0001', 2, 7, 1, 0),
(19, '2025-05-09', 'ME0002', 2, 12, 1, 0),
(20, '2025-05-09', 'ME0002', 1, 13, 1, 0),
(22, '2025-05-14', 'ME0002', 2, 14, 0, 0),
(23, '2025-05-14', 'ME0002', 1, 15, 1, 0),
(24, '2025-05-14', 'ME0002', 1, 16, 0, 0),
(25, '2025-05-14', 'ME0002', 1, 17, 1, 0);

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
-- Structure de la table `mois`
--

CREATE TABLE `mois` (
  `id` int(11) NOT NULL,
  `mois` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mois`
--

INSERT INTO `mois` (`id`, `mois`) VALUES
(1, 'janvier'),
(2, 'fevrier'),
(3, 'mars'),
(4, 'avril'),
(5, 'mai'),
(6, 'juin'),
(7, 'juillet'),
(8, 'Aout'),
(9, 'septembre'),
(10, 'octobre'),
(11, 'novembre'),
(12, 'decembre');

-- --------------------------------------------------------

--
-- Structure de la table `paiment_dette`
--

CREATE TABLE `paiment_dette` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `commande` int(11) NOT NULL,
  `montant` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiment_dette`
--

INSERT INTO `paiment_dette` (`id`, `dates`, `commande`, `montant`, `supprimer`) VALUES
(1, '2025-05-14', 9, 23, 0),
(2, '2025-05-14', 9, 20000, 0),
(3, '2025-05-14', 9, 254477, 0),
(4, '2025-05-14', 12, 500, 0),
(5, '2025-05-14', 19, 336000, 0);

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
(17, 5, 'essence', '', 12, 80000, 0),
(18, 19, 'mazout', 'litre', 56, 6000, 0),
(19, 20, 'essence', 'litre', 23, 1, 0),
(21, 20, 'essence', 'fut', 2, 200, 0),
(22, 20, 'mazout', 'fut', 0.5, 250, 0),
(23, 22, 'essence', 'fut', 1, 200, 0),
(24, 23, 'essence', 'fut', 200, 200, 0),
(25, 24, 'essence', 'fut', 1, 200, 0),
(26, 25, 'essence', 'fut', 1, 200, 0);

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
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `matricule` varchar(15) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `prenom` text NOT NULL,
  `photo` text NOT NULL,
  `genre` varchar(1) NOT NULL,
  `telephone` text NOT NULL,
  `fonction` text NOT NULL,
  `salaire` double NOT NULL,
  `date_embauche` date NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`matricule`, `nom`, `postnom`, `prenom`, `photo`, `genre`, `telephone`, `fonction`, `salaire`, `date_embauche`, `supprimer`) VALUES
('AG-0001', 'kambale', 'kamala', 'albert', '1746983396.jpg', 'M', '0977139499', 'gerant', 200, '2025-05-11', 0),
('AG-0002', 'kambale', 'Kilima', 'julien', '1747049990.jpg', 'M', '0977134499', 'comptable', 150, '2025-05-12', 0);

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
(4, '2025-04-28', 5500, 6000, 80000, 300000, 0),
(5, '2025-05-09', 1, 1.2, 200, 250, 0);

-- --------------------------------------------------------

--
-- Structure de la table `remuneration`
--

CREATE TABLE `remuneration` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `personnel` text NOT NULL,
  `montant` double NOT NULL,
  `mois` int(11) NOT NULL,
  `annee` year(4) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `remuneration`
--

INSERT INTO `remuneration` (`id`, `dates`, `personnel`, `montant`, `mois`, `annee`, `supprimer`) VALUES
(1, '2025-05-12', 'AG-0001', 40, 1, '2025', 0),
(2, '2025-05-12', 'AG-0001', 150, 1, '2025', 0),
(3, '2025-05-12', 'AG-0001', 8, 1, '2025', 0),
(4, '2025-05-12', 'AG-0001', 2, 1, '2025', 0),
(5, '2025-05-12', 'AG-0002', 150, 1, '2025', 0),
(6, '2025-05-12', 'AG-0002', 150, 2, '2025', 0),
(7, '2025-05-12', 'AG-0002', 150, 3, '2025', 0),
(8, '2025-05-12', 'AG-0002', 150, 4, '2025', 0),
(9, '2025-05-12', 'AG-0002', 50, 5, '2025', 0),
(11, '2025-05-12', 'AG-0001', 200, 2, '2025', 0),
(12, '2025-05-12', 'AG-0001', 100, 3, '2025', 0);

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
(3, 'kambale', 'kamala', 'albert', 'gerant', '1745404332.jpg', 'albertkamala.@me.drc', '0101', 0),
(4, 'muhindo', 'kombi', 'jospin', 'comptable', '1747163126.jpg', 'jospinkombi.@me.drc', '0101', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bondesortie`
--
ALTER TABLE `bondesortie`
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
-- Index pour la table `mois`
--
ALTER TABLE `mois`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiment_dette`
--
ALTER TABLE `paiment_dette`
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
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`matricule`);

--
-- Index pour la table `prix`
--
ALTER TABLE `prix`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `remuneration`
--
ALTER TABLE `remuneration`
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
-- AUTO_INCREMENT pour la table `bondesortie`
--
ALTER TABLE `bondesortie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
-- AUTO_INCREMENT pour la table `mois`
--
ALTER TABLE `mois`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `paiment_dette`
--
ALTER TABLE `paiment_dette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `panier_ap`
--
ALTER TABLE `panier_ap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `prix`
--
ALTER TABLE `prix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `remuneration`
--
ALTER TABLE `remuneration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
