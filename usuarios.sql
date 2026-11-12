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

