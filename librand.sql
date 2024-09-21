CREATE DATABASE IF NOT EXISTS librand;
USE librand;

CREATE TABLE IF NOT EXISTS usuario ( 
 id_usuario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,  
 usuario VARCHAR(255),  
 senha VARCHAR(255), 
 email VARCHAR(255),
 foto_perfil VARCHAR(255),
 termos int,
 receber_email int
); 

CREATE TABLE IF NOT EXISTS dados_pessoais ( 
 id_usuario INT,  
 nome VARCHAR(255),  
 sobrenome VARCHAR(255),  
 nome_social VARCHAR(255),  
 país VARCHAR(255),  
 cpf VARCHAR(255),  
 celular VARCHAR(255),  
 data DATE,  
 raca VARCHAR(255),  
 estado_civil VARCHAR(255),  
 possui_deficiencia VARCHAR(255),  
 deficiencia VARCHAR(255),  
 laudo VARCHAR(255),  
 suporte VARCHAR(255),  
 renda_pessoal VARCHAR(255),  
 renda_familiar VARCHAR(255),  
 cep VARCHAR(255),  
 rua VARCHAR(255),  
 numero INT,  
 complemento VARCHAR(255),  
 bairro VARCHAR(255),  
 estado VARCHAR(255),  
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
 id_experiencia INT PRIMARY KEY NOT NULL AUTO_INCREMENT  
); 

CREATE TABLE IF NOT EXISTS formacao ( 
 id_usuario INT,  
 país VARCHAR(255),  
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

CREATE TABLE IF NOT EXISTS empresa ( 
 id_empresa INT PRIMARY KEY NOT NULL AUTO_INCREMENT,  
 nome_da_empresa VARCHAR(255),  
 nome_e_sobrenome VARCHAR(255),  
 email VARCHAR(255),  
 cnpj VARCHAR(255),  
 cep VARCHAR(255),
 telefone VARCHAR(255),
 celular VARCHAR(255),
 senha VARCHAR(255)
); 

CREATE TABLE IF NOT EXISTS vaga ( 
 id_vaga INT PRIMARY KEY NOT NULL AUTO_INCREMENT,  
 numero_de_vagas INT,  
 titulo VARCHAR(255),  
 id_empresa INT,  
 id_usuario INT,  
 salario VARCHAR(255),  
 senioridade VARCHAR(255),  
 contrato VARCHAR(255),  
 jornada VARCHAR(255),  
 modelo_de_trabalho VARCHAR(255),  
 area VARCHAR(255),  
 pcd VARCHAR(255)
); 

CREATE TABLE IF NOT EXISTS sobre_empresa ( 
 id_empresa INT,  
 id_sobre INT PRIMARY KEY NOT NULL AUTO_INCREMENT,  
 sobre VARCHAR(255),  
 matriz VARCHAR(255),  
 links VARCHAR(255),  
 funcionarios VARCHAR(255)  
); 

ALTER TABLE dados_pessoais ADD  FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE experiencia ADD FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE formacao ADD FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE objetivo ADD FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE idioma ADD FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE vaga ADD FOREIGN KEY(id_empresa) REFERENCES empresa (id_empresa);
ALTER TABLE vaga ADD FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE sobre_empresa ADD FOREIGN KEY(id_empresa) REFERENCES empresa (id_empresa);