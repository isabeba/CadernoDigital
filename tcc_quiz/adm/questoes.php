<?php
include "db.php";
$sql = "SELECT * FROM questoes";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Questões</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .img-questao {
      max-width: 120px;
      max-height: 120px;
      object-fit: contain;
      border-radius: 6px;
      display: block;
      margin: auto;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-lg p-5">
      <h2>📋 Lista de Questões</h2>
      <a href="add_questao.php" class="btn btn-success mb-3">➕ Nova Questão</a>
      <table class="table table-striped align-middle text-center">
        <thead>
          <tr>
            <th>ID</th>
            <th>Enunciado</th>
            <th>Imagem</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $row['id_questao']; ?></td>
              <td><?php echo $row['enunciado']; ?></td>
              <td>
                <?php
                  $img = $row['imagem'];
                  if (filter_var($img, FILTER_VALIDATE_URL)) {
                      echo "<img class='img-questao' src='" . htmlspecialchars($img) . "' alt='Questão'>";
                  } elseif ($img && file_exists($img)) {
                      echo "<img class='img-questao' src='" . htmlspecialchars($img) . "' alt='Questão'>";
                  } else {
                      echo "Sem imagem";
                  }
                ?>
              </td>
              <td>
                <a href="edit_questao.php?id=<?php echo $row['id_questao']; ?>" class="btn btn-warning btn-sm">✏ Editar</a>
                <a href="delete_questao.php?id=<?php echo $row['id_questao']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir esta questão?')">🗑 Excluir</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <a href="index.php" class="btn btn-secondary">⬅ Voltar</a>
    </div>
  </div>
</body>
</html>
