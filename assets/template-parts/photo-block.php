
<div class="photo-suggested" data-photo-src="<?php echo get_the_post_thumbnail_url(); ?>" 
                             data-photo-prev="<?php echo esc_url(get_permalink(get_previous_post())); ?>" 
                             data-photo-next="<?php echo esc_url(get_permalink(get_next_post())); ?>"
                             data-photo-ref="<?php echo esc_attr(get_field('reference')); ?>"
                             data-photo-category="<?php echo esc_attr(get_the_terms(get_the_ID(), 'categorie')[0]->name); ?>">
     <img class="photo" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Photo">
     <div class="overlay">
          <div class="overlay__full">
            <a href="<?php echo get_the_permalink(); ?>" class="open-photopage icon">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_eye.png" alt="Ouvrir la page de la photo">
            </a>
            <img class="fullsize icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_fullscreen.png" alt="Voir l'image en plein écran">
            <p class="overlay-title overlay-text"><?php echo get_the_title(); ?></p>
            <p class="overlay-category overlay-text"><?php echo get_the_terms(get_the_ID(), 'categorie')[0]->name; ?></p>                                
          </div>
     </div>

</div>


