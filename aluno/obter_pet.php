<?php
session_start();
header('Content-Type: application/json');
require '../tcc_db.php';

if (!isset($_SESSION['aluno'])) {
    echo json_encode(['pet' => null]);
    exit();
}

$alunoEmail = $_SESSION['aluno'];

$dados = sql([
    'statement' => "SELECT pet_escolhido FROM alunos WHERE email = ?",
    'types' => 's',
    'parameters' => [$alunoEmail],
    'only_first_row' => true
]);

$pet = $dados['pet_escolhido'] ?? null;

echo json_encode(['pet' => $pet]);
