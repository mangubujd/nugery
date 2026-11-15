<?php
// Tests isolés des métadonnées et des filtres, sans accès à une base de production.
define('ABSPATH', __DIR__);
$filters = $actions = array();
function add_filter($name, $callback, ...$rest) { global $filters; $filters[$name] = $callback; }
function add_action($name, $callback, ...$rest) { global $actions; $actions[$name] = $callback; }
function is_singular() { return true; }
function is_front_page() { return true; }
function is_feed() { return false; }
function get_queried_object() { return (object) array('post_name' => 'home', 'post_type' => 'page'); }
function get_permalink() { return 'https://www.nugery.fr/'; }
function home_url($path) { return 'https://www.nugery.fr' . $path; }
function get_queried_object_id() { return 1; }
function get_the_post_thumbnail_url(...$args) { return false; }
function esc_attr($text) { return htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); }
function esc_url($text) { return esc_attr($text); }
function wp_json_encode($value, $flags = 0) { return json_encode($value, $flags); }
function is_search() { return true; }
function is_author() { return false; }
function is_date() { return false; }
function is_tag() { return false; }
function check($ok, $message) { if (!$ok) { throw new RuntimeException($message); } }
require __DIR__ . '/../www/wp-content/mu-plugins/nugery-seo.php';
ob_start(); $actions['wp_head'](); $html = ob_get_clean();
$dom = new DOMDocument(); @$dom->loadHTML($html); $xpath = new DOMXPath($dom);
check($xpath->query('//meta[@name="description"]')->length === 1, 'Description unique');
check($xpath->query('//meta[@property="og:title"]')->length === 1, 'Open Graph présent');
$schema = json_decode($xpath->query('//script')->item(0)->textContent, true);
check($schema['@type'] === 'GeneralContractor' && !isset($schema['telephone']), 'Schéma sans coordonnées supposées');
check(strpos($html, 'localhost') === false, 'Aucune URL locale');
check(isset(($filters['wp_robots'])(array())['noindex']), 'Recherche en noindex');
$types = ($filters['wp_sitemaps_post_types'])(array_fill_keys(array('page', 'project', 'service', 'post', 'team', 'virtual_tour'), true));
check(array_keys($types) === array('page', 'project', 'service'), 'Sitemap limité');
check(($filters['wp_sitemaps_add_provider'])((object) array(), 'users') === false, 'Auteurs exclus du sitemap');
define('WPSEO_VERSION', 'test');
ob_start(); $actions['wp_head'](); check(ob_get_clean() === '', 'Pas de doublon avec extension SEO');
echo "SEO smoke tests: OK\n";
