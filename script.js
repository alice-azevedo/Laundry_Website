const tabMenu = document.querySelectorAll('.js-tabMenu li');
const tabConteudo = document.querySelectorAll('.js-tabConteudo section');
tabConteudo[0].classList.add('ativo');

function ativaPopUp(index) {
  tabConteudo.forEach((section) => {
    section.classList.remove('ativo');
  });
  tabConteudo[index].classList.add('ativo');
}

tabMenu.forEach((itemMenu, index) => {
  itemMenu.addEventListener('click', () => {
    ativaPopUp(index);
  })
});