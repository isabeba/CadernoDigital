DROP DATABASE IF EXISTS quiz_db;
CREATE DATABASE quiz_db;
USE quiz_db;

CREATE TABLE questoes (
    id_questao INT AUTO_INCREMENT PRIMARY KEY,
    enunciado TEXT NOT NULL,
    imagem varchar (400)
);


CREATE TABLE alternativas (
    id_alternativa INT AUTO_INCREMENT PRIMARY KEY,
    id_questao INT,
    texto VARCHAR(255) NOT NULL,
    correta TINYINT(1) DEFAULT 0,
    FOREIGN KEY (id_questao) REFERENCES questoes(id_questao)
);



INSERT INTO questoes (enunciado) VALUES 
('Qual comando é usado para criar um banco de dados no MySQL?');

INSERT INTO alternativas (id_questao, texto, correta) VALUES
(1, 'CREATE TABLE', 0),
(1, 'CREATE DATABASE', 1),
(1, 'CREATE SCHEMA', 0),
(1, 'CREATE DB', 0);


INSERT INTO questoes (enunciado) VALUES 
('Em PHP, qual função é usada para conectar ao MySQL usando MySQLi?');

INSERT INTO alternativas (id_questao, texto, correta) VALUES
(2, 'mysqli_connect()', 1),
(2, 'mysql_connect()', 0),
(2, 'pdo_connect()', 0),
(2, 'db_connect()', 0);


INSERT INTO questoes (enunciado) VALUES 
('Qual é a extensão de arquivo padrão para scripts PHP?');

INSERT INTO alternativas (id_questao, texto, correta) VALUES
(3, '.html', 0),
(3, '.php', 1),
(3, '.js', 0),
(3, '.css', 0);


INSERT INTO questoes (enunciado) VALUES 
('No SQL, qual comando é usado para selecionar dados de uma tabela?');

INSERT INTO alternativas (id_questao, texto, correta) VALUES
(4, 'SELECT', 1),
(4, 'SHOW', 0),
(4, 'EXTRACT', 0),
(4, 'DISPLAY', 0);

INSERT INTO questoes (enunciado) VALUES 
('Qual superglobal em PHP é usada para capturar dados enviados via formulário pelo método POST?');

INSERT INTO alternativas (id_questao, texto, correta) VALUES
(5, '$_GET', 0),
(5, '$_POST', 1),
(5, '$_REQUEST', 0),
(5, '$_FORM', 0);

select * from questoes;