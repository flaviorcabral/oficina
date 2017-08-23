
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 28/05/2017 às 21:21:12
-- Versão do Servidor: 10.0.28-MariaDB
-- Versão do PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `u449569243_of`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
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
  `dtcada` date DEFAULT NULL,
  PRIMARY KEY (`cdclie`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`cdclie`, `declie`, `cdtipo`, `nrinsc`, `nrccm`, `nrrg`, `deende`, `nrende`, `decomp`, `debair`, `decida`, `cdesta`, `nrcepi`, `nrtele`, `nrcelu`, `demail`, `deobse`, `flativ`, `dtcada`) VALUES
('12121', 'AILTON F SILVA', 'Jurídica', '', '', '', 'Rua São Francisco', 0, '', 'São Geraldo', 'Juazeiro', 'BA', '48905660', '1212121', '12121212121', '1212@ailton.com', 'asasa', 'S', '2016-12-27'),
('26812855000100', 'AILTON F SILVA', 'Jurídica', 'Isento', 'asasa', '26812855000100', 'Rua São Francisco', 12, 'Sala 2, Conjunto A', 'São Geraldo', 'Juazeiro', 'BA', '48905660', '11 1234-9876', '(12) 2-2222-2222', '1@1.com', 'asasa', 'S', '2016-12-27'),
('618276112111', 'Fausto Lage Lange', 'Física', '6', '6', '6', 'Rua Miguel Palhares de Almeida', 345, 'Casa 4', 'Parque São Lourenço', 'São Paulo', 'SP - São Paulo', '07871234', '11 9876-1234', '11 9-7656-1234', 'fausto@lange.com', 'Bom cliente!', 'S', '2016-11-04'),
('87827611211', 'Valter Prebianca', 'Física', '8', '8', '8', 'Travessa Tardes de Lindóia', 124, 'Casa 2', 'Jardim da Conquista', 'São Paulo', 'SP - São Paulo', '08333000', '11 34563211', '11 9-8765-1234', 'valter@prebianca.com', 'Bom cliente!', 'S', '2016-11-04'),
('00535888688', 'Em teste', 'Física', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'S', '2017-05-10'),
('1111111111', 'Anderson', 'Jurídica', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 'S', '2017-05-10'),
('29466545833', 'jefersonbatista', 'Jurídica', '', '', '', 'Rua 27 de Agosto', 0, '', 'Dos Casa', 'São Bernardo do Campo', 'SP', '09840712', '', '', 'suporte@tecnosegura.com.br', '', 'S', '2017-05-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas`
--

CREATE TABLE IF NOT EXISTS `contas` (
  `cdcont` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `dtcada` date DEFAULT NULL,
  PRIMARY KEY (`cdcont`),
  KEY `icontas1` (`decont`,`dtcont`),
  KEY `icontas2` (`dtcont`,`cdquem`),
  KEY `icontas3` (`dtcont`,`cdorig`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=205 ;

--
-- Extraindo dados da tabela `contas`
--

INSERT INTO `contas` (`cdcont`, `decont`, `dtcont`, `vlcont`, `cdtipo`, `vlpago`, `dtpago`, `cdquem`, `cdorig`, `deobse`, `flativ`, `dtcada`) VALUES
(25, 'Pedido a Pagar', '2016-01-16', '25.00', 'Receber', '20.00', '2017-05-05', '1 - AILTON FERREIRA DA SILVA', '7 - 87827611211 - Cliente Vizinho 12111', '', 'S', '2017-05-03'),
(27, 'Pedido a Pagar', '2016-10-25', '27.00', 'Receber', '0.00', '0000-00-00', '1 - 2', '19 - 12121 - AILTON F SILVA', '', 'S', '2017-05-25'),
(28, 'Pedido a Pagar', '2017-04-30', '28.00', 'Pagar', '28.33', '2016-10-31', '1 - 2', 'Outros', 'pago com juros', 'S', '2016-10-31'),
(39, 'Cliente a Receber', '2011-10-30', '39.00', 'Receber', '0.00', '0000-00-00', '87827611211 - Cliente Vizinho 12111', 'Outros', '', 'S', '2016-10-31'),
(40, 'Cliente a Receber', '2016-12-30', '2841.43', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(41, 'Cliente a Receber', '2017-01-30', '2841.43', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(42, 'Cliente a Receber', '2017-03-02', '2841.43', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(43, 'Cliente a Receber', '2017-03-30', '2841.43', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(44, 'Cliente a Receber', '2017-04-30', '2841.43', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(45, 'Cliente a Receber', '2017-05-30', '2841.43', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(46, 'Cliente a Receber', '2016-11-30', '2026.52', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(47, 'Cliente a Receber', '2016-12-30', '2026.52', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(48, 'Cliente a Receber', '2017-01-30', '2026.52', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(49, 'Cliente a Receber', '2017-03-02', '2026.52', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(50, 'Cliente a Receber', '2017-03-30', '2026.52', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(51, 'Cliente a Receber', '2017-04-30', '2026.52', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(52, 'Cliente a Receber', '2017-05-30', '2026.52', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(53, 'Cliente a Receber', '2016-11-30', '1852.06', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(54, 'Cliente a Receber', '2016-12-30', '1852.06', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(55, 'Cliente a Receber', '2017-01-30', '1852.06', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(56, 'Cliente a Receber', '2017-03-02', '1852.06', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(57, 'Cliente a Receber', '2017-03-30', '1852.06', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(58, 'Cliente a Receber', '2017-04-30', '1852.06', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(59, 'Cliente a Receber', '2017-05-30', '1852.06', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(60, 'Cliente a Receber', '2016-11-30', '1987.38', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(61, 'Cliente a Receber', '2016-12-30', '1987.38', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(62, 'Cliente a Receber', '2017-01-30', '1987.38', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(63, 'Cliente a Receber', '2017-03-02', '1987.38', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(64, 'Cliente a Receber', '2017-03-30', '1987.38', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(65, 'Cliente a Receber', '2017-04-30', '1987.38', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(66, 'Cliente a Receber', '2017-05-30', '1987.38', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(67, 'Cliente a Receber', '2016-11-30', '11432.38', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(68, 'Cliente a Receber', '2016-12-30', '11432.38', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(69, 'Cliente a Receber', '2017-01-30', '11432.38', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(70, 'Cliente a Receber', '2017-03-02', '11432.38', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(71, 'Cliente a Receber', '2017-03-30', '11432.38', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(72, 'Cliente a Receber', '2017-04-30', '11432.38', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(73, 'Cliente a Receber', '2017-05-30', '11432.38', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-30'),
(74, 'Cliente a Receber', '2016-11-30', '5788.50', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '8', NULL, 'Sim', '2016-10-30'),
(75, 'Cliente a Receber', '2016-12-30', '5788.50', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '8', NULL, 'Sim', '2016-10-30'),
(76, 'Cliente a Receber', '2017-01-30', '5788.50', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '8', NULL, 'Sim', '2016-10-30'),
(77, 'Cliente a Receber', '2017-03-02', '5788.50', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '8', NULL, 'Sim', '2016-10-30'),
(78, 'Cliente a Receber', '2017-03-30', '5788.50', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '8', NULL, 'Sim', '2016-10-30'),
(79, 'Cliente a Receber', '2017-04-30', '5788.50', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '8', NULL, 'Sim', '2016-10-30'),
(80, 'Cliente a Receber', '2017-05-30', '5788.50', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '8', NULL, 'Sim', '2016-10-30'),
(81, 'Cliente a Receber', '2017-06-30', '5788.50', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '8', NULL, 'Sim', '2016-10-30'),
(82, 'Cliente a Receber', '2016-11-30', '1471.38', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-30'),
(83, 'Cliente a Receber', '2016-12-30', '1471.38', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-30'),
(84, 'Cliente a Receber', '2017-01-30', '1471.38', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-30'),
(85, 'Cliente a Receber', '2017-03-02', '1471.38', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-30'),
(86, 'Cliente a Receber', '2017-03-30', '1471.38', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-30'),
(87, 'Cliente a Receber', '2017-04-30', '1471.38', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-30'),
(88, 'Cliente a Receber', '2017-05-30', '1471.38', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-30'),
(89, 'Cliente a Receber', '2017-06-30', '1471.38', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-30'),
(90, 'Cliente a Receber', '2017-07-30', '1471.38', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-30'),
(91, 'Ailton Almeida Nobre', '1969-12-31', '268.98', 'Receber', '0.00', '0000-00-00', '618276112111 - Cliente Vizinho Fabio', '8 - 1 - AILTON FERREIRA DA SILVA', 'ajustado o motor.', 'S', '2016-10-31'),
(92, 'Conta de Luz de Outubro de 2016', '2016-11-01', '230.87', 'Pagar', '0.00', '0000-00-00', '1 - 2', 'Outros', 'conta de luz', 'S', '2016-10-31'),
(96, 'Pedido a Pagar', '2016-12-01', '19339.33', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '16', NULL, 'Sim', '2016-10-31'),
(97, 'Pedido a Pagar', '2016-12-31', '19339.33', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '16', NULL, 'Sim', '2016-10-31'),
(98, 'Pedido a Pagar', '2017-01-31', '19339.33', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '16', NULL, 'Sim', '2016-10-31'),
(99, 'Cliente a Receber', '2016-12-01', '1813.59', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-31'),
(100, 'Cliente a Receber', '2016-12-31', '1813.59', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-31'),
(101, 'Cliente a Receber', '2017-01-31', '1813.59', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-31'),
(102, 'Cliente a Receber', '2017-03-03', '1813.59', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-31'),
(103, 'Cliente a Receber', '2017-03-31', '1813.59', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-31'),
(104, 'Cliente a Receber', '2017-05-01', '1813.59', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-31'),
(105, 'Cliente a Receber', '2017-05-31', '1813.59', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-31'),
(106, 'Cliente a Receber', '2017-07-01', '1813.59', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-31'),
(107, 'Cliente a Receber', '2017-07-31', '1813.59', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '9', NULL, 'Sim', '2016-10-31'),
(108, 'Pedido a Pagar', '2016-12-01', '80369.57', 'Pagar', NULL, NULL, '1 - 2', '17', NULL, 'Sim', '2016-10-31'),
(109, 'Pedido a Pagar', '2016-12-31', '80369.57', 'Pagar', NULL, NULL, '1 - 2', '17', NULL, 'Sim', '2016-10-31'),
(110, 'Pedido a Pagar', '2017-01-31', '80369.57', 'Pagar', NULL, NULL, '1 - 2', '17', NULL, 'Sim', '2016-10-31'),
(111, 'Cliente a Receber', '2016-12-01', '8254.73', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-31'),
(112, 'Cliente a Receber', '2016-12-31', '8254.73', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-31'),
(113, 'Cliente a Receber', '2017-01-31', '8254.73', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-31'),
(114, 'Cliente a Receber', '2017-03-03', '8254.73', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-31'),
(115, 'Cliente a Receber', '2017-03-31', '8254.73', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-31'),
(116, 'Cliente a Receber', '2017-05-01', '8254.73', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-31'),
(117, 'Cliente a Receber', '2017-05-31', '8254.73', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-10-31'),
(118, 'Cliente a Receber', '2016-12-01', '8745.99', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-10-31'),
(119, 'Cliente a Receber', '2016-12-31', '8745.99', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-10-31'),
(120, 'Cliente a Receber', '2017-01-31', '8745.99', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-10-31'),
(121, 'Cliente a Receber', '2017-03-03', '8745.99', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-10-31'),
(122, 'Cliente a Receber', '2017-03-31', '8745.99', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-10-31'),
(123, 'Cliente a Receber', '2016-12-01', '9265.94', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-10-31'),
(124, 'Cliente a Receber', '2016-12-31', '9265.94', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-10-31'),
(125, 'Cliente a Receber', '2017-01-31', '9265.94', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-10-31'),
(126, 'Cliente a Receber', '2017-03-03', '9265.94', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-10-31'),
(127, 'Cliente a Receber', '2017-03-31', '9265.94', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-10-31'),
(128, 'Pedido a Pagar', '2016-12-01', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(129, 'Pedido a Pagar', '2016-12-31', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(130, 'Pedido a Pagar', '2017-01-31', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(131, 'Pedido a Pagar', '2017-03-03', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(132, 'Pedido a Pagar', '2017-03-31', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(133, 'Pedido a Pagar', '2017-05-01', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(134, 'Pedido a Pagar', '2017-05-31', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(135, 'Pedido a Pagar', '2017-07-01', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(136, 'Pedido a Pagar', '2017-07-31', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(137, 'Pedido a Pagar', '2017-08-31', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(138, 'Pedido a Pagar', '2017-10-01', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(139, 'Pedido a Pagar', '2017-10-31', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(140, 'Pedido a Pagar', '2017-12-01', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(141, 'Pedido a Pagar', '2017-12-31', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(142, 'Pedido a Pagar', '2018-01-31', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(143, 'Pedido a Pagar', '2018-03-03', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(144, 'Pedido a Pagar', '2018-03-31', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(145, 'Pedido a Pagar', '2018-05-01', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(146, 'Pedido a Pagar', '2018-05-31', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(147, 'Pedido a Pagar', '2018-07-01', '5506.12', 'Pagar', NULL, NULL, '11111111111111 - 1111111111111111111111111111111', '18', NULL, 'Sim', '2016-10-31'),
(148, 'Cliente a Receber', '2016-12-04', '9265.94', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-11-04'),
(149, 'Cliente a Receber', '2017-01-04', '9265.94', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-11-04'),
(150, 'Cliente a Receber', '2017-02-04', '9265.94', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-11-04'),
(151, 'Cliente a Receber', '2017-03-04', '9265.94', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-11-04'),
(152, 'Cliente a Receber', '2017-04-04', '9265.94', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-11-04'),
(153, 'Cliente a Receber', '2016-12-04', '70.85', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '10', NULL, 'Sim', '2016-11-04'),
(154, 'Cliente a Receber', '2017-01-27', '542.00', 'Receber', NULL, NULL, '12121 - AILTON F SILVA', '11', NULL, 'Sim', '2016-12-27'),
(155, 'Cliente a Receber', '2017-01-27', '34468.95', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '8', NULL, 'Sim', '2016-12-27'),
(156, 'Cliente a Receber', '2017-02-27', '34468.95', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '8', NULL, 'Sim', '2016-12-27'),
(157, 'Cliente a Receber', '2017-01-27', '8254.73', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-12-27'),
(158, 'Cliente a Receber', '2017-02-27', '8254.73', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-12-27'),
(159, 'Cliente a Receber', '2017-03-27', '8254.73', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-12-27'),
(160, 'Cliente a Receber', '2017-04-27', '8254.73', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-12-27'),
(161, 'Cliente a Receber', '2017-05-27', '8254.73', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-12-27'),
(162, 'Cliente a Receber', '2017-06-27', '8254.73', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-12-27'),
(163, 'Cliente a Receber', '2017-07-27', '8254.73', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2016-12-27'),
(164, 'Cliente a Receber', '2017-04-11', '122.00', 'Receber', NULL, NULL, '618276112111 - Fausto Lage Lange', '12', NULL, 'Sim', '2017-03-11'),
(165, 'Cliente a Receber', '2017-04-11', '122.00', 'Receber', NULL, NULL, '618276112111 - Fausto Lage Lange', '12', NULL, 'Sim', '2017-03-11'),
(166, 'Cliente a Receber', '2017-05-13', '135.00', 'Receber', NULL, NULL, '618276112111 - Fausto Lage Lange', '12', NULL, 'Sim', '2017-03-11'),
(167, 'Cliente a Receber', '2017-04-27', '35.78', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '13', NULL, 'Sim', '2017-03-27'),
(168, 'Cliente a Receber', '2017-05-27', '35.78', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '13', NULL, 'Sim', '2017-03-27'),
(169, 'Cliente a Receber', '2017-06-27', '35.78', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '13', NULL, 'Sim', '2017-03-27'),
(170, 'Cliente a Receber', '2017-04-30', '0.00', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '14', NULL, 'Sim', '2017-03-30'),
(171, 'Cliente a Receber', '2017-05-30', '0.00', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '14', NULL, 'Sim', '2017-03-30'),
(172, 'Cliente a Receber', '2017-06-30', '0.00', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '14', NULL, 'Sim', '2017-03-30'),
(173, 'Cliente a Receber', '2017-05-01', '107.00', 'Receber', NULL, NULL, '1 - AILTON FERREIRA DA SILVA', '15', NULL, 'Sim', '2017-03-31'),
(177, 'Cliente a Receber', '2017-06-03', '8269.02', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2017-05-03'),
(176, 'Cliente a Receber', '2017-05-21', '10.00', 'Receber', NULL, NULL, '12121 - AILTON F SILVA', '18', NULL, 'Sim', '2017-04-21'),
(178, 'Cliente a Receber', '2017-07-03', '8269.02', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2017-05-03'),
(179, 'Cliente a Receber', '2017-08-03', '8269.02', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2017-05-03'),
(180, 'Cliente a Receber', '2017-09-03', '8269.02', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2017-05-03'),
(181, 'Cliente a Receber', '2017-10-03', '8269.02', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2017-05-03'),
(182, 'Cliente a Receber', '2017-11-03', '8269.02', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2017-05-03'),
(183, 'Cliente a Receber', '2017-12-03', '8269.02', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2017-05-03'),
(184, 'Cliente a Receber', '2017-06-03', '8270.53', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2017-05-03'),
(185, 'Cliente a Receber', '2017-07-03', '8270.53', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2017-05-03'),
(186, 'Cliente a Receber', '2017-08-03', '8270.53', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2017-05-03'),
(187, 'Cliente a Receber', '2017-09-03', '8270.53', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2017-05-03'),
(188, 'Cliente a Receber', '2017-10-03', '8270.53', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2017-05-03'),
(189, 'Cliente a Receber', '2017-11-03', '8270.53', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2017-05-03'),
(190, 'Cliente a Receber', '2017-12-03', '8270.53', 'Receber', NULL, NULL, '87827611211 - Cliente Vizinho 12111', '7', NULL, 'Sim', '2017-05-03'),
(191, 'Cliente a Receber', '2017-06-05', '200.00', 'Receber', NULL, NULL, '12121 - AILTON F SILVA', '19', NULL, 'Sim', '2017-05-05'),
(192, 'Cliente a Receber', '2017-07-05', '200.00', 'Receber', NULL, NULL, '12121 - AILTON F SILVA', '19', NULL, 'Sim', '2017-05-05'),
(193, 'Cliente a Receber', '2017-08-05', '200.00', 'Receber', NULL, NULL, '12121 - AILTON F SILVA', '19', NULL, 'Sim', '2017-05-05'),
(194, 'Cliente a Receber', '2017-09-05', '200.00', 'Receber', NULL, NULL, '12121 - AILTON F SILVA', '19', NULL, 'Sim', '2017-05-05'),
(195, 'Cliente a Receber', '2017-10-05', '200.00', 'Receber', NULL, NULL, '12121 - AILTON F SILVA', '19', NULL, 'Sim', '2017-05-05'),
(196, 'Cliente a Receber', '2017-11-05', '200.00', 'Receber', NULL, NULL, '12121 - AILTON F SILVA', '19', NULL, 'Sim', '2017-05-05'),
(197, 'Cliente a Receber', '2017-12-05', '200.00', 'Receber', NULL, NULL, '12121 - AILTON F SILVA', '19', NULL, 'Sim', '2017-05-05'),
(198, 'Cliente a Receber', '2018-01-05', '200.00', 'Receber', NULL, NULL, '12121 - AILTON F SILVA', '19', NULL, 'Sim', '2017-05-05'),
(199, 'Cliente a Receber', '2018-02-05', '200.00', 'Receber', NULL, NULL, '12121 - AILTON F SILVA', '19', NULL, 'Sim', '2017-05-05'),
(200, 'Cliente a Receber', '2018-03-05', '200.00', 'Receber', NULL, NULL, '12121 - AILTON F SILVA', '19', NULL, 'Sim', '2017-05-05'),
(201, 'Cliente a Receber', '2017-06-10', '100.00', 'Receber', NULL, NULL, '1111111111 - Anderson', '20', NULL, 'Sim', '2017-05-10'),
(202, 'Cliente a Receber', '2017-06-25', '2600.00', 'Receber', NULL, NULL, '26812855000100 - AILTON F SILVA', '21', NULL, 'Sim', '2017-05-25'),
(203, 'Cliente a Receber', '2017-06-27', '199.00', 'Receber', NULL, NULL, '00535888688 - Em teste', '22', NULL, 'Sim', '2017-05-27'),
(204, 'Cliente a Receber', '2017-06-27', '299.00', 'Receber', NULL, NULL, '29466545833 - jefersonbatista', '23', NULL, 'Sim', '2017-05-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `cdesta` char(2) NOT NULL,
  `deesta` char(35) DEFAULT NULL,
  PRIMARY KEY (`cdesta`)
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

CREATE TABLE IF NOT EXISTS `fornecedores` (
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
  `dtcada` date DEFAULT NULL,
  PRIMARY KEY (`cdforn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`cdforn`, `deforn`, `cdtipo`, `nrinsc`, `nrccm`, `nrrg`, `deende`, `nrende`, `decomp`, `debair`, `decida`, `cdesta`, `nrcepi`, `nrtele`, `nrcelu`, `demail`, `deobse`, `flativ`, `dtcada`) VALUES
('1', '2', 'Física', '12', '12', '2', '2', 2, '2', '2', '2', 'MG - Minas Gerais', '2', '2', '2', '26812855000100@a.com', '2222222222222221\r\n12\r\n123\r\n1234\r\n12345\r\n', 'S', '2016-10-30'),
('11111111111111', '1111111111111111111111111111111', 'Física', 'Isento', '1234567', '1234557', '111111111111111111111', 11111, '11111111111111111111111', '11111111111111111111111', '1111111111111111111111111111111111', 'SC - Santa Catarina', '11111111', '111111111111111', '11111111111111111', '11111111@111111.com', '11111111111111111\r\n1111111111111111111111\r\n11111111111111111111111111', 'S', '2016-10-31'),
('e2e2', 'grtrt', 'Jurídica', '', '', '', 'Avenida João Paulino Vieira Filho', 0, '', 'Zona 01', 'Maringá', 'PR', '87020015', '', '', '', '', 'S', '2017-03-30'),
('45453465', 'grtrt', 'Jurídica', '', '', '', 'Avenida João Paulino Vieira Filho', 0, '', 'Zona 01', 'Maringá', 'PR', '87020015', '', '', '', '', 'S', '2017-03-30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem`
--

CREATE TABLE IF NOT EXISTS `ordem` (
  `cdorde` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `dtcada` date NOT NULL,
  PRIMARY KEY (`cdorde`),
  KEY `iordem1` (`cdclie`,`dtorde`),
  KEY `iordem2` (`cdform`,`dtorde`),
  KEY `iordem3` (`cdclie`,`dtpago`),
  KEY `iordem4` (`cdform`,`dtpago`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Extraindo dados da tabela `ordem`
--

INSERT INTO `ordem` (`cdorde`, `cdclie`, `veplac`, `vemarc`, `vemode`, `veanom`, `veanof`, `vecorv`, `cdsitu`, `dtorde`, `vlorde`, `cdform`, `qtform`, `vlpago`, `dtpago`, `deobse`, `flativ`, `dtcada`) VALUES
(7, '87827611211 - Cliente Vizinho 12111', 'LOK1234', 'Fiat', 'Uno Mille', '2015', '2015', 'vecorv', 'Andamento', '2017-05-03', '57893.72', 'Débito', 7, '80026.64', '2016-10-31', 'tudo ok\r\nrapaz vem amanhã!', 'Sim', '2017-05-03'),
(8, '1 - AILTON FERREIRA DA SILVA', 'PIC9876', 'Fiat', 'UNO', '1999', '1988', 'Verde', 'Pendente', '2016-12-27', '68937.89', 'Débito', 2, '0.00', '2016-10-27', 'ok.\r\ntudo certo.', 'Sim', '2016-12-27'),
(9, '1 - AILTON FERREIRA DA SILVA', 'TER8765', 'Audi', 'A3', '2009', '2009', 'Prata', 'Concluída', '2016-10-31', '16322.30', 'Débito', 9, '0.00', '0000-00-00', '9999\r\n999999\r\n9999999', 'Sim', '2016-10-31'),
(10, '87827611211 - Cliente Vizinho 12111', 'TAK9876', 'Fiat', 'Strada', '2017', '2016', 'Verde', 'Entregue', '2016-08-08', '70.85', 'Dinheiro', 1, '70.85', '2016-11-04', 'Verificar barulho nas portas.\r\nColocar motor no ponto.\r\nAjustar cabos da bateria.\r\nTrocar rolamento da roda dianteira.\r\nTrocar as velas.\r\nTrocar bateria.', 'Sim', '2016-11-04'),
(11, '12121 - AILTON F SILVA', '', '', '', '', '', '', 'Orçamento', '2016-12-27', '542.00', 'Dinheiro', 1, '0.00', '0000-00-00', '', 'Sim', '2016-12-27'),
(12, '618276112111 - Fausto Lage Lange', 'att9030', 'palio', '', '', '2011', 'branco', 'Concluído', '2017-04-13', '135.00', 'Dinheiro', 1, '0.00', '0000-00-00', 'troca de oleo', 'Sim', '2017-03-11'),
(13, '1 - AILTON FERREIRA DA SILVA', '', '', '', '', '', '', 'Orçamento', '2017-03-27', '107.33', 'Crédito', 3, '0.00', '0000-00-00', '', 'Sim', '2017-03-27'),
(14, '1 - AILTON FERREIRA DA SILVA', '', '', '', '', '', '', 'Orçamento', '2017-03-30', '0.00', 'Dinheiro', 3, '0.00', '0000-00-00', '', 'Sim', '2017-03-30'),
(15, '1 - AILTON FERREIRA DA SILVA', '', '', '', '', '', '', 'Orçamento', '2017-03-31', '107.00', 'Dinheiro', 1, '0.00', '0000-00-00', '', 'Sim', '2017-03-31'),
(20, '1111111111 - Anderson', 'lad6676', 'fiat ', 'uno', '99', '99', 'azul', 'Orçamento', '2017-05-10', '100.00', 'Dinheiro', 1, '14.00', '2017-01-31', '', 'Sim', '2017-05-10'),
(19, '12121 - AILTON F SILVA', 'dcm0113', 'Fiat', 'palio', '2000', '2001', 'preto', 'Andamento', '2017-05-05', '2000.00', 'Dinheiro', 10, '200.00', '2017-05-05', '', 'Sim', '2017-05-05'),
(18, '12121 - AILTON F SILVA', '', '', '', '', '', '', 'Orçamento', '2017-04-21', '10.00', 'Dinheiro', 1, '0.00', '0000-00-00', '', 'Sim', '2017-04-21'),
(21, '26812855000100 - AILTON F SILVA', '', '', '', '', '', '', 'Orçamento', '2017-05-25', '2600.00', 'Dinheiro', 1, '0.00', '0000-00-00', '', 'Sim', '2017-05-25'),
(22, '00535888688 - Em teste', 'ede4477', 'fiat', 'idea', '', '', '', 'Orçamento', '2017-05-27', '199.00', 'Dinheiro', 1, '0.00', '0000-00-00', '', 'Sim', '2017-05-27'),
(23, '29466545833 - jefersonbatista', '', '', '', '', '', '', 'Orçamento', '2017-05-27', '299.00', 'Dinheiro', 1, '0.00', '0000-00-00', '', 'Sim', '2017-05-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordemi`
--

CREATE TABLE IF NOT EXISTS `ordemi` (
  `cdorde` bigint(20) DEFAULT NULL,
  `nritem` int(11) DEFAULT NULL,
  `cdpeca` varchar(100) DEFAULT NULL,
  `qtpeca` int(11) DEFAULT NULL,
  `vlpeca` decimal(15,2) DEFAULT NULL,
  `vltota` decimal(15,2) DEFAULT NULL,
  KEY `iordemi1` (`cdorde`,`nritem`,`cdpeca`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ordemi`
--

INSERT INTO `ordemi` (`cdorde`, `nritem`, `cdpeca`, `qtpeca`, `vlpeca`, `vltota`) VALUES
(9, 1, '1 - 1', 234, '1.00', '234.00'),
(9, 2, '2 - 2', 345, '0.52', '179.40'),
(9, 3, '5 - 5', 4567, '1.29', '5891.43'),
(9, 4, '10 - 10', 2689, '2.58', '6937.62'),
(9, 5, '6 - 6', 1987, '1.55', '3079.85'),
(10, 1, '1 - 1', 1, '0.26', '0.26'),
(10, 2, '6 - 6', 6, '6.00', '36.00'),
(10, 3, '10 - 10', 10, '2.58', '25.80'),
(10, 4, '5 - 5', 5, '1.29', '6.45'),
(10, 5, '3 - 3', 3, '0.78', '2.34'),
(11, 1, '2 - 2', 232, '2.00', '464.00'),
(11, 2, '6 - 6', 13, '6.00', '78.00'),
(8, 1, '10 - 10', 100, '10.00', '1000.00'),
(8, 2, '7 - 7', 876, '1.81', '1585.56'),
(8, 3, '9 - 9', 18765, '2.33', '43722.45'),
(8, 4, '5 - 5', 66, '1.29', '85.14'),
(8, 5, '6 - 6', 14545, '1.55', '22544.75'),
(7, 2, '6 - 6', 6666, '6.00', '39996.00'),
(7, 3, '1 - 1', 1111, '1.00', '1111.00'),
(7, 4, '7 - 7', 7777, '1.81', '14076.37'),
(12, 2, '1010 - Tampa do Reservatório do Óleo', 1, '35.00', '35.00'),
(12, 1, '1 - Alinhamento', 1, '100.00', '100.00'),
(13, 1, '1 - Alinhamento', 1, '100.00', '100.00'),
(13, 2, '6 - 6', 1, '1.55', '1.55'),
(13, 3, '3 - 3', 1, '0.78', '0.78'),
(13, 4, '5 - 5', 1, '5.00', '5.00'),
(14, 1, '1233 - motor completo', 1, '5.00', '5.00'),
(15, 1, '7 - 7', 1, '7.00', '7.00'),
(15, 2, '1 - Alinhamento', 1, '100.00', '100.00'),
(7, 5, '1 - Alinhamento', 1, '100.00', '100.00'),
(7, 1, '3 - 3', 3333, '0.78', '2599.74'),
(18, 1, '4 - 4', 1, '10.00', '10.00'),
(7, 6, '7 - 7', 1, '7.00', '7.00'),
(7, 7, '5 - 5', 1, '1.29', '1.29'),
(7, 8, '5 - 5', 1, '1.29', '1.29'),
(7, 9, '4 - 4', 1, '1.03', '1.03'),
(19, 1, '2 - reparo geral', 1, '2000.00', '2000.00'),
(20, 1, '1 - Alinhamento', 1, '100.00', '100.00'),
(21, 1, '1 - Alinhamento', 1, '100.00', '100.00'),
(21, 2, '1233 - motor completo', 1, '2500.00', '2500.00'),
(22, 1, '003 - COXIM DO MOTOR', 1, '199.00', '199.00'),
(23, 1, '1 - Alinhamento', 1, '100.00', '100.00'),
(23, 2, '003 - COXIM DO MOTOR', 1, '199.00', '199.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `parametros`
--

CREATE TABLE IF NOT EXISTS `parametros` (
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
  `demail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cdprop`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `parametros`
--

INSERT INTO `parametros` (`cdprop`, `deprop`, `nrinsc`, `nrccm`, `deende`, `nrende`, `decomp`, `debair`, `decida`, `cdesta`, `nrcepi`, `nrtele`, `nrcelu`, `demail`) VALUES
('61843256000155', 'Oficina Mecânica Nova Aliança', 'Isento', '2345', 'Rua Anecy Rocha', 1520, '', 'Jardim Nova Vitória', 'São Paulo', 'SP - São Paulo', '08372-20', '11 2734-3353', '11 9-8448-3928', 'of.mecanicanovaalianca@hotmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pecas`
--

CREATE TABLE IF NOT EXISTS `pecas` (
  `cdpeca` varchar(30) NOT NULL,
  `depeca` varchar(100) DEFAULT NULL,
  `vlpeca` decimal(15,2) DEFAULT NULL,
  `qtpeca` int(11) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date DEFAULT NULL,
  PRIMARY KEY (`cdpeca`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pecas`
--

INSERT INTO `pecas` (`cdpeca`, `depeca`, `vlpeca`, `qtpeca`, `flativ`, `dtcada`) VALUES
('1', '1', '0.26', 1, NULL, NULL),
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

CREATE TABLE IF NOT EXISTS `pedidos` (
  `cdpedi` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `dtcada` date DEFAULT NULL,
  PRIMARY KEY (`cdpedi`),
  KEY `ipedidos1` (`cdforn`,`cdpedi`,`dtpedi`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`cdpedi`, `cdforn`, `dtpedi`, `vlpedi`, `vlpago`, `dtpago`, `cdform`, `qtform`, `decont`, `dtentr`, `deobse`, `flativ`, `dtcada`) VALUES
(15, '11111111111111 - 1111111111111111111111111111111', '2016-10-31', '36775.00', '0.00', '0000-00-00', 'Dinheiro', 3, 'Ailton Almeida Nobre', '0000-00-00', '', 'Sim', '2016-10-31'),
(16, '11111111111111 - 1111111111111111111111111111111', '2016-10-31', '58018.00', '0.00', '0000-00-00', 'Dinheiro', 3, 'Ailton Almeida Nobre', '0000-00-00', '', 'Sim', '2016-10-31'),
(17, '1 - 2', '2016-10-31', '241108.70', '0.00', '0000-00-00', 'Dinheiro', 3, 'Pedido Ailton Dois', '0000-00-00', 'Pedido Ailton Dois Produção', 'Sim', '2016-10-31'),
(18, '11111111111111 - 1111111111111111111111111111111', '2016-10-31', '110122.32', '0.00', '0000-00-00', 'Dinheiro', 20, '', '0000-00-00', 'teste', 'Sim', '2016-10-31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidosi`
--

CREATE TABLE IF NOT EXISTS `pedidosi` (
  `cdpedi` bigint(20) DEFAULT NULL,
  `nritem` int(11) DEFAULT NULL,
  `cdpeca` varchar(100) DEFAULT NULL,
  `qtpeca` int(11) DEFAULT NULL,
  `vlpeca` decimal(15,2) DEFAULT NULL,
  `vltota` decimal(15,2) DEFAULT NULL,
  KEY `ipedidosi1` (`cdpedi`,`nritem`,`cdpeca`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidosi`
--

INSERT INTO `pedidosi` (`cdpedi`, `nritem`, `cdpeca`, `qtpeca`, `vlpeca`, `vltota`) VALUES
(15, 1, '10 - 10', 10000, '2.58', '25800.00'),
(15, 2, '5 - 5', 5000, '1.29', '6450.00'),
(15, 3, '7 - 7', 2500, '1.81', '4525.00'),
(16, 1, '10 - 10', 10000, '2.58', '25800.00'),
(16, 2, '5 - 5', 5000, '1.29', '6450.00'),
(16, 3, '7 - 7', 2500, '1.81', '4525.00'),
(16, 4, '7 - 7', 1765, '7.00', '12355.00'),
(16, 5, '8 - 8', 1111, '8.00', '8888.00'),
(17, 1, '10 - 10', 11111, '2.58', '28666.38'),
(17, 2, '5 - 5', 55555, '1.29', '71665.95'),
(17, 3, '7 - 7', 77777, '1.81', '140776.37'),
(18, 1, '4 - 4', 4444, '4.00', '17776.00'),
(18, 2, '5 - 5', 5555, '1.29', '7165.95'),
(18, 3, '7 - 7', 7777, '1.81', '14076.37'),
(18, 4, '8 - 8', 8888, '8.00', '71104.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE IF NOT EXISTS `servicos` (
  `cdserv` varchar(30) NOT NULL,
  `deserv` varchar(100) DEFAULT NULL,
  `vlserv` decimal(15,2) DEFAULT NULL,
  `qtserv` int(11) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date DEFAULT NULL,
  PRIMARY KEY (`cdserv`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`cdserv`, `deserv`, `vlserv`, `qtserv`, `flativ`, `dtcada`) VALUES
('1', 'Alinhamento', '100.00', 1, NULL, NULL),
('10', '10', '10.00', 10, NULL, NULL),
('2', 'reparo geral', '2000.00', 1, NULL, NULL),
('3', '3', '3.00', 3, NULL, NULL),
('4', '4', '4.00', 4, NULL, NULL),
('5', '5', '5.00', 5, NULL, NULL),
('6', '6', '6.00', 6, NULL, NULL),
('7', '7', '7.00', 7, NULL, NULL),
('8', '8', '8.00', 8, NULL, NULL),
('9', '9', '9.00', 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `cdusua` char(14) NOT NULL,
  `deusua` varchar(100) DEFAULT NULL,
  `demail` varchar(255) DEFAULT NULL,
  `nrtele` varchar(20) DEFAULT NULL,
  `cdtipo` varchar(30) DEFAULT NULL,
  `defoto` varchar(500) DEFAULT NULL,
  `desenh` varchar(500) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date DEFAULT NULL,
  PRIMARY KEY (`cdusua`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`cdusua`, `deusua`, `demail`, `nrtele`, `cdtipo`, `defoto`, `desenh`, `flativ`, `dtcada`) VALUES
('1', 'Usuário Demonstração', 'adm@adm.com', '11 1234-1234', 'Administrador', 'img/1rato.png', '202cb962ac59075b964b07152d234b70', 'Sim', '2016-10-28'),
('2', 'Usuário Demonstração 2', 'fabio@admin.com.br', '11 2367-3107', 'Administrador', 'img/2_a1.jpg', '202cb962ac59075b964b07152d234b70', 'Sim', '2016-10-28'),
('77', '77777777777777777777777', '77@77.com', '77777777', 'Administrador', 'img/77_progerio.jpg', '28dd2c7955ce926456240b2ff0100bde', 'Sim', '2017-01-09'),
('999', 'Almeida Prado', 'almeida@prado.com', '11 9-7787-0268', 'Administrador', 'img/999_a4.jpg', '202cb962ac59075b964b07152d234b70', 'Sim', '2016-10-28'),
('88', '88888888888888888888888', '88@88.com.br', '88 8888-8888', 'Administrador', 'img/88_Koala.jpg', '0a113ef6b61820daa5611c870ed8d5ee', 'S', '2017-01-09'),
('001', 'Anderson', 'anderson@hotmail.com', '219999999', 'Funcionário', 'img/semfoto.jpg', 'be5d5d37542d75f93a87094459f76678', 'S', '2017-05-10'),
('12', 't', '', '', 'Administrador', 'img/semfoto.jpg', '202cb962ac59075b964b07152d234b70', 'S', '2017-05-25');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
