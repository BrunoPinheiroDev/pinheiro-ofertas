<?php 
/**
 * Template para Resultados de Busca - Pinheiro Ofertas
 * Status: Layout idêntico à Home (Grid de 3 colunas)
 */
get_header(); 
?>

<main class="container" style="padding-top: 40px;">

    <header class="search-header" style="margin-bottom: 40px; border-bottom: 2px solid #1A4D3E; padding-bottom: 15px;">
        <h1 style="color: #1A4D3E; font-size: 24px; font-weight: 800; margin: 0;">
            <span style="color: #888; font-size: 16px; font-weight: 400; text-transform: uppercase;">Resultados para:</span> 
            "<?php echo get_search_query(); ?>"
        </h1>
    </header>

    <section class="ofertas-lista">
        <div class="ofertas-grid">
            <?php if (have_posts()) : while (have_posts()) : the_post(); 
                $id = get_the_ID();
                $preco_raw = get_post_meta($id, '_preco_produto', true);
                $loja      = get_post_meta($id, '_nome_loja', true);
                $cupom     = get_post_meta($id, '_cupom_oferta', true);
                
                $preco_display = ($preco_raw) ? number_format($preco_raw / 100, 2, ',', '.') : '---';
            ?>

                <div class="oferta-card">
                    <div class="card-col-img">
                        <a href="<?php the_permalink(); ?>" style="text-decoration:none; display:flex; justify-content:center;">
                            <?php if (has_post_thumbnail()) the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                    
                    <div class="card-col-info">
                        <div class="tags-row">
                            <?php if($loja): ?><span class="badge-loja"><?php echo esc_html($loja); ?></span><?php endif; ?>
                        </div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        
                        <?php if ($cupom) : ?>
                            <div class="cupom-wrapper" onclick="event.preventDefault(); copiarCupomBusca('<?php echo esc_js($cupom); ?>', this)">
                                <span class="cupom-label">CUPOM:</span>
                                <strong class="cupom-code"><?php echo esc_html($cupom); ?></strong>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="card-col-action">
                        <div class="preco-atual">R$ <?php echo $preco_display; ?></div>
                        <a href="<?php the_permalink(); ?>" class="btn-ver-oferta">Ver Detalhes</a>
                    </div>
                </div>

            <?php endwhile; else : ?>
                <div style="text-align: center; padding: 60px 20px; grid-column: 1 / -1;">
                    <p style="font-size: 20px; color: #666;">Putz, não encontramos nada para "<strong><?php echo get_search_query(); ?></strong>". 😕</p>
                    <p style="margin-bottom: 30px;">Que tal tentar outro termo ou voltar para o início?</p>
                    <a href="<?php echo home_url(); ?>" class="btn-ver-oferta" style="display: inline-block;">Ver todas as ofertas</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <div class="paginacao" style="margin: 50px 0; text-align: center;">
        <?php echo paginate_links(); ?>
    </div>

</main>

<script>
function copiarCupomBusca(texto, elemento) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(texto).then(() => {
            const original = elemento.innerHTML;
            elemento.innerHTML = '<span style="color: #27ae60; font-weight: bold;">Copiado!</span>';
            setTimeout(() => { elemento.innerHTML = original; }, 2000);
        });
    }
}
</script>

<?php get_footer(); ?>