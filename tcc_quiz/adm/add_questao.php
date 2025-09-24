<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enunciado = $_POST['enunciado'];
    $alternativas = $_POST['alternativas'];
    $correta = $_POST['correta'];

    // Tratamento da imagem
    $imagem = "";
    if (!empty($_POST['url_imagem'])) {
        // Se for URL
        $imagem = $_POST['url_imagem'];
    } elseif (isset($_FILES['imagem_file']) && $_FILES['imagem_file']['error'] == 0) {
        // Se for upload
        $extensao = pathinfo($_FILES['imagem_file']['name'], PATHINFO_EXTENSION);
        $nome_imagem = "imagem_" . time() . "." . $extensao;
        $caminho_imagem = "imagens/" . $nome_imagem;

        if (!is_dir("imagem")) {
            mkdir("imagem", 0777, true);
        }

        if (move_uploaded_file($_FILES['imagem_file']['tmp_name'], $caminho_imagem)) {
            $imagem = $caminho_imagem;
        }
    }

    // Inserir questão
    $stmt = $conn->prepare("INSERT INTO questoes (enunciado, imagem) VALUES (?, ?)");
    $stmt->bind_param("ss", $enunciado, $imagem);
    $stmt->execute();
    $questao_id = $stmt->insert_id;

    // Inserir alternativas
    foreach ($alternativas as $i => $alt) {
        $corretaFlag = ($correta == $i) ? 1 : 0;
        $stmtAlt = $conn->prepare("INSERT INTO alternativas (id_questao, texto, correta) VALUES (?, ?, ?)");
        $stmtAlt->bind_param("isi", $questao_id, $alt, $corretaFlag);
        $stmtAlt->execute();
    }

    header("Location: questoes.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Questão</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-lg p-5">
      <h2>➕ Nova Questão</h2>
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Enunciado da Questão</label>
          <textarea name="enunciado" class="form-control" required></textarea>
        </div>
        <h5>Alternativas</h5>
        <?php for ($i=0; $i<4; $i++) { ?>
          <div class="input-group mb-2">
            <div class="input-group-text">
              <input type="radio" name="correta" value="<?php echo $i; ?>" required>
            </div>
            <input type="text" name="alternativas[]" class="form-control" placeholder="Digite a alternativa" required>
          </div>
        <?php } ?>

        <h5 class="mt-3">Imagem (opcional)</h5>
        <div class="mb-2">
          <label>Upload:</label>
          <input type="file" name="imagem_file" class="form-control">
        </div>
        <div class="mb-2">
          <label>ou URL:</label>
          <input type="text" name="url_imagem" class="form-control" placeholder="https://...">
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Salvar</button>
        <a href="questoes.php" class="btn btn-secondary mt-3">Cancelar</a>
      </form>
    </div>
  </div>
</body>
</html>
