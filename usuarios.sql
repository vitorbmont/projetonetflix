create database fatecflix_bd;
use fatecflix_bd;

create table usuarios (
  id int auto_increment primary key,
  nome varchar(100) not null,
  sobrenome varchar(100) not null,
  email varchar(150) not null unique,
  data_nascimento date not null,
  senha varchar(255) not null,
  data_cadastro timestamp default current_timestamp
);

create table moderadores (
  id int auto_increment primary key,
  nome varchar(100) not null,
  email varchar(150) not null unique,
  senha varchar(255) not null,
  data_cadastro timestamp default current_timestamp
);

create table filmes (
  id int auto_increment primary key,
  titulo varchar(150) not null,
  sinopse text not null,
  genero varchar(80) not null,
  ano_lancamento year not null,
  duracao int not null,
  classificacao_indicativa VARCHAR(10),
  capa varchar(255),
  moderador_id int not null,
  data_cadastro timestamp default current_timestamp,

  foreign key (moderador_id) references moderadores(id)
);

CREATE TABLE series (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(150) NOT NULL,
  sinopse TEXT NOT NULL,
  genero VARCHAR(80) NOT NULL,
  ano_lancamento YEAR NOT NULL,
  qtd_episodios INT NOT NULL,
  classificacao_indicativa VARCHAR(10),
  imagem VARCHAR(255),
  moderador_id INT NOT NULL,
  data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  FOREIGN KEY (moderador_id) REFERENCES moderadores(id)
);

