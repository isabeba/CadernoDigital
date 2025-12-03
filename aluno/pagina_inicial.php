<?php
session_start();
if (!isset($_SESSION['aluno'])) {
  header("Location: ../login.php");
  exit();
}

$apelido = $_SESSION['apelido'];
$id_aluno = $_SESSION['id'] ?? null;

require __DIR__ . '/../tcc_db.php';             
require __DIR__ . '/../tcc_quiz/quiz_app/db.php';  


$ultimoTesteQuery = "SELECT * FROM resultados WHERE id_aluno = ? ORDER BY data_hora DESC LIMIT 1";
$stmt = $conn->prepare($ultimoTesteQuery);
$stmt->bind_param("i", $id_aluno);
$stmt->execute();
$result = $stmt->get_result();
$ultimoTeste = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@300;400;700&family=Patrick+Hand&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="sweetalert2.min.css">
  <link rel="stylesheet" href="style.css">
  <link class="favicon" rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">

  <style>
html, body {
  height: 100%;
  margin: 0;
}
body {
  display: flex;
  flex-direction: column;
  font-family: 'Nunito';
}
main {
  flex: 1;
}
.navbar{
    border-bottom: 2px solid #8e44ad;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}
.navbar-brand {
  font-family: 'Fredoka One', cursive;
  font-size: 24px;
  letter-spacing: 1px;
}
footer.rodape {
  position: relative;
  bottom: auto;
  left: 0;
  width: 100%;
  height: auto;
  background-color: #fff;
  border-top: 2px solid #8e44ad;
  padding: 10px 20px;
  display: flex;
  align-items: flex-start;
  justify-content: center;
  z-index: 60;
  color: #757575ff;
  font-weight: 600;
  font-family: 'Patrick Hand', cursive;
  box-sizing: border-box;
}
.rodape-container {
  max-width: var(--max-w);
  width: 100%;
  margin: 0 auto;
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 12px;
  padding: 0 12px;
}
.rodape .logo {
  font-size: 18px;
  color: #222;
  line-height: 1;
}
.colunas {
  display: flex;
  gap: 16px;
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
  margin-bottom: 5px;
  font-weight: 800;
}
.coluna ul {
  list-style: none;
  padding: 0;
  margin: 0;
  font-weight: 700;
  color: #444;
}
.coluna li {
  margin-bottom: 4px;
  font-size: 12px;
}
h2 {
  text-align: center;
  color: #000000ff;
  font-weight: 600;
  margin-bottom: 25px;
}
.card-desempenho {
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  text-align: center;
}
.card-desempenho:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}
.card-desempenho .card-header {
  font-weight: bold;
  font-size: 1.1rem;
}
.card-desempenho .card-body h5 {
  font-size: 1.5rem;
  margin: 0;
  text-align: center;
}
.tema h2 {
  text-align: center;
  color: #8d44addb;
  margin-bottom: 20px;
  font-weight: bold;
}
.grid-canais {
  overflow: visible;
  display: flex;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
}
.grid-canais a {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  border-radius: 12px;
  width: 250px;
  overflow: hidden;
  text-decoration: none;
  transition: transform 0.3s ease;
}
.grid-canais a:hover {
  transform: scale(1.05);
}
.grid-canais img {
  width: 100%;
  height: 160px;
  object-fit: cover;
  border-radius: 12px;
  transition: transform 0.3s ease;
}
.grid-canais a:hover img {
  transform: scale(1.08);
}
.grid-canais span {
  background: rgba(0, 0, 0, 0.25);
  color: white;
  width: 100%;
  text-align: center;
  padding: 8px;
  font-weight: 600;
  font-size: 14px;
  border-bottom-left-radius: 12px;
  border-bottom-right-radius: 12px;
  position: absolute;
  bottom: 0;
  left: 0;
}
.row-cols-md-4 {
  justify-content: center !important;
}
.row-cols-md-4 > .col {
  flex: 0 0 auto;
}
.atalhos .card {
  border-radius: 15px;
  transition: transform 0.2s, box-shadow 0.2s;
}
.atalhos .card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}
.card-link {
  text-decoration: none;
  color: inherit;
}


</style>

</head>

