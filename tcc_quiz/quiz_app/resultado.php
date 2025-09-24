<?php
include "db.php";

$questao_id = $_POST['questao_id'];
$resposta_id = $_POST['resposta'];

// Verifica se a alternativa é correta
$sql = "SELECT correta FROM alternativas WHERE id_alternativa = $resposta_id";
$result = $conn->query($sql);
$resposta = $result->fetch_assoc();

$correta = $resposta['correta'] == 1;

// Verifica se existe próxima questão
$sql_next = "SELECT id_questao FROM questoes WHERE id_questao > $questao_id ORDER BY id_questao ASC LIMIT 1";
$next = $conn->query($sql_next);
$tem_proxima = $next->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Resultado</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-center">
  <div class="container mt-5">
    <div class="card shadow-lg p-5">
      <?php if ($correta) { ?>
        <h3 class="text-success">✅ Resposta correta!</h3>
      <?php } else { ?>
        <h3 class="text-danger">❌ Resposta incorreta!</h3>
      <?php } ?>

      <?php if ($tem_proxima) { ?>
        <a href="quiz.php?questao=<?php echo $tem_proxima['id_questao']; ?>" class="btn btn-primary mt-3">Próxima Questão</a>
      <?php } else { ?>
        <h4 class="mt-4">🎉 Fim do Quiz!</h4>
        <a href="index.php" class="btn btn-secondary mt-3">Voltar ao Início</a>
      <?php } ?>
    </div>
  </div>
</body>
</html>
