<?php
session_start();
require 'tcc_db.php';

$nome  = $_POST['nome'] ?? '';
$apelido = $_POST['apelido'] ?? '';
$data_nascimento  = $_POST['data_nascimento'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['password'] ?? '';


$aluno = sql ([
    'statement' => 'SELECT * FROM alunos WHERE email = ?',
    'types' => 's',
    'parameters' => [$email],
    'only_first_row' => true
]);


if ($aluno && isset($aluno['senha']) && password_verify($senha, $aluno['senha'])) {
    $_SESSION['aluno'] = $aluno['email'];
    $_SESSION['apelido'] = $aluno['apelido'];
    $_SESSION['nome'] = $aluno['nome'];
    $_SESSION['id'] = $aluno['id'];
    

    header("Location: aluno/pagina_inicial.php");
    exit;
}

echo "Login inválido ou Usuario inativo. <a href='login.php'>Tentar novamente</a>";
exit();
?>