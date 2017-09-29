-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29-Set-2017 às 17:02
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
(31, 'Cliente a Receber', '2017-10-29', '2.50', 'Receber', NULL, NULL, '185.629.304-15 - Maria de Lourdes Cabral Pereira', '25', NULL, 'Sim', '2017-09-29');

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
('2', '2017-09-29 10:21:44', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] codigo 2', '::1', 'S'),
('2', '2017-09-29 10:21:44', 'AlteraÃ§Ã£o de dados na tabela [ordem] codigo 2', '::1', 'S'),
('2', '2017-09-29 10:21:44', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 10:21:44', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 10:23:02', 'AlteraÃ§Ã£o de dados na tabela [contas] chave 9', '::1', 'S'),
('2', '2017-09-29 10:29:11', 'AlteraÃ§Ã£o de dados na tabela [contas] chave 7', '::1', 'S'),
('2', '2017-09-29 10:29:33', 'AlteraÃ§Ã£o de dados na tabela [contas] chave 7', '::1', 'S'),
('2', '2017-09-29 10:49:37', 'ExclusÃ£o de dados na tabela [pedidos] codigo 1', '::1', 'S'),
('2', '2017-09-29 10:49:37', 'AlteraÃ§Ã£o de dados na tabela [pedidos] codigo 1', '::1', 'S'),
('2', '2017-09-29 10:49:37', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 10:49:37', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 10:58:50', 'InclusÃ£o de dados na tabela [pedidos] codigo ', '::1', 'S'),
('2', '2017-09-29 10:58:50', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 11:02:55', 'ExclusÃ£o de dados na tabela [pedidos] codigo 1', '::1', 'S'),
('2', '2017-09-29 11:02:55', 'AlteraÃ§Ã£o de dados na tabela [pedidos] codigo 1', '::1', 'S'),
('2', '2017-09-29 11:02:55', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 11:02:55', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 11:03:11', 'ExclusÃ£o de dados na tabela [pedidos] codigo 2', '::1', 'S'),
('2', '2017-09-29 11:03:11', 'AlteraÃ§Ã£o de dados na tabela [pedidos] codigo 2', '::1', 'S'),
('2', '2017-09-29 11:03:11', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 11:05:15', 'ExclusÃ£o de dados na tabela [pedidos] codigo 1', '::1', 'S'),
('2', '2017-09-29 11:05:15', 'AlteraÃ§Ã£o de dados na tabela [pedidos] codigo 1', '::1', 'S'),
('2', '2017-09-29 11:05:15', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 11:05:15', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 12:17:14', 'Acesso ao Sistema', '::1', 'S'),
('2', '2017-09-29 12:18:13', 'ExclusÃ£o de dados na tabela [pedidos] codigo 2', '::1', 'S'),
('2', '2017-09-29 13:02:06', 'Acesso ao Sistema', '::1', 'S'),
('2', '2017-09-29 13:02:17', 'ExclusÃ£o de dados na tabela [pedidos] codigo 1', '::1', 'S'),
('2', '2017-09-29 13:02:17', 'AlteraÃ§Ã£o de dados na tabela [pedidos] codigo 1', '::1', 'S'),
('2', '2017-09-29 13:02:17', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 13:02:17', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 14:38:44', 'Acesso ao Sistema', '::1', 'S'),
('2', '2017-09-29 14:39:21', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] codigo 2', '::1', 'S'),
('2', '2017-09-29 14:39:47', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:40:02', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:42:40', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:42:44', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:42:46', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:42:54', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:44:02', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:44:06', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:44:56', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:45:01', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:45:44', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:45:51', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:46:14', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:46:17', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:49:22', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:51:06', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:51:14', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:51:26', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 14:51:59', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 15:14:42', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 15:14:42', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 15:32:24', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 15:32:24', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 16:01:14', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] codigo 23', '::1', 'S'),
('2', '2017-09-29 16:01:14', 'AlteraÃ§Ã£o de dados na tabela [ordem] codigo 23', '::1', 'S'),
('2', '2017-09-29 16:01:14', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 16:10:41', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] codigo 23', '::1', 'S'),
('2', '2017-09-29 16:10:41', 'AlteraÃ§Ã£o de dados na tabela [ordem] codigo 23', '::1', 'S'),
('2', '2017-09-29 16:10:41', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 16:21:36', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] codigo 22', '::1', 'S'),
('2', '2017-09-29 16:21:36', 'AlteraÃ§Ã£o de dados na tabela [ordem] codigo 22', '::1', 'S'),
('2', '2017-09-29 16:21:36', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 16:24:08', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] codigo 22', '::1', 'S'),
('2', '2017-09-29 16:24:08', 'AlteraÃ§Ã£o de dados na tabela [ordem] codigo 22', '::1', 'S'),
('2', '2017-09-29 16:24:08', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 16:25:03', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 16:25:03', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 16:45:26', 'AlteraÃ§Ã£o de dados na tabela [pecas] codigo 1', '::1', 'S'),
('2', '2017-09-29 16:46:36', 'InclusÃ£o de dados na tabela [ordem] codigo ', '::1', 'S'),
('2', '2017-09-29 16:46:36', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 16:47:04', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] codigo 25', '::1', 'S'),
('2', '2017-09-29 16:47:04', 'AlteraÃ§Ã£o de dados na tabela [ordem] codigo 25', '::1', 'S'),
('2', '2017-09-29 16:47:04', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 16:53:55', 'AlteraÃ§Ã£o de dados na tabela [pecas] codigo 1', '::1', 'S'),
('2', '2017-09-29 17:01:53', 'AtualizaÃ§Ã£o de dados na tabela [pecas] codigo 1', '::1', 'S'),
('2', '2017-09-29 17:01:53', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] codigo 25', '::1', 'S'),
('2', '2017-09-29 17:01:53', 'AlteraÃ§Ã£o de dados na tabela [ordem] codigo 25', '::1', 'S'),
('2', '2017-09-29 17:01:53', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-29 17:02:04', 'AtualizaÃ§Ã£o de dados na tabela [pecas] codigo 1', '::1', 'S'),
('2', '2017-09-29 17:02:04', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] codigo 25', '::1', 'S'),
('2', '2017-09-29 17:02:04', 'AtualizaÃ§Ã£o de dados na tabela [pecas] codigo 1', '::1', 'S'),
('2', '2017-09-29 17:02:04', 'AlteraÃ§Ã£o de dados na tabela [ordem] codigo 25', '::1', 'S'),
('2', '2017-09-29 17:02:04', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S');

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
(25, '185.629.304-15 - Maria de Lourdes Cabral Pereira', '', '', '', '', '', '', 'Orcamento', '2017-09-29', '2.50', 'Dinheiro', 1, '0.00', '0000-00-00', '', 'Sim', '2017-09-29');

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
(25, 1, '1', 2, '1.25', '2.50');

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
('1', 'Borracha de amortecedor', '1.25', 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `cdpedi` bigint(20) NOT NULL,
  `cdforn` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dtpedi` date DEFAULT NULL,
  `vlpedi` decimal(15,2) DEFAULT NULL,
  `cdform` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `qtform` int(11) DEFAULT NULL,
  `decont` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dtentr` date DEFAULT NULL,
  `deobse` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `flativ` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`cdpedi`, `cdforn`, `dtpedi`, `vlpedi`, `cdform`, `qtform`, `decont`, `dtentr`, `deobse`, `status`, `flativ`, `dtcada`) VALUES
(1, '1234667899145 - Empresa teste', '2017-09-29', '126.25', 'Dinheiro', 2, '', '2017-09-30', '', 'Entregue', 'Sim', '2017-09-29');

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

--
-- Extraindo dados da tabela `pedidosi`
--

INSERT INTO `pedidosi` (`cdpedi`, `nritem`, `cdpeca`, `qtpeca`, `vlpeca`, `vltota`) VALUES
(1, 1, '1 - Borracha de amortecedor', 100, '1.25', '125.00'),
(1, 2, '1 - Borracha de amortecedor', 1, '1.25', '1.25');

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
('1', 'Reparo motor', '125.00', 0, NULL, NULL);

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
  MODIFY `cdcont` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `ordem`
--
ALTER TABLE `ordem`
  MODIFY `cdorde` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `cdpedi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cdusua` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
