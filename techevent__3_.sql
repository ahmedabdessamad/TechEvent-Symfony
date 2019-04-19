-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 26 mars 2019 à 09:08
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `techevent`
--

-- --------------------------------------------------------

--
-- Structure de la table `appel_sponsor`
--

DROP TABLE IF EXISTS `appel_sponsor`;
CREATE TABLE IF NOT EXISTS `appel_sponsor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1B06DC1A71F7E88B` (`event_id`),
  KEY `IDX_1B06DC1AA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `heurepubl` datetime NOT NULL,
  `categorie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `contenuecom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `heurecom` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67F068BCA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `copon`
--

DROP TABLE IF EXISTS `copon`;
CREATE TABLE IF NOT EXISTS `copon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeCoupon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `coupon`
--

DROP TABLE IF EXISTS `coupon`;
CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeCoupon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `affiche` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nbrplaces` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `localisation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateevent` date NOT NULL,
  `hdebut` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hfin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `categorie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `psilver` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pglod` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pdiamond` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prixsilver` double NOT NULL,
  `prixgold` double NOT NULL,
  `prixdiamond` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3BAE0AA7A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `user_id`, `titre`, `description`, `affiche`, `nbrplaces`, `localisation`, `dateevent`, `hdebut`, `hfin`, `prix`, `categorie`, `type`, `psilver`, `pglod`, `pdiamond`, `prixsilver`, `prixgold`, `prixdiamond`) VALUES
(1, 1, 'Billionaire', 'dsdsd', 'sadada', 'adda', 'adad', '2019-02-14', 'dadad', 'adad', 12, 'dssdsd', 'sdsd', 'sdd', 'sdds', 'sdsd', 12, 12, 12);

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'besmellah', 'besmellah', 'besmellah@gmail.com', 'besmellah@gmail.com', 1, NULL, '$2y$13$Grd5aBmh9epAe7uTtsN0JueRpig122AkLasukDyMnirHmyNf.pTOu', '2019-03-21 22:19:35', NULL, NULL, 'a:0:{}'),
(2, 'test', 'test', 'test@gmail.com', 'test@gmail.com', 1, NULL, '$2y$13$Ks3X.mXf.nUdUjp/AvTNluEfrF6q5cb1doeM6O997Zs/IzcGwtjpu', '2019-03-26 04:22:14', NULL, NULL, 'a:0:{}'),
(3, 'koko', 'koko', 'koko@gmail.com', 'koko@gmail.com', 1, NULL, '$2y$13$hpgKZ9iGXQezSmSWCrKIP.Cjh1u4OujjiKRtIQJ5.vJXhl8A9SC/W', NULL, NULL, NULL, 'a:0:{}'),
(4, 'king', 'king', 'king@tt.com', 'king@tt.com', 1, NULL, '$2y$13$nr53XmmEFTqnhZd/xFv3ReqVjDP6sbYUDJlp8XFdNW/KGf1of1Jzi', '2019-03-22 14:58:55', NULL, NULL, 'a:0:{}'),
(5, 'baba', 'baba', 'baba@gmail.com', 'baba@gmail.com', 1, NULL, '$2y$13$Cv/tSrhkynX4skBuG.yp9uswKcnRlDNOq2QNePhVWNTVmdRZw3i.O', NULL, NULL, NULL, 'a:0:{}'),
(6, 'kiki', 'kiki', 'kiki@gmail.com', 'kiki@gmail.com', 1, NULL, '$2y$13$rjTZmc7fLzd13gso.BDVoecmQZsSZwYCIDVFopM.UzoUqCJe5paUe', '2019-03-22 15:14:25', NULL, NULL, 'a:0:{}'),
(7, 'dali', 'dali', 'dali@gmail.com', 'dali@gmail.com', 1, NULL, '$2y$13$TrLPONHaHR0sNlhDc/B9Tugi0gYjY/Z47QXr5HVExUQjYcj7nBtOu', NULL, NULL, NULL, 'a:0:{}'),
(8, 'kikiii', 'kikiii', 'kikii@gmail.com', 'kikii@gmail.com', 1, NULL, '$2y$13$LSApFTENjHZunmUoR5oHyOizSSnVa3NH6UFdrrHUGj8Rxc9fsOaCG', '2019-03-22 16:30:04', NULL, NULL, 'a:0:{}'),
(9, 'pp', 'pp', 'pp@gmail.com', 'pp@gmail.com', 1, NULL, '$2y$13$3hTZTCTKeOpgj98UpGu9Rei2NaezkvWkVs0/L69JjmPqGkgnWE3Xy', '2019-03-22 16:36:13', NULL, NULL, 'a:0:{}'),
(10, 'popo', 'popo', 'poppo@gmail.com', 'poppo@gmail.com', 1, NULL, '$2y$13$pCZ2pO4QElpHgR65E3U3pOgu0OAY2Op4OV4.o8eUOraWhEposYLxG', NULL, NULL, NULL, 'a:0:{}'),
(11, 'bechir', 'bechir', 'bechir@gmail.com', 'bechir@gmail.com', 1, NULL, '$2y$13$2YURGxNgJUfS1Wv6zZsHduJEnOV4eTD7NK7iIecejOebh94SWbiCW', '2019-03-22 16:47:17', NULL, NULL, 'a:0:{}');

-- --------------------------------------------------------

--
-- Structure de la table `interesser`
--

DROP TABLE IF EXISTS `interesser`;
CREATE TABLE IF NOT EXISTS `interesser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4D010524A76ED395` (`user_id`),
  KEY `IDX_4D01052471F7E88B` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `intervention`
--

DROP TABLE IF EXISTS `intervention`;
CREATE TABLE IF NOT EXISTS `intervention` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `speaker_id` int(11) DEFAULT NULL,
  `typeinter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `heureInter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D11814ABD04A0F27` (`speaker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `inttereser`
--

DROP TABLE IF EXISTS `inttereser`;
CREATE TABLE IF NOT EXISTS `inttereser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4D010524A76ED395` (`user_id`),
  KEY `IDX_4D01052471F7E88B` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `newslettre`
--

DROP TABLE IF EXISTS `newslettre`;
CREATE TABLE IF NOT EXISTS `newslettre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F0C8D771A76ED395` (`user_id`),
  KEY `IDX_F0C8D77171F7E88B` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `new_lettre`
--

DROP TABLE IF EXISTS `new_lettre`;
CREATE TABLE IF NOT EXISTS `new_lettre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F0C8D771A76ED395` (`user_id`),
  KEY `IDX_F0C8D77171F7E88B` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `descoffre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datedeboffre` date NOT NULL,
  `datefinoffre` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AF86866F71F7E88B` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `userid`, `total`) VALUES
