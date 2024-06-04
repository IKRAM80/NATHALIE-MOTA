<?php
// LOAD MORE

function loadMore() {
    $paged = $_POST['paged'];// Récupère le numéro de page envoyé via la requête AJAX
    $posts_per_page = 8;//nombre de publications à afficher par page

    // Crée une nouvelle requête WP pour obtenir les publications de type 'photos'
    $ajaxposts = new WP_Query(array(
        'post_type'      => 'photos',
        'posts_per_page' => $posts_per_page,
        'orderby'        => 'date',// Trier par date
        'order'          => 'ASC',// Trier par date
        'post_status'    => 'publish',// Afficher seulement les publications publiées
        'paged'          => $paged,// Numéro de page
    ));

    $response = '';// Initialiser la réponse vide
    $has_more_posts = false;// Indiquer si il y a plus de publications à charger

    if ($ajaxposts->have_posts()) {
        ob_start(); // Commence la mise en mémoire tampon de sortie

        while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
            get_template_part('assets/template-parts/photo-block'); // Inclut le modèle pour chaque publication
        endwhile;
        
        $response .= ob_get_clean();// Obtient le contenu tamponné et le stocke dans $response
        // Vérifie s'il y a plus de pages à charger
        $has_more_posts = $ajaxposts->max_num_pages > $paged;

        wp_reset_postdata();// Réinitialise les données de publication après la boucle
    }
    // Envoie la réponse en JSON avec le contenu HTML et l'indicateur de plus de publications
    echo json_encode(array('html' => $response, 'has_more_posts' => $has_more_posts));
    wp_die();// Termine l'exécution pour que WordPress n'ajoute rien à la réponse
}
// Enregistre l'action AJAX pour les utilisateurs connectés
add_action('wp_ajax_loadMore', 'loadMore');
// Enregistre l'action AJAX pour les utilisateurs non connectés
add_action('wp_ajax_nopriv_loadMore', 'loadMore');

// FILTERS AND SORT

function ajaxFilter() {
    
    // Récupère les filtres envoyés via la requête AJAX
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $format = isset($_POST['format']) ? $_POST['format'] : '';
    $sortByDate = isset($_POST['sortByDate']) ? $_POST['sortByDate'] : '';

    // Crée les arguments pour la requête WP en fonction des filtres

    $gallery_args = array(
        'post_type' => 'photos',// Type de publication
        'posts_per_page' => -1, // Affiche toutes les publications
        'orderby' => 'date',// Trie par date
        'order' => ($sortByDate === 'DESC') ? 'DESC' : 'ASC',// Ordre de tri en fonction du filtre
        'post_status' => 'publish', // Affiche seulement les publications publiées
        'paged' => 1,// Numéro de page
    );
    // Ajoute un filtre de catégorie si une catégorie est sélectionnée
    if ($category && $category !== 'all') {
        $gallery_args['tax_query'][] = array(
            'taxonomy' => 'categorie',// Taxonomie
            'field' => 'slug', // Type de champ
            'terms' => $category,// Valeur du filtre
        );
    }
    // Ajoute un filtre de format si un format est sélectionnée
    if ($format && $format !== 'all') {
        $gallery_args['tax_query'][] = array(
            'taxonomy' => 'format',// Taxonomie
            'field' => 'slug',// Type de champ
            'terms' => $format,// Valeur du filtre
        );
    }
    // Exécute la requête WP avec les arguments définis
    $query = new WP_Query($gallery_args);

    if ($query->have_posts()) {
        ob_start();// Commence la mise en mémoire tampon de sortie
        while ($query->have_posts()) : $query->the_post();
            get_template_part('assets/template-parts/photo-block');// Inclut le modèle pour chaque publication
        endwhile;
        $content = ob_get_clean();// Obtient le contenu tamponné et le stocke dans $content
        echo $content;// Affiche le contenu
    }

    die(); // Termine l'exécution pour que WordPress n'ajoute rien à la réponse
}
// Enregistre l'action AJAX pour les utilisateurs connectés
add_action('wp_ajax_ajaxFilter', 'ajaxFilter');
// Enregistre l'action AJAX pour les utilisateurs non connectés
add_action('wp_ajax_nopriv_ajaxFilter', 'ajaxFilter'); 

?>