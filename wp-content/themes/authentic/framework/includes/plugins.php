<?php
/**
 * Recommended and Required Theme Plugins functions.
 *
 * @package Authentic WordPress Theme
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

// Include TGM Class.
include_once( get_template_directory() . '/framework/includes/classes/class-tgm-plugin-activation.php' );

/**
 * Register Required Plugins
 */
function csco_theme_register_required_plugins() {

	$plugins = array(

		array(
			'name'          => 'Advanced Custom Fields PRO',
			'slug'          => 'advanced-custom-fields-pro',
			'source'        => 'https://assets.codesupply.co/advanced-custom-fields-pro.zip',
			'required'      => true,
			'external_url'  => 'https://www.advancedcustomfields.com/',
			),

		array(
			'name'          => 'Post Views Counter',
			'slug'          => 'post-views-counter',
			'required'      => false,
			),

		array(
			'name'          => 'One Click Demo Import',
			'slug'          => 'one-click-demo-import',
			'required'      => false,
			),

		array(
			'name'          => 'Envato Market',
			'slug'          => 'envato-market',
			'source'        => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'required'      => false,
			'external_url'  => 'https://github.com/envato/wp-envato-market',
			),

		array(
			'name'          => 'Basic Facebook',
			'slug'          => 'basic-facebook',
			'source'        => 'https://assets.codesupply.co/basic-facebook.zip',
			'version'       => '1.0.0',
			'required'      => false,
			'external_url'  => 'https://codesupply.co/plugins/basic-facebook/',
			),

		array(
			'name'          => 'Basic MailChimp',
			'slug'          => 'basic-mailchimp',
			'source'        => 'https://assets.codesupply.co/basic-mailchimp.zip',
			'version'       => '1.1.1',
			'required'      => false,
			'external_url'  => 'https://codesupply.co/plugins/basic-mailchimp/',
			),

		array(
			'name'          => 'Basic Share Buttons',
			'slug'          => 'basic-share-buttons',
			'source'        => 'https://assets.codesupply.co/basic-share-buttons.zip',
			'version'       => '1.1.1',
			'required'      => false,
			'external_url'  => 'https://codesupply.co/plugins/basic-share-buttons/',
			),

		array(
			'name'          => 'Basic Shortcodes',
			'slug'          => 'basic-shortcodes',
			'source'        => 'https://assets.codesupply.co/basic-shortcodes.zip',
			'version'       => '1.1.1',
			'required'      => false,
			'external_url'  => 'https://codesupply.co/plugins/basic-shortcodes/',
			),

		array(
			'name'          => 'Basic Social Accounts',
			'slug'          => 'basic-social-accounts',
			'source'        => 'https://assets.codesupply.co/basic-social-accounts.zip',
			'version'       => '1.1.1',
			'required'      => false,
			'external_url'  => 'https://codesupply.co/plugins/basic-social-accounts/',
			),

		array(
			'name'          => 'Basic Twitter',
			'slug'          => 'basic-twitter',
			'source'        => 'https://assets.codesupply.co/basic-twitter.zip',
			'version'       => '1.1.1',
			'required'      => false,
			'external_url'  => 'https://codesupply.co/plugins/basic-twitter/',
			),

		array(
			'name'          => 'Gridable',
			'slug'          => 'gridable',
			'required'      => false,
			),

		array(
			'name'          => 'WP Instagram Widget',
			'slug'          => 'wp-instagram-widget',
			'required'      => false,
			),

		array(
			'name'          => 'Contact Form 7',
			'slug'          => 'contact-form-7',
			'required'      => false,
			),

		array(
			'name'          => 'Bootstrap for Contact Form 7',
			'slug'          => 'bootstrap-for-contact-form-7',
			'required'      => false,
			),

		array(
			'name'          => 'Regenerate Thumbnails',
			'slug'          => 'regenerate-thumbnails',
			'required'      => false,
			),

		);

	$config = array(
		'id'           => 'csco',
		'default_path' => '',
		'menu'         => 'csco-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
		'message'      => '',
		);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'csco_theme_register_required_plugins' );

/**
 * Hook into activated_plugin action.
 *
 * Set Post Views Counter location to manual.
 *
 * @param string $plugin Plugin path to main plugin file with plugin data.
 */
function csco_activated_plugin( $plugin ) {
	// Check if PVC constant is defined, use it to get PVC path anc compare to activated plugin.
	if ( defined( 'POST_VIEWS_COUNTER_PATH' ) && plugin_basename( POST_VIEWS_COUNTER_PATH . 'post-views-counter.php' ) === $plugin ) {
		// Get display options.
		$display_options = get_option( 'post_views_counter_settings_display' );
		// Set position value.
		$display_options['position'] = 'manual';
		// Update options.
		update_option( 'post_views_counter_settings_display', $display_options );
	}
}

add_action( 'activated_plugin', 'csco_activated_plugin' );
