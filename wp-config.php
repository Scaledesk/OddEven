<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'test_wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');



//custom 
define('FS_METHOD', 'direct');




/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^x`Vlf]Nw<xI0}*:#8 &6@!ypo^9GfEQ(pS_a:)5kCE,y$rIQi~wpE0<bq?e<bD{');
define('SECURE_AUTH_KEY',  'I|ncJNwSgmz&a^`|&uVO4T>*ZR6wNiLkQQ_]RIx@5;q[u6}_Tdlpi)Cg,!$@? Or');
define('LOGGED_IN_KEY',    'o]Zx9g#xqPkCUo$X|x})e!(~++l%XbI{mnD406{ZXuL*~yO{&yGH6U$=9!.<)r$F');
define('NONCE_KEY',        '[yt,-vGIA$`=:HgT}B.#5>od}1-F^d%#XWSdoo*sr^iVl*=*Z&/vBql9f`T`-T><');
define('AUTH_SALT',        '1u&YG?]FjM0;{$GQKx_g{K0i2@^}~mrNP:6R5#rKTSK,(]X%|sEX$7/.T{Tj25TL');
define('SECURE_AUTH_SALT', '`1##+3Oqmz4cIAIc-u#9p^z+}Hb+)(EM~3[^t!;U70!AWk#b~X|rFz_i`%x6A:OM');
define('LOGGED_IN_SALT',   'xU/^b}=ay@Y<~MN=0B16;-6 fX&1JLX6sVZ<TW5J-=]LN!lh`4pYQfl}Q9h<YPK[');
define('NONCE_SALT',       '_mhVH>}yNOtqB/&Zi9CNTMF-j>Qth5]^AqX!mdJf#o}lj[6U`IJ~WG|c|i^={(-J');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
