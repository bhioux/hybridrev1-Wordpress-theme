<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="bg-primary text-white py-3">
    <div class="container">
        <?php if (has_custom_logo()) : ?>
            <div class="logo"><?php the_custom_logo(); ?></div>
        <?php else : ?>
            <h1><?php bloginfo('name'); ?></h1>
        <?php endif; ?>
        <nav>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'nav',
            ));
            ?>
        </nav>
    </div>
</header>
