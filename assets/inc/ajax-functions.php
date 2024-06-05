<?php
// LOAD MORE

function loadMore() {
    $paged = $_POST['paged'];
    $posts_per_page = 8;

    $ajaxposts = new WP_Query(array(
        'post_type'      => 'photo',
        'posts_per_page' => $posts_per_page,
        'orderby'        => 'date',
        'order'          => 'ASC',
        'post_status'    => 'publish',
        'paged'          => $paged,
    ));

    $response = '';
    $has_more_posts = false;

    if ($ajaxposts->have_posts()) {
        ob_start(); // Start output buffering

        while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
            get_template_part('assets/template-parts/photo-block');
        endwhile;
        
        $response .= ob_get_clean();
        // Check if there are more posts beyond the current page
        $has_more_posts = $ajaxposts->max_num_pages > $paged;

        wp_reset_postdata();
    }

    echo json_encode(array('html' => $response, 'has_more_posts' => $has_more_posts));
    wp_die();
}

add_action('wp_ajax_loadMore', 'loadMore');
add_action('wp_ajax_nopriv_loadMore', 'loadMore');


// FILTERS AND SORT

function ajaxFilter() {
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $format = isset($_POST['format']) ? $_POST['format'] : '';
    $sortByDate = isset($_POST['sortByDate']) ? $_POST['sortByDate'] : '';

    // Check if any filters are selected

    $gallery_args = array(
        'post_type' => 'photos',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => ($sortByDate === 'DESC') ? 'DESC' : 'ASC',
        'post_status' => 'publish',
        'paged' => 1,
    );

    if ($category && $category !== 'all') {
        $gallery_args['tax_query'][] = array(
            'taxonomy' => 'category',
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
var_dump("La requête a bien été traitée par WordPress.");
	var_dump( $post_id );
?>