<?php
include "db.php"; // Ajuste para caminho correto do seu db.php

$questao_id = isset($_GET['questao']) ? (int) $_GET['questao'] : 1;

// Buscar questão
$stmt = $conn->prepare("SELECT * FROM questoes WHERE id_questao = ?");
$stmt->bind_param("i", $questao_id);
$stmt->execute();
$result = $stmt->get_result();
$questao = $result->fetch_assoc();
$stmt->close();

// Buscar alternativas
$stmtAlt = $conn->prepare("SELECT * FROM alternativas WHERE id_questao = ?");
$stmtAlt->bind_param("i", $questao_id);
$stmtAlt->execute();
$alternativas = $stmtAlt->get_result();
$stmtAlt->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Questão <?php echo $questao_id; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .img-questao {
      max-width: 300px;
      max-height: 300px;
      object-fit: contain;
      border-radius: 8px;
      margin: 15px auto;
      display: block;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-lg p-4">
      <h4><?php echo htmlspecialchars($questao['enunciado']); ?></h4>

      <?php
      $img = $questao['imagem'] ?? '';

if ($img) {
    if (filter_var($img, FILTER_VALIDATE_URL)) {
        // URL externa
        echo "<img class='img-questao' src='" . htmlspecialchars($img) . "' alt='Imagem da questão'>";
    } elseif (file_exists(__DIR__ . '/../' . $img)) {
        // Arquivo local
        echo "<img class='img-questao' src='../" . htmlspecialchars($img) . "' alt='Imagem da questão'>";
    } else {
        echo "<p class='text-muted mt-3'>Sem imagem</p>";
    }
} else {
    echo "<p class='text-muted mt-3'>Sem imagem</p>";
}
      ?>

      <form method="post" action="resultado.php">
        <?php while ($alt = $alternativas->fetch_assoc()) { ?>
          <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="resposta" value="<?php echo $alt['id_alternativa']; ?>" required>
            <label class="form-check-label"><?php echo htmlspecialchars($alt['texto']); ?></label>
          </div>
        <?php } ?>
        <input type="hidden" name="questao_id" value="<?php echo $questao_id; ?>">
        <button type="submit" class="btn btn-success mt-3">Responder</button>
      </form>
    </div>
  </div>
</body>
</html>
