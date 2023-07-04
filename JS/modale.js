// Récupérer les éléments de la modale et du bouton pour ouvrir la modale
var modal = document.getElementById('myModal');
const btn = document.querySelectorAll('.myBtn');

// Fonction pour ouvrir la modale
btn.forEach(function(button) {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        modal.style.display = "block";
    });
});

// Événement au clic en dehors de la modale pour la fermer
window.addEventListener('click', function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});
