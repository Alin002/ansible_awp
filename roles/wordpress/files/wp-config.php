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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_db01' );

/** MySQL database username */
define( 'DB_USER', 'wp_user1' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Wp_user1' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/** Set site address. */
define( 'WP_HOME', 'http://wpsite.com' );
define( 'WP_SITEURL', 'http://wpsite.com' );


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'K^?QW+U/<S|#?TMg&q+rLG}U$LrBD.*{.g?Ew4?o$$+-<B]ofv:6o!hn1?s.C(NW' );
define( 'SECURE_AUTH_KEY',  '0F_vr9(U]=fB>J,71D=:i_P)[%E0G]Au@0)+?&Lp]ypC}4:K.*:A08MK%h`qd/s_' );
define( 'LOGGED_IN_KEY',    '[;B4wYJ<sbn47 Kua:r`=-i#+$!k5r* dui0`0{e{p7gaLEc1xV[#hP(h;[Zesdh' );
define( 'NONCE_KEY',        'L$6{j#Gq7QVIvH8yV}6vp/vn!Kx7vP,[s]A~ !~^cAJaA*@D]YvQY!*$:G[ az|T' );
define( 'AUTH_SALT',        'C*v~1)q@/}DB%(I&p~cgT_kCg}cMF[bxFg&GAhT*q<@O$c7JZ2Wf.8m5zL/,E+ol' );
define( 'SECURE_AUTH_SALT', '4dht$%wo]k9NUi!Mz1eCXe)*F?Qek<%qg(+*6oarS,S$X8U.T3atQ3F8clEln>&<' );
define( 'LOGGED_IN_SALT',   'Voobtfg6Km7l7[m`P@`U~5jyOhwt_kdvdDM((T`U&daFmr0JAt,^.j-W~L6B+= Z' );
define( 'NONCE_SALT',       'N)?IeCyk`Zqj[lUF9k1./tFns:TN[SKQnly:jRUA;yy^ x7xDS!eVt83HsNbit.L' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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