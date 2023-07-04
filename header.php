<!DOCTYPE html>
<html lang="fr">

<head>
    <script src="//code.jquery.com/jquery-1.12.0.min.js">
    <meta charset="UTF-8">
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Space+Mono&display=swap" rel="stylesheet">
    <?php wp_head() ?>
    <script>
        $(document).ready(function () {
            var maref = "<?php echo get_post_meta(get_the_ID(), 'reference', true); ?>";
            $("#refphoto").val(maref);
        });
    </script>
</head>
<body>
<header>
<nav role="naviguation" class="main-menu">
<!------------------------- APPARITION LOGO HEADER ----------------------->
            <?php $logo = get_theme_mod( 'header_logo' );
            if ( $logo ) {
              echo '<a href="'. home_url().'"> <img class="headerlogo" src="' . esc_url( $logo ) . '" alt="Header Logo"></a>';
            } ?>
        <div class="buttonmenu"> 
        <span></span>
        </div>
<!------------------------ APPARITION NAVIGATION ------------------->
            <?php wp_nav_menu([
                'theme_location' => 'header', 
                'container' => false, 
                'menu_class' => 'menu-header'
                    ]) 
            ?>
                <?php include_once('menu.php'); ?>
                <?php include_once('template-parts/modal-contact.php'); ?>
                <?php include_once ('template-parts/lightbox.php');?>
            </nav>
    </header>

<div id="container">
<main id="content hero-container" role="main">









