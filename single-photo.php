<?php
get_header();
?>
    <main id="primary" class="site-main">
    <div class="page-content">
        <div class="main-content">
            <div class="single-photo-content">
                <div class="infos-container">
                    <p class="photo-title"><?php echo get_the_title(); ?></p>
                    <p> Référence : <span class="ref-value"><?php echo get_field('reference'); ?></span></p>
                    <p> Catégorie :
                        <?php
                        $categories = get_the_terms(get_the_ID(), 'categories');
                        if ($categories && !is_wp_error($categories)) {
                            foreach ($categories as $category) {
                                echo $category->name . ' ';
                            }
                        } else {
                            echo 'Aucune catégorie';
                        }
                        ?>
                    </p>
                    <p> Format : 
                        <?php
                        $formats = get_the_terms(get_the_ID(), 'formats');
                        if (!is_wp_error($formats) && !empty($formats)) {
                            echo $formats[0]->name;
                        } else {
                            echo 'Aucun format';
                        }
                        ?>
                    </p>
                    <p> Type : <?php echo get_field('type'); ?></p>
                    <p> Année : 
                        <?php
                        $dates = get_the_terms(get_the_ID(), 'date');
                        if (!is_wp_error($dates) && !empty($dates)) {
                            echo $dates[0]->name;
                        } else {
                            echo 'Aucune année';
                        }
                        ?>
                    </p>
                    <div class="line">
                        <hr>
                    </div>
                </div>
                <div class="photos-container">
                    <img src="<?php $photo = get_field('photos'); echo esc_url($photo['url']); ?>" alt="Photographie">
                </div>
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
</main><!-- #main -->
  
<?php
get_footer();
?>