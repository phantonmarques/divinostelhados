<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="banner-ad bg-dark" aria-label="Banner de contato cabeçalho">
        <div class="banner-ad-container">
            <div class="banner-ad-contact animate-fade-in-down">
                <ul>
                    <li>
                        <a href="https://maps.app.goo.gl/8nRruRkGnu8kbZY86" rel="noopener noreferrer" target="_blank" aria-label="Localização no Google Maps">
                            <i class="fas fa-map"></i>
                            <span>Parque do Guará Gleba 2 - Brasília, DF</span>
                    </a>
                    </li>
                    <li>
                        <a href="mailto:centralvilela@gmail.com" aria-label="Entre em contato por e-mail">
                            <i class="fas fa-envelope"></i>
                            <span>centralvilela@gmail.com</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="banner-social animate-fade-in-right">
                <ul>
                    <li>
                        <a target="_blank" href="https://www.facebook.com/share/19n7umQ7ku/?mibextid=wwXIfr" aria-label="Visite nossa página no Facebook" rel="noopener noreferrer">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://instagram.com/divinostelhados" aria-label="Nosso instagram" rel="noopener noreferrer">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>    
        </div>
    </div>

    <header class="initial<?php if ( ! is_front_page() ) echo ' page'; ?>" aria-label="Menu">
        <div class="container-main">
            <a class="logo animate-fade-in-left" href="/">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/dist/images/logo-delivery-120.webp'); ?>"
                     srcset="<?php echo esc_attr(roof_webp_srcset('logo-delivery', [120, 144, 168, 200, 240, 360])); ?>"
                     sizes="(max-width: 768px) 80px, 120px" width="120" height="120" alt="Logo">
            </a>
            <nav class="animate-fade-in">
                <?php
                    wp_nav_menu([
                        'theme_location' => 'menu-principal',
                        'container'      => false,
                        'menu_class'     => 'menu',
                        'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                    ]);
                ?>

                <div class="menu-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                
                <div class="menu-sidebar">
                    <?php
                        wp_nav_menu([
                            'theme_location' => 'menu-mobile',
                            'container'      => false,
                            'menu_class'     => 'menu-mobile',
                            'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                        ]);
                    ?>
                </div>
            </nav>
        </div>
    </header>
