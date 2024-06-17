<?php

function loadMore() {
    
    //Récupèrer le numéro de la page à charger depuis les données envoyées
    // via la requête POST
    $paged = $_POST['paged'];
    $posts_per_page = 8;//8 postes par page

    //Créer une nouvelle requête WordPress pour récupérer des posts de type 'photo'
    $ajaxposts = new WP_Query(array(
        'post_type'      => 'photo',
        'posts_per_page' => $posts_per_page,//avec 8 posts par page
        'orderby'        => 'date',
        'order'          => 'ASC',
        'post_status'    => 'publish',
        'paged'          => $paged,//pour la page spécifiée par $paged
    ));

    $response = '';//Initialiser la variable $response pour stocker le contenu HTML généré 
    $has_more_posts = false;//indiquer s'il y a d'autres posts à charger après cette page

    if ($ajaxposts->have_posts()) {//Vérifier s'il y a des posts à récupérer avec la requête effectuée
        ob_start(); //Démarrer la mise en tampon de sortie pour capturer tout le contenu généré
        //Parcourir tous les posts récupérés par la requête
        while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
            //générer le contenu HTML de chaque post
            get_template_part('assets/template-parts/photo-block');
        endwhile;
        
        //Récupèrer le contenu tamponné et l'ajouter à la variable $response
        $response .= ob_get_clean();
        //Vérifier s'il y a plus de pages de posts disponibles au-delà de la page actuelle.Si oui, $has_more_posts est mis à true.
        $has_more_posts = $ajaxposts->max_num_pages > $paged;

        //Réinitialiser les données des posts globaux de WordPress après la boucle personnalisée
        wp_reset_postdata();
    }

    //Encoder la réponse en JSON avec le contenu HTML généré et l'information s'il y a plus de posts à charger, puis l'afficher.
    echo json_encode(array('html' => $response, 'has_more_posts' => $has_more_posts));
    //Terminer proprement l'exécution du script, nécessaire pour les appels AJAX dans WordPress
    wp_die();
}

//enregistrer l'action pour les utilisateurs connectés
add_action('wp_ajax_loadMore', 'loadMore');
//et pour les utilisateurs non connectés 
add_action('wp_ajax_nopriv_loadMore', 'loadMore');

// FILTRES

function ajaxFilter() {
    // Vérifier le nonce pour des raisons de sécurité
    check_ajax_referer('my-ajax-nonce', 'nonce');

    // Récupérer les valeurs des filtres depuis la requête POST

    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $format = isset($_POST['format']) ? $_POST['format'] : '';
    $sortByDate = isset($_POST['sortByDate']) ? $_POST['sortByDate'] : '';

    // Arguments de la requête pour WP_Query pour récupérer les photos

    $gallery_args = array(
        'post_type' => 'photo',// Type de publication
        'posts_per_page' => -1,// Nombre de publications par page (-1 pour toutes)
        'orderby' => 'date', // Ordonner par date
        'order' => ($sortByDate === 'DESC') ? 'DESC' : 'ASC',// Ordre DESC ou ASC basé sur $sortByDate
        'post_status' => 'publish',// Publications publiées uniquement
        'paged' => 1,// Numéro de page initial
    );
    
    // Ajouter des conditions taxonomiques si des catégories sont sélectionnées
    if ($category && $category !== 'all') {
        $gallery_args['tax_query'][] = array(
            'taxonomy' => 'categorie',// Taxonomie pour les catégories de photos
            'field' => 'slug',// Champ utilisé pour correspondre aux termes (slug ici)
            'terms' => $category,// Terme de catégorie sélectionné
        );
    }

    // Ajouter des conditions taxonomiques si des formats sont sélectionnés
    if ($format && $format !== 'all') {
        $gallery_args['tax_query'][] = array(
            'taxonomy' => 'format',// Taxonomie pour les formats de photos
            'field' => 'slug',
            'terms' => $format,
        );
    }

    // Effectuer la requête avec les arguments configurés
    $query = new WP_Query($gallery_args);

    // Vérifier si des publications ont été trouvées
    if ($query->have_posts()) {
        ob_start();
        // Boucler sur les publications trouvées
        while ($query->have_posts()) : $query->the_post();
           // Inclure le modèle de bloc de photo spécifié
            get_template_part('assets/template-parts/photo-block');
        endwhile;
        // Récupérer le contenu mis en mémoire tampon et le nettoyer
        $content = ob_get_clean();
        // Afficher le contenu généré
        echo $content;
    }

    // Terminer le script PHP
    die();
}
// Ajouter une action pour les utilisateurs connectés
add_action('wp_ajax_ajaxFilter', 'ajaxFilter');
// Ajouter une action pour les utilisateurs non connectés (invités)
add_action('wp_ajax_nopriv_ajaxFilter', 'ajaxFilter');


