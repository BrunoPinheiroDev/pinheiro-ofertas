<?php /* Template Name: Contato Profissional */ get_header(); ?>

<style>
    /* Estilos específicos para o Card de Consultoria */
    .card-consultoria {
        text-align: center;
        padding: 30px 20px !important;
    }

    .icon-consultoria {
        margin-bottom: -10px !important; /* Puxa o título para cima */
        line-height: 0;
    }

    .consultoria-img {
        width: 180px !important; /* Aumentado para ter mais presença */
        height: auto;
        display: inline-block;
    }

    .card-consultoria h3 {
        margin-top: 0 !important;
        margin-bottom: 15px !important;
        font-size: 22px;
        font-weight: 800;
        color: #1A4D3E;
    }

    .card-consultoria p {
        margin-bottom: 20px;
        font-size: 15px;
        line-height: 1.4;
    }
</style>

<main class="container">
    <div class="pagina-institucional contato-wrapper">
        <header class="contato-header">
            <h1>Fale com Pinheiro!</h1>
            <p>Dúvidas, parcerias ou aquela ajudinha extra para escolher seu próximo gadget.</p>
        </header>

        <div class="contato-grid">
            <aside class="contato-info">
                <div class="card-consultoria">
                    <div class="icon-consultoria">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/consultoria-icon.png" 
                             alt="Consultoria" 
                             class="consultoria-img">
                    </div>
                    <h3>Consultoria Grátis</h3>
                    <p>Está em dúvida sobre qual celular, notebook ou tablet comprar? Eu te ajudo a encontrar o melhor custo-benefício em tempo real.</p>
                    <a href="https://wa.me/5571988746713?text=Olá! Preciso de uma consultoria para comprar um produto. Pode me ajudar?" 
                       class="btn-consultoria" target="_blank">
                       Chamar no WhatsApp
                    </a>
                </div>

                <div class="contato-faq">
                    <h4>Dúvidas Frequentes</h4>
                    <details>
                        <summary>Como funcionam os cupons?</summary>
                        <p>Basta copiar o código e colar na tela de pagamento da loja oficial.</p>
                    </details>
                    <details>
                        <summary>As ofertas são seguras?</summary>
                        <p>Sim! Só postamos links de lojas oficiais e verificadas.</p>
                    </details>
                </div>
            </aside>

            <section class="contato-formulario">
                <h3>Envie uma mensagem</h3>
                <?php 
                // Exibe o formulário do Contact Form 7 configurado
                echo do_shortcode('[contact-form-7 id="a97181d" title="Formulário Contato Profissional"]'); 
                ?>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>