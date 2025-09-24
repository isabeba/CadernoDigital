create database  if not exists tcc_db;
use tcc_db;

create table alunos (
	id int auto_increment primary key,
	nome varchar (100) not null,
    apelido varchar (50) not null,
    data_nascimento date,
    email varchar(100) not null unique,
    senha varchar (50) not null
);

select * from alunos;

insert into alunos (nome, apelido, data_nascimento, email, senha) values 
('Maria Eduarda Florentino', 'Duda', '2007-12-16', 'maria@gmail.com', 'duda123');