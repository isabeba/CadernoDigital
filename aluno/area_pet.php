<?php
session_start();
if (!isset($_SESSION['aluno'])) {
  header("Location: ../login.php");
  exit();
}

require __DIR__ . '/../tcc_db.php';  

$apelido = $_SESSION['apelido'];
$id_aluno = $_SESSION['id'] ?? 0;

if (!$id_aluno) {
  header("Location: login.php");
  exit;
}

$aluno = sql([
    'statement' => "SELECT nome, apelido, pet_escolhido FROM alunos WHERE id = ?",
    'types' => 'i',
    'parameters' => [$id_aluno],
    'only_first_row' => true
]);

if (!$aluno || empty($aluno['pet_escolhido'])) {
    header("Location: pagina_inicial.php");
    exit;
}

$pet = $aluno['pet_escolhido'];
$caminho = "/CadernoDigital-main/imagens/pets/" . $pet . "/";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<link class="favicon" rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@300;400;700&family=Patrick+Hand&display=swap" rel="stylesheet">
<title>Área do Pet</title>
<style>
  :root {
    --roxo-principal: #8f63c9;
    --roxo-claro: #bfa3e6;
    --roxo-escuro: #6c45a1;
    --branco: #ffffff;
    --cinza-fundo: #f4f2f8;
  }

  body {
   font-family: 'Nunito';
    text-align: center;
    background: var(--cinza-fundo);
    margin: 0;
    padding: 0;
  }

  header {
    background: var(--roxo-principal);
    color: var(--branco);
    padding: 20px 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  }

  h1 {
    margin: 0;
    font-size: 2rem;
  }

  h2 {
    color: var(--roxo-escuro);
    margin-top: 15px;
  }

  #container {
    max-width: 600px;
    margin: 40px auto;
    background: var(--branco);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
  }

  #pet {
    width: 350px;
    height: 350px;
    background-image: url("<?php echo $caminho; ?>parado.png");
    background-size: cover;
    background-position: center;
    margin: 20px auto;
    border-radius: 20px;
    border: 4px solid var(--roxo-claro);
    transition: transform 0.3s ease;
  }

  #pet:hover {
    transform: scale(1.05);
  }

  .acoes {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 20px;
  }

  button {
    padding: 12px 24px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    background-color: var(--roxo-principal);
    color: var(--branco);
    font-weight: bold;
    letter-spacing: 0.5px;
    transition: background 0.3s, transform 0.2s;
  }

  button:hover {
    background-color: var(--roxo-escuro);
    transform: translateY(-2px);
  }

  .sair {
    display: inline-block;
    margin-top: 30px;
    padding: 10px 20px;
    border-radius: 12px;
    background-color: var(--roxo-claro);
    color: var(--branco);
    text-decoration: none;
    font-weight: 500;
    transition: 0.3s;
  }

  .sair:hover {
    background-color: var(--roxo-principal);
    text-decoration: none;
  }

  footer {
    margin-top: 40px;
    color: #777;
    font-size: 0.9rem;
  }
</style>
</head>
<body>

  <header>
    <h1>Olá, <?php echo htmlspecialchars($apelido); ?>! 🐾</h1>
  </header>

  <div id="container">
    <h2>Seu pet: <?php echo ucfirst($pet); ?></h2>
    <div id="pet"></div>

    <div class="acoes">
      <button onclick="acao('comendo')">🍖 Comer</button>
      <button onclick="acao('dormindo')">💤 Dormir</button>
      <button onclick="acao('feliz')">😺 Feliz</button>
    </div>

    <a href="/CadernoDigital-main/aluno/pagina_inicial.php" class="sair">⟵ Voltar</a>
  </div>

  <footer>
    <p>© 2025 Caderno Digital | Seu pet virtual</p>
  </footer>

  <script>
    const caminho = "<?php echo $caminho; ?>";

    function acao(tipo) {
      const pet = document.getElementById("pet");
      pet.style.backgroundImage = `url('${caminho}${tipo}.gif?${new Date().getTime()}')`;
      setTimeout(() => {
        pet.style.backgroundImage = `url('${caminho}parado.png?${new Date().getTime()}')`;
      }, 6000);
    }
  </script>

</body>
</html>
