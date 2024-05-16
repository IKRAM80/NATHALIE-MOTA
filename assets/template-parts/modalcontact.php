<?php
// -- Chemin url template --
$template_uri = get_template_directory_uri();

?>

<section id="contactModal" role="dialog" style="display: none;">

    <article class="modal-content">
         <button class="modal-content__closebtn" data-dismiss="dialog"><img src="<?php echo $template_uri?>/assets/images/close-icon.svg" alt="icone fermeture"></button> 
        <!-- en-tête de la modal -->
        <div class="modal-content__header"></div>
        <!-- corp de la modal -->
        <div class="modal-content__body">
        <?php
		// On insère le formulaire de demandes de renseignements
		echo do_shortcode('[contact-form-7 id="7de56ba" title="modal-contactForm"]');
		?>

        
        </div>
        
    </article>
</section>