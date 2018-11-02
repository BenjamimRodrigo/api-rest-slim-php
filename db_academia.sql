DROP TABLE IF EXISTS `tb_aluno`;

CREATE TABLE `tb_aluno` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave primária da tabela.',
  `matricula` varchar(30) NOT NULL COMMENT 'Matrícula do aluno na academia.',
  `nome_completo` varchar(220) NOT NULL COMMENT 'Nome completo do aluno.',
  `cpf` char(11) NOT NULL COMMENT 'CPF do aluno.',
  `telefone` varchar(20) DEFAULT NULL COMMENT 'Telefone para contato com o aluno.',
  `email` varchar(100) DEFAULT NULL COMMENT 'E-mail para contato com o aluno.',
  `data_cadastro` timestamp NULL DEFAULT current_timestamp() COMMENT 'Data/hora em que o aluno foi cadastrado.',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `MATRIC_UNIQ` (`matricula`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;