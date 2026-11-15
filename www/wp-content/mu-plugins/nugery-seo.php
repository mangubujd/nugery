<?php
/**
 * Plugin Name: Nugery SEO
 * Description: Métadonnées et périmètre du sitemap issus de l’audit du 15 novembre 2026.
 */
defined('ABSPATH') || exit;

function nugery_seo_external() {
    return defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') || defined('SEOPRESS_VERSION') || defined('AIOSEO_VERSION');
}

function nugery_seo_data() {
    if (!is_singular()) {
        return null;
    }
    $post = get_queried_object();
    $key = is_front_page() ? 'home' : $post->post_name;
    $pages = array(
        'home' => array('Entreprise générale du bâtiment à Paris | Nugery', 'Construction neuve, rénovation, extension et conseil travaux à Paris et en Île-de-France. Découvrez les réalisations de Nugery et contactez-nous pour votre projet.'),
        'services' => array('Construction neuve, rénovation et conseil | Nugery', 'Découvrez les services de Nugery : construction neuve, rénovation et conseil pour vos projets de travaux à Paris et en Île-de-France.'),
        'nos-realisations' => array('Nos réalisations en Île-de-France | Nugery', 'Le Chesnay, Vanves, Sceaux, Poissy : découvrez les réalisations de Nugery en rénovation, extension et construction en Île-de-France.'),
        'contact' => array('Contact et demande de devis | Nugery, Paris', 'Un projet de construction ou de rénovation ? Contactez Nugery pour échanger sur vos travaux à Paris et en Île-de-France et demander un devis.'),
        'gros-oeuvre-construction-neuve' => array('Construction neuve et gros œuvre en Île-de-France | Nugery', 'Découvrez l’accompagnement Nugery pour votre projet de construction neuve et de gros œuvre en Île-de-France, de l’étude au suivi de chantier.'),
        'extension-poissy' => array('Extension d’une maison meulière à Poissy | Nugery', 'Découvrez l’extension contemporaine et la rénovation intérieure d’une maison meulière à Poissy, réalisées avec l’architecte Armel Joly.'),
    );
    if (isset($pages[$key])) {
        return $pages[$key];
    }
    if (!in_array($post->post_type, array('page', 'project', 'service'), true)) {
        return null;
    }
    $text = has_excerpt($post) ? $post->post_excerpt : strip_shortcodes($post->post_content);
    $text = preg_replace('/\s+/u', ' ', wp_strip_all_tags($text));
    if (trim($text) === '') {
        $text = 'Découvrez ' . get_the_title($post) . ' avec Nugery. Consultez nos réalisations et contactez-nous pour parler de votre projet de travaux.';
    }
    return array(get_the_title($post) . ' | Nugery', wp_trim_words($text, 28, '…'));
}

add_filter('pre_get_document_title', function ($title) {
    $data = nugery_seo_external() ? null : nugery_seo_data();
    return $data ? $data[0] : $title;
}, 20);

add_action('wp_head', function () {
    if (nugery_seo_external() || is_feed()) {
        return;
    }
    $data = nugery_seo_data();
    if (!$data) {
        return;
    }
    $url = get_permalink();
    echo '<meta name="description" content="' . esc_attr($data[1]) . '">' . "\n";
    foreach (array('og:title' => $data[0], 'og:description' => $data[1], 'og:url' => $url, 'og:type' => 'website', 'og:locale' => 'fr_FR', 'og:site_name' => 'Nugery') as $property => $value) {
        echo '<meta property="' . esc_attr($property) . '" content="' . esc_attr($value) . '">' . "\n";
    }
    $image = get_the_post_thumbnail_url(get_queried_object_id(), 'large');
    if ($image) {
        echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
    }
    $schema = array('@context' => 'https://schema.org', '@type' => 'GeneralContractor', '@id' => home_url('/#organisation'), 'name' => 'NUGERY', 'url' => home_url('/'));
    // Coordonnées, avis et horaires : ajouter uniquement après validation client.
    if (is_front_page()) {
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) . '</script>' . "\n";
    }
}, 5);

add_filter('wp_robots', function ($robots) {
    if (is_search() || is_author() || is_date() || is_tag()) {
        $robots['noindex'] = true;
        unset($robots['index']);
    }
    return $robots;
});
add_filter('wp_sitemaps_post_types', function ($types) {
    return array_intersect_key($types, array_flip(array('page', 'project', 'service')));
});
add_filter('wp_sitemaps_add_provider', function ($provider, $name) {
    return in_array($name, array('users', 'taxonomies'), true) ? false : $provider;
}, 10, 2);
