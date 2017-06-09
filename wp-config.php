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
define('DB_NAME', 'retrosalonbooking');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'B<nN}?=*+H2wk`yCT%Gr.I{i[eYuF:XV-+{0xFVv@pNc,#.x9,Tug$U;)|MJ(?hX');
define('SECURE_AUTH_KEY',  'S@RFum!;ny6cv2 0kwG5d~kNjLqo-imTj0,!`ZY&4Xw5&-im,,~IC>n*Hsi<o[.~');
define('LOGGED_IN_KEY',    '%ZQ#O{l!2qKjdng9lD9f#MlY>nYoUhGfY7^`3PD3 o{z4c?g=?ZrBH192 ikYl5Y');
define('NONCE_KEY',        'HNNYDNjk5(i``@ks6qjCljqi!|i2lB6B5^*vjE9mo_-Ltfit]8vXr?=I}EP.OzaK');
define('AUTH_SALT',        '97d_l=3&yS)FWIb#E20jSYh}2<>GMc1fKl0fqz-qJ.Fx8Y$:sp1)s~cS{pV,g<:X');
define('SECURE_AUTH_SALT', 'dIxFY<mtTZkoBbsB&<P:^pAhrblyeQ3qm}#kt1ifC:M*1e1$-xUrD16Cu>bYJIYY');
define('LOGGED_IN_SALT',   'g~bxwlBOQj0*/4K7_Z472%]K}tvbRwE)5yOSjo/LenjObVY+2>HLAw@ =!JP}&be');
define('NONCE_SALT',       '(;Q1Fl> jp dU/U0s*k2@tpyTN*$M,1TO;uvfT}*uV>?jw3bj>ZyO2e;2#qzO5)1');

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
