<?php
get_header();
?>
    <main id="primary" class="site-main">
    <div class="page-content">
         <div class="page-content">
            <div class="main-content">
                <div class="single-photo-content">
                    <div class="infos-container">
                        <p class=photo-title><?php echo get_the_title()?></p>
                        <p> Référence : <span class="ref-value"><?php echo get_field('reference');?></span></p>
                        <p> Catégorie : <?php echo get_the_terms(get_the_ID(), 'categorie')[0]->name; ?></p>
                        <p> Format : <?php echo get_the_terms(get_the_ID(), 'format') [0]->name; ?></p>
                        <p> Type : <?php echo get_field('type'); ?></p>
                        <p> Année : <?php echo get_field('date'); ?></p>
                        <div class="line">    
                            <hr>
                    </div>
                </div>
                <div class="photos-container">
            <?php if ( has_post_thumbnail() ) : ?>
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Photographie">
            <?php else : ?>
                <p>Aucune image mise en avant trouvée.</p>
            <?php endif; ?>
        </div>
            </div>
            <div class="contact-content">
                    <div class="contact">
                        <p class="contact-text">Cette photo vous intéresse ?</p>
                        <button class="btn contact-btn">Contact</button>
                    </div>
                    <div class="preview">
                        <?php
                        $previouspost = get_previous_post();
                        $nextpost = get_next_post();
                        ?>
                        <div class="arrows">
                            <?php if ($previouspost) : ?>
                                <?php $previous_photo = get_field('photo', $previouspost->ID); ?>
                                <a href="<?php echo get_permalink($previouspost); ?>" class="arrow-link arrow-left">
                                    <img class="arrow arrow-left" src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-left.svg" alt="Arrow for previous picture">
                                    <div class="hover-thumbnail thumbnail-left">
                                    <img src="<?php echo get_the_post_thumbnail_url($previouspost->ID, array(81, 71)) ?>" alt="Photo précédente">
                                    </div>
                                </a>
                            <?php endif; ?>
                            <?php if ($nextpost) : ?>
                                <?php $next_photo = get_field('photo', $nextpost->ID); ?>
                                <a href="<?php echo get_permalink($nextpost); ?>" class="arrow-link arrow-right">
                                    <img class="arrow arrow-right" src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-right.svg" alt="Arrow for next picture">
                                    <div class="hover-thumbnail thumbnail-right">
                                        <img src="<?php echo get_the_post_thumbnail_url($nextpost->ID, array(81, 71)) ?>" alt="Photo suivante">
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
    </div>
 
    <div class="separator">
    <hr>
</div>
<div>
    <div class="gallery">
        <p class="you-may-also-like">VOUS AIMEREZ AUSSI</p>
        <div class="gallery-container">
            <?php
            $current_post_id = get_the_ID(); // Récupère l'ID de la photo actuelle 
            $current_category = get_the_terms(get_the_ID(), 'category'); // Récupère les termes de taxonomie associés à cette photo

            

            $category_name = $current_category ? $current_category[0]->slug : ''; // Obtient le slug de la première catégorie associée à cette photo

            
            // Crée un tableau d'arguments pour interroger les publications
            $args = array(
                'post_type' => 'photo', // Récupérer que les publications du type photo 
                'category_name' => $category_name, // Filtrer les photos de la même catégorie 
                'posts_per_page' => 2, // Récupérer deux photos 
                'orderby' => 'rand', // Obtenir des photos aléatoires 
                'post__not_in'   => array($current_post_id), // Exclut la photo actuelle de la requête 
            );

            // Exécute la requête avec les arguments définis
            $query = new WP_Query($args);
                        if ($query->have_posts()){
                            // Boucle à travers chaque publication trouvée
                            while ($query->have_posts()) : $query->the_post();
                                // Inclut le fichier template-part 'photo-block' pour afficher chaque photo
                                get_template_part('assets/template-parts/photo-block');
                            endwhile;
                        } else {
                            ?> <p> Cette catégorie n'a pas d'autres photos. </p> <?php
                        }
            wp_reset_postdata(); // Réinitialise les données de publication après la boucle.
            ?>
        </div>
    </div>
</div>
<div class="btn-container">
    <a href="<?php echo home_url('/'); ?>">
        <span class="btn home-btn">Toutes les photos</span>
    </a>
</div>
</div>

</main><!-- #main -->
  
<?php
get_footer();
?>