<?php
/** Run with: wp --path=www eval-file tools/seo-migrate.php [apply] [manifest.json] */
if (!defined('WP_CLI') || !WP_CLI) {
    exit("WP-CLI requis.\n");
}
$apply = isset($args[0]) && $args[0] === 'apply';
$manifest = isset($args[1]) ? json_decode(file_get_contents($args[1]), true) : array();
if (!is_array($manifest)) {
    WP_CLI::error('Manifeste JSON invalide.');
}
WP_CLI::log($apply ? 'APPLICATION — sauvegarde préalable requise.' : 'SIMULATION — aucune modification.');
$mapping = array(
    'http://localhost:8888/nugeryNew/contact-us/' => home_url('/contact/'),
    'http://localhost/wordpress/antra/services-01/' => home_url('/contact/'),
    'http://localhost:8888/nugeryNew' => untrailingslashit(home_url()),
    'http://localhost/wordpress/antra' => untrailingslashit(home_url()),
);
// WP-CLI gère JSON et longueurs des valeurs PHP sérialisées. Ne pas toucher aux GUID.
foreach ($mapping as $old => $new) {
    $command = 'search-replace ' . escapeshellarg($old) . ' ' . escapeshellarg($new) . ' --all-tables-with-prefix --skip-columns=guid --precise';
    WP_CLI::runcommand($command . ($apply ? '' : ' --dry-run'));
}
$demo_ids = array_map('absint', $manifest['demo_ids'] ?? array());
foreach ($demo_ids as $id) {
    $post = get_post($id);
    if (!$post || !in_array($post->post_type, array('post', 'team', 'virtual_tour', 'page'), true)) {
        WP_CLI::error('ID de démonstration invalide : ' . $id);
    }
}
foreach ($demo_ids as $id) {
    WP_CLI::log('Retrait réversible en brouillon : ' . $id . ' ' . get_the_title($id));
    if ($apply) {
        $result = wp_update_post(array('ID' => $id, 'post_status' => 'draft'), true);
        if (is_wp_error($result)) {
            WP_CLI::error($result->get_error_message());
        }
    }
}
// Modifier les titres dans les données Elementor, jamais via une réécriture du HTML final.
foreach (($manifest['headings'] ?? array()) as $id => $heading) {
    $id = absint($id);
    $post = get_post($id);
    if (!$post || !in_array($post->post_type, array('page', 'project', 'service'), true)) {
        WP_CLI::error('Page de titre invalide : ' . $id);
    }
    $tree = json_decode(get_post_meta($id, '_elementor_data', true), true);
    if (!is_array($tree)) {
        WP_CLI::warning('Pas de données Elementor : ' . $id);
        continue;
    }
    $found = false;
    $walk = function (&$nodes) use (&$walk, &$found, $heading) {
        foreach ($nodes as &$node) {
            if (($node['widgetType'] ?? '') === 'heading') {
                if (!$found) {
                    $node['settings']['header_size'] = 'h1';
                    $node['settings']['title'] = sanitize_text_field($heading);
                    $found = true;
                } elseif (($node['settings']['header_size'] ?? '') === 'h1') {
                    $node['settings']['header_size'] = 'h2';
                }
            }
            if (!empty($node['elements'])) {
                $walk($node['elements']);
            }
        }
    };
    $walk($tree);
    WP_CLI::log('Titre principal : ' . $id . ' → ' . $heading);
    if ($apply && $found) {
        update_post_meta($id, '_elementor_data', wp_slash(wp_json_encode($tree)));
    }
}
if (!empty($manifest['enable_indexing'])) {
    // Aucun changement si des articles / équipes / visites virtuelles restent publics.
    $remaining = get_posts(array('post_type' => array('post', 'team', 'virtual_tour'), 'post_status' => 'publish', 'numberposts' => -1, 'fields' => 'ids'));
    $remaining = array_diff($remaining, $apply ? array() : $demo_ids);
    $blog = get_post(39);
    if ($remaining || ($blog && $blog->post_status === 'publish' && !in_array(39, $demo_ids, true))) {
        WP_CLI::error('Nettoyer et vérifier les contenus de démonstration avant d’ouvrir l’indexation.');
    }
    WP_CLI::log('Ouverture de l’indexation demandée.');
    if ($apply) {
        update_option('blog_public', '1');
    }
}
if ($apply) {
    if (class_exists('Elementor\\Plugin')) {
        \Elementor\Plugin::$instance->files_manager->clear_cache();
    }
    flush_rewrite_rules(false);
    WP_CLI::success('Migration terminée. Vérifier le rendu et les liens avant mise en production.');
}
