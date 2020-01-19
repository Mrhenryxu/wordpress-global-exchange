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
define( 'DB_NAME', 'aamtdb' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:8889' );

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
define( 'AUTH_KEY',         'bX#Dg{^GHt+3|/:hrRXt+}MrME{!KoRE/>c#/hDs0[9#|od1|q[x,.P#j9hH!N>q' );
define( 'SECURE_AUTH_KEY',  'j*t ?x q3)DU5VY &]kXqbtAc( hB=8C_XYKy2nE3]P/f{!.AB& mD|Zg|rI[Is#' );
define( 'LOGGED_IN_KEY',    'JS_uHpF6eCA5_`}33vzuSAiYqa.G&]GIM;(:Qk<uNu@O8hVhLRDRg|8W3(2A2%d ' );
define( 'NONCE_KEY',        'FFfO OFs[f*sX5/DLYMgZuIv1SFMvB7<cmKQ8,O`#l;[|FwvcuP/b>W]ZUz/WKdR' );
define( 'AUTH_SALT',        'Y$)EcGU8BI1QQ}z*GlO$Wwdjm>$Zf_8MaOs?^_u2Gd_M/d9-8kD8X+#@d/)HBTGn' );
define( 'SECURE_AUTH_SALT', 'U]UJJ*kmRHF#@3AKI&XFdmJ@Z.?+BREWTjS+L=[^y=g>/v>+<Z&5120Va7I|UAjc' );
define( 'LOGGED_IN_SALT',   'G599<:zi6g{d$h7,rO>/GFcT0Mh5H- JPGR 5+W2Rvek|@JoBiT5TuMQ;R**[43@' );
define( 'NONCE_SALT',       'hX@Ol&89S/FAr./x!JX!!P&:wIZ}p#WeKb~R#t{M=oe;WBG#iB:baD{1Gf=GDiis' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'aamt_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
