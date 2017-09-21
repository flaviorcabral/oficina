-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21-Set-2017 às 17:01
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
  `cdclie` varchar(14) NOT NULL,
  `declie` varchar(100) DEFAULT NULL,
  `cdtipo` varchar(15) DEFAULT NULL,
  `nrinsc` varchar(20) DEFAULT NULL,
  `nrccm` varchar(20) DEFAULT NULL,
  `nrrg` varchar(20) DEFAULT NULL,
  `deende` varchar(100) DEFAULT NULL,
  `nrende` int(11) DEFAULT NULL,
  `decomp` varchar(50) DEFAULT NULL,
  `debair` varchar(50) DEFAULT NULL,
  `decida` varchar(50) DEFAULT NULL,
  `cdesta` varchar(50) DEFAULT NULL,
  `nrcepi` varchar(8) DEFAULT NULL,
  `nrtele` varchar(20) DEFAULT NULL,
  `nrcelu` varchar(20) DEFAULT NULL,
  `demail` varchar(255) DEFAULT NULL,
  `deobse` varchar(500) DEFAULT NULL,
  `flativ` varchar(10) DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`cdclie`, `declie`, `cdtipo`, `nrinsc`, `nrccm`, `nrrg`, `deende`, `nrende`, `decomp`, `debair`, `decida`, `cdesta`, `nrcepi`, `nrtele`, `nrcelu`, `demail`, `deobse`, `flativ`, `dtcada`) VALUES
