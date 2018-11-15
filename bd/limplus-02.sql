-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Nov-2018 às 16:03
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `limplus`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncias`
--

CREATE TABLE `denuncias` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `bairro` varchar(120) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `descricao` text NOT NULL,
  `data_denuncia` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `denuncias`
--

INSERT INTO `denuncias` (`id`, `id_usuario`, `bairro`, `cep`, `descricao`, `data_denuncia`) VALUES
(1, 1, 'Campos ElÃ­sios', '74959-035', 'Muita chuva, acumulo de lixo no setor, nÃ£o aguento mais', '2018-11-15 12:05:34'),
(2, 1, 'Setor Exemplo', '74858-89', 'Muito tempo sem a coleta!', '2018-11-15 13:00:19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncias_imagens`
--

CREATE TABLE `denuncias_imagens` (
  `id` int(11) NOT NULL,
  `id_denuncia` int(11) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `denuncias_imagens`
--

INSERT INTO `denuncias_imagens` (`id`, `id_denuncia`, `url`) VALUES
(2, 1, '32253f944e23967c67ee87546213d54a.jpg'),
(3, 2, 'f142e8517f4e88bc59da015a1db28615.jpg'),
(4, 2, '53ad4039e0ab4134dec00a9718f34c12.jpg'),
(5, 2, '109ad1ab26be676e0ad1beed2d3e50e7.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `telefone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `telefone`) VALUES
(1, 'Lucas', 'lucas@gmail.com', 'a0c5e2a3637aed9bf0809dab82028053', '(62) 9 9496-2973');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `denuncias`
--
ALTER TABLE `denuncias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `denuncias_imagens`
--
ALTER TABLE `denuncias_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `denuncias`
--
ALTER TABLE `denuncias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `denuncias_imagens`
--
ALTER TABLE `denuncias_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
