<?php
get_header();
?>
    <main id="primary" class="site-main">
    <div class="page-content">
        <div class="main-content">
            <div class="single-photo-content">
                <div class="infos-container">
                    <p class="photo-title"><?php echo get_the_title(); ?></p>
                    <p> Référence : <span class="ref-value"><?php echo get_field('référence'); ?></span></p>
                    <p> Catégorie : 
                        <?php
                        $categories = get_the_terms(get_the_ID(), 'catégories');
                        if (!is_wp_error($categories) && !empty($categories)) {
                            echo $categories[0]->name;
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
    </div>
</main><!-- #main -->
  
<?php
get_footer();
?>