(1, NULL, NULL),
(2, NULL, NULL),
(3, 1, NULL),
(4, 1, NULL),
(5, 1, NULL),
(8, 1, NULL),
(9, 1, NULL),
(10, 1, NULL),
(11, 2, NULL),
(12, 11, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `publicite`
--

DROP TABLE IF EXISTS `publicite`;
CREATE TABLE IF NOT EXISTS `publicite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenuePub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photoPub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emplacementPub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `dateReservation` datetime NOT NULL,
  `quantite` int(11) NOT NULL,
  `total` double DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payer` int(11) DEFAULT NULL,
  `nomReservation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idpanier` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4DA239A76ED395` (`user_id`),
  KEY `IDX_4DA23971F7E88B` (`event_id`),
  KEY `IDX_42C849554071A05E` (`idpanier`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `user_id`, `event_id`, `dateReservation`, `quantite`, `total`, `type`, `seat`, `payer`, `nomReservation`, `idpanier`) VALUES
(5, 1, 1, '2019-02-16 11:42:54', 2, 0, 'normale', 'A4', NULL, NULL, NULL),
(6, 1, 1, '2019-02-16 11:42:54', 1, 0, 'VIP', 'B1', 1, NULL, NULL),
(9, 1, 1, '2019-02-17 16:54:09', 2, 24, 'Normal', 'C3', 1, NULL, NULL),
(10, 1, 1, '2019-02-17 21:59:07', 2, 24, 'VIP', 'B6', NULL, 'sdsds', NULL),
(11, 1, 1, '2019-02-17 22:02:38', 1, 12, 'Noramle', 'A3', 1, 'Billionaire', NULL),
(12, 1, 1, '2019-02-17 23:44:52', 2, 24, 'VIP', 'A9', 1, 'Billionaire', NULL),
(13, NULL, NULL, '2019-03-20 01:43:12', 1, NULL, 'Guest', 'B', NULL, NULL, NULL),
(14, NULL, 1, '2019-03-20 17:22:33', 1, NULL, 'Normale', 'A', NULL, NULL, NULL),
(15, NULL, 1, '2019-03-20 17:23:30', 1, NULL, 'Guest', 'C', NULL, NULL, NULL),
(16, NULL, 1, '2019-03-20 20:15:57', 1, NULL, 'Normale', 'A', NULL, NULL, NULL),
(17, NULL, 1, '2019-03-21 22:20:19', 1, NULL, 'Normale', 'A', NULL, NULL, NULL),
(18, NULL, 1, '2019-03-21 22:21:18', 1, NULL, 'Normale', 'A', NULL, NULL, NULL),
(19, NULL, 1, '2019-03-22 12:18:43', 2, NULL, 'Guest', 'C', NULL, NULL, NULL),
(20, NULL, 1, '2019-03-22 12:25:28', 2, NULL, 'Guest', 'C', NULL, NULL, NULL),
(21, NULL, 1, '2019-03-22 12:26:01', 2, NULL, 'VIP', 'B', NULL, NULL, NULL),
(22, NULL, 1, '2019-03-22 12:27:33', 2, NULL, 'VIP', 'B', NULL, NULL, NULL),
(23, 2, 1, '2019-03-22 12:44:31', 1, NULL, 'Normale', 'B', NULL, NULL, NULL),
(24, 11, 1, '2019-03-23 05:05:04', 2, NULL, 'VIP', 'B', NULL, NULL, 1),
(25, 2, 1, '2019-03-24 06:30:13', 1, NULL, 'VIP', 'A', NULL, NULL, 1),
(32, 2, 1, '2019-03-25 12:10:08', 3, NULL, 'VIP', 'A', NULL, NULL, 11);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `DateRes` date NOT NULL,
  `Qte` int(11) NOT NULL,
  `TypeRese` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4DA239A76ED395` (`user_id`),
  KEY `IDX_4DA23971F7E88B` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `speaker`
--

DROP TABLE IF EXISTS `speaker`;
CREATE TABLE IF NOT EXISTS `speaker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appel_sponsor`
--
ALTER TABLE `appel_sponsor`
  ADD CONSTRAINT `FK_1B06DC1A71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_1B06DC1AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `interesser`
--
ALTER TABLE `interesser`
  ADD CONSTRAINT `FK_4D01052471F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_4D010524A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `intervention`
--
ALTER TABLE `intervention`
  ADD CONSTRAINT `FK_D11814ABD04A0F27` FOREIGN KEY (`speaker_id`) REFERENCES `speaker` (`id`);

--
-- Contraintes pour la table `newslettre`
--
ALTER TABLE `newslettre`
  ADD CONSTRAINT `FK_F0C8D77171F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_F0C8D771A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `FK_AF86866F71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C849554071A05E` FOREIGN KEY (`idpanier`) REFERENCES `panier` (`id`),
  ADD CONSTRAINT `FK_4DA23971F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_4DA239A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
