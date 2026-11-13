    <div class="whatsapp-container animate-fade-in">
        <a href="https://wa.me/5561999963646" target="_blank" class="whatsapp" rel="noopener noreferrer" aria-label="Contato pelo whatsapp">
            <svg width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M28.4778 25.418C28.044 26.6459 26.3196 27.6618 24.9444 27.9589C24.003 28.1587 22.7754 28.3169 18.639 26.6027C13.9932 24.678 7.542 17.8217 7.542 13.2592C7.542 10.9365 8.8812 8.23184 11.223 8.23184C12.3498 8.23184 12.5982 8.25381 12.969 9.14326C13.4028 10.1912 14.4612 12.773 14.5872 13.0377C15.1074 14.1234 14.058 14.759 13.2966 15.7043C13.0536 15.9888 12.7782 16.2964 13.086 16.8258C13.392 17.3443 14.4504 19.0693 16.0056 20.4539C18.0144 22.2436 19.6434 22.815 20.2266 23.0581C20.6604 23.2382 21.1788 23.1962 21.4956 22.8577C21.897 22.4238 22.3956 21.7038 22.9032 20.9944C23.2614 20.4867 23.7168 20.4233 24.1938 20.6033C24.516 20.715 28.611 22.6167 28.7838 22.921C28.9116 23.1425 28.9116 24.19 28.4778 25.418ZM18.0036 0H17.9946C8.07119 0 0 8.07363 0 18C0 21.936 1.26901 25.5876 3.42721 28.5495L1.18441 35.238L8.10181 33.0275C10.9476 34.9109 14.3442 36 18.0036 36C27.927 36 36 27.9264 36 18C36 8.07363 27.927 0 18.0036 0Z" />
                </g>
            </svg>
        </a>
    </div>
    <footer aria-label="Rodapé">
        <div class="container">
            <div class="footer-social">
                <a class="logo animate-fade-in-left" href="/" aria-label="Logo rodapé">
                    <img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo.svg" width="200" height="50" alt="Divinos Telhados - Especialista em Investimentos">
                </a>
                <a class="whatsapp animate-fade-in" rel="noopener noreferrer" target="_blank" href="https://wa.me/5561999963646">
                    <i class="fab fa-whatsapp icon"></i>
                    <p>Vamos transformar planos em realidade?</p>
                    <span>Fale agora pelo WhatsApp</span>
                </a>
                <ul class="social-list animate-fade-in-right">
                    <li>
                        <a target="_blank" href="https://www.facebook.com/share/19n7umQ7ku/?mibextid=wwXIfr" aria-label="Visite nossa página no Facebook" rel="noopener noreferrer">
                            <i class="fab fa-facebook icon"></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://instagram.com/divinostelhados" aria-label="Nosso instagram" rel="noopener noreferrer">
                            <i class="fab fa-instagram icon"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-info">
                <div class="footer-contact animate-fade-in-left">
                    <h3>Contato</h3>
                    <ul>
                        <li>
                            <a href="mailto:centralvilela@gmail.com" aria-label="Entre em contato por e-mail">
                                <i class="fas fa-envelope"></i>
                                centralvilela@gmail.com
                            </a>
                        </li>
                        <li>
                            <a href="tel:+5561992371373" aria-label="Entre em contato por telefone">
                                <i class="fas fa-phone"></i>
                                (61) 99237-1373
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/5561999963646" rel="noopener noreferrer" target="_blank" aria-label="Entre em contato pelo WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                                (61) 99996-3646
                            </a>
                        </li>
                        <li>
                            <a href="https://maps.app.goo.gl/8nRruRkGnu8kbZY86" rel="noopener noreferrer" target="_blank" aria-label="Localização no Google Maps">
                                <i class="fas fa-map"></i>
                                <span class="address">
                                    smas area especial, Parque do Guará Gleba 2<br />Brasília, DF, 71215-300
                                </span>
                            </a>
                        </li>
                        <li>
                            <span>
                                <i class="fas fa-clock"></i>
                                Segunda a Sexta, 8:00 - 18:00
                            </span>
                        </li>
                    </ul>
                </div>
                <?php
                    $location = 'menu-footer';

                    if (has_nav_menu($location)) {
                        $menu = wp_get_nav_menu_object(get_nav_menu_locations()[$location]);
                        $menuItems = wp_get_nav_menu_items($menu->term_id);

                        if (!empty($menuItems) && count($menuItems) > 0) { ?>
                            <div class="footer-services animate-fade-in">
                                <h3>Serviços</h3>
                                <?php 
                                    wp_nav_menu([
                                        'theme_location' => $location,
                                        'container'      => false,
                                        'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                                    ]); 
                                ?>
                            </div>
                        <?php }
                    } 
                ?>
                
                <div class="footer-flags animate-fade-in-right">
                    <h3>Meios de pagamento</h3>
                    <ul>
                        <li><img src="<?php echo get_template_directory_uri(); ?>/dist/images/flags/visa.webp" width="50" height="30" alt="Visa"></li>
                        <li><img src="<?php echo get_template_directory_uri(); ?>/dist/images/flags/master.webp" width="50" height="30" alt="Mastercard"></li>
                        <li><img src="<?php echo get_template_directory_uri(); ?>/dist/images/flags/elo.webp" width="50" height="30" alt="Elo"></li>
                        <li><img src="<?php echo get_template_directory_uri(); ?>/dist/images/flags/pix.webp" width="50" height="30" alt="Pix"></li>
                    </ul>
                </div>
            </div>
            <p class="recaptcha-message animate-fade-in">
                Este site é protegido por reCAPTCHA e a <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">Política de Privacidade</a> e os <a href="https://policies.google.com/terms" target="_blank" rel="noopener noreferrer">Termos de Serviço</a> do Google se aplicam.
            </p>
        </div>
        <div class="copy">
            <div class="container">
                <p class="animate-fade-in-left">Todos os direitos reservados © 2024 Divinos Telhados.</p>
                <a class="logo-dev animate-fade-in-right" href="https://damcdeveloper.com" rel="noopener noreferrer" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/dist/images/damc.webp" width="156" height="40" alt="Desenvolvido por Daniel Alexander Marques Cabredo">
                </a>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
    </body>
</html>