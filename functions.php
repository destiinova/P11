<?php
// ----------------------------------------------------------------------------- Ajout du CSS pour le site  --------------------------------------------------------------------------------------
function assets()
{
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'assets');
// ----------------------------------------------------------------------------- Ajout du JS pour le site  --------------------------------------------------------------------------------------
function script()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('modale', get_template_directory_uri() . '/JS/modale.js', array('jquery'), '1.0', true);
    wp_enqueue_script('ajax', get_template_directory_uri() . '/JS/ajax.js', array('jquery'), '1.0', true);
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/JS/lightbox.js', array('jquery'), '1.0', true);
    wp_enqueue_script('burger', get_template_directory_uri() . '/JS/menu-burger.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'script');

// ----------------------------------------------------------------------------- Ajout personnalisation du thème -----------------------------------------------------------------------------
function montheme_supports()
{
    // Ajoute le support du menu dans ton thème
    add_theme_support('menus');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    // Enregistre les menus
    register_nav_menu('header', 'Menu en tête');
    register_nav_menu('footer', 'Menu pied de page');
}
add_action('after_setup_theme', 'montheme_supports');
    // ------------------------------------------------------------------------- HOOK -> texte non écrit dans le backoffice de WP --------------------------------------------------------------
function add_search_form($items, $args)
{
    if ($args->theme_location == 'footer') {
        $items .= '<li>TOUS DROITS RÉSERVÉS</li>';
    } else {
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);

// ------------------------------------------------------------------------- HOOK -> onglet "contact" du menu principal, n'affichera pas de page --------------------------------------------------------------
function add_search_form2($items, $args)
{
    if ($args->theme_location == 'header') {
        $items .= '<button id="myBtn" class="myBtn contactburger ">Contact</button>';
    } else {
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'add_search_form2', 10, 2);


// ----------------------------------------------------------------- Fonction pour ajouter une section "Header Logo" dans le customizer --------------------------------------------
function ajout_customizer_section( $wp_customize ) {
    $wp_customize->add_section( 'header_logo_section' , array(
       'title'       => __( 'Header Logo', 'motaphoto' ),
       'priority'    => 30,
       'description' => 'Ajouter le logo dans le header'
    ) );
 }
 add_action( 'customize_register', 'ajout_customizer_section' );

// ------------------------------------------------------------------ Fonction pour ajouter les champs "Header Logo" dans le customizer ------------------------------------------------------------------
function ajout_customizer_champ( $wp_customize ) {
    $wp_customize->add_setting( 'header_logo' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_logo', array(
       'label'    => __( 'Header Logo', 'motaphoto' ),
       'section'  => 'header_logo_section',
       'settings' => 'header_logo',
    ) ) );
 }
 add_action( 'customize_register', 'ajout_customizer_champ' );




// ------------------------------------------------------------------ FONCTION AJAX charger photos ------------------------------------------------------------------

function weichie_load_more()
{
    $ajaxposts = new WP_Query([
        'post_type' => 'photo',
        'posts_per_page' => 1,
        'paged' => $_POST['paged'],
    ]);

    $response = '';

    if ($ajaxposts->have_posts()) {
        while ($ajaxposts->have_posts()):
            $ajaxposts->the_post();
            $response .= get_template_part('card', 'photo');
        endwhile;
    } else {
        $response = '';
    }

    echo $response;
    exit;
}
add_action('wp_ajax_weichie_load_more', 'weichie_load_more');
add_action('wp_ajax_nopriv_weichie_load_more', 'weichie_load_more');

function wpb_rand_posts()
{

    $args = array(
        'post_type' => 'photo',
        'orderby' => 'rand',
        'posts_per_page' => 1,
    );

    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) {

        $string .= '<ul>';
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $string .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        $string .= '</ul>';
        /* Restore original Post Data */
        wp_reset_postdata();
    } else {

        $string .= 'aucun article disponible';
    }

    return $string;
}

add_shortcode('wpb-random-posts', 'wpb_rand_posts');
add_filter('widget-text', 'do_shortcode');

