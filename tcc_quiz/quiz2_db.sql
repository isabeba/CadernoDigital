CREATE DATABASE quiz2_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

DROP DATABASE IF EXISTS quiz2_db;

USE quiz2_db;


CREATE TABLE questoes (
    id_questao INT AUTO_INCREMENT PRIMARY KEY,
    enunciado TEXT NOT NULL,
    imagem varchar (400)
)CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE alternativas (
    id_alternativa INT AUTO_INCREMENT PRIMARY KEY,
    id_questao INT,
    texto VARCHAR(255) NOT NULL,
    correta TINYINT(1) DEFAULT 0,
    FOREIGN KEY (id_questao) REFERENCES questoes(id_questao)
)CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE resultados (
	id_resultado INT AUTO_INCREMENT PRIMARY KEY,
    id_aluno INT,
    acertos INT,
    erros INT, 
    total_questoes INT,
    porcentagem DECIMAL(5,2),
    tempo_total_segundos INT,
    data_hora DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tempo_respostas (
    id_tempo INT AUTO_INCREMENT PRIMARY KEY,
    id_resultado INT,
    id_questao INT,
    tempo_segundos INT,
    FOREIGN KEY (id_resultado) REFERENCES resultados(id_resultado)
);



select * from questoes;
select * from alternativas;
select * from resultados;