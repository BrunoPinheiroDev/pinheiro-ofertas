<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <h4 class="footer-title">Pinheiro Ofertas</h4>
                <p>Curadoria manual das melhores ofertas de tecnologia e eletrônicos. Economize tempo e dinheiro com segurança.</p>
            </div>

            <div class="footer-col">
                <h4 class="footer-title">Navegação</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo home_url(); ?>">Início</a></li>
                    <li><a href="<?php echo home_url('/politica-de-privacidade'); ?>">Política de Privacidade</a></li>
                    <li><a href="<?php echo home_url('/termos-de-uso'); ?>">Termos de Uso</a></li>
                    <li><a href="<?php echo home_url('/contato'); ?>">Contato</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4 class="footer-title">Transparência</h4>
                <p class="aviso-legal">O Pinheiro Ofertas participa de programas de associados (Amazon, Magalu, etc.). Ao comprar pelos nossos links, podemos receber comissões sem custo extra para você.</p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Ofertas Pinheiro. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>

<a href="https://wa.me/5571988746713?text=Olá! Vim pelo site Pinheiro Ofertas e tenho uma dúvida." 
   class="whatsapp-float" 
   target="_blank" 
   rel="noopener noreferrer"
   style="position: fixed; bottom: 50px; right: 20px; z-index: 9999; text-decoration: none; width: 40px; height: 40px;">
    
    <img src="<?php echo get_template_directory_uri(); ?>/whatsapp-icon.png" 
         alt="WhatsApp" 
         style="width: 40px; height: 40px; object-fit: contain; display: block;">
</a>

<script>
function copiarCupom(texto, elemento) {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(texto).then(() => {
            const original = elemento.innerHTML;
            elemento.innerHTML = '<span style="color: #27ae60; font-weight: bold;">Copiado!</span>';
            setTimeout(() => { elemento.innerHTML = original; }, 2000);
        });
    }
}
// Apelidos para compatibilidade com outros arquivos
function copiarCupomIndex(t, e) { copiarCupom(t, e); }
function copiarCupomCat(t, e) { copiarCupom(t, e); }
</script>

<?php wp_footer(); ?>
</body>
</html>