-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 11 mai 2020 à 04:54
-- Version du serveur :  5.7.24
-- Version de PHP : 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laplacedumarche`
--

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8mb4 NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `category`) VALUES
(4, 'courgette', 'La courgette est une plante herbacée de la famille des Cucurbitaceae, c\'est aussi le fruit comestible de cette plante. La courgette est un fruit courant en été, la fleur de courgette est aussi utilisée en cuisine.', 2, 'Vegetables'),
(29, 'Tomate cerise', 'La tomate cerise est un type de variété de tomate, cultivée comme cette dernière pour ses fruits - mais de taille réduite - consommés comme légumes. Les tomates cerises sont généralement considérées comme des hybrides entre Solanum pimpinellifolium L. et la tomate cultivée, issue de l\'espèce Solanum lycopersicum.', 7, ''),
(30, 'courgette', 'La courgette est une plante herbacée de la famille des Cucurbitaceae, c\'est aussi le fruit comestible de cette plante. La courgette est un fruit courant en été, la fleur de courgette est aussi utilisée en cuisine.', 2, ''),
(31, 'salade', 'La piÃ¨ce.', 1, 'Vegetables'),
(32, 'Rhum Barbados XO', 'AprÃ¨s plusieurs annÃ©es de maturation, ce rhum Plantation Barbados XO a bÃ©nÃ©ficiÃ© dâ€™une finition dâ€™un an en fÃ»ts de Cognac de la Maison Ferrand, puis de six mois en fÃ»ts dâ€™Amburana.\r\n\r\nIl sâ€™agit dâ€™une essence de bois exotique dâ€™AmÃ©rique du sud que lâ€™on trouve en particulier au BrÃ©sil et au PÃ©rou.\r\n\r\nElaborÃ© sur lâ€™Ã®le de la Barbade, ce Single Cask (fÃ»t nÂ°3) a achevÃ© sa maturation au ChÃ¢teau de Bonbonnet, dans la rÃ©gion de Cognac, comme les autres rhums de la marque.\r\n\r\nUne technique de double vieillissement, qui est en quelque sorte la signature de la marque Plantation, et qui permet de bÃ©nÃ©ficier de lâ€™expertise de la Maison Ferrand, ce prÃ©cieux savoir-faire quâ€™elle a pu dÃ©velopper dans le monde des Cognacs.\r\n\r\nNotes de dÃ©gustation\r\n\r\nCouleur\r\nUne belle robe dorÃ©e, particuliÃ¨rement lumineuse.\r\n\r\nNez\r\nLes Ã©pices, le cafÃ©, la vanille, la banane et la noix de coco esquissent une agrÃ©able invitation Ã  la dÃ©gustation.\r\n\r\nBouche\r\nAu palais, on reconnaÃ®t la noix de muscade, lâ€™amande et le chocolat au lait, mais aussi la mangue. De dÃ©licieuses saveurs, qui achÃ¨vent de nous convaincre !\r\n\r\nFinale\r\nUne finale dâ€™une belle longueur.', 80, 'Alcool'),
(33, 'JURA 12 ans', 'Vieilli pendant dix ans dans des fÃ»ts de bourbon, avant de bÃ©nÃ©ficier dâ€™un affinage supplÃ©mentaire en fÃ»ts de xÃ©rÃ¨s oloroso Ã¢gÃ©s de premier choix, Jura 12 combine avec brio de subtiles notes fumÃ©es Ã  la suavitÃ© du xÃ©rÃ¨s.', 50, 'Alcool'),
(34, 'Fraise', 'Parmi les produits en baisse, le kilo de fraise (standard France barq. 500g) passe de 7,79 une semaine (-24%)', 8, 'fruits');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
