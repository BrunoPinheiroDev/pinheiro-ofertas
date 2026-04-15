<?php /* Template Name: Home */ get_header(); ?>

<main class="container site-main-home">
  
  <section class="header-navegacao">
        <h1 style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); border: 0;">
            Pinheiro Ofertas - Melhores Promoções de Tecnologia e Eletrônicos Selecionadas Manualmente
        </h1>

        <div class="busca-global-wrapper">
            <form role="search" method="get" class="search-form-produtos" action="<?php echo home_url('/'); ?>">
                <div class="input-group">
                    <span class="lupa-icon">🔍</span>
                    <input type="text" class="search-field" placeholder="O que você está procurando hoje?" value="<?php echo get_search_query(); ?>" name="s" />
                </div>
                <button type="submit" class="search-submit">Buscar</button>
            </form>
        </div>

        <div class="filtros-categorias-wrapper">
            <div class="cat-search-mini">
                <input type="text" id="filtro-cat" placeholder="Filtrar categorias..." onkeyup="filtrarCategorias()">
            </div>
            <div class="scroll-horizontal" id="lista-cats">
                <?php 
                    $cat_atual = isset($_GET['categoria']) ? sanitize_text_field($_GET['categoria']) : '';
                    $active_all = empty($cat_atual) ? 'active' : '';
                ?>
                <a href="<?php echo home_url(); ?>" class="cat-pill <?php echo $active_all; ?>" data-name="todas">Todas</a>
                
                <?php
                $termos = get_terms(array('taxonomy' => 'categoria_oferta', 'hide_empty' => false, 'orderby' => 'count', 'order' => 'DESC'));
                foreach ($termos as $termo) :
                    $active = ($cat_atual == $termo->slug) ? 'active' : '';
                    echo '<a href="' . esc_url(get_term_link($termo)) . '" class="cat-pill ' . $active . '" data-name="' . esc_attr($termo->slug) . '">' . esc_html($termo->name) . '</a>';
                endforeach;
                ?>
            </div>
        </div>
  </section>

  <?php if (!get_search_query() && empty($cat_atual)) : ?>
  <section class="ofertas-destaque-topo" style="margin-top: 20px;">
      <h2 class="titulo-secao" style="font-size: 20px; font-weight: 800; margin-bottom: 20px; color: #1A4D3E; border-bottom: 2px solid #1A4D3E; padding-bottom: 10px;">Super Ofertas</h2>
      <div class="destaques-grid-topo">
          <?php
          $destaques = new WP_Query(array(
              'post_type'      => 'pinheiro_oferta',
              'posts_per_page' => 3,
              'meta_query'     => array(array('key' => '_oferta_destaque', 'value' => '1'))
          ));

          if ($destaques->have_posts()) : while ($destaques->have_posts()) : $destaques->the_post();
              $preco_d = get_post_meta(get_the_ID(), '_preco_produto', true);
              $loja_d  = get_post_meta(get_the_ID(), '_nome_loja', true);
          ?>
            <a href="<?php the_permalink(); ?>" class="card-destaque-v">
                <div class="d-img">
                    <?php if (has_post_thumbnail()) {
                        the_post_thumbnail('medium', [
                            'alt' => get_the_title(),
                            'loading' => 'lazy'
                        ]);
                    } ?>
                </div>
                <div class="d-info">
                    <?php if($loja_d): ?><span class="badge-loja"><?php echo esc_html($loja_d); ?></span><?php endif; ?>
                    <h3 style="font-size: 15px; margin: 10px 0;"><?php the_title(); ?></h3>
                    <div class="preco-destaque">R$ <?php echo number_format($preco_d/100, 2, ',', '.'); ?></div>
                </div>
            </a>
          <?php endwhile; wp_reset_postdata(); endif; ?>
      </div>
  </section>
  <?php endif; ?>

  <section class="ofertas-recentes" style="margin-top: 40px;">
    <h2 style="color: #1A4D3E; font-size: 20px; font-weight: 800; margin-bottom: 20px; border-bottom: 2px solid #1A4D3E; padding-bottom: 10px;">
        Ofertas Selecionadas
    </h2>

    <div class="ofertas-grid">
      <?php 
      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
      $args = array(
          'post_type'      => 'pinheiro_oferta',
          'posts_per_page' => 12,
          'paged'          => $paged
      );
      
      $query = new WP_Query($args);
      
      if ($query->have_posts()) : 
          while ($query->have_posts()) : $query->the_post(); 
            $id = get_the_ID();
            $preco_raw = get_post_meta($id, '_preco_produto', true);
            $loja      = get_post_meta($id, '_nome_loja', true);
            $cupom     = get_post_meta($id, '_cupom_oferta', true);
            $preco_display = ($preco_raw) ? number_format($preco_raw / 100, 2, ',', '.') : '---';
      ?>
        
        <div class="oferta-card">
            <div class="card-img-col">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium', [
                            'alt' => get_the_title(),
                            'loading' => 'lazy'
                        ]); ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="card-info-col">
                <div class="tags-row">
                    <?php if($loja): ?><span class="badge-loja"><?php echo esc_html($loja); ?></span><?php endif; ?>
                </div>
                <h3 style="font-size: 0.95rem; margin: 5px 0; line-height: 1.2;">
                    <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: #222;"><?php the_title(); ?></a>
                </h3>
                
                <?php if ($cupom) : ?>
                    <div class="cupom-wrapper" onclick="event.preventDefault(); copiarCupom('<?php echo esc_js($cupom); ?>', this)">
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

      <?php endwhile; wp_reset_postdata(); ?>
      <?php else : ?>
        <p style="grid-column: 1/-1; text-align: center; padding: 40px;">Aguardando novas ofertas incríveis... 🌲</p>
      <?php endif; ?>
    </div>
  </section>
</main>

<script>
function filtrarCategorias() {
    var input = document.getElementById("filtro-cat");
    var filter = input.value.toLowerCase();
    var pills = document.getElementsByClassName("cat-pill");
    for (var i = 0; i < pills.length; i++) {
        var txtValue = pills[i].getAttribute("data-name") || "";
        pills[i].style.display = (txtValue.toLowerCase().indexOf(filter) > -1) ? "" : "none";
    }
}
</script>

<?php get_footer(); ?>