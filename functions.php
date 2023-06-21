<?php
function assets()
{
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'assets');

function script()
{
    wp_enqueue_script('modal', get_template_directory_uri() . '/JS/modale.js', array('jquery'), '1.0', true);
    wp_enqueue_script('ajax', get_template_directory_uri() . '/js/ajax.js', array('jquery'), '1.0', true);
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '1.0', true);
    wp_enqueue_script('burger', get_template_directory_uri() . '/JS/menu-burger.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'script');

// ---------------------------- Ajout personnalisation du thème
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
    // HOOK -> texte non écrit dans le backoffice de WP
function add_search_form($items, $args)
{
    if ($args->theme_location == 'footer') {
        $items .= '<li>TOUS DROITS RÉSERVÉS</li>';
    } else {
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);
 
// Fonction pour ajouter une section "Header Logo" dans le customizer
function ajout_customizer_section( $wp_customize ) {
    $wp_customize->add_section( 'header_logo_section' , array(
       'title'       => __( 'Header Logo', 'motaphoto' ),
       'priority'    => 30,
       'description' => 'Ajouter le logo dans le header'
    ) );
 }
 add_action( 'customize_register', 'ajout_customizer_section' );

// Fonction pour ajouter les champs "Header Logo" dans le customizer
function ajout_customizer_champ( $wp_customize ) {
    $wp_customize->add_setting( 'header_logo' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_logo', array(
       'label'    => __( 'Header Logo', 'motaphoto' ),
       'section'  => 'header_logo_section',
       'settings' => 'header_logo',
    ) ) );
 }
 add_action( 'customize_register', 'ajout_customizer_champ' );

 ?>
























<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );









