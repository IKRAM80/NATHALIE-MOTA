<?php
get_header();
?>
<div class="home-content">
    <div class="hero">
        <h1 class="hero__title">PHOTOGRAPHE EVENT</h1>

     <div class="hero__banner">
        <?php
            $args = array(
                'post_type' => 'photo',
                'posts_per_page' => 1,
                'orderby' => 'rand',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'format',
                        'field' => 'slug',
                        'terms' => 'paysage',
                    ),
                ),
            );

            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    ?>
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                    <?php
                endwhile;
                wp_reset_postdata();
            }
        ?>
     </div>
        
    </div>
    

     <div class="gallery-container">
            <?php
                $paged = get_query_var( 'paged', 1 );
                $gallery = array(
                    'post_type' => 'photo',
                    'posts_per_page' => 8,
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'post_status' => 'publish',
                    'paged' => $paged,
                );

                $query = new WP_Query($gallery);

                if ($query->have_posts()){
                    while ($query->have_posts()) : $query->the_post();
                        get_template_part('assets/template-parts/photo-block');
                    endwhile;
                }
            ?>
     </div>
    <div class="btn-container">
            <a id="load-more" href="<?php echo home_url('/'); ?>">
                <span class="btn more-btn">Charger plus</span>
            </a>
    </div>
    
</div>


<?php
get_footer();
?>