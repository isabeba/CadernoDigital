<?php
session_start();
include "db.php";
mysqli_set_charset($conn, "utf8mb4");


$id_aluno = $_SESSION['id'] ?? 0;
if (!$id_aluno) {
    header("Location: quiz.php");
    exit;
}

$questao_id    = $_POST['questao_id'] ?? null;
$resposta_id   = $_POST['resposta'] ?? null;
$posicao       = $_POST['posicao'] ?? 0;
$total_questoes = $_POST['total_questoes'] ?? count($_SESSION['questoes_sorteadas']);

if (!$questao_id || !$resposta_id) {
    header("Location: quiz.php");
    exit;
}

if (isset($_SESSION['inicio_dessa_questao'])) {
    $_SESSION['tempo_questoes'][$questao_id] = microtime(true) - $_SESSION['inicio_dessa_questao'];
    unset($_SESSION['inicio_dessa_questao']);
}

$tempo_questao = $_SESSION['tempo_questoes'][$questao_id] ?? 0;
$tempo_formatado = round($tempo_questao, 2); 

$stmt = $conn->prepare("SELECT correta FROM alternativas WHERE id_alternativa = ?");
$stmt->bind_param("i", $resposta_id);
$stmt->execute();
$resp = $stmt->get_result()->fetch_assoc();
$stmt->close();

$acertou = $resp && $resp['correta'] == 1;


if (!isset($_SESSION['acertos'])) $_SESSION['acertos'] = 0;
if (!isset($_SESSION['erros'])) $_SESSION['erros'] = 0;

if ($acertou) {
    $_SESSION['acertos']++;
    $mensagem = "✅ Você acertou!";
    $cor = "green";
} else {
    $_SESSION['erros']++;
    $mensagem = "❌ Você errou!";
    $cor = "red";
}


if (!isset($_SESSION['respostas'])) $_SESSION['respostas'] = [];
$_SESSION['respostas'][$questao_id] = $resposta_id;


$proxima_posicao = $posicao + 1;
$ultima_questao  = $proxima_posicao >= $total_questoes;


$proxima_url = $ultima_questao ? 'resultado_final.php' : 'quiz.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado Parcial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@300;400;700&family=Patrick+Hand&display=swap" rel="stylesheet">
    <link class="favicon" rel="shortcut icon" href="../../imagens/favicon.ico" type="image/x-icon">

    <style>
        body {
            font-family: "Nunito";
            background: linear-gradient(135deg, #8e44ad, #7c4fb3);
            color: white;
            text-align: center;
            padding-top: 100px;
        }
        .card {
            background: white;
            color: #333;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            display: inline-block;
            min-width: 300px;
        }
        h2 {
            color: <?= $cor ?>;
            font-weight: bold;
        }
        p {
            margin-top: 10px;
            font-size: 1.1em;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2><?= $mensagem ?></h2>
        <p>⏱ Tempo desta questão: <?= $tempo_formatado ?> segundos</p>

        <form method="get" action="<?= $proxima_url ?>">
            <?php if (!$ultima_questao): ?>
                <input type="hidden" name="q" value="<?= $proxima_posicao ?>">
            <?php endif; ?>
            <button type="submit" class="btn btn-success mt-3">
                <?= $ultima_questao ? 'Ver Resultado Final' : 'Próxima Questão' ?>
            </button>
        </form>
    </div>
</body>
</html>
