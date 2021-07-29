<?php
// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
define( 'FORCE_SSL_ADMIN', false ); // Redirect All HTTP Page Requests to HTTPS - Security > Settings > Secure Socket Layers (SSL) > SSL for Dashboard
// END iThemes Security - Do not modify or remove this line
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
if ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'http') $_SERVER['HTTP']='on';
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'epiz_25670306_w220' );
/** MySQL database username */
define( 'DB_USER', '25670306_1' );
/** MySQL database password */ 
define( 'DB_PASSWORD', '1d6B]p5S5-' );
/** MySQL hostname */
define( 'DB_HOST', 'sql213.byetcluster.com' );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ebdinbu6hy2cggfpvzolynf9obr5v1pggr4lydrgp6gqo5k6fxy6cixlyz9gjv1l' );
define( 'SECURE_AUTH_KEY',  '689caou6kjxesbxqnqywerovuffc9jp2xnfdg2foihv222btyvfkjauavvfko1io' );
define( 'LOGGED_IN_KEY',    'ifvwwgqlj77t0xvxdnv4q0wd8phymyscbjpdieaahr2fuauw4ilrysvthughsuca' );
define( 'NONCE_KEY',        'stltxigsoynq7uf39hsfyd69f86xioyyg1ytney1enbkxck1dnvw7laxknykehff' );
define( 'AUTH_SALT',        'kgyxpuutrn6i2eqolfennl1qoutwmfnq3tcvgmzlkfs5vsw6mald2dx83cinc8k4' );
define( 'SECURE_AUTH_SALT', '1rpqkf2vgua9cmmhu2a5mx5yi6hdfefohwhycedjlbzw6fwudr1khkjl6crzhbcs' );
define( 'LOGGED_IN_SALT',   'umcwnupp9h6ojcu7pbjxiyfzusewxojcdky2gc5iy7uldqchewcn8esqpwyipivz' );
define( 'NONCE_SALT',       'zdpicpmx5ht9ojir0uaravzaei5wd42rblwahoctdrhjbel2s2wmf2gxqdpusulr' );

/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp3g_';
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false ); 
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
 