<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Space+Mono&display=swap" rel="stylesheet">
    <?php wp_head() ?>
</head>
<body>
<header>
<nav role="naviguation" class="main-menu">
<!--APPARITION LOGO HEADER-->
            <?php $logo = get_theme_mod( 'header_logo' );
            if ( $logo ) {
              echo '<a href="'. home_url().'"> <img class="headerlogo" src="' . esc_url( $logo ) . '" alt="Header Logo"></a>';
            } ?>
<!--APPARITION NAVIGATION-->
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'Menu en tête',
                    'menu_class' => 'menu',
                    'container' => false,
                ));
            ?>
        </nav>
    </header>
    <?php include_once('menu.php'); ?>
<div id="container">
<main id="content" role="main">