('12121', 'AILTON F SILVA', 'Jurídica', '', '', '', 'Rua São Francisco', 0, '', 'São Geraldo', 'Juazeiro', 'BA', '48905660', '1212121', '12121212121', '1212@ailton.com', 'asasa', 'S', '2016-12-27'),
('26812855000100', 'AILTON F SILVA', 'Jurídica', 'Isento', 'asasa', '26812855000100', 'Rua São Francisco', 12, 'Sala 2, Conjunto A', 'São Geraldo', 'Juazeiro', 'BA', '48905660', '11 1234-9876', '(12) 2-2222-2222', '1@1.com', 'asasa', 'S', '2016-12-27'),
('618276112111', 'Fausto Lage Lange', 'Física', '6', '6', '6', 'Rua Miguel Palhares de Almeida', 345, 'Casa 4', 'Parque São Lourenço', 'São Paulo', 'SP', '07871234', '11 9876-1234', '11 9-7656-1234', 'fausto@lange.com', 'Bom cliente!', 'S', '2016-11-04'),
('87827611211', 'Valter Prebianca', 'Física', '8', '8', '8', 'Travessa Tardes de Lindóia', 124, 'Casa 2', 'Jardim da Conquista', 'São Paulo', 'SP', '08333000', '11 34563211', '11 9-8765-1234', 'valter@prebianca.com', 'Bom cliente!', 'S', '2016-11-04'),
('29466545833', 'jefersonbatista', 'Jurídica', '', '', '', 'Rua 27 de Agosto', 0, '', 'Dos Casa', 'São Bernardo do Campo', 'SP', '09840712', '', '', 'suporte@tecnosegura.com.br', '', 'S', '2017-05-27'),
('123.456.108-23', 'Empresa teste', 'Fisica', '', '', '', 'Rua sexquicentenario', 0, '', 'centro', 'Natuba', 'PB', '58494000', '', '', 'email@email.com.br', '', 'S', '2017-08-29'),
('35112099876', 'ganja master', 'Jurídica', '', '', '278766134444', 'Rua Chile', 0, '', 'Jardim Helena', 'Carapicuíba', 'SP', '06342150', '11 45467899', '11 987876543', 'contato@oficina.com.br', 'teste', 'S', '2017-07-17'),
('113', 'Empresa teste', 'Fisica', '', '', '', '', 0, '', '', 'Natuba', 'PB', '58494000', '', '', 'email@email.com.br', '', 'S', '2017-08-30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas`
--

CREATE TABLE `contas` (
  `cdcont` bigint(20) NOT NULL,
  `decont` varchar(50) DEFAULT NULL,
  `dtcont` date DEFAULT NULL,
  `vlcont` decimal(15,2) DEFAULT NULL,
  `cdtipo` varchar(15) DEFAULT NULL,
  `vlpago` decimal(15,2) DEFAULT NULL,
  `dtpago` date DEFAULT NULL,
  `cdquem` varchar(100) DEFAULT NULL,
  `cdorig` varchar(100) DEFAULT NULL,
  `deobse` varchar(500) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `contas`
--

INSERT INTO `contas` (`cdcont`, `decont`, `dtcont`, `vlcont`, `cdtipo`, `vlpago`, `dtpago`, `cdquem`, `cdorig`, `deobse`, `flativ`, `dtcada`) VALUES
(34, 'Cliente a Receber', '2017-10-21', '1250.00', 'Receber', NULL, NULL, '123.456.108-23 - Empresa teste', '4', NULL, 'Sim', '2017-09-21'),
(33, 'Pedido a Pagar', '2017-10-14', '195.43', 'Pagar', NULL, NULL, '185.629.304-15 - Pedro da Silva Cabral Pereira', '3', NULL, 'Sim', '2017-09-21'),
(25, 'Cliente a Receber', '2017-10-14', '195.43', 'Receber', NULL, NULL, '87827611211 - Valter Prebianca', '5', NULL, 'Sim', '2017-09-14'),
(24, 'Cliente a Receber', '2017-10-14', '199.00', 'Receber', NULL, NULL, '   29466545833 - jefersonbatista', '6', NULL, 'Sim', '2017-09-14'),
(35, 'Cliente a Receber', '2017-11-21', '1250.00', 'Receber', NULL, NULL, '123.456.108-23 - Empresa teste', '4', NULL, 'Sim', '2017-09-21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

CREATE TABLE `estados` (
  `cdesta` char(2) NOT NULL,
  `deesta` char(35) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `cdforn` varchar(14) NOT NULL,
  `deforn` varchar(100) DEFAULT NULL,
  `cdtipo` varchar(15) DEFAULT NULL,
  `nrinsc` varchar(20) DEFAULT NULL,
  `nrccm` varchar(20) DEFAULT NULL,
  `nrrg` varchar(20) DEFAULT NULL,
  `deende` varchar(100) DEFAULT NULL,
  `nrende` int(11) DEFAULT NULL,
  `decomp` varchar(50) DEFAULT NULL,
  `debair` varchar(50) DEFAULT NULL,
  `decida` varchar(50) DEFAULT NULL,
  `cdesta` varchar(50) DEFAULT NULL,
  `nrcepi` varchar(8) DEFAULT NULL,
  `nrtele` varchar(20) DEFAULT NULL,
  `nrcelu` varchar(20) DEFAULT NULL,
  `demail` varchar(255) DEFAULT NULL,
  `deobse` varchar(500) DEFAULT NULL,
  `flativ` varchar(10) DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`cdforn`, `deforn`, `cdtipo`, `nrinsc`, `nrccm`, `nrrg`, `deende`, `nrende`, `decomp`, `debair`, `decida`, `cdesta`, `nrcepi`, `nrtele`, `nrcelu`, `demail`, `deobse`, `flativ`, `dtcada`) VALUES
('185.629.304-15', 'Pedro da Silva Cabral Pereira', 'FÃ­sica', '', '', '', 'Rua FuncionÃ¡rio Carlos Alberto dos Santos', 131, '', 'Mangabeira', 'JoÃ£o Pessoa', '', '58058540', '', '', 'email@email.com.br', '', 'S', '2017-08-30'),
('45453465', 'grtrt', 'Jurídica', '', '', '', 'Avenida João Paulino Vieira Filho', 0, '', 'Zona 01', 'Maringá', 'PR', '87020015', '', '', '', '', 'S', '2017-03-30'),
('24234234234234', 'teste', 'Física', '', 'tetetet', '343434343', '43434343', 1, 'casas', 'aasas', 'Montenegro', 'RS', '95780000', 'sasasas', 'asasas', '', 'tess', 'S', '2017-06-22');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`cdusua`, `dtlog`, `delog`, `iplog`, `flativ`) VALUES
('2', '2017-09-15 17:00:55', 'AlteraÃ§Ã£o dos dados da tabela [parametros] para a chave [00000000000000]', '::1', 'S'),
('2', '2017-09-15 17:37:55', 'AlteraÃ§Ã£o dos dados da tabela [parametros] para a chave [00000000000000]', '::1', 'S'),
('2', '2017-09-19 13:26:25', 'AlteraÃ§Ã£o dos dados da tabela [parametros] para a chave [00000000000000]', '::1', 'S'),
('2', '2017-09-19 13:44:57', 'AlteraÃ§Ã£o dos dados da tabela parametros / cdprop = 00000000000000', '::1', 'S'),
('2', '2017-09-19 13:46:30', 'AlteraÃ§Ã£o dos dados da tabela parametros / cdprop = 00000000000000', '::1', 'S'),
('2', '2017-09-19 13:51:06', 'AlteraÃ§Ã£o de dados na tabela parametros 00000000000000', '::1', 'S'),
('2', '2017-09-20 12:34:30', 'AlteraÃ§Ã£o de dados na tabela parametros na chave 00000000000000', '::1', 'S'),
('2', '2017-09-20 12:49:38', 'AlteraÃ§Ã£o de dados na tabela parametros na chave 00000000000000', '::1', 'S'),
('2', '2017-09-20 15:49:38', 'Acesso ao Sistema', '::1', 'S'),
('2', '2017-09-20 16:44:36', 'InclusÃ£o de usuario de acesso ao sistema na tabela [usuarios]', '::1', 'S'),
('2', '2017-09-20 16:45:03', 'AlteraÃ§Ã£o de dados na tabela [usuarios] chave 5', '::1', 'S'),
('2', '2017-09-20 16:45:26', 'ExclusÃ£o de usuario na tabela [usuarios] chave 5', '::1', 'S'),
('4', '2017-09-20 16:51:36', 'Acesso ao Sistema', '::1', 'S'),
('4', '2017-09-20 16:51:46', 'AtualizaÃ§Ã£o dados usuario na tabela [usuarios] chave 4', '::1', 'S'),
('4', '2017-09-20 16:51:57', 'AtualizaÃ§Ã£o senha usuario na tabela [usuarios] chave 4', '::1', 'S'),
('2', '2017-09-20 16:52:17', 'Acesso ao Sistema', '::1', 'S'),
('2', '2017-09-20 17:03:56', 'InclusÃ£o de clientes na tabela [clientes]', '::1', 'S'),
('2', '2017-09-20 17:04:30', 'AlteraÃ§Ã£o de dados na tabela clientes chave 123456789', '::1', 'S'),
('2', '2017-09-20 17:04:40', 'ExclusÃ£o de cliente na tabela clientes chave 123456789', '::1', 'S'),
('2', '2017-09-21 15:38:56', 'Acesso ao Sistema', '::1', 'S'),
('2', '2017-09-21 15:56:55', 'InclusÃ£o de dados na tabela [ordem]', '::1', 'S'),
('2', '2017-09-21 15:57:08', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] chave 8', '::1', 'S'),
('2', '2017-09-21 15:57:08', 'AtualizaÃ§Ã£o de dados na tabela [ordem]', '::1', 'S'),
('2', '2017-09-21 15:58:54', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] chave 8', '::1', 'S'),
('2', '2017-09-21 16:10:03', 'InclusÃ£o de dados na tabela [fornecedores]', '::1', 'S'),
('2', '2017-09-21 16:10:17', 'AlteraÃ§Ã£o de dados na tabela [fornecedores] chave 165478923', '::1', 'S'),
('2', '2017-09-21 16:10:23', 'ExclusÃ£o de dados na tabela [fornecedores] chave 165478923', '::1', 'S'),
('2', '2017-09-21 16:14:37', 'InclusÃ£o de dados na tabela [pedidos]', '::1', 'S'),
('2', '2017-09-21 16:14:47', 'AlteraÃ§Ã£o de dados na tabela [pedidos]', '::1', 'S'),
('2', '2017-09-21 16:18:59', 'AlteraÃ§Ã£o de dados na tabela [pedidos] chave 3', '::1', 'S'),
('2', '2017-09-21 16:20:33', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] chave 4', '::1', 'S'),
('2', '2017-09-21 16:20:33', 'AlteraÃ§Ã£o de dados na tabela [ordem] chave 4', '::1', 'S'),
('2', '2017-09-21 16:40:26', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] codigo 4', '::1', 'S'),
('2', '2017-09-21 16:40:26', 'AlteraÃ§Ã£o de dados na tabela [ordem] codigo 4', '::1', 'S'),
('2', '2017-09-21 16:40:26', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-21 16:40:39', 'ExclusÃ£o de dados na tabela [pedidos] codigo 3', '::1', 'S'),
('2', '2017-09-21 16:40:39', 'AlteraÃ§Ã£o de dados na tabela [pedidos] codigo 3', '::1', 'S'),
('2', '2017-09-21 16:40:39', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-21 16:42:13', 'ExclusÃ£o ordem de serviÃ§o na tabela [ordem] codigo 4', '::1', 'S'),
('2', '2017-09-21 16:42:13', 'AlteraÃ§Ã£o de dados na tabela [ordem] codigo 4', '::1', 'S'),
('2', '2017-09-21 16:42:13', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-21 16:42:13', 'InclusÃ£o de dados na tabela [contas]', '::1', 'S'),
('2', '2017-09-21 16:54:36', 'InclusÃ£o de dados na tabela [pecas]', '::1', 'S'),
('2', '2017-09-21 16:54:49', 'AlteraÃ§Ã£o de dados na tabela [pecas] codigo 223', '::1', 'S'),
('2', '2017-09-21 16:55:20', 'AlteraÃ§Ã£o de dados na tabela [pecas] codigo 223', '::1', 'S'),
('2', '2017-09-21 16:55:30', 'AlteraÃ§Ã£o de dados na tabela [pecas] codigo 223', '::1', 'S'),
('2', '2017-09-21 16:55:36', 'ExclusÃ£o de dados na tabela [pecas] codigo 223', '::1', 'S'),
('2', '2017-09-21 17:00:58', 'InclusÃ£o de dados na tabela [servicos]', '::1', 'S'),
('2', '2017-09-21 17:01:18', 'AlteraÃ§Ã£o de dados na tabela [servicos] chave 2016', '::1', 'S'),
('2', '2017-09-21 17:01:25', 'ExclusÃ£o de servico na tabela [servicos] codigo 2016', '::1', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem`
--

CREATE TABLE `ordem` (
  `cdorde` bigint(20) NOT NULL,
  `cdclie` varchar(100) DEFAULT NULL,
  `veplac` char(7) DEFAULT NULL,
  `vemarc` varchar(30) DEFAULT NULL,
  `vemode` varchar(30) DEFAULT NULL,
  `veanom` char(4) DEFAULT NULL,
  `veanof` char(4) DEFAULT NULL,
  `vecorv` varchar(15) DEFAULT NULL,
  `cdsitu` varchar(30) DEFAULT NULL,
  `dtorde` date DEFAULT NULL,
  `vlorde` decimal(15,2) DEFAULT NULL,
  `cdform` varchar(30) DEFAULT NULL,
  `qtform` int(11) DEFAULT NULL,
  `vlpago` decimal(15,2) DEFAULT NULL,
  `dtpago` date DEFAULT NULL,
  `deobse` varchar(500) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ordem`
--

INSERT INTO `ordem` (`cdorde`, `cdclie`, `veplac`, `vemarc`, `vemode`, `veanom`, `veanof`, `vecorv`, `cdsitu`, `dtorde`, `vlorde`, `cdform`, `qtform`, `vlpago`, `dtpago`, `deobse`, `flativ`, `dtcada`) VALUES
(5, '87827611211 - Valter Prebianca', '', '', '', '', '', '', 'Concluido', '2017-09-14', '195.43', 'Cheque', 1, '0.00', '0000-00-00', '', 'Sim', '2017-09-14'),
(4, '123.456.108-23 - Empresa teste', 'oxo4264', 'fiat', '', '', '', '', 'Pendente', '2017-09-21', '2500.00', 'Dinheiro', 2, '0.00', '0000-00-00', '', 'Sim', '2017-09-21'),
(6, '   29466545833 - jefersonbatista', '', '', '', '', '', '', 'Orcamento', '2017-09-14', '199.00', 'Cheque', 1, '0.00', '0000-00-00', '', 'Sim', '2017-09-14'),
(7, '   87827611211 - Valter Prebianca', '', '', '', '', '', '', 'Orcamento', '2017-09-21', '4.00', 'Dinheiro', 1, '0.00', '0000-00-00', '', 'Sim', '2017-09-21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordemi`
--

CREATE TABLE `ordemi` (
  `cdorde` bigint(20) DEFAULT NULL,
  `nritem` int(11) DEFAULT NULL,
  `cdpeca` varchar(100) DEFAULT NULL,
  `qtpeca` int(11) DEFAULT NULL,
  `vlpeca` decimal(15,2) DEFAULT NULL,
  `vltota` decimal(15,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ordemi`
--

INSERT INTO `ordemi` (`cdorde`, `nritem`, `cdpeca`, `qtpeca`, `vlpeca`, `vltota`) VALUES
(6, 1, '003 - COXIM DO MOTOR', 1, '199.00', '199.00'),
(4, 1, '1233 - motor completo', 1, '2500.00', '2500.00'),
(5, 1, '80973102937012938 - Bucha da rebimboca da parafuseta', 1, '195.43', '195.43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `parametros`
--

CREATE TABLE `parametros` (
  `cdprop` varchar(14) NOT NULL,
  `deprop` varchar(100) DEFAULT NULL,
  `nrinsc` varchar(20) DEFAULT NULL,
  `nrccm` varchar(20) DEFAULT NULL,
  `deende` varchar(100) DEFAULT NULL,
  `nrende` int(11) DEFAULT NULL,
  `decomp` varchar(50) DEFAULT NULL,
  `debair` varchar(50) DEFAULT NULL,
  `decida` varchar(100) DEFAULT NULL,
  `cdesta` varchar(50) DEFAULT NULL,
  `nrcepi` varchar(8) DEFAULT NULL,
  `nrtele` varchar(20) DEFAULT NULL,
  `nrcelu` varchar(20) DEFAULT NULL,
  `demail` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `cdpeca` varchar(30) NOT NULL,
  `depeca` varchar(100) DEFAULT NULL,
  `vlpeca` decimal(15,2) DEFAULT NULL,
  `qtpeca` int(11) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `cdforn` varchar(100) DEFAULT NULL,
  `dtpedi` date DEFAULT NULL,
  `vlpedi` decimal(15,2) DEFAULT NULL,
  `vlpago` decimal(15,2) DEFAULT NULL,
  `dtpago` date DEFAULT NULL,
  `cdform` varchar(30) DEFAULT NULL,
  `qtform` int(11) DEFAULT NULL,
  `decont` varchar(100) DEFAULT NULL,
  `dtentr` date DEFAULT NULL,
  `deobse` varchar(500) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`cdpedi`, `cdforn`, `dtpedi`, `vlpedi`, `vlpago`, `dtpago`, `cdform`, `qtform`, `decont`, `dtentr`, `deobse`, `flativ`, `dtcada`) VALUES
(3, '185.629.304-15 - Pedro da Silva Cabral Pereira', '2017-09-14', '195.43', '0.00', '0000-00-00', 'Dinheiro', 1, 'Pedro', '2017-09-22', 'qwwqwqwq', 'Sim', '2017-09-21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidosi`
--

CREATE TABLE `pedidosi` (
  `cdpedi` bigint(20) DEFAULT NULL,
  `nritem` int(11) DEFAULT NULL,
  `cdpeca` varchar(100) DEFAULT NULL,
  `qtpeca` int(11) DEFAULT NULL,
  `vlpeca` decimal(15,2) DEFAULT NULL,
  `vltota` decimal(15,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidosi`
--

INSERT INTO `pedidosi` (`cdpedi`, `nritem`, `cdpeca`, `qtpeca`, `vlpeca`, `vltota`) VALUES
(3, 1, '80973102937012938 - Bucha da rebimboca da parafuseta', 1, '195.43', '195.43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `cdserv` varchar(30) NOT NULL,
  `deserv` varchar(100) DEFAULT NULL,
  `vlserv` decimal(15,2) DEFAULT NULL,
  `qtserv` int(11) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `deusua` varchar(100) DEFAULT NULL,
  `demail` varchar(255) DEFAULT NULL,
  `nrtele` varchar(20) DEFAULT NULL,
  `cdtipo` varchar(30) DEFAULT NULL,
  `defoto` varchar(500) DEFAULT NULL,
  `delogin` varchar(100) NOT NULL,
  `desenh` varchar(500) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`cdusua`, `deusua`, `demail`, `nrtele`, `cdtipo`, `defoto`, `delogin`, `desenh`, `flativ`, `dtcada`) VALUES
(2, 'Flavio Pereira', 'email@email.com.br', '8321070000', 'Administrador', 'img/semfoto.jpg', 'flavio', '202cb962ac59075b964b07152d234b70', 'S', '2017-08-31'),
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
  MODIFY `cdcont` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `ordem`
--
ALTER TABLE `ordem`
  MODIFY `cdorde` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `cdpedi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cdusua` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
