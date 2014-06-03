SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `salt` varchar(23) NOT NULL,
  `password` varchar(88) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `salt`, `password`, `mail`, `role`, `created_at`, `image`) VALUES
(1, 'admin', '1260889385528018eda0a12', 'YXylVBIE3HLEUNQEH5Z5bSua4vpEG0flg2V1OcpWw4wzel1nomjtkoG2XVKpug3R4hD18tI0Uj1r8z/3rXxtNg==', 'noreply@musicbox.nothing', 'ROLE_ADMIN', 1379889332, NULL);


--
-- Table structure for table `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id`, `name`) VALUES
(1, 'Alimentacao'),
(4, 'Carro'),
(3, 'Casa'),
(2, 'Estudo');

-- --------------------------------------------------------

--
-- Table structure for table `pgto`
--

CREATE TABLE IF NOT EXISTS `pgto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pgto`
--

INSERT INTO `pgto` (`id`, `name`) VALUES
(1, 'Dinheiro'),
(2, 'Master 1'),
(3, 'Visa 1'),
(4, 'Visa 2');

