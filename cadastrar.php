<?php
session_start();



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <link rel="stylesheet" href="estilo.css">
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: Arial, sans-serif;
    }

    .container0 {
      display: flex;
      height: 100vh;
    }

    /* LADO ESQUERDO */
    .left {
      flex: 1;
      background-color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 40px;
    }

    .left h1 {
      margin: 0;
      font-family: "Comic Sans MS", cursive, sans-serif;
      font-size: 32px;
      color: #000;
    }

    .left h3 {
      margin: 5px 0 20px 0; /* espaço entre título e subtítulo */
      font-size: 20px;
      color: #000;
      font-weight: normal;
    }

    .left img {
      max-width: 200px;
    }

    /* LADO DIREITO */
    .right {
      flex: 1;
      background-color: #cbabf4;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    /* CARD DO FORMULÁRIO */
    .container1 {
      width: 100%;
      max-width: 400px;
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .container1 h1 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 22px;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
      color: #333;
    }

    input[type="text"],
    input[type="date"],
    input[type="file"],
    input[type="password"],
    input[type="email"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-sizing: border-box;
    }

    input[type="submit"],
    .btn {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
      transition: background 0.3s;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    /* Texto de aviso abaixo */
    .termos {
      margin-top: 15px;
      font-size: 13px;
      color: #333;
      text-align: center;
    }
    .termos strong {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container0">


    <div class="left">
      <h1>CADERNO DIGITAL</h1>
      <h3>Venha aprender!</h3>
      <img src="imagens/logo_cd.png" alt="Logo">
    </div>

    <!-- DIREITA -->
    <div class="right">
      <div class="container1">
        <h1>Cadastrar Novo Usuário</h1>
        <form method="POST" action="salvar.php" enctype="multipart/form-data">

          <label for="nome">Nome:</label>
          <input type="text" name="nome" id="nome" required>

          <label for="apelido">Apelido:</label>
          <input type="text" name="apelido" id="apelido" required>

          <label for="data_nascimento">Data de nascimento:</label>
          <input type="date" name="data_nascimento" id="data_nascimento" required>

          <label for="email">E-mail:</label>
          <input type="email" name="email" id="email" required>

          <label for="senha">Senha:</label>
          <input type="password" name="senha" id="senha" required>

          <input class="btn" type="submit" value="Salvar">
        </form>

        <p class="termos">
          Ao entrar no <strong>Caderno Digital</strong>, você concorda com os nossos Termos e Política de Privacidade.<br>
          Este site é protegido pelo reCAPTCHA Enterprise. Aplicam-se a Política de Privacidade e os Termos de Uso do Google.
        </p>
      </div>
    </div>
  </div>
</body>
</html>
