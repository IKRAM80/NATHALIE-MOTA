<?php
// créer un lien pour la gestion des menus dans l'administration
// et activation d'un menu pour le header et d'un menu pour le footer
// Visibles ensuite dans Apparence / Menus (after_setup_theme)



function nathalie_mota_supports() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    register_nav_menu( 'main', 'Menu principal' );
    register_nav_menu( 'footer', 'Menu pied de page' );
}

add_action( 'after_setup_theme', 'nathalie_mota_supports' );

// Hook Btn CONTACT
 function add_elements_menus($items, $args) {
    if ($args->theme_location == 'main') { 
        $items .= '<li class="menu-item contact-btn">CONTACT</li>'; // Ajoutez le nouvel élément "CONTACT"
    }
    elseif ($args->theme_location == 'footer') { 
        $items .= '<li class="menu-item"> TOUS DROITS RÉSERVÉS </li>'; // Ajoutez un autre élément au menu de pied de page
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_elements_menus', 10, 2);

// Enqueuing

 include_once get_template_directory() . '/assets/inc/ajax-functions.php';

 add_action('wp_enqueue_scripts', 'nathalie_mota_enqueue_styles');
 function nathalie_mota_enqueue_styles() {
    // Enqueue styles
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/style.css', array(), filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_style('select2-style', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
    // Enqueue scripts
     wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '3.7.1', true);
     wp_enqueue_script('select2-script', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), '4.1.0-rc.0', true);
     wp_enqueue_script('menu-script', get_template_directory_uri() . '/assets/js/modules/menu.js', array('jquery'), null, true);
     wp_enqueue_script('modal-script', get_template_directory_uri() . '/assets/js/modules/modal.js', array('jquery'), null, true);
     wp_enqueue_script('arrow-positions-script', get_template_directory_uri() . '/assets/js/modules/arrowPositions.js', array('jquery'), null, true);
     wp_enqueue_script('select-2', get_template_directory_uri() . '/assets/js/modules/select2.js', array('jquery'), null, true);
     wp_enqueue_script('filters', get_template_directory_uri() . '/assets/js/modules/filters.js', array('jquery'), null, true);
     wp_enqueue_script('load-more', get_template_directory_uri() . '/assets/js/modules/loadMore.js', array('jquery'), null, true);
     wp_enqueue_script('lightbox', get_template_directory_uri() . '/assets/js/modules/lightbox.js', array('jquery'), null, true);
     wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);

     //localiser les données de script avec wp_localize_script, ce qui permet de passer des variables PHP à mon JavaScript. Dans ce cas, il passe l'URL 
     // du répertoire de mon thème à une variable JavaScript appelée theme_vars.
     wp_localize_script('modal-script', 'theme_vars', array(
        'templateUrl' => get_template_directory_uri()
    ));
    
}
    
 
 
// Enlever <p> et <br/> de Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

