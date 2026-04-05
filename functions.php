<?php
/**
 * Pinheiro Ofertas - Funções do Tema (Versão Otimizada 1.0)
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. SUPORTE DO TEMA
add_action('after_setup_theme', function() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
});

// 2. ENFILEIRAR ESTILOS
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('pinheiro-style', get_stylesheet_uri(), array(), '1.1');
});

// 3. REGISTRO DE OFERTAS E CATEGORIAS
add_action('init', function() {
    register_post_type('pinheiro_oferta', array(
        'labels' => array(
            'name' => 'Ofertas',
            'singular_name' => 'Oferta',
            'add_new' => 'Adicionar Oferta',
            'all_items' => 'Todas as Ofertas',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-tag',
        'supports' => array('title', 'thumbnail', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'oferta'),
        'has_archive' => true,
    ));

    register_taxonomy('categoria_oferta', 'pinheiro_oferta', array(
        'label' => 'Categorias',
        'hierarchical' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
    ));
});

// 4. LIMPEZA DO PAINEL (Foco em Ofertas)
add_action('admin_menu', function() {
    remove_menu_page('edit.php');          // Esconde Posts
    remove_menu_page('edit-comments.php'); // Esconde Comentários
});

// 5. META TAGS PARA WHATSAPP (SEO & COMPARTILHAMENTO)
add_action('wp_head', function() {
    if ( is_singular('pinheiro_oferta') ) {
        global $post;
        $imagem = get_the_post_thumbnail_url($post->ID, 'large');
        echo '<meta property="og:site_name" content="Pinheiro Ofertas" />';
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '" />';
        echo '<meta property="og:description" content="🔥 Confira esta oferta selecionada no Pinheiro Ofertas!" />';
        echo '<meta property="og:type" content="product" />';
        if ($imagem) echo '<meta property="og:image" content="' . esc_url($imagem) . '" />';
    }
}, 1);