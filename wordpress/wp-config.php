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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '!nR#{Y=0kU`,jZ)Q/u U= WzVsE;B*JVM%#j!Tfz!s4sm;s2_z{t:_]6 :91)#X3' );
define( 'SECURE_AUTH_KEY',  'y-!b4IRS^r:-ML.weV~LD,$:pC ^[BuN:E,p6H~wQ3f##uD53!g2#2,u!gwt<iY@' );
define( 'LOGGED_IN_KEY',    'k)(=;a+Hrt[N=.@.$.?`nwTm)&<G`&`lM7aR-+a^wUtzLa%,MIBKdEOy0$yh`;#1' );
define( 'NONCE_KEY',        'h7k.Y-Jbg#~j[sDgoz.v3k (01%:9OT)R%ZJACXgQDd;x6.m!DuC`@5H+A6[-J{R' );
define( 'AUTH_SALT',        'XHt;DHI9TM2j AEFn_.-l#,z`p79gyZ!sg(XpVn;SBE;O%VT1^MQm!i9]LgQ5V-o' );
define( 'SECURE_AUTH_SALT', ';QF-RBxEjTJ0TqfCEDctVSn[h3&LSFEU4] 8ULtV]0(VPK#EgUn_zuI({@3xGaV.' );
define( 'LOGGED_IN_SALT',   '6MBJ~`m!,h8rB6t!?9Ba7Fxsp)V)Jy=X9X.c~r6H~S+GgXu7GAxo&=bhWz@GG`hp' );
define( 'NONCE_SALT',       '9J$#@?q5K]uc{I<AUBIvd`Mgc|t`7j>M -o>6B7Zx&oTN5X)I}*--5y*]ZtOt:h2' );

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