<body>
  
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="./pagina_inicial.php">
        <img class="logo" src="../logo Caderno Digital.png" alt="Logo" width="60" height="50" class="d-inline-block align-text-top">
        Caderno Digital</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="area_pet.php">Pet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="agenda.php">Agenda</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Para treinar
            </a>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../tcc_quiz/quiz_app/index.php">Questões</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="desempenho.php">Meu desempenho</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="anotaçoes.php">Anotações</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="orientacoes.php">Orientações</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../logout.php">Sair</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <br>
  <main>
  <h1 style="text-align: center;">Seja bem-vindo(a), <?php echo htmlspecialchars($apelido); ?>! <br>
   Bons estudos.</h1>
  <br>

  <h4 id="frase-pet">Escolha um pet para ser seu companheiro nessa jornada de estudos.</h4>

  <div id="cards-pets" class="row row-cols-4 ">
    <div class="col d-flex justify-content-center">
      <div class="card" style="width: 15rem; margin: 2px;">
        <img src="../imagens/Genet.png" class="card-img-top" alt="..." style="width: 100%; height: 240px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title">Genet</h5>
          <p class="card-text">Ela é doce, tranquila e sempre pronta para te dar aquela companhia silenciosa e acolhedora. Com a Genet do seu lado, até as tarefas mais difíceis ficam mais leves e o ambiente ganha um toque de aconchego!</p>
          <a href="#" class="btn btn-dark">Quero a Genet!</a>
        </div>
      </div>
    </div>

    <div class="col d-flex justify-content-center">
      <div class="card" style="width: 15rem; margin: 2px;">
        <img src="../imagens/Lobo.png" class="card-img-top" alt="..." style="width: 100%; height: 240px; object-fit: cover; object-position: 80% center;">
        <div class="card-body">
          <h5 class="card-title">Nata</h5>
          <p class="card-text">Inteligente, curiosa e cheia de charme, a Nata é a parceira perfeita para te acompanhar nos estudos. Com seu jeitinho alegre e determinado, ela traz uma dose extra de fofura e motivação para o seu dia!</p>
          <a href="#" class="btn btn-dark">Quero a Nata!</a>
        </div>
      </div>
    </div>

    <div class="col d-flex justify-content-center">
      <div class="card" style="width: 15rem; margin: 2px;">
        <img src="../imagens/Rato.png" class="card-img-top" alt="..." style="width: 100%; height: 240px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title">Morfeu</h5>
          <p class="card-text">Astuto, tranquilo e com um olhar que parece entender tudo, o Morfeu é o seu companheiro ideal para momentos de concentração e criatividade. Sempre por perto, ele transforma qualquer tarefa em uma missão mais leve!</p>
          <a href="#" class="btn btn-dark">Quero o Morfeu!</a>
        </div>
      </div>
    </div>

    <div class="col d-flex justify-content-center">
      <div class="card" style="width: 15rem; margin: 2px;">
        <img src="../imagens/panda.png" class="card-img-top" alt="..." style="width: 100%; height: 240px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title">Timãozinho</h5>
          <p class="card-text">Um panda tão fofinho quanto o amor da Fiel pelo Corinthians! Calminho e companheiro, ele vai estar sempre ao seu lado para deixar os estudos mais divertidos e cheios de energia!</p>
          <a href="#" class="btn btn-dark">Quero o Timãozinho</a>
        </div>
      </div>
    </div>
  </div>


  <div id="pet-fixo" style="display:none; position:fixed; top:10px; right:10px; width:150px; height:150px; z-index:1000;">
  <img id="pet-img" src="" alt="Pet" style="width:100%; height:100%; object-fit:cover;">
  <h6 id="pet-nome" style="text-align:center;"></h6>
</div>


  <?php if ($ultimoTeste): ?>
<h2>Desempenho do seu último teste</h2>
<div class="container">


<div class="row row-cols-1 row-cols-md-4 g-4 mb-4">
  <div class="col">
    <div class="card text-white mb-3 card-desempenho" style="background-color: #9538bcc2;">
      <div class="card-header">Acertos</div>
      <div class="card-body"><h5 class="card-title"><?= $ultimoTeste['acertos'] ?></h5></div>
    </div>
  </div>
  <div class="col">
    <div class="card text-white mb-3 card-desempenho" style="background-color: #9538bcc2;">
      <div class="card-header">Erros</div>
      <div class="card-body"><h5 class="card-title"><?= $ultimoTeste['erros'] ?></h5></div>
    </div>
  </div>
  <div class="col">
    <div class="card text-white mb-3 card-desempenho" style="background-color: #9538bcc2;">
      <div class="card-header">Tempo (s)</div>
      <div class="card-body"><h5 class="card-title"><?= $ultimoTeste['tempo_total_segundos'] ?></h5></div>
    </div>
  </div>
