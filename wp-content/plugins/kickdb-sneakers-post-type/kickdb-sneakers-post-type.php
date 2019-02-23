<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://poop.bike/
 * @since             1.0.0
 * @package           Kickdb_Sneakers_Post_Type
 *
 * @wordpress-plugin
 * Plugin Name:       KickDB Sneakers Post Type
 * Plugin URI:        https://kickdb.com
 * Description:       This plugin powers the kickdb_sneakers custom post type. It requires the Advanced Custom Fields plugin.
 * Version:           1.0.0
 * Author:            KickDB
 * Author URI:        http://poop.bike/
 * Text Domain:       kickdb-sneakers-post-type
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die();
}

if (!defined('PLUGIN_NAME_VERSION')) {
    define('PLUGIN_NAME_VERSION', '1.0.0');
}

require plugin_dir_path(__FILE__) . 'main.php';

init_kickdb_sneakers_post_type();
