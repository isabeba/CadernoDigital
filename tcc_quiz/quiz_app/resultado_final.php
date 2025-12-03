<?php
session_start();
include "db.php";
mysqli_set_charset($conn, "utf8mb4");

$id_aluno = $_SESSION['id'] ?? 0;
if (!$id_aluno) {
    header("Location: login.php");
    exit;
}


$tempo_total_segundos = 0;
if (isset($_SESSION['tempo_questoes']) && count($_SESSION['tempo_questoes']) > 0) {
    foreach ($_SESSION['tempo_questoes'] as $t) {
        $tempo_total_segundos += $t;
    }
} elseif (isset($_SESSION['inicio_quiz'])) {
    $tempo_total_segundos = microtime(true) - $_SESSION['inicio_quiz'];
}


$tempo_total_minutos = round($tempo_total_segundos / 60, 1);


$respostas = $_SESSION['respostas'] ?? [];
$acertos = 0;
$erros = 0;

foreach ($respostas as $id_questao => $id_alternativa) {
    $stmt = $conn->prepare("SELECT correta FROM alternativas WHERE id_alternativa = ?");
    $stmt->bind_param("i", $id_alternativa);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!empty($row) && $row['correta'] == 1) $acertos++;
    else $erros++;
}

$total_questoes = $acertos + $erros;
$porcentagem = $total_questoes > 0 ? ($acertos / $total_questoes) * 100 : 0;


if ($total_questoes > 0) {
    $stmt = $conn->prepare("INSERT INTO resultados (id_aluno, acertos, erros, total_questoes, porcentagem, tempo_total_segundos)
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiidd", $id_aluno, $acertos, $erros, $total_questoes, $porcentagem, $tempo_total_segundos);
    $stmt->execute();
    $id_resultado = $stmt->insert_id;
    $stmt->close();

    
    if (isset($_SESSION['tempo_questoes'])) {
        foreach ($_SESSION['tempo_questoes'] as $id_questao => $tempo) {
            $stmt = $conn->prepare("INSERT INTO tempo_respostas (id_resultado, id_questao, tempo_segundos)
                                    VALUES (?, ?, ?)");
            $stmt->bind_param("iid", $id_resultado, $id_questao, $tempo);
            $stmt->execute();
            $stmt->close();
        }
    }

}


$stmt = $conn->prepare("SELECT 
    COUNT(*) AS tentativas,
    AVG(porcentagem) AS media,
    AVG(tempo_total_segundos) AS tempo_medio
    FROM resultados
    WHERE id_aluno = ?");
$stmt->bind_param("i", $id_aluno);
$stmt->execute();
$geral = $stmt->get_result()->fetch_assoc();
$stmt->close();


$stmt = $conn->prepare("SELECT * FROM resultados WHERE id_aluno = ? ORDER BY data_hora DESC LIMIT 10");
$stmt->bind_param("i", $id_aluno);
$stmt->execute();
$resultados = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Resultado Final</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@300;400;700&family=Patrick+Hand&display=swap" rel="stylesheet">
<link class="favicon" rel="shortcut icon" href="../../imagens/favicon.ico" type="image/x-icon">

<style>
body {
    font-family: "Nunito";
    background: linear-gradient(135deg, #8e44ad, #7c4fb3);
    color: #333;
    margin: 0;
    padding: 40px;
}
h1 {
    text-align: center;
    color: white;
    margin-bottom: 30px;
}
.container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
    max-width: 1000px;
    margin: auto;
    grid-template-areas:
        "tentativas media tempo"
        ". resultado-atual .";
}
.container .card:nth-child(1) { grid-area: tentativas; }
.container .card:nth-child(2) { grid-area: media; }
.container .card:nth-child(3) { grid-area: tempo; }
.container .resultado-atual { grid-area: resultado-atual; }

.card {
    background: white;
    border-radius: 20px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
.card h2 {
    margin: 0;
    color: #6a1b9a;
    font-size: 2em;
}
.card p {
    margin-top: 8px;
    color: #777;
    font-size: 1em;
}
.history {
    background: #f9f9f9;
    padding: 25px;
    border-radius: 20px;
    margin-top: 40px;
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}
table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
}
th, td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}
th {
    background: #6a1b9a;
    color: white;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
tr:hover {
    background: #f3e5f5;
}
</style>
</head>
<body class="bg-light text-center">

<h1>🎯 Resultado Final do Quiz</h1>

<div class="container">
    <div class="card">
        <h2><?= $geral['tentativas'] ?: 0 ?></h2>
        <p>Tentativas realizadas</p>
    </div>

    <div class="card">
        <h2><?= number_format($geral['media'] ?? 0, 1) ?>%</h2>
        <p>Média de Acertos das tentativas</p>
    </div>

    <div class="card">
        <h2><?= round($tempo_total_minutos, 1) ?> min</h2>
        <p>Tempo total atual</p>
    </div>

    <div class="card resultado-atual">
        <h2><?= $acertos ?>/<?= $total_questoes ?></h2>
        <p>Resultado atual</p>
    </div>
</div>

<div class="history">
<h2 style="color:#6a1b9a;text-align:center;">Histórico recente</h2>
<table>
    <tr>
        <th>Data</th>
        <th>Acertos</th>
        <th>Erros</th>
        <th>%</th>
        <th>Tempo (min)</th>
    </tr>
    <?php foreach ($resultados as $r): ?>
    <tr>
        <td><?= date('d/m/Y H:i', strtotime($r['data_hora'])) ?></td>
        <td><?= $r['acertos'] ?></td>
        <td><?= $r['erros'] ?></td>
        <td><?= number_format($r['porcentagem'], 1) ?>%</td>
        <td><?= round($r['tempo_total_segundos']/60,1) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</div>

<h4 class="mt-4 text-white">🎉 Fim do Quiz!</h4>
<a href="index.php" class="btn btn-light mt-3">Voltar ao Início</a>

</body>
</html>

