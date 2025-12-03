<?php
session_start();
header('Content-Type: application/json');
require '../tcc_db.php';

if (!isset($_SESSION['aluno'])) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Usuário não logado.']);
    exit();
}

$alunoEmail = $_SESSION['aluno'];
$input = json_decode(file_get_contents('php://input'), true);
$petEscolhido = $input['pet'] ?? '';

if (empty($petEscolhido)) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Nenhum pet escolhido.']);
    exit();
}

try {
    sql([
        'statement' => "UPDATE alunos SET pet_escolhido = ? WHERE email = ?",
        'types' => 'ss',
        'parameters' => [$petEscolhido, $alunoEmail]
    ]);

    echo json_encode(['sucesso' => true, 'mensagem' => 'Pet salvo com sucesso!']);
} catch (Exception $e) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro: ' . $e->getMessage()]);
}
