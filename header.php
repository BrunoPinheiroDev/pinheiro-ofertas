<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container header-wrapper">
        <a href="<?php echo home_url(); ?>" class="logo-link">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/logo.png" alt="Pinheiro Ofertas" class="main-logo">
            <div class="logo-text-group">
                <span class="site-title">Pinheiro Ofertas</span>
                <span class="site-tagline">Ofertas em alta, selecionadas para quem também ama economizar!</span>
            </div>
        </a>
    </div>
</header>