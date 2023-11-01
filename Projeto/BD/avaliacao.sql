-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31/10/2023 às 21:24
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `avaliacao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `domains`
--

CREATE TABLE `domains` (
  `domain` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `domains`
--

INSERT INTO `domains` (`domain`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
('@gmail.com', 'ativo', 'Super', '2023-10-31', '2023-10-31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tickets`
--

CREATE TABLE `tickets` (
  `title` varchar(240) NOT NULL,
  `protocol` int(240) NOT NULL,
  `type` varchar(240) NOT NULL,
  `description` varchar(240) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `responsable_id` varchar(50) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `user_type` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `password` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`domain`),
  ADD UNIQUE KEY `domain` (`domain`);

--
-- Índices de tabela `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`protocol`),
  ADD UNIQUE KEY `protocol` (`protocol`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
