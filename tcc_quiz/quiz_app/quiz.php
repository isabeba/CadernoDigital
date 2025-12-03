<?php
session_start();
include "db.php";
mysqli_set_charset($conn, "utf8mb4");

$numero_questoes = 5;

if (!isset($_SESSION['questoes_sorteadas']) || isset($_GET['restart'])) {
    $sql = "SELECT id_questao FROM questoes ORDER BY RAND() LIMIT ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $numero_questoes);
    $stmt->execute();
    $result = $stmt->get_result();

    $_SESSION['questoes_sorteadas'] = array_column($result->fetch_all(MYSQLI_ASSOC), 'id_questao');
    $_SESSION['inicio_quiz'] = microtime(true);
    $_SESSION['acertos'] = $_SESSION['erros'] = 0;
    $_SESSION['respostas'] = $_SESSION['tempo_questoes'] = [];
    unset($_SESSION['resultado_salvo']);

    $stmt->close();
}


$posicao = isset($_GET['q']) ? (int) $_GET['q'] : 0;
$questao_id = $_SESSION['questoes_sorteadas'][$posicao] ?? null;


if (!$questao_id) {
    header("Location: resultado_final.php");
    exit;
}

$_SESSION['inicio_dessa_questao'] = microtime(true);


$stmt = $conn->prepare("SELECT * FROM questoes WHERE id_questao = ?");
$stmt->bind_param("i", $questao_id);
$stmt->execute();
$questao = $stmt->get_result()->fetch_assoc();
$stmt->close();


$stmtAlt = $conn->prepare("SELECT * FROM alternativas WHERE id_questao = ? ORDER BY RAND()");
$stmtAlt->bind_param("i", $questao_id);
$stmtAlt->execute();
$alternativas = $stmtAlt->get_result();
$stmtAlt->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Questão <?= $posicao + 1 ?> de <?= count($_SESSION['questoes_sorteadas']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@300;400;700&family=Patrick+Hand&display=swap" rel="stylesheet">
  <link class="favicon" rel="shortcut icon" href="../../imagens/favicon.ico" type="image/x-icon">


  <style>
    body {
      background: linear-gradient(135deg, #8f63c9, #8f63c9);
      font-family: 'Nunito';
    }
    .card {
      border-radius: 15px;
      animation: fadeIn 0.5s ease-in;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .progress {
      height: 10px;
      margin-bottom: 15px;
    }
    .img-questao {
      max-width: 300px;
      max-height: 300px;
      object-fit: contain;
      border-radius: 10px;
      margin: 20px auto;
      display: block;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }
     .form-check-label {
      font-size: 1.25rem;
      font-family: "Nunito";
    }
    /* Cor da bolinha quando NÃO está selecionada */
.form-check-input {
    border-color: #696969ff !important;   /* borda mais escura */
}

/* Bolinha quando passa o mouse */
.form-check-input:hover {
    border-color: #868686ff !important;
    background-color: #ccc !important; /* cinza claro no hover */
}

/* Bolinha quando está selecionada */
.form-check-input:checked {
    background-color: #6a6a6aff !important; /* preto */
    border-color: #676767ff !important;
}

  </style>
</head>

<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-lg p-4">

    
      <div class="progress mb-3">
        <div class="progress-bar bg-success" role="progressbar"
             style="width: <?= (($posicao + 1) / count($_SESSION['questoes_sorteadas'])) * 100 ?>%;">
        </div>
      </div>

      <h5 class="text-muted">Questão <?= $posicao + 1 ?> de <?= count($_SESSION['questoes_sorteadas']) ?></h5>
      <h4 class="mt-3"><?= htmlspecialchars($questao['enunciado']); ?></h4>

      <?php if (!empty($questao['imagem'])): ?>
        <img class="img-questao" src="<?= htmlspecialchars($questao['imagem']) ?>" alt="Imagem da questão">
      <?php endif; ?>

      <form method="post" action="resultado_parcial.php" class="mt-3">
        <?php while ($alt = $alternativas->fetch_assoc()): ?>
          <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="resposta" id="alt<?= $alt['id_alternativa']; ?>" 
                   value="<?= $alt['id_alternativa']; ?>" required>
            <label class="form-check-label" for="alt<?= $alt['id_alternativa']; ?>">
              <?= htmlspecialchars($alt['texto']); ?>
            </label>
          </div>
        <?php endwhile; ?>

        <input type="hidden" name="questao_id" value="<?= $questao_id ?>">
        <input type="hidden" name="posicao" value="<?= $posicao ?>">
        <input type="hidden" name="total_questoes" value="<?= count($_SESSION['questoes_sorteadas']) ?>">

        <button type="submit" class="btn btn-success mt-4 w-100">Responder</button>
      </form>
    </div>
  </div>
</body>
</html>
