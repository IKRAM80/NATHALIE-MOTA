<?php
get_header();
?>
    <main id="primary" class="site-main">
        <div class="page-content">
            <div class="main-content">
                <div class="single-photo-content">
                    <div class="infos-container">
                        <p class=photo-title><?php echo get_the_title()?></p>
                        <p> Référence : <span class="ref-value"><?php echo get_field('ref');?></span></p>
                        <p> Catégorie : <?php echo get_the_terms(get_the_ID(), 'category')[0]->name; ?></p>
                        <p> Format : <?php echo get_the_terms(get_the_ID(), 'format') [0]->name; ?></p>
                        <p> Type : <?php echo get_field('type'); ?></p>
                        <p> Année : <?php echo get_the_terms(get_the_ID(), 'date') [0]->name; ?></p>
                        <div class="line">    
                            <hr>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main><!-- #main -->  
<?php
get_footer();
?>