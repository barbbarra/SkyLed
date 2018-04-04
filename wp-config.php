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
define('DB_NAME', 'skyled');

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

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^ I2AdaXfQni})<%3I`>h(Ect`N+f4nP1.%kW$AVU[:Bfd$H<-|$[T{89#gx:cKA');
define('SECURE_AUTH_KEY',  'YP_`Em1ZTJa}`Ii-sX7!^^0@U+W%] WYOy_8KnpI1~yLz7EM/5yF}R#2-+Ztof%x');
define('LOGGED_IN_KEY',    '^Gn[a{]B}PkYE#zA!-X_0X)^,:Wo>?gWCstY*03G4]_9=ZnfAtsaLdICY_w.n,ZK');
define('NONCE_KEY',        '1qd#MMlTi-=Q#;%$N`Q6Y(PZZKUuYV}B.kZMJ62?.-b0vAhg:.l/dH`Il;7A-wdH');
define('AUTH_SALT',        'xswtZa_b8WB$Tx?K$_rYfkir7c{cq?;lthmT^i .BHOEzt1;iNOme2ozEC7Xe1wk');
define('SECURE_AUTH_SALT', 'JC-*J1ydWV6PpXITaoL0UPe]:`S-+<w1sl($t[NlO;[9pV4,WSU}ti[*|$}]GoxF');
define('LOGGED_IN_SALT',   '?<:V8[{`XW8sFk4=ZVyQYHh{W(vhcob+r7q)n|m5oYc %*n|7Z$P8DwBF@H5z|0/');
define('NONCE_SALT',       '+PY1ABzFr-}Uy$AjV_=.0`K*n$HCw@hGVpn-778zDlL|3[gV_4oK|+s%/3RfgSpc');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dl_';

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
