-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 31 mars 2023 à 23:42
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionarticle_rest`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `ID` int(11) NOT NULL,
  `auteur` varchar(50) DEFAULT NULL,
  `datePub` date DEFAULT NULL,
  `contenu` varchar(999) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`ID`, `auteur`, `datePub`, `contenu`) VALUES
(2, 'vinki', '2023-03-24', 'Contempler le coucher de soleil, fait parti des mes activités favoris'),
(3, 'crococarl', '2023-03-17', 'Singapour !'),
(4, 'crococarl', '2023-03-17', 'Thai !'),
(5, 'vinki', '2023-03-25', 'On continu l\'aventure de l\'euro 2023 FR/P-B'),
(9, 'crococarl', '2023-03-29', 'C\'est l\'heure de partie en stage'),
(10, 'crococarl', '2023-03-29', 'Thailande me voilà'),
(12, 'crococarl', '2023-03-29', 'Teste 2.0'),
(13, 'Patrick', '2023-03-30', 'Un week-end sur le bord de mer'),
(14, 'Johnny', '2023-03-30', 'Johnny, johnny yes papa, \r\neating sugar, no papa\r\ntell lies, no papa\r\nopen your mouth, ah ah ah !\r\n'),
(15, 'crococarl', '2023-03-30', 'Le coucher de soleil est un moment magique où le ciel se pare de couleurs chatoyantes et où l\'atmosphère se teinte de douceur et de sérénité. C\'est un spectacle naturel fascinant qui invite à la contemplation et qui inspire de nombreux artistes à travers le monde.'),
(16, 'crococarl', '2023-03-30', 'Test 1.2 1.2'),
(17, 'crococarl', '2023-03-31', 'Ramadan'),
(19, 'viallet', '2023-03-31', 'La croissance exponentielle de l\'utilisation des technologies numériques a des répercussions importantes sur l\'environnement. Il est essentiel de trouver des solutions pour réduire l\'impact écologique du numérique, telles que l\'utilisation de sources d\'énergie renouvelable, la conception de produits durables et la gestion efficace des déchets électroniques.'),
(20, 'patrick', '2023-03-31', 'La Garonne est un fleuve français qui prend sa source dans les Pyrénées et traverse la région de l\'Occitanie avant de se jeter dans l\'océan Atlantique. Elle est connue pour sa beauté naturelle et son importance pour l\'agriculture, l\'industrie et le tourisme de la région.');

-- --------------------------------------------------------

--
-- Structure de la table `dislikes`
--

CREATE TABLE `dislikes` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dislikes`
--

INSERT INTO `dislikes` (`ID`, `username`) VALUES
(2, 'crococarl'),
(4, 'Patrick'),
(12, 'viallet'),
(12, 'vinki'),
(20, 'vinki');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`ID`, `username`) VALUES
(2, 'crococarl'),
(2, 'Patrick'),
(3, 'Patrick'),
(3, 'viallet'),
(5, 'patrick'),
(13, 'Johnny'),
(15, 'Johnny'),
(20, 'crococal'),
(20, 'patrick');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `login` varchar(50) NOT NULL,
  `password` varchar(999) NOT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`login`, `password`, `role`) VALUES
('amina', 'b38bb9429239744b50dfc9ef13d1a96b1985eb2b1afc9d056d3650b97c015cb7', 'moderator'),
('clement', '4c2d1ccd957c4b2d4d38a636583e9ab1fa37f0866e4046c1145098aead453b2e', 'moderator'),
('crococarl', '56e3e215e033280fc80ca86da0e428cfc71828181968d17b6698643e97c59c6e', 'publisher'),
('Johnny', '4c2d1ccd957c4b2d4d38a636583e9ab1fa37f0866e4046c1145098aead453b2e', 'publisher'),
('Patrick', '4c2d1ccd957c4b2d4d38a636583e9ab1fa37f0866e4046c1145098aead453b2e', 'publisher'),
('prof', 'e060c37cc92927255ff5e06a4051a88b08d27a3c4d1de8192c4c7cf78884ec94', 'moderator'),
('viallet', '39497ad59a90a0bb39d239a25f47a090d019d9acde8633c35fe20cd69db0bdc9', 'publisher'),
('vinki', 'b7dafc7fae7c046b63266a0e76e69022664b9cbea408527319aa9ee7b26a315f', 'publisher');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`ID`,`username`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`ID`,`username`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dislikes`
--
ALTER TABLE `dislikes`
  ADD CONSTRAINT `dislikes_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `article` (`ID`);

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `article` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
