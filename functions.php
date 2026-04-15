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
    wp_enqueue_style('pinheiro-style', get_stylesheet_uri(), array(), '1.5');
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

        echo "\n\n";
        echo '<meta property="og:site_name" content="Pinheiro Ofertas" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '" />' . "\n";
        echo '<meta property="og:description" content="🔥 Confira esta oferta selecionada no Pinheiro Ofertas!" />' . "\n";
        echo '<meta property="og:type" content="website" />' . "\n"; // Alterado para website para melhor compatibilidade
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
        
        if ($imagem) {
            echo '<meta property="og:image" content="' . esc_url($imagem) . '" />' . "\n";
            echo '<meta property="og:image:secure_url" content="' . esc_url($imagem) . '" />' . "\n"; // Importante para HTTPS
            echo '<meta property="og:image:width" content="1200" />' . "\n"; // Ajuda o bot a processar mais rápido
            echo '<meta property="og:image:height" content="630" />' . "\n";
        }
    }
}, 1);

// 6. SEGURANÇA: Escapamento de Links e Atributos de Afiliados
// Esta função garante que links externos sejam tratados com segurança pelo WordPress
function get_safe_affiliate_link($link) {
    return esc_url($link);
}

// 7. SEO TÉCNICO: JSON-LD (Rich Snippets) para exibição de preço e loja no Google
add_action('wp_head', function() {
    if ( is_singular('pinheiro_oferta') ) {
        global $post;
        $preco = get_post_meta($post->ID, '_preco_produto', true);
        $loja  = get_post_meta($post->ID, '_nome_loja', true);
        
        // Criamos o esquema de "Product" para o Google mostrar o preço na pesquisa
        $json_ld = [
            "@context" => "https://schema.org/",
            "@type" => "Product",
            "name" => get_the_title(),
            "image" => [ get_the_post_thumbnail_url($post->ID, 'full') ],
            "description" => get_the_excerpt(),
            "offers" => [
                "@type" => "Offer",
                "url" => get_permalink(),
                "priceCurrency" => "BRL",
                "price" => (float)$preco / 100,
                "availability" => "https://schema.org/InStock",
                "seller" => [
                    "@type" => "Organization",
                    "name" => $loja
                ]
            ]
        ];
        echo "\n" . '<script type="application/ld+json">' . json_encode($json_ld) . '</script>' . "\n";
    }
});