# Nugery — WordPress

Sources du site WordPress, avec ses thèmes, extensions et médias.

## Structure

- `www/` : racine web WordPress.
- `.ovhconfig` : configuration du moteur PHP OVH.

## Installation

1. Configurer un hébergement compatible WordPress avec PHP et MySQL/MariaDB, dont la racine web est `www/`.
2. Copier `www/wp-config-sample.php` vers `www/wp-config.php`, renseigner les accès à la base et générer des clés de sécurité uniques.
3. Importer séparément la base de données du site existant pour retrouver les pages, utilisateurs, commandes et réglages. Aucun export de base de données n’est inclus dans ce dépôt.
4. Vérifier les URL du site et les permissions des fichiers sur l’hébergement cible.

GitHub conserve les sources ; GitHub Pages ne peut pas exécuter WordPress/PHP.

## Fichiers exclus

La configuration privée `wp-config.php`, les fichiers système, les journaux, les fichiers temporaires et les dossiers d’envoi privés des formulaires et de WooCommerce sont exclus. Le dossier local d’origine reste inchangé.
