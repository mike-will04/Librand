CREATE DATABASE IF NOT EXISTS librand;
USE librand;	

CREATE TABLE IF NOT EXISTS usuario ( 
 id_usuario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,  
 usuario VARCHAR(255),  
 senha VARCHAR(255), 
 email VARCHAR(255),
 foto_perfil VARCHAR(255),
 termos int,
 receber_email INT,
 tipo VARCHAR(1)
); 

CREATE TABLE IF NOT EXISTS dados_pessoais ( 
 id_usuario INT,  
 nome VARCHAR(255),  
 sobrenome VARCHAR(255),  
 nome_social VARCHAR(255),  
 pais VARCHAR(255),  
 cpf VARCHAR(255),  
 celular VARCHAR(255),  
 data DATE,  
 raca VARCHAR(255),  
 estado_civil VARCHAR(255), 
 estrangeiro VARCHAR(255),
 possui_deficiencia VARCHAR(255),  
 deficiencia VARCHAR(255),  
 laudo VARCHAR(255),  
 suporte VARCHAR(255),  
 renda_pessoal VARCHAR(255),
 renda_familiar VARCHAR(255),  
 cep VARCHAR(255),  
 rua VARCHAR(255), 
 numero VARCHAR(255), 
 complemento VARCHAR(255), 
 bairro VARCHAR(255), 
 estado VARCHAR(255), 
 cidade VARCHAR(255), 
 comentario VARCHAR(255),  
 video VARCHAR(255),  
 id_dados INT PRIMARY KEY NOT NULL AUTO_INCREMENT
); 

CREATE TABLE IF NOT EXISTS experiencia ( 
 id_usuario INT,  
 empresa VARCHAR(255),  
 responsabilidades VARCHAR(255),  
 cargo VARCHAR(255),  
 nivel VARCHAR(255),  
 area VARCHAR(255),  
 inicio_emprego DATE,  
 fim_emprego DATE,
 atual int,  
 id_experiencia INT PRIMARY KEY NOT NULL AUTO_INCREMENT  
); 

CREATE TABLE IF NOT EXISTS formacao ( 
 id_usuario INT,  
 pais VARCHAR(255),  
 estado VARCHAR(255),  
 nivel VARCHAR(255),  
 instituicao VARCHAR(255),  
 curso VARCHAR(255),  
 status VARCHAR(255),  
 campus VARCHAR(255),  
 inicio DATE,  
 conclusao DATE,  
 turno VARCHAR(255),  
 id_formacao INT PRIMARY KEY NOT NULL AUTO_INCREMENT  
); 

CREATE TABLE IF NOT EXISTS objetivo ( 
 id_usuario INT,  
 cargo_de_interesse VARCHAR(255),  
 pretencao_salarial VARCHAR(255),  
 id_objetivo INT PRIMARY KEY NOT NULL AUTO_INCREMENT  
); 

CREATE TABLE IF NOT EXISTS idioma ( 
 id_usuario INT,  
 idioma VARCHAR(255),  
 proficiencia VARCHAR(255),  
 id_idioma INT PRIMARY KEY NOT NULL AUTO_INCREMENT
);

CREATE TABLE IF NOT EXISTS especializacoes ( 
 id_usuario INT,  
 pais VARCHAR(255),  
 categoria VARCHAR(255),
 organizacao VARCHAR(255),
 inicio DATE,
 final DATE, 
 responsabilidades VARCHAR(255), 
 id_especializacoes INT PRIMARY KEY NOT NULL AUTO_INCREMENT
); 

CREATE TABLE IF NOT EXISTS vaga ( 
 id_vaga INT PRIMARY KEY NOT NULL AUTO_INCREMENT,  
 id_usuario INT,  
 titulo VARCHAR(255),  
 area VARCHAR(255),  
 cargo VARCHAR(255),  
 especializacao VARCHAR(255),  
 senioridade VARCHAR(255),  
 numero_vagas int,  
 contrato VARCHAR(255),
 modalidade VARCHAR(255),
 periodo VARCHAR(255),
 salario VARCHAR(255),
 combinar INT,
 escolaridade VARCHAR(255),
 localizacao VARCHAR(255),
 descricao VARCHAR(1000)
); 

CREATE TABLE IF NOT EXISTS sobre_empresa (  
 id_usuario INT,  
 id_sobre INT PRIMARY KEY NOT NULL AUTO_INCREMENT,  
 nome_fantasia VARCHAR(255),
 razao_social VARCHAR(255),
 cnpj VARCHAR(255),
 setor VARCHAR(255), 
 numero_funcionarios int,
 porte VARCHAR(255),
 cep VARCHAR(255), 
 rua VARCHAR(255), 
 numero VARCHAR(255), 
 complemento VARCHAR(255),  
 bairro VARCHAR(255), 
 estado VARCHAR(255),  
 cidade VARCHAR(255),  
 responsavel_contato VARCHAR(255),
 cargo_responsavel VARCHAR(255),  
 celular_contato VARCHAR(255), 
 email VARCHAR(255), 
 pagina_web VARCHAR(255),
 descricao VARCHAR(3000)
);

CREATE TABLE if NOT EXISTS candidato_vaga (
id_candidato_vaga INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
id_vaga INT,
id_usuario int
);

ALTER TABLE dados_pessoais ADD  FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE experiencia ADD FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE formacao ADD FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE objetivo ADD FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE idioma ADD FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE vaga ADD FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE sobre_empresa ADD FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE candidato_vaga ADD FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE candidato_vaga ADD FOREIGN KEY(id_vaga) REFERENCES vaga (id_vaga);