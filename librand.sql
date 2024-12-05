-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para librand
DROP DATABASE IF EXISTS `librand`;
CREATE DATABASE IF NOT EXISTS `librand` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `librand`;

-- Copiando estrutura para tabela librand.candidato_vaga
CREATE TABLE IF NOT EXISTS `candidato_vaga` (
  `id_candidato_vaga` int NOT NULL AUTO_INCREMENT,
  `id_vaga` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id_candidato_vaga`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_vaga` (`id_vaga`),
  CONSTRAINT `candidato_vaga_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `candidato_vaga_ibfk_2` FOREIGN KEY (`id_vaga`) REFERENCES `vaga` (`id_vaga`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela librand.candidato_vaga: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela librand.dados_pessoais
CREATE TABLE IF NOT EXISTS `dados_pessoais` (
  `id_usuario` int DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `sobrenome` varchar(255) DEFAULT NULL,
  `nome_social` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `raca` varchar(255) DEFAULT NULL,
  `estado_civil` varchar(255) DEFAULT NULL,
  `estrangeiro` varchar(255) DEFAULT NULL,
  `possui_deficiencia` varchar(255) DEFAULT NULL,
  `deficiencia` varchar(255) DEFAULT NULL,
  `laudo` varchar(255) DEFAULT NULL,
  `suporte` varchar(255) DEFAULT NULL,
  `renda_pessoal` varchar(255) DEFAULT NULL,
  `renda_familiar` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `id_dados` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_dados`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `dados_pessoais_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela librand.dados_pessoais: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela librand.especializacoes
CREATE TABLE IF NOT EXISTS `especializacoes` (
  `id_usuario` int DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `organizacao` varchar(255) DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `final` date DEFAULT NULL,
  `responsabilidades` varchar(255) DEFAULT NULL,
  `id_especializacoes` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_especializacoes`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela librand.especializacoes: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela librand.experiencia
CREATE TABLE IF NOT EXISTS `experiencia` (
  `id_usuario` int DEFAULT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `responsabilidades` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `nivel` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `inicio_emprego` date DEFAULT NULL,
  `fim_emprego` date DEFAULT NULL,
  `atual` int DEFAULT NULL,
  `id_experiencia` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_experiencia`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `experiencia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela librand.experiencia: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela librand.formacao
CREATE TABLE IF NOT EXISTS `formacao` (
  `id_usuario` int DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `nivel` varchar(255) DEFAULT NULL,
  `instituicao` varchar(255) DEFAULT NULL,
  `curso` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `campus` varchar(255) DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `conclusao` date DEFAULT NULL,
  `turno` varchar(255) DEFAULT NULL,
  `id_formacao` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_formacao`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `formacao_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela librand.formacao: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela librand.idioma
CREATE TABLE IF NOT EXISTS `idioma` (
  `id_usuario` int DEFAULT NULL,
  `idioma` varchar(255) DEFAULT NULL,
  `proficiencia` varchar(255) DEFAULT NULL,
  `id_idioma` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_idioma`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `idioma_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela librand.idioma: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela librand.objetivo
CREATE TABLE IF NOT EXISTS `objetivo` (
  `id_usuario` int DEFAULT NULL,
  `cargo_de_interesse` varchar(255) DEFAULT NULL,
  `pretencao_salarial` varchar(255) DEFAULT NULL,
  `id_objetivo` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_objetivo`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `objetivo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela librand.objetivo: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela librand.sobre_empresa
CREATE TABLE IF NOT EXISTS `sobre_empresa` (
  `id_usuario` int DEFAULT NULL,
  `id_sobre` int NOT NULL AUTO_INCREMENT,
  `nome_fantasia` varchar(255) DEFAULT NULL,
  `razao_social` varchar(255) DEFAULT NULL,
  `cnpj` varchar(255) DEFAULT NULL,
  `setor` varchar(255) DEFAULT NULL,
  `numero_funcionarios` int DEFAULT NULL,
  `porte` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `responsavel_contato` varchar(255) DEFAULT NULL,
  `cargo_responsavel` varchar(255) DEFAULT NULL,
  `celular_contato` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pagina_web` varchar(255) DEFAULT NULL,
  `descricao` varchar(3000) DEFAULT NULL,
  PRIMARY KEY (`id_sobre`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `sobre_empresa_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela librand.sobre_empresa: ~9 rows (aproximadamente)
INSERT INTO `sobre_empresa` (`id_usuario`, `id_sobre`, `nome_fantasia`, `razao_social`, `cnpj`, `setor`, `numero_funcionarios`, `porte`, `cep`, `rua`, `numero`, `complemento`, `bairro`, `estado`, `cidade`, `responsavel_contato`, `cargo_responsavel`, `celular_contato`, `email`, `pagina_web`, `descricao`) VALUES
	(2, 1, 'Renner', 'Lojas Renner S.A.', '92.754.738/0001-62', 'Moda', 25705, 'Grande', '91410-400', 'Avenida Joaquim Porto Villanova', '401', 'Prédio', 'Jardim Carvalho', 'Rio Grande do Sul', 'Porto Alegre', 'Carlos Menezes de Assis', 'CEO', '11 19213-8706', 'renner@renner.com', 'https://www.lojasrenner.com.br/', 'Somos um ecossistema de moda e lifestyle conectado a nossos clientes por meio de canais digitais e mais de 600 lojas no Brasil, Argentina e Uruguai. Desde o início, tudo que fazemos é para encantar. Foi assim que nossa história começou, em 1965, conquistando marcos importantes, e hoje somos líder no varejo de moda omnichannel no país.??\r\n\r\nToda essa história baseada em valores sólidos, construída por nossos mais de 21 mil colaboradores dos negócios Renner, Camicado, Youcom, Realize CFI e Repassa.?\r\n\r\nEstamos criando uma jornada de sustentabilidade, com compromissos por uma moda cada vez mais responsável. Por meio de nossos negócios, encantamos colaboradores, clientes e todos que fazem parte dessa rede, sempre com muita colaboração e olhar para as pessoas.?\r\n\r\nSomos Lojas Renner S.A.'),
	(5, 2, 'Adecco', 'ADECCO RECURSOS HUMANOS S.A.', '35.918.663/0038-66', 'Recursos Humanos', 6578, 'Grande', '01311-000', 'Av. Paulista', '283', '', 'Bela Vista', 'São Paulo', 'São Paulo', 'Manuel Antônio Silva', 'CEO', '(11) 3089-0400', 'adecco@adecco.com', 'https://adecco.com.br/', 'A Adecco RH é uma empresa suíça de gestão de recursos humanos.[1]\r\n<br>\r\nFoi fundada em 1996 com a fusão entre a francesa Ecco e a suíça Adia Interim.\r\n<Br>\r\nAtua em mais de 60 países, prestando serviços a mais de 100.000 empresas. Possui aproximadamente seis mil agências, 30 mil funcionários e 3.5 milhões de trabalhadores temporários.\r\n<br>\r\nEstá em Portugal desde 1990 e no Brasil desde 1999.'),
	(6, 3, 'Itaú', 'ITAU UNIBANCO SA', '60.701.190/4945-06', 'Contábil', 5000, 'Grande', '91410-402', 'Praça Alfredo Egydio de Souza Aranha', '', '', 'Parque Jabaquara', 'São Paulo', 'São Paulo', 'Mike Will Bento do Rego', 'CEO', '(11) 3089-0401', 'itau@123.com', 'https://www.itau.com.br/', 'O Banco Itaú SA foi um antigo banco brasileiro que se fundiu com o Unibanco em 4 de novembro de 2008, para formar o Banco Itaú Unibanco .'),
	(7, 4, 'Grupo Carrefour Brasil', 'Carrefour Comércio e Indústria Ltda', '45.543.915/0001-81', 'Alimentação / Gastronomia', 3000, 'Grande', ' 06460-020', 'Av. Tucunaré', '125', '', '', 'São Paulo', 'São Paulo', 'Enzo Ortiz', 'CEO', '(11) 3089-0401', 'carrefuor@123.com', 'https://grupocarrefourbrasil.com.br/', 'O Carrefour é uma rede de varejo internacional que atua em diversos segmentos de mercado, incluindo hipermercados, supermercados, lojas de conveniência e atacadistas.\r\n'),
	(8, 5, 'Senai', 'Serviço Nacional de Aprendizagem Industrial SENAI', '03.774.819/0001-02', 'Educação', 200, 'Médio', '01311-300', 'Avenida Paulista', '1313', '', '', 'Acre', 'Rio Branco', 'Felipe de Assis Vieira', 'CEO', '(11) 98962-9000', 'senai@senai.com', 'https://www.sp.senai.br/', 'O Serviço Nacional de Aprendizagem Industrial (SENAI) é uma instituição privada brasileira de interesse público, sem fins lucrativos, com personalidade jurídica de direito privado, estando fora da administração pública'),
	(9, 6, 'Manpower', 'Manpower do Brasil Ltda.', '03.542.892/0001-40', 'Recursos Humanos', 1, 'Pequeno', '12345-789', 'Avenida Amapá', '', '', '', 'Amapá', 'Amapá', 'Gabriel da Silva Stavalle ', 'CEO', '(11) 3089-0406', 'manpower@123.com', 'www.manpower.com', 'Conectamos o seu negócio aos melhores talentos, pois acreditamos que apoiar as empresas a gerar oportunidades de emprego significativas e sustentáveis tem o poder de mudar o mundo.  '),
	(10, 7, 'Estadão', 'Estadao Participacoes SA', '31.561.674/0001-99', 'Comercial', 1000, 'Grande', '02598-900', 'Engenheiro Caetano Álvares', '', '', '', 'São Paulo', 'São Paulo', 'Gabriela da Graça ', 'CEO', '(11) 98962-9001', 'estadao@123.com', 'https://www.estadao.com.br/', 'O Estado de S. Paulo, também conhecido como Estadão, é um jornal brasileiro publicado na cidade de São Paulo desde 1875. Ao lado de O Globo, Folha de S.Paulo, Valor Econômico, Zero Hora, Correio Braziliense e Estado de Minas, entre outros, forma o grupo dos principais jornais de referência do Brasil.'),
	(11, 8, 'Jacarei', 'Jacarei Agricultura e Comércio Ltda.', '69.348.159/0001-06', 'Agricultura, Pecuária, Veterinária', 500, 'Pequeno', '07500-000', ' R. do Trevo', '5', 'Prédio', ' Recanto das Gaivotas', 'São Paulo', 'Santa Isabel', '(11) 4656-8686', 'CEO', '(11) 4656-8686', 'jacarei@jacarei.com', 'https://jacareiagricultura.com.br/', 'A Jacareí Agricultura é uma empresa familiar com mais de 40 anos de história na agricultura. O gosto pela terra e o caráter de inovação dos diretores levaram a empresa a ser altamente eficiente no cultivo de hortaliças. Quatro propriedades próprias, e mais 30 produtores parceiros fazem parte da estrutura produtiva, diariamente são mais de unidade de produtos comercializados.\r\nCultivamos utilizando o que há de mais atual em técnicas de manejo, todos nossos produtos são rastreados por lote de origem para garantir qualidade e segurança alimentar.\r\nA Jacareí Agricultura hoje conta com um time de 250 colaboradores diretos, para garantir a mesa do consumidor sempre abastecida com produtos frescos todos os dias.'),
	(12, 9, 'Bellinat Perez', 'ADVOCACIA BELLINATI PEREZ.', '03.404.018/0015-42', 'Jurídica', 1000, 'Grande', '87020-025', 'Avenida Duque de Caxias', '882', 'Prédio', 'Zona 7', 'Paraná', 'Maringá', 'Estevão Castro dos Reis', 'CEO', '(41) 3207-9291', 'advocacia@advocacia.com', 'https://www.bellinatiperez.com.br/', 'A Bellinati Perez, atua na recuperação de créditos com e sem garantia, tanto no contencioso ativo e passivo para as principais instituições financeiras do país. A empresa conta com capital cem por cento nacional e próprio.\r\n<br>\r\nContamos com uma equipe de profissionais altamente qualificados, compreendendo advogados, negociadores, analistas, estatísticos, consultores, profissionais de TI, contabilistas, administradores, peritos e localizadores de veículos. A experiência e a tradição de mais de 20 anos fortalecem nossa eficiência e reconhecimento, permitindo-nos atuar junto às maiores empresas na área bancária, imobiliária e causas diversas.');

-- Copiando estrutura para tabela librand.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `termos` int DEFAULT NULL,
  `receber_email` int DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela librand.usuario: ~9 rows (aproximadamente)
INSERT INTO `usuario` (`id_usuario`, `usuario`, `senha`, `email`, `foto_perfil`, `termos`, `receber_email`, `tipo`) VALUES
	(2, 'Renner', '$2y$10$1vOxdaVPtV94drRrWFfZo.haR.RzdoIjY.4s.n74wuQOW4npWlS9q', 'renner@renner.com', 'renner.png', 1, 1, 'e'),
	(5, 'Adecco', '$2y$10$Jmz7htH.jx7simDHtJXXqeNmVt12iNEICsHZCqSBLaSk.vJie6TIa', 'adecco@123.com', 'unnamed.png', 1, 1, 'e'),
	(6, 'Itaú', '$2y$10$E2nco1ou2lMSQwFylKotpe8.u9.HqNr4OE0lJyJxcx/O7IqTrqSS6', 'itau@123.com', 'ITAU.png', 1, 1, 'e'),
	(7, 'Grupo Carrefour Brasil', '$2y$10$Yhmui4mtuM70k6chQudaa.Vpg24HzsbMNlH0.qmkuReCUkKaRu2ZO', 'carrefour@123.com', 'carref.png', 1, 1, 'e'),
	(8, 'Senai', '$2y$10$mm/oxJpy/vyhMWW4QnZVOOdlZbK72QgBurhOmGMtMQRVCgBjFC5za', 'senai@123.com', 'senai.jpg', 1, 1, 'e'),
	(9, 'Manpower', '$2y$10$v6Rf6aOO0y5zwLEKif0BneZpHEEn14VXy.1r5DKRrdrPD8wNyAn2m', 'Manpower@123.com', 'mn.png', 1, 1, 'e'),
	(10, 'Estadão', '$2y$10$ENnnYwSti.Fu8Ic415X/d.itE0ZxmllVbo96FeGeUgKgu99oJ3Uq2', 'estadao@123.com', 'estadao.jpg', 1, 1, 'e'),
	(11, 'jacarei', '$2y$10$UxYCLQx5kHhY6A8qxT.S2ep5lIXQr0ROveOR6W2xUcwSCb53QYwaC', 'jacarei@jacerei.com', 'jacarei.jpg', 1, 1, 'e'),
	(12, 'Escritório de Advocacia', '$2y$10$SbQsX2ecK51nCEZnuPI4VuNtV9OElOu9HgXu2xoJOOKQm8d2YBxIC', 'advocacia@advocacia.com', 'balleti.png', 1, 1, 'e');

-- Copiando estrutura para tabela librand.vaga
CREATE TABLE IF NOT EXISTS `vaga` (
  `id_vaga` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `especializacao` varchar(255) DEFAULT NULL,
  `senioridade` varchar(255) DEFAULT NULL,
  `numero_vagas` int DEFAULT NULL,
  `contrato` varchar(255) DEFAULT NULL,
  `modalidade` varchar(255) DEFAULT NULL,
  `periodo` varchar(255) DEFAULT NULL,
  `salario` varchar(255) DEFAULT NULL,
  `combinar` int DEFAULT NULL,
  `escolaridade` varchar(255) DEFAULT NULL,
  `localizacao` varchar(255) DEFAULT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id_vaga`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `vaga_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela librand.vaga: ~15 rows (aproximadamente)
INSERT INTO `vaga` (`id_vaga`, `id_usuario`, `titulo`, `area`, `cargo`, `especializacao`, `senioridade`, `numero_vagas`, `contrato`, `modalidade`, `periodo`, `salario`, `combinar`, `escolaridade`, `localizacao`, `descricao`) VALUES
	(1, 2, 'Assistente De Loja', 'Comercial', 'Atendente', 'Boa comunicação', 'Operacional', 10, 'CLT', 'Presencial', 'Período Integral', 'Salário a combinar', 1, 'Ensino Médio (2º Grau)', 'Sinop - MT', 'Estamos em busca de uma pessoa Assistente de Loja para atuar em nosso super time das Lojas Renner!\r\n\r\nA missão do Assistente de Loja é colocar o cliente como sua prioridade, atuando na área de vendas, com compromisso total de ir além de suas necessidades, para fornecer soluções efetivas que o surpreendam, promovendo o seu encantamento.\r\n\r\n'),
	(2, 2, 'Assistente De Produtos Financeiros', 'Contábil', 'Assistente', 'Contabilidade', 'Assistente', 3, 'CLT', 'Presencial', 'Período Integral', 'Salário a combinar', 1, 'Ensino Médio (2º Grau)', 'Belo Horizonte - MG', 'Estamos em busca de uma pessoa Assistente de Produtos Fianceiros para atuar em nosso super time das Lojas Renner!\r\n\r\nA pessoa Assistente de Produtos Fianceiros, tem a missão de atender os clientes no processo de comercialização de produtos financeiros, com compromisso total de ir além de suas necessidades, para fornecer soluções efetivas que o surpreendam, promovendo o seu encantamento.\r\n<br>\r\n<h5>RESPONSABILIDADES E ATRIBUIÇÕES:</h5>\r\n<br>\r\nEncantabrr os clientes no processo de vendas de Produtos Financeiros, auxiliando sempre que necessário;\r\nExecutar atividades relacionadas à área de crédito da empresa, tais como, liberação de crédito, emissão de cartões e prestar informações a clientes;\r\nAtualizar os dados cadastrais dos clientes e atuar com a qualidade da venda de produtos financeiros;\r\nResponsável pela organização e solicitação de materiais de divulgação dos produtos financeiros.'),
	(3, 5, 'Auxiliar De Logística', 'Logística', 'Auxiliar', 'Curso técnico em Logística', 'Auxiliar', 30, 'Temporário', 'Presencial', 'Período Integral', 'R$ 1.910,00 (Bruto mensal)', 0, ' Ensino Fundamental (1º grau)', 'Carapicuiba - SP ', 'Garantir que todos os produtos que chegam no centro de distribuição sejam recebidos e verificados, garantindo que os produtos sejam enviados para armazenamento nos CADs, possibilitando que aqueles que vendem e compram no mercado livre possam entregar e receber seus produtos o mais rápido possível;\r\n<br>\r\nVerificar a documentação de cada produto, garantindo a integridade dos registros e embalagens, para que cada usuário crie e confie.\r\n<br>\r\nPropor maneira de melhorar a operação do centro de distribuição, contribuindo para melhorar a experiência dos usuários.\r\nBenefícios:\r\n-. Refeição no local\r\n-. Fretado\r\n-. Vale alimentação\r\n-. Bonificação'),
	(4, 5, 'Consultor De Beleza', 'Qualidade', 'Especialista', 'Curso técnico de moda', 'Especialista', 1, 'Estágio', 'Presencial', 'Parcial Tardes', 'R$ 2.003,00 (Bruto mensal)', 0, 'Ensino Médio (2º Grau)', 'Campinas - SP', 'A Adecco em parceria com a Sisley busca um Especialista de Beleza.\r\n\r\nDescrição das atividades:\r\n\r\nCumprir sua meta mensal de vendas estipulada pela direção da empresa;\r\nResponsabilidade em aumentar a conscientização dos clientes sobre os produtos Sisley por meio de recomendações, aplicações e acompanhamento de tratamentos indicados;\r\nApoiar e trabalhar juntamente com a coordenação de vendas para criar um ambiente de cooperação e de senso de trabalho em equipe. Isso envolve rotinas administrativas, controle de estoque em loja e do material promocional, sempre zelando e se responsabilizando por todo ele enquanto estiver no PDV.\r\nEnviar semanalmente à Sisley um relatório de vendas, a fim de contribuir com a empresa na elaboração de estratégias que ajudem a conseguir o objetivo mensal.\r\nInformar a empresa sobre ações da concorrência que possam impactar no desempenho da Sisley no ponto de venda, apresentando sugestões que possam ser implementadas.\r\n'),
	(5, 6, 'Agente De Negócios', 'Comercial', 'Operacional', 'Comercial', 'Operacional', 20, 'CLT', 'Presencial', 'Período Integral', 'Salário a combinar', 1, 'Ensino Médio (2º Grau)', 'Cajamar - SP', 'Você irá atuar na nossa Rede de Agências, sendo responsável pelo atendimento aos nossos clientes, orientando sobre produtos bancários e gerando novos negócios.\r\nPara nós, atender o cliente significa colocá-lo no centro de tudo, entender profundamente as suas necessidades e sempre orientando sobre produtos bancários que, de fato, sejam relevantes de acordo com o momento e as necessidades dele.\r\nBenefícios:\r\n-. Vale-transporte\r\n-. Seguro de Vida\r\n-. Vale-refeição\r\n-. Auxílio farmácia\r\n-. Participação nos lucros\r\n-. Previdência Privada\r\n-. Vale-alimentação'),
	(6, 6, 'Analista de Dados', 'Informática', 'Analista', 'Informática e gestão de dados', 'Treinee', 1, 'Trainee', 'Home Office', 'Parcial Manhãs', 'R$ 2300,00 - 3100,00', 0, 'Ensino Médio (2º Grau)', 'Pindamonhangaba - SP', 'Você irá atuar na nossa Análise de Dados, sendo responsável pela análise de produtos bancários.\r\nPara nós, atender o cliente significa colocá-lo no centro de tudo, entender profundamente as suas necessidades e sempre orientando sobre produtos bancários que, de fato, sejam relevantes de acordo com o momento e as necessidades dele.\r\nBenefícios:\r\n-. Vale-transporte\r\n-. Seguro de Vida\r\n-. Vale-refeição\r\n-. Auxílio farmácia\r\n-. Participação nos lucros\r\n-. Previdência Privada\r\n-. Vale-alimentação'),
	(7, 7, 'Aprendiz', 'Serviços Gerais', 'Estagiário', '-', 'Estagiário', 2, 'Jovem Aprendiz', 'Presencial', 'Parcial Noites', 'R$ 960,00 a R$ 1300,00 (Bruto mensal)', 0, ' Ensino Fundamental (1º grau)', 'Jaboatão dos Guararapes - PE', 'Auxiliará os departamentos operacionais da loja , onde exercerá funções especificas de cada setor.\r\n<br>\r\nAtividades:\r\n<br>\r\nResponsável por verificar a entrada e saída de correspondências;\r\nAuxiliar no Empacotamento de mercadorias\r\nAuxiliar na reposição de mercadorias;\r\nAuxiliar a fazer devoluções de produtos;\r\nAtendimento ao cliente;\r\nControle de malotes;\r\nReceber e enviar documentos;\r\nAtender chamadas telefônicas, recepcionar o público em geral;\r\nArquivar documentos;\r\nManter atualizado os relatórios do departamento;\r\nManter a ordem e organização dos departamentos.\r\n<br>\r\nRequisitos:\r\n<br>\r\nEstar cursando ou ter terminado o Ensino Básico/Médio.\r\nDesejável conhecimento do Pacote Office;\r\nNão é necessário experiência profissional;\r\nBenefícios:\r\n-. Refeitório no local;\r\n-. Seguro de Vida;\r\n-. Vale transporte;'),
	(8, 7, 'Enfermeiro Do Trabalho', 'Saúde', 'Enfermeiro', 'Curso técnico de enfermagem', 'Especialista', 1, 'CLT', 'Presencial', 'Período Integral', 'Salário a combinar', 1, 'Ensino Médio (2º Grau)', 'Porto Alegre - RS', 'Sobre a área: A área de saúde ocupacional é responsável pela saúde dos trabalhadores do grupo Carrefour, realizando os exames ocupacionais e demais exigências legais.\r\n<br>\r\nDesafios dessa posição:\r\n1. Apoio nas campanhas de periódicos garantindo 100% dos colaboradores com ASO válidas.\r\n2. Apoio as filiais para demais exames ocupacionais.\r\n3. Apoio ao jurídico com evidências em casos de fiscalização ou processos judiciais.\r\n4. Apoio aos médicos responsáveis na emissão e divulgação dos PCMSOS.\r\n5. Gestão da equipe de técnicos de enfermagem.\r\n6. Gestão do limbo previdenciário através de indicadores e contatos com as filiais para orientação do fluxo e controle do status dos colaboradores.\r\n7. Conferência de faturas e controle de pagamentos de fornecedores.\r\n8. Apoio aos médicos para enquadramento de pcd com orientação dos rhus e controle de indicadores.'),
	(9, 8, 'Assistente Administrativo', 'Administração', 'Administrador', 'Curso técnico em Administração', 'Consultor', 3, 'CLT', 'Híbrido', 'Parcial Manhãs', 'R$ 1800,00 - R$ 3500,00', 0, 'Ensino Médio (2º Grau)', 'Rio Branco - AC', 'Responsabilidades:\r\nRealizar atividades administrativas e operacionais relacionadas aos processos internos da unidade de ensino;\r\nOrganizar e acompanhar documentos, relatórios e planilhas financeiras e de controle;\r\nAuxiliar na gestão de contratos, pagamentos e atendimento a fornecedores;\r\nAtender alunos e colaboradores, solucionando dúvidas e garantindo excelência nos processos;\r\nApoiar na organização de eventos e reuniões da unidade;\r\nGarantir a conformidade e atualização das informações em sistemas e arquivos.\r\n<br>\r\nRequisitos:\r\nEnsino superior completo ou cursando em Administração, Gestão de Negócios ou áreas correlatas;\r\nExperiência prévia em rotinas administrativas;\r\nDomínio do pacote Office (principalmente Excel);\r\nBoa comunicação oral e escrita;\r\nOrganização, proatividade e capacidade de trabalhar em equipe.'),
	(10, 8, 'Tecnico de Ensino', 'Educação', 'Tecnico de Ensino', 'Curso superior de Automação Industrial', 'Coordenador', 4, 'CLT', 'Híbrido', 'Noturno', 'Salário a combinar', 1, 'Ensino Superior (3º Grau)', 'Fortaleza - CE', 'Responsabilidades:\r\nPlanejar e ministrar aulas teóricas e práticas conforme a metodologia SENAI e os planos de ensino;\r\nElaborar materiais didáticos e avaliações para os cursos ofertados;\r\nAcompanhar e avaliar o desempenho dos alunos, garantindo seu desenvolvimento técnico e comportamental;\r\nPromover atividades que estimulem a aprendizagem ativa, criatividade e solução de problemas;\r\nZelar pela organização, limpeza e manutenção dos laboratórios e equipamentos utilizados nas aulas;\r\nParticipar de reuniões pedagógicas e capacitações oferecidas pela instituição;\r\nAtender demandas administrativas relacionadas ao registro de frequência e relatórios de acompanhamento.\r\nRequisitos:\r\nFormação técnica ou superior completa na área de Educação, Pedagogia, ou áreas correlatas;\r\nExperiência em sala de aula ou em ministrar treinamentos;\r\nConhecimento em tecnologias educacionais e metodologias ativas de ensino;'),
	(11, 9, 'Motorista Categoria B', 'Transportes', 'Motorista', 'Dirigir', 'Encarregado', 5, 'Autônomo', 'Presencial', 'Período Integral', 'Salário a combinar', 1, 'Ensino Médio (2º Grau)', 'Belém - PA', '- Transporte e entrega de caixas de biscoito por todo o estado do RJ;\r\n- Conferência de mercadorias antes da entrega para garantir precisão.\r\n\r\nRequisitos:\r\n\r\nEnsino Médio Completo;\r\nCNH B;\r\nExperiência prévia em entregas (conhecimento do mercado é um diferencial).\r\n'),
	(12, 9, 'Diretor De Laboratório', 'Ciências', 'Diretor laboratorial', 'Ciências da natureza', 'Diretor', 1, 'CLT', 'Presencial', 'Parcial Noites', 'R$ 1800,00 - R$ 3500,00', 0, 'Ensino Médio (2º Grau)', 'Pouso Alegre - MG', 'Responsabilidades e atribuições\r\n- Organizar amostras e preparar materiais para ensaios;\r\n- Realizar ensaios físicos básicos (granulometria, rompimento de corpos de prova);\r\n- Manter e limpar equipamentos de laboratório;\r\n- Documentar e registrar os resultados dos ensaios;\r\n- Controlar o estoque de materiais de consumo;\r\n- Participar de treinamentos e atualizações técnicas;\r\n- Exige habilidades técnicas, atenção aos detalhes e trabalho em equipe;\r\n- Contribui para a manutenção dos padrões de qualidade e segurança no laboratório.\r\n\r\nRequisitos e qualificações\r\n- Ensino Médio concluído;\r\n- Habilidade para trabalhar em equipe;\r\n- Atenção aos detalhes.\r\nBenefícios:\r\n-. Auxílio creche\r\n-. Vale transporte\r\n-. Vale alimentação\r\n-. Seguro de vida.'),
	(13, 10, 'Publicitário', 'Marketing', 'Publicitário', 'Curso técnico em Marketing ', 'Diretor', 2, 'Autônomo', 'Híbrido', 'Parcial Manhãs', 'Salário a combinar', 1, 'Ensino Médio (2º Grau)', 'Carapicuiba - SP ', '\r\nResponsabilidades:\r\nDesenvolver e implementar estratégias de marketing para promover produtos e serviços do Estadão;\r\nPlanejar e executar campanhas publicitárias em mídias digitais, impressas e eventos;\r\nCriar conteúdos e materiais promocionais alinhados à identidade da marca;\r\nMonitorar o desempenho de campanhas, analisando métricas e gerando relatórios de resultados;\r\nEstabelecer parcerias estratégicas para impulsionar ações de marketing;\r\nGerir as redes sociais do jornal, promovendo engajamento com os leitores;\r\nColaborar com equipes internas, incluindo jornalistas e designers, para alinhar estratégias de comunicação.'),
	(14, 11, 'Agricultor', 'Agricultura, Pecuária, Veterinária', 'Auxiliar', 'Curso técnico em agricultura', 'Auxiliar', 2, 'CLT', 'Presencial', 'Período Integral', 'Salário a combinar', 1, 'Ensino Superior (3º Grau)', 'São Paulo - SP', 'Estamos em busca de um Auxiliar de Agricultura para atuar em nossa equipe agrícola, com foco no apoio às atividades de plantio, cultivo e colheita. O profissional será responsável por garantir o bom andamento dos processos no campo, contribuindo para o aumento da produtividade e qualidade dos produtos agrícolas.'),
	(15, 11, 'Cultura na agricultura', 'Cultura', 'Estagiário', 'Curso técnico em Agricultura ', 'Estagiário', 2, 'Estágio', 'Presencial', 'Parcial Tardes', 'Salário a combinar', 1, 'Ensino Superior (3º Grau)', 'São Paulo - SP', 'Estamos em busca de um Estagiário de Agricultura para atuar na área de culturas agrícolas. O estagiário será responsável por apoiar as atividades diárias relacionadas ao manejo das lavouras, ajudando no desenvolvimento de técnicas agrícolas, monitoramento de cultivos e garantindo o bom andamento das operações no campo. Esta é uma excelente oportunidade para quem deseja aprender na prática e se desenvolver no setor agrícola, com a chance de atuar em projetos inovadores e sustentáveis.');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
