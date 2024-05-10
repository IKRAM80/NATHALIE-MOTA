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
        <?php
            if ( get_theme_mod( 'your_theme_logo' ) ) : ?>
            <a href="<?php echo home_url(); ?>">
                <img class="header__logo" src="<?php echo get_theme_mod( 'your_theme_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
            </a>
        <?php //
            else : ?>
                <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
        <?php endif;
        ?>
        <div class="header__navDesktop">
            <?php wp_nav_menu(array('theme_location' => 'main')); ?>
        </div>




    </header>