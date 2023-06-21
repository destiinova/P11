console.log('test')

//MENU BURGER// 
const button = document.querySelector('.buttonmenu');
const nav = document.querySelector('.navnewmenu');
const backdrop = document.querySelector('.backdrop');
const remove = document.querySelector('#content');
const remove2 = document.querySelector('footer');
const menuburger = document.querySelector('.menuburger');
button.addEventListener('click', () => {
  menuburger.classList.toggle('openburger');
  nav.classList.toggle('open');
  remove.classList.toggle('remove');
  remove2.classList.toggle('remove');

});

backdrop.addEventListener('click', () => {
  nav.classList.remove('open');
  remove.classList.remove('remove');
  remove2.classList.remove('remove');
  remove3.classList.remove('remove');
});

// button burger 
const burger= document.querySelector('.buttonmenu'); 
burger.addEventListener('click', ()=> {
  burger.classList.toggle('activee');
});




























//MODALE FORMS//
// Récupérer les éléments de la modale et du bouton pour ouvrir la modale
var modal = document.getElementById("myModal");
var btnOpenModal = document.getElementById("openModalBtn");
var closeModalBtn = document.getElementsByClassName("close")[0];

// Fonction pour ouvrir la modale
function openModal() {
  modal.style.display = "block"; // Afficher la modale
}

// Fonction pour fermer la modale
function closeModal() {
  modal.style.display = "none"; // Cacher la modale
}

// Événement au clic sur le bouton pour ouvrir la modale
btnOpenModal.addEventListener("click", openModal);

// Événement au clic sur le bouton de fermeture de la modale
closeModalBtn.addEventListener("click", closeModal);

// Événement au clic en dehors de la modale pour la fermer
window.addEventListener("click", function(event) {
  if (event.target === modal) {
    closeModal();
  }
});