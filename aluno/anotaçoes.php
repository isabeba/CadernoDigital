<?php
session_start();
if (!isset($_SESSION['aluno'])) {
  header("Location: ../login.php");
  exit();
}

require __DIR__ . '/../tcc_db.php'; 

$apelido = $_SESSION['apelido'];
$id_aluno = $_SESSION['id'] ?? 0;

$dados = sql([
  'statement' => "SELECT texto FROM anotacoes WHERE id_aluno = ?",
  'types' => 'i',
  'parameters' => [$id_aluno],
  'only_first_row' => true
]);

$anotacao = $dados['texto'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $texto = $_POST['texto'] ?? '';
  $existe = sql([
    'statement' => "SELECT id FROM anotacoes WHERE id_aluno = ?",
    'types' => 'i',
    'parameters' => [$id_aluno],
    'only_first_row' => true
  ]);

  if ($existe) {
    sql([
      'statement' => "UPDATE anotacoes SET texto = ? WHERE id_aluno = ?",
      'types' => 'si',
      'parameters' => [$texto, $id_aluno]
    ]);
  } else {
    sql([
      'statement' => "INSERT INTO anotacoes (id_aluno, texto) VALUES (?, ?)",
      'types' => 'is',
      'parameters' => [$id_aluno, $texto]
    ]);
  }

  $anotacao = $texto;
  $msg = "Anotação salva com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Minhas Anotações</title>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@300;400;700&family=Patrick+Hand&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{
      font-family: 'Nunito';
    }
    .caderno {
      position: relative;
      width: 90%;
      max-width: 700px;
      margin: 60px auto;
      background: #e2a0fed4;
      border-radius: 15px;
      padding: 30px 50px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      
      
    }
 
    .espiral {
  position: absolute;
  left: -25px;
  top: 10px;
  bottom: 10px;
  width: 38px;
  background: repeating-linear-gradient(
    180deg,
    transparent 0 15px,
    #6b05b4 15px 20px
  );
  border-left: 3px solid #6b05b4;
  border-radius: 10px;
  box-shadow: 2px 0 5px rgba(81, 81, 81, 0.07);
}

.espiral::before {
  content: "";
  position: absolute;
  left: 3px;
  top: 0;
  bottom: 0;
  width: 5px;
  background: linear-gradient(
    to right,
    rgba(255, 255, 255, 0.31),
    rgba(255, 255, 255, 0.1)
  );
  border-radius: 10px;
}
    textarea {
      width: 100%;
      height: 300px;
      border: color #000;
      background: repeating-linear-gradient(
        #e2a0fec4,
        #e2a0fec4 28px,
        #00000042 29px
      );
      resize: none;
      font-family: 'Courier New', monospace;
      font-size: 1rem;
      line-height: 30px;
      color: #333;
      outline: none;
      border-radius: 8px;
      padding: 15px;
      box-shadow: inset 0 0 5px rgba(0,0,0,0.1);
    }
    button {
      margin-top: 20px;
      background: #8f63c9;
      border: none;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: #7335c3;
    }

    .voltar {
     margin-top: 20px;
      background: #8f63c9;
      border: none;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }

    .voltar:hover {
      background: #7335c3;
    }
header {
    background: #8f63c9;
    color: #ffffffff;
    padding: 20px 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  }
   h2 {
    margin: 0;
    font-size: 3rem;
    text-align: center;
  }
  </style>
</head>
<body>
  <header>
     <h2>Bloco de Notas</h2>
  </header>

  <section class="anotacoes my-5 text-center">
  <h1>Quer anotar alguma coisa? É só escrever aqui embaixo!  </h1>
  

  <?php if (!empty($msg)): ?>
  <div class="alert alert-success w-75 mx-auto"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

 <section class="caderno">
  <div class="espiral">
    <?php for ($i = 0; $i < 12; $i++): ?>
      <span></span>
    <?php endfor; ?>
  </div>

  <form method="post">
    <textarea name="texto" placeholder="Escreva suas anotações aqui..."><?= htmlspecialchars($anotacao ?? '') ?></textarea>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
   <button type="submit">Salvar</button>
</div>
   
  </form>
</section>
  <a href="pagina_inicial.php" class="voltar"> Voltar</a>

  <div id="pet-fixo" style="display:none; position:fixed; top:10px; right:10px; width:150px; height:150px; z-index:1000;">
  <img id="pet-img" src="" alt="Pet" style="width:100%; height:100%; object-fit:cover;">
  <h6 id="pet-nome" style="text-align:center;"></h6>
</div>
<script src="../aluno/pet_fixo.js"></script>

</body>
</html>
