<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nathalie Mota - Photographe Event</title>
    <?php wp_head(); ?>
</head>
<body>
    <?php wp_body_open(); ?>
    <header class="header">
    <div class="logo">
			<a href="<?php echo home_url( '/' ); ?>" aria-label="Page d'accueil de Nathalie Mota">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo_nathalie_mota.png" 
				alt="Logo <?php echo bloginfo('name'); ?>">
			</a>
    </div>        
    <div class="header__navDesktop">
            <?php wp_nav_menu(array('theme_location' => 'main')); ?>
    </div>

    <div class="header__navMobile">
            <div id="menu_burger" class="nav_burger">
                <div class="navMobile-top">
                  <a href="<?php echo home_url( '/' ); ?>" aria-label="Page d'accueil de Nathalie Mota">
				     <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo_nathalie_mota.png" 
				    alt="Logo <?php echo bloginfo('name'); ?>">
			      </a>
                  <a id="closeBtn" href="#" class="close">&times;</a>
                </div>
                <?php wp_nav_menu(array('theme_location' => 'main')); ?>
            </div>

            <a href="#" id="openBtn">
                <span class="burger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
        </div>

    </header>