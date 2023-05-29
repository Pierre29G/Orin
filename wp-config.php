<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link https://fr.wordpress.org/support/article/editing-wp-config-php/ Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'orin' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'qd2~UIw=/jotzrzRlZ8z=SymW<nkct8Dj o UI>hC8GIjj@/S>IMHE-NTE!0a-B[' );
define( 'SECURE_AUTH_KEY',  ',*`n0wzp,o+)`IU;^!ECj|TrWJZBqrII]9q-`MLMu!w&w;]}[!Y03FyC)LEF|:,l' );
define( 'LOGGED_IN_KEY',    'pHOQMURZnSj4,miQ~}sWC[R=5SdM/iLQU_!`6w?JKtN!!]Pa-#YBR&?ZUb^F5P._' );
define( 'NONCE_KEY',        'yR8:YGkxZ:3s+2K~DVZ9OuuCU4f1AQG!@(NovoOBoPs%zt^y#sou4i$#9R)R:GCF' );
define( 'AUTH_SALT',        'Ib0D 3sCL3O7+}:FDNKg.T!qW!S8{>H[){!]>eo1ii1w[C;7r74SHl>-Psch?gHC' );
define( 'SECURE_AUTH_SALT', 'QyIaSV_@bku_A9@1yeK1(h:guqw(uyOlCnTYawmsC[;Ys,~C;hli-MY]DiVwjK3W' );
define( 'LOGGED_IN_SALT',   ',BgDH``p[!Uqz#&+;N9;>N[Em!u8?53l3Jf~_Y`8=%0]Sp&&xWwWC3n_RR5tuA)G' );
define( 'NONCE_SALT',       'l%@cf~P74hBISI|_.oF(^N@u_wVK EwI8I7hfc@SrZI,RYM`^6yw9s:Ei!{BA*Bn' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs et développeuses : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur la documentation.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
