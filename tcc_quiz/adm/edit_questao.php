<?php
include "db.php";

$id = $_GET['id'];
$questao = $conn->query("SELECT * FROM questoes WHERE id_questao = $id")->fetch_assoc();
$alternativas = $conn->query("SELECT * FROM alternativas WHERE id_questao = $id");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enunciado = $_POST['enunciado'];
    $altTextos = $_POST['alternativas'];
    $correta = $_POST['correta'];
    $imagem = $questao['imagem']; // mantém a imagem atual por padrão

    if (!empty($_POST['url_imagem'])) {
        $imagem = $_POST['url_imagem'];
    } elseif (isset($_FILES['imagem_file']) && $_FILES['imagem_file']['error'] == 0) {
        $extensao = pathinfo($_FILES['imagem_file']['name'], PATHINFO_EXTENSION);
        $nome_imagem = "imagem_" . time() . "." . $extensao;
        $caminho_imagem = "imagens/" . $nome_imagem;

        if (!is_dir("imagens")) {
            mkdir("imagens", 0777, true);
        }

        if (move_uploaded_file($_FILES['imagem_file']['tmp_name'], $caminho_imagem)) {
            $imagem = $caminho_imagem;
        }
    }

    // Atualiza a questão
    $stmt = $conn->prepare("UPDATE questoes SET enunciado=?, imagem=? WHERE id_questao=?");
    $stmt->bind_param("ssi", $enunciado, $imagem, $id);
    $stmt->execute();

    // Atualiza alternativas
    foreach ($altTextos as $i => $alt) {
        $id_alt = $_POST['id_alt'][$i];
        $corretaFlag = ($correta == $i) ? 1 : 0;

        $stmtAlt = $conn->prepare("UPDATE alternativas SET texto=?, correta=? WHERE id_alternativa=?");
        $stmtAlt->bind_param("sii", $alt, $corretaFlag, $id_alt);
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
  <title>Editar Questão</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-lg p-5">
      <h2>✏ Editar Questão</h2>
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Enunciado</label>
          <textarea name="enunciado" class="form-control" required><?php echo $questao['enunciado']; ?></textarea>
        </div>
        <h5>Alternativas</h5>
        <?php $i=0; while($alt = $alternativas->fetch_assoc()) { ?>
          <div class="input-group mb-2">
            <div class="input-group-text">
              <input type="radio" name="correta" value="<?php echo $i; ?>" <?php echo $alt['correta'] ? "checked" : ""; ?>>
            </div>
            <input type="hidden" name="id_alt[]" value="<?php echo $alt['id_alternativa']; ?>">
            <input type="text" name="alternativas[]" class="form-control" value="<?php echo $alt['texto']; ?>" required>
          </div>
        <?php $i++; } ?>

        <h5 class="mt-3">Imagem da Questão</h5>
        <?php if (!empty($questao['imagem'])): ?>
            <p>Imagem atual:</p>
            <img src="<?php echo $questao['imagem']; ?>" alt="Imagem da questão" style="max-width: 200px;" class="mb-2">
        <?php endif; ?>

        <div class="mb-2">
          <label>Upload:</label>
          <input type="file" name="imagem_file" class="form-control">
        </div>
        <div class="mb-2">
          <label>ou URL:</label>
          <input type="text" name="url_imagem" class="form-control" placeholder="https://...">
        </div>

        <button type="submit" class="btn btn-success mt-3">Salvar Alterações</button>
        <a href="questoes.php" class="btn btn-secondary mt-3">Cancelar</a>
      </form>
    </div>
  </div>
</body>
</html>
