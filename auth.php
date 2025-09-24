<?php
session_start();
require 'tcc_db.php';

$nome  = $_POST['nome'] ?? '';
$apelido = $_POST['apelido'] ?? '';
$data_nascimento  = $_POST['data_nascimento'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['password'] ?? '';

$aluno = sql ([
    'statement' => 'SELECT * FROM alunos WHERE email = ? AND senha = ?',
    'types' => 'ss',
    'parameters' => [$email, $senha],
    'only_first_row' => true
]);

if (!$aluno) {
  echo "Debug: A consulta não retornou resultados.<br>";
  echo "Último erro do SQL: " . $GLOBALS['sql']->error . "<br>";
  echo "E-mail tentado: " . $email . "<br>";
  echo "Senha tentada: " . $senha . "<br>";
  exit; // Interrompe para inspecionar
}

if ($aluno && isset($aluno['senha'])) {
    $_SESSION['aluno'] = $aluno['email'];
    header("Location: /TCC/aluno/pagina_inicial.php");
    exit;
}

echo "Login inválido ou Usuario inativo. <a href='login.php'>Tentar novamente</a>";
exit();
?>