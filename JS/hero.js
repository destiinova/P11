  // Fonction pour charger une image aléatoire du catalogue WP
  function loadRandomImage() {
    // Récupérer une image aléatoire du catalogue WP
    // Remplacez l'URL_DE_VOTRE_CATALOGUE_WP par l'URL réelle du catalogue WordPress
    var randomImageUrl = 'URL_DE_VOTRE_CATALOGUE_WP/wp-content/uploads/random-image.php';

    // Modifier le style du conteneur du héros avec l'image chargée
    document.getElementById('hero-container').style.backgroundImage = 'url(' + randomImageUrl + ')';
  }

  // Appeler la fonction pour charger une image aléatoire au chargement de la page
  window.onload = loadRandomImage;