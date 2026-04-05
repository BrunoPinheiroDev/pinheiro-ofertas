<?php /* Template Name: Home */ get_header(); ?>

<main class="container site-main-home">
  
  <section class="header-navegacao">
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
                if (!empty($termos) && !is_wp_error($termos)) {
                    foreach ($termos as $termo) {
                        $is_active = ($cat_atual == $termo->slug) ? 'active' : '';
                        echo '<a href="?categoria=' . $termo->slug . '" class="cat-pill ' . $is_active . '" data-name="' . strtolower($termo->name) . '">' . $termo->name . '</a>';
                    }
                }
                ?>
            </div>
        </div>
  </section>

  <section class="banner-transparencia">
      <div class="banner-content">
          <p><strong>Aviso importante:</strong> As ofertas são encontradas em tempo real e os estoques são limitados. A loja varejista pode alterar os preços a qualquer momento!</strong></p>
      </div>
  </section>

  <?php if (!get_search_query() && empty($cat_atual)) : ?>
  <section class="ofertas-destaque-topo" style="margin-top: 20px;">
      <h2 class="titulo-secao" style="font-size: 20px; font-weight: 800; margin-bottom: 20px;">Super Ofertas</h2>
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
              // ALTERADO: Usando permalink para ir para página interna
          ?>
            <a href="<?php the_permalink(); ?>" class="card-destaque-v">
                <div class="d-img"><?php if (has_post_thumbnail()) the_post_thumbnail('medium'); ?></div>
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

  <section class="ofertas-lista">
    <?php if (get_search_query()) : ?>
        <p class="resultado-aviso">Resultados para: <strong>"<?php echo get_search_query(); ?>"</strong></p>
    <?php endif; ?>

    <div class="ofertas-grid">
      <?php
      $args = array(
        'post_type'      => 'pinheiro_oferta',
        'posts_per_page' => 20,
        's'              => get_search_query(),
        'meta_key'       => '_preco_produto',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC'
      );

      if (!empty($cat_atual)) {
          $args['tax_query'] = array(array('taxonomy' => 'categoria_oferta', 'field' => 'slug', 'terms' => $cat_atual));
      }

      $ofertas = new WP_Query($args);

      if ($ofertas->have_posts()) :
        while ($ofertas->have_posts()) : $ofertas->the_post();
          $id = get_the_ID();
          $preco_raw = get_post_meta($id, '_preco_produto', true);
          $tipo_pgto = get_post_meta($id, '_tipo_pagamento', true); 
          $condicoes = get_post_meta($id, '_condicoes_pagamento', true);
          $loja      = get_post_meta($id, '_nome_loja', true);
          $cupom     = get_post_meta($id, '_cupom_oferta', true);
          
          $preco_display = ($preco_raw) ? number_format($preco_raw / 100, 2, ',', '.') : '';
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
      <?php else : ?><p>Nenhuma oferta encontrada.</p><?php endif; ?>
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
        pills[i].style.display = (txtValue.indexOf(filter) > -1) ? "" : "none";
    }
}
</script>

<?php get_footer(); ?>