</div>
</div>
<?php endif; ?>
<br>
<br>

<section class="atalhos text-center my-5">
  <h2>📚 Escolha onde quer ir </h2>
  <div class="container mt-4">
    <div class="row justify-content-center g-4">

      <div class="col-6 col-md-3">
        <a href="area_pet.php" class="card-link">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"><strong>Área pet</strong></h5>
              <p class="card-text">Cuide e acompanhe seu Pet virtual.</p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-6 col-md-3">
        <a href="agenda.php" class="card-link">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"><strong>Minha agenda</strong></h5>
              <p class="card-text">Organize seus compromissos e tarefas.</p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-6 col-md-3">
        <a href="../tcc_quiz/quiz_app/index.php" class="card-link">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"><strong>Teste</strong></h5>
              <p class="card-text">Resolva questões e evolua a cada tentativa.</p>
            </div>
          </div>
        </a>
      </div>

       <div class="col-6 col-md-3">
        <a href="desempenho.php" class="card-link">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"><strong>Meu desempenho</strong></h5>
              <p class="card-text">Veja como está seu desempenho nos testes.</p>
            </div>
          </div>
        </a>
      </div>  

      <div class="col-6 col-md-3">
        <a href="anotaçoes.php" class="card-link">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"> <strong>Minhas anotações</strong></h5>
              <p class="card-text">Anote duvidas, lembretes ou o que vier à mente.
            </div>
          </div>
        </a>
      </div>   

      <div class="col-6 col-md-3">
        <a href="orientacoes.php" class="card-link">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"><strong>Orientações</strong></h5>
              <p class="card-text">Encontre aqui orientações sobre vestibulares.</p>
            </div>
          </div>
        </a>
      </div>
      

    </div>
  </div>
</section>

<h2> Quer aprender mais? Confira esses canais!</h2>
<section class="tema mt-5">
  <h2>📐Exatas</h2>
  <div class="grid-canais" >
    <a target="_blank" href="https://www.youtube.com/@Giscomgiz"><img src="/CadernoDigital-main/imagens/miniaturas/matematica.png"><span> Gis com Giz (Matematica)</span></a>
    <a target="_blank" href="https://www.youtube.com/@professorboaro"><img src="/CadernoDigital-main/imagens/miniaturas/fisica.jpg"><span>Professor Boaro (Física)</span></a>
    <a target="_blank"href="https://www.youtube.com/@paulovalim"><img src="/CadernoDigital-main/imagens/miniaturas/quimica.jpg"><span>Química em Ação (Química)</span></a>
  </div>
</section>

<section class="tema mt-5">
  <h2>📖Linguagens</h2>
  <div class="grid-canais">
    <a target="_blank" href="https://www.youtube.com/@ProfessorNoslen"><img src="/CadernoDigital-main/imagens/miniaturas/portugues.jpg"><span> Professor Noslen (Língua Portuguesa)</span></a>
    <a target="_blank" href="https://www.youtube.com/playlist?list=PLPwuAOl5BHi8UTmce6l7kWwDVj2oMYPv2"><img src="/CadernoDigital-main/imagens/miniaturas/redaçao.jpg"><span> Professora Pamba (Redação)</span></a>
    <a target="_blank"href="https://www.youtube.com/@eslwinner"><img src="/CadernoDigital-main/imagens/miniaturas/lingua_estrangeira.jpg"><span> Inglês Winner (Língua Estrangeira)</span></a>
  </div>
</section>

<section class="tema mt-5">
  <h2>🏛️ Humanas</h2>
  <div class="grid-canais">
    <a target="_blank" href="https://www.youtube.com/@deboraaladim"><img src="/CadernoDigital-main/imagens/miniaturas/historia.jpg"><span>Débora Aladim (História)</span></a>
    <a target="_blank" href="https://www.youtube.com/@obrigahistoria"><img src="/CadernoDigital-main/imagens/miniaturas/sociologia.jpg"><span>Leitura ObrigaHISTÓRIA (Sociologia)</span></a>
    <a target="_blank" href="https://www.youtube.com/@profricardomarcilio"><img src="/CadernoDigital-main/imagens/miniaturas/geografia.jpg"><span> Interativa (Geografia)</span></a>
  </div>
