create database  if not exists tcc_db;
use tcc_db;


create table alunos (
	id int auto_increment primary key,
	nome varchar (100) not null,
    apelido varchar (50) not null,
    data_nascimento date,
    email varchar(100) not null unique,
    senha varchar (200) not null
);

CREATE TABLE anotacoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_aluno INT NOT NULL,
  texto TEXT,
  atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_aluno INT NULL,
    titulo VARCHAR(100) NOT NULL,
    data_evento DATE NOT NULL,
    descricao TEXT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



select * from alunos;
select * from anotacoes;
select * from eventos;


INSERT INTO eventos (titulo, data_evento, descricao, id_aluno) values
('ENEM 2025 - 1ª Prova', '2025-11-09', 'Aplicação do ENEM', NULL),
('ENEM 2025 - 2ª Prova', '2025-11-16', 'Aplicação do ENEM', NULL),
('1ª fase do vestibular da Unesp', '2025-11-02', 'Aplicação do vestibular', NULL),
('1ª fase do vestibular da Fuvest', '2025-11-23', 'Aplicação do vestibular', NULL);

 --- nao usar esse insert, ele esta aqui apenas para lembrar da conta
insert into alunos (nome, apelido, data_nascimento, email, senha) values  
('Maria Eduarda Florentino', 'Duda', '2007-12-16', 'maria@gmail.com', 'duda123');