<?php
session_start();
if (!isset($_SESSION['aluno'])) {
  header("Location: ../login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Orientações sobre Vestibulares</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@300;400;700&family=Patrick+Hand&display=swap" rel="stylesheet">
    <link class="favicon" rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Nunito';
      background-color: #c98fff95;
    }

    header {
      background: #8f63c9;
      color: #ffffffff;
      padding: 20px 0;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      text-align: center;
    }

    h2 {
        font-family: 'Fredoka One', cursive;
        color: #fffbfbff;
    }
    h1, h3 {
      font-family: 'Fredoka One';
      color: #6b05b4;
      text-align: center;
    }
    h5 {
       font-family: 'Nunito';
       color: #6f00bdff; 
    }

    .caderno {
  position: relative;
  width: 90%;
  max-width: 900px;
  margin: 50px auto;
  background: repeating-linear-gradient(
  to bottom,
  #fdfbff,
  #fdfbff 28px,
  rgba(0, 0, 0, 0.29) 30px,
  #00000032 30px
);
  border-radius: 15px;
  padding: 40px 50px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.21);
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

    section h3 {
      margin-top: 40px;
      font-size: 1.6rem;
    }

    p, li {
      font-size: 1.1rem;
      color: #333;
      line-height: 1.7;
    }

    ul {
      margin-left: 20px;
    }

    .voltar {
      display: inline-block;
      background: #8f63c9;
      color: #fff;
      padding: 10px 25px;
      border-radius: 8px;
      text-decoration: none;
      transition: 0.3s;
      margin: 30px auto;
      display: block;
      width: fit-content;
    }

    .voltar:hover {
      background: #7335c3;
    }

    .alerta-centro {
  max-width: 50%;                
  margin: 20px auto;              
  text-align: center;
  font-size: large;            
  padding: 15x 15px;

}
  </style>
</head>
<body>
  <header>
    <h2>Orientações sobre Vestibulares e Universidades</h2>
  </header>

  <main>
    <section class="caderno">
      <div class="espiral">
        <?php for ($i = 0; $i < 12; $i++): ?>
          <span></span>
        <?php endfor; ?>
      </div>

        <h3> Principais Datas de Vestibulares</h3>
    

      <p>
        <strong>• ENEM:</strong> Provas geralmente em novembro; inscrições entre maio e junho. <br>
        <strong>• Fuvest (USP):</strong> 1ª fase em novembro, 2ª fase em janeiro. <br>
        <strong>• Unicamp:</strong>  1ª fase em outubro, 2ª fase em dezembro. <br>
        <strong>• Unesp:</strong> 1ª fase em novembro, 2ª fase em dezembro. <br>
        <strong>• UEM, UFRGS, UFPR, etc.:</strong> Verifique os sites oficiais para cada estado/universidade. <br>

      </p>

      <h3> Como Funcionam SISU, PROUNI e FIES</h3>
      <br><br>
      <h5><strong>SISU (Sistema de Seleção Unificada)</strong></h5>
<p>
   é um sistema do Ministério da Educação (MEC) que utiliza as notas do 
  <strong>ENEM</strong> para selecionar alunos para universidades públicas (federais e estaduais).
</p>

<p>
  <strong>Como funciona:</strong><br>
  O aluno faz o ENEM, e quando o SISU abre as inscrições (geralmente em janeiro e às vezes em junho),
  o estudante se cadastra no site 
  <a href="https://sisu.mec.gov.br" target="_blank" style="color:#6b05b4; text-decoration:underline;">
    sisu.mec.gov.br
  </a>E ele pode escolher até duas opções de curso. Durante o período de inscrição, o sistema mostra diariamente
  as <strong>notas de corte</strong> — a menor nota necessária para entrar naquele curso até o momento.<br><br>

  Ao final do prazo, o sistema seleciona automaticamente os candidatos com as melhores notas
  dentro das vagas disponíveis.
</p>

<p>
  <strong> Requisitos:</strong><br>
  • Ter feito o ENEM do ano anterior.<br>
  • Não ter zerado a redação.
</p>

<p>
  <strong> Vantagens:</strong><br>
  • Gratuito.<br>
  • Permite ingresso em universidades públicas sem vestibular próprio.
</p>

<br>
<br>

<h5><strong>PROUNI (Programa Universidade para Todos)</strong></h5>
<p>
   é um programa do Governo Federal que oferece bolsas de estudo em universidades particulares.
</p>

<p>
  <strong>Tipos de bolsas:</strong><br>
  <p>100% (integrais): o aluno não paga nada ou 50% (parciais): o aluno paga metade da mensalidade.
</p>
<strong>Como funciona:</strong>

<p>O estudante faz o ENEM, quando o PROUNI abre inscrições (geralmente em janeiro e junho), ele se inscreve no site 
    <a href="https://prouniportal.mec.gov.br" target="_blank" style="color:#6b05b4; text-decoration:underline;">
    prouniportal.mec.gov.br
  </a> e escolhe até duas opções de curso. A seleção é feita com base na nota do ENEM e nos critérios de renda.
</p>

<p>
  <strong> Requisitos principais:</strong><br>
  • Ter feito o ENEM mais recente, com nota mínima de 450 pontos e redação não zerada.<br>
  • Renda familiar bruta mensal por pessoa: <br>
   Até 1,5 salário mínimo → pode concorrer à bolsa integral (100%). <br>
   Até 3 salários mínimos → pode concorrer à bolsa parcial (50%). <br>
  • Ter estudado todo o ensino médio em escola pública, ou em escola particular com bolsa integral. <br>
  • Professores da rede pública também podem participar (para cursos de licenciatura).
</p>
<br>
<br>
      
 <h5><strong>FIES (Fundo de Financiamento Estudantil)</strong> </h5>
<p>
  é um programa de financiamento criado pelo Governo Federal para ajudar estudantes a pagar a faculdade particular.

</p>

<p>
  <strong>Como funciona:</strong><br>
  O governo paga as mensalidades durante o curso, depois da formatura, o aluno começa a devolver o 
  valor financiado de forma parcelada e com juros baixos (ou até zero, dependendo da renda).
</p>

<p>
  <strong> Etapas:</strong><br>
  • O aluno se inscreve no site <a href="https://fies.mec.gov.br" target="_blank" style="color:#6b05b4; text-decoration:underline;">
    fies.mec.gov.br
  </a><br>
  • Informa o curso, a faculdade e a renda familiar.
  • Se for aprovado, faz o contrato com o banco (geralmente a Caixa Econômica ou o Banco do Brasil).
  • O financiamento é pago diretamente à faculdade.
</p>

<p>
  <strong> Requisitos:</strong><br>
  • Ter feito o ENEM a partir de 2010.<br>
  • Ter nota mínima de 450 pontos e não ter zerado a redação.
  • Ter renda familiar per capita de até 3 salários mínimos (para o FIES tradicional).
  • Ser aprovado pela instituição de ensino em um curso com nota positiva no MEC.
</p>

      <h3> Diferenças entre ENEM, Fuvest, Unicamp e Outros Vestibulares</h3>
      <ul>
        <li><strong>ENEM:</strong> Avaliação nacional com 180 questões objetivas e redação. É usado pelo SISU, PROUNI e FIES. Valoriza interpretação e contexto.</li>
        <li><strong>Fuvest (USP):</strong> Prova mais tradicional e conteudista, com foco em raciocínio lógico e domínio teórico. Inclui 2ª fase discursiva e redação.</li>
        <li><strong>Unicamp:</strong> Prova com abordagem interdisciplinar, prioriza raciocínio, interpretação e aplicação prática do conhecimento.</li>
        <li><strong>Unesp:</strong> Questões diretas e objetivas, geralmente com linguagem acessível e foco no conteúdo programático do ensino médio.</li>
      </ul>

    
    </section>

   <div class="alert alert-light alerta-centro" role="alert">
  <strong>Para mais informações, Acesse:</strong>
  <a href="https://www.gov.br/pt-br/servicos/fazer-o-exame-nacional-do-ensino-medio" target="_blank">MEC</a>
</div>
    <a href="pagina_inicial.php" class="voltar">Voltar</a>
  </main>

  <div id="pet-fixo" style="display:none; position:fixed; top:10px; right:10px; width:150px; height:150px; z-index:1000;">
    <img id="pet-img" src="" alt="Pet" style="width:100%; height:100%; object-fit:cover;">
    <h6 id="pet-nome" style="text-align:center;"></h6>
  </div>
  <script src="../aluno/pet_fixo.js"> </script>
</body>
</html>
