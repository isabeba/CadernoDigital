<?php
session_start();
require 'tcc_db.php';

$nome  = $_POST['nome'] ?? null;
$apelido = $_POST['apelido'] ?? null;
$data_nascimento  = $_POST['data_nascimento'] ?? null;
$email = $_POST['email'] ?? null;
$senha = $_POST['senha'] ?? null;





if (!$nome || !$apelido || !$data_nascimento || !$email || !$senha ) {
    die("Erro: Todos os campos sao obrigatórios.");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Erro: E-mail inválido.");
}


$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

try {
    sql([
        'statement' => 'INSERT INTO alunos (nome, apelido, data_nascimento, email, senha) VALUES (?, ?, ?, ?, ?)',
        'types' => 'sssss',
        'parameters' => [$nome, $apelido, $data_nascimento, $email, $senhaHash],
        'only_first_row' => false
    ]);
} catch (Exception $e) {
    die("Erro ao adicionar Aluno:" . $e->getMessage());
}

header("Location: login.php");
exit;

?>