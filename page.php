<?php get_header(); ?>

<main class="container">
    <article class="site-main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <header class="entry-header" style="border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 30px;">
                <h1 class="entry-title" style="color: #1A4D3E; margin: 0; font-size: 2.5rem; font-weight: 800;">
                    <?php the_title(); ?>
                </h1>
            </header>

            <div class="entry-content" style="font-size: 16px; line-height: 1.8; color: #444;">
                <?php the_content(); ?>
            </div>
        <?php endwhile; endif; ?>
    </article>
</main>

<?php get_footer(); ?>