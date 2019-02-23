<?php
/**
 * Plugin Name:       Basic Social Accounts
 * Plugin URI:        https://codesupply.co/plugins/basic-social-accounts/
 * Description:       Social media accounts with counters in widgets and shortcodes.
 * Version:           1.1.1
 * Author:            Code Supply Co.
 * Author URI:        https://codesupply.co
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       basic-social-accounts
 * Domain Path:       /languages
 *
 * @link              https://codesupply.co
 * @since             1.0.0
 * @package           Basic Social Accounts
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-basic-social-accounts-activator.php
 */
function activate_bsa_social_accounts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-basic-social-accounts-activator.php';
	Basic_Social_Accounts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-basic-social-accounts-deactivator.php
 */
function deactivate_bsa_social_accounts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-basic-social-accounts-deactivator.php';
	Basic_Social_Accounts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bsa_social_accounts' );
register_deactivation_hook( __FILE__, 'deactivate_bsa_social_accounts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-basic-social-accounts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bsa_social_accounts() {

	$plugin = new Basic_Social_Accounts();
	$plugin->run();

}
run_bsa_social_accounts();
