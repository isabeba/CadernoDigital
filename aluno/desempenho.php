<?php
session_start();
require __DIR__ . '/../tcc_db.php';
require __DIR__ . '/../tcc_quiz/quiz_app/db.php';


$id_aluno = $_SESSION['id'] ?? null;
if (!$id_aluno) {
    die("Acesso negado. Faça login primeiro.");
}

if (!$GLOBALS['sql'] || !$conn) {
    die("Erro: não foi possível conectar a um dos bancos.");
}

$query = "
    SELECT 
        r.*, 
        a.nome 
    FROM quiz2_db.resultados r
    JOIN tcc_db.alunos a ON r.id_aluno = a.id
    WHERE r.id_aluno = ?
    ORDER BY r.data_hora DESC
    LIMIT 10
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_aluno);
$stmt->execute();
$result = $stmt->get_result();

$resultados = [];
while ($row = $result->fetch_assoc()) {
    $resultados[] = $row;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Meu Desempenho no Quiz</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@300;400;700&family=Patrick+Hand&display=swap" rel="stylesheet">
<link class="favicon" rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">

<style>
  :root {
    --roxo-principal: #8f63c9;
    --roxo-claro: #bfa3e6;
    --roxo-escuro: #6c45a1;
    --cinza-fundo: #f4f2f8;
    --branco: #ffffff;
  }

  body {
    font-family: 'Nunito';
    background: var(--cinza-fundo);
    margin: 0;
    padding: 0;
    color: #333;
  }

  header {
    background: var(--roxo-principal);
    color: var(--branco);
    text-align: center;
    padding: 25px 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.15);
  }

  header h1 {
    margin: 0;
    font-size: 1.8rem;
  }

  #container {
    max-width: 900px;
    margin: 50px auto;
    background: var(--branco);
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    padding: 30px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 15px;
    overflow: hidden;
    margin-top: 10px;
  }

  th, td {
    padding: 14px;
    text-align: center;
  }

  th {
    background: var(--roxo-principal);
    color: var(--branco);
    font-weight: 600;
  }

  tr:nth-child(even) {
    background: #f9f7fc;
  }

  tr:hover {
    background: var(--roxo-claro);
    color: var(--branco);
    transition: 0.3s;
  }

  .sair {
    display: inline-block;
    margin-top: 30px;
    background-color: var(--roxo-principal);
    color: var(--branco);
    padding: 12px 24px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 500;
    transition: 0.3s;
  }

  .sair:hover {
    background-color: var(--roxo-escuro);
    transform: translateY(-2px);
    text-decoration: none;
  }

  footer {
    text-align: center;
    margin: 30px 0 20px;
    font-size: 0.9rem;
    color: #777;
  }

  @media (max-width: 700px) {
    table, th, td {
      font-size: 0.85rem;
    }
    #container {
      padding: 20px;
    }
  }
</style>
</head>
<body>

<header>
  <h1>Meu Desempenho nos testes</h1>
</header>

<div id="container">
  <table>
    <tr>
      <th>Aluno</th>
      <th>Acertos</th>
      <th>Erros</th>
      <th>Porcentagem</th>
      <th>Tempo (s)</th>
      <th>Data/Hora</th>
    </tr>

    <?php if (empty($resultados)): ?>
      <tr><td colspan="6">Nenhum resultado encontrado.</td></tr>
    <?php else: ?>
      <?php foreach ($resultados as $r): ?>
        <tr>
          <td><?= htmlspecialchars($r['nome']) ?></td>
          <td><?= $r['acertos'] ?></td>
          <td><?= $r['erros'] ?></td>
          <td><?= number_format($r['porcentagem'], 1) ?>%</td>
          <td><?= $r['tempo_total_segundos'] ?></td>
          <td><?= date('d/m/Y H:i', strtotime($r['data_hora'])) ?></td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </table>

  <a href="/CadernoDigital-main/aluno/pagina_inicial.php" class="sair">⟵ Voltar</a>
</div>

<footer>
  <p>© 2025 Caderno Digital | Resultados do Quiz</p>
</footer>

<div id="pet-fixo" style="display:none; position:fixed; top:10px; right:10px; width:150px; height:150px; z-index:1000;">
  <img id="pet-img" src="" alt="Pet" style="width:100%; height:100%; object-fit:cover;">
  <h6 id="pet-nome" style="text-align:center;"></h6>
</div>

<script src="../aluno/pet_fixo.js"></script>

</body>
</html>
