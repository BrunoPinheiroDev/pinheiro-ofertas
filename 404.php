<?php 
/**
 * Template para Erro 404 (Página não encontrada)
 * Objetivo: Recuperar o usuário e levá-lo de volta às ofertas
 */
get_header(); 
?>

<main class="container" style="text-align: center; padding: 100px 20px;">
    
    <div class="error-404-content" style="max-width: 600px; margin: 0 auto;">
        <span style="font-size: 80px;">🌲</span>
        <h1 style="color: #1A4D3E; font-size: 48px; font-weight: 800; margin: 20px 0 10px;">Opa! Essa oferta fugiu.</h1>
        <p style="font-size: 18px; color: #666; line-height: 1.6; margin-bottom: 40px;">
            Parece que o link que você clicou não existe mais ou a oferta expirou. 
            Mas não se preocupe, o Pinheiro encontrou outras promoções quentinhas para você!
        </p>

        <div class="actions" style="display: flex; gap: 15px; justify-content: center;">
            <a href="<?php echo home_url(); ?>" class="btn-ver-oferta" style="display: inline-block; padding: 15px 30px; background: #1A4D3E; color: #fff; text-decoration: none; border-radius: 6px; font-weight: bold;">
                Ver Ofertas do Dia ➔
            </a>
            <a href="<?php echo home_url('/contato'); ?>" style="display: inline-block; padding: 15px 30px; border: 2px solid #1A4D3E; color: #1A4D3E; text-decoration: none; border-radius: 6px; font-weight: bold;">
                Me Ajuda, Pinheiro!
            </a>
        </div>
    </div>

</main>

<?php get_footer(); ?>