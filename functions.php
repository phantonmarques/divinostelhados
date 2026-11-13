<?php

/**
 * Theme Name: Roof
 */

/** Remove scripts e plugins desnecessários */
remove_action('wp_head', 'wp_generator');                     // Remove meta generator
remove_action('wp_head', 'rsd_link');                         // Remove RSD link
remove_action('wp_head', 'wlwmanifest_link');                 // Remove Windows Live Writer
remove_action('wp_head', 'feed_links', 2);                    // Remove RSS feeds
remove_action('wp_head', 'feed_links_extra', 3);              // Remove extra feeds
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);      // Remove shortlink
remove_action('wp_head', 'rest_output_link_wp_head');         // Remove REST API link
remove_action('wp_head', 'wp_oembed_add_discovery_links');    // Remove oEmbed discovery
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

add_filter('tiny_mce_plugins', function($plugins) {
    return is_array($plugins) ? array_diff($plugins, ['wpemoji']) : [];
});

add_filter('emoji_svg_url', '__return_false');

add_filter('wpcf7_autop_or_not', '__return_false');

add_filter( 'wpcf7_form_elements', function( $content ) {
	return preg_replace( '/<span class="wpcf7-form-control-wrap[^>]*>(.*?)<\/span>/', '$1', $content );
});

add_action('wp_enqueue_scripts', function() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
    wp_deregister_style('classic-theme-styles');
}, 20);

/** Scripts Tema */
function roof_scripts() {
    $css_main = get_template_directory() . '/dist/css/style.min.css';

    wp_enqueue_style('roof-styles', get_template_directory_uri() . '/dist/css/style.min.css', [], filemtime($css_main));
    wp_enqueue_script('roof-scripts', get_template_directory_uri() . '/dist/js/main.min.js', [], filemtime(get_template_directory() . '/dist/js/main.min.js'), true);
}

add_action('wp_enqueue_scripts', 'roof_scripts');

function home_scripts() {
    if (is_front_page()) {
        wp_enqueue_script('roof-home-scripts', get_template_directory_uri() . '/dist/js/external.min.js', [], filemtime(get_template_directory() . '/dist/js/external.min.js'), true);
    }
}

add_action('wp_enqueue_scripts', 'home_scripts');

add_filter('script_loader_tag', function ($tag, $handle) {
    if ($handle === 'roof-home-scripts') {
        return str_replace('src=', 'defer src=', $tag);
    }
    return $tag;
}, 10, 2);

function home_preload_scripts() {
    $vendor_styles = [
        get_template_directory_uri() . '/dist/vendor/flaticon/flaticon.css',
        get_template_directory_uri() . '/dist/vendor/fontawesome-6.7.2/css/all.min.css',
    ];

    foreach ($vendor_styles as $href) {
        echo "<link rel='preload' as='style' href='{$href}' onload=\"this.onload=null;this.rel='stylesheet'\">\n";
        echo "<noscript><link rel='stylesheet' href='{$href}'></noscript>\n";
    }
}

add_action('wp_head', 'home_preload_scripts');

/** Menu */

function registrar_menus() {
    register_nav_menus([
        'menu-principal' => 'Menu Principal',
        'menu-mobile'    => 'Menu Mobile',
        'menu-footer'    => 'Menu Rodapé'
    ]);
}

add_action('after_setup_theme', 'registrar_menus');

function add_menu_link($items, $args) {
    if (in_array($args->theme_location, ['menu-principal', 'menu-mobile'], true)) {
        $items .= '<li><a class="btn-default" rel="noopener noreferrer" target="_blank" href="https://wa.me/5561999963646">Solicite um orçamento</a></li>';
    }
    
    return $items;
}

add_filter('wp_nav_menu_items', 'add_menu_link', 10, 2);

function add_class_to_menu_link($atts, $item, $args, $depth) {
    if ($args->theme_location === 'menu-principal') {
        $atts['class'] = 'menu-link';
    }

    if ($args->theme_location === 'menu-mobile') {
        $atts['class'] = 'menu-link-mobile';
    }

    return $atts;
}

add_filter('nav_menu_link_attributes', 'add_class_to_menu_link', 10, 4);


/** Head */
add_action('wp_head', function () { ?>
    <meta name="author" content="DAMC Developer"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>

    <meta name="theme-color" content="#ffffff">

    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Merriweather:wght@900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Merriweather:wght@900&display=swap" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Merriweather:wght@900&display=swap">
    </noscript>

    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/dist/vendor/flaticon/flaticon.woff2" as="font" type="font/woff2" crossorigin>

    <link rel="preload" as="style" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    </noscript>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
<?php });

function preload_main_lcp_image() {
    if (is_front_page()) {
        if (wp_is_mobile()) { ?>
            <link 
                rel="preload" 
                as="image" 
                href="<?php echo get_template_directory_uri(); ?>/dist/images/header-banner-500.webp"
                type="image/webp"
                fetchpriority="high"
                importance="high"
            />
            <link 
                rel="preload" 
                as="image" 
                href="<?php echo get_template_directory_uri(); ?>/dist/images/services-types/residential-roof.webp"
                type="image/webp"
                fetchpriority="high"
                importance="high"
            />
        <?php } else { ?>    
            <link 
                rel="preload" 
                as="image" 
                href="<?php echo get_template_directory_uri(); ?>/dist/images/header-banner.webp" 
                media="(min-width: 501px)"
                imagesrcset="
                    <?php echo get_template_directory_uri(); ?>/dist/images/header-banner-768.webp 768w,
                    <?php echo get_template_directory_uri(); ?>/dist/images/header-banner-1200.webp 1200w,
                    <?php echo get_template_directory_uri(); ?>/dist/images/header-banner.webp 2000w
                "
                imagesizes="100vw"
                type="image/webp"
            />
        <?php } ?>
        <link rel="preload" as="image" href="<?php echo get_template_directory_uri(); ?>/dist/images/background/reason.webp" type="image/webp">
    <?php }
}

add_action('wp_head', 'preload_main_lcp_image', 1);


/** Add functions WP */

add_action('add_meta_boxes', function() {
    add_meta_box(
        'postimagediv',
        __('Imagem destacada'),
        'post_thumbnail_meta_box',
        'post',
        'side',
        'low'
    );
}, 99);

function roof_setup() {
    add_theme_support('title-tag');
    add_theme_support('html5', ['search-form', 'gallery', 'caption']);
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_post_type_support('post', 'thumbnail');
}

add_action('after_setup_theme', 'roof_setup');