function filter_post()
{

    // Récupère les catégories sélectionnées depuis la requête POST
    $cat = isset($_POST['categorie']) ? sanitize_text_field($_POST['categorie']) : '';
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $date = isset($_POST['date']) ? sanitize_text_field($_POST['date']) : '';

    // Définit les arguments de la requête WP_Query
    $args = array(
        'post_type' => 'photo',
        // Type de publication : "photo"
        'posts_per_page' => 8,
        // Nombre de publications à afficher par page
        'paged' => 1,
        // Numéro de page
        'tax_query' => array(
            // Requête de taxonomie pour filtrer par catégorie et format
            array(
                'taxonomy' => 'categorie',
                // Taxonomie : "categorie"
                'field' => 'slug',
                // Champ utilisé pour la correspondance : slug
                'terms' => ($cat == -1 ? get_terms('categorie', array('fields' => 'slugs')) : $cat) // Termes de la catégorie à filtrer
            ),
            array(
                'taxonomy' => 'format',
                // Taxonomie : "format"
                'field' => 'slug',
                // Champ utilisé pour la correspondance : slug
                'terms' => ($format == -1 ? get_terms('format', array('fields' => 'slugs')) : $format) // Termes du format à filtrer
            )
        ),
        'orderby' => ($date === 'anciens') ? 'date' : 'date',
        // Tri par date (plus ancien ou plus récent)
        'order' => ($date === 'anciens') ? 'ASC' : 'DESC', // Tri ascendant (plus ancien) ou descendant (plus récent)
    );

    // Effectue la requête WP_Query avec les arguments définis
    $ajaxfilter = new WP_Query($args);

    // Vérifie si des publications ont été trouvées
    if ($ajaxfilter->have_posts()) {
        ob_start(); // Démarre la mise en mémoire tampon

        // Boucle while pour parcourir les publications
        while ($ajaxfilter->have_posts()) {
            $ajaxfilter->the_post();
            // Affiche le code HTML de chaque publication
            ?>

            <div class="nouveau_block"
                data-category="<?php echo esc_attr(implode(',', wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'slugs')))); ?>"
                data-format="<?php echo esc_attr(implode(',', wp_get_post_terms(get_the_ID(), 'format', array('fields' => 'slugs')))); ?>">
                <div class="photo_newunephoto">
                    <?php the_content(); ?>
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail(); ?>
                        <div class="fadedbox">
                            <div class="title text">
                                <div class="titre">
                                    <p>
                                        <?php the_title(); ?>
                                    </p>
                                </div>
                                <div class="categorie">
                                    <p>
                                        <?php echo the_terms(get_the_ID(), 'categorie', false); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="divoeil">
                                <a href="<?php the_permalink(); ?>"><img
                                        src="<?php echo get_stylesheet_directory_uri(); ?>/asset/oeil.png" alt="oeil"></a>
                            </div>
                            <div class="divfullscreen">
                            <button class="buttonlightbox" data-titre="<?php the_title(); ?>" data-date="<?php $post_date = get_the_date('Y');
                          echo $post_date; ?>" data-image="<?php echo esc_attr(get_the_post_thumbnail_url(get_the_ID())); ?>" data-categ="<?php
                               $categories = get_the_terms(get_the_ID(), 'categorie'); // Remplacez 'categorie' par le nom de votre taxonomie
                               if ($categories && !is_wp_error($categories)) {
                                   // Vérifie si la variable $categories existe et n'est pas une erreur de WordPress
                                   $category_names = array(); // Crée un tableau vide pour stocker les noms des catégories
                                   foreach ($categories as $category) {
                                       // Parcourt chaque terme de taxonomie dans $categories
                                       $category_names[] = $category->name;
                                       // Ajoute le nom de la catégorie courante au tableau $category_names
                                   }
                                   echo implode(', ', $category_names);
                                   // Concatène les noms des catégories avec une virgule comme séparateur
                               }
                               ?>"><img src="wp-content\themes\motaphoto\asset\fullscreen.png"></button>
                    </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>




 <script> $(document).ready(function() {
  // Sélectionner l'élément de la lightbox
  var lightbox = document.querySelector('.lightbox');

  // Sélectionner le bouton de fermeture de la lightbox
  var spanlightbox = document.querySelector('.lightbox__close');

  // Sélectionner tous les boutons qui ouvrent la lightbox
  var buttonlightbox = document.querySelectorAll('.buttonlightbox');

  // Lorsque l'un des boutons est cliqué
  buttonlightbox.forEach(function(button, index) {
    button.addEventListener('click', function(e) {
      e.preventDefault();

      // Récupérer l'URL, le titre et la date de l'image associée au bouton
      var imageSrc = button.getAttribute('data-image');
      var imageTitre = button.getAttribute('data-titre');
      var imageDate = button.getAttribute('data-date');
      var imagecateg = button.getAttribute('data-categ');
      // Sélectionner l'élément de l'image dans la lightbox
      var lightboxImage = lightbox.querySelector('.lightbox__image');
      var lightboxTitre = lightbox.querySelector('.lightbox__titre');
      var lightboxDate = lightbox.querySelector('.lightbox__date');
      var lightboxcateg = lightbox.querySelector('.lightbox__categ');

      // Définir la source de l'image avec l'URL récupérée
      lightboxImage.setAttribute('src', imageSrc);

      // Définir le titre et la date de l'image dans la lightbox
      lightboxTitre.textContent = imageTitre;
      lightboxDate.textContent = imageDate;
      lightboxcateg.textContent = imagecateg;

      // Afficher la lightbox
      lightbox.style.display = 'block';

      // Enregistrer l'index du bouton cliqué pour la navigation
      lightbox.setAttribute('data-current-index', index);
    });
  });

  // Lorsque le bouton de fermeture est cliqué
  spanlightbox.onclick = function() {
    // Cacher la lightbox
    lightbox.style.display = 'none';
  };

  // Lorsque l'utilisateur clique en dehors de la lightbox
  window.onclick = function(event) {
    // Si l'élément cliqué est la lightbox elle-même
    if (event.target == lightbox) {
      // Cacher la lightbox
      lightbox.style.display = 'none';
    }
  };

  // Lorsque les flèches gauche et droite sont cliquées
  lightbox.querySelector('.fleche-gauche').addEventListener('click', function(e) {
    e.stopPropagation(); // Empêche la propagation de l'événement pour éviter la fermeture de la lightbox
    // parseInt permet de recuperer une chaine de caractères en entier 
    var currentIndex = parseInt(lightbox.getAttribute('data-current-index'));
    var previousButton = buttonlightbox[currentIndex - 1];
    if (previousButton) {
      previousButton.click();
      lightbox.setAttribute('data-current-index', currentIndex - 1);
    }
  });

  lightbox.querySelector('.fleche-droite').addEventListener('click', function(e) {
    e.stopPropagation(); // Empêche la propagation de l'événement pour éviter la fermeture de la lightbox

    var currentIndex = parseInt(lightbox.getAttribute('data-current-index'));
    var nextButton = buttonlightbox[currentIndex + 1];
    if (nextButton) {
      nextButton.click();
      lightbox.setAttribute('data-current-index', currentIndex + 1);
    }
  });
});

            </script>
            <?php
        }

        wp_reset_query(); // Réinitialise la requête
        wp_reset_postdata(); // Réinitialise les données de publication

        $response = ob_get_clean(); // Récupère le contenu de la mise en mémoire tampon
    } else {
        $response = '<p>Aucun article trouvé.</p>'; // Aucune publication trouvée
    }

    echo $response; // Affiche la réponse
    exit; // Termine la fonction
}

add_action('wp_ajax_filter_post', 'filter_post');
add_action('wp_ajax_nopriv_filter_post', 'filter_post');

// Recupere date 
function get_unique_post_dates()
{
    $dates = array();

    $args = array(
        'post_type' => 'post',
        // Remplacez 'post' par votre type de contenu personnalisé si nécessaire
        'posts_per_page' => -1,
        'orderby' => ($_POST['date'] === 'anciens') ? 'date' : 'date',
        // Tri par date (plus ancien ou plus récent)
        'order' => ($_POST['date'] === 'anciens') ? 'ASC' : 'DESC', // Tri ascendant (plus ancien) ou descendant (plus récent)
    );

    $query = new WP_Query($args);

    while ($query->have_posts()) {
        $query->the_post();
        $date = get_the_date('Y-m-d'); // Format de date souhaité, ici 'Y-m-d'
        if (!in_array($date, $dates)) {
            $dates[] = $date;
        }
    }

    wp_reset_postdata();

    return $dates;
}

?>
















