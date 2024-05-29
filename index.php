<?php
get_header();
?>
<div class="home-content">
    <div class="hero">
        <h1 class="hero__title">PHOTOGRAPHE EVENT</h1>

     <div class="hero__banner">
        <?php
            $args = array(
                'post_type' => 'photo',// Rechercher des articles du type photo
                'posts_per_page' => 1,// Limiter la recherche à un seul article
                'orderby' => 'rand',// Trier les résultats de manière aléatoire
                'tax_query' => array(//Ajouter une requête de taxonomie pour filtrer les articles par le format paysage
                    array(
                        'taxonomy' => 'format',
                        'field' => 'slug',
                        'terms' => 'paysage',
                    ),
                ),
            );

            $query = new WP_Query($args);//Crée une nouvelle requête WordPress avec les arguments définis
            if ($query->have_posts()) {//Vérifier si la requête a retourné des articles
                //Boucle sur les articles trouvés, en définissant les données globales du poste actuel
                while ($query->have_posts()) : $query->the_post();
                    ?>
                    <!--Affiche l'image mise en avant de l'article avec l'URL de l'image et le titre de l'article comme attributs src et alt.-->
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                    <?php
                endwhile;
                wp_reset_postdata();
            }
        ?>
     </div>
        
    </div>
    
<div class="gallery-home">
     <div class="gallery-container">
            <?php
            //Récupèrer le numéro de page de la requête actuelle. Si aucune page n'est définie, utilise 1 par défaut
                $paged = get_query_var( 'paged', 1 );
                $gallery = array(
                    'post_type' => 'photo',// Rechercher des articles du type photo
                    'posts_per_page' => 8,// Limiter la recherche à huit articles par page
                    'orderby' => 'date',// Trier les articles par date
                    'order' => 'ASC',//Trier les articles par ordre croissant
                    'post_status' => 'publish',//Rechercher uniquement les articles publiés
                    'paged' => $paged,//Gérer la pagination en utilisant la variable $paged
                );
                //Créer une nouvelle requête WordPress avec les arguments définis
                $query = new WP_Query($gallery);

                if ($query->have_posts()){//Vérifier si la requête a retourné des articles
                    //Boucle sur les articles trouvés en définissant les données globales du poste actuel
                    while ($query->have_posts()) : $query->the_post();
                        //Inclut le modèle photo-block pour afficher chaque article
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