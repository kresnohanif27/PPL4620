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
define( 'DB_NAME', 'makehrecord' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'vvd2|gd`u&I!]+4QBf~%900>:1cKhzp0+_=fo1jM8izH7gcBPBSv4$,v_HEVc_i;' );
define( 'SECURE_AUTH_KEY',  'W1@3yJBB6[53@&U(9,2$K4&rTatKT&B8V-3@dT&49._8^]?T_u`xi@v(djPjy~_(' );
define( 'LOGGED_IN_KEY',    'J$|3;QLW>8aY6[,2zUT!,{$?n7 g.a@w4Zgs=9BqP#P_sG)s0X&QBhTz-3FM&5X,' );
define( 'NONCE_KEY',        '+bGwn>-LxZqjUQSR%-`>:.5;,aMsZtYH[tUOv:JF+e%3vThlGnCGpeFx8ByO!U{b' );
define( 'AUTH_SALT',        'Lz}gQYE;kMO@KqZk )eFIb]4QqE/h:^|/HZn7k`T29t4s,%al2+`IcCjMX5:/1[(' );
define( 'SECURE_AUTH_SALT', 'mLn1Mbf/VvV#v5ov((Af}xXH8-W8}E`S{3@d^mB(.{mR3ht#ey$C|,:l.&4Tp)Iy' );
define( 'LOGGED_IN_SALT',   '*i}Y#Z$v*5)1~__U:q|v_G`]w)QN+=`AQlY^D>y^Lt-{(m?Z!S1qD#Fz+jc<PTS?' );
define( 'NONCE_SALT',       '+CBwt8aO/?a0?7$c7bY26d4<Vy0E!cV)1[N0-{wKFw>wsSeNdNNqv,gEl:31&zr[' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'make_';

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
