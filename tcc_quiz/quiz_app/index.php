<?php 
include "db.php"; 
mysqli_set_charset($conn, "utf8mb4");

$_SESSION['inicio_quiz'] = microtime(true);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Quiz App</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">    <link class="favicon" rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
  <link class="favicon" rel="shortcut icon" href="../../imagens/favicon.ico" type="image/x-icon">

  <style>
    :root {
      --roxo-principal: #8f63c9;
      --roxo-claro: #bfa3e6;
      --roxo-escuro: #6c45a1;
      --branco: #ffffff;
      --cinza-fundo: #f4f2f8;
    }

    body {
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg, var(--roxo-principal), var(--roxo-escuro));
      color: #333;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin: 0;
    }

    .main-card {
      border-radius: 20px;
      padding: 60px 50px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      background: var(--branco);
      text-align: center;
      max-width: 700px;
      width: 90%;
      transition: transform 0.3s ease;
    }

    .main-card:hover {
      transform: scale(1.02);
    }

    h1 {
      color: #000;
      font-weight: 600;
      margin-bottom: 15px;
    }

    p.lead {
      color: #555;
      font-size: 1.1rem;
      margin-bottom: 30px;
    }

    .btn-quiz {
      display: inline-block;
      padding: 14px 28px;
      background-color: var(--roxo-principal);
      color: var(--branco);
      border-radius: 12px;
      font-weight: 600;
      text-decoration: none;
      transition: background 0.3s, transform 0.2s;
    }

    .btn-quiz:hover {
      background-color: var(--roxo-escuro);
      transform: translateY(-2px);
      color: var(--branco);
      text-decoration: none;
    }

    .sair {
      display: inline-block;
      margin-top: 30px;
      background-color: var(--roxo-claro);
      color: #000;
      padding: 10px 20px;
      border-radius: 12px;
      text-decoration: none;
      font-weight: 500;
      transition: background 0.3s, transform 0.2s;
    }

    .sair:hover {
      background-color: var(--roxo-principal);
      transform: translateY(-2px);
      text-decoration: none;
    }

    footer {
      margin-top: 40px;
      color: #eee;
      font-size: 0.9rem;
      text-align: center;
    }

    @media (max-width: 600px) {
      .main-card {
        padding: 35px 25px;
      }
      h1 {
        font-size: 1.6rem;
      }
      p.lead {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

  <div class="main-card">
    <h1> Hora de testar seus conhecimentos!</h1>
    <p class="lead">Prepare-se e boa sorte no desafio!</p>
    <a href="quiz.php?questao=1" class="btn-quiz">Iniciar Quiz</a>
  </div>

  <a href="/CadernoDigital-main/aluno/pagina_inicial.php" class="sair">⟵ Voltar</a>

  <footer>
    <p>© 2025 Caderno Digital | Quiz Interativo</p>
  </footer>

</body>
</html>
