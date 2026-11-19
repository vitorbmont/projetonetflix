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
  classificacao_indicativa VARCHAR(30),
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

CREATE TABLE episodios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    serie_id INT NOT NULL,
    numero INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    duracao INT NOT NULL DEFAULT 45,
    FOREIGN KEY (serie_id) REFERENCES series(id) ON DELETE CASCADE
);

CREATE TABLE favoritos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    tipo ENUM('filme', 'serie') NOT NULL,
    conteudo_id INT NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY favorito_unico (usuario_id, tipo, conteudo_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    tipo ENUM('filme', 'serie') NOT NULL,
    conteudo_id INT NOT NULL,
    nota TINYINT NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY avaliacao_unica (usuario_id, tipo, conteudo_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

