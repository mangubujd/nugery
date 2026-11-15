# Corrections de l’audit du 15 novembre 2026

## Livré dans cette branche

- SEO-06/13 : titres, descriptions, Open Graph et schéma entreprise minimal via un mu-plugin. Il cède la place à Yoast, Rank Math, SEOPress ou AIOSEO si installé, sans ajouter de canonical concurrente de WordPress.
- SEO-01 : sitemap natif limité aux pages, projets et services ; archives utilisateurs et taxonomies retirées. Respect du réglage global d’indexation et des environnements de préproduction.
- SEO-08 : redirection HTTP et sans www vers HTTPS www, hors bloc WordPress. Règle limitée au domaine réel ; vérifier la terminaison TLS chez OVH avant livraison, notamment si un proxy est ajouté.
- SEO-16 : en-tête du thème enfant autorisant le zoom.
- SEO-02/03/05 : migration WP-CLI avec simulation, remplacement sérialisé des anciennes URL, retrait réversible des contenus sélectionnés et modification des titres Elementor.

## Déploiement et base de données

La base de production ne figure pas dans le dépôt. Ces corrections ne changent donc pas encore le site public. Tester avec une copie de la base et les mêmes extensions PHP ; activer `antra-child`. Copier le mu-plugin et le fichier `.htaccess` lors du déploiement.

1. Sauvegarder la base et les fichiers hors racine publique : `wp --path=www db export /chemin/prive/avant-seo.sql`.
2. Inventorier les contenus : `wp --path=www post list --post_type=post,team,virtual_tour,page --fields=ID,post_type,post_title,post_status --format=csv`.
3. Copier `tools/seo-manifest.example.json` dans un manifeste local. Renseigner uniquement les IDs de démonstration vérifiés dans `demo_ids`. Les contenus seront mis en brouillon, sans suppression définitive.
4. Renseigner `headings` avec les IDs réels des pages et le H1 voulu, par exemple `"42": "Nos services de construction, rénovation et conseil"`. Vérifier que le premier widget Heading est bien le titre principal. Les titres injectés via les modèles Elementor de projets/services nécessitent une édition de leur modèle, pas une modification du contenu de la fiche.
5. Simuler : `wp --path=www eval-file tools/seo-migrate.php dry-run /chemin/manifest.json`.
6. Vérifier les remplacements et les IDs, puis appliquer : `wp --path=www eval-file tools/seo-migrate.php apply /chemin/manifest.json`.
7. Corriger dans Slider Revolution les liens `services-01`, et dans Elementor les liens `contact-us` et `?post_type=service&p=232` encore présents sur le domaine réel. Remplacer les images placeholder de Poissy par des photos authentiques. Vérifier tous les menus et liens avant indexation.
8. Après contrôle du nettoyage, mettre `enable_indexing` à `true`, simuler puis appliquer. Le script refuse si des articles, équipes ou visites virtuelles restent publiés. Contrôler aussi les archives de catégories et la page Blog ; ne pas ouvrir l’indexation avec des contenus de démo résiduels.
9. Purger les caches, contrôler `/wp-sitemap.xml` et `/robots.txt`, puis soumettre le sitemap dans Search Console.

Les URL sont remplacées dans toutes les tables du préfixe WordPress, hors GUID. La commande traite les formats sérialisés. Les redirections de slugs sont traitées par les remplacements spécifiques avant le remplacement de la racine. Aucun accès ni identifiant de production n’est ajouté au dépôt.

## Points nécessitant données, contenu ou accès

- SEO-04 : confirmer téléphone et e-mail avant de modifier les options, en-têtes, pieds et destinataires Contact Form 7.
- SEO-07/09 : créer Rénovation et Conseil avec les prestations et méthodes réellement proposées, enrichir Services, Contact et Réalisations. Ne pas publier de promesses ou de délais non confirmés.
- SEO-10/15 : retirer les modules compte/panier, liens sociaux Themelexus, traduire les libellés et corriger les textes dans les modèles Elementor et Slider Revolution. Retirer les catégories de démo après contrôle des liens.
- SEO-11/12 : textes alternatifs descriptifs par photo, compression et suppression des médias uniquement après contrôle des usages. Mesurer avant/après ; aucun gain Core Web Vitals n’est encore établi.
- SEO-14 : mentions légales et confidentialité avec les informations validées de la société et les traitements effectifs.
- SEO-17 : vérifier les dépendances du thème avant désactivation de themelexus-debug (le thème utilise ses types de contenus). Contrôler les données publiques des auteurs sans bloquer l’éditeur authentifié.
- Search Console, statistiques et test réel de réception de formulaire nécessitent les accès correspondants.

## Recette et retour arrière

Contrôler accueil, Services, Contact, Réalisations, chaque projet et service : une seule description/canonical, exactement un H1 visible, aucun localhost, CTA fonctionnels desktop/mobile, images sans erreur. Vérifier les recherches et archives auteur en noindex, la 404 réelle, les trois redirections en une seule 301 et l’absence de boucle. Tester le formulaire et sa réception ; vérifier le XML et les URL indexables du sitemap.

En cas de régression, restaurer la sauvegarde de base, rétablir les fichiers de la version précédente et purger les caches. Les brouillons seuls peuvent aussi être republiés depuis WordPress. La réouverture de l’indexation exige une recette de production ; aucun déploiement automatique n’est inclus.
