<?php

function roof_print_structured_data() {
    $is_home = is_front_page();
    $post = is_singular('post') ? get_queried_object() : null;
    $is_public_post = $post instanceof WP_Post && $post->post_status === 'publish' && $post->post_password === '';

    if (!$is_home && !$is_public_post) {
        return;
    }

    $home = home_url('/');
    $business_id = $home . '#empresa';
    $images = get_template_directory_uri() . '/dist/images/';
    $area = ['@type' => 'City', 'name' => 'Brasília'];
    $language = get_bloginfo('language');

    $business = [
        '@type' => 'RoofingContractor',
        '@id' => $business_id,
        'name' => 'Divinos Telhados',
        'url' => $home,
        'description' => 'Especialistas em construção, reforma e manutenção de telhados residenciais e comerciais. Mais de 25 anos de experiência em Brasília.',
        'logo' => $images . 'logo.webp',
        'image' => $images . 'header-banner.webp',
        'email' => 'centralvilela@gmail.com',
        'telephone' => '+5561992371373',
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'contactType' => 'Orçamentos via WhatsApp',
            'telephone' => '+5561999963646',
            'url' => 'https://wa.me/5561999963646',
        ],
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'SMAS Área Especial, Parque do Guará Gleba 2',
            'addressLocality' => 'Brasília',
            'addressRegion' => 'DF',
            'postalCode' => '71215-300',
            'addressCountry' => 'BR',
        ],
        'areaServed' => $area,
        'openingHoursSpecification' => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'opens' => '08:00',
            'closes' => '18:00',
        ],
        'paymentAccepted' => 'Visa, Mastercard, Elo, Pix',
        'hasMap' => 'https://maps.app.goo.gl/8nRruRkGnu8kbZY86',
        'sameAs' => ['https://instagram.com/divinostelhados'],
    ];

    $graph = [];

    if ($is_home) {
        $services = [
            'Construção de telhados',
            'Troca de telhado',
            'Manutenção preventiva',
            'Telhados residenciais e comerciais',
            'Instalação de calhas e rufos',
            'Remoção de goteiras e vazamento de telhados',
        ];

        $offers = [];
        foreach ($services as $service) {
            $offers[] = [
                '@type' => 'Offer',
                'itemOffered' => [
                    '@type' => 'Service',
                    'name' => $service,
                    'provider' => ['@id' => $business_id],
                    'areaServed' => $area,
                ],
            ];
        }

        $business['hasOfferCatalog'] = [
            '@type' => 'OfferCatalog',
            'name' => 'Serviços de telhados',
            'itemListElement' => $offers,
        ];

        $graph[] = [
            '@type' => 'WebSite',
            '@id' => $home . '#site',
            'url' => $home,
            'name' => $business['name'],
            'inLanguage' => $language,
            'publisher' => ['@id' => $business_id],
        ];
    }

    $graph[] = $business;

    if ($is_public_post) {
        $url = get_permalink($post);
        $post_data = [
            '@type' => 'BlogPosting',
            '@id' => $url . '#artigo',
            'url' => $url,
            'mainEntityOfPage' => $url,
            'headline' => wp_strip_all_tags(get_the_title($post)),
            'datePublished' => get_the_date(DATE_W3C, $post),
            'dateModified' => get_the_modified_date(DATE_W3C, $post),
            'inLanguage' => $language,
            'publisher' => ['@id' => $business_id],
        ];

        $author = get_the_author_meta('display_name', $post->post_author);
        if ($author !== '') {
            $post_data['author'] = ['@type' => 'Person', 'name' => $author];
        }

        $image = wp_get_attachment_image_url(get_post_thumbnail_id($post), 'full');
        if ($image) {
            $post_data['image'] = $image;
        }

        $graph[] = $post_data;
    }

    $json = wp_json_encode([
        '@context' => 'https://schema.org',
        '@graph' => $graph,
    ], JSON_HEX_TAG | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    if ($json !== false) {
        echo '<script type="application/ld+json">' . $json . "</script>\n";
    }
}

add_action('wp_head', 'roof_print_structured_data');
