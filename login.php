<?php
session_start();

if (isset($_SESSION['aluno'])) {
  header("Location: /aluno/pagina_inicial.php");
  exit();
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Caderno Digital</title>

  <!-- Fontes: Fredoka (título), Nunito (corpo) e Patrick Hand (rodapé)  -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@300;400;700&family=Patrick+Hand&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    :root{
      --lilac: #8f63c9;
      --lilac-dark: #7c4fb3;
      --white: #ffffff;
      --header-h: 90px;
      --footer-h: 120px;
      --section-h: calc(100vh - var(--header-h) - var(--footer-h));
      --card-w: 320px;
      --max-w: 1100px;
    }

    *{box-sizing:border-box}
    html,body{height:100%; margin:0; font-family: 'Nunito', sans-serif; color:#222;}

    header{
      position: fixed;
      top: 0;
      left: 0;
      width:100%;
      height: var(--header-h);
      background: var(--white);
      display:flex;
      align-items:center;
      justify-content:center;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
      z-index: 60;
    }

    header .inner {
      width: 100%;
      max-width: var(--max-w);
      display:flex;
      align-items:center;
      justify-content:center;
      gap: 18px;
      padding: 0 18px;
    }

    header img.logo{
      width: 68px;
      height: 68px;
      object-fit: contain;
    }

    header .title-wrap{
      text-align:center;
    }

    header h1{
      margin:0;
      font-family: 'Fredoka One', cursive;
      font-size: 28px;
      color: #222;
      letter-spacing: 1px;
    }

    header p.slogan{
      margin:4px 0 0;
      font-size: 13px;
      color: #777;
    }

    footer.rodape{
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      height: var(--footer-h);
      background-color: #fff;
      border-top: 2px solid #8e44ad;
      padding: 20px;
      display:flex;
      align-items:center;
      justify-content:center;
      z-index: 60;
      color: #666;
      font-weight:600;
      font-family: 'Patrick Hand', cursive;
    }

    .rodape-container {
      max-width: var(--max-w);
      width: 100%;
      margin: 0 auto;
      display: flex;
      align-items:flex-start;
      justify-content: space-between;
      gap: 24px;
      padding: 0 18px;
    }

    .rodape .logo {
      font-size: 22px;
      color: #222;
      line-height: 1;
    }

    .colunas {
      display: flex;
      gap: 36px;
      align-items: flex-start;
    }

    .coluna {
      text-align: left;
      font-family: 'Nunito', sans-serif;
      font-weight: 700;
      color: #222;
    }

    .coluna strong {
      display: block;
      margin-bottom: 8px;
      font-weight: 800;
    }

    .coluna ul {
      list-style: none;
      padding: 0;
      margin: 0;
      font-weight: 600;
      color: #444;
    }

    .coluna li {
      margin-bottom: 6px;
      font-size: 14px;
    }

    main{
      margin-top: var(--header-h);
      margin-bottom: var(--footer-h);
      min-height: calc(100vh - var(--header-h) - var(--footer-h));
    }

    .section {
      min-height: var(--section-h);
      display:flex;
      align-items:center;
      justify-content:center;
      width:100%;
    }

    .hero {
      background: linear-gradient(180deg, var(--lilac) 0%, var(--lilac-dark) 100%);
      color: white;
      position: relative;
      overflow: hidden;
    }

    .login-card {
      width: var(--card-w);
      background: var(--white);
      color: #222;
      padding: 18px;
      border-radius: 12px;
      box-shadow: 0 12px 30px rgba(0,0,0,0.12);
      text-align: center;
      transform: translateY(-10%);
    }

    .login-card h2 {
      margin: 0 0 10px;
      font-size: 16px;
      font-weight: 700;
      text-align: left;
    }

    .login-card .inputs {
      display:flex;
      flex-direction:column;
      gap:8px;
      margin-bottom: 12px;
    }

    .login-card input[type="email"],
    .login-card input[type="text"],
    .login-card input[type="password"]{
      padding:8px 10px;
      border-radius:6px;
      border:1px solid #ddd;
      font-size: 14px;
    }

    .login-card input::placeholder {
      color: #888;
      opacity: 1;
      font-size: 14px;
    }

    .login-card .btn {
      width:100%;
      padding:10px;
      border-radius:8px;
      border: none;
      font-weight:700;
      cursor: pointer;
    }

    .login-card .btn-outline {
      background: transparent;
      border: 2px solid var(--lilac);
      color: var(--lilac);
    }

    .login-card .btn-primary {
      background: var(--lilac);
      color: var(--white);
      margin-top:6px;
    }

    .login-card .btn:hover,
    .login-card .btn:focus {
      box-shadow: 0 2px 12px rgba(143, 99, 201, 0.18);
      transform: translateY(-2px) scale(1.03);
      transition: background 0.2s, color 0.2s, box-shadow 0.2s, transform 0.2s;
    }

    .login-card .btn-outline:hover,
    .login-card .btn-outline:focus {
      background: var(--lilac);
      color: var(--white);
      border-color: var(--lilac-dark);
    }

    .login-card .btn-primary:hover,
    .login-card .btn-primary:focus {
      background: var(--lilac-dark);
      color: var(--white);
    }

    .hero .divider {
      position: absolute;
      left: 6%;
      right: 6%;
      bottom: 26%;
      height: 1px;
      background: rgba(255,255,255,0.35);
    }

    /* ===== FEATURES / ESCADA ===== */
    .features-wrap {
      background: var(--lilac);
      padding: 40px 6%;
      width: 100%;
      box-sizing: border-box;
      display: flex;
      align-items: flex-start;
      justify-content: center;
    }

    .features {
      max-width: var(--max-w);
      width: 100%;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 36px 48px;
      align-items: start;
      color: white;
    }

    .feature-block h3 {
      margin: 0 0 10px;
      font-size: 18px;
      font-weight: 700;
      color: #fff;
      font-family: 'Nunito', sans-serif;
    }

    .feature-block p {
      margin: 0 0 26px;
      color: rgba(255,255,255,0.95);
      font-size: 14px;
      line-height: 1.5;
      max-width: 520px;
    }

    /* ESCADA alternada */
    .features .feature-block:nth-child(odd) {
      margin-top: 0;
    }
    .features .feature-block:nth-child(even) {
      margin-top: 30px;
    }

    @media (max-width:900px){
      .features { grid-template-columns: 1fr; text-align: left; }
      .login-card { transform: translateY(0); }
      .hero .divider{ bottom: 18%; left: 4%; right: 4%; }
      .rodape-container { flex-direction: column; align-items: center; gap: 12px; text-align: center; }
      .colunas { flex-direction: column; gap: 12px; }
    }

    @media (max-width:480px){
      header h1 { font-size: 20px; }
      .login-card{ width: 90%; padding: 14px; }
      .feature-block p { font-size: 13px; }
    }
  </style>
</head>
<body>
  <!-- HEADER -->
  <header>
    <div class="inner">
      <img class="logo" src="./logo Caderno Digital.png" alt="Logo">
      <div class="title-wrap">
        <h1>CADERNO DIGITAL</h1>
        <p class="slogan">O jeito grátis e eficaz de aprender!</p>
      </div>
    </div>
  </header>

  <!-- MAIN -->
  <main>
    <!-- LOGIN -->
    <section class="section hero" aria-label="Login">
      <div class="login-card" role="form" aria-labelledby="login-title" data-aos="fade-down"
     data-aos-easing="linear"
     data-aos-duration="1500">
        <h2 id="login-title">Login</h2>
        <form method="POST" action="auth.php" class="login-form" novalidate>
          <div class="inputs">
            <input
              id="email"
              name="email"
              type="email"
              placeholder="e-mail "
              required
              pattern=".+@.+"
              title="O e-mail precisa conter '@' (ex: usuario@exemplo.com)"
            />
            <input id="password" name="password" type="password" placeholder="Senha" required />
          </div>
          <button type="submit" class="btn btn-outline">ENTRAR</button>
        </form>
        <a href="./cadastrar.php">
            <button class="btn btn-primary">CRIAR CONTA</button>
        </a>
      </div>
    </section>

    <!-- RECURSOS / FEATURES -->
    <section class="section features-wrap" aria-label="Recursos">
      <div class="features" role="region" aria-label="Lista de recursos">
        <div class="feature-block"  data-aos="fade-right" data-aos-duration="3000">
          <h3>Simulados</h3>
          <p>Treine hoje, acerte na hora da prova. Simule, erre, aprenda, acerte.</p>
        </div>

        <div class="feature-block"  data-aos="fade-left" data-aos-duration="3000">
          <h3>Dias de Prova de Vestibulares</h3>
          <p>Fique por dentro das datas que importam. Calendário atualizado para você não perder nenhum dia.</p>
        </div>

        <div class="feature-block"  data-aos="fade-right" data-aos-duration="3000">
          <h3>Perguntas Práticas</h3>
          <p>Aprender na prática é fixar de verdade. Questões que te fazem pensar e aprender.</p>
        </div>

        <div class="feature-block"  data-aos="fade-left" data-aos-duration="3000">
          <h3>Recomendação de Canais</h3>
          <p>Os melhores vídeos, sem perder tempo procurando. Canais certos, conteúdo certeiro.</p>
        </div>

        <div class="feature-block"  data-aos="fade-right" data-aos-duration="3000">
          <h3>Agenda de Estudos Personalizada</h3>
          <p>Organize seu tempo, crie cronogramas e receba lembretes do que estudar.</p>
        </div>

        <div class="feature-block"  data-aos="fade-left" data-aos-duration="3000">
          <h3>Material e Resumos</h3>
          <p>Resumos e apostilas organizadas por tema e por nível de dificuldade para facilitar o estudo.</p>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="rodape">
    <div class="rodape-container">
      <div class="logo">
        CADERNO DIGITAL
      </div>
      <div class="colunas" aria-label="Links do rodapé">
        <div class="coluna">
          <strong>Termos e privacidade</strong>
          <ul>
            <li>Normas da comunidade</li>
            <li>Termos de uso</li>
            <li>Privacidade</li>
          </ul>
        </div>
        <div class="coluna">
          <strong>Ajuda e suporte</strong>
          <ul>
            <li>Dúvidas</li>
            <li>SAC</li>
            <li>Contate-nos</li>
          </ul>
        </div>
        <div class="coluna">
          <strong>Nos conheça!</strong>
          <ul>
            <li>Missão</li>
            <li>Método</li>
            <li>Equipe envolvida</li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>

  
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
    
    new window.VLibras.Widget('https://vlibras.gov.br/app');


    const form = document.querySelector('.login-form');
    const email = document.getElementById('email');

    email.addEventListener('input', () => email.setCustomValidity(''));

    form.addEventListener('submit', (e) => {
      if (!email.checkValidity()) {
        email.setCustomValidity('Por favor, informe um e-mail válido contendo "@"');
        e.preventDefault();
        email.reportValidity();
        return;
      }
    });


  </script>
</body>
</html>


