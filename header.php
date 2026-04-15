<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php if (is_singular()): ?>
        <?php 
        $seo_description = wp_strip_all_tags(get_the_excerpt()); 
        ?>
        <meta name="description" content="<?php echo esc_attr($seo_description); ?>">
    <?php endif; ?>

    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-XXXXXX');</script>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXX"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<header class="site-header">
    <div class="container header-wrapper">
        <a href="<?php echo home_url(); ?>" class="logo-link">
            <?php 
            // Usamos get_template_directory_uri() para garantir o caminho correto da imagem
            ?>
            <img src="<?php echo get_template_directory_uri(); ?>/logo.png" alt="Pinheiro Ofertas" class="main-logo">
            <div class="logo-text-group">
                <span class="site-title">Ofertas Pinheiro</span>
                <span class="site-tagline">Ofertas em alta, selecionadas para quem também ama economizar!</span>
            </div>
        </a>
    </div>
</header>