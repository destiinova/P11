//MENU BURGER// 
/* Sélection des éléments HTML */
let link = document.getElementById('link')
let burger = document.getElementById('burger')
let ul = document.querySelector('ul')

/* gestionnaire d'événement sur le a#link pour venir changer l'attribution de la classe .open à la ul et au span#burger */
link.addEventListener('click', function(e) {
  e.preventDefault()
  burger.classList.toggle('open')
  ul.classList.toggle('open')
})


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