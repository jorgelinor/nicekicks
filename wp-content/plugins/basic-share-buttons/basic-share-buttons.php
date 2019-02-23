<?php
/**
 * Plugin Name:       Basic Share Buttons
 * Plugin URI:        https://codesupply.co/plugins/basic-share-buttons/
 * Description:       Share buttons with counters.
 * Version:           1.1.1
 * Author:            Code Supply Co.
 * Author URI:        https://codesupply.co
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       basic-share-buttons
 * Domain Path:       /languages
 *
 * @link              https://codesupply.co
 * @since             1.0.0
 * @package           Basic Share Buttons
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-basic-share-buttons-activator.php
 */
function activate_bsb_share_buttons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-basic-share-buttons-activator.php';
	Basic_Share_Buttons_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-basic-share-buttons-deactivator.php
 */
function deactivate_bsb_share_buttons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-basic-share-buttons-deactivator.php';
	Basic_Share_Buttons_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bsb_share_buttons' );
register_deactivation_hook( __FILE__, 'deactivate_bsb_share_buttons' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-basic-share-buttons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bsb_share_buttons() {

	$plugin = new Basic_Share_Buttons();
	$plugin->run();

}
run_bsb_share_buttons();
