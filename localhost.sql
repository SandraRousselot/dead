-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 16 sep. 2021 à 15:23
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `anabase`
--
CREATE DATABASE IF NOT EXISTS `anabase` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `anabase`;

-- --------------------------------------------------------

--
-- Structure de la table `ACTIVITE`
--

CREATE TABLE `ACTIVITE` (
  `NUM_ACTIVITE` int(2) NOT NULL,
  `NOM_ACTIVITE` char(32) DEFAULT NULL,
  `DATE_ACTIVITE` date DEFAULT NULL,
  `HEURE_ACTIVITE` time DEFAULT NULL,
  `PRIX_ACTIVITE` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `CONGRESSISTE`
--

CREATE TABLE `CONGRESSISTE` (
  `NUM_CONGRESSISTE` int(2) NOT NULL,
  `NUM_ORGANISME` int(2) DEFAULT NULL,
  `NUM_HOTEL` int(2) DEFAULT NULL,
  `NOM_CONGRESSISTE` char(32) DEFAULT NULL,
  `PRENOM_CONGRESSISTE` char(32) DEFAULT NULL,
  `ADRESSE_CONGRESSISTE` char(50) DEFAULT NULL,
  `TEL_CONGRESSISTE` char(10) DEFAULT NULL,
  `DATE_INSCRIPTION` date DEFAULT NULL,
  `CODE_ACCOMPAGNATEUR` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `FACTURE`
--

CREATE TABLE `FACTURE` (
  `NUM_FACTURE` int(2) NOT NULL,
  `NUM_CONGRESSISTE` int(2) NOT NULL,
  `DATE_FACTURE` date DEFAULT NULL,
  `CODE_REGLEMENT` tinyint(1) DEFAULT NULL,
  `MONTANT_FACTURE` bigint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `HOTEL`
--

CREATE TABLE `HOTEL` (
  `NUM_HOTEL` int(2) NOT NULL,
  `NOM_HOTEL` char(32) DEFAULT NULL,
  `ADRESSE_HOTEL` char(50) DEFAULT NULL,
  `NOMBRE_ETOILES` smallint(1) DEFAULT NULL,
  `PRIX_PARTICIPANT` int(2) DEFAULT NULL,
  `PRIX_SUPPL` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ORGANISME_PAYEUR`
--

CREATE TABLE `ORGANISME_PAYEUR` (
  `NUM_ORGANISME` int(2) NOT NULL,
  `NOM_ORGANISME` char(32) DEFAULT NULL,
  `ADRESSE_ORGANISME` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `PARTICIPATION_SESSION`
--

CREATE TABLE `PARTICIPATION_SESSION` (
  `NUM_CONGRESSISTE` int(2) NOT NULL,
  `NUM_SESSION` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `REL_1`
--

CREATE TABLE `REL_1` (
  `NUM_CONGRESSISTE` int(2) NOT NULL,
  `NUM_ACTIVITE` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `SESSION`
--

CREATE TABLE `SESSION` (
  `NUM_SESSION` int(2) NOT NULL,
  `DATE_SESSION` date DEFAULT NULL,
  `HEURE_SESSION` time DEFAULT NULL,
  `PRIX_SESSION` int(2) DEFAULT NULL,
  `NOM_SESSION` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ACTIVITE`
--
ALTER TABLE `ACTIVITE`
  ADD PRIMARY KEY (`NUM_ACTIVITE`);

--
-- Index pour la table `CONGRESSISTE`
--
ALTER TABLE `CONGRESSISTE`
  ADD PRIMARY KEY (`NUM_CONGRESSISTE`),
  ADD KEY `I_FK_CONGRESSISTE_ORGANISME_PAYEUR` (`NUM_ORGANISME`),
  ADD KEY `I_FK_CONGRESSISTE_HOTEL` (`NUM_HOTEL`);

--
-- Index pour la table `FACTURE`
--
ALTER TABLE `FACTURE`
  ADD PRIMARY KEY (`NUM_FACTURE`),
  ADD UNIQUE KEY `I_FK_FACTURE_CONGRESSISTE` (`NUM_CONGRESSISTE`);

--
-- Index pour la table `HOTEL`
--
ALTER TABLE `HOTEL`
  ADD PRIMARY KEY (`NUM_HOTEL`);

--
-- Index pour la table `ORGANISME_PAYEUR`
--
ALTER TABLE `ORGANISME_PAYEUR`
  ADD PRIMARY KEY (`NUM_ORGANISME`);

--
-- Index pour la table `PARTICIPATION_SESSION`
--
ALTER TABLE `PARTICIPATION_SESSION`
  ADD PRIMARY KEY (`NUM_CONGRESSISTE`,`NUM_SESSION`),
  ADD KEY `I_FK_PARTICIPATION_SESSION_CONGRESSISTE` (`NUM_CONGRESSISTE`),
  ADD KEY `I_FK_PARTICIPATION_SESSION_SESSION` (`NUM_SESSION`);

--
-- Index pour la table `REL_1`
--
ALTER TABLE `REL_1`
  ADD PRIMARY KEY (`NUM_CONGRESSISTE`,`NUM_ACTIVITE`),
  ADD KEY `I_FK_REL_1_CONGRESSISTE` (`NUM_CONGRESSISTE`),
  ADD KEY `I_FK_REL_1_ACTIVITE` (`NUM_ACTIVITE`);

--
-- Index pour la table `SESSION`
--
ALTER TABLE `SESSION`
  ADD PRIMARY KEY (`NUM_SESSION`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `CONGRESSISTE`
--
ALTER TABLE `CONGRESSISTE`
  ADD CONSTRAINT `congressiste_ibfk_1` FOREIGN KEY (`NUM_ORGANISME`) REFERENCES `ORGANISME_PAYEUR` (`NUM_ORGANISME`),
  ADD CONSTRAINT `congressiste_ibfk_2` FOREIGN KEY (`NUM_HOTEL`) REFERENCES `HOTEL` (`NUM_HOTEL`);

--
-- Contraintes pour la table `FACTURE`
--
ALTER TABLE `FACTURE`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`NUM_CONGRESSISTE`) REFERENCES `CONGRESSISTE` (`NUM_CONGRESSISTE`);

--
-- Contraintes pour la table `PARTICIPATION_SESSION`
--
ALTER TABLE `PARTICIPATION_SESSION`
  ADD CONSTRAINT `participation_session_ibfk_1` FOREIGN KEY (`NUM_CONGRESSISTE`) REFERENCES `CONGRESSISTE` (`NUM_CONGRESSISTE`),
  ADD CONSTRAINT `participation_session_ibfk_2` FOREIGN KEY (`NUM_SESSION`) REFERENCES `SESSION` (`NUM_SESSION`);

--
-- Contraintes pour la table `REL_1`
--
ALTER TABLE `REL_1`
  ADD CONSTRAINT `rel_1_ibfk_1` FOREIGN KEY (`NUM_CONGRESSISTE`) REFERENCES `CONGRESSISTE` (`NUM_CONGRESSISTE`),
  ADD CONSTRAINT `rel_1_ibfk_2` FOREIGN KEY (`NUM_ACTIVITE`) REFERENCES `ACTIVITE` (`NUM_ACTIVITE`);
--
-- Base de données : `arbitres`
--
CREATE DATABASE IF NOT EXISTS `arbitres` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `arbitres`;

-- --------------------------------------------------------

--
-- Structure de la table `arbitre`
--

CREATE TABLE `arbitre` (
  `num_arbitre` int(11) NOT NULL,
  `nom_arbitre` varchar(255) NOT NULL,
  `prenom_arbitre` varchar(255) NOT NULL,
  `adresse_arbitre` varchar(255) NOT NULL,
  `cp_arbitre` int(5) NOT NULL,
  `ville_arbitre` varchar(255) NOT NULL,
  `date_naiss_arbitre` date NOT NULL,
  `tel_fixe_arbitre` varchar(255) NOT NULL,
  `tel_port_arbitre` varchar(255) NOT NULL,
  `mail_arbitre` varchar(255) NOT NULL,
  `num_club` int(11) NOT NULL,
  `num_equipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `arbitre`
--

INSERT INTO `arbitre` (`num_arbitre`, `nom_arbitre`, `prenom_arbitre`, `adresse_arbitre`, `cp_arbitre`, `ville_arbitre`, `date_naiss_arbitre`, `tel_fixe_arbitre`, `tel_port_arbitre`, `mail_arbitre`, `num_club`, `num_equipe`) VALUES
(1, 'Rodrigues', 'Anthony', '8 cité de l\'amphitéatre', 87000, 'Limoges', '0000-00-00', '0473589851', '0651896652', 'Anthonyoutub@gmail.com', 1, 1),
(2, 'Rousselot', 'Sandra', '15 cité de l\'amphithéâtre', 87000, 'Limoges', '2001-04-10', '0473896220', '0652415699', 'sandra.rousselot@gmail.com', 1, 2),
(3, 'Bourgeois', 'Agnes', '12 rue des requêtes SQL', 87000, 'Limoges', '2021-04-01', '0473525541', '0651896652', 'agnes.bourgeois@gmail.com', 2, 3),
(4, 'Bogusz', 'Thierry', '18 rue de l\'orienté objet', 87000, 'Limoges', '2021-04-06', '0473526585', '0652748963', 'thierry.boguse@gmail.com', 2, 4),
(5, 'Hippolyte', 'Banneret ', '78 rue des chandiots', 63100, 'Clermont-Ferrand', '2021-02-09', '0473698541', '0651225241', 'bertrand.didier@gmail.com', 3, 5),
(6, 'Aphrodite', 'Stanley', '48 rue des chandiots', 63000, 'Clermont-Ferrand', '2021-04-13', '0473698541', '0687452214', 'aphrodite.stanley@gmail.com', 3, 6);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `num_categorie` int(11) NOT NULL,
  `nom_categorie` varchar(255) NOT NULL,
  `montant_indemnite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`num_categorie`, `nom_categorie`, `montant_indemnite`) VALUES
(1, 'Minime', 15),
(2, 'Cadet', 20),
(3, 'Senior', 20);

-- --------------------------------------------------------

--
-- Structure de la table `championnat`
--

CREATE TABLE `championnat` (
  `num_championnat` int(11) NOT NULL,
  `nom_championnat` varchar(255) NOT NULL,
  `num_categorie` int(11) NOT NULL,
  `num_division` int(11) NOT NULL,
  `num_type_championnat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `championnat`
--

INSERT INTO `championnat` (`num_championnat`, `nom_championnat`, `num_categorie`, `num_division`, `num_type_championnat`) VALUES
(4, 'Championnat', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE `club` (
  `num_club` int(11) NOT NULL,
  `nom_club` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `club`
--

INSERT INTO `club` (`num_club`, `nom_club`) VALUES
(1, 'Club Etudiants'),
(2, 'Club des Professeurs'),
(3, 'Clermontois');

-- --------------------------------------------------------

--
-- Structure de la table `deplacement`
--

CREATE TABLE `deplacement` (
  `num_arbitre` int(11) NOT NULL,
  `num_salle` int(11) NOT NULL,
  `distance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `deplacement`
--

INSERT INTO `deplacement` (`num_arbitre`, `num_salle`, `distance`) VALUES
(5, 1, 200),
(6, 1, 300);

-- --------------------------------------------------------

--
-- Structure de la table `division`
--

CREATE TABLE `division` (
  `num_division` int(11) NOT NULL,
  `nom_division` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `division`
--

INSERT INTO `division` (`num_division`, `nom_division`) VALUES
(1, 'Masculin'),
(2, 'Féminin');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `num_equipe` int(11) NOT NULL,
  `num_club` int(11) NOT NULL,
  `nom_equipe` varchar(255) NOT NULL,
  `num_championnat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`num_equipe`, `num_club`, `nom_equipe`, `num_championnat`) VALUES
(1, 1, 'les Martins-Pêcheurs Argentés', 1),
(2, 1, 'les Dindons', 1),
(3, 2, 'les Coureurs Hantés\r\n', 1),
(4, 2, 'les Remarquables', 1),
(5, 3, 'les Zombis Fâchés\r\n', 1),
(6, 3, 'les Rouges\r\n', 1);

-- --------------------------------------------------------

--
-- Structure de la table `indisponibilite`
--

CREATE TABLE `indisponibilite` (
  `num_arbitre` int(11) NOT NULL,
  `date_jour` date NOT NULL,
  `code_demi_jour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `match`
--

CREATE TABLE `match` (
  `num_match` int(11) NOT NULL,
  `num_salle` int(11) NOT NULL,
  `date_match` date NOT NULL,
  `heure_match` time NOT NULL,
  `num_equipe_1` int(11) NOT NULL,
  `num_equipe_2` int(11) NOT NULL,
  `num_arbitre_p` int(11) NOT NULL,
  `num_arbitre_s` int(11) NOT NULL,
  `montant_deplt_p` int(11) NOT NULL,
  `montant_deplt_s` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `match`
--

INSERT INTO `match` (`num_match`, `num_salle`, `date_match`, `heure_match`, `num_equipe_1`, `num_equipe_2`, `num_arbitre_p`, `num_arbitre_s`, `montant_deplt_p`, `montant_deplt_s`) VALUES
(2, 1, '2021-04-25', '10:00:00', 1, 2, 5, 6, 12, 12);

-- --------------------------------------------------------

--
-- Structure de la table `parametre`
--

CREATE TABLE `parametre` (
  `num_param` int(11) NOT NULL,
  `montant_km` int(11) NOT NULL,
  `mail_responsable` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `num_salle` int(11) NOT NULL,
  `adresse_salle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`num_salle`, `adresse_salle`) VALUES
(1, '99, rue des Dunes'),
(2, '33, rue Sadi Carnot\r\n'),
(3, '7, Rue du Limas\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `type_championnat`
--

CREATE TABLE `type_championnat` (
  `num_type_championnat` int(11) NOT NULL,
  `nom_type_championnat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_championnat`
--

INSERT INTO `type_championnat` (`num_type_championnat`, `nom_type_championnat`) VALUES
(1, 'Excellence Régionale'),
(2, 'Honneur'),
(3, 'Promotion d\'Excellence Régionale');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `mot_de_passe`, `role`) VALUES
(1, 'Anthony', '123', 2),
(2, 'Sandra', '123', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `arbitre`
--
ALTER TABLE `arbitre`
  ADD PRIMARY KEY (`num_arbitre`,`num_club`,`num_equipe`) USING BTREE;

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`num_categorie`);

--
-- Index pour la table `championnat`
--
ALTER TABLE `championnat`
  ADD PRIMARY KEY (`num_championnat`);

--
-- Index pour la table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`num_club`);

--
-- Index pour la table `deplacement`
--
ALTER TABLE `deplacement`
  ADD PRIMARY KEY (`num_arbitre`,`num_salle`);

--
-- Index pour la table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`num_division`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`num_equipe`);

--
-- Index pour la table `indisponibilite`
--
ALTER TABLE `indisponibilite`
  ADD PRIMARY KEY (`num_arbitre`);

--
-- Index pour la table `match`
--
ALTER TABLE `match`
  ADD PRIMARY KEY (`num_match`);

--
-- Index pour la table `parametre`
--
ALTER TABLE `parametre`
  ADD PRIMARY KEY (`num_param`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`num_salle`);

--
-- Index pour la table `type_championnat`
--
ALTER TABLE `type_championnat`
  ADD PRIMARY KEY (`num_type_championnat`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `arbitre`
--
ALTER TABLE `arbitre`
  MODIFY `num_arbitre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `num_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `championnat`
--
ALTER TABLE `championnat`
  MODIFY `num_championnat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `club`
--
ALTER TABLE `club`
  MODIFY `num_club` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `division`
--
ALTER TABLE `division`
  MODIFY `num_division` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `num_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `indisponibilite`
--
ALTER TABLE `indisponibilite`
  MODIFY `num_arbitre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `match`
--
ALTER TABLE `match`
  MODIFY `num_match` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `parametre`
--
ALTER TABLE `parametre`
  MODIFY `num_param` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `num_salle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_championnat`
--
ALTER TABLE `type_championnat`
  MODIFY `num_type_championnat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Base de données : `club_photo`
--
CREATE DATABASE IF NOT EXISTS `club_photo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `club_photo`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id_arti` int(11) NOT NULL,
  `titre_arti` varchar(50) NOT NULL,
  `date_arti` date NOT NULL,
  `texte_arti` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_arti`, `titre_arti`, `date_arti`, `texte_arti`, `id_user`, `id_type`) VALUES
(1, 'André Bauchant', '2021-03-09', 'Volutpat blandit aliquam', 1, 1),
(2, 'André Bauchant', '2021-03-09', 'Volutpat blandit aliquam', 1, 1),
(3, 'André Bauchant', '2021-03-09', 'Volutpat blandit aliquam', 1, 1),
(4, 'André Bauchant', '2021-03-09', 'Volutpat blandit aliquam', 1, 1),
(5, 'André Bauchant', '2021-03-09', 'Volutpat blandit aliquam', 1, 1),
(6, 'André Bauchant', '2021-03-09', 'Volutpat blandit aliquam', 1, 1),
(7, 'Séraphine Louis', '2021-03-06', 'Volutpat blandit aliquam', 1, 1),
(11, 'Ivan Generalic', '2021-03-06', 'Volutpat blandit aliquam', 1, 2),
(10, 'Ivan Generalic', '2021-03-06', 'Volutpat blandit aliquam', 1, 2),
(9, 'Séraphine Louis', '2021-03-06', 'Volutpat blandit aliquam', 1, 1),
(8, 'Séraphine Louis', '2021-03-06', 'Volutpat blandit aliquam', 1, 1),
(12, 'Ivan Generalic', '2021-03-06', 'Volutpat blandit aliquam', 1, 2),
(13, 'Ivan Generalic', '2021-03-06', 'Volutpat blandit aliquam', 1, 2),
(14, 'André Normil', '2021-03-06', 'Volutpat blandit aliquam', 1, 3),
(15, 'André Normil', '2021-03-06', 'Volutpat blandit aliquam', 1, 3),
(16, 'André Normil', '2021-03-06', 'Volutpat blandit aliquam', 1, 3),
(17, 'André Normil', '2021-03-06', 'Volutpat blandit aliquam', 1, 3),
(18, 'Hector Hyppolite', '2021-03-06', 'Volutpat blandit aliquam', 1, 3),
(19, 'Hector Hyppolite', '2021-03-06', 'Volutpat blandit aliquam', 1, 3),
(20, 'Hector Hyppolite', '2021-03-06', 'Volutpat blandit aliquam', 1, 3),
(21, 'Inconnu', '2021-03-06', 'Volutpat blandit aliquam', 1, 4),
(22, 'Inconnu', '2021-03-06', 'Volutpat blandit aliquam', 1, 4),
(23, 'Inconnu', '2021-03-06', 'Volutpat blandit aliquam', 1, 4),
(24, 'Inconnu', '2021-03-06', 'Volutpat blandit aliquam', 1, 4),
(25, 'Inconnu', '2021-03-06', 'Volutpat blandit aliquam', 1, 4),
(26, 'Inconnu', '2021-03-06', 'Volutpat blandit aliquam', 1, 4),
(27, 'Inconnu', '2021-03-06', 'Volutpat blandit aliquam', 1, 4),
(28, 'Inconnu', '2021-03-06', 'Volutpat blandit aliquam', 1, 4),
(29, 'Beaucoup trop t\'amour...', '2021-03-07', '<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Chaque sentiment nous guide vers l&rsquo;&eacute;criture,</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Amour avec un grand &Agrave;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Mais qui d&eacute;signe seulement Attard&eacute;&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;; min-height: 15px;\">&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">A celui qui croit en l&rsquo;amour&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">&Eacute;ternel ne l&rsquo;est jamais&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Croit moi il te replacera&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Comme tu l&rsquo;avais pr&eacute;c&eacute;dent remplacer&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;; min-height: 15px;\">&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Aucun rime, rien non plus rien,</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Comme mon c&oelig;ur en pensant,</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Notre c&oelig;ur ne r&eacute;fl&eacute;chis pas,&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Il nous fait subir</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;; min-height: 15px;\">&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Tout les d&eacute;sirs de l&rsquo;autre aimant</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Par la, par ici.</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Son c&oelig;ur semment l&rsquo;amour&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Que tu lui avais donn&eacute;.</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;; min-height: 15px;\">&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Jai pas besoin de cette amour,&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Qui m&rsquo;empestera un jour,</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Par piti&eacute; laisser moi &eacute;crire encore un peu</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">D&eacute;truire mes derni&egrave;re et espoir&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Pour &eacute;crire mes nouvelles lignes</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;; min-height: 15px;\">&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Lui est parti, l&rsquo;autre aussi&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">L&rsquo;un pour lui et l&rsquo;autre pour lui&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Lui c&rsquo;est l&rsquo;autre et l&rsquo;autre c&rsquo;est son prochain&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Faut t&rsquo;il aider son prochain ?&nbsp;</p>\r\n<p style=\"margin: 0px; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;\">Il doit nous aider.</p>', 1, 5),
(30, 'amour', '2021-03-07', 'Volutpat blandit aliquam', 1, 5),
(31, 'amour', '2021-03-07', '', 1, 5),
(32, 'amour', '2021-03-07', '', 1, 5),
(33, 'amour', '2021-03-07', '', 1, 5),
(34, 'depress', '2021-03-06', '', 1, 5),
(35, 'amour', '2021-03-07', '', 1, 5),
(49, 'zebre', '2021-03-06', '', 1, 5),
(48, 'zebre', '2021-03-06', '', 1, 5),
(47, 'zebre', '2021-03-06', '', 1, 5),
(46, 'zebre', '2021-03-06', '', 1, 5),
(45, 'zebre', '2021-03-06', '', 1, 5),
(38, 'depress', '2021-03-06', '', 1, 5),
(37, 'depress', '2021-03-06', '', 1, 5),
(36, 'depress', '2021-03-06', '', 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `id_photo` int(11) NOT NULL,
  `titre_photo` varchar(50) NOT NULL,
  `texte_photo` varchar(255) NOT NULL,
  `id_arti` int(11) NOT NULL,
  `photos` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id_photo`, `titre_photo`, `texte_photo`, `id_arti`, `photos`) VALUES
(5, 'André Bauchant', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', 1, 'ab1.jpg'),
(6, 'André Bauchant', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 2, 'ab2.jpg'),
(7, 'André Bauchant', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', 3, 'ab3.jpg'),
(8, 'André Bauchant', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 4, 'ab4.jpg'),
(9, 'André Bauchant', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', 5, 'ab5d.jpg'),
(10, 'André Bauchant', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 6, 'ab6e.jpg'),
(13, 'Séraphine Louis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', 8, 'se2.jpg'),
(12, 'Séraphine Louis', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 7, 'se1.jpg'),
(14, 'Séraphine Louis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', 9, 'se3.jpg'),
(15, 'Ivan Generalic', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 10, 'ig1.jpg'),
(16, 'Ivan Generalic', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 11, 'ig2.jpg'),
(17, 'Ivan Generalic', 'Volutpat blandit aliquam etiam erat velit scelerisque in. Nascetur ridiculus mus mauris vitae. Pharetra et ultrices neque ornare. In est ante in nibh mauris cursus. Platea dictumst quisque sagittis purus sit amet volutpat consequat', 12, 'ig3.jpg'),
(18, 'Ivan Generalic', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 13, 'ig4.jpg'),
(19, 'André Normil', 'Volutpat blandit aliquam etiam erat velit scelerisque in. Nascetur ridiculus mus mauris vitae. Pharetra et ultrices neque ornare. In est ante in nibh mauris cursus. Platea dictumst quisque sagittis purus sit amet volutpat consequat', 14, 'an1.jpg'),
(20, 'André Normil', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 15, 'an2.jpg'),
(21, 'André Normil', 'Volutpat blandit aliquam etiam erat velit scelerisque in. Nascetur ridiculus mus mauris vitae. Pharetra et ultrices neque ornare. In est ante in nibh mauris cursus. Platea dictumst quisque sagittis purus sit amet volutpat consequat', 16, 'an3.jpg'),
(22, 'André Normil', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 17, 'an4.jpg'),
(23, 'Hector Hyppolite', 'Volutpat blandit aliquam etiam erat velit scelerisque in. Nascetur ridiculus mus mauris vitae. Pharetra et ultrices neque ornare. In est ante in nibh mauris cursus. Platea dictumst quisque sagittis purus sit amet volutpat consequat', 18, 'hh1.jpg'),
(24, 'Hector Hyppolite', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 19, 'hh2.jpg'),
(25, 'Hector Hyppolite', 'Volutpat blandit aliquam etiam erat velit scelerisque in. Nascetur ridiculus mus mauris vitae. Pharetra et ultrices neque ornare. In est ante in nibh mauris cursus. Platea dictumst quisque sagittis purus sit amet volutpat consequat', 20, 'hh3.jpg'),
(26, 'Inconnu', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 21, '1.jpg'),
(27, 'Inconnu', 'Volutpat blandit aliquam etiam erat velit scelerisque in. Nascetur ridiculus mus mauris vitae. Pharetra et ultrices neque ornare. In est ante in nibh mauris cursus. Platea dictumst quisque sagittis purus sit amet volutpat consequat', 22, '2.jpg'),
(28, 'Inconnu', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 23, '3.jpg'),
(29, 'Inconnu', 'Volutpat blandit aliquam etiam erat velit scelerisque in. Nascetur ridiculus mus mauris vitae. Pharetra et ultrices neque ornare. In est ante in nibh mauris cursus. Platea dictumst quisque sagittis purus sit amet volutpat consequat', 24, '4.jpg'),
(30, 'Inconnu', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 25, '5.jpg'),
(31, 'Inconnu', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 26, '6.jpg'),
(32, 'Inconnu', 'Volutpat blandit aliquam etiam erat velit scelerisque in. Nascetur ridiculus mus mauris vitae. Pharetra et ultrices neque ornare. In est ante in nibh mauris cursus. Platea dictumst quisque sagittis purus sit amet volutpat consequat', 27, '7.jpg'),
(33, 'Inconnu', 'scing elit ut aliquam purus sit. Gravida rutrum quisque non tellus orci. Neque gravida in fermentum et sollicitudin ac. Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Sit amet venenatis urna cursus eget. ', 28, '8.jpg'),
(34, 'amour', 'ceci est un test ceci est un test ceci est un test', 29, 'perso/love_ballon.gif'),
(35, 'amour', 'ceci est un test ceci est un test ceci est un test', 30, 'perso/love_bouche.gif'),
(36, 'amour', 'ceci est un test ceci est un test ceci est un test', 31, 'perso/love_bouquet.gif'),
(37, 'amour', 'ceci est un test ceci est un test ceci est un test', 32, 'perso/love_coeur.gif'),
(38, 'amour', 'ceci est un test ceci est un test ceci est un test', 33, 'perso/love_lumiere.gif'),
(39, 'zebre', 'ceci est un test ceci est un test ceci est un test', 34, 'perso/zebre_oeil.gif'),
(40, 'amour', 'ceci est un test ceci est un test ceci est un test', 35, 'perso/love_oreil.gif'),
(44, 'zebre', '', 45, 'perso/zebre_nage.gif'),
(41, 'depress', '', 36, 'perso/depress_clope.gif'),
(42, 'depress', '', 37, 'perso/depress_melon.gif'),
(43, 'depress', '', 38, 'perso/depress_pleure.gif'),
(45, 'zebre', '', 49, 'perso/zebre_manger.gif'),
(46, 'zebre', '', 46, 'perso/zebre_main.gif'),
(47, 'zebre', '', 47, 'perso/zebre_drug.gif'),
(48, 'zebre', '', 48, 'perso/zebre_cerveau.gif'),
(59, 'Test', 'Test test', 1, 'hellotest.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `nom_type` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id_type`, `nom_type`) VALUES
(1, 'Art naïfs en France'),
(2, 'Art naïfs des pays de l\'Est'),
(3, 'Art naïfs haïtiens'),
(4, 'Art naïfs du monde'),
(5, 'Art naïfs personnel');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom_user` varchar(50) NOT NULL,
  `prenom_user` varchar(50) DEFAULT NULL,
  `mdp_user` varchar(255) NOT NULL,
  `mail_user` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom_user`, `prenom_user`, `mdp_user`, `mail_user`) VALUES
(1, 'Anthony', 'Rodrigues', '$2y$10$0wDDmDQufknIUQAKlgMCeeAyftHxSCFD8qZ/7WQhxXfDKmi8pSXTi', 'Anthonyoutub@gmail.com'),
(12, 'b', 'b', '$2y$10$Xr4zke6.5Ty2vMFToT7XseUurB/e.uykd5ZDArEpivLjD3Tn3HwoS', 'b@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_arti`) USING BTREE;

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id_photo`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id_arti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Base de données : `gestion_boutique`
--
CREATE DATABASE IF NOT EXISTS `gestion_boutique` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gestion_boutique`;

-- --------------------------------------------------------

--
-- Structure de la table `atelier`
--

CREATE TABLE `atelier` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `atelier`
--

INSERT INTO `atelier` (`id`, `nom`) VALUES
(1, 'Boucherie'),
(2, 'Charcutier Traiteur'),
(3, 'Cuisine CFA'),
(4, 'Cuisine GRETA'),
(5, 'Cuisine Lycee'),
(6, 'Emballages'),
(7, 'Patisserie Boulangerie');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_client`
--

CREATE TABLE `categorie_client` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie_client`
--

INSERT INTO `categorie_client` (`id`, `nom`) VALUES
(1, 'Elèves'),
(2, 'Profs'),
(3, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `nom`) VALUES
(1, 'Non renseigné'),
(2, 'BTS2'),
(3, 'BTS3');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `ville`, `telephone`, `mail`, `id_categorie`) VALUES
(1, 'ROUSSELOT', 'Sandra', 'HHH', 'HHH', '', 1),
(3, 'LILOU', 'ROBI', 'RRR', 'RRR', 'RRR', 1),
(4, 'CHINOIS', 'Tahiti', 'Tahiti', '', 'RRR@RRR', 1),
(5, 'coucou', 'vous', 'Marakech', '4567898765', 'kLIUYTR@fdckyGJF', 1),
(6, 'BIZOUUU', 'Patrique', 'Nantes', '0123456789', '12345patrique@BIZBIZ', 2),
(7, 'RODRIGUES', 'anthony', 'dtrytf', '', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id` int(11) NOT NULL,
  `id_moyen_reglement` int(11) DEFAULT NULL,
  `id_client` int(11) NOT NULL,
  `date` date NOT NULL,
  `date_reglement` date DEFAULT NULL,
  `total` float NOT NULL,
  `etat_annulation` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id`, `id_moyen_reglement`, `id_client`, `date`, `date_reglement`, `total`, `etat_annulation`) VALUES
(432, 1, 1, '2021-06-21', '2021-06-24', 38, 0),
(435, 1, 1, '2021-06-24', '2021-09-16', 0, 1),
(436, 3, 5, '2021-06-25', '2021-06-25', 50.2, 0),
(437, 1, 7, '2021-08-31', '2021-08-31', 11, 0),
(438, 0, 1, '2021-09-16', NULL, 12.2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `famille_produit`
--

CREATE TABLE `famille_produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `famille_produit`
--

INSERT INTO `famille_produit` (`id`, `nom`) VALUES
(1, 'Plats cuisinés avec garniture'),
(2, 'Plats cuisinés sans garniture'),
(3, 'Divers'),
(4, 'Charcuterie à cuire'),
(5, 'Entrées froides'),
(6, 'Pâtisserie charcutière'),
(7, 'Garniture'),
(8, 'Plat complet traditionnel'),
(9, 'Plat cuisiné festif '),
(10, 'Potage'),
(11, 'Petits fours'),
(12, 'Pâtisserie'),
(13, 'Boulangerie'),
(14, 'Confiserie'),
(15, 'Charcuterie cuite');

-- --------------------------------------------------------

--
-- Structure de la table `mode_reglement`
--

CREATE TABLE `mode_reglement` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `mode_reglement`
--

INSERT INTO `mode_reglement` (`id`, `nom`) VALUES
(0, 'Non réglé'),
(1, 'Carte Bancaire'),
(2, 'Chèque'),
(3, 'Espèce');

-- --------------------------------------------------------

--
-- Structure de la table `production`
--

CREATE TABLE `production` (
  `id` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `id_atelier` int(11) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `temperature` int(11) NOT NULL,
  `date_fabrication` varchar(255) NOT NULL,
  `date_peremption` varchar(255) NOT NULL,
  `quantite` float NOT NULL,
  `conditionnement` int(11) NOT NULL,
  `etat_congelation` tinyint(1) DEFAULT NULL,
  `date_destruction` varchar(255) DEFAULT NULL,
  `etat_affichage` tinyint(1) DEFAULT '1',
  `etat_transfert` int(11) NOT NULL DEFAULT '0',
  `date_transfert` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `production`
--

INSERT INTO `production` (`id`, `id_classe`, `id_produit`, `id_atelier`, `id_prof`, `temperature`, `date_fabrication`, `date_peremption`, `quantite`, `conditionnement`, `etat_congelation`, `date_destruction`, `etat_affichage`, `etat_transfert`, `date_transfert`) VALUES
(149, 1, 189, 1, 1, 1, '24/06/2021', '25/06/2021', 1, 4, NULL, '2021-06-24', 0, 0, NULL),
(150, 2, 190, 5, 3, 3, '24/06/2021', '24/09/2021', 3, 7, NULL, '2021-08-22', 0, 0, NULL),
(151, 1, 191, 2, 1, 1, '24/06/2021', '27/06/2021', 1, 6, NULL, NULL, 0, 0, NULL),
(152, 2, 192, 4, 4, 1, '23/06/2021', '24/06/2021', 1, 1, NULL, '2021-08-22', 0, 0, NULL),
(153, 1, 193, 4, 1, 1, '24/06/2021', '24/09/2021', 1, 1, 1, NULL, 0, 0, NULL),
(154, 1, 194, 2, 1, 1, '25/06/2021', '26/06/2021', 1, 1, NULL, NULL, 0, 0, NULL),
(155, 1, 195, 1, 1, 1, '31/08/2021', '01/09/2021', 1, 1, NULL, NULL, 0, 0, NULL),
(156, 1, 196, 1, 1, 1, '01/09/2021', '01/12/2021', 1, 1, 1, '2021-09-16', 0, 0, NULL),
(157, 1, 197, 2, 1, 1, '02/09/2021', '03/09/2021', 1, 1, NULL, '2021-09-16', 0, 0, NULL),
(158, 1, 198, 1, 1, 1, '03/09/2021', '07/09/2021', 1, 1, NULL, '2021-09-16', 0, 0, NULL),
(159, 1, 199, 1, 1, 1, '16/09/2021', '21/09/2021', 4, 3, NULL, NULL, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `id_famille` int(11) NOT NULL,
  `id_unite` int(11) NOT NULL,
  `denomination` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `etat_affichage` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `id_famille`, `id_unite`, `denomination`, `prix`, `etat_affichage`) VALUES
(189, 1, 1, 'test1', 27, 0),
(190, 11, 1, 'alouette', 7.2, 0),
(191, 1, 1, 'test2', 11, 1),
(192, 12, 1, 'test périmé', 2.2, 0),
(193, 1, 1, 'test DLC', 30, 0),
(194, 1, 1, 'test', 2, 0),
(195, 1, 1, 'Chou', 11, 0),
(196, 1, 1, 'Chou à la crème', 4.2, 0),
(197, 1, 1, 'Tomate Mozarella', 11, 0),
(198, 1, 1, 'Pizza 4 fromages', 10.2, 0),
(199, 1, 1, 'Pizza 4 fromages', 12.2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`id`, `nom`) VALUES
(1, 'Non renseigné'),
(2, 'Prof2'),
(3, 'BIZOUUU'),
(4, 'RODRIGUEZZZZZZZZ');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Utilisateur'),
(2, 'Administrateur'),
(3, 'Madame Pasqualini');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `total_atelier`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `total_atelier` (
`id` int(11)
,`nom` varchar(255)
,`id_facture` int(11)
,`id_production` int(11)
,`prix_total` float
);

-- --------------------------------------------------------

--
-- Structure de la table `type_produit`
--

CREATE TABLE `type_produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `id_famille` int(11) NOT NULL,
  `id_unite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_produit`
--

INSERT INTO `type_produit` (`id`, `nom`, `prix`, `id_famille`, `id_unite`) VALUES
(3, 'Petit sac de transport papier', 0.15, 1, 1),
(4, 'Grand sac de transport papier', 0.25, 1, 1),
(5, 'Charcuterie à cuire à base de porc', 10, 2, 3),
(6, 'Charcuterie cuite : pâté, terrine et galantine de porc', 10, 3, 3),
(7, 'Charcuterie cuite : pâté, terrine et galantine de volaille et lapin', 11, 3, 3),
(8, 'Charcuterie cuite : terrine de poisson et/ou  fruits de mer', 11, 3, 3),
(9, 'Charcuterie cuite : terrine festive', 27, 3, 3),
(10, 'Charcuterie cuite : produits tripiers', 6, 3, 3),
(11, 'Charcuterie cuite : saucisserie', 11, 3, 3),
(12, 'Charcuterie cuite : saucisserie sèche', 8, 3, 3),
(13, 'Entrées froides : poisson fumé', 30, 4, 3),
(14, 'Entrées froides : foie gras de canard', 60, 4, 3),
(15, 'Entrées froides à base de légumes', 1, 4, 2),
(16, 'Entrées froides : poisson froid', 3, 4, 2),
(17, 'Pâtisserie charcutière : quiche simple  et pizza', 1, 5, 2),
(18, 'Pâtisserie charcutière : tourte/quiche prestige', 1.2, 5, 2),
(19, 'Pâtisserie charcutière : crêpes fourrées', 1.5, 5, 2),
(20, 'Pâtisserie charcutière : feuilleté garniture simple', 1, 5, 2),
(21, 'Pâtisserie charcutière : feuilleté garniture plus élaborée', 1.2, 5, 2),
(22, 'Plats cuisinés sans garniture à base de porc, poulet ou dinde', 2, 6, 2),
(23, 'Plats cuisinés sans garniture à base de gibier, canard, lapin, bœuf, veau et agneau(bas morceaux)', 2.1, 6, 2),
(24, 'Plats cuisinés sans garniture à base de morceaux nobles de bœuf , veau et agneau', 2.7, 6, 2),
(25, 'Plats cuisinés sans garniture : poisson en filet ou darne', 2.7, 6, 2),
(26, 'Plats cuisinés sans garniture : poisson en mousseline', 1.5, 6, 2),
(27, 'Garniture à base de féculents', 0.5, 7, 2),
(28, 'Garniture à base de légumes', 0.7, 7, 2),
(29, 'Garniture : gratin', 1, 7, 2),
(30, 'Plat complet traditionnel', 3.5, 8, 2),
(31, 'Plat cuisiné festif', 4.2, 9, 2),
(42, 'Potage à base de légumes', 2, 10, 4),
(43, 'Potage à base de poissons', 3.5, 10, 4),
(44, 'Petits fours : bouchée cocktail salée', 0.5, 11, 1),
(45, 'Petits fours : bouchée cocktail sucrée', 0.5, 11, 1),
(46, 'Pâtisserie simple, un seul appareil', 0.9, 12, 2),
(47, 'Pâtisserie simple, deux appareils', 1, 12, 2),
(48, 'Pâtisserie : gâteau élaboré individuel', 1.8, 12, 2),
(49, ' Pâtisserie : gâteau élaboré,  à partager', 1.7, 12, 2),
(50, 'Pâtisserie : entremets pâtissier individuel ou à partager', 2.4, 12, 2),
(51, 'Pâtisserie : tarte sucrée de base', 1, 12, 2),
(52, 'Pâtisserie : tarte sucrée complexe', 1.2, 12, 2),
(53, 'Pâtisserie : biscuits secs', 8, 12, 3),
(54, 'Boulangerie : pain', 2, 13, 2),
(55, 'Boulangerie : viennoiseries', 0.5, 13, 2),
(56, 'Confiserie : chocolats', 20, 14, 3),
(57, 'Confiserie sans chocolat', 10, 14, 3);

-- --------------------------------------------------------

--
-- Structure de la table `unite`
--

CREATE TABLE `unite` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `unite`
--

INSERT INTO `unite` (`id`, `nom`) VALUES
(1, 'Portion'),
(2, '&nbsp;Kg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'),
(3, '&nbsp;Pièce&nbsp;&nbsp;'),
(4, '&nbsp;Litre');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `mot_de_passe`, `role`) VALUES
(9, 'moi', '$2y$10$sS61oLqwnCg6EzVRQ.VpGua/PBBQN.NpFb9wNiWJKEqxzrcVi5/bW', 1),
(11, 'sa', '$2y$10$mpNfrIVH1Suh1vXnc9sA.uidKa38zAgFYRg2yHIjDJfSysplGmI1K', 3),
(12, 'fdsf', '$2y$10$2r27koP3487bz74ijzLYc.cpT8pxHS3L6N4BqtqGBrqOaMeTUsJ2e', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

CREATE TABLE `vente` (
  `id_facture` int(11) NOT NULL,
  `id_production` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `reservation` int(10) NOT NULL,
  `prix_unitaire` float NOT NULL,
  `prix_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`id_facture`, `id_production`, `quantite`, `reservation`, `prix_unitaire`, `prix_total`) VALUES
(432, 149, 0, 1, 27, 27),
(435, 150, 0, 0, 7.2, 7.2),
(436, 150, 1, 1, 7.2, 7.2),
(432, 151, 0, 1, 11, 11),
(436, 151, 1, 1, 11, 11),
(436, 153, 1, 1, 30, 30),
(436, 154, 1, 1, 2, 2),
(437, 155, 1, 0, 11, 11),
(438, 159, 1, 0, 12.2, 12.2);

-- --------------------------------------------------------

--
-- Structure de la vue `total_atelier`
--
DROP TABLE IF EXISTS `total_atelier`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_atelier`  AS   (select `atelier`.`id` AS `id`,`atelier`.`nom` AS `nom`,`vente`.`id_facture` AS `id_facture`,`vente`.`id_production` AS `id_production`,`vente`.`prix_total` AS `prix_total` from (((`facture` join `vente` on((`vente`.`id_facture` = `facture`.`id`))) join `production` on((`vente`.`id_production` = `production`.`id`))) join `atelier` on((`production`.`id_atelier` = `atelier`.`id`))) where ((`facture`.`date_reglement` is not null) and (`facture`.`date_reglement` between '2010-10-10' and '2034-10-10')))  ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `atelier`
--
ALTER TABLE `atelier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_client`
--
ALTER TABLE `categorie_client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `famille_produit`
--
ALTER TABLE `famille_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mode_reglement`
--
ALTER TABLE `mode_reglement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_produit`
--
ALTER TABLE `type_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `unite`
--
ALTER TABLE `unite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vente`
--
ALTER TABLE `vente`
  ADD PRIMARY KEY (`id_production`,`id_facture`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `atelier`
--
ALTER TABLE `atelier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `categorie_client`
--
ALTER TABLE `categorie_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=439;

--
-- AUTO_INCREMENT pour la table `famille_produit`
--
ALTER TABLE `famille_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `mode_reglement`
--
ALTER TABLE `mode_reglement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `production`
--
ALTER TABLE `production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT pour la table `professeur`
--
ALTER TABLE `professeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_produit`
--
ALTER TABLE `type_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `unite`
--
ALTER TABLE `unite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Base de données : `my_house`
--
CREATE DATABASE IF NOT EXISTS `my_house` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `my_house`;

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `champs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`id`, `nom`, `champs`) VALUES
(0, 'Terminée', ' <span class=\"badge badge-dark\">Terminée</span>'),
(1, 'Disponible', '<span class=\"badge badge-success\">Disponible</span>'),
(2, 'Rachat', ' <span class=\"badge badge-danger\">Indisponible</span>'),
(3, 'Perimée', ' <span class=\"badge badge-warning\">Perimée</span>');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `zone` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `stock_base` int(11) NOT NULL,
  `stock_actuel` int(11) NOT NULL,
  `stock_alerte` int(11) NOT NULL,
  `statut` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `zone`, `nom`, `stock_base`, `stock_actuel`, `stock_alerte`, `statut`, `photo`) VALUES
(1, 1, 'Liquide Vaisselle ', 3, 3, 1, 1, ''),
(2, 1, 'Epoges x4', 2, 14, 1, 1, ''),
(3, 1, 'MicroFibres Chiffons', 2, 1, 0, 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `pseudo`, `password`, `role`) VALUES
(1, 'Anthony', 'Procrastiner63780!', 2),
(2, 'Sandra', 'emmanini', 1);

-- --------------------------------------------------------

--
-- Structure de la table `zone`
--

CREATE TABLE `zone` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `zone`
--

INSERT INTO `zone` (`id`, `nom`) VALUES
(1, 'Cuisine'),
(2, 'Salon'),
(3, 'Salle de bain'),
(4, 'Divers');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `zone`
--
ALTER TABLE `zone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Base de données : `VuesCours`
--
CREATE DATABASE IF NOT EXISTS `VuesCours` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `VuesCours`;

-- --------------------------------------------------------

--
-- Structure de la table `adoption`
--

CREATE TABLE `adoption` (
  `client_id` smallint(5) UNSIGNED NOT NULL,
  `animal_id` smallint(5) UNSIGNED NOT NULL,
  `date_reservation` date NOT NULL,
  `date_adoption` date DEFAULT NULL,
  `prix` decimal(7,2) UNSIGNED NOT NULL,
  `paye` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adoption`
--

INSERT INTO `adoption` (`client_id`, `animal_id`, `date_reservation`, `date_adoption`, `prix`, `paye`) VALUES
(1, 8, '2012-05-21', NULL, '735.00', 1),
(1, 39, '2008-08-17', '2008-08-17', '735.00', 1),
(1, 40, '2008-08-17', '2008-08-17', '735.00', 1),
(2, 3, '2011-03-12', '2011-03-12', '835.00', 1),
(2, 18, '2008-06-04', '2008-06-04', '485.00', 1),
(3, 27, '2009-11-17', '2009-11-17', '200.00', 1),
(4, 26, '2007-02-21', '2007-02-21', '485.00', 1),
(4, 41, '2007-02-21', '2007-02-21', '835.00', 1),
(5, 21, '2009-03-08', '2009-03-08', '200.00', 1),
(6, 16, '2010-01-27', '2010-01-27', '200.00', 1),
(7, 5, '2011-04-05', '2011-04-05', '150.00', 1),
(8, 42, '2008-08-16', '2008-08-16', '735.00', 1),
(9, 38, '2007-02-11', '2007-02-11', '985.00', 1),
(9, 55, '2011-02-13', '2011-02-13', '140.00', 1),
(9, 59, '2012-05-22', NULL, '700.00', 0),
(10, 49, '2010-08-17', '2010-08-17', '140.00', 0),
(11, 32, '2008-08-17', '2010-03-09', '140.00', 1),
(11, 62, '2011-03-01', '2011-03-01', '630.00', 0),
(12, 15, '2012-05-22', NULL, '200.00', 1),
(12, 69, '2007-09-20', '2007-09-20', '10.00', 1),
(12, 75, '2012-05-21', NULL, '10.00', 0),
(13, 57, '2012-01-10', '2012-01-10', '700.00', 1),
(14, 58, '2012-02-25', '2012-02-25', '700.00', 1),
(15, 30, '2008-08-17', '2008-08-17', '735.00', 1);

--
-- Déclencheurs `adoption`
--
DELIMITER $$
CREATE TRIGGER `after_delete_adoption` AFTER DELETE ON `adoption` FOR EACH ROW BEGIN
    UPDATE Animal
    SET disponible = TRUE
    WHERE id = OLD.animal_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_adoption` AFTER INSERT ON `adoption` FOR EACH ROW BEGIN
    UPDATE Animal
    SET disponible = FALSE
    WHERE id = NEW.animal_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_adoption` AFTER UPDATE ON `adoption` FOR EACH ROW BEGIN
    IF OLD.animal_id <> NEW.animal_id THEN
        UPDATE Animal
        SET disponible = TRUE
        WHERE id = OLD.animal_id;

        UPDATE Animal
        SET disponible = FALSE
        WHERE id = NEW.animal_id;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_adoption` BEFORE INSERT ON `adoption` FOR EACH ROW BEGIN
    IF NEW.paye != TRUE                                     
    AND NEW.paye != FALSE     
      THEN
        INSERT INTO Erreur (erreur) VALUES ('Erreur : paye doit valoir TRUE (1) ou FALSE (0).');

    ELSEIF NEW.date_adoption < NEW.date_reservation THEN    
        INSERT INTO Erreur (erreur) VALUES ('Erreur : date_adoption doit être >= à date_reservation.');
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_adoption` BEFORE UPDATE ON `adoption` FOR EACH ROW BEGIN
    IF NEW.paye != TRUE                                     
    AND NEW.paye != FALSE     
      THEN
        INSERT INTO Erreur (erreur) VALUES ('Erreur : paye doit valoir TRUE (1) ou FALSE (0).');

    ELSEIF NEW.date_adoption < NEW.date_reservation THEN    
        INSERT INTO Erreur (erreur) VALUES ('Erreur : date_adoption doit être >= à date_reservation.');
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

CREATE TABLE `animal` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `sexe` char(1) DEFAULT NULL,
  `date_naissance` datetime NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `commentaires` text,
  `espece_id` smallint(6) UNSIGNED NOT NULL,
  `race_id` smallint(6) UNSIGNED DEFAULT NULL,
  `mere_id` smallint(6) UNSIGNED DEFAULT NULL,
  `pere_id` smallint(6) UNSIGNED DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`id`, `sexe`, `date_naissance`, `nom`, `commentaires`, `espece_id`, `race_id`, `mere_id`, `pere_id`, `disponible`) VALUES
(1, 'M', '2010-04-05 13:43:00', 'Rox', 'Mordille beaucoup', 1, 1, 18, 22, 1),
(2, NULL, '2010-03-24 02:23:00', 'Roucky', NULL, 2, NULL, 40, 30, 1),
(3, 'F', '2010-09-13 15:02:00', 'Schtroumpfette', NULL, 2, 4, 41, 31, 0),
(4, 'F', '2009-08-03 05:12:00', NULL, 'Bestiole avec une carapace très dure', 3, NULL, NULL, NULL, 1),
(5, NULL, '2010-10-03 16:44:00', 'Choupi', 'Né sans oreille gauche', 2, NULL, NULL, NULL, 0),
(6, 'F', '2009-06-13 08:17:00', 'Bobosse', 'Carapace bizarre', 3, NULL, NULL, NULL, 1),
(7, 'F', '2008-12-06 05:18:00', 'Caroline', NULL, 1, 2, NULL, NULL, 1),
(8, 'M', '2008-09-11 15:38:00', 'Bagherra', NULL, 2, 5, NULL, NULL, 0),
(9, NULL, '2010-08-23 05:18:00', NULL, 'Bestiole avec une carapace très dure', 3, NULL, NULL, NULL, 1),
(10, 'M', '2010-07-21 15:41:00', 'Bobo', 'Petit pour son âge', 1, NULL, 7, 21, 1),
(11, 'F', '2008-02-20 15:45:00', 'Canaille', NULL, 1, NULL, NULL, NULL, 1),
(12, 'F', '2009-05-26 08:54:00', 'Cali', NULL, 1, 2, NULL, NULL, 1),
(13, 'F', '2007-04-24 12:54:00', 'Rouquine', NULL, 1, 1, NULL, NULL, 1),
(14, 'F', '2009-05-26 08:56:00', 'Fila', NULL, 1, 2, NULL, NULL, 1),
(15, 'F', '2008-02-20 15:47:00', 'Anya', NULL, 1, NULL, NULL, NULL, 0),
(16, 'F', '2009-05-26 08:50:00', 'Louya', NULL, 1, NULL, NULL, NULL, 0),
(17, 'F', '2008-03-10 13:45:00', 'Welva', NULL, 1, NULL, NULL, NULL, 1),
(18, 'F', '2007-04-24 12:59:00', 'Zira', NULL, 1, 1, NULL, NULL, 0),
(19, 'F', '2009-05-26 09:02:00', 'Java', NULL, 1, 2, NULL, NULL, 1),
(20, NULL, '2007-04-24 12:45:00', 'Balou', NULL, 1, 1, NULL, NULL, 1),
(21, 'F', '2008-03-10 13:43:00', 'Pataude', NULL, 1, NULL, NULL, NULL, 0),
(22, 'M', '2007-04-24 12:42:00', 'Bouli', NULL, 1, 1, NULL, NULL, 1),
(24, 'M', '2007-04-12 05:23:00', 'Cartouche', NULL, 1, NULL, NULL, NULL, 1),
(25, 'M', '2006-05-14 15:50:00', 'Zambo', NULL, 1, 1, NULL, NULL, 1),
(26, 'M', '2006-05-14 15:48:00', 'Samba', NULL, 1, 1, NULL, NULL, 0),
(27, 'M', '2008-03-10 13:40:00', 'Moka', NULL, 1, NULL, NULL, NULL, 0),
(28, 'M', '2006-05-14 15:40:00', 'Pilou', NULL, 1, 1, NULL, NULL, 1),
(29, 'M', '2009-05-14 06:30:00', 'Fiero', NULL, 2, 3, NULL, NULL, 1),
(30, 'M', '2007-03-12 12:05:00', 'Zonko', NULL, 2, 5, NULL, NULL, 0),
(31, 'M', '2008-02-20 15:45:00', 'Filou', NULL, 2, 4, NULL, NULL, 1),
(32, 'M', '2009-07-26 11:52:00', 'Spoutnik', NULL, 3, NULL, 52, NULL, 0),
(33, 'M', '2006-05-19 16:17:00', 'Caribou', NULL, 2, 4, NULL, NULL, 1),
(34, 'M', '2008-04-20 03:22:00', 'Capou', NULL, 2, 5, NULL, NULL, 1),
(35, 'M', '2006-05-19 16:56:00', 'Raccou', 'Pas de queue depuis la naissance', 2, 4, NULL, NULL, 1),
(36, 'M', '2009-05-14 06:42:00', 'Boucan', NULL, 2, 3, NULL, NULL, 1),
(37, 'F', '2006-05-19 16:06:00', 'Callune', NULL, 2, 8, NULL, NULL, 1),
(38, 'F', '2009-05-14 06:45:00', 'Boule', NULL, 2, 3, NULL, NULL, 0),
(39, 'F', '2008-04-20 03:26:00', 'Zara', NULL, 2, 5, NULL, NULL, 0),
(40, 'F', '2007-03-12 12:00:00', 'Milla', NULL, 2, 5, NULL, NULL, 0),
(41, 'F', '2006-05-19 15:59:00', 'Feta', NULL, 2, 4, NULL, NULL, 0),
(42, 'F', '2008-04-20 03:20:00', 'Bilba', 'Sourde de l\'oreille droite à 80%', 2, 5, NULL, NULL, 0),
(43, 'F', '2007-03-12 11:54:00', 'Cracotte', NULL, 2, 5, NULL, NULL, 1),
(44, 'F', '2006-05-19 16:16:00', 'Cawette', NULL, 2, 8, NULL, NULL, 1),
(45, 'F', '2007-04-01 18:17:00', 'Nikki', 'Bestiole avec une carapace très dure', 3, NULL, NULL, NULL, 1),
(46, 'F', '2009-03-24 08:23:00', 'Tortilla', 'Bestiole avec une carapace très dure', 3, NULL, NULL, NULL, 1),
(48, 'F', '2006-03-15 14:56:00', 'Lulla', 'Bestiole avec une carapace très dure', 3, NULL, NULL, NULL, 1),
(49, 'F', '2008-03-15 12:02:00', 'Dana', 'Bestiole avec une carapace très dure', 3, NULL, NULL, NULL, 0),
(50, 'F', '2009-05-25 19:57:00', 'Cheli', 'Bestiole avec une carapace très dure', 3, NULL, NULL, NULL, 1),
(51, 'F', '2007-04-01 03:54:00', 'Chicaca', 'Bestiole avec une carapace très dure', 3, NULL, NULL, NULL, 1),
(52, 'F', '2006-03-15 14:26:00', 'Redbul', 'Insomniaque', 3, NULL, NULL, NULL, 1),
(54, 'M', '2008-03-16 08:20:00', 'Bubulle', 'Bestiole avec une carapace très dure', 3, NULL, NULL, NULL, 1),
(55, 'M', '2008-03-15 18:45:00', 'Relou', 'Surpoids', 3, NULL, NULL, NULL, 0),
(56, 'M', '2009-05-25 18:54:00', 'Bulbizard', 'Bestiole avec une carapace très dure', 3, NULL, NULL, NULL, 1),
(57, 'M', '2007-03-04 19:36:00', 'Safran', 'Coco veut un gâteau !', 4, NULL, NULL, NULL, 0),
(58, 'M', '2008-02-20 02:50:00', 'Gingko', 'Coco veut un gâteau !', 4, NULL, NULL, NULL, 0),
(59, 'M', '2009-03-26 08:28:00', 'Bavard', 'Coco veut un gâteau !', 4, NULL, NULL, NULL, 0),
(60, 'F', '2009-03-26 07:55:00', 'Parlotte', 'Coco veut un gâteau !', 4, NULL, NULL, NULL, 1),
(61, 'M', '2010-11-09 00:00:00', 'Yoda', NULL, 2, 5, NULL, NULL, 1),
(62, 'M', '2010-11-05 00:00:00', 'Pipo', NULL, 1, 9, NULL, NULL, 0),
(69, 'F', '2012-02-13 15:45:00', 'Baba', NULL, 5, NULL, NULL, NULL, 0),
(70, 'M', '2012-02-13 15:48:00', 'Bibo', 'Agressif', 5, NULL, 72, 73, 1),
(72, 'F', '2008-02-01 02:25:00', 'Momy', NULL, 5, NULL, NULL, NULL, 1),
(73, 'M', '2007-03-11 12:45:00', 'Popi', NULL, 5, NULL, NULL, NULL, 1),
(75, 'F', '2007-03-12 22:03:00', 'Mimi', NULL, 5, NULL, NULL, NULL, 0);

--
-- Déclencheurs `animal`
--
DELIMITER $$
CREATE TRIGGER `after_delete_animal` AFTER DELETE ON `animal` FOR EACH ROW BEGIN
    INSERT INTO Animal_histo (
        id, sexe, date_naissance, nom, commentaires, espece_id, race_id, 
        mere_id,  pere_id, disponible, date_histo, utilisateur_histo, evenement_histo)
    VALUES (
        OLD.id, OLD.sexe, OLD.date_naissance, OLD.nom, OLD.commentaires, OLD.espece_id, OLD.race_id,
        OLD.mere_id, OLD.pere_id, OLD.disponible, NOW(), CURRENT_USER(), 'DELETE');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_animal` AFTER UPDATE ON `animal` FOR EACH ROW BEGIN
    INSERT INTO Animal_histo (
        id, sexe, date_naissance, nom, commentaires, espece_id, race_id, 
        mere_id, pere_id, disponible, date_histo, utilisateur_histo, evenement_histo)
    VALUES (
        OLD.id, OLD.sexe, OLD.date_naissance, OLD.nom, OLD.commentaires, OLD.espece_id, OLD.race_id,
        OLD.mere_id, OLD.pere_id, OLD.disponible, NOW(), CURRENT_USER(), 'UPDATE');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_animal` BEFORE INSERT ON `animal` FOR EACH ROW BEGIN
    IF NEW.sexe IS NOT NULL   
    AND NEW.sexe != 'M'       
    AND NEW.sexe != 'F'       
    AND NEW.sexe != 'A'
      THEN
        INSERT INTO Erreur (erreur) VALUES ('Erreur : sexe doit valoir "M", "F", "A" ou NULL.');
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_animal` BEFORE UPDATE ON `animal` FOR EACH ROW BEGIN
    IF NEW.sexe IS NOT NULL   
    AND NEW.sexe != 'M'       
    AND NEW.sexe != 'F' 
    AND NEW.sexe != 'A'
      THEN
        SET NEW.sexe = NULL;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `code_postal` varchar(6) DEFAULT NULL,
  `ville` varchar(60) DEFAULT NULL,
  `pays` varchar(60) DEFAULT NULL,
  `email` varbinary(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `adresse`, `code_postal`, `ville`, `pays`, `email`) VALUES
(1, 'Dupont', 'Jean', 'Rue du Centre, 5', '45810', 'Houtsiplou', 'France', 0x6a65616e2e6475706f6e7440656d61696c2e636f6d),
(2, 'Boudur', 'Marie', 'Place de la Gare, 2', '35840', 'Troudumonde', 'France', 0x6d617269652e626f7564757240656d61696c2e636f6d),
(3, 'Trachon', 'Fleur', 'Rue haute, 54b', '3250', 'Belville', 'Belgique', 0x666c65757274726163686f6e40656d61696c2e636f6d),
(4, 'Van Piperseel', 'Julien', NULL, NULL, NULL, NULL, 0x6a65616e767040656d61696c2e636f6d),
(5, 'Nouvel', 'Johan', NULL, NULL, NULL, 'Suisse', 0x6a6f68616e65747069726c6f75697440656d61696c2e636f6d),
(6, 'Germain', 'Frank', NULL, NULL, NULL, NULL, 0x6672616e636f69736765726d61696e40656d61696c2e636f6d),
(7, 'Antoine', 'Maximilien', 'Rue Moineau, 123', '4580', 'Trocoul', 'Belgique', 0x6d61782e616e746f696e6540656d61696c2e636f6d),
(8, 'Di Paolo', 'Hector', NULL, NULL, NULL, 'Suisse', 0x686563746f72646970616f40656d61696c2e636f6d),
(9, 'Corduro', 'Anaelle', NULL, NULL, NULL, NULL, 0x616e612e636f726475726f40656d61696c2e636f6d),
(10, 'Faluche', 'Eline', 'Avenue circulaire, 7', '45870', 'Garduche', 'France', 0x656c696e6566616c7563686540656d61696c2e636f6d),
(11, 'Penni', 'Carine', 'Boulevard Haussman, 85', '1514', 'Plasse', 'Suisse', 0x6370656e6e6940656d61696c2e636f6d),
(12, 'Broussaille', 'Virginie', 'Rue du Fleuve, 18', '45810', 'Houtsiplou', 'France', 0x766962726f757361696c6c6540656d61696c2e636f6d),
(13, 'Durant', 'Hannah', 'Rue des Pendus, 66', '1514', 'Plasse', 'Suisse', 0x6868647572616e7440656d61696c2e636f6d),
(14, 'Delfour', 'Elodie', 'Rue de Flore, 1', '3250', 'Belville', 'Belgique', 0x652e64656c666f757240656d61696c2e636f6d),
(15, 'Kestau', 'Joel', NULL, NULL, NULL, NULL, 0x6a6f656c2e6b657374617540656d61696c2e636f6d);

-- --------------------------------------------------------

--
-- Structure de la table `espece`
--

CREATE TABLE `espece` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `nom_courant` varchar(40) NOT NULL,
  `nom_latin` varchar(40) NOT NULL,
  `description` text,
  `prix` decimal(7,2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `espece`
--

INSERT INTO `espece` (`id`, `nom_courant`, `nom_latin`, `description`, `prix`) VALUES
(1, 'Chien', 'Canis canis', 'Bestiole à quatre pattes qui aime les caresses et tire souvent la langue', '200.00'),
(2, 'Chat', 'Felis silvestris', 'Bestiole à quatre pattes qui saute très haut et grimpe aux arbres', '150.00'),
(3, 'Tortue d\'Hermann', 'Testudo hermanni', 'Bestiole avec une carapace très dure', '140.00'),
(4, 'Perroquet amazone', 'Alipiopsitta xanthops', 'Joli oiseau parleur vert et jaune', '700.00'),
(5, 'Rat brun', 'Rattus norvegicus', 'Petite bestiole avec de longues moustaches et une longue queue sans poils', '10.00');

--
-- Déclencheurs `espece`
--
DELIMITER $$
CREATE TRIGGER `before_delete_espece` BEFORE DELETE ON `espece` FOR EACH ROW BEGIN
    DELETE FROM Race
    WHERE espece_id = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

CREATE TABLE `race` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `nom` varchar(40) NOT NULL,
  `espece_id` smallint(6) UNSIGNED NOT NULL,
  `description` text,
  `prix` decimal(7,2) UNSIGNED DEFAULT NULL,
  `date_insertion` datetime DEFAULT NULL,
  `utilisateur_insertion` varchar(20) DEFAULT NULL,
  `date_modification` datetime DEFAULT NULL,
  `utilisateur_modification` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `race`
--

INSERT INTO `race` (`id`, `nom`, `espece_id`, `description`, `prix`, `date_insertion`, `utilisateur_insertion`, `date_modification`, `utilisateur_modification`) VALUES
(1, 'Berger allemand', 1, 'Chien sportif et élégant au pelage dense, noir-marron-fauve, noir ou gris.', '485.00', '2012-05-21 00:53:36', 'Test', '2012-05-21 00:53:36', 'Test'),
(2, 'Berger blanc suisse', 1, 'Petit chien au corps compact, avec des pattes courtes mais bien proportionnées et au pelage tricolore ou bicolore.', '935.00', '2012-05-21 00:53:36', 'Test', '2012-05-21 00:53:36', 'Test'),
(3, 'Singapura', 2, 'Chat de petite taille aux grands yeux en amandes.', '985.00', '2012-05-21 00:53:36', 'Test', '2012-05-21 00:53:36', 'Test'),
(4, 'Bleu russe', 2, 'Chat aux yeux verts et à la robe épaisse et argentée.', '835.00', '2012-05-21 00:53:36', 'Test', '2012-05-21 00:53:36', 'Test'),
(5, 'Maine coon', 2, 'Chat de grande taille, à poils mi-longs.', '735.00', '2012-05-21 00:53:36', 'Test', '2012-05-21 00:53:36', 'Test'),
(7, 'Sphynx', 2, 'Chat sans poils.', '1235.00', '2012-05-21 00:53:36', 'Test', '2012-05-21 00:53:36', 'Test'),
(8, 'Nebelung', 2, 'Chat bleu russe, mais avec des poils longs...', '985.00', '2012-05-21 00:53:36', 'Test', '2012-05-21 00:53:36', 'Test'),
(9, 'Rottweiller', 1, 'Chien d\'apparence solide, bien musclé, à la robe noire avec des taches feu bien délimitées.', '630.00', '2012-05-21 00:53:36', 'Test', '2012-05-22 00:54:13', 'sdz@localhost'),
(10, 'Yorkshire terrier', 1, 'Chien de petite taille au pelage long et soyeux de couleur bleu et feu.', '700.00', '2012-05-22 00:58:25', 'sdz@localhost', '2012-05-22 00:58:25', 'sdz@localhost');

--
-- Déclencheurs `race`
--
DELIMITER $$
CREATE TRIGGER `before_delete_race` BEFORE DELETE ON `race` FOR EACH ROW BEGIN
    UPDATE Animal 
    SET race_id = NULL
    WHERE race_id = OLD.id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_race` BEFORE INSERT ON `race` FOR EACH ROW BEGIN
    SET NEW.date_insertion = NOW();
    SET NEW.utilisateur_insertion = CURRENT_USER();
    SET NEW.date_modification = NOW();
    SET NEW.utilisateur_modification = CURRENT_USER();
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_race` BEFORE UPDATE ON `race` FOR EACH ROW BEGIN
    SET NEW.date_modification = NOW();
    SET NEW.utilisateur_modification = CURRENT_USER();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_animal_details`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_animal_details` (
`id` smallint(6) unsigned
,`sexe` char(1)
,`date_naissance` datetime
,`nom` varchar(30)
,`commentaires` text
,`espece_id` smallint(6) unsigned
,`race_id` smallint(6) unsigned
,`mere_id` smallint(6) unsigned
,`pere_id` smallint(6) unsigned
,`disponible` tinyint(1)
,`espece_nom` varchar(40)
,`race_nom` varchar(40)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_chien`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_chien` (
`id` smallint(6) unsigned
,`sexe` char(1)
,`date_naissance` datetime
,`nom` varchar(30)
,`commentaires` text
,`espece_id` smallint(6) unsigned
,`race_id` smallint(6) unsigned
,`mere_id` smallint(6) unsigned
,`pere_id` smallint(6) unsigned
,`disponible` tinyint(1)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_nombre_espece`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_nombre_espece` (
`id` smallint(6) unsigned
,`nb` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure de la vue `v_animal_details`
--
DROP TABLE IF EXISTS `v_animal_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_animal_details`  AS SELECT `animal`.`id` AS `id`, `animal`.`sexe` AS `sexe`, `animal`.`date_naissance` AS `date_naissance`, `animal`.`nom` AS `nom`, `animal`.`commentaires` AS `commentaires`, `animal`.`espece_id` AS `espece_id`, `animal`.`race_id` AS `race_id`, `animal`.`mere_id` AS `mere_id`, `animal`.`pere_id` AS `pere_id`, `animal`.`disponible` AS `disponible`, `espece`.`nom_courant` AS `espece_nom`, `race`.`nom` AS `race_nom` FROM ((`animal` join `espece` on((`animal`.`espece_id` = `espece`.`id`))) left join `race` on((`animal`.`race_id` = `race`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_chien`
--
DROP TABLE IF EXISTS `v_chien`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_chien`  AS SELECT `animal`.`id` AS `id`, `animal`.`sexe` AS `sexe`, `animal`.`date_naissance` AS `date_naissance`, `animal`.`nom` AS `nom`, `animal`.`commentaires` AS `commentaires`, `animal`.`espece_id` AS `espece_id`, `animal`.`race_id` AS `race_id`, `animal`.`mere_id` AS `mere_id`, `animal`.`pere_id` AS `pere_id`, `animal`.`disponible` AS `disponible` FROM `animal` WHERE (`animal`.`espece_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_nombre_espece`
--
DROP TABLE IF EXISTS `v_nombre_espece`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_nombre_espece`  AS SELECT `espece`.`id` AS `id`, count(`espece`.`id`) AS `nb` FROM (`animal` join `espece` on((`espece`.`id` = `animal`.`espece_id`))) GROUP BY `espece`.`id` ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adoption`
--
ALTER TABLE `adoption`
  ADD PRIMARY KEY (`client_id`,`animal_id`),
  ADD UNIQUE KEY `ind_uni_animal_id` (`animal_id`);

--
-- Index pour la table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ind_uni_nom_espece_id` (`nom`,`espece_id`),
  ADD KEY `fk_race_id` (`race_id`),
  ADD KEY `fk_mere_id` (`mere_id`),
  ADD KEY `fk_pere_id` (`pere_id`),
  ADD KEY `fk_espece_id` (`espece_id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ind_uni_email` (`email`);

--
-- Index pour la table `espece`
--
ALTER TABLE `espece`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom_latin` (`nom_latin`);

--
-- Index pour la table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_race_espece_id` (`espece_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `espece`
--
ALTER TABLE `espece`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `race`
--
ALTER TABLE `race`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adoption`
--
ALTER TABLE `adoption`
  ADD CONSTRAINT `fk_adoption_animal_id` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `fk_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `fk_espece_id` FOREIGN KEY (`espece_id`) REFERENCES `espece` (`id`),
  ADD CONSTRAINT `fk_mere_id` FOREIGN KEY (`mere_id`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `fk_pere_id` FOREIGN KEY (`pere_id`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `fk_race_id` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`);

--
-- Contraintes pour la table `race`
--
ALTER TABLE `race`
  ADD CONSTRAINT `fk_race_espece_id` FOREIGN KEY (`espece_id`) REFERENCES `espece` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
