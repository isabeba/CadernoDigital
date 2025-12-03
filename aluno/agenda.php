<?php
session_start();
if (!isset($_SESSION['aluno'])) {
  header("Location: ../login.php");
  exit();
}

$id_aluno = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>

    <!-- FullCalendar -->
    <link class="favicon" rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
  overflow-x: hidden;
}

/* Container da Agenda */
#container-agenda {
  max-width: 900px;
  margin: 40px auto;
  background: var(--branco);
  border-radius: 20px;
  padding: 30px;
  box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

/* Título */
#container-agenda h1 {
  color: var(--roxo-escuro);
  margin-bottom: 20px;
}

/* Customização FullCalendar */
.fc {
  font-family: 'Nunito';
  background: var(--branco);
  border-radius: 16px;
  overflow: hidden;
}

.fc-toolbar-title {
  color: var(--roxo-escuro);
  font-weight: bold;
  font-size: 1.4rem;
}

.fc-button {
  background: var(--roxo-principal) !important;
  border: none !important;
  border-radius: 8px !important;
  font-weight: bold !important;
  color: var(--branco) !important;
  padding: 6px 10px !important;
  transition: 0.3s;
}

.fc-button:hover {
  background: var(--roxo-escuro) !important;
}

/* Dia atual */
.fc-daygrid-day.fc-day-today {
  background: var(--roxo-claro) !important;
  font-weight: bold;
  color: var(--branco);
}

/* Eventos */
.fc-event {
  background: var(--roxo-principal) !important;
  border: none !important;
  border-radius: 8px !important;
  font-weight: bold;
  text-align: center;
}

.fc-event:hover {
  background: var(--roxo-escuro) !important;
}

/* Botão Voltar */
.sair {
  display: inline-block;
  margin-top: 25px;
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
}
</style>
</head>

<body>

<div id="container-agenda">
    <h1>Minha Agenda</h1>
    <div id="calendar"></div>
</div>

<a href="/CadernoDigital-main/aluno/pagina_inicial.php" class="sair">⟵ Voltar</a>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        locale: 'pt-br',
        events: 'eventos.php',

        eventClick: function(info) {
            Swal.fire({
                title: `<span style="color:#6c45a1">${info.event.title}</span>`,
                html: `
                  <p><b>📅 ${new Date(info.event.start).toLocaleDateString("pt-BR")}</b></p>
                  <p>${info.event.extendedProps.description || "Sem descrição"}</p>
                `,
                confirmButtonText: "Fechar",
                background: "#ffffff",
                confirmButtonColor: "#8f63c9",
                color: "#6c45a1",
            });
        },

        dateClick: function(info) {
    Swal.fire({
      title: 'Novo evento 📌',
      html: `
        <input id="titulo" class="swal2-input" placeholder="Título do evento">
        <textarea id="descricao" class="swal2-textarea" placeholder="Descrição (opcional)" style="height:100px;resize:none;"></textarea>
      `,
      focusConfirm: false,
      showCancelButton: true,
      confirmButtonText: 'Salvar',
      cancelButtonText: 'Cancelar',
      background: '#ffffffff',
      color: '#5b4b8a',
      confirmButtonColor: '#8f63c9',
      cancelButtonColor: '#bfa3e6',
      preConfirm: () => {
        const titulo = document.getElementById('titulo').value.trim();
        const descricao = document.getElementById('descricao').value.trim();
        if (!titulo) { 
          Swal.showValidationMessage('O título é obrigatório!'); 
        }
        return { titulo, descricao };
      }
    }).then((result) => {
      if (result.isConfirmed) {
        fetch("adicionar_evento.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ 
            titulo: result.value.titulo, 
            data_evento: info.dateStr,
            descricao: result.value.descricao 
          })
        }).then(() => {
          Swal.fire({
            icon: 'success',
            title: 'Evento adicionado 🎉',
            timer: 1400,
            showConfirmButton: false,
            background: '#fffffff',
            color: '#5b4b8a'
          });
          calendar.refetchEvents();
        });
      }
    });
}

    });

    calendar.render();
});
</script>

</body>
</html>
