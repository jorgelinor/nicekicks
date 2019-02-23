<?php
/**
 * Theme Settings
 *
 * This file registers all of this child theme's specific Theme Settings, accessible from
 * Genesis > Theme Settings.
 *
 * @package		NiceKicks
 * @author		Bill Erickson <bill@billerickson.net>
 * @copyright	Copyright (c) 2011, Bill Erickson
 * @license		http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */ 

add_filter('genesis_theme_settings_defaults', 'be_theme_defaults');

/**
 * Register Defaults
 *
 * @param array $defaults
 * @return array modified defaults
 *
 */

function be_theme_defaults($defaults) {
	$defaults[] = array(
		'footer_left' => '',
		'footer_right' => '',
	);

	return $defaults;
}

add_action( 'genesis_settings_sanitizer_init', 'be_register_theme_sanitization_filters' );

/**
 * Sanitization
 *
 */

function be_register_theme_sanitization_filters() {
	
	genesis_add_option_filter('safe_html', GENESIS_SETTINGS_FIELD,
	array(
		'footer_left',
		'footer_right'
	));

}

add_action('genesis_theme_settings_metaboxes', 'be_register_theme_settings_box');

/**
 * Register Metaboxes
 *
 */

function be_register_theme_settings_box() {
	global $_genesis_theme_settings_pagehook;

	add_meta_box('be-footer-settings', 'Footer', 'be_footer_settings_box', $_genesis_theme_settings_pagehook, 'main', 'high');
} 

/**
 * Create Metaboxes
 *
 */

function be_footer_settings_box() {
?>

	<p>Footer Left</p>
	<textarea name="<?php echo GENESIS_SETTINGS_FIELD; ?>[footer_left]" cols="78" rows="8"><?php echo esc_textarea( genesis_get_option('footer_left') ); ?></textarea>

	<p>Footer Right</p>
	<textarea name="<?php echo GENESIS_SETTINGS_FIELD; ?>[footer_right]" cols="78" rows="8"><?php echo esc_textarea( genesis_get_option('footer_right') ); ?></textarea>
	
<?php
}