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
    $directory = get_template_directory();
    $uri = get_template_directory_uri();
    $is_home = is_front_page();
    $css_main = $directory . '/dist/css/style.min.css';
    $inline_css = $is_home && is_readable($css_main) ? file_get_contents($css_main) : false;

    if ($inline_css !== false && $inline_css !== '') {
        // Resolve as URLs de fundo a partir do tema, pois o CSS fica no HTML.
        $image_base = esc_url_raw($uri . '/dist/images/');
        $inline_css = str_replace('url(../images/', 'url(' . $image_base, $inline_css);

        wp_register_style('roof-styles', false);
        wp_enqueue_style('roof-styles');
        wp_add_inline_style('roof-styles', $inline_css);
    } else {
        wp_enqueue_style('roof-styles', $uri . '/dist/css/style.min.css', [], filemtime($css_main));
    }

    $script_path = '/dist/js/main.min.js';
    $script_file = $directory . $script_path;
    $inline_script = $is_home && is_readable($script_file) ? file_get_contents($script_file) : false;

    if ($inline_script !== false && $inline_script !== '') {
        wp_register_script('roof-scripts', false, [], null, true);
        wp_enqueue_script('roof-scripts');
        wp_add_inline_script('roof-scripts', $inline_script);
    } else {
        wp_enqueue_script('roof-scripts', $uri . $script_path, [], filemtime($script_file), true);
    }
}

add_action('wp_enqueue_scripts', 'roof_scripts');

add_action('wp_enqueue_scripts', function () {
    if (is_front_page()) {
        // O WordPress aplica defer somente quando a cadeia permite.
        wp_script_add_data('swv', 'strategy', 'defer');
        wp_script_add_data('contact-form-7', 'strategy', 'defer');
    }
}, 100);

add_filter('wp_script_attributes', function ($attributes) {
    $form_scripts = ['wp-hooks-js', 'wp-i18n-js', 'swv-js', 'contact-form-7-js'];
    if (!empty($attributes['src']) && in_array($attributes['id'] ?? '', $form_scripts, true) && is_front_page()) {
        $attributes['fetchpriority'] = 'low';
    }

    return $attributes;
});

add_filter('style_loader_tag', function ($tag, $handle, $href, $media) {
    if ($handle !== 'contact-form-7' || $media !== 'all' || !is_front_page() || !class_exists('WP_HTML_Tag_Processor')) {
        return $tag;
    }

    $link = new WP_HTML_Tag_Processor($tag);
    if (!$link->next_tag('link') || $link->get_attribute('rel') !== 'stylesheet' || $link->get_attribute('onload') !== null) {
        return $tag;
    }

    $link->set_attribute('media', 'print');
    $link->set_attribute('onload', "this.onload=null;this.media='all'");

    return $link->get_updated_html() . '<noscript>' . $tag . '</noscript>';
}, 10, 4);

function home_scripts() {
    if (is_front_page()) {
        $directory = get_template_directory();
        $uri = get_template_directory_uri();

        wp_enqueue_script('roof-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], null, false);
        wp_enqueue_script('roof-home-scripts', $uri . '/dist/js/external.min.js', ['roof-swiper'], filemtime($directory . '/dist/js/external.min.js'), true);
    }
}

add_action('wp_enqueue_scripts', 'home_scripts');

add_filter('script_loader_tag', function ($tag, $handle) {
    if (in_array($handle, ['roof-swiper', 'roof-home-scripts'], true)) {
        return str_replace('<script ', '<script defer ', $tag);
    }
    return $tag;
}, 10, 2);

function roof_print_vendor_styles() {
    $directory = get_template_directory();
    $uri = get_template_directory_uri();
    $flaticon = '/dist/vendor/flaticon/flaticon.css';
    $fontawesome = '/dist/vendor/fontawesome-6.7.2/css/all.min.css';
    $vendor_styles = [
        $uri . $flaticon . '?ver=' . filemtime($directory . $flaticon),
        $uri . $fontawesome . '?ver=' . filemtime($directory . $fontawesome),
    ];

    if (is_front_page()) {
        $vendor_styles[] = 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css';
    }

    foreach ($vendor_styles as $href) {
        $href = esc_url($href);
        echo "<link rel='preload' as='style' href='{$href}' onload=\"this.onload=null;this.rel='stylesheet'\">\n";
        echo "<noscript><link rel='stylesheet' href='{$href}'></noscript>\n";
    }
}

add_action('wp_head', 'roof_print_vendor_styles');

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

add_action('wp', function () {
    if (!is_front_page()) {
        return;
    }

    $path = '/dist/images/og-image.jpg';
    $file = get_template_directory() . $path;
    $image = is_readable($file) ? wp_getimagesize($file) : false;

    if (!$image) {
        return;
    }

    add_filter('wpseo_opengraph_image', fn() => get_template_directory_uri() . $path);
    add_filter('wpseo_opengraph_image_width', fn() => $image[0]);
    add_filter('wpseo_opengraph_image_height', fn() => $image[1]);
    add_filter('wpseo_opengraph_image_type', fn() => $image['mime']);
});


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

<?php });

function roof_webp_srcset($asset, $widths, $original_width = null) {
    $base = get_template_directory_uri() . '/dist/images/' . $asset;
    $candidates = [];

    foreach ($widths as $width) {
        $candidates[] = "{$base}-{$width}.webp {$width}w";
    }

    if ($original_width !== null) {
        $candidates[] = "{$base}.webp {$original_width}w";
    }

    return implode(', ', $candidates);
}

function roof_hero_image() {
    $base = get_template_directory_uri() . '/dist/images/header-banner';
    $mobile_widths = [288, 448, 576, 840];
    $mobile_base = get_template_directory() . '/dist/images/header-banner-mobile';
    $mobile_srcset = roof_webp_srcset('header-banner-mobile', $mobile_widths);

    foreach ($mobile_widths as $width) {
        if (!is_readable("$mobile_base-$width.webp")) {
            $mobile_srcset = '';
            break;
        }
    }

    return [
        'src' => $base . '.webp',
        'srcset' => implode(', ', [
            "$base-640.webp 640w",
            "$base-optimized-768.webp 768w",
            "$base-optimized-960.webp 960w",
            "$base-1440.webp 1440w",
            "$base-1920.webp 1920w",
            "$base.webp 3000w",
        ]),
        'sizes' => '100vw',
        'mobile_srcset' => $mobile_srcset,
        'mobile_sizes' => '55vw',
        'mobile_media' => '(max-width: 480px)',
    ];
}

function roof_preload_hero_image() {
    if (!is_front_page()) {
        return;
    }

    $hero = roof_hero_image();
    ?>
    <?php if ($hero['mobile_srcset']) : ?>
    <link rel="preload" as="image" type="image/webp" fetchpriority="high"
          media="<?php echo esc_attr($hero['mobile_media']); ?>"
          imagesrcset="<?php echo esc_attr($hero['mobile_srcset']); ?>"
          imagesizes="<?php echo esc_attr($hero['mobile_sizes']); ?>">
    <?php endif; ?>
    <link rel="preload" as="image" type="image/webp" fetchpriority="high"
          <?php if ($hero['mobile_srcset']) : ?>
          media="<?php echo esc_attr('not all and ' . $hero['mobile_media']); ?>"
          <?php endif; ?>
          imagesrcset="<?php echo esc_attr($hero['srcset']); ?>"
          imagesizes="<?php echo esc_attr($hero['sizes']); ?>">
    <?php
}

add_action('wp_head', 'roof_preload_hero_image', 1);

require_once __DIR__ . '/structured-data.php';


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
