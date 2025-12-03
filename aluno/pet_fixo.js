window.addEventListener('DOMContentLoaded', async () => {
  try {
    const resposta = await fetch('obter_pet.php');
    const dados = await resposta.json();

    if (dados.pet) {
      const petFixo = document.getElementById('pet-fixo');
      const petNome = document.getElementById('pet-nome');
      const petImg = document.getElementById('pet-img');

      petNome.textContent = dados.pet;

      // Define a imagem com base no pet salvo
      const imagens = {
        'Genet': '../imagens/Genet.png',
        'Nata': '../imagens/Lobo.png',
        'Morfeu': '../imagens/Rato.png',
        'Timãozinho': '../imagens/panda.png'
      };

      petImg.src = imagens[dados.pet] || '';
      petFixo.style.display = 'block';
    }
  } catch (erro) {
    console.error('Erro ao buscar pet:', erro);
  }
});
