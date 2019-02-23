<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              kickdb.com
 * @since             1.0.0
 * @package           Kickdb_Links
 *
 * @wordpress-plugin
 * Plugin Name:       KickDB Links
 * Plugin URI:        kickdb.com
 * Description:       Inserts links to products from kickdb.com
 * Version:           1.0.0
 * Author:            kickdb
 * Author URI:        kickdb.com
 * License:
 * License URI:
 * Text Domain:       kickdb.com
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

require plugin_dir_path( __FILE__ ) . 'main.php';

init_kickdb();
