-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28-Set-2017 às 17:26
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oficina`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `cdclie` varchar(14) CHARACTER SET utf8 NOT NULL,
  `declie` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `cdtipo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `nrinsc` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `nrccm` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `nrrg` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `deende` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `nrende` int(11) DEFAULT NULL,
  `decomp` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `debair` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `decida` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cdesta` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nrcepi` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `nrtele` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `nrcelu` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `demail` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `deobse` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `flativ` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`cdclie`, `declie`, `cdtipo`, `nrinsc`, `nrccm`, `nrrg`, `deende`, `nrende`, `decomp`, `debair`, `decida`, `cdesta`, `nrcepi`, `nrtele`, `nrcelu`, `demail`, `deobse`, `flativ`, `dtcada`) VALUES
('185.629.304-15', 'Maria de Lourdes Cabral Pereira', 'Fisica', '', '', '', 'Rua sexquicentenario', 131, '', 'centro', 'Natuba', '', '58494000', '', '', 'email@email.com.br', '', 'S', '2017-09-28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas`
--

CREATE TABLE `contas` (
  `cdcont` bigint(20) NOT NULL,
  `decont` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dtcont` date DEFAULT NULL,
  `vlcont` decimal(15,2) DEFAULT NULL,
  `cdtipo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `vlpago` decimal(15,2) DEFAULT NULL,
  `dtpago` date DEFAULT NULL,
  `cdquem` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `cdorig` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `deobse` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `flativ` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contas`
--

INSERT INTO `contas` (`cdcont`, `decont`, `dtcont`, `vlcont`, `cdtipo`, `vlpago`, `dtpago`, `cdquem`, `cdorig`, `deobse`, `flativ`, `dtcada`) VALUES
(4, 'Cliente a Receber', '2017-11-28', '1000.00', 'Receber', NULL, NULL, '185.629.304-15 - Maria de Lourdes Cabral Pereira', '1', NULL, 'Sim', '2017-09-28'),
(3, 'Cliente a Receber', '2017-10-28', '1000.00', 'Receber', NULL, NULL, '185.629.304-15 - Maria de Lourdes Cabral Pereira', '1', NULL, 'Sim', '2017-09-28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

CREATE TABLE `estados` (
  `cdesta` char(2) CHARACTER SET utf8 NOT NULL,
  `deesta` char(35) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estados`
--

INSERT INTO `estados` (`cdesta`, `deesta`) VALUES
('AC', 'Acre'),
('AL', 'Alagoas'),
('AM', 'Amazonas'),
('AP', 'Amapá'),
('BA', 'Bahia'),
('CE', 'Ceará'),
('DF', 'Distrito Federal'),
('ES', 'Espírito Santo'),
('GO', 'Goiás'),
('MA', 'Maranhão'),
('MG', 'Minas Gerais'),
('MS', 'Mato Grosso do Sul'),
('MT', 'Mato Grosso'),
('PA', 'Pará'),
('PB', 'Paraíba'),
('PE', 'Pernambuco'),
('PI', 'Piauí'),
('PR', 'Paraná'),
('RJ', 'Rio de Janeiro'),
('RN', 'Rio Grande do Norte'),
('RO', 'Rondônia'),
('RR', 'Roraima'),
('RS', 'Rio Grande do Sul'),
('SC', 'Santa Catarina'),
('SE', 'Sergipe'),
('SP', 'São Paulo'),
('TO', 'Tocantins');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `cdforn` varchar(14) CHARACTER SET utf8 NOT NULL,
  `deforn` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `cdtipo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `nrinsc` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `nrccm` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `nrrg` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `deende` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `nrende` int(11) DEFAULT NULL,
  `decomp` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `debair` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `decida` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cdesta` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nrcepi` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `nrtele` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `nrcelu` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `demail` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `deobse` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `flativ` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`cdforn`, `deforn`, `cdtipo`, `nrinsc`, `nrccm`, `nrrg`, `deende`, `nrende`, `decomp`, `debair`, `decida`, `cdesta`, `nrcepi`, `nrtele`, `nrcelu`, `demail`, `deobse`, `flativ`, `dtcada`) VALUES
('1234667899145', 'Empresa teste', 'FÃ­sica', '', '', '', '', 0, '', '', 'Natuba', 'PB', '58494000', '', '', 'email@email.com.br', '', 'S', '2017-09-28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE `logs` (
  `cdusua` varchar(100) NOT NULL,
  `dtlog` varchar(20) NOT NULL,
  `delog` varchar(500) NOT NULL,
  `iplog` varchar(50) NOT NULL,
  `flativ` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`cdusua`, `dtlog`, `delog`, `iplog`, `flativ`) VALUES
('2', '2017-09-28 10:54:56', 'Acesso ao Sistema', '::1', 'S'),
('2', '2017-09-28 10:56:25', 'InclusÃ£o de clientes na tabela [clientes]', '::1', 'S'),
('2', '2017-09-28 10:56:47', 'AlteraÃ§Ã£o de dados na tabela [clientes] Cpf/Cnpj 185.629.304-15', '::1', 'S'),
('2', '2017-09-28 10:58:06', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-28 10:58:06', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-28 10:58:06', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-28 10:59:29', 'InclusÃ£o de dados na tabela [fornecedores]', '::1', 'S'),
('2', '2017-09-28 15:06:51', 'Acesso ao Sistema', '::1', 'S'),
('4', '2017-09-28 15:09:40', 'Acesso ao Sistema', '::1', 'S'),
('2', '2017-09-28 15:09:47', 'Acesso ao Sistema', '::1', 'S'),
('2', '2017-09-28 15:16:12', 'Acesso ao Sistema', '::1', 'S'),
('2', '2017-09-28 15:29:22', 'Acesso ao Sistema', '::1', 'S'),
('2', '2017-09-28 15:57:11', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] codigo 1', '::1', 'S'),
('2', '2017-09-28 15:57:11', 'AlteraÃ§Ã£o de dados na tabela [ordem] codigo 1', '::1', 'S'),
('2', '2017-09-28 15:57:11', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-28 15:57:11', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-28 17:11:30', 'Acesso ao Sistema', '::1', 'S'),
('2', '2017-09-28 17:14:18', 'Acesso ao Sistema', '::1', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem`
--

CREATE TABLE `ordem` (
  `cdorde` bigint(20) NOT NULL,
  `cdclie` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `veplac` char(7) CHARACTER SET utf8 DEFAULT NULL,
  `vemarc` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `vemode` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `veanom` char(4) CHARACTER SET utf8 DEFAULT NULL,
  `veanof` char(4) CHARACTER SET utf8 DEFAULT NULL,
  `vecorv` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `cdsitu` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `dtorde` date DEFAULT NULL,
  `vlorde` decimal(15,2) DEFAULT NULL,
  `cdform` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `qtform` int(11) DEFAULT NULL,
  `vlpago` decimal(15,2) DEFAULT NULL,
  `dtpago` date DEFAULT NULL,
  `deobse` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `flativ` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `dtcada` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ordem`
--

INSERT INTO `ordem` (`cdorde`, `cdclie`, `veplac`, `vemarc`, `vemode`, `veanom`, `veanof`, `vecorv`, `cdsitu`, `dtorde`, `vlorde`, `cdform`, `qtform`, `vlpago`, `dtpago`, `deobse`, `flativ`, `dtcada`) VALUES
(1, '185.629.304-15 - Maria de Lourdes Cabral Pereira', '', '', '', '', '', '', 'Pendente', '2017-09-28', '2000.00', 'Dinheiro', 2, '0.00', '0000-00-00', '', 'Sim', '2017-09-28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordemi`
--

CREATE TABLE `ordemi` (
  `cdorde` bigint(20) DEFAULT NULL,
  `nritem` int(11) DEFAULT NULL,
  `cdpeca` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `qtpeca` int(11) DEFAULT NULL,
  `vlpeca` decimal(15,2) DEFAULT NULL,
  `vltota` decimal(15,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ordemi`
--

INSERT INTO `ordemi` (`cdorde`, `nritem`, `cdpeca`, `qtpeca`, `vlpeca`, `vltota`) VALUES
(1, 1, '2 - reparo geral', 1, '2000.00', '2000.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `parametros`
--

CREATE TABLE `parametros` (
  `cdprop` varchar(14) CHARACTER SET utf8 NOT NULL,
  `deprop` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `nrinsc` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `nrccm` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `deende` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `nrende` int(11) DEFAULT NULL,
  `decomp` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `debair` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `decida` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `cdesta` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nrcepi` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `nrtele` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `nrcelu` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `demail` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `parametros`
--

INSERT INTO `parametros` (`cdprop`, `deprop`, `nrinsc`, `nrccm`, `deende`, `nrende`, `decomp`, `debair`, `decida`, `cdesta`, `nrcepi`, `nrtele`, `nrcelu`, `demail`) VALUES
('00000000000000', 'Oficina Template', 'Isento', '2345', 'Rua do aÃ§ude', 1520, 'Apto 004 A', 'Centro', 'Cidade', 'AC - Acre', '', '00-0000', '00-0000', 'email@email.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pecas`
--

CREATE TABLE `pecas` (
  `cdpeca` varchar(30) CHARACTER SET utf8 NOT NULL,
  `depeca` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `vlpeca` decimal(15,2) DEFAULT NULL,
  `qtpeca` int(11) DEFAULT NULL,
  `flativ` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pecas`
--

INSERT INTO `pecas` (`cdpeca`, `depeca`, `vlpeca`, `qtpeca`, `flativ`, `dtcada`) VALUES
('10', '10', '2.58', 10, NULL, NULL),
('2', '2', '0.52', 2, NULL, NULL),
('3', '3', '0.78', 3, NULL, NULL),
('4', '4', '1.03', 4, NULL, NULL),
('5', '5', '1.29', 5, NULL, NULL),
('6', '6', '1.55', 6, NULL, NULL),
('7', '7', '1.81', 7, NULL, NULL),
('8', '8', '2.07', 8, NULL, NULL),
('9', '9', '2.33', 9, NULL, NULL),
('1010', 'Tampa do Reservatório do Óleo', '15.00', 1, NULL, NULL),
('1233', 'motor completo', '2500.00', 5, NULL, NULL),
('80973102937012938', 'Bucha da rebimboca da parafuseta', '195.43', 299, NULL, NULL),
('003', 'COXIM DO MOTOR', '199.00', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `cdpedi` bigint(20) NOT NULL,
  `cdforn` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dtpedi` date DEFAULT NULL,
  `vlpedi` decimal(15,2) DEFAULT NULL,
  `vlpago` decimal(15,2) DEFAULT NULL,
  `dtpago` date DEFAULT NULL,
  `cdform` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `qtform` int(11) DEFAULT NULL,
  `decont` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dtentr` date DEFAULT NULL,
  `deobse` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `flativ` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidosi`
--

CREATE TABLE `pedidosi` (
  `cdpedi` bigint(20) DEFAULT NULL,
  `nritem` int(11) DEFAULT NULL,
  `cdpeca` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `qtpeca` int(11) DEFAULT NULL,
  `vlpeca` decimal(15,2) DEFAULT NULL,
  `vltota` decimal(15,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `cdserv` varchar(30) CHARACTER SET utf8 NOT NULL,
  `deserv` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `vlserv` decimal(15,2) DEFAULT NULL,
  `qtserv` int(11) DEFAULT NULL,
  `flativ` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`cdserv`, `deserv`, `vlserv`, `qtserv`, `flativ`, `dtcada`) VALUES
('2', 'reparo geral', '2000.00', 1, NULL, NULL),
('3', '3', '300.00', 3, NULL, NULL),
('4', '4', '4.00', 4, NULL, NULL),
('5', '5', '5.00', 5, NULL, NULL),
('6', '6', '6.00', 6, NULL, NULL),
('7', '7', '7.00', 7, NULL, NULL),
('8', '8', '8.00', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `cdusua` int(14) NOT NULL,
  `deusua` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `demail` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `nrtele` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `cdtipo` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `defoto` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `delogin` varchar(100) CHARACTER SET utf8 NOT NULL,
  `desenh` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `flativ` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`cdusua`, `deusua`, `demail`, `nrtele`, `cdtipo`, `defoto`, `delogin`, `desenh`, `flativ`, `dtcada`) VALUES
(2, 'Flavio Pereira', 'email@email.com.br', '8321070000', 'Administrador', '../../templates/img/2Desert.jpg', 'flavio', '202cb962ac59075b964b07152d234b70', 'S', '2017-08-31'),
(4, 'Pedro da Silva Cabral', 'email@email.com.br', '8321070000', 'Funcionario', 'img/semfoto.jpg', 'pedro', 'e10adc3949ba59abbe56e057f20f883e', 'S', '2017-08-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cdclie`);

--
-- Indexes for table `contas`
--
ALTER TABLE `contas`
  ADD PRIMARY KEY (`cdcont`),
  ADD KEY `icontas1` (`decont`,`dtcont`),
  ADD KEY `icontas2` (`dtcont`,`cdquem`),
  ADD KEY `icontas3` (`dtcont`,`cdorig`);

--
-- Indexes for table `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`cdesta`);

--
-- Indexes for table `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`cdforn`);

--
-- Indexes for table `ordem`
--
ALTER TABLE `ordem`
  ADD PRIMARY KEY (`cdorde`),
  ADD KEY `iordem1` (`cdclie`,`dtorde`),
  ADD KEY `iordem2` (`cdform`,`dtorde`),
  ADD KEY `iordem3` (`cdclie`,`dtpago`),
  ADD KEY `iordem4` (`cdform`,`dtpago`);

--
-- Indexes for table `ordemi`
--
ALTER TABLE `ordemi`
  ADD KEY `iordemi1` (`cdorde`,`nritem`,`cdpeca`);

--
-- Indexes for table `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`cdprop`);

--
-- Indexes for table `pecas`
--
ALTER TABLE `pecas`
  ADD PRIMARY KEY (`cdpeca`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`cdpedi`),
  ADD KEY `ipedidos1` (`cdforn`,`cdpedi`,`dtpedi`);

--
-- Indexes for table `pedidosi`
--
ALTER TABLE `pedidosi`
  ADD KEY `ipedidosi1` (`cdpedi`,`nritem`,`cdpeca`);

--
-- Indexes for table `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`cdserv`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cdusua`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contas`
--
ALTER TABLE `contas`
  MODIFY `cdcont` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ordem`
--
ALTER TABLE `ordem`
  MODIFY `cdorde` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `cdpedi` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cdusua` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
