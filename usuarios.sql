create database net_login;
use net_login;

create table usuarios (
  id int auto_increment primary key,
  nome varchar(100) not null,
  sobrenome varchar(100) not null,
  email varchar(150) not null unique,
  data_nascimento date not null,
  senha varchar(255) not null,
  data_cadastro timestamp default current_timestamp
);


insert into usuarios (nome, email, senha) values ("Vitor", "user@localhost", "123");