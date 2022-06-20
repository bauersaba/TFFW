-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Jun-2022 às 02:22
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Banco de dados: `tffw`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados`
--

CREATE TABLE `dados` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `sobrenome` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `cpf` int(11) DEFAULT NULL,
  `fk_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `dados`
--

INSERT INTO `dados` (`id`, `nome`, `sobrenome`, `telefone`, `celular`, `cpf`, `fk_usuario`) VALUES
(1, 'Marcelo Bauer', 'Sabaraense', '19 22228577', '19 95899978', 12345678, 1),
(2, 'Edson ', 'Lima', '19 33335643', '19 99871234', 87654321, 2),
(3, 'Alciomar ', 'Holanda', '19 77765432', '19 99943251', 43215678, 5),
(4, 'Robson', 'Alves', '19 11111234', '19 97771234', 12345687, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `id` int(11) NOT NULL,
  `cep` int(11) DEFAULT NULL,
  `rua` varchar(50) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `fk_dados` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `fk_dados`) VALUES
(1, 13190310, 'Gessy Vieira ', 75, 'Jd Novo Cambui', 'Hortolandia.', 1),
(2, 13560967, 'Holanda', 456, 'Nova Roseira', 'Campinas', 3),
(3, 124560900, 'Da Rosas', 12, 'Primavera', 'São Paulo', 4),
(4, 11908000, 'Av. Ulisses Guimarães', 560, 'Bela Vista', 'Rio Claro', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `valorPedido` decimal(6,2) DEFAULT NULL,
  `quantidadeProduto` int(11) DEFAULT NULL,
  `fk_produto` int(11) DEFAULT NULL,
  `fk_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id`, `valorPedido`, `quantidadeProduto`, `fk_produto`, `fk_usuario`) VALUES
(2, '3500.00', 1, 1, 1),
(3, '340.00', 1, 2, 2),
(4, '190.00', 1, 3, 2),
(5, '8900.00', 1, 4, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nomeProduto` varchar(50) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `valorUnitario` decimal(6,2) DEFAULT NULL,
  `imagem` varchar(60) DEFAULT NULL,
  `thumb` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nomeProduto`, `qtd`, `valorUnitario`, `imagem`, `thumb`) VALUES
(1, 'Notebook Samsung S51', 12, '3500.00', 'imagens/samsung s51.jpeg', 'imagens/small_samsung s51.jpeg'),
(2, 'Mouse Logitech M560', 30, '245.00', 'imagens/logitech560.jpeg', 'imagens/small_logitech560.jpeg'),
(3, 'Headset Philco Gamer PH01', 10, '190.00', 'imagens/headsetphilcogamer.jpeg', 'imagens/small_headsetphilcogamer.jpeg'),
(4, 'Smart TV samsung 85 \" QLED 8K', 2, '8900.00', 'imagens/samsung8kqled.jpeg', 'imagens/small_samsung8kqled.jpeg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `senha`) VALUES
(1, 'mbauer', '1234'),
(2, 'elima', '1234'),
(3, 'super', '123456'),
(4, 'aholanda', '1234'),
(5, 'ralves', '1234');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `dados`
--
ALTER TABLE `dados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`fk_usuario`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dados` (`fk_dados`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produto` (`fk_produto`),
  ADD KEY `fk_usuario` (`fk_usuario`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dados`
--
ALTER TABLE `dados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `dados`
--
ALTER TABLE `dados`
  ADD CONSTRAINT `dados_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`fk_dados`) REFERENCES `dados` (`id`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`fk_produto`) REFERENCES `produto` (`id`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id`);
COMMIT;