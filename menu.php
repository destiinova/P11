<div class="page">
<header class="header-burger">
<!--APPARITION LOGO HEADER SOUS FORMAT MOBILE-->
        <?php
    $logo_image_id = get_theme_mod('header_logo'); // Récupère l'ID de l'image de logo depuis les paramètres du thème
    $logo_image_url = wp_get_attachment_image_url($logo_image_id, 'full'); // Récupère l'URL de l'image de logo en utilisant l'ID
    
    if ($logo_image_url) {
        echo '<a href="'. home_url().'"> <img class="headerlogo" src="' . esc_url( $logo ) . '" alt="Header Logo"></a>';
         }
         ?>  

</header>
<nav id="menu" class="newul">
<!--APPARITION NAVIGATION-->
    <div>
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'Menu en tête',
                    'menu_class' => 'menu',
                    'container' => false,
                ));
            ?>
    </div>
    </div>
</nav>
        <script src="script.js"></script>