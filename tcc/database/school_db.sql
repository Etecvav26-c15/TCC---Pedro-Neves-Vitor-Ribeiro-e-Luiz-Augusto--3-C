-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2026 at 03:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_db`
--

CREATE DATABASE IF NOT EXISTS school_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE school_db;

-- --------------------------------------------------------

--
-- Table structure for table `alunos_turma`
--

CREATE TABLE `alunos_turma` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL,
  `ano_letivo` year(4) NOT NULL,
  `data_matricula` date NOT NULL,
  `status` enum('cursando','transferido','concluido','evadido') DEFAULT 'cursando'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alunos_turma`
--

INSERT INTO `alunos_turma` (`id`, `aluno_id`, `turma_id`, `ano_letivo`, `data_matricula`, `status`) VALUES
(1, 2, 1, '2026', '2026-06-30', 'cursando'),
(2, 3, 1, '2026', '2026-06-30', 'cursando'),
(3, 4, 1, '2026', '2026-06-30', 'cursando');

-- --------------------------------------------------------

--
-- Table structure for table `chamadas`
--

CREATE TABLE `chamadas` (
  `id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `data_aula` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chamadas`
--

INSERT INTO `chamadas` (`id`, `professor_id`, `turma_id`, `materia_id`, `data_aula`) VALUES
(1, 6, 1, 3, '2026-09-19');

-- --------------------------------------------------------

--
-- Table structure for table `chamada_alunos`
--

CREATE TABLE `chamada_alunos` (
  `id` int(11) NOT NULL,
  `chamada_id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `presenca` enum('presente','ausente','justificado') NOT NULL DEFAULT 'ausente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chamada_alunos`
--

INSERT INTO `chamada_alunos` (`id`, `chamada_id`, `aluno_id`, `presenca`) VALUES
(1, 1, 2, 'presente'),
(2, 1, 3, 'ausente'),
(3, 1, 4, 'justificado');

-- --------------------------------------------------------

--
-- Table structure for table `faltas`
--

CREATE TABLE `faltas` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL,
  `ano_letivo` year(4) NOT NULL,
  `total_faltas` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `horarios_aula`
--

CREATE TABLE `horarios_aula` (
  `id` int(11) NOT NULL,
  `professor_turma_materia_id` int(11) NOT NULL,
  `dia_semana` enum('Segunda','Terça','Quarta','Quinta','Sexta','Sábado') NOT NULL,
  `horario_inicio` time NOT NULL,
  `horario_fim` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `horarios_aula`
--

INSERT INTO `horarios_aula` (`id`, `professor_turma_materia_id`, `dia_semana`, `horario_inicio`, `horario_fim`) VALUES
(3, 1, 'Segunda', '10:15:00', '11:05:00'),
(4, 2, 'Segunda', '07:30:00', '08:20:00'),
(5, 2, 'Segunda', '08:20:00', '09:10:00'),
(6, 2, 'Segunda', '09:10:00', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `logs_sistema`
--

CREATE TABLE `logs_sistema` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `acao` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs_sistema`
--

INSERT INTO `logs_sistema` (`id`, `usuario_id`, `acao`, `descricao`, `ip`, `user_agent`, `created_at`) VALUES
(1, 1, 'login_fail', 'Senha incorreta', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-15 19:44:29'),
-- --------------------------------------------------------

--
-- Table structure for table `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `carga_horaria` int(11) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materias`
--

INSERT INTO `materias` (`id`, `nome`, `codigo`, `descricao`, `carga_horaria`, `ativo`) VALUES
(1, 'Internet, Protocolos e Segurança de Sistemas de Informação', 'IPSSI', '', 0, 1),
(3, 'Planejamento e Desenvolvimento do TCC em Desenvolvimento de Sistemas', 'TCC', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `remetente_id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `conteudo` text NOT NULL,
  `destinatario_tipo` enum('todos','aluno','professor','turma') NOT NULL,
  `destinatario_id` int(11) DEFAULT NULL,
  `data_envio` datetime DEFAULT current_timestamp(),
  `lida` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `bimestre` enum('1','2','3','4') NOT NULL,
  `ano_letivo` year(4) NOT NULL,
  `nota` enum('I','R','B','MB','NA') NOT NULL DEFAULT 'NA',
  `observacao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notas`
--

INSERT INTO `notas` (`id`, `aluno_id`, `materia_id`, `turma_id`, `professor_id`, `bimestre`, `ano_letivo`, `nota`, `observacao`) VALUES
(1, 2, 3, 1, 6, '1', '2026', 'B', NULL),
(2, 3, 3, 1, 6, '1', '2026', 'B', NULL),
(3, 4, 3, 1, 6, '1', '2026', 'B', NULL),
(4, 2, 3, 1, 6, '2', '2026', 'B', NULL),
(5, 3, 3, 1, 6, '2', '2026', 'B', NULL),
(6, 4, 3, 1, 6, '2', '2026', 'B', NULL),
(7, 2, 3, 1, 6, '3', '2026', 'R', NULL),
(8, 3, 3, 1, 6, '3', '2026', 'R', NULL),
(9, 4, 3, 1, 6, '3', '2026', 'R', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `planos_aula`
--

CREATE TABLE `planos_aula` (
  `id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `conteudo` text NOT NULL,
  `data_plano` date NOT NULL,
  `status` enum('rascunho','enviado','aprovado') DEFAULT 'enviado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `planos_aula`
--

INSERT INTO `planos_aula` (`id`, `professor_id`, `materia_id`, `titulo`, `conteudo`, `data_plano`, `status`) VALUES
(1, 6, 3, 'Apresentação TCC', 'Os alunos deverão apresentar no dia 21/09 o seu TCC praticamente finalizado, onde devem mostrar a funcionalidade do site que desenvolveram, apresentar os slides, além de ter o artigo finalizado', '2026-09-21', 'enviado');

-- --------------------------------------------------------

--
-- Table structure for table `professor_turma_materia`
--

CREATE TABLE `professor_turma_materia` (
  `id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `ano_letivo` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professor_turma_materia`
--

INSERT INTO `professor_turma_materia` (`id`, `professor_id`, `turma_id`, `materia_id`, `ano_letivo`) VALUES
(1, 5, 1, 1, '2026'),
(2, 6, 1, 3, '2026');

-- --------------------------------------------------------

--
-- Table structure for table `tokens_recuperacao`
--

CREATE TABLE `tokens_recuperacao` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `token` varchar(128) NOT NULL,
  `expira_em` datetime NOT NULL,
  `usado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tokens_recuperacao`
--

INSERT INTO `tokens_recuperacao` (`id`, `usuario_id`, `token`, `expira_em`, `usado`) VALUES
(1, 1, 'cd4cf3770a36ed0007cccd78ca91917f1f41752d5ed390fae6cf7a8485971906', '2026-07-27 23:11:12', 0),
(2, 1, '5d25e8c5d17827e444668224524ad93e20e24e8316f1066fc1c4116fc13ad289', '2026-07-27 23:11:17', 0),
(3, 1, '5b318e054c41742ed306ee27feef6752161c6cbdf14614cbe5547862bfbf2ef6', '2026-07-27 23:11:21', 0),
(4, 1, '4369ab7ff0aaea21486516df82ee6ce1710338e71500ae8c48e35923f82aa4a6', '2026-07-27 23:11:25', 0),
(5, 1, '218b031c27744b3ebb5f7a2b3e266ac1ec617f5f0786d5e02730648825a1a0c5', '2026-07-27 23:11:29', 0),
(6, 1, '7d2081af0376f25c299f2d9a0221aac0d95ac94cb50273e2025c26c11f6c2a84', '2026-07-27 23:11:33', 0),
(7, 1, '04da028ef0b2a9bda5a60a45627f6d338929b0d092192576d6e79dae59570d9a', '2026-07-27 23:11:37', 0),
(8, 1, 'f4f8a1ca396181468dcff69fc72968582c37130218fa37f0310e1a84adff05a5', '2026-07-27 23:11:41', 0),
(9, 1, '308952b87f9ad0d818e3ce6d263cbadcd4767586399d655ba9c8a41c6c03974e', '2026-07-27 23:16:07', 0),
(10, 1, 'abda38d4679b10e4a83b42644a98826ba6f099bb80ce49ae72dde79fad1551fa', '2026-07-27 23:16:12', 0),
(11, 1, '62885e2d15d76ae0c8662c74bf19903ac3cc55e30113c4e2f3606d0e31ee65ca', '2026-07-27 23:18:29', 0),
(12, 1, 'd73d012aa56efbb85fdab7022cdcdfbb3d601367998c94ea0170248c46ee3987', '2026-07-27 23:19:00', 0),
(13, 1, '8c2b0e8003415c8f6e6c012c9bd4879daacb504893ff1744fa4c993ea725cebe', '2026-07-27 23:21:39', 0),
(14, 1, 'accd8fd7e4d85543cc40e3f4a6a5fd423c2dfe2cee6207567cbdf9d01fe8dd1f', '2026-07-27 23:24:08', 0),
(15, 1, '5894ffb71aca776c6cdfbd1f5fbd0f42f7674bbb0ef13f8f5059ef0b9e6c01b8', '2026-07-27 23:29:28', 0),
(16, 1, '52fd1fb4543af2a19c5ad828c182273e30177297da9f4044d80f5492cf7854b6', '2026-07-27 23:29:56', 0),
(17, 1, '5642f550acba6ae8aaa5c7892de4f138f0596bbbfc711ac32d16c52a5ae24246', '2026-07-27 23:31:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `turmas`
--

CREATE TABLE `turmas` (
  `id` int(11) NOT NULL,
  `nome` varchar(10) NOT NULL COMMENT 'Ex: 3C, 2A, 1S',
  `ano_letivo` year(4) NOT NULL,
  `turno` enum('matutino','vespertino','noturno','integral') NOT NULL,
  `sala` varchar(20) DEFAULT NULL,
  `capacidade` int(11) DEFAULT 40,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `turmas`
--

INSERT INTO `turmas` (`id`, `nome`, `ano_letivo`, `turno`, `sala`, `capacidade`, `ativo`) VALUES
(1, '3C', '2026', 'integral', '', 40, 1),
(2, '1C¹', '2026', 'matutino', '', 40, 1),
(3, '1C³', '2026', 'matutino', '', 40, 1),
(4, '1C²', '2026', 'vespertino', '', 40, 1),
(5, '2C¹', '2026', 'matutino', '', 40, 1),
(6, '2C²', '2026', 'vespertino', '', 40, 1),
(7, '1B', '2026', 'integral', '', 40, 1),
(8, '2B', '2026', 'integral', '', 40, 1),
(9, '3B', '2026', 'integral', '', 40, 1),
(10, '1A', '2026', 'integral', '', 40, 1),
(11, '2A', '2026', 'integral', '', 40, 1),
(12, '3A', '2026', 'integral', '', 40, 1),
(13, '1D¹', '2026', 'matutino', '', 40, 1),
(14, '1D²', '2026', 'vespertino', '', 40, 1),
(15, '2D', '2026', 'matutino', '', 40, 1),
(16, '3D', '2026', 'integral', '', 40, 1),
(17, '1E', '2026', 'matutino', '', 40, 1),
(18, '2E', '2026', 'matutino', '', 40, 1),
(19, '3E', '2026', 'matutino', '', 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `encrypted_password` text NOT NULL,
  `tipo` enum('aluno','professor','coordenador') NOT NULL,
  `matricula` varchar(50) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `ultimo_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `encrypted_password`, `tipo`, `matricula`, `cpf`, `telefone`, `data_nascimento`, `ativo`, `ultimo_login`, `created_at`, `updated_at`) VALUES
(1, 'Vitor Nobrega Ribeiro', 'vitornribeiro2@gmail.com', 'HnEb6sYZPjLXEsgdTl9+s13IpKcXHrXZT7Tljw4pk4Nxh09aP5/KjyQpYWj7aLOcdAa7KFswZF5fBuZqaBQ/cKcENu74QTGJGAXj568Rn/A=', 'coordenador', '170809', '56928965835', '11 950777172', '2009-03-16', 1, '2026-09-18 22:23:25', '2026-06-15 19:31:35', '2026-09-18 22:23:25'),
(2, 'Adrian Morales Fernandes de Lima', 'Adrian.Morales15@gmail.com', '9L3iZEKxi0fndpvFlcqmjqwdfDAt4bAqpA+lwYoh5ojp/WLmJJsawIvMdyq3Q5KvbpcOU+Pvs7wTMn1rsmVd9IjuW7G/w9g9KFWKwzAaEeM=', 'aluno', '170180', NULL, NULL, NULL, 1, '2026-09-18 22:16:48', '2026-06-30 07:42:57', '2026-09-18 22:16:48'),
(3, 'Antonio Miguel Alves dos Santos', 'Antonio.miguel01@gmail.com', 'nnc+1VupM7OFXm1b9Sa93rSUa8TjpL1a/pWimdpSyaoVZvmZFtFS4zKcOwhtOdOQFrqgKAWDtoamxvFc9B4fKqtIohFOiBw4CQ9HGVm3YwM=', 'aluno', '170181', NULL, NULL, NULL, 1, NULL, '2026-06-30 07:53:42', '2026-06-30 07:53:42'),
(4, 'Pedro Neves Ovídio', 'Pedro.ovidio12@gmail.com', 'uWNeZ6PDKAXH1VoTEYFEDJ2ub9TPNEkTSftYGJA2wMTQLUkQ6ENaAv810l5jzA9fjWAQuYsLmD3TDS2TIczf9yi2Yp5GPznDOd0CNtLXr9E=', 'aluno', '170182', NULL, NULL, NULL, 1, NULL, '2026-06-30 08:10:58', '2026-06-30 08:10:58'),
(5, 'Henderson Tavares de Souza', 'Henderson.Tavares@gmail.com', 'Zy5ysy5DDvJvE3B1YoYFV1LNtCs/tRlz7OUy9ofw7H/q77jJqN1TntI2igY81zkbhPuONtoR+ot/X3bhtjrDd9ROtWzttk9gDipxYohkpSg=', 'professor', '160180', NULL, NULL, NULL, 1, NULL, '2026-06-30 08:23:23', '2026-06-30 08:23:23'),
(6, 'Ronildo Aparecido Ferreira', 'Ronildo.Aparecido@gmail.com', 'tNg/1nUcVcdSptYgtb0NbE4Fk50VIBK1/q/ilAhk+kj2eoQx+/cjXmfUvJjVY2Zv+EXkF1PC+Foi7bz4n40H5uWM9VDhfN3yOZq/2VGEDWE=', 'professor', '11300', NULL, NULL, NULL, 1, '2026-09-18 22:17:19', '2026-07-27 19:29:26', '2026-09-18 22:17:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alunos_turma`
--
ALTER TABLE `alunos_turma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `turma_id` (`turma_id`);

--
-- Indexes for table `chamadas`
--
ALTER TABLE `chamadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_id` (`professor_id`),
  ADD KEY `turma_id` (`turma_id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `idx_chamadas_data` (`data_aula`);

--
-- Indexes for table `chamada_alunos`
--
ALTER TABLE `chamada_alunos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chamada_id` (`chamada_id`),
  ADD KEY `aluno_id` (`aluno_id`);

--
-- Indexes for table `faltas`
--
ALTER TABLE `faltas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `turma_id` (`turma_id`);

--
-- Indexes for table `horarios_aula`
--
ALTER TABLE `horarios_aula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_turma_materia_id` (`professor_turma_materia_id`);

--
-- Indexes for table `logs_sistema`
--
ALTER TABLE `logs_sistema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indexes for table `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remetente_id` (`remetente_id`);

--
-- Indexes for table `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `turma_id` (`turma_id`),
  ADD KEY `professor_id` (`professor_id`),
  ADD KEY `idx_notas_aluno` (`aluno_id`,`ano_letivo`);

--
-- Indexes for table `planos_aula`
--
ALTER TABLE `planos_aula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_id` (`professor_id`),
  ADD KEY `materia_id` (`materia_id`);

--
-- Indexes for table `professor_turma_materia`
--
ALTER TABLE `professor_turma_materia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_prof_turma_mat` (`professor_id`,`turma_id`,`materia_id`,`ano_letivo`),
  ADD KEY `turma_id` (`turma_id`),
  ADD KEY `materia_id` (`materia_id`);

--
-- Indexes for table `tokens_recuperacao`
--
ALTER TABLE `tokens_recuperacao`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `matricula` (`matricula`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alunos_turma`
--
ALTER TABLE `alunos_turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chamadas`
--
ALTER TABLE `chamadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chamada_alunos`
--
ALTER TABLE `chamada_alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faltas`
--
ALTER TABLE `faltas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `horarios_aula`
--
ALTER TABLE `horarios_aula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logs_sistema`
--
ALTER TABLE `logs_sistema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `planos_aula`
--
ALTER TABLE `planos_aula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `professor_turma_materia`
--
ALTER TABLE `professor_turma_materia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tokens_recuperacao`
--
ALTER TABLE `tokens_recuperacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alunos_turma`
--
ALTER TABLE `alunos_turma`
  ADD CONSTRAINT `alunos_turma_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `alunos_turma_ibfk_2` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`);

--
-- Constraints for table `chamadas`
--
ALTER TABLE `chamadas`
  ADD CONSTRAINT `chamadas_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `chamadas_ibfk_2` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`),
  ADD CONSTRAINT `chamadas_ibfk_3` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`);

--
-- Constraints for table `chamada_alunos`
--
ALTER TABLE `chamada_alunos`
  ADD CONSTRAINT `chamada_alunos_ibfk_1` FOREIGN KEY (`chamada_id`) REFERENCES `chamadas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chamada_alunos_ibfk_2` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `faltas`
--
ALTER TABLE `faltas`
  ADD CONSTRAINT `faltas_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `faltas_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `faltas_ibfk_3` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`);

--
-- Constraints for table `horarios_aula`
--
ALTER TABLE `horarios_aula`
  ADD CONSTRAINT `horarios_aula_ibfk_1` FOREIGN KEY (`professor_turma_materia_id`) REFERENCES `professor_turma_materia` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mensagens`
--
ALTER TABLE `mensagens`
  ADD CONSTRAINT `mensagens_ibfk_1` FOREIGN KEY (`remetente_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `notas_ibfk_3` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`),
  ADD CONSTRAINT `notas_ibfk_4` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `planos_aula`
--
ALTER TABLE `planos_aula`
  ADD CONSTRAINT `planos_aula_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `planos_aula_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`);

--
-- Constraints for table `professor_turma_materia`
--
ALTER TABLE `professor_turma_materia`
  ADD CONSTRAINT `professor_turma_materia_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `professor_turma_materia_ibfk_2` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`),
  ADD CONSTRAINT `professor_turma_materia_ibfk_3` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`);

--
-- Constraints for table `tokens_recuperacao`
--
ALTER TABLE `tokens_recuperacao`
  ADD CONSTRAINT `tokens_recuperacao_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
