<?php 
/**
 * Template da Página Interna de Oferta
 * Versão Final Otimizada: Segurança, SEO e Analytics
 */
get_header(); 
?>

<style>
    /* Estilos Visuais do Card (Box Branco) */
    .oferta-box-wrapper {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-top: 40px;
        margin-bottom: 40px;
        width: 100%;
    }

    /* Grid da Oferta */
    .oferta-hero {
        display: grid;
        grid-template-columns: 40% 60%;
        border-bottom: 1px solid #f0f0f0;
    }

    /* Coluna Imagem */
    .oferta-img-col {
        padding: 40px;
        display: flex; align-items: center; justify-content: center;
        background: #fff; border-right: 1px solid #f0f0f0;
    }
    .oferta-img-col img { max-width: 100%; height: auto; max-height: 400px; object-fit: contain; }

    /* Coluna Informações */
    .oferta-info-col { 
        padding: 40px; 
        display: flex; flex-direction: column; justify-content: center; 
        align-items: flex-start; 
    }

    .oferta-loja-badge {
        display: inline-block;
        background: #eee; color: #555;
        font-size: 11px; font-weight: 700; text-transform: uppercase;
        padding: 5px 10px; border-radius: 4px;
        margin-bottom: 10px;
        line-height: 1;
    }

    .oferta-titulo { 
        font-size: 28px; line-height: 1.2; color: #1A4D3E; 
        margin: 0 0 15px 0; font-weight: 800; 
        width: 100%; 
    }
    
    .oferta-resumo { font-size: 15px; color: #666; margin-bottom: 20px; line-height: 1.4; }

    /* Seção de Preço Atualizada */
    .oferta-detalhes-preco {
        margin: 10px 0 25px 0;
        width: 100%;
    }

    .oferta-preco { 
        font-size: 42px; 
        font-weight: 900; 
        color: #27ae60; 
        letter-spacing: -1px; 
        display: block; 
        line-height: 1; 
    }
    
    .pagamento-row {
        display: flex; 
        align-items: center; 
        gap: 8px;
        font-size: 14px; 
        color: #666; 
        margin-top: 10px;
        font-weight: 500;
    }

    /* Cupom e Botões */
    .cupom-box {
        width: 100%; box-sizing: border-box;
        background: #fff8e1; border: 2px dashed #f1c40f;
        padding: 12px; border-radius: 6px; margin-bottom: 15px;
        display: flex; align-items: center; justify-content: space-between;
    }
    .cupom-info span { display: block; font-size: 11px; color: #9e8226; font-weight: 600; }
    .cupom-codigo { font-family: monospace; font-size: 18px; font-weight: 800; color: #333; letter-spacing: 1px; }
    
    .btn-copiar { 
        background: #fff; border: 1px solid #e6ce68; cursor: pointer; padding: 6px 12px; 
        font-size: 11px; font-weight: bold; text-transform: uppercase; border-radius: 4px; color: #bfa117; transition: 0.2s;
    }
    .btn-copiar:hover { background: #f1c40f; color: #fff; }
    .btn-copiar.copiado { background: #27ae60; color: #fff; border-color: #27ae60; }

    .btn-pegar {
        display: block; width: 100%; box-sizing: border-box;
        background: #1A4D3E; color: white; text-align: center; padding: 18px; font-size: 20px; font-weight: 800; border-radius: 6px; text-decoration: none; transition: 0.3s;
        box-shadow: 0 4px 10px rgba(26, 77, 62, 0.2); margin-bottom: 15px;
    }
    .btn-pegar:hover { background: #143d31; transform: translateY(-2px); color: white; }

    .btn-whatsapp {
        display: flex; align-items: center; justify-content: center; gap: 8px;
        width: 100%; box-sizing: border-box;
        background: #25D366; color: white; padding: 12px; border-radius: 6px;
        text-decoration: none; font-weight: 700; font-size: 15px; transition: 0.3s;
        border: 1px solid #20b857; margin-top: 0;
    }
    .btn-whatsapp:hover { background: #1ebc57; transform: translateY(-2px); color: white; }
    .zap-icon { width: 18px; height: 18px; fill: white; }

    /* Conteúdo e Review */
    .oferta-review-area { padding: 40px; }
    .review-titulo { font-size: 20px; color: #333; margin-bottom: 15px; border-left: 4px solid #1A4D3E; padding-left: 10px; font-weight: 700; }
    .video-container {
        position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; margin-bottom: 30px; border-radius: 8px; background: #000;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .video-container iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }

    .conteudo-texto { font-size: 15px; line-height: 1.6; color: #444; }
    .conteudo-texto p { margin-bottom: 15px; }
    
    /* Tabelas no conteúdo */
    .conteudo-texto table { width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 14px; background: #fff; border-bottom: 1px solid #dcdcdc; }
    .conteudo-texto table thead tr { background-color: #1A4D3E; color: #ffffff; }
    .conteudo-texto table th, .conteudo-texto table td { padding: 12px 15px; border: 1px solid #dcdcdc; text-align: left; }
    .conteudo-texto table tbody tr:nth-of-type(even) { background-color: #f7f9f8; }

    /* Responsivo Mobile */
    @media (max-width: 768px) {
        .oferta-hero { grid-template-columns: 1fr; }
        .oferta-img-col, .oferta-info-col, .oferta-review-area { padding: 20px; }
        .oferta-titulo { font-size: 24px; }
    }
</style>

<main class="container">
    <?php while ( have_posts() ) : the_post(); 
        $preco     = get_post_meta(get_the_ID(), '_preco_produto', true);
        $tipo      = get_post_meta(get_the_ID(), '_tipo_pagamento', true);
        $condicoes = get_post_meta(get_the_ID(), '_condicoes_pagamento', true);
        $loja      = get_post_meta(get_the_ID(), '_nome_loja', true);
        $cupom     = get_post_meta(get_the_ID(), '_cupom_oferta', true);
        $link      = get_post_meta(get_the_ID(), '_link_oferta', true);
        $video     = get_post_meta(get_the_ID(), '_video_review', true);
        
        $preco_fmt = 'R$ ' . number_format((float)$preco / 100, 2, ',', '.');
        $loja_upper = mb_strtoupper($loja, 'UTF-8');

        // LÓGICA WHATSAPP
        $artigo = 'na';
        $loja_check = mb_strtolower($loja);
        $masculinas = ['mercado livre', 'aliexpress', 'submarino', 'ponto frio', 'kabum', 'carrefour', 'extra', 'shoptime'];
        foreach($masculinas as $m) { if (strpos($loja_check, $m) !== false) { $artigo = 'no'; break; } }

        $msg_zap = "*" . get_the_title() . "*\n";
        $msg_zap .= $preco_fmt;
        if($condicoes) { $msg_zap .= " em " . $condicoes; }
        $msg_zap .= "\n";
        if ($cupom) { $msg_zap .= "🎟️ *Use o cupom:* " . $cupom . "\n"; }
        $msg_zap .= "\n";
        $msg_zap .= "🔍 *Ver Review e Detalhes:*\n" . get_the_permalink() . "\n\n";
        $msg_zap .= "🛒 *Comprar " . $artigo . " " . $loja_upper . ":*\n" . $link;
        $link_zap = "https://api.whatsapp.com/send?text=" . urlencode($msg_zap);
    ?>

    <div class="oferta-box-wrapper">
        <div class="oferta-hero">
            <div class="oferta-img-col">
                <?php if ( has_post_thumbnail() ) { 
                    the_post_thumbnail('large', [
                        'alt' => get_the_title(), // Essencial para o Google Imagens
                        'loading' => 'lazy'      // Performance (Lazy Loading)
                    ]); 
                } ?>
            </div>

            <div class="oferta-info-col">
                <span class="oferta-loja-badge">Vendido por: <?php echo esc_html($loja ?: 'Oferta'); ?></span>
                
                <h1 class="oferta-titulo"><?php the_title(); ?></h1>
                
                <?php if(has_excerpt()): ?>
                    <div class="oferta-resumo"><?php the_excerpt(); ?></div>
                <?php endif; ?>

                <div class="oferta-detalhes-preco">
                    <span class="oferta-preco"><?php echo esc_html($preco_fmt); ?></span>
                    
                    <div class="pagamento-row">
                        <?php if($tipo == 'pix'): ?>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="#32BCAD" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                            </svg>
                            <span style="font-weight: 700; color: #32BCAD;">no PIX</span>
                        <?php elseif($tipo == 'boleto'): ?>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="3" y1="5" x2="3" y2="19"></line><line x1="6" y1="5" x2="6" y2="19"></line><line x1="10" y1="5" x2="10" y2="19"></line><line x1="14" y1="5" x2="14" y2="19"></line><line x1="18" y1="5" x2="18" y2="19"></line><line x1="21" y1="5" x2="21" y2="19"></line>
                            </svg>
                            <span>no Boleto</span>
                        <?php else: ?>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line>
                            </svg>
                            <span>no Cartão</span>
                        <?php endif; ?>

                        <?php if($condicoes) echo ' <span style="color: #ccc;">•</span> ' . esc_html($condicoes); ?>
                    </div>
                </div>

                <?php if($cupom): ?>
                <div class="cupom-box">
                    <div class="cupom-info">
                        <span>CUPOM:</span>
                        <span class="cupom-codigo" id="cpCode"><?php echo esc_html($cupom); ?></span>
                    </div>
                    <button type="button" class="btn-copiar" onclick="copiar(this)">COPIAR</button>
                </div>
                <?php endif; ?>

                <a href="<?php echo esc_url($link); ?>" 
                    target="_blank" 
                    rel="nofollow noopener noreferrer" 
                    class="btn-pegar"
                    onclick="window.dataLayer = window.dataLayer || []; dataLayer.push({'event': 'clique_oferta', 'produto': '<?php echo esc_js(get_the_title()); ?>'});">
                    IR PARA A LOJA ➔
                </a>

                <a href="<?php echo esc_url($link_zap); ?>" target="_blank" class="btn-whatsapp">
                    <svg class="zap-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Compartilhar Oferta
                </a>
            </div>
        </div>

        <div class="oferta-review-area">
            <?php if($video): ?>
                <h3 class="review-titulo">Review em Vídeo</h3>
                <div class="video-container"><?php echo wp_oembed_get($video); ?></div>
            <?php endif; ?>

            <?php if(get_the_content()): ?>
                <h3 class="review-titulo">Especificações</h3>
                <div class="conteudo-texto"><?php the_content(); ?></div>
            <?php endif; ?>
        </div>
    </div>
    <?php endwhile; ?>
</main>

<script>
function copiar(btnElement) {
    var cupomTexto = document.getElementById("cpCode").innerText;
    function feedbackSucesso() {
        var textoOriginal = btnElement.innerText;
        btnElement.innerText = "COPIADO!";
        btnElement.classList.add("copiado");
        setTimeout(function() {
            btnElement.innerText = textoOriginal;
            btnElement.classList.remove("copiado");
        }, 2000);
    }
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(cupomTexto).then(feedbackSucesso);
    } else {
        var textArea = document.createElement("textarea");
        textArea.value = cupomTexto;
        textArea.style.position = "fixed"; textArea.style.left = "-9999px";
        document.body.appendChild(textArea); textArea.focus(); textArea.select();
        try { document.execCommand('copy'); feedbackSucesso(); } catch (err) { }
        document.body.removeChild(textArea);
    }
}
</script>

<?php get_footer(); ?>