</section>

<section class="tema mt-5">
  <h2>🔬Biológicas</h2>
  <div class="grid-canais">
    <a target="_blank" href="https://www.youtube.com/@paulojubilut"><img src="/CadernoDigital-main/imagens/miniaturas/biologia.jpg"><span>Paulo Jubilut (Biologia)</span></a>
    <a target="_blank" href="https://www.youtube.com/@nossaecologia9252"><img src="/CadernoDigital-main/imagens/miniaturas/ecologia.jpg"><span>Nossa Ecologia  (Ecologia)</span></a>
    <a target="_blank" href="https://www.youtube.com/@AnatomiaFacilOficial"><img src="/CadernoDigital-main/imagens/miniaturas/anatomia.jpg"><span>Anatomia Fácil com Rogério Gozzi (Anatomia)</span></a>
  </div>
</section>

</main>

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




  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>

const botoes = document.querySelectorAll('.btn.btn-dark');


function mostrarPetFixo(nome, imagem) {
  const petFixo = document.getElementById('pet-fixo');
  document.getElementById('pet-nome').textContent = nome;
  document.getElementById('pet-img').src = imagem;
  petFixo.style.display = 'block';
}


function animarImagemParaCanto(cardEscolhido, nomePet, imagem) {
   const img = cardEscolhido.querySelector('.card-img-top');
  const rect = cardEscolhido.getBoundingClientRect();
  const cloneImg = img.cloneNode(true);
  cloneImg.style.position = 'fixed';
  cloneImg.style.top = rect.top + 'px';
  cloneImg.style.left = rect.left + 'px';
  cloneImg.style.width = rect.width + 'px';
  cloneImg.style.height = rect.height + 'px';
  cloneImg.style.objectFit = 'cover';
  cloneImg.style.zIndex = 1000;
  cloneImg.style.transition = 'all 0.8s ease-in-out';
  document.body.appendChild(cloneImg);
  const containerPets = document.getElementById('cards-pets');
if (containerPets) containerPets.style.display = 'none';
  
  const frasePet = document.getElementById('frase-pet');
if (frasePet) {
  frasePet.style.display = 'none';
}

  setTimeout(() => {
    cloneImg.style.top = '10px';
    cloneImg.style.left = (window.innerWidth - 160) + 'px';
    cloneImg.style.width = '150px';
    cloneImg.style.height = '150px';
  }, 50);

  setTimeout(() => {
    cloneImg.remove();
    mostrarPetFixo(nomePet, imagem);
  }, 900);
}


botoes.forEach(botao => {
  botao.addEventListener('click', async (e) => {
    e.preventDefault();

    const cardEscolhido = e.target.closest('.card');
    const nomePet = cardEscolhido.querySelector('.card-title').textContent;
    const imagem = cardEscolhido.querySelector('.card-img-top').src;

  
    try {
      const resposta = await fetch('salvar_pet.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ pet: nomePet })
      });
      const dados = await resposta.json();

      if (dados.sucesso) {
        Swal.fire({
          title: "Pet escolhido!",
          text: `Você escolheu ${nomePet} como seu companheiro!`,
          imageUrl: imagem,
          imageWidth: 400,
          imageHeight: 400,
          imageAlt: "Imagem do pet"
        });

        animarImagemParaCanto(cardEscolhido, nomePet, imagem);

      } else {
        Swal.fire({
          icon: "error",
          title: "Erro",
          text: "Erro ao salvar no servidor!"
        });
      }
    } catch (erro) {
      console.error('Erro:', erro);
      alert('Não foi possível salvar no servidor.');
    }
  });
});

window.addEventListener('DOMContentLoaded', async () => {
  try {
    const resposta = await fetch('obter_pet.php');
    const dados = await resposta.json();
    const petSalvo = dados.pet; 

    if (petSalvo) {
      const cardEscolhido = Array.from(document.querySelectorAll('.card')).find(card =>
        card.querySelector('.card-title').textContent === petSalvo
      );

      if (cardEscolhido) {
        const imagem = cardEscolhido.querySelector('.card-img-top').src;
        animarImagemParaCanto(cardEscolhido, petSalvo, imagem);
      }
    }
  } catch (erro) {
    console.error('Erro ao buscar pet do servidor:', erro);
  }
});
</script>



</body>
</html>