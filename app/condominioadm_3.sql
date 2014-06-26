-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 26, 2014 at 07:41 PM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `condominioadm`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloco`
--

CREATE TABLE IF NOT EXISTS `bloco` (
  `idbloco` int(11) NOT NULL AUTO_INCREMENT,
  `no_bloco` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idbloco`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `bloco`
--

INSERT INTO `bloco` (`idbloco`, `no_bloco`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9');

-- --------------------------------------------------------

--
-- Table structure for table `condominio`
--

CREATE TABLE IF NOT EXISTS `condominio` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `idnome` varchar(200) CHARACTER SET latin1 NOT NULL,
  `rua` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `latilong` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(200) CHARACTER SET latin1 NOT NULL,
  `uf` char(2) CHARACTER SET latin1 DEFAULT NULL,
  `cidade` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`),
  UNIQUE KEY `idnome` (`idnome`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=474 ;

--
-- Dumping data for table `condominio`
--

INSERT INTO `condominio` (`id`, `nome`, `idnome`, `rua`, `latilong`, `bairro`, `uf`, `cidade`) VALUES
(473, 'Park Reality', '', 'Est. Professor Daltro dos Santos', '', 'Campo Grande', 'RJ', 'Rio de Janeiro');

-- --------------------------------------------------------

--
-- Table structure for table `documento`
--

CREATE TABLE IF NOT EXISTS `documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `documento`
--

INSERT INTO `documento` (`id`, `titulo`, `file`, `data`) VALUES
(1, 'TTTTTT', 'dsadsadddasedqweqw.xls', NULL),
(2, 'AAAAAA', 'sdadasdasd.doc', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `imagem`
--

CREATE TABLE IF NOT EXISTS `imagem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idr` int(11) NOT NULL,
  `file` varchar(200) NOT NULL,
  PRIMARY KEY (`id`,`idr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `imagem`
--

INSERT INTO `imagem` (`id`, `idr`, `file`) VALUES
(1, 1, 'ac1506c29eeefbdbbe6df6d394a3c499.jpg'),
(2, 1, 'c055d9e6cd2c3d4bf94798a635def057.jpg'),
(3, 1, 'a2a8c1884b357375301fc9a2d692b77b.jpg'),
(4, 1, '9204214cb34f692c6224541c0074e1b2.jpg'),
(5, 1, '6ca73b883b371c61989532b694a45017.jpg'),
(6, 1, '71910937d97adcebcd74fc58bfa5a964.jpg'),
(7, 1, 'ceab11d311f15ad1002a6827bbd7459e.jpg'),
(8, 1, '44f2c2738519f1aa22fb784b6e20701f.jpg'),
(9, 1, 'c8f3b877beef9124e09274e6dd0d4fcb.jpg'),
(10, 1, 'ea2fc5efddcff007cd185b747ba32c6f.jpg'),
(11, 1, '186d39119db65bb9a73cbf27ed6e2557.jpg'),
(12, 1, '755c4be6c34c3b1c34186ddd0e5a48fb.jpg'),
(13, 1, 'ffb12457e9f4d9a68659876f9e49562f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `morador`
--

CREATE TABLE IF NOT EXISTS `morador` (
  `idmorador` int(11) NOT NULL AUTO_INCREMENT,
  `nome` int(11) NOT NULL,
  PRIMARY KEY (`idmorador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reclamacao`
--

CREATE TABLE IF NOT EXISTS `reclamacao` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) NOT NULL,
  `idcond` bigint(20) NOT NULL,
  `titulo` varchar(250) CHARACTER SET latin1 NOT NULL,
  `descricao` text CHARACTER SET latin1,
  `dt_cadastro` datetime DEFAULT NULL,
  `idassunto` int(11) DEFAULT NULL,
  `dados` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `visita` int(11) NOT NULL DEFAULT '0',
  `solucao` tinyint(1) NOT NULL DEFAULT '0',
  `youtube` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmar` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`,`idu`,`idcond`),
  KEY `idu` (`idu`),
  KEY `ide` (`idcond`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reclamacao`
--

INSERT INTO `reclamacao` (`id`, `idu`, `idcond`, `titulo`, `descricao`, `dt_cadastro`, `idassunto`, `dados`, `visita`, `solucao`, `youtube`, `confirmar`) VALUES
(1, 2, 473, 'ccccccccccccccccccccccc', 'cccccccccccccc', '2014-06-09 16:55:38', 1, NULL, 0, 0, NULL, NULL),
(2, 2, 473, 'ccccccccccccccccccccccc', 'cccccccccccccc', '2014-06-09 16:56:54', 1, NULL, 1, 0, NULL, NULL),
(3, 2, 473, 'ccccccccccccccccccccccc', 'cccccccccccccc', '2014-06-09 16:58:36', 1, NULL, 2, 0, NULL, NULL),
(4, 1, 473, 'ccccccccccccccccccccccc', 'cccccccccccccc', '2014-06-09 16:59:50', 1, NULL, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resposta`
--

CREATE TABLE IF NOT EXISTS `resposta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idr` bigint(11) NOT NULL,
  `ide` bigint(20) NOT NULL,
  `iduser` int(11) NOT NULL,
  `dtResposta` datetime DEFAULT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `resposta` text CHARACTER SET latin1,
  PRIMARY KEY (`id`,`idr`,`ide`,`iduser`),
  KEY `idr` (`idr`),
  KEY `ide` (`ide`),
  KEY `iduser` (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `resposta`
--

INSERT INTO `resposta` (`id`, `idr`, `ide`, `iduser`, `dtResposta`, `avaliacao`, `resposta`) VALUES
(6, 2, 1, 1, '2014-06-02 15:19:18', NULL, 'Prezada,\r\n\r\nEntramos em contato com empresa PATRIMAR e falamos com a Sra. GISELE a mesma informou que ja se iniciou a entrega das chaves.\r\n\r\nInfelizmente eles estavam com problema no sistema e nÃ£o puderam me dar maiores informaÃ§Ãµes.\r\n\r\nEm relaÃ§Ã£o a problemas financeiros nÃ£o conseguimos contato com o setor responsÃ¡vel.\r\n\r\nSegue telefones de contato que tentamos.\r\n\r\nPATRIMAR\r\n\r\n3883-0224 / 3883-0207 Gisele\r\n\r\nMRV FINANCEIRO\r\n\r\n(21) 3613-4000 (21) 3613-4017/ (21) 3613-4022 (credito imobiliÃ¡rio da regional).'),
(7, 1, 1, 1, '2014-06-03 21:19:30', NULL, 'Prezado,\r\n\r\nEntramos em contato com empresa PATRIMAR e falamos com a Sra. GISELE a mesma informou que ja se iniciou a entrega das chaves.\r\n\r\nSeu apartamento esta liberado e vamos entrar em contato para poder lhe agendar a entrega das chaves. Conforme informado pela Sra Amanda.\r\n\r\nInfelizmente eles estavam com problema no sistema e nÃ£o puderam me dar maiores informaÃ§Ãµes.\r\n\r\nSegue telefones de contato que tentamos.\r\n\r\nPATRIMAR\r\n\r\n3883-0224 / 3883-0207 Gisele\r\n\r\nMRV FINANCEIRO\r\n\r\n(21) 3613-4000 (21) 3613-4017/ (21) 3613-4022 (credito imobiliÃ¡rio da regional).');

-- --------------------------------------------------------

--
-- Table structure for table `sindico`
--

CREATE TABLE IF NOT EXISTS `sindico` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `idcond` bigint(20) NOT NULL,
  PRIMARY KEY (`id`,`idcond`),
  KEY `fk_sindico_condominio1` (`idcond`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipousuario`
--

CREATE TABLE IF NOT EXISTS `tipousuario` (
  `id` varchar(33) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tipousuario`
--

INSERT INTO `tipousuario` (`id`, `nome`) VALUES
('ROLE_ADMIN', 'Sindico'),
('ROLE_ADMINISTRATIVO', 'Administrativo'),
('ROLE_MORADOR', 'Morador'),
('ROLE_SUBSINDICO', 'Sub Sindico');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_condominio`
--

CREATE TABLE IF NOT EXISTS `tmp_condominio` (
  `id_tmpcond` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id_tmpcond`),
  KEY `fk_tmp_condominio_users1` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_sindico`
--

CREATE TABLE IF NOT EXISTS `tmp_sindico` (
  `id_tmpsindico` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `sindicocol` varchar(45) DEFAULT NULL,
  `idcond` bigint(20) NOT NULL,
  PRIMARY KEY (`id_tmpsindico`),
  KEY `fk_sindico_copy1_condominio1` (`idcond`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(88) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `idcond` bigint(20) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `salt` varchar(23) NOT NULL,
  `created_at` int(11) NOT NULL,
  `bloco` int(11) DEFAULT NULL,
  `ap` int(11) NOT NULL,
  `tel` varchar(22) DEFAULT NULL,
  `cel` varchar(22) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`),
  KEY `fk_users_condominio1` (`idcond`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `mail`, `image`, `idcond`, `role`, `salt`, `created_at`, `bloco`, `ap`, `tel`, `cel`) VALUES
(1, 'Morador Fulano de Tal', NULL, 'J30TetSUjCvvQP+mHdATSx/SRqvBoOL1G5VSWogIukYR9zsSgAd4KXc9xVmxfW3HOBs3QmID0PVtkmvAd2vfQQ==', 'admin@parkreality.com', NULL, 473, 'ROLE_MORADOR', '111052694753ac91ccc9698', 1379889332, 2, 301, '2133132353', '21992220009'),
(2, 'Secretaria', 'secretaria', 'YXylVBIE3HLEUNQEH5Z5bSua4vpEG0flg2V1OcpWw4wzel1nomjtkoG2XVKpug3R4hD18tI0Uj1r8z/3rXxtNg==', 'admin2@parkreality.com.br', NULL, 473, 'ROLE_ADMINISTRATIVO', '1260889385528018eda0a12', 1379889332, 2, 302, NULL, NULL),
(3, 'Rafael', 'sindico', 'YXylVBIE3HLEUNQEH5Z5bSua4vpEG0flg2V1OcpWw4wzel1nomjtkoG2XVKpug3R4hD18tI0Uj1r8z/3rXxtNg==', 'admin3@parkreality.com.br', NULL, 473, 'ROLE_ADMIN', '1260889385528018eda0a12', 1379889332, 2, 101, '2133132353', '21992220009'),
(4, 'Fabio Rocha', 'subsindico2', 'YXylVBIE3HLEUNQEH5Z5bSua4vpEG0flg2V1OcpWw4wzel1nomjtkoG2XVKpug3R4hD18tI0Uj1r8z/3rXxtNg==', 'admin4@parkreality.com.br', NULL, 473, 'ROLE_PORTARIA', '1260889385528018eda0a12', 1379889332, 2, 102, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reclamacao`
--
ALTER TABLE `reclamacao`
  ADD CONSTRAINT `reclamacao_ibfk_1` FOREIGN KEY (`idcond`) REFERENCES `condominio` (`id`),
  ADD CONSTRAINT `reclamacao_ibfk_2` FOREIGN KEY (`idu`) REFERENCES `users` (`id`);

--
-- Constraints for table `sindico`
--
ALTER TABLE `sindico`
  ADD CONSTRAINT `fk_sindico_condominio1` FOREIGN KEY (`idcond`) REFERENCES `condominio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tmp_condominio`
--
ALTER TABLE `tmp_condominio`
  ADD CONSTRAINT `fk_tmp_condominio_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tmp_sindico`
--
ALTER TABLE `tmp_sindico`
  ADD CONSTRAINT `fk_sindico_copy1_condominio1` FOREIGN KEY (`idcond`) REFERENCES `condominio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_condominio1` FOREIGN KEY (`idcond`) REFERENCES `condominio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
