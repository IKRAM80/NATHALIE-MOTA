<?php
// créer un lien pour la gestion des menus dans l'administration
// et activation d'un menu pour le header et d'un menu pour le footer
// Visibles ensuite dans Apparence / Menus (after_setup_theme)
function register_my_menu(){
    register_nav_menu('main', "Menu principal");
    register_nav_menu('footer', "Menu pied de page");
 }
 add_action('after_setup_theme', 'register_my_menu');


// Enqueuing

 add_action('wp_enqueue_scripts', 'nathalie_mota_enqueue_styles');
 function nathalie_mota_enqueue_styles() {
    // Enqueue styles
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/style.css', array(), filemtime(get_stylesheet_directory() . '/style.css'));
     // Enqueue scripts
     wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '3.7.1', true);
     wp_enqueue_script('menu-script', get_template_directory_uri() . '/assets/js/modules/menu.js', array('jquery'), null, true);
     wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);
     wp_enqueue_script('modal-script', get_template_directory_uri() . '/assets/js/modules/modal.js', array('jquery'), null, true);
 }
 