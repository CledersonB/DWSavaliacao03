-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 24-Jun-2023 às 00:13
-- Versão do servidor: 8.0.32
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `veiculos_tesla`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'admin', 'admin@admin', 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculos`
--

DROP TABLE IF EXISTS `veiculos`;
CREATE TABLE IF NOT EXISTS `veiculos` (
  `idveiculo` int NOT NULL AUTO_INCREMENT,
  `modelo` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `ano` varchar(4) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cor` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fabricante` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipo_motor` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idveiculo`),
  UNIQUE KEY `idveiculo_UNIQUE` (`idveiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `veiculos`
--

INSERT INTO `veiculos` (`idveiculo`, `modelo`, `ano`, `cor`, `fabricante`, `tipo_motor`) VALUES
(1, 'Testa xy', '2023', 'Verde', 'Tesla', 'Hibrido'),
(5, 'xr3', '2020', 'Vermelho', 'Vw', 'Eletrico'),
(6, '3tm', '2019', 'Branco', 'Tesla', 'Hibrido'),
(7, 'th4', '2023', 'Preto', 'Tesla', 'Eletrico'),
(9, 'tungmas', '2020', 'Preto', 'VW', 'Combustao'),
(11, 't-rex', '2023', 'Branco', 'Tesla', 'Hibrido'),
(21, 'carrango', '2020', 'Vermelho', 'nvbnvb', 'Combustao'),
(25, 'hghfgh', '2020', 'Prata', 'gfhfhgf', 'Combustao'),
(27, 'testa xr3', '2023', 'Preto', 'Tesla', 'Combustao'),
(28, 'Raptor', '2018', 'Branco', 'Fiat', 'Combustao'),
(29, 'Seila ', '2015', 'Personalizada', 'vw', 'Eletrico'),
(30, 'teste', '2023', 'Preto', 'teste', 'Eletrico'),
(32, 'miodomundo', '2023', 'Vermelho', 'Timbica motors', 'Combustao');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
