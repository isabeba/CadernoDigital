<?php
session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <link rel="stylesheet" href="estilo.css">
  <link class="favicon" rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">

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
      margin: 5px 0 20px 0;
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

    /* CARD FORMULÁRIO */
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

    .termos {
      margin-top: 15px;
      font-size: 13px;
      color: #333;
      text-align: center;
    }

    /* -------- CAMPO DE SENHA MELHORADO ------- */
    .campo-senha {
      position: relative;
    }

    .campo-senha input {
      width: 100%;
      padding: 10px 45px 10px 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .btn-eye {
      position: absolute;
      right: 3px;
      top: 35%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      padding: 5px;
      display: flex;
      align-items: center;
    }

    .btn-eye svg {
      transition: opacity 0.2s ease-in-out;
      opacity: 0.7;
    }

    .btn-eye:hover svg {
      opacity: 1;
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

          <div class="campo-senha">
            <input type="password" name="senha" id="senha" required>

            <button type="button" id="toggleSenha" class="btn-eye" aria-label="Mostrar senha">
              <svg id="iconEye" xmlns="http://www.w3.org/2000/svg" 
                   width="18" height="18" viewBox="0 0 24 24" fill="none">
                <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" 
                      stroke="#000000ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="12" cy="12" r="3" stroke="#000000ff" stroke-width="2"/>
              </svg>
            </button>
          </div>

          <input class="btn" type="submit" value="Salvar">
        </form>

        <p class="termos">
          Ao entrar no <strong>Caderno Digital</strong>, você concorda com os nossos Termos e Política de Privacidade.<br>
          Este site é protegido pelo reCAPTCHA Enterprise. Aplicam-se a Política de Privacidade e os Termos de Uso do Google.
        </p>

      </div>
    </div>
  </div>

  <!-- SCRIPT MELHORADO DE MOSTRAR/ESCONDER SENHA -->
  <script>
    const campo = document.getElementById('senha');
    const botao = document.getElementById('toggleSenha');

    const olhoAberto = `
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
         viewBox="0 0 24 24" fill="none">
      <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z"
            stroke="#000000ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      <circle cx="12" cy="12" r="3" stroke="#000000ff" stroke-width="2"/>
    </svg>`;

    const olhoFechado = `
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
         viewBox="0 0 24 24" fill="none">
      <path d="M17.94 17.94C16.19 19.22 14.17 20 12 20C5 20 1 12 1 12C2.14 9.87 4.19 7.37 
               6.76 5.82M12 4C19 4 23 12 23 12C22.37 13.16 21.58 14.25 20.66 15.21M1 1 
               L23 23"
            stroke="#000000ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>`;

    botao.addEventListener("click", () => {
      if (campo.type === "password") {
        campo.type = "text";
        botao.innerHTML = olhoFechado;
      } else {
        campo.type = "password";
        botao.innerHTML = olhoAberto;
      }
    });
  </script>

</body>
</html>
