-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 23/06/2015 às 22:22
-- Versão do servidor: 5.6.14
-- Versão do PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `labmanager`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `idAreas` int(11) NOT NULL AUTO_INCREMENT,
  `area_nome` varchar(45) NOT NULL,
  `codigo` int(11) NOT NULL,
  PRIMARY KEY (`idAreas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Fazendo dump de dados para tabela `areas`
--

INSERT INTO `areas` (`idAreas`, `area_nome`, `codigo`) VALUES
(1, 'Indefinida', 0),
(2, 'Sistemas Embarcados', 1),
(3, 'Sistemas Mobile', 2),
(4, 'Sistemas Web', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastros`
--

CREATE TABLE IF NOT EXISTS `cadastros` (
  `idCadastros` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) CHARACTER SET latin1 NOT NULL,
  `lattes` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `privilegio_fk` int(11) NOT NULL,
  `area_fk` int(11) NOT NULL,
  `login_fk` int(11) NOT NULL,
  PRIMARY KEY (`idCadastros`),
  KEY `privilegios_fk_idx` (`privilegio_fk`),
  KEY `area_fk_idx` (`area_fk`),
  KEY `login_fk` (`login_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Fazendo dump de dados para tabela `cadastros`
--

INSERT INTO `cadastros` (`idCadastros`, `nome`, `lattes`, `privilegio_fk`, `area_fk`, `login_fk`) VALUES
(1, 'admin', NULL, 2, 2, 2),
(9, 'manager', 'teste', 3, 2, 10),
(15, 'teste', NULL, 3, 2, 16),
(20, 'dsgsd', NULL, 5, 1, 21);

-- --------------------------------------------------------

--
-- Estrutura para tabela `canvas`
--

CREATE TABLE IF NOT EXISTS `canvas` (
  `id_canvas` int(11) NOT NULL AUTO_INCREMENT,
  `de_justificativas` text,
  `de_objsmart` text,
  `de_beneficios` text,
  `de_produto` text,
  `de_requisitos` text,
  `de_stakeholders` text,
  `de_equipe` text,
  `de_restricoes` text,
  `de_premissas` text,
  `de_grupodeentregas` text,
  `de_riscos` text,
  `de_linhadotempo` text,
  `de_custos` text,
  `projeto_id_projeto` int(11) NOT NULL,
  PRIMARY KEY (`id_canvas`),
  KEY `fk_canvas_projeto_idx` (`projeto_id_projeto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Fazendo dump de dados para tabela `canvas`
--

INSERT INTO `canvas` (`id_canvas`, `de_justificativas`, `de_objsmart`, `de_beneficios`, `de_produto`, `de_requisitos`, `de_stakeholders`, `de_equipe`, `de_restricoes`, `de_premissas`, `de_grupodeentregas`, `de_riscos`, `de_linhadotempo`, `de_custos`, `projeto_id_projeto`) VALUES
(1, '- Moby Dick destrÃ³i ativos dos pescadores.\n- Moby Dick ameaÃ§a vida dos trabalhadores.', '- CaÃ§ar a baleia cachalote branca conhecida como Moby Dick, que matou 17 arpoadores e destruiu 3 barcos de 1851 a 1853.', '- Maior seguranÃ§a para os pescadores.\n- ReduÃ§Ã£o de custo associado a destruiÃ§Ã£o dos barcos.\n- Melhoria da imagem do capitÃ£o Ahab. ', '- Moby Dick eliminada.', '- A morte deve-se dar por combate com arpoadores.\n- Deve existir inequÃ­voca identificaÃ§Ã£o  que trata-se de Moby Dick.\n- O coraÃ§Ã£o de Moby Dick deve ser extraÃ­do.', '- Dono do navio Pequod.\n- A baleia Moby Dick.', '- Gerente de projeto.\n- Imediatos.\n- Arpoadores.\n- Marinheiros.\n- Ferreiro.', '- O navio deve ter ao menos 3 botes de arpoadores.\n- Os arpoadores selecionados precisam ter ao menos 10 anos de experiÃªncia.', '- Uma baleia como M.B. pode ser morta com arpÃµes de segunda geraÃ§Ã£o.\n- O dono do barco concederÃ¡ o barco para a campanha de 1852 ao CapitÃ£o Ahab.', '1- Navio.\n2- Selecionar tripulaÃ§Ã£o.\n3- ProduÃ§Ã£o de arpÃµes especiais.\n4- Busca.\n5- Enfrentamento e morte.', '- MD destruir o barco e matar todos.\n- FuracÃ£o no PacÃ­fico destruir o navio.', '', '1- $500 mil\n2- $700 mil\n3- $1,2 milhÃ£o\n4- $900 mil\n5- $400 mil\n-----------------------------\ncusto base entre $3 e $4 milhÃµes.', 1),
(2, '- Colesterol aumentando\n- Mobilidade reduzida\n- Imagem mal cuidada\n- Roupas nÃ£o vestem', '- Emagrecer 10 kg com saÃºde atÃ© 28 de fevereiro, tendo apoio multidisciplinar e incorporando hÃ¡bitos saudÃ¡veis, gastando atÃ© R$6.500.', '- Volta do colesterol Ã  normalidade.\n- ReduÃ§Ã£o da probabilidade de doenÃ§as.\n- ReduÃ§Ã£o de gastos com saÃºde em R$ 80 mil (horizonte 5 anos).\n- Irei inspirar famÃ­lia amigos e colegas.\n- Aumento da receita nos negÃ³cios por meio de melhoria de imagem.', '- Eu reeducado e 10 kg mais magro.', '- IMC nÃ£o deve ficar acima de 25.\n- Percentual de gordura corporal deve ficar menor que 24%.\n- Dieta adquirida deve ficar em 2000 cal/dia.\n- Nova rotina incorpora 30 min de esportes 5 vezes por semana.\n- Novo hÃ¡bito alimentar rico em fibras, pobre em gordura e aÃ§Ãºcar.', '- Esposa.\n- MÃ£e.\n- Colegas de happy hour.\n- Amigos esportistas.\n- Clima(fatores externos).\n- Ritmo do trabalho(fator externo).', '- Eu(gerente do projeto).\n- MÃ©dico.\n- Nutricionista.\n- Treinador fÃ­sico.', '- NÃ£o posso gastar mais que R$6.500 nos 4 meses de programa.\n- O treino terÃ¡ de ser fora do horÃ¡rio comercial.\n- 50% do treino tem que ser na academia do meu condomÃ­nio. ', '- Mamma nÃ£o vai forÃ§ar a barra com suas tradicionais sobremesas.\n- Teremos mais de 30% dos dias de treinamento sem chuva pesada.\n- Colegas de trabalho irÃ£o apoiar a nova atitude abstÃªmia.', '1- GestÃ£o do projeto.\n2- Apoio mÃ©dico.\n3- ReeducaÃ§Ã£o alimentar.\n4- AquisiÃ§Ãµes.\n5- ExercÃ­cios FÃ­sicos.', '- Causas: sou radical e ansioso.\n- Ficar doente devido dieta exagerada.\n- Efeito: cancelamento do projeto.\n-------------------------------\n- Causas: pouco costume e exercÃ­cios.\n- Risco: lesÃ£o com paralizaÃ§Ã£o do treino \n- Efeito: diminuiÃ§Ã£o do resultado.\n--------------------------------\n- Causas: Mamma me vÃª subnutrido e insiste.\n- Risco: Quebro dieta e devoro sobremesas.\n- Efeito: perda da eficiÃªncia da dieta.', 'vdf', '1- $90(mat.) + $300(m. obra) total = $390.\n2- $1.110(serviÃ§os)\ntotal = $1.110.\n3- $750(mat. + $450(serv.)\ntotal = $1.200.\n4- $500(mat.) + $1000(eqpto)\ntotal = $1.500.', 2),
(23, 'dvsdv', '', '', '', '', '', '', '', '', '', '', '', '', 113),
(24, '', '', '', '', '', '', '', '', '', '', '', '', '', 114);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotos`
--

CREATE TABLE IF NOT EXISTS `fotos` (
  `idFotos` int(11) NOT NULL AUTO_INCREMENT,
  `caminho` varchar(256) NOT NULL,
  `foto_cadastro_fk` int(11) NOT NULL,
  PRIMARY KEY (`idFotos`),
  KEY `foto_cadastro_fk_idx` (`foto_cadastro_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Fazendo dump de dados para tabela `fotos`
--

INSERT INTO `fotos` (`idFotos`, `caminho`, `foto_cadastro_fk`) VALUES
(4, 'preferences_desktop_user.png', 1),
(9, 'preferences_desktop_user.png', 9),
(15, 'preferences_desktop_user.png', 15),
(20, 'preferences_desktop_user.png', 20);

-- --------------------------------------------------------

--
-- Estrutura para tabela `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `idLogins` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `senha` varchar(70) NOT NULL,
  PRIMARY KEY (`idLogins`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Fazendo dump de dados para tabela `logins`
--

INSERT INTO `logins` (`idLogins`, `email`, `senha`) VALUES
(2, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3'),
(10, 'manager@manager.com', '1d0258c2440a8d19e716292b231e3190'),
(16, 'teste@email.com', '698dc19d489c4e4db73e28a713eab07b'),
(21, 'sdg@fe.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Estrutura para tabela `privilegios`
--

CREATE TABLE IF NOT EXISTS `privilegios` (
  `idPrivilegios` int(11) NOT NULL AUTO_INCREMENT,
  `nomeDoPrivilegio` varchar(45) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`idPrivilegios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `privilegios`
--

INSERT INTO `privilegios` (`idPrivilegios`, `nomeDoPrivilegio`, `nivel`) VALUES
(2, 'Admin', 0),
(3, 'Manager', 1),
(5, 'Worker', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `projeto`
--

CREATE TABLE IF NOT EXISTS `projeto` (
  `id_projeto` int(11) NOT NULL AUTO_INCREMENT,
  `no_projeto` varchar(100) NOT NULL,
  `gp_projeto` varchar(100) NOT NULL,
  `dti_projeto` date NOT NULL,
  `dtf_projeto` date NOT NULL,
  PRIMARY KEY (`id_projeto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Fazendo dump de dados para tabela `projeto`
--

INSERT INTO `projeto` (`id_projeto`, `no_projeto`, `gp_projeto`, `dti_projeto`, `dtf_projeto`) VALUES
(1, 'Projeto 1', 'Gerente', '2014-04-02', '2015-05-20'),
(2, 'Projeto 2', 'Gerente', '2014-04-02', '2015-06-25'),
(113, 'Projeto 3', 'Gerente', '2015-02-24', '2015-09-11'),
(114, 'afdf', 'afasdf', '2015-06-23', '2015-06-02');

-- --------------------------------------------------------

--
-- Estrutura para tabela `projetos_e_membros`
--

CREATE TABLE IF NOT EXISTS `projetos_e_membros` (
  `projeto` int(11) NOT NULL,
  `cadastro` int(11) NOT NULL,
  PRIMARY KEY (`cadastro`,`projeto`),
  KEY `cadastro_fk_idx` (`cadastro`),
  KEY `projeto_fk_idx` (`projeto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `cadastros`
--
ALTER TABLE `cadastros`
  ADD CONSTRAINT `area_fk` FOREIGN KEY (`area_fk`) REFERENCES `areas` (`idAreas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `login_fk` FOREIGN KEY (`login_fk`) REFERENCES `logins` (`idLogins`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `privilegios_fk` FOREIGN KEY (`privilegio_fk`) REFERENCES `privilegios` (`idPrivilegios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `canvas`
--
ALTER TABLE `canvas`
  ADD CONSTRAINT `fk_canvas_projeto` FOREIGN KEY (`projeto_id_projeto`) REFERENCES `projeto` (`id_projeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `foto_cadastro_fk` FOREIGN KEY (`foto_cadastro_fk`) REFERENCES `cadastros` (`idCadastros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `projetos_e_membros`
--
ALTER TABLE `projetos_e_membros`
  ADD CONSTRAINT `fk_cadastro` FOREIGN KEY (`cadastro`) REFERENCES `cadastros` (`idCadastros`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_projeto` FOREIGN KEY (`projeto`) REFERENCES `projeto` (`id_projeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
