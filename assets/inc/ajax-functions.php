<?php

function loadMore() {
    //Récupèrer le numéro de la page à charger depuis les données envoyées
    // via la requête POST
    $paged = $_POST['paged'];
    $posts_per_page = 8;//8 posts par page

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





// FILTERS AND SORT

function ajaxFilter() {
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $format = isset($_POST['format']) ? $_POST['format'] : '';
    $sortByDate = isset($_POST['sortByDate']) ? $_POST['sortByDate'] : '';

    // Check if any filters are selected

    $gallery_args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => ($sortByDate === 'DESC') ? 'DESC' : 'ASC',
        'post_status' => 'publish',
        'paged' => 1,
    );

    if ($category && $category !== 'all') {
        $gallery_args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $category,
        );
    }

    if ($format && $format !== 'all') {
        $gallery_args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $format,
        );
    }

    $query = new WP_Query($gallery_args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) : $query->the_post();
            get_template_part('assets/template-parts/photo-block');
        endwhile;
        $content = ob_get_clean();
        echo $content;
    }

    die();
}
add_action('wp_ajax_ajaxFilter', 'ajaxFilter');
add_action('wp_ajax_nopriv_ajaxFilter', 'ajaxFilter'); // For non-logged in users
?>